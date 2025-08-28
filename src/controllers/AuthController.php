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
                $_SESSION['form_data'] = [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'phone_number' => $_POST['phone_number']
                ];
                header("Location: " . BASE_PATH . "/auth/register");
                exit;
            }

            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->phone_number = $_POST['phone_number'];
            $user->password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($_POST['password'] !== $confirm_password) {
                $_SESSION['error_message'] = "รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง";
                $_SESSION['form_data'] = [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'phone_number' => $_POST['phone_number']
                ];
                header("Location: " . BASE_PATH . "/auth/register");
                exit;
            }

            if ($user->create()) {
                $_SESSION['success_message'] = "Registration successful! Please login.";
                header("Location: " . BASE_PATH . "/auth/login");
                exit;
            } else {
                $_SESSION['error_message'] = "Unable to register user.";
                header("Location: " . BASE_PATH . "/auth/register");
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

                    // Redirect to intended URL or default page
                    if (isset($_SESSION['intended_url'])) {
                        $intended_url = $_SESSION['intended_url'];
                        unset($_SESSION['intended_url']); // Clear it after use
                        header("Location: " . $intended_url);
                    } elseif ($found_user['role'] === 'admin') {
                        header("Location: " . BASE_PATH . "/admin/dashboard");
                    } else {
                        header("Location: " . BASE_PATH . "/");
                    }
                    exit;
                } else {
                    $_SESSION['error_message'] = "Invalid username or password. (Debug: password_verify returned FALSE)";
                    header("Location: " . BASE_PATH . "/auth/login");
                    exit;
                }
            } else {
                $_SESSION['error_message'] = "Invalid username or password. (Debug: User not found)";
                header("Location: " . BASE_PATH . "/auth/login");
                exit;
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . BASE_PATH . "/auth/login");
        exit;
    }
}
?>