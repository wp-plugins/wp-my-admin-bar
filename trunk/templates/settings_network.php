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
if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */
?>
	<div class="wrap" style="width:98%;">
		<h2><?php _e('WP-MyAdminBar - Network Settings', 'wp-my-admin-bar');?></h2>
<?php if ( isset ( $setting_tabs ) ) { echo $setting_tabs; };?>
			<div class="fade error" id="message" onclick="this.parentNode.removeChild(this)"><p><strong><em><?php _e('The display options for this page are Network wide. Meaning all Websites within this Network will use the settings below.', 'wp-my-admin-bar');?> <?php if ( isset ( $_GET['tab'] ) != "custom_settings" ) { _e('Each Website within a Network can have unique display options set by visiting the Admin Bar settings page for that Website.', 'wp-my-admin-bar'); }?></em></strong></div>
			<div class="metabox-holder has-right-sidebar">
<!-- left side -->
				<div id="post-body"><div id="post-body-content">
					<div class="postbox"><div class="inside">
						<p><?php _e('The WP-MyAdminBar Plugin, expands the Wordpress Administration Bar, adding a new My Sites menu with extended menu options, a My Cache menu for quick cache access and My Tools menu for all WP Developer and Blogger needs.', 'wp-my-admin-bar');?></p>
					</div></div> <!-- end inside and postbox -->
