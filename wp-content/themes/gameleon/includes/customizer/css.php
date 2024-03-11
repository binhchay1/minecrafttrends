<?php

// WIDE LOGO TOP MARGIN
////////////////////////////////////////////////////////////////////////////////

function gameleon_widelogo_top_margin_css() {

    $widelogo_top_margin_css_default  = 0;
    $widelogo_top_margin           = get_theme_mod( 'td_wide_logo_top_margin', $widelogo_top_margin_css_default );
    if ( $widelogo_top_margin      == $widelogo_top_margin_css_default ) { return; }
    $widelogo_top_margin_css       = 
    "
    #logo-full {
            margin-top: {$widelogo_top_margin}px;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $widelogo_top_margin_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_widelogo_top_margin_css' );


// WIDE LOGO MAX WIDTH
////////////////////////////////////////////////////////////////////////////////

function gameleon_widelogo_max_width_css() {

    $widelogo_max_width_css_default  = 0;
    $widelogo_max_width           = get_theme_mod( 'td_logo_max_width', $widelogo_max_width_css_default );
    if ( $widelogo_max_width      == $widelogo_max_width_css_default ) { return; }
    $widelogo_max_width_css       = 
    "
    #logo-full img {
            max-width: {$widelogo_max_width}px;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $widelogo_max_width_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_widelogo_max_width_css' );


// LINE Through
////////////////////////////////////////////////////////////////////////////////


function gameleon_td_line_through() {

    $enable_td_line_through_default  = 0;
    $gameleon_line_through           = get_theme_mod( 'td_line_through', $enable_td_line_through_default );
    if ( $gameleon_line_through      == $enable_td_line_through_default ) { return; }
    $enable_line_through      = 
    "
    #header #topbar .container #top-navigation .navigation .menu .menu-item a:hover {
        text-decoration: line-through;
    }

    ";

    wp_add_inline_style( 'gameleon-style', $enable_line_through );

}

add_action( 'wp_enqueue_scripts', 'gameleon_td_line_through' );

// Irregular Shape
////////////////////////////////////////////////////////////////////////////////


function gameleon_td_image_shape() {

    $enable_td_image_shape_default  = 0;
    $gameleon_image_shape           = get_theme_mod( 'td_image_shape', $enable_td_image_shape_default );
    if ( $gameleon_image_shape      == $enable_td_image_shape_default ) { return; }
    $enable_image_shape      = 
    "

    .grid-image {
        clip-path: polygon(31% 100%, 29% 97%, 47% 100%, 85% 97%, 100% 100%, 97% 81%, 100% 84%, 96% 56%, 100% 39%, 98% 18%, 100% 0%, 77% 3%, 83% 0%, 63% 4%, 52% 0%, 43% 3%, 20% 0%, 9% 4%, 0% 0%, 2% 14%, 0% 13%, 0% 39%, 3% 66%, 0% 86%, 0% 100%);
        -webkit-clip-path: polygon(31% 100%, 29% 97%, 47% 100%, 85% 97%, 100% 100%, 97% 81%, 100% 84%, 96% 56%, 100% 39%, 98% 18%, 100% 0%, 77% 3%, 83% 0%, 63% 4%, 52% 0%, 43% 3%, 20% 0%, 9% 4%, 0% 0%, 2% 14%, 0% 13%, 0% 39%, 3% 66%, 0% 86%, 0% 100%);
    }

    ";

    wp_add_inline_style( 'gameleon-style', $enable_image_shape );

}

add_action( 'wp_enqueue_scripts', 'gameleon_td_image_shape' );


// NEWSTICKER TOP MARGIN
////////////////////////////////////////////////////////////////////////////////

function gameleon_newsticker_top_margin_css() {

    $newsticker_top_margin_css_default  = 0;
    $newsticker_top_margin           = get_theme_mod( 'td_newsticker_top_margin', $newsticker_top_margin_css_default );
    if ( $newsticker_top_margin      == $newsticker_top_margin_css_default ) { return; }
    $newsticker_top_margin_css       = 
    "
        .modern-ticker {
            margin-top: {$newsticker_top_margin}px;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $newsticker_top_margin_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_newsticker_top_margin_css' );

// NEWSTICKER FULL WIDTH
////////////////////////////////////////////////////////////////////////////////

function gameleon_newsticker_full_width_css() {

    $newsticker_full_width_css_default  = 0;
    $newsticker_full_width           = get_theme_mod( 'td_newsticker_full_width', $newsticker_full_width_css_default );
    if ( $newsticker_full_width      == $newsticker_full_width_css_default ) { return; }
    $newsticker_full_width_css       = 
    "
        .modern-ticker {
            max-width: inherit;
            margin: 0;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $newsticker_full_width_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_newsticker_full_width_css' );


// MAIN MENU MARGIN
////////////////////////////////////////////////////////////////////////////////

function gameleon_main_menu_top_margin_css() {

    $main_menu_top_margin_css_default       = 0;
    $main_menu_top_margin           = get_theme_mod( 'td_main_menu_top_margin', $main_menu_top_margin_css_default );
    if ( $main_menu_top_margin      == $main_menu_top_margin_css_default ) { return; }
    $main_menu_top_margin_css       = 
    "
        #wrapper-menu,
        .td-right-wrap {
            margin-top: {$main_menu_top_margin}px;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $main_menu_top_margin_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_main_menu_top_margin_css' );


// HEADER SLIDER TOP MARGIN
////////////////////////////////////////////////////////////////////////////////

function gameleon_header_slider_top_margin_css() {

    $header_slider_top_margin_css_default       = 0;
    $header_slider_top_margin           = get_theme_mod( 'td_header_slider_top_margin', $header_slider_top_margin_css_default );
    if ( $header_slider_top_margin      == $header_slider_top_margin_css_default ) { return; }
    $header_slider_top_margin_css       = 
    "
        #td-modular-slider {
            margin-top: {$header_slider_top_margin}px;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $header_slider_top_margin_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_header_slider_top_margin_css' );




// HEADER TOP MARGIN
////////////////////////////////////////////////////////////////////////////////

function gameleon_header_top_margin_css() {

    $header_top_margin_css_default       = 0;
    $header_top_margin           = get_theme_mod( 'td_header_top_margin', $header_top_margin_css_default );
    if ( $header_top_margin      == $header_top_margin_css_default ) { return; }
    $header_top_margin_css       = 
    "
        #header{
            margin-top: {$header_top_margin}px;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $header_top_margin_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_header_top_margin_css' );


// HEADER BOTTOM MARGIN
////////////////////////////////////////////////////////////////////////////////

function gameleon_header_bottom_margin_css() {

    $header_bottom_margin_css_default       = 0;
    $header_bottom_margin           = get_theme_mod( 'td_header_bottom_margin', $header_bottom_margin_css_default );
    if ( $header_bottom_margin      == $header_bottom_margin_css_default ) { return; }
    $header_bottom_margin_css       = 
    "
        #header{
            margin-bottom: {$header_bottom_margin}px;
        }

    ";

    wp_add_inline_style( 'gameleon-style', $header_bottom_margin_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_header_bottom_margin_css' );

// FLY IF EFFECT
////////////////////////////////////////////////////////////////////////////////

    function gameleon_enable_fly_in() {

        $enable_fly_in_default  = 0;
        $gameleon_enable_fly           = get_theme_mod( 'gameleon_fly_in', $enable_fly_in_default );
        if ( $gameleon_enable_fly      == $enable_fly_in_default ) { return; }
        $enable_fly_in       = 
        "
        .td-fly-in-effect {
            -webkit-animation-name:flyIn;
            animation-name:flyIn;
            -webkit-animation-duration:1s;
            animation-duration:1s;
            -webkit-animation-fill-mode:both;
            animation-fill-mode:both;
            }

    
        ";
    
        wp_add_inline_style( 'gameleon-style', $enable_fly_in );
    
    }
    
    add_action( 'wp_enqueue_scripts', 'gameleon_enable_fly_in' );



// GAMING OPTIONS
////////////////////////////////////////////////////////////////////////////////

//  Progress Bar
 function gameleon_enable_progress_bar() {

    $enable_progress_bar_default  = 0;
    $gameleon_enable_progress           = get_theme_mod( 'gameleon_progress_bar', $enable_progress_bar_default );
    if ( $gameleon_enable_progress      == $enable_progress_bar_default ) { return; }
    $enable_progress_bar       = 
    "
        #td-game-wrap{width:0; height: 0;}

    ";

    wp_add_inline_style( 'gameleon-style', $enable_progress_bar );

}

add_action( 'wp_enqueue_scripts', 'gameleon_enable_progress_bar' );




// COLORS
////////////////////////////////////////////////////////////////////////////////



// THEME MAIN COLOR
function gameleon_colors_primary_color_css() {

    $colors_primary_color_default   = '#F63A3A';
    $colors_primary_color           = get_theme_mod( 'gameleon_primary_color', $colors_primary_color_default );
    if ( $colors_primary_color      == $colors_primary_color_default ) { return; }
    $colors_primary_color_css       =

    "

    #buddypress .groups .item-meta,
	.moregames-link .fa-angle-right,
	#review-box .review-final-score h3,
	#review-box .review-final-score h4,
	.widget_categories .current-cat a,
	.review-box,
    .bbp-forum-title, 
    .dot-irecommendthis:hover,
    .dot-irecommendthis.active,
    .td-dark-mode .td-tag-cloud-inline.td-tag-cloud-widget a:hover,
    .td-dark-mode .nd_recently_viewed .links li a:hover,
    .online-users-content,
    .td-dark-mode .td-module-6 .block-meta,
    .td-subtitle,
    .td-dark-mode .td-module-8 .block-meta,
    .td-module-8 .td-subtitle,
    .td-dark-mode .td-module-7 .block-meta,
    .td-module-7 .td-subtitle,
    .td-dark-mode .td-module-3 .block-meta,
    .td-module-7 h2.td-big-title a:hover,
    .td-dark-mode .block-meta,
    .td-dark-mode .td-post-date,
    .right-menu i,
    .right-menu li a:hover,
    .td-wide-mode #header #topbar .container #top-navigation .navigation .menu .menu-item a:hover,
    .td-wide-mode #header #topbar .container #top-navigation .navigation .menu .current_page_item a,
    .td-wide-mode #header #topbar .container #top-navigation .navigation .menu .current-menu-item a,
    .td-wide-mode .menu .current-menu-item a,
    .td-dark-mode #footer .wrapper-footer a,
    .td-dark-mode #footer .widget-title h3,
    .td-dark-mode .td-sub-footer a,
    .td-wide-mode #owl-home-carousel .td-wide-owl h2 a {
            color: $colors_primary_color;
    }

    .menu a:hover,
    a.button, input[type='reset'], input[type='button'], input[type='submit'],
    .front-page .menu .current_page_item a,
    .menu .current_page_item a,
    .menu .current-menu-item a,
    #td-home-tabs .tabs-wrapper li.active a:hover,
    ul.nd_tabs li:hover,
    .td-admin-links .links li a,
    .nd_recently_viewed .links li a,
    form.nd_form input.button,
    .dropcap,
    #gametabs li.active a,
    .colophon-module,
    #commentform a.button,
    #commentform input[type='reset'],
    #commentform input[type='button'],
    #commentform input[type='submit'],
    .td-owl-date,
    .feedburner-subscribe,
    .wp-pagenavi span.current,
    .td-tag-cloud-widget a,
    .cat-links a,
    .gamesnumber,
    .review-percentage .review-item span span,
    #progressbarloadbg,
    .scrollpage,
    .modern-ticker,
    .mt-news,
    main-byline a,
    .td-social-counters li,
    .td-video-wrapp .td-embed-description .video-post-title span,
    .qtip-default,
    #td-social-tabs .tabs-wrapper li.active a,
    ul.nd_tabs li.active,
    #td-home-tabs .tabs-wrapper li.active a,
    #td-social-tabs .tabs-wrapper li.active a:hover,
    #bbp_search_submit,    
    #buddypress div.dir-search input[type='submit'],
    #buddypress #activate-page .standard-form input[type='submit'],
    #buddypress .message-search input[type='submit'],
    #buddypress .item-list-tabs ul li.selected a,
    #buddypress .generic-button a,
    #buddypress .submit input[type='submit'],
    #buddypress .ac-reply-content input[type='submit'],
    #buddypress .standard-form input[type='submit'],
    #buddypress .standard-form .button-nav .current a,
    #buddypress .standard-form .button,
    #buddypress input[type='submit'],
    #buddypress a.accept,
    #buddypress .standard-form #group-create-body input[type='button'],
    .td-dark-mode .mt-label,
    .td-dark-mode .widget-title:before,
    .td-search-button,
    .td-dark-mode #gametabs li.active a,
    .td-dark-mode #gametabs .tab-links a:hover,
    .td-dark-mode #gametabs li.active a:hover,
    .owl-theme-2 .owl-controls .owl-page.active span,
    .owl-theme-2 .owl-controls.clickable .owl-page:hover span,
    .owl-theme-3 .owl-controls .owl-page.active span,
    .owl-theme-3 .owl-controls.clickable .owl-page:hover span,
    .td-dark-mode #td-home-tabs .tabs-wrapper li.active a,
    .td-dark-mode ul.nd_tabs li.active,
    .td-module-8 .triangle-shape,
    .td-module-8 .triangle-shape-last,
    #header #topbar .container #top-navigation .navigation .menu .current-menu-item a,
    #header #topbar .container #top-navigation .navigation .menu .current_page_item a,
    .td-view-all,
    .main-cat  {
        background-color: $colors_primary_color;
    }

    .wp-pagenavi span.current {
        border: 1px solid $colors_primary_color;
    }

    ";

    wp_add_inline_style( 'gameleon-style', $colors_primary_color_css );

}


add_action( 'wp_enqueue_scripts', 'gameleon_colors_primary_color_css' );




// THEME BACKGROUND COLOR
function gameleon_colors_background_color_css() {

    $colors_background_color_default   = '#444444';
    $colors_background_color           = get_theme_mod( 'gameleon_background_color', $colors_background_color_default );
    if ( $colors_background_color      == $colors_background_color_default ) { return; }
    $colors_background_color_css       =

    "body, .td-dark-mode #wrapper-content {background-color: $colors_background_color!important;}";

    wp_add_inline_style( 'gameleon-style', $colors_background_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_background_color_css' );


// LOGO TEXT COLOR
function gameleon_colors_logo_text_color_css() {

    $colors_logo_text_color_default   = '#000000';
    $colors_logo_text_color           = get_theme_mod( 'gameleon_logo_text_color', $colors_logo_text_color_default );
    if ( $colors_logo_text_color      == $colors_logo_text_color_default ) { return; }
    $colors_logo_text_color_css       =

    ".header-inner h1 a {color: $colors_logo_text_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_logo_text_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_logo_text_color_css' );


// BODY TEXT COLOR
function gameleon_colors_body_text_color_css() {

    $colors_body_text_color_default   = '#4b4b4b';
    $colors_body_text_color           = get_theme_mod( 'gameleon_body_text_color', $colors_body_text_color_default );
    if ( $colors_body_text_color      == $colors_body_text_color_default ) { return; }
    $colors_body_text_color_css       =

    "body {color: $colors_body_text_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_body_text_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_body_text_color_css' );


// LINKS COLOR
function gameleon_colors_links_color_css() {

    $colors_links_color_default   = '#000000';
    $colors_links_color           = get_theme_mod( 'gameleon_links_color', $colors_links_color_default );
    if ( $colors_links_color      == $colors_links_color_default ) { return; }
    $colors_links_color_css       =

    "a {color: $colors_links_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_links_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_links_color_css' );

// LINKS COLOR HOVER
function gameleon_colors_links_color_hover_css() {

    $colors_links_color_hover_default   = '#00a1ff';
    $colors_links_color_hover           = get_theme_mod( 'gameleon_links_color_hover', $colors_links_color_hover_default );
    if ( $colors_links_color_hover      == $colors_links_color_hover_default ) { return; }
    $colors_links_color_hover_css       =

    "a:hover {color: $colors_links_color_hover;}";

    wp_add_inline_style( 'gameleon-style', $colors_links_color_hover_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_links_color_hover_css' );


// MAIN MENU BACKGROUND COLOR

function gameleon_colors_menu_background_color_css() {

    $colors_menu_background_color_default   = '#191919';
    $colors_menu_background_color           = get_theme_mod( 'gameleon_menu_background_color', $colors_menu_background_color_default );
    if ( $colors_menu_background_color      == $colors_menu_background_color_default ) { return; }
    $colors_menu_background_color_css       =

    ".menu, #header #topbar, .td-wide-mode .sticky-wrapper.is-sticky #wrapper-menu {background-color: $colors_menu_background_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_menu_background_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_menu_background_color_css' );


// MAIN MENU LINK COLOR

function gameleon_colors_menu_link_color_css() {

    $colors_menu_link_color_default   = '#ffffff';
    $colors_menu_link_color           = get_theme_mod( 'gameleon_menu_link_color', $colors_menu_link_color_default );
    if ( $colors_menu_link_color      == $colors_menu_link_color_default ) { return; }
    $colors_menu_link_color_css       =

    ".menu li a{color: $colors_menu_link_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_menu_link_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_menu_link_color_css' );


// FOOTER LINKS COLOR
function gameleon_colors_footer_link_color_css() {

    $colors_footer_link_color_default   = '#ffffff';
    $colors_footer_link_color           = get_theme_mod( 'gameleon_footer_text_colors', $colors_footer_link_color_default );
    if ( $colors_footer_link_color      == $colors_footer_link_color_default ) { return; }
    $colors_footer_link_color_css       =

    ".footer-menu li a,#footer #wrapper-footer li a{color:$colors_footer_link_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_footer_link_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_footer_link_color_css' );



// FOOTER LINKS HOVER COLOR
function gameleon_colors_footer_link_hover_color_css() {

    $colors_footer_link_hover_color_default   = '#444444';
    $colors_footer_link_hover_color           = get_theme_mod( 'gameleon_footer_links_hover_colors', $colors_footer_link_hover_color_default );
    if ( $colors_footer_link_hover_color      == $colors_footer_link_hover_color_default ) { return; }
    $colors_footer_link_hover_color_css       =

    ".footer-menu li a:hover,#footer #wrapper-footer li a:hover{color:$colors_footer_link_hover_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_footer_link_hover_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_footer_link_hover_color_css' );




// WIDGETS TITLE COLOR
function gameleon_colors_widgets_title_color_css() {

    $colors_widgets_title_color_default   = '#444444';
    $colors_widgets_title_color           = get_theme_mod( 'gameleon_widgets_title_colors', $colors_widgets_title_color_default );
    if ( $colors_widgets_title_color      == $colors_widgets_title_color_default ) { return; }
    $colors_widgets_title_color_css       =


    ".widget-title h1, ul.nd_tabs li a, .widget-title h1 a, .widget-title h3, .widget-title h3 a, .fantasy-title-wrap .fantasy-title h2{color:$colors_widgets_title_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_widgets_title_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_widgets_title_color_css' );


// WIDGETS TITLE BACKGROUND & BORDER COLOR
function gameleon_colors_widgets_background_color_css() {

    $colors_widgets_background_color_default   = '#444444';
    $colors_widgets_background_color           = get_theme_mod( 'gameleon_widgets_background_colors', $colors_widgets_background_color_default );
    if ( $colors_widgets_background_color      == $colors_widgets_background_color_default ) { return; }
    $colors_widgets_background_color_css       =

    ".widget-title, .widgettitle, #td-social-tabs .tabs-wrapper li.active a, #td-social-tabs .tabs-wrapper li.active a:hover {background-color: $colors_widgets_background_color;}";

    wp_add_inline_style( 'gameleon-style', $colors_widgets_background_color_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_colors_widgets_background_color_css' );



function gameleon_enable_widgets_style() {

    $gameleon_widgets_style                     = get_theme_mod( 'gameleon_widgets_style' );
    $colors_widgets_background_color_default    = '#444444';
    $colors_widgets_background_color            = get_theme_mod( 'gameleon_widgets_background_colors', $colors_widgets_background_color_default );
    if ( $gameleon_widgets_style   == 2 ) { 
    $enable_widgets_style       = 
    "
        .widget-title {background-color:transparent; margin: 10px 20px;}
        .widget-title {border-bottom: 2px solid $colors_widgets_background_color;}
        #content-arcade .widget-title h1 { padding: 4px 20px;}
        .td-game-buttons { right: 20px;}
        #content-arcade .widget-title {margin: 0;}
        .widget-title h1, .widget-title h3 {margin: 0; padding:4px 0;}
        #widgets .widget-title h1, #widgets .widget-title h3 { padding:4px 0;}
        #widgets .widget-title {margin: -10px 0 20px;}
        #homepage-wrap .widget-title {margin: -10px 0px 20px 0;}
        .td-content-inner-no-comm  {border: none;}
        #homepage-wrap .widget_tigu_home_module_1 .widget-title,
        #homepage-wrap .widget_tigu_home_module_2 .widget-title,
        #homepage-wrap .widget_tigu_home_module_3 .widget-title,
        #homepage-wrap .widget_tigu_home_module_4 .widget-title {margin: 10px 20px;}
        #homepage-wrap .td-module-7 .widget-title {margin: 0 0 20px 0;}
        .td-dark-mode .widget-title:before {content:none;}
        #td-home-tabs .tabs-wrapper .tab-links a {background-color: transparent;}
        ul.nd_tabs {background-color: transparent;}
        #td-social-tabs .tabs-wrapper .tab-links a {background-color: transparent;}
        .td-content-inner-no-comm .widget-title {margin: 10px 0px 20px; border-bottom: 2px solid $colors_widgets_background_color;}
        #td-home-tabs .tabs-wrapper .tabs ul {border-bottom: 2px solid $colors_widgets_background_color; background-color: transparent;}
        #td-social-tabs .tabs-wrapper .socialtabs ul, ul.nd_tabs {border-bottom: 2px solid $colors_widgets_background_color; background-color: transparent;}
    ";


} else {
    $enable_widgets_style  = '';
}


    wp_add_inline_style( 'gameleon-style', $enable_widgets_style );

}


add_action( 'wp_enqueue_scripts', 'gameleon_enable_widgets_style' );


// BACKGROUND 
////////////////////////////////////////////////////////////////////////////////

// Background image
function gameleon_background_image_css() {

    $background_image                   = esc_url(get_theme_mod( 'gameleon_background_image_upload' ));
    $gameleon_background_repeat           = get_theme_mod( 'gameleon_background_repeat' );
    $gameleon_background_position           = get_theme_mod( 'gameleon_background_position' );
    $gameleon_background_attachment           = get_theme_mod( 'gameleon_background_attachment' );
    if ( $background_image ) {
    $background_image_css       =

    "
        body{background-image:url($background_image);background-repeat:$gameleon_background_repeat;background-position:$gameleon_background_position;background-attachment:$gameleon_background_attachment;}
        #container {box-shadow: 0 0 125px 0 rgb(0 0 0 / 90%);
            -webkit-box-shadow: 0 0 125px 0 rgb(0 0 0 / 90%);
            -moz-box-shadow: 0 0 125px 0 rgba(0,0,0,0.9);
            -o-box-shadow: 0 0 125px 0 rgba(0,0,0,0.9);}
    ";

    wp_add_inline_style( 'gameleon-style', $background_image_css );

    }
}

add_action( 'wp_enqueue_scripts', 'gameleon_background_image_css' );





// BACKGROUND 
////////////////////////////////////////////////////////////////////////////////

// Typography

// Body Font Familly
function gameleon_body_font_css() {

    $bodyFont = json_decode( get_theme_mod( 'gameleon_body_font_settings' ), true );

    if ( $bodyFont )  {
    $body_font_css  =   "body, button, input, select, textarea{font-family:'" . $bodyFont['font'] . "', sans-serif;}";

    wp_add_inline_style( 'gameleon-style', $body_font_css );

    }
}

add_action( 'wp_enqueue_scripts', 'gameleon_body_font_css' );



// BODY FONT STYLE
function gameleon_body_font_style_css() {

    $body_font_style_default   = 'normal';
    $body_font_style           =  get_theme_mod( 'gameleon_body_font_styles', $body_font_style_default );
    if ( $body_font_style      == $body_font_style_default ) { return; }
    $body_font_style_css       =

    "
    body{font-style:$body_font_style;}
    ";

    wp_add_inline_style( 'gameleon-style', $body_font_style_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_body_font_style_css' );


// BODY FONT SIZE
function gameleon_body_font_size_css() {

    $body_font_size_default   = '15';
    $body_font_size           =  get_theme_mod( 'gameleon_body_font_size', $body_font_size_default );
    if ( $body_font_size      == $body_font_size_default ) { return; }
    $body_font_size_css       =

    "
    body{font-size:{$body_font_size}px;}
    ";

    wp_add_inline_style( 'gameleon-style', $body_font_size_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_body_font_size_css' );


// BODY FONT LINE HEIGHT
function gameleon_body_line_height_css() {

    $body_line_height_default   = '19';
    $body_line_height           =  get_theme_mod( 'gameleon_body_font_line_height', $body_line_height_default );
    if ( $body_line_height      == $body_line_height_default ) { return; }
    $body_line_height_css       =

    "
    body{line-height:{$body_line_height}px;}
    ";

    wp_add_inline_style( 'gameleon-style', $body_line_height_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_body_line_height_css' );



// BODY FONT WEIGHT
function gameleon_body_font_weight_css() {

    $body_font_weight_default   = '400';
    $body_font_weight           =  get_theme_mod( 'gameleon_body_font_weight', $body_font_weight_default );
    if ( $body_font_weight      == $body_font_weight_default ) { return; }
    $body_font_weight_css       =

    "
    body{font-weight:$body_font_weight;}
    ";

    wp_add_inline_style( 'gameleon-style', $body_font_weight_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_body_font_weight_css' );


// MENU FONT FAMILLY
function gameleon_menu_font_css() {

    $menuFont = json_decode( get_theme_mod( 'gameleon_menu_font_settings' ), true );

    if ( $menuFont )  {
    $menu_font_css  =   ".menu a, .top-menu li a{font-family:'" . $menuFont['font'] . "', sans-serif;}";

    wp_add_inline_style( 'gameleon-style', $menu_font_css );

    }
}

add_action( 'wp_enqueue_scripts', 'gameleon_menu_font_css' );

// MENU FONT STYLE
function gameleon_menu_font_style_css() {

    $menu_font_style_default   = 'normal';
    $menu_font_style           =  get_theme_mod( 'gameleon_menu_font_styles', $menu_font_style_default );
    if ( $menu_font_style      == $menu_font_style_default ) { return; }
    $menu_font_style_css       =   ".menu a{font-style:$menu_font_style;}";

    wp_add_inline_style( 'gameleon-style', $menu_font_style_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_menu_font_style_css' );


// MENU FONT SIZE
function gameleon_menu_font_size_css() {

    $menu_font_size_default   = '15';
    $menu_font_size           =  get_theme_mod( 'gameleon_menu_font_size', $menu_font_size_default );
    if ( $menu_font_size      == $menu_font_size_default ) { return; }
    $menu_font_size_css       = ".menu a{font-size:{$menu_font_size}px;}";

    wp_add_inline_style( 'gameleon-style', $menu_font_size_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_menu_font_size_css' );


// MENU FONT WEIGHT
function gameleon_menu_font_weight_css() {

    $menu_font_weight_default   = '600';
    $menu_font_weight           =  get_theme_mod( 'gameleon_menu_font_weight', $menu_font_weight_default );
    if ( $menu_font_weight      == $menu_font_weight_default ) { return; }
    $menu_font_weight_css       =

    ".menu a, 
    #header #topbar .container #top-navigation .navigation .menu .menu-item a {font-weight:$menu_font_weight ;}";

    wp_add_inline_style( 'gameleon-style', $menu_font_weight_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_menu_font_weight_css' );



// MENU TEXT TRANSFORM
function gameleon_menu_text_transform_css() {

    $menu_text_transform_default   = 'uppercase';
    $menu_text_transform           =  get_theme_mod( 'gameleon_menu_text_transform_styles', $menu_text_transform_default );
    if ( $menu_text_transform      == $menu_text_transform_default ) { return; }
    $menu_text_transform_css       =

    ".menu a{text-transform:$menu_text_transform;}";

    wp_add_inline_style( 'gameleon-style', $menu_text_transform_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_menu_text_transform_css' );


// WIDGETS FONT FAMILLY
function gameleon_widgets_font_css() {

    $widgetsFont = json_decode( get_theme_mod( 'gameleon_widgets_font_settings' ), true );

    if ( $widgetsFont )  {
    $widgets_font_css  =   ".widget-title h1, .widget-title h3, h2.td-big-title, #td-hero-header .td-hero-title, #td-hero-header .td-hero-cta button {font-family:'" . $widgetsFont['font'] . "', sans-serif;}";

    wp_add_inline_style( 'gameleon-style', $widgets_font_css );

    }
}

add_action( 'wp_enqueue_scripts', 'gameleon_widgets_font_css' );

// WIDGETS FONT STYLE
function gameleon_widgets_font_style_css() {

    $widgets_font_style_default   = 'normal';
    $widgets_font_style           =  get_theme_mod( 'gameleon_widgets_font_styles', $widgets_font_style_default );
    if ( $widgets_font_style      == $widgets_font_style_default ) { return; }
    $widgets_font_style_css       =   ".widget-title h1, .widget-title h3{font-style:$widgets_font_style;}";

    wp_add_inline_style( 'gameleon-style', $widgets_font_style_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_widgets_font_style_css' );


// WIDGETS FONT SIZE
function gameleon_widgets_font_size_css() {

    $widgets_font_size_default   = '18';
    $widgets_font_size           =  get_theme_mod( 'gameleon_widgets_font_size', $widgets_font_size_default );
    if ( $widgets_font_size      == $widgets_font_size_default ) { return; }
    $widgets_font_size_css       = ".widget-title h1, .widget-title h3{font-size:{$widgets_font_size}px;}";

    wp_add_inline_style( 'gameleon-style', $widgets_font_size_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_widgets_font_size_css' );


// WIDGETS FONT WEIGHT
function gameleon_widgets_font_weight_css() {

    $widgets_font_weight_default   = '400';
    $widgets_font_weight           =  get_theme_mod( 'gameleon_widgets_font_weight', $widgets_font_weight_default );
    if ( $widgets_font_weight      == $widgets_font_weight_default ) { return; }
    $widgets_font_weight_css       =

    ".widget-title h1,
    .widget-title h3,
    .widget-title h3 a{font-weight:$widgets_font_weight;}";

    wp_add_inline_style( 'gameleon-style', $widgets_font_weight_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_widgets_font_weight_css' );


// WIDGETS TEXT TRANSFORM
function gameleon_widgets_text_transform_css() {

    $widgets_text_transform_default   = 'uppercase';
    $widgets_text_transform           =  get_theme_mod( 'gameleon_widgets_text_transform_styles', $widgets_text_transform_default );
    if ( $widgets_text_transform      == $widgets_text_transform_default ) { return; }
    $widgets_text_transform_css       =

    ".widget-title h1, .widget-title h3{text-transform:$widgets_text_transform;}";

    wp_add_inline_style( 'gameleon-style', $widgets_text_transform_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_widgets_text_transform_css' );


// WIDGETS LINE HEIGHT
function gameleon_widgets_line_height_css() {

    $widgets_line_height_default   = '30';
    $widgets_line_height           =  get_theme_mod( 'gameleon_widgets_font_line_height', $widgets_line_height_default );
    if ( $widgets_line_height      == $widgets_line_height_default ) { return; }
    $widgets_line_height_css       =    ".widget-title h1, .widget-title h3{line-height:{$widgets_line_height}px;}";

    wp_add_inline_style( 'gameleon-style', $widgets_line_height_css );

}

add_action( 'wp_enqueue_scripts', 'gameleon_widgets_line_height_css' );
