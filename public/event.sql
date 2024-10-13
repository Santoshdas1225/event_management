-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2024 at 06:39 PM
-- Server version: 8.4.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `age` bigint NOT NULL,
  `id_proof_type` varchar(100) NOT NULL,
  `id_proof_no` text NOT NULL,
  `ticket_type` varchar(60) NOT NULL,
  `ticket_price` int NOT NULL,
  `payment_id` text NOT NULL,
  `user_id` int NOT NULL,
  `is_paid` int NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `event_id`, `customer_name`, `age`, `id_proof_type`, `id_proof_no`, `ticket_type`, `ticket_price`, `payment_id`, `user_id`, `is_paid`, `updated_at`, `created_at`) VALUES
(20, 3, 'Santosh', 26, 'Pan Card', 'CQAPD8825A', 'general', 500, '04718268', 1, 1, '2024-10-09 21:20:47', '2024-10-09 21:20:41'),
(21, 3, 'Ram', 28, 'Aadhar Card', '58645486658658', 'premium', 800, '30673458', 1, 1, '2024-10-12 14:48:35', '2024-10-12 14:48:20'),
(23, 3, 'vikad', 85, 'Aadhar Card', '4648586546845684', 'general', 500, '88068234', 1, 0, '2024-10-12 14:50:38', '2024-10-12 14:50:30'),
(24, 3, 'MAMALI', 25, 'Passport', '845548685648465864', 'general', 500, '43225126', 1, 1, '2024-10-12 14:52:05', '2024-10-12 14:51:59'),
(44, 3, 'Rajib', 26, 'Pan Card', '6516565165', 'general', 500, '07470544', 2, 1, '2024-10-13 13:30:48', '2024-10-13 13:30:39'),
(45, 7, 'Ram', 56, 'Pan Card', '1654194898848', 'general', 600, '07648653', 4, 0, '2024-10-13 17:37:08', '2024-10-13 17:37:08'),
(46, 9, 'cdasa', 848, 'Pan Card', '51541541', 'premium', 1000, '98968388', 4, 0, '2024-10-13 17:39:45', '2024-10-13 17:39:45'),
(47, 8, 'dxgcfh', 45, 'Pan Card', '45654654', 'premium', 600, '08330829', 4, 0, '2024-10-13 17:43:14', '2024-10-13 17:43:14'),
(48, 5, 'cdwa', 15, 'Pan Card', '4154154', 'premium', 1500, '25202406', 4, 0, '2024-10-13 17:44:04', '2024-10-13 17:44:04'),
(49, 5, 'dcscd', 23, 'Pan Card', '489541648', 'general', 600, '27386974', 4, 1, '2024-10-13 17:48:28', '2024-10-13 17:47:23'),
(50, 8, 'Kanha', 26, 'Voter ID', 'bbibi', 'general', 300, '34487743', 4, 1, '2024-10-13 17:58:37', '2024-10-13 17:57:28'),
(51, 4, 'GAlua', 45, 'Pan Card', 'ghujn478659119', 'premium', 900, '76950457', 4, 1, '2024-10-13 18:03:00', '2024-10-13 18:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mail_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `contact_no` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `whatsapp_no` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'USER',
  `referred_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_enable` tinyint(1) DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_notification_click` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mail_id`, `password`, `contact_no`, `whatsapp_no`, `user_type`, `referred_by`, `is_enable`, `photo`, `last_notification_click`, `created_at`, `updated_at`) VALUES
