<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	BOXED: LOGO + AD - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/
?>

<?php
$td_logo 		= get_theme_mod( 'td_site_logo' );
$td_logo_alt 	= get_theme_mod( 'td_custom_logo_alt' );
$td_logo_title 	= get_theme_mod( 'td_custom_logo_title' );


if ( $td_logo_title ) {
	$td_title = $td_logo_title;
} else {
	$td_title = 'Gameleon';
}

?>
 
<?php
// read the custom logo image if it's set
if( $td_logo && $td_logo != '' ) : ?>
<div id="logo">
	<h1><a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url( $td_logo ); ?>" width="250" height="100" alt="<?php echo esc_attr( $td_logo_alt ); ?>" title="<?php echo esc_attr( $td_logo_title ); ?>" /></a></h1>
</div>
<?php else : // show the text logo if the logo image isn't set ?>
<h1>
	<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( $td_logo_title ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
</h1>

<?php endif; ?>
 
<?php echo responsive_ad_header(); // show the header ad ?>