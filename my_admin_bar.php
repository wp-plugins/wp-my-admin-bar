<?php
/**
Plugin Name: WP My Admin Bar | WP-MyAdminBar
Plugin URI: http://technerdia.com/projects/adminbar/plugin.html
Description: The WP-MyAdminBar Plugin, replaces and expands the Wordpress Administration Bar, adding a new My Sites menu with extended options, a My Cache menu for quick cache access and My Tools for all WP Developers and Blogger needs.
Tags: myadmin, myadminbar, adminbar, admin bar, admin, bar, my sites, mysites, tools, cache, multisite, webtools, web tools, technerdia
Version: 0.1.3
License: GPL
Author: tribalNerd
Author URI: http://techNerdia.com/

Created Feb 12, 2012

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program; if not, please visit: http://www.gnu.org/licenses/gpl.html

@author tribalNerd (tribalnerd@technerdia.com)
@copyright Copyright (c) 2012, Chris Winters
@link http://technerdia.com/projects/adminbar/plugin.html
@license http://www.gnu.org/licenses/gpl.html
@version 0.1
*/

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/* Define plugin textdomain for translations */
function wp_my_admin_bar_init() {
	$plugin_dir = basename( dirname(__FILE__) );
		load_plugin_textdomain( 'wp-my-admin-bar', false, $plugin_dir );
}
add_action('init', 'wp_my_admin_bar_init');


/* Defined settings */
if ( !defined( 'MYAB_PLUGIN_BASENAME' ) ) {
	define( 'MYAB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); 				/* plugin-folder/plugin-file.php */
}

if ( !defined( 'MYAB_PLUGIN_NAME' ) ) {
	define( 'MYAB_PLUGIN_NAME', trim( dirname( MYAB_PLUGIN_BASENAME ), '/' ) ); 	/* plugin-file */
}

if ( !defined( 'MYAB_PLUGIN_DIR' ) ) {
	define( 'MYAB_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MYAB_PLUGIN_NAME ); 			/* /full/path/to/plugin-folder */
}

if ( !defined( 'MYAB_INCLUDES' ) ) {
	define( 'MYAB_INCLUDES', MYAB_PLUGIN_DIR . '/includes' ); 						/* /full/path/to/plugin-folder/includes */
}

if ( !defined( 'MYAB_TEMPLATES' ) ) {
	define( 'MYAB_TEMPLATES', MYAB_PLUGIN_DIR . '/templates' ); 						/* /full/path/to/plugin-folder/templates */
}


/* Installs plugin on activation */
require_once MYAB_INCLUDES . '/activate.php';


/* Site Settings Page */
class settingsPage {
	function __construct() {
		add_action( 'plugins_loaded', array( $this, "include_settings" ) );
	}

	function include_settings() {
		if ( current_user_can('manage_options') ) {
			/* include - call class */
			require_once MYAB_INCLUDES . '/settings_sites.class.php';
			$wp_mysiteadmin = new MyAdminBar_Site_Admin();
		}
	}
}

/* Display Settings Page */
if ( strlen( strstr( $_SERVER['REQUEST_URI'], 'wp-admin' ) ) > 0 ) {
	if ( !strlen( strstr( $_SERVER['REQUEST_URI'], 'network' ) ) > 0 ) {
		$include_settings = new settingsPage();
	}
}


/* Network Settings */
class networkPage {
	function __construct() {
		add_action( 'plugins_loaded', array( $this, "include_network" ) );
	}
	
	function include_network() {
		if ( current_user_can('manage_options') ) {
			/* include - call class */
			require_once MYAB_INCLUDES . '/settings_network.class.php';
			$wp_mynetworkadmin = new MyAdminBar_Network_Admin();
		}
	}
}

/* Display Network Settings Page if within Network */
if ( strlen( strstr( $_SERVER['REQUEST_URI'], 'network' ) ) > 0 ) {
	$include_network = new networkPage();
}


/* Menu Classes */
require_once MYAB_INCLUDES . '/my_admin_bar.classes.php';
?>