<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	THE RIGHT TOP MENU OF THE THEME
-----------------------------------------------------------------------------------------------------------*/
?>
<?php

if ( has_nav_menu( 'topright' ) ) : ?>
<div class="right-menu-wrap">
<div id="navigation-bar">
		<?php
		wp_nav_menu( array(
			'container'      => false,
			'fallback_cb'    => '',
			'menu_class'     => 'top-right',
			'theme_location' => 'topright'
			)
		);

		?>

</div><?php // end of #navigation-bar ?>
</div><?php // end of right-menu-wrap ?>
<?php endif; // end of  has_nav_menu ?>