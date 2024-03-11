 <?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	MAIN MENU OF THE THEME
-----------------------------------------------------------------------------------------------------------*/
?>

<?php
$td_sticky_menu   = get_theme_mod( 'td_sticky_menu' );
$td_search_icon   = get_theme_mod( 'td_search_icon' );

if ( $td_sticky_menu ) {
  $td_sticky = 'td-sticky';
} else {
  $td_sticky = '';
}

?>

<div class="desktop-handle td-auto-hide-header" id="topbar">

<div class="container">
<div id="wrapper-menu" class="<?php echo esc_attr( $td_sticky ); ?>">
  <div class="td-wrapper-box">
  <div class="td-shadow">
  <?php if ( has_nav_menu( 'mainmenu' ) ) : ?>
		<div id="top-navigation">
			<nav class="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'mainmenu',
					'container' => false,
					'fallback_cb' => 'gameleon_fallback_menu', 
					'menu_class' => 'menu'
				) ); ?>
			</nav><!-- .navigation -->
		</div><!-- #top-navigation -->
	<?php endif; ?>
  </div>    

<?php if ( $td_search_icon == 1 ) : ?>
<div class="menu-search-wrap">
	<div class="main-menu-search">

		<div id="search-container" class="click-search">
    <div class="delimiter-wrapper"><div class="delimiter"></div></div>
    <i class="fas fa-search"></i>
		</div>

		<div class="td-expand">
			<form role="search" method="get" class="td-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="menu-search-form-wrap">
					<input id="td-header-search"  placeholder="<?php echo _e('search', 'gameleon'); ?>" type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" /><input class="td-search-button button" type="submit" id="td-search-main-menu" value="<?php echo _e('search', 'gameleon'); ?>" />
				</div>
			</form>

		</div>
	</div>
</div>  
<?php endif; ?>

</div>
</div>
</div>
</div>