<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST TABS - TEMPLATE-PART FILE
-----------------------------------------------------------------------------------------------------------*/
?>


<div class="homepage-block-tabs">
<div class="grid-image">

<?php if( has_post_thumbnail() || is_myarcade_game() ): ?>
<?php $image = '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'module-tabs' ) . '<div class="dark-cover"></div></a>'; ?>
<?php if ( empty( $image[0] ) ) { $image[0] = myarcade_get_thumbnail_url (); } ?>

<div class="td-shadow">
<?php echo html_entity_decode( esc_html( $image ) ); ?>
</div>

<?php else: // show image placeholder?>

<div class="td-shadow">
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholders/140x80.png" width="140" height="80" alt="<?php the_title(); ?>" />
</a>
</div>

<?php endif; // end of get_the_post_thumbnail ?>

<h2>
<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
<?php echo wp_trim_words( get_the_title(), 4 ); ?>
</a>
</h2>
</div><?php // end of grid-image ?>

</div><?php // end of .homepage-block-tabs ?>
