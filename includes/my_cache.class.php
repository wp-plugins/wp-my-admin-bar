<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author Chris Winters <tribalnerd@technerdia.com>
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1
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
		if ( ! is_user_logged_in() )
			return;

		if ( !is_user_member_of_blog() && !is_super_admin() )
			return;

		add_action( 'admin_bar_menu', array( $this, "menuCache" ), 21 );
	}

/**
 * Set the title of the menu item
 */
	function cacheTitle( $id, $href = FALSE ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'title' 	=> __('My Cache'),
			'id' 	=> $id,
			'href' 	=> $href )
		);
	}

/**
 * Group Sites and Sites Menu
 */
	function cacheSites( $name, $id, $root_menu, $href = FALSE ) {
		global $wp_admin_bar;

		$blue_wp_logo_url = includes_url('images/wpmini-blue.png');
		$blavatar = '<img src="' . esc_url( $blue_wp_logo_url ) . '" alt="' . esc_attr__( 'Blavatar' ) . '" width="16" height="16" class="blavatar"/>';

		$wp_admin_bar->add_group( array(
			'parent' => $root_menu,
			'id'     => 'my_cache_sites',
			'meta'   => array( 'class' => 'ab-sub-secondary' ) )
		);

		$wp_admin_bar->add_menu( array(
			'title' 	=> $blavatar . $name,
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
			'title' 	=> $name,
			'href' 	=> $link,
			'parent' 	=> $root_menu,
			'meta' => array( 'target' => '_blank' ) )
		);
	}

/**
 * Build The Menu
 */
	function menuCache() {
		foreach( unserialize( get_option('wp_mycache') ) as $var => $val) {
			if ( $var == "toggle_dbcache" && $val == "show" ) { $dbcache_status = true; }
			if ( $var == "toggle_widget" && $val == "show" ) { $widget_status = true; }
			if ( $var == "toggle_minify" && $val == "show" ) { $minify_status = true; }
			if ( $var == "toggle_super" && $val == "show" ) { $super_status = true; }
			if ( $var == "toggle_total" && $val == "show" ) { $total_status = true; }
		}

			/* Menu Text */
			$text_minify 	= __('WP Minify', 'wp-my-admin-bar');
			$text_dbcache 	= __('DB Cache', 'wp-my-admin-bar');
			$text_widgetc 	= __('Widget Cache', 'wp-my-admin-bar');
			$text_superc 	= __('Super Cache', 'wp-my-admin-bar');
			$text_totalc 	= __('Total Cache', 'wp-my-admin-bar');

		if ( function_exists('is_multisite') && is_multisite()) {
			if ( false === ( $cache_site_list = get_transient( 'multisite_site_list' ) ) ) {
				global $wpdb;

				if ( get_site_transient( 'multisite_site_list' ) ) { /* just to be safe */
					delete_site_transient( 'multisite_site_list' );
				}

				$cache_site_list = $wpdb->get_results( $wpdb->prepare( 'SELECT blog_id FROM wp_blogs ORDER BY blog_id' ) );
				set_site_transient( 'multisite_site_list', $cache_site_list, 86400 );
			}

			$this->cacheTitle( "cachemenu" );

			foreach ( $cache_site_list as $site ) {
				switch_to_blog( $site->blog_id );

					$siteName 	= get_bloginfo('name');
					$siteUrl 	= site_url();
					$website 	= parse_url( $siteUrl );
					$website 	= $website['host'];
					$name 		= ucfirst( $website );
					$parent 	= 'cache-'. $site->blog_id .'';
					$uniq 		= '<span style="display:none;">'. $parent .'</span> &bull;';

				$this->cacheSites( $name, $parent, "cachemenu" );

				if ( $minify_status ) { $this->cacheItems( "$uniq $text_minify &raquo;", get_admin_url( $site->blog_id, 'options-general.php?page=wp-minify' ), $parent ); }
				if ( $dbcache_status ) { $this->cacheItems( "$uniq $text_dbcache &raquo;", network_home_url( 'wp-admin/options-general.php?page=db-cache-reloaded-fix/db-cache-reloaded.php' ), $parent ); }
				if ( $widget_status ) { $this->cacheItems( "$uniq $text_widgetc &raquo;", get_admin_url( $site->blog_id, 'options-general.php?page=widget-cache.php' ), $parent ); }
				if ( $super_status ) { $this->cacheItems( "$uniq $text_superc &raquo;", get_admin_url( $site->blog_id, 'options-general.php?page=wpsupercache' ), $parent ); }
				if ( $total_status ) { $this->cacheItems( "$uniq $text_totalc &raquo;", get_admin_url( $site->blog_id, 'admin.php?page=w3tc_general' ), $parent ); }

				restore_current_blog();
			} /* end foreach */
		}else{ /* Not Multisite */
					$siteName 	= get_bloginfo('name');
					$siteUrl 	= site_url();
					$website 	= parse_url( $siteUrl );
					$website 	= $website['host'];
					$name 		= ucfirst( $website );
					$parent 	= 'cache-1';

					$this->cacheTitle( "cachemenu" );
					$this->cacheSites( $name, $parent, "cachemenu" );

					if ( $minify_status ) { $this->cacheItems( "$text_minify &raquo;", get_admin_url( 1, 'options-general.php?page=wp-minify' ), $parent ); }
					if ( $dbcache_status ) { $this->cacheItems( "$text_dbcache &raquo;", get_admin_url( 1, 'options-general.php?page=db-cache-reloaded-fix/db-cache-reloaded.php' ), $parent ); }
					if ( $widget_status ) { $this->cacheItems( "$text_widgetc &raquo;", get_admin_url( 1, 'options-general.php?page=widget-cache.php' ), $parent ); }
					if ( $super_status ) { $this->cacheItems( "$text_superc &raquo;", get_admin_url( 1, 'options-general.php?page=wpsupercache' ), $parent ); }
					if ( $total_status ) { $this->cacheItems( "$text_totalc &raquo;", get_admin_url( 1, 'options-general.php?page=totalcache' ), $parent ); }
		} /* end multisite */
	} /* end function */
} /* end class */
?>