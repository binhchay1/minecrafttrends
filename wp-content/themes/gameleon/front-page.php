<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	HOME PAGE TEMPLATE
	If front page is set to "Blog", include index.php to display standard blog "latest posts" view.
	Otherwise, display static front page content that can be built on the Widgets area.
-----------------------------------------------------------------------------------------------------------*/
?>
<?php 
$hide_sidebar	= get_theme_mod( 'gameleon_home_sidebar' )
?>


<?php if ( get_theme_mod( 'gameleon_layout_homepage_layout' ) == '1' ) {
		get_header();
		get_sidebar( 'home' );
		if ( !$hide_sidebar == 1 ) {
		get_sidebar();
		}
		get_footer();
} else {
	locate_template( 'index.php', true );
}

?>