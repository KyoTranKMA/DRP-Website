-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db-mysql:3306
-- Generation Time: Mar 02, 2024 at 07:06 PM
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
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` set('EMMP','FAO','FRU','GNBK','HRBS','MSF','OTHR','PRP','VEGI') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Eggs, milk and milk products: EMMP;  Fats and oils: FAO; Fruits: FRU; Grain, nuts and baking products: GNBK; Herbs and spices: HRBS ; Meat, sausages and fish: MSF; Others: OTHR; Pasta, rice and pulses: PRP; Vegetables: VEGI;',
  `measurement_description` ENUM('tsp', 'cup', 'tbsp', 'g', 'lb', 'can', 'oz'),
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `vitamin_c` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_recipe`
--

DROP TABLE IF EXISTS `ingredient_recipe`;
CREATE TABLE IF NOT EXISTS `ingredient_recipe` (
  `ingredient_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  `number_of_unit` int DEFAULT NULL,
  `measurement_description` ENUM('tsp', 'cup', 'tbsp', 'g', 'lb', 'can', 'oz'),
  PRIMARY KEY (`ingredient_id`,`recipe_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `preparation_time_min` int DEFAULT NULL,
  `cooking_time_min` int DEFAULT NULL,
  `number_of_servings` int DEFAULT NULL,
  `directions` text,
  `meal_type_1` set('Breakfast','Lunch','Dinner'),
  `meal_type_2` enum('Appetizer','Main Dish','Side Dish','Dessert'),
  `meal_type_3` enum('Baked','Salad and Salad Dressing','Sauce and Condiment','Snack','Beverage','Soup','Other'),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` enum('Male','Female','Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12312315 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Table structure for table `pla`
CREATE TABLE IF NOT EXISTS `recipe_saved` (
  `recipe_id` int NOT NULL,
  `user_id` int NOT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`,`user_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;









--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredient_recipe`
--
ALTER TABLE `ingredient_recipe`
  ADD CONSTRAINT `ingredient_recipe_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `ingredient_recipe_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
