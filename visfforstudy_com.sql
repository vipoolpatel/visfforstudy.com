-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2020 at 04:02 AM
-- Server version: 10.2.3-MariaDB-log
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visfforstudy_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `user_id`, `title`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 24, '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', 0, '2020-07-21 12:15:16', '2020-07-21 12:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `bigbluebutton`
--

CREATE TABLE `bigbluebutton` (
  `id` int(11) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `port` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bigbluebutton`
--

INSERT INTO `bigbluebutton` (`id`, `url`, `port`, `salt`) VALUES
(1, 'https://ukvisffor.com/bigbluebutton/', '81', 'HFIlJARO53RnaVs73AxepzVf4gpeFO5CkQkpnmOuhw');

-- --------------------------------------------------------

--
-- Table structure for table `block_chat`
--

CREATE TABLE `block_chat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `block_chat`
--

INSERT INTO `block_chat` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '电子邮件', NULL, NULL),
(2, '电话号码', NULL, NULL),
(3, 'gmail', NULL, NULL),
(4, '电子邮件', NULL, NULL),
(5, 'skype', NULL, NULL),
(6, 'whatsapp', NULL, NULL),
(7, '微信', NULL, NULL),
(8, 'qq', NULL, NULL),
(9, 'Facebook', NULL, NULL),
(10, 'Snapchat', NULL, NULL),
(11, 'Botim', NULL, NULL),
(12, 'imo', NULL, NULL),
(13, '支付宝', NULL, NULL),
(14, '微信支付', NULL, NULL),
(15, '贝宝', NULL, NULL),
(16, '西联汇款', NULL, NULL),
(17, 'email', NULL, NULL),
(18, 'phone number', NULL, NULL),
(19, 'wechat', NULL, NULL),
(20, '脸书', NULL, NULL),
(21, 'Alipay', NULL, NULL),
(22, 'Wechat pay', NULL, NULL),
(23, 'Paypal', NULL, NULL),
(24, 'Western union', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `booking_name` varchar(255) DEFAULT NULL,
  `ch_booking_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `booking_name`, `ch_booking_name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Prepare for exam', NULL, 0, NULL, NULL),
(2, 'Improve skill', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ch_category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_pic` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `category_name`, `ch_category_name`, `category_pic`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 0, 'English', '英语', 'wsat6oku457nhbjxwby5ol6kxnrflv.jpg', 1, 0, '2020-06-29 11:49:20', '2020-06-29 11:49:20'),
(2, 0, 'Math', '數學', 'ce02kluxueomnzlwnxpchlnhx9jr1d.jpg', 1, 0, '2020-06-29 11:49:52', '2020-06-29 11:49:52'),
(3, 0, 'Science', '科學', 'bsfrtgkryk8pumkqzm597amjeumilh.jpg', 1, 0, '2020-06-29 11:50:17', '2020-06-29 11:50:17'),
(4, 0, 'Geography', '地理', 'pvtejhf2pwsvwsm6lijxujkolyv3hr.jpg', 1, 0, '2020-06-29 11:50:33', '2020-06-29 11:50:33'),
(5, 0, 'History', '歷史', 'o1i8lewrswckwstlqclmlqu0b9vlqw.jpg', 1, 0, '2020-06-29 11:51:01', '2020-06-29 11:51:01'),
(6, 0, 'IELTS', '雅思', 'ebn6rqkzykn416inagbzsr8lfswndi.jpg', 1, 0, '2020-06-29 11:51:17', '2020-06-29 11:51:17'),
(7, 0, 'Law', '法', 'ntbcxoensz2lgnoh4vawj8o6hwfuwc.jpg', 1, 0, '2020-06-29 11:51:49', '2020-06-29 11:51:49'),
(8, 0, 'Business', '商業', 'gmc8ehj60wd8ov9d0c26gpeaqeiktp.jpg', 1, 0, '2020-06-29 11:52:14', '2020-06-29 11:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `message_type` int(1) NOT NULL DEFAULT 0 COMMENT '0= Text , 1 = File',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '-1 = block message 0= send, 1 = Read, 2 =delete',
  `is_notify` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender_id`, `receiver_id`, `message`, `message_type`, `status`, `is_notify`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'fsdfds fsdfds fsdfd fsdfd fsdffsdfd fsdfsd fsd', 0, 1, 0, '2020-07-25 08:11:55', '2020-07-25 19:48:30'),
(2, 2, 1, 'fsdf fdfdsf dfsd', 0, 1, 0, '2020-07-25 08:12:00', '2020-07-25 19:48:30'),
(3, 2, 1, 'fsdf fd', 0, 1, 0, '2020-07-25 08:12:24', '2020-07-25 19:48:30'),
(4, 2, 1, 'hardk dataagdfgsd fsdfsd fsdf fsd', 0, 1, 0, '2020-07-25 08:12:36', '2020-07-25 19:48:30'),
(5, 2, 1, 'sdfsd fsdfds ', 0, 1, 0, '2020-07-25 08:12:52', '2020-07-25 19:48:30'),
(6, 2, 1, 'fsdfds fsdfdsfsd fsd', 0, 1, 0, '2020-07-25 08:12:58', '2020-07-25 19:48:30'),
(7, 1, 2, 'gfgfgfg df', 0, 1, 0, '2020-07-25 08:13:10', '2020-07-25 19:50:02'),
(8, 2, 1, 'fdsfds fsd', 0, 1, 0, '2020-07-25 08:13:21', '2020-07-25 19:48:30'),
(9, 1, 2, 'fgdfgf gdfgdf gdfgdfgfd gfdgfd ', 0, 1, 0, '2020-07-25 08:13:54', '2020-07-25 19:50:02'),
(10, 2, 1, 'gdfgfd gdfgfd gdfgdfgf gdfgf', 0, 1, 0, '2020-07-25 08:13:59', '2020-07-25 19:48:30'),
(11, 2, 1, 'fgfggf gfdfgfg', 0, 1, 0, '2020-07-25 08:14:02', '2020-07-25 19:48:30'),
(12, 2, 1, 'gdfgfd gffgf', 0, 1, 0, '2020-07-25 08:14:14', '2020-07-25 19:48:30'),
(13, 11, 1, 'fsdfdsf gsdfg gdfg', 0, 1, 0, '2020-07-25 08:18:25', '2020-07-25 12:48:00'),
(14, 11, 1, 'fsdfd sfsd gfgfgdf', 0, 1, 0, '2020-07-25 08:18:45', '2020-07-25 12:48:00'),
(15, 2, 1, 'fsdf dfsdfsd gdfgdf', 0, 1, 0, '2020-07-25 08:18:56', '2020-07-25 19:48:30'),
(16, 11, 1, 'fsdfds fsdf', 0, 1, 0, '2020-07-25 08:28:09', '2020-07-25 12:48:00'),
(17, 2, 1, 'fsdf fdfd fdsf', 0, 1, 0, '2020-07-25 08:28:19', '2020-07-25 19:48:30'),
(18, 2, 1, 'fsdf fdfsdfsd fsdfsdfd ', 0, 1, 0, '2020-07-25 08:28:51', '2020-07-25 19:48:30'),
(19, 2, 1, 'fsdgdfgdf ', 0, 1, 0, '2020-07-25 08:28:53', '2020-07-25 19:48:30'),
(20, 11, 1, 'fsdf sdgdfgfd gdfgdfg ', 0, 1, 0, '2020-07-25 08:29:07', '2020-07-25 12:48:00'),
(21, 11, 1, 'gdfg dfgfgfg fgdf', 0, 1, 0, '2020-07-25 08:29:09', '2020-07-25 12:48:00'),
(22, 11, 1, 'gdfgdfgfgf gfd', 0, 1, 0, '2020-07-25 08:29:11', '2020-07-25 12:48:00'),
(23, 11, 1, 'gdfgfgfgfgfgdfgfd fsdfgdf', 0, 1, 0, '2020-07-25 08:29:15', '2020-07-25 12:48:00'),
(24, 11, 1, 'gfdgf gdf', 0, 1, 0, '2020-07-25 08:29:20', '2020-07-25 12:48:00'),
(25, 11, 1, 'dfgfgfgf', 0, 1, 0, '2020-07-25 08:29:22', '2020-07-25 12:48:00'),
(26, 1, 11, 'gfdg df', 0, 1, 0, '2020-07-25 08:29:32', '2020-07-25 08:40:55'),
(27, 1, 11, 'dfgf gdfgdfjhnghjhghjhgfggfg fgdgfdgfgf', 0, 1, 0, '2020-07-25 08:29:37', '2020-07-25 08:40:55'),
(28, 1, 11, 'fefsdfsdfdgsdfgd', 0, 1, 0, '2020-07-25 08:29:45', '2020-07-25 08:40:55'),
(29, 1, 11, 'hardik dayani', 0, 1, 0, '2020-07-25 08:29:59', '2020-07-25 08:40:55'),
(30, 1, 11, 'bgfhdf', 0, 1, 0, '2020-07-25 08:40:52', '2020-07-25 08:40:55'),
(31, 1, 11, 'hfgh h', 0, 1, 0, '2020-07-25 08:40:54', '2020-07-25 08:40:55'),
(32, 1, 2, 'hfghg ghg hfg', 0, 1, 0, '2020-07-25 08:40:59', '2020-07-25 19:50:02'),
(33, 1, 2, 'ghgf hghghgf', 0, 1, 0, '2020-07-25 08:41:07', '2020-07-25 19:50:02'),
(34, 1, 2, 'jhgjhjghjjgfhfghfghfghfghfghfg', 0, 1, 0, '2020-07-25 08:41:11', '2020-07-25 19:50:02'),
(35, 1, 2, 'jghjhjhjhj', 0, 1, 0, '2020-07-25 08:41:15', '2020-07-25 19:50:02'),
(36, 1, 2, 'jhgjhjhjhjg', 0, 1, 0, '2020-07-25 08:41:18', '2020-07-25 19:50:02'),
(37, 1, 2, 'jghjhjhjhjhjhg', 0, 1, 0, '2020-07-25 08:41:27', '2020-07-25 19:50:02'),
(38, 1, 2, 'jhjhjghjg', 0, 1, 0, '2020-07-25 08:41:31', '2020-07-25 19:50:02'),
(39, 1, 2, 'hfghhjjjhgf', 0, 1, 0, '2020-07-25 08:41:35', '2020-07-25 19:50:02'),
(40, 1, 2, 'ghjhjjg', 0, 1, 0, '2020-07-25 08:41:48', '2020-07-25 19:50:02'),
(41, 1, 2, 'jghjjhg', 0, 1, 0, '2020-07-25 08:41:51', '2020-07-25 19:50:02'),
(42, 1, 2, 'jghjgh jghjhgjhjdjhdfghf', 0, 1, 0, '2020-07-25 08:41:56', '2020-07-25 19:50:02'),
(43, 1, 2, 'jghjjhjhjhjh hjhjhjghj', 0, 1, 0, '2020-07-25 08:41:59', '2020-07-25 19:50:02'),
(44, 1, 2, 'kjhkjhkkhfghgjjkjhkjhkh', 0, 1, 0, '2020-07-25 08:42:05', '2020-07-25 19:50:02'),
(45, 1, 2, 'kjkjhkhhghgfhggh', 0, 1, 0, '2020-07-25 08:42:07', '2020-07-25 19:50:02'),
(46, 1, 2, 'kjhkjj', 0, 1, 0, '2020-07-25 08:42:10', '2020-07-25 19:50:02'),
(47, 1, 2, 'kjhkjhkjhgfh', 0, 1, 0, '2020-07-25 08:42:16', '2020-07-25 19:50:02'),
(48, 24, 25, '', 0, 0, 0, '2020-07-25 09:00:23', '2020-07-25 09:00:23'),
(49, 24, 25, '', 0, 0, 0, '2020-07-25 09:00:25', '2020-07-25 09:00:25'),
(50, 24, 25, '', 0, 0, 0, '2020-07-25 09:00:50', '2020-07-25 09:00:50'),
(51, 24, 2, '', 0, 1, 0, '2020-07-25 09:01:21', '2020-07-25 19:50:01'),
(52, 24, 2, 'fsdfds gfgfdgdfg fd', 0, 1, 0, '2020-07-25 09:03:05', '2020-07-25 19:50:01'),
(53, 24, 2, 'fgsdgff fgdfgfdgf gdfg fgfd', 0, 1, 0, '2020-07-25 09:03:10', '2020-07-25 19:50:01'),
(54, 24, 2, 'gdfgfgfgfdgf gdfgdfg gfgfgdfg gdfgfgf gdfgfg dfgfd', 0, 1, 0, '2020-07-25 09:03:17', '2020-07-25 19:50:01'),
(55, 2, 24, 'gfgdfgfd gdfgfdg gdfgdfg gfd', 0, 1, 0, '2020-07-25 09:03:24', '2020-07-25 13:34:55'),
(56, 24, 2, 'gdfgfd gfdgdf gdfgd', 0, 1, 0, '2020-07-25 09:03:29', '2020-07-25 19:50:01'),
(57, 2, 24, 'ghfghfghggfsd fsdf gdfgfdgd', 0, 1, 0, '2020-07-25 09:03:33', '2020-07-25 13:34:55'),
(58, 24, 2, 'dfhfghgfh gfsdgfdg', 0, 1, 0, '2020-07-25 09:03:36', '2020-07-25 19:50:01'),
(59, 24, 2, 'hfghgf hghfgh', 0, 1, 0, '2020-07-25 09:03:45', '2020-07-25 19:50:01'),
(60, 1, 2, 'fsdfd fsdfds ', 0, 1, 0, '2020-07-25 12:14:44', '2020-07-25 19:50:02'),
(61, 1, 2, 'fdsf fdfsfsfgdfgf gdfg gdfgfd', 0, 1, 0, '2020-07-25 12:14:52', '2020-07-25 19:50:02'),
(62, 1, 2, 'sdfdf gdg fgdfgfg gsdf', 0, 1, 0, '2020-07-25 12:14:59', '2020-07-25 19:50:02'),
(63, 1, 2, 'fgg gdfg fgdfgdf ', 0, 1, 0, '2020-07-25 12:15:04', '2020-07-25 19:50:02'),
(64, 1, 2, 'gdfgfggdfg gdfgfgfd', 0, 1, 0, '2020-07-25 12:15:20', '2020-07-25 19:50:02'),
(65, 1, 2, 'gfdgf gdfgdf gfgdf', 0, 1, 0, '2020-07-25 12:15:34', '2020-07-25 19:50:02'),
(66, 1, 2, 'gfdgfgfdgd', 0, 1, 0, '2020-07-25 12:17:28', '2020-07-25 19:50:02'),
(67, 1, 2, 'gfdgdf g', 0, 1, 0, '2020-07-25 12:17:47', '2020-07-25 19:50:02'),
(68, 1, 2, 'gdf gdfgdfgfd', 0, 1, 0, '2020-07-25 12:17:52', '2020-07-25 19:50:02'),
(69, 1, 2, 'gdfgfg', 0, 1, 0, '2020-07-25 12:19:10', '2020-07-25 19:50:02'),
(70, 1, 2, 'gdfgfd gfd', 0, 1, 0, '2020-07-25 12:19:19', '2020-07-25 19:50:02'),
(71, 1, 2, 'gdfgfdg', 0, 1, 0, '2020-07-25 12:19:25', '2020-07-25 19:50:02'),
(72, 1, 2, 'gfdgfd gfg fgd', 0, 1, 0, '2020-07-25 12:19:29', '2020-07-25 19:50:02'),
(73, 1, 2, 'gdfgfd', 0, 1, 0, '2020-07-25 12:19:39', '2020-07-25 19:50:02'),
(74, 1, 2, 'fsdfsd gsdfgsd', 0, 1, 0, '2020-07-25 12:47:55', '2020-07-25 19:50:02'),
(75, 1, 2, 'fgsdgfgdf gdfgfd dgfdgfd', 0, 1, 0, '2020-07-25 12:48:08', '2020-07-25 19:50:02'),
(76, 1, 2, 'sdfsd fsdgsdf', 0, 1, 0, '2020-07-25 12:49:00', '2020-07-25 19:50:02'),
(77, 1, 2, 'fsdfdsf dfdsfs', 0, 1, 0, '2020-07-25 12:49:11', '2020-07-25 19:50:02'),
(78, 1, 2, 'fsdfdfddsf fsd', 0, 1, 0, '2020-07-25 12:49:19', '2020-07-25 19:50:02'),
(79, 1, 2, 'fsdfsdffsdfsdf', 0, 1, 0, '2020-07-25 12:49:22', '2020-07-25 19:50:02'),
(80, 2, 1, 'gdfgdfggsdf', 0, 1, 0, '2020-07-25 12:49:24', '2020-07-25 19:48:30'),
(81, 2, 1, 'gdfgdfggfgd', 0, 1, 0, '2020-07-25 12:49:26', '2020-07-25 19:48:30'),
(82, 2, 1, 'fdsfsdf', 0, 1, 0, '2020-07-25 12:50:36', '2020-07-25 19:48:30'),
(83, 2, 1, 'gfdgfd gdfgd', 0, 1, 0, '2020-07-25 13:14:59', '2020-07-25 19:48:30'),
(84, 2, 1, 'fggdfgd', 0, 1, 0, '2020-07-25 13:15:04', '2020-07-25 19:48:30'),
(85, 1, 2, 'gdfgdfgd', 0, 1, 0, '2020-07-25 13:15:07', '2020-07-25 19:50:02'),
(86, 2, 1, 'testing working or not', 0, 1, 0, '2020-07-25 18:55:58', '2020-07-25 19:48:30'),
(87, 2, 1, 'hi i am tesing ', 0, 1, 0, '2020-07-25 19:36:30', '2020-07-25 19:48:30'),
(88, 2, 1, 'hi i am tersing wofkvfgfg gfgf', 0, 1, 0, '2020-07-25 19:36:40', '2020-07-25 19:48:30'),
(89, 1, 2, 'hi', 0, 1, 0, '2020-07-25 19:37:11', '2020-07-25 19:50:02'),
(90, 2, 1, 'hi', 0, 1, 0, '2020-07-25 19:46:42', '2020-07-25 19:48:30'),
(91, 2, 1, 'notification', 0, 1, 0, '2020-07-25 19:47:04', '2020-07-25 19:48:30'),
(92, 1, 2, 'hi', 0, 1, 0, '2020-07-25 19:47:20', '2020-07-25 19:50:02'),
(93, 2, 1, 'ffsdgdfgfdg', 0, 1, 0, '2020-07-25 19:47:51', '2020-07-25 19:48:30'),
(94, 2, 1, 'working perfect?', 0, 1, 0, '2020-07-25 19:48:00', '2020-07-25 19:48:30'),
(95, 2, 1, 'some issue there', 0, 0, 0, '2020-07-25 19:48:42', '2020-07-25 19:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_name`, `created_at`, `updated_at`) VALUES
(1, 'B Vibhag', NULL, NULL),
(2, 'A Vibhag', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `code` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `ch_nicename` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code2` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `name`, `nicename`, `ch_nicename`, `code2`, `numcode`, `phonecode`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', NULL, 'AFG', 4, 93, 'AF.svg', '0000-00-00 00:00:00', '2020-07-23 18:35:46'),
(2, 'AL', 'ALBANIA', 'Albania', NULL, 'ALB', 8, 355, 'AL.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:45'),
(3, 'DZ', 'ALGERIA', 'Algeria', NULL, 'DZA', 12, 213, 'DZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:46'),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', NULL, 'ASM', 16, 1684, 'AS.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:47'),
(5, 'AD', 'ANDORRA', 'Andorra', NULL, 'AND', 20, 376, 'AD.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:48'),
(6, 'AO', 'ANGOLA', 'Angola', NULL, 'AGO', 24, 244, 'AO.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:48'),
(7, 'AI', 'ANGUILLA', 'Anguilla', NULL, 'AIA', 660, 1264, 'AI.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:50'),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, NULL, 0, 'AQ.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:50'),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', NULL, 'ATG', 28, 1268, 'AG.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:51'),
(10, 'AR', 'ARGENTINA', 'Argentina', NULL, 'ARG', 32, 54, 'AR.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:51'),
(11, 'AM', 'ARMENIA', 'Armenia', NULL, 'ARM', 51, 374, 'AM.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:52'),
(12, 'AW', 'ARUBA', 'Aruba', NULL, 'ABW', 533, 297, 'AW.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:52'),
(13, 'AU', 'AUSTRALIA', 'Australia', NULL, 'AUS', 36, 61, 'AU.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:53'),
(14, 'AT', 'AUSTRIA', 'Austria', NULL, 'AUT', 40, 43, 'AT.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:53'),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', NULL, 'AZE', 31, 994, 'AZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:54'),
(16, 'BS', 'BAHAMAS', 'Bahamas', NULL, 'BHS', 44, 1242, 'BS.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:54'),
(17, 'BH', 'BAHRAIN', 'Bahrain', NULL, 'BHR', 48, 973, 'BH.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:55'),
(18, 'BD', 'BANGLADESH', 'Bangladesh', NULL, 'BGD', 50, 880, 'BD.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:55'),
(19, 'BB', 'BARBADOS', 'Barbados', NULL, 'BRB', 52, 1246, 'BB.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:56'),
(20, 'BY', 'BELARUS', 'Belarus', NULL, 'BLR', 112, 375, 'BY.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:56'),
(21, 'BE', 'BELGIUM', 'Belgium', NULL, 'BEL', 56, 32, 'BE.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:57'),
(22, 'BZ', 'BELIZE', 'Belize', NULL, 'BLZ', 84, 501, 'BZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:58'),
(23, 'BJ', 'BENIN', 'Benin', NULL, 'BEN', 204, 229, 'BJ.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:58'),
(24, 'BM', 'BERMUDA', 'Bermuda', NULL, 'BMU', 60, 1441, 'BM.svg', '0000-00-00 00:00:00', '2020-07-23 18:37:59'),
(25, 'BT', 'BHUTAN', 'Bhutan', NULL, 'BTN', 64, 975, 'BT.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:00'),
(26, 'BO', 'BOLIVIA', 'Bolivia', NULL, 'BOL', 68, 591, 'BO.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:01'),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', NULL, 'BIH', 70, 387, 'BA.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:02'),
(28, 'BW', 'BOTSWANA', 'Botswana', NULL, 'BWA', 72, 267, 'BW.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:03'),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, NULL, 0, 'BV.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:04'),
(30, 'BR', 'BRAZIL', 'Brazil', NULL, 'BRA', 76, 55, 'BR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:04'),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, NULL, 246, 'IO.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:05'),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', NULL, 'BRN', 96, 673, 'BN.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:06'),
(33, 'BG', 'BULGARIA', 'Bulgaria', NULL, 'BGR', 100, 359, 'BG.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:06'),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', NULL, 'BFA', 854, 226, 'BF.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:07'),
(35, 'BI', 'BURUNDI', 'Burundi', NULL, 'BDI', 108, 257, 'BI.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:08'),
(36, 'KH', 'CAMBODIA', 'Cambodia', NULL, 'KHM', 116, 855, 'KH.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:08'),
(37, 'CM', 'CAMEROON', 'Cameroon', NULL, 'CMR', 120, 237, 'CM.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:09'),
(38, 'CA', 'CANADA', 'Canada', NULL, 'CAN', 124, 1, 'CA.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:09'),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', NULL, 'CPV', 132, 238, 'CV.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:10'),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', NULL, 'CYM', 136, 1345, 'KY.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:10'),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', NULL, 'CAF', 140, 236, 'CF.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:11'),
(42, 'TD', 'CHAD', 'Chad', NULL, 'TCD', 148, 235, 'TD.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:11'),
(43, 'CL', 'CHILE', 'Chile', NULL, 'CHL', 152, 56, 'CL.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:12'),
(44, 'CN', 'CHINA', 'China', NULL, 'CHN', 156, 86, 'CN.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:12'),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, NULL, 61, 'CX.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:13'),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, NULL, 672, 'CC.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:13'),
(47, 'CO', 'COLOMBIA', 'Colombia', NULL, 'COL', 170, 57, 'CO.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:14'),
(48, 'KM', 'COMOROS', 'Comoros', NULL, 'COM', 174, 269, 'KM.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:14'),
(49, 'CG', 'CONGO', 'Congo', NULL, 'COG', 178, 242, 'CG.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:15'),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', NULL, 'COD', 180, 242, 'CD.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:15'),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', NULL, 'COK', 184, 682, 'CK.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:16'),
(52, 'CR', 'COSTA RICA', 'Costa Rica', NULL, 'CRI', 188, 506, 'CR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:16'),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', NULL, 'CIV', 384, 225, 'CI.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:17'),
(54, 'HR', 'CROATIA', 'Croatia', NULL, 'HRV', 191, 385, 'HR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:18'),
(55, 'CU', 'CUBA', 'Cuba', NULL, 'CUB', 192, 53, 'CU.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:18'),
(56, 'CY', 'CYPRUS', 'Cyprus', NULL, 'CYP', 196, 357, 'CY.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:19'),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', NULL, 'CZE', 203, 420, 'CZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:20'),
(58, 'DK', 'DENMARK', 'Denmark', NULL, 'DNK', 208, 45, 'DK.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:20'),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', NULL, 'DJI', 262, 253, 'DJ.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:21'),
(60, 'DM', 'DOMINICA', 'Dominica', NULL, 'DMA', 212, 1767, 'DM.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:22'),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', NULL, 'DOM', 214, 1809, 'DO.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:23'),
(62, 'EC', 'ECUADOR', 'Ecuador', NULL, 'ECU', 218, 593, 'EC.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:24'),
(63, 'EG', 'EGYPT', 'Egypt', NULL, 'EGY', 818, 20, 'EG.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:24'),
(64, 'SV', 'EL SALVADOR', 'El Salvador', NULL, 'SLV', 222, 503, 'SV.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:25'),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', NULL, 'GNQ', 226, 240, 'GQ.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:26'),
(66, 'ER', 'ERITREA', 'Eritrea', NULL, 'ERI', 232, 291, 'ER.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:26'),
(67, 'EE', 'ESTONIA', 'Estonia', NULL, 'EST', 233, 372, 'EE.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:27'),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', NULL, 'ETH', 231, 251, 'ET.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:28'),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', NULL, 'FLK', 238, 500, 'FK.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:28'),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', NULL, 'FRO', 234, 298, 'FO.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:29'),
(71, 'FJ', 'FIJI', 'Fiji', NULL, 'FJI', 242, 679, 'FJ.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:30'),
(72, 'FI', 'FINLAND', 'Finland', NULL, 'FIN', 246, 358, 'FI.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:30'),
(73, 'FR', 'FRANCE', 'France', NULL, 'FRA', 250, 33, 'FR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:31'),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', NULL, 'GUF', 254, 594, 'GF.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:31'),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', NULL, 'PYF', 258, 689, 'PF.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:32'),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, NULL, 0, 'TF.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:33'),
(77, 'GA', 'GABON', 'Gabon', NULL, 'GAB', 266, 241, 'GA.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:34'),
(78, 'GM', 'GAMBIA', 'Gambia', NULL, 'GMB', 270, 220, 'GM.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:34'),
(79, 'GE', 'GEORGIA', 'Georgia', NULL, 'GEO', 268, 995, 'GE.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:35'),
(80, 'DE', 'GERMANY', 'Germany', NULL, 'DEU', 276, 49, 'DE.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:35'),
(81, 'GH', 'GHANA', 'Ghana', NULL, 'GHA', 288, 233, 'GH.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:36'),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', NULL, 'GIB', 292, 350, 'GI.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:36'),
(83, 'GR', 'GREECE', 'Greece', NULL, 'GRC', 300, 30, 'GR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:37'),
(84, 'GL', 'GREENLAND', 'Greenland', NULL, 'GRL', 304, 299, 'GL.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:37'),
(85, 'GD', 'GRENADA', 'Grenada', NULL, 'GRD', 308, 1473, 'GD.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:38'),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', NULL, 'GLP', 312, 590, 'GP.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:38'),
(87, 'GU', 'GUAM', 'Guam', NULL, 'GUM', 316, 1671, 'GU.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:39'),
(88, 'GT', 'GUATEMALA', 'Guatemala', NULL, 'GTM', 320, 502, 'GT.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:40'),
(89, 'GN', 'GUINEA', 'Guinea', NULL, 'GIN', 324, 224, 'GN.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:40'),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', NULL, 'GNB', 624, 245, 'GW.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:41'),
(91, 'GY', 'GUYANA', 'Guyana', NULL, 'GUY', 328, 592, 'GY.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:41'),
(92, 'HT', 'HAITI', 'Haiti', NULL, 'HTI', 332, 509, 'HT.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:42'),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, NULL, 0, 'HM.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:42'),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', NULL, 'VAT', 336, 39, 'VA.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:43'),
(95, 'HN', 'HONDURAS', 'Honduras', NULL, 'HND', 340, 504, 'HN.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:43'),
(96, 'HK', 'HONG KONG', 'Hong Kong', NULL, 'HKG', 344, 852, 'HK.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:44'),
(97, 'HU', 'HUNGARY', 'Hungary', NULL, 'HUN', 348, 36, 'HU.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:44'),
(98, 'IS', 'ICELAND', 'Iceland', NULL, 'ISL', 352, 354, 'IS.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:45'),
(99, 'IN', 'INDIA', 'India', NULL, 'IND', 356, 91, 'IN.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:45'),
(100, 'ID', 'INDONESIA', 'Indonesia', NULL, 'IDN', 360, 62, 'ID.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:46'),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', NULL, 'IRN', 364, 98, 'IR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:46'),
(102, 'IQ', 'IRAQ', 'Iraq', NULL, 'IRQ', 368, 964, 'IQ.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:47'),
(103, 'IE', 'IRELAND', 'Ireland', NULL, 'IRL', 372, 353, 'IE.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:47'),
(104, 'IL', 'ISRAEL', 'Israel', NULL, 'ISR', 376, 972, 'IL.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:48'),
(105, 'IT', 'ITALY', 'Italy', NULL, 'ITA', 380, 39, 'IT.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:48'),
(106, 'JM', 'JAMAICA', 'Jamaica', NULL, 'JAM', 388, 1876, 'JM.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:49'),
(107, 'JP', 'JAPAN', 'Japan', NULL, 'JPN', 392, 81, 'JP.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:49'),
(108, 'JO', 'JORDAN', 'Jordan', NULL, 'JOR', 400, 962, 'JO.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:50'),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', NULL, 'KAZ', 398, 7, 'KZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:50'),
(110, 'KE', 'KENYA', 'Kenya', NULL, 'KEN', 404, 254, 'KE.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:51'),
(111, 'KI', 'KIRIBATI', 'Kiribati', NULL, 'KIR', 296, 686, 'KI.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:52'),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', NULL, 'PRK', 408, 850, 'KP.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:52'),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', NULL, 'KOR', 410, 82, 'KR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:53'),
(114, 'KW', 'KUWAIT', 'Kuwait', NULL, 'KWT', 414, 965, 'KW.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:53'),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', NULL, 'KGZ', 417, 996, 'KG.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:54'),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', NULL, 'LAO', 418, 856, 'LA.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:54'),
(117, 'LV', 'LATVIA', 'Latvia', NULL, 'LVA', 428, 371, 'LV.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:55'),
(118, 'LB', 'LEBANON', 'Lebanon', NULL, 'LBN', 422, 961, 'LB.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:56'),
(119, 'LS', 'LESOTHO', 'Lesotho', NULL, 'LSO', 426, 266, 'LS.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:56'),
(120, 'LR', 'LIBERIA', 'Liberia', NULL, 'LBR', 430, 231, 'LR.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:57'),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', NULL, 'LBY', 434, 218, 'LY.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:57'),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', NULL, 'LIE', 438, 423, 'LI.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:58'),
(123, 'LT', 'LITHUANIA', 'Lithuania', NULL, 'LTU', 440, 370, 'LT.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:58'),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', NULL, 'LUX', 442, 352, 'LU.svg', '0000-00-00 00:00:00', '2020-07-23 18:38:59'),
(125, 'MO', 'MACAO', 'Macao', NULL, 'MAC', 446, 853, 'MO.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:00'),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', NULL, 'MKD', 807, 389, 'MK.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:00'),
(127, 'MG', 'MADAGASCAR', 'Madagascar', NULL, 'MDG', 450, 261, 'MG.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:01'),
(128, 'MW', 'MALAWI', 'Malawi', NULL, 'MWI', 454, 265, 'MW.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:01'),
(129, 'MY', 'MALAYSIA', 'Malaysia', NULL, 'MYS', 458, 60, 'MY.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:02'),
(130, 'MV', 'MALDIVES', 'Maldives', NULL, 'MDV', 462, 960, 'MV.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:02'),
(131, 'ML', 'MALI', 'Mali', NULL, 'MLI', 466, 223, 'ML.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:03'),
(132, 'MT', 'MALTA', 'Malta', NULL, 'MLT', 470, 356, 'MT.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:03'),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', NULL, 'MHL', 584, 692, 'MH.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:04'),
(134, 'MQ', 'MARTINIQUE', 'Martinique', NULL, 'MTQ', 474, 596, 'MQ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:04'),
(135, 'MR', 'MAURITANIA', 'Mauritania', NULL, 'MRT', 478, 222, 'MR.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:05'),
(136, 'MU', 'MAURITIUS', 'Mauritius', NULL, 'MUS', 480, 230, 'MU.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:06'),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, NULL, 269, 'YT.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:07'),
(138, 'MX', 'MEXICO', 'Mexico', NULL, 'MEX', 484, 52, 'MX.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:08'),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', NULL, 'FSM', 583, 691, 'FM.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:08'),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', NULL, 'MDA', 498, 373, 'MD.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:09'),
(141, 'MC', 'MONACO', 'Monaco', NULL, 'MCO', 492, 377, 'MC.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:09'),
(142, 'MN', 'MONGOLIA', 'Mongolia', NULL, 'MNG', 496, 976, 'MN.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:10'),
(143, 'MS', 'MONTSERRAT', 'Montserrat', NULL, 'MSR', 500, 1664, 'MS.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:10'),
(144, 'MA', 'MOROCCO', 'Morocco', NULL, 'MAR', 504, 212, 'MA.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:11'),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', NULL, 'MOZ', 508, 258, 'MZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:12'),
(146, 'MM', 'MYANMAR', 'Myanmar', NULL, 'MMR', 104, 95, 'MM.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:12'),
(147, 'NA', 'NAMIBIA', 'Namibia', NULL, 'NAM', 516, 264, 'NA.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:13'),
(148, 'NR', 'NAURU', 'Nauru', NULL, 'NRU', 520, 674, 'NR.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:13'),
(149, 'NP', 'NEPAL', 'Nepal', NULL, 'NPL', 524, 977, 'NP.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:14'),
(150, 'NL', 'NETHERLANDS', 'Netherlands', NULL, 'NLD', 528, 31, 'NL.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:14'),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', NULL, 'ANT', 530, 599, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', NULL, 'NCL', 540, 687, 'NC.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:15'),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', NULL, 'NZL', 554, 64, 'NZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:16'),
(154, 'NI', 'NICARAGUA', 'Nicaragua', NULL, 'NIC', 558, 505, 'NI.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:17'),
(155, 'NE', 'NIGER', 'Niger', NULL, 'NER', 562, 227, 'NE.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:17'),
(156, 'NG', 'NIGERIA', 'Nigeria', NULL, 'NGA', 566, 234, 'NG.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:18'),
(157, 'NU', 'NIUE', 'Niue', NULL, 'NIU', 570, 683, 'NU.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:18'),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', NULL, 'NFK', 574, 672, 'NF.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:19'),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', NULL, 'MNP', 580, 1670, 'MP.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:20'),
(160, 'NO', 'NORWAY', 'Norway', NULL, 'NOR', 578, 47, 'NO.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:20'),
(161, 'OM', 'OMAN', 'Oman', NULL, 'OMN', 512, 968, 'OM.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:21'),
(162, 'PK', 'PAKISTAN', 'Pakistan', NULL, 'PAK', 586, 92, 'PK.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:21'),
(163, 'PW', 'PALAU', 'Palau', NULL, 'PLW', 585, 680, 'PW.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:22'),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, NULL, 970, 'PS.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:22'),
(165, 'PA', 'PANAMA', 'Panama', NULL, 'PAN', 591, 507, 'PA.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:23'),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', NULL, 'PNG', 598, 675, 'PG.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:23'),
(167, 'PY', 'PARAGUAY', 'Paraguay', NULL, 'PRY', 600, 595, 'PY.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:24'),
(168, 'PE', 'PERU', 'Peru', NULL, 'PER', 604, 51, 'PE.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:25'),
(169, 'PH', 'PHILIPPINES', 'Philippines', NULL, 'PHL', 608, 63, 'PH.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:25'),
(170, 'PN', 'PITCAIRN', 'Pitcairn', NULL, 'PCN', 612, 0, 'PN.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:26'),
(171, 'PL', 'POLAND', 'Poland', NULL, 'POL', 616, 48, 'PL.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:26'),
(172, 'PT', 'PORTUGAL', 'Portugal', NULL, 'PRT', 620, 351, 'PT.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:27'),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', NULL, 'PRI', 630, 1787, 'PR.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:27'),
(174, 'QA', 'QATAR', 'Qatar', NULL, 'QAT', 634, 974, 'QA.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:28'),
(175, 'RE', 'REUNION', 'Reunion', NULL, 'REU', 638, 262, 'RE.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:28'),
(176, 'RO', 'ROMANIA', 'Romania', NULL, 'ROM', 642, 40, 'RO.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:29'),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', NULL, 'RUS', 643, 70, 'RU.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:29'),
(178, 'RW', 'RWANDA', 'Rwanda', NULL, 'RWA', 646, 250, 'RW.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:30'),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', NULL, 'SHN', 654, 290, 'SH.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:30'),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', NULL, 'KNA', 659, 1869, 'KN.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:31'),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', NULL, 'LCA', 662, 1758, 'LC.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:31'),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', NULL, 'SPM', 666, 508, 'PM.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:32'),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', NULL, 'VCT', 670, 1784, 'VC.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:32'),
(184, 'WS', 'SAMOA', 'Samoa', NULL, 'WSM', 882, 684, 'WS.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:33'),
(185, 'SM', 'SAN MARINO', 'San Marino', NULL, 'SMR', 674, 378, 'SM.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:34'),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', NULL, 'STP', 678, 239, 'ST.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:35'),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', NULL, 'SAU', 682, 966, 'SA.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:35'),
(188, 'SN', 'SENEGAL', 'Senegal', NULL, 'SEN', 686, 221, 'SN.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:37'),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, NULL, 381, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'SC', 'SEYCHELLES', 'Seychelles', NULL, 'SYC', 690, 248, 'SC.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:38'),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', NULL, 'SLE', 694, 232, 'SL.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:38'),
(192, 'SG', 'SINGAPORE', 'Singapore', NULL, 'SGP', 702, 65, 'SG.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:39'),
(193, 'SK', 'SLOVAKIA', 'Slovakia', NULL, 'SVK', 703, 421, 'SK.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:39'),
(194, 'SI', 'SLOVENIA', 'Slovenia', NULL, 'SVN', 705, 386, 'SI.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:40'),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', NULL, 'SLB', 90, 677, 'SB.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:40'),
(196, 'SO', 'SOMALIA', 'Somalia', NULL, 'SOM', 706, 252, 'SO.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:41'),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', NULL, 'ZAF', 710, 27, 'ZA.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:41'),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, NULL, 0, 'GS.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:42'),
(199, 'ES', 'SPAIN', 'Spain', NULL, 'ESP', 724, 34, 'ES.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:43'),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', NULL, 'LKA', 144, 94, 'LK.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:43'),
(201, 'SD', 'SUDAN', 'Sudan', NULL, 'SDN', 736, 249, 'SD.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:44'),
(202, 'SR', 'SURINAME', 'Suriname', NULL, 'SUR', 740, 597, 'SR.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:45'),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', NULL, 'SJM', 744, 47, 'SJ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:45'),
(204, 'SZ', 'SWAZILAND', 'Swaziland', NULL, 'SWZ', 748, 268, 'SZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:46'),
(205, 'SE', 'SWEDEN', 'Sweden', NULL, 'SWE', 752, 46, 'SE.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:47'),
(206, 'CH', 'SWITZERLAND', 'Switzerland', NULL, 'CHE', 756, 41, 'CH.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:47'),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', NULL, 'SYR', 760, 963, 'SY.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:48'),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', NULL, 'TWN', 158, 886, 'TW.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:48'),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', NULL, 'TJK', 762, 992, 'TJ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:49'),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', NULL, 'TZA', 834, 255, 'TZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:49'),
(211, 'TH', 'THAILAND', 'Thailand', NULL, 'THA', 764, 66, 'TH.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:50'),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, NULL, 670, 'TL.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:50'),
(213, 'TG', 'TOGO', 'Togo', NULL, 'TGO', 768, 228, 'TG.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:51'),
(214, 'TK', 'TOKELAU', 'Tokelau', NULL, 'TKL', 772, 690, 'TK.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:51'),
(215, 'TO', 'TONGA', 'Tonga', NULL, 'TON', 776, 676, 'TO.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:52'),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', NULL, 'TTO', 780, 1868, 'TT.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:52'),
(217, 'TN', 'TUNISIA', 'Tunisia', NULL, 'TUN', 788, 216, 'TN.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:53'),
(218, 'TR', 'TURKEY', 'Turkey', NULL, 'TUR', 792, 90, 'TR.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:53'),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', NULL, 'TKM', 795, 7370, 'TM.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:54'),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', NULL, 'TCA', 796, 1649, 'TC.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:55'),
(221, 'TV', 'TUVALU', 'Tuvalu', NULL, 'TUV', 798, 688, 'TV.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:55'),
(222, 'UG', 'UGANDA', 'Uganda', NULL, 'UGA', 800, 256, 'UG.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:56'),
(223, 'UA', 'UKRAINE', 'Ukraine', NULL, 'UKR', 804, 380, 'UA.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:56'),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', NULL, 'ARE', 784, 971, 'AE.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:57'),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', NULL, 'GBR', 826, 44, 'GB.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:57'),
(226, 'US', 'UNITED STATES', 'United States', NULL, 'USA', 840, 1, 'US.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:58'),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, NULL, 1, 'UM.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:58'),
(228, 'UY', 'URUGUAY', 'Uruguay', NULL, 'URY', 858, 598, 'UY.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:59'),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', NULL, 'UZB', 860, 998, 'UZ.svg', '0000-00-00 00:00:00', '2020-07-23 18:39:59'),
(230, 'VU', 'VANUATU', 'Vanuatu', NULL, 'VUT', 548, 678, 'VU.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:00'),
(231, 'VE', 'VENEZUELA', 'Venezuela', NULL, 'VEN', 862, 58, 'VE.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:00'),
(232, 'VN', 'VIET NAM', 'Viet Nam', NULL, 'VNM', 704, 84, 'VN.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:01'),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', NULL, 'VGB', 92, 1284, 'VG.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:01'),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', NULL, 'VIR', 850, 1340, 'VI.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:02'),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', NULL, 'WLF', 876, 681, 'WF.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:02'),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', NULL, 'ESH', 732, 212, 'EH.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:03'),
(237, 'YE', 'YEMEN', 'Yemen', NULL, 'YEM', 887, 967, 'YE.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:03'),
(238, 'ZM', 'ZAMBIA', 'Zambia', NULL, 'ZMB', 894, 260, 'ZM.svg', '0000-00-00 00:00:00', '2020-07-23 18:40:04'),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', '津巴布韦', 'ZWE', 716, 263, 'ZW.svg', '0000-00-00 00:00:00', '2020-07-25 19:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lesson_type_id` varchar(255) DEFAULT NULL,
  `course_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lesson_per_rate` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=panding, 2=approve, 3=reject',
  `is_notification` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=off, 1=teacher_notification, 2=admin_notification',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active , 1: delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `user_id`, `category_id`, `language_id`, `lesson_type_id`, `course_title`, `image`, `course_video`, `lesson_per_rate`, `description`, `status`, `is_notification`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, '2', '2', '1', 'How to convert the first letter of a string to uppercase in PHP', '20200630070108e9d9ujojtvsdswvvffur4vcd8lsldf.jpg', '20200630070108vgrw2zso1uwjsxjiiqccnzclujss2l.mp4', '20', 'test test', 1, 2, 0, '2020-06-30 01:31:08', '2020-07-02 12:09:00'),
(2, 1, '3', '2', '1', 'You will get all Student reviews', '20200630191131eercsskfxcvdshxsmfz4vdyqn0gcz0.jpg', '20200630191131pbthly1sktjriflv4x4pbj7xntfpsn.mp4', '20', 'test data', 1, 2, 0, '2020-06-30 13:41:31', '2020-07-02 12:08:56'),
(3, 1, '2', '2', '1', 'Answer: Use the PHP ucfirst() function', '20200630193221f9rzdp9yh3waouymtcc14geitnwnjh.jpg', NULL, '25', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', 2, 1, 0, '2020-06-30 14:02:21', '2020-07-25 13:04:11'),
(4, 1, '2', '2', '1', 'How to convert the first letter of a string to uppercase in PHP', '202007040623137ipe1msva5xlnws7ylvlw5t8dtsxyb.jpg', '20200701172503prniduzsbzjogofdaphtzx6n7ac48d.mp4', '20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, 2, 1, '2020-07-01 11:55:03', '2020-07-07 10:59:48'),
(5, 1, '2', '2', '1', 'How to convert the first letter of a string to uppercase in PHP', '202007100557243t58m37rsfcwqc0ov39y9ksurnj7hf.jpg', NULL, '10', '(Time zone changed automatically, so the available time has been changed to your local time automatically.)', 2, 1, 0, '2020-07-10 00:27:27', '2020-07-23 06:11:55'),
(6, 1, '2', '2', '1', 'How to convert the first letter of a string to uppercase in PHP', '20200725165302afox0zmvuracb8zhldxs4koizcllb1.jpg', NULL, '30', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', 2, 1, 0, '2020-07-25 11:23:05', '2020-07-25 13:04:08'),
(7, 1, '2', '2', '1', 'How to convert the first letter of a string to uppercase in PHP', '20200725165408z3tt12x7ry1bkarmqcln90hvejcuu5.jpg', NULL, '30', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', 2, 1, 0, '2020-07-25 11:24:10', '2020-07-25 13:04:06'),
(8, 1, '2', '2', '1', 'Answer: Use the PHP ucfirst() function', '20200725183800gpuiyxyog2131tyaoobmdwr28huagv.jpg', NULL, '20', '', 1, 0, 0, '2020-07-25 13:08:02', '2020-07-25 11:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_lesson`
--

CREATE TABLE `course_lesson` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_date` int(11) NOT NULL,
  `lesson_time` int(11) NOT NULL,
  `lesson_start_date` date DEFAULT NULL,
  `lesson_end_time` varchar(255) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `meeting_id` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_password` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active , 1: delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_lesson`
--

INSERT INTO `course_lesson` (`id`, `course_id`, `lesson_date`, `lesson_time`, `lesson_start_date`, `lesson_end_time`, `duration`, `meeting_id`, `meeting_password`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1591709520, 1591709520, '2020-06-09', '13:32', 30, NULL, NULL, 0, '2020-06-30 01:31:09', '2020-06-30 01:31:09'),
(2, 1, 1591795920, 1591795920, '2020-06-10', '13:32', 30, NULL, NULL, 0, '2020-06-30 01:31:09', '2020-06-30 01:31:09'),
(3, 1, 1591882320, 1591882320, '2020-06-11', '13:32', 30, NULL, NULL, 0, '2020-06-30 01:31:09', '2020-06-30 01:31:09'),
(4, 2, 1593610920, 1593610920, '2020-07-01', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(5, 2, 1593697320, 1593697320, '2020-07-02', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(6, 2, 1593783720, 1593783720, '2020-07-03', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(7, 2, 1593870120, 1593870120, '2020-07-04', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(8, 2, 1593956520, 1593956520, '2020-07-05', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(9, 2, 1594042920, 1594042920, '2020-07-06', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(10, 2, 1594129320, 1594129320, '2020-07-07', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(11, 2, 1594215720, 1594215720, '2020-07-08', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(12, 2, 1594302120, 1594302120, '2020-07-09', '13:42', 20, NULL, NULL, 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(13, 3, 1593612120, 1593612120, '2020-07-01', '14:02', 20, NULL, NULL, 1, '2020-06-30 14:02:21', '2020-07-10 04:13:20'),
(14, 3, 1593698520, 1593698520, '2020-07-02', '14:02', 20, NULL, NULL, 1, '2020-06-30 14:02:21', '2020-07-10 04:13:24'),
(15, 4, 1593604500, 1593604500, '2020-07-01', '11:55', 30, NULL, NULL, 1, '2020-07-01 11:55:03', '2020-07-07 10:59:48'),
(16, 4, 1593690900, 1593690900, '2020-07-02', '11:55', 30, NULL, NULL, 1, '2020-07-01 11:55:03', '2020-07-07 10:59:48'),
(17, 4, 1595505540, 1595505540, '2020-07-23', '11:59', 40, NULL, NULL, 1, '2020-07-01 11:58:32', '2020-07-07 10:59:48'),
(18, 4, 1595505540, 1595505540, '2020-07-23', '11:59', 30, NULL, NULL, 1, '2020-07-01 11:58:32', '2020-07-07 10:59:48'),
(19, 4, 1595591940, 1595591940, '2020-07-24', '11:59', 40, NULL, NULL, 1, '2020-07-01 11:58:32', '2020-07-07 10:59:48'),
(20, 4, 1595591940, 1595591940, '2020-07-24', '11:59', 30, NULL, NULL, 1, '2020-07-01 11:58:32', '2020-07-07 10:59:48'),
(21, 5, 1594351680, 1594351680, '2020-07-10', '03:28', 20, NULL, NULL, 0, '2020-07-10 00:27:27', '2020-07-10 00:27:27'),
(22, 5, 1594438080, 1594438080, '2020-07-11', '03:28', 20, NULL, NULL, 0, '2020-07-10 00:27:27', '2020-07-10 00:27:27'),
(23, 3, 1594396800, 1594396800, '2020-07-10', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(24, 3, 1594400400, 1594400400, '2020-07-10', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(25, 3, 1594404000, 1594404000, '2020-07-10', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(26, 3, 1594407600, 1594407600, '2020-07-10', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(27, 3, 1594414800, 1594414800, '2020-07-10', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(28, 3, 1594483200, 1594483200, '2020-07-11', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(29, 3, 1594486800, 1594486800, '2020-07-11', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(30, 3, 1594490400, 1594490400, '2020-07-11', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(31, 3, 1594494000, 1594494000, '2020-07-11', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(32, 3, 1594501200, 1594501200, '2020-07-11', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(33, 3, 1594569600, 1594569600, '2020-07-12', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(34, 3, 1594573200, 1594573200, '2020-07-12', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(35, 3, 1594576800, 1594576800, '2020-07-12', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(36, 3, 1594580400, 1594580400, '2020-07-12', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(37, 3, 1594587600, 1594587600, '2020-07-12', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(38, 3, 1594656000, 1594656000, '2020-07-13', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(39, 3, 1594659600, 1594659600, '2020-07-13', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(40, 3, 1594663200, 1594663200, '2020-07-13', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(41, 3, 1594666800, 1594666800, '2020-07-13', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(42, 3, 1594674000, 1594674000, '2020-07-13', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(43, 3, 1594742400, 1594742400, '2020-07-14', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(44, 3, 1594746000, 1594746000, '2020-07-14', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(45, 3, 1594749600, 1594749600, '2020-07-14', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(46, 3, 1594753200, 1594753200, '2020-07-14', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(47, 3, 1594760400, 1594760400, '2020-07-14', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(48, 3, 1594828800, 1594828800, '2020-07-15', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(49, 3, 1594832400, 1594832400, '2020-07-15', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(50, 3, 1594836000, 1594836000, '2020-07-15', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(51, 3, 1594839600, 1594839600, '2020-07-15', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(52, 3, 1594846800, 1594846800, '2020-07-15', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(53, 3, 1594915200, 1594915200, '2020-07-16', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(54, 3, 1594918800, 1594918800, '2020-07-16', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(55, 3, 1594922400, 1594922400, '2020-07-16', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(56, 3, 1594926000, 1594926000, '2020-07-16', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(57, 3, 1594933200, 1594933200, '2020-07-16', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(58, 3, 1595001600, 1595001600, '2020-07-17', '16:00', 30, NULL, NULL, 0, '2020-07-10 04:14:56', '2020-07-10 04:14:56'),
(59, 3, 1595005200, 1595005200, '2020-07-17', '17:00', 30, NULL, NULL, 0, '2020-07-10 04:14:57', '2020-07-10 04:14:57'),
(60, 3, 1595008800, 1595008800, '2020-07-17', '18:00', 30, NULL, NULL, 0, '2020-07-10 04:14:57', '2020-07-10 04:14:57'),
(61, 3, 1595012400, 1595012400, '2020-07-17', '19:00', 30, NULL, NULL, 0, '2020-07-10 04:14:57', '2020-07-10 04:14:57'),
(62, 3, 1595019600, 1595019600, '2020-07-17', '21:00', 30, NULL, NULL, 0, '2020-07-10 04:14:57', '2020-07-10 04:14:57'),
(63, 6, 1595676060, 1595676060, '2020-07-25', '11:21', 60, NULL, NULL, 0, '2020-07-25 11:23:05', '2020-07-25 11:23:05'),
(64, 6, 1595762460, 1595762460, '2020-07-26', '11:21', 60, NULL, NULL, 0, '2020-07-25 11:23:05', '2020-07-25 11:23:05'),
(65, 7, 1595676060, 1595676060, '2020-07-25', '11:21', 60, NULL, NULL, 0, '2020-07-25 11:24:10', '2020-07-25 11:24:10'),
(66, 7, 1595762460, 1595762460, '2020-07-26', '11:21', 60, NULL, NULL, 0, '2020-07-25 11:24:10', '2020-07-25 11:24:10'),
(67, 8, 1595164080, 1595164080, '2020-07-19', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
(68, 8, 1595250480, 1595250480, '2020-07-20', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
(69, 8, 1595336880, 1595336880, '2020-07-21', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
(70, 8, 1595423280, 1595423280, '2020-07-22', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
(71, 8, 1595509680, 1595509680, '2020-07-23', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
(72, 8, 1595596080, 1595596080, '2020-07-24', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
(73, 8, 1595682480, 1595682480, '2020-07-25', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
(74, 8, 1595768880, 1595768880, '2020-07-26', '13:08', 30, NULL, NULL, 0, '2020-07-25 13:08:03', '2020-07-25 13:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `language_name` varchar(255) DEFAULT NULL,
  `ch_language_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language_name`, `ch_language_name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Chinese', '中文', 0, NULL, '2020-07-20 22:54:47'),
(2, 'English', '英語', 0, NULL, NULL),
(3, 'Hindi', '印地語', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level_of_student`
--

CREATE TABLE `level_of_student` (
  `id` int(11) NOT NULL,
  `level_of_student_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ch_level_of_student_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_of_student`
--

INSERT INTO `level_of_student` (`id`, `level_of_student_name`, `ch_level_of_student_name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Primary', '主', 0, NULL, '2020-07-19 04:21:52'),
(2, 'Intermediate', '中間', 0, NULL, NULL),
(3, 'University', '大學', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_07_25_160223_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0b23c819-fad4-40a2-9a51-3f1439ec2637', 'App\\Notifications\\StudentNotification', 'App\\Models\\UsersModel', 2, '{\"type\":\"request\",\"common_id\":6,\"message\":\"Your request has been Approved\"}', NULL, '2020-07-25 13:01:03', '2020-07-25 13:01:03'),
('112272a3-0fdf-473e-95d8-cb4d84010003', 'App\\Notifications\\StudentNotification', 'App\\Models\\UsersModel', 2, '{\"type\":\"request\",\"common_id\":6,\"message\":\"Your request has been Pending\"}', NULL, '2020-07-25 13:00:57', '2020-07-25 13:00:57'),
('1b4daa69-cea1-45bf-9bc6-8e12140dcb44', 'App\\Notifications\\TeacherNotification', 'App\\Models\\UsersModel', 1, '{\"type\":\"course\",\"common_id\":7,\"message\":\"Your course has been Approved\"}', NULL, '2020-07-25 13:04:06', '2020-07-25 13:04:06'),
('5a836fbc-1756-48e0-be20-d86177e55a69', 'App\\Notifications\\TeacherNotification', 'App\\Models\\UsersModel', 1, '{\"type\":\"offer\",\"common_id\":5,\"message\":\"Your offer has been Pending\"}', NULL, '2020-08-11 10:50:21', '2020-08-11 10:50:21'),
('65e2d2ed-380b-471f-b467-88f7ca8eaf50', 'App\\Notifications\\CommonNotification', 'App\\Models\\UsersModel', 1, '{\"type\":\"course\",\"common_id\":8,\"message\":\"Hardik D created new course\"}', NULL, '2020-07-25 13:08:03', '2020-07-25 13:08:03'),
('7b33e728-5d4e-4dcb-923c-f4efc7254c62', 'App\\Notifications\\CommonNotification', 'App\\Models\\UsersModel', 2, '{\"type\":\"request\",\"common_id\":7,\"message\":\"Student M created new request\"}', NULL, '2020-07-25 13:10:05', '2020-07-25 13:10:05'),
('7c5411f2-10bf-4423-a111-58b01d65cf09', 'App\\Notifications\\TeacherNotification', 'App\\Models\\UsersModel', 1, '{\"type\":\"offer\",\"common_id\":5,\"message\":\"Your offer has been Approved\"}', NULL, '2020-08-11 10:50:24', '2020-08-11 10:50:24'),
('8756d2b0-fcf6-42cc-8f37-551be1319865', 'App\\Notifications\\StudentNotification', 'App\\Models\\UsersModel', 2, '{\"type\":\"offer\",\"common_id\":5,\"message\":\"You have reiceved new offer\"}', NULL, '2020-08-11 10:50:24', '2020-08-11 10:50:24'),
('9fded7b3-4e74-4fd2-99fb-60ff49494a81', 'App\\Notifications\\TeacherNotification', 'App\\Models\\UsersModel', 1, '{\"type\":\"course\",\"common_id\":7,\"message\":\"Your course has been Rejected\"}', NULL, '2020-07-25 13:04:03', '2020-07-25 13:04:03'),
('bf0eb9d7-08d8-4e2a-923d-e1ff36e3685d', 'App\\Notifications\\TeacherNotification', 'App\\Models\\UsersModel', 1, '{\"type\":\"course\",\"common_id\":3,\"message\":\"Your course has been Approved\"}', NULL, '2020-07-25 13:04:11', '2020-07-25 13:04:11'),
('dee0ae40-f7e7-4d36-9708-6fca048cb921', 'App\\Notifications\\TeacherNotification', 'App\\Models\\UsersModel', 1, '{\"type\":\"course\",\"common_id\":6,\"message\":\"Your course has been Approved\"}', NULL, '2020-07-25 13:04:09', '2020-07-25 13:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT 0,
  `level_id` int(11) NOT NULL DEFAULT 0,
  `lesson_type_id` int(11) NOT NULL DEFAULT 0,
  `student_id` int(11) DEFAULT NULL,
  `request_id` int(11) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lesson_date` int(11) NOT NULL,
  `lesson_time` int(11) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `lesson_per_rate` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_video_new` varchar(255) DEFAULT NULL,
  `meeting_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=panding, 2=approve, 3=reject',
  `is_complete` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:incomplete, 2, Complete',
  `is_notification` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=off, 1=teacher_notification, 2=admin_notification, 3=student_noification',
  `trans_id` varchar(255) DEFAULT NULL,
  `is_payment` tinyint(4) NOT NULL DEFAULT 0,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `transaction_id`, `user_id`, `category_id`, `language_id`, `level_id`, `lesson_type_id`, `student_id`, `request_id`, `course_id`, `title`, `start_date`, `start_time`, `lesson_date`, `lesson_time`, `duration`, `lesson_per_rate`, `description`, `course_video_new`, `meeting_id`, `meeting_password`, `status`, `is_complete`, `is_notification`, `trans_id`, `is_payment`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '7', 1, 2, 2, 2, 2, 2, 3, '4', 'I Need Good Tutor', '2021-05-29', '14:32', 1622298720, 1622298720, 30, '0', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre...', NULL, NULL, NULL, 2, 2, 1, NULL, 1, 0, '2020-07-17 07:23:28', '2020-07-23 06:13:34'),
(2, NULL, 1, 2, 2, 1, 1, 22, NULL, NULL, 'CBT Video Courses | An IELTS Medical Website', '2022-08-19', '22:10', 1660947000, 1660947000, 10, '20', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', NULL, NULL, NULL, 1, 1, 0, NULL, 0, 0, '2020-07-17 23:12:30', '2020-07-24 10:10:16'),
(3, '9', 1, 2, 2, 2, 1, 2, NULL, NULL, 'CBT Video Courses | An IELTS Medical Website', '2021-06-28', '20:28', 1624912080, 1624912080, 60, '20', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', NULL, NULL, NULL, 2, 1, 1, 'pi_1H8qxXKVe94DqL8VbnzK2gLS', 1, 0, '2020-07-25 11:29:49', '2020-07-25 12:14:49'),
(5, '11', 1, 2, 2, 2, 2, 2, 2, '5', 'I Need Good Tutor', '2021-05-29', '14:17', 1622297820, 1622297820, 30, '0', 'If not, please set up your own rate according to students request.', NULL, NULL, NULL, 2, 1, 1, NULL, 1, 0, '2020-07-25 11:53:12', '2020-08-11 10:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders_course_home_work`
--

CREATE TABLE `orders_course_home_work` (
  `id` int(11) NOT NULL,
  `order_course_id` varchar(255) DEFAULT NULL,
  `offer_id` varchar(255) DEFAULT NULL,
  `lesson_date` int(11) DEFAULT NULL,
  `lesson_time` int(11) DEFAULT NULL,
  `lesson_start_date` date DEFAULT NULL,
  `lesson_time_date` varchar(255) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment_complete` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_complete` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `complete_date` int(11) DEFAULT NULL,
  `is_complete` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL DEFAULT 'course' COMMENT 'course,offer',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_course_home_work`
--

INSERT INTO `orders_course_home_work` (`id`, `order_course_id`, `offer_id`, `lesson_date`, `lesson_time`, `lesson_start_date`, `lesson_time_date`, `title`, `description`, `attachment`, `attachment_complete`, `description_complete`, `complete_date`, `is_complete`, `type`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, 1594859040, 1594859040, '2020-07-16', '00:24', '仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', '20200716175206b10hwnkfjucl4opwnsfaa37kkgf80f.jpeg', NULL, NULL, NULL, 0, 'course', '2020-07-16 17:52:06', '2020-07-16 17:52:06'),
(2, '1', NULL, 1594946880, 1594946880, '2020-07-17', '00:48', 'CBT Video Courses | An IELTS Medical Website', 'CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website', NULL, '20200716184927p2qad5fn9q5ssevw83c7gjgkfdeycf.jpeg', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶   仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', 1594925367, 1, 'course', '2020-07-16 18:17:44', '2020-07-16 18:49:27'),
(3, NULL, '1', 1594809240, 1594809240, '2020-07-15', '10:34', 'CBT Video Courses | An IELTS Medical Website', 'CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical WebsiteCBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website', NULL, NULL, NULL, NULL, 0, 'offer', '2020-07-18 04:03:46', '2020-07-18 04:03:46'),
(4, NULL, '1', 1595586900, 1595586900, '2020-07-24', '10:35', '仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', NULL, '202007180439164lerjqcombwrbinrxb8zlie8fkcmin.jpeg', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', 1595047156, 1, 'offer', '2020-07-18 04:04:10', '2020-07-18 04:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_course`
--

CREATE TABLE `order_course` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `lesson_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `level_of_student_id` int(11) NOT NULL,
  `lesson_type_id` int(11) NOT NULL,
  `lesson_per_rate` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_payment` tinyint(4) NOT NULL DEFAULT 0,
  `trans_id` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_course`
--

INSERT INTO `order_course` (`id`, `transaction_id`, `lesson_id`, `course_id`, `student_id`, `user_id`, `subject_id`, `booking_id`, `level_of_student_id`, `lesson_type_id`, `lesson_per_rate`, `description`, `is_payment`, `trans_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '5', 61, 3, 2, 1, 3, 1, 2, 1, '25', 'Time zone changed automatically, so the available time has been changed to your local time automatically. Time zone changed automatically, so the available time has been changed to your local time automatically.', 1, 'pi_1H5bCjKVe94DqL8VKQMh5rXn', 1, '2020-07-16 12:19:08', '2020-07-17 23:43:51'),
(2, '8', 66, 7, 2, 1, 13, 1, 1, 1, '30', 'Time zone changed automatically, so the available time has been changed to your local time automatically', 1, 'pi_1H8qqMKVe94DqL8VCo1IjORo', 1, '2020-07-25 11:37:29', '2020-07-25 11:37:54'),
(3, '10', 66, 7, 2, 1, 13, 1, 2, 1, '30', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', 1, 'pi_1H8rokKVe94DqL8V3TSSKtvA', 1, '2020-07-25 12:39:53', '2020-07-25 12:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_course_note`
--

CREATE TABLE `order_course_note` (
  `id` int(11) NOT NULL,
  `order_course_id` varchar(255) DEFAULT NULL,
  `offer_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(25) NOT NULL DEFAULT 'course' COMMENT 'course, offer',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_course_note`
--

INSERT INTO `order_course_note` (`id`, `order_course_id`, `offer_id`, `user_id`, `title`, `message`, `type`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, '1', 'CBT Video Courses | An IELTS Medical Website', 'CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website', 'course', '2020-07-16 17:51:24', '2020-07-16 17:51:24'),
(2, '1', NULL, '1', '仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', 'course', '2020-07-16 17:51:35', '2020-07-16 17:51:35'),
(3, '1', NULL, '2', 'CBT Video Courses | An IELTS Medical Website', 'CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website', 'course', '2020-07-16 18:47:52', '2020-07-16 18:47:52'),
(4, '1', NULL, '2', '仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', 'course', '2020-07-16 18:48:07', '2020-07-16 18:48:07'),
(5, NULL, '1', '1', '仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', 'offer', '2020-07-18 04:06:00', '2020-07-18 04:06:00'),
(6, NULL, '1', '1', 'CBT Video Courses | An IELTS Medical Website', 'CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website', 'offer', '2020-07-18 04:06:16', '2020-07-18 04:06:16'),
(7, NULL, '1', '2', '仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶  仲泽 饶 仲泽 饶 仲泽 饶  仲泽 饶 仲泽 饶 仲泽 饶仲泽 饶 仲泽 饶 仲泽 饶', 'offer', '2020-07-18 04:40:25', '2020-07-18 04:40:25'),
(8, '1', NULL, '24', 'Test Hardik', 'Test Hardik Test Hardik Test Hardik', 'course', '2020-07-19 10:09:24', '2020-07-19 10:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Total Earing', 'total_earing', NULL, NULL),
(2, 'Net Profit', 'net_profit', NULL, NULL),
(3, 'Withdraw Request', 'withdraw_request', NULL, NULL),
(4, 'Email Marketing', 'email_marketing', NULL, NULL),
(5, 'Pending Offers', 'pending_offers', NULL, NULL),
(6, 'Pending Courses', 'pending_courses', NULL, NULL),
(7, 'Pending Requests', 'pending_requests', NULL, NULL),
(8, 'Total Tutor', 'total_tutor', NULL, NULL),
(9, 'Total Student', 'total_student', NULL, NULL),
(10, 'Total Category', 'total_category', NULL, NULL),
(11, 'Total Offer', 'total_offer', NULL, NULL),
(12, 'Total Admin', 'total_admin', NULL, NULL),
(13, 'Total Booked Lesson', 'total_booked_lesson', NULL, NULL),
(14, 'New Report', 'new_report', NULL, NULL),
(15, 'System Setting', 'system_setting', NULL, NULL),
(16, 'Offer Page', 'offer_page', NULL, NULL),
(17, 'Courses Page', 'courses_page', NULL, NULL),
(18, 'Withdraw Request Page', 'withdraw_request_page', NULL, NULL),
(19, 'Email Marketing Page', 'email_marketing_page', NULL, NULL),
(20, 'Request Page', 'request_page', NULL, NULL),
(21, 'Tutor Page', 'tutor_page', NULL, NULL),
(22, 'Student Page', 'student_page', NULL, NULL),
(23, 'Category Page', 'category_page', NULL, NULL),
(24, 'Admin Page', 'admin_page', NULL, NULL),
(25, 'Lesson Page', 'lesson_page', NULL, NULL),
(26, 'Report Page', 'report_page', NULL, NULL),
(27, 'Chat Page', 'chat_page', NULL, NULL),
(28, 'Notification Page', 'notification_page', NULL, NULL),
(29, 'SEO Page', 'seo_page', NULL, NULL),
(30, 'Conatct us Page', 'contact_us_page', NULL, NULL),
(31, 'Social ICON Page', 'social_icon_page', NULL, NULL),
(32, 'Staff Activity Page', 'staff_report_page', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `min_price` int(11) DEFAULT NULL,
  `max_price` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `min_price`, `max_price`, `created_at`, `updated_at`) VALUES
(1, 15, 50, NULL, NULL),
(2, 51, 80, NULL, NULL),
(3, 81, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report_chat`
--

CREATE TABLE `report_chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `reason` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_chat`
--

INSERT INTO `report_chat` (`id`, `sender_id`, `receiver_id`, `chat_id`, `reason`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 75, 'testing data', '2020-07-14 13:30:04', '2020-07-14 13:30:04'),
(2, 1, 2, 74, 'Message Message Message Message Message Message Message', '2020-07-14 13:31:42', '2020-07-14 13:31:42'),
(3, 1, 2, 74, 'fdsfds fsdfds', '2020-07-14 13:32:35', '2020-07-14 13:32:35'),
(4, 1, 2, 75, 'Formats a HTML string/file with your desired indentation level.', '2020-07-14 13:33:26', '2020-07-14 13:33:26'),
(5, 1, 2, 75, 'Formats a HTML string/file with your desired indentation level.', '2020-07-14 13:33:37', '2020-07-14 13:33:37'),
(6, 1, 2, 85, 'this guys fack', '2020-07-14 13:49:08', '2020-07-14 13:49:08'),
(7, 1, 2, 120, 'gdfgfdg', '2020-07-25 06:35:17', '2020-07-25 06:35:17'),
(8, 2, 1, 118, 'dfsgfdg gdfgfd', '2020-07-25 06:35:21', '2020-07-25 06:35:21'),
(9, 1, 2, 88, 'asdfasdf', '2020-07-25 19:37:31', '2020-07-25 19:37:31'),
(10, 2, 24, 59, 'yes i am busy', '2020-07-25 19:49:21', '2020-07-25 19:49:21'),
(11, 2, 24, 56, 'hello i am teasing', '2020-07-25 19:49:34', '2020-07-25 19:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_type_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `level_of_student_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `category_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `language_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lesson_date` int(11) NOT NULL,
  `lesson_time` int(11) NOT NULL,
  `lesson_start_date` date DEFAULT NULL,
  `lesson_start_time` varchar(255) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `request_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `rate_per_hour` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `request_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=panding, 2=approve, 3=reject',
  `is_notification` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=off, 1=student_notification, 2=admin_notification',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active , 1: delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `user_id`, `request_type_id`, `level_of_student_id`, `category_id`, `language_id`, `lesson_date`, `lesson_time`, `lesson_start_date`, `lesson_start_time`, `duration`, `request_title`, `rate_per_hour`, `request_description`, `status`, `is_notification`, `is_delete`, `created_at`, `updated_at`) VALUES
(2, 2, '2', '2', '2', '2', 1622297820, 1622297820, '2021-05-29', '14:17', 30, 'I Need Good Tutor', '20', 'Students will create their request for lessons. Any teachers can send offer to students. Once student accept your offer that is the time to start your online lessons. Now find your students and send the offer.  Students will create their request for lessons. Any teachers can send offer to students. Once student accept your offer that is the time to start your online lessons. Now find your students and send the offer.   Students will create their request for lessons. Any teachers can send offer to students. Once student accept your offer that is the time to start your online lessons. Now find your students and send the offer. Students will create their request for lessons. Any teachers can send offer to students. Once student accept your offer that is the time to start your online lessons. Now find your students and send the offer.  Students will create their request for lessons. Any teachers can send offer to students. Once student accept your offer that is the time to start your online lessons. Now find your students and send the offer.   Students will create their request for lessons. Any teachers can send offer to students. Once student accept your offer that is the time to start your online lessons. Now find your students and send the offer.', 2, 2, 1, '2020-06-30 06:19:18', '2020-07-07 10:48:34'),
(3, 2, '2', '2', '2', '2', 1622298720, 1622298720, '2021-05-29', '14:32', 30, 'I Need Good Tutor', '20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre', 2, 1, 0, '2020-06-30 06:34:55', '2020-07-25 12:58:00'),
(4, 2, '2', '2', '2', '2', 1533929820, 1533929820, '2018-08-10', '19:37', 50, 'I Need Good Tutor', '20', '(Time zone changed automatically, so the available time has been changed to your local time automatically.)', 2, 1, 0, '2020-07-11 00:41:21', '2020-07-23 06:09:28'),
(5, 2, '1', '2', '1', '1', 1596093720, 1596093720, '2020-07-30', '07:22', 60, '请求名称', '95', '你想学习什 么 你想学习 什么  你想学习  什么 想学 习什么', 2, 1, 0, '2020-07-24 08:21:41', '2020-07-25 12:57:55'),
(6, 2, '1', '2', '1', '2', 1508835540, 1508835540, '2017-10-24', '08:59', 30, 'I Need Good Tutor', '20', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', 2, 1, 0, '2020-07-25 11:01:37', '2020-07-25 13:01:03'),
(7, 2, '1', '2', '2', '2', 1630148820, 1630148820, '2021-08-28', '11:07', 30, 'I Need Good Tutor', '20', 'Time zone changed automatically, so the available time has been changed to your local time automatically.', 1, 2, 0, '2020-07-25 13:10:05', '2020-07-25 13:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `request_type`
--

CREATE TABLE `request_type` (
  `id` int(11) NOT NULL,
  `request_type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ch_request_type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_type`
--

INSERT INTO `request_type` (`id`, `request_type_name`, `ch_request_type_name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Regular', '定期', 0, NULL, NULL),
(2, 'One off', '一關', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `slug`, `title`, `description`, `keyword`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Home - VISFFOR', '', '', '2020-07-24 22:30:08', '2020-07-25 11:38:39'),
(2, 'find-student', 'Find Student - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(3, 'find-tutor', 'Find Tutor - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(4, 'become-tutor', 'Become A Tutor - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(5, 'signup', 'Signup - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(6, 'become-student', 'Become A Student - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(7, 'login', 'Login - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(8, 'forgot-password', 'Forgot Password - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(9, 'reset-password', 'Reset Password - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(10, 'about', 'About us - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(11, 'contact-us', 'Contact Us - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(12, 'why-us', 'WHY Us - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(13, 'privacy', 'Privacy Policy - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08'),
(14, 'terms', 'Terms & Conditions - VISfForStudy', '', '', '2020-07-24 22:30:08', '2020-07-24 22:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `paypal_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `paypal_type` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'live,sandbox',
  `paypal_live` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_sandbox` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `system_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `system_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `paypal_email`, `paypal_type`, `paypal_live`, `paypal_sandbox`, `system_email`, `system_name`, `created_at`, `updated_at`) VALUES
(1, 'hardikbusiness@gmail.com', 'sandbox', 'https://www.paypal.com/cgi-bin/webscr?', 'https://www.sandbox.paypal.com/cgi-bin/webscr?', 'hardikdayani1@gmail.com', 'visfforstudy', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smtp`
--

CREATE TABLE `smtp` (
  `id` int(11) NOT NULL,
  `protocol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smtp`
--

INSERT INTO `smtp` (`id`, `protocol`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`) VALUES
(1, 'smtp', 'smtp.mailtrap.io', '465', '68a2f1b36dd521', '8cd41ba70e2e5b'),
(2, 'smtp', 'ssl://smtp.gmail.com', '465', 'support@eduvisffor.com', 'chengzhang1990');

-- --------------------------------------------------------

--
-- Table structure for table `social_icon`
--

CREATE TABLE `social_icon` (
  `id` int(11) NOT NULL,
  `icon_name` varchar(255) DEFAULT NULL,
  `social_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_icon`
--

INSERT INTO `social_icon` (`id`, `icon_name`, `social_link`, `created_at`, `updated_at`) VALUES
(1, 'fab fa-facebook-f', 'https://www.facebook.com/', '2020-07-04 04:50:20', '2020-07-03 23:20:15'),
(2, 'fab fa-twitter', 'https://twitter.com/', '2020-07-04 04:50:20', '2020-07-03 23:20:02'),
(3, 'fab fa-instagram', 'https://www.instagram.com/', '2020-07-04 05:44:10', '2020-07-04 05:44:22'),
(4, 'fab fa-linkedin-in', 'https://www.linkedin.com/', '2020-07-04 04:50:20', '2020-07-03 23:20:15'),
(5, 'fab fa-youtube', 'https://www.youtube.com/', '2020-07-04 05:43:53', '2020-07-04 05:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ch_status_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`, `ch_status_name`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'Pending', '待定', '#000000', '2020-07-02 01:14:15', '2020-07-02 01:14:15'),
(2, 'Approved', '已批准', '#008000', '2020-07-02 01:14:15', '2020-07-02 01:14:15'),
(3, 'Rejected', '拒絕', '#FF0000', '2020-07-02 01:16:30', '2020-07-02 01:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active , 1: delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `course_id`, `subject_name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Basic English', 0, '2020-06-30 01:31:09', '2020-06-30 01:31:09'),
(2, 2, 'Student', 0, '2020-06-30 13:41:31', '2020-06-30 13:41:31'),
(3, 3, 'Testing Data', 0, '2020-06-30 14:02:21', '2020-06-30 14:02:21'),
(4, 4, 'fsdfsf', 1, '2020-07-01 11:55:03', '2020-07-01 13:50:03'),
(5, 4, 'fsdfdfdsfd', 1, '2020-07-01 11:57:52', '2020-07-01 13:50:06'),
(9, 4, 'English', 1, '2020-07-01 13:22:49', '2020-07-07 10:59:48'),
(10, 4, 'Match', 1, '2020-07-01 13:22:49', '2020-07-07 10:59:48'),
(11, 5, 'English subject', 0, '2020-07-10 00:27:27', '2020-07-10 00:27:27'),
(12, 6, 'fsdfsf', 0, '2020-07-25 11:23:05', '2020-07-25 11:23:05'),
(13, 7, 'fsdfsf', 0, '2020-07-25 11:24:10', '2020-07-25 11:24:10'),
(14, 8, 'English subject', 0, '2020-07-25 13:08:02', '2020-07-25 13:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_email`
--

CREATE TABLE `subscribe_email` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe_email`
--

INSERT INTO `subscribe_email` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'hardikdayani1@gmail.com', '2020-07-01 07:26:24', '2020-07-01 07:26:24'),
(2, 'vipuldayani55@gmail.com', '2020-07-01 07:27:07', '2020-07-01 07:27:07'),
(3, 'hardikdassdsyani1@gmail.com', '2020-07-13 12:14:53', '2020-07-13 12:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `offer_id` varchar(255) DEFAULT NULL,
  `order_course_id` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL DEFAULT '0',
  `fee_amount` varchar(255) NOT NULL DEFAULT '0',
  `total_amount` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(25) DEFAULT 'offer' COMMENT 'offer,course',
  `is_date` tinyint(4) NOT NULL DEFAULT 0,
  `release_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `student_id`, `offer_id`, `order_course_id`, `trans_id`, `amount`, `fee_amount`, `total_amount`, `type`, `is_date`, `release_date`, `created_at`, `updated_at`) VALUES
(5, '1', '2', NULL, '1', 'pi_1H5bCjKVe94DqL8VKQMh5rXn', '21.25', '3.75', '25', 'course', 0, '2020-08-02', '2020-07-16 17:49:31', '2020-07-18 05:13:51'),
(7, '1', '2', '1', NULL, '', '0', '0', '0', 'offer', 0, '2020-08-02', '2020-07-18 04:56:37', '2020-07-18 05:07:56'),
(8, '1', '2', NULL, '2', 'pi_1H8qqMKVe94DqL8VCo1IjORo', '25.5', '4.5', '30', 'course', 0, NULL, '2020-07-25 17:07:54', '2020-07-25 17:07:54'),
(9, '1', '2', '3', NULL, 'pi_1H8qxXKVe94DqL8VbnzK2gLS', '17', '3', '20', 'offer', 0, NULL, '2020-07-25 17:15:17', '2020-07-25 17:15:17'),
(10, '1', '2', NULL, '3', 'pi_1H8rokKVe94DqL8V3TSSKtvA', '25.5', '4.5', '30', 'course', 0, NULL, '2020-07-25 18:10:12', '2020-07-25 18:10:12'),
(11, '1', '2', '5', NULL, '', '0', '0', '0', 'offer', 0, NULL, '2020-07-25 18:15:48', '2020-07-25 18:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_us` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `qulification_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `level_of_teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_of_teacher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hour_per_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(3) NOT NULL DEFAULT 1 COMMENT '1:Admin, 2:Teacher, 3:Student, 4:superadmin',
  `status` tinyint(3) NOT NULL DEFAULT 0 COMMENT '0:Inactive, 1:Active',
  `token` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `fee_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `net_income` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `available_for_withdraw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `withdrawn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `paypal` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_of_card` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_online` tinyint(4) NOT NULL DEFAULT 0,
  `ratingavg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `profile_pic`, `about_us`, `qulification_id`, `category_id`, `country_id`, `level_of_teacher`, `experience_of_teacher`, `hour_per_rate`, `remember_token`, `is_admin`, `status`, `token`, `total_amount`, `fee_amount`, `net_income`, `available_for_withdraw`, `withdrawn`, `paypal`, `bank_name`, `account_number`, `sort_code`, `name_of_card`, `timezone`, `is_online`, `ratingavg`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Hardik', 'Dayani', 'teacher@gmail.com', NULL, '$2y$10$4uEvUPMIw5Og36lO0vTrHOarajqk1Lpqw4.arPwLAkNKbcWevdL3C', 'mcjwjbfj20u7oofgvbgetdeqzsepbl.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua', NULL, 1, 2, '1', '3', '20', 'Um5nQObX0Lp6hNpObpDroQYmTTkIgafsDuIdcG8YheIl67jiu3eZLpKpACrr', 2, 1, 'JTHRnJTzS0c76Xxx903PxYQlUTI0eEse3PIo01Ve1', '105', '15.75', '89.25', '0', '0', 'hardiktest@gmail.com', 'SBI', '9979133538', '123456', 'Hardik Dayani Dayani', 'Asia/Kolkata', 0, '0', 0, '2020-06-25 01:57:36', '2020-07-25 11:45:58'),
(2, 'student', 'Mahesh', 'student@gmail.com', NULL, '$2y$10$HtnhvhKTQ6UpYfq8iID4ze4H3UBoYGjp7MH8qLC.lBhFzLEuF4Xr2', 'student-profile-2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.', NULL, 2, 2, '2', '2', '15', 'pNVtQiMuek5qDBTf4Er2YGF9KJPDaL2lWCkvtMwmAuyfdlaxd59ItYwizAkX', 3, 1, 'k9sAQwXdKWVoKPQynLyCliWqYPdcjMR4v6wWSiwT2', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-25 01:58:00', '2020-07-25 11:50:02'),
(3, 'Admin', 'Keval', 'admin@gmail.com', NULL, '$2y$10$Oh0vFwOHOBOj6RwXzrTXseI2jmVJMRbXTWMJ3avxbgnAWQ8QW7qta', 'student-profile-1.jpg', '  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.', NULL, 3, 1, '3', '4', '20', 'iphytHxPuNf3QKJINb3GDVGqjQRlKsGsIoHDuDjpQTSgWFhuLtz41IiHxoRc', 1, 1, 'a4k3kLNfjJc61RxhgxXVhd0MZPUbRiJzJABefPri3', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-25 01:58:41', '2020-09-21 03:00:00'),
(8, 'Work name', 'Last Name', 'studessnt@gmail.com', NULL, '$2y$10$HtnhvhKTQ6UpYfq8iID4ze4H3UBoYGjp7MH8qLC.lBhFzLEuF4Xr2', 'tj4v0eaoffq7sq0pukfs3fdel5iuwx.jpg', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'L94MmbLMjsR6BF4TqIoYA1mOXwucQx3zYOuwKxRbvKArmLH6SaJpx6Kx6AKx', 1, 1, 'sdfdfggffgfd', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 00:50:16', '2020-07-14 05:15:11'),
(10, 'Work named', 'Ld', 'studessntss@gmail.com', NULL, '$2y$10$6rBHZAraOlZEHt1aavMyCOcr0OZFcC7ni3GvDC6DO02KAzXnaAY1W', '', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 1, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 01:15:39', '2020-06-28 01:17:30'),
(11, 'Work namedas', 'data', 'student1@gmail.com', NULL, '$2y$10$B6jbbrCS7TODfuMylh5V0.jntQPlYBa/nZ8yHH1MJTBGBAqGJnleS', 'o1d0zio1ogvwit85zsgaejt72xivlx.jpg', 'fdfds', NULL, 2, 1, '3', NULL, NULL, 'M3MkxVYAl7mSyDK9pgvZh7HCWl3nP0zPFKEsab5hhmeXiT1wfB8UYXIyOJdk', 3, 1, 'fsdfsdggdfgdfg', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 01:15:51', '2020-07-25 06:43:29'),
(12, 'admin', 'Last Name', 'admfvdsfdsgdfin@gmail.com', NULL, '$2y$10$BonPuZiySV3Zh3Mc6Z6r3Od6unl7OAVk2zNfN38RpKxzw3L5P8qiq', 'c2iyexwcp4agy1yi0w16rdwle2lzau.jpg', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 0, 'fgdsfdfd', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 01:28:31', '2020-06-28 01:28:31'),
(13, 'admin', 'Rameshbhai dayani', 'addfddmin@gmail.com', NULL, '$2y$10$EE.Hl.qypZIorM2K9mI.o.Avn2iyPpqTDKSLcn7SVUUXoiOcPKjhS', 'i6od8p6ycoi6hpaqib89mhfxsf99jy.jpg', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 0, 'hfghggfhf', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 01:29:05', '2020-06-28 01:29:05'),
(15, 'Patel', 'mohan', 'email2@gmail.com', NULL, '$2y$10$1gQm352QybkvDsrvKRlr3.bQ9lRJm7QmWIjfehS9XU4fZOFDSG9zK', 'egy4eh72sw6fwpvthfpn06uyqkd5fw.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 2, 1, '2', NULL, NULL, 'XgBQfnkkc96atU9wtlWaBoAVGHOwUABbZkBWQiNqaU7DSJEb0XQRMRPiP5Ip', 2, 1, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 05:21:42', '2020-07-04 00:33:07'),
(16, 'admin', NULL, 'a23dmin@gmail.com', NULL, '$2y$10$JAux4zbc7jCgnRbR.pe1b.Y4tfHEWEqfCzekHLNd6UUM/a5vrGdAm', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 0, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 22:26:01', '2020-06-28 22:26:01'),
(17, 'Work name', NULL, 'adsmisanpanel@gmail.com', NULL, '$2y$10$7FKccphXRRkDIxljco9H3uCRhXGx0tN/5A2aqI10TKbgyLmIebxyC', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 3, 0, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-28 22:28:31', '2020-06-28 22:28:31'),
(18, 'Admin', 'Popat', 'adminpopat@gmail.com', NULL, '$2y$10$lk0hw0Hbi3sGg1irTavMHeKelRUmpOPVZBadOdh9hLG/t65j50bbO', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 0, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-29 04:05:16', '2020-06-29 04:05:16'),
(19, 'Hardik', 'Dayani', 'hardikdayani1@gmail.com', NULL, '$2y$10$djik8mEwccsui2tpnyvbDuqbB1Kobd1WtB7t2GyZ7QeJTMnSgdDU6', '55af0v4lkyomiljwq0resykexgxfy4.jpg', 'test test', NULL, 2, 1, '3', NULL, NULL, 'eK9IcnL1rNePaqRdfVNQ08N5u9YyWn7SiDHDqrOoAZ4JrPkz3T', 2, 1, 'WoFRwGG0e6CIIKMiz6ySOzurNpbQzQ3iKOWFndvQ19', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-29 12:18:49', '2020-07-23 01:36:31'),
(20, 'Hardik', 'Dayani', '123hardikdayani1@gmail.com', NULL, '$2y$10$qMdSYMJ2CWs8DoCnyzc2euXFB9tbWnUqOvEwLlne9bFVi7MGvzzmK', 'linmnvk49brmyi1jdks7jyvtq4zlrl.jpg', 'fsdfsdf', NULL, 1, 1, '2', NULL, NULL, NULL, 3, 1, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-29 12:37:02', '2020-07-04 00:20:31'),
(21, 'HArdik', NULL, 'hardikdsayani1@gmail.com', NULL, '$2y$10$oj/mg8ExueE58ZNYVJUnxukNauyhbgEuDSQ0KQprW.pzBFCAnqpjq', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 2, 0, '2ChW6qeCuipoOd6PvAXSAT3Ff1ANWdmC0NbMIUmD21', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-07-01 01:46:18', '2020-07-01 01:46:18'),
(22, 'Hardik', 'Dayani', 'hardikdayani221@gmail.com', NULL, '$2y$10$HtnhvhKTQ6UpYfq8iID4ze4H3UBoYGjp7MH8qLC.lBhFzLEuF4Xr2', 'nb43cphhbmzr86e84znv0xt5uk6zbo.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute dolor in repre...', NULL, 2, 1, '2', NULL, NULL, 'RflZWvRQPeOdyuNnDMwfCSSqGiHkO5pTjtsjGe00GEIEYHb4LOOTPoP3mOke', 3, 1, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 1, '2020-07-04 12:19:28', '2020-07-25 02:47:07'),
(23, 'Hardik', 'Dayani', 'hardikdayfsdfsani1@gmail.com', NULL, '$2y$10$qHQX57mMBBG4K0X5LB4ndulRlaHf1yGM95jpRHagmKGCYAseZYK5K', 'svsbzz27h9bjvrapitd3s1gdhh4imf.jpg', 'test', NULL, 1, 1, '2', '2', '20', NULL, 2, 1, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-07-04 12:21:33', '2020-07-04 12:21:33'),
(24, 'Super Admin', 'Keval', 'superadmin@gmail.com', NULL, '$2y$10$Oh0vFwOHOBOj6RwXzrTXseI2jmVJMRbXTWMJ3avxbgnAWQ8QW7qta', 'student-profile-1.jpg', '  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in.', NULL, 3, 1, '3', '4', '20', 'eiadgU34IY3gASDt94lj08u3gvwQvhpjLb48GJ0TZjy0uejdIwxaNwNQo9N3', 4, 1, 'UrEDPcVCkrJw17oKVjJeWAyxzLIaEQINK9u1uhx024', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, 'Asia/Kolkata', 0, '0', 0, '2020-06-25 01:58:41', '2020-08-11 10:50:24'),
(25, 'Hardik', NULL, 'admin@game4bitcoin.com', NULL, '$2y$10$YfKxOwdXpH93zcGX/0cgguv0JIFLnmotvAkZCEaxLP1SwQ245wrAW', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'gswgqNiVzI7zyvydR4nTxazzAoHL829D49wYVbyhPd7SBzcwgt', 3, 1, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, '', 0, '0', 0, '2020-07-23 01:46:56', '2020-07-23 01:47:07'),
(26, 'Hardik', NULL, 'adminpanel@gmail.com', NULL, '$2y$10$P0ALz.467GsAH2EobqcCh.iVMnZmMLdphr3wm.afSrCekGuWf/vcO', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '0qS9aK16VuZxyslFfaYezaXS6vfaFVnmiz6QFgCVXGeHhZYbsprHAVlHMZGe', 2, 0, NULL, '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, '', 0, '0', 0, '2020-07-23 01:47:46', '2020-07-23 01:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_availability`
--

CREATE TABLE `user_availability` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `week_id` int(11) DEFAULT NULL,
  `week_session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_availability`
--

INSERT INTO `user_availability` (`id`, `user_id`, `week_id`, `week_session_id`, `created_at`, `updated_at`) VALUES
(26, 1, 5, 1, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(27, 1, 7, 1, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(28, 1, 2, 2, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(29, 1, 5, 2, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(30, 1, 7, 2, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(31, 1, 2, 3, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(32, 1, 3, 3, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(33, 1, 5, 3, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(34, 1, 7, 3, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(35, 1, 1, 4, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(36, 1, 2, 4, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(37, 1, 3, 4, '2020-07-22 08:21:40', '2020-07-22 08:21:40'),
(38, 1, 4, 4, '2020-07-22 08:21:40', '2020-07-22 08:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_language`
--

CREATE TABLE `user_language` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `language_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_language`
--

INSERT INTO `user_language` (`id`, `user_id`, `language_id`, `created_at`, `updated_at`) VALUES
(32, '2', '1', '2020-07-03 12:35:53', '2020-07-03 12:35:53'),
(33, '2', '3', '2020-07-03 12:35:53', '2020-07-03 12:35:53'),
(36, '22', '1', '2020-07-04 17:50:49', '2020-07-04 17:50:49'),
(37, '22', '2', '2020-07-04 17:50:49', '2020-07-04 17:50:49'),
(38, '23', '1', '2020-07-04 17:51:33', '2020-07-04 17:51:33'),
(39, '23', '2', '2020-07-04 17:51:33', '2020-07-04 17:51:33'),
(79, '1', '1', '2020-07-22 12:28:03', '2020-07-22 12:28:03'),
(80, '1', '2', '2020-07-22 12:28:03', '2020-07-22 12:28:03'),
(81, '1', '3', '2020-07-22 12:28:03', '2020-07-22 12:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_note`
--

CREATE TABLE `user_note` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `note_date` date DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_note`
--

INSERT INTO `user_note` (`id`, `user_id`, `note_date`, `title`, `message`, `created_at`, `updated_at`) VALUES
(3, '3', '2020-07-17', 'CBT Video Courses | An IELTS Medical Website', 'CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website', '2020-07-17 06:50:09', '2020-07-17 06:50:09'),
(4, '1', '2020-07-24', 'CBT Video Courses | An IELTS Medical Website', 'CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website CBT Video Courses | An IELTS Medical Website', '2020-07-17 06:54:50', '2020-07-17 06:54:50'),
(5, '2', '2020-07-17', '仲泽 饶 仲泽 饶 仲泽 饶', '仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶 仲泽 饶', '2020-07-17 08:19:02', '2020-07-17 08:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_qualification`
--

CREATE TABLE `user_qualification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `university_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `degree` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `start_year` date DEFAULT NULL,
  `end_year` date DEFAULT NULL,
  `major` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `upload_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_qualification`
--

INSERT INTO `user_qualification` (`id`, `user_id`, `university_name`, `degree`, `start_year`, `end_year`, `major`, `upload_file`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 'Bhavnagar UNI', 'MBA', '2015-08-01', '2018-07-02', 'Finance', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2020-07-03 04:45:36', '2020-07-03 05:50:07'),
(3, 1, 'Bhavnagar UNI', 'MBA', '2016-05-01', '2018-05-02', 'Finance', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-07-03 04:47:26', '2020-07-03 04:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `review_by` varchar(255) DEFAULT NULL,
  `order_course_id` varchar(255) DEFAULT NULL,
  `offer_id` varchar(255) DEFAULT NULL,
  `rating` varchar(255) NOT NULL DEFAULT '1',
  `review` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(25) NOT NULL DEFAULT 'course' COMMENT 'course,offer',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:pending,2:approve,3:reject',
  `admin_id` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL COMMENT 'paypal,bank',
  `payment_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_of_card` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet_history`
--

INSERT INTO `wallet_history` (`id`, `user_id`, `amount`, `status`, `admin_id`, `payment_type`, `payment_id`, `bank_name`, `account_number`, `sort_code`, `name_of_card`, `created_at`, `updated_at`) VALUES
(2, '1', '46.75', 2, '3', 'bank', NULL, 'SBI', '9979133538', '123456', 'Hardik Dayani Dayani', '2020-07-14 05:29:45', '2020-07-19 15:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `week`
--

CREATE TABLE `week` (
  `id` int(11) NOT NULL,
  `week_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `week`
--

INSERT INTO `week` (`id`, `week_name`, `created_at`, `updated_at`) VALUES
(1, 'Mon', NULL, NULL),
(2, 'Tue', NULL, NULL),
(3, 'Wed', NULL, NULL),
(4, 'Thu', NULL, NULL),
(5, 'Fri', NULL, NULL),
(6, 'Sat', NULL, NULL),
(7, 'Sun', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `week_session`
--

CREATE TABLE `week_session` (
  `id` int(11) NOT NULL,
  `week_session_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `week_session_icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `week_session_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `week_session`
--

INSERT INTO `week_session` (`id`, `week_session_name`, `week_session_icon`, `week_session_time`, `created_at`, `updated_at`) VALUES
(1, 'Morning', 'iconic-sun-morning.png', 'Pre 12pm', NULL, NULL),
(2, 'Afternoon', 'iconic-sun-afternoon.png', '12 - 4pm', NULL, NULL),
(3, 'Evening', 'iconic-moon-evening.png', '4 - 7pm', NULL, NULL),
(4, 'Late', 'iconic-moon-late.png', '7 - 10pm', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bigbluebutton`
--
ALTER TABLE `bigbluebutton`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block_chat`
--
ALTER TABLE `block_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_lesson`
--
ALTER TABLE `course_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_of_student`
--
ALTER TABLE `level_of_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_course_home_work`
--
ALTER TABLE `orders_course_home_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_course`
--
ALTER TABLE `order_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_course_note`
--
ALTER TABLE `order_course_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_chat`
--
ALTER TABLE `report_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_type`
--
ALTER TABLE `request_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp`
--
ALTER TABLE `smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_icon`
--
ALTER TABLE `social_icon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe_email`
--
ALTER TABLE `subscribe_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_availability`
--
ALTER TABLE `user_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_language`
--
ALTER TABLE `user_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_note`
--
ALTER TABLE `user_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_qualification`
--
ALTER TABLE `user_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `week_session`
--
ALTER TABLE `week_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bigbluebutton`
--
ALTER TABLE `bigbluebutton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `block_chat`
--
ALTER TABLE `block_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_lesson`
--
ALTER TABLE `course_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `level_of_student`
--
ALTER TABLE `level_of_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders_course_home_work`
--
ALTER TABLE `orders_course_home_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_course`
--
ALTER TABLE `order_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_course_note`
--
ALTER TABLE `order_course_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report_chat`
--
ALTER TABLE `report_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_type`
--
ALTER TABLE `request_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp`
--
ALTER TABLE `smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_icon`
--
ALTER TABLE `social_icon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subscribe_email`
--
ALTER TABLE `subscribe_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_availability`
--
ALTER TABLE `user_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_language`
--
ALTER TABLE `user_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `user_note`
--
ALTER TABLE `user_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_qualification`
--
ALTER TABLE `user_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `week`
--
ALTER TABLE `week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `week_session`
--
ALTER TABLE `week_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
