<?php
/*----------------------------------------------------------------------------------------------------------
	MODULAR SLIDER
-----------------------------------------------------------------------------------------------------------*/
?>

<div id="td-modular-slider" class="grid col-1060">

<?php
global $wp_query;
$filter_slider_posts 	= get_theme_mod( 'td_filter_slider_posts' );
$td_modular_slider 		= get_theme_mod( 'td_modular_slider_shortcode' );
$td_post_per_page 		= get_theme_mod( 'td_modular_slider_number' );

if ( !empty( $td_modular_slider ) ) { // if is not built-in slider set the offset to posts_per_page option
$td_offset = 0;
} else {
$td_offset = $td_post_per_page;
}


// filter posts by tag slug
$slider_tags_option = get_theme_mod( 'td_slider_tags_in' );
$slider_tags_option = explode(',',$slider_tags_option); //break the string into array keys

 if ( $slider_tags_option and $filter_slider_posts == 1 ) {
 	$slider_tags = '';
 } else {
 	$slider_tags = $slider_tags_option;
 }

$slider_posts 	= new WP_Query( array( 'ignore_sticky_posts' => 1, 'tag' => $slider_tags, 'posts_per_page' => $td_post_per_page ) );
?>


<?php /* SLIDER MODULE */ ?>
<div class="td-main-slide grid col-610">


<?php
if ( empty( $td_modular_slider ) ) : // check if slider shortcode is added ?>
<div class="flexslider">
<ul class="slides">
<?php while( $slider_posts->have_posts()) : $slider_posts->the_post();?>
<li>
<?php get_template_part( 'post-img-slider-big' ); // big slider image ?>
<div class="main-slide-text">
<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
<div class="main-excerpt"><p><?php echo td_global_excerpt( 20 ); ?></p></div>
</div><?php /* end of main-slide-text */ ?>
</li>
<?php endwhile; ?>
</ul>
</div>
<?php else: // load the slider shortcode ?>
<?php echo do_shortcode( $td_modular_slider ); ?>
<?php endif; ?>
</div><?php /* end of td-main-slide grid col-610 */ ?>

<?php /* STATIC SLIDER MODULE - SMALL IMAGES */ ?>

<?php $slider_posts = new WP_Query(array( 'ignore_sticky_posts' => 1, 'tag' => $slider_tags, 'posts_per_page' => 4, 'offset' => $td_offset  )); while( $slider_posts->have_posts()) : $slider_posts->the_post();?>

<div class="small-posts-slider grid col-250">
<?php get_template_part( 'post-img-slider-small' ); // big featured image ?>

<div class="small-slide-title">
<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
</div><?php /* end of small-slide-title */ ?>


</div><?php /* end of small-posts-slider */ ?>

<?php endwhile; ?>
 <?php wp_reset_query(); ?>
</div><?php /* end of td-modular-slider */ ?>
<div class="clearfix"></div>