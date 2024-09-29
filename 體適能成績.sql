-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-13 18:15:20
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `fitness_records`
--

-- --------------------------------------------------------

--
-- 資料表結構 `fitness_scores`
--

CREATE TABLE `fitness_scores` (
  `name` varchar(100) NOT NULL,
  `shuttle_run` int(11) NOT NULL,
  `sit_up` int(11) NOT NULL,
  `standing_long_jump` int(11) NOT NULL,
  `sit_and_reach` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `fitness_scores`
--

INSERT INTO `fitness_scores` (`name`, `shuttle_run`, `sit_up`, `standing_long_jump`, `sit_and_reach`) VALUES
('凱', 35, 60, 130, 20),
('小胖', 20, 55, 180, 25),
('彤', 15, 30, 150, 30),
('承宗', 20, 40, 170, 23),
('阿瑑', 30, 80, 200, 25);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `fitness_scores`
--
ALTER TABLE `fitness_scores`
  ADD PRIMARY KEY (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
