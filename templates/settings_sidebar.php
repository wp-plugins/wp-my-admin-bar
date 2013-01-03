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
if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */
?>
<div class="inner-sidebar">
	<div class="postbox">
		<h3><span><?php _e('The WP-MyAdminBar', 'wp-my-admin-bar');?></span></h3>
			<div class="inside">
				<ul>
					<li>&bull; <a href="http://technerdia.com/projects/adminbar/plugin.html" target="_blank"><?php _e('Plugin Home Page', 'wp-my-admin-bar');?></a> : Project Details</li>
					<li>&bull; <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank"><?php _e('Plugin at Wordpress.org', 'wp-my-admin-bar');?></a> : WP-MyAdminBar</li>
					<li>&bull; <a href="http://wordpress.org/tags/wp-my-admin-bar" target="_blank"><?php _e('Support Forum', 'wp-my-admin-bar');?></a> : Problems, Questions?</li>
					<li>&bull; <a href="http://technerdia.com/feedback.html" target="_blank"><?php _e('Submit Feedback', 'wp-my-admin-bar');?></a> : I'm Listening!</li>
				</ul>
			</div> <!-- end inside -->
	</div> <!-- end postbox -->

	<div class="postbox">
		<h3><span><?php _e('Show Some Love', 'wp-my-admin-bar');?>!</span></h3>
			<div class="inside">
				<ul>
					<li><strong>&raquo; <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank"><?php _e('Please Rate This Plugin', 'wp-my-admin-bar');?>!</a></strong><br />It only takes a few seconds to <a href="http://wordpress.org/extend/plugins/wp-my-admin-bar/" target="_blank">rate this plugin</a>! Your rating helps create motivation for future developments!</li>
					<li style="text-align:center;"><br /><p><strong><?php _e('Thank You For Your Support', 'wp-my-admin-bar');?>!</strong></p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="ZC85KWHZDA9DQ">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Donate">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
					<p><small>Donate To The Wp-MyToolBar Project Directly!</small></p></li>
				</ul>
			</div> <!-- end inside -->
	</div> <!-- end postbox -->

	<div class="postbox">
		<h3><span><?php _e('Notice', 'wp-my-admin-bar');?></span></h3>
			<div class="inside">
				<ul>
					<li><?php _e('Disabling this plugin does delete the plugin settings. Deleting this plugin, through Wordpress, deletes all plugin related settings.', 'wp-my-admin-bar');?></li>
				</ul>
			</div> <!-- end inside -->
	</div> <!-- end postbox -->

</div> <!-- end inner-sidebar -->