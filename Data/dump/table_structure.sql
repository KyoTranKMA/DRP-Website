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
  `category` ENUM('EMMP','FAO','FRU','GNBK','HRBS','MSF','OTHR','PRP','VEGI') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Eggs, milk and milk products: EMMP;  Fats and oils: FAO; Fruits: FRU; Grain, nuts and baking products: GNBK; Herbs and spices: HRBS ; Meat, sausages and fish: MSF; Others: OTHR; Pasta, rice and pulses: PRP; Vegetables: VEGI;',
  `measurement_description` enum('tsp','cup','tbsp','g','lb','can','oz','unit') COLLATE utf8mb4_general_ci DEFAULT NULL,
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


DROP TABLE IF EXISTS `ingredient_recipe`;
CREATE TABLE `ingredient_recipe` (
  `ingredient_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  `number_of_unit` int DEFAULT NULL,
  `measurement_description` enum('tsp','cup','tbsp','g','lb','can','oz','unit') COLLATE utf8mb4_general_ci DEFAULT NULL
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
  `first_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  
  
  
  
  
 INSERT INTO `recipes` (`id`, `name`, `description`, `image_url`, `preparation_time_min`, `cooking_time_min`, `directions`, `meal_type_1`, `meal_type_2`, `meal_type_3`) VALUES
(1, 'Chicken Stir Fry', 'Delicious chicken stir fry with mixed vegetables and soy sauce.', NULL, 15, 20, '1. Marinate chicken with soy sauce and cornstarch.\n2. Stir fry chicken until cooked.\n3. Add mixed vegetables and stir fry until tender.\n4. Serve hot with rice.', 'Dinner', 'Main Dish', 'Other'),
(2, 'Cucumber and Shrimp Aguachile', 'Refreshing and spicy shrimp dish with cucumber and lime juice.', NULL, 15, 0, '1. Clean and devein shrimp.\n2. Slice cucumbers thinly.\n3. Mix shrimp, cucumber slices, lime juice, and chili peppers in a bowl.\n4. Let marinate in the refrigerator for 15 minutes.\n5. Serve chilled.', 'Lunch', 'Main Dish', 'Other'),
(3, 'Black Bean and Corn Salad', 'A refreshing and healthy salad with black beans, corn, and a tangy lime dressing.', NULL, 15, 0, '1. Rinse black beans and corn.\n2. Combine black beans, corn, diced tomatoes, chopped cilantro, and diced onions in a large bowl.\n3. In a small bowl, whisk together lime juice, olive oil, salt, and pepper to make the dressing.\n4. Pour dressing over the salad and toss to combine.\n5. Serve chilled or at room temperature.', 'Lunch', 'Side Dish', 'Salad and Salad Dressing'),
(4, 'Baba Ganoush', 'Roasted eggplant mash with tahini, lemon juice, olive oil, and garlic.', NULL, 30, 15, '1. Roast eggplant in the oven until tender and blackened.\n2. Scoop out the flesh and mash it with tahini, lemon juice, olive oil, and garlic.\n3. Season with salt and pepper to taste.\n4. Serve with pita bread or vegetables.', 'Breakfast', 'Side Dish', 'Other'),
(5, 'Crispy Cajun Pickle Chips', 'Delicious crispy Cajun-flavored pickle chips, perfect as a snack or side dish.', NULL, 10, 20, '1. Preheat the oven to 400°F (200°C).\n2. Slice the pickles into thin chips.\n3. In a bowl, mix flour, Cajun seasoning, and breadcrumbs.\n4. Dip pickle chips in beaten egg, then coat with breadcrumb mixture.\n5. Place coated pickle chips on a baking sheet.\n6. Bake in the preheated oven until golden brown and crispy, about 15-20 minutes.\n7. Serve hot and enjoy!', NULL, NULL, 'Snack'),
(6, 'Black Bean and Corn Salad', 'A refreshing salad featuring black beans and sweet corn, perfect for a healthy side dish or light meal.', NULL, 15, 0, '1. In a large bowl, combine black beans, corn, diced tomatoes, diced red onion, chopped cilantro, and avocado.\n2. In a small bowl, whisk together olive oil, lime juice, minced garlic, cumin, salt, and pepper to make the dressing.\n3. Pour the dressing over the salad ingredients and toss gently to coat.\n4. Chill the salad in the refrigerator for at least 30 minutes before serving.\n5. Serve cold and enjoy!', NULL, 'Side Dish', 'Salad and Salad Dressing'),
(7, 'Salmon Patties', 'Delicious and flavorful salmon patties, perfect for a light meal or appetizer.', NULL, 15, 15, '1. Drain and flake the canned salmon.\n2. In a mixing bowl, combine flaked salmon, beaten eggs, breadcrumbs, diced onion, chopped parsley, lemon juice, Dijon mustard, salt, and pepper.\n3. Mix well until thoroughly combined.\n4. Form the mixture into patties of desired size.\n5. Heat oil in a skillet over medium heat.\n6. Fry the salmon patties until golden brown and cooked through, about 3-4 minutes per side.\n7. Remove from the skillet and drain on paper towels.\n8. Serve hot with your favorite dipping sauce or side dishes.', NULL, 'Appetizer', NULL),
(9, 'Egg Salad', 'A simple and tasty egg salad, perfect for sandwiches or as a side dish.', NULL, 10, 0, '1. Boil the eggs until hard-cooked, then peel and chop them.\n2. In a mixing bowl, combine the chopped eggs, mayonnaise, mustard, diced celery, chopped chives, salt, and pepper.\n3. Mix well until all ingredients are evenly distributed.\n4. Refrigerate the egg salad for at least 30 minutes before serving to allow the flavors to meld.\n5. Serve as a sandwich filling, on crackers, or as a side dish. Enjoy!', 'Lunch', NULL, 'Salad and Salad Dressing'),
(11, 'Triangles with Potato and Beef', 'Delicious triangles filled with a savory mixture of potatoes and beef, perfect as a snack or appetizer.', NULL, 30, 40, '1. Boil the potatoes until tender, then mash them.\n2. In a skillet, cook the ground beef until browned. Drain excess fat.\n3. Add onion, garlic, and spices to the skillet with the beef. Cook until onion is softened.\n4. Combine the mashed potatoes with the cooked beef mixture.\n5. Lay out the phyllo pastry sheets and cut them into triangles.\n6. Place a spoonful of the potato and beef mixture onto each triangle.\n7. Fold the pastry over the filling to form a triangle shape.\n8. Brush the triangles with melted butter.\n9. Bake in a preheated oven at 375°F (190°C) until golden brown, about 20-25 minutes.\n10. Serve hot and enjoy!', NULL, 'Appetizer', NULL),
(12, 'Cheese Sticks', 'Delicious crispy cheese sticks, perfect as an appetizer or snack.', NULL, 15, 20, '1. Preheat the oven to 375°F (190°C).\n2. Cut the cheese into sticks.\n3. In a bowl, whisk together breadcrumbs, grated Parmesan cheese, and Italian seasoning.\n4. Dip each cheese stick in beaten egg, then coat with breadcrumb mixture.\n5. Place coated cheese sticks on a baking sheet lined with parchment paper.\n6. Bake in the preheated oven until golden brown and crispy, about 15-20 minutes.\n7. Serve hot with marinara sauce for dipping, if desired.', NULL, 'Appetizer', NULL),
(13, 'Jalapeno Bites', 'Spicy jalapeno bites stuffed with cheese, perfect as an appetizer or snack.', NULL, 20, 15, '1. Preheat the oven to 375°F (190°C).\n2. Cut jalapenos in half lengthwise and remove seeds.\n3. Fill each jalapeno half with cream cheese.\n4. Wrap each jalapeno with a slice of bacon.\n5. Place jalapeno bites on a baking sheet lined with parchment paper.\n6. Bake in the preheated oven until bacon is crispy and jalapenos are tender, about 15 minutes.\n7. Serve hot and enjoy!', NULL, 'Appetizer', NULL);

INSERT INTO `ingredients` (`id`, `category`, `measurement_description`, `name`, `calcium`, `calories`, `carbohydrate`, `cholesterol`, `fiber`, `iron`, `fat`, `monounsaturated_fat`, `polyunsaturated_fat`, `saturated_fat`, `potassium`, `protein`, `sodium`, `sugar`, `vitamin_a`, `vitamin_c`) VALUES
(1, 'MSF', 'g', 'Chicken Breast', 12.5, 165, 0, 75, 0, 1.2, 3.6, 1, 0.5, 1.2, 250, 31, 75, 0, 0, 0),
(2, 'VEGI', 'g', 'Mixed Vegetables', 20, 50, 10, 0, 2, 0.8, 0.5, 0.3, 0.2, 0.4, 200, 5, 50, 3, 20, 10),
(3, 'OTHR', 'tbsp', 'Soy Sauce', 2, 10, 1, 0, 0, 0.2, 0.1, 0.1, 0, 0.1, 50, 1, 200, 2, 0, 0),
(4, 'OTHR', 'tbsp', 'Cornstarch', 0, 30, 7, 0, 0, 0.1, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0),
(5, 'MSF', 'g', 'Shrimp', 50, 120, 0, 150, 0, 2.5, 2, 0.5, 0.5, 0.5, 180, 20, 200, 0, 0, 0),
(6, 'VEGI', 'unit', 'Cucumber', 20, 15, 3, 0, 1, 0.5, 0.1, 0.1, 0.1, 0.1, 120, 1, 5, 1, 10, 15),
(7, 'OTHR', 'tbsp', 'Lime Juice', 2, 10, 2, 0, 0, 0.1, 0.1, 0, 0, 0, 50, 0, 0, 2, 0, 30),
(8, 'HRBS', 'unit', 'Chili Pepper', 0, 5, 1, 0, 0, 0.1, 0, 0, 0, 0, 30, 0, 0, 1, 5, 10),
(9, 'PRP', 'can', 'Black Beans', 80, 100, 20, 0, 5, 2.5, 0.5, 0.5, 0.5, 0.5, 500, 7, 200, 1, 10, 0),
(10, 'VEGI', 'cup', 'Corn', 1, 120, 26, 0, 3, 1, 0.5, 0.5, 0.5, 0.5, 250, 4, 5, 10, 0, 8),
(11, 'VEGI', 'unit', 'Tomato', 8, 20, 4, 0, 1, 0.5, 0.1, 0.1, 0.1, 0.1, 100, 1, 10, 2, 15, 20),
(12, 'HRBS', 'cup', 'Cilantro', 16, 5, 0, 0, 0, 0.1, 0, 0, 0, 0, 50, 1, 0, 0, 10, 15),
(13, 'VEGI', 'unit', 'Onion', 4, 20, 5, 0, 1, 0.5, 0.1, 0.1, 0.1, 0.1, 100, 1, 5, 2, 5, 10),
(14, 'OTHR', 'tbsp', 'Lime Juice', 2, 10, 2, 0, 0, 0.1, 0.1, 0, 0, 0, 50, 0, 0, 2, 0, 30),
(15, 'OTHR', 'tbsp', 'Olive Oil', 0, 120, 0, 0, 0, 14, 1, 10, 2, 1, 0, 0, 0, 0, 0, 0),
(16, 'VEGI', 'unit', 'Eggplant', 22, 20, 5, 0, 1, 0.5, 0.1, 0.1, 0.1, 0.1, 150, 1, 5, 2, 5, 10),
(17, 'OTHR', 'tbsp', 'Tahini', 2, 90, 3, 0, 1, 8, 1.5, 5, 1, 1, 50, 3, 10, 1, 0, 0),
(18, 'HRBS', 'unit', 'Garlic', 2, 5, 1, 0, 0, 0.1, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0),
(19, 'OTHR', 'tbsp', 'Lemon Juice', 1, 5, 2, 0, 0, 0.1, 0.1, 0, 0, 0, 30, 0, 0, 2, 10, 20),
(20, 'OTHR', 'tbsp', 'Olive Oil', 0, 120, 0, 0, 0, 14, 1, 10, 2, 1, 0, 0, 0, 0, 0, 0),
(26, 'OTHR', 'unit', 'Pickle', 0, 5, 1, 0, 0, 0.1, 0, 0, 0, 0, 10, 0, 100, 1, 0, 0),
(27, 'OTHR', 'cup', 'Flour', 1, 455, 95, 0, 3, 3.4, 0.4, 0.1, 0.1, 0.6, 30, 13, 0, 1, 0, 0),
(28, 'OTHR', 'cup', 'Breadcrumbs', 2, 455, 95, 0, 3, 3.4, 0.4, 0.1, 0.1, 0.6, 30, 13, 0, 1, 0, 0),
(29, 'OTHR', 'unit', 'Egg', 12, 70, 0, 185, 0, 5, 1.5, 1, 1.5, 70, 6, 70, 0, 0, 0, NULL),
(30, 'OTHR', 'tbsp', 'Cajun Seasoning', 0, 15, 0, 0, 0, 0.1, 0, 0, 0, 0, 0, 0, 400, 0, 0, 0),
(31, 'OTHR', 'cup', 'Black Beans (cooked)', 25, 227, 41, 0, 15, 3.6, 0.9, 0.5, 0.2, 0.5, 740, 15, 1, 0, 0, 0),
(32, 'OTHR', 'cup', 'Corn', 0, 132, 30, 0, 3, 1.5, 0.6, 0.2, 0.3, 0.6, 270, 5, 11, 6, 0, 10),
(33, 'VEGI', 'unit', 'Tomato (diced)', 6, 22, 5, 0, 1, 0.6, 0.1, 0.1, 0, 0.1, 237, 1, 6, 3, 8, 16),
(34, 'VEGI', 'unit', 'Red Onion (diced)', 4, 10, 2, 0, 0.2, 0.1, 0, 0, 0, 0, 60, 0, 1, 2, 0, 5),
(35, 'HRBS', 'cup', 'Cilantro (chopped)', 3, 1, 0, 0, 0.1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 12),
(36, 'VEGI', 'unit', 'Avocado (diced)', 10, 234, 12, 0, 10, 21.4, 15.3, 2.9, 2.6, 3.3, 708, 3, 11, 0, 4, 20),
(37, 'OTHR', 'tbsp', 'Olive Oil', 0, 119, 0, 0, 0, 13.5, 9.9, 1.4, 1.9, 0.5, 0, 0, 0, 0, 0, 0),
(38, 'OTHR', 'unit', 'Lime (juiced)', 2, 8, 3, 0, 0.1, 0.1, 0, 0, 0, 0, 23, 0, 0, 0, 0, 14),
(39, 'OTHR', 'tsp', 'Garlic (minced)', 2, 4, 1, 0, 0.1, 0.1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 2),
(40, 'OTHR', 'tsp', 'Cumin', 8, 8, 1, 0, 0.4, 0.5, 0.2, 0, 0.1, 0, 22, 0, 1, 0, 1, 0),
(41, 'OTHR', 'tsp', 'Salt', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(42, 'OTHR', 'tsp', 'Pepper', 1, 5, 1, 0, 0.3, 0.1, 0, 0, 0.1, 0, 17, 0, 1, 0, 1, 8),
(43, 'MSF', 'can', 'Salmon (canned, drained)', 120, 157, 0, 47, 0, 0.8, 6.9, 2.5, 1, 0.4, 295, 23, 440, 0, 0, 0),
(44, 'OTHR', 'unit', 'Egg (beaten)', 25, 72, 0.4, 186, 0, 4.8, 1.6, 2, 1.6, 0.7, 63, 6, 71, 0.1, 5, 0),
(45, 'OTHR', 'cup', 'Breadcrumbs', 34, 455, 95, 0, 3, 3.4, 0.4, 0.1, 0.1, 0.6, 30, 13, 0, 1, 0, 0),
(46, 'VEGI', 'unit', 'Onion (diced)', 2, 4, 1, 0, 0.1, 0.1, 0, 0, 0, 0, 2, 0, 1, 2, 0, 5),
(47, 'HRBS', 'cup', 'Parsley (chopped)', 14, 11, 2, 0, 0.8, 0.5, 0.1, 0, 0.1, 0.1, 79, 1, 6, 0.3, 0, 133),
(48, 'OTHR', 'tbsp', 'Lemon Juice', 6, 4, 1, 0, 0.1, 0, 0, 0, 0, 0, 2, 0, 0, 0.1, 0, 8),
(49, 'OTHR', 'tbsp', 'Dijon Mustard', 4, 15, 0.9, 0, 0.1, 1.1, 0.6, 0.6, 0.1, 0.1, 17, 1, 140, 0.1, 0, 0),
(50, 'OTHR', 'tsp', 'Salt', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 'OTHR', 'tsp', 'Pepper', 0, 5, 1, 0, 0.3, 0.1, 0, 0, 0.1, 0, 17, 0, 1, 0, 1, 8),
(52, 'OTHR', 'cup', 'Oil (for frying)', 0, 1927, 0, 0, 0, 218, 14, 31, 186, 20, 0, 0, 0, 0, 0, 0),
(60, 'OTHR', 'unit', 'Egg (hard-cooked and chopped)', 28, 78, 0.6, 186, 0, 5.3, 5.3, 1.6, 1.6, 2, 63, 6, 62, 0.6, 270, 0),
(61, 'OTHR', 'cup', 'Mayonnaise', 8, 916, 1.6, 126, 0, 101.2, 15, 12, 16.1, 3.9, 0, 1, 844, 1.3, 204, 0),
(62, 'OTHR', 'tsp', 'Mustard', 5, 3, 0.6, 0, 0.2, 0.1, 0, 0, 0, 0, 3, 0, 57, 0.2, 6, 0),
(63, 'VEGI', 'unit', 'Celery (diced)', 10, 6, 1.2, 0, 0.6, 0.1, 0.1, 0, 0, 0, 37, 0, 32, 0.6, 75, 3),
(64, 'HRBS', 'tbsp', 'Chives (chopped)', 8, 1, 0.1, 0, 0.1, 0.1, 0, 0, 0, 0, 3, 0, 1, 0, 435, 58),
(65, 'OTHR', 'tsp', 'Salt', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1163, 0, 0, 0),
(66, 'OTHR', 'tsp', 'Pepper', 0, 5, 1, 0, 0.3, 0.1, 0, 0, 0.1, 0, 17, 0, 1, 0, 1, 8),
(72, 'VEGI', 'unit', 'Potatoes (mashed)', 20, 90, 21, 0, 2.2, 0.7, 0.6, 0.1, 0.2, 0.1, 620, 2, 15, 1.1, 0, 19),
(73, 'MSF', 'lb', 'Ground Beef', 0, 977, 0, 287, 0, 65.6, 26.4, 3, 34.3, 19.8, 608, 100, 249, 0, 0, 0),
(74, 'VEGI', 'unit', 'Onion (chopped)', 20, 64, 15, 0, 2.7, 0.2, 0.1, 0, 0, 0, 146, 1, 4, 6.8, 0, 10),
(75, 'HRBS', 'tbsp', 'Garlic (minced)', 13, 4, 1, 0, 0.1, 0.1, 0, 0, 0, 0, 5, 0, 1, 0.1, 1, 3),
(76, 'OTHR', 'tsp', 'Spices (e.g., paprika, cumin)', 4, 5, 1, 0, 0.3, 0.3, 0.2, 0.1, 0.1, 0.1, 25, 0, 3, 0, 6, 1),
(77, 'OTHR', 'unit', 'Phyllo Pastry Sheets', 0, 460, 64, 0, 3, 7, 2.5, 1, 5, 0, 0, 9, 7, 4, 0, 0),
(78, 'OTHR', 'tbsp', 'Butter (melted)', 3, 102, 0, 31, 0, 11.5, 7.3, 4.6, 0, 0.4, 0, 3, 0, 82, 0, 491),
(79, 'MSF', 'oz', 'Cheese (mozzarella)', 505, 85, 1.6, 28, 0, 0, 6.3, 3.7, 0.2, 2.2, 46, 6, 176, 0, 5, 0),
(80, 'OTHR', 'cup', 'Breadcrumbs', 24, 455, 95, 0, 3, 3.4, 0.4, 0.1, 0.1, 0.6, 30, 13, 0, 1, 0, 0),
(81, 'OTHR', 'cup', 'Parmesan Cheese (grated)', 416, 431, 3.8, 123, 0, 0, 28.4, 11.1, 1.6, 6.6, 138, 32, 1354, 0, 0, 0),
(82, 'OTHR', 'unit', 'Egg', 12, 70, 0, 185, 0, 5, 1.5, 1, 1.5, 70, 6, 70, 0, 0, 0, 0),
(83, 'OTHR', 'tsp', 'Italian Seasoning', 28, 5, 1, 0, 0.3, 0.2, 0.1, 0.1, 0.1, 0.1, 19, 0, 1, 0, 3, 0),
(84, 'VEGI', 'unit', 'Jalapenos', 14, 4, 0.9, 0, 0.5, 0.2, 0.1, 0.1, 0.1, 0, 148, 0.2, 1, 0.7, 6, 66),
(85, 'OTHR', 'oz', 'Cream Cheese', 24, 51, 1.6, 16, 0, 0.1, 5.1, 3.3, 0.2, 2.1, 49, 0.9, 50, 1.6, 165, 0),
(86, 'OTHR', 'unit', 'Bacon', 0, 43, 0.1, 10, 0, 0.1, 3.5, 1.4, 1.7, 1.6, 43, 3, 137, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ingredient_recipe`
--


--

INSERT INTO `ingredient_recipe` (`ingredient_id`, `recipe_id`, `number_of_unit`, `measurement_description`) VALUES
(1, 1, 300, 'g'),
(2, 1, 200, 'g'),
(3, 1, 2, 'tbsp'),
(4, 1, 1, 'tbsp'),
(5, 2, 150, 'g'),
(6, 2, 1, 'unit'),
(7, 2, 2, 'tbsp'),
(8, 2, 1, 'unit'),
(9, 3, 1, 'can'),
(10, 3, 1, 'cup'),
(11, 3, 2, 'unit'),
(12, 3, 1, 'cup'),
(13, 3, 1, 'unit'),
(14, 3, 2, 'tbsp'),
(15, 3, 2, 'tbsp'),
(16, 4, 2, 'unit'),
(17, 4, 2, 'tbsp'),
(18, 4, 2, 'unit'),
(19, 4, 2, 'tbsp'),
(20, 4, 2, 'tbsp'),
(26, 5, 4, 'unit'),
(27, 5, 1, 'cup'),
(28, 5, 1, 'cup'),
(29, 5, 1, 'unit'),
(30, 5, 2, 'tbsp'),
(31, 6, 2, 'cup'),
(32, 6, 1, 'cup'),
(33, 6, 1, 'unit'),
(34, 6, 1, 'unit'),
(35, 6, 0, 'cup'),
(36, 6, 1, 'unit'),
(37, 6, 3, 'tbsp'),
(38, 6, 2, 'unit'),
(39, 6, 1, 'tsp'),
(40, 6, 1, 'tsp'),
(41, 6, 1, 'tsp'),
(42, 6, 0, 'tsp'),
(43, 7, 1, 'can'),
(44, 7, 2, 'unit'),
(45, 7, 1, 'cup'),
(46, 7, 0, 'unit'),
(47, 7, 0, 'cup'),
(48, 7, 1, 'tbsp'),
(49, 7, 1, 'tbsp'),
(50, 7, 1, 'tsp'),
(51, 7, 0, 'tsp'),
(52, 7, 1, 'cup'),
(60, 9, 6, 'unit'),
(61, 9, 1, 'cup'),
(62, 9, 1, 'tsp'),
(63, 9, 1, 'unit'),
(64, 9, 2, 'tbsp'),
(65, 9, 1, 'tsp'),
(66, 9, 0, 'tsp'),
(72, 11, 2, 'unit'),
(73, 11, 1, 'lb'),
(74, 11, 1, 'unit'),
(75, 11, 2, 'tbsp'),
(76, 11, 1, 'tsp'),
(77, 11, 1, 'unit'),
(78, 11, 2, 'tbsp'),
(79, 12, 8, 'oz'),
(80, 12, 1, 'cup'),
(81, 12, 1, 'cup'),
(82, 12, 2, 'unit'),
(83, 12, 1, 'tsp'),
(84, 13, 12, 'unit'),
(85, 13, 4, 'oz'),
(86, 13, 12, 'unit');

-- --------------------------------------------------------





COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
