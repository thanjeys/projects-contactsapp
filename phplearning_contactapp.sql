-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 09:23 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phplearning_contactapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `contact_no`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Dhanya', 9840220233, '', '2021-10-12 06:31:42', '2021-10-12 06:31:42'),
(2, 'sss', 234234, '', '2021-10-12 06:57:23', '2021-10-12 06:57:23'),
(5, 'Thananjeyan', 9840098400, 'thanjeys@gmail.com', '2021-10-12 07:31:30', '2021-10-12 07:31:30'),
(6, 'Thananjeyan', 9840220223, 'thanjeys@gmail.com', '2021-10-18 07:04:29', '2021-10-18 07:04:29'),
(7, 'than jey', 98402202232, '', '2021-10-18 07:04:36', '2021-10-18 07:04:36'),
(8, 'Thananjeyan', 98400984001, '', '2021-10-18 07:04:51', '2021-10-18 07:04:51'),
(9, 'suresh', 9840220244, 'thanjeys@gmail.com', '2021-10-18 07:05:09', '2021-10-18 07:05:09'),
(10, 'ss', 98400984002, '', '2021-10-18 07:18:37', '2021-10-18 07:18:37'),
(12, 'Ramu', 9845254, '', '2021-10-18 07:19:06', '2021-10-18 07:19:06'),
(13, 'Ramesh', 25874123, '', '2021-10-18 07:19:13', '2021-10-18 07:19:13'),
(14, 'Ramani', 123456789, '', '2021-10-18 07:19:22', '2021-10-18 07:19:22'),
(17, 'dhanyass', 12548782551, 'test@gamil.com', '2021-10-18 07:20:04', '2021-10-18 12:53:40'),
(18, 'prakash', 877655254154, '', '2021-10-18 07:20:16', '2021-10-18 07:20:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_no` (`contact_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
