-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2019 at 12:43 PM
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
(1, 1, NULL, NULL, 'Root', '2019-08-23 10:40:16', '2019-08-23 10:40:16'),
(2, 2, 1, 1, 'Left', '2019-08-23 10:40:20', '2019-08-23 10:40:20'),
(3, 3, 1, 1, 'Right', '2019-08-23 10:40:26', '2019-08-23 10:40:26'),
(4, 4, 2, 2, 'Left', '2019-08-23 10:40:33', '2019-08-23 10:40:33'),
(5, 5, 2, 2, 'Right', '2019-08-23 10:41:01', '2019-08-23 10:41:01'),
(6, 6, 3, 3, 'Left', '2019-08-23 10:41:10', '2019-08-23 10:41:10'),
(7, 7, 3, 3, 'Right', '2019-08-23 10:41:16', '2019-08-23 10:41:16'),
(8, 8, 4, 4, 'Left', '2019-08-23 10:41:46', '2019-08-23 10:41:46'),
(9, 9, 4, 4, 'Right', '2019-08-23 10:41:52', '2019-08-23 10:41:52'),
(10, 10, 5, 5, 'Left', '2019-08-23 10:42:03', '2019-08-23 10:42:03'),
(11, 11, 5, 5, 'Right', '2019-08-23 10:42:07', '2019-08-23 10:42:07'),
(12, 12, 6, 6, 'Left', '2019-08-23 10:42:15', '2019-08-23 10:42:15'),
(13, 13, 6, 6, 'Right', '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(14, 14, 7, 7, 'Left', '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(15, 15, 7, 7, 'Right', '2019-08-23 10:42:44', '2019-08-23 10:42:44');

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
(1, 1, 1, 'New Match!', '2019-08-23 10:40:26', '2019-08-23 10:40:26'),
(2, 1, 2, 'New Match!', '2019-08-23 10:41:02', '2019-08-23 10:41:02'),
(3, 1, 1, 'New Match!', '2019-08-23 10:41:10', '2019-08-23 10:41:10'),
(4, 1, 3, 'New Match!', '2019-08-23 10:41:16', '2019-08-23 10:41:16'),
(5, 1, 1, 'New Match!', '2019-08-23 10:41:16', '2019-08-23 10:41:16'),
(6, 1, 4, 'New Match!', '2019-08-23 10:41:53', '2019-08-23 10:41:53'),
(7, 1, 2, 'New Match!', '2019-08-23 10:42:03', '2019-08-23 10:42:03'),
(8, 1, 5, 'New Match!', '2019-08-23 10:42:08', '2019-08-23 10:42:08'),
(9, 1, 2, 'New Match!', '2019-08-23 10:42:08', '2019-08-23 10:42:08'),
(10, 1, 1, 'New Match!', '2019-08-23 10:42:15', '2019-08-23 10:42:15'),
(11, 1, 6, 'New Match!', '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(12, 1, 1, 'New Match!', '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(13, 1, 3, 'New Match!', '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(14, 1, 1, 'New Match!', '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(15, 1, 7, 'New Match!', '2019-08-23 10:42:44', '2019-08-23 10:42:44'),
(16, 1, 3, 'New Match!', '2019-08-23 10:42:44', '2019-08-23 10:42:44'),
(17, 1, 1, 'New Match!', '2019-08-23 10:42:44', '2019-08-23 10:42:44');

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
(1, 1, 7, 0, 0, 0, 0, 0, '2019-08-23 10:40:16', '2019-08-23 10:42:44'),
(2, 2, 3, 0, 0, 0, 0, 0, '2019-08-23 10:40:20', '2019-08-23 10:42:08'),
(3, 3, 3, 0, 0, 0, 0, 0, '2019-08-23 10:40:26', '2019-08-23 10:42:44'),
(4, 4, 1, 0, 0, 0, 0, 0, '2019-08-23 10:40:33', '2019-08-23 10:41:53'),
(5, 5, 1, 0, 0, 0, 0, 0, '2019-08-23 10:41:01', '2019-08-23 10:42:08'),
(6, 6, 1, 0, 0, 0, 0, 0, '2019-08-23 10:41:10', '2019-08-23 10:42:28'),
(7, 7, 1, 0, 0, 0, 0, 0, '2019-08-23 10:41:16', '2019-08-23 10:42:44'),
(8, 8, 0, 0, 0, 0, 0, 0, '2019-08-23 10:41:46', '2019-08-23 10:41:46'),
(9, 9, 0, 0, 0, 0, 0, 0, '2019-08-23 10:41:52', '2019-08-23 10:41:52'),
(10, 10, 0, 0, 0, 0, 0, 0, '2019-08-23 10:42:03', '2019-08-23 10:42:03'),
(11, 11, 0, 0, 0, 0, 0, 0, '2019-08-23 10:42:07', '2019-08-23 10:42:07'),
(12, 12, 0, 0, 0, 0, 0, 0, '2019-08-23 10:42:15', '2019-08-23 10:42:15'),
(13, 13, 0, 0, 0, 0, 0, 0, '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(14, 14, 0, 0, 0, 0, 0, 0, '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(15, 15, 0, 0, 0, 0, 0, 0, '2019-08-23 10:42:44', '2019-08-23 10:42:44');

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
(1, 1, 'SecureLife01', 'SecureLife01', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(2, 2, 'SecureLife02', 'SecureLife02', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(3, 3, 'SecureLife03', 'SecureLife03', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(4, 4, 'SecureLife04', 'SecureLife04', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(5, 5, 'SecureLife05', 'SecureLife05', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(6, 6, 'SecureLife06', 'SecureLife06', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(7, 7, 'SecureLife07', 'SecureLife07', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(8, 8, 'Amalia', 'Amalia', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(9, 9, 'Cotton', 'Cotton', '', 'utin.png', '', '', '', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(10, 10, 'Doris', 'Doris', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(11, 11, 'Emilia', 'Emilia', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(12, 12, 'Angeline', 'Angeline', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(13, 13, 'Holland', 'Holland', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(14, 14, 'Luella', 'Luella', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(15, 15, 'Rosemary', 'Rosemary', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(16, 16, 'Roberts', 'Roberts', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(17, 17, 'Rosario', 'Rosario', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(18, 18, 'Espinoza', 'Espinoza', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(19, 19, 'Sheena', 'Sheena', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(20, 20, 'Christian', 'Christian', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(21, 21, 'Wells', 'Wells', '', 'utin.png', '', '', '', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(22, 22, 'Peck', 'Peck', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(23, 23, 'Winifred', 'Winifred', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(24, 24, 'Leon', 'Leon', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(25, 25, 'Carney', 'Carney', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(26, 26, 'Valerie', 'Valerie', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(27, 27, 'Lucy', 'Lucy', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(28, 28, 'Barbra', 'Barbra', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(29, 29, 'Johnson', 'Johnson', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(30, 30, 'Holmes', 'Holmes', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(31, 31, 'Fisher', 'Fisher', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(32, 32, 'Deborah', 'Deborah', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(33, 33, 'Mckee', 'Mckee', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(34, 34, 'Emily', 'Emily', '', 'utin.png', '', '', '', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(35, 35, 'Lawson', 'Lawson', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(36, 36, 'Rivera', 'Rivera', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(37, 37, 'Alexandria', 'Alexandria', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(38, 38, 'Jefferson', 'Jefferson', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(39, 39, 'Weiss', 'Weiss', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(40, 40, 'Ethel', 'Ethel', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(41, 41, 'Jenny', 'Jenny', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(42, 42, 'Miranda', 'Miranda', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(43, 43, 'Kate', 'Kate', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(44, 44, 'Anderson', 'Anderson', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(45, 45, 'Norman', 'Norman', '', 'utin.png', '', '', '', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(46, 46, 'Murray', 'Murray', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(47, 47, 'Jody', 'Jody', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(48, 48, 'Leola', 'Leola', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(49, 49, 'Elvia', 'Elvia', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(50, 50, 'Hillary', 'Hillary', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(51, 51, 'Bessie', 'Bessie', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(52, 52, 'Kerry', 'Kerry', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(53, 53, 'Weaver', 'Weaver', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(54, 54, 'Gillespie', 'Gillespie', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(55, 55, 'Nelson', 'Nelson', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(56, 56, 'Woodard', 'Woodard', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(57, 57, 'Hartman', 'Hartman', '', 'utin.png', '', '', '', '2019-08-23 10:39:54', '2019-08-23 10:39:54');

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
(1, '2019_08_11_190429_create_roles_table', 1),
(2, '2019_08_12_150000_create_users_table', 1),
(3, '2019_08_12_150001_create_genealogies_table', 1),
(4, '2019_08_13_172455_create_genealogy_match_points_table', 1),
(5, '2019_08_13_172526_create_genealogy_match_logs_table', 1),
(6, '2019_08_13_172718_create_products_table', 1),
(7, '2019_08_13_172748_create_user_product_logs_table', 1),
(8, '2019_08_13_172836_create_group_sales_logs_table', 1),
(9, '2019_08_13_172904_create_user_account_statuses_table', 1),
(10, '2019_08_19_181626_create_informations_table', 1),
(11, '2019_08_19_182517_create_diamond_queues_table', 1),
(12, '2019_08_19_183142_create_current_queues_table', 1),
(13, '2019_08_19_184121_create_requests_table', 1),
(14, '2019_08_19_185055_create_sponsorships_table', 1),
(15, '2019_08_19_185447_create_wallets_table', 1),
(16, '2019_08_19_185751_create_wallet_logs_table', 1),
(17, '2019_08_19_185922_create_keys_table', 1),
(18, '2019_08_19_190415_create_notifications_table', 1);

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2019-08-23 10:39:47', '2019-08-23 10:39:47'),
(2, 'developer', '2019-08-23 10:39:47', '2019-08-23 10:39:47'),
(3, 'user', '2019-08-23 10:39:47', '2019-08-23 10:39:47');

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
  `role_id` bigint(20) UNSIGNED NOT NULL,
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
(1, 'SecureLife01', 'SecureLife01@SecureLife.com', 'SecureLife01', 2, 'bronze', 'active', 'SLB-1001', NULL, '$2y$10$JLcSIH7wExTwdEFwMtqanOTuMRIrLNFTFHyGoVGR2ifzkAv/IoDiS', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(2, 'SecureLife02', 'SecureLife02@SecureLife.com', 'SecureLife02', 2, 'bronze', 'active', 'SLB-1002', NULL, '$2y$10$9FzojEQdABXQLcUyf816xu8TQmwjNJ/A29C.GWRDOJEofMSeZUK8a', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(3, 'SecureLife03', 'SecureLife03@SecureLife.com', 'SecureLife03', 2, 'bronze', 'active', 'SLB-1003', NULL, '$2y$10$ZeLCPv4qoRivg/pNelHyfu6O1zMMtN4LFB3NcOIDMKzeHy5AG0.WS', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(4, 'SecureLife04', 'SecureLife04@SecureLife.com', 'SecureLife04', 2, 'bronze', 'active', 'SLB-1004', NULL, '$2y$10$Hv8zAD6huuKJSiNw7N37Iepcd/lntjy1ngfQ5sekkN9E7rqt2rAVu', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(5, 'SecureLife05', 'SecureLife05@SecureLife.com', 'SecureLife05', 2, 'bronze', 'active', 'SLB-1005', NULL, '$2y$10$ECK/WSm3u.UHWtpKLK6drevo0Kk7.eiUMLDtwAUxBHQB2lGea0z2K', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(6, 'SecureLife06', 'SecureLife06@SecureLife.com', 'SecureLife06', 2, 'bronze', 'active', 'SLB-1006', NULL, '$2y$10$TvT0uRzIA/uEGOtlE1iPjO9DnmOm8moalXw6rDHyZ4eKaQ9fgkXym', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(7, 'SecureLife07', 'SecureLife07@SecureLife.com', 'SecureLife07', 2, 'bronze', 'active', 'SLB-1007', NULL, '$2y$10$ETeVM/h0i7SNAax3TRR4ge.sNQkmtV4lJHsGOlkg9ciw0z2p3cYBq', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(8, 'Amalia Carpenter', 'amaliacarpenter@baluba.com', 'Amalia Carpenter', 2, 'bronze', 'active', 'SLB-1008', NULL, '$2y$10$DupCXuxTk5xLhq4HXZWUJ.ER41V7vncZziDBDPouPUfStdz4JS9Vy', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(9, 'Cotton Bush', 'cottonbush@baluba.com', 'Cotton Bush', 2, 'bronze', 'active', 'SLB-1009', NULL, '$2y$10$AnB/RFhdAPyLDRMfJoZ1oOVWVz081Alho//KVFGktAX8qRQo0zOv.', NULL, '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(10, 'Doris Obrien', 'dorisobrien@baluba.com', 'Doris Obrien', 2, 'bronze', 'active', 'SLB-1010', NULL, '$2y$10$IMsKDV.toYgmzX7J/RsxHuGZn1DI9H7kIHuN9v0weLcgrLi0jM5xq', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(11, 'Emilia Hernandez', 'emiliahernandez@baluba.com', 'Emilia Hernandez', 2, 'bronze', 'active', 'SLB-1011', NULL, '$2y$10$SfhOk7MusYxjyQvZv9NtK.lV.ChFWRzDUwxof3s6lFcZXjl4Y1C7O', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(12, 'Angeline Turner', 'angelineturner@baluba.com', 'Angeline Turner', 2, 'bronze', 'active', 'SLB-1012', NULL, '$2y$10$1O56LrjyVxvfV1qiIcukjOzSV1IFzf22InU8npAhBLkjvaxf8utMG', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(13, 'Holland Hines', 'hollandhines@baluba.com', 'Holland Hines', 2, 'bronze', 'active', 'SLB-1013', NULL, '$2y$10$2SYcktGeRPI8AgH0ppZ7G.yORe6pI6remrfJFWgWWWM9zW1oDQAKy', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(14, 'Luella Petty', 'luellapetty@baluba.com', 'Luella Petty', 2, 'bronze', 'active', 'SLB-1014', NULL, '$2y$10$5DyqrrwTmSJeUtKwUtpVBehoQ/Bqp05sWRKJy.2gf1qx0SGWfG70W', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(15, 'Rosemary Morse', 'rosemarymorse@baluba.com', 'Rosemary Morse', 2, 'bronze', 'active', 'SLB-1015', NULL, '$2y$10$vudhJQ9AOEwdw71HlM/EieG85GhMge66AKIRAoDDha6jNmqEqkHBe', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(16, 'Roberts Lee', 'robertslee@baluba.com', 'Roberts Lee', 2, 'bronze', 'active', 'SLB-1016', NULL, '$2y$10$XxGhs.hqWgB71NQh7CDlTeeEYSJ05VWcQ.bc7u4IiJc7xSNmkNB.m', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(17, 'Rosario Barton', 'rosariobarton@baluba.com', 'Rosario Barton', 2, 'bronze', 'active', 'SLB-1017', NULL, '$2y$10$uGdypVIywBXQ9xeOK1yoPu9O0N975TCeO/BStaVZv4H/ELeYi4BsC', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(18, 'Espinoza Espinoza', 'espinozaespinoza@baluba.com', 'Espinoza Espinoza', 2, 'bronze', 'active', 'SLB-1018', NULL, '$2y$10$Rn3lLllPfXGTMZPyHn7KeOhNYlVmHy8W8eXDjhvKQamyObf3LznN6', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(19, 'Sheena Camacho', 'sheenacamacho@baluba.com', 'Sheena Camacho', 2, 'bronze', 'active', 'SLB-1019', NULL, '$2y$10$7GnraCrej8NujxD0W/.KMelFQsAsJnvF8vQxy5wKLXC0kjSmOc0PO', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(20, 'Christian Kennedy', 'christiankennedy@baluba.com', 'Christian Kennedy', 2, 'bronze', 'active', 'SLB-1020', NULL, '$2y$10$YUW7Jqu94j.lTdOSLzVsf.85qhj2Pb5L/nN1IhXGpYNA59sD4ym1q', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(21, 'Wells King', 'wellsking@baluba.com', 'Wells King', 2, 'bronze', 'active', 'SLB-1021', NULL, '$2y$10$gbAdAUzsdq2bKhPtL8omJ.Yje6gzY1k.KBTN8UByWk5D8BJT2cLAm', NULL, '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(22, 'Peck Rodgers', 'peckrodgers@baluba.com', 'Peck Rodgers', 2, 'bronze', 'active', 'SLB-1022', NULL, '$2y$10$Gnr7PUwtFUCe68JyCoo59unF4TmH.80hr62ooIYI9HFxGnJw6omK.', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(23, 'Winifred Kent', 'winifredkent@baluba.com', 'Winifred Kent', 2, 'bronze', 'active', 'SLB-1023', NULL, '$2y$10$G4MJRuUqhcufl6hwLfKn4e.SN6wK8hy7E4a/Hf9qmhitTWw8gcyMG', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(24, 'Leon Newman', 'leonnewman@baluba.com', 'Leon Newman', 2, 'bronze', 'active', 'SLB-1024', NULL, '$2y$10$4LUg2ISVCLBYTcYNu49o8ObqWq6XH4ZpgC2gFMwj0yfZlfXEtrshS', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(25, 'Carney Russo', 'carneyrusso@baluba.com', 'Carney Russo', 2, 'bronze', 'active', 'SLB-1025', NULL, '$2y$10$kw/tvJAKRi15ARqP.kcop.NJCZhawkCJyLcvs0Vph1lBemv.rHdPK', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(26, 'Valerie Francis', 'valeriefrancis@baluba.com', 'Valerie Francis', 2, 'bronze', 'active', 'SLB-1026', NULL, '$2y$10$g8o5hdQETkkB6hXj2jgUmOVMyzevzq7WK02l/od2evMepl5/3TYXe', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(27, 'Lucy Wade', 'lucywade@baluba.com', 'Lucy Wade', 2, 'bronze', 'active', 'SLB-1027', NULL, '$2y$10$XwrOssGU929ZS6xPmhsVSuBsrmq3i5j9TmdHPFfOWICZiDMOCWcS.', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(28, 'Barbra Navarro', 'barbranavarro@baluba.com', 'Barbra Navarro', 2, 'bronze', 'active', 'SLB-1028', NULL, '$2y$10$6iIpQRwtXWC5B0SZku4NEuvFmrjAls/Lzwu2mXtKACeP2izrRg4Hy', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(29, 'Johnson Saunders', 'johnsonsaunders@baluba.com', 'Johnson Saunders', 2, 'bronze', 'active', 'SLB-1029', NULL, '$2y$10$Ucnu.GeQsk/t.tyXlbPnb.Hkr0w25OGmEma2HcvDDey5eAZl0xRLq', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(30, 'Holmes Lewis', 'holmeslewis@baluba.com', 'Holmes Lewis', 2, 'bronze', 'active', 'SLB-1030', NULL, '$2y$10$tA1LMr3wQh9.z.VqHQB5Y.P0lLqNPB8nP2BD3a16rMacOxSQ0/9eC', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(31, 'Fisher Russell', 'fisherrussell@baluba.com', 'Fisher Russell', 2, 'bronze', 'active', 'SLB-1031', NULL, '$2y$10$619f9ePEcD/M7/wGq0oNeuLNSA1riQ1c8csKoCCoZjylsM/UqOE4a', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(32, 'Deborah Boyer', 'deborahboyer@baluba.com', 'Deborah Boyer', 2, 'bronze', 'active', 'SLB-1032', NULL, '$2y$10$hgJada4eZfkDLF1jiNClJ.Ik/BukkQ2.WiLM6mlxUmSW.DLxFsW6C', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(33, 'Mckee Huber', 'mckeehuber@baluba.com', 'Mckee Huber', 2, 'bronze', 'active', 'SLB-1033', NULL, '$2y$10$tO/MiyArGy.Ow4YbzZTQ1.vq0w6ZA3OjKNmDLAXUm59UpfB3wWJIu', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(34, 'Emily Blackwell', 'emilyblackwell@baluba.com', 'Emily Blackwell', 2, 'bronze', 'active', 'SLB-1034', NULL, '$2y$10$REgw/O7fnzsnAt/9pBJD4ekjWjisUZGpWBCEDs3AZWZNRTwSmpw5W', NULL, '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(35, 'Lawson Harrell', 'lawsonharrell@baluba.com', 'Lawson Harrell', 2, 'bronze', 'active', 'SLB-1035', NULL, '$2y$10$UevTNxdOf/rizqY4k38/eeAor8C6tXRWfxo1Xv3HNkhERzqfW0szS', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(36, 'Rivera Harrison', 'riveraharrison@baluba.com', 'Rivera Harrison', 2, 'bronze', 'active', 'SLB-1036', NULL, '$2y$10$R5ZEsoCS962OWv5fptuD3.b2oEc9sjhK1LLhXkDnHE7hv/E22mF3i', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(37, 'Alexandria Guthrie', 'alexandriaguthrie@baluba.com', 'Alexandria Guthrie', 2, 'bronze', 'active', 'SLB-1037', NULL, '$2y$10$g8pcvxVRNp34NYQf6rb0O.leANeXAaO8P2PgM0sZ30RmBXshmGR7a', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(38, 'Jefferson Acevedo', 'jeffersonacevedo@baluba.com', 'Jefferson Acevedo', 2, 'bronze', 'active', 'SLB-1038', NULL, '$2y$10$ZIuqXlf2IOHdZq6XmWn6Q.L6lid.24xM5B3RGTJ9FWwlot8tt4/s2', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(39, 'Weiss Conway', 'weissconway@baluba.com', 'Weiss Conway', 2, 'bronze', 'active', 'SLB-1039', NULL, '$2y$10$Ya6bYzpGg9xlBNX1MWk49uue7o2gdb1Sd6jeCtSSG8wxg/8V701ae', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(40, 'Ethel Henry', 'ethelhenry@baluba.com', 'Ethel Henry', 2, 'bronze', 'active', 'SLB-1040', NULL, '$2y$10$hjdMOA9CVn9jS3j2DD11t.6SuVGglBlIkQ3MmNutihRkeg/AmFhiK', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(41, 'Jenny Whitaker', 'jennywhitaker@baluba.com', 'Jenny Whitaker', 2, 'bronze', 'active', 'SLB-1041', NULL, '$2y$10$Q7Ix/t65NlB0sDNghbdoEuY2Qzn3rly4ZAZ3bmDdEVKEJMjVIlcWu', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(42, 'Miranda Acosta', 'mirandaacosta@baluba.com', 'Miranda Acosta', 2, 'bronze', 'active', 'SLB-1042', NULL, '$2y$10$bPfd/Xmos4JZCuTdlOF7eOIm7EFGA.CQFK3Re6KpK3nEQ/FKPUNwu', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(43, 'Kate Tanner', 'katetanner@baluba.com', 'Kate Tanner', 2, 'bronze', 'active', 'SLB-1043', NULL, '$2y$10$BsFnBoVApYgg5vp01.p2w.r3F1J/8qaxEp5NkEvEwmTFiDwWCrFku', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(44, 'Anderson Pearson', 'andersonpearson@baluba.com', 'Anderson Pearson', 2, 'bronze', 'active', 'SLB-1044', NULL, '$2y$10$3fxpesZIKi4glYs7fk15z.OHLVSnGsQ9FgTroH.rebiPKRN.eDTmW', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(45, 'Norman Gray', 'normangray@baluba.com', 'Norman Gray', 2, 'bronze', 'active', 'SLB-1045', NULL, '$2y$10$hIDCsCE7aelitORVkF4rtetQ6FJjhSG3ipBUvJDLgUGzWe7iu6Yfe', NULL, '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(46, 'Murray Mcdonald', 'murraymcdonald@baluba.com', 'Murray Mcdonald', 2, 'bronze', 'active', 'SLB-1046', NULL, '$2y$10$1l5psi91EIBhY/d9.bjcNONETLzNP5JHXQa5jrocSpq8J0lJ66fQ2', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(47, 'Jody Fischer', 'jodyfischer@baluba.com', 'Jody Fischer', 2, 'bronze', 'active', 'SLB-1047', NULL, '$2y$10$NFiRMsbO0lMrFwzRrZ5AcufKqawC6f/9Len5Sah59lPdVmGs6Rxam', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(48, 'Leola Mcclain', 'leolamcclain@baluba.com', 'Leola Mcclain', 2, 'bronze', 'active', 'SLB-1048', NULL, '$2y$10$..dj50OW45R5Rg4.LH9GyOY7nGfKpC12KZWmoH/zd0xqpGFuLBOza', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(49, 'Elvia Mendez', 'elviamendez@baluba.com', 'Elvia Mendez', 2, 'bronze', 'active', 'SLB-1049', NULL, '$2y$10$WdlVvrzkbXXN.YD6FY/ADOrJrwX/dPxCl523A.XTehqugVAn5Lp7.', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(50, 'Hillary Livingston', 'hillarylivingston@baluba.com', 'Hillary Livingston', 2, 'bronze', 'active', 'SLB-1050', NULL, '$2y$10$H0p8TMa9dt6.9mKNYWcwo.U28RJ2CiW0L3CAMeDHBvFErWlfpNCtm', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(51, 'Bessie Kirk', 'bessiekirk@baluba.com', 'Bessie Kirk', 2, 'bronze', 'active', 'SLB-1051', NULL, '$2y$10$1sLhAX71jyhN.KxBazdYB.60zrV5Dd0Bvvi7H38J4ya6zQb.NNwEG', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(52, 'Kerry Lawrence', 'kerrylawrence@baluba.com', 'Kerry Lawrence', 2, 'bronze', 'active', 'SLB-1052', NULL, '$2y$10$wPG7mfhE1kTboMz5EJkqDeQur7Zu2qmfqXf3JC7WMUcs/WgcsGoqO', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(53, 'Weaver White', 'weaverwhite@baluba.com', 'Weaver White', 2, 'bronze', 'active', 'SLB-1053', NULL, '$2y$10$Fdkd29GZ/ctEkHBDgdpKcugyPaIW6hmXDNP4ivN4vRkRCIKiQQ6/y', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(54, 'Gillespie Cabrera', 'gillespiecabrera@baluba.com', 'Gillespie Cabrera', 2, 'bronze', 'active', 'SLB-1054', NULL, '$2y$10$fBSSB5l31qvntzM8zcXtD.6FyXUDRSn4T5TI9LF09GlYirjChc.Vm', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(55, 'Nelson Gregory', 'nelsongregory@baluba.com', 'Nelson Gregory', 2, 'bronze', 'active', 'SLB-1055', NULL, '$2y$10$o9XO/hQeOjltNhyhqrYSrOkoOpDI/5e38fy4GsFrfy/oodfE8VgTy', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(56, 'Woodard Burch', 'woodardburch@baluba.com', 'Woodard Burch', 2, 'bronze', 'active', 'SLB-1056', NULL, '$2y$10$AwA/ISh0Y9scL58o6pjWLeKfiQf4yYQYvutkWSNXjBwJSp/pMBZra', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(57, 'Hartman Chavez', 'hartmanchavez@baluba.com', 'Hartman Chavez', 2, 'bronze', 'active', 'SLB-1057', NULL, '$2y$10$..UI5dmx7C4rmsQsOM6pb.YN7HGQKRO8dILipxpD4EABpq97ktFM2', NULL, '2019-08-23 10:39:54', '2019-08-23 10:39:54');

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
(1, 1, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(2, 2, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(3, 3, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(4, 4, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(5, 5, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(6, 6, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(7, 7, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(8, 8, 'cd', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(9, 9, 'active', '2019-08-23 10:39:50', '2019-08-23 10:39:50'),
(10, 10, 'cd', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(11, 11, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(12, 12, 'cd', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(13, 13, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(14, 14, 'cd', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(15, 15, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(16, 16, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(17, 17, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(18, 18, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(19, 19, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(20, 20, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(21, 21, 'active', '2019-08-23 10:39:51', '2019-08-23 10:39:51'),
(22, 22, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(23, 23, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(24, 24, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(25, 25, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(26, 26, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(27, 27, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(28, 28, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(29, 29, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(30, 30, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(31, 31, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(32, 32, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(33, 33, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(34, 34, 'active', '2019-08-23 10:39:52', '2019-08-23 10:39:52'),
(35, 35, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(36, 36, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(37, 37, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(38, 38, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(39, 39, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(40, 40, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(41, 41, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(42, 42, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(43, 43, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(44, 44, 'active', '2019-08-23 10:39:53', '2019-08-23 10:39:53'),
(45, 45, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(46, 46, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(47, 47, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(48, 48, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(49, 49, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(50, 50, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(51, 51, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(52, 52, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(53, 53, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(54, 54, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(55, 55, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(56, 56, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54'),
(57, 57, 'active', '2019-08-23 10:39:54', '2019-08-23 10:39:54');

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
(1, 1, 6250, 5625, '2019-08-23 10:40:16', '2019-08-23 10:42:44'),
(2, 2, 3250, 2925, '2019-08-23 10:40:20', '2019-08-23 10:42:08'),
(3, 3, 3250, 2925, '2019-08-23 10:40:26', '2019-08-23 10:42:44'),
(4, 4, 1750, 1575, '2019-08-23 10:40:33', '2019-08-23 10:41:53'),
(5, 5, 1750, 1575, '2019-08-23 10:41:02', '2019-08-23 10:42:08'),
(6, 6, 1750, 1575, '2019-08-23 10:41:10', '2019-08-23 10:42:28'),
(7, 7, 1750, 1575, '2019-08-23 10:41:16', '2019-08-23 10:42:44'),
(8, 8, -3995, -3995, '2019-08-23 10:41:46', '2019-08-23 10:41:46'),
(9, 9, 0, 0, '2019-08-23 10:41:53', '2019-08-23 10:41:53'),
(10, 10, -3995, -3995, '2019-08-23 10:42:03', '2019-08-23 10:42:03'),
(11, 11, 0, 0, '2019-08-23 10:42:08', '2019-08-23 10:42:08'),
(12, 12, -3995, -3995, '2019-08-23 10:42:15', '2019-08-23 10:42:15'),
(13, 13, 0, 0, '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(14, 14, -3995, -3995, '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(15, 15, 0, 0, '2019-08-23 10:42:44', '2019-08-23 10:42:44');

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
(1, 1, 500, 'Referal Reward', '2019-08-23 10:40:20', '2019-08-23 10:40:20'),
(2, 1, 750, 'Match Point Reward', '2019-08-23 10:40:26', '2019-08-23 10:40:26'),
(3, 1, 500, 'Referal Reward', '2019-08-23 10:40:26', '2019-08-23 10:40:26'),
(4, 2, 500, 'Referal Reward', '2019-08-23 10:40:33', '2019-08-23 10:40:33'),
(5, 2, 750, 'Match Point Reward', '2019-08-23 10:41:02', '2019-08-23 10:41:02'),
(6, 2, 500, 'Referal Reward', '2019-08-23 10:41:02', '2019-08-23 10:41:02'),
(7, 1, 750, 'Match Point Reward', '2019-08-23 10:41:10', '2019-08-23 10:41:10'),
(8, 3, 500, 'Referal Reward', '2019-08-23 10:41:10', '2019-08-23 10:41:10'),
(9, 3, 750, 'Match Point Reward', '2019-08-23 10:41:16', '2019-08-23 10:41:16'),
(10, 1, 750, 'Match Point Reward', '2019-08-23 10:41:16', '2019-08-23 10:41:16'),
(11, 3, 500, 'Referal Reward', '2019-08-23 10:41:16', '2019-08-23 10:41:16'),
(12, 4, 500, 'Referal Reward', '2019-08-23 10:41:46', '2019-08-23 10:41:46'),
(13, 4, 750, 'Match Point Reward', '2019-08-23 10:41:53', '2019-08-23 10:41:53'),
(14, 4, 500, 'Referal Reward', '2019-08-23 10:41:53', '2019-08-23 10:41:53'),
(15, 2, 750, 'Match Point Reward', '2019-08-23 10:42:03', '2019-08-23 10:42:03'),
(16, 5, 500, 'Referal Reward', '2019-08-23 10:42:03', '2019-08-23 10:42:03'),
(17, 5, 750, 'Match Point Reward', '2019-08-23 10:42:08', '2019-08-23 10:42:08'),
(18, 2, 750, 'Match Point Reward', '2019-08-23 10:42:08', '2019-08-23 10:42:08'),
(19, 5, 500, 'Referal Reward', '2019-08-23 10:42:08', '2019-08-23 10:42:08'),
(20, 1, 750, 'Match Point Reward', '2019-08-23 10:42:15', '2019-08-23 10:42:15'),
(21, 6, 500, 'Referal Reward', '2019-08-23 10:42:15', '2019-08-23 10:42:15'),
(22, 6, 750, 'Match Point Reward', '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(23, 1, 750, 'Match Point Reward', '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(24, 6, 500, 'Referal Reward', '2019-08-23 10:42:28', '2019-08-23 10:42:28'),
(25, 3, 750, 'Match Point Reward', '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(26, 1, 750, 'Match Point Reward', '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(27, 7, 500, 'Referal Reward', '2019-08-23 10:42:38', '2019-08-23 10:42:38'),
(28, 7, 750, 'Match Point Reward', '2019-08-23 10:42:44', '2019-08-23 10:42:44'),
(29, 3, 750, 'Match Point Reward', '2019-08-23 10:42:44', '2019-08-23 10:42:44'),
(30, 1, 750, 'Match Point Reward', '2019-08-23 10:42:44', '2019-08-23 10:42:44'),
(31, 7, 500, 'Referal Reward', '2019-08-23 10:42:44', '2019-08-23 10:42:44');

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
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

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
