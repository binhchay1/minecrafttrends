<?php
/*
Template Name: Most Viewed/Played
*/
?>
<?php get_header(); ?>

<div id="main-wrapper" class="grid col-700">

<div class="td-content-inner">

<div class="widget-title">
<h1>
<?php if ( defined( 'MYARCADE_VERSION' ) ): ?>
<?php _e( 'Most Played Games', 'gameleon' ); ?>
<?php else: ?>
<?php _e( 'Most Viewed Articles', 'gameleon' ); ?>
<?php endif; ?>
</h1>
</div>

<?php
// meta_key
$td_metakey = 'post_views_count';
global $wp_query, $paged;
if( get_query_var( 'paged' ) ) {
$paged = get_query_var( 'paged' );
} elseif( get_query_var( 'page' ) ) {
$paged = get_query_var( 'page' );
} else {
$paged = 1;
}

// exclude posts option
$exclude_from_all_mostplayed 	= get_theme_mod( 'td_viewed_page_template_exclude_cat' );
$exclude_from_all_mostplayed 	= explode(',',$exclude_from_all_mostplayed); //break the string into array keys

$mostplayed = new WP_Query( array(  'category__not_in' => $exclude_from_all_mostplayed, 'orderby' => 'meta_value_num', 'meta_key' => $td_metakey, 'paged' => $paged ) );
$temp_query = $wp_query;
$wp_query = null;
$wp_query = $mostplayed;

// display posts in blog style option
$display_blog_layout = get_theme_mod( 'blog_layout_custom_pages' );
if ( $display_blog_layout == 2) {
$td_blog_layout_view = 'td-blog-view';
} else {
$td_blog_layout_view = '';
}
?>

<div class="td-wrap-content <?php echo esc_attr( $td_blog_layout_view ); ?>"><?php // td-wrap-content ?>

<?php responsive_ad_custom_pages_top(); // show the top custom page ad ?>

<?php if( $mostplayed->have_posts() ) : while( $mostplayed->have_posts() ) : $mostplayed->the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 0 === $GLOBALS['wp_query']->current_post % 2 ? 'grid col-340' : 'grid col-340 fit' ); ?>>
<div class="second-wrap-content"><?php // second-wrap-content ?>

<div class="td-fly-in">

<?php if ( $display_blog_layout == 1 ) : ?>
<?php get_template_part( 'post-img-blog' ); // post image ?>
<?php else : ?>
<?php get_template_part( 'post-img' ); 		// post image ?>
<?php endif; ?>

<?php get_template_part( 'post-details-archive' ); 	// post title and excerpt ?>


</div><?php // end of td-fly-in ?>
</div><?php // end of second-wrap-content ?>
</div><?php // end of #post id ?>

<?php endwhile; endif; ?>

<div class="clearfix"></div>
<?php responsive_ad_custom_pages_bottom(); // show the top custom page ad ?>

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