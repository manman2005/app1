<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Room.php';
require_once __DIR__ . '/../models/Booking.php';

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

        $booking = new Booking();
        $stmt = $booking->getAllBookings();
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                include_once __DIR__ . '/../../views/admin/edit_user.php';
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

    public function addUser() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->username = $_POST['username'];
            $user->password = $_POST['password']; // Remember to hash this!
            $user->email = $_POST['email'];
            $user->role = $_POST['role'];

            if ($user->create()) {
                $_SESSION['message'] = 'User added successfully.';
            } else {
                $_SESSION['error'] = 'Failed to add user.';
            }
            header('Location: /app1/public/admin/dashboard');
            exit();
        }

        include_once __DIR__ . '/../../views/admin/add_user.php';
    }

    public function addRoom() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        $room = new Room();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room->room_number = $_POST['room_number'];
            $room->description = $_POST['description'];
            $room->price_per_night = $_POST['price_per_night'];
            $room->is_available = isset($_POST['is_available']) ? 1 : 0;
            $room->room_type = $_POST['room_type'];
            $room->image_url = $_POST['image_url'];

            if ($room->create()) {
                $_SESSION['message'] = 'Room added successfully.';
            } else {
                $_SESSION['error'] = 'Failed to add room.';
            }
            header('Location: /app1/public/admin/dashboard');
            exit();
        }

        include_once __DIR__ . '/../../views/admin/add_room.php';
    }

    public function editRoom() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        $room = new Room();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room->id = $_POST['id'];
            $room->room_number = $_POST['room_number'];
            $room->description = $_POST['description'];
            $room->price_per_night = $_POST['price_per_night'];
            $room->is_available = isset($_POST['is_available']) ? 1 : 0;
            $room->room_type = $_POST['room_type'];
            $room->image_url = $_POST['image_url'];

            if ($room->update()) {
                $_SESSION['message'] = 'Room updated successfully.';
            } else {
                $_SESSION['error'] = 'Failed to update room.';
            }
            header('Location: /app1/public/admin/dashboard');
            exit();
        } else if (isset($_GET['id'])) {
            $roomData = $room->getById($_GET['id']);
            if ($roomData) {
                include_once __DIR__ . '/../../views/admin/edit_room.php'; // You'll need to create this view
            } else {
                $_SESSION['error'] = 'Room not found.';
                header('Location: /app1/public/admin/dashboard');
                exit();
            }
        } else {
            header('Location: /app1/public/admin/dashboard');
            exit();
        }
    }

    public function deleteRoom() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $room = new Room();
            $room->id = $_POST['id'];

            if ($room->delete()) {
                $_SESSION['message'] = 'Room deleted successfully.';
            } else {
                $_SESSION['error'] = 'Failed to delete room.';
            }
        }
        header('Location: /app1/public/admin/dashboard');
        exit();
    }
}
?>