=== Wp My Admin Bar ===
Plugin Name: WP My Admin Bar | WP-MyAdminBar
Contributors: tribalNerd, Chris Winters
Donate link: http://technerdia.com/projects/contribute.html
Tags: myadminbar, wpmyadminbar, plugin, admin, administration, adminbar, toolbar, toolbars, bar, network, multisite, tools, cache, sites, technerdia
Requires at least: 3.3
Tested up to: 3.3.1
Stable tag: 0.1.1

The 'WP-MyAdminBar' Plugin is a multisite plugin that recreates the default Wordpress Admin Bar.

== Description ==

The 'WP-MyAdminBar' Plugin is a multisite plugin that recreates the default Wordpress Admin Bar.

Three new Menus are created:

* My Sites: On multisite installs all sites display with extended menu options.
	* On standalone WP installs, the extended menu options are displayed.
* My Cache: Allows for quick access to all sites Cache Plugins.
* My Tools: Web tools for WP Developers and Bloggers.

[Feedback](http://technerdia.com/feedback.html) | 
[Plugin Home](http://technerdia.com/projects/adminbar/plugin.html)



== Installation ==
[View the Install Guide](http://technerdia.com/projects/adminbar/plugin.html) | 
[Feedback](http://technerdia.com/feedback.html)


* It is recommended that you use the built in Wordpress Installer to install plugins.
* If uploading, upload the /wp-my-admin-bar/ folder to /wp-content/plugins/ folder for your Worpdress install.
* Activate the plugin through the Plugins Menu or Network Plugins Menu within WordPress.
* That's It!


Configure:

* Multisite Network: Access the Network Admin > Settings > Admin Bar - Network settings adjust all Websites within the Blog Network.
* Multisite Standalone Website: Site Dashboard > Settings > Admin Bar - Only adjusts this Websites Settings but can be overwritten by Network Admin.
* Standalone Wordpress: Site Dashboard > Settings > Admin Bar - Only adjusts this Websites Settings.


Admin Bar Settings Page:

* The "Menu Display Options" is the "My Sites" "My Cache" and "My Tools" menus displayed on the Admin Bar.
	* Select either [show] or [hide] for each menu that you would like to use.
* The "My Cache Menu Display Options" displays the items within the "My Cache" menu.
	* Select [show] ONLY if this Wordpress install uses the listed Cache Plugin.


My Cache:

By default the My Cache menu and options are hidden (turned off)


== Frequently Asked Questions ==
[F.A.Q.](http://technerdia.com/projects/adminbar/faq.html) | 
[Feedback](http://technerdia.com/feedback.html)

Frequently Asked Questions:

* Q) Does WP My Admin Bar work with both multisite, single multisite websites/blogs and non-multisite Wordpress installs?
* A) Yes, it works with them all and has been tested across each situation.

* Q) Does the plugin have a Network Settings page?
* A) Yes, you can access it via the Network Admin > Settings > Admin Bar

* Q) What's a fast Load Time?
* A) That greatly depends on your hosting, server, setup, and a ton of other stuff. However, anything below .5 is pretty decent for a Wordpress Admin.

* Q) I don't have a Cache Plugin installed, should I use one of the listed Plugins?
* A) Yes!!! If you use Multisite use: Super Cache + Widget Cache. Non-Multisite setups use: Total Cache + Widget Cache
	- Wp Minify and DB Cache are optional plugins that may or may not work for you, depending on your setup, themes, and other junk.



== Arbitrary section ==

[View the Install Guide](http://technerdia.com/projects/adminbar/plugin.html) | 
[Feedback](http://technerdia.com/feedback.html)

About The Settings:

Option Data:

The Option Data display shows you exactly what is being stored on your Wordpress install.

* The "Wp MyAdminBar" option contains the show/hide rules for the My Sites, Cache and Tools Menus.
* The "My Cache Option" contains the show/hide rules for the My Cache menu.

* Output Buffering: The settings pages use ob_gzhandler to compress the output of the settings pages.
* Transient Cache: Transients are used to store the results of the blog id query that builds the menus.

* References: The Wordpress Functions this Plugin utilizes.
* Load Time: This was used to make sure I wasn't screwing up..... it's a fun toy, so I left it in.


NOTE: Disabling or deleting this plugin, through the WP Administration area, deletes the option values for all Websites within the Network.


Plugin Wishlist:

* Make My-Sites sub-menus float to center or force align bottom.

* My Sites Menu: Ability to disable options.

* My Cache Menu: Ability to add unique cache plugin information.

* My Tools Menu: Ability to add/disable options.

* Network admin: Display for admin only, users, authors, etc.

* Network admin: Allow other admins / registered users to have a custom MyAdminBar.

* Network admin: Add view/adjust settings per site.

* Network admin: Add view/adjust settings per user.

* Network admin: MyAdminBar Positions.

* Network admin: MyAdminBar Transparency.

* Menus: Add max number of sites to display in My Sites & My Cache.

* Menus: Either - Add pages to menus, group menus into sub-sub-groups, or custom load fake menu to select active site (group) list.

* Menus: Disable query on menus until menu option is activated.



== Changelog ==
Alpha

= 0.1.1 =
* Testing how the svn works.
* Corrected display of New Post Option under My Sites menu.
* Corrected wp_blogs to use $wpdb->blogs
* Updates to: Spelling, readme.txt layout, plugin url added.
* Generated POT file and set domain for gettext calls.

= 0.1 =
* Created: Feb 12, 2012


== Upgrade Notice ==
No Upgrade Information At This Time


== Screenshots ==
[Screen Shots](http://technerdia.com/projects/adminbar/screenshots.html) | 
[Feedback](http://technerdia.com/feedback.html)

1) My Sites, My Cache and My Tools Menu

2) Extended Network Admin Menu

3) Extended Site Menu Options

4) Quick Cache Access Menu

5) Tools Menu for Developers

6) Site Settings Admin

7) Network Settings Admin
