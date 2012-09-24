<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012 techNerdia LLC.
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1.7
 */



/**
 * ==================================== Settings Page for Multisite Network Admin
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

class MyAdminBar_Network_Admin {
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
		add_action( 'network_admin_menu', array( &$this, 'my_siteadmin_submenu' ) ); /* calls submenu  my_siteadmin_submenu() */
	} /* end function __construct() */
	

/**
 * Core Function: Update Options on Post and Build Network Template
 */
	function wp_mynetworkadmin() { /* called from wp_myadminbar_submenu() */
/**
 * Build wp_myadminbar Option based on posted information
 */
		if ( isset( $_POST['save_my_menus'] ) && check_admin_referer( 'my_option_action', 'my_option_nonce' ) ) {
			if ( $_POST['my_sites'] == "show" || $_POST['my_sites'] == "hide" ) { $my_sites_post = $_POST['my_sites']; }
			if ( $_POST['my_cache'] == "show" || $_POST['my_cache'] == "hide" ) { $my_cache_post = $_POST['my_cache']; }
			if ( $_POST['my_tools'] == "show" || $_POST['my_tools'] == "hide" ) { $my_tools_post = $_POST['my_tools']; }
	
			$options_array = array(
				'my_sites' 	=> $my_sites_post,
				'my_cache' 	=> $my_cache_post,
				'my_tools' 	=> $my_tools_post
			);

			if ( get_option('wp_myadminbar') || get_option('wp_myadminbar_nw') ) { /* Keep It Clean */
				delete_option( 'wp_myadminbar' );
				delete_option( 'wp_myadminbar_nw' );
			}

			$this->wp_myadminbar_blogs( $the_option = 'wp_myadminbar', $options_array ); 	/* Rebuild Option */
			
			/* Add A Network Only Option */
			add_option( 'wp_myadminbar_nw', serialize( $options_array ), 'no' );
		}

/**
 * Build wp_mycache Option based on posted information
 */
		if ( isset( $_POST['save_my_cache'] ) && check_admin_referer( 'my_cache_action', 'my_cache_nonce' ) ) {
			if ( $_POST['dbcache'] == "show" || $_POST['dbcache'] == "hide" ) { $dbcache_post = $_POST['dbcache']; }
			if ( $_POST['widget'] == "show" || $_POST['widget'] == "hide" ) { $widget_post = $_POST['widget']; }
			if ( $_POST['minify'] == "show" || $_POST['minify'] == "hide" ) { $minify_post = $_POST['minify']; }
			if ( $_POST['super'] == "show" || $_POST['super'] == "hide" ) { $super_post = $_POST['super']; }
			if ( $_POST['total'] == "show" || $_POST['total'] == "hide" ) { $total_post = $_POST['total']; }
	
			$options_array = array(
				'dbcache' 	=> $dbcache_post,
				'widget' 	=> $widget_post,
				'minify' 	=> $minify_post,
				'super' 		=> $super_post,
				'total' 		=> $total_post
			);

			if ( get_option( 'wp_mycache' ) || get_option( 'wp_mycache_nw' ) ) { /* Keep It Clean */
				delete_option( 'wp_mycache' );
				delete_option( 'wp_mycache_nw' );
			}

			$this->wp_myadminbar_blogs( $the_option = 'wp_mycache', $options_array ); /* Rebuild Option */

			/* Add A Network Only Option */
			add_option( 'wp_mycache_nw', serialize( $options_array ), 'no' );
		}

/**
 * Build wp_mycustom Option based on posted information
 */
		if ( isset( $_POST['save_my_settings'] ) && check_admin_referer( 'my_custom_action', 'my_custom_nonce' ) ) {
			if ( $_POST['wplogo'] == "show" || $_POST['wplogo'] == "hide" ) { $wplogo_post = $_POST['wplogo']; }
			if ( $_POST['howdy'] == "show" || $_POST['howdy'] == "hide" ) { $howdy_post = $_POST['howdy']; }
			if ( $_POST['wpicon'] == "show" || $_POST['wpicon'] == "hide" ) { $wpicon_post = $_POST['wpicon']; }
			if ( $_POST['siteids'] == "show" || $_POST['siteids'] == "hide" ) { $siteids_post = $_POST['siteids']; }

			$options_array = array(
				'wplogo' 	=> $wplogo_post,
				'howdy' 		=> $howdy_post,
				'wpicon' 	=> $wpicon_post,
				'siteids' 	=> $siteids_post
			);

			if ( get_option( 'wp_mycustom' ) ) { /* Keep It Clean */
				delete_option( 'wp_mycustom' );
			}

			$this->wp_myadminbar_blogs( $the_option = 'wp_mycustom', $options_array ); /* Rebuild Option */
		}


	/* display template */
		$this->show_template();
	} /* end wp_mynetworkadmin() */


