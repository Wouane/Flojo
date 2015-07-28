-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2015 at 09:15 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_mess`, `title`, `description`, `url`, `mess_picture`, `date_created`, `date_expiry`) VALUES
(1, '', 'SALUT ', NULL, NULL, '2015-07-27 14:05:04', '2015-07-27 14:05:04'),
(2, '', 'SALUT ', NULL, NULL, '2015-07-27 14:08:12', '2015-07-27 14:08:12'),
(3, '', 'SALUT ', NULL, NULL, '2015-07-27 14:16:41', '2015-07-27 14:16:41'),
(4, '', 'SALUT ', NULL, NULL, '2015-07-27 14:17:17', '2015-07-27 14:17:17'),
(5, '', 'https://www.google.fr/search?q=toto&ie=utf-8&oe=utf-8&gws_rd=cr&ei=xj62Vc-ONYe7UYzBluAB', NULL, NULL, '2015-07-27 16:23:51', '2015-07-27 16:23:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `user_description`, `user_picture`, `password`, `votes`, `token`, `token_expiry`, `date_created`, `date_modified`) VALUES
(1, 'wouane@gmail.com', 'wouane', NULL, '', '$2y$10$Abi/Z7yWne5adz5n7ulJiuHO6TECpXkHvfHUls2AIoX19oHBtqE/K', '', '$2y$10$HIa4nb5MrdlkvczmnlMRVu7zF1u/cfFl5bbEeX/6eZhJwAgW5K6OK', '2015-07-28 15:20:21', '2015-07-24 15:29:10', '2015-07-27 15:20:21'),
(2, 'jojo@gmail.com', 'Jojo', NULL, '', '$2y$10$prNeXOxhKUcyeMwAkK682OWG74p31f568bVtvx1dWKLsQVCt1U22a', '', '', '0000-00-00 00:00:00', '2015-07-24 15:38:00', NULL),
(3, 'tristan@gmail.com', 'tristan', NULL, '', '$2y$10$U2FBjqKsC9fKZ7jH0Tr4Du/pPjcn7AvdSqADKPVY5bqpOLEJWnxB2', '', '', '0000-00-00 00:00:00', '2015-07-24 16:39:32', NULL),
(4, 'Papa@gmail.com', 'papa', NULL, '', '$2y$10$vkRMHArkl9IhnTu4WpiTSut/BjAQkeoh09zMa/dNQXSHPkMIb2XXW', '', '', '0000-00-00 00:00:00', '2015-07-24 16:58:12', NULL),
(5, 'Coucou@gmail.com', 'coucou', NULL, '', '$2y$10$Mw5WIXLaYjz8i1ZImHJf7e7SJeDMCnH0WjpcWF3PCFYLVPpA44IS2', '', '$2y$10$ckJ0xQyXrxxN77bsIZ4j7Objc7Ryn37pC3DVQ/cx4G7vCOL/cx.GK', '2015-07-28 14:56:48', '2015-07-27 14:56:02', '2015-07-27 14:56:48'),
(6, 'poupou@gmail.com', 'poupou', NULL, '', '$2y$10$OuzqH1OwiVtRp8JMXFO9QOYKW5cx.vy6qkbD03XWKazCDph0wqRVy', '', '$2y$10$e4ehmN6ArYMbaj/7uwJo5OI9g.M6rFGRZH1j5AjvNJagsRNoBPYXe', '2015-07-28 15:14:41', '2015-07-27 15:10:53', '2015-07-27 15:14:41'),
(7, 'ouanou@gmail.com', 'ouanou', NULL, '', '$2y$10$Bn4jQaso.waT8NuRATkYdOELIWntt2GUqVjWRBZQMkVm.gcFwR60e', '', '', '0000-00-00 00:00:00', '2015-07-27 16:09:11', NULL),
(8, 'depardieu@gmail.com', 'Depardieu', NULL, '', '$2y$10$TXbwp3V.MrHRPpIGPfbJfe8.96VhuSqgFQQqWu/GIc1OBs7E28dIm', '', '', '0000-00-00 00:00:00', '2015-07-27 16:44:45', NULL);

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
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
