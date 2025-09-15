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
    $data = (new DataHandler())->getData();
    echo 'here';
    echo var_dump($data);
    die('line no 22 main plugin file');
	    //(new DataHandler())->getData();
    new AdminPage();
}

add_action( 'plugins_loaded', 'shees_cstuom_plugin_loaded_hook' );


function custom_Plugin_Activation(){
}


function custom_Plugin_Deactivation(){
}

