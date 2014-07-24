-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 24, 2014 at 02:20 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cycle`
--
CREATE DATABASE IF NOT EXISTS `cycle` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cycle`;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distance` decimal(10,0) NOT NULL,
  `duration` decimal(10,0) NOT NULL,
  `tripdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
