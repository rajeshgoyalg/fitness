-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2019 at 10:39 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `day_exercises`
--

CREATE TABLE `day_exercises` (
  `day_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `exercise_order` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `day_exercises`
--

INSERT INTO `day_exercises` (`day_id`, `exercise_id`, `exercise_order`) VALUES
(2, 1, 1),
(10, 1, 1),
(14, 2, 1),
(8, 3, 2),
(7, 4, 1),
(13, 6, 3),
(2, 7, 4),
(3, 7, 1),
(4, 7, 4),
(7, 7, 2),
(11, 7, 1),
(12, 8, 4),
(2, 9, 5),
(2, 11, 2),
(9, 11, 1),
(14, 11, 2),
(2, 12, 3),
(12, 12, 2),
(4, 13, 1),
(12, 13, 1),
(9, 14, 2),
(7, 16, 3),
(11, 16, 2),
(2, 18, 6),
(4, 18, 5),
(4, 19, 6),
(14, 19, 3),
(6, 20, 3),
(12, 20, 3),
(3, 21, 3),
(14, 21, 4),
(15, 23, 1),
(15, 24, 2),
(15, 25, 3),
(15, 26, 4),
(4, 29, 3),
(5, 30, 1),
(10, 30, 2),
(3, 34, 6),
(5, 34, 3),
(4, 35, 2),
(3, 36, 5),
(6, 37, 1),
(6, 38, 2),
(10, 38, 3),
(6, 41, 4),
(5, 42, 2),
(8, 42, 3),
(3, 44, 4),
(13, 44, 1),
(5, 45, 5),
(8, 46, 4),
(3, 47, 2),
(5, 48, 4),
(8, 49, 1),
(13, 49, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `exercise_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`exercise_id`, `exercise_name`) VALUES
(1, '15 pushups'),
(2, '50 jumping jacks'),
(3, '20 crunches'),
(4, '60 seconds plans'),
(5, '30 squats'),
(6, '10 mountain climbers'),
(7, '10 triceps dips'),
(8, '40 crunches'),
(9, '40 high knees'),
(10, '12 burpees'),
(11, '60 seconds wall sit'),
(12, 'Lateral Raises'),
(13, 'EZ Bar Upright Rows'),
(14, 'Close-Grip Pulldowns'),
(15, 'Cable Fly'),
(16, 'Lunges'),
(17, 'Hammer Curls'),
(18, 'Tricep Extension'),
(19, 'Standing Barbell Curl'),
(20, 'Preacher Curl'),
(21, 'Incline Dumbbell Curl'),
(22, 'Squat'),
(23, 'Dumbbell Lunge'),
(24, '45 Degree Leg Press'),
(25, 'Leg Curl'),
(26, 'Leg Extension'),
(27, 'Standing Calf Raise'),
(28, 'Seated Calf Raise'),
(29, 'Dumbbell Flys'),
(30, 'Cable Crossovers'),
(31, 'Close Grip Bench Press'),
(32, 'Lying Dumbbell Extension'),
(33, 'Tricep Kickback'),
(34, 'One Arm Cable Lateral Raise'),
(35, 'Seated Row'),
(36, 'Bent Over Barbell Row'),
(37, 'Bent Over Row'),
(38, 'Smith Machine Upright Row'),
(39, 'Chair pose'),
(40, 'Concentration Curl'),
(41, 'Reverse Barbell Curl'),
(42, 'Dumbbell Bench Press'),
(43, 'dumbel front squat'),
(44, 'Chest Dip'),
(45, 'Abdominal crunch'),
(46, 'Side crunch'),
(47, 'Hip Raise'),
(48, 'Bicycle crunch'),
(49, 'Reverse crunch'),
(50, 'Back extension'),
(51, 'Butterflies');

-- --------------------------------------------------------

--
-- Table structure for table `plan_days`
--

