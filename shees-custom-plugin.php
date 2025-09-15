<?php
/*
Plugin Name: Shees Custom Plugin
Plugin URI: https://exmaple.com/
Description: Lorem Ipsum Dolor Sit Umet.
Version: 1.0.0
*/

register_activation_hook( __FILE__, 'custom_Plugin_Activation' );
register_deactivation_hook( __FILE__, 'custom_Plugin_Deactivation' );


require __DIR__ . '/vendor/autoload.php';

use SheesPlugin\DataHandler;
use SheesPlugin\AdminPage;

function shees_cstuom_plugin_loaded_hook() {
    //$data = (new DataHandler())->getData();
    
    new DataHandler();
    new AdminPage();
}

add_action( 'plugins_loaded', 'shees_cstuom_plugin_loaded_hook' );




// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'shees_custom_plugin_enque' );

/**
 * Enqueues the custom CSS file for the plugin.
 */
function shees_custom_plugin_enque() {

    // Register the stylesheet
    wp_register_style(
        'shees-custom-plugin-css', // Unique handle for the stylesheet
        plugins_url( 'assets/css/main.css', __FILE__ ), // Full URL to the stylesheet
        array(), // Dependencies (e.g., other stylesheets to load first)
        '1.0', // Version number
        'all' // Media type (e.g., 'all', 'screen', 'print')
    );

    // Enqueue the registered stylesheet
    wp_enqueue_style( 'shees-custom-plugin-css' );
}




function custom_Plugin_Activation(){
}


function custom_Plugin_Deactivation(){
}

