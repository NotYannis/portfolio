-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 08 Avril 2014 à 17:41
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `portfolio`
--
CREATE DATABASE IF NOT EXISTS `portfolio` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `portfolio`;

-- --------------------------------------------------------

--
-- Structure de la table `port_categories`
--

CREATE TABLE IF NOT EXISTS `port_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `port_categories`
--

INSERT INTO `port_categories` (`id`, `name`, `slug`) VALUES
(8, 'stages', 'stages'),
(7, 'bts', 'bts'),
(6, 'jeux video', 'games'),
(13, 'veille technologique', 'veille');

-- --------------------------------------------------------

--
-- Structure de la table `port_images`
--

CREATE TABLE IF NOT EXISTS `port_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `work_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `port_images`
--

INSERT INTO `port_images` (`id`, `name`, `work_id`) VALUES
(6, '6.jpg', 4),
(8, '8.jpg', 4),
(9, '9.jpg', 4),
(10, '10.png', 1),
(13, '13.png', 5),
(14, '14.png', 6);

-- --------------------------------------------------------

--
-- Structure de la table `port_users`
--

CREATE TABLE IF NOT EXISTS `port_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `port_users`
--

INSERT INTO `port_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Structure de la table `port_works`
--

CREATE TABLE IF NOT EXISTS `port_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_id` (`category_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `port_works`
--

INSERT INTO `port_works` (`id`, `name`, `slug`, `content`, `category_id`, `image_id`) VALUES
(1, 'Portfolio', 'portfolio', '<p>Et quoniam inedia gravi adflictabantur, locum petivere Paleas nomine, vergentem in mare, valido muro firmatum, ubi conduntur nunc usque commeatus distribui militibus omne latus Isauriae defendentibus adsueti. circumstetere igitur hoc munimentum per triduum et trinoctium et cum neque adclivitas ipsa sine discrimine adiri letali, nec cuniculis quicquam geri posset, nec procederet ullum obsidionale commentum, maesti excedunt postrema vi subigente maiora viribus adgressuri.</p>\r\n<p>&nbsp;</p>', 7, 10),
(5, 'EugÃ©nie CrÃ©ations', 'eugenie', '<p>Le stage de premi&egrave;re ann&eacute;e a consist&eacute; en la cr&eacute;ation d''un site web pour l''association Eug&eacute;nie Cr&eacute;ations.</p>\r\n<p>Ce site a &eacute;t&eacute; con&ccedil;u avec le CMS Joomla!. Cet outil a permis d''avoir une structure de base compl&egrave;te et une administration facilit&eacute;e pour la suite.</p>\r\n<p>Mon travail principal a consist&eacute; &agrave; rechercher une structure et un design r&eacute;pondant aux demandes de la pr&eacute;sidente de l''association.</p>\r\n<p>Les personnes pour qui le site &eacute;tait d&eacute;stin&eacute; ne ma&icirc;trisaient pas d''outils li&eacute;s au web, j''ai donc du &eacute;crire une documentation et les former &agrave; l''utilisation de Joomla!.</p>\r\n<p>Le site se trouve &agrave; l''adresse suivante : <a href="http://www.eugeniecreations.fr/">Eug&eacute;nie Cr&eacute;ations</a></p>', 8, 13),
(6, 'Iris', 'iris', '<p>Dans le cadre du stage de deuxi&egrave;me ann&eacute;e, j''ai repris une application PHP existante pour la s&eacute;curiser en vue de la publier sur Internet. Cette application avait plusieurs ann&eacute;es d''existance et &eacute;tait d&eacute;j&agrave; pass&eacute;e entre plusieurs main, mon deuxi&egrave;me travail &eacute;tait de la nettoyer, de la rendre plus visible pour les futurs d&eacute;veloppeurs qui la modifieront.</p>\r\n<p>Les outils utilis&eacute;s m''ont permis de mettre en pratique les acquis de deuxi&egrave;me ann&eacute;e : structure MVC, versionning avec Git, suivi de projet avec Redmine.</p>', 8, 14),
(8, 'jeuxtest', 'jeuxtest', '', 6, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
