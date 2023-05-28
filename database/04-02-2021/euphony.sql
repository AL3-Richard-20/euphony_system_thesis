-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 12:12 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `euphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_tbl`
--

CREATE TABLE `about_us_tbl` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Title` varchar(45) NOT NULL,
  `Content` text NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us_tbl`
--

INSERT INTO `about_us_tbl` (`Id`, `Title`, `Content`, `Image`) VALUES
(1, '', '     Euphony Music Center and Studio started at Makati Cinema Square in Pasong Tamo Makati City in the year 2001. This was managed by the founder Ms. ERLINDA M. ALBAY  handles the selling of musical instruments such pianos, guitar, keyboard etc. She also acted as the HR personnel in charge of screening qualified sales staff and hiring of qualified music teachers for the music lesson offered by the company.\r\n\r\nAside from musical services offered the company also engaged in putting up exhibit in different malls within Metro Manila and nearby provinces. These exhibits intensified the campaign promoting the music school and sale of musical instrument.\r\n\r\nAt present time, after almost two decade in the music industry, Euphony Music Center and Studio has expended two to more branches, one at level 1 of Robinsons place Dasmarinas and the most recent one is at level 2 SM City TreceMartires Cavite.', '1585413834.png'),
(2, 'Mission', 'To develop & inspire students to achieve their musical and artistic potential by providing them quality education.', ''),
(3, 'Vision', 'To deliver the highest standard of music and art education that will develop the best musician and artist in each student.', '');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `Trans_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Detail` text NOT NULL,
  `User_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`Trans_Id`, `Date`, `Time`, `Detail`, `User_Id`) VALUES
(93, '2020-04-07', '14:22:50', 'Login to the system', 1),
(94, '2020-04-07', '15:00:22', 'Login to the system', 23),
(95, '2020-04-07', '17:52:28', 'Login to the system', 23),
(96, '2020-04-07', '17:55:13', 'Login to the system', 1),
(97, '2020-04-07', '18:06:34', 'Login to the system', 23),
(98, '2020-04-11', '08:46:16', 'Login to the system', 23),
(99, '2020-04-11', '09:03:31', 'Login to the system', 23),
(100, '2020-04-11', '09:06:38', 'David Paul Ferreras pay for balance (O.R: 1134 / A.R: 1134) - administrator', 25),
(101, '2020-04-12', '14:32:39', 'Login to the system', 23),
(102, '2020-04-12', '15:48:31', 'Login to the system', 23),
(103, '2020-04-12', '15:49:36', 'David Paul Ferreras marked as Present - administrator', 25),
(104, '2020-04-12', '15:53:55', 'Login to the system', 23),
(105, '2020-04-12', '15:54:24', 'Login to the system', 1),
(106, '2020-04-12', '18:51:43', 'Login to the system', 23),
(107, '2020-04-13', '15:44:32', 'Login to the system', 23),
(108, '2020-04-13', '15:52:42', 'Login to the system', 1),
(109, '2020-04-13', '17:37:11', 'Login to the system', 23),
(110, '2020-04-13', '18:03:58', 'Changed profile picture (Administrator)', 23),
(111, '2020-04-13', '18:05:01', 'Changed profile picture (Administrator)', 23),
(112, '2020-04-13', '18:07:49', 'Changed profile picture (Administrator)', 23),
(113, '2020-04-13', '18:31:12', 'Changed profile picture (Administrator)', 23),
(114, '2020-04-14', '11:13:36', 'Login to the system', 23),
(115, '2020-04-14', '14:56:32', 'Login to the system', 23),
(116, '2020-04-14', '15:10:11', 'Changed profile picture (Administrator)', 23),
(117, '2020-04-14', '15:21:31', 'Changed profile picture (Administrator)', 23),
(118, '2020-04-14', '15:22:46', 'Changed profile picture (Administrator)', 23),
(119, '2020-04-14', '15:29:12', 'Rod Mark Reyes pay for balance (O.R: 1132 / A.R: 1132) - administrator', 29),
(120, '2020-04-14', '15:33:17', 'Rod Mark Reyes pay for balance (O.R: 1132 / A.R: 1132) - administrator', 29),
(121, '2020-04-14', '18:28:57', 'Login to the system', 23),
(122, '2020-04-14', '18:47:03', 'David Paul Ferreras marked as Present - administrator', 25),
(123, '2020-04-14', '18:47:20', 'David Paul Ferreras marked as Excused - administrator', 25),
(124, '2020-04-14', '18:47:30', 'David Paul Ferreras marked as Forfeited - administrator', 25),
(125, '2020-04-14', '18:47:39', 'David Paul Ferreras marked as Present - administrator', 25),
(126, '2020-04-14', '18:48:08', 'David Paul Ferreras marked as Present - administrator', 25),
(127, '2020-04-14', '18:58:03', 'David Paul Ferreras pay for balance (O.R: 1131 / A.R: 1131) - administrator', 25),
(128, '2020-04-15', '16:01:41', 'Login to the system', 23),
(129, '2020-04-16', '09:24:12', 'Login to the system', 23),
(130, '2020-04-16', '10:04:54', 'David Paul Ferreras pay for balance (O.R: 1136 / A.R: 1136) - administrator', 25),
(131, '2020-04-16', '10:43:54', 'Login to the system', 1),
(132, '2020-04-16', '10:44:12', 'Login to the system', 23),
(133, '2020-04-16', '13:56:22', 'Login to the system', 23),
(134, '2020-04-16', '16:50:29', 'Login to the system', 23),
(135, '2020-04-16', '18:37:31', 'Login to the system', 23),
(136, '2020-04-17', '13:56:23', 'Login to the system', 1),
(137, '2020-04-24', '18:49:44', 'Login to the system', 23),
(138, '2020-04-27', '11:03:55', 'Login to the system', 23),
(139, '2020-05-02', '10:49:34', 'Login to the system', 23),
(140, '2020-05-07', '17:33:53', 'Login to the system', 1),
(141, '2020-05-16', '22:47:28', 'Login to the system', 23),
(142, '2020-05-17', '18:17:41', 'Login to the system', 1),
(143, '2020-05-18', '17:36:31', 'Login to the system', 23),
(144, '2020-05-18', '17:36:47', 'Login to the system', 1),
(145, '2020-05-21', '11:10:19', 'Login to the system', 23),
(146, '2020-05-22', '14:18:38', 'Login to the system', 23),
(147, '2020-05-22', '17:52:48', 'Login to the system', 23),
(148, '2020-05-22', '18:17:00', 'Login to the system', 23),
(149, '2020-05-24', '11:19:40', 'Login to the system', 23),
(150, '2020-05-24', '11:34:20', 'Login to the system', 23),
(151, '2020-05-24', '11:41:17', 'Login to the system', 23),
(152, '2020-05-24', '13:44:22', 'Login to the system', 1),
(153, '2020-05-24', '13:46:40', 'Login to the system', 23),
(154, '2020-05-24', '14:43:39', 'Login to the system', 1),
(155, '2020-05-24', '14:45:42', 'Login to the system', 23),
(156, '2020-05-24', '14:47:15', 'Japeth De Leon changed a schedule - administrator', 28),
(157, '2020-05-24', '14:48:12', 'Japeth De Leon changed a schedule - administrator', 28),
(158, '2020-05-24', '14:58:15', 'Jonalyn Napod changed a schedule - administrator', 31),
(159, '2020-05-24', '15:03:47', 'Changed profile picture (Administrator)', 23),
(160, '2020-05-24', '15:04:38', 'Richard del Altre changed a lesson - administrator', 33),
(161, '2020-05-24', '15:05:08', 'Richard del Altre changed a lesson - administrator', 33),
(162, '2020-05-24', '15:05:18', 'Richard del Altre changed a schedule - administrator', 33),
(163, '2020-05-24', '15:06:46', 'Richard del Altre marked as Present - administrator', 33),
(164, '2020-05-24', '15:18:23', 'Richard del Altre changed a schedule - administrator', 33),
(165, '2020-05-24', '15:19:01', 'Richard del Altre marked as  - administrator', 33),
(166, '2020-05-24', '15:19:46', 'Richard del Altre marked as Present - administrator', 33),
(167, '2020-05-24', '15:29:21', 'Jonalyn Napod marked as Present - administrator', 31),
(168, '2020-05-24', '15:30:07', 'Christine Joy Balmocena marked as Present - administrator', 30),
(169, '2020-05-24', '15:32:51', 'Japeth De Leon changed a schedule - administrator', 28),
(170, '2020-05-24', '15:33:06', 'Japeth De Leon marked as Present - administrator', 28),
(171, '2020-05-26', '23:18:38', 'Login to the system', 23),
(172, '2020-05-26', '23:41:44', 'Christine Joy Balmocena pay for balance (O.R: 2230 / A.R: 2230) - administrator', 30),
(173, '2020-05-27', '13:32:46', 'Login to the system', 23),
(174, '2020-05-27', '13:58:58', 'Login to the system', 1),
(175, '2020-05-27', '14:22:01', 'Login to the system', 23),
(176, '2020-05-27', '14:24:19', 'Login to the system', 23),
(177, '2020-05-27', '14:55:32', 'Login to the system', 1),
(178, '2020-05-27', '15:13:37', 'Login to the system', 23),
(179, '2020-05-27', '18:17:14', 'Login to the system', 23),
(180, '2020-05-27', '18:27:41', 'Login to the system', 1),
(181, '2020-05-27', '18:29:46', 'Login to the system', 23),
(182, '2020-05-27', '18:34:09', 'Changed profile picture (Administrator)', 23),
(183, '2020-05-27', '18:35:56', 'Edit Richard Montero profile information - administrator', 34),
(184, '2020-05-27', '18:36:15', 'Edit Richard del Altre account information attempt', 23),
(185, '2020-05-27', '18:36:33', 'Edit Richard del Altre account information', 23),
(186, '2020-05-27', '18:36:54', 'Richard del Altre changed a lesson - administrator', 34),
(187, '2020-05-27', '18:37:10', 'Richard del Altre changed a schedule - administrator', 34),
(188, '2020-05-27', '18:37:49', 'Richard del Altre pay for balance (O.R: 1214 / A.R: 1214) - administrator', 34),
(189, '2020-05-27', '18:45:59', 'Edit profile information', 23),
(190, '2020-05-27', '18:46:36', 'Changed profile picture (Administrator)', 23),
(191, '2020-05-27', '21:48:45', 'Login to the system', 1),
(192, '2020-05-28', '13:45:04', 'Login to the system', 23),
(193, '2020-05-28', '16:55:38', 'Login to the system', 23),
(194, '2020-05-28', '16:56:23', 'Richard del Altre pay for balance (O.R: 2131 / A.R: 2131) - administrator', 33),
(195, '2020-05-30', '11:03:16', 'Login to the system', 23),
(196, '2020-05-31', '07:29:19', 'Login to the system', 23),
(197, '2020-05-31', '08:30:51', 'Login to the system', 1),
(198, '2020-05-31', '09:40:55', 'Login to the system', 1),
(199, '2020-07-05', '16:07:37', 'Login to the system', 23),
(200, '2020-09-04', '09:41:01', 'Login to the system', 23),
(201, '2020-09-04', '09:44:53', 'Edit profile information', 23),
(202, '2020-10-26', '10:58:49', 'Login to the system', 23),
(203, '2020-10-26', '10:58:50', 'Login to the system', 23),
(204, '2020-10-26', '10:58:50', 'Login to the system', 23),
(205, '2020-10-26', '10:58:51', 'Login to the system', 23),
(206, '2020-10-26', '10:58:52', 'Login to the system', 23),
(207, '2020-10-26', '10:58:52', 'Login to the system', 23),
(208, '2020-10-26', '10:58:53', 'Login to the system', 23),
(209, '2020-10-26', '10:58:53', 'Login to the system', 23),
(210, '2020-10-26', '10:58:54', 'Login to the system', 23),
(211, '2020-10-26', '10:58:54', 'Login to the system', 23),
(212, '2020-10-26', '10:58:55', 'Login to the system', 23),
(213, '2020-10-26', '10:58:55', 'Login to the system', 23),
(214, '2020-10-26', '10:58:56', 'Login to the system', 23),
(215, '2020-10-26', '10:58:56', 'Login to the system', 23),
(216, '2020-10-26', '10:58:57', 'Login to the system', 23),
(217, '2020-10-26', '10:58:57', 'Login to the system', 23),
(218, '2020-10-26', '10:58:58', 'Login to the system', 23),
(219, '2020-11-23', '18:05:47', 'Login to the system', 23),
(220, '2020-12-03', '11:12:43', 'Login to the system', 23),
(221, '2021-01-03', '11:13:53', 'Login to the system', 23),
(222, '2021-04-02', '18:04:10', 'Login to the system', 23),
(223, '2021-04-02', '18:09:31', 'Login to the system', 1),
(224, '2021-04-02', '18:11:00', 'Login to the system', 22);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `Stud_class_Id` int(10) UNSIGNED NOT NULL,
  `Date_att` date NOT NULL,
  `Time_att` time NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `Att_Id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`Stud_class_Id`, `Date_att`, `Time_att`, `User_Id`, `Remarks`, `Att_Id`) VALUES
