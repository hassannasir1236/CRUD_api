<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get('/', 'Home::index');
$routes->group("/api/", ["namespace" => "App\Controllers"] , function($routes){
$routes->get('student', 'StudentController::index');
$routes->post('student', 'StudentController::create');
$routes->get('student/(:num)', 'StudentController::show/$1');
$routes->post('student/EditRecord/(:num)', 'StudentController::update/$1');
$routes->delete('student/(:num)', 'StudentController::delete/$1');
});




$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "User::index", ['filter' => 'authFilter']);
});