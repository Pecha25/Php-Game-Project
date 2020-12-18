-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 08:35 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maturski`
--

-- --------------------------------------------------------

--
-- Table structure for table `continents`
--

CREATE TABLE `continents` (
  `id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `continents`
--

INSERT INTO `continents` (`id`, `position`, `title`, `description`) VALUES
(1, 1, 'Akillian', 'OPIS'),
(2, 2, 'Escaron', 'OPIS'),
(3, 4, 'Xzion', 'OPIS'),
(4, 3, 'Wamba', 'OPIS');

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `points` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`id`, `title`, `points`, `time`) VALUES
(1, 'Easy', 100, 60),
(2, 'Medium', 150, 45),
(3, 'Hard', 200, 30),
(4, 'Veteran', 300, 25);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `ordinal_num` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `difficulty_id` int(11) NOT NULL,
  `continent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `ordinal_num`, `title`, `description`, `difficulty_id`, `continent_id`) VALUES
(1, 1, 'Beginning', 'OPIS', 1, 1),
(2, 5, 'Getting souther', 'OPIS', 2, 2),
(3, 9, 'So hot', 'OPIS', 3, 4),
(4, 13, 'Beginning of the end', 'OPIS', 4, 3),
(5, 2, 'First step into', 'OPIS', 1, 1),
(6, 3, 'Deep', 'OPIS', 1, 1),
(7, 4, 'Going further', 'OPIS', 1, 1),
(8, 6, 'Welcome, good luck!', 'OPIS', 2, 2),
(9, 7, 'Tough guy, huh?', 'OPIS', 2, 2),
(10, 8, 'Watch out!', 'OPIS', 2, 2),
(11, 10, 'Getting pretty damn hot here fool!', 'OPIS', 3, 4),
(12, 11, 'What up fool!', 'OPIS', 3, 4),
(13, 12, 'Lol, you alive?!', 'OPIS', 3, 4),
(14, 14, 'Omg, the END is near!', 'OPIS', 4, 3),
(15, 15, 'Be patient!', 'OPIS', 4, 3),
(16, 16, 'Gasoline, boom, congrats hero!', 'OPIS', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `level_id` int(111) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `score`, `level_id`) VALUES
(1, 'Era', 'Eric', 2800, 16),
(2, 'Petar', 'Petrovic', 550, 2),
(3, 'Mark', 'Zakerberg', 1400, 11),
(4, 'Mitar', 'Miric', 2100, 4),
(5, 'Tester', 'test', 100, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `continents`
--
ALTER TABLE `continents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `continent_id` (`continent_id`),
  ADD KEY `difficulty_id` (`difficulty_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `continents`
--
ALTER TABLE `continents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `difficulty`
--
ALTER TABLE `difficulty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`continent_id`) REFERENCES `continents` (`id`),
  ADD CONSTRAINT `level_ibfk_2` FOREIGN KEY (`difficulty_id`) REFERENCES `difficulty` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
