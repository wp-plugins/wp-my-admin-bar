<?php
/**
 * WP My Admin Bar
 * @package WP My Admin Bar
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/adminbar/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
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
			'title' 	=> '&bull; '. __($name, 'wp-my-admin-bar') .' &raquo;',
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
			"keywords" 	=> "Keyword Tools",
			"seo" 		=> "SEO Tools",
			"ranking" 	=> "Traffic &amp; Rankings",
			"validate" 	=> "Validators",
			"monitor" 	=> "Web Health",
			"web" 		=> "Web Tools",
			"words" 		=> "Word Tools"
		);

		$this->toolsTitle( "My Tools", "toolsTitle" );

			foreach ( $tool_type_list as $key => $items ) {			
				$this->toolsOption( $items, $key, "toolsTitle" );
			}

					$siteUrl = site_url();
					$website = parse_url( $siteUrl );
					$website = $website['host'];
					$css_url = ''. get_bloginfo( 'template_url' ) .'/style.css';	/* used for css validator */
					$feed_url = get_bloginfo( 'rss2_url' );					/* used to validated feed */
				
					/* Menu Text */
					/* Keyword Tools */
					$this->externalItem( "Google KeyTool", "https://adwords.google.com/select/KeywordToolExternal", "keywords" );
					$this->externalItem( "Google Insights", "http://www.google.com/insights/search/", "keywords" );
					$this->externalItem( "Google Trends", "http://www.google.com/trends/", "keywords" );
					$this->externalItem( "Keyword Map", "http://www.kwmap.net/", "keywords" );
					$this->externalItem( "Keyword Spy", "http://www.keywordspy.com/research/search.aspx?q=$website&tab=domain-overview", "keywords" );
					$this->externalItem( "Meta Glossary", "http://www.metaglossary.com/", "keywords" );
					$this->externalItem( "SEO Digger", "http://analyticsdigger.org/search.php?q=$website", "keywords" );
					$this->externalItem( "Thesaurus", "http://thesaurus.com/", "keywords" );
					$this->externalItem( "Uber Suggest", "http://ubersuggest.org/", "keywords" );
					$this->externalItem( "Urban Dictionary", "http://www.urbandictionary.com/", "keywords" );
					$this->externalItem( "Wordtracker", "https://freekeywords.wordtracker.com/", "keywords" );
					/* Traffic & Rankings */
					$this->externalItem( "Compete Rank", "http://siteanalytics.compete.com/$website/", "ranking" );
					$this->externalItem( "Alexa Rank", "http://www.alexa.com/siteinfo/$website", "ranking" );
					/* SEO Tools */
					$this->externalItem( "Ahrefs Explorer", "https://ahrefs.com/site-explorer/backlinks/subdomains/$website", "seo" );
					$this->externalItem( "Majestic SEO", "http://www.majesticseo.com/reports/site-explorer/summary/$website?IndexDataSource=F", "seo" );
					$this->externalItem( "SEO Moz", "http://www.opensiteexplorer.org/links?site=$website", "seo" );
					$this->externalItem( "SEO Profiler", "http://www.seoprofiler.com/analyze/$website", "seo" );
					$this->externalItem( "SE Rush", "http://www.semrush.com/info/$website", "seo" );
					/* Validators */
					$this->externalItem( "W3C Validate Page", "http://validator.w3.org/check?uri=$siteUrl/&charset=%28detect+automatically%29&doctype=Inline&group=0", "validate" );
					$this->externalItem( "W3C Validate CSS", "http://jigsaw.w3.org/css-validator/validator?uri=$css_url&profile=css21&usermedium=all&warning=1&vextwarning=&lang=en", "validate" );
					$this->externalItem( "W3C Mobile Checker", "http://validator.w3.org/mobile/check?docAddr=$website&async=true", "validate" );
					$this->externalItem( "W3C Validate Feed", "http://validator.w3.org/feed/check.cgi?url=$feed_url", "validate" );
					$this->externalItem( "W3C Link Checker", "http://validator.w3.org/checklink?uri=$website&hide_type=all&depth=&check=Check", "validate" );
					/* Web Health */
					$this->externalItem( "Internet Conditions", "http://www.akamai.com/html/technology/dataviz1.html", "monitor" );
					$this->externalItem( "Internet Health", "http://www.internetpulse.net/", "monitor" );
					$this->externalItem( "Internet Health Map", "http://www.gomez.com/internet-health-map/", "monitor" );
					$this->externalItem( "Traffic Report", "http://www.internettrafficreport.com/", "monitor" );
					$this->externalItem( "Google Servers", "http://www.google.com/transparencyreport/traffic/", "monitor" );
					/* Web Tools */
					$this->externalItem( "Domain Whois", "http://whois.domaintools.com/", "web" );
					$this->externalItem( "Down For Me?", "http://www.downforeveryoneorjustme.com/", "web" );
					$this->externalItem( "iWeb Tools", "http://www.iwebtool.com/tools/", "web" );
					$this->externalItem( "Pingler Ping Tool", "http://pingler.com/", "web" );
					$this->externalItem( "Pingler Web Tools", "http://pingler.com/seo-tools/", "web" );
					$this->externalItem( "Qbase Site Data", "http://www.quarkbase.com/$website", "web" );
					$this->externalItem( "WayBackMachine", "http://www.archive.org/", "web" );
					/* Word Tools */
					$this->externalItem( "Combine Words", "http://www.combinewords.com/", "words" );
					$this->externalItem( "Keyword Density", "http://tools.davidnaylor.co.uk/keyworddensity/", "words" );
					$this->externalItem( "Keyword Mixer", "http://keywordmixer.com/", "words" );
					$this->externalItem( "Readability Index", "http://www.standards-schmandards.com/exhibits/rix/index.php", "words" );
					$this->externalItem( "Typo Generator", "http://tools.seobook.com/spelling/keywords-typos.cgi", "words" );
	} /* end function */
} /* end class */
?>