<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Models\UserModel;

class Dashboard extends BaseController {
    public function index() {
        if (session()->get('user_role') !== 'admin') return redirect()->to('auth/login');
        
     $reservationModel =new ReservationModel();
        $userModel        = new UserModel();
        $creneauModel     = new CreneauModel();

   $data['total_reservations']      = $reservationModel->getTotalReservations();
        $data['total_clients']      = $userModel->getTotalClients();
        $data['total_creneaux']     = $creneauModel->getTotalCreneaux();


        $reservationModel = new ReservationModel();
        $data['reservations'] = $reservationModel->getReservationsGlobal();

        return view('admin/dashboard', $data);
    }

    public function clients() {
        if (session()->get('user_role') !== 'admin') return redirect()->to('auth/login');
        
        $userModel = new UserModel();
        $data['clients'] = $userModel-> getClient();
        return view('admin/liste_clients', $data);
    }

    public function changerStatut($id, $statut) {
        $reservationModel = new ReservationModel();
        $reservationModel->update($id, ['statut' => $statut]);
        return redirect()->to('admin/dashboard');
    }
}