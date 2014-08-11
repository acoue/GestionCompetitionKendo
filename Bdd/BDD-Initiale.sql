-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 10 Août 2014 à 23:19
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `gck`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idcategorie` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Individuel 1 = équipe',
  PRIMARY KEY (`idcategorie`),
  UNIQUE KEY `libelle` (`libelle`),
  KEY `libelle_2` (`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idcategorie`, `libelle`, `type`) VALUES
(1, 'BENJAMIN', 0),
(2, 'MINIME', 0),
(3, 'ESPOIR', 0),
(4, 'CADET', 0),
(5, 'EXCELLENCES FEMMES', 0),
(7, 'JUNIOR', 0),
(8, 'KYU FEMMES', 0),
(9, 'KYU HOMMES', 0),
(10, 'EXELLENCES HOMMES', 0),
(11, 'EQUIPES HONNEURS FRANCE', 1),
(12, 'HONNEURS', 0),
(13, 'SAMOURAI', 0),
(14, 'EQUIPES EXCELLENCE', 0),
(15, 'EQUIPES HONNEURS REGION', 0);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `idclub` int(10) NOT NULL AUTO_INCREMENT,
  `idregion` int(10) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`idclub`),
  UNIQUE KEY `libelle` (`libelle`),
  KEY `idregion` (`idregion`,`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `club`
--

INSERT INTO `club` (`idclub`, `idregion`, `libelle`) VALUES
(1, 23, '-');

-- --------------------------------------------------------

--
-- Structure de la table `combat_poule`
--

CREATE TABLE `combat_poule` (
  `idcombat_poule` int(10) NOT NULL AUTO_INCREMENT,
  `idcompetition` int(10) NOT NULL,
  `idcategorie` int(10) NOT NULL,
  `poule` int(2) NOT NULL,
  `ordre` int(1) NOT NULL,
  `idlicencie1` int(10) NOT NULL,
  `idlicencie2` int(10) NOT NULL,
  `resultat_rouge` varchar(5) DEFAULT NULL,
  `resultat_blanc` varchar(5) DEFAULT NULL,
  `idvainqueur` int(10) DEFAULT NULL,
  PRIMARY KEY (`idcombat_poule`),
  UNIQUE KEY `idcategorie` (`idcategorie`,`poule`,`ordre`,`idcompetition`),
  UNIQUE KEY `idcategorie_2` (`idcategorie`,`poule`,`ordre`,`idcompetition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

CREATE TABLE `competition` (
  `idcompetition` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `datecompetition` date NOT NULL,
  `lieux` varchar(100) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Individuel 1 = éuipe',
  `description` text NOT NULL,
  `selected` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcompetition`),
  UNIQUE KEY `libelle` (`libelle`,`datecompetition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `competition`
--

INSERT INTO `competition` (`idcompetition`, `libelle`, `datecompetition`, `lieux`, `type`, `description`, `selected`) VALUES
(1, 'Inter-Région Ouest', '2014-02-28', '-', 0, 'Competition de test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `historique_tirage`
--

CREATE TABLE `historique_tirage` (
  `idhistorique` int(10) NOT NULL AUTO_INCREMENT,
  `idcompetition` int(10) NOT NULL,
  `idcategorie` int(10) NOT NULL,
  `date_tirage` date NOT NULL,
  `type` VARCHAR( 100 ) NULL ,
  PRIMARY KEY (`idhistorique`),
  UNIQUE KEY `idcategorie` (`idcategorie`,`date_tirage`,`idcompetition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `licencie`
--

CREATE TABLE `licencie` (
  `idlicencie` int(10) NOT NULL AUTO_INCREMENT,
  `idclub` int(10) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`idlicencie`),
  UNIQUE KEY `idclub` (`idclub`,`prenom`,`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `licencie`
--

INSERT INTO `licencie` (`idlicencie`, `idclub`, `prenom`, `nom`) VALUES
(1, 1, '+rTNU/cOoYqcAey5r/4dog==', '+rTNU/cOoYqcAey5r/4dog==');

-- --------------------------------------------------------

--
-- Structure de la table `licencie_categorie`
--

CREATE TABLE `licencie_categorie` (
  `idlicencie_categorie` int(10) NOT NULL AUTO_INCREMENT,
  `idcompetition` int(10) NOT NULL,
  `idcategorie` int(10) NOT NULL,
  `idlicencie` int(10) NOT NULL,
  `numero_poule` int(1) NOT NULL,
  `position_poule` int(1) NOT NULL,
  `resultat_combat` int(1) NOT NULL DEFAULT '0',
  `point_combat` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idlicencie_categorie`),
  UNIQUE KEY `idcategorie` (`idcategorie`,`idlicencie`),
  UNIQUE KEY `idcategorie_2` (`idcategorie`,`idlicencie`,`idcompetition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE `log` (
  `idlog` int(10) NOT NULL AUTO_INCREMENT,
  `typelog` varchar(50) NOT NULL,
  `texte` text NOT NULL,
  `datelog` datetime NOT NULL,
  PRIMARY KEY (`idlog`),
  KEY `datelog` (`datelog`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `idregion` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`idregion`),
  UNIQUE KEY `libelle` (`libelle`),
  KEY `libelle_2` (`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `region`
--

INSERT INTO `region` (`idregion`, `libelle`) VALUES
(1, 'ALSACE'),
(2, 'AQUITAINE'),
(3, 'AUVERGNE'),
(4, 'BOURGOGNE'),
(5, 'BRETAGNE'),
(6, 'CENTRE'),
(7, 'CHAMPAGNE ARDENNES'),
(8, 'CORSE'),
(26, 'ESSONNE'),
(9, 'FRANCHE COMTE'),
(27, 'HAUTS DE SEINE'),
(10, 'LANGUEDOC ROUSSILON'),
(11, 'LIMOUSIN'),
(12, 'LORRAINE'),
(13, 'MIDI PYRENEES'),
(15, 'NORD PAS DE CALAIS'),
(14, 'NORMANDIE'),
(22, 'NOUVELLE CALEDONIE'),
(16, 'PACA'),
(23, 'PARIS'),
(17, 'PAYS DE LA LOIRE'),
(18, 'PICARDIE'),
(19, 'POITOU CHARENTES'),
(21, 'REUNION'),
(20, 'RHONES ALPES'),
(24, 'SEINE ET MARNE'),
(28, 'SEINE ST DENIS'),
(30, 'VAL D''OISE'),
(29, 'VAL DE MARNE'),
(25, 'YVELINES');

-- --------------------------------------------------------

--
-- Structure de la table `resultat_poule`
--

CREATE TABLE `resultat_poule` (
  `idresultat_poule` int(10) NOT NULL AUTO_INCREMENT,
  `idcompetition` int(10) NOT NULL,
  `idcategorie` int(10) NOT NULL,
  `idlicencie` int(10) NOT NULL,
  `numero_poule` int(2) NOT NULL,
  `classement` int(1) NOT NULL,
  PRIMARY KEY (`idresultat_poule`),
  UNIQUE KEY `idcategorie` (`idcategorie`,`idlicencie`,`numero_poule`,`classement`,`idcompetition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
