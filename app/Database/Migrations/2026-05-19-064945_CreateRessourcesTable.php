<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRessourcesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nom' => ['type' => 'VARCHAR', 'constraint' => 100],
            'type' => ['type' => 'VARCHAR', 'constraint' => 50], // salle, cours, terrain...
            'capacite' => ['type' => 'INT', 'constraint' => 11],
            'description' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ressources');
    }

    public function down() { $this->forge->dropTable('ressources'); }
}