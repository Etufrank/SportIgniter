<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FitspaceSeeder extends Seeder
{
    public function run()
    {
        // 1. CRÉATION DES UTILISATEURS (Différenciation par la colonne 'role')
        
        // L'Administrateur unique
        $this->db->table('users')->insert([
            'nom'        => 'Responsable FitSpace',
            'email'      => 'admin@fitspace.com',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'admin',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Les Clients standards
        $clients = [
            ['nom' => 'Lucas Martin', 'email' => 'lucas@email.com'],
            ['nom' => 'Emma Bernard', 'email' => 'emma@email.com'],
            ['nom' => 'Thomas Petit', 'email' => 'thomas@email.com'],
        ];

        foreach ($clients as $client) {
            $this->db->table('users')->insert([
                'nom'        => $client['nom'],
                'email'      => $client['email'],
                'password'   => password_hash('client123', PASSWORD_DEFAULT),
                'role'       => 'client',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        // 2. CRÉATION DES RESSOURCES
        $this->db->table('ressources')->insert([
            'nom'         => 'Salle de Musculation',
            'type'        => 'salle',
            'capacite'    => 15,
            'description' => 'Espace cardio et poids libres en accès libre.'
        ]);
        $this->db->table('ressources')->insert([
            'nom'         => 'Terrain de Foot Indoor',
            'type'        => 'terrain',
            'capacite'    => 10,
            'description' => 'Terrain synthétique idéal pour du 5vs5.'
        ]);
        $this->db->table('ressources')->insert([
            'nom'         => 'Cours de Yoga Pilates',
            'type'        => 'cours',
            'capacite'    => 8,
            'description' => 'Session zen avec instructeur certifié.'
        ]);

        // 3. CRÉATION DE BEAUCOUP DE CRÉNEAUX (SANS RÉSERVATION)
        $demain = date('Y-m-d', strtotime('+1 day'));
        $apresDemain = date('Y-m-d', strtotime('+2 days'));
        $dansTroisJours = date('Y-m-d', strtotime('+3 days'));

        $creneaux = [
            // Créneaux pour Demain
            ['ressource_id' => 1, 'date_debut' => "$demain 09:00:00", 'date_fin' => "$demain 11:00:00", 'places_dispo' => 15],
            ['ressource_id' => 1, 'date_debut' => "$demain 14:00:00", 'date_fin' => "$demain 16:00:00", 'places_dispo' => 15],
            ['ressource_id' => 2, 'date_debut' => "$demain 18:00:00", 'date_fin' => "$demain 19:30:00", 'places_dispo' => 10],
            ['ressource_id' => 3, 'date_debut' => "$demain 10:30:00", 'date_fin' => "$demain 11:30:00", 'places_dispo' => 8],

            // Créneaux pour Après-Demain
            ['ressource_id' => 1, 'date_debut' => "$apresDemain 08:30:00", 'date_fin' => "$apresDemain 10:30:00", 'places_dispo' => 15],
            ['ressource_id' => 2, 'date_debut' => "$apresDemain 12:00:00", 'date_fin' => "$apresDemain 13:30:00", 'places_dispo' => 10],
            ['ressource_id' => 2, 'date_debut' => "$apresDemain 20:00:00", 'date_fin' => "$apresDemain 21:30:00", 'places_dispo' => 10],
            ['ressource_id' => 3, 'date_debut' => "$apresDemain 17:00:00", 'date_fin' => "$apresDemain 18:00:00", 'places_dispo' => 8],

            // Créneaux pour Dans 3 Jours
            ['ressource_id' => 1, 'date_debut' => "$dansTroisJours 15:00:00", 'date_fin' => "$dansTroisJours 17:00:00", 'places_dispo' => 15],
            ['ressource_id' => 2, 'date_debut' => "$dansTroisJours 16:30:00", 'date_fin' => "$dansTroisJours 18:00:00", 'places_dispo' => 10],
            ['ressource_id' => 3, 'date_debut' => "$dansTroisJours 09:00:00", 'date_fin' => "$dansTroisJours 10:00:00", 'places_dispo' => 8],
        ];

        foreach ($creneaux as $c) {
            $this->db->table('creneaux')->insert([
                'ressource_id' => $c['ressource_id'],
                'date_debut'   => $c['date_debut'],
                'date_fin'     => $c['date_fin'],
                'places_dispo' => $c['places_dispo'],
                'actif'        => 1
            ]);
        }
    }
}