-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 09:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `Id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`Id`, `username`, `password`, `nom`) VALUES
(1, 'mahmoud', '42f1c6a8b4b7edc3dc0b2517f798bae0e044b713', 'mahmoud');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Id` int(10) NOT NULL,
  `IdClt` int(5) NOT NULL,
  `RefPrd` int(5) NOT NULL,
  `NomPrd` varchar(150) NOT NULL,
  `Qte` int(5) NOT NULL,
  `Prix` decimal(7,2) NOT NULL,
  `Image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Id`, `IdClt`, `RefPrd`, `NomPrd`, `Qte`, `Prix`, `Image`) VALUES
(30, 4, 13, 'HP Elitebook 840 G3', 1, '2600.00', 'hp elitebook 840 g3_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CodeCtg` int(5) NOT NULL,
  `LebCtg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CodeCtg`, `LebCtg`) VALUES
(1, 'Ordinateurs Portables'),
(2, 'Ordinateurs bureaux'),
(3, 'Écrans'),
(4, 'Cartes graphiques'),
(5, 'Accessoires'),
(6, 'souris'),
(7, 'Cameras');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `IdClt` int(5) NOT NULL,
  `CIN` varchar(10) NOT NULL,
  `NomClt` varchar(30) NOT NULL,
  `PrenomClt` varchar(30) NOT NULL,
  `AdresseClt` varchar(55) NOT NULL,
  `TelClt` varchar(15) NOT NULL,
  `EmailClt` varchar(55) NOT NULL,
  `Motdepasse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`IdClt`, `CIN`, `NomClt`, `PrenomClt`, `AdresseClt`, `TelClt`, `EmailClt`, `Motdepasse`) VALUES
(4, 'F111', 'Client', 'X1', 'Hay El-Qods', '0611223344', 'client.x1@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `CodeCmd` int(5) NOT NULL,
  `IdClt` int(5) NOT NULL,
  `NomClt` varchar(65) NOT NULL,
  `TelClt` varchar(15) NOT NULL,
  `EmailClt` varchar(55) NOT NULL,
  `AdrssClt` varchar(50) NOT NULL,
  `DateCmd` date NOT NULL DEFAULT current_timestamp(),
  `TotalPrds` varchar(1000) NOT NULL,
  `PrixTotal` decimal(7,2) NOT NULL,
  `mode_paiement` varchar(20) NOT NULL,
  `paiement` varchar(5) NOT NULL DEFAULT 'Non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`CodeCmd`, `IdClt`, `NomClt`, `TelClt`, `EmailClt`, `AdrssClt`, `DateCmd`, `TotalPrds`, `PrixTotal`, `mode_paiement`, `paiement`) VALUES
(27, 4, 'Client x1', '0611223344', 'client.x1@gmail.com', 'Hay El-Qods, Oujda', '2023-07-01', 'Asus vivobook ( 1) -', '3000.00', 'Paiement à la livrai', 'Oui'),
(28, 4, 'Client x1', '0611223344', 'client.x1@gmail.com', 'Hay El-Qods, Oujda', '2023-07-01', 'HP Elitebook 840 G3 ( 1) -', '2600.00', 'Paiement à la livrai', 'Oui'),
(37, 4, 'client x1', '0611223344', 'clinet.x1@gmail.com', 'Hay el Qods, Oujda', '2023-07-17', 'Asus VG27VQ ( 1) -', '3200.00', 'Paiement à la livrai', 'Non');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `IdMsg` int(5) NOT NULL,
  `Nom` varchar(60) NOT NULL,
  `TelClt` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`IdMsg`, `Nom`, `TelClt`, `Email`, `Message`) VALUES
(3, 'Client x1', '0611223344', 'client.x1@gmail.com', 'Salut, ca va?');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `RefPrd` int(5) NOT NULL,
  `NomPrd` varchar(150) NOT NULL,
  `QtePrd` int(5) NOT NULL,
  `Prix` decimal(7,2) NOT NULL,
  `Image_1` varchar(150) NOT NULL,
  `Image_2` varchar(150) NOT NULL,
  `Image_3` varchar(150) NOT NULL,
  `CodeCtg` int(5) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`RefPrd`, `NomPrd`, `QtePrd`, `Prix`, `Image_1`, `Image_2`, `Image_3`, `CodeCtg`, `Description`) VALUES
(13, 'HP Elitebook 840 G3', 5, '2600.00', 'hp elitebook 840 g3_4.jpg', 'hp_ellitebook 840 g3_2.jpg', 'hp_ellitebook 840 g3_3.jpg', 1, '- État : Occasion - Très bon\r\n- Spécification:\r\n- CPU : Intel Core i5-6200u\r\n- RAM : 8 Go DDR4 2133 Mhz\r\n- Stockage : 256 Go SSD\r\n- Ecran : 14″ Full-HD (1920 x 1080)\r\n- Wi-Fi + Bluetooth + Webcam HD\r\n- OS : Windows 10 pro'),
(14, 'Asus vivobook', 5, '3000.00', 'asus_vivobook.png', 'Asus-Vivobook-1.jpg', 'Asus-Vivobook-2.jpg', 1, 'État : Neuf\r\nCPU : AMD Ryzen™ 3 3250U\r\nGPU : AMD Radeon Graphics\r\nRAM : 8 GB DDR4\r\nStockage : 256GB M.2 NVMe\r\nÉcran : 14″ HD 16:9 LED\r\nCommunication : Wi-Fi 5 ac + Bluetooth 5.1\r\nOS : Windows 11\r\nClavier : Azerty Français\r\nGarantie: 1 Year'),
(17, 'Asus VG27VQ', 7, '3200.00', 'asus-vg27vq-27-led-165-hz-moniteurs.jpg', 'asus-vg27vq-27-led-165-hz-moniteurs1.jpg', 'asus-vg27vq-27-led-165-hz-moniteurs2.jpg', 3, 'Taille de l&#39;écran: 27&#34; - Format 16:9\r\nType de Dalle: VA - Rétroéclairage: LED\r\nRésolution: 1920x1080\r\nTemps de réponse: 1ms MPRT\r\nConnecteurs d&#39;entrée: DisplayPort, HDMI, DVI\r\nRéglages de la position de l&#39;écran: Inclinaison +25° ~ -5°, Piv'),
(19, 'Samsung Odyssey G5', 10, '3500.00', 'samsung.jpg', 'samsung1.jpg', 'samsung2.jpg', 3, 'Design Sobreenvironnements\r\nÉcran de 32 pouces Full HD (2560 x 1440) 2k\r\nHDR (High Dynamic Range)\r\nType Dalle :  VA avec angles de vision larges\r\nTemps de réponse de 1 ms MPRT\r\nRapport de contraste statique 2500:1\r\nFréquence de rafraîchissement maximale d');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `Id` int(10) NOT NULL,
  `IdClt` int(5) NOT NULL,
  `RefPrd` int(5) NOT NULL,
  `NomPrd` varchar(150) NOT NULL,
  `Prix` decimal(7,2) NOT NULL,
  `Image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_IdCli` (`IdClt`),
  ADD KEY `FK_Pro` (`RefPrd`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CodeCtg`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`IdClt`),
  ADD UNIQUE KEY `CIN` (`CIN`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`CodeCmd`),
  ADD KEY `FK_IdClt` (`IdClt`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`IdMsg`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`RefPrd`),
  ADD KEY `FK_CodeCtg` (`CodeCtg`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FKIdClt` (`IdClt`),
  ADD KEY `FKRefPrd` (`RefPrd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintbl`
--
ALTER TABLE `admintbl`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CodeCtg` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `IdClt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `CodeCmd` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `IdMsg` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `RefPrd` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_IdCli` FOREIGN KEY (`IdClt`) REFERENCES `clients` (`IdClt`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Pro` FOREIGN KEY (`RefPrd`) REFERENCES `produits` (`RefPrd`) ON DELETE CASCADE;

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_IdClt` FOREIGN KEY (`IdClt`) REFERENCES `clients` (`IdClt`) ON DELETE CASCADE;

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_CodeCtg` FOREIGN KEY (`CodeCtg`) REFERENCES `categories` (`CodeCtg`) ON UPDATE NO ACTION;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FKIdClt` FOREIGN KEY (`IdClt`) REFERENCES `clients` (`IdClt`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKRefPrd` FOREIGN KEY (`RefPrd`) REFERENCES `produits` (`RefPrd`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
