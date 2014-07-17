<?php
/*
Plugin Name: A Day in the Life post edit help text 
Description: Provides help text meta boxes for post. Text can be edited in file by developer. No GUI. 
Author: Neontribe
Author URI: http://www.neontribe.co.uk
*/ 

// Add metabox below editing pane
 function dil_metabox_after_title() {
	    add_meta_box( 'after-title-help', 'Tips for writing your story', 'dil_after_title_help_metabox_content', 'post', 'advanced', 'high' );
} 
add_action( 'add_meta_boxes', 'dil_metabox_after_title' );

// callback function to populate metabox
function dil_after_title_help_metabox_content() { ?> 
	    <p>
				 Use this form to add your story.
				 
				 Follow these tips for the best chance of getting published.

				 <ol>
				 <li>Keep below the word count of 700 words.</li>
				 <li>Don't use inappropriate language</li>
				 </ol>
			</p>
<?php }  

// Add help text to right of screen in a metabox
function dil_metabox_top_right() {
	add_meta_box( 'above-publish-help', 'Publishing and Saving Changes', 'dil_top_right_help_metabox_content', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'dil_metabox_top_right' );


// callback function to populate metabox
function dil_top_right_help_metabox_content() { ?>
	<p>
		 Make sure you click 'Submit for review' below once you've finished your story, to send it to our moderators for publishing. 
		 Use the 'Draft' button to save any changes while you are working on it.
		 You'll get an email to confrim your submission and another notifying you when it's published.
	</p>
<?php }


//code.tutsplus.com/articles/customizing-the-wordpress-admin-help-text--wp-33281
?>
