<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/loginHandler', 'Auth::loginHandler');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/registerHandler', 'Auth::registerHandler');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('client/dashboard', 'Client\Dashboard::index');
$routes->get('client/profil', 'Client\Dashboard::profil');
$routes->post('client/profil/update', 'Client\Dashboard::updateProfil');
$routes->get('client/reserver', 'Client\Reservations::reserver');
$routes->get('client/reservations/store/(:num)', 'Client\Reservations::store/$1');
$routes->get('client/reservations/annuler/(:num)', 'Client\Reservations::annuler/$1');

$routes->get('admin/dashboard', 'Admin\Dashboard::index');
$routes->get('admin/clients', 'Admin\Dashboard::clients');
$routes->get('admin/dashboard/statut/(:num)/(:alpha)', 'Admin\Dashboard::changerStatut/$1/$2');
$routes->get('admin/ressources', 'Admin\Ressources::index');
$routes->post('admin/ressources/store', 'Admin\Ressources::store');
$routes->get('admin/ressources/delete/(:num)', 'Admin\Ressources::delete/$1');
$routes->get('admin/creneaux', 'Admin\Creneaux::index');
$routes->post('admin/creneaux/store', 'Admin\Creneaux::store');
$routes->get('admin/creneaux/delete/(:num)', 'Admin\Creneaux::delete/$1');