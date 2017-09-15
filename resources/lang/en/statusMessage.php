<?php

return [
    'global_message' => [
        'attribute' => [
            'created' => 'The :entity :attribute was created successfully',
            'updated' => 'The :entity :attribute was updated successfully',
            'deleted' => 'The :entity :attribute was deleted successfully',
        ],

        'entity' =>[
            'created' => 'The :entity was created successfully',
            'updated' => 'The :entity was updated successfully',
            'deleted' => 'The :entity was deleted successfully',
            'confirmed' => 'The :entity was confirmed successfully',
        ],

        'subscription' => [
            'active' => 'The active status of plan # :attribute was changed successfully',
            'principal_offer' => 'The principal offer status of plan # :attribute was changed successfully',
        ],

        'address' => [
            'created' => 'The address :attribute was updated successfully',
            'updated' => 'The address :attribute was created successfully',
            'deleted' => 'The address :attribute was deleted successfully',
        ]
    ],

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'errors' => [
        'address_autocomplete' => 'Please type again your address and select it from google.',
    ],


    'account' => 'Account is already confirmed! Please, login',

    'incoming_package' => [
        'user_create' => 'Package created, the warehouse will be informed.'
    ]

];
