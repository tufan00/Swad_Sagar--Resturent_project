-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 01:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `preferences` text DEFAULT NULL,
  `order_history` text DEFAULT NULL,
  `loyalty_points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `preferences`, `order_history`, `loyalty_points`) VALUES
(1, 'John Doe', 'john.doe@email.com', '555-0101', 'prefers vegan', '[\"Grilled Chicken\", \"Caesar Salad\"]', 50),
(2, 'Jane Smith', 'jane.smith@email.com', '555-0102', 'no preferences', '[\"Spring Rolls\"]', 20),
(3, 'Alice Brown', 'alice.brown@email.com', '555-0103', 'gluten-free', '[\"Family Meal\"]', 30),
(4, 'Bob Johnson', 'bob.johnson@email.com', '555-0104', 'prefers spicy', '[\"Vegan Pasta\"]', 40),
(5, 'Emma Wilson', 'emma.wilson@email.com', '555-0105', 'no preferences', '[]', 10),
(6, NULL, NULL, NULL, NULL, NULL, 0),
(7, NULL, NULL, NULL, NULL, NULL, 0),
(8, NULL, NULL, NULL, NULL, NULL, 0),
(9, NULL, NULL, NULL, NULL, NULL, 0),
(10, 'TUFAN CHOWDHURY', NULL, NULL, NULL, NULL, 0),
(11, 'TUFAN CHOWDHURY', NULL, NULL, NULL, NULL, 0),
(12, 'TUFAN CHOWDHURY', NULL, NULL, NULL, NULL, 0),
(13, 'TUFAN CHOWDHURY', NULL, NULL, NULL, NULL, 0),
(14, 'TUFAN CHOWDHURY', NULL, NULL, NULL, NULL, 0),
(15, 'TUFAN CHOWDHURY', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `ingredient` varchar(100) DEFAULT NULL,
  `stock_level` decimal(10,2) DEFAULT NULL,
  `low_stock_threshold` decimal(10,2) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `ingredient`, `stock_level`, `low_stock_threshold`, `supplier_id`, `unit`) VALUES
(2, 'Rice', 65.00, 30.00, 2, NULL),
(3, 'Lettuce', 10.00, 10.00, 3, NULL),
(4, 'Pasta', 26.00, 15.00, 2, NULL),
(5, 'Tomato Sauce', 25.00, 10.00, 4, NULL),
(8, 'chicken', 10.00, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `dietary_tags` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order_position` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `category`, `name`, `description`, `price`, `dietary_tags`, `image`, `order_position`) VALUES
(11, 'Combos', 'rice', 'as', 100.00, 'vegan', 'samosa.jpg', 11),
(12, 'Salads', 'veg', 'veg', 500.00, 'vegan', '1(1).jpg', 12),
(13, 'Combos', 'ghgh', '55', 100.00, 'gluten-free', 'fresh-delicious-crispy-samosas-on-260nw-1980799244.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `item` varchar(100) DEFAULT NULL,
  `type` enum('dine-in','delivery') DEFAULT NULL,
  `status` enum('pending','accepted','processing','delivered') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) DEFAULT NULL,
  `delivery_tracking` varchar(100) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_address` text DEFAULT NULL,
  `payment_status` enum('pending','completed') DEFAULT 'pending',
  `order_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `item`, `type`, `status`, `created_at`, `customer_id`, `delivery_tracking`, `total_amount`, `delivery_address`, `payment_status`, `order_id`) VALUES
