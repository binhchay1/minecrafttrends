<?php get_header(); ?>

<div id="main-wrapper" class="td-blog-layout grid col-700">
<div class="td-content-inner">

<div class="widget-title">
<h1>
<?php _e('404 PAGE NOT FOUND', 'gameleon'); ?>
</h1>
</div>

<div class="td-wrap-content"><?php // td-wrap-content ?>
<div class="page404_text">
<?php _e( 'Grats. You broke it', 'gameleon' ); ?>
<div class="clearfix"></div>

<span class="button light">
	<a href="<?php echo home_url(); ?>">
		<?php _e( 'Back To Home', 'gameleon' ); ?>
	</a>
</span>
</div><?php // end of page404_text ?>

</div><?php // end of td-wrap-content ?>
</div><?php // end of td-content-inner ?>
</div><?php // end of main-wrapper ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>