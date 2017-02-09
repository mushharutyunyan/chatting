-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 09:42 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatting`
--

-- --------------------------------------------------------

--
-- Table structure for table `actives`
--

CREATE TABLE `actives` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `actives`
--

INSERT INTO `actives` (`id`, `room_id`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(4, 4, 1, 0, '2017-02-09 15:28:47', '2017-02-09 16:36:43'),
(8, 7, 1, 1, '2017-02-09 16:33:57', '2017-02-09 16:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `room_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user_id`, `room_id`, `message`, `created_at`, `updated_at`) VALUES
(7, 1, 4, 'Hello', '2017-02-09 14:41:25', '2017-02-09 14:41:25'),
(8, 1, 4, 'Hi\n', '2017-02-09 14:56:31', '2017-02-09 14:56:31'),
(11, 5, 4, 'Hi', '2017-02-09 15:14:28', '2017-02-09 15:14:28'),
(12, 1, 7, 'Hi', '2017-02-09 16:36:50', '2017-02-09 16:36:50'),
(13, 5, 4, 'Хелло', '2017-02-09 16:38:35', '2017-02-09 16:38:35'),
(14, 5, 4, 'DROP rooms', '2017-02-09 16:40:37', '2017-02-09 16:40:37'),
(15, 5, 4, 'asas', '2017-02-09 16:40:42', '2017-02-09 16:40:42'),
(16, 5, 4, '<h1></h1>\n', '2017-02-09 16:40:55', '2017-02-09 16:40:55'),
(17, 5, 4, '<h1>asdasd</h1>', '2017-02-09 16:41:06', '2017-02-09 16:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2017_02_09_100756_create_rooms_table', 2),
('2017_02_09_191620_create_actives_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visibility` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `private_key` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `image`, `visibility`, `private`, `private_key`, `created_at`, `updated_at`) VALUES
(4, 'Room', 'c6603a3c4f46a8864a974789177674fa1.jpg', 1, 0, '', '2017-02-09 14:07:54', '2017-02-09 14:07:54'),
(5, 'room 2', 'da66b09194a26098f6507612abea21211.jpg', 2, 0, '', '2017-02-09 14:10:20', '2017-02-09 14:10:20'),
(7, 'Private', '80ce26ff125d974dca4ca7db3831a81a1.jpg', 2, 1, '4KctYE7Tlq3O9GJzRwlZrvDrmLOLBRAhCTcRntmPlGh3w6GQkRM4Mwi4jbsG', '2017-02-09 16:11:55', '2017-02-09 16:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mush', 'mush.harutyunyan@hotmail.com', '$2y$10$Y9SW8UUEOrwVgEUIaMzOW.uqwFfFfrTziag34jj2IQO2rBBt40LmC', 'pE8xZX3zm3GhZGo1fNnc43E78OLkVuAmWiTloKUiquY7EmdMie3ICxmsDcQL', '2017-02-08 15:49:07', '2017-02-09 16:36:54'),
(5, '127.0.0.1', '', '', NULL, '2017-02-09 15:14:10', '2017-02-09 15:14:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actives`
--
ALTER TABLE `actives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
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
-- AUTO_INCREMENT for table `actives`
--
ALTER TABLE `actives`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
