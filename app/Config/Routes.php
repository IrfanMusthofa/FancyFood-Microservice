<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Route for index
$routes->get('/', 'Home::index');

// ===== Route for The Wijaya =====

// Login, Logout, and Dashboard
$routes->get('/thewijaya/getuser', 'TheWijayaController\WijayaAuthController::getUser'); // API getUser
$routes->get('/thewijaya', 'TheWijayaController\WijayaAuthController::index');
$routes->post('/thewijaya/login', 'TheWijayaController\WijayaAuthController::login_action');
$routes->get('/thewijaya/error_login', 'TheWijayaController\WijayaAuthController::error_login');
$routes->get('/thewijaya/logout', 'TheWijayaController\WijayaAuthController::logout_action');
$routes->get('/thewijaya/dashboard', 'TheWijayaController\WijayaAuthController::dashboard');

// Rooms
$routes->get('/thewijaya/room/viewroom', 'TheWijayaController\RoomController::viewRoom');
$routes->get('/thewijaya/room/getroom', 'TheWijayaController\RoomController::getRoom'); // API getAllRooms

// Booking
$routes->get('/thewijaya/booking/selectbook', 'TheWijayaController\BookingController::selectBook');
$routes->post('/thewijaya/booking/selectroom', 'TheWijayaController\BookingController::selectRoom');
$routes->get('/thewijaya/booking/viewbookingcustomer', 'TheWijayaController\BookingController::viewBookingCustomer');
$routes->post('/thewijaya/booking/getbookingcustomer', 'TheWijayaController\BookingController::getBookingCustomer'); // API getBookingCustomer
$routes->post('/thewijaya/booking/gotopayment', 'TheWijayaController\BookingController::goToPayment');
$routes->post('/thewijaya/booking/getbookingbyid', 'TheWijayaController\BookingController::getBookingById'); // API getBookingById

// Payment
$routes->get('/thewijaya/payment', 'TheWijayaController\PaymentController::index');
$routes->get('/thewijaya/payment/(:num)', 'TheWijayaController\PaymentController::index/$1');
$routes->post('/thewijaya/payment/processPayment', 'TheWijayaController\PaymentController::processPayment');

// Special
$routes->get('/thewijaya/special/', 'TheWijayaController\DiscountController::viewDiscount');



// ===== Route for Sanchaya Taste =====

// Login, Logout, and Dashboard
$routes->get('/sanchayataste', 'SanchayaTasteController\SanchayaAuthController::index');
$routes->post('/sanchayataste/login', 'SanchayaTasteController\SanchayaAuthController::login_action');
$routes->get('/sanchayataste/error_login', 'SanchayaTasteController\SanchayaAuthController::error_login');
$routes->get('/sanchayataste/logout', 'SanchayaTasteController\SanchayaAuthController::logout_action');
$routes->get('/sanchayataste/getuser', 'SanchayaTasteController\SanchayaAuthController::getUser');
$routes->get('/sanchayataste/dashboard', 'SanchayaTasteController\SanchayaAuthController::dashboard');

// Menu
$routes->get('/sanchayataste/menu/viewmenu', 'SanchayaTasteController\MenuController::viewMenu');
$routes->get('/sanchayataste/menu/getmenu', 'SanchayaTasteController\MenuController::getMenu'); // API getMenu

// Order
$routes->get('sanchayataste/order/vieworder', 'SanchayaTasteController\OrderController::viewOrder');
$routes->post('sanchayataste/order/getorder', 'SanchayaTasteController\OrderController::getOrder'); // API getOrder
$routes->get('sanchayataste/order/select_menu', 'SanchayaTasteController\OrderController::orderNow');
$routes->post('sanchayataste/order/createorder', 'SanchayaTasteController\OrderController::createOrder');

// Special
$routes->get('sanchayataste/special/viewspecial', 'SanchayaTasteController\SpecialController::viewSpecial');
$routes->get('sanchayataste/special/getspecial', 'SanchayaTasteController\SpecialController::getSpecial');
$routes->get('sanchayataste/special/enterbookingdiscount', 'SanchayaTasteController\SpecialController::enterBookingId');
$routes->post('sanchayataste/special/processbookingdiscount', 'SanchayaTasteController\SpecialController::processBookingDiscount');