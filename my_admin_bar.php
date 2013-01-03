<?php
/**
Plugin Name: WP My Admin Bar | Admin Bar
Plugin URI: http://technerdia.com/projects/adminbar/plugin.html
Description: The WP My Admin Bar Plugin, replaces and expands the Wordpress Admin Bar, adding a new My Sites menu with extended options, a My Cache menu for quick cache access and My Tools for all WP Developers and Blogger needs.
Tags: myadmin, myadminbar, adminbar, admin bar, admin, bar, toolbar, tool bar, my sites, mysites, tools, cache, multisite, webtools, web tools, technerdia
Version: 0.2
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
@version 0.2
*/

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * Define Plugin textdomain for Translations - Run first
 */
function wp_my_admin_bar_init() {
	$plugin_dir = basename( dirname(__FILE__) );
		load_plugin_textdomain( 'wp-my-admin-bar', false, $plugin_dir );
}
add_action('init', 'wp_my_admin_bar_init');

/**
 * Define Named Constants
 */
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


/**
 * Repeating Functions and Standalone Classes
 */
require_once MYAB_INCLUDES . '/function.class.php';


/**
 * Installs Plugin on Activation
 */
require_once MYAB_INCLUDES . '/activate.php';


/**
 * Version Check, Set and Upgrade if Needed
 * This needs to be at this spot, not above it.
 */
if ( !defined( 'WPMYAB_VERSION' ) ) {
	define( 'WPMYAB_VERSION', "1.1.4" );

	/* MyFunctions Class */
	$option_data = new MyFunctions();
	$wp_myadminbar_option = $option_data->option_wp_myadminbar();
}


/**
 * Display Settings Page if within Admin
 */
if ( is_admin() ) {
	$include_settings = new settingsPage();
}


/**
 * Display Network Settings Page if within Network
 */
if ( is_network_admin() ) {
	$include_network = new networkPage();
}


/**
 * My Menus - Always Run
 */

/**
 * Display Settings - Logos, Howdy, etc
 */
	$extra_settings = new displaySettings();

/**
 * WP My Admin Bar
 */
	require_once MYAB_INCLUDES . '/my_admin_bar.class.php';
	$show_my_menus = new MyAdminBarMenus();


/**
 * Setup My Admin Bar For Newly Created Websites
*/
if ( is_network_admin() && isset ( $_GET['update'] ) && isset ( $_GET['id'] ) ) {													
	$install_new_site = new SetupNewSite();
}

?>