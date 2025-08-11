<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $phone_number;
    public $profile_picture;
    public $password;
    public $role;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create a new user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET username = :username, email = :email, password = :password";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Hash the password
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind the values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Find user by username
    public function findByUsername($username) {
        $query = "SELECT id, username, password, role FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get user by ID
    public function getById($id) {
        $query = "SELECT id, username, email, phone_number, profile_picture, role, created_at FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Check if username or email exists
    public function exists($username, $email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = :username OR email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Get all users with search, filter, and pagination
    public function getAllUsers($search_term = '', $role_filter = '', $limit = 10, $offset = 0) {
        $query = "SELECT id, username, email, phone_number, role FROM " . $this->table_name;
        $conditions = [];
        $params = [];

        if (!empty($search_term)) {
            $conditions[] = "(username LIKE :search_username OR email LIKE :search_email)";
            $params[':search_username'] = '%' . $search_term . '%';
            $params[':search_email'] = '%' . $search_term . '%';
        }

        if (!empty($role_filter)) {
            $conditions[] = "role = :role_filter";
            $params[':role_filter'] = $role_filter;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY username ASC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }

    // Get total number of users with search and filter
    public function getTotalUsers($search_term = '', $role_filter = '') {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $conditions = [];
        $params = [];

        if (!empty($search_term)) {
            $conditions[] = "(username LIKE :search_username OR email LIKE :search_email)";
            $params[':search_username'] = '%' . $search_term . '%';
            $params[':search_email'] = '%' . $search_term . '%';
        }

        if (!empty($role_filter)) {
            $conditions[] = "role = :role_filter";
            $params[':role_filter'] = $role_filter;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Update a user
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET";
        $params = [];
        $updates = [];

        if (!empty($this->username)) {
            $updates[] = "username = :username";
            $params[':username'] = htmlspecialchars(strip_tags($this->username));
        }
        if (!empty($this->email)) {
            $updates[] = "email = :email";
            $params[':email'] = htmlspecialchars(strip_tags($this->email));
        }
        if (isset($this->phone_number)) { // Use isset to allow empty string
            $updates[] = "phone_number = :phone_number";
            $params[':phone_number'] = htmlspecialchars(strip_tags($this->phone_number));
        }
        if (!empty($this->role)) {
            $updates[] = "role = :role";
            $params[':role'] = htmlspecialchars(strip_tags($this->role));
        }
        if (isset($this->profile_picture)) {
            $updates[] = "profile_picture = :profile_picture";
            $params[':profile_picture'] = htmlspecialchars(strip_tags($this->profile_picture));
        }
        if (!empty($this->password)) {
            $updates[] = "password = :password";
            $params[':password'] = password_hash($this->password, PASSWORD_BCRYPT);
        }

        if (empty($updates)) {
            return true; // Nothing to update
        }

        $query .= " " . implode(", ", $updates);
        $query .= " WHERE id = :id";
        $params[':id'] = htmlspecialchars(strip_tags($this->id));

        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a user
    public function delete() {
        $this->conn->beginTransaction();

        try {
            // Sanitize input
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Delete user's bookings
            $booking_query = "DELETE FROM bookings WHERE user_id = :id";
            $booking_stmt = $this->conn->prepare($booking_query);
            $booking_stmt->bindParam(':id', $this->id);
            $booking_stmt->execute();

            // Delete user
            $user_query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $user_stmt = $this->conn->prepare($user_query);
            $user_stmt->bindParam(':id', $this->id);
            $user_stmt->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
?>