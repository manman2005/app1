<?php
require_once __DIR__ . '/../src/controllers/AuthController.php';
require_once __DIR__ . '/../src/controllers/HomeController.php';
require_once __DIR__ . '/../src/controllers/AdminController.php';

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

    // --- Admin Routes ---
    case 'admin/dashboard':
        // Add middleware check here later
        $adminController->dashboard();
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
