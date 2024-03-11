<?php

// IMPORTING CONTENT PATHS
function tdoneclick_import_files() {
  return array(
    array(
      'import_file_name'             => 'Dark Version',
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/demo-content-1.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/gameleon-widgets-1.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/customizer-1.dat',
      'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/demo/dark.png',
      'import_notice'                => __( 'Make sure you don\'t have any widgets active on any of your sidebars.', 'gameleon' ),
      'preview_url'                  => 'http://www.tiguandesign.com/gameleon/dark',
    ),
    array(
      'import_file_name'             => 'Fantasy',
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/demo-content-4.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/gameleon-widgets-4.wie',
      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/customizer-4.dat',
      'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/demo/fantasy.png',
      'import_notice'                => __( 'Make sure you don\'t have any widgets active on any of your sidebars.', 'gameleon' ),
      'preview_url'                  => 'http://www.tiguandesign.com/gameleon/dark',
    ),
    array(
        'import_file_name'             => 'Arcade',
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/demo-content-2.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/gameleon-widgets-2.wie',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/customizer-2.dat',
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/demo/arcade.png',
        'import_notice'                => __( 'Make sure you don\'t have any widgets active on any of your sidebars.', 'gameleon' ),
        'preview_url'                  => 'http://www.tiguandesign.com/gameleon/arcade/',
      ),
      array(
        'import_file_name'             => 'Magazine',
        'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/demo-content-3.xml',
        'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/gameleon-widgets-3.wie',
        'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'includes/oneclick/demo/customizer-3.dat',
        'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/demo/magazine.png',
        'import_notice'                => __( 'Make sure you don\'t have any widgets active on any of your sidebars.', 'gameleon' ),
        'preview_url'                  => 'http://www.tiguandesign.com/gameleon/magazine/',
      ),
  );
}

add_filter( 'pt-ocdi/import_files', 'tdoneclick_import_files' );


// Hide default intro text on One Click Demo page
add_action('admin_head', 'hide_default_intro');

function hide_default_intro() {
  echo '<style>
  .ocdi__intro-text {display:none;} 
  #tdnote {display:block;font-style:italic;margin-bottom:30px;}
  .td-swithch-manual {display:block;overflow:hidden;}
  </style>';
}

// change default intro text
function ocdi_plugin_intro_text( $default_text ) {
  $default_text .= '<div class="gameleon__intro-text">
  <hr />
  <div class="td-swithch-manual"><a href="?page=gameleon-one-click-demo&amp;import-mode=manual" class="ocdi__import-mode-switch">Switch to manual import!</a></div>
 
  <p class="about-description">
  Gameleon theme brings you beautiful & unique designs for your website so you don\'t have to create everything from scratch. With the Prebuilt Demo Website you know exactly which template is perfect to start building upon. Each pre-built demo website is fully customizable (fonts, colors, layouts, elements).
  </p>
  <span id="tdnote">*No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.</span>

  </div>';

  return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );


// change some plugin parameters 
function ocdi_plugin_page_setup( $default_settings ) {
  $default_settings['page_title']  = esc_html__( 'Gameleon One Click Demo', 'gameleon' );
  $default_settings['menu_title']  = esc_html__( 'One Click Demo' , 'gameleon' );
  $default_settings['menu_slug']   = 'gameleon-one-click-demo';

  return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'ocdi_plugin_page_setup' );


// disable the branding notice
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

// Automatically assign "Front page", "Posts page" and menu locations after the importer is done
function ocdi_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
          'mainmenu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
      )
  );

}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );