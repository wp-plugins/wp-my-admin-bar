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
 * ==================================== Wp-MyAdminBar Uninstall Function
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * Removes wp_myadminbar & wp_mycache Options for Standalone Wp and Multisite WP
 */
function wp_myadminbar_uninstall() {
	global $wpdb;
 
	if ( function_exists('is_multisite') && is_multisite() ) {
		if ( isset( $_GET['networkwide'] ) && ( $_GET['networkwide'] == 1 ) ) {
			$org_blog = $wpdb->blogid;
			$blogids = $wpdb->get_col( $wpdb->prepare( "SELECT blog_id FROM $wpdb->blogs" ) );
			foreach ( $blogids as $blog_id ) {
				switch_to_blog( $blog_id );
					delete_option( 'wp_myadminbar' );
					delete_option( 'wp_mycache' );
			}
			switch_to_blog( $org_blog );
			return;
		}
	}
	delete_option( 'wp_myadminbar' );
	delete_option( 'wp_mycache' );
	delete_transient( 'multisite_site_list' );
}

/**
 * Call uninstall
 */
wp_myadminbar_uninstall();
?>