<?php
namespace App\Controllers\Client;
use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Models\UserModel;

class Dashboard extends BaseController {
    public function index() {
        if (!session()->get('isLoggedIn')) return redirect()->to('auth/login');
        
        $reservationModel = new ReservationModel();
        $data['reservations'] = $reservationModel->getReservationsClient(session()->get('user_id'));
        return view('client/dashboard', $data);
    }

    public function profil() {
        if (!session()->get('isLoggedIn')) return redirect()->to('auth/login');
        
        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('user_id'));
        return view('client/profil', $data);
    }

    public function updateProfil() {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $data = ['nom' => $this->request->getPost('nom')];
        
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $data);
        session()->set('user_nom', $data['nom']);
        
        return redirect()->to('client/profil')->with('info', 'Profil mis à jour.');
    }
}