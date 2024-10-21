-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 01, 2024 at 08:17 AM
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
-- Database: `payrollproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(12, 'IT Department'),
(13, 'Education Department'),
(14, 'FI Department'),
(15, 'Entrepreneurship');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(20) NOT NULL,
  `employee_no` varchar(100) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `position` varchar(255) NOT NULL,
  `monthly_salary` decimal(10,2) DEFAULT NULL,
  `pera` decimal(10,2) DEFAULT NULL,
  `gross_amount_earned` decimal(10,2) DEFAULT NULL,
  `pagibig_gs` decimal(10,2) DEFAULT NULL,
  `pagibig_mp3` decimal(10,2) DEFAULT NULL,
  `gsis_ps` decimal(10,2) DEFAULT NULL,
  `gsis_gs` decimal(10,2) DEFAULT NULL,
  `sif` decimal(10,2) DEFAULT NULL,
  `philhealth_ps` decimal(10,2) DEFAULT NULL,
  `philhealth_gs` decimal(10,2) DEFAULT NULL,
  `withholding_tax` decimal(10,2) DEFAULT NULL,
  `prg` decimal(10,2) DEFAULT NULL,
  `cnl` decimal(10,2) DEFAULT NULL,
  `eml` decimal(10,2) DEFAULT NULL,
  `mpl` decimal(10,2) DEFAULT NULL,
  `gfal` decimal(10,2) DEFAULT NULL,
  `cpl` decimal(10,2) DEFAULT NULL,
  `help` decimal(10,2) DEFAULT NULL,
  `cfi` decimal(10,2) DEFAULT NULL,
  `csb` decimal(10,2) DEFAULT NULL,
  `disallowance_fd` decimal(10,2) DEFAULT NULL,
  `total_deductions` decimal(10,2) DEFAULT NULL,
  `net_salary` decimal(10,2) DEFAULT NULL,
  `net_received1` decimal(10,2) DEFAULT NULL,
  `net_received2` decimal(10,2) DEFAULT NULL,
  `employee_signature2` varchar(255) DEFAULT NULL,
  `employee_signature1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `re`
--

CREATE TABLE `employee1` (
  `id` int(30) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `position` varchar(255) NOT NULL,
  `employee_id` varchar(100) NOT NULL,
  `monthly_salary` varchar(100) NOT NULL,
  `pera` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee1`
--

INSERT INTO `employee1` (`id`, `fullname`, `position`, `employee_id`, `monthly_salary`, `pera`) VALUES
(7, 'Vincent Obejera', 'Faculty1', '1', '1', '1'),
(8, 'Vincent Obejera', 'Faculty11', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_items`
--

CREATE TABLE `payroll_items` (
  `id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `wages_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(30) NOT NULL,
  `department_id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `department_id`, `name`) VALUES
(27, 4, 'Secretary'),
(28, 12, 'Department Head'),
(29, 12, 'Faculty Staff'),
(30, 12, 'Maintenance'),
(31, 12, 'Instructor 1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` enum('employee','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(6, 'Matthew', 'qwerty', 'qwerty', 'employee'),
(7, 'admin', 'admin', 'admin123', 'admin'),
(8, 'Veronica C. Solar', 'mato', 'mat123', ''),
(9, 'John', 'John', '123', 'admin'),
(10, 'DOE', 'DOE', '123', 'admin'),
(11, '1', '1', '1', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wages`
--

CREATE TABLE `wages` (
  `id` int(11) NOT NULL,
  `pera` int(255) DEFAULT NULL,
  `gross_amount_earned,` int(255) DEFAULT NULL,
  `pagibig_ps,` int(255) NOT NULL,
  `pagibig_gs,` int(255) NOT NULL,
  `pagibig_mp3,` int(255) NOT NULL,
  `gsis_ps` int(11) NOT NULL,
  `gsis_gs` int(11) NOT NULL,
  `sif` int(255) NOT NULL,
  `philhealth_ps` int(255) NOT NULL,
  `philhealth_gs` int(255) NOT NULL,
  `withholding_tax` int(255) NOT NULL,
  `prg` int(255) NOT NULL,
  `employee.cnl` int(255) NOT NULL,
  `employee.eml` int(255) NOT NULL,
  `employee.mpl` int(255) NOT NULL,
  `employee.gfal` int(255) NOT NULL,
  `employee.cpl` int(255) NOT NULL,
  `employee.help` int(255) NOT NULL,
  `employee.cfi` int(255) NOT NULL,
  `employee.csb` int(255) NOT NULL,
  `employee.disallowance_fd` int(255) NOT NULL,
  `employee.total_deductions` int(255) NOT NULL,
  `employee.net_salary` int(255) NOT NULL,
  `employee.net_received_15` int(255) NOT NULL,
  `employee.net_received_16_31` int(255) NOT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee1`
--
ALTER TABLE `employee1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_items`
--
ALTER TABLE `payroll_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `wages_id` (`wages_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wages`
--
ALTER TABLE `wages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_employee` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `employee1`
--
ALTER TABLE `employee1`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payroll_items`
--
ALTER TABLE `payroll_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wages`
--
ALTER TABLE `wages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payroll_items`
--
ALTER TABLE `payroll_items`
  ADD CONSTRAINT `payroll_items_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_items_ibfk_2` FOREIGN KEY (`wages_id`) REFERENCES `wages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wages`
--
ALTER TABLE `wages`
  ADD CONSTRAINT `fk_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
