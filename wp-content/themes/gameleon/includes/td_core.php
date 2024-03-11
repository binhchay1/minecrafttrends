<?php

/*----------------------------------------------------------------------------------------------------------
Theme utility functions
-----------------------------------------------------------------------------------------------------------*/

class td_core {


static $http_or_https = 'http';


/*----------------------------------------------------
	Return the URL of the user's avatar
-----------------------------------------------------*/

	static function get_avatar_url( $email, $size = 32 ){
		$get_avatar = get_avatar( $email, $size );

		preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $get_avatar, $matches);
		if (isset($matches[1])) {
			return $matches[1];
		} else {
			return '';
		}

	}

} // end of class

// SSL hook
if ( is_ssl() ) {
    td_core::$http_or_https = 'https';
}