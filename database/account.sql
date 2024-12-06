-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 06 2024 г., 22:07
-- Версия сервера: 9.1.0
-- Версия PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `account`
--

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `emails`
--

INSERT INTO `emails` (`id`, `sender`, `receiver`, `subject`, `message`, `timestamp`) VALUES
(1, 'mariorossi@gmail.com', 'manuel@outlook.it', 'benvenuto', 'privet haaaaaa!!!', '2024-12-06 19:45:51'),
(2, 'mariorossi@gmail.com', 'manuel@outlook.it', 'benvenuto', 'come va?', '2024-12-06 20:01:00'),
(3, 'mariorossi@gmail.com', 'manuel@outlook.it', 'benvenuto', 'bene', '2024-12-06 20:03:01'),
(4, 'mariorossi@gmail.com', 'manuel@outlook.it', '234253', 'dhfdghfgh', '2024-12-06 20:05:52'),
(5, 'mariorossi@gmail.com', 'manuel@outlook.it', 'ytghgj', 'srtjyrmsdr', '2024-12-06 20:06:18'),
(6, 'mariorossi@gmail.com', 'manuel@outlook.it', 'ytghgj', 'srtjyrmsdr', '2024-12-06 20:07:19'),
(7, 'manuel@outlook.it', 'mariorossi@gmail.com', 'rfgjgfjfgj', 'dfhdfhdfhn', '2024-12-06 20:21:48'),
(8, 'manuel@outlook.it', 'mariorossi@gmail.com', 'sdgsdg', 'dsgsdg', '2024-12-06 20:47:30'),
(9, 'manuel@outlook.it', 'mariorossi@gmail.com', 'sdgsdg', 'dsgsdg', '2024-12-06 20:50:16'),
(10, 'manuel@outlook.it', 'mariorossi@gmail.com', 'dsgfdg', 'dfgdfg', '2024-12-06 20:50:25'),
(11, 'manuel@outlook.it', 'mariorossi@gmail.com', 'dsgfdg', 'dfgdfg', '2024-12-06 20:50:34'),
(12, 'manuel@outlook.it', 'mariorossi@gmail.com', 'dffdhg', 'dfhfdh', '2024-12-06 20:51:46'),
(13, 'manuel@outlook.it', 'manuel@outlook.it', 'dhdfgh', 'dhdfh', '2024-12-06 20:52:40');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `birth_date` date NOT NULL,
  `graduration` int DEFAULT NULL,
  `region` int DEFAULT NULL,
  `province` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `birth_date`, `graduration`, `region`, `province`) VALUES
(1, 'Mario', 'Rossi', 'mariorossi@gmail.com', 'ciaociao01', '2000-11-05', 3, 1, 1),
(2, 'Manuel', 'Brausilenese', 'manuel@outlook.it', 'manuel02', '2005-11-09', NULL, 1, 1),
(3, 'Lola', 'Fara', 'lolafara@gmail.com', 'lolafara', '2004-06-10', 5, 3, 3),
(4, 'Marby', 'Kurakama', 'marbyplay@gmail.com', 'marby123', '2024-12-04', 3, 5, 4),
(5, 'Crazy', 'Hacker', 'crazyhacker@gmail.com', '123123', '2024-12-03', 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
