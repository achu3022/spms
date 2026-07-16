-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2026 at 07:18 AM
-- Server version: 8.4.7
-- PHP Version: 8.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enquiry_id` bigint UNSIGNED DEFAULT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED DEFAULT NULL,
  `activity_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `score` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_enquiry_id_foreign` (`enquiry_id`),
  KEY `activities_employee_id_foreign` (`employee_id`),
  KEY `activities_team_id_foreign` (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=383 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `enquiry_id`, `employee_id`, `team_id`, `activity_type`, `remarks`, `score`, `created_at`, `updated_at`) VALUES
(1, NULL, 9, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(2, NULL, 10, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(258, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(259, NULL, 13, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-10 01:00:00', '2026-07-10 01:00:00'),
(5, NULL, 10, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(6, NULL, 10, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(7, NULL, 10, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(8, NULL, 12, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(9, NULL, 9, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(284, NULL, 11, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(11, NULL, 10, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(12, NULL, 10, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(256, NULL, 13, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(283, NULL, 11, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(18, NULL, 10, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(19, NULL, 10, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(20, NULL, 10, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(21, NULL, 10, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(22, NULL, 10, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(23, NULL, 10, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(257, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(255, NULL, 13, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(254, NULL, 13, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(253, NULL, 13, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(252, NULL, 13, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(251, NULL, 13, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(250, NULL, 13, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(249, NULL, 13, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(36, NULL, 17, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(37, NULL, 17, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(38, NULL, 17, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(269, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(40, NULL, 17, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(41, NULL, 16, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(42, NULL, 16, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(43, NULL, 17, 5, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(44, NULL, 17, 5, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(45, NULL, 16, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(46, NULL, 16, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(47, NULL, 16, 5, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(268, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(267, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(266, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(52, NULL, 17, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(53, NULL, 17, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(54, NULL, 17, 5, 'Admission', 'Added manually by Admin', 4, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(55, NULL, 18, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(56, NULL, 18, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(57, NULL, 16, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(58, NULL, 16, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(59, NULL, 16, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(60, NULL, 16, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(265, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(62, NULL, 6, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(63, NULL, 6, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(64, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(65, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(66, NULL, 6, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(67, NULL, 6, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(68, NULL, 6, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(69, NULL, 6, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(70, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(71, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(72, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(73, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(74, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(75, NULL, 6, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(76, NULL, 6, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(77, NULL, 6, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(78, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(79, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(80, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(81, NULL, 6, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(82, NULL, 5, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(83, NULL, 5, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(84, NULL, 5, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(85, NULL, 5, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(86, NULL, 5, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(87, NULL, 5, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(88, NULL, 5, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(89, NULL, 5, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(90, NULL, 5, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(91, NULL, 5, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(92, NULL, 8, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(93, NULL, 8, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(94, NULL, 8, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(95, NULL, 8, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(96, NULL, 8, 2, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(97, NULL, 4, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(98, NULL, 4, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(282, NULL, 11, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(277, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(276, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(102, NULL, 7, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(103, NULL, 7, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(247, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(105, NULL, 21, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(106, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(107, NULL, 21, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(108, NULL, 21, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(109, NULL, 21, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(110, NULL, 12, 1, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-08 03:57:28', '2026-07-08 03:57:28'),
(111, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(112, NULL, 21, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(113, NULL, 21, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(114, NULL, 21, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(115, NULL, 21, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(116, NULL, 21, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(117, NULL, 21, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(118, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(119, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(120, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(123, NULL, 19, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(122, NULL, 23, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(124, NULL, 19, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(125, NULL, 19, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(126, NULL, 20, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(127, NULL, 20, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(128, NULL, 20, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(129, NULL, 20, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(130, NULL, 20, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(131, NULL, 20, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(132, NULL, 20, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(133, NULL, 20, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(134, NULL, 20, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(135, NULL, 20, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(136, NULL, 20, 4, 'Admission', 'Added manually by Admin', 4, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(137, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(138, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(139, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(140, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(141, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(142, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(143, NULL, 22, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(144, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(145, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(146, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(147, NULL, 22, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(148, NULL, 22, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(149, NULL, 25, 3, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(150, NULL, 25, 3, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(151, NULL, 25, 3, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(152, NULL, 25, 3, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(153, NULL, 25, 3, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(154, NULL, 25, 3, 'Walk-in', 'Added manually by Admin', 1, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(155, NULL, 25, 3, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(156, NULL, 25, 3, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(157, NULL, 36, 3, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(158, NULL, 36, 3, 'Registration', 'Added manually by Admin', 2, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(159, NULL, 36, 3, 'Walk-in', 'Added manually by Admin', 1, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(160, NULL, 36, 3, 'Registration', 'Added manually by Admin', 2, '2026-07-07 01:00:00', '2026-07-07 01:00:00'),
(161, NULL, 24, 3, 'Walk-in', 'Added manually by Admin', 1, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(162, NULL, 3, 2, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(163, NULL, 5, 2, 'Registration', 'Bulk entry: 3 Registration', 6, '2026-07-08 04:38:13', '2026-07-08 04:38:13'),
(248, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(264, NULL, 14, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(166, NULL, 27, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-08 05:33:24', '2026-07-08 05:33:24'),
(167, NULL, 36, 3, 'Registration', 'Bulk entry: 2 Registration', 4, '2026-07-08 05:38:22', '2026-07-08 05:38:22'),
(168, NULL, 25, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-08 05:40:45', '2026-07-08 05:40:45'),
(169, NULL, 25, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-08 05:41:31', '2026-07-08 05:41:31'),
(170, NULL, 27, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-08 06:02:02', '2026-07-08 06:02:02'),
(171, NULL, 21, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-08 06:35:52', '2026-07-08 06:35:52'),
(173, NULL, 8, 2, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-08 06:59:00', '2026-07-08 06:59:00'),
(246, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(245, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(177, NULL, 36, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-09 00:22:50', '2026-07-09 00:22:50'),
(178, NULL, 36, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-09 00:22:50', '2026-07-09 00:22:50'),
(179, NULL, 17, 5, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-09 03:39:30', '2026-07-09 03:39:30'),
(180, NULL, 4, 2, 'Registration', 'Bulk entry: 2 Registration', 4, '2026-07-09 03:52:11', '2026-07-09 03:52:11'),
(181, NULL, 4, 2, 'Admission', 'Bulk entry: 2 Admission', 8, '2026-07-09 03:52:11', '2026-07-09 03:52:11'),
(190, NULL, 21, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-09 07:54:10', '2026-07-09 07:54:10'),
(278, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(184, NULL, 22, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-09 04:20:01', '2026-07-09 04:20:01'),
(185, NULL, 22, 4, 'Registration', 'Bulk entry: 3 Registration', 6, '2026-07-09 04:20:01', '2026-07-09 04:20:01'),
(186, NULL, 25, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-09 04:29:14', '2026-07-09 04:29:14'),
(187, NULL, 27, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-09 04:36:24', '2026-07-09 04:36:24'),
(188, NULL, 9, 1, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-09 06:12:52', '2026-07-09 06:12:52'),
(189, NULL, 20, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-09 07:47:39', '2026-07-09 07:47:39'),
(244, NULL, 13, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(243, NULL, 13, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(193, NULL, 8, 2, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-10 00:44:38', '2026-07-10 00:44:38'),
(194, NULL, 23, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-10 03:32:26', '2026-07-10 03:32:26'),
(195, NULL, 5, 2, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-10 04:25:47', '2026-07-10 04:25:47'),
(196, NULL, 21, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-10 04:47:18', '2026-07-10 04:47:18'),
(197, NULL, 21, 4, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-10 04:47:18', '2026-07-10 04:47:18'),
(198, NULL, 10, 1, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-10 05:11:23', '2026-07-10 05:11:23'),
(199, NULL, 16, 5, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-10 06:28:49', '2026-07-10 06:28:49'),
(200, NULL, 20, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-10 07:37:20', '2026-07-10 07:37:20'),
(263, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(281, NULL, 11, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-04 01:00:00', '2026-07-04 01:00:00'),
(280, NULL, 11, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(262, NULL, 14, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(261, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(207, NULL, 25, 3, 'Walk-in', 'Bulk entry: 3 Walk-in', 3, '2026-07-11 01:57:43', '2026-07-11 01:57:43'),
(208, NULL, 25, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-11 01:57:43', '2026-07-11 01:57:43'),
(209, NULL, 25, 3, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-11 01:57:43', '2026-07-11 01:57:43'),
(210, NULL, 4, 2, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-11 01:58:47', '2026-07-11 01:58:47'),
(292, NULL, 21, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-11 09:05:13', '2026-07-11 09:05:13'),
(212, NULL, 23, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-11 03:29:51', '2026-07-11 03:29:51'),
(242, NULL, 13, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-06 01:00:00', '2026-07-06 01:00:00'),
(241, NULL, 13, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(240, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-02 01:00:00', '2026-07-02 01:00:00'),
(239, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(238, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-01 01:00:00', '2026-07-01 01:00:00'),
(260, NULL, 13, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-10 01:00:00', '2026-07-10 01:00:00'),
(270, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(271, NULL, 14, 5, 'Walk-in', 'Added manually by Admin', 1, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(272, NULL, 14, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-11 01:00:00', '2026-07-11 01:00:00'),
(273, NULL, 14, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-11 01:00:00', '2026-07-11 01:00:00'),
(274, NULL, 14, 5, 'Registration', 'Added manually by Admin', 2, '2026-07-11 01:00:00', '2026-07-11 01:00:00'),
(275, NULL, 18, 5, 'Registration', 'Bulk entry: 2 Registration', 4, '2026-07-11 04:07:20', '2026-07-11 04:07:20'),
(279, NULL, 21, 4, 'Registration', 'Added manually by Admin', 2, '2026-07-09 01:00:00', '2026-07-09 01:00:00'),
(285, NULL, 11, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(286, NULL, 11, 1, 'Admission', 'Added manually by Admin', 4, '2026-07-08 01:00:00', '2026-07-08 01:00:00'),
(287, NULL, 11, 1, 'Walk-in', 'Added manually by Admin', 1, '2026-07-11 01:00:00', '2026-07-11 01:00:00'),
(288, NULL, 11, 1, 'Registration', 'Added manually by Admin', 2, '2026-07-11 01:00:00', '2026-07-11 01:00:00'),
(289, NULL, 20, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-11 08:55:05', '2026-07-11 08:55:05'),
(290, NULL, 20, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-11 08:55:05', '2026-07-11 08:55:05'),
(291, NULL, 20, 4, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-11 08:55:05', '2026-07-11 08:55:05'),
(293, NULL, 5, 2, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-12 22:20:33', '2026-07-12 22:20:33'),
(294, NULL, 23, 4, 'Admission', 'Bulk entry: 2 Admission', 8, '2026-07-13 00:23:45', '2026-07-13 00:23:45'),
(295, NULL, 16, 5, 'Admission', 'Bulk entry: 4 Admission', 16, '2026-07-13 00:29:48', '2026-07-13 00:29:48'),
(296, NULL, 16, 5, 'Full Payment', 'Bulk entry: 1 Full Payment', 6, '2026-07-13 00:29:48', '2026-07-13 00:29:48'),
(297, NULL, 11, 1, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-13 00:33:26', '2026-07-13 00:33:26'),
(298, NULL, 5, 2, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 00:35:28', '2026-07-13 00:35:28'),
(299, NULL, 27, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-13 00:54:05', '2026-07-13 00:54:05'),
(300, NULL, 27, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-13 00:54:05', '2026-07-13 00:54:05'),
(301, NULL, 27, 3, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 00:54:05', '2026-07-13 00:54:05'),
(316, NULL, 6, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-13 01:00:00', '2026-07-13 01:00:00'),
(303, NULL, 18, 5, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 01:15:45', '2026-07-13 01:15:45'),
(304, NULL, 8, 2, 'Admission', 'Bulk entry: 2 Admission', 8, '2026-07-13 01:21:27', '2026-07-13 01:21:27'),
(305, NULL, 22, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-13 01:24:08', '2026-07-13 01:24:08'),
(306, NULL, 22, 4, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 01:24:08', '2026-07-13 01:24:08'),
(307, NULL, 11, 1, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-13 01:27:32', '2026-07-13 01:27:32'),
(308, NULL, 3, 2, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 01:29:33', '2026-07-13 01:29:33'),
(309, NULL, 12, 1, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-13 01:53:30', '2026-07-13 01:53:30'),
(310, NULL, 36, 3, 'Admission', 'Bulk entry: 2 Admission', 8, '2026-07-13 03:19:31', '2026-07-13 03:19:31'),
(311, NULL, 25, 3, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-13 03:20:43', '2026-07-13 03:20:43'),
(312, NULL, 25, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-13 03:20:43', '2026-07-13 03:20:43'),
(313, NULL, 25, 3, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 03:20:43', '2026-07-13 03:20:43'),
(314, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-11 01:00:00', '2026-07-11 01:00:00'),
(315, NULL, 21, 4, 'Walk-in', 'Added manually by Admin', 1, '2026-07-11 01:00:00', '2026-07-11 01:00:00'),
(317, NULL, 6, 2, 'Admission', 'Added manually by Admin', 4, '2026-07-13 01:00:00', '2026-07-13 01:00:00'),
(318, NULL, 25, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-13 04:02:20', '2026-07-13 04:02:20'),
(319, NULL, 10, 1, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-13 04:16:13', '2026-07-13 04:16:13'),
(320, NULL, 20, 4, 'Admission', 'Bulk entry: 2 Admission', 8, '2026-07-13 04:17:33', '2026-07-13 04:17:33'),
(321, NULL, 6, 2, 'Walk-in', 'Bulk entry: 6 Walk-in', 6, '2026-07-13 04:48:36', '2026-07-13 04:48:36'),
(322, NULL, 36, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-13 04:48:53', '2026-07-13 04:48:53'),
(323, NULL, 6, 2, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 06:30:36', '2026-07-13 06:30:36'),
(324, NULL, 5, 2, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-13 06:44:37', '2026-07-13 06:44:37'),
(325, NULL, 19, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-13 06:46:54', '2026-07-13 06:46:54'),
(326, NULL, 19, 4, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 06:46:54', '2026-07-13 06:46:54'),
(327, NULL, 36, 3, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-13 06:55:33', '2026-07-13 06:55:33'),
(328, NULL, 36, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-13 06:55:33', '2026-07-13 06:55:33'),
(329, NULL, 36, 3, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 06:55:33', '2026-07-13 06:55:33'),
(330, NULL, 17, 5, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-13 22:13:39', '2026-07-13 22:13:39'),
(331, NULL, 18, 5, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-13 22:14:21', '2026-07-13 22:14:21'),
(332, NULL, 27, 3, 'Admission', 'Bulk entry: 2 Admission', 8, '2026-07-13 23:45:58', '2026-07-13 23:45:58'),
(333, NULL, 16, 5, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-13 23:54:46', '2026-07-13 23:54:46'),
(334, NULL, 22, 4, 'Admission', 'Bulk entry: 2 Admission', 8, '2026-07-14 00:23:49', '2026-07-14 00:23:49'),
(335, NULL, 24, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 00:57:10', '2026-07-14 00:57:10'),
(336, NULL, 24, 3, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-14 00:57:10', '2026-07-14 00:57:10'),
(337, NULL, 11, 1, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-14 01:49:26', '2026-07-14 01:49:26'),
(338, NULL, 11, 1, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 01:49:26', '2026-07-14 01:49:26'),
(339, NULL, 4, 2, 'Walk-in', 'Bulk entry: 3 Walk-in', 3, '2026-07-14 04:09:13', '2026-07-14 04:09:13'),
(340, NULL, 4, 2, 'Walk-in', 'Bulk entry: 3 Walk-in', 3, '2026-07-14 04:09:14', '2026-07-14 04:09:14'),
(341, NULL, 20, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 04:29:45', '2026-07-14 04:29:45'),
(342, NULL, 12, 1, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 04:38:35', '2026-07-14 04:38:35'),
(343, NULL, 22, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-14 05:57:37', '2026-07-14 05:57:37'),
(344, NULL, 22, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 05:57:37', '2026-07-14 05:57:37'),
(345, NULL, 21, 4, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-14 06:11:29', '2026-07-14 06:11:29'),
(346, NULL, 14, 5, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 22:16:03', '2026-07-14 22:16:03'),
(347, NULL, 36, 3, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-14 22:43:14', '2026-07-14 22:43:14'),
(348, NULL, 6, 2, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 22:55:42', '2026-07-14 22:55:42'),
(349, NULL, 6, 2, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-14 22:55:42', '2026-07-14 22:55:42'),
(350, NULL, 11, 1, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-14 23:05:57', '2026-07-14 23:05:57'),
(351, NULL, 17, 5, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-14 23:33:50', '2026-07-14 23:33:50'),
(352, NULL, 13, 1, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-14 23:38:40', '2026-07-14 23:38:40'),
(353, NULL, 25, 3, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-15 00:38:12', '2026-07-15 00:38:12'),
(354, NULL, 14, 5, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-15 00:52:02', '2026-07-15 00:52:02'),
(355, NULL, 21, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 01:20:14', '2026-07-15 01:20:14'),
(356, NULL, 25, 3, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-15 01:37:44', '2026-07-15 01:37:44'),
(357, NULL, 14, 5, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-15 02:23:26', '2026-07-15 02:23:26'),
(358, NULL, 22, 4, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-15 02:24:52', '2026-07-15 02:24:52'),
(359, NULL, 24, 3, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 02:50:45', '2026-07-15 02:50:45'),
(360, NULL, 24, 3, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-15 02:50:45', '2026-07-15 02:50:45'),
(361, NULL, 12, 1, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-15 03:11:56', '2026-07-15 03:11:56'),
(362, NULL, 16, 5, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-15 03:43:48', '2026-07-15 03:43:48'),
(363, NULL, 16, 5, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 03:43:48', '2026-07-15 03:43:48'),
(364, NULL, 14, 5, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-15 03:47:24', '2026-07-15 03:47:24'),
(365, NULL, 4, 2, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-15 04:04:34', '2026-07-15 04:04:34'),
(366, NULL, 4, 2, 'Walk-in', 'Bulk entry: 3 Walk-in', 3, '2026-07-15 04:07:36', '2026-07-15 04:07:36'),
(367, NULL, 10, 1, 'Walk-in', 'Bulk entry: 2 Walk-in', 2, '2026-07-15 05:23:42', '2026-07-15 05:23:42'),
(368, NULL, 10, 1, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 05:23:42', '2026-07-15 05:23:42'),
(369, NULL, 6, 2, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 05:56:17', '2026-07-15 05:56:17'),
(370, NULL, 6, 2, 'Admission', 'Bulk entry: 1 Admission', 4, '2026-07-15 06:22:47', '2026-07-15 06:22:47'),
(371, NULL, 21, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-15 07:56:59', '2026-07-15 07:56:59'),
(372, NULL, 21, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 08:50:18', '2026-07-15 08:50:18'),
(373, NULL, 23, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-15 22:13:19', '2026-07-15 22:13:19'),
(374, NULL, 5, 2, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 23:15:04', '2026-07-15 23:15:04'),
(375, NULL, 21, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-15 23:16:52', '2026-07-15 23:16:52'),
(376, NULL, 14, 5, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-15 23:33:31', '2026-07-15 23:33:31'),
(377, NULL, 14, 5, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 23:33:31', '2026-07-15 23:33:31'),
(378, NULL, 4, 2, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 23:35:54', '2026-07-15 23:35:54'),
(379, NULL, 21, 4, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-15 23:38:00', '2026-07-15 23:38:00'),
(380, NULL, 16, 5, 'Registration', 'Bulk entry: 1 Registration', 2, '2026-07-16 00:52:17', '2026-07-16 00:52:17'),
(381, NULL, 22, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-16 00:54:01', '2026-07-16 00:54:01'),
(382, NULL, 22, 4, 'Walk-in', 'Bulk entry: 1 Walk-in', 1, '2026-07-16 00:54:01', '2026-07-16 00:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `model_type`, `model_id`, `description`, `old_values`, `new_values`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 2, 'login', 'App\\Models\\User', 2, 'Employee Sales Head HOD logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:42:23', '2026-07-01 01:42:23'),
(2, 2, 'login', 'App\\Models\\User', 2, 'Employee Sales Head HOD logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:42:23', '2026-07-01 01:42:23'),
(3, 30, 'login', 'App\\Models\\User', 30, 'Employee Test user03 logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:49:55', '2026-07-01 01:49:55'),
(4, 30, 'login', 'App\\Models\\User', 30, 'Employee Test user03 logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:49:55', '2026-07-01 01:49:55'),
(5, 22, 'logout', 'App\\Models\\User', 22, 'Employee Keerthana logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:50:28', '2026-07-01 01:50:28'),
(6, 22, 'logout', 'App\\Models\\User', 22, 'Employee Keerthana logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:50:28', '2026-07-01 01:50:28'),
(7, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:53:23', '2026-07-01 01:53:23'),
(8, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 01:53:23', '2026-07-01 01:53:23'),
(9, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 02:04:26', '2026-07-01 02:04:26'),
(10, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '2026-07-01 02:04:26', '2026-07-01 02:04:26'),
(11, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-01 10:06:14', '2026-07-01 10:06:14'),
(12, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-01 10:06:14', '2026-07-01 10:06:14'),
(13, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 11:39:26', '2026-07-03 11:39:26'),
(14, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 11:39:26', '2026-07-03 11:39:26'),
(15, 1, 'logout', 'App\\Models\\User', 1, 'Employee Super Admin logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 12:05:37', '2026-07-03 12:05:37'),
(16, 1, 'logout', 'App\\Models\\User', 1, 'Employee Super Admin logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 12:05:37', '2026-07-03 12:05:37'),
(17, 3, 'login', 'App\\Models\\User', 3, 'Employee Suhail logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 12:05:54', '2026-07-03 12:05:54'),
(18, 3, 'login', 'App\\Models\\User', 3, 'Employee Suhail logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 12:05:54', '2026-07-03 12:05:54'),
(19, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 12:30:14', '2026-07-03 12:30:14'),
(20, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-03 12:30:14', '2026-07-03 12:30:14'),
(21, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 04:46:05', '2026-07-08 04:46:05'),
(22, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 04:46:05', '2026-07-08 04:46:05'),
(23, 16, 'login', 'App\\Models\\User', 16, 'Employee Saranya logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 05:07:12', '2026-07-08 05:07:12'),
(24, 16, 'login', 'App\\Models\\User', 16, 'Employee Saranya logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 05:07:12', '2026-07-08 05:07:12'),
(25, 16, 'logout', 'App\\Models\\User', 16, 'Employee Saranya logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 05:08:04', '2026-07-08 05:08:04'),
(26, 16, 'logout', 'App\\Models\\User', 16, 'Employee Saranya logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 05:08:04', '2026-07-08 05:08:04'),
(27, 16, 'login', 'App\\Models\\User', 16, 'Employee Saranya logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 05:08:19', '2026-07-08 05:08:19'),
(28, 16, 'login', 'App\\Models\\User', 16, 'Employee Saranya logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 05:08:19', '2026-07-08 05:08:19'),
(29, 1, 'logout', 'App\\Models\\User', 1, 'Employee Super Admin logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 CrKey/1.54.250320', '2026-07-08 06:01:39', '2026-07-08 06:01:39'),
(30, 1, 'logout', 'App\\Models\\User', 1, 'Employee Super Admin logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 CrKey/1.54.250320', '2026-07-08 06:01:39', '2026-07-08 06:01:39'),
(31, 2, 'login', 'App\\Models\\User', 2, 'Employee Sales Head HOD logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 CrKey/1.54.250320', '2026-07-08 06:01:50', '2026-07-08 06:01:50'),
(32, 2, 'login', 'App\\Models\\User', 2, 'Employee Sales Head HOD logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 CrKey/1.54.250320', '2026-07-08 06:01:50', '2026-07-08 06:01:50'),
(33, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 07:24:33', '2026-07-08 07:24:33'),
(34, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-07-08 07:24:33', '2026-07-08 07:24:33'),
(35, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 08:00:01', '2026-07-10 08:00:01'),
(36, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-10 08:00:01', '2026-07-10 08:00:01'),
(37, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 11:14:28', '2026-07-11 11:14:28'),
(38, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-11 11:14:28', '2026-07-11 11:14:28'),
(39, 16, 'login', 'App\\Models\\User', 16, 'Employee Saranya logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 05:38:14', '2026-07-13 05:38:14'),
(40, 16, 'login', 'App\\Models\\User', 16, 'Employee Saranya logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 05:38:14', '2026-07-13 05:38:14'),
(41, 16, 'logout', 'App\\Models\\User', 16, 'Employee Saranya logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:47:14', '2026-07-13 11:47:14'),
(42, 16, 'logout', 'App\\Models\\User', 16, 'Employee Saranya logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:47:14', '2026-07-13 11:47:14'),
(43, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:49:01', '2026-07-13 11:49:01'),
(44, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:49:01', '2026-07-13 11:49:01'),
(45, 22, 'logout', 'App\\Models\\User', 22, 'Employee Keerthana logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:50:12', '2026-07-13 11:50:12'),
(46, 22, 'logout', 'App\\Models\\User', 22, 'Employee Keerthana logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:50:12', '2026-07-13 11:50:12'),
(47, 24, 'login', 'App\\Models\\User', 24, 'Employee Midhun P Das logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:50:53', '2026-07-13 11:50:53'),
(48, 24, 'login', 'App\\Models\\User', 24, 'Employee Midhun P Das logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-13 11:50:53', '2026-07-13 11:50:53'),
(49, 24, 'login', 'App\\Models\\User', 24, 'Employee Midhun P Das logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 04:32:18', '2026-07-14 04:32:18'),
(50, 24, 'login', 'App\\Models\\User', 24, 'Employee Midhun P Das logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 04:32:18', '2026-07-14 04:32:18'),
(51, 24, 'login', 'App\\Models\\User', 24, 'Employee Midhun P Das logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 11:54:48', '2026-07-14 11:54:48'),
(52, 24, 'login', 'App\\Models\\User', 24, 'Employee Midhun P Das logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 11:54:48', '2026-07-14 11:54:48'),
(53, 24, 'logout', 'App\\Models\\User', 24, 'Employee Midhun P Das logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 13:11:56', '2026-07-14 13:11:56'),
(54, 24, 'logout', 'App\\Models\\User', 24, 'Employee Midhun P Das logged out.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 13:11:56', '2026-07-14 13:11:56'),
(55, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 13:12:56', '2026-07-14 13:12:56'),
(56, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-14 13:12:56', '2026-07-14 13:12:56'),
(57, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-15 04:09:14', '2026-07-15 04:09:14'),
(58, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-15 04:09:14', '2026-07-15 04:09:14'),
(59, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-15 04:16:54', '2026-07-15 04:16:54'),
(60, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-15 04:16:54', '2026-07-15 04:16:54'),
(61, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 06:15:52', '2026-07-16 06:15:52'),
(62, 1, 'login', 'App\\Models\\User', 1, 'Employee Super Admin logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 06:15:52', '2026-07-16 06:15:52'),
(63, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 06:20:22', '2026-07-16 06:20:22'),
(64, 22, 'login', 'App\\Models\\User', 22, 'Employee Keerthana logged in successfully.', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-16 06:20:22', '2026-07-16 06:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_code_unique` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kochi', 'KOC', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(2, 'Trivandrum', 'TRI', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(3, 'Chennai', 'CHE', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(4, 'Bangalore', 'BAN', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(5, 'Calicut', 'CAL', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-tv_dashboard_standings', 'a:4:{s:13:\"topPerformers\";a:5:{i:0;a:10:{s:2:\"id\";i:6;s:4:\"name\";s:5:\"Veena\";s:5:\"email\";s:18:\"veena@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:20:\"activities_sum_score\";s:2:\"70\";s:16:\"employee_profile\";a:11:{s:2:\"id\";i:6;s:7:\"user_id\";i:6;s:11:\"employee_id\";s:12:\"SMEC-EMP-103\";s:5:\"photo\";s:51:\"photos/QgqUgzoPdpbVnlayePX5atPy9zXrIVkEvHjeDY6x.jpg\";s:10:\"department\";N;s:11:\"designation\";s:15:\"Sales Executive\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";N;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T11:54:22.000000Z\";}s:5:\"teams\";a:1:{i:0;a:6:{s:2:\"id\";i:2;s:4:\"name\";s:9:\"Mavericks\";s:11:\"description\";s:32:\"Sales team led by Captain Suhail\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:5:\"pivot\";a:5:{s:7:\"user_id\";i:6;s:7:\"team_id\";i:2;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}}}i:1;a:10:{s:2:\"id\";i:13;s:4:\"name\";s:6:\"Sicily\";s:5:\"email\";s:19:\"sicily@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:20:\"activities_sum_score\";s:2:\"63\";s:16:\"employee_profile\";a:11:{s:2:\"id\";i:13;s:7:\"user_id\";i:13;s:11:\"employee_id\";s:12:\"SMEC-EMP-110\";s:5:\"photo\";s:51:\"photos/gzdpqmkMTnS9BwMoSyRl0SC5sT4YicoqZ44Dmy2U.jpg\";s:10:\"department\";N;s:11:\"designation\";s:15:\"Sales Executive\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";N;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T11:54:24.000000Z\";}s:5:\"teams\";a:1:{i:0;a:6:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Powerzen\";s:11:\"description\";s:36:\"Sales team led by Captain Manikandan\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:5:\"pivot\";a:5:{s:7:\"user_id\";i:13;s:7:\"team_id\";i:1;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";}}}}i:2;a:10:{s:2:\"id\";i:21;s:4:\"name\";s:7:\"Arunima\";s:5:\"email\";s:20:\"arunima@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:50.000000Z\";s:20:\"activities_sum_score\";s:2:\"60\";s:16:\"employee_profile\";a:11:{s:2:\"id\";i:21;s:7:\"user_id\";i:21;s:11:\"employee_id\";s:12:\"SMEC-EMP-118\";s:5:\"photo\";s:51:\"photos/xFnz5MGruIkD9torxk8MpmYF4d3aMpqfgIhsyI3Z.jpg\";s:10:\"department\";N;s:11:\"designation\";s:15:\"Sales Executive\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";N;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T11:54:25.000000Z\";}s:5:\"teams\";a:1:{i:0;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:12:\"Rising Squad\";s:11:\"description\";s:30:\"Sales team led by Captain Sanu\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:5:\"pivot\";a:5:{s:7:\"user_id\";i:21;s:7:\"team_id\";i:4;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}}}}i:3;a:10:{s:2:\"id\";i:16;s:4:\"name\";s:7:\"Saranya\";s:5:\"email\";s:20:\"saranya@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-08T05:07:39.000000Z\";s:20:\"activities_sum_score\";s:2:\"47\";s:16:\"employee_profile\";a:11:{s:2:\"id\";i:16;s:7:\"user_id\";i:16;s:11:\"employee_id\";s:12:\"SMEC-EMP-113\";s:5:\"photo\";s:51:\"photos/hAVKZtapTPTXQUja9CqtQ7xSwLsYbmjfGtB9HJ8X.jpg\";s:10:\"department\";N;s:11:\"designation\";s:15:\"Sales Executive\";s:6:\"target\";i:1000;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";s:27:\"2026-07-13T05:38:14.000000Z\";s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-13T05:38:14.000000Z\";}s:5:\"teams\";a:1:{i:0;a:6:{s:2:\"id\";i:5;s:4:\"name\";s:11:\"Star Squads\";s:11:\"description\";s:32:\"Sales team led by Captain Pramod\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:5:\"pivot\";a:5:{s:7:\"user_id\";i:16;s:7:\"team_id\";i:5;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}}}}i:4;a:10:{s:2:\"id\";i:22;s:4:\"name\";s:9:\"Keerthana\";s:5:\"email\";s:22:\"keerthana@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-13T11:49:01.000000Z\";s:20:\"activities_sum_score\";s:2:\"44\";s:16:\"employee_profile\";a:11:{s:2:\"id\";i:22;s:7:\"user_id\";i:22;s:11:\"employee_id\";s:12:\"SMEC-EMP-119\";s:5:\"photo\";s:51:\"photos/WLNmcR9hTfekf54Y52t0NRnTV3sEc6n0nYfmuOu8.jpg\";s:10:\"department\";N;s:11:\"designation\";s:15:\"Sales Executive\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";s:27:\"2026-07-16T06:20:22.000000Z\";s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-16T06:20:22.000000Z\";}s:5:\"teams\";a:1:{i:0;a:6:{s:2:\"id\";i:4;s:4:\"name\";s:12:\"Rising Squad\";s:11:\"description\";s:30:\"Sales team led by Captain Sanu\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:5:\"pivot\";a:5:{s:7:\"user_id\";i:22;s:7:\"team_id\";i:4;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}}}}}s:5:\"teams\";a:5:{i:0;a:8:{s:2:\"id\";i:4;s:4:\"name\";s:12:\"Rising Squad\";s:11:\"description\";s:30:\"Sales team led by Captain Sanu\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:20:\"activities_sum_score\";s:3:\"175\";s:7:\"leaders\";a:1:{i:0;a:9:{s:2:\"id\";i:19;s:4:\"name\";s:4:\"Sanu\";s:5:\"email\";s:17:\"sanu@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:49.000000Z\";s:5:\"pivot\";a:4:{s:7:\"team_id\";i:4;s:7:\"user_id\";i:19;s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}s:16:\"employee_profile\";a:11:{s:2:\"id\";i:19;s:7:\"user_id\";i:19;s:11:\"employee_id\";s:12:\"SMEC-EMP-116\";s:5:\"photo\";s:51:\"photos/yUKmgTNYnTVG8U0FXneonUK1OYruGBXW8CLe8Snw.jpg\";s:10:\"department\";N;s:11:\"designation\";s:11:\"Team Leader\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";s:27:\"2026-06-30T23:43:45.000000Z\";s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T23:43:45.000000Z\";}}}s:5:\"users\";a:5:{i:0;a:8:{s:2:\"id\";i:19;s:4:\"name\";s:4:\"Sanu\";s:5:\"email\";s:17:\"sanu@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:49.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:4;s:7:\"user_id\";i:19;s:4:\"role\";s:6:\"leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}}i:1;a:8:{s:2:\"id\";i:20;s:4:\"name\";s:4:\"Amal\";s:5:\"email\";s:17:\"amal@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:50.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:4;s:7:\"user_id\";i:20;s:4:\"role\";s:11:\"vice_leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}}i:2;a:8:{s:2:\"id\";i:21;s:4:\"name\";s:7:\"Arunima\";s:5:\"email\";s:20:\"arunima@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:50.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:4;s:7:\"user_id\";i:21;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}}i:3;a:8:{s:2:\"id\";i:22;s:4:\"name\";s:9:\"Keerthana\";s:5:\"email\";s:22:\"keerthana@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-13T11:49:01.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:4;s:7:\"user_id\";i:22;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}}i:4;a:8:{s:2:\"id\";i:23;s:4:\"name\";s:6:\"Soumya\";s:5:\"email\";s:19:\"soumya@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:50.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:4;s:7:\"user_id\";i:23;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:56:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:56:24.000000Z\";}}}}i:1;a:8:{s:2:\"id\";i:2;s:4:\"name\";s:9:\"Mavericks\";s:11:\"description\";s:32:\"Sales team led by Captain Suhail\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:20:\"activities_sum_score\";s:3:\"170\";s:7:\"leaders\";a:1:{i:0;a:9:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Suhail\";s:5:\"email\";s:19:\"suhail@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-03T12:06:03.000000Z\";s:5:\"pivot\";a:4:{s:7:\"team_id\";i:2;s:7:\"user_id\";i:3;s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}s:16:\"employee_profile\";a:11:{s:2:\"id\";i:3;s:7:\"user_id\";i:3;s:11:\"employee_id\";s:12:\"SMEC-EMP-100\";s:5:\"photo\";s:51:\"photos/pAjb3SIgT4UvQV9RumjC51zRatzPqaeAgBYhGD9h.jpg\";s:10:\"department\";s:5:\"Sales\";s:11:\"designation\";s:11:\"Team Leader\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";s:27:\"2026-07-03T12:05:54.000000Z\";s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-03T12:05:54.000000Z\";}}}s:5:\"users\";a:6:{i:0;a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Suhail\";s:5:\"email\";s:19:\"suhail@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-03T12:06:03.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:2;s:7:\"user_id\";i:3;s:4:\"role\";s:6:\"leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}i:1;a:8:{s:2:\"id\";i:4;s:4:\"name\";s:5:\"Jewel\";s:5:\"email\";s:18:\"jewel@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:46.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:2;s:7:\"user_id\";i:4;s:4:\"role\";s:11:\"vice_leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}i:2;a:8:{s:2:\"id\";i:5;s:4:\"name\";s:7:\"Aswathy\";s:5:\"email\";s:20:\"aswathy@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:2;s:7:\"user_id\";i:5;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}i:3;a:8:{s:2:\"id\";i:6;s:4:\"name\";s:5:\"Veena\";s:5:\"email\";s:18:\"veena@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:2;s:7:\"user_id\";i:6;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}i:4;a:8:{s:2:\"id\";i:7;s:4:\"name\";s:7:\"Nandana\";s:5:\"email\";s:20:\"nandana@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:2;s:7:\"user_id\";i:7;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}i:5;a:8:{s:2:\"id\";i:8;s:4:\"name\";s:9:\"Niranjana\";s:5:\"email\";s:22:\"niranjana@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:2;s:7:\"user_id\";i:8;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}}}i:2;a:8:{s:2:\"id\";i:1;s:4:\"name\";s:8:\"Powerzen\";s:11:\"description\";s:36:\"Sales team led by Captain Manikandan\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:20:\"activities_sum_score\";s:3:\"139\";s:7:\"leaders\";a:1:{i:0;a:9:{s:2:\"id\";i:9;s:4:\"name\";s:10:\"Manikandan\";s:5:\"email\";s:23:\"manikandan@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:5:\"pivot\";a:4:{s:7:\"team_id\";i:1;s:7:\"user_id\";i:9;s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";}s:16:\"employee_profile\";a:11:{s:2:\"id\";i:9;s:7:\"user_id\";i:9;s:11:\"employee_id\";s:12:\"SMEC-EMP-106\";s:5:\"photo\";s:51:\"photos/GMq8NJVY8OtUVwqqxVuzAOQXBsavehSNLU3gGFkL.jpg\";s:10:\"department\";N;s:11:\"designation\";s:11:\"Team Leader\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";N;s:10:\"created_at\";s:27:\"2026-06-30T11:54:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T11:54:23.000000Z\";}}}s:5:\"users\";a:5:{i:0;a:8:{s:2:\"id\";i:9;s:4:\"name\";s:10:\"Manikandan\";s:5:\"email\";s:23:\"manikandan@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:1;s:7:\"user_id\";i:9;s:4:\"role\";s:6:\"leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";}}i:1;a:8:{s:2:\"id\";i:10;s:4:\"name\";s:6:\"Pranav\";s:5:\"email\";s:19:\"pranav@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:1;s:7:\"user_id\";i:10;s:4:\"role\";s:11:\"vice_leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";}}i:2;a:8:{s:2:\"id\";i:11;s:4:\"name\";s:5:\"Divya\";s:5:\"email\";s:18:\"divya@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:1;s:7:\"user_id\";i:11;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";}}i:3;a:8:{s:2:\"id\";i:12;s:4:\"name\";s:9:\"Praseetha\";s:5:\"email\";s:22:\"praseetha@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:1;s:7:\"user_id\";i:12;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";}}i:4;a:8:{s:2:\"id\";i:13;s:4:\"name\";s:6:\"Sicily\";s:5:\"email\";s:19:\"sicily@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:1;s:7:\"user_id\";i:13;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:53:59.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:53:59.000000Z\";}}}}i:3;a:8:{s:2:\"id\";i:5;s:4:\"name\";s:11:\"Star Squads\";s:11:\"description\";s:32:\"Sales team led by Captain Pramod\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:20:\"activities_sum_score\";s:3:\"121\";s:7:\"leaders\";a:1:{i:0;a:9:{s:2:\"id\";i:14;s:4:\"name\";s:6:\"Pramod\";s:5:\"email\";s:19:\"pramod@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:5:\"pivot\";a:4:{s:7:\"team_id\";i:5;s:7:\"user_id\";i:14;s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}s:16:\"employee_profile\";a:11:{s:2:\"id\";i:14;s:7:\"user_id\";i:14;s:11:\"employee_id\";s:12:\"SMEC-EMP-111\";s:5:\"photo\";s:51:\"photos/5mm6DboVgzfvXPj3LkSW3wrDvMBYN2kYhcH7xFY9.jpg\";s:10:\"department\";N;s:11:\"designation\";s:11:\"Team Leader\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";N;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T11:54:24.000000Z\";}}}s:5:\"users\";a:5:{i:0;a:8:{s:2:\"id\";i:14;s:4:\"name\";s:6:\"Pramod\";s:5:\"email\";s:19:\"pramod@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:5;s:7:\"user_id\";i:14;s:4:\"role\";s:6:\"leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}}i:1;a:8:{s:2:\"id\";i:15;s:4:\"name\";s:7:\"Anjitha\";s:5:\"email\";s:20:\"anjitha@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:49.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:5;s:7:\"user_id\";i:15;s:4:\"role\";s:11:\"vice_leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}}i:2;a:8:{s:2:\"id\";i:16;s:4:\"name\";s:7:\"Saranya\";s:5:\"email\";s:20:\"saranya@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-08T05:07:39.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:5;s:7:\"user_id\";i:16;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}}i:3;a:8:{s:2:\"id\";i:17;s:4:\"name\";s:6:\"Akhila\";s:5:\"email\";s:19:\"akhila@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:49.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:5;s:7:\"user_id\";i:17;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}}i:4;a:8:{s:2:\"id\";i:18;s:4:\"name\";s:5:\"Gouri\";s:5:\"email\";s:18:\"gouri@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:25.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:49.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:5;s:7:\"user_id\";i:18;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}}}}i:4;a:8:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Eagles\";s:11:\"description\";s:38:\"Sales team led by Captain Midhun P Das\";s:10:\"created_at\";s:27:\"2026-07-01T06:55:30.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:55:30.000000Z\";s:20:\"activities_sum_score\";s:3:\"106\";s:7:\"leaders\";a:1:{i:0;a:9:{s:2:\"id\";i:24;s:4:\"name\";s:12:\"Midhun P Das\";s:5:\"email\";s:23:\"midhunpdas@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-13T11:51:22.000000Z\";s:5:\"pivot\";a:4:{s:7:\"team_id\";i:3;s:7:\"user_id\";i:24;s:10:\"created_at\";s:27:\"2026-07-01T06:55:30.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:55:30.000000Z\";}s:16:\"employee_profile\";a:11:{s:2:\"id\";i:24;s:7:\"user_id\";i:24;s:11:\"employee_id\";s:12:\"SMEC-EMP-121\";s:5:\"photo\";s:51:\"photos/sOPzQLe3lEMkrSIr1xinxQslnbpVG7dMXm1kLtO0.jpg\";s:10:\"department\";N;s:11:\"designation\";s:11:\"Team Leader\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";s:27:\"2026-07-14T11:54:48.000000Z\";s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-14T11:54:48.000000Z\";}}}s:5:\"users\";a:5:{i:0;a:8:{s:2:\"id\";i:24;s:4:\"name\";s:12:\"Midhun P Das\";s:5:\"email\";s:23:\"midhunpdas@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-13T11:51:22.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:3;s:7:\"user_id\";i:24;s:4:\"role\";s:6:\"leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:55:30.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:55:30.000000Z\";}}i:1;a:8:{s:2:\"id\";i:25;s:4:\"name\";s:4:\"Sabi\";s:5:\"email\";s:17:\"sabi@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:26.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:51.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:3;s:7:\"user_id\";i:25;s:4:\"role\";s:11:\"vice_leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:55:30.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:55:30.000000Z\";}}i:2;a:8:{s:2:\"id\";i:26;s:4:\"name\";s:6:\"Shilja\";s:5:\"email\";s:19:\"shilja@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:27.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:51.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:3;s:7:\"user_id\";i:26;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:55:30.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:55:30.000000Z\";}}i:3;a:8:{s:2:\"id\";i:27;s:4:\"name\";s:5:\"Jeeva\";s:5:\"email\";s:18:\"jeeva@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:27.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:51.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:3;s:7:\"user_id\";i:27;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:55:30.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:55:30.000000Z\";}}i:4;a:8:{s:2:\"id\";i:36;s:4:\"name\";s:6:\"Midhun\";s:5:\"email\";s:32:\"midhun-6a47a02be0588@example.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:0;s:10:\"created_at\";s:27:\"2026-07-03T11:42:36.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-03T11:42:36.000000Z\";s:5:\"pivot\";a:5:{s:7:\"team_id\";i:3;s:7:\"user_id\";i:36;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-03T06:52:19.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-03T06:52:19.000000Z\";}}}}}s:17:\"dailyTopPerformer\";a:10:{s:2:\"id\";i:14;s:4:\"name\";s:6:\"Pramod\";s:5:\"email\";s:19:\"pramod@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:48.000000Z\";s:20:\"activities_sum_score\";s:1:\"3\";s:16:\"employee_profile\";a:11:{s:2:\"id\";i:14;s:7:\"user_id\";i:14;s:11:\"employee_id\";s:12:\"SMEC-EMP-111\";s:5:\"photo\";s:51:\"photos/5mm6DboVgzfvXPj3LkSW3wrDvMBYN2kYhcH7xFY9.jpg\";s:10:\"department\";N;s:11:\"designation\";s:11:\"Team Leader\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";N;s:10:\"created_at\";s:27:\"2026-06-30T11:54:24.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T11:54:24.000000Z\";}s:5:\"teams\";a:1:{i:0;a:6:{s:2:\"id\";i:5;s:4:\"name\";s:11:\"Star Squads\";s:11:\"description\";s:32:\"Sales team led by Captain Pramod\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:5:\"pivot\";a:5:{s:7:\"user_id\";i:14;s:7:\"team_id\";i:5;s:4:\"role\";s:6:\"leader\";s:10:\"created_at\";s:27:\"2026-07-01T06:57:23.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:57:23.000000Z\";}}}}s:19:\"allTimeTopPerformer\";a:10:{s:2:\"id\";i:6;s:4:\"name\";s:5:\"Veena\";s:5:\"email\";s:18:\"veena@smeclabs.com\";s:17:\"email_verified_at\";N;s:22:\"require_password_reset\";i:1;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T01:40:47.000000Z\";s:20:\"activities_sum_score\";s:2:\"70\";s:16:\"employee_profile\";a:11:{s:2:\"id\";i:6;s:7:\"user_id\";i:6;s:11:\"employee_id\";s:12:\"SMEC-EMP-103\";s:5:\"photo\";s:51:\"photos/QgqUgzoPdpbVnlayePX5atPy9zXrIVkEvHjeDY6x.jpg\";s:10:\"department\";N;s:11:\"designation\";s:15:\"Sales Executive\";s:6:\"target\";i:10;s:6:\"status\";s:6:\"active\";s:13:\"last_login_at\";N;s:10:\"created_at\";s:27:\"2026-06-30T11:54:22.000000Z\";s:10:\"updated_at\";s:27:\"2026-06-30T11:54:22.000000Z\";}s:5:\"teams\";a:1:{i:0;a:6:{s:2:\"id\";i:2;s:4:\"name\";s:9:\"Mavericks\";s:11:\"description\";s:32:\"Sales team led by Captain Suhail\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:5:\"pivot\";a:5:{s:7:\"user_id\";i:6;s:7:\"team_id\";i:2;s:4:\"role\";s:6:\"member\";s:10:\"created_at\";s:27:\"2026-07-01T06:54:52.000000Z\";s:10:\"updated_at\";s:27:\"2026-07-01T06:54:52.000000Z\";}}}}}', 1784186335),
('laravel-cache-admin@example.com|127.0.0.1:timer', 'i:1784182584;', 1784182584),
('laravel-cache-admin@example.com|127.0.0.1', 'i:1;', 1784182584);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_months` int NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_code_unique` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `duration_months`, `fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PG Diploma in Industrial Automation', 'PGDIA', 4, 45000.00, 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(2, 'Embedded Systems & IoT', 'EMB', 3, 35000.00, 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(3, 'Python Full Stack Development', 'PYFS', 4, 40000.00, 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(4, 'Data Science & Machine Learning', 'DSML', 5, 55000.00, 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `daily_closings`
--

DROP TABLE IF EXISTS `daily_closings`;
CREATE TABLE IF NOT EXISTS `daily_closings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `closing_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `daily_closings_user_id_date_closing_type_unique` (`user_id`,`date`,`closing_type`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_closings`
--

