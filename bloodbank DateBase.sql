-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 05:24 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_types`
--

CREATE TABLE `blood_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_types`
--

INSERT INTO `blood_types` (`id`, `created_at`, `updated_at`, `name`) VALUES
(8, NULL, NULL, 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `blood_type_client`
--

CREATE TABLE `blood_type_client` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blood_type_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`) VALUES
(14, '2021-08-17 11:11:19', '2021-08-17 11:11:19', 'تبرعات صباحيه');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `governorate_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `created_at`, `updated_at`, `name`, `governorate_id`) VALUES
(1, NULL, NULL, 'المنصوره', 35),
(35, '2021-08-17 13:28:19', '2021-08-17 13:28:19', 'غرب', 37);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `d_o_b` date NOT NULL,
  `blood_type_id` int(10) UNSIGNED NOT NULL,
  `last_donation_date` date NOT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT 0,
  `city_id` int(10) UNSIGNED NOT NULL,
  `pin_code` varchar(255) DEFAULT NULL,
  `api_token` varchar(60) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `created_at`, `updated_at`, `phone`, `email`, `password`, `name`, `d_o_b`, `blood_type_id`, `last_donation_date`, `is_active`, `city_id`, `pin_code`, `api_token`, `remember_token`) VALUES
(85, '2021-08-16 13:49:42', '2021-08-17 17:18:45', '010444444445452', 'five@yahoo.com4', '$2y$10$.oY3BPaMxL5wI0WTC6fVUu6GRxuDziCgwec0nJRC1yzqhzQDjDrZC', 'Mostafa four', '2002-04-04', 8, '2015-05-05', 1, 1, '445', 'NPFsQxAodKMyGJXj9tGZO3ZTETkZhWDMm760IRZhGd1VNvzUcUrUgiCQ3qQE', 'baUEbt1hZfuIItDcixUgO1YiSktFJf9GmPsj9b2kBVOm0JUpdPrGWYUsLEtG'),
(88, '2021-08-17 17:22:33', '2021-08-17 17:22:33', '+1 (303) 349-1197', 'saguwo@mailinator.com', '$2y$10$FhX.niMhIqVBpJ6kj4a5IubM024gFCjcSYln2KgJXPlubvtd9Ibzi', 'Ross Osborn', '1985-10-15', 8, '1980-10-01', 0, 1, NULL, 'FgO0an5o3Zh8tLnGGdqerZf7Htvw9whUUILl7F74vs70f69lAd3fymoqxzFg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_governorate`
--

CREATE TABLE `client_governorate` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `client_id` int(10) UNSIGNED NOT NULL,
  `governorate_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `client_notification`
--

CREATE TABLE `client_notification` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `notification_id` int(10) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `client_post`
--

CREATE TABLE `client_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `message` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `created_at`, `updated_at`, `message`, `subject`, `phone`, `email`) VALUES
(23, 'Chaney Bush', '2021-08-17 13:34:02', '2021-08-17 13:34:02', 'Minima duis mollit m', 'Ab veniam mollitia', '+1 (768) 944-3653', 'syvydalaca@mailinator.com'),
(24, 'Indigo Daugherty', '2021-08-17 13:37:02', '2021-08-17 13:37:02', 'Illo officiis verita', 'Mollit animi mollit', '+1 (217) 529-5705', 'jiwotyku@mailinator.com'),
(25, 'jjljads', '2021-08-17 14:28:17', '2021-08-17 14:28:17', 'messsage number four', 'subject of message number four', 'phone five', 'emadilFive@gmail.com'),
(26, 'jjljads', '2021-08-17 14:34:42', '2021-08-17 14:34:42', 'messsage number four', 'subject of message number four', 'phone five', 'emadilFive@gmail.com'),
(27, 'Clare Thompson', '2021-08-18 08:06:29', '2021-08-18 08:06:29', 'Nobis neque architec', 'Et vel vel non aut d', '+1 (785) 515-7634', 'byxutyge@mailinator.com');

-- --------------------------------------------------------

--
-- Table structure for table `donation_requests`
--

