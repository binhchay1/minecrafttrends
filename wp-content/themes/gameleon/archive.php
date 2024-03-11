<?php get_header(); ?>
<?php 
if( is_active_sidebar( 'main-sidebar' ) || is_active_sidebar( 'sticky-sidebar' ) ){
	$td_wide = '';
} else {
	$td_wide = 'td-wide';
}
?>
<div id="main-wrapper" class="grid col-700 <?php echo esc_attr( $td_wide ); ?>">

<div class="td-content-inner">
<div class="widget-title">
<h1>
<?php if(is_day()): ?>
<?php printf(__('Daily Archives: <span>%s</span>', 'gameleon' ), get_the_date()); ?>
<?php elseif ( is_month() ) : ?>
<?php printf(__('Monthly Archives: <span>%s</span>', 'gameleon' ), get_the_date( 'F Y' )); ?>
<?php elseif ( is_year() ) : ?>
<?php printf(__('Yearly Archives: <span>%s</span>', 'gameleon' ), get_the_date( 'Y' )); ?>
<?php else : ?>
<?php _e( 'Blog Archives', 'gameleon' ); ?>
<?php endif; ?>
</h1>
</div>

<?php
// display posts in blog layout option
$display_blog_layout = get_theme_mod( 'gameleon_category_layout' );


if ( $display_blog_layout == "2" ) {
$td_blog_layout_view = 'td-blog-view';
} else {
$td_blog_layout_view = '';
}
?>

<div class="td-wrap-content <?php echo esc_attr( $td_blog_layout_view ); ?>">

<?php gameleon_ad_top(); //  hooks for display the ad on top ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="second-wrap-content"><?php // second-wrap-content ?>

<div class="td-fly-in">

<?php if ( $display_blog_layout == "1" ) : ?>
<?php get_template_part( 'post-img-blog' ); // post image ?>
<?php else : ?>
<?php get_template_part( 'post-img-big' ); 		// post image ?>
<?php endif; ?>

<?php get_template_part( 'post-details-archive' ); 	// post title and excerpt ?>

</div><?php // end of td-fly-in ?>
</div><?php // end of second-wrap-content ?>
</div><?php // end of #post id ?>


<?php endwhile; endif; ?>

<div class="clearfix"></div>
<?php gameleon_ad_bottom(); //  hooks for display ad on bottom ?>
</div><?php // end of td-wrap-content / ?>
</div><?php // end of td-content-inner / ?>

<?php
// ----------- pagination
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'loop-nav' ); ?>

</div><?php // end of main-wrapper ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>