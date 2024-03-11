<?php

function gameleon_customizer_settings( $wp_customize ) {

/**
* Set our Customizer default options
*/
if ( ! function_exists( 'tiguan_generate_defaults' ) ) {
	function tiguan_generate_defaults() {
		$customizer_defaults = array(

			'gameleon_contructor_header' => 'block_logo_ad,block_main_menu,block_modular_sliders',

		);

		return apply_filters( 'tiguan_customizer_defaults', $customizer_defaults );
	}
}

/*----------------------------------------------------------------------------------------------------------
   LAYOUT
-----------------------------------------------------------------------------------------------------------*/
  
    $wp_customize->add_section( 'gameleon_layout', array(
        'title'                         => esc_html__( 'General', 'gameleon' ),
        'priority'                      => 21
    ) );



/*----------------------------------------------------------------------------------------------------------
   WIDE VERSION
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_wide_layout',
array(
   'default' => '1',
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_radio_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_wide_layout',
 array(
    'label' => esc_html__( 'Body style', 'gameleon' ),
    'section' => 'gameleon_layout',
    'priority'=> 1,
    'choices' => array(
       '1' => esc_html__( 'Boxed', 'gameleon' ),
       '2' => esc_html__( 'Wide', 'gameleon' ),
    )
 )
) );


/*----------------------------------------------------------------------------------------------------------
   DARK VERSION
-----------------------------------------------------------------------------------------------------------*/
   $wp_customize->add_setting( 'gameleon_dark_layout',
   array(
      'default' => '1',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_radio_sanitization'
   )
);

 $wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_dark_layout',
    array(
       'label' => esc_html__( 'Appearance', 'gameleon' ),
       'section' => 'gameleon_layout',
       'priority'=> 1,
       'choices' => array(
          '1' => esc_html__( 'Light', 'gameleon' ),
          '2' => esc_html__( 'Dark', 'gameleon' ),
       )
    )
 ) );


/*----------------------------------------------------------------------------------------------------------
   HOMEPAGE LAYOUT
-----------------------------------------------------------------------------------------------------------*/
   $wp_customize->add_setting( 'gameleon_layout_homepage_layout',
   array(
      'default' => '2',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_radio_sanitization'
   )
);

 $wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_layout_homepage_layout',
    array(
       'label' => esc_html__( 'Homepage Layout', 'gameleon' ),
       'section' => 'gameleon_layout',
       'priority'=> 1,
       'choices' => array(
          '1' => esc_html__( 'Magazine', 'gameleon' ),
          '2' => esc_html__( 'Blog', 'gameleon' ),
       )
    )
 ) );



 /*----------------------------------------------------------------------------------------------------------
   WIDGETS STYLE
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_widgets_style',
array(
   'default' => '1',
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_radio_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_widgets_style',
 array(
    'label' => esc_html__( 'Widgets Title Style' , 'gameleon' ),
    'section' => 'gameleon_layout',
    'priority'=> 1,
    'choices' => array(
       '1' => esc_html__( 'Default', 'gameleon' ),
       '2' => esc_html__( 'Light', 'gameleon' ),
    )
 )
) );



/*---------------------------------
   READ MORE TEXT
---------------------------------*/
$wp_customize->add_setting( 'gameleon_readmore_text', array(
    'default'                       => 'Read More...',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'readmore_text', array(
    'label'                         => esc_html__( 'Read More text', 'gameleon' ),
    'section'                       => 'gameleon_layout',
    'settings'                      => 'gameleon_readmore_text',
    'type'                          => 'text',
    'priority'                      => 2
) ) );

/*---------------------------------
   TWITTER USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_twitter_username', array(
    'default'                       => '',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_username', array(
    'label'                         => esc_html__( 'Twitter Username for share button', 'gameleon' ),
    'section'                       => 'gameleon_layout',
    'settings'                      => 'gameleon_twitter_username',
    'type'                          => 'text',
    'priority'                      => 3
) ) );


/*----------------------------------------------------------------------------------------------------------
   ARCHIVE LAYOUT
-----------------------------------------------------------------------------------------------------------*/
    $wp_customize->add_setting( 'gameleon_layout_archives_layout', array(
        'default'                       => '1',
        'sanitize_callback'             => 'gameleon_sanitize_select'
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'layout_archives_layout', array(
        'label'                         => esc_html__( 'Archives Layout', 'gameleon' ),
        'section'                       => 'gameleon_layout',
        'settings'                      => 'gameleon_layout_archives_layout',
        'type'                          => 'select',
        'priority'	                    => 2,
        'choices'                       => array(
            '1'                         => esc_html__( 'Grid', 'gameleon' ),
            '2'                         => esc_html__( 'Blog', 'gameleon' ),

    ) ) ) );




/*---------------------------------
   SIDEBAR
---------------------------------*/

$wp_customize->add_setting( 'gameleon_home_sidebar',
array(
   'default' => 0,
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_switch_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_home_sidebar',
array(
 'label'  => esc_html__( 'Disable Sidebar on Homepage', 'gameleon' ),
   'section' => 'gameleon_layout'
)
) );


/*---------------------------------
   PRELOADER
---------------------------------*/

$wp_customize->add_setting( 'gameleon_use_preloader',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_use_preloader',
   array(
    'label'  => esc_html__( 'Use Preloader', 'gameleon' ),
      'section' => 'gameleon_layout'
   )
) );



/*---------------------------------
   SHOW META
---------------------------------*/

$wp_customize->add_setting( 'gameleon_show_meta_category',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_show_meta_category',
   array(
    'label'  => esc_html__( 'Meta on categories', 'gameleon' ),
      'section' => 'gameleon_layout'
   )
) );

/*---------------------------------
   FLY-IN EFFECT
---------------------------------*/

$wp_customize->add_setting( 'gameleon_fly_in',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_fly_in',
   array(
    'label'  => esc_html__( 'Fly in Effect', 'gameleon' ),
      'section' => 'gameleon_layout'
   )
) );


/*---------------------------------
   LIGHTBOX
---------------------------------*/

$wp_customize->add_setting( 'td_lightbox_feat',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_lightbox_feat',
   array(
    'label'  => esc_html__( 'Lightbox popup for image', 'gameleon' ),
      'section' => 'gameleon_layout'
   )
) );

/*---------------------------------
   SHAPE IMAGE
---------------------------------*/

$wp_customize->add_setting( 'td_image_shape',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_image_shape',
   array(
    'label'  => esc_html__( 'Irregularly Image Shape', 'gameleon' ),
      'section' => 'gameleon_layout'
   )
) );

/*---------------------------------
HEADER
---------------------------------*/

$wp_customize->add_panel( 'gameleon_header_options', array(
    'title'                         => esc_html__( 'Header', 'gameleon' ),
    'priority'                      => 22
) );

$wp_customize->add_section( 'gameleon_main_logo', array(
    'title'                         => esc_html__( 'Logo', 'gameleon' ),
    'panel'                         => 'gameleon_header_options',
    'priority'                      => 1
) );

$wp_customize->add_setting( 'td_site_logo', array(
    'sanitize_callback'             => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
    'description'                   => esc_html__( 'Upload your logo (250 x 100px).png', 'gameleon' ),
    'label'                         => esc_html__( 'Main Logo', 'gameleon' ),
    'section'                       => 'gameleon_main_logo',
    'settings'                      => 'td_site_logo',
    'priority'	                    => 3
) ) );



/*---------------------------------
WIDE LOGO
---------------------------------*/
$wp_customize->add_setting( 'td_custom_logo_wide', array(
    'sanitize_callback'             => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_wide', array(
    'description'                   => esc_html__( 'Upload a wide logo (any size) that will be used on home page only.', 'gameleon' ),
    'label'                         => esc_html__( 'Wide Logo', 'gameleon' ),
    'section'                       => 'gameleon_main_logo',
    'settings'                      => 'td_custom_logo_wide',
    'priority'	                    => 3
) ) );

/*---------------------------------
   LOGO ALT ATRIBUTE
---------------------------------*/
$wp_customize->add_setting( 'td_custom_logo_alt', array(
    'default'                       => '',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_logo_alt', array(
    'label'                         => esc_html__( 'Logo "alt" atribute', 'gameleon' ),
    'section'                       => 'gameleon_main_logo',
    'settings'                      => 'td_custom_logo_alt',
    'type'                          => 'text',
    'priority'                      => 3
) ) );

/*---------------------------------
   LOGO TITLE ATRIBUTE
---------------------------------*/
$wp_customize->add_setting( 'td_custom_logo_title', array(
    'default'                       => '',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_logo_title', array(
    'label'                         => esc_html__( 'Logo "title" atribute', 'gameleon' ),
    'section'                       => 'gameleon_main_logo',
    'settings'                      => 'td_custom_logo_title',
    'type'                          => 'text',
    'priority'                      => 3
) ) );


/*---------------------------------
   LOGO MAX WIDTH
---------------------------------*/
$wp_customize->add_setting( 'td_logo_max_width',
    array(
        'default' => 300,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_logo_max_width',
    array(
        'label'   => esc_html__( 'Wide Logo max width', 'gameleon' ),
        'description'  => esc_html__( 'Defined in pixels.', 'gameleon' ),
        'section' => 'gameleon_main_logo',
        'priority'  => 21,
        'input_attrs' => array(
            'min' => 0,
            'max' => 500,
            'step' => 5,
        ),
    )
) );


$wp_customize->add_section( 'gameleon_menus', array(
    'title'                         => esc_html__( 'Menu', 'gameleon' ),
    'panel'                         => 'gameleon_header_options',
    'priority'                      => 1
) );



/*---------------------------------
   Hover Menu line through
---------------------------------*/

$wp_customize->add_setting( 'td_line_through',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_line_through',
   array(
    'label'  => esc_html__( 'Line Through Hover Efect', 'gameleon' ),
      'section' => 'gameleon_menus'
   )
) );

/*---------------------------------
   SEARCH ON TOP MENU
---------------------------------*/

$wp_customize->add_setting( 'td_top_search',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_top_search',
   array(
    'label'  => esc_html__( 'Search on top menu', 'gameleon' ),
      'section' => 'gameleon_menus'
   )
) );


/*---------------------------------
   STICKY MENU
---------------------------------*/

$wp_customize->add_setting( 'td_sticky_menu',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_sticky_menu',
   array(
    'label'  => esc_html__( 'Sticky Menu', 'gameleon' ),
      'section' => 'gameleon_menus'
   )
) );



/*---------------------------------
   SEARCH MENU
---------------------------------*/

$wp_customize->add_setting( 'td_search_icon',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_search_icon',
   array(
    'label'  => esc_html__( 'Search on main menu', 'gameleon' ),
      'section' => 'gameleon_menus'
   )
) );




/*---------------------------------
   FIXED MAIN MENU TO TOP
---------------------------------*/

$wp_customize->add_setting( 'td_fixed_menu',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_fixed_menu',
   array(
    'label'  => esc_html__( 'Fixed Autohide Menu', 'gameleon' ),
      'section' => 'gameleon_menus'
   )
) );



/*----------------------------------------------------------------------------------------------------------
   NEWSTICKER    
-----------------------------------------------------------------------------------------------------------*/
  
$wp_customize->add_section( 'gameleon_newsticker_panel', array(
    'title'                         => esc_html__( 'News Ticker', 'gameleon' ),
    'panel'                         => 'gameleon_header_options',
    'priority'                      => 1
) );

/*---------------------------------
   NEWS TICKER TITLE
---------------------------------*/
$wp_customize->add_setting( 'td_newsticker_title', array(
    'default'                       => 'New Games',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newsticker_title', array(
    'label'                         => esc_html__( 'News Ticker Title', 'gameleon' ),
    'section'                       => 'gameleon_newsticker_panel',
    'settings'                      => 'td_newsticker_title',
    'type'                          => 'text',
    'priority'                      => 1
) ) );



