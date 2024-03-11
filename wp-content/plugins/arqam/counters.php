<?php

/*-----------------------------------------------------------------------------------*/
# Twitter Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_twitter_count' ) ) :
	function arq_twitter_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['twitter']) ){
			$result = $arq_transient['twitter'];
		}
		elseif( empty($arq_transient['twitter']) && !empty($arq_data) && !empty( $arq_options['data']['twitter'] )  ){
			$result = $arq_options['data']['twitter'];
		}
		elseif( ! empty( $arq_data['twitter'] ) ){
			$result = $arq_data['twitter'];
		}
		else{
			$id    = $arq_options['social']['twitter']['id'];
			$token = get_option('arqam_TwitterToken');

			$args = array(
				'httpversion' => '1.1',
				'blocking' 		=> true,
				'timeout'     => 10,
				'headers'     => array(
					'Authorization' => "Bearer $token"
				)
			);

			add_filter('https_ssl_verify', '__return_false');
			$api_url  = "https://api.twitter.com/1.1/users/show.json?screen_name=$id";
			$response = arq_remote_get( $api_url, true, $args );

			$result = ! empty( $response['followers_count'] ) ? $response['followers_count'] : 0;

			if( ! empty( $result ) ) //To update the stored data
				$arq_data['twitter'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['twitter'] ) ) //Get the stored data
				$result = $arq_options['data']['twitter'];
		}

		// Manual
		if( empty( $result ) ){
			if ( ! empty( $arq_options['social']['twitter']['number'] )  ) {
				$result = $arq_options['social']['twitter']['number'];
				$arq_data['twitter'] = $result;
			} 
			else{
				$result = 0;
			}
		}

		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Facebook Fans
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_facebook_count' ) ) :
	function arq_facebook_count(){

		global $arq_data, $arq_options, $arq_transient;

		$counter = 0;

		if( !empty($arq_transient['facebook']) ){
			$counter = $arq_transient['facebook'];
		}
		elseif( empty($arq_transient['facebook']) && !empty($arq_data) && !empty( $arq_options['data']['facebook'] ) ){
			$counter = $arq_options['data']['facebook'];
		}
		elseif( ! empty( $arq_data['facebook'] ) ){
			$counter = $arq_data['facebook'];
		}
		else{

			$social_id = $arq_options['social']['facebook']['id'];

			$get_request = wp_remote_get( "https://www.facebook.com/plugins/likebox.php?href=https://facebook.com/$social_id&show_faces=true&header=false&stream=false&show_border=false&locale=en_US", array( 'timeout' => 20 ) );
			$the_request = wp_remote_retrieve_body( $get_request );

			$pattern = '/_1drq[^>]+>(.*?)<\/a/s';
			$counter = arq_get_the_number( $pattern, $the_request );
			$counter = ! empty( $counter ) ? $counter : 0;

			if( ! empty( $counter ) ) //To update the stored data
				$arq_data['facebook'] = $counter;

			if( empty( $counter ) && !empty( $arq_options['data']['facebook'] ) ){ //Get the stored data
				$counter = $arq_options['data']['facebook'];
			}
		}

		// Manual
			if( empty( $counter ) ){
			if ( ! empty( $arq_options['social']['facebook']['number'] ) ) {
				$counter = $arq_options['social']['facebook']['number'];
				$arq_data['facebook'] = $counter;
			} 
			else{
				$counter = 0;
			}
		}

		return $counter;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Youtube Subscribers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_youtube_count' ) ) :
	function arq_youtube_count(){

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['youtube']) ){
			$result = $arq_transient['youtube'];
		}
		elseif( empty($arq_transient['youtube']) && !empty($arq_data) && !empty( $arq_options['data']['youtube'] )  ){
			$result = $arq_options['data']['youtube'];
		}
		elseif( ! empty( $arq_data['youtube'] ) ){
			$result = $arq_data['youtube'];
		}
		else{
			$id  = $arq_options['social']['youtube']['id'];
			$api = $arq_options['social']['youtube']['key'];
			try {
				if( !empty($arq_options['social']['youtube']['type']) && $arq_options['social']['youtube']['type'] == 'Channel' ){
					$data = @arq_remote_get("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=$id&key=$api");
				}else{
					$data = @arq_remote_get("https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=$id&key=$api");
				}

				$result = ! empty( $data['items'][0]['statistics']['subscriberCount'] ) ? (int) $data['items'][0]['statistics']['subscriberCount'] : 0;

			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['youtube'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['youtube'] ) ) //Get the stored data
				$result = $arq_options['data']['youtube'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Vimeo Subscribers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_vimeo_count' ) ) :
	function arq_vimeo_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['vimeo']) ){
			$result = $arq_transient['vimeo'];
		}
		elseif( empty($arq_transient['vimeo']) && !empty($arq_data) && !empty( $arq_options['data']['vimeo'] )  ){
			$result = $arq_options['data']['vimeo'];
		}
		elseif( ! empty( $arq_data['vimeo'] ) ){
			$result = $arq_data['vimeo'];
		}
		else{
			$id = $arq_options['social']['vimeo']['id'];
			try {
				$data 	= @arq_remote_get( "http://vimeo.com/api/v2/channel/$id/info.json" );
				$result = ! empty( $data['total_subscribers'] ) ? (int) $data['total_subscribers'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['vimeo'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['vimeo'] ) ) //Get the stored data
				$result = $arq_options['data']['vimeo'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Dribbble Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_dribbble_count' ) ) :
	function arq_dribbble_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['dribbble']) ){
			$result = $arq_transient['dribbble'];
		}
		elseif( empty($arq_transient['dribbble']) && !empty($arq_data) && !empty( $arq_options['data']['dribbble'] )  ){
			$result = $arq_options['data']['dribbble'];
		}
		elseif( ! empty( $arq_data['dribbble'] ) ){
			$result = $arq_data['dribbble'];
		}
		else{
			$id 	= $arq_options['social']['dribbble']['id'];
			$api 	= get_option( 'dribbble_access_token' );
			try {
				$data 	= @arq_remote_get("https://api.dribbble.com/v2/user/?access_token=$api");
				$result = ! empty( $data['followers_count'] ) ? (int) $data['followers_count'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['dribbble'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['dribbble'] ) ) //Get the stored data
				$result = $arq_options['data']['dribbble'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Github Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_github_count' ) ) :
	function arq_github_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['github']) ){
			$result = $arq_transient['github'];
		}
		elseif( empty($arq_transient['github']) && !empty($arq_data) && !empty( $arq_options['data']['github'] )  ){
			$result = $arq_options['data']['github'];
		}
		elseif( ! empty( $arq_data['github'] ) ){
			$result = $arq_data['github'];
		}
		else{
			$id = $arq_options['social']['github']['id'];
			try {
				$data 	= @arq_remote_get("https://api.github.com/users/$id");
				$result = ! empty( $data['followers'] ) ? (int) $data['followers'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['github'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['github'] ) ) //Get the stored data
				$result = $arq_options['data']['github'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Envato Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_envato_count' ) ) :
	function arq_envato_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['envato']) ){
			$result = $arq_transient['envato'];
		}
		elseif( empty($arq_transient['envato']) && !empty($arq_data) && !empty( $arq_options['data']['envato'] )  ){
			$result = $arq_options['data']['envato'];
		}
		elseif( ! empty( $arq_data['envato'] ) ){
			$result = $arq_data['envato'];
		}
		else{
			$id = $arq_options['social']['envato']['id'];
			try {
				$data 	= @arq_remote_get("http://marketplace.envato.com/api/edge/user:$id.json");
				$result = ! empty( $data['user']['followers'] ) ? (int) $data['user']['followers'] : false;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ){ //To update the stored data
				$arq_data['envato'] = $result;
			}

			if( empty( $result ) && !empty( $arq_options['data']['envato'] ) ){ //Get the stored data
				$result = $arq_options['data']['envato'];
			}
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# SoundCloud Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_soundcloud_count' ) ) :
	function arq_soundcloud_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['soundcloud']) ){
			$result = $arq_transient['soundcloud'];
		}
		elseif( empty($arq_transient['soundcloud']) && !empty($arq_data) && !empty( $arq_options['data']['soundcloud'] )  ){
			$result = $arq_options['data']['soundcloud'];
		}
		elseif( ! empty( $arq_data['soundcloud'] ) ){
			$result = $arq_data['soundcloud'];
		}
		else{
			$id 	= $arq_options['social']['soundcloud']['id'];
			$api 	= $arq_options['social']['soundcloud']['api'];
			try {
				$data 	= @arq_remote_get("http://api.soundcloud.com/users/$id.json?consumer_key=$api");
				$result = ! empty( $data['followers_count'] ) ? (int) $data['followers_count'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['soundcloud'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['soundcloud'] ) ) //Get the stored data
				$result = $arq_options['data']['soundcloud'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Behance Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_behance_count' ) ) :
	function arq_behance_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['behance']) ){
			$result = $arq_transient['behance'];
		}
		elseif( empty($arq_transient['behance']) && !empty($arq_data) && !empty( $arq_options['data']['behance'] )  ){
			$result = $arq_options['data']['behance'];
		}
		elseif( ! empty( $arq_data['behance'] ) ){
			$result = $arq_data['behance'];
		}
		else{
			$id 	= $arq_options['social']['behance']['id'];
			$api 	= $arq_options['social']['behance']['api'];
			try {
				$data 	= @arq_remote_get("http://www.behance.net/v2/users/$id?api_key=$api");
				$result = ! empty( $data['user']['stats']['followers'] ) ? (int) $data['user']['stats']['followers'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['behance'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['behance'] ) ) //Get the stored data
				$result = $arq_options['data']['behance'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Instagram Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_instagram_count' ) ) :
	function arq_instagram_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['instagram']) ){
			$result = $arq_transient['instagram'];
		}
		elseif( empty($arq_transient['instagram']) && !empty($arq_data) && !empty( $arq_options['data']['instagram'] )  ){
			$result = $arq_options['data']['instagram'];
		}
		elseif( ! empty( $arq_data['instagram'] ) ){
			$result = $arq_data['instagram'];
		}
		else{

			$result = ! empty( $arq_options['social']['instagram']['number'] ) ? $arq_options['social']['instagram']['number'] : 0;

			if( !empty( $result ) ) //To update the stored data
				$arq_data['instagram'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['instagram'] ) ) // Get the stored data
				$result = $arq_options['data']['instagram'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Foursquare Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_foursquare_count' ) ) :
	function arq_foursquare_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['foursquare']) ){
			$result = $arq_transient['foursquare'];
		}
		elseif( empty($arq_transient['foursquare']) && !empty($arq_data) && !empty( $arq_options['data']['foursquare'] )  ){
			$result = $arq_options['data']['foursquare'];
		}
		elseif( ! empty( $arq_data['foursquare'] ) ){
			$result = $arq_data['foursquare'];
		}
		else{
			$api 	= get_option('foursquare_access_token');
			$date = date("Ymd");
			try {
				$data 	= @arq_remote_get("https://api.foursquare.com/v2/users/self?oauth_token=$api&v=$date");
				$result = ! empty( $data['response']['user']['friends']['count'] ) ? (int) $data['response']['user']['friends']['count'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['foursquare'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['foursquare'] ) ) //Get the stored data
				$result = $arq_options['data']['foursquare'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Mailchimp Subscribers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_mailchimp_count' ) ) :
	function arq_mailchimp_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['mailchimp']) ){
			$result = $arq_transient['mailchimp'];
		}
		elseif( empty($arq_transient['mailchimp']) && !empty($arq_data) && !empty( $arq_options['data']['mailchimp'] )  ){
			$result = $arq_options['data']['mailchimp'];
		}
		elseif( ! empty( $arq_data['mailchimp'] ) ){
			$result = $arq_data['mailchimp'];
		}
		else{

			$result = 0;

			$apikey = $arq_options['social']['mailchimp']['api'];
			$listId = $arq_options['social']['mailchimp']['id'];

			if( empty( $apikey ) || empty( $listId ) ){
				return $result;
			}

			$server = explode( '-', $apikey );

			if( ! empty( $server[1] ) ){
				$server = $server[1];

				$response = wp_remote_get( "https://$server.api.mailchimp.com/3.0/lists/$listId", array(
					'timeout' => 10,
					'headers' => array(
						'Authorization' => 'Basic ' . base64_encode( 'anystring' . ':' . $apikey )
					),
				));

				$response = wp_remote_retrieve_body( $response );
				$response = json_decode( $response, true );
			}

			if( ! empty( $response['stats']['member_count'] ) ){
				$result = $response['stats']['member_count'];
			}

			if( ! empty( $result ) ) //To update the stored data
				$arq_data['mailchimp'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['mailchimp'] ) ) //Get the stored data
				$result = $arq_options['data']['mailchimp'];
		}

		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# MailPoet Subscribers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_mailpoet_count' ) ) :
	function arq_mailpoet_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['mailpoet']) ){
			$result = $arq_transient['mailpoet'];
		}
		elseif( empty($arq_transient['mailpoet']) && !empty($arq_data) && !empty( $arq_options['data']['mailpoet'] )  ){
			$result = $arq_options['data']['mailpoet'];
		}
		elseif( ! empty( $arq_data['mailpoet'] ) ){
			$result = $arq_data['mailpoet'];
		}
		else{

			$list = $arq_options['social']['mailpoet']['list'];

			if( !empty( $list )){
				if( $list == 'all' ){
					$result	= do_shortcode( '[mailpoet_subscribers_count]' );
				}else{
					$result	= do_shortcode( '[mailpoet_subscribers_count segments="'. $list .'"]' );
				}
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['mailpoet'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['mailpoet'] ) ) //Get the stored data
				$result = $arq_options['data']['mailpoet'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# myMail Subscribers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_mymail_count' ) ) :
	function arq_mymail_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['mymail']) ){
			$result = $arq_transient['mymail'];
		}
		elseif( empty($arq_transient['mymail']) && !empty($arq_data) && !empty( $arq_options['data']['mymail'] )  ){
			$result = $arq_options['data']['mymail'];
		}
		elseif( ! empty( $arq_data['mymail'] ) ){
			$result = $arq_data['mymail'];
		}
		else{

			$list = $arq_options['social']['mymail']['list'];

			if( !empty( $list )){
				if( $list == 'all' ){
					$result = mailster('subscribers')->get_count_by_status( false );
				}
				else{
					$result	= mailster('lists')->get_member_count( $list, 1) ;
				}
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['mymail'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['mymail'] ) ) //Get the stored data
				$result = $arq_options['data']['mymail'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# LinkedIn Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_linkedin_count' ) ) :
	function arq_linkedin_count() {

		global $arq_data, $arq_options, $arq_transient;

		$counter = 0;

		if( ! empty($arq_transient['linkedin']) ){
			$counter = $arq_transient['linkedin'];
		}
		elseif( empty($arq_transient['linkedin']) && !empty($arq_data) && !empty( $arq_options['data']['linkedin'] )  ){
			$counter = $arq_options['data']['linkedin'];
		}
		elseif( ! empty( $arq_data['linkedin'] ) ){
			$counter = $arq_data['linkedin'];
		}
		else{

			if( ! empty( $arq_options['social']['linkedin']['type'] ) ){

				if( $arq_options['social']['linkedin']['type'] == 'Profile' && ! empty( $arq_options['social']['linkedin']['profile'] )){

					/* $token = get_option( 'linkedin_access_token' );

					$args  = array(
						'headers' => array('Authorization' => sprintf('Bearer %s', $token))
					);

					$data   = arq_remote_get('https://api.linkedin.com/v2/me/', true, $args );
					$result = (int) $data['numConnections'];

					var_dump( $data );
					*/

					$counter = 500; // max number of connections.
				}
				elseif( $arq_options['social']['linkedin']['type'] == 'Company' && ! empty( $arq_options['social']['linkedin']['company'] )){

					// Check if CURL is enabled
					if( ! function_exists( 'curl_version' ) ){
						return;
					}

					$id  = $arq_options['social']['linkedin']['company']; //1337 // 10540535
					$org = urlencode( get_home_url() );
					$url = 'https://www.linkedin.com/pages-extensions/FollowCompany?id='.$id.'&counter=bottom&xdOrigin='. $org;

					//---
					$ch = curl_init();
					curl_setopt( $ch, CURLOPT_URL, $url );
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
					curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
					curl_setopt( $ch, CURLOPT_MAXREDIRS, 3 );
					curl_setopt( $ch, CURLOPT_ENCODING, '' );
					curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
					curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
					curl_setopt( $ch, CURLOPT_HEADER, false );
					curl_setopt( $ch, CURLOPT_AUTOREFERER,true );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Accept-Language: en'] );
					curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0' );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
					curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
					$the_request = curl_exec($ch);

					//error checking
					if ($the_request === false) {
						curl_close($ch);
					}
					else{
						$pattern = '/follower-count[^>]+>(.*?)<\/div/s';
						$counter = arq_get_the_number( $pattern, $the_request );
					}

				}

				if( ! empty( $counter ) ){ //To update the stored data
					$arq_data['linkedin'] = $counter;
				}

				if( empty( $counter ) && !empty( $arq_options['data']['linkedin'] ) ){ //Get the stored data
					$counter = $arq_options['data']['linkedin'];
				}

			}
		}

		return $counter;
	}
endif;



/*-----------------------------------------------------------------------------------*/
# Vk Members
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_vk_count' ) ) :
	function arq_vk_count() {

		global $arq_data, $arq_options, $arq_transient;

		$counter = 0;

		if( !empty($arq_transient['vk']) ){
			$counter = $arq_transient['vk'];
		}
		elseif( empty($arq_transient['vk']) && !empty($arq_data) && !empty( $arq_options['data']['vk'] )  ){
			$counter = $arq_options['data']['vk'];
		}
		elseif( ! empty( $arq_data['vk'] ) ){
			$counter = $arq_data['vk'];
		}
		else{

			$id = $arq_options['social']['vk']['id'];

			$get_request = wp_remote_get( "https://m.vk.com/$id", array( 'timeout' => 20 ) );
			$the_request = wp_remote_retrieve_body( $get_request );

			$pattern = '/pm_counter[^>]+>(.*?)<\/em/s';
			$counter = arq_get_the_number( $pattern, $the_request );

			if( !empty( $counter ) ){ //To update the stored data
				$arq_data['vk'] = $counter;
			}

			if( empty( $counter ) && !empty( $arq_options['data']['vk'] ) ){ //Get the stored data
				$counter = $arq_options['data']['vk'];
			}
		}
		return $counter;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Tumblr Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_tumblr_count' ) ) :
	function arq_tumblr_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['tumblr']) ){
			$result = $arq_transient['tumblr'];
		}
		elseif( empty($arq_transient['tumblr']) && !empty($arq_data) && !empty( $arq_options['data']['tumblr'] )  ){
			$result = $arq_options['data']['tumblr'];
		}
		elseif( ! empty( $arq_data['tumblr'] ) ){
			$result = $arq_data['tumblr'];
		}
		else{
			$base_hostname = str_replace( array( 'http://','https://' ) , '', $arq_options['social']['tumblr']['hostname'] );

			try {
				$consumer_key		    = get_option( 'tumblr_api_key' );
				$consumer_secret    = get_option( 'tumblr_api_secret' );
				$oauth_token		    = get_option( 'tumblr_oauth_token' );
				$oauth_token_secret	= get_option( 'tumblr_token_secret' );
				$tumblr_api_URI		  = 'http://api.tumblr.com/v2/blog/'.$base_hostname.'/followers';

				$tum_oauth 	= new TumblrOAuthTie($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
				$tumblr_api = $tum_oauth->post($tumblr_api_URI, '');

				if( $tumblr_api->meta->status == 200 && !empty($tumblr_api->response->total_users) )
					$result = ! empty( $tumblr_api->response->total_users ) ? (int) $tumblr_api->response->total_users : 0;

			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['tumblr'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['tumblr'] ) ) //Get the stored data
				$result = $arq_options['data']['tumblr'];
		}

		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# 500px Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_500px_count' ) ) :
	function arq_500px_count() {

		global $arq_data, $arq_options, $arq_transient;

		$counter = 0;

		if( ! empty($arq_transient['500px']) ){
			$counter = $arq_transient['500px'];
		}
		elseif( empty($arq_transient['500px']) && !empty($arq_data) && !empty( $arq_options['data']['500px'] )  ){
			$counter = $arq_options['data']['500px'];
		}
		elseif( ! empty( $arq_data['500px'] ) ){
			$result = $arq_data['500px'];
		}
		else{

			$social_id   = $arq_options['social']['500px']['username'];
			$get_request = wp_remote_get( "https://500px.com/$social_id", array( 'timeout' => 20 ) );
			$the_request = wp_remote_retrieve_body( $get_request );

			$pattern = '/followers[^>]+>(.*?)<\/li/s';
			$counter = arq_get_the_number( $pattern, $the_request );

			if( ! empty( $counter ) ){ //To update the stored data
				$arq_data['500px'] = $counter;
			}

			if( empty( $result ) && ! empty( $arq_options['data']['500px'] ) ){ //Get the stored data
				$counter = $arq_options['data']['500px'];
			}
		}

		return $counter;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Pinterest Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_pinterest_count' ) ) :
	function arq_pinterest_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['pinterest']) ){
			$result = $arq_transient['pinterest'];
		}
		elseif( empty($arq_transient['pinterest']) && !empty($arq_data) && !empty( $arq_options['data']['pinterest'] )  ){
			$result = $arq_options['data']['pinterest'];
		}
		elseif( ! empty( $arq_data['pinterest'] ) ){
			$result = $arq_data['pinterest'];
		}
		else{
			$username = $arq_options['social']['pinterest']['username'];
			try {
				$html 	= arq_remote_get( "https://www.pinterest.com/$username/" , false);
				$doc    = new DOMDocument();
				@$doc->loadHTML($html);
				$metas 	= $doc->getElementsByTagName('meta');
				for ($i = 0; $i < $metas->length; $i++){
					$meta = $metas->item($i);
					if($meta->getAttribute('name') == 'pinterestapp:followers'){
						$result = $meta->getAttribute('content');
						break;
					}
				}
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['pinterest'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['pinterest'] ) ) //Get the stored data
				$result = $arq_options['data']['pinterest'];
		}

		return $result;
	}
endif;



/*-----------------------------------------------------------------------------------*/
# Flickr Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_flickr_count' ) ) :
	function arq_flickr_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['flickr']) ){
			$result = $arq_transient['flickr'];
		}
		elseif( empty($arq_transient['flickr']) && !empty($arq_data) && !empty( $arq_options['data']['flickr'] )  ){
			$result = $arq_options['data']['flickr'];
		}
		elseif( ! empty( $arq_data['flickr'] ) ){
			$result = $arq_data['flickr'];
		}
		else{
			$id 	= $arq_options['social']['flickr']['id'];
			$api 	= $arq_options['social']['flickr']['api'];
			try {
				$data 	= @arq_remote_get( "https://api.flickr.com/services/rest/?method=flickr.groups.getInfo&api_key=$api&group_id=$id&format=json&nojsoncallback=1");
				$result = ! empty( $data['group']['members']['_content'] ) ? (int) $data['group']['members']['_content'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['flickr'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['flickr'] ) ) //Get the stored data
				$result = $arq_options['data']['flickr'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Steam Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_steam_count' ) ) :
	function arq_steam_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['steam']) ){
			$result = $arq_transient['steam'];
		}
		elseif( empty($arq_transient['steam']) && !empty($arq_data) && !empty( $arq_options['data']['steam'] )  ){
			$result = $arq_options['data']['steam'];
		}
		elseif( ! empty( $arq_data['steam'] ) ){
			$result = $arq_data['steam'];
		}
		else{
			$id = $arq_options['social']['steam']['group'];
			try {
				$data 	= @arq_remote_get( "http://steamcommunity.com/groups/$id/memberslistxml?xml=1" , false );
				$data 	= @new SimpleXmlElement( $data );
				$result = (int) $data->groupDetails->memberCount;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['steam'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['steam'] ) ) //Get the stored data
				$result = $arq_options['data']['steam'];
		}
		return $result;
	}
