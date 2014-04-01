-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 01 Avril 2014 à 23:14
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
  PRIMARY KEY (`idcategorie`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idcategorie`, `libelle`) VALUES
(1, 'BENJAMIN'),
(4, 'CADET'),
(11, 'EQUIPES'),
(3, 'ESPOIR'),
(5, 'EXCELLENCES FEMMES'),
(10, 'EXELLENCES HOMMES'),
(12, 'HONNEURS'),
(7, 'JUNIOR'),
(8, 'KYU FEMMES'),
(9, 'KYU HOMMES'),
(2, 'MINIME'),
(13, 'SAMOURAI');

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `idclub` int(10) NOT NULL AUTO_INCREMENT,
  `idregion` int(10) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`idclub`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `club`
--

INSERT INTO `club` (`idclub`, `idregion`, `libelle`) VALUES
(3, 17, 'JJKH'),
(4, 5, 'KENDO SAINT BRIEUX'),
(5, 17, 'BUDOKAN ANGERS'),
(7, 17, 'SAMOURAI 2000'),
(8, 17, 'KETSUGO'),
(9, 17, 'AME AGARU'),
(10, 5, 'CERCLE PAUL BERT'),
(11, 5, 'CHANTEPIE'),
(12, 17, 'DOJO NANTAIS'),
(13, 17, 'JKCF'),
(14, 5, 'KC BREST'),
(15, 5, 'KCSB'),
(16, 19, 'KICNIORT'),
(17, 5, 'PLDLORIENT'),
(18, 19, 'POITIERS'),
(19, 5, 'QUIBERON'),
(20, 5, 'QUIMPER'),
(21, 5, 'SAINT NAZAIRE'),
(22, 17, 'SHODOKAN'),
(23, 5, 'ST NAZAIRE'),
(24, 14, 'ASGPMHAVRE');

-- --------------------------------------------------------

--
-- Structure de la table `combat_poule`
--

CREATE TABLE `combat_poule` (
  `idcombat_poule` int(10) NOT NULL AUTO_INCREMENT,
  `idcategorie` int(10) NOT NULL,
  `poule` int(2) NOT NULL,
  `ordre` int(1) NOT NULL,
  `idlicencie1` int(10) NOT NULL,
  `idlicencie2` int(10) NOT NULL,
  `resultat_rouge` varchar(5) DEFAULT NULL,
  `resultat_blanc` varchar(5) DEFAULT NULL,
  `idvainqueur` int(10) DEFAULT NULL,
  `idcompetition` int(10) NOT NULL,
  PRIMARY KEY (`idcombat_poule`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Contenu de la table `combat_poule`
--

INSERT INTO `combat_poule` (`idcombat_poule`, `idcategorie`, `poule`, `ordre`, `idlicencie1`, `idlicencie2`, `resultat_rouge`, `resultat_blanc`, `idvainqueur`, `idcompetition`) VALUES
(100, 13, 1, 1, 164, 163, NULL, NULL, NULL, 0),
(101, 13, 1, 2, 164, 162, NULL, NULL, NULL, 0),
(102, 13, 1, 3, 163, 162, NULL, NULL, NULL, 0),
(103, 13, 2, 1, 161, 37, NULL, NULL, NULL, 0),
(104, 13, 2, 2, 161, 56, NULL, NULL, NULL, 0),
(105, 13, 2, 3, 37, 56, NULL, NULL, NULL, 0),
(106, 13, 3, 1, 54, 55, NULL, NULL, NULL, 0),
(107, 13, 3, 2, 57, 160, NULL, NULL, NULL, 0),
(108, 13, 3, 3, 54, 160, NULL, NULL, NULL, 0),
(109, 13, 3, 4, 54, 57, NULL, NULL, NULL, 0),
(110, 13, 3, 5, 55, 57, NULL, NULL, NULL, 0),
(111, 13, 3, 6, 57, 160, NULL, NULL, NULL, 0),
(142, 10, 1, 1, 68, 39, NULL, NULL, NULL, 0),
(143, 10, 1, 2, 68, 168, NULL, NULL, NULL, 0),
(144, 10, 1, 3, 39, 168, NULL, NULL, NULL, 0),
(145, 10, 2, 1, 42, 165, NULL, NULL, NULL, 0),
(146, 10, 2, 2, 42, 37, NULL, NULL, NULL, 0),
(147, 10, 2, 3, 165, 37, NULL, NULL, NULL, 0),
(148, 10, 3, 1, 58, 166, NULL, NULL, NULL, 0),
(149, 10, 3, 2, 58, 76, NULL, NULL, NULL, 0),
(150, 10, 3, 3, 166, 76, NULL, NULL, NULL, 0),
(151, 10, 4, 1, 90, 157, NULL, NULL, NULL, 0),
(152, 10, 4, 2, 90, 163, NULL, NULL, NULL, 0),
(153, 10, 4, 3, 157, 163, NULL, NULL, NULL, 0),
(154, 10, 5, 1, 130, 120, NULL, NULL, NULL, 0),
(155, 10, 5, 2, 130, 88, NULL, NULL, NULL, 0),
(156, 10, 5, 3, 120, 88, NULL, NULL, NULL, 0),
(157, 10, 6, 1, 66, 41, NULL, NULL, NULL, 0),
(158, 10, 6, 2, 66, 34, NULL, NULL, NULL, 0),
(159, 10, 6, 3, 41, 34, NULL, NULL, NULL, 0),
(160, 10, 7, 1, 109, 36, NULL, NULL, NULL, 0),
(161, 10, 7, 2, 128, 141, NULL, NULL, NULL, 0),
(162, 10, 7, 3, 109, 141, NULL, NULL, NULL, 0),
(163, 10, 7, 4, 109, 128, NULL, NULL, NULL, 0),
(164, 10, 7, 5, 36, 128, NULL, NULL, NULL, 0),
(165, 10, 7, 6, 128, 141, NULL, NULL, NULL, 0),
(166, 10, 8, 1, 48, 72, NULL, NULL, NULL, 0),
(167, 10, 8, 2, 167, 53, NULL, NULL, NULL, 0),
(168, 10, 8, 3, 48, 53, NULL, NULL, NULL, 0),
(169, 10, 8, 4, 48, 167, NULL, NULL, NULL, 0),
(170, 10, 8, 5, 72, 167, NULL, NULL, NULL, 0),
(171, 10, 8, 6, 167, 53, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

CREATE TABLE `competition` (
  `idcompetition` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `datecompetition` date NOT NULL,
  `lieux` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `selected` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcompetition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `competition`
--

INSERT INTO `competition` (`idcompetition`, `libelle`, `datecompetition`, `lieux`, `description`, `selected`) VALUES
(1, 'Test', '2014-02-28', 'Paris', 'Competition de test', 1),
(2, 'test2', '2014-03-29', NULL, 'Competition par equipe', 0),
(4, 'TEST4', '2014-02-02', NULL, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `historique_tirage`
--

CREATE TABLE `historique_tirage` (
  `idhistorique` int(10) NOT NULL AUTO_INCREMENT,
  `idcategorie` int(10) NOT NULL,
  `date_tirage` date NOT NULL,
  `idcompetition` int(10) NOT NULL,
  PRIMARY KEY (`idhistorique`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `historique_tirage`
--

INSERT INTO `historique_tirage` (`idhistorique`, `idcategorie`, `date_tirage`, `idcompetition`) VALUES
(19, 13, '2014-03-22', 0),
(21, 10, '2014-04-01', 0);

-- --------------------------------------------------------

--
-- Structure de la table `licencie`
--

CREATE TABLE `licencie` (
  `idlicencie` int(10) NOT NULL AUTO_INCREMENT,
  `idclub` int(10) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`idlicencie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=169 ;

--
-- Contenu de la table `licencie`
--

INSERT INTO `licencie` (`idlicencie`, `idclub`, `prenom`, `nom`) VALUES
(1, 2, 'Cl4Nxq8bbOBzpxOmjor35A==', '7gTp74ppFqaGwa5UN4NAZQ=='),
(16, 12, 'wufgxVSkUPMVjfKRtdW53Q==', 'CgU/NylvhhqLljyPsTjybA=='),
(17, 12, 'beGD40yIyCblLQpQU5650A==', '+bmRqgOpt3kqj6Pr5Kqf3w=='),
(18, 8, 'LwDwhwfXvxqoo8PU3vXbVA==', 'iBIcT++fpxH6YoV4YXzF0Q=='),
(19, 15, 'LkNS369oBvNegzXkBEYpKA==', 'yqs85x55JGjW42pdVGgrew=='),
(20, 11, 'iyuNee0FHG9C59HqqMQUHw==', 'XE91HGxlHIrQry6/F7TnRQ=='),
(21, 13, 'dEjxa2qzpe2/H9TLHrPWtw==', 'xZDWeIBCP5mOSuMFcZAdLw=='),
(22, 13, 'rklqLkpWiObqe+sk6LPg+w==', 'SMIQ7eyNRCCqwpEQP0qElw=='),
(24, 3, '28E8argJqopA+uThNVfFgw==', 's7uHkkv1XCjVLf8BDD9x7A=='),
(25, 19, 'jLGqhQmhTMVCezD6uBddbQ==', 'HtUGnci7ivredLQj9V9R4A=='),
(26, 12, 'uZCq7N3+peA6QOnEY5zXnQ==', 'T+S9UQ/MNT+1eT16oqeyuA=='),
(27, 18, 'LUBnJHGxv8o+Qm6BYzN0ug==', 'tlOMNKm8BpmrxaZ5B3yT0w=='),
(28, 15, 'GFyi6cKCKlcavyKP493Rng==', 'wl/lylQ4pAqom1n8x+fhJw=='),
(29, 11, 'Zk/4aQ5fN0z6NMIUN4lgEQ==', 'Gd0RM8WfAbUnocQlnpPLIA=='),
(30, 18, '5K2l8FMWP1EnRAEOFpa7lQ==', 'yqs85x55JGjW42pdVGgrew=='),
(31, 15, 'tsjazu0p9ypawV7RhCSvjA==', 'yqs85x55JGjW42pdVGgrew=='),
(32, 11, 'HQ/f8q177kt16XPXTaAfMQ==', 'XE91HGxlHIrQry6/F7TnRQ=='),
(33, 3, 'pcqBbGLTmSV+37JuwPZRQg==', 'aZs4BdA49Ze/YZXukGMCwg=='),
(34, 15, 'Us2uSR7zi/96BWciDph5qg==', 'XKXNShVh9nedjQLzoP/KQg=='),
(35, 8, 'W6TwTgrcSnckx/H335jS/Q==', '2yD8kzVGtcYrLq1TSixtYw=='),
(36, 13, 'ueMQSrvziEFGupzo3eWD2g==', 'LylVFe8ucTFFuaCLLRyBaA=='),
(37, 13, 'gmKxVNQAWVC9ajOHjyq15g==', 'Aap0agnGdBRAWobQoP4SNQ=='),
(38, 8, '5ncpW1mAVcYgvGwGTjqO2g==', 'zyliegvdQHDyONztv8yUuw=='),
(39, 7, 'u5pNOySLUA1JK4uOfMcVxw==', 'B1XqgFEFNlBS+qExccbGTA=='),
(40, 18, 'RIe2R/HHFrKimte/Q4HL9A==', 'DBryIw/HZqTAlkKQnqMiMw=='),
(41, 8, '63XvbZ1vCaWpnHNzyDD3OA==', 'g8QSF14nEPWTVUqKcBDGNA=='),
(42, 13, '5ncpW1mAVcYgvGwGTjqO2g==', 'UaSE1Z5JThI0+T3o/bp0lQ=='),
(43, 17, 'I4lJFz3JbCQr9J9KSpMXUQ==', 'iJno35xXgT6Bp36bl365+w=='),
(44, 20, 'BSq4GBkIO0AtRa4m1b+OaA==', 'Bnk275e3/y4pyrfiiDLkjQ=='),
(45, 8, 'dcXDWSUFypN7Qv8DMYHbig==', 'jn/2Tl9Xjhe7j8uHe/lV+A=='),
(46, 11, 'nsdFlgmhHPsYuIG8HO+JYg==', 'eTgDQ5DsDmqCmaVI76TsDw=='),
(47, 13, 'a2AOYSqQ0vjRUCYwenobEg==', 'ocTHpoaMrCFByaVl18kdYQ=='),
(48, 10, 'uj9NcI79A+D3moVD/rZlhw==', '4xDo4ykWOuzjdpkaW+7MRQ=='),
(49, 22, 'kz1Npl2RiNKDCPpjcEH6Zg==', 'XDnP5laYBb/ZBl6dQQg4qg=='),
(50, 13, 'Cl4Nxq8bbOBzpxOmjor35A==', '7gTp74ppFqaGwa5UN4NAZQ=='),
(51, 13, '28E8argJqopA+uThNVfFgw==', '13+AYkZcKDQeAw5zb16B9A=='),
(52, 23, 'EbbhGavnpYd2xzzm9tUEug==', 'f2ivhNiTO/dk8+9k2ldVRg=='),
(53, 10, 'i6cPHVkEzazp2FQ7uLpJWw==', 'vDIHmui7N7T+2f0jTdv6SQ=='),
(54, 11, '6yVTLLT6bH5D17v7sozZvA==', 'mbLvxpBOu/Rq5jC1+5EPOQ=='),
(55, 7, 'LyuliBmtOYf25k9z6YKRGA==', '3fPiTrnBZ/blU4J17QcJ4A=='),
(56, 20, '28AiqfcIclOAngAjCy077w==', 'DVdrMvLI6z3hGO+JxqqN9w=='),
(57, 10, 'oY40DocrXqA4TW/4+/wlWA==', 'hi/so882+4cGX2fey9stHg=='),
(58, 20, 'c2nBO7UNcTdJI4C6u5EBUA==', '0QsrRz0tML7cQyiH0e9W4g=='),
(59, 17, '7ZsUNGvmv2MpKBtFoqlmoA==', 'GKGVaqanbmxtUaJoM7KNqw=='),
(60, 12, 'SrxSVMFx8ZUP8C41TEp85A==', '6uSWtt7qb1UlOU8BvhM1vg=='),
(61, 3, 'FW43vhGNvLCDog+djMJOKQ==', 'TdFfODQemlkIH7DPZeH/lg=='),
(62, 3, '1rULxq+UK++Sh3v8RWZLmQ==', 'TdFfODQemlkIH7DPZeH/lg=='),
(63, 10, 'CHOXNUTSwJinxJWUQK11mA==', 'USIhlr2kuEPc5hvuFuf1oQ=='),
(64, 20, 'LwDwhwfXvxqoo8PU3vXbVA==', 'aABL0JyQYXmQtIrzqrsZTg=='),
(65, 12, '5ncpW1mAVcYgvGwGTjqO2g==', '/JNg1yGUMcF1jcPBzXzwfQ=='),
(66, 13, 'cHTBxROEQELMZARu06eadA==', 'jnWvRco1UbZ5B+UCxHKivw=='),
(67, 14, 'HrBAKK6FumT+4Ce7zOijWg==', 'GmBsbozcd6kBLNefuZvZZQ=='),
(68, 11, 'vkT99WaOLevEvRi/y8uDQg==', 'Ax+YEIvSRuq+EHy8O8sOjg=='),
(69, 11, 'CSDgIDSQU6bxwR2xGzqGhQ==', 'N4J+/kD2GjgpqFj9nyUqPw=='),
(70, 23, '4zRFlTRC6ix77putrXs+zA==', 'lpafPFMi/81rMafsJQuD4A=='),
(71, 23, '4zRFlTRC6ix77putrXs+zA==', 'f33D5R4doODfWfFKFwBgCA=='),
(72, 7, '+h4v2iab1Xny8RZKN5Vttg==', 'Gvi/xSEvzQNxZ9Gs090U2Q=='),
(73, 13, '5ncpW1mAVcYgvGwGTjqO2g==', 'r9/8OTCA+nPRxFTCQVlkrQ=='),
(74, 15, '5ncpW1mAVcYgvGwGTjqO2g==', '7RHTTqNR6yFsFL7QHqYffg=='),
(75, 3, 'tYAQ3tjQq8Hw8hdCpM8djw==', 'i/g2KedA0Ff7Z8lErtygwA=='),
(76, 10, 'ku+nYCYd1xPHzmp9MGgRVA==', 'x1Ucv5sH6J4MGQy+NQSXwg=='),
(77, 12, 'ZkrObvawr+NYPvIEmbVTtQ==', '3l5j6h+dYB0uE09jP/5z8g=='),
(78, 7, 'WVptu83DJK+wtQvZ2AQa4Q==', '6cu5/LxN9ZSi4qtOGekmSw=='),
(79, 11, 'QtGqP9d4wYrUMZx8wRp7rw==', '14sd0guu9vynMduv3AFpNQ=='),
(80, 8, 'Z924w52aV6s5GMUbhcrK/w==', 'FYDmYKNb2dBtrr18PtadGg=='),
(81, 3, 'LwDwhwfXvxqoo8PU3vXbVA==', 'mmGRSejO7VHz6rgPvqxbTA=='),
(82, 11, 'Oz9SuUF6SdbBBlS1F+BNDw==', 'R6Es/HXPUrewj1PrLMQlGg=='),
(83, 20, 'ZkrObvawr+NYPvIEmbVTtQ==', 'T9N2Ea+PWA6QAoqTwCmHrw=='),
(84, 12, 'OfVQ5NOSXolDPztMU8nThA==', 'FWIWWQdfh1NI9rW+bLkcFw=='),
(85, 3, 'WM6GjT2bukSTZuStQbH6Wg==', 'd57uXzacgneDYOVmDeycxA=='),
(86, 18, '0+owUPWMCnt26kbzrkf8HA==', 'Lw+xKKffRl0oLnVdBs+F0w=='),
(87, 13, 'Xg2S13kNIFdrgOKtSvk+Hg==', 'YFfx5or34Q+bhhlixn3ykA=='),
(88, 14, 'xq1ivvrH6ZpKWPSixCPpUA==', 'hYhCqkaB29sfGAH5Vb1AJg=='),
(89, 12, 'sX7mp6oZNftYHkRiuI6SpQ==', 'YDneuEDFrab6SB41dgw1qg=='),
(90, 11, '7onhceHFXzfEg0H6eSR9Ig==', 'k0n6HoDf01ecnMjgyFB2KA=='),
(91, 21, '8BjRoTsybGBMS6BdJvXENw==', '0J8oZC1TgT08voCjTTIYuQ=='),
(92, 15, 'X4CnjGJE4HfvCHJzpmcdPA==', 'V4/7RpAgN1+bdhTC5YMAZg=='),
(93, 19, 'vkT99WaOLevEvRi/y8uDQg==', 'RRL5VDL5UC/TevlqPovLGQ=='),
(94, 19, '/0ciGyN8z/vfCT0SSNqKxg==', 'uSG3U/IdKvtw0HmG9tIMmg=='),
(95, 11, 'v6MNmxC39xQlCV3cMaxl7g==', '2iGn6HXAncMJoxQayfNExg=='),
(96, 11, '63XvbZ1vCaWpnHNzyDD3OA==', 'uHaZWgY8FeAqq49KW7Bjtg=='),
(97, 21, '/XML+0ENhhcVKM10arPN8g==', 'MRb9LqJJ0CDMj0r4xfQRrg=='),
(98, 16, '343BI1O9TWoQbfCWfkz2qA==', 'suuHJ/q4mlyeNytMLwYJOQ=='),
(99, 12, '4n9lDETCLOob16BX8HNtlA==', 'BOPDuqizthOL7tptDxmM0Q=='),
(100, 12, 'LkNS369oBvNegzXkBEYpKA==', 'aFpkHgRt0MGbq1h9pRpHIw=='),
(101, 13, '8omhejpD2g25qYb1HxmcKg==', '71n+3xEyRCfb2D0cAHp35g=='),
(102, 13, 'k/EcYFOvKM7XidrZO2IwaQ==', '7j1U9/bUU4kRDfXWSps/PA=='),
(103, 12, 's5wo33Likux9rQBSXzB+ow==', 'QWM1C0kSw9PfSJOHycVpDw=='),
(104, 3, 'Sb1KTZe8dhLpAfOHUPsWYA==', 'knK9gVMgEPNh/PdKFKVQRg=='),
(105, 19, 'R5xptp1/QccqPqoGi7RBvw==', 'ZlolnTnQMm5QtyXnYGNuww=='),
(106, 19, 'xq1ivvrH6ZpKWPSixCPpUA==', 'ZlolnTnQMm5QtyXnYGNuww=='),
(107, 17, '/kW9J0jm8lIMeH0vUm8Idg==', 'dQTVFUkIoD7s+9SqADbB2g=='),
(108, 21, 'twdN5E4D7p/9AUW7SjfnvQ==', 'kCUSXcXv5gcd1O+2k/EFcg=='),
(109, 13, '/g2aohIJU1OViRNnByIFiA==', 'I/cS1PowK6uea2UZGUXrHg=='),
(110, 3, 'Lw+xKKffRl0oLnVdBs+F0w==', 'ndlVi4fioEqRwKwFacqYUQ=='),
(111, 3, 'TZYdEtJ/EcK4oBR/BiXAgw==', 'ndlVi4fioEqRwKwFacqYUQ=='),
(112, 9, 'Nt2IM4Kqf//Q6gFRGlnifQ==', 'jI5UkqDCGqkDH4fMvi7+DA=='),
(113, 9, '1/b82qMuJI9m/Dw1B4k91w==', 'jI5UkqDCGqkDH4fMvi7+DA=='),
(114, 7, 'ifq77B7qNpuXv66Ahxu4DA==', 'rjHuORB6I6HVEENz3bq/Ag=='),
(115, 15, 'iyuNee0FHG9C59HqqMQUHw==', 'Cz5bL2p5ZoeLAFsnriaD0A=='),
(116, 9, '5ncpW1mAVcYgvGwGTjqO2g==', 'biPuYtW96Df+3FKa0+Vbmg=='),
(117, 13, 'gmKxVNQAWVC9ajOHjyq15g==', '1Iul7yaijrhJukptn0IbCQ=='),
(118, 16, 'jbmUL4n+9kgRMuDox9iqYw==', 'LZ2WnxBitGojzk5F5d2AAg=='),
(119, 19, 'wufgxVSkUPMVjfKRtdW53Q==', 'WbFTQqI0t2JnbTJV5tPwXQ=='),
(120, 17, '5ncpW1mAVcYgvGwGTjqO2g==', 'GxzDAvoW3bmmNOiX732qtA=='),
(121, 10, 'hdT1Bz406rJzknF8boa4lw==', 'ZkrObvawr+NYPvIEmbVTtQ=='),
(122, 16, '0UABtL1R7wWHSloafUgPAQ==', 'EGzIxwTNk3rVCSjI4LhfNA=='),
(123, 8, 'J0WpZRiCiewaV1PVFiRHpw==', 'b95M+jCyi1it11wjJLZKnw=='),
(124, 9, 'u/4g2F8yXBoV7PapnUDbfw==', 'G+2RthM9B4nF+PP1pLqI2g=='),
(125, 3, 'S0EEcONkXVwrvTLbJncLxA==', 'TR4vCr4Um++TPPkwWvqSPQ=='),
(126, 12, 'WZLwHxcCE3Zk3YLXTDCNXg==', 'Vazum3ZJsuaT8tladAkFnw=='),
(127, 8, 'y/vNEXzVUJFB74GGiIQvjQ==', '5wfRGtuGndjd8+FPLUFg1Q=='),
(128, 11, 'IM3pLgWcolvB0o2Tt8an9g==', 'HHDLBV7i1h9wXboxtfEAUA=='),
(129, 3, 'X4CnjGJE4HfvCHJzpmcdPA==', 'Q+vBZ+y2Br96AsR+JFuSeg=='),
(130, 13, '8BjRoTsybGBMS6BdJvXENw==', 'Q+vBZ+y2Br96AsR+JFuSeg=='),
(131, 19, 'DiN+Z8l2tUB7jCxqtu+TVA==', '9+5OYtin1GX+2/3mdyXBPg=='),
(132, 13, '7onhceHFXzfEg0H6eSR9Ig==', 'guwkEDxpzJe1vp1eJGbySA=='),
(133, 16, 'hGvPopmC4/6Fb5ZI79G0aQ==', 'WCAwZ8jKrujo44XhoBSqHQ=='),
(134, 10, '0bOaOGl5y9oGxKn1xipbGg==', '965XmKqWaZhh1r78rvyyUQ=='),
(135, 12, '/0ciGyN8z/vfCT0SSNqKxg==', '0NpdrrOU35605DZH7yLpUQ=='),
(136, 10, '9cNVrw3OZoPtzhyMh2eq/g==', '6s3BGG0NuSKU5uBiSEeErw=='),
(137, 11, 'PAIYDpM9jEBe7OoGmZMBmg==', 'AKZkye4pYq8oThTMCuaQWg=='),
(138, 18, 'QtGqP9d4wYrUMZx8wRp7rw==', 'kb6uCMfKsOZlXaAenholYw=='),
(139, 18, 'QaAaVrIVL8FWnml3HJyc9w==', 'pFKH+IlrpQ/MgFWSzqFrMw=='),
(140, 18, 'iyuNee0FHG9C59HqqMQUHw==', 'pFKH+IlrpQ/MgFWSzqFrMw=='),
(141, 23, '3tUjNaQU1LOOWUdIpuHaCw==', 'W2MGitu05xj9oS7v4IF2wg=='),
(142, 17, 'pcqBbGLTmSV+37JuwPZRQg==', 'yeg/+bqZYmhYOxHOs52GPw=='),
(143, 13, '5nibwWa9IvxpLi/3pLBcyg==', 'idTSm3yhK/Kni7NiAk26ZQ=='),
(144, 10, 'BEpqfXveTe0OwJM/o7iWqQ==', 't+m/4h8yR6CFz8EwLJLVOA=='),
(145, 12, 'x9JDIv7BFs3HASqO0uIhdg==', 'r3uS9fGyGsAu7pHJCdHo0w=='),
(146, 3, 'GFyi6cKCKlcavyKP493Rng==', 'm7h/2A4KfC9pnBPYo1EG4Q=='),
(147, 13, 'ciaDC9UxrcWnIY182qdxyg==', '5f4uWBkpfFd/HxrMLYkLfg=='),
(148, 23, 'sRRKqIh6y/OphrAt1BLTkA==', 'UR0FfaLJSBFfr6WPg2iBjA=='),
(149, 9, 'X4CnjGJE4HfvCHJzpmcdPA==', 'r7CkU0IpHV3VT68uN0bZcg=='),
(150, 3, 'cHTBxROEQELMZARu06eadA==', 'Z4N4e3FvflYHZlAalpAELw=='),
(151, 15, 'cnp5CjOtuYKQWJord6OeBQ==', 'z+1++7R/pGCysMCmKuv6Iw=='),
(152, 11, '6EIbmgaMWYxCOllb/8zqnQ==', 'z+1++7R/pGCysMCmKuv6Iw=='),
(153, 11, 'FvnLzx+fFSRSbGbzyAdrgA==', 'z+1++7R/pGCysMCmKuv6Iw=='),
(154, 11, 'Z924w52aV6s5GMUbhcrK/w==', 'kqseLXdWsLYv5FWbCGnvuQ=='),
(155, 8, '9f2e45BeQURnEHlxoZtFvg==', 'QtGqP9d4wYrUMZx8wRp7rw=='),
(156, 14, 'HHDLBV7i1h9wXboxtfEAUA==', 'QtGqP9d4wYrUMZx8wRp7rw=='),
(157, 13, 'mIW1k5E/2rmIiwTRwxVIbQ==', 'gBzTc9d8J7vJpm9sHBU/eQ=='),
(158, 16, 'zayt2VDxpI3aE7WnaHcZDA==', 'Momsy8opOdrX4eGyyyHMeg=='),
(159, 16, 'ZkrObvawr+NYPvIEmbVTtQ==', 'l9bFaSO6FSQGe1rmMel29Q=='),
(160, 20, 'IkxkFfvHOKhoISEUhFHTTQ==', 'Mlv9OL0ZLMgCcs7K28xlQA=='),
(161, 23, '7cI0/3KO0VL/rv23/T1w0A==', 'boG7NTBCy8hiqVkZSZ9+Jw=='),
(162, 10, 'VsT/E2KbwYfNtJTTXL2wmw==', 'TuXhLoGq6NwMYwHqkZfNxw=='),
(163, 10, '28E8argJqopA+uThNVfFgw==', 'TuXhLoGq6NwMYwHqkZfNxw=='),
(164, 11, 'fXg1Me+q94wXds137sF31w==', 'tyVsIhBLEBUnPuiY360w8A=='),
(165, 15, 'JX+me2pfC30JqVFvuVFQsg==', 'oELQqF1us/6jFRZEl4OG9A=='),
(166, 10, 's5wo33Likux9rQBSXzB+ow==', 'VaYuTba3LHL0kOffq83m+w=='),
(167, 10, '7onhceHFXzfEg0H6eSR9Ig==', 't+m/4h8yR6CFz8EwLJLVOA=='),
(168, 24, 'hdT1Bz406rJzknF8boa4lw==', 'c/QmbYWKIjTPvaulmB242Q==');

-- --------------------------------------------------------

--
-- Structure de la table `licencie_categorie`
--

CREATE TABLE `licencie_categorie` (
  `idlicencie_categorie` int(10) NOT NULL AUTO_INCREMENT,
  `idcategorie` int(10) NOT NULL,
  `idlicencie` int(10) NOT NULL,
  `numero_poule` int(1) NOT NULL,
  `position_poule` int(1) NOT NULL,
  `resultat_combat` int(1) NOT NULL DEFAULT '0',
  `point_combat` int(2) NOT NULL DEFAULT '0',
  `idcompetition` int(10) NOT NULL,
  PRIMARY KEY (`idlicencie_categorie`),
  UNIQUE KEY `idcategorie` (`idcategorie`,`idlicencie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Contenu de la table `licencie_categorie`
--

INSERT INTO `licencie_categorie` (`idlicencie_categorie`, `idcategorie`, `idlicencie`, `numero_poule`, `position_poule`, `resultat_combat`, `point_combat`, `idcompetition`) VALUES
(68, 13, 37, 2, 2, 0, 0, 0),
(69, 13, 54, 3, 1, 0, 0, 0),
(70, 13, 55, 3, 2, 0, 0, 0),
(71, 13, 56, 2, 3, 0, 0, 0),
(72, 13, 57, 3, 3, 0, 0, 0),
(73, 13, 160, 3, 4, 0, 0, 0),
(74, 13, 161, 2, 1, 0, 0, 0),
(75, 13, 162, 1, 3, 0, 0, 0),
(76, 13, 163, 1, 2, 0, 0, 0),
(77, 13, 164, 1, 1, 0, 0, 0),
(78, 10, 68, 1, 1, 0, 0, 0),
(79, 10, 128, 7, 3, 0, 0, 0),
(80, 10, 90, 4, 1, 0, 0, 0),
(81, 10, 120, 5, 2, 0, 0, 0),
(82, 10, 141, 7, 4, 0, 0, 0),
(83, 10, 168, 1, 3, 0, 0, 0),
(84, 10, 39, 1, 2, 0, 0, 0),
(85, 10, 72, 8, 2, 0, 0, 0),
(86, 10, 58, 3, 1, 0, 0, 0),
(87, 10, 37, 2, 3, 0, 0, 0),
(88, 10, 157, 4, 2, 0, 0, 0),
(89, 10, 36, 7, 2, 0, 0, 0),
(90, 10, 42, 2, 1, 0, 0, 0),
(91, 10, 130, 5, 1, 0, 0, 0),
(93, 10, 66, 6, 1, 0, 0, 0),
(94, 10, 109, 7, 1, 0, 0, 0),
(95, 10, 41, 6, 2, 0, 0, 0),
(96, 10, 88, 5, 3, 0, 0, 0),
(97, 10, 48, 8, 1, 0, 0, 0),
(98, 10, 53, 8, 4, 0, 0, 0),
(99, 10, 76, 3, 3, 0, 0, 0),
(100, 10, 163, 4, 3, 0, 0, 0),
(101, 10, 167, 8, 3, 0, 0, 0),
(102, 10, 166, 3, 2, 0, 0, 0),
(103, 10, 34, 6, 3, 0, 0, 0),
(104, 10, 165, 2, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE `log` (
  `idlog` int(10) NOT NULL AUTO_INCREMENT,
  `typelog` varchar(50) NOT NULL,
  `texte` text NOT NULL,
  `datelog` datetime NOT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=381 ;

--
-- Contenu de la table `log`
--

INSERT INTO `log` (`idlog`, `typelog`, `texte`, `datelog`) VALUES
(1, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SZogQhs238qt9nDZTyGBi0VyVZULRzLw7L+9RnLKByHFlFYi4RMH9JJg3lQ9TVvJf6EO4is6dR5VA/PuobtZN2k=', '2014-02-26 23:43:51'),
(2, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SZogQhs238qt9nDZTyGBi0VyVZULRzLw7L+9RnLKByHFmkPsoAjvPpbsAhsRV9uO/E9KO4AXSR7npi1MSmC2wn0=', '2014-02-26 23:43:51'),
(3, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SSrPE5Wl1IacRHsRD+Q13Ce+YHvHDB/Q7mgb80DC/BbtNaQ3xmd9CSCU+ufJTPM3moJkSAsY8zyc2sd/dFcuPCc=', '2014-02-26 23:43:51'),
(4, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SSrPE5Wl1IacRHsRD+Q13CfGcKf4gy0R73auzNSjLPKZlv+cXrUJypi6FBGyAAO++OlkXXjQ7Or1epbxZReTRok=', '2014-02-26 23:43:51'),
(5, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1ScOzlDWXbc5BVeDnZjg7ZGsO5bR4l4/OcpQqVxv2nFrrn7wdWQUCOtKAuizUdzGzQJODQI6qk6ijAfT+WftUpeU=', '2014-02-26 23:43:51'),
(6, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SdhkdSu1jP415sgbd7yrUTjLj2BtJiAUhq2mJKctSBRYVchxwe8lHh645Gudx4HZZYu9EZoCiUcJYGVKunWMIOQ=', '2014-02-26 23:43:52'),
(7, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1Sfs9XxdnR7/nDJ1vRSLJqNJOaEnByfYSLLNKpvLg02nOYZIDU+l79VZSICalFKESxX6COj15Lm1jnwcUqPPRmGE=', '2014-02-26 23:43:52'),
(8, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1Se07ckKqlZGtQb8jb5U2W5mjv8aa8rB1CBRJ7zXwm4GnlGW9eiceGVFWJQOqEjYTObxfTwCC3SnxW8gqHc+NvqY=', '2014-02-26 23:43:52'),
(9, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SZogQhs238qt9nDZTyGBi0VyVZULRzLw7L+9RnLKByHFinCFqWlQs2SnJN2PD1W9fXtNMm7wxXXzidDmVQ03itI=', '2014-02-26 23:43:52'),
(10, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1Se07ckKqlZGtQb8jb5U2W5mjv8aa8rB1CBRJ7zXwm4Gn9FsMigzU7lwnUfHHYsbcK2fHx3n4J7+/QhD5dknPrl8=', '2014-02-26 23:43:52'),
(11, 'Erreur', '+KvLoLFSp63XbFrK90C4bOeJ77xYZ/61odNWN3FI1pKqxkuO5UFEL21ctFpTv2k0iP/KnGhbzoqhoYt7LeYbbKGupFC0Wr/Us9qz+Ll1PJ+GLwv2JGx6VIKDII0ZBmjM1am5AcUGOK5Zdm6fYjCxXA==', '2014-02-26 23:43:53'),
(12, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SS0hO9W/+S+yBZjNkHk79wV5TBcOx6o1KgiFCr1zgOarOWjHrr3ASUmIz0nPCYj8uw==', '2014-02-26 23:46:29'),
(13, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SWi8U1xzXZzTv3t3BxMFnYHom5YZbtAHyOX7lGZa7/r1RUwI9AZcavxlTKc7C3PNIQ==', '2014-02-26 23:46:30'),
(14, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SZuq7a6BbYjInT5aUUq1Q5LJBucaus80vfATS3fI/YeUIE+Pdq45CTTd2v8+shoYqQ==', '2014-02-26 23:46:30'),
(15, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SUpeWJQp4jA0qY4nRU1O+I6kSX6OPq9mLLGed8Oypdox6VcUG/ht49B5eOYy4c8bMA==', '2014-02-26 23:46:30'),
(16, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SWEe76OFN/jHg1loi6c6s+Nrj8fTjqzWwcCq8k/7L9uOtZnV+CdAeu/9M0HcBhQqyA==', '2014-02-26 23:46:30'),
(17, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SQPwEikhnIIgSrKmBk6Om0IHufUK+5fBeI7uGVe/cdJ923lElTlM5zxTiHn4GwmMKw==', '2014-02-26 23:46:30'),
(18, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SegDyitqJXPfBNenHP2hUdrVCQoY0UiIrgse6Be4PDiHza6VwVx7ZRbMmPIC/ug7rg==', '2014-02-26 23:46:30'),
(19, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SZTpvQbfcCPOKQ/LqAqr+bopnxseJhgPAluUP7+6F/Mi1cZhvAMHcwDqgrWVsG0Jqg==', '2014-02-26 23:46:31'),
(20, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1ScHiH+5n8OxXMYSARCnWmTS7SaxX+fAlq6NE032kxouo1g+SPofnfEnTLcMpQg0y1w==', '2014-02-26 23:46:31'),
(21, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SVXeS5nToI1o3YoeMAiWdMOhQmPs9DIoqg14p/BfzwUnTsiOIUVJSePuDRScBv0pfA==', '2014-02-26 23:46:31'),
(22, 'Erreur', '+KvLoLFSp63XbFrK90C4bOeJ77xYZ/61odNWN3FI1pKqxkuO5UFEL21ctFpTv2k0iP/KnGhbzoqhoYt7LeYbbKGupFC0Wr/Us9qz+Ll1PJ+GLwv2JGx6VIKDII0ZBmjM1am5AcUGOK5Zdm6fYjCxXA==', '2014-02-26 23:46:31'),
(23, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SVXeS5nToI1o3YoeMAiWdMM8hYCiesiWv0CyDTymVPagj+kzju2Vt9xDvNZpqOONUg==', '2014-02-26 23:46:59'),
(24, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SegDyitqJXPfBNenHP2hUdrCATNf1KUNaJW06ouYhctzZNCqtHW2X7DGAoXdf3wQMw==', '2014-02-26 23:46:59'),
(25, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SUpeWJQp4jA0qY4nRU1O+I6cUkkXZMbkCS4tm5qolgcZPvjg58ysovppYhIW0s/LSQ==', '2014-02-26 23:46:59'),
(26, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SZuq7a6BbYjInT5aUUq1Q5Lufrp2JIcgB4qAODWnWfsry/OJMT3m0v61eSeTxgmt/A==', '2014-02-26 23:47:00'),
(27, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SWi8U1xzXZzTv3t3BxMFnYGRrgkqpypIypn93kMUY5xfVa19JL5fDBQiBeqoCBWX0Q==', '2014-02-26 23:47:00'),
(28, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SZTpvQbfcCPOKQ/LqAqr+brXY67+mNTKlDJBmN/c7kb0de5bVZ2HjHweDdG6kje2xA==', '2014-02-26 23:47:00'),
(29, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SQPwEikhnIIgSrKmBk6Om0L3JeHV4/TQJH7zOVbEuI8dfcSuuamb9N7281QxMcFK3w==', '2014-02-26 23:47:00'),
(30, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SWEe76OFN/jHg1loi6c6s+P+hnCO0TIWLIKILKjl5KKpkjfK2jYoWJprMWZYxZNf9g==', '2014-02-26 23:47:00'),
(31, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1SS0hO9W/+S+yBZjNkHk79wWNaVZXP5Uhr3tgbVLNVPTM9YXR4GcU3dAEaQrAx4CvaQ==', '2014-02-26 23:47:00'),
(32, 'Erreur', 'A16GNeFMtAbTZs2fWuOE2C96+iOoELJN9KwrH/7U7USlAyXVOYTFzPGnwjOwXFT70MNPeTTciEVK6hEraO0e4rXbEjhAikYhJJK372SBM+rpYLuFcSTinfUYRw8x8AD9FY7zFqvHIKwpzBVRTF1e0nzfiabNK9m/nkCTGBCNSW36MbhenTMjOn5GpGe8ecTgfA1gkvelAeVcUqTkqA/DMcbUtEMEZ6CY4gZ8kljtIp7bZbCtoksZtkUu64Xmq9+PmOUDVt38v1Q/wew2Peo1ScHiH+5n8OxXMYSARCnWmTS7SaxX+fAlq6NE032kxouotnqafC5Nb5G27RDeCH1Fnw==', '2014-02-26 23:47:01'),
(33, 'Erreur', '+KvLoLFSp63XbFrK90C4bOeJ77xYZ/61odNWN3FI1pKqxkuO5UFEL21ctFpTv2k0iP/KnGhbzoqhoYt7LeYbbKGupFC0Wr/Us9qz+Ll1PJ+GLwv2JGx6VIKDII0ZBmjM1am5AcUGOK5Zdm6fYjCxXA==', '2014-02-26 23:47:01'),
(34, 'Information', '95NMe1etHufU2w/J0Gz4ySCamaZOXg9Kyc/ceN5MY/M=', '2014-02-26 23:47:37'),
(35, 'Erreur', '+KvLoLFSp63XbFrK90C4bOeJ77xYZ/61odNWN3FI1pKqxkuO5UFEL21ctFpTv2k0iP/KnGhbzoqhoYt7LeYbbKGupFC0Wr/Us9qz+Ll1PJ+GLwv2JGx6VIKDII0ZBmjM1am5AcUGOK5Zdm6fYjCxXA==', '2014-02-26 23:47:50'),
(36, 'Erreur', 'ofrBcQ+CO6VnMJ3ZpWrxhVoxud9Auxt2er5FJ1Z7uH4Rwgq7T955lDWqTQ0d/NDXixum8pbghZRnggbzskgFilWRJMmlltlP7KAVHuspIxDN/6ur6l8vZVrEzTSoXioGeZwN0zbb2Fzw5GV8Tu+DoXlIcUcGaK/sNjVlC3T4nno=', '2014-02-27 00:11:46'),
(37, 'Erreur', 'ofrBcQ+CO6VnMJ3ZpWrxhVoxud9Auxt2er5FJ1Z7uH4Rwgq7T955lDWqTQ0d/NDXixum8pbghZRnggbzskgFilWRJMmlltlP7KAVHuspIxDN/6ur6l8vZVrEzTSoXioGeZwN0zbb2Fzw5GV8Tu+DoXlIcUcGaK/sNjVlC3T4nno=', '2014-02-27 00:12:30'),
(38, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:08'),
(39, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:08'),
(40, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:08'),
(41, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:08'),
(42, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:08'),
(43, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:08'),
(44, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:08'),
(45, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:09'),
(46, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:09'),
(47, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:09'),
(48, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:09'),
(49, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:09'),
(50, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:54'),
(51, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(52, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(53, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(54, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(55, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(56, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(57, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(58, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(59, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:55'),
(60, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:56'),
(61, 'Erreur', 'cMncs4fJRODLiuVTdq9kAZ4zSw4euiPCx3+K4FPVrALS0Rd3O3pVHQbk2lTQW31Kwi3mDHKjvEfVaiiU1veVA2u9Fyq/HVcI3Vd8ue3Oyudhj9KNwQS3kaHf2SZ+Kq6iG5MUea7eYEpq8VoXZw+xPg==', '2014-03-06 23:26:56'),
(62, 'Erreur', 'UFSF0TEx+cNisSgB2LLTohYRVqNybWW/HF/77YRjfzLslaZapTHQlIKVyubg4YCKjr2ms8u8BMPupfqjQQ3RlXAPud9101GAqrw+v0oel1vODMS4WlbYiqkttXvfAlaDeqJB93EC8vimp9ZAygDGnf0g62Z/GfiKOiZM9Sfc4gJM0MEYYysIi5nv3EvH8H2DqsAlHj5R9YXGgR0lW92XssNaVIrQjtE6MCDD1Mv+Ncu8WiYZ8helQOZO39hgWmJicZOFvb9IdT9EvsVDDW9Du86SfFqsFh+ihJLGCfK3YAMvWioSpxYvivuFNrKI2b/58WGdiFpDjss0T8zXCb7EQ+u2n9AYMUolFfJP675Ydecys3AMQcMwE9Qs9JsAIl0yPz4BAMsgFzpm8li3p235yQ==', '2014-03-08 15:47:27'),
(63, 'Erreur', 'UFSF0TEx+cNisSgB2LLTosrdoip0kDgcB3ejGsga3Ryc00YXsWmMvUXhBxV2d5Uxcez+XHN/dyrWc2Z0N4b7RoaGlSPvmEBHahzZYbKT/uRyEirqMD41B86H66+6Wcc/8iTZoO+yG73lv006LKqFkQ==', '2014-03-08 21:46:45'),
(64, 'Erreur', 'UFSF0TEx+cNisSgB2LLTosrdoip0kDgcB3ejGsga3Ryc00YXsWmMvUXhBxV2d5Uxcez+XHN/dyrWc2Z0N4b7RoaGlSPvmEBHahzZYbKT/uRyEirqMD41B86H66+6Wcc/8iTZoO+yG73lv006LKqFkQ==', '2014-03-08 21:47:13'),
(65, 'Erreur', 'UFSF0TEx+cNisSgB2LLTosrdoip0kDgcB3ejGsga3Ryc00YXsWmMvUXhBxV2d5Uxcez+XHN/dyrWc2Z0N4b7RoaGlSPvmEBHahzZYbKT/uRyEirqMD41B86H66+6Wcc/8iTZoO+yG73lv006LKqFkQ==', '2014-03-08 21:48:22'),
(66, 'Erreur', 'UFSF0TEx+cNisSgB2LLTosrdoip0kDgcB3ejGsga3Ryc00YXsWmMvUXhBxV2d5Uxcez+XHN/dyrWc2Z0N4b7RoaGlSPvmEBHahzZYbKT/uRyEirqMD41B86H66+6Wcc/8iTZoO+yG73lv006LKqFkQ==', '2014-03-08 21:48:24'),
(67, 'Erreur', 'UFSF0TEx+cNisSgB2LLTosrdoip0kDgcB3ejGsga3Ryc00YXsWmMvUXhBxV2d5Uxcez+XHN/dyrWc2Z0N4b7RoaGlSPvmEBHahzZYbKT/uRyEirqMD41B86H66+6Wcc/8iTZoO+yG73lv006LKqFkQ==', '2014-03-08 21:48:38'),
(68, 'Erreur', 'UFSF0TEx+cNisSgB2LLTosrdoip0kDgcB3ejGsga3Ryc00YXsWmMvUXhBxV2d5Uxcez+XHN/dyrWc2Z0N4b7RoaGlSPvmEBHahzZYbKT/uRyEirqMD41B86H66+6Wcc/8iTZoO+yG73lv006LKqFkQ==', '2014-03-08 21:49:05'),
(69, 'Erreur', 'UFSF0TEx+cNisSgB2LLTosrdoip0kDgcB3ejGsga3Ryc00YXsWmMvUXhBxV2d5Uxcez+XHN/dyrWc2Z0N4b7RoaGlSPvmEBHahzZYbKT/uRyEirqMD41B86H66+6Wcc/8iTZoO+yG73lv006LKqFkQ==', '2014-03-08 21:49:15'),
(70, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 22:36:04'),
(71, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 22:36:35'),
(72, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 22:46:00'),
(73, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 22:55:38'),
(74, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwrZLfEXnlSBFGatioAbj1C', '2014-03-08 23:00:52'),
(75, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tz+0yanBmoBFA21Y4rUGX58', '2014-03-08 23:01:12'),
(76, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:03:38'),
(77, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:05:02'),
(78, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwiMoiUo/K9l7/CfwIJURqq', '2014-03-08 23:06:23'),
(79, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tyvsw4ePX2fKUn2rf7AMyWt', '2014-03-08 23:07:03'),
(80, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tz+0yanBmoBFA21Y4rUGX58', '2014-03-08 23:07:42'),
(81, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:08:33'),
(82, 'Information', 'Og2GaeaPju8JGnBpZtZnRmlYBSfceHxq/R9w43H6+EE=', '2014-03-08 23:10:45'),
(83, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:10:45'),
(84, 'Information', '9NtaRy2pDFeJboQUiVbMksHoU2SSyNwzWQqDJMtdRVA=', '2014-03-08 23:16:18'),
(85, 'Information', 'RUJZ2F5Ulgayr3ZJiqfy15My9G6hhkbaYYurcXcQkE0=', '2014-03-08 23:16:18'),
(86, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:16:18'),
(87, 'Information', '9NtaRy2pDFeJboQUiVbMksHoU2SSyNwzWQqDJMtdRVA=', '2014-03-08 23:17:16'),
(88, 'Information', 'rsQRNNHFdiGju/La9h70JDHDiCYY/OII+0OtAHxaW5w=', '2014-03-08 23:17:16'),
(89, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:17:16'),
(90, 'Information', '9NtaRy2pDFeJboQUiVbMksHoU2SSyNwzWQqDJMtdRVA=', '2014-03-08 23:23:31'),
(91, 'Information', 'rsQRNNHFdiGju/La9h70JDHDiCYY/OII+0OtAHxaW5w=', '2014-03-08 23:23:31'),
(92, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:23:31'),
(93, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwJcZTs4A+szYFyLMX6Bx+Q', '2014-03-08 23:24:48'),
(94, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tyvsw4ePX2fKUn2rf7AMyWt', '2014-03-08 23:24:58'),
(95, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzbOk2b9eazKqfASsmZmAvn', '2014-03-08 23:30:13'),
(96, 'Erreur', 'o8/tA8mbtU6xqyOswWfwBxF7Y8dpHYluaV6CsF8NFzGD4Fr5AkPSl7RgllA8DBQZH5/yMQLWC5fwKkkWOs5KXfQy2dIUIb7FSKlTe0l9thRaugS5nj0JbyNb2ymFHKEAGcHi8tfZt294eaOQTuHDuQ==', '2014-03-09 22:38:20'),
(97, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTC+7sZEn3xrjzoExw+TfW5Eqjg9lNQN1JtNSs3xVlpfT0BAH2RsUYvvzTm/I7s2cGrp+9ZtFliq/ulLfONaHFyN+VTlsnnnboh8MTAEABYyi2j+WwuXZqVSKZ1ozbQHDKA==', '2014-03-09 22:38:20'),
(98, 'Erreur', 'o8/tA8mbtU6xqyOswWfwBxF7Y8dpHYluaV6CsF8NFzGD4Fr5AkPSl7RgllA8DBQZH5/yMQLWC5fwKkkWOs5KXfQy2dIUIb7FSKlTe0l9thRaugS5nj0JbyNb2ymFHKEAGcHi8tfZt294eaOQTuHDuQ==', '2014-03-09 22:38:20'),
(99, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTC+7sZEn3xrjzoExw+TfW5Eqjg9lNQN1JtNSs3xVlpfT0BAH2RsUYvvzTm/I7s2cGrp+9ZtFliq/ulLfONaHFyN+VTlsnnnboh8MTAEABYyi2j+WwuXZqVSKZ1ozbQHDKA==', '2014-03-09 22:38:21'),
(100, 'Erreur', 'o8/tA8mbtU6xqyOswWfwBxF7Y8dpHYluaV6CsF8NFzGD4Fr5AkPSl7RgllA8DBQZH5/yMQLWC5fwKkkWOs5KXfQy2dIUIb7FSKlTe0l9thRaugS5nj0JbyNb2ymFHKEAGcHi8tfZt294eaOQTuHDuQ==', '2014-03-09 22:38:21'),
(101, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTC+7sZEn3xrjzoExw+TfW5Eqjg9lNQN1JtNSs3xVlpfT0BAH2RsUYvvzTm/I7s2cGrp+9ZtFliq/ulLfONaHFyN+VTlsnnnboh8MTAEABYyi2j+WwuXZqVSKZ1ozbQHDKA==', '2014-03-09 22:38:21'),
(102, 'Erreur', 'o8/tA8mbtU6xqyOswWfwBxF7Y8dpHYluaV6CsF8NFzGD4Fr5AkPSl7RgllA8DBQZH5/yMQLWC5fwKkkWOs5KXfQy2dIUIb7FSKlTe0l9thRaugS5nj0JbyNb2ymFHKEAGcHi8tfZt294eaOQTuHDuQ==', '2014-03-09 22:41:30'),
(103, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTC+7sZEn3xrjzoExw+TfW5Eqjg9lNQN1JtNSs3xVlpfT0BAH2RsUYvvzTm/I7s2cGrp+9ZtFliq/ulLfONaHFyN+VTlsnnnboh8MTAEABYyi2j+WwuXZqVSKZ1ozbQHDKA==', '2014-03-09 22:41:30'),
(104, 'Erreur', 'o8/tA8mbtU6xqyOswWfwBxF7Y8dpHYluaV6CsF8NFzGD4Fr5AkPSl7RgllA8DBQZH5/yMQLWC5fwKkkWOs5KXfQy2dIUIb7FSKlTe0l9thRaugS5nj0JbyNb2ymFHKEAGcHi8tfZt294eaOQTuHDuQ==', '2014-03-09 22:41:30'),
(105, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTC+7sZEn3xrjzoExw+TfW5Eqjg9lNQN1JtNSs3xVlpfT0BAH2RsUYvvzTm/I7s2cGrp+9ZtFliq/ulLfONaHFyN+VTlsnnnboh8MTAEABYyi2j+WwuXZqVSKZ1ozbQHDKA==', '2014-03-09 22:41:30'),
(106, 'Erreur', 'o8/tA8mbtU6xqyOswWfwBxF7Y8dpHYluaV6CsF8NFzGD4Fr5AkPSl7RgllA8DBQZH5/yMQLWC5fwKkkWOs5KXfQy2dIUIb7FSKlTe0l9thRaugS5nj0JbyNb2ymFHKEAGcHi8tfZt294eaOQTuHDuQ==', '2014-03-09 22:41:30'),
(107, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTC+7sZEn3xrjzoExw+TfW5Eqjg9lNQN1JtNSs3xVlpfT0BAH2RsUYvvzTm/I7s2cGrp+9ZtFliq/ulLfONaHFyN+VTlsnnnboh8MTAEABYyi2j+WwuXZqVSKZ1ozbQHDKA==', '2014-03-09 22:41:30'),
(108, 'Erreur', 'tTeSLyyby4FvtEzWQhHOAXTTr6w32u9TfPmzTbirEBu3Lf25iIJtl61MtdTyunnVGPwAIKdp6naeYhCaj+8O3IQ6u+hiY58Rchx9ZOiy4M0Qlb0msIcNTJTM6E3DiO/mB03nz3SaD7B3+W8oW8OcA66hi06QZrtnXyKCGtIkwxw=', '2014-03-10 21:45:27'),
(109, 'Erreur', 'ofrBcQ+CO6VnMJ3ZpWrxhVlAhN1lVW9ZukrPotl7qZlfl3d0+1xsLLgL3191NfY8FPA69tmRc+HAw4PrabiIQtoFuokHgIvC8p1Ol5h2wqnvhl8ZfuctOSsmw7vxHJWaG3NPXiJkWsw256d/MsSEvdKUxKyyySQSqoZ4rp9nNDNq8njnLe5TAAfx4kUPvCPTeVpQ8CKwPKLk/uflvPxkC+3+LYHlz6yRFEDLfezWnWoUiXL7u8EqHEe/pfOIYxcxpPRf287zuZ3/s8HniFISYFnjxlaZvvZSdudSSf6c/yai+iu6qkmWm3YrcOYoXOZMbGzYaG8c1WtrbjQKyx2DsfYjefFZHzuTXHQ1txW8+hz7z6MbB4tU2/6aMafyU+5BnGbXhB57HJTSbKrZ2342c8bR1wKgc1Pjwf8X1b+cY7Q=', '2014-03-10 22:00:58'),
(110, 'Erreur', 'ofrBcQ+CO6VnMJ3ZpWrxhVlAhN1lVW9ZukrPotl7qZlfl3d0+1xsLLgL3191NfY8FPA69tmRc+HAw4PrabiIQtoFuokHgIvC8p1Ol5h2wqnvhl8ZfuctOSsmw7vxHJWaG3NPXiJkWsw256d/MsSEvdKUxKyyySQSqoZ4rp9nNDNq8njnLe5TAAfx4kUPvCPTeVpQ8CKwPKLk/uflvPxkC+3+LYHlz6yRFEDLfezWnWoUiXL7u8EqHEe/pfOIYxcxpPRf287zuZ3/s8HniFISYFnjxlaZvvZSdudSSf6c/yai+iu6qkmWm3YrcOYoXOZMbGzYaG8c1WtrbjQKyx2DsfYjefFZHzuTXHQ1txW8+hz7z6MbB4tU2/6aMafyU+5BnGbXhB57HJTSbKrZ2342c8bR1wKgc1Pjwf8X1b+cY7Q=', '2014-03-10 22:01:06'),
(111, 'Erreur', 'ofrBcQ+CO6VnMJ3ZpWrxhUwVVO0Uz/ul68CIr3zpDunEVkMYjVuJvf5qfSAYF8vgOhEz+ArdE625pCQ/dYCBdd0IeWhOOKSvw+ZrduWxsGe1kpls8Nyfl+Eo92Lw7n0BGGYH39Vxp7vqX5Oty38V3KnQTR/KDy2qmscHs3PKdUoxapN9v9tnf63Gz7h75ru8pv+ZzvWa1IMKIhx89nxx7A==', '2014-03-10 22:02:16'),
(112, 'Erreur', 'ofrBcQ+CO6VnMJ3ZpWrxhUwVVO0Uz/ul68CIr3zpDunEVkMYjVuJvf5qfSAYF8vgOhEz+ArdE625pCQ/dYCBdd0IeWhOOKSvw+ZrduWxsGe1kpls8Nyfl+Eo92Lw7n0BGGYH39Vxp7vqX5Oty38V3KnQTR/KDy2qmscHs3PKdUoxapN9v9tnf63Gz7h75ru8pv+ZzvWa1IMKIhx89nxx7A==', '2014-03-10 22:02:59'),
(113, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:39:35'),
(114, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:39:35'),
(115, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:39:35'),
(116, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:46:32'),
(117, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:46:32'),
(118, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:46:32'),
(119, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:51:07'),
(120, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:51:07'),
(121, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:51:07'),
(122, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:59:52'),
(123, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:59:52'),
(124, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 22:59:53'),
(125, 'Erreur', 'cDuQ2iiFn/IKrQzTFxSE7fYak9G5+U4Zd6pYL3X2SXyCw+3TlE9g1P0octwu9UstDPdRmzuU/YrMfe/3JfgA3A0kkCVya1WHg52AEhgz91ssP1WWalKYmAJH4L+sXe5YsJbyiJIkG+jUvWyxp1hEGDnwWRFQ2SDAq7SFNe3E2F0=', '2014-03-10 23:03:04'),
(126, 'Information', 'KZbw6H23HhGp0J7pOt9gY1k6swS6aRfb7KRfWFG8SCURotG918Buhi6Hbr9BhN/sdFFrCmfb1U6m9B38kmUF8A==', '2014-03-10 23:03:04'),
(127, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 23:03:04'),
(128, 'Erreur', 'cDuQ2iiFn/IKrQzTFxSE7fYak9G5+U4Zd6pYL3X2SXyCw+3TlE9g1P0octwu9UstDPdRmzuU/YrMfe/3JfgA3A0kkCVya1WHg52AEhgz91tQ1miCPhb4URz4YF6zpjIunx4QA+DfB2xnBtKMBz5xS2DYMOGjih0CWB2Dh6PgX9A=', '2014-03-10 23:03:04'),
(129, 'Information', 'KZbw6H23HhGp0J7pOt9gY1k6swS6aRfb7KRfWFG8SCURotG918Buhi6Hbr9BhN/sdFFrCmfb1U6m9B38kmUF8A==', '2014-03-10 23:03:04'),
(130, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 23:06:06'),
(131, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 23:06:06'),
(132, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-10 23:06:06'),
(133, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-10 23:06:23'),
(134, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-10 23:06:23'),
(135, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-10 23:06:23'),
(136, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-10 23:06:23'),
(137, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-10 23:06:30'),
(138, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-10 23:06:30'),
(139, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-10 23:06:30'),
(140, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzbOk2b9eazKqfASsmZmAvn', '2014-03-10 23:19:53'),
(141, 'Information', '6pmR9AygH6aibnKcJdk65TQv9Re6uU+QkjPFBogVunU=', '2014-03-14 22:56:01'),
(142, 'Information', 'Oy+XvnQv5lMR+dSj/le5og==', '2014-03-14 22:58:32'),
(143, 'Information', 'SvPNO7SoH0Ss+I02mcQWVc7BaJo/rOd2Kma28sZOQZRt88Zvp6wIbkFj7g5Va7kA', '2014-03-14 22:58:32'),
(144, 'Information', 'Oy+XvnQv5lMR+dSj/le5og==', '2014-03-14 22:59:10'),
(145, 'Information', 'SvPNO7SoH0Ss+I02mcQWVc7BaJo/rOd2Kma28sZOQZRt88Zvp6wIbkFj7g5Va7kA', '2014-03-14 22:59:10'),
(146, 'Information', 'lLK0ohZqAXMf2Ofr67ptgNG/kaK2XjeCZeR5jBU5Ubz91J0wXGXv7BzYzG+QKNYk', '2014-03-14 22:59:49'),
(147, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-19 22:46:31'),
(148, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-19 22:46:31'),
(149, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-19 22:46:31'),
(150, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 22:49:32'),
(151, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 22:49:43'),
(152, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 22:50:06'),
(153, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 22:51:38'),
(154, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw5AQeInVppkpr/yLLEbo1c', '2014-03-19 22:51:50'),
(155, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tz2ypeR7Sk6mK9cDCzWrXm5', '2014-03-19 22:57:50'),
(156, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tz2ypeR7Sk6mK9cDCzWrXm5', '2014-03-19 23:09:38'),
(157, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 23:13:31'),
(158, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw5AQeInVppkpr/yLLEbo1c', '2014-03-19 23:13:35'),
(159, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 23:18:50'),
(160, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw5AQeInVppkpr/yLLEbo1c', '2014-03-19 23:19:29'),
(161, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tz2ypeR7Sk6mK9cDCzWrXm5', '2014-03-19 23:19:31'),
(162, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 23:24:14'),
(163, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw5AQeInVppkpr/yLLEbo1c', '2014-03-19 23:24:18'),
(164, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tz2ypeR7Sk6mK9cDCzWrXm5', '2014-03-19 23:24:21'),
(165, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-19 23:27:21'),
(166, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:15:32'),
(167, 'Erreur', 'n5d3GTp3wblaHbHjSC84uZovBQ6sQEjkXBvUjaqLh6EAac0F9Bj7oXYrPlKBoJXO4cJoM7Uufqgch7sqwhSHYcwhPmcu6cW7sbTK7Hdmv3UIAEYvKJ0sY67fDjFKOi4XHLJUZbty3LbUqb8vWRvJYw==', '2014-03-20 22:15:32'),
(168, 'Erreur', 'osgKp5hpYllB1tqTxtesxrB5AcNUxrjeYTqxJ923PbtIrYUjCM35ivpdZVjt8bKMSISl0JUZoHzoqadgnjwhyUPCIvUgOfoIQe8Tx1TCvzSG3YRsi1Sqk4mIna3sSdTEgeAWFxaNRleJ65ht/TSZ3aSaRaaYC0VpZTOr907g4Hw=', '2014-03-20 22:15:32'),
(169, 'Erreur', 'osgKp5hpYllB1tqTxtesxrB5AcNUxrjeYTqxJ923PbtIrYUjCM35ivpdZVjt8bKMSISl0JUZoHzoqadgnjwhyUPCIvUgOfoIQe8Tx1TCvzSG3YRsi1Sqk4mIna3sSdTEgeAWFxaNRleJ65ht/TSZ3aSaRaaYC0VpZTOr907g4Hw=', '2014-03-20 22:15:32'),
(170, 'Erreur', 'JVTrw8fW3KkI03gWehrxpmzviSMxramVrCisu8Iy/npD8UPnxkD75bB9Zi8VRhEkxCjhkbYu0C6tc3L0vdxNBUjLiwQblz1K0lMWnKd6tgXOxN7SpaYXdKpG+sRTf0Qh+1DuvJqaBuTVqX6Le/a+NPb5rgnyOVwM+dm3YBnRZzn9cbWaWNRTUuE4bUO4Vw6k5fc7WvVlPK1oUH6iltIZ0FuKG6hJRrgnLi4wqkUYmTegzoawhuFKuDrGidUB41KttK/bJEXnzsNlCoHguydHk23Z3G58dmTgpngXcGWMnk/VZ6N7txEdCXHBASUDu/TiHviDjD3kYXdmfwY6LFe8LSZj/vmtBy5qC7EeUG79s7y7jqyEf5cPao38blaXsE8xXtYD7dio5GYkpC0R2kXuPiLPXrRuqYbRQXuazb1sv4s=', '2014-03-20 22:15:32'),
(171, 'Erreur', 'JVTrw8fW3KkI03gWehrxpmzviSMxramVrCisu8Iy/npD8UPnxkD75bB9Zi8VRhEkxCjhkbYu0C6tc3L0vdxNBUjLiwQblz1K0lMWnKd6tgXOxN7SpaYXdKpG+sRTf0Qh+1DuvJqaBuTVqX6Le/a+NPb5rgnyOVwM+dm3YBnRZzn9cbWaWNRTUuE4bUO4Vw6k5fc7WvVlPK1oUH6iltIZ0FuKG6hJRrgnLi4wqkUYmTegzoawhuFKuDrGidUB41KttK/bJEXnzsNlCoHguydHk23Z3G58dmTgpngXcGWMnk/VZ6N7txEdCXHBASUDu/TikuwGZngNM61u5A8Qj9Px78OdcuCMEqi6VNy4QcHXP6CFVoaG/k732P+2MlD+DpiTD0zY5DTwdxDapCrm9XFMAxntzsmzRQTQ+RbV+y3+0yY=', '2014-03-20 22:15:32'),
(172, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:17:05'),
(173, 'Erreur', 'osgKp5hpYllB1tqTxtesxrB5AcNUxrjeYTqxJ923PbtIrYUjCM35ivpdZVjt8bKMSISl0JUZoHzoqadgnjwhyUPCIvUgOfoIQe8Tx1TCvzSG3YRsi1Sqk4mIna3sSdTEgeAWFxaNRleJ65ht/TSZ3aSaRaaYC0VpZTOr907g4Hw=', '2014-03-20 22:17:05'),
(174, 'Erreur', 'osgKp5hpYllB1tqTxtesxrB5AcNUxrjeYTqxJ923PbtIrYUjCM35ivpdZVjt8bKMSISl0JUZoHzoqadgnjwhyUPCIvUgOfoIQe8Tx1TCvzSG3YRsi1Sqk4mIna3sSdTEgeAWFxaNRleJ65ht/TSZ3aSaRaaYC0VpZTOr907g4Hw=', '2014-03-20 22:17:05'),
(175, 'Erreur', 'JVTrw8fW3KkI03gWehrxpmzviSMxramVrCisu8Iy/npD8UPnxkD75bB9Zi8VRhEkxCjhkbYu0C6tc3L0vdxNBUjLiwQblz1K0lMWnKd6tgXOxN7SpaYXdKpG+sRTf0Qh+1DuvJqaBuTVqX6Le/a+NPb5rgnyOVwM+dm3YBnRZzn9cbWaWNRTUuE4bUO4Vw6k5fc7WvVlPK1oUH6iltIZ0FuKG6hJRrgnLi4wqkUYmTegzoawhuFKuDrGidUB41KttK/bJEXnzsNlCoHguydHk23Z3G58dmTgpngXcGWMnk/VZ6N7txEdCXHBASUDu/TikuwGZngNM61u5A8Qj9Px78OdcuCMEqi6VNy4QcHXP6AA0mbvUdG6lcrlho7y5NozE+OTE1gY3Is4HaQOcjIBk7Fk3zxoZnsNmA9z9nM3d00=', '2014-03-20 22:17:05'),
(176, 'Erreur', 'JVTrw8fW3KkI03gWehrxpmzviSMxramVrCisu8Iy/npD8UPnxkD75bB9Zi8VRhEkxCjhkbYu0C6tc3L0vdxNBUjLiwQblz1K0lMWnKd6tgXOxN7SpaYXdKpG+sRTf0Qh+1DuvJqaBuTVqX6Le/a+NPb5rgnyOVwM+dm3YBnRZzn9cbWaWNRTUuE4bUO4Vw6k5fc7WvVlPK1oUH6iltIZ0FuKG6hJRrgnLi4wqkUYmTegzoawhuFKuDrGidUB41KttK/bJEXnzsNlCoHguydHk23Z3G58dmTgpngXcGWMnk/VZ6N7txEdCXHBASUDu/TiHviDjD3kYXdmfwY6LFe8LSZj/vmtBy5qC7EeUG79s7xaSfbETkp+WAUnBEwWFhdg6QGXuR0NlC/jmaw5YUDdw+n9a8l+Jp1u6pPYlYnK4+k=', '2014-03-20 22:17:05'),
(177, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:18:18'),
(178, 'Erreur', 'osgKp5hpYllB1tqTxtesxrB5AcNUxrjeYTqxJ923Pbv58qaeOY3b9yRIX7NGttsdxamelKyHlT+kjkqdKwXzNjNShV4P65b8zGDQ3txIz7Ta2XaWtrcJC11pJPv9qmGvXgrlnVS/V/55ZlyupSJkTc808aJBseEhLPiZsoRZf5E=', '2014-03-20 22:18:18'),
(179, 'Erreur', 'osgKp5hpYllB1tqTxtesxrB5AcNUxrjeYTqxJ923Pbv58qaeOY3b9yRIX7NGttsdxamelKyHlT+kjkqdKwXzNjNShV4P65b8zGDQ3txIz7Ta2XaWtrcJC11pJPv9qmGvXgrlnVS/V/55ZlyupSJkTc808aJBseEhLPiZsoRZf5E=', '2014-03-20 22:18:18'),
(180, 'Erreur', 'JVTrw8fW3KkI03gWehrxpmzviSMxramVrCisu8Iy/npD8UPnxkD75bB9Zi8VRhEkxCjhkbYu0C6tc3L0vdxNBUjLiwQblz1K0lMWnKd6tgXOxN7SpaYXdKpG+sRTf0Qh+1DuvJqaBuTVqX6Le/a+NPb5rgnyOVwM+dm3YBnRZzn9cbWaWNRTUuE4bUO4Vw6k5fc7WvVlPK1oUH6iltIZ0FuKG6hJRrgnLi4wqkUYmTegzoawhuFKuDrGidUB41KttK/bJEXnzsNlCoHguydHk23Z3G58dmTgpngXcGWMnk/VZ6N7txEdCXHBASUDu/TikuwGZngNM61u5A8Qj9Px78OdcuCMEqi6VNy4QcHXP6AA0mbvUdG6lcrlho7y5NozE+OTE1gY3Is4HaQOcjIBk7Fk3zxoZnsNmA9z9nM3d00=', '2014-03-20 22:18:18'),
(181, 'Erreur', 'JVTrw8fW3KkI03gWehrxpmzviSMxramVrCisu8Iy/npD8UPnxkD75bB9Zi8VRhEkxCjhkbYu0C6tc3L0vdxNBUjLiwQblz1K0lMWnKd6tgXOxN7SpaYXdKpG+sRTf0Qh+1DuvJqaBuTVqX6Le/a+NPb5rgnyOVwM+dm3YBnRZzn9cbWaWNRTUuE4bUO4Vw6k5fc7WvVlPK1oUH6iltIZ0FuKG6hJRrgnLi4wqkUYmTegzoawhuFKuDrGidUB41KttK/bJEXnzsNlCoHguydHk23Z3G58dmTgpngXcGWMnk/VZ6N7txEdCXHBASUDu/TiHviDjD3kYXdmfwY6LFe8LSZj/vmtBy5qC7EeUG79s7xaSfbETkp+WAUnBEwWFhdg6QGXuR0NlC/jmaw5YUDdw+n9a8l+Jp1u6pPYlYnK4+k=', '2014-03-20 22:18:18'),
(182, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:21:06'),
(183, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:21:54'),
(184, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:29:30'),
(185, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:38:45'),
(186, 'Information', 'utDZug18AV+0dnpYeYw1sGaOHSk11He84I0voT68gNz7sRFz1RlYVlLwl/YiXrm3', '2014-03-20 22:38:46'),
(187, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TzCwNoLwLWbtu6yX28F+LG0', '2014-03-20 22:40:12'),
(188, 'Information', 'utDZug18AV+0dnpYeYw1sFb2XW6Vj/yMMVLe8n0aZ/Zv7GhTSOgvmSiPPDfFol3k', '2014-03-20 22:40:12'),
(189, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw5AQeInVppkpr/yLLEbo1c', '2014-03-20 22:41:24'),
(190, 'Information', 'utDZug18AV+0dnpYeYw1sDY8qSnQKubcfsRjsJ1Xo6O7AyK0Rduk0+q/IS2JjBeE', '2014-03-20 22:41:24'),
(191, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tz2ypeR7Sk6mK9cDCzWrXm5', '2014-03-20 22:41:27'),
(192, 'Information', 'utDZug18AV+0dnpYeYw1sGw1Yh/WxgHji9ceT2q114z6N/LGI8iov/hIwwTxbnK2', '2014-03-20 22:41:27'),
(193, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Txlt0LjhHdccm/Fl3FN5TcM', '2014-03-20 22:49:14'),
(194, 'Information', 'utDZug18AV+0dnpYeYw1sFb2XW6Vj/yMMVLe8n0aZ/Zv7GhTSOgvmSiPPDfFol3k', '2014-03-20 22:49:14'),
(195, 'Erreur', 'cDuQ2iiFn/IKrQzTFxSE7fYak9G5+U4Zd6pYL3X2SXyCw+3TlE9g1P0octwu9UstDPdRmzuU/YrMfe/3JfgA3LpxBLEcfVNIklz4+lWeYKEOMzvenaJYFAaxmZ4Jg7ohZnNaSg37BmcKNa04NG0O1Q==', '2014-03-20 22:49:14'),
(196, 'Information', 'KZbw6H23HhGp0J7pOt9gY1k6swS6aRfb7KRfWFG8SCURotG918Buhi6Hbr9BhN/s3aO4qfA0TVOXjQUoYeA5Hg==', '2014-03-20 22:49:14'),
(197, 'Erreur', 'cDuQ2iiFn/IKrQzTFxSE7fYak9G5+U4Zd6pYL3X2SXyCw+3TlE9g1P0octwu9UstDPdRmzuU/YrMfe/3JfgA3LpxBLEcfVNIklz4+lWeYKEOMzvenaJYFAaxmZ4Jg7ohZnNaSg37BmcKNa04NG0O1Q==', '2014-03-20 22:49:14'),
(198, 'Information', 'KZbw6H23HhGp0J7pOt9gY1k6swS6aRfb7KRfWFG8SCURotG918Buhi6Hbr9BhN/s3aO4qfA0TVOXjQUoYeA5Hg==', '2014-03-20 22:49:15'),
(199, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Txlt0LjhHdccm/Fl3FN5TcM', '2014-03-20 22:50:19'),
(200, 'Information', 'utDZug18AV+0dnpYeYw1sDY8qSnQKubcfsRjsJ1Xo6Op+nwDJ4CBUo4yiQZbmS8/', '2014-03-20 22:50:19'),
(201, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0edMauyRrL9EGg5kQ35LUV9', '2014-03-20 22:50:20'),
(202, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0edMauyRrL9EGg5kQ35LUV9', '2014-03-20 22:50:20'),
(203, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Txlt0LjhHdccm/Fl3FN5TcM', '2014-03-20 22:50:54'),
(204, 'Information', 'utDZug18AV+0dnpYeYw1sApZepl77POVxe8/2P+CvOYDPFOejDDpeLflO2XdTRAf', '2014-03-20 22:50:54'),
(205, 'Erreur', 'cDuQ2iiFn/IKrQzTFxSE7fYak9G5+U4Zd6pYL3X2SXyCw+3TlE9g1P0octwu9UstDPdRmzuU/YrMfe/3JfgA3A0kkCVya1WHg52AEhgz91s+4H6VmahOtzccMldh98Wo5GM66fTFe3sezrT79/RZBf8/6H/XeeBo3mABz1ya5Os=', '2014-03-20 22:50:54'),
(206, 'Information', 'KZbw6H23HhGp0J7pOt9gY1k6swS6aRfb7KRfWFG8SCURotG918Buhi6Hbr9BhN/s3aO4qfA0TVOXjQUoYeA5Hg==', '2014-03-20 22:50:54'),
(207, 'Erreur', 'cDuQ2iiFn/IKrQzTFxSE7fYak9G5+U4Zd6pYL3X2SXyCw+3TlE9g1P0octwu9UstDPdRmzuU/YrMfe/3JfgA3A0kkCVya1WHg52AEhgz91s+4H6VmahOtzccMldh98Wopl+L2k8GsVHW1pCTkTGxX7sNehvfmOiXljmHMJKf5Ys=', '2014-03-20 22:50:54'),
(208, 'Information', 'KZbw6H23HhGp0J7pOt9gY1k6swS6aRfb7KRfWFG8SCURotG918Buhi6Hbr9BhN/s3aO4qfA0TVOXjQUoYeA5Hg==', '2014-03-20 22:50:54'),
(209, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Txlt0LjhHdccm/Fl3FN5TcM', '2014-03-20 23:00:15'),
(210, 'Information', 'utDZug18AV+0dnpYeYw1sHvI/FaFlgduYjkd16oKVX+HXK7VBS5VwlkMHD+dDKS9', '2014-03-20 23:00:15'),
(211, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:00:15'),
(212, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:00:15'),
(213, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TxIP3CkEd0XVwvMnnTj7alu', '2014-03-20 23:00:25'),
(214, 'Information', 'utDZug18AV+0dnpYeYw1sEvo4SJFTIeAQODoWVHhefk7KVp7YWHvc53TRqYnN5na', '2014-03-20 23:00:25'),
(215, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:00:25'),
(216, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:00:25'),
(217, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwdYGupGkrq0/qXv+linRDA', '2014-03-20 23:00:55'),
(218, 'Information', 'utDZug18AV+0dnpYeYw1sB/tCHEwZxh2/hdmZdD+MoYdbyIGPpROs3v6tORWVy7Z', '2014-03-20 23:00:55'),
(219, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:00:55'),
(220, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:00:55'),
(221, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Txlt0LjhHdccm/Fl3FN5TcM', '2014-03-20 23:03:06'),
(222, 'Information', 'utDZug18AV+0dnpYeYw1sFb2XW6Vj/yMMVLe8n0aZ/Zv7GhTSOgvmSiPPDfFol3k', '2014-03-20 23:03:06'),
(223, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:03:06'),
(224, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:03:06'),
(225, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TxIP3CkEd0XVwvMnnTj7alu', '2014-03-20 23:03:13'),
(226, 'Information', 'utDZug18AV+0dnpYeYw1sDY8qSnQKubcfsRjsJ1Xo6O7AyK0Rduk0+q/IS2JjBeE', '2014-03-20 23:03:13'),
(227, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:03:13'),
(228, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:03:13'),
(229, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwdYGupGkrq0/qXv+linRDA', '2014-03-20 23:03:19'),
(230, 'Information', 'utDZug18AV+0dnpYeYw1sGw1Yh/WxgHji9ceT2q114yTD9eXeAWDquDk7gLYWWS8', '2014-03-20 23:03:19'),
(231, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:03:19'),
(232, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-20 23:03:19'),
(233, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Txlt0LjhHdccm/Fl3FN5TcM', '2014-03-20 23:15:18'),
(234, 'Information', 'utDZug18AV+0dnpYeYw1sApZepl77POVxe8/2P+CvOYDPFOejDDpeLflO2XdTRAf', '2014-03-20 23:15:18'),
(235, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TyvOzlJ6yTK7CsD3ZJNMAJ9', '2014-03-20 23:25:15'),
(236, 'Information', '6etfSkx/Uxelzbaey3pS7OIpwNg9P+zNz7qOKXqgoI4=', '2014-03-20 23:25:15'),
(237, 'Information', '6etfSkx/Uxelzbaey3pS7OIpwNg9P+zNz7qOKXqgoI4=', '2014-03-20 23:25:15'),
(238, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw7kEY1NV09GUFx0Gozxqpk', '2014-03-20 23:28:10'),
(239, 'Information', 'u3ewQfeUaO306B7vRJgrPg==', '2014-03-20 23:28:10'),
(240, 'Information', 'u3ewQfeUaO306B7vRJgrPg==', '2014-03-20 23:28:10'),
(241, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw7kEY1NV09GUFx0Gozxqpk', '2014-03-20 23:28:50'),
(242, 'Information', 'u3ewQfeUaO306B7vRJgrPg==', '2014-03-20 23:28:50'),
(243, 'Information', 'u3ewQfeUaO306B7vRJgrPg==', '2014-03-20 23:28:50'),
(244, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw+jHU/1wGdALjI2c7+x1IY', '2014-03-20 23:28:59'),
(245, 'Information', 'u3ewQfeUaO306B7vRJgrPg==', '2014-03-20 23:29:00'),
(246, 'Information', 'u3ewQfeUaO306B7vRJgrPg==', '2014-03-20 23:29:00'),
(247, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw+jHU/1wGdALjI2c7+x1IY', '2014-03-20 23:29:34'),
(248, 'Information', 'rYlDiWlLYUu8khZdr3MOWQ==', '2014-03-20 23:29:34'),
(249, 'Information', '28ilNpCVWrIE/TubAtjLew==', '2014-03-20 23:29:34'),
(250, 'Information', 'cXddxuY0Sw974CaUSUzlNw==', '2014-03-20 23:29:34'),
(251, 'Information', 'PN70f7STNmQKLQ81neP54A==', '2014-03-20 23:29:34'),
(252, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TyvOzlJ6yTK7CsD3ZJNMAJ9', '2014-03-20 23:31:54'),
(253, 'Information', '28ilNpCVWrIE/TubAtjLew==', '2014-03-20 23:31:54'),
(254, 'Information', 'rYlDiWlLYUu8khZdr3MOWQ==', '2014-03-20 23:31:54'),
(255, 'Information', 'cXddxuY0Sw974CaUSUzlNw==', '2014-03-20 23:31:54'),
(256, 'Information', 'PN70f7STNmQKLQ81neP54A==', '2014-03-20 23:31:54'),
(257, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw7kEY1NV09GUFx0Gozxqpk', '2014-03-20 23:32:01'),
(258, 'Information', 'rYlDiWlLYUu8khZdr3MOWQ==', '2014-03-20 23:32:01'),
(259, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeIfx2DuHw9egN5BVkJkMUvgOL9Yr6RFTIuOaYsm310ynWg8YJyMDDft+QrEiZ/ht3E=', '2014-03-20 23:32:01'),
(260, 'Information', '28ilNpCVWrIE/TubAtjLew==', '2014-03-20 23:32:01'),
(261, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeJ/Fd3FEh9kW9hNtudxW0LzWN1jpqtyDZ7x18IwtbAmWu3096zYuADpstjiR8/infk=', '2014-03-20 23:32:01'),
(262, 'Information', 'cXddxuY0Sw974CaUSUzlNw==', '2014-03-20 23:32:01'),
(263, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeLm2L5tuqzbyMcwxSFS2NliQoow+kiWTJFsPDu2iinMW00kW3M1dEgoGzmj8hKxnM0=', '2014-03-20 23:32:01'),
(264, 'Information', 'PN70f7STNmQKLQ81neP54A==', '2014-03-20 23:32:01'),
(265, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeKTCJ9wXUhQhjQSjj8RFG5IiQ+p8brB13e0zVdI3eJJR2gBKfFX8lCCkCMr7huAMuk=', '2014-03-20 23:32:01'),
(266, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw7kEY1NV09GUFx0Gozxqpk', '2014-03-20 23:34:39'),
(267, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeIfx2DuHw9egN5BVkJkMUvgOL9Yr6RFTIuOaYsm310ynWg8YJyMDDft+QrEiZ/ht3E=', '2014-03-20 23:34:40'),
(268, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeJ/Fd3FEh9kW9hNtudxW0LzWN1jpqtyDZ7x18IwtbAmWu3096zYuADpstjiR8/infk=', '2014-03-20 23:34:40'),
(269, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeLm2L5tuqzbyMcwxSFS2NliQoow+kiWTJFsPDu2iinMW00kW3M1dEgoGzmj8hKxnM0=', '2014-03-20 23:34:40'),
(270, 'Erreur', '3NGZSzaTOtRRpAUT9/CPTCAZcGmWroRzBDLoZpqBx0pvD+OK8JUJK34qZ35jSyM0msbOArKqSvYnxMTfd5rrh3OPW2RkdnEqPnrHsWUOzeKTCJ9wXUhQhjQSjj8RFG5IiQ+p8brB13e0zVdI3eJJR2gBKfFX8lCCkCMr7huAMuk=', '2014-03-20 23:34:40'),
(271, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw7kEY1NV09GUFx0Gozxqpk', '2014-03-20 23:36:22'),
(272, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Twxjf77cBMWj+UsyMsKpdXj', '2014-03-22 22:34:21'),
(273, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tx10p5qqKi6hEuCgUdf/5j/', '2014-03-22 22:34:49'),
(274, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1TwqDJ4czP7n+qFLeRc/DgJB', '2014-03-22 22:35:08'),
(275, 'Erreur', 'ofrBcQ+CO6VnMJ3ZpWrxhUwVVO0Uz/ul68CIr3zpDunEVkMYjVuJvf5qfSAYF8vgIEPolP65p5OigwOuVU+zooUfxU2xdb4AqvvkA/EW2DHMwf3ktmVzrS4Ax2872caEr4UrgSHbxnOXeSmc20K5VwMjAmoC4PxdV6JbOVrR7JCWBHLPhgZiWLXAsFZHUiO4', '2014-03-22 22:37:28'),
(276, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tw806636uFMHcepdl6JPA4U', '2014-03-22 22:53:06'),
(277, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Tx4irfsdRdroVuZNlMYpI3k', '2014-03-22 22:53:14'),
(278, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Twd9DlUWxNm+3CtFn7Xuzpz', '2014-03-22 22:53:31'),
(279, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Twd9DlUWxNm+3CtFn7Xuzpz', '2014-03-22 23:14:44'),
(280, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Twd9DlUWxNm+3CtFn7Xuzpz', '2014-03-22 23:21:37'),
(281, 'Information', '8Uicbx+G3kab0cep3Kvez14Y1CXI7RXy8dwSvmWQ1Twd9DlUWxNm+3CtFn7Xuzpz', '2014-03-22 23:22:20'),
(282, 'Erreur', 'F+HTZt0eXwm6vRfmcJeLkJ/etSyzoKGiT/yjRzpdbSX5jgl5JgQSzREEXva+JNmNLvhPFjveSlHEEumlKiy7yYrhmsfnXBTWMdCysDnouKzBSip7KHaCWfM44DgwsTkrZU519jCyhZogvLNIHaz8dpYQgle+8dsbkMIhxmrHUwg=', '2014-03-22 23:48:23'),
(283, 'Erreur', 'F+HTZt0eXwm6vRfmcJeLkJ/etSyzoKGiT/yjRzpdbSX5jgl5JgQSzREEXva+JNmNLvhPFjveSlHEEumlKiy7yYrhmsfnXBTWMdCysDnouKzBSip7KHaCWfM44DgwsTkrZU519jCyhZogvLNIHaz8dpYQgle+8dsbkMIhxmrHUwg=', '2014-03-22 23:48:49'),
(284, 'Erreur', 'F+HTZt0eXwm6vRfmcJeLkJ/etSyzoKGiT/yjRzpdbSX5jgl5JgQSzREEXva+JNmNLvhPFjveSlHEEumlKiy7yYrhmsfnXBTWMdCysDnouKzBSip7KHaCWfM44DgwsTkrZU519jCyhZogvLNIHaz8dpYQgle+8dsbkMIhxmrHUwg=', '2014-03-22 23:48:59'),
(285, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-23 16:01:13'),
(286, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-23 16:01:13'),
(287, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0f4Lt3iAVqdUu2szaz/YzDM', '2014-03-23 16:01:13'),
(288, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-23 16:01:20'),
(289, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-23 16:01:20'),
(290, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0c6VtiLaIAhT2k0fgDmSRUH', '2014-03-23 16:01:20');
INSERT INTO `log` (`idlog`, `typelog`, `texte`, `datelog`) VALUES
(291, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-23 16:01:31'),
(292, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-23 16:01:31'),
(293, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-23 16:01:31'),
(294, 'Information', 'LuPHhNU1orUIS28A/3cFpSEkOtGHE1G3+eGdcvKqp0cA5u4Pn2Kd4l+287C5jqQp', '2014-03-23 16:01:31'),
(295, 'Information', '9FFMTaRQH2KiBG6yeRbqET5+zXA0NH2qJjwWt+5rG8Z8x7d7d1FY8BVp8OAn5IrVzpPM22Vxst7FBPSoGX4xt4jV1qvGBb1yA9iEDMOcsck=', '2014-04-01 21:35:14'),
(296, 'Information', '9FFMTaRQH2KiBG6yeRbqEWQAv7zExQP3G+tloNHpBeZ9fc51owlTZGbk6SCUfVfFDdOq3uIU4pIxSTTYyt6htv/WkY4KldALcOgsxUdAQ+s=', '2014-04-01 21:35:14'),
(297, 'Information', '9FFMTaRQH2KiBG6yeRbqEXpc5GxxgyIIKYDqg0P7IKAlshJ5MxZLy0objpeVddLTIQlpwe+robVxq0CSt+5gqZDeMQtzqyJbgdYoPMiLAOE=', '2014-04-01 21:35:14'),
(298, 'Information', '9FFMTaRQH2KiBG6yeRbqEdCOZtjgSJQJFgrRHylTrz9vT09/psSLChFicSsV1XOFpDBTFtUrHFVz8CeaxXQUZewTm2S8vykab+6WLpUq+l0=', '2014-04-01 21:35:14'),
(299, 'Information', '9FFMTaRQH2KiBG6yeRbqEVE40fYiTsA2c1/shRTJDjhYH3y8yQJlTAvg28YRMCdybon1zlXuzf3Z2UTfQD3M3ZOe8EhHJIuqt6YQkIVBAw8=', '2014-04-01 21:35:14'),
(300, 'Information', '0qW/jAVZG0tANaH3qvvarKRH/ru4g5yttr6+hBMMswv1YMgpOaiMFdZLeS53c5AFtyVZvQXEJ93Kgq8fICrQMQ==', '2014-04-01 21:35:14'),
(301, 'Information', '9FFMTaRQH2KiBG6yeRbqEYz54LmAYL/bQskkYa6mXnxw3wGr3pZvE+6h+40NOdp8B0+O/iPa+8W6qZyoMha8+52AP6UFt9CONzfGxKB9/1Y=', '2014-04-01 21:35:14'),
(302, 'Information', '9FFMTaRQH2KiBG6yeRbqETU0kwjAcMGxpIdwrAiH2iTDkKN4cuODkt2Cerf5bYeWVQpfSbnFZsj0kPhGUUQSAe0xivy5idCGK2R4fG9wU6I=', '2014-04-01 21:35:14'),
(303, 'Information', '9FFMTaRQH2KiBG6yeRbqEYRPxo62Mr6RM2+WfdfQXfAC4xw37QOP+3taHbaDRVtwTA12Rmhz0LNDbazOa9GlOMiB/WqCgsGZMV7Pi/hGCyU=', '2014-04-01 21:35:14'),
(304, 'Information', '9FFMTaRQH2KiBG6yeRbqEZGbDJxb2AzDYEUSxk3pp9qk8DCWUvcHD+ZS+80ByWRIl+YrgxjweojFQtqf+hWxUg0rJedVTQGdhQlR+53OhII=', '2014-04-01 21:35:14'),
(305, 'Information', '9FFMTaRQH2KiBG6yeRbqERZYB6PiNJpnU7CJmQca+e2GpStBcT3Aq06GRzRmCnHmgFq/NUWLyf0O3HY0rufoKqBjNzwr69Omf60NLWWhSqI=', '2014-04-01 21:35:14'),
(306, 'Information', '9FFMTaRQH2KiBG6yeRbqESDkxvJ3j4e73qwV0PTk1s6/g1HdyT0e0ZCwlFGfaysXLnTHC4z7KA3VRe5c0XMW9gwK4sbdUhUw29bo8q2j1Wc=', '2014-04-01 21:35:14'),
(307, 'Information', '9FFMTaRQH2KiBG6yeRbqEdCOZtjgSJQJFgrRHylTrz+fbnM2MvyuaUtKHfvZJ+NMx7m09vX4ofTBmJJef5Rs0rKFYMYNZOjYqlfpruzbr1E=', '2014-04-01 21:35:14'),
(308, 'Information', '9FFMTaRQH2KiBG6yeRbqEbHD9jvmqMMNdsFMymb0QnVgu+rKpma3EmW/ZkDs4nL9gy+bdbn+6H00lA9WH3fsEm+Y2pIEQYDuJGnODCkoB7Q=', '2014-04-01 21:35:14'),
(309, 'Information', '9FFMTaRQH2KiBG6yeRbqEXaG2evPE/pRpdeWZOPWOfS2ZKDgtBmotncgIKm5oc0ZIEdGl3JdnzHkIcZ5UYtFwkseCjd7/wsbRuqiHPkRx9o=', '2014-04-01 21:35:14'),
(310, 'Information', '9FFMTaRQH2KiBG6yeRbqEZ79jMzdM/6M66jmnoF3mSYHcngZJvCC+atRDzxTy95kTEmHXMWrcUkN8jcMfZIhGGdr8u4wWdt55yR8jhWXwAA=', '2014-04-01 21:35:14'),
(311, 'Information', '9FFMTaRQH2KiBG6yeRbqEXDF3oA6uZQKywrtKSthnpZcjAD4TPMs16uCc+s2rwRGDJmoqa0mLbfQdDbDE6Q7yskGx/BYLaA7iUMQd8yX0Gg=', '2014-04-01 21:35:14'),
(312, 'Information', '9FFMTaRQH2KiBG6yeRbqEXZYhHVerLsnUHoy636mq8RYtWSehGvO562ckhk3Z+3I7FeV8pRZDbI/SVdq6/JcWHvagpyBExRQnaR35jsSx0c=', '2014-04-01 21:35:14'),
(313, 'Information', '9FFMTaRQH2KiBG6yeRbqES2MYnWcSxfCGcz3sWAd6FArINvNXUZZLPFdoNpU3+3dcn2hVUD/LcwEm7A+c9EeULS8RvHAkmyN45s7il05m/M=', '2014-04-01 21:35:14'),
(314, 'Information', '9FFMTaRQH2KiBG6yeRbqEUpVXm2GJKnTNm9IEXur+HnxL7zxEJ75ELgvOgPVrOD5+sFg+g5dt42abdnhQHYeBgetWn0xTjja4UYocRjlGig=', '2014-04-01 21:35:14'),
(315, 'Information', '9FFMTaRQH2KiBG6yeRbqEbctXL8DgiwLu3aFUvs697QE6vqjNOfqXOgLr1Dr3Ku6OEpdpoEJYbS8ia424e4fd9r4qdSy60hRd+XHXioRPF0=', '2014-04-01 21:35:14'),
(316, 'Information', '9FFMTaRQH2KiBG6yeRbqEQb0+YR4KMcOR2WwLYmcjc494JFY0ufpw01txIfLH001M2XVZhbdPxRmaLPsrnxRPf/gS1wb0JQsgx5YXt0b+Fw=', '2014-04-01 21:35:14'),
(317, 'Information', '9FFMTaRQH2KiBG6yeRbqEX6im2rVJZZpIJLmx3I0+0BIyX6q3fyfYw5KH9Zmr7dVhkIld1mzC1D4Nwjv7wmABA==', '2014-04-01 21:35:14'),
(318, 'Information', 'vErw7X6CHXmFWKAafOrEVyPkU9KDxSkgMQ30549fU2Hm0r/xwNOYDtvdMX3FFQdXzMwEgI8zHz0nx8ELDVnxKA==', '2014-04-01 21:35:14'),
(319, 'Information', 'ExDbNCcoMGIx7d+1t6TmtBwsgakX0enyGLPS0UVH7VeF88mlqSzr+fsWtc0t6UflL8IHB3h4L1zSMG4+0CSDjw==', '2014-04-01 21:35:14'),
(320, 'Information', '9FFMTaRQH2KiBG6yeRbqEdvtZF1u9vs6MpwWWoP5ET5K4oWidBZ9IwQyJeZ0TKQ+orQzqe/cV572e/1Ypy1vaEgVUBDD9BXBLrQ8akuHOe0=', '2014-04-01 21:35:14'),
(321, 'Information', 'V7lJVXIDWbSwVqyOvqnZUuDy76Dvg+gtv1EFoYSe7TXQ3pBt7hIW61w05HRk1/Bi', '2014-04-01 21:35:14'),
(322, 'Information', '9FFMTaRQH2KiBG6yeRbqET5+zXA0NH2qJjwWt+5rG8Z8x7d7d1FY8BVp8OAn5IrVzpPM22Vxst7FBPSoGX4xt4jV1qvGBb1yA9iEDMOcsck=', '2014-04-01 21:52:03'),
(323, 'Information', '9FFMTaRQH2KiBG6yeRbqEWQAv7zExQP3G+tloNHpBeZ9fc51owlTZGbk6SCUfVfFDdOq3uIU4pIxSTTYyt6htv/WkY4KldALcOgsxUdAQ+s=', '2014-04-01 21:52:03'),
(324, 'Information', '9FFMTaRQH2KiBG6yeRbqEXpc5GxxgyIIKYDqg0P7IKAlshJ5MxZLy0objpeVddLTIQlpwe+robVxq0CSt+5gqZDeMQtzqyJbgdYoPMiLAOE=', '2014-04-01 21:52:03'),
(325, 'Information', '9FFMTaRQH2KiBG6yeRbqEdCOZtjgSJQJFgrRHylTrz9vT09/psSLChFicSsV1XOFpDBTFtUrHFVz8CeaxXQUZewTm2S8vykab+6WLpUq+l0=', '2014-04-01 21:52:03'),
(326, 'Information', '9FFMTaRQH2KiBG6yeRbqEVE40fYiTsA2c1/shRTJDjhYH3y8yQJlTAvg28YRMCdybon1zlXuzf3Z2UTfQD3M3ZOe8EhHJIuqt6YQkIVBAw8=', '2014-04-01 21:52:03'),
(327, 'Information', '0qW/jAVZG0tANaH3qvvarKRH/ru4g5yttr6+hBMMswv1YMgpOaiMFdZLeS53c5AFtyVZvQXEJ93Kgq8fICrQMQ==', '2014-04-01 21:52:03'),
(328, 'Information', '9FFMTaRQH2KiBG6yeRbqEYz54LmAYL/bQskkYa6mXnxw3wGr3pZvE+6h+40NOdp8B0+O/iPa+8W6qZyoMha8+52AP6UFt9CONzfGxKB9/1Y=', '2014-04-01 21:52:03'),
(329, 'Information', '9FFMTaRQH2KiBG6yeRbqETU0kwjAcMGxpIdwrAiH2iTDkKN4cuODkt2Cerf5bYeWVQpfSbnFZsj0kPhGUUQSAe0xivy5idCGK2R4fG9wU6I=', '2014-04-01 21:52:03'),
(330, 'Information', '9FFMTaRQH2KiBG6yeRbqEYRPxo62Mr6RM2+WfdfQXfAC4xw37QOP+3taHbaDRVtwTA12Rmhz0LNDbazOa9GlOMiB/WqCgsGZMV7Pi/hGCyU=', '2014-04-01 21:52:03'),
(331, 'Information', '9FFMTaRQH2KiBG6yeRbqEZGbDJxb2AzDYEUSxk3pp9qk8DCWUvcHD+ZS+80ByWRIl+YrgxjweojFQtqf+hWxUg0rJedVTQGdhQlR+53OhII=', '2014-04-01 21:52:03'),
(332, 'Information', '9FFMTaRQH2KiBG6yeRbqERZYB6PiNJpnU7CJmQca+e2GpStBcT3Aq06GRzRmCnHmgFq/NUWLyf0O3HY0rufoKqBjNzwr69Omf60NLWWhSqI=', '2014-04-01 21:52:03'),
(333, 'Information', '9FFMTaRQH2KiBG6yeRbqESDkxvJ3j4e73qwV0PTk1s6/g1HdyT0e0ZCwlFGfaysXLnTHC4z7KA3VRe5c0XMW9gwK4sbdUhUw29bo8q2j1Wc=', '2014-04-01 21:52:03'),
(334, 'Information', '9FFMTaRQH2KiBG6yeRbqEdCOZtjgSJQJFgrRHylTrz+fbnM2MvyuaUtKHfvZJ+NMx7m09vX4ofTBmJJef5Rs0rKFYMYNZOjYqlfpruzbr1E=', '2014-04-01 21:52:03'),
(335, 'Information', '9FFMTaRQH2KiBG6yeRbqEbHD9jvmqMMNdsFMymb0QnVgu+rKpma3EmW/ZkDs4nL9gy+bdbn+6H00lA9WH3fsEm+Y2pIEQYDuJGnODCkoB7Q=', '2014-04-01 21:52:03'),
(336, 'Information', '9FFMTaRQH2KiBG6yeRbqEXaG2evPE/pRpdeWZOPWOfS2ZKDgtBmotncgIKm5oc0ZIEdGl3JdnzHkIcZ5UYtFwkseCjd7/wsbRuqiHPkRx9o=', '2014-04-01 21:52:03'),
(337, 'Information', '9FFMTaRQH2KiBG6yeRbqEZ79jMzdM/6M66jmnoF3mSYHcngZJvCC+atRDzxTy95kTEmHXMWrcUkN8jcMfZIhGGdr8u4wWdt55yR8jhWXwAA=', '2014-04-01 21:52:03'),
(338, 'Information', '9FFMTaRQH2KiBG6yeRbqEXDF3oA6uZQKywrtKSthnpZcjAD4TPMs16uCc+s2rwRGDJmoqa0mLbfQdDbDE6Q7yskGx/BYLaA7iUMQd8yX0Gg=', '2014-04-01 21:52:03'),
(339, 'Information', '9FFMTaRQH2KiBG6yeRbqEXZYhHVerLsnUHoy636mq8RYtWSehGvO562ckhk3Z+3I7FeV8pRZDbI/SVdq6/JcWHvagpyBExRQnaR35jsSx0c=', '2014-04-01 21:52:03'),
(340, 'Information', '9FFMTaRQH2KiBG6yeRbqES2MYnWcSxfCGcz3sWAd6FArINvNXUZZLPFdoNpU3+3dcn2hVUD/LcwEm7A+c9EeULS8RvHAkmyN45s7il05m/M=', '2014-04-01 21:52:03'),
(341, 'Information', '9FFMTaRQH2KiBG6yeRbqEUpVXm2GJKnTNm9IEXur+HnxL7zxEJ75ELgvOgPVrOD5+sFg+g5dt42abdnhQHYeBgetWn0xTjja4UYocRjlGig=', '2014-04-01 21:52:03'),
(342, 'Information', '9FFMTaRQH2KiBG6yeRbqEbctXL8DgiwLu3aFUvs697QE6vqjNOfqXOgLr1Dr3Ku6OEpdpoEJYbS8ia424e4fd9r4qdSy60hRd+XHXioRPF0=', '2014-04-01 21:52:03'),
(343, 'Information', '9FFMTaRQH2KiBG6yeRbqEQb0+YR4KMcOR2WwLYmcjc494JFY0ufpw01txIfLH001M2XVZhbdPxRmaLPsrnxRPf/gS1wb0JQsgx5YXt0b+Fw=', '2014-04-01 21:52:03'),
(344, 'Information', '9FFMTaRQH2KiBG6yeRbqEX6im2rVJZZpIJLmx3I0+0BIyX6q3fyfYw5KH9Zmr7dVhkIld1mzC1D4Nwjv7wmABA==', '2014-04-01 21:52:03'),
(345, 'Information', 'vErw7X6CHXmFWKAafOrEVyPkU9KDxSkgMQ30549fU2Hm0r/xwNOYDtvdMX3FFQdXzMwEgI8zHz0nx8ELDVnxKA==', '2014-04-01 21:52:03'),
(346, 'Information', 'ExDbNCcoMGIx7d+1t6TmtBwsgakX0enyGLPS0UVH7VeF88mlqSzr+fsWtc0t6UflL8IHB3h4L1zSMG4+0CSDjw==', '2014-04-01 21:52:03'),
(347, 'Information', '9FFMTaRQH2KiBG6yeRbqEdvtZF1u9vs6MpwWWoP5ET5K4oWidBZ9IwQyJeZ0TKQ+orQzqe/cV572e/1Ypy1vaEgVUBDD9BXBLrQ8akuHOe0=', '2014-04-01 21:52:03'),
(348, 'Information', 'V7lJVXIDWbSwVqyOvqnZUuDy76Dvg+gtv1EFoYSe7TXQ3pBt7hIW61w05HRk1/Bi', '2014-04-01 21:52:03'),
(349, 'Information', 'nxztHhQX7OMjmwiR5J/zBLeIoORvhtvmfwJ6sbmgQRY=', '2014-04-01 21:59:54'),
(350, 'Information', 'TibgcOLnY6N2ZKPFwAIq80Wnx+UZNji7Jm8S0bpRXEA=', '2014-04-01 22:00:28'),
(351, 'Information', 'lyguf/ajLISIruBSPYqJWDk3ONESRxX1J6ovPWdp/9I=', '2014-04-01 22:01:01'),
(352, 'Information', '2+pA6EaHLCOz3wgyXUhLa1s9OhUX2FoEjcJsX8jJ7Sw=', '2014-04-01 22:02:08'),
(353, 'Information', 'zjyWj/rJr7ryBVxfwhfE/7Qet+2cS76YJ8Aai+IKwwVXS4oMRce4EV+3DizAsMBr', '2014-04-01 22:02:37'),
(354, 'Information', 'I9i7WShovawza8SPdhmALyANhvAFX5gxM18w7KOFS8bW+hZip13+hWgONZX9vFDXwjvynzjI1DjP4qK7fhpnHA==', '2014-04-01 22:02:56'),
(355, 'Information', 'rCd7FkejOBIa4yaJCprSnf1d/Q1kXwhTQBDIbhDXrX7FkEi75vPhCY4y9fgbJuV5NzPqQqHsGE68AwViNTqTWw==', '2014-04-01 22:02:56'),
(356, 'Information', 'n2WsI4UkQqzaU6ZYAh0vfyUlm4pp/YGbIvl4LkMa3knOqg88ETOEy+Pm0TrJlL5HNU3yuJfpojQojuX1KWQCiA==', '2014-04-01 22:02:56'),
(357, 'Information', 'c2k1lDu9FXECJq3o9VToCuii9LYOpGqszC2CLr+gj13AYhaxgwm++dGc6pOnq2exl2DCcE0vfaq2mK0ch1sMRQ==', '2014-04-01 22:02:56'),
(358, 'Information', 'VSo7AIMPoj0YR9knC8L9gTq0Qs5oQY1bVUS/kWd9gbNJQLIMxDYGuU9Ki7jhC+Z1QlPi59ZxAv8mZRoxa6FGeQ==', '2014-04-01 22:02:56'),
(359, 'Information', 'bpZD8j+ceoYVofuXB2VPfwZC1Q7E/b6xbq1pBtQI7vs4bEpahiF2nk+norZz9i4/lsvDBn7raO5TvtxLF6lKYgZ50JlA8Dhvss5wIHhoh+M=', '2014-04-01 22:02:56'),
(360, 'Information', 'nq32ue51pQr36YMrCah9Tk8sMDT/QRX9Cm9P8Pa7iNd/u9wRrEE2UMHzTWFjvMOUoUoASzkwmyfb7TdSEdklkA==', '2014-04-01 22:02:56'),
(361, 'Information', 'l7p2VZjMvYRCHVTZoFO7QXT64+QIvdFYLlYgytByp6ZBdqXMYiZOmSo5pyVXfm0unrfpq5h2+0al+KG+7b/K0g1uCdbvvqNrMXChnZK03kI=', '2014-04-01 22:02:56'),
(362, 'Information', 'zZ0NYDtD2MgVffScM51V2/95ly/8yrIlK2k7tiZXWPSou6ziAr3hIwuP58rRlW+wX+Enh8QhW3tagzv6TTRZQg==', '2014-04-01 22:02:56'),
(363, 'Information', 'W1kUIxiDNVNPYoA3CpKvsm+jZuRJX78nGdfcGB8B0sO5TAHFK38h3J2NBwwqRlOEl+erGWFTayj8V1U+Nz5LxQ==', '2014-04-01 22:02:56'),
(364, 'Information', 'glv+c34y8nkJNQyWausG75x4WWoPv+BCp/jEFbGZGIkUkAkNN88QGiIcPNmw1yxSm/LnbPYC2gAPtnfhFjeeWg==', '2014-04-01 22:02:56'),
(365, 'Information', 'MdczQpf263PPt3w0ciAUpHdFC9HhwYQuh8pZoHTozaTzTBlSQ6wuVDYc1/H3pEy6petmE9l3xft4ked4GgaPdA==', '2014-04-01 22:02:56'),
(366, 'Information', 'c2k1lDu9FXECJq3o9VToCtrAuQ/52e+4vSxmtvvBFwcsRItDdGXpF3ti5U2WxW5GiJdg7yArHfBtZ7AJ+Zd2avQYVtL00XdWA1AEb7IUkc4=', '2014-04-01 22:02:56'),
(367, 'Information', 'A3X6DHKGkMddVcGVoqldqF+g91SbDlGrhWD3ujJlSCLDdMZBguaplasDnd1jizz75l6aAY9mDLURyBlhyg9SttE14W8u3f+gRHqy8zysmE0=', '2014-04-01 22:02:56'),
(368, 'Information', 'I6/Q1d1LhlH/BIKKB+kqY3XdB2TnBuNrRe0cLCAjS8dWXD9I2AsDmA/8IK7ay/i80VWYWVlc7Lcnq143iFuNAw==', '2014-04-01 22:02:56'),
(369, 'Information', '8ccwcQ2x8GvpSAwk8H01r0Bk9qd8bIZlxQTzsNDPm+O3CFsf8LNqgjZJBzAq78CB6epYxkxDU2cFBbcEPOaW0Q==', '2014-04-01 22:02:56'),
(370, 'Information', 'zX8BTWhgJDgh6GBrbNEUEFBAAePM9xEBxrLSRoOqG3EBMqnKIgJVByGD1RGQ1flldce/3FkCvUddBmilbNsIbFlQ3tYTmCb81JG6EGKFpGs=', '2014-04-01 22:02:56'),
(371, 'Information', 'E+zs94Mnd69aKSvtYqUCYboJyxSTnglEtGUrnr8B4i9SzBzvPUbDXtfSqF9oXRQCCN1z3/Orkgm1LLXP5Y46Ow==', '2014-04-01 22:02:56'),
(372, 'Information', '4KCXy3joDycYaDG8YnE6OIrrDsL+8ZKp5+qjGX9H528iPBtbooB9hbRJKwS//lVfnmXXk7I+74wqLErCtwCUCQIRfrGycB0ZU66qjwmA8do=', '2014-04-01 22:02:56'),
(373, 'Information', '4Am3XnRlpKGdVkli+KtUEUmQoES531E4IbND59pH4b97uXXF0ets3TzHAOgfsbhOod/T3/kWEJrzofQYw5Ej+w==', '2014-04-01 22:02:56'),
(374, 'Information', 'Fjvae6V8JhcXrp1b5AZvcEQdfCgWQRCe7vu4W1ICYLGqevtRxdCePqwG3eIjcWke9S5PE1Jho2/5KfEG3UXfVw==', '2014-04-01 22:02:56'),
(375, 'Information', '8dpmx+rJBycz8VqvZ8oaUeH7CkSPw+DX7AP8OunCmD45qE89NhbbKMxlNqeNf10+U47j4/HOTCvtpNbR3nTOEa0LpAVJL7kl62ymrXj2qLc=', '2014-04-01 22:02:56'),
(376, 'Information', 'a9Ta6ywfyQidf0kZ+xmAIag0Rd3c2kk16rc+JUF3pj7jGE24TZhdWu9NlPAw7ZINFDjUJiPWBlVMR5S0TW9b/A==', '2014-04-01 22:02:56'),
(377, 'Information', 'n2WsI4UkQqzaU6ZYAh0vfxFFqMfK5IA+TtDBfs4RtX9NLnZepgFzxUx3xDr9UxNBEZaL057N14AQYXzv8cxzOg==', '2014-04-01 22:02:56'),
(378, 'Information', 'DbGOVOmqTEX84vXLutY6txeZoWRzHh+vUgrXmNvlC1bwK88iEdZ4q6dCE+1f3ZYG+nsf2LeXkFAZUlBzwT2oWA==', '2014-04-01 22:02:56'),
(379, 'Information', 'YIqOPKbV5S8jAeJHa85JVl40SSAA3UW6IT6xuxP5LLGfFCNtCrGpUT1XJbdFqPGkBlx4Sn5FUE7XOSJ0pNso7g==', '2014-04-01 22:02:56'),
(380, 'Information', 'tiBWncnr1WEGo5+4GES9dZHRCeeSnXOyfpdK4wp9bRdNw4jbn/UpK+j/NcCwtFW9FJ9FFs0C5u7fsjEc2APP9Q==', '2014-04-01 22:02:57');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `idregion` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`idregion`),
  UNIQUE KEY `libelle` (`libelle`)
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
  `idcategorie` int(10) NOT NULL,
  `idlicencie` int(10) NOT NULL,
  `numero_poule` int(2) NOT NULL,
  `classement` int(1) NOT NULL,
  `idcompetition` int(10) NOT NULL,
  PRIMARY KEY (`idlicencie`,`numero_poule`,`classement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `resultat_poule`
--

INSERT INTO `resultat_poule` (`idcategorie`, `idlicencie`, `numero_poule`, `classement`, `idcompetition`) VALUES
(13, 37, 2, 1, 0),
(13, 54, 3, 2, 0),
(13, 55, 3, 3, 0),
(13, 56, 2, 3, 0),
(13, 57, 3, 1, 0),
(13, 160, 3, 4, 0),
(13, 161, 2, 2, 0),
(13, 162, 1, 2, 0),
(13, 163, 1, 3, 0),
(13, 164, 1, 1, 0);
