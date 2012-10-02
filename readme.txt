=== Wp My Admin Bar ===
Plugin Name: WP My Admin Bar | Admin Bar
Contributors: tribalNerd, Chris Winters
Donate link: http://technerdia.com/projects/contribute.html
Tags: myadminbar, wpmyadminbar, plugin, admin, administration, adminbar, toolbar, toolbars, bar, network, multisite, tools, cache, sites, technerdia
Requires at least: 3.3
Tested up to: 3.4.2
Stable tag: 0.1.8


The 'Wp My Admin Bar' Plugin is a Multisite Plugin, which expands on the default Wordpress Admin Bar, adding 3 new quick access menus.

== Description ==

The Wp My Admin Bar Plugin is a Multisite Plugin, which expands on the default Wordpress Admin Bar, adding 3 new quick access menus.

The Plugin does not remove or disable the current Admin Bar. The menus are added to the current admin bar, which allows the built in Wordpress security features and Admin Bar features to function as you would expect.

### 3 New Menus:

* My Sites: Extended menu options, posts, pages, media, plugins, settings, etc...
* My Cache: Allows for quick access to selected Cache Plugins.
* My Tools: Web tools for WP Developers and Bloggers.

Other Features Include: Being able to remove the Wordpress Logo from the Admin Bar, remove the Howdy statement and for multisite setups: Remove the WP Icon from the My Sites menu and replace it with Site ID's.

### Plugin works with and has been tested on:

* Multisite - Network Activated
* Multisite - Site Activated
* Standalone Installs (non-multisite)

### Download > Install > Network Activate / Site Activate > Settings (Network / perSite) > Admin Bar

[Submit Feedback For Improvements](http://technerdia.com/feedback.html) | 
[Screenshots](http://technerdia.com/projects/adminbar/screenshots.html) | 
[Plugin Home](http://technerdia.com/projects/adminbar/plugin.html)



== Installation ==
[View the Install Guide](http://technerdia.com/projects/adminbar/plugin.html) | 
[Screenshots](http://technerdia.com/projects/adminbar/screenshots.html) | 
[Feedback](http://technerdia.com/feedback.html)

### Install through the Wordpress Admin

* It is recommended that you use the built in Wordpress installer to install plugins.
	* Multisite Networks: Network Admin > Plugins Menu > Add New Button
	* Standalone Wordpress: Site Dashboard > Plugins Menu > Add New Button
* In the Search box, enter: My Admin Bar
* Click Install Now and proceed through the plugin setup process.
	* Activate / Network Activate the plugin when asked.
	* If you have returned to the Plugin Admin, locate "WP My Admin Bar" Plugin and click the Activate link.

### Upload and Install

* If uploading, upload the /wp-my-admin-bar/ folder to /wp-content/plugins/ folder for your Worpdress install.
* Then open the Wordpress Admin:
	* Multisite Networks: Network Admin > Plugins Menu
	* Standalone Wordpress: Site Dashboard > Plugins Menu
* Locate the WP My Admin Bar Plugin in your listing of plugins. (sort by Inactive)
* Click the Activate link to start the plugin.


### To Configure:

* Multisite Network: Access the Network Admin > Settings > Admin Bar - Network settings adjust all Websites within the Network.
* Multisite Standalone Website: Site Dashboard > Settings > Admin Bar - Only adjusts this Websites settings but can be overwritten by Network admin.
* Standalone Wordpress: Site Dashboard > Settings > Admin Bar - Adjusts this Websites Admin Bar settings.


### Menu Settings:

* The "Menu Display Options" controls the "My Sites" "My Cache" and "My Tools" menu display on the Admin Bar.
	* Select either [show] or [hide] for each menu that you would like to use.
* The "My Cache Menu Display Options" displays the items within the "My Cache" menu.
	* Select [show] ONLY if this Wordpress install uses the listed Cache Plugin.


### My Cache Menu:

* By default the My Cache menu and options are hidden. (turned off)
	* Turn on the My Cache menu under the Menu Display Options settings section.
	* Adjust which cache plugins display under the My Cache Menu Display Options.


### Custom Settings (Network, Standalone Activation)

Access the Custom Settings Tab:

* Multisite Networks: Network Admin > Settings > Admin Bar > Custom Settings Tab
* Multisite Standalone Websites: Dashboard > Settings > Admin Bar > Custom Settings Tab
* Standalone Wordpress: Dashboard > Settings > Admin Bar > Custom Settings Tab

The Custom Settings Tab allows you to adjust the display of the Wordpress Logo and Howdy statement within the Admin Bar.

For Multisite Setups: Remove the WP Icon from the Menus and replace it with Site ID's. This makes the menus snap open a bit faster.

* Recommended Setting For Networks: Hide the first 3 options (WP logo, Howdy, and WP Icon). Select show for Site ID's.



== Frequently Asked Questions ==
[F.A.Q.](http://technerdia.com/projects/adminbar/faq.html) | 
[Screenshots](http://technerdia.com/projects/adminbar/screenshots.html) | 
[Feedback](http://technerdia.com/feedback.html)

### Frequently Asked Questions:

= Q) Which Wordpress Setups does the WP My Admin Bar work with? =

A) It works with, all Multisite Setups (not multi-user at this time), and Standalone Wordpress.org Installs.


= Q) Does the plugin have a Network Settings page? =

A) Yes, you can access it via the Network Admin > Settings > Admin Bar


= Q) Does changing the Network Settings override the Website Settings? =

A) Yes! After you Network Activate the plugin, adjust the settings within the Network Admin. Then don't touch them again! After that, if a Website is missing a feature or needs a feature, access that websites admin bar settings page to adjust that Website only.


= Q) I don't have a Cache Plugin installed, should I use one of the listed Plugins? =

A) Yes!!! If you use Multisite use: Super Cache + Widget Cache. Non-Multisite setups use: Total Cache + Widget Cache
	- Wp Minify and DB Cache are optional plugins that may or may not work for you, depending on your setup, themes, and other junk.


= Q) If I disable the plugin are the options deleted? =

