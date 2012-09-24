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
 * ==================================== Checks Option, checks if menu can be shown then menu class is included.
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

class MyAdminBarMenus {

	function __construct() {
		$this->show_my_sites();
		$this->show_my_cache();
		$this->show_my_tools();
	}

/**
 * My Sites Menu
 */
	function show_my_sites() {
		/* MyFunctions Class */
		$get_option_data = new MyFunctions();
		/** Modified for version 0.1.7 */
			if ( is_network_admin() ) { 
				$check_my_menus = $get_option_data->option_wp_myadminbar_nw();
			} else {
        		$check_my_menus = $get_option_data->option_wp_myadminbar();
			}

		if ( $check_my_menus['my_sites'] == "show" ) {
			add_action( "init", "my_sites_menu_init" );

		/* my_sites.class.php */
			function my_sites_menu_init() {
				$mySites = new mySites();
			}

			require_once MYAB_INCLUDES . '/my_sites.class.php';
		} /* end if */
	} /* end check_my_sites() */

/**
 * My Cache Menu
 */
	function show_my_cache() {
		/* MyFunctions Class */
		$get_option_data = new MyFunctions();
		/** Modified for version 0.1.7 */
			if ( is_network_admin() ) { 
				$check_my_cache = $get_option_data->option_wp_myadminbar_nw();
			} else {
        		$check_my_cache = $get_option_data->option_wp_myadminbar();
			}
        
		if ( $check_my_cache['my_cache'] == "show" ) {
			add_action( "init", "my_cache_menu_init" );

		/* my_cache.class.php */
			function my_cache_menu_init() {
				$myCache = new myCache();
			}

			require_once MYAB_INCLUDES . '/my_cache.class.php';
		} /* end if */
	} /* end show_my_cache() */

/**
 * My Tools Menu
 */
	function show_my_tools() {
		/* MyFunctions Class */
		$get_option_data = new MyFunctions();
		/** Modified for version 0.1.7 */
			if ( is_network_admin() ) { 
				$check_my_tools = $get_option_data->option_wp_myadminbar_nw();
			} else {
        		$check_my_tools = $get_option_data->option_wp_myadminbar();
			}
        
		if ( $check_my_tools['my_tools'] == "show" ) {
			add_action( "init", "my_tools_menu_init" );

		/* my_tools.class.php */
			function my_tools_menu_init() {
				$myTools = new myTools();
			}

			require_once MYAB_INCLUDES . '/my_tools.class.php';	
		} /* end if */
	} /* end show_my_cache() */

} /* End class MyAdminBarMenus */
?>