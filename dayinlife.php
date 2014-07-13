<?php
/*
Plugin Name: A Day in the Life setup 
Description: Provides default settings and pages for A Day in the Life. 
Author: Neontribe
Author URI: http://www.neontribe.co.uk
*/ 

define( 'DIL_PATH', plugin_dir_path( __FILE__ ) );

define( 'DIL_LOCATION', plugin_basename( __FILE__ ) );

define( 'DIL_URL', plugins_url( '' ,  __FILE__ ) );

require_once ( DIL_PATH . 'dil-init-settings.php' );
