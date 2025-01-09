<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Route for index
$routes->get('/', 'Home::index');


// Route for The Wijaya\
$routes->get('/thewijaya', 'TheWijayaController\WijayaAuthController::index');
$routes->post('/thewijaya/login', 'TheWijayaController\WijayaAuthController::login_action');
$routes->get('/thewijaya/logout', 'TheWijayaController\WijayaAuthController::logout_action');

$routes->get('thewijaya/getuser', 'TheWijayaController\WijayaAuthController::getUser');

$routes->get('/thewijaya/booking/selectDates', 'TheWijayaController\BookingController::selectDates');
// $routes->get('/BookingController/selectDates', 'BookingController::selectDates', ['filter' => 'auth']);
// $routes->post('/BookingController/selectRoom', 'BookingController::selectRoom');
// $routes->post('/BookingController/paymentPage', 'BookingController::paymentPage');
// $routes->post('/BookingController/processPayment', 'BookingController::processPayment');
// $routes->get('/BookingController/bookingHistory', 'BookingController::bookingHistory');
// $routes->get('/auth', 'AuthController::index');
// $routes->post('/auth/login', 'AuthController::login');

// Route for Sanchaya Taste
$routes->get('/sanchayataste', 'SanchayaTasteController\SanchayaAuthController::index');
$routes->post('/sanchayataste/login', 'SanchayaTasteController\SanchayaAuthController::login_action');
$routes->get('/sanchayataste/logout', 'SanchayaTasteController\SanchayaAuthController::logout_action');

$routes->get('sanchayataste/getuser', 'SanchayaTasteController\SanchayaAuthController::getUser');