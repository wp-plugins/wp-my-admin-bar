<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1.9
 */

/**
 * ==================================== Wp-MyAdminBar Uninstall Function
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * Removes wp_myadminbar & wp_mycache Options for Standalone Wp and Multisite WP
 */
function wp_myadminbar_uninstall() {
	global $wpdb;

/**
 * Multisites
 */
	if ( function_exists('is_multisite') && is_multisite() ) {
		//$site_list = $wpdb->get_results( $wpdb->prepare( 'SELECT blog_id FROM '. $wpdb->blogs .'  ORDER BY blog_id' ) );
		$site_list = $wpdb->get_results( 'SELECT blog_id FROM '. $wpdb->blogs .'  ORDER BY blog_id' );

			foreach ( $site_list as $site ) {
				switch_to_blog( $site->blog_id );
				delete_option( 'wp_myadminbar' );		/* My Menus */
				delete_option( 'wp_mycache' );			/* Cache Plugins */
				delete_option( 'wp_mycustom' );			/* Custom Settings */
				delete_option( 'wp_myadminbar_nw' );	/* My Menus Added in Version 0.1.7 */
				delete_option( 'wp_mycache_nw' );		/* Cache Plugins Added in Version 0.1.7 */
			}

			restore_current_blog();
		return;
	}

/**
 * This Site
 */
	delete_option( 'wp_myadminbar' );				/* My Menus */
	delete_option( 'wp_mycache' );					/* Cache Plugins */
	delete_option( 'wp_mycustom' );					/* Custom Settings */
	delete_option( 'wp_myadminbar_nw' );			/* My Menus Added in Version 0.1.7 */
	delete_option( 'wp_mycache_nw' );				/* Cache Plugins Added in Version 0.1.7 */
	delete_transient( 'multisite_site_list' );	/* Cache */
}

/**
 * Call Uninstall
 */
wp_myadminbar_uninstall();
?>