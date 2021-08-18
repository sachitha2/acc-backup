<div class="vcard mgl_twitter_card mgl_twitter_template_<?php echo $template; ?>">
	
	<?php if( mgl_twitter_display( $display, 'banner' ) ): ?>
		<div class="mgl_twitter_banner" style="background-image: url('<?php echo $user->profile_banner_url; ?>');"></div>
	<?php endif; ?>
	
	<div class="mgl_twitter_user">
		
		<?php if( mgl_twitter_display( $display, 'avatar' ) ): ?>
			<a href="http://www.twitter.com/<?php echo $user->screen_name; ?>" class="mgl_twitter_avatar" title="<?php echo $user->name; ?>" target="_blank">
				<span class="mgl_twitter_mask"><span class="mgl_twitter_mask_logo"><?php _e('Open in Twitter','mgl_twitter'); ?></span></span>
				<img alt="<?php echo $user->name; ?>" src="<?php echo str_replace('_normal', '', $user->profile_image_url); ?>" />
			</a>
		<?php endif; ?>

		<?php if( mgl_twitter_display( $display, 'name' ) ): ?>
			<div class="mgl_twitter_name">
				<strong class="fn"><?php echo $user->name; ?></strong>
				<small class="mgl_twitter_username"><?php echo self::rich_text('@'.$user->screen_name); ?></small>
			</div>
			<div class="mgl_twitter_userdata">
				<?php if(isset($user->location)): echo $user->location; endif; ?>
				<?php
				if(isset($user->entities->url->urls)) :
					foreach ($user->entities->url->urls as $website) :
						echo '<a href="'.$website->expanded_url.'" target="_blank" title="'.sprintf( __( 'Visit %d','mgl_twitter'),$website->display_url).'" >'.$website->display_url.'</a>';
					endforeach;
				endif;
				?>
			</div>
		<?php endif; ?>

		
		<div class="mgl_twitter_userinfo">
			
			<?php if( mgl_twitter_display( $display, 'description' ) ): ?>
				<div class="mgl_twitter_description">
					<?php echo self::rich_text($user->description); ?>
				</div>
			<?php endif; ?>
			
			<?php if( mgl_twitter_display( $display, 'meta' ) ): ?>
				<div class="mgl_twitter_numbers">
					<ul>
						<li><?php echo $user->statuses_count; ?> <small><?php _e('Tweets','mgl_twitter'); ?></small></li>
						<li><?php echo $user->followers_count; ?> <small><?php _e('Followers','mgl_twitter'); ?></small></li>
						<li><?php echo $user->friends_count; ?> <small><?php _e('Following','mgl_twitter'); ?></small></li>
					</ul>
				</div>
			<?php endif; ?>
		
		</div>

		<?php if( $button == 'true' ): ?>
			<div class="mgl_twitter_button">
				<a href="https://twitter.com/<?php echo $user->screen_name; ?>" class="twitter-follow-button" data-show-count="false" data-size="large"><?php printf( __( 'Follow %d','mgl_twitter'), '@'.$user->screen_name); ?></a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div>
		<?php endif; ?>

	</div>
	
</div>