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
    $routes->post('(:num)/asuransi/update/(:num)', 'AsuransiPasien::update/$1/$2');
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

    // SOAP
    $routes->get('(:num)/soap', 'Soap::index/$1');
    $routes->post('(:num)/soap/create', 'Soap::create/$1');
    $routes->get('(:num)/soap/edit/(:num)', 'Soap::edit/$1/$2');
    $routes->post('(:num)/soap/update/(:num)', 'Soap::update/$1/$2');
    $routes->post('(:num)/soap/delete/(:num)', 'Soap::delete/$1/$2');

    // Ajax
    $routes->get('unit/(:num)/dokter', 'Kunjungan::dokterByUnit/$1');
});

$routes->group('unit', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Unit::index');
    $routes->match(['get', 'post'], 'create', 'Unit::create');
    $routes->get('edit/(:num)', 'Unit::edit/$1');
    $routes->post('update/(:num)', 'Unit::update/$1');
    $routes->post('delete/(:num)', 'Unit::delete/$1');

    // Employee on Unit
    $routes->get('(:num)/emp_on_unit', 'EmpOnUnit::index/$1');
    $routes->match(['get', 'post'], '(:num)/emp-on-unit/create', 'EmpOnUnit::create/$1');
    $routes->get('(:num)/emp-on-unit/edit/(:num)', 'EmpOnUnit::edit/$1/$2');
    $routes->post('(:num)/emp-on-unit/update/(:num)', 'EmpOnUnit::update/$1/$2');
    $routes->post('(:num)/emp-on-unit/delete/(:num)', 'EmpOnUnit::delete/$1/$2');

    // Ajax
    $routes->get('emp-on-unit/getEmployees/(:num)', 'EmpOnUnit::getEmployees/$1');
});

$routes->group('employees', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Employees::index');
    $routes->match(['get', 'post'], 'create', 'Employees::create');
    $routes->get('edit/(:num)', 'Employees::edit/$1');
    $routes->post('update/(:num)', 'Employees::update/$1');
    $routes->post('delete/(:num)', 'Employees::delete/$1');
});
