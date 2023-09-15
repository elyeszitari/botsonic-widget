<?php
/**
 * Plugin Name: WP Botsonic Free
 * Description: Start Using Botsonic Chatbot free with our free Botsonic Plugin.
 * Author: 		Elyes ZITARI
 * Author URI: 	https://www.zitari.com/
 * Version: 	1.0.1
 * License:  	GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: wp-botsonic-free
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly
define( 'WP_BOTSONIC_FREE_ROOT', __FILE__ );
define( 'WP_BOTSONIC_FREE_URL', plugins_url( '/', WP_BOTSONIC_FREE_ROOT ) );
define( 'WP_BOTSONIC_FREE_PATH', plugin_dir_path( WP_BOTSONIC_FREE_ROOT ) );
define( 'WP_BOTSONIC_FREE_BASE', plugin_basename( WP_BOTSONIC_FREE_ROOT ) );

function wp_botsonic_free_get_token(){
	$wp_botsonic_free_token = get_option('wp_botsonic_free_token') ? get_option('wp_botsonic_free_token') : '';
	return $wp_botsonic_free_token;
}

function wp_botsonic_free_get_loggedin(){
	$wp_botsonic_free_loggedin = get_option('wp_botsonic_free_loggedin') ? get_option('wp_botsonic_free_loggedin') : '0';
	return $wp_botsonic_free_loggedin;
}

// Required File
require_once ( WP_BOTSONIC_FREE_PATH .'includes/class.wp-botsonic-free.php' );
