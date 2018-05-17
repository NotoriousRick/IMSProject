-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2018 at 08:43 PM
-- Gemaakt door: Jetske de Boer
-- Server version: 5.5.57-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbIMS`
--
CREATE DATABASE IF NOT EXISTS `dbIMS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbIMS`;

-- --------------------------------------------------------

--
-- Table structure for table `Incident`
--

DROP TABLE IF EXISTS `Incident`;
CREATE TABLE `Incident` (
  `Incident_ID` int(11) NOT NULL,
  `Datum` datetime DEFAULT NULL,
  `Baliemedewerker` varchar(255) DEFAULT NULL,
  `Behandelaar` varchar(255) DEFAULT NULL,
  `Omschijving` text,
  `Actie` text,
  `VervolgActie` text,
  `UitgevoerdeWerkzaamheden` text,
  `Afspraken` text,
  `SluitDatum` datetime DEFAULT NULL,
  `IncidentGesloten` bit(1) DEFAULT NULL,
  `Klant_ID` int(11) NOT NULL,
  `SoortIncident_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Klant`
--

DROP TABLE IF EXISTS `Klant`;
CREATE TABLE `Klant` (
  `Klant_ID` int(11) NOT NULL,
  `Naam` varchar(255) DEFAULT NULL,
  `Telefoon` varchar(13) DEFAULT NULL,
  `E-mail` varchar(255) DEFAULT NULL,
  `Type_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SoortIncident`
--

DROP TABLE IF EXISTS `SoortIncident`;
CREATE TABLE `SoortIncident` (
  `SoortIncident_ID` int(11) NOT NULL,
  `SoortIncident` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `TypeKlant`
--

DROP TABLE IF EXISTS `TypeKlant`;
CREATE TABLE `TypeKlant` (
  `Type_ID` int(11) NOT NULL,
  `TypeKlant` varchar(255) DEFAULT NULL,
  `ID_nummer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Incident`
--
ALTER TABLE `Incident`
  ADD PRIMARY KEY (`Incident_ID`),
  ADD KEY `Incident_Klant` (`Klant_ID`),
  ADD KEY `Incident_SoortIncident` (`SoortIncident_ID`);

--
-- Indexes for table `Klant`
--
ALTER TABLE `Klant`
  ADD PRIMARY KEY (`Klant_ID`),
  ADD KEY `Klant_TypeKlant` (`Type_ID`);

--
-- Indexes for table `SoortIncident`
--
ALTER TABLE `SoortIncident`
  ADD PRIMARY KEY (`SoortIncident_ID`);

--
-- Indexes for table `TypeKlant`
--
ALTER TABLE `TypeKlant`
  ADD PRIMARY KEY (`Type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Incident`
--
ALTER TABLE `Incident`
  MODIFY `Incident_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Klant`
--
ALTER TABLE `Klant`
  MODIFY `Klant_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `SoortIncident`
--
ALTER TABLE `SoortIncident`
  MODIFY `SoortIncident_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `TypeKlant`
--
ALTER TABLE `TypeKlant`
  MODIFY `Type_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Incident`
--
ALTER TABLE `Incident`
  ADD CONSTRAINT `Incident_Klant` FOREIGN KEY (`Klant_ID`) REFERENCES `Klant` (`Klant_ID`),
  ADD CONSTRAINT `Incident_SoortIncident` FOREIGN KEY (`SoortIncident_ID`) REFERENCES `SoortIncident` (`SoortIncident_ID`);

--
-- Constraints for table `Klant`
--
ALTER TABLE `Klant`
  ADD CONSTRAINT `Klant_TypeKlant` FOREIGN KEY (`Type_ID`) REFERENCES `TypeKlant` (`Type_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