(1, 'Santosh das', 'dtdm1225@gmail.com', 'eyJpdiI6IlB3aDNzWmVRSjBWczc5WXZNaGNYOWc9PSIsInZhbHVlIjoiemFEQzgxWDRPZ0JZb29DTTZPckt6dz09IiwibWFjIjoiZmVjZjU4YmY1Y2VkMWFjM2RjOWYwODAxM2RjOTgzNjI4OWEyZWU0ZDVlNGVlMzM5YjFiNmZjMWY4MGNmODYxYiIsInRhZyI6IiJ9', '9658826406', '9658826406', 'USER', NULL, 1, 'https://lh3.googleusercontent.com/a/ACg8ocIEkRnJNuq27nm8SNnbjuE_vtYD8N51J_QITEYBeOwiykJZGfgi=s96-c', '2024-10-12 22:43:39', '2024-10-07 17:38:09', '2024-10-13 16:19:31'),
(2, 'Santosh Kumar Das', 'sdas32071@gmail.com', 'eyJpdiI6ImtDV2NiSlREZ2xEaWdUaEUvbFBWL3c9PSIsInZhbHVlIjoiQjR6R0ZPdlVHbWdmbXpGWE9zMXVZUT09IiwibWFjIjoiZDJjZTk5ZTRmYzI1ZjI5ZDRhN2YyNDBjZWUyNjA0ZTQ1OWE0ZGNlMDA3Y2E4YjI2OTg5YjAwNDE4M2Y0ZjIyOCIsInRhZyI6IiJ9', '', NULL, 'admin', NULL, 1, 'https://lh3.googleusercontent.com/a/ACg8ocIy-QcMBXyVNZRN3a-DsxMNKo0uASku_Cu4Hpc5ntSX2VI0CkIETg=s96-c', '2024-10-13 13:31:14', '2024-10-13 00:19:32', '2024-10-13 13:31:14'),
(4, 'NITESH BEHERA', 'niteshbehera010@gmail.com', 'eyJpdiI6InM3a0U2bFhWbnVKbkFOQXN0eXRKYXc9PSIsInZhbHVlIjoiZGtrc0RLL05ORldOTW5TcE9sQWRldz09IiwibWFjIjoiZDUzMWRlNmU1YTIzZmI3M2JhOWQwNTVkMDRhYmIzZGM2YjYyNzlmYmUyYzUyZjgwNmExOGQwODMwYzQ1YjZhMSIsInRhZyI6IiJ9', '9937379010', '9937379010', 'USER', NULL, 1, 'https://lh3.googleusercontent.com/a/ACg8ocJQpzeniWhRNmrPtpJN9jXnwx-Bum6bQaQAHVzfxqmSBdRHXdOk=s96-c', '2024-10-13 18:04:35', '2024-10-13 16:28:27', '2024-10-13 18:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `eventfeedbacks`
--

CREATE TABLE `eventfeedbacks` (
  `id` int NOT NULL,
  `event_name` text NOT NULL,
  `event_id` int NOT NULL,
  `is_attend` text,
  `likelyAttend` text,
  `likelyRecommendFriend` text,
  `likeMost` text,
  `likeLeast` text,
  `overall` text,
  `location` text,
  `events` text,
  `coordinators` text,
  `eventsPrice` text,
  `suggestion` text,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventfeedbacks`
--

INSERT INTO `eventfeedbacks` (`id`, `event_name`, `event_id`, `is_attend`, `likelyAttend`, `likelyRecommendFriend`, `likeMost`, `likeLeast`, `overall`, `location`, `events`, `coordinators`, `eventsPrice`, `suggestion`, `updated_at`, `created_at`) VALUES
(1, 'Summer program', 3, 'no', '2', '2', 'dvsvfrfgvgrfvrfgfbvfbegvfbetgvbttbefg', 'dvsvfrfgvgrfvrfgfbvfbegvfbetgvbttbefg', 'Very Satisfied', 'Very Satisfied', 'Very Satisfied', 'Very Satisfied', 'Very Satisfied', 'dvsvfrfgvgrfvrfgfbvfbegvfbetgvbttbefg', '2024-10-13 12:11:33', '2024-10-13 12:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `event_name` text NOT NULL,
  `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` text NOT NULL,
  `duration` int NOT NULL,
  `description` text NOT NULL,
  `photo` text NOT NULL,
  `total_tickets` int NOT NULL,
  `premium_tickets` int NOT NULL,
  `general_tickets` int NOT NULL,
  `free_tickets` int NOT NULL DEFAULT '0',
  `premium_price` int NOT NULL,
  `general_price` int NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_name`, `location`, `date`, `duration`, `description`, `photo`, `total_tickets`, `premium_tickets`, `general_tickets`, `free_tickets`, `premium_price`, `general_price`, `updated_at`, `created_at`) VALUES
(1, 1, 'Winter Event', 'Bhubaneswar', '2024-12-29T06:04', 3, 'An event description is a piece of text that provides essential information about an event to help people decide whether to attend. It should be concise and informative, and should include the 5 W\'s (who, what, when, where, and why).', 'photos/1728415196.jpg', 100, 40, 60, 0, 1000, 400, '2024-10-09 00:54:52', '2024-10-08 13:02:25'),
(3, 1, 'Summer program', 'Bhadrak', '2024-11-03T15:51', 2, 'At Prokerala, we are devoted to Astrology and we passionately promote Astrology. That\'s why we offer a forever free Astrology API plan, the most basic plan designed for beginners, students and anyone who is just exploring the prospective of offering Astrology as a service. The free plan also lets your try our API before buying.', 'photos/1728469339.jpg', 350, 100, 200, 0, 800, 500, '2024-10-09 15:52:19', '2024-10-09 15:52:19'),
(4, 4, 'Corporate Event', 'Mumbai', '2024-11-30T16:30', 1, 'Event photography is the professional art of snapping high-quality images during a wide variety of important occasions, from personal events like weddings or birthday parties to large public gatherings like corporate events, galas, award ceremonies and music festivals.', 'photos/1728817537.jpg', 500, 150, 300, 50, 900, 500, '2024-10-13 16:35:37', '2024-10-13 16:35:37'),
(5, 4, 'Event 3', 'Cuttack', '2024-10-17T16:36', 2, 'Event photography is the professional art of snapping high-quality images during a wide variety of important occasions, from personal events like weddings or birthday parties to large public gatherings like corporate events, galas, award ceremonies and music festivals.', 'photos/1728817637.jpg', 500, 150, 200, 150, 1500, 600, '2024-10-13 16:37:17', '2024-10-13 16:37:17'),
(6, 4, 'College Event', 'Bhubaneswar', '2024-10-19T16:38', 1, 'A college fest, short for college festival, is a lively and diverse event that encompasses a wide range of activities such as cultural performances, competitions, workshops event, exhibitions, and more.', 'photos/1728817757.jpg', 1000, 400, 300, 300, 2000, 1000, '2024-10-13 16:39:17', '2024-10-13 16:39:17'),
(7, 4, 'harbalife Nutrition lunch event', 'Cuttack', '2024-10-30T09:39', 5, 'A college fest, short for college festival, is a lively and diverse event that encompasses a wide range of activities such as cultural performances, competitions, workshops event, exhibitions, and more.', 'photos/1728817825.jpg', 1000, 300, 600, 100, 900, 600, '2024-10-13 16:40:25', '2024-10-13 16:40:25'),
(8, 4, 'FOREST EVENT', 'Bhubaneswar', '2024-10-24T09:41', 4, 'A college fest, short for college festival, is a lively and diverse event that encompasses a wide range of activities such as cultural performances, competitions, workshops event, exhibitions, and more.A college fest, short for college festival, is a lively and diverse event that encompasses a wide range of activities such as cultural performances, competitions, workshops event, exhibitions, and more.', 'photos/1728817913.jpg', 500, 100, 200, 200, 600, 300, '2024-10-13 16:41:53', '2024-10-13 16:41:53'),
(9, 4, 'SAMSUNG MOBILE LUNCH', 'KOLKATA', '2024-12-20T07:42', 3, 'A college fest, short for college festival, is a lively and diverse event that encompasses a wide range of activities such as cultural performances, competitions, workshops event, exhibitions, and more.A college fest, short for college festival, is a lively and diverse event that encompasses a wide range of activities such as cultural performances, competitions, workshops event, exhibitions, and more.', 'photos/1728817979.jpg', 600, 80, 200, 320, 1000, 300, '2024-10-13 16:42:59', '2024-10-13 16:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` text NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `feedback` text NOT NULL,
  `feedback_type` varchar(100) NOT NULL DEFAULT 'general',
  `event_id` int DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `user_id`, `feedback`, `feedback_type`, `event_id`, `updated_at`, `created_at`) VALUES
(1, 'Abhi', 'abhi12345@gmail.com', 1, 'redtcfyvgubhijvcfgbhjkm;', 'general', NULL, '2024-10-12 12:33:28', '2024-10-12 12:33:28'),
(2, 'sanu', 'sdas32071@gmail.com', NULL, 'KNJJKEDFGVExdfghkjlhchgjk;o', 'general', NULL, '2024-10-12 12:34:17', '2024-10-12 12:34:17'),
(3, 'Santosh Kumar Das', 'sdas32071@gmail.com', 4, 'It is a best website for event management', 'general', NULL, '2024-10-13 16:52:12', '2024-10-13 16:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint NOT NULL,
  `event_id` bigint NOT NULL,
  `payment_id` bigint DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `remark` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `event_id`, `payment_id`, `user_id`, `remark`, `updated_at`, `created_at`) VALUES
(1, 3, NULL, 1, 'Your booking for event  is confirmed.', '2024-10-12 14:49:45', '2024-10-12 14:49:45'),
(2, 3, NULL, 1, 'Your booking for event  is confirmed.', '2024-10-12 14:50:38', '2024-10-12 14:50:38'),
(3, 3, 43225126, 1, 'Your booking for event  is confirmed.', '2024-10-12 14:53:12', '2024-10-12 14:53:12'),
(4, 1, 67240213, 1, 'Your booking for event  is confirmed.', '2024-10-12 15:42:47', '2024-10-12 15:42:47'),
(5, 3, 63508443, 1, 'Your booking for event  is confirmed.', '2024-10-12 16:04:30', '2024-10-12 16:04:30'),
(6, 1, 91027483, 2, 'Your booking for event  is confirmed.', '2024-10-13 00:35:23', '2024-10-13 00:35:23'),
(7, 3, 17297790, 2, 'Your booking for event  is confirmed.', '2024-10-13 12:43:10', '2024-10-13 12:43:10'),
(8, 1, 58115574, 2, 'Your booking for event  is confirmed.', '2024-10-13 12:53:25', '2024-10-13 12:53:25'),
(9, 1, 49286727, 2, 'Your booking for event  is confirmed.', '2024-10-13 12:59:08', '2024-10-13 12:59:08'),
(10, 1, 51074644, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:02:12', '2024-10-13 13:02:12'),
(11, 1, 51074644, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:03:52', '2024-10-13 13:03:52'),
(12, 1, 51074644, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:04:10', '2024-10-13 13:04:10'),
(13, 1, 51074644, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:05:57', '2024-10-13 13:05:57'),
(14, 1, 51074644, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:06:17', '2024-10-13 13:06:17'),
(15, 1, 51074644, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:06:46', '2024-10-13 13:06:46'),
(16, 1, 51074644, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:07:01', '2024-10-13 13:07:01'),
(17, 1, 16861888, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:07:26', '2024-10-13 13:07:26'),
(18, 1, 16861888, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:08:07', '2024-10-13 13:08:07'),
(19, 1, 33985354, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:09:26', '2024-10-13 13:09:26'),
(20, 1, 33985354, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:11:29', '2024-10-13 13:11:29'),
(21, 1, 33985354, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:13:06', '2024-10-13 13:13:06'),
(22, 1, 33985354, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:13:21', '2024-10-13 13:13:21'),
(23, 1, 41190766, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:14:05', '2024-10-13 13:14:05'),
(24, 1, 1245422, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:16:56', '2024-10-13 13:16:56'),
(25, 1, 1245422, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:17:06', '2024-10-13 13:17:06'),
(26, 1, 1245422, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:17:47', '2024-10-13 13:17:47'),
(27, 1, 1245422, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:18:15', '2024-10-13 13:18:15'),
(28, 1, 1245422, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:18:22', '2024-10-13 13:18:22'),
(29, 1, 76369872, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:22:14', '2024-10-13 13:22:14'),
(30, 1, 2449793, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:27:19', '2024-10-13 13:27:19'),
(31, 3, 7470544, 2, 'Your booking for event  is confirmed.', '2024-10-13 13:30:48', '2024-10-13 13:30:48'),
(32, 5, 27386974, 4, 'Your booking for event  is confirmed.', '2024-10-13 17:48:28', '2024-10-13 17:48:28'),
(33, 8, 34487743, 4, 'Your booking for event  is confirmed.', '2024-10-13 17:58:37', '2024-10-13 17:58:37'),
(34, 4, 76950457, 4, 'Your booking for event  is confirmed.', '2024-10-13 18:03:00', '2024-10-13 18:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `payment_id` bigint NOT NULL,
  `event_id` bigint NOT NULL,
  `total_amount` bigint NOT NULL,
  `user_id` int NOT NULL,
  `ticket_type` varchar(60) NOT NULL,
  `person` int NOT NULL,
  `is_paid` int NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `event_id`, `total_amount`, `user_id`, `ticket_type`, `person`, `is_paid`, `updated_at`, `created_at`) VALUES
(9, 4718268, 3, 590, 1, 'general', 1, 1, '2024-10-09 21:20:47', '2024-10-09 21:20:41'),
(10, 30673458, 3, 1888, 1, 'premium', 2, 0, '2024-10-12 14:48:35', '2024-10-12 14:48:20'),
(11, 88068234, 3, 590, 1, 'general', 1, 1, '2024-10-12 14:50:38', '2024-10-12 14:50:30'),
(12, 43225126, 3, 590, 1, 'general', 1, 1, '2024-10-12 14:52:05', '2024-10-12 14:51:59'),
(13, 67240213, 1, 472, 1, 'general', 1, 1, '2024-10-12 15:42:47', '2024-10-12 15:42:39'),
(14, 63508443, 3, 590, 1, 'general', 1, 1, '2024-10-12 16:04:30', '2024-10-12 16:04:23'),
(15, 91027483, 1, 0, 2, 'free', 1, 1, '2024-10-13 00:35:23', '2024-10-13 00:35:15'),
(16, 17297790, 3, 1180, 2, 'general', 2, 1, '2024-10-13 12:43:10', '2024-10-13 12:43:03'),
(17, 58115574, 1, 944, 2, 'general', 2, 1, '2024-10-13 12:53:25', '2024-10-13 12:53:16'),
(27, 7648653, 7, 708, 4, 'general', 1, 0, '2024-10-13 17:37:08', '2024-10-13 17:37:08'),
(28, 98968388, 9, 1180, 4, 'premium', 1, 0, '2024-10-13 17:39:45', '2024-10-13 17:39:45'),
(29, 8330829, 8, 708, 4, 'premium', 1, 0, '2024-10-13 17:43:14', '2024-10-13 17:43:14'),
(30, 25202406, 5, 1770, 4, 'premium', 1, 0, '2024-10-13 17:44:04', '2024-10-13 17:44:04'),
(31, 27386974, 5, 708, 4, 'general', 1, 1, '2024-10-13 17:48:28', '2024-10-13 17:47:23'),
(32, 34487743, 8, 354, 4, 'general', 1, 1, '2024-10-13 17:58:37', '2024-10-13 17:57:28'),
(33, 76950457, 4, 1062, 4, 'premium', 1, 1, '2024-10-13 18:03:00', '2024-10-13 18:02:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `i1` (`mail_id`) USING BTREE;

--
-- Indexes for table `eventfeedbacks`
--
ALTER TABLE `eventfeedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eventfeedbacks`
--
ALTER TABLE `eventfeedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
