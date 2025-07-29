<?php
session_start();
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/controllers/HomeController.php';
require_once __DIR__ . '/../src/controllers/AdminController.php';
require_once __DIR__ . '/../src/controllers/BookingController.php';


// Basic Router
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = '/app1/public';

// Remove base path from request URI
$route = str_replace($base_path, '', $request_uri);
$route = trim($route, '/');
$route = parse_url($route, PHP_URL_PATH);

// Instantiate controllers
$authController = new AuthController();
$homeController = new HomeController();
$adminController = new AdminController();
$bookingController = new BookingController();

switch ($route) {
    // --- Authentication Routes ---
    case 'auth/register':
        include __DIR__ . '/../views/auth/register.php';
        break;
    case 'auth/register_process':
        $authController->register();
        break;
    case 'auth/login':
        include __DIR__ . '/../views/auth/login.php';
        break;
    case 'auth/login_process':
        $authController->login();
        break;
    case 'auth/logout':
        $authController->logout();
        break;

    // --- Booking Routes ---
    case 'book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingController->store();
        } else {
            $bookingController->create();
        }
        break;
    case 'my-bookings':
        $bookingController->index();
        break;

    // --- Admin Routes ---
    case 'admin/dashboard':
        // Add middleware check here later
        $adminController->dashboard();
        break;
    case 'admin/editUser':
        $adminController->editUser();
        break;
    case 'admin/deleteUser':
        $adminController->deleteUser();
        break;
    case 'admin/addRoom':
        $adminController->addRoom();
        break;

    // --- Home Page --- 
    case '':
    case 'home':
        $homeController->index();
        break;

    default:
        http_response_code(404);
        echo "404 Page Not Found";
        // Or include a nice 404 page
        // include __DIR__ . '/../views/404.php';
        break;
}
