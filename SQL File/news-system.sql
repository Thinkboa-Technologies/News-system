-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2025 at 01:00 PM
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
-- Database: `news-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `created_at`) VALUES
(1, 'Technology', 'Posts related to tech trends, gadgets, and software.', '2025-07-24 11:25:38'),
(2, 'Health', 'Articles on physical and mental wellness.', '2025-07-24 11:25:38'),
(3, 'Lifestyle', 'Content on travel, fashion, food, and personal habits.', '2025-07-24 11:25:38'),
(4, 'Education', 'Posts related to learning, courses, and academic topics.', '2025-07-24 11:25:38'),
(5, 'Finance', 'Insights on money management, investing, and economy.', '2025-07-24 11:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_posts`
--

CREATE TABLE `news_posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('draft','published','archived') DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_posts`
--

INSERT INTO `news_posts` (`post_id`, `title`, `content`, `image_url`, `author_id`, `category`, `tags`, `created_at`, `updated_at`, `status`) VALUES
(8, 'try read more', 'No matter who we are or where we come from, regardless of ethnicity, culture, gender, age, socioeconomic status, or physical and psychological challenges, we deserve to be cared for. We have the right to be well.Access to care may vary depending on our situation, but that does not mean we need to give up on our well-being. Sometimes, the support we need has not yet been made available, not because we have done anything wrong, but because our current care systems still have limitations. The right approach for our care may simply not have been discovered yet.Society often places the responsibility on individuals to navigate complex support systems. When we are unable to access care due to systemic barriers, cultural stigma, or personal circumstances, support is too often withheld. We tend to believe the problem lies within us, but in truth, what we need is greater recognition that our care systems are not yet equipped to fully support people from all backgrounds.We can still be supported. Our well-being is possible, and we are worthy of care that truly fits who we are. In my work, I have the honor of meeting people from many different backgrounds. I care deeply and equally for the mental wellness of every client and every community I serve.My sincere hope is that each of us feels seen, valued, and able to care for our own wellness. Even the smallest step we take toward self-care is meaningful. We are worthy of care, and we are never alone.', 'uploads/1754334918_cristofer-maximilian-AqLIkOzWDAk-unsplash.jpg', 0, 'life', '#life #enjoy ', '2025-07-24 18:41:59', '2025-08-04 19:15:18', 'published'),
(14, 'test-60', '1754334778_cristofer-maximilian-AqLIkOzWDAk-unsplash weijfnfj eififickdn  2wfn', 'uploads/1754396377_pexels-automnenoble-1008206.jpg', 70, 'life', '#life #enjoy ', '2025-08-04 19:11:46', '2025-08-05 12:19:37', 'published'),
(15, 'test-61', 'They start.\r\nThey launch early.\r\nSell before it’s polished.\r\nFigure it out as they go.\r\nBecause they understand something most people ignore:\r\nYou don’t build confidence by thinking.\r\nYou build it by moving.\r\nAction creates feedback.\r\nFeedback sharpens your direction.\r\nAnd direction is what creates traction.\r\nThat’s exactly how I built my business.\r\nNot with a perfect plan.', 'uploads/1754396523_dollar-gill-Y_ZHJiMdUMc-unsplash.jpg', 2, 'life', '#life #enjoy ', '2025-08-05 12:22:03', '2025-08-05 12:22:03', 'published'),
(16, 'qoqowowo', 'iqiqiqiwiiwwidjdj', 'uploads/1754474062_avatarboy.jpg', 6, 'game', '#life #enjoy ', '2025-08-06 09:54:22', '2025-08-06 09:54:22', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `contactno` varchar(11) DEFAULT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `contactno`, `posting_date`) VALUES
(1, 'vaibhav', 'bali', 'vaibhav@gmail.com', 'Test@123', '1234563210', '2025-01-10 06:15:52'),
(2, 'John', 'Doe', 'johndoe12@gamil.com', 'Test@12345', '4563210236', '2025-01-11 06:35:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `news_posts`
--
ALTER TABLE `news_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news_posts`
--
ALTER TABLE `news_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
