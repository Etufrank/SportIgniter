<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Models\UserModel;

class Dashboard extends BaseController {
    public function index() {
        if (session()->get('user_role') !== 'admin') return redirect()->to('auth/login');
        
        $db = \Config\Database::connect();
        $data['total_reservations'] = $db->table('reservations')->countAllResults();
        $data['total_clients'] = $db->table('users')->where('role', 'client')->countAllResults();
        $data['total_creneaux'] = $db->table('creneaux')->countAllResults();
        
        $reservationModel = new ReservationModel();
        $data['reservations'] = $reservationModel->getReservationsGlobal();

        return view('admin/dashboard', $data);
    }

    public function clients() {
        if (session()->get('user_role') !== 'admin') return redirect()->to('auth/login');
        
        $userModel = new UserModel();
        $data['clients'] = $userModel->where('role', 'client')->findAll();
        return view('admin/liste_clients', $data);
    }

    public function changerStatut($id, $statut) {
        $reservationModel = new ReservationModel();
        $reservationModel->update($id, ['statut' => $statut]);
        return redirect()->to('admin/dashboard');
    }
}