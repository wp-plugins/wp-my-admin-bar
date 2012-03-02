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
 * ==================================== Settings Page for Multisite Network Admin
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

class MyAdminBar_Network_Admin {
	private $checked;
/**
 * Network Settings Page
 */
	function my_siteadmin_submenu() {
		add_submenu_page( 'settings.php', 'Admin Bar', 'Admin Bar', 9, 'my_admin_bar.php', array( &$this, 'wp_mynetworkadmin' ) ); 	/* calls core function wp_mynetworkadmin() */
	}

/**
 * Set Defaults
 */
	function __construct() {
		add_action( 'network_admin_menu', array( &$this, 'my_siteadmin_submenu' ) ); 											/* calls submenu  my_siteadmin_submenu() */
	} /* end function __construct() */


/**
 * Core Function: Update Options on Post and Build Network Template
 */
	function wp_mynetworkadmin() { /* called from wp_myadminbar_submenu() */
/**
 * Build wp_myadminbar Option based on posted information
 */
		if ( $_POST['myadminbarsave'] ) {
			if ( $_POST['show_my_sites'] == "show" || $_POST['show_my_sites'] == "hide" ) { $showmysites = $_POST['show_my_sites']; }
			if ( $_POST['show_my_cache'] == "show" || $_POST['show_my_cache'] == "hide" ) { $showmycache = $_POST['show_my_cache']; }
			if ( $_POST['show_my_tools'] == "show" || $_POST['show_my_tools'] == "hide" ) { $showmytools = $_POST['show_my_tools']; }
	
			$options_array = array(
				'show_my_sites' => $showmysites,
				'show_my_cache' => $showmycache,
				'show_my_tools' => $showmytools
			);

			if ( get_option('wp_myadminbar') ) { /* Keep It Clean */
				delete_option( 'wp_myadminbar' );
			}

			$this->wp_myadminbar_blogs( $the_option = 'wp_myadminbar', $options_array ); /* Rebuild Option */
		}

/**
 * Build wp_mycache Option based on posted information
 */
		if ( $_POST['mycachesave'] ) {
			if ( $_POST['toggle_dbcache'] == "show" || $_POST['toggle_dbcache'] == "hide" ) { $toggledbcache = $_POST['toggle_dbcache']; }
			if ( $_POST['toggle_widget'] == "show" || $_POST['toggle_widget'] == "hide" ) { $togglewidget = $_POST['toggle_widget']; }
			if ( $_POST['toggle_minify'] == "show" || $_POST['toggle_minify'] == "hide" ) { $toggleminify = $_POST['toggle_minify']; }
			if ( $_POST['toggle_super'] == "show" || $_POST['toggle_super'] == "hide" ) { $togglesuper = $_POST['toggle_super']; }
			if ( $_POST['toggle_total'] == "show" || $_POST['toggle_total'] == "hide" ) { $toggletotal = $_POST['toggle_total']; }
	
			$options_array = array(
				'toggle_dbcache' => $toggledbcache,
				'toggle_widget' => $togglewidget,
				'toggle_minify' => $toggleminify,
				'toggle_super' => $togglesuper,
				'toggle_total' => $toggletotal
			);

			if ( get_option( 'wp_mycache' ) ) { /* Keep It Clean */
				delete_option( 'wp_mycache' );
			}

			$this->wp_myadminbar_blogs( $the_option = 'wp_mycache', $options_array ); /* Rebuild Option */
		}

		$this->show_template();
	} /* end wp_mynetworkadmin() */


/**
 * Run setting changes through each Website within the Network.
 */
	function wp_myadminbar_blogs( $the_option, $options_array ){
			global $wpdb;
		
			$network_site_list = $wpdb->get_results( $wpdb->prepare('SELECT blog_id FROM wp_blogs ORDER BY blog_id') );
			set_site_transient( 'multisite_site_list', $network_site_list, 86400 );

			foreach ( $network_site_list as $network_site ) {
				switch_to_blog( $network_site->blog_id );

					if ( get_option( $the_option ) ) {
						delete_option( $the_option );
					}

				add_option( $the_option, serialize( $options_array ), 'no' );
			}

			restore_current_blog();
				print '<div id="message" class="updated fade"><p><strong>'. __('Network Wide Settings Saved. If the admin bar did not visually change, you may need to', 'wp-my-admin-bar') .' <a href="http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'">'. __('refresh this page', 'wp-my-admin-bar') .'</a>.</strong></p></div>';
		return;
	} /* end wp_myadminbar_blogs() */


/**
 * Network Settings Page Template
 */
	function show_template() {
/**
 * Checked Items for Menu Options
 */
	$checked = 'checked="checked"';

		$ntwrkselect = unserialize( get_option('wp_myadminbar') );
			if ( $ntwrkselect['show_my_sites'] == "show" ) { $sites_on = $checked; }else{ $sites_off = $checked; }
			if ( $ntwrkselect['show_my_cache'] == "show" ) { $cache_on = $checked; }else{ $cache_off = $checked; }
			if ( $ntwrkselect['show_my_tools'] == "show" ) { $tools_on = $checked; }else{ $tools_off = $checked; }

		$ntwrkselect = get_option('wp_myadminbar');
			if ( !$ntwrkselect ) {
				$ntwrkselect = __('The WP-MyAdminBar Option Value is Blank.', 'wp-my-admin-bar');
					$sites_off = $checked;
					$cache_off = $checked;
					$tools_off = $checked;
			}

/**
 * Checked Items for Cache Plugins
 */
		$ntwrkcache = unserialize( get_option('wp_mycache') );
			if ( $ntwrkcache['toggle_dbcache'] == "show" ) { $dbcache_on = $checked; }else{ $dbcache_off = $checked; }
			if ( $ntwrkcache['toggle_widget'] == "show" ) { $widget_on = $checked; }else{ $widget_off = $checked; }
			if ( $ntwrkcache['toggle_minify'] == "show" ) { $minify_on = $checked; }else{ $minify_off = $checked; }
			if ( $ntwrkcache['toggle_super'] == "show" ) { $super_on = $checked; }else{ $super_off = $checked; }
			if ( $ntwrkcache['toggle_total'] == "show" ) { $total_on = $checked; }else{ $total_off = $checked; }

		$ntwrkcache = get_option( 'wp_mycache' );
		if ( !$ntwrkcache ) {
			$ntwrkcache = __('The My Cache Menu Option Value is Blank.', 'wp-my-admin-bar');
				$dbcache_off = $checked;
				$widget_off = $checked;
				$minify_off = $checked;
				$super_off = $checked;
				$total_off = $checked;
		}

/**
 * The Template
 */
		if ( substr_count( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) ) { ob_start("ob_gzhandler"); }else{ ob_start(); }
			include MYAB_TEMPLATES . '/settings_network.php';
		ob_end_flush();
	} /* show_template() */



} /* end class WP_MyAdminBar_Network */
?>