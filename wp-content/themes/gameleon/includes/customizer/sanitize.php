<?php

function gameleon_sanitize_checkbox( $checked ) {

    return ( ( isset( $checked ) && true === $checked ) ? true : false );

}


    /**
	 * Text sanitization
	 *
	 * @param  string	Input to be sanitized (either a string containing a single string or multiple, separated by commas)
	 * @return string	Sanitized input
	 */
	if ( ! function_exists( 'gameleon_text_sanitization' ) ) {
		function gameleon_text_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false) {
				$input = explode( ',', $input );
			}
			if( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[$key] = sanitize_text_field( $value );
				}
				$input = implode( ',', $input );
			}
			else {
				$input = sanitize_text_field( $input );
			}
			return $input;
		}
	}

	/**
	 * Switch sanitization
	 *
	 * @param  string		Switch value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'gameleon_switch_sanitization' ) ) {
		function gameleon_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}


	/**
	 * Array sanitization
	 *
	 * @param  array	Input to be sanitized
	 * @return array	Sanitized input
	 */
	if ( ! function_exists( 'gameleon_array_sanitization' ) ) {
		function gameleon_array_sanitization( $input ) {
			if( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[$key] = sanitize_text_field( $value );
				}
			}
			else {
				$input = '';
			}
			return $input;
		}
	}

	/**
	 * Textarea sanitization for ads
	 *
	 */

	function textarea_ad_sanitize( $value ) {
		return $value;
	}
	
	/**
	 * Textarea sanitization
	 *
	 */
	function gameleon_textarea_sanitization( $input ) {
		global $allowedposttags;
	
		return wp_kses( $input, $allowedposttags );
	
		$allowed = array(
					'a' => array(
						'href' => array(),
						'title' => array(),
						'target' => array(),
						'class' => array()
					),
					'br' => array(),
					'em' => array(),
					'script' => array(),
					'strong' => array(),
					'p' => array(
						'class' => array()
					)
				);
	
		return wp_kses( $input, $allowed );
	
		return wp_post_kses( $input );
		return wp_filter_post_kses( $input );
	}


	/**
 * Google Font sanitization
 *
 * @param  string	JSON string to be sanitized
 * @return string	Sanitized input
 */
if ( ! function_exists( 'gameleon_google_font_sanitization' ) ) {
    function gameleon_google_font_sanitization( $input ) {
        $val =  json_decode( $input, true );
        if( is_array( $val ) ) {
            foreach ( $val as $key => $value ) {
                $val[$key] = sanitize_text_field( $value );
            }
            $input = json_encode( $val );
        }
        else {
            $input = json_encode( sanitize_text_field( $val ) );
        }
        return $input;
    }
}

	/**
	 * Select sanitization
	 *
	 */
	if ( ! function_exists( 'gameleon_sanitize_select' ) ) {
	function gameleon_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );
	  
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
	  
		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	  }
	}

	/**
	 * Radio Button and Select sanitization
	 *
	 * @param  string		Radio Button value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'gameleon_radio_sanitization' ) ) {
		function gameleon_radio_sanitization( $input, $setting ) {
			//get the list of possible radio box or select options
		 $choices = $setting->manager->get_control( $setting->id )->choices;

			if ( array_key_exists( $input, $choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}
	}
