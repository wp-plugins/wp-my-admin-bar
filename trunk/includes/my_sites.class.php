<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1.9
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
		/** Modified for version 0.1.7
			if ( !is_user_logged_in() ) { return; }
			if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }
		*/
			if ( !is_user_logged_in() && !is_admin_bar_showing() ) { return; }
			if ( !current_user_can('manage_options') && !is_user_member_of_blog() ) { return; }

			$wp_admin_bar->remove_menu('my-sites');	/* turn off default my-sites menu */
			$wp_admin_bar->remove_menu('site-name');	/* turn off site-name menu */
	}
	add_action( 'wp_before_admin_bar_render', 'removeMySites', 0 );


class mySites {
/**
 * Create the Link
 */
	function mySites() {
		add_action( 'admin_bar_menu', array( $this, "menuSites" ), 20 );
	}

/**
 * Set the title of the menu item
 */
	function menuTitle( $name, $id, $href = FALSE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> __($name, 'wp-my-admin-bar'),
			'id' 	=> $id,
			'href' 	=> $href )
		);
	}

/**
 * Group Sites and Sites Menu
 */
	function menuOption( $name, $id, $root_menu, $href = FALSE ) {
		global $wp_admin_bar, $blog_id;

		$wp_admin_bar->add_group( array(
			'parent' => $root_menu,
			'id'     => 'my_site_list',
			'meta'   => array( 'class' => 'ab-sub-secondary' ) )
		);

		$wp_admin_bar->add_menu( array(
			'title' 	=> $name,
			'id' 		=> $id,
			'parent' => 'my_site_list',
			'href' 	=> $href )
		);
	}

/**
 * Network Admin Menu Item
 */
	function networkAdmin( $href, $id, $root_menu ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> __('My Network Admin', 'wp-my-admin-bar'),
			'id' 		=> $id,
			'parent' => $root_menu,
			'href' 	=> $href )
		);
	}

/**
 * Network Admin Site Menu Link
 */
	function networkSite( $href, $id, $root_menu, $meta = TRUE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> ''. __('Visit This Website', 'wp-my-admin-bar') .' &raquo;',
			'href' 	=> $href,
			'id' 		=> $id,
			'parent' => $root_menu,
			'meta' 	=> array( 'target' => '_blank' ) )
		);
	}
