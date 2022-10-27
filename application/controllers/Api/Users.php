<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Users extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get($id = '')
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];



        if ($id === null) {
            // Check if the users data store contains users
            if ($users) {
                // Set the response and exit
                $this->response($users, 200);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'No users were found'
                ], 404);
            }
        } else {
            if (array_key_exists($id, $users)) {
                $this->response($users[$id], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such user found'
                ], 404);
            }
        }
    }
}
