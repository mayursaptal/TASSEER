<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Drivers extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Driver_model');
    }

    public function index_get($id = '')
    {
        $this->response(["drivers endpoint."], 200);
    }


    public function signup_post()
    {
        $errors = array();

        $name_en = $this->post('name_en');
        $name_arb = $this->post('name_arb');
        $email = $this->post('email');
        $phone = $this->post('phone');
        $vehicle_type = $this->post('vehicle_type');
        $vehicle_number = $this->post('vehicle_number');
        $vehicle_brand_name = $this->post('vehicle_brand_name');
        $password = $this->post('password');
        $about_you = $this->post('about_you');

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

        if (empty($vehicle_type)) {
            $errors[] = "Vehicle type is required";
        }

        if (empty($vehicle_number)) {
            $errors[] = "Vehicle number is required";
        }

        if (empty($vehicle_brand_name)) {
            $errors[] = "Vehicle brand name is required";
        }

        if (!empty($errors)) {
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }

        $emails = $this->Driver_model->get_count(array(
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

        $origanlPass =  $password;

        $password = hash('sha256', $password);

        $insert = $this->Driver_model->add(array(
            'name_en' => $name_en,
            'name_arb' => $name_arb,
            'email' => $email,
            'phone' => $phone,
            'vehicle_type' => $vehicle_type,
            'vehicle_number' => $vehicle_number,
            'vehicle_brand_name' => $vehicle_brand_name,
            'password' => $password,
            'about_you' => $about_you
        ));

        $subject = "OTP of Tasserr";
        $body = $this->load->view(
            'UI/email_template/signup_email_view',
            array('password' => $origanlPass, 'email' => $email, 'name' => $name_en ? $name_en : $name_arb),
            true
        );

        $headers = "Content-Type: text/html; charset=UTF-8\r\n";

        mail($email, $subject, $body,   $headers);

        return $this->response([
            "success" => $insert,
            "errors" =>  $errors,
            "data" => $insert ?  ["message" => "Driver created successfully"] : [],
        ],  $insert ? RestController::HTTP_CREATED : RestController::HTTP_NOT_ACCEPTABLE);
    }

    public function login_post()
    {
        // email pass
        $errors = array();
        $email = $this->post('email');
        $password = $this->post('password');

        if (empty($email)) {
            $errors[] = "Please Enter Email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid Email";
        }

        if (empty($password)) {
            $errors[] = "Please Enter Password";
        }

        if (!empty($errors)) {
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }
        $password = hash('sha256', $password);

        $this->db->select(array(
            "id",
            "uuid",
            "name_en",
            "name_arb",
            "email",
            "phone",
            "token"
        ));

        $driver = $this->Driver_model->get(array(
            "email" => $email,
            "password" => $password
        ));

        if (empty($driver['data'])) {
            $errors[] = "Invalid Logins";
        }

        return $this->response([
            "success" =>
            $driver['data'] ? true : false,
            "errors" =>  $errors,
            "data" => $driver ? $driver['data'] : [],
        ],  $driver['data'] ? RestController::HTTP_OK : RestController::HTTP_NOT_ACCEPTABLE);
    }



    function random($length = 6)
    {


        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $result = $randomString;
        return $result;
    }

    public function reset_post()
    {
        // email 
        $errors = array();
        $email = $this->post('email');

        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid Email";
        }

        if (!empty($errors)) {
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }


        $emails = $this->Driver_model->get_count(array(
            'email' => $email
        ));

        if (!$emails) {
            $errors[] = "Email not exist";
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }

        $otp = $this->random(6);



        $this->Driver_model->update(array(
            'otp' => $otp
        ), array(
            'email' => $email
        ));


        $subject = "OTP of Tasserr";
        $body = $this->load->view(
            'UI/email_template/otp_email_view',
            array('otp' => $otp),
            true
        );

        $headers = "Content-Type: text/html; charset=UTF-8\r\n";

        $resp =  mail($email, $subject, $body,  $headers);

        return $this->response([
            "success" => $resp,
            "errors" =>  $errors,
            "data" =>  [],
        ],  $resp ? RestController::HTTP_OK : RestController::HTTP_NOT_ACCEPTABLE);
    }

    public function verify_post()
    {
        // email otp 
        $errors = array();
        $email = $this->post('email');
        $otp = $this->post('otp');

        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid Email";
        }

        if (empty($otp)) {
            $errors[] = "otp is required";
        }

        if (!empty($errors)) {
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }

        $this->db->select(array(
            "id",
            "uuid",
            "name_en",
            "name_arb",
            "email",
            "phone",
            "token"
        ));


        $driver = $this->Driver_model->get(array(
            "email" => $email,
            "otp" => $otp
        ));


        if (empty($driver['data'])) {
            $errors[] = "Invalid Email/OTP";
        }

        return $this->response([
            "success" =>
            $driver['data'] ? true : false,
            "errors" =>  $errors,
            "data" => $driver ? $driver['data'] : [],
        ],  $driver['data'] ? RestController::HTTP_OK : RestController::HTTP_NOT_ACCEPTABLE);
    }

    function change_post($password = 'password')
    {

        $errors = array();
        $oldpassword = $this->post('old_password');
        $newpassword = $this->post('new_password');


        if (empty($oldpassword)) {
            $errors[] = "Please Enter Old Password";
        }

        if (empty($newpassword)) {
            $errors[] = "Please Enter Password";
        }

        $token = $this->head('token');



        if (empty($token)) {
            $errors[] = "User token missing in header.";
        }


        if (!empty($errors)) {
            return $this->response([
                "success" => false,
                "errors" =>  $errors,
                "data" => []
            ], RestController::HTTP_BAD_REQUEST);
        }


        $oldpassword  = hash('sha256',   $oldpassword);
        $newpassword  = hash('sha256',   $newpassword);


        $resp =  $this->Driver_model->update(array(
            'password' => $newpassword
        ), array(
            'token' => $token,
            'password' => $oldpassword
        ));


        $this->db->select(array(
            "id",
            "uuid",
            "name_en",
            "name_arb",
            "email",
            "phone",
            "token"
        ));



        $driver = $this->Driver_model->get(array(
            "password" => $newpassword,
            "token" => $token
        ));
        return $this->response([
            "success" =>
            $driver['data'] ? true : false,
            "errors" =>  $errors,
            "data" => $driver ? $driver['data'] : [],
        ],  $driver['data'] ? RestController::HTTP_OK : RestController::HTTP_NOT_ACCEPTABLE);
    }
}