/*---------------------------------
   NEWSTICKER NUMBER
---------------------------------*/

$wp_customize->add_setting( 'td_newsticker_number',
    array(
        'default' => 3,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_newsticker_number',
    array(
        'label'   => esc_html__( 'Posts to scroll', 'gameleon' ),
        'section' => 'gameleon_newsticker_panel',
        'input_attrs' => array(
            'min' => 1,
            'max' => 20,
            'step' => 1,
        ),
    )
) );


/*---------------------------------
   NEWSTICKER CATEGORY
---------------------------------*/

$wp_customize->add_setting( 'td_newsticker_category', array(
    'default'                       => '',
    'sanitize_callback'             => 'absint'
) );

$wp_customize->add_control( new Gameleon_Customize_Category_Control( $wp_customize, 'newsticker_category', array(
    'label'                         => esc_html__( 'Select Category', 'gameleon' ),
    'section'                       => 'gameleon_newsticker_panel',
    'settings'                      => 'td_newsticker_category',
    'priority'	                    => 3
) ) );


/*---------------------------------
   NEWSTICKER EXCERPT
---------------------------------*/

$wp_customize->add_setting( 'td_newsticker_excerpt',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_newsticker_excerpt',
   array(
    'label'  => esc_html__( 'Show Excerpt', 'gameleon' ),
      'section' => 'gameleon_newsticker_panel'
   )
) );



/*---------------------------------
   NEWSTICKER DATE
---------------------------------*/

$wp_customize->add_setting( 'td_newsticker_date',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_newsticker_date',
   array(
    'label'  => esc_html__( 'Show Date', 'gameleon' ),
      'section' => 'gameleon_newsticker_panel'
   )
) );


/*---------------------------------
   NEWSTICKER WIDTH
---------------------------------*/

$wp_customize->add_setting( 'td_newsticker_full_width',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_newsticker_full_width',
   array(
    'label'  => esc_html__( 'Newsticker Full Width', 'gameleon' ),
      'section' => 'gameleon_newsticker_panel'
   )
) );


/*----------------------------------------------------------------------------------------------------------
   MODULAR HEADER SLIDER   
-----------------------------------------------------------------------------------------------------------*/

$wp_customize->add_section( 'gameleon_header_slider_panel', array(
    'title'                         => esc_html__( 'Header Slider', 'gameleon' ),
    'panel'                         => 'gameleon_header_options',
    'priority'                      => 1
) );



$wp_customize->add_setting( 'td_filter_slider_posts', array(
    'default'                       => '1',
    'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'filter_slider_posts', array(
    'label'                         => esc_html__( 'Filter Posts', 'gameleon' ),
    'section'                       => 'gameleon_header_slider_panel',
    'settings'                      => 'td_filter_slider_posts',
    'type'                          => 'select',
    'priority'	                    => 1,
    'choices'                       => array(
        '1'                         => esc_html__( 'Latest Articles', 'gameleon' ),
        '2'                         => esc_html__( 'By Tags', 'gameleon' ),
) ) ) );


/*---------------------------------
   SLIDER POSTS NUMBER
---------------------------------*/

$wp_customize->add_setting( 'td_modular_slider_number',
    array(
        'default' => 3,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_modular_slider_number',
    array(
        'label'   => esc_html__( 'Posts to slide', 'gameleon' ),
        'section' => 'gameleon_header_slider_panel',
        'input_attrs' => array(
            'min' => 2,
            'max' => 10,
            'step' => 1,
        ),
    )
) );



/*---------------------------------
   SLIDER TAGS FILTER
---------------------------------*/
$wp_customize->add_setting( 'td_slider_tags_in', array(
    'default'                       => '',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_tags_in', array(
    'label'                         => esc_html__( 'Filter posts by tags', 'gameleon' ),
    'description'                   => esc_html__( 'Posts with the entered tag in this field will show up in the modular slider on the homepage. You can also enter multiple tags separated by commas. Example: car,news,life', 'gameleon' ),
    'section'                       => 'gameleon_header_slider_panel',
    'settings'                      => 'td_slider_tags_in',
    'type'                          => 'text',
    'priority'                      => 4
) ) );


/*---------------------------------
   SLIDER SHORTCODE
---------------------------------*/

$wp_customize->add_setting( 'td_modular_slider_shortcode', array(
    'default'                       => '',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'modular_slider_shortcode', array(
    'label'                         => esc_html__( 'Slider Shortcode', 'gameleon' ),
    'description'                   => esc_html__( 'If you don\'t want to use above default built-in slider but another type of slider like Slider Revolution or any type of slider that uses shortcode, please fill out the field below. Enter slider shortcode here. Can be Slider Revolution or any type of slider that uses shortcode. Example: [rev_slider alias]', 'gameleon' ),
    'section'                       => 'gameleon_header_slider_panel',
    'settings'                      => 'td_modular_slider_shortcode',
    'type'                          => 'text',
    'priority'                      => 4
) ) );


/*---------------------------------
HERO HEADER
---------------------------------*/

$wp_customize->add_section( 'gameleon_hero_header', array(
   'title'                         => esc_html__( 'Hero Header', 'gameleon' ),
   'panel'                         => 'gameleon_header_options',
   'priority'                      => 1
) );

$wp_customize->add_setting( 'td_hero_header_img', array(
   'sanitize_callback'             => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_header_img', array(
   'description'                   => esc_html__( 'Upload your background image for your hero header(min. 1920px width).png', 'gameleon' ),
   'label'                         => esc_html__( 'Background Image', 'gameleon' ),
   'section'                       => 'gameleon_hero_header',
   'settings'                      => 'td_hero_header_img',
   'priority'	                    => 1
) ) );


/*---------------------------------
HERO SHAPE IMAGE
---------------------------------*/

$wp_customize->add_setting( 'td_hero_header_shape_img', array(
   'sanitize_callback'             => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_header_shape_img', array(
   'description'                   => esc_html__( 'Upload your shape image for your hero footer(min. 980px width).png', 'gameleon' ),
   'label'                         => esc_html__( 'Hero Shape', 'gameleon' ),
   'section'                       => 'gameleon_hero_header',
   'settings'                      => 'td_hero_header_shape_img',
   'priority'	                    => 1
) ) );

/*---------------------------------
HERO HEADER TITLE
---------------------------------*/

$wp_customize->add_setting( 'td_hero_header_title', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_header_title', array(
   'label'                         => esc_html__( 'Hero Header Title', 'gameleon' ),
   'section'                       => 'gameleon_hero_header',
   'settings'                      => 'td_hero_header_title',
   'type'                          => 'text',
   'priority'                      => 2
) ) );


/*---------------------------------
HERO HEADER TEXT
---------------------------------*/

$wp_customize->add_setting( 'td_hero_header_text', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_header_text', array(
   'label'                         => esc_html__( 'Hero Header Text', 'gameleon' ),
   'section'                       => 'gameleon_hero_header',
   'settings'                      => 'td_hero_header_text',
   'type'                          => 'textarea',
   'priority'                      => 3
) ) );


/*---------------------------------
HERO HEADER BUTTON TEXT
---------------------------------*/

$wp_customize->add_setting( 'td_hero_header_button_text', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_header_button_text', array(
   'label'                         => esc_html__( 'Hero Header Button Text', 'gameleon' ),
   'section'                       => 'gameleon_hero_header',
   'settings'                      => 'td_hero_header_button_text',
   'type'                          => 'text',
   'priority'                      => 4
) ) );


/*---------------------------------
HERO HEADER BUTTON LINK
---------------------------------*/

$wp_customize->add_setting( 'td_hero_header_button_link', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_header_button_link', array(
   'label'                         => esc_html__( 'Hero Header Button Link', 'gameleon' ),
   'section'                       => 'gameleon_hero_header',
   'settings'                      => 'td_hero_header_button_link',
   'type'                          => 'text',
   'priority'                      => 5
) ) );



/*---------------------------------
HERO HEADER DIVIDER IMAGE
---------------------------------*/

$wp_customize->add_setting( 'td_hero_header_divider_img', array(
   'sanitize_callback'             => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_header_divider_img', array(
   'description'                   => esc_html__( 'Upload your divider image for your hero header', 'gameleon' ),
   'label'                         => esc_html__( 'Divider Image', 'gameleon' ),
   'section'                       => 'gameleon_hero_header',
   'settings'                      => 'td_hero_header_divider_img',
   'priority'	                    => 3
) ) );



/*----------------------------------------------------------------------------------------------------------
   HEADER CONSTRUCTOR      
-----------------------------------------------------------------------------------------------------------*/
  

$wp_customize->add_section( 'gameleon_header_constructor_panel', array(
    'title'                         => esc_html__( 'Header Constructor', 'gameleon' ),
    'panel'                         => 'gameleon_header_options',
    'priority'                      => 1
) );



$wp_customize->add_setting( 'gameleon_contructor_header', array(
      'default' => 'block_fullwidth_logo',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_text_sanitization'
   )
);
$wp_customize->add_control( new Tiguan_Liviu_Checkbox_Custom_Control( $wp_customize, 'gameleon_contructor_header',
   array(
      'label' => __( 'Header Layout Manager', 'gameleon' ),
      'description' => esc_html__( 'Organize how you want the header to appear on your site using drag & drop feature. Note that the slider will be displayed only on home page.', 'gameleon' ),
      'section' => 'gameleon_header_constructor_panel',
      'input_attrs' => array(
         'sortable' => true,
         'fullwidth' => true,
         'priority'    => 1,
      ),
      'choices' => array(
         'block_fullwidth_logo' => __( 'Wide Logo', 'gameleon' ),
         'block_full_header_slider' => __( 'Wide Slider', 'gameleon' ),
         'block_news_ticker' => __( 'News Ticker', 'gameleon'  ),
         'block_modular_slider' => __( 'Header Slider', 'gameleon'  ),
         'block_hero_header' => __( 'Hero Header', 'gameleon'  ),
         'block_ad_banner' => __( 'Centered Ad Banner', 'gameleon'  ),
         'block_logo_ad' => __( 'Logo + Ad Banner', 'gameleon'  ),
         'block_main_menu' => __( 'Main Menu', 'gameleon'  ),
      )
   )
) );



/*---------------------------------
    WIDE LOGO TOP MARGIN
---------------------------------*/

$wp_customize->add_setting( 'td_wide_logo_top_margin',
    array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_wide_logo_top_margin',
    array(
        'label'   => esc_html__( 'Wide Logo top margin', 'gameleon' ),
        'description'  => esc_html__( 'Defined in pixels.', 'gameleon' ),
        'section' => 'gameleon_header_constructor_panel',
        'priority'  => 21,
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )
) );


/*---------------------------------
   NEWS TICKER TOP MARGIN
---------------------------------*/

$wp_customize->add_setting( 'td_newsticker_top_margin',
    array(
        'default' => 20,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_newsticker_top_margin',
    array(
        'label'   => esc_html__( 'News Ticker top margin', 'gameleon' ),
        'description'  => esc_html__( 'Defined in pixels. ', 'gameleon' ),
        'section' => 'gameleon_header_constructor_panel',
        'priority'  => 22,
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )
) );

/*---------------------------------
   MAIN MENU TOP MARGIN
---------------------------------*/

$wp_customize->add_setting( 'td_main_menu_top_margin',
    array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_main_menu_top_margin',
    array(
        'label'   => esc_html__( 'Main Menu top margin', 'gameleon' ),
        'description'  => esc_html__( 'Defined in pixels.', 'gameleon' ),
        'section' => 'gameleon_header_constructor_panel',
        'priority'  => 23,
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )
) );

/*---------------------------------
   HEADER SLIDER TOP MARGIN
---------------------------------*/

