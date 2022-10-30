<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Drivers extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Driver_model');
        $this->model = $this->Driver_model;
        $this->load->database();
    }

    public $fields =  array(

        array(
            'type'  => '',
            'attr'  => array(),
            'class' => 'col-md-6',
            'name'  => 'id',
            'label' => 'ID',
        ),


        array(
            'type'  => 'text',
            'attr'  => array(),
            'class' => 'col-md-6',
            'name'  => 'name_en',
            'label' => 'Name',
        ),

        array(
            'type'  => 'text',
            'attr'  => array(),
            'class' => 'col-md-6',
            'name'  => 'name_arb',
            'label' => 'اسم',
        ),
        array(
            'type'  => 'text',
            'attr'  => array(
                'type' => 'email'
            ),
            'class' => 'col-md-6',
            'name'  => 'email',
            'label' => 'Email',
        ),
        array(
            'type'  => 'text',
            'attr'  => array(
                'type' => 'text'
            ),
            'class' => 'col-md-6',
            'name'  => 'phone',
            'label' => 'Phone',
        ),
        array(
            'type'  => 'text',
            'attr'  => array(
                'type' => 'text'
            ),
            'class' => 'col-md-3',
            'name'  => 'vehicle_type',
            'label' => 'Vehicle Type',
        ),
        array(
            'type'  => 'text',
            'attr'  => array(
                'type' => 'text'
            ),
            'class' => 'col-md-3',
            'name'  => 'vehicle_number',
            'label' => 'Vehicle Number',
        ),
        array(
            'type'  => 'text',
            'attr'  => array(
                'type' => 'text'
            ),
            'class' => 'col-md-6',
            'name'  => 'vehicle_brand_name',
            'label' => 'Vehicle Band Name',
        ), 
        array(
            'type'  => 'textarea',
            'attr'  => array(
                'type' => 'textarea'
            ),
            'class' => 'col-md-12',
            'name'  => 'about_you',
            'label' => 'About you and Vehicle',
            "hideColumn" => true
        ),
    );
}
