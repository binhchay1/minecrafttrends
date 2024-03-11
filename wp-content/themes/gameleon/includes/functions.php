<?php

/*----------------------------------------------------------------------------------------------------------
  MAIN CONFIGURATION AND DEFINITION OF THE THEME
-----------------------------------------------------------------------------------------------------------*/
if ( ! defined( 'TD_THEME_NAME' ) ) {
define( 'TD_THEME_NAME', 'Gameleon' );
}

/*----------------------------------------------------------------------------------------------------------
  ADD TGM PLUGIN UPDATER
-----------------------------------------------------------------------------------------------------------*/
require_once( dirname( __FILE__ ) . '/classes/class-tgm-plugin-activation.php' );


/*----------------------------------------------------------------------------------------------------------
  ENQUEUE THEME SCRIPTS
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_enqueue_js' ) ) {

  function gameleon_enqueue_js() {

    global $is_IE; // WordPress-specific global variable for Internet Explorer

    $td_uri         = get_template_directory_uri();
    $gameleon       = wp_get_theme( 'gameleon' );
    $td_minified_js = get_theme_mod( 'gameleon_js_min' );

        if ( $td_minified_js == 1 ) {
          $td_js_directory = 'js-min';
          $js_suffix = '.min';
        } else {
          $td_js_directory = 'js-dev';
          $js_suffix = '';
        }

        // Enqueue external JavaScripts
        wp_enqueue_script( 'theme-external', $td_uri . '/assets/js/' . $td_js_directory . '/external' . $js_suffix . '.js', array( 'jquery' ), $gameleon['Version'], true );

        // Enqueue main theme script
        wp_enqueue_script( 'gameleon-theme', $td_uri . '/assets/js/' . $td_js_directory . '/theme-scripts' . $js_suffix . '.js', array( 'jquery' ), $gameleon['Version'], true );

        // Enqueue comment reply
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
          wp_enqueue_script( 'comment-reply' );
        }

    }
}

add_action( 'wp_enqueue_scripts', 'gameleon_enqueue_js' );


/*----------------------------------------------------------------------------------------------------------
   ENQUEUE CSS
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_enqueue_css' ) ) {

  function gameleon_enqueue_css() {
    $theme          = wp_get_theme();
    $gameleon       = wp_get_theme( 'gameleon' );
    $template_directory_uri = get_template_directory_uri();
    $td_css_min             = get_theme_mod( 'gameleon_css_min' );

    // css suffix for minified css
    if ( $td_css_min == 1 ) {
      $css_suffix = '.min';
    } else {
      $css_suffix = '';
    }

    // Main theme stylesheet
    wp_enqueue_style( 'gameleon-style',  $template_directory_uri . '/assets/css/style' . $css_suffix . '.css', false, $gameleon['Version'] );

    if( is_child_theme() ) {
      wp_enqueue_style( 'gameleon-child-style', get_stylesheet_uri(), false, $theme['Version'] );
    }
 }
}



add_action( 'wp_enqueue_scripts', 'gameleon_enqueue_css' );

/*----------------------------------------------------------------------------------------------------------
  ENQUEUE GOOGLE FONTS
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_google_fonts' ) ) {

  function gameleon_google_fonts() {
  
    $td_body_font           = json_decode( get_theme_mod( 'gameleon_body_font_settings' ), true );
    $td_mainmenu_font       = json_decode( get_theme_mod( 'gameleon_menu_font_settings' ), true );
    $td_widgets_font        = json_decode( get_theme_mod( 'gameleon_widgets_font_settings' ), true );

      // enqueue default theme google font pack
      wp_enqueue_style('google-font-pack',  'https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,700;1,400&family=Marcellus:wght@400&family=Oswald:wght@400;700&family=Permanent+Marker&display=swap', array(), null );
    
     
     
     if ( null !==( $td_body_font ) ) {
        wp_enqueue_style( 'google-body-font', 'https://fonts.googleapis.com/css2?family='.str_replace(' ', '+', $td_body_font['font']).':ital,wght@0,400;0,700;1,400&display=swap', false );
      }

      if ( null !==( $td_mainmenu_font ) ) {
        wp_enqueue_style( 'google-menu-font', 'https://fonts.googleapis.com/css2?family='.str_replace(' ', '+', $td_mainmenu_font['font']).':ital,wght@0,400;0,700;1,400&display=swap', false );
      }

      if ( null !==( $td_widgets_font ) ) {
        wp_enqueue_style( 'google-widgets-font', 'https://fonts.googleapis.com/css2?family='.str_replace(' ', '+', $td_widgets_font['font']).':ital,wght@0,400;0,700;1,400&display=swap', false );
      }

  }
  
}
  
add_action( 'wp_enqueue_scripts', 'gameleon_google_fonts' );

/*----------------------------------------------------------------------------------------------------------
  ENQUEUE FONT AWESOME
-----------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'gameleon_font_awesome_css' ) ) {

  // this function can be completely overwritten using a child theme.
  function gameleon_font_awesome_css() {
    $td_uri = get_template_directory_uri() . '/assets/fonts/font-awesome/css/all.css';

    //  adding the 'font_awesome css_url' filter to change the url of the font (you may want to use CDN).
    $td_url = apply_filters( 'font_awesome_css_url', $td_uri );
    wp_enqueue_style( 'font-awesome', $td_url, false );
    
  }
}

add_action( 'wp_enqueue_scripts', 'gameleon_font_awesome_css' );


/*----------------------------------------------------------------------------------------------------------
  SET A FALLBACK MENU THAT WILL SHOW A HOME LINK
-----------------------------------------------------------------------------------------------------------*/