endif;



/*-----------------------------------------------------------------------------------*/
# Rss Subscribers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_rss_count' ) ) :
	function arq_rss_count() {

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['rss']) ){
			$result = $arq_transient['rss'];
		}
		elseif( empty($arq_transient['rss']) && !empty($arq_data) && !empty( $arq_options['data']['rss'] )  ){
			$result = $arq_options['data']['rss'];
		}
		elseif( ! empty( $arq_data['rss'] ) ){
			$result = $arq_data['rss'];
		}
		else{
			if( ( $arq_options['social']['rss']['type'] == 'feedpress.it' ) && !empty($arq_options['social']['rss']['feedpress']) ){
				try {
					$feedpress_url 	= esc_url($arq_options['social']['rss']['feedpress']);
					$feedpress_url 	= str_replace( 'feedpress.it', 'feed.press', $feedpress_url);
					//$feedpress_url 	= str_replace( 'http', 'https', $feedpress_url);

					$data   = @arq_remote_get( $feedpress_url );
					$result = ! empty( $data[ 'subscribers' ] ) ? (int) $data[ 'subscribers' ] : 0;
				} catch (Exception $e) {
					$result = 0;
				}
			}
			elseif( ( $arq_options['social']['rss']['type'] == 'Manual' ) && !empty($arq_options['social']['rss']['manual']) ){
				$result = $arq_options['social']['rss']['manual'] ;
			}
			else{
				$result = 0;
			}
			if( !empty( $result ) ) //To update the stored data
				$arq_data['rss'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['rss'] ) ) //Get the stored data
				$result = $arq_options['data']['rss'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Spotify Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_spotify_count' ) ) :
	function arq_spotify_count(){

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['spotify']) ){
			$result = $arq_transient['spotify'];
		}
		elseif( empty($arq_transient['spotify']) && !empty($arq_data) && !empty( $arq_options['data']['spotify'] )  ){
			$result = $arq_options['data']['spotify'];
		}
		elseif( ! empty( $arq_data['spotify'] ) ){
			$result = $arq_data['spotify'];
		}
		else{
			$id = $url = $arq_options['social']['spotify']['id'];
			$id = rtrim( $id , "/");
			$id = urlencode( str_replace( array(  'https://play.spotify.com/', 'https://player.spotify.com/', 'artist/', 'user/' ) , '', $id) );

			try {
				if( !empty( $url ) && strpos( $url, 'artist') !== false ){
					$data = @arq_remote_get("https://api.spotify.com/v1/artists/$id");
				}else{
					$data = @arq_remote_get("https://api.spotify.com/v1/users/$id");
				}
				$result = ! empty( $data['followers']['total'] ) ? (int) $data['followers']['total'] : 0;

			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['spotify'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['spotify'] ) ) //Get the stored data
				$result = $arq_options['data']['spotify'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Goodreads Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_goodreads_count' ) ) :
	function arq_goodreads_count(){

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['goodreads']) ){
			$result = $arq_transient['goodreads'];
		}
		elseif( empty($arq_transient['goodreads']) && !empty($arq_data) && !empty( $arq_options['data']['goodreads'] )  ){
			$result = $arq_options['data']['goodreads'];
		}
		elseif( ! empty( $arq_data['goodreads'] ) ){
			$result = $arq_data['goodreads'];
		}
		else{
			$id  = $url = $arq_options['social']['goodreads']['id'];
			$key = $arq_options['social']['goodreads']['key'];

			$id = rtrim( $id , "/");
			$id = @parse_url($id);
			$id = $id['path'];
			$id = str_replace( array( '/user/show/', '/author/show/' ) , '', $id);
			if( strpos( $id, '-') !== false ){
				$id = explode( '-', $id);
			}else{
				$id = explode( '.', $id);
			}
			$id = $id[0];
			try {
				if( !empty( $url ) && strpos( $url, 'author') !== false ){
					$data 	= @arq_remote_get("https://www.goodreads.com/author/show/$id.xml?key=$key", false);
					$data 	= @new SimpleXmlElement( $data );
					$result = (int) $data->author->author_followers_count;
				}else{
					$data 	= @arq_remote_get("https://www.goodreads.com/user/show/$id.xml?key=$key", false);
					$data 	= @new SimpleXmlElement( $data );
					$result = ! empty( $data->user->friends_count ) ? (int) $data->user->friends_count : 0;
				}

			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['goodreads'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['goodreads'] ) ) //Get the stored data
				$result = $arq_options['data']['goodreads'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Twitch Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_twitch_count' ) ) :
	function arq_twitch_count(){

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['twitch']) ){
			$result = $arq_transient['twitch'];
		}
		elseif( empty($arq_transient['twitch']) && !empty($arq_data) && !empty( $arq_options['data']['twitch'] )  ){
			$result = $arq_options['data']['twitch'];
		}
		elseif( ! empty( $arq_data['twitch'] ) ){
			$result = $arq_data['twitch'];
		}
		else{

			$channel      = $arq_options['social']['twitch']['id'];
			$user_id      = get_option('twitch_id_'.$channel );

			$access_token  = get_option('twitch_access_token' );
			$refresh_token = get_option('twitch_refresh_token' );
			$client_id     = get_option('twitch_client_id' );
			$client_secret = get_option('twitch_client_secret' );

			// Refresh the Access Token
			$response = wp_remote_post( 'https://id.twitch.tv/oauth2/token', array(
				'body' => array(
					'grant_type'    => 'refresh_token',
					'refresh_token' => $refresh_token,
					'client_id'     => $client_id,
					'client_secret' => $client_secret,
				)
			));

			$response = wp_remote_retrieve_body( $response );

			if( ! empty( $response->access_token ) && ! empty( $response->refresh_token ) ){
				$access_token = $response->access_token;
				update_option( 'twitch_access_token',  $response->access_token );
				update_option( 'twitch_refresh_token', $response->refresh_token );
			}

			if( $access_token && $client_id ){

				$request_data = array(
					'timeout' => 10,
					'headers' => array(
						'Authorization' => sprintf( 'Bearer %s', $access_token ),
						'Client-ID'     => $client_id,
					),
				);

				if( ! $user_id ){

					$response = wp_remote_get( "https://api.twitch.tv/helix/users?login=$channel", $request_data );
					$response = wp_remote_retrieve_body( $response );
					$response = json_decode( $response, true );

					if( ! empty( $response['data'][0]['id'] ) ){
						$user_id = $response['data'][0]['id'];
						update_option('twitch_id_'.$channel, $user_id );
					}
				}

				if( $user_id ){
					$response = wp_remote_get( "https://api.twitch.tv/helix/users/follows?to_id=$user_id", $request_data );
					$response = wp_remote_retrieve_body( $response );
					$response = json_decode( $response, true );
					$result   = ! empty( $response['total'] ) ? $response['total'] : 0;
				}
			}

			if( ! empty( $result ) ) //To update the stored data
				$arq_data['twitch'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['twitch'] ) ) //Get the stored data
				$result = $arq_options['data']['twitch'];
		}

		return $result;

	}
