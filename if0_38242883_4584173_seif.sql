-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: fdb1030.awardspace.net
-- Generation Time: Feb 12, 2025 at 01:53 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4584173_seif`
--
CREATE DATABASE IF NOT EXISTS `4584173_seif` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `4584173_seif`;

-- --------------------------------------------------------

--
-- Table structure for table `food_clothes_items`
--

CREATE TABLE `food_clothes_items` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `money_items`
--

CREATE TABLE `money_items` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_insan_posts`
--

CREATE TABLE `team_insan_posts` (
  `id` int NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `الدردشة`
--

CREATE TABLE `الدردشة` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `الزيارات`
--

CREATE TABLE `الزيارات` (
  `id` int NOT NULL,
  `المكان` varchar(255) NOT NULL,
  `التاريخ` date NOT NULL,
  `وقت_التجمع` time NOT NULL,
  `مكان_التجمع` varchar(255) NOT NULL,
  `المشرف` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `الطلبات`
--

CREATE TABLE `الطلبات` (
  `id` int NOT NULL,
  `الاسم_الكامل` varchar(255) NOT NULL,
  `اسم_التيم` varchar(255) NOT NULL,
  `رقم_الموبيل` varchar(15) NOT NULL,
  `الايميل` varchar(255) NOT NULL,
  `الباسورد` varchar(255) NOT NULL,
  `تاريخ_التسجيل` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `المتطوعين`
--

CREATE TABLE `المتطوعين` (
  `id` int NOT NULL,
  `الاسم_الكامل` varchar(255) NOT NULL,
  `اسم_التيم` varchar(255) NOT NULL,
  `رقم_الموبيل` varchar(15) NOT NULL,
  `الايميل` varchar(255) NOT NULL,
  `الباسورد` varchar(255) NOT NULL,
  `تاريخ_القبول` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `المتطوعين`
--

INSERT INTO `المتطوعين` (`id`, `الاسم_الكامل`, `اسم_التيم`, `رقم_الموبيل`, `الايميل`, `الباسورد`, `تاريخ_القبول`) VALUES
(16, '‪SEIF AYMAN‬‏', 'admin', '01229363929', 'seifayman00000@gmail.com', 'Sseeiiff1@', '2025-02-04 11:17:46'),
(23, 'سيف ايمن احمد محمود ابراهيم', 'فريق IT', '01229363929', 'seifa79099@gmail.com', 'Sseeiiff1@', '2025-02-06 13:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `المشاركون_في_الزيارات`
--

CREATE TABLE `المشاركون_في_الزيارات` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `الاسم` varchar(255) NOT NULL,
  `اسم_التيم` varchar(255) NOT NULL,
  `visit_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `المشاركون_في_المعارض`
--

CREATE TABLE `المشاركون_في_المعارض` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `الاسم` varchar(255) NOT NULL,
  `اسم_التيم` varchar(255) NOT NULL,
  `معرض_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `المعارض`
--

CREATE TABLE `المعارض` (
  `id` int NOT NULL,
  `اسم_المعرض` varchar(255) NOT NULL,
  `المكان` varchar(255) NOT NULL,
  `التاريخ` date NOT NULL,
  `الوقت` time NOT NULL,
  `المشرف` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `تسجيل_الدخول`
--

CREATE TABLE `تسجيل_الدخول` (
  `id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `تسجيل_الدخول`
--

INSERT INTO `تسجيل_الدخول` (`id`, `user_name`, `timestamp`) VALUES
(15, 'سيف ايمن احمد محمود ابراهيم', '2025-02-07 17:58:02'),
(16, 'سيف ايمن احمد محمود ابراهيم', '2025-02-07 18:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `تقارير_المشاكل`
--

CREATE TABLE `تقارير_المشاكل` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `problem_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_clothes_items`
--
ALTER TABLE `food_clothes_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_items`
--
ALTER TABLE `money_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_insan_posts`
--
ALTER TABLE `team_insan_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `الدردشة`
--
ALTER TABLE `الدردشة`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `الزيارات`
--
ALTER TABLE `الزيارات`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `الطلبات`
--
ALTER TABLE `الطلبات`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `المتطوعين`
--
ALTER TABLE `المتطوعين`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `المشاركون_في_الزيارات`
--
ALTER TABLE `المشاركون_في_الزيارات`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`);

--
-- Indexes for table `المشاركون_في_المعارض`
--
ALTER TABLE `المشاركون_في_المعارض`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `المعارض`
--
ALTER TABLE `المعارض`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `تسجيل_الدخول`
--
ALTER TABLE `تسجيل_الدخول`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `تقارير_المشاكل`
--
ALTER TABLE `تقارير_المشاكل`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_clothes_items`
--
ALTER TABLE `food_clothes_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `money_items`
--
ALTER TABLE `money_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `team_insan_posts`
--
ALTER TABLE `team_insan_posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `الدردشة`
--
ALTER TABLE `الدردشة`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `الزيارات`
--
ALTER TABLE `الزيارات`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `الطلبات`
--
ALTER TABLE `الطلبات`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `المتطوعين`
--
ALTER TABLE `المتطوعين`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `المشاركون_في_الزيارات`
--
ALTER TABLE `المشاركون_في_الزيارات`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `المشاركون_في_المعارض`
--
ALTER TABLE `المشاركون_في_المعارض`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `المعارض`
--
ALTER TABLE `المعارض`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `تسجيل_الدخول`
--
ALTER TABLE `تسجيل_الدخول`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `تقارير_المشاكل`
--
ALTER TABLE `تقارير_المشاكل`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `المشاركون_في_الزيارات`
--
ALTER TABLE `المشاركون_في_الزيارات`
  ADD CONSTRAINT `المشاركون_في_الزيارات_ibfk_1` FOREIGN KEY (`visit_id`) REFERENCES `الزيارات` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
