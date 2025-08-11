-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2025 at 04:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `total_price`, `status`, `created_at`) VALUES
(22, 3, 2, '2025-08-07', '2025-08-08', 2990.00, 'confirmed', '2025-08-07 07:55:15'),
(23, 3, 2, '2025-08-09', '2025-08-10', 2990.00, 'confirmed', '2025-08-07 07:57:29'),
(24, 3, 2, '2025-08-16', '2025-08-26', 29900.00, 'confirmed', '2025-08-07 07:58:00'),
(25, 3, 1, '2025-08-29', '2025-08-30', 1299.00, 'confirmed', '2025-08-07 08:00:20'),
(26, 3, 2, '2025-08-15', '2025-08-14', 2990.00, 'confirmed', '2025-08-08 02:26:26'),
(27, 3, 2, '2025-08-29', '2025-08-31', 5980.00, 'confirmed', '2025-08-08 02:28:02'),
(28, 3, 2, '2025-09-02', '2025-09-04', 5980.00, 'cancelled', '2025-08-08 03:08:06'),
(29, 3, 3, '2025-08-08', '2025-08-17', 26991.00, 'cancelled', '2025-08-08 03:10:00'),
(30, 3, 3, '2025-08-28', '2025-08-30', 5998.00, 'pending', '2025-08-08 03:14:10'),
(31, 3, 5, '2025-08-09', '2025-08-11', 3998.00, 'pending', '2025-08-08 04:13:18'),
(32, 3, 4, '2025-08-08', '2025-08-09', 3490.00, 'pending', '2025-08-08 05:41:03'),
(33, 3, 1, '2025-08-08', '2025-08-09', 1299.00, 'pending', '2025-08-08 07:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `room_type`, `price_per_night`, `description`, `image_url`, `is_available`) VALUES
(1, '1', 'ห้อง ', 1299.00, 'เช็คอินก่อนเที่ยง นะคะ ห้อง 2ที่นอน มีห้องน้ำและแอร์ มีผ้าขนหนูให้', '[\"\\/app1\\/public\\/uploads\\/rooms\\/6889bf78b0bbc.jpg\"]', 1),
(2, '2', 'ห้องแอร์', 2990.00, 'เช็คอินก่อนเที่ยง นะคะ ห้อง 2ที่นอน มีห้องน้ำและแอร์ มีผ้าขนหนูให้', '[\"\\/app1\\/public\\/uploads\\/rooms\\/6889c7e89a722.jpg\"]', 1),
(3, '3', 'เต้นนอน', 2999.00, 'เช็คอินก่อนเที่ยง นะคะ ห้อง 2ที่นอน มีห้องน้ำและแอร์ มีผ้าขนหนูให้', '[\"\\/app1\\/public\\/uploads\\/rooms\\/6889d054f27b9.jpg\"]', 1),
(4, '4', 'ห้องแอร์', 3490.00, 'เช็คอินก่อนเที่ยง นะคะ ห้อง 2ที่นอน มีห้องน้ำและแอร์ มีผ้าขนหนูให้', '[\"\\/app1\\/public\\/uploads\\/rooms\\/6889d06ed8084.jpg\"]', 1),
(5, '5', 'ห้องแอร์', 1999.00, 'เช็คอินก่อนเที่ยง นะคะ ห้อง 2ที่นอน มีห้องน้ำและแอร์ มีผ้าขนหนูให้', '[\"\\/app1\\/public\\/uploads\\/rooms\\/6889d08ac748f.jpg\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(3, 'man1', '$2y$10$E0v9bpA7g9wFBdp8C5FVSOqiVqOkjfUsHL3W96LY2b0v5bkbyPLke', 'sagase66@gmail.com', 'admin', '2025-07-25 02:15:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number` (`room_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
