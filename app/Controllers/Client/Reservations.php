<?php
namespace App\Controllers\Client;
use App\Controllers\BaseController;
use App\Models\CreneauModel;
use App\Models\ReservationModel;

class Reservations extends BaseController {
    protected $helpers = ['form'];

    public function reserver() {
        if (!session()->get('isLoggedIn')) return redirect()->to('auth/login');
        
        $creneauModel = new CreneauModel();
        $data['creneaux'] = $creneauModel->getCreneauxComplets();
        return view('client/reserver', $data);
    }

    public function store($creneauId) {
        $creneauModel = new CreneauModel();
        $reservationModel = new ReservationModel();

        $creneau = $creneauModel->find($creneauId);

        if ($creneau && $creneau['places_dispo'] > 0 && $creneau['actif'] == 1) {
            $reservationModel->insert([
                'user_id' => session()->get('user_id'),
                'creneau_id' => $creneauId,
                'statut' => 'en attente',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $creneauModel->update($creneauId, [
                'places_dispo' => $creneau['places_dispo'] - 1
            ]);

            return redirect()->to('client/dashboard')->with('info', 'Réservation enregistrée.');
        }

        return redirect()->back()->with('error', 'Plus de places disponibles.');
    }

    public function annuler($id) {
        $reservationModel = new ReservationModel();
        $creneauModel = new CreneauModel();

        $reservation = $reservationModel->find($id);
        if ($reservation && $reservation['statut'] === 'en attente') {
            $reservationModel->update($id, ['statut' => 'annulee']);
            
            $creneau = $creneauModel->find($reservation['creneau_id']);
            $creneauModel->update($reservation['creneau_id'], [
                'places_dispo' => $creneau['places_dispo'] + 1
            ]);
        }

        return redirect()->to('client/dashboard');
    }
}