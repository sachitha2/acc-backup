<?php

/* Widget */
class MGL_Twitter_Widget extends WP_Widget {

	/* Widget Setup */
	function __construct() {
		parent::__construct(
			'mgl_twitter_widget', // Base ID
			__('Twitter Carousel', MGL_TWITTER_DOMAIN), // Name
			array( 'description' => __( 'By MaGeek Lab', MGL_TWITTER_DOMAIN ), ) // Args
		);
	}

	/* Display Widget */
	function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		$shortcodeAttributes = '';
		foreach( $instance as $argKey => $argVal ){
            if( is_array($argVal)) { continue; }
            $shortcodeAttributes .= " $argKey" . '="'. (string)$argVal . '"';
        }

        echo do_shortcode( '[mgl_twitter ' . $shortcodeAttributes . ' ]' );
		echo $args['after_widget'];
	}

	/* Update Widget */
	function update( $new_instance, $old_instance ) {
		$instance = array();

		foreach ($new_instance as $key => $value) {
			$instance[$key] = ( ! empty( $new_instance[$key] ) ) ? strip_tags( $new_instance[$key] ) : '';
		}

		if($instance['cache'] == '') {
			$instance['cache'] = 0;
		}

		return $instance;
	}

	/*  Widget Form */
	function form( $instance ) {
		
		$title 			= ! empty( $instance['title'] ) ? $instance['title'] : __('Twitter Carousel', MGL_TWITTER_DOMAIN);
		$username 		= ! empty( $instance['username'] ) ? $instance['username'] : '';
		$search 		= ! empty( $instance['search'] ) ? $instance['search'] : '';
		$custom_query 	= ! empty( $instance['custom_query'] ) ? $instance['custom_query'] : '';
		$display 		= ! empty( $instance['display'] ) ? $instance['display'] : 'avatar,name,text';
		$slides 		= ! empty( $instance['slides'] ) ? $instance['slides'] : 1;
		$count 			= ! empty( $instance['count'] ) ? $instance['count'] : 4;
		$template		= ! empty( $instance['template'] ) ? $instance['template'] : 'default';
		$pager			= ! empty( $instance['pager'] ) ? $instance['pager'] : 'true';
		$controls		= ! empty( $instance['controls'] ) ? $instance['controls'] : 'false';
		$autoplay		= ! empty( $instance['autoplay'] ) ? $instance['autoplay'] : 'true';
		$direction		= ! empty( $instance['direction'] ) ? $instance['direction'] : 'ltr';
		$cache			= isset( $instance['cache'] ) ? $instance['cache'] : 900;
		$speed			= ! empty( $instance['speed'] ) ? $instance['speed'] : 2000;
		$pause			= ! empty( $instance['pause'] ) ? $instance['pause'] : 4000;
		
		$boolOptions	= array( 'true' => __('Yes', MGL_TWITTER_DOMAIN), 'false' => __('No', MGL_TWITTER_DOMAIN) );

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Username', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo esc_attr( $username ); ?>" />
		</p> 
        
        <p>
			<label for="<?php echo $this->get_field_id( 'search' ); ?>"><?php _e('Search', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'search' ); ?>" name="<?php echo $this->get_field_name( 'search' ); ?>" value="<?php echo esc_attr( $search ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'custom_query' ); ?>"><?php _e('Custom Query', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_query' ); ?>" name="<?php echo $this->get_field_name( 'custom_query' ); ?>" value="<?php echo esc_attr( $custom_query ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" value="<?php echo esc_attr( $display ); ?>" />
		</p>

 		<p>
			<label for="<?php echo $this->get_field_id( 'slides' ); ?>"><?php _e('Slides', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'slides' ); ?>" name="<?php echo $this->get_field_name( 'slides' ); ?>" value="<?php echo esc_attr( $slides ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Count', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e( 'Template', MGL_TWITTER_DOMAIN ); ?>:</label> 
			<?php 
				mgl_twitter_print_select(
					mgl_twitter_templates(true), 
					esc_attr( $template ), 
					$this->get_field_id( 'template' ), 
					$this->get_field_name( 'template' )
				);
			?>
		</p>

		<p><strong><?php _e('Slider settings', MGL_TWITTER_DOMAIN); ?></strong></p>

		<p>
			<label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Autoplay', MGL_TWITTER_DOMAIN) ?>:</label>
			<?php 
				mgl_twitter_print_select(
					$boolOptions, 
					esc_attr( $autoplay ), 
					$this->get_field_id( 'autoplay' ), 
					$this->get_field_name( 'autoplay' )
				);
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('pager'); ?>"><?php _e('Pager', MGL_TWITTER_DOMAIN) ?>:</label>
			<?php 
				mgl_twitter_print_select(
					$boolOptions, 
					esc_attr( $pager ), 
					$this->get_field_id( 'pager' ), 
					$this->get_field_name( 'pager' )
				);
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('controls'); ?>"><?php _e('Arrows', MGL_TWITTER_DOMAIN) ?>:</label>
			<?php 
				mgl_twitter_print_select(
					$boolOptions, 
					esc_attr( $controls ), 
					$this->get_field_id( 'controls' ), 
					$this->get_field_name( 'controls' )
				);
			?>
		</p>
		<p><strong><?php _e('Advanced settings', MGL_TWITTER_DOMAIN); ?></strong></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'direction' ); ?>"><?php _e( 'Direction', MGL_TWITTER_DOMAIN ); ?>:</label> 
			<?php 
				mgl_twitter_print_select(
					mgl_twitter_directions(), 
					esc_attr( $direction ), 
					$this->get_field_id( 'direction' ), 
					$this->get_field_name( 'direction' )
				);
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e('Speed', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" name="<?php echo $this->get_field_name( 'speed' ); ?>" value="<?php echo esc_attr( $speed ); ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e('Pause', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" name="<?php echo $this->get_field_name( 'pause' ); ?>" value="<?php echo esc_attr( $pause ); ?>" />
		</p> 		
		<p>
			<label for="<?php echo $this->get_field_id( 'cache' ); ?>"><?php _e('Cache', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'cache' ); ?>" name="<?php echo $this->get_field_name( 'cache' ); ?>" value="<?php echo esc_attr( $cache ); ?>" />
		</p>
	<?php
	}
}

register_widget( 'MGL_Twitter_Widget' );

?>