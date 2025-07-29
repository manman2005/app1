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

    // Create a new room
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
                    room_number = :room_number,
                    description = :description,
                    price_per_night = :price_per_night,
                    is_available = :is_available,
                    room_type = :room_type,
                    image_url = :image_url";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->room_number = htmlspecialchars(strip_tags($this->room_number));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price_per_night = htmlspecialchars(strip_tags($this->price_per_night));
        $this->is_available = htmlspecialchars(strip_tags($this->is_available));
        $this->room_type = htmlspecialchars(strip_tags($this->room_type));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));

        // Bind the values
        $stmt->bindParam(':room_number', $this->room_number);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price_per_night', $this->price_per_night);
        $stmt->bindParam(':is_available', $this->is_available);
        $stmt->bindParam(':room_type', $this->room_type);
        $stmt->bindParam(':image_url', $this->image_url);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Get room by ID
    public function getById($id) {
        $query = "SELECT id, room_number, description, price_per_night, is_available, room_type, image_url FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a room
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
                    room_number = :room_number,
                    description = :description,
                    price_per_night = :price_per_night,
                    is_available = :is_available,
                    room_type = :room_type,
                    image_url = :image_url
                    WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->room_number = htmlspecialchars(strip_tags($this->room_number));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price_per_night = htmlspecialchars(strip_tags($this->price_per_night));
        $this->is_available = htmlspecialchars(strip_tags($this->is_available));
        $this->room_type = htmlspecialchars(strip_tags($this->room_type));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind the values
        $stmt->bindParam(':room_number', $this->room_number);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price_per_night', $this->price_per_night);
        $stmt->bindParam(':is_available', $this->is_available);
        $stmt->bindParam(':room_type', $this->room_type);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a room
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind the value
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>