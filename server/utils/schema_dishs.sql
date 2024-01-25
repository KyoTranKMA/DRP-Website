-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2024 at 12:27 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `dishs`
--

CREATE TABLE `dishs` (
  `idDish` int NOT NULL,
  `nameDish` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(3000) COLLATE utf8mb4_general_ci NOT NULL,
  `ingredient` varchar(4000) COLLATE utf8mb4_general_ci NOT NULL,
  `nutrition` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `imagefile` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dishs`
--
ALTER TABLE `dishs`
  ADD PRIMARY KEY (`idDish`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dishs`
--
ALTER TABLE `dishs`
  MODIFY `idDish` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