/**
 * Run setting changes through each Website within the Network.
 */
	function wp_myadminbar_blogs( $the_option, $options_array ){
		global $wpdb;

			/**
			 * No Transient Check, Delete Transient, Get DB Query, Reset Transient.
			 * Helps make sure transient cache is correct, resets expire.
			 */
				if ( get_site_transient( 'multisite_site_list' ) ) {
					delete_site_transient( 'multisite_site_list' );
				}

				$network_blog_id = $wpdb->get_results( $wpdb->prepare( "SELECT blog_id FROM $wpdb->blogs ORDER BY blog_id" ) );
				set_site_transient( 'multisite_site_list', $network_blog_id, 86400 );

		foreach ( $network_blog_id as $current_blog_id ) {
			switch_to_blog( $current_blog_id->blog_id );

			if ( get_option( $the_option ) ) { /* Keep It Clean */
				delete_option( $the_option );
			}

			add_option( $the_option, serialize( $options_array ), 'no' );
		}

		restore_current_blog();
			print '<div class="updated"><p><strong>'. __('Network Wide Settings Saved. If the admin bar did not visually change, you may need to', 'wp-my-admin-bar') .' <a href="http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'">'. __('refresh this page', 'wp-my-admin-bar') .'</a>.</strong></p></div>';
		return;
	} /* end wp_myadminbar_blogs() */


/**
 * Network Settings Page Template
 */
	function show_template() {
		$checked = 'checked="checked"';

		/* MyFunctions Class */
			$my_functions_class = new MyFunctions();
		/** Adjusted for Version 0.1.7
			$my_menus = $my_functions_class->option_wp_myadminbar();
			$my_cache = $my_functions_class->option_wp_mycache();
		*/
			$my_menus = $my_functions_class->option_wp_myadminbar_nw();				/* get option values */		
			$my_cache = $my_functions_class->option_wp_mycache_nw();					/* get option values */
			$my_custom = $my_functions_class->option_wp_mycustom();					/* get option values */

		/** Adjusted for Version 0.1.7
			$myadminbar_option = $my_functions_class->wp_myadminbar_status();
			$mycache_option = $my_functions_class->wp_mycache_status();
		*/
			$myadminbar_option = $my_functions_class->wp_myadminbar_nw_status();	/* check option */			
			$mycache_option = $my_functions_class->wp_mycache_nw_status();			/* check option */
			$mycustom_option = $my_functions_class->wp_mycustom_status();			/* check option */

/**
 * Checked Items for Menu Options
 */
			if ( $my_menus['my_sites'] == "show" ) { $sites_on = $checked; }else{ $sites_off = $checked; }
			if ( $my_menus['my_cache'] == "show" ) { $cache_on = $checked; }else{ $cache_off = $checked; }
			if ( $my_menus['my_tools'] == "show" ) { $tools_on = $checked; }else{ $tools_off = $checked; }
			if ( !$myadminbar_option ) { $myadminbar_option = __('The WP-MyAdminBar Option Value is Blank.', 'wp-my-admin-bar'); }

/**
 * Checked Items for Cache Plugins
 */
			if ( $my_cache['dbcache'] == "show" ) { $dbcache_on = $checked; }else{ $dbcache_off = $checked; }
			if ( $my_cache['widget'] == "show" ) { $widget_on = $checked; }else{ $widget_off = $checked; }
			if ( $my_cache['minify'] == "show" ) { $minify_on = $checked; }else{ $minify_off = $checked; }
			if ( $my_cache['super'] == "show" ) { $super_on = $checked; }else{ $super_off = $checked; }
			if ( $my_cache['total'] == "show" ) { $total_on = $checked; }else{ $total_off = $checked; }
			if ( !$mycache_option ) { $mycache_option = __('The My Cache Menu Option Value is Blank.', 'wp-my-admin-bar'); }

/**
 * Checked Items for Custom Settings
 */
		if ( $my_custom['wplogo'] == "show" ) {
			$wplogo_on = $checked;
		}elseif( $my_custom['wplogo'] == "hide" ){
			$wplogo_off = $checked;
		}else{
			$wplogo_on = $checked;
		}

		if ( $my_custom['howdy'] == "show" ) {
			$howdy_on = $checked;
		}elseif( $my_custom['howdy'] == "hide" ){
			$howdy_off = $checked;
		}else{
			$howdy_on = $checked;
		}

		if ( $my_custom['wpicon'] == "show" ) {
			$wpicon_on = $checked;
		}elseif( $my_custom['wpicon'] == "hide" ){
			$wpicon_off = $checked;
		}else{
			$wpicon_on = $checked;
		}

		if ( $my_custom['siteids'] == "show" ) {
			$siteids_on = $checked;
		}elseif( $my_custom['siteids'] == "hide" ){
			$siteids_off = $checked;
		}else{
			$siteids_off = $checked;
		}
			
		if ( !$mycustom_option ) { $mycustom_option = __('The Custom Settings Option Value is Blank.', 'wp-my-admin-bar'); }

/**
 * Tabs
 */
	$display_tabs = new displayTabs();
	$setting_tabs = $display_tabs->settings_tabs();

/**
 * The Template
 */
		ob_start();
			include MYAB_TEMPLATES . '/settings_network.php';
		ob_end_flush();
	} /* show_template() */	
} /* end class WP_MyAdminBar_Network */
?>