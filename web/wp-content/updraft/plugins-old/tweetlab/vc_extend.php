<?php 

add_action('init', 'mgl_twitter_in_vc');

if ( defined( 'WPB_VC_VERSION' ) ) {
  mgl_twitter_in_vc();
}

function mgl_twitter_in_vc() {
  if ( defined( 'WPB_VC_VERSION' ) ) {

    $boolOptions = array( __('Yes', MGL_TWITTER_DOMAIN) => 'true', __('No', MGL_TWITTER_DOMAIN)  => 'false' );

  	vc_map( array(
        "name"              => __('Twitter Carousel', MGL_TWITTER_DOMAIN),
        "description"       => __("By MaGeek Lab", MGL_TWITTER_DOMAIN),
        "base"              => "mgl_twitter",
        "icon"              => "mgl_twitter_vc_extend",
        "category"          => __('Social', 'js_composer'),
        'admin_enqueue_css' => array(plugins_url('assets/css/mgl_vc_extend_admin.css', __FILE__)),
        "params"            => array(
        	array(
                "type"          => "textfield",
                "holder"        => "strong",
                "heading"       => __("Username", MGL_TWITTER_DOMAIN),
                "param_name"    => "username"
				),
        	array(
                "type"          => "textfield",
                "holder"        => "strong",
                "heading"       => __("Search", MGL_TWITTER_DOMAIN),
                "param_name"    => "search"
				),
            array(
                "type"          => "textfield",
                "holder"        => "strong",
                "heading"       => __("Custom Query", MGL_TWITTER_DOMAIN),
                "param_name"    => "custom_query",
                ),
            array(
                "type"          => "textfield",
                "heading"       => __("Slides", MGL_TWITTER_DOMAIN),
                "param_name"    => "slides",
                "value"         => 4
                ),
        	array(
                "type"          => "textfield",
                "heading"       => __("Count", MGL_TWITTER_DOMAIN),
                "param_name"    => "count",
                "value"         => 12
                ),
            array(
                "type"          => "textfield",
                "heading"       => __("Display", MGL_TWITTER_DOMAIN),
                "param_name"    => "display",
                "value"         => "avatar,name,text"
                ),
    		array(
                "type"          => "dropdown",
                "heading"       => __("Autoplay carousel", MGL_TWITTER_DOMAIN),
                "param_name"    => "autoplay",
                "value"         => $boolOptions,
                "std"           => "true",
                "group"         => __("Controls", MGL_TWITTER_DOMAIN),
              	),
    		array(
                "type"          => "dropdown",
                "heading"       => __("Arrows", MGL_TWITTER_DOMAIN),
                "param_name"    => "controls",
                "value"         => $boolOptions,
                "std"           => "false",
                "group"         => __("Controls", MGL_TWITTER_DOMAIN),
              	),
    		array(
                "type"          => "dropdown",
                "heading"       => __("Pager", MGL_TWITTER_DOMAIN),
                "param_name"    => "pager",
                "value"         => $boolOptions,
                "std"           => "true",
                "group"         => __("Controls", MGL_TWITTER_DOMAIN),
              	),
            array(
                "type"          => "dropdown",
                "heading"       => __("Template", MGL_TWITTER_DOMAIN),
                "param_name"    => "template",
                "value"         => mgl_twitter_templates(),
                "std"           => "default"
                ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Direction", MGL_TWITTER_DOMAIN),
                "param_name"    => "direction",
                "value"         => mgl_twitter_directions(true),
                "group"         => __("Advanced", MGL_TWITTER_DOMAIN),
                ),
            array(
                "type"          => "textfield",
                "heading"       => __("Pause", MGL_TWITTER_DOMAIN),
                "param_name"    => "pause",
                "value"         => 4000,
                "group"         => __("Advanced", MGL_TWITTER_DOMAIN),
                ),
            array(
                "type"          => "textfield",
                "heading"       => __("Speed", MGL_TWITTER_DOMAIN),
                "param_name"    => "speed",
                "value"         => 2000,
                "group"         => __("Advanced", MGL_TWITTER_DOMAIN),
                ),
            array(
                "type"          => "textfield",
                "heading"       => __("Cache", MGL_TWITTER_DOMAIN),
                "param_name"    => "cache",
                "value"         => 900,
                "group"         => __("Advanced", MGL_TWITTER_DOMAIN),
                )
        )
      ) );

	vc_map( array(
        "name"          => __("Twitter Card", MGL_TWITTER_DOMAIN),
        "description"   => __("By MaGeek Lab", MGL_TWITTER_DOMAIN),
        "base"          => 'mgl_twitter_card',
        "icon"          => "mgl_twitter_vc_extend",
        "category"      => __('Social', 'js_composer'),
        'admin_enqueue_css' => array(plugins_url('css/mgl_vc_extend_admin.css', __FILE__)),
        "params" => array(
        	array(
                "type" => "textfield",
                "holder" => "strong",
                "heading" => __("Username", MGL_TWITTER_DOMAIN),
                "param_name" => "username",
                ),
    		array(
				"type" => "textfield",
				"heading" => __("Display", "mgl_twitter"),
				"param_name" => "display",
				"value" => 'banner,avatar,name,description,meta',
	            ),
    		array(
                "type"          => "dropdown",
                "heading"       => __("Button", MGL_TWITTER_DOMAIN),
                "param_name"    => "button",
                "value"         => $boolOptions,
                "std"           => "true"
                ),
            array(
                "type"          => "dropdown",
                "heading"       => __("Template", MGL_TWITTER_DOMAIN),
                "param_name"    => "template",
                "value"         => mgl_twitter_templates(),
                "std"           => "default"
                ),
            array(
                "type" => "textfield",
                "heading" => __("Cache", MGL_TWITTER_DOMAIN),
                "param_name" => "cache",
                "value" => 900
                ),
        )
      ) );
  }
}

?>