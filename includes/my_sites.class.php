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
 * ==================================== Creates New My Sites Admin Menu
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * Removes Default My Sites from Admin Bar
 */
	function removeMySites() {
		global $wp_admin_bar;
			$wp_admin_bar->remove_menu('my-sites');
			$wp_admin_bar->remove_menu('site-name');
	}
	add_action( 'wp_before_admin_bar_render', 'removeMySites', 0 );


class mySites {
/**
 * Create the Link
 */
	function mySites() {
		if ( !is_user_logged_in() )
			return;

		if ( !is_user_member_of_blog() && !is_super_admin() )
			return;

		add_action( 'admin_bar_menu', array( $this, "menuSites" ), 20 );
	}

/**
 * Set the title of the menu item
 */
	function menuTitle( $name, $id, $href = FALSE ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'id' 	=> $id,
			'title' 	=> $name,
			'href' 	=> $href )
		);
	}

/**
 * Group Sites and Sites Menu
 */
	function menuOption( $name, $id, $root_menu, $href = FALSE ) {
		global $wp_admin_bar;

		$blue_wp_logo_url = includes_url('images/wpmini-blue.png');
		$blavatar = '<img src="' . esc_url( $blue_wp_logo_url ) . '" alt="' . esc_attr__( 'Blavatar' ) . '" width="16" height="16" class="blavatar"/>';

		$wp_admin_bar->add_group( array(
			'parent' => $root_menu,
			'id'     => 'my_site_list',
			'meta'   => array( 'class' => 'ab-sub-secondary' ) )
		);

		$wp_admin_bar->add_menu( array(
			'title' 	=> $blavatar . $name,
			'id' 	=> $id,
			'parent' 	=> 'my_site_list',
			'href' 	=> $href )
		);
		
	}

/**
 * Network Admin Menu Item
 */
	function networkAdmin( $href, $id, $root_menu ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> __('The Network Admin'),
			'id' 	=> $id,
			'parent' 	=> $root_menu,
			'href' 	=> $href )
		);
	}

/**
 * Sub Menu to Item
 */
	function menuSelect( $name, $link, $root_menu, $meta = FALSE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> $name,
			'href' 	=> $link,
			'parent' 	=> $root_menu,
			'meta' 	=> $meta )
		);
	}

/* Sub Menu Manage Options */
	function menuManage( $name, $id, $root_menu, $meta = FALSE, $href = FALSE   ) {
		global $wp_admin_bar;
		
		$wp_admin_bar->add_group( array(
			'parent' => $root_menu,
			'id'     => 'menumanage' )
		);

		$wp_admin_bar->add_menu( array(
			'title' 	=> $name,
			'id' 	=> $id,
			'parent' 	=> "menumanage" )
		);
	}

/**
 * Create Item Links
 */
	function externalItem( $name, $link, $root_menu, $meta = TRUE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> $name,
			'href' 	=> $link,
			'parent' 	=> $root_menu,
			'meta' 	=> array( target => '_blank' ) )
		);
	}

