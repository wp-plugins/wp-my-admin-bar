<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1.4
 */



/**
 * ==================================== Updates Option Names Without Removing Option Settings
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

class UpgradeMyAdminBar {

	function __construct() {
		$this->get_site_data(); 	/* Start the magic */
	}

/**
 * Gets Blogs
 */
	function get_site_data() {
		global $wpdb;
 
		if ( function_exists('is_multisite') && is_multisite() ) {
			if ( isset( $_GET['networkwide'] ) && ( $_GET['networkwide'] == 1 ) ) {
				$org_blog_id = $wpdb->blogid;
				$network_blog_id = $wpdb->get_col( $wpdb->prepare( "SELECT blog_id FROM $wpdb->blogs" ) );

				foreach ( $network_blog_id as $current_blog_id ) {
					switch_to_blog( $current_blog_id );
					$this->wp_myadminbar_upgrade();
				}

				switch_to_blog( $org_blog_id );
				return;
			}	
		} 
		$this->wp_myadminbar_upgrade();
	} /* end get_site_data() */

/**
 * Updates The Option
 */
	function wp_myadminbar_upgrade() {
		$wp_myadminbar_option = get_option( 'wp_myadminbar' );
		$wp_mycache_option = get_option( 'wp_mycache' );

		/* Updates Option: wp_myadminbar */
		if ( $wp_myadminbar_option ) {
			$wp_myadminbar_option = unserialize( get_option('wp_myadminbar') );

			$new_options_array = array(
				'my_sites' => $wp_myadminbar_option['show_my_sites'],
				'my_cache' => $wp_myadminbar_option['show_my_cache'],
				'my_tools' => $wp_myadminbar_option['show_my_tools']
			);
	
			delete_option( 'wp_myadminbar' );

			add_option( "wp_myadminbar", serialize( $new_options_array ), 'no' );
		} /* end if */


		/* Updates Option: wp_mycache */
		if ( $wp_mycache_option ) {
			$wp_mycache_option = unserialize( get_option('wp_mycache') );

			if ( $wp_mycache_option['toggle_dbcache'] || $wp_mycache_option['toggle_widget'] || $wp_mycache_option['toggle_minify'] || $wp_mycache_option['toggle_super'] || $wp_mycache_option['toggle_total'] ) {
				$new_options_array = array(
					'dbcache' => $wp_mycache_option['toggle_dbcache'],
					'widget' => $wp_mycache_option['toggle_widget'],
					'minify' => $wp_mycache_option['toggle_minify'],
					'super' => $wp_mycache_option['toggle_super'],
					'total' => $wp_mycache_option['toggle_total']
				);
	
				delete_option( 'wp_mycache' );

				add_option( "wp_mycache", serialize( $new_options_array ), 'no' );
			} /* end if */
		} /* end if */
	} /* end wp_myadminbar_upgrade() */
} /* end class upgradeAdminBar */
?>