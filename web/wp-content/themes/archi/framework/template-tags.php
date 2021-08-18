<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Archi
 * @since 1.0
 */

if ( ! function_exists( 'archi_breadcrumbs' ) ) :
/* Archi Custom breadcrumb */
function archi_breadcrumbs() {
    $text['home']     = esc_html__('Home', 'archi'); // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['tax']      = '%s'; // text for a taxonomy page
    $text['search']   = '%s'; // text for a search results page
    $text['tag']      = '%s'; // text for a tag page
    $text['author']   = '%s'; // text for an author page
    $text['404']      = '404'; // text for the 404 page
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ' <b>/</b> '; // delimiter between crumbs
    $before      = '<li class="active">'; // tag before the current crumb
    $after       = '</li>'; // tag after the current crumb
    
    global $post;
    $homeLink = esc_url(home_url('/')) . '';
    $linkBefore = '<li>';
    $linkAfter = '</li>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
 
    if (is_home() || is_front_page()) {
 
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
 
    } else {
 
        echo '<ul class="crumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
         
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
            }
            echo htmlspecialchars_decode( $before ) . sprintf($text['category'], single_cat_title('', false)) . htmlspecialchars_decode( $after );
 
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
            }
            echo htmlspecialchars_decode( $before ) . sprintf($text['tax'], single_cat_title('', false)) . htmlspecialchars_decode( $after );
        
        }elseif ( is_search() ) {
            echo htmlspecialchars_decode( $before ) . sprintf($text['search'], get_search_query()) . htmlspecialchars_decode( $after );
 
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo htmlspecialchars_decode( $before ) . get_the_time('d') . htmlspecialchars_decode( $after );
 
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo htmlspecialchars_decode( $before ) . get_the_time('F') . htmlspecialchars_decode( $after );
 
        } elseif ( is_year() ) {
            echo htmlspecialchars_decode( $before ) . get_the_time('Y') . htmlspecialchars_decode( $after );
 
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;                
                printf($link, $homeLink . '' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
                if ($showCurrent == 1) echo htmlspecialchars_decode( $before ) . get_the_title() . $after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo htmlspecialchars_decode( $before ) . $post_type->labels->singular_name . htmlspecialchars_decode( $after );
 
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo htmlspecialchars_decode( $cats );
            printf($link, get_permalink($parent), $parent->post_title);
            if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
 
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo htmlspecialchars_decode( $before ) . get_the_title() . $after;
 
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo htmlspecialchars_decode( $breadcrumbs[$i] );
                if ($i != count($breadcrumbs)-1) echo htmlspecialchars_decode( $delimiter );
            }
            if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
 
        } elseif ( is_tag() ) {
            echo htmlspecialchars_decode( $before ) . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo htmlspecialchars_decode( $before ) . sprintf($text['author'], $userdata->display_name) . $after;
 
        } elseif ( is_404() ) {
            echo htmlspecialchars_decode( $before ) . $text['404'] . $after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
 
        echo '</ul>';
 
    }
}
endif;

function archi_theme_custom_the_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } 
  
    return $title;
}
add_filter( 'get_the_archive_title', 'archi_theme_custom_the_archive_title' );

/**custom function tag widgets**/
function archi_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	$args['exclude'] = ''; //exclude tags by ID
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'archi_tag_cloud_widget' );

/** Custom theme option post excerpt **/
function archi_excerpt() {
  global $archi_option;
  if(isset($archi_option['blog_excerpt'])){
    $limit = $archi_option['blog_excerpt'];
  }else{
    $limit = 15;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/** Excerpt Section Blog Post **/
function archi_blog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

//pagination
function archi_pagination($prev = '<i class="fa fa-angle-double-left"></i>', $next = '<i class="fa fa-angle-double-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,
		'prev_text' => $prev,
        'next_text' => $next,		
        'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
    );
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '', $return );
}

/* Custom form search */
function archi_search_form( $form ) {
    $form = '<form role="search" method="get" action="' . esc_url(home_url( '/' )) . '" >  
    	<input type="search" id="search" class="search-field form-control" value="' . get_search_query() . '" name="s" placeholder="'.__('type to search&hellip;', 'archi').'" />
    	<button id="btn-search" type="submit"></button>
        <div class="clearfix"></div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'archi_search_form' );

/* Custom comment List: */
function archi_theme_comment($comment, $args, $depth) {    
   $GLOBALS['comment'] = $comment; ?>
   <li id="comment-<?php comment_ID(); ?>" class="post-content-comment grey-section">
   		<div class="img"><?php echo get_avatar($comment,$size='70',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=70' ); ?></div>
		<div class="comment-content"><h6><?php printf(__('%s','archi'), get_comment_author()) ?></h6></div>		
		<div class="date">
			<span class="c_date"><?php the_time('dS M Y'); ?></span>
            <span class="c_reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
		</div>
		<div class="comment-content">
    		<?php if ($comment->comment_approved == '0'){ ?>
    			 <p><em><?php esc_html_e('Your comment is awaiting moderation.','archi') ?></em></p>
    		<?php }else{ ?>
                <?php comment_text() ?>
             <?php } ?>
		</div>		
	    <div class="clearfix"></div>	
	</li> 
<?php
}

/* Upload images format svg */
function archi_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'archi_mime_types');

if ( ! function_exists( 'archi_custom_favicon' ) ) :
/**
 * Prints HTML with Custom Favicon.
 */
function archi_custom_favicon() {
    global $archi_option;
    
    if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {        
        if($archi_option['favicon']['url'] !=''){ 
            echo '<link rel="shortcut icon" type="image/x-icon" href="'.esc_url($archi_option['favicon']['url']).'">';    
        } 
    } 
}
endif;
