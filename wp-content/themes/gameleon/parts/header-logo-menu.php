<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
HEADER RIGHT MENU ICONS
-----------------------------------------------------------------------------------------------------------*/
?>
<div class="td-right-icons">
<?php if( has_nav_menu( 'topright', 'gameleon' ) ) : ?>
            <?php wp_nav_menu( array(
                'container'      => '',
                'fallback_cb'    => false,
                'menu_class'     => 'right-menu',
                'theme_location' => 'topright'
                )
            );
            ?>
        <?php endif; ?>
</div>