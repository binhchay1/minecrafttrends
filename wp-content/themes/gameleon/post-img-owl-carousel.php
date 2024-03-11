<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST TABS - TEMPLATE-PART FILE
-----------------------------------------------------------------------------------------------------------*/
?>

 
<?php if( has_post_thumbnail() || is_myarcade_game() ): ?>
<?php $image = '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'wide-size' ) . '</a>'; ?>
<?php if ( empty( $image[0] ) ) { $image[0] = myarcade_get_thumbnail_url (); } ?>
<?php echo html_entity_decode( esc_html( $image ) ); ?>
<?php endif; // end of get_the_post_thumbnail ?>
