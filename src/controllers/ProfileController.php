<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Booking.php';

class ProfileController {
    public function showProfile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /app1/public/auth/login');
            exit();
        }

        $userInstance = new User();
        $user = $userInstance->getById($_SESSION['user_id']);

        if (!$user) {
            // Handle case where user is not found
            // Maybe log them out and redirect
            header('Location: /app1/public/auth/logout');
            exit();
        }

        include __DIR__ . '/../../views/user/profile.php';
    }

    public function showBookingHistory() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /app1/public/auth/login');
            exit();
        }

        $bookings = Booking::findByUserId($_SESSION['user_id']);
        
        // You might want to fetch room details for each booking as well
        // This is a potential N+1 problem, consider optimizing if performance is an issue
        foreach ($bookings as &$booking) {
            $roomInstance = new Room();
            $room = $roomInstance->getById($booking['room_id']);
            $booking['room_details'] = $room;
        }

        include __DIR__ . '/../../views/user/booking_history.php';
    }
}