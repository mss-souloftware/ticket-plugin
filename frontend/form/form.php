<?php
/**
 * 
 * @package Ticket System
 * @subpackage M. Sufyan Shaikh
 * 
*/


function ticketing_frontend()
{
    ob_start(); ?>

<h2>
    Form Shortcode Here!
</h2>


<?php
    return ob_get_clean();
}
