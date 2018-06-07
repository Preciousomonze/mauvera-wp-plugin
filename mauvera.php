<?php
/**
 * @package Mauvera
 */
/*
Plugin Name: Mauvera
Plugin URI: https://mauvera.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: activate the Akismet plugin and then go to your Akismet Settings page to set up your API key.
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
//version
$mauv_pk_version = '1.0';
//start enqeueing
if(!function_exists('mauv_pk_js_enqueue')){
	function mauv_pk_js_script() {
		//p_enqueue_script('NameMySccript','path/to/MyScript','dependencies_MyScript', 'VersionMyScript', 'InfooterTrueorFalse');
		wp_register_script('mauv_pk_js-buy-ticket','https://mauvera.com',null,$mauv_pk_version,true);
		wp_enqueue_script( 'mauv_pk_js-buy-ticket');
	}
}
//just incase we encounter a wretched theme that doesn't have wp_footer(), we should hook up with print scripts
add_action( 'wp_print_scripts', 'mauv_pk_js_script' );
