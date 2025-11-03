<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::index');


$routes->get('pasien', 'Pasien::index');
$routes->get('pasien/create', 'Pasien::create');
$routes->post('pasien/store', 'Pasien::store');
$routes->get('pasien/edit/(:num)', 'Pasien::edit/$1');
$routes->post('pasien/update/(:num)', 'Pasien::update/$1');
$routes->get('pasien/delete/(:num)', 'Pasien::delete/$1');