function gameleon_fallback_menu() {
  ?>
  <ul id="menu" class="td-fallback-menu">
  <li><a href="/"><?php _e( 'Home', 'gameleon' ) ?></a></li>
  <li><a href="/wp-admin/nav-menus.php"><?php _e( 'Set primary menu', 'gameleon' ) ?></a></li>
  </ul>
  <?php
}
		

/*----------------------------------------------------------------------------------------------------------
  ADD THEME SUPPORT FOR TITLE TAG SINCE 4.1
-----------------------------------------------------------------------------------------------------------*/

add_theme_support( 'title-tag' );


/*----------------------------------------------------------------------------------------------------------
  HELPER CLASSES TO BODY
-----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'gameleon_smooth_class' ) ) {

  function gameleon_smooth_class( $classes ) {

  //CLASS FOR MAGNIFIC POP UP
  if( get_theme_mod( 'td_lightbox_feat' ) ) {
    $classes[] = 'td-lightbox-feat';
  }

// CLASS FOR WIDE BODY STYLE
$wide_version = get_theme_mod( 'gameleon_wide_layout') ;

if ( $wide_version == 2 ) {
    $classes[] = 'td-wide-mode';
  }
  

// CLASS FOR FIXED MENU
$fixed_autohide = get_theme_mod( 'td_fixed_menu') ;

if ( $fixed_autohide == 0 ) {
    $classes[] = 'td-menu-handle';
  }

// CLASS FOR DARK THEME MODE
$dark_version = get_theme_mod( 'gameleon_dark_layout') ;

if ( $dark_version == 2 ) {
    $classes[] = 'td-dark-mode';
  }
  
  return $classes;
  }
}

add_filter( 'body_class', 'gameleon_smooth_class' );


/*----------------------------------------------------------------------------------------------------------
  Mashshare Filters
--------------------------------------------------------------------/---------------------------------------*/

add_action( 'after_setup_theme', 'gameleon_mashsharer_disable_welcome_redirect' );

if ( class_exists( 'Mashshare' ) && ! class_exists( 'MashshareNetworks' ) ) {
  add_filter( 'mashsb_array_networks', 'gameleon_mashsharer_array_networks' );
  add_action( 'init', 'gameleon_mashsharer_register_new_networks' );
  add_filter( 'gameleon_most_shared_query_args', 'gameleon_mashsharer_get_most_shared_query_args', 10, 2 );
  add_filter( 'gameleon_entry_share_count', 'gameleon_mashsharer_get_share_count' );
  add_filter( 'gameleon_show_entry_share_count', 'gameleon_mashsharer_show_share_count', 10, 2 );
  add_action( 'gameleon_after_import_content', 'gameleon_mashsharer_set_defaults' );
}


/*----------------------------------------------------------------------------------------------------------
  REMOVES div from wp_page_menu() AND REPLACE IT WITH ul.
-----------------------------------------------------------------------------------------------------------*/