$wp_customize->add_setting( 'td_header_slider_top_margin',
    array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_header_slider_top_margin',
    array(
        'label'   => esc_html__( 'Header Slider top margin', 'gameleon' ),
        'description'  => esc_html__( 'Defined in pixels.', 'gameleon' ),
        'section' => 'gameleon_header_constructor_panel',
        'priority'  => 24,
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )
) );


/*---------------------------------
   HIDE TOP MENU ON HOMEPAGE
---------------------------------*/

$wp_customize->add_setting( 'td_hide_top_menu_home',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_hide_top_menu_home',
   array(
    'label'  => esc_html__( 'Top Menu', 'gameleon' ),
    'description'  => esc_html__( 'Make sure the top menu is configured via Appearance -> Menus', 'gameleon' ),
    'section' => 'gameleon_header_constructor_panel'
   )
) );

/*---------------------------------
   HIDE TOP MENU ON HOMEPAGE
---------------------------------*/

$wp_customize->add_setting( 'td_hide_top_menu_home',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_hide_top_menu_home',
   array(
    'label'  => esc_html__( 'Top Menu', 'gameleon' ),
    'description'  => esc_html__( 'Make sure the top menu is configured via Appearance -> Menus', 'gameleon' ),
    'section' => 'gameleon_header_constructor_panel'
   )
) );

/*---------------------------------
   HEADER TOP MARGIN
---------------------------------*/

$wp_customize->add_setting( 'td_header_top_margin',
    array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_header_top_margin',
    array(
        'label'   => esc_html__( 'Header top margin', 'gameleon' ),
        'description'  => esc_html__( 'Defined in pixels.', 'gameleon' ),
        'section' => 'gameleon_header_constructor_panel',
        'priority'  => 23,
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )
) );



/*---------------------------------
   HEADER BOTTOM MARGIN
---------------------------------*/


$wp_customize->add_setting( 'td_header_bottom_margin',
    array(
        'default' => 40,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_header_bottom_margin',
    array(
        'label'   => esc_html__( 'Header bottom margin', 'gameleon' ),
        'description'  => esc_html__( 'Defined in pixels.', 'gameleon' ),
        'section' => 'gameleon_header_constructor_panel',
        'priority'  => 23,
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )
) );


/*---------------------------------
   SLIDER SHORTCODE
---------------------------------*/

$wp_customize->add_setting( 'td_wide_slider_shortcode', array(
    'default'                       => '',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wide_slider_shortcode', array(
    'label'                         => esc_html__( 'Wide Slider', 'gameleon' ),
    'description'                   => esc_html__( 'If you use \'Wide Slider\' module above, enter slider shortcode. Can be Slider Revolution or any type of slider that uses shortcode. Example: [rev_slider alias]', 'gameleon' ),
    'section'                       => 'gameleon_header_constructor_panel',
    'settings'                      => 'td_wide_slider_shortcode',
    'type'                          => 'text',
    'priority'                      => 26
) ) );


/*---------------------------------
TEMPLATE OPTIONS
---------------------------------*/

$wp_customize->add_panel( 'gameleon_template_options', array(
    'title'                         => esc_html__( 'Template Options', 'gameleon' ),
    'priority'                      => 22
) );

/*---------------------------------
CUTOM PAGES
---------------------------------*/
$wp_customize->add_section( 'gameleon_custom_pages', array(
    'title'                         => esc_html__( 'Custom Pages', 'gameleon' ),
    'panel'                         => 'gameleon_template_options',
    'priority'                      => 1
) );


$wp_customize->add_setting( 'custom_pages_notice',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_text_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Simple_Notice_Custom_control( $wp_customize, 'custom_pages_notice',
   array(
      'label' => esc_html__( 'Important', 'gameleon' ),
      'description' => esc_html__( 'These options are applicable for the following custom page templates: All Posts Template, Most Popular Template, Most Viewed/Played and Author page.', 'gameleon' ),
      'section' => 'gameleon_custom_pages',
      'priority'                      => 1
   )
) );


/*---------------------------------
   BLOG LAYOUTS
---------------------------------*/

$wp_customize->add_setting( 'blog_layout_custom_pages',
array(
   'default' => '2',
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_radio_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'blog_layout_custom_pages',
 array(
    'label' => esc_html__( 'Layout Style' , 'gameleon' ),
    'section' => 'gameleon_custom_pages',
    'priority'=> 1,
    'choices' => array(
       '1' => esc_html__( 'Grid Style 1', 'gameleon' ),
       '2' => esc_html__( 'Grid Style 2', 'gameleon' ),
    )
 )
) );



/*---------------------------------
   SHOW META
---------------------------------*/
$wp_customize->add_setting( 'td_show_meta_pages',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'td_show_meta_pages',
   array(
    'label'  => esc_html__( 'Show Meta', 'gameleon' ),
      'section' => 'gameleon_custom_pages'
   )
) );



/*---------------------------------
  TITLE EXCERPT LENGHT
---------------------------------*/

$wp_customize->add_setting( 'td_custom_pages_excerpts_title',
    array(
        'default' => 3,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_custom_pages_excerpts_title',
    array(
        'label'   => esc_html__( 'Title Lenght', 'gameleon' ),
        'description'   => esc_html__( 'Title limit in words. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'section' => 'gameleon_custom_pages',
        'input_attrs' => array(
            'min' => 1,
            'max' => 30,
            'step' => 1,
        ),
    )
) );


/*---------------------------------
  TEXT EXCERPT LENGHT
---------------------------------*/

$wp_customize->add_setting( 'td_custom_pages_excerpts_text',
    array(
        'default' => 8,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_custom_pages_excerpts_text',
    array(
        'label'   => esc_html__( 'Text Content Lenght', 'gameleon' ),
        'description'   => esc_html__( 'Text content limit in words. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'section' => 'gameleon_custom_pages',
        'input_attrs' => array(
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ),
    )
) );



/*---------------------------------
BLOG PAGE TEMPLATE
---------------------------------*/
$wp_customize->add_section( 'gameleon_blog_page_template', array(
    'title'                         => esc_html__( 'Blog Page Template', 'gameleon' ),
    'panel'                         => 'gameleon_template_options',
    'priority'                      => 1
) );


/*----------------------------------------------------------------------------------------------------------
   ORDER POSTS BY
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_blog_page_order', array(
   'default'                       => 'date',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( 'gameleon_blog_page_order', array(
   'label'                         => esc_html__( 'Order posts by', 'gameleon' ),
   'section'                       => 'gameleon_blog_page_template',
   'settings'                      => 'gameleon_blog_page_order',
   'type'                          => 'select',
   'priority'	                    => 1,
   'choices'                       => array(
      'date'                      => esc_html__( 'Date', 'gameleon' ),
      'comment_count'             => esc_html__( 'Popularity', 'gameleon' ),
      'meta_value_num'            => esc_html__( 'Number of views', 'gameleon' ),
      'rand'                      => esc_html__( 'Random', 'gameleon' ),
   ),
   ) );

/*---------------------------------
  EXCLUDE CATEGORY
---------------------------------*/
$wp_customize->add_setting( 'td_blog_page_template_exclude_cat', array(
    'default'                       => '',
    'sanitize_callback'             => 'wp_kses_post'
 ) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blog_page_template_exclude_cat', array(
    'label'                         => esc_html__( 'Exclude Category', 'gameleon' ),
    'description'                         => esc_html__( 'Enter the category ID that you don\'t want to be displayed. You can also enter multiple category ID\'s separated by commas. Example: 8,42,197.', 'gameleon' ),
    'section'                       => 'gameleon_blog_page_template',
    'settings'                      => 'td_blog_page_template_exclude_cat',
    'type'                          => 'text',
    'priority'                      => 2
) ) );

/*---------------------------------
ALL POSTS PAGE TEMPLATE
---------------------------------*/
$wp_customize->add_section( 'gameleon_all_posts_page_template', array(
   'title'                         => esc_html__( 'All Posts Page Template', 'gameleon' ),
   'panel'                         => 'gameleon_template_options',
   'priority'                      => 1
) );

/*----------------------------------------------------------------------------------------------------------
  ORDER POSTS BY
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_all_posts_page_order', array(
  'default'                       => 'date',
  'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( 'gameleon_all_posts_page_order', array(
  'label'                         => esc_html__( 'Order posts by', 'gameleon' ),
  'section'                       => 'gameleon_all_posts_page_template',
  'settings'                      => 'gameleon_all_posts_page_order',
  'type'                          => 'select',
  'priority'	                    => 1,
  'choices'                       => array(
     'date'                      => esc_html__( 'Date', 'gameleon' ),
     'comment_count'             => esc_html__( 'Popularity', 'gameleon' ),
     'meta_value_num'            => esc_html__( 'Number of views', 'gameleon' ),
     'rand'                      => esc_html__( 'Random', 'gameleon' ),
  ),
  ) );


/*---------------------------------
 EXCLUDE CATEGORY
---------------------------------*/
$wp_customize->add_setting( 'td_all_posts_page_template_exclude_cat', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'all_posts_page_template_exclude_cat', array(
   'label'                         => esc_html__( 'Exclude Category', 'gameleon' ),
   'description'                         => esc_html__( 'Enter the category ID that you don\'t want to be displayed. You can also enter multiple category ID\'s separated by commas. Example: 8,42,197.', 'gameleon' ),
   'section'                       => 'gameleon_all_posts_page_template',
   'settings'                      => 'td_all_posts_page_template_exclude_cat',
   'type'                          => 'text',
   'priority'                      => 2
) ) );


/*---------------------------------
MOST POPULAR PAGE TEMPLATE
---------------------------------*/
$wp_customize->add_section( 'gameleon_popular_page_template', array(
   'title'                         => esc_html__( 'Most Popular Page Template', 'gameleon' ),
   'panel'                         => 'gameleon_template_options',
   'priority'                      => 1
) );


/*---------------------------------
 EXCLUDE CATEGORY
---------------------------------*/
$wp_customize->add_setting( 'td_popular_page_template_exclude_cat', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'popular_page_template_exclude_cat', array(
   'label'                         => esc_html__( 'Exclude Category', 'gameleon' ),
   'description'                         => esc_html__( 'Enter the category ID that you don\'t want to be displayed. You can also enter multiple category ID\'s separated by commas. Example: 8,42,197.', 'gameleon' ),
   'section'                       => 'gameleon_popular_page_template',
   'settings'                      => 'td_popular_page_template_exclude_cat',
   'type'                          => 'text',
   'priority'                      => 2
) ) );


/*---------------------------------
MOST VIEWED/PLAYED PAGE TEMPLATE
---------------------------------*/
$wp_customize->add_section( 'gameleon_viewed_page_template', array(
   'title'                         => esc_html__( 'Most Viewed Page Template', 'gameleon' ),
   'panel'                         => 'gameleon_template_options',
   'priority'                      => 1
) );


/*---------------------------------
 EXCLUDE CATEGORY
---------------------------------*/
$wp_customize->add_setting( 'td_viewed_page_template_exclude_cat', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'viewed_page_template_exclude_cat', array(
   'label'                         => esc_html__( 'Exclude Category', 'gameleon' ),
   'description'                    => esc_html__( 'Enter the category ID that you don\'t want to be displayed. You can also enter multiple category ID\'s separated by commas. Example: 8,42,197.', 'gameleon' ),
   'section'                       => 'gameleon_viewed_page_template',
   'settings'                      => 'td_viewed_page_template_exclude_cat',
   'type'                          => 'text',
   'priority'                      => 2
) ) );


/*---------------------------------
ARCHIVE & CATEGORY OPTIONS
---------------------------------*/
$wp_customize->add_section( 'gameleon_archive_category', array(
   'title'                         => esc_html__( 'Archive & Category', 'gameleon' ),
   'panel'                         => 'gameleon_template_options',
   'priority'                      => 1
) );


$wp_customize->add_setting( 'gameleon_category_layout',
   array(
      'default' => '2',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_radio_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_category_layout',
   array(
      'label' => esc_html__( 'Category Layout', 'gameleon' ),
      'section' => 'gameleon_archive_category',
      'choices' => array(
         '1' => esc_html__( 'Style 1', 'gameleon' ),
         '2' => esc_html__( 'Style 2', 'gameleon' ),
         '3' => esc_html__( 'Style 3', 'gameleon' ),
      )
   )
) );

/*---------------------------------
   TITLE EXCERPT LENGTH
---------------------------------*/

$wp_customize->add_setting( 'td_category_title_length',
    array(
        'default' => 4,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_category_title_length',
    array(
        'label'   => esc_html__( 'Title lenght', 'gameleon' ),
        'section' => 'gameleon_archive_category',
        'description'  => esc_html__( 'Title limit in words. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'input_attrs' => array(
            'min' => 1,
            'max' => 30,
            'step' => 1,
        ),
    )
) );

/*---------------------------------
   TEXT EXCERPT LENGTH
---------------------------------*/

$wp_customize->add_setting( 'td_category_text_length',
    array(
        'default' => 8,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_category_text_length',
    array(
        'label'   => esc_html__( 'Content text lenght', 'gameleon' ),
        'section' => 'gameleon_archive_category',
        'description'  => esc_html__( 'Enable if you want to crop the featured images to 664px x 373px. Note that only new images are cropped. If you want to crop your old content, use Regenerate Thumbnails plugin.', 'gameleon' ),
        'input_attrs' => array(
            'min' => 1,
            'max' => 50,
            'step' => 1,
        ),
    )
) );

/*---------------------------------
SINGLE PAGE OPTIONS
---------------------------------*/

$wp_customize->add_section( 'gameleon_page_options', array(
   'title'                         => esc_html__( 'Single Page', 'gameleon' ),
   'panel'                         => 'gameleon_template_options',
   'priority'                      => 1
) );

/*---------------------------------
COMMENTS ON PAGES
---------------------------------*/

$wp_customize->add_setting( 'gameleon_disable_comments_page',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_disable_comments_page',
   array(
    'label'  => esc_html__( 'Disable comments on pages', 'gameleon' ),
      'section' => 'gameleon_page_options'
   )
) );



/*---------------------------------
SINGLE POSTS OPTIONS
---------------------------------*/

$wp_customize->add_section( 'gameleon_post_options', array(
   'title'                         => esc_html__( 'Single Post', 'gameleon' ),
   'panel'                         => 'gameleon_template_options',
   'priority'                      => 1
) );

/*---------------------------------
FEATURED IMAGE
---------------------------------*/

$wp_customize->add_setting( 'gameleon_featured_image',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_featured_image',
   array(
    'label'  => esc_html__( 'Featured Image', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );

/*---------------------------------
CROPPED FEATURED IMAGE
---------------------------------*/

$wp_customize->add_setting( 'gameleon_crop_featured_image',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_crop_featured_image',
   array(
    'label'  => esc_html__( 'Crop Featured Image', 'gameleon' ),
    'description'  => esc_html__( 'Enable if you want to crop the featured images to 664px x 373px. Note that only new images are cropped. If you want to crop your old content, use Regenerate Thumbnails plugin.', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );

/*---------------------------------
SHOW POST META
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_post_meta',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_single_post_meta',
   array(
    'label'  => esc_html__( 'Post Meta', 'gameleon' ),
    'description'  => esc_html__( 'Display post meta: category, date, views, comments, likes, review score.', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );

/*---------------------------------
SHOW POST TAGS
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_post_tags',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_single_post_tags',
   array(
    'label'  => esc_html__( 'Post Tags', 'gameleon' ),
    'description'  => esc_html__( 'Show or hide tags meta.', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );

/*---------------------------------
SOCIAL BOX SHARING
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_social_box',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_single_social_box',
   array(
    'label'  => esc_html__( 'Sharing Social Box', 'gameleon' ),
    'description'  => esc_html__( 'Show or hide the post sharing box on post.', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );


/*---------------------------------
AUTHOR BOX
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_author_box',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_single_author_box',
   array(
    'label'  => esc_html__( 'Author Box', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );


/*---------------------------------
POST NAVIGATION
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_nav',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_single_nav',
   array(
    'label'  => esc_html__( 'Posts Navigations', 'gameleon' ),
    'description'  => esc_html__( 'Show or hide next and previous posts.', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );

/*---------------------------------
POST COMMENTS 
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_comments',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_single_comments',
   array(
    'label'  => esc_html__( 'Post Comments', 'gameleon' ),
    'description'  => esc_html__( 'Enable or disable comments on all posts.', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );

/*---------------------------------
POST RELATED ARTICLES
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_related',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_single_related',
   array(
    'label'  => esc_html__( 'Related Posts', 'gameleon' ),
      'section' => 'gameleon_post_options'
   )
) );



/*---------------------------------
   NUMBER OF RELATED ARTICLES
---------------------------------*/

$wp_customize->add_setting( 'td_related_content_count',
    array(
        'default' => 2,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_related_content_count',
    array(
        'label'   => esc_html__( 'Number of Related posts', 'gameleon' ),
        'section' => 'gameleon_post_options',
        'input_attrs' => array(
            'min' => 2,
            'max' => 10,
            'step' => 2,
        ),
    )
) );


/*----------------------------------------------------------------------------------------------------------
   RELATED ARTICLES
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'td_related_content_type', array(
   'default'                       => 'td_by_cat',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( 'td_related_content_type', array(
   'label'                         => esc_html__( 'Related Article Filter', 'gameleon' ),
   'section'                       => 'gameleon_post_options',
   'settings'                      => 'td_related_content_type',
   'type'                          => 'select',
   'choices'                       => array(
      'td_by_cat'                   => esc_html__( 'Category', 'gameleon' ),
      'td_by_auth'                  => esc_html__( 'Author', 'gameleon' ),
      'td_by_tag'                   => esc_html__( 'Tags', 'gameleon' ),
   ),
   ) );


if ( defined( 'MYARCADE_VERSION' ) ) {

/*---------------------------------
GAMING OPTIONS
---------------------------------*/

$wp_customize->add_panel( 'gameleon_gaming_options', array(
   'title'                         => esc_html__( 'Gaming Options', 'gameleon' ),
   'priority'                      => 22
) );

/*---------------------------------
GAME LOADING PROGRESS BAR
---------------------------------*/
$wp_customize->add_section( 'gameleon_progress_bar', array(
   'title'                         => esc_html__( 'Game Loading Bar', 'gameleon' ),
   'panel'                         => 'gameleon_gaming_options',
   'priority'                      => 1
) );


$wp_customize->add_setting( 'gameleon_progress_bar',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_progress_bar',
   array(
    'label'  => esc_html__( 'Game Loading Bar', 'gameleon' ),
    'description'                    => esc_html__( 'Switch to enable/disable the progress bar when Interstitial Ad is set on Responsive Ads section options. Please note that if this option is disabled, all other settings below are useless.', 'gameleon' ),
    'priority'                      => 2,
      'section' => 'gameleon_progress_bar'
   )
) );

/*---------------------------------
 PROGRESS BAR INFO TEXT
---------------------------------*/
$wp_customize->add_setting( 'td_progress_bar_info_text', array(
   'default'                       => 'Game loaded, click here to play the game!',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'progress_bar_info_text', array(
   'label'                         => esc_html__( 'Progress Bar Info Message', 'gameleon' ),
   'description'                    => esc_html__( 'Type the progress bar text message. Leave empty to disable.', 'gameleon' ),
   'section'                       => 'gameleon_progress_bar',
   'settings'                      => 'td_progress_bar_info_text',
   'type'                          => 'text',
   'priority'                      => 4
) ) );


/*---------------------------------
   PROGRESS BAR SPEED
---------------------------------*/

$wp_customize->add_setting( 'td_progress_bar_speed',
    array(
        'default' => 10,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'td_progress_bar_speed',
    array(
        'label'   => esc_html__( 'Progress Bar Speed', 'gameleon' ),
        'section' => 'gameleon_progress_bar',
        'priority'  => 5,
        'input_attrs' => array(
            'min' => 1,
            'max' => 100,
            'step' => 1,
        ),
    )
) );


$wp_customize->add_setting( 'progress_bar_notice',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_text_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Simple_Notice_Custom_control( $wp_customize, 'progress_bar_notice',
   array(
      'description'  => esc_html__( 'Set the load speed of the progress bar. Note that a lower value will load the bar faster and a higher value will load the bar slower. Default: 10. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
      'section' => 'gameleon_progress_bar',
      'priority'                      => 6
   )
) );


/*---------------------------------
   INFO MESSAGE TIME
---------------------------------*/

$wp_customize->add_setting( 'gameleon_info_time',
    array(
        'default' => 35,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'gameleon_info_time',
    array(
        'label'   => esc_html__( 'Info time', 'gameleon' ),
        'section' => 'gameleon_progress_bar',
        'priority'                      => 7,
        'input_attrs' => array(
         'min' => 1,
         'max' => 100,
         'step' => 1,
        ),
    )
) );



// Progress bar Notice
$wp_customize->add_setting( 'progress_bar_notice_time',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_text_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Simple_Notice_Custom_control( $wp_customize, 'progress_bar_notice_time',
   array(
      'description'  => esc_html__( 'Set the time in percent when the progress bar info text should be appoear. Default: 35. That means after 35% of the progress bar loading, the message should appear. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
      'section' => 'gameleon_progress_bar',
      'priority'                      => 8
   )
) );



$wp_customize->add_setting( 'gameleon_arcade_featured_image_notice',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_text_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Simple_Notice_Custom_control( $wp_customize, 'gameleon_arcade_featured_image_notice',
   array(
      'description'  => esc_html__( 'Select the desired size for the featured game image that appears on the game page. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
      'section' => 'gameleon_arcade_featured_image',
      'priority'                      => 2
   )
) );



/*---------------------------------
LIGHT BUTTON
---------------------------------*/
$wp_customize->add_section( 'gameleon_light_button', array(
   'title'                         => esc_html__( 'Light Switch', 'gameleon' ),
   'panel'                         => 'gameleon_gaming_options',
   'priority'                      => 1
) );


$wp_customize->add_setting( 'gameleon_light_button',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_light_button',
   array(
    'label'  => esc_html__( 'Switch the light button', 'gameleon' ),
    'description'                    => esc_html__( 'Enable or disable the Light Switch Feature.', 'gameleon' ),
    'priority'                      => 2,
      'section' => 'gameleon_light_button'
   )
) );


/*---------------------------------
Full Screen  Button
---------------------------------*/
$wp_customize->add_section( 'gameleon_fullscreen_button', array(
   'title'                         => esc_html__( 'Full Screen Button', 'gameleon' ),
   'panel'                         => 'gameleon_gaming_options',
   'priority'                      => 1
) );


$wp_customize->add_setting( 'gameleon_fullscreen_button',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_fullscreen_button',
   array(
    'label'  => esc_html__( 'Play in Full Screen Mode', 'gameleon' ),
    'description'                    => esc_html__( 'Enable or disable the Full Screen button.', 'gameleon' ),
    'priority'                      => 2,
      'section' => 'gameleon_fullscreen_button'
   )
) );

/*---------------------------------
 PLAY FULL SCREEN 
---------------------------------*/
$wp_customize->add_setting( 'gameleon_play_full_text', array(
   'default'                       => 'Play Full Screen',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_play_full_text', array(
   'label'                         => esc_html__( 'Play Full Screen text', 'gameleon' ),
   'description'                    => esc_html__( 'Translate this sentence in your language', 'gameleon' ),
   'section'                       => 'gameleon_fullscreen_button',
   'settings'                      => 'gameleon_play_full_text',
   'type'                          => 'text',
   'priority'                      => 3
) ) );

/*---------------------------------
EXIST FULL SCREEN
---------------------------------*/
$wp_customize->add_setting( 'gameleon_exit_full_text', array(
   'default'                       => 'Exit Full Screen',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_exit_full_text', array(
   'label'                         => esc_html__( 'Exit Full Screen text', 'gameleon' ),
   'description'                    => esc_html__( 'Translate this sentence in your language.', 'gameleon' ),
   'section'                       => 'gameleon_fullscreen_button',
   'settings'                      => 'gameleon_exit_full_text',
   'type'                          => 'text',
   'priority'                      => 4
) ) );





/*---------------------------------
GAME TABS
---------------------------------*/
$wp_customize->add_section( 'gameleon_game_tabs', array(
   'title'                         => esc_html__( 'Game Tabs', 'gameleon' ),
   'panel'                         => 'gameleon_gaming_options',
   'priority'                      => 1
) );

/*---------------------------------
GAME SCREENSHOT TAB
---------------------------------*/
$wp_customize->add_setting( 'gameleon_game_screenshot_tab',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_game_screenshot_tab',
   array(
    'label'  => esc_html__( 'Game Screenshot Tab', 'gameleon' ),
    'description'                    => esc_html__( 'Enable or disable the game screenshot tab.', 'gameleon' ),
    'priority'                      => 1,
   'section' => 'gameleon_game_tabs'
   )
) );

/*---------------------------------
GAMEPLAY TRAILER TAB
---------------------------------*/
$wp_customize->add_setting( 'gameleon_game_trailer_tab',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_game_trailer_tab',
   array(
    'label'  => esc_html__( 'Game Trailer Tab', 'gameleon' ),
    'description'                   => esc_html__( 'Enable or disable the game video tab.', 'gameleon' ),
    'priority'                      => 2,
    'section'                       => 'gameleon_game_tabs'
   )
) );


