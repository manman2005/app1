<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Room.php';

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

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: /app1/public/user/profile');
            exit();
        }

        $userInstance = new User();
        
        // Fetch user to preserve role
        $currentUser = $userInstance->getById($_SESSION['user_id']);
        if (!$currentUser) {
            header('Location: /app1/public/auth/logout');
            exit();
        }

        $userInstance->id = $_SESSION['user_id'];
        $userInstance->username = $_POST['username'] ?? $currentUser['username'];
        $userInstance->email = $_POST['email'] ?? $currentUser['email'];
        $userInstance->phone_number = $_POST['phone_number'] ?? $currentUser['phone_number'];
        $userInstance->role = $currentUser['role']; // Preserve the existing role

        if ($userInstance->update()) {
            // Optional: Set a success message in the session
            $_SESSION['success_message'] = 'โปรไฟล์ของคุณถูกอัปเดตเรียบร้อยแล้ว';
        } else {
            // Optional: Set an error message
            $_SESSION['error_message'] = 'เกิดข้อผิดพลาดในการอัปเดตโปรไฟล์';
        }

        header('Location: /app1/public/user/profile');
        exit();
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: /app1/public/user/profile');
            exit();
        }

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            $_SESSION['error_message'] = 'กรุณากรอกข้อมูลทั้งหมดเพื่อเปลี่ยนรหัสผ่าน';
            header('Location: /app1/public/user/profile');
            exit();
        }

        if ($new_password !== $confirm_password) {
            $_SESSION['error_message'] = 'รหัสผ่านใหม่และการยืนยันไม่ตรงกัน';
            header('Location: /app1/public/user/profile');
            exit();
        }

        $userInstance = new User();
        // First, get the user by their session ID to get their username securely
        $currentUser = $userInstance->getById($_SESSION['user_id']);

        if (!$currentUser) {
            // This case should rarely happen if the session is valid
            $_SESSION['error_message'] = 'ไม่พบผู้ใช้ในระบบ';
            header('Location: /app1/public/user/profile');
            exit();
        }

        // Now, use the retrieved username to get the user record that includes the password hash
        $userWithPassword = $userInstance->findByUsername($currentUser['username']);

        if ($userWithPassword && password_verify($current_password, $userWithPassword['password'])) {
            // If password is correct, create a new instance to update only the password
            $updateUser = new User();
            $updateUser->id = $_SESSION['user_id'];
            $updateUser->password = $new_password;

            if ($updateUser->update()) {
                $_SESSION['success_message'] = 'รหัสผ่านถูกเปลี่ยนเรียบร้อยแล้ว';
            } else {
                $_SESSION['error_message'] = 'เกิดข้อผิดพลาดในการอัปเดตฐานข้อมูล';
            }
        } else {
            $_SESSION['error_message'] = 'รหัสผ่านปัจจุบันไม่ถูกต้อง';
        }

        header('Location: /app1/public/user/profile');
        exit();
    }

    public function uploadProfilePicture() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
            header('Location: /app1/public/user/profile');
            exit();
        }

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
            $fileName = $_FILES['profile_picture']['name'];
            $fileSize = $_FILES['profile_picture']['size'];
            $fileType = $_FILES['profile_picture']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];

            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = './uploads/avatars/';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    $userInstance = new User();
                    $userInstance->id = $_SESSION['user_id'];
                    // Prepend the base path for use in views
                    $userInstance->profile_picture = '/app1/public/uploads/avatars/' . $newFileName;

                    if ($userInstance->update()) {
                        $_SESSION['success_message'] = 'รูปโปรไฟล์ถูกอัปเดตเรียบร้อยแล้ว';
                    } else {
                        $_SESSION['error_message'] = 'เกิดข้อผิดพลาดในการบันทึกข้อมูลรูปภาพ';
                    }
                } else {
                    $_SESSION['error_message'] = 'เกิดข้อผิดพลาดในการย้ายไฟล์';
                }
            } else {
                $_SESSION['error_message'] = 'ไม่อนุญาตให้อัปโหลดไฟล์ประเภทนี้';
            }
        } else {
            $_SESSION['error_message'] = 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์';
        }

        header('Location: /app1/public/user/profile');
        exit();
    }
}