(1, '2020-04-12', '15:49:36', 25, 'Present', 1),
(1, '2020-04-14', '18:47:20', 25, 'Excused', 3),
(1, '2020-04-12', '18:47:30', 25, 'Forfeited', 4),
(1, '2020-04-11', '18:47:39', 25, 'Present', 5),
(1, '2020-03-27', '18:48:07', 25, 'Present', 6),
(8, '2020-05-18', '15:19:46', 33, 'Present', 21),
(8, '2020-05-11', '15:19:46', 33, 'Present', 22),
(8, '2020-05-04', '15:19:46', 33, 'Present', 23),
(8, '2020-04-27', '15:19:46', 33, 'Excused', 24),
(8, '2020-04-20', '15:19:46', 33, 'Present', 25),
(8, '2020-04-13', '15:19:46', 33, 'Present', 26),
(8, '2020-04-06', '15:19:46', 33, 'Present', 27),
(8, '2020-03-30', '15:19:46', 33, 'Present', 28),
(8, '2020-03-23', '15:19:46', 33, 'Present', 29),
(8, '2020-03-16', '15:19:46', 33, 'Present', 30),
(8, '2020-03-09', '15:19:46', 33, 'Present', 31),
(8, '2020-03-02', '15:19:46', 33, 'Present', 32),
(5, '2020-05-18', '15:29:21', 31, 'Present', 33),
(3, '2020-05-18', '15:30:07', 30, 'Present', 34),
(9, '2020-05-18', '15:33:05', 28, 'Excused', 35),
(3, '2020-05-26', '23:41:06', 23, 'Present', 36),
(5, '2020-05-26', '23:41:17', 23, 'Present', 37),
(3, '2020-05-27', '14:31:37', 23, 'Present', 38),
(5, '2020-05-27', '14:31:46', 23, 'Excused', 39);

-- --------------------------------------------------------

--
-- Table structure for table `branches_tbl`
--