/*---------------------------------
CUSTOM TAB
---------------------------------*/
$wp_customize->add_setting( 'gameleon_game_custom_tab',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_game_custom_tab',
   array(
    'label'  => esc_html__( 'Game Custom Tab', 'gameleon' ),
    'description'                   => esc_html__( 'Enable or disable the custom tab.', 'gameleon' ),
    'priority'                      => 3,
    'section'                       => 'gameleon_game_tabs'
   )
) );


/*---------------------------------
   CUSTOM TAB CONTENT
---------------------------------*/
$wp_customize->add_setting( 'gameleon_custom_tab_content', array(
   'default'                       => '',
   'sanitize_callback'             => 'gameleon_textarea_sanitization'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_custom_tab_content', array(
   'label'                         => esc_html__( 'Custom Tab Content', 'gameleon' ),
   'description'                   => esc_html__( 'You can use standard HTML tags with attributes. You can also add any kind of plugin shortcodes like a chat box, social media badges, etc.', 'gameleon' ),
   'section'                       => 'gameleon_game_tabs',
   'settings'                      => 'gameleon_custom_tab_content',
   'type'                          => 'textarea',
   'priority'                      => 5
) ) );


/*---------------------------------
   HOW TO PLAY TITLE
---------------------------------*/

$wp_customize->add_setting( 'gameleon_how_to_play', array(
   'default'                       => 'How to play',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_how_to_play', array(
   'label'                         => esc_html__( 'How to play text', 'gameleon' ),
   'section'                       => 'gameleon_game_tabs',
   'settings'                      => 'gameleon_how_to_play',
   'type'                          => 'text',
   'priority'                      => 6
) ) );



/*---------------------------------
   GAME SCREENSHOTS TITLE
---------------------------------*/
$wp_customize->add_setting( 'gameleon_screenshoots_text', array(
   'default'                       => 'Game Screenshoots',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_screenshoots_text', array(
   'label'                         => esc_html__( 'Screenshoots Tab Title', 'gameleon' ),
   'section'                       => 'gameleon_game_tabs',
   'settings'                      => 'gameleon_screenshoots_text',
   'type'                          => 'text',
   'priority'                      => 7
) ) );

/*---------------------------------
   GAME TRAILER TITLE
---------------------------------*/
$wp_customize->add_setting( 'gameleon_trailer_text', array(
   'default'                       => 'game Trailer',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_trailer_text', array(
   'label'                         => esc_html__( 'Trailer Tab Title', 'gameleon' ),
   'section'                       => 'gameleon_game_tabs',
   'settings'                      => 'gameleon_trailer_text',
   'type'                          => 'text',
   'priority'                      => 8
) ) );


/*---------------------------------
   CUSTOM TAB TITLE
---------------------------------*/

$wp_customize->add_setting( 'gameleon_custom_tab_title', array(
   'default'                       => 'Custom Tab',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_custom_tab_title', array(
   'label'                         => esc_html__( 'Custom Tab Title', 'gameleon' ),
   'section'                       => 'gameleon_game_tabs',
   'settings'                      => 'gameleon_custom_tab_title',
   'type'                          => 'text',
   'priority'                      => 9
) ) );


} // end MyArcade check




/*---------------------------------
FOOTER
---------------------------------*/

$wp_customize->add_panel( 'gameleon_footer_panel', array(
   'title'                         => esc_html__( 'Footer Options', 'gameleon' ),
   'priority'                      => 22
) );


$wp_customize->add_section( 'gameleon_footer_options', array(
   'title'                         => esc_html__( 'Footer Options', 'gameleon' ),
   'panel'                         => 'gameleon_footer_panel',
   'priority'                      => 1
) );

/*---------------------------------
SCROLL BUTTONS
---------------------------------*/

$wp_customize->add_setting( 'gameleon_scroll_buttons',
   array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_scroll_buttons',
   array(
    'label'  => esc_html__( 'Scroll to Top & Bottom', 'gameleon' ),
    'description'                    => esc_html__( 'Scroll to top & bottom buttons.', 'gameleon' ),
    'priority'                      => 1,
      'section'                      => 'gameleon_footer_options'
   )
) );


/*---------------------------------
   COPYRIGHT TEXT
---------------------------------*/
$wp_customize->add_setting( 'gameleon_footer_copyright', array(
   'default'                       => '',
   'sanitize_callback'             => 'gameleon_textarea_sanitization'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_footer_copyright', array(
   'label'                         => esc_html__( 'Footer Copyright Text', 'gameleon' ),
   'description'                   => esc_html__( 'You can use standard HTML tags and attributes.', 'gameleon' ),
   'section'                       => 'gameleon_footer_options',
   'settings'                      => 'gameleon_footer_copyright',
   'type'                          => 'textarea',
   'priority'                      => 5
) ) );


/*---------------------------------
COLOPHON
---------------------------------*/

$wp_customize->add_section( 'gameleon_colophon_options', array(
   'title'                         => esc_html__( 'Wide Box Banner', 'gameleon' ),
   'panel'                         => 'gameleon_footer_panel',
   'priority'                      => 23
) );


$wp_customize->add_setting( 'gameleon_colophon_enable',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_colophon_enable',
   array(
    'label'  => esc_html__( 'Display on Footer', 'gameleon' ),
    'description'                    => esc_html__( 'Our Wide Box Banner module allows you to add a message and a call to action button before the footer.', 'gameleon' ),
    'priority'                      => 2,
      'section'                     => 'gameleon_colophon_options'
   )
) );

/*---------------------------------
   COLOPHON BACKGROUND
---------------------------------*/


$wp_customize->add_setting( 'td_colophone_bg', array(
   'sanitize_callback'             => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'td_colophone_bg', array(
   'label'                         => esc_html__( 'Background Image', 'gameleon' ),
   'section'                       => 'gameleon_colophon_options',
   'settings'                      => 'td_colophone_bg',
   'priority'	                    => 2
) ) );

/*---------------------------------
   COLOPHON TEXT
---------------------------------*/

$wp_customize->add_setting( 'gameleon_colophon_text', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_colophon_text', array(
   'label'                         => esc_html__( 'Banner Text', 'gameleon' ),
   'section'                       => 'gameleon_colophon_options',
   'settings'                      => 'gameleon_colophon_text',
   'type'                          => 'text',
   'priority'                      => 3
) ) );


/*---------------------------------
   COLOPHON BUTTON TEXT
---------------------------------*/

$wp_customize->add_setting( 'gameleon_colophon_button_text', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_colophon_button_text', array(
   'label'                         => esc_html__( 'Button Text', 'gameleon' ),
   'section'                       => 'gameleon_colophon_options',
   'settings'                      => 'gameleon_colophon_button_text',
   'type'                          => 'text',
   'priority'                      => 4
) ) );

/*---------------------------------
   COLOPHON BUTTON LINK
---------------------------------*/

$wp_customize->add_setting( 'gameleon_colophon_button_link', array(
   'default'                       => '',
   'sanitize_callback'             => 'wp_kses_post'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_colophon_button_link', array(
   'label'                         => esc_html__( 'Button link', 'gameleon' ),
   'section'                       => 'gameleon_colophon_options',
   'settings'                      => 'gameleon_colophon_button_link',
   'type'                          => 'text',
   'priority'                      => 5
) ) );


/*---------------------------------
BACKGROUND
---------------------------------*/
$wp_customize->add_section( 'gameleon_background_image_control', array(
   'title'                         => esc_html__( 'Background', 'gameleon' ),
   'priority'                      => 23
) );

$wp_customize->add_setting( 'gameleon_background_image_upload', array(
   'sanitize_callback'             => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'gameleon_background_image_upload', array(
   'description'                   => esc_html__( 'Upload a background image for your site. ', 'gameleon' ),
   'label'                         => esc_html__( 'Background Image', 'gameleon' ),
   'section'                       => 'gameleon_background_image_control',
   'settings'                      => 'gameleon_background_image_upload',
   'priority'	                    => 1
) ) );


/*---------------------------------
BACKGROUND REPEAT
---------------------------------*/
$wp_customize->add_setting( 'gameleon_background_repeat',
array(
   'default' => 'no-repeat',
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_radio_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_background_repeat',
 array(
    'label' => esc_html__( 'Background Repeat', 'gameleon' ),
    'section' => 'gameleon_background_image_control',
    'priority'=> 2,
    'choices' => array(
       'repeat' => esc_html__( 'Repeat', 'gameleon' ),
       'no-repeat' => esc_html__( 'No Repeat', 'gameleon' ),
       'repeat-x' => esc_html__( 'Tile Horizontally', 'gameleon' ),
       'repeat-y' => esc_html__( 'Tile Vertically', 'gameleon' ),
    )
 )
) );


/*---------------------------------
BACKGROUND POSITION
---------------------------------*/
$wp_customize->add_setting( 'gameleon_background_position',
array(
   'default' => 'center',
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_radio_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_background_position',
 array(
    'label' => esc_html__( 'Background Position' , 'gameleon' ),
    'section' => 'gameleon_background_image_control',
    'priority'=> 3,
    'choices' => array(
       'left' => esc_html__( 'Left', 'gameleon' ),
       'center' => esc_html__( 'Center', 'gameleon' ),
       'right' => esc_html__( 'Right', 'gameleon' ),
    )
 )
) );

/*---------------------------------
BACKGROUND ATTACHMENT
---------------------------------*/
$wp_customize->add_setting( 'gameleon_background_attachment',
array(
   'default' => 'fixed',
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_radio_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_background_attachment',
 array(
    'label' => esc_html__( 'Background Attachment', 'gameleon' ),
    'section' => 'gameleon_background_image_control',
    'priority'=> 3,
    'choices' => array(
       'fixed' => esc_html__( 'Fixed', 'gameleon' ),
       'scroll' => esc_html__( 'Scroll', 'gameleon' ),
    )
 )
) );


/*---------------------------------
COLORS
---------------------------------*/
$wp_customize->add_panel( 'gameleon_color_scheme', array(
   'title'                         => esc_html__( 'Theme Colors', 'gameleon' ),
   'priority'                      => 25
) );


