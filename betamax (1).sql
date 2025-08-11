-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2024 at 04:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betamax`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountinfo`
--

CREATE TABLE `accountinfo` (
  `userID` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_stock`
--

CREATE TABLE `blood_stock` (
  `id` int(11) NOT NULL,
  `blood_type` varchar(5) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_stock`
--

INSERT INTO `blood_stock` (`id`, `blood_type`, `stock`) VALUES
(1, 'A+', 99),
(2, 'A-', 100),
(3, 'B+', 100),
(4, 'B-', 100),
(5, 'O+', 100),
(6, 'O-', 100),
(7, 'AB+', 100),
(8, 'AB-', 100);

-- --------------------------------------------------------

--
-- Table structure for table `customerdetails`
--

CREATE TABLE `customerdetails` (
  `userID` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `currentaddress` text DEFAULT NULL,
  `permanentaddress` text DEFAULT NULL,
  `number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `donorno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL,
  `q1` enum('yes','no') DEFAULT NULL,
  `q2` enum('yes','no') DEFAULT NULL,
  `q3` enum('yes','no') DEFAULT NULL,
  `q4` enum('yes','no') DEFAULT NULL,
  `q5` enum('yes','no') DEFAULT NULL,
  `q6a` enum('yes','no') DEFAULT NULL,
  `q6b` enum('yes','no') DEFAULT NULL,
  `q6c` enum('yes','no') DEFAULT NULL,
  `q6d` enum('yes','no') DEFAULT NULL,
  `q6e` enum('yes','no') DEFAULT NULL,
  `q7` enum('yes','no') DEFAULT NULL,
  `q8a` enum('yes','no') DEFAULT NULL,
  `q8b` enum('yes','no') DEFAULT NULL,
  `q9` enum('yes','no') DEFAULT NULL,
  `q9a` enum('yes','no') DEFAULT NULL,
  `q9b` enum('yes','no') DEFAULT NULL,
  `q9c` enum('yes','no') DEFAULT NULL,
  `q10` enum('yes','no') DEFAULT NULL,
  `q11` enum('yes','no') DEFAULT NULL,
  `q12` enum('yes','no') DEFAULT NULL,
  `q13` enum('yes','no') DEFAULT NULL,
  `q13a` enum('yes','no') DEFAULT NULL,
  `q13b` enum('yes','no') DEFAULT NULL,
  `other` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requestform`
--

CREATE TABLE `requestform` (
  `customerName` varchar(255) NOT NULL,
  `requestnumber` int(11) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `medicalcondition` text DEFAULT NULL,
  `hospitalname` varchar(255) NOT NULL,
  `hospitaladdress` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk`
--

CREATE TABLE `risk` (
  `id` int(11) NOT NULL,
  `q2_1` enum('yes','no') NOT NULL,
  `q2_2` enum('yes','no') NOT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `other_reason` varchar(255) DEFAULT NULL,
  `q2_4` enum('yes','no') NOT NULL,
  `q2_5` enum('yes','no') NOT NULL,
  `q2_6` enum('yes','no') NOT NULL,
  `q2_7a` enum('yes','no') NOT NULL,
  `q2_7b` enum('yes','no') NOT NULL,
  `q2_7c` enum('yes','no') NOT NULL,
  `q2_8` enum('yes','no') NOT NULL,
  `q2_9` enum('yes','no') NOT NULL,
  `q2_10` enum('yes','no') NOT NULL,
  `q2_11` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `userID` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountinfo`
--
ALTER TABLE `accountinfo`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `blood_stock`
--
ALTER TABLE `blood_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerdetails`
--
ALTER TABLE `customerdetails`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email_address` (`email`),
  ADD UNIQUE KEY `donor_number` (`donorno`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestform`
--
ALTER TABLE `requestform`
  ADD PRIMARY KEY (`requestnumber`);

--
-- Indexes for table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountinfo`
--
ALTER TABLE `accountinfo`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `blood_stock`
--
ALTER TABLE `blood_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customerdetails`
--
ALTER TABLE `customerdetails`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `requestform`
--
ALTER TABLE `requestform`
  MODIFY `requestnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `risk`
--
ALTER TABLE `risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