/**
 * Build The Menu
 */
	function menuSites() {
			/* Network Menu Text */
			$ntext_dashbrd 	= __('Dashboard', 'wp-my-admin-bar');
			$ntext_nethome 	= __('Network Home', 'wp-my-admin-bar');
			$ntext_editit 	= __('Edit This Site', 'wp-my-admin-bar');
			$ntext_showit 	= __('Show Sites', 'wp-my-admin-bar');
			$ntext_userad 	= __('Users Admin', 'wp-my-admin-bar');
			$ntext_themes 	= __('Themes Admin', 'wp-my-admin-bar');
			$ntext_plugins 	= __('Plugins Admin', 'wp-my-admin-bar');
			$ntext_setting 	= __('Settings Admin', 'wp-my-admin-bar');

			/* My Sites Menu Text */
			$text_mneutitle = __('My Sites', 'wp-my-admin-bar');
			$text_dashbrd 	= __('Dashboard', 'wp-my-admin-bar');
			$text_visitit 	= __('Visit Site', 'wp-my-admin-bar');

			$text_addcont 	= __('Add Content', 'wp-my-admin-bar');

			$text_addpost 	= __('Add Page', 'wp-my-admin-bar');
			$text_addpage 	= __('Add Media', 'wp-my-admin-bar');
			$text_addmedia 	= __('Add Link', 'wp-my-admin-bar');
			$text_addlink 	= __('Add Link', 'wp-my-admin-bar');
			
			$text_pstpge 	= __('Posts and Pages', 'wp-my-admin-bar');
			
			$text_viewpost 	= __('View Posts', 'wp-my-admin-bar');
			$text_viewdrft 	= __('View Drafts', 'wp-my-admin-bar');
			$text_viewpage 	= __('View Pages', 'wp-my-admin-bar');
			
			$text_adminit 	= __('Administration', 'wp-my-admin-bar');
			
			$text_appradm 	= __('Appearance Admin', 'wp-my-admin-bar');
			$text_plugadm 	= __('Plugins Admin', 'wp-my-admin-bar');
			$text_useradm 	= __('Users Admin', 'wp-my-admin-bar');
			$text_settadm 	= __('Settings Admin', 'wp-my-admin-bar');

		if ( function_exists('is_multisite') && is_multisite()) {
			global $blog_id;
				if ( false === ( $site_list = get_transient( 'multisite_site_list' ) ) ) {
					global $wpdb;

					if ( get_site_transient( 'multisite_site_list' ) ) { /* just to be safe */
							delete_site_transient( 'multisite_site_list' );
					}

					$site_list = $wpdb->get_results( $wpdb->prepare('SELECT blog_id FROM wp_blogs ORDER BY blog_id') );
					set_site_transient( 'multisite_site_list', $site_list, 86400 );
				}

			$this->menuTitle( $text_mneutitle, "menutitle" );
			$this->networkAdmin( network_admin_url(), "networkmenu", "menutitle" );
				$this->menuSelect( "&bull; $ntext_nethome &raquo;", network_admin_url(), "networkmenu" );
				$this->menuSelect( "&bull; $ntext_nethome &raquo;", network_home_url( 'wp-admin/' ), "networkmenu" );
				$this->menuSelect( "&bull; $ntext_editit &raquo;", network_admin_url( "site-info.php?id=$blog_id" ), "networkmenu" );
				$this->menuSelect( "&bull; $ntext_showit &raquo;", network_admin_url( 'sites.php' ), "networkmenu" );
				$this->menuSelect( "&bull; $ntext_userad &raquo;", network_admin_url( 'users.php' ), "networkmenu" );
				$this->menuSelect( "&bull; $ntext_themes &raquo;", network_admin_url( 'themes.php' ), "networkmenu" );
				$this->menuSelect( "&bull; $ntext_plugins &raquo;", network_admin_url( 'plugins.php' ), "networkmenu" );
				$this->menuSelect( "&bull; $ntext_setting &raquo;", network_admin_url( 'settings.php' ), "networkmenu" );


			foreach ( $site_list as $site ) {
				switch_to_blog( $site->blog_id );

					$siteName = get_bloginfo('name');

					$siteUrl = site_url();
					$website = parse_url( $siteUrl );
					$website = $website['host'];
					$website = ucfirst( $website );
					
					$siteId = $site->blog_id;

					$uniq = '<span style="display:none;">'. $siteId .'</span> &bull; ';

					$this->menuOption( $website, $siteId, "menutitle" );
					$this->menuSelect( "$uniq $text_dashbrd &raquo;", get_admin_url( $site->blog_id ), $siteId );
					$this->menuSelect( "$uniq $text_visitit &raquo;", get_home_url( $site->blog_id, '/' ), $siteId );
				if ( current_user_can_for_blog( $site->blog_id, 'edit_posts' ) ) {
					$this->menuSelect( "$uniq $text_addcont", "", $siteId );
					$this->menuSelect( "$uniq $text_addpost &raquo;", get_admin_url( $site->blog_id, 'post-new.php' ), $siteId );
					$this->menuSelect( "$uniq $text_addpage &raquo;", get_admin_url( $site->blog_id, 'post-new.php?post_type=page' ), $siteId );
					$this->menuSelect( "$uniq $text_addmedia &raquo;", get_admin_url( $site->blog_id, 'media-new.php' ), $siteId );
					$this->menuSelect( "$uniq $text_addlink &raquo;", get_admin_url( $site->blog_id, 'link-add.php' ), $siteId );
					$this->menuSelect( "$uniq $text_pstpge", "", $siteId );
					$this->menuSelect( "$uniq $text_viewpost &raquo;", get_admin_url( $site->blog_id, 'post-new.php' ), $siteId );
					$this->menuSelect( "$uniq $text_viewdrft &raquo;", get_admin_url( $site->blog_id, 'edit.php?post_status=draft&post_type=post' ), $siteId );
					$this->menuSelect( "$uniq $text_viewpage &raquo;", get_admin_url( $site->blog_id, 'edit.php?post_type=page' ), $siteId );
					$this->menuSelect( "$uniq $text_adminit", "", $siteId );
					$this->menuSelect( "$uniq $text_appradm &raquo;", get_admin_url( $site->blog_id, 'themes.php' ), $siteId );
					$this->menuSelect( "$uniq $text_plugadm &raquo;", get_admin_url( $site->blog_id, 'plugins.php' ), $siteId );
					$this->menuSelect( "$uniq $text_useradm &raquo;", get_admin_url( $site->blog_id, 'users.php' ), $siteId );
					$this->menuSelect( "$uniq $text_settadm &raquo;", get_admin_url( $site->blog_id, 'options-general.php' ), $siteId );
				} /* end if */
				restore_current_blog();
			} /* end foreach */
		}else{ /* Not Multisite */
			$siteName = get_bloginfo('name');
			$siteUrl = site_url();
			$website = parse_url( $siteUrl );
			$website = $website['host'];
			$website = ucfirst( $website );

			$this->menuTitle( $text_mneutitle, "menutitle" );
			$this->menuSelect( "$text_dashbrd &raquo;", get_admin_url( 1 ), "menutitle" );
			$this->menuSelect( "$text_visitit &raquo;", get_home_url( 1, '/' ), "menutitle" );
				if ( current_user_can_for_blog( $site->blog_id, 'edit_posts' ) ) {
					$this->menuSelect( $text_addcont, "", "menutitle" );
					$this->menuSelect( "$text_addpost &raquo;", get_admin_url( 1, 'post-new.php' ), "menutitle" );
					$this->menuSelect( "$text_addpage &raquo;", get_admin_url( 1, 'post-new.php?post_type=page' ), "menutitle" );
					$this->menuSelect( "$text_addmedia &raquo;", get_admin_url( 1, 'media-new.php' ), "menutitle" );
					$this->menuSelect( "$text_addlink &raquo;", get_admin_url( 1, 'link-add.php' ), "menutitle" );
					$this->menuSelect( $text_pstpge, "", "menutitle" );
					$this->menuSelect( "$text_viewpost &raquo;", get_admin_url( 1, 'post-new.php' ), "menutitle" );
					$this->menuSelect( "$text_viewdrft &raquo;", get_admin_url( 1, 'edit.php?post_status=draft&post_type=post' ), "menutitle" );
					$this->menuSelect( "$text_viewpage &raquo;", get_admin_url( 1, 'edit.php?post_type=page' ), "menutitle" );
					$this->menuSelect( $text_adminit, "", "menutitle" );
					$this->menuSelect( "$text_appradm &raquo;", get_admin_url( 1, 'themes.php' ), "menutitle" );
					$this->menuSelect( "$text_plugadm &raquo;", get_admin_url( 1, 'plugins.php' ), "menutitle" );
					$this->menuSelect( "$text_useradm &raquo;", get_admin_url( 1, 'users.php' ), "menutitle" );
					$this->menuSelect( "$text_settadm &raquo;", get_admin_url( 1, 'options-general.php' ), "menutitle" );
				} /* end if */
		} /* end multisite */
	} /* end function */
} /* end class */
?>