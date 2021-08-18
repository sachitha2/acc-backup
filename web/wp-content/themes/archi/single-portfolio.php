<?php global $archi_option; ?>
<?php if($archi_option['ajax_work']!=false){ ?>
	<div class="container project-view">
		<?php while (have_posts()) : the_post()?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>		
<?php }else { ?>
	<?php get_header(); ?>

		<?php global $archi_option; ?>
		<?php if($archi_option['subpage-switch']!=false){ ?>

			<section id="subheader" data-speed="8" data-type="background" class="padding-top-bottom"
				<?php if( function_exists( 'rwmb_meta' ) ) { ?>       
			        <?php $images = rwmb_meta( '_cmb_portfolio_subheader', "type=image" ); ?>
			        <?php if($images){ foreach ( $images as $image ) { ?>
			        <?php $img =  $image['full_url']; ?>
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
		
		<?php if(isset($archi_option['single_navigation']) and $archi_option['single_navigation']=="navontop" ){ ?>
			<div id="portfolio-controls"> 
		        <div class="left-right-portfolio"> 
		            <div class="portfolio-icon">
		            	<?php echo previous_post_link('%link', __('<i class="fa fa-angle-double-left"></i>', 'archi'), $post->max_num_pages); ?>
		            </div>
		        </div>
		   
		        <a href="<?php echo esc_url($archi_option['portfolio_link']); ?>">
		            <div class="center-portfolio"> 
		                <div class="portfolio-icon fa-th"></div>
		            </div> 
		        </a> 

		        <div class="left-right-portfolio">
		            <div class="portfolio-icon">
		            	<?php echo next_post_link('%link', __('<i class="fa fa-angle-double-right"></i>', 'archi'), $post->max_num_pages); ?>
		            </div> 
		        </div>
		    </div>
		<?php } ?>    

		<div id="content">
			<?php while (have_posts()) : the_post(); ?>			
				<?php the_content(); ?>			
			<?php endwhile; ?>
			
			<section class="single-portfolio-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php if ($archi_option['project_sharing']!=false) { ?>
								<div class="socials-portfolio socials-rounded">
									<h4><?php esc_html_e('Share:', 'archi'); ?></h4>
									<div class="socials-sharing"> 
										<a class="socials-item" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Facebook"><i class="fa fa-facebook"></i></a> 
										<a class="socials-item" target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" title="Twitter"><i class="fa fa-twitter"></i></a> 
										<a class="socials-item" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="Google Plus"><i class="fa fa-google-plus"></i></a> 
										<a class="socials-item" target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&description=<?php the_title(); ?>" title="Pinterest"><i class="fa fa-pinterest"></i></a> 																				
										<a class="socials-item" href="http://digg.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="fa fa-digg" aria-hidden="true"></i></a>
										<a class="socials-item" target="_blank" href="http://www.tumblr.com/share/link?url=<?php the_permalink(); ?>&name=<?php the_title(); ?>&description=<?php echo get_the_excerpt(); ?>" title="Tumblr"><i class="fa fa-tumblr"></i></a> 
										<a class="socials-item" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="fa fa-reddit-alien" aria-hidden="true"></i></a>
										<a class="socials-item" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=<?php echo get_the_excerpt(); ?>" title="LinkedIn"><i class="fa fa-linkedin"></i></a> 
										<a class="socials-item" target="_blank" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" title="StumbleUpon"><i class="fa fa-stumbleupon"></i></a>									
										<a class="socials-item" href="https://delicious.com/save?v=5&provider=<?php bloginfo( 'name' ); ?>&noui&jump=close&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="fa fa-delicious" aria-hidden="true"></i></a>										
										<a class="socials-item" href="http://vk.com/share.php?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-vk"></i></a>
									</div>
								</div>
							<?php } ?>

							<?php if(isset($archi_option['single_navigation']) and $archi_option['single_navigation']=="navonbottom" ){ ?>
								<div class="double-divider clearfix"></div>
								<div class="portfolio-navigation clearfix">
									<div class="portfolio-btn-prev">
										<?php echo previous_post_link('%link', __('<i class="fa fa-chevron-left"></i> Prev', 'archi'), $post->max_num_pages); ?>
									</div>
									<div class="portfolio-btn-next">
										<?php echo next_post_link('%link', __('Next <i class="fa fa-chevron-right"></i>', 'archi'), $post->max_num_pages); ?>
									</div>
								</div>
							<?php } ?>

						</div>
					</div>
				</div>
			</section>		
		</div>
	<?php get_footer(); ?>	
<?php } ?>
