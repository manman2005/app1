<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
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
        $query = "SELECT id, username, email, role FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";

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
        $query = "SELECT id, username, email, role FROM " . $this->table_name;
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
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, role = :role WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind the values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a user
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