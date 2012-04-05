<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1.6
 */ 



/**
 * ==================================== Creates a My Cache menu option in the Admin Toolbar
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

class myCache {
/**
 * Create the Link
 */
	function myCache() {
		add_action( 'admin_bar_menu', array( $this, "menuCache" ), 21 );
	}

/**
 * Set the title of the menu item
 */
	function cacheTitle( $id, $href = FALSE ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'title' 	=> __('My Cache', 'wp-my-admin-bar'),
			'id' 	=> $id,
			'href' 	=> $href )
		);
	}

/**
 * Group Sites and Sites Menu
 */
	function cacheSites( $name, $id, $root_menu, $href = FALSE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_group( array(
			'parent' => $root_menu,
			'id'     => 'my_cache_sites',
			'meta'   => array( 'class' => 'ab-sub-secondary' ) )
		);

		$wp_admin_bar->add_menu( array(
			'title' 	=> $name,
			'id' 	=> $id,
			'parent' 	=> 'my_cache_sites',
			'href' 	=> $href )
		);
	}

/**
 * Create Item Links
 */
	function cacheItems( $name, $link, $root_menu, $meta = TRUE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> '<span style="display:none;">'. $root_menu .'</span>&bull; '. __($name, 'wp-my-admin-bar') .' &raquo;',
			'href' 	=> $link,
			'parent' 	=> $root_menu,
			'meta' => array( 'target' => '_blank' ) )
		);
	}

/**
 * Build The Menu
 */
	function menuCache() {
		if ( !is_user_logged_in() ) { return; }
		if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }

		/* WP Icon */
			$blue_wp_logo_url = includes_url('images/wpmini-blue.png');
			$blavatar = '<img src="' . esc_url( $blue_wp_logo_url ) . '" alt="' . esc_attr__( 'Blavatar' ) . '" width="16" height="16" class="blavatar"/>';

		/* MyFunctions Class */
			$my_functions_class = new MyFunctions();
			$check_mycache_option = $my_functions_class->option_wp_mycache();	/* get mycache option values */

		foreach( $check_mycache_option as $var => $val) {
			if ( $var == "dbcache" && $val == "show" ) { $dbcache_status = true; }
			if ( $var == "widget" && $val == "show" ) { $widget_status = true; }
			if ( $var == "minify" && $val == "show" ) { $minify_status = true; }
			if ( $var == "super" && $val == "show" ) { $super_status = true; }
			if ( $var == "total" && $val == "show" ) { $total_status = true; }
		}

		/* Multisite */
		if ( function_exists('is_multisite') && is_multisite()) {
			/* MyFunctions Class */
			$check_custom_option = $my_functions_class->option_wp_mycustom();	/* get mycustom option values */
			$custom_option = $my_functions_class->wp_mycustom_status();			/* check if option */
			$site_list = $my_functions_class->get_my_site_list();				/* db query or transient */

			$this->cacheTitle( "cachemenu" );

			foreach ( $site_list as $site ) {
				switch_to_blog( $site->blog_id );

					$siteUrl 	= site_url();
					$website 	= parse_url( $siteUrl );
					$website 	= $website['host'];
					$website	= ucfirst( $website );
					$parent 	= 'cache-'. $site->blog_id .'';

						if ( $check_custom_option['wpicon'] == "hide" ) {
							$new_site_name = $website;
						}

						if ( $check_custom_option['wpicon'] == "show" || !$custom_option ) {
							$new_site_name = $blavatar . $website;
						}	

				$this->cacheSites( $new_site_name, $parent, "cachemenu" );

				if ( $minify_status ) { $this->cacheItems( "WP Minify", get_admin_url( $site->blog_id, 'options-general.php?page=wp-minify' ), $parent ); }
				if ( $dbcache_status ) { $this->cacheItems( "DB Cache", network_home_url( 'wp-admin/options-general.php?page=db-cache-reloaded-fix/db-cache-reloaded.php' ), $parent ); }
				if ( $widget_status ) { $this->cacheItems( "Widget Cache", get_admin_url( $site->blog_id, 'options-general.php?page=widget-cache.php' ), $parent ); }
				if ( $super_status ) { $this->cacheItems( "Super Cache", get_admin_url( $site->blog_id, 'options-general.php?page=wpsupercache' ), $parent ); }
				if ( $total_status ) { $this->cacheItems( "Total Cache", get_admin_url( $site->blog_id, 'admin.php?page=w3tc_general' ), $parent ); }

				restore_current_blog();
			} /* end foreach */
		}else{
		/* Not Multisite */
			$siteUrl 	= site_url();
			$website 	= parse_url( $siteUrl );
			$website 	= $website['host'];
			$name 		= ucfirst( $website );
			$parent 	= 'cache-1';

			$this->cacheTitle( "cachemenu" );
			$this->cacheSites( $name, $parent, "cachemenu" );

			if ( $minify_status ) { $this->cacheItems( "WP Minify", get_admin_url( 1, 'options-general.php?page=wp-minify' ), $parent ); }
			if ( $dbcache_status ) { $this->cacheItems( "DB Cache", get_admin_url( 1, 'options-general.php?page=db-cache-reloaded-fix/db-cache-reloaded.php' ), $parent ); }
			if ( $widget_status ) { $this->cacheItems( "Widget Cache", get_admin_url( 1, 'options-general.php?page=widget-cache.php' ), $parent ); }
			if ( $super_status ) { $this->cacheItems( "Super Cache", get_admin_url( 1, 'options-general.php?page=wpsupercache' ), $parent ); }
			if ( $total_status ) { $this->cacheItems( "Total Cache", get_admin_url( 1, 'options-general.php?page=totalcache' ), $parent ); }
		} /* end multisite */
	} /* end function */
} /* end class */
?>