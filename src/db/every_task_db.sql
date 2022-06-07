-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Jun 2022 um 11:26
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `every_task_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account`
--

CREATE TABLE `account` (
  `pk_account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `account`
--

INSERT INTO `account` (`pk_account_id`, `username`, `password`, `email`, `token`) VALUES
(1, 'admin', '$2y$10$s18Qy/iZQpWhgldcm6JLbetKU9L6UCw5pM1uhYJBPbpqd/IeyrKXG', 'admin@admin.com', 'admin'),
(6, 'Julian', '$2y$10$5ynjP31KhxUK8rX6tyhOEuVaQYB1CeQHQrlfKTjM4sLR93TYm91f.', 'julian@julian.com', 'e05e24f39ce1cef00a205bbb49a2392f'),
(7, 'Toni', '$2y$10$0aDvIhm9z.j3OBh5D9rlIewPUhtA/bSOfM/um32Ec3R3ELcnhgL7C', 'Toni@gmail.com', 'a064e2010d04c416cc3088d0c26350b8'),
(8, 'beni', '$2y$10$LiE.rolBsjWzoycD8ke7a.38mmLjH7TBqAMCnJbCOxODkQVybFu9W', 'beni@gmail.com', '16a445409c1cd037ea5130a4fc5fcba5'),
(11, 'BlaBla', '$2y$10$0NEipScmljbWmhnkGV99yO5rHcAjokZIpKuszi9QqIh58t0mUwBca', 'yes2@gmail.com', '0650488e48f925e3838858f2ed6558e2'),
(13, 'Viktor2', '$2y$10$FYdb6lc6bEMa6QuEa/1GAeeTqJ8F/4xYeKGUF9brQm4XtLjOoiRxq', 'fahdfaf@gmail.com', '6168c66bb64ee98f4c224a70f703747b'),
(14, 'Hugo', '$2y$10$rfiXNJZs14G/gmN9ZeS9.eY3jnoiM7T4ieDGg3aVFqNVneYbSA1/a', 'yes@gmail.com', '3f632f0cb731f3e4b425111bb3400b83'),
(15, 'Dariusch', '$2y$10$O2yGv.DjcCpNp8Pl8NJ2G.1og82cVM4ukQq7/9k9rowSegsnvNOFy', 'dariusch@gmail.com', 'd460fd2b5bf24a8d60fc27a435646511'),
(16, 'ABC', '$2y$10$dfHPD/Fdkcj.N14elTlaPugpDBXA/s604WaRAH28OVWXoOnUDXMvW', 'yes4@gmail.com', 'aa090873536498e08fd7b74871f20983');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_group`
--

CREATE TABLE `account_group` (
  `pk_fk_group_id` int(11) NOT NULL,
  `pk_fk_account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `account_group`
--

INSERT INTO `account_group` (`pk_fk_group_id`, `pk_fk_account_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `group`
--

CREATE TABLE `group` (
  `pk_group_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `group`
--

INSERT INTO `group` (`pk_group_id`, `name`, `icon`, `description`) VALUES
(1, 'admin group', '-icon data-', 'description test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `task`
--

CREATE TABLE `task` (
  `pk_task_id` int(11) NOT NULL,
  `fk_pk_account_id` int(11) NOT NULL,
  `fk_pk_group_id` int(11) NOT NULL,
  `fk_pk_cheftask_id` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `done` tinyint(1) NOT NULL,
  `due_time` datetime NOT NULL,
  `create_time` datetime NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `task`
--

INSERT INTO `task` (`pk_task_id`, `fk_pk_account_id`, `fk_pk_group_id`, `fk_pk_cheftask_id`, `title`, `description`, `done`, `due_time`, `create_time`, `note`) VALUES
(49, 1, 1, NULL, 'WEBT', 'AAAAAAAAaaaaaaaaaaaaaaaaaaaaaaaa', 0, '2022-07-23 12:00:00', '2022-05-31 13:01:04', 'AAAAAAAAAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(50, 1, 1, NULL, 'Todo', 'AAAAAAAA', 0, '2022-07-22 12:00:00', '2022-05-31 13:03:47', 'AAAAAAAAA'),
(52, 1, 1, NULL, 'BlaBla', 'AAAAAAAA', 0, '2022-07-22 12:00:00', '2022-06-07 11:17:47', 'AAAAAAAAAaaaaaaa'),
(53, 1, 1, NULL, 'BlaBla', 'AAAAAAAA', 0, '2022-07-22 12:00:00', '2022-06-07 11:20:17', 'AAAAAAAAAaaaaaaa');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`pk_account_id`);

--
-- Indizes für die Tabelle `account_group`
--
ALTER TABLE `account_group`
  ADD PRIMARY KEY (`pk_fk_account_id`,`pk_fk_group_id`),
  ADD KEY `group__account_group` (`pk_fk_group_id`);

--
-- Indizes für die Tabelle `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`pk_group_id`);

--
-- Indizes für die Tabelle `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`pk_task_id`),
  ADD KEY `task_account` (`fk_pk_account_id`),
  ADD KEY `task_group` (`fk_pk_group_id`),
  ADD KEY `chef_task` (`fk_pk_cheftask_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `account`
--
ALTER TABLE `account`
  MODIFY `pk_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `group`
--
ALTER TABLE `group`
  MODIFY `pk_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `task`
--
ALTER TABLE `task`
  MODIFY `pk_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `account_group`
--
ALTER TABLE `account_group`
  ADD CONSTRAINT `account__account_group` FOREIGN KEY (`pk_fk_account_id`) REFERENCES `account` (`pk_account_id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `group__account_group` FOREIGN KEY (`pk_fk_group_id`) REFERENCES `group` (`pk_group_id`) ON DELETE NO ACTION;

--
-- Constraints der Tabelle `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `chef_task` FOREIGN KEY (`fk_pk_cheftask_id`) REFERENCES `task` (`pk_task_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `task_account` FOREIGN KEY (`fk_pk_account_id`) REFERENCES `account` (`pk_account_id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `task_group` FOREIGN KEY (`fk_pk_group_id`) REFERENCES `group` (`pk_group_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
