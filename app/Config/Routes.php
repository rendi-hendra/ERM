<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->get('pasien', 'Pasien::index');
$routes->match(['get', 'post'], 'pasien/create', 'Pasien::create');
$routes->get('pasien/edit/(:num)', 'Pasien::edit/$1');
$routes->post('pasien/update/(:num)', 'Pasien::update/$1');
$routes->get('pasien/delete/(:num)', 'Pasien::delete/$1');
