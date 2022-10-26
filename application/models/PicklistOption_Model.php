<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PicklistOption_Model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = $this->tbl_picklist_option = $this->db->dbprefix('picklist_option');
        $this->tbl_picklist_category = $this->db->dbprefix('picklist_category');
    }

    function  getOptions($code)
    {
        $sql = "
        Select pick.id , pick.name , pick.value from  $this->tbl_picklist_option as pick
        left join  $this->tbl_picklist_category as pickcat 
        on category = pickcat.id 
        where code = '$code'";
        $query =    $this->db->query($sql);
        return  $query->result();
    }
}
