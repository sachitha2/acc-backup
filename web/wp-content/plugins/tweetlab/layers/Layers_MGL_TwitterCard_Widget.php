<?php 
/**
 * Card Widget
 *
 * This file is used to register and display the Layers - Card widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( !class_exists( 'Layers_MGL_TwitterCard_Widget' ) ) {
 
class Layers_MGL_TwitterCard_Widget extends Layers_Widget {
 
        /**
        *  Widget construction
        */
        function Layers_MGL_TwitterCard_Widget(){

            $this->widget_title = __('Twitter Card', MGL_TWITTER_DOMAIN);
            $this->widget_id = 'twitter-card';

            /* Widget settings. */ 
 
            $widget_ops = array( 
                  'classname' => 'mgl-layers-' . $this->widget_id .'-widget', 
                  'description' => __( 'Show a twitter card', MGL_TWITTER_DOMAIN )
            );
            
            /* Widget control settings. */
            $control_ops = array( 
                  'width' => '660', 
                  'height' => NULL, 
                  'id_base' => 'layers-widget-' . $this->widget_id 
            );

            /* Create the widget. */ 
            $this->WP_Widget( 
                    'layers-widget-' . $this->widget_id , 
                     $this->widget_title, 
                     $widget_ops, 
                     $control_ops 
            );

            /* Setup Widget Defaults */ 
            $this->defaults = array ( 
                // Our defaults will sit here. 
            );
        }
 
        /**
        *  Widget front end display
        */
        function widget( $args, $instance ) {
            // Turn $args array into variables.
            extract( $args );
         
            // $instance Defaults
            $instance_defaults = $this->defaults;
         
            // If we have information in this widget, then ignore the defaults
            if( !empty( $instance ) ) $instance_defaults = array();
         
            // Parse $instance
            $widget = wp_parse_args( $instance, $instance_defaults );

            if( !empty( $widget['design'][ 'background' ] ) ) {
                layers_inline_styles(
                    '#' . $widget_id,
                    'background',
                    array(
                        'background' => $widget['design'][ 'background' ]
                    )
                );
            }

            $this->apply_widget_advanced_styling( $widget_id, $widget );

            ?>

            <section class="widget row content-vertical-massive <?php echo $this->check_and_return( $widget , 'design', 'advanced', 'customclass' ) ?> <?php echo $this->get_widget_spacing_class( $widget ); ?>" id="<?php echo $widget_id; ?>">
                <div class="row <?php echo $this->get_widget_layout_class( $widget ); ?> <?php echo $this->check_and_return( $widget , 'design', 'liststyle' ); ?>">

                
                <!-- Widget HTML will go here -->
                <?php
                    $shortcodeAttributes = '';
                    foreach( $widget as $argKey => $argVal ){
                        if( is_array($argVal)) { continue; }
                        $shortcodeAttributes .= " $argKey" . '="'. (string)$argVal . '"';
                    }
                   
                    echo do_shortcode( '[mgl_twitter_card ' . $shortcodeAttributes . ' ]' );

                ?>
                </div>
            </section>
            <?php
        }
 
        /**
        *  Widget form
        *
        * We use regulage HTML here, it makes reading the widget much easier 
        * than if we used just php to echo all the HTML out.
        *
        */
        function form( $instance ){

            $boolOptions = array('true' => __('Yes', MGL_TWITTER_DOMAIN), 'false' => __('No', MGL_TWITTER_DOMAIN));

            $instance_defaults = $this->defaults;
 
            // If we have information in this widget, then ignore the defaults
            if( !empty( $instance ) ) $instance_defaults = array();
         
            // Parse $instance
            $instance = wp_parse_args( $instance, $instance_defaults );
         
            extract( $instance, EXTR_SKIP );
            
            $design_bar_components = apply_filters(
                'layers_' . $this->widget_id . '_widget_design_bar_components' ,
                array(
                    'custom',
                    'layout', 
                    'background',
                    'advanced'
                )
            );

            $design_bar_custom_components = apply_filters(
               'layers_' . $this->widget_id . '_widget_design_bar_custom_components' ,
                   array(
                    'display' => array(
                       'icon-css' => 'icon-display',
                       'label' => __( 'Display', MGL_TWITTER_DOMAIN ),
                       'elements' => array(
                         'display' => array(
                               'type' => 'text',
                               'name' => $this->get_field_name( 'display' ) ,
                               'id' => $this->get_field_id( 'display' ) ,
                               'value' => ( isset( $display ) ) ? $display : 'banner,avatar,name,description,meta',
                               'label' => __( 'Tweet display' , MGL_TWITTER_DOMAIN )
                         ),
                        'button' => array(
                               'type'     => 'select',
                               'name'     => $this->get_field_name( 'button' ) ,
                               'id'       => $this->get_field_id( 'button' ) ,
                               'value'    => ( isset( $button ) ) ? $button : 'true',
                               'label'    => __( 'Follow button' , MGL_TWITTER_DOMAIN ),
                               'options'  => $boolOptions
                         ),
                       )
                   )
               )
            );

            $this->design_bar(
                'side', // CSS Class Name
                array(
                    'name' => $this->get_field_name( 'design' ),
                    'id' => $this->get_field_id( 'design' ),
                ), // Widget Object
                $instance, // Widget Values
                $design_bar_components, // Standard Components
                $design_bar_custom_components // Add-on Components
            );

            

             ?>
            <div class="layers-container-large">
                <?php $this->form_elements()->header( 
                   array(
                    'title' =>  __( 'Twitter Card' , MGL_TWITTER_DOMAIN ),
                    'icon_class' => 'twitter-card'
                   ) 
                ); ?>
                <section class="layers-accordion-section layers-content">
                    <div class="layers-row layers-push-bottom">
                        
                        <p class="layers-form-item">
                            <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php echo __( 'Username' , MGL_TWITTER_DOMAIN ); ?></label>
                                <?php echo $this->form_elements()->input(
                                array(
                                    'type' => 'text',
                                    'name' => $this->get_field_name( 'username' ) ,
                                    'id' => $this->get_field_id( 'username' ) ,
                                    'value' => ( isset( $username ) ) ? $username : NULL ,
                                )
                            ); ?>
                        </p>

                        <p class="layers-form-item">
                            <label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php echo __( 'Template' , MGL_TWITTER_DOMAIN ); ?></label>
                            <?php echo $this->form_elements()->input(
                                array(
                                    'type'      => 'select',
                                    'name'      => $this->get_field_name( 'template' ) ,
                                    'id'        => $this->get_field_id( 'template' ) ,
                                    'value'     => ( isset( $template ) ) ? $template : mgl_twitter_option('template','default'),
                                    'options'   => mgl_twitter_templates(true)
                                )
                            ); ?>
                        </p>
                     </div>
                </section>
            </div>
             <?php
        } // Form
    } // Class
 
    // Register our widget
    register_widget("Layers_MGL_TwitterCard_Widget"); 
}
?>