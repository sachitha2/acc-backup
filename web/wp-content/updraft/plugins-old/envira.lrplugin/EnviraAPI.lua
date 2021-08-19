--[[----------------------------------------------------------------------------

EnviraAPI.lua
Common code to initiate Envira API requests with the WordPress REST API
------------------------------------------------------------------------------]]

-- Lightroom SDK
local LrDialogs = import 'LrDialogs'
local LrFileUtils = import 'LrFileUtils'
local LrFunctionContext = import 'LrFunctionContext'
local LrHttp = import 'LrHttp'
local LrPathUtils = import 'LrPathUtils'
local LrStringUtils = import 'LrStringUtils'
local LrTasks = import 'LrTasks'

-- Debugging - use LrLogger:info( inspect( var ) )
-- local LrLogger = import 'LrLogger'( 'EnviraLightroom' )
-- LrLogger:enable( 'logfile' ) -- See /Documents/EnviraAPI.log
-- local inspect = require 'inspect'

-- JSON parser
local json = require 'json'

--============================================================================--
-- Properties
--============================================================================--

-- Setup API object
EnviraAPI = {}

--============================================================================--
-- Functions
--============================================================================--

-- Login to WordPress
function EnviraAPI.login( propertyTable, showDialogs )

	-- Silently return if we don't have a URL defined
	if propertyTable.url == '' then
		return
	end

	-- Send a GET request to the WordPress REST API
	LrTasks.startAsyncTask( function()

		-- Define X-Envira-Lightroom-Access-Token Header
		local requestHeaders = {
			{ field = 'X-Envira-Lightroom-Access-Token', value = LrStringUtils.encodeBase64( propertyTable.accessToken ) },
			{ field = 'Content-Type', value = 'application/json' },
		}

		-- Define WP-API URL
		local url = propertyTable.url .. '/wp-json/'

		-- If the v2 WP REST API option has been selected, add to the URL
		if propertyTable.v2API then
			url = url .. 'envira/v2/authenticate'
		end
		
		-- Make GET request
		local result, headers = LrHttp.get( url, requestHeaders )

		-- Check WP REST API Active
		local isJSON = EnviraAPI.isJSONResponse( headers )
		if isJSON == false then
			-- Non-JSON response
			-- Mark login details as invalid
			propertyTable.loginValid = false
			propertyTable.loginButtonEnabled = true

			-- Show Response
			if showDialogs then
				LrDialogs.message( 'Could not connect to your WordPress web site. Please check the Envira Lightroom Addon Plugin is installed and activated on your WordPress web site.' )
			end

			-- Quit
			return;
		end

		-- Check Lightroom Addon Active and Login OK
		local result = EnviraAPI.inspectResponse( headers, result )
		if type( result ) == 'string' then
			-- Error
			-- Mark login details as invalid
			propertyTable.loginValid = false
			propertyTable.loginButtonEnabled = true

			-- Show Response
			if showDialogs then
				LrDialogs.message( result )
			end

			-- Quit
			return;
		end

		-- If here, Login OK
		-- Mark login details as valid
		propertyTable.loginValid = true
		propertyTable.loginButtonEnabled = false

		-- Show Response
		if showDialogs then
			LrDialogs.message( 'Authenticated and connected with Envira successfully.' )
		end
		
	end ) -- /async

end

-- Creates a new Envira Custom Post Type in WordPress, if the Envira Gallery does not already exist
-- If the Envira Gallery exists, updates the title
--
-- @param table  	propertyTable 	Properties (URL, Access Token)
-- @param string 	title 			Post Title (i.e. Lightroom Published Collection Name)
-- @param mixed 	galleryID  		Envira Gallery ID | nil
-- @return mixed Gallery ID | Error Message
function EnviraAPI.createOrUpdateGallery( propertyTable, title, galleryID )

	-- Define vars
	local requestHeaders
	local url
	local params

	-- Assume we'll always create a gallery
	requestHeaders = {
		{ field = 'X-Envira-Lightroom-Access-Token', value = LrStringUtils.encodeBase64( propertyTable.accessToken ) },
		{ field = 'Content-Type', value = 'application/json' },
	}

	-- If the v2 WP REST API option has been selected, use a different URL and parameter structure
	if propertyTable.v2API then
		url = propertyTable.url .. '/wp-json/wp/v2/envira'
		params = '{"title":"' .. title .. '"}'
	else
		url = propertyTable.url .. '/wp-json/posts'
		params = 'title=' .. title .. '&type=envira'
	end

	-- Check if there is any published collection info
	if galleryID == nil then
	else
		-- We previously published this collection
		-- Check the gallery exists on the server
		local result, headers = LrHttp.get( url .. '/' .. galleryID, requestHeaders )
		local response = EnviraAPI.inspectResponse( headers, result )

		if type( response ) == 'boolean' then
			if response == true then
				-- Gallery does exist on server - update the existing gallery
				url = url .. '/' .. galleryID
			end
		end
	end

	-- Make POST request to create/update gallery

	local result, headers = LrHttp.post( url, params, requestHeaders )

	-- Check result
	local remoteGalleryID = EnviraAPI.inspectResponse( headers, result )

	if type( remoteGalleryID ) == 'boolean' then
		-- 200 OK doesn't return an ID, as we are updating an existing resource
		-- Map the galleryID
		remoteGalleryID = galleryID
	end
	
	-- The remote gallery ID to return
	return remoteGalleryID

