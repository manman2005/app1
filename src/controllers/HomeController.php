<?php
error_log('Attempting to load: ' . __DIR__ . '/../models/Room.php');
require_once __DIR__ . '/../models/Room.php';

class HomeController {
    public function index() {
        $room = new Room();
        $rooms = $room->getAllRooms();

        // If no rooms, create a dummy for display
        if (empty($rooms)) {
            $rooms = [
                [
                    'id' => 'temp',
                    'room_number' => 'ห้องพักตัวอย่าง',
                    'description' => 'คำอธิบายสำหรับห้องพักตัวอย่าง.',
                    'price_per_night' => 1200,
                    'is_available' => 1,
                    'room_type' => 'เต็นท์',
                    'image_url' => ['https://via.placeholder.com/600x400?text=Sample+Room']
                ]
            ];
        }

        // This will be the main landing page
        include_once __DIR__ . '/../../views/home.php';
    }
}
?>