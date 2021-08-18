<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Archi
 * @since 1.0
 */

// Add specific CSS class by filter
add_filter( 'body_class', 'archi_body_class_names' );
function archi_body_class_names( $classes ) {
    global $archi_option;
	$theme = wp_get_theme();

    // add 'class-name' to the $classes array
    if($archi_option['version_type']=='light'){
        $classes[] = 'de_light';
    }

    if($archi_option['subpage-switch']==false && !is_page_template('page-templates/template-canvas.php') && !is_page_template('page-templates/template-landing.php') && !is_page_template('page-templates/template-onepage.php') ){ 
        $classes[] = 'no-subheader';
    }

    if($archi_option['topbar-allpage']==true && $archi_option['header_layout']=="htop_page"){
        $classes[] = 'has-topbar';
    } 

    if ($archi_option['desktop-sticky']==false) {
        $classes[] = 'header-no-sticky-subheader';
    }   

    if ($archi_option['mobile-sticky']==true){
        $classes[] = 'header-mobile-sticky-subheader';
    }

    if(isset($archi_option['header_layout']) and $archi_option['header_layout']!="htop_page" ){
        $classes[] = 'de-navbar-left';
    } 

    if(isset($archi_option['preloader_mode']) and $archi_option['preloader_mode']=="preloader_logo"){
        $classes[] = 'royal_preloader';
    }
	
	$classes[] = 'archi-theme-ver-'.$theme->version;
    $classes[] = 'wordpress-version-'.get_bloginfo( 'version' );
    
    // return the $classes array
    return $classes;
}

// Add specific CSS class by filter
function archi_header_class() {
    global $archi_option;

    $header_classes = array();

    if(( isset($archi_option['header_position']) and $archi_option['header_position']!="onbottom_page" and $archi_option['topbar-onepage']==true and is_page_template('page-templates/template-onepage.php')) || ($archi_option['topbar-allpage']==true and !is_page_template('page-templates/template-onepage.php'))){ 
        $header_classes[] = 'de_header_2';
    }

    if ($archi_option['mobile-sticky']==true) {
        $header_classes[] = 'header-mobile-sticky';
    }  

    if ($archi_option['desktop-sticky']==false and $archi_option['hideshow_header']==false) {
        $header_classes[] = 'header-desktop-nosticky';
    }   

    if(isset($archi_option['header_style']) and $archi_option['header_style']=="header_light" and is_page_template( array( 'page-templates/template-canvas.php', 'page-templates/template-onepage.php' ) )){
        $header_classes[] = 'header-light';
    }elseif (isset($archi_option['header_style']) and $archi_option['header_style']=="header_overlay" and is_page_template( array( 'page-templates/template-canvas.php', 'page-templates/template-onepage.php' ) )){
        $header_classes[] = 'header-bg';
    }elseif (isset($archi_option['header_style']) and $archi_option['header_style']=="header_transparent" and is_page_template( array( 'page-templates/template-canvas.php', 'page-templates/template-onepage.php' ) )){
        $header_classes[] = 'transparent';
    }else{
        $header_classes[] = '';
    }

    if( !is_page_template('page-templates/template-canvas.php') and !is_page_template('page-templates/template-onepage.php') ){
        $header_classes[] = 'header-bg';
    }

    if(isset($archi_option['header_position']) and $archi_option['header_position']=="onbottom_page" and is_page_template( array( 'page-templates/template-canvas.php', 'page-templates/template-onepage.php' ) ) ){
        $header_classes[] = 'header-bottom';
    }    		

    if ($archi_option['hideshow_header']==true and $archi_option['header_position']!="onbottom_page" and $archi_option['header_layout']=="htop_page" and is_page_template('page-templates/template-canvas.php') ) {
        $header_classes[] = 'autoshow scrollOff';
    } 
    
    // return the $classes array
    echo implode( ' ', $header_classes );
}

add_action('wp_footer', 'archi_add_custom_script_footer');
function archi_add_custom_script_footer(){ 
    global $archi_option;
    if ($archi_option['js_editor'] != '') {
?>
    <script type="text/javascript">
        <?php echo $archi_option['js_editor']; ?>
    </script>
<?php
    }
} 
 