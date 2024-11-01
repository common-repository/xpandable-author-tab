<?php 
//XPandable Author Tab Functions Include

function extract_author($atts) {

	return $author;
}
function checkXPATAPIKey()
{
		$apikey		= get_option('xpandable_author_tab_apikey');
		if (!$apikey)
		{
			echo '<div id="message" class="error">Please <a href="admin.php?page=XPATRegistration">register</a> your XPandable Author Tab.  Takes only a minute to do!  Thank You!</div>';
		}			
}
function checkXPATAPIKeyForSupport()
{
		$apikey		= get_option('xpandable_author_tab_apikey');
		if ($apikey)
		{
			return true;
		}			
}
function checkXPATAPIKeyShort()
{
		$apikey		= get_option('xpandable_author_tab_apikey');
		if (!$apikey)
		{
			echo '<div id="message" class="error" style="color:red;">Please register your XPandable Author Tab.  Thank You!</div>';
		}			
}
function gen_uuid() {
 $uuid = array(
  'time_low'  => 0,
  'time_mid'  => 0,
  'time_hi'  => 0,
  'clock_seq_hi' => 0,
  'clock_seq_low' => 0,
  'node'   => array()
 );

 $uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
 $uuid['time_mid'] = mt_rand(0, 0xffff);
 $uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
 $uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
 $uuid['clock_seq_low'] = mt_rand(0, 255);

 for ($i = 0; $i < 6; $i++) {
  $uuid['node'][$i] = mt_rand(0, 255);
 }

 $uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
  $uuid['time_low'],
  $uuid['time_mid'],
  $uuid['time_hi'],
  $uuid['clock_seq_hi'],
  $uuid['clock_seq_low'],
  $uuid['node'][0],
  $uuid['node'][1],
  $uuid['node'][2],
  $uuid['node'][3],
  $uuid['node'][4],
  $uuid['node'][5]
 );

 return $uuid;
}
function XPATSaveStylesheet($stylesheetData)
{
		$css_file			= getPublicPluginDir()."/xpandable-author-tab.css";
		
        if(file_put_contents($css_file, $stylesheetData))
        {
            $message .= "Stylesheet Successfully Saved to ".$css_file;
        }else{
            $message .= "ERROR: Stylesheet Not Saved.";        
        }		
		
		return $message;
}
function XPATSaveStylesheetBackup($stylesheetData)
{
		$css_file			= getPublicPluginDir()."/../xpandable-author-tab.css";
		
        if(file_put_contents($css_file, $stylesheetData))
        {
            $message .= "Backup Stylesheet Successfully Saved to ".$css_file;
        }else{
            $message .= "ERROR: Backup Stylesheet Not Saved.";        
        }		
		
		return $message;
}	

function XPATregisterProduct($firstName,$lastName,$emailAddress,$city,$state,$country,$siteurl,$product,$productversion)
{
	$to 	 = "register@buildautomate.com";
	$subject = "NEW REGISTRATION";
	$message = 	"<Registration>\n";
	$message .= "\t<FirstName>".$firstName."</FirstName>\n";	
	$message .= "\t<LastName>".$lastName."</LastName>\n";		
	$message .= "\t<EmailAddress>".$emailAddress."</EmailAddress>\n";		
	$message .= "\t<City>".$city."</City>\n";		
	$message .= "\t<State>".$state."</State>\n";		
	$message .= "\t<Country>".$country."</Country>\n";		
	$message .= "\t<SiteURL>".$siteurl."</SiteURL>\n";		
	$message .= "\t<Product>".$product."</Product>\n";		
	
	$message .= "\t<Version>";
	$message .= $productversion; 
	$message .= "</Version>\n";
	
	$message .= "</Registration>\n";
	
	wp_mail( $to, $subject, $message ); 
}
function getPublicPluginUrl() {
	return WP_PLUGIN_URL .'/'. dirname(plugin_basename(__FILE__));
}
function getPublicPluginDir() {
	return WP_PLUGIN_DIR .'/'. dirname(plugin_basename(__FILE__));
}


?>