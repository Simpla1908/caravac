-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 avr. 2026 à 18:27
-- Version du serveur :  5.7.36
-- Version de PHP : 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `caravacdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `accompagnmnt_boisson`
--

DROP TABLE IF EXISTS `accompagnmnt_boisson`;
CREATE TABLE IF NOT EXISTS `accompagnmnt_boisson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib` varchar(50) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `accompagnmnt_boisson`
--

INSERT INTO `accompagnmnt_boisson` (`id`, `lib`, `syn`) VALUES
(1, 'avec paille', 1),
(2, 'sans paille', 1),
(3, 'avec glacon', 1);

-- --------------------------------------------------------

--
-- Structure de la table `accuse_reception`
--

DROP TABLE IF EXISTS `accuse_reception`;
CREATE TABLE IF NOT EXISTS `accuse_reception` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `sujet` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `statut` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `accuse_reception`
--

INSERT INTO `accuse_reception` (`id`, `email`, `nom`, `sujet`, `message`, `statut`, `date`, `company_id`, `syn`) VALUES
(112, 'lulu@ebutelo.com', 'Lulu&Chacha Lulu&Chacha', 'EBUTELO-Souscription', '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <meta charset=\\\"UTF-8\\\">\r\n        <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\r\n    </head>\r\n    <body style=\"font-family: Helvetica, Arial, Sans-Serif;\">\r\n    <div style=\"height:530px; \r\n                width:772px;\r\n                background: #f2f2f2;\r\n                margin: auto;\r\n                border-radius: 5px;\r\n                padding: 50px; \r\n                padding-top: 20px;\r\n                border: 1px solid #c5c5c5;\">\r\n        <header id=\"top_header\" style=\"margin: 0 10px 10px 0;\">\r\n            <img src=\"../css/assets/img/logo_bks.png\" height=\"81\" width=\"110\"/>\r\n        </header>\r\n        \r\n        <section style=\"clear: both;\r\n                        border-top: 1px solid #eaeaea;\">\r\n            <b>EBUTELO (Souscription)</b>\r\n            <p>\r\n                Cher client, <br/><br/>\r\n                Votre essai gratuit de 15 jours vient dâ€™Ãªtre effectuer avec succÃ¨s. \r\n                Veuillez cliquer sur le lien ci-aprÃ¨s <a target=\"_blank\" href=\"www.ebutelo.com/test/login.php?sous_id=199&hotel_id=356\">Confirmer votre compte</a> pour acceder au logiciel avec le nom dâ€™utilisateur et le mot de passe que vous avez crÃ©Ã©s Ã  la souscription. <br/><br/>\r\n                En cas de difficultÃ©, nâ€™hÃ©site pas Ã  nous contacter au +243 85 464 6679 ou info@ebutelo.com <br/><br/>\r\n                \r\n                <p>\r\n                    <b>Indentifiants de Connexion:</b><br/>\r\n                    - Login: admin<br/>\r\n                    - Mot de passe: admin\r\n                </p>\r\n                Merci de votre confiance !<br/><br/>\r\n                Service Commercial. \r\n\r\n            </p>\r\n        </section>\r\n\r\n        <footer style=\"clear: both;\r\n                       color: #000;\r\n                       border-top: 1px solid #eaeaea;\r\n                       text-align: center;\r\n                       margin-top: 20px; \">\r\n            <p style=\"font-size: 11px;\">\r\n                <span class=\"muted\"><b>EBUTELO  </b><br/>\r\n                    <b>RCCM </b>: 16-B-10.039, <b>Id. Nat.</b> : 01-9-N10348L, <b>NÂ° ImpÃ´t</b> : A1612552M <br/> \r\n                    KINSHASA-RDCongo - <b>Contact</b> :+243854646679,info@ebutelo.com <br/>\r\n                    Copyright &copy; <?php echo strftime(\"%Y\"); ?> | </span> \r\n                <a href=\"#\">Facebook</a> Â· Â·\r\n                <a href=\"#\">YouTube</a>\r\n            </p>\r\n        </footer>\r\n    </div>\r\n</body>\r\n</html>', 'envoye', '2019-12-11 23:57:29', 299, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ach_livraison`
--

DROP TABLE IF EXISTS `ach_livraison`;
CREATE TABLE IF NOT EXISTS `ach_livraison` (
  `id_liv` int(11) NOT NULL AUTO_INCREMENT,
  `first` int(11) DEFAULT '0',
  `numBon_liv` varchar(20) DEFAULT NULL,
  `numBon_cmd` varchar(20) DEFAULT '0',
  `date` date DEFAULT NULL,
  `date_h` datetime DEFAULT NULL,
  `bcommande_id` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_liv`),
  KEY `bcommande_id` (`bcommande_id`,`fournisseur_id`,`user_id`),
  KEY `fournisseur_id` (`fournisseur_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ach_produits_livres`
--

DROP TABLE IF EXISTS `ach_produits_livres`;
CREATE TABLE IF NOT EXISTS `ach_produits_livres` (
  `id_produit_liv` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(20) DEFAULT NULL,
  `quantite_cmd` int(20) DEFAULT NULL,
  `quantite_liv` int(20) DEFAULT NULL,
  `observation` text,
  `produit_id` int(11) DEFAULT NULL,
  `livraison_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_produit_liv`),
  KEY `produit_id` (`produit_id`,`livraison_id`,`user_id`),
  KEY `livraison_id` (`livraison_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id_act` int(11) NOT NULL AUTO_INCREMENT,
  `code_act` varchar(20) NOT NULL,
  `lib_act` varchar(500) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `affiche` int(11) NOT NULL DEFAULT '1',
  `module_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_act`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=628 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id_act`, `code_act`, `lib_act`, `visible`, `affiche`, `module_id`, `syn`) VALUES
(344, 'VMH', 'VOIR MODULE HEBERGEMENT', 0, 1, 23, 1),
(345, 'VMR', 'VOIR MODULE RESTAURANT', 0, 1, 22, 1),
(346, 'VMS', 'VOIR MODULE STOCK', 0, 1, 24, 1),
(347, 'VMCR', 'VOIR MODULE CONFIGURATIONS & REGLAGES\r\n', 0, 1, 25, 1),
(359, 'ER', 'ENREGISTRER UNE RESERVATION', 1, 1, 23, 1),
(360, 'VR', 'VOIR TOUTES LES FACTURES', 1, 1, 23, 1),
(361, 'ILR', 'VOIR TOUTES LES RESERVATIONS', 1, 0, 23, 1),
(362, 'MR', 'MODIFIER RESERVATION', 1, 0, 23, 1),
(363, 'VO', 'VOIR TOUTES LES OCCUPATIONS', 1, 0, 23, 1),
(364, 'EO', 'ENREGISTRER UNE OCCUPATION', 1, 1, 23, 1),
(365, 'CC', 'CHANGER DE CHAMBRE', 1, 1, 23, 1),
(366, 'VLIB', 'VOIR TOUTES LES LIBERATIONS', 1, 0, 23, 1),
(367, 'SITCLL', 'SITUATION CLIENT LOGES', 1, 0, 23, 1),
(368, 'IMPRCLSS', 'IMPRIMER CLASSEUR', 1, 0, 23, 1),
(369, 'AJTCL', 'AJOUTER CLIENT', 1, 1, 23, 1),
(370, 'MINFCLI', 'MODIFIER INFORMATION CLIENT', 1, 1, 23, 1),
(371, 'SCLI', 'SUPPRIMER CLIENT', 1, 1, 23, 1),
(372, 'IMPRCLI', 'IMPRIMER LISTE CLIENT', 1, 0, 23, 1),
(373, 'ENRECL', 'ENREGISTRER RECLAMATION', 1, 0, 23, 1),
(374, 'LSTRECL', 'LISTE RECLAMATIONS', 1, 0, 23, 1),
(375, 'TBS', 'TABLEAU BORD STOCK', 1, 1, 24, 1),
(376, 'APPRL', 'VOIR APPROVISIONNEMENT ', 1, 1, 24, 1),
(377, 'APPRA', 'AJOUTER APPROVISIONNEMENT', 1, 1, 24, 1),
(378, 'APPRM', 'MODIFIER APPROVISIONNEMENT', 1, 1, 24, 1),
(379, 'APPRS', 'SUPPRIMER APPROVISIONNEMENT', 1, 1, 24, 1),
(380, 'SORL', 'VOIR SORTIE', 1, 1, 24, 1),
(381, 'SORA', 'AJOUTER SORTIE', 1, 1, 24, 1),
(382, 'SORM', 'MODIFIER SORTIE', 1, 1, 24, 1),
(383, 'SORS', 'SUPPRIMER SORTIE', 1, 1, 24, 1),
(384, 'RPF', 'VOIR RAPPORT PRODUIT FAMILLE', 1, 1, 24, 1),
(385, 'RFA', 'VOIR RAPPORT FICHE ARTICLE', 1, 1, 24, 1),
(386, 'PARART', 'PARAMETRER ARTICLE', 1, 1, 24, 1),
(387, 'CCH', 'CREER HOTEL', 1, 1, 25, 1),
(388, 'CCC', 'CREER CHAMBRE', 1, 1, 25, 1),
(389, 'CMIH', 'MODIFIER INFORMATION HOTEL', 1, 1, 25, 1),
(390, 'CMC', 'MODIFIER CHAMBRE', 1, 1, 25, 1),
(391, 'CAU', 'AJOUTER UTILISATEUR', 1, 1, 25, 1),
(392, 'CMU', 'MODIFIER UTILISATEUR', 1, 1, 25, 1),
(393, 'CSU', 'SUPPRIMER UTILISATEUR', 1, 1, 25, 1),
(394, 'CVU', 'VOIR LA LISTE DES UTILISATEURS', 1, 1, 25, 1),
(395, 'CVP', 'VOIR LA LISTE DES PARTENAIRES', 1, 1, 25, 1),
(396, 'CAP', 'AJOUTER PARTENAIRE', 1, 1, 25, 1),
(397, 'CSP', 'SUPPRIMER PARTENAIRE', 1, 1, 25, 1),
(398, 'CMP', 'MODIFIER PARTENAIRE', 1, 1, 25, 1),
(399, 'CDT', 'DEFINIR TAUX', 1, 1, 25, 1),
(400, 'CDM', 'DEFINIR MONNAIE', 1, 1, 25, 1),
(401, 'RTR', 'RESERVATION TABLE RESTAURANT', 1, 1, 22, 1),
(402, 'ART', 'ANNULER RESERVATION TABLE', 1, 1, 22, 1),
(403, 'RM', 'REMISE COMMANDE', 1, 1, 22, 1),
(404, 'RV', 'VOIR TOUS LES DETAILS VENTES', 1, 1, 22, 1),
(405, 'V', 'VENTE', 1, 0, 22, 1),
(406, 'ATR', 'AJOUTER TABLE RESTAURANT', 1, 1, 22, 1),
(407, 'IBE', 'IMPRIMER BON D\'ENTREE', 1, 1, 24, 1),
(408, 'IBS', 'IMPRIMER BON DE SORTIE', 1, 1, 24, 1),
(409, 'VLTR', 'VOIR LISTE TABLE RESTAURANT', 1, 1, 22, 1),
(410, 'EL', 'LIBERER LES CLIENTS LOGES', 1, 1, 23, 1),
(411, 'VLCLI', 'VOIR LISTE DES CLIENTS', 1, 1, 23, 1),
(412, 'AR', 'ANNULER RESERVATION', 1, 0, 23, 1),
(413, 'ILO', 'IMPRIMER LISTE DES OCCUPATIONS', 1, 0, 23, 1),
(414, 'ILL', 'IMPRIMER LISTE DES LIBERATIONS', 1, 0, 23, 1),
(415, 'VTCR', 'VOIR TOUTES LES FACTURES', 1, 1, 22, 1),
(416, 'VSPCER', 'VOIR SES PROPRES FACTURES ENREGISTREES', 1, 1, 22, 1),
(417, 'VTVS', 'VOIR TOUS LES VERSEMENTS', 1, 1, 22, 1),
(418, 'VSPVS', 'VOIR SES PROPRES VERSEMENTS', 1, 1, 22, 1),
(419, 'PPR', 'PARAMETRAGE DES PLATS', 1, 1, 22, 1),
(420, 'AR1', 'IMPRIMER ADDITION', 1, 1, 22, 1),
(421, 'AR2', 'IMPRIMER BON DE COMMANDE', 1, 1, 22, 1),
(422, 'AR3', 'METTRE COMMANDE EN ATTENTE', 1, 1, 22, 1),
(423, 'AR4', 'ENREGISTRER PAIEMENT FACTURE', 1, 1, 22, 1),
(424, 'AR5', 'ANNULER COMMANDE', 1, 1, 22, 1),
(425, 'AR6', 'VOIR CLIENTS', 1, 1, 22, 1),
(426, 'AR7', 'VOIR TOUS LES TICKETS EN ATTENTE', 1, 1, 22, 1),
(427, 'AR8', 'VOIR PRODUITS EN RUPTURE DE STOCK', 1, 0, 22, 1),
(428, 'AR9', 'ENREGISTRER VERSEMENT CAISSE', 1, 1, 22, 1),
(429, 'AR10', 'MODIFIER INFOS SOUS-SITE', 1, 1, 22, 1),
(430, 'AR11', 'MODIFIER QUANTITE PRODUIT', 1, 1, 22, 1),
(431, 'AR12', 'SUPPRIMER PRODUIT COMMANDE', 1, 1, 22, 1),
(432, 'VSPRCT', 'VOIR SES PROPRES RECETTES', 1, 0, 23, 1),
(433, 'VTRCT', 'VOIR TOUTES LES RECETTES', 1, 1, 23, 1),
(434, 'VRH', 'VOIR MODULE RH', 0, 1, 26, 1),
(441, 'RHFSI', 'FAIRE LA SAISIE INFORMATION', 1, 1, 26, 1),
(442, 'RHMIE', 'MODIFIER LES INFOS DES EMPLOYES', 1, 1, 26, 1),
(443, 'RHLE', 'VOIR LA LISTE DES EMPLOYES', 1, 1, 26, 1),
(444, 'RHGS', 'GERER LES SANCTIONS', 1, 1, 26, 1),
(445, 'RHGC', 'GERER LES CONGES', 1, 1, 26, 1),
(446, 'RHGR', 'GERER LES RESILIATIONS', 1, 1, 26, 1),
(447, 'RHGBM', 'GERER LES BONS DES MALADES', 1, 1, 26, 1),
(448, 'RHGPAIE', 'GERER LA PAIE', 1, 1, 26, 1),
(449, 'RHGPOINT', 'GERER LE POINTAGE', 1, 1, 26, 1),
(450, 'RHFCONF', 'FAIRE LA CONFIGURATION', 1, 1, 26, 1),
(451, 'VSPTA', 'VOIR SES PROPRES TICKETS EN ATTENTE', 1, 1, 22, 1),
(452, 'VSV', 'VOIR SES PROPRES DETAILS VENTES', 1, 1, 22, 1),
(453, 'VFTSR', 'AVOIR LA POSSIBILITE DE CHANGER DE SOUS-SITES', 1, 1, 22, 1),
(454, 'CSR', 'CREATION DES SOUS-RESTO', 1, 0, 22, 1),
(455, 'VTV', 'VOIR TOUTE LES VENTES', 1, 0, 22, 1),
(456, 'AGS1', 'ACTIVER LA GESTION DE SERVEUR', 1, 1, 22, 1),
(457, 'FCTRTN', 'PAYER UNE FACTURE', 1, 1, 23, 1),
(458, 'FAFACTN', 'CREER FACTURE NORMALE\r\n', 1, 1, 27, 1),
(459, 'FAFACTP', 'CREER FACTURE PROFORMA', 1, 1, 27, 1),
(460, 'FAPAIE', 'EFFECTUER PAIEMENT', 1, 1, 27, 1),
(461, 'FALPAIE', 'LISTER LES PAIEMENTS', 1, 1, 27, 1),
(462, 'FAXTVA', 'CONSULTER EXTRAIT TVA', 1, 1, 27, 1),
(463, 'FAXCPT', 'CONSULTER EXTRAIT DE COMPTE', 1, 1, 27, 1),
(464, 'FAGCLT', 'GERER LES CLIENTS', 1, 1, 27, 1),
(465, 'FAGART', 'GERER LES ARTICLES', 1, 1, 27, 1),
(466, 'FACONFIG', 'CONFIGURER MODULE DE FACTURATION', 1, 1, 27, 1),
(467, 'VMFACT', 'VOIR MODULE FACTURATION', 0, 1, 27, 1),
(493, 'AR13', 'VOIR LA FICHE DE STOCK', 1, 1, 22, 1),
(494, 'AR14', 'VOIR LE TABLEAU DE BORD PRINCIPAL', 1, 1, 22, 1),
(495, 'AR15', 'AJOUTER ET MODIFIER CLIENT', 1, 1, 22, 1),
(496, 'AR16', 'SUPPRIMER CLIENT', 1, 1, 22, 1),
(497, 'HVPL1', 'VOIR LE PLANNING', 1, 1, 23, 1),
(498, 'HMNNTE', 'MODIFIER NOMBRE NUITEE', 1, 1, 23, 1),
(499, 'HIFC', 'INSERER FONDS DE CAISSE', 1, 1, 23, 1),
(500, 'HLTVMT', 'VOIR LA LISTE DE TOUS LES VERSEMENTS', 1, 1, 23, 1),
(501, 'HENRVSM', 'ENREGISTRER UN VERSEMENT', 1, 1, 23, 1),
(502, 'HVTBP', 'VOIR LE TABLEAU DE BORD PRINCIPAL', 1, 1, 23, 1),
(503, 'HFCT', 'FAIRE LA CONFIGURATION', 1, 1, 23, 1),
(505, 'HDTV', 'VOIR DETAILS VENTE', 1, 1, 23, 1),
(563, 'VMPOS', 'VOIR MODULE POS', 0, 1, 29, 1),
(564, 'RM', 'REMISE COMMANDE', 1, 1, 29, 1),
(565, 'RV', 'VOIR TOUS LES DETAILS VENTES', 1, 1, 29, 1),
(566, 'V', 'VENTE', 1, 0, 29, 1),
(567, 'VTCR', 'VOIR TOUTES LES FACTURES', 1, 1, 29, 1),
(568, 'VSPCER', 'VOIR SES PROPRES FACTURES ENREGISTREES', 1, 1, 29, 1),
(569, 'VTVS', 'VOIR TOUS LES VERSEMENTS', 1, 1, 29, 1),
(570, 'VSPVS', 'VOIR SES PROPRES VERSEMENTS', 1, 1, 29, 1),
(571, 'AR3', 'METTRE COMMANDE EN ATTENTE', 1, 1, 29, 1),
(572, 'AR4', 'ENREGISTRER PAIEMENT FACTURE', 1, 1, 29, 1),
(573, 'AR5', 'ANNULER COMMANDE', 1, 1, 29, 1),
(574, 'AR6', 'VOIR CLIENTS', 1, 1, 29, 1),
(575, 'AR7', 'VOIR TOUS LES TICKETS EN ATTENTE', 1, 1, 29, 1),
(576, 'AR8', 'VOIR PRODUITS EN RUPTURE DE STOCK', 1, 0, 29, 1),
(577, 'AR9', 'ENREGISTRER VERSEMENT CAISSE', 1, 1, 29, 1),
(578, 'AR10', 'MODIFIER INFOS SOUS-SITE', 1, 1, 29, 1),
(579, 'AR11', 'MODIFIER QUANTITE PRODUIT', 1, 1, 29, 1),
(580, 'AR12', 'SUPPRIMER PRODUIT COMMANDE', 1, 1, 29, 1),
(581, 'VSPTA', 'VOIR SES PROPRES TICKETS EN ATTENTE', 1, 1, 29, 1),
(582, 'VSV', 'VOIR SES PROPRES DETAILS VENTES', 1, 1, 29, 1),
(583, 'VFTSR', 'AVOIR LA POSSIBILITE DE CHANGER DE SOUS-SITES', 1, 1, 29, 1),
(584, 'CSR', 'CREATION DES SOUS-RESTO', 1, 0, 29, 1),
(585, 'VTV', 'VOIR TOUTE LES VENTES', 1, 0, 29, 1),
(586, 'AGS1', 'ACTIVER LA GESTION DE SERVEUR', 1, 1, 29, 1),
(587, 'AR13', 'VOIR LA FICHE DE STOCK', 1, 1, 29, 1),
(588, 'AR14', 'VOIR LE TABLEAU DE BORD PRINCIPAL', 1, 1, 29, 1),
(589, 'AR15', 'AJOUTER ET MODIFIER CLIENT', 1, 1, 29, 1),
(590, 'AR16', 'SUPPRIMER CLIENT', 1, 1, 29, 1),
(592, 'VMC', 'VOIR MODULE COMPTABILITE', 0, 1, 21, 1),
(593, 'CPTACCESSCOMPTA', 'ACCEDER A LA COMPTABILITE', 1, 1, 21, 1),
(594, 'CPTMODIFTRES', 'MODIFIER LES ENCAISSEMENTS ET LES DECAISSEMENTS', 1, 1, 21, 1),
(595, 'CPTSUPPRTRES', 'SUPPRIMER LES ENCAISSEMENTS ET LES DECAISSEMENTS', 1, 1, 21, 1),
(596, 'CPTJC', 'VOIR JOURNAL DE CAISSE ET PAS LES AUTRES JOURNAUX', 1, 1, 21, 1),
(597, 'CPTTRESOR', 'ACCEDER A LA TRESORERIE', 1, 1, 21, 1),
(598, 'CPTAJOUTTRES', 'AJOUTER LES ENCAISSEMENTS ET LES DECAISSEMENTS', 1, 1, 21, 1),
(599, 'CPTLISTJOURN', 'LISTE DES JOURNAUX', 1, 1, 21, 1),
(600, 'CPTJOURNLSR', 'JOURNALISER', 1, 1, 21, 1),
(601, 'TBLOCP', 'VOIR SEULEMENT LES TABLES OCCUPEES', 1, 1, 22, 1),
(604, 'EFDEP', 'EFFECTUER DEPENSE', 1, 1, 22, 1),
(605, 'VSPTOCC', 'VOIR SES PROPRES TABLES OCCUPEES', 1, 1, 22, 1),
(606, 'VLISTCOUVER', 'VOIR LISTE DE COUVERTS', 1, 1, 22, 1),
(607, 'FDCRESTO', 'FONDS DE CAISSE', 1, 1, 22, 1),
(608, 'VTOUTESTABL', 'VOIR TABLES SERVEURS', 1, 1, 22, 1),
(609, 'VCLCONS', 'VOIR SEULEMENT LES CLIENTS QUI CONSOMMENT', 1, 1, 22, 1),
(610, 'VSCQOC', 'VOIR SEULEMENT LES CLIENTS QUI ONT COMMANDE', 1, 1, 22, 1),
(611, 'FSNTBL', 'FUSIONNER LES TABLES OU LES CLIENTS', 1, 1, 22, 1),
(612, 'ECLTMNT', 'ECLATER UNE FACTURE', 1, 1, 22, 1),
(613, 'XTRTCPTE', 'EXTRAIRE LES COMPTES D\'UN CLIENT', 1, 1, 22, 1),
(614, 'CHGETBL', 'CHANGER DE TABLE', 1, 1, 22, 1),
(615, 'MODFCOUVER', 'MODIFIER COUVERT', 1, 1, 22, 1),
(616, 'AR6T', 'VOIR CLIENTS SERVEUR', 1, 1, 22, 1),
(617, 'VRLSTCL', 'VOIR LISTE DES CLIENTS', 1, 1, 22, 1),
(618, 'VMODCUIS', 'VOIR MODULE CUISINE', 1, 1, 22, 1),
(622, 'VMODBAR', 'VOIR MODULE BAR', 1, 1, 22, 1),
(623, 'REIMPRBN', 'RE-IMPRIMER BON DE COMMANDE', 1, 1, 22, 1),
(624, 'UPDATEFDC', 'MODIFIDIER FDC', 1, 1, 22, 1),
(625, 'DELFDC', 'SUPPRIMER FDC', 1, 1, 22, 1),
(626, 'UPDATEDEP', 'MODIFIER DEPENSE', 1, 1, 22, 1),
(627, 'DELDEP', 'SUPPRIMER DEPENSE', 1, 1, 22, 1);

-- --------------------------------------------------------

--
-- Structure de la table `actions_groupe`
--

DROP TABLE IF EXISTS `actions_groupe`;
CREATE TABLE IF NOT EXISTS `actions_groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL,
  `action_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=980 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actions_groupe`
--

INSERT INTO `actions_groupe` (`id`, `group_id`, `action_id`, `syn`) VALUES
(702, 1, 456, 0),
(703, 1, 495, 0),
(704, 1, 406, 0),
(705, 1, 424, 0),
(706, 1, 402, 0),
(707, 1, 453, 0),
(708, 1, 614, 0),
(709, 1, 612, 0),
(710, 1, 604, 0),
(711, 1, 423, 0),
(712, 1, 428, 0),
(713, 1, 613, 0),
(714, 1, 607, 0),
(715, 1, 611, 0),
(716, 1, 420, 0),
(717, 1, 421, 0),
(718, 1, 422, 0),
(719, 1, 615, 0),
(720, 1, 429, 0),
(721, 1, 430, 0),
(722, 1, 419, 0),
(723, 1, 623, 0),
(724, 1, 403, 0),
(725, 1, 401, 0),
(726, 1, 496, 0),
(727, 1, 431, 0),
(728, 1, 425, 0),
(729, 1, 616, 0),
(730, 1, 493, 0),
(731, 1, 494, 0),
(732, 1, 606, 0),
(733, 1, 617, 0),
(734, 1, 409, 0),
(735, 1, 622, 0),
(736, 1, 618, 0),
(737, 1, 345, 0),
(738, 1, 452, 0),
(739, 1, 416, 0),
(740, 1, 605, 0),
(741, 1, 451, 0),
(742, 1, 418, 0),
(743, 1, 609, 0),
(744, 1, 610, 0),
(745, 1, 601, 0),
(746, 1, 608, 0),
(747, 1, 404, 0),
(748, 1, 426, 0),
(749, 1, 417, 0),
(750, 1, 415, 0),
(814, 5, 345, 0),
(815, 5, 425, 0),
(816, 5, 616, 0),
(817, 5, 493, 0),
(818, 5, 494, 0),
(819, 5, 606, 0),
(820, 5, 617, 0),
(821, 5, 409, 0),
(822, 5, 622, 0),
(823, 5, 618, 0),
(824, 5, 345, 0),
(825, 5, 452, 0),
(826, 5, 416, 0),
(827, 5, 605, 0),
(828, 5, 451, 0),
(829, 5, 418, 0),
(830, 5, 609, 0),
(831, 5, 610, 0),
(832, 5, 601, 0),
(833, 5, 608, 0),
(834, 5, 404, 0),
(835, 5, 426, 0),
(836, 5, 417, 0),
(837, 5, 415, 0),
(915, 2, 424, 0),
(916, 2, 614, 0),
(917, 2, 612, 0),
(918, 2, 604, 0),
(919, 2, 423, 0),
(920, 2, 428, 0),
(921, 2, 613, 0),
(922, 2, 607, 0),
(923, 2, 611, 0),
(924, 2, 420, 0),
(925, 2, 421, 0),
(926, 2, 422, 0),
(927, 2, 615, 0),
(928, 2, 430, 0),
(929, 2, 623, 0),
(930, 2, 401, 0),
(931, 2, 431, 0),
(932, 2, 425, 0),
(933, 2, 616, 0),
(934, 2, 493, 0),
(935, 2, 606, 0),
(936, 2, 617, 0),
(937, 2, 409, 0),
(938, 2, 345, 0),
(939, 2, 605, 0),
(940, 2, 451, 0),
(941, 2, 418, 0),
(942, 2, 609, 0),
(943, 2, 610, 0),
(944, 2, 601, 0),
(945, 2, 608, 0),
(946, 2, 404, 0),
(947, 2, 415, 0),
(948, 4, 424, 0),
(949, 4, 421, 0),
(950, 4, 422, 0),
(951, 4, 430, 0),
(952, 4, 623, 0),
(953, 4, 431, 0),
(954, 4, 425, 0),
(955, 4, 345, 0),
(956, 4, 608, 0),
(967, 3, 377, 0),
(968, 3, 407, 0),
(969, 3, 408, 0),
(970, 3, 386, 0),
(971, 3, 375, 0),
(972, 3, 376, 0),
(973, 3, 346, 0),
(974, 3, 385, 0),
(975, 3, 384, 0),
(976, 3, 380, 0),
(977, 6, 345, 0),
(978, 6, 419, 0),
(979, 6, 345, 0);

-- --------------------------------------------------------

--
-- Structure de la table `affectation_sousresto`
--

DROP TABLE IF EXISTS `affectation_sousresto`;
CREATE TABLE IF NOT EXISTS `affectation_sousresto` (
  `id_affect` int(10) NOT NULL AUTO_INCREMENT,
  `date_affect` date NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `sousresto_id` int(10) DEFAULT NULL,
  `statut` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_affect`),
  KEY `user_id` (`user_id`,`sousresto_id`),
  KEY `sousresto_id` (`sousresto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bon_commandes`
--

DROP TABLE IF EXISTS `bon_commandes`;
CREATE TABLE IF NOT EXISTS `bon_commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(10) NOT NULL,
  `produit_id` int(10) NOT NULL,
  `nameprod` varchar(100) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `quantite` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `dte` date NOT NULL,
  `dte_h` datetime NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `commande_id` (`commande_id`,`produit_id`),
  KEY `produit_id` (`produit_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_chambre`
--

DROP TABLE IF EXISTS `categorie_chambre`;
CREATE TABLE IF NOT EXISTS `categorie_chambre` (
  `id_cat_cha` int(11) NOT NULL AUTO_INCREMENT,
  `lib_cat_cha` varchar(100) NOT NULL,
  `del` int(11) DEFAULT '0',
  `hotel_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_cat_cha`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `checking_valid`
--

DROP TABLE IF EXISTS `checking_valid`;
CREATE TABLE IF NOT EXISTS `checking_valid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shift` varchar(20) NOT NULL,
  `dte` varchar(20) NOT NULL,
  `site` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site` (`site`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compteur`
--

DROP TABLE IF EXISTS `compteur`;
CREATE TABLE IF NOT EXISTS `compteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) DEFAULT NULL,
  `numero` int(11) DEFAULT '1',
  `id_sousresto` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compteur`
--

INSERT INTO `compteur` (`id`, `libelle`, `numero`, `id_sousresto`, `site_id`, `syn`) VALUES
(299, 'souscription', 0, NULL, 0, 1),
(300, 'BE_STK', 3461, NULL, 356, 1),
(301, 'restaurant', 84919, NULL, 356, 1),
(302, 'restoR', 89850, NULL, 356, 1),
(303, 'BS_STK', 82284, NULL, 356, 1),
(304, 'BV', 1047, 123, NULL, 1),
(305, 'depense', 19601, NULL, 356, 1),
(306, 'facturefusion', 5, NULL, 356, 1),
(307, 'BV', 0, 124, NULL, 1),
(308, 'depense', 1, NULL, NULL, 1),
(309, 'depense', 1, NULL, NULL, 1),
(310, 'depense', 1, NULL, NULL, 1),
(311, 'depense', 1, NULL, NULL, 1),
(312, 'depense', 1, NULL, NULL, 1),
(313, 'depense', 1, NULL, NULL, 1),
(314, 'depense', 1, NULL, NULL, 1),
(315, 'depense', 1, NULL, NULL, 1),
(316, 'depense', 1, NULL, NULL, 1),
(317, 'depense', 1, NULL, NULL, 1),
(318, 'depense', 1, NULL, NULL, 1),
(319, 'depense', 1, NULL, NULL, 1),
(320, 'depense', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `condition_reglement`
--

DROP TABLE IF EXISTS `condition_reglement`;
CREATE TABLE IF NOT EXISTS `condition_reglement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `des` varchar(200) DEFAULT NULL,
  `njrs` int(11) NOT NULL DEFAULT '0',
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion` (
  `id_con` int(10) NOT NULL AUTO_INCREMENT,
  `date_con` datetime NOT NULL,
  `date_decon` datetime NOT NULL,
  `id_user` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_con`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=765 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`id_con`, `date_con`, `date_decon`, `id_user`, `syn`) VALUES
(1, '2018-11-08 17:54:21', '2018-11-08 19:56:26', 400, 1),
(2, '2018-11-08 17:56:30', '2018-11-08 19:57:27', 400, 1),
(3, '2018-11-08 17:59:18', '2018-11-08 20:00:35', 400, 1),
(4, '2018-11-08 18:09:42', '2018-11-08 20:10:22', 400, 1),
(5, '2018-11-08 18:10:28', '2018-11-08 20:15:27', 400, 1),
(6, '2018-11-08 18:15:33', '2018-11-08 20:16:04', 400, 1),
(7, '2018-11-08 18:16:07', '2018-11-08 20:16:51', 400, 1),
(8, '2018-11-09 12:26:14', '2018-11-09 14:26:20', 400, 1),
(9, '2018-11-09 12:26:53', '2018-11-09 14:27:00', 400, 1),
(10, '2018-11-09 14:08:15', '2018-11-09 16:09:53', 400, 1),
(11, '2018-11-13 17:25:27', '2018-11-13 18:35:41', 404, 1),
(12, '2018-11-13 17:42:16', '2018-11-13 18:46:28', 408, 1),
(13, '2018-11-13 18:18:39', '2018-12-13 19:40:13', 410, 1),
(14, '2018-12-13 18:40:45', '2018-12-13 19:52:17', 410, 1),
(15, '2018-12-13 18:52:28', '2018-12-13 19:53:05', 410, 1),
(16, '2018-12-13 19:08:44', '2018-12-13 20:11:09', 410, 1),
(17, '2018-12-13 19:11:15', '2018-12-13 20:13:51', 410, 1),
(18, '2018-12-13 19:13:57', '2018-12-13 20:14:31', 410, 1),
(19, '2018-12-13 19:14:41', '2018-12-13 20:15:24', 410, 1),
(20, '2018-12-13 19:26:00', '2018-11-16 15:15:33', 411, 1),
(21, '2018-11-16 16:00:06', '2018-11-16 16:01:19', 422, 1),
(22, '2018-11-16 16:01:28', '2018-11-16 16:04:17', 422, 1),
(23, '2018-11-16 16:05:12', '2018-11-16 16:05:47', 422, 1),
(24, '2018-11-16 16:21:17', '2018-11-16 16:28:46', 422, 1),
(25, '2018-11-16 16:35:12', '2018-11-16 16:37:17', 422, 1),
(26, '2018-11-16 16:40:38', '2018-11-16 16:42:46', 422, 1),
(27, '2018-11-16 18:37:05', '2018-12-17 18:59:32', 424, 1),
(28, '2018-12-17 19:05:04', '2019-01-15 19:17:13', 424, 1),
(29, '2018-11-20 16:04:01', '2018-12-16 16:09:52', 427, 1),
(30, '2018-12-16 16:10:47', '2018-12-29 16:37:14', 427, 1),
(31, '2018-12-29 16:57:44', '2018-12-29 16:59:41', 427, 1),
(32, '2018-12-29 17:00:03', '2019-01-26 17:00:56', 427, 1),
(33, '2019-02-05 17:06:37', '2019-02-05 17:07:35', 427, 1),
(34, '2019-02-05 17:07:50', '2019-02-05 19:07:31', 427, 1),
(35, '2019-02-05 19:10:04', '2019-02-26 19:23:24', 428, 1),
(36, '2019-02-26 19:24:04', '2019-03-15 19:28:30', 428, 1),
(37, '2019-03-15 19:28:38', '2019-04-12 18:49:46', 428, 1),
(38, '2019-04-12 18:50:51', '2019-04-25 18:52:59', 428, 1),
(39, '2018-11-21 15:22:18', '2018-11-21 17:17:31', 428, 1),
(40, '2018-11-21 17:25:55', '2018-11-21 17:59:12', 428, 1),
(41, '2018-11-21 18:07:46', '2018-11-22 10:09:07', 431, 1),
(42, '2018-11-21 18:07:46', '2018-11-22 10:09:15', 431, 1),
(43, '2018-11-22 10:12:54', '2018-11-22 10:38:11', 428, 1),
(44, '2018-11-22 10:42:31', '2018-11-22 13:33:39', 428, 1),
(45, '2018-11-23 10:13:29', '2018-11-23 10:20:11', 428, 1),
(46, '2018-11-23 13:37:57', '2018-11-23 15:24:41', 433, 1),
(47, '2018-11-23 15:24:55', '2018-11-23 15:25:07', 434, 1),
(48, '2018-11-23 15:25:29', '2018-11-23 15:38:13', 433, 1),
(49, '2018-11-23 15:38:25', '2018-11-23 15:41:03', 437, 1),
(50, '2018-11-23 15:41:20', '2018-11-23 15:41:20', 437, 1),
(51, '2018-11-23 15:41:47', '2018-11-23 15:41:48', 437, 1),
(52, '2018-11-23 15:42:10', '2018-11-23 15:42:11', 437, 1),
(53, '2018-11-23 15:42:29', '2018-11-23 15:43:01', 433, 1),
(54, '2018-11-23 15:44:03', '2018-11-23 15:44:13', 433, 1),
(55, '2018-11-23 15:44:31', '2018-11-23 15:59:08', 433, 1),
(56, '2018-11-23 15:59:27', '2018-11-23 16:18:29', 434, 1),
(57, '2018-11-24 09:11:15', '2018-11-24 11:58:21', 428, 1),
(58, '2018-11-24 12:02:02', '2018-11-24 12:04:04', 439, 1),
(59, '2018-11-24 12:04:19', '2018-11-24 12:05:34', 428, 1),
(60, '2018-11-24 12:05:39', '2018-11-24 12:05:52', 439, 1),
(61, '2018-11-24 12:05:58', '2018-11-24 12:17:10', 428, 1),
(62, '2018-11-24 12:17:17', '2018-11-24 13:08:05', 428, 1),
(63, '2018-11-24 13:14:48', '2018-11-26 07:30:25', 428, 1),
(64, '2018-11-26 14:33:59', '2018-11-26 15:04:04', 428, 1),
(65, '2018-11-26 15:04:32', '2018-11-26 15:34:35', 428, 1),
(66, '2018-11-27 15:43:39', '2018-11-27 16:43:48', 428, 1),
(67, '2018-11-28 14:34:55', '2018-11-28 18:44:06', 428, 1),
(68, '2018-11-29 11:40:54', '2018-12-03 11:54:13', 428, 1),
(69, '2018-12-03 11:54:30', '2018-12-03 11:54:37', 428, 1),
(70, '2018-12-03 11:57:03', '2018-12-03 11:57:10', 428, 1),
(71, '2018-12-03 11:57:38', '2018-12-03 11:57:41', 428, 1),
(72, '2018-12-03 11:58:23', '2018-12-03 12:00:02', 428, 1),
(73, '2018-12-03 12:00:11', '2018-12-03 12:00:15', 428, 1),
(74, '2018-12-03 12:00:36', '2018-12-03 12:03:31', 428, 1),
(75, '2018-12-03 12:04:01', '2018-12-03 12:09:46', 428, 1),
(76, '2018-12-03 12:09:56', '2018-12-03 12:09:59', 428, 1),
(77, '2018-12-03 12:10:31', '2018-12-03 12:10:36', 428, 1),
(78, '2018-12-03 12:13:00', '2018-12-03 12:13:04', 428, 1),
(79, '2018-12-03 12:14:41', '2018-12-03 12:14:44', 428, 1),
(80, '2018-12-03 12:20:28', '2018-12-03 12:20:37', 428, 1),
(81, '2018-12-03 12:26:28', '2018-12-03 12:28:05', 428, 1),
(82, '2018-12-03 12:28:15', '2018-12-03 12:28:18', 428, 1),
(83, '2018-12-03 12:30:21', '2018-12-03 12:37:04', 428, 1),
(84, '2018-12-03 13:07:28', '2018-12-03 13:15:35', 428, 1),
(85, '2018-12-03 13:15:51', '2018-12-03 13:15:53', 428, 1),
(86, '2018-12-03 13:17:28', '2018-12-03 13:26:43', 428, 1),
(87, '2018-12-03 13:26:56', '2018-12-03 13:26:59', 428, 1),
(88, '2018-12-03 13:27:34', '2018-12-03 13:33:00', 428, 1),
(89, '2018-12-03 13:33:13', '2018-12-03 13:34:42', 428, 1),
(90, '2018-12-03 13:34:54', '2018-12-03 13:53:17', 428, 1),
(91, '2018-12-03 13:53:30', '2018-12-03 13:57:45', 428, 1),
(92, '2018-12-03 13:58:00', '2018-12-03 13:59:20', 428, 1),
(93, '2018-12-03 13:59:26', '2018-12-03 14:02:02', 428, 1),
(94, '2018-12-03 14:02:06', '2018-12-03 14:05:10', 428, 1),
(95, '2018-12-03 14:05:13', '2018-12-03 14:06:48', 428, 1),
(96, '2018-12-03 14:06:53', '2018-12-03 14:09:19', 428, 1),
(97, '2018-12-03 14:09:23', '2018-12-03 14:14:19', 428, 1),
(98, '2018-12-03 14:14:23', '2018-12-03 14:15:32', 428, 1),
(99, '2018-12-03 14:15:36', '2018-12-03 14:20:37', 428, 1),
(100, '2018-12-03 14:20:40', '2018-12-03 14:23:06', 428, 1),
(101, '2018-12-03 14:23:10', '2018-12-03 14:25:21', 428, 1),
(102, '2018-12-03 17:14:16', '2018-12-03 17:46:00', 428, 1),
(103, '2018-12-03 18:28:18', '2018-12-03 18:45:10', 428, 1),
(104, '2018-12-04 15:57:10', '2018-12-04 15:57:55', 428, 1),
(105, '2018-12-04 15:58:16', '2018-12-04 17:04:37', 428, 1),
(106, '2018-12-04 17:12:02', '2018-12-05 10:27:59', 428, 1),
(107, '2018-12-05 14:39:42', '2018-12-05 14:46:43', 428, 1),
(108, '2018-12-05 14:46:53', '2018-12-05 14:46:56', 428, 1),
(109, '2018-12-05 14:48:41', '2018-12-05 14:52:44', 428, 1),
(110, '2018-12-05 14:52:47', '2018-12-05 14:55:06', 428, 1),
(111, '2018-12-05 14:55:09', '2018-12-05 14:56:48', 428, 1),
(112, '2018-12-05 16:25:09', '2018-12-05 17:19:05', 428, 1),
(113, '2018-12-05 17:19:23', '2018-12-06 11:04:13', 428, 1),
(114, '2018-12-06 11:04:18', '2018-12-07 11:25:28', 428, 1),
(115, '2018-12-10 10:29:08', '2018-12-11 15:10:09', 428, 1),
(116, '2018-12-11 15:10:13', '2018-12-11 17:22:08', 428, 1),
(117, '2018-12-11 17:22:23', '2018-12-12 10:48:00', 428, 1),
(118, '2018-12-12 10:48:03', '2018-12-13 16:00:36', 428, 1),
(119, '2018-12-13 16:00:40', '2018-12-13 20:26:38', 428, 1),
(120, '2018-12-13 20:26:41', '2018-12-14 11:20:33', 428, 1),
(121, '2018-12-14 11:20:37', '2018-12-14 15:25:40', 428, 1),
(122, '2018-12-14 15:25:46', '2018-12-14 15:31:01', 428, 1),
(123, '2018-12-14 15:33:47', '2018-12-14 15:39:01', 440, 1),
(124, '2018-12-14 15:39:28', '2018-12-14 15:44:26', 440, 1),
(125, '2018-12-17 13:13:13', '2018-12-17 13:39:16', 428, 1),
(126, '2018-12-17 13:42:04', '2018-12-17 13:42:39', 441, 1),
(127, '2018-12-17 13:42:43', '2018-12-17 13:45:20', 428, 1),
(128, '2018-12-17 13:47:08', '2018-12-17 15:13:04', 428, 1),
(129, '2018-12-17 15:24:23', '2018-12-17 15:24:34', 441, 1),
(130, '2018-12-17 15:25:29', '2018-12-17 15:27:07', 428, 1),
(131, '2018-12-17 15:27:21', '2018-12-17 15:27:48', 441, 1),
(132, '2018-12-17 15:27:52', '2018-12-17 15:30:52', 428, 1),
(133, '2018-12-17 15:31:01', '2018-12-18 06:16:27', 441, 1),
(134, '2018-12-18 12:17:06', '2018-12-18 13:08:10', 428, 1),
(135, '2018-12-18 13:08:14', '2018-12-18 13:10:17', 428, 1),
(136, '2018-12-18 13:10:33', '2018-12-18 13:19:48', 441, 1),
(137, '2018-12-18 13:19:51', '2018-12-18 13:23:53', 428, 1),
(138, '2018-12-18 13:24:03', '2018-12-18 13:24:09', 428, 1),
(139, '2018-12-18 13:24:20', '2018-12-18 13:31:37', 441, 1),
(140, '2018-12-18 13:31:42', '2018-12-18 21:51:34', 428, 1),
(141, '2018-12-18 21:51:40', '2018-12-19 15:32:22', 428, 1),
(142, '2018-12-19 16:05:38', '2018-12-19 19:22:57', 428, 1),
(143, '2018-12-20 06:22:42', '2018-12-20 07:11:36', 428, 1),
(144, '2018-12-20 13:12:26', '2018-12-24 06:48:28', 428, 1),
(145, '2018-12-24 06:48:34', '2018-12-24 08:24:38', 428, 1),
(146, '2018-12-24 09:03:13', '2018-12-24 09:11:48', 428, 1),
(147, '2018-12-24 09:12:02', '2018-12-24 15:06:15', 441, 1),
(148, '2018-12-24 15:06:20', '2018-12-24 15:07:24', 428, 1),
(149, '2018-12-24 15:07:41', '2018-12-25 13:46:51', 441, 1),
(150, '2018-12-25 13:46:55', '2018-12-25 13:52:05', 428, 1),
(151, '2018-12-25 13:52:17', '2018-12-25 13:58:36', 441, 1),
(152, '2018-12-25 13:58:43', '2018-12-25 13:59:38', 428, 1),
(153, '2018-12-25 13:59:45', '2018-12-25 14:01:08', 442, 1),
(154, '2018-12-25 14:01:17', '2018-12-25 14:01:40', 428, 1),
(155, '2018-12-25 14:01:44', '2018-12-25 14:18:20', 442, 1),
(156, '2018-12-25 14:18:30', '2018-12-26 08:04:27', 428, 1),
(157, '2018-12-26 08:04:37', '2018-12-26 08:08:16', 442, 1),
(158, '2018-12-26 08:08:24', '2018-12-26 08:12:38', 428, 1),
(159, '2018-12-26 08:12:55', '2018-12-26 08:14:49', 441, 1),
(160, '2018-12-26 08:14:58', '2018-12-26 08:17:01', 442, 1),
(161, '2018-12-26 08:17:23', '2018-12-26 09:03:09', 428, 1),
(162, '2018-12-26 09:03:22', '2018-12-26 12:54:11', 428, 1),
(163, '2018-12-26 12:54:30', '2018-12-26 12:54:56', 441, 1),
(164, '2018-12-26 12:55:06', '2018-12-26 12:55:46', 428, 1),
(165, '2018-12-26 13:07:41', '2018-12-26 13:08:13', 441, 1),
(166, '2018-12-26 13:08:18', '2018-12-26 13:13:13', 442, 1),
(167, '2018-12-26 13:13:20', '2018-12-26 13:14:46', 428, 1),
(168, '2018-12-26 13:14:56', '2018-12-26 13:29:53', 442, 1),
(169, '2018-12-26 13:30:13', '2018-12-26 13:44:44', 428, 1),
(170, '2018-12-26 13:44:55', '2018-12-26 13:46:47', 428, 1),
(171, '2018-12-26 13:46:52', '2018-12-26 13:55:25', 442, 1),
(172, '2018-12-26 13:55:35', '2018-12-26 13:55:54', 428, 1),
(173, '2018-12-26 13:56:00', '2018-12-26 13:59:09', 442, 1),
(174, '2018-12-26 13:59:21', '2018-12-26 14:01:07', 428, 1),
(175, '2018-12-26 14:01:12', '2018-12-26 14:01:19', 442, 1),
(176, '2018-12-26 14:01:38', '2018-12-26 14:02:11', 441, 1),
(177, '2018-12-26 14:02:19', '2018-12-26 14:02:57', 428, 1),
(178, '2018-12-26 14:03:07', '2018-12-26 14:03:27', 442, 1),
(179, '2018-12-26 14:03:53', '2018-12-26 14:14:11', 441, 1),
(180, '2018-12-26 14:14:21', '2018-12-26 14:15:28', 428, 1),
(181, '2018-12-26 14:15:33', '2018-12-26 14:15:40', 442, 1),
(182, '2018-12-26 14:15:56', '2018-12-27 11:00:55', 441, 1),
(183, '2018-12-27 11:01:04', '2018-12-28 09:18:56', 428, 1),
(184, '2018-12-28 09:19:03', '2018-12-29 09:01:35', 428, 1),
(185, '2018-12-29 09:01:43', '2018-12-29 16:29:18', 428, 1),
(186, '2018-12-29 16:29:27', '2018-12-30 19:01:52', 428, 1),
(187, '2018-12-31 07:22:59', '2019-01-02 13:44:54', 428, 1),
(188, '2019-01-03 07:28:51', '2019-01-03 07:45:21', 428, 1),
(189, '2019-01-03 07:45:31', '2019-01-07 14:11:42', 428, 1),
(190, '2019-01-07 14:12:27', '2019-01-07 14:14:43', 428, 1),
(191, '2019-01-07 14:14:55', '2019-01-07 14:21:09', 428, 1),
(192, '2019-01-07 14:21:54', '2019-01-07 14:25:13', 428, 1),
(193, '2019-01-07 14:26:04', '2019-01-07 14:29:09', 428, 1),
(194, '2019-01-07 14:30:28', '2019-01-07 14:30:46', 428, 1),
(195, '2019-01-07 14:30:55', '2019-01-07 14:31:25', 428, 1),
(196, '2019-01-07 14:31:41', '2019-01-07 14:32:02', 428, 1),
(197, '2019-01-07 14:34:07', '2019-01-07 14:34:20', 428, 1),
(198, '2019-01-07 14:35:37', '2019-01-07 14:36:12', 428, 1),
(199, '2019-01-07 14:37:15', '2019-01-07 14:43:05', 428, 1),
(200, '2019-01-07 14:43:48', '2019-01-07 16:15:49', 428, 1),
(201, '2019-01-07 16:49:06', '2019-01-07 17:19:11', 428, 1),
(202, '2019-01-07 18:14:14', '2019-01-07 18:51:49', 428, 1),
(203, '2019-01-07 18:52:11', '2019-01-07 18:56:30', 441, 1),
(204, '2019-01-07 18:56:48', '2019-01-07 18:59:33', 428, 1),
(205, '2019-01-07 18:59:51', '2019-01-07 19:11:58', 441, 1),
(206, '2019-01-07 19:12:04', '2019-01-07 19:13:57', 442, 1),
(207, '2019-01-07 19:14:22', '2019-01-07 19:32:31', 441, 1),
(208, '2019-01-07 19:32:41', '2019-01-07 19:33:29', 428, 1),
(209, '2019-01-07 19:33:33', '2019-01-07 19:35:37', 442, 1),
(210, '2019-01-07 19:35:45', '2019-01-07 19:59:44', 428, 1),
(211, '2019-01-07 20:00:16', '2019-01-07 20:01:31', 441, 1),
(212, '2019-01-14 09:42:58', '2019-01-14 10:40:16', 428, 1),
(213, '2019-01-14 10:40:26', '2019-01-14 10:40:45', 428, 1),
(214, '2019-01-14 10:40:52', '2019-01-14 10:43:26', 428, 1),
(215, '2019-01-14 10:43:34', '2019-01-14 10:49:54', 441, 1),
(216, '2019-01-14 10:50:03', '2019-01-14 10:54:02', 442, 1),
(217, '2019-01-14 10:54:09', '2019-01-14 11:01:04', 428, 1),
(218, '2019-01-14 11:01:12', '2019-01-14 11:05:34', 428, 1),
(219, '2019-01-14 11:05:43', '2019-01-14 11:06:55', 428, 1),
(220, '2019-01-14 11:12:54', '2019-01-14 12:39:21', 443, 1),
(221, '2019-01-14 12:39:28', '2019-01-14 12:45:13', 443, 1),
(222, '2019-01-14 12:45:28', '2019-01-14 12:47:42', 444, 1),
(223, '2019-01-14 12:48:59', '2019-01-14 12:49:09', 444, 1),
(224, '2019-01-14 12:49:14', '2019-01-14 12:57:17', 443, 1),
(225, '2019-01-14 12:57:25', '2019-01-14 12:59:18', 443, 1),
(226, '2019-01-14 12:59:25', '2019-01-14 13:06:39', 444, 1),
(227, '2019-01-14 13:06:46', '2019-01-14 13:15:30', 444, 1),
(228, '2019-01-14 13:15:38', '2019-01-14 13:26:44', 443, 1),
(229, '2019-01-14 13:26:54', '2019-01-14 13:27:57', 444, 1),
(230, '2019-01-14 13:28:04', '2019-01-14 13:29:58', 443, 1),
(231, '2019-01-14 13:30:03', '2019-01-14 13:32:18', 444, 1),
(232, '2019-01-14 13:32:25', '2019-01-14 13:34:57', 443, 1),
(233, '2019-01-14 13:35:01', '2019-01-14 13:54:19', 444, 1),
(234, '2019-01-14 13:54:30', '2019-01-14 14:04:09', 445, 1),
(235, '2019-01-14 14:04:16', '2019-01-14 14:48:03', 443, 1),
(236, '2019-01-14 14:48:14', '2019-01-14 14:54:14', 443, 1),
(237, '2019-01-14 14:54:24', '2019-01-14 15:09:38', 443, 1),
(238, '2019-01-14 15:09:43', '2019-01-14 15:16:00', 443, 1),
(239, '2019-01-14 15:16:08', '2019-01-14 15:53:55', 443, 1),
(240, '2019-01-14 15:16:08', '2019-01-14 15:53:56', 443, 1),
(241, '2019-01-14 16:17:10', '2019-01-14 18:45:22', 444, 1),
(242, '2019-01-14 18:46:21', '2019-01-14 19:03:07', 443, 1),
(243, '2019-01-14 19:03:14', '2019-01-14 19:54:05', 444, 1),
(244, '2019-01-14 19:56:08', '2019-01-15 00:25:05', 443, 1),
(245, '2019-01-15 10:44:33', '2019-01-15 11:43:17', 443, 1),
(246, '2019-01-15 11:43:29', '2019-01-15 12:13:42', 444, 1),
(247, '2019-01-15 12:13:47', '2019-01-15 12:14:36', 444, 1),
(248, '2019-01-15 12:14:42', '2019-01-15 12:15:01', 443, 1),
(249, '2019-01-15 12:15:09', '2019-01-15 12:19:43', 444, 1),
(250, '2019-01-15 12:19:51', '2019-01-15 12:20:06', 444, 1),
(251, '2019-01-15 12:20:17', '2019-01-15 12:21:46', 443, 1),
(252, '2019-01-15 12:21:53', '2019-01-15 12:23:03', 444, 1),
(253, '2019-01-15 12:23:10', '2019-01-15 12:23:33', 444, 1),
(254, '2019-01-15 12:23:37', '2019-01-15 13:08:32', 444, 1),
(255, '2019-01-15 13:10:50', '2019-01-15 15:27:44', 443, 1),
(256, '2019-01-15 15:28:39', '2019-01-15 16:12:29', 443, 1),
(257, '2019-01-15 16:17:40', '2019-01-15 16:35:30', 443, 1),
(258, '2019-01-15 16:35:37', '2019-01-15 17:01:50', 444, 1),
(259, '2019-01-15 17:01:54', '2019-01-15 17:03:48', 444, 1),
(260, '2019-01-15 17:03:53', '2019-01-15 20:46:43', 443, 1),
(261, '2019-01-16 17:49:54', '2019-01-18 10:06:10', 443, 1),
(262, '2019-01-18 10:06:16', '2019-01-18 10:18:24', 443, 1),
(263, '2019-01-18 10:18:31', '2019-01-18 10:19:04', 443, 1),
(264, '2019-01-18 10:19:13', '2019-01-18 10:31:42', 443, 1),
(265, '2019-01-18 11:15:41', '2019-01-18 11:16:43', 443, 1),
(266, '2019-01-18 11:16:52', '2019-01-18 11:20:49', 443, 1),
(267, '2019-01-18 11:20:56', '2019-01-18 12:39:52', 443, 1),
(268, '2019-01-18 12:41:40', '2019-01-19 10:01:45', 443, 1),
(269, '2019-01-21 10:53:01', '2019-01-21 11:52:04', 443, 1),
(270, '2019-01-21 12:43:26', '2019-01-21 13:55:50', 443, 1),
(271, '2019-01-21 13:55:58', '2019-01-21 13:57:13', 444, 1),
(272, '2019-01-21 13:57:22', '2019-01-21 13:57:45', 443, 1),
(273, '2019-01-21 13:58:01', '2019-01-21 13:59:14', 445, 1),
(274, '2019-01-21 13:59:20', '2019-01-21 14:04:22', 443, 1),
(275, '2019-01-21 14:04:28', '2019-01-22 15:46:25', 443, 1),
(276, '2019-01-21 14:04:28', '2019-01-22 19:15:15', 443, 1),
(277, '2019-01-22 19:15:23', '2019-01-28 11:25:52', 443, 1),
(278, '2019-01-28 15:45:34', '2019-01-28 15:59:47', 443, 1),
(279, '2019-01-28 16:01:09', '2019-01-29 13:03:36', 443, 1),
(280, '2019-01-30 12:40:48', '2019-01-30 12:44:54', 443, 1),
(281, '2019-01-30 12:45:00', '2019-01-30 12:46:03', 443, 1),
(282, '2019-01-30 12:46:11', '2019-01-30 12:46:23', 443, 1),
(283, '2019-01-30 12:46:31', '2019-01-30 13:24:30', 443, 1),
(284, '2019-02-01 12:27:29', '2019-02-01 12:35:34', 443, 1),
(285, '2019-02-01 12:35:49', '2019-02-01 14:23:20', 443, 1),
(286, '2019-02-01 14:23:31', '2019-02-01 14:23:47', 443, 1),
(287, '2019-02-01 14:23:53', '2019-02-01 14:24:11', 444, 1),
(288, '2019-02-01 14:24:18', '2019-02-03 04:45:45', 443, 1),
(289, '2019-02-04 10:55:54', '2019-02-05 15:08:44', 443, 1),
(290, '2019-02-06 10:46:54', '2019-02-08 17:16:41', 443, 1),
(291, '2019-02-08 17:17:40', '2019-02-07 17:23:11', 443, 1),
(292, '2019-02-07 20:32:39', '2019-02-08 14:04:17', 443, 1),
(293, '2019-02-08 14:04:28', '2019-02-08 17:12:26', 443, 1),
(294, '2019-02-08 17:12:33', '2019-02-13 15:13:32', 443, 1),
(295, '2019-02-11 13:05:50', '2019-02-11 14:24:54', 443, 1),
(296, '2019-02-11 14:25:02', '2019-02-12 11:39:49', 443, 1),
(297, '2019-02-12 11:40:01', '2019-02-12 15:24:37', 443, 1),
(298, '2019-02-12 15:24:44', '2019-02-12 15:58:15', 443, 1),
(299, '2019-02-12 15:58:21', '2019-02-12 15:58:56', 446, 1),
(300, '2019-02-12 15:59:08', '2019-02-12 16:02:57', 443, 1),
(301, '2019-02-12 16:10:38', '2019-02-13 17:07:10', 443, 1),
(302, '2019-02-14 12:36:46', '2019-02-14 12:52:44', 443, 1),
(303, '2019-02-14 12:52:50', '2019-02-14 13:12:29', 443, 1),
(304, '2019-02-14 13:12:43', '2019-02-14 13:32:16', 443, 1),
(305, '2019-02-14 13:32:21', '2019-02-14 13:45:29', 443, 1),
(306, '2019-02-14 13:51:04', '2019-02-14 14:45:28', 448, 1),
(307, '2019-02-14 14:45:37', '2019-02-14 10:40:29', 448, 1),
(308, '2019-02-18 14:02:25', '2019-02-18 14:23:14', 443, 1),
(309, '2019-02-18 14:23:23', '2019-02-18 14:40:28', 443, 1),
(310, '2019-02-18 14:40:34', '2019-02-19 10:34:56', 443, 1),
(311, '2019-02-19 16:51:04', '2019-02-20 11:56:54', 443, 1),
(312, '2019-02-20 11:57:01', '2019-02-20 12:14:06', 443, 1),
(313, '2019-02-20 12:14:13', '2019-02-20 12:25:38', 443, 1),
(314, '2019-02-20 14:50:08', '2019-02-20 17:06:27', 443, 1),
(315, '2019-02-20 17:06:33', '2019-02-20 17:17:28', 443, 1),
(316, '2019-02-20 17:21:02', '2019-02-20 19:15:52', 443, 1),
(317, '2019-02-20 19:43:07', '2019-02-20 20:28:13', 443, 1),
(318, '2019-02-20 20:45:56', '2019-02-20 20:49:04', 443, 1),
(319, '2019-02-20 20:49:10', '2019-02-20 20:51:31', 443, 1),
(320, '2019-02-20 21:01:47', '2019-02-20 21:03:07', 443, 1),
(321, '2019-02-20 21:03:19', '2019-02-20 21:03:24', 443, 1),
(322, '2019-02-20 21:04:02', '2019-02-20 21:06:33', 442, 1),
(323, '2019-02-20 21:06:41', '2019-02-20 21:07:38', 444, 1),
(324, '2019-02-20 21:07:44', '2019-02-20 21:08:22', 444, 1),
(325, '2019-02-20 21:09:53', '2019-02-20 21:11:12', 443, 1),
(326, '2019-02-20 21:11:21', '2019-02-20 21:12:44', 451, 1),
(327, '2019-02-21 10:18:57', '2019-02-21 10:34:28', 443, 1),
(328, '2019-02-21 10:34:36', '2019-02-21 10:36:48', 443, 1),
(329, '2019-02-21 10:36:57', '2019-02-21 10:37:38', 451, 1),
(330, '2019-02-21 10:38:18', '2019-02-21 10:38:22', 451, 1),
(331, '2019-02-21 10:40:50', '2019-02-21 10:41:02', 451, 1),
(332, '2019-02-21 11:29:46', '2019-02-21 11:34:08', 443, 1),
(333, '2019-02-21 15:53:38', '2019-02-21 15:54:26', 443, 1),
(334, '2019-02-26 11:19:42', '2019-02-26 11:29:54', 443, 1),
(335, '2019-02-27 12:19:27', '2019-02-28 10:57:59', 455, 1),
(336, '2019-03-04 11:02:53', '2019-03-04 14:53:30', 455, 1),
(337, '2019-03-04 14:53:36', '2019-03-04 15:07:21', 455, 1),
(338, '2019-03-04 15:07:27', '2019-03-04 15:10:22', 455, 1),
(339, '2019-03-04 15:10:27', '2019-03-04 15:12:07', 455, 1),
(340, '2019-03-04 15:12:17', '2019-03-04 15:14:13', 455, 1),
(341, '2019-03-04 15:14:19', '2019-03-04 15:17:10', 455, 1),
(342, '2019-03-07 10:33:49', '2019-03-08 10:50:02', 455, 1),
(343, '2019-03-08 10:50:12', '2019-03-08 11:29:32', 455, 1),
(344, '2019-03-13 11:11:57', '2019-03-13 11:29:24', 455, 1),
(345, '2019-03-22 14:37:46', '2019-03-22 14:41:30', 455, 1),
(346, '2019-03-22 14:41:37', '2019-03-22 14:45:03', 456, 1),
(347, '2019-03-22 14:45:10', '2019-03-22 15:12:11', 455, 1),
(348, '2019-03-25 09:20:21', '2019-03-30 15:59:41', 455, 1),
(349, '2019-03-28 12:17:38', '2019-03-28 16:26:54', 455, 1),
(350, '2019-03-28 16:40:05', '2019-03-28 16:40:44', 455, 1),
(351, '2019-03-31 17:15:47', '2019-03-31 21:37:51', 455, 1),
(352, '2019-04-01 18:40:13', '2019-04-01 22:34:38', 455, 1),
(353, '2019-04-05 15:01:49', '2019-04-05 16:32:32', 455, 1),
(354, '2019-04-05 17:00:30', '2019-04-05 17:00:37', 455, 1),
(355, '2019-04-08 11:12:58', '2019-04-09 08:22:26', 455, 1),
(356, '2019-04-11 11:14:43', '2019-04-11 14:16:38', 455, 1),
(357, '2019-04-23 10:18:38', '2019-04-23 11:20:24', 455, 1),
(358, '2019-05-13 15:15:58', '2019-05-13 19:07:29', 455, 1),
(359, '2019-05-14 10:10:06', '2019-05-14 10:46:27', 455, 1),
(360, '2019-05-14 12:57:07', '2019-05-14 15:37:44', 455, 1),
(361, '2019-05-16 05:54:45', '2019-05-16 07:37:48', 455, 1),
(362, '2019-05-16 05:54:45', '2019-05-16 07:37:49', 455, 1),
(363, '2019-05-17 15:41:44', '2019-05-17 19:18:58', 455, 1),
(364, '2019-05-17 19:19:22', '2019-05-17 19:40:46', 455, 1),
(365, '2019-05-17 19:41:37', '2019-05-17 23:06:41', 455, 1),
(366, '2019-05-18 08:07:20', '2019-05-18 15:41:59', 455, 1),
(367, '2019-05-18 20:50:19', '2019-05-18 20:54:32', 455, 1),
(368, '2019-05-21 07:24:15', '2019-05-21 20:22:04', 455, 1),
(369, '2019-05-22 07:41:12', '2019-05-22 11:20:34', 455, 1),
(370, '2019-05-25 12:32:37', '2019-05-25 15:34:12', 455, 1),
(371, '2019-05-25 16:45:20', '2019-05-25 17:15:42', 455, 1),
(372, '2019-05-25 17:15:49', '2019-05-25 22:07:15', 455, 1),
(373, '2019-05-26 22:30:27', '2019-05-27 09:18:29', 455, 1),
(374, '2019-05-26 22:30:27', '2019-05-27 09:18:29', 455, 1),
(375, '2019-05-27 09:21:03', '2019-05-27 12:17:07', 455, 1),
(376, '2019-05-27 12:18:15', '2019-05-27 19:01:22', 455, 1),
(377, '2019-05-27 19:01:37', '2019-05-27 19:36:54', 455, 1),
(378, '2019-05-27 19:47:08', '2019-05-27 21:05:44', 455, 1),
(379, '2019-05-27 19:47:08', '2019-05-27 21:05:45', 455, 1),
(380, '2019-05-27 21:08:48', '2019-05-27 22:14:02', 455, 1),
(381, '2019-05-28 05:52:44', '2019-05-28 06:16:36', 455, 1),
(382, '2019-05-28 06:16:44', '2019-05-28 06:22:29', 455, 1),
(383, '2019-05-28 06:22:39', '2019-05-28 06:49:42', 455, 1),
(384, '2019-05-28 06:49:56', '2019-05-28 09:51:45', 455, 1),
(385, '2019-05-29 16:32:42', '2019-05-30 23:20:47', 455, 1),
(386, '2019-05-31 00:35:53', '2019-06-02 10:22:28', 455, 1),
(387, '2019-06-02 10:22:45', '2019-06-02 11:58:53', 455, 1),
(388, '2019-06-03 17:15:54', '2019-06-03 18:51:41', 455, 1),
(389, '2019-06-10 15:32:11', '2019-06-10 15:47:34', 455, 1),
(390, '2019-06-10 15:47:40', '2019-06-10 15:53:34', 455, 1),
(391, '2019-06-10 15:53:43', '2019-06-10 15:56:58', 455, 1),
(392, '2019-06-11 10:36:00', '2019-06-11 11:37:01', 455, 1),
(393, '2019-06-11 11:38:28', '2019-06-11 13:46:45', 455, 1),
(394, '2019-06-11 15:17:58', '2019-06-11 16:50:18', 455, 1),
(395, '2019-06-12 19:23:26', '2019-06-12 21:27:33', 455, 1),
(396, '2019-06-18 11:19:07', '2019-06-20 00:06:38', 455, 1),
(397, '2019-06-26 08:42:01', '2019-06-24 01:37:54', 455, 1),
(398, '2019-06-24 01:38:16', '2019-06-24 01:38:28', 455, 1),
(399, '2019-06-25 03:27:14', '2019-06-29 11:21:20', 455, 1),
(400, '2019-06-29 15:34:58', '2019-06-29 18:34:03', 455, 1),
(401, '2019-07-02 17:32:48', '2019-07-02 18:34:06', 455, 1),
(402, '2019-07-02 19:32:44', '2019-07-02 20:49:42', 455, 1),
(403, '2019-07-02 21:59:31', '2019-07-02 22:29:56', 455, 1),
(404, '2019-07-02 11:36:18', '2019-07-02 11:39:56', 455, 1),
(405, '2019-07-02 11:40:03', '2019-07-02 12:31:55', 455, 1),
(406, '2019-07-02 12:38:40', '2019-07-02 13:22:47', 455, 1),
(407, '2019-07-02 13:22:54', '2019-07-02 13:27:07', 455, 1),
(408, '2019-07-02 13:27:19', '2019-07-02 14:28:07', 455, 1),
(409, '2019-07-02 15:17:40', '2019-07-02 16:56:29', 455, 1),
(410, '2019-07-02 17:16:51', '2019-07-02 20:33:06', 455, 1),
(411, '2019-07-02 20:35:54', '2019-07-02 20:38:41', 455, 1),
(412, '2019-07-02 20:40:45', '2019-07-02 20:51:47', 455, 1),
(413, '2019-07-02 20:51:53', '2019-07-02 21:05:04', 455, 1),
(414, '2019-07-02 21:05:10', '2019-07-02 21:53:21', 455, 1),
(415, '2019-07-02 21:53:27', '2019-07-03 00:25:09', 455, 1),
(416, '2019-07-03 00:25:15', '2019-07-03 01:49:32', 455, 1),
(417, '2019-07-03 01:49:40', '2019-07-04 14:56:59', 455, 1),
(418, '2019-07-04 15:02:38', '2019-07-04 17:04:43', 455, 1),
(419, '2019-07-04 17:17:47', '2019-07-04 21:05:41', 455, 1),
(420, '2019-07-05 12:02:51', '2019-07-05 12:29:46', 455, 1),
(421, '2019-07-05 12:29:54', '2019-07-05 12:39:50', 455, 1),
(422, '2019-07-05 12:39:57', '2019-07-05 12:42:50', 455, 1),
(423, '2019-07-05 12:42:56', '2019-07-05 13:48:13', 455, 1),
(424, '2019-07-05 13:48:20', '2019-07-05 14:31:18', 455, 1),
(425, '2019-07-05 14:31:24', '2019-07-05 14:32:47', 455, 1),
(426, '2019-07-05 14:32:54', '2019-07-05 14:35:55', 455, 1),
(427, '2019-07-05 14:36:12', '2019-07-05 15:35:09', 455, 1),
(428, '2019-07-05 15:35:14', '2019-07-05 15:39:03', 455, 1),
(429, '2019-07-05 15:39:15', '2019-07-05 15:42:57', 455, 1),
(430, '2019-07-05 15:43:05', '2019-07-05 15:47:42', 455, 1),
(431, '2019-07-05 15:47:50', '2019-07-05 15:53:56', 455, 1),
(432, '2019-07-05 15:54:02', '2019-07-05 15:56:10', 455, 1),
(433, '2019-07-05 15:56:16', '2019-07-05 16:03:34', 455, 1),
(434, '2019-07-05 16:03:40', '2019-07-05 16:13:07', 455, 1),
(435, '2019-07-05 16:13:20', '2019-07-05 16:17:46', 455, 1),
(436, '2019-07-05 16:17:52', '2019-07-05 16:20:31', 455, 1),
(437, '2019-07-05 16:20:37', '2019-07-05 16:22:24', 455, 1),
(438, '2019-07-05 16:22:29', '2019-07-05 16:25:12', 455, 1),
(439, '2019-07-05 16:25:18', '2019-07-05 16:27:25', 455, 1),
(440, '2019-07-05 16:27:33', '2019-07-05 16:29:05', 455, 1),
(441, '2019-07-05 16:29:11', '2019-07-05 16:33:49', 455, 1),
(442, '2019-07-05 16:33:56', '2019-07-05 16:37:28', 455, 1),
(443, '2019-07-05 16:37:36', '2019-07-05 16:40:19', 455, 1),
(444, '2019-07-05 16:42:31', '2019-07-05 16:46:28', 455, 1),
(445, '2019-07-05 16:46:34', '2019-07-05 16:48:37', 455, 1),
(446, '2019-07-05 17:15:51', '2019-07-05 20:46:08', 455, 1),
(447, '2019-07-08 11:09:39', '2019-07-08 11:29:11', 455, 1),
(448, '2019-07-08 11:29:26', '2019-07-08 11:32:37', 455, 1),
(449, '2019-07-08 11:32:57', '2019-07-08 11:38:09', 455, 1),
(450, '2019-07-08 11:38:15', '2019-07-08 12:38:55', 455, 1),
(451, '2019-07-08 12:41:28', '2019-07-08 13:13:05', 455, 1),
(452, '2019-07-08 13:57:42', '2019-07-08 14:28:04', 455, 1),
(453, '2019-07-08 14:56:38', '2019-07-08 15:56:51', 455, 1),
(454, '2019-07-08 17:36:12', '2019-07-08 17:50:58', 455, 1),
(455, '2019-07-08 17:51:07', '2019-07-09 10:51:28', 455, 1),
(456, '2019-07-09 10:51:35', '2019-07-09 11:10:53', 455, 1),
(457, '2019-07-09 11:10:59', '2019-07-10 02:41:27', 455, 1),
(458, '2019-07-10 03:10:25', '2019-07-09 17:15:19', 455, 1),
(459, '2019-07-11 10:33:07', '2019-07-11 12:16:48', 455, 1),
(460, '2019-07-11 12:16:55', '2019-07-11 13:51:00', 455, 1),
(461, '2019-07-11 14:21:46', '2019-07-11 15:43:10', 455, 1),
(462, '2019-07-11 15:43:18', '2019-07-11 16:23:40', 455, 1),
(463, '2019-07-11 16:23:45', '2019-07-11 16:29:26', 455, 1),
(464, '2019-07-11 16:29:32', '2019-07-11 16:31:48', 455, 1),
(465, '2019-07-11 16:31:54', '2019-07-11 20:14:13', 455, 1),
(466, '2019-07-12 11:00:26', '2019-07-12 16:16:19', 455, 1),
(467, '2019-07-12 16:16:49', '2019-07-12 16:36:21', 455, 1),
(468, '2019-07-12 16:36:36', '2019-07-12 16:39:05', 455, 1),
(469, '2019-07-12 16:39:13', '2019-07-12 17:53:35', 455, 1),
(470, '2019-07-13 14:23:30', '2019-07-15 10:24:46', 455, 1),
(471, '2019-07-15 10:24:58', '2019-07-15 13:03:56', 455, 1),
(472, '2019-07-15 16:48:34', '2019-07-16 10:38:36', 455, 1),
(473, '2019-07-16 11:30:48', '2019-07-16 16:33:19', 455, 1),
(474, '2019-07-18 07:20:03', '2019-07-18 07:40:53', 455, 1),
(475, '2019-07-18 07:41:03', '2019-07-18 09:50:38', 455, 1),
(476, '2019-07-24 16:14:36', '2019-07-25 09:29:29', 455, 1),
(477, '2019-07-26 14:17:09', '2019-07-26 17:40:20', 455, 1),
(478, '2019-08-06 11:05:11', '2019-08-06 18:18:13', 455, 1),
(479, '2019-08-06 19:35:34', '2019-08-06 19:37:45', 455, 1),
(480, '2019-08-14 11:30:56', '2019-08-14 13:46:32', 455, 1),
(481, '2019-08-14 13:46:38', '2019-08-14 13:48:36', 455, 1),
(482, '2019-08-14 13:48:44', '2019-08-14 13:50:35', 455, 1),
(483, '2019-08-14 13:50:51', '2019-08-14 14:15:54', 455, 1),
(484, '2019-08-14 14:16:00', '2019-08-14 14:18:39', 455, 1),
(485, '2019-08-14 14:20:26', '2019-08-14 14:28:46', 455, 1),
(486, '2019-08-14 14:28:52', '2019-08-14 15:04:30', 455, 1),
(487, '2019-08-14 15:04:35', '2019-08-14 15:05:03', 455, 1),
(488, '2019-08-14 15:05:14', '2019-08-14 15:50:05', 455, 1),
(489, '2019-08-14 15:50:11', '2019-08-14 16:01:34', 455, 1),
(490, '2019-08-15 10:46:27', '2019-08-15 12:20:54', 455, 1),
(491, '2019-08-19 11:56:27', '2019-08-19 13:22:01', 455, 1),
(492, '2019-08-23 09:44:13', '2019-08-23 10:11:21', 455, 1),
(493, '2019-08-23 10:11:31', '2019-08-23 12:13:07', 455, 1),
(494, '2019-08-27 15:04:13', '2019-08-27 17:07:18', 455, 1),
(495, '2019-08-28 10:42:29', '2019-08-28 12:38:37', 455, 1),
(496, '2019-08-28 12:38:47', '2019-08-29 12:01:22', 455, 1),
(497, '2019-08-29 12:01:41', '2019-08-29 13:57:22', 455, 1),
(498, '2019-08-29 13:57:29', '2019-08-29 14:09:55', 455, 1),
(499, '2019-08-29 14:10:01', '2019-08-29 14:10:14', 455, 1),
(500, '2019-08-29 14:10:20', '2019-08-30 15:16:40', 455, 1),
(501, '2019-08-30 15:16:50', '2019-08-30 15:28:46', 455, 1),
(502, '2019-08-30 16:07:34', '2019-08-30 16:08:19', 455, 1),
(503, '2019-09-05 11:27:41', '2019-09-05 12:59:35', 455, 1),
(504, '2019-09-05 14:25:05', '2019-09-05 14:26:20', 455, 1),
(505, '2019-09-06 10:24:48', '2019-09-06 12:57:31', 455, 1),
(506, '2019-09-06 12:57:41', '2019-09-06 12:58:13', 455, 1),
(507, '2019-09-06 12:58:31', '2019-09-06 13:06:46', 455, 1),
(508, '2019-09-10 11:11:39', '2019-09-10 11:33:44', 455, 1),
(509, '2019-09-10 13:22:18', '2019-09-10 14:07:41', 455, 1),
(510, '2019-09-10 15:19:33', '2019-09-10 15:40:41', 455, 1),
(511, '2019-09-10 15:40:47', '2019-09-10 15:43:30', 455, 1),
(512, '2019-09-17 12:42:42', '2019-09-17 13:43:03', 455, 1),
(513, '2019-09-26 09:34:35', '2019-09-26 09:38:07', 455, 1),
(514, '2019-09-26 09:38:09', '2019-09-26 09:40:44', 455, 1),
(515, '2019-09-26 09:40:51', '2019-09-26 09:45:12', 455, 1),
(516, '2019-09-26 09:45:15', '2019-09-26 09:53:14', 455, 1),
(517, '2019-09-27 11:22:50', '2019-09-27 12:02:31', 455, 1),
(518, '2019-09-27 12:02:36', '2019-09-27 12:17:16', 455, 1),
(519, '2019-09-27 12:17:19', '2019-09-27 12:42:40', 455, 1),
(520, '2019-09-27 12:42:43', '2019-09-27 12:46:44', 455, 1),
(521, '2019-09-27 12:46:46', '2019-09-27 12:50:44', 455, 1),
(522, '2019-09-27 12:50:46', '2019-09-27 13:22:36', 455, 1),
(523, '2019-10-03 13:18:23', '2019-10-03 13:19:05', 462, 1),
(524, '2019-10-03 13:19:08', '2019-10-03 13:30:10', 462, 1),
(525, '2019-10-03 13:30:15', '2019-10-03 14:48:41', 462, 1),
(526, '2019-10-03 16:19:06', '2019-10-03 16:23:06', 464, 1),
(527, '2019-10-03 16:23:09', '2019-10-03 16:23:41', 464, 1),
(528, '2019-10-03 16:23:43', '2019-10-03 16:25:01', 464, 1),
(529, '2019-10-03 16:27:51', '2019-10-03 16:30:15', 465, 1),
(530, '2019-10-03 17:24:28', '2019-10-03 17:26:51', 465, 1),
(531, '2019-10-04 13:04:03', '2019-10-04 13:10:09', 466, 1),
(532, '2019-10-04 13:10:17', '2019-10-04 13:12:33', 466, 1),
(533, '2019-10-04 13:14:00', '2019-10-04 13:30:39', 466, 1),
(534, '2019-10-04 13:30:42', '2019-10-04 13:32:17', 466, 1),
(535, '2019-10-04 13:36:18', '2019-10-04 14:13:17', 466, 1),
(536, '2019-10-07 11:30:41', '2019-10-07 11:46:25', 455, 1),
(537, '2019-10-07 11:46:32', '2019-10-07 12:38:30', 467, 1),
(538, '2019-10-07 12:38:33', '2019-10-07 13:11:31', 467, 1),
(539, '2019-10-07 13:11:39', '2019-10-07 13:18:43', 467, 1),
(540, '2019-10-07 13:20:26', '2019-10-07 13:23:04', 467, 1),
(541, '2019-10-07 13:23:07', '2019-10-07 13:24:25', 467, 1),
(542, '2019-10-07 13:24:28', '2019-10-07 13:36:07', 467, 1),
(543, '2019-10-07 14:09:20', '2019-10-07 14:14:38', 467, 1),
(544, '2019-10-07 14:14:43', '2019-10-07 14:17:59', 467, 1),
(545, '2019-10-07 14:18:01', '2019-10-07 14:19:38', 467, 1),
(546, '2019-10-07 14:22:11', '2019-10-07 14:41:33', 467, 1),
(547, '2019-10-07 14:44:50', '2019-10-07 14:45:45', 468, 1),
(548, '2019-10-07 14:46:25', '2019-10-07 14:49:19', 468, 1),
(549, '2019-10-07 14:49:21', '2019-10-07 14:53:10', 468, 1),
(550, '2019-10-07 14:53:49', '2019-10-07 15:03:23', 468, 1),
(551, '2019-10-07 15:03:58', '2019-10-07 15:21:14', 468, 1),
(552, '2019-10-07 16:46:00', '2019-10-07 16:46:09', 455, 1),
(553, '2019-10-14 14:32:49', '2019-10-14 16:24:12', 455, 1),
(554, '2019-10-14 16:24:21', '2019-10-14 16:26:08', 455, 1),
(555, '2019-10-16 11:45:56', '2019-10-16 17:11:49', 455, 1),
(556, '2019-10-21 12:32:05', '2019-10-21 15:13:07', 455, 1),
(557, '2019-10-21 15:14:45', '2019-10-21 15:35:20', 455, 1),
(558, '2019-10-24 11:44:19', '2019-10-24 15:00:14', 455, 1),
(559, '2019-10-28 11:57:41', '2019-10-28 17:24:31', 455, 1),
(560, '2019-10-28 17:34:30', '2019-10-28 17:50:39', 455, 1),
(561, '2019-10-29 11:34:21', '2019-10-29 12:46:15', 455, 1),
(562, '2019-10-31 11:42:56', '2019-10-31 16:17:12', 455, 1),
(563, '2019-10-31 16:17:17', '2019-10-31 16:29:47', 470, 1),
(564, '2019-10-31 16:29:50', '2019-10-31 16:32:01', 455, 1),
(565, '2019-10-31 16:32:04', '2019-10-31 16:32:42', 470, 1),
(566, '2019-11-06 14:24:16', '2019-11-06 14:24:30', 455, 1),
(567, '2019-11-06 14:24:36', '2019-11-06 14:28:58', 470, 1),
(568, '2019-11-06 14:29:01', '2019-11-06 14:34:09', 470, 1),
(569, '2019-11-06 14:34:12', '2019-11-06 14:41:50', 470, 1),
(570, '2019-11-08 10:54:14', '2019-11-08 11:46:41', 455, 1),
(571, '2019-11-20 11:21:23', '2019-11-20 13:48:13', 455, 1),
(572, '2019-11-21 12:19:03', '2019-11-21 14:19:42', 455, 1),
(573, '2019-11-21 16:01:47', '2019-11-22 12:21:21', 455, 1),
(574, '2019-11-22 12:52:47', '2019-11-22 15:10:14', 455, 1),
(575, '2019-11-22 15:17:37', '2019-11-22 17:02:45', 455, 1),
(576, '2019-11-29 15:25:52', '2019-11-29 15:58:47', 455, 1),
(577, '2019-11-29 16:46:35', '2019-11-29 17:10:03', 455, 1),
(578, '2019-12-02 12:17:04', '2019-12-02 13:24:10', 455, 1),
(579, '2019-12-04 15:06:31', '2019-12-05 16:18:27', 455, 1),
(580, '2019-12-05 17:09:16', '2019-12-05 18:08:29', 455, 1),
(581, '2019-12-06 08:55:11', '2019-12-06 10:30:10', 455, 1),
(582, '2019-12-06 11:48:20', '2019-12-06 11:48:24', 455, 1),
(583, '2019-12-12 00:52:26', '2019-12-12 12:33:32', 471, 1),
(584, '2019-12-12 22:20:28', '2019-12-12 22:21:07', 471, 1),
(585, '2019-12-13 12:40:29', '2019-12-13 14:30:27', 471, 1),
(586, '2019-12-13 14:33:25', '2019-12-14 12:19:12', 471, 1),
(587, '2019-12-15 22:37:32', '2019-12-16 00:40:04', 471, 1),
(588, '2019-12-16 00:42:13', '2019-12-16 16:48:29', 471, 1),
(589, '2019-12-18 15:34:01', '2019-12-18 19:48:26', 471, 1),
(590, '2019-12-19 09:59:48', '2019-12-19 10:34:38', 471, 1),
(591, '2019-12-19 09:30:33', '2019-12-19 18:58:52', 471, 1),
(592, '2019-12-20 11:32:58', '2019-12-20 14:41:10', 471, 1),
(593, '2019-12-20 11:22:58', '2019-12-21 00:08:59', 471, 1),
(594, '2019-12-21 10:22:15', '2019-12-21 12:53:52', 471, 1),
(595, '2019-12-21 10:20:20', '2019-12-21 12:59:32', 471, 1),
(596, '2019-12-21 12:59:41', '2019-12-21 13:01:27', 472, 1),
(597, '2019-12-21 13:01:37', '2019-12-21 13:02:39', 471, 1),
(598, '2019-12-21 13:02:48', '2019-12-21 13:09:10', 472, 1),
(599, '2019-12-21 14:47:30', '2019-12-21 14:50:52', 471, 1),
(600, '2019-12-21 14:58:55', '2019-12-21 15:05:39', 471, 1),
(601, '2019-12-21 15:05:49', '2019-12-21 15:05:54', 473, 1),
(602, '2019-12-21 15:07:04', '2019-12-21 15:07:53', 473, 1),
(603, '2019-12-21 15:08:32', '2019-12-21 15:10:25', 473, 1),
(604, '2019-12-21 15:11:16', '2019-12-21 17:53:38', 473, 1),
(605, '2019-12-21 17:54:02', '2019-12-21 17:54:15', 473, 1),
(606, '2019-12-22 13:19:18', '2019-12-22 17:07:47', 473, 1),
(607, '2019-12-24 01:04:58', '2019-12-24 04:37:19', 471, 1),
(608, '2019-12-24 11:47:05', '2019-12-25 11:11:15', 471, 1),
(609, '2019-12-25 11:11:39', '2019-12-25 11:13:44', 471, 1),
(610, '2019-12-25 11:13:58', '2019-12-25 11:54:06', 471, 1),
(611, '2019-12-26 10:29:05', '2019-12-26 12:56:19', 471, 1),
(612, '2019-12-26 14:30:16', '2019-12-26 15:34:28', 471, 1),
(613, '2019-12-26 12:57:54', '2019-12-26 17:24:21', 471, 1),
(614, '2019-12-26 18:38:37', '2019-12-27 12:25:49', 471, 1),
(615, '2019-12-27 12:50:01', '2019-12-28 13:08:41', 471, 1),
(616, '2019-12-28 11:42:54', '2019-12-28 15:13:42', 471, 1),
(617, '2019-12-27 12:26:12', '2019-12-30 11:04:16', 471, 1),
(618, '2019-12-28 13:20:12', '2019-12-30 12:31:37', 471, 1),
(619, '2019-12-30 17:48:20', '2019-12-30 18:33:05', 471, 1),
(620, '2019-12-30 18:57:53', '2019-12-30 19:01:04', 471, 1),
(621, '2019-12-26 10:54:37', '2019-12-26 11:46:11', 471, 1),
(622, '2019-12-26 11:46:27', '2019-12-26 11:48:14', 471, 1),
(623, '2019-12-26 11:48:27', '2019-12-26 11:50:07', 471, 1),
(624, '2019-12-26 11:50:20', '2019-12-31 12:25:06', 471, 1),
(625, '2019-12-31 12:26:19', '2020-01-02 15:12:49', 471, 1),
(626, '2020-01-08 15:58:42', '2020-01-08 19:57:48', 471, 1),
(627, '2020-01-09 14:32:31', '2020-01-09 19:01:07', 471, 1),
(628, '2020-01-09 14:32:31', '2020-01-09 19:01:07', 471, 1),
(629, '2020-01-10 16:15:13', '2020-01-10 20:46:55', 471, 1),
(630, '2020-01-11 12:26:06', '2020-01-11 16:27:55', 471, 1),
(631, '2020-01-14 11:45:47', '2020-01-14 12:30:47', 471, 1),
(632, '2020-01-14 13:29:47', '2020-01-15 12:13:16', 471, 1),
(633, '2020-01-16 14:05:15', '2020-01-18 11:06:00', 471, 1),
(634, '2020-01-18 11:21:39', '2020-01-18 11:21:58', 471, 1),
(635, '2020-01-18 14:51:15', '2020-01-18 15:21:40', 471, 1),
(636, '2020-01-18 15:22:16', '2020-01-18 15:27:07', 471, 1),
(637, '2020-01-18 22:43:59', '2020-01-19 07:06:23', 471, 1),
(638, '2020-01-19 07:08:23', '2020-01-19 11:01:15', 471, 1),
(639, '2020-01-19 11:06:25', '2020-01-19 11:50:02', 471, 1),
(640, '2020-01-19 12:04:18', '2020-01-20 05:05:46', 471, 1),
(641, '2020-01-20 11:25:02', '2020-01-20 14:01:34', 471, 1),
(642, '2020-01-20 14:12:26', '2020-01-20 14:56:58', 471, 1),
(643, '2020-01-20 17:28:48', '2020-01-20 20:48:57', 471, 1),
(644, '2020-01-20 22:37:05', '2020-01-21 15:04:47', 471, 1),
(645, '2020-01-21 15:06:07', '2020-01-21 18:07:52', 471, 1),
(646, '2020-01-22 22:43:38', '2020-01-23 12:26:33', 471, 1),
(647, '2020-01-23 12:26:45', '2020-01-23 12:27:27', 471, 1),
(648, '2020-01-24 16:57:16', '2020-01-24 20:04:16', 471, 1),
(649, '2020-01-27 11:24:39', '2020-01-27 11:37:24', 471, 1),
(650, '2020-01-27 11:38:12', '2020-01-27 12:59:30', 471, 1),
(651, '2020-01-27 12:48:04', '2020-01-27 13:00:46', 471, 1),
(652, '2020-01-27 13:31:57', '2020-01-27 17:04:16', 471, 1),
(653, '2020-01-27 17:04:50', '2020-01-27 17:05:26', 471, 1),
(654, '2020-01-28 10:12:10', '2020-01-28 14:23:14', 471, 1),
(655, '2020-01-29 10:14:41', '2020-01-29 11:57:06', 471, 1),
(656, '2020-01-29 12:01:27', '2020-01-29 14:34:36', 471, 1),
(657, '2020-01-29 14:35:57', '2020-01-29 17:00:04', 471, 1),
(658, '2020-01-29 17:16:00', '2020-01-29 20:15:49', 471, 1),
(659, '2020-01-30 00:29:20', '2020-01-30 01:53:43', 471, 1),
(660, '2020-01-30 01:53:59', '2020-01-30 05:33:50', 471, 1),
(661, '2020-01-30 13:05:00', '2020-01-30 14:07:42', 471, 1),
(662, '2020-01-30 14:19:10', '2020-01-30 14:21:28', 471, 1),
(663, '2020-01-30 14:27:14', '2020-01-30 14:57:28', 471, 1),
(664, '2020-01-30 14:58:49', '2020-01-30 14:58:53', 471, 1),
(665, '2020-02-03 11:13:43', '2020-02-03 11:24:43', 471, 1),
(666, '2020-02-03 11:24:56', '2020-02-03 11:25:53', 475, 1),
(667, '2020-02-03 11:26:02', '2020-02-03 11:33:53', 471, 1),
(668, '2020-02-03 11:34:38', '2020-02-03 11:35:18', 471, 1),
(669, '2020-02-03 11:35:39', '2020-02-03 11:35:45', 471, 1),
(670, '2020-02-03 11:36:38', '2020-02-03 11:36:43', 471, 1),
(671, '2020-02-03 11:37:48', '2020-02-03 11:37:53', 471, 1),
(672, '2020-02-03 11:38:47', '2020-02-03 11:39:59', 476, 1),
(673, '2020-02-03 11:40:52', '2020-02-03 11:44:05', 476, 1),
(674, '2020-02-03 11:45:47', '2020-02-03 12:00:22', 476, 1),
(675, '2020-02-03 12:03:52', '2020-02-03 12:04:57', 479, 1),
(676, '2020-02-03 12:03:39', '2020-02-03 12:05:44', 475, 1),
(677, '2020-02-03 11:58:50', '2020-02-03 12:09:02', 471, 1),
(678, '2020-02-03 12:09:44', '2020-02-03 12:10:06', 471, 1),
(679, '2020-02-03 12:11:01', '2020-02-03 12:12:54', 476, 1),
(680, '2020-02-03 12:13:29', '2020-02-03 12:33:40', 471, 1),
(681, '2020-02-03 12:19:44', '2020-02-03 12:34:32', 476, 1),
(682, '2020-02-03 12:19:52', '2020-02-03 12:37:53', 475, 1),
(683, '2020-02-03 12:20:02', '2020-02-03 12:38:33', 479, 1),
(684, '2020-02-03 12:44:03', '2020-02-03 13:00:04', 476, 1),
(685, '2020-02-03 13:01:02', '2020-02-03 13:23:27', 476, 1),
(686, '2020-02-03 12:43:43', '2020-02-03 13:26:47', 475, 1),
(687, '2020-02-03 12:45:30', '2020-02-03 13:32:35', 479, 1),
(688, '2020-02-03 13:22:52', '2020-02-03 13:39:38', 471, 1),
(689, '2020-02-03 12:49:14', '2020-02-03 13:40:51', 477, 1),
(690, '2020-02-03 12:19:36', '2020-02-03 14:07:36', 478, 1),
(691, '2020-02-03 13:40:29', '2020-02-03 14:08:56', 471, 1),
(692, '2020-02-03 13:45:02', '2020-02-03 15:41:15', 477, 1),
(693, '2020-02-03 13:44:21', '2020-02-03 15:41:19', 479, 1),
(694, '2020-02-03 13:42:05', '2020-02-03 15:41:25', 475, 1),
(695, '2020-02-03 13:24:57', '2020-02-03 15:43:43', 476, 1),
(696, '2020-02-03 15:44:40', '2020-02-03 15:44:50', 476, 1),
(697, '2020-02-03 15:43:38', '2020-02-03 15:45:13', 475, 1),
(698, '2020-02-03 15:43:58', '2020-02-03 15:45:18', 477, 1),
(699, '2020-02-03 15:43:49', '2020-02-03 15:45:29', 479, 1),
(700, '2020-02-03 15:48:40', '2020-02-03 15:50:11', 475, 1),
(701, '2020-02-03 15:48:47', '2020-02-03 16:11:04', 477, 1),
(702, '2020-02-03 15:46:32', '2020-02-03 16:39:56', 471, 1),
(703, '2020-02-08 04:15:08', '2020-02-08 05:06:56', 471, 1),
(704, '2020-02-08 19:40:13', '2020-02-08 20:07:06', 471, 1),
(705, '2020-02-08 20:07:13', '2020-02-08 20:30:38', 471, 1),
(706, '2020-02-08 20:30:43', '2020-02-08 20:43:41', 471, 1),
(707, '2020-02-08 20:43:48', '2020-02-08 20:59:32', 471, 1),
(708, '2020-02-08 20:59:48', '2020-02-08 21:57:17', 471, 1),
(709, '2020-02-08 21:57:24', '2020-02-09 01:23:55', 471, 1),
(710, '2020-02-09 04:16:21', '2020-02-09 05:36:50', 471, 1),
(711, '2020-02-09 05:37:22', '2020-02-09 07:00:30', 471, 1),
(712, '2020-02-10 12:03:55', '2020-02-10 12:48:40', 471, 1),
(713, '2020-02-10 12:48:48', '2020-02-10 12:50:24', 475, 1),
(714, '2020-02-10 12:53:08', '2020-02-10 12:53:30', 471, 1),
(715, '2020-02-10 12:53:35', '2020-02-10 12:54:23', 476, 1),
(716, '2020-02-10 12:54:29', '2020-02-10 12:55:38', 471, 1),
(717, '2020-02-10 12:55:44', '2020-02-10 12:58:32', 476, 1),
(718, '2020-02-10 13:00:35', '2020-02-10 13:12:04', 471, 1),
(719, '2020-02-10 13:15:55', '2020-02-10 13:26:33', 471, 1),
(720, '2020-02-10 13:26:43', '2020-02-10 13:27:14', 480, 1),
(721, '2020-02-10 13:27:20', '2020-02-10 13:29:48', 471, 1),
(722, '2020-02-10 13:29:53', '2020-02-10 13:34:36', 471, 1),
(723, '2020-02-10 13:35:14', '2020-02-10 13:35:26', 471, 1),
(724, '2020-02-10 13:36:24', '2020-02-10 13:55:05', 471, 1),
(725, '2020-02-10 13:55:38', '2020-02-10 13:57:07', 476, 1),
(726, '2020-02-10 13:57:34', '2020-02-10 14:00:49', 476, 1),
(727, '2020-02-10 14:00:58', '2020-02-10 14:01:54', 471, 1),
(728, '2020-02-10 14:02:00', '2020-02-10 14:03:43', 476, 1),
(729, '2020-02-10 14:03:49', '2020-02-10 14:04:07', 471, 1),
(730, '2020-02-10 14:04:13', '2020-02-10 14:05:07', 475, 1),
(731, '2020-02-10 14:05:13', '2020-02-10 14:06:03', 471, 1),
(732, '2020-02-10 14:06:23', '2020-02-10 14:08:43', 476, 1),
(733, '2020-02-10 14:08:50', '2020-02-10 14:09:28', 471, 1),
(734, '2020-02-10 14:09:34', '2020-02-10 14:09:52', 471, 1),
(735, '2020-02-10 14:10:01', '2020-02-10 14:18:45', 476, 1),
(736, '2020-02-10 14:18:52', '2020-02-10 14:20:26', 471, 1),
(737, '2020-02-10 14:20:38', '2020-02-10 14:23:31', 476, 1),
(738, '2020-02-10 14:23:37', '2020-02-10 14:28:51', 475, 1),
(739, '2020-02-10 14:28:56', '2020-02-10 14:29:01', 475, 1),
(740, '2020-02-10 14:29:09', '2020-02-10 14:29:19', 471, 1),
(741, '2020-02-10 14:29:30', '2020-02-10 14:30:19', 476, 1),
(742, '2020-02-10 14:39:05', '2020-02-10 14:45:10', 471, 1),
(743, '2020-02-10 14:45:24', '2020-02-10 14:45:37', 475, 1),
(744, '2020-02-10 14:45:43', '2020-02-10 14:47:36', 471, 1),
(745, '2020-02-10 14:42:43', '2020-02-10 14:48:02', 471, 1),
(746, '2020-02-10 14:47:42', '2020-02-10 14:49:04', 475, 1),
(747, '2020-02-10 14:49:10', '2020-02-10 14:50:34', 471, 1),
(748, '2020-02-10 14:48:04', '2020-02-10 14:57:25', 471, 1),
(749, '2020-02-10 14:50:40', '2020-02-10 15:05:39', 475, 1),
(750, '2020-02-10 15:06:07', '2020-02-10 15:16:11', 476, 1),
(751, '2020-02-10 15:17:30', '2020-02-10 15:17:39', 471, 1),
(752, '2020-02-10 14:57:26', '2020-02-10 15:18:37', 471, 1),
(753, '2020-02-10 15:18:49', '2020-02-10 15:22:11', 475, 1),
(754, '2020-02-10 15:12:12', '2020-02-10 15:24:07', 471, 1),
(755, '2020-02-10 15:17:47', '2020-02-10 15:24:21', 475, 1),
(756, '2020-02-10 15:28:46', '2020-02-10 15:36:42', 475, 1),
(757, '2020-02-10 15:24:37', '2020-02-10 15:37:23', 471, 1),
(758, '2020-02-10 15:38:02', '2020-02-10 15:38:52', 471, 1),
(759, '2020-02-10 15:36:48', '2020-02-10 15:41:28', 471, 1),
(760, '2020-02-10 15:39:33', '2020-02-10 15:51:33', 471, 1),
(761, '2020-02-10 15:41:37', '2020-02-10 16:05:48', 475, 1),
(762, '2020-02-10 16:06:33', '2020-02-10 16:08:51', 475, 1),
(763, '2020-02-10 16:08:57', '2020-02-10 16:09:18', 471, 1),
(764, '2020-02-10 16:09:24', '2020-02-10 16:09:47', 471, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cptamortiprov`
--

DROP TABLE IF EXISTS `cptamortiprov`;
CREATE TABLE IF NOT EXISTS `cptamortiprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compte_id` int(11) NOT NULL,
  `compte_id_corresp` int(11) NOT NULL,
  `classe` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cptcategories`
--

DROP TABLE IF EXISTS `cptcategories`;
CREATE TABLE IF NOT EXISTS `cptcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `numero` int(11) NOT NULL,
  `psedo` int(10) NOT NULL DEFAULT '0',
  `classe_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `classe_id` (`classe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptcategories`
--

INSERT INTO `cptcategories` (`id`, `libelle`, `numero`, `psedo`, `classe_id`, `syn`) VALUES
(20, 'CAPITAL', 10, 0, 1, 1),
(21, 'RESERVES', 11, 0, 1, 1),
(22, 'REPORT A NOUVEAU', 12, 0, 1, 1),
(23, 'RESULTAT NET DE L\'EXERCICE', 13, 0, 1, 1),
(24, 'SUBVENTIONS D\'INVESTISSEMENT', 14, 0, 1, 1),
(25, 'PROVISIONS REGLEMENTEES ET FONDS ASSIMILES', 15, 0, 1, 1),
(26, 'EMPRUNTS ET DETTES ASSIMILEES', 16, 0, 1, 1),
(27, 'DETTES DE LOCATION-ACQUISITION', 17, 0, 1, 1),
(28, 'DETTES LIEES A DES PARTICIPATIONS ET COMPTES DE LIAISON DES ETABLISSEMENTS ET SOCIETES EN PARTICIPATION', 18, 0, 1, 1),
(29, 'PROVISIONS POUR RISQUES ET CHARGES', 19, 0, 1, 1),
(30, 'IMMOBILISATIONS INCORPORELLES', 21, 0, 2, 1),
(31, 'TERRAINS', 22, 0, 2, 1),
(32, 'BATIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', 23, 0, 2, 1),
(33, 'MATERIEL, MOBILIER ET ACTIFS BIOLOGIQUES', 24, 0, 2, 1),
(34, 'AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS', 25, 0, 2, 1),
(35, 'TITRES DE PARTICIPATION', 26, 0, 2, 1),
(36, 'AUTRES IMMOBLISATIONS FINANCIERES', 27, 0, 2, 1),
(37, 'AMORTISSEMENTS', 28, 0, 2, 1),
(38, 'DEPRECIATIONS DES IMMOBILISATIONS', 29, 0, 2, 1),
(39, 'MARCHANDISES', 31, 0, 3, 1),
(40, 'MATIERES PREMIERES ET FOURNITURES LIEES', 32, 0, 3, 1),
(41, 'AUTRES APPROVISIONNEMENTS', 33, 0, 3, 1),
(42, 'PRODUITS EN COURS', 34, 0, 3, 1),
(43, 'SERVICES EN COURS', 35, 0, 3, 1),
(44, 'PRODUITS FINIS', 36, 0, 3, 1),
(45, 'PRODUITS INTERMEDIAIRES ET RESIDUELS', 37, 0, 3, 1),
(46, 'STOCKS EN COURS DE ROUTE, EN CONSIGNATION OU EN DEPOT', 38, 0, 3, 1),
(47, 'DEPRECIATIONS DES STOCKS ET ENCOURS DE PRODUCTION', 39, 0, 3, 1),
(48, 'FOURNISSEURS ET COMPTES RATTACHES', 40, 0, 4, 1),
(49, 'CLIENTS ET COMPTES RATTACHES', 41, 0, 4, 1),
(50, 'PERSONNEL', 42, 0, 4, 1),
(51, 'ORGANISMES SOCIAUX', 43, 0, 4, 1),
(52, 'ETAT ET COLLECTIVITES PUBLIQUES', 44, 0, 4, 1),
(53, 'ORGANISMES INTERNATIONAUX', 45, 0, 4, 1),
(54, 'APPORTEURS, ASSOCIES ET GROUPE', 46, 0, 4, 1),
(55, 'DEBITEURS ET CREDITEURS DIVERS', 47, 0, 4, 1),
(56, 'CREANCES ET DETTES HORS ACTIVITES ORDINAIRES (HAO)', 48, 0, 4, 1),
(57, 'DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME (TIERS)', 49, 0, 4, 1),
(58, 'TITRES DE PLACEMENT', 50, 0, 5, 1),
(59, 'VALEURS A ENCAISSER', 51, 0, 5, 1),
(60, 'BANQUES', 52, 0, 5, 1),
(61, 'ETABLISSEMENTS FINANCIERS ET ASSIMILES', 53, 0, 5, 1),
(62, 'INSTRUMENTS DE TRESORERIE', 54, 0, 5, 1),
(63, 'INSTRUMENTS DE MONNAIE ELECTRONIQUE', 55, 0, 5, 1),
(64, 'BANQUES, CREDITS DE TRESORERIE ET D\'ESCOMPTE', 56, 0, 5, 1),
(65, 'CAISSE', 57, 0, 5, 1),
(66, 'REGIES D\'AVANCES, ACCREDITIFS ET VIREMENTS INTERNES', 58, 0, 5, 1),
(67, 'DEPRECIATIONS ET PROVISIONS POUR RISQUE A COURT TERME ', 59, 0, 5, 1),
(68, 'ACHATS ET VARIATIONS DE STOCKS', 60, 0, 6, 1),
(69, 'TRANSPORTS ', 61, 0, 6, 1),
(70, 'SERVICES EXTERIEURS', 62, 0, 6, 1),
(71, 'AUTRES SERVICES EXTERIEURS', 63, 0, 6, 1),
(72, 'IMPOTS ET TAXES', 64, 0, 6, 1),
(73, 'AUTRES CHARGES', 65, 0, 6, 1),
(74, 'CHARGES DE PERSONNEL', 66, 0, 6, 1),
(75, 'FRAIS FINANCIERS ET CHARGES ASSIMILEES', 67, 0, 6, 1),
(76, 'DOTATIONS AUX AMORTISSEMENTS', 68, 0, 6, 1),
(77, 'DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS', 69, 0, 6, 1),
(78, 'VENTES', 70, 0, 7, 1),
(79, 'SUBVENTIONS D\'EXPLOITATION', 71, 0, 7, 1),
(80, 'PRODUCTION IMMOBILISEE', 72, 0, 7, 1),
(81, 'VARIATIONS DES STOCKS DE BIENS ET DE SERVICES PRODUITS', 73, 0, 7, 1),
(82, 'AUTRES PRODUITS', 75, 0, 7, 1),
(83, 'REVENUS FINANCIERS ET PRODUITS ASSIMILES', 77, 0, 7, 1),
(84, 'TRANSFERTS DE CHARGES', 78, 0, 7, 1),
(85, 'REPRISES DE PROVISIONS, DE DEPRECIATIONS ET AUTRES', 79, 0, 7, 1),
(86, 'VALEURS COMPTABLES DES CESSIONS D\'IMMOBILISATIONS', 81, 0, 8, 1),
(87, 'PRODUITS DES CESSIONS D\'IMMOBILISATIONS', 82, 0, 8, 1),
(88, 'CHARGES HORS ACTIVITES ORDINAIRES', 83, 0, 8, 1),
(89, 'PRODUITS HORS ACTIVITES ORDINAIRES', 84, 0, 8, 1),
(90, 'DOTATIONS HORS ACTIVITES ORDINAIRES', 85, 0, 8, 1),
(91, 'REPRISES DE CHARGES, PROVISIONS ET DEPRECIATIONS HAO.', 86, 0, 8, 1),
(92, 'PARTICIPATION DES TRAVAILLEURS', 87, 0, 8, 1),
(93, 'SUBVENTIONS D\'EQUILIBRE', 88, 0, 8, 1),
(94, 'IMPOTS SUR LE RESULTAT', 89, 0, 8, 1),
(99, 'ENGAGEMENTS OBTENUS ET ENGAGEMENTS ACCORDES', 90, 0, 9, 1),
(100, 'CONTREPARTIES DES ENGAGEMENTS', 91, 0, 9, 1),
(101, 'COMPTES REFLECHIS', 92, 0, 9, 1),
(102, 'COMPTES DE RECLASSEMENTS', 93, 0, 9, 1),
(103, 'COMPTES DE COUTS', 94, 0, 9, 1),
(104, 'COMPTES DE STOCKS', 95, 0, 9, 1),
(105, 'COMPTES D\'ECARTS SUR COUTS PREETABLIS', 96, 0, 9, 1),
(106, 'COMPTES DE DIFFERENCES DE TRAITEMENT COMPTABLE', 97, 0, 9, 1),
(107, 'COMPTES DE RESULTATS', 98, 0, 9, 1),
(108, 'COMPTES DE LIAISONS INTERNES', 99, 0, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cptclasses`
--

DROP TABLE IF EXISTS `cptclasses`;
CREATE TABLE IF NOT EXISTS `cptclasses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `libelle2` varchar(245) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `etat` varchar(245) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptclasses`
--

INSERT INTO `cptclasses` (`id`, `libelle`, `libelle2`, `numero`, `etat`, `syn`) VALUES
(1, 'Classe 1', 'Comptes de ressources durables', 1, 'bilan', 1),
(2, 'Classe 2', 'Comptes d\'actif immobilise', 2, 'bilan', 1),
(3, 'Classe 3', 'Comptes de stocks', 3, 'bilan', 1),
(4, 'Classe 4', 'comptes de tiers', 4, 'bilan', 1),
(5, 'Classe 5', 'comptes de trésorerie', 5, 'bilan', 1),
(6, 'Classe 6', 'comptes de charges des activités ordinaires', 6, 'gestion', 1),
(7, 'Classe 7', 'Comptes de produits des activités ordinaires', 7, 'gestion', 1),
(8, 'Classe 8', 'Comptes des autres charges et des autres produits', 8, 'autre', 1),
(9, 'Classe 9', 'Comptes des engagements hors bilan et comptes de la comptabilité analytique de gestion', 9, 'gestion', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cptcomptes`
--

DROP TABLE IF EXISTS `cptcomptes`;
CREATE TABLE IF NOT EXISTS `cptcomptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `psedo` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=449 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptcomptes`
--

INSERT INTO `cptcomptes` (`id`, `libelle`, `numero`, `statut`, `categorie_id`, `psedo`, `syn`) VALUES
(11, 'CAPITAL SOCIAL', '101', 'actif', 20, 0, 1),
(12, 'CAPITAL PAR DOTATION', '102', 'actif', 20, 0, 1),
(13, 'CAPITAL PERSONNEL', '103', 'actif', 20, 0, 1),
(14, 'COMPTE DE L\'EXPLOITANT', '104', 'actif', 20, 0, 1),
(15, 'PRIMES LIEES AU CAPITAL SOCIAL', '105', 'actif', 20, 0, 1),
(16, 'ECARTS DE REEVALUATION', '106', 'actif', 20, 0, 1),
(17, 'APPORTEURS, CAPITAL SOUSCRIT, NON APPELE', '109', 'actif', 20, 0, 1),
(18, 'RESERVE LEGALE', '111', 'actif', 21, 0, 1),
(19, 'RESERVES STATUTAIRES OU CONTRACTUELLES', '112', 'actif', 21, 0, 1),
(20, 'RESERVES REGLEMENTEES', '113', 'actif', 21, 0, 1),
(21, 'AUTRES RESERVES', '118', 'actif', 21, 0, 1),
(22, 'REPORT A NOUVEAU CREDITEUR', '121', 'actif', 22, 0, 1),
(23, 'REPORT A NOUVEAU DEBITEUR', '129', 'actif', 22, 0, 1),
(24, 'RESULTAT EN INSTANCE D\'AFFECTATION', '130', 'actif', 23, 0, 1),
(25, 'RESULTAT NET : BENEFICE', '131', 'actif', 23, 0, 1),
(26, 'MARGE COMMERCIALE (MC)', '132', 'actif', 23, 0, 1),
(27, 'VALEUR AJOUTEE (V.A.)', '133', 'actif', 23, 0, 1),
(28, 'EXCEDENT BRUT D\'EXPLOITATION (E.B.E.)', '134', 'actif', 23, 0, 1),
(29, 'RESULTAT D\'EXPLOITATION (R.E.)', '135', 'actif', 23, 0, 1),
(30, 'RESULTAT FINANCIER (R.F.)', '136', 'actif', 23, 0, 1),
(31, 'RESULTAT DES ACTIVITES ORDINAIRES (R.A.O.)', '137', 'actif', 23, 0, 1),
(32, 'RESULTAT HORS ACTIVITES ORDINAIRES (R.H.A.O.)', '138', 'actif', 23, 0, 1),
(33, 'RESULTAT NET : PERTE', '139', 'actif', 23, 0, 1),
(34, 'SUBVENTIONS D\'EQUIPEMENT', '141', 'actif', 24, 0, 1),
(35, 'AUTRES SUBVENTIONS D\'INVESTISSEMENT', '148', 'actif', 24, 0, 1),
(36, 'AMORTISSEMENTS DEROGATOIRES', '151', 'actif', 25, 0, 1),
(37, 'PLUS-VALUES DE CESSION A REINVESTIR', '152', 'actif', 25, 0, 1),
(38, 'FONDS REGLEMENTES', '153', 'actif', 25, 0, 1),
(39, 'PROVISIONS SPECIALES DE REEVALUATION', '154', 'actif', 25, 0, 1),
(40, 'PROVISIONS REGLEMENTEES RELATIVES AUX IMMOBILISATIONS', '155', 'actif', 25, 0, 1),
(41, 'PROVISIONS REGLEMENTEES RELATIVES AUX STOCKS', '156', 'actif', 25, 0, 1),
(42, 'PROVISIONS POUR INVESTISSEMENT', '157', 'actif', 25, 0, 1),
(43, 'AUTRES PROVISIONS ET FONDS REGLEMENTES', '158', 'actif', 25, 0, 1),
(44, 'EMPRUNTS OBLIGATAIRES', '161', 'actif', 26, 0, 1),
(45, 'EMPRUNTS ET DETTES AUPRES DES ETABLISSEMENTS DE CREDIT', '162', 'actif', 26, 0, 1),
(46, 'AVANCES RECUES DE L\'ETAT', '163', 'actif', 26, 0, 1),
(47, 'AVANCES RECUES ET COMPTES COURANTS BLOQUES', '164', 'actif', 26, 0, 1),
(48, 'DEPOTS ET CAUTIONNEMENTS RECUES', '165', 'actif', 26, 0, 1),
(49, 'INTERETS COURUS', '166', 'actif', 26, 0, 1),
(50, 'AVANCES ASSORTIES DE CONDITIONS PARTICULIERES', '167', 'actif', 26, 0, 1),
(51, 'AUTRES EMPRUNTS ET DETTES', '168', 'actif', 26, 0, 1),
(52, 'DETTES DE LOCATION-ACQUISITION / CREDIT-BAIL IMMOBILIER', '172', 'actif', 27, 0, 1),
(53, 'DETTES DE LOCATION-ACQUISITION / CREDIT-BAIL MOBILIER', '173', 'actif', 27, 0, 1),
(54, 'DETTES DE LOCATION-ACQUISITION / LOCATION-VENTE', '174', 'actif', 27, 0, 1),
(55, 'INTERETS COURUS', '176', 'actif', 27, 0, 1),
(56, 'AUTRES DETTES DE LOCATION-ACQUISITION', '178', 'actif', 27, 0, 1),
(63, 'DETTES LIEES A DES PARTICIPATIONS', '181', 'actif', 28, 0, 1),
(64, 'DETTES LIEES A DES SOCIETES EN PARTICIPATION', '182', 'actif', 28, 0, 1),
(65, 'INTERETS COURUS SUR DETTES LIEES A DES PARTICIPATIONS', '183', 'actif', 28, 0, 1),
(66, 'COMPTES PERMANENTS BLOQUES DES ETABLISSEMENTS ET SUCCURSALES', '184', 'actif', 28, 0, 1),
(67, 'COMPTES PERMANENTS NON BLOQUES DES ETABLISSEMENTS ET SUCCURSALES', '185', 'actif', 28, 0, 1),
(68, 'COMPTES DE LIAISON CHARGES', '186', 'actif', 28, 0, 1),
(69, 'COMPTES DE LIAISON PRODUITS', '187', 'actif', 28, 0, 1),
(70, 'COMPTES DE LIAISON DES SOCIETES EN PARTICIPATION', '188', 'actif', 28, 0, 1),
(71, 'PROVISIONS POUR LITIGES', '191', 'actif', 29, 0, 1),
(72, 'PROVISIONS POUR GARANTIES DONNEES AUX CLIENTS', '192', 'actif', 29, 0, 1),
(73, 'PROVISIONS POUR PERTES SUR MARCHES A ACHEVEMENT FUTUR', '193', 'actif', 29, 0, 1),
(74, 'PROVISIONS POUR PERTES DE CHANGE', '194', 'actif', 29, 0, 1),
(75, 'PROVISIONS POUR IMPOTS', '195', 'actif', 29, 0, 1),
(76, 'PROVISIONS POUR PENSIONS ET OBLIGATIONS SIMILAIRES', '196', 'actif', 29, 0, 1),
(77, 'PROVISIONS POUR RESTRUCTURATION', '197', 'actif', 29, 0, 1),
(78, 'AUTRES PROVISIONS POUR RISQUES ET CHARGES', '198', 'actif', 29, 0, 1),
(79, 'FRAIS  DE DEVELOPPEMENT', '211', 'actif', 30, 0, 1),
(80, 'BREVETS, LICENCES, CONCESSIONS ET DROITS SIMILAIRES', '212', 'actif', 30, 0, 1),
(81, 'LOGICIELS ET SITES INTERNET', '213', 'actif', 30, 0, 1),
(82, 'MARQUES', '214', 'actif', 30, 0, 1),
(83, 'FONDS COMMERCIAL', '215', 'actif', 30, 0, 1),
(84, 'DROIT AU BAIL', '216', 'actif', 30, 0, 1),
(85, 'INVESTISSEMENTS DE CREATION', '217', 'actif', 30, 0, 1),
(86, 'AUTRES DROITS ET VALEURS INCORPORELS', '218', 'actif', 30, 0, 1),
(87, 'IMMOBILISATIONS INCORPORELLES EN COURS', '219', 'actif', 30, 0, 1),
(88, 'TERRAINS AGRICOLES ET FORESTIERS', '221', 'actif', 31, 0, 1),
(89, 'TERRAINS NUS', '222', 'actif', 31, 0, 1),
(90, 'TERRAINS BATIS', '223', 'actif', 31, 0, 1),
(91, 'TRAVAUX DE MISE EN VALEUR DES TERRAINS', '224', 'actif', 31, 0, 1),
(92, 'TERRAINS DE CARRIERES-TREFONDS ', '225', 'actif', 31, 0, 1),
(93, 'TERRAINS AMENAGES', '226', 'actif', 31, 0, 1),
(94, 'TERRAINS MIS EN CONCESSION', '227', 'actif', 31, 0, 1),
(95, 'AUTRES TERRAINS', '228', 'actif', 31, 0, 1),
(96, 'AMENAGEMENTS DE TERRAINS EN COURS', '229', 'actif', 31, 0, 1),
(97, 'BATIMENTS INDUSTRIELS, AGRICOLES, ADMINISTRATIFS ET COMMERCIAUX SUR SOL PROPRE', '231', 'actif', 32, 0, 1),
(98, 'BATIMENTS INDUSTRIELS, AGRICOLES, ADMINISTRATIFS ET COMMERCIAUX SUR SOL D\'AUTRUI', '232', 'actif', 32, 0, 1),
(99, 'OUVRAGES D\'INFRASTRUCTURE', '233', 'actif', 32, 0, 1),
(100, 'AMENAGEMENTS, AGENCEMENTS ET INSTALLATIONS TECHNIQUES', '234', 'actif', 32, 0, 1),
(101, 'AMENAGEMENTS DE BUREAUX', '235', 'actif', 32, 0, 1),
(102, 'BATIMENTS INDUSTRIELS, AGRICOLES ET COMMERCIAUX MIS EN CONCESSION', '237', 'actif', 32, 0, 1),
(103, 'AUTRES INSTALLATIONS ET AGENCEMENTS', '238', 'actif', 32, 0, 1),
(104, 'BATIMENTS AMENAGEMENTS, AGENCEMENTS  ET INSTALLATIONS EN COURS', '239', 'actif', 32, 0, 1),
(105, 'MATERIEL ET OUTILLAGE INDUSTRIEL ET COMMERCIAL', '241', 'actif', 33, 0, 1),
(106, 'MATERIEL ET OUTILLAGE AGRICOLE', '242', 'actif', 33, 0, 1),
(107, 'MATERIEL D\'EMBALLAGE RECUPERABLE ET IDENTIFIABLE', '243', 'actif', 33, 0, 1),
(108, 'MATERIEL ET MOBILIER ', '244', 'actif', 33, 0, 1),
(109, 'MATERIEL DE TRANSPORT', '245', 'actif', 33, 0, 1),
(110, 'ACTIFS BIOLOGIQUES', '246', 'actif', 33, 0, 1),
(111, 'AGENCEMENTS, AMENAGEMENTS DU MATERIEL ET DES ACTIFS BIOLOGIQUES', '247', 'actif', 33, 0, 1),
(112, 'AUTRES MATERIELS ET MOBILIERS', '248', 'actif', 33, 0, 1),
(113, 'MATERIELS ET ACTIFS BIOLOGIQUES EN COURS', '249', 'actif', 33, 0, 1),
(114, 'AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS INCORPORELLES', '251', 'actif', 34, 0, 1),
(115, 'AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS CORPORELLES', '252', 'actif', 34, 0, 1),
(116, 'TITRES DE PARTICIPATION DANS DES ENTITES SOUS CONTROLE EXCLUSIF', '261', 'actif', 35, 0, 1),
(117, 'TITRES DE PARTICIPATION DANS DES ENTITES SOUS CONTROLE  CONJOINT', '262', 'actif', 35, 0, 1),
(118, 'TITRES DE PARTICIPATION DANS DES ENTITESCONFERANT UNE INFLUENCE NOTABLE', '263', 'actif', 35, 0, 1),
(119, 'PARTICIPATIONS DANS DES ORGANISMES PROFESSIONNELS', '265', 'actif', 35, 0, 1),
(120, 'PARTS DANS DES GROUPEMENTS D\'INTERET ECONOMIQUE (G.I.E.)', '266', 'actif', 35, 0, 1),
(121, 'AUTRES TITRES DE PARTICIPATION', '268', 'actif', 35, 0, 1),
(122, 'PRETS ET CREANCES', '271', 'actif', 36, 0, 1),
(123, 'PRETS AU PERSONNEL', '272', 'actif', 36, 0, 1),
(124, 'CREANCES SUR L\'ETAT', '273', 'actif', 36, 0, 1),
(125, 'TITRES IMMOBILISES', '274', 'actif', 36, 0, 1),
(126, 'DEPOTS ET CAUTIONNEMENTS VERSES', '275', 'actif', 36, 0, 1),
(127, 'INTERETS COURUS', '276', 'actif', 36, 0, 1),
(128, 'CREANCES RATTACHEES A DES PARTICIPATIONS ET AVANCES A DES G.I.E.', '277', 'actif', 36, 0, 1),
(129, 'IMMOBILISATIONS FINANCIERES DIVERSES', '278', 'actif', 36, 0, 1),
(130, 'AMORTISSEMENTS DES IMMOBILISATIONS INCORPORELLES', '281', 'actif', 37, 0, 1),
(131, 'AMORTISSEMENTS DES TERRAINS', '282', 'actif', 37, 0, 1),
(132, 'AMORTISSEMENTS DES BATIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', '283', 'actif', 37, 0, 1),
(133, 'AMORTISSEMENTS DU MATERIEL', '284', 'actif', 37, 0, 1),
(134, 'DEPRECIATIONS DES IMMOBILISATIONS INCORPORELLES', '291', 'actif', 38, 0, 1),
(135, 'DEPRECIATIONS DES TERRAINS ', '292', 'actif', 38, 0, 1),
(136, 'DEPRECIATIONS DES BATIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', '293', 'actif', 38, 0, 1),
(137, 'DEPRECIATIONS DE MATERIEL, DU MOBILIER ET DE L\'ACTIF BIOLOGIQUE', '294', 'actif', 38, 0, 1),
(138, 'DEPRECIATIONS DES AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS', '295', 'actif', 38, 0, 1),
(139, 'DEPRECIATIONS DES TITRES DE PARTICIPATION', '296', 'actif', 38, 0, 1),
(140, 'DEPRECIATIONS DES AUTRES IMMOBILISATIONS FINANCIERES', '297', 'actif', 38, 0, 1),
(141, 'MARCHANDISES A', '311', 'actif', 39, 0, 1),
(142, 'MARCHANDISES B', '312', 'actif', 39, 0, 1),
(143, 'ACTIFS BIOLOGIQUES', '313', 'actif', 39, 0, 1),
(144, 'MARCHANDISES HORS ACTIVITES ORDINAIRES (H.A.O.)', '318', 'actif', 39, 0, 1),
(145, 'MATIERES A', '321', 'actif', 40, 0, 1),
(146, 'MATIERES B', '322', 'actif', 40, 0, 1),
(147, 'FOURNITURES (A,B)', '323', 'actif', 40, 0, 1),
(148, 'MATIERES CONSOMMABLES', '331', 'actif', 41, 0, 1),
(149, 'FOURNITURES D\'ATELIER ET D\'USINE', '332', 'actif', 41, 0, 1),
(150, 'FOURNITURES DE MAGASIN', '333', 'actif', 41, 0, 1),
(151, 'FOURNITURES DE BUREAU', '334', 'actif', 41, 0, 1),
(152, 'EMBALLAGES', '335', 'actif', 41, 0, 1),
(153, 'AUTRES MATIERES', '338', 'actif', 41, 0, 1),
(154, 'PRODUITS EN COURS', '341', 'actif', 42, 0, 1),
(155, 'TRAVAUX EN COURS', '342', 'actif', 42, 0, 1),
(156, 'PRODUITS INTERMEDIAIRES EN COURS', '343', 'actif', 42, 0, 1),
(157, 'PRODUITS RESIDUELS EN COURS', '344', 'actif', 42, 0, 1),
(158, 'ACTIFS BIOLOGIQUES', '345', 'actif', 42, 0, 1),
(159, 'ETUDES EN COURS', '351', 'actif', 43, 0, 1),
(160, 'PRESTATIONS DE SERVICES EN COURS', '352', 'actif', 43, 0, 1),
(161, 'PRODUITS FINIS A', '361', 'actif', 44, 0, 1),
(162, 'PRODUITS FINIS B', '362', 'actif', 44, 0, 1),
(163, 'ACTIFS BIOLOGIQUES ', '363', 'actif', 44, 0, 1),
(164, 'PRODUITS INTERMEDIAIRES', '371', 'actif', 45, 0, 1),
(165, 'PRODUITS RESIDUELS', '372', 'actif', 45, 0, 1),
(166, 'ACTIFS BIOLOGIQUES ', '373', 'actif', 45, 0, 1),
(167, 'MARCHANDISES EN COURS DE ROUTE', '381', 'actif', 46, 0, 1),
(168, 'MATIERES PREMIERES ET FOURNITURES LIEES EN COURS DE ROUTE', '382', 'actif', 46, 0, 1),
(169, 'AUTRES APPROVISIONNEMENTS EN COURS DE ROUTE', '383', 'actif', 46, 0, 1),
(170, 'PRODUITS FINIS EN COURS DE ROUTE', '386', 'actif', 46, 0, 1),
(171, 'STOCK EN CONSIGNATION OU EN DEPOT', '387', 'actif', 46, 0, 1),
(172, 'STOCK PROVENANT D\'IMMOBILISATIONS MISES HORS SERVICE OU AU REBUT', '388', 'actif', 46, 0, 1),
(173, 'DEPRECIATIONS DES STOCKS DE MARCHANDISES', '391', 'actif', 47, 0, 1),
(174, 'DEPRECIATIONS DES STOCKS DE MATIERES PREMIERES ET FOURNITURES LIEES', '392', 'actif', 47, 0, 1),
(175, 'DEPRECIATIONS DES STOCKS D\'AUTRES APPROVISIONNEMENTS', '393', 'actif', 47, 0, 1),
(176, 'DEPRECIATIONS DES PRODUCTIONS EN COURS', '394', 'actif', 47, 0, 1),
(177, 'DEPRECIATIONS DES SERVICES EN COURS', '395', 'actif', 47, 0, 1),
(178, 'DEPRECIATIONS DES STOCKS DE PRODUITS FINIS', '396', 'actif', 47, 0, 1),
(179, 'DEPRECIATIONS DES STOCKS DE PRODUITS INTERMEDIAIRES ET RESIDUELS', '397', 'actif', 47, 0, 1),
(180, 'DEPRECIATIONS DES STOCKS EN COURS DE ROUTE, EN CONSIGNATION OU EN DEPOT', '398', 'actif', 47, 0, 1),
(181, 'SECURITE SOCIALE', '431', 'actif', 51, 0, 1),
(182, 'CAISSES DE RETRAITE COMPLEMENTAIRE', '432', 'actif', 51, 0, 1),
(183, 'AUTRES ORGANISMES SOCIAUX', '433', 'actif', 51, 0, 1),
(184, 'ORGANISMES SOCIAUX, CHARGES A PAYER ET PRODUITS A RECEVOIR', '438', 'actif', 51, 0, 1),
(185, 'ETAT, IMPOT SUR LES BENEFICES', '441', 'actif', 52, 0, 1),
(186, 'ETAT, AUTRES IMPOTS ET TAXES', '442', 'actif', 52, 0, 1),
(187, 'ETAT, T.V.A. FACTUREE', '443', 'actif', 52, 0, 1),
(188, 'ETAT, T.V.A. DUE OU CREDIT DE T.V.A.\r\n', '444', 'actif', 52, 0, 1),
(189, 'ETAT, T.V.A. RECUPERABLE', '445', 'actif', 52, 0, 1),
(190, 'ETAT, AUTRES TAXES SUR LE CHIFFRE D\'AFFAIRES', '446', 'actif', 52, 0, 1),
(191, 'ETAT, IMPOTS RETENUS A LA SOURCE', '447', 'actif', 52, 0, 1),
(192, 'ETAT, CHARGES A PAYER ET PRODUITS A RECEVOIR', '448', 'actif', 52, 0, 1),
(193, 'ETAT, CREANCES ET DETTES DIVERSES', '449', 'actif', 52, 0, 1),
(194, 'OPERATIONS AVEC LES ORGANISMES AFRICAINS', '451', 'actif', 53, 0, 1),
(195, 'OPERATIONS AVEC LES AUTRES ORGANISMES INTERNATIONAUX', '452', 'actif', 53, 0, 1),
(196, 'ORGANISMES INTERNATIONAUX, FONDS DE DOTATION ET SUBVENTIONS A RECEVOIR', '458', 'actif', 53, 0, 1),
(197, 'APPORTEURS, OPERATIONS SUR LE CAPITAL', '461', 'actif', 54, 0, 1),
(198, 'ASSOCIES (2), COMPTES COURANTS', '462', 'actif', 54, 0, 1),
(199, 'ASSOCIES (2), OPERATIONS FAITES EN COMMUN ET GIE', '463', 'actif', 54, 0, 1),
(200, 'ASSOCIES (2), DIVIDENDES A PAYER', '465', 'actif', 54, 0, 1),
(201, 'GROUPE, COMPTES COURANTS', '466', 'actif', 54, 0, 1),
(202, 'APPORTEURS RESTANT DU SUR CAPITAL APPELE', '467', 'actif', 54, 0, 1),
(203, 'ENTITE, DIVIDENDES A RECEVOIR', '469', 'actif', 54, 0, 1),
(204, 'DEBITEURS ET CREDITEURS DIVERS ', '471', 'actif', 55, 0, 1),
(205, 'CREANCES ET DETTES SUR TITRES DE PLACEMENT ', '472', 'actif', 55, 0, 1),
(206, 'INTERMEDIAIRES - OPERATIONS FAITES POUR COMPTE DE TIERS', '473', 'actif', 55, 0, 1),
(207, 'COMPTE DE REPARTITION PERIODIQUE DES CHARGES ET DES PRODUITS', '474', 'actif', 55, 0, 1),
(208, 'COMPTE TRANSITOIRE, AJUSTEMENT SPECIAL LIE A LA REVISION DU SYSCOHADA ', '475', 'actif', 55, 0, 1),
(209, 'CHARGES CONSTATEES D\'AVANCE', '476', 'actif', 55, 0, 1),
(210, 'PRODUITS CONSTATES D\'AVANCE', '477', 'actif', 55, 0, 1),
(211, 'ECARTS DE CONVERSION-ACTIF', '478', 'actif', 55, 0, 1),
(212, 'ECARTS DE CONVERSION-PASSIF', '479', 'actif', 55, 0, 1),
(213, 'FOURNISSEURS D\'INVESTISSEMENTS', '481', 'actif', 56, 0, 1),
(214, 'FOURNISSEURS D\'INVESTISSEMENTS, EFFETS A PAYER', '482', 'actif', 56, 0, 1),
(215, 'AUTRES DETTES HORS ACTIVITES ORDINAIRES (H.A.O.)', '484', 'actif', 56, 0, 1),
(216, 'CREANCES SUR CESSIONS D\'IMMOBILISATIONS', '485', 'actif', 56, 0, 1),
(217, 'AUTRES CREANCES HORS ACTIVITES ORDINAIRES (H.A.O.)', '488', 'actif', 56, 0, 1),
(218, 'DEPRECIATIONS DES COMPTES FOURNISSEURS', '490', 'actif', 57, 0, 1),
(219, 'DEPRECIATIONS DES COMPTES CLIENTS', '491', 'actif', 57, 0, 1),
(220, 'DEPRECIATIONS DES COMPTES PERSONNEL', '492', 'actif', 57, 0, 1),
(221, 'DEPRECIATIONS DES COMPTES ORGANISMES SOCIAUX', '493', 'actif', 57, 0, 1),
(222, 'DEPRECIATIONS DES COMPTES ETAT ET COLLECTIVITES PUBLIQUES', '494', 'actif', 57, 0, 1),
(223, 'DEPRECIATIONS DES COMPTES ORGANISMES INTERNATIONAUX', '495', 'actif', 57, 0, 1),
(224, 'DEPRECIATIONS DES COMPTES  ASSOCIES ET GROUPE', '496', 'actif', 57, 0, 1),
(225, 'DEPRECIATIONS DES COMPTES DEBITEURS DIVERS', '497', 'actif', 57, 0, 1),
(226, 'DEPRECIATIONS DES COMPTES DE CREANCES H.A.O.', '498', 'actif', 57, 0, 1),
(227, 'PROVISIONS POUR RISQUES A COURT TERME', '499', 'actif', 57, 0, 1),
(228, 'TITRES DU TRESOR ET BONS DE CAISSE A COURT TERME', '501', 'actif', 58, 0, 1),
(229, 'ACTIONS', '502', 'actif', 58, 0, 1),
(230, 'OBLIGATIONS', '503', 'actif', 58, 0, 1),
(231, 'BONS DE SOUSCRIPTION', '504', 'actif', 58, 0, 1),
(232, 'TITRES NEGOCIABLES HORS REGION', '505', 'actif', 58, 0, 1),
(233, 'INTERETS COURUS', '506', 'actif', 58, 0, 1),
(234, 'AUTRES TITRES DE PLACEMENT ET CREANCES ASSIMILEES', '508', 'actif', 58, 0, 1),
(235, 'EFFETS A ENCAISSER', '511', 'actif', 59, 0, 1),
(236, 'EFFETS A L\'ENCAISSEMENT', '512', 'actif', 59, 0, 1),
(237, 'CHEQUES A ENCAISSER', '513', 'actif', 59, 0, 1),
(238, 'CHEQUES A L\'ENCAISSEMENT', '514', 'actif', 59, 0, 1),
(239, 'CARTES DE CREDIT A ENCAISSER', '515', 'actif', 59, 0, 1),
(240, 'AUTRES VALEURS A L\'ENCAISSEMENT', '518', 'actif', 59, 0, 1),
(241, 'BANQUES LOCALES', '521', 'actif', 60, 0, 1),
(242, 'BANQUES AUTRES ETATS REGION', '522', 'actif', 60, 0, 1),
(243, 'BANQUES AUTRES ETATS ZONE MONETAIRE', '523', 'actif', 60, 0, 1),
(244, 'BANQUES HORS ZONE MONETAIRE', '524', 'actif', 60, 0, 1),
(245, 'BANQUES DEPOT  A TERME ', '525', 'actif', 60, 0, 1),
(246, 'BANQUES, INTERETS  COURUS ', '526', 'actif', 60, 0, 1),
(247, 'CHEQUES POSTAUX', '531', 'actif', 61, 0, 1),
(248, 'TRESOR', '532', 'actif', 61, 0, 1),
(249, 'SOCIETES DE GESTION ET D\'INTERMEDIATION (S.G.I.)', '533', 'actif', 61, 0, 1),
(250, 'ETABLISSEMENTS FINANCIERS, INTERETS COURUS', '536', 'actif', 61, 0, 1),
(251, 'AUTRES ORGANISMES FINANCIERS', '538', 'actif', 61, 0, 1),
(252, 'OPTIONS DE TAUX D\'INTERET', '541', 'actif', 62, 0, 1),
(253, 'OPTIONS DE TAUX DE CHANGE', '542', 'actif', 62, 0, 1),
(254, 'OPTIONS DE TAUX BOURSIERS', '543', 'actif', 62, 0, 1),
(255, 'INSTRUMENTS DE MARCHES A TERME', '544', 'actif', 62, 0, 1),
(256, 'AVOIRS D\'OR ET AUTRES METAUX PRECIEUX (4)', '545', 'actif', 62, 0, 1),
(257, 'MONNAIE ELECTRONIQUE-CARTE CARBURANT', '551', 'actif', 63, 0, 1),
(258, 'MONNAIE ELECTRONIQUE-TELEPHONE PORTABLE', '552', 'actif', 63, 0, 1),
(259, 'MONNAIE ELECTRONIQUE- CARTE PEAGE', '553', 'actif', 63, 0, 1),
(260, 'PORTE-MONNAIE ELECTRONIQUE', '554', 'actif', 63, 0, 1),
(261, 'AUTRES INSTRUMENTS DE MONNAIES ELECTRONIQUES', '558', 'actif', 63, 0, 1),
(262, 'CREDITS DE TRESORERIE', '561', 'actif', 64, 0, 1),
(263, 'ESCOMPTE DE CREDITS DE CAMPAGNE', '564', 'actif', 64, 0, 1),
(264, 'ESCOMPTE DE CREDITS ORDINAIRES', '565', 'actif', 64, 0, 1),
(265, 'BANQUES,  CREDITS DE TRESORERIE, INTERETS  COURUS ', '566', 'actif', 64, 0, 1),
(266, 'CAISSE SIEGE SOCIAL', '571', 'actif', 65, 0, 1),
(267, 'CAISSE SUCCURSALE A', '572', 'actif', 65, 0, 1),
(268, 'CAISSE SUCCURSALE B', '573', 'actif', 65, 0, 1),
(269, 'REGIES D\'AVANCE', '581', 'actif', 66, 0, 1),
(270, 'ACCREDITIFS', '582', 'actif', 66, 0, 1),
(271, 'VIREMENTS DE FONDS', '585', 'actif', 66, 0, 1),
(272, 'AUTRES VIREMENTS INTERNES', '588', 'actif', 66, 0, 1),
(273, 'DEPRECIATIONS DES TITRES DE PLACEMENT', '590', 'actif', 67, 0, 1),
(274, 'DEPRECIATIONS DES TITRES ET VALEURS A ENCAISSER', '591', 'actif', 67, 0, 1),
(275, 'DEPRECIATIONS DES COMPTES BANQUES', '592', 'actif', 67, 0, 1),
(276, 'DEPRECIATIONS DES COMPTES ETABLISSEMENTS FINANCIERS ET ASSIMILES', '593', 'actif', 67, 0, 1),
(277, 'DEPRECIATIONS DES COMPTES D\'INSTRUMENTS DE TRESORERIE', '594', 'actif', 67, 0, 1),
(278, 'PROVISIONS POUR RISQUE A COURT TERME  A CARACTERE FINANCIER', '599', 'actif', 67, 0, 1),
(279, 'FOURNISSEURS, DETTES EN COMPTE', '401', 'actif', 48, 0, 1),
(280, 'FOURNISSEURS, EFFETS A PAYER', '402', 'actif', 48, 0, 1),
(281, 'FOURNISSEURS,ACQUISITIONS COURANTES D\'IMMOBILISATIONS', '404', 'actif', 48, 0, 1),
(282, 'FOURNISSEURS, FACTURES NON PARVENUES', '408', 'actif', 48, 0, 1),
(283, 'FOURNISSEURS DEBITEURS', '409', 'actif', 48, 0, 1),
(284, 'CLIENTS', '411', 'actif', 49, 0, 1),
(285, 'CLIENTS, EFFETS A RECEVOIR EN PORTEFEUILLE', '412', 'actif', 49, 0, 1),
(286, 'CLIENTS, CHEQUES, EFFETS ET AUTRES VALEURS IMPAYES', '413', 'actif', 49, 0, 1),
(287, 'CREANCES SUR CESSIONS COURANTES D\'IMMOBILISATIONS', '414', 'actif', 49, 0, 1),
(288, 'CLIENTS, EFFETS ESCOMPTES NON ECHUS', '415', 'actif', 49, 0, 1),
(289, 'CREANCES CLIENTS LITIGIEUSES OU DOUTEUSES', '416', 'actif', 49, 0, 1),
(290, 'CLIENTS, PRODUITS A RECEVOIR', '418', 'actif', 49, 0, 1),
(291, 'CLIENTS CREDITEURS', '419', 'actif', 49, 0, 1),
(292, 'PERSONNEL, AVANCES ET ACOMPTES', '421', 'actif', 50, 0, 1),
(293, 'PERSONNEL, REMUNERATIONS DUES', '422', 'actif', 50, 0, 1),
(294, 'PERSONNEL, OPPOSITIONS, SAISIES-ARRETS', '423', 'actif', 50, 0, 1),
(295, 'PERSONNEL, OEUVRES SOCIALES INTERNES', '424', 'actif', 50, 0, 1),
(296, 'REPRESENTANTS DU PERSONNEL', '425', 'actif', 50, 0, 1),
(297, 'PERSONNEL, PARTICIPATION AUX BENEFICES ET AU CAPITAL', '426', 'actif', 50, 0, 1),
(298, 'PERSONNEL-DEPOTS', '427', 'actif', 50, 0, 1),
(299, 'PERSONNEL, CHARGES A PAYER ET PRODUITS A RECEVOIR', '428', 'actif', 50, 0, 1),
(300, 'ACHATS DE MARCHANDISES', '601', 'actif', 68, 0, 1),
(301, 'ACHATS DE MATIERES PREMIERES ET FOURNITURES LIEES', '602', 'actif', 68, 0, 1),
(302, 'VARIATIONS DES STOCKS DE BIENS ACHETES', '603', 'actif', 68, 0, 1),
(303, 'ACHATS STOCKES DE MATIERES ET FOURNITURES CONSOMMABLES', '604', 'actif', 68, 0, 1),
(304, 'AUTRES ACHATS', '605', 'actif', 68, 0, 1),
(305, 'ACHATS D\'EMBALLAGES', '608', 'actif', 68, 0, 1),
(306, 'TRANSPORTS SUR VENTES', '612', 'actif', 69, 0, 1),
(307, 'TRANSPORTS POUR LE COMPTE DE TIERS', '613', 'actif', 69, 0, 1),
(308, 'TRANSPORTS DU PERSONNEL ', '614', 'actif', 69, 0, 1),
(309, 'TRANSPORTS DE PLIS', '616', 'actif', 69, 0, 1),
(310, 'AUTRES FRAIS DE TRANSPORT', '618', 'actif', 69, 0, 1),
(311, 'SOUS-TRAITANCE GENERALE', '621', 'actif', 70, 0, 1),
(312, 'LOCATIONS,  CHARGES LOCATIVES', '622', 'actif', 70, 0, 1),
(313, 'REDEVANCES DE LOCATION-ACQUISITION ', '623', 'actif', 70, 0, 1),
(314, 'ENTRETIEN, REPARATIONS, REMISE EN ETAT ET MAINTENANCE', '624', 'actif', 70, 0, 1),
(315, 'PRIMES D\'ASSURANCE', '625', 'actif', 70, 0, 1),
(316, 'ETUDES, RECHERCHES ET DOCUMENTATION', '626', 'actif', 70, 0, 1),
(317, 'PUBLICITE, PUBLICATIONS, RELATIONS PUBLIQUES', '627', 'actif', 70, 0, 1),
(318, 'FRAIS DE TELECOMMUNICATIONS', '628', 'actif', 70, 0, 1),
(319, 'FRAIS BANCAIRES', '631', 'actif', 71, 0, 1),
(320, 'REMUNERATIONS D\'INTERMEDIAIRES ET DE CONSEILS', '632', 'actif', 71, 0, 1),
(321, 'FRAIS DE FORMATION DU PERSONNEL', '633', 'actif', 71, 0, 1),
(322, 'REDEVANCES POUR BREVETS, LICENCES, LOGICIELS, CONCESSIONS, DROITS  ET VALEURS SIMILAIRES', '634', 'actif', 71, 0, 1),
(323, 'COTISATIONS', '635', 'actif', 71, 0, 1),
(324, 'REMUNERATIONS DE PERSONNEL EXTERIEUR A L\'ENTITE', '637', 'actif', 71, 0, 1),
(325, 'AUTRES CHARGES EXTERNES', '638', 'actif', 71, 0, 1),
(326, 'IMPOTS ET TAXES DIRECTS', '641', 'actif', 72, 0, 1),
(327, 'IMPOTS ET TAXES INDIRECTS', '645', 'actif', 72, 0, 1),
(328, 'DROITS D\'ENREGISTREMENT', '646', 'actif', 72, 0, 1),
(329, 'PENALITES, AMENDES FISCALES', '647', 'actif', 72, 0, 1),
(330, 'AUTRES IMPOTS ET TAXES', '648', 'actif', 72, 0, 1),
(331, 'PERTES SUR CREANCES CLIENTS ET AUTRES DEBITEURS', '651', 'actif', 73, 0, 1),
(332, 'QUOTE-PART DE RESULTAT SUR OPERATIONS FAITES EN COMMUN', '652', 'actif', 73, 0, 1),
(333, 'VALEURS COMPTABLES DES CESSIONS COURANTES D\'IMMOBILISATIONS', '654', 'actif', 73, 0, 1),
(334, 'PERTE DE CHANGE SUR CREANCES ET DETTES COMMERCIALE', '656', 'actif', 73, 0, 1),
(335, 'PENALITES ET AMENDES PENALES', '657', 'actif', 73, 0, 1),
(336, 'CHARGES DIVERSES', '658', 'actif', 73, 0, 1),
(337, 'CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES   A COURT TERME D\'EXPLOITATION', '659', 'actif', 73, 0, 1),
(338, 'REMUNERATIONS DIRECTES VERSEES AU PERSONNEL NATIONAL', '661', 'actif', 74, 0, 1),
(339, 'REMUNERATIONS DIRECTES VERSEES AU PERSONNEL NON NATIONAL', '662', 'actif', 74, 0, 1),
(340, 'INDEMNITES FORFAITAIRES VERSEES AU PERSONNEL', '663', 'actif', 74, 0, 1),
(341, 'CHARGES SOCIALES', '664', 'actif', 74, 0, 1),
(342, 'REMUNERATIONS ET CHARGES SOCIALES DE L\'EXPLOITANT INDIVIDUEL', '666', 'actif', 74, 0, 1),
(343, 'REMUNERATION TRANSFEREE DE PERSONNEL EXTERIEUR', '667', 'actif', 74, 0, 1),
(344, 'AUTRES CHARGES SOCIALES', '668', 'actif', 74, 0, 1),
(345, 'INTERETS DES EMPRUNTS', '671', 'actif', 75, 0, 1),
(346, 'INTERETS DANS LOYERS DE LOCATION ACQUISITION ', '672', 'actif', 75, 0, 1),
(347, 'ESCOMPTES ACCORDES', '673', 'actif', 75, 0, 1),
(348, 'AUTRES INTERETS', '674', 'actif', 75, 0, 1),
(349, 'ESCOMPTES DES EFFETS DE COMMERCE', '675', 'actif', 75, 0, 1),
(350, 'PERTES DE CHANGE FINANCIERES', '676', 'actif', 75, 0, 1),
(351, 'PERTES SUR TITRES DE PLACEMENT', '677', 'actif', 75, 0, 1),
(352, 'PERTES ET CHARGES SUR RISQUES FINANCIERS', '678', 'actif', 75, 0, 1),
(353, 'CHARGES POUR DEPRECIATIONS  ET PROVISIONS POUR RISQUES A COURT TERME FINANCIERES', '679', 'actif', 75, 0, 1),
(354, 'DOTATIONS AUX AMORTISSEMENTS D\'EXPLOITATION', '681', 'actif', 76, 0, 1),
(356, 'DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS  D\'EXPLOITATION', '691', 'actif', 77, 0, 1),
(357, 'DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS  FINANCIERES', '697', 'actif', 77, 0, 1),
(358, 'VENTES DE MARCHANDISES', '701', 'actif', 78, 0, 1),
(359, 'VENTES DE PRODUITS FINIS', '702', 'actif', 78, 0, 1),
(360, 'VENTES DE PRODUITS INTERMEDIAIRES', '703', 'actif', 78, 0, 1),
(361, 'VENTES DE PRODUITS RESIDUELS', '704', 'actif', 78, 0, 1),
(362, 'TRAVAUX FACTURES', '705', 'actif', 78, 0, 1),
(363, 'SERVICES VENDUS', '706', 'actif', 78, 0, 1),
(364, 'PRODUITS ACCESSOIRES', '707', 'actif', 78, 0, 1),
(365, 'SUR PRODUITS A L\'EXPORTATION', '711', 'actif', 79, 0, 1),
(366, 'SUR PRODUITS A L\'IMPORTATION', '712', 'actif', 79, 0, 1),
(367, 'SUR PRODUITS DE PEREQUATION', '713', 'actif', 79, 0, 1),
(368, 'INDEMNITES ET SUBVENTIONS D\'EXPLOITATION (entité agricole)', '714', 'actif', 79, 0, 1),
(369, 'AUTRES SUBVENTIONS D\'EXPLOITATION', '718', 'actif', 79, 0, 1),
(370, 'IMMOBILISATIONS INCORPORELLES', '721', 'actif', 80, 0, 1),
(371, 'IMMOBILISATIONS CORPORELLES', '722', 'actif', 80, 0, 1),
(372, 'PRODUCTION AUTO-CONSOMMEE', '724', 'actif', 80, 0, 1),
(373, 'IMMOBILISATIONS FINANCIERES (9)', '726', 'actif', 80, 0, 1),
(374, 'VARIATIONS DES STOCKS DE PRODUITS EN COURS', '734', 'actif', 81, 0, 1),
(375, 'VARIATIONS DES SERVICES EN COURS', '735', 'actif', 81, 0, 1),
(376, 'VARIATIONS DES STOCKS DE PRODUITS FINIS', '736', 'actif', 81, 0, 1),
(377, 'VARIATIONS DES STOCKS DE PRODUITS INTERMEDIAIRES ET RESIDUELS', '737', 'actif', 81, 0, 1),
(378, 'PROFITS SUR CREANCES CLIENTS ET AUTRES DEBITEURS', '751', 'actif', 82, 0, 1),
(379, 'QUOTE-PART DE RESULTAT SUR OPERATIONS FAITES EN COMMUN', '752', 'actif', 82, 0, 1),
(380, 'PRODUITS DES CESSIONS COURANTES D\'IMMOBILISATIONS', '754', 'actif', 82, 0, 1),
(381, 'GAINS DE CHANGE SUR CREANCES ET DETTES COMMERCIALES', '756', 'actif', 82, 0, 1),
(382, 'PRODUITS DIVERS', '758', 'actif', 82, 0, 1),
(383, 'REPRISES DE CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME D\'EXPLOITATION', '759', 'actif', 82, 0, 1),
(384, 'INTERETS DE PRETS ET CREANCES DIVERSES', '771', 'actif', 83, 0, 1),
(385, 'REVENUS DE PARTICIPATIONS ET AUTRES TITRES IMMOBILISES', '772', 'actif', 83, 0, 1),
(386, 'ESCOMPTES OBTENUS', '773', 'actif', 83, 0, 1),
(387, 'REVENUS DE PLACEMENT', '774', 'actif', 83, 0, 1),
(388, 'INTERETS DANS LOYERS DE LOCATION-FINANCEMENT', '775', 'actif', 83, 0, 1),
(389, 'GAINS DE CHANGE FINANCIERS', '776', 'actif', 83, 0, 1),
(390, 'GAINS SUR CESSIONS DE TITRES DE PLACEMENT', '777', 'actif', 83, 0, 1),
(391, 'GAINS SUR RISQUES FINANCIERS', '778', 'actif', 83, 0, 1),
(392, 'REPRISES DE CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME FINANCIERES ', '779', 'actif', 83, 0, 1),
(393, 'TRANSFERTS DE CHARGES D\'EXPLOITATION', '781', 'actif', 84, 0, 1),
(394, 'TRANSFERTS DE CHARGES FINANCIERES', '787', 'actif', 84, 0, 1),
(395, 'REPRISES DE PROVISIONS ET DEPRECIATIONS D\'EXPLOITATION', '791', 'actif', 85, 0, 1),
(396, 'REPRISES DE PROVISIONS ET DEPRECIATIONS  FINANCIERES', '797', 'actif', 85, 0, 1),
(397, 'REPRISES D\'AMORTISSEMENTS (10)', '798', 'actif', 85, 0, 1),
(398, 'REPRISES DE SUBVENTIONS D\'INVESTISSEMENT', '799', 'actif', 85, 0, 1),
(399, 'IMMOBILISATIONS INCORPORELLES', '811', 'actif', 86, 0, 1),
(400, 'IMMOBILISATIONS CORPORELLES', '812', 'actif', 86, 0, 1),
(401, 'IMMOBILISATIONS FINANCIERES', '816', 'actif', 86, 0, 1),
(402, 'IMMOBILISATIONS INCORPORELLES', '821', 'actif', 87, 0, 1),
(403, 'IMMOBILISATIONS CORPORELLES', '822', 'actif', 87, 0, 1),
(404, 'IMMOBILISATIONS FINANCIERES', '826', 'actif', 87, 0, 1),
(405, 'CHARGES H.A.O. CONSTATEES', '831', 'actif', 88, 0, 1),
(406, 'CHARGES LIEES AUX OPERATIONS DE RESTRUCTURATION', '833', 'actif', 88, 0, 1),
(407, 'PERTES SUR CREANCES H.A.O.', '834', 'actif', 88, 0, 1),
(408, 'DONS ET LIBERALITES ACCORDES', '835', 'actif', 88, 0, 1),
(409, 'ABANDONS DE CREANCES CONSENTIS', '836', 'actif', 88, 0, 1),
(410, 'CHARGES LIEES AUX OPERATIONS DE LIQUIDATION ', '837', 'actif', 88, 0, 1),
(411, 'CHARGES  POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME H.A.O.', '839', 'actif', 88, 0, 1),
(412, 'PRODUITS H.A.O CONSTATES', '841', 'actif', 89, 0, 1),
(413, 'PRODUITS LIES AUX OPERATIONS DE RESTRUCTURATION', '843', 'actif', 89, 0, 1),
(414, 'INDEMNITES ET SUBVENTIONS H.A.O.(entité agricole)', '844', 'actif', 89, 0, 1),
(415, 'DONS ET LIBERALITES OBTENUS', '845', 'actif', 89, 0, 1),
(416, 'ABANDONS DE CREANCES OBTENUS', '846', 'actif', 89, 0, 1),
(417, 'PRODUITS LIES AUX OPERATIONS DE LIQUIDATION', '847', 'actif', 89, 0, 1),
(418, 'TRANSFERTS DE CHARGES H.A.O', '848', 'actif', 89, 0, 1),
(419, 'REPRISES DE CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME H.A.O. ', '849', 'actif', 89, 0, 1),
(420, 'DOTATIONS AUX PROVISIONS REGLEMENTEES', '851', 'actif', 90, 0, 1),
(421, 'DOTATIONS AUX AMORTISSEMENTS H.A.O.', '852', 'actif', 90, 0, 1),
(422, 'DOTATIONS AUX DEPRECIATIONS H.A.O.', '853', 'actif', 90, 0, 1),
(423, 'DOTATIONS AUX PROVISIONS POUR RISQUES ET CHARGES H.A.O.', '854', 'actif', 90, 0, 1),
(424, 'AUTRES DOTATIONS H.A.O.', '858', 'actif', 90, 0, 1),
(425, 'REPRISES DE PROVISIONS REGLEMENTEES', '861', 'actif', 91, 0, 1),
(426, 'REPRISES D\'AMORTISSEMENTS H.A.O', '862', 'actif', 91, 0, 1),
(427, 'REPRISES DE DEPRECIATIONS H.A.O.', '863', 'actif', 91, 0, 1),
(428, 'REPRISES DE PROVISIONS POUR RISQUES ET CHARGES H.A.O.', '864', 'actif', 91, 0, 1),
(429, 'AUTRES REPRISES H.A.O.', '868', 'actif', 91, 0, 1),
(430, 'PARTICIPATION LEGALE AUX BENEFICES', '871', 'actif', 92, 0, 1),
(431, 'PARTICIPATION CONTRACTUELLE AUX BENEFICES', '874', 'actif', 92, 0, 1),
(432, 'AUTRES PARTICIPATIONS', '878', 'actif', 92, 0, 1),
(433, 'ETAT', '881', 'actif', 93, 0, 1),
(434, 'COLLECTIVITES PUBLIQUES', '884', 'actif', 93, 0, 1),
(435, 'GROUPE', '886', 'actif', 93, 0, 1),
(436, 'AUTRES', '888', 'actif', 93, 0, 1),
(437, 'IMPOTS SUR LES BENEFICES DE L\'EXERCICE', '891', 'actif', 94, 0, 1),
(438, 'RAPPEL D\'IMPOTS SUR RESULTATS ANTERIEURS', '892', 'actif', 94, 0, 1),
(439, 'IMPOT MINIMUM FORFAITAIRE (I.M.F.)', '895', 'actif', 94, 0, 1),
(440, 'DEGREVEMENTS ET ANNULATIONS D\'IMPOTS SUR RESULTATS ANTERIEURS', '899', 'actif', 94, 0, 1),
(441, 'ENGAGEMENTS DE FINANCEMENT OBTENUS', '901', 'actif', 99, 0, 1),
(442, 'ENGAGEMENTS DE GARANTIE OBTENUS', '902', 'actif', 99, 0, 1),
(443, 'ENGAGEMENTS RECIPROQUES', '903', 'actif', 99, 0, 1),
(444, 'AUTRES ENGAGEMENTS OBTENUS', '904', 'actif', 99, 0, 1),
(445, 'ENGAGEMENTS DE FINANCEMENT ACCORDES', '905', 'actif', 99, 0, 1),
(446, 'ENGAGEMENTS DE GARANTIE ACCORDES', '906', 'actif', 99, 0, 1),
(447, 'ENGAGEMENTS RECIPROQUES', '907', 'actif', 99, 0, 1),
(448, 'AUTRES ENGAGEMENTS ACCORDES', '908', 'actif', 99, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cptcomptesites`
--

DROP TABLE IF EXISTS `cptcomptesites`;
CREATE TABLE IF NOT EXISTS `cptcomptesites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compte_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `compte_id` (`compte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cptdetailsecritures`
--

DROP TABLE IF EXISTS `cptdetailsecritures`;
CREATE TABLE IF NOT EXISTS `cptdetailsecritures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compte_id` int(11) DEFAULT NULL,
  `debit` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `credit` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `libelle` varchar(245) DEFAULT NULL,
  `numdoc` varchar(245) DEFAULT NULL,
  `devise` varchar(10) DEFAULT NULL,
  `taux` int(11) DEFAULT NULL,
  `ecriture_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `souscompte_id` int(11) DEFAULT NULL,
  `compte_ecriture` varchar(10) DEFAULT NULL,
  `long_compte` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ecriture_id` (`ecriture_id`),
  KEY `site_id` (`site_id`),
  KEY `compte_id` (`compte_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `souscompte_id` (`souscompte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cptecritures`
--

DROP TABLE IF EXISTS `cptecritures`;
CREATE TABLE IF NOT EXISTS `cptecritures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dte` date NOT NULL,
  `dteaff` date DEFAULT NULL,
  `dtetime` datetime NOT NULL,
  `libelle` varchar(245) NOT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `beneficiaire` varchar(100) DEFAULT NULL,
  `journal_id` int(11) NOT NULL,
  `psedo` int(11) DEFAULT '0',
  `exercice_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `devise` varchar(10) DEFAULT NULL,
  `lettrer` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `journal_id` (`journal_id`),
  KEY `user_id` (`user_id`),
  KEY `site_id` (`site_id`),
  KEY `exercice_id` (`exercice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cptexercice`
--

DROP TABLE IF EXISTS `cptexercice`;
CREATE TABLE IF NOT EXISTS `cptexercice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib` varchar(50) DEFAULT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `psedo` int(11) DEFAULT '0',
  `config_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `resultat` int(11) DEFAULT '0',
  `existe` int(11) DEFAULT '0',
  `ecriture` int(11) DEFAULT '0',
  `cloture` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `config_id` (`config_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cptjournal`
--

DROP TABLE IF EXISTS `cptjournal`;
CREATE TABLE IF NOT EXISTS `cptjournal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `libelle` varchar(245) NOT NULL,
  `psedo` int(11) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptjournal`
--

INSERT INTO `cptjournal` (`id`, `code`, `libelle`, `psedo`, `site_id`, `syn`) VALUES
(1, 'HA', 'Achat', 0, NULL, 1),
(2, 'VT', 'Ventes', 0, NULL, 1),
(3, 'CA', 'Caisse', 0, NULL, 1),
(4, 'BQ', 'Banque', 0, NULL, 1),
(5, 'OD', 'Operations diverses', 0, NULL, 1),
(6, 'AN', 'A-Nouveaux', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cptjournalcompte`
--

DROP TABLE IF EXISTS `cptjournalcompte`;
CREATE TABLE IF NOT EXISTS `cptjournalcompte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compte_num` int(11) DEFAULT NULL,
  `journal_id` int(11) NOT NULL,
  `long_compte` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `compte_id` (`compte_num`,`journal_id`),
  KEY `journal_id` (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptjournalcompte`
--

INSERT INTO `cptjournalcompte` (`id`, `compte_num`, `journal_id`, `long_compte`, `syn`) VALUES
(16, 601, 1, 3, 1),
(17, 602, 1, 3, 1),
(18, 604, 1, 3, 1),
(19, 605, 1, 3, 1),
(20, 608, 1, 3, 1),
(23, 6011, 1, 4, 1),
(24, 6012, 1, 4, 1),
(25, 6013, 1, 4, 1),
(26, 6014, 1, 4, 1),
(27, 6015, 1, 4, 1),
(28, 6016, 1, 4, 1),
(29, 6017, 1, 4, 1),
(30, 6018, 1, 4, 1),
(31, 6019, 1, 4, 1),
(32, 6021, 1, 4, 1),
(33, 6022, 1, 4, 1),
(34, 6023, 1, 4, 1),
(35, 6024, 1, 4, 1),
(36, 6025, 1, 4, 1),
(37, 6026, 1, 4, 1),
(38, 6027, 1, 4, 1),
(39, 6028, 1, 4, 1),
(40, 6029, 1, 4, 1),
(41, 6041, 1, 4, 1),
(42, 6042, 1, 4, 1),
(43, 6043, 1, 4, 1),
(44, 6044, 1, 4, 1),
(45, 6045, 1, 4, 1),
(46, 6046, 1, 4, 1),
(47, 6047, 1, 4, 1),
(48, 6048, 1, 4, 1),
(49, 6049, 1, 4, 1),
(50, 6051, 1, 4, 1),
(51, 6052, 1, 4, 1),
(52, 6053, 1, 4, 1),
(53, 6054, 1, 4, 1),
(54, 6055, 1, 4, 1),
(55, 6056, 1, 4, 1),
(56, 6057, 1, 4, 1),
(57, 6058, 1, 4, 1),
(58, 6059, 1, 4, 1),
(59, 6081, 1, 4, 1),
(60, 6082, 1, 4, 1),
(61, 6083, 1, 4, 1),
(62, 6084, 1, 4, 1),
(63, 6085, 1, 4, 1),
(64, 6086, 1, 4, 1),
(65, 6087, 1, 4, 1),
(66, 6088, 1, 4, 1),
(67, 6089, 1, 4, 1),
(68, 6181, 1, 4, 1),
(69, 6182, 1, 4, 1),
(70, 6183, 1, 4, 1),
(71, 611, 1, 3, 1),
(72, 612, 1, 3, 1),
(73, 613, 1, 3, 1),
(74, 614, 1, 3, 1),
(75, 616, 1, 3, 1),
(76, 618, 1, 3, 1),
(77, 4452, 1, 4, 1),
(78, 4011, 1, 4, 1),
(79, 445, 1, 3, 1),
(80, 4451, 1, 4, 1),
(81, 4453, 1, 4, 1),
(82, 4454, 1, 4, 1),
(83, 4455, 1, 4, 1),
(84, 4456, 1, 4, 1),
(85, 40, 1, 2, 1),
(86, 401, 1, 3, 1),
(87, 4011, 1, 4, 1),
(88, 4012, 1, 4, 1),
(89, 4013, 1, 4, 1),
(90, 4016, 1, 4, 1),
(91, 4017, 1, 4, 1),
(92, 402, 1, 3, 1),
(93, 4021, 1, 4, 1),
(94, 4022, 1, 4, 1),
(95, 4023, 1, 4, 1),
(96, 404, 1, 3, 1),
(97, 4041, 1, 4, 1),
(98, 4042, 1, 4, 1),
(99, 4046, 1, 4, 1),
(100, 4047, 1, 4, 1),
(101, 408, 1, 3, 1),
(102, 4081, 1, 4, 1),
(103, 4082, 1, 4, 1),
(104, 4083, 1, 4, 1),
(105, 4086, 1, 4, 1),
(106, 409, 1, 3, 1),
(107, 4093, 1, 4, 1),
(108, 4094, 1, 4, 1),
(109, 4098, 1, 4, 1),
(153, 411, 2, 3, 1),
(154, 4111, 2, 4, 1),
(155, 4112, 2, 4, 1),
(156, 4114, 2, 4, 1),
(157, 4115, 2, 4, 1),
(158, 4116, 2, 4, 1),
(159, 4117, 2, 4, 1),
(160, 4118, 2, 4, 1),
(161, 412, 2, 3, 1),
(162, 4121, 2, 4, 1),
(163, 4122, 2, 4, 1),
(164, 4124, 2, 4, 1),
(165, 4125, 2, 4, 1),
(166, 413, 2, 3, 1),
(167, 4131, 2, 4, 1),
(168, 4132, 2, 4, 1),
(169, 4133, 2, 4, 1),
(170, 4138, 2, 4, 1),
(171, 414, 2, 3, 1),
(172, 4141, 2, 4, 1),
(173, 4142, 2, 4, 1),
(174, 4146, 2, 4, 1),
(175, 4147, 2, 4, 1),
(176, 415, 2, 3, 1),
(177, 416, 2, 3, 1),
(178, 4161, 2, 4, 1),
(179, 4162, 2, 4, 1),
(180, 418, 2, 3, 1),
(181, 4181, 2, 4, 1),
(182, 4186, 2, 4, 1),
(183, 419, 2, 3, 1),
(184, 4191, 2, 4, 1),
(185, 4192, 2, 4, 1),
(186, 4194, 2, 4, 1),
(187, 4198, 2, 4, 1),
(188, 443, 2, 3, 1),
(189, 4431, 2, 4, 1),
(190, 4432, 2, 4, 1),
(191, 4433, 2, 4, 1),
(192, 4334, 2, 4, 1),
(193, 4335, 2, 4, 1),
(194, 56, 4, 2, 1),
(195, 561, 4, 3, 1),
(196, 564, 4, 3, 1),
(197, 565, 4, 3, 1),
(198, 566, 4, 3, 1),
(199, 60, 1, 2, 1),
(200, 40, 1, 2, 1),
(201, 41, 2, 2, 1),
(202, 52, 4, 2, 1),
(203, 521, 4, 3, 1),
(204, 5211, 4, 4, 1),
(205, 5215, 4, 4, 1),
(206, 522, 4, 3, 1),
(207, 523, 4, 3, 1),
(208, 524, 4, 3, 1),
(209, 525, 4, 3, 1),
(210, 526, 4, 3, 1),
(211, 5261, 4, 4, 1),
(212, 5267, 4, 4, 1),
(213, 70, 2, 2, 1),
(214, 701, 2, 3, 1),
(215, 7011, 2, 4, 1),
(216, 7012, 2, 4, 1),
(217, 7013, 2, 4, 1),
(218, 7014, 2, 4, 1),
(219, 7015, 2, 4, 1),
(220, 7019, 2, 4, 1),
(221, 702, 2, 3, 1),
(222, 7021, 2, 4, 1),
(223, 7022, 2, 4, 1),
(224, 7023, 2, 4, 1),
(225, 7024, 2, 4, 1),
(226, 7025, 2, 4, 1),
(227, 7029, 2, 4, 1),
(228, 703, 2, 3, 1),
(229, 7031, 2, 4, 1),
(230, 7032, 2, 4, 1),
(231, 7033, 2, 4, 1),
(232, 7034, 2, 4, 1),
(233, 7035, 2, 4, 1),
(234, 7039, 2, 4, 1),
(235, 704, 2, 3, 1),
(236, 7041, 2, 4, 1),
(237, 7042, 2, 4, 1),
(238, 7043, 2, 4, 1),
(239, 7044, 2, 4, 1),
(240, 7045, 2, 4, 1),
(241, 7049, 2, 4, 1),
(242, 705, 2, 3, 1),
(243, 7051, 2, 4, 1),
(244, 7052, 2, 4, 1),
(245, 7053, 2, 4, 1),
(246, 7054, 2, 4, 1),
(247, 7055, 2, 4, 1),
(248, 7059, 2, 4, 1),
(249, 706, 2, 3, 1),
(250, 7061, 2, 4, 1),
(251, 7062, 2, 4, 1),
(252, 7063, 2, 4, 1),
(253, 7064, 2, 4, 1),
(254, 7065, 2, 4, 1),
(255, 7069, 2, 4, 1),
(256, 707, 2, 3, 1),
(257, 7071, 2, 4, 1),
(258, 7072, 2, 4, 1),
(259, 7073, 2, 4, 1),
(260, 7074, 2, 4, 1),
(261, 7075, 2, 4, 1),
(262, 7076, 2, 4, 1),
(263, 7077, 2, 4, 1),
(264, 7078, 2, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cptmodeles`
--

DROP TABLE IF EXISTS `cptmodeles`;
CREATE TABLE IF NOT EXISTS `cptmodeles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compte_id` varchar(200) DEFAULT '0',
  `saufbrut` varchar(200) DEFAULT '0',
  `partielbrut` varchar(200) DEFAULT NULL,
  `rubrique` varchar(200) DEFAULT NULL,
  `solde` int(11) NOT NULL DEFAULT '0' COMMENT '0 peu importe 1 debiteur 2 crediteur',
  `signevar` varchar(10) DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `amortprov` varchar(200) DEFAULT '0',
  `saufamort` varchar(200) DEFAULT NULL,
  `partielamort` varchar(200) DEFAULT NULL,
  `format` int(11) DEFAULT '3',
  `ref` varchar(10) DEFAULT NULL,
  `note` varchar(10) DEFAULT NULL,
  `signe` int(1) DEFAULT NULL COMMENT '-1=-;1=+;0=-/+',
  `typeligne` int(11) NOT NULL DEFAULT '0' COMMENT '-1=souscompte;0=compte;1=categorie;2=total',
  `ba` int(11) NOT NULL DEFAULT '0',
  `bp` int(11) NOT NULL DEFAULT '0',
  `r` int(11) NOT NULL DEFAULT '0' COMMENT '0=pas un compte resultat, 1=charge ,2 =produit',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptmodeles`
--

INSERT INTO `cptmodeles` (`id`, `compte_id`, `saufbrut`, `partielbrut`, `rubrique`, `solde`, `signevar`, `code`, `amortprov`, `saufamort`, `partielamort`, `format`, `ref`, `note`, `signe`, `typeligne`, `ba`, `bp`, `r`, `syn`) VALUES
(1, NULL, '0', NULL, '<b>IMMOBILISATIONS INCORPORELLES</b>', 0, NULL, '', '0', NULL, NULL, 3, 'AD', '3', 1, 1, 1, 0, 0, 1),
(2, '211,2181,2191', '0', NULL, 'Frais de d&eacute;veloppement et de prospection', 0, NULL, '', '2811,2818,2911,2918,2919', NULL, NULL, 3, 'AE', NULL, 1, 0, 1, 0, 0, 1),
(3, '212,213,214,2193', '0', NULL, 'Brevets,licences,logiciels et droits similaires', 0, NULL, '', '2812,2813,2814,2912,2913,2914,2919', NULL, NULL, 2, 'AF', NULL, 1, 0, 1, 0, 0, 1),
(4, '215,216', '0', NULL, 'Fonds commercial et droit au bail', 0, NULL, '', '2815,2816,2915,2916', NULL, NULL, 3, 'AG', NULL, 1, 0, 1, 0, 0, 1),
(5, '217,218,2198', '2181', NULL, 'Autres immobilisations incorporelles', 0, NULL, '', '2817,2818,2917,2918,2919', NULL, NULL, 3, 'AH', NULL, 1, 0, 1, 0, 0, 1),
(6, NULL, '0', NULL, '<b>IMMOBILISATIONS CORPORELLES</b>', 0, NULL, '', '0', NULL, NULL, 3, 'AJ', '3', 1, 1, 1, 0, 0, 1),
(7, '22', '0', NULL, 'Terrains(1)\r\n(1) dont placement en net\r\n......./........', 0, NULL, '', '282,292', NULL, NULL, 2, 'AJ', NULL, 1, 0, 1, 0, 0, 1),
(8, '231,232,233,237,2391', '0', NULL, 'B&acirc;timents(1)\r\n(1) dont placement en net\r\n......./........', 0, NULL, '', '2831,2832,2833,2837,2931,2932,2933,2937,2939', NULL, NULL, 2, 'AK', NULL, 1, 0, 1, 0, 0, 1),
(9, '234,235,238,2392,2393', '245,2451,2452,2453,2454,2455,2456,2457,2458,2495', NULL, 'Am&eacute;nagement,agencements et installations', 0, NULL, '', '2834,2835,2838,2934,2935,2938,2939', NULL, NULL, 3, 'AL', NULL, 1, 0, 1, 0, 0, 1),
(10, '24', '245,2495,2451,2452,2453,2454,2455,2456,2457,2458', '2949', 'Mat&eacute;riel,mobilier et actifs biologiques', 0, NULL, '', '284,294,2949', '2845,2945,2949', NULL, 3, 'AM', NULL, 1, 0, 1, 0, 0, 1),
(11, '245, 2495', '0', NULL, 'Mat&eacute;riel de transport', 0, NULL, '', '2845,2948,2949', NULL, NULL, 3, 'AN', NULL, 1, 0, 1, 0, 0, 1),
(12, '251,252', '0', NULL, 'Avances et acomptes vers&eacute;s sur immobilisations', 0, NULL, '', '2951,2952', NULL, NULL, 3, 'AP', '3', 1, 0, 1, 0, 0, 1),
(13, NULL, '0', NULL, '<b>IMMOBILISATIONS FINANCIERES</b>', 0, NULL, '', '0', NULL, NULL, 3, 'AQ', '4', 1, 1, 1, 0, 0, 1),
(14, '26', '0', NULL, 'Titres de participation', 0, NULL, '', '296', NULL, NULL, 3, 'AR', NULL, 1, 0, 1, 0, 0, 1),
(15, '27', '0', NULL, 'Autres immobilisations financi&egrave;res', 0, NULL, '', '297', NULL, NULL, 3, 'AS', NULL, 1, 0, 1, 0, 0, 1),
(16, NULL, '0', NULL, '<b>TOTAL ACTIF IMMOBILISE(I)</b>', 0, NULL, 'TAI', '0', NULL, NULL, 3, 'AZ', NULL, 1, 2, 1, 0, 0, 1),
(17, '485,488', '0', NULL, 'ACTIF CIRCULANT HAO', 0, NULL, '', '498', NULL, NULL, 3, 'BA', '5', 1, 0, 1, 0, 0, 1),
(18, '31,32,33,34,35,36,37,38', '0', NULL, 'STOCKS ET ENCOURS', 0, NULL, '', '39\r\n', NULL, NULL, 3, 'BB', '6', 1, 0, 1, 0, 0, 1),
(19, NULL, '0', NULL, 'CREANCES ET EMPLOIS ASSIMILES', 0, NULL, '', '0', NULL, NULL, 3, 'BG', NULL, 1, 0, 1, 0, 0, 1),
(20, '409', '0', NULL, 'Fournisseurs,avances vers&eacute;es', 0, NULL, '', '490', NULL, NULL, 2, 'BH', '17', 1, 0, 1, 0, 0, 1),
(21, '41', '419,4191,4192,4194,4198,4114', NULL, 'Clients', 0, NULL, '', '491', NULL, NULL, 3, 'BI', '7', 1, 0, 1, 0, 0, 1),
(22, '185,42,43,44,45,46,47 ', '478,4781,4782,4783,4784,4786,4788', NULL, 'Autres cr&eacute;ances', 1, NULL, '', '492,493,494,495,496,497', NULL, NULL, 3, 'BJ', '8', 1, 0, 1, 0, 0, 1),
(23, NULL, '0', NULL, '<b>TOTAL ACTIF CIRCULANT(II)</b>', 0, NULL, 'TAC', '0', NULL, NULL, 3, 'BK', '9', 1, 2, 1, 0, 0, 1),
(24, '50', '0', NULL, 'Titres de placement', 0, NULL, '', '590', NULL, NULL, 3, 'BQ', '9', 1, 0, 1, 0, 0, 1),
(25, '51', '0', NULL, 'Valeurs &agrave; encaisser', 0, NULL, '', '591', NULL, NULL, 3, 'BR', '10', 1, 0, 1, 0, 0, 1),
(26, '52,53,54,55,57,581,582,592,593,594', '0', NULL, 'Banques,Ch&egrave;ques postaux,Caisse et assimil&eacute;es', 1, NULL, '', '592,593,594', NULL, NULL, 3, 'BS', '11', 1, 0, 1, 0, 0, 1),
(27, '', '0', NULL, '<b>TOTAL TRESORERIE-ACTIF(III)</b>', 0, NULL, 'TTA', '0', NULL, NULL, 3, 'BT', NULL, 1, 2, 1, 0, 0, 1),
(28, '478', '0', NULL, 'Ecarts de conversion-Actif(IV)', 0, NULL, 'ECA', '0', NULL, NULL, 3, 'BU', '12', 1, 0, 1, 0, 0, 1),
(29, '', '0', NULL, '<b>TOTAL GENERAL (I+II+III+IV)</b>', 0, NULL, 'TG', '0', NULL, NULL, 3, 'BZ', NULL, 1, 2, 1, 0, 0, 1),
(30, '10', '105,1051,1052,1053,1054,1058,106,1061,1062,109', NULL, 'Capital', 0, NULL, '', '0', NULL, NULL, 3, 'CA', '13', 1, 1, 0, 1, 0, 1),
(31, '109', NULL, NULL, 'Apporteurs capital non appel&eacute; (-)', 0, NULL, '', '0', NULL, NULL, 3, 'CB', '13', 1, 0, 0, 1, 0, 1),
(32, '105', NULL, NULL, 'Primes li&eacute;es au capital social', 0, NULL, '', '0', NULL, NULL, 3, 'CD', '14', NULL, 0, 0, 1, 0, 1),
(33, '106', NULL, NULL, 'Ecarts de r&eacute;&eacute;valuation', 0, NULL, '', '0', NULL, NULL, 3, 'CE', NULL, 1, 0, 0, 1, 0, 1),
(34, '111,112,113', NULL, NULL, 'R&eacute;serves indisponibles', 0, NULL, '', '0', NULL, NULL, 3, 'CF', '14', 1, 0, 0, 1, 0, 1),
(35, '118', NULL, NULL, 'R&eacute;serves libres', 0, NULL, '', '0', NULL, NULL, 3, 'CG', '14', 1, 0, 0, 1, 0, 1),
(36, '121,129', NULL, NULL, 'Report &agrave; nouveau + ou -', 0, NULL, '', '0', NULL, NULL, 3, 'CH', '14', 1, 0, 0, 1, 0, 1),
(37, '131,139', NULL, NULL, 'R&eacute;sultat net de l\'exercice(b&eacute;n&eacute;fice + ou perte -)', 0, NULL, '', '0', NULL, NULL, 3, 'CI', NULL, 1, 1, 0, 1, 0, 1),
(38, '14', NULL, NULL, 'Subventions d\'investissement', 0, NULL, '', '0', NULL, NULL, 3, 'CL', '15', 1, 1, 0, 1, 0, 1),
(39, '15', NULL, NULL, 'Provisions reglement&eacute;es', 0, NULL, '', '0', NULL, NULL, 3, 'CM', '15', 1, 1, 0, 1, 0, 1),
(40, NULL, NULL, NULL, '<b>TOTAL CAPITAUX PROPRES ET RESSOURCES ASSIMILEES(I)</b>', 0, NULL, 'TCPRA', '0', NULL, NULL, 3, 'CP', NULL, 1, 2, 0, 1, 0, 1),
(65, '16,181,182,183,184', NULL, NULL, 'Emprunts et dettes financi&egrave;res diverses', 0, NULL, '', '0', NULL, NULL, 3, 'DA', '16', 1, 1, 0, 1, 0, 1),
(66, '17', NULL, NULL, 'Dettes de location acquisition', 0, NULL, '', '0', NULL, NULL, 3, 'DB', '16', 1, 1, 0, 1, 0, 1),
(67, '19', NULL, NULL, 'Provision pour risques et charges', 0, NULL, '', '0', NULL, NULL, 3, 'DC', '16', 1, 1, 0, 1, 0, 1),
(68, NULL, NULL, NULL, '<b>TOTAL DETTES FINANCIERES ET RESSOURCES ASSIMILEES</b>', 0, NULL, 'TDFRA', '0', NULL, NULL, 3, 'DD', NULL, 1, 0, 0, 1, 0, 1),
(69, NULL, NULL, NULL, '<b>TOTAL RESSOURCES STABLES(I)</b>', 0, NULL, '', '0', NULL, NULL, 3, 'DF', NULL, 1, 2, 0, 1, 0, 1),
(70, '481,482,484,4998', '409,4091,4092,4093,4094,4098', NULL, 'Dettes circulantes HAO', 0, NULL, '', '0', NULL, NULL, 3, 'DH', '5', 1, 0, 0, 1, 0, 1),
(71, '419,4114', NULL, NULL, 'Clients,avances re&ccedil;ues', 0, NULL, '', '0', NULL, NULL, 3, 'DI', '7', 1, 0, 0, 1, 0, 1),
(72, '40', '409,4091,4092,4093,4094,4098', NULL, 'Fournisseurs d\'exploitation', 0, NULL, '', '0', NULL, NULL, 3, 'DJ', '17', 1, 0, 0, 1, 0, 1),
(73, '42,43,44', NULL, NULL, 'Dettes fiscales et sociales', 2, NULL, '', '0', NULL, NULL, 3, 'DK', '18', 1, 0, 0, 1, 0, 1),
(74, '185,45,46,47', '479,4791,4792,4793,4794,4797,4798', NULL, 'Autres dettes', 2, NULL, '', '0', NULL, NULL, 3, 'DM', '19', 1, 0, 0, 1, 0, 1),
(75, '499,599', '4998', NULL, 'Provisions pour risques a court terme', 0, NULL, '', '0', NULL, NULL, 3, 'DN', '19', 1, 0, 0, 1, 0, 1),
(76, NULL, NULL, NULL, '<b>TOTAL PASSIF CIRCULANT (II)</b>', 0, NULL, 'TPC', '0', NULL, NULL, 3, 'DP', NULL, NULL, 2, 0, 1, 0, 1),
(83, '564,565', NULL, NULL, 'Banques,cr&eacute;dits d\'escompte', 0, NULL, '', '0', NULL, NULL, 3, 'DO', '20', 1, 0, 0, 1, 0, 1),
(84, '52,53,561,566', NULL, NULL, 'Banques,&eacute;tablissements financiers et cr&eacute;dits de tr&eacute;sorerie', 2, NULL, '', '0', NULL, NULL, 3, 'DR', '20', 1, 0, 0, 1, 0, 1),
(85, NULL, NULL, NULL, '<b>TOTAL TRESORERIE - PASSIF (III)</b>', 0, NULL, 'TTP', '0', NULL, NULL, 3, 'DT', NULL, 1, 2, 0, 1, 0, 1),
(86, '479', NULL, NULL, 'Ecarts de conversion - Passif (IV)', 0, NULL, 'ECP', '0', NULL, NULL, 3, 'DV', '12', NULL, 0, 0, 1, 0, 1),
(87, NULL, NULL, NULL, '<b>TOTAL GENERAL (I+II+III+IV)</b>', 0, NULL, 'TGP', '0', NULL, NULL, 3, 'DZ', NULL, 1, 2, 0, 1, 0, 1),
(88, '701', '0', NULL, 'Ventes de marchandises(A)                                                       ', 0, '+', 'TA', '0', NULL, NULL, 3, 'TA', '21', NULL, 0, 0, 0, 2, 1),
(89, '601', '0', NULL, 'Achats de marchandises', 0, '-', 'RA', '0', NULL, NULL, 3, 'RA', '22', NULL, 0, 0, 0, 1, 1),
(90, '6031', '0', NULL, 'Variation de stocks de marchandises', 0, '-/+', 'RB', '0', NULL, NULL, 3, 'RB', '6', NULL, 0, 0, 0, 1, 1),
(91, '', '0', NULL, 'MARGE COMMERCIALE (Somme TA à RB)', 0, NULL, 'XA', '0', NULL, NULL, 3, 'XA', NULL, NULL, 2, 0, 0, 1, 1),
(92, '702,703,704', '0', NULL, 'Ventes de produits fabriqués(B)', 0, '+', 'TB', '0', NULL, NULL, 3, 'TB', '21', NULL, 0, 0, 0, 2, 1),
(93, '705,706', '0', NULL, 'Travaux, services vendus(C)', 0, '+', 'TC', '0', NULL, NULL, 3, 'TC', '21', NULL, 0, 0, 0, 2, 1),
(94, '707', '0', NULL, 'Produits accessoires(D)', 0, '+', 'TD', '0', NULL, NULL, 3, 'TD', '21', NULL, 0, 0, 0, 2, 1),
(95, '', '0', NULL, 'CHIFFRE D\'AFFAIRES (A+B+C+D)', 0, NULL, 'XB', '0', NULL, NULL, 3, 'XB', NULL, NULL, 2, 0, 0, 1, 1),
(96, '73', '0', NULL, 'Production stockée (ou déstockage)', 0, '-/+', 'TE', '0', NULL, NULL, 3, 'TE', '6', NULL, 0, 0, 0, 2, 1),
(97, '72', '0', NULL, 'Production immobilisée', 0, NULL, 'TF', '0', NULL, NULL, 3, 'TF', '21', NULL, 0, 0, 0, 2, 1),
(98, '71', '0', NULL, 'Subventions d’exploitation', 0, NULL, 'TG', '0', NULL, NULL, 3, 'TG', '21', NULL, 0, 0, 0, 2, 1),
(99, '75', '0', NULL, 'Autres produits', 0, '+', 'TH', '0', NULL, NULL, 3, 'TH', '21', NULL, 0, 0, 0, 2, 1),
(100, '781', '0', NULL, 'Transferts de charges d\'exploitation', 0, '+', 'TI', '0', NULL, NULL, 3, 'TI', '12', NULL, 0, 0, 0, 1, 1),
(101, '602', '0', NULL, 'Achats de matières premières et fournitures liées', 0, '-', 'RC', '0', NULL, NULL, 3, 'RC', '22', NULL, 0, 0, 0, 1, 1),
(102, '6032', '0', NULL, 'Variation de stocks de matières premières et fournitures liées', 0, '-/+', 'RD', '0', NULL, NULL, 3, 'RD', '6', NULL, 0, 0, 0, 1, 1),
(103, '604,605,608', '0', NULL, 'Autres achats', 0, '-', 'RE', '0', NULL, NULL, 3, 'RE', '22', NULL, 0, 0, 0, 1, 1),
(104, '6033', '0', NULL, 'Variation de stocks d’autres approvisionnements', 0, '-/+', 'RF', '0', NULL, NULL, 3, 'RF', '6', NULL, 0, 0, 0, 1, 1),
(105, '61', '0', NULL, 'Transports', 0, '-', 'RG', '0', NULL, NULL, 3, 'RG', '23', NULL, 0, 0, 0, 1, 1),
(106, '62,63', '0', NULL, 'Services extérieurs', 0, '-', 'RH', '0', NULL, NULL, 3, 'RH', '24', NULL, 0, 0, 0, 1, 1),
(107, '64', '0', NULL, 'Impôts et taxes', 0, '-', 'RI', '0', NULL, NULL, 3, 'RI', '25', NULL, 0, 0, 0, 1, 1),
(108, '65', '0', NULL, 'Autres charges', 0, '-', 'RJ', '0', NULL, NULL, 3, 'RJ', '26', NULL, 0, 0, 0, 1, 1),
(109, '', '0', NULL, 'VALEUR AJOUTEE (XB+RA+RB)+ (somme TE à RJ)', 0, NULL, 'XC', '0', NULL, NULL, 3, 'XC', NULL, NULL, 2, 0, 0, 1, 1),
(110, '66', '0', NULL, 'Charges de personnel', 0, '-', 'RK', '0', NULL, NULL, 3, 'RK', '27', NULL, 0, 0, 0, 1, 1),
(111, '', '0', NULL, 'EXCEDENT BRUT D\'EXPLOITATION (XC+RK)', 0, NULL, 'XD', '0', NULL, NULL, 3, 'XD', '28', NULL, 2, 0, 0, 1, 1),
(112, '791,798,799', '0', NULL, 'Reprises d’amortissements, provisions et dépréciations', 0, '+', 'TJ', '0', NULL, NULL, 3, 'TJ', '28', NULL, 0, 0, 0, 2, 1),
(113, '681,691', '0', NULL, 'Dotations aux amortissements, aux provisions et dépréciations', 0, '-', 'RL', '0', NULL, NULL, 3, 'RL', '3c&28', NULL, 0, 0, 0, 1, 1),
(114, '', '0', NULL, 'RESULTAT D\'EXPLOITATION (XD+TJ+RL)', 0, NULL, 'XE', '0', NULL, NULL, 3, 'XE', NULL, NULL, 2, 0, 0, 1, 1),
(115, '77', '0', NULL, 'Revenus financiers et assimilés', 0, '+', 'TK', '0', NULL, NULL, 3, 'TK', '29', NULL, 0, 0, 0, 2, 1),
(116, '797', '0', NULL, 'Reprises de provisions et dépréciations financières', 0, '+', 'TL', '0', NULL, NULL, 3, 'TL', '28', NULL, 0, 0, 0, 2, 1),
(117, '787', '0', NULL, 'Transferts de charges financières', 0, '+', 'TM', '0', NULL, NULL, 3, 'TM', '12', NULL, 0, 0, 0, 2, 1),
(118, '67', '0', NULL, 'Frais financiers et charges assimilées', 0, '-', 'RM', '0', NULL, NULL, 3, 'RM', '29', NULL, 0, 0, 0, 1, 1),
(119, '697', '0', NULL, 'Dotations aux provisions et aux dépréciations financières', 0, '-', 'RN', '0', NULL, NULL, 3, 'RN', '3c&28', NULL, 0, 0, 0, 1, 1),
(120, '', '0', NULL, 'RESULTAT FINANCIER (Somme TK à RN)', 0, NULL, 'XF', '0', NULL, NULL, 3, 'XF', NULL, NULL, 2, 0, 0, 1, 1),
(121, '', '0', NULL, 'RESULTAT DES ACTIVITES ORDINAIRES (XE+XF)', 0, NULL, 'XG', '0', NULL, NULL, 3, 'XG', NULL, NULL, 2, 0, 0, 1, 1),
(122, '82', '0', NULL, 'Produits des cessions d\'immobilisations', 0, '+', 'TN', '0', NULL, NULL, 3, 'TN', '3D', NULL, 0, 0, 0, 2, 1),
(123, '84,86,88', '0', NULL, 'Autres Produits HAO', 0, '+', 'TO', '0', NULL, NULL, 3, 'TO', '30', NULL, 0, 0, 0, 2, 1),
(124, '81', '0', NULL, 'Valeurs comptables des cessions d\'immobilisations', 0, '-', 'RO', '0', NULL, NULL, 3, 'RO', '3D', NULL, 0, 0, 0, 1, 1),
(125, '83,85', '0', NULL, 'Autres Charges HAO', 0, NULL, 'RP', '0', NULL, NULL, 3, 'RP', '3D', NULL, 0, 0, 0, 1, 1),
(126, '', '0', NULL, 'RESULTAT HORS ACTIVITES ORDINAIRES (somme TN à RP)', 0, NULL, 'XH', '0', NULL, NULL, 3, 'XH', NULL, NULL, 2, 0, 0, 1, 1),
(127, '87', '0', NULL, 'Participation des travailleurs', 0, '-', 'RQ', '0', NULL, NULL, 3, 'RQ', '3D', NULL, 0, 0, 0, 1, 1),
(128, '89', '0', NULL, 'Impôts sur le résultat', 0, '-', 'RS', '0', NULL, NULL, 3, 'RS', '37', NULL, 0, 0, 0, 1, 1),
(129, '', '0', NULL, 'RESULTAT NET (XG+XH+RQ+RS)', 0, NULL, 'XI', '0', NULL, NULL, 3, 'XI', NULL, NULL, 2, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cptrapportjournal`
--

DROP TABLE IF EXISTS `cptrapportjournal`;
CREATE TABLE IF NOT EXISTS `cptrapportjournal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dte` date DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `compte` varchar(200) DEFAULT NULL,
  `description` text,
  `debit` int(11) DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `devise` varchar(20) DEFAULT NULL,
  `journal_id` int(11) DEFAULT NULL,
  `exercice_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `psedo` int(11) DEFAULT '0',
  `ecriture_id` int(11) DEFAULT NULL,
  `benprov` varchar(20) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_journal_id` (`journal_id`),
  KEY `exercice_id` (`exercice_id`),
  KEY `index_site_id` (`site_id`) USING BTREE,
  KEY `index_ecriture_id` (`ecriture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cptsouscomptes`
--

DROP TABLE IF EXISTS `cptsouscomptes`;
CREATE TABLE IF NOT EXISTS `cptsouscomptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `psedo` int(11) DEFAULT '0',
  `modif` int(11) NOT NULL DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `suffixe` varchar(100) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`compte_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=902 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptsouscomptes`
--

INSERT INTO `cptsouscomptes` (`id`, `libelle`, `numero`, `compte_id`, `psedo`, `modif`, `site_id`, `suffixe`, `syn`) VALUES
(4, 'Capital souscrit, non appelé', '1011', 11, 0, 0, NULL, NULL, 1),
(5, 'Capital souscrit, appelé, non versé', '1012', 11, 0, 0, NULL, NULL, 1),
(6, 'Capital souscrit, appelé, versé, non amorti', '1013', 11, 0, 0, NULL, NULL, 1),
(7, 'Capital souscrit, appelé, versé, amorti', '1014', 11, 0, 0, NULL, NULL, 1),
(8, 'Capital souscrit soumis à des conditions particulières', '1018', 11, 0, 0, NULL, NULL, 1),
(9, 'Dotation initiale', '1021', 12, 0, 0, NULL, NULL, 1),
(10, 'Dotations complémentaires', '1022', 12, 0, 0, NULL, NULL, 1),
(11, 'Autres dotations', '1028', 12, 0, 0, NULL, NULL, 1),
(12, 'Apports temporaires', '1041', 14, 0, 0, NULL, NULL, 1),
(13, 'Opérations courantes', '1042', 14, 0, 0, NULL, NULL, 1),
(14, 'Rémunérations, impôts et autres charges personnelles', '1043', 14, 0, 0, NULL, NULL, 1),
(15, 'Prélèvements d’autoconsommation', '1047', 14, 0, 0, NULL, NULL, 1),
(16, 'Autres prélèvements', '1048', 14, 0, 0, NULL, NULL, 1),
(17, 'Primes d\'émission', '1051', 15, 0, 0, NULL, NULL, 1),
(18, 'Primes d\'apport', '1052', 15, 0, 0, NULL, NULL, 1),
(19, 'Primes de fusion', '1053', 15, 0, 0, NULL, NULL, 1),
(20, 'Primes de conversion', '1054', 15, 0, 0, NULL, NULL, 1),
(21, 'Autres primes', '1058', 15, 0, 0, NULL, NULL, 1),
(22, 'Ecarts de réévaluation légale', '1061', 16, 0, 0, NULL, NULL, 1),
(23, 'Ecarts de réévaluation libre', '1062', 16, 0, 0, NULL, NULL, 1),
(24, 'Réserves de plus-values nettes à long terme', '1131', 20, 0, 0, NULL, NULL, 1),
(25, 'Réserves d’attribution gratuite d’actions au personnel salarié et aux dirigeants', '1132', 20, 0, 0, NULL, NULL, 1),
(26, 'Réserves consécutives à l\'octroi de subventions d\'investissement', '1133', 20, 0, 0, NULL, NULL, 1),
(27, 'Réserves des valeurs mobilières donnant accès au capital', '1134', 20, 0, 0, NULL, NULL, 1),
(28, 'Autres réserves réglementées', '1138', 20, 0, 0, NULL, NULL, 1),
(29, 'Réserves facultatives', '1181', 21, 0, 0, NULL, NULL, 1),
(30, 'Réserves diverses', '1188', 21, 0, 0, NULL, NULL, 1),
(31, 'Perte nette à reporter', '1291', 23, 0, 0, NULL, NULL, 1),
(32, 'Perte - Amortissements réputés différés', '1292', 23, 0, 0, NULL, NULL, 1),
(33, 'Résultat en instance d\'affectation : Bénéfice', '1301', 24, 0, 0, NULL, NULL, 1),
(34, 'Résultat en instance d\'affectation : Perte', '1309', 24, 0, 0, NULL, NULL, 1),
(35, 'Résultat de fusion', '1381', 32, 0, 0, NULL, NULL, 1),
(36, 'Résultat d\'apport partiel d\'actif', '1382', 32, 0, 0, NULL, NULL, 1),
(37, 'Résultat de scission', '1383', 32, 0, 0, NULL, NULL, 1),
(38, 'Résultat de liquidation', '1384', 32, 0, 0, NULL, NULL, 1),
(39, 'Etat', '1411', 34, 0, 0, NULL, NULL, 1),
(40, 'Régions', '1412', 34, 0, 0, NULL, NULL, 1),
(41, 'Départements', '1413', 34, 0, 0, NULL, NULL, 1),
(42, 'Communes et collectivités publiques décentralisées', '1414', 34, 0, 0, NULL, NULL, 1),
(43, 'Entités publiques ou mixtes', '1415', 34, 0, 0, NULL, NULL, 1),
(44, 'Entités et organismes privés', '1416', 34, 0, 0, NULL, NULL, 1),
(45, 'Organismes internationaux', '1417', 34, 0, 0, NULL, NULL, 1),
(46, 'Autres', '1418', 34, 0, 0, NULL, NULL, 1),
(47, 'Fonds National', '1531', 38, 0, 0, NULL, NULL, 1),
(48, 'Prélèvement pour le Budget', '1532', 38, 0, 0, NULL, NULL, 1),
(49, 'Reconstitution des gisements miniers et pétroliers', '1551', 40, 0, 0, NULL, NULL, 1),
(50, 'Hausse de prix', '1561', 41, 0, 0, NULL, NULL, 1),
(51, 'Fluctuation des cours', '1562', 41, 0, 0, NULL, NULL, 1),
(52, 'Emprunts obligataires ordinaires', '1611', 44, 0, 0, NULL, NULL, 1),
(53, 'Emprunts obligataires convertibles en actions', '1612', 44, 0, 0, NULL, NULL, 1),
(54, 'Emprunts obligataires remboursables en actions', '1613', 44, 0, 0, NULL, NULL, 1),
(55, 'Autres emprunts obligataires', '1618', 44, 0, 0, NULL, NULL, 1),
(56, 'Dépôts', '1651', 48, 0, 0, NULL, NULL, 1),
(57, 'Cautionnements', '1652', 48, 0, 0, NULL, NULL, 1),
(58, 'sur emprunts obligataires', '1661', 49, 0, 0, NULL, NULL, 1),
(59, 'sur emprunts et dettes auprès des établissements de crédit', '1662', 49, 0, 0, NULL, NULL, 1),
(60, 'sur avances reçues de l\'Etat', '1663', 49, 0, 0, NULL, NULL, 1),
(61, 'sur avances reçues et comptes courants bloqués', '1664', 49, 0, 0, NULL, NULL, 1),
(62, 'sur dépôts et cautionnements reçus', '1665', 49, 0, 0, NULL, NULL, 1),
(63, 'sur avances assorties de conditions particulières', '1667', 49, 0, 0, NULL, NULL, 1),
(64, 'sur autres emprunts et dettes', '1668', 49, 0, 0, NULL, NULL, 1),
(65, 'Avances bloquées pour augmentation du capital', '1671', 50, 0, 0, NULL, NULL, 1),
(66, 'Avances conditionnées par l\'Etat', '1672', 50, 0, 0, NULL, NULL, 1),
(67, 'Avances conditionnées par les autres organismes africains', '1673', 50, 0, 0, NULL, NULL, 1),
(68, 'Avances conditionnées par les organismes internationaux', '1674', 50, 0, 0, NULL, NULL, 1),
(69, 'Rentes viagères capitalisées', '1681', 51, 0, 0, NULL, NULL, 1),
(70, 'Billets de fonds', '1682', 51, 0, 0, NULL, NULL, 1),
(71, 'Dettes consécutives à des titres empruntés', '1683', 51, 0, 0, NULL, NULL, 1),
(72, 'Emprunts participatifs', '1684', 51, 0, 0, NULL, NULL, 1),
(73, 'Participation des travailleurs aux bénéfices', '1685', 51, 0, 0, NULL, NULL, 1),
(74, 'Emprunts et dettes contractés auprès des autres tiers', '1686', 51, 0, 0, NULL, NULL, 1),
(75, 'sur dettes de location-acquisition / crédit-bail immobilier', '1762', 55, 0, 0, NULL, NULL, 1),
(76, 'sur dettes  de  location-acquisition  / crédit-bail mobilier', '1763', 55, 0, 0, NULL, NULL, 1),
(77, 'sur dettes  de location-acquisition / location-vente', '1764', 55, 0, 0, NULL, NULL, 1),
(78, 'sur autres dettes  de location-acquisition', '1768', 55, 0, 0, NULL, NULL, 1),
(79, 'Dettes liées à des participations (groupe)', '1811', 63, 0, 0, NULL, NULL, 1),
(80, 'Dettes liées à des participations (hors groupe)', '1812', 63, 0, 0, NULL, NULL, 1),
(81, 'Provisions pour pensions et obligations similaires –engagement de retraite', '1961', 76, 0, 0, NULL, NULL, 1),
(82, 'Actif du régime de retraite', '1962', 76, 0, 0, NULL, NULL, 1),
(83, 'Provisions pour amendes et pénalités', '1981', 78, 0, 0, NULL, NULL, 1),
(84, 'Provisions de propre assureur', '1983', 78, 0, 0, NULL, NULL, 1),
(85, 'Provisions pour démantèlement et remise en état', '1984', 78, 0, 0, NULL, NULL, 1),
(86, 'Provisions pour droits à réduction ou avantage en nature  (Chèques cadeaux, cartes de fidélité…)', '1985', 78, 0, 0, NULL, NULL, 1),
(87, 'Provisions pour divers risques et charges ', '1988', 78, 0, 0, NULL, NULL, 1),
(88, 'Brevets', '2121', 80, 0, 0, NULL, NULL, 1),
(89, 'Licences', '2122', 80, 0, 0, NULL, NULL, 1),
(90, 'Concessions de service public', '2123', 80, 0, 0, NULL, NULL, 1),
(91, 'Autres concessions et droits similaires', '2128', 80, 0, 0, NULL, NULL, 1),
(92, 'Logiciels', '2131', 81, 0, 0, NULL, NULL, 1),
(93, 'Sites internet', '2132', 81, 0, 0, NULL, NULL, 1),
(94, 'Frais de prospection et d’évaluation de ressources minérales', '2181', 86, 0, 0, NULL, NULL, 1),
(95, 'Coûts d’obtention du contrat', '2182', 86, 0, 0, NULL, NULL, 1),
(96, 'Fichiers clients, notices, titres de journaux et magazines', '2183', 86, 0, 0, NULL, NULL, 1),
(97, 'Coûts des franchises', '2184', 86, 0, 0, NULL, NULL, 1),
(98, 'Divers droits et valeurs incorporels', '2188', 86, 0, 0, NULL, NULL, 1),
(99, 'Frais de développement ', '2191', 87, 0, 0, NULL, NULL, 1),
(100, 'Logiciels et sites internet ', '2193', 87, 0, 0, NULL, NULL, 1),
(101, 'Autres droits et valeurs incorporels', '2198', 87, 0, 0, NULL, NULL, 1),
(102, 'Terrains d\'exploitation agricole', '2211', 88, 0, 0, NULL, NULL, 1),
(103, 'Terrains d\'exploitation forestière', '2212', 88, 0, 0, NULL, NULL, 1),
(104, 'Autres terrains', '2218', 88, 0, 0, NULL, NULL, 1),
(105, 'Terrains à bâtir', '2221', 89, 0, 0, NULL, NULL, 1),
(106, 'Autres terrains nus', '2228', 89, 0, 0, NULL, NULL, 1),
(107, 'pour bâtiments industriels et agricoles', '2231', 90, 0, 0, NULL, NULL, 1),
(108, 'pour bâtiments administratifs et commerciaux', '2232', 90, 0, 0, NULL, NULL, 1),
(109, 'pour bâtiments affectés aux autres opérations professionnelles', '2234', 90, 0, 0, NULL, NULL, 1),
(110, 'pour bâtiments affectés aux autres opérations non professionnelles', '2235', 90, 0, 0, NULL, NULL, 1),
(111, 'Autres terrains bâtis', '2238', 90, 0, 0, NULL, NULL, 1),
(112, 'Plantation d\'arbres et d\'arbustes', '2241', 91, 0, 0, NULL, NULL, 1),
(113, 'Améliorations du fonds', '2245', 91, 0, 0, NULL, NULL, 1),
(114, 'Autres travaux', '2248', 91, 0, 0, NULL, NULL, 1),
(115, 'Carrières', '2251', 92, 0, 0, NULL, NULL, 1),
(116, 'Parkings', '2261', 93, 0, 0, NULL, NULL, 1),
(117, 'Terrains  - immeubles de placement ', '2281', 95, 0, 0, NULL, NULL, 1),
(118, 'Terrains des logements affectés au personnel', '2285', 95, 0, 0, NULL, NULL, 1),
(119, 'Terrains de location - acquisition', '2286', 95, 0, 0, NULL, NULL, 1),
(120, 'Divers terrains', '2288', 95, 0, 0, NULL, NULL, 1),
(121, 'Terrains agricoles et forestiers', '2291', 96, 0, 0, NULL, NULL, 1),
(122, 'Terrains nus', '2292', 96, 0, 0, NULL, NULL, 1),
(123, 'Terrains de  carrières - tréfonds ', '2295', 96, 0, 0, NULL, NULL, 1),
(124, 'Autres terrains', '2298', 96, 0, 0, NULL, NULL, 1),
(125, 'Bâtiments industriels', '2311', 97, 0, 0, NULL, NULL, 1),
(126, 'Bâtiments agricoles', '2312', 97, 0, 0, NULL, NULL, 1),
(127, 'Bâtiments administratifs et commerciaux', '2313', 97, 0, 0, NULL, NULL, 1),
(128, 'Bâtiments affectés au logement du personnel', '2314', 97, 0, 0, NULL, NULL, 1),
(129, 'Bâtiments - immeubles de placement ', '2315', 97, 0, 0, NULL, NULL, 1),
(130, 'Bâtiments de location - acquisition', '2316', 97, 0, 0, NULL, NULL, 1),
(131, 'Bâtiments industriels', '2321', 98, 0, 0, NULL, NULL, 1),
(132, 'Bâtiments agricoles', '2322', 98, 0, 0, NULL, NULL, 1),
(133, 'Bâtiments administratifs et commerciaux', '2323', 98, 0, 0, NULL, NULL, 1),
(134, 'Bâtiments affectés au logement du personnel', '2324', 98, 0, 0, NULL, NULL, 1),
(135, 'Bâtiments - immeubles de placement ', '2325', 98, 0, 0, NULL, NULL, 1),
(136, 'Bâtiments de location - acquisition', '2326', 98, 0, 0, NULL, NULL, 1),
(137, 'Voies de terre', '2331', 99, 0, 0, NULL, NULL, 1),
(138, 'Voies de fer', '2332', 99, 0, 0, NULL, NULL, 1),
(139, 'Voies d’eau', '2333', 99, 0, 0, NULL, NULL, 1),
(140, 'Barrages, Digues', '2334', 99, 0, 0, NULL, NULL, 1),
(141, 'Pistes d’aérodrome', '2335', 99, 0, 0, NULL, NULL, 1),
(142, 'Autres ouvrages d’infrastructures', '2338', 99, 0, 0, NULL, NULL, 1),
(143, 'Installations complexes spécialisées sur sol propre', '2341', 100, 0, 0, NULL, NULL, 1),
(144, 'Installations complexes spécialisées sur sol d’autrui', '2342', 100, 0, 0, NULL, NULL, 1),
(145, 'Installations à caractère spécifique sur sol propre', '2343', 100, 0, 0, NULL, NULL, 1),
(146, 'Installations à caractère spécifique sur sol d’autrui', '2344', 100, 0, 0, NULL, NULL, 1),
(147, 'Aménagements et agencements des bâtiments', '2345', 100, 0, 0, NULL, NULL, 1),
(148, 'Installations générales', '2351', 101, 0, 0, NULL, NULL, 1),
(149, 'Autres aménagements de bureaux', '2358', 101, 0, 0, NULL, NULL, 1),
(153, 'Bâtiments en cours', '2391', 104, 0, 0, NULL, NULL, 1),
(154, 'Installations en cours', '2392', 104, 0, 0, NULL, NULL, 1),
(155, 'Ouvrages d’infrastructure en cours', '2393', 104, 0, 0, NULL, NULL, 1),
(156, 'Aménagements, agencements et installations techniques  en cours', '2394', 104, 0, 0, NULL, NULL, 1),
(157, 'Aménagements de bureaux en cours', '2395', 104, 0, 0, NULL, NULL, 1),
(158, 'Autres installations et agencements en cours', '2398', 104, 0, 0, NULL, NULL, 1),
(159, 'Matériel industriel', '2411', 105, 0, 0, NULL, NULL, 1),
(160, 'Outillage industriel', '2412', 105, 0, 0, NULL, NULL, 1),
(161, 'Matériel commercial', '2413', 105, 0, 0, NULL, NULL, 1),
(162, 'Outillage commercial', '2414', 105, 0, 0, NULL, NULL, 1),
(163, 'Matériel et outillage industriel et commercial de location – acquisition', '2416', 105, 0, 0, NULL, NULL, 1),
(164, 'Matériel agricole', '2421', 106, 0, 0, NULL, NULL, 1),
(165, 'Outillage agricole', '2422', 106, 0, 0, NULL, NULL, 1),
(166, 'Matériel et outillage agricole de location – acquisition', '2426', 106, 0, 0, NULL, NULL, 1),
(167, 'Matériel de bureau', '2441', 108, 0, 0, NULL, NULL, 1),
(168, 'Matériel informatique', '2442', 108, 0, 0, NULL, NULL, 1),
(169, 'Matériel bureautique', '2443', 108, 0, 0, NULL, NULL, 1),
(170, 'Mobilier de bureau', '2444', 108, 0, 0, NULL, NULL, 1),
(171, 'Matériel et mobilier - immeubles de placement', '2445', 108, 0, 0, NULL, NULL, 1),
(172, 'Matériel et mobilier de location - acquisition', '2446', 108, 0, 0, NULL, NULL, 1),
(173, 'Matériel et mobilier des logements du personnel', '2447', 108, 0, 0, NULL, NULL, 1),
(174, 'Matériel automobile', '2451', 109, 0, 0, NULL, NULL, 1),
(175, 'Matériel ferroviaire', '2452', 109, 0, 0, NULL, NULL, 1),
(176, 'Matériel fluvial, lagunaire', '2453', 109, 0, 0, NULL, NULL, 1),
(177, 'Matériel naval', '2454', 109, 0, 0, NULL, NULL, 1),
(178, 'Matériel aérien', '2455', 109, 0, 0, NULL, NULL, 1),
(179, 'Matériel de transport de location - acquisition', '2456', 109, 0, 0, NULL, NULL, 1),
(180, 'Matériel hippomobile', '2457', 109, 0, 0, NULL, NULL, 1),
(181, 'Autres matériels de transport', '2458', 109, 0, 0, NULL, NULL, 1),
(182, 'Cheptel, animaux de trait', '2461', 110, 0, 0, NULL, NULL, 1),
(183, 'Cheptel, animaux reproducteurs', '2462', 110, 0, 0, NULL, NULL, 1),
(184, 'Animaux de garde', '2463', 110, 0, 0, NULL, NULL, 1),
(185, 'Plantations agricoles', '2465', 110, 0, 0, NULL, NULL, 1),
(186, 'Autres actifs biologiques', '2468', 110, 0, 0, NULL, NULL, 1),
(187, 'Agencements et aménagements du matériel', '2471', 111, 0, 0, NULL, NULL, 1),
(188, 'Agencements et aménagements des actifs biologiques', '2472', 111, 0, 0, NULL, NULL, 1),
(189, 'Autres agencements, aménagements du matériel et actifs biologiques', '2478', 111, 0, 0, NULL, NULL, 1),
(190, 'Collections et œuvres d’art', '2481', 112, 0, 0, NULL, NULL, 1),
(191, 'Divers matériels et mobiliers', '2488', 112, 0, 0, NULL, NULL, 1),
(192, 'Matériel et outillage industriel et commercial', '2491', 113, 0, 0, NULL, NULL, 1),
(193, 'Matériel et outillage agricole', '2492', 113, 0, 0, NULL, NULL, 1),
(194, 'Matériel d’emballage récupérable et identifiable', '2493', 113, 0, 0, NULL, NULL, 1),
(195, 'Matériel et mobilier de bureau', '2494', 113, 0, 0, NULL, NULL, 1),
(196, 'Matériel de transport', '2495', 113, 0, 0, NULL, NULL, 1),
(197, 'Actifs biologiques ', '2496', 113, 0, 0, NULL, NULL, 1),
(198, 'Agencements et aménagements du matériel et des actifs biologiques', '2496', 113, 0, 0, NULL, NULL, 1),
(199, 'Autres matériels et actifs biologiques ', '2498', 113, 0, 0, NULL, NULL, 1),
(200, 'Prêts participatifs', '2711', 122, 0, 0, NULL, NULL, 1),
(201, 'Prêts aux associés', '2712', 122, 0, 0, NULL, NULL, 1),
(202, 'Billets de fonds', '2713', 122, 0, 0, NULL, NULL, 1),
(203, 'Créances de location-financement', '2714', 122, 0, 0, NULL, NULL, 1),
(204, 'Titres prêtés', '2715', 122, 0, 0, NULL, NULL, 1),
(205, 'Autres prêts et créances', '2718', 122, 0, 0, NULL, NULL, 1),
(206, 'Prêts immobiliers', '2721', 123, 0, 0, NULL, NULL, 1),
(207, 'Prêts mobiliers et d’installation', '2722', 123, 0, 0, NULL, NULL, 1),
(208, 'Autres prêts au personnel', '2728', 123, 0, 0, NULL, NULL, 1),
(209, 'Retenues de garantie', '2731', 124, 0, 0, NULL, NULL, 1),
(210, 'Fonds réglementé', '2733', 124, 0, 0, NULL, NULL, 1),
(211, 'Créances sur le concédant', '2734', 124, 0, 0, NULL, NULL, 1),
(212, 'Autres créances sur l’Etat', '2738', 124, 0, 0, NULL, NULL, 1),
(213, 'Titres immobilisés de l’activité de portefeuille (T.I.A.P.)', '2741', 125, 0, 0, NULL, NULL, 1),
(214, 'Titres participatifs', '2742', 125, 0, 0, NULL, NULL, 1),
(215, 'Certificats d’investissement', '2743', 125, 0, 0, NULL, NULL, 1),
(216, 'Parts de fonds commun de placement (F.C.P.)', '2744', 125, 0, 0, NULL, NULL, 1),
(217, 'Obligations', '2745', 125, 0, 0, NULL, NULL, 1),
(218, 'Actions ou parts propres', '2746', 125, 0, 0, NULL, NULL, 1),
(219, 'Autres titres immobilisés', '2748', 125, 0, 0, NULL, NULL, 1),
(220, 'Dépôts pour loyers d’avance', '2751', 126, 0, 0, NULL, NULL, 1),
(221, 'Dépôts pour l’électricité', '2752', 126, 0, 0, NULL, NULL, 1),
(222, 'Dépôts pour l’eau', '2753', 126, 0, 0, NULL, NULL, 1),
(223, 'Dépôts pour le gaz', '2754', 126, 0, 0, NULL, NULL, 1),
(224, 'Dépôts pour le téléphone, le télex, la télécopie', '2755', 126, 0, 0, NULL, NULL, 1),
(225, 'Cautionnements sur marchés publics', '2756', 126, 0, 0, NULL, NULL, 1),
(226, 'Cautionnements sur autres opérations', '2757', 126, 0, 0, NULL, NULL, 1),
(227, 'Autres dépôts et cautionnements', '2758', 126, 0, 0, NULL, NULL, 1),
(228, 'Prêts et créances non commerciales', '2761', 127, 0, 0, NULL, NULL, 1),
(229, 'Prêts au personnel', '2762', 127, 0, 0, NULL, NULL, 1),
(230, 'Créances sur l\'Etat', '2763', 127, 0, 0, NULL, NULL, 1),
(231, 'Titres immobilisés', '2764', 127, 0, 0, NULL, NULL, 1),
(232, 'Dépôts et cautionnements versés', '2765', 127, 0, 0, NULL, NULL, 1),
(233, 'Créances de location-financement', '2766', 127, 0, 0, NULL, NULL, 1),
(234, 'Créances rattachées à des participations', '2767', 127, 0, 0, NULL, NULL, 1),
(235, 'Immobilisations financières diverses', '2768', 127, 0, 0, NULL, NULL, 1),
(236, 'Créances rattachées à des participations (groupe)', '2771', 128, 0, 0, NULL, NULL, 1),
(237, 'Créances rattachées à des participations (hors groupe)', '2772', 128, 0, 0, NULL, NULL, 1),
(238, 'Créances rattachées à des sociétés en participation', '2773', 128, 0, 0, NULL, NULL, 1),
(239, 'Avances à des Groupements d\'intérêt économique (G.I.E.)', '2774', 128, 0, 0, NULL, NULL, 1),
(240, 'Créances diverses groupe', '2781', 129, 0, 0, NULL, NULL, 1),
(241, 'Créances diverses hors groupe', '2782', 129, 0, 0, NULL, NULL, 1),
(242, 'Banques dépôts à terme', '2784', 129, 0, 0, NULL, NULL, 1),
(243, 'Or et métaux précieux (1)', '2785', 129, 0, 0, NULL, NULL, 1),
(244, 'Autres immobilisations financières', '2788', 129, 0, 0, NULL, NULL, 1),
(245, 'Amortissements des frais de développement', '2811', 130, 0, 0, NULL, NULL, 1),
(246, 'Amortissements des frais de développement', '2811', 130, 0, 0, NULL, NULL, 1),
(247, 'Amortissements des brevets, licences, concessions et droits similaires', '2812', 130, 0, 0, NULL, NULL, 1),
(248, 'Amortissements des brevets, licences, concessions et droits similaires', '2812', 130, 0, 0, NULL, NULL, 1),
(249, 'Amortissements des logiciels et sites internet', '2813', 130, 0, 0, NULL, NULL, 1),
(250, 'Amortissements des logiciels et sites internet', '2813', 130, 0, 0, NULL, NULL, 1),
(251, 'Amortissements des marques', '2814', 130, 0, 0, NULL, NULL, 1),
(252, 'Amortissements des marques', '2814', 130, 0, 0, NULL, NULL, 1),
(253, 'Amortissements du fonds commercial', '2815', 130, 0, 0, NULL, NULL, 1),
(254, 'Amortissements du fonds commercial', '2815', 130, 0, 0, NULL, NULL, 1),
(255, 'Amortissements du droit au bail', '2816', 130, 0, 0, NULL, NULL, 1),
(256, 'Amortissements du droit au bail', '2816', 130, 0, 0, NULL, NULL, 1),
(257, 'Amortissements des investissements de création', '2817', 130, 0, 0, NULL, NULL, 1),
(258, 'Amortissements des investissements de création', '2817', 130, 0, 0, NULL, NULL, 1),
(259, 'Amortissements des autres droits et valeurs incorporels', '2818', 130, 0, 0, NULL, NULL, 1),
(260, 'Amortissements des autres droits et valeurs incorporels', '2818', 130, 0, 0, NULL, NULL, 1),
(261, 'Amortissements des travaux de mise en valeur des terrains', '2824', 131, 0, 0, NULL, NULL, 1),
(262, 'Amortissements des bâtiments industriels, agricoles, administratifs et commerciaux sur sol propre', '2831', 132, 0, 0, NULL, NULL, 1),
(263, 'Amortissements des bâtiments industriels, agricoles, administratifs et commerciaux sur sol d\'autrui', '2832', 132, 0, 0, NULL, NULL, 1),
(264, 'Amortissements des ouvrages d\'infrastructure', '2833', 132, 0, 0, NULL, NULL, 1),
(265, 'Amortissements des aménagements, agencements et installations techniques', '2834', 132, 0, 0, NULL, NULL, 1),
(266, 'Amortissements des aménagements de bureaux', '2835', 132, 0, 0, NULL, NULL, 1),
(267, 'Amortissements des bâtiments industriels, agricoles et commerciaux mis en concession', '2837', 132, 0, 0, NULL, NULL, 1),
(268, 'Amortissements des autres installations et agencements', '2838', 132, 0, 0, NULL, NULL, 1),
(269, 'Amortissements du matériel et outillage industriel et commercial', '2841', 133, 0, 0, NULL, NULL, 1),
(270, 'Amortissements du matériel et outillage agricole', '2842', 133, 0, 0, NULL, NULL, 1),
(271, 'Amortissements du matériel d\'emballage récupérable et identifiable', '2843', 133, 0, 0, NULL, NULL, 1),
(272, 'Amortissements du matériel et mobilier ', '2844', 133, 0, 0, NULL, NULL, 1),
(273, 'Amortissements du matériel de transport', '2845', 133, 0, 0, NULL, NULL, 1),
(274, 'Amortissements des actifs biologiques ', '2846', 133, 0, 0, NULL, NULL, 1),
(275, 'Amortissements des agencements, aménagements du matériel et des actifs biologiques', '2847', 133, 0, 0, NULL, NULL, 1),
(276, 'Amortissements des autres matériels', '2848', 133, 0, 0, NULL, NULL, 1),
(277, 'Dépréciations des frais de développement', '2911', 134, 0, 0, NULL, NULL, 1),
(278, 'Dépréciations des brevets, licences, concessions  et droits similaires', '2912', 134, 0, 0, NULL, NULL, 1),
(279, 'Dépréciations des logiciels et sites internet', '2913', 134, 0, 0, NULL, NULL, 1),
(280, 'Dépréciations des marques', '2914', 134, 0, 0, NULL, NULL, 1),
(281, 'Dépréciations du fonds commercial', '2915', 134, 0, 0, NULL, NULL, 1),
(282, 'Dépréciations du droit au bail', '2916', 134, 0, 0, NULL, NULL, 1),
(283, 'Dépréciations des investissements de création', '2917', 134, 0, 0, NULL, NULL, 1),
(284, 'Dépréciations des autres droits et valeurs incorporels', '2918', 134, 0, 0, NULL, NULL, 1),
(285, 'Dépréciations des immobilisations incorporelles en cours', '2919', 134, 0, 0, NULL, NULL, 1),
(286, 'Dépréciations des terrains agricoles et forestiers', '2921', 135, 0, 0, NULL, NULL, 1),
(287, 'Dépréciations des terrains nus', '2922', 135, 0, 0, NULL, NULL, 1),
(288, 'Dépréciations des terrains bâtis', '2923', 135, 0, 0, NULL, NULL, 1),
(289, 'Dépréciations des travaux de mise en valeur des terrains', '2924', 135, 0, 0, NULL, NULL, 1),
(290, 'Dépréciations des terrains de gisement', '2925', 135, 0, 0, NULL, NULL, 1),
(291, 'Dépréciations des terrains aménagés', '2926', 135, 0, 0, NULL, NULL, 1),
(292, 'Dépréciations des terrains mis en concession', '2927', 135, 0, 0, NULL, NULL, 1),
(293, 'Dépréciations des autres terrains', '2928', 135, 0, 0, NULL, NULL, 1),
(294, 'Dépréciations des aménagements de terrains en cours', '2929', 135, 0, 0, NULL, NULL, 1),
(295, 'Dépréciations des bâtiments industriels, agricoles, administratifs et commerciaux sur sol propre', '2931', 136, 0, 0, NULL, NULL, 1),
(296, 'Dépréciations des bâtiments industriels, agricoles, administratifs et commerciaux sur sol d\'autrui', '2932', 136, 0, 0, NULL, NULL, 1),
(297, 'Dépréciations des ouvrages d\'infrastructures', '2933', 136, 0, 0, NULL, NULL, 1),
(298, 'Dépréciations des aménagements, agencements et installations techniques', '2934', 136, 0, 0, NULL, NULL, 1),
(299, 'Dépréciations des aménagements de bureaux', '2935', 136, 0, 0, NULL, NULL, 1),
(300, 'Dépréciations des bâtiments industriels, agricoles et commerciaux mis en concession', '2937', 136, 0, 0, NULL, NULL, 1),
(301, 'Dépréciations des autres installations et agencements', '2938', 136, 0, 0, NULL, NULL, 1),
(302, 'Dépréciations des bâtiments et installations en cours', '2939', 136, 0, 0, NULL, NULL, 1),
(303, 'Dépréciations du matériel et outillage industriel et commercial', '2941', 137, 0, 0, NULL, NULL, 1),
(304, 'Dépréciations du matériel et outillage agricole', '2942', 137, 0, 0, NULL, NULL, 1),
(305, 'Dépréciations du matériel d\'emballage récupérable et identifiable', '2943', 137, 0, 0, NULL, NULL, 1),
(306, 'Dépréciations du matériel et mobilier ', '2944', 137, 0, 0, NULL, NULL, 1),
(307, 'Dépréciations du matériel de transport', '2945', 137, 0, 0, NULL, NULL, 1),
(308, 'Dépréciations des actifs biologiques ', '2946', 137, 0, 0, NULL, NULL, 1),
(309, 'Dépréciations des agencements, aménagements du matériel et des actifs biologiques', '2947', 137, 0, 0, NULL, NULL, 1),
(310, 'Dépréciations des autres matériels', '2948', 137, 0, 0, NULL, NULL, 1),
(311, 'Dépréciations de matériel en cours', '2949', 137, 0, 0, NULL, NULL, 1),
(312, 'Dépréciations des avances et acomptes versés sur immobilisations incorporelles', '2951', 138, 0, 0, NULL, NULL, 1),
(313, 'Dépréciations des avances et acomptes versés sur immobilisations corporelles', '2952', 138, 0, 0, NULL, NULL, 1),
(314, 'Dépréciations des titres de participation dans des entités sous contrôle exclusif', '2961', 139, 0, 0, NULL, NULL, 1),
(315, 'Dépréciations des titres de participation dans des entités sous contrôle conjoint', '2962', 139, 0, 0, NULL, NULL, 1),
(316, 'Dépréciations des titres de participation dans des entités conférant une influence notable', '2963', 139, 0, 0, NULL, NULL, 1),
(317, 'Dépréciations des participations dans des organismes professionnels', '2965', 139, 0, 0, NULL, NULL, 1),
(318, 'Dépréciations des parts dans des GIE', '2966', 139, 0, 0, NULL, NULL, 1),
(319, 'Dépréciations des autres titres de participation', '2968', 139, 0, 0, NULL, NULL, 1),
(320, 'Dépréciations des prêts et créances ', '2971', 140, 0, 0, NULL, NULL, 1),
(321, 'Dépréciations des prêts au personnel', '2972', 140, 0, 0, NULL, NULL, 1),
(322, 'Dépréciations des créances sur l\'Etat', '2973', 140, 0, 0, NULL, NULL, 1),
(323, 'Dépréciations des titres immobilisés', '2974', 140, 0, 0, NULL, NULL, 1),
(324, 'Dépréciations des dépôts et cautionnements versés', '2975', 140, 0, 0, NULL, NULL, 1),
(325, 'Dépréciations des créances rattachées à des participations et avances à des GIE', '2977', 140, 0, 0, NULL, NULL, 1),
(326, 'Dépréciations des créances financières diverses', '2978', 140, 0, 0, NULL, NULL, 1),
(327, 'Marchandises A1', '3111', 141, 0, 0, NULL, NULL, 1),
(328, 'Marchandises A2', '3112', 141, 0, 0, NULL, NULL, 1),
(329, 'Marchandises B1', '3121', 142, 0, 0, NULL, NULL, 1),
(330, 'Marchandises B2', '3122', 142, 0, 0, NULL, NULL, 1),
(331, 'Animaux', '3131', 143, 0, 0, NULL, NULL, 1),
(332, 'Végétaux', '3132', 143, 0, 0, NULL, NULL, 1),
(333, 'Emballages perdus', '3351', 152, 0, 0, NULL, NULL, 1),
(334, 'Emballages récupérables non identifiables', '3352', 152, 0, 0, NULL, NULL, 1),
(335, 'Emballages à usage mixte', '3353', 152, 0, 0, NULL, NULL, 1),
(336, 'Autres emballages', '3358', 152, 0, 0, NULL, NULL, 1),
(337, 'Produits en cours P1', '3411', 154, 0, 0, NULL, NULL, 1),
(338, 'Produits en cours P2', '3412', 154, 0, 0, NULL, NULL, 1),
(339, 'Travaux en cours T1', '3421', 155, 0, 0, NULL, NULL, 1),
(340, 'Travaux en cours T2', '3422', 155, 0, 0, NULL, NULL, 1),
(341, 'Produits intermédiaires A', '3431', 156, 0, 0, NULL, NULL, 1),
(342, 'Produits intermédiaires B', '3432', 156, 0, 0, NULL, NULL, 1),
(343, 'Produits résiduels A', '3441', 157, 0, 0, NULL, NULL, 1),
(344, 'Produits résiduels B', '3442', 157, 0, 0, NULL, NULL, 1),
(345, 'Animaux', '3451', 158, 0, 0, NULL, NULL, 1),
(346, 'Végétaux', '3452', 158, 0, 0, NULL, NULL, 1),
(347, 'Etudes en cours E1', '3511', 159, 0, 0, NULL, NULL, 1),
(348, 'Etudes en cours E2', '3512', 159, 0, 0, NULL, NULL, 1),
(349, 'Prestations de services S1', '3521', 160, 0, 0, NULL, NULL, 1),
(350, 'Prestations de services S2', '3522', 160, 0, 0, NULL, NULL, 1),
(351, 'Animaux', '3631', 163, 0, 0, NULL, NULL, 1),
(352, 'Végétaux', '3632', 163, 0, 0, NULL, NULL, 1),
(353, 'Autres stocks (activités annexes)', '3638', 163, 0, 0, NULL, NULL, 1),
(354, 'Produits intermédiaires A', '3711', 164, 0, 0, NULL, NULL, 1),
(355, 'Produits intermédiaires B', '3712', 164, 0, 0, NULL, NULL, 1),
(356, 'Déchets', '3721', 165, 0, 0, NULL, NULL, 1),
(357, 'Rebuts', '3722', 165, 0, 0, NULL, NULL, 1),
(358, 'Matières de récupération', '3723', 165, 0, 0, NULL, NULL, 1),
(359, 'Animaux', '3731', 166, 0, 0, NULL, NULL, 1),
(360, 'Végétaux', '3732', 166, 0, 0, NULL, NULL, 1),
(361, 'Autres stocks (activités annexes)', '3738', 166, 0, 0, NULL, NULL, 1),
(362, 'Stock en consignation', '3871', 171, 0, 0, NULL, NULL, 1),
(363, 'Stock en dépôt', '3872', 171, 0, 0, NULL, NULL, 1),
(364, 'Fournisseurs', '4011', 279, 0, 0, NULL, NULL, 1),
(365, 'Fournisseurs Groupe', '4012', 279, 0, 0, NULL, NULL, 1),
(366, 'Fournisseurs sous-traitants', '4013', 279, 0, 0, NULL, NULL, 1),
(367, 'Fournisseurs, réserve de propriété', '4016', 279, 0, 0, NULL, NULL, 1),
(368, 'Fournisseurs, retenues de garantie', '4017', 279, 0, 0, NULL, NULL, 1),
(369, 'Fournisseurs, Effets à payer', '4021', 280, 0, 0, NULL, NULL, 1),
(370, 'Fournisseurs - Groupe, Effets à payer', '4022', 280, 0, 0, NULL, NULL, 1),
(371, 'Fournisseurs sous-traitants, Effets à payer', '4023', 280, 0, 0, NULL, NULL, 1),
(372, 'Fournisseurs dettes en compte, immobilisations incorporelles', '4041', 281, 0, 0, NULL, NULL, 1),
(373, 'Fournisseurs dettes en compte, immobilisations corporelles', '4042', 281, 0, 0, NULL, NULL, 1),
(374, 'Fournisseurs effets à payer, immobilisations incorporelles', '4046', 281, 0, 0, NULL, NULL, 1),
(375, 'Fournisseurs effets à payer, immobilisations corporelles', '4047', 281, 0, 0, NULL, NULL, 1),
(376, 'Fournisseurs ', '4081', 282, 0, 0, NULL, NULL, 1),
(377, 'Fournisseurs - Groupe', '4082', 282, 0, 0, NULL, NULL, 1),
(378, 'Fournisseurs sous-traitants', '4083', 282, 0, 0, NULL, NULL, 1),
(379, 'Fournisseurs, intérêts courus', '4086', 282, 0, 0, NULL, NULL, 1),
(380, 'Fournisseurs avances et acomptes versés', '4091', 283, 0, 0, NULL, NULL, 1),
(381, 'Fournisseurs - Groupe avances et acomptes versés ', '4092', 283, 0, 0, NULL, NULL, 1),
(382, 'Fournisseurs sous-traitants avances et acomptes versés ', '4093', 283, 0, 0, NULL, NULL, 1),
(383, 'Fournisseurs créances pour emballages et matériels à rendre', '4094', 283, 0, 0, NULL, NULL, 1),
(384, 'Fournisseurs, rabais, remises, ristournes et autres avoirs à obtenir', '4098', 283, 0, 0, NULL, NULL, 1),
(385, 'Clients', '4111', 284, 0, 0, NULL, NULL, 1),
(386, 'Clients - Groupe', '4112', 284, 0, 0, NULL, NULL, 1),
(387, 'Clients, Etat et Collectivités publiques', '4114', 284, 0, 0, NULL, NULL, 1),
(388, 'Clients, organismes internationaux', '4115', 284, 0, 0, NULL, NULL, 1),
(389, 'Clients, réserve de propriété', '4116', 284, 0, 0, NULL, NULL, 1),
(390, 'Clients, retenues de garantie', '4117', 284, 0, 0, NULL, NULL, 1),
(391, 'Clients, dégrèvement de Taxes sur la Valeur Ajoutée (T.V.A.)', '4118', 284, 0, 0, NULL, NULL, 1),
(392, 'Clients, Effets à recevoir', '4121', 285, 0, 0, NULL, NULL, 1),
(393, 'Clients - Groupe, Effets à recevoir', '4122', 285, 0, 0, NULL, NULL, 1),
(394, 'Etat et Collectivités publiques, Effets à recevoir', '4124', 285, 0, 0, NULL, NULL, 1),
(395, 'Organismes Internationaux, Effets à recevoir', '4125', 285, 0, 0, NULL, NULL, 1),
(396, 'Clients, chèques impayés', '4131', 286, 0, 0, NULL, NULL, 1),
(397, 'Clients, Effets impayés', '4132', 286, 0, 0, NULL, NULL, 1),
(398, 'Clients, cartes de crédit impayées', '4133', 286, 0, 0, NULL, NULL, 1),
(399, 'Clients, autres valeurs impayées', '4138', 286, 0, 0, NULL, NULL, 1),
(400, 'Créances en compte, immobilisations incorporelles', '4141', 287, 0, 0, NULL, NULL, 1),
(401, 'Créances en compte, immobilisations corporelles', '4142', 287, 0, 0, NULL, NULL, 1),
(402, 'Effets à recevoir, immobilisations incorporelles', '4146', 287, 0, 0, NULL, NULL, 1),
(403, 'Effets à recevoir, immobilisations corporelles', '4147', 287, 0, 0, NULL, NULL, 1),
(404, 'Créances litigieuses', '4161', 289, 0, 0, NULL, NULL, 1),
(405, 'Créances douteuses', '4162', 289, 0, 0, NULL, NULL, 1),
(406, 'Clients, factures à établir', '4181', 290, 0, 0, NULL, NULL, 1),
(407, 'Clients, intérêts courus', '4186', 290, 0, 0, NULL, NULL, 1),
(408, 'Clients, avances et acomptes reçus', '4191', 291, 0, 0, NULL, NULL, 1),
(409, 'Clients - Groupe, avances et acomptes reçus', '4192', 291, 0, 0, NULL, NULL, 1),
(410, 'Clients, dettes pour emballages et matériels consignés', '4194', 291, 0, 0, NULL, NULL, 1),
(411, 'Clients, rabais, remises, ristournes et autres avoirs à accorder', '4198', 291, 0, 0, NULL, NULL, 1),
(412, 'Personnel, avances ', '4211', 292, 0, 0, NULL, NULL, 1),
(413, 'Personnel, acomptes', '4212', 292, 0, 0, NULL, NULL, 1),
(414, 'Frais avancés et fournitures au personnel', '4213', 292, 0, 0, NULL, NULL, 1),
(415, 'Personnel, oppositions', '4231', 294, 0, 0, NULL, NULL, 1),
(416, 'Personnel, saisies-arrêts', '4232', 294, 0, 0, NULL, NULL, 1),
(417, 'Personnel, avis à tiers détenteur', '4233', 294, 0, 0, NULL, NULL, 1),
(418, 'Assistance médicale', '4241', 295, 0, 0, NULL, NULL, 1),
(419, 'Allocations familiales', '4242', 295, 0, 0, NULL, NULL, 1),
(420, 'Organismes sociaux rattachés à l\'entité', '4245', 295, 0, 0, NULL, NULL, 1),
(421, 'Autres oeuvres sociales internes', '4248', 295, 0, 0, NULL, NULL, 1),
(422, 'Délégués du personnel', '4251', 296, 0, 0, NULL, NULL, 1),
(423, 'Syndicats et Comités d\'entreprises, d\'Etablissement', '4252', 296, 0, 0, NULL, NULL, 1),
(424, 'Autres représentants du personnel', '4258', 296, 0, 0, NULL, NULL, 1),
(425, 'Participation aux bénéfices', '4261', 297, 0, 0, NULL, NULL, 1),
(426, 'Participation au capital', '4264', 297, 0, 0, NULL, NULL, 1),
(427, 'Dettes provisionnées pour congés à payer', '4281', 299, 0, 0, NULL, NULL, 1),
(428, 'Autres charges à payer', '4286', 299, 0, 0, NULL, NULL, 1),
(429, 'Produits à recevoir', '4287', 299, 0, 0, NULL, NULL, 1),
(430, 'Prestations familiales', '4311', 181, 0, 0, NULL, NULL, 1),
(431, 'Accidents de travail', '4312', 181, 0, 0, NULL, NULL, 1),
(432, 'Caisse de retraite obligatoire', '4313', 181, 0, 0, NULL, NULL, 1),
(433, 'Caisse de retraite facultative', '4314', 181, 0, 0, NULL, NULL, 1),
(434, 'Autres cotisations sociales', '4318', 181, 0, 0, NULL, NULL, 1),
(435, 'Mutuelle', '4331', 183, 0, 0, NULL, NULL, 1),
(436, 'Assurances Retraite', '4332', 183, 0, 0, NULL, NULL, 1),
(437, 'Assurances et organismes de santé', '4333', 183, 0, 0, NULL, NULL, 1),
(438, 'Charges sociales sur gratifications à payer', '4381', 184, 0, 0, NULL, NULL, 1),
(439, 'Charges sociales sur congés à payer', '4382', 184, 0, 0, NULL, NULL, 1),
(440, 'Autres charges à payer', '4386', 184, 0, 0, NULL, NULL, 1),
(441, 'Produits à recevoir', '4387', 184, 0, 0, NULL, NULL, 1),
(442, 'Impôts et taxes d\'Etat', '4421', 186, 0, 0, NULL, NULL, 1),
(443, 'Impôts et taxes pour les collectivités publiques', '4422', 186, 0, 0, NULL, NULL, 1),
(444, 'Impôts et taxes recouvrables sur des obligataires', '4423', 186, 0, 0, NULL, NULL, 1),
(445, 'Impôts et taxes recouvrables sur des associés', '4424', 186, 0, 0, NULL, NULL, 1),
(446, 'Droits de douane', '4426', 186, 0, 0, NULL, NULL, 1),
(447, 'Autres impôts et taxes', '4428', 186, 0, 0, NULL, NULL, 1),
(448, 'T.V.A. facturée sur ventes', '4431', 187, 0, 0, NULL, NULL, 1),
(449, 'T.V.A. facturée sur prestations de services', '4432', 187, 0, 0, NULL, NULL, 1),
(450, 'T.V.A. facturée sur travaux', '4433', 187, 0, 0, NULL, NULL, 1),
(451, 'T.V.A. facturée sur production livrée à soi-même', '4434', 187, 0, 0, NULL, NULL, 1),
(452, 'T.V.A. sur factures à établir', '4435', 187, 0, 0, NULL, NULL, 1),
(453, 'Etat, T.V.A. due', '4441', 188, 0, 0, NULL, NULL, 1),
(454, 'Etat, dégrèvement T.V.A.', '4445', 188, 0, 0, NULL, NULL, 1),
(455, 'Etat, crédit de T.V.A. à reporter', '4449', 188, 0, 0, NULL, NULL, 1),
(456, 'T.V.A. récupérable sur immobilisations', '4451', 189, 0, 0, NULL, NULL, 1),
(457, 'T.V.A. récupérable sur achats', '4452', 189, 0, 0, NULL, NULL, 1),
(458, 'T.V.A. récupérable sur transport', '4453', 189, 0, 0, NULL, NULL, 1),
(459, 'T.V.A. récupérable sur services extérieurs et autres charges', '4454', 189, 0, 0, NULL, NULL, 1),
(460, 'T.V.A. récupérable sur factures non parvenues', '4455', 189, 0, 0, NULL, NULL, 1),
(461, 'T.V.A. transférée par d\'autres entités', '4456', 189, 0, 0, NULL, NULL, 1),
(462, 'Impôt Général sur le revenu', '4471', 191, 0, 0, NULL, NULL, 1),
(463, 'Impôts sur salaires', '4472', 191, 0, 0, NULL, NULL, 1),
(464, 'Contribution nationale', '4473', 191, 0, 0, NULL, NULL, 1),
(465, 'Contribution nationale de solidarité', '4474', 191, 0, 0, NULL, NULL, 1),
(466, 'Autres impôts et contributions', '4478', 191, 0, 0, NULL, NULL, 1),
(467, 'Charges à payer', '4486', 192, 0, 0, NULL, NULL, 1),
(468, 'Produits à recevoir', '4487', 192, 0, 0, NULL, NULL, 1),
(469, 'Etat, obligations cautionnées', '4491', 193, 0, 0, NULL, NULL, 1),
(470, 'Etat, avances et acomptes versés sur impôts', '4492', 193, 0, 0, NULL, NULL, 1),
(471, 'Etat, fonds de dotation à recevoir', '4493', 193, 0, 0, NULL, NULL, 1),
(472, 'Etat, subventions d\'investissement à recevoir', '4494', 193, 0, 0, NULL, NULL, 1),
(473, 'Etat, subventions d\'exploitation à recevoir', '4495', 193, 0, 0, NULL, NULL, 1),
(474, 'Etat, subventions d\'équilibre à recevoir', '4496', 193, 0, 0, NULL, NULL, 1),
(475, 'Etat, avances sur subventions ', '4497', 193, 0, 0, NULL, NULL, 1),
(476, 'Etat, fonds réglementé provisionné', '4499', 193, 0, 0, NULL, NULL, 1),
(477, 'Organismes internationaux, fonds de dotation à recevoir', '4581', 196, 0, 0, NULL, NULL, 1),
(478, 'Organismes internationaux, subventions à recevoir', '4582', 196, 0, 0, NULL, NULL, 1),
(479, 'Apporteurs, apports en nature', '4611', 197, 0, 0, NULL, NULL, 1),
(480, 'Apporteurs, apports en numéraire', '4612', 197, 0, 0, NULL, NULL, 1),
(481, 'Apporteurs, capital appelé, non versé', '4613', 197, 0, 0, NULL, NULL, 1),
(482, 'Apporteurs, compte d’apport, opérations de restructuration (fusion…)', '4614', 197, 0, 0, NULL, NULL, 1),
(483, 'Apporteurs, versements reçus sur augmentation de capital', '4615', 197, 0, 0, NULL, NULL, 1),
(484, 'Apporteurs, versements anticipés', '4616', 197, 0, 0, NULL, NULL, 1),
(485, 'Apporteurs défaillants', '4617', 197, 0, 0, NULL, NULL, 1),
(486, 'Apporteurs, titres à échanger', '4618', 197, 0, 0, NULL, NULL, 1),
(487, 'Apporteurs, capital à rembourser ', '4619', 197, 0, 0, NULL, NULL, 1),
(488, 'Principal', '4621', 198, 0, 0, NULL, NULL, 1),
(489, 'Intérêts courus', '4626', 198, 0, 0, NULL, NULL, 1),
(490, 'Opérations courantes', '4631', 199, 0, 0, NULL, NULL, 1),
(491, 'Intérêts courus', '4636', 199, 0, 0, NULL, NULL, 1),
(492, 'Débiteurs divers', '4711', 204, 0, 0, NULL, NULL, 1),
(493, 'Créditeurs divers', '4712', 204, 0, 0, NULL, NULL, 1),
(494, 'Obligataires ', '4713', 204, 0, 0, NULL, NULL, 1),
(495, 'Rémunérations d’administrateurs non associés', '4715', 204, 0, 0, NULL, NULL, 1),
(496, 'Compte d’affacturage et de titrisation', '4716', 204, 0, 0, NULL, NULL, 1),
(497, 'Débiteurs divers - retenues de garantie', '4717', 204, 0, 0, NULL, NULL, 1),
(498, 'Apport, compte de fusion et opérations assimilées', '4718', 204, 0, 0, NULL, NULL, 1),
(499, 'Bons de souscription d’actions et d’obligations', '4719', 204, 0, 0, NULL, NULL, 1),
(500, 'Créances sur cessions de titres de placement', '4721', 205, 0, 0, NULL, NULL, 1),
(501, 'Versements restant à effectuer sur titres de placement non libérés', '4726', 205, 0, 0, NULL, NULL, 1),
(502, 'Mandants', '4731', 206, 0, 0, NULL, NULL, 1),
(503, 'Mandataires', '4732', 206, 0, 0, NULL, NULL, 1),
(504, 'Commettants', '4733', 206, 0, 0, NULL, NULL, 1),
(505, 'Commissionnaires', '4734', 206, 0, 0, NULL, NULL, 1),
(506, 'Etat, Collectivités publiques, fonds global d’allocation', '4739', 206, 0, 0, NULL, NULL, 1),
(507, 'Compte de répartition périodique des charges', '4746', 207, 0, 0, NULL, NULL, 1),
(508, 'Compte de répartition périodique des produits', '4747', 207, 0, 0, NULL, NULL, 1),
(509, 'Compte-actif ', '4751', 208, 0, 0, NULL, NULL, 1),
(510, 'Compte-passif ', '4752', 208, 0, 0, NULL, NULL, 1),
(511, 'Diminution des créances d’exploitation et HAO', '4781', 211, 0, 0, NULL, NULL, 1),
(512, 'Diminution des créances financières', '4782', 211, 0, 0, NULL, NULL, 1),
(513, 'Augmentation des dettes d’exploitation et HAO', '4783', 211, 0, 0, NULL, NULL, 1),
(514, 'Augmentation des dettes financières', '4784', 211, 0, 0, NULL, NULL, 1),
(515, 'Différences d’évaluation sur instruments de trésorerie', '4786', 211, 0, 0, NULL, NULL, 1),
(516, 'Différences compensées par couverture de change', '4788', 211, 0, 0, NULL, NULL, 1),
(517, 'Augmentation des créances d’exploitation et HAO', '4791', 212, 0, 0, NULL, NULL, 1),
(518, 'Augmentation des créances financières', '4792', 212, 0, 0, NULL, NULL, 1),
(519, 'Diminution des dettes d’exploitation et HAO', '4793', 212, 0, 0, NULL, NULL, 1),
(520, 'Diminution des dettes financières', '4794', 212, 0, 0, NULL, NULL, 1),
(521, 'Différences d’évaluation sur instruments de trésorerie', '4797', 212, 0, 0, NULL, NULL, 1),
(522, 'Différences compensées par couverture de change', '4798', 212, 0, 0, NULL, NULL, 1),
(523, 'Immobilisations incorporelles', '4811', 213, 0, 0, NULL, NULL, 1),
(524, 'Immobilisations corporelles', '4812', 213, 0, 0, NULL, NULL, 1),
(525, 'Versements restant à effectuer sur titres de participation et titres immobilisés non libérés ', '4813', 213, 0, 0, NULL, NULL, 1),
(526, 'Réserve de propriété (3)', '4816', 213, 0, 0, NULL, NULL, 1),
(527, 'Retenues de garantie  (3)', '4817', 213, 0, 0, NULL, NULL, 1),
(528, 'Factures non parvenues (3)', '4818', 213, 0, 0, NULL, NULL, 1),
(529, 'Immobilisations incorporelles', '4821', 214, 0, 0, NULL, NULL, 1),
(530, 'Immobilisations corporelles', '4822', 214, 0, 0, NULL, NULL, 1),
(531, 'En compte, immobilisations incorporelles', '4851', 216, 0, 0, NULL, NULL, 1),
(532, 'En compte, immobilisations corporelles', '4852', 216, 0, 0, NULL, NULL, 1),
(533, 'Effets à recevoir, immobilisations incorporelles', '4853', 216, 0, 0, NULL, NULL, 1),
(534, 'Effets à recevoir, immobilisations corporelles', '4854', 216, 0, 0, NULL, NULL, 1),
(535, 'Effets escomptés non échus', '4855', 216, 0, 0, NULL, NULL, 1),
(536, 'Immobilisations financières', '4856', 216, 0, 0, NULL, NULL, 1),
(537, 'Retenues de garantie ', '4857', 216, 0, 0, NULL, NULL, 1),
(538, 'Factures à établir', '4858', 216, 0, 0, NULL, NULL, 1),
(539, 'Créances litigieuses', '4911', 219, 0, 0, NULL, NULL, 1),
(540, 'Créances douteuses', '4912', 219, 0, 0, NULL, NULL, 1),
(541, 'Associés, comptes courants', '4962', 224, 0, 0, NULL, NULL, 1),
(542, 'Associés, opérations faites en commun et GIE', '4963', 224, 0, 0, NULL, NULL, 1),
(543, 'Groupe, comptes courants', '4966', 224, 0, 0, NULL, NULL, 1),
(544, 'Créances sur cessions d\'immobilisations ', '4985', 226, 0, 0, NULL, NULL, 1),
(545, 'Créances sur cessions de titres de placement', '4986', 226, 0, 0, NULL, NULL, 1),
(546, 'Autres créances H.A.O.', '4988', 226, 0, 0, NULL, NULL, 1),
(547, 'Sur opérations d\'exploitation', '4991', 227, 0, 0, NULL, NULL, 1),
(548, 'Sur opérations H.A.O.', '4998', 227, 0, 0, NULL, NULL, 1),
(549, 'Titres du Trésor à court terme', '5011', 228, 0, 0, NULL, NULL, 1),
(550, 'Titres d\'organismes financiers', '5012', 228, 0, 0, NULL, NULL, 1),
(551, 'Bons de caisse à court terme', '5013', 228, 0, 0, NULL, NULL, 1),
(552, 'Frais d’acquisition des titres de Trésor et bons de caisse', '5016', 228, 0, 0, NULL, NULL, 1),
(553, 'Actions ou parts propres', '5021', 229, 0, 0, NULL, NULL, 1),
(554, 'Actions cotées', '5022', 229, 0, 0, NULL, NULL, 1),
(555, 'Actions non cotées', '5023', 229, 0, 0, NULL, NULL, 1),
(556, 'Actions démembrées (certificats d\'investissement ; droits de vote)', '5024', 229, 0, 0, NULL, NULL, 1),
(557, 'Autres actions', '5025', 229, 0, 0, NULL, NULL, 1),
(558, 'Frais d’acquisition des actions', '5026', 229, 0, 0, NULL, NULL, 1),
(559, 'Obligations émises par l\'entité et rachetées par elle', '5031', 230, 0, 0, NULL, NULL, 1),
(560, 'Obligations cotées', '5032', 230, 0, 0, NULL, NULL, 1),
(561, 'Obligations non cotées', '5033', 230, 0, 0, NULL, NULL, 1),
(562, 'Autres obligations', '5035', 230, 0, 0, NULL, NULL, 1),
(563, 'Frais d’acquisition des obligations', '5036', 230, 0, 0, NULL, NULL, 1),
(564, 'Bons de souscription d\'actions', '5042', 231, 0, 0, NULL, NULL, 1),
(565, 'Bons de souscription d\'obligations', '5043', 231, 0, 0, NULL, NULL, 1),
(566, 'Titres du Trésor et bons de caisse à court terme', '5061', 233, 0, 0, NULL, NULL, 1),
(567, 'Actions', '5062', 233, 0, 0, NULL, NULL, 1),
(568, 'Obligations', '5063', 233, 0, 0, NULL, NULL, 1),
(569, 'Banques en monnaie nationale', '5211', 241, 0, 0, NULL, NULL, 1),
(570, 'Banques en devises', '5215', 241, 0, 0, NULL, NULL, 1),
(571, 'Banque, intérêts courus charges à payer', '5261', 246, 0, 0, NULL, NULL, 1),
(572, 'Banque, intérêts courus produits à recevoir', '5267', 246, 0, 0, NULL, NULL, 1),
(573, 'Caisse en monnaie nationale', '5711', 266, 0, 0, NULL, NULL, 1),
(574, 'Caisse en devises', '5712', 266, 0, 0, NULL, NULL, 1),
(575, 'en monnaie nationale', '5721', 267, 0, 0, NULL, NULL, 1),
(576, 'en devises', '5722', 267, 0, 0, NULL, NULL, 1),
(577, 'en monnaie nationale', '5731', 268, 0, 0, NULL, NULL, 1),
(578, 'en devises', '5732', 268, 0, 0, NULL, NULL, 1),
(579, 'dans la Région (5)', '6011', 300, 0, 0, NULL, NULL, 1),
(580, 'hors Région (5)', '6012', 300, 0, 0, NULL, NULL, 1),
(581, 'aux entités du groupe dans la Région', '6013', 300, 0, 0, NULL, NULL, 1),
(582, 'aux entités du groupe hors Région', '6014', 300, 0, 0, NULL, NULL, 1),
(583, 'frais sur achats (6)', '6015', 300, 0, 0, NULL, NULL, 1),
(584, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6019', 300, 0, 0, NULL, NULL, 1),
(585, 'dans la Région (5)', '6021', 301, 0, 0, NULL, NULL, 1),
(586, 'hors Région (5)', '6022', 301, 0, 0, NULL, NULL, 1),
(587, 'aux entités du groupe dans la Région', '6023', 301, 0, 0, NULL, NULL, 1),
(588, 'aux entités du groupe hors Région', '6024', 301, 0, 0, NULL, NULL, 1),
(589, 'frais sur achats (6)', '6025', 301, 0, 0, NULL, NULL, 1),
(590, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6029', 301, 0, 0, NULL, NULL, 1),
(591, 'Variations des stocks de marchandises', '6031', 302, 0, 0, NULL, NULL, 1),
(592, 'Variations des stocks de matières premières et fournitures liées', '6032', 302, 0, 0, NULL, NULL, 1),
(593, 'Variations des stocks d\'autres approvisionnements', '6033', 302, 0, 0, NULL, NULL, 1),
(594, 'Matières consommables ', '6041', 303, 0, 0, NULL, NULL, 1),
(595, 'Matières consommables ', '6042', 303, 0, 0, NULL, NULL, 1),
(596, 'Produits d\'entretien', '6043', 303, 0, 0, NULL, NULL, 1),
(597, 'Fournitures d\'atelier et d\'usine', '6044', 303, 0, 0, NULL, NULL, 1),
(598, 'frais sur achats (6)', '6045', 303, 0, 0, NULL, NULL, 1),
(599, 'Fournitures de magasin', '6046', 303, 0, 0, NULL, NULL, 1),
(600, 'Fournitures de bureau', '6047', 303, 0, 0, NULL, NULL, 1),
(601, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6049', 303, 0, 0, NULL, NULL, 1),
(602, 'Fournitures non stockables -Eau', '6051', 304, 0, 0, NULL, NULL, 1),
(603, 'Fournitures non stockables - Electricité', '6052', 304, 0, 0, NULL, NULL, 1),
(604, 'Fournitures non stockables – Autres énergies', '6053', 304, 0, 0, NULL, NULL, 1),
(605, 'Fournitures d\'entretien non stockables', '6054', 304, 0, 0, NULL, NULL, 1),
(606, 'Fournitures de bureau non stockables', '6055', 304, 0, 0, NULL, NULL, 1),
(607, 'Achats de petit matériel et outillage', '6056', 304, 0, 0, NULL, NULL, 1),
(608, 'Achats d\'études et prestations de services', '6057', 304, 0, 0, NULL, NULL, 1),
(609, 'Achats de travaux, matériels et équipements', '6058', 304, 0, 0, NULL, NULL, 1),
(610, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6059', 304, 0, 0, NULL, NULL, 1),
(611, 'Emballages perdus', '6081', 305, 0, 0, NULL, NULL, 1),
(612, 'Emballages récupérables non identifiables', '6082', 305, 0, 0, NULL, NULL, 1),
(613, 'Emballages à usage mixte', '6083', 305, 0, 0, NULL, NULL, 1),
(614, 'frais sur achats (6)', '6085', 305, 0, 0, NULL, NULL, 1),
(615, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6089', 305, 0, 0, NULL, NULL, 1),
(616, 'Voyages et déplacements', '6181', 310, 0, 0, NULL, NULL, 1),
(617, 'Transports entre établissements ou chantiers', '6182', 310, 0, 0, NULL, NULL, 1),
(618, 'Transports administratifs', '6183', 310, 0, 0, NULL, NULL, 1),
(619, 'Locations de terrains', '6221', 312, 0, 0, NULL, NULL, 1),
(620, 'Locations de bâtiments', '6222', 312, 0, 0, NULL, NULL, 1),
(621, 'ocations de matériels et outillages', '6223', 312, 0, 0, NULL, NULL, 1),
(622, 'Malis sur emballages', '6224', 312, 0, 0, NULL, NULL, 1),
(623, 'Locations d\'emballages ', '6225', 312, 0, 0, NULL, NULL, 1),
(624, 'Fermages et loyers du foncier', '6226', 312, 0, 0, NULL, NULL, 1),
(625, 'Locations et charges locatives diverses', '6228', 312, 0, 0, NULL, NULL, 1),
(626, 'Crédit-bail immobilier', '6232', 313, 0, 0, NULL, NULL, 1),
(627, 'Crédit-bail mobilier', '6233', 313, 0, 0, NULL, NULL, 1),
(628, 'Location-vente', '6234', 313, 0, 0, NULL, NULL, 1),
(629, 'Autres contrats de location-acquisition ', '6238', 313, 0, 0, NULL, NULL, 1),
(630, 'Entretien et réparations des biens immobiliers', '6241', 314, 0, 0, NULL, NULL, 1),
(631, 'Entretien et réparations des biens mobiliers', '6242', 314, 0, 0, NULL, NULL, 1),
(632, 'Maintenance', '6243', 314, 0, 0, NULL, NULL, 1),
(633, 'Charges de démantèlement et remise en état', '6244', 314, 0, 0, NULL, NULL, 1),
(634, 'Autres entretiens et réparations', '6248', 314, 0, 0, NULL, NULL, 1),
(635, 'Assurances multirisques', '6251', 315, 0, 0, NULL, NULL, 1),
(636, 'Assurances matériel de transport', '6252', 315, 0, 0, NULL, NULL, 1),
(637, 'Assurances risques d\'exploitation', '6253', 315, 0, 0, NULL, NULL, 1),
(638, 'Assurances responsabilité du producteur', '6254', 315, 0, 0, NULL, NULL, 1),
(639, 'Assurances insolvabilité clients', '6255', 315, 0, 0, NULL, NULL, 1),
(640, 'Assurances transport sur ventes', '6257', 315, 0, 0, NULL, NULL, 1),
(641, 'Autres primes d\'assurances', '6258', 315, 0, 0, NULL, NULL, 1),
(642, 'Etudes et recherches', '6261', 316, 0, 0, NULL, NULL, 1),
(643, 'Documentation générale', '6265', 316, 0, 0, NULL, NULL, 1),
(644, 'Documentation technique', '6266', 316, 0, 0, NULL, NULL, 1),
(645, 'Annonces, insertions', '6271', 317, 0, 0, NULL, NULL, 1),
(646, 'Catalogues, imprimés publicitaires', '6272', 317, 0, 0, NULL, NULL, 1),
(647, 'Echantillons', '6273', 317, 0, 0, NULL, NULL, 1),
(648, 'Foires et expositions', '6274', 317, 0, 0, NULL, NULL, 1),
(649, 'Publications', '6275', 317, 0, 0, NULL, NULL, 1),
(650, 'Cadeaux à la clientèle', '6276', 317, 0, 0, NULL, NULL, 1),
(651, 'Frais de colloques, séminaires, conférences', '6277', 317, 0, 0, NULL, NULL, 1),
(652, 'Autres charges de publicité et relations publiques', '6278', 317, 0, 0, NULL, NULL, 1),
(653, 'Frais de téléphone', '6281', 318, 0, 0, NULL, NULL, 1),
(654, 'Frais de télex', '6282', 318, 0, 0, NULL, NULL, 1),
(655, 'Frais de télécopie', '6283', 318, 0, 0, NULL, NULL, 1),
(656, 'Autres frais de télécommunications', '6288', 318, 0, 0, NULL, NULL, 1),
(657, 'Frais sur titres (vente, garde)', '6311', 319, 0, 0, NULL, NULL, 1),
(658, 'Frais sur effets', '6312', 319, 0, 0, NULL, NULL, 1),
(659, 'Location de coffres', '6313', 319, 0, 0, NULL, NULL, 1),
(660, 'Commissions d\'affacturage et de titrisation', '6314', 319, 0, 0, NULL, NULL, 1);
INSERT INTO `cptsouscomptes` (`id`, `libelle`, `numero`, `compte_id`, `psedo`, `modif`, `site_id`, `suffixe`, `syn`) VALUES
(661, 'Commissions sur cartes de crédit', '6315', 319, 0, 0, NULL, NULL, 1),
(662, 'Frais d\'émission d\'emprunts', '6316', 319, 0, 0, NULL, NULL, 1),
(663, 'Frais sur instruments monnaie électronique', '6317', 319, 0, 0, NULL, NULL, 1),
(664, 'Autres frais bancaires', '6318', 319, 0, 0, NULL, NULL, 1),
(665, 'Commissions et courtages sur ventes', '6322', 320, 0, 0, NULL, NULL, 1),
(666, 'Honoraires des professions règlementées', '6324', 320, 0, 0, NULL, NULL, 1),
(667, 'Frais d\'actes et de contentieux', '6325', 320, 0, 0, NULL, NULL, 1),
(668, 'Rémunérations d’affacturage et de titrisation', '6326', 320, 0, 0, NULL, NULL, 1),
(669, 'Rémunérations des autres prestataires de services', '6327', 320, 0, 0, NULL, NULL, 1),
(670, 'Divers frais', 'Divers frais', 320, 0, 0, NULL, NULL, 1),
(671, 'Redevances pour brevets, licences', '6342', 322, 0, 0, NULL, NULL, 1),
(672, 'Redevances pour logiciels', '6343', 322, 0, 0, NULL, NULL, 1),
(673, 'Redevances pour marques', '6344', 322, 0, 0, NULL, NULL, 1),
(674, 'Redevances pour sites  internet', '6345', 322, 0, 0, NULL, NULL, 1),
(675, 'Redevances pour concessions, droits et valeurs similaires', '6346', 322, 0, 0, NULL, NULL, 1),
(676, 'Cotisations', '6351', 323, 0, 0, NULL, NULL, 1),
(677, 'Concours divers', '6358', 323, 0, 0, NULL, NULL, 1),
(678, 'Personnel intérimaire', '6371', 324, 0, 0, NULL, NULL, 1),
(679, 'Personnel détaché ou prêté à l\'entité', '6372', 324, 0, 0, NULL, NULL, 1),
(680, 'Frais de recrutement du personnel', '6381', 325, 0, 0, NULL, NULL, 1),
(681, 'Frais de déménagement', '6382', 325, 0, 0, NULL, NULL, 1),
(682, 'Réceptions', '6383', 325, 0, 0, NULL, NULL, 1),
(683, 'Missions', '6384', 325, 0, 0, NULL, NULL, 1),
(684, 'Charges de copropriété', '6385', 325, 0, 0, NULL, NULL, 1),
(685, 'Charges externes diverses', '6388', 325, 0, 0, NULL, NULL, 1),
(686, 'Impôts fonciers et taxes annexes', '6411', 326, 0, 0, NULL, NULL, 1),
(687, 'Patentes, licences et taxes annexes', '6412', 326, 0, 0, NULL, NULL, 1),
(688, 'Taxes sur appointements et salaires', '6413', 326, 0, 0, NULL, NULL, 1),
(689, 'Taxes d\'apprentissage', '6414', 326, 0, 0, NULL, NULL, 1),
(690, 'Formation professionnelle continue', '6415', 326, 0, 0, NULL, NULL, 1),
(691, 'Autres impôts et taxes directs', '6418', 326, 0, 0, NULL, NULL, 1),
(692, 'Droits de mutation', '6461', 328, 0, 0, NULL, NULL, 1),
(693, 'Droits de timbre', '6462', 328, 0, 0, NULL, NULL, 1),
(694, 'Taxes sur les véhicules de société', '6463', 328, 0, 0, NULL, NULL, 1),
(695, 'Vignettes', '6464', 328, 0, 0, NULL, NULL, 1),
(696, 'Autres droits d\'enregistrement', '6468', 328, 0, 0, NULL, NULL, 1),
(697, 'Pénalités d\'assiette, impôts directs', '6471', 329, 0, 0, NULL, NULL, 1),
(698, 'Pénalités d\'assiette, impôts indirects', '6472', 329, 0, 0, NULL, NULL, 1),
(699, 'Pénalités de recouvrement, impôts directs', '6473', 329, 0, 0, NULL, NULL, 1),
(700, 'Pénalités de recouvrement, impôts indirects', '6474', 329, 0, 0, NULL, NULL, 1),
(701, 'Autres pénalités et amendes fiscales', '6478', 329, 0, 0, NULL, NULL, 1),
(702, 'Clients', '6511', 331, 0, 0, NULL, NULL, 1),
(703, 'Autres débiteurs', '6515', 331, 0, 0, NULL, NULL, 1),
(704, 'Quote-part transférée de bénéfices (comptabilité du gérant)', '6521', 332, 0, 0, NULL, NULL, 1),
(705, 'Pertes imputées par transfert (comptabilité des associés non gérants)', '6525', 332, 0, 0, NULL, NULL, 1),
(706, 'Immobilisations incorporelles', '6541', 333, 0, 0, NULL, NULL, 1),
(707, 'Immobilisations corporelles', '6542', 333, 0, 0, NULL, NULL, 1),
(708, 'Indemnités de fonction et autres rémunérations d\'administrateurs', '6581', 336, 0, 0, NULL, NULL, 1),
(709, 'Dons', '6582', 336, 0, 0, NULL, NULL, 1),
(710, 'Mécénat', '6583', 336, 0, 0, NULL, NULL, 1),
(711, 'Autres charges diverses', '6588', 336, 0, 0, NULL, NULL, 1),
(712, 'sur risques à court terme', '6591', 337, 0, 0, NULL, NULL, 1),
(713, 'sur stocks', '6593', 337, 0, 0, NULL, NULL, 1),
(714, 'sur créances', '6594', 337, 0, 0, NULL, NULL, 1),
(715, 'Autres charges pour  dépréciations et provisions pour risques à court terme ', '6598', 337, 0, 0, NULL, NULL, 1),
(716, 'Appointements salaires et commissions', '6611', 338, 0, 0, NULL, NULL, 1),
(717, 'Primes et gratifications', '6612', 338, 0, 0, NULL, NULL, 1),
(718, 'Congés payés', '6613', 338, 0, 0, NULL, NULL, 1),
(719, 'Indemnités de préavis, de licenciement et de recherche d\'embauche', '6614', 338, 0, 0, NULL, NULL, 1),
(720, 'Indemnités de maladie versées aux travailleurs', '6615', 338, 0, 0, NULL, NULL, 1),
(721, 'Supplément familial', '6616', 338, 0, 0, NULL, NULL, 1),
(722, 'Avantages en nature', '6617', 338, 0, 0, NULL, NULL, 1),
(723, 'Autres rémunérations directes', '6618', 338, 0, 0, NULL, NULL, 1),
(724, 'Appointements salaires et commissions', '6621', 339, 0, 0, NULL, NULL, 1),
(725, 'Primes et gratifications', '6622', 339, 0, 0, NULL, NULL, 1),
(726, 'Congés payés', '6623', 339, 0, 0, NULL, NULL, 1),
(727, 'Indemnités de préavis, de licenciement et de recherche d\'embauche', '6624', 339, 0, 0, NULL, NULL, 1),
(728, 'Indemnités de maladie versées aux travailleurs', '6625', 339, 0, 0, NULL, NULL, 1),
(729, 'Supplément familial', '6626', 339, 0, 0, NULL, NULL, 1),
(730, 'Avantages en nature', '6627', 339, 0, 0, NULL, NULL, 1),
(731, 'Autres rémunérations directes', '6628', 339, 0, 0, NULL, NULL, 1),
(732, 'Indemnités de logement', '6631', 340, 0, 0, NULL, NULL, 1),
(733, 'Indemnités de représentation', '6632', 340, 0, 0, NULL, NULL, 1),
(734, 'Indemnités d\'expatriation', '6633', 340, 0, 0, NULL, NULL, 1),
(735, 'Indemnités de transport', '6634', 340, 0, 0, NULL, NULL, 1),
(736, 'Autres indemnités et avantages divers', '6638', 340, 0, 0, NULL, NULL, 1),
(737, 'Charges sociales sur rémunération du personnel national', '6641', 341, 0, 0, NULL, NULL, 1),
(738, 'Charges sociales sur rémunération du personnel non national', '6642', 341, 0, 0, NULL, NULL, 1),
(739, 'Rémunération du travail de l\'exploitant', '6661', 342, 0, 0, NULL, NULL, 1),
(740, 'Charges sociales', '6662', 342, 0, 0, NULL, NULL, 1),
(741, 'Personnel intérimaire', '6671', 343, 0, 0, NULL, NULL, 1),
(742, 'Personnel détaché ou prêté à l’entité', '6672', 343, 0, 0, NULL, NULL, 1),
(743, 'Versements aux Syndicats et Comités d\'entreprise, d\'établissement', '6681', 344, 0, 0, NULL, NULL, 1),
(744, 'Versements aux Comités d\'hygiène et de sécurité', '6682', 344, 0, 0, NULL, NULL, 1),
(745, 'Versements et contributions aux autres œuvres sociales', '6683', 344, 0, 0, NULL, NULL, 1),
(746, 'Médecine du travail et pharmacie', '6684', 344, 0, 0, NULL, NULL, 1),
(747, 'Assurances et organismes de santé', '6685', 344, 0, 0, NULL, NULL, 1),
(748, 'Assurances retraite et fonds de pensions', '6686', 344, 0, 0, NULL, NULL, 1),
(749, 'Majorations et pénalités sociales', '6687', 344, 0, 0, NULL, NULL, 1),
(750, 'Charges sociales diverses', '6688', 344, 0, 0, NULL, NULL, 1),
(751, 'Emprunts obligataires', '6711', 345, 0, 0, NULL, NULL, 1),
(752, 'Emprunts auprès des établissements de crédit', '6712', 345, 0, 0, NULL, NULL, 1),
(753, 'Dettes liées à des participations', '6713', 345, 0, 0, NULL, NULL, 1),
(754, 'Primes de remboursement des obligations', '6714', 345, 0, 0, NULL, NULL, 1),
(755, 'Intérêts dans loyers de location-acquisition/crédit-bail immobilier', '6722', 346, 0, 0, NULL, NULL, 1),
(756, 'Intérêts dans loyers de location-acquisition/crédit-bail mobilier', '6723', 346, 0, 0, NULL, NULL, 1),
(757, 'Intérêts dans loyers de location-acquisition/location-vente', '6724', 346, 0, 0, NULL, NULL, 1),
(758, 'Intérêts dans loyers des autres locations-acquisition ', '6728', 346, 0, 0, NULL, NULL, 1),
(759, 'Avances reçues et dépôts créditeurs', '6741', 348, 0, 0, NULL, NULL, 1),
(760, 'Comptes courants bloqués', '6742', 348, 0, 0, NULL, NULL, 1),
(761, 'Intérêts sur obligations cautionnées', '6743', 348, 0, 0, NULL, NULL, 1),
(762, 'Intérêts sur dettes commerciales', '6744', 348, 0, 0, NULL, NULL, 1),
(763, 'Intérêts bancaires et sur opérations de financement (escompte…)', '6745', 348, 0, 0, NULL, NULL, 1),
(764, 'Intérêts sur dettes diverses', '6748', 348, 0, 0, NULL, NULL, 1),
(765, 'Pertes sur cessions de titres de placement', '6771', 351, 0, 0, NULL, NULL, 1),
(766, 'Malis provenant d’attribution gratuite d’actions au personnel salarié et aux dirigeants', '6772', 351, 0, 0, NULL, NULL, 1),
(767, 'sur rentes viagères', '6781', 352, 0, 0, NULL, NULL, 1),
(768, 'sur opérations financières', '6782', 352, 0, 0, NULL, NULL, 1),
(769, 'sur instruments de trésorerie', '6784', 352, 0, 0, NULL, NULL, 1),
(770, 'sur risques financiers', '6791', 353, 0, 0, NULL, NULL, 1),
(771, 'sur titres de placement', '6795', 353, 0, 0, NULL, NULL, 1),
(772, 'Autres charges pour dépréciations et provisions pour risques à court terme financières', '6798', 353, 0, 0, NULL, NULL, 1),
(775, 'Dotations aux provisions pour risques et charges', '6911', 356, 0, 0, NULL, NULL, 1),
(776, 'Dotations aux dépréciations des immobilisations incorporelles', '6913', 356, 0, 0, NULL, NULL, 1),
(777, 'Dotations aux dépréciations des immobilisations corporelles', '6914', 356, 0, 0, NULL, NULL, 1),
(778, 'Dotations aux provisions pour risques et charges', '6971', 357, 0, 0, NULL, NULL, 1),
(779, 'Dotations aux dépréciations des immobilisations financières', '6972', 357, 0, 0, NULL, NULL, 1),
(780, 'dans la Région (7)', '7011', 358, 0, 0, NULL, NULL, 1),
(781, 'hors Région (7)', '7012', 358, 0, 0, NULL, NULL, 1),
(782, 'aux entités du groupe dans la Région', '7013', 358, 0, 0, NULL, NULL, 1),
(783, 'aux entités du groupe hors Région', '7014', 358, 0, 0, NULL, NULL, 1),
(784, 'sur internet', '7015', 358, 0, 0, NULL, NULL, 1),
(785, 'Rabais, remises, ristournes accordés (non ventilés)', '7019', 358, 0, 0, NULL, NULL, 1),
(786, 'dans la Région (7)', '7021', 359, 0, 0, NULL, NULL, 1),
(787, 'hors Région (7)', '7022', 359, 0, 0, NULL, NULL, 1),
(788, 'aux entités du groupe dans la Région', '7023', 359, 0, 0, NULL, NULL, 1),
(789, 'aux entités du groupe hors Région', '7024', 359, 0, 0, NULL, NULL, 1),
(790, 'sur internet', '7025', 359, 0, 0, NULL, NULL, 1),
(791, 'Rabais, remises, ristournes accordés (non ventilés)', '7029', 359, 0, 0, NULL, NULL, 1),
(792, 'dans la Région (7)', '7031', 360, 0, 0, NULL, NULL, 1),
(793, 'hors Région (7)', '7032', 360, 0, 0, NULL, NULL, 1),
(794, 'aux entités du groupe dans la Région', '7033', 360, 0, 0, NULL, NULL, 1),
(795, 'aux entités du groupe hors Région', '7034', 360, 0, 0, NULL, NULL, 1),
(796, 'sur internet', '7035', 360, 0, 0, NULL, NULL, 1),
(797, 'Rabais, remises, ristournes accordés (non ventilés)', '7039', 360, 0, 0, NULL, NULL, 1),
(798, 'dans la Région (7)', '7041', 361, 0, 0, NULL, NULL, 1),
(799, 'hors Région (7)', '7042', 361, 0, 0, NULL, NULL, 1),
(800, 'aux entités du groupe dans la Région', '7043', 361, 0, 0, NULL, NULL, 1),
(801, 'aux entités du groupe hors Région', '7044', 361, 0, 0, NULL, NULL, 1),
(802, 'sur internet', '7045', 361, 0, 0, NULL, NULL, 1),
(803, 'Rabais, remises, ristournes accordés (non ventilés)', '7049', 361, 0, 0, NULL, NULL, 1),
(804, 'dans la Région (7)', '7051', 362, 0, 0, NULL, NULL, 1),
(805, 'hors Région (7)', '7052', 362, 0, 0, NULL, NULL, 1),
(806, 'aux entités du groupe dans la Région', '7053', 362, 0, 0, NULL, NULL, 1),
(807, 'aux entités du groupe hors Région', '7054', 362, 0, 0, NULL, NULL, 1),
(808, 'sur internet', '7055', 362, 0, 0, NULL, NULL, 1),
(809, 'Rabais, remises, ristournes accordés (non ventilés)', '7059', 362, 0, 0, NULL, NULL, 1),
(810, 'dans la Région (7)', '7061', 363, 0, 0, NULL, NULL, 1),
(811, 'hors Région (7)', '7062', 363, 0, 0, NULL, NULL, 1),
(812, 'aux entités du groupe dans la Région', '7063', 363, 0, 0, NULL, NULL, 1),
(813, 'aux entités du groupe hors Région', '7064', 363, 0, 0, NULL, NULL, 1),
(814, 'sur internet', '7065', 363, 0, 0, NULL, NULL, 1),
(815, 'Rabais, remises, ristournes accordés (non ventilés)', '7069', 363, 0, 0, NULL, NULL, 1),
(816, 'Ports, emballages perdus et autres frais facturés', '7071', 364, 0, 0, NULL, NULL, 1),
(817, 'Commissions et courtages(8)', '7072', 364, 0, 0, NULL, NULL, 1),
(818, 'Locations et redevances de location - financement (8) ', '7073', 364, 0, 0, NULL, NULL, 1),
(819, 'Bonis sur reprises et cessions d\'emballages', '7074', 364, 0, 0, NULL, NULL, 1),
(820, 'Mise à disposition de personnel (8)', '7075', 364, 0, 0, NULL, NULL, 1),
(821, 'Redevances pour brevets, logiciels, marques et droits similaires (8)', '7076', 364, 0, 0, NULL, NULL, 1),
(822, 'Services exploités dans l\'intérêt du personnel', '7077', 364, 0, 0, NULL, NULL, 1),
(823, 'Autres produits accessoires', '7078', 364, 0, 0, NULL, NULL, 1),
(824, 'Versées par l\'Etat et les collectivités publiques', '7181', 369, 0, 0, NULL, NULL, 1),
(825, 'Versées par les organismes internationaux', '7182', 369, 0, 0, NULL, NULL, 1),
(826, 'Versées par des tiers', '7183', 369, 0, 0, NULL, NULL, 1),
(827, ' immobilisations corporelles (hors actifs biologiques)', '7221', 371, 0, 0, NULL, NULL, 1),
(828, 'immobilisations corporelles (actifs biologiques)', '7222', 371, 0, 0, NULL, NULL, 1),
(829, 'Produits en cours', '7341', 374, 0, 0, NULL, NULL, 1),
(830, 'Travaux en cours', '7342', 374, 0, 0, NULL, NULL, 1),
(831, 'Etudes en cours ', '3751', 375, 0, 0, NULL, NULL, 1),
(832, 'Prestations de services en cours', '3752', 375, 0, 0, NULL, NULL, 1),
(833, 'Produits intermédiaires', '7371', 377, 0, 0, NULL, NULL, 1),
(834, 'Produits résiduels', '7372', 377, 0, 0, NULL, NULL, 1),
(835, 'Quote-part transférée de pertes (comptabilité du gérant)', '7521', 379, 0, 0, NULL, NULL, 1),
(836, 'Bénéfices attribués par transfert (comptabilité des associés non gérants)', '7525', 379, 0, 0, NULL, NULL, 1),
(837, 'Immobilisations incorporelles', '7541', 380, 0, 0, NULL, NULL, 1),
(838, 'Immobilisations corporelles', '7542', 380, 0, 0, NULL, NULL, 1),
(839, 'Indemnités de fonction et autres rémunérations d\'administrateurs', '7581', 382, 0, 0, NULL, NULL, 1),
(840, 'Indemnités d’assurances reçues', '7582', 382, 0, 0, NULL, NULL, 1),
(841, 'Autres produits divers', '7588', 382, 0, 0, NULL, NULL, 1),
(842, 'sur risques à court terme', '7591', 383, 0, 0, NULL, NULL, 1),
(843, 'sur stocks', '7593', 383, 0, 0, NULL, NULL, 1),
(844, 'sur créances', '7594', 383, 0, 0, NULL, NULL, 1),
(845, 'sur autres charges pour dépréciations  et provisions pour risques à court terme d’exploitation  ', '7598', 383, 0, 0, NULL, NULL, 1),
(846, 'Intérêts de prêts', '7712', 384, 0, 0, NULL, NULL, 1),
(847, 'Intérêts sur créances diverses ', '7713', 384, 0, 0, NULL, NULL, 1),
(848, 'Revenus des titres de participation', '7721', 385, 0, 0, NULL, NULL, 1),
(849, 'Revenus autres titres immobilisés', '7722', 385, 0, 0, NULL, NULL, 1),
(850, 'Revenus des obligations ', '7745', 387, 0, 0, NULL, NULL, 1),
(851, 'Revenus des titres de placement ', '7746', 387, 0, 0, NULL, NULL, 1),
(852, 'sur rentes viagères', '7781', 391, 0, 0, NULL, NULL, 1),
(853, 'sur opérations financières', '7782', 391, 0, 0, NULL, NULL, 1),
(854, 'sur instruments de trésorerie', '7784', 391, 0, 0, NULL, NULL, 1),
(855, 'sur risques financiers', '7791', 392, 0, 0, NULL, NULL, 1),
(856, 'sur titres de placement', '7795', 392, 0, 0, NULL, NULL, 1),
(857, 'sur autres charges pour dépréciations et provisions pour risques à court terme financières', '7798', 392, 0, 0, NULL, NULL, 1),
(858, 'pour risques et charges', '7911', 395, 0, 0, NULL, NULL, 1),
(859, 'des immobilisations incorporelles', '7913', 395, 0, 0, NULL, NULL, 1),
(860, 'des immobilisations corporelles', '7914', 395, 0, 0, NULL, NULL, 1),
(861, 'pour risques et charges', '7971', 396, 0, 0, NULL, NULL, 1),
(862, 'des immobilisations financières', '7972', 396, 0, 0, NULL, NULL, 1),
(863, 'Activités exercées dans l\'Etat', '8911', 437, 0, 0, NULL, NULL, 1),
(864, 'Activités exercées dans les autres Etats de la Région', '8912', 437, 0, 0, NULL, NULL, 1),
(865, 'Activités exercées hors Région', '8913', 437, 0, 0, NULL, NULL, 1),
(866, 'Dégrèvements', '8991', 440, 0, 0, NULL, NULL, 1),
(867, 'Annulations pour pertes rétroactives', '8994', 440, 0, 0, NULL, NULL, 1),
(868, 'Crédits confirmés obtenus', '9011', 441, 0, 0, NULL, NULL, 1),
(869, 'Emprunts restant à encaisser', '9012', 441, 0, 0, NULL, NULL, 1),
(870, 'Facilités de financement renouvelables', '9013', 441, 0, 0, NULL, NULL, 1),
(871, ' Facilités d\'émission', '9014', 441, 0, 0, NULL, NULL, 1),
(872, 'Autres engagements de financement obtenus', '9018', 441, 0, 0, NULL, NULL, 1),
(873, 'Avals obtenus', '9021', 442, 0, 0, NULL, NULL, 1),
(874, 'Cautions, garanties obtenues', '9022', 442, 0, 0, NULL, NULL, 1),
(875, 'Hypothèques obtenues', '9023', 442, 0, 0, NULL, NULL, 1),
(876, 'Effets endossés par des tiers', '9024', 442, 0, 0, NULL, NULL, 1),
(877, 'Autres garanties obtenues', '9028', 442, 0, 0, NULL, NULL, 1),
(878, 'Achats de marchandises à terme', '9031', 443, 0, 0, NULL, NULL, 1),
(879, 'Achats à terme de devises', '9032', 443, 0, 0, NULL, NULL, 1),
(880, 'Commandes fermes des clients', '9033', 443, 0, 0, NULL, NULL, 1),
(881, 'Autres engagements réciproques', '9038', 443, 0, 0, NULL, NULL, 1),
(882, 'Abandons de créances conditionnels', '9041', 444, 0, 0, NULL, NULL, 1),
(883, 'Ventes avec clause de réserve de propriété ', '9043', 444, 0, 0, NULL, NULL, 1),
(884, 'Divers engagements obtenus', '9048', 444, 0, 0, NULL, NULL, 1),
(885, 'Crédits accordés non décaissés', '9051', 445, 0, 0, NULL, NULL, 1),
(886, 'Autres engagements de financement accordés', '9058', 445, 0, 0, NULL, NULL, 1),
(887, 'Avals accordés', '9061', 446, 0, 0, NULL, NULL, 1),
(888, 'Cautions, garanties accordées', '9062', 446, 0, 0, NULL, NULL, 1),
(889, 'Hypothèques accordées', '9063', 446, 0, 0, NULL, NULL, 1),
(890, 'Effets endossés par l\'entité', '9064', 446, 0, 0, NULL, NULL, 1),
(891, 'Autres garanties accordées', '9068', 446, 0, 0, NULL, NULL, 1),
(892, 'Ventes de marchandises à terme', '9071', 447, 0, 0, NULL, NULL, 1),
(893, 'Ventes à terme de devises', '9072', 447, 0, 0, NULL, NULL, 1),
(894, 'Commandes fermes aux fournisseurs', '9073', 447, 0, 0, NULL, NULL, 1),
(895, 'Autres engagements réciproques', '9078', 447, 0, 0, NULL, NULL, 1),
(896, 'Annulations conditionnelles de dettes', '9081', 448, 0, 0, NULL, NULL, 1),
(897, 'Engagements de retraite', '9082', 448, 0, 0, NULL, NULL, 1),
(898, 'Achats avec clause de réserve de propriété', '9083', 448, 0, 0, NULL, NULL, 1),
(899, 'Divers engagements accordés', '9088', 448, 0, 0, NULL, NULL, 1),
(900, 'Dotations aux amortissements des immobilisations incorporelles', '6812', 354, 0, 0, NULL, NULL, 1),
(901, 'Dotations aux amortissements des immobilisations corporelles', '6813', 354, 0, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cpt_auto_ecritures`
--

DROP TABLE IF EXISTS `cpt_auto_ecritures`;
CREATE TABLE IF NOT EXISTS `cpt_auto_ecritures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastdte` date NOT NULL,
  `id_ch` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cpt_liaison_module`
--

DROP TABLE IF EXISTS `cpt_liaison_module`;
CREATE TABLE IF NOT EXISTS `cpt_liaison_module` (
  `id _liaison` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `lie` int(11) DEFAULT '0',
  `compte_ecriture` varchar(20) DEFAULT NULL,
  `long_compte` int(11) DEFAULT '0',
  `souscompte_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `champ` varchar(100) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id _liaison`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cpt_liaison_module`
--

INSERT INTO `cpt_liaison_module` (`id _liaison`, `site_id`, `module_id`, `lie`, `compte_ecriture`, `long_compte`, `souscompte_id`, `categorie_id`, `compte_id`, `libelle`, `code`, `champ`, `syn`) VALUES
(1, 328, 22, 1, '5711', 4, 573, 65, 266, '5711 . Caisse en monnaie nationale', 'TRESLOC', 'Compte trésorerie (locale)', 1),
(2, 328, 22, 1, '5712', 4, 574, 65, 266, '5712 . Caisse en devises', 'TRESETR', 'Compte trésorerie (étrangère)', 1),
(3, 328, 22, 1, '702', 3, NULL, 78, NULL, '702 . VENTES DE PRODUITS FINIS', 'PROSERV', 'Compte des produits/services', 1),
(4, 328, 22, 1, '4431', 4, 448, 52, 187, '4431 . T.V.A. facturée sur ventes', 'TVA', 'Compte de la T.V.A', 1),
(5, 328, 23, 1, '5711', 4, 573, 65, 266, '5711 . Caisse en monnaie nationale', 'TRESLOC', 'Compte trésorerie (locale)', 1),
(6, 328, 23, 1, '5712', 4, 574, 65, 266, '5712 . Caisse en devises', 'TRESETR', 'Compte trésorerie (étrangère)', 1),
(7, 328, 23, 1, '701', 3, NULL, 78, NULL, '701 . VENTES DE MARCHANDISES', 'PROSERV', 'Compte des produits/services', 1),
(8, 328, 23, 1, '4431', 4, 448, 52, 187, '4431 . T.V.A. facturée sur ventes', 'TVA', 'Compte de la T.V.A', 1);

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
CREATE TABLE IF NOT EXISTS `depenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) DEFAULT NULL,
  `dte_dep` date DEFAULT NULL,
  `motif` varchar(245) DEFAULT NULL,
  `usd` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `cdf` decimal(65,10) DEFAULT '0.0000000000',
  `taux` float NOT NULL,
  `service` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `libelle_id` int(11) DEFAULT NULL,
  `sousresto_id` int(11) DEFAULT NULL,
  `psedo` int(11) DEFAULT '0',
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`),
  KEY `libelle_id` (`libelle_id`),
  KEY `souresto_id` (`sousresto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`id`, `numero`, `dte_dep`, `motif`, `usd`, `cdf`, `taux`, `service`, `user_id`, `libelle_id`, `sousresto_id`, `psedo`, `site_id`, `syn`) VALUES
(1, '19599', '2026-04-19', 'Achat chout', '0.0000000000', '10000.0000000000', 2200, 'restaurant', 508, 7, 123, 0, 356, 0),
(2, '19600', '2026-04-19', 'Jus ceres', '0.0000000000', '20000.0000000000', 2200, 'restaurant', 508, 7, 123, 0, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `dep_libelles`
--

DROP TABLE IF EXISTS `dep_libelles`;
CREATE TABLE IF NOT EXISTS `dep_libelles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `designation` varchar(245) NOT NULL,
  `psedo` int(10) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dep_libelles`
--

INSERT INTO `dep_libelles` (`id`, `code`, `designation`, `psedo`, `site_id`, `syn`) VALUES
(1, '', 'transport', 0, 356, 1),
(2, '', 'Collation', 0, 356, 1),
(3, '', 'SNEL', 0, 356, 1),
(4, '', 'REGIDESO', 0, 356, 1),
(5, '', 'Bureautique', 0, 356, 1),
(6, '', 'Reparation', 0, 356, 1),
(7, '', 'Achat', 0, 356, 1),
(8, '', 'Achat kayser', 0, 356, 1),
(9, '', 'Achat Sogood', 0, 356, 1),
(10, '', 'Regularisation', 0, 356, 1),
(11, 'fdclobi', 'Fonds de caisse du lendemain', 0, 356, 1),
(12, '', 'VENTE', 0, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `detailsplats`
--

DROP TABLE IF EXISTS `detailsplats`;
CREATE TABLE IF NOT EXISTS `detailsplats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(245) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `psedo` int(11) DEFAULT '0',
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `detailsplatscommandes`
--

DROP TABLE IF EXISTS `detailsplatscommandes`;
CREATE TABLE IF NOT EXISTS `detailsplatscommandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accomp` varchar(245) DEFAULT NULL,
  `cuisson` varchar(245) DEFAULT NULL,
  `sauce` varchar(245) DEFAULT NULL,
  `sel` varchar(245) DEFAULT NULL,
  `keyprod` int(11) DEFAULT '0',
  `produit_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `lignecmd_id` int(11) DEFAULT NULL,
  `boisson` int(11) DEFAULT '0',
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `produit_id` (`produit_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `commande_id` (`commande_id`),
  KEY `lignecmd_id` (`lignecmd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fiche_transfert`
--

DROP TABLE IF EXISTS `fiche_transfert`;
CREATE TABLE IF NOT EXISTS `fiche_transfert` (
  `id_fiche` int(10) NOT NULL AUTO_INCREMENT,
  `numero` int(15) NOT NULL,
  `date` date NOT NULL,
  `depot_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_fiche`),
  KEY `depot_id` (`depot_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fondscaisse`
--

DROP TABLE IF EXISTS `fondscaisse`;
CREATE TABLE IF NOT EXISTS `fondscaisse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `usd` decimal(65,10) DEFAULT '0.0000000000',
  `cdf` decimal(65,10) DEFAULT '0.0000000000',
  `motif` varchar(245) DEFAULT NULL,
  `sousresto_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `hr` time DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `verse` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fusion_factures`
--

DROP TABLE IF EXISTS `fusion_factures`;
CREATE TABLE IF NOT EXISTS `fusion_factures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fact` int(11) DEFAULT NULL,
  `id_fact_fus` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_fact_fus` (`id_fact_fus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fusion_tables`
--

DROP TABLE IF EXISTS `fusion_tables`;
CREATE TABLE IF NOT EXISTS `fusion_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tbl_fus` int(11) NOT NULL,
  `id_tbl` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_tbl_fus` (`id_tbl_fus`),
  KEY `id_tbl` (`id_tbl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `module_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `module_id` (`module_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `libelle`, `module_id`, `user_id`, `hotel_id`, `syn`) VALUES
(1, 'Manager', 22, 471, 356, 1),
(2, 'Caissier', 22, 471, 356, 1),
(3, 'Gestionnaire de stock boissons', 24, 471, 356, 1),
(4, 'Serveur', 22, 471, 356, 0),
(5, 'Responsable financier', 22, 471, 356, 0),
(6, 'Gestionnaire de stock plats', 22, 471, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `lignes_attente`
--

DROP TABLE IF EXISTS `lignes_attente`;
CREATE TABLE IF NOT EXISTS `lignes_attente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(10) DEFAULT NULL,
  `qte` float DEFAULT '0',
  `lcmd_id` int(11) DEFAULT NULL,
  `facture_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `produit_id` (`produit_id`),
  KEY `facture_id` (`facture_id`),
  KEY `lcmd_id` (`lcmd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lignes_commandes`
--

DROP TABLE IF EXISTS `lignes_commandes`;
CREATE TABLE IF NOT EXISTS `lignes_commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qte` int(11) DEFAULT NULL,
  `qteoffert` float DEFAULT '0',
  `pa` decimal(65,10) DEFAULT '0.0000000000',
  `prix` decimal(65,10) DEFAULT '0.0000000000',
  `prix2` decimal(65,10) DEFAULT '0.0000000000',
  `prixremise` decimal(65,10) DEFAULT '0.0000000000',
  `mont_tva` decimal(65,10) DEFAULT '0.0000000000',
  `repas` int(11) DEFAULT '0',
  `monnaie` varchar(10) DEFAULT 'CDF',
  `dte` date DEFAULT NULL,
  `dte_h` datetime DEFAULT NULL,
  `commande_id` int(10) DEFAULT NULL,
  `produit_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `hotel_id` int(10) DEFAULT NULL,
  `id_sousresto` int(10) DEFAULT NULL,
  `accomp` varchar(200) DEFAULT NULL,
  `impr` int(11) DEFAULT '0',
  `qte2` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  `unmerge_bill_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_id` (`commande_id`,`produit_id`),
  KEY `produit_id` (`produit_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=543 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignes_commandes`
--

INSERT INTO `lignes_commandes` (`id`, `qte`, `qteoffert`, `pa`, `prix`, `prix2`, `prixremise`, `mont_tva`, `repas`, `monnaie`, `dte`, `dte_h`, `commande_id`, `produit_id`, `user_id`, `hotel_id`, `id_sousresto`, `accomp`, `impr`, `qte2`, `syn`, `unmerge_bill_id`) VALUES
(172, 1, 0, '0.0000000000', '25000.0000000000', '0.0000000000', '25000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 25, 530, NULL, 356, NULL, '', 0, 0, 0, NULL),
(173, 1, 0, '0.0000000000', '28000.0000000000', '0.0000000000', '28000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 25, 532, NULL, 356, NULL, '', 0, 0, 0, NULL),
(174, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 25, 538, NULL, 356, NULL, '', 0, 0, 0, NULL),
(175, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 25, 542, NULL, 356, NULL, '', 0, 0, 0, NULL),
(176, 2, 0, '0.0000000000', '23000.0000000000', '0.0000000000', '23000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 25, 671, NULL, 356, NULL, '', 0, 0, 0, NULL),
(177, 1, 0, '0.0000000000', '19500.0000000000', '0.0000000000', '19500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 25, 685, NULL, 356, NULL, '', 0, 0, 0, NULL),
(183, 2, 0, '0.0000000000', '25000.0000000000', '0.0000000000', '25000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 28, 530, NULL, 356, NULL, '', 0, 0, 0, NULL),
(184, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 28, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(185, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 28, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(186, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 28, 732, NULL, 356, NULL, '', 0, 0, 0, NULL),
(187, 4, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 28, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(193, 1, 0, '0.0000000000', '30000.0000000000', '0.0000000000', '30000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 29, 512, NULL, 356, NULL, 'FRITES(1)', 0, 0, 0, NULL),
(194, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 29, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(195, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 29, 745, NULL, 356, NULL, '', 0, 0, 0, NULL),
(201, 2, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 32, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(202, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 32, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(217, 1, 0, '0.0000000000', '25000.0000000000', '0.0000000000', '25000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 31, 507, NULL, 356, NULL, '', 0, 0, 0, NULL),
(218, 1, 0, '0.0000000000', '36500.0000000000', '0.0000000000', '36500.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 31, 523, NULL, 356, NULL, '', 0, 0, 0, NULL),
(219, 1, 0, '0.0000000000', '28000.0000000000', '0.0000000000', '28000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 31, 532, NULL, 356, NULL, '', 0, 0, 0, NULL),
(220, 1, 0, '0.0000000000', '17000.0000000000', '0.0000000000', '17000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 31, 722, NULL, 356, NULL, '', 0, 0, 0, NULL),
(221, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 31, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(222, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 31, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(223, 2, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 31, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(224, 1, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '8000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 31, 759, NULL, 356, NULL, '', 0, 0, 0, NULL),
(226, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 38, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(238, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 39, 736, NULL, 356, NULL, '', 0, 0, 0, NULL),
(252, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 42, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(253, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 42, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(256, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(257, 24, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(258, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 732, NULL, 356, NULL, '', 0, 0, 0, NULL),
(259, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 736, NULL, 356, NULL, '', 0, 0, 0, NULL),
(260, 3, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(261, 4, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 745, NULL, 356, NULL, '', 0, 0, 0, NULL),
(262, 6, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(263, 6, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 747, NULL, 356, NULL, '', 0, 0, 0, NULL),
(264, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 36, 753, NULL, 356, NULL, '', 0, 0, 0, NULL),
(276, 1, 0, '0.0000000000', '36000.0000000000', '0.0000000000', '36000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 43, 398, NULL, 356, NULL, '', 0, 0, 0, NULL),
(277, 2, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 43, 538, NULL, 356, NULL, '', 0, 0, 0, NULL),
(278, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 43, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(279, 5, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 43, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(280, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 43, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(282, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 35, 53, NULL, 356, NULL, '', 0, 0, 0, NULL),
(283, 5, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 35, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(284, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 35, 538, NULL, 356, NULL, '', 0, 0, 0, NULL),
(285, 7, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 35, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(286, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 35, 732, NULL, 356, NULL, '', 0, 0, 0, NULL),
(287, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 47, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(292, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 33, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(293, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 33, 731, NULL, 356, NULL, '', 0, 0, 0, NULL),
(294, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 41, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(295, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 51, 751, NULL, 356, NULL, '', 0, 0, 0, NULL),
(296, 1, 0, '0.0000000000', '20000.0000000000', '0.0000000000', '20000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 34, 447, NULL, 356, NULL, '', 0, 0, 0, NULL),
(297, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 34, 538, NULL, 356, NULL, '', 0, 0, 0, NULL),
(298, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 34, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(299, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 34, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(300, 4, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 34, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(303, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 53, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(304, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 53, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(318, 1, 0, '0.0000000000', '23000.0000000000', '0.0000000000', '23000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 55, 667, NULL, 356, NULL, '', 0, 0, 0, NULL),
(319, 1, 0, '0.0000000000', '34500.0000000000', '0.0000000000', '34500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 55, 673, NULL, 356, NULL, '', 0, 0, 0, NULL),
(325, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 49, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(326, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 49, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(327, 2, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 52, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(328, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 52, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(329, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 52, 747, NULL, 356, NULL, '', 0, 0, 0, NULL),
(330, 3, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 52, 767, NULL, 356, NULL, '', 0, 0, 0, NULL),
(348, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 61, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(349, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 61, 734, NULL, 356, NULL, '', 0, 0, 0, NULL),
(350, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 63, 747, NULL, 356, NULL, '', 0, 0, 0, NULL),
(353, 2, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 59, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(354, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 59, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(358, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 44, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(359, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 44, 734, NULL, 356, NULL, '', 0, 0, 0, NULL),
(360, 5, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 44, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(361, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 44, 745, NULL, 356, NULL, '', 0, 0, 0, NULL),
(362, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 44, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(363, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 44, 766, NULL, 356, NULL, '', 0, 0, 0, NULL),
(371, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 48, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(372, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 48, 747, NULL, 356, NULL, '', 0, 0, 0, NULL),
(374, 1, 0, '0.0000000000', '28500.0000000000', '0.0000000000', '28500.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 46, 486, NULL, 356, NULL, '', 0, 0, 0, NULL),
(375, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 46, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(376, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 46, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(377, 3, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 40, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(381, 1, 0, '0.0000000000', '55000.0000000000', '0.0000000000', '55000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 65, 641, NULL, 356, NULL, '', 0, 0, 0, NULL),
(384, 3, 0, '0.0000000000', '36500.0000000000', '0.0000000000', '36500.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 45, 523, NULL, 356, NULL, '', 0, 0, 0, NULL),
(385, 3, 0, '0.0000000000', '23000.0000000000', '0.0000000000', '23000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 45, 671, NULL, 356, NULL, '', 0, 0, 0, NULL),
(386, 2, 0, '0.0000000000', '34500.0000000000', '0.0000000000', '34500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 45, 673, NULL, 356, NULL, '', 0, 0, 0, NULL),
(387, 4, 0, '0.0000000000', '19500.0000000000', '0.0000000000', '19500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 45, 686, NULL, 356, NULL, '', 0, 0, 0, NULL),
(388, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 45, 736, NULL, 356, NULL, '', 0, 0, 0, NULL),
(389, 8, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 45, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(390, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 66, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(391, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 66, 745, NULL, 356, NULL, '', 0, 0, 0, NULL),
(392, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 66, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(393, 4, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 26, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(394, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 26, 734, NULL, 356, NULL, '', 0, 0, 0, NULL),
(395, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 26, 736, NULL, 356, NULL, '', 0, 0, 0, NULL),
(403, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 68, 747, NULL, 356, NULL, '', 0, 0, 0, NULL),
(404, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 69, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(405, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 69, 751, NULL, 356, NULL, '', 0, 0, 0, NULL),
(406, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 56, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(407, 2, 0, '0.0000000000', '28500.0000000000', '0.0000000000', '28500.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 56, 486, NULL, 356, NULL, '', 0, 0, 0, NULL),
(408, 1, 0, '0.0000000000', '19500.0000000000', '0.0000000000', '19500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 56, 686, NULL, 356, NULL, '', 0, 0, 0, NULL),
(409, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 56, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(410, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 56, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(411, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 56, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(412, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 56, 753, NULL, 356, NULL, '', 0, 0, 0, NULL),
(413, 2, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 62, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(414, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 62, 736, NULL, 356, NULL, '', 0, 0, 0, NULL),
(415, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 62, 745, NULL, 356, NULL, '', 0, 0, 0, NULL),
(417, 1, 0, '0.0000000000', '55000.0000000000', '0.0000000000', '55000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 70, 641, NULL, 356, NULL, '', 0, 0, 0, NULL),
(421, 1, 0, '0.0000000000', '50000.0000000000', '0.0000000000', '50000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 67, 529, NULL, 356, NULL, '', 0, 0, 0, NULL),
(422, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 67, 538, NULL, 356, NULL, '', 0, 0, 0, NULL),
(423, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 67, 748, NULL, 356, NULL, '', 0, 0, 0, NULL),
(424, 8, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '8000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 67, 759, NULL, 356, NULL, '', 0, 0, 0, NULL),
(425, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 71, 753, NULL, 356, NULL, '', 0, 0, 0, NULL),
(426, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 71, 768, NULL, 356, NULL, '', 0, 0, 0, NULL),
(427, 1, 0, '0.0000000000', '30000.0000000000', '0.0000000000', '30000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 37, 531, NULL, 356, NULL, '', 0, 0, 0, NULL),
(428, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 37, 536, NULL, 356, NULL, '', 0, 0, 0, NULL),
(429, 1, 0, '0.0000000000', '138000.0000000000', '0.0000000000', '138000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 37, 657, NULL, 356, NULL, '', 0, 0, 0, NULL),
(430, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 37, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(431, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 64, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(432, 3, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 64, 747, NULL, 356, NULL, '', 0, 0, 0, NULL),
(433, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 64, 751, NULL, 356, NULL, '', 0, 0, 0, NULL),
(434, 1, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '8000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 64, 756, NULL, 356, NULL, '', 0, 0, 0, NULL),
(435, 1, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '8000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 64, 759, NULL, 356, NULL, '', 0, 0, 0, NULL),
(436, 2, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 64, 767, NULL, 356, NULL, '', 0, 0, 0, NULL),
(437, 1, 0, '0.0000000000', '19500.0000000000', '0.0000000000', '19500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 685, NULL, 356, NULL, '', 0, 0, 0, NULL),
(438, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(439, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 736, NULL, 356, NULL, '', 0, 0, 0, NULL),
(440, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 741, NULL, 356, NULL, '', 0, 0, 0, NULL),
(441, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 747, NULL, 356, NULL, '', 0, 0, 0, NULL),
(442, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 751, NULL, 356, NULL, '', 0, 0, 0, NULL),
(443, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 753, NULL, 356, NULL, '', 0, 0, 0, NULL),
(444, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 60, 767, NULL, 356, NULL, '', 0, 0, 0, NULL),
(445, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 58, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(446, 2, 0, '0.0000000000', '28000.0000000000', '0.0000000000', '28000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 58, 532, NULL, 356, NULL, '', 0, 0, 0, NULL),
(447, 2, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 58, 536, NULL, 356, NULL, '', 0, 0, 0, NULL),
(448, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 58, 541, NULL, 356, NULL, '', 0, 0, 0, NULL),
(449, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 58, 742, NULL, 356, NULL, '', 0, 0, 0, NULL),
(450, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 58, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(451, 2, 0, '0.0000000000', '18500.0000000000', '0.0000000000', '18500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 58, 749, NULL, 356, NULL, '', 0, 0, 0, NULL),
(452, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 58, 753, NULL, 356, NULL, '', 0, 0, 0, NULL),
(453, 1, 0, '0.0000000000', '20000.0000000000', '0.0000000000', '20000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 50, 447, NULL, 356, NULL, '', 0, 0, 0, NULL),
(454, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 50, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(455, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 27, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(456, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 27, 732, NULL, 356, NULL, '', 0, 0, 0, NULL),
(457, 1, 0, '0.0000000000', '20000.0000000000', '0.0000000000', '20000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 57, 447, NULL, 356, NULL, '', 0, 0, 0, NULL),
(458, 2, 0, '0.0000000000', '19500.0000000000', '0.0000000000', '19500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 57, 685, NULL, 356, NULL, '', 0, 0, 0, NULL),
(459, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-19', NULL, 30, 446, NULL, 356, NULL, '', 0, 0, 0, NULL),
(460, 1, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '8000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 30, 759, NULL, 356, NULL, '', 0, 0, 0, NULL),
(461, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 54, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(462, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 54, 745, NULL, 356, NULL, '', 0, 0, 0, NULL),
(463, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-19', NULL, 54, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(473, 1, 0, '0.0000000000', '70000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 72, 655, NULL, 356, NULL, '', 0, 1, 0, NULL),
(474, 1, 0, '0.0000000000', '15000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 72, 712, NULL, 356, NULL, '', 0, 1, 0, NULL),
(475, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 72, 751, NULL, 356, NULL, '', 0, 1, 0, NULL),
(476, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 73, 751, NULL, 356, NULL, '', 0, 0, 1, 73),
(477, 1, 0, '0.0000000000', '70000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 73, 655, NULL, 356, NULL, '', 0, 0, 1, 73),
(478, 1, 0, '0.0000000000', '15000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 73, 712, NULL, 356, NULL, '', 0, 0, 1, 73),
(479, 1, 0, '0.0000000000', '18500.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 73, 546, NULL, 356, NULL, '', 0, 0, 1, 73),
(480, 1, 0, '0.0000000000', '33000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 73, 526, NULL, 356, NULL, '', 0, 0, 1, 73),
(485, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 75, 768, NULL, 356, NULL, '', 0, 0, 0, NULL),
(486, 1, 0, '0.0000000000', '28500.0000000000', '0.0000000000', '28500.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 74, 486, NULL, 356, NULL, '', 0, 0, 0, NULL),
(487, 3, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 74, 729, NULL, 356, NULL, '', 0, 0, 0, NULL),
(488, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 74, 768, NULL, 356, NULL, '', 0, 0, 0, NULL),
(497, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 76, 734, NULL, 356, NULL, '', 0, 0, 0, NULL),
(498, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 76, 766, NULL, 356, NULL, '', 0, 0, 0, NULL),
(499, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 76, 768, NULL, 356, NULL, '', 0, 0, 0, NULL),
(501, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 78, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(508, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 80, 53, NULL, 356, NULL, '', 0, 0, 0, NULL),
(511, 1, 0, '0.0000000000', '50000.0000000000', '0.0000000000', '50000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 79, 529, NULL, 356, NULL, '', 0, 0, 0, NULL),
(512, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 79, 541, NULL, 356, NULL, '', 0, 0, 0, NULL),
(513, 2, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 79, 738, NULL, 356, NULL, '', 0, 0, 0, NULL),
(514, 1, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 79, 746, NULL, 356, NULL, '', 0, 0, 0, NULL),
(515, 2, 0, '0.0000000000', '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 79, 752, NULL, 356, NULL, '', 0, 0, 0, NULL),
(516, 3, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '8000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 79, 759, NULL, 356, NULL, '', 0, 0, 0, NULL),
(517, 2, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '5000.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 79, 767, NULL, 356, NULL, '', 0, 0, 0, NULL),
(518, 1, 0, '0.0000000000', '15000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 81, 460, NULL, 356, NULL, '', 0, 0, 1, 81),
(519, 1, 0, '0.0000000000', '20000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 81, 447, NULL, 356, NULL, '', 0, 0, 1, 81),
(520, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 81, 538, NULL, 356, NULL, '', 0, 0, 1, 81),
(521, 1, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 82, 759, NULL, 356, NULL, '', 0, 0, 1, 82),
(522, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 77, 730, NULL, 356, NULL, '', 0, 0, 0, NULL),
(523, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 77, 768, NULL, 356, NULL, '', 0, 0, 0, NULL),
(525, 3, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 83, 769, NULL, 356, NULL, '', 0, 0, 0, NULL),
(527, 2, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 84, 734, NULL, 356, NULL, '', 0, 0, 0, NULL),
(528, 1, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 85, 756, NULL, 356, NULL, '', 0, 0, 1, 85),
(529, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 85, 767, NULL, 356, NULL, '', 0, 0, 1, 85),
(530, 1, 0, '0.0000000000', '3500.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 85, 729, NULL, 356, NULL, '', 0, 0, 1, 85),
(531, 1, 0, '0.0000000000', '2500.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 85, 738, NULL, 356, NULL, '', 0, 0, 1, 85),
(532, 1, 0, '0.0000000000', '33000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 86, 526, NULL, 356, NULL, '', 0, 0, 1, 86),
(533, 1, 0, '0.0000000000', '15000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 86, 460, NULL, 356, NULL, '', 0, 0, 1, 86),
(534, 1, 0, '0.0000000000', '30000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 86, 512, NULL, 356, NULL, 'FRITES(1)', 0, 0, 1, 86),
(535, 1, 0, '0.0000000000', '25000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 86, 507, NULL, 356, NULL, '', 0, 0, 1, 86),
(538, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 87, 768, NULL, 356, NULL, '', 0, 0, 0, NULL),
(539, 1, 0, '0.0000000000', '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 88, 768, NULL, 356, NULL, '', 0, 0, 0, NULL),
(540, 1, 0, '0.0000000000', '30000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 89, 521, NULL, 356, NULL, '', 0, 0, 1, 89),
(541, 1, 0, '0.0000000000', '5000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2026-04-20', NULL, 89, 541, NULL, 356, NULL, '', 0, 0, 1, 89),
(542, 1, 0, '0.0000000000', '8000.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2026-04-20', NULL, 89, 759, NULL, 356, NULL, '', 0, 0, 1, 89);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `nom`, `code`, `syn`) VALUES
(21, 'COMPTABILITE', 'MC', 1),
(22, 'Restaurant', 'MR', 1),
(23, 'Hebergement', 'MH', 1),
(24, 'Stock', 'MS', 1),
(25, 'CONFIGURATIONS_REGLAGES', 'MCR', 1),
(26, 'Ressources humaines', 'RH', 1),
(27, 'Facturation', 'MFACT', 1),
(29, 'Point de vente', 'POS', 1);

-- --------------------------------------------------------

--
-- Structure de la table ` monnaie`
--

DROP TABLE IF EXISTS ` monnaie`;
CREATE TABLE IF NOT EXISTS ` monnaie` (
  `id_monnaie` int(15) NOT NULL AUTO_INCREMENT,
  `monnaie` varchar(10) DEFAULT NULL,
  `lib_monnaie` varchar(50) DEFAULT NULL,
  `symbole` varchar(5) DEFAULT NULL,
  `choix` int(2) DEFAULT '0',
  `taux` varchar(10) DEFAULT NULL,
  `tva` float DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `syn` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_monnaie`),
  KEY `company_id` (`company_id`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=912 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table ` monnaie`
--

INSERT INTO ` monnaie` (`id_monnaie`, `monnaie`, `lib_monnaie`, `symbole`, `choix`, `taux`, `tva`, `id_hotel`, `company_id`, `syn`) VALUES
(909, NULL, 'USD', NULL, 0, NULL, NULL, 356, 299, 1),
(910, NULL, 'CDF', NULL, 0, NULL, NULL, 356, 299, 1),
(911, NULL, 'USD&CDF', NULL, 0, NULL, NULL, 356, 299, 1);

-- --------------------------------------------------------

--
-- Structure de la table `niveau_chambre`
--

DROP TABLE IF EXISTS `niveau_chambre`;
CREATE TABLE IF NOT EXISTS `niveau_chambre` (
  `id_niv_cha` int(11) NOT NULL AUTO_INCREMENT,
  `lib_niv_cha` varchar(100) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_niv_cha`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `idpaie` int(11) NOT NULL AUTO_INCREMENT,
  `montant` decimal(65,10) DEFAULT NULL,
  `montantusd` decimal(65,10) DEFAULT NULL,
  `montantcdf` decimal(65,10) DEFAULT NULL,
  `taux` decimal(65,10) DEFAULT NULL,
  `rendu` decimal(65,10) DEFAULT NULL,
  `rendu_cdf` decimal(65,10) DEFAULT '0.0000000000',
  `rendu_usd` decimal(65,10) DEFAULT '0.0000000000',
  `remise` decimal(65,10) DEFAULT NULL,
  `justification` varchar(500) DEFAULT NULL,
  `monnaie_achat` varchar(10) DEFAULT NULL,
  `id_mode_regl` int(11) DEFAULT NULL,
  `id_monnaie` int(11) DEFAULT NULL,
  `regl_id` int(11) DEFAULT NULL,
  `site_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `id_sousresto` int(11) DEFAULT NULL,
  `histch_id` int(11) DEFAULT NULL,
  `resch_id` int(11) DEFAULT NULL,
  `motif` varchar(20) DEFAULT NULL,
  `annuler` int(11) DEFAULT '0',
  `session_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idpaie`),
  KEY `id_mode_regl` (`id_mode_regl`),
  KEY `id_monnaie` (`id_monnaie`,`regl_id`),
  KEY `id_monnaie_2` (`id_monnaie`),
  KEY `id_user` (`regl_id`),
  KEY `site_id` (`site_id`,`company_id`),
  KEY `company_id` (`company_id`),
  KEY `id_sousresto` (`id_sousresto`),
  KEY `histch_id` (`histch_id`),
  KEY `resch_id` (`resch_id`),
  KEY `session_id` (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idpaie`, `montant`, `montantusd`, `montantcdf`, `taux`, `rendu`, `rendu_cdf`, `rendu_usd`, `remise`, `justification`, `monnaie_achat`, `id_mode_regl`, `id_monnaie`, `regl_id`, `site_id`, `company_id`, `id_sousresto`, `histch_id`, `resch_id`, `motif`, `annuler`, `session_id`, `syn`) VALUES
(25, '128500.0000000000', '0.0000000000', '128500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 25, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(26, '77500.0000000000', '0.0000000000', '77500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 26, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(27, '39000.0000000000', '0.0000000000', '39000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 27, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(28, '27000.0000000000', '0.0000000000', '27000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 28, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(29, '126500.0000000000', '0.0000000000', '126500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 29, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(30, '2500.0000000000', '0.0000000000', '2500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 30, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(31, '3500.0000000000', '0.0000000000', '3500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 31, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(32, '13500.0000000000', '0.0000000000', '13500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 32, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(33, '219500.0000000000', '0.0000000000', '219500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 33, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(34, '73500.0000000000', '0.0000000000', '73500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 34, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(35, '93000.0000000000', '0.0000000000', '93000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 35, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(36, '7000.0000000000', '0.0000000000', '7000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 36, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(37, '7000.0000000000', '0.0000000000', '7000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 37, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(38, '7000.0000000000', '0.0000000000', '7000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 38, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(39, '13000.0000000000', '0.0000000000', '13000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 39, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(40, '60500.0000000000', '0.0000000000', '60500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 40, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(41, '10500.0000000000', '0.0000000000', '10500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 41, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(42, '57500.0000000000', '0.0000000000', '57500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 42, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(43, '9000.0000000000', '0.0000000000', '9000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 43, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(44, '44000.0000000000', '0.0000000000', '44000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 44, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(45, '7000.0000000000', '0.0000000000', '7000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 45, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(46, '6500.0000000000', '0.0000000000', '6500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 46, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(47, '27000.0000000000', '0.0000000000', '27000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 47, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(48, '36000.0000000000', '0.0000000000', '36000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 48, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(49, '10000.0000000000', '0.0000000000', '10000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 49, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(50, '35500.0000000000', '0.0000000000', '35500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 50, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(51, '10500.0000000000', '0.0000000000', '10500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 51, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(52, '55000.0000000000', '0.0000000000', '55000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 52, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(53, '349000.0000000000', '0.0000000000', '349000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 53, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(54, '36300000.0000000000', '16500.0000000000', '0.0000000000', '2200.0000000000', '36283500.0000000000', '0.0000000000', '36283500.0000000000', '0.0000000000', '', NULL, 2, NULL, 54, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(55, '54000.0000000000', '0.0000000000', '54000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 55, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(56, '6500.0000000000', '0.0000000000', '6500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 56, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(57, '13500.0000000000', '0.0000000000', '13500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 57, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(58, '118500.0000000000', '0.0000000000', '118500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 58, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(59, '30000.0000000000', '0.0000000000', '30000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 59, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(60, '55000.0000000000', '0.0000000000', '55000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 60, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(61, '132000.0000000000', '0.0000000000', '132000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 61, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(62, '16500.0000000000', '0.0000000000', '16500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 62, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(63, '175500.0000000000', '0.0000000000', '175500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 63, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(64, '62000.0000000000', '0.0000000000', '62000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 64, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(65, '67500.0000000000', '0.0000000000', '67500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 65, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(66, '150500.0000000000', '0.0000000000', '150500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 66, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(67, '23500.0000000000', '0.0000000000', '23500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 67, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(68, '17000.0000000000', '0.0000000000', '17000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 68, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(69, '59000.0000000000', '0.0000000000', '59000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 69, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(70, '18000.0000000000', '0.0000000000', '18000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 70, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(71, '16500.0000000000', '0.0000000000', '16500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 71, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(72, '10000.0000000000', '0.0000000000', '10000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 72, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(73, '49000.0000000000', '0.0000000000', '49000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 73, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(76, '17000.0000000000', '0.0000000000', '17000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 76, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(77, '2500.0000000000', '0.0000000000', '2500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 77, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(78, '10000.0000000000', '0.0000000000', '10000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 78, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(79, '113500.0000000000', '0.0000000000', '113500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 79, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(80, '13500.0000000000', '0.0000000000', '13500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 80, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(81, '7500.0000000000', '0.0000000000', '7500.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 81, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(82, '7000.0000000000', '0.0000000000', '7000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 82, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(83, '10000.0000000000', '0.0000000000', '10000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 83, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0),
(84, '10000.0000000000', '0.0000000000', '10000.0000000000', '2200.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 84, 356, 299, 123, NULL, NULL, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paragraphe_contrat`
--

DROP TABLE IF EXISTS `paragraphe_contrat`;
CREATE TABLE IF NOT EXISTS `paragraphe_contrat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paragraphe` text,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parametrage`
--

DROP TABLE IF EXISTS `parametrage`;
CREATE TABLE IF NOT EXISTS `parametrage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tva` float(10,2) NOT NULL,
  `taux` float(10,2) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `partenaire_hotel`
--

DROP TABLE IF EXISTS `partenaire_hotel`;
CREATE TABLE IF NOT EXISTS `partenaire_hotel` (
  `id_part_hotel` int(10) NOT NULL AUTO_INCREMENT,
  `partenaire_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_part_hotel`),
  KEY `partenaire_id` (`partenaire_id`,`hotel_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `platspreparations`
--

DROP TABLE IF EXISTS `platspreparations`;
CREATE TABLE IF NOT EXISTS `platspreparations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `detplat_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `produit8id` (`produit_id`,`detplat_id`),
  KEY `detplat_id` (`detplat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `platspreparations`
--

INSERT INTO `platspreparations` (`id`, `produit_id`, `detplat_id`, `syn`) VALUES
(1, 308, 26, 1),
(2, 308, 30, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

DROP TABLE IF EXISTS `prix`;
CREATE TABLE IF NOT EXISTS `prix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `souscription` varchar(20) NOT NULL,
  `prix_user` float NOT NULL,
  `prix_user2` float NOT NULL DEFAULT '0',
  `prix_par_user` float NOT NULL,
  `prix_par_user2` float NOT NULL DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`),
  KEY `module_id_2` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `module_id`, `souscription`, `prix_user`, `prix_user2`, `prix_par_user`, `prix_par_user2`, `syn`) VALUES
(1, 1, 'mensuel', 25, 0, 0, 0, 1),
(2, 1, 'annuel', 280, 0, 0, 0, 1),
(3, 4, 'mensuel', 45, 0, 0, 0, 1),
(4, 4, 'annuel', 485, 0, 0, 0, 1),
(5, 7, 'mensuel', 3, 0, 0, 0, 1),
(6, 7, 'annuel', 2, 0, 0, 0, 1),
(7, 2, 'mensuel', 9, 0, 0, 0, 1),
(8, 2, 'annuel', 80, 0, 0, 0, 1),
(9, 6, 'mensuel', 75, 0, 0, 0, 1),
(10, 6, 'annuel', 835, 0, 0, 0, 1),
(11, 5, 'mensuel', 33, 0, 0, 0, 1),
(12, 5, 'annuel', 335, 0, 0, 0, 1),
(13, 30, 'mensuel', 15, 0, 0, 0, 1),
(14, 30, 'annuel', 135, 0, 0, 0, 1),
(15, 29, 'mensuel', 12, 0, 0, 0, 1),
(16, 29, 'annuel', 102, 0, 0, 0, 1),
(17, 31, '', 2.5, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `publicites`
--

DROP TABLE IF EXISTS `publicites`;
CREATE TABLE IF NOT EXISTS `publicites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(245) DEFAULT NULL,
  `titre` varchar(245) DEFAULT NULL,
  `image` varbinary(500) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reglage_systeme`
--

DROP TABLE IF EXISTS `reglage_systeme`;
CREATE TABLE IF NOT EXISTS `reglage_systeme` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tva` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reglage_systeme`
--

INSERT INTO `reglage_systeme` (`id`, `tva`, `syn`) VALUES
(2, 16, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reportcaisse`
--

DROP TABLE IF EXISTS `reportcaisse`;
CREATE TABLE IF NOT EXISTS `reportcaisse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `usd` decimal(65,10) DEFAULT '0.0000000000',
  `cdf` decimal(65,10) DEFAULT '0.0000000000',
  `sousresto_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `hr` time DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resaffectation`
--

DROP TABLE IF EXISTS `resaffectation`;
CREATE TABLE IF NOT EXISTS `resaffectation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resbonmalade`
--

DROP TABLE IF EXISTS `resbonmalade`;
CREATE TABLE IF NOT EXISTS `resbonmalade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idemploy` int(11) DEFAULT NULL,
  `idmembr` int(11) DEFAULT NULL,
  `idmalade` int(11) DEFAULT NULL,
  `emplyprisencharg` int(11) DEFAULT NULL,
  `noms` varchar(20) NOT NULL,
  `numbon` varchar(100) NOT NULL,
  `dte` date NOT NULL,
  `code` varchar(10) NOT NULL,
  `idsite` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idemploy` (`idemploy`,`idmembr`,`idsite`),
  KEY `idmembr` (`idmembr`),
  KEY `idsite` (`idsite`),
  KEY `idmalade` (`idmalade`),
  KEY `idemployprisencharg` (`emplyprisencharg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rescategorie`
--

DROP TABLE IF EXISTS `rescategorie`;
CREATE TABLE IF NOT EXISTS `rescategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `salbase` decimal(65,10) NOT NULL,
  `montantjr` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `devise` varchar(20) NOT NULL,
  `psedo` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `preavis` int(11) DEFAULT '0',
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resconfig`
--

DROP TABLE IF EXISTS `resconfig`;
CREATE TABLE IF NOT EXISTS `resconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomcomp` varchar(500) DEFAULT NULL,
  `adrcomp` varchar(500) DEFAULT NULL,
  `m_insert` varchar(10) DEFAULT NULL,
  `m_affich` varchar(10) DEFAULT NULL,
  `taux` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `penalite` int(11) DEFAULT '0',
  `hopital` text,
  `fuseauhoraire` varchar(100) DEFAULT NULL,
  `prefsanct` varchar(100) DEFAULT NULL,
  `prefconge` varchar(100) DEFAULT NULL,
  `tva` float DEFAULT '0',
  `echeance` int(11) DEFAULT '0',
  `liestock` int(11) DEFAULT '0',
  `infofact` text,
  `sujetmail` varchar(245) DEFAULT NULL,
  `msgmail` text,
  `logo` varbinary(200) DEFAULT NULL,
  `module_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `checkin` time DEFAULT NULL,
  `checkout` time DEFAULT NULL,
  `pointage` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`,`site_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resconfig`
--

INSERT INTO `resconfig` (`id`, `nomcomp`, `adrcomp`, `m_insert`, `m_affich`, `taux`, `age`, `penalite`, `hopital`, `fuseauhoraire`, `prefsanct`, `prefconge`, `tva`, `echeance`, `liestock`, `infofact`, `sujetmail`, `msgmail`, `logo`, `module_id`, `site_id`, `checkin`, `checkout`, `pointage`, `syn`) VALUES
(176, 'RESTAURANT CARAVAC', 'Avenue du commerce,Moanda/RDC', 'CDF', 'CDF', 2200, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0x3131343736353736302e6a7067, 23, 356, NULL, NULL, 0, 1),
(177, 'RESTAURANT CARAVAC', 'Avenue du commerce,Moanda/RDC', 'CDF', 'CDF', 2200, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0x3131343736353736302e6a7067, 26, 356, NULL, NULL, 0, 1),
(178, 'RESTAURANT CARAVAC', 'Avenue du commerce,Moanda/RDC', 'CDF', 'CDF', 2200, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0x3131343736353736302e6a7067, 27, 356, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `resconge`
--

DROP TABLE IF EXISTS `resconge`;
CREATE TABLE IF NOT EXISTS `resconge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `transport` int(11) DEFAULT NULL,
  `psedo` int(11) DEFAULT NULL,
  `nbrjr` int(11) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `contenu` longtext,
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `categorie_id` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rescontrat`
--

DROP TABLE IF EXISTS `rescontrat`;
CREATE TABLE IF NOT EXISTS `rescontrat` (
  `idcontr` int(11) NOT NULL AUTO_INCREMENT,
  `typecontr` varchar(20) NOT NULL,
  `dteng` date DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idcontr`),
  KEY `employe_id` (`employe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resdeclaration`
--

DROP TABLE IF EXISTS `resdeclaration`;
CREATE TABLE IF NOT EXISTS `resdeclaration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `lib` varchar(500) DEFAULT NULL,
  `pourtrav` int(11) DEFAULT '0',
  `poursoc` int(11) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resdepartement`
--

DROP TABLE IF EXISTS `resdepartement`;
CREATE TABLE IF NOT EXISTS `resdepartement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `psedo` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resempconge`
--

DROP TABLE IF EXISTS `resempconge`;
CREATE TABLE IF NOT EXISTS `resempconge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` int(11) DEFAULT NULL,
  `conge_id` int(11) DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `dte1` date NOT NULL,
  `dte2` date NOT NULL,
  `nbre` int(11) NOT NULL,
  `transport` int(11) DEFAULT NULL,
  `comment` longtext,
  `doc` int(11) DEFAULT NULL,
  `ref` varchar(100) DEFAULT NULL,
  `encours` int(11) DEFAULT '1',
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`,`conge_id`),
  KEY `sanction_id` (`conge_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resemploycontr`
--

DROP TABLE IF EXISTS `resemploycontr`;
CREATE TABLE IF NOT EXISTS `resemploycontr` (
  `idemplcontr` int(11) NOT NULL AUTO_INCREMENT,
  `idemploy` int(11) NOT NULL,
  `idcontr` int(11) NOT NULL,
  `datedbtcontr` date NOT NULL,
  `datefincontr` date NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idemplcontr`),
  KEY `idemploy` (`idemploy`),
  KEY `idcontr` (`idcontr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resemployefamille`
--

DROP TABLE IF EXISTS `resemployefamille`;
CREATE TABLE IF NOT EXISTS `resemployefamille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(245) NOT NULL,
  `datenais` date NOT NULL,
  `type` varchar(20) NOT NULL,
  `image` varbinary(200) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resemployehoraire`
--

DROP TABLE IF EXISTS `resemployehoraire`;
CREATE TABLE IF NOT EXISTS `resemployehoraire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` int(11) NOT NULL,
  `horaire_id` int(11) NOT NULL,
  `affectation_id` int(11) DEFAULT NULL,
  `defaul` int(11) DEFAULT NULL,
  `nbrjrs` int(11) DEFAULT '0',
  `nbrjrsmaj` int(11) DEFAULT '0',
  `seq` int(11) DEFAULT '0',
  `seqjrsmaj` int(11) DEFAULT '0',
  `type_permt` int(11) NOT NULL DEFAULT '0',
  `agent_permt_id` int(11) DEFAULT NULL,
  `heure_suplmtr_dpt` time DEFAULT NULL,
  `dte_dbt` date DEFAULT NULL,
  `dte_fin` date DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `employe_id` (`employe_id`),
  KEY `horaire_id` (`horaire_id`),
  KEY `affectation_id` (`affectation_id`),
  KEY `site_id` (`site_id`),
  KEY `agent_permt_id` (`agent_permt_id`),
  KEY `type_permt` (`type_permt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resemployes`
--

DROP TABLE IF EXISTS `resemployes`;
CREATE TABLE IF NOT EXISTS `resemployes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(50) NOT NULL,
  `noms` varchar(245) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  `etatcivil` varchar(20) NOT NULL,
  `nationalite` varchar(245) NOT NULL,
  `lieunais` varchar(245) NOT NULL,
  `datenais` date NOT NULL,
  `Adresse` varchar(245) NOT NULL,
  `rue` varchar(250) DEFAULT NULL,
  `quartier` varchar(250) DEFAULT NULL,
  `commune` varchar(250) DEFAULT NULL,
  `ville` varchar(250) DEFAULT NULL,
  `piece` varchar(245) DEFAULT NULL,
  `numpiece` varchar(30) NOT NULL,
  `inss` varchar(50) DEFAULT NULL,
  `fingerprint` varchar(50) DEFAULT NULL,
  `tel1` varchar(20) NOT NULL,
  `tel2` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nbrenf` int(10) NOT NULL,
  `actif` varchar(20) NOT NULL,
  `pseudo_supp` int(10) NOT NULL DEFAULT '0',
  `fonction_id` int(10) DEFAULT NULL,
  `departement_id` int(10) DEFAULT NULL,
  `image` varbinary(200) DEFAULT NULL,
  `id_hotel` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_hotel` (`id_hotel`),
  KEY `fonction_id` (`fonction_id`,`departement_id`),
  KEY `departement_id` (`departement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resemploye_eligibl`
--

DROP TABLE IF EXISTS `resemploye_eligibl`;
CREATE TABLE IF NOT EXISTS `resemploye_eligibl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` int(11) DEFAULT NULL,
  `noms_employe` varchar(200) DEFAULT NULL,
  `dteengag` date DEFAULT NULL,
  `dte1` date DEFAULT NULL,
  `dtecg` date DEFAULT NULL,
  `dte2` date DEFAULT NULL,
  `nbrjcg` int(11) DEFAULT '0',
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`,`site_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resemprunt`
--

DROP TABLE IF EXISTS `resemprunt`;
CREATE TABLE IF NOT EXISTS `resemprunt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` int(11) DEFAULT NULL,
  `num_emprnt` varchar(50) NOT NULL,
  `montant` decimal(65,10) NOT NULL,
  `montant2` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `monnaie` varchar(20) DEFAULT NULL,
  `taux` decimal(65,10) NOT NULL DEFAULT '1.0000000000',
  `dte` date NOT NULL,
  `dte_deduct` varchar(30) DEFAULT NULL,
  `duree` int(11) NOT NULL DEFAULT '1',
  `employe_id` int(11) NOT NULL,
  `psedo` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `employe_id` (`employe_id`),
  KEY `libelle` (`libelle`),
  KEY `libelle_2` (`libelle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservationconfig`
--

DROP TABLE IF EXISTS `reservationconfig`;
CREATE TABLE IF NOT EXISTS `reservationconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manuel` int(11) NOT NULL DEFAULT '0',
  `penalite` int(11) NOT NULL DEFAULT '0',
  `retention` varchar(50) NOT NULL DEFAULT 'nuitee',
  `valmont` decimal(65,10) NOT NULL,
  `monnaie` varchar(10) DEFAULT NULL,
  `jrannule` int(11) DEFAULT '1',
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservation_table`
--

DROP TABLE IF EXISTS `reservation_table`;
CREATE TABLE IF NOT EXISTS `reservation_table` (
  `id_res_table` int(10) NOT NULL AUTO_INCREMENT,
  `date_res_tbl` date NOT NULL,
  `date_hr_res_tbl` datetime NOT NULL,
  `client_nom` varchar(50) NOT NULL,
  `table_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_res_table`),
  KEY `client_id` (`client_nom`,`table_id`,`hotel_id`),
  KEY `table_id` (`table_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resfonction`
--

DROP TABLE IF EXISTS `resfonction`;
CREATE TABLE IF NOT EXISTS `resfonction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `psedo` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reshoraire`
--

DROP TABLE IF EXISTS `reshoraire`;
CREATE TABLE IF NOT EXISTS `reshoraire` (
  `idh` int(11) NOT NULL AUTO_INCREMENT,
  `libh` varchar(100) NOT NULL,
  `nbrjrstrav` int(11) NOT NULL,
  `sortie` int(11) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idh`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reshorairejours`
--

DROP TABLE IF EXISTS `reshorairejours`;
CREATE TABLE IF NOT EXISTS `reshorairejours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horaire_id` int(11) NOT NULL,
  `jours_id` int(11) NOT NULL,
  `dbt` time NOT NULL,
  `mrg` int(11) NOT NULL,
  `fin` time NOT NULL,
  `avmrgdbt` int(11) NOT NULL,
  `mrgfin` int(11) NOT NULL,
  `avmrgdbtsec` int(11) NOT NULL,
  `dbtsec` int(11) NOT NULL,
  `mrgdbtsec` int(11) NOT NULL,
  `finsec` int(11) NOT NULL,
  `mrgfinsec` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `horaire_id` (`horaire_id`),
  KEY `jours_id` (`jours_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resjours`
--

DROP TABLE IF EXISTS `resjours`;
CREATE TABLE IF NOT EXISTS `resjours` (
  `idjrs` int(11) NOT NULL AUTO_INCREMENT,
  `codejrs` varchar(3) NOT NULL,
  `codejrsphp` int(11) NOT NULL,
  `libjrs` varchar(20) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idjrs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `respermutation`
--

DROP TABLE IF EXISTS `respermutation`;
CREATE TABLE IF NOT EXISTS `respermutation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL,
  `dte` date NOT NULL,
  `dtefin` date NOT NULL,
  `idagent1` int(10) DEFAULT NULL,
  `nomsagent1` varchar(20) DEFAULT NULL,
  `idagent2` int(10) DEFAULT NULL,
  `nomsagent2` varchar(20) DEFAULT NULL,
  `idhoraire` int(11) DEFAULT NULL,
  `libhoraire` varchar(20) DEFAULT NULL,
  `statut` int(11) DEFAULT '1',
  `type_code` int(11) DEFAULT NULL,
  `type_lib` varchar(100) DEFAULT NULL,
  `idsite` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idagent1` (`idagent1`,`idhoraire`,`idsite`),
  KEY `idsite` (`idsite`),
  KEY `idhoraire` (`idhoraire`),
  KEY `idagent2` (`idagent2`),
  KEY `idagent1_2` (`idagent1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `respointage`
--

DROP TABLE IF EXISTS `respointage`;
CREATE TABLE IF NOT EXISTS `respointage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` int(11) DEFAULT NULL,
  `dte_in` date DEFAULT NULL,
  `dte_out` date DEFAULT NULL,
  `hr_in` time DEFAULT NULL,
  `hr_out` time DEFAULT NULL,
  `motif` varchar(20) DEFAULT NULL,
  `justification` varchar(245) DEFAULT NULL,
  `presence` int(11) NOT NULL DEFAULT '0',
  `retard` int(11) NOT NULL DEFAULT '0',
  `absence` int(11) NOT NULL DEFAULT '0',
  `conge` int(11) NOT NULL DEFAULT '0',
  `malade` int(11) NOT NULL DEFAULT '0',
  `afich` int(11) DEFAULT '0',
  `hrs_suplmtr` int(11) DEFAULT NULL,
  `horaire_id` int(11) DEFAULT NULL,
  `arrive` int(11) DEFAULT '0',
  `depart` int(11) DEFAULT '0',
  `transport` int(11) DEFAULT '1',
  `hr_ind` time DEFAULT NULL,
  `hr_outf` time DEFAULT NULL,
  `sortie` int(11) DEFAULT '0',
  `mensuel` int(11) DEFAULT '0',
  `libmois` varchar(30) DEFAULT NULL,
  `idsite` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`),
  KEY `horaire_id` (`horaire_id`,`idsite`),
  KEY `idsite` (`idsite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `respointagehoraire`
--

DROP TABLE IF EXISTS `respointagehoraire`;
CREATE TABLE IF NOT EXISTS `respointagehoraire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pointage_id` int(11) NOT NULL,
  `hjr_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pointage_id` (`pointage_id`,`hjr_id`),
  KEY `hjr_id` (`hjr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resremboursement`
--

DROP TABLE IF EXISTS `resremboursement`;
CREATE TABLE IF NOT EXISTS `resremboursement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` int(11) NOT NULL,
  `salaire_id` int(11) DEFAULT NULL,
  `montant` decimal(65,10) NOT NULL,
  `monnaie` varchar(20) DEFAULT NULL,
  `taux` decimal(65,10) NOT NULL DEFAULT '1.0000000000',
  `dte` date NOT NULL,
  `emprunt_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`,`salaire_id`),
  KEY `salaire_id` (`salaire_id`),
  KEY `emprunt_id` (`emprunt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resrubrique`
--

DROP TABLE IF EXISTS `resrubrique`;
CREATE TABLE IF NOT EXISTS `resrubrique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `type` varchar(20) NOT NULL,
  `type2` varchar(20) NOT NULL,
  `psedo` int(11) NOT NULL,
  `affiche` int(11) NOT NULL DEFAULT '1',
  `sequence` int(11) NOT NULL DEFAULT '0',
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resrubriquecateg`
--

DROP TABLE IF EXISTS `resrubriquecateg`;
CREATE TABLE IF NOT EXISTS `resrubriquecateg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubrique_id` int(10) DEFAULT NULL,
  `categorie_id` int(10) DEFAULT NULL,
  `salbase` int(11) NOT NULL,
  `nbrenf` int(11) NOT NULL,
  `salbrut` int(11) NOT NULL,
  `manuel` int(11) NOT NULL,
  `pourcentage` int(11) NOT NULL,
  `imposable` int(11) NOT NULL,
  `valeur` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `monnaie` varchar(20) DEFAULT NULL,
  `valeur2` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `jrp` int(11) NOT NULL DEFAULT '0',
  `hrsup` int(11) NOT NULL DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rubrique_id` (`rubrique_id`,`categorie_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resrubriquesal`
--

DROP TABLE IF EXISTS `resrubriquesal`;
CREATE TABLE IF NOT EXISTS `resrubriquesal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubrique_id` int(10) DEFAULT NULL,
  `salaire_id` int(10) DEFAULT NULL,
  `valeur` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rubrique_id` (`rubrique_id`,`salaire_id`),
  KEY `categorie_id` (`salaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ressalaire`
--

DROP TABLE IF EXISTS `ressalaire`;
CREATE TABLE IF NOT EXISTS `ressalaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) DEFAULT NULL,
  `libelle2` varchar(50) DEFAULT NULL,
  `nbjrpreste` int(11) NOT NULL,
  `nbjrconge` int(11) NOT NULL,
  `montant` decimal(65,10) NOT NULL,
  `totbase` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `taux` decimal(65,10) NOT NULL DEFAULT '1.0000000000',
  `dte` date NOT NULL,
  `dte2` date DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `psedo` int(11) NOT NULL,
  `jrpreavis` int(11) DEFAULT '0',
  `cong6preavis` int(11) DEFAULT '0',
  `congcomp` int(11) DEFAULT '0',
  `connonpris` int(11) DEFAULT '0',
  `arsal` decimal(65,10) DEFAULT '0.0000000000',
  `indemnite` decimal(65,10) DEFAULT '0.0000000000',
  `ancienete` varchar(20) DEFAULT '0',
  `motif` varchar(20) DEFAULT '0',
  `decompte` int(11) DEFAULT '0',
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `employe_id` (`employe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ressanction`
--

DROP TABLE IF EXISTS `ressanction`;
CREATE TABLE IF NOT EXISTS `ressanction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `pseudo` int(11) NOT NULL,
  `nbrjr` int(11) NOT NULL DEFAULT '0',
  `retenue` int(11) NOT NULL DEFAULT '0',
  `contenu` longtext,
  `site_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ressanctionempl`
--

DROP TABLE IF EXISTS `ressanctionempl`;
CREATE TABLE IF NOT EXISTS `ressanctionempl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `sanction_id` int(11) DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `dte1` date DEFAULT NULL,
  `dte2` date DEFAULT NULL,
  `nbre` int(11) NOT NULL DEFAULT '0',
  `retenu` int(11) DEFAULT NULL,
  `comment` longtext,
  `doc` int(11) DEFAULT NULL,
  `encours` int(11) DEFAULT '1',
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`,`sanction_id`),
  KEY `sanction_id` (`sanction_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `restmp_pointage`
--

DROP TABLE IF EXISTS `restmp_pointage`;
CREATE TABLE IF NOT EXISTS `restmp_pointage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` int(11) DEFAULT NULL,
  `dte_in` date NOT NULL,
  `point_id` int(11) DEFAULT NULL,
  `idsite` int(11) NOT NULL,
  `horaire_id` int(11) DEFAULT NULL,
  `compteurshift` int(11) DEFAULT '0',
  `idpointprec` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`),
  KEY `idsite` (`idsite`),
  KEY `point_id` (`point_id`),
  KEY `horaire_id` (`horaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `serveurs`
--

DROP TABLE IF EXISTS `serveurs`;
CREATE TABLE IF NOT EXISTS `serveurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `sexe` varchar(20) NOT NULL,
  `psedo` int(11) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serveurs`
--

INSERT INTO `serveurs` (`id`, `code`, `nom`, `prenom`, `tel`, `sexe`, `psedo`, `site_id`, `syn`) VALUES
(31, NULL, 'BAHITAPE', 'ESPERANCE STELLA ', '', 'F', 0, 356, 1),
(32, NULL, 'MBAYI', 'TONY', '', 'M', 0, 356, 1),
(34, NULL, 'KIBIKULA', 'GEMIMA ', '', 'M', 0, 356, 1),
(33, NULL, 'KAZADI', 'TRYPHENE', '', 'F', 0, 356, 1),
(35, NULL, 'KANYINDA', 'SIMEON ', '', 'M', 0, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `skt_fiche`
--

DROP TABLE IF EXISTS `skt_fiche`;
CREATE TABLE IF NOT EXISTS `skt_fiche` (
  `id_fiche` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `motif` varchar(20) DEFAULT NULL,
  `beneficiere` varchar(200) DEFAULT NULL,
  `nbrprod` int(10) DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `dte_time` datetime DEFAULT NULL,
  `approuve` int(10) NOT NULL DEFAULT '0',
  `motifappro` varchar(100) DEFAULT NULL,
  `depot_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_fiche`),
  KEY `depot_id` (`depot_id`,`user_id`,`hotel_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `skt_fiche`
--

INSERT INTO `skt_fiche` (`id_fiche`, `numero`, `type`, `motif`, `beneficiere`, `nbrprod`, `dte`, `dte_time`, `approuve`, `motifappro`, `depot_id`, `user_id`, `hotel_id`, `syn`) VALUES
(29, '03460', 'appro', 'appro', '', 4, '2026-04-20', '2026-04-20 18:27:40', 1, 'appro', 121, 502, 356, 0),
(30, '82283', 'sortie', 'sortie', 'Fredy', 1, '2026-04-20', '2026-04-20 18:32:22', 1, '', 121, 502, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `souscription`
--

DROP TABLE IF EXISTS `souscription`;
CREATE TABLE IF NOT EXISTS `souscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compagny_id` int(11) NOT NULL,
  `libelle` varchar(20) DEFAULT NULL,
  `date_sous` date DEFAULT NULL,
  `date_activ` date DEFAULT NULL,
  `dte_echeance` date DEFAULT NULL,
  `dte_blocage` date DEFAULT NULL,
  `dte_upgrade` date DEFAULT NULL,
  `mode_paie` varchar(20) DEFAULT NULL,
  `montant_tot_sous` float DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `type_souscription` varchar(20) DEFAULT NULL,
  `generer` int(10) DEFAULT '0',
  `site_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pseudo_suppr` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `compagny_id` (`compagny_id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `souscription`
--

INSERT INTO `souscription` (`id`, `compagny_id`, `libelle`, `date_sous`, `date_activ`, `dte_echeance`, `dte_blocage`, `dte_upgrade`, `mode_paie`, `montant_tot_sous`, `statut`, `etat`, `type_souscription`, `generer`, `site_id`, `user_id`, `pseudo_suppr`, `syn`) VALUES
(199, 299, 'SCT57071628', '2019-12-11', '2020-01-18', '2020-02-18', '2020-02-25', '2019-12-11', '', 0, 'demo', 1, 'mensuel', 0, 356, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stkcodes`
--

DROP TABLE IF EXISTS `stkcodes`;
CREATE TABLE IF NOT EXISTS `stkcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stkcodes`
--

INSERT INTO `stkcodes` (`id`, `libelle`, `site_id`, `syn`) VALUES
(2, 'ddd', 328, 1),
(3, 'z345', 328, 1),
(4, 'xx23', 328, 1),
(5, ',jojo', 328, 1),
(6, 'ccc', 328, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stk_famille`
--

DROP TABLE IF EXISTS `stk_famille`;
CREATE TABLE IF NOT EXISTS `stk_famille` (
  `idfamille` int(10) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `plat` int(11) DEFAULT '0',
  `affichage` int(10) DEFAULT '1',
  `fiche_tech` int(11) DEFAULT '0',
  `familletype_id` int(11) DEFAULT NULL,
  `pseudo_supp` int(11) DEFAULT '0',
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idfamille`),
  KEY `hotel_id` (`hotel_id`),
  KEY `familletype_id` (`familletype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_famille`
--

INSERT INTO `stk_famille` (`idfamille`, `designation`, `plat`, `affichage`, `fiche_tech`, `familletype_id`, `pseudo_supp`, `hotel_id`, `syn`) VALUES
(27, 'BOISSONS', 0, 1, 0, 1, 0, 356, 1),
(28, 'PLATS', 1, 1, 0, 2, 1, 356, 1),
(29, 'CUISINE', 1, 1, 0, 2, 0, 356, 1),
(30, 'SANDWICHERIE', 1, 1, 0, 3, 0, 356, 1),
(31, 'A FUMER', 0, 1, 0, 4, 0, 356, 1),
(32, 'PLAT DU JOUR', 1, 1, 0, 2, 0, 356, 1),
(33, 'MATIERES PREMIERES', 0, 1, 0, 5, 0, 356, 1),
(35, 'EMBALLAGES', 0, 1, 0, 4, 0, 356, 1),
(36, 'FUT', 0, 1, 0, 1, 0, 356, 1),
(37, 'KEMBO BBQ', 1, 1, 0, NULL, 1, 356, 1),
(38, 'Jazz Kif', 1, 1, 0, NULL, 1, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stk_familletype`
--

DROP TABLE IF EXISTS `stk_familletype`;
CREATE TABLE IF NOT EXISTS `stk_familletype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `priority` int(11) DEFAULT '0',
  `sup` int(10) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_familletype`
--

INSERT INTO `stk_familletype` (`id`, `nom`, `priority`, `sup`, `syn`) VALUES
(1, 'BOISSONS', 1, 0, 1),
(2, 'CUISINE', 2, 0, 1),
(3, 'SANDWICHERIE', 3, 0, 1),
(4, 'EXTRA', 4, 0, 1),
(5, '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stk_produit`
--

DROP TABLE IF EXISTS `stk_produit`;
CREATE TABLE IF NOT EXISTS `stk_produit` (
  `idprod` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `path_image` text,
  `qte_min` float DEFAULT NULL,
  `qte_initial` float DEFAULT NULL,
  `qte_dispo` float DEFAULT '0',
  `pa` float(10,2) DEFAULT '0.00',
  `pv` float(10,2) DEFAULT '0.00',
  `tva` decimal(65,10) DEFAULT '0.0000000000',
  `monnaie` varchar(20) DEFAULT NULL,
  `repas` int(11) DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  `pseudo_supp` int(10) NOT NULL DEFAULT '0',
  `unite` varchar(10) DEFAULT NULL,
  `ingredient` int(11) DEFAULT '0',
  `famille_id` int(11) DEFAULT NULL,
  `image` varbinary(300) DEFAULT NULL,
  `code_id` int(11) DEFAULT NULL,
  `nourriture` int(11) DEFAULT '0',
  `accomp` int(11) DEFAULT '0',
  `softplt` int(11) DEFAULT '0',
  `softbtl` int(11) DEFAULT '0',
  `legume` int(11) DEFAULT '0',
  `cuisso` int(11) DEFAULT '0',
  `soce` int(11) DEFAULT '0',
  `cond` int(11) DEFAULT '0',
  `vin` int(11) DEFAULT '0',
  `biere` int(11) DEFAULT '0',
  `pop` int(11) DEFAULT '0',
  `hotel_id` int(11) DEFAULT NULL,
  `vendrerupturestk` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idprod`),
  KEY `famille_id` (`famille_id`,`hotel_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `code_id` (`code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=773 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_produit`
--

INSERT INTO `stk_produit` (`idprod`, `code`, `designation`, `path_image`, `qte_min`, `qte_initial`, `qte_dispo`, `pa`, `pv`, `tva`, `monnaie`, `repas`, `statut`, `pseudo_supp`, `unite`, `ingredient`, `famille_id`, `image`, `code_id`, `nourriture`, `accomp`, `softplt`, `softbtl`, `legume`, `cuisso`, `soce`, `cond`, `vin`, `biere`, `pop`, `hotel_id`, `vendrerupturestk`, `syn`) VALUES
(5, 'C003', 'Sal. parisienne', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(6, 'C004', 'Tagl. Bolognaise', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 12, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(7, 'C005', 'Poulet roti entier', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(8, 'C006', 'Cote de Boeuf 400g', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 356, 0, 1),
(13, 'C011', 'Salade Ã  la Russe', 'images/2685369e1f65f4b7f5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(20, 'C018', 'Taglia legumes', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(21, 'C019', 'Penne aux Cossas', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 12, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(22, 'C020', 'Tagliatelles jambon from.', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 12, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(23, 'C021', 'Demi poulet roti', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(24, 'C022', 'Escalope de Poul', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(25, 'C023', 'Poulet Atieke', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(26, 'C024', 'Saucisse', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(27, 'C025', 'Brochette boeuf', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 356, 0, 1),
(28, 'C026', 'Boeuf Strogonoff', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(29, 'C027', 'SautÃ© de porc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(30, 'C028', 'PavÃ© de capitaine', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(31, 'C029', 'Salade israÃ©lienne', 'images/3131869e1f6d24f303.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(32, 'C030', 'Sal. Comorienne', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(33, 'C031', 'Sal. Italienne', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(34, 'C032', 'Oeufs au plat', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(35, 'C033', 'Omellette nature', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(36, 'C034', 'Omelette From.', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(37, 'C035', 'Viennoiserie', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(38, 'C036', 'Croissant', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(50, 'C048', 'Samusa mixtes', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(51, 'C049', 'Samusa Boeuf', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(52, 'C050', 'Hamburger', 'images/3144769e1f7ca24265.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(53, 'C051', 'Samussa viande', 'images/502869e1f74da9180.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(54, 'C052', 'Nuggets poulet', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(55, 'C053', 'Brick poulet', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(56, 'C054', 'Brick thon', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(57, 'C055', 'Brick boeuf', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(58, 'C056', 'Brick lÃ©gumes', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(59, 'C057', 'Quiche du jour', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(60, 'C058', 'Quiche veget.', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(61, 'C060', 'Cuisses grenouilles', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(62, 'C061', 'Tartifl\'Est', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(63, 'C062', 'Plat du jour', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(82, 'P020', 'CafÃ© filtre', 'images/590569e2c3b01752b.png', 10, 0, 0, 0.20, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(83, 'P021', 'ThÃ©', 'images/590569e2c3b01752b.png', 20, 0, 0, 0.20, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(84, 'P022', 'Expresso', 'images/590569e2c3b01752b.png', 20, 0, 0, 0.75, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(85, 'P023', 'Sup. lait', 'images/590569e2c3b01752b.png', 20, 0, 0, 0.20, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(86, 'P024', 'Chocolat chaud', 'images/590569e2c3b01752b.png', 20, 0, 0, 0.20, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(87, 'P025', 'Tembo Pression Pt', 'images/590569e2c3b01752b.png', 80, 0, 0, 0.36, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(88, 'P026', 'Tembo Pression Gd', 'images/590569e2c3b01752b.png', 40, 0, 0, 0.72, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(89, 'P027', 'Skol Pression Pt', 'images/590569e2c3b01752b.png', 80, 0, 0, 0.35, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(90, 'P028', 'Skol Pression Gd', 'images/590569e2c3b01752b.png', 40, 0, 0, 0.70, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(91, 'P029', 'Limonade Pression pt', 'images/590569e2c3b01752b.png', 40, 0, 0, 0.30, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(102, 'P040', 'Rhum verre', 'images/627569e2c1f40ccc0.png', 24, 0, 0, 0.20, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(104, 'P042', 'Gin verre', 'images/627569e2c1f40ccc0.png', 24, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(106, 'P044', 'Whisky verre', 'images/627569e2c1f40ccc0.png', 24, 0, 0, 0.75, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'Verre', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(108, 'P046', 'Vodka verre', 'images/627569e2c1f40ccc0.png', 24, 0, 0, 0.75, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(110, 'P048', 'Ricard verre', 'images/627569e2c1f40ccc0.png', 24, 0, 0, 0.75, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(111, 'Bs123', 'Dose black', 'images/590569e2c3b01752b.png', 2, 0, 0, 12.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'Mesurette', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(114, 'Bs126', 'Red Lbl Verre', 'images/627569e2c1f40ccc0.png', 2, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'piece', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(116, 'Bs128', 'Verre absolut vodka', 'images/627569e2c1f40ccc0.png', 2, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'piece', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(120, 'Bs132', 'Verre very passion', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'Mesurette', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(126, '139b', 'Verre very pamplemousse', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(128, 'Bs140b', 'Verre very peche', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(131, 'Bs144', 'verre very cerise', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(133, 'Bs147', 'Verre very framboise', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(135, 'Bs149', 'Verre very pasteque', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(137, 'Bs151', 'Verre very melon', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'verre', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(142, 'Bs156', 'EXPRESSO', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(147, 'Bs2555', 'Cafe filtre', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(148, 'Bs2556', 'The', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(150, 'Cgt123', 'Dunhill', 'images/590569e2c3b01752b.png', 2, 0, 0, 2.50, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'Paquet', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(151, 'Cgt125', 'Ambassade', 'images/590569e2c3b01752b.png', 2, 0, 0, 1.50, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'Paquet', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(152, 'Plt01', 'Madesu na saucisse', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(153, 'Plt02', 'Fumbwa na makayabu', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(154, 'Plt03', 'Poulet a la mwambe', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(155, 'Plt04', 'Ndunda poisson fume', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(156, 'Plt05', 'Pondu poisson frit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(157, 'Plt06', 'Poulet en sauce aux legumes', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(162, 'Bs251x', 'Sucre', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(163, 'Bs251888', 'Sucre', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(164, 'Bs111111', 'Eau', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(165, 'Ft078', 'Frites sandwhe', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 19, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(166, 'mksw078', 'makemba sandwich', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 19, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(168, 'So789', 'Tasse Lait', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.30, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(169, 'zx856', 'Eau', 'images/590569e2c3b01752b.png', 2, 0, 0, 0.30, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(170, 'Xcv87', 'Sucre', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(174, 'Cpx78', 'Cappuccino', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(175, 'Brx897', 'Beurre sup.', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(178, 'Ftv23', 'Fut skol pression', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 30, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(179, 'Ftol789', 'Fut top limonade', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 30, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(180, 'Ftps870', 'Fut TEMBO pression', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 30, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(181, 'Lmtr789', 'Limonade Pression Gr', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(183, 'Bt123', 'BUFFET BASIC', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 22, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(184, 'BF8', 'BUFFET VIP', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 22, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(185, 'BF9', 'BUFFET PREMIUM', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 22, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(186, 'BF10', 'BUFFET 4', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 22, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(187, 'Ckt89', 'COCKTAIL ALC', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'Mesurette', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(188, 'Ckt90', 'COCKTAIL FRUITS', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'Mesurette', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(189, 'Ftcllg078', 'Fut top college', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 30, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(190, 'Tcpss078', 'Top pression', 'images/627569e2c1f40ccc0.png', 1, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(202, '123', 'Chicha', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 16, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(206, 'Barallu', 'Barquette alu', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 26, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(207, 'barplas', 'Barquette plastic', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 26, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(212, 'P203', 'Chocolat chaud', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.20, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(213, 'P206', 'Sup Fromage', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(214, 'P207', 'Rhum Arr. Passion', 'images/627569e2c1f40ccc0.png', 12, 0, 0, 3.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(215, 'P208', 'Rhum ArrangÃ©', 'images/627569e2c1f40ccc0.png', 12, 0, 0, 3.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(217, 'P210', '1/2 Samousa mixtes', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(218, 'P211', '1/2 Samusa Boeuf', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(219, 'P212', '1/2 Samusa Boeuf', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(221, 'C100', 'Salade cesar afro', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(222, 'P101', 'Pirogue concombre', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(223, 'P102', 'Coq au Vin', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(224, 'P103', 'Sup. Sauce champignons', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(225, 'P104', 'Tagliatelles Poulet Pesto', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(226, 'P104', 'Taglia Poulet Pesto', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 12, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(227, 'P105', 'Tarte spirale', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(228, 'P106', 'Galette d\'igname', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(229, 'P107', 'Flan courgette', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(234, 'C101', 'Bouillon sauvage', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(235, 'C102', 'Poulet arachide', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(236, 'C103', 'Boeuf epinard', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(237, 'C104', 'Ngulu sautÃ©', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(239, 'C105', 'Oeufs au plat', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(240, 'P113', 'Rhum Arr. Orange Canl.', 'images/590569e2c3b01752b.png', 1, 0, 0, 3.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(241, 'Vbh1523', 'Verre Very cerise', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(242, 'Vvfs0785', 'Verre Very framboise', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Mesurette', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(243, 'Vvml45236', 'Verre Very melon', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(244, 'Vvple078', 'Verre Very pamplemousse', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'Mesurette', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(245, 'Vvple079', 'Verre Very pamplemousse', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Mesurette', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(246, 'Vvps001', 'Verre Very passio', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(247, 'Vvpst001', 'Verre Very pasteque', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(248, 'Vvpc001', 'Verre Very peche', 'images/590569e2c3b01752b.png', 0.16, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(249, 'Ftc0789', 'Fut castel', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 30, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(250, 'Cppt0789', 'Castel pression Pt', 'images/590569e2c3b01752b.png', 0.0125, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Mesurette', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(251, 'Cpogr0788', 'Castel pression Gr', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(252, 'C106', 'Pondu Poisson', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(259, '0087c', 'Trio Panini', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 19, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(262, 'P117', 'Eau plastique', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(263, 'P118', 'Top Duo Trio', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(265, 'P012B', 'Verre vin blc ord', 'images/590569e2c3b01752b.png', 1, 0, 0, 2.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(266, 'P011B', 'Verre vin rouge ord', 'images/590569e2c3b01752b.png', 1, 0, 0, 2.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(267, 'cgr', 'Cigare', 'images/590569e2c3b01752b.png', 10, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(268, 'C064', 'Poulet entier BBQ', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(269, 'C065', '1/2 Poulet BBQ', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(270, 'C066', 'Sole braisÃ©e', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(271, 'C067', 'Capitaine BraisÃ©', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(272, 'C069', 'Ngulu sautÃ©', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(273, 'C070', 'Brochette de porc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(274, 'C071', 'Sceau beaufor', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(275, 'C071', 'Sceau beaufor', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(276, 'C072', 'Sceau beaufort', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(277, 'C073', 'Sceau beaufort', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(281, 'P300', 'Samusa 3 fromages', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(282, 'P301', 'Sam 3 from Veg', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(286, 'C305', 'Kivu Burger', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 356, 0, 1),
(287, 'A100', 'Baileys', 'images/590569e2c3b01752b.png', 0, 0, 0, 1.10, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(288, 'A101', 'Jameson', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(289, 'A103', 'J2L', 'images/590569e2c3b01752b.png', 0, 0, 0, 3.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(290, 'A104', 'Irish Coffee', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(291, 'P305', 'Poulet Crispy', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(292, 'P306', 'Sole MeuniÃ¨re', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(293, 'P307', 'Saucisse  Goma', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(294, 'C310', 'J2L', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(295, 'C306', 'Salade MotoMoto ya Zezie', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(296, 'C307', 'Eventail d\'Avocat', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(297, 'C308', 'Kivu Burger', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(298, 'C309', 'Sole MeuniÃ¨re', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(299, 'C310', 'Tian KembolisÃ©', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(301, 'C312', 'Pilons poulet', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(302, 'C315', 'Gin Tonic', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 1, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(303, 'A105', 'Basil Smash', 'images/590569e2c3b01752b.png', 0, 0, 0, 2.50, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(304, 'A107', 'Mojito', 'images/590569e2c3b01752b.png', 0, 0, 0, 2.50, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(305, 'A108', 'Kiev Mule', 'images/590569e2c3b01752b.png', 0, 0, 0, 2.50, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(306, 'A109', 'Spritz', 'images/590569e2c3b01752b.png', 0, 0, 0, 3.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(308, 'A112', 'Caesar', 'images/590569e2c3b01752b.png', 0, 0, 0, 1.50, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Paquet', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(309, 'M101', 'Makemba enfant', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 19, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(317, 'P409', 'Rhum ArrangÃ©', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(318, 'P410', 'Mojito Passion', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(319, 'P411', 'Virgin Mojito', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(320, 'P412', 'Virgin Mojito Passion', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(321, 'P415', 'GBS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(324, 'Pnch0123', 'PanachÃ© pt', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'cl', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(325, 'Pnch123', 'PanachÃ© Gd', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'cl', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(328, 'A215', 'Jameson', 'images/590569e2c3b01752b.png', 10, 0, 0, 2.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(329, 'C318', 'Gin Basil Smash', 'images/590569e2c3b01752b.png', 0, 0, 0, 2.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(330, 'CP01', 'Cocktail promo', 'images/590569e2c3b01752b.png', 0, 0, 0, 2.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(332, 'd600', 'Droit de bouchon', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 26, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(333, 'T1500', 'Top 1500', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(335, 'V559', 'Verre rosÃ©', 'images/590569e2c3b01752b.png', 1, 0, 0, 2.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(336, 'Sg559', 'Verre rosÃ©', 'images/590569e2c3b01752b.png', 0, 0, 0, 2.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Verre', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(337, 'Ab589', 'Anti moustiques', 'images/590569e2c3b01752b.png', 0, 0, 0, 1.65, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(338, 'Rt9856', 'Cozy samussas mixtes', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(339, 'Gh1597', 'Frites lycee', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 19, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(340, 'Vc4531', 'Verre Very cassis', 'images/590569e2c3b01752b.png', 1, 0, 0, 1.50, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'Verre', 0, 28, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(343, 'C111', 'LÃ©gumes a croquer', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(344, 'C112', 'Wok de LÃ©gumes', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(345, 'C113', 'Tomate Mozza', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(353, 'P255', 'Assiette apero', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(354, 'P256', 'Cocktail promo', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(356, 'P257', 'Biltong', 'images/590569e2c3b01752b.png', 0, 0, 0, 5.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(357, 'P258', 'Salade Composee Qui rit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(358, 'P259', 'Escalope Poulet + Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(359, 'P260', 'Canard bio +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(360, 'P261', 'Saucisse Goma +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(361, 'P262', 'Brochette Boeuf +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 356, 0, 1),
(362, 'P263', 'Carbonade +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(363, 'P264', 'T.Bone+Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 356, 0, 1),
(364, 'P265', 'Kivu Burger +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 356, 0, 1),
(365, 'P266', 'SautÃ© de porc +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(366, 'P267', 'PavÃ© de capitaine +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(367, 'P268', 'Sole meuniÃ¨re +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 40, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(368, 'P269', 'Poulet Atieke', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(369, 'P270', 'Rhum AmbrÃ© Kwilu', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(370, 'P271', 'Mon WE Ã  Rhum', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 3, 0, 0, 'Verre', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(371, 'P272', 'Salade des 4 Vents', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(372, 'P273', 'Wok lÃ©gumes poulet', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(373, 'P274', 'Plat du Jour Norm', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 17, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(374, 'P275', 'Plat du Jour +Acc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 17, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(379, 'P293', 'Mouchoirs en papier', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(380, 'P310', 'Raclette', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(381, 'P311', 'Fondue', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(383, 'P350', 'Tzatziki', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(384, 'P351', 'Friture de sambaza+salade', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(385, 'P352', 'Tarte de Toscane', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(386, 'P355', 'Donut', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(388, 'P357', 'Pizza jambo family', 'images/520569e1fd75d2cae.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(389, 'P358', 'Pizza jambo petit', 'images/3144369e1fd39b34dc.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(390, 'P359', 'Pizza marguerita family', 'images/2014169e1fbc812669.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(391, 'P340', 'Pizza jambo grand', 'images/1965069e1fd04d09c5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(396, 'P363', 'Pizza romain grand', 'images/1597869e1ff434b520.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(397, '364', 'Pizza special grand', 'images/2586569e2000156094.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(398, 'P390', 'pizza marguerita grand', 'images/812269e1fb2fd01ed.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(400, 'P391', 'Calamar en Beignet', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(402, 'P405', 'Steak Frites', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 356, 0, 1),
(403, 'P365', 'Pizza marguerita petit', 'images/3262669e1fb65e270c.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(407, 'P506', 'plat du jour +acc2$', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 17, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(408, 'P507', 'Plat du jour +Acc2,5$', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 17, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(409, 'P508', 'Plat du jour +Acc2,5$', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 17, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(410, 'P510', 'Sup. sauce poivre', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(414, 'P107', 'Vegan Burger', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 27, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 1),
(415, 'P100', 'Omelette boeuf from', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(416, 'P101', 'Omelette poulet from', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(417, 'KBV72', 'Burger Vegan', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(419, 'F001', 'Formule petit dej', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 22, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(420, 'P364', 'pizza montreux', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(423, 'CB', 'croissant', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(424, 'CB20', 'croissant', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(425, 'CB30', 'Croissant', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(426, 'B19', 'Croissant', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(427, 'CB23', 'croissant', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 14, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 1),
(433, 'A201', 'GORDON GINTONIC', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(434, 'A202', 'GORDON PINK', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(435, 'A203', 'VALT 69 COLA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(436, 'A204', 'SMIRNOFF ICE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(437, 'A20', 'GORDON Gin Tonic', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(441, 'C100', 'CoupÃ© ChÃ¨vre', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(442, 'C102', 'CoupÃ© Porc', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(443, 'C103', 'Pizza romain petit', 'images/1222769e1ff70781be.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(444, 'C104', 'Pizza romain family', 'images/1793669e1ffb57f079.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(446, 'C107', 'Chawarma viande', 'images/129369e1f796bc9c5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(447, 'C108', 'Saucisse Caravac', 'images/2923969e1f714b7cd5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(450, '0002', 'William verre', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'Mesurette', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(451, 'A006', 'VERRE WILLIAM', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'Mesurette', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(452, '0010', 'VERRE DE GRANT\'S', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'Mesurette', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(453, '0020', 'SMIROFF BLACK', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0);
INSERT INTO `stk_produit` (`idprod`, `code`, `designation`, `path_image`, `qte_min`, `qte_initial`, `qte_dispo`, `pa`, `pv`, `tva`, `monnaie`, `repas`, `statut`, `pseudo_supp`, `unite`, `ingredient`, `famille_id`, `image`, `code_id`, `nourriture`, `accomp`, `softplt`, `softbtl`, `legume`, `cuisso`, `soce`, `cond`, `vin`, `biere`, `pop`, `hotel_id`, `vendrerupturestk`, `syn`) VALUES
(454, '0021', 'SMIRNOFF ANANAS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(455, '0022', 'SMIRNOFF ORIGINAL', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(457, 'A0100', 'Verre Chivas', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'Mesurette', 0, 29, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(459, '0002254', 'testplat', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 1, 'unite', 0, 8, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(460, 'stt01', 'Salade de tomates au thon', 'images/2366569e1f69fa606c.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 7, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(461, 'cdfc', 'CrÃªpe Dinde FumÃ©e Champignons', 'images/2212869e1f59e9b4b0.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 42, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(462, 'csfro', 'CrÃªpe spÃ©ciale fromages', 'images/3270869e1f8b73da21.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 42, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(463, 'Crmo1', 'Crepe Mozzarella', 'images/765769e1f9f74b15c.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 42, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(464, 'cqp023', 'Crepe Quesadillas Poulet', 'images/2724669e1fa42eae66.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 42, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(465, 'PSP456', 'Pizza special petit', 'images/129569e2004feabd8.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(466, 'PSF4558', 'Pizza special family', 'images/2703669e20075a2e88.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(467, '7895', 'Pizza napolitaine grand', 'images/3160969e2045586469.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(468, '9999', 'Pizza napolitaine petit', 'images/838269e20478cd48d.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(469, '5448', 'Pizza napolitaine family', 'images/131169e20495e5182.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(470, '6554', 'Pizza vegetarienne', 'images/2058869e204c56ce21.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(471, '4785', 'Pizza vegetarienne petit', 'images/2206969e204e472661.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(472, '852', 'Pizza vegetarienne family', 'images/276269e204fdbd0c5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(473, 'PIZZA FAVO', 'PIZZA FAVORITA grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(474, 'PIZZA FAVO', 'PIZZA FAVORITA petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(475, 'PIZZA FAVO', 'PIZZA FAVORITA family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(476, 'PIZZA HERB', 'PIZZA HERBETO grand', 'images/2202369e2baac7b572.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(477, 'PIZZA HERB', 'PIZZA HERBETO petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(478, 'PIZZA HERB', 'PIZZA HERBETO family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(479, 'PIZZA HERM', 'PIZZA HERMANDO grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(480, 'PIZZA HERM', 'PIZZA HERMANDO petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(481, 'PIZZA HERM', 'PIZZA HERMANDO family', 'images/109469e2ba8f6da40.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(482, 'PIZZA VOLA', 'PIZZA VOLAILLE grand', 'images/799769e2ba59430dd.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(483, 'PIZZA VOLA', 'PIZZA VOLAILLE petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(484, 'PIZZA VOLA', 'PIZZA VOLAILLE family', 'images/978069e2ba3b86a16.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(485, 'PIZZA CARA', 'PIZZA CARAVAC grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(486, 'PIZZA CARA', 'PIZZA CARAVAC petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(487, 'PIZZA CARA', 'PIZZA CARAVAC family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(488, 'PIZZA 4 SA', 'PIZZA 4 SAISONS grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(489, 'PIZZA 4 SA', 'PIZZA 4 SAISONS petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(490, 'PIZZA 4 SA', 'PIZZA 4 SAISONS family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(491, 'PIZZA HAWA', 'PIZZA HAWAIENNE grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(492, 'PIZZA HAWA', 'PIZZA HAWAIENNE petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(493, 'PIZZA HAWA', 'PIZZA HAWAIENNE family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(494, 'PIZZA SPEC', 'PIZZA SPECIAL TROPICAL grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(495, 'PIZZA SPEC', 'PIZZA SPECIAL TROPICAL petit', 'images/1859169e2ba660c821.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(496, 'PIZZA SPEC', 'PIZZA SPECIAL TROPICAL family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(497, 'PIZZA CHOR', 'PIZZA CHORIZO grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(498, 'PIZZA CHOR', 'PIZZA CHORIZO petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(499, 'PIZZA CHOR', 'PIZZA CHORIZO family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(500, 'PIZZA 4 FR', 'PIZZA 4 FROMAGES grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(501, 'PIZZA 4 FR', 'PIZZA 4 FROMAGES petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(502, 'PIZZA 4 FR', 'PIZZA 4 FROMAGES family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(503, 'PIZZA DYNA', 'PIZZA DYNAMITO grand', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(504, 'PIZZA DYNA', 'PIZZA DYNAMITO petit', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(505, 'PIZZA DYNA', 'PIZZA DYNAMITO family', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(506, '445566', 'POULET ROTI ENTIER', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 43, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 0),
(507, 'POULETROTI', 'POULET ROTI MOITIE', 'images/617769e2b9972bd56.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 43, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(508, 'MAGRETDECA', 'MAGRET DE CANARD', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 43, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(509, 'COTEDEPORC', 'COTE DE PORC', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 44, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(510, 'EMINENCEDE', 'EMINCE DE BOEUF', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 44, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(511, 'BLANQUETTE', 'BLANQUETTE DE BOEUF', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 44, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(512, 'CAPITAINEB', 'CAPITAINE BEURRE BLANC', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 0),
(513, 'SOLE', 'SOLE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(514, 'CREVETTES', 'CREVETTES', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(515, '4455788', 'SPAGHETTI BOLOGNAISE', 'images/2515969e23323d4e5f.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 46, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(521, 'POISSON+PO', 'POISSON + PONDU', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(522, 'POISSONSAL', 'POISSON SALE + FUMBUA', 'images/166369e2ba1cd78f1.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(523, 'TILAPIABRA', 'TILAPIA BRAISE', 'images/3086869e2b950170e7.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(524, 'TILAPIAALA', 'TILAPIA A LA SAUCE', 'images/1935869e2b96d7e638.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(525, 'BITOYOSAUT', 'BITOYO SAUTE AUX OIGNONS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(526, 'ASSIETTEMI', 'ASSIETTE MIXTE (SAUCISSE, FROMAGE DE GOMA ET FRITE)', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(527, 'TILAPIABOU', 'TILAPIA BOUILLON (SAUCE ROUGE OU VERTE)', 'images/3027969e2b962cc320.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(528, 'BROCHETTED', 'BROCHETTE DE CHEVRE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(529, 'POULETMAYO', 'POULET MAYO ENTIER', 'images/1189269e2b9b66acd9.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 356, 0, 0),
(530, 'POULETMAYO', 'POULET MAYO MOITIE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(531, 'NTABANGAND', 'NTABA NGANDA', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(532, 'NGULUNGAND', 'NGULU NGANDA', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(533, 'MOUSSA+ANT', 'MOUSSA + ANTILOPE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(534, 'MABOKEDEPO', 'MABOKE DE POISSON', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(535, 'PONDU', 'PONDU', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(536, 'LEGUMEVERT', 'LEGUME VERT', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(537, 'FUMBWA', 'FUMBWA', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 47, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(538, 'FRITES', 'FRITES', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(539, 'FUFU', 'FUFU', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(540, 'RIZ', 'RIZ', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(541, 'BANANEPLAN', 'BANANE PLANTAIN', 'images/379269e27f2c1937b.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(542, 'BANANEVAPE', 'BANANE VAPEUR', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(543, 'BROWNIEAUC', 'BROWNIE AU CHEESECAKE OREO', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 13, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(544, 'BROWNIEAUC', 'BROWNIE AU CHEESECAKE SPECULOOS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 13, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(545, 'BROWNIEAUC', 'BROWNIE AU CHOCOLAT', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 13, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(546, 'ASSIETTEDE', 'ASSIETTE DE BROWNIE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 13, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(547, 'COUPEDEGLA', 'COUPE DE GLACE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(548, 'COUPESPECI', 'COUPE SPECIALE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(549, 'COUPEDEFRU', 'COUPE DE FRUITS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(550, 'COUPEOREO', 'COUPE OREO', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(551, 'COUPEGLACE', 'COUPE GLACE CHOCOLAT', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(552, 'COUPEGLACE', 'COUPE GLACE FRAISE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(553, 'COUPEGLACE', 'COUPE GLACE SPECULOOS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(554, 'LEBOLPATIS', 'LE BOL PATISSIER', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(555, 'LEPATISSIE', 'LE PATISSIER SPECULOOS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(556, 'GAUFRENATU', 'GAUFRE NATURE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 49, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(557, 'GAUFREAUXC', 'GAUFRE AUX CHOCOLATS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 49, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(558, 'GAUFREAUXS', 'GAUFRE AUX SPECULOOS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 49, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(559, 'GAUFREAUXF', 'GAUFRE AUX FRUITS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 49, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(560, 'GAUFREALAB', 'GAUFRE A LA BANANE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 49, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(561, 'CREPENATUR', 'CREPE NATURE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 50, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(562, 'CREPEAUXCH', 'CREPE AUX CHOCOLATS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 50, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(563, 'CREPEAUXBR', 'CREPE AUX BROWNIE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 50, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(564, 'CREPEAUXSP', 'CREPE AUX SPECULOOS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 50, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(565, 'CREPEOREO', 'CREPE OREO', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 50, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(566, 'CREPEAUXFR', 'CREPE AUX FRUITS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 50, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(567, 'PANCAKECRE', 'PANCAKE CREME CHEESE SPECULOOS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(568, 'PANCAKECRE', 'PANCAKE CREME CHEESE OREO', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(569, 'PANCAKEAUX', 'PANCAKE AUX FRUITS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(570, 'GG478', 'SANDWICH CLUB CESAR', 'images/2569169e241fcb576b.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 9, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(571, '448788', 'SANDWICH CLUB FROMAGE DINDE FUMEE', 'images/946469e2422eda9b1.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 9, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(572, '457855', 'MOET BRUT NECTAR', 'images/1619869e2b7eb7710b.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(573, 'MOETBRUTNE', 'MOET BRUT NECTAR', 'images/2435369e2b7e424e72.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(574, 'MOETBRUTRO', 'MOET BRUT ROSE', 'images/2995969e2b7f254629.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(575, 'MOETBRUTDE', 'MOET BRUT DEMI SEC', 'images/2150169e2b7db768d9.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(576, 'RUINARTBLA', 'RUINART BLANC DE BLANCS', 'images/1187369e2b6116788f.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(577, 'RUINARTBRU', 'RUINART BRUT', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(578, 'RUINARTROS', 'RUINART ROSE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(579, 'AYALLABLAN', 'AYALLA BLANC DE BLANCS', 'images/2668869e2a6f17dc77.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(580, 'AYALLABRUT', 'AYALLA BRUT', 'images/2449869e2a73df0ad7.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(581, 'VEUVECLICQ', 'VEUVE CLICQUOT BLANC DE BLANCS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(582, 'VEUVECLICQ', 'VEUVE CLICQUOT BRUT', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(583, 'LPBRUT', 'LP BRUT', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(584, 'LPROSE', 'LP ROSE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(585, 'LPGRANDECU', 'LP GRANDE CUVEE', 'images/1517169e2b88f2cd6e.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(586, 'LPDEMISEC', 'LP DEMI SEC', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 52, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(587, 'CAMUSXO', 'CAMUS XO', 'images/317469e2afc5b4c75.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(588, 'CAMUSVSOP', 'CAMUS VSOP', 'images/1145769e2af9cacd00.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(589, 'REMYMARTIN', 'REMY MARTIN XO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(590, 'REMYMARTIN', 'REMY MARTIN VSOP', 'images/2608869e2b7152d74a.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(591, 'HENNESSYXO', 'HENNESSY XO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(592, 'HENNESSYVS', 'HENNESSY VS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(593, 'MARTEILXO', 'MARTEIL XO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(594, 'MARTEILVS', 'MARTEIL VS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(595, 'COURVOISIE', 'COURVOISIER VSOP', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 53, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(596, 'PONGRAZBRU', 'PONGRAZ BRUT', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 2, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(597, 'PONGRAZROS', 'PONGRAZ ROSE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 2, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(598, 'CASTELICEB', 'CASTEL ICE BRUT', 'images/1331669e2b0f2eff07.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 2, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(599, 'CASTELICER', 'CASTEL ICE ROSE', 'images/2717369e2b1362e49f.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 2, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(600, 'CASTELCUVE', 'CASTEL CUVEE BLANC', 'images/2573369e2b0cec2191.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 2, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(601, 'PORTOCRUZR', 'PORTO CRUZ ROUGE', 'images/149769e2b6734f066.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(602, 'NEDERBURG', 'NEDERBURG', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(603, 'LABAUME', 'LA BAUME', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(604, 'CASTELSAUV', 'CASTEL SAUVIGNON', 'images/356569e2b16550d52.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(605, 'CASTELSIER', 'CASTEL SIERRA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(606, 'CASTELBORD', 'CASTEL BORDEAUX', 'images/213269e2b0c1c18d5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(607, 'CASTELPINO', 'CASTEL PINOT NOIR', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(608, 'DONPABLO', 'DON PABLO', 'images/318469e2b21f15dfa.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(609, 'CHATEAUNEU', 'CHATEAU NEUF DE PAPE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(610, 'MOUTONCADE', 'MOUTON CADET SAINT EMILIO', 'images/349369e2b77c461b7.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(611, 'MOUTONCADE', 'MOUTON CADET SELECT', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(612, 'MOUTONCADE', 'MOUTON CADET ROUGE', 'images/1778669e2b784b7b6a.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 54, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(613, 'PORTOCRUZB', 'PORTO CRUZ BLANC', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 55, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(614, 'NEDERBURG', 'NEDERBURG', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 55, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(615, 'MOUTONCADE', 'MOUTON CADET', 'images/2897169e2b78bbe3fd.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 55, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(616, 'CHABLIS', 'CHABLIS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 55, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(617, 'CASTELSOVI', 'CASTEL SOVIGNON', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 55, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(618, 'CASTELSIER', 'CASTEL SIERRIA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 55, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(619, 'CASTELBARO', 'CASTEL BARON D\'ARIGNAC', 'images/298369e2b07b1f68c.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 55, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(620, 'PINOTGRIGI', 'PINOT GRIGIO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 56, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(621, 'BAROND\'ARI', 'BARON D\'ARIGNAC', 'images/1779469e2ad5f6ff3f.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 56, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(622, 'JONNYWALKE', 'JONNY WALKER BLUE LABEL', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(623, 'JONNYWALKE', 'JONNY WALKER GOLD LABEL', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(624, 'JONNYWALKE', 'JONNY WALKER DOUBLE BLACK', 'images/2803969e2b3d3ddc77.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(625, 'JONNYWALKE', 'JONNY WALKER BLACK LABEL', 'images/3266869e2b3aeaca47.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(626, 'JONNYWALKE', 'JONNY WALKER RED LABEL', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(627, 'CHIVAS21AN', 'CHIVAS 21 ANS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(628, 'CHIVAS18AN', 'CHIVAS 18 ANS', 'images/1023469e2b1a509e42.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(629, 'CHIVAS15AN', 'CHIVAS 15 ANS', 'images/2153869e2b196aad11.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(630, 'CHIVASMOIN', 'CHIVAS MOINS DE 12 ANS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(631, 'GLENFIDDIC', 'GLENFIDDICH 18 ANS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(632, 'GLENFIDDIC', 'GLENFIDDICH 15 ANS', 'images/92969e2b2f7b603f.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(633, 'GLENFIDDIC', 'GLENFIDDICH 12 ANS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(634, 'JACKDANIEL', 'JACK DANIELS HONEY', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(635, 'JACKDANIEL', 'JACK DANIEL WHISKY', 'images/1367869e2b381bacd0.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(636, 'JB', 'JB', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(637, 'VODKAABSOL', 'VODKA ABSOLUT', 'images/1544269e2b4c2984f6.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(638, 'VODKAGREYG', 'VODKA GREY GOOSE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(639, 'VODKABEVEL', 'VODKA BEVELDER', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(640, 'JAMSON', 'JAMSON', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(641, 'WILLIAMS', 'WILLIAMS', 'images/1455769e2b49a008e3.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(642, 'BALLANTINE', 'BALLANTINES BALANTINAISE', 'images/1053069e2ad0b27aa3.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(643, 'BALLANTINE', 'BALLANTINES BALANTINAISE 12 ans', 'images/401969e2ad1b3fed8.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(644, 'BALLANTINE', 'BALLANTINES BALANTINAISE 17 ans', 'images/1918269e2ad28d6c14.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 57, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(645, 'BACARDIBIA', 'BACARDI BIANCO', 'images/1016169e2a75cce6b7.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(646, 'BACARDIBLA', 'BACARDI BLACK', 'images/1239369e2a7784089d.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(647, 'BACARDIBLO', 'BACARDI BLONDE', 'images/117469e2acad7771b.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(648, 'NEGRITABLA', 'NEGRITA BLACK', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(649, 'NEGRITABLO', 'NEGRITA BLONDE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(650, 'GINSAPHIRB', 'GIN SAPHIR BOMBAY', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(651, 'GINGORDON', 'GIN GORDON', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(652, 'TEKILAPATR', 'TEKILA PATRON', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(653, 'TEKILACAMI', 'TEKILA CAMINO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 58, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(654, 'BELLAYS', 'BELLAYS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(655, 'AMARULA', 'AMARULA', 'images/586969e2a697ede18.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(656, 'MALIBU', 'MALIBU', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(657, 'CHERUDAN\'S', 'CHERUDAN\'S', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(658, 'KAHLUA', 'KAHLUA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(659, 'CAMPARI', 'CAMPARI', 'images/1354569e2af678f6e1.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(660, 'GRANDMARIN', 'GRAND MARINIER', 'images/1888669e2b31de58c1.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(661, 'COINTREQUE', 'COINTREQUE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 59, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(662, 'MARTINIBIA', 'MARTINI BIANCO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 60, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(663, 'MARTINIROS', 'MARTINI ROSSO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 60, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(664, 'MARTINIROS', 'MARTINI ROSATO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 60, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(665, 'BORABORA', 'BORA BORA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 61, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(666, 'VIRGINMOJI', 'VIRGIN MOJITO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 61, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(667, 'PLANTERPIN', 'PLANTER PINCH', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 61, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(668, 'BILABUM', 'BILABUM', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 61, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(669, 'PEACHKISS', 'PEACH KISS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 61, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(670, 'VIRGINCOLA', 'VIRGIN COLADA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 61, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(671, 'SUNSET', 'SUN SET', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 61, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(672, 'CARAVACGIN', 'CARAVAC GINGER', 'images/1406369e2b055be058.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(673, 'SEXONTHEBE', 'SEX ON THE BEACH', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(674, 'LONGISLAND', 'LONG ISLAND ICE TEA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(675, 'PINACOLADA', 'PINA COLADA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(676, 'MARGARITA', 'MARGARITA', 'images/1304969e2b8d0e95b2.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(677, 'PORNSTAR', 'PORN STAR', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(678, 'PINKLADY', 'PINK LADY', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(679, 'MOJITO', 'MOJITO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(680, 'MISSBELLIN', 'MISS BELLINI', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(681, 'KIRROYAL', 'KIR ROYAL', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(682, 'DAIQUIRI', 'DAIQUIRI', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(683, 'MANGODAIQU', 'MANGO DAIQUIRI', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(684, 'STRAWBERRY', 'STRAWBERRY', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 62, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(685, 'MILKSHAKEC', 'MILKSHAKE CHOCOLAT', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(686, 'MILKSHAKEV', 'MILKSHAKE VANILLE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(687, 'MILKSHAKEF', 'MILKSHAKE FRAISE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(688, 'MILKSHAKEB', 'MILKSHAKE BANANE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(689, 'MILKSHAKEC', 'MILKSHAKE COOKIES', 'images/1740969e2b840b1d31.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(690, 'MILKSHAKEO', 'MILKSHAKE OREO', 'images/2935069e2b867ce1eb.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(691, 'MILKSHAKEL', 'MILKSHAKE LEA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(692, 'MILKSHAKEP', 'MILKSHAKE PISTACHE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(693, 'MILKSHAKES', 'MILKSHAKE SPECULOOS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(694, 'MILKSHAKEK', 'MILKSHAKE KINDER', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 63, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(695, 'FROZENBANA', 'FROZEN BANANE', 'images/2458469e2b2cc15dba.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 64, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(696, 'FROZENFRAI', 'FROZEN FRAISE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 64, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(697, 'FROZENFRAM', 'FROZEN FRAMBOISE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 64, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(698, 'FROZENPASS', 'FROZEN PASSION', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 64, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(699, 'ESPRESSO', 'ESPRESSO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(700, 'DOUBLEESPR', 'DOUBLE ESPRESSO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(701, 'ESPRESSOMA', 'ESPRESSO MACCHIATO', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(702, 'CAPPUCCINO', 'CAPPUCCINO', 'images/2255169e2b03079e84.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(703, 'CAFEAMERIC', 'CAFE AMERICANO', 'images/2574769e2aeba8274f.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(704, 'CAFELATTEC', 'CAFE LATTE CARAMEL', 'images/3228469e2aecdcb8c5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(705, 'CHOCOLATCH', 'CHOCOLAT CHAUD', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(706, 'CHOCOLATCH', 'CHOCOLAT CHAUD NOIR', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(707, 'CAFEMOCHAC', 'CAFE MOCHA CHOCOLAT BLANC', 'images/15469e2aef931c00.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(708, 'CAFETURC', 'CAFE TURC', 'images/3114469e2af41c7ed3.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(709, 'THE', 'THE', 'images/1398969e2b5a4ca5f3.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 65, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(710, 'LATTEGLACE', 'LATTE GLACE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(711, 'LATTEGLACE', 'LATTE GLACE AU CARAMEL', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(712, 'AMERICANOG', 'AMERICANO GLACE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(713, 'CAPPUCCINO', 'CAPPUCCINO GLACE', 'images/1428669e2b04059ca6.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0);
INSERT INTO `stk_produit` (`idprod`, `code`, `designation`, `path_image`, `qte_min`, `qte_initial`, `qte_dispo`, `pa`, `pv`, `tva`, `monnaie`, `repas`, `statut`, `pseudo_supp`, `unite`, `ingredient`, `famille_id`, `image`, `code_id`, `nourriture`, `accomp`, `softplt`, `softbtl`, `legume`, `cuisso`, `soce`, `cond`, `vin`, `biere`, `pop`, `hotel_id`, `vendrerupturestk`, `syn`) VALUES
(714, 'LATTEGLACE', 'LATTE GLACE AU CHOCOLAT', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(715, 'LATTEGLACE', 'LATTE GLACE AU SPECULOOS', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(716, 'CAFEMOCHAG', 'CAFE MOCHA GLACE AU CHOCOLAT', 'images/2401169e2af1cb39f5.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(717, 'CAFEMOCHAG', 'CAFE MOCHA GLACE CHOCOLAT BLANC', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 66, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(718, 'THEGLACEAU', 'THE GLACE AU CITRON', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(719, 'THEGLACEAL', 'THE GLACE A LA FRAISE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(720, 'THEGLACEAL', 'THE GLACE A LA PECHE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(721, 'JUSANANAS', 'JUS ANANAS', 'images/73069e2b400ab83a.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(722, 'JUSPASTEQU', 'JUS PASTEQUE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(723, 'JUSPOMME', 'JUS POMME', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(724, 'JUSFRAISE', 'JUS FRAISE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(725, 'JUSD\'ORANG', 'JUS D\'ORANGE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(726, 'JUSD\'ORANG', 'JUS D\'ORANGE A LA FRAISE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(727, 'JUSDEFRAIS', 'JUS DE FRAISE & CITRON', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(728, 'JUSD\'ORANG', 'JUS D\'ORANGE & CITRON', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 67, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(729, 'COCA', 'COCA', 'images/2424369e2b1ccba578.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(730, 'FANTA', 'FANTA', 'images/2500369e2b2ae4b896.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(731, 'SPRITE', 'SPRITE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(732, 'VITAL\'O', 'VITAL\'O', 'images/2971169e2b4eeb4056.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(733, 'MALTINA', 'MALTINA', 'images/2195269e2b8ae959d8.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(734, 'XXL', 'XXL', 'images/2987669e2b4643162d.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(735, 'ENERGIEMAL', 'ENERGIE MALT', 'images/3220069e2b2697192d.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(736, 'TOP', 'TOP', 'images/1142069e2b522bcd30.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(737, 'SPA', 'SPA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 68, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(738, 'SWISTA', 'SWISTA', 'images/2333169e2b547aa3c6.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 68, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(739, 'EVIAN', 'EVIAN', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 68, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(740, 'PERRIER', 'PERRIER', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 68, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(741, 'PRIMUS', 'PRIMUS', 'images/1497069e2b6d2d225f.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(742, 'HEINEKEN', 'HEINEKEN LOCAL', 'images/331469e52e18a7657.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'piece', 0, 3, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(743, 'MUTZIG', 'MUTZIG', 'images/3111269e2b7ac232df.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(744, 'TEMBO', 'TEMBO', 'images/2125969e2b5727bb2f.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(745, 'BEAUFORT', 'BEAUFORT', 'images/2417169e2ae007e50a.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(746, 'CASTELBEER', 'CASTEL BEER', 'images/2610869e2b09eac004.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(747, 'NKOYBLONDE', 'NKOY BLONDE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(748, 'NKOYBLACK', 'NKOY BLACK', 'images/3034469e2b74045f6a.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(749, 'SIMBA', 'SIMBA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(750, 'TEMBOKATAN', 'TEMBO KATANGA', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(751, '33EXPORT', '33 EXPORT', 'images/198769e2a64f012c9.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(752, 'DOPEL', 'DOPEL', 'images/714569e2b246c3114.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(753, 'LEGEND', 'LEGEND', 'images/535169e2b8febf202.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(754, 'LEFFEBRUNE', 'LEFFE BRUNE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(755, 'LEFFEBLOND', 'LEFFE BLONDE', 'images/590569e2c3b01752b.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(756, 'SAVANNA', 'SAVANNA', 'images/3213469e2b644eac43.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(757, 'HEINEKEN', 'HEINEKEN', 'images/420669e2b359f1131.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(758, 'BAVARIAMAL', 'BAVARIA MALT', 'images/705569e2ad8dc7321.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(759, 'BAVARIAPOM', 'BAVARIA POMME', 'images/2699269e2add40fd8b.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(760, 'REDBULL', 'RED BULL', 'images/1693969e2b6f4323f4.jpg', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(761, '778888', 'POMME FRT', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(762, '888444', 'POMME SAUTEE', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(763, '11111111', 'PONDU', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(764, '54456666', 'LEGUME VERT', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(765, 'QSDDHHHFSH', 'HARICOTS', 'images/627569e2c1f40ccc0.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(766, 'T09887', 'TONIC', 'images/1068669e50a34535ac.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(767, '454544', 'TEMBO PETIT', 'images/1061169e50a27653f4.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 0, 'piece', 0, 3, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(768, 'RRTTTT55555', 'Chawarma poulet', 'images/1478369e515920c608.png', 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 10, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(769, 'BLD0004', 'BILLARD', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 71, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(770, 'D1990', 'dodo', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 3, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(771, 'd1999', 'rolly', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 0, 0, 1, 'piece', 0, 3, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0),
(772, '5777I8', 'GGGGG', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'CDF', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stk_report`
--

DROP TABLE IF EXISTS `stk_report`;
CREATE TABLE IF NOT EXISTS `stk_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qte_initial_save` float NOT NULL,
  `dte_report` date NOT NULL,
  `dte_report_time` datetime NOT NULL,
  `produit_id` int(10) NOT NULL,
  `idmvt` int(11) DEFAULT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `produit_id` (`produit_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `idmvt` (`idmvt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stk_situation_report`
--

DROP TABLE IF EXISTS `stk_situation_report`;
CREATE TABLE IF NOT EXISTS `stk_situation_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_effectue_date` date NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stk_sous_famille`
--

DROP TABLE IF EXISTS `stk_sous_famille`;
CREATE TABLE IF NOT EXISTS `stk_sous_famille` (
  `id_s_fam` int(11) NOT NULL AUTO_INCREMENT,
  `des` varchar(250) DEFAULT NULL,
  `famille` int(11) DEFAULT NULL,
  `pseudo_supp` int(11) DEFAULT '0',
  `genre` int(11) DEFAULT '0',
  `classer` int(11) DEFAULT '100',
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_s_fam`),
  KEY `famille` (`famille`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_sous_famille`
--

INSERT INTO `stk_sous_famille` (`id_s_fam`, `des`, `famille`, `pseudo_supp`, `genre`, `classer`, `hotel_id`, `syn`) VALUES
(1, 'BIERRES', 27, 1, 0, 100, 356, 1),
(2, 'VINS MOUSSES', 27, 0, 0, 100, 356, 1),
(3, 'ALCOOLS BTL', 27, 0, 0, 100, 356, 1),
(4, 'HOT', 27, 0, 0, 100, 356, 1),
(5, 'SOFTS DRINKS', 27, 0, 0, 100, 356, 1),
(6, 'PRESSIONS', 27, 0, 0, 100, 356, 1),
(7, 'ENTREES', 29, 0, 0, 100, 356, 1),
(8, 'PLATS', 29, 0, 0, 100, 356, 1),
(9, 'SANDWICHS', 30, 0, 0, 100, 356, 1),
(10, 'SNACKS', 29, 0, 0, 100, 356, 1),
(12, 'PASTAS', 29, 0, 0, 100, 356, 1),
(13, 'DESSERTS  ET SUCRERIE', 29, 0, 0, 100, 356, 1),
(14, 'P\'TIT DEJ', 29, 0, 0, 100, 356, 1),
(16, 'CIGARETTES', 31, 0, 0, 100, 356, 1),
(17, 'PLAT DU JOUR', 32, 0, 0, 100, 356, 1),
(18, 'ETUDIANT', 30, 0, 0, 100, 356, 1),
(19, 'ACC SANDW', 30, 1, 0, 100, 356, 1),
(20, 'BOISSON SANDWICH', 27, 1, 0, 100, 356, 1),
(22, 'BUFFET', 29, 0, 0, 100, 356, 1),
(23, 'COCKTAILS', 27, 0, 0, 100, 356, 1),
(26, 'BARQUETTES', 35, 0, 0, 100, 356, 1),
(27, 'VEGETARIENS', 29, 0, 0, 100, 356, 1),
(28, 'VINS VERRES', 27, 0, 0, 100, 356, 1),
(29, 'ALCOOLS VERRES', 27, 0, 0, 100, 356, 1),
(30, 'FUT', 36, 0, 0, 100, 356, 1),
(33, 'KEMBO BBQ', 29, 1, 0, 100, 356, 1),
(34, 'ACC', 29, 0, 0, 100, 356, 1),
(36, 'Plats', 38, 1, 0, 100, 356, 1),
(37, 'Accompagnements', 38, 1, 0, 100, 356, 1),
(38, 'Samusas', 38, 1, 0, 100, 356, 1),
(39, 'Sandwichs', 38, 1, 0, 100, 356, 1),
(40, 'PLATS + ACC', 29, 1, 0, 100, 356, 1),
(41, 'PIZZA', 29, 0, 0, 100, 356, 1),
(42, 'CREPES SALEES', 29, 0, 0, 100, 356, 0),
(43, 'VOLAILLES', 29, 0, 0, 100, 356, 0),
(44, 'VIANDES', 29, 0, 0, 100, 356, 0),
(45, 'POISSONS ET FRUITS DE MER', 29, 0, 0, 100, 356, 0),
(46, 'PATES', 29, 0, 0, 100, 356, 0),
(47, 'PLATS CONGOLAIS', 29, 0, 0, 100, 356, 0),
(48, 'BOL ET COUPES', 29, 0, 0, 100, 356, 0),
(49, 'GAUFFRES', 29, 0, 0, 100, 356, 0),
(50, 'CREPES SUCRES', 29, 0, 0, 100, 356, 0),
(51, 'PANCAKES', 29, 0, 0, 100, 356, 0),
(52, 'CHAMPAGNES', 27, 0, 0, 100, 356, 0),
(53, 'COGNACS', 27, 0, 0, 100, 356, 0),
(54, 'VINS ROUGES', 27, 0, 0, 100, 356, 0),
(55, 'VINS BLANCS', 27, 0, 0, 100, 356, 0),
(56, 'VINS ROSES', 27, 0, 0, 100, 356, 0),
(57, 'WHISKYS', 27, 0, 0, 100, 356, 0),
(58, 'RHUMS', 27, 0, 0, 100, 356, 0),
(59, 'LIQUEURS', 27, 0, 0, 100, 356, 0),
(60, 'MARTINI', 27, 0, 0, 100, 356, 0),
(61, 'MOCKTELS', 27, 0, 0, 100, 356, 0),
(62, 'CLASSIQUES SIGNATURES', 27, 0, 0, 100, 356, 0),
(63, 'MILKSHAKES', 27, 0, 0, 100, 356, 0),
(64, 'FROZENS', 27, 0, 0, 100, 356, 0),
(65, 'CAFES CHAUDS', 27, 0, 0, 100, 356, 0),
(66, 'CAFES GLACES', 27, 0, 0, 100, 356, 0),
(67, 'BOISSONS FROIDES ET THES', 27, 0, 0, 100, 356, 0),
(68, 'EAUX MINERALES', 27, 0, 0, 100, 356, 0),
(70, 'BIERRES IMPORTEES', 27, 0, 0, 100, 356, 0),
(71, 'JEUX', 29, 0, 0, 100, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stk__mouvement`
--

DROP TABLE IF EXISTS `stk__mouvement`;
CREATE TABLE IF NOT EXISTS `stk__mouvement` (
  `idmvt` int(11) NOT NULL AUTO_INCREMENT,
  `indice_bs` int(11) DEFAULT '1',
  `type` varchar(50) DEFAULT NULL,
  `motif` varchar(30) DEFAULT NULL,
  `num_bon` varchar(50) DEFAULT NULL,
  `qte_entree` float DEFAULT '0',
  `qte_sortie` float DEFAULT '0',
  `qte_declasse` float DEFAULT '0',
  `qte_report` float DEFAULT '0',
  `dte_appro` date DEFAULT NULL,
  `dte_appro_heure` datetime DEFAULT NULL,
  `depot` varchar(245) DEFAULT NULL,
  `appro_depot` int(11) DEFAULT '0',
  `en_vente` int(11) DEFAULT '1',
  `produit_id` int(11) DEFAULT NULL,
  `fiche_id` int(10) DEFAULT NULL,
  `motif_sortie_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `depot_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idmvt`),
  KEY `produit_id` (`produit_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `depot_id` (`depot_id`),
  KEY `fiche_id` (`fiche_id`),
  KEY `motif_sortie_id` (`motif_sortie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk__mouvement`
--

INSERT INTO `stk__mouvement` (`idmvt`, `indice_bs`, `type`, `motif`, `num_bon`, `qte_entree`, `qte_sortie`, `qte_declasse`, `qte_report`, `dte_appro`, `dte_appro_heure`, `depot`, `appro_depot`, `en_vente`, `produit_id`, `fiche_id`, `motif_sortie_id`, `user_id`, `depot_id`, `hotel_id`, `syn`) VALUES
(16, 1, 'appro', NULL, NULL, 12, 0, 0, 12, '2026-04-20', '2026-04-20 18:27:40', NULL, 0, 1, 751, 29, 6, 502, 121, 356, 0),
(17, 1, 'appro', NULL, NULL, 20, 0, 0, 20, '2026-04-20', '2026-04-20 18:27:40', NULL, 0, 1, 745, 29, 6, 502, 121, 356, 0),
(18, 1, 'appro', NULL, NULL, 20, 0, 0, 20, '2026-04-20', '2026-04-20 18:27:40', NULL, 0, 1, 746, 29, 6, 502, 121, 356, 0),
(19, 1, 'appro', NULL, NULL, 24, 0, 0, 24, '2026-04-20', '2026-04-20 18:27:40', NULL, 0, 1, 767, 29, 6, 502, 121, 356, 0),
(20, 1, 'sortie', NULL, NULL, 0, 0, 4, 20, '2026-04-20', '2026-04-20 18:32:22', NULL, 0, 1, 767, 30, NULL, 502, 121, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `suivifactures`
--

DROP TABLE IF EXISTS `suivifactures`;
CREATE TABLE IF NOT EXISTS `suivifactures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dte_time` datetime DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `agent` varchar(245) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  `prix` decimal(65,10) DEFAULT '0.0000000000',
  `monnaie` varchar(10) DEFAULT 'CDF',
  `repas` int(10) DEFAULT '0',
  `produit_id` int(11) DEFAULT NULL,
  `description` varchar(245) DEFAULT NULL,
  `facture_id` int(11) DEFAULT NULL,
  `suppr` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `facture_id` (`facture_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `suivifactures`
--

INSERT INTO `suivifactures` (`id`, `dte_time`, `heure`, `agent`, `qte`, `prix`, `monnaie`, `repas`, `produit_id`, `description`, `facture_id`, `suppr`, `syn`) VALUES
(11, '2026-04-16 12:43:44', '12:43:44', 'Admin', 0, '0.0000000000', 'CDF', NULL, NULL, NULL, NULL, 1, 0),
(12, '2026-04-16 12:43:46', '12:43:46', 'Admin', 0, '0.0000000000', 'CDF', NULL, NULL, NULL, NULL, 1, 0),
(13, '2026-04-16 12:46:29', '12:46:29', 'Admin', 0, '0.0000000000', 'CDF', NULL, NULL, NULL, NULL, 1, 0),
(83, '2026-04-19 12:07:58', '12:07:58', ' TONY MBAYI', 1, '25000.0000000000', 'CDF', 1, 530, '', 25, 0, 0),
(84, '2026-04-19 12:07:58', '12:07:58', ' TONY MBAYI', 1, '5000.0000000000', 'CDF', 1, 538, '', 25, 0, 0),
(85, '2026-04-19 12:07:58', '12:07:58', ' TONY MBAYI', 1, '28000.0000000000', 'CDF', 1, 532, '', 25, 0, 0),
(86, '2026-04-19 12:07:58', '12:07:58', ' TONY MBAYI', 1, '5000.0000000000', 'CDF', 1, 542, '', 25, 0, 0),
(87, '2026-04-19 12:07:58', '12:07:58', ' TONY MBAYI', 1, '23000.0000000000', 'CDF', 0, 671, '', 25, 0, 0),
(88, '2026-04-19 12:07:58', '12:07:58', ' TONY MBAYI', 1, '19500.0000000000', 'CDF', 0, 685, '', 25, 0, 0),
(89, '2026-04-19 12:13:14', '12:13:14', ' TRYPHENE KAZADI', 2, '3500.0000000000', 'CDF', 0, 736, '', 26, 0, 0),
(90, '2026-04-19 12:13:14', '12:13:14', ' TRYPHENE KAZADI', 2, '3500.0000000000', 'CDF', 0, 734, '', 26, 0, 0),
(91, '2026-04-19 12:13:14', '12:13:14', ' TRYPHENE KAZADI', 4, '10000.0000000000', 'CDF', 1, 446, '', 26, 0, 0),
(92, '2026-04-19 12:14:50', '12:14:50', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 732, '', 27, 0, 0),
(93, '2026-04-19 12:14:50', '12:14:50', ' TRYPHENE KAZADI', 1, '10000.0000000000', 'CDF', 1, 446, '', 27, 0, 0),
(94, '2026-04-19 12:33:27', '12:33:27', ' TONY MBAYI', 2, '3500.0000000000', 'CDF', 0, 730, '', 28, 0, 0),
(95, '2026-04-19 12:33:27', '12:33:27', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 729, '', 28, 0, 0),
(96, '2026-04-19 12:33:27', '12:33:27', ' TONY MBAYI', 2, '3500.0000000000', 'CDF', 0, 732, '', 28, 0, 0),
(97, '2026-04-19 12:33:27', '12:33:27', ' TONY MBAYI', 2, '25000.0000000000', 'CDF', 1, 530, '', 28, 0, 0),
(98, '2026-04-19 12:33:27', '12:33:27', ' TONY MBAYI', 2, '2500.0000000000', 'CDF', 0, 738, '', 28, 0, 0),
(99, '2026-04-19 12:36:35', '12:36:35', ' TONY MBAYI', 1, '6500.0000000000', 'CDF', 0, 745, '', 29, 0, 0),
(100, '2026-04-19 12:36:35', '12:36:35', ' TONY MBAYI', 1, '30000.0000000000', 'CDF', 1, 512, 'FRITES(1)', 29, 0, 0),
(101, '2026-04-19 12:43:17', '12:43:17', ' TONY MBAYI', 1, '23000.0000000000', 'CDF', 0, 671, '', 25, 0, 0),
(102, '2026-04-19 12:44:28', '12:44:28', ' TONY MBAYI', 1, '10000.0000000000', 'CDF', 1, 446, '', 30, 0, 0),
(103, '2026-04-19 12:44:28', '12:44:28', ' TONY MBAYI', 1, '8000.0000000000', 'CDF', 0, 759, '', 30, 0, 0),
(104, '2026-04-19 12:47:57', '12:47:57', ' TONY MBAYI', 2, '2500.0000000000', 'CDF', 0, 738, '', 28, 0, 0),
(105, '2026-04-19 12:49:49', '12:49:49', ' TRYPHENE KAZADI', 0, '10000.0000000000', 'CDF', 1, 446, '', 27, 1, 0),
(106, '2026-04-19 12:49:49', '12:49:49', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 732, '', 27, 0, 0),
(107, '2026-04-19 13:30:49', '13:30:49', ' TRYPHENE KAZADI', 1, '8000.0000000000', 'CDF', 0, 759, '', 31, 0, 0),
(108, '2026-04-19 13:30:49', '13:30:49', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 730, '', 31, 0, 0),
(109, '2026-04-19 13:30:49', '13:30:49', ' TRYPHENE KAZADI', 1, '8000.0000000000', 'CDF', 0, 756, '', 31, 0, 0),
(110, '2026-04-19 13:31:37', '13:31:37', ' TRYPHENE KAZADI', 1, '17000.0000000000', 'CDF', 0, 722, '', 31, 0, 0),
(111, '2026-04-19 13:32:53', '13:32:53', ' TONY MBAYI', 1, '2500.0000000000', 'CDF', 0, 738, '', 29, 0, 0),
(112, '2026-04-19 13:38:41', '13:38:41', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 729, '', 32, 0, 0),
(113, '2026-04-19 13:38:41', '13:38:41', ' TONY MBAYI', 1, '10000.0000000000', 'CDF', 1, 446, '', 32, 0, 0),
(114, '2026-04-19 12:40:23', '12:40:23', 'Admin', -1, '17600000.0000000000', 'CDF', 0, 756, '', 31, 1, 0),
(115, '2026-04-19 13:48:17', '13:48:17', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 729, '', 31, 0, 0),
(116, '2026-04-19 13:50:01', '13:50:01', ' TRYPHENE KAZADI', 1, '25000.0000000000', 'CDF', 1, 507, '', 31, 0, 0),
(117, '2026-04-19 13:50:01', '13:50:01', ' TRYPHENE KAZADI', 1, '28000.0000000000', 'CDF', 1, 532, '', 31, 0, 0),
(118, '2026-04-19 13:50:01', '13:50:01', ' TRYPHENE KAZADI', 1, '36500.0000000000', 'CDF', 1, 523, '', 31, 0, 0),
(119, '2026-04-19 14:07:38', '14:07:38', ' TONY MBAYI', 1, '10000.0000000000', 'CDF', 1, 446, '', 32, 0, 0),
(120, '2026-04-19 14:07:38', '14:07:38', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 729, '', 32, 0, 0),
(121, '2026-04-19 14:30:03', '14:30:03', ' SIMEON KANYINDA', 1, '3500.0000000000', 'CDF', 0, 730, '', 33, 0, 0),
(122, '2026-04-19 14:35:48', '14:35:48', ' ESPERANCE BAHITAPE', 1, '6500.0000000000', 'CDF', 0, 746, '', 34, 0, 0),
(123, '2026-04-19 14:35:48', '14:35:48', ' ESPERANCE BAHITAPE', 1, '3500.0000000000', 'CDF', 0, 730, '', 34, 0, 0),
(124, '2026-04-19 14:58:43', '14:58:43', ' TRYPHENE KAZADI', 2, '2500.0000000000', 'CDF', 0, 738, '', 31, 0, 0),
(125, '2026-04-19 15:00:00', '15:00:00', ' SIMEON KANYINDA', 1, '3500.0000000000', 'CDF', 0, 731, '', 33, 0, 0),
(126, '2026-04-19 15:17:41', '15:17:41', ' ESPERANCE BAHITAPE', 1, '3500.0000000000', 'CDF', 0, 730, '', 34, 0, 0),
(127, '2026-04-19 15:17:41', '15:17:41', ' ESPERANCE BAHITAPE', 2, '6500.0000000000', 'CDF', 0, 746, '', 34, 0, 0),
(128, '2026-04-19 15:17:41', '15:17:41', ' ESPERANCE BAHITAPE', 1, '2500.0000000000', 'CDF', 0, 738, '', 34, 0, 0),
(129, '2026-04-19 15:24:38', '15:24:38', ' ESPERANCE BAHITAPE', 1, '3500.0000000000', 'CDF', 0, 732, '', 35, 0, 0),
(130, '2026-04-19 15:30:09', '15:30:09', ' ESPERANCE BAHITAPE', 4, '3500.0000000000', 'CDF', 0, 730, '', 35, 0, 0),
(131, '2026-04-19 15:31:30', '15:31:30', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 747, '', 36, 0, 0),
(132, '2026-04-19 15:31:30', '15:31:30', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 745, '', 36, 0, 0),
(133, '2026-04-19 15:31:30', '15:31:30', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 732, '', 36, 0, 0),
(134, '2026-04-19 15:31:30', '15:31:30', ' GEMIMA KIBIKULA', 1, '2500.0000000000', 'CDF', 0, 738, '', 36, 0, 0),
(135, '2026-04-19 15:33:56', '15:33:56', ' SIMEON KANYINDA', 1, '30000.0000000000', 'CDF', 1, 531, '', 37, 0, 0),
(136, '2026-04-19 15:33:56', '15:33:56', ' SIMEON KANYINDA', 1, '5000.0000000000', 'CDF', 1, 536, '', 37, 0, 0),
(137, '2026-04-19 15:33:56', '15:33:56', ' SIMEON KANYINDA', 1, '138000.0000000000', 'CDF', 0, 657, '', 37, 0, 0),
(138, '2026-04-19 15:37:11', '15:37:11', ' TRYPHENE KAZADI', 1, '2500.0000000000', 'CDF', 0, 738, '', 38, 0, 0),
(139, '2026-04-19 15:40:43', '15:40:43', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 745, '', 36, 0, 0),
(140, '2026-04-19 15:40:43', '15:40:43', ' GEMIMA KIBIKULA', 2, '6500.0000000000', 'CDF', 0, 747, '', 36, 0, 0),
(141, '2026-04-19 15:40:43', '15:40:43', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 736, '', 36, 0, 0),
(142, '2026-04-19 15:40:43', '15:40:43', ' GEMIMA KIBIKULA', 11, '3500.0000000000', 'CDF', 0, 730, '', 36, 0, 0),
(143, '2026-04-19 15:40:43', '15:40:43', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 729, '', 36, 0, 0),
(144, '2026-04-19 15:40:43', '15:40:43', ' GEMIMA KIBIKULA', 2, '6500.0000000000', 'CDF', 0, 746, '', 36, 0, 0),
(145, '2026-04-19 15:41:42', '15:41:42', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 732, '', 36, 0, 0),
(146, '2026-04-19 15:43:39', '15:43:39', ' GEMIMA KIBIKULA', 0, '6500.0000000000', 'CDF', 0, 745, '', 36, 1, 0),
(147, '2026-04-19 15:44:49', '15:44:49', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 736, '', 39, 0, 0),
(148, '2026-04-19 15:47:15', '15:47:15', ' SIMEON KANYINDA', 1, '2500.0000000000', 'CDF', 0, 738, '', 37, 0, 0),
(149, '2026-04-19 15:48:39', '15:48:39', ' ESPERANCE BAHITAPE', 3, '3500.0000000000', 'CDF', 0, 730, '', 35, 0, 0),
(150, '2026-04-19 15:53:47', '15:53:47', ' ESPERANCE BAHITAPE', 2, '10000.0000000000', 'CDF', 1, 53, '', 35, 0, 0),
(151, '2026-04-19 15:53:47', '15:53:47', ' ESPERANCE BAHITAPE', 2, '10000.0000000000', 'CDF', 1, 446, '', 35, 0, 0),
(152, '2026-04-19 15:53:47', '15:53:47', ' ESPERANCE BAHITAPE', 1, '5000.0000000000', 'CDF', 1, 538, '', 35, 0, 0),
(153, '2026-04-19 15:56:46', '15:56:46', ' TRYPHENE KAZADI', 3, '3500.0000000000', 'CDF', 0, 730, '', 40, 0, 0),
(154, '2026-04-19 16:06:29', '16:06:29', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 730, '', 36, 0, 0),
(155, '2026-04-19 16:06:29', '16:06:29', ' GEMIMA KIBIKULA', 2, '2500.0000000000', 'CDF', 0, 738, '', 36, 0, 0),
(156, '2026-04-19 16:06:29', '16:06:29', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 753, '', 36, 0, 0),
(157, '2026-04-19 16:10:41', '16:10:41', ' ESPERANCE BAHITAPE', 3, '10000.0000000000', 'CDF', 1, 446, '', 35, 0, 0),
(158, '2026-04-19 16:11:45', '16:11:45', ' SIMEON KANYINDA', 2, '3500.0000000000', 'CDF', 0, 730, '', 41, 0, 0),
(159, '2026-04-19 16:13:42', '16:13:42', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 746, '', 36, 0, 0),
(160, '2026-04-19 16:18:02', '16:18:02', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 730, '', 42, 0, 0),
(161, '2026-04-19 16:18:41', '16:18:41', ' TRYPHENE KAZADI', 1, '10000.0000000000', 'CDF', 1, 446, '', 42, 0, 0),
(162, '2026-04-19 16:24:52', '16:24:52', ' SIMEON KANYINDA', 1, '36000.0000000000', 'CDF', 1, 398, '', 43, 0, 0),
(163, '2026-04-19 16:24:52', '16:24:52', ' SIMEON KANYINDA', 5, '3500.0000000000', 'CDF', 0, 730, '', 43, 0, 0),
(164, '2026-04-19 16:24:52', '16:24:52', ' SIMEON KANYINDA', 1, '6500.0000000000', 'CDF', 0, 746, '', 43, 0, 0),
(165, '2026-04-19 16:24:52', '16:24:52', ' SIMEON KANYINDA', 1, '3500.0000000000', 'CDF', 0, 729, '', 43, 0, 0),
(166, '2026-04-19 16:24:52', '16:24:52', ' SIMEON KANYINDA', 2, '5000.0000000000', 'CDF', 1, 538, '', 43, 0, 0),
(167, '2026-04-19 16:28:55', '16:28:55', ' ESPERANCE BAHITAPE', 1, '6500.0000000000', 'CDF', 0, 746, '', 34, 0, 0),
(168, '2026-04-19 16:28:55', '16:28:55', ' ESPERANCE BAHITAPE', 1, '5000.0000000000', 'CDF', 1, 538, '', 34, 0, 0),
(169, '2026-04-19 16:31:41', '16:31:41', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 734, '', 44, 0, 0),
(170, '2026-04-19 16:31:41', '16:31:41', ' TRYPHENE KAZADI', 2, '2500.0000000000', 'CDF', 0, 738, '', 44, 0, 0),
(171, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 729, '', 36, 0, 0),
(172, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 12, '3500.0000000000', 'CDF', 0, 730, '', 36, 0, 0),
(173, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 2, '3500.0000000000', 'CDF', 0, 732, '', 36, 0, 0),
(174, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 3, '2500.0000000000', 'CDF', 0, 738, '', 36, 0, 0),
(175, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 2, '6500.0000000000', 'CDF', 0, 745, '', 36, 0, 0),
(176, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 3, '6500.0000000000', 'CDF', 0, 746, '', 36, 0, 0),
(177, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 3, '6500.0000000000', 'CDF', 0, 747, '', 36, 0, 0),
(178, '2026-04-19 16:37:27', '16:37:27', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 753, '', 36, 0, 0),
(179, '2026-04-19 16:39:28', '16:39:28', ' ESPERANCE BAHITAPE', 1, '20000.0000000000', 'CDF', 1, 447, '', 34, 0, 0),
(180, '2026-04-19 16:43:33', '16:43:33', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 746, '', 44, 0, 0),
(181, '2026-04-19 16:51:56', '16:51:56', ' ESPERANCE BAHITAPE', 1, '3500.0000000000', 'CDF', 0, 730, '', 35, 0, 0),
(182, '2026-04-19 16:57:37', '16:57:37', ' GEMIMA KIBIKULA', -2, '3500.0000000000', 'CDF', 0, 732, '', 36, 1, 0),
(183, '2026-04-19 16:57:37', '16:57:37', ' GEMIMA KIBIKULA', -3, '2500.0000000000', 'CDF', 0, 738, '', 36, 1, 0),
(184, '2026-04-19 16:57:37', '16:57:37', ' GEMIMA KIBIKULA', -1, '6500.0000000000', 'CDF', 0, 753, '', 36, 1, 0),
(185, '2026-04-19 17:00:06', '17:00:06', ' TRYPHENE KAZADI', 1, '2500.0000000000', 'CDF', 0, 738, '', 44, 0, 0),
(186, '2026-04-19 17:00:06', '17:00:06', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 745, '', 44, 0, 0),
(187, '2026-04-19 17:05:55', '17:05:55', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 730, '', 44, 0, 0),
(188, '2026-04-19 17:10:05', '17:10:05', ' ESPERANCE BAHITAPE', -1, '10000.0000000000', 'CDF', 1, 53, '', 35, 1, 0),
(189, '2026-04-19 17:10:05', '17:10:05', ' ESPERANCE BAHITAPE', -1, '3500.0000000000', 'CDF', 0, 730, '', 35, 1, 0),
(190, '2026-04-19 17:15:21', '17:15:21', ' SIMEON KANYINDA', 3, '36500.0000000000', 'CDF', 1, 523, '', 45, 0, 0),
(191, '2026-04-19 17:15:21', '17:15:21', ' SIMEON KANYINDA', 1, '23000.0000000000', 'CDF', 0, 671, '', 45, 0, 0),
(192, '2026-04-19 17:15:21', '17:15:21', ' SIMEON KANYINDA', 2, '34500.0000000000', 'CDF', 0, 673, '', 45, 0, 0),
(193, '2026-04-19 17:16:55', '17:16:55', ' SIMEON KANYINDA', 3, '19500.0000000000', 'CDF', 0, 686, '', 45, 0, 0),
(194, '2026-04-19 17:18:20', '17:18:20', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 730, '', 46, 0, 0),
(195, '2026-04-19 17:19:28', '17:19:28', ' SIMEON KANYINDA', 2, '3500.0000000000', 'CDF', 0, 730, '', 47, 0, 0),
(196, '2026-04-19 17:23:55', '17:23:55', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 730, '', 48, 0, 0),
(197, '2026-04-19 17:25:23', '17:25:23', ' SIMEON KANYINDA', 1, '6500.0000000000', 'CDF', 0, 746, '', 49, 0, 0),
(198, '2026-04-19 17:25:23', '17:25:23', ' SIMEON KANYINDA', 1, '2500.0000000000', 'CDF', 0, 738, '', 49, 0, 0),
(199, '2026-04-19 17:29:43', '17:29:43', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 730, '', 50, 0, 0),
(200, '2026-04-19 17:33:08', '17:33:08', ' SIMEON KANYINDA', 2, '23000.0000000000', 'CDF', 0, 671, '', 45, 0, 0),
(201, '2026-04-19 17:33:44', '17:33:44', ' SIMEON KANYINDA', 1, '19500.0000000000', 'CDF', 0, 686, '', 45, 0, 0),
(202, '2026-04-19 17:35:35', '17:35:35', ' GEMIMA KIBIKULA', 2, '6500.0000000000', 'CDF', 0, 751, '', 51, 0, 0),
(203, '2026-04-19 17:43:23', '17:43:23', ' TRYPHENE KAZADI', 1, '28500.0000000000', 'CDF', 1, 486, '', 46, 0, 0),
(204, '2026-04-19 17:54:37', '17:54:37', ' ESPERANCE BAHITAPE', 1, '6500.0000000000', 'CDF', 0, 747, '', 52, 0, 0),
(205, '2026-04-19 17:55:49', '17:55:49', ' ESPERANCE BAHITAPE', 2, '10000.0000000000', 'CDF', 1, 446, '', 52, 0, 0),
(206, '2026-04-19 17:57:04', '17:57:04', ' ESPERANCE BAHITAPE', 2, '5000.0000000000', 'CDF', 0, 767, '', 52, 0, 0),
(207, '2026-04-19 17:58:04', '17:58:04', ' TRYPHENE KAZADI', 2, '2500.0000000000', 'CDF', 0, 738, '', 44, 0, 0),
(208, '2026-04-19 17:58:04', '17:58:04', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 766, '', 44, 0, 0),
(209, '2026-04-19 18:06:15', '18:06:15', ' TONY MBAYI', 2, '3500.0000000000', 'CDF', 0, 730, '', 53, 0, 0),
(210, '2026-04-19 18:06:15', '18:06:15', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 729, '', 53, 0, 0),
(211, '2026-04-19 18:07:37', '18:07:37', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 746, '', 54, 0, 0),
(212, '2026-04-19 18:07:37', '18:07:37', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 745, '', 54, 0, 0),
(213, '2026-04-19 18:07:37', '18:07:37', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 730, '', 54, 0, 0),
(214, '2026-04-19 18:10:05', '18:10:05', ' SIMEON KANYINDA', 1, '3500.0000000000', 'CDF', 0, 736, '', 45, 0, 0),
(215, '2026-04-19 18:13:16', '18:13:16', ' ESPERANCE BAHITAPE', 1, '23000.0000000000', 'CDF', 0, 667, '', 55, 0, 0),
(216, '2026-04-19 18:13:16', '18:13:16', ' ESPERANCE BAHITAPE', 1, '34500.0000000000', 'CDF', 0, 673, '', 55, 0, 0),
(217, '2026-04-19 18:14:07', '18:14:07', ' ESPERANCE BAHITAPE', 1, '5000.0000000000', 'CDF', 0, 767, '', 52, 0, 0),
(218, '2026-04-19 18:19:38', '18:19:38', ' GEMIMA KIBIKULA', 2, '28500.0000000000', 'CDF', 1, 486, '', 56, 0, 0),
(219, '2026-04-19 18:19:38', '18:19:38', ' GEMIMA KIBIKULA', 1, '10000.0000000000', 'CDF', 1, 446, '', 56, 0, 0),
(220, '2026-04-19 18:19:38', '18:19:38', ' GEMIMA KIBIKULA', 1, '3500.0000000000', 'CDF', 0, 729, '', 56, 0, 0),
(221, '2026-04-19 18:19:38', '18:19:38', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 746, '', 56, 0, 0),
(222, '2026-04-19 18:20:38', '18:20:38', ' GEMIMA KIBIKULA', 1, '19500.0000000000', 'CDF', 0, 686, '', 56, 0, 0),
(223, '2026-04-19 18:22:43', '18:22:43', ' ESPERANCE BAHITAPE', 1, '2500.0000000000', 'CDF', 0, 738, '', 52, 0, 0),
(224, '2026-04-19 18:26:25', '18:26:25', ' SIMEON KANYINDA', 2, '19500.0000000000', 'CDF', 0, 685, '', 57, 0, 0),
(225, '2026-04-19 18:29:25', '18:29:25', ' TRYPHENE KAZADI', 2, '28000.0000000000', 'CDF', 1, 532, '', 58, 0, 0),
(226, '2026-04-19 18:29:25', '18:29:25', ' TRYPHENE KAZADI', 2, '5000.0000000000', 'CDF', 1, 536, '', 58, 0, 0),
(227, '2026-04-19 18:29:25', '18:29:25', ' TRYPHENE KAZADI', 1, '5000.0000000000', 'CDF', 1, 541, '', 58, 0, 0),
(228, '2026-04-19 18:31:55', '18:31:55', ' TRYPHENE KAZADI', 1, '18500.0000000000', 'CDF', 0, 749, '', 58, 0, 0),
(229, '2026-04-19 18:31:55', '18:31:55', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 753, '', 58, 0, 0),
(230, '2026-04-19 18:36:19', '18:36:19', ' TRYPHENE KAZADI', 2, '3500.0000000000', 'CDF', 0, 729, '', 59, 0, 0),
(231, '2026-04-19 18:41:11', '18:41:11', ' TONY MBAYI', 2, '6500.0000000000', 'CDF', 0, 747, '', 60, 0, 0),
(232, '2026-04-19 18:41:11', '18:41:11', ' TONY MBAYI', 1, '6500.0000000000', 'CDF', 0, 751, '', 60, 0, 0),
(233, '2026-04-19 18:41:11', '18:41:11', ' TONY MBAYI', 1, '5000.0000000000', 'CDF', 0, 767, '', 60, 0, 0),
(234, '2026-04-19 18:41:11', '18:41:11', ' TONY MBAYI', 1, '19500.0000000000', 'CDF', 0, 685, '', 60, 0, 0),
(235, '2026-04-19 18:41:11', '18:41:11', ' TONY MBAYI', 1, '6500.0000000000', 'CDF', 0, 741, '', 60, 0, 0),
(236, '2026-04-19 18:41:11', '18:41:11', ' TONY MBAYI', 1, '6500.0000000000', 'CDF', 0, 753, '', 60, 0, 0),
(237, '2026-04-19 18:44:46', '18:44:46', ' GEMIMA KIBIKULA', 1, '20000.0000000000', 'CDF', 1, 447, '', 50, 0, 0),
(238, '2026-04-19 18:45:43', '18:45:43', ' TRYPHENE KAZADI', 2, '10000.0000000000', 'CDF', 1, 446, '', 59, 0, 0),
(239, '2026-04-19 18:47:13', '18:47:13', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 729, '', 61, 0, 0),
(240, '2026-04-19 18:47:13', '18:47:13', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 734, '', 61, 0, 0),
(241, '2026-04-19 18:48:37', '18:48:37', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 729, '', 46, 0, 0),
(242, '2026-04-19 18:51:06', '18:51:06', ' ESPERANCE BAHITAPE', 2, '10000.0000000000', 'CDF', 1, 446, '', 62, 0, 0),
(243, '2026-04-19 18:51:56', '18:51:56', ' ESPERANCE BAHITAPE', 1, '6500.0000000000', 'CDF', 0, 745, '', 62, 0, 0),
(244, '2026-04-19 18:51:56', '18:51:56', ' ESPERANCE BAHITAPE', 1, '3500.0000000000', 'CDF', 0, 736, '', 62, 0, 0),
(245, '2026-04-19 18:52:25', '18:52:25', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 747, '', 48, 0, 0),
(246, '2026-04-19 18:57:02', '18:57:02', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 747, '', 63, 0, 0),
(247, '2026-04-19 19:00:46', '19:00:46', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 746, '', 56, 0, 0),
(248, '2026-04-19 19:00:46', '19:00:46', ' GEMIMA KIBIKULA', 1, '2500.0000000000', 'CDF', 0, 738, '', 56, 0, 0),
(249, '2026-04-19 19:00:46', '19:00:46', ' GEMIMA KIBIKULA', 2, '6500.0000000000', 'CDF', 0, 753, '', 56, 0, 0),
(250, '2026-04-19 19:03:26', '19:03:26', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 729, '', 60, 0, 0),
(251, '2026-04-19 19:03:26', '19:03:26', ' TONY MBAYI', 2, '3500.0000000000', 'CDF', 0, 736, '', 60, 0, 0),
(252, '2026-04-19 19:04:04', '19:04:04', ' SIMEON KANYINDA', 1, '20000.0000000000', 'CDF', 1, 447, '', 57, 0, 0),
(253, '2026-04-19 19:08:10', '19:08:10', ' TONY MBAYI', 3, '6500.0000000000', 'CDF', 0, 747, '', 64, 0, 0),
(254, '2026-04-19 19:08:10', '19:08:10', ' TONY MBAYI', 2, '6500.0000000000', 'CDF', 0, 751, '', 64, 0, 0),
(255, '2026-04-19 19:08:10', '19:08:10', ' TONY MBAYI', 1, '8000.0000000000', 'CDF', 0, 756, '', 64, 0, 0),
(256, '2026-04-19 19:08:10', '19:08:10', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 729, '', 64, 0, 0),
(257, '2026-04-19 19:08:10', '19:08:10', ' TONY MBAYI', 1, '8000.0000000000', 'CDF', 0, 759, '', 64, 0, 0),
(258, '2026-04-19 19:08:10', '19:08:10', ' TONY MBAYI', 2, '5000.0000000000', 'CDF', 0, 767, '', 64, 0, 0),
(259, '2026-04-19 19:10:22', '19:10:22', ' TONY MBAYI', 1, '55000.0000000000', 'CDF', 0, 641, '', 65, 0, 0),
(260, '2026-04-19 19:12:35', '19:12:35', ' SIMEON KANYINDA', 8, '2500.0000000000', 'CDF', 0, 738, '', 45, 0, 0),
(261, '2026-04-19 19:19:27', '19:19:27', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 746, '', 66, 0, 0),
(262, '2026-04-19 19:19:27', '19:19:27', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 745, '', 66, 0, 0),
(263, '2026-04-19 19:19:27', '19:19:27', ' TRYPHENE KAZADI', 1, '3500.0000000000', 'CDF', 0, 729, '', 66, 0, 0),
(264, '2026-04-19 19:25:01', '19:25:01', ' TRYPHENE KAZADI', 1, '18500.0000000000', 'CDF', 0, 749, '', 58, 0, 0),
(265, '2026-04-19 19:25:01', '19:25:01', ' TRYPHENE KAZADI', 1, '6500.0000000000', 'CDF', 0, 746, '', 58, 0, 0),
(266, '2026-04-19 19:26:10', '19:26:10', ' TRYPHENE KAZADI', 1, '10000.0000000000', 'CDF', 1, 446, '', 58, 0, 0),
(267, '2026-04-19 19:37:09', '19:37:09', ' GEMIMA KIBIKULA', 4, '8000.0000000000', 'CDF', 0, 759, '', 67, 0, 0),
(268, '2026-04-19 19:37:09', '19:37:09', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 748, '', 67, 0, 0),
(269, '2026-04-19 19:42:41', '19:42:41', ' GEMIMA KIBIKULA', 1, '50000.0000000000', 'CDF', 1, 529, '', 67, 0, 0),
(270, '2026-04-19 19:42:41', '19:42:41', ' GEMIMA KIBIKULA', 1, '5000.0000000000', 'CDF', 1, 538, '', 67, 0, 0),
(271, '2026-04-19 19:47:27', '19:47:27', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 747, '', 68, 0, 0),
(272, '2026-04-19 19:50:05', '19:50:05', ' TONY MBAYI', 1, '6500.0000000000', 'CDF', 0, 751, '', 69, 0, 0),
(273, '2026-04-19 19:50:05', '19:50:05', ' TONY MBAYI', 2, '3500.0000000000', 'CDF', 0, 729, '', 69, 0, 0),
(274, '2026-04-19 19:59:15', '19:59:15', ' TONY MBAYI', 1, '6500.0000000000', 'CDF', 0, 753, '', 58, 0, 0),
(275, '2026-04-19 20:22:07', '20:22:07', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 748, '', 67, 0, 0),
(276, '2026-04-19 20:22:07', '20:22:07', ' GEMIMA KIBIKULA', 4, '8000.0000000000', 'CDF', 0, 759, '', 67, 0, 0),
(277, '2026-04-19 20:26:22', '20:26:22', ' TONY MBAYI', 1, '55000.0000000000', 'CDF', 0, 641, '', 70, 0, 0),
(278, '2026-04-19 20:43:44', '20:43:44', ' SIMEON KANYINDA', 1, '6500.0000000000', 'CDF', 1, 742, '', 58, 0, 0),
(279, '2026-04-19 20:48:26', '20:48:26', ' GEMIMA KIBIKULA', 1, '6500.0000000000', 'CDF', 0, 753, '', 71, 0, 0),
(280, '2026-04-19 20:51:15', '20:51:15', ' GEMIMA KIBIKULA', 1, '10000.0000000000', 'CDF', 1, 768, '', 71, 0, 0),
(281, '2026-04-19 21:15:05', '21:15:05', ' SIMEON KANYINDA', 1, '6500.0000000000', 'CDF', 1, 742, '', 58, 0, 0),
(282, '2026-04-20 11:40:39', '11:40:39', ' SIMEON KANYINDA', 1, '70000.0000000000', 'CDF', 0, 655, '', 72, 0, 0),
(283, '2026-04-20 11:40:39', '11:40:39', ' SIMEON KANYINDA', 1, '6500.0000000000', 'CDF', 0, 751, '', 72, 0, 0),
(284, '2026-04-20 11:40:39', '11:40:39', ' SIMEON KANYINDA', 1, '15000.0000000000', 'CDF', 0, 712, '', 72, 0, 0),
(285, '2026-04-20 11:41:28', '11:41:28', ' SIMEON KANYINDA', 1, '8000.0000000000', 'CDF', 0, 758, '', 72, 0, 0),
(286, '2026-04-20 11:41:28', '11:41:28', ' SIMEON KANYINDA', 1, '8000.0000000000', 'CDF', 0, 759, '', 72, 0, 0),
(287, '2026-04-20 10:42:02', '10:42:02', 'JOE LOPOKO', -1, '17600000.0000000000', 'CDF', 0, 759, '', 72, 1, 0),
(288, '2026-04-20 10:44:32', '10:44:32', 'JOE LOPOKO', -1, '17600000.0000000000', 'CDF', 0, 758, '', 72, 1, 0),
(289, '2026-04-20 10:44:54', '10:44:54', 'JOE LOPOKO', NULL, NULL, 'CDF', NULL, NULL, 'annulation', 72, 0, 0),
(290, '2026-04-20 11:47:29', '11:47:29', ' SABRINA SELE', 1, '6500.0000000000', 'CDF', 0, 751, '', 73, 0, 0),
(291, '2026-04-20 11:47:29', '11:47:29', ' SABRINA SELE', 1, '70000.0000000000', 'CDF', 0, 655, '', 73, 0, 0),
(292, '2026-04-20 11:47:29', '11:47:29', ' SABRINA SELE', 1, '15000.0000000000', 'CDF', 0, 712, '', 73, 0, 0),
(293, '2026-04-20 11:47:29', '11:47:29', ' SABRINA SELE', 1, '18500.0000000000', 'CDF', 1, 546, '', 73, 0, 0),
(294, '2026-04-20 11:47:29', '11:47:29', ' SABRINA SELE', 1, '33000.0000000000', 'CDF', 1, 526, '', 73, 0, 0),
(295, '2026-04-20 12:09:33', '12:09:33', ' ESPERANCE BAHITAPE', 1, '10000.0000000000', 'CDF', 1, 768, '', 74, 0, 0),
(296, '2026-04-20 12:10:57', '12:10:57', ' ESPERANCE BAHITAPE', 1, '28500.0000000000', 'CDF', 1, 486, '', 74, 0, 0),
(297, '2026-04-20 12:15:53', '12:15:53', ' ESPERANCE STELLA BAHITAPE', 3, '3500.0000000000', 'CDF', 0, 729, '', 74, 0, 0),
(298, '2026-04-20 11:16:11', '11:16:11', 'Admin', NULL, NULL, 'CDF', NULL, NULL, 'annulation', 73, 0, 0),
(299, '2026-04-20 12:18:40', '12:18:40', ' ESPERANCE STELLA BAHITAPE', 1, '10000.0000000000', 'CDF', 1, 768, '', 75, 0, 0),
(300, '2026-04-20 12:34:37', '12:34:37', ' TONY MBAYI', 1, '10000.0000000000', 'CDF', 1, 768, '', 76, 0, 0),
(301, '2026-04-20 12:34:37', '12:34:37', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 766, '', 76, 0, 0),
(302, '2026-04-20 12:34:37', '12:34:37', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 734, '', 76, 0, 0),
(303, '2026-04-20 12:36:00', '12:36:00', ' TONY MBAYI', 1, '10000.0000000000', 'CDF', 1, 768, '', 77, 0, 0),
(304, '2026-04-20 12:36:00', '12:36:00', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 730, '', 77, 0, 0),
(305, '2026-04-20 14:53:26', '14:53:26', ' TONY MBAYI', 1, '2500.0000000000', 'CDF', 0, 738, '', 78, 0, 0),
(306, '2026-04-20 14:57:00', '14:57:00', ' TONY MBAYI', 2, '6500.0000000000', 'CDF', 0, 752, '', 79, 0, 0),
(307, '2026-04-20 14:57:00', '14:57:00', ' TONY MBAYI', 1, '8000.0000000000', 'CDF', 0, 759, '', 79, 0, 0),
(308, '2026-04-20 14:57:00', '14:57:00', ' TONY MBAYI', 1, '50000.0000000000', 'CDF', 1, 529, '', 79, 0, 0),
(309, '2026-04-20 14:57:00', '14:57:00', ' TONY MBAYI', 1, '5000.0000000000', 'CDF', 1, 541, '', 79, 0, 0),
(310, '2026-04-20 15:23:45', '15:23:45', ' TONY MBAYI', 2, '5000.0000000000', 'CDF', 0, 767, '', 79, 0, 0),
(311, '2026-04-20 15:26:02', '15:26:02', ' TONY MBAYI', 1, '10000.0000000000', 'CDF', 1, 53, '', 80, 0, 0),
(312, '2026-04-20 17:05:15', '17:05:15', ' TONY MBAYI', 2, '8000.0000000000', 'CDF', 0, 759, '', 79, 0, 0),
(313, '2026-04-20 17:05:15', '17:05:15', ' TONY MBAYI', 1, '6500.0000000000', 'CDF', 0, 746, '', 79, 0, 0),
(314, '2026-04-20 17:05:15', '17:05:15', ' TONY MBAYI', 2, '2500.0000000000', 'CDF', 0, 738, '', 79, 0, 0),
(315, '2026-04-20 17:45:22', '17:45:22', ' ESPERANCE STELLA BAHITAPE', 1, '15000.0000000000', 'CDF', 1, 460, '', 81, 0, 0),
(316, '2026-04-20 17:45:22', '17:45:22', ' ESPERANCE STELLA BAHITAPE', 1, '20000.0000000000', 'CDF', 1, 447, '', 81, 0, 0),
(317, '2026-04-20 17:45:22', '17:45:22', ' ESPERANCE STELLA BAHITAPE', 1, '5000.0000000000', 'CDF', 1, 538, '', 81, 0, 0),
(318, '2026-04-20 17:49:34', '17:49:34', ' GEMIMA KIBIKULA', 1, '8000.0000000000', 'CDF', 0, 759, '', 82, 0, 0),
(319, '2026-04-20 18:17:22', '18:17:22', ' ESPERANCE STELLA BAHITAPE', 3, '2500.0000000000', 'CDF', 1, 769, '', 83, 0, 0),
(320, '2026-04-20 18:24:21', '18:24:21', ' GEMIMA KIBIKULA', 2, '3500.0000000000', 'CDF', 0, 734, '', 84, 0, 0),
(321, '2026-04-20 19:10:20', '19:10:20', ' TONY MBAYI', 1, '8000.0000000000', 'CDF', 0, 756, '', 85, 0, 0),
(322, '2026-04-20 19:10:20', '19:10:20', ' TONY MBAYI', 1, '5000.0000000000', 'CDF', 0, 767, '', 85, 0, 0),
(323, '2026-04-20 19:10:20', '19:10:20', ' TONY MBAYI', 1, '3500.0000000000', 'CDF', 0, 729, '', 85, 0, 0),
(324, '2026-04-20 19:10:20', '19:10:20', ' TONY MBAYI', 1, '2500.0000000000', 'CDF', 0, 738, '', 85, 0, 0),
(325, '2026-04-20 19:12:22', '19:12:22', ' ESPERANCE STELLA BAHITAPE', 1, '33000.0000000000', 'CDF', 1, 526, '', 86, 0, 0),
(326, '2026-04-20 19:12:22', '19:12:22', ' ESPERANCE STELLA BAHITAPE', 1, '15000.0000000000', 'CDF', 1, 460, '', 86, 0, 0),
(327, '2026-04-20 19:12:22', '19:12:22', ' ESPERANCE STELLA BAHITAPE', 1, '30000.0000000000', 'CDF', 1, 512, 'FRITES(1)', 86, 0, 0),
(328, '2026-04-20 19:12:22', '19:12:22', ' ESPERANCE STELLA BAHITAPE', 1, '25000.0000000000', 'CDF', 1, 507, '', 86, 0, 0),
(329, '2026-04-20 19:13:29', '19:13:29', ' GEMIMA KIBIKULA', 1, '10000.0000000000', 'CDF', 1, 768, '', 87, 0, 0),
(330, '2026-04-20 19:14:37', '19:14:37', ' GEMIMA KIBIKULA', 1, '10000.0000000000', 'CDF', 1, 768, '', 88, 0, 0),
(331, '2026-04-20 19:24:07', '19:24:07', ' TONY MBAYI', 1, '30000.0000000000', 'CDF', 1, 521, '', 89, 0, 0),
(332, '2026-04-20 19:24:07', '19:24:07', ' TONY MBAYI', 1, '5000.0000000000', 'CDF', 1, 541, '', 89, 0, 0),
(333, '2026-04-20 19:24:07', '19:24:07', ' TONY MBAYI', 1, '8000.0000000000', 'CDF', 0, 759, '', 89, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `system_users`
--

DROP TABLE IF EXISTS `system_users`;
CREATE TABLE IF NOT EXISTS `system_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `membership` varchar(30) DEFAULT NULL,
  `user_status` int(11) DEFAULT '0',
  `user_position` int(11) DEFAULT '0',
  `user_avarta` varbinary(100) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  `last_login_date` date DEFAULT NULL,
  `last_login_ip` varchar(30) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `system_users`
--

INSERT INTO `system_users` (`userid`, `name`, `email`, `phone`, `username`, `password`, `membership`, `user_status`, `user_position`, `user_avarta`, `date_created`, `last_updated`, `last_login_date`, `last_login_ip`, `syn`) VALUES
(1, NULL, NULL, NULL, 'admin', '$2a$08$kUH3Ko5akg0aO1BWP37C5eLzO2f0QqxsED9r8yLsJAbgJpXSS2JTKkUH3Ko5akg0aO1BWP37C5e', NULL, 1, 1, NULL, NULL, NULL, '2019-06-20', '::1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `system_users3`
--

DROP TABLE IF EXISTS `system_users3`;
CREATE TABLE IF NOT EXISTS `system_users3` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `membership` varchar(30) DEFAULT NULL,
  `user_status` int(11) DEFAULT '0',
  `user_position` int(11) DEFAULT '0',
  `user_avarta` varbinary(100) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `last_updated` date DEFAULT NULL,
  `last_login_date` date DEFAULT NULL,
  `last_login_ip` varchar(30) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `system_users3`
--

INSERT INTO `system_users3` (`userid`, `name`, `email`, `phone`, `username`, `password`, `membership`, `user_status`, `user_position`, `user_avarta`, `date_created`, `last_updated`, `last_login_date`, `last_login_ip`, `syn`) VALUES
(1, NULL, NULL, NULL, 'admin', '$2a$08$kUH3Ko5akg0aO1BWP37C5eLzO2f0QqxsED9r8yLsJAbgJpXSS2JTKkUH3Ko5akg0aO1BWP37C5e', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
CREATE TABLE IF NOT EXISTS `timezones` (
  `timezone_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `timezone_groupe_fr` varchar(50) DEFAULT NULL,
  `timezone_groupe_en` varchar(50) DEFAULT NULL,
  `timezone_detail` varchar(100) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`timezone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `timezones`
--

INSERT INTO `timezones` (`timezone_id`, `timezone_groupe_fr`, `timezone_groupe_en`, `timezone_detail`, `syn`) VALUES
(1, 'Afrique', 'Africa', 'Africa/Abidjan', 1),
(2, 'Afrique', 'Africa', 'Africa/Accra', 1),
(3, 'Afrique', 'Africa', 'Africa/Addis_Ababa', 1),
(4, 'Afrique', 'Africa', 'Africa/Algiers', 1),
(5, 'Afrique', 'Africa', 'Africa/Asmara', 1),
(6, 'Afrique', 'Africa', 'Africa/Asmera', 1),
(7, 'Afrique', 'Africa', 'Africa/Bamako', 1),
(8, 'Afrique', 'Africa', 'Africa/Bangui', 1),
(9, 'Afrique', 'Africa', 'Africa/Banjul', 1),
(10, 'Afrique', 'Africa', 'Africa/Bissau', 1),
(11, 'Afrique', 'Africa', 'Africa/Blantyre', 1),
(12, 'Afrique', 'Africa', 'Africa/Brazzaville', 1),
(13, 'Afrique', 'Africa', 'Africa/Bujumbura', 1),
(14, 'Afrique', 'Africa', 'Africa/Cairo', 1),
(15, 'Afrique', 'Africa', 'Africa/Casablanca', 1),
(16, 'Afrique', 'Africa', 'Africa/Ceuta', 1),
(17, 'Afrique', 'Africa', 'Africa/Conakry', 1),
(18, 'Afrique', 'Africa', 'Africa/Dakar', 1),
(19, 'Afrique', 'Africa', 'Africa/Dar_es_Salaam', 1),
(20, 'Afrique', 'Africa', 'Africa/Djibouti', 1),
(21, 'Afrique', 'Africa', 'Africa/Douala', 1),
(22, 'Afrique', 'Africa', 'Africa/El_Aaiun', 1),
(23, 'Afrique', 'Africa', 'Africa/Freetown', 1),
(24, 'Afrique', 'Africa', 'Africa/Gaborone', 1),
(25, 'Afrique', 'Africa', 'Africa/Harare', 1),
(26, 'Afrique', 'Africa', 'Africa/Johannesburg', 1),
(27, 'Afrique', 'Africa', 'Africa/Juba', 1),
(28, 'Afrique', 'Africa', 'Africa/Kampala', 1),
(29, 'Afrique', 'Africa', 'Africa/Khartoum', 1),
(30, 'Afrique', 'Africa', 'Africa/Kigali', 1),
(31, 'Afrique', 'Africa', 'Africa/Kinshasa', 1),
(32, 'Afrique', 'Africa', 'Africa/Lagos', 1),
(33, 'Afrique', 'Africa', 'Africa/Libreville', 1),
(34, 'Afrique', 'Africa', 'Africa/Lome', 1),
(35, 'Afrique', 'Africa', 'Africa/Luanda', 1),
(36, 'Afrique', 'Africa', 'Africa/Lubumbashi', 1),
(37, 'Afrique', 'Africa', 'Africa/Lusaka', 1),
(38, 'Afrique', 'Africa', 'Africa/Malabo', 1),
(39, 'Afrique', 'Africa', 'Africa/Maputo', 1),
(40, 'Afrique', 'Africa', 'Africa/Maseru', 1),
(41, 'Afrique', 'Africa', 'Africa/Mbabane', 1),
(42, 'Afrique', 'Africa', 'Africa/Mogadishu', 1),
(43, 'Afrique', 'Africa', 'Africa/Monrovia', 1),
(44, 'Afrique', 'Africa', 'Africa/Nairobi', 1),
(45, 'Afrique', 'Africa', 'Africa/Ndjamena', 1),
(46, 'Afrique', 'Africa', 'Africa/Niamey', 1),
(47, 'Afrique', 'Africa', 'Africa/Nouakchott', 1),
(48, 'Afrique', 'Africa', 'Africa/Ouagadougou', 1),
(49, 'Afrique', 'Africa', 'Africa/Porto-Novo', 1),
(50, 'Afrique', 'Africa', 'Africa/Sao_Tome', 1),
(51, 'Afrique', 'Africa', 'Africa/Timbuktu', 1),
(52, 'Afrique', 'Africa', 'Africa/Tripoli', 1),
(53, 'Afrique', 'Africa', 'Africa/Tunis', 1),
(54, 'Afrique', 'Africa', 'Africa/Windhoek', 1),
(55, 'Amérique', 'America', 'America/Adak', 1),
(56, 'Amérique', 'America', 'America/Anchorage', 1),
(57, 'Amérique', 'America', 'America/Anguilla', 1),
(58, 'Amérique', 'America', 'America/Antigua', 1),
(59, 'Amérique', 'America', 'America/Araguaina', 1),
(60, 'Amérique', 'America', 'America/Argentina/Buenos_Aires', 1),
(61, 'Amérique', 'America', 'America/Argentina/Catamarca', 1),
(62, 'Amérique', 'America', 'America/Argentina/ComodRivadavia', 1),
(63, 'Amérique', 'America', 'America/Argentina/Cordoba', 1),
(64, 'Amérique', 'America', 'America/Argentina/Jujuy', 1),
(65, 'Amérique', 'America', 'America/Argentina/La_Rioja', 1),
(66, 'Amérique', 'America', 'America/Argentina/Mendoza', 1),
(67, 'Amérique', 'America', 'America/Argentina/Rio_Gallegos', 1),
(68, 'Amérique', 'America', 'America/Argentina/Salta', 1),
(69, 'Amérique', 'America', 'America/Argentina/San_Juan', 1),
(70, 'Amérique', 'America', 'America/Argentina/San_Luis', 1),
(71, 'Amérique', 'America', 'America/Argentina/Tucuman', 1),
(72, 'Amérique', 'America', 'America/Argentina/Ushuaia', 1),
(73, 'Amérique', 'America', 'America/Aruba', 1),
(74, 'Amérique', 'America', 'America/Asuncion', 1),
(75, 'Amérique', 'America', 'America/Atikokan', 1),
(76, 'Amérique', 'America', 'America/Atka', 1),
(77, 'Amérique', 'America', 'America/Bahia', 1),
(78, 'Amérique', 'America', 'America/Bahia_Banderas', 1),
(79, 'Amérique', 'America', 'America/Barbados', 1),
(80, 'Amérique', 'America', 'America/Belem', 1),
(81, 'Amérique', 'America', 'America/Belize', 1),
(82, 'Amérique', 'America', 'America/Blanc-Sablon', 1),
(83, 'Amérique', 'America', 'America/Boa_Vista', 1),
(84, 'Amérique', 'America', 'America/Bogota', 1),
(85, 'Amérique', 'America', 'America/Boise', 1),
(86, 'Amérique', 'America', 'America/Buenos_Aires', 1),
(87, 'Amérique', 'America', 'America/Cambridge_Bay', 1),
(88, 'Amérique', 'America', 'America/Campo_Grande', 1),
(89, 'Amérique', 'America', 'America/Cancun', 1),
(90, 'Amérique', 'America', 'America/Caracas', 1),
(91, 'Amérique', 'America', 'America/Catamarca', 1),
(92, 'Amérique', 'America', 'America/Cayenne', 1),
(93, 'Amérique', 'America', 'America/Cayman', 1),
(94, 'Amérique', 'America', 'America/Chicago', 1),
(95, 'Amérique', 'America', 'America/Chihuahua', 1),
(96, 'Amérique', 'America', 'America/Coral_Harbour', 1),
(97, 'Amérique', 'America', 'America/Cordoba', 1),
(98, 'Amérique', 'America', 'America/Costa_Rica', 1),
(99, 'Amérique', 'America', 'America/Creston', 1),
(100, 'Amérique', 'America', 'America/Cuiaba', 1),
(101, 'Amérique', 'America', 'America/Curacao', 1),
(102, 'Amérique', 'America', 'America/Danmarkshavn', 1),
(103, 'Amérique', 'America', 'America/Dawson', 1),
(104, 'Amérique', 'America', 'America/Dawson_Creek', 1),
(105, 'Amérique', 'America', 'America/Denver', 1),
(106, 'Amérique', 'America', 'America/Detroit', 1),
(107, 'Amérique', 'America', 'America/Dominica', 1),
(108, 'Amérique', 'America', 'America/Edmonton', 1),
(109, 'Amérique', 'America', 'America/Eirunepe', 1),
(110, 'Amérique', 'America', 'America/El_Salvador', 1),
(111, 'Amérique', 'America', 'America/Ensenada', 1),
(112, 'Amérique', 'America', 'America/Fort_Wayne', 1),
(113, 'Amérique', 'America', 'America/Fortaleza', 1),
(114, 'Amérique', 'America', 'America/Glace_Bay', 1),
(115, 'Amérique', 'America', 'America/Godthab', 1),
(116, 'Amérique', 'America', 'America/Goose_Bay', 1),
(117, 'Amérique', 'America', 'America/Grand_Turk', 1),
(118, 'Amérique', 'America', 'America/Grenada', 1),
(119, 'Amérique', 'America', 'America/Guadeloupe', 1),
(120, 'Amérique', 'America', 'America/Guatemala', 1),
(121, 'Amérique', 'America', 'America/Guayaquil', 1),
(122, 'Amérique', 'America', 'America/Guyana', 1),
(123, 'Amérique', 'America', 'America/Halifax', 1),
(124, 'Amérique', 'America', 'America/Havana', 1),
(125, 'Amérique', 'America', 'America/Hermosillo', 1),
(126, 'Amérique', 'America', 'America/Indiana/Indianapolis', 1),
(127, 'Amérique', 'America', 'America/Indiana/Knox', 1),
(128, 'Amérique', 'America', 'America/Indiana/Marengo', 1),
(129, 'Amérique', 'America', 'America/Indiana/Petersburg', 1),
(130, 'Amérique', 'America', 'America/Indiana/Tell_City', 1),
(131, 'Amérique', 'America', 'America/Indiana/Vevay', 1),
(132, 'Amérique', 'America', 'America/Indiana/Vincennes', 1),
(133, 'Amérique', 'America', 'America/Indiana/Winamac', 1),
(134, 'Amérique', 'America', 'America/Indianapolis', 1),
(135, 'Amérique', 'America', 'America/Inuvik', 1),
(136, 'Amérique', 'America', 'America/Iqaluit', 1),
(137, 'Amérique', 'America', 'America/Jamaica', 1),
(138, 'Amérique', 'America', 'America/Jujuy', 1),
(139, 'Amérique', 'America', 'America/Juneau', 1),
(140, 'Amérique', 'America', 'America/Kentucky/Louisville', 1),
(141, 'Amérique', 'America', 'America/Kentucky/Monticello', 1),
(142, 'Amérique', 'America', 'America/Knox_IN', 1),
(143, 'Amérique', 'America', 'America/Kralendijk', 1),
(144, 'Amérique', 'America', 'America/La_Paz', 1),
(145, 'Amérique', 'America', 'America/Lima', 1),
(146, 'Amérique', 'America', 'America/Los_Angeles', 1),
(147, 'Amérique', 'America', 'America/Louisville', 1),
(148, 'Amérique', 'America', 'America/Lower_Princes', 1),
(149, 'Amérique', 'America', 'America/Maceio', 1),
(150, 'Amérique', 'America', 'America/Managua', 1),
(151, 'Amérique', 'America', 'America/Manaus', 1),
(152, 'Amérique', 'America', 'America/Marigot', 1),
(153, 'Amérique', 'America', 'America/Martinique', 1),
(154, 'Amérique', 'America', 'America/Matamoros', 1),
(155, 'Amérique', 'America', 'America/Mazatlan', 1),
(156, 'Amérique', 'America', 'America/Mendoza', 1),
(157, 'Amérique', 'America', 'America/Menominee', 1),
(158, 'Amérique', 'America', 'America/Merida', 1),
(159, 'Amérique', 'America', 'America/Metlakatla', 1),
(160, 'Amérique', 'America', 'America/Mexico_City', 1),
(161, 'Amérique', 'America', 'America/Miquelon', 1),
(162, 'Amérique', 'America', 'America/Moncton', 1),
(163, 'Amérique', 'America', 'America/Monterrey', 1),
(164, 'Amérique', 'America', 'America/Montevideo', 1),
(165, 'Amérique', 'America', 'America/Montreal', 1),
(166, 'Amérique', 'America', 'America/Montserrat', 1),
(167, 'Amérique', 'America', 'America/Nassau', 1),
(168, 'Amérique', 'America', 'America/New_York', 1),
(169, 'Amérique', 'America', 'America/Nipigon', 1),
(170, 'Amérique', 'America', 'America/Nome', 1),
(171, 'Amérique', 'America', 'America/Noronha', 1),
(172, 'Amérique', 'America', 'America/North_Dakota/Beulah', 1),
(173, 'Amérique', 'America', 'America/North_Dakota/Center', 1),
(174, 'Amérique', 'America', 'America/North_Dakota/New_Salem', 1),
(175, 'Amérique', 'America', 'America/Ojinaga', 1),
(176, 'Amérique', 'America', 'America/Panama', 1),
(177, 'Amérique', 'America', 'America/Pangnirtung', 1),
(178, 'Amérique', 'America', 'America/Paramaribo', 1),
(179, 'Amérique', 'America', 'America/Phoenix', 1),
(180, 'Amérique', 'America', 'America/Port-au-Prince', 1),
(181, 'Amérique', 'America', 'America/Port_of_Spain', 1),
(182, 'Amérique', 'America', 'America/Porto_Acre', 1),
(183, 'Amérique', 'America', 'America/Porto_Velho', 1),
(184, 'Amérique', 'America', 'America/Puerto_Rico', 1),
(185, 'Amérique', 'America', 'America/Rainy_River', 1),
(186, 'Amérique', 'America', 'America/Rankin_Inlet', 1),
(187, 'Amérique', 'America', 'America/Recife', 1),
(188, 'Amérique', 'America', 'America/Regina', 1),
(189, 'Amérique', 'America', 'America/Resolute', 1),
(190, 'Amérique', 'America', 'America/Rio_Branco', 1),
(191, 'Amérique', 'America', 'America/Rosario', 1),
(192, 'Amérique', 'America', 'America/Santa_Isabel', 1),
(193, 'Amérique', 'America', 'America/Santarem', 1),
(194, 'Amérique', 'America', 'America/Santiago', 1),
(195, 'Amérique', 'America', 'America/Santo_Domingo', 1),
(196, 'Amérique', 'America', 'America/Sao_Paulo', 1),
(197, 'Amérique', 'America', 'America/Scoresbysund', 1),
(198, 'Amérique', 'America', 'America/Shiprock', 1),
(199, 'Amérique', 'America', 'America/Sitka', 1),
(200, 'Amérique', 'America', 'America/St_Barthelemy', 1),
(201, 'Amérique', 'America', 'America/St_Johns', 1),
(202, 'Amérique', 'America', 'America/St_Kitts', 1),
(203, 'Amérique', 'America', 'America/St_Lucia', 1),
(204, 'Amérique', 'America', 'America/St_Thomas', 1),
(205, 'Amérique', 'America', 'America/St_Vincent', 1),
(206, 'Amérique', 'America', 'America/Swift_Current', 1),
(207, 'Amérique', 'America', 'America/Tegucigalpa', 1),
(208, 'Amérique', 'America', 'America/Thule', 1),
(209, 'Amérique', 'America', 'America/Thunder_Bay', 1),
(210, 'Amérique', 'America', 'America/Tijuana', 1),
(211, 'Amérique', 'America', 'America/Toronto', 1),
(212, 'Amérique', 'America', 'America/Tortola', 1),
(213, 'Amérique', 'America', 'America/Vancouver', 1),
(214, 'Amérique', 'America', 'America/Virgin', 1),
(215, 'Amérique', 'America', 'America/Whitehorse', 1),
(216, 'Amérique', 'America', 'America/Winnipeg', 1),
(217, 'Amérique', 'America', 'America/Yakutat', 1),
(218, 'Amérique', 'America', 'America/Yellowknife', 1),
(219, 'Antarctique', 'Antarctica', 'Antarctica/Casey', 1),
(220, 'Antarctique', 'Antarctica', 'Antarctica/Davis', 1),
(221, 'Antarctique', 'Antarctica', 'Antarctica/DumontDUrville', 1),
(222, 'Antarctique', 'Antarctica', 'Antarctica/Macquarie', 1),
(223, 'Antarctique', 'Antarctica', 'Antarctica/Mawson', 1),
(224, 'Antarctique', 'Antarctica', 'Antarctica/McMurdo', 1),
(225, 'Antarctique', 'Antarctica', 'Antarctica/Palmer', 1),
(226, 'Antarctique', 'Antarctica', 'Antarctica/Rothera', 1),
(227, 'Antarctique', 'Antarctica', 'Antarctica/South_Pole', 1),
(228, 'Antarctique', 'Antarctica', 'Antarctica/Syowa', 1),
(229, 'Antarctique', 'Antarctica', 'Antarctica/Vostok', 1),
(230, 'Arctique', 'Arctic', 'Arctic/Longyearbyen', 1),
(231, 'Asie', 'Asia', 'Asia/Aden', 1),
(232, 'Asie', 'Asia', 'Asia/Almaty', 1),
(233, 'Asie', 'Asia', 'Asia/Amman', 1),
(234, 'Asie', 'Asia', 'Asia/Anadyr', 1),
(235, 'Asie', 'Asia', 'Asia/Aqtau', 1),
(236, 'Asie', 'Asia', 'Asia/Aqtobe', 1),
(237, 'Asie', 'Asia', 'Asia/Ashgabat', 1),
(238, 'Asie', 'Asia', 'Asia/Ashkhabad', 1),
(239, 'Asie', 'Asia', 'Asia/Baghdad', 1),
(240, 'Asie', 'Asia', 'Asia/Bahrain', 1),
(241, 'Asie', 'Asia', 'Asia/Baku', 1),
(242, 'Asie', 'Asia', 'Asia/Bangkok', 1),
(243, 'Asie', 'Asia', 'Asia/Beirut', 1),
(244, 'Asie', 'Asia', 'Asia/Bishkek', 1),
(245, 'Asie', 'Asia', 'Asia/Brunei', 1),
(246, 'Asie', 'Asia', 'Asia/Calcutta', 1),
(247, 'Asie', 'Asia', 'Asia/Choibalsan', 1),
(248, 'Asie', 'Asia', 'Asia/Chongqing', 1),
(249, 'Asie', 'Asia', 'Asia/Chungking', 1),
(250, 'Asie', 'Asia', 'Asia/Colombo', 1),
(251, 'Asie', 'Asia', 'Asia/Dacca', 1),
(252, 'Asie', 'Asia', 'Asia/Damascus', 1),
(253, 'Asie', 'Asia', 'Asia/Dhaka', 1),
(254, 'Asie', 'Asia', 'Asia/Dili', 1),
(255, 'Asie', 'Asia', 'Asia/Dubai', 1),
(256, 'Asie', 'Asia', 'Asia/Dushanbe', 1),
(257, 'Asie', 'Asia', 'Asia/Gaza', 1),
(258, 'Asie', 'Asia', 'Asia/Harbin', 1),
(259, 'Asie', 'Asia', 'Asia/Hebron', 1),
(260, 'Asie', 'Asia', 'Asia/Ho_Chi_Minh', 1),
(261, 'Asie', 'Asia', 'Asia/Hong_Kong', 1),
(262, 'Asie', 'Asia', 'Asia/Hovd', 1),
(263, 'Asie', 'Asia', 'Asia/Irkutsk', 1),
(264, 'Asie', 'Asia', 'Asia/Istanbul', 1),
(265, 'Asie', 'Asia', 'Asia/Jakarta', 1),
(266, 'Asie', 'Asia', 'Asia/Jayapura', 1),
(267, 'Asie', 'Asia', 'Asia/Jerusalem', 1),
(268, 'Asie', 'Asia', 'Asia/Kabul', 1),
(269, 'Asie', 'Asia', 'Asia/Kamchatka', 1),
(270, 'Asie', 'Asia', 'Asia/Karachi', 1),
(271, 'Asie', 'Asia', 'Asia/Kashgar', 1),
(272, 'Asie', 'Asia', 'Asia/Kathmandu', 1),
(273, 'Asie', 'Asia', 'Asia/Katmandu', 1),
(274, 'Asie', 'Asia', 'Asia/Kolkata', 1),
(275, 'Asie', 'Asia', 'Asia/Krasnoyarsk', 1),
(276, 'Asie', 'Asia', 'Asia/Kuala_Lumpur', 1),
(277, 'Asie', 'Asia', 'Asia/Kuching', 1),
(278, 'Asie', 'Asia', 'Asia/Kuwait', 1),
(279, 'Asie', 'Asia', 'Asia/Macao', 1),
(280, 'Asie', 'Asia', 'Asia/Macau', 1),
(281, 'Asie', 'Asia', 'Asia/Magadan', 1),
(282, 'Asie', 'Asia', 'Asia/Makassar', 1),
(283, 'Asie', 'Asia', 'Asia/Manila', 1),
(284, 'Asie', 'Asia', 'Asia/Muscat', 1),
(285, 'Asie', 'Asia', 'Asia/Nicosia', 1),
(286, 'Asie', 'Asia', 'Asia/Novokuznetsk', 1),
(287, 'Asie', 'Asia', 'Asia/Novosibirsk', 1),
(288, 'Asie', 'Asia', 'Asia/Omsk', 1),
(289, 'Asie', 'Asia', 'Asia/Oral', 1),
(290, 'Asie', 'Asia', 'Asia/Phnom_Penh', 1),
(291, 'Asie', 'Asia', 'Asia/Pontianak', 1),
(292, 'Asie', 'Asia', 'Asia/Pyongyang', 1),
(293, 'Asie', 'Asia', 'Asia/Qatar', 1),
(294, 'Asie', 'Asia', 'Asia/Qyzylorda', 1),
(295, 'Asie', 'Asia', 'Asia/Rangoon', 1),
(296, 'Asie', 'Asia', 'Asia/Riyadh', 1),
(297, 'Asie', 'Asia', 'Asia/Saigon', 1),
(298, 'Asie', 'Asia', 'Asia/Sakhalin', 1),
(299, 'Asie', 'Asia', 'Asia/Samarkand', 1),
(300, 'Asie', 'Asia', 'Asia/Seoul', 1),
(301, 'Asie', 'Asia', 'Asia/Shanghai', 1),
(302, 'Asie', 'Asia', 'Asia/Singapore', 1),
(303, 'Asie', 'Asia', 'Asia/Taipei', 1),
(304, 'Asie', 'Asia', 'Asia/Tashkent', 1),
(305, 'Asie', 'Asia', 'Asia/Tbilisi', 1),
(306, 'Asie', 'Asia', 'Asia/Tehran', 1),
(307, 'Asie', 'Asia', 'Asia/Tel_Aviv', 1),
(308, 'Asie', 'Asia', 'Asia/Thimbu', 1),
(309, 'Asie', 'Asia', 'Asia/Thimphu', 1),
(310, 'Asie', 'Asia', 'Asia/Tokyo', 1),
(311, 'Asie', 'Asia', 'Asia/Ujung_Pandang', 1),
(312, 'Asie', 'Asia', 'Asia/Ulaanbaatar', 1),
(313, 'Asie', 'Asia', 'Asia/Ulan_Bator', 1),
(314, 'Asie', 'Asia', 'Asia/Urumqi', 1),
(315, 'Asie', 'Asia', 'Asia/Vientiane', 1),
(316, 'Asie', 'Asia', 'Asia/Vladivostok', 1),
(317, 'Asie', 'Asia', 'Asia/Yakutsk', 1),
(318, 'Asie', 'Asia', 'Asia/Yekaterinburg', 1),
(319, 'Asie', 'Asia', 'Asia/Yerevan', 1),
(320, 'Atlantique', 'Atlantic', 'Atlantic/Azores', 1),
(321, 'Atlantique', 'Atlantic', 'Atlantic/Bermuda', 1),
(322, 'Atlantique', 'Atlantic', 'Atlantic/Canary', 1),
(323, 'Atlantique', 'Atlantic', 'Atlantic/Cape_Verde', 1),
(324, 'Atlantique', 'Atlantic', 'Atlantic/Faeroe', 1),
(325, 'Atlantique', 'Atlantic', 'Atlantic/Faroe', 1),
(326, 'Atlantique', 'Atlantic', 'Atlantic/Jan_Mayen', 1),
(327, 'Atlantique', 'Atlantic', 'Atlantic/Madeira', 1),
(328, 'Atlantique', 'Atlantic', 'Atlantic/Reykjavik', 1),
(329, 'Atlantique', 'Atlantic', 'Atlantic/South_Georgia', 1),
(330, 'Atlantique', 'Atlantic', 'Atlantic/St_Helena', 1),
(331, 'Atlantique', 'Atlantic', 'Atlantic/Stanley', 1),
(332, 'Australie', 'Australia', 'Australia/ACT', 1),
(333, 'Australie', 'Australia', 'Australia/Adelaide', 1),
(334, 'Australie', 'Australia', 'Australia/Brisbane', 1),
(335, 'Australie', 'Australia', 'Australia/Broken_Hill', 1),
(336, 'Australie', 'Australia', 'Australia/Canberra', 1),
(337, 'Australie', 'Australia', 'Australia/Currie', 1),
(338, 'Australie', 'Australia', 'Australia/Darwin', 1),
(339, 'Australie', 'Australia', 'Australia/Eucla', 1),
(340, 'Australie', 'Australia', 'Australia/Hobart', 1),
(341, 'Australie', 'Australia', 'Australia/LHI', 1),
(342, 'Australie', 'Australia', 'Australia/Lindeman', 1),
(343, 'Australie', 'Australia', 'Australia/Lord_Howe', 1),
(344, 'Australie', 'Australia', 'Australia/Melbourne', 1),
(345, 'Australie', 'Australia', 'Australia/NSW', 1),
(346, 'Australie', 'Australia', 'Australia/North', 1),
(347, 'Australie', 'Australia', 'Australia/Perth', 1),
(348, 'Australie', 'Australia', 'Australia/Queensland', 1),
(349, 'Australie', 'Australia', 'Australia/South', 1),
(350, 'Australie', 'Australia', 'Australia/Sydney', 1),
(351, 'Australie', 'Australia', 'Australia/Tasmania', 1),
(352, 'Australie', 'Australia', 'Australia/Victoria', 1),
(353, 'Australie', 'Australia', 'Australia/West', 1),
(354, 'Australie', 'Australia', 'Australia/Yancowinna', 1),
(355, 'Europe', 'Europe', 'Europe/Amsterdam', 1),
(356, 'Europe', 'Europe', 'Europe/Andorra', 1),
(357, 'Europe', 'Europe', 'Europe/Athens', 1),
(358, 'Europe', 'Europe', 'Europe/Belfast', 1),
(359, 'Europe', 'Europe', 'Europe/Belgrade', 1),
(360, 'Europe', 'Europe', 'Europe/Berlin', 1),
(361, 'Europe', 'Europe', 'Europe/Bratislava', 1),
(362, 'Europe', 'Europe', 'Europe/Brussels', 1),
(363, 'Europe', 'Europe', 'Europe/Bucharest', 1),
(364, 'Europe', 'Europe', 'Europe/Budapest', 1),
(365, 'Europe', 'Europe', 'Europe/Chisinau', 1),
(366, 'Europe', 'Europe', 'Europe/Copenhagen', 1),
(367, 'Europe', 'Europe', 'Europe/Dublin', 1),
(368, 'Europe', 'Europe', 'Europe/Gibraltar', 1),
(369, 'Europe', 'Europe', 'Europe/Guernsey', 1),
(370, 'Europe', 'Europe', 'Europe/Helsinki', 1),
(371, 'Europe', 'Europe', 'Europe/Isle_of_Man', 1),
(372, 'Europe', 'Europe', 'Europe/Istanbul', 1),
(373, 'Europe', 'Europe', 'Europe/Jersey', 1),
(374, 'Europe', 'Europe', 'Europe/Kaliningrad', 1),
(375, 'Europe', 'Europe', 'Europe/Kiev', 1),
(376, 'Europe', 'Europe', 'Europe/Lisbon', 1),
(377, 'Europe', 'Europe', 'Europe/Ljubljana', 1),
(378, 'Europe', 'Europe', 'Europe/London', 1),
(379, 'Europe', 'Europe', 'Europe/Luxembourg', 1),
(380, 'Europe', 'Europe', 'Europe/Madrid', 1),
(381, 'Europe', 'Europe', 'Europe/Malta', 1),
(382, 'Europe', 'Europe', 'Europe/Mariehamn', 1),
(383, 'Europe', 'Europe', 'Europe/Minsk', 1),
(384, 'Europe', 'Europe', 'Europe/Monaco', 1),
(385, 'Europe', 'Europe', 'Europe/Moscow', 1),
(386, 'Europe', 'Europe', 'Europe/Nicosia', 1),
(387, 'Europe', 'Europe', 'Europe/Oslo', 1),
(388, 'Europe', 'Europe', 'Europe/Paris', 1),
(389, 'Europe', 'Europe', 'Europe/Podgorica', 1),
(390, 'Europe', 'Europe', 'Europe/Prague', 1),
(391, 'Europe', 'Europe', 'Europe/Riga', 1),
(392, 'Europe', 'Europe', 'Europe/Rome', 1),
(393, 'Europe', 'Europe', 'Europe/Samara', 1),
(394, 'Europe', 'Europe', 'Europe/San_Marino', 1),
(395, 'Europe', 'Europe', 'Europe/Sarajevo', 1),
(396, 'Europe', 'Europe', 'Europe/Simferopol', 1),
(397, 'Europe', 'Europe', 'Europe/Skopje', 1),
(398, 'Europe', 'Europe', 'Europe/Sofia', 1),
(399, 'Europe', 'Europe', 'Europe/Stockholm', 1),
(400, 'Europe', 'Europe', 'Europe/Tallinn', 1),
(401, 'Europe', 'Europe', 'Europe/Tirane', 1),
(402, 'Europe', 'Europe', 'Europe/Tiraspol', 1),
(403, 'Europe', 'Europe', 'Europe/Uzhgorod', 1),
(404, 'Europe', 'Europe', 'Europe/Vaduz', 1),
(405, 'Europe', 'Europe', 'Europe/Vatican', 1),
(406, 'Europe', 'Europe', 'Europe/Vienna', 1),
(407, 'Europe', 'Europe', 'Europe/Vilnius', 1),
(408, 'Europe', 'Europe', 'Europe/Volgograd', 1),
(409, 'Europe', 'Europe', 'Europe/Warsaw', 1),
(410, 'Europe', 'Europe', 'Europe/Zagreb', 1),
(411, 'Europe', 'Europe', 'Europe/Zaporozhye', 1),
(412, 'Europe', 'Europe', 'Europe/Zurich', 1),
(413, 'Indien', 'Indian', 'Indian/Antananarivo', 1),
(414, 'Indien', 'Indian', 'Indian/Chagos', 1),
(415, 'Indien', 'Indian', 'Indian/Christmas', 1),
(416, 'Indien', 'Indian', 'Indian/Cocos', 1),
(417, 'Indien', 'Indian', 'Indian/Comoro', 1),
(418, 'Indien', 'Indian', 'Indian/Kerguelen', 1),
(419, 'Indien', 'Indian', 'Indian/Mahe', 1),
(420, 'Indien', 'Indian', 'Indian/Maldives', 1),
(421, 'Indien', 'Indian', 'Indian/Mauritius', 1),
(422, 'Indien', 'Indian', 'Indian/Mayotte', 1),
(423, 'Indien', 'Indian', 'Indian/Reunion', 1),
(424, 'Pacifique', 'Pacific', 'Pacific/Apia', 1),
(425, 'Pacifique', 'Pacific', 'Pacific/Auckland', 1),
(426, 'Pacifique', 'Pacific', 'Pacific/Chatham', 1),
(427, 'Pacifique', 'Pacific', 'Pacific/Chuuk', 1),
(428, 'Pacifique', 'Pacific', 'Pacific/Easter', 1),
(429, 'Pacifique', 'Pacific', 'Pacific/Efate', 1),
(430, 'Pacifique', 'Pacific', 'Pacific/Enderbury', 1),
(431, 'Pacifique', 'Pacific', 'Pacific/Fakaofo', 1),
(432, 'Pacifique', 'Pacific', 'Pacific/Fiji', 1),
(433, 'Pacifique', 'Pacific', 'Pacific/Funafuti', 1),
(434, 'Pacifique', 'Pacific', 'Pacific/Galapagos', 1),
(435, 'Pacifique', 'Pacific', 'Pacific/Gambier', 1),
(436, 'Pacifique', 'Pacific', 'Pacific/Guadalcanal', 1),
(437, 'Pacifique', 'Pacific', 'Pacific/Guam', 1),
(438, 'Pacifique', 'Pacific', 'Pacific/Honolulu', 1),
(439, 'Pacifique', 'Pacific', 'Pacific/Johnston', 1),
(440, 'Pacifique', 'Pacific', 'Pacific/Kiritimati', 1),
(441, 'Pacifique', 'Pacific', 'Pacific/Kosrae', 1),
(442, 'Pacifique', 'Pacific', 'Pacific/Kwajalein', 1),
(443, 'Pacifique', 'Pacific', 'Pacific/Majuro', 1),
(444, 'Pacifique', 'Pacific', 'Pacific/Marquesas', 1),
(445, 'Pacifique', 'Pacific', 'Pacific/Midway', 1),
(446, 'Pacifique', 'Pacific', 'Pacific/Nauru', 1),
(447, 'Pacifique', 'Pacific', 'Pacific/Niue', 1),
(448, 'Pacifique', 'Pacific', 'Pacific/Norfolk', 1),
(449, 'Pacifique', 'Pacific', 'Pacific/Noumea', 1),
(450, 'Pacifique', 'Pacific', 'Pacific/Pago_Pago', 1),
(451, 'Pacifique', 'Pacific', 'Pacific/Palau', 1),
(452, 'Pacifique', 'Pacific', 'Pacific/Pitcairn', 1),
(453, 'Pacifique', 'Pacific', 'Pacific/Pohnpei', 1),
(454, 'Pacifique', 'Pacific', 'Pacific/Ponape', 1),
(455, 'Pacifique', 'Pacific', 'Pacific/Port_Moresby', 1),
(456, 'Pacifique', 'Pacific', 'Pacific/Rarotonga', 1),
(457, 'Pacifique', 'Pacific', 'Pacific/Saipan', 1),
(458, 'Pacifique', 'Pacific', 'Pacific/Samoa', 1),
(459, 'Pacifique', 'Pacific', 'Pacific/Tahiti', 1),
(460, 'Pacifique', 'Pacific', 'Pacific/Tarawa', 1),
(461, 'Pacifique', 'Pacific', 'Pacific/Tongatapu', 1),
(462, 'Pacifique', 'Pacific', 'Pacific/Truk', 1),
(463, 'Pacifique', 'Pacific', 'Pacific/Wake', 1),
(464, 'Pacifique', 'Pacific', 'Pacific/Wallis', 1),
(465, 'Pacifique', 'Pacific', 'Pacific/Yap', 1),
(466, 'Autres', 'Other', 'Brazil/Acre', 1),
(467, 'Autres', 'Other', 'Brazil/DeNoronha', 1),
(468, 'Autres', 'Other', 'Brazil/East', 1),
(469, 'Autres', 'Other', 'Brazil/West', 1),
(470, 'Autres', 'Other', 'CET', 1),
(471, 'Autres', 'Other', 'CST6CDT', 1),
(472, 'Autres', 'Other', 'Canada/Atlantic', 1),
(473, 'Autres', 'Other', 'Canada/Central', 1),
(474, 'Autres', 'Other', 'Canada/East-Saskatchewan', 1),
(475, 'Autres', 'Other', 'Canada/Eastern', 1),
(476, 'Autres', 'Other', 'Canada/Mountain', 1),
(477, 'Autres', 'Other', 'Canada/Newfoundland', 1),
(478, 'Autres', 'Other', 'Canada/Pacific', 1),
(479, 'Autres', 'Other', 'Canada/Saskatchewan', 1),
(480, 'Autres', 'Other', 'Canada/Yukon', 1),
(481, 'Autres', 'Other', 'Chile/Continental', 1),
(482, 'Autres', 'Other', 'Chile/EasterIsland', 1),
(483, 'Autres', 'Other', 'Cuba', 1),
(484, 'Autres', 'Other', 'EET', 1),
(485, 'Autres', 'Other', 'EST', 1),
(486, 'Autres', 'Other', 'EST5EDT', 1),
(487, 'Autres', 'Other', 'Egypt', 1),
(488, 'Autres', 'Other', 'Eire', 1),
(489, 'Autres', 'Other', 'Etc/GMT', 1),
(490, 'Autres', 'Other', 'Etc/GMT+0', 1),
(491, 'Autres', 'Other', 'Etc/GMT+1', 1),
(492, 'Autres', 'Other', 'Etc/GMT+10', 1),
(493, 'Autres', 'Other', 'Etc/GMT+11', 1),
(494, 'Autres', 'Other', 'Etc/GMT+12', 1),
(495, 'Autres', 'Other', 'Etc/GMT+2', 1),
(496, 'Autres', 'Other', 'Etc/GMT+3', 1),
(497, 'Autres', 'Other', 'Etc/GMT+4', 1),
(498, 'Autres', 'Other', 'Etc/GMT+5', 1),
(499, 'Autres', 'Other', 'Etc/GMT+6', 1),
(500, 'Autres', 'Other', 'Etc/GMT+7', 1),
(501, 'Autres', 'Other', 'Etc/GMT+8', 1),
(502, 'Autres', 'Other', 'Etc/GMT+9', 1),
(503, 'Autres', 'Other', 'Etc/GMT-0', 1),
(504, 'Autres', 'Other', 'Etc/GMT-1', 1),
(505, 'Autres', 'Other', 'Etc/GMT-10', 1),
(506, 'Autres', 'Other', 'Etc/GMT-11', 1),
(507, 'Autres', 'Other', 'Etc/GMT-12', 1),
(508, 'Autres', 'Other', 'Etc/GMT-13', 1),
(509, 'Autres', 'Other', 'Etc/GMT-14', 1),
(510, 'Autres', 'Other', 'Etc/GMT-2', 1),
(511, 'Autres', 'Other', 'Etc/GMT-3', 1),
(512, 'Autres', 'Other', 'Etc/GMT-4', 1),
(513, 'Autres', 'Other', 'Etc/GMT-5', 1),
(514, 'Autres', 'Other', 'Etc/GMT-6', 1),
(515, 'Autres', 'Other', 'Etc/GMT-7', 1),
(516, 'Autres', 'Other', 'Etc/GMT-8', 1),
(517, 'Autres', 'Other', 'Etc/GMT-9', 1),
(518, 'Autres', 'Other', 'Etc/GMT0', 1),
(519, 'Autres', 'Other', 'Etc/Greenwich', 1),
(520, 'Autres', 'Other', 'Etc/UCT', 1),
(521, 'Autres', 'Other', 'Etc/UTC', 1),
(522, 'Autres', 'Other', 'Etc/Universal', 1),
(523, 'Autres', 'Other', 'Etc/Zulu', 1),
(524, 'Autres', 'Other', 'GB', 1),
(525, 'Autres', 'Other', 'GB-Eire', 1),
(526, 'Autres', 'Other', 'GMT', 1),
(527, 'Autres', 'Other', 'GMT+0', 1),
(528, 'Autres', 'Other', 'GMT-0', 1),
(529, 'Autres', 'Other', 'GMT0', 1),
(530, 'Autres', 'Other', 'Greenwich', 1),
(531, 'Autres', 'Other', 'HST', 1),
(532, 'Autres', 'Other', 'Hongkong', 1),
(533, 'Autres', 'Other', 'Iceland', 1),
(534, 'Autres', 'Other', 'Iran', 1),
(535, 'Autres', 'Other', 'Israel', 1),
(536, 'Autres', 'Other', 'Jamaica', 1),
(537, 'Autres', 'Other', 'Japan', 1),
(538, 'Autres', 'Other', 'Kwajalein', 1),
(539, 'Autres', 'Other', 'Libya', 1),
(540, 'Autres', 'Other', 'MET', 1),
(541, 'Autres', 'Other', 'MST', 1),
(542, 'Autres', 'Other', 'MST7MDT', 1),
(543, 'Autres', 'Other', 'Mexico/BajaNorte', 1),
(544, 'Autres', 'Other', 'Mexico/BajaSur', 1),
(545, 'Autres', 'Other', 'Mexico/General', 1),
(546, 'Autres', 'Other', 'NZ', 1),
(547, 'Autres', 'Other', 'NZ-CHAT', 1),
(548, 'Autres', 'Other', 'Navajo', 1),
(549, 'Autres', 'Other', 'PRC', 1),
(550, 'Autres', 'Other', 'PST8PDT', 1),
(551, 'Autres', 'Other', 'Poland', 1),
(552, 'Autres', 'Other', 'Portugal', 1),
(553, 'Autres', 'Other', 'ROC', 1),
(554, 'Autres', 'Other', 'ROK', 1),
(555, 'Autres', 'Other', 'Singapore', 1),
(556, 'Autres', 'Other', 'Turkey', 1),
(557, 'Autres', 'Other', 'UCT', 1),
(558, 'Autres', 'Other', 'US/Alaska', 1),
(559, 'Autres', 'Other', 'US/Aleutian', 1),
(560, 'Autres', 'Other', 'US/Arizona', 1),
(561, 'Autres', 'Other', 'US/Central', 1),
(562, 'Autres', 'Other', 'US/East-Indiana', 1),
(563, 'Autres', 'Other', 'US/Eastern', 1),
(564, 'Autres', 'Other', 'US/Hawaii', 1),
(565, 'Autres', 'Other', 'US/Indiana-Starke', 1),
(566, 'Autres', 'Other', 'US/Michigan', 1),
(567, 'Autres', 'Other', 'US/Mountain', 1),
(568, 'Autres', 'Other', 'US/Pacific', 1),
(569, 'Autres', 'Other', 'US/Pacific-New', 1),
(570, 'Autres', 'Other', 'US/Samoa', 1),
(571, 'Autres', 'Other', 'UTC', 1),
(572, 'Autres', 'Other', 'Universal', 1),
(573, 'Autres', 'Other', 'W-SU', 1),
(574, 'Autres', 'Other', 'WET', 1),
(575, 'Autres', 'Other', 'Zulu', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_accompagnement`
--

DROP TABLE IF EXISTS `t_accompagnement`;
CREATE TABLE IF NOT EXISTS `t_accompagnement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `produit_id` int(10) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `unite` varchar(25) NOT NULL,
  `quantite` float NOT NULL,
  `plat_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `produit_id` (`produit_id`,`plat_id`),
  KEY `plat_id` (`plat_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=402 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_accompagnement`
--

INSERT INTO `t_accompagnement` (`id`, `produit_id`, `designation`, `unite`, `quantite`, `plat_id`, `hotel_id`, `syn`) VALUES
(1, 83, 'Bako', 'piece', 1, 103, 328, 1),
(2, 75, 'Fanta', 'piece', 1, 103, 328, 1),
(7, 146, 'Arachides', 'piece', 1, 365, 356, 1),
(8, 146, 'Arachides', 'piece', 1, 366, 356, 1),
(145, 160, 'Chikwange', 'piece', 1, 322, 356, 1),
(146, 263, 'Riz', 'piece', 1, 322, 356, 1),
(147, 224, 'Makemba main', 'piece', 1, 322, 356, 1),
(148, 196, 'Fufu', 'Ekolo', 1, 322, 356, 1),
(149, 259, 'Pommes de terre', 'piece', 1, 322, 356, 1),
(150, 374, 'Pomme sautee', 'Portion', 1, 322, 356, 1),
(151, 194, 'Frites', 'piece', 1, 322, 356, 1),
(167, 160, 'Chikwange', 'piece', 1, 361, 356, 1),
(168, 263, 'Riz', 'piece', 1, 361, 356, 1),
(169, 224, 'Makemba main', 'piece', 1, 361, 356, 1),
(170, 196, 'Fufu', 'Ekolo', 1, 361, 356, 1),
(171, 259, 'Pommes de terre', 'piece', 1, 361, 356, 1),
(172, 374, 'Pomme sautee', 'Portion', 1, 361, 356, 1),
(173, 194, 'Frites', 'piece', 1, 361, 356, 1),
(174, 160, 'Chikwange', 'piece', 1, 363, 356, 1),
(175, 263, 'Riz', 'piece', 1, 363, 356, 1),
(176, 224, 'Makemba main', 'piece', 1, 363, 356, 1),
(177, 196, 'Fufu', 'Ekolo', 1, 363, 356, 1),
(178, 259, 'Pommes de terre', 'piece', 1, 363, 356, 1),
(179, 374, 'Pomme sautee', 'Portion', 1, 363, 356, 1),
(180, 194, 'Frites', 'piece', 1, 363, 356, 1),
(246, 160, 'Chikwange', 'piece', 1, 385, 356, 1),
(247, 224, 'Makemba main', 'piece', 1, 385, 356, 1),
(248, 196, 'Fufu', 'Ekolo', 1, 385, 356, 1),
(249, 259, 'Pommes de terre', 'piece', 1, 385, 356, 1),
(250, 374, 'Pomme sautee', 'Portion', 1, 385, 356, 1),
(299, 386, 'Pommes sautee', 'Portion', 1, 292, 356, 1),
(301, 386, 'Pommes sautee', 'Portion', 1, 369, 356, 1),
(303, 386, 'Pommes sautee', 'Portion', 1, 367, 356, 1),
(305, 386, 'Pommes sautee', 'Portion', 1, 368, 356, 1),
(344, 386, 'Pommes sautee', 'Portion', 1, 364, 356, 1),
(345, 160, 'Chikwange', 'piece', 1, 357, 356, 1),
(346, 160, 'Chikwange', 'piece', 1, 304, 356, 1),
(347, 263, 'Riz', 'piece', 1, 304, 356, 1),
(348, 224, 'Makemba main', 'piece', 1, 304, 356, 1),
(349, 259, 'Pommes de terre', 'piece', 1, 304, 356, 1),
(350, 194, 'Frites', 'piece', 1, 304, 356, 1),
(351, 160, 'Chikwange', 'piece', 1, 392, 356, 1),
(360, 386, 'Pommes sautee', 'Portion', 1, 289, 356, 1),
(361, 194, 'Frites', 'piece', 1, 311, 356, 1),
(370, 160, 'Chikwange', 'piece', 1, 299, 356, 1),
(371, 263, 'Riz', 'piece', 1, 299, 356, 1),
(372, 224, 'Makemba main', 'piece', 1, 299, 356, 1),
(373, 196, 'Fufu', 'Ekolo', 1, 299, 356, 1),
(374, 259, 'Pommes de terre', 'piece', 1, 299, 356, 1),
(375, 374, 'Pomme sautee', 'Portion', 1, 299, 356, 1),
(376, 194, 'Frites', 'piece', 1, 299, 356, 1),
(377, 160, 'Chikwange', 'piece', 1, 300, 356, 1),
(378, 263, 'Riz', 'piece', 1, 300, 356, 1),
(379, 224, 'Makemba main', 'piece', 1, 300, 356, 1),
(380, 259, 'Pommes de terre', 'piece', 1, 300, 356, 1),
(381, 194, 'Frites', 'piece', 1, 300, 356, 1),
(382, 386, 'Pommes sautee', 'Portion', 1, 300, 356, 1),
(383, 160, 'Chikwange', 'piece', 1, 303, 356, 1),
(384, 263, 'Riz', 'piece', 1, 303, 356, 1),
(385, 224, 'Makemba main', 'piece', 1, 303, 356, 1),
(386, 196, 'Fufu', 'Ekolo', 1, 303, 356, 1),
(387, 259, 'Pommes de terre', 'piece', 1, 303, 356, 1),
(388, 374, 'Pomme sautee', 'Portion', 1, 303, 356, 1),
(389, 194, 'Frites', 'piece', 1, 303, 356, 1),
(390, 160, 'Chikwange', 'piece', 1, 359, 356, 1),
(391, 263, 'Riz', 'piece', 1, 359, 356, 1),
(392, 224, 'Makemba main', 'piece', 1, 359, 356, 1),
(393, 259, 'Pommes de terre', 'piece', 1, 359, 356, 1),
(394, 194, 'Frites', 'piece', 1, 359, 356, 1),
(395, 386, 'Pommes sautee', 'Portion', 1, 359, 356, 1),
(396, 160, 'Chikwange', 'piece', 1, 383, 356, 1),
(397, 263, 'Riz', 'piece', 1, 383, 356, 1),
(398, 259, 'Pommes de terre', 'piece', 1, 383, 356, 1),
(399, 224, 'Makemba main', 'piece', 1, 383, 356, 1),
(400, 386, 'Pommes sautee', 'Portion', 1, 383, 356, 1),
(401, 386, 'Pommes sautee', 'Portion', 1, 382, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_affectation_caisse`
--

DROP TABLE IF EXISTS `t_affectation_caisse`;
CREATE TABLE IF NOT EXISTS `t_affectation_caisse` (
  `id_affectation` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_caisse` int(11) NOT NULL,
  `date_affect` date NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_affectation`),
  KEY `id_user` (`id_user`,`id_caisse`),
  KEY `id_caisse` (`id_caisse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_annule_reservation`
--

DROP TABLE IF EXISTS `t_annule_reservation`;
CREATE TABLE IF NOT EXISTS `t_annule_reservation` (
  `id_annule` int(11) NOT NULL AUTO_INCREMENT,
  `id_res` int(11) NOT NULL,
  `id_ch` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_regl` int(10) NOT NULL,
  `Montant_retirer` int(15) NOT NULL,
  `monnaie` varchar(10) NOT NULL,
  `poucentage` float NOT NULL,
  `mont_remb` int(12) NOT NULL,
  `date_annule_res` datetime NOT NULL,
  `date_annule` date NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_annule`),
  KEY `id_res` (`id_res`),
  KEY `id_user` (`id_user`),
  KEY `id_ch` (`id_ch`),
  KEY `id_regl` (`id_regl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_caisse`
--

DROP TABLE IF EXISTS `t_caisse`;
CREATE TABLE IF NOT EXISTS `t_caisse` (
  `idcaisse` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idcaisse`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_chambre`
--

DROP TABLE IF EXISTS `t_chambre`;
CREATE TABLE IF NOT EXISTS `t_chambre` (
  `id_ch` int(11) NOT NULL AUTO_INCREMENT,
  `num_ch` varchar(245) NOT NULL,
  `etat_ch` varchar(15) NOT NULL,
  `tarif_ch` decimal(65,10) NOT NULL,
  `monnaie` varchar(20) DEFAULT NULL,
  `reserve` varchar(10) NOT NULL,
  `occupe` varchar(10) NOT NULL,
  `libre` varchar(10) NOT NULL,
  `capacite_init` int(10) NOT NULL,
  `capacite` int(11) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL,
  `niveau` int(11) DEFAULT NULL,
  `id_hotel` int(10) NOT NULL,
  `del` int(11) NOT NULL DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_ch`),
  KEY `id_hotel` (`id_hotel`),
  KEY `niveau` (`niveau`),
  KEY `categorie` (`categorie`),
  KEY `niveau_2` (`niveau`),
  KEY `categorie_2` (`categorie`),
  KEY `categorie_3` (`categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_chambre`
--

INSERT INTO `t_chambre` (`id_ch`, `num_ch`, `etat_ch`, `tarif_ch`, `monnaie`, `reserve`, `occupe`, `libre`, `capacite_init`, `capacite`, `categorie`, `niveau`, `id_hotel`, `del`, `syn`) VALUES
(20, '01', 'propre', '50000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 11, NULL, 328, 0, 1),
(21, '02', 'propre', '25000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 9, NULL, 328, 0, 1),
(22, '03', 'propre', '100000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 11, NULL, 328, 0, 1),
(23, '04', 'propre', '150000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 11, NULL, 328, 0, 1),
(24, '05', 'propre', '80000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 9, NULL, 328, 0, 1),
(25, 'Buanderie', 'propre', '10.0000000000', 'USD', '', '', 'non', 0, NULL, 11, NULL, 328, 0, 1),
(26, 'Location vehicule', 'propre', '5.0000000000', 'USD', '', '', 'non', 0, NULL, 11, NULL, 328, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_chambre_histo`
--

DROP TABLE IF EXISTS `t_chambre_histo`;
CREATE TABLE IF NOT EXISTS `t_chambre_histo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idres_ch` int(11) DEFAULT NULL,
  `idchambre` int(11) DEFAULT NULL,
  `statut` varchar(10) DEFAULT NULL,
  `date_occ` date DEFAULT NULL,
  `date_lib` date DEFAULT NULL,
  `tarif_ch` decimal(65,10) DEFAULT '0.0000000000',
  `qte` float DEFAULT '0',
  `monnaie` varchar(20) DEFAULT NULL,
  `paie` int(11) DEFAULT '1',
  `reserve` int(11) DEFAULT '0',
  `occupe` int(11) DEFAULT '0',
  `libre` int(11) DEFAULT '0',
  `hr_in` time DEFAULT NULL,
  `hr_out` time DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idreserv` (`idres_ch`,`idchambre`),
  KEY `idchambre` (`idchambre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_client`
--

DROP TABLE IF EXISTS `t_client`;
CREATE TABLE IF NOT EXISTS `t_client` (
  `id_client` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `nom_client` varchar(50) DEFAULT NULL,
  `date_naiss_client` date DEFAULT NULL,
  `sexe_client` varchar(15) DEFAULT NULL,
  `etat_civil_client` varchar(20) DEFAULT NULL,
  `nationalite_client` varchar(245) DEFAULT NULL,
  `provenance_client` varchar(25) DEFAULT NULL,
  `num_piece_identite_client` varchar(200) DEFAULT NULL,
  `num_passeport_client` varchar(30) DEFAULT NULL,
  `adresse_provenance_client` varchar(245) DEFAULT NULL,
  `email_client` varchar(245) DEFAULT NULL,
  `telephone_client` varchar(20) DEFAULT NULL,
  `num_pers_contacter_client` varchar(20) DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `pseudo_supp` int(11) DEFAULT '0',
  `en_attente` int(11) DEFAULT '0',
  `type` varchar(20) DEFAULT NULL,
  `type_cl` varchar(100) DEFAULT NULL,
  `id_respo` int(10) DEFAULT NULL,
  `id_hotel` int(11) NOT NULL,
  `nom_entreprise` varchar(100) DEFAULT NULL,
  `id_sousresto` int(11) DEFAULT NULL,
  `id_sous_compte` int(11) DEFAULT NULL,
  `user_attente` int(11) DEFAULT NULL,
  `nbrcouvert` int(11) DEFAULT NULL,
  `idsousdepotfact` int(11) DEFAULT NULL,
  `fusion` int(11) DEFAULT '0',
  `remise` float DEFAULT NULL,
  `ordre` int(11) DEFAULT '100',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_client`),
  KEY `id_respo` (`id_respo`),
  KEY `id_hotel` (`id_hotel`),
  KEY `id_sousresto` (`id_sousresto`),
  KEY `id_sous_compte` (`id_sous_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=2296 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_client`
--

INSERT INTO `t_client` (`id_client`, `code`, `designation`, `nom_client`, `date_naiss_client`, `sexe_client`, `etat_civil_client`, `nationalite_client`, `provenance_client`, `num_piece_identite_client`, `num_passeport_client`, `adresse_provenance_client`, `email_client`, `telephone_client`, `num_pers_contacter_client`, `statut`, `pseudo_supp`, `en_attente`, `type`, `type_cl`, `id_respo`, `id_hotel`, `nom_entreprise`, `id_sousresto`, `id_sous_compte`, `user_attente`, `nbrcouvert`, `idsousdepotfact`, `fusion`, `remise`, `ordre`, `syn`) VALUES
(1814, NULL, NULL, 'Occasionnel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'occasionnel', NULL, NULL, 356, NULL, NULL, NULL, NULL, NULL, 121, 0, NULL, 100, 1),
(1895, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '', 'restaurant', NULL, 356, NULL, 123, NULL, 475, NULL, NULL, 1, NULL, 100, 1),
(2210, 'T1', 'T1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'occupe', 0, 1, 'table', NULL, NULL, 356, NULL, 123, NULL, 505, 0, 121, 0, NULL, 100, 0),
(2211, 'T2', 'T2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'occupe', 0, 1, 'table', NULL, NULL, 356, NULL, 123, NULL, 506, 0, 121, 0, NULL, 100, 0),
(2212, 'T3', 'T3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'occupe', 0, 1, 'table', NULL, NULL, 356, NULL, 123, NULL, 503, 0, 121, 0, NULL, 100, 0),
(2213, 'T4', 'T4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'occupe', 0, 1, 'table', NULL, NULL, 356, NULL, 123, NULL, 506, 0, 121, 0, NULL, 100, 0),
(2214, 'T5', 'T5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'occupe', 0, 1, 'table', NULL, NULL, 356, NULL, 123, NULL, 505, 0, 121, 0, NULL, 100, 0),
(2215, 'T6', 'T6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2216, 'T7', 'T7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 0, 121, 0, NULL, 100, 0),
(2217, 'T8', 'T8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2218, 'T9', 'T9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2219, 'T10', 'T10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2220, 'T11', 'T11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2221, 'T12', 'T12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2222, 'T13', 'T13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2223, 'T14', 'T14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2224, 'T15', 'T15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2225, 'T16', 'T16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2226, 'T17', 'T17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2227, 'T18', 'T18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2228, 'T19', 'T19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2229, 'T20', 'T20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2230, 'T21', 'T21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2231, 'T22', 'T22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2232, 'T23', 'T23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2233, 'T24', 'T24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2234, 'T25', 'T25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2235, 'T26', 'T26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2236, 'T27', 'T27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2237, 'T28', 'T28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2238, 'T29', 'T29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2239, 'T30', 'T30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2240, 'T31', 'T31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2241, 'T32', 'T32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2242, 'T33', 'T33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2243, 'T34', 'T34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2244, 'T35', 'T35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2245, 'T36', 'T36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2246, 'T37', 'T37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2247, 'T38', 'T38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2248, 'T39', 'T39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2249, 'T40', 'T40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2250, 'T41', 'T41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2251, 'T42', 'T42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2252, 'T43', 'T43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2253, 'T44', 'T44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2254, 'T45', 'T45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2255, 'T46', 'T46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2256, 'T47', 'T47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2257, 'T48', 'T48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2258, 'T49', 'T49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2259, 'T50', 'T50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2276, 'V1', 'V1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2277, 'V2', 'V2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2278, 'V3', 'V3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2279, 'V4', 'V4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2280, 'V5', 'V5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2281, 'V6', 'V6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2282, 'V7', 'V7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2283, 'V8', 'V8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2284, 'V9', 'V9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2285, 'V10', 'V10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121, 0, NULL, 100, 0),
(2286, 'V11', 'V11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2287, 'V12', 'V12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2288, 'V13', 'V13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2289, 'V14', 'V14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2290, 'V15', 'V15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2291, 'V16', 'V16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2292, 'V17', 'V17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2293, 'V18', 'V18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2294, 'V19', 'V19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL, 0, NULL, 100, 0),
(2295, 'V20', 'V20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 0, NULL, 0, NULL, 100, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_client_reserve`
--

DROP TABLE IF EXISTS `t_client_reserve`;
CREATE TABLE IF NOT EXISTS `t_client_reserve` (
  `id_client_res` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `id_res` int(11) NOT NULL,
  `responsable` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_client_res`),
  KEY `id_client` (`id_client`,`id_res`),
  KEY `id_res` (`id_res`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_commussionnaire`
--

DROP TABLE IF EXISTS `t_commussionnaire`;
CREATE TABLE IF NOT EXISTS `t_commussionnaire` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `nomcom` varchar(50) NOT NULL,
  `sxcom` varchar(10) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `adr` text NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_company`
--

DROP TABLE IF EXISTS `t_company`;
CREATE TABLE IF NOT EXISTS `t_company` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `nom_c` varchar(245) DEFAULT NULL,
  `etat` int(11) DEFAULT '1',
  `adresse_c` varchar(245) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `idnat` varchar(245) DEFAULT NULL,
  `rccm` varchar(245) DEFAULT NULL,
  `mail_company` varchar(50) DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `num_impot` varchar(20) DEFAULT NULL,
  `cb` varchar(22) DEFAULT NULL,
  `mention` text,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_c`),
  KEY `id_c` (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_company`
--

INSERT INTO `t_company` (`id_c`, `nom_c`, `etat`, `adresse_c`, `logo`, `idnat`, `rccm`, `mail_company`, `ville`, `phone`, `num_impot`, `cb`, `mention`, `syn`) VALUES
(299, 'RESTAURANT CARAVAC', 1, 'Avenue du commerce,Moanda/RDC', 'LogoCaravac.jpg', '01-FA300-N87656X', '25-A-OB348', 'caravacrestaurant@gmail.com', 'Moanda', '+243808080762', '022418A25', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_depot`
--

DROP TABLE IF EXISTS `t_depot`;
CREATE TABLE IF NOT EXISTS `t_depot` (
  `id_depot` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `pseudo_sup` int(10) NOT NULL DEFAULT '0',
  `hotel_id` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_depot`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_depot`
--

INSERT INTO `t_depot` (`id_depot`, `libelle`, `pseudo_sup`, `hotel_id`, `syn`) VALUES
(121, 'CARAVAC', 0, 356, 1),
(122, 'KEMBO', 0, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_droit`
--

DROP TABLE IF EXISTS `t_droit`;
CREATE TABLE IF NOT EXISTS `t_droit` (
  `id_droit` int(10) NOT NULL AUTO_INCREMENT,
  `droit` varchar(15) NOT NULL,
  `libe_droit` varchar(20) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_droit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_facture`
--

DROP TABLE IF EXISTS `t_facture`;
CREATE TABLE IF NOT EXISTS `t_facture` (
  `id_fact` int(10) NOT NULL AUTO_INCREMENT,
  `num_fact` varchar(20) DEFAULT NULL,
  `num_cmd` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `i_souscription` int(11) DEFAULT '0',
  `etat` varchar(20) DEFAULT NULL,
  `etat_cmd` varchar(1) DEFAULT NULL,
  `etat_sousresto` int(10) NOT NULL DEFAULT '0',
  `date_echeance_old` date DEFAULT NULL,
  `date_edition` date DEFAULT NULL,
  `dte_blocage` date DEFAULT NULL,
  `date_echeance` date DEFAULT NULL,
  `date_desactivation` date DEFAULT NULL,
  `montant_total` decimal(65,10) DEFAULT '0.0000000000',
  `mont_tva` decimal(65,10) DEFAULT '0.0000000000',
  `mont_ttc` decimal(65,10) DEFAULT '0.0000000000',
  `mont_ttc_remise` decimal(65,10) DEFAULT '0.0000000000',
  `taux` float DEFAULT NULL,
  `taux_prix` float(10,2) DEFAULT '1.00',
  `tva` float DEFAULT NULL,
  `monnaie` varchar(20) DEFAULT NULL,
  `remise` float(10,2) DEFAULT NULL,
  `majoration` float(10,2) DEFAULT NULL,
  `justification` text,
  `id_res` int(11) DEFAULT NULL,
  `res_ch_id` int(11) DEFAULT NULL,
  `modulecompagny` int(11) DEFAULT NULL,
  `id_hotel` int(10) DEFAULT NULL,
  `id_sousresto` int(10) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `fact1` int(11) NOT NULL DEFAULT '2',
  `mode` varchar(20) DEFAULT NULL,
  `mode2` int(11) DEFAULT '0',
  `dte_time` datetime DEFAULT NULL,
  `date_approbation` date DEFAULT NULL,
  `statut_bon` varchar(15) DEFAULT NULL,
  `souscription_id` int(11) DEFAULT NULL,
  `assujetti` int(11) DEFAULT '1',
  `heb` int(11) NOT NULL DEFAULT '1',
  `montpenalite` decimal(65,10) DEFAULT '0.0000000000',
  `montremb` decimal(65,10) DEFAULT '0.0000000000',
  `tauxremb` float DEFAULT '1',
  `montpaie` decimal(65,10) DEFAULT '0.0000000000',
  `session_id` int(11) DEFAULT NULL,
  `cuisine` int(11) DEFAULT '0',
  `preparer` int(11) DEFAULT '0',
  `nbrcouvert` int(11) DEFAULT NULL,
  `nomcaisse` varchar(245) DEFAULT NULL,
  `fusion` int(11) DEFAULT '0',
  `solde` int(11) DEFAULT '0',
  `note_cmd` text,
  `bool_addition` int(11) DEFAULT '0',
  `serveur_id` int(11) DEFAULT NULL,
  `serveur_name` varchar(100) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  `appear_state` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_fact`),
  KEY `id_res` (`id_res`),
  KEY `id_user` (`id_user`),
  KEY `fact_id` (`modulecompagny`),
  KEY `company_id` (`company_id`),
  KEY `id_hotel` (`id_hotel`),
  KEY `res_ch_id` (`res_ch_id`),
  KEY `id_client` (`id_client`),
  KEY `id_client_2` (`id_client`),
  KEY `id_sousresto` (`id_sousresto`),
  KEY `souscription_id` (`souscription_id`),
  KEY `session_id` (`session_id`),
  KEY `session_id_2` (`session_id`),
  KEY `serveur_id` (`serveur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_facture`
--

INSERT INTO `t_facture` (`id_fact`, `num_fact`, `num_cmd`, `type`, `i_souscription`, `etat`, `etat_cmd`, `etat_sousresto`, `date_echeance_old`, `date_edition`, `dte_blocage`, `date_echeance`, `date_desactivation`, `montant_total`, `mont_tva`, `mont_ttc`, `mont_ttc_remise`, `taux`, `taux_prix`, `tva`, `monnaie`, `remise`, `majoration`, `justification`, `id_res`, `res_ch_id`, `modulecompagny`, `id_hotel`, `id_sousresto`, `company_id`, `id_user`, `id_client`, `fact1`, `mode`, `mode2`, `dte_time`, `date_approbation`, `statut_bon`, `souscription_id`, `assujetti`, `heb`, `montpenalite`, `montremb`, `tauxremb`, `montpaie`, `session_id`, `cuisine`, `preparer`, `nbrcouvert`, `nomcaisse`, `fusion`, `solde`, `note_cmd`, `bool_addition`, `serveur_id`, `serveur_name`, `syn`, `appear_state`) VALUES
(25, '84852', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '128500.0000000000', '0.0000000000', '128500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 25, NULL, NULL, 356, 123, 299, 505, 2216, 2, 'Cash', 1, '2026-04-19 12:07:58', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(26, '84853', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '54000.0000000000', '0.0000000000', '54000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 26, NULL, NULL, 356, 123, 299, 504, 2210, 2, 'Cash', 1, '2026-04-19 12:13:14', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(27, '84854', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '17000.0000000000', '0.0000000000', '17000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 27, NULL, NULL, 356, 123, 299, 504, 2211, 2, 'Cash', 1, '2026-04-19 12:14:50', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(28, '84855', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '77500.0000000000', '0.0000000000', '77500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 28, NULL, NULL, 356, 123, 299, 505, 2217, 2, 'Cash', 1, '2026-04-19 12:33:27', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(29, '84856', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '39000.0000000000', '0.0000000000', '39000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 29, NULL, NULL, 356, 123, 299, 505, 2218, 2, 'Cash', 1, '2026-04-19 12:36:35', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(30, '84857', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '18000.0000000000', '0.0000000000', '18000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 30, NULL, NULL, 356, 123, 299, 505, 2219, 2, 'Cash', 1, '2026-04-19 12:44:28', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(31, '84858', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '126500.0000000000', '0.0000000000', '126500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 31, NULL, NULL, 356, 123, 299, 504, 2212, 2, 'Cash', 1, '2026-04-19 13:30:49', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(32, '84859', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '27000.0000000000', '0.0000000000', '27000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 32, NULL, NULL, 356, 123, 299, 505, 2214, 2, 'Cash', 1, '2026-04-19 13:38:41', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(33, '84860', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '7000.0000000000', '0.0000000000', '7000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 33, NULL, NULL, 356, 123, 299, 501, 2213, 2, 'Cash', 1, '2026-04-19 14:30:03', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(34, '84861', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '60500.0000000000', '0.0000000000', '60500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 34, NULL, NULL, 356, 123, 299, 506, 2214, 2, 'Cash', 1, '2026-04-19 14:35:48', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 31, 'ESPERANCE  BAHITAPE', 0, 0),
(35, '84862', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '93000.0000000000', '0.0000000000', '93000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 35, NULL, NULL, 356, 123, 299, 506, 2215, 2, 'Cash', 1, '2026-04-19 15:24:38', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 31, 'ESPERANCE  BAHITAPE', 0, 0),
(36, '84863', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '219500.0000000000', '0.0000000000', '219500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 36, NULL, NULL, 356, 123, 299, 503, 2216, 2, 'Cash', 1, '2026-04-19 15:31:30', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 0, 0),
(37, '84864', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '175500.0000000000', '0.0000000000', '175500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 37, NULL, NULL, 356, 123, 299, 501, 2217, 2, 'Cash', 1, '2026-04-19 15:33:56', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(38, '84865', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 38, NULL, NULL, 356, 123, 299, 504, 2212, 2, 'Cash', 1, '2026-04-19 15:37:11', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(39, '84866', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '3500.0000000000', '0.0000000000', '3500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 39, NULL, NULL, 356, 123, 299, 504, 2212, 2, 'Cash', 1, '2026-04-19 15:44:49', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(40, '84867', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '10500.0000000000', '0.0000000000', '10500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 40, NULL, NULL, 356, 123, 299, 504, 2218, 2, 'Cash', 1, '2026-04-19 15:56:46', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(41, '84868', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '7000.0000000000', '0.0000000000', '7000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 41, NULL, NULL, 356, 123, 299, 501, 2212, 2, 'Cash', 1, '2026-04-19 16:11:45', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(42, '84869', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '13500.0000000000', '0.0000000000', '13500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 42, NULL, NULL, 356, 123, 299, 504, 2220, 2, 'Cash', 1, '2026-04-19 16:18:02', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(43, '84870', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '73500.0000000000', '0.0000000000', '73500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 43, NULL, NULL, 356, 123, 299, 501, 2221, 2, 'Cash', 1, '2026-04-19 16:24:52', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(44, '84871', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '36000.0000000000', '0.0000000000', '36000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 44, NULL, NULL, 356, 123, 299, 504, 2222, 2, 'Cash', 1, '2026-04-19 16:31:41', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(45, '84872', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '349000.0000000000', '0.0000000000', '349000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 45, NULL, NULL, 356, 123, 299, 501, 2216, 2, 'Cash', 1, '2026-04-19 17:15:21', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(46, '84873', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '35500.0000000000', '0.0000000000', '35500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 46, NULL, NULL, 356, 123, 299, 504, 2220, 2, 'Cash', 1, '2026-04-19 17:18:20', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(47, '84874', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '7000.0000000000', '0.0000000000', '7000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 47, NULL, NULL, 356, 123, 299, 501, 2223, 2, 'Cash', 1, '2026-04-19 17:19:28', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(48, '84875', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 48, NULL, NULL, 356, 123, 299, 504, 2224, 2, 'Cash', 1, '2026-04-19 17:23:55', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(49, '84876', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '9000.0000000000', '0.0000000000', '9000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 49, NULL, NULL, 356, 123, 299, 501, 2225, 2, 'Cash', 1, '2026-04-19 17:25:23', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(50, '84877', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '23500.0000000000', '0.0000000000', '23500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 50, NULL, NULL, 356, 123, 299, 503, 2226, 2, 'Cash', 1, '2026-04-19 17:29:43', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 0, 0),
(51, '84878', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '13000.0000000000', '0.0000000000', '13000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 51, NULL, NULL, 356, 123, 299, 503, 2227, 2, 'Cash', 1, '2026-04-19 17:35:35', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 0, 0),
(52, '84879', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '44000.0000000000', '0.0000000000', '44000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 52, NULL, NULL, 356, 123, 299, 506, 2215, 2, 'Cash', 1, '2026-04-19 17:54:37', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 31, 'ESPERANCE  BAHITAPE', 0, 0),
(53, '84880', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '10500.0000000000', '0.0000000000', '10500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 53, NULL, NULL, 356, 123, 299, 505, 2212, 2, 'Cash', 1, '2026-04-19 18:06:15', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(54, '84881', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '16500.0000000000', '0.0000000000', '16500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 54, NULL, NULL, 356, 123, 299, 504, 2213, 2, 'Cash', 1, '2026-04-19 18:07:37', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(55, '84882', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '57500.0000000000', '0.0000000000', '57500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 55, NULL, NULL, 356, 123, 299, 506, 2212, 2, 'Cash', 1, '2026-04-19 18:13:16', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 31, 'ESPERANCE  BAHITAPE', 0, 0),
(56, '84883', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '118500.0000000000', '0.0000000000', '118500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 56, NULL, NULL, 356, 123, 299, 503, 2214, 2, 'Cash', 1, '2026-04-19 18:19:38', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 0, 0),
(57, '84884', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '59000.0000000000', '0.0000000000', '59000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 57, NULL, NULL, 356, 123, 299, 501, 2221, 2, 'Cash', 1, '2026-04-19 18:26:25', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 0, 0),
(58, '84885', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '150500.0000000000', '0.0000000000', '150500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 58, NULL, NULL, 356, 123, 299, 504, 2223, 2, 'Cash', 1, '2026-04-19 18:29:25', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(59, '84886', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '27000.0000000000', '0.0000000000', '27000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 59, NULL, NULL, 356, 123, 299, 504, 2212, 2, 'Cash', 1, '2026-04-19 18:36:19', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(60, '84887', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '67500.0000000000', '0.0000000000', '67500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 60, NULL, NULL, 356, 123, 299, 505, 2215, 2, 'Cash', 1, '2026-04-19 18:41:11', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(61, '84888', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '7000.0000000000', '0.0000000000', '7000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 61, NULL, NULL, 356, 123, 299, 504, 2225, 2, 'Cash', 1, '2026-04-19 18:47:13', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(62, '84889', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '30000.0000000000', '0.0000000000', '30000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 62, NULL, NULL, 356, 123, 299, 506, 2227, 2, 'Cash', 1, '2026-04-19 18:51:06', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 31, 'ESPERANCE  BAHITAPE', 0, 0),
(63, '84890', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 63, NULL, NULL, 356, 123, 299, 504, 2228, 2, 'Cash', 1, '2026-04-19 18:57:02', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(64, '84891', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '62000.0000000000', '0.0000000000', '62000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 64, NULL, NULL, 356, 123, 299, 505, 2212, 2, 'Cash', 1, '2026-04-19 19:08:10', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(65, '84892', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '55000.0000000000', '0.0000000000', '55000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 65, NULL, NULL, 356, 123, 299, 505, 2229, 2, 'Cash', 1, '2026-04-19 19:10:22', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(66, '84893', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '16500.0000000000', '0.0000000000', '16500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 66, NULL, NULL, 356, 123, 299, 504, 2218, 2, 'Cash', 1, '2026-04-19 19:19:27', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 33, 'TRYPHENE KAZADI', 0, 0),
(67, '84894', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '132000.0000000000', '0.0000000000', '132000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 67, NULL, NULL, 356, 123, 299, 503, 2210, 2, 'Cash', 1, '2026-04-19 19:37:09', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 0, 0),
(68, '84895', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '6500.0000000000', '0.0000000000', '6500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 68, NULL, NULL, 356, 123, 299, 503, 2216, 2, 'Cash', 1, '2026-04-19 19:47:27', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 0, 0),
(69, '84896', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '13500.0000000000', '0.0000000000', '13500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 69, NULL, NULL, 356, 123, 299, 505, 2218, 2, 'Cash', 1, '2026-04-19 19:50:05', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(70, '84897', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '55000.0000000000', '0.0000000000', '55000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 70, NULL, NULL, 356, 123, 299, 505, 2214, 2, 'Cash', 1, '2026-04-19 20:26:22', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(71, '84898', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-19', NULL, NULL, NULL, '16500.0000000000', '0.0000000000', '16500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 71, NULL, NULL, 356, 123, 299, 503, 2214, 2, 'Cash', 1, '2026-04-19 20:48:26', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 0, 0),
(72, '84899', NULL, 'restaurant', 0, '0', '3', 0, NULL, '2026-04-20', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '91500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 72, NULL, NULL, 356, 123, 299, 501, 2210, 2, NULL, 0, '2026-04-20 11:40:39', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, NULL, 0, 0, '', 0, 35, 'SIMEON  KANYINDA', 1, 1),
(73, '84900', NULL, 'restaurant', 0, '0', '3', 0, NULL, '2026-04-20', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '143000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 73, NULL, NULL, 356, 123, 299, 508, 2210, 2, NULL, 0, '2026-04-20 11:47:29', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, NULL, 0, 0, '', 0, 31, 'ESPERANCE  BAHITAPE', 1, 1),
(74, '84901', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '49000.0000000000', '0.0000000000', '49000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 74, NULL, NULL, 356, 123, 299, 506, 2211, 2, 'Cash', 1, '2026-04-20 12:09:33', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'BESKY BENDA ', 0, 0, '', 0, 31, 'ESPERANCE  BAHITAPE', 0, 0),
(75, '84902', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 75, NULL, NULL, 356, 123, 299, 506, 2210, 2, 'Cash', 1, '2026-04-20 12:18:40', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'BESKY BENDA ', 0, 0, '', 0, 31, 'ESPERANCE STELLA  BAHITAPE', 0, 0),
(76, '84903', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '17000.0000000000', '0.0000000000', '17000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 76, NULL, NULL, 356, 123, 299, 505, 2211, 2, 'Cash', 1, '2026-04-20 12:34:37', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'BESKY BENDA ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(77, '84904', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '13500.0000000000', '0.0000000000', '13500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 77, NULL, NULL, 356, 123, 299, 507, 2210, 2, 'Cash', 1, '2026-04-20 12:36:00', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'BESKY BENDA ', 0, 0, '', 0, 505, 'TONY MBAYI', 0, 0),
(78, '84907', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '2500.0000000000', '0.0000000000', '2500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 80, NULL, NULL, 356, 123, 299, 505, 2211, 2, 'Cash', 1, '2026-04-20 14:53:26', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'BESKY BENDA ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(79, '84908', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '113500.0000000000', '0.0000000000', '113500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 81, NULL, NULL, 356, 123, 299, 507, 2212, 2, 'Cash', 1, '2026-04-20 14:57:00', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'BESKY BENDA ', 0, 0, '', 0, 505, 'TONY MBAYI', 0, 0),
(80, '84909', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 82, NULL, NULL, 356, 123, 299, 505, 2211, 2, 'Cash', 1, '2026-04-20 15:26:02', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'BESKY BENDA ', 0, 0, '', 0, 32, 'TONY MBAYI', 0, 0),
(81, '84910', NULL, 'restaurant', 0, '0', '1', 0, NULL, '2026-04-20', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '40000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 83, NULL, NULL, 356, 123, 299, 506, 2211, 2, NULL, 0, '2026-04-20 17:45:22', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, NULL, 0, 0, '', 0, 31, 'ESPERANCE STELLA  BAHITAPE', 1, 1),
(82, '84911', NULL, 'restaurant', 0, '0', '1', 0, NULL, '2026-04-20', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '8000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 84, NULL, NULL, 356, 123, 299, 503, 2212, 2, NULL, 0, '2026-04-20 17:49:34', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, NULL, 0, 0, '', 0, 34, 'GEMIMA  KIBIKULA', 1, 1),
(83, '84912', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '7500.0000000000', '0.0000000000', '7500.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 85, NULL, NULL, 356, 123, 299, 508, 2210, 2, 'Cash', 1, '2026-04-20 18:17:22', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 506, 'ESPERANCE STELLA  BAHITAPE', 0, 0),
(84, '84913', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '7000.0000000000', '0.0000000000', '7000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 86, NULL, NULL, 356, 123, 299, 508, 2210, 2, 'Cash', 1, '2026-04-20 18:24:21', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 503, 'GEMIMA  KIBIKULA', 0, 0),
(85, '84914', NULL, 'restaurant', 0, '0', '1', 0, NULL, '2026-04-20', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '19000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 87, NULL, NULL, 356, 123, 299, 505, 2210, 2, NULL, 0, '2026-04-20 19:10:20', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, 0, NULL, 0, 0, '', 0, 32, 'TONY MBAYI', 1, 1),
(86, '84915', NULL, 'restaurant', 0, '0', '1', 0, NULL, '2026-04-20', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '103000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 88, NULL, NULL, 356, 123, 299, 506, 2213, 2, NULL, 0, '2026-04-20 19:12:22', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, NULL, 0, 0, '', 0, 31, 'ESPERANCE STELLA  BAHITAPE', 1, 1),
(87, '84916', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 89, NULL, NULL, 356, 123, 299, 508, 2214, 2, 'Cash', 1, '2026-04-20 19:13:29', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 503, 'GEMIMA  KIBIKULA', 0, 0),
(88, '84917', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2026-04-20', NULL, NULL, NULL, '10000.0000000000', '0.0000000000', '10000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 90, NULL, NULL, 356, 123, 299, 508, 2215, 2, 'Cash', 1, '2026-04-20 19:14:37', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, 'SABRINA SELE ', 0, 0, '', 0, 503, 'GEMIMA  KIBIKULA', 0, 0),
(89, '84918', NULL, 'restaurant', 0, '0', '1', 0, NULL, '2026-04-20', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '43000.0000000000', '0.0000000000', 2200, 2200.00, 0, 'CDF', 0.00, NULL, NULL, 91, NULL, NULL, 356, 123, 299, 505, 2214, 2, NULL, 0, '2026-04-20 19:24:07', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 0, NULL, 0, 0, '', 0, 32, 'TONY MBAYI', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_histo_heberge`
--

DROP TABLE IF EXISTS `t_histo_heberge`;
CREATE TABLE IF NOT EXISTS `t_histo_heberge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idreserv` int(11) DEFAULT NULL,
  `idchambre` int(11) DEFAULT NULL,
  `statut` varchar(10) NOT NULL,
  `date_occ` date DEFAULT NULL,
  `date_lib` date DEFAULT NULL,
  `monnaie` varchar(20) DEFAULT NULL,
  `tarif_ch` float NOT NULL,
  `idfact` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idreserv` (`idreserv`,`idchambre`),
  KEY `idchambre` (`idchambre`),
  KEY `idfact` (`idfact`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_hotel`
--

DROP TABLE IF EXISTS `t_hotel`;
CREATE TABLE IF NOT EXISTS `t_hotel` (
  `id_hotel` int(10) NOT NULL AUTO_INCREMENT,
  `nom_hotel` varchar(50) DEFAULT NULL,
  `adresse_hotel` text,
  `province_hotel` varchar(20) DEFAULT NULL,
  `ville_hotel` varchar(20) DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `default_site` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `statut_site` varchar(20) DEFAULT NULL,
  `idnat` varchar(245) DEFAULT NULL,
  `rccm` varchar(245) DEFAULT NULL,
  `mail` varchar(245) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `num_impot` varchar(20) DEFAULT NULL,
  `cb` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `nbre_user` int(11) DEFAULT NULL,
  `nbre_user_add` int(10) DEFAULT NULL,
  `state_paie_user` int(10) NOT NULL DEFAULT '0',
  `pointage` int(11) DEFAULT '0',
  `activite` varchar(245) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_hotel`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_hotel`
--

INSERT INTO `t_hotel` (`id_hotel`, `nom_hotel`, `adresse_hotel`, `province_hotel`, `ville_hotel`, `etat`, `default_site`, `company_id`, `statut_site`, `idnat`, `rccm`, `mail`, `phone`, `num_impot`, `cb`, `image`, `nbre_user`, `nbre_user_add`, `state_paie_user`, `pointage`, `activite`, `syn`) VALUES
(271, 'ntc_2014', '', '', '', 0, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '', 1),
(356, 'RESTAURANT CARAVAC', 'Avenue du commerce', '', 'Moanda/RDC', 1, 1, 299, 'opÃ©rationnel', '01-FA300-N87656X', '25-A-OB348', 'caravacrestaurant@gmail.com', '+243808080762', '022418A25', NULL, 'LogoCaravac.jpg', 41, NULL, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_ingredient`
--

DROP TABLE IF EXISTS `t_ingredient`;
CREATE TABLE IF NOT EXISTS `t_ingredient` (
  `id_ingred` int(10) NOT NULL AUTO_INCREMENT,
  `produit_id` int(10) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `unite` varchar(25) NOT NULL,
  `quantite` float NOT NULL,
  `prix` float DEFAULT NULL,
  `plat_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_ingred`),
  KEY `produit_id` (`produit_id`,`plat_id`),
  KEY `plat_id` (`plat_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_ingredient`
--

INSERT INTO `t_ingredient` (`id_ingred`, `produit_id`, `designation`, `unite`, `quantite`, `prix`, `plat_id`, `hotel_id`, `syn`) VALUES
(36, 2024, 'Bonbons', 'g', 100, NULL, 2025, 356, 1),
(38, 145, 'Ananas', 'piece', 1, NULL, 366, 356, 1),
(45, 647, 'vodka fineline (btl)', 'piece', 0.04, NULL, 648, 356, 1),
(51, 444, 'Pina colada (Btl)', 'piece', 0.04, NULL, 445, 356, 1),
(58, 85, 'Johnny Walker Red Bouteille', 'piece', 0.04, NULL, 60, 356, 1),
(83, 466, 'Baileys  70cl', 'piece', 0.04, NULL, 467, 356, 1),
(90, 104, 'Campari Bouteilles 70cl', 'piece', 0.05, NULL, 582, 356, 1),
(91, 101, 'Martini Rouge Bouteilles 1L', 'piece', 0.05, NULL, 582, 356, 1),
(92, 20, 'Soda', 'piece', 1, NULL, 582, 356, 1),
(115, 761, 'Jus de Papaye 1L', 'piece', 0.333333, NULL, 404, 356, 1),
(116, 658, 'Jus Multifruit 1L', 'piece', 0.333333, NULL, 712, 356, 1),
(121, 658, 'Jus Multifruit 1L', 'piece', 0.333333, NULL, 55, 356, 1),
(122, 83, 'Bacardi Bouteille', 'piece', 0.05, NULL, 55, 356, 1),
(138, 103, 'Gordon Gin  Bouteille', 'piece', 0.05, NULL, 623, 356, 1),
(139, 102, 'Martini Rose Bouteilles 1L', 'piece', 0.05, NULL, 623, 356, 1),
(140, 104, 'Campari Bouteilles 70cl', 'piece', 0.05, NULL, 623, 356, 1),
(157, 93, 'Johnny Walker double black 75cl (Btl)', 'piece', 0.04, NULL, 483, 356, 1),
(163, 406, 'Kwilu 75CL (Btl)', 'piece', 0.04, NULL, 405, 356, 1),
(171, 474, 'Johnny Walker Bleu label 75cl', 'piece', 0.04, NULL, 475, 356, 1),
(175, 95, 'Vodka Absolut(Btl) 75Cl', 'piece', 0.05, NULL, 577, 356, 1),
(176, 617, 'Curacao bleu 70cl liqueur (Btl)', 'piece', 0.02, NULL, 577, 356, 1),
(177, 531, 'Sprite plastic', 'piece', 1, NULL, 577, 356, 1),
(182, 667, 'Sirop de Menthe', 'piece', 0.02, NULL, 720, 356, 1),
(189, 410, 'Malibu (Btl)', 'piece', 0.04, NULL, 411, 356, 1),
(190, 98, 'Cointreau Bouteille', 'piece', 0.05, NULL, 56, 356, 1),
(191, 96, 'Tequila Olmeca (Btl)', 'piece', 0.05, NULL, 56, 356, 1),
(192, 165, 'Citron', 'piece', 1, NULL, 56, 356, 1),
(193, 83, 'Bacardi Bouteille', 'piece', 0.05, NULL, 571, 356, 1),
(194, 20, 'Soda', 'piece', 1, NULL, 571, 356, 1),
(197, 410, 'Malibu (Btl)', 'piece', 0.05, NULL, 57, 356, 1),
(198, 444, 'Pina colada (Btl)', 'piece', 0.03, NULL, 57, 356, 1),
(200, 708, 'Nespresso', 'paquet', 1, NULL, 46, 356, 1),
(202, 82, 'Capitain Morgan 70cl (Btl)', 'piece', 0.05, NULL, 581, 356, 1),
(203, 165, 'Citron', 'piece', 1, NULL, 581, 356, 1),
(204, 4, 'Coca-cola', 'piece', 1, NULL, 581, 356, 1),
(210, 657, 'Jus orange 1L', 'piece', 0.333333, NULL, 22, 356, 1),
(213, 104, 'Campari Bouteilles 70cl', 'piece', 0.04, NULL, 49, 356, 1),
(216, 97, 'Porto Ruby Bouteilles', 'piece', 0.04, NULL, 54, 356, 1),
(217, 635, 'Porto sandeman', 'piece', 0.04, NULL, 636, 356, 1),
(218, 84, 'J B Bouteilles', 'piece', 0.04, NULL, 59, 356, 1),
(220, 82, 'Capitain Morgan 70cl (Btl)', 'piece', 0.266667, NULL, 62, 356, 1),
(221, 458, 'Vodka Smirnoff (Btl)', 'piece', 0.04, NULL, 61, 356, 1),
(222, 95, 'Vodka Absolut(Btl) 75Cl', 'piece', 0.04, NULL, 64, 356, 1),
(225, 90, 'Johnny Walker black label 75cl(Btl)', 'piece', 0.04, NULL, 473, 356, 1),
(232, 918, 'Jus multi verre', 'Verre', 0.33, NULL, 918, 356, 1),
(233, 916, 'jus de papaye 1 l', 'piece', 0.33, NULL, 915, 356, 1),
(234, 657, 'Jus orange 1L', 'piece', 0.33, NULL, 954, 356, 1),
(235, 912, 'Jus d\'ananas 1l', 'piece', 0.33, NULL, 913, 356, 1),
(240, 105, 'Gin Btl', 'piece', 0.17, NULL, 111, 356, 1),
(243, 105, 'Gin Btl', 'piece', 0.11, NULL, 104, 356, 1),
(244, 112, 'Ricard btl', 'piece', 0.11, NULL, 110, 356, 1),
(245, 113, 'Red label', 'piece', 0.11, NULL, 114, 356, 1),
(246, 115, 'Absolut vodka', 'piece', 0.11, NULL, 116, 356, 1),
(251, 77, 'Merlot RosÃ© Btl', 'piece', 0.2, NULL, 123, 356, 1),
(252, 103, 'Rhum Btl', 'piece', 0.1, NULL, 0, 356, 1),
(253, 103, 'Rhum Btl', 'piece', 0.1, NULL, 102, 356, 1),
(256, 127, 'verry peche btl', 'piece', 0.16, NULL, 0, 356, 1),
(260, 143, 'Syrah rose', 'piece', 0.2, NULL, 144, 356, 1),
(269, 96, 'Top orange', 'piece', 1, NULL, 162, 356, 1),
(270, 92, 'Eau vive bleu', 'piece', 1, NULL, 164, 356, 1),
(273, 96, 'Top orange', 'piece', 1, NULL, 170, 356, 1),
(274, 117, 'Cuerpo btl', 'piece', 0.1, NULL, 118, 356, 1),
(275, 142, 'NESPRESSO', 'piece', 1, NULL, 174, 356, 1),
(277, 149, 'Tonic', 'piece', 1, NULL, 176, 356, 1),
(278, 105, 'Gin Btl', 'piece', 0.11, NULL, 176, 356, 1),
(279, 92, 'Eau vive bleu', 'piece', 1, NULL, 169, 356, 1),
(281, 130, 'Verry cerise btl', 'piece', 1.16, NULL, 131, 356, 1),
(282, 132, 'Verry framboise btl', 'piece', 0.16, NULL, 133, 356, 1),
(283, 125, 'Verry pamplemousse', 'piece', 0.16, NULL, 126, 356, 1),
(285, 134, 'Verry pasteque', 'piece', 0.16, NULL, 135, 356, 1),
(286, 127, 'verry peche btl', 'piece', 0.16, NULL, 128, 356, 1),
(288, 179, 'Fut top limonade', 'piece', 0.025, NULL, 181, 356, 1),
(294, 179, 'Fut top limonade', 'piece', 0.0125, NULL, 91, 356, 1),
(295, 141, 'Gd eau vive rouge', 'piece', 1, NULL, 161, 356, 1),
(296, 140, 'Gd eau vive bleu', 'piece', 1, NULL, 160, 356, 1),
(299, 120, 'Verre verry passion', 'Mesurette', 0.16, NULL, 120, 356, 1),
(300, 76, 'Merlot Rouge Btl', 'piece', 0.2, NULL, 121, 356, 1),
(301, 78, 'Sauvignon Blanc Btl', 'piece', 0.2, NULL, 122, 356, 1),
(302, 130, 'Very cerise btl', 'piece', 0.16, NULL, 0, 356, 1),
(305, 136, 'Very melon btl', 'piece', 0.16, NULL, 243, 356, 1),
(312, 189, 'Fut top college', 'piece', 0.025, NULL, 190, 356, 1),
(315, 659, 'Jus Ananas 1L', 'piece', 0.333333, NULL, 23, 356, 1),
(323, 249, 'Fut castel', 'piece', 0.025, NULL, 251, 356, 1),
(324, 249, 'Fut castel', 'piece', 0.0125, NULL, 250, 356, 1),
(325, 178, 'Fut skol pression', 'piece', 0.025, NULL, 90, 356, 1),
(326, 178, 'Fut skol pression', 'piece', 0.0125, NULL, 89, 356, 1),
(331, 130, 'Very cerise btl', 'piece', 0.16, NULL, 241, 356, 1),
(332, 132, 'Very framboise btl', 'piece', 0.16, NULL, 242, 356, 1),
(333, 125, 'Very pamplemousse btl', 'piece', 0.16, NULL, 245, 356, 1),
(334, 119, 'Very passion btl', 'piece', 0.16, NULL, 246, 356, 1),
(335, 134, 'Very pasteque btl', 'piece', 0.16, NULL, 247, 356, 1),
(336, 127, 'very peche btl', 'piece', 0.16, NULL, 248, 356, 1),
(343, 224, 'Makemba main', 'piece', 1, NULL, 365, 356, 1),
(345, 180, 'Fut TEMBO pression', 'piece', 0.025, NULL, 88, 356, 1),
(347, 373, 'Martini Blanc Bouteille 1L', 'piece', 0.04, NULL, 51, 356, 0),
(348, 656, 'Jus pomme 1l', 'piece', 0.33, NULL, 24, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_liberation`
--

DROP TABLE IF EXISTS `t_liberation`;
CREATE TABLE IF NOT EXISTS `t_liberation` (
  `id_lib` int(10) NOT NULL AUTO_INCREMENT,
  `date_lib` datetime NOT NULL,
  `heure_lib` time NOT NULL,
  `id_ch` int(10) NOT NULL,
  `id_client` int(10) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_res` int(11) NOT NULL,
  `id_reser_cham` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `dte_lib` date NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_lib`),
  KEY `num_ch` (`id_ch`,`id_client`),
  KEY `id_client` (`id_client`),
  KEY `id_client_2` (`id_client`),
  KEY `id_hotel` (`id_hotel`),
  KEY `id_res` (`id_res`,`id_user`),
  KEY `id_user` (`id_user`),
  KEY `id_reser_cham` (`id_reser_cham`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_lignesfact_pack`
--

DROP TABLE IF EXISTS `t_lignesfact_pack`;
CREATE TABLE IF NOT EXISTS `t_lignesfact_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `mont_paye` decimal(65,10) NOT NULL DEFAULT '0.0000000000',
  `active` int(11) NOT NULL DEFAULT '0',
  `pack_company_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `fact_id` int(11) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `qte` int(10) DEFAULT '1',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pack_id` (`pack_id`,`fact_id`),
  KEY `fact_id` (`fact_id`),
  KEY `pack_company_id` (`pack_company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_mode_reglement`
--

DROP TABLE IF EXISTS `t_mode_reglement`;
CREATE TABLE IF NOT EXISTS `t_mode_reglement` (
  `id_mode_regl` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `lib` varchar(20) NOT NULL,
  `mobile` int(11) DEFAULT '0',
  `priority` int(11) DEFAULT '0',
  `typemode` int(11) DEFAULT '0',
  `visible` int(11) DEFAULT '1',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_mode_regl`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_mode_reglement`
--

INSERT INTO `t_mode_reglement` (`id_mode_regl`, `code`, `lib`, `mobile`, `priority`, `typemode`, `visible`, `syn`) VALUES
(1, 'don', 'Don', 0, 100, 0, 0, 1),
(2, 'cash', 'Cash', 0, 0, 0, 1, 1),
(3, 'credit', 'Credit', 0, 0, 0, 1, 1),
(4, 'mps', 'M-Pesa', 1, 2, 3, 1, 1),
(5, 'omy', 'Orange Money', 1, 3, 3, 1, 1),
(6, 'amy', 'Airtel Money', 1, 4, 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_modulecompany`
--

DROP TABLE IF EXISTS `t_modulecompany`;
CREATE TABLE IF NOT EXISTS `t_modulecompany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nbreuser` int(11) DEFAULT NULL,
  `nbre_user_maj` int(11) DEFAULT NULL,
  `etat_module` int(11) DEFAULT '1',
  `paye` int(11) DEFAULT '0',
  `montantmodule` float DEFAULT NULL,
  `prix_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `souscription_id` int(11) DEFAULT NULL,
  `date_sous` date DEFAULT NULL,
  `date_activ` date DEFAULT NULL,
  `date_echeance` date DEFAULT NULL,
  `dte_blocage` date DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `nbre_agent` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`,`module_id`),
  KEY `module_id` (`module_id`),
  KEY `souscription_id` (`souscription_id`),
  KEY `souscription_id_2` (`souscription_id`),
  KEY `prix` (`prix_id`),
  KEY `site_id` (`site_id`),
  KEY `prix_id` (`prix_id`,`company_id`,`module_id`,`souscription_id`,`site_id`),
  KEY `pack_id` (`pack_id`)
) ENGINE=InnoDB AUTO_INCREMENT=521 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_modulecompany`
--

INSERT INTO `t_modulecompany` (`id`, `nbreuser`, `nbre_user_maj`, `etat_module`, `paye`, `montantmodule`, `prix_id`, `pack_id`, `company_id`, `module_id`, `souscription_id`, `date_sous`, `date_activ`, `date_echeance`, `dte_blocage`, `site_id`, `nbre_agent`, `syn`) VALUES
(447, 0, 0, 1, 0, 0, 9, 197, 283, 28, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0, 1),
(448, 0, 0, 1, 0, 0, 9, 197, 283, 23, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0, 1),
(449, 0, 0, 1, 0, 0, 9, 197, 283, 22, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0, 1),
(450, 0, 0, 1, 0, 0, 9, 197, 283, 24, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0, 1),
(451, 0, 0, 1, 0, 0, 9, 197, 283, 21, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0, 1),
(515, 0, 0, 1, 0, 0, 11, 224, 298, 28, 198, '2019-12-11', NULL, NULL, NULL, 355, 0, 1),
(516, 0, 0, 1, 0, 0, 11, 224, 298, 22, 198, '2019-12-11', NULL, NULL, NULL, 355, 0, 1),
(517, 0, 0, 1, 0, 0, 11, 224, 298, 24, 198, '2019-12-11', NULL, NULL, NULL, 355, 0, 1),
(518, 0, 0, 1, 0, 0, 11, 225, 299, 28, 199, '2019-12-11', NULL, NULL, NULL, 356, 0, 1),
(519, 0, 0, 1, 0, 0, 11, 225, 299, 22, 199, '2019-12-11', NULL, NULL, NULL, 356, 0, 1),
(520, 0, 0, 1, 0, 0, 11, 225, 299, 24, 199, '2019-12-11', NULL, NULL, NULL, 356, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_module_pack`
--

DROP TABLE IF EXISTS `t_module_pack`;
CREATE TABLE IF NOT EXISTS `t_module_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pack_id` (`pack_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_module_pack`
--

INSERT INTO `t_module_pack` (`id`, `module_id`, `pack_id`, `syn`) VALUES
(1, 21, 1, 1),
(2, 23, 4, 1),
(3, 26, 7, 1),
(4, 24, 2, 1),
(5, 28, 5, 1),
(7, 22, 5, 1),
(8, 24, 5, 1),
(9, 28, 6, 1),
(11, 23, 6, 1),
(12, 22, 6, 1),
(13, 24, 6, 1),
(14, 28, 30, 1),
(16, 29, 30, 1),
(17, 24, 30, 1),
(18, 27, 29, 1),
(20, 24, 29, 1),
(21, 28, 29, 1),
(23, 21, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_motif`
--

DROP TABLE IF EXISTS `t_motif`;
CREATE TABLE IF NOT EXISTS `t_motif` (
  `idmotif` int(10) NOT NULL AUTO_INCREMENT,
  `designation` varchar(245) NOT NULL,
  `sorte` varchar(10) DEFAULT NULL,
  `hotel_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idmotif`),
  KEY `hotel_id` (`hotel_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1230 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_motif`
--

INSERT INTO `t_motif` (`idmotif`, `designation`, `sorte`, `hotel_id`, `type_id`, `syn`) VALUES
(1172, 'Hebergement', NULL, 328, 940, 1),
(1173, 'Vente', NULL, 328, 941, 1),
(1174, 'Hebergement', NULL, 329, 944, 1),
(1175, 'Vente', NULL, 329, 945, 1),
(1176, 'Hebergement', NULL, 330, 948, 1),
(1177, 'Vente', NULL, 330, 949, 1),
(1178, 'Hebergement', NULL, 331, 952, 1),
(1179, 'Vente', NULL, 331, 953, 1),
(1180, 'Hebergement', NULL, 332, 956, 1),
(1181, 'Vente', NULL, 332, 957, 1),
(1182, 'Hebergement', NULL, 333, 960, 1),
(1183, 'Vente', NULL, 333, 961, 1),
(1184, 'Hebergement', NULL, 334, 964, 1),
(1185, 'Vente', NULL, 334, 965, 1),
(1186, 'Hebergement', NULL, 335, 968, 1),
(1187, 'Vente', NULL, 335, 969, 1),
(1188, 'Hebergement', NULL, 336, 972, 1),
(1189, 'Vente', NULL, 336, 973, 1),
(1190, 'Hebergement', NULL, 337, 976, 1),
(1191, 'Vente', NULL, 337, 977, 1),
(1192, 'Hebergement', NULL, 338, 980, 1),
(1193, 'Vente', NULL, 338, 981, 1),
(1194, 'Hebergement', NULL, 339, 984, 1),
(1195, 'Vente', NULL, 339, 985, 1),
(1196, 'Hebergement', NULL, 340, 988, 1),
(1197, 'Vente', NULL, 340, 989, 1),
(1198, 'Hebergement', NULL, 341, 992, 1),
(1199, 'Vente', NULL, 341, 993, 1),
(1200, 'Hebergement', NULL, 342, 996, 1),
(1201, 'Vente', NULL, 342, 997, 1),
(1202, 'Hebergement', NULL, 343, 1000, 1),
(1203, 'Vente', NULL, 343, 1001, 1),
(1204, 'Hebergement', NULL, 344, 1004, 1),
(1205, 'Vente', NULL, 344, 1005, 1),
(1206, 'Hebergement', NULL, 345, 1008, 1),
(1207, 'Vente', NULL, 345, 1009, 1),
(1208, 'Hebergement', NULL, 346, 1012, 1),
(1209, 'Vente', NULL, 346, 1013, 1),
(1210, 'Hebergement', NULL, 347, 1016, 1),
(1211, 'Vente', NULL, 347, 1017, 1),
(1212, 'Hebergement', NULL, 348, 1020, 1),
(1213, 'Vente', NULL, 348, 1021, 1),
(1214, 'Hebergement', NULL, 349, 1024, 1),
(1215, 'Vente', NULL, 349, 1025, 1),
(1216, 'Hebergement', NULL, 350, 1028, 1),
(1217, 'Vente', NULL, 350, 1029, 1),
(1218, 'Hebergement', NULL, 351, 1032, 1),
(1219, 'Vente', NULL, 351, 1033, 1),
(1220, 'Hebergement', NULL, 352, 1036, 1),
(1221, 'Vente', NULL, 352, 1037, 1),
(1222, 'Hebergement', NULL, 353, 1040, 1),
(1223, 'Vente', NULL, 353, 1041, 1),
(1224, 'Hebergement', NULL, 354, 1044, 1),
(1225, 'Vente', NULL, 354, 1045, 1),
(1226, 'Hebergement', NULL, 355, 1048, 1),
(1227, 'Vente', NULL, 355, 1049, 1),
(1228, 'Hebergement', NULL, 356, 1052, 1),
(1229, 'Vente', NULL, 356, 1053, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_motif_sortie`
--

DROP TABLE IF EXISTS `t_motif_sortie`;
CREATE TABLE IF NOT EXISTS `t_motif_sortie` (
  `id_motif_sortie` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_motif_sortie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_motif_sortie`
--

INSERT INTO `t_motif_sortie` (`id_motif_sortie`, `libelle`, `etat`, `syn`) VALUES
(1, 'Vente', 1, 1),
(2, 'Perte', 1, 1),
(3, 'Avarie/Expire', 1, 1),
(4, 'Casse', 1, 1),
(5, 'Regularisation', 1, 1),
(6, 'appro', 0, 1),
(7, 'sortie', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_motif_type`
--

DROP TABLE IF EXISTS `t_motif_type`;
CREATE TABLE IF NOT EXISTS `t_motif_type` (
  `idmotiftype` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `visible` int(11) DEFAULT '1',
  `hotel_id` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idmotiftype`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1054 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_motif_type`
--

INSERT INTO `t_motif_type` (`idmotiftype`, `type`, `visible`, `hotel_id`, `syn`) VALUES
(938, 'Heberge', 1, 328, 1),
(939, 'Resto', 1, 328, 1),
(940, 'Entree', 0, 328, 1),
(941, 'Sortie', 0, 328, 1),
(942, 'Heberge', 1, 329, 1),
(943, 'Resto', 1, 329, 1),
(944, 'Entree', 0, 329, 1),
(945, 'Sortie', 0, 329, 1),
(946, 'Heberge', 1, 330, 1),
(947, 'Resto', 1, 330, 1),
(948, 'Entree', 0, 330, 1),
(949, 'Sortie', 0, 330, 1),
(950, 'Heberge', 1, 331, 1),
(951, 'Resto', 1, 331, 1),
(952, 'Entree', 0, 331, 1),
(953, 'Sortie', 0, 331, 1),
(954, 'Heberge', 1, 332, 1),
(955, 'Resto', 1, 332, 1),
(956, 'Entree', 0, 332, 1),
(957, 'Sortie', 0, 332, 1),
(958, 'Heberge', 1, 333, 1),
(959, 'Resto', 1, 333, 1),
(960, 'Entree', 0, 333, 1),
(961, 'Sortie', 0, 333, 1),
(962, 'Heberge', 1, 334, 1),
(963, 'Resto', 1, 334, 1),
(964, 'Entree', 0, 334, 1),
(965, 'Sortie', 0, 334, 1),
(966, 'Heberge', 1, 335, 1),
(967, 'Resto', 1, 335, 1),
(968, 'Entree', 0, 335, 1),
(969, 'Sortie', 0, 335, 1),
(970, 'Heberge', 1, 336, 1),
(971, 'Resto', 1, 336, 1),
(972, 'Entree', 0, 336, 1),
(973, 'Sortie', 0, 336, 1),
(974, 'Heberge', 1, 337, 1),
(975, 'Resto', 1, 337, 1),
(976, 'Entree', 0, 337, 1),
(977, 'Sortie', 0, 337, 1),
(978, 'Heberge', 1, 338, 1),
(979, 'Resto', 1, 338, 1),
(980, 'Entree', 0, 338, 1),
(981, 'Sortie', 0, 338, 1),
(982, 'Heberge', 1, 339, 1),
(983, 'Resto', 1, 339, 1),
(984, 'Entree', 0, 339, 1),
(985, 'Sortie', 0, 339, 1),
(986, 'Heberge', 1, 340, 1),
(987, 'Resto', 1, 340, 1),
(988, 'Entree', 0, 340, 1),
(989, 'Sortie', 0, 340, 1),
(990, 'Heberge', 1, 341, 1),
(991, 'Resto', 1, 341, 1),
(992, 'Entree', 0, 341, 1),
(993, 'Sortie', 0, 341, 1),
(994, 'Heberge', 1, 342, 1),
(995, 'Resto', 1, 342, 1),
(996, 'Entree', 0, 342, 1),
(997, 'Sortie', 0, 342, 1),
(998, 'Heberge', 1, 343, 1),
(999, 'Resto', 1, 343, 1),
(1000, 'Entree', 0, 343, 1),
(1001, 'Sortie', 0, 343, 1),
(1002, 'Heberge', 1, 344, 1),
(1003, 'Resto', 1, 344, 1),
(1004, 'Entree', 0, 344, 1),
(1005, 'Sortie', 0, 344, 1),
(1006, 'Heberge', 1, 345, 1),
(1007, 'Resto', 1, 345, 1),
(1008, 'Entree', 0, 345, 1),
(1009, 'Sortie', 0, 345, 1),
(1010, 'Heberge', 1, 346, 1),
(1011, 'Resto', 1, 346, 1),
(1012, 'Entree', 0, 346, 1),
(1013, 'Sortie', 0, 346, 1),
(1014, 'Heberge', 1, 347, 1),
(1015, 'Resto', 1, 347, 1),
(1016, 'Entree', 0, 347, 1),
(1017, 'Sortie', 0, 347, 1),
(1018, 'Heberge', 1, 348, 1),
(1019, 'Resto', 1, 348, 1),
(1020, 'Entree', 0, 348, 1),
(1021, 'Sortie', 0, 348, 1),
(1022, 'Heberge', 1, 349, 1),
(1023, 'Resto', 1, 349, 1),
(1024, 'Entree', 0, 349, 1),
(1025, 'Sortie', 0, 349, 1),
(1026, 'Heberge', 1, 350, 1),
(1027, 'Resto', 1, 350, 1),
(1028, 'Entree', 0, 350, 1),
(1029, 'Sortie', 0, 350, 1),
(1030, 'Heberge', 1, 351, 1),
(1031, 'Resto', 1, 351, 1),
(1032, 'Entree', 0, 351, 1),
(1033, 'Sortie', 0, 351, 1),
(1034, 'Heberge', 1, 352, 1),
(1035, 'Resto', 1, 352, 1),
(1036, 'Entree', 0, 352, 1),
(1037, 'Sortie', 0, 352, 1),
(1038, 'Heberge', 1, 353, 1),
(1039, 'Resto', 1, 353, 1),
(1040, 'Entree', 0, 353, 1),
(1041, 'Sortie', 0, 353, 1),
(1042, 'Heberge', 1, 354, 1),
(1043, 'Resto', 1, 354, 1),
(1044, 'Entree', 0, 354, 1),
(1045, 'Sortie', 0, 354, 1),
(1046, 'Heberge', 1, 355, 1),
(1047, 'Resto', 1, 355, 1),
(1048, 'Entree', 0, 355, 1),
(1049, 'Sortie', 0, 355, 1),
(1050, 'Heberge', 1, 356, 1),
(1051, 'Resto', 1, 356, 1),
(1052, 'Entree', 0, 356, 1),
(1053, 'Sortie', 0, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_occupation`
--

DROP TABLE IF EXISTS `t_occupation`;
CREATE TABLE IF NOT EXISTS `t_occupation` (
  `id_occ` int(10) NOT NULL AUTO_INCREMENT,
  `type_occ` varchar(20) NOT NULL,
  `date_occ` date NOT NULL,
  `heure_occ` time NOT NULL,
  `id_ch` int(10) NOT NULL,
  `id_client` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_occ`),
  KEY `num_ch` (`id_ch`,`id_client`),
  KEY `id_client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_occupation_direct`
--

DROP TABLE IF EXISTS `t_occupation_direct`;
CREATE TABLE IF NOT EXISTS `t_occupation_direct` (
  `id_occ_d` int(11) NOT NULL AUTO_INCREMENT,
  `date_occ_d` date NOT NULL,
  `heure_occ_d` time NOT NULL,
  `id_ch` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_occ_d`),
  KEY `idch` (`id_ch`),
  KEY `idclient` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_operation`
--

DROP TABLE IF EXISTS `t_operation`;
CREATE TABLE IF NOT EXISTS `t_operation` (
  `idoperation` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `libelle` text,
  `date_bon` date DEFAULT NULL,
  `date_heure_bon` datetime DEFAULT NULL,
  `beneficiaire` varchar(100) DEFAULT NULL,
  `provenance` varchar(100) DEFAULT NULL,
  `montantFC` decimal(65,10) DEFAULT '0.0000000000',
  `montantUSD` decimal(65,10) DEFAULT '0.0000000000',
  `numBon` varchar(50) DEFAULT NULL,
  `indice_be` int(11) NOT NULL DEFAULT '1',
  `indice_bs` int(11) NOT NULL DEFAULT '1',
  `numBordereau` varchar(10) DEFAULT NULL,
  `mode_operation` varchar(10) DEFAULT NULL,
  `session_id` int(10) DEFAULT NULL,
  `motif_id` int(10) DEFAULT NULL,
  `maj` int(11) DEFAULT '0',
  `paie_id` int(11) DEFAULT NULL,
  `user_vers` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hotel_id` int(10) NOT NULL,
  `format` int(50) DEFAULT NULL,
  `detail_id_ecrit` int(11) DEFAULT NULL,
  `psedo` int(11) DEFAULT '0',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idoperation`),
  KEY `motif` (`mode_operation`,`session_id`,`motif_id`,`hotel_id`),
  KEY `session_id` (`session_id`,`motif_id`,`hotel_id`),
  KEY `motif_id` (`motif_id`,`hotel_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `user_vers` (`user_vers`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `paie_id` (`paie_id`),
  KEY `detail_id_ecrit` (`detail_id_ecrit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_pack`
--

DROP TABLE IF EXISTS `t_pack`;
CREATE TABLE IF NOT EXISTS `t_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT '1',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_pack`
--

INSERT INTO `t_pack` (`id`, `libelle`, `etat`, `syn`) VALUES
(1, 'Caisse', 1, 1),
(2, 'Stock', 1, 1),
(3, 'Restaurant', 1, 1),
(4, 'Hebergement', 1, 1),
(5, 'EBU-Restaurant', 1, 1),
(6, 'EBU-hotel', 1, 1),
(7, 'Ressources humaines', 1, 1),
(26, 'Facturation', 1, 1),
(27, 'Achat', 1, 1),
(28, 'Point de vente', 1, 1),
(29, 'EBU-Facturation', 1, 1),
(30, 'EBU-POS', 1, 1),
(31, 'Achat utilisateur', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_pack_company`
--

DROP TABLE IF EXISTS `t_pack_company`;
CREATE TABLE IF NOT EXISTS `t_pack_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT '1',
  `prix_id` int(11) DEFAULT NULL,
  `souscript_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pack_id` (`pack_id`),
  KEY `company_id` (`company_id`),
  KEY `site_id` (`site_id`),
  KEY `prix_id` (`prix_id`,`souscript_id`),
  KEY `souscript_id` (`souscript_id`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_pack_company`
--

INSERT INTO `t_pack_company` (`id`, `pack_id`, `company_id`, `etat`, `prix_id`, `souscript_id`, `site_id`, `syn`) VALUES
(225, 5, 299, 0, 11, 199, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_prix_produit`
--

DROP TABLE IF EXISTS `t_prix_produit`;
CREATE TABLE IF NOT EXISTS `t_prix_produit` (
  `id_prix` int(10) NOT NULL AUTO_INCREMENT,
  `prix_vente` float DEFAULT NULL,
  `monnaie` varchar(10) DEFAULT NULL,
  `produit_id` int(10) DEFAULT NULL,
  `sousresto_id` int(10) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_prix`),
  KEY `produit_id` (`produit_id`,`sousresto_id`),
  KEY `sousresto_id` (`sousresto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1329 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_prix_produit`
--

INSERT INTO `t_prix_produit` (`id_prix`, `prix_vente`, `monnaie`, `produit_id`, `sousresto_id`, `syn`) VALUES
(2, 1.5, 'CDF', 0, 123, 1),
(3, 1.5, 'CDF', 0, 123, 1),
(4, 1.5, 'CDF', 0, 123, 1),
(5, 1.5, 'CDF', 0, 123, 1),
(6, 1.5, 'CDF', 0, 123, 1),
(7, 1.5, 'CDF', 0, 123, 1),
(8, 1.5, 'CDF', 0, 123, 1),
(10, 2, 'CDF', 3, 123, 1),
(11, 5, 'CDF', 4, 123, 1),
(12, 8, 'CDF', 5, 123, 1),
(13, 10, 'CDF', 6, 123, 1),
(14, 15, 'CDF', 7, 123, 1),
(15, 17, 'CDF', 8, 123, 1),
(16, 2.5, 'CDF', 9, 123, 1),
(17, 2, 'CDF', 10, 123, 1),
(18, 2, 'CDF', 11, 123, 1),
(19, 2, 'CDF', 12, 123, 1),
(20, 15000, 'CDF', 13, 123, 1),
(21, 1, 'CDF', 14, 123, 1),
(22, 1.5, 'CDF', 15, 123, 1),
(23, 4, 'CDF', 16, 123, 1),
(24, 1, 'CDF', 17, 123, 1),
(25, 3, 'CDF', 18, 123, 1),
(26, 5, 'CDF', 19, 123, 1),
(27, 9, 'CDF', 20, 123, 1),
(28, 13, 'CDF', 21, 123, 1),
(29, 8, 'CDF', 22, 123, 1),
(30, 8, 'CDF', 23, 123, 1),
(31, 12, 'CDF', 24, 123, 1),
(32, 10, 'CDF', 25, 123, 1),
(33, 6, 'CDF', 26, 123, 1),
(34, 10, 'CDF', 27, 123, 1),
(35, 8, 'CDF', 28, 123, 1),
(36, 11, 'CDF', 29, 123, 1),
(37, 13, 'CDF', 30, 123, 1),
(38, 15000, 'CDF', 31, 123, 1),
(39, 8, 'CDF', 32, 123, 1),
(40, 10, 'CDF', 33, 123, 1),
(41, 3, 'CDF', 34, 123, 1),
(42, 3, 'CDF', 35, 123, 1),
(43, 4, 'CDF', 36, 123, 1),
(44, 3.5, 'CDF', 37, 123, 1),
(45, 2, 'CDF', 38, 123, 1),
(46, 3, 'CDF', 39, 123, 1),
(47, 5, 'CDF', 40, 123, 1),
(48, 5, 'CDF', 41, 123, 1),
(49, 5, 'CDF', 42, 123, 1),
(50, 3, 'CDF', 43, 123, 1),
(51, 5, 'CDF', 44, 123, 1),
(52, 5, 'CDF', 45, 123, 1),
(53, 4, 'CDF', 46, 123, 1),
(54, 6, 'CDF', 47, 123, 1),
(55, 6, 'CDF', 48, 123, 1),
(56, 4, 'CDF', 49, 123, 1),
(57, 5, 'CDF', 50, 123, 1),
(58, 6, 'CDF', 51, 123, 1),
(59, 23000, 'CDF', 52, 123, 1),
(60, 10000, 'CDF', 53, 123, 1),
(61, 2.5, 'CDF', 54, 123, 1),
(62, 7, 'CDF', 55, 123, 1),
(63, 7, 'CDF', 56, 123, 1),
(64, 7, 'CDF', 57, 123, 1),
(65, 7, 'CDF', 58, 123, 1),
(66, 7, 'CDF', 59, 123, 1),
(67, 7, 'CDF', 60, 123, 1),
(68, 10, 'CDF', 61, 123, 1),
(69, 10, 'CDF', 62, 123, 1),
(70, 5, 'CDF', 63, 123, 1),
(71, 20, 'CDF', 64, 123, 1),
(73, 2, 'CDF', 0, 123, 1),
(74, 2, 'CDF', 0, 123, 1),
(75, 2, 'CDF', 0, 123, 1),
(76, 2, 'CDF', 0, 123, 1),
(78, 1.5, 'CDF', 0, 123, 1),
(80, 2, 'CDF', 0, 123, 1),
(89, 4, 'CDF', 75, 123, 1),
(98, 18, 'CDF', 77, 123, 1),
(101, 25, 'CDF', 80, 123, 1),
(102, 25, 'CDF', 81, 123, 1),
(104, 2, 'CDF', 0, 123, 1),
(105, 2, 'CDF', 0, 123, 1),
(107, 3, 'CDF', 84, 123, 1),
(109, 2, 'CDF', 86, 123, 1),
(116, 2, 'CDF', 93, 123, 1),
(118, 2, 'CDF', 95, 123, 1),
(120, 2, 'CDF', 97, 123, 1),
(121, 2, 'CDF', 98, 123, 1),
(122, 1.5, 'CDF', 99, 123, 1),
(123, 4, 'CDF', 100, 123, 1),
(124, 4.5, 'CDF', 0, 123, 1),
(125, 4.5, 'CDF', 101, 123, 1),
(131, 30, 'CDF', 107, 123, 1),
(134, 5, 'CDF', 0, 123, 1),
(137, 10, 'CDF', 111, 123, 1),
(148, 300, 'CDF', 117, 123, 1),
(155, 4, 'CDF', 123, 123, 1),
(157, 5, 'CDF', 0, 123, 1),
(158, 5, 'CDF', 0, 123, 1),
(159, 5, 'CDF', 0, 123, 1),
(160, 5, 'CDF', 0, 123, 1),
(161, 5, 'CDF', 0, 123, 1),
(162, 5, 'CDF', 0, 123, 1),
(163, 5, 'CDF', 0, 123, 1),
(164, 5, 'CDF', 0, 123, 1),
(165, 5, 'CDF', 0, 123, 1),
(166, 5, 'CDF', 0, 123, 1),
(167, 5, 'CDF', 0, 123, 1),
(168, 5, 'CDF', 0, 123, 1),
(169, 5, 'CDF', 0, 123, 1),
(170, 5, 'CDF', 0, 123, 1),
(171, 5, 'CDF', 0, 123, 1),
(172, 30, 'CDF', 124, 123, 1),
(176, 12, 'CDF', 0, 123, 1),
(177, 12, 'CDF', 0, 123, 1),
(178, 12, 'CDF', 0, 123, 1),
(179, 12, 'CDF', 0, 123, 1),
(180, 12, 'CDF', 0, 123, 1),
(181, 12, 'CDF', 0, 123, 1),
(182, 12, 'CDF', 0, 123, 1),
(183, 12, 'CDF', 0, 123, 1),
(184, 12, 'CDF', 0, 123, 1),
(185, 12, 'CDF', 0, 123, 1),
(186, 12, 'CDF', 0, 123, 1),
(187, 12, 'CDF', 0, 123, 1),
(188, 12, 'CDF', 0, 123, 1),
(189, 12, 'CDF', 0, 123, 1),
(190, 12, 'CDF', 0, 123, 1),
(191, 12, 'CDF', 0, 123, 1),
(192, 12, 'CDF', 0, 123, 1),
(194, 4, 'CDF', 0, 123, 1),
(195, 4, 'CDF', 0, 123, 1),
(196, 4, 'CDF', 0, 123, 1),
(197, 4, 'CDF', 0, 123, 1),
(198, 4, 'CDF', 0, 123, 1),
(199, 4, 'CDF', 0, 123, 1),
(200, 4, 'CDF', 0, 123, 1),
(201, 4, 'CDF', 0, 123, 1),
(202, 4, 'CDF', 0, 123, 1),
(203, 4, 'CDF', 0, 123, 1),
(204, 4, 'CDF', 0, 123, 1),
(205, 4, 'CDF', 0, 123, 1),
(206, 4, 'CDF', 0, 123, 1),
(209, 12, 'CDF', 129, 123, 1),
(210, 4, 'CDF', 0, 123, 1),
(211, 4, 'CDF', 0, 123, 1),
(212, 4, 'CDF', 0, 123, 1),
(213, 4, 'CDF', 0, 123, 1),
(214, 4, 'CDF', 0, 123, 1),
(216, 4, 'CDF', 0, 123, 1),
(217, 4, 'CDF', 0, 123, 1),
(218, 4, 'CDF', 0, 123, 1),
(219, 4, 'CDF', 0, 123, 1),
(220, 4, 'CDF', 0, 123, 1),
(221, 4, 'CDF', 0, 123, 1),
(230, 4, 'CDF', 139, 123, 1),
(236, 18, 'CDF', 143, 123, 1),
(237, 4, 'CDF', 144, 123, 1),
(239, 20, 'CDF', 0, 123, 1),
(240, 20, 'CDF', 0, 123, 1),
(241, 20, 'CDF', 0, 123, 1),
(243, 2, 'CDF', 147, 123, 1),
(244, 2, 'CDF', 148, 123, 1),
(246, 5, 'CDF', 150, 123, 1),
(247, 2.5, 'CDF', 0, 123, 1),
(248, 2.5, 'CDF', 0, 123, 1),
(249, 2.5, 'CDF', 0, 123, 1),
(250, 2.5, 'CDF', 0, 123, 1),
(251, 2.5, 'CDF', 0, 123, 1),
(252, 2.5, 'CDF', 0, 123, 1),
(253, 2.5, 'CDF', 0, 123, 1),
(255, 5, 'CDF', 152, 123, 1),
(256, 5, 'CDF', 153, 123, 1),
(257, 5, 'CDF', 154, 123, 1),
(258, 5, 'CDF', 155, 123, 1),
(259, 5, 'CDF', 156, 123, 1),
(260, 5, 'CDF', 157, 123, 1),
(262, 200, 'CDF', 0, 123, 1),
(263, 200, 'CDF', 0, 123, 1),
(264, 200, 'CDF', 159, 123, 1),
(271, 1, 'CDF', 163, 123, 1),
(272, 1, 'CDF', 162, 123, 1),
(273, 0.5, 'CDF', 164, 123, 1),
(274, 1.5, 'CDF', 165, 123, 1),
(275, 1.5, 'CDF', 166, 123, 1),
(276, 1, 'CDF', 167, 123, 1),
(282, 1, 'CDF', 170, 123, 1),
(283, 5, 'CDF', 118, 123, 1),
(284, 4, 'CDF', 171, 123, 1),
(285, 4.5, 'CDF', 172, 123, 1),
(286, 2, 'CDF', 173, 123, 1),
(288, 4, 'CDF', 174, 123, 1),
(289, 0.5, 'CDF', 175, 123, 1),
(292, 5, 'CDF', 176, 123, 1),
(294, 0.5, 'CDF', 169, 123, 1),
(296, 2, 'CDF', 82, 123, 1),
(297, 2, 'CDF', 83, 123, 1),
(299, 0.5, 'CDF', 92, 123, 1),
(300, 1, 'CDF', 177, 123, 1),
(301, 1, 'CDF', 85, 123, 1),
(304, 2, 'CDF', 168, 123, 1),
(308, 4, 'CDF', 138, 123, 1),
(323, 1000, 'CDF', 0, 123, 1),
(324, 1000, 'CDF', 0, 123, 1),
(326, 1000, 'CDF', 0, 123, 1),
(327, 1000, 'CDF', 0, 123, 1),
(328, 1000, 'CDF', 0, 123, 1),
(329, 1000, 'CDF', 0, 123, 1),
(332, 2, 'CDF', 181, 123, 1),
(338, 1, 'CDF', 91, 123, 1),
(339, 1.5, 'CDF', 182, 123, 1),
(340, 40000, 'CDF', 183, 123, 1),
(341, 60000, 'CDF', 184, 123, 1),
(342, 100000, 'CDF', 185, 123, 1),
(343, 25, 'CDF', 186, 123, 1),
(346, 5, 'CDF', 0, 123, 1),
(347, 5, 'CDF', 188, 123, 1),
(348, 1, 'CDF', 158, 123, 1),
(349, 3, 'CDF', 161, 123, 1),
(350, 2, 'CDF', 160, 123, 1),
(354, 2, 'CDF', 191, 123, 1),
(355, 6, 'CDF', 192, 123, 1),
(356, 9, 'CDF', 193, 123, 1),
(357, 18, 'CDF', 194, 123, 1),
(358, 7.5, 'CDF', 195, 123, 1),
(359, 15, 'CDF', 196, 123, 1),
(360, 22, 'CDF', 197, 123, 1),
(361, 42, 'CDF', 198, 123, 1),
(362, 10, 'CDF', 199, 123, 1),
(363, 10, 'CDF', 200, 123, 1),
(364, 1, 'CDF', 201, 123, 1),
(365, 10, 'CDF', 202, 123, 1),
(366, 4, 'CDF', 203, 123, 1),
(371, 1, 'CDF', 0, 123, 1),
(372, 1, 'CDF', 0, 123, 1),
(374, 0.5, 'CDF', 206, 123, 1),
(375, 1, 'CDF', 0, 123, 1),
(376, 1, 'CDF', 0, 123, 1),
(377, 1, 'CDF', 0, 123, 1),
(378, 1, 'CDF', 0, 123, 1),
(379, 1, 'CDF', 0, 123, 1),
(380, 1, 'CDF', 0, 123, 1),
(381, 1, 'CDF', 0, 123, 1),
(382, 1, 'CDF', 207, 123, 1),
(383, 30, 'CDF', 208, 123, 1),
(385, 1, 'CDF', 0, 123, 1),
(386, 1, 'CDF', 0, 123, 1),
(388, 1, 'CDF', 0, 123, 1),
(390, 2, 'CDF', 212, 123, 1),
(393, 1, 'CDF', 213, 123, 1),
(398, 4, 'CDF', 121, 123, 1),
(401, 18, 'CDF', 78, 123, 1),
(403, 4, 'CDF', 122, 123, 1),
(404, 2, 'CDF', 217, 123, 1),
(405, 6, 'CDF', 220, 123, 1),
(406, 8, 'CDF', 221, 123, 1),
(407, 8, 'CDF', 222, 123, 1),
(408, 12, 'CDF', 223, 123, 1),
(409, 1, 'CDF', 224, 123, 1),
(410, 8, 'CDF', 225, 123, 1),
(411, 10, 'CDF', 226, 123, 1),
(412, 9, 'CDF', 227, 123, 1),
(413, 7, 'CDF', 228, 123, 1),
(414, 9, 'CDF', 229, 123, 1),
(415, 5, 'CDF', 230, 123, 1),
(416, 5, 'CDF', 231, 123, 1),
(417, 5, 'CDF', 234, 123, 1),
(418, 5, 'CDF', 235, 123, 1),
(419, 5, 'CDF', 236, 123, 1),
(420, 5, 'CDF', 237, 123, 1),
(432, 11, 'CDF', 216, 123, 1),
(436, 3, 'CDF', 239, 123, 1),
(437, 5, 'CDF', 104, 123, 1),
(440, 5, 'CDF', 102, 123, 1),
(442, 5, 'CDF', 116, 123, 1),
(447, 4, 'CDF', 133, 123, 1),
(449, 4, 'CDF', 126, 123, 1),
(450, 4, 'CDF', 120, 123, 1),
(452, 4, 'CDF', 135, 123, 1),
(453, 4, 'CDF', 128, 123, 1),
(454, 5, 'CDF', 108, 123, 1),
(455, 5, 'CDF', 106, 123, 1),
(465, 300, 'CDF', 115, 123, 1),
(467, 30, 'CDF', 103, 123, 1),
(468, 30, 'CDF', 113, 123, 1),
(469, 30, 'CDF', 112, 123, 1),
(471, 5, 'CDF', 114, 123, 1),
(478, 4, 'CDF', 137, 123, 1),
(483, 14, 'CDF', 136, 123, 1),
(484, 14, 'CDF', 125, 123, 1),
(485, 14, 'CDF', 119, 123, 1),
(486, 14, 'CDF', 134, 123, 1),
(490, 4, 'CDF', 131, 123, 1),
(491, 4, 'CDF', 0, 123, 1),
(492, 4, 'CDF', 0, 123, 1),
(493, 4, 'CDF', 0, 123, 1),
(494, 4, 'CDF', 0, 123, 1),
(495, 4, 'CDF', 0, 123, 1),
(496, 4, 'CDF', 0, 123, 1),
(497, 4, 'CDF', 0, 123, 1),
(498, 4, 'CDF', 0, 123, 1),
(499, 4, 'CDF', 0, 123, 1),
(500, 4, 'CDF', 0, 123, 1),
(501, 4, 'CDF', 0, 123, 1),
(502, 4, 'CDF', 0, 123, 1),
(503, 4, 'CDF', 0, 123, 1),
(504, 4, 'CDF', 0, 123, 1),
(505, 4, 'CDF', 0, 123, 1),
(506, 4, 'CDF', 0, 123, 1),
(507, 4, 'CDF', 0, 123, 1),
(508, 4, 'CDF', 0, 123, 1),
(509, 4, 'CDF', 0, 123, 1),
(510, 4, 'CDF', 0, 123, 1),
(511, 4, 'CDF', 0, 123, 1),
(512, 4, 'CDF', 0, 123, 1),
(513, 4, 'CDF', 0, 123, 1),
(514, 4, 'CDF', 0, 123, 1),
(515, 4, 'CDF', 0, 123, 1),
(516, 4, 'CDF', 0, 123, 1),
(517, 4, 'CDF', 0, 123, 1),
(518, 4, 'CDF', 0, 123, 1),
(519, 4, 'CDF', 0, 123, 1),
(520, 4, 'CDF', 0, 123, 1),
(521, 4, 'CDF', 0, 123, 1),
(522, 4, 'CDF', 0, 123, 1),
(523, 4, 'CDF', 0, 123, 1),
(524, 4, 'CDF', 0, 123, 1),
(525, 4, 'CDF', 0, 123, 1),
(526, 4, 'CDF', 0, 123, 1),
(527, 4, 'CDF', 0, 123, 1),
(528, 4, 'CDF', 0, 123, 1),
(529, 4, 'CDF', 0, 123, 1),
(530, 4, 'CDF', 0, 123, 1),
(531, 4, 'CDF', 0, 123, 1),
(532, 4, 'CDF', 0, 123, 1),
(533, 4, 'CDF', 0, 123, 1),
(537, 4, 'CDF', 243, 123, 1),
(538, 4, 'CDF', 244, 123, 1),
(556, 5, 'CDF', 252, 123, 1),
(559, 5, 'CDF', 257, 123, 1),
(560, 4, 'CDF', 258, 123, 1),
(565, 1, 'CDF', 260, 123, 1),
(567, 2, 'CDF', 141, 123, 1),
(571, 0.5, 'CDF', 261, 123, 1),
(573, 0.5, 'CDF', 262, 123, 1),
(574, 0.5, 'CDF', 190, 123, 1),
(575, 0.25, 'CDF', 263, 123, 1),
(576, 4, 'CDF', 73, 123, 1),
(578, 22, 'CDF', 264, 123, 1),
(580, 4, 'CDF', 74, 123, 1),
(585, 15, 'CDF', 267, 123, 1),
(586, 2.5, 'CDF', 151, 123, 1),
(587, 20, 'CDF', 268, 123, 1),
(588, 10, 'CDF', 269, 123, 1),
(589, 15, 'CDF', 270, 123, 1),
(590, 15, 'CDF', 271, 123, 1),
(591, 7, 'CDF', 272, 123, 1),
(592, 9, 'CDF', 273, 123, 1),
(593, 27000, 'CDF', 274, 123, 1),
(594, 13.5, 'CDF', 277, 123, 1),
(595, 4, 'CDF', 278, 123, 1),
(596, 10, 'CDF', 187, 123, 1),
(597, 1, 'CDF', 279, 123, 1),
(598, 1, 'CDF', 280, 123, 1),
(599, 10, 'CDF', 281, 123, 1),
(600, 10, 'CDF', 282, 123, 1),
(601, 3, 'CDF', 283, 123, 1),
(602, 3.5, 'CDF', 285, 123, 1),
(603, 10, 'CDF', 286, 123, 1),
(604, 8, 'CDF', 0, 123, 1),
(605, 8, 'CDF', 0, 123, 1),
(607, 8, 'CDF', 0, 123, 1),
(608, 8, 'CDF', 0, 123, 1),
(609, 8, 'CDF', 0, 123, 1),
(610, 8, 'CDF', 0, 123, 1),
(611, 8, 'CDF', 0, 123, 1),
(612, 8, 'CDF', 0, 123, 1),
(613, 8, 'CDF', 0, 123, 1),
(614, 8, 'CDF', 0, 123, 1),
(615, 8, 'CDF', 0, 123, 1),
(616, 6, 'CDF', 288, 123, 1),
(617, 6, 'CDF', 0, 123, 1),
(618, 6, 'CDF', 0, 123, 1),
(619, 6, 'CDF', 0, 123, 1),
(620, 6, 'CDF', 0, 123, 1),
(621, 6, 'CDF', 0, 123, 1),
(622, 6, 'CDF', 0, 123, 1),
(623, 6, 'CDF', 0, 123, 1),
(624, 6, 'CDF', 0, 123, 1),
(627, 6, 'CDF', 291, 123, 1),
(628, 13, 'CDF', 292, 123, 1),
(629, 9, 'CDF', 293, 123, 1),
(630, 6, 'CDF', 294, 123, 1),
(637, 10, 'CDF', 295, 123, 1),
(638, 10, 'CDF', 296, 123, 1),
(639, 11, 'CDF', 297, 123, 1),
(640, 13, 'CDF', 298, 123, 1),
(641, 10, 'CDF', 299, 123, 1),
(642, 3.5, 'CDF', 300, 123, 1),
(643, 6, 'CDF', 301, 123, 1),
(644, 2, 'CDF', 251, 123, 1),
(645, 1, 'CDF', 250, 123, 1),
(646, 2, 'CDF', 90, 123, 1),
(647, 1, 'CDF', 89, 123, 1),
(651, 7, 'CDF', 0, 123, 1),
(652, 7, 'CDF', 0, 123, 1),
(653, 7, 'CDF', 0, 123, 1),
(654, 7, 'CDF', 0, 123, 1),
(655, 7, 'CDF', 0, 123, 1),
(656, 7, 'CDF', 0, 123, 1),
(657, 7, 'CDF', 0, 123, 1),
(658, 7, 'CDF', 0, 123, 1),
(659, 7, 'CDF', 0, 123, 1),
(660, 7, 'CDF', 0, 123, 1),
(661, 7, 'CDF', 0, 123, 1),
(662, 7, 'CDF', 0, 123, 1),
(663, 7, 'CDF', 0, 123, 1),
(664, 7, 'CDF', 0, 123, 1),
(665, 7, 'CDF', 0, 123, 1),
(666, 7, 'CDF', 0, 123, 1),
(667, 7, 'CDF', 0, 123, 1),
(668, 7, 'CDF', 0, 123, 1),
(669, 7, 'CDF', 0, 123, 1),
(673, 7, 'CDF', 0, 123, 1),
(674, 7, 'CDF', 0, 123, 1),
(675, 7, 'CDF', 0, 123, 1),
(677, 7, 'CDF', 0, 123, 1),
(679, 39, 'CDF', 0, 123, 1),
(681, 5, 'CDF', 308, 123, 1),
(682, 5, 'CDF', 287, 123, 1),
(683, 1.5, 'CDF', 309, 123, 1),
(684, 2, 'CDF', 1, 123, 1),
(690, 2.5, 'CDF', 72, 123, 1),
(695, 2.5, 'CDF', 0, 123, 1),
(696, 2.5, 'CDF', 0, 123, 1),
(697, 4.5, 'CDF', 241, 123, 1),
(698, 4.5, 'CDF', 242, 123, 1),
(699, 4.5, 'CDF', 245, 123, 1),
(700, 4.5, 'CDF', 246, 123, 1),
(701, 4.5, 'CDF', 247, 123, 1),
(702, 4.5, 'CDF', 248, 123, 1),
(704, 25, 'CDF', 0, 123, 1),
(705, 25, 'CDF', 0, 123, 1),
(706, 25, 'CDF', 311, 123, 1),
(707, 24, 'CDF', 312, 123, 1),
(708, 20, 'CDF', 313, 123, 1),
(709, 22, 'CDF', 314, 123, 1),
(710, 30, 'CDF', 145, 123, 1),
(711, 30, 'CDF', 146, 123, 1),
(712, 30, 'CDF', 315, 123, 1),
(713, 30, 'CDF', 316, 123, 1),
(714, 4, 'CDF', 110, 123, 1),
(716, 35, 'CDF', 105, 123, 1),
(717, 35, 'CDF', 109, 123, 1),
(723, 7, 'CDF', 0, 123, 1),
(724, 7, 'CDF', 0, 123, 1),
(725, 7, 'CDF', 321, 123, 1),
(728, 24, 'CDF', 322, 123, 1),
(729, 25, 'CDF', 323, 123, 1),
(730, 1.5, 'CDF', 324, 123, 1),
(732, 15, 'CDF', 326, 123, 1),
(733, 15, 'CDF', 327, 123, 1),
(737, 2.5, 'CDF', 325, 123, 1),
(739, 7, 'CDF', 329, 123, 1),
(741, 6, 'CDF', 240, 123, 1),
(742, 6, 'CDF', 214, 123, 1),
(744, 5, 'CDF', 330, 123, 1),
(745, 15, 'CDF', 331, 123, 1),
(746, 20, 'CDF', 238, 123, 1),
(748, 0.75, 'CDF', 333, 123, 1),
(749, 6, 'CDF', 328, 123, 1),
(750, 24, 'CDF', 334, 123, 1),
(751, 15, 'CDF', 127, 123, 1),
(752, 15, 'CDF', 132, 123, 1),
(753, 15, 'CDF', 130, 123, 1),
(754, 4.5, 'CDF', 336, 123, 1),
(755, 2.5, 'CDF', 337, 123, 1),
(756, 4, 'CDF', 338, 123, 1),
(757, 1.5, 'CDF', 339, 123, 1),
(758, 4.5, 'CDF', 335, 123, 1),
(759, 4.5, 'CDF', 340, 123, 1),
(760, 4, 'CDF', 341, 123, 1),
(761, 5, 'CDF', 342, 123, 1),
(763, 6, 'CDF', 343, 123, 1),
(764, 9, 'CDF', 344, 123, 1),
(765, 13, 'CDF', 345, 123, 1),
(766, 5, 'CDF', 346, 123, 1),
(771, 4, 'CDF', 347, 123, 1),
(772, 2.5, 'CDF', 348, 123, 1),
(773, 2.5, 'CDF', 352, 123, 1),
(774, 12, 'CDF', 353, 123, 1),
(777, 1.5, 'CDF', 355, 123, 1),
(778, 7, 'CDF', 304, 123, 1),
(779, 8, 'CDF', 318, 123, 1),
(780, 5, 'CDF', 319, 123, 1),
(781, 5, 'CDF', 320, 123, 1),
(782, 7, 'CDF', 305, 123, 1),
(783, 7, 'CDF', 289, 123, 1),
(784, 7, 'CDF', 302, 123, 1),
(786, 7, 'CDF', 306, 123, 1),
(787, 7, 'CDF', 303, 123, 1),
(788, 7, 'CDF', 290, 123, 1),
(789, 1000, 'CDF', 249, 123, 1),
(790, 1000, 'CDF', 178, 123, 1),
(791, 1000, 'CDF', 180, 123, 1),
(792, 100, 'CDF', 189, 123, 1),
(793, 1000, 'CDF', 179, 123, 1),
(797, 4.5, 'CDF', 265, 123, 1),
(798, 4.5, 'CDF', 266, 123, 1),
(800, 38, 'CDF', 307, 123, 1),
(802, 8, 'CDF', 357, 123, 1),
(803, 14, 'CDF', 358, 123, 1),
(804, 16, 'CDF', 359, 123, 1),
(805, 11, 'CDF', 360, 123, 1),
(806, 11, 'CDF', 361, 123, 1),
(807, 12, 'CDF', 362, 123, 1),
(808, 17, 'CDF', 363, 123, 1),
(809, 12, 'CDF', 364, 123, 1),
(810, 13, 'CDF', 365, 123, 1),
(811, 15, 'CDF', 366, 123, 1),
(812, 15, 'CDF', 367, 123, 1),
(813, 12, 'CDF', 368, 123, 1),
(815, 4, 'CDF', 0, 123, 1),
(816, 4, 'CDF', 0, 123, 1),
(818, 4, 'CDF', 370, 123, 1),
(819, 6, 'CDF', 369, 123, 1),
(820, 12, 'CDF', 371, 123, 1),
(821, 11, 'CDF', 372, 123, 1),
(822, 5, 'CDF', 373, 123, 1),
(823, 7, 'CDF', 374, 123, 1),
(824, 20, 'CDF', 375, 123, 1),
(825, 20, 'CDF', 376, 123, 1),
(826, 20, 'CDF', 377, 123, 1),
(827, 4, 'CDF', 378, 123, 1),
(828, 0.25, 'CDF', 379, 123, 1),
(829, 25, 'CDF', 380, 123, 1),
(830, 20, 'CDF', 381, 123, 1),
(831, 7, 'CDF', 356, 123, 1),
(832, 4, 'CDF', 382, 123, 1),
(833, 2, 'CDF', 94, 123, 1),
(835, 1, 'CDF', 211, 123, 1),
(836, 1, 'CDF', 209, 123, 1),
(837, 1, 'CDF', 210, 123, 1),
(838, 1, 'CDF', 204, 123, 1),
(839, 1, 'CDF', 205, 123, 1),
(840, 10, 'CDF', 383, 123, 1),
(841, 11, 'CDF', 384, 123, 1),
(842, 10, 'CDF', 385, 123, 1),
(843, 2, 'CDF', 386, 123, 1),
(844, 2, 'CDF', 2, 123, 1),
(846, 3, 'CDF', 68, 123, 1),
(847, 3, 'CDF', 69, 123, 1),
(848, 2, 'CDF', 70, 123, 1),
(849, 3, 'CDF', 71, 123, 1),
(850, 3.5, 'CDF', 65, 123, 1),
(851, 2.5, 'CDF', 66, 123, 1),
(852, 5, 'CDF', 387, 123, 1),
(853, 70000, 'CDF', 388, 123, 1),
(854, 27500, 'CDF', 389, 123, 1),
(855, 60000, 'CDF', 390, 123, 1),
(856, 56000, 'CDF', 391, 123, 1),
(857, 3, 'CDF', 392, 123, 1),
(858, 4, 'CDF', 393, 123, 1),
(859, 8, 'CDF', 395, 123, 1),
(860, 45000, 'CDF', 396, 123, 1),
(861, 55000, 'CDF', 397, 123, 1),
(862, 36000, 'CDF', 398, 123, 1),
(864, 10, 'CDF', 400, 123, 1),
(865, 6, 'CDF', 401, 123, 1),
(866, 12, 'CDF', 402, 123, 1),
(867, 19000, 'CDF', 403, 123, 1),
(868, 3, 'CDF', 88, 123, 1),
(870, 1.5, 'CDF', 87, 123, 1),
(871, 4, 'CDF', 0, 123, 1),
(872, 4, 'CDF', 0, 123, 1),
(873, 4, 'CDF', 404, 123, 1),
(874, 2, 'CDF', 0, 123, 1),
(875, 2, 'CDF', 0, 123, 1),
(876, 2, 'CDF', 0, 123, 1),
(877, 2, 'CDF', 0, 123, 1),
(878, 2, 'CDF', 405, 123, 1),
(879, 1, 'CDF', 406, 123, 1),
(880, 7, 'CDF', 407, 123, 1),
(881, 7.5, 'CDF', 409, 123, 1),
(882, 1, 'CDF', 410, 123, 1),
(883, 2, 'CDF', 411, 123, 1),
(884, 2, 'CDF', 0, 123, 1),
(885, 2, 'CDF', 412, 123, 1),
(886, 2, 'CDF', 413, 123, 1),
(887, 2, 'CDF', 67, 123, 1),
(888, 12, 'CDF', 414, 123, 1),
(889, 6, 'CDF', 415, 123, 1),
(890, 6, 'CDF', 416, 123, 1),
(891, 12, 'CDF', 417, 123, 1),
(892, 5, 'CDF', 419, 123, 1),
(893, 20, 'CDF', 310, 123, 1),
(894, 24, 'CDF', 76, 123, 1),
(895, 22, 'CDF', 79, 123, 1),
(896, 14, 'CDF', 420, 123, 1),
(897, 6, 'CDF', 215, 123, 1),
(898, 6, 'CDF', 317, 123, 1),
(899, 5, 'CDF', 421, 123, 1),
(901, 22, 'CDF', 422, 123, 1),
(902, 3, 'CDF', 433, 123, 0),
(903, 3, 'CDF', 0, 123, 0),
(904, 3, 'CDF', 0, 123, 0),
(905, 3, 'CDF', 434, 123, 0),
(906, 3, 'CDF', 0, 123, 0),
(907, 3, 'CDF', 0, 123, 0),
(908, 3, 'CDF', 0, 123, 0),
(909, 3, 'CDF', 0, 123, 0),
(910, 3, 'CDF', 0, 123, 0),
(911, 3, 'CDF', 0, 123, 0),
(913, 3, 'CDF', 0, 123, 0),
(914, 3, 'CDF', 0, 123, 0),
(915, 3, 'CDF', 0, 123, 0),
(916, 3, 'CDF', 0, 123, 0),
(917, 3, 'CDF', 0, 123, 0),
(918, 3, 'CDF', 0, 123, 0),
(921, 2.5, 'CDF', 149, 123, 0),
(942, 3, 'CDF', 142, 123, 0),
(943, 24, 'CDF', 439, 123, 0),
(953, 2, 'CDF', 96, 123, 0),
(955, 4, 'CDF', 440, 123, 0),
(956, 2.5, 'CDF', 431, 123, 0),
(957, 15, 'CDF', 441, 123, 0),
(958, 15, 'CDF', 442, 123, 0),
(959, 25000, 'CDF', 443, 123, 0),
(960, 70000, 'CDF', 444, 123, 0),
(961, 5, 'CDF', 445, 123, 0),
(962, 10000, 'CDF', 446, 123, 0),
(963, 20000, 'CDF', 447, 123, 0),
(966, 1, 'CDF', 140, 123, 0),
(969, 2, 'CDF', 428, 123, 0),
(970, 8, 'CDF', 448, 123, 0),
(974, 24, 'CDF', 449, 123, 0),
(975, 5, 'CDF', 450, 123, 0),
(976, 5, 'CDF', 0, 123, 0),
(977, 5, 'CDF', 0, 123, 0),
(979, 5, 'CDF', 451, 123, 0),
(981, 10, 'CDF', 332, 123, 0),
(982, 5, 'CDF', 452, 123, 0),
(983, 6, 'CDF', 0, 123, 0),
(984, 6, 'CDF', 354, 123, 0),
(986, 4, 'CDF', 0, 123, 0),
(987, 4, 'CDF', 0, 123, 0),
(988, 4, 'CDF', 0, 123, 0),
(989, 4, 'CDF', 0, 123, 0),
(996, 85, 'CDF', 456, 123, 0),
(997, 2.5, 'CDF', 454, 123, 0),
(998, 2.5, 'CDF', 436, 123, 0),
(999, 2.5, 'CDF', 455, 123, 0),
(1000, 2.5, 'CDF', 453, 123, 0),
(1001, 2.5, 'CDF', 435, 123, 0),
(1002, 7, 'CDF', 457, 123, 0),
(1003, 18, 'CDF', 399, 123, 0),
(1004, 7, 'CDF', 437, 123, 0),
(1005, 5000, 'CDF', 438, 123, 0),
(1006, 10000, 'CDF', 458, 123, 0),
(1007, 50000, 'CDF', 459, 123, 0),
(1008, 15000, 'CDF', 460, 123, 0),
(1009, 29500, 'CDF', 461, 123, 0),
(1010, 20500, 'CDF', 462, 123, 0),
(1011, 18000, 'CDF', 463, 123, 0),
(1012, 26000, 'CDF', 464, 123, 0),
(1013, 29500, 'CDF', 465, 123, 0),
(1014, 70000, 'CDF', 466, 123, 0),
(1015, 57500, 'CDF', 467, 123, 0),
(1016, 30000, 'CDF', 468, 123, 0),
(1017, 70000, 'CDF', 469, 123, 0),
(1018, 4500, 'CDF', 470, 123, 0),
(1019, 25000, 'CDF', 471, 123, 0),
(1020, 60000, 'CDF', 472, 123, 0),
(1021, 55000, 'CDF', 473, 123, 0),
(1022, 29500, 'CDF', 474, 123, 0),
(1023, 80000, 'CDF', 475, 123, 0),
(1024, 45000, 'CDF', 476, 123, 0),
(1025, 25000, 'CDF', 477, 123, 0),
(1026, 70000, 'CDF', 478, 123, 0),
(1027, 48500, 'CDF', 479, 123, 0),
(1028, 25000, 'CDF', 480, 123, 0),
(1029, 60000, 'CDF', 481, 123, 0),
(1030, 48000, 'CDF', 482, 123, 0),
(1031, 25000, 'CDF', 483, 123, 0),
(1032, 65000, 'CDF', 484, 123, 0),
(1033, 55000, 'CDF', 485, 123, 0),
(1034, 28500, 'CDF', 486, 123, 0),
(1035, 80000, 'CDF', 487, 123, 0),
(1036, 45000, 'CDF', 488, 123, 0),
(1037, 25000, 'CDF', 489, 123, 0),
(1038, 65000, 'CDF', 490, 123, 0),
(1039, 45000, 'CDF', 491, 123, 0),
(1040, 25000, 'CDF', 492, 123, 0),
(1041, 70000, 'CDF', 493, 123, 0),
(1042, 45000, 'CDF', 494, 123, 0),
(1043, 25000, 'CDF', 495, 123, 0),
(1044, 70000, 'CDF', 496, 123, 0),
(1045, 48500, 'CDF', 497, 123, 0),
(1046, 26500, 'CDF', 498, 123, 0),
(1047, 75000, 'CDF', 499, 123, 0),
(1048, 53000, 'CDF', 500, 123, 0),
(1049, 27500, 'CDF', 501, 123, 0),
(1050, 70000, 'CDF', 502, 123, 0),
(1051, 57500, 'CDF', 503, 123, 0),
(1052, 30500, 'CDF', 504, 123, 0),
(1053, 80000, 'CDF', 505, 123, 0),
(1054, 50000, 'CDF', 506, 123, 0),
(1055, 25000, 'CDF', 507, 123, 0),
(1056, 50000, 'CDF', 508, 123, 0),
(1057, 40000, 'CDF', 509, 123, 0),
(1058, 40000, 'CDF', 510, 123, 0),
(1059, 33000, 'CDF', 511, 123, 0),
(1060, 30000, 'CDF', 512, 123, 0),
(1061, 25000, 'CDF', 513, 123, 0),
(1062, 30000, 'CDF', 514, 123, 0),
(1063, 25000, 'CDF', 515, 123, 0),
(1069, 30000, 'CDF', 521, 123, 0),
(1070, 30000, 'CDF', 522, 123, 0),
(1071, 36500, 'CDF', 523, 123, 0),
(1072, 36500, 'CDF', 524, 123, 0),
(1073, 28000, 'CDF', 525, 123, 0),
(1074, 33000, 'CDF', 526, 123, 0),
(1075, 36500, 'CDF', 527, 123, 0),
(1076, 15000, 'CDF', 528, 123, 0),
(1077, 50000, 'CDF', 529, 123, 0),
(1078, 25000, 'CDF', 530, 123, 0),
(1079, 30000, 'CDF', 531, 123, 0),
(1080, 28000, 'CDF', 532, 123, 0),
(1081, 25000, 'CDF', 533, 123, 0),
(1082, 25000, 'CDF', 534, 123, 0),
(1083, 5000, 'CDF', 535, 123, 0),
(1084, 5000, 'CDF', 536, 123, 0),
(1085, 5000, 'CDF', 537, 123, 0),
(1086, 5000, 'CDF', 538, 123, 0),
(1087, 4000, 'CDF', 539, 123, 0),
(1088, 6000, 'CDF', 540, 123, 0),
(1089, 5000, 'CDF', 541, 123, 0),
(1090, 5000, 'CDF', 542, 123, 0),
(1091, 18500, 'CDF', 543, 123, 0),
(1092, 18500, 'CDF', 544, 123, 0),
(1093, 18500, 'CDF', 545, 123, 0),
(1094, 18500, 'CDF', 546, 123, 0),
(1095, 20500, 'CDF', 547, 123, 0),
(1096, 22000, 'CDF', 548, 123, 0),
(1097, 23000, 'CDF', 549, 123, 0),
(1098, 20500, 'CDF', 550, 123, 0),
(1099, 20500, 'CDF', 551, 123, 0),
(1100, 17000, 'CDF', 552, 123, 0),
(1101, 20500, 'CDF', 553, 123, 0),
(1102, 23000, 'CDF', 554, 123, 0),
(1103, 23000, 'CDF', 555, 123, 0),
(1104, 8000, 'CDF', 556, 123, 0),
(1105, 18500, 'CDF', 557, 123, 0),
(1106, 23500, 'CDF', 558, 123, 0),
(1107, 33500, 'CDF', 559, 123, 0),
(1108, 23500, 'CDF', 560, 123, 0),
(1109, 13500, 'CDF', 561, 123, 0),
(1110, 18500, 'CDF', 562, 123, 0),
(1111, 23500, 'CDF', 563, 123, 0),
(1112, 22000, 'CDF', 564, 123, 0),
(1113, 25000, 'CDF', 565, 123, 0),
(1114, 33500, 'CDF', 566, 123, 0),
(1115, 21000, 'CDF', 567, 123, 0),
(1116, 21000, 'CDF', 568, 123, 0),
(1117, 33500, 'CDF', 569, 123, 0),
(1118, 31000, 'CDF', 570, 123, 0),
(1119, 31000, 'CDF', 571, 123, 0),
(1120, 354000, 'CDF', 572, 123, 0),
(1121, 354000, 'CDF', 573, 123, 0),
(1122, 328000, 'CDF', 574, 123, 0),
(1123, 360000, 'CDF', 575, 123, 0),
(1124, 660000, 'CDF', 576, 123, 0),
(1125, 400000, 'CDF', 577, 123, 0),
(1126, 533000, 'CDF', 578, 123, 0),
(1127, 585000, 'CDF', 579, 123, 0),
(1128, 533000, 'CDF', 580, 123, 0),
(1129, 360000, 'CDF', 581, 123, 0),
(1130, 400000, 'CDF', 582, 123, 0),
(1131, 300000, 'CDF', 583, 123, 0),
(1132, 410000, 'CDF', 584, 123, 0),
(1133, 1875000, 'CDF', 585, 123, 0),
(1134, 400000, 'CDF', 586, 123, 0),
(1135, 1384000, 'CDF', 587, 123, 0),
(1136, 300000, 'CDF', 588, 123, 0),
(1137, 957000, 'CDF', 589, 123, 0),
(1138, 234000, 'CDF', 590, 123, 0),
(1139, 1240000, 'CDF', 591, 123, 0),
(1140, 300000, 'CDF', 592, 123, 0),
(1141, 1063000, 'CDF', 593, 123, 0),
(1142, 220000, 'CDF', 594, 123, 0),
(1143, 365000, 'CDF', 595, 123, 0),
(1144, 85000, 'CDF', 596, 123, 0),
(1145, 98000, 'CDF', 597, 123, 0),
(1146, 70000, 'CDF', 598, 123, 0),
(1147, 70000, 'CDF', 599, 123, 0),
(1148, 120000, 'CDF', 600, 123, 0),
(1149, 75000, 'CDF', 601, 123, 0),
(1150, 72000, 'CDF', 602, 123, 0),
(1151, 75000, 'CDF', 603, 123, 0),
(1152, 80000, 'CDF', 604, 123, 0),
(1153, 80000, 'CDF', 605, 123, 0),
(1154, 80000, 'CDF', 606, 123, 0),
(1155, 80000, 'CDF', 607, 123, 0),
(1156, 46000, 'CDF', 608, 123, 0),
(1157, 320000, 'CDF', 609, 123, 0),
(1158, 120000, 'CDF', 610, 123, 0),
(1159, 96000, 'CDF', 611, 123, 0),
(1160, 75000, 'CDF', 612, 123, 0),
(1161, 66000, 'CDF', 613, 123, 0),
(1162, 65000, 'CDF', 614, 123, 0),
(1163, 70000, 'CDF', 615, 123, 0),
(1164, 120000, 'CDF', 616, 123, 0),
(1165, 70000, 'CDF', 617, 123, 0),
(1166, 70000, 'CDF', 618, 123, 0),
(1167, 40000, 'CDF', 619, 123, 0),
(1168, 50000, 'CDF', 620, 123, 0),
(1169, 40000, 'CDF', 621, 123, 0),
(1170, 1100000, 'CDF', 622, 123, 0),
(1171, 250000, 'CDF', 623, 123, 0),
(1172, 210000, 'CDF', 624, 123, 0),
(1173, 120000, 'CDF', 625, 123, 0),
(1174, 55000, 'CDF', 626, 123, 0),
(1175, 720000, 'CDF', 627, 123, 0),
(1176, 335000, 'CDF', 628, 123, 0),
(1177, 232000, 'CDF', 629, 123, 0),
(1178, 150000, 'CDF', 630, 123, 0),
(1179, 360000, 'CDF', 631, 123, 0),
(1180, 232000, 'CDF', 632, 123, 0),
(1181, 150000, 'CDF', 633, 123, 0),
(1182, 140000, 'CDF', 634, 123, 0),
(1183, 140000, 'CDF', 635, 123, 0),
(1184, 55000, 'CDF', 636, 123, 0),
(1185, 65000, 'CDF', 637, 123, 0),
(1186, 150000, 'CDF', 638, 123, 0),
(1187, 170000, 'CDF', 639, 123, 0),
(1188, 100000, 'CDF', 640, 123, 0),
(1189, 55000, 'CDF', 641, 123, 0),
(1190, 65000, 'CDF', 642, 123, 0),
(1191, 134000, 'CDF', 643, 123, 0),
(1192, 312000, 'CDF', 644, 123, 0),
(1193, 80000, 'CDF', 645, 123, 0),
(1194, 80000, 'CDF', 646, 123, 0),
(1195, 80000, 'CDF', 647, 123, 0),
(1196, 70000, 'CDF', 648, 123, 0),
(1197, 70000, 'CDF', 649, 123, 0),
(1198, 110000, 'CDF', 650, 123, 0),
(1199, 100000, 'CDF', 651, 123, 0),
(1200, 234000, 'CDF', 652, 123, 0),
(1201, 71000, 'CDF', 653, 123, 0),
(1202, 70000, 'CDF', 654, 123, 0),
(1203, 70000, 'CDF', 655, 123, 0),
(1204, 70000, 'CDF', 656, 123, 0),
(1205, 138000, 'CDF', 657, 123, 0),
(1206, 75000, 'CDF', 658, 123, 0),
(1207, 65000, 'CDF', 659, 123, 0),
(1208, 170000, 'CDF', 660, 123, 0),
(1209, 160000, 'CDF', 661, 123, 0),
(1210, 80000, 'CDF', 662, 123, 0),
(1211, 80000, 'CDF', 663, 123, 0),
(1212, 80000, 'CDF', 664, 123, 0),
(1213, 23000, 'CDF', 665, 123, 0),
(1214, 23000, 'CDF', 666, 123, 0),
(1215, 23000, 'CDF', 667, 123, 0),
(1216, 23000, 'CDF', 668, 123, 0),
(1217, 23000, 'CDF', 669, 123, 0),
(1218, 23000, 'CDF', 670, 123, 0),
(1219, 23000, 'CDF', 671, 123, 0),
(1220, 34500, 'CDF', 672, 123, 0),
(1221, 34500, 'CDF', 673, 123, 0),
(1222, 44000, 'CDF', 674, 123, 0),
(1223, 34500, 'CDF', 675, 123, 0),
(1224, 34500, 'CDF', 676, 123, 0),
(1225, 34500, 'CDF', 677, 123, 0),
(1226, 34500, 'CDF', 678, 123, 0),
(1227, 34500, 'CDF', 679, 123, 0),
(1228, 34500, 'CDF', 680, 123, 0),
(1229, 34500, 'CDF', 681, 123, 0),
(1230, 34500, 'CDF', 682, 123, 0),
(1231, 34500, 'CDF', 683, 123, 0),
(1232, 34500, 'CDF', 684, 123, 0),
(1233, 19500, 'CDF', 685, 123, 0),
(1234, 19500, 'CDF', 686, 123, 0),
(1235, 19500, 'CDF', 687, 123, 0),
(1237, 19500, 'CDF', 689, 123, 0),
(1238, 19500, 'CDF', 690, 123, 0),
(1239, 19500, 'CDF', 691, 123, 0),
(1240, 19500, 'CDF', 692, 123, 0),
(1241, 19500, 'CDF', 693, 123, 0),
(1242, 19500, 'CDF', 694, 123, 0),
(1243, 17000, 'CDF', 695, 123, 0),
(1244, 17000, 'CDF', 696, 123, 0),
(1245, 17000, 'CDF', 697, 123, 0),
(1246, 17000, 'CDF', 698, 123, 0),
(1247, 9000, 'CDF', 699, 123, 0),
(1248, 12000, 'CDF', 700, 123, 0),
(1249, 9500, 'CDF', 701, 123, 0),
(1250, 12500, 'CDF', 702, 123, 0),
(1251, 9500, 'CDF', 703, 123, 0),
(1252, 17000, 'CDF', 704, 123, 0),
(1253, 13500, 'CDF', 705, 123, 0),
(1254, 13500, 'CDF', 706, 123, 0),
(1255, 12500, 'CDF', 707, 123, 0),
(1256, 7000, 'CDF', 708, 123, 0),
(1257, 7000, 'CDF', 709, 123, 0),
(1258, 15000, 'CDF', 710, 123, 0),
(1259, 17000, 'CDF', 711, 123, 0),
(1260, 15000, 'CDF', 712, 123, 0),
(1261, 15000, 'CDF', 713, 123, 0),
(1262, 17000, 'CDF', 714, 123, 0),
(1263, 17000, 'CDF', 715, 123, 0),
(1264, 15000, 'CDF', 716, 123, 0),
(1265, 15000, 'CDF', 717, 123, 0),
(1266, 13500, 'CDF', 718, 123, 0),
(1267, 13500, 'CDF', 719, 123, 0),
(1268, 13500, 'CDF', 720, 123, 0),
(1269, 17000, 'CDF', 721, 123, 0),
(1270, 17000, 'CDF', 722, 123, 0),
(1271, 17000, 'CDF', 723, 123, 0),
(1272, 20500, 'CDF', 724, 123, 0),
(1273, 20500, 'CDF', 725, 123, 0),
(1274, 20500, 'CDF', 726, 123, 0),
(1275, 20500, 'CDF', 727, 123, 0),
(1276, 20500, 'CDF', 728, 123, 0),
(1277, 3500, 'CDF', 729, 123, 0),
(1278, 3500, 'CDF', 730, 123, 0),
(1280, 3500, 'CDF', 732, 123, 0),
(1281, 3500, 'CDF', 733, 123, 0),
(1282, 3500, 'CDF', 734, 123, 0),
(1283, 3500, 'CDF', 735, 123, 0),
(1284, 3500, 'CDF', 736, 123, 0),
(1285, 9000, 'CDF', 737, 123, 0),
(1286, 2500, 'CDF', 738, 123, 0),
(1287, 17000, 'CDF', 739, 123, 0),
(1288, 12000, 'CDF', 740, 123, 0),
(1289, 6500, 'CDF', 741, 123, 0),
(1291, 6500, 'CDF', 743, 123, 0),
(1292, 7500, 'CDF', 744, 123, 0),
(1293, 6500, 'CDF', 745, 123, 0),
(1294, 6500, 'CDF', 746, 123, 0),
(1295, 6500, 'CDF', 747, 123, 0),
(1296, 6500, 'CDF', 748, 123, 0),
(1297, 18500, 'CDF', 749, 123, 0),
(1298, 23000, 'CDF', 750, 123, 0),
(1299, 6500, 'CDF', 751, 123, 0),
(1300, 6500, 'CDF', 752, 123, 0),
(1301, 6500, 'CDF', 753, 123, 0),
(1302, 12000, 'CDF', 754, 123, 0),
(1303, 12000, 'CDF', 755, 123, 0),
(1304, 8000, 'CDF', 756, 123, 0),
(1305, 12000, 'CDF', 757, 123, 0),
(1306, 8000, 'CDF', 758, 123, 0),
(1307, 8000, 'CDF', 759, 123, 0),
(1308, 9000, 'CDF', 760, 123, 0),
(1309, 3500, 'CDF', 731, 123, 0),
(1310, 19500, 'CDF', 688, 123, 0),
(1311, 1, 'CDF', 761, 123, 0),
(1312, 1, 'CDF', 762, 123, 0),
(1313, 1, 'CDF', 763, 123, 0),
(1314, 1, 'CDF', 764, 123, 0),
(1315, 1, 'CDF', 765, 123, 0),
(1316, 3500, 'CDF', 766, 123, 0),
(1317, 5000, 'CDF', 767, 123, 0),
(1318, 10000, 'CDF', 768, 123, 0),
(1321, 6500, 'CDF', 742, 123, 0),
(1322, 2500, 'CDF', 769, 123, 0),
(1325, 1000, 'CDF', 770, 123, 0),
(1327, 1500, 'CDF', 771, 123, 0),
(1328, 30, 'CDF', 772, 123, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_reglage`
--

DROP TABLE IF EXISTS `t_reglage`;
CREATE TABLE IF NOT EXISTS `t_reglage` (
  `id_regl` int(11) NOT NULL AUTO_INCREMENT,
  `remise` float DEFAULT NULL,
  `majoration` float DEFAULT NULL,
  `date_regl` date DEFAULT NULL,
  `dte_h` datetime DEFAULT NULL,
  `temps_regl` time DEFAULT NULL,
  `time_checkin` time DEFAULT NULL,
  `m_insert` varchar(10) DEFAULT NULL,
  `m_affiche` varchar(10) DEFAULT NULL,
  `tauxdollar` float(10,2) DEFAULT NULL,
  `taux_op` float DEFAULT '1',
  `tva` float(10,2) DEFAULT NULL,
  `pourcentage_defaut` float DEFAULT '0',
  `pourcentage_24_heure` float DEFAULT '0',
  `pourcentage_48_heure` float DEFAULT '0',
  `pourcentage_72_heure` float DEFAULT '0',
  `pourcentage_sup_72_heure` float DEFAULT '0',
  `type_annul` varchar(20) DEFAULT NULL,
  `fcon_heberge` int(11) DEFAULT '0',
  `user_id` int(10) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT '1',
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_regl`),
  KEY `user_id` (`user_id`),
  KEY `company_id` (`company_id`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_reglage`
--

INSERT INTO `t_reglage` (`id_regl`, `remise`, `majoration`, `date_regl`, `dte_h`, `temps_regl`, `time_checkin`, `m_insert`, `m_affiche`, `tauxdollar`, `taux_op`, `tva`, `pourcentage_defaut`, `pourcentage_24_heure`, `pourcentage_48_heure`, `pourcentage_72_heure`, `pourcentage_sup_72_heure`, `type_annul`, `fcon_heberge`, `user_id`, `id_hotel`, `company_id`, `stock`, `syn`) VALUES
(57, 5, 0, NULL, NULL, NULL, NULL, 'CDF', 'CDF', 2200.00, 2200, 0.00, 0, 0, 0, 0, 0, NULL, 0, 471, 356, 299, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_reglement`
--

DROP TABLE IF EXISTS `t_reglement`;
CREATE TABLE IF NOT EXISTS `t_reglement` (
  `id_regl` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(20) DEFAULT NULL,
  `montant_dollar` decimal(65,10) DEFAULT NULL,
  `montant_fc` decimal(65,10) DEFAULT NULL,
  `reste` decimal(65,10) DEFAULT NULL,
  `id_mode_regl` int(11) DEFAULT NULL,
  `date_regl` datetime DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `rejete` int(11) DEFAULT '0',
  `id_fact` int(11) DEFAULT NULL,
  `id_monnaie` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `id_sousresto` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_regl`),
  KEY `id_fact` (`id_fact`),
  KEY `id_mode_regl` (`id_mode_regl`),
  KEY `id_monnaie` (`id_monnaie`,`id_user`,`id_hotel`),
  KEY `id_monnaie_2` (`id_monnaie`),
  KEY `id_user` (`id_user`),
  KEY `id_hotel` (`id_hotel`),
  KEY `id_sousresto` (`id_sousresto`),
  KEY `fournisseur_id` (`fournisseur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_reglement`
--

INSERT INTO `t_reglement` (`id_regl`, `numero`, `montant_dollar`, `montant_fc`, `reste`, `id_mode_regl`, `date_regl`, `dte`, `rejete`, `id_fact`, `id_monnaie`, `id_user`, `id_hotel`, `id_sousresto`, `fournisseur_id`, `syn`) VALUES
(25, '89790', NULL, NULL, NULL, NULL, '2026-04-19 13:01:01', '2026-04-19', 1, 25, NULL, 508, 356, NULL, NULL, 0),
(26, '89791', NULL, NULL, NULL, NULL, '2026-04-19 13:34:34', '2026-04-19', 1, 28, NULL, 508, 356, NULL, NULL, 0),
(27, '89792', NULL, NULL, NULL, NULL, '2026-04-19 13:43:05', '2026-04-19', 1, 29, NULL, 508, 356, NULL, NULL, 0),
(28, '89793', NULL, NULL, NULL, NULL, '2026-04-19 14:30:34', '2026-04-19', 1, 32, NULL, 508, 356, NULL, NULL, 0),
(29, '89794', NULL, NULL, NULL, NULL, '2026-04-19 15:36:46', '2026-04-19', 1, 31, NULL, 508, 356, NULL, NULL, 0),
(30, '89795', NULL, NULL, NULL, NULL, '2026-04-19 15:38:59', '2026-04-19', 1, 38, NULL, 508, 356, NULL, NULL, 0),
(31, '89796', NULL, NULL, NULL, NULL, '2026-04-19 16:09:07', '2026-04-19', 1, 39, NULL, 508, 356, NULL, NULL, 0),
(32, '89797', NULL, NULL, NULL, NULL, '2026-04-19 16:53:35', '2026-04-19', 1, 42, NULL, 508, 356, NULL, NULL, 0),
(33, '89798', NULL, NULL, NULL, NULL, '2026-04-19 17:10:03', '2026-04-19', 1, 36, NULL, 508, 356, NULL, NULL, 0),
(34, '89799', NULL, NULL, NULL, NULL, '2026-04-19 17:37:56', '2026-04-19', 1, 43, NULL, 508, 356, NULL, NULL, 0),
(35, '89800', NULL, NULL, NULL, NULL, '2026-04-19 17:44:20', '2026-04-19', 1, 35, NULL, 508, 356, NULL, NULL, 0),
(36, '89801', NULL, NULL, NULL, NULL, '2026-04-19 17:45:08', '2026-04-19', 1, 47, NULL, 508, 356, NULL, NULL, 0),
(37, '89802', NULL, NULL, NULL, NULL, '2026-04-19 18:02:01', '2026-04-19', 1, 33, NULL, 508, 356, NULL, NULL, 0),
(38, '89803', NULL, NULL, NULL, NULL, '2026-04-19 18:02:44', '2026-04-19', 1, 41, NULL, 508, 356, NULL, NULL, 0),
(39, '89804', NULL, NULL, NULL, NULL, '2026-04-19 18:04:02', '2026-04-19', 1, 51, NULL, 508, 356, NULL, NULL, 0),
(40, '89805', NULL, NULL, NULL, NULL, '2026-04-19 18:05:24', '2026-04-19', 1, 34, NULL, 508, 356, NULL, NULL, 0),
(41, '89806', NULL, NULL, NULL, NULL, '2026-04-19 18:07:20', '2026-04-19', 1, 53, NULL, 508, 356, NULL, NULL, 0),
(42, '89807', NULL, NULL, NULL, NULL, '2026-04-19 18:29:22', '2026-04-19', 1, 55, NULL, 508, 356, NULL, NULL, 0),
(43, '89808', NULL, NULL, NULL, NULL, '2026-04-19 18:34:02', '2026-04-19', 1, 49, NULL, 508, 356, NULL, NULL, 0),
(44, '89809', NULL, NULL, NULL, NULL, '2026-04-19 18:35:29', '2026-04-19', 1, 52, NULL, 508, 356, NULL, NULL, 0),
(45, '89810', NULL, NULL, NULL, NULL, '2026-04-19 18:57:27', '2026-04-19', 1, 61, NULL, 508, 356, NULL, NULL, 0),
(46, '89811', NULL, NULL, NULL, NULL, '2026-04-19 18:58:38', '2026-04-19', 1, 63, NULL, 508, 356, NULL, NULL, 0),
(47, '89812', NULL, NULL, NULL, NULL, '2026-04-19 19:00:59', '2026-04-19', 1, 59, NULL, 508, 356, NULL, NULL, 0),
(48, '89813', NULL, NULL, NULL, NULL, '2026-04-19 19:04:23', '2026-04-19', 1, 44, NULL, 508, 356, NULL, NULL, 0),
(49, '89814', NULL, NULL, NULL, NULL, '2026-04-19 19:10:53', '2026-04-19', 1, 48, NULL, 508, 356, NULL, NULL, 0),
(50, '89815', NULL, NULL, NULL, NULL, '2026-04-19 19:12:40', '2026-04-19', 1, 46, NULL, 508, 356, NULL, NULL, 0),
(51, '89816', NULL, NULL, NULL, NULL, '2026-04-19 19:17:42', '2026-04-19', 1, 40, NULL, 508, 356, NULL, NULL, 0),
(52, '89817', NULL, NULL, NULL, NULL, '2026-04-19 19:21:40', '2026-04-19', 1, 65, NULL, 508, 356, NULL, NULL, 0),
(53, '89818', NULL, NULL, NULL, NULL, '2026-04-19 19:29:39', '2026-04-19', 1, 45, NULL, 508, 356, NULL, NULL, 0),
(54, '89819', NULL, NULL, NULL, NULL, '2026-04-19 19:30:51', '2026-04-19', 1, 66, NULL, 508, 356, NULL, NULL, 0),
(55, '89820', NULL, NULL, NULL, NULL, '2026-04-19 19:33:59', '2026-04-19', 1, 26, NULL, 508, 356, NULL, NULL, 0),
(56, '89821', NULL, NULL, NULL, NULL, '2026-04-19 19:50:59', '2026-04-19', 1, 68, NULL, 508, 356, NULL, NULL, 0),
(57, '89822', NULL, NULL, NULL, NULL, '2026-04-19 19:53:25', '2026-04-19', 1, 69, NULL, 508, 356, NULL, NULL, 0),
(58, '89823', NULL, NULL, NULL, NULL, '2026-04-19 19:55:48', '2026-04-19', 1, 56, NULL, 508, 356, NULL, NULL, 0),
(59, '89824', NULL, NULL, NULL, NULL, '2026-04-19 20:12:43', '2026-04-19', 1, 62, NULL, 508, 356, NULL, NULL, 0),
(60, '89825', NULL, NULL, NULL, NULL, '2026-04-19 20:36:35', '2026-04-19', 1, 70, NULL, 508, 356, NULL, NULL, 0),
(61, '89826', NULL, NULL, NULL, NULL, '2026-04-19 21:08:32', '2026-04-19', 1, 67, NULL, 508, 356, NULL, NULL, 0),
(62, '89827', NULL, NULL, NULL, NULL, '2026-04-19 21:24:28', '2026-04-19', 1, 71, NULL, 508, 356, NULL, NULL, 0),
(63, '89828', NULL, NULL, NULL, NULL, '2026-04-19 21:39:17', '2026-04-19', 1, 37, NULL, 508, 356, NULL, NULL, 0),
(64, '89829', NULL, NULL, NULL, NULL, '2026-04-19 21:44:47', '2026-04-19', 1, 64, NULL, 508, 356, NULL, NULL, 0),
(65, '89830', NULL, NULL, NULL, NULL, '2026-04-19 21:45:59', '2026-04-19', 1, 60, NULL, 508, 356, NULL, NULL, 0),
(66, '89831', NULL, NULL, NULL, NULL, '2026-04-19 21:59:50', '2026-04-19', 1, 58, NULL, 508, 356, NULL, NULL, 0),
(67, '89832', NULL, NULL, NULL, NULL, '2026-04-19 22:01:05', '2026-04-19', 1, 50, NULL, 508, 356, NULL, NULL, 0),
(68, '89833', NULL, NULL, NULL, NULL, '2026-04-19 22:06:20', '2026-04-19', 1, 27, NULL, 508, 356, NULL, NULL, 0),
(69, '89834', NULL, NULL, NULL, NULL, '2026-04-19 22:13:31', '2026-04-19', 1, 57, NULL, 508, 356, NULL, NULL, 0),
(70, '89835', NULL, NULL, NULL, NULL, '2026-04-19 22:27:07', '2026-04-19', 1, 30, NULL, 508, 356, NULL, NULL, 0),
(71, '89836', NULL, NULL, NULL, NULL, '2026-04-19 22:29:32', '2026-04-19', 1, 54, NULL, 508, 356, NULL, NULL, 0),
(72, '89837', NULL, NULL, NULL, NULL, '2026-04-20 12:21:34', '2026-04-20', 1, 75, NULL, 507, 356, NULL, NULL, 0),
(73, '89838', NULL, NULL, NULL, NULL, '2026-04-20 12:23:14', '2026-04-20', 1, 74, NULL, 507, 356, NULL, NULL, 0),
(76, '89841', NULL, NULL, NULL, NULL, '2026-04-20 12:42:50', '2026-04-20', 1, 76, NULL, 507, 356, NULL, NULL, 0),
(77, '89842', NULL, NULL, NULL, NULL, '2026-04-20 14:54:55', '2026-04-20', 1, 78, NULL, 507, 356, NULL, NULL, 0),
(78, '89843', NULL, NULL, NULL, NULL, '2026-04-20 15:28:48', '2026-04-20', 1, 80, NULL, 507, 356, NULL, NULL, 0),
(79, '89844', NULL, NULL, NULL, NULL, '2026-04-20 17:06:00', '2026-04-20', 1, 79, NULL, 507, 356, NULL, NULL, 0),
(80, '89845', NULL, NULL, NULL, NULL, '2026-04-20 18:06:25', '2026-04-20', 1, 77, NULL, 507, 356, NULL, NULL, 0),
(81, '89846', NULL, NULL, NULL, NULL, '2026-04-20 18:23:06', '2026-04-20', 1, 83, NULL, 508, 356, NULL, NULL, 0),
(82, '89847', NULL, NULL, NULL, NULL, '2026-04-20 18:56:44', '2026-04-20', 1, 84, NULL, 508, 356, NULL, NULL, 0),
(83, '89848', NULL, NULL, NULL, NULL, '2026-04-20 19:17:30', '2026-04-20', 1, 87, NULL, 508, 356, NULL, NULL, 0),
(84, '89849', NULL, NULL, NULL, NULL, '2026-04-20 19:23:19', '2026-04-20', 1, 88, NULL, 508, 356, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_reservation`
--

DROP TABLE IF EXISTS `t_reservation`;
CREATE TABLE IF NOT EXISTS `t_reservation` (
  `id_res` int(11) NOT NULL AUTO_INCREMENT,
  `num_reserv` varchar(20) DEFAULT NULL,
  `garantie` decimal(65,10) DEFAULT NULL,
  `num_bc` varchar(20) DEFAULT NULL,
  `num_occ` varchar(50) DEFAULT NULL,
  `num_com` int(11) DEFAULT '1',
  `type` varchar(20) DEFAULT NULL,
  `tva` float(10,2) DEFAULT NULL,
  `taux` float(10,2) DEFAULT NULL,
  `remise` float(10,2) DEFAULT NULL,
  `majoration` float DEFAULT NULL,
  `mont_nuite` float DEFAULT NULL,
  `mont_total_res` float DEFAULT NULL,
  `mont_par_chambre` float DEFAULT NULL,
  `monnaie` varchar(20) DEFAULT NULL,
  `nbr_ch` int(10) DEFAULT '0',
  `etat` varchar(50) DEFAULT NULL,
  `etat_credit` varchar(10) DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `date_res` datetime DEFAULT NULL,
  `date_occ` datetime DEFAULT NULL,
  `date_lib` datetime DEFAULT NULL,
  `statut_res` varchar(15) DEFAULT NULL,
  `statut_occ` varchar(20) DEFAULT NULL,
  `statut_sorti` varchar(20) DEFAULT NULL,
  `id_client` int(10) DEFAULT NULL,
  `chambr_id` int(11) DEFAULT NULL,
  `id_sousresto` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `dte_a` date DEFAULT NULL,
  `dte_s` date DEFAULT NULL,
  `occ_indirect` int(11) DEFAULT NULL,
  `respo_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_res`),
  KEY `num_ch` (`id_client`),
  KEY `id_client` (`id_client`),
  KEY `id_hotel` (`id_hotel`),
  KEY `chambr_id` (`chambr_id`),
  KEY `respo_id` (`respo_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_reservation`
--

INSERT INTO `t_reservation` (`id_res`, `num_reserv`, `garantie`, `num_bc`, `num_occ`, `num_com`, `type`, `tva`, `taux`, `remise`, `majoration`, `mont_nuite`, `mont_total_res`, `mont_par_chambre`, `monnaie`, `nbr_ch`, `etat`, `etat_credit`, `dte`, `date_res`, `date_occ`, `date_lib`, `statut_res`, `statut_occ`, `statut_sorti`, `id_client`, `chambr_id`, `id_sousresto`, `id_hotel`, `dte_a`, `dte_s`, `occ_indirect`, `respo_id`, `syn`) VALUES
(25, '84852', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2216, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(26, '84853', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(27, '84854', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2211, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(28, '84855', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2217, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(29, '84856', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2218, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(30, '84857', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2219, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(31, '84858', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(32, '84859', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2214, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(33, '84860', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2213, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(34, '84861', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2214, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(35, '84862', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2215, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(36, '84863', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2216, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(37, '84864', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2217, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(38, '84865', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(39, '84866', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(40, '84867', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2218, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(41, '84868', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(42, '84869', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2220, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(43, '84870', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2221, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(44, '84871', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2222, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(45, '84872', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2216, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(46, '84873', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2220, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(47, '84874', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2223, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(48, '84875', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2224, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(49, '84876', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2225, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(50, '84877', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2226, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(51, '84878', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2227, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(52, '84879', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2215, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(53, '84880', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(54, '84881', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2213, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(55, '84882', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(56, '84883', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2214, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(57, '84884', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2221, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(58, '84885', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2223, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(59, '84886', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(60, '84887', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2215, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(61, '84888', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2225, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(62, '84889', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2227, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(63, '84890', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2228, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(64, '84891', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(65, '84892', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2229, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(66, '84893', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2218, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(67, '84894', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(68, '84895', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2216, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(69, '84896', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2218, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(70, '84897', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2214, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(71, '84898', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-19', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2214, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(72, '84899', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(73, '84900', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(74, '84901', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2211, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(75, '84902', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(76, '84903', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2211, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(77, '84904', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(78, '84905', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 1814, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(79, '84906', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(80, '84907', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2211, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(81, '84908', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(82, '84909', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2211, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(83, '84910', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2211, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(84, '84911', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2212, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(85, '84912', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(86, '84913', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(87, '84914', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2210, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(88, '84915', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2213, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(89, '84916', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2214, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(90, '84917', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2215, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0),
(91, '84918', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2026-04-20', NULL, NULL, NULL, 'restaurant', NULL, NULL, 2214, NULL, NULL, 356, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_reserve_chambre`
--

DROP TABLE IF EXISTS `t_reserve_chambre`;
CREATE TABLE IF NOT EXISTS `t_reserve_chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idreserv` int(11) DEFAULT NULL,
  `idchambre` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_accomp` int(10) DEFAULT NULL,
  `statut` varchar(10) NOT NULL,
  `occupe` date DEFAULT NULL,
  `date_occ` date DEFAULT NULL,
  `date_lib` date DEFAULT NULL,
  `annule` varchar(10) DEFAULT NULL,
  `est_responsable` varchar(3) DEFAULT NULL,
  `mont_paye_heb` float DEFAULT '0',
  `mont_paye_resto` float DEFAULT '0',
  `monnaie` varchar(20) DEFAULT NULL,
  `tarif_ch` decimal(65,10) DEFAULT '0.0000000000',
  `nom_accomp` varchar(100) DEFAULT NULL,
  `checkin` time DEFAULT NULL,
  `checkout` time DEFAULT NULL,
  `idfact` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idreserv` (`idreserv`,`idchambre`),
  KEY `idchambre` (`idchambre`),
  KEY `id_client` (`id_client`),
  KEY `id_accomp` (`id_accomp`),
  KEY `idfact` (`idfact`,`id_hotel`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_responsable`
--

DROP TABLE IF EXISTS `t_responsable`;
CREATE TABLE IF NOT EXISTS `t_responsable` (
  `id_respo` int(10) NOT NULL AUTO_INCREMENT,
  `nom_respo` varchar(30) NOT NULL,
  `telephone_respo` varchar(20) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `adresse_respo` varchar(100) NOT NULL,
  `entreprise` varchar(50) NOT NULL,
  `filtre` int(11) DEFAULT '1',
  `pseudo_supp` int(11) DEFAULT '0',
  `company_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_respo`),
  KEY `company_id` (`company_id`),
  KEY `company_id_2` (`company_id`),
  KEY `company_id_3` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_responsable`
--

INSERT INTO `t_responsable` (`id_respo`, `nom_respo`, `telephone_respo`, `email`, `adresse_respo`, `entreprise`, `filtre`, `pseudo_supp`, `company_id`, `syn`) VALUES
(19, 'prive', '', '', '', 'prive', 0, 0, 283, 1),
(20, 'Diala', '0813808322', 'glodybukas@gmail.com', 'Watsha 67', 'Airtel ', 1, 0, 283, 1),
(21, 'prive', '', '', '', 'prive', 0, 0, 0, 1),
(22, 'prive', '', '', '', 'prive', 0, 0, 0, 1),
(23, 'prive', '', '', '', 'prive', 0, 0, 0, 1),
(24, 'prive', '', '', '', 'prive', 0, 0, 284, 1),
(25, 'prive', '', '', '', 'prive', 0, 0, 285, 1),
(26, 'prive', '', '', '', 'prive', 0, 0, 286, 1),
(27, 'prive', '', '', '', 'prive', 0, 0, 287, 1),
(28, 'prive', '', '', '', 'prive', 0, 0, 288, 1),
(29, 'prive', '', '', '', 'prive', 0, 0, 289, 1),
(30, 'prive', '', '', '', 'prive', 0, 0, 290, 1),
(31, 'prive', '', '', '', 'prive', 0, 0, 291, 1),
(32, 'prive', '', '', '', 'prive', 0, 0, 292, 1),
(33, 'prive', '', '', '', 'prive', 0, 0, 293, 1),
(34, 'prive', '', '', '', 'prive', 0, 0, 294, 1),
(35, 'prive', '', '', '', 'prive', 0, 0, 295, 1),
(36, 'prive', '', '', '', 'prive', 0, 0, 296, 1),
(37, 'prive', '', '', '', 'prive', 0, 0, 297, 1),
(38, 'prive', '', '', '', 'prive', 0, 0, 298, 1),
(39, 'prive', '', '', '', 'prive', 0, 0, 299, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_session`
--

DROP TABLE IF EXISTS `t_session`;
CREATE TABLE IF NOT EXISTS `t_session` (
  `idsession` int(10) NOT NULL AUTO_INCREMENT,
  `numero` varchar(100) DEFAULT NULL,
  `date_ouverture` date NOT NULL,
  `date_fermeture` date NOT NULL,
  `statut` int(10) NOT NULL,
  `dte_heure_ouvert` datetime NOT NULL,
  `dte_heure_ferm` datetime NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `souresto_id` int(11) DEFAULT NULL,
  `hotel_id` int(10) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`idsession`),
  KEY `user_id` (`user_id`),
  KEY `caisse_id` (`souresto_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `souresto_id` (`souresto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_session`
--

INSERT INTO `t_session` (`idsession`, `numero`, `date_ouverture`, `date_fermeture`, `statut`, `dte_heure_ouvert`, `dte_heure_ferm`, `user_id`, `souresto_id`, `hotel_id`, `syn`) VALUES
(1, NULL, '2023-01-12', '2023-01-12', 0, '2023-01-12 12:22:20', '2023-01-12 22:21:05', 480, 123, 356, 1),
(2, NULL, '2023-01-13', '2023-01-13', 0, '2023-01-13 07:13:31', '2023-01-13 23:15:31', 480, 123, 356, 1),
(3, NULL, '2023-01-14', '2023-01-14', 0, '2023-01-14 07:50:01', '2023-01-14 23:21:34', 475, 123, 356, 1),
(4, NULL, '2023-01-14', '2023-01-14', 1, '2023-01-14 23:22:05', '2023-01-14 23:22:05', 480, 123, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_sousresto`
--

DROP TABLE IF EXISTS `t_sousresto`;
CREATE TABLE IF NOT EXISTS `t_sousresto` (
  `id_sousresto` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `depot_id` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `statut` int(11) DEFAULT NULL,
  `taux` decimal(65,10) DEFAULT '1.0000000000',
  `mentionlegale` text,
  `remise` int(11) DEFAULT '0',
  `hotel_id` int(10) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_sousresto`),
  KEY `hotel_id` (`hotel_id`),
  KEY `depot_id` (`depot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_sousresto`
--

INSERT INTO `t_sousresto` (`id_sousresto`, `libelle`, `depot_id`, `etat`, `statut`, `taux`, `mentionlegale`, `remise`, `hotel_id`, `syn`) VALUES
(122, 'Central', 121, 0, NULL, '1.0000000000', NULL, 0, 356, 1),
(123, 'CARAVAC', 121, 1, 0, '2200.0000000000', 'Merci de votre visite', 0, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_suggestion`
--

DROP TABLE IF EXISTS `t_suggestion`;
CREATE TABLE IF NOT EXISTS `t_suggestion` (
  `id_sug` int(11) NOT NULL AUTO_INCREMENT,
  `textsug` text NOT NULL,
  `datesug` datetime NOT NULL,
  `statut` varchar(15) NOT NULL,
  `chambre_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `id_util` int(10) NOT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_sug`),
  KEY `id_util` (`id_util`),
  KEY `chambre_id` (`chambre_id`,`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

DROP TABLE IF EXISTS `t_utilisateur`;
CREATE TABLE IF NOT EXISTS `t_utilisateur` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(100) DEFAULT NULL,
  `prenom_user` varchar(20) DEFAULT NULL,
  `sexe_user` varchar(10) DEFAULT NULL,
  `telephone_user` int(18) DEFAULT NULL,
  `email_user` text,
  `mdp_user` text,
  `adresse_mail` varchar(245) DEFAULT NULL,
  `type` int(11) DEFAULT '3',
  `actif` int(11) DEFAULT NULL,
  `id_hotel` int(10) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `id_droit` int(10) DEFAULT NULL,
  `fconnect` int(11) DEFAULT NULL,
  `connect` int(11) DEFAULT NULL,
  `module_dflt` varchar(250) DEFAULT NULL,
  `module_name` varchar(20) DEFAULT NULL,
  `psedo` int(10) DEFAULT '0',
  `pos_id` int(11) DEFAULT '0',
  `path_image` text,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_user`),
  KEY `id_hotel` (`id_hotel`,`id_droit`),
  KEY `id_droit` (`id_droit`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`id_user`, `nom_user`, `prenom_user`, `sexe_user`, `telephone_user`, `email_user`, `mdp_user`, `adresse_mail`, `type`, `actif`, `id_hotel`, `company_id`, `id_droit`, `fconnect`, `connect`, `module_dflt`, `module_name`, `psedo`, `pos_id`, `path_image`, `syn`) VALUES
(471, 'Admin', NULL, 'feminin', 2147483647, 'R3sto@Admin!26_K', '$2y$10$fo9UdY8v17tnkZExSMryC.rHqpZGRC0FS5ro5oqiH/RgyeBYLDkNW', 'irene@ebutelo.com', 1, 1, 356, 299, 1, NULL, 1, '', '', 0, 123, NULL, 1),
(496, 'JUNIOR KALUNGA', NULL, 'feminin', NULL, '1958', '$2y$10$T6w86IM264Z7nGRg241cl.t6Z12HbW6Z79mmrVBZRK0gmUOy8Z8qi', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(498, 'JUNIOR KALUNGA', NULL, 'masculin', NULL, '4821', '$2y$10$ywkDgdplka2PMj5sjSN7o.mhb1u2TszqtTm2SS9N1hyfoTwl7YtYS', NULL, 5, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 1, 123, NULL, 0),
(499, 'ROLLY LULEBI', NULL, 'masculin', NULL, '7395', '$2y$10$bQwNfDJx2uW59G3A/9HeQOPUi85iyA/91ihb2N7ajuKzgK1OpsbS6', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(500, 'JOE LOPOKO', NULL, 'masculin', NULL, '1064', '$2y$10$cXlo84hrpUr028GftEZi2OyfAm.T56gtyHjsAW.W9C4amQctbr79W', NULL, 1, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(501, 'SIMEON KANYINDA', NULL, 'masculin', NULL, '8852', '$2y$10$raC8YhmMBg7qCJx/Wlxw9OgRI7MSTydr3e31Wqt7113hM.mIyoZii', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(502, 'FREDDY ZIKUTA', NULL, 'masculin', NULL, '3197', '$2y$10$9vzE4SAqvcrRuSAiw9OlJ.bcUIc6dz1EkjHE29KJgxMbDCbbU1SNi', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'Stock2/index.php', 'Stock', 0, 123, NULL, 0),
(503, 'GEMIMA KIBIKULA', NULL, 'feminin', NULL, '5570', '$2y$10$WO1hF35en72BdUCCdu/u2uJgFJw7L/ultaH2.nWBRKp2KBVzD.cwC', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(504, 'TRYPHENE KAZADI', NULL, 'feminin', NULL, '8089', '$2y$10$Y1RnJQRBkm6ZMV1hAgKnfOoqUGcNzHx6liYL91alwVFDjvGqlVxuy', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(505, 'TONY MBAYI', NULL, 'masculin', NULL, '7620', '$2y$10$OAH9wWcXRnt4J9G7wfEgCuuX5lME.o6T1Uf/ofCWcU10OnkwrPyIy', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(506, 'ESPERANCE STELLA BAHITAPE', NULL, 'feminin', NULL, '6007', '$2y$10$5b3F/FhW9n1dSxgTMaUL1u6XnD7zj9NJo11tYkiXCnbqrKAFxhTYC', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(507, 'BESKY BENDA', NULL, 'feminin', NULL, '3482', '$2y$10$CVfAIJH1bcYbWhSdISJyi.FeaJIIpA5QuLL9zWvMnubUiEqwOI2s.', NULL, 5, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0),
(508, 'SABRINA SELE', NULL, 'feminin', NULL, '7994', '$2y$10$G3onL6ymnYjTHfHMcWF3/uFUjEtLR2N6PIU43uJK5ZqL53vzu56SS', NULL, 5, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_validation`
--

DROP TABLE IF EXISTS `t_validation`;
CREATE TABLE IF NOT EXISTS `t_validation` (
  `id_validation` int(11) NOT NULL AUTO_INCREMENT,
  `qte_envoye` float DEFAULT '0',
  `qte_verif` float DEFAULT '0',
  `motif_id` int(11) NOT NULL DEFAULT '0',
  `produit_id` int(11) DEFAULT NULL,
  `fiche_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`id_validation`),
  KEY `produit_id` (`produit_id`,`fiche_id`,`hotel_id`),
  KEY `fiche_id` (`fiche_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1825 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_validation`
--

INSERT INTO `t_validation` (`id_validation`, `qte_envoye`, `qte_verif`, `motif_id`, `produit_id`, `fiche_id`, `hotel_id`, `syn`) VALUES
(111, 100, 100, 7, 83, 380, 328, 1),
(112, 100, 100, 7, 74, 380, 328, 1),
(113, 100, 100, 7, 84, 380, 328, 1),
(114, 100, 100, 7, 75, 380, 328, 1),
(115, 100, 100, 7, 76, 380, 328, 1),
(116, 100, 100, 7, 85, 380, 328, 1),
(117, 100, 100, 7, 77, 380, 328, 1),
(118, 100, 100, 7, 79, 380, 328, 1),
(119, 100, 100, 7, 78, 380, 328, 1),
(120, 10, 8, 7, 102, 406, 328, 1),
(121, 15, 0, 6, 83, 412, 328, 1),
(122, 10, 0, 6, 88, 412, 328, 1),
(123, 10, 0, 6, 83, 413, 328, 1),
(124, 5, 0, 6, 88, 413, 328, 1),
(125, 1, 0, 6, 74, 423, 328, 1),
(126, 1, 0, 6, 75, 423, 328, 1),
(127, 3, 3, 7, 410, 1254, 356, 1),
(128, 24, 24, 7, 32, 1320, 356, 1),
(129, 12, 12, 7, 32, 1323, 356, 1),
(130, 36, 36, 7, 6, 1323, 356, 1),
(131, 24, 24, 7, 4, 1328, 356, 1),
(132, 24, 24, 7, 8, 1328, 356, 1),
(133, 36, 36, 7, 18, 1328, 356, 1),
(134, 50, 50, 7, 440, 1330, 356, 1),
(135, 0.28, 0.28, 7, 755, 1334, 356, 1),
(136, 1.4, 1.4, 7, 667, 1334, 356, 1),
(137, 0.26, 0.26, 7, 639, 1334, 356, 1),
(138, 0.38, 0.38, 7, 710, 1334, 356, 1),
(139, 1, 1, 7, 760, 1334, 356, 1),
(140, 0.6, 0.6, 7, 662, 1334, 356, 1),
(141, 0.6, 0.6, 7, 662, 1341, 356, 1),
(142, 3, 3, 7, 444, 1346, 356, 1),
(143, 19, 19, 7, 9, 1348, 356, 1),
(144, 12, 12, 7, 15, 1362, 356, 1),
(145, 24, 24, 7, 9, 1362, 356, 1),
(146, 24, 24, 7, 11, 1362, 356, 1),
(147, 24, 24, 7, 28, 1362, 356, 1),
(148, 24, 24, 7, 439, 1364, 356, 1),
(149, 10, 10, 7, 468, 1366, 356, 1),
(150, 6, 6, 7, 8, 1370, 356, 1),
(151, 1, 1, 7, 9, 1370, 356, 1),
(152, 2, 2, 7, 439, 1370, 356, 1),
(153, 3, 3, 7, 113, 1379, 356, 1),
(154, 1, 1, 7, 211, 1385, 356, 1),
(155, 1, 1, 7, 271, 1385, 356, 1),
(156, 0.5, 0.5, 7, 635, 1452, 356, 1),
(157, 36, 36, 7, 32, 1464, 356, 1),
(158, 36, 36, 7, 35, 1464, 356, 1),
(159, 24, 24, 7, 36, 1464, 356, 1),
(160, 12, 12, 7, 19, 1464, 356, 1),
(161, 24, 24, 7, 18, 1464, 356, 1),
(162, 6, 6, 7, 655, 1464, 356, 1),
(163, 6, 6, 7, 469, 1464, 356, 1),
(164, 12, 12, 7, 15, 1464, 356, 1),
(165, 24, 24, 7, 10, 1464, 356, 1),
(166, 24, 24, 7, 531, 1464, 356, 1),
(167, 24, 24, 7, 6, 1464, 356, 1),
(168, 24, 24, 7, 484, 1464, 356, 1),
(169, 1, 1, 7, 211, 1464, 356, 1),
(170, 20, 20, 7, 440, 1464, 356, 1),
(171, 12, 12, 7, 659, 1466, 356, 1),
(172, 12, 12, 7, 658, 1466, 356, 1),
(173, 6, 6, 7, 19, 1472, 356, 1),
(174, 24, 24, 7, 18, 1472, 356, 1),
(175, 12, 12, 7, 36, 1499, 356, 1),
(176, 24, 24, 7, 32, 1499, 356, 1),
(177, 24, 24, 7, 28, 1499, 356, 1),
(178, 24, 24, 7, 39, 1499, 356, 1),
(179, 24, 24, 7, 4, 1499, 356, 1),
(180, 18, 18, 7, 12, 1499, 356, 1),
(181, 24, 24, 7, 11, 1499, 356, 1),
(182, 24, 24, 7, 9, 1499, 356, 1),
(183, 24, 24, 7, 8, 1499, 356, 1),
(184, 24, 24, 7, 484, 1499, 356, 1),
(185, 24, 24, 7, 531, 1499, 356, 1),
(186, 24, 24, 7, 10, 1499, 356, 1),
(187, 24, 24, 7, 6, 1499, 356, 1),
(188, 12, 12, 7, 515, 1499, 356, 1),
(189, 12, 12, 7, 19, 1499, 356, 1),
(190, 24, 24, 7, 18, 1499, 356, 1),
(191, 20, 20, 7, 708, 1499, 356, 1),
(192, 3, 3, 7, 706, 1505, 356, 1),
(193, 3, 3, 7, 418, 1505, 356, 1),
(194, 24, 24, 7, 15, 1505, 356, 1),
(195, 24, 24, 7, 15, 1524, 356, 1),
(196, 24, 24, 7, 4, 1537, 356, 1),
(197, 24, 24, 7, 8, 1537, 356, 1),
(198, 12, 12, 7, 17, 1537, 356, 1),
(199, 24, 24, 7, 9, 1537, 356, 1),
(200, 18, 18, 7, 19, 1537, 356, 1),
(201, 36, 36, 7, 18, 1537, 356, 1),
(202, 5, 5, 7, 655, 1537, 356, 1),
(203, 7, 7, 7, 21, 1537, 356, 1),
(204, 24, 24, 7, 28, 1537, 356, 1),
(205, 12, 12, 7, 32, 1537, 356, 1),
(206, 12, 12, 7, 35, 1537, 356, 1),
(207, 12, 12, 7, 658, 1537, 356, 1),
(208, 1, 1, 7, 708, 1538, 356, 1),
(209, 1, 1, 7, 451, 1545, 356, 1),
(210, 10, 10, 7, 140, 1547, 356, 1),
(211, 9, 9, 7, 139, 1547, 356, 1),
(212, 2, 2, 7, 113, 1547, 356, 1),
(213, 2, 2, 7, 114, 1547, 356, 1),
(214, 36, 36, 7, 6, 1548, 356, 1),
(215, 36, 36, 7, 484, 1548, 356, 1),
(216, 36, 36, 7, 531, 1548, 356, 1),
(217, 2, 2, 7, 188, 1548, 356, 1),
(218, 10, 10, 7, 438, 1548, 356, 1),
(219, 350, 350, 7, 776, 1548, 356, 1),
(220, 3, 3, 7, 119, 1553, 356, 1),
(221, 3, 3, 7, 88, 1555, 356, 1),
(222, 50, 50, 7, 440, 1559, 356, 1),
(223, 1.98, 1.98, 7, 90, 1563, 356, 1),
(224, 1, 1, 7, 466, 1579, 356, 1),
(225, 24, 24, 7, 6, 1591, 356, 1),
(226, 24, 24, 7, 8, 1591, 356, 1),
(227, 4, 4, 7, 468, 1593, 356, 1),
(228, 10, 10, 7, 469, 1593, 356, 1),
(229, 24, 24, 7, 4, 1606, 356, 1),
(230, 24, 24, 7, 8, 1606, 356, 1),
(231, 24, 24, 7, 9, 1606, 356, 1),
(232, 17, 17, 7, 15, 1606, 356, 1),
(233, 18, 18, 7, 35, 1606, 356, 1),
(234, 24, 24, 7, 32, 1611, 356, 1),
(235, 24, 24, 7, 10, 1611, 356, 1),
(236, 10, 10, 7, 499, 1612, 356, 1),
(237, 11, 11, 7, 36, 1620, 356, 1),
(238, 24, 24, 7, 11, 1630, 356, 1),
(239, 24, 24, 7, 19, 1634, 356, 1),
(240, 180, 180, 7, 18, 1634, 356, 1),
(241, 24, 24, 7, 387, 1643, 356, 1),
(242, 9, 9, 7, 649, 1652, 356, 1),
(243, 24, 24, 7, 484, 1667, 356, 1),
(244, 46, 46, 7, 41, 1669, 356, 1),
(245, 24, 24, 7, 4, 1669, 356, 1),
(246, 24, 24, 7, 20, 1669, 356, 1),
(247, 24, 24, 7, 439, 1669, 356, 1),
(248, 24, 24, 7, 9, 1669, 356, 1),
(249, 24, 24, 7, 11, 1669, 356, 1),
(250, 12, 12, 7, 15, 1669, 356, 1),
(251, 24, 24, 7, 16, 1669, 356, 1),
(252, 12, 12, 7, 33, 1669, 356, 1),
(253, 12, 12, 7, 18, 1669, 356, 1),
(254, 30, 30, 7, 19, 1669, 356, 1),
(255, 11, 11, 7, 468, 1669, 356, 1),
(256, 9, 9, 7, 469, 1669, 356, 1),
(257, 2, 2, 7, 656, 1669, 356, 1),
(258, 2, 2, 7, 659, 1669, 356, 1),
(259, 2, 2, 7, 657, 1669, 356, 1),
(260, 2, 2, 7, 653, 1669, 356, 1),
(261, 1000, 1000, 7, 776, 1688, 356, 1),
(262, 1, 1, 7, 195, 1688, 356, 1),
(263, 2, 2, 7, 518, 1688, 356, 1),
(264, 2, 2, 7, 167, 1688, 356, 1),
(265, 2, 2, 7, 211, 1688, 356, 1),
(266, 30, 30, 7, 533, 1688, 356, 1),
(267, 1, 1, 7, 267, 1688, 356, 1),
(268, 13, 13, 7, 282, 1688, 356, 1),
(269, 4, 4, 7, 150, 1688, 356, 1),
(270, 3, 3, 7, 278, 1688, 356, 1),
(271, 2, 2, 7, 203, 1688, 356, 1),
(272, 1, 1, 7, 188, 1688, 356, 1),
(273, 6, 6, 7, 655, 1698, 356, 1),
(274, 4, 4, 7, 802, 1703, 356, 1),
(275, 48, 48, 7, 39, 1707, 356, 1),
(276, 36, 36, 7, 36, 1707, 356, 1),
(277, 24, 24, 7, 35, 1707, 356, 1),
(278, 36, 36, 7, 32, 1707, 356, 1),
(279, 72, 72, 7, 18, 1707, 356, 1),
(280, 3, 3, 7, 418, 1707, 356, 1),
(281, 3, 3, 7, 706, 1707, 356, 1),
(282, 24, 24, 7, 407, 1712, 356, 1),
(283, 24, 24, 7, 439, 1712, 356, 1),
(284, 2, 2, 7, 601, 1712, 356, 1),
(285, 1, 1, 7, 98, 1713, 356, 1),
(286, 17, 17, 7, 12, 1721, 356, 1),
(287, 3, 3, 7, 116, 1729, 356, 1),
(288, 8, 8, 7, 658, 1735, 356, 1),
(289, 36, 36, 7, 35, 1758, 356, 1),
(290, 24, 24, 7, 6, 1758, 356, 1),
(291, 24, 24, 7, 484, 1758, 356, 1),
(292, 12, 12, 7, 10, 1758, 356, 1),
(293, 24, 24, 7, 8, 1758, 356, 1),
(294, 24, 24, 7, 15, 1758, 356, 1),
(295, 24, 24, 7, 4, 1758, 356, 1),
(296, 10, 10, 7, 659, 1758, 356, 1),
(297, 48, 48, 7, 18, 1758, 356, 1),
(298, 12, 12, 7, 32, 1759, 356, 1),
(299, 1, 1, 7, 195, 1759, 356, 1),
(300, 40, 40, 7, 151, 1759, 356, 1),
(301, 2, 2, 7, 267, 1759, 356, 1),
(302, 3, 3, 7, 187, 1759, 356, 1),
(303, 1, 1, 7, 271, 1759, 356, 1),
(304, 1, 1, 7, 775, 1759, 356, 1),
(305, 1, 1, 7, 203, 1759, 356, 1),
(306, 24, 24, 7, 6, 1759, 356, 1),
(307, 24, 24, 7, 484, 1759, 356, 1),
(308, 12, 12, 7, 10, 1759, 356, 1),
(309, 10, 10, 7, 656, 1768, 356, 1),
(310, 0.25, 0.25, 7, 444, 1783, 356, 1),
(311, 1, 1, 7, 95, 1784, 356, 1),
(312, 1, 1, 7, 93, 1786, 356, 1),
(313, 24, 24, 7, 4, 1825, 356, 1),
(314, 24, 24, 7, 8, 1825, 356, 1),
(315, 32, 32, 7, 17, 1825, 356, 1),
(316, 24, 24, 7, 11, 1825, 356, 1),
(317, 24, 24, 7, 6, 1825, 356, 1),
(318, 24, 24, 7, 10, 1825, 356, 1),
(319, 24, 24, 7, 484, 1825, 356, 1),
(320, 12, 12, 7, 658, 1825, 356, 1),
(321, 12, 12, 7, 657, 1825, 356, 1),
(322, 12, 12, 7, 19, 1825, 356, 1),
(323, 6, 6, 7, 655, 1825, 356, 1),
(324, 60, 60, 7, 18, 1825, 356, 1),
(325, 4, 4, 7, 708, 1825, 356, 1),
(326, 1, 1, 7, 617, 1825, 356, 1),
(327, 1, 1, 7, 243, 1825, 356, 1),
(328, 2, 2, 7, 96, 1825, 356, 1),
(329, 1, 1, 7, 451, 1825, 356, 1),
(330, 1, 1, 7, 667, 1825, 356, 1),
(331, 10, 10, 7, 165, 1825, 356, 1),
(332, 1, 1, 7, 523, 1825, 356, 1),
(333, 1, 1, 7, 145, 1825, 356, 1),
(334, 1, 1, 7, 249, 1825, 356, 1),
(335, 50, 50, 7, 440, 1825, 356, 1),
(336, 1, 1, 7, 402, 1825, 356, 1),
(337, 1, 1, 7, 635, 1825, 356, 1),
(338, 2, 2, 7, 83, 1825, 356, 1),
(339, 15, 15, 7, 147, 1826, 356, 1),
(340, 1, 1, 7, 802, 1826, 356, 1),
(341, 30, 30, 7, 533, 1826, 356, 1),
(342, 60, 60, 7, 18, 1826, 356, 1),
(343, 6, 6, 7, 19, 1826, 356, 1),
(344, 500, 500, 7, 776, 1826, 356, 1),
(345, 500, 500, 7, 195, 1826, 356, 1),
(346, 2, 2, 7, 267, 1826, 356, 1),
(347, 10, 10, 7, 282, 1826, 356, 1),
(348, 2, 2, 7, 518, 1826, 356, 1),
(349, 5, 5, 7, 150, 1826, 356, 1),
(350, 2, 2, 7, 203, 1826, 356, 1),
(351, 1, 1, 7, 210, 1826, 356, 1),
(352, 1, 1, 7, 227, 1826, 356, 1),
(353, 24, 24, 7, 35, 1858, 356, 1),
(354, 24, 24, 7, 32, 1858, 356, 1),
(355, 24, 24, 7, 28, 1858, 356, 1),
(356, 500, 500, 7, 195, 1859, 356, 1),
(357, 25, 25, 7, 147, 1859, 356, 1),
(358, 12, 12, 7, 9, 1879, 356, 1),
(359, 0.266667, 0.266667, 7, 82, 1887, 356, 1),
(360, 1, 1, 7, 102, 1895, 356, 1),
(361, 370, 370, 7, 776, 1905, 356, 1),
(362, 500, 500, 7, 195, 1905, 356, 1),
(363, 2, 2, 7, 150, 1905, 356, 1),
(364, 24, 24, 7, 10, 1905, 356, 1),
(365, 24, 24, 7, 9, 1907, 356, 1),
(366, 24, 24, 7, 484, 1907, 356, 1),
(367, 10, 10, 7, 469, 1907, 356, 1),
(368, 2, 2, 7, 551, 1907, 356, 1),
(369, 60, 60, 7, 18, 1907, 356, 1),
(370, 24, 24, 7, 19, 1907, 356, 1),
(371, 3, 3, 7, 145, 1907, 356, 1),
(372, 2, 2, 7, 707, 1909, 356, 1),
(373, 0.06, 0.06, 7, 755, 1916, 356, 1),
(374, 2, 2, 7, 95, 1925, 356, 1),
(375, 10, 10, 7, 499, 1955, 356, 1),
(376, 12, 12, 7, 649, 1957, 356, 1),
(377, 1, 1, 7, 373, 1960, 356, 1),
(378, 24, 24, 7, 28, 1972, 356, 1),
(379, 24, 24, 7, 4, 1972, 356, 1),
(380, 24, 24, 7, 12, 1972, 356, 1),
(381, 24, 24, 7, 8, 1972, 356, 1),
(382, 24, 24, 7, 15, 1972, 356, 1),
(383, 24, 24, 7, 11, 1972, 356, 1),
(384, 48, 48, 7, 18, 1972, 356, 1),
(385, 30, 30, 7, 19, 1972, 356, 1),
(386, 10, 10, 7, 165, 1972, 356, 1),
(387, 100, 100, 7, 440, 1972, 356, 1),
(388, 1, 1, 7, 523, 1972, 356, 1),
(389, 1, 1, 7, 249, 1972, 356, 1),
(390, 4, 4, 7, 145, 1972, 356, 1),
(391, 10, 10, 7, 503, 1972, 356, 1),
(392, 12, 12, 7, 659, 1974, 356, 1),
(393, 12, 12, 7, 658, 1974, 356, 1),
(394, 15, 15, 7, 282, 1977, 356, 1),
(395, 2, 2, 7, 518, 1977, 356, 1),
(396, 3, 3, 7, 150, 1977, 356, 1),
(397, 235, 235, 7, 776, 1977, 356, 1),
(398, 5, 5, 7, 167, 1977, 356, 1),
(399, 2, 2, 7, 211, 1977, 356, 1),
(400, 5, 5, 7, 203, 1977, 356, 1),
(401, 24, 24, 7, 10, 1977, 356, 1),
(402, 24, 24, 7, 32, 1977, 356, 1),
(403, 1, 1, 7, 658, 1977, 356, 1),
(404, 60, 60, 7, 18, 1977, 356, 1),
(405, 1, 1, 7, 187, 1979, 356, 1),
(406, 25, 25, 7, 147, 1979, 356, 1),
(407, 1, 1, 7, 271, 1979, 356, 1),
(408, 1, 1, 7, 279, 1979, 356, 1),
(409, 1, 1, 7, 266, 1979, 356, 1),
(410, 2, 2, 7, 668, 1979, 356, 1),
(411, 1, 1, 7, 270, 1979, 356, 1),
(412, 1, 1, 7, 278, 1979, 356, 1),
(413, 2, 2, 7, 188, 1979, 356, 1),
(414, 1000, 1000, 7, 195, 1979, 356, 1),
(415, 30, 30, 7, 533, 1979, 356, 1),
(416, 1, 1, 7, 227, 1979, 356, 1),
(417, 1, 1, 7, 210, 1979, 356, 1),
(418, 12, 12, 7, 515, 1989, 356, 1),
(419, 12, 12, 7, 17, 1989, 356, 1),
(420, 1, 1, 7, 802, 1989, 356, 1),
(421, 350, 350, 7, 776, 1989, 356, 1),
(422, 2, 2, 7, 658, 1989, 356, 1),
(423, 10, 10, 7, 500, 1997, 356, 1),
(424, 24, 24, 7, 9, 2012, 356, 1),
(425, 12, 12, 7, 484, 2012, 356, 1),
(426, 24, 24, 7, 6, 2012, 356, 1),
(427, 24, 24, 7, 10, 2012, 356, 1),
(428, 24, 24, 7, 36, 2012, 356, 1),
(429, 12, 12, 7, 32, 2012, 356, 1),
(430, 2, 2, 7, 113, 2012, 356, 1),
(431, 4, 4, 7, 145, 2012, 356, 1),
(432, 24, 24, 7, 28, 2041, 356, 1),
(433, 24, 24, 7, 15, 2041, 356, 1),
(434, 1, 1, 7, 554, 2053, 356, 1),
(435, 21, 21, 7, 43, 2068, 356, 1),
(436, 24, 24, 7, 12, 2091, 356, 1),
(437, 24, 24, 7, 20, 2091, 356, 1),
(438, 24, 24, 7, 8, 2091, 356, 1),
(439, 12, 12, 7, 15, 2091, 356, 1),
(440, 48, 48, 7, 4, 2091, 356, 1),
(441, 24, 24, 7, 439, 2091, 356, 1),
(442, 24, 24, 7, 9, 2091, 356, 1),
(443, 24, 24, 7, 32, 2091, 356, 1),
(444, 18, 18, 7, 19, 2091, 356, 1),
(445, 48, 48, 7, 18, 2091, 356, 1),
(446, 24, 24, 7, 35, 2091, 356, 1),
(447, 12, 12, 7, 657, 2091, 356, 1),
(448, 24, 24, 7, 6, 2091, 356, 1),
(449, 11, 11, 7, 484, 2091, 356, 1),
(450, 24, 24, 7, 10, 2091, 356, 1),
(451, 1, 1, 7, 444, 2091, 356, 1),
(452, 10, 10, 7, 165, 2091, 356, 1),
(453, 12, 12, 7, 658, 2093, 356, 1),
(454, 1, 1, 7, 211, 2093, 356, 1),
(455, 5, 5, 7, 145, 2103, 356, 1),
(456, 2, 2, 7, 267, 2104, 356, 1),
(457, 5, 5, 7, 150, 2104, 356, 1),
(458, 1000, 1000, 7, 195, 2104, 356, 1),
(459, 30, 30, 7, 533, 2104, 356, 1),
(460, 3, 3, 7, 658, 2104, 356, 1),
(461, 24, 24, 7, 6, 2104, 356, 1),
(462, 24, 24, 7, 484, 2104, 356, 1),
(463, 2, 2, 7, 802, 2104, 356, 1),
(464, 4, 4, 7, 187, 2104, 356, 1),
(465, 1, 1, 7, 271, 2104, 356, 1),
(466, 1, 1, 7, 269, 2104, 356, 1),
(467, 40, 40, 7, 147, 2104, 356, 1),
(468, 10, 10, 7, 438, 2104, 356, 1),
(469, 1, 1, 7, 266, 2104, 356, 1),
(470, 1, 1, 7, 692, 2104, 356, 1),
(471, 2, 2, 7, 188, 2104, 356, 1),
(472, 2, 2, 7, 278, 2104, 356, 1),
(473, 10, 10, 7, 282, 2104, 356, 1),
(474, 3, 3, 7, 167, 2104, 356, 1),
(475, 20, 20, 7, 440, 2110, 356, 1),
(476, 11, 11, 7, 499, 2116, 356, 1),
(477, 10, 10, 7, 502, 2116, 356, 1),
(478, 1, 1, 7, 82, 2132, 356, 1),
(479, 12, 12, 7, 18, 2132, 356, 1),
(480, 20, 20, 7, 440, 2140, 356, 1),
(481, 24, 24, 7, 9, 2141, 356, 1),
(482, 24, 24, 7, 4, 2141, 356, 1),
(483, 24, 24, 7, 32, 2141, 356, 1),
(484, 1, 1, 7, 116, 2141, 356, 1),
(485, 24, 24, 7, 16, 2142, 356, 1),
(486, 24, 24, 7, 19, 2145, 356, 1),
(487, 2, 2, 7, 706, 2145, 356, 1),
(488, 2, 2, 7, 418, 2145, 356, 1),
(489, 10, 10, 7, 11, 2148, 356, 1),
(490, 24, 24, 7, 6, 2148, 356, 1),
(491, 12, 12, 7, 515, 2148, 356, 1),
(492, 2, 2, 7, 601, 2148, 356, 1),
(493, 24, 24, 7, 39, 2152, 356, 1),
(494, 12, 12, 7, 640, 2152, 356, 1),
(495, 12, 12, 7, 654, 2152, 356, 1),
(496, 12, 12, 7, 683, 2152, 356, 1),
(497, 36, 36, 7, 18, 2155, 356, 1),
(498, 500, 500, 7, 195, 2155, 356, 1),
(499, 12, 12, 7, 6, 2169, 356, 1),
(500, 12, 12, 7, 18, 2169, 356, 1),
(501, 1, 1, 7, 95, 2182, 356, 1),
(502, 2, 2, 7, 127, 2182, 356, 1),
(503, 12, 12, 7, 15, 2190, 356, 1),
(504, 12, 12, 7, 4, 2221, 356, 1),
(505, 12, 12, 7, 8, 2221, 356, 1),
(506, 24, 24, 7, 9, 2221, 356, 1),
(507, 20, 20, 7, 15, 2221, 356, 1),
(508, 4, 4, 7, 187, 2221, 356, 1),
(509, 1, 1, 7, 271, 2221, 356, 1),
(510, 1, 1, 7, 269, 2221, 356, 1),
(511, 1, 1, 7, 274, 2221, 356, 1),
(512, 1, 1, 7, 802, 2221, 356, 1),
(513, 2, 2, 7, 188, 2221, 356, 1),
(514, 2, 2, 7, 278, 2221, 356, 1),
(515, 30, 30, 7, 533, 2221, 356, 1),
(516, 2, 2, 7, 211, 2221, 356, 1),
(517, 1450, 1450, 7, 195, 2221, 356, 1),
(518, 2, 2, 7, 227, 2221, 356, 1),
(519, 4, 4, 7, 150, 2221, 356, 1),
(520, 24, 24, 7, 4, 2222, 356, 1),
(521, 24, 24, 7, 8, 2224, 356, 1),
(522, 12, 12, 7, 9, 2224, 356, 1),
(523, 24, 24, 7, 11, 2224, 356, 1),
(524, 12, 12, 7, 15, 2224, 356, 1),
(525, 12, 12, 7, 41, 2224, 356, 1),
(526, 12, 12, 7, 17, 2224, 356, 1),
(527, 12, 12, 7, 32, 2224, 356, 1),
(528, 12, 12, 7, 649, 2224, 356, 1),
(529, 12, 12, 7, 31, 2224, 356, 1),
(530, 24, 24, 7, 19, 2224, 356, 1),
(531, 60, 60, 7, 18, 2224, 356, 1),
(532, 1, 1, 7, 92, 2230, 356, 1),
(533, 25, 25, 7, 440, 2231, 356, 1),
(534, 1, 1, 7, 410, 2233, 356, 1),
(535, 1, 1, 7, 662, 2233, 356, 1),
(536, 1, 1, 7, 83, 2233, 356, 1),
(537, 24, 24, 7, 8, 2233, 356, 1),
(538, 24, 24, 7, 4, 2233, 356, 1),
(539, 48, 48, 7, 18, 2233, 356, 1),
(540, 2, 2, 7, 708, 2233, 356, 1),
(541, 4, 4, 7, 657, 2233, 356, 1),
(542, 3, 3, 7, 706, 2233, 356, 1),
(543, 3, 3, 7, 418, 2233, 356, 1),
(544, 2, 2, 7, 373, 2235, 356, 1),
(545, 2, 2, 7, 81, 2236, 356, 1),
(546, 3, 3, 7, 601, 2238, 356, 1),
(547, 2, 2, 7, 81, 2243, 356, 1),
(548, 24, 24, 7, 39, 2254, 356, 1),
(549, 24, 24, 7, 4, 2280, 356, 1),
(550, 24, 24, 7, 11, 2280, 356, 1),
(551, 24, 24, 7, 439, 2280, 356, 1),
(552, 12, 12, 7, 15, 2280, 356, 1),
(553, 12, 12, 7, 9, 2280, 356, 1),
(554, 12, 12, 7, 32, 2280, 356, 1),
(555, 12, 12, 7, 16, 2280, 356, 1),
(556, 48, 48, 7, 18, 2280, 356, 1),
(557, 11, 11, 7, 33, 2280, 356, 1),
(558, 1, 1, 7, 211, 2280, 356, 1),
(559, 1, 1, 7, 523, 2280, 356, 1),
(560, 2, 2, 7, 106, 2280, 356, 1),
(561, 3, 3, 7, 145, 2280, 356, 1),
(562, 1, 1, 7, 444, 2289, 356, 1),
(563, 50, 50, 7, 440, 2289, 356, 1),
(564, 1, 1, 7, 211, 2289, 356, 1),
(565, 48, 48, 7, 8, 2289, 356, 1),
(566, 3, 3, 7, 17, 2291, 356, 1),
(567, 24, 24, 7, 39, 2294, 356, 1),
(568, 12, 12, 7, 37, 2294, 356, 1),
(569, 3, 3, 7, 145, 2294, 356, 1),
(570, 1, 1, 7, 91, 2299, 356, 1),
(571, 24, 24, 7, 44, 2300, 356, 1),
(572, 12, 12, 7, 32, 2301, 356, 1),
(573, 24, 24, 7, 36, 2302, 356, 1),
(574, 12, 12, 7, 653, 2304, 356, 1),
(575, 12, 12, 7, 654, 2304, 356, 1),
(576, 12, 12, 7, 683, 2304, 356, 1),
(577, 3, 3, 7, 114, 2304, 356, 1),
(578, 5, 5, 7, 736, 2316, 356, 1),
(579, 24, 24, 7, 32, 2359, 356, 1),
(580, 24, 24, 7, 35, 2359, 356, 1),
(581, 24, 24, 7, 36, 2359, 356, 1),
(582, 24, 24, 7, 39, 2359, 356, 1),
(583, 24, 24, 7, 15, 2359, 356, 1),
(584, 24, 24, 7, 4, 2359, 356, 1),
(585, 24, 24, 7, 8, 2359, 356, 1),
(586, 24, 24, 7, 9, 2359, 356, 1),
(587, 50, 50, 7, 18, 2359, 356, 1),
(588, 24, 24, 7, 28, 2360, 356, 1),
(589, 24, 24, 7, 12, 2360, 356, 1),
(590, 24, 24, 7, 11, 2360, 356, 1),
(591, 24, 24, 7, 8, 2360, 356, 1),
(592, 48, 48, 7, 4, 2360, 356, 1),
(593, 12, 12, 7, 649, 2360, 356, 1),
(594, 12, 12, 7, 35, 2360, 356, 1),
(595, 12, 12, 7, 32, 2360, 356, 1),
(596, 16, 16, 7, 658, 2360, 356, 1),
(597, 6, 6, 7, 657, 2360, 356, 1),
(598, 12, 12, 7, 17, 2360, 356, 1),
(599, 24, 24, 7, 19, 2360, 356, 1),
(600, 24, 24, 7, 18, 2360, 356, 1),
(601, 12, 12, 7, 515, 2360, 356, 1),
(602, 1, 1, 7, 708, 2360, 356, 1),
(603, 3, 3, 7, 706, 2360, 356, 1),
(604, 3, 3, 7, 418, 2360, 356, 1),
(605, 6, 6, 7, 655, 2360, 356, 1),
(606, 1, 1, 7, 158, 2360, 356, 1),
(607, 1, 1, 7, 791, 2360, 356, 1),
(608, 8, 8, 7, 499, 2360, 356, 1),
(609, 1, 1, 7, 451, 2360, 356, 1),
(610, 3, 3, 7, 145, 2360, 356, 1),
(611, 5, 5, 7, 165, 2360, 356, 1),
(612, 1, 1, 7, 523, 2360, 356, 1),
(613, 25, 25, 7, 440, 2360, 356, 1),
(614, 6, 6, 7, 653, 2364, 356, 1),
(615, 48, 48, 7, 18, 2375, 356, 1),
(616, 8, 8, 7, 708, 2406, 356, 1),
(617, 24, 24, 7, 4, 2413, 356, 1),
(618, 24, 24, 7, 8, 2413, 356, 1),
(619, 24, 24, 7, 11, 2413, 356, 1),
(620, 20, 20, 7, 439, 2413, 356, 1),
(621, 24, 24, 7, 9, 2413, 356, 1),
(622, 24, 24, 7, 15, 2413, 356, 1),
(623, 36, 36, 7, 32, 2413, 356, 1),
(624, 12, 12, 7, 19, 2413, 356, 1),
(625, 48, 48, 7, 18, 2413, 356, 1),
(626, 24, 24, 7, 28, 2413, 356, 1),
(627, 3, 3, 7, 466, 2422, 356, 1),
(628, 2, 2, 7, 765, 2427, 356, 1),
(629, 4, 4, 7, 708, 2469, 356, 1),
(630, 15, 15, 7, 440, 2470, 356, 1),
(631, 5, 5, 7, 649, 2471, 356, 1),
(632, 24, 24, 7, 8, 2484, 356, 1),
(633, 12, 12, 7, 17, 2490, 356, 1),
(634, 60, 60, 7, 18, 2490, 356, 1),
(635, 30, 30, 7, 19, 2493, 356, 1),
(636, 10, 10, 7, 469, 2493, 356, 1),
(637, 5, 5, 7, 468, 2493, 356, 1),
(638, 24, 24, 7, 39, 2493, 356, 1),
(639, 24, 24, 7, 16, 2493, 356, 1),
(640, 2, 2, 7, 601, 2493, 356, 1),
(641, 2, 2, 7, 625, 2493, 356, 1),
(642, 1, 1, 7, 139, 2493, 356, 1),
(643, 2, 2, 7, 107, 2493, 356, 1),
(644, 48, 48, 7, 32, 2493, 356, 1),
(645, 48, 48, 7, 35, 2493, 356, 1),
(646, 24, 24, 7, 28, 2493, 356, 1),
(647, 24, 24, 7, 4, 2493, 356, 1),
(648, 24, 24, 7, 20, 2493, 356, 1),
(649, 1, 1, 7, 865, 2493, 356, 1),
(650, 1, 1, 7, 755, 2493, 356, 1),
(651, 1, 1, 7, 451, 2493, 356, 1),
(652, 1, 1, 7, 82, 2497, 356, 1),
(653, 6, 6, 7, 708, 2501, 356, 1),
(654, 12, 12, 7, 8, 2533, 356, 1),
(655, 11, 11, 7, 649, 2539, 356, 1),
(656, 1, 1, 7, 95, 2542, 356, 1),
(657, 2, 2, 7, 113, 2550, 356, 1),
(658, 24, 24, 7, 4, 2550, 356, 1),
(659, 24, 24, 7, 15, 2550, 356, 1),
(660, 24, 24, 7, 28, 2550, 356, 1),
(661, 24, 24, 7, 11, 2550, 356, 1),
(662, 24, 24, 7, 9, 2550, 356, 1),
(663, 24, 24, 7, 32, 2550, 356, 1),
(664, 24, 24, 7, 39, 2550, 356, 1),
(665, 24, 24, 7, 8, 2559, 356, 1),
(666, 24, 24, 7, 12, 2559, 356, 1),
(667, 36, 36, 7, 18, 2559, 356, 1),
(668, 5, 5, 7, 708, 2564, 356, 1),
(669, 2, 2, 7, 446, 2569, 356, 1),
(670, 4, 4, 7, 44, 2571, 356, 1),
(671, 24, 24, 7, 4, 2598, 356, 1),
(672, 24, 24, 7, 8, 2598, 356, 1),
(673, 2, 2, 7, 659, 2618, 356, 1),
(674, 4, 4, 7, 165, 2618, 356, 1),
(675, 5, 5, 7, 147, 2618, 356, 1),
(676, 6, 6, 7, 19, 2618, 356, 1),
(677, 3, 3, 7, 683, 2633, 356, 1),
(678, 12, 12, 7, 11, 2633, 356, 1),
(679, 6, 6, 7, 20, 2633, 356, 1),
(680, 24, 24, 7, 12, 2637, 356, 1),
(681, 48, 48, 7, 8, 2637, 356, 1),
(682, 24, 24, 7, 9, 2637, 356, 1),
(683, 36, 36, 7, 15, 2637, 356, 1),
(684, 24, 24, 7, 4, 2637, 356, 1),
(685, 24, 24, 7, 32, 2637, 356, 1),
(686, 60, 60, 7, 18, 2637, 356, 1),
(687, 10, 10, 7, 659, 2637, 356, 1),
(688, 5, 5, 7, 656, 2637, 356, 1),
(689, 12, 12, 7, 658, 2637, 356, 1),
(690, 2, 2, 7, 444, 2637, 356, 1),
(691, 12, 12, 7, 657, 2637, 356, 1),
(692, 24, 24, 7, 39, 2637, 356, 1),
(693, 1, 1, 7, 868, 2637, 356, 1),
(694, 3, 3, 7, 708, 2637, 356, 1),
(695, 2, 2, 7, 83, 2637, 356, 1),
(696, 1, 1, 7, 91, 2637, 356, 1),
(697, 2, 2, 7, 410, 2637, 356, 1),
(698, 2, 2, 7, 101, 2637, 356, 1),
(699, 3, 3, 7, 418, 2637, 356, 1),
(700, 3, 3, 7, 706, 2637, 356, 1),
(701, 24, 24, 7, 19, 2639, 356, 1),
(702, 9, 9, 7, 868, 2642, 356, 1),
(703, 27, 27, 7, 708, 2644, 356, 1),
(704, 10, 10, 7, 499, 2650, 356, 1),
(705, 10, 10, 7, 503, 2650, 356, 1),
(706, 10, 10, 7, 502, 2650, 356, 1),
(707, 10, 10, 7, 500, 2650, 356, 1),
(708, 10, 10, 7, 501, 2650, 356, 1),
(709, 24, 24, 7, 9, 2668, 356, 1),
(710, 24, 24, 7, 8, 2668, 356, 1),
(711, 24, 24, 7, 32, 2668, 356, 1),
(712, 48, 48, 7, 18, 2668, 356, 1),
(713, 6, 6, 7, 19, 2668, 356, 1),
(714, 24, 24, 7, 44, 2671, 356, 1),
(715, 20, 20, 7, 15, 2671, 356, 1),
(716, 12, 12, 7, 649, 2694, 356, 1),
(717, 1, 1, 7, 106, 2695, 356, 1),
(718, 1, 1, 7, 98, 2696, 356, 1),
(719, 24, 24, 7, 15, 2703, 356, 1),
(720, 24, 24, 7, 32, 2703, 356, 1),
(721, 48, 48, 7, 4, 2703, 356, 1),
(722, 1, 1, 7, 89, 2711, 356, 1),
(723, 24, 24, 7, 8, 2723, 356, 1),
(724, 24, 24, 7, 16, 2723, 356, 1),
(725, 12, 12, 7, 515, 2723, 356, 1),
(726, 12, 12, 7, 35, 2724, 356, 1),
(727, 24, 24, 7, 18, 2747, 356, 1),
(728, 12, 12, 7, 19, 2747, 356, 1),
(729, 24, 24, 7, 440, 2747, 356, 1),
(730, 2, 2, 7, 556, 2750, 356, 1),
(731, 48, 48, 7, 9, 2771, 356, 1),
(732, 24, 24, 7, 36, 2780, 356, 1),
(733, 104, 104, 7, 548, 2809, 356, 1),
(734, 93, 93, 7, 116, 2809, 356, 1),
(735, 47, 47, 7, 883, 2809, 356, 1),
(736, 2, 2, 7, 124, 2809, 356, 1),
(737, 42, 42, 7, 139, 2809, 356, 1),
(738, 6, 6, 7, 140, 2809, 356, 1),
(739, 11, 11, 7, 81, 2809, 356, 1),
(740, 9, 9, 7, 446, 2809, 356, 1),
(741, 13, 13, 7, 90, 2809, 356, 1),
(742, 8, 8, 7, 89, 2809, 356, 1),
(743, 8, 8, 7, 92, 2809, 356, 1),
(744, 20, 20, 7, 561, 2809, 356, 1),
(745, 1, 1, 7, 564, 2809, 356, 1),
(746, 1, 1, 7, 118, 2809, 356, 1),
(747, 2, 2, 7, 884, 2811, 356, 1),
(748, 2, 2, 7, 81, 2812, 356, 1),
(749, 36, 36, 7, 35, 2828, 356, 1),
(750, 48, 48, 7, 39, 2828, 356, 1),
(751, 10, 10, 7, 468, 2828, 356, 1),
(752, 10, 10, 7, 469, 2828, 356, 1),
(753, 36, 36, 7, 10, 2828, 356, 1),
(754, 10, 10, 7, 868, 2828, 356, 1),
(755, 40, 40, 7, 708, 2828, 356, 1),
(756, 120, 120, 7, 18, 2828, 356, 1),
(757, 24, 24, 7, 4, 2828, 356, 1),
(758, 12, 12, 7, 657, 2828, 356, 1),
(759, 12, 12, 7, 658, 2828, 356, 1),
(760, 12, 12, 7, 659, 2828, 356, 1),
(761, 12, 12, 7, 484, 2828, 356, 1),
(762, 12, 12, 7, 6, 2828, 356, 1),
(763, 12, 12, 7, 36, 2828, 356, 1),
(764, 16, 16, 7, 28, 2828, 356, 1),
(765, 12, 12, 7, 531, 2828, 356, 1),
(766, 16, 16, 7, 17, 2834, 356, 1),
(767, 10, 10, 7, 20, 2840, 356, 1),
(768, 1, 1, 7, 84, 2864, 356, 1),
(769, 1, 1, 7, 444, 2864, 356, 1),
(770, 1, 1, 7, 90, 2866, 356, 1),
(771, 24, 24, 7, 10, 2876, 356, 1),
(772, 24, 24, 7, 4, 2894, 356, 1),
(773, 24, 24, 7, 8, 2894, 356, 1),
(774, 24, 24, 7, 15, 2894, 356, 1),
(775, 36, 36, 7, 32, 2894, 356, 1),
(776, 36, 36, 7, 36, 2894, 356, 1),
(777, 24, 24, 7, 9, 2894, 356, 1),
(778, 36, 36, 7, 6, 2894, 356, 1),
(779, 36, 36, 7, 531, 2894, 356, 1),
(780, 36, 36, 7, 10, 2894, 356, 1),
(781, 36, 36, 7, 484, 2894, 356, 1),
(782, 12, 12, 7, 515, 2894, 356, 1),
(783, 3, 3, 7, 114, 2894, 356, 1),
(784, 3, 3, 7, 113, 2894, 356, 1),
(785, 48, 48, 7, 439, 2894, 356, 1),
(786, 24, 24, 7, 28, 2894, 356, 1),
(787, 24, 24, 7, 12, 2894, 356, 1),
(788, 24, 24, 7, 20, 2894, 356, 1),
(789, 24, 24, 7, 11, 2894, 356, 1),
(790, 60, 60, 7, 18, 2894, 356, 1),
(791, 4, 4, 7, 127, 2896, 356, 1),
(792, 2, 2, 7, 97, 2899, 356, 1),
(793, 12, 12, 7, 649, 2899, 356, 1),
(794, 24, 24, 7, 15, 2904, 356, 1),
(795, 24, 24, 7, 439, 2904, 356, 1),
(796, 12, 12, 7, 12, 2904, 356, 1),
(797, 24, 24, 7, 8, 2904, 356, 1),
(798, 24, 24, 7, 28, 2904, 356, 1),
(799, 12, 12, 7, 32, 2904, 356, 1),
(800, 12, 12, 7, 31, 2904, 356, 1),
(801, 12, 12, 7, 36, 2904, 356, 1),
(802, 12, 12, 7, 407, 2904, 356, 1),
(803, 12, 12, 7, 39, 2904, 356, 1),
(804, 6, 6, 7, 116, 2917, 356, 1),
(805, 3, 3, 7, 706, 2945, 356, 1),
(806, 3, 3, 7, 418, 2945, 356, 1),
(807, 20, 20, 7, 708, 2945, 356, 1),
(808, 6, 6, 7, 601, 2951, 356, 1),
(809, 12, 12, 7, 895, 2988, 356, 1),
(810, 24, 24, 7, 896, 2990, 356, 1),
(811, 24, 24, 7, 897, 2992, 356, 1),
(812, 24, 24, 7, 898, 2994, 356, 1),
(813, 24, 24, 7, 899, 2996, 356, 1),
(814, 24, 24, 7, 900, 2998, 356, 1),
(815, 24, 24, 7, 901, 3000, 356, 1),
(816, 24, 24, 7, 902, 3002, 356, 1),
(817, 24, 24, 7, 903, 3004, 356, 1),
(818, 24, 24, 7, 904, 3006, 356, 1),
(819, 24, 24, 7, 905, 3008, 356, 1),
(820, 24, 24, 7, 907, 3010, 356, 1),
(821, 24, 24, 7, 909, 3012, 356, 1),
(822, 24, 24, 7, 910, 3014, 356, 1),
(823, 24, 24, 7, 911, 3016, 356, 1),
(824, 24, 24, 7, 911, 3018, 356, 1),
(825, 12, 12, 7, 912, 3020, 356, 1),
(826, 12, 12, 7, 914, 3024, 356, 1),
(827, 24, 24, 7, 915, 3026, 356, 1),
(828, 2, 2, 7, 916, 3029, 356, 1),
(829, 24, 24, 7, 917, 3032, 356, 1),
(830, 24, 24, 7, 918, 3033, 356, 1),
(831, 24, 24, 7, 919, 3036, 356, 1),
(832, 24, 24, 7, 920, 3037, 356, 1),
(833, 24, 24, 7, 921, 3042, 356, 1),
(834, 24, 24, 7, 922, 3043, 356, 1),
(835, 24, 24, 7, 924, 3044, 356, 1),
(836, 24, 24, 7, 923, 3045, 356, 1),
(837, 24, 24, 7, 925, 3054, 356, 1),
(838, 24, 24, 7, 928, 3055, 356, 1),
(839, 24, 24, 7, 930, 3056, 356, 1),
(840, 24, 24, 7, 933, 3057, 356, 1),
(841, 24, 24, 7, 932, 3058, 356, 1),
(842, 24, 24, 7, 931, 3059, 356, 1),
(843, 24, 24, 7, 387, 3077, 356, 1),
(844, 3, 3, 7, 904, 3077, 356, 1),
(845, 14, 14, 7, 896, 3077, 356, 1),
(846, 14, 14, 7, 905, 3077, 356, 1),
(847, 23, 23, 7, 897, 3077, 356, 1),
(848, 30, 30, 7, 901, 3077, 356, 1),
(849, 2, 2, 7, 919, 3077, 356, 1),
(850, 11, 11, 7, 921, 3077, 356, 1),
(851, 24, 24, 7, 932, 3077, 356, 1),
(852, 2, 2, 7, 29, 3077, 356, 1),
(853, 35, 35, 7, 909, 3077, 356, 1),
(854, 18, 18, 7, 898, 3077, 356, 1),
(855, 11, 11, 7, 900, 3077, 356, 1),
(856, 12, 12, 7, 6, 3082, 356, 1),
(857, 72, 72, 7, 909, 3082, 356, 1),
(858, 12, 12, 7, 932, 3082, 356, 1),
(859, 12, 12, 7, 921, 3082, 356, 1),
(860, 12, 12, 7, 928, 3082, 356, 1),
(861, 12, 12, 7, 903, 3082, 356, 1),
(862, 12, 12, 7, 898, 3084, 356, 1),
(863, 12, 12, 7, 900, 3084, 356, 1),
(864, 36, 36, 7, 902, 3084, 356, 1),
(865, 12, 12, 7, 919, 3084, 356, 1),
(866, 12, 12, 7, 939, 3086, 356, 1),
(867, 12, 12, 7, 940, 3088, 356, 1),
(868, 2, 2, 7, 90, 3101, 356, 1),
(869, 12, 12, 7, 920, 3107, 356, 1),
(870, 20, 20, 7, 903, 3109, 356, 1),
(871, 24, 24, 7, 896, 3118, 356, 1),
(872, 24, 24, 7, 899, 3119, 356, 1),
(873, 48, 48, 7, 909, 3123, 356, 1),
(874, 21, 21, 7, 919, 3123, 356, 1),
(875, 24, 24, 7, 921, 3123, 356, 1),
(876, 24, 24, 7, 897, 3123, 356, 1),
(877, 24, 24, 7, 896, 3123, 356, 1),
(878, 20, 20, 7, 903, 3123, 356, 1),
(879, 12, 12, 7, 904, 3123, 356, 1),
(880, 2, 2, 7, 110, 3123, 356, 1),
(881, 2, 2, 7, 481, 3123, 356, 1),
(882, 1, 1, 7, 707, 3123, 356, 1),
(883, 12, 12, 7, 907, 3123, 356, 1),
(884, 12, 12, 7, 656, 3123, 356, 1),
(885, 6, 6, 7, 706, 3123, 356, 1),
(886, 3, 3, 7, 946, 3125, 356, 1),
(887, 9, 9, 7, 499, 3129, 356, 1),
(888, 1, 1, 7, 865, 3129, 356, 1),
(889, 30, 30, 7, 708, 3129, 356, 1),
(890, 12, 12, 7, 898, 3158, 356, 1),
(891, 12, 12, 7, 909, 3158, 356, 1),
(892, 12, 12, 7, 909, 3163, 356, 1),
(893, 3, 3, 7, 140, 3207, 356, 1),
(894, 3, 3, 7, 139, 3210, 356, 1),
(895, 24, 24, 7, 896, 3226, 356, 1),
(896, 24, 24, 7, 905, 3226, 356, 1),
(897, 24, 24, 7, 903, 3226, 356, 1),
(898, 12, 12, 7, 904, 3226, 356, 1),
(899, 12, 12, 7, 901, 3226, 356, 1),
(900, 96, 96, 7, 909, 3226, 356, 1),
(901, 24, 24, 7, 899, 3226, 356, 1),
(902, 24, 24, 7, 897, 3226, 356, 1),
(903, 18, 18, 7, 910, 3226, 356, 1),
(904, 2, 2, 7, 83, 3226, 356, 1),
(905, 9, 9, 7, 920, 3234, 356, 1),
(906, 24, 24, 7, 909, 3234, 356, 1),
(907, 4, 4, 7, 17, 3234, 356, 1),
(908, 12, 12, 7, 898, 3234, 356, 1),
(909, 12, 12, 7, 6, 3234, 356, 1),
(910, 12, 12, 7, 387, 3234, 356, 1),
(911, 36, 36, 7, 928, 3244, 356, 1),
(912, 24, 24, 7, 920, 3244, 356, 1),
(913, 12, 12, 7, 919, 3244, 356, 1),
(914, 24, 24, 7, 28, 3244, 356, 1),
(915, 12, 12, 7, 921, 3244, 356, 1),
(916, 20, 20, 7, 17, 3246, 356, 1),
(917, 24, 24, 7, 903, 3250, 356, 1),
(918, 12, 12, 7, 917, 3252, 356, 1),
(919, 5, 5, 7, 29, 3275, 356, 1),
(920, 12, 12, 7, 898, 3292, 356, 1),
(921, 12, 12, 7, 6, 3292, 356, 1),
(922, 12, 12, 7, 387, 3292, 356, 1),
(923, 5, 5, 7, 928, 3292, 356, 1),
(924, 6, 6, 7, 919, 3292, 356, 1),
(925, 2, 2, 7, 921, 3292, 356, 1),
(926, 6, 6, 7, 28, 3292, 356, 1),
(927, 12, 12, 7, 909, 3292, 356, 1),
(928, 24, 24, 7, 897, 3296, 356, 1),
(929, 24, 24, 7, 896, 3296, 356, 1),
(930, 24, 24, 7, 899, 3296, 356, 1),
(931, 24, 24, 7, 905, 3296, 356, 1),
(932, 60, 60, 7, 909, 3296, 356, 1),
(933, 36, 36, 7, 921, 3296, 356, 1),
(934, 10, 10, 7, 469, 3296, 356, 1),
(935, 6, 6, 7, 468, 3296, 356, 1),
(936, 1, 1, 7, 406, 3308, 356, 1),
(937, 1, 1, 7, 444, 3312, 356, 1),
(938, 12, 12, 7, 910, 3313, 356, 1),
(939, 1, 1, 7, 82, 3314, 356, 1),
(940, 10, 10, 7, 868, 3314, 356, 1),
(941, 20, 20, 7, 708, 3314, 356, 1),
(942, 12, 12, 7, 387, 3336, 356, 1),
(943, 12, 12, 7, 910, 3351, 356, 1),
(944, 24, 24, 7, 896, 3390, 356, 1),
(945, 24, 24, 7, 928, 3392, 356, 1),
(946, 48, 48, 7, 896, 3409, 356, 1),
(947, 24, 24, 7, 899, 3409, 356, 1),
(948, 24, 24, 7, 905, 3409, 356, 1),
(949, 40, 40, 7, 903, 3409, 356, 1),
(950, 24, 24, 7, 901, 3409, 356, 1),
(951, 48, 48, 7, 897, 3409, 356, 1),
(952, 12, 12, 7, 859, 3409, 356, 1),
(953, 12, 12, 7, 17, 3409, 356, 1),
(954, 12, 12, 7, 917, 3409, 356, 1),
(955, 12, 12, 7, 657, 3409, 356, 1),
(956, 24, 24, 7, 932, 3409, 356, 1),
(957, 24, 24, 7, 931, 3409, 356, 1),
(958, 12, 12, 7, 912, 3411, 356, 1),
(959, 24, 24, 7, 909, 3427, 356, 1),
(960, 12, 12, 7, 910, 3431, 356, 1),
(961, 1, 1, 7, 566, 3443, 356, 1),
(962, 36, 36, 7, 928, 3452, 356, 1),
(963, 12, 12, 7, 920, 3452, 356, 1),
(964, 36, 36, 7, 919, 3452, 356, 1),
(965, 36, 36, 7, 921, 3452, 356, 1),
(966, 60, 60, 7, 909, 3452, 356, 1),
(967, 6, 6, 7, 140, 3458, 356, 1),
(968, 6, 6, 7, 139, 3458, 356, 1),
(969, 2, 2, 7, 106, 3458, 356, 1),
(970, 12, 12, 7, 6, 3469, 356, 1),
(971, 12, 12, 7, 909, 3469, 356, 1),
(972, 1, 1, 7, 444, 3475, 356, 1),
(973, 24, 24, 7, 910, 3498, 356, 1),
(974, 1, 1, 7, 118, 3528, 356, 1),
(975, 12, 12, 7, 904, 3532, 356, 1),
(976, 1, 1, 7, 140, 3547, 356, 1),
(977, 2, 2, 7, 548, 3548, 356, 1),
(978, 4, 4, 7, 933, 3555, 356, 1),
(979, 24, 24, 7, 897, 3570, 356, 1),
(980, 24, 24, 7, 899, 3570, 356, 1),
(981, 24, 24, 7, 905, 3570, 356, 1),
(982, 12, 12, 7, 917, 3570, 356, 1),
(983, 12, 12, 7, 904, 3570, 356, 1),
(984, 12, 12, 7, 911, 3570, 356, 1),
(985, 48, 48, 7, 896, 3570, 356, 1),
(986, 60, 60, 7, 909, 3571, 356, 1),
(987, 22, 22, 7, 932, 3581, 356, 1),
(988, 2, 2, 7, 444, 3581, 356, 1),
(989, 2, 2, 7, 140, 3591, 356, 1),
(990, 2, 2, 7, 373, 3594, 356, 1),
(991, 20, 20, 7, 470, 3610, 356, 1),
(992, 24, 24, 7, 6, 3610, 356, 1),
(993, 24, 24, 7, 901, 3610, 356, 1),
(994, 24, 24, 7, 899, 3610, 356, 1),
(995, 23, 23, 7, 905, 3610, 356, 1),
(996, 12, 12, 7, 920, 3610, 356, 1),
(997, 24, 24, 7, 921, 3610, 356, 1),
(998, 18, 18, 7, 910, 3610, 356, 1),
(999, 1, 1, 7, 639, 3633, 356, 1),
(1000, 1, 1, 7, 451, 3633, 356, 1),
(1001, 1, 1, 7, 667, 3633, 356, 1),
(1002, 1, 1, 7, 979, 3633, 356, 1),
(1003, 1, 1, 7, 103, 3633, 356, 1),
(1004, 1, 1, 7, 552, 3633, 356, 1),
(1005, 1, 1, 7, 981, 3633, 356, 1),
(1006, 1, 1, 7, 982, 3633, 356, 1),
(1007, 24, 24, 7, 897, 3643, 356, 1),
(1008, 24, 24, 7, 28, 3643, 356, 1),
(1009, 10, 10, 7, 387, 3643, 356, 1),
(1010, 20, 20, 7, 708, 3647, 356, 1),
(1011, 10, 10, 7, 868, 3647, 356, 1),
(1012, 12, 12, 7, 917, 3648, 356, 1),
(1013, 12, 12, 7, 926, 3648, 356, 1),
(1014, 24, 24, 7, 928, 3654, 356, 1),
(1015, 24, 24, 7, 6, 3657, 356, 1),
(1016, 24, 24, 7, 902, 3657, 356, 1),
(1017, 1, 1, 7, 895, 3659, 356, 1),
(1018, 24, 24, 7, 910, 3663, 356, 1),
(1019, 2, 2, 7, 118, 3686, 356, 1),
(1020, 3, 3, 7, 896, 3701, 356, 1),
(1021, 7, 7, 7, 919, 3701, 356, 1),
(1022, 1, 1, 7, 116, 3701, 356, 1),
(1023, 1, 1, 7, 901, 3701, 356, 1),
(1024, 48, 48, 7, 896, 3713, 356, 1),
(1025, 24, 24, 7, 905, 3713, 356, 1),
(1026, 24, 24, 7, 904, 3713, 356, 1),
(1027, 24, 24, 7, 897, 3713, 356, 1),
(1028, 42, 42, 7, 28, 3713, 356, 1),
(1029, 48, 48, 7, 903, 3713, 356, 1),
(1030, 24, 24, 7, 902, 3713, 356, 1),
(1031, 24, 24, 7, 899, 3713, 356, 1),
(1032, 24, 24, 7, 387, 3713, 356, 1),
(1033, 13, 13, 7, 910, 3713, 356, 1),
(1034, 4, 4, 7, 17, 3713, 356, 1),
(1035, 36, 36, 7, 928, 3713, 356, 1),
(1036, 12, 12, 7, 920, 3713, 356, 1),
(1037, 72, 72, 7, 909, 3713, 356, 1),
(1038, 6, 6, 7, 29, 3731, 356, 1),
(1039, 3, 3, 7, 127, 3739, 356, 1),
(1040, 2, 2, 7, 120, 3739, 356, 1),
(1041, 2, 2, 7, 140, 3739, 356, 1),
(1042, 2, 2, 7, 548, 3739, 356, 1),
(1043, 2, 2, 7, 547, 3739, 356, 1),
(1044, 35, 35, 7, 919, 3739, 356, 1),
(1045, 24, 24, 7, 896, 3739, 356, 1),
(1046, 12, 12, 7, 899, 3739, 356, 1),
(1047, 12, 12, 7, 905, 3739, 356, 1),
(1048, 12, 12, 7, 909, 3739, 356, 1),
(1049, 12, 12, 7, 898, 3739, 356, 1),
(1050, 1, 1, 7, 566, 3739, 356, 1),
(1051, 1, 1, 7, 107, 3739, 356, 1),
(1052, 6, 6, 7, 910, 3739, 356, 1),
(1053, 20, 20, 7, 937, 3747, 356, 1),
(1054, 2, 2, 7, 113, 3764, 356, 1),
(1055, 12, 12, 7, 907, 3767, 356, 1),
(1056, 8, 8, 7, 907, 3768, 356, 1),
(1057, 10, 10, 7, 468, 3771, 356, 1),
(1058, 12, 12, 7, 897, 3799, 356, 1),
(1059, 12, 12, 7, 905, 3799, 356, 1),
(1060, 12, 12, 7, 899, 3799, 356, 1),
(1061, 12, 12, 7, 901, 3799, 356, 1),
(1062, 36, 36, 7, 928, 3799, 356, 1),
(1063, 60, 60, 7, 909, 3799, 356, 1),
(1064, 18, 18, 7, 910, 3799, 356, 1),
(1065, 12, 12, 7, 657, 3799, 356, 1),
(1066, 12, 12, 7, 917, 3799, 356, 1),
(1067, 10, 10, 7, 469, 3799, 356, 1),
(1068, 2, 2, 7, 113, 3800, 356, 1),
(1069, 2, 2, 7, 119, 3819, 356, 1),
(1070, 10, 10, 7, 708, 3824, 356, 1),
(1071, 24, 24, 7, 907, 3849, 356, 1),
(1072, 24, 24, 7, 904, 3849, 356, 1),
(1073, 24, 24, 7, 911, 3849, 356, 1),
(1074, 24, 24, 7, 905, 3849, 356, 1),
(1075, 24, 24, 7, 897, 3849, 356, 1),
(1076, 12, 12, 7, 920, 3849, 356, 1),
(1077, 24, 24, 7, 931, 3849, 356, 1),
(1078, 24, 24, 7, 932, 3849, 356, 1),
(1079, 20, 20, 7, 924, 3849, 356, 1),
(1080, 20, 20, 7, 930, 3849, 356, 1),
(1081, 24, 24, 7, 937, 3849, 356, 1),
(1082, 12, 12, 7, 17, 3849, 356, 1),
(1083, 24, 24, 7, 910, 3849, 356, 1),
(1084, 24, 24, 7, 909, 3849, 356, 1),
(1085, 12, 12, 7, 898, 3849, 356, 1),
(1086, 12, 12, 7, 902, 3849, 356, 1),
(1087, 1, 1, 7, 101, 3872, 356, 1),
(1088, 10, 10, 7, 499, 3874, 356, 1),
(1089, 24, 24, 7, 896, 3879, 356, 1),
(1090, 12, 12, 7, 903, 3879, 356, 1),
(1091, 24, 24, 7, 901, 3879, 356, 1),
(1092, 24, 24, 7, 896, 3881, 356, 1),
(1093, 12, 12, 7, 897, 3881, 356, 1),
(1094, 12, 12, 7, 901, 3881, 356, 1),
(1095, 4, 4, 7, 17, 3881, 356, 1),
(1096, 12, 12, 7, 928, 3881, 356, 1),
(1097, 12, 12, 7, 919, 3881, 356, 1),
(1098, 12, 12, 7, 921, 3881, 356, 1),
(1099, 12, 12, 7, 926, 3881, 356, 1),
(1100, 8, 8, 7, 910, 3881, 356, 1),
(1101, 24, 24, 7, 6, 3882, 356, 1),
(1102, 12, 12, 7, 898, 3882, 356, 1),
(1103, 12, 12, 7, 902, 3882, 356, 1),
(1104, 2, 2, 7, 119, 3919, 356, 1),
(1105, 8, 8, 7, 708, 3936, 356, 1),
(1106, 24, 24, 7, 897, 3941, 356, 1),
(1107, 24, 24, 7, 899, 3941, 356, 1),
(1108, 24, 24, 7, 909, 3944, 356, 1),
(1109, 1, 1, 7, 83, 3951, 356, 1),
(1110, 1, 1, 7, 98, 3951, 356, 1),
(1111, 1, 1, 7, 83, 3963, 356, 1),
(1112, 2, 2, 7, 92, 3963, 356, 1),
(1113, 12, 12, 7, 903, 3970, 356, 1),
(1114, 1, 1, 7, 903, 3986, 356, 1),
(1115, 12, 12, 7, 895, 3986, 356, 1),
(1116, 1, 1, 7, 657, 4006, 356, 1),
(1117, 1, 1, 7, 106, 4006, 356, 1),
(1118, 3, 3, 7, 859, 4006, 356, 1),
(1119, 2, 2, 7, 899, 4006, 356, 1),
(1120, 2, 2, 7, 113, 4015, 356, 1),
(1121, 3, 3, 7, 116, 4015, 356, 1),
(1122, 12, 12, 7, 928, 4015, 356, 1),
(1123, 24, 24, 7, 28, 4015, 356, 1),
(1124, 21, 21, 7, 905, 4015, 356, 1),
(1125, 12, 12, 7, 897, 4015, 356, 1),
(1126, 12, 12, 7, 896, 4015, 356, 1),
(1127, 12, 12, 7, 656, 4015, 356, 1),
(1128, 7, 7, 7, 917, 4015, 356, 1),
(1129, 2, 2, 7, 410, 4015, 356, 1),
(1130, 72, 72, 7, 909, 4017, 356, 1),
(1131, 2, 2, 7, 566, 4022, 356, 1),
(1132, 36, 36, 7, 903, 4024, 356, 1),
(1133, 36, 36, 7, 928, 4024, 356, 1),
(1134, 8, 8, 7, 17, 4024, 356, 1),
(1135, 10, 10, 7, 29, 4038, 356, 1),
(1136, 20, 20, 7, 920, 4049, 356, 1),
(1137, 24, 24, 7, 896, 4062, 356, 1),
(1138, 24, 24, 7, 28, 4062, 356, 1),
(1139, 24, 24, 7, 897, 4062, 356, 1),
(1140, 24, 24, 7, 899, 4062, 356, 1),
(1141, 18, 18, 7, 910, 4062, 356, 1),
(1142, 12, 12, 7, 909, 4062, 356, 1),
(1143, 1, 1, 7, 865, 4069, 356, 1),
(1144, 24, 24, 7, 903, 4084, 356, 1),
(1145, 3, 3, 7, 909, 4084, 356, 1),
(1146, 12, 12, 7, 910, 4087, 356, 1),
(1147, 6, 6, 7, 909, 4090, 356, 1),
(1148, 17, 17, 7, 708, 4101, 356, 1),
(1149, 12, 12, 7, 905, 4102, 356, 1),
(1150, 12, 12, 7, 896, 4102, 356, 1),
(1151, 12, 12, 7, 897, 4102, 356, 1),
(1152, 12, 12, 7, 904, 4102, 356, 1),
(1153, 1, 1, 7, 551, 4102, 356, 1),
(1154, 1, 1, 7, 444, 4102, 356, 1),
(1155, 36, 36, 7, 909, 4106, 356, 1),
(1156, 3, 3, 7, 910, 4113, 356, 1),
(1157, 12, 12, 7, 900, 4113, 356, 1),
(1158, 12, 12, 7, 898, 4113, 356, 1),
(1159, 12, 12, 7, 903, 4113, 356, 1),
(1160, 1, 1, 7, 85, 4117, 356, 1),
(1161, 1, 1, 7, 550, 4118, 356, 1),
(1162, 24, 24, 7, 899, 4131, 356, 1),
(1163, 24, 24, 7, 901, 4131, 356, 1),
(1164, 2, 2, 7, 107, 4137, 356, 1),
(1165, 2, 2, 7, 946, 4138, 356, 1),
(1166, 48, 48, 7, 896, 4153, 356, 1),
(1167, 24, 24, 7, 897, 4160, 356, 1),
(1168, 24, 24, 7, 387, 4160, 356, 1),
(1169, 48, 48, 7, 896, 4186, 356, 1),
(1170, 48, 48, 7, 905, 4186, 356, 1),
(1171, 48, 48, 7, 899, 4186, 356, 1),
(1172, 24, 24, 7, 28, 4186, 356, 1),
(1173, 24, 24, 7, 904, 4186, 356, 1),
(1174, 24, 24, 7, 901, 4186, 356, 1),
(1175, 24, 24, 7, 897, 4186, 356, 1),
(1176, 36, 36, 7, 928, 4186, 356, 1),
(1177, 36, 36, 7, 919, 4186, 356, 1),
(1178, 20, 20, 7, 920, 4186, 356, 1),
(1179, 60, 60, 7, 910, 4186, 356, 1),
(1180, 16, 16, 7, 17, 4186, 356, 1),
(1181, 12, 12, 7, 917, 4186, 356, 1),
(1182, 12, 12, 7, 657, 4186, 356, 1),
(1183, 11, 11, 7, 912, 4186, 356, 1),
(1184, 10, 10, 7, 469, 4186, 356, 1),
(1185, 10, 10, 7, 468, 4186, 356, 1),
(1186, 24, 24, 7, 907, 4186, 356, 1),
(1187, 24, 24, 7, 932, 4186, 356, 1),
(1188, 3, 3, 7, 566, 4186, 356, 1),
(1189, 83, 83, 7, 909, 4188, 356, 1),
(1190, 2, 2, 7, 83, 4195, 356, 1),
(1191, 12, 12, 7, 6, 4195, 356, 1),
(1192, 24, 24, 7, 900, 4195, 356, 1),
(1193, 24, 24, 7, 902, 4195, 356, 1),
(1194, 12, 12, 7, 897, 4195, 356, 1),
(1195, 24, 24, 7, 909, 4195, 356, 1),
(1196, 12, 12, 7, 905, 4195, 356, 1),
(1197, 12, 12, 7, 928, 4195, 356, 1),
(1198, 12, 12, 7, 921, 4195, 356, 1),
(1199, 2, 2, 7, 946, 4226, 356, 1),
(1200, 2, 2, 7, 85, 4226, 356, 1),
(1201, 2, 2, 7, 101, 4226, 356, 1),
(1202, 2, 2, 7, 373, 4226, 356, 1),
(1203, 10, 10, 7, 868, 4239, 356, 1),
(1204, 6, 6, 7, 708, 4239, 356, 1),
(1205, 7, 7, 7, 905, 4244, 356, 1),
(1206, 24, 24, 7, 896, 4244, 356, 1),
(1207, 12, 12, 7, 899, 4244, 356, 1),
(1208, 36, 36, 7, 902, 4244, 356, 1),
(1209, 60, 60, 7, 909, 4244, 356, 1),
(1210, 48, 48, 7, 897, 4246, 356, 1),
(1211, 30, 30, 7, 708, 4246, 356, 1),
(1212, 13, 13, 7, 961, 4246, 356, 1),
(1213, 4, 4, 7, 548, 4249, 356, 1),
(1214, 24, 24, 7, 909, 4262, 356, 1),
(1215, 48, 48, 7, 897, 4291, 356, 1),
(1216, 24, 24, 7, 896, 4291, 356, 1),
(1217, 48, 48, 7, 899, 4291, 356, 1),
(1218, 24, 24, 7, 904, 4291, 356, 1),
(1219, 24, 24, 7, 911, 4291, 356, 1),
(1220, 24, 24, 7, 28, 4291, 356, 1),
(1221, 24, 24, 7, 928, 4291, 356, 1),
(1222, 12, 12, 7, 921, 4291, 356, 1),
(1223, 100, 100, 7, 440, 4291, 356, 1),
(1224, 20, 20, 7, 708, 4291, 356, 1),
(1225, 30, 30, 7, 910, 4293, 356, 1),
(1226, 84, 84, 7, 909, 4293, 356, 1),
(1227, 1, 1, 7, 107, 4296, 356, 1),
(1228, 1, 1, 7, 946, 4296, 356, 1),
(1229, 2, 2, 7, 93, 4296, 356, 1),
(1230, 2, 2, 7, 707, 4296, 356, 1),
(1231, 1, 1, 7, 110, 4296, 356, 1),
(1232, 20, 20, 7, 924, 4297, 356, 1),
(1233, 24, 24, 7, 896, 4306, 356, 1),
(1234, 48, 48, 7, 896, 4315, 356, 1),
(1235, 24, 24, 7, 897, 4315, 356, 1),
(1236, 24, 24, 7, 899, 4315, 356, 1),
(1237, 24, 24, 7, 907, 4315, 356, 1),
(1238, 24, 24, 7, 896, 4342, 356, 1),
(1239, 24, 24, 7, 897, 4342, 356, 1),
(1240, 8, 8, 7, 917, 4342, 356, 1),
(1241, 12, 12, 7, 909, 4342, 356, 1),
(1242, 24, 24, 7, 897, 4374, 356, 1),
(1243, 24, 24, 7, 928, 4388, 356, 1),
(1244, 24, 24, 7, 919, 4388, 356, 1),
(1245, 24, 24, 7, 896, 4388, 356, 1),
(1246, 24, 24, 7, 897, 4388, 356, 1),
(1247, 24, 24, 7, 899, 4388, 356, 1),
(1248, 24, 24, 7, 932, 4388, 356, 1),
(1249, 24, 24, 7, 910, 4388, 356, 1),
(1250, 1, 1, 7, 97, 4397, 356, 1),
(1251, 10, 10, 7, 503, 4412, 356, 1),
(1252, 10, 10, 7, 502, 4412, 356, 1),
(1253, 10, 10, 7, 500, 4414, 356, 1),
(1254, 24, 24, 7, 387, 4424, 356, 1),
(1255, 24, 24, 7, 896, 4426, 356, 1),
(1256, 24, 24, 7, 897, 4426, 356, 1),
(1257, 24, 24, 7, 899, 4426, 356, 1),
(1258, 15, 15, 7, 904, 4426, 356, 1),
(1259, 24, 24, 7, 909, 4427, 356, 1),
(1260, 6, 6, 7, 910, 4427, 356, 1),
(1261, 12, 12, 7, 897, 4468, 356, 1),
(1262, 44, 44, 7, 910, 4470, 356, 1),
(1263, 2, 2, 7, 897, 4485, 356, 1),
(1264, 48, 48, 7, 896, 4500, 356, 1),
(1265, 36, 36, 7, 903, 4500, 356, 1),
(1266, 24, 24, 7, 387, 4500, 356, 1),
(1267, 24, 24, 7, 897, 4500, 356, 1),
(1268, 48, 48, 7, 905, 4500, 356, 1),
(1269, 36, 36, 7, 928, 4500, 356, 1),
(1270, 36, 36, 7, 919, 4500, 356, 1),
(1271, 84, 84, 7, 909, 4500, 356, 1),
(1272, 36, 36, 7, 910, 4500, 356, 1),
(1273, 10, 10, 7, 469, 4500, 356, 1),
(1274, 12, 12, 7, 917, 4500, 356, 1),
(1275, 24, 24, 7, 932, 4500, 356, 1),
(1276, 24, 24, 7, 907, 4500, 356, 1),
(1277, 24, 24, 7, 899, 4500, 356, 1),
(1278, 10, 10, 7, 499, 4500, 356, 1),
(1279, 10, 10, 7, 500, 4500, 356, 1),
(1280, 10, 10, 7, 501, 4500, 356, 1),
(1281, 20, 20, 7, 708, 4500, 356, 1),
(1282, 10, 10, 7, 868, 4500, 356, 1),
(1283, 12, 12, 7, 904, 4522, 356, 1),
(1284, 12, 12, 7, 899, 4522, 356, 1),
(1285, 8, 8, 7, 859, 4522, 356, 1),
(1286, 48, 48, 7, 909, 4522, 356, 1),
(1287, 2, 2, 7, 707, 4527, 356, 1),
(1288, 6, 6, 7, 905, 4528, 356, 1),
(1289, 6, 6, 7, 903, 4528, 356, 1),
(1290, 4, 4, 7, 928, 4528, 356, 1),
(1291, 4, 4, 7, 919, 4528, 356, 1),
(1292, 6, 6, 7, 896, 4528, 356, 1),
(1293, 6, 6, 7, 899, 4528, 356, 1),
(1294, 6, 6, 7, 904, 4528, 356, 1),
(1295, 3, 3, 7, 932, 4528, 356, 1),
(1296, 12, 12, 7, 909, 4528, 356, 1),
(1297, 6, 6, 7, 907, 4528, 356, 1),
(1298, 24, 24, 7, 921, 4531, 356, 1),
(1299, 24, 24, 7, 909, 4540, 356, 1),
(1300, 18, 18, 7, 903, 4544, 356, 1),
(1301, 2, 2, 7, 113, 4548, 356, 1),
(1302, 2, 2, 7, 116, 4548, 356, 1),
(1303, 6, 6, 7, 896, 4573, 356, 1),
(1304, 6, 6, 7, 903, 4573, 356, 1),
(1305, 6, 6, 7, 905, 4573, 356, 1),
(1306, 24, 24, 7, 909, 4573, 356, 1),
(1307, 6, 6, 7, 899, 4573, 356, 1),
(1308, 36, 36, 7, 903, 4574, 356, 1),
(1309, 72, 72, 7, 896, 4574, 356, 1),
(1310, 24, 24, 7, 905, 4574, 356, 1),
(1311, 24, 24, 7, 899, 4574, 356, 1),
(1312, 48, 48, 7, 909, 4574, 356, 1),
(1313, 20, 20, 7, 928, 4574, 356, 1),
(1314, 12, 12, 7, 921, 4574, 356, 1),
(1315, 12, 12, 7, 919, 4574, 356, 1),
(1316, 24, 24, 7, 932, 4574, 356, 1),
(1317, 12, 12, 7, 656, 4574, 356, 1),
(1318, 18, 18, 7, 910, 4574, 356, 1),
(1319, 1, 1, 7, 410, 4574, 356, 1),
(1320, 2, 2, 7, 116, 4574, 356, 1),
(1321, 1, 1, 7, 444, 4574, 356, 1),
(1322, 2, 2, 7, 83, 4584, 356, 1),
(1323, 1, 1, 7, 98, 4596, 356, 1),
(1324, 6, 6, 7, 910, 4613, 356, 1),
(1325, 24, 24, 7, 903, 4623, 356, 1),
(1326, 1, 1, 7, 88, 4640, 356, 1),
(1327, 9, 9, 7, 925, 4661, 356, 1),
(1328, 3, 3, 7, 926, 4661, 356, 1),
(1329, 3, 3, 7, 601, 4670, 356, 1),
(1330, 24, 24, 7, 932, 4678, 356, 1),
(1331, 18, 18, 7, 903, 4678, 356, 1),
(1332, 24, 24, 7, 921, 4678, 356, 1),
(1333, 24, 24, 7, 919, 4678, 356, 1),
(1334, 36, 36, 7, 928, 4678, 356, 1),
(1335, 24, 24, 7, 937, 4678, 356, 1),
(1336, 48, 48, 7, 909, 4678, 356, 1),
(1337, 24, 24, 7, 910, 4678, 356, 1),
(1338, 12, 12, 7, 904, 4679, 356, 1),
(1339, 12, 12, 7, 911, 4679, 356, 1),
(1340, 12, 12, 7, 899, 4679, 356, 1),
(1341, 12, 12, 7, 905, 4679, 356, 1),
(1342, 12, 12, 7, 931, 4679, 356, 1),
(1343, 6, 6, 7, 469, 4679, 356, 1),
(1344, 6, 6, 7, 468, 4679, 356, 1),
(1345, 12, 12, 7, 928, 4681, 356, 1),
(1346, 12, 12, 7, 919, 4681, 356, 1),
(1347, 12, 12, 7, 921, 4681, 356, 1),
(1348, 12, 12, 7, 932, 4681, 356, 1),
(1349, 12, 12, 7, 896, 4681, 356, 1),
(1350, 12, 12, 7, 899, 4681, 356, 1),
(1351, 12, 12, 7, 907, 4681, 356, 1),
(1352, 12, 12, 7, 904, 4681, 356, 1),
(1353, 36, 36, 7, 909, 4681, 356, 1),
(1354, 12, 12, 7, 910, 4681, 356, 1),
(1355, 12, 12, 7, 905, 4681, 356, 1),
(1356, 2, 2, 7, 114, 4682, 356, 1),
(1357, 2, 2, 7, 124, 4682, 356, 1),
(1358, 2, 2, 7, 975, 4682, 356, 1),
(1359, 1, 1, 7, 119, 4682, 356, 1),
(1360, 1, 1, 7, 973, 4682, 356, 1),
(1361, 8, 8, 7, 917, 4682, 356, 1),
(1362, 48, 48, 7, 42, 4684, 356, 1),
(1363, 24, 24, 7, 909, 4694, 356, 1),
(1364, 12, 12, 7, 895, 4696, 356, 1),
(1365, 39, 39, 7, 896, 4714, 356, 1),
(1366, 24, 24, 7, 899, 4714, 356, 1),
(1367, 24, 24, 7, 895, 4714, 356, 1),
(1368, 10, 10, 7, 408, 4714, 356, 1),
(1369, 8, 8, 7, 17, 4714, 356, 1),
(1370, 24, 24, 7, 909, 4714, 356, 1),
(1371, 24, 24, 7, 910, 4714, 356, 1),
(1372, 24, 24, 7, 932, 4714, 356, 1),
(1373, 20, 20, 7, 930, 4714, 356, 1),
(1374, 1, 1, 7, 551, 4714, 356, 1),
(1375, 1, 1, 7, 410, 4714, 356, 1),
(1376, 48, 48, 7, 897, 4714, 356, 1),
(1377, 36, 36, 7, 903, 4714, 356, 1),
(1378, 48, 48, 7, 901, 4714, 356, 1),
(1379, 24, 24, 7, 923, 4714, 356, 1),
(1380, 20, 20, 7, 924, 4714, 356, 1),
(1381, 2, 2, 7, 946, 4719, 356, 1),
(1382, 20, 20, 7, 926, 4720, 356, 1),
(1383, 12, 12, 7, 910, 4730, 356, 1),
(1384, 24, 24, 7, 909, 4742, 356, 1),
(1385, 2, 2, 7, 85, 4745, 356, 1),
(1386, 24, 24, 7, 896, 4745, 356, 1),
(1387, 24, 24, 7, 387, 4745, 356, 1),
(1388, 24, 24, 7, 903, 4757, 356, 1),
(1389, 48, 48, 7, 896, 4759, 356, 1),
(1390, 24, 24, 7, 909, 4764, 356, 1),
(1391, 12, 12, 7, 910, 4777, 356, 1),
(1392, 24, 24, 7, 897, 4777, 356, 1),
(1393, 12, 12, 7, 909, 4778, 356, 1),
(1394, 12, 12, 7, 909, 4780, 356, 1),
(1395, 12, 12, 7, 899, 4780, 356, 1),
(1396, 12, 12, 7, 901, 4780, 356, 1),
(1397, 4, 4, 7, 17, 4788, 356, 1),
(1398, 6, 6, 7, 910, 4804, 356, 1),
(1399, 72, 72, 7, 896, 4825, 356, 1),
(1400, 48, 48, 7, 897, 4825, 356, 1),
(1401, 24, 24, 7, 899, 4825, 356, 1),
(1402, 24, 24, 7, 903, 4825, 356, 1),
(1403, 12, 12, 7, 901, 4825, 356, 1),
(1404, 48, 48, 7, 905, 4825, 356, 1),
(1405, 24, 24, 7, 931, 4825, 356, 1),
(1406, 24, 24, 7, 919, 4825, 356, 1),
(1407, 36, 36, 7, 921, 4825, 356, 1),
(1408, 48, 48, 7, 909, 4825, 356, 1),
(1409, 24, 24, 7, 910, 4825, 356, 1),
(1410, 8, 8, 7, 469, 4825, 356, 1),
(1411, 12, 12, 7, 917, 4825, 356, 1),
(1412, 12, 12, 7, 657, 4825, 356, 1),
(1413, 12, 12, 7, 912, 4825, 356, 1),
(1414, 1, 1, 7, 83, 4825, 356, 1),
(1415, 1, 1, 7, 451, 4825, 356, 1),
(1416, 8, 8, 7, 29, 4825, 356, 1),
(1417, 24, 24, 7, 907, 4825, 356, 1),
(1418, 10, 10, 7, 868, 4825, 356, 1),
(1419, 30, 30, 7, 708, 4825, 356, 1),
(1420, 12, 12, 7, 896, 4826, 356, 1),
(1421, 6, 6, 7, 903, 4826, 356, 1),
(1422, 6, 6, 7, 919, 4826, 356, 1),
(1423, 12, 12, 7, 905, 4826, 356, 1),
(1424, 12, 12, 7, 907, 4826, 356, 1),
(1425, 6, 6, 7, 910, 4826, 356, 1),
(1426, 48, 48, 7, 909, 4826, 356, 1),
(1427, 6, 6, 7, 937, 4828, 356, 1),
(1428, 6, 6, 7, 469, 4828, 356, 1),
(1429, 6, 6, 7, 468, 4828, 356, 1),
(1430, 6, 6, 7, 408, 4828, 356, 1),
(1431, 8, 8, 7, 17, 4828, 356, 1),
(1432, 1, 1, 7, 97, 4844, 356, 1),
(1433, 1, 1, 7, 97, 4849, 356, 1),
(1434, 2, 2, 7, 601, 4849, 356, 1),
(1435, 6, 6, 7, 925, 4850, 356, 1),
(1436, 24, 24, 7, 910, 4864, 356, 1),
(1437, 10, 10, 7, 469, 4865, 356, 1),
(1438, 2, 2, 7, 466, 4867, 356, 1),
(1439, 1, 1, 7, 458, 4867, 356, 1),
(1440, 24, 24, 7, 897, 4877, 356, 1),
(1441, 12, 12, 7, 903, 4877, 356, 1),
(1442, 12, 12, 7, 17, 4877, 356, 1),
(1443, 12, 12, 7, 910, 4877, 356, 1),
(1444, 12, 12, 7, 909, 4877, 356, 1),
(1445, 24, 24, 7, 899, 4885, 356, 1),
(1446, 6, 6, 7, 910, 4893, 356, 1),
(1447, 8, 8, 7, 932, 4893, 356, 1),
(1448, 24, 24, 7, 909, 4916, 356, 1),
(1449, 2, 2, 7, 946, 4928, 356, 1),
(1450, 36, 36, 7, 909, 4929, 356, 1),
(1451, 48, 48, 7, 909, 4933, 356, 1),
(1452, 24, 24, 7, 896, 4933, 356, 1),
(1453, 12, 12, 7, 919, 4933, 356, 1),
(1454, 24, 24, 7, 899, 4948, 356, 1),
(1455, 60, 60, 7, 909, 4948, 356, 1),
(1456, 12, 12, 7, 904, 4948, 356, 1),
(1457, 12, 12, 7, 17, 4948, 356, 1),
(1458, 24, 24, 7, 896, 4948, 356, 1),
(1459, 12, 12, 7, 897, 4948, 356, 1),
(1460, 6, 6, 7, 903, 4948, 356, 1),
(1461, 9, 9, 7, 925, 4948, 356, 1),
(1462, 20, 20, 7, 920, 4948, 356, 1),
(1463, 36, 36, 7, 919, 4948, 356, 1),
(1464, 24, 24, 7, 897, 5024, 356, 1),
(1465, 24, 24, 7, 899, 5026, 356, 1),
(1466, 24, 24, 7, 896, 5026, 356, 1),
(1467, 24, 24, 7, 901, 5026, 356, 1),
(1468, 18, 18, 7, 910, 5026, 356, 1),
(1469, 12, 12, 7, 917, 5026, 356, 1),
(1470, 12, 12, 7, 910, 5028, 356, 1),
(1471, 12, 12, 7, 903, 5028, 356, 1),
(1472, 12, 12, 7, 896, 5032, 356, 1),
(1473, 12, 12, 7, 899, 5032, 356, 1),
(1474, 9, 9, 7, 897, 5032, 356, 1),
(1475, 6, 6, 7, 920, 5032, 356, 1),
(1476, 8, 8, 7, 930, 5032, 356, 1),
(1477, 48, 48, 7, 909, 5032, 356, 1),
(1478, 6, 6, 7, 919, 5032, 356, 1),
(1479, 7, 7, 7, 408, 5038, 356, 1),
(1480, 1, 1, 7, 469, 5038, 356, 1),
(1481, 1, 1, 7, 88, 5038, 356, 1),
(1482, 1, 1, 7, 89, 5038, 356, 1),
(1483, 2, 2, 7, 637, 5038, 356, 1),
(1484, 2, 2, 7, 127, 5038, 356, 1),
(1485, 2, 2, 7, 707, 5038, 356, 1),
(1486, 1, 1, 7, 92, 5038, 356, 1),
(1487, 2, 2, 7, 95, 5038, 356, 1),
(1488, 1, 1, 7, 107, 5038, 356, 1),
(1489, 3, 3, 7, 116, 5038, 356, 1),
(1490, 1, 1, 7, 557, 5038, 356, 1),
(1491, 1, 1, 7, 481, 5038, 356, 1),
(1492, 1, 1, 7, 625, 5038, 356, 1),
(1493, 24, 24, 7, 907, 5038, 356, 1),
(1494, 24, 24, 7, 909, 5038, 356, 1),
(1495, 2, 2, 7, 140, 5051, 356, 1),
(1496, 48, 48, 7, 896, 5066, 356, 1),
(1497, 48, 48, 7, 901, 5066, 356, 1),
(1498, 24, 24, 7, 905, 5066, 356, 1),
(1499, 24, 24, 7, 899, 5066, 356, 1),
(1500, 24, 24, 7, 903, 5066, 356, 1),
(1501, 36, 36, 7, 928, 5066, 356, 1),
(1502, 12, 12, 7, 919, 5066, 356, 1),
(1503, 24, 24, 7, 921, 5066, 356, 1),
(1504, 96, 96, 7, 909, 5066, 356, 1),
(1505, 30, 30, 7, 910, 5066, 356, 1),
(1506, 48, 48, 7, 897, 5066, 356, 1),
(1507, 10, 10, 7, 29, 5068, 356, 1),
(1508, 20, 20, 7, 708, 5068, 356, 1),
(1509, 10, 10, 7, 868, 5068, 356, 1),
(1510, 12, 12, 7, 896, 5069, 356, 1),
(1511, 12, 12, 7, 897, 5069, 356, 1),
(1512, 12, 12, 7, 899, 5069, 356, 1),
(1513, 12, 12, 7, 905, 5069, 356, 1),
(1514, 12, 12, 7, 901, 5069, 356, 1),
(1515, 12, 12, 7, 387, 5069, 356, 1),
(1516, 12, 12, 7, 907, 5069, 356, 1),
(1517, 12, 12, 7, 928, 5069, 356, 1),
(1518, 12, 12, 7, 919, 5069, 356, 1),
(1519, 12, 12, 7, 921, 5069, 356, 1),
(1520, 12, 12, 7, 923, 5069, 356, 1),
(1521, 18, 18, 7, 926, 5069, 356, 1),
(1522, 12, 12, 7, 932, 5069, 356, 1),
(1523, 12, 12, 7, 903, 5069, 356, 1),
(1524, 12, 12, 7, 910, 5069, 356, 1),
(1525, 24, 24, 7, 909, 5069, 356, 1),
(1526, 20, 20, 7, 28, 5096, 356, 1),
(1527, 9, 9, 7, 499, 5099, 356, 1),
(1528, 6, 6, 7, 706, 5115, 356, 1),
(1529, 12, 12, 7, 897, 5126, 356, 1),
(1530, 12, 12, 7, 896, 5126, 356, 1),
(1531, 12, 12, 7, 903, 5126, 356, 1),
(1532, 12, 12, 7, 899, 5126, 356, 1),
(1533, 12, 12, 7, 28, 5126, 356, 1),
(1534, 6, 6, 7, 468, 5126, 356, 1),
(1535, 6, 6, 7, 469, 5126, 356, 1),
(1536, 6, 6, 7, 29, 5126, 356, 1),
(1537, 48, 48, 7, 909, 5126, 356, 1),
(1538, 8, 8, 7, 17, 5126, 356, 1),
(1539, 24, 24, 7, 897, 5127, 356, 1),
(1540, 24, 24, 7, 905, 5127, 356, 1),
(1541, 24, 24, 7, 921, 5127, 356, 1),
(1542, 24, 24, 7, 928, 5127, 356, 1),
(1543, 24, 24, 7, 903, 5127, 356, 1),
(1544, 20, 20, 7, 28, 5127, 356, 1),
(1545, 36, 36, 7, 896, 5127, 356, 1),
(1546, 12, 12, 7, 911, 5127, 356, 1),
(1547, 2, 2, 7, 481, 5127, 356, 1),
(1548, 24, 24, 7, 909, 5127, 356, 1),
(1549, 13, 13, 7, 932, 5140, 356, 1),
(1550, 24, 24, 7, 932, 5143, 356, 1),
(1551, 12, 12, 7, 17, 5146, 356, 1),
(1552, 24, 24, 7, 897, 5147, 356, 1),
(1553, 24, 24, 7, 896, 5147, 356, 1),
(1554, 24, 24, 7, 899, 5147, 356, 1),
(1555, 24, 24, 7, 903, 5175, 356, 1),
(1556, 12, 12, 7, 910, 5183, 356, 1);
INSERT INTO `t_validation` (`id_validation`, `qte_envoye`, `qte_verif`, `motif_id`, `produit_id`, `fiche_id`, `hotel_id`, `syn`) VALUES
(1557, 12, 12, 7, 28, 5204, 356, 1),
(1558, 1, 1, 7, 905, 5205, 356, 1),
(1559, 1, 1, 7, 458, 5209, 356, 1),
(1560, 6, 6, 7, 17, 5210, 356, 1),
(1561, 48, 48, 7, 896, 5232, 356, 1),
(1562, 16, 16, 7, 28, 5232, 356, 1),
(1563, 24, 24, 7, 904, 5232, 356, 1),
(1564, 48, 48, 7, 897, 5232, 356, 1),
(1565, 12, 12, 7, 937, 5232, 356, 1),
(1566, 24, 24, 7, 905, 5232, 356, 1),
(1567, 12, 12, 7, 928, 5232, 356, 1),
(1568, 8, 8, 7, 17, 5232, 356, 1),
(1569, 60, 60, 7, 909, 5232, 356, 1),
(1570, 24, 24, 7, 910, 5232, 356, 1),
(1571, 12, 12, 7, 917, 5232, 356, 1),
(1572, 24, 24, 7, 907, 5232, 356, 1),
(1573, 24, 24, 7, 932, 5232, 356, 1),
(1574, 2, 2, 7, 946, 5232, 356, 1),
(1575, 1, 1, 7, 466, 5232, 356, 1),
(1576, 1, 1, 7, 101, 5232, 356, 1),
(1577, 30, 30, 7, 708, 5233, 356, 1),
(1578, 1, 1, 7, 88, 5233, 356, 1),
(1579, 1, 1, 7, 551, 5234, 356, 1),
(1580, 2, 2, 7, 82, 5234, 356, 1),
(1581, 1, 1, 7, 667, 5234, 356, 1),
(1582, 2, 2, 7, 444, 5238, 356, 1),
(1583, 2, 2, 7, 410, 5238, 356, 1),
(1584, 1, 1, 7, 83, 5238, 356, 1),
(1585, 1, 1, 7, 865, 5238, 356, 1),
(1586, 1, 1, 7, 903, 5261, 356, 1),
(1587, 12, 12, 7, 928, 5265, 356, 1),
(1588, 6, 6, 7, 903, 5265, 356, 1),
(1589, 5, 5, 7, 903, 5266, 356, 1),
(1590, 12, 12, 7, 387, 5266, 356, 1),
(1591, 6, 6, 7, 895, 5266, 356, 1),
(1592, 6, 6, 7, 29, 5266, 356, 1),
(1593, 6, 6, 7, 468, 5266, 356, 1),
(1594, 6, 6, 7, 904, 5266, 356, 1),
(1595, 12, 12, 7, 921, 5266, 356, 1),
(1596, 12, 12, 7, 928, 5266, 356, 1),
(1597, 12, 12, 7, 919, 5266, 356, 1),
(1598, 12, 12, 7, 932, 5266, 356, 1),
(1599, 20, 20, 7, 926, 5266, 356, 1),
(1600, 12, 12, 7, 896, 5266, 356, 1),
(1601, 12, 12, 7, 897, 5266, 356, 1),
(1602, 12, 12, 7, 905, 5266, 356, 1),
(1603, 12, 12, 7, 899, 5266, 356, 1),
(1604, 12, 12, 7, 910, 5266, 356, 1),
(1605, 36, 36, 7, 909, 5266, 356, 1),
(1606, 36, 36, 7, 903, 5269, 356, 1),
(1607, 20, 20, 7, 28, 5269, 356, 1),
(1608, 48, 48, 7, 909, 5269, 356, 1),
(1609, 3, 3, 7, 106, 5283, 356, 1),
(1610, 2, 2, 7, 116, 5285, 356, 1),
(1611, 24, 24, 7, 896, 5296, 356, 1),
(1612, 24, 24, 7, 897, 5296, 356, 1),
(1613, 24, 24, 7, 899, 5296, 356, 1),
(1614, 24, 24, 7, 905, 5296, 356, 1),
(1615, 24, 24, 7, 901, 5296, 356, 1),
(1616, 12, 12, 7, 903, 5296, 356, 1),
(1617, 24, 24, 7, 921, 5300, 356, 1),
(1618, 3, 3, 7, 106, 5300, 356, 1),
(1619, 24, 24, 7, 903, 5313, 356, 1),
(1620, 18, 18, 7, 910, 5314, 356, 1),
(1621, 24, 24, 7, 899, 5314, 356, 1),
(1622, 24, 24, 7, 896, 5314, 356, 1),
(1623, 24, 24, 7, 919, 5314, 356, 1),
(1624, 12, 12, 7, 917, 5314, 356, 1),
(1625, 8, 8, 7, 17, 5314, 356, 1),
(1626, 4, 4, 7, 923, 5316, 356, 1),
(1627, 12, 12, 7, 910, 5366, 356, 1),
(1628, 48, 48, 7, 896, 5435, 356, 1),
(1629, 24, 24, 7, 897, 5435, 356, 1),
(1630, 24, 24, 7, 905, 5435, 356, 1),
(1631, 24, 24, 7, 911, 5435, 356, 1),
(1632, 24, 24, 7, 903, 5435, 356, 1),
(1633, 24, 24, 7, 928, 5435, 356, 1),
(1634, 24, 24, 7, 901, 5435, 356, 1),
(1635, 48, 48, 7, 909, 5435, 356, 1),
(1636, 18, 18, 7, 910, 5435, 356, 1),
(1637, 24, 24, 7, 932, 5435, 356, 1),
(1638, 1, 1, 7, 110, 5435, 356, 1),
(1639, 1, 1, 7, 116, 5435, 356, 1),
(1640, 1, 1, 7, 106, 5435, 356, 1),
(1641, 20, 20, 7, 708, 5437, 356, 1),
(1642, 12, 12, 7, 910, 5455, 356, 1),
(1643, 48, 48, 7, 909, 5455, 356, 1),
(1644, 3, 3, 7, 114, 5460, 356, 1),
(1645, 12, 12, 7, 896, 5462, 356, 1),
(1646, 12, 12, 7, 897, 5462, 356, 1),
(1647, 12, 12, 7, 899, 5462, 356, 1),
(1648, 12, 12, 7, 905, 5462, 356, 1),
(1649, 12, 12, 7, 901, 5462, 356, 1),
(1650, 12, 12, 7, 387, 5462, 356, 1),
(1651, 12, 12, 7, 907, 5462, 356, 1),
(1652, 12, 12, 7, 903, 5462, 356, 1),
(1653, 60, 60, 7, 909, 5462, 356, 1),
(1654, 12, 12, 7, 910, 5462, 356, 1),
(1655, 12, 12, 7, 928, 5462, 356, 1),
(1656, 12, 12, 7, 921, 5462, 356, 1),
(1657, 12, 12, 7, 919, 5462, 356, 1),
(1658, 10, 10, 7, 926, 5462, 356, 1),
(1659, 12, 12, 7, 923, 5462, 356, 1),
(1660, 12, 12, 7, 932, 5462, 356, 1),
(1661, 12, 12, 7, 17, 5462, 356, 1),
(1662, 6, 6, 7, 469, 5462, 356, 1),
(1663, 6, 6, 7, 468, 5462, 356, 1),
(1664, 6, 6, 7, 611, 5462, 356, 1),
(1665, 10, 10, 7, 28, 5462, 356, 1),
(1666, 1, 1, 7, 917, 5462, 356, 1),
(1667, 1, 1, 7, 657, 5462, 356, 1),
(1668, 1, 1, 7, 912, 5462, 356, 1),
(1669, 12, 12, 7, 931, 5462, 356, 1),
(1670, 24, 24, 7, 903, 5473, 356, 1),
(1671, 2, 2, 7, 99, 5478, 356, 1),
(1672, 24, 24, 7, 896, 5488, 356, 1),
(1673, 24, 24, 7, 897, 5488, 356, 1),
(1674, 24, 24, 7, 905, 5488, 356, 1),
(1675, 24, 24, 7, 899, 5488, 356, 1),
(1676, 20, 20, 7, 28, 5488, 356, 1),
(1677, 24, 24, 7, 909, 5488, 356, 1),
(1678, 24, 24, 7, 910, 5488, 356, 1),
(1679, 12, 12, 7, 919, 5488, 356, 1),
(1680, 1, 1, 7, 667, 5488, 356, 1),
(1681, 10, 10, 7, 500, 5488, 356, 1),
(1682, 10, 10, 7, 499, 5488, 356, 1),
(1683, 10, 10, 7, 503, 5488, 356, 1),
(1684, 2, 2, 7, 946, 5490, 356, 1),
(1685, 1, 1, 7, 451, 5490, 356, 1),
(1686, 1, 1, 7, 211, 5490, 356, 1),
(1687, 2, 2, 7, 444, 5492, 356, 1),
(1688, 1, 1, 7, 925, 5494, 356, 1),
(1689, 48, 48, 7, 909, 5506, 356, 1),
(1690, 2, 2, 7, 139, 5509, 356, 1),
(1691, 24, 24, 7, 903, 5566, 356, 1),
(1692, 12, 12, 7, 928, 5588, 356, 1),
(1693, 12, 12, 7, 921, 5588, 356, 1),
(1694, 60, 60, 7, 909, 5588, 356, 1),
(1695, 6, 6, 7, 910, 5588, 356, 1),
(1696, 5, 5, 7, 917, 5588, 356, 1),
(1697, 5, 5, 7, 657, 5588, 356, 1),
(1698, 5, 5, 7, 912, 5588, 356, 1),
(1699, 5, 5, 7, 656, 5588, 356, 1),
(1700, 1, 1, 7, 211, 5588, 356, 1),
(1701, 12, 12, 7, 896, 5588, 356, 1),
(1702, 12, 12, 7, 899, 5588, 356, 1),
(1703, 13, 13, 7, 897, 5588, 356, 1),
(1704, 12, 12, 7, 901, 5588, 356, 1),
(1705, 22, 22, 7, 917, 5589, 356, 1),
(1706, 12, 12, 7, 912, 5589, 356, 1),
(1707, 7, 7, 7, 656, 5589, 356, 1),
(1708, 1, 1, 7, 878, 5589, 356, 1),
(1709, 1, 1, 7, 211, 5589, 356, 1),
(1710, 36, 36, 7, 919, 5602, 356, 1),
(1711, 24, 24, 7, 921, 5602, 356, 1),
(1712, 12, 12, 7, 17, 5602, 356, 1),
(1713, 12, 12, 7, 895, 5602, 356, 1),
(1714, 48, 48, 7, 909, 5602, 356, 1),
(1715, 24, 24, 7, 905, 5602, 356, 1),
(1716, 12, 12, 7, 905, 5603, 356, 1),
(1717, 12, 12, 7, 919, 5603, 356, 1),
(1718, 12, 12, 7, 921, 5603, 356, 1),
(1719, 12, 12, 7, 897, 5603, 356, 1),
(1720, 12, 12, 7, 896, 5603, 356, 1),
(1721, 12, 12, 7, 899, 5603, 356, 1),
(1722, 24, 24, 7, 909, 5603, 356, 1),
(1723, 4, 4, 7, 17, 5603, 356, 1),
(1724, 2, 2, 7, 29, 5603, 356, 1),
(1725, 2, 2, 7, 611, 5603, 356, 1),
(1726, 4, 4, 7, 469, 5603, 356, 1),
(1727, 6, 6, 7, 28, 5603, 356, 1),
(1728, 4, 4, 7, 907, 5603, 356, 1),
(1729, 4, 4, 7, 387, 5603, 356, 1),
(1730, 6, 6, 7, 901, 5603, 356, 1),
(1731, 20, 20, 7, 868, 5605, 356, 1),
(1732, 20, 20, 7, 708, 5605, 356, 1),
(1733, 100, 100, 7, 440, 5606, 356, 1),
(1734, 3, 3, 7, 499, 5609, 356, 1),
(1735, 1, 1, 7, 878, 5629, 356, 1),
(1736, 1, 1, 7, 97, 5629, 356, 1),
(1737, 24, 24, 7, 932, 5629, 356, 1),
(1738, 2, 2, 7, 90, 5634, 356, 1),
(1739, 4, 4, 7, 469, 5648, 356, 1),
(1740, 5, 5, 7, 907, 5648, 356, 1),
(1741, 5, 5, 7, 387, 5648, 356, 1),
(1742, 12, 12, 7, 897, 5648, 356, 1),
(1743, 12, 12, 7, 896, 5648, 356, 1),
(1744, 12, 12, 7, 905, 5648, 356, 1),
(1745, 24, 24, 7, 909, 5648, 356, 1),
(1746, 6, 6, 7, 901, 5648, 356, 1),
(1747, 6, 6, 7, 903, 5648, 356, 1),
(1748, 6, 6, 7, 932, 5648, 356, 1),
(1749, 12, 12, 7, 899, 5648, 356, 1),
(1750, 12, 12, 7, 899, 5649, 356, 1),
(1751, 24, 24, 7, 896, 5649, 356, 1),
(1752, 12, 12, 7, 897, 5649, 356, 1),
(1753, 12, 12, 7, 901, 5649, 356, 1),
(1754, 48, 48, 7, 903, 5649, 356, 1),
(1755, 36, 36, 7, 919, 5649, 356, 1),
(1756, 1, 1, 7, 83, 5649, 356, 1),
(1757, 1, 1, 7, 410, 5649, 356, 1),
(1758, 1, 1, 7, 211, 5649, 356, 1),
(1759, 1, 1, 7, 660, 5649, 356, 1),
(1760, 30, 30, 7, 910, 5649, 356, 1),
(1761, 60, 60, 7, 909, 5649, 356, 1),
(1762, 36, 36, 7, 909, 5652, 356, 1),
(1763, 24, 24, 7, 896, 5665, 356, 1),
(1764, 24, 24, 7, 897, 5665, 356, 1),
(1765, 24, 24, 7, 905, 5665, 356, 1),
(1766, 24, 24, 7, 899, 5665, 356, 1),
(1767, 18, 18, 7, 910, 5679, 356, 1),
(1768, 12, 12, 7, 909, 5684, 356, 1),
(1769, 18, 18, 7, 909, 5691, 356, 1),
(1770, 12, 12, 7, 909, 5694, 356, 1),
(1771, 6, 6, 7, 910, 5697, 356, 1),
(1772, 24, 24, 7, 932, 5706, 356, 1),
(1773, 12, 12, 7, 909, 5710, 356, 1),
(1774, 11, 11, 7, 895, 5740, 356, 1),
(1775, 3, 3, 7, 42, 5749, 356, 1),
(1776, 12, 12, 7, 928, 5771, 356, 1),
(1777, 24, 24, 7, 904, 5771, 356, 1),
(1778, 24, 24, 7, 911, 5771, 356, 1),
(1779, 48, 48, 7, 896, 5771, 356, 1),
(1780, 24, 24, 7, 897, 5771, 356, 1),
(1781, 24, 24, 7, 899, 5771, 356, 1),
(1782, 30, 30, 7, 910, 5771, 356, 1),
(1783, 1, 1, 7, 551, 5771, 356, 1),
(1784, 24, 24, 7, 921, 5799, 356, 1),
(1785, 24, 24, 7, 928, 5799, 356, 1),
(1786, 24, 24, 7, 896, 5799, 356, 1),
(1787, 20, 20, 7, 28, 5799, 356, 1),
(1788, 36, 36, 7, 909, 5799, 356, 1),
(1789, 12, 12, 7, 928, 5802, 356, 1),
(1790, 6, 6, 7, 926, 5802, 356, 1),
(1791, 12, 12, 7, 921, 5802, 356, 1),
(1792, 12, 12, 7, 919, 5802, 356, 1),
(1793, 12, 12, 7, 28, 5802, 356, 1),
(1794, 6, 6, 7, 903, 5802, 356, 1),
(1795, 12, 12, 7, 932, 5802, 356, 1),
(1796, 24, 24, 7, 896, 5802, 356, 1),
(1797, 24, 24, 7, 897, 5802, 356, 1),
(1798, 12, 12, 7, 899, 5802, 356, 1),
(1799, 12, 12, 7, 901, 5802, 356, 1),
(1800, 6, 6, 7, 904, 5802, 356, 1),
(1801, 12, 12, 7, 905, 5802, 356, 1),
(1802, 12, 12, 7, 910, 5802, 356, 1),
(1803, 36, 36, 7, 909, 5802, 356, 1),
(1804, 24, 24, 7, 897, 5837, 356, 1),
(1805, 24, 24, 7, 899, 5837, 356, 1),
(1806, 24, 24, 7, 905, 5837, 356, 1),
(1807, 24, 24, 7, 903, 5837, 356, 1),
(1808, 20, 20, 7, 920, 5837, 356, 1),
(1809, 48, 48, 7, 909, 5837, 356, 1),
(1810, 12, 12, 7, 910, 5837, 356, 1),
(1811, 24, 24, 7, 932, 5837, 356, 1),
(1812, 30, 30, 7, 708, 5837, 356, 1),
(1813, 10, 10, 7, 868, 5837, 356, 1),
(1814, 6, 6, 7, 706, 5837, 356, 1),
(1815, 10, 10, 7, 499, 5837, 356, 1),
(1816, 24, 24, 7, 903, 5842, 356, 1),
(1817, 2, 2, 7, 106, 5845, 356, 1),
(1818, 2, 2, 7, 601, 5845, 356, 1),
(1819, 1, 1, 7, 481, 5845, 356, 1),
(1820, 11, 11, 7, 611, 5862, 356, 1),
(1821, 11, 11, 7, 29, 5864, 356, 1),
(1822, 12, 12, 7, 910, 5876, 356, 1),
(1823, 2, 2, 7, 611, 5896, 356, 1),
(1824, 20, 20, 7, 17, 5925, 356, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_versement`
--

DROP TABLE IF EXISTS `t_versement`;
CREATE TABLE IF NOT EXISTS `t_versement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_vers` int(11) DEFAULT NULL,
  `date_vers` date DEFAULT NULL,
  `montant_vers` decimal(65,10) DEFAULT NULL,
  `montantusd` decimal(65,10) DEFAULT NULL,
  `monaie_vers` varchar(10) DEFAULT NULL,
  `taux` float(10,2) DEFAULT '1.00',
  `motif` varchar(20) DEFAULT NULL,
  `solde_virtuel` decimal(65,10) DEFAULT '0.0000000000',
  `balance` decimal(65,10) DEFAULT '0.0000000000',
  `type_vers` varchar(50) DEFAULT NULL,
  `paie_id` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `id_sousresto` int(11) DEFAULT NULL,
  `num` varchar(10) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  `fdcl_usd` decimal(65,10) DEFAULT '0.0000000000',
  `fdcl_cdf` decimal(65,10) DEFAULT '0.0000000000',
  PRIMARY KEY (`id`),
  KEY `id_hotel` (`id_hotel`),
  KEY `user_vers` (`user_vers`),
  KEY `paie_id` (`paie_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_versement`
--

INSERT INTO `t_versement` (`id`, `user_vers`, `date_vers`, `montant_vers`, `montantusd`, `monaie_vers`, `taux`, `motif`, `solde_virtuel`, `balance`, `type_vers`, `paie_id`, `id_hotel`, `id_sousresto`, `num`, `syn`, `fdcl_usd`, `fdcl_cdf`) VALUES
(1, 471, '2025-09-04', '0.0000000000', '100.0000000000', 'USD', 2800.00, 'restaurant', '13.5000000000', '86.5000000000', 'restaurant', NULL, 356, 123, '01046', 0, '0.0000000000', '0.0000000000');

-- --------------------------------------------------------

--
-- Structure de la table `users_groupes`
--

DROP TABLE IF EXISTS `users_groupes`;
CREATE TABLE IF NOT EXISTS `users_groupes` (
  `user_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  `affecteur_id` int(10) NOT NULL,
  `dte` date NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `syn` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `group_id` (`group_id`),
  KEY `affecteur_id` (`affecteur_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_groupes`
--

INSERT INTO `users_groupes` (`user_id`, `group_id`, `affecteur_id`, `dte`, `hotel_id`, `syn`) VALUES
(412, 4, 411, '2018-11-16', 279, 1),
(440, 1, 428, '2018-12-14', 289, 1),
(441, 2, 428, '2018-12-25', NULL, 1),
(442, 2, 428, '2018-12-25', NULL, 1),
(444, 3, 443, '2019-01-14', 298, 1),
(445, 3, 443, '2019-01-14', 298, 1),
(455, 2, 455, '2019-09-26', NULL, 1),
(456, 1, 455, '2019-03-22', 328, 1),
(472, 1, 471, '2023-05-16', NULL, 1),
(472, 2, 471, '2023-05-16', NULL, 1),
(472, 3, 471, '2023-05-16', NULL, 1),
(473, 1, 472, '2021-03-10', 356, 1),
(473, 2, 472, '2021-03-10', 356, 1),
(473, 3, 472, '2021-03-10', 356, 1),
(474, 1, 472, '2021-03-10', 356, 1),
(474, 2, 472, '2021-03-10', 356, 1),
(474, 3, 472, '2021-03-10', 356, 1),
(475, 2, 472, '2021-03-10', 356, 1),
(475, 3, 471, '2021-03-30', 356, 1),
(475, 4, 471, '2020-02-03', 356, 1),
(476, 2, 471, '2021-03-25', NULL, 1),
(476, 3, 476, '2021-03-31', 356, 1),
(477, 3, 472, '2021-03-10', 356, 1),
(478, 1, 473, '2021-06-17', NULL, 1),
(478, 2, 473, '2021-06-17', NULL, 1),
(478, 3, 473, '2021-06-17', NULL, 1),
(479, 1, 471, '2022-03-16', NULL, 1),
(479, 3, 471, '2022-03-16', NULL, 1),
(480, 2, 471, '2021-09-20', 356, 1),
(480, 3, 471, '2021-09-20', 356, 1),
(481, 6, 471, '2020-03-07', NULL, 1),
(482, 1, 472, '2023-01-20', NULL, 1),
(482, 3, 472, '2023-01-20', NULL, 1),
(483, 1, 472, '2023-05-06', NULL, 1),
(483, 2, 472, '2023-05-06', NULL, 1),
(484, 1, 472, '2023-05-06', NULL, 1),
(484, 2, 472, '2023-05-06', NULL, 1),
(485, 1, 472, '2023-05-09', NULL, 1),
(485, 2, 472, '2023-05-09', NULL, 1),
(486, 1, 472, '2023-05-12', NULL, 1),
(486, 2, 472, '2023-05-12', NULL, 1),
(487, 1, 472, '2023-10-02', NULL, 1),
(487, 2, 472, '2023-10-02', NULL, 1),
(487, 3, 472, '2023-10-02', NULL, 1),
(488, 1, 471, '2024-05-15', NULL, 1),
(489, 1, 471, '2024-05-15', 356, 1),
(490, 2, 487, '2024-11-18', NULL, 0),
(490, 3, 487, '2024-11-18', NULL, 0),
(491, 1, 471, '2026-04-16', NULL, 0),
(492, 2, 471, '2026-04-16', NULL, 0),
(493, 4, 482, '2021-02-19', NULL, 1),
(493, 8, 482, '2021-02-19', NULL, 1),
(494, 4, 471, '2020-03-08', NULL, 1),
(495, 3, 471, '2026-04-16', NULL, 0),
(496, 5, 471, '2026-04-16', NULL, 0),
(497, 4, 471, '2020-03-05', NULL, 1),
(498, 4, 483, '2021-02-24', NULL, 1),
(499, 4, 471, '2026-04-17', NULL, 0),
(500, 1, 471, '2026-04-17', NULL, 0),
(501, 4, 471, '2020-03-01', NULL, 1),
(502, 3, 471, '2026-04-20', NULL, 0),
(502, 6, 471, '2026-04-20', NULL, 0),
(503, 4, 471, '2026-04-18', NULL, 0),
(504, 4, 471, '2026-04-18', NULL, 0),
(505, 4, 471, '2026-04-18', NULL, 0),
(506, 4, 471, '2020-03-08', NULL, 1),
(507, 2, 471, '2026-04-17', NULL, 0),
(508, 2, 471, '2026-04-17', NULL, 0),
(509, 4, 471, '2020-03-01', NULL, 1),
(510, 4, 471, '2020-03-01', 356, 1),
(511, 4, 471, '2020-03-01', NULL, 1),
(512, 4, 471, '2020-03-01', NULL, 1),
(513, 4, 471, '2020-03-08', NULL, 1),
(514, 4, 471, '2020-07-16', NULL, 1),
(515, 4, 471, '2020-03-14', NULL, 1),
(516, 4, 471, '2020-07-15', 356, 1),
(517, 4, 471, '2020-07-15', 356, 1),
(518, 4, 471, '2020-07-15', NULL, 1),
(519, 4, 471, '2020-07-16', NULL, 1),
(520, 4, 471, '2020-07-15', NULL, 1),
(521, 4, 482, '2020-08-14', NULL, 1),
(522, 3, 471, '2020-07-31', NULL, 1),
(523, 4, 471, '2020-07-31', NULL, 1),
(524, 4, 496, '2020-10-12', NULL, 1),
(525, 4, 471, '2020-08-21', 356, 1),
(526, 4, 471, '2020-08-21', 356, 1),
(527, 4, 471, '2020-08-23', NULL, 1),
(528, 4, 482, '2020-08-28', 356, 1),
(529, 4, 482, '2020-08-28', 356, 1),
(534, 4, 471, '2020-09-26', NULL, 1),
(536, 4, 482, '2021-02-19', NULL, 1),
(537, 4, 471, '2020-12-05', 356, 1),
(538, 4, 482, '2021-02-20', NULL, 1),
(538, 8, 482, '2021-02-20', NULL, 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_commande`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_commande`;
CREATE TABLE IF NOT EXISTS `v_commande` (
`idprod` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_com_paiement`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_com_paiement`;
CREATE TABLE IF NOT EXISTS `v_com_paiement` (
`modef` varchar(20)
,`dte_timef` datetime
,`id_res` int(11)
,`id_fact` int(10)
,`num_fact` varchar(20)
,`res_ch_id` int(11)
,`date_edition` date
,`tva` float
,`taux` float
,`monnaie` varchar(20)
,`remise` float(10,2)
,`id_sousresto` int(10)
,`id_hotel` int(10)
,`company_id` int(11)
,`id_user` int(11)
,`type` varchar(20)
,`montant_total` decimal(65,10)
,`mont_tva` decimal(65,10)
,`mont_ttc_remise` decimal(65,10)
,`mont_ttc` decimal(65,10)
,`etat` varchar(20)
,`montant_paye` decimal(65,10)
,`id_client` int(10)
,`nom_client` varchar(50)
,`type_client` varchar(20)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_com_paiement_sresto`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_com_paiement_sresto`;
CREATE TABLE IF NOT EXISTS `v_com_paiement_sresto` (
`modef` varchar(20)
,`dte_timef` datetime
,`id_res` int(11)
,`id_fact` int(10)
,`num_fact` varchar(20)
,`res_ch_id` int(11)
,`date_edition` date
,`tva` float
,`taux` float
,`monnaie` varchar(20)
,`remise` float(10,2)
,`id_sousresto` int(10)
,`id_hotel` int(10)
,`company_id` int(11)
,`id_user` int(11)
,`type` varchar(20)
,`montant_total` decimal(65,10)
,`mont_tva` decimal(65,10)
,`mont_ttc_remise` decimal(65,10)
,`mont_ttc` decimal(65,10)
,`etat` varchar(20)
,`montant_paye` decimal(65,10)
,`id_client` int(10)
,`nom_client` varchar(50)
,`type_client` varchar(20)
,`resto` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_factglobale`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_factglobale`;
CREATE TABLE IF NOT EXISTS `v_factglobale` (
`id_respo` int(10)
,`entreprise` varchar(50)
,`montant_total` decimal(65,10)
,`mont_ttc_remise` decimal(65,10)
,`remise` float(10,2)
,`montant_dollar` decimal(65,10)
,`montant_fc` decimal(65,10)
,`id_hotel` int(11)
,`id_client` int(10)
,`nom_client` varchar(50)
,`id_fact` int(10)
,`num_fact` varchar(20)
,`date_edition` date
,`res_ch_id` int(11)
,`id_ch` int(11)
,`num_ch` varchar(245)
,`monnaie` varchar(20)
,`tarif_ch` decimal(65,10)
,`date_occ` date
,`date_lib` date
,`statut` varchar(10)
,`type` varchar(20)
,`id_mode_regl` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_factglobale_clioccas`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_factglobale_clioccas`;
CREATE TABLE IF NOT EXISTS `v_factglobale_clioccas` (
`id_respo` int(10)
,`entreprise` varchar(50)
,`montant_total` decimal(65,10)
,`mont_ttc_remise` decimal(65,10)
,`remise` float(10,2)
,`montant_dollar` decimal(65,10)
,`montant_fc` decimal(65,10)
,`id_hotel` int(11)
,`id_client` int(10)
,`nom_client` varchar(50)
,`id_fact` int(10)
,`num_fact` varchar(20)
,`date_edition` date
,`res_ch_id` int(11)
,`id_ch` int(11)
,`num_ch` varchar(245)
,`monnaie` varchar(20)
,`tarif_ch` decimal(65,10)
,`date_occ` date
,`date_lib` date
,`statut` varchar(10)
,`type` varchar(20)
,`id_mode_regl` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_hebergement`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_hebergement`;
CREATE TABLE IF NOT EXISTS `v_hebergement` (
`id_res` int(11)
,`type` varchar(20)
,`num_reserv` varchar(20)
,`dte` date
,`dte_a` date
,`dte_s` date
,`id_fact` int(10)
,`garantie` decimal(65,10)
,`type_fac` varchar(20)
,`date_edition` date
,`taux` float
,`tva` float
,`monnaie` varchar(20)
,`mont_tva` decimal(65,10)
,`mont_remise` float(10,2)
,`mont_ttc_remise` decimal(65,10)
,`id_user` int(11)
,`idres_ch` int(11)
,`statut` varchar(10)
,`date_occ` date
,`date_lib` date
,`tarif_ch` decimal(65,10)
,`mont_paye` decimal(65,10)
,`justification` varchar(500)
,`lib` varchar(20)
,`num_ch` varchar(245)
,`nom_client` varchar(50)
,`nom_user` varchar(100)
,`nom_respo` varchar(50)
,`company_id` int(11)
,`id_hotel` int(11)
,`id_ch` int(11)
,`tarif_histo` decimal(65,10)
,`statut_histo` varchar(10)
,`date_occ_histo` date
,`date_lib_histo` date
,`id_histo` int(11)
,`id_ch_histo` int(11)
,`idres_ch_histo` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_packs`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_packs`;
CREATE TABLE IF NOT EXISTS `v_packs` (
`idpack` int(11)
,`libelle` varchar(245)
,`etat` int(11)
,`idmodule` int(10)
,`nom` varchar(100)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_paiement`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_paiement`;
CREATE TABLE IF NOT EXISTS `v_paiement` (
`id_res` int(11)
,`id_fact` int(10)
,`num_fact` varchar(20)
,`res_ch_id` int(11)
,`date_edition` date
,`tva` float
,`taux` float
,`remise` float(10,2)
,`type` varchar(20)
,`montant_total` decimal(65,10)
,`mont_tva` decimal(65,10)
,`mont_ttc_remise` decimal(65,10)
,`mont_ttc` decimal(65,10)
,`monnaie` varchar(20)
,`id_client` int(11)
,`id_hotel` int(10)
,`dte_blocage` date
,`date_echeance` date
,`date_desactivation` date
,`montant_usd` decimal(65,10)
,`montant_cdf` decimal(65,10)
,`taux_paie` decimal(65,10)
,`etat` varchar(20)
,`montant_paye` decimal(65,10)
,`rendu` decimal(65,10)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_reglement`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_reglement`;
CREATE TABLE IF NOT EXISTS `v_reglement` (
`id_respo` int(10)
,`entreprise` varchar(50)
,`montant_total` decimal(65,10)
,`montant_dollar` decimal(65,10)
,`montant_fc` decimal(65,10)
,`id_hotel` int(11)
,`id_client` int(10)
,`nom_client` varchar(50)
,`id_fact` int(10)
,`num_fact` varchar(20)
,`date_edition` date
,`remise` float(10,2)
,`type` varchar(20)
,`mont_ttc_remise` decimal(65,10)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_souscription`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_souscription`;
CREATE TABLE IF NOT EXISTS `v_souscription` (
`id_c` int(11)
,`nom_c` varchar(245)
,`etat` int(11)
,`adresse_c` varchar(245)
,`resposable` varchar(121)
,`telephone_user` int(18)
,`libelle` varchar(20)
,`date_sous` date
,`date_activ` date
,`montant_tot_sous` float
,`mode_paie` varchar(20)
,`idmodule` int(10)
,`nom` varchar(100)
,`nbreuser` int(11)
,`module_id` int(11)
,`etat_module` int(11)
,`montantmodule` float
,`dte_sous` date
,`dte_activ` date
,`type_souscription` varchar(20)
,`prix_user` float
);

-- --------------------------------------------------------

--
-- Structure de la vue `v_commande`
--
DROP TABLE IF EXISTS `v_commande`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_commande`  AS SELECT `b`.`idprod` AS `idprod` FROM ((`t_facture` `a` join `stk_produit` `b`) join `lignes_commandes` `c`) WHERE ((`a`.`id_fact` = `c`.`commande_id`) AND (`c`.`produit_id` = `b`.`idprod`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_com_paiement`
--
DROP TABLE IF EXISTS `v_com_paiement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_com_paiement`  AS SELECT `b`.`mode` AS `modef`, `b`.`dte_time` AS `dte_timef`, `b`.`id_res` AS `id_res`, `b`.`id_fact` AS `id_fact`, `b`.`num_fact` AS `num_fact`, `b`.`res_ch_id` AS `res_ch_id`, `b`.`date_edition` AS `date_edition`, `b`.`tva` AS `tva`, `b`.`taux` AS `taux`, `b`.`monnaie` AS `monnaie`, `b`.`remise` AS `remise`, `b`.`id_sousresto` AS `id_sousresto`, `b`.`id_hotel` AS `id_hotel`, `b`.`company_id` AS `company_id`, `b`.`id_user` AS `id_user`, `b`.`type` AS `type`, `b`.`montant_total` AS `montant_total`, `b`.`mont_tva` AS `mont_tva`, `b`.`mont_ttc_remise` AS `mont_ttc_remise`, `b`.`mont_ttc` AS `mont_ttc`, `b`.`etat` AS `etat`, `e`.`montant` AS `montant_paye`, `h`.`id_client` AS `id_client`, `h`.`nom_client` AS `nom_client`, `h`.`type` AS `type_client` FROM ((((`t_facture` `b` join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) join `t_client` `h`) WHERE ((`b`.`id_fact` = `d`.`id_fact`) AND (`d`.`id_regl` = `e`.`regl_id`) AND (`e`.`id_mode_regl` = `f`.`id_mode_regl`) AND (`b`.`id_client` = `h`.`id_client`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_com_paiement_sresto`
--
DROP TABLE IF EXISTS `v_com_paiement_sresto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_com_paiement_sresto`  AS SELECT `b`.`mode` AS `modef`, `b`.`dte_time` AS `dte_timef`, `b`.`id_res` AS `id_res`, `b`.`id_fact` AS `id_fact`, `b`.`num_fact` AS `num_fact`, `b`.`res_ch_id` AS `res_ch_id`, `b`.`date_edition` AS `date_edition`, `b`.`tva` AS `tva`, `b`.`taux` AS `taux`, `b`.`monnaie` AS `monnaie`, `b`.`remise` AS `remise`, `b`.`id_sousresto` AS `id_sousresto`, `b`.`id_hotel` AS `id_hotel`, `b`.`company_id` AS `company_id`, `b`.`id_user` AS `id_user`, `b`.`type` AS `type`, `b`.`montant_total` AS `montant_total`, `b`.`mont_tva` AS `mont_tva`, `b`.`mont_ttc_remise` AS `mont_ttc_remise`, `b`.`mont_ttc` AS `mont_ttc`, `b`.`etat` AS `etat`, `e`.`montant` AS `montant_paye`, `h`.`id_client` AS `id_client`, `h`.`nom_client` AS `nom_client`, `h`.`type` AS `type_client`, `k`.`libelle` AS `resto` FROM (((((`t_facture` `b` join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) join `t_client` `h`) join `t_sousresto` `k`) WHERE ((`b`.`id_fact` = `d`.`id_fact`) AND (`d`.`id_regl` = `e`.`regl_id`) AND (`e`.`id_mode_regl` = `f`.`id_mode_regl`) AND (`b`.`id_client` = `h`.`id_client`) AND (`b`.`id_sousresto` = `k`.`id_sousresto`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_factglobale`
--
DROP TABLE IF EXISTS `v_factglobale`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_factglobale`  AS SELECT `b`.`id_respo` AS `id_respo`, `b`.`entreprise` AS `entreprise`, `d`.`montant_total` AS `montant_total`, `d`.`mont_ttc_remise` AS `mont_ttc_remise`, `d`.`remise` AS `remise`, sum(`f`.`montant_dollar`) AS `montant_dollar`, sum(`f`.`montant_fc`) AS `montant_fc`, `a`.`id_hotel` AS `id_hotel`, `a`.`id_client` AS `id_client`, `a`.`nom_client` AS `nom_client`, `d`.`id_fact` AS `id_fact`, `d`.`num_fact` AS `num_fact`, `d`.`date_edition` AS `date_edition`, `d`.`res_ch_id` AS `res_ch_id`, `h`.`id_ch` AS `id_ch`, `h`.`num_ch` AS `num_ch`, `h`.`monnaie` AS `monnaie`, `h`.`tarif_ch` AS `tarif_ch`, `c`.`date_occ` AS `date_occ`, `c`.`date_lib` AS `date_lib`, `c`.`statut` AS `statut`, `d`.`type` AS `type`, `f`.`id_mode_regl` AS `id_mode_regl` FROM ((((((`t_client` `a` join `t_responsable` `b`) join `t_reserve_chambre` `c`) join `t_facture` `d`) join `t_reglement` `f`) join `t_mode_reglement` `g`) join `t_chambre` `h`) WHERE ((`a`.`id_respo` = `b`.`id_respo`) AND (`c`.`id_client` = `a`.`id_client`) AND (`c`.`id` = `d`.`res_ch_id`) AND (`d`.`id_fact` = `f`.`id_fact`) AND (`f`.`id_mode_regl` = `g`.`id_mode_regl`) AND (`h`.`id_ch` = `c`.`idchambre`) AND (`a`.`type_cl` = 'client partenaire') AND (`f`.`rejete` = 0)) GROUP BY `f`.`id_fact` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_factglobale_clioccas`
--
DROP TABLE IF EXISTS `v_factglobale_clioccas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_factglobale_clioccas`  AS SELECT `b`.`id_respo` AS `id_respo`, `b`.`entreprise` AS `entreprise`, `d`.`montant_total` AS `montant_total`, `d`.`mont_ttc_remise` AS `mont_ttc_remise`, `d`.`remise` AS `remise`, sum(`f`.`montant_dollar`) AS `montant_dollar`, sum(`f`.`montant_fc`) AS `montant_fc`, `a`.`id_hotel` AS `id_hotel`, `a`.`id_client` AS `id_client`, `a`.`nom_client` AS `nom_client`, `d`.`id_fact` AS `id_fact`, `d`.`num_fact` AS `num_fact`, `d`.`date_edition` AS `date_edition`, `d`.`res_ch_id` AS `res_ch_id`, `h`.`id_ch` AS `id_ch`, `h`.`num_ch` AS `num_ch`, `h`.`monnaie` AS `monnaie`, `h`.`tarif_ch` AS `tarif_ch`, `c`.`date_occ` AS `date_occ`, `c`.`date_lib` AS `date_lib`, `c`.`statut` AS `statut`, `d`.`type` AS `type`, `f`.`id_mode_regl` AS `id_mode_regl` FROM ((((((`t_client` `a` join `t_responsable` `b`) join `t_reserve_chambre` `c`) join `t_facture` `d`) join `t_reglement` `f`) join `t_mode_reglement` `g`) join `t_chambre` `h`) WHERE ((`a`.`id_respo` = `b`.`id_respo`) AND (`c`.`id_client` = `a`.`id_client`) AND (`c`.`id` = `d`.`res_ch_id`) AND (`d`.`id_fact` = `f`.`id_fact`) AND (`f`.`id_mode_regl` = `g`.`id_mode_regl`) AND (`h`.`id_ch` = `c`.`idchambre`) AND (`a`.`type_cl` = 'client occasionnel') AND (`f`.`rejete` = 0)) GROUP BY `f`.`id_fact` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_hebergement`
--
DROP TABLE IF EXISTS `v_hebergement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hebergement`  AS SELECT `a`.`id_res` AS `id_res`, `a`.`type` AS `type`, `a`.`num_reserv` AS `num_reserv`, `a`.`dte` AS `dte`, `a`.`dte_a` AS `dte_a`, `a`.`dte_s` AS `dte_s`, `b`.`id_fact` AS `id_fact`, `a`.`garantie` AS `garantie`, `b`.`type` AS `type_fac`, `b`.`date_edition` AS `date_edition`, `b`.`taux` AS `taux`, `b`.`tva` AS `tva`, `b`.`monnaie` AS `monnaie`, `b`.`mont_tva` AS `mont_tva`, `b`.`remise` AS `mont_remise`, `b`.`mont_ttc_remise` AS `mont_ttc_remise`, `b`.`id_user` AS `id_user`, `c`.`id` AS `idres_ch`, `c`.`statut` AS `statut`, `c`.`date_occ` AS `date_occ`, `c`.`date_lib` AS `date_lib`, `c`.`tarif_ch` AS `tarif_ch`, `e`.`montant` AS `mont_paye`, `e`.`justification` AS `justification`, `f`.`lib` AS `lib`, `g`.`num_ch` AS `num_ch`, `h`.`nom_client` AS `nom_client`, `i`.`nom_user` AS `nom_user`, `j`.`entreprise` AS `nom_respo`, `e`.`company_id` AS `company_id`, `a`.`id_hotel` AS `id_hotel`, `g`.`id_ch` AS `id_ch`, `k`.`tarif_ch` AS `tarif_histo`, `k`.`statut` AS `statut_histo`, `k`.`date_occ` AS `date_occ_histo`, `k`.`date_lib` AS `date_lib_histo`, `k`.`id` AS `id_histo`, `k`.`idchambre` AS `id_ch_histo`, `k`.`idres_ch` AS `idres_ch_histo` FROM ((((((((((`t_reservation` `a` join `t_facture` `b`) join `t_reserve_chambre` `c`) join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) join `t_chambre` `g`) join `t_client` `h`) join `t_utilisateur` `i`) join `t_responsable` `j`) join `t_chambre_histo` `k`) WHERE ((`a`.`id_res` = `b`.`id_res`) AND (`b`.`id_fact` = `c`.`idfact`) AND (`b`.`id_fact` = `d`.`id_fact`) AND (`d`.`id_regl` = `e`.`regl_id`) AND (`e`.`id_mode_regl` = `f`.`id_mode_regl`) AND (`g`.`id_ch` = `k`.`idchambre`) AND (`c`.`id` = `k`.`idres_ch`) AND (`b`.`id_client` = `h`.`id_client`) AND (`b`.`id_user` = `i`.`id_user`) AND (`h`.`id_respo` = `j`.`id_respo`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_packs`
--
DROP TABLE IF EXISTS `v_packs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_packs`  AS SELECT `pa`.`id` AS `idpack`, `pa`.`libelle` AS `libelle`, `pa`.`etat` AS `etat`, `mo`.`id` AS `idmodule`, `mo`.`nom` AS `nom` FROM ((`t_module_pack` `mp` join `t_pack` `pa`) join `module` `mo`) WHERE ((`mp`.`pack_id` = `pa`.`id`) AND (`mp`.`module_id` = `mo`.`id`)) ORDER BY `pa`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_paiement`
--
DROP TABLE IF EXISTS `v_paiement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_paiement`  AS SELECT `b`.`id_res` AS `id_res`, `b`.`id_fact` AS `id_fact`, `b`.`num_fact` AS `num_fact`, `b`.`res_ch_id` AS `res_ch_id`, `b`.`date_edition` AS `date_edition`, `b`.`tva` AS `tva`, `b`.`taux` AS `taux`, `b`.`remise` AS `remise`, `b`.`type` AS `type`, `b`.`montant_total` AS `montant_total`, `b`.`mont_tva` AS `mont_tva`, `b`.`mont_ttc_remise` AS `mont_ttc_remise`, `b`.`mont_ttc` AS `mont_ttc`, `b`.`monnaie` AS `monnaie`, `b`.`id_client` AS `id_client`, `b`.`id_hotel` AS `id_hotel`, `b`.`dte_blocage` AS `dte_blocage`, `b`.`date_echeance` AS `date_echeance`, `b`.`date_desactivation` AS `date_desactivation`, `e`.`montantusd` AS `montant_usd`, `e`.`montantcdf` AS `montant_cdf`, `e`.`taux` AS `taux_paie`, `b`.`etat` AS `etat`, `e`.`montant` AS `montant_paye`, `e`.`rendu` AS `rendu` FROM (((`t_facture` `b` join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) WHERE ((`b`.`id_fact` = `d`.`id_fact`) AND (`d`.`id_regl` = `e`.`regl_id`) AND (`e`.`id_mode_regl` = `f`.`id_mode_regl`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_reglement`
--
DROP TABLE IF EXISTS `v_reglement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reglement`  AS SELECT `b`.`id_respo` AS `id_respo`, `b`.`entreprise` AS `entreprise`, `d`.`montant_total` AS `montant_total`, sum(`f`.`montant_dollar`) AS `montant_dollar`, sum(`f`.`montant_fc`) AS `montant_fc`, `a`.`id_hotel` AS `id_hotel`, `a`.`id_client` AS `id_client`, `a`.`nom_client` AS `nom_client`, `d`.`id_fact` AS `id_fact`, `d`.`num_fact` AS `num_fact`, `d`.`date_edition` AS `date_edition`, `d`.`remise` AS `remise`, `d`.`type` AS `type`, `d`.`mont_ttc_remise` AS `mont_ttc_remise` FROM (((((`t_client` `a` join `t_responsable` `b`) join `t_reserve_chambre` `c`) join `t_facture` `d`) join `t_reglement` `f`) join `t_mode_reglement` `g`) WHERE ((`a`.`id_respo` = `b`.`id_respo`) AND (`c`.`id_client` = `a`.`id_client`) AND (`c`.`id` = `d`.`res_ch_id`) AND (`d`.`id_fact` = `f`.`id_fact`) AND (`f`.`id_mode_regl` = `g`.`id_mode_regl`) AND (`g`.`lib` = 'Credit') AND (`a`.`type_cl` = 'client partenaire')) GROUP BY `f`.`id_fact` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_souscription`
--
DROP TABLE IF EXISTS `v_souscription`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_souscription`  AS SELECT `c`.`id_c` AS `id_c`, `c`.`nom_c` AS `nom_c`, `c`.`etat` AS `etat`, `c`.`adresse_c` AS `adresse_c`, concat(`u`.`nom_user`,' ',`u`.`prenom_user`) AS `resposable`, `u`.`telephone_user` AS `telephone_user`, `s`.`libelle` AS `libelle`, `s`.`date_sous` AS `date_sous`, `s`.`date_activ` AS `date_activ`, `s`.`montant_tot_sous` AS `montant_tot_sous`, `s`.`mode_paie` AS `mode_paie`, `m`.`id` AS `idmodule`, `m`.`nom` AS `nom`, `mc`.`nbreuser` AS `nbreuser`, `mc`.`id` AS `module_id`, `mc`.`etat_module` AS `etat_module`, `mc`.`montantmodule` AS `montantmodule`, `mc`.`date_sous` AS `dte_sous`, `mc`.`date_activ` AS `dte_activ`, `p`.`souscription` AS `type_souscription`, `p`.`prix_user` AS `prix_user` FROM (((((`t_company` `c` join `souscription` `s`) join `module` `m`) join `prix` `p`) join `t_modulecompany` `mc`) join `t_utilisateur` `u`) WHERE ((`mc`.`company_id` = `c`.`id_c`) AND (`mc`.`module_id` = `m`.`id`) AND (`mc`.`souscription_id` = `s`.`id`) AND (`mc`.`prix_id` = `p`.`id`) AND (`u`.`company_id` = `c`.`id_c`) AND (`u`.`type` = 1)) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accuse_reception`
--
ALTER TABLE `accuse_reception`
  ADD CONSTRAINT `accuse_reception_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `t_company` (`id_c`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ach_livraison`
--
ALTER TABLE `ach_livraison`
  ADD CONSTRAINT `ach_livraison_ibfk_1` FOREIGN KEY (`bcommande_id`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ach_livraison_ibfk_2` FOREIGN KEY (`fournisseur_id`) REFERENCES `t_client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ach_livraison_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ach_livraison_ibfk_4` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ach_produits_livres`
--
ALTER TABLE `ach_produits_livres`
  ADD CONSTRAINT `ach_produits_livres_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `stk_produit` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ach_produits_livres_ibfk_2` FOREIGN KEY (`livraison_id`) REFERENCES `ach_livraison` (`id_liv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ach_produits_livres_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ach_produits_livres_ibfk_4` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `actions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `actions_groupe`
--
ALTER TABLE `actions_groupe`
  ADD CONSTRAINT `actions_groupe_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actions_groupe_ibfk_2` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id_act`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `affectation_sousresto`
--
ALTER TABLE `affectation_sousresto`
  ADD CONSTRAINT `affectation_sousresto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `affectation_sousresto_ibfk_2` FOREIGN KEY (`sousresto_id`) REFERENCES `t_sousresto` (`id_sousresto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `bon_commandes`
--
ALTER TABLE `bon_commandes`
  ADD CONSTRAINT `bon_commandes_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `stk_produit` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bon_commandes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bon_commandes_ibfk_3` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `categorie_chambre`
--
ALTER TABLE `categorie_chambre`
  ADD CONSTRAINT `categorie_chambre_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `checking_valid`
--
ALTER TABLE `checking_valid`
  ADD CONSTRAINT `checking_valid_ibfk_1` FOREIGN KEY (`site`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `condition_reglement`
--
ALTER TABLE `condition_reglement`
  ADD CONSTRAINT `condition_reglement_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptcategories`
--
ALTER TABLE `cptcategories`
  ADD CONSTRAINT `cptcategories_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `cptclasses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptcomptes`
--
ALTER TABLE `cptcomptes`
  ADD CONSTRAINT `cptcomptes_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `cptcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptcomptesites`
--
ALTER TABLE `cptcomptesites`
  ADD CONSTRAINT `cptcomptesites_ibfk_1` FOREIGN KEY (`compte_id`) REFERENCES `cptsouscomptes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptcomptesites_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptdetailsecritures`
--
ALTER TABLE `cptdetailsecritures`
  ADD CONSTRAINT `cptdetailsecritures_ibfk_1` FOREIGN KEY (`compte_id`) REFERENCES `cptcomptes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptdetailsecritures_ibfk_2` FOREIGN KEY (`ecriture_id`) REFERENCES `cptecritures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptdetailsecritures_ibfk_3` FOREIGN KEY (`categorie_id`) REFERENCES `cptcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptdetailsecritures_ibfk_4` FOREIGN KEY (`souscompte_id`) REFERENCES `cptsouscomptes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptecritures`
--
ALTER TABLE `cptecritures`
  ADD CONSTRAINT `cptecritures_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptecritures_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptecritures_ibfk_3` FOREIGN KEY (`journal_id`) REFERENCES `cptjournal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptecritures_ibfk_4` FOREIGN KEY (`exercice_id`) REFERENCES `cptexercice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptexercice`
--
ALTER TABLE `cptexercice`
  ADD CONSTRAINT `cptexercice_ibfk_1` FOREIGN KEY (`config_id`) REFERENCES `resconfig` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptexercice_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptjournal`
--
ALTER TABLE `cptjournal`
  ADD CONSTRAINT `cptjournal_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptjournalcompte`
--
ALTER TABLE `cptjournalcompte`
  ADD CONSTRAINT `cptjournalcompte_ibfk_2` FOREIGN KEY (`journal_id`) REFERENCES `cptjournal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptrapportjournal`
--
ALTER TABLE `cptrapportjournal`
  ADD CONSTRAINT `cptrapportjournal_ibfk_1` FOREIGN KEY (`journal_id`) REFERENCES `cptjournal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptrapportjournal_ibfk_2` FOREIGN KEY (`exercice_id`) REFERENCES `cptexercice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptrapportjournal_ibfk_3` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptrapportjournal_ibfk_4` FOREIGN KEY (`ecriture_id`) REFERENCES `cptecritures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cptsouscomptes`
--
ALTER TABLE `cptsouscomptes`
  ADD CONSTRAINT `cptsouscomptes_ibfk_1` FOREIGN KEY (`compte_id`) REFERENCES `cptcomptes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cptsouscomptes_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD CONSTRAINT `depenses_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depenses_ibfk_2` FOREIGN KEY (`libelle_id`) REFERENCES `dep_libelles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depenses_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `depenses_ibfk_4` FOREIGN KEY (`sousresto_id`) REFERENCES `t_sousresto` (`id_sousresto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dep_libelles`
--
ALTER TABLE `dep_libelles`
  ADD CONSTRAINT `dep_libelles_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailsplats`
--
ALTER TABLE `detailsplats`
  ADD CONSTRAINT `detailsplats_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailsplatscommandes`
--
ALTER TABLE `detailsplatscommandes`
  ADD CONSTRAINT `detailsplatscommandes_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `stk_produit` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsplatscommandes_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsplatscommandes_ibfk_3` FOREIGN KEY (`commande_id`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailsplatscommandes_ibfk_4` FOREIGN KEY (`lignecmd_id`) REFERENCES `lignes_commandes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fiche_transfert`
--
ALTER TABLE `fiche_transfert`
  ADD CONSTRAINT `fiche_transfert_ibfk_1` FOREIGN KEY (`depot_id`) REFERENCES `t_depot` (`id_depot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fiche_transfert_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fondscaisse`
--
ALTER TABLE `fondscaisse`
  ADD CONSTRAINT `fondscaisse_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fusion_factures`
--
ALTER TABLE `fusion_factures`
  ADD CONSTRAINT `fusion_factures_ibfk_1` FOREIGN KEY (`id_fact_fus`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fusion_tables`
--
ALTER TABLE `fusion_tables`
  ADD CONSTRAINT `fusion_tables_ibfk_1` FOREIGN KEY (`id_tbl_fus`) REFERENCES `t_client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fusion_tables_ibfk_2` FOREIGN KEY (`id_tbl`) REFERENCES `t_client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_ibfk_3` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lignes_commandes`
--
ALTER TABLE `lignes_commandes`
  ADD CONSTRAINT `lignes_commandes_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `stk_produit` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lignes_commandes_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lignes_commandes_ibfk_3` FOREIGN KEY (`commande_id`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lignes_commandes_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lignes_commandes_ibfk_5` FOREIGN KEY (`id_sousresto`) REFERENCES `t_sousresto` (`id_sousresto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table ` monnaie`
--
ALTER TABLE ` monnaie`
  ADD CONSTRAINT ` monnaie_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `niveau_chambre`
--
ALTER TABLE `niveau_chambre`
  ADD CONSTRAINT `niveau_chambre_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_mode_regl`) REFERENCES `t_mode_reglement` (`id_mode_regl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`id_monnaie`) REFERENCES ` monnaie` (`id_monnaie`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_3` FOREIGN KEY (`regl_id`) REFERENCES `t_reglement` (`id_regl`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_4` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_5` FOREIGN KEY (`company_id`) REFERENCES `t_company` (`id_c`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_6` FOREIGN KEY (`id_sousresto`) REFERENCES `t_sousresto` (`id_sousresto`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_7` FOREIGN KEY (`histch_id`) REFERENCES `t_chambre_histo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_8` FOREIGN KEY (`resch_id`) REFERENCES `t_reserve_chambre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_9` FOREIGN KEY (`session_id`) REFERENCES `t_session` (`idsession`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paragraphe_contrat`
--
ALTER TABLE `paragraphe_contrat`
  ADD CONSTRAINT `paragraphe_contrat_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reportcaisse`
--
ALTER TABLE `reportcaisse`
  ADD CONSTRAINT `reportcaisse_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stk_produit`
--
ALTER TABLE `stk_produit`
  ADD CONSTRAINT `stk_produit_ibfk_1` FOREIGN KEY (`famille_id`) REFERENCES `stk_sous_famille` (`id_s_fam`);

--
-- Contraintes pour la table `stk_sous_famille`
--
ALTER TABLE `stk_sous_famille`
  ADD CONSTRAINT `stk_sous_famille_ibfk_1` FOREIGN KEY (`famille`) REFERENCES `stk_famille` (`idfamille`);

--
-- Contraintes pour la table `stk__mouvement`
--
ALTER TABLE `stk__mouvement`
  ADD CONSTRAINT `stk__mouvement_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `stk_produit` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stk__mouvement_ibfk_2` FOREIGN KEY (`fiche_id`) REFERENCES `skt_fiche` (`id_fiche`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stk__mouvement_ibfk_3` FOREIGN KEY (`depot_id`) REFERENCES `t_depot` (`id_depot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stk__mouvement_ibfk_4` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suivifactures`
--
ALTER TABLE `suivifactures`
  ADD CONSTRAINT `suivifactures_ibfk_1` FOREIGN KEY (`facture_id`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_facture`
--
ALTER TABLE `t_facture`
  ADD CONSTRAINT `t_facture_ibfk_1` FOREIGN KEY (`id_res`) REFERENCES `t_reservation` (`id_res`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_facture_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_facture_ibfk_3` FOREIGN KEY (`id_client`) REFERENCES `t_client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_facture_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_reglement`
--
ALTER TABLE `t_reglement`
  ADD CONSTRAINT `t_reglement_ibfk_1` FOREIGN KEY (`id_fact`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_versement`
--
ALTER TABLE `t_versement`
  ADD CONSTRAINT `t_versement_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_versement_ibfk_2` FOREIGN KEY (`id_sousresto`) REFERENCES `t_sousresto` (`id_sousresto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