end

-- Deletes an Envira Gallery
--
-- @param table 	propertyTable 	Properties (URL, Access Token)
-- @param int       galleryID 		Envira Gallery ID to delete
function EnviraAPI.deleteGallery( propertyTable, galleryID )

	-- Send a GET request to the WordPress REST API
	LrTasks.startAsyncTask( function()

		-- Define WP-API URL
		local url = propertyTable.url
		local params
		local method

		-- If the v2 WP REST API option has been selected, use a different URL
		if propertyTable.v2API then
			url = url .. '/wp-json/wp/v2/envira/' .. galleryID
			params = ''
			method = 'DELETE'
		else
			url = url .. '/wp-json/envira-media/' .. galleryID .. '/delete_gallery'
			params = 'id=' .. galleryID
			method = 'POST'
		end

		-- Define request headers
		local requestHeaders = {
			{ field = 'X-Envira-Lightroom-Access-Token', value = LrStringUtils.encodeBase64( propertyTable.accessToken ) },
		}
		
		-- Make POST request
		local result, headers = LrHttp.post( url, params, requestHeaders, method )
		
		-- Return result
		return result

	end ) -- /async

end

-- Upload an image to the WordPress Media Library
--
-- @param table 	propertyTable 	Properties (URL, Access Token)
-- @param string 	pathOrMessage 	Path to Photo to Upload
-- @param string 	title 			Image Title
-- @param string 	caption			Image Caption
-- @param string 	keywords 		Image Keywords (Tags in Envira)
-- @param int       galleryID 		Envira Gallery ID to assign this image to
-- @param int 		remoteImageID 	(optional) The WordPress Media Library ID to overwrite
-- @return mixed    				Image ID | Error Message
function EnviraAPI.uploadImage( propertyTable, pathOrMessage, title, caption, keywords, galleryID, remoteImageID )

	-- Define WP-API URL
	local url = propertyTable.url

	-- If the v2 WP REST API option has been selected, use a different URL
	if propertyTable.v2API then
		url = url .. '/wp-json/wp/v2/media'
	else
		url = url .. '/wp-json/envira-media'
	end
	
	-- Define filename
	local filename = LrPathUtils.leafName( pathOrMessage )

	-- Define request headers
	local requestHeaders = {}
	local requestHeadersCount = 4
	requestHeaders[1] = { field = 'X-Envira-Lightroom-Access-Token', value = LrStringUtils.encodeBase64( propertyTable.accessToken ) }
	requestHeaders[2] = { field = 'Content-Type', value = 'image/jpg' }
	requestHeaders[3] = { field = 'X-Envira-Lightroom-Gallery-ID', value = galleryID }

	-- The Content-Disposition header differs between the WP REST API v1 and v2
	if propertyTable.v2API then
		requestHeaders[4] = { field = 'Content-Disposition', value = 'attachment; filename=' .. filename }
	else
		requestHeaders[4] = { field = 'Content-Disposition', value = 'filename=' .. filename }
	end

	-- Only add these headers if we have values
	-- Windows will break if we try to send blank values
	if title == '' then
	else
		requestHeadersCount = requestHeadersCount + 1
		requestHeaders[requestHeadersCount] = { field = 'X-Envira-Lightroom-Image-Title', value = title }
	end
	if caption == '' then
	else
		requestHeadersCount = requestHeadersCount + 1
		requestHeaders[requestHeadersCount] = { field = 'X-Envira-Lightroom-Image-Caption', value = caption }
	end
	if keywords == '' then
	else
		requestHeadersCount = requestHeadersCount + 1
		requestHeaders[requestHeadersCount] = { field = 'X-Envira-Lightroom-Image-Tags', value = keywords }
	end

	if remoteImageID == nil then
		-- Upload New Image
	else
		-- Replace Existing Image
		requestHeadersCount = requestHeadersCount + 1
		requestHeaders[requestHeadersCount] = { field = 'X-Envira-Lightroom-Image-ID', value = remoteImageID }

		-- The Endpoint differs between the WP REST API v1 and v2
		if propertyTable.v2API then
			-- v2 API: Append the image ID to the request
			url = url .. '/' .. remoteImageID
		end
	end

	-- Read file
	local fileData = LrFileUtils.readFile( pathOrMessage )

	-- Make POST request
	local result, headers = LrHttp.post( url, fileData, requestHeaders )

	-- Check result
	local imageID = EnviraAPI.inspectResponse( headers, result )
	if type( imageID ) == 'string' then
		-- Error
		return imageID
	end

	if type( imageID ) == 'boolean' then
		if imageID == true then
			-- v2 API returns true if editing an existing attachment worked
			-- We need to send the original remote image ID back
			return remoteImageID
		end
	end

	-- This is a number, send it back
	return imageID