<?php if ( !isset( $_GET['tab'] ) || ( $_GET['tab'] == "menu_settings" ) ) {?>
					<div  class="postbox">
						<h3><span><?php _e('Display Settings', 'wp-my-admin-bar');?></span></h3>
							<div class="inside">
								<h2><?php _e('Menu Display Options', 'wp-my-admin-bar');?>:</h2>
								<p><?php _e('Select [show] for each of the My Menus you would like to turn on.  By default the My Sites &amp; Tools menus have been turned on, and the My Cache menu has been turned off. If your Wordpress Install uses the Cache Plugin(s) listed below, turn on the My Cache Menu then set which Cache Plugin(s) are being used.', 'wp-my-admin-bar');?></p>
								<form method="post" action="">
								<?php wp_nonce_field('my_option_action','my_option_nonce');?>
									<p><strong><?php _e('Display My Sites Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio"  name="my_sites" value="show" <?php if ( isset ( $sites_on ) ) { echo $sites_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="my_sites" value="hide" <?php if ( isset ( $sites_off ) ) { echo $sites_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display My Cache Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio" name="my_cache" value="show" <?php if ( isset ( $cache_on ) ) { echo $cache_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="my_cache" value="hide" <?php if ( isset ( $cache_off ) ) { echo $cache_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display My Tools Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio" name="my_tools" value="show" <?php if ( isset ( $tools_on ) ) { echo $tools_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="my_tools" value="hide" <?php if ( isset ( $tools_off ) ) { echo $tools_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><input type="submit" name="save_my_menus" id="save" class="button" value=" <?php _e('Save', 'wp-my-admin-bar');?> "  /></p>
								</form>

								<hr />

								<h2><?php _e('My Cache Menu Display Options', 'wp-my-admin-bar');?>:</h2>
								<p><?php _e('By default all Cache menu options are turn off. Select', 'wp-my-admin-bar');?> [<?php _e('show', 'wp-my-admin-bar');?>] <?php _e('for each cache plugin this Wordpress install uses, this enables a quick link to the selected cache plugin under the My Cache menu.', 'wp-my-admin-bar');?></p>
								<form method="post" action="">
								<?php wp_nonce_field('my_cache_action','my_cache_nonce');?>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/wp-minify/" target="_blank"><?php _e('Wp Minify', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="minify" value="show" <?php if ( isset ( $minify_on ) ) { echo $minify_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="minify" value="hide" <?php if ( isset ( $minify_off ) ) { echo $minify_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/db-cache-reloaded-fix/" target="_blank"><?php _e('DB Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="dbcache" value="show" <?php if ( isset ( $dbcache_on ) ) { echo $dbcache_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="dbcache" value="hide" <?php if ( isset ( $dbcache_off ) ) { echo $dbcache_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/wp-widget-cache/" target="_blank"><?php _e('Widget Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="widget" value="show" <?php if ( isset ( $widget_on ) ) { echo $widget_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="widget" value="hide" <?php if ( isset ( $widget_off ) ) { echo $widget_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/wp-super-cache/" target="_blank"><?php _e('Super Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="super" value="show" <?php if ( isset ( $super_on ) ) { echo $super_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="super" value="hide" <?php if ( isset ( $super_off ) ) { echo $super_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/w3-total-cache/" target="_blank"><?php _e('Total Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="total" value="show" <?php if ( isset ( $total_on ) ) { echo $total_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="total" value="hide" <?php if ( isset ( $total_off ) ) { echo $total_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><input type="submit" name="save_my_cache" id="save" class="button" value=" <?php _e('Save', 'wp-my-admin-bar');?> "  /></p>
								</form>
						</div> <!-- end inside -->
				</div> <!-- end postbox -->

				<div  class="postbox">
					<h3><span><?php _e('Option Data', 'wp-my-admin-bar');?></span></h3>
						<div class="inside">
							<p><?php _e('The Network Admin contains the real default values for each of the options. Each Website within the Network may have different option values, if that Websites Admin Bar Settings have been uniquely customized.', 'wp-my-admin-bar');?></p>
							<ul>
								<li style="overflow:hidden;"><strong><?php _e('Admin Bar Option', 'wp-my-admin-bar');?></strong>: <small><?php echo $myadminbar_option;?></small></li>
								<li style="overflow:hidden;"><strong><?php _e('My Cache Option', 'wp-my-admin-bar');?></strong>: <small><?php echo $mycache_option;?></small></li>
							</ul>
						</div> <!-- end inside -->
				</div> <!-- end postbox -->

<?php }else{ /* Tab: Custom Settings */?>

				<div  class="postbox">
					<h3><span><?php _e('Custom Settings', 'wp-my-admin-bar');?></span></h3>
						<div class="inside">
							<h2><?php _e('Network Only Settings', 'wp-my-admin-bar');?>:</h2>
							<p>These settings adjust all Websites / Blogs within the Network.</p>
							<form method="post" action="">
							<?php wp_nonce_field('my_custom_action','my_custom_nonce');?>
								<p><strong><?php _e('Display Wordpress Logo on Admin Bar', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio"  name="wplogo" value="show" <?php if ( isset ( $wplogo_on ) ) { echo $wplogo_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="wplogo" value="hide" <?php if ( isset ( $wplogo_off ) ) { echo $wplogo_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
								<p><strong><?php _e('Display Howdy, Handle on Admin Bar', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio"  name="howdy" value="show" <?php if ( isset ( $howdy_on ) ) { echo $howdy_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="howdy" value="hide" <?php if ( isset ( $howdy_off ) ) { echo $howdy_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
								<p><strong><?php _e('Display WP Icon in My Sites/Cache Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio"  name="wpicon" value="show" <?php if ( isset ( $wpicon_on ) ) { echo $wpicon_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="wpicon" value="hide" <?php if ( isset ( $wpicon_off ) ) { echo $wpicon_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
								<p><strong><?php _e('Display Site IDs in My Sites Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio"  name="siteids" value="show" <?php if ( isset ( $siteids_on ) ) { echo $siteids_on; }?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="siteids" value="hide" <?php if ( isset ( $siteids_off ) ) { echo $siteids_off; }?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
								<p><input type="submit" name="save_my_settings" id="save" class="button" value=" <?php _e('Save', 'wp-my-admin-bar');?> "  /></p>
							</form>
						</div> <!-- end inside -->
				</div> <!-- end postbox -->

				<div  class="postbox">
					<h3><span><?php _e('Option Data', 'wp-my-admin-bar');?></span></h3>
						<div class="inside">
							<p><?php _e('Below is the Option Value for the Custom Settings Option.', 'wp-my-admin-bar');?></p>
							<ul>
								<li style="overflow:hidden;"><strong><?php _e('Option Value', 'wp-my-admin-bar');?></strong>: <small><?php echo $mycustom_option;?></small></li>
							</ul>
						</div> <!-- end inside -->
				</div> <!-- end postbox -->

<?php } /* end tab if */?>
		</div> <!-- end post-body-content -->
		</div> <!-- end post-body -->

<!-- right side -->
<?php include( dirname(__FILE__) . '/settings_sidebar.php' );?>

			</div> <!-- end metabox-holder has-right-sidebar -->

			<br style="clear:both;" /><br /><hr />
			<p align="right"><small><b><?php _e('Created by', 'wp-my-admin-bar');?></b>: <a href="http://technerdia.com/" target="_blank">techNerdia</a></small></p>
	</div> <!-- end wrap -->