function gameleon_wp_page_menu( $page_markup ) {
  preg_match( '/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches );
  $divclass   = $matches[1];
  $replace    = array( '<div class="' . $divclass . '">', '</div>' );
  $new_markup = str_replace( $replace, '', $page_markup );
  $new_markup = preg_replace( '/^<ul>/i', '<ul class="' . $divclass . '">', $new_markup );

  return $new_markup;
}

add_filter( 'wp_page_menu', 'gameleon_wp_page_menu' );



/*----------------------------------------------------------------------------------------------------------
  GAMELEON THEME SETUP
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_setup' ) ) {

  function gameleon_setup() {

    global $content_width;

    // global content width.
    if( !isset( $content_width ) ) {
      $content_width = 700;
    }

    // Load theme textdomain.
    $domain = 'gameleon';
    load_theme_textdomain( $domain, WP_LANG_DIR . '/gameleon/' );
    load_theme_textdomain( $domain, get_stylesheet_directory() . '/languages/' );
    load_theme_textdomain( $domain, get_template_directory() . '/languages/' );

    // Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
    add_editor_style();

    // Enable post and comment RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Enable post-thumbnail support.
    add_theme_support( 'post-thumbnails' );

    // Set post featured image size
    $td_crop_features_image = get_theme_mod( 'gameleon_crop_featured_image' );
    if ( $td_crop_features_image == '' ) { // featured image on post
      add_image_size( 'post-image', 728, 0, true );
    } else {
      add_image_size( 'post-image', 728, 390, true );
    }
    add_image_size( 'module-tabs', 402, 230, true );          // image size for HOME TABS WIDGET (homepage)
    add_image_size( 'owl-sidebar', 300, 365, true );          // image size for POST SLIDER SIDEBAR WIDGET - BIG IMAGE (homepage)
    add_image_size( 'module-1-small', 80, 80, true );         // image size for HOME CATEGORIES WIDGET - SMALL IMAGE (homepage), CATEGORY, MOSTPLAYED, MOST POPULAR, AUTHOR, ARCHIVE PAGES
    add_image_size( 'module-blog', 174, 100, true );          // image size for BLOG STYLE(category), SEARCH, TAGS
    add_image_size( 'module-blog-index', 662, 335, true );    // image size for BLOG STYLE(homepage), SEARCH, TAGS
    add_image_size( 'module-carousel', 218, 160, true );      // image size for module-carousel(homepage)
    add_image_size( 'module-minicarousel', 90, 70, true );    // image size for module-minicarousel(homepage)
    add_image_size( 'module-friv', 90, 90, true );            // image size for FRIV STYLE(homepage)
    add_image_size( 'modular-slider', 610, 349, true );       // image size for modular-slider(homepage)
    add_image_size( 'modular-slider-wide', 778, 445, true );    // image size for modular-slider(homepage)
    add_image_size( 'module-8', 610, 420, true );             // image size for module 8
    add_image_size( 'modular-slider-small', 285, 222, true ); // image size for modular-slider-small (homepage)
    add_image_size( 'modular-cat', 302, 180, true );          // image size for category
    add_image_size( 'modular-square', 270, 235, true );       // image size for module 7
    add_image_size( 'blog-square', 320, 280, true );          // image size for module blog
    add_image_size( 'wide-size', 800, 600, true );            // image size for wide carousel
    // Set post thumbnail size
    if( !is_admin() ) {
    set_post_thumbnail_size( 728, 390, true );
  }


    // Enables custom-menus support
    register_nav_menus( array(
      'topmenu'     => __( 'Top Menu', 'gameleon' ),
      'mainmenu'    => __( 'Main Menu', 'gameleon' ),
      'topright'    => __( 'Right Menu', 'gameleon' )

      )
    );

  }

}

add_action( 'after_setup_theme', 'gameleon_setup' );


/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
add_action( 'wp_print_footer_scripts', 'gameleonjs_add_container_class' );

function gameleonjs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}
	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};
		settings.features = settings.features || mejs.MepDefaults.features;
		settings.features.push( 'exampleclass' );
		MediaElementPlayer.prototype.buildexampleclass = function( player ) {
			player.container.addClass( 'gameleon-mejs-container' );
		};
	})();
	</script>
	<?php
}

//Enqueue the Dashicons
add_action( 'wp_enqueue_scripts', 'gameleon_dashicons' );
function gameleon_dashicons() {
wp_enqueue_style( 'dashicons' );
}


/*----------------------------------------------------------------------------------------------------------
  ADD A SEARCH BOXX TO THE TOP MENU
-----------------------------------------------------------------------------------------------------------*/

function gameleon_search_to_menu( $items, $args ) {

  // theme options
  $td_show_search_top = get_theme_mod( 'td_top_search' );

  if( $args->theme_location == 'topmenu')
      if ( $td_show_search_top ) { // if it's enabled by theme options, show the search box
    $items .= '<li class="menu-item" id="mobile-search">' . get_search_form(false) . '</li>';
    $items .= '<li class="menu-item" id="header-search">' . get_search_form(false) . '</li>';
  }

  return $items;
}

add_filter( 'wp_nav_menu_items', 'gameleon_search_to_menu', 10, 2 );


/*----------------------------------------------------------------------------------------------------------
  COMMENTS FUNCTION
-----------------------------------------------------------------------------------------------------------*/

  function gameleon_comment( $comment, $args, $depth ) {

  $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

    <div class="the-comment">

    <?php echo get_avatar( $comment, $size='50' ); ?>

    <div class="comment-arrow"></div>

    <div class="comment-box">
    <div class="comment-author">

    <strong><?php echo get_comment_author_link() ?></strong>

    <small>
    <?php printf(__( '%1$s at %2$s', 'gameleon' ), get_comment_date(),  get_comment_time()) ?> <?php edit_comment_link(__( 'Edit', 'gameleon' ),'  ','') ?> -

    <?php comment_reply_link(array_merge( $args, array(
    'reply_text' => 'Reply',
    'depth' => $depth,
    'max_depth' => $args['max_depth']))) ?>
    </small>

    </div>

    <div class="comment-text">
    <?php if ($comment->comment_approved == '0') : ?>
    <em><?php _e( 'Your comment is awaiting moderation.', 'gameleon' ) ?></em>
    <br />
    <?php endif; ?>
    <?php comment_text() ?>
    </div>
    </div>
    </div>

<?php }


/*----------------------------------------------------------------------------------------------------------
  Add meta entry views count to single post, archive and blog list if set in theme options.
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_post_views' ) ) {

  function gameleon_post_views() {

    $buffer = '';

    // Check to see if "WP-PostViews" plugin is active then use it. "WP-PostViews" works great with "W3 Total Cache" and "Ajax_the_view"
    if ( function_exists( 'the_views' ) ) {
      $td_views_count = the_views(false);
      $buffer .= $td_views_count;
    }
    else {
      // Use the default theme views counter
      $buffer .= $td_views_count = get_gameleon_post_views( get_the_ID() ) ;
    }

    // get value of post views count from theme option for different pages
    if( is_single() ) {
      $show_views_count   = get_theme_mod( 'gameleon_single_post_meta' );
    }
    elseif( is_archive() ) {
      $show_views_count   = get_theme_mod( 'gameleon_show_meta_category') ;
    }
    else {
      $show_views_count   = 1; // get_theme_mod( 'td_blog_views_count' );
    }

    if( $show_views_count ) {
      ?>
        <span class="post-views-count">
          <?php if ( defined( 'MYARCADE_VERSION') and is_game() ): ?>
            <i class="fas fa-trophy"></i>
          <?php else: ?>
          <i class="fas fa-eye"></i>
          <?php endif; ?>
          <?php echo esc_html( $td_views_count ); ?> <?php if ( defined( 'MYARCADE_VERSION') and is_game() ): ?><?php _e( 'Plays', 'gameleon' ); ?><?php else: ?><?php _e( 'Views', 'gameleon' ); ?><?php endif; ?>
        </span>
      <?php
    }
  }
}


/*----------------------------------------------------------------------------------------------------------
  Display featured image caption on post.
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_post_thumbnail_caption' ) ) {

  function gameleon_post_thumbnail_caption() {

    global $post;

    $td_attachment_id = get_post_thumbnail_id( $post->ID );
    $td_image_caption = get_post_field( 'post_excerpt', $td_attachment_id );

    if ( !empty( $td_image_caption ) ) {
      echo '<p class="wp-caption-text td-featured-image-caption">'. $td_image_caption .'</p>';
    }
  }

}


/*----------------------------------------------------------------------------------------------------------
  DISPLAY FEATURED IMAGE
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_featured_image' ) ) {

  function gameleon_featured_image() {

    global $post;

    // get value of post featured image  from theme option, for different pages
    if( is_single() ) {

      $show_image_metabox = get_post_meta( $post->ID, 'gameleon_featured_image', true ); // get featured image option from meta box

      if ( $show_image_metabox == 'hide' ) {
        $show_image = false;

      } else {
        $show_image = get_theme_mod( 'gameleon_featured_image' );
      }

    }

    elseif( is_archive() ) {
      $show_image = get_theme_mod( 'td_archive_featured_images' );
    }

    else {
      $show_image = get_theme_mod( 'td_blog_featured_images' );
    }

    if( $show_image && '' != get_the_post_thumbnail() ) { // if( has_post_thumbnail() )

    $td_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
    if ( empty( $td_feat_image[0] ) ) $td_feat_image[0] = myarcade_featured_image();

    ?>

      <div class="featured-image">

        <a class="td-popup-image" href="<?php echo esc_url( $td_feat_image[0] ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">

          <?php the_post_thumbnail( 'post-image', array( 'class' => 'aligncenter' ) ); // I can also use : === the_post_thumbnail( 'post-image' ); === ?>

          <?php gameleon_post_thumbnail_caption(); // featured image caption ?>

        </a>
      </div>
      <?php
    }
  }
}


/*----------------------------------------------------------------------------------------------------------
  GET THE TITLE FUNCTION
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_get_post_title' ) ) {

    function gameleon_get_post_title() {

      global $post;
    $td_the_title     = get_the_title( $post->ID );
        $td_title_attribute = esc_attr( strip_tags( $td_the_title ) );
        $td_href      = get_permalink( $post->ID );

        $buffer = '';
        $buffer.= '<h3 class="entry-title">';
        $buffer.= '<a href="' . $td_href . '" rel="bookmark" title="' . $td_title_attribute . '">';
        $buffer.= $td_the_title;
        $buffer.= '</a>';
        $buffer.= '</h3>';

        return $buffer;
    }
}


/*----------------------------------------------------------------------------------------------------------
  RELATED POSTS MODULE
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_related_posts_module' ) ) {

  function gameleon_related_posts_module() {

    global $post;
    $td_the_title       = get_the_title( $post->ID );
    $td_title_attribute = esc_attr( strip_tags( $td_the_title ) );
    $td_href            = get_permalink( $post->ID );

    ob_start();
    ?>

    <div class="td-related-box grid col-340">
      <div class="td-fly-in">


    <a href="<?php echo esc_url( $td_href ); ?>" rel="bookmark" title="<?php echo esc_html( $td_title_attribute ); ?>">

          <?php
          if( get_the_post_thumbnail() ) { // if( has_post_thumbnail() )
            $td_return_related_image = the_post_thumbnail( 'modular-cat' );
          } else {

            $td_return_related_image = '<div class="td-noimage-fit-related"></div>';
          }
          echo wp_kses_post( $td_return_related_image );
          ?>
    </a>


      <h3 class="entry-title">
        <a href="<?php echo esc_url( $td_href ); ?>" rel="bookmark" title="<?php echo esc_html( $td_title_attribute ); ?>">
          <?php echo esc_html( $td_the_title ); ?>
        </a>
      </h3>

      <?php get_template_part( 'post-meta' ); ?>

    </div>
</div>
    <?php return ob_get_clean();
  }

}


/*----------------------------------------------------------------------------------------------------------
  RELATED POSTS CORE FUNCTION
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_related_posts' ) ) {

  function gameleon_related_posts() {

    global $post;
    $td_related_post        = get_theme_mod( 'gameleon_single_related' );
    $td_related_post_count  = get_theme_mod( 'td_related_content_count' );

    $category = get_the_category();
    $category[0]->count;

    if ( !is_single() ) {
      return;
    }


    $tags = wp_get_post_tags( $post->ID );
    if ( $td_related_post == 0 or 1 == $category[0]->count or !$tags ) { // hide the related box if is disabled in theme options or there is only one post in a category, or the post has no tags
      return;
    }

    $buffer = '';
    $args = array();

    switch ( get_theme_mod( 'td_related_content_type' ) ) {

      // related posts by tag
      case 'td_by_tag':
      $tags = wp_get_post_tags( $post->ID );

      if ( $tags ) {
        $taglist = array();
        for ($i = 0; $i <= 4; $i++) {
          if ( !empty( $tags[$i] ) ) {
            $taglist[] = $tags[$i]->term_id;
          } else {
            break;
          }
        }

        $args = array(
          'tag__in' => $taglist,
          'post__not_in' => array( $post->ID ),
          'showposts' => $td_related_post_count,
          'ignore_sticky_posts' => 1
          );
      }
      break;

    // related posts by author
      case 'td_by_auth':
      $args = array(
        'author' => $post->post_author,
        'post__not_in' => array( $post->ID ),
        'showposts' => $td_related_post_count,
        'ignore_sticky_posts' => 1
        );
      break;

      // related posts by category
      default:
      $args = array(
        'category__in' => wp_get_post_categories( $post->ID ),
        'post__not_in' => array( $post->ID ),
        'showposts' => $td_related_post_count,
        'ignore_sticky_posts' => 1
        );

      break;
    }


    if ( !empty( $args ) ) {
    // do the query
      $td_query = new WP_Query( $args );
      if ( $td_query->have_posts() ) {

        $buffer .= '<div class="td-content-inner-single">';
        $buffer .= '<div class="td-related-content">';

        if ( defined( 'MYARCADE_VERSION') ) {
        $buffer .= '<div class="widget-title"><h3>' . __( 'Related Games', 'gameleon' ) . '</h3></div>';
        } else {
        $buffer .= '<div class="widget-title"><h3>' . __( 'Related Articles', 'gameleon' ) . '</h3></div>';
        }

        $buffer .= '<div class="td-wrap-content">';

        while ( $td_query->have_posts() ) : $td_query->the_post();

        $buffer .= gameleon_related_posts_module();

        endwhile;

        $buffer .= '</div>';
        $buffer .= '</div>';
        $buffer .= '</div>';

      }
    }




    wp_reset_query();

    return $buffer;

  }
}

/*----------------------------------------------------------------------------------------------------------
  CUSTOM EXCERPT FUNCTION
-----------------------------------------------------------------------------------------------------------*/

function td_global_excerpt( $length ) {
      $text = explode( ' ', get_the_excerpt(), $length );
      if ( count( $text ) >= $length) {
        array_pop( $text );
        $text = implode(" ",$text).'&hellip;';
      } else {
        $text = implode(" ", $text);
      }
      $text = preg_replace('`\[[^\]]*\]`','', $text );
      return $text;
    }

    function content( $length ) {
      $content = explode( ' ', get_the_content(), $length );
      if ( count( $content ) >= $length ) {
        array_pop($content);
        $content = implode( " ", $content).'...';
      } else {
        $content = implode( " ", $content );
      }
      $content = preg_replace('/\[.+\]/','', $content );
      $content = apply_filters('the_content', $content );
      $content = str_replace(']]>', ']]&gt;', $content );
      return $content;
    }


/*----------------------------------------------------------------------------------------------------------
  CUSTOM EXCERPT FOR BLOG LAYOUT
-----------------------------------------------------------------------------------------------------------*/

function td_blog_excerpt_length( $length ) {
  return 125;
}

add_filter( 'excerpt_length', 'td_blog_excerpt_length', 999 );


/*----------------------------------------------------------------------------------------------------------
  Return a "Read more" link for excerpts
-----------------------------------------------------------------------------------------------------------*/

function gameleon_read_more( $more ) {

  global $post;

// get the excerpt more text from theme options.
  $text = get_theme_mod( 'gameleon_readmore_text' );
  
  $text = $text == '' ? __( 'Read More...', 'gameleon' ) : $text;

  $more = '&hellip;<p class="excerpt-more"><a class="blog-excerpt button" href="' . get_permalink( $post->ID ) . '">' . esc_html( $text ) . '</a></p>';

  return $more;
}

add_filter( 'excerpt_more', 'gameleon_read_more' );



/*----------------------------------------------------------------------------------------------------------
  Prints HTML with meta information for the current post date/time.
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_posted_on' ) ) {

  function gameleon_posted_on() {

    // get value of 'post byline date' toggle option from theme option for different pages
    if( is_single() ) {
      $show_date = 1;
    }
    elseif( is_archive() ) {
      $show_date = get_theme_mod( 'td_archive_byline_date' );
    }
    else {
      $show_date = 1; //get_theme_mod( 'td_blog_byline_date' );
    }

    // get all dates related to date
    $date_url   = esc_url( get_permalink() );
    $date_title = esc_attr( get_the_time() );
    $date_time  = esc_attr( get_the_time() );
    $date_time  = esc_attr( get_the_date( 'c' ) );
    $date       = esc_html( get_the_date() );

    // set the HTML for date link.
    $posted_on =
    '<a href="' . $date_url . '" title="' . $date_title . '" rel="bookmark">
    <time class="entry-date" datetime="' . $date_time . '">' . $date . '</time>
    </a>';

    // if 'post byline date toggle' is on then print HTML for date link
    if( $show_date ) {
      echo html_entity_decode( esc_html( $posted_on ) );
    }
  }
}

/*----------------------------------------------------------------------------------------------------------
  Add meta entry comments link to single post, archive and blog list if set in theme options.
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_comments_link' ) ) {

  function gameleon_comments_link() {

    // get value of 'post byline comments count' option from theme option for different pages
    if( is_single() ) {
      $show_comments_link = 1;
    }
    elseif( is_archive() ) {
      $show_comments_link = 1; // get_theme_mod( 'td_archive_byline_comments' );
    }
    else {
      $show_comments_link = 1; // get_theme_mod( 'td_blog_byline_comments' );
    }

    if( !post_password_required() and comments_open() and $show_comments_link ) {
      ?>

      <span class="comments-link">
        <?php comments_popup_link( '<i class="fas fa-comment-dots"></i> 0', '<i class="fas fa-comment-dots"></i> 1', '<i class="fas fa-comment-dots"></i> %' ); ?>
      </span>

      <?php
    }
  }
}


/*----------------------------------------------------------------------------------------------------------
  Add meta entry review final score to single post, archive and blog list if set in theme options.
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_review_final_score' ) ) {

  function gameleon_review_final_score() {
    global $post ;
    if( empty( $post_id ) ) {
      $post_id = $post->ID;
    }

    if( is_single() ) {
      $show_review_score = 1;
    }
    elseif( is_archive() ) {
      $show_review_score = 1;
    }
    else {
      $show_review_score = 1;
    }

    if ( function_exists( 'taqyeem_get_score' ) and $show_review_score ) {
      taqyeem_get_score(  $post_id );
    }

  }

}


/*----------------------------------------------------------------------------------------------------------
  Add meta entry likes to single post, archive and blog list if set in theme options.
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_likes' ) ) {

  function gameleon_likes() {

    if( is_single() ) {
      $show_likes = 1;
    }
    elseif( is_archive() ) {
      $show_likes = 1;
    }
    else {
      $show_likes = 1;
    }

    if ( function_exists( 'dot_irecommendthis' ) and $show_likes ) {
      dot_irecommendthis( );
    }

  }

}


/*----------------------------------------------------------------------------------------------------------
  Add tags and social share box to the post
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_share_box' ) ) {

  function gameleon_share_box() {

    global $post;
    $td_wp_tags             = get_the_tag_list();
    $tags_word              = '<span class="td-tag-word">' . __( 'Tagged', 'gameleon' ) . '</span>';
    $sprintf_tags           = sprintf( $tags_word . ' %1$s', $td_wp_tags );
    $td_post_tags           = apply_filters( 'gameleon_box_tags', $sprintf_tags );
    $td_show_post_tags      = get_theme_mod( 'gameleon_single_post_tags' );
    $td_show_post_sharing   = get_theme_mod( 'gameleon_single_social_box' );

    $buffer = $buffer_post_tags = '' ;

    if( $td_wp_tags and $td_show_post_tags ) {
      $buffer_post_tags = '<div class="td-social-box-share tag-links"> ' . $td_post_tags . '</div>';
    }

    $buffer .= '<div class="td-post-box-wrapper">' . $buffer_post_tags;

    if( $td_show_post_sharing ) {
      $td_image           = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-image' );
      $td_post_title      = get_the_title( $post->ID );
      $td_url             = urlencode( get_permalink( $post->ID ) );
      $td_source          = urlencode( get_bloginfo( 'name' ) );
      $td_summary         = urlencode( get_the_excerpt() );
      $twitter_username   = get_theme_mod( 'gameleon_twitter_username' ) ;

      $buffer .= '<div id="td-social-share-buttons" class="td-social-box-share td-social-border">

<a class="button td-share-love"><i class="fa fa-share"></i><span class="td-social-title">' . __( 'Share it!', 'gameleon' ) . '</span></a>

<a class="button td-box-twitter" href="https://twitter.com/intent/tweet?text=' . urlencode( $td_post_title ) . '&url=' . $td_url . '&via=' . urlencode($twitter_username ? $twitter_username : $td_source ) .'" onclick="if(!document.getElementById(\'td-social-share-buttons\')){window.open(this.href, \'console\',
\'left=50,top=50,width=600,height=440,toolbar=0\'); return false;}" ><i class="fab fa-twitter"></i><span class="td-social-title">Twitter</span></a>

<a class="button td-box-facebook"  href="http://www.facebook.com/sharer.php?u=' . $td_url . '" onclick="window.open(this.href, \'console\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fab fa-facebook"></i><span class="td-social-title">Facebook</span></a>

<a class="button td-box-google" href="https://plus.google.com/share?url=' . $td_url . '" onclick="window.open(this.href, \'console\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fab fa-google-plus"></i><span class="td-social-title">Google +</span></a>

<a class="button td-box-pinterest" href="http://pinterest.com/pin/create/button/?url=' . $td_url . '&amp;media=' . (!empty($td_image[0]) ? $td_image[0] : '') . '" onclick="window.open(this.href, \'console\',
\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fab fa-pinterest"></i><span class="td-social-title">Pinterest</span></a>

<a class="button td-box-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $td_url . '&amp;title=' . $td_post_title . '&amp;summary=' . $td_summary . '&amp;source=' . $td_source . '" onclick="window.open(this.href, \'console\',
\'left=50,top=50,width=828,height=450,toolbar=0\'); return false;"><i class="fab fa-linkedin"></i><span class="td-social-title">Linkedin</span></a>

      </div>';
    }

    echo html_entity_decode( esc_html( $buffer ) ) . '</div>';

  }

}

/*----------------------------------------------------------------------------------------------------------
  CHANGE DEFAULT TAG CLOUD TOOLTIP TO TAG NAME FOR SEO PURPOSES
-----------------------------------------------------------------------------------------------------------*/

function gameleon_change_tag_cloud_tooltip( $count, $tag ) {
  return $tag->name;
}


/*----------------------------------------------------------------------------------------------------------
  wp_title() filter for better SEO - adopted from Twenty Twelve.
-----------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'gameleon_wp_title' ) && !defined( 'AIOSEOP_VERSION' ) ) :

  function gameleon_wp_title( $title, $sep ) {
    global $page, $paged;

    if( is_feed() ) {
      return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if( $site_description && ( is_home() || is_front_page() ) ) {
      $title .= " $sep $site_description";
    }

    // Add a page number if necessary.
    if( $paged >= 2 || $page >= 2 ) {
      $title .= " $sep " . sprintf( __( 'Page %s', 'gameleon' ), max( $paged, $page ) );
    }

    return $title;
  }

  add_filter( 'wp_title', 'gameleon_wp_title', 10, 2 );

  endif;


/*----------------------------------------------------------------------------------------------------------
  Add TGM Plugins Activator
-----------------------------------------------------------------------------------------------------------*/

// recommended plugins
function gameleon_install_plugins() {

  $plugins = array(
    array(
      'name'     => 'WP-UserOnline',
      'slug'     => 'wp-useronline',
      'required' => false,
      'force_deactivation' => true
      ),
    array(
      'name'     => 'Easy Custom Sidebars',
      'slug'     => 'easy-custom-sidebars',
      'required' => false,
      'force_deactivation' => true
      ),
      array(
        'name'     => 'Classic Widgets',
        'slug'     => 'classic-widgets',
        'required' => false,
        'force_deactivation' => true
        ),
    array(
      'name'     => '1 Click Demo Import',
      'slug'     => 'one-click-demo-import',
      'required' => true,
      'force_activation' => true,
      'force_deactivation' => true
      ),
    array(
      'name'     => 'Mashshare Share Buttons',
      'slug'     => 'mashsharer',
      'required' => false,
      'force_deactivation' => true
      ),
    array(
      'name'     => 'WP-PageNavi',
      'slug'     => 'wp-pagenavi',
      'required' => false,
      'force_deactivation' => true
      ),
    array(
      'name'     => 'Contact form 7',
      'slug'     => 'contact-form-7',
      'required' => false,
      'force_deactivation' => true
      ),
    array(
      'name'     => 'I Recommend This',
      'slug'     => 'i-recommend-this',
      'required' => false,
      'force_deactivation' => true
      ),
    array(
                'name'          => 'Ajax Login Box', // The plugin name
                'slug'          => 'ninety-login', // The plugin slug (typically the folder name)
                'source'        => get_template_directory() . '/includes/plugins/ninety-login.zip', // The plugin source
                'required'        => false, // If false, the plugin is only 'recommended' instead of required
                'version'       => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'  => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'      => '', // If set, overrides default API URL and points to an external URL
                ),
                array(
                'name'            => 'Gameleon Widgets', // The plugin name
                'slug'            => 'gameleon-widgets', // The plugin slug (typically the folder name)
                'source'          => get_template_directory() . '/includes/plugins/gameleon-widgets.zip', // The plugin source
                'required'        => false, // If false, the plugin is only 'recommended' instead of required
                'version'         => '1.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'    => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'  => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'      => '', // If set, overrides default API URL and points to an external URL
            ),      
                array(
                'name'            => 'Envato Market', // The plugin name
                'slug'            => 'envato-market', // The plugin slug (typically the folder name)
                'source'          => get_template_directory() . '/includes/plugins/envato-market.zip', // The plugin source
                'required'        => false, // If false, the plugin is only 'recommended' instead of required
                'version'         => '2.0.10', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'  => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'      => '', // If set, overrides default API URL and points to an external URL
            ),    
                array(
                'name'            => 'Slider Revolution', // The plugin name
                'slug'            => 'revslider', // The plugin slug (typically the folder name)
                'source'          => get_template_directory() . '/includes/plugins/revslider.zip', // The plugin source
                'required'        => false, // If false, the plugin is only 'recommended' instead of required
                'version'         => '6.6.16', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'  => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'      => '', // If set, overrides default API URL and points to an external URL
            ),
                array(
                'name'            => 'Taqyeem - WordPress Review Plugin', // The plugin name
                'slug'            => 'taqyeem', // The plugin slug (typically the folder name)
                'source'          => get_template_directory() . '/includes/plugins/taqyeem.zip', // The plugin source
                'required'        => false, // If false, the plugin is only 'recommended' instead of required
                'version'         => '2.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'  => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'      => '', // If set, overrides default API URL and points to an external URL
            ),
                array(
                'name'            => 'Social Counter Plugin - Arqam', // The plugin name
                'slug'            => 'arqam', // The plugin slug (typically the folder name)
                'source'          => get_template_directory() . '/includes/plugins/arqam.zip', // The plugin source
                'required'        => false, // If false, the plugin is only 'recommended' instead of required
                'version'         => '2.7.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'  => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'      => '', // If set, overrides default API URL and points to an external URL
            )

    );

/**
 * Array of configuration settings. Amend each line as needed.
 * If you want the default strings to be available under your own theme domain, leave the strings uncommented.
 * Some of the strings are added into a sprintf, so see the comments at the end of each line for what each argument will be.
 */

  $config = array(
    'id'           => 'gameleon',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.


    'strings'      => array(
      'page_title'                      => esc_html__( 'Install Required Plugins', 'gameleon' ),
      'menu_title'                      => esc_html__( 'Install Plugins', 'gameleon' ),
      'installing'                      => esc_html__( 'Installing Plugin: %s', 'gameleon' ), // %s = plugin name.
      'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'gameleon' ),
      'notice_can_install_required'     => _n_noop(
        'This theme requires the following plugin: %1$s.',
        'This theme requires the following plugins: %1$s.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_can_install_recommended'  => _n_noop(
        'This theme recommends the following plugin: %1$s.',
        'This theme recommends the following plugins: %1$s.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_cannot_install'           => _n_noop(
        'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
        'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_ask_to_update'            => _n_noop(
        'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
        'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_ask_to_update_maybe'      => _n_noop(
        'There is an update available for: %1$s.',
        'There are updates available for the following plugins: %1$s.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_cannot_update'            => _n_noop(
        'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
        'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_can_activate_required'    => _n_noop(
        'The following required plugin is currently inactive: %1$s.',
        'The following required plugins are currently inactive: %1$s.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_can_activate_recommended' => _n_noop(
        'The following recommended plugin is currently inactive: %1$s.',
        'The following recommended plugins are currently inactive: %1$s.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'notice_cannot_activate'          => _n_noop(
        'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
        'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
        'gameleon'
      ), // %1$s = plugin name(s).
      'install_link'                    => _n_noop(
        'Begin installing plugin',
        'Begin installing plugins',
        'gameleon'
      ),
      'update_link'             => _n_noop(
        'Begin updating plugin',
        'Begin updating plugins',
        'gameleon'
      ),
      'activate_link'                   => _n_noop(
        'Begin activating plugin',
        'Begin activating plugins',
        'gameleon'
      ),
      'return'                          => esc_html__( 'Return to Required Plugins Installer', 'gameleon' ),
      'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'gameleon' ),
      'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'gameleon' ),
      'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'gameleon' ),  // %1$s = plugin name(s).
      'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'gameleon' ),  // %1$s = plugin name(s).
      'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'gameleon' ), // %s = dashboard link.
      'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'gameleon' ),

      'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
    ),

  );

   global $pagenow;
  // Add TGMPA plugin notification only on wp-admin/themes.php
   if ( current_user_can( 'manage_options' ) && 'themes.php' == $pagenow ) {
    tgmpa( $plugins, $config );
  }
}

add_action( 'tgmpa_register', 'gameleon_install_plugins' );


/*----------------------------------------------------------------------------------------------------------
  Disbale default widgets on theme activation
-----------------------------------------------------------------------------------------------------------*/

function gameleon_removed_widgets(){

  //get all registered sidebars
  global $wp_registered_sidebars;

  //get saved widgets
  $widgets = get_option('sidebars_widgets');

  //loop over the sidebars and remove all widgets
  foreach ($wp_registered_sidebars as $sidebar => $value) {
      unset($widgets[$sidebar]);
  }
  
  //update with widgets removed
  update_option('sidebars_widgets',$widgets);
}

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
  add_action('admin_footer','gameleon_removed_widgets');
}

// remove taqyeem admin plugin notice 
add_action('admin_head', 'remove_plugin_notice');

function remove_plugin_notice() {
  echo 
  '<style>
  .taqyeem-notice.taq-warning{
    display:none;
  }
  </style>';
}