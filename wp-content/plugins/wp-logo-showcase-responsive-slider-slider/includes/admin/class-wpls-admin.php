<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpls_Admin {

	function __construct() {		
		
		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'wpls_register_menu'), 12 );

		
	}

	
	/**
	 * Function to add menu
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_register_menu() {

		// Register plugin premium page
		add_submenu_page( 'edit.php?post_type='.WPLS_POST_TYPE, __('Upgrade to PRO - Logo Showcase Responsive Slider', 'wp-logo-showcase-responsive-slider-slider'), '<span style="color:#2ECC71">'.__('Upgrade to PRO', 'wp-logo-showcase-responsive-slider-slider').'</span>', 'manage_options', 'wpls-premium', array($this, 'wpls_premium_page') );
	}

	/**
	 * Getting Started Page Html
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_premium_page() {
		include_once( WPLS_DIR . '/includes/admin/settings/premium.php' );
	}
	
	
}

$wpls_Admin = new Wpls_Admin();