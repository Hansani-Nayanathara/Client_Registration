-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 12:55 PM
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
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `Name` varchar(100) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phone_Number` int(10) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Re_Password` varchar(30) NOT NULL,
  `Profile_photo` text NOT NULL,
  `How_hear` varchar(50) NOT NULL,
  `Recommandation` varchar(100) NOT NULL,
  `Agree_Term` tinyint(4) NOT NULL,
  `OTP` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`Name`, `Email`, `Address`, `Phone_Number`, `Password`, `Re_Password`, `Profile_photo`, `How_hear`, `Recommandation`, `Agree_Term`, `OTP`) VALUES
('Hansani Albuker', 'hansani@gmail.com', 'Dompe', 112345678, 'Password@123', 'Password@123', 'FB_IMG_1650595269926.jpg', 'institue or university', 'yes', 1, NULL),
('Lesly Prasad', 'lesly@gmail.com', 'Gampaha', 114587296, 'Password@123', 'Password@123', 'FB_IMG_1655057308062.jpg', 'linkedin', 'yes', 1, '388100'),
('Nayanthara', 'hansani@gmail.com', 'Dompe', 112345678, 'Password@123', 'Password@123', 'FB_IMG_1651549900261.jpg', 'linkedin', 'no', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone_nu` int(10) NOT NULL,
  `profile_pic` varchar(800) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `email`, `phone_nu`, `profile_pic`, `added_by`) VALUES
('ANjalo', 'anjalo@gmail.com', 714565983, 'FB_IMG_1631333505139.jpg', 'Lesly Prasad'),
('hansi', 'hansi@gmail.com', 114578296, 'FB_IMG_1650534833231.jpg', 'Nayanthara'),
('Jayan', 'jayan@gmail.com', 114578296, 'FB_IMG_1631333505139.jpg', 'Nayanthara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
