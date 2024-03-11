<?php
/* Template Name: Full Width Template */
?>
<?php get_header(); ?>

<div id="main-wrapper-full">

<div class="widget-title">
<h1>
<?php the_title(); ?>
</h1>
</div>

<div class="td-wrap-content"><?php // td-wrap-content ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="post-entry">
<div class="td-fly-in">

<?php the_content( __( 'Read More...', 'gameleon' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'gameleon' ), 'after' => '</div>' ) ); ?>

</div><?php // end of td-fly-in ?>
</div><?php // end of post-entry ?>
</div><?php // end of #post id ?>

<?php endwhile; endif; ?>

<?php get_template_part( 'loop-nav' ); // pagination ?>

</div><?php // end of td-wrap-content ?>

</div><?php // end of main-wrapper ?>

<?php get_footer(); ?>