(1, 'Grilled Chicken', 'dine-in', 'accepted', '2025-03-27 07:00:00', 1, NULL, 14.00, NULL, 'completed', 'ORD001'),
(2, 'Spring Rolls', 'delivery', 'processing', '2025-03-27 07:30:00', 2, 'TRK12345', 21.00, '123 Main St, City', 'pending', 'ORD002'),
(3, 'Family Meal', 'dine-in', 'delivered', '2025-03-27 08:45:00', 3, NULL, 0.00, NULL, 'pending', 'ORD003'),
(4, 'Caesar Salad', 'delivery', 'delivered', '2025-03-27 10:00:00', 1, 'TRK67890', 0.00, NULL, 'pending', 'ORD004'),
(25, 'Spring Rolls', 'delivery', 'accepted', '2025-03-29 05:44:30', NULL, 'sds', 0.00, NULL, 'pending', 'ORD007'),
(26, 'Spring Rolls', 'delivery', 'processing', '2025-03-29 05:44:50', NULL, 'asd', 0.00, NULL, 'pending', 'ORD008'),
(27, 'Spring Rolls', 'dine-in', 'pending', '2025-03-29 06:00:02', NULL, NULL, 0.00, NULL, 'pending', 'ORD009'),
(28, 'Vegan Pasta', 'dine-in', 'pending', '2025-03-29 06:14:00', NULL, NULL, 0.00, NULL, 'pending', 'ORD010'),
(29, 'Spring Rolls', 'dine-in', 'pending', '2025-03-29 06:24:37', NULL, NULL, 0.00, NULL, 'pending', 'ORD011'),
(30, 'Family Meal', 'dine-in', 'pending', '2025-03-29 06:26:03', NULL, NULL, 0.00, NULL, 'pending', 'ORD012'),
(31, 'Spring Rolls', 'delivery', 'pending', '2025-03-29 06:41:45', NULL, 'sda', 0.00, NULL, 'pending', 'ORD013'),
(32, 'Spring Rolls (x1), Grilled Chicken (x1), Caesar Salad (x1), alu vaja (x1), Vegan Pasta (x1), Family ', 'dine-in', 'pending', '2025-03-30 02:05:11', 10, NULL, 77.95, NULL, 'pending', 'ORD032'),
(33, 'Grilled Chicken (x1), Spring Rolls (x1)', 'delivery', 'pending', '2025-03-30 02:05:28', 11, NULL, 23.98, 'chandabila, Garhbeta, paschim Midnapore, Contact: 07586962156', 'pending', 'ORD033'),
(34, 'Spring Rolls (x1)', 'dine-in', 'pending', '2025-03-30 03:19:02', 12, NULL, 10.99, NULL, 'pending', 'ORD034'),
(35, 'veg (x1)', 'dine-in', 'pending', '2025-03-31 02:46:14', 13, NULL, 505.00, NULL, 'pending', 'ORD035'),
(36, 'veg (x1)', 'delivery', 'pending', '2025-03-31 02:46:36', 14, NULL, 505.00, 'chandabila, Garhbeta, paschim Midnapore, Contact: 07586962156', 'pending', 'ORD036'),
(37, 'veg (x1)', 'delivery', 'pending', '2025-03-31 02:46:51', 15, NULL, 505.00, 'chandabila, Garhbeta, paschim Midnapore, Contact: 07586962156', 'pending', 'ORD037');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `type` enum('discount','coupon','referral') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `description`, `code`, `discount`, `start_date`, `end_date`, `type`) VALUES
(1, 'Spring Sale', '20% off all orders', 'SPRING20', 20.00, '2025-03-01 00:00:00', '2025-03-31 23:59:59', 'discount'),
(2, 'Free Dessert', 'Free dessert with any combo', 'DESSERTFREE', 0.00, '2025-03-15 00:00:00', '2025-03-20 23:59:59', 'coupon'),
(3, 'Refer a Friend', '10% off for both', 'REFER10', 10.00, '2025-03-01 00:00:00', '2025-12-31 23:59:59', 'referral'),
(4, 'Lunch Special', '15% off lunch orders', 'LUNCH15', 15.00, '2025-03-10 00:00:00', '2025-03-15 23:59:59', 'discount'),
(5, 'Weekend Deal', 'Buy one get one free on salads', 'BOGOSALAD', 0.00, '2025-03-28 00:00:00', '2025-03-30 23:59:59', 'coupon');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `customer_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `party_size` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `time` time NOT NULL,
  `occasion` varchar(50) DEFAULT NULL,
  `special_requests` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reservation_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`customer_id`, `date`, `party_size`, `status`, `modified_by`, `table_id`, `last_updated_by`, `name`, `email`, `phone`, `time`, `occasion`, `special_requests`, `created_at`, `reservation_id`, `id`) VALUES
(1, '2025-03-29', 4, 'confirmed', NULL, 1, NULL, '', '', '', '00:00:00', NULL, NULL, '2025-03-30 02:45:19', NULL, 1),
(2, '2025-03-29', 2, 'confirmed', NULL, 4, NULL, '', '', '', '00:00:00', NULL, NULL, '2025-03-30 02:45:19', NULL, 2),
(3, '2025-03-29', 6, 'completed', 'admin1', 3, NULL, '', '', '', '00:00:00', NULL, NULL, '2025-03-30 02:45:19', NULL, 3),
(4, '2025-03-30', 8, 'completed', NULL, 5, NULL, '', '', '', '00:00:00', NULL, NULL, '2025-03-30 02:45:19', NULL, 4),
(NULL, '2025-04-10', 4, NULL, NULL, NULL, NULL, 'John Doe', 'john.doe@example.com', '+1234567890', '19:00:00', 'Birthday', 'Window seat preferred', '2025-03-30 02:46:20', NULL, 5),
(NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', '', '00:00:00', NULL, NULL, '2025-03-30 03:01:16', 1, 6),
(NULL, '2025-03-30', 4, 'Confirmed', 'admin', 1, 1, 'John Doe', 'john.doe@example.com', '9876543210', '18:00:00', 'Birthday', 'Vegan meal', '2025-03-30 03:02:00', 1, 7),
(NULL, '2025-03-30', 2, 'Pending', 'admin', 2, 2, 'Alice Smith', 'alice.smith@example.com', '9876543211', '19:00:00', 'Anniversary', 'None', '2025-03-30 03:02:00', 2, 8),
(NULL, '2025-03-31', 6, 'Confirmed', 'admin', 3, 3, 'Michael Johnson', 'michael.johnson@example.com', '9876543212', '20:00:00', 'Celebration', 'Window seat', '2025-03-30 03:02:00', 3, 9),
(NULL, '2025-03-31', 3, 'Canceled', 'admin', 4, 4, 'Emily Davis', 'emily.davis@example.com', '9876543213', '21:00:00', 'Meeting', 'None', '2025-03-30 03:02:00', 4, 10),
(NULL, '2025-04-01', 5, 'Confirmed', 'admin', 5, 5, 'James Brown', 'james.brown@example.com', '9876543214', '19:30:00', 'Casual Dining', 'No spicy food', '2025-03-30 03:02:00', 5, 11),
(1, '2025-04-01', 4, 'Confirmed', 'admin', 1, 1, 'John Doe', 'johndoe@example.com', '9876543210', '19:00:00', 'Birthday', 'Requesting window seat', '2025-03-30 03:06:28', NULL, 12),
(2, '2025-04-02', 2, 'Confirmed', 'admin', 2, 2, 'Jane Smith', 'janesmith@example.com', '9123456789', '20:00:00', 'Anniversary', 'Vegan meal', '2025-03-30 03:06:28', NULL, 13),
(3, '2025-04-03', 6, 'Pending', 'manager', 3, 3, 'Alice Brown', 'alicebrown@example.com', '9988776655', '18:30:00', 'Business Meeting', 'No alcohol', '2025-03-30 03:06:28', NULL, 14),
(4, '2025-04-04', 3, 'Confirmed', 'admin', 1, 1, 'Bob White', 'bobwhite@example.com', '9333445566', '21:00:00', 'Casual Dinner', 'None', '2025-03-30 03:06:28', NULL, 15),
(5, '2025-04-05', 5, 'Confirmed', 'admin', 2, 2, 'Charlie Green', 'charliegreen@example.com', '9222333444', '19:30:00', 'Wedding Reception', 'Special dietary needs', '2025-03-30 03:06:28', NULL, 16),
(6, '2025-04-06', 2, 'Pending', 'manager', 3, 3, 'David Black', 'davidblack@example.com', '9444556677', '17:45:00', 'Date Night', 'Requesting dessert wine', '2025-03-30 03:06:28', NULL, 17),
(7, '2025-04-07', 4, 'Confirmed', 'admin', 1, 1, 'Eva White', 'evawhite@example.com', '9555667788', '18:00:00', 'Birthday', 'No spicy food', '2025-03-30 03:06:28', NULL, 18),
(8, '2025-04-08', 3, 'Cancelled', 'admin', 2, 2, 'Frank Harris', 'frankharris@example.com', '9666778899', '20:15:00', 'Casual Dinner', 'None', '2025-03-30 03:06:28', NULL, 19),
(9, '2025-04-09', 6, 'Confirmed', 'manager', 3, 3, 'Grace Lee', 'gracelee@example.com', '9777889900', '19:30:00', 'Business Dinner', 'VIP guest seating', '2025-03-30 03:06:28', NULL, 20),
(10, '2025-04-10', 2, 'Confirmed', 'admin', 1, 1, 'Henry Clark', 'henryclark@example.com', '9888990011', '20:00:00', 'Casual Lunch', 'Window view', '2025-03-30 03:06:28', NULL, 21),
(NULL, '2025-04-02', 8, 'pending', NULL, 2, NULL, 'TUFAN CHOWDHURY', 'tufanchowdhury09@gmail.com', '07586962156', '08:50:00', 'Anniversary', 'nothing ', '2025-03-30 03:16:18', 0, 22),
(NULL, '2025-04-02', 8, 'pending', NULL, 2, NULL, 'TUFAN CHOWDHURY', 'tufanchowdhury09@gmail.com', '07586962156', '08:50:00', 'Anniversary', 'nothing ', '2025-03-30 03:17:25', 0, 23),
(NULL, '2025-03-19', 8, 'pending', NULL, 3, NULL, 'TUFAN CHOWDHURY', 'tufanchowdhury09@gmail.com', '07586962156', '08:51:00', 'Anniversary', 'ddd', '2025-03-30 03:19:30', 0, 24);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `order_history` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact`, `order_history`) VALUES
(1, 'Fresh Farms', 'contact@freshfarms.com', '[{\"date\": \"2025-03-20\", \"items\": \"Chicken\"}]'),
(2, 'Grain Co', 'contact@grainco.com', '[{\"date\": \"2025-03-21\", \"items\": \"Rice, Pasta\"}]'),
(3, 'Veggie Suppliers', 'contact@veggiesuppliers.com', '[{\"date\": \"2025-03-22\", \"items\": \"Lettuce\"}]'),
(4, 'Sauce Makers', 'contact@saucemakers.com', '[{\"date\": \"2025-03-23\", \"items\": \"Tomato Sauce\"}]'),
(5, 'Bulk Foods', 'contact@bulkfoods.com', '[{\"date\": \"2025-03-24\", \"items\": \"Rice\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_number` varchar(10) NOT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_number`, `capacity`) VALUES
(1, 'T1', 4),
(2, 'T2', 2),
(3, 'T3', 6),
(4, 'T4', 4),
(5, 'T5', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','manager','staff') DEFAULT 'staff',
  `permissions` text DEFAULT NULL,
  `shift_start` time DEFAULT NULL,
  `shift_end` time DEFAULT NULL,
  `performance_metrics` text DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `permissions`, `shift_start`, `shift_end`, `performance_metrics`, `reset_token`, `reset_expiry`) VALUES
(1, 'a', '$2y$10$QUqV1BAR4rPRQK/BDXS02ue8ONaVCwNSFQcbgVZfe25s0kKEnmzdq', 'manager', '[\"orders\",\"menu\",\"reservations\",\"customers\",\"inventory\",\"promotions\"]', NULL, NULL, NULL, NULL, NULL),
(2, 'admin1', '$2y$10$aNsfxCoH73FNJyOul4A83Olul5d41ahjTbIlCO8.GfZll2fCQ7mxS', 'admin', '[\"orders\",\"menu\",\"reservations\",\"customers\",\"inventory\",\"promotions\"]', '09:00:00', '17:00:00', '{\"orders_processed\": 150, \"rating\": 4.8}', NULL, NULL),
(3, 'manager1', '$2y$10$Ho/EyRNoJ9S3aV.DDrhriOXtDnMlVs9AkwO79b3iumsYHcSqjaeEa', 'manager', '[\"orders\",\"menu\",\"reservations\"]', '10:00:00', '18:00:00', '{\"orders_processed\": 100, \"rating\": 4.5}', NULL, NULL),
(4, 'staff1', '$2y$10$KfX8z5Y9vXj2QwL3mN6pO.9uJ4kW7tR8sY0aB2cD3eF5gH9iJ1kL', 'staff', '[\"orders\"]', '08:00:00', '16:00:00', '{\"orders_processed\": 80, \"rating\": 4.2}', NULL, NULL),
(5, 'staff2', '$2y$10$KfX8z5Y9vXj2QwL3mN6pO.9uJ4kW7tR8sY0aB2cD3eF5gH9iJ1kL', 'staff', '[\"orders\",\"reservations\"]', '12:00:00', '20:00:00', '{\"orders_processed\": 90, \"rating\": 4.3}', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `last_updated_by` (`last_updated_by`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_number` (`table_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`last_updated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
