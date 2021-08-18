<?php

class MGL_Twitter {
	static $add_script;
	static $add_style;
	static $scripts = array();
	static $styles = array();
	static $displays = array(
		'horizontal' => 'Horizontal',
		'vertical'	 => 'Vertical'
		);

	public function __construct(){
		//Register and Styles and Scripts
        add_action('wp_enqueue_scripts', array( $this, 'registerStylesAndScripts' ), 15 );

        //Shortcodes
        add_shortcode('mgl_twitter', array( $this, 'twitterShortcodes' ) );
        add_shortcode('mgl_twitter_card', array( $this, 'twitterShortcodes' ) );
	}

	public function registerStylesAndScripts() {
		wp_register_style('mgl_twitter', MGL_TWITTER_URL_ASSETS . 'css/mgl_twitter.css');
		wp_register_script('mgl_owlcarousel', MGL_TWITTER_URL_ASSETS . 'js/libs/owl.carousel.min.js', array('jquery'), '2.0', true);
		wp_register_script('mgl_bxslider', MGL_TWITTER_URL_ASSETS . 'js/libs/jquery.bxslider.min.js', array('jquery'), '4.1.2', true);
		wp_register_script('mgl_twitter_slider', MGL_TWITTER_URL_ASSETS . 'js/mgl_twitter_slider.js', array('mgl_owlcarousel'), '1.0', true);
		wp_register_script('mgl_twitter_slider_vertical', MGL_TWITTER_URL_ASSETS . 'js/mgl_twitter_slider_vertical.js', array('mgl_bxslider'), '1.0', true);
	}

	public function twitterShortcodes($atts, $content = null, $tagName) {
		
		try{
            $slider = $this->getGalleryByTagName( $tagName, $atts );
            
            return $slider->render();
        }
        catch( Exception $e){
            _e('MGL Twitter error: '.$e->getMessage() );
        }

	}

	private function getGalleryByTagName( $tagName, $atts ){
        switch ($tagName) {
            case 'mgl_twitter':
            	$atts = shortcode_atts(array(
					'username'		=> '',
					'search'		=> '',
					'count'			=> 12,
					'cache'			=> 900,
					'direction'		=> 'ltr',
					'slides'		=> 4,
					'autoplay'		=> 'true',
					'pause'			=> 2000,
					'speed'			=> 1000,
					'controls'		=> 'false',
					'pager'			=> 'true',
					'template'		=> 'default',
					'display'		=> 'avatar,name,text',
					'custom_query'	=> ''
				), $atts);


                $slider = new MGL_Twitter_ListController( $atts );
                break;
            
            case 'mgl_twitter_card':
            	$atts = shortcode_atts(array(
					'username'		=> '',
					'cache'			=> 900,
					'button'		=> 'true',
					'template'		=> 'default',
					'display'		=> 'banner,avatar,name,description,meta',
				), $atts);


                $slider = new MGL_Twitter_CardController( $atts );
                break;

            default:
                $slider = false;
                break;
        }

        return $slider;
    }

}

$mglTwitter = new MGL_Twitter();

?>