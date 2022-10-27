<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_user_model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = $this->db->dbprefix('admin_user');
    }
}
