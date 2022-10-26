<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    public $table;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function add($args)
    {
        if (empty($args)) {
            throw new Exception("Invalide Arguments", 1);
        }

        $this->db->set('uuid', time() . '-' . uniqid());
        return $this->db->insert($this->table, $args);
    }


    function update($args, $where)
    {
        $this->db->where($where);
        return $this->db->update($this->table, $args);
    }


    function get($where = array(), $start = 0, $limit = 10)
    {


        if (!empty($where)) {
            if (!empty($where['search'])) {
                $fields = $this->db->field_data($this->table);
                foreach ($fields as $field) {
                    $this->db->or_like($field->name, $where['search']);
                }
            }
            unset($where['search']);
            $this->db->where($where);
        }
        $query = $this->db->get($this->table,  $limit, $start);
        return array(
            'data' => $query->result()
        );
    }

    function get_count()
    {
        return  $this->db->count_all($this->table);
    }
}
