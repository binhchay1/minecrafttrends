<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/*----------------------------------------------------------------------------------------------------------
	DISPLAYS RESPONSIVE ADS
-----------------------------------------------------------------------------------------------------------*/


if( !function_exists( 'gameleon_responsive_ads_code' ) ) {

	function gameleon_responsive_ads_code() {


		if ( is_single() ) {
			$td_ad_unit 	= get_theme_mod( 'gameleon_single_post_ad' );
		}

		elseif ( is_archive() ) {
			$td_ad_unit 	= get_theme_mod( 'gameleon_category_ad' );
		}

		elseif ( is_page() ) {
			$td_ad_unit 	= get_theme_mod( 'gameleon_single_page_ad' );
		}

		elseif ( is_home() ) {
			$td_ad_unit 	= get_theme_mod( 'td_ad_home' );
		}

		// GLOBAL CODE
		$td_final_code = '';
		if ( $td_ad_unit ) {
		$td_final_code .= '<div class="td-no-lightbox ad-paragraph">';
		$td_final_code .= do_shortcode( stripslashes( $td_ad_unit ) );
		$td_final_code .= '</div>';
	}

		return $td_final_code;
	}
}

add_filter( 'the_content', 'responsive_ad_post' );
add_filter( 'the_content', 'responsive_ad_page' );


/*----------------------------------------------------------------------------------------------------------
	RESPONSIVE ADS ON SINGLE POSTS
-----------------------------------------------------------------------------------------------------------*/

function responsive_ad_post( $content ) {

	$td_slotad_position 	= get_theme_mod( 'gameleon_single_post_position' );
	$td_after_paragraph 	= '1'; // after first paragraph

	if ( !is_single() ) { // if not single post, the ad is not displayed
		return $content;
	}

	$content = explode ( "</p>", $content );

	$new_content = ''; // define variable to avoid PHP warnings

	for ( $i = 0; $i < count ( $content ); $i ++ ) {

		// Show the ad after first paragraph
		if( $td_slotad_position == '3' && $i == $td_after_paragraph ) {

			$new_content .= gameleon_responsive_ads_code(); // return the gameleon_responsive_ads_code function
		}

		$new_content .= $content[$i] . "</p>";
	}

	// Show the ad at the end of the post
	if ( $td_slotad_position == '2' ) {
		$new_content .= gameleon_responsive_ads_code();
	}

	// Show the ad on top of the post
	elseif ( $td_slotad_position == '1' ) {
		$new_content = gameleon_responsive_ads_code() . $new_content;
	}

	// Show the ad on on the right of text content
	elseif ( $td_slotad_position == '4' ) {
		$new_content = '<div class="td-right-single-ad">' . gameleon_responsive_ads_code() .'</div>' . $new_content;
	}

	// Show the ad on on the left of text content
	elseif ( $td_slotad_position == '5' ) {
		$new_content = '<div class="td-left-single-ad">' . gameleon_responsive_ads_code() .'</div>' . $new_content;
	}

	return $new_content;
}


/*----------------------------------------------------------------------------------------------------------
	RESPONSIVE CODE ON SINGLE PAGE
-----------------------------------------------------------------------------------------------------------*/

function responsive_ad_page( $content ) {
	$td_slotad_position_page	= get_theme_mod( 'gameleon_single_page_position' );
	$td_after_paragraph_page 	= '1';	// after first paragraph

	if ( !is_page() ) { // if not page, ad is not displayed
		return $content;
	}

	$content = explode ( "</p>", $content );
	$new_content = '';  // define variable to avoid PHP warnings
	for ( $i = 0; $i < count ( $content ); $i ++ ) {

		// Show the ad after first paragraph
		if( $td_slotad_position_page == '3' && $i == $td_after_paragraph_page ) {

			$new_content .= gameleon_responsive_ads_code(); // return the gameleon_responsive_ads_code function
		}

		$new_content .= $content[$i] . "</p>";
	}

	// Show the ad at the end of the page
	if ( $td_slotad_position_page == '2' ) {
		$new_content .= gameleon_responsive_ads_code();
	}

	// Show the ad on top of the page
	elseif ( $td_slotad_position_page == '1' ) {
		$new_content = gameleon_responsive_ads_code() . $new_content;
	}

	return $new_content;

}


/*----------------------------------------------------------------------------------------------------------
	RESPONSIVE CODE ON ARCHIVE
-----------------------------------------------------------------------------------------------------------*/

