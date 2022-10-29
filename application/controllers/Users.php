<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->model = $this->User_model;
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
            'class' => 'col-md-12',
            'name'  => 'email',
            'label' => 'Email',
        ),
        array(
            'type'  => 'text',
            'attr'  => array(
                'type' => 'text'
            ),
            'class' => 'col-md-12',
            'name'  => 'phone',
            'label' => 'Phone',
        )
    );
}
