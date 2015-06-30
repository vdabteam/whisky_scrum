-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2015 at 03:53 PM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `whiskyclub`
--
CREATE DATABASE IF NOT EXISTS `whiskyclub` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `whiskyclub`;

-- --------------------------------------------------------

--
-- Table structure for table `barrels`
--

CREATE TABLE IF NOT EXISTS `barrels` (
`id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barrels`
--

INSERT INTO `barrels` (`id`, `type`) VALUES
(0, 'unknown');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `whisky_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distilleries`
--

CREATE TABLE IF NOT EXISTS `distilleries` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distilleries`
--

INSERT INTO `distilleries` (`id`, `name`, `address`, `city`, `country`, `region`) VALUES
(1, 'Caol Ila', '/', 'Port Askaig', 'Scotland', 'Islay'),
(2, 'Bowmore', 'School street', 'Bowmore', 'Scotland', 'Islay'),
(3, 'Buffalo Trace', 'Great Buffalo Trace 113', 'Frankfort, KY', 'United States', '/'),
(4, 'Yamazaki', 'Mishimagun', 'Osaka', 'Japan', '/'),
(5, 'Kilbeggan', 'Lower Main St.', 'Westmeath', 'Ireland', '/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `image_path` varchar(255) NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `admin`, `blocked`, `image_path`, `registration_date`) VALUES
(1, 'admin', '$2y$10$CzknNIJDR3JbtrTVzy4Fa.Wyz82KZVDcjoGoy1L4IQzOl/WWq3boa', 'admin@mail.com', 'John', 'Smith', 1, 0, ' image.img', '2015-06-16'),
(2, 'user', '$2y$10$CGSgFgDLOJXoEHEy9TuG0uKOXYv4q6ZLqJcpwFz5hpL8qS0yaO.vS', 'user@mail.com', 'Peter', 'Jackson', 0, 0, 'user.img', '2015-06-30'),
(3, 'arni', '4646', 'gsdgsdgsd', 'dsfgdsgsdg', 'dgfsddfg', 0, 0, 'dsgsd', '2015-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `whiskies`
--

CREATE TABLE IF NOT EXISTS `whiskies` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distillery_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `barrel_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL,
  `rating_aroma` int(11) NOT NULL,
  `rating_color` int(11) NOT NULL,
  `rating_taste` int(11) NOT NULL,
  `rating_aftertaste` int(11) NOT NULL,
  `text_aroma` longtext NOT NULL,
  `text_color` longtext NOT NULL,
  `text_taste` longtext NOT NULL,
  `text_aftertaste` longtext NOT NULL,
  `review` longtext NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whiskies`
--

INSERT INTO `whiskies` (`id`, `name`, `distillery_id`, `price`, `age`, `strength`, `barrel_id`, `image_path`, `hidden`, `creation_date`, `rating_aroma`, `rating_color`, `rating_taste`, `rating_aftertaste`, `text_aroma`, `text_color`, `text_taste`, `text_aftertaste`, `review`, `user_id`) VALUES
(1, 'Caol Ila 12', 1, 32, 12, 43, 0, 'caol_ila_12.jpg', 0, '2030-06-15', 8, 8, 8, 8, 'Lorem Ipsum', 'Dolor sit', 'Amet Consectetur', 'Adipiscing', 'elit', 1),
(2, 'Caol Ila 14', 1, 72, 14, 59, 0, 'caol_ila_14.jpg', 0, '2030-06-15', 7, 8, 7, 8, 'Lorem', 'Ipsum dolor', 'Sit Amet', 'Consectetur', 'Adipiscing elit', 1),
(3, 'The Manager''s Dram', 1, 2, 15, 63, 0, 'managers_dram.jpg', 0, '2030-06-15', 9, 8, 9, 9, 'Lorem Ipsum', 'Dolor sit', 'Amet Consectetur', 'Adipiscing', 'elit', 1),
(4, 'Caol Ila 1968 Sa', 1, 2, 14, 57, 0, 'caol_ila_1968.jpg', 0, '2030-06-15', 8, 7, 8, 9, 'Smells like whisky', 'Looks like whisky', 'Tastes like whisky', 'Still tastes like whisky', 'Definitely whisky', 1),
(5, 'Bowmore 8', 2, 103, 8, 40, 0, 'bowmore_8.jpg', 0, '2030-06-15', 8, 8, 7, 7, 'More whisky', 'whisky', 'whisky', 'whisky', 'Still whisky', 1),
(6, 'Bowmore 100 Degrees Proof', 2, 49, 0, 57, 0, 'bowmore_100_degrees_proof.jpg', 0, '2030-06-15', 7, 8, 9, 8, 'Smells okay', 'Looks fine', 'Tastes good', 'Aftertaste  not great', 'So so.', 1),
(7, 'Bowmore 12', 2, 109, 12, 43, 0, 'bowmore_12.jpg', 0, '2030-06-15', 8, 9, 8, 7, 'Hmmmm.', 'Nice!', 'Tasty!', 'Burp!', 'Awesome!', 1),
(8, 'Blanton''s Gold Edition', 3, 67, 0, 51, 0, 'blantons_gold_edition.jpg', 0, '2001-07-15', 9, 8, 7, 8, 'Uhm.', 'Uhm.', 'Uhm.', 'Uhm.', 'Okay then.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barrels`
--
ALTER TABLE `barrels`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `whisky_id` (`whisky_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `distilleries`
--
ALTER TABLE `distilleries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whiskies`
--
ALTER TABLE `whiskies`
 ADD PRIMARY KEY (`id`), ADD KEY `distillery_id` (`distillery_id`), ADD KEY `barrel_id` (`barrel_id`), ADD KEY `user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barrels`
--
ALTER TABLE `barrels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `distilleries`
--
ALTER TABLE `distilleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `whiskies`
--
ALTER TABLE `whiskies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `whisky_id` FOREIGN KEY (`whisky_id`) REFERENCES `whiskies` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `whiskies`
--
ALTER TABLE `whiskies`
ADD CONSTRAINT `barrel_id` FOREIGN KEY (`barrel_id`) REFERENCES `barrels` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `distillery_id` FOREIGN KEY (`distillery_id`) REFERENCES `distilleries` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
