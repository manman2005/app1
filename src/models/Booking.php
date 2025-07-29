<?php

class Booking {
    public $id;
    public $user_id;
    public $room_id;
    public $start_date;
    public $end_date;
    public $status; // e.g., pending, confirmed, cancelled

    public function __construct($user_id, $room_id, $start_date, $end_date, $status = 'pending') {
        $this->user_id = $user_id;
        $this->room_id = $room_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->status = $status;
    }

    public function save() {
        // Logic to save the booking to the database
        // This would involve getting a database connection and running an INSERT query
    }

    public static function findByUserId($user_id) {
        // Logic to find bookings by user ID from the database
    }

    public static function findByRoomId($room_id) {
        // Logic to find bookings by room ID from the database
    }
}