endif;


/*-----------------------------------------------------------------------------------*/
# Mixcloud Followers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_mixcloud_count' ) ) :
	function arq_mixcloud_count(){

		global $arq_data, $arq_options, $arq_transient;

		$result = 0;

		if( !empty($arq_transient['mixcloud']) ){
			$result = $arq_transient['mixcloud'];
		}
		elseif( empty($arq_transient['mixcloud']) && !empty($arq_data) && !empty( $arq_options['data']['mixcloud'] )  ){
			$result = $arq_options['data']['mixcloud'];
		}
		elseif( ! empty( $arq_data['mixcloud'] ) ){
			$result = $arq_data['mixcloud'];
		}
		else{
			$id  = $arq_options['social']['mixcloud']['id'];
			try {
				$data 	= @arq_remote_get("http://api.mixcloud.com/$id/");
				$result = ! empty( $data['follower_count'] ) ? (int) $data['follower_count'] : 0;
			} catch (Exception $e) {
				$result = 0;
			}

			if( !empty( $result ) ) //To update the stored data
				$arq_data['mixcloud'] = $result;

			if( empty( $result ) && !empty( $arq_options['data']['mixcloud'] ) ) //Get the stored data
				$result = $arq_options['data']['mixcloud'];
		}
		return $result;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Posts Number
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_posts_count' ) ) :
	function arq_posts_count() {

		$count_posts   = wp_count_posts();
		return $result = $count_posts->publish;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Comments number
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_comments_count' ) ) :
	function arq_comments_count() {

		$comments_count = wp_count_comments();
		return $result  = $comments_count->approved;

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Members number
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_members_count' ) ) :
	function arq_members_count() {

		$members_count = count_users();
		return $result = $members_count['total_users'];

	}
endif;



/*-----------------------------------------------------------------------------------*/
# Groups number
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_groups_count' ) ) :
	function arq_groups_count() {

		if( function_exists( 'groups_get_total_group_count' ) ){
			return $result = groups_get_total_group_count();
		}

	}
endif;



/*-----------------------------------------------------------------------------------*/
# bbPress Counters
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_bbpress_count' ) ) :
	function arq_bbpress_count( $count ) {

		if( ! function_exists( 'bbp_get_statistics' ) ){
			return;
		}

		$arg = array (
			'count_users'           => false,
			'count_forums'          => false,
			'count_topics'          => false,
			'count_private_topics'  => false,
			'count_spammed_topics'  => false,
			'count_trashed_topics'  => false,
			'count_replies'         => false,
			'count_private_replies' => false,
			'count_spammed_replies' => false,
			'count_trashed_replies' => false,
			'count_tags'            => false,
			'count_empty_tags'      => false,
		);

		$arg[ 'count_' . $count ]	= true;

		$counters = bbp_get_statistics( $arg );
		if( $count == 'forums' ){
			$result = $counters[ 'forum_count' ];
		}
		elseif( $count == 'topics' ){
			$result = $counters[ 'topic_count' ];
		}
		elseif( $count == 'replies' ){
			$result = $counters[ 'reply_count' ];
		}

		return $result;

	}
endif;


/*-----------------------------------------------------------------------------------*/
# Get The Numbers
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'arq_get_the_number' ) ) :
	function arq_get_the_number( $pattern, $the_request ) {

		$counter = 0;

		preg_match( $pattern, $the_request, $matches );

		if ( is_array( $matches ) && ! empty( $matches[1] ) ) {

			$number  = strip_tags( $matches[1] );
			$counter = '';

			foreach ( str_split( $number ) as $char ) {
				if ( is_numeric( $char ) ){
					$counter .= $char;
				}
			}
		}

		return $counter;
	}
endif;
