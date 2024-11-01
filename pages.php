<?php

// XPandable Author Tab Management Pages Include

function XPATOverview()
{
	checkXPATAPIKey();
	$content = "<h2>XPandable Author Tab</h2>";	
	$content .= "<h3>Proudly brought to you by the Open Source Development Team at </h3><br/><ul><img src='http://i1.wp.com/www.buildautomate.com/en/wp-content/uploads/2013/04/8.png?resize=300%2C50'></ul>";
	$content .= "<h4>Check out our website and other plugins</h4>";
	$content .= "<table width='50%'>";
	$content .= "<tr><td>Main Site                  </td><td><a href='http://www.buildautomate.com/en' target='newWin'>http://www.buildautomate.com/en</a></td></tr>";
	$content .= "<tr><td>XData Toolkit Plugin       </td><td><a href='http://www.buildautomate.com/en/products/xdata-toolkit' target='newWin'>http://www.buildautomate.com/en/products/xdata-toolkit</a></td></tr>";	
	$content .= "<tr><td>'From Scratch' Blog        </td><td><a href='http://www.buildautomate.com/en/category/from-scratch/' target='newWin'>http://www.buildautomate.com/en/category/from-scratch/</a></td></tr>";	
	$content .= "<tr><td>'Redefining Strategy' Blog </td><td><a href='http://www.buildautomate.com/en/category/redefining-strategy/' target='newWin'>http://www.buildautomate.com/en/category/redefining-strategy/</a></td></tr>";		
	$content .= "<tr><td>'Tech Bytes' Blog          </td><td><a href='http://www.buildautomate.com/en/category/tech-bytes/' target='newWin'>http://www.buildautomate.com/en/category/tech-bytes/</a></td></tr>";			
	$content .= "</table>";
	echo $content;
}
function XPATTechSupport()
{
	checkXPATAPIKey();
	$content = "";
	if(checkXPATAPIKeyForSupport())
	{
		$content .= '<div id="panelOne" class="tabdiv">';
		$content .= "<h2>XPandable Author Tab - Technical Support</h2>";		
		$content .= '<iframe src="http://www.buildautomate.com/helpdesk/" id="helpdeskWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
	}else
	{
		$content .= "<h2>XPandable Author Tab - Technical Support</h2>";	
		$content .= "<h3>Please register your XPandable Author Tab for Support.</h3>";
	}
	echo $content;
}
function XPATHelp()
{
	checkXPATAPIKey();
	$content = "<h2>XPandable Author Tab - Help</h2>";	
	$content .= "<h3>XPandable Author Tab Video</h3>";	
	$content .= '<iframe width="560" height="315" src="http://www.youtube.com/embed/TwrlJP3Hyl0" frameborder="0" allowfullscreen></iframe>';
	$content .= "<h3>XPandable Author Tab Documentation</h3>";	
	$content .= "<h4>Installation and Usage</h4>";		
	$content .= "<ol>";			
	$content .= "<li>Activate XPandable Author Tab Plugin and XPandable Author Tab Widget in Plugins menu.</li>";				
	$content .= "<li>Register for an API Key.  Hey, we have to know who's using our plugin!  It helps us also get alerts and updates out to you quicker!  We take our responsibilities very seriously!</li>";			
	$content .= "<li>Insert shortcode into posts, pages or themes OR drag and drop the XPandable Author Tab widget onto a sidebar under the widget settings panel.</li>";				
	$content .= "<li>Make modifications to the stylesheet in the Stylesheet panel.</li>";				
	$content .= "<li>Make changes to effects settings to control speed of XPandable Author Tab description drop down.</li>";		
	$content .= "<li>Check out your posts, pages, themes and/or widgets!</li>";											
	$content .= "</ol>";				
	$content .= "<h4>Widget Configuration</h4>";		
	$content .= "<ol>";			
	$content .= "<li>Drag and drop the XPandable Author Tab Widget to the sidebar of your choice.</li>";				
	$content .= "<li>Choose the current page author or an author designated on your system from the drop down list in the widget.</li>";			
	$content .= "<li>Change the title that will be displayed above the widget title.</li>";				
	$content .= "<li>Click Save</li>";				
	$content .= "<li>View changes in sidebar of your WordPress site.</li>";		
	$content .= "</ol>";		
	$content .= "<h4>Stylesheet Editing</h4>";		
	$content .= "<ul>";			
	$content .= "<li>Edit stylesheet and save.  A backup copy will be placed in the parent plugins directory.  This is in case you upgrade and find your configuration written over.</li>";				
	$content .= "<li>Every installation of XPandable Author Tab comes with an original version of the provided CSS file and you may revert to that by pressing 'Restore Original CSS' button in the Stylesheet editor.</li>";			
	$content .= "</ul>";		
	$content .= "<h4>Shortcode Configuration</h4>";		
	$content .= "Embedding shortcodes is easy.  These shortcodes can be embedded in your posts, pages or themes.";				
	$content .= "  Enter the ID number of the author in the authorid attribute in the shortcode.";			
	$content .= "  Alternatively you can choose the current page or post author by entering thisauthor in the authorid attribute in the shortcode.<br/><br/>";				
	$content .= 'The following shortcode returns the default admin author.';
	$content .= '<pre>[xpandableauthortab authorid="1"]</pre>';
	$content .= 'The following shortcode returns the author of the current page or post.';
	$content .= '<pre>[xpandableauthortab authorid="thisauthor"]</pre>';
	
	echo $content;
}
function XPATShortcodes()
{
	checkXPATAPIKey();
	$content = "<h2>XPandable Author Tab - Shortcodes</h2>";	
	$content .= 'The following examples show one how to embed a shortcode into their pages, posts or themes.<br/><br/>';
	$content .= 'The following shortcode returns the default admin author.<br/>';
	$content .= '<pre>[xpandableauthortab authorid="1"]</pre><br/>';
	$content .= 'The following shortcode returns the author of the current page or post.<br/>';
	$content .= '<pre>[xpandableauthortab authorid="thisauthor"]</pre><br/>';	
	$content .= '';
	$content .= '';
	$content .= '';				
	echo $content;
}
function XPATEffectsSettings()
{
	checkXPATAPIKey();
	$content = "<h2>XPandable Author Tab - Effects Settings</h2>";	
	$content .= "<p>";
	$content .= "<h4>Choose the dropdown speed at which XPandable Author Tab will display.  </h4>";
	
	$content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';	
	settings_fields( 'xpandable-author-tab-settings-group' );
	$option2 = 'xpandable_author_tab_speed';

	// Read in existing option's values from database
	$xcss		= get_option($option2);

	if( isset($_POST['xpandable_author_tab_speed'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_speed' ];
		update_option( $option2, $opt_val );	
	}
	$content .= '<ul>';
	$yeschecked = get_option('xpandable_author_tab_speed');

	if($yeschecked == 'fast' ){
		$content .= '<input type="radio" name="xpandable_author_tab_speed" value="fast" checked> Fast <br/>';
		$content .= '<input type="radio" name="xpandable_author_tab_speed" value="slow"> Slow <br/>';			
		}else
		{
			$content .= '<input type="radio" name="xpandable_author_tab_speed" value="fast"> Fast <br/>';		
			$content .= '<input type="radio" name="xpandable_author_tab_speed" value="slow" checked> Slow <br/>';		
	}


	$content .= '<br/><br/><br/>';
	$content .= '<input type="submit" class="button-primary" value="Save Changes" /></ul>';
	$content .= '</form>';	
	echo $content;
}
function XPATStylesheet()
{
	checkXPATAPIKey();
	$content = "<h2>XPandable Author Tab - CSS/Stylesheet Settings</h2>";
	$content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';	

	if($_POST['Restore'])
	{
		$content .= '<h3>RESTORING</h3>';
		$stylesheet = getPublicPluginDir().'/xpandable-author-tab-original.css';
		$xcss = file_get_contents($stylesheet);				
		$content .= "<h3>".XPATSaveStylesheet(stripslashes($xcss))."</h3>";		
	}else
	 {
		if( isset($_POST['xpandable_author_tab_css'])  )
		{   
			$xcss = $_POST[ 'xpandable_author_tab_css' ];
			$content .= "<h3>".XPATSaveStylesheet(stripslashes($xcss))."</h3>";
			$content .= "<h3>".XPATSaveStylesheetBackup(stripslashes($xcss))."</h3>";			
		}else{
			$stylesheet = getPublicPluginDir().'/xpandable-author-tab.css';
			$xcss = file_get_contents($stylesheet);		
		}
	 }

	$content .= "<h5>Please modify CSS for XPandable Author Tab Below:</h5>";	
	$content .= '<ul>';
	$content .= '<textarea rows="20" cols="80" name="xpandable_author_tab_css">';
	$content .= stripslashes($xcss);
	$content .= '</textarea>';
	$content .= '<br/><br/><br/>';
	$content .= '<input type="submit" name="SaveChanges" class="button-primary" value="Save Changes" />';
	$content .= '&nbsp;&nbsp;&nbsp;';
	$content .= '<input type="submit" name="Restore" class="button-primary" value="Restore Original CSS" />';
	$content .= '</ul>';
	$content .= '</form>';
	
	echo $content;

}	
function XPATRegistration()
{
	checkXPATAPIKey();
	$content = "<h2>XPandable Author Tab - Registration Settings</h2>";
	$content .= "<h3>By registering your product, you will receive important updates, including security update information and email updates, about your plugin. </h3>";	
	$content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';	
	settings_fields( 'xpandable-author-tab-settings-group' );
	$option2 = 'xpandable_author_tab_firstname';
	$option3 = 'xpandable_author_tab_lastname';
	$option4 = 'xpandable_author_tab_emailaddress';	
	$option5 = 'xpandable_author_tab_city';	
	$option6 = 'xpandable_author_tab_country';	
	$option7 = 'xpandable_author_tab_stateprovince';
	$option8 = 'xpandable_author_tab_apikey';		
	$siteurl = get_site_url();
	$xprod	  = "XPandable Author Tab";	
	global $xat_version;
	
	$xat_version = "2.0";	

	// Read in existing option's values from database
	$xfn		= get_option($option2);

	if( isset($_POST['xpandable_author_tab_firstname'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_firstname' ];
		update_option( $option2, $opt_val );	
	}

	$xln		= get_option($option3);

	if( isset($_POST['xpandable_author_tab_lastname'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_lastname' ];
		update_option( $option3, $opt_val );	
	}
	$xem		= get_option($option4);

	if( isset($_POST['xpandable_author_tab_emailaddress'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_emailaddress' ];
		update_option( $option4, $opt_val );	
	}	
	$xct		= get_option($option5);

	if( isset($_POST['xpandable_author_tab_city'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_city' ];
		update_option( $option5, $opt_val );	
	}	
	$xcy		= get_option($option6);

	if( isset($_POST['xpandable_author_tab_country'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_country' ];
		update_option( $option6, $opt_val );	
	}	
	$xsp		= get_option($option7);

	if( isset($_POST['xpandable_author_tab_stateprovince'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_stateprovince' ];
		update_option( $option7, $opt_val );	

	}			
	// Read in existing option's values from database
	$apikey		= get_option($option8);

	if( isset($_POST['xpandable_author_tab_firstname'])  )
	{
		$opt_val = $_POST[ 'xpandable_author_tab_apikey' ];
		update_option( $option8, $opt_val );	
	}		
	
	$content .= "<h4>Please enter plugin registration details below:</h4>";
	$content .= '<ul>';
	$xfn	  = get_option('xpandable_author_tab_firstname');
	$xln	  = get_option('xpandable_author_tab_lastname');
	$xem	  = get_option('xpandable_author_tab_emailaddress');		
	$xct	  = get_option('xpandable_author_tab_city');	
	$xsp	  = get_option('xpandable_author_tab_stateprovince');	
	$xcy	  = get_option('xpandable_author_tab_country');

	$content .= '<table width="50%">';
	$content .= '<tr><td>First Name:</td><td><input type="text" size="50" name="xpandable_author_tab_firstname" value="'.$xfn.'"/></td></tr>';
	$content .= '<tr><td>Last Name:</td><td><input type="text" size="50" name="xpandable_author_tab_lastname" value="'.$xln.'"/></td></tr>';	
	$content .= '<tr><td>Email Address:</td><td><input type="text" size="50" name="xpandable_author_tab_emailaddress" value="'.$xem.'"/></td></tr>';	
	$content .= '<tr><td>City:</td><td><input type="text" size="50" name="xpandable_author_tab_city" value="'.$xct.'"/></td></tr>';
	$content .= '<tr><td>State/Province:</td><td><input type="text" size="50" name="xpandable_author_tab_stateprovince" value="'.$xsp.'"/></td></tr>';	
	$content .= '<tr><td>Country:</td><td><input type="text" size="50" name="xpandable_author_tab_country" value="'.$xcy.'"/></td></tr>';

	if(isset($_POST['xpandable_author_tab_apikey'])  )
	{		
		$apikey = $_POST[ 'xpandable_author_tab_apikey' ];
		update_option( $option8, $apikey );
	}else
	 {
		if( isset($_POST['xpandable_author_tab_stateprovince'])  )
		{	 
			$apikey = XPATregisterProductRemote($xfn,$xln,$xem,$xct,$xsp,$xcy,$siteurl,$xprod,$xat_version);
			update_option( $option8, $apikey );	 
		}
	 }		
	$content .= '<tr><td><strong>API KEY</strong>:</td><td><input type="text" size="50" name="APIKEY" value="'.$apikey.'"/></td></tr>';	
	$content .= '<tr><td colspan="2"><h4>By clicking "Save Changes and Register", you agree that you are registering your installation of the XPandable Author Tab and that you agree to receive regular email updates and news from Build.Automate. </h4></td></tr>';		
	$content .= '</table><br/>';
	$content .= '<input type="hidden" name="xpandable_author_tab_siteurl" value="'.$siteurl.'">';		
	$content .= '<input type="hidden" name="xtools_product" value="XPandable Author Tab">';			
	$content .= '<input type="hidden" name="xtools_version" value="'.$xat_version.'">';		
	$content .= '<input type="submit" class="button-primary" value="Save Changes and Register" /></ul>';
	$content .= '</form>';		
	
	echo $content;

}

?>