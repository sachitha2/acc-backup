--[[----------------------------------------------------------------------------

Info.lua
Summary information for Lightroom Envira plug-in

------------------------------------------------------------------------------]]

return {

	-- Required SDK version
	LrSdkVersion = 3.0,
	LrSdkMinimumVersion = 3.0,

	-- Plugin Identifier and Name
	LrToolkitIdentifier = 'com.adobe.lightroom.export.envira',
	LrPluginName = LOC "$$$/Envira/PluginName=Envira",
	
	-- Define the Lightroom Export Service Provider
	LrExportServiceProvider = {
		title = "Envira",
		file = 'EnviraExportServiceProvider.lua'
	},
	
	VERSION = { major=1, minor=0, revision=3, build=1, },

}