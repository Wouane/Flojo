-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2015 at 04:27 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_mess`, `title`, `description`, `url`, `mess_picture`, `date_created`, `date_expiry`) VALUES
(1, '', 'SALUT ', NULL, NULL, '2015-07-27 14:05:04', '2015-07-27 14:05:04'),
(2, '', 'SALUT ', NULL, NULL, '2015-07-27 14:08:12', '2015-07-27 14:08:12'),
(3, '', 'SALUT ', NULL, NULL, '2015-07-27 14:16:41', '2015-07-27 14:16:41'),
(4, '', 'SALUT ', NULL, NULL, '2015-07-27 14:17:17', '2015-07-27 14:17:17'),
(5, '', 'https://www.google.fr/search?q=toto&ie=utf-8&oe=utf-8&gws_rd=cr&ei=xj62Vc-ONYe7UYzBluAB', NULL, NULL, '2015-07-27 16:23:51', '2015-07-27 16:23:51'),
(6, '', '', '', '', '2015-07-29 11:09:45', '2015-07-29 11:09:45'),
(7, '', '', '', '', '2015-07-29 11:10:15', '2015-07-29 11:10:15'),
(8, '', '', '', '', '2015-07-29 11:12:49', '2015-07-29 11:12:49'),
(9, '', '', '', '', '2015-07-29 11:15:39', '2015-07-29 11:15:39'),
(10, 'azazz', 'azazazazazazazazaz', 'www.google.com', '399b948a03cfd34f2240f5f5bf896b2f.jpg', '2015-07-29 14:14:10', '2015-07-29 14:14:10'),
(11, 'Salut je suis le titre de mon ', 'Je suis la description de mon twitt test', 'www.test.webforce3.com', 'f253b463315f3fdbf3fbf990c5a2a469.jpg', '2015-07-29 15:31:43', '2015-07-29 15:31:43'),
(12, 'azaz', 'azazazaz', 'azazaza.com', 'c5d4c194977c450296b4aacbac96ddd6.jpg', '2015-07-29 15:35:24', '2015-07-29 15:35:24'),
(13, 'azaz', 'azazazaz', 'azazaza.com', 'd693b822207aba407524eb76dfe2d734.jpg', '2015-07-29 15:37:08', '2015-07-29 15:37:08'),
(14, 'salut', 'je suis un nouveau twitt', 'www.salutlacompagnie.com', '0cdfe3982eb361670ef2f36dad8361b5.jpg', '2015-07-29 15:56:44', '2015-07-29 15:56:44'),
(15, 'message sans photo', 'juste un texte', 'www.google.com', NULL, '2015-07-29 15:58:36', '2015-07-29 15:58:36'),
(16, 'message sans photo', 'juste un texte', 'www.google.com', NULL, '2015-07-29 15:59:12', '2015-07-29 15:59:12'),
(17, 'message sans photo', 'juste un texte', 'www.google.com', NULL, '2015-07-29 15:59:30', '2015-07-29 15:59:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `user_description`, `user_picture`, `password`, `votes`, `token`, `token_expiry`, `date_created`, `date_modified`) VALUES
(1, 'wouane@gmail.com', 'wouane', NULL, '', '$2y$10$Abi/Z7yWne5adz5n7ulJiuHO6TECpXkHvfHUls2AIoX19oHBtqE/K', '', '$2y$10$/stK2VBuC2JlnV3AYGlFSuHVkDny4Ki9tp/HJnzQCdgdkza4/6H.G', '2015-07-30 12:34:44', '2015-07-24 15:29:10', '2015-07-29 12:34:44'),
(2, 'jojo@gmail.com', 'Jojo', NULL, '', '$2y$10$prNeXOxhKUcyeMwAkK682OWG74p31f568bVtvx1dWKLsQVCt1U22a', '', '', '0000-00-00 00:00:00', '2015-07-24 15:38:00', NULL),
(3, 'tristan@gmail.com', 'tristan', NULL, '', '$2y$10$U2FBjqKsC9fKZ7jH0Tr4Du/pPjcn7AvdSqADKPVY5bqpOLEJWnxB2', '', '', '0000-00-00 00:00:00', '2015-07-24 16:39:32', NULL),
(4, 'Papa@gmail.com', 'papa', NULL, '', '$2y$10$vkRMHArkl9IhnTu4WpiTSut/BjAQkeoh09zMa/dNQXSHPkMIb2XXW', '', '', '0000-00-00 00:00:00', '2015-07-24 16:58:12', NULL),
(5, 'Coucou@gmail.com', 'coucou', NULL, '', '$2y$10$Mw5WIXLaYjz8i1ZImHJf7e7SJeDMCnH0WjpcWF3PCFYLVPpA44IS2', '', '$2y$10$ckJ0xQyXrxxN77bsIZ4j7Objc7Ryn37pC3DVQ/cx4G7vCOL/cx.GK', '2015-07-28 14:56:48', '2015-07-27 14:56:02', '2015-07-27 14:56:48'),
(6, 'poupou@gmail.com', 'poupou', 'Coucou je suis poupou', '', '$2y$10$OuzqH1OwiVtRp8JMXFO9QOYKW5cx.vy6qkbD03XWKazCDph0wqRVy', '', '$2y$10$uZRJi.smjjlUJvPwZSqJPu6wzOv25PGQQAV6qY2XKn/wZZC1hOeLO', '2015-07-30 12:21:31', '2015-07-27 15:10:53', '2015-07-29 15:27:34'),
(7, 'ouanou@gmail.com', 'ouanou', NULL, '', '$2y$10$Bn4jQaso.waT8NuRATkYdOELIWntt2GUqVjWRBZQMkVm.gcFwR60e', '', '', '0000-00-00 00:00:00', '2015-07-27 16:09:11', NULL),
(8, 'depardieu@gmail.com', 'Depardieu', NULL, '', '$2y$10$TXbwp3V.MrHRPpIGPfbJfe8.96VhuSqgFQQqWu/GIc1OBs7E28dIm', '', '', '0000-00-00 00:00:00', '2015-07-27 16:44:45', NULL),
(9, 'pouce@gmail.com', 'pouce', NULL, '', '$2y$10$0/vFM3CZfji0TSleGeCbp.CSARKos6L91hiXJhzAuHbuC5UHWJuKK', '', '', '0000-00-00 00:00:00', '2015-07-28 14:15:59', NULL),
(10, 'pacha@gmail.com', 'pacha', NULL, '', '$2y$10$JJEp.tkDCPOzgLaGQdeqNeSa.2JGOnCsZ2jeOZVrZ6ZsJxXw7OIjm', '', '', '0000-00-00 00:00:00', '2015-07-28 14:18:02', NULL),
(11, 'popou@gmail.com', 'popou', '', '', '$2y$10$arrzJW1pFkt14nY/J7Lseuh2Xa8ZaWbOvacMfZBXkD6tyhGTS32na', '', '', '0000-00-00 00:00:00', '2015-07-28 16:04:54', '2015-07-29 15:33:37'),
(12, 'oooo@gmail.com', 'oooo', 'aazazazazazazaz', '', '$2y$10$TJ0.chFDlrcnI/Yr5hCqFuy.mpabsBxyOlDrfiHxbzTJL2uKdoq2a', '', '', '0000-00-00 00:00:00', '2015-07-29 10:33:06', '2015-07-29 10:33:23'),
(13, '', '', NULL, '', '$2y$10$2OqiocSjRCw47SXe8qr9ZeROc1kiWGS3hAysWFgnTHBhb9xyOvCYS', '', '', '0000-00-00 00:00:00', '2015-07-29 10:38:46', NULL),
(14, '', '', NULL, '', '$2y$10$2X.dwB2VwcuFnlXYmdnSruhzRQX19fX6TUjbpxnTYOaK0S5eyeKaG', '', '', '0000-00-00 00:00:00', '2015-07-29 10:39:30', NULL),
(15, 'zakzak@gmail.com', '', NULL, '', '$2y$10$PilkY7ryKbTBTH2N3FVHc.0d40J2ZamRefugj3wjSHG3HZ2tQ6C3G', '', '', '0000-00-00 00:00:00', '2015-07-29 10:42:14', NULL),
(16, '', '', NULL, '', '$2y$10$FYWnOkTsW0Yft7Y65j4zLepXal1LiFWqUKf9awA0KQ71r4JA6i6vW', '', '', '0000-00-00 00:00:00', '2015-07-29 10:43:00', NULL),
(17, 'salut@gmail.com', 'salut', 'azazazazzz', '', '$2y$10$AfaySqhkhuKujbTTaoNnkO/TKgotoOXrDSIvZ2gTFgUivjULzKJCS', '', '', '0000-00-00 00:00:00', '2015-07-29 13:11:17', '2015-07-29 13:15:32');

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
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
