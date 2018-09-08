-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2018 at 01:38 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`User_ID`, `Username`, `Email`, `Password`) VALUES
(1, 'Root', 'conannui@hotmail.com', '70873e8580c9900986939611618d7b1e'),
(2, 'kamhcai_n', 'kamchai_n@outlok.com', '70873e8580c9900986939611618d7b1e'),
(3, 'SuperUser', 'Kamchai_N@outlook.com', '84fdb3a0f4dce64d3b6bab2eeab02cc3');

-- --------------------------------------------------------

--
-- Table structure for table `vote_choice`
--

CREATE TABLE `vote_choice` (
  `choice_ID` int(11) NOT NULL,
  `topic_ID` int(11) NOT NULL,
  `choice_text` varchar(250) NOT NULL,
  `choice_score` mediumtext NOT NULL,
  `graph_color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vote_choice`
--

INSERT INTO `vote_choice` (`choice_ID`, `topic_ID`, `choice_text`, `choice_score`, `graph_color`) VALUES
(1, 1, 'Firefox', '0', '#000000'),
(2, 1, 'Chrome', '10', '#000000'),
(3, 1, 'Safari', '0', '#000000'),
(4, 1, 'Opera', '0', '#000000'),
(5, 1, 'IE', '0', '#000000'),
(6, 2, 'Facebook', '0', '#000000'),
(7, 2, 'Line ', '0', '#000000'),
(8, 2, 'Instagram', '0', '#000000'),
(9, 2, 'Twitter', '0', '#000000'),
(10, 3, 'Windows OS', '1', '#000000'),
(11, 3, 'Mac OS', '0', '#000000'),
(12, 3, 'Linux', '0', '#000000'),
(13, 4, 'VEGAS Pro ', '0', '#000000'),
(14, 4, 'Adobe Premiere Pro', '0', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `vote_loguser`
--

CREATE TABLE `vote_loguser` (
  `logUser_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `Browser` varchar(20) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `OS` varchar(20) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vote_loguser`
--

INSERT INTO `vote_loguser` (`logUser_ID`, `User_ID`, `topic_id`, `Browser`, `IP`, `OS`, `Date`) VALUES
(1, 3, 5, 'Chrome', '127.0.0.1', 'Windows 10', '2018-09-03'),
(2, 3, 4, 'Chrome', '127.0.0.1', 'Windows 10', '2018-09-03'),
(3, 3, 5, 'Chrome', '::1', 'Windows 10', '2018-09-05'),
(4, 3, 4, 'Chrome', '::1', 'Windows 10', '2018-09-05'),
(5, 3, 3, 'Chrome', '::1', 'Linux', '2018-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `vote_topic`
--

CREATE TABLE `vote_topic` (
  `topic_ID` int(11) NOT NULL,
  `topic_text` varchar(250) NOT NULL,
  `topic_status` set('active','inactive') NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vote_topic`
--

INSERT INTO `vote_topic` (`topic_ID`, `topic_text`, `topic_status`, `User_ID`, `Date`) VALUES
(1, 'คุณใช้ Browser ใด', 'active', 3, '2018-09-07'),
(2, 'คุณเล่นโซเชียลเน็ตเวิร์คอะไรมากที่สุด', 'active', 3, '2018-09-07'),
(3, 'คุณใช้ระบบปฏิบัติการใด', 'active', 1, '2018-09-08'),
(4, 'คนใช้โปรแกรมตัดต่อใด', 'active', 3, '2018-09-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `vote_choice`
--
ALTER TABLE `vote_choice`
  ADD PRIMARY KEY (`choice_ID`);

--
-- Indexes for table `vote_loguser`
--
ALTER TABLE `vote_loguser`
  ADD PRIMARY KEY (`logUser_ID`);

--
-- Indexes for table `vote_topic`
--
ALTER TABLE `vote_topic`
  ADD PRIMARY KEY (`topic_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vote_choice`
--
ALTER TABLE `vote_choice`
  MODIFY `choice_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vote_loguser`
--
ALTER TABLE `vote_loguser`
  MODIFY `logUser_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vote_topic`
--
ALTER TABLE `vote_topic`
  MODIFY `topic_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
