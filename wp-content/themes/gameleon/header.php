<?php
// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
  exit;
}
/*----------------------------------------------------------------------------------------------------------
  HEADER TEMPLATE
-----------------------------------------------------------------------------------------------------------*/
?>
<!doctype html>
<!--[if !IE]>
<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php

// facebook fix for wrong thumbnail image when using facebook share button
if ( is_single() ) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
		$gameleon_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		if ( !empty( $gameleon_image[0] ) ) {
			echo '<meta property="og:image" content="' .  $gameleon_image[0] . '" />';
		}
	}
}

wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( get_theme_mod( 'gameleon_show_meta_category' ) ) { ?>
      <!-- pre loader area start -->
      <div id="preloader">
         <div class="loader"></div>
         </div>
      <!-- pre loader area end -->
	  <?php } ?>
<?php
$td_sticky_menu   = get_theme_mod( 'td_sticky_menu' );
$td_logo_title 	= get_theme_mod( 'td_custom_logo_title' );

if ( $td_logo_title ) {
	$td_title = $td_logo_title;
} else {
	$td_title = 'Gameleon';
}

if ( $td_sticky_menu ) {
  $td_sticky = 'sticky-active';
} else {
  $td_sticky = 'do-nothing';
}

?>

<div id="container">

<div id="header">
<div class="header-wrap">


<div id="topbar" class="td-auto-hide-header <?php echo esc_attr( $td_sticky ); ?>">

<div class="container">

	<?php if ( has_nav_menu( 'mainmenu' ) ) : ?>
		<div id="top-menu">
			<div class="open-menu">
				<span class="line"></span>
				<span class="line"></span>
				<span class="line"></span>
			</div>
		</div><!-- #top-menu -->
	<?php endif; ?>

	<div id="mobile-logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php if ( get_theme_mod( 'td_site_logo' ) ) :?>
		<img src="<?php echo esc_url( get_theme_mod( 'td_site_logo' ) );?>" class="logo" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>">
		<?php elseif ( get_theme_mod( 'td_custom_logo_title' ) ) : echo wp_kses_post( get_theme_mod( 'td_custom_logo_title' ) ); ?>
		<?php else:?>
		<h1>
		<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_html( $td_logo_title ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php endif;?>
		</a>
	</div><!-- #mobile-logo -->


</div><!-- .container -->

<?php if ( get_theme_mod( 'td_search_icon' ) ) : ?>

<div id="mobile-searches">
<div class="menu-search-wrap">
<div class="main-menu-search">
	<div id="search-container" class="click-search">
	<i class="fas fa-search"></i>
	</div>

	<div class="td-expand">
		<form role="search" method="get" class="td-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div class="menu-search-form-wrap">
				<input id="td-header-search"  placeholder="<?php echo _e('search', 'gameleon'); ?>" type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
				
				<input class="td-search-button button" type="submit" id="td-search-main-menu" value="<?php echo _e('search', 'gameleon'); ?>" />
			</div>
		</form>

	</div>
</div>
</div>  
</div>

<?php endif;?>

</div><!-- #topbar -->
</div><!-- .header-wrap -->

<?php if ( has_nav_menu( 'mainmenu' )  ) : ?>
            <div id="mobile-menu-background"></div>

            <div id="mobile-menu">
                <div id="logo-close">
                    <div id="close-menu">
                        <span class="close-menu"><span class="dashicons dashicons-no-alt"></span></span>
                    </div><!-- #close-menu -->
                </div><!-- #logo-close -->

                <?php if ( has_nav_menu( 'mainmenu' ) ) : ?>
                    <div id="mobile-navigation">
                        <nav class="navigation">
                            <?php wp_nav_menu( array(
                                'theme_location' => 'mainmenu',
                                'container' => false,
                                'menu_class' => 'menu'
                            ) ); ?>
                        </nav><!-- .navigation -->

            </div><!-- #mobile-navigation -->
                <?php endif; ?>

				<div id="mobile-search">
				<?php get_search_form(); // mobile search ?>
			</div>


			<?php if ( get_theme_mod( 'gameleon_top_bar_mobile_menu_show_social' ) ) : ?>
					<div id="top-social">
						<ul class="social-icons">
							<?php get_template_part( 'parts/social-media-accounts' ); ?>
						</ul><!-- .social-icons -->
					</div><!-- #top-social -->
			<?php endif; ?>

            </div><!-- #mobile-menu -->
        <?php endif; ?>

		<?php
locate_template('parts/top-menu.php', true ); // yep, load the top menu


// Header constructor
 $td_header_manager = get_theme_mod('gameleon_contructor_header');
 
 $list = explode( ',', $td_header_manager ); 
			
			foreach ( $list as $value ) { 

				switch ( $value ) { 

				case 'block_logo_ad': // logo + ad
				echo '<div class="header-inner">';
				locate_template('parts/header-boxed-logo-ad.php', true );
				echo '</div>';
				break;

				case 'block_fullwidth_logo': // full logo
				locate_template( 'parts/header-boxed-full-logo.php', true );
				break;

				case 'block_ad_banner': // ad only
				echo '<div class="header-inner-ad-only">';
				locate_template( 'parts/header-boxed-ad-only.php', true );
				echo '</div>';
				break;

				case 'block_main_menu': // main menu
				if( has_nav_menu( 'topright', 'gameleon' ) ) {
				echo '<div class="td-right-wrap">';
				locate_template('parts/header-logo-menu.php', true ); 
				echo '</div>';
				}
				locate_template('parts/header-menu.php', true );
				break;

				
				case 'block_full_header_slider': // full slider
				if ( is_front_page() ) { // hide slider on other pages
				locate_template( 'parts/header-boxed-slider.php', true );
				}
				break;
				 
				case 'block_modular_slider': // modular slider
					if ( is_front_page() ) { // hide slider on other pages
				locate_template( 'parts/modular-slider.php', true );
					}
				break;

				case 'block_hero_header': // hero header
					if ( is_front_page() ) { // hide hero header on other pages
				locate_template( 'parts/hero-header.php', true );
					}
				break;	

				case 'block_news_ticker': // main menu
				locate_template('parts/news-ticker.php', true );
				break;

				default: locate_template( 'parts/header-boxed-full-logo.php', true );
			}

	}
	
?>

</div><?php // end of #header ?>
<div id="wrapper-content">
<?php gameleon_header_bottom(); // after header content hook ?>

<div id="td-home-wide">
<?php if( is_front_page() && !dynamic_sidebar( 'home-wide' ) ) { ?>
	<?php dynamic_sidebar( 'home-wide' ); ?>
<?php } ?>
</div>