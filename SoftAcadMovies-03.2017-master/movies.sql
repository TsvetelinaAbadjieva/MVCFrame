-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 23 март 2017 в 16:56
-- Версия на сървъра: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Структура на таблица `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `interests` text,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `movies`
--

CREATE TABLE `movies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `duration` int(11) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `genres` text,
  `director` varchar(255) DEFAULT NULL,
  `writers` text,
  `cast` text,
  `rating` decimal(10,0) DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `youtube_link` text,
  `language` varchar(5) DEFAULT NULL,
  `movies_categories_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `movies_categories`
--

CREATE TABLE `movies_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `movies_categories`
--

INSERT INTO `movies_categories` (`id`, `title`, `description`) VALUES
(1, 'Movies', ''),
(2, 'Spost Events', ''),
(3, 'musicals', ''),
(4, 'Tv Series', NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `movies_images`
--

CREATE TABLE `movies_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `movies_id` int(10) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `movies_reviews`
--

CREATE TABLE `movies_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text,
  `movies_reviewscol` varchar(45) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `movies_reviews_images`
--

CREATE TABLE `movies_reviews_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `movies_reviews_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `id`) VALUES
('admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin@mail.bg', 1),
('admin2', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 7),
('admin3', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 8),
('admin4', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 9),
('userdmin5', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 10),
('admin6', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 11),
('admin7', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 12),
('admin8', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'forgotten@mail.bg', 13),
('admin9', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 14),
('admin10', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin@mail.bg', 15),
('admin11', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'forgotten@mail.bg', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies_categories`
--
ALTER TABLE `movies_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies_images`
--
ALTER TABLE `movies_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies_reviews`
--
ALTER TABLE `movies_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies_reviews_images`
--
ALTER TABLE `movies_reviews_images`
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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movies_categories`
--
ALTER TABLE `movies_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `movies_images`
--
ALTER TABLE `movies_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movies_reviews`
--
ALTER TABLE `movies_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movies_reviews_images`
--
ALTER TABLE `movies_reviews_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
