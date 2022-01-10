-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2022 at 12:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `enomicprojet`
--

-- --------------------------------------------------------

--
-- Table structure for table `artise`
--

CREATE TABLE `artise` (
  `id` int(11) NOT NULL,
  `nomArtise` varchar(100) NOT NULL,
  `img` varchar(250) CHARACTER SET utf8 NOT NULL,
  `Categorie` int(100) DEFAULT NULL,
  `presentation` longtext NOT NULL,
  `createDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artise`
--

INSERT INTO `artise` (`id`, `nomArtise`, `img`, `Categorie`, `presentation`, `createDate`, `updateDate`) VALUES
(11, 'GHSHGHAIE', 'ART1.jpg', 6, 'Graphic Design - Bodypainting', NULL, NULL),
(13, 'Brice Marc', 'Watercolor2.jpg', 1, 'Graphic Design  - Peinture', NULL, NULL),
(14, 'MAHINE TEA', 'img4.jpg', 6, 'Graphic Design', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ar_cate`
--

CREATE TABLE `ar_cate` (
  `id` int(11) NOT NULL,
  `name_cate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ar_cate`
--

INSERT INTO `ar_cate` (`id`, `name_cate`) VALUES
(1, 'photographe\r\n'),
(3, 'Producer '),
(4, 'Dj'),
(6, 'Graphiste'),
(9, 'Décorateur');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `mail` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `nom` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`mail`, `message`, `nom`) VALUES
('huan@z', 'sqdqsdsq', '');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `name` varchar(100) NOT NULL,
  `artise` int(11) NOT NULL,
  `date` date NOT NULL,
  `event_adresse` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`name`, `artise`, `date`, `event_adresse`, `img`, `id`) VALUES
('DUALITY', 11, '2022-01-22', '17-19 rue Marcel Dutartre 69100 Villeurbanne', '271522496_1349527678884526_4099191535858455002_n.jpg', 7),
('ANOMIC DISTORSIONS', 11, '2021-10-22', '267 rue Marcel Mérieux 69007 Lyon', '241852599_248379740627179_26461475337368380_n.jpg', 8),
('Anomic Trip #2: Magmatic', 11, '2021-10-15', 'Red Club', '241715069_1269896250181003_5425543758124782874_n.jpg', 9);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artise`
--
ALTER TABLE `artise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Categorie` (`Categorie`);

--
-- Indexes for table `ar_cate`
--
ALTER TABLE `ar_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`mail`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artise` (`artise`),
  ADD KEY `image` (`img`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event` (`event`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artise`
--
ALTER TABLE `artise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ar_cate`
--
ALTER TABLE `ar_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artise`
--
ALTER TABLE `artise`
  ADD CONSTRAINT `artise_ibfk_1` FOREIGN KEY (`Categorie`) REFERENCES `ar_cate` (`id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`artise`) REFERENCES `artise` (`id`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`event`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
