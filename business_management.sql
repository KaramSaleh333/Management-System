-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 03:57 PM
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
-- Database: `business_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `products_details` text NOT NULL,
  `total_paid` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `agent_name`, `agent_id`, `products_details`, `total_paid`, `created_at`, `updated_at`) VALUES
(2, 'كرم صالح', 2, '{\"product3\":{\"id\":3,\"name\":\"\\u062a\\u064a\\u0634\\u0631\\u062a\",\"price\":\"400\",\"amount\":\"1\"},\"product1\":{\"id\":1,\"name\":\"\\u0628\\u0646\\u0637\\u0644\\u0648\\u0646 \\u062c\\u064a\\u0646\\u0632\",\"price\":\"350\",\"amount\":\"1\"}}', '750', '2024-07-02 14:26:33', '2024-07-02 14:26:33'),
(6, 'احمد سالم', 5, '{\"product1\":{\"id\":1,\"name\":\"\\u0628\\u0646\\u0637\\u0644\\u0648\\u0646 \\u062c\\u064a\\u0646\\u0632\",\"price\":\"350\",\"amount\":\"1\"}}', '350', '2024-07-03 12:50:50', '2024-07-03 12:50:50'),
(9, 'كرم صالح', 2, '{\"product3\":{\"id\":3,\"name\":\"\\u062a\\u064a\\u0634\\u0631\\u062a\",\"price\":\"400\",\"amount\":\"1\"}}', '400', '2024-07-04 16:31:55', '2024-07-04 16:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('asdad|127.0.0.1', 'i:1;', 1720210103),
('asdad|127.0.0.1:timer', 'i:1720210103;', 1720210103),
('karam_saleh12|127.0.0.1', 'i:1;', 1719596351),
('karam_saleh12|127.0.0.1:timer', 'i:1719596351;', 1719596351),
('karam|127.0.0.1', 'i:1;', 1719591609),
('karam|127.0.0.1:timer', 'i:1719591609;', 1719591609);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(7, '2024_06_28_193609_create_products_table', 2),
(8, '2024_07_01_150653_create_bills_table', 3),
(10, '2024_07_07_181007_create_transactions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `qr_image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `amount`, `image_path`, `qr_image_path`, `created_at`, `updated_at`) VALUES
(1, 'بنطلون جينز', '350', '2', 'products/8.jpg', 'qrcode/3.jpg', '2024-06-29 05:55:24', '2024-07-07 19:05:30'),
(3, 'تيشرت', '400', '4', 'products/10.jpg', 'qrcode/10.jpg', '2024-06-29 11:11:19', '2024-07-08 13:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UOgbjFyKxWTb66kEj5TxVa4c0jKlDXbLmUaIUieP', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZDBYVWFMR3VSTHRXTXNRUVloeFFicUdIVldndVZnZWpqUjhTN29lRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1720447019);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `transaction_name` varchar(255) NOT NULL,
  `transaction_details` text NOT NULL,
  `bill_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `agent_id`, `agent_name`, `transaction_name`, `transaction_details`, `bill_details`, `created_at`, `updated_at`) VALUES
(36, 2, 'كرم صالح', 'انشاء فاتورة جديدة', '{\"\\u0642\\u0628\\u0644\":[],\"\\u0628\\u0639\\u062f\":[\"\\u0627\\u0646\\u0634\\u0627\\u0621 \\u0641\\u0627\\u062a\\u0648\\u0631\\u0629 \\u062c\\u062f\\u064a\\u062f => 22\"]}', NULL, '2024-07-08 13:39:19', '2024-07-08 13:39:19'),
(37, 2, 'كرم صالح', 'حذف بيانات فاتورة', '{\"\\u0642\\u0628\\u0644\":[],\"\\u0628\\u0639\\u062f\":[\"\\u062d\\u0630\\u0641 \\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0627\\u0644\\u0641\\u0627\\u062a\\u0648\\u0631\\u0629 => 22\"]}', '{\"id\":22,\"agent_name\":\"\\u0643\\u0631\\u0645 \\u0635\\u0627\\u0644\\u062d\",\"agent_id\":2,\"products_details\":\"{\\\"product3\\\":{\\\"id\\\":3,\\\"name\\\":\\\"\\\\u062a\\\\u064a\\\\u0634\\\\u0631\\\\u062a\\\",\\\"price\\\":\\\"400\\\",\\\"amount\\\":\\\"1\\\"}}\",\"total_paid\":\"400\",\"created_at\":\"2024-07-08T13:39:19.000000Z\",\"updated_at\":\"2024-07-08T13:39:19.000000Z\"}', '2024-07-08 13:41:23', '2024-07-08 13:41:23'),
(38, 2, 'كرم صالح', 'تعديل علي بيانات الموظف', '{\"name\":\"\\u062d\\u0633\\u0646\",\"\\u0642\\u0628\\u0644\":{\"salary\":6000,\"updated_at\":\"2024-07-05T19:06:54.000000Z\"},\"\\u0628\\u0639\\u062f\":{\"salary\":\"5000\",\"updated_at\":\"2024-07-08T13:55:09.000000Z\"}}', NULL, '2024-07-08 13:55:09', '2024-07-08 13:55:09'),
(39, 2, 'كرم صالح', 'تعديل علي بيانات الموظف', '{\"name\":\"\\u062d\\u0633\\u0646\",\"\\u0642\\u0628\\u0644\":{\"role\":\"\\u0634\\u064a\\u0641\",\"salary\":5000,\"updated_at\":\"2024-07-08T13:55:09.000000Z\"},\"\\u0628\\u0639\\u062f\":{\"role\":\"sales\",\"salary\":\"6000\",\"updated_at\":\"2024-07-08T13:55:25.000000Z\"}}', NULL, '2024-07-08 13:55:25', '2024-07-08 13:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `role`, `salary`, `telephone`, `city`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'كرم صالح', 'karam_saleh123', 'المالك', 0, '01147998052', 'ابوالنمرس', '$2y$12$tYf5dp1r8A1gQn9JGi8hGe3xQZk6fxBVzAuxCbQvw0cAY1Icy1Ojy', NULL, '2024-06-28 13:56:57', '2024-06-28 13:56:57'),
(5, 'احمد سالم', 'ahmed_salem', 'كاشير', 4000, '01132244654', 'ابوالنمرس', '$2y$12$MKBf2Lj3nrJ.U.rA8pD6juJsMA8VqizU.ckt5.uiNuBowmLW9IPTi', NULL, '2024-06-28 15:15:20', '2024-06-28 15:15:20'),
(6, 'ماهر', 'maher_mohamed', 'عضو فريق', 3500, '01158878923', 'ابوالنمرس', '$2y$12$ziPLxP86Za6wC5xOjycaT.yBIhtr9vReX2/In7J/mlXgHQtd/Wv46', NULL, '2024-06-28 16:23:06', '2024-06-30 09:51:42'),
(8, 'حسن', 'hassan_farh', 'sales', 6000, '01187560912', 'ابوالنمرس', '$2y$12$PvPlK.p4u0Qnp9q.XAp3x.zFQFfel5RxVTyoc3WNOShIpNk0HKJE.', NULL, '2024-07-05 19:06:54', '2024-07-08 13:55:25'),
(17, 'محمد صالح', 'mohamed_saleh', 'محاسب', 15000, '01122387111', 'ابوالنمرس', '$2y$12$bf6afQ/.dpSCEzG0yyuvjeTHANMm3RTIV2ipyli.HIKosn16jCF.S', NULL, '2024-07-07 18:48:53', '2024-07-07 18:49:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
