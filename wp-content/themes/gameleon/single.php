<?php

// If this file is called directly, busted!
if (!defined('ABSPATH')) {
	exit;
}
/*----------------------------------------------------------------------------------------------------------
    Single Posts Template - we use PHP comments instead of HTML, to reduce the page size.
-----------------------------------------------------------------------------------------------------------*/
get_header(); ?>

<?php if (defined('MYARCADE_VERSION') && is_game()) : ?>

	<?php // game variables
	$custom_meta 				= get_post_custom($post->ID);
	$td_progressbar_enabled 	= get_theme_mod('gameleon_progress_bar');
	$td_light 					= get_theme_mod('gameleon_light_button');
	$td_fullscreen				= get_theme_mod('gameleon_fullscreen_button');
	$td_play_full				= get_theme_mod('gameleon_play_full_text');
	$td_exit_full				= get_theme_mod('gameleon_exit_full_text');
	$td_screens_tab_enabled 	= get_theme_mod('gameleon_game_screenshot_tab'); // game screenshots
	$td_video_tab_enabled 		= get_theme_mod('gameleon_game_trailer_tab'); // game video
	$td_tab_play_text 			= get_theme_mod('gameleon_how_to_play'); // how to play text, useful for translations
	$td_tab_screen_text 		= get_theme_mod('gameleon_screenshoots_text'); // screenshot title, useful for translations
	$td_tab_video_text 			= get_theme_mod('gameleon_trailer_text'); // trailer tab title, useful for translations
	$td_cutom_tab_enabled 		= get_theme_mod('gameleon_game_custom_tab'); // enable custom tab
	$td_custom_tab_title  		= get_theme_mod('gameleon_custom_tab_title'); // custom tab title
	$td_custom_tab_content 		= get_theme_mod('gameleon_custom_tab_content'); // custom tab content 
	$instructions 				= $custom_meta['mabp_instructions'][0];
	$game_size 					= $custom_meta['mabp_width'][0];
	$thumb_url 					= myarcade_get_thumbnail_url();
	?>

	<?php if (function_exists('myarcade_count_screenshots')) : ?>
		<?php $screenshots = myarcade_count_screenshots(); ?>
	<?php else : ?>
		<?php $screenshots = ''; ?>
	<?php endif; ?>

	<?php if (function_exists('myarcade_video')) : ?>
		<?php $video_url = myarcade_video(); ?>
	<?php else : ?>
		<?php $video_url = ''; ?>
	<?php endif; ?>

	<div id="content-arcade" class="grid col-1060">
		<div class="td-content-inner-single-arcade">

			<div id="full-screen-wrapp">

				<div class="widget-title">
					<h1><?php myarcade_title(); ?></h1>

					<div class="td-game-buttons">
						<?php if ($td_fullscreen) : ?>
							<button id="full-screen"><span class="enter-full"><i class="fas fa-expand-arrows-alt"></i><?php echo esc_html($td_play_full); ?></span><span class="exit-full"><i class="fas fa-expand-arrows-alt"></i><?php echo esc_html($td_exit_full); ?></span></button>
						<?php endif; ?>

						<?php if ($td_light) : ?>
							<div class="td-light-off"><i class="far fa-lightbulb"></i></div>
						<?php endif; ?>

					</div>

				</div>

				<div class="td-wrap-content-arcade">

					<div class="clearfix"></div>

					<?php if ($td_progressbar_enabled) : ?>
						<?php get_template_part('/includes/progressbar'); ?>

						<div class="td_before-game-loading">
							<div id="showprogressbar">

								<?php echo responsive_interstitial_ad(); // show interstitial ad 
								?>

								<div id="progressbar">
									<span id="progresstext">0%</span>
									<div id="progressbarloadbg">&thinsp;</div>
								</div>

							</div><?php // end of #showprogressbar/ 
									?>
						</div><?php // end of .td_before-game-loading / 
								?>

						<div id="progressbarloadtext" onclick="window.hide();">
							<?php echo get_theme_mod('td_progress_bar_info_text'); ?>
						</div>

					<?php endif; // end of check "$td_progressbar_enabled" 
					?>

					<div class="clearfix"></div>

					<div id="td-game-wrap" class="showfitvids">

						<div class="td-embed-container" style="width:<?php echo esc_attr($game_size); ?>px;">

							<?php
							if (function_exists('get_game')) { // yep... show the MyArcade  game code
								/* mypostid global is needed for MyScoresPresenter */
								global $mypostid;
								$mypostid = $post->ID;
								echo myarcade_get_leaderboard_code();
								echo get_game($post->ID);
							}
							?>

						</div><?php // end of embed-container / 
								?>
					</div><?php // end of #td-game-wrap / 
							?>

				</div><?php // end of .td-wrap-content-arcade / 
						?>
			</div><?php // end of #full-screen-wrapp / 
					?>

			<div class="td-game-ad-space">
				<?php echo responsive_ad_bellow_the_game(); // show the below the game ad 
				?>
			</div><?php // end of .td-game-ad-space / 
					?>

			<?php if (get_theme_mod('gameleon_single_nav') == 1 && defined('MYARCADE_VERSION') && is_game()) : ?>
				<div class="navigation">
					<div class="previous"><?php previous_post_link(' <i class="fas fa-chevron-left"></i>  &nbsp;  %link'); ?></div>
					<div class="next"><?php next_post_link('%link &nbsp; <i class="fas fa-chevron-right"></i>'); ?></div>
				</div><?php // end of .navigation / 
						?>
			<?php endif; // end if( get_theme_mod( 'td_post_navigation' ) 
			?>

		</div><?php // end of .td-content-inner-single-arcade / 
				?>
	</div><?php // end of #content-arcade / 
			?>

	<div id="td-game-tabs" class="grid col-1060">
		<div class="td-content-inner-single-arcade">
			<div id="gametabs">

				<ul class="tab-links">
					<li class="active"><a href="#tab1"><?php echo esc_html($td_tab_play_text); ?></a></li>

					<?php if (defined('MYARCADE_VERSION') && is_game() && $td_screens_tab_enabled && ($screenshots)) : ?>
						<li class="td-tab-2"><a href="#tab2"><?php echo esc_html($td_tab_screen_text); ?></a></li>
					<?php endif; ?>

					<?php if (defined('MYARCADE_VERSION') && is_game() && $td_video_tab_enabled && $video_url) : ?>
						<li class="td-tab-3"><a href="#tab3"><?php echo esc_html($td_tab_video_text); ?></a></li>
					<?php endif; ?>

					<?php if ($td_cutom_tab_enabled) : ?>
						<li><a href="#tab4"><?php echo esc_html($td_custom_tab_title); ?></a></li>
					<?php endif; ?>

				</ul>

				<div class="gametab-content">

					<div id="tab1" class="tab active">
						<?php echo do_shortcode($instructions); ?>
					</div>

					<?php if (defined('MYARCADE_VERSION') && is_game() && $td_screens_tab_enabled && ($screenshots)) : ?>
						<div id="tab2" class="tab td-screens-popup">
							<?php myarcade_all_screenshots(224, 224, 'td-game-screens-class'); ?>
						</div>
					<?php endif; ?>

					<?php if (defined('MYARCADE_VERSION') && is_game() && $td_video_tab_enabled && $video_url) : ?>
						<div id="tab3" class="tab">
							<div class="myarcade-video">
								<?php echo myarcade_video(1018, 573); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ($td_cutom_tab_enabled) : ?>
						<div id="tab4" class="tab">
							<?php if ($td_custom_tab_content) :
								echo do_shortcode(stripslashes($td_custom_tab_content));
							endif; ?>
						</div>
					<?php endif; ?>

				</div><?php // end of .tab-content / 
						?>
			</div><?php // end of #gametabs / 
					?>
		</div><?php // end of .td-content-inner-single-arcade / 
				?>
	</div><?php // end of .col-1060 / 
			?>

