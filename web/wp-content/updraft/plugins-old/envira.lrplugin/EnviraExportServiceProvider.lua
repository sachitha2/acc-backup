--[[----------------------------------------------------------------------------

EnviraPublishServiceProvider.lua
Publish service provider description for Lightroom Envira uploader.

------------------------------------------------------------------------------]]

-- Lightroom SDK
local LrBinding = import 'LrBinding'
local LrDialogs = import 'LrDialogs'
local LrFileUtils = import 'LrFileUtils'
local LrPathUtils = import 'LrPathUtils'
local LrView = import 'LrView'

-- Debugging - use LrLogger:info( inspect( var ) )
--local LrLogger = import 'LrLogger'( 'EnviraLightroom' )
--LrLogger:enable( 'logfile' ) -- See /Documents/EnviraAPI.log
--local inspect = require 'inspect'

-- Common shortcuts
local bind = LrView.bind
local share = LrView.share

-- Envira API
require 'EnviraAPI'

--============================================================================--
-- Properties
--============================================================================--

-- Setup provider object
local publishServiceProvider = {}

-- Default fields. These are inherited by each propertyTable,
-- so make sure they match each edit_field bind string (value = bind 'url')
publishServiceProvider.exportPresetFields = {
	{ key = 'url', default = "" },
	{ key = 'accessToken', default = "" },
	{ key = 'v2API', default = false },
	{ key = 'loginValid', default = false },
	{ key = 'loginButtonEnabled', default = true }
}

-- Disable export to temporary location
publishServiceProvider.canExportToTemporaryLocation = false

-- Hide Sections on Publishing Manager
publishServiceProvider.hideSections = { 'exportLocation' }

-- Supported file formats
publishServiceProvider.allowFileFormats = { 'JPEG' }

-- Supported color space
publishServiceProvider.allowColorSpaces = { 'sRGB' }
	
-- Disable print resolution controls
publishServiceProvider.hidePrintResolution = true

-- Disable video export
publishServiceProvider.canExportVideo = false

-- Icon
publishServiceProvider.small_icon = 'icon.png'

-- Support custom sort ordering
publishServiceProvider.supportsCustomSortOrder = true

