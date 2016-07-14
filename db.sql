-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 14. Jul 2016 um 16:26
-- Server Version: 5.5.49-0+deb8u1
-- PHP-Version: 7.0.8-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `jukusoftsql1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pscf_domain`
--

CREATE TABLE IF NOT EXISTS `pscf_domain` (
`id` int(10) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `alias` int(10) NOT NULL DEFAULT '-1',
  `home_page` varchar(255) NOT NULL DEFAULT 'home',
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activated` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `pscf_domain`
--

INSERT INTO `pscf_domain` (`id`, `domain`, `alias`, `home_page`, `lastUpdate`, `activated`) VALUES
(1, 'jukusoft.com', -1, 'home', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pscf_events`
--

CREATE TABLE IF NOT EXISTS `pscf_events` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('FILE','FUNCTION','CLASS_STATIC_METHOD','') NOT NULL,
  `file` varchar(600) DEFAULT NULL,
  `class_name` varchar(255) NOT NULL DEFAULT '',
  `class_method` varchar(255) NOT NULL DEFAULT '',
  `created_from` varchar(255) NOT NULL,
  `activated` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `pscf_domain`
--
ALTER TABLE `pscf_domain`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `domain` (`domain`), ADD KEY `alias` (`alias`);

--
-- Indizes für die Tabelle `pscf_events`
--
ALTER TABLE `pscf_events`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQUE_EVENTS` (`name`,`file`,`class_name`,`class_method`), ADD KEY `name` (`name`,`activated`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `pscf_domain`
--
ALTER TABLE `pscf_domain`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `pscf_events`
--
ALTER TABLE `pscf_events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
