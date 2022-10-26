<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = $this->db->dbprefix('invoice');
    }
}
