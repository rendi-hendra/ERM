<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout', ['filter' => 'auth']);

$routes->group('pasien', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Pasien::index');
    $routes->match(['get', 'post'], 'create', 'Pasien::create');
    $routes->get('edit/(:num)', 'Pasien::edit/$1');
    $routes->post('update/(:num)', 'Pasien::update/$1');
    $routes->get('delete/(:num)', 'Pasien::delete/$1');

    $routes->match(['get', 'post'], '(:num)/asuransi/create', 'AsuransiPasien::create/$1');
    $routes->get('(:num)/asuransi/edit/(:num)', 'AsuransiPasien::edit/$1/$2');
    $routes->post('(:num)/asuransi/update/(:num)', 'AsuransiPasien::update/$2');
    $routes->post('(:num)/asuransi/delete/(:num)', 'AsuransiPasien::delete/$1/$2');
    $routes->get('asuransi/getByPasien/(:num)', 'AsuransiPasien::getByPasien/$1');
});

$routes->group('asuransi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Asuransi::index');
    $routes->match(['get', 'post'], 'create', 'Asuransi::create');
    $routes->get('edit/(:num)', 'Asuransi::edit/$1');
    $routes->post('update/(:num)', 'Asuransi::update/$1');
    $routes->get('delete/(:num)', 'Asuransi::delete/$1');
});

$routes->group('kunjungan', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Kunjungan::index');
    $routes->match(['get', 'post'], 'create', 'Kunjungan::create');
    $routes->get('edit/(:num)', 'Kunjungan::edit/$1');
    $routes->post('update/(:num)', 'Kunjungan::update/$1');
    $routes->post('delete/(:num)', 'Kunjungan::delete/$1');
});
