-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2017 at 09:31 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kritarth`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter_activity`
--

CREATE TABLE `counter_activity` (
  `id` int(11) NOT NULL,
  `participant_name` text NOT NULL,
  `counterperson_name` text NOT NULL,
  `email` text NOT NULL,
  `regid` text NOT NULL,
  `amount` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter_activity`
--

INSERT INTO `counter_activity` (`id`, `participant_name`, `counterperson_name`, `email`, `regid`, `amount`, `timestamp`) VALUES
(1, 'Aditya', 'Abhijoy', 'asterdan712@gmail.com', 'KR00159', '200', '2017-10-10 06:45:35'),
(2, 'ABHIJOY', 'Abhijoy', 'asterdan712@gmail.com', 'KR00158', '200', '2017-10-10 06:45:35'),
(3, 'ABHIJOY', 'Abhijoy', 'asterdan712@gmail.com', 'KR00158', '200', '2017-10-10 06:45:35'),
(4, 'Aditya', 'Abhijoy', 'asterdan712@gmail.com', 'KR00159', '200', '2017-10-10 06:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `counter_guy`
--

CREATE TABLE `counter_guy` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter_guy`
--

INSERT INTO `counter_guy` (`id`, `name`, `email`, `password`) VALUES
(1, 'Abhijoy', 'asterdan712@gmail.com', 'iameonkid');

-- --------------------------------------------------------

--
-- Table structure for table `pass`
--

CREATE TABLE `pass` (
  `id` int(11) NOT NULL,
  `regid` text NOT NULL,
  `counterperson_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pass`
--

INSERT INTO `pass` (`id`, `regid`, `counterperson_name`) VALUES
(1, 'KR00127', 'ABHICOUNTER'),
(2, 'KR1048484', 'Abhijoy'),
(3, 'KR00158', 'Abhijoy'),
(4, 'KR00159', 'Abhijoy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `regid` varchar(10) NOT NULL,
  `name` text NOT NULL,
  `rollno` text NOT NULL,
  `university` text NOT NULL,
  `school` text NOT NULL,
  `email` text NOT NULL,
  `age` text NOT NULL,
  `gender` text NOT NULL,
  `phone` text NOT NULL,
  `event1` text NOT NULL,
  `event2` text NOT NULL,
  `paid` int(11) NOT NULL,
  `md5key` text NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regid`, `name`, `rollno`, `university`, `school`, `email`, `age`, `gender`, `phone`, `event1`, `event2`, `paid`, `md5key`, `verified`) VALUES
(158, 'KR00158', 'ABHIJOY SARKAR', '1505089', 'KIITian', 'KIIT University', 'asterdan712@gmail.com', '20', 'M', '9038906952', 'Storyfie', '', 200, '0dc7ff0aff5e2a09bca25fdd52e1d804', 0),
(159, 'KR00159', 'Aditya', '1505663', 'KIITian', 'KIIT University', 'aditya@gmail.com', '20', 'M', '9831075584', 'Storyfie', '', 200, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `webhook`
--

CREATE TABLE `webhook` (
  `id` int(11) NOT NULL,
  `payment_id` text NOT NULL,
  `payment_request_id` text NOT NULL,
  `kritarth_id` text NOT NULL,
  `status` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webhook`
--

INSERT INTO `webhook` (`id`, `payment_id`, `payment_request_id`, `kritarth_id`, `status`, `timestamp`) VALUES
(2, 'MOJO987654321', 'RID135798642', 'KR00127', 'successful', '2017-09-16 20:38:40'),
(13, '0e59df4be2c1b70ed2ed6c17623825726152f524', '0e59df4be2c1b70ed2ed6c17623825726152f524', '65c3591987154cdbf3cf26eb6c413e66edee7e07', '65c3591987154cdbf3cf26eb6c413e66edee7e07', '2017-09-16 20:38:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter_activity`
--
ALTER TABLE `counter_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter_guy`
--
ALTER TABLE `counter_guy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `regid` (`regid`);

--
-- Indexes for table `webhook`
--
ALTER TABLE `webhook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter_activity`
--
ALTER TABLE `counter_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `counter_guy`
--
ALTER TABLE `counter_guy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pass`
--
ALTER TABLE `pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `webhook`
--
ALTER TABLE `webhook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
