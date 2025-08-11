<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $user = new User();

            // Check if username or email already exists
            if ($user->exists($_POST['username'], $_POST['email'])) {
                $_SESSION['error_message'] = "Username or email already taken.";
                header("Location: /app1/public/auth/register");
                exit;
            }

            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->phone_number = $_POST['phone_number'];
            $user->password = $_POST['password'];

            if ($user->create()) {
                $_SESSION['success_message'] = "Registration successful! Please login.";
                header("Location: /app1/public/auth/login");
                exit;
            } else {
                $_SESSION['error_message'] = "Unable to register user.";
                header("Location: /app1/public/auth/register");
                exit;
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $user = new User();

            $found_user = $user->findByUsername($_POST['username']);

            if ($found_user) {
                $verify_result = password_verify($_POST['password'], $found_user['password']);
                if ($verify_result) {
                    $_SESSION['user_id'] = $found_user['id'];
                    $_SESSION['user_role'] = $found_user['role'];
                    $_SESSION['username'] = $found_user['username'];
                    $_SESSION['debug_message'] = "Login successful! (Debug: password_verify returned TRUE)";
                    if ($found_user['role'] === 'admin') {
                        header("Location: /app1/public/admin/dashboard");
                    } else {
                        header("Location: /app1/public/");
                    }
                    exit;
                } else {
                    $_SESSION['error_message'] = "Invalid username or password. (Debug: password_verify returned FALSE)";
                    header("Location: /app1/public/auth/login");
                    exit;
                }
            } else {
                $_SESSION['error_message'] = "Invalid username or password. (Debug: User not found)";
                header("Location: /app1/public/auth/login");
                exit;
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /app1/public/auth/login");
        exit;
    }
}
?>