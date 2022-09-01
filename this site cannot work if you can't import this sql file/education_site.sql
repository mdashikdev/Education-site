-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2022 at 02:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `education_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `usr_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_id` varchar(255) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `like_user` varchar(255) NOT NULL,
  `like_question_id` varchar(255) NOT NULL,
  `like_statur` varchar(255) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `like_user`, `like_question_id`, `like_statur`, `time`) VALUES
(21, '63109d175b369', '63109de53cf23', 'Like', '2022-09-01 11:56:24.995803'),
(22, '63109e04bd630', '63109de53cf23', 'Like', '2022-09-01 11:57:08.575627'),
(23, '63109e04bd630', '63109e4dbbe20', 'Like', '2022-09-01 11:58:37.320027'),
(24, '63109e7f2154b', '63109de53cf23', 'Like', '2022-09-01 11:59:10.829446');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `question_unique_id` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `owner`, `question_unique_id`, `question`, `answer`, `category`, `time`) VALUES
(5, '63109d175b369', '63109de53cf23', 'What is PHP?', '', 'Ict', '2022-09-01 11:56:21'),
(6, '63109e04bd630', '63109e4dbbe20', ' What do the initials of PHP stand for?', 'PHP stands for Hypertext Pre-processor.', 'Ict', '2022-09-01 11:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'profile.jpg',
  `bio` text NOT NULL,
  `studying` varchar(50) NOT NULL,
  `studied` varchar(50) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `name`, `email`, `pass`, `location`, `profile`, `bio`, `studying`, `studied`, `time`) VALUES
(5, '63109d175b369', 'Md Ashik', 'ashik@gmail.com', '2a8999a6ef94b4519ef3bc7d1784488842203005', 'Nazipur,Naogaon', 'profile.jpg', '', '', '', '2022-09-01 11:52:55.374637'),
(6, '63109e04bd630', 'Admin', 'admin@gmail.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'Nazipur,Naogaon', 'profile.jpg', '', '', '', '2022-09-01 11:56:52.776072'),
(7, '63109e7f2154b', 'Md Nazmul', 'nazmul@gmail.com', '93321662084dd7de392e51cc448fefc1b56f9e30', 'Nazipur,Naogaon', 'profile.jpg', '', '', '', '2022-09-01 11:58:55.136865');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`unique_id`),
  ADD UNIQUE KEY `unique` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
