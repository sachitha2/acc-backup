<?php
$msg = false;
$mcode = 0;
$error = false;
if(isset($_POST['ssocial_all_save_social_Setting'])){
	
	//echo "<pre>";print_r($_POST);echo "</pre>";
	update_option( 'fb_token', $_POST['fb_token']);
	update_option( 'youtube_token', $_POST['youtube_token']);	
	update_option( 'vimeo_token', $_POST['vimeo_token']);
	update_option( 'instagram_token', $_POST['instagram_token']);
	
	update_option( 'twit_api_key', $_POST['twit_api_key']);
	update_option( 'twit_api_secret', $_POST['twit_api_secret']);
	update_option( 'twit_access_token', $_POST['twit_access_token']);
	update_option( 'twit_access_token_secret', $_POST['twit_access_token_secret']);
	wp_redirect( 'admin.php?page=social-stream-content-setting' );exit;
}
?>
<style type="text/css">
.sa-setting{ border-bottom:1px solid #ccc; padding-bottom:15px; padding-top:15px;}
a,a:focus,a:active{ outline:none !important; box-shadow:none !important;}
.h2_logo{
	background:url(<?php echo plugins_url('../assets/image/round.png',  __FILE__);?>) !important;
	background-repeat:no-repeat !important;
	box-shadow:none !important;
	background-size:42px 42px;
	display:table;
	font-size: 23px;
    font-weight: 400;
    line-height: 29px;
    padding: 6px 15px 7px 48px !important;
	margin:0 !important;
	border-bottom:0px !important;
}
.widefat td{border-bottom: 1px solid #f1f1f1;}
.aslider_required{ color:red; font-size:18px; vertical-align:middle; margin-left:2px;}
.help_btn{position: absolute; right: 15px; top: 7px;}
.afr{ float:right;}.afl{ float:left;}.apadl0{padding-left:0px !important;}.atal{text-align:left;}
.anew_slider{ margin-bottom:10px;}
.anew_slider th{ width:200px; vertical-align:top; text-align:left;}
.anew_slider1 th{ width:175px; text-align:left; vertical-align:top;}
.anew_slider_setting th{ width:230px; vertical-align:top; text-align:left;}
.delete_level,.delete_level:hover {
    background-color: #fb6f6f;
    border: 1px solid #c10f0f;
    border-radius: 3px;
    color: #fff;
	display:inline-table;
    font-size: 12px;
    font-weight: bold;
    padding: 1px 10px;
    text-shadow: 0 1px #100f0f;
}
.edit_layers,.edit_layers:hover {
    background-color: #37c536;
    border: 1px solid green;
    border-radius: 3px;
    color: #fff;
	cursor:pointer;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 10px;
    text-shadow: 0 1px #5f5959;
}
.spl_tabs{ display:none;}
#grid_query{
	border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
    font-size: 13px;
    padding: 5px 18px;
    text-shadow: 1px 1px #f2f2f2;
}
#grid_query_div:before{
	border-bottom: 8px solid #ccc;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    content: "";
    height: 0;
    left: 48px;
    position: absolute;
    top: -9px;
    width: 0;
}
#grid_query_div{
	background: #f2f2f2 none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    display: none;
    padding: 10px;
	position:relative;
}
.vertical-top th{vertical-align:top;}
.spost_hidden{ display:none;}
</style>

<div class="wrap">
<div class="meta-box-sortables ui-sortable">
	<div class="postbox" style="margin-bottom:10px;">
		<div class="inside" style="padding:0 12px;">
			<h3 class="h2_logo"><a href="javascript:;" style="text-decoration:none; color:#222;"><?php echo esc_html( 'Social Stream Setting' ); ?></a></h3>
		</div>
	</div>
</div>

<form method="post">
<?php include('social-grid-setting.php');?>
</form>
</div>
