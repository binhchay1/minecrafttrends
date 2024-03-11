<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	POST DATA TEMPLATE-PART FILE
-----------------------------------------------------------------------------------------------------------*/

?>
<?php if( is_single() ) { echo gameleon_share_box(); } ?>
<?php //if( is_single() ) { echo gameleon_mini_share(); } ?>
<?php edit_post_link( __( ' Edit', 'gameleon' ), '<div class="post-edit fa fa-edit">', '</div>' ); ?>