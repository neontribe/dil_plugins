<?php

define( 'DIL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) . 'dayinlife.php' );

register_activation_hook( DIL_PLUGIN_PATH, 'dil_init_settings' );

/**
 * Initialise A Day in the Life site options.
 */
function dil_init_settings() { 
	// Set up core defaults options vars in wp_options table.
	// http://codex.wordpress.org/Option_Reference
	$core_settings = array(
		'default_comment_status' => 'closed',
		'default_role' => 'contributor',
		'comments_per_page' => 0,
		'blogdescription' => __( 'A Day in the Life Slogan' ),
		'date_format' => __( 'j F Y' ),
		'permalink_structure' => '/%postname%/',
	);
	foreach ( $core_settings as $k => $v ) {
		update_option( $k, $v );
	}
	//Delete dummy content.
	wp_delete_post( 1, true );
	wp_delete_post( 2, true );
	wp_delete_comment( 1 );
}


/**
 * Clear unused metaboxes from Contributor edit post view.
 *
 * Remove format, comments, image from default post type.
 *
 * Show tags, categories, and editflow boxes for admin only
 *
 */
function dil_remove_post_format_comment() {
	remove_meta_box( 'formatdiv', 'post', 'side' ); // Formats
  remove_meta_box( 'commentsdiv', 'post', 'normal' ); // Comments
  remove_meta_box( 'postimagediv', 'post', 'side' ); //Featured image
  if ( !current_user_can( 'manage_options' ) && !current_user_can('editor') ) {
    remove_meta_box( 'tagsdiv-post_tag','post','side' ); // Tags Metabox
    remove_meta_box( 'categorydiv','post','side' ); // Categories Metabox
    remove_meta_box( 'ef_editorial_meta', 'post', 'side' ); // Edit Flow Editorial metadata
	  remove_meta_box( 'edit-flow-editorial-comments', 'post', 'normal' ); // Edit Flow Editorial Comments
	}
}
add_action('do_meta_boxes', 'dil_remove_post_format_comment');

/**
 * Callback for filters - return false if user is not admin or editor.
 */
function dil_is_admin() {
  if (!current_user_can( 'manage_options' ) && !current_user_can('editor')) {
	  return false;
	} else {
  return true;
	}
}
add_filter('screen_options_show_screen', 'dil_is_admin'); // Remove screen layout options dropdown tab from contrib post edit view.


/**
 * Remove tools and comments from menus.
 */
function dil_remove_admin_menu_items() {
  $items = array('edit-comments.php', 'tools.php');
  foreach ($items as $item) {
    remove_menu_page($item);
  }
	if (!dil_is_admin()) {
	  remove_menu_page('index.php');
	}
}
add_action('admin_menu', 'dil_remove_admin_menu_items');

/**
 *  Remove comments link from admin bar.
 */
function dil_remove_admin_bar_items() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'dil_remove_admin_bar_items');

/**
 *  If user is a contributor, revoke wysiwyg editor.
 * DITCHED in favour of plugin to customise allowed wysiwyg buttons.
 
function dil_wysiwyg_settings() {
   if (!current_user_can('manage_options')) { 
	   add_filter( 'user_can_richedit', '__return_false' );
		 add_action( 'admin_print_styles-profile.php', 'hide_rich_edit_option' );
		 add_action( 'admin_print_styles-user-edit.php', 'hide_rich_edit_option' );	
	 }
}
*/

/**
 * Hide option to use rich editor (on user profile).
 * Called for non-admins wehen user_can_richedit is forced to false.
 
function hide_rich_edit_option() {
	?><style type="text/css">
		label[for=rich_editing] input { display: none; }
	  label[for=rich_editing]:before { content: 'This option has been disabled. (Formerly: ' }
		label[for=rich_editing]:after { content: ')'; }
		</style><?php
}

add_action('init', 'dil_wysiwyg_settings');
*/

?>
