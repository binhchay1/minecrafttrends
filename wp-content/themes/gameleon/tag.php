<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------------------------------------------
    TAGS TEMPLATE- WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/

get_header(); ?>

<?php 
if( is_active_sidebar( 'main-sidebar' ) || is_active_sidebar( 'sticky-sidebar' ) ){
	$td_wide = '';
} else {
	$td_wide = 'td-wide';
}
?>
 
<div id="content" class="td-blog-layout grid col-700 <?php echo esc_attr( $td_wide ); ?>">
<div class="td-content-inner">

<div class="widget-title">
<h1><?php _e('Tag', 'gameleon' ); ?>: <?php echo single_cat_title('', false ); ?></h1>
</div>

<div class="td-wrap-content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="post-entry">
<div class="td-fly-in">

<?php get_template_part( 'post-img-blog' ); // post image ?>

<?php get_template_part( 'post-details-archive' ); 	// post title and excerpt ?>

<?php //get_template_part( 'post-meta' ); // date, views, likes and comments ?>

</div><?php // end of td-fly-in ?>
</div><?php // end of post-entry ?>
</div><?php // end of #post id ?>

<?php endwhile; endif; ?>

</div><?php // end of td-wrap-content / ?>
</div><?php // end of td-content-inner / ?>

<?php get_template_part( 'loop-nav' ); // pagination ?>

</div><?php // end of #content / ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>