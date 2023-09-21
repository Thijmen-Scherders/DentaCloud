-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 sep 2023 om 14:57
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.0.28

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `appointments`
--

INSERT INTO `appointments` (`Id`, `userId`, `date`, `time`, `serviceId`) VALUES
(1, 1, '2023-09-25', '15:00:00', 3),
(34, 32, '2023-09-21', '10:59:00', 3),
(35, 33, '2023-09-29', '15:18:00', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE `logs` (
  `Id` int(11) NOT NULL,
  `message` text NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `services`
--

CREATE TABLE `services` (
  `Id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `services`
--

INSERT INTO `services` (`Id`, `name`) VALUES
(1, 'Controle'),
(2, 'Reiniging'),
(3, 'Noodingreep'),
(4, 'vullen'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `phoneNumber`, `email`, `ipAdress`) VALUES
(1, 'Mark', 'Prins', 423424255, 'mark.prins@ziggo.nl', 42423),
(32, 'thijmen', 'Scherders', 614785236, 'tscherders@kpnmail.nl', 0),
(33, 'thijmen', 'Scherders', 614785236, 'tscherders@kpnmail.nl', 0);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `services`
--
ALTER TABLE `services`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
