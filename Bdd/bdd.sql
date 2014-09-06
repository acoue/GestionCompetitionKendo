-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 26 Juillet 2014 à 16:51
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
  UNIQUE KEY `libelle` (`libelle`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

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
  PRIMARY KEY (`idcompetition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `competition`
--

INSERT INTO `competition` (`idcompetition`, `libelle`, `datecompetition`, `lieux`, `type`, `description`, `selected`) VALUES
(1, 'Inter-Région Ouest', '2014-02-28', 'Paris', 0, 'Competition de test', 1),
(2, 'test equipe', '2014-03-29', '', 1, 'Competition par equipe', 0),
(4, 'TEST4', '2014-02-02', NULL, 0, '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `historique_tirage`
--

INSERT INTO `historique_tirage` (`idhistorique`, `idcategorie`, `date_tirage`, `idcompetition`) VALUES
(31, 13, '2014-07-26', 1),
(32, 10, '2014-07-26', 1),
(39, 1, '2014-07-26', 1);

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
(87, 13, '56UmOBm0TdWgLvEAVwB/Ag==', 'YFfx5or34Q+bhhlixn3ykA=='),
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
(152, 11, 'h1DuSO3QI8g1mhrrMT94eA==', 'z+1++7R/pGCysMCmKuv6Iw=='),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=635 ;


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
