-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 04, 2019 at 02:09 AM
-- Server version: 5.6.43
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gayxkjmy_washmycarprod`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pr04Kkgnwht5FA2UaZokrwComboGkEzu', 1, '2018-01-01 22:05:04', '2018-01-01 22:05:04', '2018-01-01 22:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `customer_car_detail`
--

CREATE TABLE `customer_car_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `car_plate_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `car_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_car_detail`
--

INSERT INTO `customer_car_detail` (`id`, `customer_id`, `car_plate_no`, `car_color`, `created_at`, `updated_at`) VALUES
(2, 1, '1', '2', '2018-01-02 01:24:01', '2018-01-02 01:24:01'),
(3, 2, 'A 4569', 'White', '2018-01-03 10:37:07', '2018-01-03 10:37:07'),
(4, 3, 'skb7876c', 'red', '2018-01-05 15:19:19', '2018-01-05 15:19:19'),
(5, 2, 'C 1234', 'red', '2018-01-18 09:45:38', '2018-01-18 09:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer__customers`
--

CREATE TABLE `customer__customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push_notification` tinyint(1) NOT NULL DEFAULT '1',
  `first_time_login` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'customer' COMMENT 'Determine the account type',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer__customers`
--

INSERT INTO `customer__customers` (`id`, `email`, `full_name`, `password`, `phone_number`, `facebook_id`, `push_notification`, `first_time_login`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'son@gmail.com', 'quang son', '$2y$10$YjJJMaoZw108YfwXq/CzveyCiBpCvJnw2W9rKoEHBlbqB.8m0NNVC', '+659824132811', NULL, 1, 0, 'customer', NULL, '2018-01-02 00:20:59', '2018-02-12 23:39:24'),
(2, 'qwerty@gmail.com', 'Hung Bui', '$2y$10$J7SmS5DfbFv6r0lT6zl8BuzHtoKZ8BxrYhf8jtOn5lQgKxDTLGb6e', '+65987654321', NULL, 1, 0, 'customer', NULL, '2018-01-03 08:29:06', '2018-01-18 09:36:40'),
(3, 'stevenlai73@gmail.com', 'Steven Lai ', '$2y$10$5cUEszHG6pmNILYM1UHlyOYrK6C2xY0nkK7mKY.xPtn76yLL.lLUq', '+6593872353', NULL, 1, 0, 'customer', NULL, '2018-01-05 15:17:40', '2018-01-23 20:56:45'),
(4, 'user@gmai.com', 'user', '$2y$10$.NCWIjSazar/58F9sXo11uLsS9N6yheuHQgHpCjOyQ/NtHBO5857G', '+6523451578', NULL, 1, 1, 'customer', NULL, '2018-02-06 21:44:38', '2018-02-06 21:44:38'),
(5, 'user@gmail.com', 'user', '$2y$10$dHw2r2D74RSgtm8j2PUxreR.yLG0OSurTSl.gjBO3H2MtLQwm3K3C', '+6557858999', NULL, 1, 0, 'customer', NULL, '2018-02-06 21:46:54', '2018-02-06 21:48:39'),
(6, 'newuser@gmail.com', 'new user 1', '$2y$10$CtjzbHRiHGkHuAEJntCwqOE2/P4jfzbFYA5OsjuyK2ze77bAhl3cW', '+6598765456', NULL, 1, 1, 'customer', NULL, '2018-02-12 23:11:02', '2018-02-12 23:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard__widgets`
--

