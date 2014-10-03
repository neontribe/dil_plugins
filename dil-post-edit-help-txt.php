<?php
/*
Plugin Name: A Day in the Life post edit help text 
Description: Provides help text meta boxes for post. Text can be edited in file by developer. No GUI. 
Author: Neontribe
Author URI: http://www.neontribe.co.uk
*/ 

/**
* Add metabox below editing pane
*/
function dil_metabox_after_title() {
	    add_meta_box( 'after-title-help', 'Tips for writing your story', 'dil_after_title_help_metabox_content', 'post', 'side', 'high' );
} 
add_action( 'add_meta_boxes', 'dil_metabox_after_title' );

/**
 * callback function to populate metabox
 */
function dil_after_title_help_metabox_content() { 
  $tips_page = get_page_by_title( 'Tips for writing your story' );
        if ($tips_page) {
          echo $tips_page->post_content;
        }
        else {    
    echo 'For detailed guidelines and contributing FAQs click the dropdown help tab in the top right of this page.';
        }
        }

/**
 * Add help text to right of screen in a metabox
 */
function dil_metabox_top_right() {
	add_meta_box( 'above-publish-help', 'Publishing and Saving Changes', 'dil_top_right_help_metabox_content', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'dil_metabox_top_right' );

/**
 * callback function to populate metabox
 */
function dil_top_right_help_metabox_content() { ?>
	<p>
		 Make sure you click 'Submit for review' below once you've finished your story, to send it to our moderators for publishing. 
		 Use the 'Draft' button to save any changes while you are working on it.
		 You'll get an email to confirm your submission and another notifying you when it's published.
	</p>
<?php }

/**
* Add contextual help tab to post edit screen
* 
*/
function dil_contextual_help( $help_text, $screen_id, $screen ) {
  switch ($screen_id) {
    case 'post':
      $screen->remove_help_tabs(); // To remove wordpress defaults
      $screen->add_help_tab( array(
	'id' => 'guidelines',
	'title' => 'Day in the Life guidelines',
	'content' => '', // From callback
	'callback' => 'dil_post_guidelines',
      ));
      $screen->add_help_tab( array(
	'id' => 'other-info',
	'title' => 'Day in the Life FAQs about contributing',
  'content' => '', // From callback
  'callback' => 'dil_post_faq_contrib',
      ));
      $screen->set_help_sidebar(
	      '<p></p>'
      );
      return;
      
      default:
      return;
  }
}

/**
* Callback - Help text guidelines for post pages
*/
function dil_post_guidelines() {
echo '<h3>Guidelines for writing a post</h3>';
$guidelines_page = get_page_by_title( 'Writing Guidelines' );

$strip_email = str_replace( '[email]', '', $guidelines_page->post_content );
$guidelines_page_content = str_replace( '[/email]', '', $strip_email );
echo $guidelines_page_content;
}

/**
* Callback - Help text FAQ and contributing for post pages
*/
function dil_post_faq_contrib() {
echo '<h3>FAQs about contributing</h3>';
$contrib_page = get_page_by_title( 'Contributing' );

$strip_email = str_replace( '[email]', '', $contrib_page->post_content );
$contrib_page_content = str_replace( '[/email]', '', $strip_email );
echo $contrib_page_content;
}

add_action( 'contextual_help', 'dil_contextual_help', 5, 3);

//code.tutsplus.com/articles/customizing-the-wordpress-admin-help-text--wp-33281
?>
