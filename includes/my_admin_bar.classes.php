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
 * ==================================== Checks Option, checks if menu can be shown then menu class is included.
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * My Sites Menu
 */
$check_mySites = unserialize( get_option('wp_myadminbar') );
if ( $check_mySites['show_my_sites'] == "show" ) {
	add_action( "init", "mySites_MenuInit" );

	function mySites_MenuInit() {
		global $mySites;
		$mySites = new mySites();
	}

	require_once MYAB_INCLUDES . '/my_sites.class.php';

}

/**
 * My Cache Menu
 */
$check_myCache = unserialize( get_option('wp_myadminbar') );
if ( $check_myCache['show_my_cache'] == "show" ) {
	add_action( "init", "myCache_MenuInit" );

	function myCache_MenuInit() {
		global $myCache;
		$myCache = new myCache();
	}

	require_once MYAB_INCLUDES . '/my_cache.class.php';
}

/**
 * My Tools Menu
 */
$check_myTools = unserialize( get_option('wp_myadminbar') );
if ( $check_myTools['show_my_tools'] == "show" ) {
	add_action( "init", "myTools_MenuInit" );

	function myTools_MenuInit() {
		global $myTools;
		$myTools = new myTools();
	}

	require_once MYAB_INCLUDES . '/my_tools.class.php';	
}


?>