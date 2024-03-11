<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}


/*----------------------------------------------------------------------------------------------------------
	LOOP NAVIGATION TEMPLATE-PART FILE - OUTPUT PREV/NEXT POSTS LINKS
-----------------------------------------------------------------------------------------------------------*/

?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>

 <?php if( function_exists( 'wp_pagenavi' ) ) { // We use WP-PageNavi if active ?>
	 <?php wp_pagenavi(); // Use WP-PageNavi ?>
 <?php } else { // Otherwise, use the default theme navigation ?>

	<div class="navigation">
		<div class="previous"><?php next_posts_link( __( 'Older posts', 'gameleon' ) ); ?></div>
		<div class="next"><?php previous_posts_link( __( 'Newer posts', 'gameleon' ) ); ?></div>
        <div class="clear"></div>
	</div><?php //end of .navigation navigation-fa / ?>

<?php } ?>
<?php endif; ?>