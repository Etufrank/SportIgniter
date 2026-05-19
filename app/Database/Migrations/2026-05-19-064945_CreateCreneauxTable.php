<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCreneauxTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ressource_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'date_debut' => ['type' => 'DATETIME'],
            'date_fin' => ['type' => 'DATETIME'],
            'places_dispo' => ['type' => 'INT', 'constraint' => 11],
            'actif' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ressource_id', 'ressources', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('creneaux');
    }

    public function down() { $this->forge->dropTable('creneaux'); }
}