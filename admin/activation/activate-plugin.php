<?php
/**
 * 
 * @package Ticket System
 * @subpackage M. Sufyan Shaikh
 * 
*/

function createAllTables(){
    global $wpdb;
    $ctp_registered = "ctp_registered"; 
    if(get_option($ctp_registered) != null){
        return;
    } else { 
        try {  
            $table_plugin = $wpdb->prefix . "custom_ticket_plugin"; 
            $charset_collate = $wpdb->get_charset_collate();
           
            $createTablePlugin = "CREATE TABLE $table_plugin  (
                id int(11) NOT NULL AUTO_INCREMENT,
                nombre varchar(150) NOT NULL,
                frase varchar(150) NOT NULL,
                email varchar(150) NOT NULL,
                telefono int(11) NOT NULL,
                cp int(11) NOT NULL,
                ciudad varchar(150) NOT NULL,
                province varchar(150) NOT NULL,
                message varchar(550) NOT NULL,
                direccion varchar(150) NOT NULL,
                enProceso tinyint(1) NOT NULL DEFAULT 0,
                enviado tinyint(1) NOT NULL DEFAULT 0,
                pagoRealizado tinyint(1) NOT NULL DEFAULT 0,
                fechaEntrega date NOT NULL,
                id_venta varchar(150) NOT NULL DEFAULT 'null',
                nonce varchar(50) NOT NULL,
                fecha timestamp NOT NULL DEFAULT current_timestamp(),
                precio float(10,2) NOT NULL,
                express varchar(3) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";
         
            require_once ABSPATH . "wp-admin/includes/upgrade.php"; 
            dbDelta( $createTablePlugin );
           
        } catch (\Throwable $erro) {
            error_log($erro->getMessage());
            return $erro;
        } 
        add_option($ctp_registered, true);   
    } 
}

function removeAllTables(){


    global $wpdb; 

    $table_plugin = $wpdb->prefix . "custom_ticket_plugin";

    try {
        $removal_pluginDatabase = "DROP TABLE IF EXISTS {$table_plugin}";
        $remResult2 = $wpdb->query( $removal_pluginDatabase );

        return $remResult2;
    } catch (\Throwable $erro) {
        error_log($erro->getMessage());
        return $erro;
    }
}
