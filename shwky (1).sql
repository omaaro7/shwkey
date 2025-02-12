-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 12 فبراير 2025 الساعة 21:02
-- إصدار الخادم: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shwky`
--

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `name` varchar(255) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `create_time`, `name`, `description`) VALUES
(1, '2025-01-07 00:00:00', 'ألعاب ذهنيه', 'هذه الألعاب تهدف إلى تنشيط العقل وتحفيز التفكير والتركيز. تتنوع بين الألغاز، التحديات المنطقية، والتدريبات التي تحفز الذاكرة والتركيز الذهني. تساعد هذه الألعاب الأشخاص ذوي الإعاقات الذهنية أو الذين يعانون من صعوبة في التركيز على تحسين وظائف الدماغ بطرق ممتعة.'),
(2, '2025-01-21 01:40:44', 'ألعاب علميه', 'تركز هذه الألعاب على تعزيز الفهم العلمي والتجارب التعليمية المتعلقة بالعلوم. تتضمن حل الألغاز التي تعتمد على قوانين الفيزياء، الكيمياء، أو البيولوجيا، مما يساعد الأشخاص ذوي الإعاقات في تعلم المفاهيم العلمية بطريقة تفاعلية وممتعة.'),
(3, '2025-01-13 00:00:00', 'ألعاب الذاكره', 'تهدف هذه الألعاب إلى تحسين الذاكرة قصيرة وطويلة المدى. يمكن أن تكون على شكل بطاقات تطابق أو تمارين تتطلب تذكر تسلسل معين أو معلومات متغيرة. تساعد هذه الألعاب الأشخاص ذوي الإعاقات على تعزيز قدرتهم على الاحتفاظ بالمعلومات والرجوع إليها بسهولة.');

-- --------------------------------------------------------

--
-- بنية الجدول `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(255) DEFAULT NULL,
  `points` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `tech` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `thumnail` varchar(255) DEFAULT NULL,
  `storage_value` varchar(255) DEFAULT NULL,
  `storage_value_value` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `games`
--

INSERT INTO `games` (`id`, `name`, `points`, `level`, `tech`, `description`, `path`, `thumnail`, `storage_value`, `storage_value_value`, `category`) VALUES
(1, 'المتاهه', '10', 'easy', 'التحريك بالصوت', 'هي تجربة تفاعلية مصممة خصيصًا لتلبية احتياجات اللاعبين من مختلف القدرات. تتيح هذه اللعبة للأشخاص ذوي الإعاقة الاستمتاع بتحديات المتاهة بطريقة ممتعة وسهلة. تم تكييف واجهة اللعبة لتكون قابلة للوصول بشكل أكبر، مع إضافة بعض التقنيات لمساعده اللاعبين', 'Maze', 'maze-2.jpg', 'levelHardness', '12', 'ألعاب ذهنيه'),
(2, 'ألغاز الألوان (colors Puzzel)', '15', 'medium', 'null', 'هي لعبة تفاعلية تنطوي على تحديات مرحة تحفز الدماغ، وتساعد في تحسين المهارات البصرية والتفكير المنطقي. تم تصميم هذه اللعبة بحيث تكون شاملة، وتناسب الأشخاص من مختلف القدرات، مع تخصيصات متعددة لتلبية احتياجات ذوي الإعاقة.', 'Puzzel', 'puzzel.png', 'puzzel', 'colors', 'ألعاب ذهنيه'),
(3, 'puuzel طائرة', '20', 'medium', 'null', 'ChatGPT لعبة البازل هذه مصممة خصيصًا للأشخاص ذوي الاحتياجات الخاصة، حيث تهدف إلى تعزيز التفاعل والإبداع لديهم. تحتوي اللعبة على قطع بازل كبيرة وسهلة الإمساك، مما يجعلها مناسبة لجميع القدرات الحركية. تدور فكرة اللعبة حول تجميع صورة طائرة ملونة ومبهجة، مما ', 'Puzzel', 'puzzel-2.png', 'puzzel', 'pesawat', 'ألعاب ذهنيه'),
(4, 'سرعة البديهة', '10', 'easy', 'null', '\"لعبة ذكاء سريعة ومثيرة صممت لاختبار سرعة البديهة والتفكير لدى اللاعبين، بما في ذلك ذوي الإعاقات الذهنية. تتضمن تحديات متنوعة تعزز التركيز والذاكرة وسرعة الاستجابة. تجربة ممتعة وتفاعلية تناسب جميع الفئات العمرية!\"', 'Fast', 'fast.png', 'null', 'null', 'ألعاب ذهنيه');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `user_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `date_birth` varchar(255) DEFAULT NULL,
  `parent_data_birth` varchar(255) DEFAULT NULL,
  `parent_type` varchar(255) DEFAULT NULL,
  `finshed_games` varchar(255) DEFAULT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `parent_phonenumber` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `stat` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `coins` varchar(255) DEFAULT NULL,
  `edited` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `create_time`, `user_name`, `name`, `parent_name`, `date_birth`, `parent_data_birth`, `parent_type`, `finshed_games`, `token`, `parent_phonenumber`, `type`, `password`, `stat`, `level`, `coins`, `edited`) VALUES
(1, NULL, 'ssssssss', 'iiojoij', 'Mohammed', '2025-01-01', '2025-01-07', 'ماما', '[\"1\",\"2\",\"3\",\"3\",\"4\",\"4\"]', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyZG9tYWluLmNvbSIsImF1ZCI6InlvdXJkb21haW4uY29tIiwiaWF0IjoxNzM5MDU2MjA0LCJleHAiOjE3MzkwNTk4MDQsImRhdGEiOnsicGFyZW50X3Bob25lbnVtYmVyIjoic3Nzc3Nzc3MifX0.B_JtRiyTuM_8aFoQ9F9zTKoCnmkF5CzHahsMeyQ-L3A', 'ssssssss', 'أنثى', '$2y$10$nKHZhZ67vGtKZ2L5b4CT0.CTpQXvTex7YYLCQR46X/FejUlTr32iW', '0', '0', '75', '010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
