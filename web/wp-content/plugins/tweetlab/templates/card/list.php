<div class="mgl_twitter mgl_twitter_template_<?php echo $template; ?> mgl_twitter_<?php echo $direction; ?>">
	<div class="mgl_tweets" data-mgl-slider-parameters="<?php echo $args; ?>">
		<?php foreach ($tweets as $tweet) : ?>
			<div class="mgl_tweet_container">
				<div class="mgl_tweet<?php if( mgl_twitter_display( $display, 'avatar' ) ): ?> mgl_tweet_with_avatar<?php endif; ?>">
					<span class="mgl_tweet_user">
						
						<?php if( mgl_twitter_display( $display, 'avatar' ) ): ?>
							<a title="<?php echo $tweet->user->name ?>" href="http://www.twitter.com/<?php echo $tweet->user->screen_name; ?>" class="mgl_tweet_avatar" target="_blank">
								<span class="mgl_twitter_mask"><span class="mgl_twitter_mask_logo">Open in Twitter</span></span>
								<img alt="<?php echo $tweet->user->name ?>" src="<?php echo str_replace('normal', 'bigger', $tweet->user->profile_image_url); ?>" />
							</a>
						<?php endif; ?>

						<?php if( mgl_twitter_display( $display, 'name' ) ): ?>
							<span class="mgl_tweet_name">
								<strong><?php echo $tweet->user->name ?></strong>
								<small class="mgl_tweet_username"><?php echo self::rich_text('@'.$tweet->user->screen_name); ?></small>
							</span>
						<?php endif; ?>

					</span>
					<span class="mgl_tweet_content">

						<?php if( mgl_twitter_display( $display, 'text' ) ): ?>
							<span class="mgl_tweet_text"><?php echo self::rich_text($tweet->text); ?></span>
						<?php endif; ?>

						<span class="mgl_tweet_date"><?php echo self::relative_date($tweet->created_at); ?></span>
					</span>
				</div><!-- END .mgl_tweet -->
			</div>
		<?php endforeach; ?>
	</div><!-- END .mgl_tweets -->
</div><!-- END .mgl_twitter -->
