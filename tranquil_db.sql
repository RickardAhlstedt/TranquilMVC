-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 01:36 PM
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
-- Table structure for table `entconfig`
--

CREATE TABLE `entconfig` (
  `configId` int(11) NOT NULL,
  `configKey` varchar(255) NOT NULL,
  `configValue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entconfig`
--

INSERT INTO `entconfig` (`configId`, `configKey`, `configValue`) VALUES
(1, 'SITE_TITLE', 'Tranquil');

-- --------------------------------------------------------

--
-- Table structure for table `entinfocontent`
--

CREATE TABLE `entinfocontent` (
  `contentId` int(11) NOT NULL,
  `contentTitle` varchar(255) NOT NULL,
  `contentText` text NOT NULL,
  `contentMetaKeywords` text NOT NULL,
  `contentMetaDescription` text NOT NULL,
  `contentMetaCanonicalUrl` varchar(255) NOT NULL,
  `contentStatus` enum('active','preview','inactive') NOT NULL,
  `contentCreated` datetime NOT NULL,
  `contentUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entinfocontent`
--

INSERT INTO `entinfocontent` (`contentId`, `contentTitle`, `contentText`, `contentMetaKeywords`, `contentMetaDescription`, `contentMetaCanonicalUrl`, `contentStatus`, `contentCreated`, `contentUpdated`) VALUES
(1, 'Tranquil', '<p>Basic MVC and CMS</p>\r\n\r\n<div style="background:#eeeeee; border:1px solid #cccccc; padding:5px 10px">test</div>\r\n\r\n<p>tesatstaws</p>\r\n', 'meta, key, words', 'metadescription', '', 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `entnavigation`
--

CREATE TABLE `entnavigation` (
  `navigationId` int(11) NOT NULL,
  `navigationGroup` varchar(255) NOT NULL,
  `navigationParentId` int(11) NOT NULL,
  `navigationName` varchar(255) NOT NULL,
  `navigationHref` varchar(255) NOT NULL,
  `navigationBehavior` enum('_self','_blank','_parent','_top') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entnavigation`
--

INSERT INTO `entnavigation` (`navigationId`, `navigationGroup`, `navigationParentId`, `navigationName`, `navigationHref`, `navigationBehavior`) VALUES
(1, 'guest', 0, 'Home', '/', '_self'),
(2, 'guest', 1, 'Sub', '/', '_self');

-- --------------------------------------------------------

--
-- Table structure for table `entroutes`
--

CREATE TABLE `entroutes` (
  `routeId` int(11) NOT NULL,
  `routePath` varchar(255) NOT NULL,
  `routeTemplate` varchar(255) NOT NULL,
  `routeModel` varchar(255) NOT NULL,
  `routeView` varchar(255) NOT NULL,
  `routeViewId` int(11) NOT NULL,
  `routeCreated` datetime NOT NULL,
  `routeUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entroutes`
--

INSERT INTO `entroutes` (`routeId`, `routePath`, `routeTemplate`, `routeModel`, `routeView`, `routeViewId`, `routeCreated`, `routeUpdated`) VALUES
(1, '/', 'default', 'infoContent', 'show', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '/admin', 'admin', 'admin', 'admin', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '/admin/login', 'adminLogin', 'admin', 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '/admin/logout', 'admin', 'admin', 'logout', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '/admin/infoContent', 'admin', 'infoContent', 'list', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '/admin/infoContent/add', 'admin', 'infoContent', 'formAdd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(1, 'developer', '7e7aad44abe3c029bd3a7543520605e1', 'admin', '', '2018-03-02 14:16:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entconfig`
--
ALTER TABLE `entconfig`
  ADD PRIMARY KEY (`configId`,`configKey`) USING BTREE,
  ADD UNIQUE KEY `configKey` (`configKey`);

--
-- Indexes for table `entinfocontent`
--
ALTER TABLE `entinfocontent`
  ADD PRIMARY KEY (`contentId`);

--
-- Indexes for table `entnavigation`
--
ALTER TABLE `entnavigation`
  ADD PRIMARY KEY (`navigationId`);

--
-- Indexes for table `entroutes`
--
ALTER TABLE `entroutes`
  ADD PRIMARY KEY (`routeId`,`routePath`),
  ADD UNIQUE KEY `routePath` (`routePath`);

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
-- AUTO_INCREMENT for table `entconfig`
--
ALTER TABLE `entconfig`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `entinfocontent`
--
ALTER TABLE `entinfocontent`
  MODIFY `contentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `entnavigation`
--
ALTER TABLE `entnavigation`
  MODIFY `navigationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `entroutes`
--
ALTER TABLE `entroutes`
  MODIFY `routeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `entusers`
--
ALTER TABLE `entusers`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
