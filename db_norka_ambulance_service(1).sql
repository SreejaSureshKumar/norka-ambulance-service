-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2025 at 06:50 AM
-- Server version: 8.0.42-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_norka_ambulance_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_service_details`
--

CREATE TABLE `ambulance_service_details` (
  `id` bigint NOT NULL,
  `application_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deceased_person_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name of the deceased',
  `passport_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Passport number of the deceased',
  `country` int NOT NULL COMMENT 'Country where death occurred',
  `state` int DEFAULT NULL,
  `district` int DEFAULT NULL,
  `contact_abroad_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contact person abroad',
  `contact_abroad_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Phone number abroad',
  `contact_local_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contact person in Kerala',
  `contact_local_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Phone number in Kerala',
  `alt_contact_abroad_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alt_contact_abroad_phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alt_contact_local_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alt_contact_local_phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `departure_date_time` datetime DEFAULT NULL,
  `arriving_date_time` datetime DEFAULT NULL,
  `flight_no` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `native_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'default=0,1=if norka needs to arrange for cargo services',
  `application_status` int NOT NULL DEFAULT '0' COMMENT 'default -0,submitted -1,approve-2,rejected-3',
  `application_attachment` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `intimation_flag` int NOT NULL DEFAULT '0',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `processed_by` int DEFAULT NULL,
  `processed_date` timestamp NULL DEFAULT NULL,
  `created_by` int NOT NULL COMMENT 'pk of users',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance_service_details`
--

INSERT INTO `ambulance_service_details` (`id`, `application_no`, `deceased_person_name`, `passport_no`, `country`, `state`, `district`, `contact_abroad_name`, `contact_abroad_phone`, `contact_local_name`, `contact_local_phone`, `alt_contact_abroad_name`, `alt_contact_abroad_phone`, `alt_contact_local_name`, `alt_contact_local_phone`, `departure_date_time`, `arriving_date_time`, `flight_no`, `native_address`, `application_status`, `application_attachment`, `intimation_flag`, `remarks`, `processed_by`, `processed_date`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'NRK/A/481092/2025', 'Test2', 'dsfsdfsd', 15, 17, 182, 'dfsdffsdf', '40 890 34 56', 'ytytyb', '6781235466', NULL, NULL, NULL, NULL, '2025-06-22 14:32:00', '2025-06-21 07:02:34', 'ghfghfgj656546456', 'gghjkgh hhy tytrytrytr', 3, 'public/documents/1750489354.pdf', 0, 'rejected', 4, '2025-07-04 01:54:23', 10, '2025-06-21 01:32:34', '2025-07-04 01:54:23'),
(2, 'NRK/A/581342/2025', 'Test name', 'ghgfhfgh', 72, 18, 7, 'Antanio', '6 78 90 12 47', 'Test local', '6789123456', NULL, NULL, NULL, NULL, '2025-06-22 10:00:00', '2025-06-21 20:00:00', 'PR67890', 'Test Address', 1, 'public/documents/1750504177.pdf', 0, NULL, NULL, NULL, 10, '2025-06-21 05:39:37', '2025-06-21 05:39:37'),
(3, 'NRK/A/370402/2025', 'Test3', 'fgdfgdfg', 11, 17, 269, 'gdfgdfgdfg', '98 765432', 'trrytryr', '6789012456', NULL, NULL, NULL, NULL, '2025-06-28 17:00:00', '2025-06-21 18:00:00', 'DF4545hg', 'rt trert werwer e r', 1, 'public/documents/1750505422.pdf', 0, NULL, NULL, NULL, 10, '2025-06-21 06:00:22', '2025-06-21 06:00:22'),
(4, 'ROOTS/D&SDI/A1164730/2025', 'Ramdas', 'P9087655', 17, 18, 11, 'Emergency Contact', '3400 4567', 'Charandas', '9076543210', 'alt contact', '3444 6789', NULL, NULL, '2025-07-03 12:00:00', '2025-07-03 16:00:00', 'R4567890', 'Communication Address , Communication Address', 2, 'documents/1751541424.pdf', 0, 'veried', 4, '2025-07-04 01:50:00', 14, '2025-07-02 04:00:49', '2025-07-04 01:50:00'),
(6, NULL, 'Ambujakshan M', 'P890123', 229, NULL, NULL, 'Sarath D', '56 789 0123', 'Anil Kumar', '89056 78900', 'Rajan K', '54 789 0987', NULL, NULL, NULL, NULL, NULL, 'Anil Bhavan,Communication Address', 0, NULL, 1, NULL, NULL, NULL, 14, '2025-07-03 06:11:03', '2025-07-03 06:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `component_id` int NOT NULL,
  `component_name` varchar(250) NOT NULL,
  `component_path` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '#',
  `component_parent` int DEFAULT '0' COMMENT '0 -main menu \r\n',
  `component_order` int NOT NULL,
  `component_icon` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `component_status` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`component_id`, `component_name`, `component_path`, `component_parent`, `component_order`, `component_icon`, `component_status`, `created_at`, `updated_at`) VALUES
