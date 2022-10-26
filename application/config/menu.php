<?php
defined('BASEPATH') or exit('No direct script access allowed');


return $config['menu'] =
    [
        "Sales Force Automation" => [
            [
                'name'  => 'Leads',
                'url'   => 'leads',
                'icons' => 'fas fa-user-clock'
            ],
            [
                'name'  => 'Contacts',
                'url'   => 'Contacts',
                'icons' => 'fas fa-address-book'
            ],
      
            [
                'name'  => 'Accounts',
                'url'   => 'Accounts',
                'icons' => 'fas fa-id-card'
            ],
          
            [
                'name'  => 'Activities',
                'url'   => 'leads',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Forecasts',
                'url'   => 'Forecasts',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Deal Management',
                'url'   => 'Deals',
                'icons' => 'fas fa-fw fa-chart-area'
            ]
        ],
        "Manage Inventory " => [
            [
                'name'  => 'Products',
                'url'   => 'Products',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Price Books',
                'url'   => 'PriceBooks',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Vendors',
                'url'   => 'Vendors',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Quotes',
                'url'   => 'Quotes',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Sales Orders',
                'url'   => 'SalesOrders',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Purchase Orders',
                'url'   => 'PurchaseOrders',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Invoices',
                'url'   => 'Invoices',
                'icons' => 'fas fa-fw fa-chart-area'
            ]
        ],

        // "Marketing" => [
        //     [
        //         'name'  => 'Web Forms',
        //         'url'   => 'WebForms',
        //         'icons' => 'fas fa-fw fa-chart-area'
        //     ]
        // ],

        "Users and Control" => [
            [
                'name'  => 'User Management',
                'url'   => 'Users',
                'icons' => 'fas fa-fw fa-chart-area'
            ],

            [
                'name'  => 'Role Management',
                'url'   => 'ManagingRoles',
                'icons' => 'fas fa-fw fa-chart-area'
            ],

            [
                'name'  => 'Group Management',
                'url'   => 'ManageGroups',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Territory Management',
                'url'   => 'Territories',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
            [
                'name'  => 'Profile Permissions',
                'url'   => 'Profiles',
                'icons' => 'fas fa-fw fa-chart-area'
            ],
        ],

        "Pick List" => [[
            'name'  => 'Category',
            'url'   => 'PicklistCategory',
            'icons' => 'fas fa-fw fa-chart-area'
        ], [
            'name'  => 'Options',
            'url'   => 'PicklistOption',
            'icons' => 'fas fa-fw fa-chart-area'
        ]],


        // "Billing" => [
        //     [
        //         'name'  => 'Billing',
        //         'url'   => 'Billing',
        //         'icons' => 'fas fa-fw fa-chart-area'
        //     ]
        // ]
    ];
