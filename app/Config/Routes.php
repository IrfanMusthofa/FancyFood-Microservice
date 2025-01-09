<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/BookingController/selectDates', 'BookingController::selectDates', ['filter' => 'auth']);
$routes->post('/BookingController/selectRoom', 'BookingController::selectRoom');
$routes->post('/BookingController/paymentPage', 'BookingController::paymentPage');
$routes->post('/BookingController/processPayment', 'BookingController::processPayment');
$routes->get('/BookingController/bookingHistory', 'BookingController::bookingHistory');
$routes->get('/auth', 'AuthController::index');
$routes->post('/auth/login', 'AuthController::login');

