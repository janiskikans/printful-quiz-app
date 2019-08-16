-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2019 at 08:38 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.3.7-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizzes`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(50) NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `is_correct` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `text`, `question_id`, `is_correct`) VALUES
(19, 'The Godfather', 6, 0),
(20, 'Dirty Dancing', 6, 0),
(21, 'The Italian Job', 6, 1),
(22, 'Karate Kid', 6, 0),
(23, 'Harvey', 7, 0),
(24, 'Black Dynamite', 7, 0),
(25, 'The Last King of Scotland', 7, 0),
(26, 'Taxi Driver', 7, 1),
(27, 'Wizard of Oz', 8, 1),
(28, 'Carry On Leo', 8, 0),
(29, 'Garden State', 8, 0),
(30, 'Misery', 8, 0),
(31, 'Lord of War', 9, 0),
(32, 'Cape Fear', 9, 0),
(33, 'Ray', 9, 0),
(34, 'Dirty Dancing', 9, 1),
(35, 'Fearless', 10, 0),
(36, 'Toy Story', 10, 1),
(37, 'Babel', 10, 0),
(38, 'Braveheart', 11, 1),
(39, 'Drive', 11, 0),
(40, 'Rounders', 11, 0),
(41, 'The Wrestler', 11, 0),
(42, 'The 39 Steps', 12, 0),
(43, 'The Artist', 12, 0),
(44, 'The Searchers', 12, 0),
(45, 'Forrest Gump', 12, 1),
(46, 'New York', 13, 0),
(47, 'Alaska', 13, 1),
(48, 'California', 13, 0),
(49, 'Istanbul, Turkey', 14, 1),
(50, 'Dubai, UAE', 14, 0),
(51, 'Cali, Columbia', 14, 0),
(52, 'Manila, Philippines', 14, 0),
(53, 'Guyana', 15, 0),
(54, 'Suriname', 15, 0),
(55, 'Amazon', 15, 1),
(56, 'Santarem', 15, 0),
(57, 'Pitcairn Island', 16, 1),
(58, 'Sumatra', 16, 0),
(59, 'Java', 16, 0),
(60, 'South America', 17, 0),
(61, 'Asia', 17, 0),
(62, 'Africa', 17, 0),
(63, 'North America', 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `quiz_taken_at` datetime NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `quiz_taken_at`, `user_id`, `quiz_id`) VALUES
(157, '2019-08-16 09:20:55', 13, 2),
(158, '2019-08-16 10:00:45', 13, 2),
(159, '2019-08-16 10:02:05', 13, 2),
(160, '2019-08-16 10:30:13', 13, 2),
(161, '2019-08-16 10:30:26', 13, 2),
(162, '2019-08-16 10:41:08', 13, 3),
(163, '2019-08-16 11:08:37', 13, 1),
(164, '2019-08-16 11:12:29', 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `quiz_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `quiz_id`) VALUES
(6, 'Name the film the following quote is from. \"You\'re only supposed to blow the bloody doors off!\"', 1),
(7, 'Name the film the following quote is from. \"You talkin\' to me?\"', 1),
(8, 'Name the film the following quote is from. \"Toto, I\'ve a feeling we\'re not in Kansas anymore.\"', 1),
(9, 'Name the film the following quote is from. \"Nobody puts Baby in a corner.\"', 1),
(10, 'Name the film the following quote is form. \"To Infinity and Beyond!\"', 2),
(11, 'Name the film the following quote is form. \"...That they may take our lives, but they\'ll never take our freedom.\"', 2),
(12, 'Name the film the following quote is form. \"Mama says, \'Stupid is as stupid does.\"', 2),
(13, 'More than half of the United States entire coastline is situated in which state?', 3),
(14, 'Which city is the only city in the world to be located on two separate continents?', 3),
(15, 'Which Brazilian rainforest produces over 20% of the world\'s oxygen supply?', 3),
(16, 'What is the world\'s smallest island with country status?', 3),
(17, 'Superior is the largest lake in which continent?', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`) VALUES
(1, 'Film Quotes Quiz 1'),
(2, 'Film Quotes Quiz 2'),
(3, 'Geography Quiz 1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(13, 'Janis Kikans', 'janis.kikans@gmail.com', '$2y$10$t897KuF6CLHC.vzb/YTSc.roGNSvIU2Ez3cvdFDE52Lc7QPZY0Ev.'),
(14, 'Testa Lietotājs', 'testa.lietotajs@mail.com', '$2y$10$a0Ez9Lt0OrK6AIAUQNQhDO1yVDbTN5g9HLxRxIihnWYVU8XuEBQA2'),
(15, 'Wendy Glass', 'nekodywo@mailinator.com', '$2y$10$DxqiF66x.XYJLAGyG.cYe.99V0KejJ0GGVr5D3Yx4xWleJ/6XNFiS'),
(16, 'Oleg Pennington', 'kuvywy@mailinator.net', '$2y$10$sNCtYJArBntEMs9ZbC3VBu8YCFU0tb0ALIFy6aStCeoto6h29pMwO');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `attempt_id`, `question_id`, `answer_id`) VALUES
(381, 157, 10, 35),
(382, 157, 11, 39),
(383, 157, 12, 45),
(384, 158, 10, 35),
(385, 158, 11, 40),
(386, 158, 12, 43),
(387, 159, 10, 35),
(388, 159, 11, 39),
(389, 159, 12, 42),
(390, 161, 10, 35),
(391, 161, 11, 40),
(392, 161, 12, 43),
(393, 162, 13, 46),
(394, 162, 14, 50),
(395, 162, 15, 55),
(396, 162, 16, 57),
(397, 162, 17, 60),
(398, 163, 6, 20),
(399, 163, 7, 23),
(400, 163, 8, 28),
(401, 163, 9, 33),
(402, 164, 10, 35),
(403, 164, 11, 39),
(404, 164, 12, 42);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_questions_id_fk` (`question_id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempts_quizzes_id_fk` (`quiz_id`),
  ADD KEY `attempts_users_id_fk` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quizzes_id_fk` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_answers_id_fk` (`answer_id`),
  ADD KEY `user_answers_questions_id_fk` (`question_id`),
  ADD KEY `user_answers_attempts_id_fk` (`attempt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `attempts_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_answers_id_fk` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `user_answers_attempts_id_fk` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`),
  ADD CONSTRAINT `user_answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
