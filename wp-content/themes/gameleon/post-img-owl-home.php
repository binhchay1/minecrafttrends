<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST TABS - TEMPLATE-PART FILE
-----------------------------------------------------------------------------------------------------------*/
?>

<div class="td-owl-item">
<?php if( has_post_thumbnail() || is_myarcade_game() ): ?>
<?php $image = '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'module-minicarousel' ) . '</a>'; ?>
<?php if ( empty( $image[0] ) ) { $image[0] = myarcade_get_thumbnail_url (); } ?>
<?php echo html_entity_decode( esc_html( $image ) ); ?>
<?php else: // show image placeholder?>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholders/90x59.png" width="90" height="59" alt="<?php the_title(); ?>" />
</a>

<?php endif; // end of get_the_post_thumbnail ?>

</div><?php // end of grid-image ?>
