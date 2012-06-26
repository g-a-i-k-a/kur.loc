-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 26 2012 г., 23:48
-- Версия сервера: 5.1.51
-- Версия PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `place_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `hashcode` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_event_place` (`place_id`),
  KEY `fk_event_type1` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `date`, `name`, `description`, `place_id`, `type_id`, `hashcode`) VALUES
(1, '2012-06-29 00:00:00', 'Фактографический синхронический подход глазами современников', 'Возвышенное параллельно. Коллективное бессознательное, в том числе, иллюстрирует глубокий стиль, подобный исследовательский подход к проблемам художественной типологии можно обнаружить у К.Фосслера. Действительно, воображение сложно. Снижение готично заканчивает сокращенный горизонт ожидания, таким образом, все перечисленные признаки архетипа и мифа подтверждают, что действие механизмов мифотворчества сродни механизмам художественно-продуктивного мышления. Онтологический статус искусства заканчивает неизменный импрессионизм, что-то подобное можно встретить в работах Ауэрбаха и Тандлера. Флобер, описывая нервный припадок Эммы Бовари, переживает его сам: художественное опосредование просветляет бессознательный художественный талант, так Г.Корф формулирует собственную антитезу.', 1, 1, ''),
(2, '2012-06-13 01:43:38', 'Фактографический хорал: предпосылки и развитие', 'Его экзистенциальная тоска выступает как побудительный мотив творчества, однако лабораторность художественной культуры дает героический миф, что-то подобное можно встретить в работах Ауэрбаха и Тандлера. Иными словами, коллективное бессознательное потенциально. Синхронический подход начинает маньеризм, что-то подобное можно встретить в работах Ауэрбаха и Тандлера. Беспристрастный анализ любого творческого акта показывает, что гармония аккумулирует персональный хтонический миф, что-то подобное можно встретить в работах Ауэрбаха и Тандлера. Мистерия монотонно заканчивает художественный талант, однако само по себе состояние игры всегда амбивалентно.', 2, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` varchar(45) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `message`
--


-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ticket` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `order`
--


-- --------------------------------------------------------

--
-- Структура таблицы `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `place`
--

INSERT INTO `place` (`id`, `name`, `address`) VALUES
(1, 'testplace1', 'testaddressplace1'),
(2, 'testplace2', 'testaddressplace2');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector` varchar(255) DEFAULT NULL,
  `row` int(11) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `ticket`
--

INSERT INTO `ticket` (`id`, `sector`, `row`, `seat`, `price`, `status`, `event_id`) VALUES
(1, 'Партер', 1, 1, 10000, 0, 1),
(2, 'Партер', 1, 2, 9999, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Концерт'),
(2, 'Киносеансы'),
(3, 'Выставки');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `fio` text,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role`, `fio`, `address`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admina', 'Oracle Technology Network is the ultimate, complete, and authoritative source of technical information and learning about Java.\r\n\r\nOracle Technology Network is the ultimate, complete, and authoritative source of technical information and learning about Java.\r\n\r\nOracle Technology Network is the ultimate, complete, and authoritative source of technical information and learning about Java.\r\n\r\nOracle Technology Network is the ultimate, complete, and authoritative source of technical information and learning about Java.'),
(6, 'w', 'f1290186a5d0b1ceab27f4e77c0c5d68', 0, 'w', 'w'),
(16, 'e', 'e1671797c52e15f763380b45e841ec32', NULL, 'e', 'e'),
(17, 'q', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 'q', 'q'),
(18, 'r', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 'r', 'r'),
(19, 't', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 't', 't'),
(20, 'u', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 'u', 'u'),
(21, 'y', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 't', 't');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_place0` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_event_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user10` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
