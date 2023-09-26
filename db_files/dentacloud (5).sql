-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 sep 2023 om 14:18
-- Serverversie: 10.4.18-MariaDB
-- PHP-versie: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentacloud`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `appointments`
--

CREATE TABLE `appointments` (
  `Id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `serviceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `appointments`
--

INSERT INTO `appointments` (`Id`, `userId`, `date`, `time`, `serviceId`) VALUES
(46, 54, '2023-09-28', '14:36:00', 0),
(47, 55, '0000-00-00', '00:00:00', 0),
(48, 56, '0000-00-00', '00:00:00', 0),
(49, 57, '2023-09-29', '14:43:00', 3),
(50, 58, '2023-09-22', '14:43:00', 3),
(51, 59, '2023-09-29', '10:49:00', 0),
(52, 60, '2023-09-29', '10:49:00', 0),
(54, 62, '2023-09-22', '13:48:00', 2),
(55, 63, '2023-09-22', '13:48:00', 2),
(56, 64, '2023-09-22', '13:48:00', 2),
(57, 65, '2023-09-22', '13:48:00', 2),
(58, 66, '0000-00-00', '00:00:00', 3),
(59, 67, '2023-09-30', '15:57:00', 1),
(60, 68, '2023-09-30', '15:57:00', 1),
(61, 69, '2023-09-29', '19:56:00', 2),
(62, 70, '2023-09-29', '19:56:00', 2),
(63, 71, '0000-00-00', '00:00:00', 0),
(64, 72, '0000-00-00', '00:00:00', 0),
(65, 73, '2023-09-29', '20:03:00', 5),
(66, 74, '0000-00-00', '00:00:00', 1),
(67, 75, '0000-00-00', '00:00:00', 1),
(68, 76, '0000-00-00', '00:00:00', 3),
(69, 77, '0000-00-00', '00:00:00', 3),
(70, 78, '2023-10-06', '21:22:00', 3),
(71, 79, '2023-10-06', '21:22:00', 3),
(72, 80, '0000-00-00', '00:00:00', 3),
(73, 81, '0000-00-00', '00:00:00', 3),
(74, 82, '2023-09-29', '11:30:00', 1),
(75, 83, '2023-09-29', '11:30:00', 1),
(76, 84, '2023-09-29', '11:30:00', 1),
(77, 85, '2023-09-29', '14:29:00', 3),
(78, 86, '0000-00-00', '00:00:00', 0),
(79, 87, '2023-09-28', '15:41:00', 1),
(80, 88, '2023-09-28', '15:41:00', 1),
(81, 89, '0000-00-00', '00:00:00', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE `logs` (
  `Id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ipAddress` text NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `logs`
--

INSERT INTO `logs` (`Id`, `message`, `date`, `ipAddress`, `userId`) VALUES
(26, 'het updateformulier bezocht', '0000-00-00 00:00:00', '::1', NULL),
(78, 'het afsprakenformulier bezocht', '0000-00-00 00:00:00', '::1', NULL),
(79, 'het afsprakenformulier bezocht', '0000-00-00 00:00:00', '::1', NULL),
(80, 'het afsprakenformulier bezocht', '2023-09-26 12:43:34', '::1', NULL),
(81, 'het afsprakenformulier bezocht', '2023-09-26 12:43:35', '::1', NULL),
(82, 'het updateformulier bezocht', '2023-09-26 12:43:38', '::1', NULL),
(83, 'het updateformulier bezocht', '2023-09-26 12:43:39', '::1', NULL),
(84, 'het updateformulier bezocht', '2023-09-26 13:37:55', '::1', NULL),
(85, 'het updateformulier bezocht', '2023-09-26 13:37:57', '::1', NULL),
(86, 'het afsprakenformulier bezocht', '2023-09-26 13:37:58', '::1', NULL),
(87, 'het afsprakenformulier bezocht', '2023-09-26 13:42:04', '::1', NULL),
(88, 'het updateformulier bezocht', '2023-09-26 13:42:06', '::1', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `services`
--

CREATE TABLE `services` (
  `Id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `services`
--

INSERT INTO `services` (`Id`, `name`) VALUES
(1, 'Controle'),
(2, 'Reiniging'),
(3, 'Noodingreep'),
(4, 'Vullen'),
(5, 'Bleken');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `email` text NOT NULL,
  `ipAdress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `phoneNumber`, `email`, `ipAdress`) VALUES
(54, 'rewrwr', 'rwerwrwrwr', 634535543, 'mark.prins@ziggo.nl', 0),
(55, 'rewrwr', 'rwerwrwrwr', 634535543, 'mark.prins@ziggo.nl', 0),
(56, 'rewrwr', 'rwerwrwrwr', 634535543, 'mark.prins@ziggo.nl', 0),
(57, 'Mark', 'Prins', 634535543, 'mark.prins@ziggo.nl', 0),
(58, 'bob', 'rewrwr', 634535543, 'mark.prins@ziggo.nl', 0),
(59, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(60, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(61, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(62, 'Mark', 'prins', 634535542, 'mark.prins@ziggo.nl', 0),
(63, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(64, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(65, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(66, 'naam1', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(67, 'naam1', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(68, 'naam1', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(69, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(70, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(71, '', '', 0, '', 0),
(72, '', '', 0, '', 0),
(73, 'mark', 'prins', 2147483647, 'markprinsnl@gmail.com', 0),
(74, 'Mark', 'prins', 634535543, 'markprinsnl@gmail.com', 0),
(75, 'Mark', 'prins', 634535543, 'markprinsnl@gmail.com', 0),
(76, 'Mark', 'prins', 4234242, 'markprinsnl@gmail.com', 0),
(77, 'Mark', 'prins', 4234242, 'markprinsnl@gmail.com', 0),
(78, 'Mark', 'prins', 634535543, 'markprinsnl@gmail.com', 0),
(79, 'Mark', 'prins', 634535543, 'markprinsnl@gmail.com', 0),
(80, 'Mark', 'prins', 634535543, 'markprinsnl@gmail.com', 0),
(81, 'Mark', 'prins', 634535543, 'markprinsnl@gmail.com', 0),
(82, 'Mark', 'prins', 625393760, 'mark.prins@ziggo.nl', 0),
(83, 'Mark', 'prins', 625393760, 'mark.prins@ziggo.nl', 0),
(84, 'Mark', 'prins', 625393760, 'mark.prins@ziggo.nl', 0),
(85, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(86, 'Mark', '', 634535543, '', 0),
(87, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(88, 'Mark', 'prins', 634535543, 'mark.prins@ziggo.nl', 0),
(89, 'Mark', 'Prins', 634535543, 'mark.prins@ziggo.nl', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Test` (`userId`),
  ADD KEY `serviceId` (`serviceId`) USING BTREE;

--
-- Indexen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`userId`);

--
-- Indexen voor tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `appointments`
--
ALTER TABLE `appointments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT voor een tabel `services`
--
ALTER TABLE `services`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
