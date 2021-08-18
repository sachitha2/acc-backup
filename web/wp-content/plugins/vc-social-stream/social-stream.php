<?php
/**
 * Plugin Name: Visual Composer - Social Streams With Carousel
 * Description: Visual Composer - Social Streams With Carousel
 * Version: 1.11
 * Author: Hitesh Khunt
 * Author URI: http://www.saragna.com/Hitesh-Khunt
 * Plugin URI: http://plugin.saragna.com/vc-addon
 * License: GPLv2 or later
 Text Domain: svc_social_feed
 *
 */

$svgrVersion = "1.11";

$currentFile = __FILE__;

$currentFolder = dirname($currentFile);

add_action('admin_init','svc_social_Init_Addon');
require_once( 'inc/add-param.php' );
require_once( 'inc/all_function.php' );
require_once( 'addons/social-stream/admin.php' );

add_action( 'admin_enqueue_scripts', 'svc_social_admin_css_js' );
function svc_social_admin_css_js(){
	wp_enqueue_style( 'vc-social-admin-css', plugins_url( ltrim( 'assets/css/admin.css', '/' ), __FILE__ ), array(), '' );
}

function svc_social_Init_Addon() {
	$required_vc 	= '3.9.9';
	if (defined('WPB_VC_VERSION')){
		if (version_compare($required_vc, WPB_VC_VERSION, '>')) {
			add_action('admin_notices', 'svc_social_Admin_Notice_Version');
		}
	}else{
		add_action('admin_notices', 'svc_social_Admin_Notice_Activation');
	}
}
function svc_social_Admin_Notice_Version() {
		echo '<div class="updated"><p>The <strong>Visual Composer - Social Stream</strong> add-on requires <strong>Visual Composer</strong> version 4.0.0 or greater.</p></div>';	
	}
function svc_social_Admin_Notice_Activation() {
	echo '<div class="updated"><p>The <strong>Visual Composer - Social Stream</strong> add-on requires the <strong>Visual Composer</strong> Plugin installed and activated.</p></div>';
}

add_action('admin_menu', 'sa_social_stream_add_animate_setting_page');
function sa_social_stream_add_animate_setting_page() {
	add_menu_page( 'Social Setting', 'Social Setting', 'manage_options', 'social-stream-content-setting', 'vc_social_stream_social_setting_page', plugins_url( 'assets/image/icon.png',  __FILE__));
}

function vc_social_stream_social_setting_page(){
	global $wpdb;
	include('inc/social-setting.php');
}

function vc_social_stream_admin_notice__success() {
	$fb_token = get_option( 'fb_token' );
	$youtube_token = get_option( 'youtube_token' );	
	$vimeo_token = get_option( 'vimeo_token' );
	$instagram_token = get_option( 'instagram_token' );
	
	$twit_api_key = get_option( 'twit_api_key' );
	$twit_api_secret = get_option( 'twit_api_secret' );
	$twit_access_token = get_option( 'twit_access_token' );
	$twit_access_token_secret = get_option( 'twit_access_token_secret' );
	if(!$fb_token && !$youtube_token && !$vimeo_token && !$instagram_token && !$twit_api_key){?>
    <div class="notice notice-success is-dismissible">
        <p>Please add Social Credential in Social Setting. <a href="<?php echo get_site_url();?>/wp-admin/admin.php?page=social-stream-content-setting">Setup here</a></p>
    </div>
    <?php }
}
add_action( 'admin_notices', 'vc_social_stream_admin_notice__success' );

add_action('init', 'do_output_buffer_vc_soc');
if(!function_exists('do_output_buffer')){
	function do_output_buffer_vc_soc() {
		ob_start();
	}
}
?>
