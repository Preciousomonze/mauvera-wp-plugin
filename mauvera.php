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
