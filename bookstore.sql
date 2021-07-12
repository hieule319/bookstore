-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 27, 2021 lúc 01:20 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `thumbnail`, `link`, `location`, `invalid`, `created_at`, `updated_at`) VALUES
(1, '1622094115-banner.png', 'http://bookstoreproject.online/', 'MAIN SLIDE', 0, '2021-05-27 05:02:05', '2021-05-27 05:41:55'),
(2, '1622093738-banner.jpg', 'http://bookstoreproject.online/', 'MAIN SLIDE', 0, '2021-05-27 05:35:38', '2021-05-27 05:35:38'),
(3, '1622094148-banner.jpg', 'http://bookstoreproject.online/', 'MAIN SLIDE', 0, '2021-05-27 05:42:28', '2021-05-27 05:42:28'),
(4, '1622094202-banner.png', 'http://bookstoreproject.online/', 'Banner', 0, '2021-05-27 05:43:22', '2021-05-27 05:43:22'),
(5, '1622094324-banner.png', 'http://bookstoreproject.online/', 'Banner', 0, '2021-05-27 05:44:09', '2021-05-27 05:45:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 : active , 1: non-active',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `category_name`, `status`, `slug`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 'Sách Giáo Khoa', 0, 'sach-giao-khoa', 0, '2021-05-08 02:58:41', '2021-05-14 02:10:10'),
(2, 'Truyện Tranh', 0, 'truyen-tranh', 0, '2021-05-08 02:58:49', '2021-05-14 02:10:01'),
(3, 'Kinh Tế', 0, 'kinh-te', 0, '2021-05-08 02:58:57', '2021-05-14 02:09:51'),
(4, 'Tâm Lý Học', 0, 'tam-ly-hoc', 0, '2021-05-08 02:59:10', '2021-05-14 02:09:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_detail`
--

CREATE TABLE `category_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_detail_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_detail`
--

INSERT INTO `category_detail` (`id`, `category_detail_name`, `category_id`, `slug`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 'Toán Học', 1, 'toan-hoc', 0, '2021-05-08 07:58:37', '2021-05-14 02:03:14'),
(2, 'Văn Học', 1, 'van-hoc', 0, '2021-05-08 18:53:51', '2021-05-14 02:03:06'),
(3, 'Đạo Đức', 1, 'dao-duc', 0, '2021-05-08 18:58:53', '2021-05-14 02:02:57'),
(4, 'Địa Lý', 1, 'dia-ly', 0, '2021-05-14 01:37:19', '2021-05-14 01:59:32'),
(5, 'Sinh Học', 1, 'sinh-hoc', 0, '2021-05-14 02:03:36', '2021-05-14 02:03:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `product_id`, `comment`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'sách hay quá', 0, '2021-05-23 15:29:24', '2021-05-23 15:29:24'),
(2, 2, 1, 'Giao hàng đúng giờ sách hay !', 0, '2021-05-23 15:50:46', '2021-05-23 15:50:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `email`, `phone`, `content`, `status`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 'Lê Văn Hiếu', 'hieulev319@gmail.com', 888888888, 'Xin shop hỗ trợ trả hàng', 1, 0, '2021-05-25 15:57:39', '2021-05-26 13:16:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_delivery` int(11) NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `fullname`, `email`, `user_id`, `address`, `city`, `province`, `phone_delivery`, `invalid`, `created_at`, `updated_at`) VALUES
(1, NULL, '', 1, '911/1/8 Lạc Long Quân , P.11, Q.Tân Bình', 'Hồ Chí Minh', NULL, 888537087, 0, '2021-05-19 22:49:54', '2021-05-19 22:49:54'),
(2, NULL, '', 1, 'Ấp 6 , xã Sông Trầu , huyện Trảng Bom', NULL, 'Đồng Nai', 888537087, 0, '2021-05-19 23:53:56', '2021-05-20 00:45:43'),
(3, 'Lê Văn Hiếu', '', 1, '911/1/8 Lạc Long Quân , P.11, Q.Tân Bình', 'ádasd', 'Đồng Nai', 7897979, 0, '2021-05-20 01:34:48', '2021-05-20 01:34:48'),
(4, 'Lê Văn Hiếu', 'hieulev319@gmail.com', 1, '112 Gò Vấp', 'Hồ Chí Minh', NULL, 888888888, 0, '2021-05-20 04:09:24', '2021-05-20 04:09:24'),
(5, 'Lê Văn Hiếu', 'hieulev319@gmail.com', 1, '112 Gò Vấp', 'Hồ Chí Minh', NULL, 888888888, 0, '2021-05-20 04:11:02', '2021-05-20 04:11:02'),
(6, 'Lê Văn Hiếu', 'hieulev319@gmail.com', 1, '112 Gò Vấp', 'Hồ Chí Minh', NULL, 888888888, 0, '2021-05-20 04:11:52', '2021-05-20 04:11:52'),
(7, 'Lê Văn Hiếu', 'hieulev319@gmail.com', 2, '911/1/8 Lạc Long Quân , P.11, Q.Tân Bình', 'Hồ Chí Minh', NULL, 888888888, 0, '2021-05-20 19:54:00', '2021-05-20 19:54:00'),
(8, 'Lê Văn Hiếu', 'hieulev319@gmail.com', 2, 'Ấp 6 , xã Sông Trầu , huyện Trảng Bom', NULL, 'Đồng Nai', 888537087, 0, '2021-05-20 20:14:48', '2021-05-20 20:14:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qrcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory`
--

INSERT INTO `inventory` (`id`, `product_name`, `product_qrcode`, `product_price`, `product_quantity`, `total_price`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 'Đắc nhân tâm', 'LQTAMCCXCGQE', 49000, 10, 490000, 0, '2021-05-27 10:49:04', '2021-05-27 10:49:04'),
(2, 'Tiếng Việt 1 - Tập 1', 'NTILMXGAFFHH', 49000, 10, 490000, 0, '2021-05-27 10:49:04', '2021-05-27 10:49:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_05_07_164145_create_table_user', 1),
(2, '2021_05_07_164342_create_table_category', 1),
(3, '2021_05_07_164404_create_table_unit', 1),
(6, '2021_05_08_102501_create_table_category_detail', 2),
(10, '2021_05_09_020552_create_table_publisher', 3),
(14, '2021_05_09_151842_create_table_product', 4),
(15, '2021_05_16_074145_create_table_promotion', 5),
(18, '2021_05_18_134644_add_fields_table_product', 6),
(19, '2021_05_20_035832_add_fields_table_user', 7),
(20, '2021_05_20_043058_adds_fields_table_user', 8),
(21, '2021_05_20_044829_create_table_delivery_address', 9),
(23, '2021_05_20_135607_create_table_order', 10),
(24, '2021_05_20_141825_create_table_order_detail', 10),
(26, '2021_05_21_033104_add_field_order', 11),
(28, '2021_05_21_134438_add_field_table_order', 12),
(29, '2021_05_22_113623_add_field_table_promotion', 13),
(32, '2021_05_23_213455_create_table_comment', 14),
(33, '2021_05_23_225419_create_table_wishlist', 15),
(36, '2021_05_25_223816_create_table_contact', 16),
(37, '2021_05_27_111838_create_table_banner', 17),
(39, '2021_05_27_160516_create_table_inventory', 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: đang xử lý, 1: xử lý, 2:giao cho bộ phân GH, 3:Giao hàng, 4: Nhận hàng và thanh toán',
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hình thức than toán',
  `deliveryId` int(11) NOT NULL,
  `promotion_id` int(11) DEFAULT NULL,
  `estimate_date` date DEFAULT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `order_code`, `user_id`, `total`, `status`, `payment`, `deliveryId`, `promotion_id`, `estimate_date`, `invalid`, `created_at`, `updated_at`) VALUES
(3, '$2y$10$m//wmsAGlnlLXYd7wCMg/Ojb44fzi7PtmgOLbQr5ampxJfaqLHDeK', 2, 111900, 0, 'cash', 7, 1, NULL, 1, '2021-05-21 04:12:17', '2021-05-21 04:12:17'),
(4, '$2y$10$e4hM2W/Jo5QYq8WaoviYXei27KjODj39VLL75ibJ.bNOcIelcu5a.', 2, 111900, 0, 'cash', 7, 1, NULL, 1, '2021-05-21 04:13:11', '2021-05-21 04:13:11'),
(5, '', 2, 81000, 0, 'cash', 8, NULL, NULL, 1, '2021-05-21 07:09:08', '2021-05-21 07:09:08'),
(6, '$2y$10$L1jbu6eBIPTyNxo18JVw9u/cOVp6ZASMesNpbl/TQ/zCC5zxpPjsy', 2, 121000, 0, 'cash', 8, NULL, NULL, 1, '2021-05-21 07:15:47', '2021-05-21 07:15:47'),
(7, 'e7fb8dad923b5f4124cfeca97a3952a75788a383', 2, 193800, 0, 'cash', 8, 1, NULL, 1, '2021-05-21 07:23:04', '2021-05-22 02:42:31'),
(8, 'abef58e506f5d41d9fb97fa158d33fefecf97679', 2, 75900, 0, 'cash', 8, 1, NULL, 1, '2021-05-21 16:22:37', '2021-05-22 02:54:17'),
(9, '499cedd001acfd51b0ce795ac6bebe7d34c620bf', 1, 121000, 4, 'cash', 5, NULL, '2021-05-26', 0, '2021-05-22 02:56:56', '2021-05-23 06:41:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_name`, `product_price`, `quantity`, `subtotal`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 4, 'Đắc nhân tâm', 51000, 1, 51000, 0, '2021-05-21 04:13:11', '2021-05-21 04:13:11'),
(2, 4, 'Tiếng Việt 1 - Tập 1', 40000, 1, 40000, 0, '2021-05-21 04:13:11', '2021-05-21 04:13:11'),
(3, 5, 'Đắc nhân tâm', 51000, 1, 51000, 0, '2021-05-21 07:09:08', '2021-05-21 07:09:08'),
(4, 6, 'Đắc nhân tâm', 51000, 1, 51000, 0, '2021-05-21 07:15:47', '2021-05-21 07:15:47'),
(5, 6, 'Tiếng Việt 1 - Tập 1', 40000, 1, 40000, 0, '2021-05-21 07:15:47', '2021-05-21 07:15:47'),
(6, 7, 'Đắc nhân tâm', 51000, 2, 102000, 1, '2021-05-21 07:23:04', '2021-05-22 02:42:31'),
(7, 7, 'Tiếng Việt 1 - Tập 1', 40000, 2, 80000, 1, '2021-05-21 07:23:04', '2021-05-22 02:42:31'),
(8, 8, 'Đắc nhân tâm', 51000, 1, 51000, 1, '2021-05-21 16:22:37', '2021-05-22 02:54:17'),
(9, 9, 'Đắc nhân tâm', 51000, 1, 51000, 0, '2021-05-22 02:56:56', '2021-05-22 02:56:56'),
(10, 9, 'Tiếng Việt 1 - Tập 1', 40000, 1, 40000, 0, '2021-05-22 02:56:56', '2021-05-22 02:56:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qrcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` int(11) NOT NULL COMMENT 'Gía gốc',
  `product_sell` int(11) NOT NULL COMMENT 'Gía bán',
  `product_sale` int(11) DEFAULT NULL COMMENT 'Gía khuyến mãi',
  `product_quantity` int(11) NOT NULL DEFAULT 0 COMMENT 'Số lượng',
  `product_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_unit` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ĐVT',
  `category_id` int(11) NOT NULL COMMENT 'Danh mục',
  `category_detail_id` int(11) DEFAULT NULL COMMENT 'Thể loại',
  `author` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_id` int(11) DEFAULT NULL,
  `publishing_year` date DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_language` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_pages` int(11) DEFAULT NULL,
  `product_dimensions` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_weight` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_qrcode`, `product_price`, `product_sell`, `product_sale`, `product_quantity`, `product_description`, `product_unit`, `category_id`, `category_detail_id`, `author`, `publisher_id`, `publishing_year`, `thumbnail`, `thumbnail1`, `thumbnail2`, `thumbnail3`, `thumbnail4`, `thumbnail5`, `slug`, `product_language`, `product_pages`, `product_dimensions`, `product_weight`, `status`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 'Đắc nhân tâm', 'LQTAMCCXCGQE', 49000, 51000, NULL, 17, '<p>Đắc nh&acirc;n t&acirc;m, t&ecirc;n tiếng Anh l&agrave; How to Win Friends and Influence People l&agrave; một quyển s&aacute;ch nhằm tự gi&uacute;p bản th&acirc;n b&aacute;n chạy nhất từ trước đến nay. Quyển s&aacute;ch n&agrave;y do Dale Carnegie viết v&agrave; đ&atilde; được xuất bản lần đầu v&agrave;o năm 1936, n&oacute; đ&atilde; được b&aacute;n 15 triệu bản tr&ecirc;n khắp thế giới.</p>', 'Quyển', 4, 1, 'Dale Carnegie', 2, '1936-10-01', 'dac-nhan-tam.jpg', 'Sach-Dac-nhan-tam-4.jpg', 'dac-nhan-tam.jpg', NULL, NULL, NULL, 'dac-nhan-tam', 'Tiếng Việt', 320, '14.5 x 20.5 cm', '350 gr', 0, 0, '2021-05-13 04:16:01', '2021-05-27 10:49:04'),
(2, 'Tiếng Việt 1 - Tập 1', 'NTILMXGAFFHH', 49000, 51000, 40000, 16, '<p><em>Tiếng Việt</em>&nbsp;lớp&nbsp;<em>1</em>&nbsp;gồm hướng dẫn giải b&agrave;i tập từ s&aacute;ch&nbsp;<em>tiếng việt</em>&nbsp;lớp&nbsp;<em>1</em>&nbsp;tập&nbsp;<em>1</em>&nbsp;v&agrave; s&aacute;ch&nbsp;<em>tiếng việt</em>&nbsp;lớp&nbsp;<em>1</em>&nbsp;tập 2 nhằm gi&uacute;p c&aacute;c bạn học&nbsp;<em>tiếng việt</em>&nbsp;lớp&nbsp;<em>1</em>.</p>', 'Quyển', 1, 1, 'Hoàng Hòa Bình - Nguyễn Thị Ly Kha - Lê Hữu Tình', 2, NULL, 'Sach-giao-khoa-tieng-viet-lop-1-tap-1-2.jpg', 'Sach-lop-1-7180-1602419551.jpg', 'vietnam.png', 'vietnam.png', 'vietnam.png', 'vietnam.png', 'tieng-viet-1-tap-1', NULL, NULL, NULL, NULL, 0, 0, '2021-05-13 21:17:35', '2021-05-27 10:49:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion`
--

CREATE TABLE `promotion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promotion_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_discount` int(11) NOT NULL,
  `condition` int(11) NOT NULL DEFAULT 0 COMMENT 'Điều kiện để được hưởng voucher : số đơn hàng',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `promotion`
--

INSERT INTO `promotion` (`id`, `promotion_name`, `promotion_code`, `promotion_discount`, `condition`, `start_date`, `end_date`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 'Khuyến mãi tháng 5', 'kmt5', 10, 1, '2021-05-16', '2021-05-31', 0, '2021-05-16 13:29:28', '2021-05-22 12:11:04'),
(2, 'Siêu sale tháng 5', 'sale5', 50, 20, '2021-05-22', '2021-05-31', 0, '2021-05-22 05:43:07', '2021-05-22 05:43:07'),
(3, 'Siêu sale tháng 6', 'sale6', 40, 0, '2021-06-01', '2021-06-30', 1, '2021-05-22 05:44:28', '2021-05-22 06:09:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `publisher`
--

CREATE TABLE `publisher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_phone` bigint(20) DEFAULT NULL,
  `publisher_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_fax` bigint(20) DEFAULT NULL,
  `invalid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `publisher`
--

INSERT INTO `publisher` (`id`, `publisher_name`, `publisher_address`, `publisher_phone`, `publisher_email`, `publisher_fax`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 'Kim Đồng', '55 Quang Trung, Nguyễn Du, Hai Bà Trưng, Hà Nội', 2439434490, 'info@nxbkimdong.com.vn', 2438229085, '0', '2021-05-08 20:17:49', '2021-05-08 20:50:40'),
(2, 'Đại học Sư Phạm TP HCM', '280 An Dương Vương, Phường 4, Quận 5, Thành Phố Hồ Chí Minh', 2838352020, 'portalsupport@hcmue.edu.vn', 2838398946, '0', '2021-05-14 01:09:35', '2021-05-14 01:12:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `unit`
--

CREATE TABLE `unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_primary` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: đvt chính , 1: đvt phụ',
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `permission` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: admin , 1: nhân viên, 2: khách hàng',
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `email_verified_at`, `password`, `google_id`, `avatar`, `avatar_original`, `provider`, `provider_id`, `fullname`, `country`, `birthday`, `phone`, `permission`, `invalid`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'hieulev319@gmail.com', NULL, '$2y$10$bbjqdKUaYqXoFlO2DVumMeJCDKatMZDVVwQ9x1wxsn6zzfPzpx8hu', NULL, '1622101548-user.jpg', NULL, NULL, NULL, 'Lê Văn Hiếu', 'Việt Nam', '1999-01-03', 888537087, 0, 0, NULL, '2021-05-08 02:56:48', '2021-05-27 07:55:46'),
(2, 'offical VH', 'johcater55@gmail.com', NULL, NULL, '114542755857105722131', 'https://lh3.googleusercontent.com/a/AATXAJxW5RwcZWq40pwpG7a3pmKNMNW62e_EY9Vz1irj=s96-c', 'https://lh3.googleusercontent.com/a/AATXAJxW5RwcZWq40pwpG7a3pmKNMNW62e_EY9Vz1irj=s96-c', NULL, NULL, 'Lê Văn Hiếu', 'Việt Nam', '1999-01-03', 888537087, 2, 0, NULL, '2021-05-08 02:59:44', '2021-05-23 07:48:08'),
(3, 'hieule319', 'hieule@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lê Văn Hiếu', 'Việt Nam', '1999-01-03', 888537087, 1, 1, NULL, '2021-05-08 02:56:48', '2021-05-23 07:42:50'),
(4, 'gender', 'uyenvnh@ss4u.vn', NULL, '$2y$10$5/rRdzpXlWwPY75FTYpSs.UgoaeA7oEPwczncjyeL31zGBowf83qy', NULL, NULL, NULL, NULL, NULL, 'Hồ Ninh Hải Uyên', NULL, '2021-05-23', 888537087, 1, 0, NULL, '2021-05-23 07:19:04', '2021-05-23 07:19:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invalid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `invalid`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '2021-05-24 13:22:02', '2021-05-24 13:22:02'),
(2, 1, 2, 1, '2021-05-24 13:23:48', '2021-05-24 13:28:36'),
(3, 2, 1, 0, '2021-05-24 14:18:31', '2021-05-24 14:18:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Chỉ mục cho bảng `category_detail`
--
ALTER TABLE `category_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_detail_category_detail_name_unique` (`category_detail_name`),
  ADD KEY `category_detail_category_id_index` (`category_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_user_id_index` (`user_id`),
  ADD KEY `comment_product_id_index` (`product_id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_address_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_id_index` (`user_id`),
  ADD KEY `order_deliveryid_index` (`deliveryId`),
  ADD KEY `order_promotion_id_index` (`promotion_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_order_id_index` (`order_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `product_category_id_index` (`category_id`),
  ADD KEY `product_category_detail_id_index` (`category_detail_id`),
  ADD KEY `product_publisher_id_index` (`publisher_id`);

--
-- Chỉ mục cho bảng `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promotion_promotion_name_unique` (`promotion_name`),
  ADD UNIQUE KEY `promotion_promotion_code_unique` (`promotion_code`);

--
-- Chỉ mục cho bảng `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publisher_publisher_name_unique` (`publisher_name`),
  ADD UNIQUE KEY `publisher_publisher_email_unique` (`publisher_email`);

--
-- Chỉ mục cho bảng `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_product_id_index` (`product_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_user_id_index` (`user_id`),
  ADD KEY `wishlist_product_id_index` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `category_detail`
--
ALTER TABLE `category_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `unit`
--
ALTER TABLE `unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
