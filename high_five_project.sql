-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2020 at 09:34 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `high_five_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `driver_id` int(11) NOT NULL,
  `car_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturing_year` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name_ar`, `type_id`, `color_id`, `driver_id`, `car_number`, `manufacturing_year`, `company_id`, `serial`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'سيارة المستودع', NULL, 78, 8, '23-4345-00', 2019, 2, 1, '2020-02-11 07:09:42', '2020-02-14 13:04:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE `category_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serial` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_products`
--

INSERT INTO `category_products` (`id`, `name`, `company_id`, `created_at`, `updated_at`, `serial`, `user_id`) VALUES
(2, 'سيراميك', 2, '2020-02-10 08:05:01', '2020-02-10 08:05:01', 1, NULL),
(3, 'بورسلان', 2, '2020-02-10 08:05:07', '2020-02-10 08:05:07', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'شركة هاي فايف'),
(2, 'شركة الغزالي');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` int(11) NOT NULL,
  `tel` int(11) DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `full_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_category_id` int(10) UNSIGNED DEFAULT NULL,
  `delegate_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) NOT NULL,
  `serial` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name_ar`, `name_en`, `email`, `mobile`, `tel`, `area`, `city_id`, `full_address`, `price_category_id`, `delegate_id`, `created_at`, `updated_at`, `company_id`, `serial`, `user_id`) VALUES
(1, 'محمد', 'name', 'a.alghazali98@hotmail.com', 567407253, 2633278, 'gaza', 43, 'gaza', 40, 2, '2020-02-02 08:23:13', '2020-02-04 08:47:25', 2, 1, NULL),
(2, 'احمد 2', 'name', 'ali.s.alwafi@gmail.com', 22, 3, 'gaza', 43, 'gaza', 40, 4, '2020-02-04 11:34:55', '2020-02-04 11:34:55', 2, 2, NULL),
(4, 'زبون شركة اخرى', 'name', 'a@a.com', 2, 2, 'gaza', 64, 'gaza', 66, 5, '2020-02-04 11:41:45', '2020-02-04 11:41:45', 1, 1, NULL),
(5, 'احمد 2', NULL, NULL, 122, NULL, 'gaza', 43, 'gaza', 40, 4, '2020-02-10 07:02:51', '2020-02-10 07:02:51', 2, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dismantling_products`
--

CREATE TABLE `dismantling_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `to_store_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dismantling_products`
--

INSERT INTO `dismantling_products` (`id`, `item_id`, `to_store_id`, `company_id`, `date`, `created_at`, `updated_at`) VALUES
(2, 50009, 3, 2, '2020-02-12', '2020-02-12 08:59:50', '2020-02-15 05:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` int(11) NOT NULL,
  `tel` int(11) DEFAULT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `full_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) NOT NULL,
  `serial` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name_ar`, `name_en`, `email`, `mobile`, `tel`, `area`, `city_id`, `full_address`, `created_at`, `updated_at`, `company_id`, `serial`, `user_id`) VALUES
