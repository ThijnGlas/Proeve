-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 30 mei 2024 om 13:50
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
(1, 0, 0, 0, 1, 0, 3),
(17, 0, 0, 0, 0, 0, 83),
(18, 0, 1, 1, 1, 1, 84);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `borrow`
--

INSERT INTO `borrow` (`id`, `name`, `schoolnumber`, `products`, `date_requested`, `date_borrowed`, `date_tobereturned`, `date_returned`, `accepted`, `declined`) VALUES
(5, '2', 2, '{"1":{"item_id":"9","item_name":"Resistor","item_price":null,"item_quantity":"1"},"2":{"item_id":"11","item_name":"USB cable","item_price":null,"item_quantity":"1"}}', '2014-05-24', '0000-00-00', '2024-05-09', '0000-00-00', 0, 0),
(6, '2', 2, '[{"item_id":"11","item_name":"USB cable","item_price":null,"item_quantity":"1"},{"item_id":"9","item_name":"Resistor","item_price":null,"item_quantity":"1"}]', '2014-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(7, '2', 2, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_price":null,"item_quantity":"1"},{"item_id":"9","item_name":"Resistor","item_price":null,"item_quantity":"1"}]', '2015-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(13, '2', 2, '[{"item_id":"12","item_name":"NodeMCU","item_quantity":"1"},{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2015-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(14, '2', 2, '[{"item_id":"12","item_name":"NodeMCU","item_quantity":"1"},{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2015-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(15, 'poep', 36009, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":0}]', '2015-05-24', '0000-00-00', '2024-05-31', '2024-05-27', 1, 0),
(16, 'dwawad', 2, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2016-05-24', '0000-00-00', '2024-05-24', '2024-05-27', 0, 1),
(17, 'test', 13, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2024-05-16', '0000-00-00', '2024-05-17', '0000-00-00', 0, 1),
(18, 'thijn', 30639, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"},{"item_id":"9","item_name":"Resistor","item_quantity":"1"}]', '2024-05-23', '0000-00-00', '2024-05-31', '2024-05-27', 1, 0),
(19, 'thijn', 30639, '[{"item_id":"8","item_name":"Resistor","item_quantity":1},{"item_id":"9","item_name":"Resistor","item_quantity":0}]', '2024-05-23', '0000-00-00', '2024-05-30', '2024-05-27', 1, 0),
(20, 'thijn1', 30639, '[{"item_id":"12","item_name":"NodeMCU","item_quantity":"1"},{"item_id":"11","item_name":"USB cable","item_quantity":"1"},{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":"1"}]', '2024-05-23', '0000-00-00', '0000-00-00', '0000-00-00', 0, 1),
(21, 'sarah', 30639, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2024-05-24', '0000-00-00', '2024-06-24', '2024-05-27', 1, 0),
(22, 'test ', 3232, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"}]', '2024-05-24', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(23, 'test69', 30639, '[]', '2024-05-27', '0000-00-00', '2024-06-03', '2024-05-27', 1, 0),
(24, 'test', 30639, '[{"item_id":"11","item_name":"USB cable","item_quantity":2}]', '2024-05-27', '0000-00-00', '2024-05-31', '2024-05-27', 1, 0),
(25, 'thijn test', 30639, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":2},{"item_id":"9","item_name":"Resistor","item_quantity":0},{"item_id":"11","item_name":"USB cable","item_quantity":1}]', '2024-05-27', '0000-00-00', '2024-05-29', '2024-05-27', 1, 0),
(26, 'testen', 1, '[{"item_id":"11","item_name":"USB cable","item_quantity":1},{"item_id":"9","item_name":"Resistor","item_quantity":1}]', '2024-05-27', '0000-00-00', '2024-05-25', '2024-05-27', 1, 0),
(27, 'Thijn glas', 30639, '[{"item_id":"11","item_name":"USB cable","item_quantity":"2"},{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":3},{"item_id":"9","item_name":"Resistor","item_quantity":"1"}]', '2024-05-28', '0000-00-00', '2024-06-04', '2024-05-28', 1, 0),
(28, 'poep', 69, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":"1"}]', '2024-05-28', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(29, 'test', 2, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":"1"}]', '2024-05-28', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(30, 'ww', 2, '[{"item_id":"11","item_name":"USB cable","item_quantity":"1"},{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":"1"}]', '2024-05-28', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(31, 'w', 2, '[{"item_id":"10","item_name":"Temperature & Humidity sensor","item_quantity":"1"}]', '2024-05-28', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0),
(32, 'Finn mulder', 32256, '[{"item_id":"19","item_name":"schoenen","item_quantity":2},{"item_id":"8","item_name":"Resistor","item_quantity":1}]', '2024-05-28', '0000-00-00', '2024-05-29', '2024-05-28', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(5) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'alles', 'dit zijn alle producten\n'),
(2, 'Electronica', 'dit is alle electrionica'),
(3, 'overige', 'overige\r\n'),
(4, 'hardware', ''),
(5, 'Arduino', ''),
(6, 'Microbit', ''),
(7, 'Input', ''),
(8, 'Sensors', ''),
(9, 'Display', ''),
(10, 'LED', ''),
(11, 'Sound', ''),
(12, 'Motors', ''),
(13, 'Bluetooth', ''),
(14, 'RF Communication', ''),
(15, 'IR Communication', ''),
(16, 'Logic Gates', ''),
(17, 'Bit Counters', ''),
(18, 'Shift Registors', ''),
(19, 'Multiplexers', ''),
(20, 'Comparators', ''),
(21, 'EEPROM''S', ''),
(22, 'Other IC''S', ''),
(23, 'Header Pins', ''),
(24, 'IC Sockets', ''),
(25, 'ESD foam', ''),
(26, 'Resistors', ''),
(27, 'Mosfets', ''),
(28, 'Breadboards', ''),
(29, 'Cables', ''),
(30, 'Tools', ''),
(31, 'Management', ''),
(32, 'Soldering', '');

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
  `img` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `model_type`, `amount`, `max_amount`, `category`, `description`, `img`) VALUES
(8, 1, 'Resistor', '10.000 / 10K Ohm', 300, 5, 2, 'Most commonly used for sensors & buttons', '8_image1.png'),
(9, 1, 'Resistor', '150 Ohm', 500, 25, 3, 'Most common resistor for LED''s', '9_Rectangle1.png'),
(10, 1, 'Temperature & Humidity sensor', 'DHT11', 60, 1, 2, 'Temperature & Humidity sensor. Can only be read once every 2-5 seconds. On signal/data pin use 10k resistor to 3.3V or 5V', '10_image2.png'),
(11, 1, 'USB cable', 'USB Type B naar MicroUSB', 25, 1, 3, 'Cables for MicroBit & NodeMCU', '11_image3.png'),
(20, 13, 'Arduino Uno Rev3', 'Arduino', 80, 4, 5, '', '20_Arduino_Uno.jpg'),
(21, 13, 'Pro Micro 5v 16Mhz', 'PROMICRO5V16M', 10, 1, 5, '', '21_Pro_Micro.jpg'),
(23, 13, 'NodeMCU ESP8266', 'ESP8266', 11, 1, 5, '', '23_NodeMCU.jpg'),
(24, 13, 'Microbit', 'BBC', 0, 0, 6, '', '24_microbit.png'),
(25, 13, 'MOVE:Motor', 'Kitronik', 0, 0, 6, '', '25_MOVE.jpg'),
(26, 13, 'Pen houder', ' ', 2, 0, 6, '', '26_penhouder.jpg'),
(27, 13, 'Rotation angle decoder', 'SE055', 5, 1, 7, '', '27_rotation_angle.jpg'),
(28, 13, 'Button', ' ', 138, 5, 7, '', '28_button.jpg'),
(29, 13, 'Potmeter 10K', ' ', 29, 2, 7, '', '29_potmeter10k.jpg'),
(30, 13, 'Potmeter slide knop', '', 25, 2, 7, '', '30_potmeterknop.jpg'),
(31, 13, 'Moisture sensor', 'SE045', 8, 1, 8, '', '31_Moisturesensor.jpg'),
(32, 13, 'Temperature & Pressure sensor', 'BMP280', 10, 1, 8, '', '32_Temperaturepressure.jpg'),
(33, 13, 'Light sensor', 'LM393', 10, 1, 8, '', '33_lightsensor.jpg'),
(34, 13, 'Shock / bumping sensor', 'SE053', 10, 1, 8, '', '34_shockbumper.jpg'),
(35, 13, 'Magnetic field sensor', 'SE022', 20, 1, 8, '', '35_megnetic.jpg'),
(36, 13, 'Finger heartbeat sensor', 'SE022', 2, 1, 8, '', '36_heartbeat.jpg'),
(37, 13, 'Sound sensor', 'LM393', 10, 1, 8, '', '37_soundsensor.jpg'),
(38, 13, 'Gyroscope / accelometer', 'MPU-6050', 8, 1, 8, '', '38_accello.jpg'),
(39, 13, 'RGB sensor', 'APDS-9960', 5, 1, 8, '', '39_rgbsensor.jpg'),
(40, 13, 'Thermometer & Vocht', 'DHT11', 15, 2, 8, '', '40_tempandhumidity.jpg'),
(41, 13, 'Time of Flight sensor', 'VL53L1X', 15, 1, 8, '', '41_timeofflight.jpg'),
(42, 13, 'Ultrasonic sensor', 'HY-SRF05', 21, 1, 8, '', '42_ultrasonic.jpg'),
(43, 13, 'Gas sensor Methanol / Alcohol ', 'MQ-3', 5, 1, 8, '', '43_gassensormethanol.jpg'),
(44, 13, 'Gas sensor CO / koolmonoxide', 'MQ-7', 3, 1, 8, '', '44_gaskoolstof.jpg'),
(45, 13, 'Gas sensor Waterstof', 'MQ-8', 3, 1, 8, '', '45_gaswaterstof.jpg'),
(46, 13, '128x64 OLED display', ' ', 3, 1, 9, '', '46_oled.jpg'),
(47, 13, 'RGB LED common cathode ', ' ', 75, 5, 10, '', '47_ledcathode.jpg'),
(48, 13, 'LED mixed', ' ', 3000, 20, 10, '', '48_ledmixed.jpg'),
(49, 13, 'Buzzer', ' ', 50, 2, 11, '', '49_buzzer.jpg'),
(50, 13, 'Speaker', ' ', 40, 2, 11, '', '50_speaker.jpg'),
(51, 13, 'Generic car & robit motor', '  ', 30, 4, 12, '', '51_genericmotor.jpg'),
(52, 13, 'Servo 180 deg', 'SG90', 35, 5, 12, '', '52_servo180.jpg'),
(53, 13, 'Bluetooth module', 'HC-05', 5, 1, 13, '', '53_bluetooth05.jpg'),
(54, 13, 'Bluetooth module', 'HC-06', 19, 1, 13, '', '54_bluetooth06.jpg'),
(55, 13, 'RF set''s & r 433Mhz', ' ', 40, 2, 14, '', '55_RFset.jpg'),
(56, 13, 'IR receiver', 'TSOP4833', 19, 1, 15, '', '56_IFreciever.jpg'),
(57, 13, 'IR led', 'TSAL7400', 28, 4, 15, '', '57_IRLED.jpg'),
(58, 13, 'Wire cutter', ' ', 1, 1, 30, '', '58_wirecutter.jpg'),
(59, 13, 'IC grabber', ' ', 2, 1, 30, '', '59_icgrabber.jpg'),
(60, 13, 'Anti-static tweezer', ' ', 6, 1, 30, '', '60_antitweezer.jpg'),
(61, 13, 'Anti-static bracelet', ' ', 1, 1, 30, '', '61_antibracelet.jpg'),
(62, 13, 'Cable stripper', 'ALTQ-KA-120', 1, 1, 30, '', '62_cablestripper.jpg'),
(63, 13, 'Cutter mat 60x90cm', ' ', 1, 1, 30, '', '63_imagemat.png'),
(64, 13, 'Tool set, screwdrivers & more ', 'HBM', 1, 1, 4, '', '64_toolset.jpg'),
(66, 13, 'Label maker', 'Dymo Omega', 1, 1, 31, '', '66_lablemaker.jpg'),
(67, 13, 'Label white on black ', 'S0898130', 6, 1, 31, '', '67_lable.jpg'),
(68, 13, 'Soldering station', 'ZD-929C 48Watt', 1, 1, 32, '', '68_soldeerbout.jpg'),
(69, 13, 'Soldering tin', ' ', 2, 1, 32, '', '69_soldertin.jpg'),
(70, 13, 'Soldering hand ', ' ', 1, 1, 32, '', '70_solderinghand.jpg'),
(71, 13, 'Weerstand 150 Ohm', ' ', 100, 10, 26, '', '71_330x230.jpg'),
(72, 13, 'Weerstand 220 Ohm', ' ', 500, 20, 26, '', '72_330x230.jpg'),
(73, 13, 'Weerstand 300+ Ohm', ' ', 500, 20, 26, '', '73_330x230.jpg'),
(74, 13, 'Weerstand 10 Ohm', '  ', 200, 20, 26, '', '74_10ohm.jpg'),
(75, 13, 'Weerstand 100 Ohm', ' ', 200, 20, 26, '', '75_100ohm.jpg'),
(76, 13, 'Weerstand 1k Ohm', ' ', 200, 20, 26, '', '76_1kx10k.jpg'),
(77, 13, 'Weerstand 10k Ohm', ' ', 200, 20, 26, '', '77_1kx10k.jpg'),
(78, 13, 'Mosfet N-channel', ' ', 60, 5, 27, '', '78_mosfet.jpg'),
(79, 13, 'Breadboard 830', 'MB102', 50, 5, 28, '', '79_bread.jpg'),
(80, 13, '9x10m 0.2mm hard', ' ', 7, 2, 29, '', '80_9x.jpg'),
(81, 13, 'Jumper kabels M-M F-M F-F', 'Dupont', 240, 20, 29, '', '81_jumper.jpg'),
(82, 13, 'Jumper kabels M-M', 'Dupont', 200, 20, 29, '', '82_jumper.jpg'),
(83, 13, 'Jumper kabels M-M 10cm', 'Dupont', 1600, 20, 29, '', '83_10cm.jpg'),
(84, 13, 'Jumper kabels M-M 20cm', 'Dupont', 80, 20, 29, '', '84_jumpercable.jpg'),
(85, 13, 'Jumper kabels M-F 20cm', 'Dupont', 80, 20, 29, '', '85_jumpercable.jpg'),
(86, 13, 'Jumper kabels F-F 20cm', 'Dupont', 80, 20, 29, '', '86_jumpercable.jpg'),
(87, 13, 'USB-B naar USB-A', ' ', 105, 2, 29, '', '87_usbb.jpg'),
(88, 13, 'USB - Micro USB', ' ', 25, 2, 29, '', '88_Micro_usb_cable-600x600w.png'),
(89, 13, 'NAND-gate (4 fold)', 'SN74HCT00N', 50, 5, 16, '', '89_SN74HCT08.jpg'),
(90, 13, 'NOR-gate (4 fold)', 'SN74HCT04N', 50, 5, 16, '', '90_SN74HCT08.jpg'),
(91, 13, 'Hex Inverter (6 fold NOT-gate)', 'SN74HCT04N', 50, 5, 16, '', '91_SN74HCT08.jpg'),
(92, 13, 'AND-gate (8 fold)', 'SN74HCT08', 50, 5, 16, '', '92_SN74HCT08.jpg'),
(93, 13, 'XOR-gate (4 fold)', 'SN74LS86AN', 50, 5, 16, '', '93_SN74HCT08.jpg'),
(94, 13, 'OR-gate (4 fold)', 'SN74HCT32N', 50, 5, 16, '', '94_SN74HCT08.jpg'),
(95, 13, 'XNOR-gate (4 fold)', 'HCF4077B', 50, 5, 16, '', '95_SN74HCT08.jpg'),
(96, 13, '4-bit counter', 'CD74HC4017E', 50, 5, 17, '', '96_S8.jpg'),
(97, 13, '12-bit counter (async)', 'CD4040BE', 10, 2, 17, '', '97_DIL-16.jpg'),
(98, 13, '8-bit shift registor', 'SN74HC595N', 50, 5, 18, '', '98_DIL-16.jpg'),
(99, 13, '4-channel multiplexer', 'SN74HC153N', 20, 4, 19, '', '99_DIL-16.jpg'),
(100, 13, '8-channel multiplexer', 'SN74HC151N', 20, 4, 19, '', '100_S8.jpg'),
(101, 13, '8-bit comparator', 'CD74HCT688E', 5, 1, 2, '', '101_DIL-20.jpg'),
(102, 13, '1Kb Serial EEPROM', '24LC01B-I/P', 50, 5, 21, '', '102_DIP-8-2.jpg'),
(103, 13, '2Kb Serial EEPROM', '24LC02B-I/P', 50, 5, 21, '', '103_DIP-8-2.jpg'),
(104, 13, 'TLC 555 Timer', 'TLC555CP', 10, 2, 22, '', '104_555.jpg'),
(105, 13, 'Real time clock module', 'AT24C32 I2C', 8, 2, 22, '', '105_realtime.jpg'),
(106, 13, '16-bit I/O Expander', 'MCP23017', 1, 1, 22, '', '106_16bit.jpg'),
(107, 13, '1x3 pins', ' ', 20, 2, 23, '', '107_pin3.jpg'),
(108, 13, '1x4 pins', ' ', 20, 2, 23, '', '108_pin4.jpg'),
(109, 13, '1x5 pins', ' ', 20, 20, 23, '', '109_pin5.jpg'),
(110, 13, '1x6 pins', ' ', 20, 2, 23, '', '110_pin6.jpg'),
(111, 13, '1x8 pins', '  ', 26, 2, 23, '', '111_pin8.jpg'),
(112, 13, '2x4 pins', ' ', 20, 2, 24, '', '112_2x4.jpg'),
(113, 13, '2x7 pins', ' ', 20, 2, 24, '', '113_2x7.jpg'),
(114, 13, '2x8 pins', ' ', 20, 2, 24, '', '114_2x8.jpg'),
(115, 13, '2x9 pins', ' ', 16, 2, 22, '', '115_2x9.jpg'),
(116, 13, '2x10 pins', ' ', 19, 2, 24, '', '116_2x10.jpg'),
(117, 13, 'ESD Anti-static foam 305x305x6', ' ', 15, 2, 25, '', '117_image.png'),
(118, 13, 'Potmeter knop', ' ', 50, 4, 7, '', '118_potmeterknop.jpg'),
(119, 13, 'Potmeter slide 10k', ' ', 20, 4, 7, '', '119_potmeterslide10k.jpg'),
(120, 13, 'Anti-static brush', ' ', 1, 1, 30, '', '120_antibrush.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `voornaam`, `achternaam`, `email`, `role_id`, `ipv4`, `ipv6`, `attempts`, `lastlogin`, `locked`, `session`, `lastactivity`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Thijn', 'Glas', 'thijnglas@gmail.com', 5, '127.0.0.1', '', 0, '2023-04-11 16:57:02', 0, 'C1nHoOAOyh', '2023-04-11 16:57:02'),
(11, 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'test', 'tset', 'test@test.nl', 2, '', '', 0, '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00'),
(13, 'max', '9baf3a40312f39849f46dad1040f2f039f1cffa1238c41e9db675315cfad39b6', 'max', 'max', 'poep@dada.nl', 0, '145.102.244.61', '', 0, '0000-00-00 00:00:00', 0, 'oKUi8KW8EQ', '0000-00-00 00:00:00');

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
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `availabilities`
--
ALTER TABLE `availabilities`
  ADD CONSTRAINT `availabilities_ibfk_1` FOREIGN KEY (`Fk_beheerder_Id`) REFERENCES `beheerder` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
