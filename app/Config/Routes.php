<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('creneaux-publics', 'Home::creneauxPublics'); 


$routes->get('auth/login', 'Auth::login');
$routes->post('auth/loginHandler', 'Auth::loginHandler');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/registerHandler', 'Auth::registerHandler');
$routes->get('auth/logout', 'Auth::logout');


$routes->group('client', function ($routes) {
    $routes->get('dashboard', 'Client\Dashboard::index');
    $routes->get('profil', 'Client\Dashboard::profil');
    $routes->post('profil/update', 'Client\Dashboard::updateProfil');
    $routes->get('reserver', 'Client\Reservations::reserver');
    $routes->get('reservations/store/(:num)', 'Client\Reservations::store/$1');
    $routes->get('reservations/annuler/(:num)', 'Client\Reservations::annuler/$1');
});


$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('clients', 'Admin\Dashboard::clients');
    $routes->get('dashboard/statut/(:num)/(:alpha)', 'Admin\Dashboard::changerStatut/$1/$2');
    $routes->get('ressources', 'Admin\Ressources::index');
    $routes->post('ressources/store', 'Admin\Ressources::store');
    $routes->get('ressources/delete/(:num)', 'Admin\Ressources::delete/$1');
    $routes->get('creneaux', 'Admin\Creneaux::index');
    $routes->post('creneaux/store', 'Admin\Creneaux::store');
    $routes->get('creneaux/delete/(:num)', 'Admin\Creneaux::delete/$1');
});