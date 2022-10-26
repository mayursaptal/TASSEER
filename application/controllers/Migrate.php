<?php

class Migrate extends MY_Controller
{

    public function index($id = '')
    {

        $this->load->library('migration');

        $this->migration->__construct();
        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        }
    }
}
