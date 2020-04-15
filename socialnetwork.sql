-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2019 at 09:45 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GROUP_ID` int(11) NOT NULL,
  `GROUP_NAME` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GROUP_ID`, `GROUP_NAME`) VALUES
(1, 'MCA'),
(2, 'BE Mech'),
(3, 'AMCS');

-- --------------------------------------------------------

--
-- Table structure for table `groups_membership`
--

CREATE TABLE `groups_membership` (
  `MEMBERSHIP_ID` int(11) NOT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `GROUP_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups_membership`
--

INSERT INTO `groups_membership` (`MEMBERSHIP_ID`, `USER_ID`, `GROUP_ID`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_caption` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_public` char(1) NOT NULL,
  `post_by` int(11) NOT NULL,
  `has_attachment` varchar(10) DEFAULT NULL,
  `attachment_name` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_caption`, `post_time`, `post_public`, `post_by`, `has_attachment`, `attachment_name`) VALUES
(80, '<h3>My first post at Social Network app</h3>\r\n<p>Hope this platform helps people to socialize!!</p>', '2019-12-05 05:00:41', 'Y', 6, NULL, NULL),
(105, '<p>Post with PDF</p>', '2019-12-05 08:27:07', 'Y', 6, 'pdf', 'careers360.pdf'),
(106, '<p>Post with image</p>', '2019-12-05 08:39:36', 'Y', 6, 'jpg', 'brendaneich25607.web_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post_publish`
--

CREATE TABLE `post_publish` (
  `PUBLISH_ID` int(11) NOT NULL,
  `POSTID` int(11) NOT NULL,
  `GROUP_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_publish`
--

INSERT INTO `post_publish` (`PUBLISH_ID`, `POSTID`, `GROUP_ID`) VALUES
(16, 40, 1),
(17, 40, 2),
(18, 40, 3),
(19, 41, 1),
(20, 41, 2),
(21, 41, 3),
(22, 42, 1),
(23, 42, 2),
(24, 42, 3),
(25, 43, 1),
(26, 43, 2),
(27, 43, 3),
(28, 44, 1),
(29, 44, 2),
(30, 44, 3),
(31, 45, 1),
(32, 45, 2),
(33, 45, 3),
(34, 46, 1),
(35, 46, 2),
(36, 46, 3),
(37, 47, 1),
(38, 47, 2),
(39, 47, 3),
(40, 48, 1),
(41, 48, 2),
(42, 48, 3),
(43, 49, 1),
(44, 49, 2),
(45, 49, 3),
(46, 50, 1),
(47, 50, 2),
(48, 50, 3),
(49, 51, 1),
(50, 51, 2),
(51, 51, 3),
(52, 52, 1),
(53, 52, 2),
(54, 52, 3),
(55, 53, 1),
(56, 53, 2),
(57, 53, 3),
(58, 54, 1),
(59, 54, 2),
(60, 54, 3),
(61, 55, 1),
(62, 55, 2),
(63, 55, 3),
(64, 56, 1),
(65, 56, 2),
(66, 56, 3),
(67, 57, 1),
(68, 57, 2),
(69, 57, 3),
(70, 58, 1),
(71, 58, 2),
(72, 58, 3),
(73, 59, 1),
(74, 59, 2),
(75, 59, 3),
(76, 60, 1),
(77, 60, 2),
(78, 60, 3),
(79, 61, 1),
(80, 61, 2),
(81, 61, 3),
(82, 62, 1),
(83, 62, 2),
(84, 62, 3),
(85, 63, 1),
(86, 63, 2),
(87, 63, 3),
(88, 64, 1),
(89, 64, 2),
(90, 64, 3),
(91, 65, 1),
(92, 65, 2),
(93, 65, 3),
(94, 66, 1),
(95, 66, 2),
(96, 66, 3),
(97, 67, 1),
(98, 67, 2),
(99, 67, 3),
(100, 68, 1),
(101, 68, 2),
(102, 68, 3),
(103, 69, 1),
(104, 69, 2),
(105, 69, 3),
(106, 70, 1),
(107, 70, 2),
(108, 70, 3),
(109, 74, 2),
(110, 74, 3),
(111, 75, 2),
(112, 75, 3),
(113, 76, 2),
(114, 76, 3),
(115, 77, 2),
(116, 77, 3),
(117, 78, 1),
(118, 78, 2),
(119, 78, 3),
(120, 79, 1),
(121, 80, 3),
(122, 81, 1),
(123, 81, 2),
(124, 81, 3),
(125, 82, 1),
(126, 82, 2),
(127, 82, 3),
(128, 83, 1),
(129, 84, 1),
(130, 85, 1),
(131, 86, 1),
(132, 87, 1),
(133, 88, 1),
(134, 89, 1),
(135, 90, 1),
(136, 91, 1),
(137, 92, 1),
(138, 93, 1),
(139, 94, 1),
(140, 95, 1),
(141, 96, 1),
(142, 97, 1),
(143, 98, 1),
(144, 99, 1),
(145, 99, 1),
(146, 99, 1),
(147, 99, 1),
(148, 99, 1),
(149, 99, 1),
(150, 100, 1),
(151, 101, 1),
(152, 102, 1),
(153, 103, 1),
(154, 104, 1),
(155, 105, 1),
(156, 106, 1),
(157, 107, 1),
(158, 107, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(20) NOT NULL,
  `user_lastname` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_gender` char(1) NOT NULL,
  `USER_LEVEL` varchar(1) DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_password`, `user_email`, `user_gender`, `USER_LEVEL`) VALUES
(3, 'Rama', 'lakshmi', 'everdeen', '18mx111', 'F', 'S'),
(4, 'Jothi', 'Ram', 'aryastark', '18mx106', 'M', 'S'),
(6, 'Vino', 'dhini', 'vino', '18mx120', 'F', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user_chat`
--

CREATE TABLE `user_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_from` int(11) DEFAULT NULL,
  `chat_to` int(11) DEFAULT NULL,
  `chat_msg` varchar(1000) DEFAULT NULL,
  `red_by_admin` int(11) DEFAULT 0,
  `msg_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_chat`
--

INSERT INTO `user_chat` (`chat_id`, `chat_from`, `chat_to`, `chat_msg`, `red_by_admin`, `msg_time`) VALUES
(1, 4, 6, 'Hi Vino', 1, '2019-12-04 22:53:59'),
(2, 3, 4, 'Hi Jothi. How are you', 1, '2019-12-04 22:53:59'),
(3, 4, 6, 'Fine How about you', 1, '2019-12-04 22:53:59'),
(4, 4, 6, 'Its been a long time to see you', 1, '2019-12-04 22:53:59'),
(11, 6, 4, 'Yeah!', 1, '2019-12-04 22:53:59'),
(12, 6, 4, 'How about you???', 1, '2019-12-04 22:53:59'),
(14, 4, 6, 'Fine', 1, '2019-12-04 22:53:59'),
(15, 6, 4, 'How is your work going', 1, '2019-12-04 22:53:59'),
(25, 4, 6, 'Awesome', 1, '2019-12-04 23:52:59'),
(26, 4, 6, 'How was the day??', 1, '2019-12-05 10:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_phone`
--

CREATE TABLE `user_phone` (
  `user_id` int(11) DEFAULT NULL,
  `user_phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_phone`
--

INSERT INTO `user_phone` (`user_id`, `user_phone`) VALUES
(1, 1234567899);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GROUP_ID`);

--
-- Indexes for table `groups_membership`
--
ALTER TABLE `groups_membership`
  ADD PRIMARY KEY (`MEMBERSHIP_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `post_publish`
--
ALTER TABLE `post_publish`
  ADD PRIMARY KEY (`PUBLISH_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_chat`
--
ALTER TABLE `user_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `GROUP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups_membership`
--
ALTER TABLE `groups_membership`
  MODIFY `MEMBERSHIP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `post_publish`
--
ALTER TABLE `post_publish`
  MODIFY `PUBLISH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
