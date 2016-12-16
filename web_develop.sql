-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2016 at 03:30 PM
-- Server version: 5.6.17
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web_develop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `passwd`) VALUES
(1, 'hclovejesus@gmail.com', '$2y$10$G0MYcFO16Mez1ARAEZbxgujog.LlVpr.nxcAK2OKNsnzEwvUKtpMW');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `news_id` int(100) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `content`, `author`) VALUES
(1, 1, 'adsfasf', '11'),
(2, 1, 'asdfasdfadf', '11'),
(3, 1, 'adsfasf', '11'),
(4, 1, 'asdfasdfadf', '11'),
(5, 1, 'asdfasdgfsdfdf', '11'),
(6, 1, 'asdfafadsfsav', '11'),
(7, 1, 'asdfgdssfadf', '11'),
(8, 1, 'adsfasdfasdf', '11'),
(9, 1, 'dfasdf', 'qq');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`) VALUES
(1, 'the ajax content', 'this is the test news'),
(2, 'the ajax', 'this is the ajax content '),
(3, 'the ajax', 'this is the ajax content ');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT 'NOT NULL',
  `link` varchar(150) NOT NULL,
  `overview` text NOT NULL,
  `cover_image` varchar(200) NOT NULL,
  `position` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `name`, `link`, `overview`, `cover_image`, `position`, `status`) VALUES
(62, 'asfsdsfasdfewerwer', 'sdfsadff', 'sdfewrewrw', '108127.jpeg', 3, 0),
(63, 'dsafasdf', 'asdf', 'sdfasdfasdf', '107083.jpeg', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_image`
--

CREATE TABLE IF NOT EXISTS `work_image` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `work_id` int(100) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `position` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `work_image`
--

INSERT INTO `work_image` (`id`, `work_id`, `image`, `position`) VALUES
(16, 61, '108127.jpeg', 0),
(17, 62, '108244.jpeg', 0),
(18, 63, '108133.jpeg', 0),
(19, 63, '108249.jpeg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
