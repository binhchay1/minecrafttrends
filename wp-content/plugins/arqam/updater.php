<?php
/**
 * Theme Notifier and Auto Update
 *
 */


defined( 'ABSPATH' ) || exit; // Exit if accessed directly



if( ! class_exists( 'ARQAM_UPDATER' ) ){


	class ARQAM_UPDATER {

		/**
		 * Holds the remote theme version.
		 * @var string
		 */
		private $remote_theme_version = '';

		/**
		 * __construct
		 *
		 * Class constructor where we will call our filter and action hooks.
		 */
		function __construct( ) {

			//set_site_transient( 'update_plugins', null );
			//var_dump( ARQAM_VERIFICATION::get_latest_plugin_data() );

			$this->remote_theme_version = ARQAM_VERIFICATION::get_latest_plugin_data( 'version' );

			if( empty( ARQAM_Plugin_ver ) || version_compare( $this->remote_theme_version, ARQAM_Plugin_ver, '<=' ) ){
				return;
			}

			// Filters
			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_for_update' ) );

			// Actions
			add_action( 'admin_menu', array( $this, 'update_notifier_menu' ), 11 );
			add_action( 'Arqam/after_data_update', array( $this, 'update_cached_data' ) );
		}


		/**
		 * check_for_update
		 *
		 * Check if update is available.
		 * @param object $transient
		 */
		function check_for_update( $transient ){

			$download_url = ARQAM_VERIFICATION::get_latest_plugin_data( 'download_url' );

			if ( empty( $transient->checked ) || ! $download_url ){
				return $transient;
			}

			$plugin_path = 'arqam/arqam.php';

			if( ! empty( $transient->response[ $plugin_path ]->id ) && $transient->response[ $plugin_path ]->id == 'w.org/plugins/arqam' ){
				return $transient;
			}

			$data = new stdClass;
			$data->new_version = $this->remote_theme_version;
			$data->slug    = 'arqam';
			$data->plugin  = $plugin_path;
			$data->package = $download_url;
			$data->tested  = get_bloginfo( 'version' );
			$data->icons   = array(
				'2x' => 'https://plugins.tielabs.com/images/arqam-icon.png',
				'1x' => 'https://plugins.tielabs.com/images/arqam-icon.png',
			);

			$data->banners = array(
				'2x' => 'https://plugins.tielabs.com/images/arqam-preview.png',
				'1x' => 'https://plugins.tielabs.com/images/arqam-preview.png',
			);

			if( ! empty( $data ) ){
				$transient->response[ $plugin_path ] = $data;
			}

			return $transient;
		}


		/**
		 * update_cached_data
		 *
		 * Update the theme's update URL after updating the theme data via the API
		 */
		function update_cached_data(){
			set_site_transient( 'update_plugins', null );
		}


		/**
		 * update_notifier_menu
		 *
		 * Set custom menu for the updates
		 */
		function update_notifier_menu(){

			add_submenu_page(
				'arqam',
				esc_html__( 'New Update', 'taq' ),
				esc_html__( 'New Update', 'taq' ) . ' <span class="update-plugins"><span class="update-count">'. $this->remote_theme_version .'</span></span>',
				'administrator',
				'arqam-update-notifier',
				array( $this, 'redirect_to_update_notifier' )
			);
		}


		/**
		 * redirect_to_update_notifier
		 *
		 */
		function redirect_to_update_notifier(){
			$updater_tab = admin_url( 'update-core.php' );
			echo "<script>document.location.href='$updater_tab';</script>";
		}


	}


	add_action( 'init', 'tie_update_arqam' );
	function tie_update_arqam() {

		if( apply_filters( 'Arqam/Updater/disable', false ) ){
			return;
		}

		new ARQAM_UPDATER();
	}

}
