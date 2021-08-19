<script type="text/javascript">
jQuery(function($){
	//on-off start
	$(".on_off label").click(function(){
		var id = $(this).attr('id');
		var data = $(this).attr('data');
		if(data == 'y'){
			$('.'+id).show();
		}
		if(data == 'n'){
			$('.'+id).hide();
		}
        $(this).parent('div').children('label').removeClass("on");
        $(this).addClass("on");
    });
	//on-off end

	$('.post-list-tabs-menu li').click(function(){
		var tab = $(this).attr('data-tab-index');
		$('.post-list-tabs-menu li').removeClass('spl_active');
		$(this).addClass('spl_active');
		$('.spl_tabs').hide();
		$('#'+tab).show();
	});
	
	$('#grid_query').click(function(){
		$('#grid_query_div').slideToggle();	
	});
});
</script>
<style type="text/css">
.new_fields{ background:#fff; margin-top:0px; padding:5px 5px 0; border:1px solid #e7e4e4; border-top:0px;}
.widefat.dataa,.widefat.dataa td{ border:0px; box-shadow:none; cursor:move;}
.post-list-tabs-menu li {
    background: none repeat scroll 0 0 #fff;
    cursor: pointer;
    float: left;
    padding: 0.7%;
    text-align: center;
    width: 31.9%;
}
.post-list-tabs-menu li.spl_active {
    background: #002B36;
	color:#fff;
}
.post-list-tabs-menu {
    clear: both;
    list-style: none outside none;
}
.spost_button {
    background: #002b36 !important;
    border: 1px solid #002b36 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    font-size: 15px !important;
    height: 36px !important;
    line-height: 2em !important;
}
input[type="text"]{ width:400px;}
</style>

<?php 
$fb_token = get_option( 'fb_token' );
$youtube_token = get_option( 'youtube_token' );
$vimeo_token = get_option( 'vimeo_token' );
$instagram_token = get_option( 'instagram_token' );

$twit_api_key = get_option( 'twit_api_key' );
$twit_api_secret = get_option( 'twit_api_secret' );
$twit_access_token = get_option( 'twit_access_token' );
$twit_access_token_secret = get_option( 'twit_access_token_secret' );

//$grid = self::sa_social_get_options();
//echo "<pre>";print_r($grid);echo "</pre>";?>

<div id="social_tab" class="spl_tabs" style="display:block;">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">
				<table class="anew_slider_setting">
					<tr>
                    	<th class="sa-setting"><strong class="afl"><?php _e('Facebook Access Token','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="fb_token" value="<?php echo $fb_token;?>"/>
                            <p class="description"><?php _e('Add Facebook Access Token for get facebook feed. <a href="http://plugin.saragna.com/blog/how-to-get-a-facebook-access-token/" target="_blank">How To Get</a>','swp-social');?></p>
                        </td>
                    </tr>
					<tr>
                    	<th class="sa-setting"><strong class="afl"><?php _e('Youtube API key','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="youtube_token" value="<?php echo $youtube_token;?>"/>
                            <p class="description"><?php _e('Add Youtube API key for get Youtube feed. <a href="http://plugin.saragna.com/blog/get-api-key-for-youtube-google-plus/" target="_blank">How To Get</a>','swp-social');?></p>
                        </td>
                    </tr>
					<tr>
						<th class="sa-setting"><strong class="afl"><?php _e('Vimeo Access Token','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="vimeo_token" value="<?php echo $vimeo_token;?>"/>
                            <p class="description"><?php _e('Add Vimeo Access Token for get Vimeo feed. <a href="http://valvepress.com/how-to-generate-a-vimeo-access-token-to-post-from-vimeo-to-wordpress/" target="_blank">How To Get</a>','swp-social');?></p>
                        </td>
                    </tr>
                    <tr>
                    	<th class="sa-setting"><strong class="afl"><?php _e('Instagram Access Token','swp-social');?></strong></th>
                        <td class="sa-setting">
                            <input type="text" name="instagram_token" value="<?php echo $instagram_token;?>"/>
                            <p class="description"><?php _e('You can use your own token or get token authorizing our app. Follow setup guide.<a href="http://plugin.saragna.com/vc-addon/how-to-generate-an-instagram-access-token/" target="_blank">Follow setup guide</a>. also direct access token generate <a href="http://instagram.pixelunion.net/" target="_blank">here</a>','swp-social');?></p>
                        </td>
                    </tr>
					<tr>
						<th style="padding-top: 15px;"><strong>Twitter API Token</strong></th>
						<td style="padding-top: 15px;">If you keep seeing the message 'sorry twitter is down and will be right back', it may be a good idea to add your own tokens below. See how to <a href="http://plugin.saragna.com/blog/how-to-get-api-keys-and-tokens-for-twitter/" target="_blank">get API Keys and Tokens for Twitter</a>. Leave the fields below empty to use our Default API access tokens.</td>
					</tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Consumer Key (API Key)','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_api_key" value="<?php echo $twit_api_key;?>"/>
                        </td>
                    </tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Consumer Secret (API Secret)','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_api_secret" value="<?php echo $twit_api_secret;?>"/>
                        </td>
                    </tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Access Token','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_access_token" value="<?php echo $twit_access_token;?>"/>
                        </td>
                    </tr>
					<tr>
                    	<th><strong class="afl"><?php _e('Access Token Secret','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="twit_access_token_secret" value="<?php echo $twit_access_token_secret;?>"/>
                        </td>
                    </tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<input type="submit" class="button-primary spost_button" value="<?php _e('Save Setting','swp-social');?>" name="ssocial_all_save_social_Setting" style="width:100%;">
