<?php 
/**
 * Slider Widget
 *
 * This file is used to register and display the Layers - Slider widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( !class_exists( 'Layers_MGL_Twitter_Widget' ) ) {
 
class Layers_MGL_Twitter_Widget extends Layers_Widget {
 
        /**
        *  Widget construction
        */
        function Layers_MGL_Twitter_Widget(){

            $this->widget_title = __('Twitter Carousel', MGL_TWITTER_DOMAIN);
            $this->widget_id = 'twitter';

            /* Widget settings. */ 
 
            $widget_ops = array( 
                  'classname' => 'mgl-layers-' . $this->widget_id .'-widget', 
                  'description' => __( 'Show a twitter carousel', MGL_TWITTER_DOMAIN )
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

                    echo do_shortcode( '[mgl_twitter ' . $shortcodeAttributes . ' ]' );

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
                    'columns' => array(
                       'icon-css' => 'icon-columns',
                       'label' => __( 'Columns & count', MGL_TWITTER_DOMAIN ),
                       'elements' => array(
                            'count' => array(
                                 'type' => 'number',
                                 'name' => $this->get_field_name( 'count' ) ,
                                 'id' => $this->get_field_id( 'count' ) ,
                                 'min' => 0,
                                 'max' => 50,
                                 'value' => ( isset( $count ) ) ? $count : 12,
                                 'label' => __( 'Count' , MGL_TWITTER_DOMAIN )
                             ),
                            'cols' => array(
                                'type' => 'number',
                                'name' => $this->get_field_name( 'slides' ) ,
                                'id' => $this->get_field_id( 'slides' ) ,
                                'value' => ( isset( $slides ) ) ? $slides : 4,
                                'label' => __( 'Slides' , MGL_TWITTER_DOMAIN )
                            ),
                        )
                    ),
                    'display' => array(
                       'icon-css' => 'icon-display',
                       'label' => __( 'Display', MGL_TWITTER_DOMAIN ),
                       'elements' => array(
                         'display' => array(
                               'type' => 'text',
                               'name' => $this->get_field_name( 'display' ) ,
                               'id' => $this->get_field_id( 'display' ) ,
                               'value' => ( isset( $display ) ) ? $display : 'avatar,name,text',
                               'label' => __( 'Tweet display' , MGL_TWITTER_DOMAIN )
                         ),
                        
                       )
                   ),
                  'controls' => array(
                       'icon-css' => 'icon-settings',
                       'label' => __( 'Controls', MGL_TWITTER_DOMAIN ),
                       'elements' => array(
                         'autoplay' => array(
                               'type'     => 'select',
                               'name'     => $this->get_field_name( 'autoplay' ) ,
                               'id'       => $this->get_field_id( 'autoplay' ) ,
                               'value'    => ( isset( $autoplay ) ) ? $autoplay : 'true',
                               'label'    => __( 'Autoplay' , MGL_TWITTER_DOMAIN ),
                               'options'  => $boolOptions
                         ),
                         'pager' => array(
                               'type'     => 'select',
                               'name'     => $this->get_field_name( 'pager' ) ,
                               'id'       => $this->get_field_id( 'pager' ) ,
                               'value'    => ( isset( $pager ) ) ? $pager : 'true',
                               'label'    => __( 'Pager' , MGL_TWITTER_DOMAIN ),
                               'options'  => $boolOptions
                         ),
                        'controls' => array(
                               'type'     => 'select',
                               'name'     => $this->get_field_name( 'controls' ) ,
                               'id'       => $this->get_field_id( 'controls' ) ,
                               'value'    => ( isset( $controls ) ) ? $controls : 'false',
                               'label'    => __( 'Arrows' , MGL_TWITTER_DOMAIN ),
                               'options'  => $boolOptions
                         ),
                        'speed' => array(
                               'type' => 'number',
                               'name' => $this->get_field_name( 'speed' ) ,
                               'id' => $this->get_field_id( 'speed' ) ,
                               'value' => ( isset( $speed ) ) ? $speed : 1000,
                               'label' => __( 'Speed' , MGL_TWITTER_DOMAIN )
                        ),
                        'pause' => array(
                               'type' => 'number',
                               'name' => $this->get_field_name( 'pause' ) ,
                               'id' => $this->get_field_id( 'pause' ) ,
                               'value' => ( isset( $pause ) ) ? $pause : 1000,
                               'label' => __( 'Pause' , MGL_TWITTER_DOMAIN )
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
                    'title' =>  __('Twitter Carousel', MGL_TWITTER_DOMAIN),
                    'icon_class' => 'twitter'
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
                            <label for="<?php echo $this->get_field_id( 'search' ); ?>"><?php echo __( 'Search' , MGL_TWITTER_DOMAIN ); ?></label>
                                <?php echo $this->form_elements()->input(
                                array(
                                    'type' => 'text',
                                    'name' => $this->get_field_name( 'search' ) ,
                                    'id' => $this->get_field_id( 'search' ) ,
                                    'value' => ( isset( $search ) ) ? $search : NULL ,
                                )
                            ); ?>
                        </p>

                        <p class="layers-form-item">
                            <label for="<?php echo $this->get_field_id( 'custom_query' ); ?>"><?php echo __( 'Custom query' , MGL_TWITTER_DOMAIN ); ?></label>
                                <?php echo $this->form_elements()->input(
                                array(
                                    'type' => 'text',
                                    'name' => $this->get_field_name( 'custom_query' ) ,
                                    'id' => $this->get_field_id( 'custom_query' ) ,
                                    'value' => ( isset( $custom_query ) ) ? $custom_query : NULL ,
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

                         <p class="layers-form-item">
                            <label for="<?php echo $this->get_field_id( 'direction' ); ?>"><?php echo __( 'Direction' , MGL_TWITTER_DOMAIN ); ?></label>
                            <?php echo $this->form_elements()->input(
                                array(
                                    'type'      => 'select',
                                    'name'      => $this->get_field_name( 'direction' ) ,
                                    'id'        => $this->get_field_id( 'direction' ) ,
                                    'value'     => ( isset( $direction ) ) ? $direction : mgl_twitter_option('direction','ltr'),
                                    'options'   => mgl_twitter_directions()
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
    register_widget("Layers_MGL_Twitter_Widget"); 
}
?>