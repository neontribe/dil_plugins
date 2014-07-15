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
 * Remove format and comments from default post type.
 *
 * Show tags and categories for admin only
 *
 */
function dil_remove_post_format_comment() {
	remove_meta_box( 'formatdiv', 'post', 'side' ); // Formats
  remove_meta_box( 'commentsdiv', 'post', 'normal' ); // Comments
  remove_meta_box( 'postimagediv', 'post', 'side' ); //Featured image
  if ( !current_user_can( 'manage_options' ) ) {
    remove_meta_box( 'tagsdiv-post_tag','post','side' ); // Tags Metabox
    remove_meta_box( 'categorydiv','post','side' ); // Categories Metabox
  }
}
add_action('add_meta_boxes', 'dil_remove_post_format_comment');

/**
 * Remove tools and comments from menus.
 */
function dil_remove_admin_menu_items() {
  $items = array('edit-comments.php', 'tools.php');
  foreach ($items as $item) {
    remove_menu_page($item);
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
?>
