-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 20, 2025 lúc 08:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bansonnuoc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
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
-- Cấu trúc đóng vai cho view `best_selling_products`
-- (See below for the actual view)
--
CREATE TABLE `best_selling_products` (
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
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
-- Đang đổ dữ liệu cho bảng `brands`
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
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(1, 6, 4, 4, '2025-04-17 04:35:06'),
(5, 8, 4, 1, '2025-04-19 08:59:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Sơn Dulux', '2025-04-10 03:25:23'),
(2, 'Sơn Jotun', '2025-04-10 03:25:23'),
(3, 'Sơn Maxilite', '2025-04-10 03:25:23'),
(14, 'Sơn Nippon', '2025-05-20 16:19:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discount_types`
--

CREATE TABLE `discount_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
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
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `thumbnail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `note` text DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','delivering','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `note`, `total`, `status`) VALUES
(6, 6, '2025-05-10 14:23:00', 'Giao hàng nhanh', 1500000.00, 'pending'),
(7, 8, '2025-05-11 09:15:00', 'Yêu cầu giao buổi sáng', 2300000.00, 'delivering'),
(8, 11, '2025-05-12 18:45:00', NULL, 500000.00, 'completed'),
(9, 6, '2025-05-13 10:00:00', 'Kiểm tra kỹ hàng trước khi giao', 1200000.00, 'pending'),
(10, 8, '2025-05-14 16:30:00', 'Giao hàng ngoài giờ hành chính', 1750000.00, 'delivering');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
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
-- Cấu trúc bảng cho bảng `payments`
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
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category` enum('news','blog') NOT NULL,
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `thumbnail` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author_id`, `category`, `status`, `thumbnail`, `created_at`, `updated_at`) VALUES
(2, 'jksdbnol', '<p>ẹkhbo3l4in</p>', NULL, 'blog', 'published', '', '2025-05-20 12:26:49', '2025-05-20 12:26:49'),
(3, 'Sơn uy tính nhất ', '<p><strong>XIn chào</strong></p>', NULL, 'news', 'draft', '1747744795_dulux-logo.png', '2025-05-20 12:39:55', '2025-05-20 07:44:43'),
(4, 'Hướng Dẫn Sử Dụng Sơn Nước Hiệu Quả Cho Công Trình Của Bạn', '<p>Sơn nước là lựa chọn phổ biến để trang trí và bảo vệ bề mặt tường nội thất lẫn ngoại thất. Tuy nhiên, để sơn đạt độ bám dính tốt, màu sắc đẹp và bền lâu, bạn cần thực hiện đúng kỹ thuật. Dưới đây là hướng dẫn từng bước:</p><h3>???? Bước 1: Chuẩn Bị Bề Mặt</h3><p><strong>Làm sạch:</strong> Loại bỏ bụi bẩn, dầu mỡ, rêu mốc và lớp sơn cũ bong tróc bằng bàn chải hoặc máy mài.</p><p><strong>Xử lý nấm mốc (nếu có):</strong> Dùng dung dịch chống rêu mốc để xử lý triệt để.</p><p><strong>Trám trét:</strong> Sử dụng bột trét (bả) tường để làm phẳng bề mặt.</p><p><strong>Chờ khô:</strong> Bề mặt cần khô hoàn toàn, độ ẩm dưới 16% mới tiến hành sơn.</p><h3>???? Bước 2: Lăn Lót Sơn</h3><p><strong>Sơn lót kháng kiềm:</strong> Giúp chống ẩm và tăng độ bám cho lớp sơn phủ.</p><p><strong>Thi công:</strong> Dùng cọ, con lăn hoặc súng phun. Lăn đều tay, tránh tạo vệt.</p><p><strong>Chờ khô:</strong> Thường mất khoảng 2–4 giờ (tùy hãng sơn và thời tiết).</p><h3>???? Bước 3: Sơn Phủ Hoàn Thiện</h3><p><strong>Chọn màu:</strong> Tùy theo phong cách nội thất và ánh sáng, nên chọn màu sơn phù hợp.</p><p><strong>Lăn từ 2 lớp trở lên:</strong> Đảm bảo độ che phủ và bền màu.</p><p><strong>Thời gian giữa 2 lớp:</strong> Nên cách nhau ít nhất 2 giờ.</p><h3>✅ Lưu Ý Khi Sử Dụng</h3><p>Không thi công khi trời mưa, độ ẩm cao, hoặc tường còn ẩm ướt.</p><p>Khuấy đều sơn trước khi sử dụng.</p><p>Đọc kỹ hướng dẫn của nhà sản xuất in trên bao bì.</p><p>Dụng cụ thi công nên được rửa sạch bằng nước sau khi dùng.</p><h3>???? Kết Luận</h3><p>Sơn nước không chỉ làm đẹp mà còn bảo vệ công trình của bạn khỏi thời tiết và ẩm mốc. Việc chuẩn bị kỹ lưỡng và thi công đúng quy trình sẽ giúp bạn đạt được bề mặt sơn đẹp, mịn và bền theo thời gian.</p>', NULL, 'blog', 'published', '1747763409_goi-y-chon-hang-son-vua-re-vua-chat-luong-2.jpg', '2025-05-20 17:50:09', '2025-05-20 17:50:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` tinyint(4) DEFAULT 0,
  `stock` smallint(6) DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `view` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `discount`, `stock`, `category_id`, `brand_id`, `thumbnail`, `is_deleted`, `view`, `created_at`, `updated_at`) VALUES
