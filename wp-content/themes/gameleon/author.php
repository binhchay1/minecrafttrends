<?php get_header(); ?>

<?php
global $post;

global $author_part_obj;
$author_part_obj = ( get_query_var( 'author_name' )) ? get_user_by( 'slug', get_query_var( 'author_name' )) : get_userdata( get_query_var( 'author' ) );

$td_show_meta = get_theme_mod( 'td_show_meta_pages' );

// option to display posts in blog layout
$display_blog_layout = get_theme_mod('td_blog_layout_custom_pages');
if ( $display_blog_layout == 1 ) {
$td_blog_layout_view = 'td-blog-view';
} else {
$td_blog_layout_view = '';
}
?>

<div id="main-wrapper" class="grid col-700">

<div class="td-content-inner">

<div class="widget-title">
<h1>
<?php echo esc_html( $author_part_obj->display_name ); ?>
</h1>
</div>

<?php  if( !function_exists( 'wpsabox_author_box' ) ) : ?>
<?php  if( $author_part_obj->description != '' ) : ?>

<div class="author-archive-wrap">
<div id="author-meta">
<?php if( function_exists( 'get_avatar' ) ) {
echo get_avatar( $author_part_obj->user_email, '100' );
}
?>
<div class="about-author"><?php the_author_posts_link(); ?></div>
<div class="author-page-desc vcard author"><span class="fn"><?php echo esc_html( $author_part_obj->description ); ?></span></div>
<div class="website-author"><a href="<?php echo esc_html( $author_part_obj->user_url ); ?>" target="_blank"><?php echo esc_html( $author_part_obj->user_url ); ?></a></div>

<div class="clearfix"></div>
</div><?php // end of #author-meta / ?>
</div><?php // end of author-archive-wrap / ?>


<?php else : ?>
<div class="td-no-info">
<?php  _e( 'This user hasn not filled out his biographical info.', 'gameleon' );  // no description, no author's meta  ?>
</div>
<?php endif;?>

<?php endif; // end of wpsabox_author_box function check )?>

<div class="sabox-gameleon-wrap">
<?php if ( function_exists( 'wpsabox_author_box' ) ) echo wpsabox_author_box(); // Our Simple Author Box plugin ?>
</div>


<div class="td-wrap-content <?php echo esc_attr( $td_blog_layout_view ); ?>"><?php // td-wrap-content ?>
<?php gameleon_ad_top(); //  hooks for display the ad on top ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

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
