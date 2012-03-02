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

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */
?>
	<div class="wrap" style="width:98%;">
		<h2><?php _e('The WP-MyAdminBar Plugin', 'wp-my-admin-bar');?></h2>
			<div class="updated"><p><strong><em><?php _e('The display options for this page are Network wide. Meaning all sites within the Network will use the settings below. Each site within the Network can have unique display options set by visiting the Admin Bar settings page for that Website.', 'wp-my-admin-bar');?></em></strong></div>
			<div class="metabox-holder has-right-sidebar">
<!-- left side -->
				<div id="post-body"><div id="post-body-content">
					<div class="postbox"><div class="inside">
						<p><?php _e('The WP-MyAdminBar Plugin, replaces and expands the Wordpress Administration Bar, adding a new My Sites menu with extended options, a My Cache menu for quick cache access and My Tools for all WP Developers and Blogger needs.', 'wp-my-admin-bar');?></p>
					</div></div> <!-- end inside and postbox -->

					<div  class="postbox">
						<h3><span><?php _e('Display Settings', 'wp-my-admin-bar');?></span></h3>
							<div class="inside">
								<form method="post" action="<?php echo $_SERVER["REQUEST_URI"];?>">
									<h2><?php _e('Menu Display Options', 'wp-my-admin-bar');?>:</h2>
									<p><strong><?php _e('Display My Sites Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio"  name="show_my_sites" value="show" <?php echo $sites_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="show_my_sites" value="hide" <?php echo $sites_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display My Cache Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio" name="show_my_cache" value="show" <?php echo $cache_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="show_my_cache" value="hide" <?php echo $cache_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display My Tools Menu', 'wp-my-admin-bar');?></strong>: <input class="valinp" type="radio" name="show_my_tools" value="show" <?php echo $tools_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="show_my_tools" value="hide" <?php echo $tools_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><input type="submit" name="myadminbarsave" id="save" class="button" value=" <?php _e('Save', 'wp-my-admin-bar');?> "  /></p>
								</form>

								<hr />

								<form method="post" action="<?php echo $_SERVER["REQUEST_URI"];?>">
									<h2><?php _e('My Cache Menu Display Options', 'wp-my-admin-bar');?>:</h2>
									<p><?php _e('By default all Cache menu options are turn off. Select', 'wp-my-admin-bar');?> [<?php _e('show', 'wp-my-admin-bar');?>] <?php _e('for each cache plugin this Wordpress install uses, this enables a quick link to the selected cache plugin under the My Cache menu.', 'wp-my-admin-bar');?></p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/wp-minify/" target="_blank"><?php _e('Wp Minify', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="toggle_minify" value="show" <?php echo $minify_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="toggle_minify" value="hide" <?php echo $minify_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/db-cache-reloaded-fix/" target="_blank"><?php _e('DB Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="toggle_dbcache" value="show" <?php echo $dbcache_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="toggle_dbcache" value="hide" <?php echo $dbcache_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/wp-widget-cache/" target="_blank"><?php _e('Widget Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="toggle_widget" value="show" <?php echo $widget_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="toggle_widget" value="hide" <?php echo $widget_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/wp-super-cache/" target="_blank"><?php _e('Super Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="toggle_super" value="show" <?php echo $super_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="toggle_super" value="hide" <?php echo $super_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><strong><?php _e('Display', 'wp-my-admin-bar');?> <a href="http://wordpress.org/extend/plugins/w3-total-cache/" target="_blank"><?php _e('Total Cache', 'wp-my-admin-bar');?></a></strong>: <input class="valinp" type="radio" name="toggle_total" value="show" <?php echo $total_on;?> /> [<?php _e('show', 'wp-my-admin-bar');?>]&nbsp;&nbsp;&nbsp;<input class="valinp" type="radio" name="toggle_total" value="hide" <?php echo $total_off;?> /> [<?php _e('hide', 'wp-my-admin-bar');?>]</p>
									<p><input type="submit" name="mycachesave" id="save" class="button" value=" <?php _e('Save', 'wp-my-admin-bar');?> "  /></p>
								</form>
						</div> <!-- end inside -->
				</div> <!-- end postbox -->

				<div  class="postbox">
					<h3><span><?php _e('Option Data', 'wp-my-admin-bar');?></span></h3>
						<div class="inside">
							<p><?php _e('Below is the Option Value that each Website within the Network has by default. Each site on the Network can have unique Options set by visiting the Admin Bar settings page within that Website.', 'wp-my-admin-bar');?></p>
							<ul>
								<li style="overflow:hidden;"><strong><?php _e('Admin Bar Option', 'wp-my-admin-bar');?></strong>: <small><?php echo $ntwrkselect;?></small></li>
								<li style="overflow:hidden;"><strong><?php _e('My Cache Option', 'wp-my-admin-bar');?></strong>: <small><?php echo $ntwrkcache;?></small></li>
								<li><strong><?php _e('Output buffering', 'wp-my-admin-bar');?></strong>: <?php if ( ob_get_contents() ) { _e('In Use', 'wp-my-admin-bar'); }else{ _e('Empty', 'wp-my-admin-bar'); }?></li>
								<li><strong><?php _e('Transient Cache', 'wp-my-admin-bar');?></strong>: <?php if ( get_site_transient( 'multisite_site_list' ) ) { _e('In Use', 'wp-my-admin-bar'); }else{ _e('Empty', 'wp-my-admin-bar'); } ?></li>
							</ul>
						</div> <!-- end inside -->
				</div> <!-- end postbox -->

				<div  class="postbox"><div class="inside">
					<p><?php _e('Disabling or deleting this plugin, through the WP Administration area, deletes the option values for all Websites within the Network.', 'wp-my-admin-bar');?></p>
				</div></div> <!-- end inside and postbox -->

		</div> <!-- end post-body-content -->
			<br /><br /><hr />
			<p align="right"><small><b><?php _e('Created by', 'wp-my-admin-bar');?></b>: <a href="http://technerdia.com/" target="_blank">techNerdia</a></small></p>
		</div> <!-- end post-body -->

<!-- right side -->
<?php include( dirname(__FILE__) . '/settings_sidebar.php' );?>

			</div> <!-- end metabox-holder has-right-sidebar -->
	</div> <!-- end wrap -->