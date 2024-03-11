<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	STATIC HOME PAGE TEMPLATE
-----------------------------------------------------------------------------------------------------------*/

?>

<div id="homepage-wrap" class="grid col-700">

<?php if( is_active_sidebar( 'homepage-sidebar' ) ){
		dynamic_sidebar( 'homepage-sidebar' );
	} 
	?>


</div><?php // end of homepage-wrap ?>