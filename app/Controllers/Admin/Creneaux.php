<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\CreneauModel;
use App\Models\RessourceModel;

class Creneaux extends BaseController {
    protected $helpers = ['form'];

    public function index() {
        if (session()->get('user_role') !== 'admin') return redirect()->to('auth/login');
        
        $creneauModel = new CreneauModel();
        $ressourceModel = new RessourceModel();

        $data['creneaux'] = $creneauModel->getCreneauxComplets();
        $data['ressources'] = $ressourceModel->findAll();

        return view('admin/creneaux', $data);
    }

    public function store() {
        $creneauModel = new CreneauModel();
        $creneauModel->insert([
            'ressource_id' => $this->request->getPost('ressource_id'),
            'date_debut' => $this->request->getPost('date_debut'),
            'date_fin' => $this->request->getPost('date_fin'),
            'places_dispo' => $this->request->getPost('places_dispo'),
            'actif' => 1
        ]);
        return redirect()->to('admin/creneaux');
    }

    public function delete($id) {
        $creneauModel = new CreneauModel();
        $creneauModel->delete($id);
        return redirect()->to('admin/creneaux');
    }
}