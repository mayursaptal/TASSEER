<?php
defined('BASEPATH') or exit('No direct script access allowed');


return $config['menu'] =
    [
        "User Management" => [
            [
                'name'  => 'User',
                'url'   => 'users',
                'icons' => 'fas fa-user'
            ],
            [
                'name'  => 'Driver',
                'url'   => 'drivers',
                'icons' => 'fas fa-users'
            ],
        ],
    ];
