<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PicklistOption extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('PicklistOption_Model');
        $this->model = $this->PicklistOption_Model;
    }

    public $fields =  array(

        array(
            'type'  => '',
            'attr'  => array(),
            'class' => 'col-md-12',
            'name'  => 'id',
            'label' => 'ID',
        ),


        array(
            'type'  => 'text',
            'attr'  => array(),
            'class' => 'col-md-12',
            'name'  => 'name',
            'label' => 'Option',
        ),

        array(
            'type'  => 'text',
            'attr'  => array(),
            'class' => 'col-md-12',
            'name'  => 'value',
            'label' => 'value',
        ),
        array(
            'type'  => 'select',
            'attr'  => array(),
            'class' => 'col-md-12',
            'name'  => 'status',
            'label' => 'Status',
            'options' => array(

                array(
                    'value' => 1,
                    'label' => 'Active'
                ),
                array(
                    'value' => 0,
                    'label' => 'InActive'
                )
            )
        ),

        array(
            'type'          => 'lookup',
            'model'         => 'PicklistCategory_Model',
            'show_lable'    => 'name',
            'attr'  => array(),
            'class' => 'col-md-12',
            'name'  => 'category',
            'label' => 'Category',
        ),

        array(
            'type'  => 'textarea',
            'attr'  => array('rows' => 5),
            'name'  => 'description',
            'label' => 'Description',
            'class' => 'col-md-12',
            'hideColumn' => true
        ),
    );
}
