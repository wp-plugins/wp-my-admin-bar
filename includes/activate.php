<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1
 */



/**
 * ==================================== Activate & Deactivate the WP-MyAdminBar Plugin
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * Plugin Activation Hook
 */
	register_activation_hook( MYAB_PLUGIN_DIR . '/my_admin_bar.php', 'wordpress_version' );


/**
 * Checks Wordpress Version
 */
function wordpress_version() {
	global $wp_version;
 
	if ( version_compare( $wp_version, "3.3", "<" ) ) {
		wp_myadminbar_deactivate();
		wp_die( __('The Wp-MyAdminBar Plugin requires WordPress 3.3 or higher. Please Upgrade Wordpress, then try activating this plugin again. Press the browser back button to return to the previous page.', 'wp-my-admin-bar') );
	}
	
	wp_myadminbar_activate();
}


/**
 * Plugin Activation for both Standalone WP and Multisite WP
 */
function wp_myadminbar_activate() {

	global $wpdb;
 
	if ( function_exists('is_multisite') && is_multisite() ) {
		if ( isset( $_GET['networkwide'] ) && ( $_GET['networkwide'] == 1 ) ) {
	        $org_blog = $wpdb->blogid;
			$blogId = $wpdb->get_col( $wpdb->prepare( "SELECT blog_id FROM $wpdb->blogs" ) );

			foreach ( $blogId as $blog_id ) {
				switch_to_blog( $blog_id );
					wp_myadminbar_install();
			}

			switch_to_blog( $org_blog );
			return;
		}	
	} 
	wp_myadminbar_install();
}


/**
 * Add Option wp_myadminbar with default settings
 */
function wp_myadminbar_install() {

	$options_array = array(
		'show_my_sites' => 'show',
		'show_my_cache' => 'hide',
		'show_my_tools' => 'show'
	);

	add_option( "wp_myadminbar", serialize( $options_array ), 'no' );
}


/**
 * Plugin Deactivation Hook
 */
register_deactivation_hook( MYAB_PLUGIN_DIR . '/my_admin_bar.php', 'wp_myadminbar_deactivate' );

/**
 * Plugin Deactivation for both Standalone WP and Multisite WP
 */
function wp_myadminbar_deactivate() {
	global $wpdb;
 
	if ( function_exists('is_multisite') && is_multisite() ) {
		if ( isset( $_GET['networkwide'] ) && ( $_GET['networkwide'] == 1 ) ) {
			$org_blog = $wpdb->blogid;
			$blogids = $wpdb->get_col( $wpdb->prepare( "SELECT blog_id FROM $wpdb->blogs" ) );
			foreach ( $blogids as $blog_id ) {
				switch_to_blog( $blog_id );
					wp_myadminbar_uninstall();
			}

			switch_to_blog( $org_blog );
			return;
		}
	}
	wp_myadminbar_uninstall();
}

/**
 * Remove the Options
 */
function wp_myadminbar_uninstall() {
	delete_option( 'wp_myadminbar' );
	delete_option( 'wp_mycache' );
	delete_transient( 'multisite_site_list' );
}



/**
 * Extra Links
 */
function extra_nework_links( $links, $file ) {
	$plugin = MYAB_PLUGIN_BASENAME;
	if ( $file == $plugin ) {
		if ( strlen( strstr( $_SERVER['REQUEST_URI'], 'network') ) > 0 ) {
			$links[] = '<a href="settings.php?page=my_admin_bar.php">'. __('Settings', 'wp-my-admin-bar') .'</a>';
		}else{
			$links[] = '<a href="options-general.php?page=my_admin_bar.php">'. __('Settings', 'wp-my-admin-bar') .'</a>';
		}
			$links[] = '<a href="http://technerdia.com/projects/adminbar/faq.html">'. __('F.A.Q.', 'wp-my-admin-bar') .'</a>';
			$links[] = '<a href="http://technerdia.com/projects/adminbar/plugin.html">'. __('Support', 'wp-my-admin-bar') .'</a>';
			$links[] = '<a href="http://technerdia.com/feedback.html">'. __('Feedback', 'wp-my-admin-bar') .'</a>';
			$links[] = '<a href="http://technerdia.com/projects/contribute.html">'. __('Donations', 'wp-my-admin-bar') .'</a>';
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'extra_nework_links', 10, 2 );
?>