CREATE TABLE `branches_tbl` (
  `Branch_Id` int(10) UNSIGNED NOT NULL,
  `Branch_desc` varchar(255) NOT NULL,
  `Branch_location` varchar(255) NOT NULL,
  `Branch_image` text NOT NULL,
  `Level` varchar(255) NOT NULL,
  `Phone_no` varchar(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Branch_image_2` text NOT NULL,
  `randSalt3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches_tbl`
--

INSERT INTO `branches_tbl` (`Branch_Id`, `Branch_desc`, `Branch_location`, `Branch_image`, `Level`, `Phone_no`, `Email`, `Branch_image_2`, `randSalt3`) VALUES
(4, 'Makati City', 'F1 Mezzanine, Makati Cinema Square', '1586764939.png', 'Main Branch', '09090909090', 'euphonymain@gmail.com', '1586240833.png', 1),
(5, 'Trece, Martirez, Cavite', 'SM City ,Trece. Martirez Cavite', '1586240893.png', '2nd Branch', '09090909099', 'euphonytrece@gmail.com', '1586240899.png', 1),
(6, 'Dasmarinas, Cavite', 'F1 Robinsons Place Dasmarinas, Cavite', '1586240950.png', '3rd Branch', '09090909099', 'euphonydasma@gmail.com', '1586240957.png', 1),
(7, 'Taguig', 'Chino Roces Ave. Taguig City', '1586764823.png', '4th Branch', '09090909099', 'euphonytaguig@gmail.com', '1586764856.png', 0),
(8, 'Taguig', 'Chino Roces Ave. Taguig City', '1590563187.png', '4th Branch', '09090909099', 'taguigbranch@gmail.com', '1590563208.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `Category_Id` int(10) UNSIGNED NOT NULL,
  `Category_title` varchar(45) NOT NULL,
  `Date_added` date NOT NULL,
  `Time_added` time NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`Category_Id`, `Category_title`, `Date_added`, `Time_added`, `Status`) VALUES
(14, 'Acoustic Guitar', '2020-04-07', '14:58:15', 1),
(15, 'Electric Guitar', '2020-04-07', '14:58:23', 1),
(16, 'Banduria', '2020-04-07', '14:58:30', 1),
(17, 'Cello', '2020-04-07', '14:58:34', 1),
(18, 'Saxophone', '2020-04-07', '14:58:40', 1),
(19, 'Piano', '2020-04-07', '14:58:46', 1),
(20, 'Keyboard', '2020-04-07', '14:58:51', 1),
(21, 'Strap', '2020-04-07', '14:59:00', 1),
(22, 'Bass', '2020-04-07', '14:59:10', 1),
(23, 'String', '2020-04-07', '14:59:19', 1),
(24, 'Ukulele', '2020-04-16', '10:44:02', 1),
(25, 'Violin', '2020-05-27', '21:52:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_tbl`
--

CREATE TABLE `class_tbl` (
  `Class_Id` int(10) UNSIGNED NOT NULL,
  `Tea_less_Id` int(10) UNSIGNED DEFAULT NULL,
  `Day` varchar(45) NOT NULL,
  `Time` varchar(45) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`Class_Id`, `Tea_less_Id`, `Day`, `Time`, `Status`) VALUES
(48, 3, '5', '9', 'Occupied'),
(49, 3, '6', '9', 'Available'),
(50, 4, '6', '9', 'Available'),
(51, 8, '1', '1', 'Occupied'),
(52, 8, '1', '2', 'Occupied'),
(53, 4, '1', '3', 'Available'),
(54, 4, '1', '5', 'Available'),
(55, 8, '1', '6', 'Available'),
(56, 4, '1', '7', 'Available'),
(57, 8, '1', '10', 'Available'),
(58, 8, '1', '9', 'Available'),
(59, 8, '1', '11', 'Available'),
(60, 4, '1', '12', 'Available'),
(61, 4, '2', '1', 'Available'),
(62, 4, '2', '2', 'Available'),
(63, 8, '2', '4', 'Available'),
(64, 4, '2', '5', 'Available'),
(65, 4, '2', '6', 'Available'),
(66, 4, '2', '7', 'Available'),
(67, 8, '2', '8', 'Available'),
(68, 8, '2', '9', 'Available'),
(69, 4, '2', '10', 'Available'),
(70, 8, '2', '11', 'Available'),
(71, 8, '2', '12', 'Available'),
(72, 8, '3', '1', 'Available'),
(73, 8, '3', '2', 'Available'),
(74, 4, '3', '4', 'Available'),
(75, 8, '3', '5', 'Available'),
(76, 8, '3', '6', 'Available'),
(77, 4, '3', '7', 'Available'),
(78, 8, '3', '9', 'Available'),
(79, 8, '3', '10', 'Available'),
(80, 8, '3', '11', 'Available'),
(81, 8, '3', '12', 'Available'),
(82, 4, '4', '1', 'Available'),
(83, 8, '4', '2', 'Available'),
(84, 8, '4', '3', 'Available'),
(85, 4, '4', '4', 'Available'),
(86, 8, '4', '5', 'Available'),
(87, 4, '4', '6', 'Available'),
(88, 8, '4', '7', 'Available'),
(89, 4, '4', '9', 'Available'),
(90, 8, '4', '10', 'Available'),
(91, 8, '4', '11', 'Available'),
(92, 8, '4', '12', 'Available'),
(93, 8, '5', '1', 'Available'),
(94, 8, '5', '2', 'Available'),
(95, 8, '5', '4', 'Available'),
(96, 8, '5', '5', 'Available'),
(97, 8, '5', '6', 'Available'),
(98, 8, '5', '7', 'Available'),
(99, 8, '5', '8', 'Available'),
(100, 8, '5', '9', 'Available'),
(101, 8, '5', '10', 'Available'),
(102, 8, '5', '11', 'Available'),
(103, 8, '5', '12', 'Available'),
(104, 8, '6', '1', 'Available'),
(105, 8, '6', '2', 'Available'),
(106, 8, '6', '3', 'Available'),
(107, 8, '6', '5', 'Available'),
(108, 8, '6', '6', 'Available'),
(109, 8, '6', '7', 'Available'),
(110, 8, '6', '8', 'Available'),
(111, 8, '6', '10', 'Available'),
(112, 8, '6', '11', 'Available'),
(113, 8, '6', '12', 'Available'),
(114, 3, '1', '1', 'Occupied'),
(115, 5, '1', '2', 'Occupied'),
(116, 3, '1', '3', 'Available'),
(117, 6, '1', '4', 'Available'),
(118, 3, '1', '5', 'Available'),
(119, 3, '1', '6', 'Available'),
(120, 3, '1', '7', 'Available'),
(121, 3, '1', '8', 'Available'),
(122, 3, '1', '10', 'Available'),
(123, 5, '1', '11', 'Occupied'),
(124, 3, '1', '12', 'Available'),
(125, 3, '2', '1', 'Available'),
(126, 7, '2', '2', 'Available'),
(127, 7, '2', '3', 'Available'),
(128, 3, '2', '5', 'Available'),
(129, 3, '2', '6', 'Available'),
(130, 3, '2', '7', 'Available'),
(131, 3, '2', '8', 'Available'),
(132, 5, '2', '10', 'Available'),
(133, 3, '2', '11', 'Available'),
(134, 3, '2', '12', 'Available'),
(135, 3, '3', '1', 'Available'),
(136, 5, '3', '2', 'Available'),
(137, 5, '3', '3', 'Available'),
(138, 5, '3', '4', 'Available'),
(139, 3, '3', '5', 'Available'),
(140, 7, '3', '6', 'Available'),
(141, 3, '3', '7', 'Available'),
(142, 5, '3', '8', 'Available'),
(143, 3, '3', '9', 'Available'),
(144, 5, '3', '10', 'Available'),
(145, 5, '3', '11', 'Available'),
(146, 5, '3', '12', 'Available'),
(147, 3, '4', '1', 'Available'),
(148, 6, '4', '2', 'Available'),
(149, 3, '4', '4', 'Available'),
(150, 3, '4', '6', 'Available'),
(151, 3, '4', '5', 'Available'),
(152, 3, '4', '7', 'Available'),
(153, 3, '4', '8', 'Available'),
(154, 5, '4', '9', 'Available'),
(155, 3, '4', '10', 'Available'),
(156, 3, '4', '11', 'Available'),
(157, 3, '4', '12', 'Available'),
(158, 3, '5', '1', 'Available'),
(159, 3, '5', '2', 'Available'),
(160, 5, '5', '3', 'Available'),
(161, 7, '5', '5', 'Available'),
(162, 3, '5', '8', 'Available'),
(163, 3, '5', '10', 'Available'),
(164, 3, '5', '11', 'Available'),
(165, 5, '5', '12', 'Available'),
(166, 3, '6', '1', 'Available'),
(167, 3, '6', '2', 'Available'),
(168, 3, '6', '3', 'Available'),
(169, 3, '6', '5', 'Available'),
(170, 3, '6', '6', 'Available'),
(171, 3, '6', '8', 'Available'),
(172, 3, '6', '10', 'Available'),
(173, 3, '6', '11', 'Available'),
(174, 3, '6', '12', 'Available'),
(175, 3, '7', '1', 'Available'),
(176, 3, '7', '2', 'Available'),
(177, 3, '7', '3', 'Available'),
(178, 5, '7', '4', 'Available'),
(179, 3, '7', '5', 'Available'),
(180, 3, '7', '6', 'Available'),
(181, 3, '7', '7', 'Available'),
(182, 3, '7', '8', 'Available'),
(183, 3, '7', '9', 'Available'),
(184, 3, '7', '10', 'Available'),
(185, 5, '7', '11', 'Available'),
(186, 3, '7', '12', 'Available'),
(187, 9, '3', '8', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `days_tbl`
--

CREATE TABLE `days_tbl` (
  `Day_Id` int(11) NOT NULL,
  `Day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days_tbl`
--

INSERT INTO `days_tbl` (`Day_Id`, `Day`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `G_Id` int(11) NOT NULL,
  `GC_Id` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL,
  `Date_added` date DEFAULT NULL,
  `Time_added` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`G_Id`, `GC_Id`, `Description`, `Image`, `Date_added`, `Time_added`) VALUES
(7, 4, 'Euphony Recital', '1586241083.png', '2020-04-07', '14:31:23'),
(8, 4, 'Euphony Recital_2', '1586241102.png', '2020-04-07', '14:31:42'),
(9, 4, 'Jorge Matthew on Guitar', '1586241143.png', '2020-04-07', '14:32:23'),
(10, 6, 'Euphony Teachers', '1586766435.png', '2020-04-13', '16:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_category`
--

CREATE TABLE `gallery_category` (
  `GC_Id` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Date_created` date NOT NULL,
  `Time_created` time NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_category`
--

INSERT INTO `gallery_category` (`GC_Id`, `Description`, `Date_created`, `Time_created`, `Status`) VALUES
(4, 'Recital', '2020-04-07', '14:29:52', 1),
(5, 'Venue', '2020-04-07', '14:30:00', 1),
(6, 'Teachers', '2020-04-13', '16:25:44', 1),
(7, 'Students', '2020-05-27', '21:50:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lessons_tbl`
--

CREATE TABLE `lessons_tbl` (
  `Lesson_Id` varchar(45) NOT NULL,
  `Lesson_desc` varchar(45) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `No_of_lesson` int(11) NOT NULL,
  `Icon` text NOT NULL,
  `Cover_image` text NOT NULL,
  `Content` text NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons_tbl`
--

INSERT INTO `lessons_tbl` (`Lesson_Id`, `Lesson_desc`, `Amount`, `No_of_lesson`, `Icon`, `Cover_image`, `Content`, `Status`) VALUES
('B12', 'Banduria', '5950.00', 12, '1585492100.png', '1585303769.png', 'History\r\n\r\nEuphony Music Center and Studio started at Makati Cinema Square in Pasong Tamo Makati City in the year 2001. This was managed by the founder Ms. ERLINDA M. ALBAY Â handles the selling of musical instruments such pianos, guitar, keyboard etc. She also acted as the HR personnel in charge of screening qualified sales staff and hiring of qualified music teachers for the music lesson offered by the company.\r\n\r\nAside from musical services offered the company also engaged in putting up exhibit in different malls within Metro Manila and nearby provinces. These exhibits intensified the campaign promoting the music school and sale of musical instrument.\r\n\r\nAt present time, after almost two decade in the music industry, Euphony Music Center and Studio has expended two to more branches, one at level 1 of Robinsons place Dasmarinas and the most recent one is at level 2 SM City TreceMartires Cavite.', 1),
('B24', 'Banduria', '11900.00', 24, '1585492113.png', 'Banduria-24.jpg', '', 1),
('B36', 'Banduria', '17850.00', 36, '1585492127.png', 'Banduria-36.jpg', '', 1),
('B48', 'Banduria', '23800.00', 48, '', 'Banduria-48.jpg', '', 1),
('BSS12', 'Bass', '5950.00', 12, '1590562759.png', '1590562746.png', 'Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsumasdas\r\n\r\nLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum', 0),
('C12', 'Cello', '12500.00', 12, '1590302675.png', '1590575368.png', '', 1),
('C24', 'Cello', '25000.00', 24, '', '', '', 1),
('C36', 'Cello', '37500.00', 36, '', '', '', 1),
('C48', 'Cello', '50000.00', 48, '', '', '', 1),
('D12', 'Drum', '5950.00', 12, '1590302652.png', '1590562684.png', 'Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas', 1),
('D24', 'Drum', '11900.00', 24, '', 'Drum-24.jpg', '', 1),
('D36', 'Drum', '17850.00', 36, '', 'Drum-36.jpg', '', 1),
('D48', 'Drum', '23800.00', 48, '', 'Drum-48.jpg', '', 1),
('DANCE12', 'Dance Lesson', '5950.00', 12, '', '', '', 1),
('DANCE24', 'Dance Lesson -(2 Free Lessons)', '11900.00', 26, '', '', '', 1),
('DANCE36', 'Dance Lesson - (3 Free Lessons)', '17850.00', 39, '', '', '', 1),
('DANCE48', 'Dance Lesson - (4 Free Lessons)', '23800.00', 52, '', '', '', 1),
('FL12', 'Flute', '6700.00', 12, '1586765263.png', '1586765213.png', 'Lorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con EstasLorem Ipsum is a dummy text Con Estas', 1),
('G12', 'Guitar', '5950.00', 12, '1585491666.png', 'Guitar-12.jpg', '<p>What you&#39;ll learn</p>\r\n\r\n<p>\\r\\n\\r\\n</p>\r\n\r\n<p>\\\\r\\\\n\\\\r\\\\n</p>\r\n\r\n<p>\\r\\n\\r\\n</p>\r\n\r\n<ul>\r\n	<li>\\r\\n</li>\r\n	<li>\\\\r\\\\n</li>\r\n	<li>\\r\\n</li>\r\n	<li>Basic Strumming</li>\r\n	<li>\\r\\n</li>\r\n	<li>\\\\r\\\\n</li>\r\n	<li>\\r\\n</li>\r\n	<li>Major and Minor Chords</li>\r\n	<li>\\r\\n</li>\r\n	<li>\\\\r\\\\n</li>\r\n	<li>\\r\\n</li>\r\n	<li>Scala</li>\r\n	<li>\\r\\n</li>\r\n	<li>\\\\r\\\\n</li>\r\n	<li>\\r\\n</li>\r\n	<li>Notes (Pattern)</li>\r\n	<li>\\r\\n</li>\r\n	<li>\\\\r\\\\n</li>\r\n	<li>\\r\\n</li>\r\n</ul>', 1),
('G24', 'Guitar', '11900.00', 24, '1585491840.png', 'Guitar-24.jpg', '', 1),
('G36', 'Guitar', '17850.00', 36, '', 'Guitar-36.jpg', '', 1),
('G48', 'Guitar', '23800.00', 48, '', 'Guitar-48.jpg', '', 1),
('OA12', 'Oil Acrylic', '8500.00', 12, '', '', '', 1),
('OA24', 'Oil Acrylic', '17000.00', 24, '', '', '', 1),
('OA36', 'Oil Acrylic', '25500.00', 36, '', '', '', 1),
('OA48', 'Oil Acrylic', '34000.00', 48, '', '', '', 1),
('PC12', 'Pencil/Charcoal', '5950.00', 12, '', '', '', 1),
('PC24', 'Pencil/Charcoal', '11900.00', 24, '', '', '', 1),
('PC36', 'Pencil/Charcoal', '17850.00', 36, '', '', '', 1),
('PC48', 'Pencil/Charcoal', '23800.00', 48, '', '', '', 1),
('PO12', 'Piano/Organ', '6550.00', 12, '', 'Keyboard-12.jpg', '', 1),
('PO24', 'Piano/Organ', '13100.00', 24, '', 'Keyboard-24.jpg', '', 1),
('PO36', 'Piano/Organ', '19650.00', 36, '', 'Keyboard-36.jpg', '', 1),
('PO48', 'Piano/Organ', '26200.00', 48, '', 'Keyboard-48.jpg', '', 1),
('PTL12', 'Pastel', '6550.00', 12, '', '', '', 1),
('PTL24', 'Pastel', '13100.00', 24, '', '', '', 1),
('PTL36', 'Pastel', '19650.00', 36, '', '', '', 1),
('PTL48', 'Pastel', '26200.00', 48, '', '', '', 1),
('SX12', 'Saxophone', '7550.00', 12, '', 'Saxophone-12.jpg', '', 1),
('SX24', 'Saxophone', '15100.00', 24, '', 'Saxophone-24.jpg', '', 1),
('SX36', 'Saxophone', '22650.00', 36, '', 'Saxophone-36.jpg', '', 1),
('SX48', 'Saxophone', '30200.00', 48, '1585492411.png', '1585492398.png', '', 1),
('V12', 'Voice', '6950.00', 12, '', '', '', 1),
('V24', 'Voice', '13900.00', 24, '', '', '', 1),
('V36', 'Voice', '20850.00', 36, '', '', '', 1),
('V48', 'Voice', '27800.00', 48, '', '', '', 1),
('VIO12', 'Violin', '7350.00', 12, '', 'Violin-12.jpg', '', 1),
('VIO24', 'Violin', '14700.00', 24, '', 'Violin-24.jpg', '', 1),
('VIO36', 'Violin', '22050.00', 36, '', 'Violin-36.jpg', '', 1),
('VIO48', 'Violin', '29400.00', 48, '', 'Violin-48.jpg', '<p>Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas</p>\r\n\r\n<ul>\r\n	<li>Lorem Ipsum Dolor Sit Amet Con Estas</li>\r\n	<li>Lorem Ipsum Dolor Sit Amet Con Estas</li>\r\n	<li>Lorem Ipsum Dolor Sit Amet Con Estas</li>\r\n</ul>\r\n', 1),
('WC12', 'Water Color', '7500.00', 12, '', '', '', 1),
('WC24', 'Water Color', '15000.00', 24, '', '', '', 1),
('WC36', 'Water Color', '22500.00', 36, '', '', 'Lorem Ipsum', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `Mess_Id` int(11) NOT NULL,
  `Sender` int(11) NOT NULL,
  `Receiver` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Status` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Draft` int(11) NOT NULL,
  `Important` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`Mess_Id`, `Sender`, `Receiver`, `Date`, `Time`, `Status`, `Title`, `Description`, `Draft`, `Important`) VALUES
(30, 2, 3, '2019-10-12', '15:08:38', 1, 'New Product Here', '<p>Lorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit Amet222222</p>\r\n', 0, 0),
(32, 3, 2, '2019-10-12', '16:16:46', 1, 'New Lesson Here', '<p>Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum</p>\r\n', 0, 0),
(33, 2, 3, '2019-10-12', '16:17:14', 1, 'New Lesson Here', '<p>Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum Got It!</p>\r\n', 0, 0),
(34, 2, 3, '2019-10-28', '15:52:31', 1, 'New Lesson', '<p>Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum</p>\r\n', 0, 0),
(35, 2, 1, '2020-02-25', '06:53:51', 0, 'Request for Approval', '<p>Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas&nbsp;Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas</p>\r\n', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `policy_tbl`
--

CREATE TABLE `policy_tbl` (
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policy_tbl`
--

INSERT INTO `policy_tbl` (`Content`) VALUES
('<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Students must come on or before the scheduled time.</li>\r\n	<li>Students must call/inform the office a day before if the student cannot attend the lesson, otherwise the lesson will be <strong><span style=\"color:#e74c3c\">FORFEITED</span></strong>.</li>\r\n	<li>Payment made are non-refundable, but transferrable.</li>\r\n	<li>Students are requested to pay on time.</li>\r\n	<li>Students are not allowed to eat or drink inside the room.</li>\r\n	<li>Enrolled lessons are valid&nbsp;for one year ( based on the O.R/A.R date )</li>\r\n	<li>Lorem Ipsum Dolor Sit Amet Con Estas</li>\r\n</ul>\r\n\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></p>\r\n\r\n<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PLEASE BE GUIDED ACCORDINGLY</strong></p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

CREATE TABLE `products_tbl` (
  `Prod_Id` int(10) UNSIGNED NOT NULL,
  `Category_Id` int(10) UNSIGNED NOT NULL,
  `Prod_brand` varchar(255) NOT NULL,
  `Prod_name` varchar(255) NOT NULL,
  `Prod_price` decimal(10,2) NOT NULL,
  `Prod_desc` text NOT NULL,
  `Prod_image` text NOT NULL,
  `Status` varchar(45) NOT NULL,
  `randSalt3` int(11) NOT NULL,
  `Status_2` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_tbl`
--

INSERT INTO `products_tbl` (`Prod_Id`, `Category_Id`, `Prod_brand`, `Prod_name`, `Prod_price`, `Prod_desc`, `Prod_image`, `Status`, `randSalt3`, `Status_2`) VALUES
(49, 14, 'Fender', 'Fender Acoustic Guitar', '17000.00', 'Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas\r\n\r\n1. Wood\r\n2. Etc\r\n\r\nLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas', '1586244941.png', 'Not Available', 0, 1),
(50, 14, 'Euphony', 'Euphony Acoustic Semi Hollow Guitar', '5500.00', 'Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas\r\n\r\n1. Hello\r\n2. Wood\r\n\r\nLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorema', '1586245008.png', 'Not Available', 0, 1),
(51, 21, 'Gibson', 'The Modern Vintage', '850.00', 'Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amea', '1586245120.png', 'Not Available', 0, 1),
(52, 21, 'Gibson', 'The Western Vintage', '830.00', 'Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amea', '1586245164.png', 'Not Available', 0, 1),
(53, 23, 'Gibson', 'Gibson String', '75.00', 'These strings, developed by our Master Luthiers, are loved by fans and artists around the world and adorn every solid body electric guitar built in our Nashville, TN Gibson USA facility. Brite Wires are precision-wound with nickle-plated steel to give your guitar a bright, crisp attack with superior volume and sustain. With a reinforced high-strength carbon core, these are the best performing strings for your electric guitar.', '1586245229.png', 'Not Available', 0, 1),
(54, 23, 'Gibson', 'Gibson String B Class', '85.00', 'These strings, developed by our master luthiers, are loved by fans and artists around the world and adorn every acoustic guitar built in our Bozeman, MT facility. With high frequency clarity and long lasting performance, they are the best sounding strings for your acoustic guitar.', '1586245286.png', 'Not Available', 0, 1),
(55, 23, 'Gibson', 'Gibson String C Class', '95.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has helped shape music for decades.', '1586245334.png', 'Top Seller', 0, 1),
(56, 16, 'Santana', 'Santana Bandurria', '28000.00', 'Lorem Ipsum Dolro Sit Amet Con Estas is a dummy text', '1586245429.png', 'Not Available', 0, 1),
(57, 22, 'Euphony', 'Euphony Bass Coil', '17000.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo,', '1586245512.png', 'Not Available', 0, 1),
(58, 22, 'Fender', 'Fender Bass', '23250.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire.', '1586245562.png', 'Not Available', 1, 1),
(59, 17, 'Fender', 'Ricardo Cello 1STed', '42300.00', 'Lorem Ipsum is a dummy text Dolor Sit Amer Con Estas', '1586245642.png', 'Not Available', 0, 1),
(60, 17, 'Euphony', 'Euphony Cello', '20510.00', 'Lorem Ipsum', '1586245715.png', 'New Arrival', 0, 1),
(61, 15, 'Fender', 'Fender Electro Series Electric Guitar', '45000.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has hea', '1586245786.png', 'Not Available', 0, 1),
(62, 15, 'Gibson', 'Steve Ray Vaughan Guitar', '120000.00', 'Steve Ray Vaughan Guitar with Certificate of Authenticity', '1586245861.png', 'Not Available', 1, 1),
(63, 15, 'Fender', 'Fender Black Knight', '56500.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has hea', '1586245902.png', 'Not Available', 1, 1),
(64, 14, 'Fender', 'Fender Acoustic Guitar(Wood Series 40)', '35000.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has h', '1586245953.png', 'Available', 0, 1),
(65, 15, 'Epiphone', 'Epiphone Semi Hollow', '66000.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has hea', '1586245992.png', 'Not Available', 0, 1),
(66, 20, 'Abah', 'Abah Keyboard', '45000.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has helped shape music for decades.', '1586246060.png', 'Not Available', 1, 1),
(67, 20, 'Yamaha', 'Yamaha Keyboard', '34500.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has helped shape music for decades.', '1586246110.png', 'Available', 0, 1),
(68, 19, 'Santana', 'Piano Elegante', '145000.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has helped shape music for decades.', '1586246163.png', 'New Arrival', 0, 1),
(69, 19, 'Yamaha', 'Yamaha Classic Series', '157800.00', 'These authentic strings are crafted the exactly way they were in the \'50s and are made from the purest nickel wrap and finest quality core wire. Vintage Reissues are wound at the perfect speed under optimal conditions to ensure long-lasting quality, and the coveted true vintage tone that we engineered in the \'50s in Kalamazoo, Michigan that has helped shape music for decades.', '1586246210.png', 'Not Available', 1, 1),
(70, 18, 'Mitsubishi', 'Mitsubishi Sax800', '80500.00', 'Lorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con EstasLorem Isum Dolor Sit Amet Con Estas', '1586246276.png', 'Available', 1, 1),
(71, 24, 'Euphony', 'Euphony Ukulele v1', '1300.00', 'Lorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit Amet', '1587005477.png', 'Not Available', 0, 1),
(72, 24, 'Euphony', 'Euphony Ukulele', '3000.00', 'Lorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit AmetLorem Ipsum Dolor Sit Amet', '1590576232.png', 'Available', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_settings`
--

CREATE TABLE `product_settings` (
  `Prod_sett_Id` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_settings`
--

INSERT INTO `product_settings` (`Prod_sett_Id`, `Description`, `Number`) VALUES
(1, 'Fast Moving', 7),
(2, 'Slow Moving', 7),
(3, 'Critical Stock', 3);

-- --------------------------------------------------------

--
-- Table structure for table `prod_invt_tbl`
--

CREATE TABLE `prod_invt_tbl` (
  `Prod_Id` int(10) UNSIGNED NOT NULL,
  `Branch_Id` int(10) UNSIGNED NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prod_invt_tbl`
--

INSERT INTO `prod_invt_tbl` (`Prod_Id`, `Branch_Id`, `Quantity`) VALUES
(49, 5, 0),
(50, 5, 0),
(51, 5, 15),
(52, 5, 15),
(53, 5, 10),
(54, 5, 11),
(55, 5, 7),
(56, 5, 0),
(57, 5, 0),
(58, 5, 0),
(59, 5, 0),
(60, 5, 3),
(61, 5, 0),
(62, 5, 0),
(63, 5, 0),
(64, 5, 3),
(65, 5, 0),
(66, 5, 0),
(67, 5, 1),
(68, 5, 1),
(69, 5, 0),
(70, 5, 2),
(71, 5, 3),
(72, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE `sales_detail` (
  `Sales_Id` int(11) NOT NULL,
  `Prod_Id` int(11) UNSIGNED NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Sales_details_Id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`Sales_Id`, `Prod_Id`, `Price`, `Quantity`, `Sales_details_Id`) VALUES
(1, 57, '17000.00', 1, 1),
(2, 57, '34000.00', 2, 2),
(3, 55, '950.00', 10, 3),
(3, 53, '750.00', 10, 4),
(3, 54, '765.00', 9, 5),
(4, 55, '95.00', 1, 7),
(5, 55, '285.00', 3, 9),
(5, 67, '34500.00', 2, 10),
(6, 64, '35000.00', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `Sales_Id` int(11) UNSIGNED NOT NULL,
  `Branch_Id` int(11) UNSIGNED NOT NULL,
  `Date` date NOT NULL,
  `Cashier` varchar(255) NOT NULL,
  `Sold_to` varchar(255) NOT NULL,
  `OR_no` varchar(255) NOT NULL,
  `AR_no` varchar(255) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `Total_discount` int(11) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Cash` decimal(10,2) NOT NULL,
  `Cash_change` decimal(10,2) NOT NULL,
  `Payment` varchar(255) NOT NULL,
  `randSalt4` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`Sales_Id`, `Branch_Id`, `Date`, `Cashier`, `Sold_to`, `OR_no`, `AR_no`, `Subtotal`, `Total_discount`, `Total`, `Cash`, `Cash_change`, `Payment`, `randSalt4`, `Status`) VALUES
(1, 5, '2020-04-15', 'Richard', 'Richard S. Montero', '1135', '1135', '17000.00', 2, '17000.00', '17000.00', '340.00', 'Cheque', 1, 1),
(2, 5, '2020-04-16', 'Richard', 'Kristine D Vivar', '1145', '1145', '68000.00', 2, '68000.00', '70000.00', '3400.00', 'Cheque', 1, 1),
(3, 5, '2020-04-16', 'Richard', 'Rico S. Montana', '1137', '1137', '23885.00', 5, '23885.00', '24000.00', '1315.00', 'Cheque', 1, 1),
(4, 5, '2020-05-02', '', 'Christine Caparida Balmocena', '', '', '0.00', 0, '0.00', '0.00', '0.00', '', 2, 1),
(5, 5, '2020-05-27', 'Richard', 'Richard S. Altre', '4456', '4456', '69855.00', 2, '69855.00', '70000.00', '1545.00', 'Cash', 1, 1),
(6, 5, '2020-09-04', 'Richard', 'Richard del S. Altre', '1241', '1241', '35000.00', 20, '35000.00', '40000.00', '13000.00', 'Cheque', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `selected_class_tbl`
--

CREATE TABLE `selected_class_tbl` (
  `Selected_class_Id` int(11) NOT NULL,
  `Lesson_Id` varchar(255) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `the_Day` int(11) NOT NULL,
  `the_Time` int(11) NOT NULL,
  `Date_started` date NOT NULL,
  `Date_completed` date NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selected_class_tbl`
--

INSERT INTO `selected_class_tbl` (`Selected_class_Id`, `Lesson_Id`, `User_Id`, `the_Day`, `the_Time`, `Date_started`, `Date_completed`, `Status`) VALUES
(4, 'G12', 25, 5, 9, '2020-04-11', '0000-00-00', 'New'),
(6, 'C12', 26, 3, 3, '2020-04-13', '0000-00-00', 'New'),
(7, 'D12', 29, 5, 9, '2020-04-14', '0000-00-00', 'New'),
(8, 'G12', 27, 6, 9, '2020-04-14', '0000-00-00', 'New'),
(9, 'C12', 25, 5, 9, '2019-02-11', '2020-04-03', 'Completed'),
(10, 'D12', 28, 1, 11, '2020-05-24', '0000-00-00', 'New'),
(11, 'G12', 30, 1, 1, '2020-05-24', '0000-00-00', 'New'),
(12, 'G12', 31, 1, 1, '2020-05-24', '0000-00-00', 'New'),
(13, 'G12', 32, 1, 2, '2020-05-24', '0000-00-00', 'New'),
(14, 'C12', 33, 1, 2, '2020-05-24', '2020-05-24', 'Completed'),
(15, 'D12', 33, 1, 2, '2020-05-24', '0000-00-00', 'New'),
(16, 'C12', 34, 3, 3, '2020-05-27', '0000-00-00', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `services_tbl`
--

CREATE TABLE `services_tbl` (
  `service_Id` int(11) UNSIGNED NOT NULL,
  `title` varchar(45) NOT NULL,
  `image` varchar(45) NOT NULL,
  `price` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_tbl`
--

INSERT INTO `services_tbl` (`service_Id`, `title`, `image`, `price`, `content`, `Status`) VALUES
(1, 'Guitar Repair', '1586765644.png', '750', '<p>Euphony Music Center and Studio started at Makati Cinema Square in Pasong Tamo Makati City in the year 2001. This was managed by the founder Ms. ERLINDA M. ALBAY &amp;nbsp;handles the selling of musical instruments such pianos, guitar, keyboard etc. She also acted as the HR personnel in charge of screening qualified sales staff and hiring of qualified music teachers for the music lesson offered by the company.</p>', 1),
(3, 'Musicians for all occasions', '1586765598.png', '3000', 'asdLorem Ipsum Dolor Sit Amet Con Estas. Lorem Ipsum is a dummy text. Contrary to popular belief is simply a dummy textLorem Ipsum Dolor Sit Amet Con Estas. Lorem Ipsum is a dummy text. Contrary to popular belief is simply a dummy textLorem Ipsum Dolor Sit Amet Con Estas. Lorem Ipsum is a dummy text', 1),
(4, 'Bass Repair', '1586765946.png', '4300', 'Lorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas\r\n\r\n1. Dummy\r\n2. Dummy Text\r\n\r\nLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con EstasLorem Ipsum Dolor Sit Amet Con Estas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `Transaction_Id` int(11) NOT NULL,
  `Prod_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Quantity_In` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`Transaction_Id`, `Prod_Id`, `Date`, `Time`, `Quantity_In`) VALUES
(30, 47, '2020-02-11', '14:48:55', 2),
(31, 36, '2020-02-11', '14:49:03', 1),
(32, 44, '2020-02-19', '14:28:17', 2),
(33, 34, '2020-02-19', '14:28:24', 1),
(34, 47, '2020-03-05', '16:51:40', 10),
(35, 32, '2020-04-06', '08:52:31', 1),
(36, 36, '2020-04-06', '08:52:40', 1),
(38, 48, '2020-04-06', '13:38:19', 2),
(40, 35, '2020-04-06', '15:02:29', 1),
(41, 70, '2020-04-07', '18:06:45', 2),
(42, 68, '2020-04-07', '18:07:00', 1),
(43, 60, '2020-04-07', '18:07:07', 3),
(44, 64, '2020-04-07', '18:07:22', 4),
(45, 67, '2020-04-07', '18:07:36', 3),
(46, 57, '2020-04-07', '18:07:46', 3),
(47, 52, '2020-04-16', '10:38:11', 15),
(48, 51, '2020-04-16', '10:38:19', 15),
(49, 55, '2020-04-16', '10:38:27', 20),
(50, 54, '2020-04-16', '10:38:34', 20),
(51, 53, '2020-04-16', '10:38:41', 20),
(52, 72, '2020-05-27', '18:44:48', 4),
(54, 71, '2020-05-27', '18:44:42', 3);

-- --------------------------------------------------------

--
-- Table structure for table `stud_balances`
--

CREATE TABLE `stud_balances` (
  `Transaction_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `OR_no` varchar(255) NOT NULL,
  `AR_no` varchar(255) NOT NULL,
  `The_balance` decimal(10,2) NOT NULL,
  `Date` date NOT NULL,
  `Trans_time` time NOT NULL,
  `Cash_tendered` decimal(10,2) NOT NULL,
  `Total_balance` decimal(10,2) NOT NULL,
  `Discount` int(11) NOT NULL,
  `The_change` decimal(10,2) NOT NULL,
  `Checked_by` int(11) NOT NULL,
  `Payment` varchar(255) NOT NULL,
  `randSalt9` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud_balances`
--

INSERT INTO `stud_balances` (`Transaction_Id`, `User_Id`, `OR_no`, `AR_no`, `The_balance`, `Date`, `Trans_time`, `Cash_tendered`, `Total_balance`, `Discount`, `The_change`, `Checked_by`, `Payment`, `randSalt9`, `Status`) VALUES
(1, 25, '1134', '1134', '5950.00', '2020-04-11', '09:06:38', '1150.00', '4800.00', 0, '0.00', 0, 'Cash', 1, 1),
(3, 29, '1132', '1132', '5950.00', '2020-04-14', '15:33:17', '1500.00', '4450.00', 10, '0.00', 0, 'Cheque', 1, 1),
(4, 25, '1131', '1131', '4800.00', '2020-04-14', '18:58:03', '1250.00', '3550.00', 2, '0.00', 0, 'Cash', 1, 1),
(5, 25, '1136', '1136', '3550.00', '2020-05-07', '10:04:54', '1200.00', '2350.00', 0, '0.00', 0, 'Cash', 1, 1),
(6, 30, '2230', '2230', '5950.00', '2020-05-26', '23:41:44', '1500.00', '4450.00', 0, '0.00', 0, 'Cheque', 1, 1),
(7, 34, '1214', '1214', '12500.00', '2020-05-27', '18:37:49', '50000.00', '0.00', 0, '37500.00', 0, 'Cheque', 1, 1),
(8, 33, '2131', '2131', '5950.00', '2020-05-28', '16:56:23', '1200.00', '4750.00', 0, '0.00', 0, 'Cheque', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stud_class_tbl`
--

CREATE TABLE `stud_class_tbl` (
  `Stud_class_Id` int(10) UNSIGNED NOT NULL,
  `Class_Id` int(10) UNSIGNED NOT NULL,
  `User_Id` int(10) UNSIGNED NOT NULL,
  `randSalt2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud_class_tbl`
--

INSERT INTO `stud_class_tbl` (`Stud_class_Id`, `Class_Id`, `User_Id`, `randSalt2`) VALUES
(1, 48, 25, '1'),
(2, 144, 28, '0'),
(3, 114, 30, '1'),
(4, 52, 31, '0'),
(5, 51, 31, '1'),
(6, 52, 32, '1'),
(7, 60, 33, '0'),
(8, 115, 33, '1'),
(9, 123, 28, '1');

-- --------------------------------------------------------

--
-- Table structure for table `stud_status_tbl`
--

CREATE TABLE `stud_status_tbl` (
  `User_Id` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Date_started` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud_status_tbl`
--

INSERT INTO `stud_status_tbl` (`User_Id`, `Status`, `Date_started`) VALUES
(25, 'Official', '2020-04-12'),
(26, 'Pending', '0000-00-00'),
(27, 'Pending', '2020-04-14'),
(28, 'Official', '2020-05-24'),
(29, 'Pending', '2020-04-14'),
(30, 'Official', '2020-05-24'),
(31, 'Official', '2020-05-24'),
(32, 'Official', '2020-05-24'),
(33, 'Official', '2020-05-24'),
(34, 'Declined', '2020-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_branch_tbl`
--

CREATE TABLE `teacher_branch_tbl` (
  `Teacher_Id` int(11) NOT NULL,
  `Branch_Id` int(11) NOT NULL,
  `T_Branch_Id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_branch_tbl`
--

INSERT INTO `teacher_branch_tbl` (`Teacher_Id`, `Branch_Id`, `T_Branch_Id`) VALUES
(3, 5, 3),
(4, 5, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_lesson_tbl`
--

CREATE TABLE `teacher_lesson_tbl` (
  `Tea_less_Id` int(11) NOT NULL,
  `Teacher_Id` int(11) NOT NULL,
  `Lesson_Id` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_lesson_tbl`
--

INSERT INTO `teacher_lesson_tbl` (`Tea_less_Id`, `Teacher_Id`, `Lesson_Id`, `Status`) VALUES
(3, 3, 'G12', 1),
(4, 4, 'C12', 1),
(5, 3, 'D12', 1),
(6, 3, 'B12', 1),
(7, 3, 'C24', 1),
(8, 4, 'G12', 1),
(9, 5, 'C12', 1),
(10, 5, 'D24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tbl`
--

CREATE TABLE `teacher_tbl` (
  `Teacher_Id` int(11) NOT NULL,
  `T_Last_name` varchar(255) NOT NULL,
  `T_First_name` varchar(255) NOT NULL,
  `T_Middle_name` varchar(255) NOT NULL,
  `T_Sex` varchar(255) NOT NULL,
  `T_Birthdate` date NOT NULL,
  `T_Age` int(11) NOT NULL,
  `T_Address` varchar(255) NOT NULL,
  `T_Nationality` varchar(255) NOT NULL,
  `T_Contact_no` varchar(255) NOT NULL,
  `T_Profile_img` text NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_tbl`
--

INSERT INTO `teacher_tbl` (`Teacher_Id`, `T_Last_name`, `T_First_name`, `T_Middle_name`, `T_Sex`, `T_Birthdate`, `T_Age`, `T_Address`, `T_Nationality`, `T_Contact_no`, `T_Profile_img`, `Status`) VALUES
(3, 'Tolentino', 'Daniel', 'Tan', 'Male', '1986-06-07', 34, 'Carmona Estates, Carmona, Cavite', 'Filipino', '0909090999', '1586675780.png', 1),
(4, 'Vivar', 'Kristine', 'Dela Rosa', 'Female', '1978-09-12', 42, 'Milagrosa, Carmona, Cavite', 'Filipino', '09085266615', '', 1),
(5, 'Vidal', 'Marco', 'Reyes', 'Male', '1973-03-22', 47, 'Brgy.Francisco, Gen.Trias, Cavite', 'Filipino', '09090909099', '1590576007.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `time_tbl`
--

CREATE TABLE `time_tbl` (
  `Time_Id` int(11) NOT NULL,
  `Time` varchar(255) NOT NULL,
  `Time_end` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_tbl`
--

INSERT INTO `time_tbl` (`Time_Id`, `Time`, `Time_end`, `randSalt`) VALUES
(1, '9', '10', 'AM'),
(2, '10', '11', 'AM'),
(3, '11', '12', 'AM'),
(4, '12', '1', 'PM'),
(5, '1', '2', 'PM'),
(6, '2', '3', 'PM'),
(7, '3', '4', 'PM'),
(8, '4', '5', 'PM'),
(9, '5', '6', 'PM'),
(10, '6', '7', 'PM'),
(11, '7', '8', 'PM'),
(12, '8', '9', 'PM');

-- --------------------------------------------------------

--
-- Table structure for table `user_info_tbl`
--

CREATE TABLE `user_info_tbl` (
  `User_Id` int(11) NOT NULL,
  `Branch_Id` int(11) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Middle_name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact_no` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Age` int(11) NOT NULL,
  `Sex` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Profile_img` text,
  `Status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info_tbl`
--

INSERT INTO `user_info_tbl` (`User_Id`, `Branch_Id`, `Last_name`, `First_name`, `Middle_name`, `Address`, `Contact_no`, `Birthdate`, `Age`, `Sex`, `Nationality`, `Profile_img`, `Status`) VALUES
(1, 1, 'Albay', 'Lynne', 'Martinez', 'Makati City, Chino Roces Ave.', '09090909099', '1965-09-08', 57, 'Female', 'Filipino', '1590587761.png', 1),
(22, 6, 'Torres', 'Mila', 'Delin', 'Dasmarinas, Cavite', '0908239921', '1973-07-14', 47, 'Female', 'Filipino', '1586242544.png', 1),
(23, 5, 'Montero', 'Ricardo', 'Sanidad', 'GMA, Cavite, Blk 21, Lot 1, Area H, Brgy. Pulido', '09095108960', '1998-12-20', 22, 'Male', 'Filipino', '1590576396.png', 1),
(25, 5, 'Ferreras', 'David Paul', 'Pilarca', 'GMA, Cavite, Maderan', '09090909090', '1998-12-31', 22, 'Male', 'Filipino', '', 1),
(26, 6, 'Altre', 'Richard del', 'Sanidad', 'GMA, Cavite, Blk 21, Lot 1, Area H, Brgy. Pulido', '09095108960', '1998-12-20', 22, 'Male', 'Filipino', '1590589361.png', 1),
(27, 5, 'Felias', 'Renze Kennard', 'Mani', 'GMA, Cavite, Vera Cruz, Maderan', '09090909090', '1998-07-14', 22, 'Male', 'Filipino', '1586848210.png', 1),
(28, 5, 'De Leon', 'Japeth', 'Rivera', 'Tanza, Cavite', '09088883423', '1998-07-16', 22, 'Male', 'Filipino', '1586848891.png', 1),
(29, 5, 'Reyes', 'Rod Mark', 'Acosta', 'Paliparan II, Dasmarinas, Cavite', '09085253261', '1997-03-01', 23, 'Male', 'Filipino', '1586848966.png', 1),
(30, 5, 'Balmocena', 'Christine Joy ', 'Caparida', 'GMA, Cavite, Brgy. Granados', '09090909099', '1998-07-06', 22, 'Female', 'Filipino', NULL, 1),
(31, 5, 'Napod', 'Jonalyn', 'Jimenez', 'GMA, Cavite, Pob II', '09090909099', '1996-04-13', 24, 'Female', 'Filipino', NULL, 1),
(32, 5, 'Vibas', 'Von', 'PIlar', 'Brgy.Milagrosa, Carmona, Cavite', '09090909099', '1997-03-19', 23, 'Male', 'Filipino', NULL, 1),
(33, 5, 'Altre', 'Richard del', 'Sanidad', 'GMA, Cavite, Blk 21, Lot 1, Brgy. Pulido, Area H', '09095108960', '1998-12-20', 22, 'Male', 'Filipino', '1590303827.png', 1),
(34, 5, 'Altre', 'Richard del', 'Savidad', 'GMA, Cavite', '09090909099', '1998-12-02', 22, 'Male', 'Filipino', '1590575649.png', 1),
(35, 0, 'Ferreras', 'Devid', 'Pilarca', 'Dasmarinas, Cavite', '09090909099', '1998-12-31', 22, 'Male', 'Filipino', NULL, 0),
(36, 0, 'Ferreras', 'David', 'Pilarca', 'Dasmarinas, Cavite', '09090909090', '1998-12-31', 22, 'Male', 'Filipino', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `User_Id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Level` varchar(255) NOT NULL,
  `Date_started` date NOT NULL,
  `vkey` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`User_Id`, `Email`, `Password`, `Level`, `Date_started`, `vkey`, `verified`, `createdate`) VALUES
(1, 'headadmin@yahoo.com', '$2y$12$VQi6nJdVdrAiHzzuz3JOj.glHk0n5bdBuewpT3Xp1DSTJDBlhXhwe', 'Head Administrator', '2019-10-03', '', 1, '2020-05-27 13:55:36'),
(22, 'admin2@gmail.com', '$2y$12$bLiBRqr34dES6jCnP8pPNenQ9hPaMMDSEiyEydnI/SymztI3HtNsO', 'Administrator', '2020-04-07', '26221f6a0275ebc2d2812d0c5825b20a', 1, '2020-04-07 07:00:12'),
(23, 'admin1@gmail.com', '$2y$12$URGDktLLgs93lRy0EUshNurncXt13tgW.3/DMaB6C2vQNHuixI8wy', 'Administrator', '2020-04-07', 'fc0e75c937afc30cb4ddc9055db91950', 1, '2020-04-07 07:00:12'),
(25, 'davidpaul@gmail.com', '$2y$12$hDNo5hhFBqoarhANq6IN8e0cQtuXxPx0svSWNFEzj9Mbo6Rz9301.', 'Student', '2020-04-11', 'db6810820d8d7f8d07ef615644538812', 1, '2020-04-12 07:47:55'),
(26, 'richarddelaltre@yahoo.com', '$2y$12$sGQAgSwZIzwNu5gkILsfP.UP/wnEuOn87a3DJhh4jS28vtVCyJn/S', 'Student', '2020-04-13', '30575dc76c8af1020766f6d5da693382', 1, '2020-04-13 07:46:56'),
(27, 'renzekennard@gmail.com', '$2y$12$4qa8C/R0Vxc2FJVT3G4.dO1TfdnkhGV6Xydgjm34X2fB2Z7yYHAo.', 'Student', '2020-04-14', '582be64d2a7336444cc433be810ad1a0', 0, '2020-04-14 07:09:21'),
(28, 'ninjapeth@gmail.com', '$2y$12$hkYUtt3lFkiHTNCLe0yYw.9ie9fPiec6M2K0bXOMRV5iFP3chJQni', 'Student', '2020-04-14', '9478f80941f443cc60c43605c95cebe8', 0, '2020-04-14 07:21:23'),
(29, 'rodmark@gmail.com', '$2y$12$urxcZuqJJxzpcH4O0/cAVevwNyaNs6JIqxIdvAnRnD/.ep6NgYkEa', 'Student', '2020-04-14', 'a6b28fce5083f1c94dcd4187fa6ad602', 0, '2020-04-14 07:22:40'),
(30, 'christinejoybalmocena@gmail.com', '$2y$12$b1tRhIg8jeIRcI9adS5f3Oo2FCcXYTVaEwOj5kgcK6iBnJmSb47ia', 'Student', '2020-05-24', '35ea7e44a04f3fbc99fc1d095622627f', 0, '2020-05-24 06:52:17'),
(31, 'jonalynnapod@gmail.com', '$2y$12$WtSGHVK.FqoL6HTrPEC4pOcpji.1ZduxQefw93UchsJ4y82mHuzj2', 'Student', '2020-05-24', 'eefad1654f360d46383568b8c7c1a5df', 0, '2020-05-24 06:56:40'),
(32, 'vonvibas@gmail.com', '$2y$12$8.J75dU0M8xXKJkkTayTX.pFvsCfk2NrU2iV9NyxEkowXAwfLVWTG', 'Student', '2020-05-24', '5954611fad7e11d49071a8082fd35c57', 0, '2020-05-24 07:00:15'),
(33, 'monterorichard09@gmail.com', '$2y$12$uTWr9JhX8zpTUwO63fOL0.J5PFhbT/7p5mmhkFQUb.v05/mUbl8OK', 'Student', '2020-05-24', '267f2c62794311b80b0860d094985c14', 0, '2020-05-24 07:03:18'),
(34, 'richardmontero@gmail.com', '$2y$12$vJWPGu5vaRloRRwP.8hNr.tKRayGlaQwAgMPWL4BxxRFWpmbDwsTq', 'Student', '2020-05-27', 'a36a2c2fbe38669c070c2d1431a9221d', 0, '2020-05-27 10:36:33'),
(35, 'davidpaulferreras@gmail.com', '$2y$12$2Ug.YHTrdxjegi/f1xhAaO5rz3cg0jF1gu2G8v.EGZQb.87IRiHGa', 'Administrator', '2020-05-27', '6fe5a84e5ecb928ba16c59fb7f5ccfc1', 0, '2020-05-27 13:58:34'),
(36, 'davidpaulferreras@gmail.com', '$2y$12$8BwlmDsVF.4t1lBmBWJqk.NUYdckg.MdReCJUHHH9Y2QkyZ3wUw1W', 'Administrator', '2020-05-27', '6de5473cb7f0509b908cf6e3e85fe43d', 0, '2020-05-27 14:01:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us_tbl`
--
ALTER TABLE `about_us_tbl`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`Trans_Id`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`Att_Id`),
  ADD KEY `FK_Stud_class_Id` (`Stud_class_Id`);

--
-- Indexes for table `branches_tbl`
--
ALTER TABLE `branches_tbl`
  ADD PRIMARY KEY (`Branch_Id`) USING BTREE;

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`Category_Id`) USING BTREE;

--
-- Indexes for table `class_tbl`
--
ALTER TABLE `class_tbl`
  ADD PRIMARY KEY (`Class_Id`);

--
-- Indexes for table `days_tbl`
--
ALTER TABLE `days_tbl`
  ADD PRIMARY KEY (`Day_Id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`G_Id`);

--
-- Indexes for table `gallery_category`
--
ALTER TABLE `gallery_category`
  ADD PRIMARY KEY (`GC_Id`);

--
-- Indexes for table `lessons_tbl`
--
ALTER TABLE `lessons_tbl`
  ADD PRIMARY KEY (`Lesson_Id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Mess_Id`);

--
-- Indexes for table `products_tbl`
--
ALTER TABLE `products_tbl`
  ADD PRIMARY KEY (`Prod_Id`) USING BTREE;

--
-- Indexes for table `product_settings`
--
ALTER TABLE `product_settings`
  ADD PRIMARY KEY (`Prod_sett_Id`);

--
-- Indexes for table `prod_invt_tbl`
--
ALTER TABLE `prod_invt_tbl`
  ADD PRIMARY KEY (`Prod_Id`),
  ADD KEY `FK_Branch_Id` (`Branch_Id`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`Sales_details_Id`),
  ADD KEY `FK_Prod_Id` (`Prod_Id`);

--
-- Indexes for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD PRIMARY KEY (`Sales_Id`) USING BTREE,
  ADD KEY `FK_Branch_Id2` (`Branch_Id`);

--
-- Indexes for table `selected_class_tbl`
--
ALTER TABLE `selected_class_tbl`
  ADD PRIMARY KEY (`Selected_class_Id`);

--
-- Indexes for table `services_tbl`
--
ALTER TABLE `services_tbl`
  ADD PRIMARY KEY (`service_Id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`Transaction_Id`);

--
-- Indexes for table `stud_balances`
--
ALTER TABLE `stud_balances`
  ADD PRIMARY KEY (`Transaction_Id`);

--
-- Indexes for table `stud_class_tbl`
--
ALTER TABLE `stud_class_tbl`
  ADD PRIMARY KEY (`Stud_class_Id`),
  ADD KEY `FK_Class_Id` (`Class_Id`),
  ADD KEY `FK_Stud_Id` (`User_Id`);

--
-- Indexes for table `stud_status_tbl`
--
ALTER TABLE `stud_status_tbl`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `teacher_branch_tbl`
--
ALTER TABLE `teacher_branch_tbl`
  ADD PRIMARY KEY (`T_Branch_Id`);

--
-- Indexes for table `teacher_lesson_tbl`
--
ALTER TABLE `teacher_lesson_tbl`
  ADD PRIMARY KEY (`Tea_less_Id`);

--
-- Indexes for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  ADD PRIMARY KEY (`Teacher_Id`);

--
-- Indexes for table `time_tbl`
--
ALTER TABLE `time_tbl`
  ADD PRIMARY KEY (`Time_Id`);

--
-- Indexes for table `user_info_tbl`
--
ALTER TABLE `user_info_tbl`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `Trans_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `Att_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `branches_tbl`
--
ALTER TABLE `branches_tbl`
  MODIFY `Branch_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `Category_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `Class_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `days_tbl`
--
ALTER TABLE `days_tbl`
  MODIFY `Day_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `G_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gallery_category`
--
ALTER TABLE `gallery_category`
  MODIFY `GC_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `Mess_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products_tbl`
--
ALTER TABLE `products_tbl`
  MODIFY `Prod_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `product_settings`
--
ALTER TABLE `product_settings`
  MODIFY `Prod_sett_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prod_invt_tbl`
--
ALTER TABLE `prod_invt_tbl`
  MODIFY `Prod_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `Sales_details_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `Sales_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `selected_class_tbl`
--
ALTER TABLE `selected_class_tbl`
  MODIFY `Selected_class_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `services_tbl`
--
ALTER TABLE `services_tbl`
  MODIFY `service_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `Transaction_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `stud_balances`
--
ALTER TABLE `stud_balances`
  MODIFY `Transaction_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stud_class_tbl`
--
ALTER TABLE `stud_class_tbl`
  MODIFY `Stud_class_Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stud_status_tbl`
--
ALTER TABLE `stud_status_tbl`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `teacher_branch_tbl`
--
ALTER TABLE `teacher_branch_tbl`
  MODIFY `T_Branch_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher_lesson_tbl`
--
ALTER TABLE `teacher_lesson_tbl`
  MODIFY `Tea_less_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher_tbl`
--
ALTER TABLE `teacher_tbl`
  MODIFY `Teacher_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `time_tbl`
--
ALTER TABLE `time_tbl`
  MODIFY `Time_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_info_tbl`
--
ALTER TABLE `user_info_tbl`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