INSERT INTO `daily_closings` (`id`, `user_id`, `date`, `closing_type`, `count`, `created_at`, `updated_at`) VALUES
(1, 16, '2026-07-13', 'Walk-in', 67, '2026-07-13 05:41:49', '2026-07-13 09:09:54'),
(2, 16, '2026-07-13', 'Registration', 18, '2026-07-13 05:46:08', '2026-07-13 09:22:51'),
(3, 16, '2026-07-13', 'Admission', 6, '2026-07-13 05:46:08', '2026-07-13 11:46:44'),
(4, 16, '2026-07-13', 'Full Payment', 6, '2026-07-13 05:46:08', '2026-07-13 09:27:08'),
(5, 22, '2026-07-13', 'Walk-in', 10, '2026-07-13 11:49:29', '2026-07-13 11:49:29'),
(6, 22, '2026-07-13', 'Registration', 10, '2026-07-13 11:49:29', '2026-07-13 11:49:29'),
(7, 22, '2026-07-13', 'Admission', 10, '2026-07-13 11:49:29', '2026-07-13 11:49:29'),
(8, 22, '2026-07-13', 'Full Payment', 5, '2026-07-13 11:49:29', '2026-07-13 11:49:29'),
(9, 24, '2026-07-13', 'Registration', 5, '2026-07-13 11:51:56', '2026-07-13 11:51:56'),
(10, 24, '2026-07-13', 'Full Payment', 19, '2026-07-13 11:52:14', '2026-07-13 11:54:33'),
(11, 24, '2026-07-13', 'Admission', 2, '2026-07-13 11:52:44', '2026-07-13 11:52:44'),
(12, 24, '2026-07-13', 'Walk-in', 8, '2026-07-13 11:53:16', '2026-07-13 11:53:38'),
(13, 24, '2026-07-14', 'Admission', 10, '2026-07-14 04:32:36', '2026-07-14 11:56:43'),
(14, 24, '2026-07-14', 'Registration', 9, '2026-07-14 04:40:45', '2026-07-14 04:57:39'),
(15, 24, '2026-07-14', 'Walk-in', 10, '2026-07-14 04:45:56', '2026-07-14 04:45:56'),
(16, 24, '2026-07-14', 'Full Payment', 2, '2026-07-14 11:57:52', '2026-07-14 11:57:52'),
(17, 22, '2026-07-14', 'Walk-in', 35, '2026-07-14 13:13:33', '2026-07-14 13:16:54'),
(18, 22, '2026-07-14', 'Registration', 35, '2026-07-14 13:13:33', '2026-07-14 13:16:54'),
(19, 22, '2026-07-14', 'Admission', 35, '2026-07-14 13:13:33', '2026-07-14 13:16:54'),
(20, 22, '2026-07-14', 'Full Payment', 35, '2026-07-14 13:13:33', '2026-07-14 13:16:54'),
(21, 22, '2026-07-16', 'Walk-in', 5, '2026-07-16 06:29:02', '2026-07-16 06:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `state_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `districts_state_id_name_unique` (`state_id`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ernakulam', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(2, 1, 'Trivandrum', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(3, 1, 'Kozhikode', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(4, 1, 'Thrissur', '2026-06-30 11:54:21', '2026-06-30 11:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `employee_profiles`
--

DROP TABLE IF EXISTS `employee_profiles`;
CREATE TABLE IF NOT EXISTS `employee_profiles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `employee_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` int NOT NULL DEFAULT '10',
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_profiles_employee_id_unique` (`employee_id`),
  KEY `employee_profiles_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_profiles`
--

INSERT INTO `employee_profiles` (`id`, `user_id`, `employee_id`, `photo`, `department`, `designation`, `target`, `status`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'SMEC-ADMIN-01', NULL, NULL, 'System Administrator', 10, 'active', '2026-07-16 11:45:52', '2026-06-30 11:54:21', '2026-07-16 06:15:52'),
(2, 2, 'SMEC-HOD-01', NULL, NULL, 'Sales Head (HOD)', 10, 'active', '2026-07-08 11:31:50', '2026-06-30 11:54:21', '2026-07-08 06:01:50'),
(3, 3, 'SMEC-EMP-100', 'photos/pAjb3SIgT4UvQV9RumjC51zRatzPqaeAgBYhGD9h.jpg', 'Sales', 'Team Leader', 10, 'active', '2026-07-03 17:35:54', '2026-06-30 11:54:22', '2026-07-03 12:05:54'),
(4, 4, 'SMEC-EMP-101', 'photos/atkaPKMGZjZMr0I1yYXO1wL79ruFlJVCyaFWgodZ.jpg', NULL, 'Vice Team Leader', 10, 'active', NULL, '2026-06-30 11:54:22', '2026-06-30 11:54:22'),
(5, 5, 'SMEC-EMP-102', 'photos/GRxGaRQ5k3pyR05DHgyqPt7lrPJuJfArgzYZ80tb.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:22', '2026-06-30 11:54:22'),
(6, 6, 'SMEC-EMP-103', 'photos/QgqUgzoPdpbVnlayePX5atPy9zXrIVkEvHjeDY6x.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:22', '2026-06-30 11:54:22'),
(7, 7, 'SMEC-EMP-104', 'photos/ZHJ4EMwuxquVC7Vn2eCEEokl2BvU3YgOAFGKyG4B.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:22', '2026-06-30 11:54:22'),
(8, 8, 'SMEC-EMP-105', 'photos/9RMOvRz67T55X0PtOzOq1KTshSrKGp6rWLrROMSE.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:23', '2026-06-30 11:54:23'),
(9, 9, 'SMEC-EMP-106', 'photos/GMq8NJVY8OtUVwqqxVuzAOQXBsavehSNLU3gGFkL.jpg', NULL, 'Team Leader', 10, 'active', NULL, '2026-06-30 11:54:23', '2026-06-30 11:54:23'),
(10, 10, 'SMEC-EMP-107', 'photos/jvCqbDcpEfti8F2ZU38Lnfml5On662u1v2bTZVZn.jpg', NULL, 'Vice Team Leader', 10, 'active', NULL, '2026-06-30 11:54:23', '2026-06-30 11:54:23'),
(11, 11, 'SMEC-EMP-108', 'photos/2QMxWd5Wl85k3enkNK7vtJzSr0Gpt0SP9x8zq80t.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:23', '2026-06-30 11:54:23'),
(12, 12, 'SMEC-EMP-109', 'photos/2WW5kd21Rg772XUTq3sgMdpsp4tES8in71BuKtjn.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:23', '2026-06-30 11:54:23'),
(13, 13, 'SMEC-EMP-110', 'photos/gzdpqmkMTnS9BwMoSyRl0SC5sT4YicoqZ44Dmy2U.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:24', '2026-06-30 11:54:24'),
(14, 14, 'SMEC-EMP-111', 'photos/5mm6DboVgzfvXPj3LkSW3wrDvMBYN2kYhcH7xFY9.jpg', NULL, 'Team Leader', 10, 'active', NULL, '2026-06-30 11:54:24', '2026-06-30 11:54:24'),
(15, 15, 'SMEC-EMP-112', NULL, NULL, 'Vice Team Leader', 10, 'active', NULL, '2026-06-30 11:54:24', '2026-06-30 11:54:24'),
(16, 16, 'SMEC-EMP-113', 'photos/hAVKZtapTPTXQUja9CqtQ7xSwLsYbmjfGtB9HJ8X.jpg', NULL, 'Sales Executive', 1000, 'active', '2026-07-13 11:08:14', '2026-06-30 11:54:24', '2026-07-13 05:38:14'),
(17, 17, 'SMEC-EMP-114', 'photos/48uTZufogDKjIbCeLnRSvbLxjBHokoFqxGObYkgR.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:25', '2026-06-30 11:54:25'),
(18, 18, 'SMEC-EMP-115', 'photos/S6YTBAQk7JVMDrAOEcLVhghnt8u7Yv1XSu3uy3t8.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:25', '2026-06-30 11:54:25'),
(19, 19, 'SMEC-EMP-116', 'photos/yUKmgTNYnTVG8U0FXneonUK1OYruGBXW8CLe8Snw.jpg', NULL, 'Team Leader', 10, 'active', '2026-07-01 05:13:45', '2026-06-30 11:54:25', '2026-06-30 23:43:45'),
(20, 20, 'SMEC-EMP-117', 'photos/zHEqx7b8p0bfQJy3UeF9j0bhYzZ5FTb0rTOooXV9.jpg', NULL, 'Vice Team Leader', 10, 'active', NULL, '2026-06-30 11:54:25', '2026-06-30 11:54:25'),
(21, 21, 'SMEC-EMP-118', 'photos/xFnz5MGruIkD9torxk8MpmYF4d3aMpqfgIhsyI3Z.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:25', '2026-06-30 11:54:25'),
(22, 22, 'SMEC-EMP-119', 'photos/WLNmcR9hTfekf54Y52t0NRnTV3sEc6n0nYfmuOu8.jpg', NULL, 'Sales Executive', 10, 'active', '2026-07-16 11:50:22', '2026-06-30 11:54:26', '2026-07-16 06:20:22'),
(23, 23, 'SMEC-EMP-120', 'photos/v3WTbGlblJby6GAyEGwEJMKatEGUG7Rn36bqdiAT.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:26', '2026-06-30 11:54:26'),
(24, 24, 'SMEC-EMP-121', 'photos/sOPzQLe3lEMkrSIr1xinxQslnbpVG7dMXm1kLtO0.jpg', NULL, 'Team Leader', 10, 'active', '2026-07-14 17:24:48', '2026-06-30 11:54:26', '2026-07-14 11:54:48'),
(25, 25, 'SMEC-EMP-122', 'photos/xENURGlP6XYgdwmNBa0o12WYcNpW2Xib11rFKKjM.jpg', NULL, 'Vice Team Leader', 10, 'active', NULL, '2026-06-30 11:54:26', '2026-06-30 11:54:26'),
(26, 26, 'SMEC-EMP-123', 'photos/wwVdLc9IZHK557Mzc8y1hSR5XTSxUMjcCkYzaqNp.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:27', '2026-06-30 11:54:27'),
(27, 27, 'SMEC-EMP-124', 'photos/EGv1g8e4qg6zcTCeMqo3akJAQG8kKpcGkHPRbXvu.jpg', NULL, 'Sales Executive', 10, 'active', NULL, '2026-06-30 11:54:27', '2026-06-30 11:54:27'),
(28, 28, 'Test user01', 'photos/jY8d2h46kUtWa43MH0J2yYnDfjoVjppEdC9wZM0w.jpg', 'Test user01', 'Test user01', 10, 'active', NULL, '2026-07-01 00:20:43', '2026-07-01 00:20:43'),
(29, 30, 'Test user03', NULL, 'Sales', 'Test user03', 10, 'active', '2026-07-01 07:19:55', '2026-07-01 01:49:13', '2026-07-01 01:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enquiry_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` bigint UNSIGNED DEFAULT NULL,
  `state_id` bigint UNSIGNED DEFAULT NULL,
  `qualification` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint UNSIGNED DEFAULT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `lead_source_id` bigint UNSIGNED DEFAULT NULL,
  `assigned_employee_id` bigint UNSIGNED DEFAULT NULL,
  `assigned_team_id` bigint UNSIGNED DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `current_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New',
  `total_score` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `enquiries_enquiry_number_unique` (`enquiry_number`),
  UNIQUE KEY `enquiries_phone_number_unique` (`phone_number`),
  KEY `enquiries_district_id_foreign` (`district_id`),
  KEY `enquiries_state_id_foreign` (`state_id`),
  KEY `enquiries_course_id_foreign` (`course_id`),
  KEY `enquiries_branch_id_foreign` (`branch_id`),
  KEY `enquiries_lead_source_id_foreign` (`lead_source_id`),
  KEY `enquiries_assigned_employee_id_foreign` (`assigned_employee_id`),
  KEY `enquiries_assigned_team_id_foreign` (`assigned_team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

DROP TABLE IF EXISTS `follow_ups`;
CREATE TABLE IF NOT EXISTS `follow_ups` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enquiry_id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `follow_up_date` date NOT NULL,
  `follow_up_time` time DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `next_follow_up_date` date DEFAULT NULL,
  `next_follow_up_time` time DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follow_ups_enquiry_id_foreign` (`enquiry_id`),
  KEY `follow_ups_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard_archives`
--

DROP TABLE IF EXISTS `leaderboard_archives`;
CREATE TABLE IF NOT EXISTS `leaderboard_archives` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `month` int NOT NULL,
  `year` int NOT NULL,
  `archive_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int NOT NULL,
  `rank` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_archive_entry` (`month`,`year`,`archive_type`,`entity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_sources`
--

DROP TABLE IF EXISTS `lead_sources`;
CREATE TABLE IF NOT EXISTS `lead_sources` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_sources`
--

INSERT INTO `lead_sources` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Google Ads', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(2, 'Instagram Ads', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(3, 'Direct Walk-in', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(4, 'Student Reference', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(5, 'Website Contact Form', 'active', '2026-06-30 11:54:21', '2026-06-30 11:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_30_160821_create_permission_tables', 1),
(5, '2026_06_30_161000_create_branches_table', 1),
(6, '2026_06_30_161001_create_courses_table', 1),
(7, '2026_06_30_161002_create_lead_sources_table', 1),
(8, '2026_06_30_161003_create_states_and_districts_tables', 1),
(9, '2026_06_30_161004_create_teams_table', 1),
(10, '2026_06_30_161005_create_employee_profiles_table', 1),
(11, '2026_06_30_161006_create_team_members_table', 1),
(12, '2026_06_30_161007_create_enquiries_table', 1),
(13, '2026_06_30_161008_create_activities_table', 1),
(14, '2026_06_30_161009_create_follow_ups_table', 1),
(15, '2026_06_30_161010_create_payments_table', 1),
(16, '2026_06_30_161011_create_settings_table', 1),
(17, '2026_06_30_161012_create_audit_logs_table', 1),
(18, '2026_06_30_161013_create_leaderboard_archives_table', 1),
(19, '2026_07_01_045956_create_daily_closings_table', 2),
(20, '2026_07_01_051332_make_enquiry_id_nullable_in_activities_table', 3),
(21, '2026_07_01_065551_add_require_password_reset_to_users_table', 4),
(22, '2026_07_01_065559_drop_unnecessary_columns_from_employee_profiles_table', 4),
(23, '2026_07_08_103421_add_target_to_employee_profiles_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 30),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 10),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 25),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 21),
(5, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 23),
(5, 'App\\Models\\User', 26),
(5, 'App\\Models\\User', 27),
(5, 'App\\Models\\User', 28),
(5, 'App\\Models\\User', 29);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enquiry_id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `admission_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `scholarship` decimal(12,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `payment_mode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_enquiry_id_foreign` (`enquiry_id`),
  KEY `payments_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(2, 'Sales Head (HOD)', 'web', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(3, 'Team Leader', 'web', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(4, 'Vice Team Leader', 'web', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(5, 'Sales Executive', 'web', '2026-06-30 11:54:21', '2026-06-30 11:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('POQNaeAFDQXvOMsqDSBiQVZnWGcEugZpdqjuJ06J', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJGYnlhRVJ1RkxkdlpFZU5YS2UzRWZFMkNYYVA5cGQ2Z3Awc1paNGpSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC93ZWxjb21lLWxlYWd1ZSIsInJvdXRlIjoid2VsY29tZS5sZWFndWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MjJ9', 1784089372),
('mwHkzNwMivjLfzFOnXIbABkNIqQh0qzai5ACWfS0', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJEamlTMjRqZkV3SXdqZ3NlVFlJZXFXcjN2cTBtd3NQRFBFTVM1S3dhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC90dlwvZGF0YT9fdD0xNzg0MTg2MzI5MzM0Jmxhc3RfYWN0aXZpdHlfaWQ9MzgyIiwicm91dGUiOiJ0di5kYXRhIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIyLCJ0dl9hdXRoZW50aWNhdGVkX2RhdGUiOiIyMDI2LTA3LTE2In0=', 1784186334),
('CskyPrspQODqWUT6iCCRopkuDTqebLThxEyAfJSz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJDOWo4Mjd1VHNkdHlRU2VvQkpHbERQSXdTdGY4QW9VbGw5ZlpUQkpkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInR2X2F1dGhlbnRpY2F0ZWRfZGF0ZSI6IjIwMjYtMDctMTYiLCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1784186137),
('JZyl7MzZo5yEUgW0DXL0jgiHveqPm7pf7sBo0KKd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJNTGRSbm4xZWx4ZTQzRVRPUHpLcFY0NGc4VWdRcGJ5UmdrWVVYWXdmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJ0dl9hdXRoZW50aWNhdGVkX2RhdGUiOiIyMDI2LTA3LTE1In0=', 1784091048),
('iqbluxIltahxG2Hv3NL9SOIgpTmTzZUsv3mKbU4Q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJlZ240TW1kY2JMaThuV3BacXpteTluTndFakd0VVdOeU9QaXRxeUE2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1784182277);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'walk_in_score', '1', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(2, 'registration_score', '2', '2026-06-30 11:54:21', '2026-06-30 23:59:43'),
(3, 'admission_score', '4', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(4, 'payment_score', '6', '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(5, 'brand_color_primary', '#058a6f', '2026-06-30 11:54:21', '2026-07-08 05:10:06'),
(6, 'brand_color_secondary', '#08d8e7', '2026-06-30 11:54:21', '2026-07-15 04:18:27'),
(7, 'brand_color_accent', '#e5e811', '2026-06-30 11:54:21', '2026-07-08 05:10:06'),
(8, 'logo', 'branding/oUtvA26rPzna4qN9gEXHc1ELU2LboXeQnIYq2fnv.webp', '2026-07-01 00:01:27', '2026-07-08 04:53:34'),
(9, 'team_1_target', '1000', '2026-07-08 05:03:54', '2026-07-08 05:03:54'),
(10, 'tv_dashboard_password', '196723', '2026-07-15 04:09:41', '2026-07-15 04:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `states_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kerala', '2026-06-30 11:54:21', '2026-06-30 11:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Powerzen', 'Sales team led by Captain Manikandan', '2026-07-01 06:53:59', '2026-07-01 06:53:59'),
(2, 'Mavericks', 'Sales team led by Captain Suhail', '2026-07-01 06:54:52', '2026-07-01 06:54:52'),
(3, 'Eagles', 'Sales team led by Captain Midhun P Das', '2026-07-01 06:55:30', '2026-07-01 06:55:30'),
(4, 'Rising Squad', 'Sales team led by Captain Sanu', '2026-07-01 06:56:24', '2026-07-01 06:56:24'),
(5, 'Star Squads', 'Sales team led by Captain Pramod', '2026-07-01 06:57:23', '2026-07-01 06:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE IF NOT EXISTS `team_members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `team_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_members_user_id_unique` (`user_id`),
  KEY `team_members_team_id_foreign` (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 'leader', '2026-07-01 06:53:59', '2026-07-01 06:53:59'),
(2, 1, 10, 'vice_leader', '2026-07-01 06:53:59', '2026-07-01 06:53:59'),
(3, 1, 11, 'member', '2026-07-01 06:53:59', '2026-07-01 06:53:59'),
(4, 1, 12, 'member', '2026-07-01 06:53:59', '2026-07-01 06:53:59'),
(5, 1, 13, 'member', '2026-07-01 06:53:59', '2026-07-01 06:53:59'),
(6, 2, 3, 'leader', '2026-07-01 06:54:52', '2026-07-01 06:54:52'),
(7, 2, 4, 'vice_leader', '2026-07-01 06:54:52', '2026-07-01 06:54:52'),
(8, 2, 5, 'member', '2026-07-01 06:54:52', '2026-07-01 06:54:52'),
(9, 2, 6, 'member', '2026-07-01 06:54:52', '2026-07-01 06:54:52'),
(10, 2, 7, 'member', '2026-07-01 06:54:52', '2026-07-01 06:54:52'),
(11, 2, 8, 'member', '2026-07-01 06:54:52', '2026-07-01 06:54:52'),
(12, 3, 24, 'leader', '2026-07-01 06:55:30', '2026-07-01 06:55:30'),
(13, 3, 25, 'vice_leader', '2026-07-01 06:55:30', '2026-07-01 06:55:30'),
(14, 3, 26, 'member', '2026-07-01 06:55:30', '2026-07-01 06:55:30'),
(15, 3, 27, 'member', '2026-07-01 06:55:30', '2026-07-01 06:55:30'),
(16, 4, 19, 'leader', '2026-07-01 06:56:24', '2026-07-01 06:56:24'),
(17, 4, 20, 'vice_leader', '2026-07-01 06:56:24', '2026-07-01 06:56:24'),
(18, 4, 21, 'member', '2026-07-01 06:56:24', '2026-07-01 06:56:24'),
(19, 4, 22, 'member', '2026-07-01 06:56:24', '2026-07-01 06:56:24'),
(20, 4, 23, 'member', '2026-07-01 06:56:24', '2026-07-01 06:56:24'),
(21, 5, 14, 'leader', '2026-07-01 06:57:23', '2026-07-01 06:57:23'),
(22, 5, 15, 'vice_leader', '2026-07-01 06:57:23', '2026-07-01 06:57:23'),
(23, 5, 16, 'member', '2026-07-01 06:57:23', '2026-07-01 06:57:23'),
(24, 5, 17, 'member', '2026-07-01 06:57:23', '2026-07-01 06:57:23'),
(25, 5, 18, 'member', '2026-07-01 06:57:23', '2026-07-01 06:57:23'),
(30, 3, 36, 'member', '2026-07-03 06:52:19', '2026-07-03 06:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `require_password_reset` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `require_password_reset`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@smeclabs.com', NULL, '$2y$12$fsMfiLedomge6Ud9c9yRK.R4zA/p.8G1swwykxfRwjEPpomJL3PK.', 0, NULL, '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(2, 'Sales Head HOD', 'hod@smeclabs.com', NULL, '$2y$12$0Fq7QB8htF1wY8kWeRnJzulP8LSTjyrddvhhvKpbRvWnBSfpXg7Sy', 0, NULL, '2026-06-30 11:54:21', '2026-06-30 11:54:21'),
(3, 'Suhail', 'suhail@smeclabs.com', NULL, '$2y$12$n95na3JZoFEhZ/S9eqtrLe8V4.syd0Zpt7V8FTbNQtj01m8CPvYUS', 0, NULL, '2026-06-30 11:54:22', '2026-07-03 12:06:03'),
(4, 'Jewel', 'jewel@smeclabs.com', NULL, '$2y$12$y3sfjmvd09D6.TR7mKM7uO7I4EwLKQ.d2GC1Sk7K6QGuD2fhufebO', 1, NULL, '2026-06-30 11:54:22', '2026-07-01 01:40:46'),
(5, 'Aswathy', 'aswathy@smeclabs.com', NULL, '$2y$12$WKHlPt.aC0H4yiMLNQR0wexuoT7RKSwFGF3L3FhOAyTmASJkPhoyW', 1, NULL, '2026-06-30 11:54:22', '2026-07-01 01:40:47'),
(6, 'Veena', 'veena@smeclabs.com', NULL, '$2y$12$cjoD68GwgpJEImQ9Ew31v.GCcsqKFFqyTEjX29rM4qMkOPNejIub2', 1, NULL, '2026-06-30 11:54:22', '2026-07-01 01:40:47'),
(7, 'Nandana', 'nandana@smeclabs.com', NULL, '$2y$12$DGu19x.PNR/q0DC2ny8EHeblEAnTMmyeGRCmLUjAVWxv/0tBkizT6', 1, NULL, '2026-06-30 11:54:22', '2026-07-01 01:40:47'),
(8, 'Niranjana', 'niranjana@smeclabs.com', NULL, '$2y$12$uTqILS39880BjR19y5C7.OPV7oLCO20P688Mh/FxXd6qn2dH9PuPa', 1, NULL, '2026-06-30 11:54:23', '2026-07-01 01:40:47'),
(9, 'Manikandan', 'manikandan@smeclabs.com', NULL, '$2y$12$vYPw.8WsHZc6bUpUc7Ld0OTXF2q8cxZxUyHNLtqJYRLsHpphAqiy.', 1, NULL, '2026-06-30 11:54:23', '2026-07-01 01:40:47'),
(10, 'Pranav', 'pranav@smeclabs.com', NULL, '$2y$12$ORQPShn4ZMMRASZhjAJYPOf2Kr.qDnucDWjBYWICswFTyQvVhbE6m', 1, NULL, '2026-06-30 11:54:23', '2026-07-01 01:40:48'),
(11, 'Divya', 'divya@smeclabs.com', NULL, '$2y$12$FcZAr9RAhRckau1n1pdGfu8cfZV0/45/chZLxugWEXgqXM3kO780q', 1, NULL, '2026-06-30 11:54:23', '2026-07-01 01:40:48'),
(12, 'Praseetha', 'praseetha@smeclabs.com', NULL, '$2y$12$q2a2bU362n8WNjDrwqDMze4k9g1uku0gD4yHZSFdeoS0L1Gz9dAEq', 1, NULL, '2026-06-30 11:54:23', '2026-07-01 01:40:48'),
(13, 'Sicily', 'sicily@smeclabs.com', NULL, '$2y$12$pasyGQk/u8odisctOxYCyu5DMXXcp.q6cSk2qdRnIu6VSHWJNAv8.', 1, NULL, '2026-06-30 11:54:24', '2026-07-01 01:40:48'),
(14, 'Pramod', 'pramod@smeclabs.com', NULL, '$2y$12$6/gJE2QR74hgKwfvKw8ZP.nysZvXjUCjPkndyMdCBYamOG2tGU56m', 1, NULL, '2026-06-30 11:54:24', '2026-07-01 01:40:48'),
(15, 'Anjitha', 'anjitha@smeclabs.com', NULL, '$2y$12$05MMjxC1BdJnA4129o0yV.VA4QDJMzhlSNb9aPnNexYjVCbuB77AS', 1, NULL, '2026-06-30 11:54:24', '2026-07-01 01:40:49'),
(16, 'Saranya', 'saranya@smeclabs.com', NULL, '$2y$12$p3v.pOophsa1kFmBBB8fROXxf9dxDncC7nsZMJiYhsvm0Gi/IGVMq', 0, NULL, '2026-06-30 11:54:24', '2026-07-08 05:07:39'),
(17, 'Akhila', 'akhila@smeclabs.com', NULL, '$2y$12$Pw1rQRwJW9jd0FD1eFt0Du53s.SHnOEk0q3nBGor/WNjchce8dmzu', 1, NULL, '2026-06-30 11:54:25', '2026-07-01 01:40:49'),
(18, 'Gouri', 'gouri@smeclabs.com', NULL, '$2y$12$wRCtlV626OHcztKmy1ZRKO09aOO0t9wuuuIxKcsj0iVnrce.zT99u', 1, NULL, '2026-06-30 11:54:25', '2026-07-01 01:40:49'),
(19, 'Sanu', 'sanu@smeclabs.com', NULL, '$2y$12$LVbwnlHOOWGxLNTpSsBtPO7TNX1fXajmkbkt1nf0PXDJj7QWL.C.i', 1, NULL, '2026-06-30 11:54:25', '2026-07-01 01:40:49'),
(20, 'Amal', 'amal@smeclabs.com', NULL, '$2y$12$pOaOjmZa95dHTqUjX.JEgO8YBM9ghvVvHcymKeayXbszMmavuhA/C', 1, NULL, '2026-06-30 11:54:25', '2026-07-01 01:40:50'),
(21, 'Arunima', 'arunima@smeclabs.com', NULL, '$2y$12$fmvhg0pw5Ts5c3XtycW45OpHIJXEPtpho2Ut.CD/8FVA/C7uiQHKK', 1, NULL, '2026-06-30 11:54:25', '2026-07-01 01:40:50'),
(22, 'Keerthana', 'keerthana@smeclabs.com', NULL, '$2y$12$WGHaS5HfZTrLRCUMWcVLJu02aixsdMsxPYlDbYSZ36hTShG7H9Hfq', 0, NULL, '2026-06-30 11:54:26', '2026-07-13 11:49:01'),
(23, 'Soumya', 'soumya@smeclabs.com', NULL, '$2y$12$dB7hkNktBfGVdJrsoIrMx.1NNZbzR4sKDM18nac78uQdrXsx9LswK', 1, NULL, '2026-06-30 11:54:26', '2026-07-01 01:40:50'),
(24, 'Midhun P Das', 'midhunpdas@smeclabs.com', NULL, '$2y$12$WGHaS5HfZTrLRCUMWcVLJu02aixsdMsxPYlDbYSZ36hTShG7H9Hfq', 0, NULL, '2026-06-30 11:54:26', '2026-07-13 11:51:22'),
(25, 'Sabi', 'sabi@smeclabs.com', NULL, '$2y$12$Loj3DKTXpqpe1u5Ahh4FNe/ttN0UReIO2aUSY/8aGryE2.4qPIld.', 1, NULL, '2026-06-30 11:54:26', '2026-07-01 01:40:51'),
(26, 'Shilja', 'shilja@smeclabs.com', NULL, '$2y$12$uIpHVId7s8HrR39MsZHdTuTUVCNScvlJUJsZZgYnGWoEoS9J4NEd2', 1, NULL, '2026-06-30 11:54:27', '2026-07-01 01:40:51'),
(27, 'Jeeva', 'jeeva@smeclabs.com', NULL, '$2y$12$B0I7q22ZGbdWhrMaqsnFxeONhB1u6.dkmDgm0NfcYIzn3eD4QoABe', 1, NULL, '2026-06-30 11:54:27', '2026-07-01 01:40:51'),
(28, 'Test user01', 'test01@smeclabs.com', NULL, '$2y$12$SJ/38Ij01OM.cNQyPX8ZjuGlFSTZIBKFugyFhaEQzkt.XMGYeU6xe', 1, NULL, '2026-07-01 00:20:42', '2026-07-01 01:40:51'),
(29, 'Test user02', 'testuser2@smeclabs.com', NULL, '$2y$12$J6OIt124NifrKTFdsz2GteJ.IIcbebbjcfkapGCoJqLVvID93Xqy2', 0, NULL, '2026-07-01 01:45:06', '2026-07-01 01:45:06'),
(30, 'Test user03', 'testuser3@smeclabs.com', NULL, '$2y$12$J8Qp1S/GATQ0Y2LDYwwpg.PYLEYK1qNlQkDpqogT9BPFG8s20JOka', 0, NULL, '2026-07-01 01:49:13', '2026-07-01 01:49:13'),
(31, 'PRANAVU K S', 'pranavu.k.s-6a47a02a2c61a@example.com', NULL, '$2y$12$QqDhYv7nMe4sO9b.GUVW9OGe59pceuZkHiRVWxoDQV8M/dOEc6Dwy', 0, NULL, '2026-07-03 11:42:34', '2026-07-03 11:42:34'),
(32, 'DIVYA SREE', 'divya.sree-6a47a02a7a728@example.com', NULL, '$2y$12$Bddp71x3VRHMr/6fjdmOw.8YOUs/AQkltLasi6wLsrej19525d3W6', 0, NULL, '2026-07-03 11:42:34', '2026-07-03 11:42:34'),
(33, 'SISILY', 'sisily-6a47a02ac9f52@example.com', NULL, '$2y$12$yd7SHux6/0h/wdPB0/fjbe.W54vn.Zk5ZVSuReJCoO16/Sxl8Kzni', 0, NULL, '2026-07-03 11:42:35', '2026-07-03 11:42:35'),
(34, 'GOWRI', 'gowri-6a47a02b3ad36@example.com', NULL, '$2y$12$vrUFLtJacFHqw9J3mW0RZe1whERaCIxrspgNFp0Cii/4A49Xoza12', 0, NULL, '2026-07-03 11:42:35', '2026-07-03 11:42:35'),
(35, 'Chaithanya', 'chaithanya-6a47a02b8c6ff@example.com', NULL, '$2y$12$J8heMrTrmAdKBaQPUgXqYeXXwp6lLiH4J.wRbqYCjIZgJSDm.lh1y', 0, NULL, '2026-07-03 11:42:35', '2026-07-03 11:42:35'),
(36, 'Midhun', 'midhun-6a47a02be0588@example.com', NULL, '$2y$12$3zDQ3BcP.e87dx.wprZsCe3mlTcSR.0kYUnBTsyfIgZPwX47wCk1C', 0, NULL, '2026-07-03 11:42:36', '2026-07-03 11:42:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
