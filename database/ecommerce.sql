-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 05:48 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 3, 10, 13, 400.00, '2024-11-21 15:59:43', '2024-11-21 16:25:37'),
(2, 3, 11, 3, 5000.00, '2024-11-21 16:03:44', '2024-11-21 16:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_cat`
--

CREATE TABLE `main_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_cat`
--

INSERT INTO `main_cat` (`cat_id`, `cat_name`) VALUES
(1, 'Electronics'),
(2, 'Fashion'),
(3, 'Home & Living'),
(4, 'Beauty & Personal Care'),
(5, 'Books & Media'),
(6, 'Toys & Games'),
(7, 'Grocery & Essentials'),
(8, 'Sports & Outdoors'),
(9, 'Health & Wellness'),
(10, 'Baby & Kids'),
(11, 'Automotive'),
(12, 'Art & Craft'),
(13, 'Gifts & Seasonal'),
(14, 'Office Supplies'),
(15, 'Travel & Luggage'),
(16, 'Pet Supplies'),
(17, 'Luxury Goods'),
(18, 'Technology & Gadgets'),
(19, 'Music & Instruments'),
(20, 'Hardware & Tools');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `status` enum('pending','paid','shipped','cancelled') DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','cash','POS') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_purchase` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `main_cat_id` int(11) DEFAULT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `store_id`, `main_cat_id`, `sub_cat_id`, `name`, `description`, `price`, `created_at`, `img`, `qty`) VALUES
(10, 7, 1, 2, ' Acer', 'good cpu', 400.00, '2024-11-20 20:53:16', 'img_673e4c3c7b54b1.19574265.png', 10),
(11, 7, 1, 6, ' TV', 'good display', 5000.00, '2024-11-20 20:53:43', 'img_673e4c56f02531.97007580.png', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `contact` int(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `fullName`, `email`, `store_name`, `contact`, `country`, `region`, `city`, `password_hash`, `created_at`, `updated_at`, `img`) VALUES
(6, 'Miriam Naayeye Appiah', 'miriam.appiah@ashesi.edu.gh', 'mimi stores', 508691992, 'Ghana', 'eastern', 'Accra', '$2y$10$QtVuJQsHQhRbqfNDFhyjVOwwz8SPamc8F3uyWgXL.fGatq19HIp6u', '2024-11-18 14:24:05', '2024-11-18 14:24:05', '673b4e05a4184-cover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_id`, `sub_name`, `cat_id`) VALUES
(1, 'Smartphones', 1),
(2, 'Laptops', 1),
(3, 'Tablets', 1),
(4, 'Cameras', 1),
(5, 'Audio & Headphones', 1),
(6, 'Televisions', 1),
(7, 'Smartwatches & Wearables', 1),
(8, 'Gaming Consoles', 1),
(9, 'Computer Accessories', 1),
(10, 'Drones & Accessories', 1),
(11, 'Men’s Clothing', 2),
(12, 'Women’s Clothing', 2),
(13, 'Kids’ Clothing', 2),
(14, 'Shoes', 2),
(15, 'Jewelry', 2),
(16, 'Watches', 2),
(17, 'Bags & Purses', 2),
(18, 'Sunglasses & Eyewear', 2),
(19, 'Accessories', 2),
(20, 'Furniture', 3),
(21, 'Kitchenware', 3),
(22, 'Home Décor', 3),
(23, 'Lighting', 3),
(24, 'Gardening Supplies', 3),
(25, 'Bedding & Linens', 3),
(26, 'Skincare', 4),
(27, 'Makeup', 4),
(28, 'Haircare', 4),
(29, 'Fragrances', 4),
(30, 'Personal Hygiene', 4),
(31, 'Fiction', 5),
(32, 'Non-Fiction', 5),
(33, 'Textbooks', 5),
(34, 'Comics & Graphic Novels', 5),
(35, 'E-books', 5),
(36, 'Music CDs', 5),
(37, 'Movies & DVDs', 5),
(38, 'Educational Toys', 6),
(39, 'Outdoor Toys', 6),
(40, 'Board Games', 6),
(41, 'Action Figures', 6),
(42, 'Video Games', 6),
(43, 'Fresh Produce', 7),
(44, 'Meat & Seafood', 7),
(45, 'Beverages', 7),
(46, 'Snacks', 7),
(47, 'Dairy Products', 7),
(48, 'Cleaning Supplies', 7),
(49, 'Pet Supplies', 7),
(50, 'Sports Equipment', 8),
(51, 'Gym Equipment', 8),
(52, 'Outdoor Gear', 8),
(53, 'Sportswear', 8),
(54, 'Supplements', 9),
(55, 'Medical Devices', 9),
(56, 'Fitness Accessories', 9),
(57, 'Baby Gear', 10),
(58, 'Diapers & Wipes', 10),
(59, 'Baby Clothing', 10),
(60, 'Kids’ Toys', 10),
(61, 'Feeding Essentials', 10),
(62, 'Car Accessories', 11),
(63, 'Motorbike Accessories', 11),
(64, 'Tires & Wheels', 11),
(65, 'Vehicle Tools', 11),
(66, 'Handmade Goods', 12),
(67, 'DIY Craft Kits', 12),
(68, 'Art Supplies', 12),
(69, 'Sculptures', 12),
(70, 'Knitting & Sewing Supplies', 12),
(71, 'Personalized Gifts', 13),
(72, 'Greeting Cards', 13),
(73, 'Holiday Decorations', 13),
(74, 'Stationery', 14),
(75, 'Office Furniture', 14),
(76, 'Business Essentials', 14),
(77, 'Luggage', 15),
(78, 'Travel Accessories', 15),
(79, 'Camping Gear', 15),
(80, 'Pet Food', 16),
(81, 'Pet Toys', 16),
(82, 'Pet Accessories', 16),
(83, 'High-end Fashion', 17),
(84, 'Designer Jewelry', 17),
(85, 'Collectibles', 17),
(86, 'Wearables', 18),
(87, 'Smart Home Devices', 18),
(88, 'Musical Instruments', 19),
(89, 'Audio Equipment', 19),
(90, 'Power Tools', 20),
(91, 'Hand Tools', 20),
(92, 'DIY Supplies', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(20) NOT NULL,
  `region` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullName`, `email`, `contact`, `region`, `city`, `password_hash`, `updated_at`, `created_at`) VALUES
(3, 'jared', 'jared@gmail.com', 577087383, 'Eastern', 'Accra', '$2y$10$WLBaRXBKyvzSLybayXjkhOUwBsobaQ8FqsKIs4Ijiser8wEuE.dz6', '2024-11-20 23:17:03', '2024-11-20 23:17:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `main_cat`
--
ALTER TABLE `main_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `cat_id` (`cat_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_cat`
--
ALTER TABLE `main_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
