-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 06:52 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbims`
--

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `Incident_ID` int(11) NOT NULL,
  `Datum` date DEFAULT NULL,
  `Baliemedewerker` varchar(255) DEFAULT NULL,
  `Behandelaar` varchar(255) DEFAULT NULL,
  `Omschrijving` text,
  `Actie` text,
  `VervolgActie` text,
  `UitgevoerdeWerkzaamheden` text,
  `Afspraken` text,
  `SluitDatum` date DEFAULT NULL,
  `IncidentGesloten` bit(1) DEFAULT NULL,
  `Klant_ID` int(11) NOT NULL,
  `SoortIncident_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`Incident_ID`, `Datum`, `Baliemedewerker`, `Behandelaar`, `Omschrijving`, `Actie`, `VervolgActie`, `UitgevoerdeWerkzaamheden`, `Afspraken`, `SluitDatum`, `IncidentGesloten`, `Klant_ID`, `SoortIncident_ID`) VALUES
(1, '2018-02-12', 'Abdul Zahara', 'Vicar Amelia', 'Mobiel scherm stuk', 'Scherm vervangen', '', '', '', '0000-00-00', b'1', 1, 3),
(2, '2018-01-12', 'Lara Simons', ' Zara Madino', 'Wifi werkt niet', 'Software en hardware test', '', '', 'kom morgen terug', '0000-00-00', b'0', 2, 4),
(3, '2018-03-21', 'Abdul Asahakama', 'Piet Lakanda', 'Heel vaak zwarte scherm ', 'Grafische kaart vervangen', '', '', 'Volgende week vanwege bestelling', '0000-00-00', b'0', 4, 1),
(4, '2018-01-11', 'Vicar Amelia', 'Jerome Bernard', 'Testssssss', 'Doe ding', '', '', 'test', '0000-00-00', b'0', 5, 5),
(5, '2018-06-14', 'Skra', 'Big Shaq', 'sdcsdcscsdc', 'csdcsdcd', '', '', '', '0000-00-00', b'0', 3, 1),
(6, '2017-10-23', 'Skra', 'Big Shaq', 'sdcsdcscsdc', 'csdcsdcd', '', '', '', '0000-00-00', b'0', 3, 1),
(7, '0000-00-00', 'Skra', 'Big Shaq', 'sdcsdcscsdc', 'csdcsdcd', '', '', '', '2018-04-21', b'1', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE `klant` (
  `Klant_ID` int(11) NOT NULL,
  `Naam` varchar(255) DEFAULT NULL,
  `Telefoon` varchar(13) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Type_ID` int(11) NOT NULL,
  `ID_nummer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`Klant_ID`, `Naam`, `Telefoon`, `Email`, `Type_ID`, `ID_nummer`) VALUES
(1, 'Jaapie Sneeuwbal', '065415248', ' ', 3, ''),
(2, 'Osram Abdelsahar', ' ', 'aavadg@bab.nl', 1, 'OS5558254A'),
(3, 'Peter Klos', ' ', 'skra@gappa.com', 1, 'PE2668418461K'),
(4, 'Sabrina Veter', '0254524585', 'vdfvd@ertetwrte.lol', 2, '158871'),
(5, 'Sandra Parmelis', '0544987247', ' ', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `soortincident`
--

CREATE TABLE `soortincident` (
  `SoortIncident_ID` int(11) NOT NULL,
  `SoortIncident` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `soortincident`
--

INSERT INTO `soortincident` (`SoortIncident_ID`, `SoortIncident`) VALUES
(1, 'Incident software'),
(2, 'Incident hardware'),
(3, 'Incident advies'),
(4, 'Incident verzoek'),
(5, 'Test incident');

-- --------------------------------------------------------

--
-- Table structure for table `typeklant`
--

CREATE TABLE `typeklant` (
  `Type_ID` int(11) NOT NULL,
  `TypeKlant` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeklant`
--

INSERT INTO `typeklant` (`Type_ID`, `TypeKlant`) VALUES
(1, 'Docent'),
(2, 'Student'),
(3, 'Extern');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`Incident_ID`),
  ADD KEY `Incident_Klant` (`Klant_ID`),
  ADD KEY `Incident_SoortIncident` (`SoortIncident_ID`);

--
-- Indexes for table `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`Klant_ID`),
  ADD KEY `Klant_TypeKlant` (`Type_ID`);

--
-- Indexes for table `soortincident`
--
ALTER TABLE `soortincident`
  ADD PRIMARY KEY (`SoortIncident_ID`);

--
-- Indexes for table `typeklant`
--
ALTER TABLE `typeklant`
  ADD PRIMARY KEY (`Type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `Incident_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `klant`
--
ALTER TABLE `klant`
  MODIFY `Klant_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soortincident`
--
ALTER TABLE `soortincident`
  MODIFY `SoortIncident_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `typeklant`
--
ALTER TABLE `typeklant`
  MODIFY `Type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `Incident_Klant` FOREIGN KEY (`Klant_ID`) REFERENCES `klant` (`Klant_ID`),
  ADD CONSTRAINT `Incident_SoortIncident` FOREIGN KEY (`SoortIncident_ID`) REFERENCES `soortincident` (`SoortIncident_ID`);

--
-- Constraints for table `klant`
--
ALTER TABLE `klant`
  ADD CONSTRAINT `Klant_TypeKlant` FOREIGN KEY (`Type_ID`) REFERENCES `typeklant` (`Type_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
