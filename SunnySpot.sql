-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2023 at 08:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunnyspot`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `staffID` bigint(20) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`staffID`, `userName`, `password`, `firstName`, `lastName`, `address`, `mobile`) VALUES
(1, 'admin1', 'admin1', 'Kateryna', 'Osadcha', '2/22 Ness Ave, Dulwich Hill 2203', '0414375736'),
(2, 'admin2', 'admin2', 'Antonii', 'Bondar', '2/22 Ness Ave, Dulwich Hill 2203', '0405728589');

-- --------------------------------------------------------

--
-- Table structure for table `cabin`
--

CREATE TABLE `cabin` (
  `cabinID` bigint(20) NOT NULL,
  `cabinType` varchar(150) NOT NULL,
  `cabinDescription` varchar(255) NOT NULL,
  `pricePerNight` int(10) NOT NULL,
  `pricePerWeek` decimal(10,2) NOT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabin`
--

INSERT INTO `cabin` (`cabinID`, `cabinType`, `cabinDescription`, `pricePerNight`, `pricePerWeek`, `photo`) VALUES
(1, 'Standard cabin sleeps 4 ', 'A 2 bedroom cabin with double in main and either double or 2 singles in the second bedroom ', 100, 500.00, 'stCabin.jpg '),
(2, 'Standard open plan cabin sleeps 4 ', 'An open plan cabin with double bed and set of bunks ', 120, 600.00, 'stOpenCabin.jpg '),
(3, 'Deluxe cabin sleeps 4 ', 'A 2 bedroom cabin with queen bed and 2 singles in the second bedroom ', 140, 700.00, 'deluxCabin.jpg '),
(4, 'Villa sleeps 4 ', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds ', 150, 750.00, 'villa.jpg'),
(5, 'Spa villa sleeps 4 ', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds and spa bath ', 200, 1000.00, 'spaVilla.jpg '),
(6, 'Grass powered site ', 'Powered sites on grass ', 40, 200.00, 'grassPower.jpg'),
(7, 'Slab powered ', 'Powered sites with slab ', 50, 250.00, 'slabPower.jpg ');

--
-- Triggers `cabin`
--
DELIMITER $$
CREATE TRIGGER `prevent_insert_out_of_range` BEFORE INSERT ON `cabin` FOR EACH ROW BEGIN
    IF NEW.pricePerNight < 0 OR NEW.pricePerNight > 999999 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Out of range value for column pricePerNight at row 1';
    END IF;
    
    IF NEW.pricePerWeek > NEW.pricePerNight * 5 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Value in column pricePerWeek must be at most 5 times the value in column pricePerNight';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cabininclusion`
--

CREATE TABLE `cabininclusion` (
  `cabinIncID` bigint(20) NOT NULL,
  `cabinID` bigint(20) NOT NULL,
  `incID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabininclusion`
--

INSERT INTO `cabininclusion` (`cabinIncID`, `cabinID`, `incID`) VALUES
(1, 1, 1),
(2, 1, 6),
(3, 1, 8),
(4, 2, 2),
(5, 2, 5),
(6, 2, 6),
(7, 2, 8),
(8, 2, 11),
(9, 3, 3),
(10, 3, 4),
(11, 3, 7),
(12, 3, 8),
(13, 3, 10),
(14, 3, 11),
(15, 4, 3),
(16, 4, 4),
(17, 4, 7),
(18, 4, 8),
(19, 4, 9),
(20, 4, 10),
(21, 4, 11),
(22, 5, 3),
(23, 5, 4),
(24, 5, 7),
(25, 5, 8),
(26, 5, 9),
(27, 5, 10),
(28, 5, 11);

-- --------------------------------------------------------

--
-- Table structure for table `inclusion`
--

CREATE TABLE `inclusion` (
  `incID` bigint(20) NOT NULL,
  `incName` varchar(50) NOT NULL,
  `incDetails` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inclusion`
--

INSERT INTO `inclusion` (`incID`, `incName`, `incDetails`) VALUES
(1, '1 bathroom ', NULL),
(2, '1+ bathroom  ', '1 bathroom and separate toilet '),
(3, '2 bathroom ', NULL),
(4, 'Air conditioner ', 'Reverse cycle '),
(5, 'Ceiling fans ', NULL),
(6, 'Bunk bed ', NULL),
(7, '2 single beds ', NULL),
(8, 'Double bed ', NULL),
(9, 'Dishwasher ', NULL),
(10, 'DVD Player ', NULL),
(11, 'Hair dryer ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logID` bigint(20) NOT NULL,
  `staffID` bigint(20) NOT NULL,
  `loginDateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logoutDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `cabin`
--
ALTER TABLE `cabin`
  ADD PRIMARY KEY (`cabinID`);

--
-- Indexes for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  ADD PRIMARY KEY (`cabinIncID`),
  ADD KEY `cabinID` (`cabinID`),
  ADD KEY `incID` (`incID`);

--
-- Indexes for table `inclusion`
--
ALTER TABLE `inclusion`
  ADD PRIMARY KEY (`incID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `staffID` (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `staffID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cabin`
--
ALTER TABLE `cabin`
  MODIFY `cabinID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  MODIFY `cabinIncID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `inclusion`
--
ALTER TABLE `inclusion`
  MODIFY `incID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `logID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  ADD CONSTRAINT `cabinInclusion_ibfk_1` FOREIGN KEY (`cabinID`) REFERENCES `cabin` (`cabinID`),
  ADD CONSTRAINT `cabinInclusion_ibfk_2` FOREIGN KEY (`incID`) REFERENCES `inclusion` (`incID`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `admin` (`staffID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
