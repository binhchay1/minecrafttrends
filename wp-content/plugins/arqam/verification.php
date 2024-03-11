<?php
/**
 * Theme Validation
 *
 */


defined( 'ABSPATH' ) || exit; // Exit if accessed directly


if( ! class_exists( 'ARQAM_VERIFICATION' ) ){

	class ARQAM_VERIFICATION {

		/**
		 * Runs on class initialization. Adds filters and actions.
		 */
		function __construct() {

			add_action( 'admin_notices',         array( $this, 'live_message' ), 105 );
			add_action( 'admin_enqueue_scripts', array( $this, 'load_notices' ), 5 );
		}


		/**
		 * Get the authorize url
		 */
		public static function api_url(){

			return add_query_arg(
				array(
					'envato_verify_purchase' => '',
					'redirect_url' => esc_url( add_query_arg( array( 'page' => 'arqam' ), admin_url( 'admin.php' ) )),
					'item'  => ARQAM_PLUGIN_ID,
					'theme' => get_stylesheet(),
					'blog'  => esc_url( home_url( '/' ) ),
				),
				'https://tielabs.com'
			);
		}

		/**
		 * Theme validation notices
		 */
		function load_notices(){

			// Disable the verification system
			if( apply_filters( 'Arqam/Verification/disable', false ) ){
				return;
			}

			if( isset( $_GET['tie-envato-authorize'] ) && ( isset( $_GET['item'] ) && $_GET['item'] == ARQAM_PLUGIN_ID ) ){

				if( isset($_GET['sucess']) && ! empty($_GET['token']) ){

					$theme_data = self::get_latest_plugin_data( '', $_GET['token'] );

					if( ! empty( $theme_data['status'] ) && $theme_data['status'] == 1 ){
						add_action( 'admin_notices', array( $this, 'success' ), 1 );
					}
					else{
						add_action( 'admin_notices', array( $this, 'error' ), 1 );
					}
				}
				elseif( isset($_GET['fail']) ){
					add_action( 'admin_notices', array( $this, 'error' ), 1 );
				}
			}

			elseif( get_option( 'tie_token_error_'.ARQAM_PLUGIN_ID ) ){
				add_action( 'admin_notices', array( $this, 'error' ), 1 );
			}

			elseif( ! get_option( 'tie_token_'.ARQAM_PLUGIN_ID ) ){
				add_action( 'admin_notices', array( $this, 'authorize_notice' ), 1 );
			}
		}

		/**
		 * Authorized Successfully
		 */
		function success(){

			self::message( array(
				'notice_id'   => 'theme_authorized',
				'title'       => esc_html__( 'Congratulations', 'arq' ),
				'message'     => esc_html__( 'Your Arqam License is now validated.', 'arq' ),
				'dismissible' => false,
				'class'       => 'success',
			));
		}


		/**
		 * Theme Not Authorized Yet
		 */
		public static function authorize_notice( $standard = true ){

			$notice_content = esc_html__( 'Your Arqam license is not validated. Click on the link below to unlock the settings page, auto update and access to premium support, please note, a separate license is required for each site using the plugin.', 'arq' );

			self::message( array(
				'notice_id'   => 'arqam_not_authorized',
				'message'     => $notice_content,
				'dismissible' => false,
				'class'       => 'warning',
				'standard'    => $standard,
				'button_text' => esc_html__( 'Verify Now!', 'arq' ),
				'button_url'  => self::api_url(),
				'button_class'=> 'green',
				'button_2_text'  => esc_html__( 'Buy a License', 'arq' ),
				'button_2_url'   => self::purchase_link(),
			));
		}


		/**
		 * Authorize Error
		 */
		function error(){

			$notice_content = '<p>'. esc_html__( 'Authorization Failed', 'arq' ) .'</p>';

			if( isset($_GET['error-description']) ){
				$notice_content .= '<p>'. $_GET['error-description'] .'</p>';
			}

			$error_description = self::get_latest_plugin_data( 'error' );

			if( ! empty( $error_description ) ){
				$notice_content .= '<p>'. $error_description .'</p>';
			}

			if( $error = get_option( 'tie_token_error_'.ARQAM_PLUGIN_ID ) ){
				$notice_content .= '<p>'. $error .'</p>';
			}

			self::message( array(
				'notice_id'     => 'theme_authorized_error',
				'title'         => esc_html__( 'ERROR', 'arq' ),
				'message'       => $notice_content,
				'dismissible'   => false,
				'class'         => 'error',
				'button_text'   => esc_html__( 'Try again', 'arq' ),
				'button_url'    => self::api_url(),
				'button_class'  => 'green',
				'button_2_text' => esc_html__( 'Buy a License', 'arq' ),
				'button_2_url'  => self::purchase_link(),
			));
		}


		/**
		 * The Message
		 */
		public static function message( $args = array() ){

			$defaults = array(
				'notice_id'      => '',
				'title'          => false,
				'img'            => false,
				'message'        => '',
				'dismissible'    => true,
				'color'          => '',
				'class'          => '',
				'standard'       => true,
				'button_text'    => '',
				'button_class'   => '',
				'button_url'     => '',
				'button_2_text'  => '',
				'button_2_class' => '',
				'button_2_url'   => '',
			);

			$args = wp_parse_args( $args, $defaults );


			if( ! empty( $args['color'] ) ){
				$args['color'] = 'background-color:'. $args['color'];
			}

			if( $args['class'] ){
				$args['class'] = 'arq-'. $args['class'];
			}

			if( $args['standard'] ){
				$args['class'] .= ' notice';
			}

			if( $args['dismissible'] ){
				$args['class'] .= ' is-dismissible';
			}

			if( ! empty( $args['button_class'] ) ){
				$args['button_class'] = 'arq-button-'. $args['button_class'];
			}

			if( ! empty( $args['button_2_class'] ) ){
				$args['button_2_class'] = 'arq-button-'. $args['button_2_class'];
			}

			?>

			<style>
							
			/* ---------------------------------------------
			Panel Messages
			------------------------------------------------ */
			.toplevel_page_arqam #arqam_not_authorized{
				margin-top: 100px !important;
			}

			.toplevel_page_arqam #arqam_not_authorized .arqam-notice-content p{
				font-size: 16px;
			}

			.toplevel_page_arqam #arqam_not_authorized .button-primary {
				font-size: 12pt;
				padding: 5px 40px;
			}

			.arqam-notice {
				padding: 0;
				position: relative;
				font-size: 14px;
				line-height: 26px;
				background: #ffffff;
				margin: 20px auto;
				max-width: 1000px;
				box-shadow: 0 3px 6px rgba(0, 0, 0, 0.075);
				border: 1px solid #ccd0d4;
				border-left-width: 4px;
			}

			.rtl .arqam-notice {
				border-left-width: 1px;
				border-right-width: 4px;
			}

			.arqam-notice .notice-dismiss {
				padding: 15px 10px;
			}

			.arqam-notice .notice-dismiss:before {
				float: right;
			}

			.arqam-notice .notice-dismiss .screen-reader-text {
				clip: auto;
				clip-path: unset;
				height: auto;
				width: auto;
				margin: 0;
				position: relative;
				font-size: 12px;
			}

			.arqam-notice.notice.is-dismissible {
				padding: 0;
			}

			.arqam-notice h3 {
				position: relative;
				margin: 0;
				padding: 15px 20px;
				border: none;
				line-height: 1.4em;
				font-size: 14px;
			}

			.arqam-notice h3 + .arqam-notice-content > p {
				margin-top: 0;
			}

			.arqam-notice-content {
				padding: 0 20px 15px;
				overflow: hidden;
			}

			.arqam-notice-content p:last-child {
				margin-bottom: 0;
			}

			.arqam-notice-img {
				float: left;
				max-width: 120px;
				padding-right: 15px;
			}

			.arqam-notice.arq-success {
				border-color: #65b70e !important;
			}

			.arqam-notice.arq-warning {
				border-color: #ff9e00 !important;
			}

			.arqam-notice.arq-error {
				border-color: #f44336 !important;
			}



			.wp-core-ui .arq-primary-button.button.arq-button-green {
				background: #65b70e !important;
				border-color: #569c0c !important;
				text-shadow: 0 -1px 1px #569c0c,1px 0 1px #569c0c,0 1px 1px #569c0c,-1px 0 1px #569c0c;
			}

			.wp-core-ui .arq-primary-button.button.arq-button-green:hover {
				opacity: 0.9;
			}


			.wp-core-ui .arq-primary-button.button.arq-button-orange {
				background: #ff9e00 !important;
				border-color: #ea9100 !important;
				text-shadow: 0 -1px 1px #ea9100,1px 0 1px #ea9100,0 1px 1px #ea9100,-1px 0 1px #ea9100;
			}

			.wp-core-ui .arq-primary-button.button.arq-button-orange:hover {
				opacity: 0.9;
			}

			.wp-core-ui .arq-primary-button.button.arq-button-red {
				background: #ff574a !important;
				border-color: #d63327 !important;
				text-shadow: 0 -1px 1px #d63327,1px 0 1px #d63327,0 1px 1px #d63327,-1px 0 1px #d63327;
			}

			.wp-core-ui .arq-primary-button.button.arq-button-red:hover {
				opacity: 0.9;
			}

			.wp-core-ui .arqyeem-notice .arq-primary-button.button {
				clear: both;
			}

			</style>
			<div id="<?php echo esc_attr( sanitize_key( $args['notice_id'] ) ) ?>" class="arqam-notice <?php echo esc_attr( $args['class'] ); ?>">

				<?php if( $args['title'] ){ ?>
					<h3 style="<?php echo esc_attr( $args['color'] ); ?>"><?php echo wp_kses_post( $args['title'] ) ?></h3>
				<?php } ?>

				<div class="arqam-notice-content">

					<?php
					if( ! empty( $args['img'] ) ){ ?>
						<img src="<?php echo esc_attr( $args['img'] ); ?>" class="arqam-notice-img" alt="">
						<?php
					}
					?>

					<?php

						if( strpos( $args['message'], '<p>' ) === false ){
							$args['message'] = '<p>'. $args['message'] .'</p>';
						}

						echo wp_kses_post( $args['message'] );

					?>

					<?php
					if( ! empty( $args['button_text'] ) ){ ?>
						<a class="arq-primary-button button button-primary <?php echo esc_attr( $args['button_class'] ) ?>" href="<?php echo esc_url( $args['button_url'] ) ?>"><?php echo esc_html( $args['button_text'] ) ?></a>
						<?php
					}
					?>

					<?php
					if( ! empty( $args['button_2_text'] ) ){ ?>
						<a class="arq-primary-button button button-primary <?php echo esc_attr( $args['button_2_class'] ) ?>" href="<?php echo esc_url( $args['button_2_url'] ) ?>"><?php echo esc_html( $args['button_2_text'] ) ?></a>
						<?php
					}
					?>

				</div>
			</div>

			<?php
		}

		/**
		 * Get theme purchase link
		 */
		public static function purchase_link( $utm_data = array() ){

			// Let's track the source of purchase
			return add_query_arg(
				wp_parse_args( $utm_data, array(
				'utm_source'   => 'plugin-panel',
				'utm_medium'   => 'link',
				'utm_campaign' => ARQAM_Plugin,
				'utm_content'  => false
				)),
				'https://tielabs.com/buy/arqam'
			);
		}


		/**
		 * Live Message
		 */
		function live_message(){

			// Disable the verification system
			if( apply_filters( 'Arqam/Verification/disable', false ) ){
				return;
			}

			$data = self::get_latest_plugin_data( 'message' );

			if( ! $data ){
				$data = self::get_custom_plugin_data( 'message' );
			}

			if( ! empty( $data ) && is_array( $data ) && ! empty( $data['notice_id'] ) && ! self::is_dismissed( $data['notice_id'] ) ){

				$today = strtotime( date('Y-m-d') );

				// Start date
				if( ! empty( $data['start_date'] )){
					$start_date = strtotime( $data['start_date'] );

					if( $start_date > $today ){
						return false;
					}
				}

				// Expire date
				if( ! empty( $data['expire_date'] )){
					$expire_date = strtotime( $data['expire_date'] );

					if( $expire_date <= $today ){
						return false;
					}
				}

				self::message( $data );
			}
		}


		/**
		 *
		 */
		public static function get_latest_plugin_data( $key = '', $token = false, $force_update = false, $update_files = false, $revoke = false ){

			
			// Check the current user role
			if( ! function_exists( 'current_user_can' ) || ( function_exists( 'current_user_can' ) && ! current_user_can( 'manage_options' ) ) ){
				return false;
			}

			$cache_key        = 'tie-data-'.ARQAM_PLUGIN_ID;
			$plugins_field    = 'tie-plugins-data-'.ARQAM_PLUGIN_ID;
			$token_key        = 'tie_token_'.ARQAM_PLUGIN_ID;
			$token_error_key  = 'tie_token_error_'.ARQAM_PLUGIN_ID;
			$server_error_key = 'tie_server_error_'.ARQAM_PLUGIN_ID;
			$request_url      = 'https://tielabs.com/wp-json/api/v1/get';


			// debug
			//$update = true;
			//delete_transient( $server_error_key );
			//delete_option( $token_error_key );
			//delete_option( $token_key );
			//delete_option( $cache_key );

			// Stored Cache
			$cached_data = get_option( $cache_key );

			// Use the given $token and force update the TieLabs data from Envato
			if( $token !== false ){
				$update       = true;
				$force_update = true;
				delete_option( $token_error_key );
			}

			// Revoke the theme
			elseif( $revoke !== false || $force_update !== false ){

				$token = get_option( $token_key );

				// --
				$update = true;
				delete_option( $token_error_key );
				delete_transient( $server_error_key );
			}

			// Get data by the stored token
			else{

				// No cached data
				if( empty( $cached_data ) ){
					$update = true;
				}

				// Check if cache is expired
				else{
					$timeout = get_option( $cache_key.'_timeout' );

					 if ( false === $timeout || ( false !== $timeout && $timeout < time() ) ) {
						$update = true;
					}
				}

				// API Token
				$token = get_option( $token_key );
			}

			// debug
			//$update = true;
			//delete_transient( $server_error_key );
			//delete_option( $token_error_key );
			//delete_option( $token_key );
			//delete_option( $cache_key );

			// We need to update the data, Get the Cached data
			if( isset( $update ) && ! empty( $token ) && ! get_option( $token_error_key ) && ! get_transient( $server_error_key ) ){

				$body = array(
					'tie_token'     => $token,
					'item_id'       => ARQAM_PLUGIN_ID,
					'force_update'  => $force_update,
					'revoke_theme'  => $revoke,
					'blog_url'      => esc_url( home_url( '/' ) ),
					'php_version'   => phpversion(),
					'wp_version'    => get_bloginfo( 'version' ),
					'local'         => get_locale(),
					'theme_version' => ARQAM_Plugin_ver,
					'theme'         => get_stylesheet(),
				);

				// Prepare the remote post
				$response = wp_remote_post( $request_url, array(
					'headers' => array(
						'User-Agent' => 'wp/' . get_bloginfo( 'version' ) . ' ; ' . get_bloginfo( 'url' ) . ' ; ' . ARQAM_PLUGIN_ID . ' ; ' . ARQAM_Plugin_ver . ' ; '. md5( $token ). ' ; '. $key,
					),
					'body' => apply_filters( 'Arqam/api_connect_body', $body ),
					//'sslverify' => false,
					'timeout'   => 15,
				));

				// Check Response for errors
				$response_code    = wp_remote_retrieve_response_code( $response );
				$response_message = wp_remote_retrieve_response_message( $response );

				if ( is_wp_error( $response ) ){
					$is_error = true;
					$response_message = $response->get_error_message();
				}
				elseif ( ! empty( $response->errors ) && isset( $response->errors['http_request_failed'] ) ) {
					$is_error = true;
					$response_message = esc_html( current( $response->errors['http_request_failed'] ) );
				}
				elseif ( 200 !== $response_code ){
					$is_error = true;

					if( empty( $response_message ) ) {
						$response_message = 'Connection Error';
					}
				}

				// Check if it is a valid response
				if ( isset( $is_error ) ){
					set_transient( $server_error_key, $response_message, 12 * HOUR_IN_SECONDS );
				}
				else{

					$cached_data = wp_remote_retrieve_body( $response );
					$cached_data = json_decode( $cached_data, true );

					//echo '<pre>';
					//var_dump( $cached_data );
					//echo '</pre>';

					if( ! empty( $cached_data['status'] ) && $cached_data['status'] == 1 ){

						// Delete Stored Errors
						delete_option( $token_error_key );

						// Update Cached data
						$expiration = 24 * HOUR_IN_SECONDS;
						update_option( $cache_key .'_timeout', time() + $expiration );
						update_option( $cache_key, $cached_data, false );
						update_option( $token_key, $token, false );

						// Use this action to run functions after updating the theme data
					  do_action( 'Arqam/after_data_update' );
					}
					else{

						if( isset( $cached_data['status'] ) && $cached_data['status'] == 0 ){
							update_option( $token_error_key, $cached_data['error'], false );

							delete_option( $token_key );
							delete_option( $cache_key );
						}
					}
				}

			}

			// Return the data
			if( empty( $cached_data ) ){
				return false;
			}

			if( ! empty( $key ) ){
				if( ! empty( $cached_data[ $key ] ) ){
					return $cached_data[ $key ];
				}

				return false;
			}

			return $cached_data;
		}


		/**
		 * Check Dismissed Notices
		 */
		public static function is_dismissed( $name ){

			$dismissed_notices = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ));

			if( in_array( sanitize_key( $name ), $dismissed_notices ) ){
				return true;
			}

			return false;
		}


		/**
		 * Get Custom Live Message
		 */
		public static function get_custom_plugin_data( $key ){

			$cache_field = 'tie-data-custom-'.ARQAM_PLUGIN_ID;

			if( $cached_data = get_transient( $cache_field ) ){

			}
			else{

				$response = wp_remote_post( 'https://tielabs.net/json/'. ARQAM_PLUGIN_ID .'.php' , array(
					'headers' => array(
						'User-Agent' => 'wp/' . get_bloginfo( 'version' ) . ' ; ' . get_bloginfo( 'url' ) . ' ; ' . ARQAM_PLUGIN_ID . ' ; ' . ARQAM_Plugin_ver,
					),
					'sslverify' => false,
					'timeout'   => 10,
				));


				// Check Response for errors
				$response_code    = wp_remote_retrieve_response_code( $response );
				$response_message = wp_remote_retrieve_response_message( $response );

				if ( is_wp_error( $response ) ){
					$is_error = true;
					$response_message = $response->get_error_message();
				}
				elseif ( ! empty( $response->errors ) && isset( $response->errors['http_request_failed'] ) ) {
					$is_error = true;
					$response_message = esc_html( current( $response->errors['http_request_failed'] ) );
				}
				elseif ( 200 !== $response_code ){
					$is_error = true;

					if( empty( $response_message ) ) {
						$response_message = 'Connection Error';
					}
				}

				// Check if it is a valid response
				if ( isset( $is_error ) ){
					set_transient( $cache_field, $response_message, 24 * HOUR_IN_SECONDS );
				}
				else{
					$cached_data = wp_remote_retrieve_body( $response );
					$cached_data = json_decode( $cached_data, true );
					set_transient( $cache_field, $cached_data, 24 * HOUR_IN_SECONDS );
				}
			
			}

			if( empty( $cached_data ) || ! is_array( $cached_data ) ){
				return false;
			}

			if( ! empty( $key ) ){
				if( ! empty( $cached_data[ $key ] ) ){
					return $cached_data[ $key ];
				}

				return false;
			}

			return $cached_data;
		}


	}

	// Single instance.
	$ARQAM_VERIFICATION = new ARQAM_VERIFICATION();
}
