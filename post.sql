-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-12-31 20:40:45
-- 伺服器版本： 8.0.39
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `post`
--
CREATE DATABASE IF NOT EXISTS `post` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `post`;

-- --------------------------------------------------------

--
-- 資料表結構 `login`
--

CREATE TABLE `login` (
  `id` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `login`
--

INSERT INTO `login` (`id`, `password`, `name`) VALUES
('aaa', '111', '小王'),
('bbb', '222', '小美'),
('ccc', '333', '小蜂'),
('ddd', '444', '小雅'),
('eee', '555', '小惠'),
('fff', '666', '小王1'),
('ggg', '777', '小美2'),
('hhh', '888', '小蜂3'),
('iii', '999', '小雅4'),
('jjj', '1010', '小惠5'),
('kkk', '2020', '小王11'),
('lll', '3030', '小美22'),
('nnn', '4040', '小蜂33'),
('mmm', '5050', '小雅44'),
('ooo', '6060', '小惠55'),
('ppp', '7070', '小王111'),
('qqq', '8080', '小美222'),
('rrr', '9090', '小蜂333'),
('xxx', '1111', '小雅444'),
('ttt', '2222', '小惠555');

-- --------------------------------------------------------

--
-- 資料表結構 `post`
--

CREATE TABLE `post` (
  `name` varchar(30) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post` text,
  `date` timestamp NULL DEFAULT NULL,
  `post_sort` enum('life','play','school','tech') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `post`
--

INSERT INTO `post` (`name`, `title`, `post`, `date`, `post_sort`) VALUES
('小王', '生活版文章1', '文章內容...', '2022-08-05 16:00:00', 'life'),
('小美', '生活版文章2', '文章內容...', '2022-09-19 16:00:00', 'life'),
('小蜂', '生活版文章3', '文章內容...', '2023-12-24 16:00:00', 'life'),
('小雅', '生活版文章4', '文章內容...', '2024-09-16 16:00:00', 'life'),
('小惠', '生活版文章5', '文章內容  生活版文章5...', '2022-09-19 16:00:00', 'life'),
('小王1', '娛樂版文章1', '文章內容  娛樂版文章1...', '2024-09-16 16:00:00', 'play'),
('小美2', '娛樂版文章2', '文章內容  娛樂版文章2...', '2024-09-16 16:00:00', 'play'),
('小蜂3', '娛樂版文章3', '文章內容  娛樂版文章3...', '2024-09-16 16:00:00', 'play'),
('小雅4', '娛樂版文章4', '文章內容  娛樂版文章4...', '2024-09-16 16:00:00', 'play'),
('小惠5', '娛樂版文章5', '文章內容  娛樂版文章5...', '2022-08-05 16:00:00', 'play'),
('小王11', '校園版文章1', '文章內容  校園版文章1...', '2024-09-16 16:00:00', 'school'),
('小美22', '校園版文章2', '文章內容  校園版文章2...', '2024-09-16 16:00:00', 'school'),
('小蜂33', '校園版文章3', '文章內容  校園版文章3...', '2024-09-16 16:00:00', 'school'),
('小雅44', '校園版文章4', '文章內容  校園版文章4...', '2024-09-16 16:00:00', 'school'),
('小惠55', '校園版文章5', '文章內容  校園版文章5...', '2022-08-05 16:00:00', 'school'),
('小王111', '科技版文章1', '文章內容  科技版文章1...', '2024-09-16 16:00:00', 'tech'),
('小美222', '科技版文章2', '文章內容  科技版文章2...', '2024-09-16 16:00:00', 'tech'),
('小蜂333', '科技版文章3', '文章內容  科技版文章3...', '2024-09-16 16:00:00', 'tech'),
('小雅444', '科技版文章4', '文章內容  科技版文章4...', '2024-09-16 16:00:00', 'tech'),
('小惠555', '科技版文章5', '文章內容  科技版文章5...', '2022-08-05 16:00:00', 'tech'),
('123', '新的文章', '新的文章內容', '2024-12-29 16:38:31', 'life'),
('123', '新的文章', '新的文章內容', '2024-12-29 16:39:00', 'life'),
('123', '新的文章', '新的文章內容', '2024-12-29 16:39:03', 'life'),
('林宥慈', 'now post', 'now post', '2024-12-29 16:45:28', 'play');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