CREATE TABLE `plan_days` (
  `plan_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `week_day` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plan_days`
--

INSERT INTO `plan_days` (`plan_id`, `day_id`, `week_day`) VALUES
(1, 1, 6),
(1, 1, 7),
(3, 1, 7),
(4, 1, 6),
(4, 1, 7),
(5, 1, 7),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 1, 1),
(17, 1, 6),
(18, 1, 6),
(1, 2, 1),
(3, 2, 6),
(5, 2, 2),
(8, 2, 2),
(9, 2, 2),
(10, 2, 2),
(11, 2, 2),
(12, 2, 2),
(13, 2, 2),
(14, 2, 2),
(1, 3, 2),
(5, 3, 6),
(1, 4, 3),
(3, 4, 1),
(4, 5, 1),
(4, 5, 3),
(1, 6, 5),
(5, 7, 4),
(4, 9, 5),
(4, 12, 2),
(3, 13, 4),
(3, 14, 2),
(5, 14, 3),
(3, 15, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `plan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `plan_id`) VALUES
(1, 'Paul', 'Stewart', 'paul.stewart@fitnessapp.com', 1),
(3, 'Peter', 'Millar', 'peter.millar@fitnessapp.com', 3),
(6, 'James', 'Charles', 'james.charles@fitnessapp.com', 4),
(8, 'Rajesh', 'Goyal', 'rajeshgoyalg@gmail.com', 11);

-- --------------------------------------------------------

--
-- Table structure for table `workout_days`
--

CREATE TABLE `workout_days` (
  `day_id` int(11) NOT NULL,
  `day_workout` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workout_days`
--

INSERT INTO `workout_days` (`day_id`, `day_workout`) VALUES
(1, 'Whole body workout'),
(2, 'Chest, Back, Shoulders, Legs, Biceps, Triceps'),
(3, 'Legs, Triceps, Biceps, Chest, Back, Shoulder'),
(4, 'Shoulders, Back, Chest, Legs, Triceps, Biceps'),
(5, 'Chest, Shoulders and Triceps'),
(6, 'Shoulders cardio'),
(7, 'Chest abs'),
(8, 'Legs cardio'),
(9, 'Strength training'),
(10, 'Chest & Back'),
(11, 'Legs'),
(12, 'Shoulders & Arms'),
(13, 'Chest, Biceps'),
(14, 'HIIT Workout 1'),
(15, 'Back & Triceps');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`plan_id`, `plan_name`) VALUES
(1, '21 day challenge'),
(3, '8 week fitness challenge'),
(4, 'Slimpossible'),
(5, '2 FIT 2 QUIT'),
(6, 'Fitness boot camp'),
(8, 'Waist Management'),
(9, 'Now workout'),
(10, 'A to Z workout'),
(11, 'Indoor cardio crusher'),
(12, 'Healthy apples'),
(13, 'No excuse workout'),
(14, 'Power gym workout'),
(16, '7 minutes HIIT workout'),
(17, '45 minutes circular killer arm and legs'),
(18, '24 minute bootcamp workout');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `day_exercises`
--
ALTER TABLE `day_exercises`
  ADD UNIQUE KEY `uk_de_day_id_and_exercixe_index` (`day_id`,``),
  ADD KEY `fk_dte_exercise_id` (`exercise_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `plan_days`
--
ALTER TABLE `plan_days`
  ADD UNIQUE KEY `uk_pd_plan_id_and_day_index` (`plan_id`,`week_day`),
  ADD KEY `fk_ptd_day_id` (`day_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`email`);

--
-- Indexes for table `workout_days`
--
ALTER TABLE `workout_days`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `workout_days`
--
ALTER TABLE `workout_days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `day_exercises`
--
ALTER TABLE `day_exercises`
  ADD CONSTRAINT `fk_dte_day_id` FOREIGN KEY (`day_id`) REFERENCES `workout_days` (`day_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dte_exercise_id` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plan_days`
--
ALTER TABLE `plan_days`
  ADD CONSTRAINT `fk_ptd_day_id` FOREIGN KEY (`day_id`) REFERENCES `workout_days` (`day_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ptd_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `workout_plans` (`plan_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
