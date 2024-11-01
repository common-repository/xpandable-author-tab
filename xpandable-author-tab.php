<?php
/*
Plugin Name: Xpandable Author Tab
Version: 2.0
Description: BuildAutomate’s XPandable Author Tab allows developers to display more biographical information about a WordPress author. In its expanded state, this plugin holds an image, social media icons and any other information a developer or author deems appropriate.  The latest 2.0 release takes these already-popular features and supercharges them to create a richer experience for developer, author and reader. The widget now has configurable page placement via shortcuts and enhanced graphical social icons. Developers also can use our inline CSS editor and a rollout speed setting to customize the experience.  Building on the great user interface XPandable Author Tab developers and users have come to expect, they now have access to video-based help and can receive free technical support via a built-in ticketing interface.

Author: Vaughn Bullard, Build.Automate, Inc.
Author URI: http://www.buildautomate.com/en
Plugin URI: http://www.buildautomate.com/en/products/xpandable-author-tab/
License: GNU GPL v3 or later

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
include_once dirname( __FILE__ ) . '/pages.php';
include_once dirname( __FILE__ ) . '/functions.php';

Class xpandable_author_tab {

	public static function init() {
		global $wp_version;

		// Requires Wordpress 2.9 or greater
		if (version_compare($wp_version, "2.9", "<")) {
			return false;
		}
		
		self::addFilters();		
		self::addActions();

		load_plugin_textdomain('xpandable_author_tab', false, dirname(plugin_basename(__FILE__ )));
		add_action('admin_menu', 'xpandable_author_tab_create_menu');	
		add_shortcode('xpandableauthortab','retrieveAuthorPanel');				

		return true;
	}

	public static function filterSocialContactMethods($soc_contact) {
		$soc_contact['twitter'] = 'Twitter';
		$soc_contact['facebook'] = 'Facebook';
		$soc_contact['aim'] = 'AIM';
		$soc_contact['yim'] = 'Yahoo IM';
		$soc_contact['jabber'] = 'Jabber/Google Talk';						

		return $soc_contact;
	}

	public static function pluginCss() {
	
		if(file_exists(self::getPluginDir() . '/xpandable-author-tab.css')) {
			wp_register_style('xpandable-author-tab-div', self::getPluginUrl().'/xpandable-author-tab.css');
			wp_enqueue_style('xpandable-author-tab-div');
		}
	}

	private static function getPluginDir() {
		return WP_PLUGIN_DIR .'/'. dirname(plugin_basename(__FILE__));
	}

	private static function getPluginUrl() {
		return WP_PLUGIN_URL .'/'. dirname(plugin_basename(__FILE__));
	}

	private static function addFilters() {
		add_filter('user_contactmethods', array('xpandable_author_tab', 'filterSocialContactMethods'));
		//add_filter('the_content', array('xpandable_author_tab', 'filterContent'));
	}

	public static function addActions() {
		add_action('wp_print_styles', array('xpandable_author_tab', 'pluginCss'));
	}
	
}


	function retrieveAuthorPanel($atts)
	{
			global $wp_query;
			extract(shortcode_atts(array('authorid' => ''), $atts));
				
			if($authorid == "thisauthor")
			{
			    $thePostID = $wp_query->post->ID;
				$postdata = get_post($thePostID, ARRAY_A);
				$authorid = $postdata['post_author'];
			}

			$author = array();
			$author['name'] = get_the_author_meta('first_name',$authorid) ." ".get_the_author_meta('last_name',$authorid); ;
			$author['twitter'] = get_the_author_meta('twitter',$authorid);
			$author['facebook'] = get_the_author_meta('facebook',$authorid);
			$author['aim'] = get_the_author_meta('aim',$authorid);			
			$author['yim'] = get_the_author_meta('yim',$authorid);			
			$author['jabber'] = get_the_author_meta('jabber',$authorid);			
			$author['posts'] = (int)get_the_author_posts($authorid);
			$piurl = getPublicPluginUrl();
			$uuid = gen_uuid();

			$speed		= "slow";
			if(!get_option('xpandable_author_tab_speed'))
			{	$speed  = "slow"; }else
			{	$speed	= get_option('xpandable_author_tab_speed'); }

			ob_start();
			?>
			<script src="http://code.jquery.com/jquery-latest.min.js"></script>
			<div id="xpandable-author-tab-div">
				<div class="xpandable-author-tab-div-info">

					<?php echo get_avatar( get_the_author_meta( 'user_email', $authorid ), '60' ); ?>

					   <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
						<?php echo esc_attr(get_the_author_meta('first_name',$authorid).' '.get_the_author_meta('last_name',$authorid)); ?>
					   </a>
					<div class="xpandable-author-tab-div-buttons">
						<a href="<?php echo get_the_author_meta('url');?>" target="newWin" title="<?php echo esc_attr(sprintf(__('Read %s&#8217;s blog', 'xpandable-author-tab-div'), $author['name'])); ?>"><img src="<?php echo $piurl ?>/images/blogs.png" class="socialbuttons"/></a>
						<!-- TWITTER -->
						<?php if(!empty($author['twitter'])): ?>
						<a href="<?php echo $author['twitter']; ?>" target="newWin" title="<?php echo esc_attr(sprintf(__('Follow %s on Twitter', 'xpandable-author-tab-div'), $author['name'])); ?>" rel="external"><img src="<?php echo $piurl ?>/images/twitter.png" class="socialbuttons"/></a>
						<?php endif; ?>
						<!-- FACEBOOK -->						
						<?php if(!empty($author['facebook'])): ?>
						<a href="<?php echo $author['facebook']; ?>" target="newWin" title="<?php echo esc_attr(sprintf(__('Be %s&#8217;s friend on Facebook', 'xpandable-author-tab-div'), $author['name'])); ?>" rel="external"><img src="<?php echo $piurl ?>/images/facebook.png" class="socialbuttons"/></a>
						<?php endif; ?>
						<!-- AIM -->						
						<?php if(!empty($author['aim'])): ?>
						<a href="<?php echo $author['aim']; ?>" target="newWin" title="<?php echo esc_attr(sprintf(__('Be %s&#8217;s friend on AIM', 'xpandable-author-tab-div'), $author['name'])); ?>" rel="external"><img src="<?php echo $piurl ?>/images/aim.jpg" class="socialbuttons"/></a>
						<?php endif; ?>
						<!-- YIM -->						
						<?php if(!empty($author['yim'])): ?>
						<a href="<?php echo $author['yim']; ?>" target="newWin" title="<?php echo esc_attr(sprintf(__('Be %s&#8217;s friend on Yahoo', 'xpandable-author-tab-div'), $author['name'])); ?>" rel="external"><img src="<?php echo $piurl ?>/images/yahoo.png" class="socialbuttons"/></a>
						<?php endif; ?>
						<!-- JABBER/Google Talk -->						
						<?php if(!empty($author['jabber'])): ?>
						<a href="<?php echo $author['jabber']; ?>" target="newWin" title="<?php echo esc_attr(sprintf(__('Be %s&#8217;s friend on Jabber/Google', 'xpandable-author-tab-div'), $author['name'])); ?>" rel="external"><img src="<?php echo $piurl ?>/images/google.png" class="socialbuttons"/></a>
						<?php endif; ?>																		
					</div>
					<br/>
					<ul>
					<button class="morebutton"><?php printf( esc_attr__( '+ About %s'), get_the_author_meta('first_name',$authorid) ); ?></button>
				    <script>
						$("button").click(function () {
							$(".xpandable-author-tab-div-meta-<?php echo $authorid.$uuid ?>").slideToggle("<?php echo $speed ?>");
						}); 
						
					</script>
					<br/>
					<h6 class="xpandable-author-tab-div-meta-<?php echo $authorid.$uuid ?>" style="display: none"><?php echo get_the_author_meta('description',$authorid); ?><br/><br/><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID',$authorid ) ); ?>">
						<?php echo esc_attr(sprintf(__ngettext('%s has written 1 article', '%s has written %d articles', $author['posts'], 'xpandable_author_tab-div'), get_the_author_meta('first_name',$authorid).' '.get_the_author_meta('last_name',$authorid), $author['posts'])); ?>.
					   </a></h6>
					<div class="xpandable-author-tab-div-info-footer"><a href="http://www.buildautomate.com/en/products/xpandable-author-tab/" target="newWin"><img src="<?php echo $piurl ?>/images/ba16x16.png" id="balogo" style="padding-right:5px;" title="Build.Automate, Inc. XPandable Author Tab"/></a></div>
					<?php checkXPATAPIKeyShort(); ?>
					</ul>
				</div>
			</div>
			<?php
			$content .= ob_get_clean();

		return $content;
	
	}	
if(!xpandable_author_tab::init()) {
	echo 'XPandable Author Tab plugin requires WordPress 2.9 or higher. Please upgrade!';
}


function xpandable_author_tab_create_menu()
{
	//create new top-level menu	
	add_menu_page('XP Overview',   'XP Author Tab', 		'administrator', 'XPandableAuthorTabSettings', 'XPATOverview', 'http://buildautomate.com/favicon.ico');
	add_submenu_page('XPandableAuthorTabSettings', 'Stylesheet', 		'Stylesheet', 		'administrator', 'XPATStylesheet',		'XPATStylesheet');	
	add_submenu_page('XPandableAuthorTabSettings', 'Effects Settings', 		'Effects Settings', 		'administrator', 'XPATEffectsSettings',		'XPATEffectsSettings');	
	add_submenu_page('XPandableAuthorTabSettings', 'Shortcode', 		'Shortcode', 		'administrator', 'XPATShortcodes',		'XPATShortcodes');	
	add_submenu_page('XPandableAuthorTabSettings', 'Registration', 		'Registration', 		'administrator', 'XPATRegistration',		'XPATRegistration');			
	add_submenu_page('XPandableAuthorTabSettings', 'Tech Support', 		'Tech Support', 		'administrator', 'XPATTechSupport', 		'XPATTechSupport');	
	add_submenu_page('XPandableAuthorTabSettings', 'Help', 		'Help', 		'administrator', 'XPATHelp',		'XPATHelp');				
			
	//call register settings function
	add_action( 'admin_init', 'XPATregister_mysettings' );
}	
function XPATregister_mysettings() {
	//register XPandable Author Tab settings
	register_setting( 'xpandable-author-tab-settings-group', 'xpandable_author_tab_css' );
}
function XPATregisterProductRemote($xfn,$xln,$xem,$xct,$xsp,$xcy,$siteurl,$xprod,$xat_version)
{
	$url		= "http://buildautomate.com/topaz/receive-registration";
	$response 	= wp_remote_post( $url, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => array( 	'xtools_firstname' 			=> $xfn, 
							'xtools_lastname' 			=> $xln,
							'xtools_emailaddress' 		=> $xem,
							'xtools_city'	 			=> $xct,														
							'xtools_stateprovince' 		=> $xsp,	
							'xtools_country' 			=> $xcy,													
							'xtools_siteurl' 			=> $siteurl,							
							'xtools_product' 			=> $xprod,							
							'xtools_version' 			=> $xat_version							
							 ),
		'cookies' => array()
    	)
	);
	$body = $response['body'];
	$apikey = "";
	
	if( is_wp_error( $response ) ) {
   		//$error_message = $response->get_error_message();
		  // echo "Something went wrong: $error_message";
	} else {
   	 	$startpos = strpos($body, "<apikey>");
   	 	$endpos   = strpos($body, "</apikey>");
   	 	$chars 		= $endpos - $startpos;
	   	$apikey = substr($body, $startpos+8, $chars-8);
	}
	return $apikey;
}