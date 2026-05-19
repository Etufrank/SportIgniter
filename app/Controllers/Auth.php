<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController {
    protected $helpers = ['form'];

    public function login() {
        return view('auth/login');
    }

    public function register() {
        return view('auth/register');
    }

    public function registerHandler() {
        $userModel = new UserModel();
        $nomComplet = $this->request->getPost('prenom') . ' ' . $this->request->getPost('nom');
        
        $data = [
            'nom' => $nomComplet,
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'client',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $userModel->insert($data);
        return redirect()->to('auth/login')->with('info', 'Compte créé ! Connectez-vous.');
    }

    public function loginHandler() {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'user_nom' => $user['nom'],
                'user_role' => $user['role'],
                'isLoggedIn' => true
            ]);

            if ($user['role'] === 'admin') {
                return redirect()->to('admin/dashboard');
            }
            return redirect()->to('client/dashboard');
        }

        return redirect()->back()->with('error', 'Identifiants incorrects.');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('auth/login');
    }
}