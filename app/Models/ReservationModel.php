<?php
namespace App\Models;
use CodeIgniter\Model;

class ReservationModel extends Model {
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'creneau_id', 'statut', 'created_at'];

    public function getReservationsClient($userId) {
        return $this->select('reservations.*, ressources.nom as ressource_nom, creneaux.date_debut, creneaux.date_fin')
                    ->join('creneaux', 'creneaux.id = reservations.creneau_id')
                    ->join('ressources', 'ressources.id = creneaux.ressource_id')
                    ->where('reservations.user_id', $userId)
                    ->findAll();
    }

    public function getReservationsGlobal() {
        return $this->select('reservations.*, users.nom as user_nom, users.email as user_email, ressources.nom as ressource_nom, creneaux.date_debut, creneaux.date_fin')
                    ->join('users', 'users.id = reservations.user_id')
                    ->join('creneaux', 'creneaux.id = reservations.creneau_id')
                    ->join('ressources', 'ressources.id = creneaux.ressource_id')
                    ->findAll();
    }

    public function getTotalReservations() {
        return $this->countAllResults();
    }
}