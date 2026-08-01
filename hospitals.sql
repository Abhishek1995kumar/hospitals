-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2026 at 11:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitals`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_os` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `ip_address`, `action`, `module`, `browser`, `device`, `url`, `method`, `user_os`, `request_data`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-23 22:43:26', '2026-07-23 22:43:26'),
(2, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-23 22:43:30', '2026-07-23 22:43:30'),
(3, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-24 07:12:54', '2026-07-24 07:12:54'),
(4, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-24 07:13:04', '2026-07-24 07:13:04'),
(5, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-24 07:13:07', '2026-07-24 07:13:07'),
(6, 1, '127.0.0.1', 'Vendor Created', 'Vendor', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/pharmacy/vendor/save', 'POST', 'Windows', '{\"hospital_id\":null,\"firm_id\":null,\"company_name\":\"Fatima Ltd\",\"name\":\"Jarifa Ahmed\",\"email\":\"jarifaahmed@gmail.com\",\"contact\":\"9856885545\",\"gst_no\":\"06BZAHM6385P6Z3\",\"pan_no\":\"ASDFG1234T\",\"doctor_name\":\"Akshay Komal\",\"doctor_address\":\"Kapoorthala\"}', '2026-07-24 07:35:45', '2026-07-24 07:35:45'),
(7, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-24 13:07:14', '2026-07-24 13:07:14'),
(8, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-25 01:22:43', '2026-07-25 01:22:43'),
(9, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 01:22:46', '2026-07-25 01:22:46'),
(10, 1, '127.0.0.1', '1', '1', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/logout', 'POST', 'Windows', '\"Logout\"', '2026-07-25 01:32:24', '2026-07-25 01:32:24'),
(11, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-25 02:04:49', '2026-07-25 02:04:49'),
(12, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 02:04:52', '2026-07-25 02:04:52'),
(13, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 02:57:21', '2026-07-25 02:57:21'),
(14, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 02:58:10', '2026-07-25 02:58:10'),
(15, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 02:58:12', '2026-07-25 02:58:12'),
(16, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 02:58:47', '2026-07-25 02:58:47'),
(17, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 02:58:51', '2026-07-25 02:58:51'),
(18, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 03:05:54', '2026-07-25 03:05:54'),
(19, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 03:05:55', '2026-07-25 03:05:55'),
(20, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-25 06:19:35', '2026-07-25 06:19:35'),
(21, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:19:38', '2026-07-25 06:19:38'),
(22, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:19:42', '2026-07-25 06:19:42'),
(23, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:19:43', '2026-07-25 06:19:43'),
(24, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:21:09', '2026-07-25 06:21:09'),
(25, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:21:10', '2026-07-25 06:21:10'),
(26, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:21:57', '2026-07-25 06:21:57'),
(27, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:21:58', '2026-07-25 06:21:58'),
(28, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:29:54', '2026-07-25 06:29:54'),
(29, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:29:55', '2026-07-25 06:29:55'),
(30, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:34:07', '2026-07-25 06:34:07'),
(31, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:34:08', '2026-07-25 06:34:08'),
(32, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:35:36', '2026-07-25 06:35:36'),
(33, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:35:37', '2026-07-25 06:35:37'),
(34, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
(35, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:35:52', '2026-07-25 06:35:52'),
(36, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:37:44', '2026-07-25 06:37:44'),
(37, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:37:44', '2026-07-25 06:37:44'),
(38, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:40:34', '2026-07-25 06:40:34'),
(39, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:40:38', '2026-07-25 06:40:38'),
(40, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:40:53', '2026-07-25 06:40:53'),
(41, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:40:54', '2026-07-25 06:40:54'),
(42, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:41:14', '2026-07-25 06:41:14'),
(43, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:41:15', '2026-07-25 06:41:15'),
(44, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:41:47', '2026-07-25 06:41:47'),
(45, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:41:50', '2026-07-25 06:41:50'),
(46, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:42:56', '2026-07-25 06:42:56'),
(47, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:42:57', '2026-07-25 06:42:57'),
(48, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:46:06', '2026-07-25 06:46:06'),
(49, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:46:08', '2026-07-25 06:46:08'),
(50, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:49:49', '2026-07-25 06:49:49'),
(51, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:49:52', '2026-07-25 06:49:52'),
(52, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:50:08', '2026-07-25 06:50:08'),
(53, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:50:11', '2026-07-25 06:50:11'),
(54, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:50:45', '2026-07-25 06:50:45'),
(55, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:50:46', '2026-07-25 06:50:46'),
(56, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:50:56', '2026-07-25 06:50:56'),
(57, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:50:58', '2026-07-25 06:50:58'),
(58, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:52:23', '2026-07-25 06:52:23'),
(59, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:52:25', '2026-07-25 06:52:25'),
(60, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:57:33', '2026-07-25 06:57:33'),
(61, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 06:57:35', '2026-07-25 06:57:35'),
(62, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:01:14', '2026-07-25 07:01:14'),
(63, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:01:16', '2026-07-25 07:01:16'),
(64, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:05:29', '2026-07-25 07:05:29'),
(65, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:05:32', '2026-07-25 07:05:32'),
(66, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:07:40', '2026-07-25 07:07:40'),
(67, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:07:41', '2026-07-25 07:07:41'),
(68, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:09:02', '2026-07-25 07:09:02'),
(69, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:10:10', '2026-07-25 07:10:10'),
(70, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:11:55', '2026-07-25 07:11:55'),
(71, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:11:57', '2026-07-25 07:11:57'),
(72, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:16:56', '2026-07-25 07:16:56'),
(73, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:16:58', '2026-07-25 07:16:58'),
(74, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:34:29', '2026-07-25 07:34:29'),
(75, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 07:34:30', '2026-07-25 07:34:30'),
(76, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 08:34:04', '2026-07-25 08:34:04'),
(77, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 08:34:05', '2026-07-25 08:34:05'),
(78, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 08:55:22', '2026-07-25 08:55:22'),
(79, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 08:55:23', '2026-07-25 08:55:23'),
(80, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 09:05:55', '2026-07-25 09:05:55'),
(81, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 09:05:56', '2026-07-25 09:05:56'),
(82, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 09:06:26', '2026-07-25 09:06:26'),
(83, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 09:06:27', '2026-07-25 09:06:27'),
(84, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 09:08:58', '2026-07-25 09:08:58'),
(85, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 09:09:00', '2026-07-25 09:09:00'),
(86, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-25 23:07:07', '2026-07-25 23:07:07'),
(87, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 23:07:10', '2026-07-25 23:07:10'),
(88, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 23:07:13', '2026-07-25 23:07:13'),
(89, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 23:07:14', '2026-07-25 23:07:14'),
(90, 1, '127.0.0.1', '1', '1', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/logout', 'POST', 'Windows', '\"Logout\"', '2026-07-25 23:07:29', '2026-07-25 23:07:29'),
(91, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-25 23:08:39', '2026-07-25 23:08:39'),
(92, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 23:08:42', '2026-07-25 23:08:42'),
(93, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 23:08:45', '2026-07-25 23:08:45'),
(94, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-25 23:08:47', '2026-07-25 23:08:47'),
(95, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:13:22', '2026-07-26 00:13:22'),
(96, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:13:26', '2026-07-26 00:13:26'),
(97, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:13:27', '2026-07-26 00:13:27'),
(98, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:13:51', '2026-07-26 00:13:51'),
(99, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:13:52', '2026-07-26 00:13:52'),
(100, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:15:42', '2026-07-26 00:15:42'),
(101, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:15:43', '2026-07-26 00:15:43'),
(102, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:16:04', '2026-07-26 00:16:04'),
(103, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:16:06', '2026-07-26 00:16:06'),
(104, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:16:21', '2026-07-26 00:16:21'),
(105, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:16:24', '2026-07-26 00:16:24'),
(106, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:36:19', '2026-07-26 00:36:19'),
(107, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 00:36:24', '2026-07-26 00:36:24'),
(108, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-26 03:07:21', '2026-07-26 03:07:21'),
(109, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 03:07:24', '2026-07-26 03:07:24'),
(110, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 03:07:28', '2026-07-26 03:07:28'),
(111, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 03:07:29', '2026-07-26 03:07:29'),
(112, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 03:07:41', '2026-07-26 03:07:41'),
(113, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 03:07:42', '2026-07-26 03:07:42'),
(114, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 04:17:47', '2026-07-26 04:17:47'),
(115, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 04:17:48', '2026-07-26 04:17:48'),
(116, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-26 09:15:01', '2026-07-26 09:15:01'),
(117, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:15:04', '2026-07-26 09:15:04'),
(118, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:15:09', '2026-07-26 09:15:09'),
(119, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:15:24', '2026-07-26 09:15:24'),
(120, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:16:11', '2026-07-26 09:16:11'),
(121, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:16:19', '2026-07-26 09:16:19'),
(122, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:16:29', '2026-07-26 09:16:29'),
(123, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:16:30', '2026-07-26 09:16:30'),
(124, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:28:09', '2026-07-26 09:28:09'),
(125, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:28:14', '2026-07-26 09:28:14'),
(126, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:29:45', '2026-07-26 09:29:45'),
(127, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:30:21', '2026-07-26 09:30:21'),
(128, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:30:36', '2026-07-26 09:30:36'),
(129, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:30:37', '2026-07-26 09:30:37'),
(130, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:32:26', '2026-07-26 09:32:26'),
(131, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:32:27', '2026-07-26 09:32:27'),
(132, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:41:41', '2026-07-26 09:41:41'),
(133, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:41:45', '2026-07-26 09:41:45'),
(134, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:42:38', '2026-07-26 09:42:38'),
(135, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:42:39', '2026-07-26 09:42:39'),
(136, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:43:25', '2026-07-26 09:43:25'),
(137, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 09:43:28', '2026-07-26 09:43:28'),
(138, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-26 22:40:28', '2026-07-26 22:40:28'),
(139, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 22:40:32', '2026-07-26 22:40:32'),
(140, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 22:40:35', '2026-07-26 22:40:35'),
(141, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 22:40:42', '2026-07-26 22:40:42'),
(142, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 22:41:01', '2026-07-26 22:41:01'),
(143, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 22:41:02', '2026-07-26 22:41:02'),
(144, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 22:44:19', '2026-07-26 22:44:19'),
(145, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 22:44:20', '2026-07-26 22:44:20'),
(146, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:48:24', '2026-07-26 23:48:24'),
(147, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:48:25', '2026-07-26 23:48:25'),
(148, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:57:13', '2026-07-26 23:57:13'),
(149, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:57:14', '2026-07-26 23:57:14'),
(150, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:58:30', '2026-07-26 23:58:30'),
(151, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:58:31', '2026-07-26 23:58:31'),
(152, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:59:26', '2026-07-26 23:59:26'),
(153, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-26 23:59:27', '2026-07-26 23:59:27'),
(154, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 00:40:27', '2026-07-27 00:40:27'),
(155, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 00:40:28', '2026-07-27 00:40:28'),
(156, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 00:41:43', '2026-07-27 00:41:43'),
(157, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 00:41:44', '2026-07-27 00:41:44'),
(158, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:02:56', '2026-07-27 01:02:56'),
(159, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:02:57', '2026-07-27 01:02:57'),
(160, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:03:48', '2026-07-27 01:03:48'),
(161, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:03:49', '2026-07-27 01:03:49'),
(162, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:05:10', '2026-07-27 01:05:10'),
(163, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:05:11', '2026-07-27 01:05:11'),
(164, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:16:02', '2026-07-27 01:16:02'),
(165, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:16:03', '2026-07-27 01:16:03'),
(166, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:18:06', '2026-07-27 01:18:06'),
(167, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:18:07', '2026-07-27 01:18:07'),
(168, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:21:27', '2026-07-27 01:21:27'),
(169, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:21:28', '2026-07-27 01:21:28'),
(170, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:32:02', '2026-07-27 01:32:02'),
(171, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:32:03', '2026-07-27 01:32:03'),
(172, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-27 01:47:58', '2026-07-27 01:47:58'),
(173, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:48:01', '2026-07-27 01:48:01'),
(174, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:48:02', '2026-07-27 01:48:02'),
(175, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:48:14', '2026-07-27 01:48:14'),
(176, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:50:48', '2026-07-27 01:50:48'),
(177, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:50:50', '2026-07-27 01:50:50'),
(178, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:50:51', '2026-07-27 01:50:51'),
(179, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:51:27', '2026-07-27 01:51:27'),
(180, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:51:29', '2026-07-27 01:51:29'),
(181, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:51:30', '2026-07-27 01:51:30'),
(182, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:51:37', '2026-07-27 01:51:37'),
(183, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:51:38', '2026-07-27 01:51:38'),
(184, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:53:05', '2026-07-27 01:53:05'),
(185, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:53:06', '2026-07-27 01:53:06'),
(186, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:53:37', '2026-07-27 01:53:37'),
(187, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 01:53:42', '2026-07-27 01:53:42'),
(188, 2, '127.0.0.1', '2', '2', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/logout', 'POST', 'Windows', '\"Logout\"', '2026-07-27 01:59:35', '2026-07-27 01:59:35'),
(189, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-27 02:00:15', '2026-07-27 02:00:15'),
(190, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:00:18', '2026-07-27 02:00:18'),
(191, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:00:22', '2026-07-27 02:00:22'),
(192, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:00:23', '2026-07-27 02:00:23'),
(193, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:00:32', '2026-07-27 02:00:32'),
(194, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:00:35', '2026-07-27 02:00:35'),
(195, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:28:47', '2026-07-27 02:28:47'),
(196, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:28:48', '2026-07-27 02:28:48'),
(197, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:33:13', '2026-07-27 02:33:13'),
(198, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:33:18', '2026-07-27 02:33:18'),
(199, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:38:43', '2026-07-27 02:38:43'),
(200, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:38:44', '2026-07-27 02:38:44'),
(201, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:49:42', '2026-07-27 02:49:42'),
(202, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:49:48', '2026-07-27 02:49:48'),
(203, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:50:32', '2026-07-27 02:50:32'),
(204, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:50:33', '2026-07-27 02:50:33'),
(205, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:50:44', '2026-07-27 02:50:44'),
(206, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:50:46', '2026-07-27 02:50:46'),
(207, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:51:45', '2026-07-27 02:51:45'),
(208, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:51:47', '2026-07-27 02:51:47'),
(209, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:52:31', '2026-07-27 02:52:31'),
(210, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:52:32', '2026-07-27 02:52:32'),
(211, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:52:42', '2026-07-27 02:52:42'),
(212, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 02:52:43', '2026-07-27 02:52:43'),
(213, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 03:44:11', '2026-07-27 03:44:11'),
(214, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 03:44:12', '2026-07-27 03:44:12'),
(215, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:36:45', '2026-07-27 04:36:45'),
(216, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:36:47', '2026-07-27 04:36:47'),
(217, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:37:49', '2026-07-27 04:37:49'),
(218, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:37:51', '2026-07-27 04:37:51'),
(219, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:50:53', '2026-07-27 04:50:53'),
(220, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:50:54', '2026-07-27 04:50:54'),
(221, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:52:26', '2026-07-27 04:52:26'),
(222, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:52:27', '2026-07-27 04:52:27'),
(223, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:53:10', '2026-07-27 04:53:10'),
(224, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 04:53:11', '2026-07-27 04:53:11'),
(225, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 05:12:29', '2026-07-27 05:12:29'),
(226, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 05:12:30', '2026-07-27 05:12:30'),
(227, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 05:12:47', '2026-07-27 05:12:47'),
(228, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 05:12:48', '2026-07-27 05:12:48'),
(229, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 05:17:29', '2026-07-27 05:17:29'),
(230, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 05:17:30', '2026-07-27 05:17:30'),
(231, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-27 07:51:22', '2026-07-27 07:51:22'),
(232, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 07:51:25', '2026-07-27 07:51:25'),
(233, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 07:51:31', '2026-07-27 07:51:31'),
(234, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 07:51:33', '2026-07-27 07:51:33'),
(235, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 07:51:42', '2026-07-27 07:51:42'),
(236, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 07:51:43', '2026-07-27 07:51:43'),
(237, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 08:22:20', '2026-07-27 08:22:20'),
(238, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 08:22:21', '2026-07-27 08:22:21'),
(239, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 08:35:03', '2026-07-27 08:35:03'),
(240, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 08:35:05', '2026-07-27 08:35:05'),
(241, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 08:57:58', '2026-07-27 08:57:58'),
(242, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 08:58:01', '2026-07-27 08:58:01'),
(243, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-27 09:01:37', '2026-07-27 09:01:37'),
(244, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 09:01:40', '2026-07-27 09:01:40'),
(245, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 09:01:41', '2026-07-27 09:01:41'),
(246, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 09:01:43', '2026-07-27 09:01:43'),
(247, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 09:01:53', '2026-07-27 09:01:53'),
(248, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 09:01:54', '2026-07-27 09:01:54'),
(249, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:13:56', '2026-07-27 11:13:56'),
(250, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:13:58', '2026-07-27 11:13:58'),
(251, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:18:42', '2026-07-27 11:18:42'),
(252, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:18:44', '2026-07-27 11:18:44'),
(253, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-27 11:37:35', '2026-07-27 11:37:35'),
(254, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:37:39', '2026-07-27 11:37:39'),
(255, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:37:41', '2026-07-27 11:37:41'),
(256, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:37:42', '2026-07-27 11:37:42'),
(257, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:37:50', '2026-07-27 11:37:50'),
(258, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:37:52', '2026-07-27 11:37:52'),
(259, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:38:54', '2026-07-27 11:38:54'),
(260, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:38:56', '2026-07-27 11:38:56'),
(261, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:39:08', '2026-07-27 11:39:08'),
(262, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:39:10', '2026-07-27 11:39:10'),
(263, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:44:13', '2026-07-27 11:44:13'),
(264, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:44:15', '2026-07-27 11:44:15'),
(265, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:44:48', '2026-07-27 11:44:48');
INSERT INTO `audit_logs` (`id`, `user_id`, `ip_address`, `action`, `module`, `browser`, `device`, `url`, `method`, `user_os`, `request_data`, `created_at`, `updated_at`) VALUES
(266, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:44:50', '2026-07-27 11:44:50'),
(267, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:45:45', '2026-07-27 11:45:45'),
(268, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:45:46', '2026-07-27 11:45:46'),
(269, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:51:14', '2026-07-27 11:51:14'),
(270, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 11:51:15', '2026-07-27 11:51:15'),
(271, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 12:59:56', '2026-07-27 12:59:56'),
(272, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 12:59:57', '2026-07-27 12:59:57'),
(273, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 13:01:41', '2026-07-27 13:01:41'),
(274, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 13:01:43', '2026-07-27 13:01:43'),
(275, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 13:01:48', '2026-07-27 13:01:48'),
(276, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 13:01:49', '2026-07-27 13:01:49'),
(277, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-27 23:33:39', '2026-07-27 23:33:39'),
(278, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 23:33:43', '2026-07-27 23:33:43'),
(279, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 23:33:46', '2026-07-27 23:33:46'),
(280, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-27 23:33:48', '2026-07-27 23:33:48'),
(281, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-28 00:13:38', '2026-07-28 00:13:38'),
(282, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-28 00:13:48', '2026-07-28 00:13:48'),
(283, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-28 00:13:49', '2026-07-28 00:13:49'),
(284, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-28 00:53:32', '2026-07-28 00:53:32'),
(285, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-28 00:53:33', '2026-07-28 00:53:33'),
(286, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-28 01:28:34', '2026-07-28 01:28:34'),
(287, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-28 01:29:13', '2026-07-28 01:29:13'),
(288, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-28 01:31:59', '2026-07-28 01:31:59'),
(289, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-28 01:45:47', '2026-07-28 01:45:47'),
(290, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-28 01:48:06', '2026-07-28 01:48:06'),
(291, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-28 01:48:09', '2026-07-28 01:48:09'),
(292, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-29 00:45:24', '2026-07-29 00:45:24'),
(293, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:45:28', '2026-07-29 00:45:28'),
(294, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:47:03', '2026-07-29 00:47:03'),
(295, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:48:40', '2026-07-29 00:48:40'),
(296, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:48:44', '2026-07-29 00:48:44'),
(297, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:48:47', '2026-07-29 00:48:47'),
(298, 1, '127.0.0.1', '1', '1', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/logout', 'POST', 'Windows', '\"Logout\"', '2026-07-29 00:48:49', '2026-07-29 00:48:49'),
(299, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-29 00:49:13', '2026-07-29 00:49:13'),
(300, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:49:16', '2026-07-29 00:49:16'),
(301, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:49:20', '2026-07-29 00:49:20'),
(302, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:49:21', '2026-07-29 00:49:21'),
(303, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:53:29', '2026-07-29 00:53:29'),
(304, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 00:53:29', '2026-07-29 00:53:29'),
(305, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 01:40:08', '2026-07-29 01:40:08'),
(306, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 01:40:09', '2026-07-29 01:40:09'),
(307, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 01:50:12', '2026-07-29 01:50:12'),
(308, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 01:50:14', '2026-07-29 01:50:14'),
(309, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 02:47:00', '2026-07-29 02:47:00'),
(310, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 02:47:02', '2026-07-29 02:47:02'),
(311, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 02:49:06', '2026-07-29 02:49:06'),
(312, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 02:49:08', '2026-07-29 02:49:08'),
(313, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:03:42', '2026-07-29 03:03:42'),
(314, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:03:44', '2026-07-29 03:03:44'),
(315, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:05:48', '2026-07-29 03:05:48'),
(316, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:05:52', '2026-07-29 03:05:52'),
(317, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:09:27', '2026-07-29 03:09:27'),
(318, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:09:31', '2026-07-29 03:09:31'),
(319, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:11:55', '2026-07-29 03:11:55'),
(320, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:11:59', '2026-07-29 03:11:59'),
(321, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:16:35', '2026-07-29 03:16:35'),
(322, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:16:39', '2026-07-29 03:16:39'),
(323, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:23:14', '2026-07-29 03:23:14'),
(324, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:23:16', '2026-07-29 03:23:16'),
(325, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:24:55', '2026-07-29 03:24:55'),
(326, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:25:00', '2026-07-29 03:25:00'),
(327, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:29:31', '2026-07-29 03:29:31'),
(328, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 03:29:36', '2026-07-29 03:29:36'),
(329, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-29 09:59:38', '2026-07-29 09:59:38'),
(330, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 09:59:41', '2026-07-29 09:59:41'),
(331, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 09:59:47', '2026-07-29 09:59:47'),
(332, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 09:59:48', '2026-07-29 09:59:48'),
(333, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:00:22', '2026-07-29 10:00:22'),
(334, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:00:25', '2026-07-29 10:00:25'),
(335, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:04:53', '2026-07-29 10:04:53'),
(336, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:04:55', '2026-07-29 10:04:55'),
(337, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:06:03', '2026-07-29 10:06:03'),
(338, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:06:05', '2026-07-29 10:06:05'),
(339, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:12:06', '2026-07-29 10:12:06'),
(340, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:12:08', '2026-07-29 10:12:08'),
(341, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:18:55', '2026-07-29 10:18:55'),
(342, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:18:56', '2026-07-29 10:18:56'),
(343, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:19:55', '2026-07-29 10:19:55'),
(344, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:19:59', '2026-07-29 10:19:59'),
(345, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:21:21', '2026-07-29 10:21:21'),
(346, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:21:24', '2026-07-29 10:21:24'),
(347, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:22:34', '2026-07-29 10:22:34'),
(348, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:22:36', '2026-07-29 10:22:36'),
(349, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:24:31', '2026-07-29 10:24:31'),
(350, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:24:33', '2026-07-29 10:24:33'),
(351, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:31:47', '2026-07-29 10:31:47'),
(352, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:31:53', '2026-07-29 10:31:53'),
(353, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:32:33', '2026-07-29 10:32:33'),
(354, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:32:38', '2026-07-29 10:32:38'),
(355, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:38:04', '2026-07-29 10:38:04'),
(356, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:38:09', '2026-07-29 10:38:09'),
(357, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:43:02', '2026-07-29 10:43:02'),
(358, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:43:04', '2026-07-29 10:43:04'),
(359, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:43:53', '2026-07-29 10:43:53'),
(360, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:43:55', '2026-07-29 10:43:55'),
(361, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:44:13', '2026-07-29 10:44:13'),
(362, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:44:19', '2026-07-29 10:44:19'),
(363, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:44:33', '2026-07-29 10:44:33'),
(364, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:44:37', '2026-07-29 10:44:37'),
(365, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:45:11', '2026-07-29 10:45:11'),
(366, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:45:16', '2026-07-29 10:45:16'),
(367, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:49:08', '2026-07-29 10:49:08'),
(368, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:49:13', '2026-07-29 10:49:13'),
(369, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:49:47', '2026-07-29 10:49:47'),
(370, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:49:53', '2026-07-29 10:49:53'),
(371, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:50:40', '2026-07-29 10:50:40'),
(372, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:50:46', '2026-07-29 10:50:46'),
(373, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:51:11', '2026-07-29 10:51:11'),
(374, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:51:13', '2026-07-29 10:51:13'),
(375, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:52:28', '2026-07-29 10:52:28'),
(376, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:52:32', '2026-07-29 10:52:32'),
(377, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:52:56', '2026-07-29 10:52:56'),
(378, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:53:03', '2026-07-29 10:53:03'),
(379, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:53:36', '2026-07-29 10:53:36'),
(380, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:53:37', '2026-07-29 10:53:37'),
(381, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:56:05', '2026-07-29 10:56:05'),
(382, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:56:12', '2026-07-29 10:56:12'),
(383, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:56:19', '2026-07-29 10:56:19'),
(384, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 10:56:23', '2026-07-29 10:56:23'),
(385, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:09:39', '2026-07-29 11:09:39'),
(386, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:09:45', '2026-07-29 11:09:45'),
(387, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:10:30', '2026-07-29 11:10:30'),
(388, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:10:36', '2026-07-29 11:10:36'),
(389, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:14:12', '2026-07-29 11:14:12'),
(390, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:14:16', '2026-07-29 11:14:16'),
(391, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:15:52', '2026-07-29 11:15:52'),
(392, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:15:57', '2026-07-29 11:15:57'),
(393, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:16:49', '2026-07-29 11:16:49'),
(394, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:16:51', '2026-07-29 11:16:51'),
(395, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:17:10', '2026-07-29 11:17:10'),
(396, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:17:12', '2026-07-29 11:17:12'),
(397, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:25:02', '2026-07-29 11:25:02'),
(398, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:25:06', '2026-07-29 11:25:06'),
(399, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:29:00', '2026-07-29 11:29:00'),
(400, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:29:02', '2026-07-29 11:29:02'),
(401, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:33:04', '2026-07-29 11:33:04'),
(402, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:33:08', '2026-07-29 11:33:08'),
(403, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:41:30', '2026-07-29 11:41:30'),
(404, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:41:31', '2026-07-29 11:41:31'),
(405, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:41:38', '2026-07-29 11:41:38'),
(406, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:41:39', '2026-07-29 11:41:39'),
(407, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:51:26', '2026-07-29 11:51:26'),
(408, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:51:27', '2026-07-29 11:51:27'),
(409, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:52:36', '2026-07-29 11:52:36'),
(410, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:52:37', '2026-07-29 11:52:37'),
(411, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:55:33', '2026-07-29 11:55:33'),
(412, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:55:34', '2026-07-29 11:55:34'),
(413, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:56:44', '2026-07-29 11:56:44'),
(414, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 11:56:46', '2026-07-29 11:56:46'),
(415, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-29 22:38:20', '2026-07-29 22:38:20'),
(416, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:38:23', '2026-07-29 22:38:23'),
(417, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:38:26', '2026-07-29 22:38:26'),
(418, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:38:27', '2026-07-29 22:38:27'),
(419, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:48:11', '2026-07-29 22:48:11'),
(420, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:48:16', '2026-07-29 22:48:16'),
(421, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:48:19', '2026-07-29 22:48:19'),
(422, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:48:21', '2026-07-29 22:48:21'),
(423, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:48:24', '2026-07-29 22:48:24'),
(424, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:48:24', '2026-07-29 22:48:24'),
(425, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:54:16', '2026-07-29 22:54:16'),
(426, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:54:23', '2026-07-29 22:54:23'),
(427, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:57:16', '2026-07-29 22:57:16'),
(428, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:57:17', '2026-07-29 22:57:17'),
(429, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:58:03', '2026-07-29 22:58:03'),
(430, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:58:04', '2026-07-29 22:58:04'),
(431, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:58:53', '2026-07-29 22:58:53'),
(432, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:58:55', '2026-07-29 22:58:55'),
(433, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:59:02', '2026-07-29 22:59:02'),
(434, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 22:59:04', '2026-07-29 22:59:04'),
(435, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:03:51', '2026-07-29 23:03:51'),
(436, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:03:55', '2026-07-29 23:03:55'),
(437, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:06:37', '2026-07-29 23:06:37'),
(438, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:06:39', '2026-07-29 23:06:39'),
(439, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:06:44', '2026-07-29 23:06:44'),
(440, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:06:45', '2026-07-29 23:06:45'),
(441, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:06:57', '2026-07-29 23:06:57'),
(442, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:06:58', '2026-07-29 23:06:58'),
(443, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:21:28', '2026-07-29 23:21:28'),
(444, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:21:29', '2026-07-29 23:21:29'),
(445, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:21:30', '2026-07-29 23:21:30'),
(446, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:21:33', '2026-07-29 23:21:33'),
(447, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:26:34', '2026-07-29 23:26:34'),
(448, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:26:38', '2026-07-29 23:26:38'),
(449, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:27:06', '2026-07-29 23:27:06'),
(450, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:27:08', '2026-07-29 23:27:08'),
(451, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:31:58', '2026-07-29 23:31:58'),
(452, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:32:00', '2026-07-29 23:32:00'),
(453, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:32:26', '2026-07-29 23:32:26'),
(454, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:32:28', '2026-07-29 23:32:28'),
(455, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:39:50', '2026-07-29 23:39:50'),
(456, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:39:53', '2026-07-29 23:39:53'),
(457, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:39:54', '2026-07-29 23:39:54'),
(458, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:39:54', '2026-07-29 23:39:54'),
(459, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:39:55', '2026-07-29 23:39:55'),
(460, 2, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"admin@hms.in\"}', '2026-07-29 23:41:39', '2026-07-29 23:41:39'),
(461, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:41:41', '2026-07-29 23:41:41'),
(462, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:41:43', '2026-07-29 23:41:43'),
(463, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:41:45', '2026-07-29 23:41:45'),
(464, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:41:56', '2026-07-29 23:41:56'),
(465, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:41:57', '2026-07-29 23:41:57'),
(466, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:52:48', '2026-07-29 23:52:48'),
(467, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:52:50', '2026-07-29 23:52:50'),
(468, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:57:28', '2026-07-29 23:57:28'),
(469, 2, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-29 23:57:29', '2026-07-29 23:57:29'),
(470, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-30 09:28:43', '2026-07-30 09:28:43'),
(471, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:28:46', '2026-07-30 09:28:46'),
(472, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:28:51', '2026-07-30 09:28:51'),
(473, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:28:55', '2026-07-30 09:28:55'),
(474, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:32:18', '2026-07-30 09:32:18'),
(475, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:32:19', '2026-07-30 09:32:19'),
(476, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:40:56', '2026-07-30 09:40:56'),
(477, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:41:00', '2026-07-30 09:41:00'),
(478, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:41:40', '2026-07-30 09:41:40'),
(479, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 09:41:40', '2026-07-30 09:41:40'),
(480, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 10:54:30', '2026-07-30 10:54:30'),
(481, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 10:54:33', '2026-07-30 10:54:33'),
(482, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 11:03:13', '2026-07-30 11:03:13'),
(483, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 11:03:14', '2026-07-30 11:03:14'),
(484, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 11:12:24', '2026-07-30 11:12:24'),
(485, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 11:13:58', '2026-07-30 11:13:58'),
(486, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 11:34:27', '2026-07-30 11:34:27'),
(487, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-30 11:34:29', '2026-07-30 11:34:29'),
(488, 1, '127.0.0.1', 'User Login', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/auth', 'POST', 'Windows', '{\"login\":\"superadmin@hms.in\"}', '2026-07-31 10:23:07', '2026-07-31 10:23:07'),
(489, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:23:11', '2026-07-31 10:23:11'),
(490, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:23:14', '2026-07-31 10:23:14'),
(491, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:23:16', '2026-07-31 10:23:16'),
(492, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:23:54', '2026-07-31 10:23:54'),
(493, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:23:55', '2026-07-31 10:23:55'),
(494, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:24:06', '2026-07-31 10:24:06'),
(495, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:24:08', '2026-07-31 10:24:08'),
(496, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:40:10', '2026-07-31 10:40:10'),
(497, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:40:13', '2026-07-31 10:40:13'),
(498, 1, '127.0.0.1', 'User Dashboard', 'User', 'Google Chrome', 'Desktop', 'http://127.0.0.1:8000/admin/dashboard', 'GET', 'Windows', '[]', '2026-07-31 10:40:52', '2026-07-31 10:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cite_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'state_code means LKO, KNP',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `cite_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lucknow', NULL, NULL, NULL),
(2, 1, 'Kanpur', NULL, NULL, NULL),
(3, 1, 'Noida', NULL, NULL, NULL),
(4, 2, 'Mumbai', NULL, NULL, NULL),
(5, 2, 'Thane', NULL, NULL, NULL),
(6, 2, 'Pune', NULL, NULL, NULL),
(7, 2, 'Nasik', NULL, NULL, NULL),
(8, 3, 'Darbhanga', NULL, NULL, NULL),
(9, 3, 'Patna', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'code means IND, USA',
  `phone_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'phone code means +91, +1',
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'symbol means ₹, $',
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'region means Asia, Europe',
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'capital means New Delhi, Washington DC',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country_code`, `phone_code`, `currency_symbol`, `region`, `capital`, `created_at`, `updated_at`) VALUES
(1, 'India', 'IND', '+91', '₹', 'Asia', 'New Delhi', NULL, NULL),
(2, 'United States Of America', 'US', '+1', '$', 'North America', 'Washington DC', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_mobile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_hospitals` int NOT NULL DEFAULT '1',
  `max_users` int NOT NULL DEFAULT '50',
  `max_firms` int NOT NULL DEFAULT '1',
  `current_plan_id` bigint UNSIGNED DEFAULT NULL,
  `is_trial` tinyint(1) DEFAULT NULL,
  `trial_end_date` date DEFAULT NULL,
  `subscription_status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active, 2=Expired, 3=Suspended',
  `subscription_start_date` date DEFAULT NULL,
  `subscription_end_date` date DEFAULT NULL,
  `last_payment_date` date DEFAULT NULL,
  `next_billing_date` date DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` int DEFAULT NULL,
  `state` int DEFAULT NULL,
  `country` int DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` json DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `customer_name`, `customer_slug`, `email`, `mobile_no`, `alternate_mobile`, `website`, `max_hospitals`, `max_users`, `max_firms`, `current_plan_id`, `is_trial`, `trial_end_date`, `subscription_status`, `subscription_start_date`, `subscription_end_date`, `last_payment_date`, `next_billing_date`, `logo`, `address`, `city`, `state`, `country`, `postal_code`, `details`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'C_822384', 'Sadaf Fatima', 'sadaf_fatima', 'aUViT3FHYVRNelhwNjN2VEVIM0k5ZmhkY2s2Q3B5d0pkR25JREh5UE9udz0=', 'elF1aEZ0WlVTekR1TW1FU3gzNVc4dz09', 'dHM4RzZZSlF1YVl1bXFIcWZ3WEhsUT09', 'http://www.sadaf22.com', 1, 10, 1, 1, 1, '2026-07-31', 1, '2026-07-21', '2026-07-31', '2026-07-21', '2026-08-01', NULL, 'Kapoorthala', 3, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-07-21 10:04:50', '2026-07-21 10:04:51', NULL),
(4, 'C_564786', 'Sakina Begam', 'sakina_begam', 'ckdJdjlPSlFMUFkxY2drZnh6cm1rdU93YkdIQXpXeVhZMnZkZHhlODRjaz0=', 'eVA2eTF0VmhJWVNsS1ZaYjdheVJlQT09', 'eE5PblEySjAwVTZCbVIxTEIrYjhJUT09', 'http://www.sakina22.com', 1, 10, 1, 1, 1, '2026-07-31', 1, '2026-07-21', '2026-07-27', '2026-07-21', '2026-08-01', NULL, 'Kapoorthala', 2, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-07-21 10:19:45', '2026-07-21 10:19:46', NULL),
(6, 'C_702211', 'Tehshin Bano', 'tehshin_bano', 'ZW1USWZGUWVzbHdvUHZGMk1ZMWR2dVZ2VXhXWXV5a3VnRnNiMklhS0NGdz0=', 'YnZEYnNVeTlJeDVvRStoZTFUWEFIUT09', 'WXVKdlhkdjRmckhyKzdTWWhBazd1dz09', 'http://www.tehshin.com', 1, 10, 1, 1, 1, '2026-07-31', 1, '2026-07-21', '2026-07-28', '2026-07-21', '2026-08-01', NULL, 'Kapoorthala', 3, 1, 1, NULL, NULL, 1, NULL, NULL, '2026-07-21 10:34:11', '2026-07-21 10:34:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_subscriptions`
--

CREATE TABLE `customer_subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `plan_id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `payment_gateway` tinyint NOT NULL COMMENT '1=Razorpay, 2=Stripe, 3=Cash, 4=Bank Transfer, 5=Mango Pay',
  `payment_status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Success, 2=Pending, 3=Failed',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Current, 0=History',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_subscriptions`
--

INSERT INTO `customer_subscriptions` (`id`, `customer_id`, `plan_id`, `invoice_no`, `transaction_id`, `amount`, `start_date`, `end_date`, `payment_gateway`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'INV-202607214647870', 'CASH-202607215550807', 0.00, '2026-07-21', '2026-07-28', 3, 1, 1, '2026-07-21 10:04:51', '2026-07-21 10:04:51'),
(2, 4, 1, 'INV-202607217136083', 'CASH-202607214732165', 0.00, '2026-07-21', '2026-07-28', 3, 1, 1, '2026-07-21 10:19:46', '2026-07-21 10:19:46'),
(3, 6, 1, 'INV-202607216900284', 'CASH-202607213360543', 0.00, '2026-07-21', '2026-07-28', 3, 1, 1, '2026-07-21 10:34:12', '2026-07-21 10:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int DEFAULT NULL,
  `firm_id` int DEFAULT NULL,
  `hospital_id` int DEFAULT NULL,
  `department_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `customer_id`, `firm_id`, `hospital_id`, `department_id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, 'D_5623', 'Administrator', 'Super Admin department', 1, '2026-07-22 16:54:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint UNSIGNED NOT NULL,
  `module_id` bigint DEFAULT NULL COMMENT 'id getting from modules table',
  `feature_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_plans`
--

CREATE TABLE `feature_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `plan_id` bigint UNSIGNED NOT NULL,
  `feature_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_plans`
--

INSERT INTO `feature_plans` (`id`, `plan_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-07-16 01:29:27', NULL),
(2, 1, 2, '2026-07-16 01:29:27', NULL),
(3, 1, 3, '2026-07-16 01:29:27', NULL),
(4, 1, 4, '2026-07-16 01:29:27', NULL),
(5, 1, 5, '2026-07-16 01:29:27', NULL),
(6, 1, 6, '2026-07-16 01:29:27', NULL),
(7, 1, 7, '2026-07-16 01:29:27', NULL),
(8, 1, 8, '2026-07-16 01:29:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

CREATE TABLE `firms` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int DEFAULT NULL,
  `hospital_id` int NOT NULL,
  `firm_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `hospital_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_expiry_date` date DEFAULT NULL,
  `total_beds` int NOT NULL DEFAULT '0',
  `total_icu_beds` int NOT NULL DEFAULT '0',
  `total_operation_theatres` int NOT NULL DEFAULT '0',
  `total_ambulances` int NOT NULL DEFAULT '0',
  `total_wards` int NOT NULL DEFAULT '0',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `is_24x7` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `has_emergency` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `has_icu` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `has_pharmacy` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `has_blood_bank` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `has_lab` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `has_ambulance` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=No, 1=Yes',
  `is_hospital_clinic` tinyint NOT NULL DEFAULT '1' COMMENT '1=Hospital, 2=Clinic',
  `hospital_type` tinyint NOT NULL DEFAULT '1' COMMENT '1=General, 2=Speciality, 3=Multi Speciality, 4=Clinic, 5=Diagnostic Center',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `customer_id`, `hospital_id`, `name`, `email`, `phone`, `address`, `contact_person_name`, `contact_person_mobile`, `contact_person_email`, `registration_no`, `license_no`, `license_expiry_date`, `total_beds`, `total_icu_beds`, `total_operation_theatres`, `total_ambulances`, `total_wards`, `logo`, `favicon`, `opening_time`, `closing_time`, `is_24x7`, `has_emergency`, `has_icu`, `has_pharmacy`, `has_blood_bank`, `has_lab`, `has_ambulance`, `is_hospital_clinic`, `hospital_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'H_814604', 'Sadaf', 'ZW1USWZGUWVzbHdvUHZGMk1ZMWR2dVZ2VXhXWXV5a3VnRnNiMklhS0NGdz0=', 'WXVKdlhkdjRmckhyKzdTWWhBazd1dz09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 07:43:13', '2026-07-21 07:43:13', NULL),
(2, 1, 'H_824057', 'Sadaf', 'ZW1USWZGUWVzbHdvUHZGMk1ZMWR2dVZ2VXhXWXV5a3VnRnNiMklhS0NGdz0=', 'WXVKdlhkdjRmckhyKzdTWWhBazd1dz09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 07:45:09', '2026-07-21 07:45:09', NULL),
(3, 1, 'H_352201', 'Sadaf', 'ZW1USWZGUWVzbHdvUHZGMk1ZMWR2dVZ2VXhXWXV5a3VnRnNiMklhS0NGdz0=', 'WXVKdlhkdjRmckhyKzdTWWhBazd1dz09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 07:46:27', '2026-07-21 07:46:27', NULL),
(4, 2, 'H_841617', 'Sakina', 'ckdJdjlPSlFMUFkxY2drZnh6cm1rdU93YkdIQXpXeVhZMnZkZHhlODRjaz0=', 'eE1iMUErOVYvSjNCdlNMNzh3eFhIdz09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 2, 1, 1, '2026-07-21 07:49:47', '2026-07-21 07:49:47', NULL),
(5, 1, 'H_140017', 'Sadaf', 'ZW1USWZGUWVzbHdvUHZGMk1ZMWR2dVZ2VXhXWXV5a3VnRnNiMklhS0NGdz0=', 'elF1aEZ0WlVTekR1TW1FU3gzNVc4dz09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 09:57:53', '2026-07-21 09:57:53', NULL),
(6, 2, 'H_580091', 'Sadaf', 'ZW1USWZGUWVzbHdvUHZGMk1ZMWR2dVZ2VXhXWXV5a3VnRnNiMklhS0NGdz0=', 'elF1aEZ0WlVTekR1TW1FU3gzNVc4dz09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 10:00:01', '2026-07-21 10:00:01', NULL),
(7, 3, 'H_178322', 'Sadaf', 'ZW1USWZGUWVzbHdvUHZGMk1ZMWR2dVZ2VXhXWXV5a3VnRnNiMklhS0NGdz0=', 'elF1aEZ0WlVTekR1TW1FU3gzNVc4dz09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 10:04:50', '2026-07-28 16:51:02', NULL),
(8, 4, 'H_493573', 'Sakina', 'ckdJdjlPSlFMUFkxY2drZnh6cm1rdU93YkdIQXpXeVhZMnZkZHhlODRjaz0=', 'eVA2eTF0VmhJWVNsS1ZaYjdheVJlQT09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 10:19:45', '2026-07-28 17:34:04', NULL),
(9, 6, 'H_258777', 'Tehshin', 'VXMvZzRCTTZxYUVTU3oxZXZlbE9oTHZkSmxMd3l6SXRPSWViRGh3MEE1RT0=', 'YnZEYnNVeTlJeDVvRStoZTFUWEFIUT09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, '2026-07-21 10:34:11', '2026-07-28 17:34:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_22_125847_create_roles_table', 1),
(5, '2026_06_22_125915_create_firm_locations_table', 1),
(6, '2026_06_22_133243_create_customers_table', 1),
(7, '2026_06_22_133845_create_hospitals_table', 1),
(8, '2026_06_22_134037_create_departments_table', 1),
(9, '2026_06_22_134415_create_permissions_table', 1),
(10, '2026_06_22_134545_create_role_has_permissions_table', 1),
(11, '2026_06_22_135643_create_user_details_table', 1),
(12, '2026_06_22_153144_create_otps_table', 1),
(13, '2026_06_26_151924_create_personal_access_tokens_table', 1),
(14, '2026_06_30_141227_create_notifications_table', 1),
(15, '2026_07_01_161109_create_services_table', 1),
(16, '2026_07_05_092403_create_audit_logs_table', 1),
(18, '2026_07_12_044714_create_modules_table', 1),
(19, '2026_07_15_054348_create_customer_subscriptions_table', 1),
(20, '2026_07_15_063426_create_customer_plans_table', 1),
(21, '2026_07_15_160242_create_customer_feature_plans_table', 1),
(22, '2026_07_15_160256_create_customer_features_table', 1),
(23, '2026_07_16_104309_create_cities_table', 2),
(24, '2026_07_16_104254_create_states_table', 3),
(25, '2026_07_16_104156_create_countries_table', 4),
(26, '2026_07_10_050111_create_user_roles_table', 5),
(27, '2026_07_22_145913_create_suppliers_table', 6),
(34, '2026_07_24_084600_create_medicine_batches_table', 7),
(35, '2026_07_24_085532_create_prescriptions_table', 8),
(36, '2026_07_24_090309_create_prescription_items_table', 9),
(37, '2026_07_24_093455_create_pharmacy_bills_table', 10),
(38, '2026_07_24_094320_create_pharmacy_bill_items_table', 11),
(39, '2026_07_24_095019_create_pharmacy_categories_table', 12),
(40, '2026_07_24_123544_create_pharmacy_medicines_table', 13),
(41, '2026_07_24_123833_create_pharmacy_suppliers_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT '1' COMMENT '1=active, 0=inactive',
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `parent_id`, `name`, `slug`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dashboard', 'dashboard', 1, NULL, '2026-07-18 10:37:02', NULL),
(2, NULL, 'Consultation & OPD', 'consultation_opd', 1, NULL, '2026-07-18 10:37:15', NULL),
(3, NULL, 'Emergency & Critical', 'emergency_critical', 1, NULL, '2026-07-18 10:37:44', NULL),
(4, NULL, 'Ambulance Management', 'ambulance_management', 1, NULL, '2026-07-18 10:38:02', NULL),
(5, NULL, 'Women Health Care', 'women_health_care', 1, NULL, '2026-07-18 10:38:39', NULL),
(6, NULL, 'Child Health Care', 'child_health_care', 1, NULL, '2026-07-18 10:39:03', NULL),
(7, NULL, 'Clinical Departments', 'clinical_departments', 1, NULL, '2026-07-18 10:42:02', NULL),
(8, NULL, 'OT & Surgery Management', 'ot_surgery_management', 1, NULL, '2026-07-18 10:42:20', NULL),
(9, NULL, 'Inpatient (IPD)', 'inpatient_ipd', 1, NULL, '2026-07-18 10:42:49', NULL),
(10, NULL, 'Diagnostics & Imaging', 'diagnostics_imaging', 1, NULL, '2026-07-18 10:43:02', NULL),
(11, NULL, 'Laboratory Management (LIS)', 'laboratory_management_lis', 1, NULL, '2026-07-18 10:43:20', NULL),
(12, NULL, 'Blood Management', 'blood_management', 1, NULL, '2026-07-18 10:43:36', NULL),
(13, NULL, 'Pharmacy Management', 'pharmacy_management', 1, NULL, '2026-07-18 10:44:08', NULL),
(14, NULL, 'Wellness Management', 'wellness_management', 1, NULL, '2026-07-18 10:44:48', NULL),
(15, NULL, 'Preventive & Rehabilitation', 'preventive_rehabilitation', 1, NULL, '2026-07-18 10:45:15', NULL),
(16, NULL, 'Home Healthcare', 'home_healthcare', 1, NULL, '2026-07-18 10:45:32', NULL),
(17, NULL, 'Patient Support', 'patient_support', 1, NULL, '2026-07-18 10:46:00', NULL),
(18, NULL, 'Services', 'services', 1, NULL, '2026-07-18 10:46:17', NULL),
(19, NULL, 'Payroll Management', 'payroll_management', 1, NULL, '2026-07-18 10:46:53', NULL),
(20, NULL, 'Settings', 'settings', 1, NULL, '2026-07-18 10:47:07', NULL),
(21, 2, 'General Consultation', 'general_consultation', 1, NULL, '2026-07-18 10:56:42', NULL),
(22, 2, 'Specialist Consultation', 'specialist_consultation', 1, NULL, '2026-07-18 10:57:41', NULL),
(23, 2, 'Telemedicine', 'telemedicine', 1, NULL, '2026-07-18 10:57:54', NULL),
(24, 2, 'Second Opinion', 'second_opinion', 1, NULL, '2026-07-18 10:58:07', NULL),
(25, 2, 'Follow-up Consultation', 'follow_up_consultation', 1, NULL, '2026-07-18 10:58:25', NULL),
(26, 2, 'Online Appointment', 'online_appointment', 1, NULL, '2026-07-18 10:58:46', NULL),
(27, 2, 'Video Consultation', 'video_consultation', 1, NULL, '2026-07-18 10:59:30', NULL),
(28, 2, 'Home Visit', 'home_visit', 1, NULL, '2026-07-18 11:00:02', NULL),
(29, 2, 'Walk-in Management', 'walk_in_management', 1, NULL, '2026-07-18 11:00:20', NULL),
(30, 3, 'Emergency Care', 'emergency_care', 1, NULL, '2026-07-18 11:00:48', NULL),
(31, 3, 'Trauma Center', 'trauma_center', 1, NULL, '2026-07-18 11:01:01', NULL),
(32, 3, 'Emergency Surgery', 'emergency_surgery', 1, NULL, '2026-07-18 11:01:15', NULL),
(33, 3, 'ICU (Intensive Care Unit)', 'icu_intensive_care_unit', 1, NULL, '2026-07-18 11:01:44', NULL),
(34, 3, 'NICU (Neonatal ICU)', 'nicu_neonatal_icu', 1, NULL, '2026-07-18 11:02:06', NULL),
(35, 3, 'CCU (Cardiac Care Unit)', 'ccu_cardiac_care_unit', 1, NULL, '2026-07-18 11:02:22', NULL),
(36, 3, 'PICU (Pediatric ICU)', 'picu_pediatric_icu', 1, NULL, '2026-07-18 11:02:47', NULL),
(37, 3, 'Triage Management', 'triage_management', 1, NULL, '2026-07-18 11:03:01', NULL),
(38, 4, 'Emergency Dispatch', 'emergency_dispatch', 1, NULL, '2026-07-18 11:03:17', NULL),
(39, 4, 'Live GPS Tracking', 'live_gps_tracking', 1, NULL, '2026-07-18 11:03:41', NULL),
(40, 4, 'Driver App Integration', 'driver_app_integration', 1, NULL, '2026-07-18 11:03:55', NULL),
(41, 4, 'Inter-Hospital Transfer', 'inter_hospital_transfer', 1, NULL, '2026-07-18 11:04:14', NULL),
(42, 5, 'Pregnancy Care', 'pregnancy_care', 1, NULL, '2026-07-18 11:04:40', NULL),
(43, 5, 'Maternity Services', 'maternity_services', 1, NULL, '2026-07-18 11:04:57', NULL),
(44, 5, 'Prenatal Care', 'prenatal_care', 1, NULL, '2026-07-18 11:05:12', NULL),
(45, 5, 'Postnatal Care', 'postnatal_care', 1, NULL, '2026-07-18 11:05:26', NULL),
(46, 5, 'High Risk Pregnancy', 'high_risk_pregnancy', 1, NULL, '2026-07-18 11:05:47', NULL),
(47, 5, 'Normal Delivery', 'normal_delivery', 1, NULL, '2026-07-18 11:06:02', NULL),
(48, 5, 'C-Section Support', 'c_section_support', 1, NULL, '2026-07-18 11:06:16', NULL),
(49, 5, 'Family Planning', 'family_planning', 1, NULL, '2026-07-18 11:06:30', NULL),
(50, 6, 'Pediatrics', 'pediatrics', 1, NULL, '2026-07-18 11:06:55', NULL),
(51, 6, 'Newborn Care', 'newborn_care', 1, NULL, '2026-07-18 11:07:10', NULL),
(52, 6, 'Vaccination', 'vaccination', 1, NULL, '2026-07-18 11:07:22', NULL),
(53, 6, 'NICU', 'nicu', 1, NULL, '2026-07-18 11:07:36', NULL),
(54, 6, 'Growth Monitoring', 'growth_monitoring', 1, NULL, '2026-07-18 11:07:54', NULL),
(55, 6, 'Child Nutrition', 'child_nutrition', 1, NULL, '2026-07-18 11:08:09', NULL),
(56, 6, 'Pediatric Psychology', 'pediatric_psychology', 1, NULL, '2026-07-18 11:08:25', NULL),
(57, 7, 'Cardiology', 'cardiology', 1, NULL, '2026-07-18 11:08:44', NULL),
(58, 7, 'Neurology', 'neurology', 1, NULL, '2026-07-18 11:08:58', NULL),
(59, 7, 'Orthopedics', 'orthopedics', 1, NULL, '2026-07-18 11:09:12', NULL),
(60, 7, 'Dermatology', 'dermatology', 1, NULL, '2026-07-18 11:11:26', NULL),
(61, 7, 'ENT', 'ent', 1, NULL, '2026-07-18 11:11:40', NULL),
(62, 7, 'Pulmonology', 'pulmonology', 1, NULL, '2026-07-18 11:11:54', NULL),
(63, 7, 'Gastroenterology', 'gastroenterology', 1, NULL, '2026-07-18 11:12:10', NULL),
(64, 7, 'Urology', 'urology', 1, NULL, '2026-07-18 11:12:25', NULL),
(65, 7, 'Nephrology', 'nephrology', 1, NULL, '2026-07-18 11:12:40', NULL),
(66, 7, 'Oncology', 'oncology', 1, NULL, '2026-07-18 11:12:54', NULL),
(67, 7, 'Endocrinology', 'endocrinology', 1, NULL, '2026-07-18 11:13:11', NULL),
(68, 7, 'Ophthalmology', 'ophthalmology', 1, NULL, '2026-07-18 11:13:30', NULL),
(69, 7, 'Dental', 'dental', 1, NULL, '2026-07-18 11:13:43', NULL),
(70, 7, 'Psychiatry & Behavioral Health', 'psychiatry_behavioral_health', 1, NULL, '2026-07-18 11:14:13', NULL),
(71, 8, 'General Surgery', 'general_surgery', 1, NULL, '2026-07-18 11:14:48', NULL),
(72, 8, 'Cardiac Surgery', 'cardiac_surgery', 1, NULL, '2026-07-18 11:15:06', NULL),
(73, 8, 'Neuro Surgery', 'neuro_surgery', 1, NULL, '2026-07-18 11:15:25', NULL),
(74, 8, 'Orthopedic Surgery', 'orthopedic_surgery', 1, NULL, '2026-07-18 11:15:47', NULL),
(75, 8, 'Plastic Surgery', 'plastic_surgery', 1, NULL, '2026-07-18 11:16:11', NULL),
(76, 8, 'Laparoscopy', 'laparoscopy', 1, NULL, '2026-07-18 11:16:55', NULL),
(77, 8, 'ENT Surgery', 'ent_surgery', 1, NULL, '2026-07-18 11:17:19', NULL),
(78, 8, 'OT Scheduling & Checklist', 'ot_scheduling_checklist', 1, NULL, '2026-07-18 11:17:40', NULL),
(79, 8, 'Post-Anesthesia Care Unit (PACU)', 'post_anesthesia_care_unit_pacu', 1, NULL, '2026-07-18 11:17:56', NULL),
(80, 9, 'Bed Allocation & Tracking', 'bed_allocation_tracking', 1, NULL, '2026-07-18 11:27:22', NULL),
(81, 9, 'Ward/Room Management', 'ward_room_management', 1, NULL, '2026-07-18 11:27:42', NULL),
(82, 9, 'Nursing Workbench', 'nursing_workbench', 1, NULL, '2026-07-18 11:28:06', NULL),
(83, 9, 'Daily Rounds Log', 'daily_rounds_log', 1, NULL, '2026-07-18 11:28:22', NULL),
(84, 9, 'Doctor Progress Notes', 'doctor_progress_notes', 1, NULL, '2026-07-18 11:28:44', NULL),
(85, 9, 'Dietary/Hospital Meal', 'dietary_hospital_meal', 1, NULL, '2026-07-18 11:29:17', NULL),
(86, 10, 'Diagnostic Center', 'diagnostic_center', 1, NULL, '2026-07-18 11:29:50', NULL),
(87, 10, 'Radiology', 'radiology', 1, NULL, '2026-07-18 11:30:04', NULL),
(88, 10, 'X-Ray', 'x_ray', 1, NULL, '2026-07-18 11:30:17', NULL),
(89, 10, 'CT Scan', 'ct_scan', 1, NULL, '2026-07-18 11:30:30', NULL),
(90, 10, 'MRI', 'mri', 1, NULL, '2026-07-18 11:30:42', NULL),
(91, 10, 'Ultrasound', 'ultrasound', 1, NULL, '2026-07-18 11:30:57', NULL),
(92, 10, 'ECG', 'ecg', 1, NULL, '2026-07-18 11:31:11', NULL),
(93, 10, 'EEG', 'eeg', 1, NULL, '2026-07-18 11:31:23', NULL),
(94, 10, 'Cath Lab - For Heart Procedures', 'cath_lab_for_heart_procedures', 1, NULL, '2026-07-18 11:31:55', NULL),
(95, 10, 'PACS Integration', 'pacs_integration', 1, NULL, '2026-07-18 11:32:17', NULL),
(96, 11, 'Biochemistry', 'biochemistry', 1, NULL, '2026-07-18 11:32:47', NULL),
(97, 11, 'Hematology', 'hematology', 1, NULL, '2026-07-18 11:33:09', NULL),
(98, 11, 'Microbiology', 'microbiology', 1, NULL, '2026-07-18 11:33:30', NULL),
(99, 11, 'Immunohematology', 'immunohematology', 1, NULL, '2026-07-18 11:33:49', NULL),
(100, 11, 'Urinalysis', 'urinalysis', 1, NULL, '2026-07-18 11:34:04', NULL),
(101, 11, 'Barcode Generation', 'barcode_generation', 1, NULL, '2026-07-18 11:34:39', NULL),
(102, 11, 'Lab Report Authorizatio', 'lab_report_authorizatio', 1, NULL, '2026-07-18 11:34:59', NULL),
(103, 12, 'Blood Collection', 'blood_collection', 1, NULL, '2026-07-18 11:35:21', NULL),
(104, 12, 'Blood Donor', 'blood_donor', 1, NULL, '2026-07-18 11:35:41', NULL),
(105, 12, 'Stock & Component Management', 'stock_component_management', 1, NULL, '2026-07-18 11:36:03', NULL),
(106, 12, 'Cross-Matching', 'cross_matching', 1, NULL, '2026-07-18 11:36:22', NULL),
(107, 12, 'Compatibility Testing', 'compatibility_testing', 1, NULL, '2026-07-18 11:36:34', NULL),
(108, 13, 'Pharmacy', 'pharmacy', 1, NULL, '2026-07-18 11:36:56', NULL),
(109, 13, 'Medicine Delivery', 'medicine_delivery', 1, NULL, '2026-07-18 11:37:12', NULL),
(110, 13, 'Prescription Refill', 'prescription_refill', 1, NULL, '2026-07-18 11:37:26', NULL),
(111, 13, 'Drug Information', 'drug_information', 1, NULL, '2026-07-18 11:37:40', NULL),
(112, 13, 'Medical Store', 'medical_store', 1, NULL, '2026-07-18 11:37:56', NULL),
(113, 13, 'Ward Stock', 'ward_stock', 1, NULL, '2026-07-18 11:38:17', NULL),
(114, 13, 'Sub-Store Management', 'sub_store_management', 1, NULL, '2026-07-18 11:38:41', NULL),
(115, 13, 'Expiry Alert', 'expiry_alert', 1, NULL, '2026-07-18 11:38:51', NULL),
(116, 13, 'Purchase Order Workflow', 'purchase_order_workflow', 1, NULL, '2026-07-18 11:39:08', NULL),
(117, 14, 'Health Checkup Packages', 'health_checkup_packages', 1, NULL, '2026-07-18 11:39:35', NULL),
(118, 14, 'Diet Consultation', 'diet_consultation', 1, NULL, '2026-07-18 11:39:49', NULL),
(119, 14, 'Nutrition', 'nutrition', 1, NULL, '2026-07-18 11:40:06', NULL),
(120, 14, 'Physiotherapy', 'physiotherapy', 1, NULL, '2026-07-18 11:40:19', NULL),
(121, 14, 'Mental Health', 'mental_health', 1, NULL, '2026-07-18 11:40:35', NULL),
(122, 14, 'Yoga', 'yoga', 1, NULL, '2026-07-18 11:40:49', NULL),
(123, 14, 'Rehabilitation', 'rehabilitation', 1, NULL, '2026-07-18 11:41:02', NULL),
(124, 14, 'Lifestyle Management', 'lifestyle_management', 1, NULL, '2026-07-18 11:41:15', NULL),
(125, 14, 'Occupational Therapy', 'occupational_therapy', 1, NULL, '2026-07-18 11:41:30', NULL),
(126, 16, 'Home Nursing', 'home_nursing', 1, NULL, '2026-07-18 11:42:24', NULL),
(127, 16, 'Home ICU', 'home_icu', 1, NULL, '2026-07-18 11:42:37', NULL),
(128, 16, 'Home Sample Collection', 'home_sample_collection', 1, NULL, '2026-07-18 11:44:08', NULL),
(129, 16, 'Home Physiotherapy', 'home_physiotherapy', 1, NULL, '2026-07-18 11:44:22', NULL),
(130, 16, 'Elder Care', 'elder_care', 1, NULL, '2026-07-18 11:44:38', NULL),
(131, 16, 'Medical Equipment Rental', 'medical_equipment_rental', 1, NULL, '2026-07-18 11:45:00', NULL),
(132, 17, 'Technical Support', 'technical_support', 1, NULL, '2026-07-18 11:45:26', NULL),
(133, NULL, 'Insurance Management', 'insurance_management', 1, NULL, '2026-07-18 11:46:21', NULL),
(134, 17, 'Billing Support', 'billing_support', 1, NULL, '2026-07-18 11:46:50', NULL),
(135, 17, 'Medical Records', 'medical_records', 1, NULL, '2026-07-18 11:47:10', NULL),
(136, 17, 'Patient Helpdesk', 'patient_helpdesk', 1, NULL, '2026-07-18 11:47:26', NULL),
(137, 17, 'Admission Support', 'admission_support', 1, NULL, '2026-07-18 11:48:07', NULL),
(138, 17, 'Doctor Support', 'doctor_support', 1, NULL, '2026-07-18 11:48:24', NULL),
(139, 17, 'Discharge Support', 'discharge_support', 1, NULL, '2026-07-18 11:48:40', NULL),
(140, 18, 'Consultation', 'consultation', 1, NULL, '2026-07-18 11:49:21', NULL),
(141, 18, 'Diagnostics', 'diagnostics', 1, NULL, '2026-07-18 11:49:46', NULL),
(142, 18, 'Emergency', 'emergency', 1, NULL, '2026-07-18 11:50:02', NULL),
(143, 18, 'Women & Child Care', 'women_child_care', 1, NULL, '2026-07-18 11:50:17', NULL),
(144, 18, 'Surgery', 'surgery', 1, NULL, '2026-07-18 11:50:30', NULL),
(145, 18, 'Wellness', 'wellness', 1, NULL, '2026-07-18 11:50:43', NULL),
(146, 18, 'Home Care', 'home_care', 1, NULL, '2026-07-18 11:50:57', NULL),
(147, 18, 'Support', 'support', 1, NULL, '2026-07-18 11:51:09', NULL),
(148, 20, 'Customer', 'customer', 1, NULL, '2026-07-18 11:51:41', NULL),
(149, 20, 'Plan', 'plan', 1, NULL, '2026-07-18 11:51:55', NULL),
(150, 20, 'Subscription', 'subscription', 1, NULL, '2026-07-18 11:52:15', NULL),
(151, 20, 'Authentication', 'authentication', 1, NULL, '2026-07-19 00:19:55', NULL),
(152, 20, 'Department', 'department', 1, NULL, '2026-07-19 00:20:13', NULL),
(153, 20, 'Hospital', 'hospital', 1, NULL, '2026-07-19 00:20:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` int NOT NULL,
  `expired_at` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `action`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'View', 'dashboard.view', 1, '2026-07-19 01:53:46', '2026-07-19 01:53:46', NULL),
(2, 21, 'View', 'general_consultation.view', 1, '2026-07-19 01:58:06', '2026-07-19 01:58:06', NULL),
(3, 21, 'Create', 'general_consultation.create', 1, '2026-07-19 01:59:47', '2026-07-19 01:59:47', NULL),
(4, 21, 'Edit', 'general_consultation.edit', 1, '2026-07-19 02:04:20', '2026-07-19 02:04:20', NULL),
(5, 21, 'Update', 'general_consultation.update', 1, '2026-07-19 02:04:42', '2026-07-19 02:04:42', NULL),
(6, 21, 'Delete', 'general_consultation.delete', 1, '2026-07-19 02:08:31', '2026-07-19 02:08:31', NULL),
(7, 22, 'View', 'specialist_consultation.view', 1, '2026-07-19 04:34:05', '2026-07-19 04:34:05', NULL),
(8, 22, 'Create', 'specialist_consultation.create', 1, '2026-07-19 04:34:23', '2026-07-19 04:34:23', NULL),
(9, 22, 'Save', 'specialist_consultation.save', 1, '2026-07-19 04:34:43', '2026-07-19 04:34:43', NULL),
(10, 22, 'Edit', 'specialist_consultation.edit', 1, '2026-07-19 04:34:58', '2026-07-19 04:34:58', NULL),
(11, 22, 'Update', 'specialist_consultation.update', 1, '2026-07-19 04:35:18', '2026-07-19 04:35:18', NULL),
(12, 22, 'Delete', 'specialist_consultation.delete', 1, '2026-07-19 04:35:37', '2026-07-19 04:35:37', NULL),
(13, 148, 'View', 'customer.view', 1, '2026-07-19 04:36:08', '2026-07-19 04:36:08', NULL),
(14, 148, 'Create', 'customer.create', 1, '2026-07-19 04:36:27', '2026-07-19 04:36:27', NULL),
(15, 148, 'Save', 'customer.save', 1, '2026-07-19 04:36:51', '2026-07-19 04:36:51', NULL),
(16, 148, 'Edit', 'customer.edit', 1, '2026-07-19 04:40:42', '2026-07-19 04:40:42', NULL),
(17, 148, 'Update', 'customer.update', 1, '2026-07-19 04:41:01', '2026-07-19 04:41:01', NULL),
(18, 148, 'Delete', 'customer.delete', 1, '2026-07-19 04:41:18', '2026-07-19 04:41:18', NULL),
(19, 148, 'Import', 'customer.import', 1, '2026-07-19 04:41:48', '2026-07-19 04:41:48', NULL),
(20, 148, 'Export', 'customer.export', 1, '2026-07-19 04:42:31', '2026-07-19 04:42:31', NULL),
(21, 149, 'View', 'plan.view', 1, '2026-07-19 04:43:19', '2026-07-19 04:43:19', NULL),
(22, 149, 'List', 'plan.list', 1, '2026-07-19 04:43:56', '2026-07-19 04:43:56', NULL),
(23, 149, 'Create', 'plan.create', 1, '2026-07-19 04:44:15', '2026-07-19 04:44:15', NULL),
(24, 149, 'Save', 'plan.save', 1, '2026-07-19 04:44:33', '2026-07-19 04:44:33', NULL),
(25, 149, 'Feature Save', 'plan.feature.save', 1, '2026-07-19 04:45:17', '2026-07-19 04:45:17', NULL),
(26, 149, 'Feature Mapping Save', 'plan.feature.mapping.save', 1, '2026-07-19 04:51:22', '2026-07-19 04:51:22', NULL),
(27, 151, 'View', 'authentication.view', 1, '2026-07-19 05:03:47', '2026-07-19 05:03:47', NULL),
(28, 151, 'List', 'authentication.list', 1, '2026-07-19 05:04:17', '2026-07-19 05:04:17', NULL),
(29, 151, 'Save', 'authentication.save', 1, '2026-07-19 05:04:40', '2026-07-19 05:04:40', NULL),
(30, 151, 'Permission Save', 'authentication.permission.save', 1, '2026-07-19 05:05:09', '2026-07-19 05:05:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_bills`
--

CREATE TABLE `pharmacy_bills` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from customers table id',
  `pharmacy_supplier_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from suppliers table id, where part type = 2 or 3 (supplier)',
  `prescription_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Null if Direct Walk-in / Retail, id getting from prescriptions table',
  `patient_id` bigint UNSIGNED DEFAULT NULL,
  `served_by_employee_id` bigint UNSIGNED NOT NULL COMMENT 'Pharmacist User ID',
  `bill_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'bill number',
  `sub_total` decimal(10,2) NOT NULL COMMENT 'sub total',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'discount amount',
  `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'tax amount',
  `grand_total` decimal(10,2) NOT NULL COMMENT 'grand total',
  `payment_status` tinyint NOT NULL DEFAULT '1' COMMENT '1=PAID, 2=PARTIAL, 3=UNPAID',
  `payment_mode` tinyint NOT NULL DEFAULT '1' COMMENT '1=CASH, 2=CARD, 3=UPI, 4=INSURANCE, 5=HOSPITAL_LEDGER',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_bill_items`
--

CREATE TABLE `pharmacy_bill_items` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from customers table id',
  `pharmacy_supplier_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from suppliers table id, where part type = 2 or 3 (supplier)',
  `pharmacy_bill_id` bigint UNSIGNED DEFAULT NULL COMMENT 'id getting from pharmacy_bills table id',
  `medicine_id` bigint UNSIGNED DEFAULT NULL COMMENT 'id getting from medicines table id',
  `batch_id` bigint UNSIGNED DEFAULT NULL COMMENT 'id getting from medicine_batches table id, Tracked exact batch sold!',
  `quantity` int DEFAULT NULL COMMENT 'pharmacy_bills',
  `unit_price` decimal(10,2) DEFAULT NULL,
  `tax_amount` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_categories`
--

CREATE TABLE `pharmacy_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from customers table id, Multi-tenant SaaS ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'e.g., Tablets, Syrups, Injectables',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_categories`
--

INSERT INTO `pharmacy_categories` (`id`, `customer_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'syrup', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_medicines`
--

CREATE TABLE `pharmacy_medicines` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from customers table id',
  `pharmacy_supplier_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from suppliers table id, where part type = 2 or 3 (supplier)',
  `category_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from pharmacy_categories table id, where part type = 2 or 3 (supplier)',
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'e.g., Crocin 500mg',
  `generic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'e.g., Paracetamol',
  `hsn_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tax/GST Code',
  `drug_type` tinyint NOT NULL DEFAULT '1' COMMENT '1=OTC, 2=SCHEDULE_H, 3=SCHEDULE_H1, 4=NARCOTIC',
  `unit_of_measure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'e.g., Strip, Bottle, Box',
  `min_reorder_level` int NOT NULL DEFAULT '10' COMMENT 'Low stock alert threshold',
  `rack_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Physical location in pharmacy',
  `shelf_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_medicines`
--

INSERT INTO `pharmacy_medicines` (`id`, `customer_id`, `pharmacy_supplier_id`, `category_id`, `brand_name`, `generic_name`, `hsn_code`, `drug_type`, `unit_of_measure`, `min_reorder_level`, `rack_number`, `shelf_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Cipla', 'cipla ksnen332', 'JKJKS9392', 1, '6', 10, '15', '10', 1, NULL, NULL),
(8, 1, 1, 1, 'Cipla\n', 'Cipla Mazzda\r\n', 'MYJKS9392', 1, '12', 10, '15', '13', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_medicine_batches`
--

CREATE TABLE `pharmacy_medicine_batches` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from customers table id',
  `pharmacy_supplier_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from suppliers table id, where part type = 2 or 3 (supplier)',
  `vendor_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from suppliers table id where party_type=4',
  `medicine_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from medicines table id',
  `batch_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'e.g., BATCH-2026-X01',
  `mfg_date` date DEFAULT NULL COMMENT 'drug manufacturing date',
  `expiry_date` date DEFAULT NULL COMMENT 'Crucial for FEFO Sorting!',
  `purchase_qty` int DEFAULT NULL COMMENT 'Total received',
  `current_qty` int DEFAULT NULL COMMENT 'Available stock',
  `unit_cost_price` decimal(10,2) DEFAULT NULL COMMENT 'Purchase price',
  `unit_mrp` decimal(10,2) DEFAULT NULL COMMENT 'Maximum Retail Price',
  `selling_price` decimal(10,2) DEFAULT NULL COMMENT 'Selling price',
  `tax_percentage` decimal(5,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_medicine_batches`
--

INSERT INTO `pharmacy_medicine_batches` (`id`, `customer_id`, `pharmacy_supplier_id`, `vendor_id`, `medicine_id`, `batch_number`, `mfg_date`, `expiry_date`, `purchase_qty`, `current_qty`, `unit_cost_price`, `unit_mrp`, `selling_price`, `tax_percentage`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, 'HDAB8372', '2025-11-05', '2027-12-15', 50, 23, 5500.00, 6500.00, 8000.00, 10.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_prescriptions`
--

CREATE TABLE `pharmacy_prescriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from customers table id',
  `pharmacy_supplier_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from suppliers table id, where part type = 2 or 3 (supplier)',
  `patient_id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `patient_type` tinyint NOT NULL COMMENT '1=OPD, 2=IPD',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=PENDING, 2=DISPENSED, 3=CANCELLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_prescription_items`
--

CREATE TABLE `pharmacy_prescription_items` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from customers table id',
  `pharmacy_supplier_id` bigint UNSIGNED NOT NULL COMMENT 'This id will getting from suppliers table id, where part type = 2 or 3 (supplier)',
  `prescription_id` bigint UNSIGNED DEFAULT NULL COMMENT 'id getting from prescriptions table',
  `medicine_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Doctor chose medicine, id getting from medicines table',
  `dosage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'e.g., 500mg',
  `frequency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'e.g., 1-0-1 (Subah-Shaam)',
  `duration_days` int DEFAULT NULL COMMENT 'e.g., 5 Days',
  `total_qty_prescribed` int DEFAULT NULL COMMENT 'e.g., 10 Tablets',
  `instructions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'e.g., After food',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_suppliers`
--

CREATE TABLE `pharmacy_suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from customers table (means ye customer, super admin ka client hai)',
  `hospital_id` bigint UNSIGNED DEFAULT NULL COMMENT 'This id will getting from hospitals table',
  `firm_id` bigint UNSIGNED DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Party/Pharmacy Customer Name',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Supplier ke liye',
  `drug_license_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Supplier ke liye',
  `doctor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` decimal(10,2) DEFAULT NULL COMMENT 'opening balance',
  `credit_limit` decimal(10,2) DEFAULT NULL COMMENT 'Customer ke liye, Grahak ko kitni amount tak udhar dena allow hai.',
  `credit_days` tinyint DEFAULT NULL COMMENT 'Supplier ke liye',
  `balance_type` tinyint NOT NULL DEFAULT '1' COMMENT '1=Credit, 2=Debit',
  `party_type` tinyint NOT NULL DEFAULT '1' COMMENT '1=Customer, 2=Supplier, 3=Customer+Supplier, 4=Vendor, 5=Referral Doctor, 6=Manufacturer',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_suppliers`
--

INSERT INTO `pharmacy_suppliers` (`id`, `customer_id`, `hospital_id`, `firm_id`, `company_name`, `name`, `slug`, `email`, `gst_no`, `pan_no`, `contact`, `contact_person`, `drug_license_no`, `doctor_name`, `doctor_address`, `address`, `opening_balance`, `credit_limit`, `credit_days`, `balance_type`, `party_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, 'Pepsi Bharat', 'Sabia Hussain', 'sabia_hussain', 'annaaryan95@gmail.com', '06BZAHM6385P6Z2', 'ASDFG1234Q', '9856885548', NULL, NULL, 'Abhishek Kumar', 'Kapoorthala', NULL, 79854.00, 225545.00, NULL, 1, 1, 1, '2026-07-24 07:30:00', NULL, NULL),
(2, NULL, NULL, NULL, 'Avenue Super Market Ltd', 'Sadaf Fatima', 'sadaf_fatima', 'sadaf_fatima95@gmail.com', '06BWDSE6385P6M2', 'ASSFG1234Q', '9856885548', 'Sakina Bibi', 'UP-01-20B-1234', 'Abhishek Kumar', 'Kapoorthala', NULL, 96588.00, NULL, 30, 1, 2, 1, '2026-07-24 07:33:17', NULL, NULL),
(3, NULL, NULL, NULL, 'Fatima Ltd', 'Jarifa Ahmed', 'jarifa_ahmed', 'jarifaahmed@gmail.com', '06BZAHM6385P6Z3', 'ASDFG1234T', '9856885545', NULL, NULL, 'Akshay Komal', 'Kapoorthala', NULL, NULL, NULL, NULL, 1, 4, 1, '2026-07-24 07:35:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint UNSIGNED NOT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_days` int DEFAULT NULL,
  `max_hospitals` int DEFAULT NULL,
  `max_firms` int DEFAULT NULL,
  `max_users` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Current, 0=History',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `price`, `duration_days`, `max_hospitals`, `max_firms`, `max_users`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Trail', 0.00, 7, 1, 1, 10, 1, '2026-07-15 12:34:05', NULL),
(2, 'Starter', 5000.00, 30, 5, 10, 100, 1, '2026-07-15 12:35:42', NULL),
(3, 'Professional', 20000.00, 30, 20, 100, 5000, 1, '2026-07-15 12:37:02', NULL),
(4, 'Enterprise', 100000.00, 30, 50, 500, 20000, 1, '2026-07-15 12:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `hospital_id` bigint UNSIGNED DEFAULT NULL,
  `firm_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_full_access` tinyint NOT NULL DEFAULT '0' COMMENT '0=Super Admin/Customer Admin/ Hospital Admin, 1=Normal Employee',
  `scope` tinyint NOT NULL DEFAULT '0' COMMENT '0=SYSTEM,1=CUSTOMER',
  `is_system` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=Default/System Generated Role, 1=Custom Role',
  `protected_role` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'customer admin ya super admin delete nahi hoga',
  `role_priority` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `customer_id`, `hospital_id`, `firm_id`, `name`, `code`, `is_full_access`, `scope`, `is_system`, `protected_role`, `role_priority`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, 'Super Admin', 'super_admin', 0, 0, 0, 0, 100, 1, 1, NULL, '2026-07-22 11:24:10', NULL, NULL),
(2, 3, 1, 1, 'Admin', 'admin', 0, 1, 1, 0, 90, 1, 1, NULL, '2026-07-22 11:24:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `customer_id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 1, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(2, 3, 2, 2, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(3, 3, 2, 3, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(4, 3, 2, 4, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(5, 3, 2, 5, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(6, 3, 2, 6, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(7, 3, 2, 7, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(8, 3, 2, 8, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(9, 3, 2, 9, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(10, 3, 2, 10, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(11, 3, 2, 11, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(12, 3, 2, 12, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(13, 3, 2, 13, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(14, 3, 2, 14, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(15, 3, 2, 15, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(16, 3, 2, 19, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(17, 3, 2, 20, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(18, 3, 2, 21, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(19, 3, 2, 22, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(20, 3, 2, 23, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(21, 3, 2, 24, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(22, 3, 2, 25, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(23, 3, 2, 26, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(24, 3, 2, 27, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(25, 3, 2, 28, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(26, 3, 2, 29, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(27, 3, 2, 30, '2026-07-19 08:05:23', '2026-07-19 08:05:23'),
(29, 3, 12, 1, '2026-07-21 11:36:18', '2026-07-21 11:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `firm_id` bigint UNSIGNED DEFAULT NULL,
  `hospital_id` bigint UNSIGNED DEFAULT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bLzUrdfr1mu5cQ4r7JvDaRw6XwWwFZOQppe3nNqB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVnV3ZFF1enQ0MGVXN3IyekNNVVhqZjNjeDRmZmZ5MnZWWlFVQXlBVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE0OiJ1c2VyX2F1dGhfZGF0YSI7Tzo4OiJzdGRDbGFzcyI6NDU6e3M6MjoiaWQiO2k6MTtzOjExOiJjdXN0b21lcl9pZCI7TjtzOjExOiJob3NwaXRhbF9pZCI7TjtzOjc6ImZpcm1faWQiO047czo3OiJ1c2VyX2lkIjtzOjk6IlVfOTU3MTczOCI7czo5OiJpc19zeXN0ZW0iO2k6MDtzOjU6ImVtYWlsIjtzOjYwOiJaR2cxUm01dFNqWlRVVXBZYm10NWRXRlhhVXRaYjFWclJIZG9ibEZDUzFsck5VOUNUM0JoYkc1Qll6MD0iO3M6NToicGhvbmUiO3M6MzI6IlpIZHFOWEJJUW1STVJWWjFPVTV3YzI5SloybHpRVDA5IjtzOjk6InVzZXJfdHlwZSI7aToxO3M6OToidXNlcl9uYW1lIjtzOjExOiJTdXBlciBBZG1pbiI7czoxMDoicm9sZV9uYW1lcyI7czoxMToiU3VwZXIgQWRtaW4iO3M6MTA6InJvbGVfY29kZXMiO3M6MTE6InN1cGVyX2FkbWluIjtzOjE0OiJpc19mdWxsX2FjY2VzcyI7aTowO3M6MTM6ImN1c3RvbWVyX25hbWUiO047czoxMzoibWF4X2hvc3BpdGFscyI7TjtzOjk6Im1heF91c2VycyI7TjtzOjk6Im1heF9maXJtcyI7TjtzOjE5OiJzdWJzY3JpcHRpb25fc3RhdHVzIjtOO3M6MTc6Imxhc3RfcGF5bWVudF9kYXRlIjtOO3M6MTc6Im5leHRfYmlsbGluZ19kYXRlIjtOO3M6MTM6ImN1c3RvbWVyX2xvZ28iO047czoxMDoiaW52b2ljZV9ubyI7TjtzOjE0OiJ0cmFuc2FjdGlvbl9pZCI7TjtzOjY6ImFtb3VudCI7TjtzOjEwOiJzdGFydF9kYXRlIjtOO3M6ODoiZW5kX2RhdGUiO047czoxNToicGF5bWVudF9nYXRld2F5IjtOO3M6MTQ6InBheW1lbnRfc3RhdHVzIjtOO3M6OToicGxhbl9uYW1lIjtOO3M6MTM6ImR1cmF0aW9uX2RheXMiO047czoxMzoiaG9zcGl0YWxfbmFtZSI7TjtzOjE1OiJyZWdpc3RyYXRpb25fbm8iO047czoxMDoibGljZW5zZV9ubyI7TjtzOjEzOiJob3NwaXRhbF9zbHVnIjtOO3M6MTU6Imhvc3BpdGFsX251bWJlciI7TjtzOjEwOiJ0b3RhbF9iZWRzIjtOO3M6MTQ6InRvdGFsX2ljdV9iZWRzIjtOO3M6MjQ6InRvdGFsX29wZXJhdGlvbl90aGVhdHJlcyI7TjtzOjE2OiJ0b3RhbF9hbWJ1bGFuY2VzIjtOO3M6MTE6InRvdGFsX3dhcmRzIjtOO3M6MTM6Imhvc3BpdGFsX2xvZ28iO047czoxMjoib3BlbmluZ190aW1lIjtOO3M6MTI6ImNsb3NpbmdfdGltZSI7TjtzOjk6ImZpcm1fbmFtZSI7TjtzOjEyOiJmaXJtX2FkZHJlc3MiO047fX0=', 1785514252),
('SwvSzCRe4abpobRoxtRMGQrrtV8vOMlKK5dRc93h', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUFXZUJxbGE4QmozMTFjOHY4emhGVlZ5QkF5ZVZUODN5S1k4cVMyOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785513157);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'state_code means UP, MH',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `state_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Uttar Pradesh', 'UP', NULL, NULL),
(2, 1, 'Maharastra', 'MH', NULL, NULL),
(3, 1, 'Bihar', 'BR', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `hospital_id` bigint UNSIGNED DEFAULT NULL,
  `firm_id` int DEFAULT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senior_user_id` int DEFAULT NULL,
  `is_system` tinyint NOT NULL DEFAULT '0' COMMENT '0=Super admin employee, 1=customer company employee',
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wrong_password_atempted` int DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` tinyint NOT NULL DEFAULT '7' COMMENT '1=super admin, 2=admin, 3=customer admin, 4=customer hospital admin, 5=hr, 6=manager, 7=leader, 8=employee',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `otp_verified` tinyint NOT NULL DEFAULT '1' COMMENT '0=no, 1=yes',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `customer_id`, `hospital_id`, `firm_id`, `department_id`, `user_id`, `senior_user_id`, `is_system`, `fname`, `lname`, `username`, `email`, `phone`, `password`, `default_password`, `wrong_password_atempted`, `gender`, `user_type`, `status`, `otp_verified`, `last_login_at`, `email_verified_at`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, 1, 'U_9571738', 1, 0, 'Super', 'Admin', 'superadmin', 'ZGg1Rm5tSjZTUUpYbmt5dWFXaUtZb1VrRHdoblFCS1lrNU9CT3BhbG5BYz0=', 'ZHdqNXBIQmRMRVZ1OU5wc29JZ2lzQT09', '$2y$12$pAcF9tIzn/mkTwZTes9iWevb1vnSALYTkSUIkzPar.Osj4W5aN4VG', 'admin', NULL, 'male', 1, 1, 1, NULL, NULL, NULL, 1, NULL, '2026-07-22 11:24:10', NULL, NULL),
(2, 3, 1, 1, 1, 'U_2415866', 1, 1, 'Komal', 'Mishra', 'admin', 'admin@hms.in', '9415058209', '$2y$12$axVfKR4Ot.vqKDUnPrDEL.HS294qTc/yUEneiRv/uxmHqrZ8A4AGG', 'admin', NULL, 'male', 6, 1, 1, NULL, NULL, NULL, 1, NULL, '2026-07-22 11:24:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `dob` date NOT NULL,
  `doj` datetime NOT NULL,
  `dol` datetime NOT NULL,
  `profile` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `hospital_id` bigint UNSIGNED DEFAULT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `customer_id`, `hospital_id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, 1, NULL, NULL),
(2, 3, 1, 2, 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_code_unique` (`customer_id`),
  ADD UNIQUE KEY `customers_customer_slug_unique` (`customer_slug`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_dept_code_unique` (`department_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_plans`
--
ALTER TABLE `feature_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `firms_code_unique` (`firm_id`),
  ADD KEY `firms_name_index` (`name`),
  ADD KEY `firms_code_index` (`firm_id`),
  ADD KEY `firms_hospital_id_index` (`hospital_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hospitals_code_unique` (`hospital_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_module_id_index` (`module_id`),
  ADD KEY `permissions_name_index` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `pharmacy_bills`
--
ALTER TABLE `pharmacy_bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pharmacy_bills_bill_number_unique` (`bill_number`),
  ADD KEY `pharmacy_bills_customer_id_index` (`customer_id`),
  ADD KEY `pharmacy_bills_pharmacy_supplier_id_index` (`pharmacy_supplier_id`),
  ADD KEY `pharmacy_bills_bill_number_index` (`bill_number`),
  ADD KEY `pharmacy_bills_prescription_id_index` (`prescription_id`);

--
-- Indexes for table `pharmacy_bill_items`
--
ALTER TABLE `pharmacy_bill_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_bill_items_customer_id_index` (`customer_id`),
  ADD KEY `pharmacy_bill_items_pharmacy_supplier_id_index` (`pharmacy_supplier_id`),
  ADD KEY `pharmacy_bill_items_medicine_id_index` (`medicine_id`),
  ADD KEY `pharmacy_bill_items_batch_id_index` (`batch_id`);

--
-- Indexes for table `pharmacy_categories`
--
ALTER TABLE `pharmacy_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_categories_customer_id_index` (`customer_id`),
  ADD KEY `pharmacy_categories_name_index` (`name`);

--
-- Indexes for table `pharmacy_medicines`
--
ALTER TABLE `pharmacy_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_medicines_customer_id_pharmacy_supplier_id_index` (`customer_id`,`pharmacy_supplier_id`),
  ADD KEY `pharmacy_medicines_brand_name_index` (`brand_name`),
  ADD KEY `pharmacy_medicines_generic_name_index` (`generic_name`),
  ADD KEY `pharmacy_medicines_hsn_code_index` (`hsn_code`);

--
-- Indexes for table `pharmacy_medicine_batches`
--
ALTER TABLE `pharmacy_medicine_batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_medicine_batches_customer_id_index` (`customer_id`),
  ADD KEY `pharmacy_medicine_batches_pharmacy_supplier_id_index` (`pharmacy_supplier_id`),
  ADD KEY `pharmacy_medicine_batches_medicine_id_index` (`medicine_id`),
  ADD KEY `pharmacy_medicine_batches_expiry_date_index` (`expiry_date`);

--
-- Indexes for table `pharmacy_prescriptions`
--
ALTER TABLE `pharmacy_prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_prescriptions_customer_id_index` (`customer_id`),
  ADD KEY `pharmacy_prescriptions_pharmacy_supplier_id_index` (`pharmacy_supplier_id`),
  ADD KEY `pharmacy_prescriptions_doctor_id_index` (`doctor_id`);

--
-- Indexes for table `pharmacy_prescription_items`
--
ALTER TABLE `pharmacy_prescription_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_prescription_items_customer_id_index` (`customer_id`),
  ADD KEY `pharmacy_prescription_items_pharmacy_supplier_id_index` (`pharmacy_supplier_id`),
  ADD KEY `pharmacy_prescription_items_medicine_id_index` (`medicine_id`);

--
-- Indexes for table `pharmacy_suppliers`
--
ALTER TABLE `pharmacy_suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pharmacy_suppliers_gst_no_unique` (`gst_no`),
  ADD UNIQUE KEY `pharmacy_suppliers_pan_no_unique` (`pan_no`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_customer_id_index` (`customer_id`),
  ADD KEY `roles_hospital_id_index` (`hospital_id`),
  ADD KEY `roles_firm_id_index` (`firm_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_customer_id_hospital_id_index` (`customer_id`,`hospital_id`),
  ADD KEY `users_firm_id_index` (`firm_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_subscriptions`
--
ALTER TABLE `customer_subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_plans`
--
ALTER TABLE `feature_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `firms`
--
ALTER TABLE `firms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_bills`
--
ALTER TABLE `pharmacy_bills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_bill_items`
--
ALTER TABLE `pharmacy_bill_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_categories`
--
ALTER TABLE `pharmacy_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharmacy_medicines`
--
ALTER TABLE `pharmacy_medicines`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pharmacy_medicine_batches`
--
ALTER TABLE `pharmacy_medicine_batches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharmacy_prescriptions`
--
ALTER TABLE `pharmacy_prescriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_prescription_items`
--
ALTER TABLE `pharmacy_prescription_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_suppliers`
--
ALTER TABLE `pharmacy_suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
