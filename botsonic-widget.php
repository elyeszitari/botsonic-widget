<?php
/**
 * Plugin Name: Botsonic Widget
 * Description: Start Using Botsonic Chatbot with our free Botsonic Widget Plugin.
 * Author: 		Elyes ZITARI
 * Author URI: 	https://www.zitari.com/
 * Version: 	1.0.1
 * License:  	GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: botsonic-widget
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly
define( 'BOTSONIC_WIDGET_ROOT', __FILE__ );
define( 'BOTSONIC_WIDGET_URL', plugins_url( '/', BOTSONIC_WIDGET_ROOT ) );
define( 'BOTSONIC_WIDGET_PATH', plugin_dir_path( BOTSONIC_WIDGET_ROOT ) );
define( 'BOTSONIC_WIDGET_BASE', plugin_basename( BOTSONIC_WIDGET_ROOT ) );

function botsonic_widget_get_token(){
	$botsonic_widget_token = get_option('botsonic_widget_token') ? get_option('botsonic_widget_token') : '';
	return $botsonic_widget_token;
}

function botsonic_widget_get_loggedin(){
	$botsonic_widget_loggedin = get_option('botsonic_widget_loggedin') ? get_option('botsonic_widget_loggedin') : '0';
	return $botsonic_widget_loggedin;
}

// Required File
require_once ( BOTSONIC_WIDGET_PATH .'includes/class.botsonic-widget.php' );
