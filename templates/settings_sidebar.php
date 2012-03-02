<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1.2
 */
if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */
?>
<div class="inner-sidebar">
	<div class="postbox">
		<h3><span><?php _e('The WP-MyAdminBar', 'wp-my-admin-bar');?></span></h3>
			<div class="inside">
				<ul>
					<li>&bull; <a href="http://technerdia.com/projects/adminbar/plugin.html" target="_blank"><?php _e('Plugin Home Page', 'wp-my-admin-bar');?></a></li>
					<li>&bull; <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank"><?php _e('Plugin at Wordpress.org', 'wp-my-admin-bar');?></a></li>
					<li>&bull; <a href="http://technerdia.com/feedback.html" target="_blank"><?php _e('Submit Feedback', 'wp-my-admin-bar');?></a></li>
				</ul>
			</div> <!-- end inside -->
	</div> <!-- end postbox -->

	<div class="postbox">
		<h3><span><?php _e('Show Some Love', 'wp-my-admin-bar');?>!</span></h3>
			<div class="inside">
				<ul>
					<li><strong>&raquo; <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank"><?php _e('Please Rate This Plugin', 'wp-my-admin-bar');?>!</a></strong></li>
					<li style="text-align:center;"><p><strong><?php _e('Thank You For Your Support', 'wp-my-admin-bar');?>!</strong></p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="ZC85KWHZDA9DQ">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Donate">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form></li>
				</ul>
			</div> <!-- end inside -->
	</div> <!-- end postbox -->

	<div class="postbox">
		<h3><span><?php _e('Wordpress References', 'wp-my-admin-bar');?></span></h3>
			<div class="inside">
				<ul>
					<li><a href="http://codex.wordpress.org/Function_Reference/register_activation_hook" target="_blank">register_activation_hook</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_bloginfo" target="_blank">get_bloginfo</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/register_deactivation_hook" target="_blank">register_deactivation_hook</a>, 
					<a href="http://codex.wordpress.org/Class_Reference/wpdb" target="_blank">wpdb</a>, 
					<a href="http://codex.wordpress.org/I18n_for_WordPress_Developers" target="_blank">I18n</a>, 
					<a href="http://codex.wordpress.org/WPMU_Functions/switch_to_blog" target="_blank">switch_to_blog</a>, 
					<a href="http://codex.wordpress.org/WPMU_Functions/restore_current_blog" target="_blank">restore_current_blog</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_site_transient" target="_blank">get_site_transient</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/delete_site_transient" target="_blank">delete_site_transient</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/set_site_transient" target="_blank">set_site_transient</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_action" target="_blank">add_action</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/delete_option" target="_blank">delete_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_option" target="_blank">add_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_option" target="_blank">get_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/network_admin_url" target="_blank">network_admin_url</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/current_user_can_for_blog" target="_blank">current_user_can_for_blog</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_submenu_page" target="_blank">add_submenu_page</a>, 
					<a href="http://codex.wordpress.org/Function_Reference" target="_blank">all functions</a>, 
					<a href="http://codex.wordpress.org/Template_Tags" target="_blank">all template tags</a>, 
					<a href="http://codex.wordpress.org/Option_Reference" target="_blank">option reference</a>, 
					<a href="http://codex.wordpress.org/Database_Description#Table:_wp_options" target="_blank">database reference</a>.</li>
				</ul>
			</div> <!-- end inside -->
	</div> <!-- end postbox -->

	<div class="postbox">
		<h3><span><?php _e('Load Time', 'wp-my-admin-bar');?></span></h3>
			<div class="inside">
				<ul>
					<li><?php _e('Page and Menus loaded in', 'wp-my-admin-bar');?> <em><?php timer_stop(1);?> <?php _e('seconds', 'wp-my-admin-bar');?></em>.</li>
				</ul>
			</div> <!-- end inside -->
	</div> <!-- end postbox -->
</div> <!-- end inner-sidebar -->