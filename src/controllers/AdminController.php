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

        $records_per_page = 10;

        // User Management Data
        $user = new User();
        $user_search_term = isset($_GET['user_search']) ? $_GET['user_search'] : '';
        $user_role_filter = isset($_GET['user_role']) ? $_GET['user_role'] : '';
        $user_current_page = isset($_GET['user_page']) ? (int)$_GET['user_page'] : 1;
        $user_offset = ($user_current_page - 1) * $records_per_page;

        $users_stmt = $user->getAllUsers($user_search_term, $user_role_filter, $records_per_page, $user_offset);
        $users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);
        $user_total_rows = $user->getTotalUsers($user_search_term, $user_role_filter);
        $user_total_pages = ceil($user_total_rows / $records_per_page);

        // Booking Management Data
        $booking = new Booking();
        $booking_search_term = isset($_GET['booking_search']) ? $_GET['booking_search'] : '';
        $booking_status_filter = isset($_GET['booking_status']) ? $_GET['booking_status'] : '';
        $booking_current_page = isset($_GET['booking_page']) ? (int)$_GET['booking_page'] : 1;
        $booking_offset = ($booking_current_page - 1) * $records_per_page;

        $bookings_stmt = $booking->getAllBookings($booking_search_term, $booking_status_filter, $records_per_page, $booking_offset);
        $bookings = $bookings_stmt->fetchAll(PDO::FETCH_ASSOC);
        $booking_total_rows = $booking->getTotalBookings($booking_search_term, $booking_status_filter);
        $new_bookings_count = $booking->getTotalBookings('', 'pending');
        $new_bookings_count = $booking->getTotalBookings('', 'pending');
        $booking_total_pages = ceil($booking_total_rows / $records_per_page);

        // Room Management Data
        $room = new Room();
        $room_search_term = isset($_GET['room_search']) ? $_GET['room_search'] : '';
        $room_type_filter = isset($_GET['room_type']) ? $_GET['room_type'] : '';
        $room_availability_filter = isset($_GET['room_availability']) ? $_GET['room_availability'] : '';
        $room_current_page = isset($_GET['room_page']) ? (int)$_GET['room_page'] : 1;
        $room_offset = ($room_current_page - 1) * $records_per_page;

        $rooms = $room->getAllRooms($room_search_term, $room_type_filter, $room_availability_filter, $records_per_page, $room_offset);
        $room_total_rows = $room->getTotalRooms($room_search_term, $room_type_filter, $room_availability_filter);
        $room_total_pages = ceil($room_total_rows / $records_per_page);

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
            if (!empty($_POST['password'])) {
                $user->password = $_POST['password'];
            }

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

            $image_urls = [];
            if (isset($_FILES['image']) && is_array($_FILES['image']['name'])) {
                $upload_dir = __DIR__ . '/../../public/uploads/rooms/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                foreach ($_FILES['image']['name'] as $key => $name) {
                    if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                        $file_ext = pathinfo($name, PATHINFO_EXTENSION);
                        $new_file_name = uniqid() . '.' . $file_ext;
                        $target_file = $upload_dir . $new_file_name;

                        if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $target_file)) {
                            $image_urls[] = '/app1/public/uploads/rooms/' . $new_file_name;
                        } else {
                            $_SESSION['error'] = 'Failed to upload some images.';
                            header('Location: /app1/public/admin/addRoom');
                            exit();
                        }
                    }
                }
            }
            $room->image_url = $image_urls;

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

            // To avoid overwriting the new POST data, create a temporary room object 
            // just to fetch the existing image URLs from the database.
            $tempRoom = new Room();
            $existing_room_data = $tempRoom->getById($room->id);
            $image_urls = [];
            if ($existing_room_data && is_array($existing_room_data->image_url)) {
                $image_urls = $existing_room_data->image_url;
            }

            // Check if new images are uploaded
            if (isset($_FILES['image']) && is_array($_FILES['image']['name']) && !empty(array_filter($_FILES['image']['name']))) {
                $upload_dir = __DIR__ . '/../../public/uploads/rooms/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $new_image_urls = [];
                foreach ($_FILES['image']['name'] as $key => $name) {
                    if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                        $file_ext = pathinfo($name, PATHINFO_EXTENSION);
                        $new_file_name = uniqid() . '.' . $file_ext;
                        $target_file = $upload_dir . $new_file_name;

                        if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $target_file)) {
                            $new_image_urls[] = '/app1/public/uploads/rooms/' . $new_file_name;
                        } else {
                            $_SESSION['error'] = 'Failed to upload some new images.';
                            header('Location: /app1/public/admin/editRoom?id=' . $room->id);
                            exit();
                        }
                    }
                }
                // Add the new images to the existing ones
                $image_urls = array_merge($image_urls, $new_image_urls);
            }
            
            // Now, assign the final, correct list of images to the main $room object
            $room->image_url = $image_urls;

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

    public function deleteRoomImage() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit();
        }

        $data = json_decode(file_get_contents("php://input"), true);
        $room_id = $data['room_id'] ?? null;
        $image_index = $data['image_index'] ?? null;

        if ($room_id === null || $image_index === null) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid request data']);
            exit();
        }

        $room = new Room();
        $room->id = $room_id;

        error_log("Attempting to delete image for room_id: " . $room_id . ", index: " . $image_index);
        if ($room->deleteImageByIndex($image_index)) {
            error_log("Image deletion successful for room_id: " . $room_id);
            echo json_encode(['success' => true, 'message' => 'Image deleted successfully']);
        } else {
            error_log("Image deletion failed for room_id: " . $room_id);
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to delete image']);
        }
        exit();
    }

    public function approveBooking() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            $booking = new Booking();
            if ($booking->updateStatus($_POST['booking_id'], 'confirmed')) {
                $_SESSION['message'] = 'Booking approved successfully.';
            } else {
                $_SESSION['error'] = 'Failed to approve booking.';
            }
        }
        header('Location: /app1/public/admin/dashboard');
        exit();
    }

    public function rejectBooking() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /app1/public/auth/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            $booking = new Booking();
            if ($booking->updateStatus($_POST['booking_id'], 'cancelled')) {
                $_SESSION['message'] = 'Booking rejected successfully.';
            } else {
                $_SESSION['error'] = 'Failed to reject booking.';
            }
        }
        header('Location: /app1/public/admin/dashboard');
        exit();
    }
}
?>