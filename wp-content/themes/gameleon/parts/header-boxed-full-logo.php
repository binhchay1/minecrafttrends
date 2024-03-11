<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	BOXED: FULL LOGO - WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/
?>

<?php
$td_logo 		= get_theme_mod( 'td_custom_logo_wide' );
$td_logo_alt 	= get_theme_mod( 'td_custom_logo_alt' );
$td_logo_title 	= get_theme_mod( 'td_custom_logo_title' );
$td_search_icon   = get_theme_mod( 'td_search_icon' );
if ( $td_logo_title ) {
	$td_title = $td_logo_title;
} else {
	$td_title = 'Gameleon';
}

?>
<?php
// read the custom logo image if it's set
if( $td_logo && $td_logo != '' ) :
	?>
<div id="logo-full"> 
	<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo esc_url( $td_logo ); ?>" width="auto" height="auto" alt="<?php echo esc_html( $td_logo_alt ); ?>" title="<?php echo esc_html( $td_logo_title ); ?>" /></a>
</div><?php // end of #logo / ?>

<?php else : // show the text logo if the logo image isn't set ?>

	<div id="text-logo-full">
		<span class="site-name-full">
			<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_html( $td_logo_title ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</span>
		<span class="site-description"><?php bloginfo( 'description' ); ?></span>
	</div><?php // end of #text-logo / ?>

<?php endif; ?>

<?php if ( ! has_nav_menu( 'mainmenu' ) ) : ?>
<div id="topbar">
<div class="container">
<div id="wrapper-menu" >
  <div class="td-wrapper-box">
 
		<div id="top-navigation">
			<nav class="navigation">
			<?php
			wp_nav_menu( 
				array( 
					'fallback_cb' => 'gameleon_fallback_menu', 
					'menu' => 'menu', 
					'container' => false, 
					'menu_id' => 'menu', 
					'menu_class'=>'', 
					'theme_location'=>'mainmenu' 
					) 
				);
			?>
			
			</nav><!-- .navigation -->
		</div><!-- #top-navigation -->
</div>
</div>
</div>
</div>
<?php else : ?>
	<?php locate_template('parts/header-menu.php', true ); ?>
<?php endif; ?>