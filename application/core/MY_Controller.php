<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $fields = array();
    public $model;

    public static $auth_mapping = array(
        'welcome' => array(
            'login', 'logout', 'register'
        ),
        'migrate' => array('index')
    );

    function __construct()
    {
        parent::__construct();

        // $this->output->cache(1);
        $this->output->delete_cache();

        $this->isLoggedIn();

        // $this->output->enable_profiler(TRUE);

        $this->cleanRequest();
    }

    function isLoggedIn()
    {

        if ($this->isAuthRoute()) {
            return;
        }

        $user =   $this->session->userdata('user');
        if (!$user) {
            redirect(base_url() . 'welcome/login');
        }
    }

    function isAuthRoute()
    {
        $class = trim(strtolower($this->router->fetch_class()));
        $method = trim(strtolower($this->router->fetch_method()));


        if (!isset(self::$auth_mapping[$class])) {
            return false;
        }

        if (!in_array($method, self::$auth_mapping[$class])) {

            return false;
        }

        return true;
    }

    public function cleanRequest()
    {
        $purifier = new HTMLPurifier();
        if (!empty($_GET)) {
            foreach ($_GET as $key => $val) {
                $this->cleanHtml($_GET, $key,  $purifier);
            }
        }

        if (!empty($_POST)) {
            foreach ($_POST as $key => $val) {
                $this->cleanHtml($_POST, $key,  $purifier);
            }
        }

        if (!empty($_REQUEST)) {
            foreach ($_POST as $key => $val) {
                $this->cleanHtml($_REQUEST, $key,  $purifier);
            }
        }
    }

    public function cleanHtml(&$globalVar, $key,  $purifier)
    {
        if (is_array($globalVar[$key])) {
            foreach ($globalVar[$key] as $subKey => $subVar) {
                $this->cleanHtml($globalVar[$key], $subKey,  $purifier);
            }
        } else {
            $globalVar[$key] = htmlentities($purifier->purify($globalVar[$key]));
        }
    }


    function slug($string, $spaceRepl = "-")
    {
        $string = str_replace("&", "and", $string);

        $string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);

        $string = strtolower($string);

        $string = preg_replace("/[ ]+/", " ", $string);

        $string = str_replace(" ", $spaceRepl, $string);

        return $string;
    }


    function xcopy($src, $dest)
    {
        foreach (scandir($src) as $file) {

            if (($file == '.') || ($file == '..')) {
                continue;
            }

            if (!is_readable($src . DIRECTORY_SEPARATOR . $file)) continue;
            if (is_dir($src .  DIRECTORY_SEPARATOR . $file) && ($file != '.') && ($file != '..')) {
                mkdir($dest . DIRECTORY_SEPARATOR . $file);
                $this->xcopy($src . DIRECTORY_SEPARATOR . $file, $dest . DIRECTORY_SEPARATOR . $file);
            } else {
                copy($src . DIRECTORY_SEPARATOR . $file, $dest . DIRECTORY_SEPARATOR . $file);
            }
        }
    }

    function generateSite($name)
    {
        $site_slug = $this->slug($name);
        $site_path = SITE_ROOT . DIRECTORY_SEPARATOR . $site_slug;
        if (is_dir($site_path)) {
            $site_path .= '-' . time();
        }
        mkdir($site_path);
        if (is_dir($site_path)) {
            $this->xcopy(SITE_ROOT . DIRECTORY_SEPARATOR . 'test', $site_path);
        }
        return str_replace(SITE_ROOT . DIRECTORY_SEPARATOR, '', $site_path);
    }


    public function page($view, $args = array(), $return = false)
    {

        if (!isset($args['CI'])) {
            $args['CI'] = $this;
        }
        $html = $this->load->view($view, $args, true);
        $html_args = array(
            'content'   => $html,
            'menu'      => $this->getMenu()
        );
        $html_args  = array_merge($html_args, $args);
        return $this->load->view('UI/page_view', $html_args, $return);
    }

    private function getMenu()
    {
        return $this->config->load('menu') ? $this->config->item('menu') : array();
    }

    protected function getForm($config = array())
    {

        $config = array_merge(array(
            'is_details' => false
        ), $config);
        $this->getLoopUp();

        return $this->load->view('UI/form_view', array(
            'fields' => $this->fields,
            'config' =>  $config
        ), true);
    }




    function getLoopUp()
    {
        $lookups = array();

        foreach ($this->fields as $key => $field) {
            if ($field['type'] == 'lookup') {
                $lookups[]  =  $field;
            }

            if (isset($field['sub_type'])) {
                if ($field['sub_type'] == 'picklist') {
                    $this->fields[$key]['options'] = $this->getPicklistOption($field['category_code']);
                }
            }
        }


        return $lookups;
    }

    protected function tableConfig($config = array())
    {
        $coreConfig = array(
            'processing' => true,
            'serverSide' => true,
            'serverMethod' => 'post',
            'ajax'      => array(
                'url' => base_url()
            ),
            'columns' => array()
        );
        foreach ($this->fields as $field) {
            if (isset($field['hideColumn']) && $field['hideColumn']) {
                continue;
            }
            $coreConfig['columns'][] = array(
                'data' => $field['name']
            );
        }
        $coreConfig['columns'][] = array(
            'data'    =>  'action'
        );

        return array_merge($coreConfig, $config);
    }


    public $picklistSaved  = array();
    function getPicklistOption($code)
    {

        if (isset($picklistSaved[$code])) {
            return $picklistSaved[$code];
        }

        $this->load->model('PicklistOption_Model');
        $picklist = $this->PicklistOption_Model->getOptions($code);
        $picklistOptions = array();
        foreach ($picklist as $option) {
            $picklistOptions[] = array(
                'value' => $option->id,
                'label' => $option->name,
            );
        }
        return   $picklistSaved[$code] = $picklistOptions;
    }

    function lookup()
    {
        $data = array();
        $model =  $this->input->get('model');
        $show_lable =  $this->input->get('show_lable');
        $search = $this->input->get('search');
        $this->load->model($model);

        if ($search) {
            $results =    $this->$model->get(array('search' => $search));
            foreach ($results['data'] as $result) {
                $data[] = array(
                    "id" => $result->id,
                    "text" => $result->$show_lable
                );
            }
        }


        die(json_encode(array(
            "results" => $data
        )));
    }



    function getMask()
    {
        $maskInput = array();

        foreach ($this->fields as $field) {
            if (isset($field['mask'])) {
                $maskInput[$field['name']] = $field['mask'];
            }
        }

        return $maskInput;
    }


    // 



    public function add()
    {

        $form = $this->input->post('form');
        if ($form) {
            if ($this->model->add($form)) {
                redirect(base_url() . get_class($this));
                exit();
            }
        }
        $data = array('form_html' => $this->getForm());
        $this->page('UI/module/add_view', $data);
    }



    public function delete($id)
    {
    }
    public  function edit($id)
    {
        $data = array();
        $form = $this->input->post('form');
        if ($form) {

            if ($this->model->update($form, array(
                'uuid' => $id
            ))) {
                redirect(base_url() .  get_class($this));
                exit();
            }
        } else {
            $saveData = $this->model->get(array(
                'uuid' => $id
            ));

            $data = (array)$saveData['data'][0];
            $data['form_html'] =  $this->getForm(array(
                'save' => $saveData['data']
            ));
        }

        $this->page('UI/module/edit_view', $data);
    }

    public  function index($id = null)
    {
        if (!empty($id)) {
            return $this->details($id);
        }
        $this->list();
    }
    public function list()
    {
        $token_name = $this->security->get_csrf_token_name();
        $token_hash = $this->security->get_csrf_hash();

        $data = array('fields' => $this->fields, 'tableConfig' => $this->tableConfig(array(
            'ajax' => array(
                'url' => base_url() .  get_class($this) . '/featchTable',
                'data' => array(
                    $token_name => $token_hash
                )
            )
        )));
        $this->page('UI/module/list_view', $data);
    }

    function featchTable()
    {

        $draw = $this->input->post('draw');
        $search = $this->input->post('search');
        $length = $this->input->post('length');
        $start = $this->input->post('start');
        $totalRecords  =  $this->model->get_count();
        $raw_data =   $this->model->get(array('search' => @$search['value']), $start, $length);
        $totalRecordwithFilter  = $totalRecords;
        $data = array();
        foreach ($raw_data['data'] as $key => $row) {
            $data[$key] = $row;
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

    public  function save()
    {
    }
    public function details($id)
    {
        $saveData = $this->model->get(array(
            'uuid' => $id
        ));


        $data = (array)$saveData['data'][0];
        $data['form_html'] =  $this->getForm(array(
            'save' => $saveData['data'],
            'is_details' => true
        ));
        $this->page('UI/module/details_view', $data);
    }
}