$wp_customize->add_section( 'gameleon_colors_general', array(
   'title'                         => esc_html__( 'General Colors', 'gameleon' ),
   'panel'                         => 'gameleon_color_scheme',
   'priority'                      => 1
) );


/*---------------------------------
  PRIMARY COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_primary_color', array(
   'default'                       => '#F63A3A',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
   'label'                         => esc_html__( 'Main Theme Color', 'gameleon' ),
   'section'                       => 'gameleon_colors_general',
   'settings'                      => 'gameleon_primary_color',
   'priority'	                    => 1
) ) );


/*---------------------------------
  THEME BACKGROUND COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_background_color', array(
   'default'                       => '#444444',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
   'label'                         => esc_html__( 'Theme Background Color', 'gameleon' ),
   'description'                    => esc_html__( 'This option will only work if you have not set any background image in the Background options.', 'gameleon' ),
   'section'                       => 'gameleon_colors_general',
   'settings'                      => 'gameleon_background_color',
   'priority'	                    => 1
) ) );



/*---------------------------------
  LOGO TEXT COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_logo_text_color', array(
   'default'                       => '#000000',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logo_text_color', array(
   'label'                         => esc_html__( 'Logo Text Color', 'gameleon' ),
   'description'                    => esc_html__( 'This option is applicable only if the logo image isn\'t set and only the site title is used.', 'gameleon' ),
   'section'                       => 'gameleon_colors_general',
   'settings'                      => 'gameleon_logo_text_color',
   'priority'	                    => 1
) ) );


/*---------------------------------
  BODY TEXT COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_body_text_color', array(
   'default'                       => '#4b4b4b',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_text_color', array(
   'label'                         => esc_html__( 'Body Text Color', 'gameleon' ),
   'section'                       => 'gameleon_colors_general',
   'settings'                      => 'gameleon_body_text_color',
   'priority'	                    => 1
) ) );


/*---------------------------------
  LINKS COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_links_color', array(
   'default'                       => '#000000',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_color', array(
   'label'                         => esc_html__( 'Links Color', 'gameleon' ),
   'section'                       => 'gameleon_colors_general',
   'settings'                      => 'gameleon_links_color',
   'priority'	                    => 1
) ) );


/*---------------------------------
  LINKS COLOR HOVER
---------------------------------*/
$wp_customize->add_setting( 'gameleon_links_color_hover', array(
   'default'                       => '#000000',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_color_hover', array(
   'label'                         => esc_html__( 'Links Hover Color', 'gameleon' ),
   'section'                       => 'gameleon_colors_general',
   'settings'                      => 'gameleon_links_color_hover',
   'priority'	                    => 1
) ) );


$wp_customize->add_section( 'gameleon_menu_colors', array(
   'title'                         => esc_html__( 'Main Menu', 'gameleon' ),
   'panel'                         => 'gameleon_color_scheme',
   'priority'                      => 2
) );

/*---------------------------------
  MAIN MENU BACKGROUND COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_menu_background_color', array(
   'default'                       => '#191919',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_background_color', array(
   'label'                         => esc_html__( 'Main Menu Background Color', 'gameleon' ),
   'section'                       => 'gameleon_menu_colors',
   'settings'                      => 'gameleon_menu_background_color',
   'priority'	                    => 1
) ) );


/*---------------------------------
  MAIN MENU LINK COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_menu_link_color', array(
   'default'                       => '#ffffff',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_link_color', array(
   'label'                         => esc_html__( 'Main Menu Text Color', 'gameleon' ),
   'section'                       => 'gameleon_menu_colors',
   'settings'                      => 'gameleon_menu_link_color',
   'priority'	                    => 1
) ) );

/*---------------------------------
  FOOTERS COLOR
---------------------------------*/

$wp_customize->add_section( 'gameleon_footer_colors', array(
   'title'                         => esc_html__( 'Footer', 'gameleon' ),
   'panel'                         => 'gameleon_color_scheme',
   'priority'                      => 2
) );

/*---------------------------------
  FOOTER LINKS COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_footer_text_colors', array(
   'default'                       => '#FFFFFF',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gameleon_footer_text_colors', array(
   'label'                         => esc_html__( 'Footer Links Color', 'gameleon' ),
   'section'                       => 'gameleon_footer_colors',
   'settings'                      => 'gameleon_footer_text_colors',
   'priority'	                    => 1
) ) );

/*---------------------------------
  FOOTER LINK HOVER COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_footer_links_hover_colors', array(
   'default'                       => '#444444',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gameleon_footer_links_hover_colors', array(
   'label'                         => esc_html__( 'Footer Links Hover Color', 'gameleon' ),
   'section'                       => 'gameleon_footer_colors',
   'settings'                      => 'gameleon_footer_links_hover_colors',
   'priority'	                    => 1
) ) );

/*---------------------------------
  WIDGETS COLOR
---------------------------------*/

$wp_customize->add_section( 'gameleon_widgets_colors', array(
   'title'                         => esc_html__( 'Widgets', 'gameleon' ),
   'panel'                         => 'gameleon_color_scheme',
   'priority'                      => 2
) );

/*---------------------------------
  WIDGETS LINKS COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_widgets_title_colors', array(
   'default'                       => '#444444',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gameleon_widgets_title_colors', array(
   'label'                         => esc_html__( 'Widgets Title Color', 'gameleon' ),
   'section'                       => 'gameleon_widgets_colors',
   'settings'                      => 'gameleon_widgets_title_colors',
   'priority'	                    => 1
) ) );

/*---------------------------------
  WIDGETS TITLE BACKGROUND / BORDER COLOR
---------------------------------*/
$wp_customize->add_setting( 'gameleon_widgets_background_colors', array(
   'default'                       => '#F9F9F9',
   'sanitize_callback'             => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gameleon_widgets_background_colors', array(
   'label'                         => esc_html__( 'Widgets Title Background & Border Color', 'gameleon' ),
   'description'                   => esc_html__( '(This option is not applicable if you use the dark theme option)', 'gameleon' ),
   'section'                       => 'gameleon_widgets_colors',
   'settings'                      => 'gameleon_widgets_background_colors',
   'priority'	                    => 2
) ) );





/*---------------------------------
TYPOGRAPHY
---------------------------------*/


$wp_customize->add_panel( 'gameleon_typography', array(
   'title'                         => esc_html__( 'Typography', 'gameleon' ),
   'priority'                      => 26
) );


   // BODY FONT
   $wp_customize->add_section( 'gameleon_body_font_settings_section', array(
      'title'                         => esc_html__( 'Body Font Settings', 'gameleon' ),
      'panel'                         => 'gameleon_typography',
      'priority'                      => 1
  ) );
  
  
  $wp_customize->add_setting( 'gameleon_body_font_settings', array(
      'default' => json_encode(
          array(
             'font' => 'Archivo Narrow',
             'regularweight' => 'regular',
             'italicweight' => 'italic',
             'boldweight' => '700',
             'category' => 'sans-serif'
          )
       ),
       
      'sanitize_callback' => 'gameleon_google_font_sanitization'
  )
  );
  
  $wp_customize->add_control( new Tiguan_Google_Font_Select_Custom_Control( $wp_customize, 'gameleon_body_font_settings',
  array(
      'label' => __( 'Body Font Family', 'gameleon' ),
      'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'gameleon' ),
      'section' => 'gameleon_body_font_settings_section',
      'priority'	                    => 1,
      'input_attrs' => array(
          'font_count' => 'all',
          'orderby' => 'alpha',
      ),
  )
  ) );
       
