-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2020 at 02:26 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `messagelist`
--

CREATE TABLE `messagelist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messagelist`
--

INSERT INTO `messagelist` (`id`, `user_id`, `message_id`, `to_id`, `from_id`) VALUES
(11, 58, 39, 58, 58),
(12, 58, 40, 65, 58),
(13, 58, 48, 68, 58),
(14, 58, 49, 59, 58);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `created`, `modified`) VALUES
(1, 'tesdf12313132', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'tests', '2020-07-09 00:00:00', '0000-00-00 00:00:00'),
(3, 'test1231231', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '', '2020-07-24 03:30:12', '2020-07-24 03:30:12'),
(10, '', '2020-07-24 03:31:16', '2020-07-24 03:31:16'),
(11, '', '2020-07-24 03:34:30', '2020-07-24 03:34:30'),
(12, '', '2020-07-24 03:37:14', '2020-07-24 03:37:14'),
(13, '', '2020-07-24 03:38:23', '2020-07-24 03:38:23'),
(14, '', '2020-07-24 03:41:01', '2020-07-24 03:41:01'),
(15, '', '2020-07-24 03:45:43', '2020-07-24 03:45:43'),
(16, '', '2020-07-24 03:47:12', '2020-07-24 03:47:12'),
(17, '', '2020-07-24 03:48:23', '2020-07-24 03:48:23'),
(18, '', '2020-07-24 03:56:28', '2020-07-24 03:56:28'),
(19, '', '2020-07-24 03:57:29', '2020-07-24 03:57:29'),
(20, '', '2020-07-24 03:58:32', '2020-07-24 03:58:32'),
(21, '', '2020-07-24 03:59:21', '2020-07-24 03:59:21'),
(22, 'asda', '2020-07-24 04:04:18', '2020-07-24 04:04:18'),
(23, 'asdaasdd', '2020-07-24 04:09:47', '2020-07-24 04:09:47'),
(24, 'sxxx', '2020-07-24 04:11:05', '2020-07-24 04:11:05'),
(25, 'asds', '2020-07-24 04:11:50', '2020-07-24 04:11:50'),
(26, 'asdsd', '2020-07-24 04:13:13', '2020-07-24 04:13:13'),
(27, 'asda', '2020-07-24 04:13:43', '2020-07-24 04:13:43'),
(28, 'asss', '2020-07-24 04:14:01', '2020-07-24 04:14:01'),
(29, 'asss', '2020-07-24 04:14:25', '2020-07-24 04:14:25'),
(30, 'aaasd', '2020-07-24 04:15:03', '2020-07-24 04:15:03'),
(31, 'asds', '2020-07-24 04:15:36', '2020-07-24 04:15:36'),
(32, 'sdfds', '2020-07-24 04:16:07', '2020-07-24 04:16:07'),
(33, 'jjk', '2020-07-24 04:24:50', '2020-07-24 04:24:50'),
(34, '', '2020-07-24 04:25:57', '2020-07-24 04:25:57'),
(35, '', '2020-07-24 04:26:25', '2020-07-24 04:26:25'),
(36, 'john', '2020-07-24 04:28:23', '2020-07-24 04:28:23'),
(37, 'lo', '2020-07-24 05:04:08', '2020-07-24 05:04:08'),
(38, 'mlo', '2020-07-24 05:05:15', '2020-07-24 05:05:15'),
(39, 'asdaasdd', '2020-07-24 10:54:12', '2020-07-24 10:54:12'),
(40, 'asdaasdd', '2020-07-24 10:54:17', '2020-07-24 10:54:17'),
(41, 'sads', '2020-07-24 11:26:44', '2020-07-24 11:26:44'),
(42, 'sads', '2020-07-24 11:29:12', '2020-07-24 11:29:12'),
(43, '', '2020-07-24 11:29:12', '2020-07-24 11:29:12'),
(44, '', '2020-07-24 11:37:37', '2020-07-24 11:37:37'),
(45, 'dsfd', '2020-07-24 11:41:46', '2020-07-24 11:41:46'),
(46, 'asds', '2020-07-24 11:42:08', '2020-07-24 11:42:08'),
(47, 'resdf', '2020-07-24 11:45:33', '2020-07-24 11:45:33'),
(48, 'asdssasd', '2020-07-24 12:07:43', '2020-07-24 12:07:43'),
(49, 'asdssasdsads', '2020-07-24 12:08:09', '2020-07-24 12:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `hubby` text DEFAULT NULL,
  `last_login_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_ip` varchar(20) NOT NULL,
  `modified_ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hubby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(57, 'jpags.me', 'test123@test.com', '10c1b59ea6239eca0378ae906243c4ab549624b3', NULL, NULL, NULL, NULL, '2020-07-22 06:19:03', '2020-07-21 13:56:18', '2020-07-22 06:19:03', '', ''),
(58, 'test123', 'test1@test.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', 'Desert.jpg', '2', '2019-08-03', 'For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.zxcxz', '2020-07-23 03:14:18', '2020-07-21 14:11:34', '2020-07-24 05:03:53', '', '::1'),
(59, 'jpags', 'jpags@test.com', '10c1b59ea6239eca0378ae906243c4ab549624b3', NULL, NULL, NULL, NULL, '2020-07-22 10:57:04', '2020-07-22 03:42:42', '2020-07-22 10:57:04', '', ''),
(64, 'ilog', 'test1@test1.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2020-07-22 04:37:31', '2020-07-22 04:37:31', '', ''),
(65, 'jpags', 'j@test.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2020-07-22 04:40:35', '2020-07-22 04:40:35', '', ''),
(66, 'test123', 'test@test.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', NULL, '0', '2020-07-04', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2020-07-22 02:26:19', '2020-07-22 04:52:23', '2020-07-22 02:34:43', '', '::1'),
(67, 'test123', 'test@1test.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2020-07-22 04:54:47', '2020-07-22 04:54:47', '', ''),
(68, 'kol', 'test11@test.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2020-07-22 04:55:48', '2020-07-22 04:55:48', '', ''),
(69, 'jpags.me1', 'test121@test.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', NULL, NULL, NULL, NULL, '2020-07-22 10:57:38', '2020-07-22 04:58:04', '2020-07-22 10:57:38', '', ''),
(72, '', '', '', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2020-07-22 05:39:26', '2020-07-22 05:39:26', '', ''),
(73, 'jpags.me1', 'te1st@test.com', 'e9f3f98c81270c55a6ee378f5e83e92dd3fe37e6', NULL, NULL, NULL, NULL, '2020-07-22 06:21:30', '2020-07-22 06:20:00', '2020-07-22 06:21:30', '::1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messagelist`
--
ALTER TABLE `messagelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messagelist`
--
ALTER TABLE `messagelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
