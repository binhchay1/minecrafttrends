<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
    BLOG VIEW - standard blog "latest posts" view
    -----------------------------------------------------------------------------------------------------------*/
    get_header(); 
?>

<?php 
if( is_active_sidebar( 'main-sidebar' ) || is_active_sidebar( 'sticky-sidebar' ) ){
	$td_wide = '';
} else {
	$td_wide = 'td-wide';
}

?>
<div id="main-wrapper" class="td-blog-layout-home grid col-700 <?php echo esc_attr( $td_wide ); ?>">

<div class="td-content-inner">
	<?php if( have_posts() ) : ?>
		<?php while( have_posts() ) : the_post(); ?>


			 
<div class="td-wrap-content">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-entry">
		<div class="td-fly-in">

			<h3 class="entry-title">
				<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
				<?php echo get_the_title(); ?>
				</a>
			</h3>

			<?php get_template_part( 'post-single-meta' ); ?>

			<div class="post-entry">
				<?php if ( '' != get_the_post_thumbnail() ) : // if( has_post_thumbnail() ) ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php get_template_part( 'post-img-blog-index' ); // post image ?>
					</a>
				<?php endif; ?>

				<?php the_content( __( 'Read More...', 'gameleon' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'gameleon' ), 'after' => '</div>' ) ); ?>
				</div><?php // end of .post-entry / ?>

				
				</div><?php // end of td-fly-in ?>
				</div><?php // end of post-entry ?>


				</div><?php // end of td-wrap-content / ?>
				</div><?php // end of td-content-inner / ?>



<?php // pagination
endwhile;
get_template_part( 'loop-nav' );
else :
get_template_part( 'loop-no-posts' );
endif;
?>
</div>
</div><?php // end of main-wrapper ?>

<?php 
if( is_active_sidebar( 'main-sidebar' ) || is_active_sidebar( 'sticky-sidebar' ) ){
get_sidebar(); 
}
?>
<?php get_footer(); ?>