-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2019 at 01:03 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.2.23-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gkdemy`
--

-- --------------------------------------------------------

--
-- Table structure for table `gk_post_seo`
--

CREATE TABLE `gk_job_post_seo` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_post_id` int(10) UNSIGNED NOT NULL,
  `titile` varchar(50) NOT NULL,
  `description` longtext,
  `keyword` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
