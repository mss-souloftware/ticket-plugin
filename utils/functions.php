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

// Backend Scripts
function clt_admin_style() {
  wp_enqueue_style( 'backendStyle', plugins_url( '../src/css/bck-style.css', __FILE__ ), array(), false );
  wp_enqueue_script( 'backendScript', plugins_url( '../src//js/bck-script.js', __FILE__ ), array(), '1.0.0', true ); 
  wp_localize_script( 'backendScript', 'ajax_variables', array(
    'ajax_url'    => admin_url( 'admin-ajax.php' ),
    'nonce'  => wp_create_nonce( 'my-ajax-nonce' ),
  ));
}
add_action('admin_enqueue_scripts', 'clt_admin_style');

// Frontend Scripts
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


// Add an AJAX handler for deleting a single ticket
add_action('wp_ajax_delete_single_ticket', 'delete_single_ticket');
function delete_single_ticket() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_ticket_plugin';

    // Get the ticket ID from the AJAX request
    $ticket_id = isset($_POST['ticket_id']) ? intval($_POST['ticket_id']) : 0;

    if ($ticket_id) {
        // Delete the ticket
        $deleted = $wpdb->delete($table_name, ['id' => $ticket_id]);

        if ($deleted) {
            wp_send_json_success(['message' => 'Ticket deleted successfully.']);
        } else {
            wp_send_json_error(['message' => 'Failed to delete ticket.']);
        }
    } else {
        wp_send_json_error(['message' => 'Invalid ticket ID.']);
    }

    wp_die();
}



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