end

-- Deletes an image from the WordPress Media Library
--
-- @param table 	propertyTable 	Properties (URL, Access Token)
-- @param int 		remoteImageID 	(optional) The WordPress Media Library ID to delete
-- @return mixed    bool|string    
function EnviraAPI.deleteImage( propertyTable, remoteImageID )
	
	-- Define WP-API URL
	local url = propertyTable.url
	local params
	local method

	if propertyTable.v2API then
		url = url .. '/wp-json/wp/v2/media/' .. remoteImageID
		params = ''
		method = 'DELETE'
	else
		url = url .. '/wp-json/envira-media/' .. remoteImageID .. '/delete_gallery_image'
		params = 'id=' .. remoteImageID
		method = 'POST'
	end

	-- Define request headers
	local requestHeaders = {
		{ field = 'X-Envira-Lightroom-Access-Token', value = LrStringUtils.encodeBase64( propertyTable.accessToken ) },
	}
	
	-- Make POST request
	local result, headers = LrHttp.post( url, params, requestHeaders, method )

	-- Check result
	local result = EnviraAPI.inspectResponse( headers, result )
	
	if type( result ) == 'string' then
		-- Error
		return result
	end

	return result

end


-- Logout by deleting loginValid flag
--
-- @param table 	propertyTable 	Properties (URL, Access Token)
-- @return nil
function EnviraAPI.logout( propertyTable )

	-- Mark login details as invalid
	propertyTable.loginValid = false
	propertyTable.loginButtonEnabled = true

end

-- Checks if the response from the server is JSON, which means
-- that the WP REST API is installed
--
-- @param table headers
-- @return bool Is JSON Response
function EnviraAPI.isJSONResponse( headers )

	-- Check if the returned data is application/json
	-- If not, this means WordPress doesn't have Lightroom Addon and JSON REST API enabled
	for i, header in pairs( headers ) do
		if header.field == 'Content-Type' then
			if string.find( header.value, 'application/json' ) == nil then
				-- Non-JSON response
				-- JSON REST API plugin may not be installed in WordPress
				if showDialogs then
					return false
				end
			end

			-- Response is JSON
			return true
		end
	end

end

-- Inspects the response from WordPress
--
-- @param table headers Headers
-- @param 
function EnviraAPI.inspectResponse( headers, jsonString )

	-- Inspect headers
	-- 200 OK
	if headers.status == 200 then
		return true
	end

	-- 201 Created
	if headers.status == 201 then
		-- Decode the JSON string
		local data = json:decode( jsonString )
		
		-- Return created post ID
		if data.ID == nil then
			-- v2 API
			return data.id
		else
			-- v1 API
			return data.ID
		end
	end

	-- 202 Accepted
	if headers.status == 202 then
		return true
	end

	-- 404 Not Found
	if headers.status == 404 then
		return false
	end

	-- If here, we have an error
	-- Inspect the JSON object to get more information	

	-- Decode the JSON string
	local data = json:decode( jsonString )

	-- v1 API returns:
	-- data[1].code: (string) error code
	-- data[1].message (string) error message
	-- v2 API returns:
	-- data.code
	-- data.message
	if type( data.code ) == 'string' then
		-- v2 API Response
		if data.message == nil then
			return 'Could not connect to your WordPress web site. Please check the WordPress URL is valid, and that the Envira Lightroom Addon Plugin is installed and activated on your WordPress web site.'
		else	
			return data.message
		end	
	else
		-- v1 API Response
		if data[1].message == nil then
			return 'Could not connect to your WordPress web site. Please check the WordPress URL is valid, and that the Envira Lightroom Addon Plugin is installed and activated on your WordPress web site.'
		else	
			return data[1].message
		end
	end

end