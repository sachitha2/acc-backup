<?php
/**
 * Template Name: Full Width
 */
get_header(); ?>

<?php global $archi_option; ?>
<?php if($archi_option['subpage-switch']!=false){ ?>

   <!-- subheader begin -->
    <section id="subheader" data-speed="8" data-type="background"
      <?php if( function_exists( 'rwmb_meta' ) ) { ?>        
            <?php $images = rwmb_meta( '_cmb_subheader_image', "type=image" ); ?>
            <?php if($images){ foreach ( $images as $image ) { ?>
            <?php 
            $img =  $image['full_url']; ?>
              style="background-image: url('<?php echo esc_url($img); ?>');"
            <?php } } ?>
        <?php } ?>
    >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><?php the_title(); ?></h1>              
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

<?php if (have_posts()){ ?>
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php }else {
		_e('Page Canvas For Page Builder', 'archi'); 
}?>

<?php get_footer(); ?>