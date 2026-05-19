<?php

namespace App\Controllers;

use App\Models\CreneauModel;

class Home extends BaseController
{
    // Affiche la page d'accueil publique
    public function index(): string
    {
        return view('welcome_message');
    }

    // Permet de voir les créneaux disponibles sans être connecté
    public function creneauxPublics(): string
    {
        $creneauModel = new CreneauModel();
        
        // On récupère les créneaux futurs avec leurs ressources associées
        $data['creneaux'] = $creneauModel->select('creneaux.*, ressources.nom as ressource_nom, ressources.type as ressource_type, ressources.description as ressource_desc')
                                         ->join('ressources', 'ressources.id = creneaux.ressource_id')
                                         ->where('creneaux.actif', 1)
                                         ->where('creneaux.date_debut >=', date('Y-m-d H:i:s'))
                                         ->orderBy('creneaux.date_debut', 'ASC')
                                         ->findAll();

        return view('creneaux_publics', $data);
    }
}