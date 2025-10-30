-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 07:35 AM
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
-- Database: `secure_me_app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '$2y$12$tQFRv8W3Gyj7HIF0toYr9.31L4PgXfnghR0lF9k6yVASHJAm/g9tq', '2025-08-17 14:00:32', '2025-08-17 14:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `emergency_groups`
--

CREATE TABLE `emergency_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `signal_id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_group_members`
--

CREATE TABLE `emergency_group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `joined_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_responses`
--

CREATE TABLE `emergency_responses` (
  `id` bigint(20) NOT NULL,
  `signal_id` bigint(20) NOT NULL,
  `responder_type` enum('helper','police','admin') NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `response_action` varchar(255) NOT NULL,
  `response_notes` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT 'pending',
  `responded` tinyint(1) NOT NULL DEFAULT 0,
  `notified_at` timestamp NULL DEFAULT NULL,
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_responses`
--

INSERT INTO `emergency_responses` (`id`, `signal_id`, `responder_type`, `user_id`, `response_action`, `response_notes`, `status`, `responded`, `notified_at`, `responded_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'helper', 1, 'Reached the location', 'Helper arrived at the location and provided first aid.', 'completed', 0, NULL, NULL, '2025-08-27 16:15:05', '2025-08-27 16:15:05'),
(2, 3, 'police', 1, 'Dispatched unit', 'Police unit dispatched to the location.', 'in_progress', 0, NULL, NULL, '2025-08-27 16:15:05', '2025-08-27 16:15:05'),
(3, 1, 'helper', 1, 'Notification sent', 'Helper received the emergency signal but has not yet reached.', 'pending', 0, NULL, NULL, '2025-08-27 16:15:05', '2025-08-27 16:15:05'),
(4, 3, 'admin', 1, 'Reviewed alert', 'Admin verified the alert and marked it as genuine.', 'completed', 0, NULL, NULL, '2025-08-27 16:15:05', '2025-08-27 16:15:05'),
(5, 1, 'police', 1, 'Case closed', 'Police confirmed the emergency was resolved.', 'completed', 0, NULL, NULL, '2025-08-27 16:15:05', '2025-08-27 16:15:05'),
(6, 1, 'helper', 1, 'Reached the location', 'Helper arrived at the location and provided first aid.', 'completed', 0, NULL, NULL, '2025-08-27 16:32:15', '2025-08-27 16:32:15'),
(7, 3, 'police', 1, 'Dispatched unit', 'Police unit dispatched to the location.', 'in_progress', 0, NULL, NULL, '2025-08-27 16:32:15', '2025-08-27 16:32:15'),
(8, 1, 'helper', 1, 'Notification sent', 'Helper received the emergency signal but has not yet reached.', 'pending', 0, NULL, NULL, '2025-08-27 16:32:15', '2025-08-27 16:32:15'),
(9, 3, 'admin', 1, 'Reviewed alert', 'Admin verified the alert and marked it as genuine.', 'completed', 0, NULL, NULL, '2025-08-27 16:32:15', '2025-08-27 16:32:15'),
(10, 1, 'police', 1, 'Case closed', 'Police confirmed the emergency was resolved.', 'completed', 0, NULL, NULL, '2025-08-27 16:32:15', '2025-08-27 16:32:15'),
(11, 1, 'helper', 1, 'Reached the location', 'Helper arrived at the location and provided first aid.', 'completed', 0, NULL, NULL, '2025-08-27 16:32:34', '2025-08-27 16:32:34'),
(12, 3, 'police', 1, 'Dispatched unit', 'Police unit dispatched to the location.', 'in_progress', 0, NULL, NULL, '2025-08-27 16:32:34', '2025-08-27 16:32:34'),
(13, 1, 'helper', 1, 'Notification sent', 'Helper received the emergency signal but has not yet reached.', 'pending', 0, NULL, NULL, '2025-08-27 16:32:34', '2025-08-27 16:32:34'),
(14, 3, 'admin', 1, 'Reviewed alert', 'Admin verified the alert and marked it as genuine.', 'completed', 0, NULL, NULL, '2025-08-27 16:32:34', '2025-08-27 16:32:34'),
(15, 1, 'police', 1, 'Case closed', 'Police confirmed the emergency was resolved.', 'completed', 0, NULL, NULL, '2025-08-27 16:32:34', '2025-08-27 16:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_signals`
--

CREATE TABLE `emergency_signals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `signal_id` varchar(100) NOT NULL,
  `signal_status` enum('Active','Resolved') DEFAULT 'Active',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `search_radius` int(11) NOT NULL DEFAULT 50,
  `response_count` int(11) NOT NULL DEFAULT 0,
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_signals`
--

INSERT INTO `emergency_signals` (`id`, `user_id`, `signal_id`, `signal_status`, `latitude`, `longitude`, `search_radius`, `response_count`, `responded_at`, `created_at`, `updated_at`) VALUES
(14, 1, 'SIG-20250927-68D7DCC6E37D5', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-27 07:17:02', '2025-09-27 07:17:02'),
(15, 1, 'SIG-20250928-68D9092CA3D40', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 04:38:44', '2025-09-28 04:38:44'),
(16, 1, 'SIG-20250928-68D90F85E6365', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:05:49', '2025-09-28 05:05:49'),
(17, 1, 'SIG-20250928-68D9119685CC8', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:14:38', '2025-09-28 05:14:38'),
(18, 1, 'SIG-20250928-68D911CC89326', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:15:32', '2025-09-28 05:15:32'),
(19, 1, 'SIG-20250928-68D911FD2C5A0', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:16:21', '2025-09-28 05:16:21'),
(20, 1, 'SIG-20250928-68D9137FB4EA8', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:22:47', '2025-09-28 05:22:47'),
(21, 1, 'SIG-20250928-68D9139BC3D25', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:23:15', '2025-09-28 05:23:15'),
(22, 1, 'SIG-20250928-68D913ACC474B', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:23:32', '2025-09-28 05:23:32'),
(23, 1, 'SIG-20250928-68D9178D087DD', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:40:05', '2025-09-28 05:40:05'),
(24, 1, 'SIG-20250928-68D91AB28183F', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:53:30', '2025-09-28 05:53:30'),
(25, 1, 'SIG-20250928-68D91ACC013B2', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:53:56', '2025-09-28 05:53:56'),
(26, 1, 'SIG-20250928-68D91AF68C55D', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:54:38', '2025-09-28 05:54:38'),
(27, 1, 'SIG-20250928-68D91B163382D', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:55:10', '2025-09-28 05:55:10'),
(28, 1, 'SIG-20250928-68D91B31AC5F0', 'Active', 19.07600000, 72.87770000, 50, 0, NULL, '2025-09-28 05:55:37', '2025-09-28 05:55:37');

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
(4, '2025_09_07_110940_create_personal_access_tokens_table', 2),
(5, '2025_09_13_094247_create_personal_access_tokens_table', 3),
(6, '2025_09_27_132614_create_emergency_groups_table', 3),
(7, '2025_09_27_132716_create_emergency_group_members_table', 3);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('3k2lSTumZmjM8FUHw8OQmdWaCCyhS2Re3zOsFUIU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjlmeWtmMmJDSVJ1eTZOdXFESWZKRFB6RjdtV2J1NFY0R1BwOTc5NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758971822),
('JJJjVIiVWHbL1L3m313mOWN8Y30xru8w31WdwtTt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR3hiTWNsQ2k2U1BpSHJxdXUwcHhKZGs2Z3Q2UkdOb2N4Tm5tNlN1TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoiYWRtaW5faWQiO2k6MTtzOjExOiJhZG1pbl9lbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjt9', 1757761518),
('K02qhMOdmUj3SYCZH7r9MqW4zUZSXlvhygUQW4k3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjMxa2dwaWNkd2FreEdRck1HSW9ydEVXV09FSTNxWHdNZ2REdWVNeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1sb2dpbiI7fX0=', 1757766387),
('mLWMnSGFyvTzTre27Ffh7nuRAx8gLFHDdC8zo3Ua', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWtSRDZscnp5YjB6MFE1T3kzYjExZHp3S3NtQjlLak9oTWVaUk5mVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1sb2dpbiI7fX0=', 1759054083),
('nYDQHvea7Uzfw34JMpXSZc0BxIJKMF1w6vn2nZ2i', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEw0aDVHMGQwUU5jNFQ2M1gya1J1Tm1SaVlUZ1JVNlZaSzlVMGdBUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1757845170),
('PJcm3jL9QjY9LqC1PcG8Ml0d6W2CCKmtI50I6KUq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib3ZhZkoxS0lac2UyNTZiaFZpRFl1ek92QWY3dFl4RDhHcVByc21GdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnRzLWFuZC1sb2dzIjt9czo4OiJhZG1pbl9pZCI7aToxO3M6MTE6ImFkbWluX2VtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO30=', 1757866459),
('UANV8mwGYxltak0NylofF1G4NudWz8BACVD0HSK1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZkdWRFhLZFZBeVBPclg1aVJkMXZkWFdyZUoyNmtMUmpRV3hUbWR4YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjg6ImFkbWluX2lkIjtpOjE7czoxMToiYWRtaW5fZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7fQ==', 1758971832),
('wLwnf6vtMat5ipelAPMTxtQAE0nGEdh0C0rlhCVR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibHlCRURkMnN0aTlTZTlmZDhnWnkxNmtWRjFPN3ZUSkpNRUFockt0ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6ODoiYWRtaW5faWQiO2k6MTtzOjExOiJhZG1pbl9lbWFpbCI7czoxNToiYWRtaW5AZ21haWwuY29tIjt9', 1757768237),
('X6Wqke0lve4SEHIfuU8OzStN333GKyh1wMTHjRFz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWmh5dmhRYmRydURka1I3QkVnaTFEbFI0bGJCRjNjUlpYUWp5MDEzMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hbGwtZW1lcmdlbmN5LXNpZ25hbHMiO31zOjg6ImFkbWluX2lkIjtpOjE7czoxMToiYWRtaW5fZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7fQ==', 1759054138),
('XsMs5kY1Sbwyb0yEbgh6IriYn2ZUw6euDJP59ARN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOGFjMURnbmhUZkc5VE5Bc21DU00wYmFRQ2pVRGQ3dEx0QjR6OUx6TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1sb2dpbiI7fX0=', 1757767061),
('ykXzZlQRK9ALwJuvJnrdnNDzrAQk2A1kSOthj7gf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmNIUFNTWjhxaTZEMmViQjVrZXZHNmZKVlJ5TzNpS3FNYUNadGdHNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hZG1pbi1sb2dpbiI7fX0=', 1757864228),
('YZ8pRXH2zNRwf6YrKEzfciIgFaAJ7oygQTt5B7s9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMWRqRDVPanJHU3ZHc1o2TGtHUTNGOWJFTUlST2JQQ3ptMUNLYjZuNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnRzLWFuZC1sb2dzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJhZG1pbl9pZCI7aToxO3M6MTE6ImFkbWluX2VtYWlsIjtzOjE1OiJhZG1pbkBnbWFpbC5jb20iO30=', 1757845333);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(200) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_role`, `name`, `email`, `email_verified_at`, `password`, `phone_no`, `remember_token`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'police', 'Sachin Darkunde', 'sachin@gmail.com', NULL, 'sachin@6060', '7887685967', NULL, NULL, '2025-08-07 16:28:40', NULL),
(2, 'Manager', 'Priya Sharma', 'priya@example.com', NULL, 'password123', '9876543211', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(3, 'User', 'Rahul Patil', 'rahul@example.com', NULL, 'password123', '9876543212', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(4, 'User', 'Anjali Mehta', 'anjali@example.com', NULL, 'password123', '9876543213', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(5, 'Admin', 'Vikas Gupta', 'vikas@example.com', NULL, 'password123', '9876543214', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(6, 'Manager', 'Rohit Verma', 'rohit@example.com', NULL, 'password123', '9876543215', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(7, 'User', 'Sneha Kulkarni', 'sneha@example.com', NULL, 'password123', '9876543216', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(8, 'User', 'Amit Joshi', 'amit@example.com', NULL, 'password123', '9876543217', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(9, 'Admin', 'Neha Singh', 'neha@example.com', NULL, 'password123', '9876543218', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(10, 'User', 'Karan Malhotra', 'karan@example.com', NULL, 'password123', '9876543219', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(11, 'Manager', 'Pooja Desai', 'pooja@example.com', NULL, 'password123', '9876543220', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(12, 'User', 'Arjun Reddy', 'arjun@example.com', NULL, 'password123', '9876543221', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(13, 'User', 'Simran Kaur', 'simran@example.com', NULL, 'password123', '9876543222', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(14, 'Admin', 'Manoj Kumar', 'manoj@example.com', NULL, 'password123', '9876543223', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(15, 'User', 'Divya Nair', 'divya@example.com', NULL, 'password123', '9876543224', NULL, NULL, '2025-08-21 16:32:30', '2025-08-21 16:32:30'),
(16, 'admin', 'Sachin', 'sachin@test.com', NULL, '$2y$12$4YMa3YmICOgT2OwrxdCbS.6.TQW58iCdHSz3kjJspVqdOyvaSF4WG', '9999999999', NULL, NULL, '2025-09-07 07:46:20', '2025-09-07 07:46:20'),
(17, 'police', 'vaibhav Diwate', 'vaibhav@test.com', NULL, '$2y$12$jT.c2E4ZXMuwAcneggQ8GeRL/ZlMKrHUYpl2Xxz.y15oPPnfTTEuC', '8003396060', NULL, NULL, '2025-09-07 07:53:39', '2025-09-07 07:53:39'),
(18, 'police', 'Sachin', 'sachin@example.com', NULL, '$2y$12$y./ovBYsBgsyE51TOZnmNOr2FUUb0lLL8nA2yNPZeGFl8Q/Sj1/5a', '1234567890', NULL, NULL, '2025-09-13 03:40:32', '2025-09-13 03:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_family_details`
--

CREATE TABLE `user_family_details` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `relation` varchar(200) NOT NULL,
  `age` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_family_details`
--

INSERT INTO `user_family_details` (`id`, `user_id`, `name`, `relation`, `age`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vaibhav Diwate', 'Brother', 22, '2025-08-26 13:59:00', '2025-08-26 13:59:00'),
(2, 1, 'Vahid Inamdar', 'Brother', 22, '2025-08-26 14:09:37', '2025-08-26 14:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- Indexes for table `emergency_groups`
--
ALTER TABLE `emergency_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergency_groups_signal_id_foreign` (`signal_id`);

--
-- Indexes for table `emergency_group_members`
--
ALTER TABLE `emergency_group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergency_group_members_group_id_foreign` (`group_id`),
  ADD KEY `emergency_group_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_signals`
--
ALTER TABLE `emergency_signals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `signal_id` (`signal_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_family_details`
--
ALTER TABLE `user_family_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_locations_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emergency_groups`
--
ALTER TABLE `emergency_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_group_members`
--
ALTER TABLE `emergency_group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `emergency_signals`
--
ALTER TABLE `emergency_signals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_family_details`
--
ALTER TABLE `user_family_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_groups`
--
ALTER TABLE `emergency_groups`
  ADD CONSTRAINT `emergency_groups_signal_id_foreign` FOREIGN KEY (`signal_id`) REFERENCES `emergency_signals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emergency_group_members`
--
ALTER TABLE `emergency_group_members`
  ADD CONSTRAINT `emergency_group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `emergency_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emergency_group_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD CONSTRAINT `user_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
