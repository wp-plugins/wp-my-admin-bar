<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1.8
 */

/**
 * ==================================== Repeating Functions and Standalone Classes
 */


/**
 * Repeating Functions
 */
class MyFunctions {

/** =================================================================== My Sites Menu == */

/* wp_myadminbar_nw option for Network added for version 0.1.7 */
	public function option_wp_myadminbar_nw() {
			$get_wp_myadminbar = unserialize( get_option('wp_myadminbar_nw') );
		return $get_wp_myadminbar;
	}
/* Added for version 0.1.7 */
	public function wp_myadminbar_nw_status() {
			$get_myadminbar_status = get_option('wp_myadminbar_nw');
		return $get_myadminbar_status;
	}

/* wp_myadminbar option */
	public function option_wp_myadminbar() {
			$get_wp_myadminbar = unserialize( get_option('wp_myadminbar') );
		return $get_wp_myadminbar;
	}

	public function wp_myadminbar_status() {
			$get_myadminbar_status = get_option('wp_myadminbar');
		return $get_myadminbar_status;
	}

/** =================================================================== My Cache Menu == */

/* wp_mycache_nw option for Network added for version 0.1.7 */
	public function option_wp_mycache_nw() {
			$get_wp_mycache = unserialize( get_option('wp_mycache_nw') );
		return $get_wp_mycache;
	}
/* Added for version 0.1.7 */
	public function wp_mycache_nw_status() {
			$get_mycache_status = get_option('wp_mycache_nw');
		return $get_mycache_status;
	}

/* wp_mycache option */
	public function option_wp_mycache() {
			$get_wp_mycache = unserialize( get_option('wp_mycache') );
		return $get_wp_mycache;
	}

	public function wp_mycache_status() {
			$get_mycache_status = get_option('wp_mycache');
		return $get_mycache_status;
	}

/** =================================================================== My Tools Menu == */

/* wp_mycustom option */
	public function option_wp_mycustom() {
			$get_wp_mycustom = unserialize( get_option('wp_mycustom') );
		return $get_wp_mycustom;
	}
	
	public function wp_mycustom_status() {
			$get_mycustom_status = get_option('wp_mycustom');
		return $get_mycustom_status;
	}

/* db query and transient */
	public function get_my_site_list() {
			if ( false === ( $site_list = get_transient( 'multisite_site_list' ) ) ) {
				global $wpdb;
				
				if ( get_site_transient( 'multisite_site_list' ) ) { /* just to be safe */
					delete_site_transient( 'multisite_site_list' );
				}

				$site_list = $wpdb->get_results( $wpdb->prepare( 'SELECT blog_id FROM '. $wpdb->blogs .'  ORDER BY blog_id' ) );
				set_site_transient( 'multisite_site_list', $site_list, 86400 );
			}
		return $site_list;
	}
}


/**
 * Standalone Classes
 */

/**
 * Network Settings Page
 */
class networkPage {
	function __construct() {
		add_action( 'plugins_loaded', array( $this, "include_network" ) );
	}
	
	function include_network() {
		if ( !is_user_logged_in() ) { return; }																		/* Logged in users only */
	
		if ( current_user_can('manage_options') && is_user_member_of_blog() && is_super_admin() ) {	/* Proper users only */
			/* include - call class */
			require_once MYAB_INCLUDES . '/settings_network.class.php';
				$wp_mynetworkadmin = new MyAdminBar_Network_Admin();
		}
	}
}


/**
 * Site Settings Page
 */
class settingsPage {
	function __construct() {
		add_action( 'plugins_loaded', array( $this, "include_settings" ) );	 /* Loads include_settings() below */
	}

	function include_settings() {
		if ( !is_user_logged_in() ) { return; } /* Logged in users only */

	/** Modified for version 0.1.7	
		if ( current_user_can('manage_options') && is_user_member_of_blog() && is_super_admin() ) {
	 */
		if ( current_user_can('manage_options') && is_user_member_of_blog() ) {
			require_once MYAB_INCLUDES . '/settings_sites.class.php'; /* include - call class */
				$wp_mysiteadmin = new MyAdminBar_Site_Admin();
		}
	}
}


/**
 * Display WP Logos, Howdy Statement and/or Site IDs
 */
class displaySettings {
	function __construct() {
		add_action( 'wp_before_admin_bar_render', array( $this, "custom_settings" ) ); /* Loads custom_settings() below */
	}
	
