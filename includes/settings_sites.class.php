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
 * ==================================== Settings Page for a Unique Network Website
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

class MyAdminBar_Site_Admin {
	private $checked;
/**
 * Settings Page
 */
	function wp_siteadmin_submenu() {
		add_submenu_page( 'options-general.php', 'Admin Bar', 'Admin Bar', 9, 'my_admin_bar.php', array( &$this, 'wp_mysiteadmin' ) ); 	/* calls core function wp_mysiteadmin() */
	}

/**
 * Set Defaults
 */
	function __construct() {
		add_action( 'admin_menu', array( &$this, 'wp_siteadmin_submenu' ) ); 													/* calls submenu wp_siteadmin_submenu() */
	} /* end function __construct() */


/**
 * Core Function: Update Options on Post and Build Network Template
 */
	function wp_mysiteadmin() {
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

			if ( get_option( 'wp_myadminbar' ) ) { /* Keep it clean */
				delete_option( 'wp_myadminbar' );
			}

			add_option( "wp_myadminbar", serialize( $options_array ), 'no' ); /* Rebuild Option */
			
				print '<div id="message" class="updated fade"><p><strong>'. __('Menu Settings saved: If the admin bar did not visually change', 'wp-my-admin-bar') .', <a href="http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'">'. __('refresh this page', 'wp-my-admin-bar') .'</a>.</strong></p></div>';
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

			add_option( "wp_mycache", serialize( $options_array ), 'no' ); /* Rebuild Option */
				print '<div id="message" class="updated fade"><p><strong>'. __('Cache Menu Option Saved: If the admin bar did not visually change', 'wp-my-admin-bar') .', <a href="http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'">'. __('refresh this page', 'wp-my-admin-bar') .'</a>.</strong></p></div>';
		}
	
		$this->show_template();
	} /* end wp_mysiteadmin() */

/**
 * Settings Page Template
 */
	function show_template() {
/**
 * Checked Items for Menu Options
 */
	$checked = 'checked="checked"';

		$myadminbar = unserialize( get_option('wp_myadminbar') );
			if ( $myadminbar['show_my_sites'] == "show" ) { $sites_on = $checked; }else{ $sites_off = $checked; }
			if ( $myadminbar['show_my_cache'] == "show" ) { $cache_on = $checked; }else{ $cache_off = $checked; }
			if ( $myadminbar['show_my_tools'] == "show" ) { $tools_on = $checked; }else{ $tools_off = $checked; }

		$myadminbar = get_option('wp_myadminbar');
			if ( !$myadminbar ) {
				$myadminbar = __('The WP-MyAdminBar Option Value is Blank.', 'wp-my-admin-bar');
					$sites_off = $checked;
					$cache_off = $checked;
					$tools_off = $checked;
			}

/**
 * Checked Items for Cache Plugins
 */
		$wpmycache = unserialize( get_option('wp_mycache') );
			if ( $wpmycache['toggle_dbcache'] == "show" ) { $dbcache_on = $checked; }else{ $dbcache_off = $checked; }
			if ( $wpmycache['toggle_widget'] == "show" ) { $widget_on = $checked; }else{ $widget_off = $checked; }
			if ( $wpmycache['toggle_minify'] == "show" ) { $minify_on = $checked; }else{ $minify_off = $checked; }
			if ( $wpmycache['toggle_super'] == "show" ) { $super_on = $checked; }else{ $super_off = $checked; }
			if ( $wpmycache['toggle_total'] == "show" ) { $total_on = $checked; }else{ $total_off = $checked; }

		$wpmycache = get_option( 'wp_mycache' );
		if ( !$wpmycache ) {
			$nwpmycache = __('The My Cache Menu Option Value is Blank.', 'wp-my-admin-bar');
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
			include MYAB_TEMPLATES . '/settings_sites.php';
		ob_end_flush();

	} /* end show_template() */
} /* end class MyAdminBar_Site_Admin */
?>