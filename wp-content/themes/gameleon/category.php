<?php get_header(); ?>
<?php
// option to display posts in blog layout
$display_blog_layout = get_theme_mod( 'gameleon_category_layout' );
if ( $display_blog_layout == 1 ) {
$td_blog_layout_view = 'td-blog-view';
} elseif ( $display_blog_layout == 2 ) {
$td_blog_layout_view = '';
} else{
    $td_blog_layout_view = 'td-none';
}
?>

<?php 
if( is_active_sidebar( 'main-sidebar' ) || is_active_sidebar( 'sticky-sidebar' ) ){
	$td_wide = '';
} else {
	$td_wide = 'td-wide';
}
?>
 

<div id="main-wrapper" class="td-category grid col-700 <?php echo esc_attr( $td_wide ); ?>">

<div class="td-content-inner">

<div class="widget-title">
<h1><?php echo single_cat_title( '', false ); ?></h1>
</div>

<div class="td-wrap-content <?php echo esc_attr( $td_blog_layout_view ); ?>">

<?php
// ----------- display category description if is filled
// ---------------------------------------------------------------------------
?>

<?php
$category_description = category_description();
if ( ! empty( $category_description ) ) {
echo apply_filters( 'category_archive_meta', '<div class="td-category-description">' . $category_description . '</div>' );
}
?>

<?php
// ----------- category query
// ---------------------------------------------------------------------------
?>
<?php gameleon_ad_top(); //  hooks for display the ad on top ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 0 === $GLOBALS['wp_query']->current_post % 2 ? 'grid col-340' : 'grid col-340 fit' ); ?>>
<div class="second-wrap-content"><?php // second-wrap-content ?>

<div class="td-fly-in">

<?php if ( $display_blog_layout == 1 ) : ?>
<?php get_template_part( 'post-img-blog' ); // post image ?>
<?php elseif ( $display_blog_layout == 2 ) : ?>
    <?php get_template_part( 'post-img-blog' ); // post image ?>
<?php else : ?>
<?php get_template_part( 'post-img' ); // post image ?>
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