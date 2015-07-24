-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2015 at 03:42 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flojo`
--
CREATE DATABASE IF NOT EXISTS `flojo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `flojo`;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id_favorites` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_mess` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(140) NOT NULL,
  `url` text,
  `mess_picture` text,
  `date_created` datetime NOT NULL,
  `date_expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tags` int(11) NOT NULL,
  `tag_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_description` varchar(140) DEFAULT NULL,
  `user_picture` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `votes` tinytext NOT NULL,
  `token` varchar(80) NOT NULL,
  `token_expiry` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `user_description`, `user_picture`, `password`, `votes`, `token`, `token_expiry`, `date_created`, `date_modified`) VALUES
(1, 'wouane@gmail.com', 'wouane', NULL, '', '$2y$10$Abi/Z7yWne5adz5n7ulJiuHO6TECpXkHvfHUls2AIoX19oHBtqE/K', '', '', '0000-00-00 00:00:00', '2015-07-24 15:29:10', NULL),
(2, 'jojo@gmail.com', 'Jojo', NULL, '', '$2y$10$prNeXOxhKUcyeMwAkK682OWG74p31f568bVtvx1dWKLsQVCt1U22a', '', '', '0000-00-00 00:00:00', '2015-07-24 15:38:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id_favorites`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_mess`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tags`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id_favorites` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
