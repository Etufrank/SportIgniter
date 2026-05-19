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
        $data['creneaux'] = $creneauModel->getCreneauxFuturs();

        return view('creneaux_publics', $data);
    }
}