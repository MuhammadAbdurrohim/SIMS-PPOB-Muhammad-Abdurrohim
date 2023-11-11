<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Registration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE, // Since the ID should be a positive integer
                'auto_increment' => TRUE,
                'primary_key'    => TRUE,
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255, // The maximum length of an email address is typically 255 characters
                'unique'         => TRUE,
            ],
            'first_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255, // A reasonable length for a first name
            ],
            'last_name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255, // A reasonable length for a last name
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255, // A reasonable length for a password
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('registration');
    }

    public function down()
    {
        $this->forge->dropTable('registration');
    }
}
