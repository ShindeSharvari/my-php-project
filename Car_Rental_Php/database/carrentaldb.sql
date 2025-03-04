-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 03:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_PASSWORD`) VALUES
('ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOK_ID` int(11) NOT NULL,
  `CAR_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_PLACE` varchar(255) NOT NULL,
  `BOOK_DATE` date NOT NULL,
  `DURATION` int(11) NOT NULL,
  `PHONE_NUMBER` bigint(20) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `RETURN_DATE` date NOT NULL,
  `PRICE` int(11) NOT NULL,
  `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOK_ID`, `CAR_ID`, `EMAIL`, `BOOK_PLACE`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `DESTINATION`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`) VALUES
(79, 7, 'shindesharvari003@gmail.com', 'Koregaon Park', '2024-03-30', 3, 7020505673, 'Hadapsar', '2024-04-02', 5400, 'APPROVED'),
(80, 1, 'shindesharvari003@gmail.com', 'Kothrud', '2024-04-01', 3, 7020505673, 'Kothrud', '2024-04-04', 15000, 'UNDER PROCESSING'),
(81, 2, 'shindesharvari003@gmail.com', 'Pimpri', '2024-04-03', 3, 7020505673, 'Hadapsar', '2024-04-06', 5100, 'APPROVED'),
(82, 5, 'shindesharvari003@gmail.com', 'Koregaon Park', '2024-04-06', 3, 7020505673, 'Pimpri', '2024-04-09', 7500, 'UNDER PROCESSING'),
(83, 1, 'radhikapatill77o@gmail.com', 'Pimpri', '2024-04-04', 4, 8765543221, 'Kothrud', '2024-04-08', 20000, 'UNDER PROCESSING'),
(84, 1, 'shindesharvari003@gmail.com', 'Hadapsar', '2024-04-15', 1, 9011375027, 'Koregaon Park', '2024-04-16', 5000, 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CAR_ID` int(11) NOT NULL,
  `CAR_NAME` varchar(255) NOT NULL,
  `FUEL_TYPE` varchar(255) NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CAR_IMG` varchar(255) NOT NULL,
  `AVAILABLE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CAR_ID`, `CAR_NAME`, `FUEL_TYPE`, `CAPACITY`, `PRICE`, `CAR_IMG`, `AVAILABLE`) VALUES
(1, 'Mahindra Thar', 'diesel', 4, 5000, 'IMG-66074762f037c2.96969471.jpg', 'N'),
(2, 'Maruti Suzuki Swift', 'PETROL', 4, 1700, 'IMG-66074cf8c670d6.59776587.webp', 'N'),
(3, 'Hyundai i20', 'PETROL', 5, 1800, 'IMG-66074d78ac3709.95188959.jpg', 'Y'),
(5, 'Toyota Innova Crysta', 'PETROL', 6, 2500, 'IMG-66074e92bb3769.68682248.webp', 'Y'),
(6, 'Mahindra Bolero', 'Diesel', 8, 2300, 'IMG-66074f319456d8.68848731.webp', 'Y'),
(7, 'Renault Duster', 'Diesel', 5, 1800, 'IMG-66074f9be0b0b1.49575890.webp', 'N'),
(9, 'Kia Seltos', 'PETROL', 8, 4000, 'IMG-660e65355d7045.07846926.jpeg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FED_ID`, `EMAIL`, `COMMENT`) VALUES
(1, 'shindesharvari003@gmail.com', 'Overall Nice Experience good service at affordable price.'),
(2, 'radhikapatill77o@gmail.com', 'I liked your service and love to rent a car in future.');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAY_ID` int(11) NOT NULL,
  `BOOK_ID` int(11) NOT NULL,
  `CARD_NO` varchar(255) NOT NULL,
  `EXP_DATE` varchar(255) NOT NULL,
  `CVV` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `LIC_NUM` varchar(255) NOT NULL,
  `PHONE_NUMBER` bigint(11) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `is_verified` int(10) NOT NULL DEFAULT 0,
  `resettoken` varchar(255) DEFAULT NULL,
  `resettokenexpire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FNAME`, `LNAME`, `EMAIL`, `LIC_NUM`, `PHONE_NUMBER`, `PASSWORD`, `GENDER`, `verification_code`, `is_verified`, `resettoken`, `resettokenexpire`) VALUES
('Anku', 'Mane', 'ankitamadane12121@gmail.com', '987654321', 9011375027, '6df46c6c31ab321f37cadff58b514702', 'female', '7fb094308522ce242802ca1e6462f31e', 0, NULL, NULL),
('Ankita', 'Madane', 'AnkitaMadane77@gmail.com', '2135667', 9011375027, 'cb3e6d45ed456c1a3b9f0ed6fa7c8cc8', 'female', '', 0, NULL, NULL),
('Sharyu', 'Patil', 'radhikapatill77o@gmail.com', 'MH50-1243567', 7020505673, '$2y$10$HITGrZMeApQZzdQPPblLvud2ebsbRIZbnUXAdmr7h9cm8.NJu3KvS', 'female', '8aadb891c08755ee32e29752b129bba0', 1, NULL, NULL),
('Sharvari', 'Shinde', 'shindesharvari003@gmail.com', '9876555544', 7020505673, '$2y$10$qaC52Hd1W7y2oX3cUqtJoO0vWwJmUv.CTkhgDPkYbvuo4JEqZ2D8K', 'female', '338564f931f7c12756842b4ed531056e', 1, NULL, NULL),
('Sanika ', 'Shinde', 'ShindeShiv7@gmail.com', '45678999', 9011375027, '9692fca89bb2b706a1cb9e6c7f924eb4', 'female', '61765674a863b8027f49308fcb1730fa', 0, NULL, NULL),
('shiv', 'patil', 'shiv67@gmail.com', '9875654434343', 8765543221, '964ae62313025f50d25537f94fac8e74', 'male', '8be4ff46a30970804b1960d5f8608449', 0, NULL, NULL),
('shivani', 'patil', 'shivanipatil98@gmail.com', '87764545', 9876543234, '6df46c6c31ab321f37cadff58b514702', 'female', 'c5d14f9ab88ccd185ec2ec570430912a', 0, NULL, NULL),
('shiv', 'patil', 'shivpatil45@gmail.com', '6755894443399', 8974930203, '964ae62313025f50d25537f94fac8e74', 'male', '', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `CAR_ID` (`CAR_ID`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CAR_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FED_ID`),
  ADD KEY `TEST` (`EMAIL`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAY_ID`),
  ADD UNIQUE KEY `BOOK_ID` (`BOOK_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
