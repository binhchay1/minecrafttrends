<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------------------------------------------
    PAGE TEMPLATE- WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/

get_header(); ?>

<?php 
if( is_active_sidebar( 'main-sidebar' ) || is_active_sidebar( 'sticky-sidebar' ) ){
	$td_wide = '';
} else {
	$td_wide = 'td-wide';
}

?>
<div id="content" class="grid col-700 <?php echo esc_attr( $td_wide ); ?>">

<div class="td-content-inner">

<div class="widget-title">
<h1><?php the_title(); ?></h1>
</div>


<div class="td-wrap-content">

<?php if( have_posts() ) : ?>
<?php while( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="post-entry">
<div class="td-fly-in">

<?php the_content( __( 'Read More...', 'gameleon' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'gameleon' ), 'after' => '</div>' ) ); ?>

</div><?php // end of td-fly-in ?>
</div><?php // end of post-entry ?>
</div><?php // end of #post id ?>


<?php endwhile; endif; ?>

</div><?php // end of td-wrap-content / ?>
</div><?php // end of td-content-inner / ?>

<div class="td-single-page-wrap clearfix">
<?php comments_template( '', true ); ?>
</div>

<?php
// ----------- pagination
// ---------------------------------------------------------------------------
?>

<?php get_template_part( 'loop-nav' ); ?>

</div><?php // end of main-wrapper ?>

 
<?php get_sidebar(); ?>
<?php get_footer(); ?>