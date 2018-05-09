-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2018 at 05:25 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `Name`, `Picture`) VALUES
(1, 'Yogurt', 'Raita.jpg'),
(2, 'Lentil', 'BlackLentil.png'),
(3, 'Bread', 'naan.jpg'),
(4, 'Chicken', 'ButterChicken.png');

-- --------------------------------------------------------

--
-- Table structure for table `fav_user_recipe`
--

CREATE TABLE `fav_user_recipe` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `Rating` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fav_user_recipe`
--

INSERT INTO `fav_user_recipe` (`user_id`, `recipe_id`, `Rating`) VALUES
(5, 1, '5'),
(5, 3, '5'),
(5, 4, '5'),
(6, 1, '5'),
(6, 3, '5'),
(6, 4, '5');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `ingredient_name`) VALUES
(1, 'Yogurt'),
(2, 'Cucumber'),
(3, 'Mint'),
(4, 'Black Lentils'),
(5, 'Green Lentils'),
(6, 'Water'),
(7, 'Olive Oil'),
(8, 'Onion'),
(9, 'Garlic'),
(10, 'Green Chillies'),
(11, 'Turmeric'),
(12, 'Cumin'),
(13, 'Cinnamon'),
(14, 'Black Pepper'),
(15, 'Tomato'),
(16, 'Lemon juice'),
(17, 'Coriander'),
(18, 'Salt'),
(19, 'Wheat Flour'),
(20, 'Yeast'),
(21, 'Butter'),
(22, 'Milk'),
(23, 'Chicken'),
(24, 'Chilli Powder');

-- --------------------------------------------------------

--
-- Table structure for table `meal_type`
--

CREATE TABLE `meal_type` (
  `meal_id` int(11) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meal_type`
--

INSERT INTO `meal_type` (`meal_id`, `Description`, `Picture`) VALUES
(1, 'Appetizer', 'Raita.jpg'),
(2, 'Main Dish', 'BlackLentil.png'),
(3, 'Dessert', 'naan.jpg'),
(4, 'Non-Veg', 'ButterChicken.png');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(200) NOT NULL,
  `preparation_time` varchar(200) NOT NULL,
  `cooking_time` varchar(200) NOT NULL,
  `Servings` varchar(200) NOT NULL,
  `Picture` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `recipe_name`, `preparation_time`, `cooking_time`, `Servings`, `Picture`, `category_id`, `meal_id`) VALUES
