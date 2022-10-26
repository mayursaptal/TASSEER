<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PicklistCategory_Model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = $this->db->dbprefix('picklist_category');
    }
}
