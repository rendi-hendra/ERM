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
});

$routes->group('asuransi', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Asuransi::index');
    $routes->match(['get', 'post'], 'create', 'Asuransi::create');
    $routes->get('edit/(:num)', 'Asuransi::edit/$1');
    $routes->post('update/(:num)', 'Asuransi::update/$1');
    $routes->get('delete/(:num)', 'Asuransi::delete/$1');
});

$routes->group('asuransi-pasien', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'AsuransiPasien::index');
    $routes->match(['get', 'post'], 'create', 'AsuransiPasien::create');
    $routes->get('edit/(:num)', 'AsuransiPasien::edit/$1');
    $routes->post('update/(:num)', 'AsuransiPasien::update/$1');
    $routes->get('delete/(:num)', 'AsuransiPasien::delete/$1');
});
