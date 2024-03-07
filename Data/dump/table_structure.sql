-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db-mysql:3306
-- Generation Time: Mar 07, 2024 at 05:50 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ct07_db`
--
CREATE DATABASE IF NOT EXISTS `ct07_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `ct07_db`;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE `ingredients` (
  `id` int NOT NULL,
  `category` set('EMMP','FAO','FRU','GNBK','HRBS','MSF','OTHR','PRP','VEGI') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Eggs, milk and milk products: EMMP;  Fats and oils: FAO; Fruits: FRU; Grain, nuts and baking products: GNBK; Herbs and spices: HRBS ; Meat, sausages and fish: MSF; Others: OTHR; Pasta, rice and pulses: PRP; Vegetables: VEGI;',
  `measurement_description` enum('tsp','cup','tbsp','g','lb','can','oz') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `calcium` float DEFAULT NULL,
  `calories` float DEFAULT NULL,
  `carbohydrate` float DEFAULT NULL,
  `cholesterol` float DEFAULT NULL,
  `fiber` float DEFAULT NULL,
  `iron` float DEFAULT NULL,
  `fat` float DEFAULT NULL,
  `monounsaturated_fat` float DEFAULT NULL,
  `polyunsaturated_fat` float DEFAULT NULL,
  `saturated_fat` float DEFAULT NULL,
  `potassium` float DEFAULT NULL,
  `protein` float DEFAULT NULL,
  `sodium` float DEFAULT NULL,
  `sugar` float DEFAULT NULL,
  `vitamin_a` float DEFAULT NULL,
  `vitamin_c` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `category`, `measurement_description`, `name`, `calcium`, `calories`, `carbohydrate`, `cholesterol`, `fiber`, `iron`, `fat`, `monounsaturated_fat`, `polyunsaturated_fat`, `saturated_fat`, `potassium`, `protein`, `sodium`, `sugar`, `vitamin_a`, `vitamin_c`) VALUES
(16, 'EMMP', 'cup', 'Milk', 276, 149, 11.7, 33, 0, 0, 7.9, 3.9, 0.5, 4.6, 322, 8, 98, 12.8, 395, 0.5),
(17, 'FAO', 'tbsp', 'Butter', 24, 102, 0.1, 31, 0, 0.1, 11.5, 7.3, 0.4, 3.8, 24, 0.1, 82, 0.1, 3, 0),
(18, 'FRU', 'cup', 'Apple', 11, 95, 25, 0, 4.4, 0, 0.3, 0.1, 0.1, 0.1, 195, 0.5, 2, 18.9, 98, 8.4),
(19, 'GNBK', 'cup', 'Rice', 1, 206, 45, 0, 0.6, 8, 0.4, 0.1, 0.1, 0.2, 43, 4.3, 0, 0.7, 0, 0),
(20, 'HRBS', 'tbsp', 'Basil', 177, 23, 2.6, 0, 2.1, 1.6, 0.5, 0, 0, 0.1, 295, 3, 1, 0.3, 175, 0.4),
(21, 'MSF', 'oz', 'Chicken Breast', 6, 165, 0, 74, 0, 1, 3.6, 1, 0.9, 0.9, 223, 31, 74, 0, 0, 0),
(22, 'OTHR', 'oz', 'Quinoa', 3, 222, 39, 0, 5.2, 15, 3.6, 0.5, 0.8, 0.4, 318, 8.1, 13, 0, 0, 0),
(23, 'PRP', 'cup', 'Lentils', 38, 230, 40, 0, 16, 3.3, 0.8, 0.1, 0.3, 0.1, 731, 18, 2, 3.6, 0, 0),
(24, 'VEGI', 'cup', 'Spinach', 99, 7, 1.1, 0, 0.7, 0.7, 0.1, 0, 0.1, 0, 558, 0.9, 24, 0.1, 188, 6.4),
(25, 'EMMP', 'cup', 'Chicken egg', 50, 78, 0.6, 186, 0, 0.6, 5, 1.6, 2, 1.6, 63, 6, 62, 0.6, 487, 0),
(26, 'EMMP', 'cup', 'Duck egg', 64, 130, 1, 884, 0, 1.4, 10, 3.7, 5.1, 3.6, 214, 9, 71, 0.7, 472, 0),
(27, 'EMMP', 'cup', 'Quail egg', 14, 14, 0.1, 76, 0, 0.4, 1, 1, 0.6, 0.7, 14, 1, 14, 0.1, 126, 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_recipe`
--

DROP TABLE IF EXISTS `ingredient_recipe`;
CREATE TABLE `ingredient_recipe` (
  `ingredient_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  `number_of_unit` int DEFAULT NULL,
  `measurement_description` enum('tsp','cup','tbsp','g','lb','can','oz') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preparation_time_min` int DEFAULT NULL,
  `cooking_time_min` int DEFAULT NULL,
  `directions` text COLLATE utf8mb4_general_ci,
  `meal_type_1` set('Breakfast','Lunch','Dinner') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meal_type_2` enum('Appetizer','Main Dish','Side Dish','Dessert') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meal_type_3` enum('Baked','Salad and Salad Dressing','Sauce and Condiment','Snack','Beverage','Soup','Other') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` enum('Male','Female','Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category`);
ALTER TABLE `ingredients` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `ingredient_recipe`
--
ALTER TABLE `ingredient_recipe`
  ADD PRIMARY KEY (`ingredient_id`,`recipe_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_meal_type_1` (`meal_type_1`),
  ADD KEY `idx_meal_type_2` (`meal_type_2`),
  ADD KEY `idx_meal_type_3` (`meal_type_3`);
ALTER TABLE `recipes` ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_username` (`username`);
ALTER TABLE `users` ADD FULLTEXT KEY `last_Name` (`last_Name`,`first_Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12312315;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
