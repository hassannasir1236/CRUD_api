<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/api/student', 'StudentController::index');
$routes->post('/api/student', 'StudentController::create');
$routes->get('/api/student/(:num)', 'StudentController::show/$1');
$routes->post('/api/student/EditRecord/(:num)', 'StudentController::update/$1');
$routes->delete('/api/student/(:num)', 'StudentController::delete/$1');
