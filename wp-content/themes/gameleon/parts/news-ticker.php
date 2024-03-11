<?php
// filter posts by category
$newsticker_cat_option = get_theme_mod( 'td_newsticker_category' );

// number of news to show
$td_news_number 		= get_theme_mod( 'td_newsticker_number' );
// show excerpt
$newsticker_excerpt 	= get_theme_mod( 'td_newsticker_excerpt' );
// show date
$newsticker_date 		= get_theme_mod( 'td_newsticker_date' );
// block news title
$td_ticker_title 		= get_theme_mod( 'td_newsticker_title' );
?>
<div class="modern-ticker">
<div class="mt-body">
<div class="mt-label"><?php echo esc_html( $td_ticker_title ); ?></div>
<div class="mt-news">
<ul>

<?php $newsticker_posts = new WP_Query(array( 'cat' => $newsticker_cat_option, 'posts_per_page' => $td_news_number )); ?>
<?php while( $newsticker_posts->have_posts()) : $newsticker_posts->the_post();?>

<li class="news-item">

<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
<?php if ( $newsticker_date ) : ?>
	<span class="news-date"><?php the_time('F j, Y'); ?></span>
<?php endif; ?>

	<span class="news-title"><?php the_title(); ?></span>

<?php if ( $newsticker_excerpt ) : ?>
	<span class="news-excerpt"><?php echo td_global_excerpt( 10 ); ?></span>
<?php endif; ?>

</a>

</li>
<?php endwhile; ?>
 <?php wp_reset_query(); ?>
</ul>
</div>
<div class="mt-controls">
<div class="mt-prev"><i class="fas fa-chevron-left"></i></div>
<div class="mt-next"><i class="fas fa-chevron-right"></i></div>
</div>
</div>
</div>