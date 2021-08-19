<?php

/* Widget */
class MGL_TwitterCard_Widget extends WP_Widget {

	/* Widget Setup */
	function __construct() {
		parent::__construct(
			'mgl_twitter_card_widget', // Base ID
			__('Twitter Card', MGL_TWITTER_DOMAIN),// Name
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

        echo do_shortcode( '[mgl_twitter_card ' . $shortcodeAttributes . ' ]' );
		echo $args['after_widget'];
	}

	/* Update Widget */
	function update( $new_instance, $old_instance ) {
		$instance = array();

		foreach ($new_instance as $key => $value) {
			$instance[$key] = ( ! empty( $new_instance[$key] ) ) ? strip_tags( $new_instance[$key] ) : '';
		}

		return $instance;
	}

	/*  Form Settings */
	function form( $instance ) {

		$title 			= ! empty( $instance['title'] ) ? $instance['title'] : __('Twitter Card', MGL_TWITTER_DOMAIN);
		$username 		= ! empty( $instance['username'] ) ? $instance['username'] : '';
		$display 		= ! empty( $instance['display'] ) ? $instance['display'] : 'banner,avatar,name,description,meta';
		$template		= ! empty( $instance['template'] ) ? $instance['template'] : 'default';
		$cache			= ! empty( $instance['cache'] ) ? $instance['cache'] : 900;
		$button			= ! empty( $instance['button'] ) ? $instance['button'] : 'true';
		
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
			<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" value="<?php echo esc_attr( $display ); ?>" />
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
		
		<p>
			<label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Show button', MGL_TWITTER_DOMAIN); ?>:</label>
			<?php 
				mgl_twitter_print_select(
					$boolOptions, 
					esc_attr( $button ), 
					$this->get_field_id( 'button' ), 
					$this->get_field_name( 'button' )
				);
			?>
		</p>
		
		<p><strong><?php _e('Advanced settings', MGL_TWITTER_DOMAIN); ?></strong></p> 		
		<p>
			<label for="<?php echo $this->get_field_id( 'cache' ); ?>"><?php _e('Cache', MGL_TWITTER_DOMAIN) ?>:</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'cache' ); ?>" name="<?php echo $this->get_field_name( 'cache' ); ?>" value="<?php echo esc_attr( $cache ); ?>" />
		</p>
		
	<?php
	}
}

register_widget( 'MGL_TwitterCard_Widget' );

?>