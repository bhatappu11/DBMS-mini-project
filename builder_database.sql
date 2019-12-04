-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 10:13 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `builder_database`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `disp` (IN `ID` INT(4) UNSIGNED)  select * from expenditure where Project_id in (select project_id from projects where Builder_id = ID)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `display` (IN `ID` INT(4) UNSIGNED)  SELECT Contractor_id, Contractor_name, PhoneNum from contractor WHERE Builder_id = ID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `builder`
--

CREATE TABLE `builder` (
  `Builder_id` int(4) NOT NULL,
  `Builder_name` varchar(20) NOT NULL,
  `BAddress` varchar(20) NOT NULL,
  `PhoneNum` varchar(13) NOT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `builder`
--

INSERT INTO `builder` (`Builder_id`, `Builder_name`, `BAddress`, `PhoneNum`, `password`) VALUES
(1, 'arpitha', 'Bangalore', '9191919191', 'appu1999'),
(2, 'test', 'Mangalore', '9576869705', 'testtest'),
(6, 'vani', 'keerthi royal palms', '8277371330', 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `contractor`
--

CREATE TABLE `contractor` (
  `Contractor_id` int(4) NOT NULL,
  `Contractor_name` varchar(20) NOT NULL DEFAULT 'NULL',
  `Builder_id` int(4) DEFAULT NULL,
  `PhoneNum` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contractor`
--

INSERT INTO `contractor` (`Contractor_id`, `Contractor_name`, `Builder_id`, `PhoneNum`) VALUES
(3, 'Jonathan', 1, '9090909012'),
(4, 'Lily', 1, '8923450982'),
(5, 'Tata', 2, '9696123456'),
(7, 'Jon snow', 6, '9801234567'),
(10, 'john', 2, '9883946484'),
(12, 'Surya', 2, '7349645776'),
(15, 'Apeksha', 2, '8272817287');

-- --------------------------------------------------------

--
-- Table structure for table `daily_schedule`
--

CREATE TABLE `daily_schedule` (
  `Builder_id` int(4) DEFAULT NULL,
  `Project_id` int(4) NOT NULL,
  `Available_emp` int(4) DEFAULT NULL,
  `Due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_schedule`
--

INSERT INTO `daily_schedule` (`Builder_id`, `Project_id`, `Available_emp`, `Due_date`) VALUES
(2, 12, 12, '2019-12-12'),
(2, 13, 10, '2019-12-30'),
(2, 14, 20, '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `Project_id` int(4) NOT NULL,
  `Total_amount` int(8) DEFAULT NULL,
  `Amount_spent` int(8) DEFAULT NULL,
  `Profit` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`Project_id`, `Total_amount`, `Amount_spent`, `Profit`) VALUES
(12, 100000, 80000, 20000),
(13, 200000, 190000, 10000);

--
-- Triggers `expenditure`
--
DELIMITER $$
CREATE TRIGGER `diff_check` BEFORE INSERT ON `expenditure` FOR EACH ROW if new.Profit < 0 then SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT="error";
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `personal_schedule`
--

CREATE TABLE `personal_schedule` (
  `Builder_id` int(4) NOT NULL,
  `Type_of_work` varchar(30) NOT NULL,
  `Due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal_schedule`
--

INSERT INTO `personal_schedule` (`Builder_id`, `Type_of_work`, `Due_date`) VALUES
(2, 'hospital', '2019-10-31'),
(2, 'hospital', '2019-12-10'),
(2, 'meeting', '2019-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(4) NOT NULL,
  `project_name` varchar(20) DEFAULT NULL,
  `Builder_id` int(4) DEFAULT NULL,
  `Contractor_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `Builder_id`, `Contractor_id`) VALUES
(6, 'Multistory building', 6, 7),
(12, 'NH11', 2, 10),
(13, 'road construction', 2, 12),
(14, 'Multistory building', 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `builder`
--
ALTER TABLE `builder`
  ADD PRIMARY KEY (`Builder_id`);

--
-- Indexes for table `contractor`
--
ALTER TABLE `contractor`
  ADD PRIMARY KEY (`Contractor_id`);

--
-- Indexes for table `daily_schedule`
--
ALTER TABLE `daily_schedule`
  ADD PRIMARY KEY (`Project_id`,`Due_date`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`Project_id`);

--
-- Indexes for table `personal_schedule`
--
ALTER TABLE `personal_schedule`
  ADD PRIMARY KEY (`Builder_id`,`Type_of_work`,`Due_date`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `builder`
--
ALTER TABLE `builder`
  MODIFY `Builder_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contractor`
--
ALTER TABLE `contractor`
  MODIFY `Contractor_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
