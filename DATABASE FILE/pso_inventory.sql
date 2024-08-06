-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 06, 2024 at 11:57 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pso_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gender` text NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `co_number` bigint NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `dor` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `username`, `password`, `name`, `gender`, `email`, `address`, `co_number`, `profile_picture`, `dor`) VALUES
(1, 'admin', '18b274ba81464e5e74ed2d061fb6d8da', 'Jenny Mae Gabuya', 'Female', 'admin@gmail.com', 'Lip City, Batangas', 91234567892, 'IMG_20240723_215500_534.jpg', '2024-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `toWho` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `toWho`, `subject`, `message`, `date`) VALUES
(9, 'User', 'New Office Supplies Now Available—Check Out the Restock!', 'Renovation Going On...', '2024-08-05 12:13:54'),
(10, 'Staff', 'Updated Inventory: Essential Office Supplies Restocked', 'This is a demo announcement from admin', '2024-08-05 12:14:06'),
(29, 'User', 'Get Your New Office Supplies—Restock Complete', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ', '2024-08-05 12:15:08'),
(30, 'User', 'Stock of Office Supplies—Visit the Supply Room Today', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mollis aliquam ut porttitor leo a diam. Tellus integer feugiat scelerisque varius morbi. Duis ut diam quam nulla porttitor massa id', '2024-08-05 12:15:13'),
(32, 'Staff', 'Office Supply Room Update: New Items Added!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas diam in arcu cursus euismod quis viverra. In nisl nisi scelerisque eu ultrices vitae auctor. Laoreet sit amet cursus sit. V', '2024-08-05 12:14:20'),
(33, 'User', 'Get Your New Office Supplies—Restock Complete', 'send foods,,', '2024-08-05 12:15:38'),
(35, 'Staff', 'Office Supply Room Update: New Items Added!', 'We are pleased to announce that our office supply room has been restocked with a variety of new items to ensure you have everything you need to work efficiently and comfortably. The following supplies are now available:\r\n\r\nWriting ', '2024-08-05 12:15:31'),
(36, 'User', 'Exciting News: Office Supplies Have Been Refreshed and Restocked', 'We are excited to inform you that the office supply room has been refreshed and restocked with a variety of new items to support your daily work needs. Here’s what’s now available:\r\n\r\nWriting Tools: A fresh selection of pens, pencils, markers, and highlighters.\r\nPaper Supplies: Notebooks, sticky notes, printer paper, and legal pads.\r\nOrganizational Items: Folders, binders, file organizers, and desk trays.\r\nTech Accessories: USB drives, chargers, and mouse pads.\r\nMiscellaneous Supplies: Staplers, tape dispensers, scissors, and paper clips.\r\n\r\nPlease feel free to visit the supply room during office hours to pick up any items you need. If you have specific requirements or notice anything missing, don’t hesitate to contact the office manager, and we’ll do our best to accommodate your needs.', '2024-08-05 12:18:26'),
(37, 'Staff', 'Upcoming Audit Day: Preparation and Schedule', 'We want to inform you that our annual audit day is scheduled for [Date]. This audit is an important part of our efforts to ensure that all processes and records are accurate and up-to-date.\r\n\r\nPreparation Steps:\r\n\r\nDocumentation: Please ensure that all relevant documents and records are organized and accessible. This includes financial reports, inventory logs, and any other pertinent files.\r\nClean Up: Clear your workspaces and ensure that all electronic and physical files are properly filed.\r\nReview: Review any recent changes or updates in your department that may be relevant to the audit.\r\nIf you have any questions or need assistance in preparing for the audit, please contact [Audit Coordinator\'s Name] at [Contact Information].\r\n\r\nThank you for your cooperation and attention to this important process.', '2024-08-05 12:30:17'),
(41, 'User', 'testing ulit', 'hahasss', '2024-08-05 12:45:58'),
(42, 'User', 'testing sa truncate', 'testing sa truncate \r\n\r\nWe want to inform you that our annual audit day is scheduled for [Date]. This audit is an important part of our efforts to ensure that all processes and records are accurate and up-to-date. Preparation Steps: Documentation: Please ensure that all relevant documents and records are organized and accessible. This includes financial reports, inventory logs, and any other pertinent files. Clean Up: Clear your workspaces and ensure that all electronic and physical files are properly filed. Review: Review any recent changes or updates in your department that may be relevant to the audit. If you have any questions or need assistance in preparing for the audit, please contact [Audit Coordinator\'s Name] at [Contact Information]. Thank you for your cooperation and attention to this important process.', '2024-08-06 02:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `curr_date` text NOT NULL,
  `curr_time` text NOT NULL,
  `present` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `amount` int NOT NULL,
  `quantity` int NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `amount`, `quantity`, `vendor`, `description`, `address`, `contact`, `date`) VALUES
(3, 'Treadmillsas', 3636, 4, 'DnS', 'Edited Description', '7 Cedarstone Drive', '8521479633', '2019-03-07'),
(4, 'Vertical Press Machine', 949, 3, 'SS Industries', 'For Biceps And Triceps, Upper Back, Chest', '7 Cedarstone Drive', '1245558980', '2020-03-19'),
(5, 'Dumbell - Adjustable', 102, 26, 'Uptown Suppliers', 'Material: Steel, Rubber Plastic, Concrete', '7 Cedarstone Drive', '9875552100', '2020-03-29'),
(6, 'Multi Bench Press Machine', 219, 2, 'DnS Suppliers', '6 In 1 Multi Bench With Incline, Flat, Decline Ben', '7 Cedarstone Drive', '7410001010', '2020-04-05'),
(7, 'Demo', 265, 5, 'Demo', 'This is a demo test.', '77 Demo Lane', '8524445452', '2020-04-03'),
(10, 'RowWarrior Fitness Rowing Mach', 67392, 12, 'Roww Stores', 'HIGHEST QUALITY: This best of class air rowing mac', '52 Weekley Street', '7412580000', '2021-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dor` date NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `services` varchar(50) NOT NULL,
  `amount` int NOT NULL,
  `paid_date` date NOT NULL,
  `p_year` int NOT NULL,
  `plan` varchar(100) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `attendance_count` int NOT NULL,
  `ini_weight` int NOT NULL DEFAULT '0',
  `curr_weight` int NOT NULL DEFAULT '0',
  `ini_bodytype` varchar(50) NOT NULL,
  `curr_bodytype` varchar(50) NOT NULL,
  `progress_date` date NOT NULL,
  `reminder` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`user_id`, `fullname`, `username`, `email`, `password`, `gender`, `dor`, `profile_picture`, `services`, `amount`, `paid_date`, `p_year`, `plan`, `address`, `contact`, `status`, `attendance_count`, `ini_weight`, `curr_weight`, `ini_bodytype`, `curr_bodytype`, `progress_date`, `reminder`) VALUES
