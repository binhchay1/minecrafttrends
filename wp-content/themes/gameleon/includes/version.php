<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	THEME VERSION CONTROL
-----------------------------------------------------------------------------------------------------------*/
?>
<?php
function gameleon_theme_data() {
	if( is_child_theme() ) {
		echo '<!-- ' . get_gameleon_theme_name() . ' ' . get_gameleon_theme_version() . ' -->' . "\n";
	}
}

add_action( 'wp_head', 'gameleon_theme_data' );


/*----------------------------------------------------
	GET THEME NAME
-----------------------------------------------------*/

function get_gameleon_theme_name() {
	$theme = wp_get_theme();

	return $theme->Name;
}


/*----------------------------------------------------
	GET THEME VERSION
-----------------------------------------------------*/

function get_gameleon_theme_version() {
	$theme = wp_get_theme();

	return $theme->Version;
}


/*----------------------------------------------------
	GET TEMPLATE NAME
-----------------------------------------------------*/

function get_gameleon_template_name() {
	$theme  = wp_get_theme();
	$parent = $theme->parent();
	if( $parent ) {
		$theme = $parent;
	}

	return $theme->Name;
}


/*----------------------------------------------------
	GET TEMPLATE VERSION
-----------------------------------------------------*/

function get_gameleon_template_version() {
	$theme  = wp_get_theme();
	$parent = $theme->parent();
	if( $parent ) {
		$theme = $parent;
	}

	return $theme->Version;
}