A) No, disabling keeps everything in place. However, deleting the plugin (through the Wordpress Admin) will remove all settings.


= Q) If I upgrade from Standalone Wordpress to Multisite, will I lose my settings? =

A) I'm not sure, however it's only one Website, setting it back will only take a few seconds.


= Q) If I activate the Plugin via a Network Website, then Network activate it, will I lose my Websites settings? =

A) No, not until you update the Network Admin Settings directly.


= Q) What's a fast Load Time? =

A) First, the load time includes much more than just the menus or the settings page load time. Many/Most Wordpress Plugins load scripts & itself, while in the Wordpress Admin, when many don't need to be loaded, this is what typically makes a Wordpress Admin hang for a few seconds. So to answer the question, it greatly depends on your Internet connection, the Host Wordpress is on, server specs, the plugins/scripts that load with Wordpress and a ton of other stuff. However, anything in the .5 range (1/2 second) or below is pretty decent for a Wordpress Admin.



[Frequently Asked Questions](http://technerdia.com/projects/adminbar/faq.html)

== Arbitrary section ==

[View the Install Guide](http://technerdia.com/projects/adminbar/plugin.html) | 
[Screenshots](http://technerdia.com/projects/adminbar/screenshots.html) | 
[Feedback](http://technerdia.com/feedback.html)

### About The Settings:

### Option Data:

The Option Data display shows you exactly what is being stored on your Wordpress install.

* The "Wp MyAdminBar" option contains the show/hide rules for the My Sites, Cache and Tools Menus.
* The "My Cache Option" contains the show/hide rules for the My Cache menu.

* Output Buffering: The settings pages use ob_gzhandler to compress the output of the settings pages.
* Transient Cache: Transients are used to store the results of the blog id query that builds the menus.

* References: The Wordpress Functions this Plugin utilizes.
* Load Time: This was used to make sure I wasn't screwing up..... it's a fun toy, so I left it in.

Custom Settings Tab

* Option Value: Option contains the rules for the Wp Logo, WP Icon, Howdy statement and Site Id's being added to the Menus.


** NOTE: Disabling this plugin does not remove the options. Deleting the plugin, through Wordpress, deletes the options.


### Plugin Wishlist:

* Make My-Sites sub-menus float to center or force align bottom.
* My Sites Menu: Ability to disable options.
* My Cache Menu: Ability to add unique cache plugin information.
* My Tools Menu: Ability to add/disable options.
* Network admin: Display for admin only, users, authors, etc.
* Network admin: Allow other admins / registered users to have a custom MyAdminBar.
* Network admin: Add view/adjust settings per user.
* Network admin: MyAdminBar Positions.
* Network admin: MyAdminBar Transparency.
* Menus: Add max number of sites to display in My Sites & My Cache.
* Menus: Either - Add pages to menus, group menus into sub-sub-groups, or custom load fake menu to select active site (group) list.
* Menus: Disable query on menus until menu option is activated.



== Changelog ==
Alpha Release
= 0.1.7 =
* Created new option wp_myadminbar_nw to allow site id 1 and network admin to use different settings.
* Created new option wp_cache_nw to allow site id 1 and network admin to use different settings.
* settings_sites.php template, corrected php debug index errors.
* settings_network.php template, corrected php debug index errors.
* settings_sites.class.php corrected php debug index errors.
* settings_network.class.php adjusted $my_menus to use new wp_myadminbar_nw option.
* settings_network.class.php adjusted $my_cache to use new wp_cache_nw option.
* settings_network.class.php corrected php debug index errors.
* my_tools.class.php adjusted to allow menu to display for non-super admins.
* my_sites.class.php adjusted sitename in dropdown to use get_bloginfo('name').
* my_sites.class.php adjusted to allow non-super admins to manage options.
* my_cache.class.php adjusted sitename in dropdown to use get_bloginfo('name').
* my_cache.class.php adjusted to allow non-super admins to manage options.
* Added new calls for wp_myadminbar_nw and wp_myadminbar_nw_status in my_admin_bar.class.php.
* Added new calls for wp_cache_nw and wp_cache_nw_status in my_admin_bar.class.php.
* functions.class.php settingsPage class to allow non-super admins to manage settings page.
* New functions_wp_myadminbar_nw and wp_myadminbar_nw_status added to function.class.php.
* New functions_wp_cache_nw and wp_cache_nw_status added to function.class.php.
* Adjusted uninstall.php and activate.php to contain new wp_myadminbar_nw and wp_cache_nw options.

= 0.1.6 =
* Corrected menu link: My Sites > Visit This Site > View Posts - Now opens the proper edit.php page.
* Corrected issue with admin bar menu options displaying to logged in users.
* Removed ob_gzhandler

= 0.1.5 =
* Files missing in repository.
* Corrected deleted files.

= 0.1.4 =
* Added wp_nonce_field and check_admin_referer to setting pages & templates.
* Corrected Network Menu var that made the Network Dashboard link not appear.
* Added is_admin and is_network_admin rather than parsing the urls.
* Made sure setting pages & links only load within admins, for proper users.
* Cleaned my_sites, cache & tools menus, made menu calls simpler.
* Removed default Site Menu and replaced with Visit This Website in main My Sites menu.
* Adjusted My Sites menu name on non-multisite Installs.
* Cleaned gettext calls for various menu text options.
* Added new SEO Tool
* Sidebar: Added newly used functions and some new text.
* Added tabs to Network Admin, creating a Custom Settings tab.
* Made settings tab display for Network active, multisite per-site active and standalone wp installs.
* Expanded settings_network.php & settings_sites.php to include new tab.
* New custom settings: hide/show the Wordpress Logo, Howdy, Handle, WP Icon in Menus and display Site ID's next to Sites.
* Added new 'Visit this Website' menu with extended 'This Site' menu options.
	* Note: The Visit This Website menu does not display within the Network Admin or Standalone WP installs.
* Created log-out links within: My Network Admin menu, the Visit this Website menu, and on Standalone WP installs.
* Made several variable names and calls more descriptive, added more comments.
* Modified my_admin_bar.classes.php to become my_admin_bar.class.php - adding a new class call the my_sites, cache and tools menu.
* Corrected issue with uninstall and deactivation not working on multisite standalone site activations.
* Better functionality for standalone wordpress installs.
* Created new file: function.class.php which contains repeat used functions and standalone classes.
* Adjusted repeat calls in the code to use the repeat functions in the new function.class.php file.
* Created upgrade.php: Auto upgrades old option value names to the new names, only runs once.

= 0.1.3 =
* Screenshot correction, again.
* Added release tag to main file.

= 0.1.2 =
* Added root Site Name display back to Admin Bar.
* Generated POT file and set domain for gettext calls.
* Added link to Plugin in settings_sidebar template.
* Screenshot added, I think.

= 0.1.1 =
* Testing how the svn works.
* Corrected display of New Post Option under My Sites menu.
* Corrected wp_blogs to use $wpdb->blogs
* Updates to: Spelling, readme.txt layout, plugin url added.

= 0.1 =
* Created: Feb 12, 2012



== Upgrade Notice ==
= 0.1.4 =
* Release Published
* Tested on WP 3.3.1 Multisite Network, Network Site and Standalone WP Installs.
* upgrade.php added: Updates active Option(s) to use new, shorter, var names.
	* Only updates if old style is found.

= 0.1.3 =
* Release Published



== Screenshots ==

- More Screenshots --> http://technerdia.com/projects/adminbar/screenshots.html

1. Collage of Wp My Admin Bar Features.
