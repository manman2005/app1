<?php
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Room.php';

class BookingController {
    public function create() {
        // Display the booking form
        // This would typically involve getting room details
        if (isset($_GET['room_id'])) {
            $room = new Room();
            $room = $room->getById($_GET['room_id']);
            // Pass the $room object to the view
            require __DIR__ . '/../../views/bookings/create.php';
        } else {
            // Handle error: room_id not provided
            echo "Room not specified.";
        }
    }

    public function store() {
        // Handle the booking form submission
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $room_id = $_POST['room_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Basic validation
        if (empty($room_id) || empty($start_date) || empty($end_date)) {
            // Handle error: incomplete data
            echo "Please fill in all fields.";
            return;
        }

        // Server-side calculation for total price
        $room = new Room();
        $room = $room->getById($room_id);
        if (!$room) {
            echo "Room not found.";
            return;
        }

        $startDate = new DateTime($start_date);
        $endDate = new DateTime($end_date);
        $interval = $startDate->diff($endDate);
        $days = $interval->days;
        $total_price = $days * $room->price_per_night;

        // Create booking
        $booking = new Booking();
        $booking->user_id = $_SESSION['user_id'];
        $booking->room_id = $room_id;
        $booking->check_in_date = $start_date;
        $booking->check_out_date = $end_date;
        $booking->total_price = $total_price;
        $booking->status = 'confirmed'; // Or 'pending' if you have an approval process

        // Check for room availability
        if (!$booking->isRoomAvailable($room_id, $start_date, $end_date)) {
            $_SESSION['error_message'] = "Room is not available for the selected dates.";
            header('Location: /app1/public/book?room_id=' . $room_id);
            exit();
        }

        if ($booking->create()) {
            // Load the success view
            require __DIR__ . '/../../views/bookings/success.php';
        } else {
            // Handle booking creation failure
            echo "Failed to create booking.";
        }
    }

    public function index() {
        // Display a user's bookings
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $bookings = Booking::findByUserId($user_id);

        // Pass the $bookings array to the view
        require __DIR__ . '/../../views/bookings/index.php';
    }
}