<?php endif; // end of check "MYARCADE_VERSION" 
?>

<?php // ---------------------------------- GAME OVER ---------------------------------- / 
?>

<?php
if (is_active_sidebar('main-sidebar') || is_active_sidebar('sticky-sidebar')) {
	$td_wide = '';
} else {
	$td_wide = 'td-wide';
}

?>

<div id="content" class="grid col-700 <?php echo esc_attr($td_wide); ?>">

	<div class="td-content-inner-single">
		<div class="widget-title">

			<?php if (defined('MYARCADE_VERSION') && is_game()) : ?>

				<h3><?php _e('Game Details', 'gameleon'); ?></h3>

			<?php else : ?>

				<?php the_title('<h1>', '</h1>'); ?>

			<?php endif; // end of check "MYARCADE_VERSION" 
			?>

		</div>

		<div class="td-wrap-content">

			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php
						$td_show_post_meta = get_theme_mod('gameleon_single_post_meta');
						if ($td_show_post_meta == 1) : ?>
							<?php get_template_part('post-single-meta'); ?>
						<?php endif; ?>

						<div class="post-entry">

							<?php
							$feat_image = get_theme_mod('gameleon_featured_image');

							if (defined('MYARCADE_VERSION') && is_game() && $feat_image) : ?>

								<a href="<?php echo esc_url($thumb_url); ?>" title="<?php myarcade_title(); ?>">
									<?php myarcade_thumbnail(); ?>
								</a>

							<?php else : ?>
								<?php gameleon_featured_image(); ?>
							<?php endif; ?>

							<?php the_content(__('Read More...', 'gameleon')); ?>
							<?php get_template_part('post-data'); ?>
							<?php if (get_theme_mod('gameleon_single_nav') == 1 && !defined('MYARCADE_VERSION')) : ?>

								<div class="navigation">
									<div class="previous"><?php previous_post_link(' <i class="fas fa-chevron-left"></i>  &nbsp;  %link'); ?></div>
									<div class="next"><?php next_post_link('%link &nbsp; <i class="fas fa-chevron-right"></i>'); ?></div>
								</div><?php // end of .navigation / 
										?>

							<?php endif; // end if( get_theme_mod( 'td_post_navigation' ) 
							?>

							<?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'gameleon'), 'after' => '</div>')); ?>

							<div class="clearfix"></div>

						</div><?php // end of .post-entry / 
								?>
					</div><?php // end of #post-the_ID(); / 
							?>
		</div><?php // end of td-wrap-content / 
				?>
	</div><?php // end of td-content-inner / 
			?>

	<?php if (get_theme_mod('gameleon_single_author_box') == 1) : ?>

		<div class="td-content-inner-single">
			<div id="author-meta">
				<?php if (function_exists('get_avatar')) {
							echo get_avatar(get_the_author_meta('user_email'), '100');
						} ?>
				<div class="about-author"><?php the_author_posts_link(); ?></div>

				<div class="auth-desc vcard author"><span class="fn">
						<?php if (get_the_author_meta('description')) : ?>
							<?php the_author_meta('description') ?>
						<?php else : ?>
							<?php _e('This user hasn not filled out his biographical info.', 'gameleon');  // no description, no author's meta  
							?>
						<?php endif; // no description, no author's meta 
						?>
					</span></div>
				<div class="clearfix"></div>
			</div><?php // end of #author-meta / 
					?>
		</div><?php // end of td-content-inner-single / 
				?>
	<?php endif; ?>

	<?php if (function_exists('wpsabox_author_box')) : ?>
		<div class="td-content-inner-single-sabox">
			<?php echo wpsabox_author_box(); // Simple Author Box plugin 
			?>
		</div><?php // end of td-content-inner-single-sabox / 
				?>
	<?php endif; ?>

	<?php echo gameleon_related_posts(); ?>
	<?php comments_template('', true); ?>
<?php endwhile;
			endif; ?>

<?php get_template_part('loop-nav'); // pagination 
?>

</div><?php // end of #content / 
		?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>