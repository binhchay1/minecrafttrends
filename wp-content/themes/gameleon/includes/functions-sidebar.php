<?php

/*----------------------------------------------------------------------------------------------------------
    * REGISTER SIDEBARS
    * Please do not make any changes to this file.
-----------------------------------------------------------------------------------------------------------*/

// If this file is called directly, busted!
if ( ! defined( 'WPINC' ) ) {
    die;
}

function gameleon_widgets_init() {

register_sidebar( array(
    'name'          => __( 'Home Page', 'gameleon' ),
    'description'   => __( 'Add widgets here to build your home page.', 'gameleon' ),
    'id'            => 'homepage-sidebar',
    'before_title'  => '<div class="widget-title"><h3>',
    'after_title'   => '</h3></div>',
    'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
    'after_widget'  => '</div>'
    ) );


register_sidebar( array(
    'name'          => __( 'Home Wide', 'gameleon' ),
    'description'   => __( 'This area displays content on top home page. For now, it is only functional for Home Block 4 and Home Block 6 widgets.', 'gameleon' ),
    'id'            => 'home-wide',
    'before_title'  => '<div class="widget-title"><h3>',
    'after_title'   => '</h3></div>',
    'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
    'after_widget'  => '</div>'
    ) );

        
register_sidebar( array(
    'name'          => __( 'Main Sidebar', 'gameleon' ),
    'description'   => __( 'This area displays content on your right sidebar.', 'gameleon' ),
    'id'            => 'main-sidebar',
    'before_title'  => '<div class="widget-title"><h3>',
    'after_title'   => '</h3></div>',
    'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
    'after_widget'  => '</div>'
    ) );


register_sidebar( array(
    'name'          => esc_html__( 'Sticky Sidebar', 'gameleon' ),
    'description'   => esc_html__( 'This is the sticky sidebar. The widgets added to this sidebar will be always pinned to top while you are scrolling through your website content.', 'gameleon' ),
    'id'            => 'sticky-sidebar',
    'before_title'  => '<div class="widget-title"><h3>',
    'after_title'   => '</h3></div>',
    'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
    'after_widget'  => '</div>'
    ) );

register_sidebar( array(
    'name'          => __( 'Footer Widget 1', 'gameleon' ),
    'description'   => __( 'Displays content on the first footer widget.', 'gameleon' ),
    'id'            => 'footer-one',
    'before_title'  => '<div class="widget-title"><h3>',
    'after_title'   => '</h3></div>',
    'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
    'after_widget'  => '</div>'
    ) );

register_sidebar( array(
    'name'          => __( 'Footer Widget 2', 'gameleon' ),
    'description'   => __( 'Displays content on the second footer widget.', 'gameleon' ),
    'id'            => 'footer-two',
    'before_title'  => '<div class="widget-title"><h3>',
    'after_title'   => '</h3></div>',
    'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
    'after_widget'  => '</div>'
    ) );

register_sidebar( array(
    'name'          => __( 'Footer Widget 3', 'gameleon' ),
    'description'   => __( 'Displays content on the third footer widget.', 'gameleon' ),
    'id'            => 'footer-three',
    'before_title'  => '<div class="widget-title"><h3>',
    'after_title'   => '</h3></div>',
    'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
    'after_widget'  => '</div>'
    ) );

}

add_action( 'widgets_init', 'gameleon_widgets_init' );