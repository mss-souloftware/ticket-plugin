<?php
/**
 * 
 * @package Ticket System
 * @subpackage M. Sufyan Shaikh
 * 
 */

function custom_plugin_page() { 
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_ticket_plugin';

    // Fetch all rows from the custom ticket plugin table
    $results = $wpdb->get_results("SELECT * FROM $table_name");

    if ($results) { ?>
<div class="ticket-list">
    <h2>Submitted Tickets</h2>
    <table>
        <thead>
            <tr>
                <th>Task</th>
                <th>Date</th>
                <th>Time</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row) {?>
            <tr>
                <td><?php echo esc_html($row->task); ?></td>
                <td><?php echo esc_html($row->selectedDate); ?></td>
                <td><?php echo esc_html($row->selectedTime); ?></td>
                <td><?php echo esc_html($row->userAddress); ?></td>
                <td><?php echo esc_html($row->email); ?></td>
                <td><?php echo esc_html($row->phone); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php 
    } else { 
        echo '<p>No tickets found.</p>';
    }
}