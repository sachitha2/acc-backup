<?php global $archi_option; ?>
<li class= "wow fadeInUp">
    <div class="post-content">
        <div class="post-image">
          <div id="owl-demo-<?php the_ID(); ?>" class="owl-carousel">
            <?php if( function_exists( 'rwmb_meta' ) ) { ?>
              <?php $images = rwmb_meta( '_cmb_images', "type=image_advanced&size=full" ); ?>
              <?php if($images){ ?>                  
                <?php foreach ( $images as $image ) { ?>
                  <div class="item"><?php echo "<img src='{$image['full_url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />"; ?></div> 
                <?php } ?>                                     
              <?php } ?>
            <?php } ?>
          </div>
        </div>
        <div class="date-box">
            <div class="day"><?php the_time('d'); ?></div>
            <div class="month"><?php the_time('M'); ?></div>
        </div>
        <div class="post-text">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php echo archi_excerpt(); ?></p>
        </div>
        <a href="<?php the_permalink(); ?>" class="btn-more"><?php if ($archi_option['blog_btntext'] != ''){ echo esc_attr($archi_option['blog_btntext']); }else{ esc_html_e('Read More', 'archi'); } ?></a>
    </div>
</li>
<script type="text/javascript">
  (function($){
  "use strict";
    $(document).ready(function() {
      $("#owl-demo-<?php the_ID(); ?>").owlCarousel({        
        items : 1,
        autoPlay: <?php if($archi_option['post-slide-autoplay']!=false){echo 'true';}else{echo 'false';} ?>,
        slideSpeed : <?php echo esc_attr($archi_option['post-slide-speed']); ?>,
        paginationSpeed : <?php echo esc_attr($archi_option['post-slide-pagination-speed']); ?>,
        rewindSpeed : <?php echo esc_attr($archi_option['post-slide-rewind-speed']); ?>,
        singleItem:true,
        transitionStyle : <?php if($archi_option['post-slide-transition']!=false){echo "'fade'";}else{echo "false";} ?>,
      });
    });
  })(this.jQuery);
</script>