(1, 'Raita', '15 minutes', '15 minutes', '2 People', 'Raita.jpg', 1, 1),
(2, 'Black Lentil', '20 minutes', '1 hour', '4 People', 'BlackLentil.png', 2, 2),
(3, 'Naan', '20 minutes', '30 minutes', '1 Person', 'naan.jpg', 3, 3),
(4, 'Butter Chicken', '30 minutes', '1 hour', '4 People', 'ButterChicken.png', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredient`
--

CREATE TABLE `recipe_ingredient` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `Quantity` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_ingredient`
--

INSERT INTO `recipe_ingredient` (`id`, `recipe_id`, `ingredient_id`, `Quantity`) VALUES
(1, 1, 1, '1/2 Cup'),
(2, 1, 2, '1/2 cup chopped seeded English hothouse cucumber'),
(3, 1, 17, '1/4 teaspoon ground coriander.'),
(4, 1, 12, '1/4 teaspoon ground cumin.'),
(5, 2, 4, '1 cup black lentils '),
(6, 2, 21, '5 tablespoons butter'),
(7, 2, 8, '1 onion cut into 1/2-inch dice'),
(8, 2, 9, '2 garlic cloves, minced.'),
(9, 2, 17, '1/2 teaspoon ground coriander'),
(10, 2, 12, '1/2 teaspoon ground cumin.'),
(11, 2, 15, '1 cup canned crushed tomatoes'),
(12, 2, 18, '1/4 teaspoon salt'),
(13, 3, 19, '250g/9oz wheat flour.'),
(14, 3, 18, '1 tsp salt'),
(15, 3, 20, '1 tsp yeast.'),
(16, 3, 22, '110-130ml oz milk.'),
(17, 3, 7, '2 tbsp olive oil.'),
(18, 4, 21, '6 tablespoons butter'),
(19, 4, 23, '2 lbs chicken breasts'),
(20, 4, 8, '1 yellow onion, diced.'),
(21, 4, 9, '3 garlic cloves, minced.'),
(22, 4, 24, '1 tsp chili powder.'),
(23, 4, 12, '1 tsp ground cumin.'),
(24, 4, 15, '2 tomatoes'),
(25, 4, 18, 'salt & pepper');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_preparation`
--

CREATE TABLE `recipe_preparation` (
  `recipe_prep_id` int(11) NOT NULL,
  `steps` int(50) NOT NULL,
  `recipe_description` varchar(1000) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_preparation`
--

INSERT INTO `recipe_preparation` (`recipe_prep_id`, `steps`, `recipe_description`, `recipe_id`) VALUES
(1, 1, 'Wash the cucumber and peel it.', 1),
(2, 2, 'Take curd and salt in small bowl and beat it lightly until smooth', 1),
(3, 3, 'Add grated cucumber and green chilli in beaten curd and mix well.', 1),
(4, 4, 'Transfer it to a serving bowl and garnish with cumin powder and coriander leaves.', 1),
(5, 1, 'Place the urad dal and black chickpeas in a pot and cover with a few inches of water. Set aside to soak for at least 2 hours or up to 12 hours.', 2),
(6, 2, 'Drain the water from the pot and add fresh water. Bring the water to a boil then reduce the heat to a low simmer, cover the pot, and let it cook until the chickpeas are soft, about 1 hour. Drain and rinse.', 2),
(7, 3, 'Heat the olive oil in a large pan over medium-high heat. Add the onion and cook until soft, about 5 minutes. Add the ginger and garlic and continue to cook for 2-3 minutes, stirring often. Add the cumin seeds and coriander seeds to the pan and cook until fragrant, about 1 minute. Add the tomatoes and cook, stirring often, until the oil begins to glisten, about 5 minutes.', 2),
(8, 4, 'Add 1 cup of water, the garam masala, curry powder, turmeric, chili powder, salt, and the cooked urad lentils and black chickpeas to the pan and stir. Bring the pot to a boil then reduce the heat to low. Let it simmer, uncovered, for 20 minutes, stirring occasionally.', 2),
(9, 1, 'Combine warm water, sugar, and yeast in a bowl. Let stand for 5 minutes until foamy', 3),
(10, 2, 'Add salt and flour. Mix thoroughly.', 3),
(11, 3, 'Put in a warm place to rise for 30-45 minutes', 3),
(12, 4, 'Turn dough out onto a floured workspace', 3),
(13, 5, 'Grill naan pieces on a grill or electric griddle', 3),
(14, 6, 'This recipe yields a very soft, chewey naan', 3),
(15, 1, 'Place yoghurt, garlic, ginger, cumin, coriander, garam masala and chilli powder in a glass or ceramic dish. Add chicken. Stir to coat.', 4),
(16, 2, 'Heat oil and butter in a heavy-based saucepan over medium-high heat. Add onion.', 4),
(17, 3, 'Stir in cream. Simmer for a further 5 minutes or until heated through.', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(1) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(29) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'q@q', 'qq', '$2y$10$7694f4a66316e53c8cdd9OAanOcSSTedLRjhCeXBhd.Fdh.eNCBSe', '$2y$10$7694f4a66316e53c8cdd9d'),
(2, 'man@gmail.com', 'man', '$2y$10$81dc9bdb52d04dc20036dOoKDaV0pqGraZlwgFv/SbyZZlkJynnwC', '$2y$10$81dc9bdb52d04dc20036db'),
(4, 'sa@gmail.com', 'sa', '$2y$10$c12e01f2a13ff5587e1e9eQ3IRO1o78oPLrp7bh/C/2PzB55yrnnO', '$2y$10$c12e01f2a13ff5587e1e9e'),
(5, 'demo', 'demo@gmail.com', '$2y$10$fe01ce2a7fbac8fafaed7Ozj5kos3B3Vdzxb4AkoJH8GQuC8/bITq', '$2y$10$fe01ce2a7fbac8fafaed7c'),
(6, 'aman', 'amandeep@gmail.com', '$2y$10$ccda1683d8c97f8f2dff2eqLYe9uN52uvo3r.B.ig80/O/YOlmvmy', '$2y$10$ccda1683d8c97f8f2dff2e'),
(7, 'Gagan', 'gaga@gmail.com', '$2y$10$f52bb23033354697e8f55OzAOtXiJp6c01ISvDzTv7Fssew69ja7y', '$2y$10$f52bb23033354697e8f55a');

-- --------------------------------------------------------

--
-- Table structure for table `user_fav_recipe`
--

CREATE TABLE `user_fav_recipe` (
  `user_fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `Rating` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_fav_recipe`
--

INSERT INTO `user_fav_recipe` (`user_fav_id`, `user_id`, `recipe_id`, `Rating`) VALUES
(1, 5, 4, '5'),
(2, 5, 1, '4'),
(5, 6, 1, '3'),
(7, 5, 2, '5'),
(9, 5, 3, '1'),
(11, 6, 2, '5'),
(12, 6, 2, '5'),
(13, 6, 2, '5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `fav_user_recipe`
--
ALTER TABLE `fav_user_recipe`
  ADD PRIMARY KEY (`user_id`,`recipe_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexes for table `meal_type`
--
ALTER TABLE `meal_type`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_preparation`
--
ALTER TABLE `recipe_preparation`
  ADD PRIMARY KEY (`recipe_prep_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_fav_recipe`
--
ALTER TABLE `user_fav_recipe`
  ADD PRIMARY KEY (`user_fav_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `meal_type`
--
ALTER TABLE `meal_type`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `recipe_preparation`
--
ALTER TABLE `recipe_preparation`
  MODIFY `recipe_prep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_fav_recipe`
--
ALTER TABLE `user_fav_recipe`
  MODIFY `user_fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
