<?php
namespace App\Models;
use CodeIgniter\Model;

class CreneauModel extends Model {
    protected $table = 'creneaux';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ressource_id', 'date_debut', 'date_fin', 'places_dispo', 'actif'];

    public function getCreneauxComplets() {
        return $this->select('creneaux.*, ressources.nom as ressource_nom, ressources.type as ressource_type, ressources.capacite as ressource_capacite')
                    ->join('ressources', 'ressources.id = creneaux.ressource_id')
                    ->findAll();
    }

    public function getCreneauxFuturs(){
        return $this->select('creneaux.*, ressources.nom as ressource_nom, ressources.type as ressource_type, ressources.description as ressource_desc')
                                         ->join('ressources', 'ressources.id = creneaux.ressource_id')
                                         ->where('creneaux.actif', 1)
                                         ->where('creneaux.date_debut >=', date('Y-m-d H:i:s'))
                                         ->orderBy('creneaux.date_debut', 'ASC')
                                         ->findAll();
    }

    public function getTotalCreneaux() {
        return $this->countAllResults();
    }
    
}