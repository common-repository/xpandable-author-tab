<?php
/**
 * Plugin Name: XPandable Author Tab Widget
 * Plugin URI: http://www.buildautomate.com/en/xpandable-author-tab/widgets/xpandable-author-tab
 * Description: BuildAutomate’s XPandable Author Tab Widget allows developers to display more biographical information about a WordPress author. In its expanded state, this plugin holds an image, social media icons and any other information a developer or author deems appropriate.  The latest 2.0 release takes these already-popular features and supercharges them to create a richer experience for developer, author and reader. The widget now has configurable page placement via shortcuts and enhanced graphical social icons. Developers also can use our inline CSS editor and a rollout speed setting to customize the experience.  Building on the great user interface XPandable Author Tab developers and users have come to expect, they now have access to video-based help and can receive free technical support via a built-in ticketing interface.
 * Version: 2.0
 * Author: Build.Automate, Inc.
 * Author URI: http://www.buildautomate.com/en
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
include_once dirname( __FILE__ ) . '/xpandable-author-tab.php';
add_action( 'widgets_init', 'xpandable_author_tab_widgets' );

function xpandable_author_tab_widgets() {
	register_widget( 'XPandable_Author_Tab_Widget' );
}

class XPandable_Author_Tab_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function XPandable_Author_Tab_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'XPATexample', 'description' => __('A widget that displays an XPandable Author Tab Panel.', 'xpandableauthortabwidget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'xpandable-author-tab-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'xpandable-author-tab-widget', __('XPandable Author Tab Widget', 'xpandableauthortabwidget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		//$queryInterface = $instance['queryInterface'];
		$author = $instance['authorid'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		if($author)
			echo '<p>';
			echo (do_shortcode('[xpandableauthortab authorid="'.$author.'"]'));			
			echo '</p>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['authorid'] = strip_tags($new_instance['authorid']);
		//$instance['queryInterface'] = strip_tags($new_instance['queryInterface']);

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('About The Author', 'xpandableauthortabwidget'), 'name' => __('John Doe', 'xpandableauthortabwidget'), 'sex' => 'male', 'show_sex' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;"/>
		</p>
				
		
		<label for="<?php echo $this->get_field_id( 'authorid' ); ?>"><?php _e('Author:', 'xpandableauthortabwidget'); ?></label> 
	<?php
		$content = '<select name="'.$this->get_field_name( 'authorid' ).'" id="'.$this->get_field_id( 'authorid' ).'" class="widefat" style="width:100%;">';
    //	$content = '<select name="author" id="author" class="widefat" style="width:100%"/>';
    
		$content .= '<option value="thisauthor" ';
		if($instance['authorid'] == 'thisauthor')
		{
			$content .= " selected";
		}
		$content .= '>';
		$content .= "Current Page Author";
		$content .= '</option>';    
    
        //$content .= '<option value="thisauthor">Current Page Author</option>';
		$query_args = array();
		$query_args['fields'] = array( 'ID', 'display_name' );
		$users = get_users( $query_args );

    	
	    foreach ($users as $user) {
				$content .= '<option value="'.$user->ID.'" ';
				if($instance['authorid'] == $user->ID)
				{
					$content .= " selected";
				}
				$content .= '>';
				$content .= $user->display_name;
				$content .= '</option>';
	    }	
		$content .= '</select>';
		echo $content;
	
	}
}

?>