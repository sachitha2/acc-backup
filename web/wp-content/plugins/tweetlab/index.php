<?php   
/* 
Plugin Name: Tweetlab
Plugin URI: http://twitter.mageeklab.com 
Description: Display Tweets in an awesome way
Author: MaGeek Lab 
Version: 2.0.2
Author URI: http://www.mageeklab.com  
*/ 

define('MGL_TWITTER_DOMAIN', 'mgl_twitter' );
define('MGL_TWITTER_URL_BASE', plugin_dir_url(__FILE__) );
define('MGL_TWITTER_DIR_BASE', plugin_dir_path( __FILE__ ) );
define('MGL_TWITTER_URL_ASSETS', MGL_TWITTER_URL_BASE . 'assets/' );
define('MGL_TWITTER_INCLUDE_BASE_PATH' , dirname( __FILE__ ) );

/* Include Twitter class */

require_once('MGL_Twitter.class.php');
require_once('MGL_TwitterRepository.class.php');
require_once('MGL_TwitterUtiles.php');
require_once('controller/MGL_Twitter_BaseController.class.php');
require_once('controller/MGL_Twitter_ListController.class.php');
require_once('controller/MGL_Twitter_CardController.class.php');

/* Create admin page */

function mgl_twitter_admin_actions() {  
    add_submenu_page('options-general.php', 'Tweetlab', 'Tweetlab', 'administrator', 'mgl-twitter', 'mgl_twitter_admin'); 
}  
  
add_action('admin_menu', 'mgl_twitter_admin_actions');   

function mgl_twitter_admin() {  
    include('mgl_twitter_admin.php');  
}  

//Add admin scripts
function mgl_twitter_admin_scripts() {
    if ( 'settings_page_mgl-twitter' == get_current_screen() -> id) {

    	wp_enqueue_style("mgl_twitter_admin", MGL_TWITTER_URL_BASE."/assets/css/mgl_twitter_admin.css", false, "1.0", "all");

	}
    
}

add_action('admin_enqueue_scripts', 'mgl_twitter_admin_scripts');

/* Register Widgets */
function mgl_twitter_register_widgets() {     
    // Include Layers Widgets
    if(class_exists('Layers_Widget')) {
        require_once('layers/Layers_MGL_Twitter_Widget.php');
        require_once('layers/Layers_MGL_TwitterCard_Widget.php');
    } else {
        require_once('widgets/MGL_Twitter_Widget.php');
        require_once('widgets/MGL_TwitterCard_Widget.php');
    }
}

add_action('widgets_init', 'mgl_twitter_register_widgets', 50);

/* We need JQuery! */
function mgl_twitter_scripts() {
	if(!is_admin()) {
		wp_enqueue_script("jquery"); 
	}
}

/* Only load if the checkbox is checked */
if(get_option('mgl_twitter_jquery', false) == true) {
    add_action('wp_print_scripts', 'mgl_twitter_scripts');
}

/* Translations */

add_action('plugins_loaded', 'mgl_twitter_translation');

function mgl_twitter_translation() {
    load_plugin_textdomain(MGL_TWITTER_DOMAIN, false, dirname( plugin_basename( __FILE__ ) )  . '/lang/');
}

/* Add to visual composer if is installed */
add_action('plugins_loaded', 'mgl_twitter_add_to_vc');

function mgl_twitter_add_to_vc() {
    require_once('vc_extend.php');
}



?>