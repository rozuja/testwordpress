<?php
/**
 * Plugin Name: Test Plugin
 * Plugin URI:  
 * Description: Tests Plugin for 
 * Version:     1.0
 * Author:      Your Name
 * Author URI:  https://example.com
 * License:     GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

//Enque front end CSS and Scripts
function my_plugin_enqueue_scripts() {
    wp_enqueue_style( 'my-plugin-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
    wp_enqueue_script( 'my-plugin-script', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'my_plugin_enqueue_scripts' );

//Enque admin styles
function my_custom_admin_styles() {
    // Enqueue a custom CSS file
    wp_enqueue_style('my-admin-css', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'my_custom_admin_styles');

//Includes

require_once plugin_dir_path(__FILE__) .'core/adminpanel.php';
require_once plugin_dir_path(__FILE__) .'core/coursesjson.php';
require_once plugin_dir_path(__FILE__) .'core/sc.php';