<?php 
/**** WooCommerce ****/
if (class_exists('Woocommerce')) {
    add_theme_support( 'woocommerce' );   

    /* Enabling product gallery features (zoom, swipe, lightbox) in 3.0.0 */ 
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Display 12 products per page. Goes in functions.php
    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

    // breadcrumb woocommerce
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    add_action('breadcrumb_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

    if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
        /**
         * Show the product title in the product loop. By default this is an H3.
         */
        function woocommerce_template_loop_product_title() {
            echo get_the_title();
        }
    }
}