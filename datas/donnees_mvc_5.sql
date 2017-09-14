-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 14 Septembre 2017 à 12:22
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mvc_5`
--

--
-- Contenu de la table `categ`
--

INSERT INTO `categ` (`idcateg`, `intitule`) VALUES
(2, 'Animaux'),
(6, 'Cuisine'),
(3, 'Mode'),
(4, 'Nature'),
(5, 'Sport');

--
-- Contenu de la table `droits`
--

INSERT INTO `droits` (`iddroits`, `leDroit`, `poster`, `supprimer`, `modifier`, `posterTous`, `modifierTous`, `supprimerTous`) VALUES
(1, 'Utilisateur', 1, 0, 1, 0, 0, 0),
(2, 'Modérateur', 1, 0, 1, 0, 1, 0),
(3, 'Administrateur', 1, 1, 1, 1, 1, 1);

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idusers`, `login`, `pwd`, `droits_iddroits`) VALUES
(1, 'admin', 'admin', 3),
(2, 'modo', 'modo', 2),
(3, 'util1', 'util1', 1),
(4, 'util2', 'util2', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