(2, 'احمد الغزالي', 'name', 'a.alghazali98@hotmail.com', 567407253, 2633278, 'gaza', 43, 'gaza', '2020-02-04 08:25:50', '2020-02-04 08:47:13', 2, 1, NULL),
(4, 'احمد', 'name', 'a@a.com', 3, 3, 'gaza', 43, 'gaza', '2020-02-04 11:33:45', '2020-02-04 11:33:45', 2, 2, NULL),
(5, 'موظف شركة اخرى', 'name', 'admine@admin.com', 2, 2, 'gaza', 64, 'gaza', '2020-02-04 11:39:40', '2020-02-04 11:39:40', 1, 1, NULL),
(8, 'احمد 2', NULL, NULL, 543, NULL, 'gaza', 43, 'gaza', '2020-02-10 08:13:24', '2020-02-10 08:13:24', 2, 3, NULL),
(9, 'احمد 2', 'category', NULL, 323, NULL, 'gaza', 43, 'gaza', '2020-02-12 09:55:02', '2020-02-12 09:55:02', 2, 4, NULL),
(10, 'احمد', NULL, NULL, 4545, NULL, 'gaza', 43, 'gaza', '2020-02-14 11:01:19', '2020-02-14 11:01:19', 2, 5, NULL),
(14, 'احمد', NULL, 'a.alghgkfmkgazali98@hotmail.com', 44434, NULL, 'gaza', 43, 'gaza', '2020-02-14 11:02:32', '2020-02-14 11:02:32', 2, 6, NULL),
(19, 'احمد', NULL, NULL, 5454, NULL, 'gaza', 43, 'gaza', '2020-02-14 11:35:41', '2020-02-14 11:35:41', 2, 7, NULL),
(20, 'احمد 2', NULL, NULL, 7777, NULL, 'gaza', 43, 'gaza', '2020-02-15 11:25:07', '2020-02-15 11:25:07', 2, 8, NULL),
(21, 'فلسطين', NULL, NULL, 887, NULL, 'gaza', 43, 'gaza', '2020-02-15 11:25:25', '2020-02-15 11:25:25', 2, 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entry_documents`
--

CREATE TABLE `entry_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entry_documents`
--

INSERT INTO `entry_documents` (`id`, `supplier_id`, `date`, `document`, `company_id`, `created_at`, `updated_at`) VALUES
(9, 11, '2008-10-02', 'اسم البيان', 2, '2020-02-08 17:26:07', '2020-02-12 09:09:41'),
(12, 14, '2020-12-02', 'اسم البيان', 2, '2020-02-12 09:17:49', '2020-02-12 09:17:49'),
(13, 12, '2020-12-02', 'r', 2, '2020-02-12 09:18:16', '2020-02-12 09:18:16'),
(14, 12, '2020-02-12', 'اسم البيان', 2, '2020-02-12 09:36:20', '2020-02-14 08:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_store_movements`
--

CREATE TABLE `internal_store_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_store_id` int(11) NOT NULL,
  `to_store_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `emp_id` int(11) NOT NULL DEFAULT 0,
  `company_id` int(10) NOT NULL,
  `serial` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internal_store_movements`
--

INSERT INTO `internal_store_movements` (`id`, `from_store_id`, `to_store_id`, `car_id`, `date`, `emp_id`, `company_id`, `serial`, `user_id`, `created_at`, `updated_at`) VALUES
(19, 2, 3, 1, '1970-01-01', 20, 2, 0, 0, '2020-02-19 09:00:27', '2020-02-19 09:00:46'),
(20, 2, 2, 1, '1970-01-01', 19, 2, 1, 5, '2020-02-21 10:43:45', '2020-02-21 10:43:45'),
(21, 2, 2, 1, '1970-01-01', 19, 2, 2, 5, '2020-02-21 10:44:16', '2020-02-21 10:44:16'),
(22, 2, 2, 1, '1970-01-01', 19, 2, 3, 5, '2020-02-21 10:45:14', '2020-02-21 10:45:14'),
(23, 2, 3, 1, '1970-01-01', 19, 2, 4, 5, '2020-02-21 10:46:04', '2020-02-21 10:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `internal_store_movement_logs`
--

CREATE TABLE `internal_store_movement_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movement_id` int(11) NOT NULL,
  `from_store_id` int(11) NOT NULL,
  `to_store_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacture_company_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_category_id` int(10) UNSIGNED NOT NULL,
  `minimum` int(11) NOT NULL,
  `pricing_price` int(11) NOT NULL,
  `final_price` int(11) NOT NULL,
  `wholesale_price` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_product_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) NOT NULL,
  `tax_id` int(10) DEFAULT NULL,
  `serial` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items_entry_documents`
--

CREATE TABLE `items_entry_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `entry_document_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items_entry_documents`
--

INSERT INTO `items_entry_documents` (`id`, `category_id`, `quantity`, `entry_document_id`, `created_at`, `updated_at`, `price`) VALUES
(24, 50014, 10, 13, '2020-02-12 09:18:16', '2020-02-12 09:18:16', 2),
(26, 50014, 2, 14, '2020-02-14 08:15:12', '2020-02-14 08:15:12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `items_internal_store_movements`
--

CREATE TABLE `items_internal_store_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movement_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `serial` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items_productions`
--

CREATE TABLE `items_productions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serial` int(10) DEFAULT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items_productions`
--

INSERT INTO `items_productions` (`id`, `item_id`, `store_id`, `quantity`, `company_id`, `date`, `created_at`, `updated_at`, `serial`, `user_id`) VALUES
(10, 2, 2, 10, 2, '1970-01-01', '2020-02-22 05:15:59', '2020-02-22 05:15:59', 1, 5),
(11, 2, 2, 50, 2, '1970-01-01', '2020-02-22 05:27:09', '2020-02-22 05:27:09', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `item_production_logs`
--

CREATE TABLE `item_production_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_production_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_01_29_114640_create_permission_tables', 1),
(4, '2020_01_29_135040_suppliers', 2),
(5, '2020_01_29_140230_address', 2),
(6, '2020_01_31_114623_create_price_categories_table', 3),
(7, '2020_02_01_102600_create_customers_table', 4),
(8, '2020_02_02_114210_create_categoties_table', 5),
(9, '2020_02_04_095945_create_employees_table', 6),
(10, '2020_02_04_145329_create_entry_documents_table', 7),
(11, '2020_02_04_145644_create_items_entry_documents_table', 7),
(12, '2020_02_10_102209_create_category_products_table', 8),
(13, '2020_02_10_115716_create_subltems_table', 9),
(14, '2020_02_10_123059_create_stores_table', 10),
(15, '2020_02_11_091340_create_cars_table', 11),
(16, '2020_02_11_103158_create_internal_store_movements_table', 12),
(17, '2020_02_11_103434_create_items_internal_store_movements_table', 13),
(18, '2020_02_12_101944_create_items_productions_table', 14),
(19, '2020_02_12_104552_create_dismantling_products_table', 15),
(20, '2020_02_15_125051_create_system_values_table', 16),
(21, '2020_02_15_130508_create_processors_logs_table', 17),
(22, '2020_02_21_130351_create_internal_store_movement_logs_table', 18),
(23, '2020_02_21_132107_create_item_internal_store_movement_logs_table', 18),
(24, '2020_02_22_082130_create_item_production_logs_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `group`, `group_id`, `name_ar`) VALUES
(1, 'user', 'web', NULL, NULL, 1, 1, 'المستخدمين'),
(2, 'delete_user', 'web', NULL, NULL, 0, 1, 'حذف المستخدمين'),
(3, 'add_user', 'web', NULL, NULL, 0, 1, 'اضافة المستخدمين'),
(4, 'change_password_user', 'web', NULL, NULL, 0, 1, 'تغير كلمة المرور للمستخدمين'),
(5, 'view_user', 'web', NULL, NULL, 0, 1, 'عرض المستخدمين'),
(6, 'suppliers', 'web', NULL, NULL, 2, 2, 'الموردين'),
(7, 'delete_suppliers', 'web', NULL, NULL, 0, 2, 'حذف الموردين'),
(8, 'add_suppliers', 'web', NULL, NULL, 0, 2, 'اضافة الموردين'),
(9, 'update_suppliers', 'web', NULL, NULL, 0, 2, 'تعديل الموردين'),
(10, 'view_suppliers', 'web', NULL, NULL, 0, 2, 'عرض الموردين'),
(11, 'update_user', 'web', NULL, NULL, 0, 1, 'تعديل المستخدمين');

-- --------------------------------------------------------

--
-- Table structure for table `price_categories`
--

CREATE TABLE `price_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_categories`
--

INSERT INTO `price_categories` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(4, 'تصنيف', 'category', '2020-02-01 07:23:47', '2020-02-01 07:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `storekeeper_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serial` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name_ar`, `name_en`, `city_id`, `area`, `full_address`, `tel`, `storekeeper_id`, `company_id`, `created_at`, `updated_at`, `serial`, `user_id`) VALUES
(1, 'المخزن الثاني', NULL, 43, 'gaza', 'gaza', 2, 2, 2, '2020-02-10 09:59:18', '2020-02-12 08:27:22', 1, NULL),
(2, 'المخزن الاول', NULL, 43, 'gaza', 'gaza', 444, 2, 2, '2020-02-10 10:02:49', '2020-02-12 08:27:12', 2, NULL),
(3, 'المخزن الثالث', NULL, 43, 'gaza', 'gaza', 44, 8, 2, '2020-02-12 10:02:53', '2020-02-12 10:02:53', 3, NULL),
(4, 'احمد', 'category', 64, 'gaza', 'gaza', 434, 5, 1, '2020-02-16 12:35:05', '2020-02-16 12:35:05', 1, NULL),
(5, '66', 'category', 64, 'gaza', 'gaza', 4443434, 5, 1, '2020-02-16 12:35:14', '2020-02-16 17:02:29', 2, NULL),
(8, 'kmkfg', NULL, 64, 'gaza', 'gaza', 43, 5, 1, '2020-02-16 17:02:45', '2020-02-16 17:02:45', 3, 1),
(9, 'kmkfg', NULL, 64, 'gaza', 'gaza', 435, 5, 1, '2020-02-16 17:03:32', '2020-02-16 17:03:32', 4, 1),
(10, 'kmkfg', NULL, 64, 'gaza', 'gaza', 88, 5, 1, '2020-02-16 17:03:50', '2020-02-16 17:03:50', 5, 1),
(11, 'فلسطين', NULL, 64, 'gaza', 'gaza', 6, 5, 1, '2020-02-16 17:07:05', '2020-02-16 17:07:05', 6, 1),
(12, 'فلسطين', NULL, 64, 'gaza', 'gaza', 64, 5, 1, '2020-02-16 17:08:23', '2020-02-16 17:08:23', 7, 1),
(13, 'احمد', NULL, 64, 'gaza', 'gaza', 545, 5, 1, '2020-02-16 17:08:49', '2020-02-16 17:08:49', 8, 1),
(14, 'مثوق', NULL, 64, 'gaza', 'gaza', 2633278, 5, 1, '2020-02-16 17:09:11', '2020-02-16 17:09:11', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_bills`
--

CREATE TABLE `store_bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `statement` varchar(191) NOT NULL,
  `type_id` int(11) NOT NULL,
  `total_price` double NOT NULL DEFAULT 0,
  `discount` double DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_bills_details`
--

CREATE TABLE `store_bills_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL,
  `tax_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_bills_details`
--

INSERT INTO `store_bills_details` (`id`, `bill_id`, `item_id`, `quantity`, `price`, `tax_id`, `user_id`, `company_id`, `serial`, `created_at`, `updated_at`) VALUES
(16, 2, 50009, 18, 4, 4, 5, 2, 4, '2020-02-18 08:28:22', '2020-02-18 08:28:22'),
(22, 1, 50009, 3, 19, 4, 5, 2, 6, '2020-02-21 11:09:47', '2020-02-21 11:09:47'),
(24, 7, 50009, 8, 9, 4, 5, 2, 7, '2020-02-21 11:10:25', '2020-02-21 11:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `store_item`
--

CREATE TABLE `store_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `min_quantity` double DEFAULT NULL,
  `max_quantity` double DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_item_transaction_log`
--

CREATE TABLE `store_item_transaction_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_tax_bill`
--

CREATE TABLE `store_tax_bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `tax_amount` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subltems`
--

CREATE TABLE `subltems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` bigint(20) UNSIGNED NOT NULL,
  `sub_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subltems`
--

INSERT INTO `subltems` (`id`, `items_id`, `sub_item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 10, '2020-02-22 05:00:11', '2020-02-22 05:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` int(11) NOT NULL,
  `tel` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `full_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) NOT NULL,
  `serial` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name_ar`, `name_en`, `mobile`, `tel`, `email`, `area`, `city_id`, `full_address`, `created_at`, `updated_at`, `company_id`, `serial`, `user_id`) VALUES
(11, 'احمد', 'name', 567407253, 2633278, 'a.alghazali98@hotmail.com', 'gaza', 43, 'gaza', '2020-02-16 18:48:41', '2020-02-04 08:52:43', 2, 1, 0),
(12, 'احمد 2', 'name', 11, 11, 'ali.s.alwafi@gmail.com', 'gaza', 43, 'gaza', '2020-02-16 18:48:44', '2020-02-04 11:34:29', 2, 2, 0),
(13, 'مورد شركة اخرى', 'name', 22, 2, 'a@a.com', 'gaza', 64, 'gaza', '2020-02-16 18:48:47', '2020-02-04 11:40:21', 1, 1, 0),
(14, 'احمد', NULL, 857485, NULL, NULL, 'gaza', 43, 'gaza', '2020-02-16 18:48:49', '2020-02-10 08:18:01', 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_constants`
--

CREATE TABLE `system_constants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_cn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` int(11) NOT NULL,
  `value2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isShow` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_constants`
--

INSERT INTO `system_constants` (`id`, `name_ar`, `name_en`, `name_cn`, `value`, `value2`, `value3`, `type`, `order`, `status`, `photo`, `isShow`, `created_at`, `updated_at`, `deleted_at`, `company_id`) VALUES
(21, 'تصنيف السعر', 'price category', NULL, 4, 'price_category', NULL, 'system_constant', 4, 1, NULL, 0, NULL, NULL, NULL, 2),
(40, 'سعر التسعيرة', NULL, NULL, 1, NULL, NULL, 'price_category', 1, 1, NULL, 0, '2020-02-02 07:42:43', '2020-02-02 07:42:43', NULL, 2),
(41, 'المدن', 'city', NULL, 4, 'city', NULL, 'system_constant', 4, 1, NULL, 1, NULL, NULL, NULL, 2),
(43, 'غزة', NULL, NULL, 4, NULL, NULL, 'city', 4, 1, NULL, 1, '2020-02-02 07:53:12', '2020-02-02 07:53:12', NULL, 2),
(46, 'الوحدة', 'unit', NULL, 5, 'unit', NULL, 'system_constant', 5, 1, NULL, 1, NULL, NULL, NULL, 2),
(48, 'الشركة المصنعة', 'manufacture company', NULL, 7, 'manufacture_company', NULL, 'system_constant', 7, 1, NULL, 1, NULL, NULL, NULL, 2),
(49, 'نوع الصنف', 'type_category', NULL, 7, 'type_category', NULL, 'system_constant', 7, 1, NULL, 0, NULL, NULL, NULL, 2),
(52, 'متر', NULL, NULL, 1, NULL, NULL, 'unit', 1, 1, NULL, 1, '2020-02-02 08:58:47', '2020-02-02 08:58:47', NULL, 2),
(53, 'شركة سامسونج', NULL, NULL, 1, NULL, NULL, 'manufacture_company', 1, 1, NULL, 1, '2020-02-02 08:59:06', '2020-02-02 08:59:06', NULL, 2),
(54, 'شارب', NULL, NULL, 2, NULL, NULL, 'manufacture_company', 2, 1, NULL, 1, '2020-02-03 08:45:13', '2020-02-03 08:45:13', NULL, 2),
(56, '', NULL, NULL, 1, 'ar', 'Arabic', 'language', 1, 1, NULL, 1, NULL, NULL, NULL, 2),
(62, 'تصنيف شركة 2', NULL, NULL, 1, NULL, NULL, 'type_category', 1, 1, NULL, 1, '2020-02-04 11:22:05', '2020-02-04 11:22:05', NULL, 1),
(63, 'السقا', NULL, NULL, 1, NULL, NULL, 'manufacture_company', 1, 1, NULL, 1, '2020-02-04 11:28:51', '2020-02-04 11:28:51', NULL, 1),
(64, 'مدينة لشركة 2', NULL, NULL, 1, NULL, NULL, 'city', 1, 1, NULL, 1, '2020-02-04 11:30:07', '2020-02-04 11:30:07', NULL, 1),
(65, 'متر لشركة اخرى', NULL, NULL, 1, NULL, NULL, 'unit', 1, 1, NULL, 1, '2020-02-04 11:37:42', '2020-02-04 11:37:42', NULL, 1),
(66, 'تصنيف شركة 2', NULL, NULL, 1, NULL, NULL, 'price_category', 1, 1, NULL, 1, '2020-02-04 11:38:46', '2020-02-04 11:38:46', NULL, 1),
(69, 'السعر النهائي', NULL, NULL, 2, NULL, NULL, 'price_category', 2, 1, NULL, 0, '2020-02-10 07:14:28', '2020-02-10 07:14:28', NULL, 2),
(70, 'سعر الجملة', NULL, NULL, 3, NULL, NULL, 'price_category', 3, 1, NULL, 0, '2020-02-10 07:14:36', '2020-02-10 07:14:36', NULL, 2),
(71, 'منتج', NULL, NULL, 3, NULL, NULL, 'type_category', 3, 1, NULL, 0, '2020-02-10 07:18:19', '2020-02-10 07:18:19', NULL, 2),
(72, 'جاهز', NULL, NULL, 4, NULL, NULL, 'type_category', 4, 1, NULL, 0, '2020-02-10 07:18:27', '2020-02-10 07:18:27', NULL, 2),
(73, 'نوع السيارة', NULL, NULL, 5, 'type_car', NULL, 'system_constant', 5, 1, NULL, 1, NULL, NULL, NULL, 2),
(74, 'مرسيدس', NULL, NULL, 1, NULL, NULL, 'type_car', 1, 1, NULL, 1, '2020-02-11 06:42:30', '2020-02-11 06:42:30', NULL, 2),
(75, 'هواندي', NULL, NULL, 2, NULL, NULL, 'type_car', 2, 1, NULL, 1, '2020-02-11 06:42:42', '2020-02-11 06:42:42', NULL, 2),
(76, 'لون السيارة', NULL, NULL, 6, 'color_car', NULL, 'system_constant', 6, 1, NULL, 1, NULL, NULL, NULL, 2),
(77, 'ازرق', NULL, NULL, 1, NULL, NULL, 'color_car', 1, 1, NULL, 1, '2020-02-11 06:44:36', '2020-02-11 06:44:36', NULL, 2),
(78, 'ابيض', NULL, NULL, 2, NULL, NULL, 'color_car', 2, 1, NULL, 1, '2020-02-11 06:44:42', '2020-02-11 06:44:42', NULL, 2),
(79, 'نوع الفاتورة', 'type_bill', NULL, 7, 'type_bill', NULL, 'system_constant', 7, 1, NULL, 1, NULL, NULL, NULL, 2),
(80, 'ادخال', NULL, NULL, 1, NULL, NULL, 'type_bill', 1, 1, NULL, 1, '2020-02-17 10:14:40', '2020-02-17 10:14:40', NULL, 2),
(81, 'اخراج', NULL, NULL, 1, NULL, NULL, NULL, 1, 1, NULL, 1, '2020-02-17 10:14:46', '2020-02-17 10:14:46', NULL, 2),
(82, 'اخراج', NULL, NULL, 2, NULL, NULL, 'type_bill', 2, 1, NULL, 1, '2020-02-17 10:16:56', '2020-02-17 10:16:56', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `system_variables`
--

CREATE TABLE `system_variables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `index` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(10) NOT NULL,
  `isShow` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_variables`
--

INSERT INTO `system_variables` (`id`, `index`, `value`, `company_id`, `serial`, `isShow`, `created_at`, `updated_at`) VALUES
(1, 'length_search', '2', 2, 1, 1, NULL, NULL),
(2, 'format_bill_no', 'yym-  /  -cccc', 2, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `rate` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `category_id`, `parent_id`, `rate`, `user_id`, `company_id`, `serial`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ضريبة 4%', 2, NULL, 0.0004, 1, 1, 1, '2020-02-16 11:50:40', '2020-02-16 11:56:54', NULL),
(2, 'ضريبة 5 بالمية', 4, NULL, 0.04, 5, 2, 2, '2020-02-16 12:36:25', '2020-02-16 12:36:25', NULL),
(3, 'ضريبة 50', 4, NULL, 0.5, 5, 2, 3, '2020-02-17 11:50:49', '2020-02-17 11:50:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tax_category`
--

CREATE TABLE `tax_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `serial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_category`
--

INSERT INTO `tax_category` (`id`, `name`, `user_id`, `company_id`, `serial`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'ضريبة مبيعات 1', 1, 1, 1, NULL, '2020-02-16 11:16:36', NULL),
(3, 'ضريبة المشتريات', 1, 1, 2, '2020-02-16 12:15:00', '2020-02-16 12:15:00', NULL),
(4, 'ضريبة مبيعات 1', 5, 2, 1, '2020-02-16 12:36:10', '2020-02-16 12:36:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `franchise_id` int(4) DEFAULT -1,
  `company_id` int(10) NOT NULL,
  `serial` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `email_verified_at`, `password`, `language`, `user_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `status`, `franchise_id`, `company_id`, `serial`) VALUES
(1, 'الأدمن', 'admin', 'admin@admin.com', NULL, '$2y$10$/3JsDrcf8I94PBQO3AzcfOsoxZGUWh8xhyHQAP0WisiHcfFEOxHIm', NULL, 1, NULL, '2019-11-02 05:51:41', '2020-01-29 03:22:39', NULL, 1, NULL, 1, 1),
(5, 'ahmed ahmed', 'ahmed', 'a.alghazali98@hotmail.com', NULL, '$2y$10$i8qnuuDDd7/mxixL0fAOUO0sM.W.CacdSNjA7KUTtSkmRbWCMXnxa', NULL, 1, NULL, '2020-02-04 09:16:51', '2020-02-19 09:27:14', NULL, 1, -1, 2, 1),
(7, 'الأدمن', 'admin2', 'a.alghazali988@hotmail.com', NULL, '$2y$10$U5xSD6wVA//56nTUbff0D.TVo9n5XZPOV/0NeQXSkU.yhoCLRxEK6', NULL, 5, NULL, '2020-02-04 10:47:16', '2020-02-04 10:47:16', NULL, 1, -1, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cars_car_number_unique` (`car_number`),
  ADD KEY `cars_serial_index` (`serial`),
  ADD KEY `cars_user_id_index` (`user_id`) USING BTREE,
  ADD KEY `cars_comapy_id_index` (`company_id`) USING BTREE;

--
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_company_id_index` (`company_id`),
  ADD KEY `category_product_serial_index` (`serial`),
  ADD KEY `category_product_user_id_index` (`user_id`) USING BTREE;

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `delegate_id` (`delegate_id`),
  ADD KEY `price_category_id` (`price_category_id`),
  ADD KEY `customer_company_id_Ix` (`company_id`) USING BTREE,
  ADD KEY `customer_serial_index` (`serial`) USING BTREE,
  ADD KEY `customer_user_id_index` (`user_id`) USING BTREE;

--
-- Indexes for table `dismantling_products`
--
ALTER TABLE `dismantling_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dismantling_products_item_id_index` (`item_id`),
  ADD KEY `dismantling_products_company_id_index` (`company_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employess_mobile_unique` (`mobile`) USING BTREE,
  ADD UNIQUE KEY `employess_email_unique` (`email`) USING BTREE,
  ADD UNIQUE KEY `employess_tel_unique` (`tel`) USING BTREE,
  ADD UNIQUE KEY `employess_company_id_and_serial_Index` (`company_id`,`serial`),
  ADD KEY `employess_serial _Index` (`serial`),
  ADD KEY `employess_company_id_Index` (`company_id`) USING BTREE,
  ADD KEY `employess_user_id_Index` (`user_id`) USING BTREE;

--
-- Indexes for table `entry_documents`
--
ALTER TABLE `entry_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrh_documents_company_id_index` (`company_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_store_movements`
--
ALTER TABLE `internal_store_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `internal_store_movements_company_id_index` (`company_id`);

--
-- Indexes for table `internal_store_movement_logs`
--
ALTER TABLE `internal_store_movement_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_category_id` (`type_category_id`),
  ADD KEY `manufacture_company_id` (`manufacture_company_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `categoties_company_id_Ix` (`company_id`) USING BTREE,
  ADD KEY `items_tax_id_index` (`tax_id`);

--
-- Indexes for table `items_entry_documents`
--
ALTER TABLE `items_entry_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_internal_store_movements`
--
ALTER TABLE `items_internal_store_movements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_productions`
--
ALTER TABLE `items_productions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_production_company_id_index` (`company_id`),
  ADD KEY `items_production_serial_index` (`serial`);

--
-- Indexes for table `item_production_logs`
--
ALTER TABLE `item_production_logs`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_categories`
--
ALTER TABLE `price_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `store_tel_unique` (`tel`),
  ADD KEY `store_company_id_index` (`company_id`),
  ADD KEY `store_serial_index` (`serial`),
  ADD KEY `store_user_id_index` (`user_id`) USING BTREE;

--
-- Indexes for table `store_bills`
--
ALTER TABLE `store_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_store_id` (`store_id`) USING BTREE,
  ADD KEY `ix_supplier_id` (`supplier_id`) USING BTREE,
  ADD KEY `ix_user_id` (`user_id`) USING BTREE,
  ADD KEY `ix_serial` (`serial`) USING BTREE,
  ADD KEY `ix_company_id` (`company_id`) USING BTREE;

--
-- Indexes for table `store_bills_details`
--
ALTER TABLE `store_bills_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_bill_id` (`bill_id`) USING BTREE,
  ADD KEY `ix_item_id` (`item_id`) USING BTREE,
  ADD KEY `ix_user_id` (`user_id`) USING BTREE,
  ADD KEY `ix_serial` (`serial`) USING BTREE,
  ADD KEY `ix_company_id` (`company_id`) USING BTREE,
  ADD KEY `ix_tax_id` (`tax_id`);

--
-- Indexes for table `store_item`
--
ALTER TABLE `store_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_store_id` (`store_id`) USING BTREE,
  ADD KEY `ix_item_id` (`item_id`) USING BTREE,
  ADD KEY `ix_user_id` (`user_id`),
  ADD KEY `ix_serial` (`serial`),
  ADD KEY `ix_company_id` (`company_id`) USING BTREE;

--
-- Indexes for table `store_item_transaction_log`
--
ALTER TABLE `store_item_transaction_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_store_id` (`store_id`) USING BTREE,
  ADD KEY `ix_item_id` (`item_id`) USING BTREE,
  ADD KEY `ix_user_id` (`user_id`) USING BTREE,
  ADD KEY `ix_serial` (`serial`) USING BTREE,
  ADD KEY `ix_company_id` (`company_id`) USING BTREE,
  ADD KEY `ix_transaction_id` (`transaction_id`),
  ADD KEY `ix_transaction_type` (`transaction_type`);

--
-- Indexes for table `store_tax_bill`
--
ALTER TABLE `store_tax_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_bill_id` (`bill_id`) USING BTREE,
  ADD KEY `ix_tax_id` (`tax_id`) USING BTREE,
  ADD KEY `ix_user_id` (`user_id`) USING BTREE,
  ADD KEY `ix_serial` (`serial`) USING BTREE,
  ADD KEY `ix_company_id` (`company_id`) USING BTREE;

--
-- Indexes for table `subltems`
--
ALTER TABLE `subltems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_id` (`items_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD KEY `suppliers_ibfk_1` (`city_id`),
  ADD KEY `suppliers_user_id_index` (`user_id`),
  ADD KEY `suppliers_serial_index` (`serial`) USING BTREE;

--
-- Indexes for table `system_constants`
--
ALTER TABLE `system_constants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_constants_company_id_Ix` (`company_id`) USING BTREE,
  ADD KEY `system_constants_isShow_index` (`isShow`);

--
-- Indexes for table `system_variables`
--
ALTER TABLE `system_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_value_company_id_index` (`company_id`),
  ADD KEY `system_value_serial_index` (`serial`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_category` (`category_id`) USING BTREE,
  ADD KEY `ix_user_id` (`user_id`) USING BTREE,
  ADD KEY `ix_serial` (`serial`) USING BTREE,
  ADD KEY `ix_company_id` (`company_id`) USING BTREE;

--
-- Indexes for table `tax_category`
--
ALTER TABLE `tax_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_user_id` (`user_id`) USING BTREE,
  ADD KEY `ix_serial` (`serial`) USING BTREE,
  ADD KEY `ix_company_id` (`company_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_company_id_Ix` (`company_id`) USING BTREE,
  ADD KEY `users_company_id_serial_unique` (`company_id`,`serial`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dismantling_products`
--
ALTER TABLE `dismantling_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `entry_documents`
--
ALTER TABLE `entry_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internal_store_movements`
--
ALTER TABLE `internal_store_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `internal_store_movement_logs`
--
ALTER TABLE `internal_store_movement_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items_entry_documents`
--
ALTER TABLE `items_entry_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `items_internal_store_movements`
--
ALTER TABLE `items_internal_store_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items_productions`
--
ALTER TABLE `items_productions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item_production_logs`
--
ALTER TABLE `item_production_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `price_categories`
--
ALTER TABLE `price_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `store_bills`
--
ALTER TABLE `store_bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_bills_details`
--
ALTER TABLE `store_bills_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `store_item`
--
ALTER TABLE `store_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_item_transaction_log`
--
ALTER TABLE `store_item_transaction_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_tax_bill`
--
ALTER TABLE `store_tax_bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subltems`
--
ALTER TABLE `subltems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system_constants`
--
ALTER TABLE `system_constants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `system_variables`
--
ALTER TABLE `system_variables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tax_category`
--
ALTER TABLE `tax_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

--
-- Constraints for table `store_tax_bill`
--
ALTER TABLE `store_tax_bill`
  ADD CONSTRAINT `store_tax_bill_bill_id_fk` FOREIGN KEY (`bill_id`) REFERENCES `store_bills_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `system_constants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
