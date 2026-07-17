--
--
--
--	swCV schema.sql
--	Hppsrc 2026
--	Based on version 0.0.1
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `swcv`;
CREATE DATABASE `swcv`;
USE `swcv`;

START TRANSACTION;

-- --------------------------------------------------------

CREATE TABLE `general` (
  `user_access` varchar(50) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `show_last_update` tinyint(1) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `squema_version` varchar(5) NOT NULL DEFAULT '001',
  `swCV_language` varchar(5) NOT NULL DEFAULT 'en',
  `show_welcome` tinyint(1) NOT NULL DEFAULT 1,
  `public_view` tinyint(1) NOT NULL DEFAULT 1,
  `dinamic_web_title` tinyint(1) NOT NULL DEFAULT 1,
  `blog_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `blog_comments_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `blog_likes_enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

CREATE TABLE `userinfo` (
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `profile_picture` mediumtext NOT NULL,
  `social_facebook` varchar(50) NOT NULL,
  `social_twitter` varchar(50) NOT NULL,
  `social_linkedin` varchar(50) NOT NULL,
  `social_github` varchar(50) NOT NULL,
  `social_web` varchar(50) NOT NULL,
  `social_email` varchar(50) NOT NULL,
  `social_phone` varchar(50) NOT NULL,
  `social_switches` varchar(8) NOT NULL DEFAULT '0000000',
  `birthday` timestamp NOT NULL DEFAULT current_timestamp(),
  `show_age` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
