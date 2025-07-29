<?php
error_log('Attempting to load: ' . __DIR__ . '/../models/Room.php');
require_once __DIR__ . '/../models/Room.php';

class HomeController {
    public function index() {
        $room = new Room();
        $stmt = $room->getAllRooms();
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // This will be the main landing page
        include_once __DIR__ . '/../../views/home.php';
    }
}
?>