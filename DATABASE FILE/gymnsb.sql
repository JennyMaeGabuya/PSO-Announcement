-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2024 at 04:59 AM
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
-- Database: `gymnsb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `username`, `password`, `name`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `message`, `date`) VALUES
(9, 'Renovation Going On...', '2020-04-03 16:00:00'),
(10, 'This is a demo announcement from admin', '2022-06-02 16:00:00'),
(13, 'test to sawa', '2024-03-22 16:00:00'),
(14, 'talaga naman ay', '2024-03-14 16:00:00'),
(17, 'hello po, Good Friday', '2024-03-28 16:00:00'),
(18, 'hello ryan', '2024-04-01 16:00:00'),
(19, 'hello Jella', '2024-03-24 16:00:00'),
(20, 'rrer', '2024-04-01 16:00:00'),
(21, 'Hello everyone!', '2024-05-26 16:00:00'),
(22, 'sasasas', '2024-05-26 16:00:00'),
(23, 'asasasa', '2024-05-26 16:00:00'),
(24, 'asasasas', '2024-05-26 16:00:00'),
(25, 'testing ngga po', '2024-05-27 12:00:26'),
(26, 'testing ulit, HAHAHHA', '0000-00-00 00:00:00'),
(27, 'ttgfghfghj', '0000-00-00 00:00:00'),
(28, 'asasas', '2024-05-27 12:04:03'),
(29, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ', '2024-05-27 12:50:36'),
(30, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mollis aliquam ut porttitor leo a diam. Tellus integer feugiat scelerisque varius morbi. Duis ut diam quam nulla porttitor massa id', '2024-05-27 12:51:38'),
(32, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas diam in arcu cursus euismod quis viverra. In nisl nisi scelerisque eu ultrices vitae auctor. Laoreet sit amet cursus sit. V', '2024-05-27 13:03:38');

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
(3, 'Treadmill', 909, 4, 'DnS', 'Edited Description', '7 Cedarstone Drive', '8521479633', '2019-03-07'),
(4, 'Vertical Press Machine', 949, 3, 'SS Industries', 'For Biceps And Triceps, Upper Back, Chest', '7 Cedarstone Drive', '1245558980', '2020-03-19'),
(5, 'Dumbell - Adjustable', 102, 26, 'Uptown Suppliers', 'Material: Steel, Rubber Plastic, Concrete', '7 Cedarstone Drive', '9875552100', '2020-03-29'),
(6, 'Multi Bench Press Machine', 219, 2, 'DnS Suppliers', '6 In 1 Multi Bench With Incline, Flat, Decline Ben', '7 Cedarstone Drive', '7410001010', '2020-04-05'),
(7, 'Demo', 265, 5, 'Demo', 'This is a demo test.', '77 Demo Lane', '8524445452', '2020-04-03'),
(10, 'RowWarrior Fitness Rowing Mach', 5616, 12, 'Roww Stores', 'HIGHEST QUALITY: This best of class air rowing mac', '52 Weekley Street', '7412585555', '2021-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dor` date NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`user_id`, `fullname`, `username`, `password`, `gender`, `dor`, `services`, `amount`, `paid_date`, `p_year`, `plan`, `address`, `contact`, `status`, `attendance_count`, `ini_weight`, `curr_weight`, `ini_bodytype`, `curr_bodytype`, `progress_date`, `reminder`) VALUES
(6, 'Harry Denn', 'harry', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2024-05-27', 'Sauna', 4950, '2022-06-02', 2021, '30', '64 Mulberry Lane', '8545878545', 'Active', 0, 54, 62, 'Slim', 'Buffed', '2020-04-22', 1),
(8, 'Charles Anderson', 'charles', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2020-01-02', 'Fitness', 55, '2020-04-01', 2020, '3', '99 Heron Way', '8520258520', 'Active', 0, 92, 85, 'Fat', 'Bulked', '2020-04-22', 1),
(11, 'Justin Schexnayder', 'justin', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2019-01-25', 'Cardio', 35, '2020-03-31', 2020, '3', '14 Blair Court', '7535752220', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(14, 'Ryan Crowl', 'ryan', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2019-07-13', 'Fitness', 55, '2024-03-29', 2020, '1', '34 Twin Oaks Drive', '1578880010', 'Active', 0, 59, 63, 'Slim', 'Slim', '2020-04-23', 0),
(16, 'TrialsChanged', 'trials', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '2020-04-01', 'Fitness', 0, '2021-06-12', 2021, '0', '4 Demo Lane', '741111110', 'Expired', 26, 50, 61, 'Slim', 'Slim', '2021-06-11', 1),
(17, 'Karen McGray', 'karen', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '2020-04-02', 'Cardio', 120, '2022-05-31', 2020, '3', '23 Rubaiyat Road', '7441002540', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(18, 'Jeanne Pratt', 'prattj', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '2020-04-04', 'Fitness', 55, '2021-06-11', 2021, '1', '86 Hilltop Street', '7854445410', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(19, 'George Fann', 'george', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2019-04-02', 'Fitness', 55, '2021-06-11', 2021, '1', '43 Oak Drive', '0258987850', 'Active', 0, 0, 0, '', '', '0000-00-00', 1),
(20, 'Wendy Scott', 'wendy', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '2020-03-21', 'Fitness', 55, '2021-06-11', 2021, '1', '24 Cody Ridge Road', '8547896520', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(21, 'Patrick Wilson', 'patrick', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2020-04-02', 'Cardio', 120, '2022-06-01', 2021, '3', '24 Cody Ridge Road', '9874568520', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(22, 'Tommy Marks', 'tommy', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2020-04-01', 'Fitness', 55, '2020-04-05', 2020, '3', '22 Franklin Street', '8529997500', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(23, 'Keith Martin', 'martin', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '2020-04-02', 'Cardio', 120, '2022-06-02', 2021, '3', '89 Smithfield Avenue', '7895456250', 'Active', 1, 51, 68, 'Slim', 'Muscular', '2022-06-02', 0),
(24, 'Richard G Langston', 'richard', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '1990-02-02', 'Sauna', 420, '2022-05-31', 2022, '12', '541  Raoul Wallenber', '7012545580', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(25, 'Raymond Ledesma', 'raymond', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '1986-02-19', 'Cardio', 480, '2022-06-02', 2022, '12', '2954  Robinson Lane', '4785450002', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(26, 'Mattie F. Maher', 'mattie', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '1995-05-18', 'Sauna', 420, '2022-06-01', 2022, '12', '73 Settlers Lane', '9995554444', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(27, 'Justin C. Lusk', 'justin', 'cac29d7a34687eb14b37068ee4708e7b', 'Male', '1995-12-12', 'Cardio', 40, '2022-05-30', 2022, '1', '45 Bell Street', '3545785540', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(29, 'Kathy J. Glennon', 'kathy', 'cac29d7a34687eb14b37068ee4708e7b', 'Female', '2022-06-02', 'Fitness', 0, '2024-03-22', 0, '0', '87 Harry Place', '7896587458', 'Active', 1, 0, 0, '', '', '0000-00-00', 0),
(30, 'ryan', 'ryan', '10c7ccc7a4f0aff03c915c485565b9da', 'Male', '2023-04-30', 'Cardio', 500, '2024-03-29', 0, '1', 'Cuenca', '0912345678', 'Active', 0, 0, 0, '', '', '0000-00-00', 0),
(31, 'jen', 'jen', 'b18ea44550b68d0d012bd9017c4a864a', 'Male', '2020-01-22', 'Sauna', 35, '2024-04-02', 0, '1', 'Lipa', '0921892817', 'Active', 0, 0, 0, '', '', '0000-00-00', 0);

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
  `designation` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` int NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`user_id`, `username`, `password`, `email`, `fullname`, `address`, `designation`, `gender`, `contact`) VALUES
(1, 'bruno', 'cac29d7a34687eb14b37068ee4708e7b', 'brunoden@mail.com', 'Bruno Den', '26 Morris Street', 'Cashier', 'Male', 852028120),
(2, 'michelle', 'cac29d7a34687eb14b37068ee4708e7b', 'michelle@mail.com', 'Michelle R. Lane', '61 Stone Lane', 'Trainer', 'Female', 2147483647),
(3, 'james', 'cac29d7a34687eb14b37068ee4708e7b', 'jamesb@mail.com', 'James Brown', '12 Deer Ridge Drive', 'Trainer', 'Male', 2147483647),
(4, 'bruce', 'cac29d7a34687eb14b37068ee4708e7b', 'bruce@mail.com', 'Bruce H. Klaus', '68 Lake Floyd Circle', 'Manager', 'Male', 1458887788),
(5, 'jella', '00e24a10cba8b9f05da22d325d433938', 'katarinamarieann1@gmail.com', 'jella', 'Lipa', 'Cashier', 'Female', 2147483647);

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
