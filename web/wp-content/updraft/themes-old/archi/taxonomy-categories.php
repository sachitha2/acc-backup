<?php 
get_header(); 
global $archi_option; 
$gap = (!empty($archi_option['projects_item_gap']) ? $archi_option['projects_item_gap'].'px' : '0px');
$imgwidth = (!empty($archi_option['project_image_width'])) ? $archi_option['project_image_width'] : 700;
$imgheight = (!empty($archi_option['project_image_height'])) ? $archi_option['project_image_height'] : 466;
?>
<?php if($archi_option['subpage-switch']!=false){ ?>

  <!-- subheader begin -->
  <section id="subheader" data-speed="8" data-type="background" class="padding-top-bottom" <?php if($archi_option['portfolio_thumbnail'] != ''){ ?> style="background-image: url('<?php echo esc_url($archi_option['portfolio_thumbnail']['url']); ?>');" <?php } ?> >
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <?php the_archive_title( '<h1 class="page-title">', '</h1>' );?>
                  <?php 
                    if(function_exists('archi_breadcrumbs')): 
                      archi_breadcrumbs();
                    endif;
                  ?>                  
              </div>
          </div>
      </div>
  </section>
  <!-- subheader close -->

<?php }else{ ?>
    <section class="no-subpage"></section>
<?php } ?>

<!-- content begin -->
<div id="content">   
    <div id="gallery" class="gallery full-gallery de-gallery pf_full_width <?php if ($archi_option['portfolio_columns'] == 2) {echo 'pf_2_cols'; }elseif ($archi_option['portfolio_columns'] == 3) { echo 'pf_3_cols'; }elseif ($archi_option['portfolio_columns'] == 5) { echo 'pf_5_cols'; }elseif ($archi_option['portfolio_columns'] == 6) { echo 'pf_6_cols'; }else{} ?> wow fadeInUp" data-wow-delay=".3s">
      <?php while (have_posts()) : the_post(); ?>             
        <!-- gallery item -->
        <div class="item <?php echo esc_attr($cate_slug); ?>">
          <div class="picframe-new" style="margin:<?php echo esc_attr($gap); ?>">
            <a <?php if($archi_option['ajax_work']!=false){ ?>class="simple-ajax-popup-align-top"<?php } ?> href="<?php the_permalink(); ?>">
              <div class="mask"></div>                  
              <div class="pr_text">
                  <div class="project-name"><?php the_title(); ?></div>
              </div>
              
              <?php if ( has_post_thumbnail() ) : ?>
                <?php               
                  if ($archi_option['crop_project_images'] != false) {
                    $thumbnail = get_post( get_post_thumbnail_id() );
                    $image_title = $thumbnail->post_title;
                    $image_caption = $thumbnail->post_excerpt;
                    $image_description = $thumbnail->post_content;
                    $image_alt = get_post_meta( $thumbnail->ID, '_wp_attachment_image_alt', true );
                    // Crop
                    $params = array( 'width' => $imgwidth, 'height' => $imgheight, 'crop' => true );
                    $image = bfi_thumb( wp_get_attachment_url(get_post_thumbnail_id()), $params );  
                ?>
                  <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>" title="<?php echo esc_attr($image_title); ?>" />
                <?php 
                  }else{
                    the_post_thumbnail( 'thumb-portfolio' ); 
                  }     
                ?>
              <?php endif; ?>
            </a>
          </div>
        </div>
        <!-- close gallery item -->
    <?php endwhile; ?>
  </div>
  <div class="container">
    <div class="col-md-12">
      <div class="pagination text-center" style="width:100%;padding-top: 40px;">
          <?php
            global $wp_query;
            $big = 999999999;
            echo paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged') ),
              'total' => $wp_query->max_num_pages,                      
                'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                'next_text' => '<i class="fa fa-angle-double-right"></i>',       
                'type'          => 'list',
                'end_size'      => 3,
                'mid_size'      => 3
            ) );
          ?>
        </div>
    </div>
  </div>
</div>
<!-- content close -->
<?php get_footer(); ?>
