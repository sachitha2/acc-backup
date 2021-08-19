<?php
/**
 * @package Addon Composer
 * @author UniteCMS.net / Valiano
 * @copyright (C) 2012 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('ADDON_LIBRARY_INC') or die('Restricted access');

?>

<div id="dialog_video" class="dialog-video" title="<?php _e("Add Media",ADDONLIBRARY_TEXTDOMAIN)?>" data-title="<?php _e("Add Media",ADDONLIBRARY_TEXTDOMAIN)?>" style="display:none">
	
	<!-- Type chooser -->
		
	<div id="video_dialog_loader" class="video-dialog-loader loader_text" style="display:none;">
		<?php _e("Loading Item Data...",ADDONLIBRARY_TEXTDOMAIN)?>
	</div>
	
	<div id="video_dialog_inner">
				
		<div id="video_type_chooser" class="video-type-chooser">
			<div class="choose-video-type" style="float:left">
				<?php _e("Choose video type",ADDONLIBRARY_TEXTDOMAIN)?>
			</div>
			<div style="float:left; height:35px;line-height:15px;margin-top:20px;margin-left:30px">
				<label for="video_radio_youtube"><?php _e("Youtube",ADDONLIBRARY_TEXTDOMAIN)?></label>
				<input type="radio" checked id="video_radio_youtube" data-type="youtube" class="check-video-type" name="video_select">
				
				<label for="video_radio_vimeo"><?php _e("Vimeo",ADDONLIBRARY_TEXTDOMAIN)?></label>
				<input type="radio" id="video_radio_vimeo" data-type="vimeo" class="check-video-type" name="video_select">
				
				<label for="video_radio_html5"><?php _e("HTML5",ADDONLIBRARY_TEXTDOMAIN)?></label>
				<input type="radio" id="video_radio_html5" data-type="html5video" class="check-video-type" name="video_select">			
				
				<label for="video_radio_wistia"><?php _e("Wistia",ADDONLIBRARY_TEXTDOMAIN)?></label>
				<input type="radio" id="video_radio_wistia" data-type="wistia" class="check-video-type" name="video_select">
			</div>
			<div style="clear:both"></div>			
			
			<hr>
		</div>


		<div id="video-dialog-wrap" class="video_left">
	
			<!-- Youtube block -->		
			<div id="video_block_youtube" class="video-select-block">
			
				<div class="video-title">
					<?php _e("Enter Youtube ID or URL",ADDONLIBRARY_TEXTDOMAIN)?>:
				</div>
				
				<input type="text" id="dv_youtube_id" class="input_search" value=""></input>
				
				<input type="button" id="dv_button_youtube_search" class="unite-button-primary button-search" value="search">
							
				<div id="dv_youtube_loader" class="loader_round dv_loader_search" style="display:none"></div>
				
				<div class="unite-clear"></div>
				
				<div class="video_example">
				<?php _e("example",ADDONLIBRARY_TEXTDOMAIN)?>:  <?php echo GlobalsUC::YOUTUBE_EXAMPLE_ID?>
				</div>
				
			</div>
		
		
			<!-- Vimeo block -->
			
			<div id="video_block_vimeo" class="video-select-block" style="display:none;" >
				
				<div class="video-title">
					<?php _e("Enter Vimeo ID or URL",ADDONLIBRARY_TEXTDOMAIN)?>:
				</div>
				
				<input type="text" id="dv_vimeo_id" class="input_search" value=""></input>
				
				<input type="button" id="dv_button_vimeo_search" class="unite-button-primary button-search" value="search">
							
				<div id="dv_vimeo_loader" class="loader_round dv_loader_search" style="display:none"></div>
				
				<div class="unite-clear"></div>
				
				<div class="video_example">
					<?php _e("example",ADDONLIBRARY_TEXTDOMAIN)?>:  <?php echo GlobalsUC::VIMEO_EXAMPLE_ID?>
				</div>
				
			</div>
			
			
			<!-- Html 5 block -->
			
			<div id="video_block_html5" class="video-select-block" style="display:none;">
				
					<div class="video-title">				
					
						<?php _e("Video MP4 Url", ADDONLIBRARY_TEXTDOMAIN)?>:
						<a id="dv_link_example_mp4" href="javascript:void(0)"  class="dv_link_change dv_put_example" data-targetid="dv_html5_url_mp4" data-example="http://vjs.zencdn.net/v/oceans.mp4"><?php _e("put example", ADDONLIBRARY_TEXTDOMAIN)?></a>
					
					</div>
					<input type="text" id="dv_html5_url_mp4" value="" class="input-url-long"></input>
					
					<div class="video-title">								
					
						<?php _e("Video WEBM Url", ADDONLIBRARY_TEXTDOMAIN)?>:
						<a id="dv_link_example_webm" href="javascript:void(0)"  class="dv_link_change dv_put_example" data-targetid="dv_html5_url_webm" data-example="http://video-js.zencoder.com/oceans-clip.webm"><?php _e("put example", ADDONLIBRARY_TEXTDOMAIN)?></a>
					
					</div>
					<input type="text" id="dv_html5_url_webm" value="" class="input-url-long"></input>
		
					<div class="video-title">
						<?php _e("Video OGV Url", ADDONLIBRARY_TEXTDOMAIN)?>:
						<a id="dv_link_example_ogv" href="javascript:void(0)"  class="dv_link_change dv_put_example" data-targetid="dv_html5_url_ogv" data-example="http://video-js.zencoder.com/oceans-clip.ogv"><?php _e("put example", ADDONLIBRARY_TEXTDOMAIN)?></a>
					</div>
					<input type="text" id="dv_html5_url_ogv" value="" class="input-url-long"></input>

			</div>
			
			<!-- Wistia block -->
			<div id="video_block_wistia" class="video-select-block">
				
				<div class="video-title">
					<?php _e("Enter Wistia ID",ADDONLIBRARY_TEXTDOMAIN)?>:
				</div>
				
				<input type="text" id="dv_wistia_id" class="input_search" value=""></input>
				
				<input type="button" id="dv_button_wistia_search" class="unite-button-primary button-search" value="search">
							
				<div id="dv_wistia_loader" class="loader_round dv_loader_search" style="display:none"></div>
				
				<div class="unite-clear"></div>
				
				<div class="video_example">
				<?php _e("example",ADDONLIBRARY_TEXTDOMAIN)?>:  <?php echo GlobalsUC::WISTIA_EXAMPLE_ID?>
				</div>
				
			</div>
			
			
			<div class="unite-clear"></div>
					
			<!-- Video controls -->
			
			<div class="video_props video_props_left mtop_20" style="display:none;">
				
					<hr>
	
					<div class="video-title">
						<?php _e("Preview Image Url",ADDONLIBRARY_TEXTDOMAIN)?>:
						
						<a id="dv_link_change_image" href="javascript:void(0)"  class="dv_link_change" data-dialogtitle="<?php _e("Select new preview image", ADDONLIBRARY_TEXTDOMAIN)?>"><?php _e("change", ADDONLIBRARY_TEXTDOMAIN)?></a>
					
					</div>
	
					<input type="text" id="dv_input_video_preview" class="input-url">
				
					<div class="video-title mtop_20">
						<?php _e("Thumb Image Url",ADDONLIBRARY_TEXTDOMAIN)?>:
						
						<a id="dv_link_change_thumb" href="javascript:void(0)" class="dv_link_change" data-dialogtitle="<?php _e("Select new thumb image", ADDONLIBRARY_TEXTDOMAIN)?>"><?php _e("change", ADDONLIBRARY_TEXTDOMAIN)?></a>
					</div>
	
					<input type="text" id="dv_input_video_thumb" class="input-url"> 
					
					<span id="dv_loader_thumb" class="loader_round" style="display:none"></span>
										
					<div id="dv_video_thumb" class="dv-thumb-image"></div>
			</div>
			
		</div> <!-- video_left end-->
	
		<input id="dv_button_video_add" type="button" class="unite-button-primary video_props" value="<?php _e("Add Video", ADDONLIBRARY_TEXTDOMAIN)?>" data-textadd="<?php _e("Add Video", ADDONLIBRARY_TEXTDOMAIN)?>" data-textupdate="<?php _e("Update Video", ADDONLIBRARY_TEXTDOMAIN)?>">		

		<div id="dv_error_message_bottom"  style="display:none"></div>
		
		<div id="video_right" class="video_right video_props" style="display:none">
			
				<div class="video-title">				
					<?php _e("Title",ADDONLIBRARY_TEXTDOMAIN)?>:
				</div>
				
				<input type="text" id="dv_input_video_title" class="input-title">
				
				<div id="dv_preview_image" class="dv-preview-image"></div>
				
				<div class="video-title">				
					<?php _e("Description",ADDONLIBRARY_TEXTDOMAIN)?>:
				</div>
							
				<textarea id="dv_input_video_desc" class="input-description"></textarea>
				
		</div>		
	
		<div class="unite-clear"></div>	
		
		<div id="dv_error_message" class="dv_error_message mtop_25" style="display:none;" data-notfound="<?php _e("Video not found or error occured. Please search again.")?>"></div>
		
		
	</div>	<!-- dialog inner -->
	
	
</div>
