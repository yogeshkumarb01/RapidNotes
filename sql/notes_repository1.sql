-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 04:51 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes_repository`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass`) VALUES
(1, 'admin@rapidnotes', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depart_id` int(11) NOT NULL,
  `depart_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depart_id`, `depart_name`) VALUES
(19, 'BAJ'),
(18, 'BBA'),
(3, 'BCOM'),
(17, 'BCA'),
(20, 'Mcom');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `notes_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`notes_id`) VALUES
('Product Management unit1-9648'),
('unit1-1209'),
('unit1-2890'),
('unit1-5647'),
('unit1-7291'),
('unit1-8493'),
('UNIT2-6017'),
('Web programming lab-7439');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notes_id` varchar(50) NOT NULL,
  `depart_id` int(10) NOT NULL,
  `title` varchar(150) NOT NULL,
  `size` int(100) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `notes_pass` varchar(50) DEFAULT NULL,
  `file_type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`notes_id`, `depart_id`, `title`, `size`, `teacher_id`, `file_name`, `notes_pass`, `file_type`) VALUES
('AUDIT Unit1-6473', 18, 'AUDIT Unit1', 432528, 20, 'Chapter-1  Introduction  to audit.pdf', 'IrBdi8EXNk', 'application/pdf'),
('EIB UNIT 1-9384', 18, 'EIB UNIT 1', 511867, 19, 'Chapter 1 Evolution of IB.pdf', 'F1VegQEbMz', 'application/pdf'),
('Product Management unit1-9648', 3, 'Product Management unit1', 2023961, 18, 'Unit I - Product Management.pdf', '', 'application/pdf'),
('INCOME TAX-5429', 3, 'INCOME TAX', 983723, 17, 'UNIT ONE.pdf', 'JAmpaV2d4h', 'application/pdf'),
('WP Unit1 notes-5981', 17, 'WP Unit1 notes', 17894455, 16, 'UNIT1 2021(1).pdf', 'gG', 'application/pdf'),
('Web programming lab-7439', 17, 'Web programming lab', 804694, 16, 'Web Lab Manual - 2021 (1).pdf', '', 'application/pdf'),
('System Programming-0167', 17, 'System Programming', 3413264, 15, 'unit-1& unit-2 SP.pdf', 'wTsLUVQ3nO', 'application/pdf'),
('Political science-3618', 19, 'Political science', 158401, 21, 'hoflbpreform.pdf', 'UJZkdBVcxa', 'application/pdf'),
('unit1-8493', 17, 'unit1', 3021574, 16, 'TEXTBOOK MCQ-UNIT 1.pdf', '', 'application/pdf'),
('UNIT2-6017', 17, 'UNIT2', 983723, 16, 'UNIT ONE.pdf', '', 'application/pdf'),
('PART1-0651', 3, 'PART1', 5745928, 17, 'UNIT 1 CUSTOM ACT.pdf', '23S8BZzrCE', 'application/pdf'),
('UNIT1-5140', 3, 'UNIT1', 4543585, 17, 'Unit I - INTRODUCTION TO RETAILING.pdf', 'E49ncA2Ur6', 'application/pdf'),
('unit1-5647', 17, 'unit1', 804694, 22, 'Web Lab Manual - 2021.pdf', '', 'application/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL,
  `feedback` varchar(20) NOT NULL,
  `suggestions` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `name`, `email`, `phone`, `feedback`, `suggestions`) VALUES
(1, 'Sandhya A', 'sanjaya@airforcescho', 939393999, 'excellent', 'xyz'),
(2, 'PRASHANTH', 'prashanthsparkz@gmai', 2147483647, 'excellent', 'VERY GOOD PROJECT\r\nA'),
(3, 'SANJAY', 'Sanjay1@gmail.com', 2147483647, 'good', 'great '),
(4, 'Sneha', 'sneha12@gmail.com', 2147483647, 'neutral', 'useful content'),
(5, 'Shravya', 'shravya1@gmail.com', 2147483647, 'excellent', 'time saver'),
(6, 'Rithish', 'rithishshetty05@gmai', 2147483647, 'excellent', 'Very good'),
(7, '', '', 0, 'excellent', 'hehehehe'),
(8, '', '', 0, 'excellent', 'Good'),
(9, '', '', 0, 'excellent', 'nnnnnn');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `usn` varchar(20) NOT NULL,
  `depart_id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`usn`, `depart_id`, `email`, `name`, `lname`, `pass`) VALUES
('r1811737', 1, 'sandysandhya910@gmail.com', 'Sandhya', 'A', 'sandy123'),
('R1811722', 17, 'prashanthsparks@gmail.com', 'Prashanth', 'T', 'PRASHANTH'),
('R1811739', 3, 'sanjaycheeku@gmail.com', 'Sanjay', 'P', 'SANJAY'),
('R1811721', 18, 'bhumivk@gmail.com', 'Bhumi', 'VK', 'bhumi');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `depart_id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `depart_id`, `email`, `pass`) VALUES
(22, 'abc', 17, 'abc@gmail.com', '2001'),
(21, 'Meera', 19, 'meera21@gmail.com', 'meera'),
(20, 'Shravya.S', 18, 'shravya2@gmail.com', 'shravya'),
(19, 'Seenu.A', 18, 'seenu1@gmail.com', 'seenu'),
(18, 'Esha.Shetty', 3, 'eshashetty@gmail.com', 'esha'),
(17, 'Manjushree ', 3, 'manjushree@gmail.com', 'manjushree'),
(16, 'DEEPA.S', 17, 'deepas@gmail.com', 'DEEPA1'),
(15, 'Suma.P', 17, 'suma@gmail.com', 'sumap');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`notes_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`usn`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
