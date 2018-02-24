-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2018 at 07:14 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tranquil_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `entusers`
--

CREATE TABLE `entusers` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userStatus` enum('user','moderator','admin') NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userLastLogin` datetime NOT NULL,
  `userCreated` datetime NOT NULL,
  `userUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entusers`
--

INSERT INTO `entusers` (`userId`, `userName`, `userPass`, `userStatus`, `userEmail`, `userLastLogin`, `userCreated`, `userUpdated`) VALUES
(1, 'developer', 'cb7c066db57d4a076cec29404dfc6c00', 'admin', '', '2018-02-24 19:06:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entusers`
--
ALTER TABLE `entusers`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`,`userEmail`),
  ADD UNIQUE KEY `userId_2` (`userId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `userId_3` (`userId`),
  ADD KEY `userName_2` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entusers`
--
ALTER TABLE `entusers`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