CREATE TABLE `donation_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_phone` varchar(255) NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `blood_type_id` int(10) UNSIGNED NOT NULL,
  `patient_age` int(10) UNSIGNED NOT NULL,
  `bags_num` int(11) NOT NULL,
  `hospital_address` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,8) NOT NULL,
  `governorate_id` int(10) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_requests`
--

INSERT INTO `donation_requests` (`id`, `created_at`, `updated_at`, `patient_name`, `patient_phone`, `city_id`, `client_id`, `hospital_name`, `blood_type_id`, `patient_age`, `bags_num`, `hospital_address`, `latitude`, `longitude`, `governorate_id`, `notes`) VALUES
(275, '2021-08-17 14:30:22', '2021-08-17 14:30:22', 'Ahmed Aly', '01021235144', 1, 85, 'مسنشفي الصدر', 8, 19, 10, 'شارع الترعه', '10.45600000', '11.54000000', 35, 'it\'s important to come fast !! please'),
(276, '2021-08-17 14:33:42', '2021-08-17 14:33:42', 'Ahmed Aly', '01021235144', 1, 85, 'مسنشفي الصدر', 8, 19, 10, 'شارع الترعه', '10.45600000', '11.54000000', 35, 'it\'s important to come fast !! please'),
(277, '2021-08-17 18:49:32', '2021-08-17 18:49:32', 'Madison Mckee', '+1 (722) 935-6929', 35, 85, 'Kermit White', 8, 56, 2, 'Soluta non et volupt', '24.74069100', '46.65285210', 37, 'Quo sequi velit duis');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `governorates`
--

CREATE TABLE `governorates` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `governorates`
--

INSERT INTO `governorates` (`id`, `created_at`, `updated_at`, `name`) VALUES
(35, NULL, '2021-08-17 13:25:25', 'الدقهليه'),
(37, '2021-08-17 13:27:38', '2021-08-17 13:27:38', 'الغربيه'),
(38, '2021-08-18 07:43:30', '2021-08-18 07:43:30', 'المنوفيه');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `donation_request_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `routes` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `display_name`, `name`, `routes`, `guard_name`, `created_at`, `updated_at`, `group`) VALUES
(1, 'عرض الصلاحيات', 'show-role', 'role.index', 'web', '2021-08-17 09:47:04', NULL, 1),
(2, 'تعديل الصلاحيات', 'update-role', 'role.update,role.edit', 'web', '2021-08-17 09:47:04', NULL, 1),
(63, 'إنشاء مستخدم', 'create-user', 'user.store,user.update', 'web', '2021-08-17 09:47:04', NULL, 2),
(64, 'تعديل مستخدم', 'update-user', 'user.edit,user.update', 'web', '2021-08-17 09:47:04', NULL, 2),
(65, 'عرض المستخدمين', 'show-user', 'user.show', 'web', '2021-08-17 09:47:04', NULL, 2),
(66, 'إنشاء صلاحيه', 'create-role', 'role.create\r\n', 'web', '2021-08-17 09:47:04', NULL, 1),
(67, 'عرض العملاء', 'show-client', 'client.show', 'web', '2021-08-17 09:47:04', NULL, 3),
(68, 'تعديل عميل', 'update-client', 'client.edit,client.update', 'web', '2021-08-17 09:47:04', NULL, 3),
(69, 'حذف مستخدم', 'destroy-user', 'user.destroy\r\n', 'web', '2021-08-17 09:47:04', NULL, 2),
(70, 'حذف عميل', 'destroy-client', 'client.destroy\r\n', 'web', '2021-08-17 09:47:04', NULL, 3),
(72, 'تفعيل عميل', 'active-client', 'client.active\r\n', 'web', '2021-08-17 09:47:04', NULL, 3),
(73, 'إلغاء تفعيل العميل', 'de-active-client', 'client.daActive', 'web', '2021-08-17 09:47:04', NULL, 3),
(74, 'إنشاء قسم', 'create-category', 'category.create,category.store', 'web', '2021-08-17 09:47:04', NULL, 4),
(75, 'حذف قسم', 'destroy-category', 'category.destroy', 'web', '2021-08-17 09:47:04', NULL, 4),
(76, 'تعديل قسم', 'update-category', 'category.update,category.edit', 'web', '2021-08-17 09:47:04', NULL, 4),
(77, 'إنشاء مقال', 'create-post', 'post.create,post.store', 'web', '2021-08-17 09:47:04', NULL, 5),
(78, 'حذف مقال', 'destroy-post', 'post.destroy', 'web', '2021-08-17 09:47:04', NULL, 5),
(79, 'تعديل مقال', 'update-post', 'post.update,post.edit', 'web', '2021-08-17 09:47:04', NULL, 5),
(80, 'تعديل\r\n طلابات التبرع', 'update-donation-request', 'donation-request.update,donation-request.edit', 'web', '2021-08-17 09:47:04', NULL, 8),
(81, 'حذف \r\nطلابات التبرع', 'destroy-donation-request', 'donation-request.destroy', 'web', '2021-08-17 09:47:04', NULL, 8),
(82, 'حذف صلاحيه', 'destroy-role', 'role.destroy\r\n', 'web', '2021-08-17 09:47:04', NULL, 1),
(83, 'رؤية المزيد عن  محتوي طلبات التبرع ', 'show-more-info-donation-request', 'donation-request-more-info.show', 'web', '2021-08-17 09:47:04', NULL, 8),
(84, 'إنشاء محافظه', 'create-governorate', 'governorate.create,governorate.store', 'web', '2021-08-17 09:47:04', NULL, 6),
(85, ' تعديل محافظه', 'update-governorate', 'governorate.update,governorate.edit', 'web', '2021-08-17 09:47:04', NULL, 6),
(86, 'عرض محافظه', 'show-governorate', 'governorate.show', 'web', '2021-08-17 09:47:04', NULL, 6),
(87, 'إنشاء مدنيه ', 'create-city', 'city.create,city.store', 'web', '2021-08-17 09:47:04', NULL, 7),
(89, ' تعديل مدينه', 'update-city', 'city.update,city.edit', 'web', '2021-08-17 09:47:04', NULL, 7),
(90, 'عرض مدينه', 'show-city', 'city.show', 'web', '2021-08-17 09:47:04', NULL, 7),
(91, 'حذف محافظه', 'destroy-governorate', 'governorate.destroy', 'web', '2021-08-17 09:47:04', NULL, 6),
(92, 'حذف مدينه', 'destroy-city', 'city.destroy', 'web', '2021-08-17 09:47:04', NULL, 7),
(94, 'رؤية محتوي طلبات التبرع ', 'show-donation-request', 'donation-request.index', 'web', '2021-08-17 09:47:04', NULL, 8),
(95, 'عرض مقال', 'show-post', 'post.show,post.index', 'web', '2021-08-17 09:47:04', NULL, 5),
(96, 'عرض قسم', 'show-category', 'category.show', 'web', '2021-08-17 09:47:04', NULL, 4),
(97, 'عرض الرسائل المستلمه', 'show-contact', 'contact.index', 'web', '2021-07-09 20:49:02', NULL, 9),
(98, 'عرض الأعدادت', 'show-setting', 'setting.edit', 'web', '2021-07-09 20:49:02', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', 'يقوم بالتحكم بكل شئ', 'الرئيس', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notification_settings_text` text NOT NULL,
  `about_app` text NOT NULL,
  `tw_link` varchar(255) NOT NULL,
  `fb_link` varchar(255) NOT NULL,
  `insta_link` varchar(255) NOT NULL,
  `whats_app` varchar(100) NOT NULL,
  `app_store_link` varchar(255) NOT NULL,
  `google_play_link` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  `intro_who_are_us` text NOT NULL,
  `who_are_us` text NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `intro_app_phone` text NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `notification_settings_text`, `about_app`, `tw_link`, `fb_link`, `insta_link`, `whats_app`, `app_store_link`, `google_play_link`, `intro`, `intro_who_are_us`, `who_are_us`, `phone_number`, `intro_app_phone`, `fax`, `email`) VALUES
