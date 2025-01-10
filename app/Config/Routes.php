<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Route for index
$routes->get('/', 'Home::index');


// ===== Route for The Wijaya =====

// Login, Logout, and Dashboard
$routes->get('thewijaya/getuser', 'TheWijayaController\WijayaAuthController::getUser'); // API getUser
$routes->get('/thewijaya', 'TheWijayaController\WijayaAuthController::index');
$routes->post('/thewijaya/login', 'TheWijayaController\WijayaAuthController::login_action');
$routes->get('/thewijaya/error_login', 'TheWijayaController\WijayaAuthController::error_login');
$routes->get('/thewijaya/logout', 'TheWijayaController\WijayaAuthController::logout_action');
$routes->get('/thewijaya/dashboard', 'TheWijayaController\WijayaAuthController::dashboard');

// Booking
$routes->get('/thewijaya/booking/selectdates', 'TheWijayaController\BookingController::selectDates');
$routes->post('/thewijaya/booking/selectroom', 'TheWijayaController\BookingController::selectRoom');

// Rooms
$routes->get('/thewijaya/room/viewroom', 'TheWijayaController\RoomController::viewRoom');
$routes->get('/thewijaya/room/getroom', 'TheWijayaController\RoomController::getRoom'); // API getAllRooms





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