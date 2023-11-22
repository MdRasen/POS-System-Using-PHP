-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2023 at 01:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_system_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `is_ban`, `created_at`) VALUES
(8, 'devRasen', 'aamin.hossen99@gmail.com', '01234567890', '$2y$10$9tqMdYjUSK17o8bZeENcIeb3nN5EY6U1JkdetUNBbG7uTubc4epyy', 0, '2023-11-09 08:40:24'),
(10, 'admin1', 'admin1@gmail.com', '', '$2y$10$f9WNAXiOFeJ/NNcGh8r3E.e91XFbwN07tUOoVoOOUu4C1hVo8S1oC', 0, '2023-11-09 08:53:07'),
(11, 'demo', 'demo@gmail.com', '420420420', '$2y$10$uX3Cx6Ghsoj4rU2KB0iAA.ru.xnypNGR0d5KJdVSicFQXs1KreEXe', 1, '2023-11-09 16:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `description` tinytext,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=Visible; 1=Hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(1, 'Category 1', 'This is category 1 description.', 0),
(2, 'Category 2', 'This is short description!', 0),
(4, 'Category 3', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` tinytext,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=Visible; 1=Hidden',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_at`) VALUES
(12, 'devRasen', 'aamin.hossen99@gmail.com', '0456789123', 'Moghbazar, Dhaka: 1217', 0, '2023-11-17 13:51:11'),
(13, 'Dummy', '', '123465679', '', 1, '2023-11-19 13:58:00'),
(14, 'Sadia Rehman', '', '2545464', '', 0, '2023-11-20 15:00:10'),
(15, 'Sarah Islam', 'sarahislam@gmail.com', '7418529630', 'sarahislam@gmail.com', 0, '2023-11-21 07:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `order_placed_by_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `order_status`, `payment_mode`, `order_placed_by_id`) VALUES
(45, 12, '16525', 'INV-614033', '2080', '2023-11-17', 'Booked', 'Cash Payment', 8),
(46, 12, '97124', 'INV-222141', '1850', '2023-11-17', 'Booked', 'Cash Payment', 8),
(47, 12, '65032', 'INV-996030', '140', '2023-11-17', 'Booked', 'Cash Payment', 8),
(48, 13, '49090', 'INV-691095', '730', '2023-11-19', 'Booked', 'Cash Payment', 8),
(49, 14, '51891', 'INV-839732', '8020', '2023-11-20', 'Booked', 'Cash Payment', 8),
(50, 14, '92617', 'INV-741393', '900', '2023-11-20', 'Booked', 'Online Payment', 8),
(51, 15, '21713', 'INV-789716', '980', '2023-11-21', 'Booked', 'Online Payment', 8),
(52, 15, '56456', 'INV-321702', '450', '2023-11-21', 'Booked', 'Cash Payment', 8);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(37, 40, 2, '140', 2),
(38, 40, 1, '450', 4),
(39, 41, 2, '140', 2),
(40, 42, 2, '140', 2),
(41, 42, 1, '450', 4),
(42, 43, 2, '140', 2),
(43, 43, 1, '450', 4),
(44, 44, 2, '140', 2),
(45, 44, 1, '450', 4),
(46, 45, 2, '140', 2),
(47, 45, 1, '450', 4),
(48, 46, 1, '450', 1),
(49, 46, 3, '280', 5),
(50, 47, 2, '140', 1),
(51, 48, 1, '450', 1),
(52, 48, 2, '140', 2),
(53, 49, 2, '140', 10),
(54, 49, 3, '280', 14),
(55, 49, 1, '450', 6),
(56, 50, 1, '450', 2),
(57, 51, 2, '140', 3),
(58, 51, 3, '280', 2),
(59, 52, 1, '450', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=Visible; 1=Hidden',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(1, 2, 'Product Name 01', '', 450, 61, 'assets/uploads/products/1699856473.png', 0, '2023-11-12 15:18:23'),
(2, 2, 'Product Name 02', 'This is described as for product 02', 140, 20, 'assets/uploads/products/1699856484.png', 0, '2023-11-12 15:35:24'),
(3, 1, 'This is product 03', '', 280, 39, 'assets/uploads/products/1699856493.png', 0, '2023-11-13 05:25:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
