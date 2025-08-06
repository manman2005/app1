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
    public $image_url; // This will now be an array in PHP, stored as JSON string in DB

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get all rooms with search, filter, and pagination
    public function getAllRooms($search_term = '', $room_type_filter = '', $availability_filter = '', $limit = 10, $offset = 0) {
        $query = "SELECT id, room_number, description, price_per_night, is_available, room_type, image_url FROM " . $this->table_name;
        $conditions = [];
        $params = [];

        if (!empty($search_term)) {
            $conditions[] = "(room_number LIKE :search_term_room_number OR description LIKE :search_term_description)";
            $params[':search_term_room_number'] = '%' . $search_term . '%';
            $params[':search_term_description'] = '%' . $search_term . '%';
        }

        if (!empty($room_type_filter)) {
            $conditions[] = "room_type = :room_type_filter";
            $params[':room_type_filter'] = $room_type_filter;
        }

        if ($availability_filter !== '') {
            $conditions[] = "is_available = :is_available";
            $params[':is_available'] = (int)$availability_filter;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY room_number ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);

        $all_params = $params;
        $all_params[':limit'] = (int)$limit;
        $all_params[':offset'] = (int)$offset;

        $stmt->execute($all_params);

        $rooms_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rooms_data as &$room) {
            $room['image_url'] = json_decode($room['image_url'], true) ?: [];
        }
        return $rooms_data;
    }

    // Get total number of rooms with search and filter
    public function getTotalRooms($search_term = '', $room_type_filter = '', $availability_filter = '') {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $conditions = [];
        $params = [];

        if (!empty($search_term)) {
            $conditions[] = "(room_number LIKE :search_term_room_number OR description LIKE :search_term_description)";
            $params[':search_term_room_number'] = '%' . $search_term . '%';
            $params[':search_term_description'] = '%' . $search_term . '%';
        }

        if (!empty($room_type_filter)) {
            $conditions[] = "room_type = :room_type_filter";
            $params[':room_type_filter'] = $room_type_filter;
        }

        if ($availability_filter !== '') {
            $conditions[] = "is_available = :is_available";
            $params[':is_available'] = (int)$availability_filter;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->conn->prepare($query);

        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
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

        // Sanitize input for non-image_url fields
        $this->room_number = htmlspecialchars(strip_tags($this->room_number));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price_per_night = htmlspecialchars(strip_tags($this->price_per_night));
        $this->is_available = htmlspecialchars(strip_tags($this->is_available));
        $this->room_type = htmlspecialchars(strip_tags($this->room_type));

        // Handle image_url as JSON
        $image_url_json = json_encode($this->image_url);
        if ($image_url_json === false) {
            $image_url_json = '[]'; // Default to empty array if encoding fails
        }

        // Bind the values
        $stmt->bindParam(':room_number', $this->room_number);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price_per_night', $this->price_per_night);
        $stmt->bindParam(':is_available', $this->is_available);
        $stmt->bindParam(':room_type', $this->room_type);
        $stmt->bindParam(':image_url', $image_url_json); // Bind JSON string

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Get room by ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['id'];
            $this->room_number = $row['room_number'];
            $this->description = $row['description'];
            $this->price_per_night = $row['price_per_night'];
            $this->is_available = $row['is_available'];
            $this->room_type = $row['room_type'];
            $this->image_url = json_decode($row['image_url'], true) ?: []; // Decode JSON to array
            return $this;
        }

        return null;
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

        // Sanitize input for non-image_url fields
        $this->room_number = htmlspecialchars(strip_tags($this->room_number));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price_per_night = htmlspecialchars(strip_tags($this->price_per_night));
        $this->is_available = htmlspecialchars(strip_tags($this->is_available));
        $this->room_type = htmlspecialchars(strip_tags($this->room_type));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Handle image_url as JSON
        $image_url_json = json_encode($this->image_url);
        if ($image_url_json === false) {
            $image_url_json = '[]'; // Default to empty array if encoding fails
        }

        // Bind the values
        $stmt->bindParam(':room_number', $this->room_number);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price_per_night', $this->price_per_night);
        $stmt->bindParam(':is_available', $this->is_available);
        $stmt->bindParam(':room_type', $this->room_type);
        $stmt->bindParam(':image_url', $image_url_json); // Bind JSON string
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return true; // Update was successful
            }
            // If rowCount is 0, it means no rows were affected.
            // This can happen if the data submitted is the same as the data in the DB.
            // We can consider this a "successful" case in the controller.
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

    // Delete image by index
    public function deleteImageByIndex($index) {
        // First, get the current room data to access the image_url array
        $current_room = $this->getById($this->id);

        if (!$current_room || !is_array($current_room->image_url) || !isset($current_room->image_url[$index])) {
            error_log("Room or image not found for room_id: " . $this->id . ", index: " . $index);
            return false; // Room or image not found
        }

        $image_to_delete_url = $current_room->image_url[$index];
        
        // Remove the image URL from the array
        array_splice($current_room->image_url, $index, 1);

        // Update the room in the database with the new image_url array
        $query = "UPDATE " . $this->table_name . " SET image_url = :image_url WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $image_url_json = json_encode($current_room->image_url);
        if ($image_url_json === false) {
            error_log("JSON encoding failed for image_url for room_id: " . $this->id);
            $image_url_json = '[]';
        }

        $stmt->bindParam(':image_url', $image_url_json);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            // Attempt to delete the physical file
            $base_path = __DIR__ . '/../../public'; // Adjust this path if your public folder is elsewhere
            $file_path = $base_path . str_replace('/app1/public', '', $image_to_delete_url);
            
            if (file_exists($file_path)) {
                if (!unlink($file_path)) {
                    error_log("Failed to delete physical file: " . $file_path);
                }
            } else {
                error_log("Physical file not found: " . $file_path);
            }
            return true;
        }

        error_log("Database update failed for image_url for room_id: " . $this->id);
        return false;
    }
}
?>