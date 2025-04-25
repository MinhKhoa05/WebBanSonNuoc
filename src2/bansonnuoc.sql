-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 08:34 PM
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
-- Database: `bansonnuoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `category` enum('news','blog') NOT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `best_selling_products`
-- (See below for the actual view)
--
CREATE TABLE `best_selling_products` (
`id` int(11)
,`name` varchar(100)
,`description` text
,`price` decimal(10,2)
,`discount` decimal(10,2)
,`stock` smallint(6)
,`status` enum('In Stock','Out of Stock')
,`thumbnail` varchar(500)
,`category_id` int(11)
,`rating` decimal(5,1)
,`total_sold` bigint(21)
,`reviews` bigint(21)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `thumbnail`, `is_featured`, `created_at`) VALUES
(1, 'Dulux', 'Thuộc tập đoàn AkzoNobel, đa dạng màu sắc và ứng dụng dễ dàng.', 'dulux-logo.png', 1, '2025-04-23 15:10:36'),
(2, 'Jotun', 'Thương hiệu sơn nổi tiếng từ Na Uy, bền màu và chất lượng cao.', 'jotun-logo.png', 1, '2025-04-23 15:10:36'),
(3, 'Nippon', 'Sơn Nhật Bản, thân thiện môi trường, độ phủ cao.\r\n', 'nippon-logo.png', 1, '2025-04-23 15:10:36'),
(4, 'Mykolor', 'Thương hiệu cao cấp với thiết kế hiện đại, phù hợp trang trí nội thất.\r\n', 'mykolor-logo.png', 1, '2025-04-23 15:10:36'),
(5, 'Kova', 'Thương hiệu Việt Nam, nổi bật với dòng sơn chống thấm và sơn công trình.\r\n', 'kova-logo.png', 1, '2025-04-23 15:10:36'),
(6, 'TOA', 'Sơn Thái Lan, phổ biến cho cả nội ngoại thất, giá cả hợp lý.\r\n', 'toa-logo.png', 1, '2025-04-23 15:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 6, 4, 4, '2025-04-17 04:35:06'),
(5, 8, 4, 1, '2025-04-19 08:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Sơn Dulux', '2025-04-10 03:25:23'),
(2, 'Sơn Jotun', '2025-04-10 03:25:23'),
(3, 'Sơn Maxilite', '2025-04-10 03:25:23'),
(4, 'Sơn Kova', '2025-04-10 03:25:23'),
(5, 'Sơn Nippon', '2025-04-10 03:25:23'),
(6, 'Sơn Vip pro', '2025-04-10 03:41:49'),
(7, 'Sơn chống thấm thế hệ mới', '2025-04-10 03:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `discount_types`
--

CREATE TABLE `discount_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `thumbnail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','delivering','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `method` varchar(100) NOT NULL,
  `status` enum('pending','completed','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `category` enum('news','blog') NOT NULL,
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `thumbnail` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `stock` smallint(6) DEFAULT 0,
  `status` enum('In Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `discount`, `stock`, `status`, `category_id`, `brand_id`, `thumbnail`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Sơn Maxilite Total', 'Sơn nước nội thất cao cấp, độ phủ tốt.', 450000.00, 50000.00, 100, 'In Stock', 1, NULL, 'Son-1.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(2, 'Sơn Maxilite Tough', 'Sơn chịu chùi rửa mạnh, thích hợp cho phòng khách.', 520000.00, 70000.00, 80, 'In Stock', 1, NULL, 'Son-2.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(3, 'Sơn Dulux Inspire', 'Sơn nội thất có hương thơm nhẹ nhàng, dễ chịu.', 480000.00, 30000.00, 60, 'In Stock', 1, NULL, 'Son-4.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(4, 'Sơn Dulux EasyClean', 'Chống bám bẩn vượt trội, lau chùi dễ dàng.', 580000.00, 80000.00, 120, 'In Stock', 2, NULL, 'Son-3.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(5, 'Sơn Jotun Majestic', 'Sơn nội thất mịn cao cấp, không chứa chì.', 610000.00, 60000.00, 90, 'In Stock', 2, NULL, 'Son-5.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(6, 'Sơn Nippon Odour-less', 'Sơn không mùi, thân thiện môi trường.', 500000.00, 45000.00, 110, 'In Stock', 2, NULL, 'Son-6.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(7, 'Sơn Kova K260', 'Sơn nước ngoài trời siêu bền màu.', 420000.00, 40000.00, 70, 'In Stock', 3, NULL, 'Son-2.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(8, 'Sơn Joton Jona', 'Sơn tường nội thất giá rẻ, phù hợp nhà trọ.', 300000.00, 20000.00, 200, 'In Stock', 3, NULL, 'Son-3.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(9, 'Sơn Spec Go Green', 'Sơn thân thiện môi trường, dễ sử dụng.', 350000.00, 25000.00, 150, 'In Stock', 4, NULL, 'Son-4.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29'),
(10, 'Sơn TOA Nano Shield', 'Sơn ngoại thất chống thấm cao cấp.', 680000.00, 90000.00, 65, 'In Stock', 4, NULL, 'Son-5.jpg', 0, '2025-04-10 04:21:29', '2025-04-10 04:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_type_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `role`, `is_deleted`, `created_at`, `updated_at`) VALUES
(6, 'Hồ Nguyễn Minh Khoa', '$2y$10$otquYARg2scQP6H9G2NetukAYNB1IiT3Uik7yRfh1MtSVxzwCemkm', 'mkhoa639@gmail.com', '0373441697', NULL, '', 0, '2025-04-17 03:02:06', '2025-04-17 03:02:06'),
(8, 'Khoa', '$2y$10$4Fs59MkA.TDPCn32jK0x1O3JB2Gc1H5qiDDAbQgAjBMzdw.qHSEuK', '52300038@student.tdtu.edu.vn', '0373441691', NULL, '', 0, '2025-04-17 03:31:12', '2025-04-17 03:31:12');

-- --------------------------------------------------------

--
-- Structure for view `best_selling_products`
--
DROP TABLE IF EXISTS `best_selling_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `best_selling_products`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`description` AS `description`, `p`.`price` AS `price`, `p`.`discount` AS `discount`, `p`.`stock` AS `stock`, `p`.`status` AS `status`, `p`.`thumbnail` AS `thumbnail`, `p`.`category_id` AS `category_id`, round(avg(`r`.`rating`),1) AS `rating`, count(`od`.`product_id`) AS `total_sold`, count(`r`.`id`) AS `reviews`, `p`.`created_at` AS `created_at`, `p`.`updated_at` AS `updated_at` FROM ((`products` `p` left join `order_details` `od` on(`p`.`id` = `od`.`product_id`)) left join `reviews` `r` on(`p`.`id` = `r`.`product_id`)) WHERE `p`.`is_deleted` = 0 GROUP BY `p`.`id` ORDER BY count(`od`.`product_id`) DESC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `discount_types`
--
ALTER TABLE `discount_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_products_brand` (`brand_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `discount_type_id` (`discount_type_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discount_types`
--
ALTER TABLE `discount_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promotions_ibfk_2` FOREIGN KEY (`discount_type_id`) REFERENCES `discount_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