-- Only support Publish (don't support Export)
publishServiceProvider.supportsIncrementalPublish = 'only'

--============================================================================--
-- Functions: Dialog
--============================================================================--

-- Defines sections for the top of the Publishing Manager Dialog when this Plugin is selected
-- Note: "Publish Service" will always appear at the very top
-- We use this to ask for WordPress Login details
--
-- @param propertyTable Settings (such as WP URL User, Pass )
function publishServiceProvider.sectionsForTopOfDialog( viewFactory, propertyTable )

	return {

		-- Section
		{
			-- Section Title
			title = "WordPress Authentication",
			synopsis = "Your WordPress web site URL and Envira Lightroom Addon Access Token.",

			-- URL Row
			viewFactory:row {
				-- Spacing
				spacing = viewFactory:label_spacing(),

				-- Label
				viewFactory:static_text {
					title = 'WordPress URL:',
					alignment = 'left',
				},

				-- Input
				viewFactory:edit_field {
					value = bind 'url',
					alignment = 'right',
					fill_horizontal = 1,
				},
			},

			-- Access Token Row
			viewFactory:row {
				-- Spacing
				spacing = viewFactory:label_spacing(),

				-- Label
				viewFactory:static_text {
					title = 'Access Token:',
					alignment = 'left',
				},

				-- Input
				viewFactory:edit_field {
					value = bind 'accessToken',
					alignment = 'right',
					fill_horizontal = 1,
				},
			},

			-- v2 API Row
			viewFactory:row {
				-- Spacing
				spacing = viewFactory:label_spacing(),

				-- Label
				viewFactory:static_text {
					title = 'Use WP REST API v2:',
					alignment = 'left',
				},

				-- Input
				viewFactory:checkbox {
					value = bind 'v2API',
					alignment = 'left',
				},
			},

			-- Access Token Help Row
			viewFactory:row {
				-- Label
				viewFactory:static_text {
					title = 'To obtain your Access Token, visit your WordPress Administration Interface and ensure the Envira Lightroom Addon is installed and active.  Then navigate to Envira > Settings > Lightroom, copy your Access Token and paste it in the field above.',
					alignment = 'left',
					wrap = true,
					width_in_chars = 50,
					height_in_lines = 3,
				},
			},

			-- Submit
			viewFactory:row {
				-- Spacing
				spacing = viewFactory:control_spacing(),

				-- Authenticate (Login)
				viewFactory:push_button {
					width = tonumber( LOC "$$$/locale_metric/Envira/ExportDialog/LoginButton/Width=90" ),
					title = "Authenticate",
					enabled = bind 'loginButtonEnabled',
					action = function()
						-- Fired when button clicked
						-- Check we have required fields
						if propertyTable.url == '' then
							LrDialogs.message( 'Please enter your WordPress URL' )
							return
						end
						if propertyTable.accessToken == '' then
							LrDialogs.message( 'Please enter your Envira Lightroom Access Token. You can obtain this by visiting your WordPress web site, and navigating to Envira > Settings > Lightroom.' )
							return
						end

						-- If here, we have required details - attempt to login
						EnviraAPI.login( propertyTable, true )
					end,
				},

				-- Logout
				viewFactory:push_button {
					width = tonumber( LOC "$$$/locale_metric/Envira/ExportDialog/LoginButton/Width=90" ),
					title = "Logout",
					enabled = bind 'loginValid',
					action = function()
						-- Fired when button clicked
						-- Logout
						EnviraAPI.logout( propertyTable, true )
					end,
				},
			},
		}

	}

end

-- Sections for bottom of dialog window
function publishServiceProvider.sectionsForBottomOfDialog( viewFactory, propertyTable )
	
end

-- Run when the publish process is initialized
function publishServiceProvider.startDialog( propertyTable )

	propertyTable:addObserver( 'loginValid', function() loginValidChanged( propertyTable, key, newValue ) end )
	loginValidChanged( propertyTable, 'loginValid', propertyTable.loginValid )

	-- Run the login process to ensure loginValid gets populated
	EnviraAPI.login( propertyTable, false )

end

-- Disables the Save button in the dialog, if the loginValid flag is not true
-- Also displays why the user can't save their settings yet.
function loginValidChanged( propertyTable, key, newValue )

	-- If not logged in, define reason we can't save
	-- This will disable the Save button in the dialog
	if not propertyTable.loginValid then
		if propertyTable.accessToken == '' then
			-- No access token supplied
			propertyTable.LR_cantExportBecause = "You haven't authenticated with your WordPress web site yet."
		else
			-- Access token invalid
			propertyTable.LR_cantExportBecause = "The Access Token supplied is invalid."
		end

		return
	end
	
	-- If here, no reason why we can't save
	-- This will enable the Save button in the dialog
	propertyTable.LR_cantExportBecause = nil
	propertyTable.loginButtonEnabled = false

end

-- Run when publish process is terminated
function publishServiceProvider.endDialog( propertyTable, why )
	
end

-- Upload photos to Envira Gallery, creating a new Gallery if one does not already exist
--
-- @param ??? 				functionContext
-- @param LRExportContext 	exportContext 	Export Data
function publishServiceProvider.processRenderedPhotos( functionContext, exportContext )

	-- Get data from exportContext
	local exportSession = exportContext.exportSession
	local propertyTable = assert( exportContext.propertyTable )
	local publishedCollectionInfo = exportContext.publishedCollectionInfo
	local publishedGalleryId = '' -- Assume we don't have an Envira Gallery ID

	-- Create/update Envira Gallery
	publishedGalleryId = EnviraAPI.createOrUpdateGallery( propertyTable, publishedCollectionInfo.name, publishedCollectionInfo.remoteId )

	-- Check we have a number for the published gallery ID
	-- If we don't, it means something went wrong so we need to stop
	if type( publishedGalleryId ) == 'string' then
		-- Show the error and exit
		LrDialogs.message( publishedGalleryId )
		return
	end

	-- If here, we have an Envira Gallery ID
	-- Store it against the published collection
	exportSession:recordRemoteCollectionId( publishedGalleryId )

	-- Get the # of photos.
	local nPhotos = exportSession:countRenditions()
	
	-- Set progress title.
	local progressScope = exportContext:configureProgress {
						title = nPhotos > 1
									and LOC( "$$$/Envira/Publish/Progress=Publishing ^1 photos to Envira", nPhotos )
									or LOC "$$$/Envira/Publish/Progress/One=Publishing one photo to Envira",
					}

	-- Iterate through photo renditions (that's photos the user wants to publish to Envira)
	for i, rendition in exportContext:renditions { stopIfCanceled = true } do

		-- Wait for photo rendering
		local success, pathOrMessage = rendition:waitForRender()
		
		-- Do something with the rendered photo	
		if success then
			-- When success is true, pathOrMessage contains path of rendered file

			-- Get the photo object
			local photo = rendition.photo

			-- Get metadata: title, caption, keywords

			-- Get title according to the options in plugin's Title section
			local title
			title = photo:getFormattedMetadata( 'title' )		
			if ( not title or #title == 0 ) then
				title = LrPathUtils.leafName( pathOrMessage )
			end

			-- Get caption
			local caption = photo:getFormattedMetadata( 'caption' )

			-- Get keywords
			local keywords = photo:getFormattedMetadata( 'keywordTagsForExport' )

			-- Upload image, getting the photo ID by response
			local imageID = EnviraAPI.uploadImage( propertyTable, pathOrMessage, title, caption, keywords, publishedGalleryId, rendition.publishedPhotoId )
			
			-- Check the image for errors
			if type( imageID ) == 'string' then
				LrDialogs.message( imageID )
				return
			end

			-- Store the WordPress Media Library Image ID against the local image
			-- Even if we're overwriting an existing image in the WordPress Media Library,
			-- we still store the result as the WordPress Media Library may no longer have
			-- the existing image if the user deleted it
			rendition:recordPublishedPhotoId( imageID )
		else
			-- Error
			LrDialogs.message( 'An error occured' )
			return
		end 

	end -- /do loop

	-- Mark progress as completed
	progressScope:done()

end

-- Delete photos from Envira Gallery
--
-- @param PropertyTable propertyTable 			(URL, Access Token)
-- @param array 		arrayOfRemotePhotoIds 	The remote photo IDs to delete from WordPress
-- @param function 		deletedCallback 		Lightroom internal callback
function publishServiceProvider.deletePhotosFromPublishedCollection( propertyTable, arrayOfRemotePhotoIds, deletedCallback )

	-- Iterate through the images to delete
	for i, publishedPhotoId in ipairs( arrayOfRemotePhotoIds ) do

		-- Attempt to delete from WordPress Media Library
		local result = EnviraAPI.deleteImage( propertyTable, publishedPhotoId )
		if type( result ) == 'string' then
			-- Error
			LrDialogs.message( result )
		else
			-- Deletion successful
			deletedCallback( publishedPhotoId )
		end

	end
	
end

-- Deletes an Envira Gallery from WordPress, including all its images, when a collection is deleted in Lightroom
--
-- @param publishSettings
-- @param info
function publishServiceProvider.deletePublishedCollection( propertyTable, info )

	import 'LrFunctionContext'.callWithContext( 'publishServiceProvider.deletePublishedCollection', function( context )
	
		local progressScope = LrDialogs.showModalProgressDialog {
							title = LOC( "$$$/Envira/DeletingCollectionAndContents=Deleting Envira Gallery ^[^1^]", info.name ),
							functionContext = context }

		-- Delete Envira Gallery
		if info and info.remoteId then
			EnviraAPI.deleteGallery( propertyTable, info.remoteId )
		end
			
	end )

end

-- Return publishServiceProvider
return publishServiceProvider