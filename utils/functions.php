<?php
/**
 * 
 * @package Ticket System
 * @subpackage M. Sufyan Shaikh
 * 
*/

require_once plugin_dir_path(__DIR__) . '/frontend/form/form.php';

add_shortcode( 'ticketing-form', 'ticketing_frontend' );

// Hook to 'admin_menu' action to create menus.
add_action('admin_menu', 'custom_plugin_menu');

function custom_plugin_menu() {
    add_menu_page(
        'Ticketing System',         
        'Ticketing System',         
        'manage_options',        
        'cts-ticket',       
        'custom_plugin_page',     
        'dashicons-admin-generic',
        6                         
    );

    // Add submenu pages
    add_submenu_page(
        'cts-ticket',        
        'Settings Page',         
        'Settings',              
        'manage_options',        
        'cts-ticket-payment',
        'custom_plugin_settings'  
    );
}

// Callback function to display content for the main menu page
function custom_plugin_page() {
    echo '<h1>Welcome to the Custom Plugin Page</h1>';
    echo '<p>This is the main page of your custom plugin.</p>';
}

// Callback function to display content for the Settings submenu page
function custom_plugin_settings() {
    echo '<h1>Settings Page</h1>';
    echo '<p>Here you can add settings for your plugin.</p>';
}
