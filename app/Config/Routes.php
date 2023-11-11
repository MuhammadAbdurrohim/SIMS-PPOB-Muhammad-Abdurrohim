<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\DashboardController;
use App\Controllers\AuthController;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::displaylogin');
$routes->get('register', 'AuthController::displayregister');

$routes->get('dashboard', 'DashboardController::index');
$routes->get('isitopup', 'DashboardController::isitopup');
$routes->get('transaksi', 'DashboardController::transaksi');
$routes->get('akun', 'DashboardController::akun');
$routes->get('bayarin', 'DashboardController::bayarin');

$routes->add('register', 'AuthController::register');
$routes->add('login', 'AuthController::login');
