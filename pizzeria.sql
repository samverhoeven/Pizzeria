-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 09 sep 2015 om 09:15
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `pizza2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE IF NOT EXISTS `bestellingen` (
`id` int(11) NOT NULL,
  `klantid` int(11) NOT NULL,
  `prijs` double NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `klantid`, `prijs`, `datum`) VALUES
(1, 1, 36, '2015-09-04 17:03:13'),
(2, 1, 9, '2015-09-04 17:08:29'),
(3, 1, 25, '2015-09-04 17:10:07'),
(4, 1, 17, '2015-09-07 14:31:17'),
(5, 1, 30.5, '2015-09-08 10:33:45'),
(6, 3, 16.5, '2015-09-08 10:38:20'),
(7, 1, 31, '2015-09-08 13:50:37'),
(8, 2, 35, '2015-09-08 13:51:27'),
(9, 1, 30.5, '2015-09-08 15:42:53'),
(10, 1, 23, '2015-09-09 08:40:15'),
(11, 2, 26, '2015-09-09 08:41:50'),
(12, 4, 18, '2015-09-09 08:44:01'),
(13, 4, 17.5, '2015-09-09 09:02:30'),
(14, 1, 22.5, '2015-09-09 09:03:21'),
(15, 1, 22.5, '2015-09-09 09:04:10');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestreg`
--

CREATE TABLE IF NOT EXISTS `bestreg` (
`id` int(11) NOT NULL,
  `bestelid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `prijs` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestreg`
--

INSERT INTO `bestreg` (`id`, `bestelid`, `productid`, `prijs`) VALUES
(1, 1, 1, 8),
(2, 1, 2, 9),
(3, 1, 3, 9.5),
(4, 1, 3, 9.5),
(5, 2, 2, 9),
(6, 3, 2, 9),
(7, 3, 1, 8),
(8, 3, 1, 8),
(9, 4, 2, 9),
(10, 4, 1, 8),
(11, 5, 1, 8),
(12, 5, 2, 9),
(13, 5, 4, 9),
(14, 5, 6, 8.5),
(15, 6, 1, 8),
(16, 6, 6, 8.5),
(17, 7, 4, 8),
(18, 7, 4, 8),
(19, 7, 2, 8),
(20, 7, 1, 7),
(21, 8, 4, 9),
(22, 8, 4, 9),
(23, 8, 2, 9),
(24, 8, 1, 8),
(25, 9, 1, 7),
(26, 9, 6, 7.5),
(27, 9, 2, 8),
(28, 9, 4, 8),
(29, 10, 1, 7),
(30, 10, 2, 8),
(31, 10, 4, 8),
(32, 11, 1, 8),
(33, 11, 2, 9),
(34, 11, 4, 9),
(35, 12, 4, 9),
(36, 12, 2, 9),
(37, 13, 4, 9),
(38, 13, 6, 8.5),
(39, 14, 6, 7.5),
(40, 14, 2, 8),
(41, 14, 1, 7),
(42, 15, 6, 7.5),
(43, 15, 1, 7),
(44, 15, 2, 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE IF NOT EXISTS `klanten` (
`id` int(11) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `voornaam` varchar(20) NOT NULL,
  `straat` varchar(50) NOT NULL,
  `huisnummer` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `telefoon` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `wachtwoord` varchar(50) NOT NULL,
  `bemerking` varchar(200) NOT NULL,
  `promotie` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`id`, `naam`, `voornaam`, `straat`, `huisnummer`, `postcode`, `woonplaats`, `telefoon`, `email`, `wachtwoord`, `bemerking`, `promotie`) VALUES
(1, 'Verhoeven', 'Sam', 'Samstraat', 10, 2610, 'Wilrijk', 412345678, 'sam@sam.com', 'f16bed56189e249fe4ca8ed10a1ecae60e8ceac0', '', 1),
(2, 'Jossens', 'Jos', 'Josstraat', 15, 2018, 'Antwerpen', 487654321, 'jos@jos.com', '30446d562301c34308155183a2f0ff23652fa4d7', '', 0),
(3, 'Jefferson', 'Jef', 'Jefstraat', 30, 2650, 'Edegem', 458963258, 'jef@jef.com', 'b15fddc167525de4ad1fb3bc376a47e585fa0068', '', 0),
(4, 'Tomsen', 'Tom', 'Tomstraat', 36, 2640, 'Mortsel', 412875963, 'tom@tom.com', '96835dd8bfa718bd6447ccc87af89ae1675daeca', '', 0),
(5, 'Kimsen', 'Kim', 'Kimstraat', 89, 1000, 'Brussel', 485789635, 'kim@kim.com', 'a6312121e15caec74845b7ba5af23330d52d4ac0', '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE IF NOT EXISTS `producten` (
`id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `prijs` double NOT NULL,
  `samenstelling` varchar(200) NOT NULL,
  `beschikbaarheid` int(11) NOT NULL,
  `promotie` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`id`, `naam`, `prijs`, `samenstelling`, `beschikbaarheid`, `promotie`) VALUES
(1, 'Pizza margherita', 8, 'mozzarella, tomaten', 1, 7),
(2, 'Pizza funghi', 9, 'mozzarella, tomaten, champignons', 1, 8),
(3, 'Pizza salami', 9.5, 'mozzarella, tomaten, salami', 0, 8.5),
(4, 'Pizza Hawaii', 9, 'mozzarella, tomaten, ham, ananas', 1, 8),
(5, 'Pizza frutti di mare', 11, 'mozzarella, tomaten, garnalen, mosselen, tonijn', 0, 10),
(6, 'Pizza vegetariana', 8.5, 'mozzarella, tomaten, aubergine, paprika, spinazie', 1, 7.5);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bestreg`
--
ALTER TABLE `bestreg`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `bestreg`
--
ALTER TABLE `bestreg`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
