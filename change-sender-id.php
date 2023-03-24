<?php
/**
 * Plugin Name: Change Sender ID
 * Plugin URI: https://github.com/skylarng89/change-sender-id
 * Description: A plugin to change the sender name and sender email of a WordPress website.
 * Version: 1.0.0
 * Author: Patrick Aziken
 * Author URI: https://github.com/skylarng89
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: change-sender-id
 * Domain Path: /languages
 * Tested up to: 6.1
 * Stable tag: 1.0.0
*/


// Define constants
define( 'CHANGE_SENDER_ID_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'CHANGE_SENDER_ID_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include plugin files
defined( 'ABSPATH' ) or die( 'Access denied.' );
require_once( CHANGE_SENDER_ID_PLUGIN_DIR_PATH . 'includes/functions.php' );
require_once( CHANGE_SENDER_ID_PLUGIN_DIR_PATH . 'includes/settings.php' );

// Enqueue admin scripts
function change_sender_id_admin_enqueue_scripts() {
    wp_enqueue_style( 'change-sender-id-admin-style', CHANGE_SENDER_ID_PLUGIN_URL . 'assets/css/main.css' );
    wp_enqueue_script( 'change-sender-id-admin-script', CHANGE_SENDER_ID_PLUGIN_URL . 'assets/js/app.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'change_sender_id_admin_enqueue_scripts' );

// Enqueue public scripts
function change_sender_id_public_enqueue_scripts() {
    wp_enqueue_style( 'change-sender-id-public-style', CHANGE_SENDER_ID_PLUGIN_URL . 'assets/css/main.css' );
    wp_enqueue_script( 'change-sender-id-public-script', CHANGE_SENDER_ID_PLUGIN_URL . 'assets/js/app.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'change_sender_id_public_enqueue_scripts' );

// Add settings link on plugin page
function change_sender_id_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=change-sender-id-address">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'change_sender_id_add_settings_link' );

?>