<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WebForms extends MY_Controller
{

    function index()
    {
        $this->load->view('WebForms/builder');
    }
}