(2, '2021-08-15 02:56:28', NULL, 'بنك الدم هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.', 'بنك الدم هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.', 'https://twitter.com/Mostafa1712002', 'https://www.facebook.com/profile.php?id=100070208370627', '......................', 'https://wa.me/01022348224', '.................', '......................', 'بنك الدم هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة', 'بنك الدم هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم', 'بنك الدم هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.بنك الدم هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.', '+201022348224', 'بنك الدم هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.', '4321', 'mostafaibrahim1712002@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `platform` enum('android','ios') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admingmail.com', NULL, '$2y$10$tdw7nLRIq6iYtjMhnRCXXunKmh8NwGfQErSy3X45eLmP3QNNAVJ4y', '121VkeOSZFelAEzfmlczUyq0PHEl3KVvCqI2YcgzbM4XHNUGp14plnsMwE1l', 1, NULL, NULL),
(18, 'Buffy Peck', 'deruwepe@mailinator.com', NULL, '$2y$10$tdw7nLRIq6iYtjMhnRCXXunKmh8NwGfQErSy3X45eLmP3QNNAVJ4y', NULL, 0, '2021-08-17 09:11:41', '2021-08-17 09:11:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_types`
--
ALTER TABLE `blood_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_type_client`
--
ALTER TABLE `blood_type_client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_type_client_blood_type_id_foreign` (`blood_type_id`),
  ADD KEY `blood_type_client_client_id_foreign` (`client_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_governorate_id_foreign` (`governorate_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD UNIQUE KEY `api_token` (`api_token`),
  ADD KEY `clients_blood_type_id_foreign` (`blood_type_id`),
  ADD KEY `clients_city_id_foreign` (`city_id`);

--
-- Indexes for table `client_governorate`
--
ALTER TABLE `client_governorate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_governorate_client_id_foreign` (`client_id`),
  ADD KEY `client_governorate_governorate_id_foreign` (`governorate_id`);

--
-- Indexes for table `client_notification`
--
ALTER TABLE `client_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_notification_client_id_foreign` (`client_id`),
  ADD KEY `client_notification_notification_id_foreign` (`notification_id`);

--
-- Indexes for table `client_post`
--
ALTER TABLE `client_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_post_client_id_foreign` (`client_id`),
  ADD KEY `client_post_post_id_foreign` (`post_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donation_requests_blood_type_id_foreign` (`blood_type_id`),
  ADD KEY `donation_requests_city_id_foreign` (`city_id`),
  ADD KEY `donation_requests_client_id_foreign` (`client_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `governorates`
--
ALTER TABLE `governorates`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_donation_request_id_foreign` (`donation_request_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`display_name`,`guard_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_categories_id_foreign` (`category_id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `blood_types`
--
ALTER TABLE `blood_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_type_client`
--
ALTER TABLE `blood_type_client`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `client_governorate`
--
ALTER TABLE `client_governorate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `client_notification`
--
ALTER TABLE `client_notification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `client_post`
--
ALTER TABLE `client_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `donation_requests`
--
ALTER TABLE `donation_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `governorates`
--
ALTER TABLE `governorates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_type_client`
--
ALTER TABLE `blood_type_client`
  ADD CONSTRAINT `blood_type_client_blood_type_id_foreign` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blood_type_client_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_governorate_id_foreign` FOREIGN KEY (`governorate_id`) REFERENCES `governorates` (`id`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_blood_type_id_foreign` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_governorate`
--
ALTER TABLE `client_governorate`
  ADD CONSTRAINT `client_governorate_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_governorate_governorate_id_foreign` FOREIGN KEY (`governorate_id`) REFERENCES `governorates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_notification`
--
ALTER TABLE `client_notification`
  ADD CONSTRAINT `client_notification_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_notification_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_post`
--
ALTER TABLE `client_post`
  ADD CONSTRAINT `client_post_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD CONSTRAINT `donation_requests_blood_type_id_foreign` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_requests_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_requests_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_donation_request_id_foreign` FOREIGN KEY (`donation_request_id`) REFERENCES `donation_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_categories_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

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
