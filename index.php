<?php
// Define a dynamic base path
$base_path = rtrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/');
define('BASE_PATH', $base_path);

session_start();
require_once __DIR__ . '/src/controllers/AuthController.php';
require_once __DIR__ . '/src/controllers/HomeController.php';
require_once __DIR__ . '/src/controllers/AdminController.php';
require_once __DIR__ . '/src/controllers/BookingController.php';
require_once __DIR__ . '/src/controllers/ProfileController.php';

$authController = new AuthController();
$homeController = new HomeController();
$adminController = new AdminController();
$bookingController = new BookingController();
$profileController = new ProfileController();

$path = $_SERVER['REQUEST_URI'];
$path = parse_url($path, PHP_URL_PATH);
$path = str_replace(BASE_PATH, '', $path);

switch ($path) {
    // --- Home Page ---
    case '/home':
    case '':
    case '/': // Handle root path with trailing slash
        $homeController->index();
        break;

    // --- Authentication Routes ---
    case '/auth/register':
        include __DIR__ . '/views/auth/register.php';
        break;
    case '/auth/register_process':
        $authController->register();
        break;
    case '/auth/login':
        include __DIR__ . '/views/auth/login.php';
        break;
    case '/auth/login_process':
        $authController->login();
        break;
    case '/auth/logout':
        $authController->logout();
        break;

    // --- User Profile & Bookings ---
    case '/user/profile':
        $profileController->showProfile();
        break;
    case '/user/profile/update':
        $profileController->updateProfile();
        break;
    case '/user/profile/change_password':
        $profileController->changePassword();
        break;
    case '/user/profile/upload_picture':
        $profileController->uploadProfilePicture();
        break;
    case '/user/bookings':
        $profileController->showBookingHistory();
        break;

    // --- Booking Routes ---
    case '/book':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingController->store();
        } else {
            $bookingController->create();
        }
        break;
    case '/my-bookings':
        $bookingController->index();
        break;

    // --- Admin Routes ---
    case '/admin/dashboard':
        $adminController->dashboard();
        break;
    case '/admin/editUser':
        $adminController->editUser();
        break;
    case '/admin/deleteUser':
        $adminController->deleteUser();
        break;
    case '/admin/addUser':
        $adminController->addUser();
        break;
    case '/admin/addRoom':
        $adminController->addRoom();
        break;
    case '/admin/editRoom':
        $adminController->editRoom();
        break;
    case '/admin/deleteRoom':
        $adminController->deleteRoom();
        break;
    case '/admin/deleteRoomImage':
        $adminController->deleteRoomImage();
        break;

    case '/admin/approveBooking':
        $adminController->approveBooking();
        break;

    case '/admin/rejectBooking':
        $adminController->rejectBooking();
        break;

    default:
        http_response_code(404);
        include __DIR__ . '/views/404.php';
        break;
}