/**
 * Sub Menu to Item
 */
	function menuSelect( $id, $name, $link, $root_menu, $meta = FALSE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'id' 		=> $id,
			'title' 	=> '<span style="display:none;">'. $root_menu .'</span>&bull; '. __($name, 'wp-my-admin-bar') .' &raquo;',
			'href' 	=> $link,
			'parent' => $root_menu,
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

	function externalItem( $name, $link, $root_menu, $meta = TRUE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_menu( array(
			'title' 	=> $name,
			'href' 	=> $link,
			'parent' 	=> $root_menu,
			'meta' 	=> array( target => '_blank' ) )
		);
	}
 */
/**
 * Build The Menu
 */
	function menuSites() {
	/** Modified for version 0.1.7
		if ( !is_user_logged_in() ) { return; }
		if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }
	*/
		if ( !is_user_logged_in() && !is_admin_bar_showing() ) { return; }
		if ( !current_user_can('manage_options') && !is_user_member_of_blog() ) { return; }

		if ( function_exists('is_multisite') && is_multisite()) {
			global $blog_id;

			/* My Sites Menu */
			$this->menuTitle( "My Sites", "menutitle" );
			/* Network Menu */
			if ( is_super_admin() ) { /* Added for Version 0.1.7 */
				$this->networkAdmin( network_admin_url(), "networkmenu", "menutitle" );
				$this->menuSelect( "networkAdmin01", "Dashboard", network_admin_url(), "networkmenu" );
				$this->menuSelect( "networkAdmin02", "Network Home", network_home_url( 'wp-admin/' ), "networkmenu" );
				$this->menuSelect( "networkAdmin03", "Edit This Site", network_admin_url( "site-info.php?id=$blog_id" ), "networkmenu" );
				$this->menuSelect( "networkAdmin04", "Show Sites", network_admin_url( 'sites.php' ), "networkmenu" );
				$this->menuSelect( "networkAdmin05", "Users Admin", network_admin_url( 'users.php' ), "networkmenu" );
				$this->menuSelect( "networkAdmin06", "Themes Admin", network_admin_url( 'themes.php' ), "networkmenu" );
				$this->menuSelect( "networkAdmin07", "Plugins Admin", network_admin_url( 'plugins.php' ), "networkmenu" );
				$this->menuSelect( "networkAdmin08", "Settings Admin", network_admin_url( 'settings.php' ), "networkmenu" );
				$this->menuSelect( "networkAdmin09", "Log Out", get_home_url( $blog_id, '/wp-login.php?action=logout' ), "networkmenu" );
			}

			/* Visit This Website Menu */
			if ( !is_network_admin() ) {
				$this->networkSite( get_home_url( $blog_id, '/' ), "sitejumpmenu", "menutitle" );
				$this->menuSelect( "thissite00", "Dashboard", get_admin_url( $blog_id ), "sitejumpmenu" );
					if ( current_user_can_for_blog( $blog_id, 'edit_posts' ) ) {
						$this->menuSelect( "thissite01", "Visit Site", get_home_url( $blog_id, '/' ), "sitejumpmenu" );
						$this->menuSelect( "thissite02", "Log Out", get_home_url( $blog_id, '/wp-login.php?action=logout' ), "sitejumpmenu" );
						$this->menuSelect( "thissite03", "Add Content", "", "sitejumpmenu" );
						$this->menuSelect( "thissite04", "Add Post", get_admin_url( $blog_id, 'post-new.php' ), "sitejumpmenu" );
						$this->menuSelect( "thissite05", "Add Page", get_admin_url( $blog_id, 'post-new.php?post_type=page' ), "sitejumpmenu" );
						$this->menuSelect( "thissite06", "Add Media", get_admin_url( $blog_id, 'media-new.php' ), "sitejumpmenu" );
						//$this->menuSelect( "thissite07", "Add Link", get_admin_url( $blog_id, 'link-add.php' ), "sitejumpmenu" );
						$this->menuSelect( "thissite08", "Posts and Pages", "", "sitejumpmenu" );
						$this->menuSelect( "thissite09", "View Posts", get_admin_url( $blog_id, 'post-new.php' ), "sitejumpmenu" );
						$this->menuSelect( "thissite10", "View Drafts", get_admin_url( $blog_id, 'edit.php?post_status=draft&post_type=post' ), "sitejumpmenu" );
						$this->menuSelect( "thissite11", "View Pages", get_admin_url( $blog_id, 'edit.php?post_type=page' ), "sitejumpmenu" );
							if ( current_user_can('manage_options') ) {
								$this->menuSelect( "thissite12", "Administration", "", "sitejumpmenu" );
								$this->menuSelect( "thissite13", "Appearance Admin", get_admin_url( $blog_id, 'themes.php' ), "sitejumpmenu" );
								$this->menuSelect( "thissite14", "Plugins Admin", get_admin_url( $blog_id, 'plugins.php' ), "sitejumpmenu" );
								$this->menuSelect( "thissite15", "Users Admin", get_admin_url( $blog_id, 'users.php' ), "sitejumpmenu" );
								$this->menuSelect( "thissite16", "Settings Admin", get_admin_url( $blog_id, 'options-general.php' ), "sitejumpmenu" );
							 }
					}
			}

			/* Presets */
				$blue_wp_logo_url = includes_url('images/wpmini-blue.png');
				$blavatar = '<img src="' . esc_url( $blue_wp_logo_url ) . '" alt="' . esc_attr__( 'Blavatar' ) . '" width="16" height="16" class="blavatar"/>';

			/* MyFunctions Class */
				$my_functions_class = new MyFunctions();
				$check_custom_option = $my_functions_class->option_wp_mycustom();	/* get option values */
				$custom_option = $my_functions_class->wp_mycustom_status();			/* check if option */
				$site_list = $my_functions_class->get_my_site_list();					/* db query or transient */

			/* Build Each Sites Menu */
			foreach ( $site_list as $site ) {
				switch_to_blog( $site->blog_id );

				/** Modified for version 0.1.7
					$siteUrl = site_url();
					$website = parse_url( $siteUrl );
					$website = $website['host'];
					$website = ucfirst( $website );
				*/
					$website = get_bloginfo('name');

						if ( $check_custom_option['wpicon'] == "hide" && $check_custom_option['siteids'] == "hide" ) {
							$new_site_name = $website;
						}

						if ( $check_custom_option['wpicon'] == "hide" && $check_custom_option['siteids'] == "show" ) {
							$siteids = '('. $site->blog_id .') ';
							$new_site_name = $siteids . $website;
						}

						if ( $check_custom_option['wpicon'] == "show" && $check_custom_option['siteids'] == "show" ) {
							$siteids = '('. $site->blog_id .') ';
							$new_site_name = $blavatar . $siteids . $website;
						}

						if ( $check_custom_option['wpicon'] == "show" && $check_custom_option['siteids'] == "hide" ) {
							$siteids = '('. $site->blog_id .') ';
							$new_site_name = $blavatar . $website;
						}
						
						if ( !$custom_option ) {
							$new_site_name = $blavatar . $website;
						}			

					/* Website Menus */
						if ( current_user_can_for_blog( $site->blog_id, 'edit_posts' ) ) { /* Moved for Version 0.1.7 */
							$this->menuOption( $new_site_name, $site->blog_id, "menutitle" );
							$this->menuSelect( 'Dashboard-'. $site->blog_id .'-m', "Dashboard", get_admin_url( $site->blog_id ), $site->blog_id );
							$this->menuSelect( 'VisitSite-'. $site->blog_id .'-m', "Visit Site", get_home_url( $site->blog_id, '/' ), $site->blog_id );
							$this->menuSelect( 'Comments-'. $site->blog_id .'-m', "View Comments", get_admin_url( $site->blog_id, 'edit-comments.php' ), $site->blog_id );
							$this->menuSelect( 'AddContent-'. $site->blog_id .'-m', "Add Content", "", $site->blog_id );
							$this->menuSelect( 'AddPost-'. $site->blog_id .'-m', "Add Post", get_admin_url( $site->blog_id, 'post-new.php' ), $site->blog_id );
							$this->menuSelect( 'AddPage-'. $site->blog_id .'-m', "Add Page", get_admin_url( $site->blog_id, 'post-new.php?post_type=page' ), $site->blog_id );
							$this->menuSelect( 'AddMedia-'. $site->blog_id .'-m', "Add Media", get_admin_url( $site->blog_id, 'media-new.php' ), $site->blog_id );
							//$this->menuSelect( 'AddLink-'. $site->blog_id .'-m', "Add Link", get_admin_url( $site->blog_id, 'link-add.php' ), $site->blog_id );
							$this->menuSelect( 'PostsandPages-'. $site->blog_id .'-m', "Posts and Pages", "", $site->blog_id );
							$this->menuSelect( 'ViewPosts-'. $site->blog_id .'-m', "View Posts", get_admin_url( $site->blog_id, 'edit.php' ), $site->blog_id );
							$this->menuSelect( 'ViewDrafts-'. $site->blog_id .'-m', "View Drafts", get_admin_url( $site->blog_id, 'edit.php?post_status=draft&post_type=post' ), $site->blog_id );
							$this->menuSelect( 'ViewPages-'. $site->blog_id .'-m', "View Pages", get_admin_url( $site->blog_id, 'edit.php?post_type=page' ), $site->blog_id );
								if ( current_user_can('manage_options') ) {							
									$this->menuSelect( 'Administration-'. $site->blog_id .'-m', "Administration", "", $site->blog_id );
									$this->menuSelect( 'AppearanceAdmin-'. $site->blog_id .'-m', "Appearance Admin", get_admin_url( $site->blog_id, 'themes.php' ), $site->blog_id );
									$this->menuSelect( 'PluginsAdmin-'. $site->blog_id .'-m', "Plugins Admin", get_admin_url( $site->blog_id, 'plugins.php' ), $site->blog_id );
									$this->menuSelect( 'UsersAdmin-'. $site->blog_id .'-m', "Users Admin", get_admin_url( $site->blog_id, 'users.php' ), $site->blog_id );
									$this->menuSelect( 'SettingsAdmin-'. $site->blog_id .'-m', "Settings Admin", get_admin_url( $site->blog_id, 'options-general.php' ), $site->blog_id );
								}
						} /* end if */
				restore_current_blog();
			} /* end foreach */

		}else{ /* Not Multisite */
			/* My Sites Menu */
			$this->menuTitle( "My Site", "menutitle" );
				if ( function_exists('is_multisite') && is_multisite() ) {
					$this->networkSite( get_home_url( 1, '/' ), "sitejumpmenu", "menutitle" );
				}
			$this->menuSelect( "Dashboard", get_admin_url( 1 ), "menutitle" );
			$this->menuSelect( "Visit Site", get_home_url( 1, '/' ), "menutitle" );
				if ( false === ( function_exists('is_multisite') && is_multisite() ) ) {
					$this->menuSelect( "Log Out", get_home_url( $blog_id, '/wp-login.php?action=logout' ), "menutitle" );
				}

				if ( current_user_can_for_blog( 1, 'edit_posts' ) ) {
					$this->menuSelect( "Add Content", "", "menutitle" );
					$this->menuSelect( "Add Post", get_admin_url( 1, 'post-new.php' ), "menutitle" );
					$this->menuSelect( "Add Page", get_admin_url( 1, 'post-new.php?post_type=page' ), "menutitle" );
					$this->menuSelect( "Add Media", get_admin_url( 1, 'media-new.php' ), "menutitle" );
					//$this->menuSelect( "Add Link", get_admin_url( 1, 'link-add.php' ), "menutitle" );
					$this->menuSelect( "Posts and Pages", "", "menutitle" );
					$this->menuSelect( "View Posts", get_admin_url( 1, 'post-new.php' ), "menutitle" );
					$this->menuSelect( "View Drafts", get_admin_url( 1, 'edit.php?post_status=draft&post_type=post' ), "menutitle" );
					$this->menuSelect( "View Pages", get_admin_url( 1, 'edit.php?post_type=page' ), "menutitle" );
					$this->menuSelect( "Administration", "", "menutitle" );
					$this->menuSelect( "Appearance Admin", get_admin_url( 1, 'themes.php' ), "menutitle" );
					$this->menuSelect( "Plugins Admin", get_admin_url( 1, 'plugins.php' ), "menutitle" );
					$this->menuSelect( "Users Admin", get_admin_url( 1, 'users.php' ), "menutitle" );
					$this->menuSelect( "Settings Admin", get_admin_url( 1, 'options-general.php' ), "menutitle" );
				} /* end if */
		} /* end multisite */
	} /* end function */
} /* end class */
?>