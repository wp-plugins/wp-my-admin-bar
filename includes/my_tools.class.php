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
 * ==================================== Creates a My Tools menu option in the Admin Toolbar
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

class myTools {
/**
 * Create the Link
 */
	function myTools() {
		if ( ! is_user_logged_in() )
			return;

		if ( !is_user_member_of_blog() && !is_super_admin() )
			return;

		add_action( 'admin_bar_menu', array( $this, "menuTools" ),22 );
	}

/**
 * Set the title of the menu item
 */
	function toolsTitle( $name, $id, $href = FALSE ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'id' 	=> $id,
			'title' 	=> $name,
			'href' 	=> $href )
		);
	}

/**
 * Create the sub menu option
 */
	function toolsOption( $name, $id, $root_menu, $href = FALSE ) {
		global $wp_admin_bar;

		$wp_admin_bar->add_group( array(
			'parent' => $root_menu,
			'id'     => 'my_tool_list',
			'meta'   => array( 'class' => 'ab-sub-secondary' ) )
		);

		$wp_admin_bar->add_menu( array(
			'title' 	=> $name,
			'id' 	=> $id,
			'parent' 	=> 'my_tool_list',
			'href' 	=> $href )
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
	function menuTools() {
		global $wp_admin_bar;

		$tool_type_list = array(
			"keywords" 	=> __('Keyword Tools', 'wp-my-admin-bar'),
			"seo" 		=> __('SEO Tools', 'wp-my-admin-bar'),
			"ranking" 	=> __('Traffic &amp; Rankings', 'wp-my-admin-bar'),
			"validate" 	=> __('Validators', 'wp-my-admin-bar'),
			"monitor" 	=> __('Web Health', 'wp-my-admin-bar'),
			"web" 		=> __('Web Tools', 'wp-my-admin-bar'),
			"words" 		=> __('Word Tools', 'wp-my-admin-bar')
		);

		$this->toolsTitle( "My Tools", "toolsTitle" );

			foreach ( $tool_type_list as $key => $items ) {			
				$this->toolsOption( $items, $key, "toolsTitle" );
			}

					$siteUrl = site_url();
					$website = parse_url( $siteUrl );
					$website = $website['host'];
					$css_url = ''. get_bloginfo( 'template_url' ) .'/style.css';
					$feed_url = get_bloginfo( 'rss2_url' );
				
				/* Menu Text */
					$tool_gookey 	= __('Google Key', 'wp-my-admin-bar');
					$tool_gooinsite = __('Google Insights', 'wp-my-admin-bar');
					$tool_gootrend 	= __('Google Trends', 'wp-my-admin-bar');
					$tool_keymap 	= __('Keyword Map', 'wp-my-admin-bar');
					$tool_keyspy 	= __('Keyword Spy', 'wp-my-admin-bar');
					$tool_metaglos 	= __('Meta Glossary', 'wp-my-admin-bar');
					$tool_seodigg 	= __('SEO Digger', 'wp-my-admin-bar');
					$tool_thesaur 	= __('Thesaurus', 'wp-my-admin-bar');
					$tool_ubersugg 	= __('Uber Suggest', 'wp-my-admin-bar');
					$tool_urbandic 	= __('Urban Dictionary', 'wp-my-admin-bar');
					$tool_wordtrak 	= __('Wordtracker', 'wp-my-admin-bar');
					$tool_compete 	= __('Compete Rank', 'wp-my-admin-bar');
					$tool_alexa 	= __('Alexa Rank', 'wp-my-admin-bar');
					$tool_magseo 	= __('Majestic SEO', 'wp-my-admin-bar');
					$tool_seomoz 	= __('SEO Moz', 'wp-my-admin-bar');
					$tool_seoprof 	= __('SEO Profiler', 'wp-my-admin-bar');
					$tool_serush 	= __('SE Rush', 'wp-my-admin-bar');
					$tool_valpage 	= __('W3C Validate Page', 'wp-my-admin-bar');
					$tool_valcss 	= __('W3C Validate CSS', 'wp-my-admin-bar');
					$tool_mobichk 	= __('W3C Mobile Checker', 'wp-my-admin-bar');
					$tool_valfeed 	= __('W3C Validate Feed', 'wp-my-admin-bar');
					$tool_linkchk 	= __('W3C Link Checker', 'wp-my-admin-bar');
					$tool_netcond 	= __('Internet Conditions', 'wp-my-admin-bar');
					$tool_nethealth = __('Internet Health', 'wp-my-admin-bar');
					$tool_netmap 	= __('Internet Health Map', 'wp-my-admin-bar');
					$tool_traffrpt 	= __('Traffic Report', 'wp-my-admin-bar');
					$tool_gooserv 	= __('Google Servers', 'wp-my-admin-bar');
					$tool_domwhois 	= __('Domain Whois', 'wp-my-admin-bar');
					$tool_dwnforme 	= __('Down For Me?', 'wp-my-admin-bar');
					$tool_iwebtool 	= __('iWeb Tools', 'wp-my-admin-bar');
					$tool_pinglerp 	= __('Pingler Ping Tool', 'wp-my-admin-bar');
					$tool_pinglert 	= __('Pingler Web Tools', 'wp-my-admin-bar');
					$tool_qbase 	= __('Qbase Site Data', 'wp-my-admin-bar');
					$tool_wayback 	= __('WayBackMachine', 'wp-my-admin-bar');
					$tool_combword 	= __('Combine Words', 'wp-my-admin-bar');
					$tool_keyden 	= __('Keyword Density', 'wp-my-admin-bar');
					$tool_keymix 	= __('Keyword Mixer', 'wp-my-admin-bar');
					$tool_readable 	= __('Readability Index', 'wp-my-admin-bar');
					$tool_typogen 	= __('Typo Generator', 'wp-my-admin-bar');

/* Keyword Tools */
					$this->externalItem( "&bull; $tool_gookey", "https://adwords.google.com/select/KeywordToolExternal", "keywords" );
					$this->externalItem( "&bull; $tool_gooinsite", "http://www.google.com/insights/search/", "keywords" );
					$this->externalItem( "&bull; $tool_gootrend", "http://www.google.com/trends/", "keywords" );
					$this->externalItem( "&bull; $tool_keymap", "http://www.kwmap.net/", "keywords" );
					$this->externalItem( "&bull; $tool_keyspy", "http://www.keywordspy.com/research/search.aspx?q=$website&tab=domain-overview", "keywords" );
					$this->externalItem( "&bull; $tool_metaglos", "http://www.metaglossary.com/", "keywords" );
					$this->externalItem( "&bull; $tool_seodigg", "http://analyticsdigger.org/search.php?q=$website", "keywords" );
					$this->externalItem( "&bull; $tool_thesaur", "http://thesaurus.com/", "keywords" );
					$this->externalItem( "&bull; $tool_ubersugg", "http://ubersuggest.org/", "keywords" );
					$this->externalItem( "&bull; $tool_urbandic", "http://www.urbandictionary.com/", "keywords" );
					$this->externalItem( "&bull; $tool_wordtrak", "https://freekeywords.wordtracker.com/", "keywords" );
/* Traffic & Rankings */
					$this->externalItem( "&bull; $tool_compete", "http://siteanalytics.compete.com/$website/", "ranking" );
					$this->externalItem( "&bull; $tool_alexa", "http://www.alexa.com/siteinfo/$website", "ranking" );
/* SEO Tools */
					$this->externalItem( "&bull; $tool_magseo", "http://www.majesticseo.com/reports/site-explorer/summary/$website?IndexDataSource=F", "seo" );
					$this->externalItem( "&bull; $tool_seomoz", "http://www.opensiteexplorer.org/links?site=$website", "seo" );
					$this->externalItem( "&bull; $tool_seoprof", "http://www.seoprofiler.com/analyze/$website", "seo" );
					$this->externalItem( "&bull; $tool_serush", "http://www.semrush.com/info/$website", "seo" );
/* Validators */
					$this->externalItem( "&bull; $tool_valpage", "http://validator.w3.org/check?uri=$siteUrl/&charset=%28detect+automatically%29&doctype=Inline&group=0", "validate" );
					$this->externalItem( "&bull; $tool_valcss", "http://jigsaw.w3.org/css-validator/validator?uri=$css_url&profile=css21&usermedium=all&warning=1&vextwarning=&lang=en", "validate" );
					$this->externalItem( "&bull; $tool_mobichk", "http://validator.w3.org/mobile/check?docAddr=$website&async=true", "validate" );
					$this->externalItem( "&bull; $tool_valfeed", "http://validator.w3.org/feed/check.cgi?url=$feed_url", "validate" );
					$this->externalItem( "&bull; $tool_linkchk", "http://validator.w3.org/checklink?uri=$website&hide_type=all&depth=&check=Check", "validate" );
/* Web Health */
					$this->externalItem( "&bull; $tool_netcond", "http://www.akamai.com/html/technology/dataviz1.html", "monitor" );
					$this->externalItem( "&bull; $tool_nethealth", "http://www.internetpulse.net/", "monitor" );
					$this->externalItem( "&bull; $tool_netmap", "http://www.gomez.com/internet-health-map/", "monitor" );
					$this->externalItem( "&bull; $tool_traffrpt", "http://www.internettrafficreport.com/", "monitor" );
					$this->externalItem( "&bull; $tool_gooserv", "http://www.google.com/transparencyreport/traffic/", "monitor" );
/* Web Tools */
					$this->externalItem( "&bull; $tool_domwhois", "http://whois.domaintools.com/", "web" );
					$this->externalItem( "&bull; $tool_dwnforme", "http://www.downforeveryoneorjustme.com/", "web" );
					$this->externalItem( "&bull; $tool_iwebtool", "http://www.iwebtool.com/tools/", "web" );
					$this->externalItem( "&bull; $tool_pinglerp", "http://pingler.com/", "web" );
					$this->externalItem( "&bull; $tool_pinglert", "http://pingler.com/seo-tools/", "web" );
					$this->externalItem( "&bull; $tool_qbase", "http://www.quarkbase.com/$website", "web" );
					$this->externalItem( "&bull; $tool_wayback", "http://www.archive.org/", "web" );
/* Word Tools */
					$this->externalItem( "&bull; $tool_combword", "http://www.combinewords.com/", "words" );
					$this->externalItem( "&bull; $tool_keyden", "http://tools.davidnaylor.co.uk/keyworddensity/", "words" );
					$this->externalItem( "&bull; $tool_keymix", "http://keywordmixer.com/", "words" );
					$this->externalItem( "&bull; $tool_readable", "http://www.standards-schmandards.com/exhibits/rix/index.php", "words" );
					$this->externalItem( "&bull; $tool_typogen", "http://tools.seobook.com/spelling/keywords-typos.cgi", "words" );
	} /* end function */
} /* end class */
?>