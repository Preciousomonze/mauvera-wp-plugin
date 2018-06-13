<?php
/**
 * @package Mauvera
 */
/*
Plugin Name: Mauvera
Plugin URI: https://mauvera.com/
Description: The mauvera ticket plugin for easily setting up buying tickets directly from your wordpress site.
Version: 1.0.0
Author: Precious Omonzejele
Author URI: https://omonze.peepsipi.com/
License: MIT
Text Domain: mauvera
*/

// Make sure we don't do something useful if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Yo!  I\'m just a plugin, not much I can do when called directly. I love being moved along with the wp family';
	exit;
}
define( 'MAUV_PK_PLUGIN_DIR',  plugin_dir_path( __FILE__ ) );
define('MAUV_PK_ADMIN_PATH', 'inc/admin/');
 define('MAUV_PK_ASSETS_PATH', plugins_url('assets/',__FILE__));
  
  
//version
$mauv_pk_version = '1.0';
//start enqeueing
if(!function_exists('mauv_pk_js_enqueue')){
	function mauv_pk_js_script() {
		//p_enqueue_script('NameMySccript','path/to/MyScript','dependencies_MyScript', 'VersionMyScript', 'InfooterTrueorFalse');
		wp_register_script('mauv_pk_js-buy-ticket','https://mauvera.com/static/js/webpack_bundles/inlineplugin.js',null,$mauv_pk_version,true);
		wp_enqueue_script( 'mauv_pk_js-buy-ticket');
		//new jquery
		wp_enqueue_script('mauv_pk_js-jquery','https://code.jquery.com/jquery-3.2.0.min.js','','',true);
		 wp_localize_script('mauv_pk_js-jquery','mauvjquerydata',array('integrity'=>"sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=",'crossorigin'=>"anonymous"));
		 //migrate
			wp_enqueue_script('mauv_pk_js-jquery-migrate','https://code.jquery.com/jquery-migrate-3.0.0.min.js','','',true);
		 wp_localize_script('mauv_pk_js-jquery-migrate','mauvjquerymigdata',array('integrity'=>"sha256-JklDYODbg0X+8sPiKkcFURb5z7RvlNMIaE3RA2z97vw=",'crossorigin'=>"anonymous"));
		
		//for tinymce. please this must be loaded in the admin side
		wp_localize_script('mauv_pk_js-buy-ticket','mauvimagesrc',array('path'=>MAUV_PK_ASSETS_PATH.'images/'));
		
		//local script
		wp_register_script('mauv_pk_js-buy-ticket-trigger',plugins_url( '/assets/js/script.js', __FILE__ ),array('jquery','jquery-migrate'),$mauv_pk_version,true);
		wp_enqueue_script( 'mauv_pk_js-buy-ticket-trigger');
	}
}
//just incase we encounter a wretched theme that doesn't have wp_footer(), we should hook up with print scripts
add_action( 'wp_print_scripts', 'mauv_pk_js_script' );

//adding css
if(!function_exists('mauv_pk_css_enqueue')){

function mauv_pk_css_enqueue() {        
	wp_enqueue_style( 'mauv_pk_css-style',plugins_url( '/assets/css/style.css', __FILE__ ));
    }
}
add_action( 'wp_enqueue_scripts', 'mauv_pk_css_enqueue' );


if(is_admin()){
	include_once MAUV_PK_ADMIN_PATH.'Tinymce.php';
}
//include everywhere incase :)
include_once MAUV_PK_ADMIN_PATH.'shortcodes.php';


