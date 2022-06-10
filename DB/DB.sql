-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 09:27 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oggy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(75) NOT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `regi_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `password`, `email`, `is_deleted`, `last_login`, `regi_date`) VALUES
(27, 'Lesi', 'LK', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin@gmail.com', NULL, '2022-06-08 17:20:12', '2022-06-08 11:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `message` varchar(500) NOT NULL,
  `is_deleted` int(11) DEFAULT NULL,
  `time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `message`, `is_deleted`, `time`) VALUES
(3, 'Alex Lanka', 'www.royanharsha6@gmail.com', 'hi', NULL, '2022-06-05 16:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `fav_by` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `id` int(11) NOT NULL,
  `by_ID` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `title` varchar(40) NOT NULL,
  `price` int(11) NOT NULL,
  `infor` varchar(500) NOT NULL,
  `map_fram` longtext DEFAULT NULL,
  `image1` varchar(40) DEFAULT NULL,
  `image2` varchar(40) DEFAULT NULL,
  `image3` varchar(40) DEFAULT NULL,
  `adminConform` tinyint(4) DEFAULT NULL,
  `is_Buy` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `by_ID`, `type`, `title`, `price`, `infor`, `map_fram`, `image1`, `image2`, `image3`, `adminConform`, `is_Buy`, `is_deleted`, `time`) VALUES
(544, 28, 'rent', 'Two storey house ', 45000, '3 Bedrooms<br />\r\nBathroom<br />\r\nLiving, Kitchen<br />\r\n<br />\r\nTotal floor area – 2500sqft.<br />\r\nFully tilled<br />\r\nSingle phase electricity<br />\r\nWell water with overhead tank<br />\r\nBoundaries – Covered by parapet wall<br />\r\nParking space for 3 vehicles<br />\r\nLarge back yard<br />\r\nGood neighbours', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2863146.4709788747!2d80.68030000264814!3d7.661658269605721!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1654451140484!5m2!1sen!2slk\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '629cebce0dcce-1654451150.jpg', '629cebce0e20c-1654451150.jpg', '629cebce0e7f2-1654451150.jpg', 1, NULL, NULL, '2022-06-05 17:45:50'),
(545, 28, 'rent', 'House for sale', 65000, 'Special Description<br />\r\nTotal floor area – 1400sqft.<br />\r\nSingle-phase electricity<br />\r\nPipe born water<br />\r\nHome wiring completed for CCTV<br />\r\nBoundaries – Covered by a parapet wall<br />\r\nParking space for 2 vehicles<br />\r\nGood neighbors', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2863146.4709788747!2d80.68030000264814!3d7.661658269605721!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1654451140484!5m2!1sen!2slk\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '629cec9155ffd-1654451345.jpg', '629cec91562cd-1654451345.jpg', '629cec915658a-1654451345.jpg', NULL, NULL, NULL, '2022-06-05 17:49:05'),
(546, 28, 'rent', 'New House for sale', 900000, '3 Bedrooms<br />\r\n2 Bathrooms (1 not completed, Provision for outside toilet)<br />\r\nLiving, Dining<br />\r\nPantry<br />\r\n<br />\r\nTotal floor area – 1400sqft.<br />\r\nSingle-phase electricity<br />\r\nPipe born water<br />\r\nHome wiring completed for CCTV<br />\r\nBoundaries – Covered by a parapet wall<br />\r\nParking space for 2 vehicles<br />\r\nGood neighbors', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d2863146.4709788747!2d80.68030000264814!3d7.661658269605721!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1654451140484!5m2!1sen!2slk\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '629cece525ca0-1654451429.jpg', '629cece5260a8-1654451429.jpg', '629cece526386-1654451429.jpg', NULL, NULL, NULL, '2022-06-05 17:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `for_ID` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `history_type` varchar(75) NOT NULL,
  `title` varchar(150) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `history_type`, `title`, `time`) VALUES
(534, 28, 'Post Approved', 'Your Post Approved BY Admin', '2022-06-05 20:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` int(12) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(75) NOT NULL,
  `nic` varchar(13) DEFAULT NULL,
  `province` varchar(30) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `regi_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `contact_number`, `password`, `email`, `nic`, `province`, `district`, `address`, `is_deleted`, `last_login`, `regi_date`) VALUES
(28, 'Royan', 'Harsha', 771234567, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'royanharsha6@gmail.com', '199810012654', 'Southern', 'Galle', 'Hiyare ', 0, '2022-06-06 20:21:23', '2022-06-06 14:51:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=575;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=547;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
