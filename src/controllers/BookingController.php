<?php
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Room.php';

class BookingController {
    public function create() {
        // Display the booking form
        // This would typically involve getting room details
        if (isset($_GET['room_id'])) {
            $room = Room::findById($_GET['room_id']);
            // Pass the $room object to the view
            require __DIR__ . '/../../views/bookings/create.php';
        } else {
            // Handle error: room_id not provided
            echo "Room not specified.";
        }
    }

    public function store() {
        // Handle the booking form submission
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $room_id = $_POST['room_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Basic validation
        if (empty($room_id) || empty($start_date) || empty($end_date)) {
            // Handle error: incomplete data
            echo "Please fill in all fields.";
            return;
        }

        $booking = new Booking($user_id, $room_id, $start_date, $end_date);
        // In a real application, you would save this to the database
        // $booking->save();

        // For now, just show a confirmation
        echo "Booking successful!";
        // Redirect to a confirmation page or user's bookings page
        // header('Location: /my-bookings');
    }

    public function index() {
        // Display a user's bookings
        session_start();
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
