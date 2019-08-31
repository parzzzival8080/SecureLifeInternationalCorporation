-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2019 at 06:34 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securelifetest`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_queues`
--

CREATE TABLE `current_queues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue_id` bigint(20) UNSIGNED NOT NULL,
  `queue_count` int(11) NOT NULL,
  `exit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diamond_queues`
--

CREATE TABLE `diamond_queues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exit` int(11) NOT NULL,
  `exited` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genealogies`
--

CREATE TABLE `genealogies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `referal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genealogies`
--

INSERT INTO `genealogies` (`id`, `user_id`, `reference_id`, `referal_id`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'Root', '2019-08-31 16:32:30', '2019-08-31 16:32:30'),
(2, 2, 1, 1, 'Left', '2019-08-31 16:32:36', '2019-08-31 16:32:36'),
(3, 3, 1, 1, 'Right', '2019-08-31 16:32:41', '2019-08-31 16:32:41'),
(4, 4, 2, 2, 'Left', '2019-08-31 16:32:48', '2019-08-31 16:32:48'),
(5, 5, 2, 2, 'Right', '2019-08-31 16:32:58', '2019-08-31 16:32:58'),
(6, 6, 3, 3, 'Left', '2019-08-31 16:33:06', '2019-08-31 16:33:06'),
(7, 7, 3, 3, 'Right', '2019-08-31 16:33:12', '2019-08-31 16:33:12'),
(8, 8, 4, 4, 'Left', '2019-08-31 16:33:23', '2019-08-31 16:33:23'),
(9, 9, 4, 4, 'Right', '2019-08-31 16:33:29', '2019-08-31 16:33:29'),
(10, 10, 5, 5, 'Left', '2019-08-31 16:33:36', '2019-08-31 16:33:36'),
(11, 11, 5, 5, 'Right', '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(12, 12, 6, 6, 'Left', '2019-08-31 16:33:47', '2019-08-31 16:33:47'),
(13, 13, 6, 6, 'Right', '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(14, 14, 7, 7, 'Left', '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(15, 15, 7, 7, 'Right', '2019-08-31 16:34:06', '2019-08-31 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `genealogy_match_logs`
--

CREATE TABLE `genealogy_match_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `genealogy_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genealogy_match_logs`
--

INSERT INTO `genealogy_match_logs` (`id`, `user_id`, `genealogy_id`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'New Match!', '2019-08-31 16:32:41', '2019-08-31 16:32:41'),
(2, 1, 2, 'New Match!', '2019-08-31 16:32:58', '2019-08-31 16:32:58'),
(3, 1, 1, 'New Match!', '2019-08-31 16:33:06', '2019-08-31 16:33:06'),
(4, 1, 3, 'New Match!', '2019-08-31 16:33:12', '2019-08-31 16:33:12'),
(5, 1, 1, 'New Match!', '2019-08-31 16:33:12', '2019-08-31 16:33:12'),
(6, 1, 4, 'New Match!', '2019-08-31 16:33:29', '2019-08-31 16:33:29'),
(7, 1, 2, 'New Match!', '2019-08-31 16:33:36', '2019-08-31 16:33:36'),
(8, 1, 5, 'New Match!', '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(9, 1, 2, 'New Match!', '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(10, 1, 1, 'New Match!', '2019-08-31 16:33:47', '2019-08-31 16:33:47'),
(11, 1, 6, 'New Match!', '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(12, 1, 1, 'New Match!', '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(13, 1, 3, 'New Match!', '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(14, 1, 1, 'New Match!', '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(15, 1, 7, 'New Match!', '2019-08-31 16:34:06', '2019-08-31 16:34:06'),
(16, 1, 3, 'New Match!', '2019-08-31 16:34:06', '2019-08-31 16:34:06'),
(17, 1, 1, 'New Match!', '2019-08-31 16:34:06', '2019-08-31 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `genealogy_match_points`
--

CREATE TABLE `genealogy_match_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genealogy_id` bigint(20) UNSIGNED NOT NULL,
  `matches` bigint(20) NOT NULL DEFAULT 0,
  `flushed_out_matches` bigint(20) NOT NULL DEFAULT 0,
  `product_points` double NOT NULL DEFAULT 0,
  `incentives_points` bigint(20) NOT NULL DEFAULT 0,
  `left_group_sales_points` double NOT NULL DEFAULT 0,
  `right_group_sales_points` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genealogy_match_points`
--

INSERT INTO `genealogy_match_points` (`id`, `genealogy_id`, `matches`, `flushed_out_matches`, `product_points`, `incentives_points`, `left_group_sales_points`, `right_group_sales_points`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 0, 0, 0, 0, 0, '2019-08-31 16:32:30', '2019-08-31 16:34:06'),
(2, 2, 3, 0, 0, 0, 0, 0, '2019-08-31 16:32:36', '2019-08-31 16:33:41'),
(3, 3, 3, 0, 0, 0, 0, 0, '2019-08-31 16:32:41', '2019-08-31 16:34:06'),
(4, 4, 1, 0, 0, 0, 0, 0, '2019-08-31 16:32:48', '2019-08-31 16:33:29'),
(5, 5, 1, 0, 0, 0, 0, 0, '2019-08-31 16:32:58', '2019-08-31 16:33:41'),
(6, 6, 1, 0, 0, 0, 0, 0, '2019-08-31 16:33:06', '2019-08-31 16:33:52'),
(7, 7, 1, 0, 0, 0, 0, 0, '2019-08-31 16:33:12', '2019-08-31 16:34:06'),
(8, 8, 0, 0, 0, 0, 0, 0, '2019-08-31 16:33:23', '2019-08-31 16:33:23'),
(9, 9, 0, 0, 0, 0, 0, 0, '2019-08-31 16:33:29', '2019-08-31 16:33:29'),
(10, 10, 0, 0, 0, 0, 0, 0, '2019-08-31 16:33:36', '2019-08-31 16:33:36'),
(11, 11, 0, 0, 0, 0, 0, 0, '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(12, 12, 0, 0, 0, 0, 0, 0, '2019-08-31 16:33:47', '2019-08-31 16:33:47'),
(13, 13, 0, 0, 0, 0, 0, 0, '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(14, 14, 0, 0, 0, 0, 0, 0, '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(15, 15, 0, 0, 0, 0, 0, 0, '2019-08-31 16:34:06', '2019-08-31 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `group_sales_logs`
--

CREATE TABLE `group_sales_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genealogy_id` bigint(20) UNSIGNED NOT NULL,
  `matches` bigint(20) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informations`
--

CREATE TABLE `informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informations`
--

INSERT INTO `informations` (`id`, `user_id`, `firstname`, `lastname`, `mi`, `photo`, `address`, `birthdate`, `contact`, `created_at`, `updated_at`) VALUES
(1, 1, 'SecureLife01', 'SecureLife01', '', 'utin.png', '', '', '', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(2, 2, 'SecureLife02', 'SecureLife02', '', 'utin.png', '', '', '', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(3, 3, 'SecureLife03', 'SecureLife03', '', 'utin.png', '', '', '', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(4, 4, 'SecureLife04', 'SecureLife04', '', 'utin.png', '', '', '', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(5, 5, 'SecureLife05', 'SecureLife05', '', 'utin.png', '', '', '', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(6, 6, 'SecureLife06', 'SecureLife06', '', 'utin.png', '', '', '', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(7, 7, 'SecureLife07', 'SecureLife07', '', 'utin.png', '', '', '', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(8, 8, 'Amalia', 'Amalia', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(9, 9, 'Cotton', 'Cotton', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(10, 10, 'Doris', 'Doris', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(11, 11, 'Emilia', 'Emilia', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(12, 12, 'Angeline', 'Angeline', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(13, 13, 'Holland', 'Holland', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(14, 14, 'Luella', 'Luella', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(15, 15, 'Rosemary', 'Rosemary', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(16, 16, 'Roberts', 'Roberts', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(17, 17, 'Rosario', 'Rosario', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(18, 18, 'Espinoza', 'Espinoza', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(19, 19, 'Sheena', 'Sheena', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(20, 20, 'Christian', 'Christian', '', 'utin.png', '', '', '', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(21, 21, 'Wells', 'Wells', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(22, 22, 'Peck', 'Peck', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(23, 23, 'Winifred', 'Winifred', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(24, 24, 'Leon', 'Leon', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(25, 25, 'Carney', 'Carney', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(26, 26, 'Valerie', 'Valerie', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(27, 27, 'Lucy', 'Lucy', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(28, 28, 'Barbra', 'Barbra', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(29, 29, 'Johnson', 'Johnson', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(30, 30, 'Holmes', 'Holmes', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(31, 31, 'Fisher', 'Fisher', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(32, 32, 'Deborah', 'Deborah', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(33, 33, 'Mckee', 'Mckee', '', 'utin.png', '', '', '', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(34, 34, 'Emily', 'Emily', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(35, 35, 'Lawson', 'Lawson', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(36, 36, 'Rivera', 'Rivera', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(37, 37, 'Alexandria', 'Alexandria', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(38, 38, 'Jefferson', 'Jefferson', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(39, 39, 'Weiss', 'Weiss', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(40, 40, 'Ethel', 'Ethel', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(41, 41, 'Jenny', 'Jenny', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(42, 42, 'Miranda', 'Miranda', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(43, 43, 'Kate', 'Kate', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(44, 44, 'Anderson', 'Anderson', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(45, 45, 'Norman', 'Norman', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(46, 46, 'Murray', 'Murray', '', 'utin.png', '', '', '', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(47, 47, 'Jody', 'Jody', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(48, 48, 'Leola', 'Leola', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(49, 49, 'Elvia', 'Elvia', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(50, 50, 'Hillary', 'Hillary', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(51, 51, 'Bessie', 'Bessie', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(52, 52, 'Kerry', 'Kerry', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(53, 53, 'Weaver', 'Weaver', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(54, 54, 'Gillespie', 'Gillespie', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(55, 55, 'Nelson', 'Nelson', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(56, 56, 'Woodard', 'Woodard', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(57, 57, 'Hartman', 'Hartman', '', 'utin.png', '', '', '', '2019-08-31 16:31:08', '2019-08-31 16:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `investment` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_12_150000_create_users_table', 1),
(2, '2019_08_12_150001_create_genealogies_table', 1),
(3, '2019_08_13_172455_create_genealogy_match_points_table', 1),
(4, '2019_08_13_172526_create_genealogy_match_logs_table', 1),
(5, '2019_08_13_172718_create_products_table', 1),
(6, '2019_08_13_172748_create_user_product_logs_table', 1),
(7, '2019_08_13_172836_create_group_sales_logs_table', 1),
(8, '2019_08_13_172904_create_user_account_statuses_table', 1),
(9, '2019_08_19_181626_create_informations_table', 1),
(10, '2019_08_19_182517_create_diamond_queues_table', 1),
(11, '2019_08_19_183142_create_current_queues_table', 1),
(12, '2019_08_19_184121_create_requests_table', 1),
(13, '2019_08_19_185055_create_sponsorships_table', 1),
(14, '2019_08_19_185447_create_wallets_table', 1),
(15, '2019_08_19_185751_create_wallet_logs_table', 1),
(16, '2019_08_19_185922_create_keys_table', 1),
(17, '2019_08_19_190415_create_notifications_table', 1),
(18, '2019_08_19_190429_create_roles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `request_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `investment` bigint(20) NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `role_id`, `type`, `status`, `code`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SecureLife01', 'SecureLife01@SecureLife.com', 'SecureLife01', 2, 'bronze', 'active', 'SLB-1001', NULL, '$2y$10$tXoukDzdNz/VOfs5O0otTu6jSjEKNtGJiJ2QFRhyuwgEZfIvEC6w2', NULL, '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(2, 'SecureLife02', 'SecureLife02@SecureLife.com', 'SecureLife02', 2, 'bronze', 'active', 'SLB-1002', NULL, '$2y$10$LelpxfpJNTCMCcoXf0O4v.hKHiPeZ6HK/vSVdLsBWGzb3MNnpB0pG', NULL, '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(3, 'SecureLife03', 'SecureLife03@SecureLife.com', 'SecureLife03', 2, 'bronze', 'active', 'SLB-1003', NULL, '$2y$10$wdQGi8VHURdY4Eec/HRnauOy1ILxBQl0pc5XX/ANFlYlw/ciBJ7cG', NULL, '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(4, 'SecureLife04', 'SecureLife04@SecureLife.com', 'SecureLife04', 2, 'bronze', 'active', 'SLB-1004', NULL, '$2y$10$F7B8ySaDk4oaQ2Gz9TkWceKe4hfSEDcjBhFkbkLbTeotkicHuN2sq', NULL, '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(5, 'SecureLife05', 'SecureLife05@SecureLife.com', 'SecureLife05', 2, 'bronze', 'active', 'SLB-1005', NULL, '$2y$10$FyyUuH09KeX1yKKxkdAefOXR2hNrSuOM746vpbVKUg1FxQO/m67Pe', NULL, '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(6, 'SecureLife06', 'SecureLife06@SecureLife.com', 'SecureLife06', 2, 'bronze', 'active', 'SLB-1006', NULL, '$2y$10$sCb0dcT0m2Uwko.gEq98vuvu11oPJgouRJ68v1BxYDaNf8Y.G8pna', NULL, '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(7, 'SecureLife07', 'SecureLife07@SecureLife.com', 'SecureLife07', 2, 'bronze', 'active', 'SLB-1007', NULL, '$2y$10$tO2aB2taQLr61WZrAzLQ4ufRmUKkvlfP6vVFEG9D51i7WD0MvM9uS', NULL, '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(8, 'Amalia Carpenter', 'amaliacarpenter@baluba.com', 'Amalia Carpenter', 2, 'bronze', 'active', 'SLB-1008', NULL, '$2y$10$BKHKmI669qz7uAIDl5uOeeeRio2npy4DQOWQaMM7W23Of8PDQCroq', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(9, 'Cotton Bush', 'cottonbush@baluba.com', 'Cotton Bush', 2, 'bronze', 'active', 'SLB-1009', NULL, '$2y$10$M.NWKOyAJZF49v8/T6ZxIeZIYlDyE61MzlfMfvzyebg2ibETjrwIi', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(10, 'Doris Obrien', 'dorisobrien@baluba.com', 'Doris Obrien', 2, 'bronze', 'active', 'SLB-1010', NULL, '$2y$10$6TIG1SSBA4U4CWyN2VpsqufUrDZiYxUcg.NJ1zGf1JjJnb9FDSH6e', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(11, 'Emilia Hernandez', 'emiliahernandez@baluba.com', 'Emilia Hernandez', 2, 'bronze', 'active', 'SLB-1011', NULL, '$2y$10$Zd3bB/xD6.f1eHl0/JocdeYgZ8u9gXWqZDzBOLXvml6I3rFCRYwu.', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(12, 'Angeline Turner', 'angelineturner@baluba.com', 'Angeline Turner', 2, 'bronze', 'active', 'SLB-1012', NULL, '$2y$10$cGSk0Kz45/UghdIg3QNNBe1EEQrD8tsRGlU2CVH24xKbyqDR.xThm', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(13, 'Holland Hines', 'hollandhines@baluba.com', 'Holland Hines', 2, 'bronze', 'active', 'SLB-1013', NULL, '$2y$10$okfcb.S6QQVVhP3bwLLXOOe2XqKvefYshUoQ6qQaCJ59IqbwJ3.Te', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(14, 'Luella Petty', 'luellapetty@baluba.com', 'Luella Petty', 2, 'bronze', 'active', 'SLB-1014', NULL, '$2y$10$WjNRw5HjSOkvub9E0bJHZOm89cbcweqgk8Io6ZNaFmTHMn1u04O7i', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(15, 'Rosemary Morse', 'rosemarymorse@baluba.com', 'Rosemary Morse', 2, 'bronze', 'active', 'SLB-1015', NULL, '$2y$10$F7rE66WSRk7se8uI4XNDSuPfgmS2X6UqBuppjRc1ugbXz2ELREoNq', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(16, 'Roberts Lee', 'robertslee@baluba.com', 'Roberts Lee', 2, 'bronze', 'active', 'SLB-1016', NULL, '$2y$10$bKlMrtwF.ejCwJIMSJ8BEu8yBwDwJJgKHFqME39c56VVvj3xn/c2e', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(17, 'Rosario Barton', 'rosariobarton@baluba.com', 'Rosario Barton', 2, 'bronze', 'active', 'SLB-1017', NULL, '$2y$10$oDr8auRfapS58Jg89X5SgeBT/9xnxT9ih77syWULwzS.sJ5qzH.oC', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(18, 'Espinoza Espinoza', 'espinozaespinoza@baluba.com', 'Espinoza Espinoza', 2, 'bronze', 'active', 'SLB-1018', NULL, '$2y$10$6GV5Xfkf/xEljdTdcOUr8O8y3p4VV9WlGg6fRRcNQ8a3LufaA8MKW', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(19, 'Sheena Camacho', 'sheenacamacho@baluba.com', 'Sheena Camacho', 2, 'bronze', 'active', 'SLB-1019', NULL, '$2y$10$xgM37c31nEV4qy21Fyf0k.Spk6ToFC1davZMgkQkoa9FAs8GXZhcS', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(20, 'Christian Kennedy', 'christiankennedy@baluba.com', 'Christian Kennedy', 2, 'bronze', 'active', 'SLB-1020', NULL, '$2y$10$hsBq7cQMqqVvbCMKzY/tEeGxGKOqeBTRgEW0joMKPpOUGLt2iIMf.', NULL, '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(21, 'Wells King', 'wellsking@baluba.com', 'Wells King', 2, 'bronze', 'active', 'SLB-1021', NULL, '$2y$10$Al2wwdXMukf9uzIZFvoquurukb1RDu92taztOnbEWpaVTdD/lyMBq', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(22, 'Peck Rodgers', 'peckrodgers@baluba.com', 'Peck Rodgers', 2, 'bronze', 'active', 'SLB-1022', NULL, '$2y$10$igc6GVepzScb2XEPAwmVVOMLRCk/l8naVLPRetiGiwqRzXQ7UQj/i', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(23, 'Winifred Kent', 'winifredkent@baluba.com', 'Winifred Kent', 2, 'bronze', 'active', 'SLB-1023', NULL, '$2y$10$.UoudjB9HCIma4jPz2dBgOkSG81Bblpu4sVlzdak/6xAh1W73u5Ua', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(24, 'Leon Newman', 'leonnewman@baluba.com', 'Leon Newman', 2, 'bronze', 'active', 'SLB-1024', NULL, '$2y$10$TFXfTFVva9WQZOrKdnx0tOPQe3utDGq4EhpXySds0HZWusXX5mVX.', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(25, 'Carney Russo', 'carneyrusso@baluba.com', 'Carney Russo', 2, 'bronze', 'active', 'SLB-1025', NULL, '$2y$10$k.WNwDGGdBwADtYNEf9Qhe6StaECNuV/Vr5X9UhBKTm8FQqcrQJc.', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(26, 'Valerie Francis', 'valeriefrancis@baluba.com', 'Valerie Francis', 2, 'bronze', 'active', 'SLB-1026', NULL, '$2y$10$KcoHboVhptGQQu5yNvHTYegxCXg/6nnuF7r2NiWqPnAwbKGvT0lVq', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(27, 'Lucy Wade', 'lucywade@baluba.com', 'Lucy Wade', 2, 'bronze', 'active', 'SLB-1027', NULL, '$2y$10$f2WpDmk90gx3TS4jX0aeXuIuWG/Z4mjj.yYKY4lKgcx5UAI9yB8wS', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(28, 'Barbra Navarro', 'barbranavarro@baluba.com', 'Barbra Navarro', 2, 'bronze', 'active', 'SLB-1028', NULL, '$2y$10$mCzOG.PtjTaLrN1uUkL/Ou/xczROhRBbFXsAf2JF9y.hT7wHCLD1a', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(29, 'Johnson Saunders', 'johnsonsaunders@baluba.com', 'Johnson Saunders', 2, 'bronze', 'active', 'SLB-1029', NULL, '$2y$10$8ysrmUEwQ9NBLfO0FN2UAuiot.13JN1EkswZP5tvPd5ufp6WQ.lNy', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(30, 'Holmes Lewis', 'holmeslewis@baluba.com', 'Holmes Lewis', 2, 'bronze', 'active', 'SLB-1030', NULL, '$2y$10$PRL9Zir.DbkTVir2BCsbQewuhv30uBHBF6m/vcxkqOCZ7FS4S3aOO', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(31, 'Fisher Russell', 'fisherrussell@baluba.com', 'Fisher Russell', 2, 'bronze', 'active', 'SLB-1031', NULL, '$2y$10$.52xze40Qjg5IYd/jM43NO2rXkqOnUYWu.ygq9OF4frNqS0OLo75W', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(32, 'Deborah Boyer', 'deborahboyer@baluba.com', 'Deborah Boyer', 2, 'bronze', 'active', 'SLB-1032', NULL, '$2y$10$nfBTbIiDIhmi4CAC8mqXzO5sRBBz/3O74gLF3jZIIJXkhcjjy7b7K', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(33, 'Mckee Huber', 'mckeehuber@baluba.com', 'Mckee Huber', 2, 'bronze', 'active', 'SLB-1033', NULL, '$2y$10$9TiNn54zQDcd9eIjeISUsuzyQGApHGFvbcHLs/Gj12knG/sZ0m25i', NULL, '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(34, 'Emily Blackwell', 'emilyblackwell@baluba.com', 'Emily Blackwell', 2, 'bronze', 'active', 'SLB-1034', NULL, '$2y$10$V0A.GEJkVs/RTr9u12VC9u9mzm7QKKEz78/XM4HU68LEPRyWtNgzW', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(35, 'Lawson Harrell', 'lawsonharrell@baluba.com', 'Lawson Harrell', 2, 'bronze', 'active', 'SLB-1035', NULL, '$2y$10$5pyg5pWzmqLbHfQAnt.MqOYiOCxn9t80CbvqdxpDGbfM6kbTkK6E6', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(36, 'Rivera Harrison', 'riveraharrison@baluba.com', 'Rivera Harrison', 2, 'bronze', 'active', 'SLB-1036', NULL, '$2y$10$qMWiNykfJxusuMhQUlNYWOGEqZq/J0aKpHKnbyUy2MAp6jL6faoX.', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(37, 'Alexandria Guthrie', 'alexandriaguthrie@baluba.com', 'Alexandria Guthrie', 2, 'bronze', 'active', 'SLB-1037', NULL, '$2y$10$ymhO0MV4HUuukqJFQ1dcx.xGDFDvozuDZEOAWEoDw1CzHhP.90CfS', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(38, 'Jefferson Acevedo', 'jeffersonacevedo@baluba.com', 'Jefferson Acevedo', 2, 'bronze', 'active', 'SLB-1038', NULL, '$2y$10$LL8yjXQkgGXawXJUmrG4fuPzVJ7Wb9PP1aBe.N1q0IyEBkTjzDHt2', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(39, 'Weiss Conway', 'weissconway@baluba.com', 'Weiss Conway', 2, 'bronze', 'active', 'SLB-1039', NULL, '$2y$10$.4LBZkOEMD17M4QwWQqgCO0utWZ9/vuC4Qkw9ARoRpbQKzUP9uGm6', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(40, 'Ethel Henry', 'ethelhenry@baluba.com', 'Ethel Henry', 2, 'bronze', 'active', 'SLB-1040', NULL, '$2y$10$sEgbJD6kcfKJ7pP4GGub/Oo2jkZM9b./Mx8pNGBxBIzCh51RExisC', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(41, 'Jenny Whitaker', 'jennywhitaker@baluba.com', 'Jenny Whitaker', 2, 'bronze', 'active', 'SLB-1041', NULL, '$2y$10$UWYQHlcIgrMruBS92Exk7.xXNEd7dtYPCSw9qipCFzt8CcdVLJ7Du', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(42, 'Miranda Acosta', 'mirandaacosta@baluba.com', 'Miranda Acosta', 2, 'bronze', 'active', 'SLB-1042', NULL, '$2y$10$SDvaRhP6E5NW5qOEIEk.NuBCQAbMwxPnntUnfe61x3.QAATdiErw6', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(43, 'Kate Tanner', 'katetanner@baluba.com', 'Kate Tanner', 2, 'bronze', 'active', 'SLB-1043', NULL, '$2y$10$1IDu6ZOSEJMnsrJz33K5z.0ZOMBSZWy8lV3NXmjUIRO9/8WuyBV32', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(44, 'Anderson Pearson', 'andersonpearson@baluba.com', 'Anderson Pearson', 2, 'bronze', 'active', 'SLB-1044', NULL, '$2y$10$4/EE1ncRFajcxMsDuTrVA.KHcDgkMCRzyx6eAar/yIBB2XzKYLp/u', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(45, 'Norman Gray', 'normangray@baluba.com', 'Norman Gray', 2, 'bronze', 'active', 'SLB-1045', NULL, '$2y$10$xIRb3YizoSUK73Lj8NLZz.BDTqiyQIi4oJAoBv9em0Go954Y1R1Wq', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(46, 'Murray Mcdonald', 'murraymcdonald@baluba.com', 'Murray Mcdonald', 2, 'bronze', 'active', 'SLB-1046', NULL, '$2y$10$6roZzSr.GED6Y4lCoaVANuoRFGPUnTrWH2OUkgM.A14p3nyIKcyGq', NULL, '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(47, 'Jody Fischer', 'jodyfischer@baluba.com', 'Jody Fischer', 2, 'bronze', 'active', 'SLB-1047', NULL, '$2y$10$mIzhWk9hNqPuwkl4TYPkcerLhfOP5WThtgY2V2cO3qsAg0lnD0xRe', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(48, 'Leola Mcclain', 'leolamcclain@baluba.com', 'Leola Mcclain', 2, 'bronze', 'active', 'SLB-1048', NULL, '$2y$10$MAuwuBUzNgvVvV0pw5GdyOzNuuUGaN6MieCGi/EOMGGfbtdOWVpBO', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(49, 'Elvia Mendez', 'elviamendez@baluba.com', 'Elvia Mendez', 2, 'bronze', 'active', 'SLB-1049', NULL, '$2y$10$r6IsAlQhlRy8KYHwIibr4.Kaws2QZq36Bo8dHIlFF80HaA7RRD/t6', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(50, 'Hillary Livingston', 'hillarylivingston@baluba.com', 'Hillary Livingston', 2, 'bronze', 'active', 'SLB-1050', NULL, '$2y$10$OIa9nJOZpj9K3qut6dBokesUSTVO3.ST0yTxXg2Qco5ypIrJYoany', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(51, 'Bessie Kirk', 'bessiekirk@baluba.com', 'Bessie Kirk', 2, 'bronze', 'active', 'SLB-1051', NULL, '$2y$10$OeYywCAwMliw1ZiohxjNc.iAz1HGVVDB8PdvJCSMv3poz8y5UFxoK', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(52, 'Kerry Lawrence', 'kerrylawrence@baluba.com', 'Kerry Lawrence', 2, 'bronze', 'active', 'SLB-1052', NULL, '$2y$10$SSl2IFsravdgVCNe/.XYkuLXuQtEg4JN7XnRz3olg9ob.PJall0cW', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(53, 'Weaver White', 'weaverwhite@baluba.com', 'Weaver White', 2, 'bronze', 'active', 'SLB-1053', NULL, '$2y$10$iLyH5RrRpU9oXZLeE9WmE.wUzHNX.QWHH27f0qYzWVSSrWCChTx4u', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(54, 'Gillespie Cabrera', 'gillespiecabrera@baluba.com', 'Gillespie Cabrera', 2, 'bronze', 'active', 'SLB-1054', NULL, '$2y$10$dC3g8vNrhotAjWXgm8Dyju7jpyiYO3n.Yqhx24lQR8JM2CPblgYhC', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(55, 'Nelson Gregory', 'nelsongregory@baluba.com', 'Nelson Gregory', 2, 'bronze', 'active', 'SLB-1055', NULL, '$2y$10$ZWYgSjq25LBtWdl.IjnQduqJWHW6TYDsbXh9.A2sz3SYLfOQk2sWy', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(56, 'Woodard Burch', 'woodardburch@baluba.com', 'Woodard Burch', 2, 'bronze', 'active', 'SLB-1056', NULL, '$2y$10$6sfwQKrwR9yQ9HbfWUVck.90sa9fxdht7fdyWnSDjnOWFWV5EAmPC', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(57, 'Hartman Chavez', 'hartmanchavez@baluba.com', 'Hartman Chavez', 2, 'bronze', 'active', 'SLB-1057', NULL, '$2y$10$/BOiJ54E3Rt2sE8JBsZDNe41dywziIUC/JRRQhiVsjjDCGflgfmaS', NULL, '2019-08-31 16:31:08', '2019-08-31 16:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_account_statuses`
--

CREATE TABLE `user_account_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','frozen','cd') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_account_statuses`
--

INSERT INTO `user_account_statuses` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'active', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(2, 2, 'active', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(3, 3, 'active', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(4, 4, 'active', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(5, 5, 'active', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(6, 6, 'active', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(7, 7, 'active', '2019-08-31 16:31:04', '2019-08-31 16:31:04'),
(8, 8, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(9, 9, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(10, 10, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(11, 11, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(12, 12, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(13, 13, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(14, 14, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(15, 15, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(16, 16, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(17, 17, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(18, 18, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(19, 19, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(20, 20, 'active', '2019-08-31 16:31:05', '2019-08-31 16:31:05'),
(21, 21, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(22, 22, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(23, 23, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(24, 24, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(25, 25, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(26, 26, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(27, 27, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(28, 28, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(29, 29, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(30, 30, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(31, 31, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(32, 32, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(33, 33, 'active', '2019-08-31 16:31:06', '2019-08-31 16:31:06'),
(34, 34, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(35, 35, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(36, 36, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(37, 37, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(38, 38, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(39, 39, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(40, 40, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(41, 41, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(42, 42, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(43, 43, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(44, 44, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(45, 45, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(46, 46, 'active', '2019-08-31 16:31:07', '2019-08-31 16:31:07'),
(47, 47, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(48, 48, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(49, 49, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(50, 50, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(51, 51, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(52, 52, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(53, 53, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(54, 54, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(55, 55, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(56, 56, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08'),
(57, 57, 'active', '2019-08-31 16:31:08', '2019-08-31 16:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_product_logs`
--

CREATE TABLE `user_product_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `points` double NOT NULL DEFAULT 0,
  `total` bigint(20) NOT NULL DEFAULT 0,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'None',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_earnings` bigint(20) NOT NULL DEFAULT 0,
  `current_balance` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `total_earnings`, `current_balance`, `created_at`, `updated_at`) VALUES
(1, 1, 6250, 5625, '2019-08-31 16:32:30', '2019-08-31 16:34:06'),
(2, 2, 3250, 2925, '2019-08-31 16:32:36', '2019-08-31 16:33:41'),
(3, 3, 3250, 2925, '2019-08-31 16:32:41', '2019-08-31 16:34:06'),
(4, 4, 1750, 1575, '2019-08-31 16:32:48', '2019-08-31 16:33:29'),
(5, 5, 1750, 1575, '2019-08-31 16:32:58', '2019-08-31 16:33:41'),
(6, 6, 1750, 1575, '2019-08-31 16:33:06', '2019-08-31 16:33:52'),
(7, 7, 1750, 1575, '2019-08-31 16:33:12', '2019-08-31 16:34:06'),
(8, 8, 0, 0, '2019-08-31 16:33:23', '2019-08-31 16:33:23'),
(9, 9, 0, 0, '2019-08-31 16:33:29', '2019-08-31 16:33:29'),
(10, 10, 0, 0, '2019-08-31 16:33:36', '2019-08-31 16:33:36'),
(11, 11, 0, 0, '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(12, 12, 0, 0, '2019-08-31 16:33:47', '2019-08-31 16:33:47'),
(13, 13, 0, 0, '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(14, 14, 0, 0, '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(15, 15, 0, 0, '2019-08-31 16:34:06', '2019-08-31 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_logs`
--

CREATE TABLE `wallet_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_logs`
--

INSERT INTO `wallet_logs` (`id`, `wallet_id`, `amount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 500, 'Referal Reward', '2019-08-31 16:32:36', '2019-08-31 16:32:36'),
(2, 1, 750, 'Match Point Reward', '2019-08-31 16:32:41', '2019-08-31 16:32:41'),
(3, 1, 500, 'Referal Reward', '2019-08-31 16:32:41', '2019-08-31 16:32:41'),
(4, 2, 500, 'Referal Reward', '2019-08-31 16:32:48', '2019-08-31 16:32:48'),
(5, 2, 750, 'Match Point Reward', '2019-08-31 16:32:58', '2019-08-31 16:32:58'),
(6, 2, 500, 'Referal Reward', '2019-08-31 16:32:58', '2019-08-31 16:32:58'),
(7, 1, 750, 'Match Point Reward', '2019-08-31 16:33:06', '2019-08-31 16:33:06'),
(8, 3, 500, 'Referal Reward', '2019-08-31 16:33:06', '2019-08-31 16:33:06'),
(9, 3, 750, 'Match Point Reward', '2019-08-31 16:33:12', '2019-08-31 16:33:12'),
(10, 1, 750, 'Match Point Reward', '2019-08-31 16:33:12', '2019-08-31 16:33:12'),
(11, 3, 500, 'Referal Reward', '2019-08-31 16:33:12', '2019-08-31 16:33:12'),
(12, 4, 500, 'Referal Reward', '2019-08-31 16:33:23', '2019-08-31 16:33:23'),
(13, 4, 750, 'Match Point Reward', '2019-08-31 16:33:29', '2019-08-31 16:33:29'),
(14, 4, 500, 'Referal Reward', '2019-08-31 16:33:29', '2019-08-31 16:33:29'),
(15, 2, 750, 'Match Point Reward', '2019-08-31 16:33:36', '2019-08-31 16:33:36'),
(16, 5, 500, 'Referal Reward', '2019-08-31 16:33:36', '2019-08-31 16:33:36'),
(17, 5, 750, 'Match Point Reward', '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(18, 2, 750, 'Match Point Reward', '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(19, 5, 500, 'Referal Reward', '2019-08-31 16:33:41', '2019-08-31 16:33:41'),
(20, 1, 750, 'Match Point Reward', '2019-08-31 16:33:47', '2019-08-31 16:33:47'),
(21, 6, 500, 'Referal Reward', '2019-08-31 16:33:47', '2019-08-31 16:33:47'),
(22, 6, 750, 'Match Point Reward', '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(23, 1, 750, 'Match Point Reward', '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(24, 6, 500, 'Referal Reward', '2019-08-31 16:33:52', '2019-08-31 16:33:52'),
(25, 3, 750, 'Match Point Reward', '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(26, 1, 750, 'Match Point Reward', '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(27, 7, 500, 'Referal Reward', '2019-08-31 16:34:00', '2019-08-31 16:34:00'),
(28, 7, 750, 'Match Point Reward', '2019-08-31 16:34:06', '2019-08-31 16:34:06'),
(29, 3, 750, 'Match Point Reward', '2019-08-31 16:34:06', '2019-08-31 16:34:06'),
(30, 1, 750, 'Match Point Reward', '2019-08-31 16:34:06', '2019-08-31 16:34:06'),
(31, 7, 500, 'Referal Reward', '2019-08-31 16:34:06', '2019-08-31 16:34:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `current_queues`
--
ALTER TABLE `current_queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `current_queues_queue_id_foreign` (`queue_id`);

--
-- Indexes for table `diamond_queues`
--
ALTER TABLE `diamond_queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diamond_queues_user_id_foreign` (`user_id`);

--
-- Indexes for table `genealogies`
--
ALTER TABLE `genealogies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genealogies_user_id_foreign` (`user_id`),
  ADD KEY `genealogies_reference_id_foreign` (`reference_id`),
  ADD KEY `genealogies_referal_id_foreign` (`referal_id`);

--
-- Indexes for table `genealogy_match_logs`
--
ALTER TABLE `genealogy_match_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genealogy_match_logs_user_id_foreign` (`user_id`),
  ADD KEY `genealogy_match_logs_genealogy_id_foreign` (`genealogy_id`);

--
-- Indexes for table `genealogy_match_points`
--
ALTER TABLE `genealogy_match_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genealogy_match_points_genealogy_id_foreign` (`genealogy_id`);

--
-- Indexes for table `group_sales_logs`
--
ALTER TABLE `group_sales_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informations_user_id_foreign` (`user_id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keys_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsorships_user_id_foreign` (`user_id`),
  ADD KEY `sponsorships_sponsor_id_foreign` (`sponsor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_account_statuses`
--
ALTER TABLE `user_account_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_product_logs`
--
ALTER TABLE `user_product_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_product_logs_user_id_foreign` (`user_id`),
  ADD KEY `user_product_logs_product_id_foreign` (`product_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallet_logs`
--
ALTER TABLE `wallet_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_logs_wallet_id_foreign` (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `current_queues`
--
ALTER TABLE `current_queues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diamond_queues`
--
ALTER TABLE `diamond_queues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genealogies`
--
ALTER TABLE `genealogies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `genealogy_match_logs`
--
ALTER TABLE `genealogy_match_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `genealogy_match_points`
--
ALTER TABLE `genealogy_match_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `group_sales_logs`
--
ALTER TABLE `group_sales_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informations`
--
ALTER TABLE `informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user_account_statuses`
--
ALTER TABLE `user_account_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user_product_logs`
--
ALTER TABLE `user_product_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wallet_logs`
--
ALTER TABLE `wallet_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `current_queues`
--
ALTER TABLE `current_queues`
  ADD CONSTRAINT `current_queues_queue_id_foreign` FOREIGN KEY (`queue_id`) REFERENCES `diamond_queues` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diamond_queues`
--
ALTER TABLE `diamond_queues`
  ADD CONSTRAINT `diamond_queues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `genealogies`
--
ALTER TABLE `genealogies`
  ADD CONSTRAINT `genealogies_referal_id_foreign` FOREIGN KEY (`referal_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genealogies_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genealogies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `genealogy_match_logs`
--
ALTER TABLE `genealogy_match_logs`
  ADD CONSTRAINT `genealogy_match_logs_genealogy_id_foreign` FOREIGN KEY (`genealogy_id`) REFERENCES `genealogies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genealogy_match_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `genealogy_match_points`
--
ALTER TABLE `genealogy_match_points`
  ADD CONSTRAINT `genealogy_match_points_genealogy_id_foreign` FOREIGN KEY (`genealogy_id`) REFERENCES `genealogies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `informations`
--
ALTER TABLE `informations`
  ADD CONSTRAINT `informations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keys`
--
ALTER TABLE `keys`
  ADD CONSTRAINT `keys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD CONSTRAINT `sponsorships_sponsor_id_foreign` FOREIGN KEY (`sponsor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sponsorships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_product_logs`
--
ALTER TABLE `user_product_logs`
  ADD CONSTRAINT `user_product_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_product_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_logs`
--
ALTER TABLE `wallet_logs`
  ADD CONSTRAINT `wallet_logs_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
