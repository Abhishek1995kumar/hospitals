-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2026 at 11:42 AM
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
-- Database: `beacon`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `ip_address`, `url`, `method`, `action`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', 'http://127.0.0.1:8000/login', 'POST', 'Create user session', '2026-07-07 06:28:51', '2026-07-07 06:28:51'),
(2, 1, '127.0.0.1', 'http://127.0.0.1:8000/transactions', 'POST', 'Create Transaction', '2026-07-07 06:29:20', '2026-07-07 06:29:20'),
(3, 1, '127.0.0.1', 'http://127.0.0.1:8000/transactions', 'POST', 'Create Transaction', '2026-07-07 06:29:47', '2026-07-07 06:29:47'),
(4, 1, '127.0.0.1', 'http://127.0.0.1:8000/transactions', 'POST', 'Create Transaction', '2026-07-07 06:30:19', '2026-07-07 06:30:19'),
(5, 1, '127.0.0.1', 'http://127.0.0.1:8000/transactions', 'POST', 'Create Transaction', '2026-07-07 06:30:51', '2026-07-07 06:30:51'),
(6, 1, '127.0.0.1', 'http://127.0.0.1:8000/transactions', 'POST', 'Create Transaction', '2026-07-07 06:31:27', '2026-07-07 06:31:27'),
(7, 1, '127.0.0.1', 'http://127.0.0.1:8000/login', 'POST', 'Create user session', '2026-07-07 06:43:02', '2026-07-07 06:43:02'),
(8, 2, '127.0.0.1', 'http://127.0.0.1:8000/profile', 'PATCH', 'Update User', '2026-07-07 06:43:56', '2026-07-07 06:43:56'),
(9, 2, '127.0.0.1', 'http://127.0.0.1:8000/transactions', 'POST', 'Create Transaction', '2026-07-07 06:53:07', '2026-07-07 06:53:07'),
(10, 2, '127.0.0.1', 'http://127.0.0.1:8000/transactions', 'POST', 'Create Transaction', '2026-07-07 07:07:21', '2026-07-07 07:07:21'),
(11, 2, '127.0.0.1', 'http://127.0.0.1:8000/transactions/7', 'PUT', 'Update Transaction', '2026-07-07 07:09:18', '2026-07-07 07:09:18'),
(12, 1, '127.0.0.1', 'http://127.0.0.1:9000/login', 'POST', 'Create user session', '2026-07-21 00:48:45', '2026-07-21 00:48:45'),
(13, 1, '127.0.0.1', 'http://127.0.0.1:9000/transactions', 'POST', 'Create Transaction', '2026-07-21 01:25:48', '2026-07-21 01:25:48');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Salary', '2026-07-21 01:19:00', NULL),
(2, 'Food', '2026-07-21 01:19:00', NULL),
(3, 'Rent', '2026-07-21 01:19:00', NULL),
(4, 'Shopping', '2026-07-21 01:19:00', NULL),
(5, 'Bills', '2026-07-21 01:19:00', NULL),
(6, 'Investment', '2026-07-21 01:19:00', NULL),
(7, 'Travel', '2026-07-21 01:19:00', NULL),
(8, 'Transportation', '2026-07-21 01:19:00', NULL),
(9, 'Entertainment', '2026-07-21 01:19:00', NULL),
(10, 'Health', '2026-07-21 01:19:00', NULL),
(11, 'Education', '2026-07-21 01:19:00', NULL),
(12, 'Insurance', '2026-07-21 01:19:00', NULL),
(13, 'Personal Care', '2026-07-21 01:19:00', NULL),
(14, 'Subsciptions', '2026-07-21 01:19:00', NULL),
(15, 'Taxes', '2026-07-21 01:19:00', NULL),
(16, 'Loan/EMI', '2026-07-21 01:19:00', NULL),
(17, 'Unplanned/Emergency', '2026-07-21 01:19:00', NULL),
(18, 'Gifts/Donations', '2026-07-21 01:19:00', NULL),
(19, 'Other', '2026-07-21 01:19:00', NULL);

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
(4, '2026_07_06_153519_create_transactions_table', 1),
(5, '2026_07_06_160732_create_categories_table', 1),
(6, '2026_07_07_074436_create_audit_logs_table', 1);

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
('S9k3kCYhZeTOFNmacffRHdEym8HNXWJckCRlFlc5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidk5ueHpaVGJiendWOEpHZk12elZiZGFKT2Y2Q0xUT2U3dWJTbGZHZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9kYXNoYm9hcmQ/cGFnZT0xIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1784622291);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `type` enum('income','expense') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'income',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `category_id`, `amount`, `transaction_date`, `note`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 100000.00, '2026-07-01', 'salary', 'income', '2026-07-07 06:29:20', '2026-07-07 06:29:20', NULL),
(2, 1, 2, 10000.00, '2026-07-02', 'food', 'expense', '2026-07-07 06:29:47', '2026-07-07 06:29:47', NULL),
(3, 1, 3, 10000.00, '2026-07-05', 'rent', 'expense', '2026-07-07 06:30:19', '2026-07-07 06:30:19', NULL),
(4, 1, 4, 15000.00, '2026-07-06', 'shopping', 'expense', '2026-07-07 06:30:51', '2026-07-07 06:30:51', NULL),
(5, 1, 6, 30000.00, '2026-07-03', 'home loan', 'expense', '2026-07-07 06:31:27', '2026-07-07 06:31:27', NULL),
(6, 2, 1, 200000.00, '2026-07-01', 'salary', 'income', '2026-07-07 06:53:07', '2026-07-07 06:53:07', NULL),
(7, 2, 5, 2000.00, '2026-07-02', 'light bill', 'expense', '2026-07-07 07:07:21', '2026-07-07 07:09:18', NULL),
(8, 1, 18, 3000.00, '2026-07-08', 'NGO Donation', 'expense', '2026-07-21 01:25:48', '2026-07-21 01:25:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Beacon Admin', 'hr@codium.tech', NULL, '$2y$12$gy9GkkczKTegBUfx1SMjGOZW87xT30npsaRvyk2VHMPwKzUpTldcu', NULL, '2026-07-07 06:28:25', NULL),
(2, 'Abhishek Kumar Mishra', 'annaaryan95@gmail.com', NULL, '$2y$12$svZe8um2fdkY3Sy.Sb.jbOonHk9OuQlEhu2YfZLcvW6PXPjZmM8xy', NULL, '2026-07-07 06:43:38', '2026-07-07 06:43:56');

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_index` (`user_id`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_transaction_date_index` (`transaction_date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
