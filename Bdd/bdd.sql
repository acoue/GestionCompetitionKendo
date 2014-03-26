-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 12 Mars 2014 à 23:40
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
  `libelle` varchar(100) NOT NULL,
  `idregion` int(10) NOT NULL,
  PRIMARY KEY (`idclub`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `club`
--

INSERT INTO `club` (`idclub`, `libelle`, `idregion`) VALUES
(3, 'JJKH', 17),
(4, 'KENDO SAINT BRIEUX', 5),
(5, 'BUDOKAN ANGERS', 17),
(7, 'SAMOURAI 2000', 17),
(8, 'KETSUGO', 17),
(9, 'AME AGARU', 17),
(10, 'CERCLE PAUL BERT', 5),
(11, 'CHANTEPIE', 5),
(12, 'DOJO NANTAIS', 17),
(13, 'JKCF', 17),
(14, 'KC BREST', 5),
(15, 'KCSB', 5),
(16, 'KICNIORT', 19),
(17, 'PLDLORIENT', 5),
(18, 'POITIERS', 19),
(19, 'QUIBERON', 5),
(20, 'QUIMPER', 5),
(21, 'SAINT NAZAIRE', 5),
(22, 'SHODOKAN', 17),
(23, 'ST NAZAIRE', 5);

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
  PRIMARY KEY (`idcombat_poule`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Contenu de la table `combat_poule`
--

INSERT INTO `combat_poule` (`idcombat_poule`, `idcategorie`, `poule`, `ordre`, `idlicencie1`, `idlicencie2`, `resultat_rouge`, `resultat_blanc`, `idvainqueur`) VALUES
(64, 13, 1, 1, 164, 55, 'M M ', 'K ', 164),
(65, 13, 1, 2, 164, 54, 'M ', '', 164),
(66, 13, 1, 3, 55, 54, 'M ', '- ', 55),
(67, 13, 2, 1, 37, 57, '- - ', 'K ', 57),
(68, 13, 2, 2, 37, 160, 'M ', '', 37),
(69, 13, 2, 3, 57, 160, 'M - -', '', 57),
(70, 13, 3, 1, 163, 161, '', '', NULL),
(71, 13, 3, 2, 162, 56, '', '', NULL),
(72, 13, 3, 3, 163, 56, '', '', NULL),
(73, 13, 3, 4, 163, 162, '', '', NULL),
(74, 13, 3, 5, 161, 162, '', '', NULL),
(75, 13, 3, 6, 162, 56, '', '', NULL);

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
  PRIMARY KEY (`idhistorique`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `historique_tirage`
--

INSERT INTO `historique_tirage` (`idhistorique`, `idcategorie`, `date_tirage`) VALUES
(16, 13, '2014-03-07');

-- --------------------------------------------------------

--
-- Structure de la table `licencie`
--

CREATE TABLE `licencie` (
  `idlicencie` int(10) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `idclub` int(10) NOT NULL,
  PRIMARY KEY (`idlicencie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Contenu de la table `licencie`
--

INSERT INTO `licencie` (`idlicencie`, `prenom`, `nom`, `idclub`) VALUES
(1, 'Cl4Nxq8bbOBzpxOmjor35A==', '7gTp74ppFqaGwa5UN4NAZQ==', 2),
(16, 'wufgxVSkUPMVjfKRtdW53Q==', 'CgU/NylvhhqLljyPsTjybA==', 12),
(17, 'beGD40yIyCblLQpQU5650A==', '+bmRqgOpt3kqj6Pr5Kqf3w==', 12),
(18, 'LwDwhwfXvxqoo8PU3vXbVA==', 'iBIcT++fpxH6YoV4YXzF0Q==', 8),
(19, 'LkNS369oBvNegzXkBEYpKA==', 'yqs85x55JGjW42pdVGgrew==', 15),
(20, 'iyuNee0FHG9C59HqqMQUHw==', 'XE91HGxlHIrQry6/F7TnRQ==', 11),
(21, 'dEjxa2qzpe2/H9TLHrPWtw==', 'xZDWeIBCP5mOSuMFcZAdLw==', 13),
(22, 'rklqLkpWiObqe+sk6LPg+w==', 'SMIQ7eyNRCCqwpEQP0qElw==', 13),
(24, '28E8argJqopA+uThNVfFgw==', 's7uHkkv1XCjVLf8BDD9x7A==', 3),
(25, 'jLGqhQmhTMVCezD6uBddbQ==', 'HtUGnci7ivredLQj9V9R4A==', 19),
(26, 'uZCq7N3+peA6QOnEY5zXnQ==', 'T+S9UQ/MNT+1eT16oqeyuA==', 12),
(27, 'LUBnJHGxv8o+Qm6BYzN0ug==', 'tlOMNKm8BpmrxaZ5B3yT0w==', 18),
(28, 'GFyi6cKCKlcavyKP493Rng==', 'wl/lylQ4pAqom1n8x+fhJw==', 15),
(29, 'Zk/4aQ5fN0z6NMIUN4lgEQ==', 'Gd0RM8WfAbUnocQlnpPLIA==', 11),
(30, '5K2l8FMWP1EnRAEOFpa7lQ==', 'yqs85x55JGjW42pdVGgrew==', 18),
(31, 'tsjazu0p9ypawV7RhCSvjA==', 'yqs85x55JGjW42pdVGgrew==', 15),
(32, 'HQ/f8q177kt16XPXTaAfMQ==', 'XE91HGxlHIrQry6/F7TnRQ==', 11),
(33, 'pcqBbGLTmSV+37JuwPZRQg==', 'aZs4BdA49Ze/YZXukGMCwg==', 3),
(34, 'Us2uSR7zi/96BWciDph5qg==', 'XKXNShVh9nedjQLzoP/KQg==', 15),
(35, 'W6TwTgrcSnckx/H335jS/Q==', '2yD8kzVGtcYrLq1TSixtYw==', 8),
(36, 'ueMQSrvziEFGupzo3eWD2g==', 'LylVFe8ucTFFuaCLLRyBaA==', 13),
(37, 'gmKxVNQAWVC9ajOHjyq15g==', 'Aap0agnGdBRAWobQoP4SNQ==', 13),
(38, '5ncpW1mAVcYgvGwGTjqO2g==', 'zyliegvdQHDyONztv8yUuw==', 8),
(39, 'u5pNOySLUA1JK4uOfMcVxw==', 'B1XqgFEFNlBS+qExccbGTA==', 7),
(40, 'RIe2R/HHFrKimte/Q4HL9A==', 'DBryIw/HZqTAlkKQnqMiMw==', 18),
(41, '63XvbZ1vCaWpnHNzyDD3OA==', 'g8QSF14nEPWTVUqKcBDGNA==', 8),
(42, '5ncpW1mAVcYgvGwGTjqO2g==', 'UaSE1Z5JThI0+T3o/bp0lQ==', 13),
(43, 'I4lJFz3JbCQr9J9KSpMXUQ==', 'iJno35xXgT6Bp36bl365+w==', 17),
(44, 'BSq4GBkIO0AtRa4m1b+OaA==', 'Bnk275e3/y4pyrfiiDLkjQ==', 20),
(45, 'dcXDWSUFypN7Qv8DMYHbig==', 'jn/2Tl9Xjhe7j8uHe/lV+A==', 8),
(46, 'nsdFlgmhHPsYuIG8HO+JYg==', 'eTgDQ5DsDmqCmaVI76TsDw==', 11),
(47, 'a2AOYSqQ0vjRUCYwenobEg==', 'ocTHpoaMrCFByaVl18kdYQ==', 13),
(48, 'uj9NcI79A+D3moVD/rZlhw==', '4xDo4ykWOuzjdpkaW+7MRQ==', 10),
(49, 'kz1Npl2RiNKDCPpjcEH6Zg==', 'XDnP5laYBb/ZBl6dQQg4qg==', 22),
(50, 'Cl4Nxq8bbOBzpxOmjor35A==', '7gTp74ppFqaGwa5UN4NAZQ==', 13),
(51, '28E8argJqopA+uThNVfFgw==', '13+AYkZcKDQeAw5zb16B9A==', 13),
(52, 'EbbhGavnpYd2xzzm9tUEug==', 'f2ivhNiTO/dk8+9k2ldVRg==', 23),
(53, 'i6cPHVkEzazp2FQ7uLpJWw==', 'vDIHmui7N7T+2f0jTdv6SQ==', 10),
(54, '6yVTLLT6bH5D17v7sozZvA==', 'mbLvxpBOu/Rq5jC1+5EPOQ==', 11),
(55, 'LyuliBmtOYf25k9z6YKRGA==', '3fPiTrnBZ/blU4J17QcJ4A==', 7),
(56, '28AiqfcIclOAngAjCy077w==', 'DVdrMvLI6z3hGO+JxqqN9w==', 20),
(57, 'oY40DocrXqA4TW/4+/wlWA==', 'hi/so882+4cGX2fey9stHg==', 10),
(58, 'c2nBO7UNcTdJI4C6u5EBUA==', '0QsrRz0tML7cQyiH0e9W4g==', 20),
(59, '7ZsUNGvmv2MpKBtFoqlmoA==', 'GKGVaqanbmxtUaJoM7KNqw==', 17),
(60, 'SrxSVMFx8ZUP8C41TEp85A==', '6uSWtt7qb1UlOU8BvhM1vg==', 12),
(61, 'FW43vhGNvLCDog+djMJOKQ==', 'TdFfODQemlkIH7DPZeH/lg==', 3),
(62, '1rULxq+UK++Sh3v8RWZLmQ==', 'TdFfODQemlkIH7DPZeH/lg==', 3),
(63, 'CHOXNUTSwJinxJWUQK11mA==', 'USIhlr2kuEPc5hvuFuf1oQ==', 10),
(64, 'LwDwhwfXvxqoo8PU3vXbVA==', 'aABL0JyQYXmQtIrzqrsZTg==', 20),
(65, '5ncpW1mAVcYgvGwGTjqO2g==', '/JNg1yGUMcF1jcPBzXzwfQ==', 12),
(66, 'cHTBxROEQELMZARu06eadA==', 'jnWvRco1UbZ5B+UCxHKivw==', 13),
(67, 'HrBAKK6FumT+4Ce7zOijWg==', 'GmBsbozcd6kBLNefuZvZZQ==', 14),
(68, 'vkT99WaOLevEvRi/y8uDQg==', 'Ax+YEIvSRuq+EHy8O8sOjg==', 11),
(69, 'CSDgIDSQU6bxwR2xGzqGhQ==', 'N4J+/kD2GjgpqFj9nyUqPw==', 11),
(70, '4zRFlTRC6ix77putrXs+zA==', 'lpafPFMi/81rMafsJQuD4A==', 23),
(71, '4zRFlTRC6ix77putrXs+zA==', 'f33D5R4doODfWfFKFwBgCA==', 23),
(72, '+h4v2iab1Xny8RZKN5Vttg==', 'Gvi/xSEvzQNxZ9Gs090U2Q==', 7),
(73, '5ncpW1mAVcYgvGwGTjqO2g==', 'r9/8OTCA+nPRxFTCQVlkrQ==', 13),
(74, '5ncpW1mAVcYgvGwGTjqO2g==', '7RHTTqNR6yFsFL7QHqYffg==', 15),
(75, 'tYAQ3tjQq8Hw8hdCpM8djw==', 'i/g2KedA0Ff7Z8lErtygwA==', 3),
(76, 'ku+nYCYd1xPHzmp9MGgRVA==', 'x1Ucv5sH6J4MGQy+NQSXwg==', 10),
(77, 'ZkrObvawr+NYPvIEmbVTtQ==', '3l5j6h+dYB0uE09jP/5z8g==', 12),
(78, 'WVptu83DJK+wtQvZ2AQa4Q==', '6cu5/LxN9ZSi4qtOGekmSw==', 7),
(79, 'QtGqP9d4wYrUMZx8wRp7rw==', '14sd0guu9vynMduv3AFpNQ==', 11),
(80, 'Z924w52aV6s5GMUbhcrK/w==', 'FYDmYKNb2dBtrr18PtadGg==', 8),
(81, 'LwDwhwfXvxqoo8PU3vXbVA==', 'mmGRSejO7VHz6rgPvqxbTA==', 3),
(82, 'Oz9SuUF6SdbBBlS1F+BNDw==', 'R6Es/HXPUrewj1PrLMQlGg==', 11),
(83, 'ZkrObvawr+NYPvIEmbVTtQ==', 'T9N2Ea+PWA6QAoqTwCmHrw==', 20),
(84, 'OfVQ5NOSXolDPztMU8nThA==', 'FWIWWQdfh1NI9rW+bLkcFw==', 12),
(85, 'WM6GjT2bukSTZuStQbH6Wg==', 'd57uXzacgneDYOVmDeycxA==', 3),
(86, '0+owUPWMCnt26kbzrkf8HA==', 'Lw+xKKffRl0oLnVdBs+F0w==', 18),
(87, 'Xg2S13kNIFdrgOKtSvk+Hg==', 'YFfx5or34Q+bhhlixn3ykA==', 13),
(88, 'xq1ivvrH6ZpKWPSixCPpUA==', 'hYhCqkaB29sfGAH5Vb1AJg==', 14),
(89, 'sX7mp6oZNftYHkRiuI6SpQ==', 'YDneuEDFrab6SB41dgw1qg==', 12),
(90, '7onhceHFXzfEg0H6eSR9Ig==', 'k0n6HoDf01ecnMjgyFB2KA==', 11),
(91, '8BjRoTsybGBMS6BdJvXENw==', '0J8oZC1TgT08voCjTTIYuQ==', 21),
(92, 'X4CnjGJE4HfvCHJzpmcdPA==', 'V4/7RpAgN1+bdhTC5YMAZg==', 15),
(93, 'vkT99WaOLevEvRi/y8uDQg==', 'RRL5VDL5UC/TevlqPovLGQ==', 19),
(94, '/0ciGyN8z/vfCT0SSNqKxg==', 'uSG3U/IdKvtw0HmG9tIMmg==', 19),
(95, 'v6MNmxC39xQlCV3cMaxl7g==', '2iGn6HXAncMJoxQayfNExg==', 11),
(96, '63XvbZ1vCaWpnHNzyDD3OA==', 'uHaZWgY8FeAqq49KW7Bjtg==', 11),
(97, '/XML+0ENhhcVKM10arPN8g==', 'MRb9LqJJ0CDMj0r4xfQRrg==', 21),
(98, '343BI1O9TWoQbfCWfkz2qA==', 'suuHJ/q4mlyeNytMLwYJOQ==', 16),
(99, '4n9lDETCLOob16BX8HNtlA==', 'BOPDuqizthOL7tptDxmM0Q==', 12),
(100, 'LkNS369oBvNegzXkBEYpKA==', 'aFpkHgRt0MGbq1h9pRpHIw==', 12),
(101, '8omhejpD2g25qYb1HxmcKg==', '71n+3xEyRCfb2D0cAHp35g==', 13),
(102, 'k/EcYFOvKM7XidrZO2IwaQ==', '7j1U9/bUU4kRDfXWSps/PA==', 13),
(103, 's5wo33Likux9rQBSXzB+ow==', 'QWM1C0kSw9PfSJOHycVpDw==', 12),
(104, 'Sb1KTZe8dhLpAfOHUPsWYA==', 'knK9gVMgEPNh/PdKFKVQRg==', 3),
(105, 'R5xptp1/QccqPqoGi7RBvw==', 'ZlolnTnQMm5QtyXnYGNuww==', 19),
(106, 'xq1ivvrH6ZpKWPSixCPpUA==', 'ZlolnTnQMm5QtyXnYGNuww==', 19),
(107, '/kW9J0jm8lIMeH0vUm8Idg==', 'dQTVFUkIoD7s+9SqADbB2g==', 17),
(108, 'twdN5E4D7p/9AUW7SjfnvQ==', 'kCUSXcXv5gcd1O+2k/EFcg==', 21),
(109, '/g2aohIJU1OViRNnByIFiA==', 'I/cS1PowK6uea2UZGUXrHg==', 13),
(110, 'Lw+xKKffRl0oLnVdBs+F0w==', 'ndlVi4fioEqRwKwFacqYUQ==', 3),
(111, 'TZYdEtJ/EcK4oBR/BiXAgw==', 'ndlVi4fioEqRwKwFacqYUQ==', 3),
(112, 'Nt2IM4Kqf//Q6gFRGlnifQ==', 'jI5UkqDCGqkDH4fMvi7+DA==', 9),
(113, '1/b82qMuJI9m/Dw1B4k91w==', 'jI5UkqDCGqkDH4fMvi7+DA==', 9),
(114, 'ifq77B7qNpuXv66Ahxu4DA==', 'rjHuORB6I6HVEENz3bq/Ag==', 7),
(115, 'iyuNee0FHG9C59HqqMQUHw==', 'Cz5bL2p5ZoeLAFsnriaD0A==', 15),
(116, '5ncpW1mAVcYgvGwGTjqO2g==', 'biPuYtW96Df+3FKa0+Vbmg==', 9),
(117, 'gmKxVNQAWVC9ajOHjyq15g==', '1Iul7yaijrhJukptn0IbCQ==', 13),
(118, 'jbmUL4n+9kgRMuDox9iqYw==', 'LZ2WnxBitGojzk5F5d2AAg==', 16),
(119, 'wufgxVSkUPMVjfKRtdW53Q==', 'WbFTQqI0t2JnbTJV5tPwXQ==', 19),
(120, '5ncpW1mAVcYgvGwGTjqO2g==', 'GxzDAvoW3bmmNOiX732qtA==', 17),
(121, 'hdT1Bz406rJzknF8boa4lw==', 'ZkrObvawr+NYPvIEmbVTtQ==', 10),
(122, '0UABtL1R7wWHSloafUgPAQ==', 'EGzIxwTNk3rVCSjI4LhfNA==', 16),
(123, 'J0WpZRiCiewaV1PVFiRHpw==', 'b95M+jCyi1it11wjJLZKnw==', 8),
(124, 'u/4g2F8yXBoV7PapnUDbfw==', 'G+2RthM9B4nF+PP1pLqI2g==', 9),
(125, 'S0EEcONkXVwrvTLbJncLxA==', 'TR4vCr4Um++TPPkwWvqSPQ==', 3),
(126, 'WZLwHxcCE3Zk3YLXTDCNXg==', 'Vazum3ZJsuaT8tladAkFnw==', 12),
(127, 'y/vNEXzVUJFB74GGiIQvjQ==', '5wfRGtuGndjd8+FPLUFg1Q==', 8),
(128, 'IM3pLgWcolvB0o2Tt8an9g==', 'HHDLBV7i1h9wXboxtfEAUA==', 11),
(129, 'X4CnjGJE4HfvCHJzpmcdPA==', 'Q+vBZ+y2Br96AsR+JFuSeg==', 3),
(130, '8BjRoTsybGBMS6BdJvXENw==', 'Q+vBZ+y2Br96AsR+JFuSeg==', 13),
(131, 'DiN+Z8l2tUB7jCxqtu+TVA==', '9+5OYtin1GX+2/3mdyXBPg==', 19),
(132, '7onhceHFXzfEg0H6eSR9Ig==', 'guwkEDxpzJe1vp1eJGbySA==', 13),
(133, 'hGvPopmC4/6Fb5ZI79G0aQ==', 'WCAwZ8jKrujo44XhoBSqHQ==', 16),
(134, '0bOaOGl5y9oGxKn1xipbGg==', '965XmKqWaZhh1r78rvyyUQ==', 10),
(135, '/0ciGyN8z/vfCT0SSNqKxg==', '0NpdrrOU35605DZH7yLpUQ==', 12),
(136, '9cNVrw3OZoPtzhyMh2eq/g==', '6s3BGG0NuSKU5uBiSEeErw==', 10),
(137, 'PAIYDpM9jEBe7OoGmZMBmg==', 'AKZkye4pYq8oThTMCuaQWg==', 11),
(138, 'QtGqP9d4wYrUMZx8wRp7rw==', 'kb6uCMfKsOZlXaAenholYw==', 18),
(139, 'QaAaVrIVL8FWnml3HJyc9w==', 'pFKH+IlrpQ/MgFWSzqFrMw==', 18),
(140, 'iyuNee0FHG9C59HqqMQUHw==', 'pFKH+IlrpQ/MgFWSzqFrMw==', 18),
(141, '3tUjNaQU1LOOWUdIpuHaCw==', 'W2MGitu05xj9oS7v4IF2wg==', 23),
(142, 'pcqBbGLTmSV+37JuwPZRQg==', 'yeg/+bqZYmhYOxHOs52GPw==', 17),
(143, '5nibwWa9IvxpLi/3pLBcyg==', 'idTSm3yhK/Kni7NiAk26ZQ==', 13),
(144, 'BEpqfXveTe0OwJM/o7iWqQ==', 't+m/4h8yR6CFz8EwLJLVOA==', 10),
(145, 'x9JDIv7BFs3HASqO0uIhdg==', 'r3uS9fGyGsAu7pHJCdHo0w==', 12),
(146, 'GFyi6cKCKlcavyKP493Rng==', 'm7h/2A4KfC9pnBPYo1EG4Q==', 3),
(147, 'ciaDC9UxrcWnIY182qdxyg==', '5f4uWBkpfFd/HxrMLYkLfg==', 13),
(148, 'sRRKqIh6y/OphrAt1BLTkA==', 'UR0FfaLJSBFfr6WPg2iBjA==', 23),
(149, 'X4CnjGJE4HfvCHJzpmcdPA==', 'r7CkU0IpHV3VT68uN0bZcg==', 9),
(150, 'cHTBxROEQELMZARu06eadA==', 'Z4N4e3FvflYHZlAalpAELw==', 3),
(151, 'cnp5CjOtuYKQWJord6OeBQ==', 'z+1++7R/pGCysMCmKuv6Iw==', 15),
(152, '6EIbmgaMWYxCOllb/8zqnQ==', 'z+1++7R/pGCysMCmKuv6Iw==', 11),
(153, 'FvnLzx+fFSRSbGbzyAdrgA==', 'z+1++7R/pGCysMCmKuv6Iw==', 11),
(154, 'Z924w52aV6s5GMUbhcrK/w==', 'kqseLXdWsLYv5FWbCGnvuQ==', 11),
(155, '9f2e45BeQURnEHlxoZtFvg==', 'QtGqP9d4wYrUMZx8wRp7rw==', 8),
(156, 'HHDLBV7i1h9wXboxtfEAUA==', 'QtGqP9d4wYrUMZx8wRp7rw==', 14),
(157, 'mIW1k5E/2rmIiwTRwxVIbQ==', 'gBzTc9d8J7vJpm9sHBU/eQ==', 13),
(158, 'zayt2VDxpI3aE7WnaHcZDA==', 'Momsy8opOdrX4eGyyyHMeg==', 16),
(159, 'ZkrObvawr+NYPvIEmbVTtQ==', 'l9bFaSO6FSQGe1rmMel29Q==', 16),
(160, 'IkxkFfvHOKhoISEUhFHTTQ==', 'Mlv9OL0ZLMgCcs7K28xlQA==', 20),
(161, '7cI0/3KO0VL/rv23/T1w0A==', 'boG7NTBCy8hiqVkZSZ9+Jw==', 23),
(162, 'VsT/E2KbwYfNtJTTXL2wmw==', 'TuXhLoGq6NwMYwHqkZfNxw==', 10),
(163, '28E8argJqopA+uThNVfFgw==', 'TuXhLoGq6NwMYwHqkZfNxw==', 10),
(164, 'fXg1Me+q94wXds137sF31w==', 'tyVsIhBLEBUnPuiY360w8A==', 11);

-- --------------------------------------------------------

--
-- Structure de la table `licencie_categorie`
--

CREATE TABLE `licencie_categorie` (
  `idlicencie_categorie` int(10) NOT NULL AUTO_INCREMENT,
  `idcategorie` int(10) NOT NULL,
  `idlicencie` int(10) NOT NULL,
  PRIMARY KEY (`idlicencie_categorie`),
  UNIQUE KEY `idcategorie` (`idcategorie`,`idlicencie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Contenu de la table `licencie_categorie`
--

INSERT INTO `licencie_categorie` (`idlicencie_categorie`, `idcategorie`, `idlicencie`) VALUES
(2, 1, 185),
(6, 1, 250),
(3, 1, 281),
(4, 4, 250),
(5, 4, 251),
(68, 13, 37),
(69, 13, 54),
(70, 13, 55),
(71, 13, 56),
(72, 13, 57),
(73, 13, 160),
(74, 13, 161),
(75, 13, 162),
(76, 13, 163),
(77, 13, 164),
(58, 13, 175),
(59, 13, 192),
(60, 13, 193),
(61, 13, 194),
(62, 13, 195),
(63, 13, 300),
(64, 13, 301),
(65, 13, 302),
(66, 13, 303),
(67, 13, 304);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Contenu de la table `log`
--

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
  `idlicencie` int(10) NOT NULL,
  `numero_poule` int(2) NOT NULL,
  `classement` int(1) NOT NULL,
  `idcategorie` int(10) NOT NULL,
  PRIMARY KEY (`idlicencie`,`numero_poule`,`classement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `resultat_poule`
--

INSERT INTO `resultat_poule` (`idlicencie`, `numero_poule`, `classement`, `idcategorie`) VALUES
(37, 2, 1, 13),
(54, 1, 2, 13),
(55, 1, 3, 13),
(56, 3, 2, 13),
(57, 2, 2, 13),
(160, 2, 3, 13),
(161, 3, 4, 13),
(162, 3, 3, 13),
(163, 3, 1, 13),
(164, 1, 1, 13);

-- --------------------------------------------------------

--
-- Structure de la table `tirage`
--

CREATE TABLE `tirage` (
  `idtirage` int(10) NOT NULL AUTO_INCREMENT,
  `idlicencie` int(10) NOT NULL,
  `idcategorie` int(10) NOT NULL,
  `numero_poule` int(10) NOT NULL,
  `position_poule` int(1) NOT NULL,
  PRIMARY KEY (`idtirage`),
  UNIQUE KEY `UK_tirage` (`idlicencie`,`idcategorie`,`numero_poule`,`position_poule`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=171 ;

--
-- Contenu de la table `tirage`
--

INSERT INTO `tirage` (`idtirage`, `idlicencie`, `idcategorie`, `numero_poule`, `position_poule`) VALUES
(164, 37, 13, 2, 1),
(163, 54, 13, 1, 3),
(162, 55, 13, 1, 2),
(170, 56, 13, 3, 4),
(165, 57, 13, 2, 2),
(166, 160, 13, 2, 3),
(168, 161, 13, 3, 2),
(169, 162, 13, 3, 3),
(167, 163, 13, 3, 1),
(161, 164, 13, 1, 1);
