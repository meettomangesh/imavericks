<?php
/**
 * Plugin Name: WP Logo Showcase Responsive Slider
 * Plugin URI: http://www.wponlinesupport.com/
 * Description: Easy to add and display Logo Showcase Responsive Slider on your website. 
 * Author: WP Online Support 
 * Text Domain: wp-logo-showcase-responsive-slider-slider
 * Domain Path: /languages/
 * Version: 1.4.1
 * Author URI: http://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author SP Technolab
 */

if( !defined( 'WPLS_VERSION' ) ) {
    define( 'WPLS_VERSION', '1.4.1' ); // Version of plugin
}
if( !defined( 'WPLS_DIR' ) ) {
    define( 'WPLS_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPLS_URL' ) ) {
    define( 'WPLS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPLS_POST_TYPE' ) ) {
    define( 'WPLS_POST_TYPE', 'logoshowcase' ); // Plugin Post Type
}
if( !defined( 'WPLS_CAT_TYPE' ) ) {
    define( 'WPLS_CAT_TYPE', 'wplss_logo_showcase_cat' ); // Plugin Post Type
}
if( !defined( 'WPLS_META_PREFIX' ) ) {
    define( 'WPLS_META_PREFIX', '_wpls_' ); // Plugin metabox prefix
}

/* Plugin Analytics Data Starts */
function wlsrss_fs() {
    global $wlsrss_fs;

    if ( ! isset( $wlsrss_fs ) ) {
        // Include Freemius SDK.
        require_once dirname(__FILE__) . '/freemius/start.php';

        $wlsrss_fs = fs_dynamic_init( array(
            'id'                  => '1785',
            'slug'                => 'wp-logo-showcase-responsive-slider-slider',
            'type'                => 'plugin',
            'public_key'          => 'pk_a18949e1fe4f94ce19c6819068ca9',
            'is_premium'          => false,
            'has_addons'          => false,
            'has_paid_plans'      => false,
            'menu'                => array(
                'slug'           => 'edit.php?post_type=logoshowcase',
                'account'        => false,
                'contact'        => false,
                'support'        => false,
            ),
        ) );
    }

    return $wlsrss_fs;
}

// Init Freemius.
wlsrss_fs();

// Signal that SDK was initiated.
do_action( 'wlsrss_fs_loaded' );

/* Plugin Analytics Data Ends */

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpls_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpls_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_install() {

	// Register post type function
	wplss_logo_showcase_post_types();
	wplss_logo_showcase_taxonomies();

	// IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Deactivate free version
    if( is_plugin_active('wp-logo-showcase-responsive-slider-pro/logo-showcase.php') ){
        add_action('update_option_active_plugins', 'wpls_deactivate_free_version');
    }
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_uninstall() {
	
	// IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.4
 */
function wpls_deactivate_free_version() {
    deactivate_plugins('wp-logo-showcase-responsive-slider-pro/logo-showcase.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.2.4
 */
function wpls_admin_notice() {
    
    $dir = ABSPATH . 'wp-content/plugins/wp-logo-showcase-responsive-slider-pro/logo-showcase.php';
    
    // If Free plugin is active and PRO plugin exist
    if( is_plugin_active( 'wp-logo-showcase-responsive-slider-slider/logo-showcase.php' ) && file_exists($dir)) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating WP Logo Showcase Responsive Slider</strong>.<br /> It looks like you had PRO version <strong>(<em>WP Logo Showcase Responsive Slider Pro</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wpls_admin_notice');

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Logo Showcase Responsive Slider
 * @since 1.0.0
 */
function wpls_load_textdomain() {
	load_plugin_textdomain( 'wp-logo-showcase-responsive-slider-slider', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'wpls_load_textdomain');

// Script file
require_once( WPLS_DIR . '/includes/class-wpls-script.php' );

//functions file
require_once( WPLS_DIR . '/includes/wpls-functions.php' );

//post types file
require_once( WPLS_DIR . '/includes/wpls-post-types.php' );

//post metabox file
require_once( WPLS_DIR . '/includes/admin/metabox/wpls-post-setting-metabox.php' );

//post metabox file
require_once( WPLS_DIR . '/includes/shortcode/wpls-logo-slider.php' );

//Admin file for pro vs free
require_once( WPLS_DIR . '/includes/admin/class-wpls-admin.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( WPLS_DIR . '/includes/admin/wpls-how-it-work.php' );	
}