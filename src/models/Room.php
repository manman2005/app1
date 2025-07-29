<?php

require_once __DIR__ . '/../../config/database.php';

class Room {
    private $conn;
    private $table_name = "rooms"; // Assuming your table name is 'rooms'

    public $id;
    public $room_number;
    public $description;
    public $price_per_night;
    public $is_available;
    public $room_type;
    public $image_url;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get all rooms
    public function getAllRooms() {
        $query = "SELECT id, room_number, description, price_per_night, is_available, room_type, image_url FROM " . $this->table_name . " ORDER BY room_number ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>