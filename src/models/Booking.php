<?php

require_once __DIR__ . '/../../config/database.php';

class Booking {
    private $conn;
    private $table_name = "bookings";

    public $id;
    public $user_id;
    public $room_id;
    public $check_in_date;
    public $check_out_date;
    public $total_price;
    public $status;
    public $created_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, room_id=:room_id, check_in_date=:check_in_date, check_out_date=:check_out_date, total_price=:total_price, status=:status";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->room_id = htmlspecialchars(strip_tags($this->room_id));
        $this->check_in_date = htmlspecialchars(strip_tags($this->check_in_date));
        $this->check_out_date = htmlspecialchars(strip_tags($this->check_out_date));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":room_id", $this->room_id);
        $stmt->bindParam(":check_in_date", $this->check_in_date);
        $stmt->bindParam(":check_out_date", $this->check_out_date);
        $stmt->bindParam(":total_price", $this->total_price);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAllBookings() {
        $query = "SELECT b.id, u.username, r.room_number, b.check_in_date, b.check_out_date, b.total_price, b.status, b.created_at FROM " . $this->table_name . " b LEFT JOIN users u ON b.user_id = u.id LEFT JOIN rooms r ON b.room_id = r.id ORDER BY b.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function isRoomAvailable($room_id, $check_in_date, $check_out_date) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " 
                  WHERE room_id = :room_id 
                  AND ( 
                      (check_in_date <= :check_out_date AND check_out_date >= :check_in_date)
                  )";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":room_id", $room_id);
        $stmt->bindParam(":check_in_date", $check_in_date);
        $stmt->bindParam(":check_out_date", $check_out_date);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['count'] == 0;
    }

    public static function findByUserId($user_id) {
        $database = new Database();
        $conn = $database->getConnection();
        $table_name = "bookings";

        $query = "SELECT b.*, r.room_number, r.price_per_night
                  FROM " . $table_name . " b
                  JOIN rooms r ON b.room_id = r.id
                  WHERE b.user_id = :user_id
                  ORDER BY b.check_in_date DESC";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
