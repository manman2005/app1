<?php
require_once __DIR__ . '/../models/User.php';

class AdminController {
    public function dashboard() {
        // Check if user is logged in and is admin
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        $user = new User();
        $stmt = $user->getAllUsers();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include_once __DIR__ . '/../../views/admin/dashboard.php';
    }
}
?>