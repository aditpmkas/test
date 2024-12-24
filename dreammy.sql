-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 04:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dreammy`
--

-- --------------------------------------------------------

--
-- Table structure for table `calculation_history`
--

CREATE TABLE `calculation_history` (
  `id` int(11) NOT NULL,
  `goal_amount` decimal(15,2) DEFAULT NULL,
  `time_period` int(11) DEFAULT NULL,
  `current_amount` decimal(15,2) DEFAULT NULL,
  `saving_frequency` enum('monthly','yearly') DEFAULT NULL,
  `target_investment` decimal(15,2) DEFAULT NULL,
  `return_rate` decimal(5,2) DEFAULT NULL,
  `calculation_result` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `saving_timing` enum('start','end') NOT NULL DEFAULT 'end'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calculation_history`
--

INSERT INTO `calculation_history` (`id`, `goal_amount`, `time_period`, `current_amount`, `saving_frequency`, `target_investment`, `return_rate`, `calculation_result`, `created_at`, `saving_timing`) VALUES
(1, 1000000000.00, 12, 10500000.00, 'yearly', 100000.00, 15.00, 59512817.86, '2024-12-23 13:05:19', 'end'),
(2, 2000000000.00, 2, 10500000.00, 'monthly', 1000000.00, 4.00, 36315888.82, '2024-12-23 13:06:56', 'end'),
(3, 1000000000.00, 2, 900000.00, 'yearly', 2000000.00, 44.00, 6746240.00, '2024-12-23 13:21:05', ''),
(4, 1000000000.00, 2, 900000.00, 'monthly', 100000.00, 4.00, 3477431.73, '2024-12-23 13:26:41', '');

-- --------------------------------------------------------

--
-- Table structure for table `dream_vehicle`
--

CREATE TABLE `dream_vehicle` (
  `id` int(11) NOT NULL,
  `years` int(11) NOT NULL,
  `current_vehicle_price` decimal(15,2) NOT NULL,
  `down_payment_percentage` decimal(5,2) NOT NULL,
  `current_savings` decimal(15,2) NOT NULL,
  `monthly_savings` decimal(15,2) NOT NULL,
  `investment_return` decimal(5,2) NOT NULL,
  `inflation_rate` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dream_vehicle`
--

INSERT INTO `dream_vehicle` (`id`, `years`, `current_vehicle_price`, `down_payment_percentage`, `current_savings`, `monthly_savings`, `investment_return`, `inflation_rate`) VALUES
(1, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(2, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(3, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(4, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(5, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(6, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(7, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(8, 2024, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.03),
(9, 5, 20000000.00, 0.20, 2000000.00, 1000000.00, 0.05, 0.04),
(10, 4, 20.00, 0.30, 200.00, 150.00, 0.05, 0.03),
(11, 4, 20.00, 0.30, 200.00, 150.00, 0.05, 0.03),
(12, 4, 20.00, 0.30, 200.00, 150.00, 0.05, 0.03),
(13, 4, 20.00, 0.30, 200.00, 150.00, 0.05, 0.03),
(14, 5, 30.00, 0.50, 4.00, 200.00, 0.04, 0.03),
(15, 5, 30.00, 0.50, 4.00, 200.00, 0.04, 0.03),
(16, 5, 30.00, 0.50, 4.00, 200.00, 0.04, 0.03),
(17, 5, 34.00, 0.20, 2.00, 500.00, 0.05, 0.02),
(18, 2, 5.00, 0.20, 400.00, 500.00, 0.05, 0.02),
(19, 5, 20.00, 0.20, 1.00, 1.00, 0.05, 0.02),
(20, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(21, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(22, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(23, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(24, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(25, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(26, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(27, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(28, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(29, 5, 20000000.00, 0.20, 1200000.00, 1000000.00, 0.05, 0.02),
(30, 4, 23000000.00, 0.20, 1000000.00, 500000.00, 0.05, 0.02),
(31, 2, 200000000.00, 0.03, 4.00, 5.00, 0.04, 0.05),
(32, 4, 4000000000.00, 0.30, 200.00, 3000000.00, 0.13, 0.15),
(33, 10000000, 123211321323.00, 999.99, 1231231231.00, 123123123.00, 999.99, 999.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculation_history`
--
ALTER TABLE `calculation_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dream_vehicle`
--
ALTER TABLE `dream_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculation_history`
--
ALTER TABLE `calculation_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dream_vehicle`
--
ALTER TABLE `dream_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