/*----------------------------------------------------------------------------------------------------------
   BODY FONT WEIGHT
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_body_font_weight', array(
   'default'                       => '400',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_body_font_weight', array(
   'label'                         => esc_html__( 'Body Font Weight', 'gameleon' ),
   'section'                       => 'gameleon_body_font_settings_section',
   'settings'                      => 'gameleon_body_font_weight',
   'type'                          => 'select',
   'priority'	                    => 21,
   'choices'                       => array(
       '400'                         => esc_html__( 'regular', 'gameleon' ),
       '300'                         => esc_html__( '300', 'gameleon' ),
       '500'                         => esc_html__( '500', 'gameleon' ),
       '600'                         => esc_html__( '600', 'gameleon' ),
       '700'                         => esc_html__( '700', 'gameleon' ),
) ) ) );


/*----------------------------------------------------------------------------------------------------------
   BODY FONT STYLE
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_body_font_styles', array(
   'default'                       => 'normal',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_body_font_styles', array(
   'label'                         => esc_html__( 'Body Font Style', 'gameleon' ),
   'section'                       => 'gameleon_body_font_settings_section',
   'settings'                      => 'gameleon_body_font_styles',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       'normal'                         => esc_html__( 'Normal', 'gameleon' ),
       'italic'                         => esc_html__( 'Italic', 'gameleon' ),
       'oblique'                         => esc_html__( 'Oblique', 'gameleon' ),
) ) ) );

/*----------------------------------------------------------------------------------------------------------
  BODY FONT SIZE
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_body_font_size', array(
        'default' => 15,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'gameleon_body_font_size',
    array(
        'label'   => esc_html__( 'Body Font Size', 'gameleon' ),
        'description'   => esc_html__( 'Select the font size for the body text. Default font size is 15px. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'section' => 'gameleon_body_font_settings_section',
        'input_attrs' => array(
            'min' => 8,
            'max' => 70,
            'step' => 1,
        ),
    )
) );

/*----------------------------------------------------------------------------------------------------------
  BODY FONT - LINE HEIGHT
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_body_font_line_height', array(
   'default'                       => '19',
   'transport' => 'refresh',
   'sanitize_callback'             => 'absint'
) );

$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'gameleon_body_font_line_height',
    array(
        'label'   => esc_html__( 'Line Height', 'gameleon' ),
        'description'   => esc_html__( 'Select the font line height for the body text, defined in px. Default is 19px. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'section' => 'gameleon_body_font_settings_section',
        'input_attrs' => array(
            'min' => 8,
            'max' => 60,
            'step' => 1,
        ),
    )
) );

// MENU FONT
   $wp_customize->add_section( 'gameleon_menu_font_settings_section', array(
      'title'                         => esc_html__( 'Main Menu Font Settings', 'gameleon' ),
      'panel'                         => 'gameleon_typography',
      'priority'                      => 1
  ) );
  
  
  $wp_customize->add_setting( 'gameleon_menu_font_settings', array(
      'default' => json_encode(
          array(
             'font' => 'Archivo Narrow',
             'regularweight' => 'regular',
             'italicweight' => 'italic',
             'boldweight' => '700',
             'category' => 'sans-serif'
          )
       ),
      'sanitize_callback' => 'gameleon_google_font_sanitization'
  )
  );
  
  $wp_customize->add_control( new Tiguan_Google_Font_Select_Custom_Control( $wp_customize, 'gameleon_menu_font_settings',
  array(
      'label' => __( 'Main Menu Font Family', 'gameleon' ),
      'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'gameleon' ),
      'section' => 'gameleon_menu_font_settings_section',
      'priority'	                    => 1,
      'input_attrs' => array(
          'font_count' => 'all',
          'orderby' => 'alpha',
      ),
  )
  ) );
       
/*----------------------------------------------------------------------------------------------------------
   MENU FONT WEIGHT
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_menu_font_weight', array(
   'default'                       => '600',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_menu_font_weight', array(
   'label'                         => esc_html__( 'Main Menu Font Weight', 'gameleon' ),
   'section'                       => 'gameleon_menu_font_settings_section',
   'settings'                      => 'gameleon_menu_font_weight',
   'type'                          => 'select',
   'priority'	                    => 21,
   'choices'                       => array(
       '400'                         => esc_html__( 'regular', 'gameleon' ),
       '300'                         => esc_html__( '300', 'gameleon' ),
       '500'                         => esc_html__( '500', 'gameleon' ),
       '600'                         => esc_html__( '600', 'gameleon' ),
       '700'                         => esc_html__( '700', 'gameleon' ),
) ) ) );


/*----------------------------------------------------------------------------------------------------------
   MENU FONT STYLE
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_menu_font_styles', array(
   'default'                       => 'normal',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_menu_font_styles', array(
   'label'                         => esc_html__( 'Main Menu Font Style', 'gameleon' ),
  // 'description' => esc_html__( 'Since some Google Fonts weren\'t meant to be italicized or obliqued, you may want to specify an italic font style only when you\'re sure that selected font has been designed with an italic style. For example, if a browser or operating system can\'t find the true italic version of a Google Font, it will often "fake it" creating a faux italic by slanting the original font.', 'gameleon' ),
   'section'                       => 'gameleon_menu_font_settings_section',
   'settings'                      => 'gameleon_menu_font_styles',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       'normal'                         => esc_html__( 'Normal', 'gameleon' ),
       'italic'                         => esc_html__( 'Italic', 'gameleon' ),
       'oblique'                         => esc_html__( 'Oblique', 'gameleon' ),
) ) ) );

/*----------------------------------------------------------------------------------------------------------
  MENU FONT SIZE
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_menu_font_size', array(
        'default' => 15,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'gameleon_menu_font_size',
    array(
        'label'   => esc_html__( 'Main Menu Font Size', 'gameleon' ),
        'description'   => esc_html__( 'Select the font size for the main menu. Default font size is 15px. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'section' => 'gameleon_menu_font_settings_section',
        'input_attrs' => array(
            'min' => 8,
            'max' => 70,
            'step' => 1,
        ),
    )
) );

// MENU TEXT TRANSFORM
$wp_customize->add_setting( 'gameleon_menu_text_transform_styles', array(
   'default'                       => 'none',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_menu_text_transform_styles', array(
   'label'                         => esc_html__( 'Menu Text Transform', 'gameleon' ),
  // 'description' => esc_html__( 'Since some Google Fonts weren\'t meant to be italicized or obliqued, you may want to specify an italic font style only when you\'re sure that selected font has been designed with an italic style. For example, if a browser or operating system can\'t find the true italic version of a Google Font, it will often "fake it" creating a faux italic by slanting the original font.', 'gameleon' ),
   'section'                       => 'gameleon_menu_font_settings_section',
   'settings'                      => 'gameleon_menu_text_transform_styles',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       'none'                      => esc_html__( 'None', 'gameleon' ),
       'uppercase'                 => esc_html__( 'Uppercase', 'gameleon' ),
       'capitalize'                => esc_html__( 'Capitalize', 'gameleon' ),
       'lowercase'                 => esc_html__( 'Lowercase', 'gameleon' ),
) ) ) );



   // WIDGETS FONT
   $wp_customize->add_section( 'gameleon_widgets_font_settings_section', array(
      'title'                         => esc_html__( 'Widgets Font Settings', 'gameleon' ),
      'panel'                         => 'gameleon_typography',
      'priority'                      => 1
  ) );
  
  
  $wp_customize->add_setting( 'gameleon_widgets_font_settings', array(
      'default' => json_encode(
          array(
             'font' => 'Oswald',
             'regularweight' => 'regular',
             'italicweight' => 'italic',
             'boldweight' => '700',
             'category' => 'sans-serif'
          )
       ),
      'sanitize_callback' => 'gameleon_google_font_sanitization'
  )
  );
  
  $wp_customize->add_control( new Tiguan_Google_Font_Select_Custom_Control( $wp_customize, 'gameleon_widgets_font_settings',
  array(
      'label' => __( 'Widgets Font Family', 'gameleon' ),
      'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'gameleon' ),
      'section' => 'gameleon_widgets_font_settings_section',
      'priority'	                    => 1,
      'input_attrs' => array(
          'font_count' => 'all',
          'orderby' => 'alpha',
      ),
  )
  ) );
       
/*----------------------------------------------------------------------------------------------------------
   WIDGETS FONT WEIGHT
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_widgets_font_weight', array(
   'default'                       => '400',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_widgets_font_weight', array(
   'label'                         => esc_html__( 'Widgets Font Weight', 'gameleon' ),
   'section'                       => 'gameleon_widgets_font_settings_section',
   'settings'                      => 'gameleon_widgets_font_weight',
   'type'                          => 'select',
   'priority'	                    => 21,
   'choices'                       => array(
       '400'                         => esc_html__( 'regular', 'gameleon' ),
       '300'                         => esc_html__( '300', 'gameleon' ),
       '500'                         => esc_html__( '500', 'gameleon' ),
       '600'                         => esc_html__( '600', 'gameleon' ),
       '700'                         => esc_html__( '700', 'gameleon' ),
) ) ) );


/*----------------------------------------------------------------------------------------------------------
   WIDGETS FONT STYLE
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_widgets_font_styles', array(
   'default'                       => 'normal',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_widgets_font_styles', array(
   'label'                         => esc_html__( 'Widgets Font Style', 'gameleon' ),
  // 'description' => esc_html__( 'Since some Google Fonts weren\'t meant to be italicized or obliqued, you may want to specify an italic font style only when you\'re sure that selected font has been designed with an italic style. For example, if a browser or operating system can\'t find the true italic version of a Google Font, it will often "fake it" creating a faux italic by slanting the original font.', 'gameleon' ),
   'section'                       => 'gameleon_widgets_font_settings_section',
   'settings'                      => 'gameleon_widgets_font_styles',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       'normal'                         => esc_html__( 'Normal', 'gameleon' ),
       'italic'                         => esc_html__( 'Italic', 'gameleon' ),
       'oblique'                         => esc_html__( 'Oblique', 'gameleon' ),
) ) ) );

/*----------------------------------------------------------------------------------------------------------
  WIDGETS FONT SIZE
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_widgets_font_size', array(
        'default' => 18,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'gameleon_widgets_font_size',
    array(
        'label'   => esc_html__( 'Widgets Font Size', 'gameleon' ),
        'description'   => esc_html__( 'Select the font size for the widgets text. Default font size is 15px. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'section' => 'gameleon_widgets_font_settings_section',
        'input_attrs' => array(
            'min' => 8,
            'max' => 70,
            'step' => 1,
        ),
    )
) );

/*----------------------------------------------------------------------------------------------------------
  WIDGETS FONT - LINE HEIGHT
-----------------------------------------------------------------------------------------------------------*/
$wp_customize->add_setting( 'gameleon_widgets_font_line_height', array(
   'default'                       => '30',
   'transport' => 'refresh',
   'sanitize_callback'             => 'absint'
) );

$wp_customize->add_control( new Tiguan_Slider_Custom_Control( $wp_customize, 'gameleon_widgets_font_line_height',
    array(
        'label'   => esc_html__( 'Widgets Line Height', 'gameleon' ),
        'description'   => esc_html__( 'Select the font line height for the widgets text, defined in px. Default is 19px. You can also use your keyboard left/right arrows to adjust the desired value.', 'gameleon' ),
        'section' => 'gameleon_widgets_font_settings_section',
        'input_attrs' => array(
            'min' => 8,
            'max' => 60,
            'step' => 1,
        ),
    )
) );


// WIDGETS TEXT TRANSFORM
$wp_customize->add_setting( 'gameleon_widgets_text_transform_styles', array(
   'default'                       => 'uppercase',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_widgets_text_transform_styles', array(
   'label'                         => esc_html__( 'Widgets Text Transform', 'gameleon' ),
  // 'description' => esc_html__( 'Since some Google Fonts weren\'t meant to be italicized or obliqued, you may want to specify an italic font style only when you\'re sure that selected font has been designed with an italic style. For example, if a browser or operating system can\'t find the true italic version of a Google Font, it will often "fake it" creating a faux italic by slanting the original font.', 'gameleon' ),
   'section'                       => 'gameleon_widgets_font_settings_section',
   'settings'                      => 'gameleon_widgets_text_transform_styles',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       'none'                      => esc_html__( 'None', 'gameleon' ),
       'uppercase'                 => esc_html__( 'Uppercase', 'gameleon' ),
       'capitalize'                => esc_html__( 'Capitalize', 'gameleon' ),
       'lowercase'                 => esc_html__( 'Lowercase', 'gameleon' ),
) ) ) );





/*---------------------------------
PERFORMANCE
---------------------------------*/

/*---------------------------------
MINIFY STYLESHEETS
---------------------------------*/
$wp_customize->add_section( 'gameleon_performance', array(
   'title'                         => esc_html__( 'Performance', 'gameleon' ),
   'priority'                      => 27
) );


$wp_customize->add_setting( 'gameleon_css_min',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_css_min',
   array(
    'label'  => esc_html__( 'Minify Stylesheets', 'gameleon' ),
    'description'                    => esc_html__( 'Switching to a minified version of your main CSS file helps reduce page load time on your website. It is also useful for debugging theme style.', 'gameleon' ),
    'priority'                      => 1,
      'section'                     => 'gameleon_performance'
   )
) );

/*---------------------------------
MINIFY JAVASCRIPTS
---------------------------------*/

$wp_customize->add_setting( 'gameleon_js_min',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_js_min',
   array(
    'label'  => esc_html__( 'Minify Javascript', 'gameleon' ),
    'description'                    => esc_html__( 'Switching to a minified version of your main JS file helps reduce page load time on your website. It is also useful for debugging.', 'gameleon' ),
    'priority'                      => 1,
      'section'                     => 'gameleon_performance'
   )
) );

/*---------------------------------
   RESPONSIVE ADS
---------------------------------*/

$wp_customize->add_panel( 'gameleon_responsive_ads', array(
   'title'                         => esc_html__( 'Ad Management', 'gameleon' ),
   'priority'                      => 28
) );


