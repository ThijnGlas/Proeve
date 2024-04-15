-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 15 apr 2024 om 08:15
-- Serverversie: 5.5.68-MariaDB
-- PHP-versie: 5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c5831Leensysteem`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(5) NOT NULL,
  `user_id` int(4) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `model_type` varchar(150) CHARACTER SET utf8 NOT NULL,
  `amount` int(5) NOT NULL,
  `max_amount` int(5) NOT NULL,
  `category` int(1) NOT NULL,
  `description` varchar(200) CHARACTER SET utf8 NOT NULL,
  `storage_id` int(11) NOT NULL,
  `img` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `model_type`, `amount`, `max_amount`, `category`, `description`, `storage_id`, `img`) VALUES
(1, 1, 'test1', 'poep', 13, 0, 0, '', 0, ''),
(2, 1, 'test 2', 'doadwajdowd', 12, 0, 0, 'fiofjef dahdawjdawdc \r\n', 0, ''),
(6, 1, 'feiofhweio', 'wadawdwa', 323, 0, 0, 'wdadsaad', 0, '6_pngtree-no-image-vector-illustration-isolated-pn');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `achternaam` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(1) NOT NULL,
  `ipv4` varchar(15) NOT NULL,
  `ipv6` varchar(64) NOT NULL,
  `attempts` int(1) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `locked` int(1) NOT NULL,
  `session` varchar(10) NOT NULL,
  `lastactivity` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `voornaam`, `achternaam`, `email`, `role_id`, `ipv4`, `ipv6`, `attempts`, `lastlogin`, `locked`, `session`, `lastactivity`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Thijn', 'Glas', 'thijnglas@gmail.com', 5, '127.0.0.1', '', 0, '2023-04-11 16:57:02', 0, 'ln5cUlaFXP', '2023-04-11 16:57:02');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