CREATE TABLE `dashboard__widgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `widgets` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `washer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `device_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `device_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `player_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'washer/customer type',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `washer_id`, `customer_id`, `device_token`, `device_type`, `player_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'e7EIixcIEPc:APA91bGaMPtauIaAg29GccW50fTVczdGRO4Genc8F9rHTnBgK2eOlM9cT1N5ijx8dmdyOLwb1ww0roUsSO1S7DIj1Wz3IxwYhBvzKiN6Q7X1LJH0rl84DVfBDhvsbiSM9Kx1_RpvpgJH', 'android', 'e7969925-1509-47f0-bc66-74dc16f3ef61', 'washer', '2018-01-02 00:20:59', '2018-01-02 00:40:48'),
(2, NULL, 1, 'c2wwZkNjv4k:APA91bH91ifggUGtvRgN6TyMustjfbC1rbhbAXq7fSwCia6UoaJwoew9wG1iw91UsTZWZ5u-Z5TAPeHHpc2hQcNesDpMpC7wdwr0v51jsdxs1aYWXeSjV2fFTzRYKCKuPSLL_IKA2Sgu', 'android', '6e613f28-1cd7-4d05-84e8-6b7543bb2edf', 'customer', '2018-01-02 00:28:45', '2018-01-02 01:23:32'),
(10, NULL, 2, 'fdfff7f5eb1315e0428bfad90faae3bb39ea708466e2e4f0c64f68eca0d06d34', 'ios', '6080d503-cde7-4f73-9126-2f37b7cee414', 'customer', '2018-01-18 09:36:40', '2018-01-18 09:36:40'),
(3, NULL, 2, '55c7950272d98e7125d76b89619002fbadfc9c96e5b40f5eb720ac873b49e27c', 'ios', '8ecdc7b6-ea26-41c0-bcd0-23d290eaf724', 'customer', '2018-01-03 08:29:06', '2018-01-03 08:29:06'),
(4, 4, NULL, '2ce6071a26fca70228e794595a625282693afd53f0e537ffbeefee64deca2cc4', 'ios', 'e2c4c32d-aee3-482a-acaf-8a8978bef81f', 'washer', '2018-01-03 10:35:07', '2018-01-03 10:35:07'),
(9, NULL, 3, '5f3fb2128f05011d7e38322fd613ff8ae189f401ed6ad64f5ca847f120edd750', 'ios', '1ce2a2f5-cbdf-4a3b-9d07-8fd403442e71', 'customer', '2018-01-06 10:49:23', '2018-01-23 20:57:16'),
(11, 4, NULL, 'd102108f1c4c2df266e8b7dd0d3ca56510e6e54a034120ccf34dbf4e4f5911c3', 'ios', 'e2caef62-f031-426f-8a32-ef2a67f0df8d', 'washer', '2018-01-18 09:36:57', '2018-01-18 09:36:57'),
(14, NULL, 2, '68f8c72a4a699739e98ce5455fae755fd2f09ce76945f28db738fe00dfd91598', 'ios', 'ea165ae3-5b3e-4583-b862-94444b7ad8ce', 'customer', '2018-01-23 09:23:52', '2018-01-23 09:23:52'),
(15, 4, NULL, 'c901d1504fa1910eadebf8b3674acf4d42bf9d657b045b7ef47301b1086e7445', 'ios', 'fc27001b-9aa5-4867-9e1c-4b1bfff536b0', 'washer', '2018-01-24 10:01:27', '2018-01-24 10:01:27'),
(16, NULL, 2, '341c48956f55037bdcc60159b765588c4daab6412bd0dda017e97b7a81bbc00f', 'ios', 'b5adf02d-5cf4-4ee6-a8c1-b8dafb3976c5', 'customer', '2018-01-24 10:01:50', '2018-01-24 10:01:50'),
(38, 4, NULL, '3aae5e9a4ee749bbdeb8a2832661d3a1f934e6cf68da290a67bf00ca02eb773d', 'ios', '856792a8-4943-4bcc-be26-37327dda1136', 'washer', '2018-02-07 15:53:42', '2018-02-07 15:53:42'),
(42, NULL, 3, '9f1258c694099eeb4e7cd6b28f42fc8541102693f6004e6551b0e11c4fd4fe62', 'ios', '741d6315-7457-43f0-acb9-986dcd167cc7', 'customer', '2018-02-11 20:39:30', '2018-02-11 20:39:30'),
(36, NULL, 5, '83918b8e1c3e577af032a6d8596fc76a935039c607d6a1d1e312a6261ed75bc6', 'ios', '10029fff-ff7f-4c5a-92b4-0782931da475', 'customer', '2018-02-06 22:35:17', '2018-02-06 22:35:17'),
(37, 6, NULL, 'fqQ0t9b6YBk:APA91bH0uRc2xT4qhr_8IAHufCRMON_omV3yJ6zE8gqsASNncjLT2uxE3rBC6AEwOM4RFnfFjlg63P1al5D16d6-_zJqg03iXGqqE3cVK5aKYtbs4hYp_Rm_ROX0TScCQZfd2OnIzQt-', 'android', 'c3a2dbb8-fb1f-4d12-a2a5-a6e6a911d706', 'washer', '2018-02-06 22:35:42', '2018-02-06 22:35:42'),
(62, 4, NULL, '1ae98ca6ca764a0fcb815c67f3b321f29041e275600386741bbacb227df015cd', 'ios', '83439a57-535a-4c2d-8b41-e7d669e8f6ff', 'washer', '2018-03-06 22:08:19', '2018-03-06 22:08:19'),
(40, NULL, 2, 'erfV94VtUpM:APA91bHB9f5Ibzggh2iAEaaTtKTZHl1S4PdZ8Vvuc6qo0wljNaACfdtk9w1hprPKuIeYI0aR7BktXmnsrNYxUEdaKHFp79fEFuQc_s7E7lhLwcM_A2QQWfG5PWdj09o7MNDoICA9Ez2E', 'android', 'a573b572-a8b9-48c9-9fda-e3ad62bf9fd1', 'customer', '2018-02-07 17:06:28', '2018-03-06 22:07:03'),
(41, NULL, 2, '64fdeeaf66b0887641b66d3874a1a0f649afe5b3de3c65932fb26403a0b2ab04', 'ios', 'bd6db87e-54d6-4bd6-92c2-4f8c0449d4be', 'customer', '2018-02-07 17:07:06', '2018-02-07 17:07:06'),
(43, 5, NULL, '10cadeb280a65e5c0ca76a6d6cc87a876d712455b2d7afc90e9fc57d39061a87', 'ios', '7268e4d3-f82b-4ae9-8406-92b54965bae3', 'washer', '2018-02-11 20:51:24', '2018-02-11 20:51:24'),
(44, NULL, 3, '3c7e5ed690dd1c526ddc3d7cd94dde9bc077a8636982390a5f3283c056d97fa8', 'ios', 'ea43418c-54bd-4d46-b457-6aa1baa7748e', 'customer', '2018-02-11 20:57:13', '2018-02-11 20:57:13'),
(45, NULL, 5, 'fVMOnGm8qGc:APA91bH2OD_4OjVNHjFY_WyvykL1JhFGwOBVgghhMe6IzopVpXgqx1XGNOKqmt5B6lkjiUtIdBXH7nleAgD5bjtVsjc8GOfc1TdjDjNJqbLVFr7TPyuZSiTxF9-0fVbj9csodw3CPr9J', 'android', 'd87ffbed-3408-4212-b5ae-e4293fcf3563', 'customer', '2018-02-11 21:44:50', '2018-02-11 21:44:50'),
(48, NULL, 6, 'dsM5UrvWpE0:APA91bGpU2AtTHmbE0mtvB7NLGSZkhN6XtrUHAcqiV-IHQgf6YAlmw7TOdJot1wTwKcYMd4JgH12wclPyx0quOq2R3zSJ7_Nk4T4mr2KQOLPgbAcU_ZKPxruh5DZ6FwXqhbCuSIihjY3', 'android', 'c0ca6762-a4c8-49e3-85ad-8a9ef5d340e5', 'customer', '2018-02-12 23:11:02', '2018-02-12 23:11:02'),
(50, 5, NULL, 'aa55f471f82c64d835a8a7e010dc5cec9ac9c6f03561f2ce3288f7d9d879f682', 'ios', '1f909ff6-8fce-4b0d-8325-fdf5682dc5bf', 'washer', '2018-02-13 06:59:08', '2018-02-13 06:59:08'),
(61, NULL, 3, 'c8ZD0h_GTGM:APA91bFoQgkCWSEtDtIdLWXryOPGzpeImBbSv8mfIBQeJEITEzIIx7mFfsJtfmM_f3YcYwEbyun8E6VNd6UWomZjOyv7WvCN7YGu-ENkppTYENq0Z0iSVVt32nyYH4tNT3suZtiM3Oxx', 'android', 'b6073640-26f9-42c8-9a20-0dea71f30237', 'customer', '2018-03-06 20:07:41', '2018-03-06 20:07:41'),
(52, NULL, 2, '40605d6d30d27d2144040d5c1297235c115ecd68b8499b6699b5ba84e28c972d', 'ios', '3adc26b5-2bcb-4adf-b420-2905867328db', 'customer', '2018-03-03 21:21:11', '2018-03-03 21:21:11'),
(55, 5, NULL, '222ddc8c6305806720950d13b43fa6ac0aabb2e10b8b0ca8dfd656952de0b1c4', 'ios', '67c2bc48-f650-4595-951f-7e6bd3451723', 'washer', '2018-03-04 14:25:11', '2018-03-04 14:25:11'),
(60, NULL, 3, '455979342adcde3217d115846038d7f569966074030b61943a5640bead518102', 'ios', '590adff7-e6da-4260-87b7-7c243bee2570', 'customer', '2018-03-04 18:58:46', '2018-03-04 18:58:46'),
(67, 4, NULL, '65a995ff664dc3f1165598e02a198d7c164587eb5f9dded3a250944d38702dfb', 'ios', '7fd7a643-1e63-4d4f-be0b-334df0f42064', 'washer', '2018-03-06 23:40:05', '2018-03-06 23:40:05'),
(68, NULL, 3, 'cYxFy5FKK-4:APA91bE4XOWyvdhoggYAzNC5Yk-_EwsgUrTD8eS3MrM0q7s3gOfQcteJ8SdxYGnMprNxLbLZIMWqkP3mv3E8oBJRIK4k04bUtFewuyIJBEWlBEzaFit0p0FDQZZPZ4atvpqLR-jZm244', 'android', '3ae2cdcd-ef75-4ca4-a6a9-a7c81cafb9e8', 'customer', '2018-03-07 18:53:08', '2018-03-07 18:53:08'),
(73, 5, NULL, 'ebfa4a860cc8063ea59b5de4e0de3110ef06450a22ce8a2052a0aa7720ac067b', 'ios', 'd430c65e-d032-49da-b77f-1e1d9262f4f7', 'washer', '2018-03-09 07:06:55', '2018-03-09 07:06:55'),
(77, NULL, 2, '998699983b54497b69d5b04b589d9128e770488e22bc56926ad2a74fc079e310', 'ios', '6798e4bd-daa1-4582-a4d7-5ae0c49fa3f0', 'customer', '2018-03-09 17:17:37', '2018-03-09 17:17:37'),
(75, 4, NULL, '6e9e6f13bdad687f231bb0b361c5acdd6cfdb6bc7d5efad496464f1ffa82d347', 'ios', '3ac0464f-a5af-4430-a1b2-fe83dffa2767', 'washer', '2018-03-09 08:58:10', '2018-03-09 08:58:10'),
(82, 8, NULL, 'e1cALoAJ8g8:APA91bHbvadwpTPRjJUtjKmvCFMHjuQWg3UY7t6siNujPZ0jdlyiTN-3Lqr7zc59mEOpJjHSZhmHNb1bDvmvlcHHb4BZIhI9yb6_qievAHMKXYlbNfbkBuAlzXjg2L7L0B3k68Siwrl6', 'android', 'fccbfe15-aec4-4ec7-ab54-e5ae6b60895b', 'washer', '2018-03-12 10:06:08', '2018-03-12 10:06:08'),
(84, 8, NULL, 'fl7QrP1vDGs:APA91bHXWuOpkuhZE8xWa0tn8x3fopT3iOA4uDQD38NGLaj7OoO6SExl6GBrtnvjl4Cgea-zhLnSChg2AFJFlEyR-BFgWXo7173-KcqF6da1AhNVlE0iz4bDiG5yR68S7n1g5S8j0_Mv', 'android', '6de7af5d-134c-4092-88d4-509e7f59eabb', 'washer', '2018-03-12 10:25:20', '2018-03-12 10:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `media__files`
--

CREATE TABLE `media__files` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mimetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filesize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media__files`
--

INSERT INTO `media__files` (`id`, `filename`, `path`, `extension`, `mimetype`, `filesize`, `folder_id`, `created_at`, `updated_at`) VALUES
(1, 'file.jpg', '/assets/media/file.jpg', 'jpg', 'image/jpeg', '125604', 0, '2018-01-02 00:43:12', '2018-01-02 00:43:12'),
(2, 'avatar_1515210493.jpg', '/assets/media/avatar_1515210493.jpg', 'jpg', 'image/jpeg', '163826', 0, '2018-01-06 10:48:13', '2018-01-06 10:48:13'),
(3, 'avatar_1516243073.jpg', '/assets/media/avatar_1516243073.jpg', 'jpg', 'image/jpeg', '208563', 0, '2018-01-18 09:37:53', '2018-01-18 09:37:53'),
(4, 'avatar_1518357222.jpg', '/assets/media/avatar_1518357222.jpg', 'jpg', 'image/jpeg', '144219', 0, '2018-02-11 20:53:42', '2018-02-11 20:53:42'),
(5, 'avatar_1520158451.jpg', '/assets/media/avatar_1520158451.jpg', 'jpg', 'image/jpeg', '43937', 0, '2018-03-04 17:14:11', '2018-03-04 17:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `media__file_translations`
--

CREATE TABLE `media__file_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_attribute` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media__imageables`
--

CREATE TABLE `media__imageables` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_id` int(11) NOT NULL,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media__imageables`
--

INSERT INTO `media__imageables` (`id`, `file_id`, `imageable_id`, `imageable_type`, `zone`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Modules\\Washer\\Entities\\Washer', 'WasherAvatarImage', NULL, '2018-01-02 00:43:12', '2018-01-02 00:43:12'),
(3, 3, 2, 'Modules\\Customer\\Entities\\Customer', 'CustomerAvatarImage', NULL, '2018-01-18 09:37:53', '2018-01-18 09:37:53'),
(4, 4, 5, 'Modules\\Washer\\Entities\\Washer', 'WasherAvatarImage', NULL, '2018-02-11 20:53:42', '2018-02-11 20:53:42'),
(5, 5, 3, 'Modules\\Customer\\Entities\\Customer', 'CustomerAvatarImage', NULL, '2018-03-04 17:14:11', '2018-03-04 17:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `menu__menuitems`
--

CREATE TABLE `menu__menuitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `target` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page',
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `module_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_root` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu__menuitem_translations`
--

CREATE TABLE `menu__menuitem_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `menuitem_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu__menus`
--

CREATE TABLE `menu__menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `primary` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu__menu_translations`
--

CREATE TABLE `menu__menu_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_14_200250_create_settings_table', 1),
(2, '2014_10_15_191204_create_setting_translations_table', 1),
(3, '2015_06_18_170048_make_settings_value_text_field', 1),
(4, '2015_10_22_130947_make_settings_name_unique', 1),
(5, '2017_12_18_180716119232_create_reporting_reportings_table', 2),
(6, '2016_07_12_181155032011_create_tag_tags_table', 3),
(7, '2016_07_12_181155289444_create_tag_tag_translations_table', 3),
(8, '2017_10_28_084645298335_create_washer_washers_table', 4),
(9, '2017_11_23_171213404438_create_washrequest_washrequests_table', 5),
(10, '2017_12_20_155441669280_create_rating_ratings_table', 6),
(11, '2014_07_02_230147_migration_cartalyst_sentinel', 7),
(12, '2016_06_24_193447_create_user_tokens_table', 7),
(13, '2017_11_12_153559_create_washer_customer_login_table', 8),
(14, '2017_11_23_115453_create_devices_table', 8),
(15, '2017_10_28_084711399235_create_customer_customers_table', 9),
(16, '2017_11_27_154216_create_customer_car_detail_table', 9),
(17, '2015_04_02_184200_create_widgets_table', 10),
(18, '2014_10_26_162751_create_files_table', 11),
(19, '2014_10_26_162811_create_file_translations_table', 11),
(20, '2015_02_27_105241_create_image_links_table', 11),
(21, '2015_12_19_143643_add_sortable', 11),
(22, '2017_12_13_021330187705_create_notify_notifies_table', 12),
(23, '2014_11_03_160015_create_menus_table', 13),
(24, '2014_11_03_160138_create_menu-translations_table', 13),
(25, '2014_11_03_160753_create_menuitems_table', 13),
(26, '2014_11_03_160804_create_menuitem_translation_table', 13),
(27, '2014_12_17_185301_add_root_column_to_menus_table', 13),
(28, '2015_09_05_100142_add_icon_column_to_menuitems_table', 13),
(29, '2016_01_26_102307_update_icon_column_on_menuitems_table', 13),
(30, '2016_08_01_142345_add_link_type_colymn_to_menuitems_table', 13),
(31, '2016_08_01_143130_add_class_column_to_menuitems_table', 13),
(32, '2013_04_09_062329_create_revisions_table', 14),
(33, '2015_11_20_184604486385_create_translation_translations_table', 14),
(34, '2015_11_20_184604743083_create_translation_translation_translations_table', 14),
(35, '2015_12_01_094031_update_translation_translations_table_with_index', 14),
(36, '2014_11_30_191858_create_pages_tables', 15),
(37, '2018_01_16_151330_create_washer_customer_forgot_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `notify__notifies`
--

CREATE TABLE `notify__notifies` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `sender_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'customer/washer',
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'customer/washer',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `message_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notify__notifies`
--

INSERT INTO `notify__notifies` (`id`, `sender_id`, `sender_type`, `receiver_id`, `receiver_type`, `title`, `message`, `message_type`, `is_new`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'customer', 1, 'washer', 'New Car Wash Request from quang son', 'You have a new car wash request from user quang son, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-02 01:24:01', '2018-01-02 01:24:01'),
(2, 1, 'customer', 1, 'washer', 'New Car Wash Request from quang son', 'You have a new car wash request from user quang son, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-02 01:41:16', '2018-01-02 01:41:16'),
(3, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:37:07', '2018-01-03 10:37:07'),
(4, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:37:07', '2018-01-03 10:37:07'),
(5, 4, 'washer', 2, 'customer', 'Tan Long accepted your wash request', 'Washer Tan Long has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:37:32', '2018-01-03 10:37:32'),
(6, 2, 'customer', 4, 'washer', 'Wash request accepted and processing payment', 'Customer Hung Bui has accepted your submission and making payment', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:37:42', '2018-01-03 10:37:42'),
(7, 2, 'customer', 4, 'washer', 'Wash request payment done', 'Customer Hung Bui has done the payment, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:38:04', '2018-01-03 10:38:04'),
(8, 4, 'washer', 2, 'customer', 'Wash request processing', 'Washer Tan Long are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:38:20', '2018-01-03 10:38:20'),
(9, 4, 'washer', 2, 'customer', 'Wash request completed', 'Washer Tan Long has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:38:33', '2018-01-03 10:38:33'),
(10, 2, 'customer', 4, 'washer', 'Wash request confirmed', 'Customer Hung Bui has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-01-03 10:38:39', '2018-01-03 10:38:39'),
(11, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-05 15:19:19', '2018-01-05 15:19:19'),
(12, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-05 15:19:19', '2018-01-05 15:19:19'),
(13, 3, 'customer', NULL, 'washer', 'Wash request cancelled', 'Customer Steven Lai  has cancelled the wash request', 'CAR_WASH_REQUEST', 1, 0, '2018-01-05 15:20:13', '2018-01-05 15:20:13'),
(14, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:38:54', '2018-01-18 09:38:54'),
(15, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:38:54', '2018-01-18 09:38:54'),
(16, 2, 'customer', 5, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:38:54', '2018-01-18 09:38:54'),
(17, 4, 'washer', 2, 'customer', 'Tan Long accepted your wash request', 'Washer Tan Long has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:39:07', '2018-01-18 09:39:07'),
(18, 2, 'customer', 4, 'washer', 'Wash request accepted and processing payment', 'Customer Hung Bui has accepted your submission and making payment', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:39:17', '2018-01-18 09:39:17'),
(19, 2, 'customer', 4, 'washer', 'Wash request payment done', 'Customer Hung Bui has done the payment, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:39:32', '2018-01-18 09:39:32'),
(20, 4, 'washer', 2, 'customer', 'Wash request processing', 'Washer Tan Long are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:39:54', '2018-01-18 09:39:54'),
(21, 4, 'washer', 2, 'customer', 'Wash request completed', 'Washer Tan Long has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:40:07', '2018-01-18 09:40:07'),
(22, 2, 'customer', 4, 'washer', 'Wash request confirmed', 'Customer Hung Bui has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:40:11', '2018-01-18 09:40:11'),
(23, 2, 'customer', 4, 'washer', 'You received a rating from a customer', 'Customer Hung Bui rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:40:43', '2018-01-18 09:40:43'),
(24, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:43:38', '2018-01-18 09:43:38'),
(25, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:43:38', '2018-01-18 09:43:38'),
(26, 2, 'customer', 5, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:43:38', '2018-01-18 09:43:38'),
(27, 4, 'washer', 2, 'customer', 'Tan Long accepted your wash request', 'Washer Tan Long has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:43:43', '2018-01-18 09:43:43'),
(28, 2, 'customer', 4, 'washer', 'Wash request accepted and processing payment', 'Customer Hung Bui has accepted your submission and making payment', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:43:48', '2018-01-18 09:43:48'),
(29, 2, 'customer', 4, 'washer', 'Wash request payment done', 'Customer Hung Bui has done the payment, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:43:57', '2018-01-18 09:43:57'),
(30, 4, 'washer', 2, 'customer', 'Wash request processing', 'Washer Tan Long are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:44:02', '2018-01-18 09:44:02'),
(31, 4, 'washer', 2, 'customer', 'Wash request completed', 'Washer Tan Long has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:44:07', '2018-01-18 09:44:07'),
(32, 2, 'customer', 4, 'washer', 'Wash request confirmed', 'Customer Hung Bui has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:44:11', '2018-01-18 09:44:11'),
(33, 2, 'customer', 4, 'washer', 'You received a rating from a customer', 'Customer Hung Bui rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:44:21', '2018-01-18 09:44:21'),
(34, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:45:38', '2018-01-18 09:45:38'),
(35, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:45:38', '2018-01-18 09:45:38'),
(36, 2, 'customer', 5, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:45:38', '2018-01-18 09:45:38'),
(37, 4, 'washer', 2, 'customer', 'Tan Long accepted your wash request', 'Washer Tan Long has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:45:46', '2018-01-18 09:45:46'),
(38, 2, 'customer', 4, 'washer', 'Wash request accepted and processing payment', 'Customer Hung Bui has accepted your submission and making payment', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:45:55', '2018-01-18 09:45:55'),
(39, 2, 'customer', 4, 'washer', 'Wash request payment done', 'Customer Hung Bui has done the payment, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:46:13', '2018-01-18 09:46:13'),
(40, 4, 'washer', 2, 'customer', 'Wash request processing', 'Washer Tan Long are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:46:43', '2018-01-18 09:46:43'),
(41, 4, 'washer', 2, 'customer', 'Wash request completed', 'Washer Tan Long has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:46:47', '2018-01-18 09:46:47'),
(42, 2, 'customer', 4, 'washer', 'Wash request confirmed', 'Customer Hung Bui has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:46:57', '2018-01-18 09:46:57'),
(43, 2, 'customer', 4, 'washer', 'You received a rating from a customer', 'Customer Hung Bui rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:47:04', '2018-01-18 09:47:04'),
(44, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:48:36', '2018-01-18 09:48:36'),
(45, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:48:36', '2018-01-18 09:48:36'),
(46, 2, 'customer', 5, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:48:36', '2018-01-18 09:48:36'),
(47, 4, 'washer', 2, 'customer', 'Tan Long accepted your wash request', 'Washer Tan Long has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:48:43', '2018-01-18 09:48:43'),
(48, 2, 'customer', 4, 'washer', 'Wash request accepted and processing payment', 'Customer Hung Bui has accepted your submission and making payment', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:48:49', '2018-01-18 09:48:49'),
(49, 2, 'customer', 4, 'washer', 'Wash request payment done', 'Customer Hung Bui has done the payment, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:48:57', '2018-01-18 09:48:57'),
(50, 4, 'washer', 2, 'customer', 'Wash request processing', 'Washer Tan Long are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:49:18', '2018-01-18 09:49:18'),
(51, 4, 'washer', 2, 'customer', 'Wash request completed', 'Washer Tan Long has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:49:23', '2018-01-18 09:49:23'),
(52, 2, 'customer', 4, 'washer', 'Wash request confirmed', 'Customer Hung Bui has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:49:31', '2018-01-18 09:49:31'),
(53, 2, 'customer', 4, 'washer', 'You received a rating from a customer', 'Customer Hung Bui rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-01-18 09:49:35', '2018-01-18 09:49:35'),
(54, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-23 20:57:30', '2018-01-23 20:57:30'),
(55, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-23 20:57:30', '2018-01-23 20:57:30'),
(56, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:02:23', '2018-01-24 10:02:23'),
(57, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:02:23', '2018-01-24 10:02:23'),
(58, 4, 'washer', 2, 'customer', 'Tan Long accepted your wash request', 'Washer Tan Long has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:03:16', '2018-01-24 10:03:16'),
(59, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:05:48', '2018-01-24 10:05:48'),
(60, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:05:48', '2018-01-24 10:05:48'),
(61, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:06:08', '2018-01-24 10:06:08'),
(62, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:06:08', '2018-01-24 10:06:08'),
(63, 4, 'washer', 2, 'customer', 'Tan Long accepted your wash request', 'Washer Tan Long has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:06:15', '2018-01-24 10:06:15'),
(64, 2, 'customer', 4, 'washer', 'Wash request accepted and processing payment', 'Customer Hung Bui has accepted your submission and making payment', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:06:28', '2018-01-24 10:06:28'),
(65, 2, 'customer', 4, 'washer', 'Wash request payment done', 'Customer Hung Bui has done the payment, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-01-24 10:06:37', '2018-01-24 10:06:37'),
(66, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-27 07:23:44', '2018-01-27 07:23:44'),
(67, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-27 07:23:44', '2018-01-27 07:23:44'),
(68, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-28 20:09:53', '2018-01-28 20:09:53'),
(69, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-01-28 20:09:53', '2018-01-28 20:09:53'),
(70, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-04 12:18:19', '2018-02-04 12:18:19'),
(71, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-04 12:18:19', '2018-02-04 12:18:19'),
(72, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:49:22', '2018-02-06 21:49:22'),
(73, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:49:22', '2018-02-06 21:49:22'),
(74, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:49:22', '2018-02-06 21:49:22'),
(75, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:50:55', '2018-02-06 21:50:55'),
(76, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:50:55', '2018-02-06 21:50:55'),
(77, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:50:55', '2018-02-06 21:50:55'),
(78, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:53:05', '2018-02-06 21:53:05'),
(79, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:53:05', '2018-02-06 21:53:05'),
(80, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:53:05', '2018-02-06 21:53:05'),
(81, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:53:17', '2018-02-06 21:53:17'),
(82, 5, 'customer', 6, 'washer', 'Wash request accepted and processing payment', 'Customer user has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:53:27', '2018-02-06 21:53:27'),
(83, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:56:38', '2018-02-06 21:56:38'),
(84, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:56:38', '2018-02-06 21:56:38'),
(85, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:56:38', '2018-02-06 21:56:38'),
(86, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:56:55', '2018-02-06 21:56:55'),
(87, 5, 'customer', 6, 'washer', 'Wash request payment done', 'Customer user has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:57:07', '2018-02-06 21:57:07'),
(88, 6, 'washer', 5, 'customer', 'Wash request processing', 'Washer washer  are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:57:17', '2018-02-06 21:57:17'),
(89, 6, 'washer', 5, 'customer', 'Wash request completed', 'Washer washer  has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:57:22', '2018-02-06 21:57:22'),
(90, 5, 'customer', 6, 'washer', 'Wash request confirmed', 'Customer user has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:57:34', '2018-02-06 21:57:34'),
(91, 5, 'customer', 6, 'washer', 'You received a rating from a customer', 'Customer user rate 4 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 21:57:57', '2018-02-06 21:57:57'),
(92, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:11:29', '2018-02-06 22:11:29'),
(93, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:11:29', '2018-02-06 22:11:29'),
(94, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:11:29', '2018-02-06 22:11:29'),
(95, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:12:06', '2018-02-06 22:12:06'),
(96, 5, 'customer', 6, 'washer', 'Wash request accepted and processing payment', 'Customer user has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:12:30', '2018-02-06 22:12:30'),
(97, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:17:36', '2018-02-06 22:17:36'),
(98, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:17:36', '2018-02-06 22:17:36'),
(99, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:17:36', '2018-02-06 22:17:36'),
(100, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:17:51', '2018-02-06 22:17:51'),
(101, 5, 'customer', 6, 'washer', 'Wash request payment done', 'Customer user has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:18:03', '2018-02-06 22:18:03'),
(102, 6, 'washer', 5, 'customer', 'Wash request processing', 'Washer washer  are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:18:22', '2018-02-06 22:18:22'),
(103, 6, 'washer', 5, 'customer', 'Wash request completed', 'Washer washer  has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:18:27', '2018-02-06 22:18:27'),
(104, 5, 'customer', 6, 'washer', 'Wash request confirmed', 'Customer user has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:18:36', '2018-02-06 22:18:36'),
(105, 5, 'customer', 6, 'washer', 'You received a rating from a customer', 'Customer user rate 4 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:18:57', '2018-02-06 22:18:57'),
(106, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:24:39', '2018-02-06 22:24:39'),
(107, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:24:39', '2018-02-06 22:24:39'),
(108, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:24:39', '2018-02-06 22:24:39'),
(109, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:25:09', '2018-02-06 22:25:09'),
(110, 5, 'customer', 6, 'washer', 'Wash request payment done', 'Customer user has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:25:19', '2018-02-06 22:25:19'),
(111, 6, 'washer', 5, 'customer', 'Wash request processing', 'Washer washer  are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:25:36', '2018-02-06 22:25:36'),
(112, 6, 'washer', 5, 'customer', 'Wash request completed', 'Washer washer  has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:25:49', '2018-02-06 22:25:49'),
(113, 5, 'customer', 6, 'washer', 'Wash request confirmed', 'Customer user has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:25:59', '2018-02-06 22:25:59'),
(114, 5, 'customer', 6, 'washer', 'You received a rating from a customer', 'Customer user rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:26:33', '2018-02-06 22:26:33'),
(115, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:36:30', '2018-02-06 22:36:30'),
(116, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:36:30', '2018-02-06 22:36:30'),
(117, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:36:30', '2018-02-06 22:36:30'),
(118, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:37:04', '2018-02-06 22:37:04'),
(119, 5, 'customer', 6, 'washer', 'Wash request payment done', 'Customer user has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:37:16', '2018-02-06 22:37:16'),
(120, 6, 'washer', 5, 'customer', 'Wash request processing', 'Washer washer  are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:37:49', '2018-02-06 22:37:49'),
(121, 6, 'washer', 5, 'customer', 'Wash request completed', 'Washer washer  has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:38:05', '2018-02-06 22:38:05'),
(122, 5, 'customer', 6, 'washer', 'Wash request confirmed', 'Customer user has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:38:19', '2018-02-06 22:38:19'),
(123, 5, 'customer', 6, 'washer', 'You received a rating from a customer', 'Customer user rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:38:51', '2018-02-06 22:38:51'),
(124, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:39:47', '2018-02-06 22:39:47'),
(125, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:39:47', '2018-02-06 22:39:47'),
(126, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:39:47', '2018-02-06 22:39:47'),
(127, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:40:13', '2018-02-06 22:40:13'),
(128, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:40:48', '2018-02-06 22:40:48'),
(129, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:40:48', '2018-02-06 22:40:48'),
(130, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:40:48', '2018-02-06 22:40:48'),
(131, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:40:55', '2018-02-06 22:40:55'),
(132, 5, 'customer', 6, 'washer', 'Wash request declined', 'Customer user declined your wash request', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:51:20', '2018-02-06 22:51:20'),
(133, 5, 'customer', 6, 'washer', 'Wash request declined', 'Customer user declined your wash request', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:52:07', '2018-02-06 22:52:07'),
(134, 5, 'customer', 1, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:54:14', '2018-02-06 22:54:14'),
(135, 5, 'customer', 4, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:54:14', '2018-02-06 22:54:14'),
(136, 5, 'customer', 6, 'washer', 'New Car Wash Request from user', 'You have a new car wash request from user user, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:54:14', '2018-02-06 22:54:14'),
(137, 6, 'washer', 5, 'customer', 'washer  accepted your wash request', 'Washer washer  has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:54:31', '2018-02-06 22:54:31'),
(138, 5, 'customer', 6, 'washer', 'Wash request payment done', 'Customer user has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:54:51', '2018-02-06 22:54:51'),
(139, 6, 'washer', 5, 'customer', 'Wash request processing', 'Washer washer  are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:55:05', '2018-02-06 22:55:05'),
(140, 6, 'washer', 5, 'customer', 'Wash request completed', 'Washer washer  has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:55:21', '2018-02-06 22:55:21'),
(141, 5, 'customer', 6, 'washer', 'Wash request confirmed', 'Customer user has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:55:38', '2018-02-06 22:55:38'),
(142, 5, 'customer', 6, 'washer', 'You received a rating from a customer', 'Customer user rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-02-06 22:55:56', '2018-02-06 22:55:56'),
(143, 2, 'customer', 4, 'washer', 'Wash request payment done', 'Customer Hung Bui has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-07 17:21:54', '2018-02-07 17:21:54'),
(144, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:37:34', '2018-02-11 20:37:34'),
(145, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:37:34', '2018-02-11 20:37:34'),
(146, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:37:34', '2018-02-11 20:37:34'),
(147, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:41:33', '2018-02-11 20:41:33'),
(148, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:41:33', '2018-02-11 20:41:33'),
(149, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:41:33', '2018-02-11 20:41:33'),
(150, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:47:37', '2018-02-11 20:47:37'),
(151, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:47:37', '2018-02-11 20:47:37'),
(152, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:47:37', '2018-02-11 20:47:37'),
(153, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:58:05', '2018-02-11 20:58:05'),
(154, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:58:05', '2018-02-11 20:58:05'),
(155, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:58:05', '2018-02-11 20:58:05'),
(156, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:58:05', '2018-02-11 20:58:05'),
(157, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:58:22', '2018-02-11 20:58:22'),
(158, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:58:36', '2018-02-11 20:58:36'),
(159, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:59:04', '2018-02-11 20:59:04'),
(160, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:59:13', '2018-02-11 20:59:13'),
(161, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:59:24', '2018-02-11 20:59:24'),
(162, 3, 'customer', 5, 'washer', 'You received a rating from a customer', 'Customer Steven Lai  rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-02-11 20:59:30', '2018-02-11 20:59:30'),
(163, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:00:18', '2018-03-01 07:00:18'),
(164, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:00:18', '2018-03-01 07:00:18'),
(165, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:00:18', '2018-03-01 07:00:18'),
(166, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:00:18', '2018-03-01 07:00:18'),
(167, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:00:49', '2018-03-01 07:00:49'),
(168, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:00:57', '2018-03-01 07:00:57'),
(169, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:01:05', '2018-03-01 07:01:05'),
(170, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:01:14', '2018-03-01 07:01:14'),
(171, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:01:46', '2018-03-01 07:01:46'),
(172, 3, 'customer', 5, 'washer', 'You received a rating from a customer', 'Customer Steven Lai  rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:02:06', '2018-03-01 07:02:06'),
(173, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:02:50', '2018-03-01 07:02:50'),
(174, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:02:50', '2018-03-01 07:02:50'),
(175, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:02:50', '2018-03-01 07:02:50'),
(176, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:02:50', '2018-03-01 07:02:50'),
(177, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:03:04', '2018-03-01 07:03:04'),
(178, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:03:20', '2018-03-01 07:03:20'),
(179, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:03:29', '2018-03-01 07:03:29'),
(180, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:03:47', '2018-03-01 07:03:47'),
(181, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-01 07:10:10', '2018-03-01 07:10:10'),
(182, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:46:19', '2018-03-03 07:46:19'),
(183, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:46:19', '2018-03-03 07:46:19'),
(184, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:46:19', '2018-03-03 07:46:19'),
(185, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:46:19', '2018-03-03 07:46:19'),
(186, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:46:28', '2018-03-03 07:46:28'),
(187, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:50:05', '2018-03-03 07:50:05'),
(188, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:50:11', '2018-03-03 07:50:11'),
(189, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:50:53', '2018-03-03 07:50:53'),
(190, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:52:14', '2018-03-03 07:52:14'),
(191, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:52:44', '2018-03-03 07:52:44'),
(192, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:52:44', '2018-03-03 07:52:44'),
(193, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:52:44', '2018-03-03 07:52:44'),
(194, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:52:44', '2018-03-03 07:52:44'),
(195, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:53:59', '2018-03-03 07:53:59'),
(196, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:53:59', '2018-03-03 07:53:59'),
(197, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:53:59', '2018-03-03 07:53:59'),
(198, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:53:59', '2018-03-03 07:53:59'),
(199, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:54:19', '2018-03-03 07:54:19'),
(200, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:54:33', '2018-03-03 07:54:33'),
(201, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:54:44', '2018-03-03 07:54:44'),
(202, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:54:54', '2018-03-03 07:54:54'),
(203, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:58:02', '2018-03-03 07:58:02'),
(204, 3, 'customer', 5, 'washer', 'You received a rating from a customer', 'Customer Steven Lai  rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 07:58:07', '2018-03-03 07:58:07'),
(205, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:18:52', '2018-03-03 22:18:52'),
(206, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:18:52', '2018-03-03 22:18:52'),
(207, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:18:52', '2018-03-03 22:18:52'),
(208, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:18:52', '2018-03-03 22:18:52'),
(209, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:20:18', '2018-03-03 22:20:18'),
(210, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:20:18', '2018-03-03 22:20:18'),
(211, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:20:18', '2018-03-03 22:20:18'),
(212, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:20:18', '2018-03-03 22:20:18'),
(213, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:20:55', '2018-03-03 22:20:55'),
(214, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:21:06', '2018-03-03 22:21:06'),
(215, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:21:14', '2018-03-03 22:21:14'),
(216, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:21:18', '2018-03-03 22:21:18'),
(217, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:21:24', '2018-03-03 22:21:24'),
(218, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:23:08', '2018-03-03 22:23:08'),
(219, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:23:08', '2018-03-03 22:23:08'),
(220, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:23:08', '2018-03-03 22:23:08'),
(221, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:23:08', '2018-03-03 22:23:08'),
(222, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:23:24', '2018-03-03 22:23:24'),
(223, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-03 22:24:43', '2018-03-03 22:24:43'),
(224, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:33:52', '2018-03-04 11:33:52'),
(225, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:33:52', '2018-03-04 11:33:52'),
(226, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:33:52', '2018-03-04 11:33:52'),
(227, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:33:52', '2018-03-04 11:33:52'),
(228, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:37:03', '2018-03-04 11:37:03'),
(229, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:37:50', '2018-03-04 11:37:50'),
(230, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:38:29', '2018-03-04 11:38:29'),
(231, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:39:20', '2018-03-04 11:39:20');
INSERT INTO `notify__notifies` (`id`, `sender_id`, `sender_type`, `receiver_id`, `receiver_type`, `title`, `message`, `message_type`, `is_new`, `is_read`, `created_at`, `updated_at`) VALUES
(232, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:39:20', '2018-03-04 11:39:20'),
(233, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:39:20', '2018-03-04 11:39:20'),
(234, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:39:20', '2018-03-04 11:39:20'),
(235, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:39:51', '2018-03-04 11:39:51'),
(236, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:40:03', '2018-03-04 11:40:03'),
(237, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:40:38', '2018-03-04 11:40:38'),
(238, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:40:41', '2018-03-04 11:40:41'),
(239, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:40:49', '2018-03-04 11:40:49'),
(240, 3, 'customer', 5, 'washer', 'You received a rating from a customer', 'Customer Steven Lai  rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 11:40:54', '2018-03-04 11:40:54'),
(241, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:30:51', '2018-03-04 17:30:51'),
(242, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:30:51', '2018-03-04 17:30:51'),
(243, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:30:51', '2018-03-04 17:30:51'),
(244, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:30:51', '2018-03-04 17:30:51'),
(245, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:31:57', '2018-03-04 17:31:57'),
(246, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:31:57', '2018-03-04 17:31:57'),
(247, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:31:57', '2018-03-04 17:31:57'),
(248, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:31:57', '2018-03-04 17:31:57'),
(249, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:32:21', '2018-03-04 17:32:21'),
(250, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:34:59', '2018-03-04 17:34:59'),
(251, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:35:38', '2018-03-04 17:35:38'),
(252, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:35:41', '2018-03-04 17:35:41'),
(253, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 17:36:01', '2018-03-04 17:36:01'),
(254, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:58:22', '2018-03-04 19:58:22'),
(255, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:58:22', '2018-03-04 19:58:22'),
(256, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:58:22', '2018-03-04 19:58:22'),
(257, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:58:22', '2018-03-04 19:58:22'),
(258, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:59:35', '2018-03-04 19:59:35'),
(259, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:59:35', '2018-03-04 19:59:35'),
(260, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:59:35', '2018-03-04 19:59:35'),
(261, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:59:35', '2018-03-04 19:59:35'),
(262, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 19:59:39', '2018-03-04 19:59:39'),
(263, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:00:12', '2018-03-04 20:00:12'),
(264, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:00:27', '2018-03-04 20:00:27'),
(265, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:00:39', '2018-03-04 20:00:39'),
(266, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:00:48', '2018-03-04 20:00:48'),
(267, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:02:25', '2018-03-04 20:02:25'),
(268, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:02:25', '2018-03-04 20:02:25'),
(269, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:02:25', '2018-03-04 20:02:25'),
(270, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:02:25', '2018-03-04 20:02:25'),
(271, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:02:39', '2018-03-04 20:02:39'),
(272, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:03:08', '2018-03-04 20:03:08'),
(273, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:03:24', '2018-03-04 20:03:24'),
(274, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:03:35', '2018-03-04 20:03:35'),
(275, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:03:59', '2018-03-04 20:03:59'),
(276, 3, 'customer', 5, 'washer', 'You received a rating from a customer', 'Customer Steven Lai  rate 4 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:04:08', '2018-03-04 20:04:08'),
(277, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:06:07', '2018-03-04 20:06:07'),
(278, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:06:07', '2018-03-04 20:06:07'),
(279, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:06:07', '2018-03-04 20:06:07'),
(280, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:06:07', '2018-03-04 20:06:07'),
(281, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:06:39', '2018-03-04 20:06:39'),
(282, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:07:08', '2018-03-04 20:07:08'),
(283, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:07:33', '2018-03-04 20:07:33'),
(284, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:07:49', '2018-03-04 20:07:49'),
(285, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-04 20:08:52', '2018-03-04 20:08:52'),
(286, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:09:52', '2018-03-06 20:09:52'),
(287, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:09:52', '2018-03-06 20:09:52'),
(288, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:09:52', '2018-03-06 20:09:52'),
(289, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:09:52', '2018-03-06 20:09:52'),
(290, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:38:38', '2018-03-06 20:38:38'),
(291, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:38:38', '2018-03-06 20:38:38'),
(292, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:38:38', '2018-03-06 20:38:38'),
(293, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:38:38', '2018-03-06 20:38:38'),
(294, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:45', '2018-03-06 20:40:45'),
(295, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:45', '2018-03-06 20:40:45'),
(296, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:45', '2018-03-06 20:40:45'),
(297, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:45', '2018-03-06 20:40:45'),
(298, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:45', '2018-03-06 20:40:45'),
(299, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:45', '2018-03-06 20:40:45'),
(300, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:45', '2018-03-06 20:40:45'),
(301, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:46', '2018-03-06 20:40:46'),
(302, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:46', '2018-03-06 20:40:46'),
(303, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:46', '2018-03-06 20:40:46'),
(304, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:46', '2018-03-06 20:40:46'),
(305, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 20:40:46', '2018-03-06 20:40:46'),
(306, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:17', '2018-03-06 21:22:17'),
(307, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:17', '2018-03-06 21:22:17'),
(308, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:17', '2018-03-06 21:22:17'),
(309, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:17', '2018-03-06 21:22:17'),
(310, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:20', '2018-03-06 21:22:20'),
(311, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:20', '2018-03-06 21:22:20'),
(312, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:20', '2018-03-06 21:22:20'),
(313, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:20', '2018-03-06 21:22:20'),
(314, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:24', '2018-03-06 21:22:24'),
(315, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:24', '2018-03-06 21:22:24'),
(316, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:24', '2018-03-06 21:22:24'),
(317, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:22:24', '2018-03-06 21:22:24'),
(318, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:25:07', '2018-03-06 21:25:07'),
(319, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:25:07', '2018-03-06 21:25:07'),
(320, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:25:07', '2018-03-06 21:25:07'),
(321, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 21:25:07', '2018-03-06 21:25:07'),
(322, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:10:05', '2018-03-06 22:10:05'),
(323, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:10:05', '2018-03-06 22:10:05'),
(324, 2, 'customer', 5, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:10:05', '2018-03-06 22:10:05'),
(325, 2, 'customer', 6, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:10:05', '2018-03-06 22:10:05'),
(326, 2, 'customer', 1, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:15:01', '2018-03-06 22:15:01'),
(327, 2, 'customer', 4, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:15:01', '2018-03-06 22:15:01'),
(328, 2, 'customer', 5, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:15:01', '2018-03-06 22:15:01'),
(329, 2, 'customer', 6, 'washer', 'New Car Wash Request from Hung Bui', 'You have a new car wash request from user Hung Bui, please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-06 22:15:01', '2018-03-06 22:15:01'),
(330, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:02:26', '2018-03-07 20:02:26'),
(331, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:02:26', '2018-03-07 20:02:26'),
(332, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:02:26', '2018-03-07 20:02:26'),
(333, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:02:26', '2018-03-07 20:02:26'),
(334, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:34', '2018-03-07 20:04:34'),
(335, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:34', '2018-03-07 20:04:34'),
(336, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:34', '2018-03-07 20:04:34'),
(337, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:34', '2018-03-07 20:04:34'),
(338, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:36', '2018-03-07 20:04:36'),
(339, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:36', '2018-03-07 20:04:36'),
(340, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:36', '2018-03-07 20:04:36'),
(341, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:04:36', '2018-03-07 20:04:36'),
(342, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:05:55', '2018-03-07 20:05:55'),
(343, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:06:26', '2018-03-07 20:06:26'),
(344, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:06:37', '2018-03-07 20:06:37'),
(345, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:06:46', '2018-03-07 20:06:46'),
(346, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:11:49', '2018-03-07 20:11:49'),
(347, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:11:49', '2018-03-07 20:11:49'),
(348, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:11:49', '2018-03-07 20:11:49'),
(349, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:11:49', '2018-03-07 20:11:49'),
(350, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:12:32', '2018-03-07 20:12:32'),
(351, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:12:39', '2018-03-07 20:12:39'),
(352, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:12:48', '2018-03-07 20:12:48'),
(353, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:12:57', '2018-03-07 20:12:57'),
(354, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:20:56', '2018-03-07 20:20:56'),
(355, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:20:56', '2018-03-07 20:20:56'),
(356, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:20:56', '2018-03-07 20:20:56'),
(357, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:20:56', '2018-03-07 20:20:56'),
(358, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:21:08', '2018-03-07 20:21:08'),
(359, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:21:18', '2018-03-07 20:21:18'),
(360, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:21:23', '2018-03-07 20:21:23'),
(361, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:21:27', '2018-03-07 20:21:27'),
(362, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:24:56', '2018-03-07 20:24:56'),
(363, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:25:10', '2018-03-07 20:25:10'),
(364, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:25:22', '2018-03-07 20:25:22'),
(365, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:27:30', '2018-03-07 20:27:30'),
(366, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:27:30', '2018-03-07 20:27:30'),
(367, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:27:30', '2018-03-07 20:27:30'),
(368, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:27:30', '2018-03-07 20:27:30'),
(369, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:27:40', '2018-03-07 20:27:40'),
(370, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:27:50', '2018-03-07 20:27:50'),
(371, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:28:12', '2018-03-07 20:28:12'),
(372, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:28:19', '2018-03-07 20:28:19'),
(373, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:28:33', '2018-03-07 20:28:33'),
(374, 3, 'customer', 5, 'washer', 'You received a rating from a customer', 'Customer Steven Lai  rate 4 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:28:40', '2018-03-07 20:28:40'),
(375, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:30:06', '2018-03-07 20:30:06'),
(376, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:30:06', '2018-03-07 20:30:06'),
(377, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:30:06', '2018-03-07 20:30:06'),
(378, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:30:06', '2018-03-07 20:30:06'),
(379, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:30:55', '2018-03-07 20:30:55'),
(380, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:31:23', '2018-03-07 20:31:23'),
(381, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:31:48', '2018-03-07 20:31:48'),
(382, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:32:03', '2018-03-07 20:32:03'),
(383, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-07 20:32:26', '2018-03-07 20:32:26'),
(384, 3, 'customer', 1, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:53:13', '2018-03-13 05:53:13'),
(385, 3, 'customer', 4, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:53:13', '2018-03-13 05:53:13'),
(386, 3, 'customer', 5, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:53:13', '2018-03-13 05:53:13'),
(387, 3, 'customer', 6, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:53:13', '2018-03-13 05:53:13'),
(388, 3, 'customer', 8, 'washer', 'New Car Wash Request from Steven Lai ', 'You have a new car wash request from user Steven Lai , please accept to proceed', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:53:13', '2018-03-13 05:53:13'),
(389, 5, 'washer', 3, 'customer', 'SX accepted your wash request', 'Washer SX has accepted your wash request, please confirm and process payment to continue', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:53:59', '2018-03-13 05:53:59'),
(390, 3, 'customer', 5, 'washer', 'Wash request payment done', 'Customer Steven Lai  has accepted your submission, please start your washing work', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:54:13', '2018-03-13 05:54:13'),
(391, 5, 'washer', 3, 'customer', 'Wash request processing', 'Washer SX are washing your car now', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:54:21', '2018-03-13 05:54:21'),
(392, 5, 'washer', 3, 'customer', 'Wash request completed', 'Washer SX has completed the request, please confirm', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:54:28', '2018-03-13 05:54:28'),
(393, 3, 'customer', 5, 'washer', 'Wash request confirmed', 'Customer Steven Lai  has confirmed your washing as done, congratulation!!!', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:54:35', '2018-03-13 05:54:35'),
(394, 3, 'customer', 5, 'washer', 'You received a rating from a customer', 'Customer Steven Lai  rate 5 star for your washing service', 'CAR_WASH_REQUEST', 1, 0, '2018-03-13 05:54:44', '2018-03-13 05:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `page__pages`
--

CREATE TABLE `page__pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page__pages`
--

INSERT INTO `page__pages` (`id`, `is_home`, `template`, `created_at`, `updated_at`) VALUES
(1, 1, 'home', '2018-01-01 22:05:04', '2018-01-01 22:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `page__page_translations`
--

CREATE TABLE `page__page_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `og_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `og_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `og_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `og_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `page__page_translations`
--

INSERT INTO `page__page_translations` (`id`, `page_id`, `locale`, `title`, `slug`, `status`, `body`, `meta_title`, `meta_description`, `og_title`, `og_description`, `og_image`, `og_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'Home page', 'home', 1, '<p><strong>You made it!</strong></p>\n<p>You&#39;ve installed AsgardCMS and are ready to proceed to the <a href=\"/en/backend\">administration area</a>.</p>\n<h2>What&#39;s next ?</h2>\n<p>Learn how you can develop modules for AsgardCMS by reading our <a href=\"https://github.com/AsgardCms/Documentation\">documentation</a>.</p>\n', 'Home page', NULL, NULL, NULL, NULL, NULL, '2018-01-01 22:05:04', '2018-01-01 22:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(1, 1, 'NVXg3591qWyEHxonTnmBkmMR4Gf2Id65', '2018-01-01 22:15:45', '2018-01-01 22:15:45'),
(2, 1, 'Gu8NocSv6WowHJGjroFFwLm8ySDsFHeK', '2018-01-26 15:00:18', '2018-01-26 15:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `rating__ratings`
--

CREATE TABLE `rating__ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate_number` int(11) NOT NULL DEFAULT '1',
  `rate_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `washer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `washrequest_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rating__ratings`
--

INSERT INTO `rating__ratings` (`id`, `rate_number`, `rate_comment`, `washer_id`, `customer_id`, `washrequest_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'Great job', 4, 2, 5, '2018-01-03 10:38:55', '2018-01-03 10:38:55'),
(2, 5, 'Great', 4, 2, 7, '2018-01-18 09:40:43', '2018-01-18 09:40:43'),
(3, 5, '', 4, 2, 8, '2018-01-18 09:44:21', '2018-01-18 09:44:21'),
(4, 5, '', 4, 2, 9, '2018-01-18 09:47:04', '2018-01-18 09:47:04'),
(5, 5, '', 4, 2, 10, '2018-01-18 09:49:35', '2018-01-18 09:49:35'),
(6, 4, 'Good\n', 6, 5, 21, '2018-02-06 21:57:57', '2018-02-06 21:57:57'),
(7, 4, 'Very good\n', 6, 5, 23, '2018-02-06 22:18:57', '2018-02-06 22:18:57'),
(8, 5, 'Very good', 6, 5, 24, '2018-02-06 22:26:33', '2018-02-06 22:26:33'),
(9, 5, 'Very good', 6, 5, 25, '2018-02-06 22:38:51', '2018-02-06 22:38:51'),
(10, 5, 'Nice', 6, 5, 28, '2018-02-06 22:55:56', '2018-02-06 22:55:56'),
(11, 5, '', 5, 3, 32, '2018-02-11 20:59:30', '2018-02-11 20:59:30'),
(12, 5, '', 5, 3, 33, '2018-03-01 07:02:06', '2018-03-01 07:02:06'),
(13, 5, '', 5, 3, 37, '2018-03-03 07:58:07', '2018-03-03 07:58:07'),
(14, 5, '', 5, 3, 42, '2018-03-04 11:40:54', '2018-03-04 11:40:54'),
(15, 4, '', 5, 3, 47, '2018-03-04 20:04:08', '2018-03-04 20:04:08'),
(16, 4, '', 5, 3, 58, '2018-03-07 20:28:40', '2018-03-07 20:28:40'),
(17, 5, '', 5, 3, 60, '2018-03-13 05:54:44', '2018-03-13 05:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reporting__reportings`
--

CREATE TABLE `reporting__reportings` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `washer_id` int(10) UNSIGNED DEFAULT NULL,
  `washrequest_id` int(10) UNSIGNED DEFAULT NULL,
  `report_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'customer_make_report/washer_make_report',
  `report_content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reporting__reportings`
--

INSERT INTO `reporting__reportings` (`id`, `customer_id`, `washer_id`, `washrequest_id`, `report_type`, `report_content`, `created_at`, `updated_at`) VALUES
(1, NULL, 6, 21, 'washer_make_report', 'reported', '2018-02-06 22:00:16', '2018-02-06 22:00:16'),
(2, NULL, 6, 21, 'washer_make_report', 'report', '2018-02-06 22:00:33', '2018-02-06 22:00:33'),
(3, NULL, 6, 23, 'washer_make_report', 'very fast', '2018-02-06 22:19:29', '2018-02-06 22:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE `revisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `revisionable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `revisionable_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8_unicode_ci,
  `new_value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', '{\"core.sidebar.group\":true,\"dashboard.index\":true,\"dashboard.update\":true,\"dashboard.reset\":true,\"workshop.sidebar.group\":true,\"workshop.modules.index\":true,\"workshop.modules.show\":true,\"workshop.modules.update\":true,\"workshop.modules.disable\":true,\"workshop.modules.enable\":true,\"workshop.modules.publish\":true,\"workshop.themes.index\":true,\"workshop.themes.show\":true,\"workshop.themes.publish\":true,\"user.roles.index\":true,\"user.roles.create\":true,\"user.roles.edit\":true,\"user.roles.destroy\":true,\"user.users.index\":true,\"user.users.create\":true,\"user.users.edit\":true,\"user.users.destroy\":true,\"account.api-keys.index\":true,\"account.api-keys.create\":true,\"account.api-keys.destroy\":true,\"menu.menus.index\":true,\"menu.menus.create\":true,\"menu.menus.edit\":true,\"menu.menus.destroy\":true,\"menu.menuitems.index\":true,\"menu.menuitems.create\":true,\"menu.menuitems.edit\":true,\"menu.menuitems.destroy\":true,\"media.medias.index\":true,\"media.medias.create\":true,\"media.medias.edit\":true,\"media.medias.destroy\":true,\"setting.settings.index\":true,\"setting.settings.edit\":true,\"page.pages.index\":true,\"page.pages.create\":true,\"page.pages.edit\":true,\"page.pages.destroy\":true,\"translation.translations.index\":true,\"translation.translations.edit\":true,\"translation.translations.export\":true,\"translation.translations.import\":true,\"tag.tags.index\":true,\"tag.tags.create\":true,\"tag.tags.edit\":true,\"tag.tags.destroy\":true}', '2018-01-01 22:02:41', '2018-01-01 22:02:41'),
(2, 'user', 'User', NULL, '2018-01-01 22:02:41', '2018-01-01 22:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-01-01 22:05:04', '2018-01-01 22:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `setting__settings`
--

CREATE TABLE `setting__settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plainValue` text COLLATE utf8_unicode_ci,
  `isTranslatable` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting__settings`
--

INSERT INTO `setting__settings` (`id`, `name`, `plainValue`, `isTranslatable`, `created_at`, `updated_at`) VALUES
(1, 'core::template', 'Flatly', 0, '2018-01-01 22:05:04', '2018-01-01 22:05:04'),
(2, 'core::locales', '[\"en\"]', 0, '2018-01-01 22:05:04', '2018-01-01 22:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `setting__setting_translations`
--

CREATE TABLE `setting__setting_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag__tagged`
--

CREATE TABLE `tag__tagged` (
  `id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag__tags`
--

CREATE TABLE `tag__tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `namespace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag__tag_translations`
--

CREATE TABLE `tag__tag_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translation__translations`
--

CREATE TABLE `translation__translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translation__translation_translations`
--

CREATE TABLE `translation__translation_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `translation_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'admin@washmycar.com', '$2y$10$3Q3IZV2mK5jySAXuETL5SOdNYIRLt.zFdaqxQvjUiPUMSbb.CXvlW', NULL, '2018-01-26 15:00:18', 'Washmycar', 'Admin', '2018-01-01 22:05:04', '2018-01-26 15:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `access_token`, `created_at`, `updated_at`) VALUES
(1, 1, '39a12153-437a-4250-ab60-4c37e2a6de1c', '2018-01-01 22:05:04', '2018-01-01 22:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `washer_customer_forgot`
--

CREATE TABLE `washer_customer_forgot` (
  `id` int(10) UNSIGNED NOT NULL,
  `washer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending/completed',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `washer_customer_forgot`
--

INSERT INTO `washer_customer_forgot` (`id`, `washer_id`, `customer_id`, `token`, `status`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, '20e9dc80ba5b0a5cbba36e89687be9379ad6ed5411404a834b29620aff4ee1cd', 'completed', '2018-01-23 20:54:01', '2018-01-23 20:53:12', '2018-01-23 20:54:01'),
(2, NULL, 3, 'a0499ef134b96dbbcbec1998dcf79576d754e8212d83a0531e6be27f8953e317', 'completed', '2018-01-23 20:56:45', '2018-01-23 20:53:57', '2018-01-23 20:56:45'),
(3, 5, NULL, '46ed37f0db1a1317f2ada66018ae50de8792c5257628aaf5da13770b6e039e3b', 'completed', '2018-02-04 23:10:12', '2018-02-04 23:09:50', '2018-02-04 23:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `washer_customer_login`
--

CREATE TABLE `washer_customer_login` (
  `id` int(10) UNSIGNED NOT NULL,
  `washer_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'washer/customer type',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `washer_customer_login`
--

INSERT INTO `washer_customer_login` (`id`, `washer_id`, `customer_id`, `token`, `type`, `created_at`, `updated_at`) VALUES
(5, NULL, 1, 'fafa93cb172ee73500b2ddbc8046172c9b62d3faa6fee89072a766e61a39c642', 'customer', '2018-01-02 01:23:32', '2018-01-02 01:23:32'),
(6, NULL, 2, '3dc060ea6e7de562a285bc251c2fcaa2dfee642cc1e0d1294ad9c9d3a178a159', 'customer', '2018-01-03 08:29:06', '2018-01-03 08:29:06'),
(7, 3, NULL, '477bbf6fc35e850d74b63dcb4762e2a5503f376c1052615cae7b2948fa0f9bb9', 'washer', '2018-01-03 09:42:55', '2018-01-03 09:42:55'),
(8, 4, NULL, 'a319a64543859b127fcece3e5060698096d9a87ec7c241cff5fcc9a48e3b7c89', 'washer', '2018-01-03 10:35:07', '2018-01-03 10:35:07'),
(13, 5, NULL, 'a8e4ca02728c62640b3798950dfee743c12ba6624b10d3fc91bd0ed2aa5e483a', 'washer', '2018-01-06 10:49:23', '2018-01-06 10:49:23'),
(14, NULL, 2, '226557b5034c1b98f54f794027d11ad804204a3a77415e29e2c78a3efef69725', 'customer', '2018-01-18 09:36:40', '2018-01-18 09:36:40'),
(15, 4, NULL, '01f2fd0d12172112173c4df6ec327c19248fe0a95680aca9d35628785a067d9a', 'washer', '2018-01-18 09:36:57', '2018-01-18 09:36:57'),
(16, NULL, 1, '70255fb95f479cce5dff3695e846933226c2644e36efc58110474c8c735c1125', 'customer', '2018-01-18 15:23:07', '2018-01-18 15:23:07'),
(19, NULL, 2, '9b5fee51ae8af9706eec47c308fa8e2230a608442e1e347efd952570d2d5acf6', 'customer', '2018-01-23 09:23:52', '2018-01-23 09:23:52'),
(20, 5, NULL, 'ffcb09b4ec46a25cf728a4e1dfc2c3e2b2d5e6d35b55f80767432dfb71cc41c6', 'washer', '2018-01-23 20:54:18', '2018-01-23 20:54:18'),
(21, NULL, 3, 'e9158ad52a831a9081a5c2b64af3abc17e55c451c21176b60f387a62721995de', 'customer', '2018-01-23 20:57:15', '2018-01-23 20:57:15'),
(22, 4, NULL, '18bb05143ec4921e68ae5f4b571935e1ad62dfecc13bfa8955da562efecd8b75', 'washer', '2018-01-24 10:01:26', '2018-01-24 10:01:26'),
(23, NULL, 2, '79b61694f510106fdcab3ceba2b6c7fb85f51c951cf74eaef8d928e5e9b3f849', 'customer', '2018-01-24 10:01:50', '2018-01-24 10:01:50'),
(46, 4, NULL, '70fa77631ae27dc603097bb8944ed1723fd8f961ef5ff434a72821638fa72fb1', 'washer', '2018-02-07 15:53:41', '2018-02-07 15:53:41'),
(51, 5, NULL, 'bc5d03c8524fe4c4f99feb175be51e09b976d8641be2cd82e1282fd01e0bd9be', 'washer', '2018-02-11 20:39:35', '2018-02-11 20:39:35'),
(50, NULL, 3, '206cf68e62918ef4fd74415efda72264f95457fe9357773caff57635710e8383', 'customer', '2018-02-11 20:39:29', '2018-02-11 20:39:29'),
(44, NULL, 5, 'c7543c83e0137cf3090429a82721d534f6520960f5b75a8f27b7c5096ea7bad8', 'customer', '2018-02-06 22:35:16', '2018-02-06 22:35:16'),
(45, 6, NULL, '7e65091d50ac5a6f27cc2207767778f6a7dfcad518aeae5d9a1706c6d1764006', 'washer', '2018-02-06 22:35:42', '2018-02-06 22:35:42'),
(47, NULL, 2, '3217dfdb4b82554545f3477bdfbf4c7b09a3622815b4efd4f8970f95cf5903db', 'customer', '2018-02-07 15:53:48', '2018-02-07 15:53:48'),
(48, 4, NULL, 'c3b65e3e31d8da870d3e7d9bb7c8290472681acbb2ef70248d58d002a3aed3b7', 'washer', '2018-02-07 17:06:28', '2018-02-07 17:06:28'),
(49, NULL, 2, 'cb07ec15e6f4b5364cceac2d3f46dd8b5ffe3b74a83aa732941d73e4550de8f1', 'customer', '2018-02-07 17:07:05', '2018-02-07 17:07:05'),
(52, 5, NULL, 'd8601cad9d648a1ae6b19a67414f4afebae6499883f3f2e8d016d745353d2a99', 'washer', '2018-02-11 20:51:24', '2018-02-11 20:51:24'),
(53, NULL, 3, '529f277d17fa43d788e56501fbfea5024f8bb196f733d37020b31356d0461829', 'customer', '2018-02-11 20:57:13', '2018-02-11 20:57:13'),
(54, NULL, 5, 'eeefd52e3e69aef995f14177e40cc0847df3ebe94e7dbcecbeafec8d236fc755', 'customer', '2018-02-11 21:44:50', '2018-02-11 21:44:50'),
(57, NULL, 6, '0971654a50ab264df0f973f17748acd8cf0951c979cb7c332ae869687c282739', 'customer', '2018-02-12 23:11:02', '2018-02-12 23:11:02'),
(59, 5, NULL, '1c8887ce04da64251e5aa8f4c5261180fe44d7140ebe14ca1976dff22cfcbe9b', 'washer', '2018-02-13 06:59:08', '2018-02-13 06:59:08'),
(71, NULL, 3, '22a63a1a9e4c47fb8c83bd4ee35723182ecac4b9ef39b0b546ab71f9b3d503f3', 'customer', '2018-03-06 20:07:38', '2018-03-06 20:07:38'),
(61, 4, NULL, '8e64bff4926edffd93c66ff8561e241308305105e87306e995e04e9a06e9d15b', 'washer', '2018-03-03 00:35:16', '2018-03-03 00:35:16'),
(62, NULL, 2, 'f3e5fbdfce5625e2fde36848bae1dc173cac48f58693e8cee5b56923a16255ef', 'customer', '2018-03-03 21:21:07', '2018-03-03 21:21:07'),
(65, 5, NULL, 'd885024c93eacb154bfdcfdd07f8eef40cc234b44d90c72e35b0df53c76c673f', 'washer', '2018-03-04 14:25:11', '2018-03-04 14:25:11'),
(70, NULL, 3, 'dc3199cefd7943bbfcae6c0455cdea880f2a96d12db7dcc1e4f2e4834859626c', 'customer', '2018-03-04 18:58:46', '2018-03-04 18:58:46'),
(73, NULL, 2, '46a9c6a037a15754058a1e121cc89e154880c14194028c595c33ccfdbadc2f53', 'customer', '2018-03-06 22:07:03', '2018-03-06 22:07:03'),
(74, 4, NULL, '6f2017ce5634ab6daef54c14fa75dedd46ec5bf573d4f7c942a93019ebc263f6', 'washer', '2018-03-06 22:08:19', '2018-03-06 22:08:19'),
(80, 4, NULL, '7f9870ca756b9f5bd36740f236751b8d2c67c7ee0dbfcad39880a9808fe90f56', 'washer', '2018-03-06 23:40:04', '2018-03-06 23:40:04'),
(81, 5, NULL, 'b5c4f86ed501a5ea51b35e738d2adffa32946c4a063668828d98df4ceb530aff', 'washer', '2018-03-07 05:29:19', '2018-03-07 05:29:19'),
(82, NULL, 3, 'c64779c27e048ad984855f708ba540d681065fc05418079cb41a47106276d539', 'customer', '2018-03-07 18:53:06', '2018-03-07 18:53:06'),
(87, 5, NULL, 'a525c6af4020fd192cb20a31b27ddb3434af1c3cca1986e3dc97099604c08a2a', 'washer', '2018-03-09 07:06:55', '2018-03-09 07:06:55'),
(91, NULL, 2, '80952c5dd78b570247e7536fd5681fa90a1ea77def69db009189985e9402c7cc', 'customer', '2018-03-09 17:17:37', '2018-03-09 17:17:37'),
(89, 4, NULL, 'd0a6a01c4df9a9719104f20a8627d05bbc08f42284722b6f2997c8ec5b5b1168', 'washer', '2018-03-09 08:58:10', '2018-03-09 08:58:10'),
(96, 8, NULL, 'fbb9303510dfdc32e6c3460e7606b7e8716a48fd75ef1cb3f6ca1f00cead6354', 'washer', '2018-03-12 10:06:08', '2018-03-12 10:06:08'),
(98, 8, NULL, '38b09fbe3403beaf4bfb67343cc95bc81da1e946ccb1c5991a2f438e692040af', 'washer', '2018-03-12 10:25:20', '2018-03-12 10:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `washer__washers`
--

CREATE TABLE `washer__washers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'employed' COMMENT 'value: employed/self_employed/student/homemaker for Employed/Self Employed/Student/Homemaker',
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `push_notification` tinyint(1) NOT NULL DEFAULT '1',
  `first_time_login` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'customer' COMMENT 'Determine the account type',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `washer__washers`
--

INSERT INTO `washer__washers` (`id`, `email`, `full_name`, `password`, `phone_number`, `employment_type`, `facebook_id`, `push_notification`, `first_time_login`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'son2@gmail.com', 'quang son washer1', '$2y$10$Cu/DiHxOUeCijq77gRQOGONn7tuPKqEJaml.iioAOAPCQyfFWIx1i', '+659824132812', 'self_employed', NULL, 1, 1, 'washer', NULL, '2018-01-02 00:40:48', '2018-01-02 00:44:40'),
(2, 'hungwasher@gmail.com', 'Ngoc Hung', '$2y$10$e2V0NZxY/ITs1Guld2J/gOvGyCoLyAkIY8Es6hnADeGF22tTRipaO', '+65123456789', 'homemaker', NULL, 1, 1, 'washer', NULL, '2018-01-02 01:17:12', '2018-01-02 01:17:12'),
(3, 'xyz@gmail.com', 'thu Hmong', '$2y$10$THKOpttfd28HjjZ0v/dEseuA6RetYwzZFOC7doTdiJi6yoFxj2q8q', '+65989543864', 'self_employed', NULL, 1, 1, 'washer', NULL, '2018-01-03 09:42:55', '2018-01-03 09:42:55'),
(4, 'abc@gmail.com', 'Tan Long', '$2y$10$Mvj6D4ARAp31u./KgPtDm.N6NcXCw2vd.aOmsLitao0HYk5yymCOW', '+65987890678', 'employed', NULL, 1, 0, 'washer', NULL, '2018-01-03 10:35:07', '2018-01-18 09:36:57'),
(5, 'tansowherm@gmail.com', 'SX', '$2y$10$qvvJZLOgN1jXlueAT8jOQOWF4i4/EOv8CoIk3c2iHJak8gWVxNxyq', '+6592259507', 'employed', NULL, 1, 0, 'washer', NULL, '2018-01-06 10:45:13', '2018-03-04 20:40:20'),
(6, 'washer@gmail.com', 'washer ', '$2y$10$398HfpbSaJJ2KmH4SvBk5uWGK3FHsRDJonagtvinRhleEEGmrKvna', '+65982413233', 'self_employed', NULL, 1, 0, 'washer', NULL, '2018-02-06 21:43:00', '2018-02-12 23:09:41'),
(7, 'testwasher@gmail.com', 'test full name', '$2y$10$SG1Nbvy2rdoVixUdWTPeSugHmQhpgH1xCmNPsPkeVva3PnfRwxU3e', '+65123456', 'employed', NULL, 1, 1, 'washer', NULL, '2018-03-04 18:04:31', '2018-03-04 18:04:31'),
(8, 'haha@gmail.com', 'Ngoc Hung', '$2y$10$YTDR58VvmS.jCkw7bIg0Cuv/EihLXR1fhyhCQTgW/eA/zjzrKSive', '+6512e42423', 'employed', NULL, 1, 0, 'washer', NULL, '2018-03-12 10:06:08', '2018-03-12 10:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `washrequest__washrequests`
--

CREATE TABLE `washrequest__washrequests` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'saloon_hatchback_mini_van - Saloon/Hatchback/Mini Van | mpv_suv_van - MPV / SUV / VAN type',
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `car_plate_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `car_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `car_park_lot_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user_requesting' COMMENT 'user_requesting / user_declined / user_accept_pay / user_payment_done / user_cancel_request / user_confirm_request / washer_accepted / washer_washing / washer_done ',
  `washer_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cash' COMMENT 'posb_paynow / dbs_paylah / ocbc_pay_anyone / cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `washrequest__washrequests`
--

INSERT INTO `washrequest__washrequests` (`id`, `type`, `customer_id`, `car_plate_no`, `car_color`, `street_name`, `block_no`, `level`, `car_park_lot_no`, `notes`, `status`, `washer_id`, `created_at`, `updated_at`, `payment_method`) VALUES
(1, 'saloon_hatchback_mini_van', 1, 'plate 1', 'color 1', 'street 1', 'block 1', 'level 1', 'lot 1', 'note 1', 'expired', NULL, '2018-01-02 00:22:59', '2018-01-02 00:29:01', 'cash'),
(2, 'saloon_hatchback_mini_van', 1, '1', '1', '1e', '1', '1', '1', '1234', 'expired', NULL, '2018-01-02 00:32:12', '2018-01-02 00:44:55', 'cash'),
(3, 'saloon_hatchback_mini_van', 1, '1', '2', 'ha noi', 'hung', 'hung', 'hung', 'hung', 'expired', NULL, '2018-01-02 01:24:01', '2018-01-02 01:41:18', 'cash'),
(4, 'saloon_hatchback_mini_van', 1, '1', '2', '1', '1', '1', '1', '1', 'expired', NULL, '2018-01-02 01:41:16', '2018-01-03 09:43:03', 'cash'),
(5, 'mpv_suv_van', 2, 'A 4569', 'White', 'pham hung cau giay ha noi', 'A6', '4', 'B434', 'Must done before 7PM', 'user_confirm_request', 4, '2018-01-03 10:37:07', '2018-01-03 10:38:39', 'cash'),
(6, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', '367 Loyang Rise ', '-', '-', '-', 'It’s a terrace house. ', 'user_cancel_request', NULL, '2018-01-05 15:19:19', '2018-01-05 15:20:13', 'cash'),
(7, 'saloon_hatchback_mini_van', 2, 'A 4569', 'White', 'pham hung', '31', '2', '67', 'Test notes', 'user_confirm_request', 4, '2018-01-18 09:38:54', '2018-01-18 09:40:11', 'cash'),
(8, 'saloon_hatchback_mini_van', 2, 'A 4569', 'White', 'vsvsvs', 'fbsgs', 'dnfnd', 'dhdhd', 'Dbdhdb', 'user_confirm_request', 4, '2018-01-18 09:43:38', '2018-01-18 09:44:11', 'cash'),
(9, 'mpv_suv_van', 2, 'C 1234', 'red', 'nguyen trai', '84', '63', '12', 'Note', 'user_confirm_request', 4, '2018-01-18 09:45:38', '2018-01-18 09:46:57', 'cash'),
(10, 'mpv_suv_van', 2, 'A 4569', 'White', 'brbdv', 'cdvdf', 'fbfb', 'c fb', 'Xvdv', 'user_confirm_request', 4, '2018-01-18 09:48:36', '2018-01-18 09:49:31', 'cash'),
(11, 'saloon_hatchback_mini_van', 3, 'a', 'a', 'a', 'a', 'a', 'a', '', 'expired', NULL, '2018-01-23 20:57:30', '2018-01-24 10:01:28', 'cash'),
(12, 'saloon_hatchback_mini_van', 2, 'A 4569', 'White', 'xuan thuy', '21', '12', '32', 'notes', 'user_payment_done', 4, '2018-01-24 10:02:23', '2018-02-07 17:21:54', 'cash'),
(13, 'saloon_hatchback_mini_van', 2, 'A 4569', 'White', 'pham hung', 'k', 'i', 'a', 'no', 'expired', NULL, '2018-01-24 10:05:48', '2018-01-25 13:25:38', 'cash'),
(14, 'saloon_hatchback_mini_van', 2, 'A 4569', 'White', 'pham hung', 'k', 'i', 'a', 'no', 'user_payment_done', 4, '2018-01-24 10:06:08', '2018-01-24 10:06:37', 'cash'),
(15, 'saloon_hatchback_mini_van', 3, 'a', 'r', 'a', 'a', '1', 'a', '', 'expired', NULL, '2018-01-27 07:23:44', '2018-01-28 20:09:23', 'posb_paynow'),
(16, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'a', 'a', 's', 's', '', 'expired', NULL, '2018-01-28 20:09:53', '2018-01-28 20:12:59', 'posb_paynow'),
(17, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', 'q', 'q', 'q', '', 'expired', NULL, '2018-02-04 12:18:19', '2018-02-04 23:10:31', 'ocbc_pay_anyone'),
(18, 'mpv_suv_van', 5, 'plate', 'color', 'street', 'block', 'level', 'lot', 'noted', 'expired', NULL, '2018-02-06 21:49:22', '2018-02-06 21:51:58', 'dbs_paylah'),
(19, 'mpv_suv_van', 5, 'plate 2', 'color 2', 'street 2', 'block 2', 'level 2', 'lot 2', '', 'expired', NULL, '2018-02-06 21:50:55', '2018-02-06 21:53:09', 'posb_paynow'),
(20, 'mpv_suv_van', 5, 'plate a', 'color b', 'street c', 'block d', 'level f', 'lot g', 'noted', 'user_accept_pay', 6, '2018-02-06 21:53:05', '2018-02-06 21:53:27', 'dbs_paylah'),
(21, 'mpv_suv_van', 5, 'plate 3', 'color 3', 'street 3', 'block 3', 'level 3', 'lot 3', 'Notes 3', 'user_confirm_request', 6, '2018-02-06 21:56:38', '2018-02-06 21:57:34', 'posb_paynow'),
(22, 'mpv_suv_van', 5, 'plate 4', 'color 4', 'street 4', 'block 4', 'level 4', 'lot 4', 'note', 'user_accept_pay', 6, '2018-02-06 22:11:29', '2018-02-06 22:12:30', 'posb_paynow'),
(23, 'mpv_suv_van', 5, 'plate 5', 'black', 'street 5', 'block 5', 'level 5', 'park 5', 'Noted', 'user_confirm_request', 6, '2018-02-06 22:17:36', '2018-02-06 22:18:36', 'ocbc_pay_anyone'),
(24, 'mpv_suv_van', 5, 'plate 6', 'black', 'street 6', 'block 6', 'level 6', 'park 6', 'Noted', 'user_confirm_request', 6, '2018-02-06 22:24:39', '2018-02-06 22:25:59', 'ocbc_pay_anyone'),
(25, 'saloon_hatchback_mini_van', 5, 'plate 7', 'black', 'street 7', 'block 7', 'level 7', 'park 7', 'Noted ', 'user_confirm_request', 6, '2018-02-06 22:36:30', '2018-02-06 22:38:19', 'dbs_paylah'),
(26, 'saloon_hatchback_mini_van', 5, 'plate 78', 'black', 'street 7', 'block 7', 'level 7', 'park 7', 'Noted ', 'user_declined', 6, '2018-02-06 22:39:47', '2018-02-06 22:52:07', 'dbs_paylah'),
(27, 'saloon_hatchback_mini_van', 5, 'plate 78', 'black', 'street 7', 'block 7', 'level 7', 'park 7', 'Noted ', 'user_declined', 6, '2018-02-06 22:40:48', '2018-02-06 22:51:20', 'dbs_paylah'),
(28, 'saloon_hatchback_mini_van', 5, 'plate 44', 'white', 'street 44', 'block', 'level', 'park', 'Notedsd', 'user_confirm_request', 6, '2018-02-06 22:54:14', '2018-02-06 22:55:38', 'cash'),
(29, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'a', 'a', 'a', 'a', 'A', 'expired', NULL, '2018-02-11 20:37:34', '2018-02-11 20:39:35', 'posb_paynow'),
(30, 'mpv_suv_van', 3, 'skb7876c', 'red', 's', 's', 'd', 'x', 'D', 'user_cancel_request', NULL, '2018-02-11 20:41:33', '2018-02-11 20:47:32', 'posb_paynow'),
(31, 'mpv_suv_van', 3, 'skb7876c', 'red', 's', 's', 'd', 'x', 'D', 'expired', NULL, '2018-02-11 20:47:37', '2018-02-11 20:50:32', 'posb_paynow'),
(32, 'saloon_hatchback_mini_van', 3, 'SKB7876C', 'Red', 'QWERTY ', '2', '1', '12', 'Q', 'user_confirm_request', 5, '2018-02-11 20:58:05', '2018-02-11 20:59:24', 'posb_paynow'),
(33, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '123', '1', '12', '', 'user_confirm_request', 5, '2018-03-01 07:00:18', '2018-03-01 07:01:46', 'dbs_paylah'),
(34, 'mpv_suv_van', 3, 'skb7876c', 'red', 'a', '123', '1', '345', '', 'user_confirm_request', 5, '2018-03-01 07:02:50', '2018-03-01 07:10:10', 'cash'),
(35, 'mpv_suv_van', 3, 'skb7876c', 'red', 'q', '123', '1', '234', 'Please wash my car', 'user_confirm_request', 5, '2018-03-03 07:46:19', '2018-03-03 07:52:14', 'posb_paynow'),
(36, 'mpv_suv_van', 3, 'skb7876c', 'red', 'q', '123', '1', '234', 'Please wash my car', 'expired', NULL, '2018-03-03 07:52:44', '2018-03-03 08:30:02', 'posb_paynow'),
(37, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '123', '', 'user_confirm_request', 5, '2018-03-03 07:53:59', '2018-03-03 07:58:02', 'cash'),
(38, 'mpv_suv_van', 3, 'skb7876c', 'red', 'q', '1', '1', '123', 'Q', 'expired', NULL, '2018-03-03 22:18:52', '2018-03-03 22:21:00', 'ocbc_pay_anyone'),
(39, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'Q', 'user_confirm_request', 5, '2018-03-03 22:20:18', '2018-03-03 22:21:24', 'ocbc_pay_anyone'),
(40, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'Qwe', 'user_confirm_request', 5, '2018-03-03 22:23:08', '2018-03-04 11:38:29', 'ocbc_pay_anyone'),
(41, 'mpv_suv_van', 3, 'skb7876c', 'red', 'q', '1', '1', '123', 'Qww', 'expired', NULL, '2018-03-04 11:33:52', '2018-03-04 11:36:56', 'ocbc_pay_anyone'),
(42, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '11', '', 'user_confirm_request', 5, '2018-03-04 11:39:20', '2018-03-04 11:40:49', 'dbs_paylah'),
(43, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', '', 'expired', NULL, '2018-03-04 17:30:51', '2018-03-04 17:37:08', 'posb_paynow'),
(44, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', '', 'user_confirm_request', 5, '2018-03-04 17:31:57', '2018-03-04 17:36:01', 'posb_paynow'),
(45, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', '', 'user_confirm_request', 5, '2018-03-04 19:58:22', '2018-03-04 20:00:48', 'posb_paynow'),
(46, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', '', 'user_cancel_request', NULL, '2018-03-04 19:59:35', '2018-03-04 19:59:45', 'posb_paynow'),
(47, 'saloon_hatchback_mini_van', 3, 'skkk', 'n', 'sisisj', 'hshs', 'hsnsj', 'N', '', 'user_confirm_request', 5, '2018-03-04 20:02:25', '2018-03-04 20:03:59', 'dbs_paylah'),
(48, 'saloon_hatchback_mini_van', 3, 'skkk', 'n', 'sisisj', 'hshs', 'hsnsj', 'N', '', 'user_confirm_request', 5, '2018-03-04 20:06:07', '2018-03-04 20:08:52', 'dbs_paylah'),
(49, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'wash', 'expired', NULL, '2018-03-06 20:09:52', '2018-03-06 20:38:41', 'cash'),
(50, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'nsnsnsjsjs', 'expired', NULL, '2018-03-06 20:38:38', '2018-03-06 21:25:09', 'cash'),
(51, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'nsnsnsjsjs', 'expired', NULL, '2018-03-06 21:22:24', '2018-03-06 21:25:09', 'cash'),
(52, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'jsjsjsjsjs', 'expired', NULL, '2018-03-06 21:25:07', '2018-03-06 21:57:03', 'cash'),
(53, 'saloon_hatchback_mini_van', 2, 'A 4569', 'White', 'pham hung', '32', 'A7', '12', 'must be done before 9pm', 'expired', NULL, '2018-03-06 22:10:05', '2018-03-06 22:14:12', 'cash'),
(54, 'saloon_hatchback_mini_van', 2, 'C 1234', 'red', 'pham hung', '13', 'A2', '63', 'notes', 'expired', NULL, '2018-03-06 22:15:01', '2018-03-06 22:18:22', 'cash'),
(55, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'jsjsjsjs', 'user_confirm_request', 5, '2018-03-07 20:02:26', '2018-03-07 20:25:22', 'cash'),
(56, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'hdusiw', 'user_confirm_request', 5, '2018-03-07 20:11:49', '2018-03-07 20:25:10', 'cash'),
(57, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '1', 'hdjsjss', 'user_confirm_request', 5, '2018-03-07 20:20:56', '2018-03-07 20:24:56', 'posb_paynow'),
(58, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '123', 'Q', 'user_confirm_request', 5, '2018-03-07 20:27:30', '2018-03-07 20:28:33', 'posb_paynow'),
(59, 'mpv_suv_van', 3, 'skb7876c', 'red', 'aaa', 'ds', 'hhh', 'tahba', 'Testing', 'user_confirm_request', 5, '2018-03-07 20:30:06', '2018-03-07 20:32:26', 'posb_paynow'),
(60, 'saloon_hatchback_mini_van', 3, 'skb7876c', 'red', 'q', '1', '1', '12', '', 'user_confirm_request', 5, '2018-03-13 05:53:13', '2018-03-13 05:54:35', 'dbs_paylah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_car_detail`
--
ALTER TABLE `customer_car_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer__customers`
--
ALTER TABLE `customer__customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dashboard__widgets`
--
ALTER TABLE `dashboard__widgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dashboard__widgets_user_id_foreign` (`user_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media__files`
--
ALTER TABLE `media__files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media__file_translations`
--
ALTER TABLE `media__file_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media__file_translations_file_id_locale_unique` (`file_id`,`locale`),
  ADD KEY `media__file_translations_locale_index` (`locale`);

--
-- Indexes for table `media__imageables`
--
ALTER TABLE `media__imageables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu__menuitems`
--
ALTER TABLE `menu__menuitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu__menuitems_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `menu__menuitem_translations`
--
ALTER TABLE `menu__menuitem_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu__menuitem_translations_menuitem_id_locale_unique` (`menuitem_id`,`locale`),
  ADD KEY `menu__menuitem_translations_locale_index` (`locale`);

--
-- Indexes for table `menu__menus`
--
ALTER TABLE `menu__menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu__menu_translations`
--
ALTER TABLE `menu__menu_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu__menu_translations_menu_id_locale_unique` (`menu_id`,`locale`),
  ADD KEY `menu__menu_translations_locale_index` (`locale`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify__notifies`
--
ALTER TABLE `notify__notifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page__pages`
--
ALTER TABLE `page__pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page__page_translations`
--
ALTER TABLE `page__page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page__page_translations_page_id_locale_unique` (`page_id`,`locale`),
  ADD KEY `page__page_translations_locale_index` (`locale`);

--
-- Indexes for table `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Indexes for table `rating__ratings`
--
ALTER TABLE `rating__ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporting__reportings`
--
ALTER TABLE `reporting__reportings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `setting__settings`
--
ALTER TABLE `setting__settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting__settings_name_unique` (`name`),
  ADD KEY `setting__settings_name_index` (`name`);

--
-- Indexes for table `setting__setting_translations`
--
ALTER TABLE `setting__setting_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting__setting_translations_setting_id_locale_unique` (`setting_id`,`locale`),
  ADD KEY `setting__setting_translations_locale_index` (`locale`);

--
-- Indexes for table `tag__tagged`
--
ALTER TABLE `tag__tagged`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag__tagged_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`);

--
-- Indexes for table `tag__tags`
--
ALTER TABLE `tag__tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag__tag_translations`
--
ALTER TABLE `tag__tag_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag__tag_translations_tag_id_locale_unique` (`tag_id`,`locale`),
  ADD KEY `tag__tag_translations_locale_index` (`locale`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `translation__translations`
--
ALTER TABLE `translation__translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translation__translations_key_index` (`key`);

--
-- Indexes for table `translation__translation_translations`
--
ALTER TABLE `translation__translation_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_trans_id_locale_unique` (`translation_id`,`locale`),
  ADD KEY `translation__translation_translations_locale_index` (`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_tokens_access_token_unique` (`access_token`),
  ADD KEY `user_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `washer_customer_forgot`
--
ALTER TABLE `washer_customer_forgot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `washer_customer_login`
--
ALTER TABLE `washer_customer_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `washer__washers`
--
ALTER TABLE `washer__washers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `washrequest__washrequests`
--
ALTER TABLE `washrequest__washrequests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_car_detail`
--
ALTER TABLE `customer_car_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer__customers`
--
ALTER TABLE `customer__customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dashboard__widgets`
--
ALTER TABLE `dashboard__widgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `media__files`
--
ALTER TABLE `media__files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media__file_translations`
--
ALTER TABLE `media__file_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media__imageables`
--
ALTER TABLE `media__imageables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu__menuitems`
--
ALTER TABLE `menu__menuitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu__menuitem_translations`
--
ALTER TABLE `menu__menuitem_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu__menus`
--
ALTER TABLE `menu__menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu__menu_translations`
--
ALTER TABLE `menu__menu_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `notify__notifies`
--
ALTER TABLE `notify__notifies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=395;

--
-- AUTO_INCREMENT for table `page__pages`
--
ALTER TABLE `page__pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page__page_translations`
--
ALTER TABLE `page__page_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rating__ratings`
--
ALTER TABLE `rating__ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reporting__reportings`
--
ALTER TABLE `reporting__reportings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting__settings`
--
ALTER TABLE `setting__settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting__setting_translations`
--
ALTER TABLE `setting__setting_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag__tagged`
--
ALTER TABLE `tag__tagged`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag__tags`
--
ALTER TABLE `tag__tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag__tag_translations`
--
ALTER TABLE `tag__tag_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translation__translations`
--
ALTER TABLE `translation__translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translation__translation_translations`
--
ALTER TABLE `translation__translation_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `washer_customer_forgot`
--
ALTER TABLE `washer_customer_forgot`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `washer_customer_login`
--
ALTER TABLE `washer_customer_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `washer__washers`
--
ALTER TABLE `washer__washers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `washrequest__washrequests`
--
ALTER TABLE `washrequest__washrequests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dashboard__widgets`
--
ALTER TABLE `dashboard__widgets`
  ADD CONSTRAINT `dashboard__widgets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media__file_translations`
--
ALTER TABLE `media__file_translations`
  ADD CONSTRAINT `media__file_translations_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `media__files` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu__menuitems`
--
ALTER TABLE `menu__menuitems`
  ADD CONSTRAINT `menu__menuitems_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu__menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu__menuitem_translations`
--
ALTER TABLE `menu__menuitem_translations`
  ADD CONSTRAINT `menu__menuitem_translations_menuitem_id_foreign` FOREIGN KEY (`menuitem_id`) REFERENCES `menu__menuitems` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu__menu_translations`
--
ALTER TABLE `menu__menu_translations`
  ADD CONSTRAINT `menu__menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu__menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page__page_translations`
--
ALTER TABLE `page__page_translations`
  ADD CONSTRAINT `page__page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `page__pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setting__setting_translations`
--
ALTER TABLE `setting__setting_translations`
  ADD CONSTRAINT `setting__setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `setting__settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tag__tag_translations`
--
ALTER TABLE `tag__tag_translations`
  ADD CONSTRAINT `tag__tag_translations_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag__tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `translation__translation_translations`
--
ALTER TABLE `translation__translation_translations`
  ADD CONSTRAINT `translation__translation_translations_translation_id_foreign` FOREIGN KEY (`translation_id`) REFERENCES `translation__translations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