(3, 'Sơn Dulux Inspire', 'Sơn nội thất có hương thơm nhẹ nhàng, dễ chịu.', 480000.00, 27, 60, 1, 1, 'Son-4.jpg', 0, 0, '2025-04-10 04:21:29', '2025-05-20 17:41:28'),
(4, 'Sơn Dulux EasyClean', 'Chống bám bẩn vượt trội, lau chùi dễ dàng.', 580000.00, 20, 120, 1, 2, 'Son-3.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-20 17:09:48'),
(5, 'Sơn Jotun Majestic', 'Sơn nội thất mịn cao cấp, không chứa chì.', 610000.00, 12, 90, 2, NULL, 'Son-5.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-20 16:08:08'),
(6, 'Sơn Nippon Odour-less', 'Sơn không mùi, thân thiện môi trường.', 500000.00, 12, 11, 14, 3, 'Son-6.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-20 16:19:25'),
(7, 'Sơn Kova K260', 'Sơn nước ngoài trời siêu bền màu.', 420000.00, 27, 70, 3, NULL, 'Son-2.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-20 17:16:17'),
(16, 'Sơn Maxilite Total', 'Sơn mới, sản phẩm mới đc bán', 100000.00, 0, 30, 14, NULL, '1747497701_Son-3.jpg', 0, 1, '2025-05-17 12:40:12', '2025-05-20 17:16:28'),
(20, 'dsfkbj', 'lldf', 100000.00, 0, 20, 3, NULL, '', 0, 0, '2025-05-17 13:40:29', '2025-05-20 14:56:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
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
-- Cấu trúc bảng cho bảng `reviews`
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
-- Cấu trúc bảng cho bảng `users`
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `address`, `role`, `is_deleted`, `created_at`, `updated_at`) VALUES
(6, 'Hồ Nguyễn Minh Khoa', '$2y$10$otquYARg2scQP6H9G2NetukAYNB1IiT3Uik7yRfh1MtSVxzwCemkm', 'mkhoa639@gmail.com', '0373441697', NULL, '', 0, '2025-04-17 03:02:06', '2025-04-17 03:02:06'),
(8, 'Khoa', '$2y$10$4Fs59MkA.TDPCn32jK0x1O3JB2Gc1H5qiDDAbQgAjBMzdw.qHSEuK', '52300038@student.tdtu.edu.vn', '0373441691', NULL, '', 0, '2025-04-17 03:31:12', '2025-04-17 03:31:12'),
(11, 'ahihi', '$2y$10$PnkpGZGMe56cYNhKjVZDoOL9iqeYYEPUZLo0iXAjFaSZL6ah1Eca.', '27014814@sfcollege.edu', '0373441699', NULL, '', 0, '2025-05-17 16:21:53', '2025-05-17 16:21:53');

-- --------------------------------------------------------

--
-- Cấu trúc cho view `best_selling_products`
--
DROP TABLE IF EXISTS `best_selling_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `best_selling_products`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`description` AS `description`, `p`.`price` AS `price`, `p`.`discount` AS `discount`, `p`.`stock` AS `stock`, `p`.`status` AS `status`, `p`.`thumbnail` AS `thumbnail`, `p`.`category_id` AS `category_id`, round(avg(`r`.`rating`),1) AS `rating`, count(`od`.`product_id`) AS `total_sold`, count(`r`.`id`) AS `reviews`, `p`.`created_at` AS `created_at`, `p`.`updated_at` AS `updated_at` FROM ((`products` `p` left join `order_details` `od` on(`p`.`id` = `od`.`product_id`)) left join `reviews` `r` on(`p`.`id` = `r`.`product_id`)) WHERE `p`.`is_deleted` = 0 GROUP BY `p`.`id` ORDER BY count(`od`.`product_id`) DESC ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cart` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `discount_types`
--
ALTER TABLE `discount_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_products_brand` (`brand_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `discount_type_id` (`discount_type_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `discount_types`
--
ALTER TABLE `discount_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promotions_ibfk_2` FOREIGN KEY (`discount_type_id`) REFERENCES `discount_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
