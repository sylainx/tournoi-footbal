CREATE  DATABASE tournoisoccer;
USE tournoisoccer;
--
-- Base de données :  `tournoisoccer`
--

-- --------------------------------------------------------

--
-- Structure de la table `classementgroupea`
--

CREATE  TABLE `classementgroupea` (
  `idEquipe` int(10) UNSIGNED NOT NULL,
  `nomEquipe` varchar(50) NOT NULL,
  `groupe` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `mj` int(5) NOT NULL,
  `mg` int(5) NOT NULL,
  `mn` int(5) NOT NULL,
  `mp` int(5) NOT NULL,
  `bp` int(5) NOT NULL,
  `bc` int(5) NOT NULL,
  `point` int(5) NOT NULL,
  `diff` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `classementgroupeb`
--

CREATE  TABLE `classementgroupeb` (
  `idEquipe` int(10) UNSIGNED NOT NULL,
  `nomEquipe` varchar(50) NOT NULL,
  `groupe` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `mj` int(5) NOT NULL,
  `mg` int(5) NOT NULL,
  `mn` int(5) NOT NULL,
  `mp` int(5) NOT NULL,
  `bp` int(5) NOT NULL,
  `bc` int(5) NOT NULL,
  `point` int(5) NOT NULL,
  `diff` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `demifinal`
--

CREATE  TABLE `demifinal` (
  `id` int(10) DEFAULT NULL,
  `equipe1` varchar(255) NOT NULL,
  `equipe2` varchar(255) NOT NULL,
  `score1` int(10) UNSIGNED DEFAULT NULL,
  `score2` int(10) UNSIGNED DEFAULT NULL,
  `gagnant` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `grandefinal`
--

CREATE  TABLE `grandefinal` (
  `id` int(10) NOT NULL,
  `nomEquipe` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `listematchs`
--

CREATE  TABLE `listematchs` (
  `numeroMatch` int(10) NOT NULL,
  `equipe1` varchar(20) NOT NULL,
  `equipe2` varchar(20) NOT NULL,
  `score1` int(10) NOT NULL,
  `score2` int(10) NOT NULL,
  `gagnant` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `petitefinal`
--

CREATE  TABLE `petitefinal` (
  `id` int(10) NOT NULL,
  `nomEquipe` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `classementgroupea`
--
ALTER TABLE `classementgroupea`
  ADD PRIMARY KEY (`idEquipe`);

--
-- Index pour la table `classementgroupeb`
--
ALTER TABLE `classementgroupeb`
  ADD PRIMARY KEY (`idEquipe`);

--
-- Index pour la table `demifinal`
--
ALTER TABLE `demifinal`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `grandefinal`
--
ALTER TABLE `grandefinal`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `classementgroupea`
--
ALTER TABLE `classementgroupea`
  MODIFY `idEquipe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `classementgroupeb`
--
ALTER TABLE `classementgroupeb`
  MODIFY `idEquipe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;



-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE  TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `ip` varchar(30) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