(30, 'Ryan Ceasar Ramos', 'ryan', 'ryan@gmail.com', '10c7ccc7a4f0aff03c915c485565b9da', 'Male', '2023-04-30', 'bsu_img.jpg', 'Cardio', 500, '2024-03-29', 0, '1', 'Cuenca', '2121323243', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(31, 'jen', 'jen', '', 'b18ea44550b68d0d012bd9017c4a864a', 'Male', '2020-01-22', '', 'Sauna', 35, '2024-04-02', 0, '1', 'Lipa', '0921892817', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(32, 'Maloi', 'maloi', 'maloi@gmail.com', '27dcb4f27958b0880d0e3f9e389f4ebf', 'Male', '2024-08-03', '', 'Cardio', 325, '2024-08-03', 2024, '365', 'Lemery, Batangas', '9123232432', 'Active', 0, 0, 0, '', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `charge` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `name`, `charge`) VALUES
(1, 'Fitness', '55'),
(2, 'Sauna', '35'),
(3, 'Cardio', '40');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

DROP TABLE IF EXISTS `reminder`;
CREATE TABLE IF NOT EXISTS `reminder` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`id`, `name`, `message`, `status`, `date`, `user_id`) VALUES
(12, 'staff', 'asd', 'unread', '2020-04-16 22:39:59', 0),
(13, 'staff', 'asdasdas', 'unread', '2020-04-16 22:40:49', 0),
(14, 'staff', 'ASasA', 'unread', '2020-04-16 22:41:59', 0),
(15, 'staff', 'asdasdasd', 'unread', '2020-04-16 22:42:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
CREATE TABLE IF NOT EXISTS `staffs` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(20) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `designation` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` bigint NOT NULL,
  `dor` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`user_id`, `username`, `password`, `email`, `fullname`, `address`, `profile_picture`, `designation`, `gender`, `contact`, `dor`) VALUES
(1, 'bruno', 'cac29d7a34687eb14b37068ee4708e7b', 'brunoden@mail.com', 'Bruno Den', '26 Morris Street', NULL, 'Cashier', 'Male', 2147483647, '2024-05-06'),
(2, 'michelle', 'cac29d7a34687eb14b37068ee4708e7b', 'michelle@mail.com', 'Michelle R. Lane', '61 Stone Lane', NULL, 'Trainer', 'Female', 2147483647, '2024-08-02'),
(3, 'james', 'cac29d7a34687eb14b37068ee4708e7b', 'jamesb@mail.com', 'James Brown', '12 Deer Ridge Drive', NULL, 'Trainer', 'Male', 2147483647, '2024-07-09'),
(4, 'bruce', 'cac29d7a34687eb14b37068ee4708e7b', 'bruce@mail.com', 'Bruce H. Klaus', '68 Lake Floyd Circle', NULL, 'Manager', 'Male', 1458887788, '2024-06-11'),
(5, 'jella', '00e24a10cba8b9f05da22d325d433938', 'jella@gmail.com', 'Jelladane Peloramas', 'Lipa', 'bsu_logo.png', 'Cashier', 'Female', 96312345672, '2024-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `task_status` varchar(50) NOT NULL,
  `task_desc` varchar(30) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `task_status`, `task_desc`, `user_id`) VALUES
(20, 'In Progress', 'Test Completed', 14),
(21, 'Pending', 'Mastering Crunches', 6),
(22, 'In Progress', 'Standing Workouts For Flat Abs', 6),
(23, 'In Progress', 'Triceps Buildup - 3 set', 14),
(24, 'Pending', 'Decline dumbbell bench press', 6),
(27, 'Pending', 'dddd', 0),
(28, 'In Progress', 'Test 1', 23),
(30, 'In Progress', '45 seconds planks', 29),
(32, 'In Progress', '34', 29);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