(1, 'DashBoard', 'home.index', 0, 1, 'ti ti-brand-chrome', 1, '2025-05-28 01:07:09', '2025-05-28 01:07:09'),
(2, 'Master Settings', NULL, 0, 2, 'ti ti-settings', 1, '2025-05-27 04:40:39', '2025-05-27 04:40:39'),
(3, 'Users', 'users.index', 2, 1, NULL, 1, '2025-05-28 01:09:43', '2025-06-01 05:54:56'),
(4, 'UserType', 'usertypes.index', 2, 2, '', 1, '2025-05-28 01:29:57', '2025-05-28 01:29:57'),
(5, 'Components', 'usercomponent.index', 2, 3, '', 1, '2025-05-28 03:01:08', '2025-05-28 03:01:08'),
(6, 'Component Permission', 'userpermission.index', 2, 4, '', 1, '2025-05-28 03:17:46', '2025-05-28 03:17:46'),
(7, 'Application', '', 0, 5, 'ti ti-file-diff', 1, '2025-05-28 23:26:07', '2025-05-28 23:26:07'),
(8, 'Application History', 'beneficiary.index', 7, 1, NULL, 1, '2025-05-30 18:49:12', '2025-06-01 20:19:22'),
(10, 'DashBoard', 'home.admin', 0, 1, 'ti ti-brand-chrome', 1, '2025-06-01 19:09:30', '2025-06-01 19:09:30'),
(11, 'Dashboard', 'home.beneficiary', 0, 1, 'ti ti-brand-chrome', 1, '2025-06-01 19:51:01', '2025-06-01 19:51:01'),
(12, 'New Applications', 'application.index', 16, 1, NULL, 1, '2025-06-04 19:12:01', '2025-06-17 22:37:42'),
(13, 'Dashboard', 'home.official', 0, 1, 'ti ti-brand-chrome', 1, '2025-06-04 21:51:09', '2025-06-04 21:51:09'),
(14, 'Approved Applications', 'application.processed-list', 16, 1, NULL, 1, '2025-06-05 22:23:06', '2025-06-24 00:23:43'),
(15, 'Rejected Applications', 'application.rejected-list', 16, 2, NULL, 1, '2025-06-12 22:27:36', '2025-06-12 22:27:36'),
(16, 'Death Repartiation', NULL, 0, 2, 'ti ti-pokeball', 1, '2025-06-17 20:28:49', '2025-06-17 20:28:49'),
(17, 'Ambulance Service', NULL, 0, 3, 'ti ti-peace', 1, '2025-06-18 00:09:58', '2025-06-18 00:09:58'),
(18, 'New Application', 'service.application-list', 17, 1, NULL, 1, '2025-06-18 00:34:42', '2025-06-24 20:24:48'),
(19, 'Approved Applications', 'service.processed-list', 17, 2, NULL, 1, '2025-06-23 00:28:37', '2025-06-24 23:27:03'),
(20, 'Rejected Applications', 'service.rejected-list', 17, 3, NULL, 1, '2025-06-23 00:29:11', '2025-06-23 00:40:52'),
(22, 'new menu', NULL, 0, 1, 'ti ti-pokeball', 1, '2025-06-24 23:25:40', '2025-06-24 23:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `component_permissions`
--

CREATE TABLE `component_permissions` (
  `id` int NOT NULL,
  `component_id` int NOT NULL COMMENT 'pk of component table',
  `usertype_id` int NOT NULL COMMENT 'pk of usertype',
  `permission_status` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `component_permissions`
--

INSERT INTO `component_permissions` (`id`, `component_id`, `usertype_id`, `permission_status`, `created_at`, `updated_at`) VALUES
(11, 10, 1, 1, '2025-06-01 19:15:00', '2025-06-01 19:15:00'),
(13, 2, 1, 1, '2025-06-01 19:18:34', '2025-06-01 19:18:34'),
(14, 3, 1, 1, '2025-06-01 19:18:59', '2025-06-01 19:18:59'),
(15, 4, 1, 1, '2025-06-01 19:19:09', '2025-06-01 19:19:09'),
(16, 5, 1, 1, '2025-06-01 19:21:59', '2025-06-01 19:21:59'),
(17, 6, 1, 1, '2025-06-01 19:22:07', '2025-06-01 19:22:07'),
(18, 7, 2, 1, '2025-06-01 19:26:45', '2025-06-01 19:26:45'),
(19, 8, 2, 1, '2025-06-01 19:26:45', '2025-06-01 19:26:45'),
(20, 11, 2, 1, '2025-06-01 19:49:17', '2025-06-01 19:49:17'),
(27, 7, 2, 1, '2025-06-09 19:34:23', '2025-06-09 19:34:23'),
(37, 7, 2, 1, '2025-06-09 19:52:44', '2025-06-09 19:52:44'),
(38, 11, 2, 1, '2025-06-09 19:52:44', '2025-06-09 19:52:44'),
(70, 13, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(71, 16, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(72, 12, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(73, 14, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(74, 15, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(76, 18, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(77, 19, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(78, 20, 3, 1, '2025-06-24 23:13:28', '2025-06-25 00:01:54'),
(81, 17, 3, 1, '2025-06-24 23:56:12', '2025-06-25 00:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `deceased_person_details`
--

CREATE TABLE `deceased_person_details` (
  `id` bigint NOT NULL,
  `application_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deceased_person_name` varchar(100) NOT NULL COMMENT 'Name of the deceased',
  `passport_no` varchar(50) NOT NULL COMMENT 'Passport number of the deceased',
  `country` int NOT NULL,
  `death_date` date NOT NULL,
  `cause_of_death` text NOT NULL,
  `sponsor_details` text NOT NULL,
  `contact_abroad_name` varchar(200) NOT NULL COMMENT 'Contact person abroad',
  `contact_abroad_phone` varchar(50) NOT NULL COMMENT 'Phone number abroad',
  `contact_local_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Contact person in Kerala',
  `contact_local_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Phone number in Kerala',
  `airport_from` varchar(100) NOT NULL COMMENT 'Origin airport',
  `airport_to` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Destination airport',
  `native_address` text NOT NULL COMMENT 'default=0,1=if norka needs to arrange for cargo services',
  `cargo_norka_status` tinyint DEFAULT '0',
  `ambulance_service_status` int DEFAULT NULL,
  `alt_contact_abroad_name` varchar(200) DEFAULT NULL,
  `alt_contact_abroad_phone` varchar(50) DEFAULT NULL,
  `alt_contact_local_name` varchar(200) DEFAULT NULL,
  `alt_contact_local_phone` varchar(50) DEFAULT NULL,
  `intimation_flag` int NOT NULL DEFAULT '0',
  `application_status` int NOT NULL COMMENT 'default -0,submitted -1,approve-2,rejected-3',
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `processed_by` int DEFAULT NULL,
  `processed_date` timestamp NULL DEFAULT NULL,
  `created_by` int NOT NULL COMMENT 'pk of users',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deceased_person_details`
--

INSERT INTO `deceased_person_details` (`id`, `application_no`, `deceased_person_name`, `passport_no`, `country`, `death_date`, `cause_of_death`, `sponsor_details`, `contact_abroad_name`, `contact_abroad_phone`, `contact_local_name`, `contact_local_phone`, `airport_from`, `airport_to`, `native_address`, `cargo_norka_status`, `ambulance_service_status`, `alt_contact_abroad_name`, `alt_contact_abroad_phone`, `alt_contact_local_name`, `alt_contact_local_phone`, `intimation_flag`, `application_status`, `remarks`, `processed_by`, `processed_date`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '', 'Das', 'P9078ghh', 17, '2025-05-31', 'Death cause', 'ABC company,Company Adrresdsafsaf,SAfdsfdsfdsfdsf', 'Jose', '3200 5678', 'Devajith', '8901234567', 'Bahrain Airport', 'Karipoor Airport', 'Gousiya Nagar, Edapally - Panvel Hwy\r\n671323 Kerala', 0, NULL, NULL, NULL, NULL, NULL, 0, 2, 'Application has been approved', 4, '2025-06-06 03:32:26', 10, '2025-06-03 06:33:36', '2025-06-06 03:32:26'),
(2, '', 'Anirudhan', 'P78912', 229, '2025-05-25', 'Death causing incident', 'AAAAASD\r\ndfdfdsfds efwefwerwerwerewr\r\nsfdsfsdfsdfdfd 79932', 'Saravanan', '56 789 1234', 'Ambareesh', '8765432178', 'UAE Airport', 'Karipoor Airport', 'Communication Address P O 7893253', 1, NULL, NULL, NULL, NULL, NULL, 0, 3, 'Reject', 4, '2025-06-06 05:49:53', 0, '2025-06-03 07:05:15', '2025-06-06 05:49:53'),
(3, 'NRK/D/749421/2025', 'Sainudeen', 'Jalaludeen', 17, '2025-06-02', 'Death cause', 'ABC Company ,ALSaj sector 123 North Al salala', 'Boby', '3400 2143', 'Sainaba Beevi', '7890123456', 'Bahrain Airport', 'Kochin airport', 'Address ,ABC TOwn Kochi', 1, NULL, NULL, NULL, NULL, NULL, 0, 2, 'hdfdhskfsd', 4, '2025-06-13 03:11:42', 10, '2025-06-09 00:03:53', '2025-06-13 03:11:42'),
(4, 'NRK/D/7494421/2025', 'John', 'P678123', 13, '2025-06-10', 'cause of death', 'Abc company,Address', 'Saravanan', '2 3456 7890', 'Saradha', '6789012349', 'Airport1', 'Airport 2', 'Communication Address', 0, NULL, NULL, NULL, NULL, NULL, 0, 2, 'bgbcvb', 4, '2025-07-04 01:31:05', 12, '2025-06-13 03:05:36', '2025-07-04 01:31:05'),
(5, 'NRK/D/123653/2025', 'Test name', 'P903789', 13, '2025-06-08', 'cause of death', 'AC COMPANY', 'Contact', '3600 1234', 'local contact', '8901234567', 'Departing Airport', 'Arriving Airport', 'communication address', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, 13, '2025-06-16 05:46:48', '2025-06-16 05:46:48'),
(6, 'NRK/D/750295/2025', 'Ravichandran', 'P903456', 10, '2025-06-08', 'Cause of Death', 'Sponsor NAme ,Sponsor  Address', 'Deepu', '9 11 5467-8900', 'Rajeev', '7890123456', 'Argentina Airport', 'Karipoor Airport', 'Communication Address', 0, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, 10, '2025-06-16 23:52:22', '2025-06-16 23:52:22'),
(7, 'NRK/D/266253/2025', 'asdasd', 'P7789222', 118, '2025-06-21', 'sdsad dsfd', 'sasfsf fsafff', 'ssafasfaff', '500 56789', 'sdfsdfds', '7890123456', 'ererere', 'hghghgh', 'hfhdfh gdfgfdgdf fgdfgdfg dfgdfgdf', 0, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, 10, '2025-06-21 01:30:39', '2025-06-21 01:30:39'),
(14, 'NRK/D/330316/2025', 'Ramdas', 'P9087655', 17, '2025-07-01', 'Cause of Death', 'Sponsor/Company/Organisation', 'Emergency Contact', '3400 4567', 'Charandas', '9076543210', 'sddsd', 'asdsadsad', 'Communication Address , Communication Address', 1, 1, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, 14, '2025-07-02 04:00:49', '2025-07-02 04:00:49'),
(15, 'ROOTS/D&SDI/MR116443/2025', 'Ambujakshan M', 'P890123', 229, '2025-06-29', 'The Cause of death field', 'The Sponsor details field', 'Sarath D', '56 789 0123', 'Anil Kumar', '89056 78900', 'Departing Airport', 'Arriving airport', 'Anil Bhavan,Communication Address', 0, 1, 'Rajan K', '54 789 0987', NULL, NULL, 1, 1, NULL, NULL, NULL, 14, '2025-07-03 06:11:03', '2025-07-03 06:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_22_055402_create_permission_tables', 1),
(5, '2025_05_22_061737_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_country`
--

CREATE TABLE `m_country` (
  `country_id` bigint UNSIGNED NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `currency_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_isd_code` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_country`
--

INSERT INTO `m_country` (`country_id`, `country_code`, `country_name`, `currency_code`, `country_isd_code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 'AFN', '93', 'Y', NULL, NULL),
(2, 'AL', 'Albania', 'ALL', '355', 'Y', NULL, NULL),
(3, 'DZ', 'Algeria', 'DZD', '213', 'Y', NULL, NULL),
(4, 'DS', 'American Samoa', '', '0', 'Y', NULL, NULL),
(5, 'AD', 'Andorra', 'EUR', '376', 'Y', NULL, NULL),
(6, 'AO', 'Angola', 'AOA', '244', 'Y', NULL, NULL),
(7, 'AI', 'Anguilla', 'XCD', '1-264', 'Y', NULL, NULL),
(8, 'AQ', 'Antarctica', 'AQD', '672', 'Y', NULL, NULL),
(9, 'AG', 'Antigua and Barbuda', 'XCD', '1-268', 'Y', NULL, NULL),
(10, 'AR', 'Argentina', 'ARS', '54', 'Y', NULL, NULL),
(11, 'AM', 'Armenia', 'AMD', '374', 'Y', NULL, NULL),
(12, 'AW', 'Aruba', 'ANG', '297', 'Y', NULL, NULL),
(13, 'AU', 'Australia', 'AUD', '61', 'Y', NULL, NULL),
(14, 'AT', 'Austria', 'EUR', '43', 'Y', NULL, NULL),
(15, 'AZ', 'Azerbaijan', 'AZN', '994', 'Y', NULL, NULL),
(16, 'BS', 'Bahamas', 'BSD', '1-242', 'Y', NULL, NULL),
(17, 'BH', 'Bahrain', 'BHD', '973', 'Y', NULL, NULL),
(18, 'BD', 'Bangladesh', 'BDT', '880', 'Y', NULL, NULL),
(19, 'BB', 'Barbados', 'BBD', '1-246', 'Y', NULL, NULL),
(20, 'BY', 'Belarus', 'BYR', '375', 'Y', NULL, NULL),
(21, 'BE', 'Belgium', 'EUR', '32', 'Y', NULL, NULL),
(22, 'BZ', 'Belize', 'BZD', '501', 'Y', NULL, NULL),
(23, 'BJ', 'Benin', 'XOF', '229', 'Y', NULL, NULL),
(24, 'BM', 'Bermuda', 'BMD', '1-441', 'Y', NULL, NULL),
(25, 'BT', 'Bhutan', 'INR', '975', 'Y', NULL, NULL),
(26, 'BO', 'Bolivia', 'BOB', '591', 'Y', NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', 'BAM', '387', 'Y', NULL, NULL),
(28, 'BW', 'Botswana', 'BWP', '267', 'Y', NULL, NULL),
(29, 'BV', 'Bouvet Island', 'NOK', '47', 'Y', NULL, NULL),
(30, 'BR', 'Brazil', 'BRL', '55', 'Y', NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', 'USD', '246', 'Y', NULL, NULL),
(32, 'BN', 'Brunei Darussalam', 'BND', '673', 'Y', NULL, NULL),
(33, 'BG', 'Bulgaria', 'BGN', '359', 'Y', NULL, NULL),
(34, 'BF', 'Burkina Faso', 'XOF', '226', 'Y', NULL, NULL),
(35, 'BI', 'Burundi', 'BIF', '257', 'Y', NULL, NULL),
(36, 'KH', 'Cambodia', 'KHR', '855', 'Y', NULL, NULL),
(37, 'CM', 'Cameroon', 'XAF', '237', 'Y', NULL, NULL),
(38, 'CA', 'Canada', 'CAD', '1', 'Y', NULL, NULL),
(39, 'CV', 'Cape Verde', 'CVE', '238', 'Y', NULL, NULL),
(40, 'KY', 'Cayman Islands', 'KYD', '1-345', 'Y', NULL, NULL),
(41, 'CF', 'Central African Republic', 'XAF', '236', 'Y', NULL, NULL),
(42, 'TD', 'Chad', 'XAF', '235', 'Y', NULL, NULL),
(43, 'CL', 'Chile', 'CLP', '56', 'Y', NULL, NULL),
(44, 'CN', 'China', 'CNY', '86', 'Y', NULL, NULL),
(45, 'CX', 'Christmas Island', 'AUD', '61', 'Y', NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', 'AUD', '61', 'Y', NULL, NULL),
(47, 'CO', 'Colombia', 'COP', '57', 'Y', NULL, NULL),
(48, 'KM', 'Comoros', 'KMF', '269', 'Y', NULL, NULL),
(49, 'CG', 'Congo', 'XAF', '242', 'Y', NULL, NULL),
(50, 'CK', 'Cook Islands', 'NZD', '682', 'Y', NULL, NULL),
(51, 'CR', 'Costa Rica', 'CRC', '506', 'Y', NULL, NULL),
(52, 'HR', 'Croatia (Hrvatska)', 'HRK', '385', 'Y', NULL, NULL),
(53, 'CU', 'Cuba', 'CUP', '53', 'Y', NULL, NULL),
(54, 'CY', 'Cyprus', 'CYP', '357', 'Y', NULL, NULL),
(55, 'CZ', 'Czech Republic', 'CZK', '420', 'Y', NULL, NULL),
(56, 'DK', 'Denmark', 'DKK', '45', 'Y', NULL, NULL),
(57, 'DJ', 'Djibouti', 'DJF', '253', 'Y', NULL, NULL),
(58, 'DM', 'Dominica', 'XCD', '1-767', 'Y', NULL, NULL),
(59, 'DO', 'Dominican Republic', 'DOP', '1-809', 'Y', NULL, NULL),
(60, 'TP', 'East Timor', 'IDR', '0', 'Y', NULL, NULL),
(61, 'EC', 'Ecuador', 'ECS', '593', 'Y', NULL, NULL),
(62, 'EG', 'Egypt', 'EGP', '20', 'Y', NULL, NULL),
(63, 'SV', 'El Salvador', 'SVC', '503', 'Y', NULL, NULL),
(64, 'GQ', 'Equatorial Guinea', 'XAF', '240', 'Y', NULL, NULL),
(65, 'ER', 'Eritrea', 'ETB', '291', 'Y', NULL, NULL),
(66, 'EE', 'Estonia', 'EEK', '372', 'Y', NULL, NULL),
(67, 'ET', 'Ethiopia', 'ETB', '251', 'Y', NULL, NULL),
(68, 'FK', 'Falkland Islands (Malvinas)', 'FKP', '500', 'Y', NULL, NULL),
(69, 'FO', 'Faroe Islands', 'DKK', '298', 'Y', NULL, NULL),
(70, 'FJ', 'Fiji', 'FJD', '679', 'Y', NULL, NULL),
(71, 'FI', 'Finland', 'EUR', '358', 'Y', NULL, NULL),
(72, 'FR', 'France', 'EUR', '33', 'Y', NULL, NULL),
(73, 'FX', 'France, Metropolitan', '', '0', 'Y', NULL, NULL),
(74, 'GF', 'French Guiana', 'EUR', '594', 'Y', NULL, NULL),
(75, 'PF', 'French Polynesia', 'XPF', '689', 'Y', NULL, NULL),
(76, 'TF', 'French Southern Territories', 'EUR', '', 'Y', NULL, NULL),
(77, 'GA', 'Gabon', 'XAF', '241', 'Y', NULL, NULL),
(78, 'GM', 'Gambia', 'GMD', '220', 'Y', NULL, NULL),
(79, 'GE', 'Georgia', 'GEL', '995', 'Y', NULL, NULL),
(80, 'DE', 'Germany', 'EUR', '49', 'Y', NULL, NULL),
(81, 'GH', 'Ghana', 'GHS', '233', 'Y', NULL, NULL),
(82, 'GI', 'Gibraltar', 'GIP', '350', 'Y', NULL, NULL),
(83, 'GK', 'Guernsey', '', '0', 'Y', NULL, NULL),
(84, 'GR', 'Greece', 'EUR', '30', 'Y', NULL, NULL),
(85, 'GL', 'Greenland', 'DKK', '299', 'Y', NULL, NULL),
(86, 'GD', 'Grenada', 'XCD', '1-473', 'Y', NULL, NULL),
(87, 'GP', 'Guadeloupe', 'EUR', '590', 'Y', NULL, NULL),
(88, 'GU', 'Guam', 'USD', '1-671', 'Y', NULL, NULL),
(89, 'GT', 'Guatemala', 'GTQ', '502', 'Y', NULL, NULL),
(90, 'GN', 'Guinea', 'GNF', '224', 'Y', NULL, NULL),
(91, 'GW', 'Guinea-Bissau', 'XOF', '245', 'Y', NULL, NULL),
(92, 'GY', 'Guyana', 'GYD', '592', 'Y', NULL, NULL),
(93, 'HT', 'Haiti', 'HTG', '509', 'Y', NULL, NULL),
(94, 'HM', 'Heard and Mc Donald Islands', 'AUD', '011', 'Y', NULL, NULL),
(95, 'HN', 'Honduras', 'HNL', '504', 'Y', NULL, NULL),
(96, 'HK', 'Hong Kong', 'HKD', '852', 'Y', NULL, NULL),
(97, 'HU', 'Hungary', 'HUF', '36', 'Y', NULL, NULL),
(98, 'IS', 'Iceland', 'ISK', '354', 'Y', NULL, NULL),
(99, 'IN', 'India', 'INR', '91', 'Y', NULL, NULL),
(100, 'IM', 'Isle of Man', 'GBP', '44-1624', 'Y', NULL, NULL),
(101, 'ID', 'Indonesia', 'IDR', '62', 'Y', NULL, NULL),
(102, 'IR', 'Iran (Islamic Republic of)', 'IRR', '98', 'Y', NULL, NULL),
(103, 'IQ', 'Iraq', 'IQD', '964', 'Y', NULL, NULL),
(104, 'IE', 'Ireland', 'EUR', '353', 'Y', NULL, NULL),
(105, 'IL', 'Israel', 'ILS', '972', 'Y', NULL, NULL),
(106, 'IT', 'Italy', 'EUR', '39', 'Y', NULL, NULL),
(107, 'CI', 'Ivory Coast', 'XOF', '225', 'Y', NULL, NULL),
(108, 'JE', 'Jersey', 'GBP', '44-1534', 'Y', NULL, NULL),
(109, 'JM', 'Jamaica', 'JMD', '1-876', 'Y', NULL, NULL),
(110, 'JP', 'Japan', 'JPY', '81', 'Y', NULL, NULL),
(111, 'JO', 'Jordan', 'JOD', '962', 'Y', NULL, NULL),
(112, 'KZ', 'Kazakhstan', 'KZT', '7', 'Y', NULL, NULL),
(113, 'KE', 'Kenya', 'KES', '254', 'Y', NULL, NULL),
(114, 'KI', 'Kiribati', 'AUD', '686', 'Y', NULL, NULL),
(115, 'KP', 'Korea, Democratic People\'s Republic of', 'KPW', '850', 'Y', NULL, NULL),
(116, 'KR', 'Korea, Republic of', 'KRW', '82', 'Y', NULL, NULL),
(117, 'XK', 'Kosovo', '', '383', 'Y', NULL, NULL),
(118, 'KW', 'Kuwait', 'KWD', '965', 'Y', NULL, NULL),
(119, 'KG', 'Kyrgyzstan', 'KGS', '996', 'Y', NULL, NULL),
(120, 'LA', 'Lao People\'s Democratic Republic', 'LAK', '856', 'Y', NULL, NULL),
(121, 'LV', 'Latvia', 'LVL', '371', 'Y', NULL, NULL),
(122, 'LB', 'Lebanon', 'LBP', '961', 'Y', NULL, NULL),
(123, 'LS', 'Lesotho', 'LSL', '266', 'Y', NULL, NULL),
(124, 'LR', 'Liberia', 'LRD', '231', 'Y', NULL, NULL),
(125, 'LY', 'Libyan Arab Jamahiriya', 'LYD', '218', 'Y', NULL, NULL),
(126, 'LI', 'Liechtenstein', 'CHF', '423', 'Y', NULL, NULL),
(127, 'LT', 'Lithuania', 'LTL', '370', 'Y', NULL, NULL),
(128, 'LU', 'Luxembourg', 'EUR', '352', 'Y', NULL, NULL),
(129, 'MO', 'Macau', 'MOP', '853', 'Y', NULL, NULL),
(130, 'MK', 'Macedonia', 'MKD', '389', 'Y', NULL, NULL),
(131, 'MG', 'Madagascar', 'MGA', '261', 'Y', NULL, NULL),
(132, 'MW', 'Malawi', 'MWK', '265', 'Y', NULL, NULL),
(133, 'MY', 'Malaysia', 'MYR', '60', 'Y', NULL, NULL),
(134, 'MV', 'Maldives', 'MVR', '960', 'Y', NULL, NULL),
(135, 'ML', 'Mali', 'XOF', '223', 'Y', NULL, NULL),
(136, 'MT', 'Malta', 'MTL', '356', 'Y', NULL, NULL),
(137, 'MH', 'Marshall Islands', 'USD', '692', 'Y', NULL, NULL),
(138, 'MQ', 'Martinique', 'EUR', '596', 'Y', NULL, NULL),
(139, 'MR', 'Mauritania', 'MRO', '222', 'Y', NULL, NULL),
(140, 'MU', 'Mauritius', 'MUR', '230', 'Y', NULL, NULL),
(141, 'TY', 'Mayotte', '', '0', 'Y', NULL, NULL),
(142, 'MX', 'Mexico', 'MXN', '52', 'Y', NULL, NULL),
(143, 'FM', 'Micronesia, Federated States of', 'USD', '691', 'Y', NULL, NULL),
(144, 'MD', 'Moldova, Republic of', 'MDL', '373', 'Y', NULL, NULL),
(145, 'MC', 'Monaco', 'EUR', '377', 'Y', NULL, NULL),
(146, 'MN', 'Mongolia', 'MNT', '976', 'Y', NULL, NULL),
(147, 'ME', 'Montenegro', 'EUR', '382', 'Y', NULL, NULL),
(148, 'MS', 'Montserrat', 'XCD', '1-664', 'Y', NULL, NULL),
(149, 'MA', 'Morocco', 'MAD', '212', 'Y', NULL, NULL),
(150, 'MZ', 'Mozambique', 'MZN', '258', 'Y', NULL, NULL),
(151, 'MM', 'Myanmar', 'MMK', '95', 'Y', NULL, NULL),
(152, 'NA', 'Namibia', 'NAD', '264', 'Y', NULL, NULL),
(153, 'NR', 'Nauru', 'AUD', '674', 'Y', NULL, NULL),
(154, 'NP', 'Nepal', 'NPR', '977', 'Y', NULL, NULL),
(155, 'NL', 'Netherlands', 'EUR', '31', 'Y', NULL, NULL),
(156, 'AN', 'Netherlands Antilles', 'ANG', '599', 'Y', NULL, NULL),
(157, 'NC', 'New Caledonia', 'XPF', '687	', 'Y', NULL, NULL),
(158, 'NZ', 'New Zealand', 'NZD', '64', 'Y', NULL, NULL),
(159, 'NI', 'Nicaragua', 'NIO', '505', 'Y', NULL, NULL),
(160, 'NE', 'Niger', 'XOF', '227', 'Y', NULL, NULL),
(161, 'NG', 'Nigeria', 'NGN', '234', 'Y', NULL, NULL),
(162, 'NU', 'Niue', 'NZD', '683', 'Y', NULL, NULL),
(163, 'NF', 'Norfolk Island', 'AUD', '672', 'Y', NULL, NULL),
(164, 'MP', 'Northern Mariana Islands', 'USD', '1-670', 'Y', NULL, NULL),
(165, 'NO', 'Norway', 'NOK', '47', 'Y', NULL, NULL),
(166, 'OM', 'Oman', 'OMR', '968', 'Y', NULL, NULL),
(167, 'PK', 'Pakistan', 'PKR', '92', 'Y', NULL, NULL),
(168, 'PW', 'Palau', 'USD', '680', 'Y', NULL, NULL),
(169, 'PS', 'Palestine', 'JOD', '970', 'Y', NULL, NULL),
(170, 'PA', 'Panama', 'PAB', '507', 'Y', NULL, NULL),
(171, 'PG', 'Papua New Guinea', 'PGK', '675', 'Y', NULL, NULL),
(172, 'PY', 'Paraguay', 'PYG', '595', 'Y', NULL, NULL),
(173, 'PE', 'Peru', 'PEN', '51', 'Y', NULL, NULL),
(174, 'PH', 'Philippines', 'PHP', '63', 'Y', NULL, NULL),
(175, 'PN', 'Pitcairn', 'NZD', '64', 'Y', NULL, NULL),
(176, 'PL', 'Poland', 'PLN', '48', 'Y', NULL, NULL),
(177, 'PT', 'Portugal', 'EUR', '351', 'Y', NULL, NULL),
(178, 'PR', 'Puerto Rico', 'USD', '1-787', 'Y', NULL, NULL),
(179, 'QA', 'Qatar', 'QAR', '974', 'Y', NULL, NULL),
(180, 'RE', 'Reunion', 'EUR', '262', 'Y', NULL, NULL),
(181, 'RO', 'Romania', 'RON', '40', 'Y', NULL, NULL),
(182, 'RU', 'Russian Federation', 'RUB', '7', 'Y', NULL, NULL),
(183, 'RW', 'Rwanda', 'RWF', '250', 'Y', NULL, NULL),
(184, 'KN', 'Saint Kitts and Nevis', 'XCD', '1-869', 'Y', NULL, NULL),
(185, 'LC', 'Saint Lucia', 'XCD', '1-758', 'Y', NULL, NULL),
(186, 'VC', 'Saint Vincent and the Grenadines', 'XCD', '1-784', 'Y', NULL, NULL),
(187, 'WS', 'Samoa', 'EUR', '685', 'Y', NULL, NULL),
(188, 'SM', 'San Marino', 'EUR', '378', 'Y', NULL, NULL),
(189, 'ST', 'Sao Tome and Principe', 'STD', '239', 'Y', NULL, NULL),
(190, 'SA', 'Saudi Arabia', 'SAR', '966', 'Y', NULL, NULL),
(191, 'SN', 'Senegal', 'XOF', '221', 'Y', NULL, NULL),
(192, 'RS', 'Serbia', 'RSD', '381', 'Y', NULL, NULL),
(193, 'SC', 'Seychelles', 'SCR', '248', 'Y', NULL, NULL),
(194, 'SL', 'Sierra Leone', 'SLL', '232', 'Y', NULL, NULL),
(195, 'SG', 'Singapore', 'SGD', '65', 'Y', NULL, NULL),
(196, 'SK', 'Slovakia', 'SKK', '421', 'Y', NULL, NULL),
(197, 'SI', 'Slovenia', 'EUR', '386', 'Y', NULL, NULL),
(198, 'SB', 'Solomon Islands', 'SBD', '677', 'Y', NULL, NULL),
(199, 'SO', 'Somalia', 'SOS', '252', 'Y', NULL, NULL),
(200, 'ZA', 'South Africa', 'ZAR', '27', 'Y', NULL, NULL),
(201, 'GS', 'South Georgia South Sandwich Islands', 'GBP', '500', 'Y', NULL, NULL),
(202, 'SS', 'South Sudan', '', '0', 'Y', NULL, NULL),
(203, 'ES', 'Spain', 'EUR', '34', 'Y', NULL, NULL),
(204, 'LK', 'Sri Lanka', 'LKR', '94', 'Y', NULL, NULL),
(205, 'SH', 'St. Helena', 'GBP', '290', 'Y', NULL, NULL),
(206, 'PM', 'St. Pierre and Miquelon', 'EUR', '508', 'Y', NULL, NULL),
(207, 'SD', 'Sudan', 'SDG', '249', 'Y', NULL, NULL),
(208, 'SR', 'Suriname', 'SRD', '597', 'Y', NULL, NULL),
(209, 'SJ', 'Svalbard and Jan Mayen Islands', 'NOK', '47', 'Y', NULL, NULL),
(210, 'SZ', 'Swaziland', 'SZL', '268', 'Y', NULL, NULL),
(211, 'SE', 'Sweden', 'SEK', '46', 'Y', NULL, NULL),
(212, 'CH', 'Switzerland', 'CHF', '41', 'Y', NULL, NULL),
(213, 'SY', 'Syrian Arab Republic', 'SYP', '963', 'Y', NULL, NULL),
(214, 'TW', 'Taiwan', 'TWD', '886', 'Y', NULL, NULL),
(215, 'TJ', 'Tajikistan', 'TJS', '992', 'Y', NULL, NULL),
(216, 'TZ', 'Tanzania, United Republic of', 'TZS', '255', 'Y', NULL, NULL),
(217, 'TH', 'Thailand', 'THB', '66', 'Y', NULL, NULL),
(218, 'TG', 'Togo', 'XOF', '228', 'Y', NULL, NULL),
(219, 'TK', 'Tokelau', 'NZD', '690', 'Y', NULL, NULL),
(220, 'TO', 'Tonga', 'TOP', '676', 'Y', NULL, NULL),
(221, 'TT', 'Trinidad and Tobago', 'TTD', '1-868', 'Y', NULL, NULL),
(222, 'TN', 'Tunisia', 'TND', '216', 'Y', NULL, NULL),
(223, 'TR', 'Turkey', 'TRY', '90', 'Y', NULL, NULL),
(224, 'TM', 'Turkmenistan', 'TMT', '993', 'Y', NULL, NULL),
(225, 'TC', 'Turks and Caicos Islands', 'USD', '1-649', 'Y', NULL, NULL),
(226, 'TV', 'Tuvalu', 'AUD', '688', 'Y', NULL, NULL),
(227, 'UG', 'Uganda', 'UGX', '256', 'Y', NULL, NULL),
(228, 'UA', 'Ukraine', 'UAH', '380', 'Y', NULL, NULL),
(229, 'AE', 'United Arab Emirates', 'AED', '971', 'Y', NULL, NULL),
(230, 'GB', 'United Kingdom', 'GBP', '44', 'Y', NULL, NULL),
(231, 'US', 'United States', 'USD', '1', 'Y', NULL, NULL),
(232, 'UM', 'United States minor outlying islands', 'USD', '246', 'Y', NULL, NULL),
(233, 'UY', 'Uruguay', 'UYU', '598', 'Y', NULL, NULL),
(234, 'UZ', 'Uzbekistan', 'UZS', '998', 'Y', NULL, NULL),
(235, 'VU', 'Vanuatu', 'VUV', '678', 'Y', NULL, NULL),
(236, 'VA', 'Vatican City State', 'EUR', '379', 'Y', NULL, NULL),
(237, 'VE', 'Venezuela', 'VEF', '58', 'Y', NULL, NULL),
(238, 'VN', 'Vietnam', 'VND', '84', 'Y', NULL, NULL),
(239, 'VG', 'Virgin Islands (British)', 'USD', '1-284', 'Y', NULL, NULL),
(240, 'VI', 'Virgin Islands (U.S.)', 'USD', '1-340', 'Y', NULL, NULL),
(241, 'WF', 'Wallis and Futuna Islands', 'XPF', '681', 'Y', NULL, NULL),
(242, 'EH', 'Western Sahara', 'MAD', '212', 'Y', NULL, NULL),
(243, 'YE', 'Yemen', 'YER', '967', 'Y', NULL, NULL),
(244, 'ZR', 'Zaire', '', '0', 'Y', NULL, NULL),
(245, 'ZM', 'Zambia', 'ZMK', '260', 'Y', NULL, NULL),
(246, 'ZW', 'Zimbabwe', 'ZWD', '263', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_district`
--

CREATE TABLE `m_district` (
  `district_id` bigint UNSIGNED NOT NULL,
  `state_id` int NOT NULL DEFAULT '0',
  `district_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `district_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_num_code` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_district`
--

INSERT INTO `m_district` (`district_id`, `state_id`, `district_name`, `district_code`, `district_num_code`, `district_status`, `created_at`, `updated_at`) VALUES
(1, 18, 'Thiruvananthapuram', 'TVM', '01', 1, NULL, NULL),
(2, 18, 'Kollam', 'KLM', '02', 1, NULL, NULL),
(3, 18, 'Pathanamthitta', 'PTA', '03', 1, NULL, NULL),
(4, 18, 'Alappuzha', 'ALP', '04', 1, NULL, NULL),
(5, 18, 'Kottayam', 'KTM', '05', 1, NULL, NULL),
(6, 18, 'Idukki', 'IDK', '06', 1, NULL, NULL),
(7, 18, 'Ernakulam', 'EKM', '07', 1, NULL, NULL),
(8, 18, 'Thrissur', 'TSR', '08', 1, NULL, NULL),
(9, 18, 'Palakkad', 'PKD', '09', 1, NULL, NULL),
(10, 18, 'Malappuram', 'MLP', '10', 1, NULL, NULL),
(11, 18, 'Kozhikode', 'KKD', '11', 1, NULL, NULL),
(12, 18, 'Wayanad', 'WYD', '12', 1, NULL, NULL),
(13, 18, 'Kannur', 'KNR', '13', 1, NULL, NULL),
(14, 18, 'Kasaragod', 'KSGD', '14', 1, NULL, NULL),
(15, 1, 'North Andaman', NULL, NULL, 1, NULL, NULL),
(16, 1, 'South Andaman', NULL, NULL, 1, NULL, NULL),
(17, 1, 'Nicobar', NULL, NULL, 1, NULL, NULL),
(18, 2, 'Adilabad', NULL, NULL, 1, NULL, NULL),
(19, 2, 'Anantapur', NULL, NULL, 1, NULL, NULL),
(20, 2, 'Chittoor', NULL, NULL, 1, NULL, NULL),
(21, 2, 'East Godavari', NULL, NULL, 1, NULL, NULL),
(22, 2, 'Guntur', NULL, NULL, 1, NULL, NULL),
(23, 2, 'Hyderabad', NULL, NULL, 1, NULL, NULL),
(24, 2, 'Karimnagar', NULL, NULL, 1, NULL, NULL),
(25, 2, 'Khammam', NULL, NULL, 1, NULL, NULL),
(26, 2, 'Krishna', NULL, NULL, 1, NULL, NULL),
(27, 2, 'Kurnool', NULL, NULL, 1, NULL, NULL),
(28, 2, 'Mahbubnagar', NULL, NULL, 1, NULL, NULL),
(29, 2, 'Medak', NULL, NULL, 1, NULL, NULL),
(30, 2, 'Nalgonda', NULL, NULL, 1, NULL, NULL),
(31, 2, 'Nizamabad', NULL, NULL, 1, NULL, NULL),
(32, 2, 'Prakasam', NULL, NULL, 1, NULL, NULL),
(33, 2, 'Ranga Reddy', NULL, NULL, 1, NULL, NULL),
(34, 2, 'Srikakulam', NULL, NULL, 1, NULL, NULL),
(35, 2, 'Sri Potti Sri Ramulu Nellore', NULL, NULL, 1, NULL, NULL),
(36, 2, 'Vishakhapatnam', NULL, NULL, 1, NULL, NULL),
(37, 2, 'Vizianagaram', NULL, NULL, 1, NULL, NULL),
(38, 2, 'Warangal', NULL, NULL, 1, NULL, NULL),
(39, 2, 'West Godavari', NULL, NULL, 1, NULL, NULL),
(40, 2, 'Cudappah', NULL, NULL, 1, NULL, NULL),
(41, 3, 'Anjaw', NULL, NULL, 1, NULL, NULL),
(42, 3, 'Changlang', NULL, NULL, 1, NULL, NULL),
(43, 3, 'East Siang', NULL, NULL, 1, NULL, NULL),
(44, 3, 'East Kameng', NULL, NULL, 1, NULL, NULL),
(45, 3, 'Kurung Kumey', NULL, NULL, 1, NULL, NULL),
(46, 3, 'Lohit', NULL, NULL, 1, NULL, NULL),
(47, 3, 'Lower Dibang Valley', NULL, NULL, 1, NULL, NULL),
(48, 3, 'Lower Subansiri', NULL, NULL, 1, NULL, NULL),
(49, 3, 'Papum Pare', NULL, NULL, 1, NULL, NULL),
(50, 3, 'Tawang', NULL, NULL, 1, NULL, NULL),
(51, 3, 'Tirap', NULL, NULL, 1, NULL, NULL),
(52, 3, 'Dibang Valley', NULL, NULL, 1, NULL, NULL),
(53, 3, 'Upper Siang', NULL, NULL, 1, NULL, NULL),
(54, 3, 'Upper Subansiri', NULL, NULL, 1, NULL, NULL),
(55, 3, 'West Kameng', NULL, NULL, 1, NULL, NULL),
(56, 3, 'West Siang', NULL, NULL, 1, NULL, NULL),
(57, 4, 'Baksa', NULL, NULL, 1, NULL, NULL),
(58, 4, 'Barpeta', NULL, NULL, 1, NULL, NULL),
(59, 4, 'Bongaigaon', NULL, NULL, 1, NULL, NULL),
(60, 4, 'Cachar', NULL, NULL, 1, NULL, NULL),
(61, 4, 'Chirang', NULL, NULL, 1, NULL, NULL),
(62, 4, 'Darrang', NULL, NULL, 1, NULL, NULL),
(63, 4, 'Dhemaji', NULL, NULL, 1, NULL, NULL),
(64, 4, 'Dima Hasao', NULL, NULL, 1, NULL, NULL),
(65, 4, 'Dhubri', NULL, NULL, 1, NULL, NULL),
(66, 4, 'Dibrugarh', NULL, NULL, 1, NULL, NULL),
(67, 4, 'Goalpara', NULL, NULL, 1, NULL, NULL),
(68, 4, 'Golaghat', NULL, NULL, 1, NULL, NULL),
(69, 4, 'Hailakandi', NULL, NULL, 1, NULL, NULL),
(70, 4, 'Jorhat', NULL, NULL, 1, NULL, NULL),
(71, 4, 'Kamrup', NULL, NULL, 1, NULL, NULL),
(72, 4, 'Kamrup Metropolitan', NULL, NULL, 1, NULL, NULL),
(73, 4, 'Karbi Anglong', NULL, NULL, 1, NULL, NULL),
(74, 4, 'Karimganj', NULL, NULL, 1, NULL, NULL),
(75, 4, 'Kokrajhar', NULL, NULL, 1, NULL, NULL),
(76, 4, 'Lakhimpur', NULL, NULL, 1, NULL, NULL),
(77, 4, 'Morigaon', NULL, NULL, 1, NULL, NULL),
(78, 4, 'Nagaon', NULL, NULL, 1, NULL, NULL),
(79, 4, 'Nalbari', NULL, NULL, 1, NULL, NULL),
(80, 4, 'Sivasagar', NULL, NULL, 1, NULL, NULL),
(81, 4, 'Sonitpur', NULL, NULL, 1, NULL, NULL),
(82, 4, 'Tinsukia', NULL, NULL, 1, NULL, NULL),
(83, 4, 'Udalguri', NULL, NULL, 1, NULL, NULL),
(84, 5, 'Araria', NULL, NULL, 1, NULL, NULL),
(85, 5, 'Arwal', NULL, NULL, 1, NULL, NULL),
(86, 5, 'Aurangabad', NULL, NULL, 1, NULL, NULL),
(87, 5, 'Banka', NULL, NULL, 1, NULL, NULL),
(88, 5, 'Begusarai', NULL, NULL, 1, NULL, NULL),
(89, 5, 'Bhagalpur', NULL, NULL, 1, NULL, NULL),
(90, 5, 'Bhojpur', NULL, NULL, 1, NULL, NULL),
(91, 5, 'Buxar', NULL, NULL, 1, NULL, NULL),
(92, 5, 'Darbhanga', NULL, NULL, 1, NULL, NULL),
(93, 5, 'East Champaran', NULL, NULL, 1, NULL, NULL),
(94, 5, 'Gaya', NULL, NULL, 1, NULL, NULL),
(95, 5, 'Gopalganj', NULL, NULL, 1, NULL, NULL),
(96, 5, 'Jamui', NULL, NULL, 1, NULL, NULL),
(97, 5, 'Jehanabad', NULL, NULL, 1, NULL, NULL),
(98, 5, 'Kaimur', NULL, NULL, 1, NULL, NULL),
(99, 5, 'Katihar', NULL, NULL, 1, NULL, NULL),
(100, 5, 'Khagaria', NULL, NULL, 1, NULL, NULL),
(101, 5, 'Kishanganj', NULL, NULL, 1, NULL, NULL),
(102, 5, 'Lakhisarai', NULL, NULL, 1, NULL, NULL),
(103, 5, 'Madhepura', NULL, NULL, 1, NULL, NULL),
(104, 5, 'Madhubani', NULL, NULL, 1, NULL, NULL),
(105, 5, 'Munger', NULL, NULL, 1, NULL, NULL),
(106, 5, 'Muzaffarpur', NULL, NULL, 1, NULL, NULL),
(107, 5, 'Nalanda', NULL, NULL, 1, NULL, NULL),
(108, 5, 'Nawada', NULL, NULL, 1, NULL, NULL),
(109, 5, 'Patna', NULL, NULL, 1, NULL, NULL),
(110, 5, 'Purnia', NULL, NULL, 1, NULL, NULL),
(111, 5, 'Rohtas', NULL, NULL, 1, NULL, NULL),
(112, 5, 'Saharsa', NULL, NULL, 1, NULL, NULL),
(113, 5, 'Samastipur', NULL, NULL, 1, NULL, NULL),
(114, 5, 'Saran', NULL, NULL, 1, NULL, NULL),
(115, 5, 'Sheikhpura', NULL, NULL, 1, NULL, NULL),
(116, 5, 'Sheohar', NULL, NULL, 1, NULL, NULL),
(117, 5, 'Sitamarhi', NULL, NULL, 1, NULL, NULL),
(118, 5, 'Siwan', NULL, NULL, 1, NULL, NULL),
(119, 5, 'Supaul', NULL, NULL, 1, NULL, NULL),
(120, 6, 'Chandigarh', NULL, NULL, 1, NULL, NULL),
(121, 7, 'Bastar', NULL, NULL, 1, NULL, NULL),
(122, 7, 'Bijapur', NULL, NULL, 1, NULL, NULL),
(123, 7, 'Bilaspur', NULL, NULL, 1, NULL, NULL),
(124, 7, 'Dantewada', NULL, NULL, 1, NULL, NULL),
(125, 7, 'Dhamtari', NULL, NULL, 1, NULL, NULL),
(126, 7, 'Durg', NULL, NULL, 1, NULL, NULL),
(127, 7, 'Jashpur', NULL, NULL, 1, NULL, NULL),
(128, 7, 'Janjgir-Champa', NULL, NULL, 1, NULL, NULL),
(129, 7, 'Korba', NULL, NULL, 1, NULL, NULL),
(130, 7, 'Koriya', NULL, NULL, 1, NULL, NULL),
(131, 7, 'Kanker', NULL, NULL, 1, NULL, NULL),
(132, 7, 'Kabirdham (formerly Kawardha)', NULL, NULL, 1, NULL, NULL),
(133, 7, 'Mahasamund', NULL, NULL, 1, NULL, NULL),
(134, 7, 'Narayanpur', NULL, NULL, 1, NULL, NULL),
(135, 7, 'Raigarh', NULL, NULL, 1, NULL, NULL),
(136, 7, 'Rajnandgaon', NULL, NULL, 1, NULL, NULL),
(137, 7, 'Raipur', NULL, NULL, 1, NULL, NULL),
(138, 7, 'Surguja', NULL, NULL, 1, NULL, NULL),
(139, 8, 'Dadra and Nagar Haveli', NULL, NULL, 1, NULL, NULL),
(140, 9, 'Daman', NULL, NULL, 1, NULL, NULL),
(141, 9, 'Diu', NULL, NULL, 1, NULL, NULL),
(142, 10, 'Central Delhi', NULL, NULL, 1, NULL, NULL),
(143, 10, 'East Delhi', NULL, NULL, 1, NULL, NULL),
(144, 10, 'New Delhi', NULL, NULL, 1, NULL, NULL),
(145, 10, 'North Delhi', NULL, NULL, 1, NULL, NULL),
(146, 10, 'North East Delhi', NULL, NULL, 1, NULL, NULL),
(147, 10, 'North West Delhi', NULL, NULL, 1, NULL, NULL),
(148, 10, 'South Delhi', NULL, NULL, 1, NULL, NULL),
(149, 10, 'South West Delhi', NULL, NULL, 1, NULL, NULL),
(150, 10, 'West Delhi', NULL, NULL, 1, NULL, NULL),
(151, 11, 'North Goa', NULL, NULL, 1, NULL, NULL),
(152, 11, 'South Goa', NULL, NULL, 1, NULL, NULL),
(153, 12, 'Ahmedabad', NULL, NULL, 1, NULL, NULL),
(154, 12, 'Amreli district', NULL, NULL, 1, NULL, NULL),
(155, 12, 'Anand', NULL, NULL, 1, NULL, NULL),
(156, 12, 'Banaskantha', NULL, NULL, 1, NULL, NULL),
(157, 12, 'Bharuch', NULL, NULL, 1, NULL, NULL),
(158, 12, 'Bhavnagar', NULL, NULL, 1, NULL, NULL),
(159, 12, 'Dahod', NULL, NULL, 1, NULL, NULL),
(160, 12, 'The Dangs', NULL, NULL, 1, NULL, NULL),
(161, 12, 'Gandhinagar', NULL, NULL, 1, NULL, NULL),
(162, 12, 'Jamnagar', NULL, NULL, 1, NULL, NULL),
(163, 12, 'Junagadh', NULL, NULL, 1, NULL, NULL),
(164, 12, 'Kutch', NULL, NULL, 1, NULL, NULL),
(165, 12, 'Kheda', NULL, NULL, 1, NULL, NULL),
(166, 12, 'Mehsana', NULL, NULL, 1, NULL, NULL),
(167, 12, 'Narmada', NULL, NULL, 1, NULL, NULL),
(168, 12, 'Navsari', NULL, NULL, 1, NULL, NULL),
(169, 12, 'Patan', NULL, NULL, 1, NULL, NULL),
(170, 12, 'Panchmahal', NULL, NULL, 1, NULL, NULL),
(171, 12, 'Porbandar', NULL, NULL, 1, NULL, NULL),
(172, 12, 'Rajkot', NULL, NULL, 1, NULL, NULL),
(173, 12, 'Sabarkantha', NULL, NULL, 1, NULL, NULL),
(174, 12, 'Surendranagar', NULL, NULL, 1, NULL, NULL),
(175, 12, 'Surat', NULL, NULL, 1, NULL, NULL),
(176, 12, 'Tapi', NULL, NULL, 1, NULL, NULL),
(177, 12, 'Vadodara', NULL, NULL, 1, NULL, NULL),
(178, 12, 'Valsad', NULL, NULL, 1, NULL, NULL),
(179, 13, 'Ambala', NULL, NULL, 1, NULL, NULL),
(180, 13, 'Bhiwani', NULL, NULL, 1, NULL, NULL),
(181, 13, 'Faridabad', NULL, NULL, 1, NULL, NULL),
(182, 13, 'Fatehabad', NULL, NULL, 1, NULL, NULL),
(183, 13, 'Gurgaon', NULL, NULL, 1, NULL, NULL),
(184, 13, 'Hissar', NULL, NULL, 1, NULL, NULL),
(185, 13, 'Jhajjar', NULL, NULL, 1, NULL, NULL),
(186, 13, 'Jind', NULL, NULL, 1, NULL, NULL),
(187, 13, 'Karnal', NULL, NULL, 1, NULL, NULL),
(188, 13, 'Kaithal', NULL, NULL, 1, NULL, NULL),
(189, 13, 'Kurukshetra', NULL, NULL, 1, NULL, NULL),
(190, 13, 'Mahendragarh', NULL, NULL, 1, NULL, NULL),
(191, 13, 'Mewat', NULL, NULL, 1, NULL, NULL),
(192, 13, 'Palwal', NULL, NULL, 1, NULL, NULL),
(193, 13, 'Panchkula', NULL, NULL, 1, NULL, NULL),
(194, 13, 'Panipat', NULL, NULL, 1, NULL, NULL),
(195, 13, 'Rewari', NULL, NULL, 1, NULL, NULL),
(196, 13, 'Rohtak', NULL, NULL, 1, NULL, NULL),
(197, 13, 'Sirsa', NULL, NULL, 1, NULL, NULL),
(198, 13, 'Sonipat', NULL, NULL, 1, NULL, NULL),
(199, 13, 'Yamuna Nagar', NULL, NULL, 1, NULL, NULL),
(200, 14, 'Bilaspur', NULL, NULL, 1, NULL, NULL),
(201, 14, 'Chamba', NULL, NULL, 1, NULL, NULL),
(202, 14, 'Hamirpur', NULL, NULL, 1, NULL, NULL),
(203, 14, 'Kangra', NULL, NULL, 1, NULL, NULL),
(204, 14, 'Kinnaur', NULL, NULL, 1, NULL, NULL),
(205, 14, 'Kullu', NULL, NULL, 1, NULL, NULL),
(206, 14, 'Lahaul and Spiti', NULL, NULL, 1, NULL, NULL),
(207, 14, 'Mandi', NULL, NULL, 1, NULL, NULL),
(208, 14, 'Shimla', NULL, NULL, 1, NULL, NULL),
(209, 14, 'Sirmaur', NULL, NULL, 1, NULL, NULL),
(210, 14, 'Solan', NULL, NULL, 1, NULL, NULL),
(211, 14, 'Una', NULL, NULL, 1, NULL, NULL),
(212, 15, 'Anantnag', NULL, NULL, 1, NULL, NULL),
(213, 15, 'Badgam', NULL, NULL, 1, NULL, NULL),
(214, 15, 'Bandipora', NULL, NULL, 1, NULL, NULL),
(215, 15, 'Baramulla', NULL, NULL, 1, NULL, NULL),
(216, 15, 'Doda', NULL, NULL, 1, NULL, NULL),
(217, 15, 'Ganderbal', NULL, NULL, 1, NULL, NULL),
(218, 15, 'Jammu', NULL, NULL, 1, NULL, NULL),
(219, 15, 'Kargil', NULL, NULL, 1, NULL, NULL),
(220, 15, 'Kathua', NULL, NULL, 1, NULL, NULL),
(221, 15, 'Kishtwar', NULL, NULL, 1, NULL, NULL),
(222, 15, 'Kupwara', NULL, NULL, 1, NULL, NULL),
(223, 15, 'Kulgam', NULL, NULL, 1, NULL, NULL),
(224, 15, 'Leh', NULL, NULL, 1, NULL, NULL),
(225, 15, 'Poonch', NULL, NULL, 1, NULL, NULL),
(226, 15, 'Pulwama', NULL, NULL, 1, NULL, NULL),
(227, 15, 'Rajouri', NULL, NULL, 1, NULL, NULL),
(228, 15, 'Ramban', NULL, NULL, 1, NULL, NULL),
(229, 15, 'Reasi', NULL, NULL, 1, NULL, NULL),
(230, 15, 'Samba', NULL, NULL, 1, NULL, NULL),
(231, 15, 'Shopian', NULL, NULL, 1, NULL, NULL),
(232, 15, 'Srinagar', NULL, NULL, 1, NULL, NULL),
(233, 15, 'Udhampur', NULL, NULL, 1, NULL, NULL),
(234, 16, 'Bokaro', NULL, NULL, 1, NULL, NULL),
(235, 16, 'Chatra', NULL, NULL, 1, NULL, NULL),
(236, 16, 'Deoghar', NULL, NULL, 1, NULL, NULL),
(237, 16, 'Dhanbad', NULL, NULL, 1, NULL, NULL),
(238, 16, 'Dumka', NULL, NULL, 1, NULL, NULL),
(239, 16, 'East Singhbhum', NULL, NULL, 1, NULL, NULL),
(240, 16, 'Garhwa', NULL, NULL, 1, NULL, NULL),
(241, 16, 'Giridih', NULL, NULL, 1, NULL, NULL),
(242, 16, 'Godda', NULL, NULL, 1, NULL, NULL),
(243, 16, 'Gumla', NULL, NULL, 1, NULL, NULL),
(244, 16, 'Hazaribag', NULL, NULL, 1, NULL, NULL),
(245, 16, 'Jamtara', NULL, NULL, 1, NULL, NULL),
(246, 16, 'Khunti', NULL, NULL, 1, NULL, NULL),
(247, 16, 'Koderma', NULL, NULL, 1, NULL, NULL),
(248, 16, 'Latehar', NULL, NULL, 1, NULL, NULL),
(249, 16, 'Lohardaga', NULL, NULL, 1, NULL, NULL),
(250, 16, 'Pakur', NULL, NULL, 1, NULL, NULL),
(251, 16, 'Palamu', NULL, NULL, 1, NULL, NULL),
(252, 16, 'Ramgarh', NULL, NULL, 1, NULL, NULL),
(253, 16, 'Ranchi', NULL, NULL, 1, NULL, NULL),
(254, 16, 'Sahibganj', NULL, NULL, 1, NULL, NULL),
(255, 16, 'Seraikela Kharsawan', NULL, NULL, 1, NULL, NULL),
(256, 16, 'Simdega', NULL, NULL, 1, NULL, NULL),
(257, 16, 'West Singhbhum', NULL, NULL, 1, NULL, NULL),
(258, 17, 'Bagalkot', NULL, NULL, 1, NULL, NULL),
(259, 17, 'Bangalore Rural', NULL, NULL, 1, NULL, NULL),
(260, 17, 'Bangalore Urban', NULL, NULL, 1, NULL, NULL),
(261, 17, 'Belgaum', NULL, NULL, 1, NULL, NULL),
(262, 17, 'Bellary', NULL, NULL, 1, NULL, NULL),
(263, 17, 'Bidar', NULL, NULL, 1, NULL, NULL),
(264, 17, 'Bijapur', NULL, NULL, 1, NULL, NULL),
(265, 17, 'Chamarajnagar', NULL, NULL, 1, NULL, NULL),
(266, 17, 'Chikkamagaluru', NULL, NULL, 1, NULL, NULL),
(267, 17, 'Chikkaballapur', NULL, NULL, 1, NULL, NULL),
(268, 17, 'Chitradurga', NULL, NULL, 1, NULL, NULL),
(269, 17, 'Davanagere', NULL, NULL, 1, NULL, NULL),
(270, 17, 'Dharwad', NULL, NULL, 1, NULL, NULL),
(271, 17, 'Dakshina Kannada', NULL, NULL, 1, NULL, NULL),
(272, 17, 'Gadag', NULL, NULL, 1, NULL, NULL),
(273, 17, 'Gulbarga', NULL, NULL, 1, NULL, NULL),
(274, 17, 'Hassan', NULL, NULL, 1, NULL, NULL),
(275, 17, 'Haveri district', NULL, NULL, 1, NULL, NULL),
(276, 17, 'Kodagu', NULL, NULL, 1, NULL, NULL),
(277, 17, 'Kolar', NULL, NULL, 1, NULL, NULL),
(278, 17, 'Koppal', NULL, NULL, 1, NULL, NULL),
(279, 17, 'Mandya', NULL, NULL, 1, NULL, NULL),
(280, 17, 'Mysore', NULL, NULL, 1, NULL, NULL),
(281, 17, 'Raichur', NULL, NULL, 1, NULL, NULL),
(282, 17, 'Shimoga', NULL, NULL, 1, NULL, NULL),
(283, 17, 'Tumkur', NULL, NULL, 1, NULL, NULL),
(284, 17, 'Udupi', NULL, NULL, 1, NULL, NULL),
(285, 17, 'Uttara Kannada', NULL, NULL, 1, NULL, NULL),
(286, 17, 'Ramanagara', NULL, NULL, 1, NULL, NULL),
(287, 17, 'Yadgir', NULL, NULL, 1, NULL, NULL),
(288, 19, 'Lakshadweep', NULL, NULL, 1, NULL, NULL),
(289, 20, 'Agar', NULL, NULL, 1, NULL, NULL),
(290, 20, 'Alirajpur', NULL, NULL, 1, NULL, NULL),
(291, 20, 'Anuppur', NULL, NULL, 1, NULL, NULL),
(292, 20, 'Ashok Nagar', NULL, NULL, 1, NULL, NULL),
(293, 20, 'Balaghat', NULL, NULL, 1, NULL, NULL),
(294, 20, 'Barwani', NULL, NULL, 1, NULL, NULL),
(295, 20, 'Betul', NULL, NULL, 1, NULL, NULL),
(296, 20, 'Bhind', NULL, NULL, 1, NULL, NULL),
(297, 20, 'Bhopal', NULL, NULL, 1, NULL, NULL),
(298, 20, 'Burhanpur', NULL, NULL, 1, NULL, NULL),
(299, 20, 'Chhatarpur', NULL, NULL, 1, NULL, NULL),
(300, 20, 'Chhindwara', NULL, NULL, 1, NULL, NULL),
(301, 20, 'Damoh', NULL, NULL, 1, NULL, NULL),
(302, 20, 'Datia', NULL, NULL, 1, NULL, NULL),
(303, 20, 'Dewas', NULL, NULL, 1, NULL, NULL),
(304, 20, 'Dhar', NULL, NULL, 1, NULL, NULL),
(305, 20, 'Dindori', NULL, NULL, 1, NULL, NULL),
(306, 20, 'Guna', NULL, NULL, 1, NULL, NULL),
(307, 20, 'Gwalior', NULL, NULL, 1, NULL, NULL),
(308, 20, 'Harda', NULL, NULL, 1, NULL, NULL),
(309, 20, 'Hoshangabad', NULL, NULL, 1, NULL, NULL),
(310, 20, 'Indore', NULL, NULL, 1, NULL, NULL),
(311, 20, 'Jabalpur', NULL, NULL, 1, NULL, NULL),
(312, 20, 'Jhabua', NULL, NULL, 1, NULL, NULL),
(313, 20, 'Katni', NULL, NULL, 1, NULL, NULL),
(314, 20, 'Khandwa (East Nimar)', NULL, NULL, 1, NULL, NULL),
(315, 20, 'Khargone (West Nimar)', NULL, NULL, 1, NULL, NULL),
(316, 20, 'Mandla', NULL, NULL, 1, NULL, NULL),
(317, 20, 'Mandsaur', NULL, NULL, 1, NULL, NULL),
(318, 20, 'Morena', NULL, NULL, 1, NULL, NULL),
(319, 20, 'Narsinghpur', NULL, NULL, 1, NULL, NULL),
(320, 20, 'Neemuch', NULL, NULL, 1, NULL, NULL),
(321, 20, 'Panna', NULL, NULL, 1, NULL, NULL),
(322, 20, 'Raisen', NULL, NULL, 1, NULL, NULL),
(323, 20, 'Rajgarh', NULL, NULL, 1, NULL, NULL),
(324, 20, 'Ratlam', NULL, NULL, 1, NULL, NULL),
(325, 20, 'Rewa', NULL, NULL, 1, NULL, NULL),
(326, 20, 'Sagar', NULL, NULL, 1, NULL, NULL),
(327, 20, 'Satna', NULL, NULL, 1, NULL, NULL),
(328, 20, 'Sehore', NULL, NULL, 1, NULL, NULL),
(329, 20, 'Seoni', NULL, NULL, 1, NULL, NULL),
(330, 20, 'Shahdol', NULL, NULL, 1, NULL, NULL),
(331, 20, 'Shajapur', NULL, NULL, 1, NULL, NULL),
(332, 20, 'Sheopur', NULL, NULL, 1, NULL, NULL),
(333, 20, 'Shivpuri', NULL, NULL, 1, NULL, NULL),
(334, 20, 'Sidhi', NULL, NULL, 1, NULL, NULL),
(335, 20, 'Singrauli', NULL, NULL, 1, NULL, NULL),
(336, 20, 'Tikamgarh', NULL, NULL, 1, NULL, NULL),
(337, 20, 'Ujjain', NULL, NULL, 1, NULL, NULL),
(338, 20, 'Umaria', NULL, NULL, 1, NULL, NULL),
(339, 20, 'Vidisha', NULL, NULL, 1, NULL, NULL),
(340, 21, 'Ahmednagar', NULL, NULL, 1, NULL, NULL),
(341, 21, 'Akola', NULL, NULL, 1, NULL, NULL),
(342, 21, 'Amravati', NULL, NULL, 1, NULL, NULL),
(343, 21, 'Aurangabad', NULL, NULL, 1, NULL, NULL),
(344, 21, 'Beed', NULL, NULL, 1, NULL, NULL),
(345, 21, 'Bhandara', NULL, NULL, 1, NULL, NULL),
(346, 21, 'Buldhana', NULL, NULL, 1, NULL, NULL),
(347, 21, 'Chandrapur', NULL, NULL, 1, NULL, NULL),
(348, 21, 'Dhule', NULL, NULL, 1, NULL, NULL),
(349, 21, 'Gadchiroli', NULL, NULL, 1, NULL, NULL),
(350, 21, 'Gondia', NULL, NULL, 1, NULL, NULL),
(351, 21, 'Hingoli', NULL, NULL, 1, NULL, NULL),
(352, 21, 'Jalgaon', NULL, NULL, 1, NULL, NULL),
(353, 21, 'Jalna', NULL, NULL, 1, NULL, NULL),
(354, 21, 'Kolhapur', NULL, NULL, 1, NULL, NULL),
(355, 21, 'Latur', NULL, NULL, 1, NULL, NULL),
(356, 21, 'Mumbai City', NULL, NULL, 1, NULL, NULL),
(357, 21, 'Mumbai suburban', NULL, NULL, 1, NULL, NULL),
(358, 21, 'Nanded', NULL, NULL, 1, NULL, NULL),
(359, 21, 'Nandurbar', NULL, NULL, 1, NULL, NULL),
(360, 21, 'Nagpur', NULL, NULL, 1, NULL, NULL),
(361, 21, 'Nashik', NULL, NULL, 1, NULL, NULL),
(362, 21, 'Osmanabad', NULL, NULL, 1, NULL, NULL),
(363, 21, 'Parbhani', NULL, NULL, 1, NULL, NULL),
(364, 21, 'Pune', NULL, NULL, 1, NULL, NULL),
(365, 21, 'Raigad', NULL, NULL, 1, NULL, NULL),
(366, 21, 'Ratnagiri', NULL, NULL, 1, NULL, NULL),
(367, 21, 'Sangli', NULL, NULL, 1, NULL, NULL),
(368, 21, 'Satara', NULL, NULL, 1, NULL, NULL),
(369, 21, 'Sindhudurg', NULL, NULL, 1, NULL, NULL),
(370, 21, 'Solapur', NULL, NULL, 1, NULL, NULL),
(371, 21, 'Thane', NULL, NULL, 1, NULL, NULL),
(372, 21, 'Wardha', NULL, NULL, 1, NULL, NULL),
(373, 21, 'Washim', NULL, NULL, 1, NULL, NULL),
(374, 21, 'Yavatmal', NULL, NULL, 1, NULL, NULL),
(375, 22, 'Bishnupur', NULL, NULL, 1, NULL, NULL),
(376, 22, 'Churachandpur', NULL, NULL, 1, NULL, NULL),
(377, 22, 'Chandel', NULL, NULL, 1, NULL, NULL),
(378, 22, 'Imphal East', NULL, NULL, 1, NULL, NULL),
(379, 22, 'Senapati', NULL, NULL, 1, NULL, NULL),
(380, 22, 'Tamenglong', NULL, NULL, 1, NULL, NULL),
(381, 22, 'Thoubal', NULL, NULL, 1, NULL, NULL),
(382, 22, 'Ukhrul', NULL, NULL, 1, NULL, NULL),
(383, 22, 'Imphal West', NULL, NULL, 1, NULL, NULL),
(384, 23, 'East Garo Hills', NULL, NULL, 1, NULL, NULL),
(385, 23, 'East Khasi Hills', NULL, NULL, 1, NULL, NULL),
(386, 23, 'Jaintia Hills', NULL, NULL, 1, NULL, NULL),
(387, 23, 'Ri Bhoi', NULL, NULL, 1, NULL, NULL),
(388, 23, 'South Garo Hills', NULL, NULL, 1, NULL, NULL),
(389, 23, 'West Garo Hills', NULL, NULL, 1, NULL, NULL),
(390, 23, 'West Khasi Hills', NULL, NULL, 1, NULL, NULL),
(391, 24, 'Aizawl', NULL, NULL, 1, NULL, NULL),
(392, 24, 'Champhai', NULL, NULL, 1, NULL, NULL),
(393, 24, 'Kolasib', NULL, NULL, 1, NULL, NULL),
(394, 24, 'Lawngtlai', NULL, NULL, 1, NULL, NULL),
(395, 24, 'Lunglei', NULL, NULL, 1, NULL, NULL),
(396, 24, 'Mamit', NULL, NULL, 1, NULL, NULL),
(397, 24, 'Saiha', NULL, NULL, 1, NULL, NULL),
(398, 24, 'Serchhip', NULL, NULL, 1, NULL, NULL),
(399, 25, 'Dimapur', NULL, NULL, 1, NULL, NULL),
(400, 25, 'Kiphire', NULL, NULL, 1, NULL, NULL),
(401, 25, 'Kohima', NULL, NULL, 1, NULL, NULL),
(402, 25, 'Longleng', NULL, NULL, 1, NULL, NULL),
(403, 25, 'Mokokchung', NULL, NULL, 1, NULL, NULL),
(404, 25, 'Mon', NULL, NULL, 1, NULL, NULL),
(405, 25, 'Peren', NULL, NULL, 1, NULL, NULL),
(406, 25, 'Phek', NULL, NULL, 1, NULL, NULL),
(407, 25, 'Tuensang', NULL, NULL, 1, NULL, NULL),
(408, 25, 'Wokha', NULL, NULL, 1, NULL, NULL),
(409, 25, 'Zunheboto', NULL, NULL, 1, NULL, NULL),
(410, 26, 'Angul', NULL, NULL, 1, NULL, NULL),
(411, 26, 'Boudh (Bauda)', NULL, NULL, 1, NULL, NULL),
(412, 26, 'Bhadrak', NULL, NULL, 1, NULL, NULL),
(413, 26, 'Balangir', NULL, NULL, 1, NULL, NULL),
(414, 26, 'Bargarh (Baragarh)', NULL, NULL, 1, NULL, NULL),
(415, 26, 'Balasore', NULL, NULL, 1, NULL, NULL),
(416, 26, 'Cuttack', NULL, NULL, 1, NULL, NULL),
(417, 26, 'Debagarh (Deogarh)', NULL, NULL, 1, NULL, NULL),
(418, 26, 'Dhenkanal', NULL, NULL, 1, NULL, NULL),
(419, 26, 'Ganjam', NULL, NULL, 1, NULL, NULL),
(420, 26, 'Gajapati', NULL, NULL, 1, NULL, NULL),
(421, 26, 'Jharsuguda', NULL, NULL, 1, NULL, NULL),
(422, 26, 'Jajpur', NULL, NULL, 1, NULL, NULL),
(423, 26, 'Jagatsinghpur', NULL, NULL, 1, NULL, NULL),
(424, 26, 'Khordha', NULL, NULL, 1, NULL, NULL),
(425, 26, 'Kendujhar (Keonjhar)', NULL, NULL, 1, NULL, NULL),
(426, 26, 'Kalahandi', NULL, NULL, 1, NULL, NULL),
(427, 26, 'Kandhamal', NULL, NULL, 1, NULL, NULL),
(428, 26, 'Koraput', NULL, NULL, 1, NULL, NULL),
(429, 26, 'Kendrapara', NULL, NULL, 1, NULL, NULL),
(430, 26, 'Malkangiri', NULL, NULL, 1, NULL, NULL),
(431, 26, 'Mayurbhanj', NULL, NULL, 1, NULL, NULL),
(432, 26, 'Nabarangpur', NULL, NULL, 1, NULL, NULL),
(433, 26, 'Nuapada', NULL, NULL, 1, NULL, NULL),
(434, 26, 'Nayagarh', NULL, NULL, 1, NULL, NULL),
(435, 26, 'Puri', NULL, NULL, 1, NULL, NULL),
(436, 26, 'Rayagada', NULL, NULL, 1, NULL, NULL),
(437, 26, 'Sambalpur', NULL, NULL, 1, NULL, NULL),
(438, 26, 'Subarnapur (Sonepur)', NULL, NULL, 1, NULL, NULL),
(439, 26, 'Sundergarh', NULL, NULL, 1, NULL, NULL),
(440, 27, 'Karaikal', NULL, NULL, 1, NULL, NULL),
(441, 27, 'Mahe', NULL, NULL, 1, NULL, NULL),
(442, 27, 'Pondicherry', NULL, NULL, 1, NULL, NULL),
(443, 27, 'Yanam', NULL, NULL, 1, NULL, NULL),
(444, 28, 'Amritsar', NULL, NULL, 1, NULL, NULL),
(445, 28, 'Barnala', NULL, NULL, 1, NULL, NULL),
(446, 28, 'Bathinda', NULL, NULL, 1, NULL, NULL),
(447, 28, 'Firozpur', NULL, NULL, 1, NULL, NULL),
(448, 28, 'Faridkot', NULL, NULL, 1, NULL, NULL),
(449, 28, 'Fatehgarh Sahib', NULL, NULL, 1, NULL, NULL),
(450, 28, 'Fazilka[6]', NULL, NULL, 1, NULL, NULL),
(451, 28, 'Gurdaspur', NULL, NULL, 1, NULL, NULL),
(452, 28, 'Hoshiarpur', NULL, NULL, 1, NULL, NULL),
(453, 28, 'Jalandhar', NULL, NULL, 1, NULL, NULL),
(454, 28, 'Kapurthala', NULL, NULL, 1, NULL, NULL),
(455, 28, 'Ludhiana', NULL, NULL, 1, NULL, NULL),
(456, 28, 'Mansa', NULL, NULL, 1, NULL, NULL),
(457, 28, 'Moga', NULL, NULL, 1, NULL, NULL),
(458, 28, 'Sri Muktsar Sahib', NULL, NULL, 1, NULL, NULL),
(459, 28, 'Pathankot', NULL, NULL, 1, NULL, NULL),
(460, 28, 'Patiala', NULL, NULL, 1, NULL, NULL),
(461, 28, 'Rupnagar', NULL, NULL, 1, NULL, NULL),
(462, 28, 'Ajitgarh (Mohali)', NULL, NULL, 1, NULL, NULL),
(463, 28, 'Sangrur', NULL, NULL, 1, NULL, NULL),
(464, 28, 'Shahid Bhagat Singh Nagar', NULL, NULL, 1, NULL, NULL),
(465, 28, 'Tarn Taran', NULL, NULL, 1, NULL, NULL),
(466, 29, 'Ajmer', NULL, NULL, 1, NULL, NULL),
(467, 29, 'Alwar', NULL, NULL, 1, NULL, NULL),
(468, 29, 'Bikaner', NULL, NULL, 1, NULL, NULL),
(469, 29, 'Barmer', NULL, NULL, 1, NULL, NULL),
(470, 29, 'Banswara', NULL, NULL, 1, NULL, NULL),
(471, 29, 'Bharatpur', NULL, NULL, 1, NULL, NULL),
(472, 29, 'Baran', NULL, NULL, 1, NULL, NULL),
(473, 29, 'Bundi', NULL, NULL, 1, NULL, NULL),
(474, 29, 'Bhilwara', NULL, NULL, 1, NULL, NULL),
(475, 29, 'Churu', NULL, NULL, 1, NULL, NULL),
(476, 29, 'Chittorgarh', NULL, NULL, 1, NULL, NULL),
(477, 29, 'Dausa', NULL, NULL, 1, NULL, NULL),
(478, 29, 'Dholpur', NULL, NULL, 1, NULL, NULL),
(479, 29, 'Dungapur', NULL, NULL, 1, NULL, NULL),
(480, 29, 'Ganganagar', NULL, NULL, 1, NULL, NULL),
(481, 29, 'Hanumangarh', NULL, NULL, 1, NULL, NULL),
(482, 29, 'Jhunjhunu', NULL, NULL, 1, NULL, NULL),
(483, 29, 'Jalore', NULL, NULL, 1, NULL, NULL),
(484, 29, 'Jodhpur', NULL, NULL, 1, NULL, NULL),
(485, 29, 'Jaipur', NULL, NULL, 1, NULL, NULL),
(486, 29, 'Jaisalmer', NULL, NULL, 1, NULL, NULL),
(487, 29, 'Jhalawar', NULL, NULL, 1, NULL, NULL),
(488, 29, 'Karauli', NULL, NULL, 1, NULL, NULL),
(489, 29, 'Kota', NULL, NULL, 1, NULL, NULL),
(490, 29, 'Nagaur', NULL, NULL, 1, NULL, NULL),
(491, 29, 'Pali', NULL, NULL, 1, NULL, NULL),
(492, 29, 'Pratapgarh', NULL, NULL, 1, NULL, NULL),
(493, 29, 'Rajsamand', NULL, NULL, 1, NULL, NULL),
(494, 29, 'Sikar', NULL, NULL, 1, NULL, NULL),
(495, 29, 'Sawai Madhopur', NULL, NULL, 1, NULL, NULL),
(496, 29, 'Sirohi', NULL, NULL, 1, NULL, NULL),
(497, 29, 'Tonk', NULL, NULL, 1, NULL, NULL),
(498, 29, 'Udaipur', NULL, NULL, 1, NULL, NULL),
(499, 30, 'East Sikkim', NULL, NULL, 1, NULL, NULL),
(500, 30, 'North Sikkim', NULL, NULL, 1, NULL, NULL),
(501, 30, 'South Sikkim', NULL, NULL, 1, NULL, NULL),
(502, 30, 'West Sikkim', NULL, NULL, 1, NULL, NULL),
(503, 31, 'Ariyalur', NULL, NULL, 1, NULL, NULL),
(504, 31, 'Chennai', NULL, NULL, 1, NULL, NULL),
(505, 31, 'Coimbatore', NULL, NULL, 1, NULL, NULL),
(506, 31, 'Cuddalore', NULL, NULL, 1, NULL, NULL),
(507, 31, 'Dharmapuri', NULL, NULL, 1, NULL, NULL),
(508, 31, 'Dindigul', NULL, NULL, 1, NULL, NULL),
(509, 31, 'Erode', NULL, NULL, 1, NULL, NULL),
(510, 31, 'Kanchipuram', NULL, NULL, 1, NULL, NULL),
(511, 31, 'Kanyakumari', NULL, NULL, 1, NULL, NULL),
(512, 31, 'Karur', NULL, NULL, 1, NULL, NULL),
(513, 31, 'Krishnagiri', NULL, NULL, 1, NULL, NULL),
(514, 31, 'Madurai', NULL, NULL, 1, NULL, NULL),
(515, 31, 'Nagapattinam', NULL, NULL, 1, NULL, NULL),
(516, 31, 'Nilgiris', NULL, NULL, 1, NULL, NULL),
(517, 31, 'Namakkal', NULL, NULL, 1, NULL, NULL),
(518, 31, 'Perambalur', NULL, NULL, 1, NULL, NULL),
(519, 31, 'Pudukkottai', NULL, NULL, 1, NULL, NULL),
(520, 31, 'Ramanathapuram', NULL, NULL, 1, NULL, NULL),
(521, 31, 'Salem', NULL, NULL, 1, NULL, NULL),
(522, 31, 'Sivaganga', NULL, NULL, 1, NULL, NULL),
(523, 31, 'Tirupur', NULL, NULL, 1, NULL, NULL),
(524, 31, 'Tiruchirappalli', NULL, NULL, 1, NULL, NULL),
(525, 31, 'Theni', NULL, NULL, 1, NULL, NULL),
(526, 31, 'Tirunelveli', NULL, NULL, 1, NULL, NULL),
(527, 31, 'Thanjavur', NULL, NULL, 1, NULL, NULL),
(528, 31, 'Thoothukudi', NULL, NULL, 1, NULL, NULL),
(529, 31, 'Tiruvallur', NULL, NULL, 1, NULL, NULL),
(530, 31, 'Tiruvarur', NULL, NULL, 1, NULL, NULL),
(531, 31, 'Tiruvannamalai', NULL, NULL, 1, NULL, NULL),
(532, 31, 'Vellore', NULL, NULL, 1, NULL, NULL),
(533, 31, 'Viluppuram', NULL, NULL, 1, NULL, NULL),
(534, 31, 'Virudhunagar', NULL, NULL, 1, NULL, NULL),
(535, 32, 'Dhalai', NULL, NULL, 1, NULL, NULL),
(536, 32, 'North Tripura', NULL, NULL, 1, NULL, NULL),
(537, 32, 'South Tripura', NULL, NULL, 1, NULL, NULL),
(538, 32, 'Khowai[7]', NULL, NULL, 1, NULL, NULL),
(539, 32, 'West Tripura', NULL, NULL, 1, NULL, NULL),
(540, 33, 'Agra', NULL, NULL, 1, NULL, NULL),
(541, 33, 'Aligarh', NULL, NULL, 1, NULL, NULL),
(542, 33, 'Allahabad', NULL, NULL, 1, NULL, NULL),
(543, 33, 'Ambedkar Nagar', NULL, NULL, 1, NULL, NULL),
(544, 33, 'Auraiya', NULL, NULL, 1, NULL, NULL),
(545, 33, 'Azamgarh', NULL, NULL, 1, NULL, NULL),
(546, 33, 'Bagpat', NULL, NULL, 1, NULL, NULL),
(547, 33, 'Bahraich', NULL, NULL, 1, NULL, NULL),
(548, 33, 'Ballia', NULL, NULL, 1, NULL, NULL),
(549, 33, 'Balrampur', NULL, NULL, 1, NULL, NULL),
(550, 33, 'Banda', NULL, NULL, 1, NULL, NULL),
(551, 33, 'Barabanki', NULL, NULL, 1, NULL, NULL),
(552, 33, 'Bareilly', NULL, NULL, 1, NULL, NULL),
(553, 33, 'Basti', NULL, NULL, 1, NULL, NULL),
(554, 33, 'Bijnor', NULL, NULL, 1, NULL, NULL),
(555, 33, 'Budaun', NULL, NULL, 1, NULL, NULL),
(556, 33, 'Bulandshahr', NULL, NULL, 1, NULL, NULL),
(557, 33, 'Chandauli', NULL, NULL, 1, NULL, NULL),
(558, 33, 'Chhatrapati Shahuji Maharaj Nagar[8]', NULL, NULL, 1, NULL, NULL),
(559, 33, 'Chitrakoot', NULL, NULL, 1, NULL, NULL),
(560, 33, 'Deoria', NULL, NULL, 1, NULL, NULL),
(561, 33, 'Etah', NULL, NULL, 1, NULL, NULL),
(562, 33, 'Etawah', NULL, NULL, 1, NULL, NULL),
(563, 33, 'Faizabad', NULL, NULL, 1, NULL, NULL),
(564, 33, 'Farrukhabad', NULL, NULL, 1, NULL, NULL),
(565, 33, 'Fatehpur', NULL, NULL, 1, NULL, NULL),
(566, 33, 'Firozabad', NULL, NULL, 1, NULL, NULL),
(567, 33, 'Gautam Buddh Nagar', NULL, NULL, 1, NULL, NULL),
(568, 33, 'Ghaziabad', NULL, NULL, 1, NULL, NULL),
(569, 33, 'Ghazipur', NULL, NULL, 1, NULL, NULL),
(570, 33, 'Gonda', NULL, NULL, 1, NULL, NULL),
(571, 33, 'Gorakhpur', NULL, NULL, 1, NULL, NULL),
(572, 33, 'Hamirpur', NULL, NULL, 1, NULL, NULL),
(573, 33, 'Hardoi', NULL, NULL, 1, NULL, NULL),
(574, 33, 'Hathras', NULL, NULL, 1, NULL, NULL),
(575, 33, 'Jalaun', NULL, NULL, 1, NULL, NULL),
(576, 33, 'Jaunpur district', NULL, NULL, 1, NULL, NULL),
(577, 33, 'Jhansi', NULL, NULL, 1, NULL, NULL),
(578, 33, 'Jyotiba Phule Nagar', NULL, NULL, 1, NULL, NULL),
(579, 33, 'Kannauj', NULL, NULL, 1, NULL, NULL),
(580, 33, 'Kanpur', NULL, NULL, 1, NULL, NULL),
(581, 33, 'Kanshi Ram Nagar', NULL, NULL, 1, NULL, NULL),
(582, 33, 'Kaushambi', NULL, NULL, 1, NULL, NULL),
(583, 33, 'Kushinagar', NULL, NULL, 1, NULL, NULL),
(584, 33, 'Lakhimpur Kheri', NULL, NULL, 1, NULL, NULL),
(585, 33, 'Lalitpur', NULL, NULL, 1, NULL, NULL),
(586, 33, 'Lucknow', NULL, NULL, 1, NULL, NULL),
(587, 33, 'Maharajganj', NULL, NULL, 1, NULL, NULL),
(588, 33, 'Mahoba', NULL, NULL, 1, NULL, NULL),
(589, 33, 'Mainpuri', NULL, NULL, 1, NULL, NULL),
(590, 33, 'Mathura', NULL, NULL, 1, NULL, NULL),
(591, 33, 'Mau', NULL, NULL, 1, NULL, NULL),
(592, 33, 'Meerut', NULL, NULL, 1, NULL, NULL),
(593, 33, 'Mirzapur', NULL, NULL, 1, NULL, NULL),
(594, 33, 'Moradabad', NULL, NULL, 1, NULL, NULL),
(595, 33, 'Muzaffarnagar', NULL, NULL, 1, NULL, NULL),
(596, 33, 'Panchsheel Nagar district (Hapur)', NULL, NULL, 1, NULL, NULL),
(597, 33, 'Pilibhit', NULL, NULL, 1, NULL, NULL),
(598, 33, 'Pratapgarh', NULL, NULL, 1, NULL, NULL),
(599, 33, 'Raebareli', NULL, NULL, 1, NULL, NULL),
(600, 33, 'Ramabai Nagar (Kanpur Dehat)', NULL, NULL, 1, NULL, NULL),
(601, 33, 'Rampur', NULL, NULL, 1, NULL, NULL),
(602, 33, 'Saharanpur', NULL, NULL, 1, NULL, NULL),
(603, 33, 'Sant Kabir Nagar', NULL, NULL, 1, NULL, NULL),
(604, 33, 'Sant Ravidas Nagar', NULL, NULL, 1, NULL, NULL),
(605, 33, 'Shahjahanpur', NULL, NULL, 1, NULL, NULL),
(606, 33, 'Shamli[9]', NULL, NULL, 1, NULL, NULL),
(607, 33, 'Shravasti', NULL, NULL, 1, NULL, NULL),
(608, 33, 'Siddharthnagar', NULL, NULL, 1, NULL, NULL),
(609, 33, 'Sitapur', NULL, NULL, 1, NULL, NULL),
(610, 33, 'Sonbhadra', NULL, NULL, 1, NULL, NULL),
(611, 33, 'Sultanpur', NULL, NULL, 1, NULL, NULL),
(612, 33, 'Unnao', NULL, NULL, 1, NULL, NULL),
(613, 33, 'Varanasi', NULL, NULL, 1, NULL, NULL),
(614, 34, 'Almora', NULL, NULL, 1, NULL, NULL),
(615, 34, 'Bageshwar', NULL, NULL, 1, NULL, NULL),
(616, 34, 'Chamoli', NULL, NULL, 1, NULL, NULL),
(617, 34, 'Champawat', NULL, NULL, 1, NULL, NULL),
(618, 34, 'Dehradun', NULL, NULL, 1, NULL, NULL),
(619, 34, 'Haridwar', NULL, NULL, 1, NULL, NULL),
(620, 34, 'Nainital', NULL, NULL, 1, NULL, NULL),
(621, 34, 'Pauri Garhwal', NULL, NULL, 1, NULL, NULL),
(622, 34, 'Pithoragarh', NULL, NULL, 1, NULL, NULL),
(623, 34, 'Rudraprayag', NULL, NULL, 1, NULL, NULL),
(624, 34, 'Tehri Garhwal', NULL, NULL, 1, NULL, NULL),
(625, 34, 'Udham Singh Nagar', NULL, NULL, 1, NULL, NULL),
(626, 34, 'Uttarkashi', NULL, NULL, 1, NULL, NULL),
(627, 35, 'Bankura', NULL, NULL, 1, NULL, NULL),
(628, 35, 'Bardhaman', NULL, NULL, 1, NULL, NULL),
(629, 35, 'Birbhum', NULL, NULL, 1, NULL, NULL),
(630, 35, 'Cooch Behar', NULL, NULL, 1, NULL, NULL),
(631, 35, 'Dakshin Dinajpur', NULL, NULL, 1, NULL, NULL),
(632, 35, 'Darjeeling', NULL, NULL, 1, NULL, NULL),
(633, 35, 'Hooghly', NULL, NULL, 1, NULL, NULL),
(634, 35, 'Howrah', NULL, NULL, 1, NULL, NULL),
(635, 35, 'Jalpaiguri', NULL, NULL, 1, NULL, NULL),
(636, 35, 'Kolkata', NULL, NULL, 1, NULL, NULL),
(637, 35, 'Maldah', NULL, NULL, 1, NULL, NULL),
(638, 35, 'Murshidabad', NULL, NULL, 1, NULL, NULL),
(639, 35, 'Nadia', NULL, NULL, 1, NULL, NULL),
(640, 35, 'North 24 Parganas', NULL, NULL, 1, NULL, NULL),
(641, 35, 'Paschim Medinipur', NULL, NULL, 1, NULL, NULL),
(642, 35, 'Purba Medinipur', NULL, NULL, 1, NULL, NULL),
(643, 35, 'Purulia', NULL, NULL, 1, NULL, NULL),
(644, 35, 'South 24 Parganas', NULL, NULL, 1, NULL, NULL),
(645, 35, 'Uttar Dinajpur', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_states`
--

CREATE TABLE `m_states` (
  `state_id` bigint UNSIGNED NOT NULL,
  `state_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_status` int NOT NULL DEFAULT '1',
  `regionId` int DEFAULT NULL COMMENT 'KPMG-PK of region table ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_states`
--

INSERT INTO `m_states` (`state_id`, `state_name`, `state_status`, `regionId`, `created_at`, `updated_at`) VALUES
(1, 'Andaman and Nicobar (AN)', 1, 202027, NULL, NULL),
(2, 'Andhra Pradesh (AP)', 1, 202028, NULL, NULL),
(3, 'Arunachal Pradesh (AR)', 1, 202029, NULL, NULL),
(4, 'Assam (AS)', 1, 202030, NULL, NULL),
(5, 'Bihar (BR)', 1, 202031, NULL, NULL),
(6, 'Chandigarh (CH)', 1, 202032, NULL, NULL),
(7, 'Chhattisgarh (CG)', 1, 202033, NULL, NULL),
(8, 'Dadra and Nagar Haveli (DN)', 1, 202034, NULL, NULL),
(9, 'Daman and Diu (DD)', 1, 202035, NULL, NULL),
(10, 'Delhi (DL)', 1, 202036, NULL, NULL),
(11, 'Goa (GA)', 1, 202037, NULL, NULL),
(12, 'Gujarat (GJ)', 1, 202038, NULL, NULL),
(13, 'Haryana (HR)', 1, 202039, NULL, NULL),
(14, 'Himachal Pradesh (HP)', 1, 202040, NULL, NULL),
(15, 'Jammu and Kashmir (JK)', 1, 202041, NULL, NULL),
(16, 'Jharkhand (JH)', 1, 202042, NULL, NULL),
(17, 'Karnataka (KA)', 1, 202043, NULL, NULL),
(18, 'Kerala (KL)', 1, 202044, NULL, NULL),
(19, 'Lakshdweep (LD)', 1, 202045, NULL, NULL),
(20, 'Madhya Pradesh (MP)', 1, 202046, NULL, NULL),
(21, 'Maharashtra (MH)', 1, 202047, NULL, NULL),
(22, 'Manipur (MN)', 1, 202048, NULL, NULL),
(23, 'Meghalaya (ML)', 1, 202049, NULL, NULL),
(24, 'Mizoram (MZ)', 1, 202050, NULL, NULL),
(25, 'Nagaland (NL)', 1, 202051, NULL, NULL),
(26, 'Odisha (OD)', 1, 202052, NULL, NULL),
(27, 'Puducherry (PY)', 1, 202053, NULL, NULL),
(28, 'Punjab (PB)', 1, 202054, NULL, NULL),
(29, 'Rajasthan (RJ)', 1, 202055, NULL, NULL),
(30, 'Sikkim (SK)', 1, 202056, NULL, NULL),
(31, 'Tamil Nadu (TN)', 1, 202057, NULL, NULL),
(32, 'Tripura (TR)', 1, 202059, NULL, NULL),
(33, 'Uttar Pradesh (UP)', 1, 202060, NULL, NULL),
(34, 'Uttarakhand (UK)', 1, 202061, NULL, NULL),
(35, 'West Bengal (WB)', 1, 202062, NULL, NULL),
(36, 'Telangana (TS)', 1, 202058, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2025-05-27 09:07:36', '2025-05-27 09:07:36'),
(2, 'user-create', 'web', '2025-05-27 09:07:36', '2025-05-27 09:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-05-27 09:05:07', '2025-05-27 09:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` int NOT NULL COMMENT 'pk of usertype table\r\n',
  `user_status` int DEFAULT '0' COMMENT '0-default,1-active',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `user_mobile`, `email`, `email_verified_at`, `password`, `user_type`, `user_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sreeja', '', '', '', 'sreejakairali@gmail.com', NULL, '$2y$12$e7fR10YLFgmNvBzBiGbAjOMW/bgcZ/1Yp.uQ/99Qs.VGfY/MEP9wm', 1, 0, NULL, '2025-05-22 05:53:27', '2025-05-22 05:53:27'),
(2, 'Das', '', '', '', 'das123@gmail.com', NULL, '$2y$12$2LwTMYR4rFaE2KYcYOtUkebKCSjNkBo7W7sEUM.pu4eEYmP.lz7mq', 2, 0, NULL, '2025-05-27 04:11:13', '2025-05-29 06:09:09'),
(4, 'Ragesh', '', '', '', 'ragesh123@gmail.com', NULL, '$2y$12$e7fR10YLFgmNvBzBiGbAjOMW/bgcZ/1Yp.uQ/99Qs.VGfY/MEP9wm', 3, 0, NULL, '2025-05-28 05:13:02', '2025-06-05 00:43:14'),
(5, 'Daisy', '', 'David', '67890 78906', 'dada@gmail.com', NULL, '$2y$12$Okn86raVZiM83X6eTVsgb.Z/RnduDJUN53nV8P9kPvWaJWl.kEoWu', 2, 1, NULL, '2025-05-30 13:26:30', '2025-05-30 13:26:30'),
(6, 'Arun', '', 'Jay', '97890 78906', 'arun@g.com', NULL, '$2y$12$IoQ7Ow2w5dKKSEGJIw4Gdefoi9ozBiSjCUsNpcfaX6yzpfqtFlf1K', 2, 1, NULL, '2025-05-30 13:32:25', '2025-05-30 13:32:25'),
(7, 'Ragini', '', 'M', '90789 87654', 'ragz@gmail.com', NULL, '$2y$12$f.Ad0EpI93lpOa3g5lomx.xLeenpY9KSnAdLz13zBrinvIBvFBzXS', 2, 1, NULL, '2025-05-30 13:41:02', '2025-05-30 13:41:02'),
(8, 'Tony', '', 'J', '90876 54321', 'tj@g.com', NULL, '$2y$12$QV6kGYUnEatYdqA7ERZJeO/8HXgnWO7D0xJpZNXzaZ7PPoxe7gwAi', 2, 1, NULL, '2025-05-30 13:46:13', '2025-05-30 13:46:13'),
(9, 'Ganesh', '', 'Vijayan', '78654 32190', 'Gj123@g.com', NULL, '$2y$12$l2NHJpHjtaeJKp6gtAChJ.XBuiLWoxRG4u1iOoNs9O2f.sMX7CK/u', 2, 1, NULL, '2025-05-30 13:50:16', '2025-05-30 13:50:16'),
(10, 'David', '', 'Abraham', '89012 34567', 'david123@gmail.com', NULL, '$2y$12$e7fR10YLFgmNvBzBiGbAjOMW/bgcZ/1Yp.uQ/99Qs.VGfY/MEP9wm', 2, 1, NULL, '2025-05-30 23:49:31', '2025-05-30 23:49:31'),
(11, 'Sreedevi', '', 'L', '89012 34568', 'sreedevi@gmail.com', NULL, '$2y$12$E1YWEpIgOTOZvZoYCNNo4urfz.IbKzx0J/TdX5HvsatM.s/oQksSG', 2, 0, NULL, '2025-05-31 00:39:36', '2025-06-11 01:48:04'),
(12, 'Fernandas', '', 'Thomas', '456 789 123', 'fer123@gmail.com', NULL, '$2y$12$OS1MsI2krbelqlYsVspQJekqF1U08Winsy/gGotUO/.jTEHRdhbty', 2, 1, NULL, '2025-06-13 03:01:17', '2025-06-13 03:01:17'),
(13, 'Manu', '', 'S', '9 11 4567-8902', 'manu123@gmail.com', NULL, '$2y$12$jBEdAE0hjh1YaObfomcvVe1og36GHSmUTbtIBrsygrmuPJWWZuWvu', 2, 1, NULL, '2025-06-16 05:39:39', '2025-06-16 05:39:39'),
(14, 'Devi', 'S', 'Kumar', '78912 34569', 'devik@gmail.com', NULL, '$2y$12$5XUdSHfd6SxMH00S4.Af1uSa9LsWw.cL.hqJzyvmo5Al25gl/hWb2', 2, 1, NULL, '2025-07-01 00:20:36', '2025-07-01 00:20:36'),
(15, 'Daniel', 'S', 'Dany', '7890123456', 'dany123@gmail.com', NULL, '$2y$12$7Mj5EdWaDq0/SbvlMFbLUu5.e045CQXHp4LnMYx6Gk4GrBYzrczoa', 6, 1, NULL, '2025-07-04 01:25:14', '2025-07-04 01:25:14'),
(16, 'Pavithran', NULL, 'B', '7896543567', 'pavi123@gmail.com', NULL, '$2y$12$VqOX.izgt6ObJIV.aGjnjes.1C7TEDL0OT95d1j2nlUfSh6zx9H5.', 6, 1, NULL, '2025-07-04 01:59:38', '2025-07-04 01:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int NOT NULL,
  `usertype_name` varchar(250) NOT NULL,
  `usertype_status` int DEFAULT '0' COMMENT '0-default,1-active',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `usertype_name`, `usertype_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '2025-05-27 17:25:10', '2025-06-02 00:44:36'),
(2, 'Beneficiary', 1, '2025-05-29 02:03:21', '2025-05-29 03:34:45'),
(3, 'Call Center Executive', 1, '2025-05-29 02:57:57', '2025-06-17 00:01:53'),
(6, 'Ambulance Agency', 1, '2025-07-04 00:37:10', '2025-07-04 00:37:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulance_service_details`
--
ALTER TABLE `ambulance_service_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `application_no` (`application_no`);

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
-- Indexes for table `component_permissions`
--
ALTER TABLE `component_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deceased_person_details`
--
ALTER TABLE `deceased_person_details`
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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `m_country`
--
ALTER TABLE `m_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `m_district`
--
ALTER TABLE `m_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `m_states`
--
ALTER TABLE `m_states`
  ADD PRIMARY KEY (`state_id`);

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
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulance_service_details`
--
ALTER TABLE `ambulance_service_details`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `component_permissions`
--
ALTER TABLE `component_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `deceased_person_details`
--
ALTER TABLE `deceased_person_details`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_country`
--
ALTER TABLE `m_country`
  MODIFY `country_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `m_district`
--
ALTER TABLE `m_district`
  MODIFY `district_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=646;

--
-- AUTO_INCREMENT for table `m_states`
--
ALTER TABLE `m_states`
  MODIFY `state_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
