-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 05 Septembre 2017 à 13:31
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `mvc_5`
--

--
-- Contenu de la table `categ`
--

INSERT INTO `categ` (`idcateg`, `intitule`) VALUES
(2, 'Animaux'),
(4, 'Informatique'),
(1, 'Paysages'),
(3, 'Sport'),
(5, 'Travail');

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`idimages`, `titre`, `desc`, `nom`, `largeOrigine`, `hautOrigine`) VALUES
(1, 'Agence Elite', 'Modèles de l agence Elite', '20180707215430_16453.jpg', 1500, 890);

--
-- Contenu de la table `images_has_categ`
--

INSERT INTO `images_has_categ` (`images_idimages`, `categ_idcateg`) VALUES
(1, 5);
