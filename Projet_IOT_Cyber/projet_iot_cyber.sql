-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 23 mai 2024 à 13:33
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet/iot/cyber`
--

-- --------------------------------------------------------

--
-- Structure de la table `pixel`
--

CREATE TABLE `pixel` (
  `ID` int(16) NOT NULL,
  `Color` varchar(7) NOT NULL,
  `Pos_x` int(10) NOT NULL,
  `Pos_y` int(10) NOT NULL,
  `sheet_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pixel`
--

INSERT INTO `pixel` (`ID`, `Color`, `Pos_x`, `Pos_y`, `sheet_id`, `user_id`) VALUES
(1, '#000000', 1, 1, 1, 252);

-- --------------------------------------------------------

--
-- Structure de la table `sheet`
--

CREATE TABLE `sheet` (
  `ID` int(16) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sheet`
--

INSERT INTO `sheet` (`ID`, `Name`) VALUES
(1, 'bonjour'),
(2, 'Salut');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int(16) NOT NULL,
  `MailAdresse` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `MailAdresse`, `Password`, `Username`) VALUES
(252, 'bonjour@bonjour', '2cb4b1431b84ec15d35ed83bb927e27e8967d75f4bcd9cc4b25c8d879ae23e18', 'bonjour');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pixel`
--
ALTER TABLE `pixel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_sheet_id` (`sheet_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Index pour la table `sheet`
--
ALTER TABLE `sheet`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pixel`
--
ALTER TABLE `pixel`
  MODIFY `ID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sheet`
--
ALTER TABLE `sheet`
  MODIFY `ID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pixel`
--
ALTER TABLE `pixel`
  ADD CONSTRAINT `fk_sheet_id` FOREIGN KEY (`sheet_id`) REFERENCES `sheet` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
