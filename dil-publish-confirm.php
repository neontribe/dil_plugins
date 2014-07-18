<?php
/*
Plugin Name: A Day in the Life publish and submit confirm 
Description: Prompts the writer for confirmation that the post is ready for publication.
Version: 1.0
Author: Neonribe
Author URI: http://www.neontribe.co.uk
*/



function confirm_publish(){
  if (current_user_can('contributor')) {
	  $message = 'Please click ok to submit your story for review and confirm that you agree to our terms and conditions.'; 
  }	else {
	  $message = 'Are you sure this post is ready to publish? It should have been read and tagged by 2 reviewers and passed all guidelines.';
  }
?>	
<script type="text/javascript"><!--
var publish = document.getElementById("publish");
if (publish !== null) publish.onclick = function(){
	return confirm(" <?php echo $message?> ");
};
// --></script>';
<?php }

add_action('admin_footer', 'confirm_publish');
?>
