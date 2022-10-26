<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_Picklist_Option extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            "id"        => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            "uuid" => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                // 'default' => 'UUID_SHORT()',
            ],
            "name" => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            "value" => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            "status" => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            "category" => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            "description" => [
                'type' => 'TEXT',
                'null' => TRUE,
            ]
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('picklist_option');
    }

    public function down()
    {
        $this->dbforge->drop_table('picklist_option');
    }
}