	/* Custom Settings Tab */
	function custom_settings() {
	/** Modified for version 0.1.7
		if ( !is_user_logged_in() ) { return; }
		if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }
	*/
		if ( !is_user_logged_in() && !is_admin_bar_showing() ) { return; }
		if ( !current_user_can('manage_options') && !is_user_member_of_blog() ) { return; }

		global $wp_admin_bar;

			/* MyFunctions Class */
				$my_functions_class = new MyFunctions();
				$custom_option = $my_functions_class->wp_mycustom_status();

			if ( $custom_option ) {
				$get_custom_option = $my_functions_class->option_wp_mycustom();
			}
			
			if ( isset ( $get_custom_option['wplogo'] ) && $get_custom_option['wplogo'] == "hide" ) { $wp_admin_bar->remove_menu('wp-logo'); }
			if ( isset ( $get_custom_option['howdy'] ) && $get_custom_option['howdy'] == "hide" ) { $wp_admin_bar->remove_menu('my-account'); }

	} /* end custom_settings() */
}


/**
 * Setting Page Tabs
 */
class displayTabs {
	public function settings_tabs() {
		if ( isset ( $_GET['tab'] ) ){ $current = $_GET['tab']; }else{ $current = "menu_settings"; }
		$tabs = array( 'menu_settings' => 'Menu Settings', 'custom_settings' => 'Custom Settings' );

		$tab_menu = '<div id="icon-themes" class="icon32"><br></div>';
		$tab_menu .= '<h2 class="nav-tab-wrapper">';
			foreach( $tabs as $tab => $name ){
				$class = ( $tab == $current ) ? ' nav-tab-active' : '';
				$tab_menu .= "<a class='nav-tab$class' href='?tab=$tab&page=my_admin_bar.php'>$name</a>";
			}
		$tab_menu .= '</h2><br />';

		return $tab_menu;
	}
}



/**
* Build My Admin Bar Settings For New Websites
*/
class SetupNewSite {
	function __construct() {
		$this->setup_my_admin_bar();
	}

	function setup_my_admin_bar() {
		/** Get Default Options */
		switch_to_blog(1);
		$get_wp_myadminbar 	= maybe_unserialize( get_option('wp_myadminbar_nw') );
		$get_wp_mycache 		= maybe_unserialize( get_option('wp_mycache_nw') );
		$get_wp_mycustom 		= maybe_unserialize( get_option('wp_mycustom') );

			$wp_myadminbar_options_array = array(
				'my_sites' 	=> $get_wp_myadminbar['my_sites'],
				'my_cache' 	=> $get_wp_myadminbar['my_cache'],
				'my_tools' 	=> $get_wp_myadminbar['my_tools']
			);

			$wp_mycache_options_array = array(
				'dbcache' 	=> $get_wp_mycache['dbcache'],
				'widget' 	=> $get_wp_mycache['widget'],
				'minify' 	=> $get_wp_mycache['minify'],
				'super' 		=> $get_wp_mycache['super'],
				'total' 		=> $get_wp_mycache['total']
			);

			$wp_mycustom_options_array = array(
				'wplogo' 	=> $get_wp_mycustom['wplogo'],
				'howdy' 		=> $get_wp_mycustom['howdy'],
				'wpicon' 	=> $get_wp_mycustom['wpicon'],
				'siteids' 	=> $get_wp_mycustom['siteids']
			);

			/** Switch to New Website */
			switch_to_blog( $_GET['id'] );

			/** Clear Options Incase Page Is Reloaded */
			delete_option( 'wp_myadminbar' );
			delete_option( 'wp_mycache' );
			delete_option( 'wp_mycustom' );

			/** Build Options */
			add_option( 'wp_myadminbar', serialize( $wp_myadminbar_options_array ), 'no' );
			add_option( 'wp_mycache', serialize( $wp_mycache_options_array ), 'no' );
			add_option( 'wp_mycustom', serialize( $wp_mycustom_options_array ), 'no' );

			/* return home */
			restore_current_blog();

			/** Update Notice */
			add_action( 'network_admin_notices', array( 'SetupNewSite', 'network_notices' ) );
	} /** end setup_my_admin_bar() */

	/** Network Update Notice */
	function network_notices() {
		echo '<div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p><em>My Admin Bar Settings Duplicated To New Website.</em></p></div>';
		remove_action( 'network_admin_notices', array( 'SetupNewSite', 'network_notices' ) );
	} /** end network_notices() */
} /** end class SetupNewSite */
?>