$wp_customize->add_section( 'gameleon_ad_info', array(
   'title'                         => esc_html__( 'Important!', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 2
) );

$wp_customize->add_setting( 'gameleon_ads_notice',
   array(
      'default' => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_text_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Simple_Notice_Custom_control( $wp_customize, 'gameleon_ads_notice',
   array(
      'label' => esc_html__( 'Important notice', 'gameleon' ),
      'description' => esc_html__( 'You can use either AdSense or custom ad codes. To displaye responsive AdSense ads, you need to create a responsive ad unit. To generate the ad code for a responsive ad unit, open your AdSense dashboard and under My Ads, click "Create new ad unit." Set Ad Size as "Responsive Ad Unit" and click the "Save and Get Code" button to generate the JavaScript code for your Responsive AdSense ad.', 'gameleon' ),
      'section' => 'gameleon_ad_info',
      'priority'                      => 1
   )
) );


/*---------------------------------
   HEADER AD
---------------------------------*/

$wp_customize->add_section( 'gameleon_header_ad_panel', array(
   'title'                         => esc_html__( 'Header Ad Code', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 2
) );

$wp_customize->add_setting( 'gameleon_header_ad', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_header_ad', array(
   'label'                         => esc_html__( 'Single post ad code', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_header_ad_panel',
   'settings'                      => 'gameleon_header_ad',
   'type'                          => 'textarea',
   'priority'                      => 2
) ) );



/*---------------------------------
   HEADER AD SIZE
---------------------------------*/

$wp_customize->add_setting( 'gameleon_header_ad_size',
array(
   'default' => '1',
   'transport' => 'refresh',
   'sanitize_callback' => 'gameleon_radio_sanitization'
)
);

$wp_customize->add_control( new Tiguan_Text_Radio_Button_Custom_Control( $wp_customize, 'gameleon_header_ad_size',
 array(
    'label' => esc_html__( 'Maximum Ad Size', 'gameleon' ),
    'section' => 'gameleon_header_ad_panel',
    'priority'=> 3,
    'choices' => array(
       '1' => esc_html__( '728', 'gameleon' ),
       '2' => esc_html__( '468', 'gameleon' ),
    )
 )
) );


/*---------------------------------
   SINGLE POST AD
---------------------------------*/
$wp_customize->add_section( 'gameleon_single_post_ad_panel', array(
   'title'                         => esc_html__( 'Single Post Ad', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 2
) );

$wp_customize->add_setting( 'gameleon_single_post_ad', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_single_post_ad', array(
   'label'                         => esc_html__( 'Single post ad code', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_single_post_ad_panel',
   'settings'                      => 'gameleon_single_post_ad',
   'type'                          => 'textarea',
   'priority'                      => 2
) ) );

/*---------------------------------
   SINGLE POST AD POSITION
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_post_position', array(
   'default'                       => '1',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_single_post_position', array(
   'label'                         => esc_html__( 'Ad position', 'gameleon' ),
   'description'                   => esc_html__( 'By default, Adsense ad code includes a data-ad-format tag with the value of "auto" which enables the auto-sizing behavior for the responsive ad unit. Please note that if you want to display Adsense ads and choose to display advertisements on the left or on the right of text content, the ad data format must be rectangle: data-ad-format="rectangle".', 'gameleon' ),
   'section'                       => 'gameleon_single_post_ad_panel',
   'settings'                      => 'gameleon_single_post_position',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       '1'                         => esc_html__( 'Top of the article', 'gameleon' ),
       '2'                         => esc_html__( 'At the end of article', 'gameleon' ),
       '3'                         => esc_html__( 'After first paragraph', 'gameleon' ),
       '4'                         => esc_html__( 'On the right of text', 'gameleon' ),
       '5'                         => esc_html__( 'On the left of text ', 'gameleon' ),

) ) ) );



/*---------------------------------
   SINGLE PAGE AD
---------------------------------*/
$wp_customize->add_section( 'gameleon_single_page_ad_panel', array(
   'title'                         => esc_html__( 'Single Page Ad', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 3
) );

$wp_customize->add_setting( 'gameleon_single_page_ad', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_single_page_ad', array(
   'label'                         => esc_html__( 'Single page ad code', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_single_page_ad_panel',
   'settings'                      => 'gameleon_single_page_ad',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );

/*---------------------------------
   SINGLE PAGE AD POSITION
---------------------------------*/

$wp_customize->add_setting( 'gameleon_single_page_position', array(
   'default'                       => '1',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_single_page_position', array(
   'label'                         => esc_html__( 'Ad position', 'gameleon' ),
   'section'                       => 'gameleon_single_page_ad_panel',
   'settings'                      => 'gameleon_single_page_position',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       '1'                         => esc_html__( 'On Top', 'gameleon' ),
       '2'                         => esc_html__( 'At the end bottom', 'gameleon' ),
       '3'                         => esc_html__( 'After first paragraph', 'gameleon' ),

) ) ) );



/*---------------------------------
   CATEGORY AD
---------------------------------*/
$wp_customize->add_section( 'gameleon_category_ad_panel', array(
   'title'                         => esc_html__( 'Category Ad', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_category_ad', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_category_ad', array(
   'label'                         => esc_html__( 'Category ad code', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_category_ad_panel',
   'settings'                      => 'gameleon_category_ad',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );

/*---------------------------------
   CATEGORY AD POSITION
---------------------------------*/

$wp_customize->add_setting( 'gameleon_category_position', array(
   'default'                       => '1',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_category_position', array(
   'label'                         => esc_html__( 'Ad position', 'gameleon' ),
   'section'                       => 'gameleon_category_ad_panel',
   'settings'                      => 'gameleon_category_position',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       '1'                         => esc_html__( 'On top', 'gameleon' ),
       '2'                         => esc_html__( 'At the bottom', 'gameleon' ),

) ) ) );


/*---------------------------------
   CUSTOM PAGE AD
---------------------------------*/
$wp_customize->add_section( 'gameleon_custom_page_ad_panel', array(
   'title'                         => esc_html__( 'Custom Pages Ad', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_custom_page_ad', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_custom_page_ad', array(
   'label'                         => esc_html__( 'Custom pages ad code', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_custom_page_ad_panel',
   'settings'                      => 'gameleon_custom_page_ad',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );

/*---------------------------------
   CUSTOM PAGES AD POSITION
---------------------------------*/

$wp_customize->add_setting( 'gameleon_custom_page_position', array(
   'default'                       => '1',
   'sanitize_callback'             => 'gameleon_sanitize_select'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_custom_page_position', array(
   'label'                         => esc_html__( 'Ad position', 'gameleon' ),
   'section'                       => 'gameleon_custom_page_ad_panel',
   'settings'                      => 'gameleon_custom_page_position',
   'type'                          => 'select',
   'priority'	                    => 2,
   'choices'                       => array(
       '1'                         => esc_html__( 'On top', 'gameleon' ),
       '2'                         => esc_html__( 'At the bottom', 'gameleon' ),

) ) ) );


/*---------------------------------
   SIDEBAR AD
---------------------------------*/
$wp_customize->add_section( 'gameleon_sidebar_ad_panel', array(
   'title'                         => esc_html__( 'Sidebar Ad', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_sidebar_ad', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_sidebar_ad', array(
   'label'                         => esc_html__( 'Sidebar Ad code', 'gameleon' ),
   'description'                   => esc_html__( 'To show this ad on sidebar, just drag the [G] Responsive Ads widget to the desired sidebar then select Responsive Sidebar Ad', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_sidebar_ad_panel',
   'settings'                      => 'gameleon_sidebar_ad',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );


/*---------------------------------
   CUSTOM AD 1
---------------------------------*/
$wp_customize->add_section( 'gameleon_custom_ad_1_panel', array(
   'title'                         => esc_html__( 'Custom Ad 1', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_custom_ad_1', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_custom_ad_1', array(
   'label'                         => esc_html__( 'Custom Ad 1 code - Used as a Widget', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_custom_ad_1_panel',
   'settings'                      => 'gameleon_custom_ad_1',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );

/*---------------------------------
   CUSTOM AD 2
---------------------------------*/
$wp_customize->add_section( 'gameleon_custom_ad_2_panel', array(
   'title'                         => esc_html__( 'Custom Ad 2', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_custom_ad_2', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_custom_ad_2', array(
   'label'                         => esc_html__( 'Custom Ad 2 code - Used as a Widget', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_custom_ad_2_panel',
   'settings'                      => 'gameleon_custom_ad_2',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );

/*---------------------------------
   CUSTOM AD 3
---------------------------------*/
$wp_customize->add_section( 'gameleon_custom_ad_3_panel', array(
   'title'                         => esc_html__( 'Custom Ad 3', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_custom_ad_3', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_custom_ad_3', array(
   'label'                         => esc_html__( 'Custom Ad 3 code - Used as a Widget', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_custom_ad_3_panel',
   'settings'                      => 'gameleon_custom_ad_3',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );

if ( defined( 'MYARCADE_VERSION' ) ) {

/*---------------------------------
   INTERSTITIAL AD - BEFORE GAME STARTS
---------------------------------*/
$wp_customize->add_section( 'gameleon_interstitial_panel', array(
   'title'                         => esc_html__( 'Interstitial Ad', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_interstitial', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_interstitial', array(
   'label'                         => esc_html__( 'Interstitial Ad - before the game start', 'gameleon' ),
   'description'                   => esc_html__( 'Important! You are allowed to dispay interstitial Adsense ads only if you are an eligible publisher of AdSense for Games program. However, you can display other ads using your custom code.', 'gameleon' ),
   'section'                       => 'gameleon_interstitial_panel',
   'settings'                      => 'gameleon_interstitial',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );


/*---------------------------------
   BELLOW THE GAME AD
---------------------------------*/
$wp_customize->add_section( 'gameleon_bellow_game_panel', array(
   'title'                         => esc_html__( 'Bellow The Game Ad', 'gameleon' ),
   'panel'                         => 'gameleon_responsive_ads',
   'priority'                      => 4
) );

$wp_customize->add_setting( 'gameleon_bellow_game', array(
   'default'                       => '',
   'sanitize_callback' => 'textarea_ad_sanitize'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gameleon_bellow_game', array(
   'label'                         => esc_html__( 'Bellow The Game Ad', 'gameleon' ),
   'description'                   => esc_html__( 'Paste your code here.', 'gameleon' ),
   'section'                       => 'gameleon_bellow_game_panel',
   'settings'                      => 'gameleon_bellow_game',
   'type'                          => 'textarea',
   'priority'                      => 1
) ) );

} // end if MYARCADE_VERSION check



/*----------------------------------------------------------------------------------------------------------
   SOCIAL MEDIA ACCOUNTS
-----------------------------------------------------------------------------------------------------------*/

$wp_customize->add_section( 'gameleon_social', array(
   'title'                         => esc_html__( 'Social Media Icons', 'gameleon' ),
   'priority'                      => 29
) );


// Show Social Icons
$wp_customize->add_setting( 'gameleon_top_bar_mobile_menu_show_social',
   array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'gameleon_switch_sanitization'
   )
);
 
$wp_customize->add_control( new Tiguan_Toggle_Switch_Custom_control( $wp_customize, 'gameleon_top_bar_mobile_menu_show_social',
   array(
    'label'  => esc_html__( 'Show social media icons', 'gameleon' ),
      'section' => 'gameleon_social',
      'priority' => 1
   )
) );

/*---------------------------------
FACEBOOK USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_facebook', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_facebook', array(
   'label'                         => esc_html__( 'Facebook Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_facebook',
   'type'		                    => 'text',
   'priority'	                    => 1
) ) );


/*---------------------------------
TWITTER USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_twitter', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_twitter', array(
   'label'                         => esc_html__( 'Twitter Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_twitter',
   'type'		                    => 'text',
   'priority'	                    => 2
) ) );


/*---------------------------------
INSTAGRAM USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_instagram', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_instagram', array(
   'label'                         => esc_html__( 'Instagram Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_instagram',
   'type'		                    => 'text',
   'priority'	                    => 3
) ) );

/*---------------------------------
GOOGLE+ USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_googleplus', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_googleplus', array(
   'label'                         => esc_html__( 'Google+ Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_googleplus',
   'type'                          => 'text',
   'priority'                      => 5
) ) );

/*---------------------------------
PINTEREST USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_pinterest', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_pinterest', array(
   'label'                         => esc_html__( 'Pinterest Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_pinterest',
   'type'		                    => 'text',
   'priority'	                    => 4
) ) );

/*---------------------------------
YOUTUBE USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_youtube', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_youtube', array(
   'label'                         => esc_html__( 'YouTube Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_youtube',
   'type'		                    => 'text',
   'priority'	                    => 7
) ) );


/*---------------------------------
FLICKR USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_flickr', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_flickr', array(
   'label'                         => esc_html__( 'Flickr Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_flickr',
   'type'                          => 'text',
   'priority'                      => 9
) ) );

/*---------------------------------
TUMBRL USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_tumblr', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_tumblr', array(
   'label'                         => esc_html__( 'Tumblr Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_tumblr',
   'type'		                    => 'text',
   'priority'	                    => 8
) ) );


/*---------------------------------
LINKEDIN USERNAME
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_linkedin', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_linkedin', array(
   'label'                         => esc_html__( 'LinkedIn Username', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_linkedin',
   'type'		                    => 'text',
   'priority'	                    => 10
) ) );


/*---------------------------------
RSS FEED LINK
---------------------------------*/
$wp_customize->add_setting( 'gameleon_social_rss', array(
   'default'                       => '',
   'sanitize_callback'             => 'sanitize_text_field'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_rss', array(
   'label'                         => esc_html__( 'RSS Feed Link', 'gameleon' ),
   'section'                       => 'gameleon_social',
   'settings'                      => 'gameleon_social_rss',
   'type'		                    => 'text',
   'priority'	                    => 11
) ) );



///////////////////////////////////// END ////////////////////////////////////////
}

add_action( 'customize_register', 'gameleon_customizer_settings' );