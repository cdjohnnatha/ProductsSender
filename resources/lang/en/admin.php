<?php

return [

    'form' => [
        'name' => 'Name',
        'surname'    => 'Surname',
        'country'  => 'Country',
        'phone'   => 'Phone number',
        'actions' => 'Actions'
    ],

    'panel' => [
        'dashboard' => 'Dashboard',
        'admin' => [
            'label' => 'Admin',
            'list' => 'List of Adms',
            'create' => 'Create new Admin'
        ],
        'warehouses' => [
            'label' => 'Warehouses',
            'list' => 'List of Warehouses',
            'create' => 'Create new Warehouse'
        ],
        'packages' => [
            'label' => 'Packages',
            'list' => 'Packages on warehouse',
            'create' => 'Create new Package'
        ],

        'subscriptions' => [
            'label' => 'Plans',
            'list' => 'Existent plans',
            'create' => 'Create new plan'
        ]
    ],

    'error' => [
        'select_manager' => 'It is required choose a manager'
    ]
];
