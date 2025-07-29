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

    public function editUser() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->id = $_POST['id'];
            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->role = $_POST['role'];

            if ($user->update()) {
                $_SESSION['message'] = 'User updated successfully.';
            } else {
                $_SESSION['error'] = 'Failed to update user.';
            }
            header('Location: /app1/public/admin/dashboard');
            exit();
        } else if (isset($_GET['id'])) {
            $userData = $user->getById($_GET['id']);
            if ($userData) {
                include_once __DIR__ . '/../../views/admin/edit_user.php'; // You'll need to create this view
            } else {
                $_SESSION['error'] = 'User not found.';
                header('Location: /app1/public/admin/dashboard');
                exit();
            }
        } else {
            header('Location: /app1/public/admin/dashboard');
            exit();
        }
    }

    public function deleteUser() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $user = new User();
            $user->id = $_POST['id'];

            if ($user->delete()) {
                $_SESSION['message'] = 'User deleted successfully.';
            } else {
                $_SESSION['error'] = 'Failed to delete user.';
            }
        }
        header('Location: /app1/public/admin/dashboard');
        exit();
    }
}
?>