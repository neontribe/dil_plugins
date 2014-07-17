<?php
/*
Plugin Name: A Day in the Life word count limit 
Description: Provides error message if contributor goes over word count. Limit set at 700 words. Message can be edited in file by developer. No GUI. 
Author: Neontribe
Author URI: http://www.neontribe.co.uk
*/ 

/**
 * Validation for post word count - triggered on insert post data.
 * Throws wp_die error if post body is over word count
 */

function maxWord($data, $postarr){
	$overlimit = false;
	if (current_user_can('contributor')) {
		$id = $postarr['ID'];
		$num = 700; //set this to the maximum number of words
	  $content = $data['post_content'];
		$wordcount = str_word_count($content);
		if ($wordcount > $num) {
      $overlimit = true;
	  }
	}
	if ($overlimit) {
		$data['post_status'] = 'draft';
	  wp_die( __('Your post has too many words. You curently have ' . $wordcount  . ' words. Please edit to get the count below ' . $num . '.'),
			 'Error',  array( 'response' => 500, 'back_link' => true ));
	}
	return $data;
}
add_action('wp_insert_post_data', 'maxWord', 10, 2); 

// Could try tiggering on save instead.

// Do we want this to stop admins too or only contributors?

//Doesn't auto populate the title field if word count too long on first 
//save when you go back to edit. (probably have same issue with custom fields).

//Might be confusing to user with satuses and revision versions etc.

?>
