<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PicklistCategory extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('PicklistCategory_Model');
        $this->model = $this->PicklistCategory_Model;
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
            'label' => 'category',
        ),

        array(
            'type'  => 'text',
            'attr'  => array(),
            'class' => 'col-md-12',
            'name'  => 'code',
            'label' => 'code',
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
            'type'  => 'textarea',
            'attr'  => array('rows' => 5),
            'name'  => 'description',
            'label' => 'Description',
            'class' => 'col-md-12',
            'hideColumn' => true
        ),
    );





    function featchTable()
    {

        $draw = $this->input->post('draw');
        $search = $this->input->post('search');
        $length = $this->input->post('length');
        $start = $this->input->post('start');
        $totalRecords  =  $this->PicklistCategory_Model->get_count();
        $raw_data =   $this->PicklistCategory_Model->get(array('search' => @$search['value']), $start, $length);
        $totalRecordwithFilter  = $totalRecords;
        $data = array();
        foreach ($raw_data['data'] as $key => $row) {
            $data[$key] = $row;
            $data[$key]->status = $data[$key]->status ? "Active" : "InActive";
            $data[$key]->action = $this->load->view('UI/action_view', (array)$row, true);
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        echo json_encode($response);
    }
}
