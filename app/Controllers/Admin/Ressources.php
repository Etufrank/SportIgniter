<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\RessourceModel;

class Ressources extends BaseController {
    protected $helpers = ['form'];

    public function index() {
        if (session()->get('user_role') !== 'admin') return redirect()->to('auth/login');
        
        $ressourceModel = new RessourceModel();
        $data['ressources'] = $ressourceModel->findAll();
        return view('admin/ressources', $data);
    }

    public function store() {
        $ressourceModel = new RessourceModel();
        $ressourceModel->insert([
            'nom' => $this->request->getPost('nom'),
            'type' => $this->request->getPost('type'),
            'capacite' => $this->request->getPost('capacite'),
            'description' => $this->request->getPost('description')
        ]);
        return redirect()->to('admin/ressources');
    }

    public function delete($id) {
        $ressourceModel = new RessourceModel();
        $ressourceModel->delete($id);
        return redirect()->to('admin/ressources');
    }
}