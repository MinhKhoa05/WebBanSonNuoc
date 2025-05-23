-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 10:09 PM
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
(14, 'Sơn Nippon', '2025-05-20 16:19:11'),
(16, 'Sơn TOA', '2025-05-23 16:25:23');

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
  `note` text DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','delivering','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `note`, `total`, `status`) VALUES
(6, 6, '2025-05-10 14:23:00', 'Giao hàng nhanh', 1500000.00, 'pending'),
(7, 8, '2025-05-11 09:15:00', 'Yêu cầu giao buổi sáng', 2300000.00, 'delivering'),
(8, 11, '2025-05-12 18:45:00', NULL, 500000.00, 'completed'),
(9, 6, '2025-05-13 10:00:00', 'Kiểm tra kỹ hàng trước khi giao', 1200000.00, 'pending'),
(10, 8, '2025-05-14 16:30:00', 'Giao hàng ngoài giờ hành chính', 1750000.00, 'delivering'),
(11, 6, '2025-05-20 20:36:06', NULL, 2850000.00, 'pending'),
(12, 12, '2025-05-21 10:45:28', NULL, 1140000.00, 'delivering'),
(13, 12, '2025-05-22 17:14:22', NULL, 610000.00, 'pending'),
(14, 12, '2025-05-22 17:26:24', '', 640000.00, 'pending'),
(15, 12, '2025-05-22 17:26:41', '', 640000.00, 'pending'),
(16, 12, '2025-05-22 17:26:52', '', 640000.00, 'pending'),
(17, 12, '2025-05-22 17:29:30', '', 1140000.00, 'pending'),
(18, 12, '2025-05-22 17:30:46', '', 1640000.00, 'pending'),
(19, 12, '2025-05-22 17:34:49', '', 1640000.00, 'pending'),
(20, 12, '2025-05-22 17:42:16', '', 2140000.00, 'pending'),
(21, 12, '2025-05-22 17:44:53', '', 2140000.00, 'pending'),
(22, 12, '2025-05-22 17:52:15', '', 2140000.00, 'pending'),
(23, 12, '2025-05-22 17:54:44', '', 2140000.00, 'pending'),
(24, 12, '2025-05-22 17:56:30', '', 2140000.00, 'pending'),
(25, 12, '2025-05-22 18:17:55', NULL, 2140000.00, 'pending');

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

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `subtotal`) VALUES
(1, 11, 4, 0, 580000.00),
(2, 11, 6, 0, 500000.00),
(3, 12, 5, 0, 610000.00),
(4, 12, 6, 0, 500000.00),
(5, 13, 4, 0, 580000.00),
(6, 25, 5, 1, 610000.00),
(7, 25, 6, 3, 500000.00);

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
  `slug` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category` enum('news','blog') NOT NULL,
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `thumbnail` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `slug`, `author_id`, `category`, `status`, `thumbnail`, `created_at`, `updated_at`) VALUES
(2, 'Cách chọn sơn nước phù hợp cho ngôi nhà của bạn', '<p>Sơn nước là một trong những vật liệu quan trọng giúp bảo vệ và làm đẹp cho ngôi nhà của bạn. Việc chọn loại sơn phù hợp không chỉ giúp ngôi nhà bền đẹp theo thời gian mà còn đảm bảo an toàn cho sức khỏe gia đình.</p><h3>1. Chọn sơn theo khu vực sử dụng</h3><p>Sơn nội thất nên có mùi nhẹ, dễ lau chùi và không độc hại. Sơn ngoại thất cần có khả năng chống thấm, chống nắng và chịu được thời tiết khắc nghiệt như mưa, gió, nắng nóng.</p><h3>2. Chọn theo loại bề mặt</h3><p>Mỗi bề mặt tường khác nhau sẽ phù hợp với loại sơn riêng. Ví dụ, tường xi măng, tường gỗ hay kim loại cần loại sơn có thành phần khác nhau để tăng độ bám dính và độ bền.</p><h3>3. Lựa chọn thương hiệu uy tín</h3><p>Nên chọn những thương hiệu sơn nổi tiếng, có chính sách bảo hành rõ ràng như Dulux, Jotun, Nippon… để đảm bảo chất lượng và dịch vụ hỗ trợ sau bán hàng.</p><h3>4. Màu sắc và kiểu dáng</h3><p>Màu sắc của sơn nên phù hợp với phong cách thiết kế và sở thích cá nhân. Nên chọn những gam màu trung tính, dễ phối hợp và tạo cảm giác dễ chịu.</p>', 'cach-chon-son-nuoc-phu-hop-cho-ngoi-nha-cua-ban', NULL, 'blog', 'published', '1747807604_toa-logo.png', '2025-05-20 12:26:49', '2025-05-21 01:08:52'),
(4, 'Hướng Dẫn Sử Dụng Sơn Nước Hiệu Quả Cho Công Trình Của Bạn', '<p>Sơn nước là lựa chọn phổ biến để trang trí và bảo vệ bề mặt tường nội thất lẫn ngoại thất. Tuy nhiên, để sơn đạt độ bám dính tốt, màu sắc đẹp và bền lâu, bạn cần thực hiện đúng kỹ thuật. Dưới đây là hướng dẫn từng bước:</p><h3>???? Bước 1: Chuẩn Bị Bề Mặt</h3><p><strong>Làm sạch:</strong> Loại bỏ bụi bẩn, dầu mỡ, rêu mốc và lớp sơn cũ bong tróc bằng bàn chải hoặc máy mài.</p><p><strong>Xử lý nấm mốc (nếu có):</strong> Dùng dung dịch chống rêu mốc để xử lý triệt để.</p><p><strong>Trám trét:</strong> Sử dụng bột trét (bả) tường để làm phẳng bề mặt.</p><p><strong>Chờ khô:</strong> Bề mặt cần khô hoàn toàn, độ ẩm dưới 16% mới tiến hành sơn.</p><h3>???? Bước 2: Lăn Lót Sơn</h3><p><strong>Sơn lót kháng kiềm:</strong> Giúp chống ẩm và tăng độ bám cho lớp sơn phủ.</p><p><strong>Thi công:</strong> Dùng cọ, con lăn hoặc súng phun. Lăn đều tay, tránh tạo vệt.</p><p><strong>Chờ khô:</strong> Thường mất khoảng 2–4 giờ (tùy hãng sơn và thời tiết).</p><h3>???? Bước 3: Sơn Phủ Hoàn Thiện</h3><p><strong>Chọn màu:</strong> Tùy theo phong cách nội thất và ánh sáng, nên chọn màu sơn phù hợp.</p><p><strong>Lăn từ 2 lớp trở lên:</strong> Đảm bảo độ che phủ và bền màu.</p><p><strong>Thời gian giữa 2 lớp:</strong> Nên cách nhau ít nhất 2 giờ.</p><h3>✅ Lưu Ý Khi Sử Dụng</h3><p>Không thi công khi trời mưa, độ ẩm cao, hoặc tường còn ẩm ướt.</p><p>Khuấy đều sơn trước khi sử dụng.</p><p>Đọc kỹ hướng dẫn của nhà sản xuất in trên bao bì.</p><p>Dụng cụ thi công nên được rửa sạch bằng nước sau khi dùng.</p><h3>???? Kết Luận</h3><p>Sơn nước không chỉ làm đẹp mà còn bảo vệ công trình của bạn khỏi thời tiết và ẩm mốc. Việc chuẩn bị kỹ lưỡng và thi công đúng quy trình sẽ giúp bạn đạt được bề mặt sơn đẹp, mịn và bền theo thời gian.</p>', 'huong-dan-su-dung-son-nuoc-hieu-qua-cho-cong-trinh-cua-ban', NULL, 'blog', 'published', '1747763409_goi-y-chon-hang-son-vua-re-vua-chat-luong-2.jpg', '2025-05-20 17:50:09', '2025-05-20 13:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
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
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `discount`, `stock`, `category_id`, `brand_id`, `thumbnail`, `is_deleted`, `view`, `created_at`, `updated_at`) VALUES
(3, 'Sơn Dulux Inspire', 'Sơn nội thất có hương thơm nhẹ nhàng, dễ chịu.', 480000, 27, 60, 1, 1, 'Son-4.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-23 16:58:30'),
(4, 'Sơn Dulux EasyClean', 'Chống bám bẩn vượt trội, lau chùi dễ dàng.', 580000, 20, 120, 1, 2, 'Son-3.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-20 17:09:48'),
(5, 'Sơn Jotun Majestic', 'Sơn nội thất mịn cao cấp, không chứa chì.', 610000, 12, 90, 2, 2, 'Son-5.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-23 16:58:53'),
(6, 'Sơn Nippon Odour-less', 'Sơn không mùi, thân thiện môi trường.', 500000, 12, 11, 14, 3, 'Son-6.jpg', 0, 1, '2025-04-10 04:21:29', '2025-05-20 16:19:25'),
(16, 'Sơn Maxilite Total', 'Sơn mới, sản phẩm mới đc bán', 100000, 0, 30, 14, 3, '1747497701_Son-3.jpg', 0, 1, '2025-05-17 12:40:12', '2025-05-23 16:59:08'),
(20, 'dsfkbj', 'lldf', 100000, 0, 20, 3, NULL, '', 1, 0, '2025-05-17 13:40:29', '2025-05-23 16:52:50'),
(23, 'Sơn TOA NanoShield', 'Sơn ngoại thất', 500000, 0, 20, 16, 6, '1748017817_TOA_nano.png', 0, 1, '2025-05-23 16:30:17', '2025-05-23 16:30:17'),
(24, 'Sơn TOA Extra Wet Primer', 'Sơn ngoại thất', 400000, 0, 20, 16, 6, '1748017940_TOA_extra.png', 0, 1, '2025-05-23 16:32:20', '2025-05-23 16:32:20'),
(25, 'Sơn TOA 7 in 1', 'Sơn ngoại thất', 600000, 0, 20, 16, 6, '1748017974_TOA_7in1.png', 0, 1, '2025-05-23 16:32:54', '2025-05-23 16:32:54'),
(26, 'TOA 4 Seasons Super Contact Sealer', 'Sơn ngoại thất', 450000, 0, 30, 16, 6, '1748018064_timthumb17-400x400.png', 0, 1, '2025-05-23 16:34:24', '2025-05-23 16:34:24'),
(27, 'Sơn lót nội thất cao cấp SuperSealer', 'Sơn lót nội thất', 500000, 0, 24, 1, 1, '1748018496_DUL033-400x400.png', 0, 1, '2025-05-23 16:41:36', '2025-05-23 16:41:36'),
(28, 'Sơn Lót Ngoại Thất Dulux Weathershield Chống Kiềm', 'Sơn Lót Ngoại Thất', 490000, 0, 23, 1, 1, '1748018586_DUL001-600x600.png', 0, 1, '2025-05-23 16:43:06', '2025-05-23 16:43:06'),
(29, 'Majestic Đẹp Hoàn Hảo Mờ', 'Sơn nội thất Jotun', 560000, 0, 23, 2, 2, '1748018964_VNVI2019-majestic-true-beauty-matt-product-316x226-2019_tcm47-185030-600x600.jpg', 0, 1, '2025-05-23 16:49:24', '2025-05-23 16:49:24'),
(30, 'Majestic Đẹp Hoàn Hảo Bóng', 'Sơn nội thất Jotun', 490000, 0, 34, 2, 2, '1748019053_VNVI2019-majestic-true-beauty-sheen-product-316x226-2019_tcm47-185037-600x600.jpg', 0, 1, '2025-05-23 16:50:53', '2025-05-23 16:50:53'),
(31, 'Majestic Đẹp & Chăm Sóc Hoàn Hảo', 'Sơn nội thất Jotun', 450000, 0, 34, 2, 2, '1748019116_VNVI-majestic-perfect-beauty-and-care-product-316x226_tcm47-144703-600x600.jpg', 0, 1, '2025-05-23 16:51:56', '2025-05-23 16:51:56'),
(32, 'Sơn Nước Trong Nhà Maxilite Total', 'Sơn nội thất Maxilite', 560000, 0, 34, 3, 4, '1748019244_Maxi008-600x600.png', 0, 1, '2025-05-23 16:54:04', '2025-05-23 16:58:03'),
(33, 'Sơn Nước Trong Nhà Maxilite Smooth', 'Sơn nội thất Maxilite', 560000, 0, 23, 3, 4, '1748019324_Maxi010-600x600.png', 0, 1, '2025-05-23 16:55:24', '2025-05-23 16:55:24'),
(34, 'Sơn Nước Trong Nhà Maxilite Hi-Cover', 'Sơn nội thất Maxilite', 560000, 0, 34, 3, 4, '1748019370_Maxi009-600x600.png', 0, 1, '2025-05-23 16:56:10', '2025-05-23 16:56:10'),
(35, 'Sơn Nước Ngoài Trời Maxilite Ultima - Bề Mặt Mờ', 'Sơn ngoại thất Maxilite', 560000, 0, 34, 3, 4, '1748019413_Maxi005-600x600.png', 0, 1, '2025-05-23 16:56:53', '2025-05-23 16:56:53');

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
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(5, 'customer_banner_1', 'banner_1_6830ce0c61d6a.jpg', '2025-05-23 15:16:27', '2025-05-23 19:44:47'),
(6, 'customer_banner_2', 'banner_2_6830ce0c63040.png', '2025-05-23 15:16:27', '2025-05-23 19:44:47'),
(7, 'customer_banner_3', 'banner_3_6830ce0c63d78.jpg', '2025-05-23 15:16:27', '2025-05-23 19:44:47'),
(8, 'customer_banner_4', 'banner_4_6830ce0c6a09b.jpg', '2025-05-23 15:16:27', '2025-05-23 19:44:47'),
(9, 'customer_banner_5', 'banner_5_6830ce0c6b42e.jpg', '2025-05-23 15:16:27', '2025-05-23 19:44:47'),
(10, 'customer_banner_6', 'banner_6_6830ce0c6c8a3.jpg', '2025-05-23 15:16:27', '2025-05-23 19:44:47'),
(11, 'customer_banner_7', 'banner_7_6830d02f24466.jpg', '2025-05-23 18:31:35', '2025-05-23 19:44:47'),
(12, 'customer_banner_8', 'banner_8_6830d02f2811a.jpg', '2025-05-23 18:31:35', '2025-05-23 19:44:47');

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
(8, 'Khoa', '$2y$10$4Fs59MkA.TDPCn32jK0x1O3JB2Gc1H5qiDDAbQgAjBMzdw.qHSEuK', '52300038@student.tdtu.edu.vn', '0373441691', NULL, '', 0, '2025-04-17 03:31:12', '2025-04-17 03:31:12'),
(11, 'ahihi', '$2y$10$PnkpGZGMe56cYNhKjVZDoOL9iqeYYEPUZLo0iXAjFaSZL6ah1Eca.', '27014814@sfcollege.edu', '0373441699', NULL, '', 0, '2025-05-17 16:21:53', '2025-05-17 16:21:53'),
(12, 'Phạm Tiến Lực', '$2y$10$s4aFW5/XJS0AuxTdZK.FP.EYxWQ5To0xvCA28/K.Ct4dBYrJBjg9q', 'tienluc14052005@gmail.com', '0971578966', NULL, 'admin', 0, '2025-05-21 06:31:07', '2025-05-22 18:09:56');

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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
