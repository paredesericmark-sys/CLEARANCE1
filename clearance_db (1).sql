-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 12:32 PM
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
-- Database: `clearance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role`, `profile_photo`) VALUES
(1, 'Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_members`
--

CREATE TABLE `class_members` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_requests`
--

CREATE TABLE `class_requests` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Requesting',
  `result` varchar(50) DEFAULT '',
  `comment` text DEFAULT NULL,
  `date_signed` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_requests`
--

INSERT INTO `class_requests` (`id`, `class_id`, `student_id`, `subject`, `status`, `result`, `comment`, `date_signed`, `created_at`) VALUES
(1, 1, 1, 'S A A D', 'Requesting', '', '', NULL, '2026-04-07 03:03:11'),
(2, 2, 4, 'S I P', 'Reviewed', 'Passed', 'KULANG KA QUIZ', '2026-04-07', '2026-04-07 03:10:08'),
(3, 3, 1, 'S I P', 'Reviewed', 'Incomplete', 'KULANG KA QUIZ', '2026-04-07', '2026-04-07 05:58:38'),
(4, 4, 1, 'SECURITY ESSENTIAL', 'Reviewed', 'Passed', 'CONGRATS', '2026-04-07', '2026-04-07 06:02:28'),
(5, 7, 16, 'DATABASE', 'Reviewed', 'Incomplete', 'SOBO', '2026-04-07', '2026-04-07 06:23:05'),
(6, 5, 16, 'LIFE OF RIZAL', 'Reviewed', 'Passed', 'NICE ONE', '2026-04-07', '2026-04-07 06:23:36'),
(7, 6, 16, 'NETWORKING1', 'Reviewed', 'Passed', 'BALIW', '2026-04-07', '2026-04-07 06:23:59'),
(8, 8, 16, 'H C I', 'Reviewed', 'Passed', 'SS', '2026-04-07', '2026-04-07 06:27:46'),
(9, 9, 16, 'S I P', 'Reviewed', 'Passed', 'TARA', '2026-04-07', '2026-04-07 06:29:54'),
(10, 10, 16, 'ARDUINO', 'Reviewed', 'Passed', 'NICE', '2026-04-07', '2026-04-07 06:31:05'),
(11, 11, 16, 'I A S', 'Requesting', '', '', NULL, '2026-04-07 06:32:41'),
(12, 5, 17, 'LIFE OF RIZAL', 'Reviewed', 'Passed', 'tnga', '2026-04-07', '2026-04-07 07:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_classes`
--

CREATE TABLE `teacher_classes` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `class_code` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_classes`
--

INSERT INTO `teacher_classes` (`id`, `teacher_id`, `subject`, `course`, `class_code`, `created_at`) VALUES
(1, 2, 'S A A D', 'BSIT 3', 'jq34xcw', '2026-04-07 02:30:30'),
(2, 2, 'S I P', 'BSIT 1', '4z3rwjc', '2026-04-07 03:05:34'),
(3, 5, 'S I P', 'BSIT 3', 'covnrcv', '2026-04-07 05:58:02'),
(4, 6, 'SECURITY ESSENTIAL', 'BSIT 3', 'aj70w4v', '2026-04-07 06:02:09'),
(5, 15, 'LIFE OF RIZAL', 'BSIT 3', 'y1ga167', '2026-04-07 06:20:44'),
(6, 14, 'NETWORKING1', 'BSIT 3', 'szu2rt9', '2026-04-07 06:21:38'),
(7, 13, 'DATABASE', 'BSIT 3', '9yh0jjf', '2026-04-07 06:22:33'),
(8, 12, 'H C I', 'BSIT 3', 'o3givec', '2026-04-07 06:26:29'),
(9, 11, 'S I P', 'BSIT 3', 'zn6f73y', '2026-04-07 06:29:20'),
(10, 10, 'ARDUINO', 'BSIT 3', 'nst9xeq', '2026-04-07 06:30:42'),
(11, 9, 'I A S', 'BSIT 3', '5objfmk', '2026-04-07 06:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('student','teacher') DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `password`, `role`, `course`, `created_at`, `profile_photo`) VALUES
(7, 'Donalyn', 'Tocmo', 'Donalyn@spist.edu.ph', '09661608976', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:12:41', NULL),
(8, 'Dennis', 'Santos', 'Dennis@gmail.com', '09058431033', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:13:07', NULL),
(9, 'Angelo', 'Villanueva', 'Angelo@gmail.com', '09058431033', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:13:53', NULL),
(10, 'Angel', 'Bernese', 'Angel@gmail.com', '09058431033', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:14:25', NULL),
(11, 'Mikaella', 'Almeron', 'Mikaella@gmail.com', '09661608976', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:15:26', NULL),
(12, 'Allete', 'Faller', 'Allete@gmail.com', '09661608976', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:16:25', NULL),
(13, 'Raymart', 'Faller', 'Raymart@gmail.com', '09661608976', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:16:59', 'user_13_1775556215.jpg'),
(14, 'Kenji', 'Uy', 'Kenji@gmail.com', '09661608976', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:17:21', NULL),
(15, 'Gel', 'Belingo', 'Gel@gmail.com', '09058431033', '25d55ad283aa400af464c76d713c07ad', 'teacher', NULL, '2026-04-07 06:18:11', NULL),
(16, 'GIAN BENEDICT', 'ESIO', 'gian@gmail.com', '09661608976', '25f9e794323b453885f5181f1b624d0b', 'student', 'BSIT 3', '2026-04-07 06:19:29', 'user_16_1775555879.jpg'),
(17, 'Gerald', 'Mamay', 'Gerald@gmail.com', '09661608976', '25d55ad283aa400af464c76d713c07ad', 'student', 'BSIT 3', '2026-04-07 07:05:35', 'user_17_1775556245.jpg'),
(18, 'carl', 'balog', 'carljonathan012@gmail.com', '09602097975', 'c30e77cf88ac5d2ae031588c94566471', 'student', 'BSIT 3', '2026-04-07 08:27:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_members`
--
ALTER TABLE `class_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_requests`
--
ALTER TABLE `class_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_code` (`class_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class_members`
--
ALTER TABLE `class_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_requests`
--
ALTER TABLE `class_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
