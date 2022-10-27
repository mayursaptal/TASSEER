<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Users extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index_get($id = '')
    {
        $this->response(["users endpoint."], 200);
    }


    public function signup_post()
    {
        $errors = array();

        $name_en = $this->post('name_en');
        $name_arb = $this->post('name_arb');
        $email = $this->post('email');
        $phone = $this->post('phone');
        $password = $this->post('password');

        if (empty($name_en) && empty($name_arb)) {
            $errors[] = "Name is required";
        }

        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid Email";
        }

        if (empty($phone)) {
            $errors[] = "Phone is required";
        }

        if (empty($password)) {
            $errors[] = "Password is required";
        }

        if (!empty($errors)) {
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }

        $emails = $this->User_model->get_count(array(
            'email' => $email
        ));

        if ($emails) {
            $errors[] = "Email already exist";
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }

        $password = hash('sha256', $password);

        $insert = $this->User_model->add(array(
            'name_en' => $name_en,
            'name_arb' => $name_arb,
            'email' => $email,
            'phone' => $phone,
            'password' => $password
        ));


        return $this->response([
            "success" => $insert,
            "errors" =>  $errors,
            "data" => $insert ?  ["message" => "user created successfully"] : [],
        ],  $insert ? RestController::HTTP_CREATED : RestController::HTTP_NOT_ACCEPTABLE);


    }

    public function login_post()
    {
        // email pass
    }

    public function reset_post()
    {
        // email 
    }

    public function verify_post()
    {
        // otp 
    }
}