function responsive_ad_archive_top( $content ) {

	$td_archive_ad_position = get_theme_mod( 'gameleon_category_position' );

	if ( !is_archive() ) { // if not archive page, ad is not displayed
		return $content;
	}

	// Show the ad on top of the posts
	elseif ( $td_archive_ad_position == '1' ) {
		echo gameleon_responsive_ads_code();
	}
}

add_action('gameleon_ad_top', 'responsive_ad_archive_top' );


/* Show the ad at the end of the posts */

function responsive_ad_archive_bottom( $content ) {

	$td_archive_ad_position = get_theme_mod( 'gameleon_category_position' );

	if ( !is_archive() ) { // if not archive page, ad is not displayed
		return $content;
	}
	elseif ( $td_archive_ad_position == '2' ) {
		echo gameleon_responsive_ads_code();
	}
}

add_action( 'gameleon_ad_bottom', 'responsive_ad_archive_bottom' );



/*----------------------------------------------------------------------------------------------------------
	INTERSTITIAL RESPONSIVE AD
-----------------------------------------------------------------------------------------------------------*/

	if( !function_exists( 'responsive_interstitial_ad' ) ) {

		function responsive_interstitial_ad() {

		if ( is_single() ) {
		$td_ad_unit = get_theme_mod( 'gameleon_interstitial' );
		}

		// GLOBAL CODE
		$td_final_code = '';
		$td_final_code .= '<div class="td-no-lightbox ad-paragraph">';
		$td_final_code .= do_shortcode( stripslashes( $td_ad_unit ) );
		$td_final_code .= '</div>';
		if ( $td_ad_unit ) {
			return $td_final_code;
		}
	}
}



/*----------------------------------------------------------------------------------------------------------
	RESPONSIVE CODE - BELLOW THE GAME
-----------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'responsive_ad_bellow_the_game' ) ) {

	function responsive_ad_bellow_the_game() {

		if ( is_single() ) {
		$td_ad_unit = get_theme_mod( 'gameleon_bellow_game' );
		}

		// GLOBAL CODE
		$td_final_code = '';
		$td_final_code .= '<div class="td-no-lightbox ad-paragraph">';
		$td_final_code .= do_shortcode( stripslashes( $td_ad_unit ) );
		$td_final_code .= '</div>';
		if ( $td_ad_unit ) {
			return $td_final_code;
		}
	}
}


/*----------------------------------------------------------------------------------------------------------
	RESPONSIVE CODE - CUSTOM PAGES
-----------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'gameleon_responsive_custom' ) ) {

	function gameleon_responsive_custom() {

		$td_ad_unit 	= get_theme_mod( 'gameleon_custom_page_ad' );

		// GLOBAL CODE
		$td_final_code = '';
		$td_final_code .= '<div class="td-no-lightbox ad-paragraph">';
		$td_final_code .= do_shortcode( stripslashes( $td_ad_unit ) );
		$td_final_code .= '</div>';
		if ( $td_ad_unit ) {
			return $td_final_code;
		}
	}
}


/*----------------------------------------------------------------------------------------------------------
	RESPONSIVE CODE ON CUSTOM PAGE TEMPLATES
-----------------------------------------------------------------------------------------------------------*/

function responsive_ad_custom_pages_top() {

	$td_custom_page_position = get_theme_mod( 'gameleon_custom_page_position' );

	// Show the ad on top of the posts
	if ( $td_custom_page_position == '1' ) {
		echo gameleon_responsive_custom();
	}
}


/* Show the ad at the end of the posts */

function responsive_ad_custom_pages_bottom() {
	$td_custom_page_position = get_theme_mod( 'gameleon_custom_page_position' );

	if ( $td_custom_page_position == '2' ) {
		echo gameleon_responsive_custom();
	}
}


/*----------------------------------------------------------------------------------------------------------
	RESPONSIVE CODE ON HEADER
-----------------------------------------------------------------------------------------------------------*/

	if( !function_exists( 'responsive_ad_header' ) ) {

		function responsive_ad_header() {

		$td_ad_unit = get_theme_mod( 'gameleon_header_ad' );
		$td_ad_size = get_theme_mod( 'gameleon_header_ad_size' );

		if ( $td_ad_size == 1 ) {
			$td_top_ad_pos = 'top-ad-728';
		} else {
			$td_top_ad_pos = 'top-ad-468';
		}

		// GLOBAL CODE
		$td_final_code = '';
		$td_final_code .= '<div class="' . $td_top_ad_pos . '">';
		$td_final_code .= do_shortcode( stripslashes( $td_ad_unit ) );
		$td_final_code .= '</div>';
		if ( $td_ad_unit ) {
			return $td_final_code;
		}
	}
}