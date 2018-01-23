<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 27/12/17
 * Time: 16:37
 */

return [

    'index' => [
        'make_payment' => 'Make Payment',
        'inbox' => 'Inbox',
        'history' => 'History',
        'orders' => 'Orders',
        'order' => 'Order',
        'title' => 'Title',
        'short_title_inbox' => 'Orders at inbox can be found here',
        'short_title_history' => 'Orders which are not at index can be found here',
        'invoice' => 'Invoice',
        'status' => 'Status'
    ],

    'table_fragment' => [
        'uuid' => 'UUID',
        'status' => 'Status',
        'updated_at' => 'Updated At',
        'amount' => 'Amount',
        'invoice_status' => 'Invoice Status'
    ],

    'tooltip' => [
        'generate_payment' => 'Generate Payment'
    ],

    'warehouse' => [
        'messages' => [
            'send_status_warning' => 'It is not allowed change status for sent without payment'
        ]
    ],

];