<?php
/**
 * 
 * @package Ticket System
 * @subpackage M. Sufyan Shaikh
 * 
*/

//Frontend Templates
require_once plugin_dir_path(__DIR__) . '/frontend/form/form.php';

//Backend Templates
require_once plugin_dir_path(__DIR__) . '/admin/templates/tickets-list.php';

// Actions
require_once plugin_dir_path(__DIR__) . '/utils/formsubmission/form.php';


function ticketing_frontend_script() { 
    wp_enqueue_script( 'frontenScript', plugins_url( '../src/js/script.js', __FILE__ ), ['jquery'], null, true ); 
    wp_enqueue_style( 'frontenStyle', plugins_url( '../src/css/style.css', __FILE__ ), array(), false );
   
    wp_localize_script( 'frontenScript', 'ajax_variables', array(
      'ajax_url'       => admin_url( 'admin-ajax.php' ),
      'nonce'          => wp_create_nonce( 'my-ajax-nonce' )
    ));
  }
  add_action( 'wp_enqueue_scripts', 'ticketing_frontend_script' ); 


add_shortcode( 'ticketing-form', 'ticketing_frontend' );

// Hook to 'admin_menu' action to create menus.
add_action('admin_menu', 'custom_plugin_menu');

// Ticket Form submission
add_action('wp_ajax_submit_ticket_form', 'submit_ticket_form');
add_action('wp_ajax_nopriv_submit_ticket_form', 'submit_ticket_form');

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
