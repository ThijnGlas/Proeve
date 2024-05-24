-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 24 mei 2024 om 16:28
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
-- Tabelstructuur voor tabel `availabilities`
--

CREATE TABLE IF NOT EXISTS `availabilities` (
  `id` int(20) NOT NULL,
  `Monday` tinyint(1) NOT NULL,
  `Tuesday` tinyint(1) NOT NULL,
  `Wednesday` tinyint(1) NOT NULL,
  `Thursday` tinyint(1) NOT NULL,
  `Friday` tinyint(1) NOT NULL,
  `Fk_beheerder_Id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `availabilities`
--

INSERT INTO `availabilities` (`id`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Fk_beheerder_Id`) VALUES
(1, 0, 0, 0, 0, 0, 3),
(17, 1, 1, 1, 1, 1, 83),
(18, 1, 1, 1, 1, 1, 84);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `beheerder`
--

CREATE TABLE IF NOT EXISTS `beheerder` (
  `id` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `beheerder`
--

INSERT INTO `beheerder` (`id`, `Naam`) VALUES
(3, 'Juda'),
(83, 'Silvan'),
(84, 'Iemand');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `id` int(5) NOT NULL,
  `name` varchar(150) NOT NULL,
  `schoolnumber` int(5) NOT NULL,
  `products` varchar(500) NOT NULL,
  `date_requested` date NOT NULL,
  `date_borrowed` date NOT NULL,
  `date_tobereturned` date NOT NULL,
  `date_returned` date NOT NULL,
  `accepted` int(11) NOT NULL,
  `declined` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `borrow`
--

INSERT INTO `borrow` (`id`, `name`, `schoolnumber`, `products`, `date_requested`, `date_borrowed`, `date_tobereturned`, `date_returned`, `accepted`, `declined`) VALUES
(5, '2', 2, '{"1":{"item_id":"9","item_name":"Resistor","item_price":null,"item_quantity":"1"},"2":{"item_id":"11","item_name":"USB cable","item_price":null,"item_quantity":"1"}}', '2014-05-24', '0000-00-00', '2024-05-09', '0000-00-00', 0, 0),
(6, '2', 2, '[{"item_id":"11","item_name":"USB cable","item_price":null,"item_quantity":"1"},{"item_id":"9","item_name":"Resistor","item_price":null,"item_quantity":"1"}]', '2014-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(7, '2', 2, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_price":null,"item_quantity":"1"},{"item_id":"9","item_name":"Resistor","item_price":null,"item_quantity":"1"}]', '2015-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(13, '2', 2, '[{"item_id":"12","item_name":"NodeMCU","item_quantity":"1"},{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2015-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(14, '2', 2, '[{"item_id":"12","item_name":"NodeMCU","item_quantity":"1"},{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2015-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(15, 'poep', 36009, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":"1"}]', '2015-05-24', '0000-00-00', '2024-05-31', '0000-00-00', 1, 0),
(16, 'dwawad', 2, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2016-05-24', '0000-00-00', '2024-05-24', '0000-00-00', 0, 1),
(17, 'test', 13, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2024-05-16', '0000-00-00', '2024-05-17', '0000-00-00', 0, 1),
(18, 'thijn', 30639, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"},{"item_id":"9","item_name":"Resistor","item_quantity":"1"}]', '2024-05-23', '0000-00-00', '2024-05-31', '0000-00-00', 1, 0),
(19, 'thijn', 30639, '[{"item_id":"8","item_name":"Resistor","item_quantity":"1"},{"item_id":"9","item_name":"Resistor","item_quantity":"1"}]', '2024-05-23', '0000-00-00', '2024-05-30', '0000-00-00', 1, 0),
(20, 'thijn1', 30639, '[{"item_id":"12","item_name":"NodeMCU","item_quantity":"1"},{"item_id":"11","item_name":"USB cable","item_quantity":"1"},{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":"1"}]', '2024-05-23', '0000-00-00', '0000-00-00', '0000-00-00', 0, 1),
(21, 'sarah', 30639, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2024-05-24', '0000-00-00', '2024-06-24', '0000-00-00', 1, 0),
(22, 'test ', 3232, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2024-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
  `id` int(20) NOT NULL,
  `subject` text NOT NULL,
  `c1` int(200) NOT NULL,
  `c2` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(20) NOT NULL,
  `name` text NOT NULL,
  `age` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `img` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `model_type`, `amount`, `max_amount`, `category`, `description`, `storage_id`, `img`) VALUES
(8, 1, 'Resistor', '10.000 / 10K Ohm', 300, 5, 0, 'Most commonly used for sensors & buttons', 0, '8_image1.png'),
(9, 1, 'Resistor', '150 Ohm', 500, 25, 0, 'Most common resistor for LED''s', 0, '9_Rectangle1.png'),
(10, 1, 'Temperature & Humidity sensor', 'DHT11', 60, 1, 0, 'Temperature & Humidity sensor. Can only be read once every 2-5 seconds. On signal/data pin use 10k resistor to 3.3V or 5V', 0, '10_image2.png'),
(11, 1, 'USB cable', 'USB Type B naar MicroUSB', 25, 1, 0, 'Cables for MicroBit & NodeMCU', 0, '11_image3.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `voornaam`, `achternaam`, `email`, `role_id`, `ipv4`, `ipv6`, `attempts`, `lastlogin`, `locked`, `session`, `lastactivity`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Thijn', 'Glas', 'thijnglas@gmail.com', 5, '127.0.0.1', '', 0, '2023-04-11 16:57:02', 0, 'WkJy0cX7gN', '2023-04-11 16:57:02'),
(11, 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'test', 'tset', 'test@test.nl', 2, '', '', 0, '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `availabilities`
--
ALTER TABLE `availabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fk_beheerder_Id` (`Fk_beheerder_Id`);

--
-- Indexen voor tabel `beheerder`
--
ALTER TABLE `beheerder`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `degree`
--
ALTER TABLE `degree`
  ADD KEY `id` (`id`);

--
-- Indexen voor tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT voor een tabel `availabilities`
--
ALTER TABLE `availabilities`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT voor een tabel `beheerder`
--
ALTER TABLE `beheerder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT voor een tabel `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT voor een tabel `info`
--
ALTER TABLE `info`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `availabilities`
--
ALTER TABLE `availabilities`
  ADD CONSTRAINT `availabilities_ibfk_1` FOREIGN KEY (`Fk_beheerder_Id`) REFERENCES `beheerder` (`id`);

--
-- Beperkingen voor tabel `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `degree` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
