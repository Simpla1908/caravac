-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 04 juin 2020 à 13:53
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kembov4`
--

-- --------------------------------------------------------

--
-- Structure de la table `accompagnmnt_boisson`
--

DROP TABLE IF EXISTS `accompagnmnt_boisson`;
CREATE TABLE IF NOT EXISTS `accompagnmnt_boisson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `accompagnmnt_boisson`
--

INSERT INTO `accompagnmnt_boisson` (`id`, `lib`) VALUES
(1, 'avec paille'),
(2, 'sans paille'),
(3, 'avec glacon');

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
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `accuse_reception`
--

INSERT INTO `accuse_reception` (`id`, `email`, `nom`, `sujet`, `message`, `statut`, `date`, `company_id`) VALUES
(112, 'lulu@ebutelo.com', 'Lulu&Chacha Lulu&Chacha', 'EBUTELO-Souscription', '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <meta charset=\\\"UTF-8\\\">\r\n        <meta name=\\\"viewport\\\" content=\\\"width=device-width, initial-scale=1.0\\\">\r\n    </head>\r\n    <body style=\"font-family: Helvetica, Arial, Sans-Serif;\">\r\n    <div style=\"height:530px; \r\n                width:772px;\r\n                background: #f2f2f2;\r\n                margin: auto;\r\n                border-radius: 5px;\r\n                padding: 50px; \r\n                padding-top: 20px;\r\n                border: 1px solid #c5c5c5;\">\r\n        <header id=\"top_header\" style=\"margin: 0 10px 10px 0;\">\r\n            <img src=\"../css/assets/img/logo_bks.png\" height=\"81\" width=\"110\"/>\r\n        </header>\r\n        \r\n        <section style=\"clear: both;\r\n                        border-top: 1px solid #eaeaea;\">\r\n            <b>EBUTELO (Souscription)</b>\r\n            <p>\r\n                Cher client, <br/><br/>\r\n                Votre essai gratuit de 15 jours vient dâ€™Ãªtre effectuer avec succÃ¨s. \r\n                Veuillez cliquer sur le lien ci-aprÃ¨s <a target=\"_blank\" href=\"www.ebutelo.com/test/login.php?sous_id=199&hotel_id=356\">Confirmer votre compte</a> pour acceder au logiciel avec le nom dâ€™utilisateur et le mot de passe que vous avez crÃ©Ã©s Ã  la souscription. <br/><br/>\r\n                En cas de difficultÃ©, nâ€™hÃ©site pas Ã  nous contacter au +243 85 464 6679 ou info@ebutelo.com <br/><br/>\r\n                \r\n                <p>\r\n                    <b>Indentifiants de Connexion:</b><br/>\r\n                    - Login: admin<br/>\r\n                    - Mot de passe: admin\r\n                </p>\r\n                Merci de votre confiance !<br/><br/>\r\n                Service Commercial. \r\n\r\n            </p>\r\n        </section>\r\n\r\n        <footer style=\"clear: both;\r\n                       color: #000;\r\n                       border-top: 1px solid #eaeaea;\r\n                       text-align: center;\r\n                       margin-top: 20px; \">\r\n            <p style=\"font-size: 11px;\">\r\n                <span class=\"muted\"><b>EBUTELO  </b><br/>\r\n                    <b>RCCM </b>: 16-B-10.039, <b>Id. Nat.</b> : 01-9-N10348L, <b>NÂ° ImpÃ´t</b> : A1612552M <br/> \r\n                    KINSHASA-RDCongo - <b>Contact</b> :+243854646679,info@ebutelo.com <br/>\r\n                    Copyright &copy; <?php echo strftime(\"%Y\"); ?> | </span> \r\n                <a href=\"#\">Facebook</a> Â· Â·\r\n                <a href=\"#\">YouTube</a>\r\n            </p>\r\n        </footer>\r\n    </div>\r\n</body>\r\n</html>', 'envoye', '2019-12-11 23:57:29', 299);

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
  PRIMARY KEY (`id_act`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=611 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id_act`, `code_act`, `lib_act`, `visible`, `affiche`, `module_id`) VALUES
(344, 'VMH', 'VOIR MODULE HEBERGEMENT', 0, 1, 23),
(345, 'VMR', 'VOIR MODULE RESTAURANT', 0, 1, 22),
(346, 'VMS', 'VOIR MODULE STOCK', 0, 1, 24),
(347, 'VMCR', 'VOIR MODULE CONFIGURATIONS & REGLAGES\r\n', 0, 1, 25),
(359, 'ER', 'ENREGISTRER UNE RESERVATION', 1, 1, 23),
(360, 'VR', 'VOIR TOUTES LES FACTURES', 1, 1, 23),
(361, 'ILR', 'VOIR TOUTES LES RESERVATIONS', 1, 0, 23),
(362, 'MR', 'MODIFIER RESERVATION', 1, 0, 23),
(363, 'VO', 'VOIR TOUTES LES OCCUPATIONS', 1, 0, 23),
(364, 'EO', 'ENREGISTRER UNE OCCUPATION', 1, 1, 23),
(365, 'CC', 'CHANGER DE CHAMBRE', 1, 1, 23),
(366, 'VLIB', 'VOIR TOUTES LES LIBERATIONS', 1, 0, 23),
(367, 'SITCLL', 'SITUATION CLIENT LOGES', 1, 0, 23),
(368, 'IMPRCLSS', 'IMPRIMER CLASSEUR', 1, 0, 23),
(369, 'AJTCL', 'AJOUTER CLIENT', 1, 1, 23),
(370, 'MINFCLI', 'MODIFIER INFORMATION CLIENT', 1, 1, 23),
(371, 'SCLI', 'SUPPRIMER CLIENT', 1, 1, 23),
(372, 'IMPRCLI', 'IMPRIMER LISTE CLIENT', 1, 0, 23),
(373, 'ENRECL', 'ENREGISTRER RECLAMATION', 1, 0, 23),
(374, 'LSTRECL', 'LISTE RECLAMATIONS', 1, 0, 23),
(375, 'TBS', 'TABLEAU BORD STOCK', 1, 1, 24),
(376, 'APPRL', 'VOIR APPROVISIONNEMENT ', 1, 1, 24),
(377, 'APPRA', 'AJOUTER APPROVISIONNEMENT', 1, 1, 24),
(378, 'APPRM', 'MODIFIER APPROVISIONNEMENT', 1, 1, 24),
(379, 'APPRS', 'SUPPRIMER APPROVISIONNEMENT', 1, 1, 24),
(380, 'SORL', 'VOIR SORTIE', 1, 1, 24),
(381, 'SORA', 'AJOUTER SORTIE', 1, 1, 24),
(382, 'SORM', 'MODIFIER SORTIE', 1, 1, 24),
(383, 'SORS', 'SUPPRIMER SORTIE', 1, 1, 24),
(384, 'RPF', 'VOIR RAPPORT PRODUIT FAMILLE', 1, 1, 24),
(385, 'RFA', 'VOIR RAPPORT FICHE ARTICLE', 1, 1, 24),
(386, 'PARART', 'PARAMETRER ARTICLE', 1, 1, 24),
(387, 'CCH', 'CREER HOTEL', 1, 1, 25),
(388, 'CCC', 'CREER CHAMBRE', 1, 1, 25),
(389, 'CMIH', 'MODIFIER INFORMATION HOTEL', 1, 1, 25),
(390, 'CMC', 'MODIFIER CHAMBRE', 1, 1, 25),
(391, 'CAU', 'AJOUTER UTILISATEUR', 1, 1, 25),
(392, 'CMU', 'MODIFIER UTILISATEUR', 1, 1, 25),
(393, 'CSU', 'SUPPRIMER UTILISATEUR', 1, 1, 25),
(394, 'CVU', 'VOIR LA LISTE DES UTILISATEURS', 1, 1, 25),
(395, 'CVP', 'VOIR LA LISTE DES PARTENAIRES', 1, 1, 25),
(396, 'CAP', 'AJOUTER PARTENAIRE', 1, 1, 25),
(397, 'CSP', 'SUPPRIMER PARTENAIRE', 1, 1, 25),
(398, 'CMP', 'MODIFIER PARTENAIRE', 1, 1, 25),
(399, 'CDT', 'DEFINIR TAUX', 1, 1, 25),
(400, 'CDM', 'DEFINIR MONNAIE', 1, 1, 25),
(401, 'RTR', 'RESERVATION TABLE RESTAURANT', 1, 1, 22),
(402, 'ART', 'ANNULER RESERVATION TABLE', 1, 1, 22),
(403, 'RM', 'REMISE COMMANDE', 1, 1, 22),
(404, 'RV', 'VOIR TOUS LES DETAILS VENTES', 1, 1, 22),
(405, 'V', 'VENTE', 1, 0, 22),
(406, 'ATR', 'AJOUTER TABLE RESTAURANT', 1, 1, 22),
(407, 'IBE', 'IMPRIMER BON D\'ENTREE', 1, 1, 24),
(408, 'IBS', 'IMPRIMER BON DE SORTIE', 1, 1, 24),
(409, 'VLTR', 'VOIR LISTE TABLE RESTAURANT', 1, 1, 22),
(410, 'EL', 'LIBERER LES CLIENTS LOGES', 1, 1, 23),
(411, 'VLCLI', 'VOIR LISTE DES CLIENTS', 1, 1, 23),
(412, 'AR', 'ANNULER RESERVATION', 1, 0, 23),
(413, 'ILO', 'IMPRIMER LISTE DES OCCUPATIONS', 1, 0, 23),
(414, 'ILL', 'IMPRIMER LISTE DES LIBERATIONS', 1, 0, 23),
(415, 'VTCR', 'VOIR TOUTES LES FACTURES', 1, 1, 22),
(416, 'VSPCER', 'VOIR SES PROPRES FACTURES ENREGISTREES', 1, 1, 22),
(417, 'VTVS', 'VOIR TOUS LES VERSEMENTS', 1, 1, 22),
(418, 'VSPVS', 'VOIR SES PROPRES VERSEMENTS', 1, 1, 22),
(419, 'PPR', 'PARAMETRAGE DES PLATS', 1, 1, 22),
(420, 'AR1', 'IMPRIMER ADDITION', 1, 1, 22),
(421, 'AR2', 'IMPRIMER BON DE COMMANDE', 1, 1, 22),
(422, 'AR3', 'METTRE COMMANDE EN ATTENTE', 1, 1, 22),
(423, 'AR4', 'ENREGISTRER PAIEMENT FACTURE', 1, 1, 22),
(424, 'AR5', 'ANNULER COMMANDE', 1, 1, 22),
(425, 'AR6', 'VOIR CLIENTS', 1, 1, 22),
(426, 'AR7', 'VOIR TOUS LES TICKETS EN ATTENTE', 1, 1, 22),
(427, 'AR8', 'VOIR PRODUITS EN RUPTURE DE STOCK', 1, 0, 22),
(428, 'AR9', 'ENREGISTRER VERSEMENT CAISSE', 1, 1, 22),
(429, 'AR10', 'MODIFIER INFOS SOUS-SITE', 1, 1, 22),
(430, 'AR11', 'MODIFIER QUANTITE PRODUIT', 1, 1, 22),
(431, 'AR12', 'SUPPRIMER PRODUIT COMMANDE', 1, 1, 22),
(432, 'VSPRCT', 'VOIR SES PROPRES RECETTES', 1, 0, 23),
(433, 'VTRCT', 'VOIR TOUTES LES RECETTES', 1, 1, 23),
(434, 'VRH', 'VOIR MODULE RH', 0, 1, 26),
(441, 'RHFSI', 'FAIRE LA SAISIE INFORMATION', 1, 1, 26),
(442, 'RHMIE', 'MODIFIER LES INFOS DES EMPLOYES', 1, 1, 26),
(443, 'RHLE', 'VOIR LA LISTE DES EMPLOYES', 1, 1, 26),
(444, 'RHGS', 'GERER LES SANCTIONS', 1, 1, 26),
(445, 'RHGC', 'GERER LES CONGES', 1, 1, 26),
(446, 'RHGR', 'GERER LES RESILIATIONS', 1, 1, 26),
(447, 'RHGBM', 'GERER LES BONS DES MALADES', 1, 1, 26),
(448, 'RHGPAIE', 'GERER LA PAIE', 1, 1, 26),
(449, 'RHGPOINT', 'GERER LE POINTAGE', 1, 1, 26),
(450, 'RHFCONF', 'FAIRE LA CONFIGURATION', 1, 1, 26),
(451, 'VSPTA', 'VOIR SES PROPRES TICKETS EN ATTENTE', 1, 1, 22),
(452, 'VSV', 'VOIR SES PROPRES DETAILS VENTES', 1, 1, 22),
(453, 'VFTSR', 'AVOIR LA POSSIBILITE DE CHANGER DE SOUS-SITES', 1, 1, 22),
(454, 'CSR', 'CREATION DES SOUS-RESTO', 1, 0, 22),
(455, 'VTV', 'VOIR TOUTE LES VENTES', 1, 0, 22),
(456, 'AGS1', 'ACTIVER LA GESTION DE SERVEUR', 1, 1, 22),
(457, 'FCTRTN', 'PAYER UNE FACTURE', 1, 1, 23),
(458, 'FAFACTN', 'CREER FACTURE NORMALE\r\n', 1, 1, 27),
(459, 'FAFACTP', 'CREER FACTURE PROFORMA', 1, 1, 27),
(460, 'FAPAIE', 'EFFECTUER PAIEMENT', 1, 1, 27),
(461, 'FALPAIE', 'LISTER LES PAIEMENTS', 1, 1, 27),
(462, 'FAXTVA', 'CONSULTER EXTRAIT TVA', 1, 1, 27),
(463, 'FAXCPT', 'CONSULTER EXTRAIT DE COMPTE', 1, 1, 27),
(464, 'FAGCLT', 'GERER LES CLIENTS', 1, 1, 27),
(465, 'FAGART', 'GERER LES ARTICLES', 1, 1, 27),
(466, 'FACONFIG', 'CONFIGURER MODULE DE FACTURATION', 1, 1, 27),
(467, 'VMFACT', 'VOIR MODULE FACTURATION', 0, 1, 27),
(468, 'VMACH', 'VOIR MODULE ACHAT\r\n', 0, 1, 28),
(469, 'ACHLEB', 'VOR LISTE ETAT DE BESOINS', 1, 1, 28),
(470, 'ACHCEB', 'CREATION D\'UN ETAT DE BESOINS', 1, 1, 28),
(471, 'ACHILEB', 'IMPRESSION LISTE ETAT DE BESOINS', 1, 1, 28),
(472, 'ACHMEB', 'MODIFICATION D\'UN ETAT DE BESOINS', 1, 1, 28),
(473, 'ACHSEB', 'SUPPRESSION D\'UN ETAT DE BESOINS', 1, 1, 28),
(474, 'ACHLBC', 'VOIR LISTE BON DE COMMANDES', 1, 1, 28),
(475, 'ACHCBC', 'CREATION D\'UN BON DE COMMANDES', 1, 1, 28),
(476, 'ACHILBC', 'IMPRESSION LISTE BON DE COMMANDES', 1, 1, 28),
(477, 'ACHMBC', 'MODIFICATION D\'UN BON DE COMMANDES', 1, 1, 28),
(478, 'ACHSBC', 'SUPPRESSION D\'UN BON DE COMMANDES', 1, 1, 28),
(479, 'ACHEDPBC', 'ENVOI DEMANDE DE PAIEMENT D\'UN BON DE COMMANDES', 1, 1, 28),
(480, 'ACHAEB', 'APPROUVER UN ETAT DE BESOINS', 1, 1, 28),
(481, 'ACHREB', 'REJETER UN ETAT DE BESOINS', 1, 1, 28),
(482, 'ACHLPBC', 'VOIR LISTE PAIEMENT DE BON DE COMMANDES', 1, 1, 28),
(483, 'ACHRDP', 'RENVOYER DEMANDE PAIEMENT D\'UN BON DE COMMANDES', 1, 1, 28),
(484, 'ACHLL', 'VOIR LA LISTE DE LIVRAISONS', 1, 1, 28),
(485, 'ACHEL', 'ENREGISTRER UNE LIVRAISON', 1, 1, 28),
(486, 'ACHIL', 'IMPRESSION LISTE DE LIVRAISONS', 1, 1, 28),
(487, 'ACHML', 'MODIFICATION D\'UNE LIVRAISON', 1, 1, 28),
(488, 'ACHSL', 'SUPPRESSION D\'UNE LIVRAISON', 1, 1, 28),
(489, 'ACHLF', 'VOIR LA LISTE DE FOURNISSEURS', 1, 1, 28),
(490, 'ACHCF', 'CREATION D\'UN FOURNISSEUR', 1, 1, 28),
(491, 'ACHILF', 'IMPRESSION LISTE FOURNISSEURS', 1, 1, 28),
(493, 'AR13', 'VOIR LA FICHE DE STOCK', 1, 1, 22),
(494, 'AR14', 'VOIR LE TABLEAU DE BORD PRINCIPAL', 1, 1, 22),
(495, 'AR15', 'AJOUTER ET MODIFIER CLIENT', 1, 1, 22),
(496, 'AR16', 'SUPPRIMER CLIENT', 1, 1, 22),
(497, 'HVPL1', 'VOIR LE PLANNING', 1, 1, 23),
(498, 'HMNNTE', 'MODIFIER NOMBRE NUITEE', 1, 1, 23),
(499, 'HIFC', 'INSERER FONDS DE CAISSE', 1, 1, 23),
(500, 'HLTVMT', 'VOIR LA LISTE DE TOUS LES VERSEMENTS', 1, 1, 23),
(501, 'HENRVSM', 'ENREGISTRER UN VERSEMENT', 1, 1, 23),
(502, 'HVTBP', 'VOIR LE TABLEAU DE BORD PRINCIPAL', 1, 1, 23),
(503, 'HFCT', 'FAIRE LA CONFIGURATION', 1, 1, 23),
(505, 'HDTV', 'VOIR DETAILS VENTE', 1, 1, 23),
(563, 'VMPOS', 'VOIR MODULE POS', 0, 1, 29),
(564, 'RM', 'REMISE COMMANDE', 1, 1, 29),
(565, 'RV', 'VOIR TOUS LES DETAILS VENTES', 1, 1, 29),
(566, 'V', 'VENTE', 1, 0, 29),
(567, 'VTCR', 'VOIR TOUTES LES FACTURES', 1, 1, 29),
(568, 'VSPCER', 'VOIR SES PROPRES FACTURES ENREGISTREES', 1, 1, 29),
(569, 'VTVS', 'VOIR TOUS LES VERSEMENTS', 1, 1, 29),
(570, 'VSPVS', 'VOIR SES PROPRES VERSEMENTS', 1, 1, 29),
(571, 'AR3', 'METTRE COMMANDE EN ATTENTE', 1, 1, 29),
(572, 'AR4', 'ENREGISTRER PAIEMENT FACTURE', 1, 1, 29),
(573, 'AR5', 'ANNULER COMMANDE', 1, 1, 29),
(574, 'AR6', 'VOIR CLIENTS', 1, 1, 29),
(575, 'AR7', 'VOIR TOUS LES TICKETS EN ATTENTE', 1, 1, 29),
(576, 'AR8', 'VOIR PRODUITS EN RUPTURE DE STOCK', 1, 0, 29),
(577, 'AR9', 'ENREGISTRER VERSEMENT CAISSE', 1, 1, 29),
(578, 'AR10', 'MODIFIER INFOS SOUS-SITE', 1, 1, 29),
(579, 'AR11', 'MODIFIER QUANTITE PRODUIT', 1, 1, 29),
(580, 'AR12', 'SUPPRIMER PRODUIT COMMANDE', 1, 1, 29),
(581, 'VSPTA', 'VOIR SES PROPRES TICKETS EN ATTENTE', 1, 1, 29),
(582, 'VSV', 'VOIR SES PROPRES DETAILS VENTES', 1, 1, 29),
(583, 'VFTSR', 'AVOIR LA POSSIBILITE DE CHANGER DE SOUS-SITES', 1, 1, 29),
(584, 'CSR', 'CREATION DES SOUS-RESTO', 1, 0, 29),
(585, 'VTV', 'VOIR TOUTE LES VENTES', 1, 0, 29),
(586, 'AGS1', 'ACTIVER LA GESTION DE SERVEUR', 1, 1, 29),
(587, 'AR13', 'VOIR LA FICHE DE STOCK', 1, 1, 29),
(588, 'AR14', 'VOIR LE TABLEAU DE BORD PRINCIPAL', 1, 1, 29),
(589, 'AR15', 'AJOUTER ET MODIFIER CLIENT', 1, 1, 29),
(590, 'AR16', 'SUPPRIMER CLIENT', 1, 1, 29),
(592, 'VMC', 'VOIR MODULE COMPTABILITE', 0, 1, 21),
(593, 'CPTACCESSCOMPTA', 'ACCEDER A LA COMPTABILITE', 1, 1, 21),
(594, 'CPTMODIFTRES', 'MODIFIER LES ENCAISSEMENTS ET LES DECAISSEMENTS', 1, 1, 21),
(595, 'CPTSUPPRTRES', 'SUPPRIMER LES ENCAISSEMENTS ET LES DECAISSEMENTS', 1, 1, 21),
(596, 'CPTJC', 'VOIR JOURNAL DE CAISSE ET PAS LES AUTRES JOURNAUX', 1, 1, 21),
(597, 'CPTTRESOR', 'ACCEDER A LA TRESORERIE', 1, 1, 21),
(598, 'CPTAJOUTTRES', 'AJOUTER LES ENCAISSEMENTS ET LES DECAISSEMENTS', 1, 1, 21),
(599, 'CPTLISTJOURN', 'LISTE DES JOURNAUX', 1, 1, 21),
(600, 'CPTJOURNLSR', 'JOURNALISER', 1, 1, 21),
(601, 'TBLOCP', 'VOIR SEULEMENT LES TABLES OCCUPEES', 1, 1, 22),
(604, 'EFDEP', 'EFFECTUER DEPENSE', 1, 1, 22),
(605, 'VSPTOCC', 'VOIR SES PROPRES TABLES OCCUPEES', 1, 1, 22),
(606, 'VLISTCOUVER', 'VOIR LISTE DE COUVERTS', 1, 1, 22),
(607, 'FDCRESTO', 'FONDS DE CAISSE', 1, 1, 22),
(608, 'VTOUTESTABL', 'VOIR TABLES SERVEURS', 1, 1, 22),
(609, 'VCLCONS', 'VOIR SEULEMENT LES CLIENTS QUI CONSOMMENT', 1, 1, 22),
(610, 'VSCQOC', 'VOIR SEULEMENT LES CLIENTS QUI ONT COMMANDE', 1, 1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `actions_groupe`
--

DROP TABLE IF EXISTS `actions_groupe`;
CREATE TABLE IF NOT EXISTS `actions_groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL,
  `action_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=386 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actions_groupe`
--

INSERT INTO `actions_groupe` (`id`, `group_id`, `action_id`) VALUES
(288, 5, 377),
(289, 5, 381),
(290, 5, 407),
(291, 5, 408),
(292, 5, 378),
(293, 5, 382),
(294, 5, 386),
(295, 5, 379),
(296, 5, 383),
(297, 5, 375),
(298, 5, 376),
(299, 5, 346),
(300, 5, 385),
(301, 5, 384),
(302, 5, 380),
(303, 6, 345),
(304, 6, 495),
(305, 6, 406),
(306, 6, 424),
(307, 6, 402),
(308, 6, 453),
(309, 6, 604),
(310, 6, 423),
(311, 6, 428),
(312, 6, 607),
(313, 6, 420),
(314, 6, 421),
(315, 6, 422),
(316, 6, 429),
(317, 6, 430),
(318, 6, 419),
(319, 6, 403),
(320, 6, 401),
(321, 6, 496),
(322, 6, 431),
(323, 6, 425),
(324, 6, 493),
(325, 6, 494),
(326, 6, 606),
(327, 6, 409),
(328, 6, 345),
(329, 6, 404),
(330, 6, 426),
(331, 6, 417),
(332, 6, 415),
(353, 4, 424),
(354, 4, 421),
(355, 4, 430),
(356, 4, 431),
(357, 4, 425),
(358, 4, 409),
(359, 4, 345),
(360, 4, 608),
(373, 3, 424),
(374, 3, 604),
(375, 3, 423),
(376, 3, 428),
(377, 3, 420),
(378, 3, 403),
(379, 3, 345),
(380, 3, 609),
(381, 3, 610),
(382, 3, 601),
(383, 3, 404),
(384, 3, 426),
(385, 3, 415);

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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compteur`
--

INSERT INTO `compteur` (`id`, `libelle`, `numero`, `id_sousresto`, `site_id`) VALUES
(299, 'souscription', 14, NULL, 0),
(300, 'BE_STK', 238, NULL, 356),
(301, 'restaurant', 561, NULL, 356),
(302, 'restoR', 232, NULL, 356),
(303, 'BS_STK', 369, NULL, 356),
(304, 'BV', 10, 123, NULL),
(305, 'depense', 3, NULL, 356);

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
  PRIMARY KEY (`id_con`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=765 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`id_con`, `date_con`, `date_decon`, `id_user`) VALUES
(1, '2018-11-08 17:54:21', '2018-11-08 19:56:26', 400),
(2, '2018-11-08 17:56:30', '2018-11-08 19:57:27', 400),
(3, '2018-11-08 17:59:18', '2018-11-08 20:00:35', 400),
(4, '2018-11-08 18:09:42', '2018-11-08 20:10:22', 400),
(5, '2018-11-08 18:10:28', '2018-11-08 20:15:27', 400),
(6, '2018-11-08 18:15:33', '2018-11-08 20:16:04', 400),
(7, '2018-11-08 18:16:07', '2018-11-08 20:16:51', 400),
(8, '2018-11-09 12:26:14', '2018-11-09 14:26:20', 400),
(9, '2018-11-09 12:26:53', '2018-11-09 14:27:00', 400),
(10, '2018-11-09 14:08:15', '2018-11-09 16:09:53', 400),
(11, '2018-11-13 17:25:27', '2018-11-13 18:35:41', 404),
(12, '2018-11-13 17:42:16', '2018-11-13 18:46:28', 408),
(13, '2018-11-13 18:18:39', '2018-12-13 19:40:13', 410),
(14, '2018-12-13 18:40:45', '2018-12-13 19:52:17', 410),
(15, '2018-12-13 18:52:28', '2018-12-13 19:53:05', 410),
(16, '2018-12-13 19:08:44', '2018-12-13 20:11:09', 410),
(17, '2018-12-13 19:11:15', '2018-12-13 20:13:51', 410),
(18, '2018-12-13 19:13:57', '2018-12-13 20:14:31', 410),
(19, '2018-12-13 19:14:41', '2018-12-13 20:15:24', 410),
(20, '2018-12-13 19:26:00', '2018-11-16 15:15:33', 411),
(21, '2018-11-16 16:00:06', '2018-11-16 16:01:19', 422),
(22, '2018-11-16 16:01:28', '2018-11-16 16:04:17', 422),
(23, '2018-11-16 16:05:12', '2018-11-16 16:05:47', 422),
(24, '2018-11-16 16:21:17', '2018-11-16 16:28:46', 422),
(25, '2018-11-16 16:35:12', '2018-11-16 16:37:17', 422),
(26, '2018-11-16 16:40:38', '2018-11-16 16:42:46', 422),
(27, '2018-11-16 18:37:05', '2018-12-17 18:59:32', 424),
(28, '2018-12-17 19:05:04', '2019-01-15 19:17:13', 424),
(29, '2018-11-20 16:04:01', '2018-12-16 16:09:52', 427),
(30, '2018-12-16 16:10:47', '2018-12-29 16:37:14', 427),
(31, '2018-12-29 16:57:44', '2018-12-29 16:59:41', 427),
(32, '2018-12-29 17:00:03', '2019-01-26 17:00:56', 427),
(33, '2019-02-05 17:06:37', '2019-02-05 17:07:35', 427),
(34, '2019-02-05 17:07:50', '2019-02-05 19:07:31', 427),
(35, '2019-02-05 19:10:04', '2019-02-26 19:23:24', 428),
(36, '2019-02-26 19:24:04', '2019-03-15 19:28:30', 428),
(37, '2019-03-15 19:28:38', '2019-04-12 18:49:46', 428),
(38, '2019-04-12 18:50:51', '2019-04-25 18:52:59', 428),
(39, '2018-11-21 15:22:18', '2018-11-21 17:17:31', 428),
(40, '2018-11-21 17:25:55', '2018-11-21 17:59:12', 428),
(41, '2018-11-21 18:07:46', '2018-11-22 10:09:07', 431),
(42, '2018-11-21 18:07:46', '2018-11-22 10:09:15', 431),
(43, '2018-11-22 10:12:54', '2018-11-22 10:38:11', 428),
(44, '2018-11-22 10:42:31', '2018-11-22 13:33:39', 428),
(45, '2018-11-23 10:13:29', '2018-11-23 10:20:11', 428),
(46, '2018-11-23 13:37:57', '2018-11-23 15:24:41', 433),
(47, '2018-11-23 15:24:55', '2018-11-23 15:25:07', 434),
(48, '2018-11-23 15:25:29', '2018-11-23 15:38:13', 433),
(49, '2018-11-23 15:38:25', '2018-11-23 15:41:03', 437),
(50, '2018-11-23 15:41:20', '2018-11-23 15:41:20', 437),
(51, '2018-11-23 15:41:47', '2018-11-23 15:41:48', 437),
(52, '2018-11-23 15:42:10', '2018-11-23 15:42:11', 437),
(53, '2018-11-23 15:42:29', '2018-11-23 15:43:01', 433),
(54, '2018-11-23 15:44:03', '2018-11-23 15:44:13', 433),
(55, '2018-11-23 15:44:31', '2018-11-23 15:59:08', 433),
(56, '2018-11-23 15:59:27', '2018-11-23 16:18:29', 434),
(57, '2018-11-24 09:11:15', '2018-11-24 11:58:21', 428),
(58, '2018-11-24 12:02:02', '2018-11-24 12:04:04', 439),
(59, '2018-11-24 12:04:19', '2018-11-24 12:05:34', 428),
(60, '2018-11-24 12:05:39', '2018-11-24 12:05:52', 439),
(61, '2018-11-24 12:05:58', '2018-11-24 12:17:10', 428),
(62, '2018-11-24 12:17:17', '2018-11-24 13:08:05', 428),
(63, '2018-11-24 13:14:48', '2018-11-26 07:30:25', 428),
(64, '2018-11-26 14:33:59', '2018-11-26 15:04:04', 428),
(65, '2018-11-26 15:04:32', '2018-11-26 15:34:35', 428),
(66, '2018-11-27 15:43:39', '2018-11-27 16:43:48', 428),
(67, '2018-11-28 14:34:55', '2018-11-28 18:44:06', 428),
(68, '2018-11-29 11:40:54', '2018-12-03 11:54:13', 428),
(69, '2018-12-03 11:54:30', '2018-12-03 11:54:37', 428),
(70, '2018-12-03 11:57:03', '2018-12-03 11:57:10', 428),
(71, '2018-12-03 11:57:38', '2018-12-03 11:57:41', 428),
(72, '2018-12-03 11:58:23', '2018-12-03 12:00:02', 428),
(73, '2018-12-03 12:00:11', '2018-12-03 12:00:15', 428),
(74, '2018-12-03 12:00:36', '2018-12-03 12:03:31', 428),
(75, '2018-12-03 12:04:01', '2018-12-03 12:09:46', 428),
(76, '2018-12-03 12:09:56', '2018-12-03 12:09:59', 428),
(77, '2018-12-03 12:10:31', '2018-12-03 12:10:36', 428),
(78, '2018-12-03 12:13:00', '2018-12-03 12:13:04', 428),
(79, '2018-12-03 12:14:41', '2018-12-03 12:14:44', 428),
(80, '2018-12-03 12:20:28', '2018-12-03 12:20:37', 428),
(81, '2018-12-03 12:26:28', '2018-12-03 12:28:05', 428),
(82, '2018-12-03 12:28:15', '2018-12-03 12:28:18', 428),
(83, '2018-12-03 12:30:21', '2018-12-03 12:37:04', 428),
(84, '2018-12-03 13:07:28', '2018-12-03 13:15:35', 428),
(85, '2018-12-03 13:15:51', '2018-12-03 13:15:53', 428),
(86, '2018-12-03 13:17:28', '2018-12-03 13:26:43', 428),
(87, '2018-12-03 13:26:56', '2018-12-03 13:26:59', 428),
(88, '2018-12-03 13:27:34', '2018-12-03 13:33:00', 428),
(89, '2018-12-03 13:33:13', '2018-12-03 13:34:42', 428),
(90, '2018-12-03 13:34:54', '2018-12-03 13:53:17', 428),
(91, '2018-12-03 13:53:30', '2018-12-03 13:57:45', 428),
(92, '2018-12-03 13:58:00', '2018-12-03 13:59:20', 428),
(93, '2018-12-03 13:59:26', '2018-12-03 14:02:02', 428),
(94, '2018-12-03 14:02:06', '2018-12-03 14:05:10', 428),
(95, '2018-12-03 14:05:13', '2018-12-03 14:06:48', 428),
(96, '2018-12-03 14:06:53', '2018-12-03 14:09:19', 428),
(97, '2018-12-03 14:09:23', '2018-12-03 14:14:19', 428),
(98, '2018-12-03 14:14:23', '2018-12-03 14:15:32', 428),
(99, '2018-12-03 14:15:36', '2018-12-03 14:20:37', 428),
(100, '2018-12-03 14:20:40', '2018-12-03 14:23:06', 428),
(101, '2018-12-03 14:23:10', '2018-12-03 14:25:21', 428),
(102, '2018-12-03 17:14:16', '2018-12-03 17:46:00', 428),
(103, '2018-12-03 18:28:18', '2018-12-03 18:45:10', 428),
(104, '2018-12-04 15:57:10', '2018-12-04 15:57:55', 428),
(105, '2018-12-04 15:58:16', '2018-12-04 17:04:37', 428),
(106, '2018-12-04 17:12:02', '2018-12-05 10:27:59', 428),
(107, '2018-12-05 14:39:42', '2018-12-05 14:46:43', 428),
(108, '2018-12-05 14:46:53', '2018-12-05 14:46:56', 428),
(109, '2018-12-05 14:48:41', '2018-12-05 14:52:44', 428),
(110, '2018-12-05 14:52:47', '2018-12-05 14:55:06', 428),
(111, '2018-12-05 14:55:09', '2018-12-05 14:56:48', 428),
(112, '2018-12-05 16:25:09', '2018-12-05 17:19:05', 428),
(113, '2018-12-05 17:19:23', '2018-12-06 11:04:13', 428),
(114, '2018-12-06 11:04:18', '2018-12-07 11:25:28', 428),
(115, '2018-12-10 10:29:08', '2018-12-11 15:10:09', 428),
(116, '2018-12-11 15:10:13', '2018-12-11 17:22:08', 428),
(117, '2018-12-11 17:22:23', '2018-12-12 10:48:00', 428),
(118, '2018-12-12 10:48:03', '2018-12-13 16:00:36', 428),
(119, '2018-12-13 16:00:40', '2018-12-13 20:26:38', 428),
(120, '2018-12-13 20:26:41', '2018-12-14 11:20:33', 428),
(121, '2018-12-14 11:20:37', '2018-12-14 15:25:40', 428),
(122, '2018-12-14 15:25:46', '2018-12-14 15:31:01', 428),
(123, '2018-12-14 15:33:47', '2018-12-14 15:39:01', 440),
(124, '2018-12-14 15:39:28', '2018-12-14 15:44:26', 440),
(125, '2018-12-17 13:13:13', '2018-12-17 13:39:16', 428),
(126, '2018-12-17 13:42:04', '2018-12-17 13:42:39', 441),
(127, '2018-12-17 13:42:43', '2018-12-17 13:45:20', 428),
(128, '2018-12-17 13:47:08', '2018-12-17 15:13:04', 428),
(129, '2018-12-17 15:24:23', '2018-12-17 15:24:34', 441),
(130, '2018-12-17 15:25:29', '2018-12-17 15:27:07', 428),
(131, '2018-12-17 15:27:21', '2018-12-17 15:27:48', 441),
(132, '2018-12-17 15:27:52', '2018-12-17 15:30:52', 428),
(133, '2018-12-17 15:31:01', '2018-12-18 06:16:27', 441),
(134, '2018-12-18 12:17:06', '2018-12-18 13:08:10', 428),
(135, '2018-12-18 13:08:14', '2018-12-18 13:10:17', 428),
(136, '2018-12-18 13:10:33', '2018-12-18 13:19:48', 441),
(137, '2018-12-18 13:19:51', '2018-12-18 13:23:53', 428),
(138, '2018-12-18 13:24:03', '2018-12-18 13:24:09', 428),
(139, '2018-12-18 13:24:20', '2018-12-18 13:31:37', 441),
(140, '2018-12-18 13:31:42', '2018-12-18 21:51:34', 428),
(141, '2018-12-18 21:51:40', '2018-12-19 15:32:22', 428),
(142, '2018-12-19 16:05:38', '2018-12-19 19:22:57', 428),
(143, '2018-12-20 06:22:42', '2018-12-20 07:11:36', 428),
(144, '2018-12-20 13:12:26', '2018-12-24 06:48:28', 428),
(145, '2018-12-24 06:48:34', '2018-12-24 08:24:38', 428),
(146, '2018-12-24 09:03:13', '2018-12-24 09:11:48', 428),
(147, '2018-12-24 09:12:02', '2018-12-24 15:06:15', 441),
(148, '2018-12-24 15:06:20', '2018-12-24 15:07:24', 428),
(149, '2018-12-24 15:07:41', '2018-12-25 13:46:51', 441),
(150, '2018-12-25 13:46:55', '2018-12-25 13:52:05', 428),
(151, '2018-12-25 13:52:17', '2018-12-25 13:58:36', 441),
(152, '2018-12-25 13:58:43', '2018-12-25 13:59:38', 428),
(153, '2018-12-25 13:59:45', '2018-12-25 14:01:08', 442),
(154, '2018-12-25 14:01:17', '2018-12-25 14:01:40', 428),
(155, '2018-12-25 14:01:44', '2018-12-25 14:18:20', 442),
(156, '2018-12-25 14:18:30', '2018-12-26 08:04:27', 428),
(157, '2018-12-26 08:04:37', '2018-12-26 08:08:16', 442),
(158, '2018-12-26 08:08:24', '2018-12-26 08:12:38', 428),
(159, '2018-12-26 08:12:55', '2018-12-26 08:14:49', 441),
(160, '2018-12-26 08:14:58', '2018-12-26 08:17:01', 442),
(161, '2018-12-26 08:17:23', '2018-12-26 09:03:09', 428),
(162, '2018-12-26 09:03:22', '2018-12-26 12:54:11', 428),
(163, '2018-12-26 12:54:30', '2018-12-26 12:54:56', 441),
(164, '2018-12-26 12:55:06', '2018-12-26 12:55:46', 428),
(165, '2018-12-26 13:07:41', '2018-12-26 13:08:13', 441),
(166, '2018-12-26 13:08:18', '2018-12-26 13:13:13', 442),
(167, '2018-12-26 13:13:20', '2018-12-26 13:14:46', 428),
(168, '2018-12-26 13:14:56', '2018-12-26 13:29:53', 442),
(169, '2018-12-26 13:30:13', '2018-12-26 13:44:44', 428),
(170, '2018-12-26 13:44:55', '2018-12-26 13:46:47', 428),
(171, '2018-12-26 13:46:52', '2018-12-26 13:55:25', 442),
(172, '2018-12-26 13:55:35', '2018-12-26 13:55:54', 428),
(173, '2018-12-26 13:56:00', '2018-12-26 13:59:09', 442),
(174, '2018-12-26 13:59:21', '2018-12-26 14:01:07', 428),
(175, '2018-12-26 14:01:12', '2018-12-26 14:01:19', 442),
(176, '2018-12-26 14:01:38', '2018-12-26 14:02:11', 441),
(177, '2018-12-26 14:02:19', '2018-12-26 14:02:57', 428),
(178, '2018-12-26 14:03:07', '2018-12-26 14:03:27', 442),
(179, '2018-12-26 14:03:53', '2018-12-26 14:14:11', 441),
(180, '2018-12-26 14:14:21', '2018-12-26 14:15:28', 428),
(181, '2018-12-26 14:15:33', '2018-12-26 14:15:40', 442),
(182, '2018-12-26 14:15:56', '2018-12-27 11:00:55', 441),
(183, '2018-12-27 11:01:04', '2018-12-28 09:18:56', 428),
(184, '2018-12-28 09:19:03', '2018-12-29 09:01:35', 428),
(185, '2018-12-29 09:01:43', '2018-12-29 16:29:18', 428),
(186, '2018-12-29 16:29:27', '2018-12-30 19:01:52', 428),
(187, '2018-12-31 07:22:59', '2019-01-02 13:44:54', 428),
(188, '2019-01-03 07:28:51', '2019-01-03 07:45:21', 428),
(189, '2019-01-03 07:45:31', '2019-01-07 14:11:42', 428),
(190, '2019-01-07 14:12:27', '2019-01-07 14:14:43', 428),
(191, '2019-01-07 14:14:55', '2019-01-07 14:21:09', 428),
(192, '2019-01-07 14:21:54', '2019-01-07 14:25:13', 428),
(193, '2019-01-07 14:26:04', '2019-01-07 14:29:09', 428),
(194, '2019-01-07 14:30:28', '2019-01-07 14:30:46', 428),
(195, '2019-01-07 14:30:55', '2019-01-07 14:31:25', 428),
(196, '2019-01-07 14:31:41', '2019-01-07 14:32:02', 428),
(197, '2019-01-07 14:34:07', '2019-01-07 14:34:20', 428),
(198, '2019-01-07 14:35:37', '2019-01-07 14:36:12', 428),
(199, '2019-01-07 14:37:15', '2019-01-07 14:43:05', 428),
(200, '2019-01-07 14:43:48', '2019-01-07 16:15:49', 428),
(201, '2019-01-07 16:49:06', '2019-01-07 17:19:11', 428),
(202, '2019-01-07 18:14:14', '2019-01-07 18:51:49', 428),
(203, '2019-01-07 18:52:11', '2019-01-07 18:56:30', 441),
(204, '2019-01-07 18:56:48', '2019-01-07 18:59:33', 428),
(205, '2019-01-07 18:59:51', '2019-01-07 19:11:58', 441),
(206, '2019-01-07 19:12:04', '2019-01-07 19:13:57', 442),
(207, '2019-01-07 19:14:22', '2019-01-07 19:32:31', 441),
(208, '2019-01-07 19:32:41', '2019-01-07 19:33:29', 428),
(209, '2019-01-07 19:33:33', '2019-01-07 19:35:37', 442),
(210, '2019-01-07 19:35:45', '2019-01-07 19:59:44', 428),
(211, '2019-01-07 20:00:16', '2019-01-07 20:01:31', 441),
(212, '2019-01-14 09:42:58', '2019-01-14 10:40:16', 428),
(213, '2019-01-14 10:40:26', '2019-01-14 10:40:45', 428),
(214, '2019-01-14 10:40:52', '2019-01-14 10:43:26', 428),
(215, '2019-01-14 10:43:34', '2019-01-14 10:49:54', 441),
(216, '2019-01-14 10:50:03', '2019-01-14 10:54:02', 442),
(217, '2019-01-14 10:54:09', '2019-01-14 11:01:04', 428),
(218, '2019-01-14 11:01:12', '2019-01-14 11:05:34', 428),
(219, '2019-01-14 11:05:43', '2019-01-14 11:06:55', 428),
(220, '2019-01-14 11:12:54', '2019-01-14 12:39:21', 443),
(221, '2019-01-14 12:39:28', '2019-01-14 12:45:13', 443),
(222, '2019-01-14 12:45:28', '2019-01-14 12:47:42', 444),
(223, '2019-01-14 12:48:59', '2019-01-14 12:49:09', 444),
(224, '2019-01-14 12:49:14', '2019-01-14 12:57:17', 443),
(225, '2019-01-14 12:57:25', '2019-01-14 12:59:18', 443),
(226, '2019-01-14 12:59:25', '2019-01-14 13:06:39', 444),
(227, '2019-01-14 13:06:46', '2019-01-14 13:15:30', 444),
(228, '2019-01-14 13:15:38', '2019-01-14 13:26:44', 443),
(229, '2019-01-14 13:26:54', '2019-01-14 13:27:57', 444),
(230, '2019-01-14 13:28:04', '2019-01-14 13:29:58', 443),
(231, '2019-01-14 13:30:03', '2019-01-14 13:32:18', 444),
(232, '2019-01-14 13:32:25', '2019-01-14 13:34:57', 443),
(233, '2019-01-14 13:35:01', '2019-01-14 13:54:19', 444),
(234, '2019-01-14 13:54:30', '2019-01-14 14:04:09', 445),
(235, '2019-01-14 14:04:16', '2019-01-14 14:48:03', 443),
(236, '2019-01-14 14:48:14', '2019-01-14 14:54:14', 443),
(237, '2019-01-14 14:54:24', '2019-01-14 15:09:38', 443),
(238, '2019-01-14 15:09:43', '2019-01-14 15:16:00', 443),
(239, '2019-01-14 15:16:08', '2019-01-14 15:53:55', 443),
(240, '2019-01-14 15:16:08', '2019-01-14 15:53:56', 443),
(241, '2019-01-14 16:17:10', '2019-01-14 18:45:22', 444),
(242, '2019-01-14 18:46:21', '2019-01-14 19:03:07', 443),
(243, '2019-01-14 19:03:14', '2019-01-14 19:54:05', 444),
(244, '2019-01-14 19:56:08', '2019-01-15 00:25:05', 443),
(245, '2019-01-15 10:44:33', '2019-01-15 11:43:17', 443),
(246, '2019-01-15 11:43:29', '2019-01-15 12:13:42', 444),
(247, '2019-01-15 12:13:47', '2019-01-15 12:14:36', 444),
(248, '2019-01-15 12:14:42', '2019-01-15 12:15:01', 443),
(249, '2019-01-15 12:15:09', '2019-01-15 12:19:43', 444),
(250, '2019-01-15 12:19:51', '2019-01-15 12:20:06', 444),
(251, '2019-01-15 12:20:17', '2019-01-15 12:21:46', 443),
(252, '2019-01-15 12:21:53', '2019-01-15 12:23:03', 444),
(253, '2019-01-15 12:23:10', '2019-01-15 12:23:33', 444),
(254, '2019-01-15 12:23:37', '2019-01-15 13:08:32', 444),
(255, '2019-01-15 13:10:50', '2019-01-15 15:27:44', 443),
(256, '2019-01-15 15:28:39', '2019-01-15 16:12:29', 443),
(257, '2019-01-15 16:17:40', '2019-01-15 16:35:30', 443),
(258, '2019-01-15 16:35:37', '2019-01-15 17:01:50', 444),
(259, '2019-01-15 17:01:54', '2019-01-15 17:03:48', 444),
(260, '2019-01-15 17:03:53', '2019-01-15 20:46:43', 443),
(261, '2019-01-16 17:49:54', '2019-01-18 10:06:10', 443),
(262, '2019-01-18 10:06:16', '2019-01-18 10:18:24', 443),
(263, '2019-01-18 10:18:31', '2019-01-18 10:19:04', 443),
(264, '2019-01-18 10:19:13', '2019-01-18 10:31:42', 443),
(265, '2019-01-18 11:15:41', '2019-01-18 11:16:43', 443),
(266, '2019-01-18 11:16:52', '2019-01-18 11:20:49', 443),
(267, '2019-01-18 11:20:56', '2019-01-18 12:39:52', 443),
(268, '2019-01-18 12:41:40', '2019-01-19 10:01:45', 443),
(269, '2019-01-21 10:53:01', '2019-01-21 11:52:04', 443),
(270, '2019-01-21 12:43:26', '2019-01-21 13:55:50', 443),
(271, '2019-01-21 13:55:58', '2019-01-21 13:57:13', 444),
(272, '2019-01-21 13:57:22', '2019-01-21 13:57:45', 443),
(273, '2019-01-21 13:58:01', '2019-01-21 13:59:14', 445),
(274, '2019-01-21 13:59:20', '2019-01-21 14:04:22', 443),
(275, '2019-01-21 14:04:28', '2019-01-22 15:46:25', 443),
(276, '2019-01-21 14:04:28', '2019-01-22 19:15:15', 443),
(277, '2019-01-22 19:15:23', '2019-01-28 11:25:52', 443),
(278, '2019-01-28 15:45:34', '2019-01-28 15:59:47', 443),
(279, '2019-01-28 16:01:09', '2019-01-29 13:03:36', 443),
(280, '2019-01-30 12:40:48', '2019-01-30 12:44:54', 443),
(281, '2019-01-30 12:45:00', '2019-01-30 12:46:03', 443),
(282, '2019-01-30 12:46:11', '2019-01-30 12:46:23', 443),
(283, '2019-01-30 12:46:31', '2019-01-30 13:24:30', 443),
(284, '2019-02-01 12:27:29', '2019-02-01 12:35:34', 443),
(285, '2019-02-01 12:35:49', '2019-02-01 14:23:20', 443),
(286, '2019-02-01 14:23:31', '2019-02-01 14:23:47', 443),
(287, '2019-02-01 14:23:53', '2019-02-01 14:24:11', 444),
(288, '2019-02-01 14:24:18', '2019-02-03 04:45:45', 443),
(289, '2019-02-04 10:55:54', '2019-02-05 15:08:44', 443),
(290, '2019-02-06 10:46:54', '2019-02-08 17:16:41', 443),
(291, '2019-02-08 17:17:40', '2019-02-07 17:23:11', 443),
(292, '2019-02-07 20:32:39', '2019-02-08 14:04:17', 443),
(293, '2019-02-08 14:04:28', '2019-02-08 17:12:26', 443),
(294, '2019-02-08 17:12:33', '2019-02-13 15:13:32', 443),
(295, '2019-02-11 13:05:50', '2019-02-11 14:24:54', 443),
(296, '2019-02-11 14:25:02', '2019-02-12 11:39:49', 443),
(297, '2019-02-12 11:40:01', '2019-02-12 15:24:37', 443),
(298, '2019-02-12 15:24:44', '2019-02-12 15:58:15', 443),
(299, '2019-02-12 15:58:21', '2019-02-12 15:58:56', 446),
(300, '2019-02-12 15:59:08', '2019-02-12 16:02:57', 443),
(301, '2019-02-12 16:10:38', '2019-02-13 17:07:10', 443),
(302, '2019-02-14 12:36:46', '2019-02-14 12:52:44', 443),
(303, '2019-02-14 12:52:50', '2019-02-14 13:12:29', 443),
(304, '2019-02-14 13:12:43', '2019-02-14 13:32:16', 443),
(305, '2019-02-14 13:32:21', '2019-02-14 13:45:29', 443),
(306, '2019-02-14 13:51:04', '2019-02-14 14:45:28', 448),
(307, '2019-02-14 14:45:37', '2019-02-14 10:40:29', 448),
(308, '2019-02-18 14:02:25', '2019-02-18 14:23:14', 443),
(309, '2019-02-18 14:23:23', '2019-02-18 14:40:28', 443),
(310, '2019-02-18 14:40:34', '2019-02-19 10:34:56', 443),
(311, '2019-02-19 16:51:04', '2019-02-20 11:56:54', 443),
(312, '2019-02-20 11:57:01', '2019-02-20 12:14:06', 443),
(313, '2019-02-20 12:14:13', '2019-02-20 12:25:38', 443),
(314, '2019-02-20 14:50:08', '2019-02-20 17:06:27', 443),
(315, '2019-02-20 17:06:33', '2019-02-20 17:17:28', 443),
(316, '2019-02-20 17:21:02', '2019-02-20 19:15:52', 443),
(317, '2019-02-20 19:43:07', '2019-02-20 20:28:13', 443),
(318, '2019-02-20 20:45:56', '2019-02-20 20:49:04', 443),
(319, '2019-02-20 20:49:10', '2019-02-20 20:51:31', 443),
(320, '2019-02-20 21:01:47', '2019-02-20 21:03:07', 443),
(321, '2019-02-20 21:03:19', '2019-02-20 21:03:24', 443),
(322, '2019-02-20 21:04:02', '2019-02-20 21:06:33', 442),
(323, '2019-02-20 21:06:41', '2019-02-20 21:07:38', 444),
(324, '2019-02-20 21:07:44', '2019-02-20 21:08:22', 444),
(325, '2019-02-20 21:09:53', '2019-02-20 21:11:12', 443),
(326, '2019-02-20 21:11:21', '2019-02-20 21:12:44', 451),
(327, '2019-02-21 10:18:57', '2019-02-21 10:34:28', 443),
(328, '2019-02-21 10:34:36', '2019-02-21 10:36:48', 443),
(329, '2019-02-21 10:36:57', '2019-02-21 10:37:38', 451),
(330, '2019-02-21 10:38:18', '2019-02-21 10:38:22', 451),
(331, '2019-02-21 10:40:50', '2019-02-21 10:41:02', 451),
(332, '2019-02-21 11:29:46', '2019-02-21 11:34:08', 443),
(333, '2019-02-21 15:53:38', '2019-02-21 15:54:26', 443),
(334, '2019-02-26 11:19:42', '2019-02-26 11:29:54', 443),
(335, '2019-02-27 12:19:27', '2019-02-28 10:57:59', 455),
(336, '2019-03-04 11:02:53', '2019-03-04 14:53:30', 455),
(337, '2019-03-04 14:53:36', '2019-03-04 15:07:21', 455),
(338, '2019-03-04 15:07:27', '2019-03-04 15:10:22', 455),
(339, '2019-03-04 15:10:27', '2019-03-04 15:12:07', 455),
(340, '2019-03-04 15:12:17', '2019-03-04 15:14:13', 455),
(341, '2019-03-04 15:14:19', '2019-03-04 15:17:10', 455),
(342, '2019-03-07 10:33:49', '2019-03-08 10:50:02', 455),
(343, '2019-03-08 10:50:12', '2019-03-08 11:29:32', 455),
(344, '2019-03-13 11:11:57', '2019-03-13 11:29:24', 455),
(345, '2019-03-22 14:37:46', '2019-03-22 14:41:30', 455),
(346, '2019-03-22 14:41:37', '2019-03-22 14:45:03', 456),
(347, '2019-03-22 14:45:10', '2019-03-22 15:12:11', 455),
(348, '2019-03-25 09:20:21', '2019-03-30 15:59:41', 455),
(349, '2019-03-28 12:17:38', '2019-03-28 16:26:54', 455),
(350, '2019-03-28 16:40:05', '2019-03-28 16:40:44', 455),
(351, '2019-03-31 17:15:47', '2019-03-31 21:37:51', 455),
(352, '2019-04-01 18:40:13', '2019-04-01 22:34:38', 455),
(353, '2019-04-05 15:01:49', '2019-04-05 16:32:32', 455),
(354, '2019-04-05 17:00:30', '2019-04-05 17:00:37', 455),
(355, '2019-04-08 11:12:58', '2019-04-09 08:22:26', 455),
(356, '2019-04-11 11:14:43', '2019-04-11 14:16:38', 455),
(357, '2019-04-23 10:18:38', '2019-04-23 11:20:24', 455),
(358, '2019-05-13 15:15:58', '2019-05-13 19:07:29', 455),
(359, '2019-05-14 10:10:06', '2019-05-14 10:46:27', 455),
(360, '2019-05-14 12:57:07', '2019-05-14 15:37:44', 455),
(361, '2019-05-16 05:54:45', '2019-05-16 07:37:48', 455),
(362, '2019-05-16 05:54:45', '2019-05-16 07:37:49', 455),
(363, '2019-05-17 15:41:44', '2019-05-17 19:18:58', 455),
(364, '2019-05-17 19:19:22', '2019-05-17 19:40:46', 455),
(365, '2019-05-17 19:41:37', '2019-05-17 23:06:41', 455),
(366, '2019-05-18 08:07:20', '2019-05-18 15:41:59', 455),
(367, '2019-05-18 20:50:19', '2019-05-18 20:54:32', 455),
(368, '2019-05-21 07:24:15', '2019-05-21 20:22:04', 455),
(369, '2019-05-22 07:41:12', '2019-05-22 11:20:34', 455),
(370, '2019-05-25 12:32:37', '2019-05-25 15:34:12', 455),
(371, '2019-05-25 16:45:20', '2019-05-25 17:15:42', 455),
(372, '2019-05-25 17:15:49', '2019-05-25 22:07:15', 455),
(373, '2019-05-26 22:30:27', '2019-05-27 09:18:29', 455),
(374, '2019-05-26 22:30:27', '2019-05-27 09:18:29', 455),
(375, '2019-05-27 09:21:03', '2019-05-27 12:17:07', 455),
(376, '2019-05-27 12:18:15', '2019-05-27 19:01:22', 455),
(377, '2019-05-27 19:01:37', '2019-05-27 19:36:54', 455),
(378, '2019-05-27 19:47:08', '2019-05-27 21:05:44', 455),
(379, '2019-05-27 19:47:08', '2019-05-27 21:05:45', 455),
(380, '2019-05-27 21:08:48', '2019-05-27 22:14:02', 455),
(381, '2019-05-28 05:52:44', '2019-05-28 06:16:36', 455),
(382, '2019-05-28 06:16:44', '2019-05-28 06:22:29', 455),
(383, '2019-05-28 06:22:39', '2019-05-28 06:49:42', 455),
(384, '2019-05-28 06:49:56', '2019-05-28 09:51:45', 455),
(385, '2019-05-29 16:32:42', '2019-05-30 23:20:47', 455),
(386, '2019-05-31 00:35:53', '2019-06-02 10:22:28', 455),
(387, '2019-06-02 10:22:45', '2019-06-02 11:58:53', 455),
(388, '2019-06-03 17:15:54', '2019-06-03 18:51:41', 455),
(389, '2019-06-10 15:32:11', '2019-06-10 15:47:34', 455),
(390, '2019-06-10 15:47:40', '2019-06-10 15:53:34', 455),
(391, '2019-06-10 15:53:43', '2019-06-10 15:56:58', 455),
(392, '2019-06-11 10:36:00', '2019-06-11 11:37:01', 455),
(393, '2019-06-11 11:38:28', '2019-06-11 13:46:45', 455),
(394, '2019-06-11 15:17:58', '2019-06-11 16:50:18', 455),
(395, '2019-06-12 19:23:26', '2019-06-12 21:27:33', 455),
(396, '2019-06-18 11:19:07', '2019-06-20 00:06:38', 455),
(397, '2019-06-26 08:42:01', '2019-06-24 01:37:54', 455),
(398, '2019-06-24 01:38:16', '2019-06-24 01:38:28', 455),
(399, '2019-06-25 03:27:14', '2019-06-29 11:21:20', 455),
(400, '2019-06-29 15:34:58', '2019-06-29 18:34:03', 455),
(401, '2019-07-02 17:32:48', '2019-07-02 18:34:06', 455),
(402, '2019-07-02 19:32:44', '2019-07-02 20:49:42', 455),
(403, '2019-07-02 21:59:31', '2019-07-02 22:29:56', 455),
(404, '2019-07-02 11:36:18', '2019-07-02 11:39:56', 455),
(405, '2019-07-02 11:40:03', '2019-07-02 12:31:55', 455),
(406, '2019-07-02 12:38:40', '2019-07-02 13:22:47', 455),
(407, '2019-07-02 13:22:54', '2019-07-02 13:27:07', 455),
(408, '2019-07-02 13:27:19', '2019-07-02 14:28:07', 455),
(409, '2019-07-02 15:17:40', '2019-07-02 16:56:29', 455),
(410, '2019-07-02 17:16:51', '2019-07-02 20:33:06', 455),
(411, '2019-07-02 20:35:54', '2019-07-02 20:38:41', 455),
(412, '2019-07-02 20:40:45', '2019-07-02 20:51:47', 455),
(413, '2019-07-02 20:51:53', '2019-07-02 21:05:04', 455),
(414, '2019-07-02 21:05:10', '2019-07-02 21:53:21', 455),
(415, '2019-07-02 21:53:27', '2019-07-03 00:25:09', 455),
(416, '2019-07-03 00:25:15', '2019-07-03 01:49:32', 455),
(417, '2019-07-03 01:49:40', '2019-07-04 14:56:59', 455),
(418, '2019-07-04 15:02:38', '2019-07-04 17:04:43', 455),
(419, '2019-07-04 17:17:47', '2019-07-04 21:05:41', 455),
(420, '2019-07-05 12:02:51', '2019-07-05 12:29:46', 455),
(421, '2019-07-05 12:29:54', '2019-07-05 12:39:50', 455),
(422, '2019-07-05 12:39:57', '2019-07-05 12:42:50', 455),
(423, '2019-07-05 12:42:56', '2019-07-05 13:48:13', 455),
(424, '2019-07-05 13:48:20', '2019-07-05 14:31:18', 455),
(425, '2019-07-05 14:31:24', '2019-07-05 14:32:47', 455),
(426, '2019-07-05 14:32:54', '2019-07-05 14:35:55', 455),
(427, '2019-07-05 14:36:12', '2019-07-05 15:35:09', 455),
(428, '2019-07-05 15:35:14', '2019-07-05 15:39:03', 455),
(429, '2019-07-05 15:39:15', '2019-07-05 15:42:57', 455),
(430, '2019-07-05 15:43:05', '2019-07-05 15:47:42', 455),
(431, '2019-07-05 15:47:50', '2019-07-05 15:53:56', 455),
(432, '2019-07-05 15:54:02', '2019-07-05 15:56:10', 455),
(433, '2019-07-05 15:56:16', '2019-07-05 16:03:34', 455),
(434, '2019-07-05 16:03:40', '2019-07-05 16:13:07', 455),
(435, '2019-07-05 16:13:20', '2019-07-05 16:17:46', 455),
(436, '2019-07-05 16:17:52', '2019-07-05 16:20:31', 455),
(437, '2019-07-05 16:20:37', '2019-07-05 16:22:24', 455),
(438, '2019-07-05 16:22:29', '2019-07-05 16:25:12', 455),
(439, '2019-07-05 16:25:18', '2019-07-05 16:27:25', 455),
(440, '2019-07-05 16:27:33', '2019-07-05 16:29:05', 455),
(441, '2019-07-05 16:29:11', '2019-07-05 16:33:49', 455),
(442, '2019-07-05 16:33:56', '2019-07-05 16:37:28', 455),
(443, '2019-07-05 16:37:36', '2019-07-05 16:40:19', 455),
(444, '2019-07-05 16:42:31', '2019-07-05 16:46:28', 455),
(445, '2019-07-05 16:46:34', '2019-07-05 16:48:37', 455),
(446, '2019-07-05 17:15:51', '2019-07-05 20:46:08', 455),
(447, '2019-07-08 11:09:39', '2019-07-08 11:29:11', 455),
(448, '2019-07-08 11:29:26', '2019-07-08 11:32:37', 455),
(449, '2019-07-08 11:32:57', '2019-07-08 11:38:09', 455),
(450, '2019-07-08 11:38:15', '2019-07-08 12:38:55', 455),
(451, '2019-07-08 12:41:28', '2019-07-08 13:13:05', 455),
(452, '2019-07-08 13:57:42', '2019-07-08 14:28:04', 455),
(453, '2019-07-08 14:56:38', '2019-07-08 15:56:51', 455),
(454, '2019-07-08 17:36:12', '2019-07-08 17:50:58', 455),
(455, '2019-07-08 17:51:07', '2019-07-09 10:51:28', 455),
(456, '2019-07-09 10:51:35', '2019-07-09 11:10:53', 455),
(457, '2019-07-09 11:10:59', '2019-07-10 02:41:27', 455),
(458, '2019-07-10 03:10:25', '2019-07-09 17:15:19', 455),
(459, '2019-07-11 10:33:07', '2019-07-11 12:16:48', 455),
(460, '2019-07-11 12:16:55', '2019-07-11 13:51:00', 455),
(461, '2019-07-11 14:21:46', '2019-07-11 15:43:10', 455),
(462, '2019-07-11 15:43:18', '2019-07-11 16:23:40', 455),
(463, '2019-07-11 16:23:45', '2019-07-11 16:29:26', 455),
(464, '2019-07-11 16:29:32', '2019-07-11 16:31:48', 455),
(465, '2019-07-11 16:31:54', '2019-07-11 20:14:13', 455),
(466, '2019-07-12 11:00:26', '2019-07-12 16:16:19', 455),
(467, '2019-07-12 16:16:49', '2019-07-12 16:36:21', 455),
(468, '2019-07-12 16:36:36', '2019-07-12 16:39:05', 455),
(469, '2019-07-12 16:39:13', '2019-07-12 17:53:35', 455),
(470, '2019-07-13 14:23:30', '2019-07-15 10:24:46', 455),
(471, '2019-07-15 10:24:58', '2019-07-15 13:03:56', 455),
(472, '2019-07-15 16:48:34', '2019-07-16 10:38:36', 455),
(473, '2019-07-16 11:30:48', '2019-07-16 16:33:19', 455),
(474, '2019-07-18 07:20:03', '2019-07-18 07:40:53', 455),
(475, '2019-07-18 07:41:03', '2019-07-18 09:50:38', 455),
(476, '2019-07-24 16:14:36', '2019-07-25 09:29:29', 455),
(477, '2019-07-26 14:17:09', '2019-07-26 17:40:20', 455),
(478, '2019-08-06 11:05:11', '2019-08-06 18:18:13', 455),
(479, '2019-08-06 19:35:34', '2019-08-06 19:37:45', 455),
(480, '2019-08-14 11:30:56', '2019-08-14 13:46:32', 455),
(481, '2019-08-14 13:46:38', '2019-08-14 13:48:36', 455),
(482, '2019-08-14 13:48:44', '2019-08-14 13:50:35', 455),
(483, '2019-08-14 13:50:51', '2019-08-14 14:15:54', 455),
(484, '2019-08-14 14:16:00', '2019-08-14 14:18:39', 455),
(485, '2019-08-14 14:20:26', '2019-08-14 14:28:46', 455),
(486, '2019-08-14 14:28:52', '2019-08-14 15:04:30', 455),
(487, '2019-08-14 15:04:35', '2019-08-14 15:05:03', 455),
(488, '2019-08-14 15:05:14', '2019-08-14 15:50:05', 455),
(489, '2019-08-14 15:50:11', '2019-08-14 16:01:34', 455),
(490, '2019-08-15 10:46:27', '2019-08-15 12:20:54', 455),
(491, '2019-08-19 11:56:27', '2019-08-19 13:22:01', 455),
(492, '2019-08-23 09:44:13', '2019-08-23 10:11:21', 455),
(493, '2019-08-23 10:11:31', '2019-08-23 12:13:07', 455),
(494, '2019-08-27 15:04:13', '2019-08-27 17:07:18', 455),
(495, '2019-08-28 10:42:29', '2019-08-28 12:38:37', 455),
(496, '2019-08-28 12:38:47', '2019-08-29 12:01:22', 455),
(497, '2019-08-29 12:01:41', '2019-08-29 13:57:22', 455),
(498, '2019-08-29 13:57:29', '2019-08-29 14:09:55', 455),
(499, '2019-08-29 14:10:01', '2019-08-29 14:10:14', 455),
(500, '2019-08-29 14:10:20', '2019-08-30 15:16:40', 455),
(501, '2019-08-30 15:16:50', '2019-08-30 15:28:46', 455),
(502, '2019-08-30 16:07:34', '2019-08-30 16:08:19', 455),
(503, '2019-09-05 11:27:41', '2019-09-05 12:59:35', 455),
(504, '2019-09-05 14:25:05', '2019-09-05 14:26:20', 455),
(505, '2019-09-06 10:24:48', '2019-09-06 12:57:31', 455),
(506, '2019-09-06 12:57:41', '2019-09-06 12:58:13', 455),
(507, '2019-09-06 12:58:31', '2019-09-06 13:06:46', 455),
(508, '2019-09-10 11:11:39', '2019-09-10 11:33:44', 455),
(509, '2019-09-10 13:22:18', '2019-09-10 14:07:41', 455),
(510, '2019-09-10 15:19:33', '2019-09-10 15:40:41', 455),
(511, '2019-09-10 15:40:47', '2019-09-10 15:43:30', 455),
(512, '2019-09-17 12:42:42', '2019-09-17 13:43:03', 455),
(513, '2019-09-26 09:34:35', '2019-09-26 09:38:07', 455),
(514, '2019-09-26 09:38:09', '2019-09-26 09:40:44', 455),
(515, '2019-09-26 09:40:51', '2019-09-26 09:45:12', 455),
(516, '2019-09-26 09:45:15', '2019-09-26 09:53:14', 455),
(517, '2019-09-27 11:22:50', '2019-09-27 12:02:31', 455),
(518, '2019-09-27 12:02:36', '2019-09-27 12:17:16', 455),
(519, '2019-09-27 12:17:19', '2019-09-27 12:42:40', 455),
(520, '2019-09-27 12:42:43', '2019-09-27 12:46:44', 455),
(521, '2019-09-27 12:46:46', '2019-09-27 12:50:44', 455),
(522, '2019-09-27 12:50:46', '2019-09-27 13:22:36', 455),
(523, '2019-10-03 13:18:23', '2019-10-03 13:19:05', 462),
(524, '2019-10-03 13:19:08', '2019-10-03 13:30:10', 462),
(525, '2019-10-03 13:30:15', '2019-10-03 14:48:41', 462),
(526, '2019-10-03 16:19:06', '2019-10-03 16:23:06', 464),
(527, '2019-10-03 16:23:09', '2019-10-03 16:23:41', 464),
(528, '2019-10-03 16:23:43', '2019-10-03 16:25:01', 464),
(529, '2019-10-03 16:27:51', '2019-10-03 16:30:15', 465),
(530, '2019-10-03 17:24:28', '2019-10-03 17:26:51', 465),
(531, '2019-10-04 13:04:03', '2019-10-04 13:10:09', 466),
(532, '2019-10-04 13:10:17', '2019-10-04 13:12:33', 466),
(533, '2019-10-04 13:14:00', '2019-10-04 13:30:39', 466),
(534, '2019-10-04 13:30:42', '2019-10-04 13:32:17', 466),
(535, '2019-10-04 13:36:18', '2019-10-04 14:13:17', 466),
(536, '2019-10-07 11:30:41', '2019-10-07 11:46:25', 455),
(537, '2019-10-07 11:46:32', '2019-10-07 12:38:30', 467),
(538, '2019-10-07 12:38:33', '2019-10-07 13:11:31', 467),
(539, '2019-10-07 13:11:39', '2019-10-07 13:18:43', 467),
(540, '2019-10-07 13:20:26', '2019-10-07 13:23:04', 467),
(541, '2019-10-07 13:23:07', '2019-10-07 13:24:25', 467),
(542, '2019-10-07 13:24:28', '2019-10-07 13:36:07', 467),
(543, '2019-10-07 14:09:20', '2019-10-07 14:14:38', 467),
(544, '2019-10-07 14:14:43', '2019-10-07 14:17:59', 467),
(545, '2019-10-07 14:18:01', '2019-10-07 14:19:38', 467),
(546, '2019-10-07 14:22:11', '2019-10-07 14:41:33', 467),
(547, '2019-10-07 14:44:50', '2019-10-07 14:45:45', 468),
(548, '2019-10-07 14:46:25', '2019-10-07 14:49:19', 468),
(549, '2019-10-07 14:49:21', '2019-10-07 14:53:10', 468),
(550, '2019-10-07 14:53:49', '2019-10-07 15:03:23', 468),
(551, '2019-10-07 15:03:58', '2019-10-07 15:21:14', 468),
(552, '2019-10-07 16:46:00', '2019-10-07 16:46:09', 455),
(553, '2019-10-14 14:32:49', '2019-10-14 16:24:12', 455),
(554, '2019-10-14 16:24:21', '2019-10-14 16:26:08', 455),
(555, '2019-10-16 11:45:56', '2019-10-16 17:11:49', 455),
(556, '2019-10-21 12:32:05', '2019-10-21 15:13:07', 455),
(557, '2019-10-21 15:14:45', '2019-10-21 15:35:20', 455),
(558, '2019-10-24 11:44:19', '2019-10-24 15:00:14', 455),
(559, '2019-10-28 11:57:41', '2019-10-28 17:24:31', 455),
(560, '2019-10-28 17:34:30', '2019-10-28 17:50:39', 455),
(561, '2019-10-29 11:34:21', '2019-10-29 12:46:15', 455),
(562, '2019-10-31 11:42:56', '2019-10-31 16:17:12', 455),
(563, '2019-10-31 16:17:17', '2019-10-31 16:29:47', 470),
(564, '2019-10-31 16:29:50', '2019-10-31 16:32:01', 455),
(565, '2019-10-31 16:32:04', '2019-10-31 16:32:42', 470),
(566, '2019-11-06 14:24:16', '2019-11-06 14:24:30', 455),
(567, '2019-11-06 14:24:36', '2019-11-06 14:28:58', 470),
(568, '2019-11-06 14:29:01', '2019-11-06 14:34:09', 470),
(569, '2019-11-06 14:34:12', '2019-11-06 14:41:50', 470),
(570, '2019-11-08 10:54:14', '2019-11-08 11:46:41', 455),
(571, '2019-11-20 11:21:23', '2019-11-20 13:48:13', 455),
(572, '2019-11-21 12:19:03', '2019-11-21 14:19:42', 455),
(573, '2019-11-21 16:01:47', '2019-11-22 12:21:21', 455),
(574, '2019-11-22 12:52:47', '2019-11-22 15:10:14', 455),
(575, '2019-11-22 15:17:37', '2019-11-22 17:02:45', 455),
(576, '2019-11-29 15:25:52', '2019-11-29 15:58:47', 455),
(577, '2019-11-29 16:46:35', '2019-11-29 17:10:03', 455),
(578, '2019-12-02 12:17:04', '2019-12-02 13:24:10', 455),
(579, '2019-12-04 15:06:31', '2019-12-05 16:18:27', 455),
(580, '2019-12-05 17:09:16', '2019-12-05 18:08:29', 455),
(581, '2019-12-06 08:55:11', '2019-12-06 10:30:10', 455),
(582, '2019-12-06 11:48:20', '2019-12-06 11:48:24', 455),
(583, '2019-12-12 00:52:26', '2019-12-12 12:33:32', 471),
(584, '2019-12-12 22:20:28', '2019-12-12 22:21:07', 471),
(585, '2019-12-13 12:40:29', '2019-12-13 14:30:27', 471),
(586, '2019-12-13 14:33:25', '2019-12-14 12:19:12', 471),
(587, '2019-12-15 22:37:32', '2019-12-16 00:40:04', 471),
(588, '2019-12-16 00:42:13', '2019-12-16 16:48:29', 471),
(589, '2019-12-18 15:34:01', '2019-12-18 19:48:26', 471),
(590, '2019-12-19 09:59:48', '2019-12-19 10:34:38', 471),
(591, '2019-12-19 09:30:33', '2019-12-19 18:58:52', 471),
(592, '2019-12-20 11:32:58', '2019-12-20 14:41:10', 471),
(593, '2019-12-20 11:22:58', '2019-12-21 00:08:59', 471),
(594, '2019-12-21 10:22:15', '2019-12-21 12:53:52', 471),
(595, '2019-12-21 10:20:20', '2019-12-21 12:59:32', 471),
(596, '2019-12-21 12:59:41', '2019-12-21 13:01:27', 472),
(597, '2019-12-21 13:01:37', '2019-12-21 13:02:39', 471),
(598, '2019-12-21 13:02:48', '2019-12-21 13:09:10', 472),
(599, '2019-12-21 14:47:30', '2019-12-21 14:50:52', 471),
(600, '2019-12-21 14:58:55', '2019-12-21 15:05:39', 471),
(601, '2019-12-21 15:05:49', '2019-12-21 15:05:54', 473),
(602, '2019-12-21 15:07:04', '2019-12-21 15:07:53', 473),
(603, '2019-12-21 15:08:32', '2019-12-21 15:10:25', 473),
(604, '2019-12-21 15:11:16', '2019-12-21 17:53:38', 473),
(605, '2019-12-21 17:54:02', '2019-12-21 17:54:15', 473),
(606, '2019-12-22 13:19:18', '2019-12-22 17:07:47', 473),
(607, '2019-12-24 01:04:58', '2019-12-24 04:37:19', 471),
(608, '2019-12-24 11:47:05', '2019-12-25 11:11:15', 471),
(609, '2019-12-25 11:11:39', '2019-12-25 11:13:44', 471),
(610, '2019-12-25 11:13:58', '2019-12-25 11:54:06', 471),
(611, '2019-12-26 10:29:05', '2019-12-26 12:56:19', 471),
(612, '2019-12-26 14:30:16', '2019-12-26 15:34:28', 471),
(613, '2019-12-26 12:57:54', '2019-12-26 17:24:21', 471),
(614, '2019-12-26 18:38:37', '2019-12-27 12:25:49', 471),
(615, '2019-12-27 12:50:01', '2019-12-28 13:08:41', 471),
(616, '2019-12-28 11:42:54', '2019-12-28 15:13:42', 471),
(617, '2019-12-27 12:26:12', '2019-12-30 11:04:16', 471),
(618, '2019-12-28 13:20:12', '2019-12-30 12:31:37', 471),
(619, '2019-12-30 17:48:20', '2019-12-30 18:33:05', 471),
(620, '2019-12-30 18:57:53', '2019-12-30 19:01:04', 471),
(621, '2019-12-26 10:54:37', '2019-12-26 11:46:11', 471),
(622, '2019-12-26 11:46:27', '2019-12-26 11:48:14', 471),
(623, '2019-12-26 11:48:27', '2019-12-26 11:50:07', 471),
(624, '2019-12-26 11:50:20', '2019-12-31 12:25:06', 471),
(625, '2019-12-31 12:26:19', '2020-01-02 15:12:49', 471),
(626, '2020-01-08 15:58:42', '2020-01-08 19:57:48', 471),
(627, '2020-01-09 14:32:31', '2020-01-09 19:01:07', 471),
(628, '2020-01-09 14:32:31', '2020-01-09 19:01:07', 471),
(629, '2020-01-10 16:15:13', '2020-01-10 20:46:55', 471),
(630, '2020-01-11 12:26:06', '2020-01-11 16:27:55', 471),
(631, '2020-01-14 11:45:47', '2020-01-14 12:30:47', 471),
(632, '2020-01-14 13:29:47', '2020-01-15 12:13:16', 471),
(633, '2020-01-16 14:05:15', '2020-01-18 11:06:00', 471),
(634, '2020-01-18 11:21:39', '2020-01-18 11:21:58', 471),
(635, '2020-01-18 14:51:15', '2020-01-18 15:21:40', 471),
(636, '2020-01-18 15:22:16', '2020-01-18 15:27:07', 471),
(637, '2020-01-18 22:43:59', '2020-01-19 07:06:23', 471),
(638, '2020-01-19 07:08:23', '2020-01-19 11:01:15', 471),
(639, '2020-01-19 11:06:25', '2020-01-19 11:50:02', 471),
(640, '2020-01-19 12:04:18', '2020-01-20 05:05:46', 471),
(641, '2020-01-20 11:25:02', '2020-01-20 14:01:34', 471),
(642, '2020-01-20 14:12:26', '2020-01-20 14:56:58', 471),
(643, '2020-01-20 17:28:48', '2020-01-20 20:48:57', 471),
(644, '2020-01-20 22:37:05', '2020-01-21 15:04:47', 471),
(645, '2020-01-21 15:06:07', '2020-01-21 18:07:52', 471),
(646, '2020-01-22 22:43:38', '2020-01-23 12:26:33', 471),
(647, '2020-01-23 12:26:45', '2020-01-23 12:27:27', 471),
(648, '2020-01-24 16:57:16', '2020-01-24 20:04:16', 471),
(649, '2020-01-27 11:24:39', '2020-01-27 11:37:24', 471),
(650, '2020-01-27 11:38:12', '2020-01-27 12:59:30', 471),
(651, '2020-01-27 12:48:04', '2020-01-27 13:00:46', 471),
(652, '2020-01-27 13:31:57', '2020-01-27 17:04:16', 471),
(653, '2020-01-27 17:04:50', '2020-01-27 17:05:26', 471),
(654, '2020-01-28 10:12:10', '2020-01-28 14:23:14', 471),
(655, '2020-01-29 10:14:41', '2020-01-29 11:57:06', 471),
(656, '2020-01-29 12:01:27', '2020-01-29 14:34:36', 471),
(657, '2020-01-29 14:35:57', '2020-01-29 17:00:04', 471),
(658, '2020-01-29 17:16:00', '2020-01-29 20:15:49', 471),
(659, '2020-01-30 00:29:20', '2020-01-30 01:53:43', 471),
(660, '2020-01-30 01:53:59', '2020-01-30 05:33:50', 471),
(661, '2020-01-30 13:05:00', '2020-01-30 14:07:42', 471),
(662, '2020-01-30 14:19:10', '2020-01-30 14:21:28', 471),
(663, '2020-01-30 14:27:14', '2020-01-30 14:57:28', 471),
(664, '2020-01-30 14:58:49', '2020-01-30 14:58:53', 471),
(665, '2020-02-03 11:13:43', '2020-02-03 11:24:43', 471),
(666, '2020-02-03 11:24:56', '2020-02-03 11:25:53', 475),
(667, '2020-02-03 11:26:02', '2020-02-03 11:33:53', 471),
(668, '2020-02-03 11:34:38', '2020-02-03 11:35:18', 471),
(669, '2020-02-03 11:35:39', '2020-02-03 11:35:45', 471),
(670, '2020-02-03 11:36:38', '2020-02-03 11:36:43', 471),
(671, '2020-02-03 11:37:48', '2020-02-03 11:37:53', 471),
(672, '2020-02-03 11:38:47', '2020-02-03 11:39:59', 476),
(673, '2020-02-03 11:40:52', '2020-02-03 11:44:05', 476),
(674, '2020-02-03 11:45:47', '2020-02-03 12:00:22', 476),
(675, '2020-02-03 12:03:52', '2020-02-03 12:04:57', 479),
(676, '2020-02-03 12:03:39', '2020-02-03 12:05:44', 475),
(677, '2020-02-03 11:58:50', '2020-02-03 12:09:02', 471),
(678, '2020-02-03 12:09:44', '2020-02-03 12:10:06', 471),
(679, '2020-02-03 12:11:01', '2020-02-03 12:12:54', 476),
(680, '2020-02-03 12:13:29', '2020-02-03 12:33:40', 471),
(681, '2020-02-03 12:19:44', '2020-02-03 12:34:32', 476),
(682, '2020-02-03 12:19:52', '2020-02-03 12:37:53', 475),
(683, '2020-02-03 12:20:02', '2020-02-03 12:38:33', 479),
(684, '2020-02-03 12:44:03', '2020-02-03 13:00:04', 476),
(685, '2020-02-03 13:01:02', '2020-02-03 13:23:27', 476),
(686, '2020-02-03 12:43:43', '2020-02-03 13:26:47', 475),
(687, '2020-02-03 12:45:30', '2020-02-03 13:32:35', 479),
(688, '2020-02-03 13:22:52', '2020-02-03 13:39:38', 471),
(689, '2020-02-03 12:49:14', '2020-02-03 13:40:51', 477),
(690, '2020-02-03 12:19:36', '2020-02-03 14:07:36', 478),
(691, '2020-02-03 13:40:29', '2020-02-03 14:08:56', 471),
(692, '2020-02-03 13:45:02', '2020-02-03 15:41:15', 477),
(693, '2020-02-03 13:44:21', '2020-02-03 15:41:19', 479),
(694, '2020-02-03 13:42:05', '2020-02-03 15:41:25', 475),
(695, '2020-02-03 13:24:57', '2020-02-03 15:43:43', 476),
(696, '2020-02-03 15:44:40', '2020-02-03 15:44:50', 476),
(697, '2020-02-03 15:43:38', '2020-02-03 15:45:13', 475),
(698, '2020-02-03 15:43:58', '2020-02-03 15:45:18', 477),
(699, '2020-02-03 15:43:49', '2020-02-03 15:45:29', 479),
(700, '2020-02-03 15:48:40', '2020-02-03 15:50:11', 475),
(701, '2020-02-03 15:48:47', '2020-02-03 16:11:04', 477),
(702, '2020-02-03 15:46:32', '2020-02-03 16:39:56', 471),
(703, '2020-02-08 04:15:08', '2020-02-08 05:06:56', 471),
(704, '2020-02-08 19:40:13', '2020-02-08 20:07:06', 471),
(705, '2020-02-08 20:07:13', '2020-02-08 20:30:38', 471),
(706, '2020-02-08 20:30:43', '2020-02-08 20:43:41', 471),
(707, '2020-02-08 20:43:48', '2020-02-08 20:59:32', 471),
(708, '2020-02-08 20:59:48', '2020-02-08 21:57:17', 471),
(709, '2020-02-08 21:57:24', '2020-02-09 01:23:55', 471),
(710, '2020-02-09 04:16:21', '2020-02-09 05:36:50', 471),
(711, '2020-02-09 05:37:22', '2020-02-09 07:00:30', 471),
(712, '2020-02-10 12:03:55', '2020-02-10 12:48:40', 471),
(713, '2020-02-10 12:48:48', '2020-02-10 12:50:24', 475),
(714, '2020-02-10 12:53:08', '2020-02-10 12:53:30', 471),
(715, '2020-02-10 12:53:35', '2020-02-10 12:54:23', 476),
(716, '2020-02-10 12:54:29', '2020-02-10 12:55:38', 471),
(717, '2020-02-10 12:55:44', '2020-02-10 12:58:32', 476),
(718, '2020-02-10 13:00:35', '2020-02-10 13:12:04', 471),
(719, '2020-02-10 13:15:55', '2020-02-10 13:26:33', 471),
(720, '2020-02-10 13:26:43', '2020-02-10 13:27:14', 480),
(721, '2020-02-10 13:27:20', '2020-02-10 13:29:48', 471),
(722, '2020-02-10 13:29:53', '2020-02-10 13:34:36', 471),
(723, '2020-02-10 13:35:14', '2020-02-10 13:35:26', 471),
(724, '2020-02-10 13:36:24', '2020-02-10 13:55:05', 471),
(725, '2020-02-10 13:55:38', '2020-02-10 13:57:07', 476),
(726, '2020-02-10 13:57:34', '2020-02-10 14:00:49', 476),
(727, '2020-02-10 14:00:58', '2020-02-10 14:01:54', 471),
(728, '2020-02-10 14:02:00', '2020-02-10 14:03:43', 476),
(729, '2020-02-10 14:03:49', '2020-02-10 14:04:07', 471),
(730, '2020-02-10 14:04:13', '2020-02-10 14:05:07', 475),
(731, '2020-02-10 14:05:13', '2020-02-10 14:06:03', 471),
(732, '2020-02-10 14:06:23', '2020-02-10 14:08:43', 476),
(733, '2020-02-10 14:08:50', '2020-02-10 14:09:28', 471),
(734, '2020-02-10 14:09:34', '2020-02-10 14:09:52', 471),
(735, '2020-02-10 14:10:01', '2020-02-10 14:18:45', 476),
(736, '2020-02-10 14:18:52', '2020-02-10 14:20:26', 471),
(737, '2020-02-10 14:20:38', '2020-02-10 14:23:31', 476),
(738, '2020-02-10 14:23:37', '2020-02-10 14:28:51', 475),
(739, '2020-02-10 14:28:56', '2020-02-10 14:29:01', 475),
(740, '2020-02-10 14:29:09', '2020-02-10 14:29:19', 471),
(741, '2020-02-10 14:29:30', '2020-02-10 14:30:19', 476),
(742, '2020-02-10 14:39:05', '2020-02-10 14:45:10', 471),
(743, '2020-02-10 14:45:24', '2020-02-10 14:45:37', 475),
(744, '2020-02-10 14:45:43', '2020-02-10 14:47:36', 471),
(745, '2020-02-10 14:42:43', '2020-02-10 14:48:02', 471),
(746, '2020-02-10 14:47:42', '2020-02-10 14:49:04', 475),
(747, '2020-02-10 14:49:10', '2020-02-10 14:50:34', 471),
(748, '2020-02-10 14:48:04', '2020-02-10 14:57:25', 471),
(749, '2020-02-10 14:50:40', '2020-02-10 15:05:39', 475),
(750, '2020-02-10 15:06:07', '2020-02-10 15:16:11', 476),
(751, '2020-02-10 15:17:30', '2020-02-10 15:17:39', 471),
(752, '2020-02-10 14:57:26', '2020-02-10 15:18:37', 471),
(753, '2020-02-10 15:18:49', '2020-02-10 15:22:11', 475),
(754, '2020-02-10 15:12:12', '2020-02-10 15:24:07', 471),
(755, '2020-02-10 15:17:47', '2020-02-10 15:24:21', 475),
(756, '2020-02-10 15:28:46', '2020-02-10 15:36:42', 475),
(757, '2020-02-10 15:24:37', '2020-02-10 15:37:23', 471),
(758, '2020-02-10 15:38:02', '2020-02-10 15:38:52', 471),
(759, '2020-02-10 15:36:48', '2020-02-10 15:41:28', 471),
(760, '2020-02-10 15:39:33', '2020-02-10 15:51:33', 471),
(761, '2020-02-10 15:41:37', '2020-02-10 16:05:48', 475),
(762, '2020-02-10 16:06:33', '2020-02-10 16:08:51', 475),
(763, '2020-02-10 16:08:57', '2020-02-10 16:09:18', 471),
(764, '2020-02-10 16:09:24', '2020-02-10 16:09:47', 471);

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
  PRIMARY KEY (`id`),
  KEY `classe_id` (`classe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptcategories`
--

INSERT INTO `cptcategories` (`id`, `libelle`, `numero`, `psedo`, `classe_id`) VALUES
(20, 'CAPITAL', 10, 0, 1),
(21, 'RESERVES', 11, 0, 1),
(22, 'REPORT A NOUVEAU', 12, 0, 1),
(23, 'RESULTAT NET DE L\'EXERCICE', 13, 0, 1),
(24, 'SUBVENTIONS D\'INVESTISSEMENT', 14, 0, 1),
(25, 'PROVISIONS REGLEMENTEES ET FONDS ASSIMILES', 15, 0, 1),
(26, 'EMPRUNTS ET DETTES ASSIMILEES', 16, 0, 1),
(27, 'DETTES DE LOCATION-ACQUISITION', 17, 0, 1),
(28, 'DETTES LIEES A DES PARTICIPATIONS ET COMPTES DE LIAISON DES ETABLISSEMENTS ET SOCIETES EN PARTICIPATION', 18, 0, 1),
(29, 'PROVISIONS POUR RISQUES ET CHARGES', 19, 0, 1),
(30, 'IMMOBILISATIONS INCORPORELLES', 21, 0, 2),
(31, 'TERRAINS', 22, 0, 2),
(32, 'BATIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', 23, 0, 2),
(33, 'MATERIEL, MOBILIER ET ACTIFS BIOLOGIQUES', 24, 0, 2),
(34, 'AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS', 25, 0, 2),
(35, 'TITRES DE PARTICIPATION', 26, 0, 2),
(36, 'AUTRES IMMOBLISATIONS FINANCIERES', 27, 0, 2),
(37, 'AMORTISSEMENTS', 28, 0, 2),
(38, 'DEPRECIATIONS DES IMMOBILISATIONS', 29, 0, 2),
(39, 'MARCHANDISES', 31, 0, 3),
(40, 'MATIERES PREMIERES ET FOURNITURES LIEES', 32, 0, 3),
(41, 'AUTRES APPROVISIONNEMENTS', 33, 0, 3),
(42, 'PRODUITS EN COURS', 34, 0, 3),
(43, 'SERVICES EN COURS', 35, 0, 3),
(44, 'PRODUITS FINIS', 36, 0, 3),
(45, 'PRODUITS INTERMEDIAIRES ET RESIDUELS', 37, 0, 3),
(46, 'STOCKS EN COURS DE ROUTE, EN CONSIGNATION OU EN DEPOT', 38, 0, 3),
(47, 'DEPRECIATIONS DES STOCKS ET ENCOURS DE PRODUCTION', 39, 0, 3),
(48, 'FOURNISSEURS ET COMPTES RATTACHES', 40, 0, 4),
(49, 'CLIENTS ET COMPTES RATTACHES', 41, 0, 4),
(50, 'PERSONNEL', 42, 0, 4),
(51, 'ORGANISMES SOCIAUX', 43, 0, 4),
(52, 'ETAT ET COLLECTIVITES PUBLIQUES', 44, 0, 4),
(53, 'ORGANISMES INTERNATIONAUX', 45, 0, 4),
(54, 'APPORTEURS, ASSOCIES ET GROUPE', 46, 0, 4),
(55, 'DEBITEURS ET CREDITEURS DIVERS', 47, 0, 4),
(56, 'CREANCES ET DETTES HORS ACTIVITES ORDINAIRES (HAO)', 48, 0, 4),
(57, 'DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME (TIERS)', 49, 0, 4),
(58, 'TITRES DE PLACEMENT', 50, 0, 5),
(59, 'VALEURS A ENCAISSER', 51, 0, 5),
(60, 'BANQUES', 52, 0, 5),
(61, 'ETABLISSEMENTS FINANCIERS ET ASSIMILES', 53, 0, 5),
(62, 'INSTRUMENTS DE TRESORERIE', 54, 0, 5),
(63, 'INSTRUMENTS DE MONNAIE ELECTRONIQUE', 55, 0, 5),
(64, 'BANQUES, CREDITS DE TRESORERIE ET D\'ESCOMPTE', 56, 0, 5),
(65, 'CAISSE', 57, 0, 5),
(66, 'REGIES D\'AVANCES, ACCREDITIFS ET VIREMENTS INTERNES', 58, 0, 5),
(67, 'DEPRECIATIONS ET PROVISIONS POUR RISQUE A COURT TERME ', 59, 0, 5),
(68, 'ACHATS ET VARIATIONS DE STOCKS', 60, 0, 6),
(69, 'TRANSPORTS ', 61, 0, 6),
(70, 'SERVICES EXTERIEURS', 62, 0, 6),
(71, 'AUTRES SERVICES EXTERIEURS', 63, 0, 6),
(72, 'IMPOTS ET TAXES', 64, 0, 6),
(73, 'AUTRES CHARGES', 65, 0, 6),
(74, 'CHARGES DE PERSONNEL', 66, 0, 6),
(75, 'FRAIS FINANCIERS ET CHARGES ASSIMILEES', 67, 0, 6),
(76, 'DOTATIONS AUX AMORTISSEMENTS', 68, 0, 6),
(77, 'DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS', 69, 0, 6),
(78, 'VENTES', 70, 0, 7),
(79, 'SUBVENTIONS D\'EXPLOITATION', 71, 0, 7),
(80, 'PRODUCTION IMMOBILISEE', 72, 0, 7),
(81, 'VARIATIONS DES STOCKS DE BIENS ET DE SERVICES PRODUITS', 73, 0, 7),
(82, 'AUTRES PRODUITS', 75, 0, 7),
(83, 'REVENUS FINANCIERS ET PRODUITS ASSIMILES', 77, 0, 7),
(84, 'TRANSFERTS DE CHARGES', 78, 0, 7),
(85, 'REPRISES DE PROVISIONS, DE DEPRECIATIONS ET AUTRES', 79, 0, 7),
(86, 'VALEURS COMPTABLES DES CESSIONS D\'IMMOBILISATIONS', 81, 0, 8),
(87, 'PRODUITS DES CESSIONS D\'IMMOBILISATIONS', 82, 0, 8),
(88, 'CHARGES HORS ACTIVITES ORDINAIRES', 83, 0, 8),
(89, 'PRODUITS HORS ACTIVITES ORDINAIRES', 84, 0, 8),
(90, 'DOTATIONS HORS ACTIVITES ORDINAIRES', 85, 0, 8),
(91, 'REPRISES DE CHARGES, PROVISIONS ET DEPRECIATIONS HAO.', 86, 0, 8),
(92, 'PARTICIPATION DES TRAVAILLEURS', 87, 0, 8),
(93, 'SUBVENTIONS D\'EQUILIBRE', 88, 0, 8),
(94, 'IMPOTS SUR LE RESULTAT', 89, 0, 8),
(99, 'ENGAGEMENTS OBTENUS ET ENGAGEMENTS ACCORDES', 90, 0, 9),
(100, 'CONTREPARTIES DES ENGAGEMENTS', 91, 0, 9),
(101, 'COMPTES REFLECHIS', 92, 0, 9),
(102, 'COMPTES DE RECLASSEMENTS', 93, 0, 9),
(103, 'COMPTES DE COUTS', 94, 0, 9),
(104, 'COMPTES DE STOCKS', 95, 0, 9),
(105, 'COMPTES D\'ECARTS SUR COUTS PREETABLIS', 96, 0, 9),
(106, 'COMPTES DE DIFFERENCES DE TRAITEMENT COMPTABLE', 97, 0, 9),
(107, 'COMPTES DE RESULTATS', 98, 0, 9),
(108, 'COMPTES DE LIAISONS INTERNES', 99, 0, 9);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptclasses`
--

INSERT INTO `cptclasses` (`id`, `libelle`, `libelle2`, `numero`, `etat`) VALUES
(1, 'Classe 1', 'Comptes de ressources durables', 1, 'bilan'),
(2, 'Classe 2', 'Comptes d\'actif immobilise', 2, 'bilan'),
(3, 'Classe 3', 'Comptes de stocks', 3, 'bilan'),
(4, 'Classe 4', 'comptes de tiers', 4, 'bilan'),
(5, 'Classe 5', 'comptes de trésorerie', 5, 'bilan'),
(6, 'Classe 6', 'comptes de charges des activités ordinaires', 6, 'gestion'),
(7, 'Classe 7', 'Comptes de produits des activités ordinaires', 7, 'gestion'),
(8, 'Classe 8', 'Comptes des autres charges et des autres produits', 8, 'autre'),
(9, 'Classe 9', 'Comptes des engagements hors bilan et comptes de la comptabilité analytique de gestion', 9, 'gestion');

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
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=449 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptcomptes`
--

INSERT INTO `cptcomptes` (`id`, `libelle`, `numero`, `statut`, `categorie_id`, `psedo`) VALUES
(11, 'CAPITAL SOCIAL', '101', 'actif', 20, 0),
(12, 'CAPITAL PAR DOTATION', '102', 'actif', 20, 0),
(13, 'CAPITAL PERSONNEL', '103', 'actif', 20, 0),
(14, 'COMPTE DE L\'EXPLOITANT', '104', 'actif', 20, 0),
(15, 'PRIMES LIEES AU CAPITAL SOCIAL', '105', 'actif', 20, 0),
(16, 'ECARTS DE REEVALUATION', '106', 'actif', 20, 0),
(17, 'APPORTEURS, CAPITAL SOUSCRIT, NON APPELE', '109', 'actif', 20, 0),
(18, 'RESERVE LEGALE', '111', 'actif', 21, 0),
(19, 'RESERVES STATUTAIRES OU CONTRACTUELLES', '112', 'actif', 21, 0),
(20, 'RESERVES REGLEMENTEES', '113', 'actif', 21, 0),
(21, 'AUTRES RESERVES', '118', 'actif', 21, 0),
(22, 'REPORT A NOUVEAU CREDITEUR', '121', 'actif', 22, 0),
(23, 'REPORT A NOUVEAU DEBITEUR', '129', 'actif', 22, 0),
(24, 'RESULTAT EN INSTANCE D\'AFFECTATION', '130', 'actif', 23, 0),
(25, 'RESULTAT NET : BENEFICE', '131', 'actif', 23, 0),
(26, 'MARGE COMMERCIALE (MC)', '132', 'actif', 23, 0),
(27, 'VALEUR AJOUTEE (V.A.)', '133', 'actif', 23, 0),
(28, 'EXCEDENT BRUT D\'EXPLOITATION (E.B.E.)', '134', 'actif', 23, 0),
(29, 'RESULTAT D\'EXPLOITATION (R.E.)', '135', 'actif', 23, 0),
(30, 'RESULTAT FINANCIER (R.F.)', '136', 'actif', 23, 0),
(31, 'RESULTAT DES ACTIVITES ORDINAIRES (R.A.O.)', '137', 'actif', 23, 0),
(32, 'RESULTAT HORS ACTIVITES ORDINAIRES (R.H.A.O.)', '138', 'actif', 23, 0),
(33, 'RESULTAT NET : PERTE', '139', 'actif', 23, 0),
(34, 'SUBVENTIONS D\'EQUIPEMENT', '141', 'actif', 24, 0),
(35, 'AUTRES SUBVENTIONS D\'INVESTISSEMENT', '148', 'actif', 24, 0),
(36, 'AMORTISSEMENTS DEROGATOIRES', '151', 'actif', 25, 0),
(37, 'PLUS-VALUES DE CESSION A REINVESTIR', '152', 'actif', 25, 0),
(38, 'FONDS REGLEMENTES', '153', 'actif', 25, 0),
(39, 'PROVISIONS SPECIALES DE REEVALUATION', '154', 'actif', 25, 0),
(40, 'PROVISIONS REGLEMENTEES RELATIVES AUX IMMOBILISATIONS', '155', 'actif', 25, 0),
(41, 'PROVISIONS REGLEMENTEES RELATIVES AUX STOCKS', '156', 'actif', 25, 0),
(42, 'PROVISIONS POUR INVESTISSEMENT', '157', 'actif', 25, 0),
(43, 'AUTRES PROVISIONS ET FONDS REGLEMENTES', '158', 'actif', 25, 0),
(44, 'EMPRUNTS OBLIGATAIRES', '161', 'actif', 26, 0),
(45, 'EMPRUNTS ET DETTES AUPRES DES ETABLISSEMENTS DE CREDIT', '162', 'actif', 26, 0),
(46, 'AVANCES RECUES DE L\'ETAT', '163', 'actif', 26, 0),
(47, 'AVANCES RECUES ET COMPTES COURANTS BLOQUES', '164', 'actif', 26, 0),
(48, 'DEPOTS ET CAUTIONNEMENTS RECUES', '165', 'actif', 26, 0),
(49, 'INTERETS COURUS', '166', 'actif', 26, 0),
(50, 'AVANCES ASSORTIES DE CONDITIONS PARTICULIERES', '167', 'actif', 26, 0),
(51, 'AUTRES EMPRUNTS ET DETTES', '168', 'actif', 26, 0),
(52, 'DETTES DE LOCATION-ACQUISITION / CREDIT-BAIL IMMOBILIER', '172', 'actif', 27, 0),
(53, 'DETTES DE LOCATION-ACQUISITION / CREDIT-BAIL MOBILIER', '173', 'actif', 27, 0),
(54, 'DETTES DE LOCATION-ACQUISITION / LOCATION-VENTE', '174', 'actif', 27, 0),
(55, 'INTERETS COURUS', '176', 'actif', 27, 0),
(56, 'AUTRES DETTES DE LOCATION-ACQUISITION', '178', 'actif', 27, 0),
(63, 'DETTES LIEES A DES PARTICIPATIONS', '181', 'actif', 28, 0),
(64, 'DETTES LIEES A DES SOCIETES EN PARTICIPATION', '182', 'actif', 28, 0),
(65, 'INTERETS COURUS SUR DETTES LIEES A DES PARTICIPATIONS', '183', 'actif', 28, 0),
(66, 'COMPTES PERMANENTS BLOQUES DES ETABLISSEMENTS ET SUCCURSALES', '184', 'actif', 28, 0),
(67, 'COMPTES PERMANENTS NON BLOQUES DES ETABLISSEMENTS ET SUCCURSALES', '185', 'actif', 28, 0),
(68, 'COMPTES DE LIAISON CHARGES', '186', 'actif', 28, 0),
(69, 'COMPTES DE LIAISON PRODUITS', '187', 'actif', 28, 0),
(70, 'COMPTES DE LIAISON DES SOCIETES EN PARTICIPATION', '188', 'actif', 28, 0),
(71, 'PROVISIONS POUR LITIGES', '191', 'actif', 29, 0),
(72, 'PROVISIONS POUR GARANTIES DONNEES AUX CLIENTS', '192', 'actif', 29, 0),
(73, 'PROVISIONS POUR PERTES SUR MARCHES A ACHEVEMENT FUTUR', '193', 'actif', 29, 0),
(74, 'PROVISIONS POUR PERTES DE CHANGE', '194', 'actif', 29, 0),
(75, 'PROVISIONS POUR IMPOTS', '195', 'actif', 29, 0),
(76, 'PROVISIONS POUR PENSIONS ET OBLIGATIONS SIMILAIRES', '196', 'actif', 29, 0),
(77, 'PROVISIONS POUR RESTRUCTURATION', '197', 'actif', 29, 0),
(78, 'AUTRES PROVISIONS POUR RISQUES ET CHARGES', '198', 'actif', 29, 0),
(79, 'FRAIS  DE DEVELOPPEMENT', '211', 'actif', 30, 0),
(80, 'BREVETS, LICENCES, CONCESSIONS ET DROITS SIMILAIRES', '212', 'actif', 30, 0),
(81, 'LOGICIELS ET SITES INTERNET', '213', 'actif', 30, 0),
(82, 'MARQUES', '214', 'actif', 30, 0),
(83, 'FONDS COMMERCIAL', '215', 'actif', 30, 0),
(84, 'DROIT AU BAIL', '216', 'actif', 30, 0),
(85, 'INVESTISSEMENTS DE CREATION', '217', 'actif', 30, 0),
(86, 'AUTRES DROITS ET VALEURS INCORPORELS', '218', 'actif', 30, 0),
(87, 'IMMOBILISATIONS INCORPORELLES EN COURS', '219', 'actif', 30, 0),
(88, 'TERRAINS AGRICOLES ET FORESTIERS', '221', 'actif', 31, 0),
(89, 'TERRAINS NUS', '222', 'actif', 31, 0),
(90, 'TERRAINS BATIS', '223', 'actif', 31, 0),
(91, 'TRAVAUX DE MISE EN VALEUR DES TERRAINS', '224', 'actif', 31, 0),
(92, 'TERRAINS DE CARRIERES-TREFONDS ', '225', 'actif', 31, 0),
(93, 'TERRAINS AMENAGES', '226', 'actif', 31, 0),
(94, 'TERRAINS MIS EN CONCESSION', '227', 'actif', 31, 0),
(95, 'AUTRES TERRAINS', '228', 'actif', 31, 0),
(96, 'AMENAGEMENTS DE TERRAINS EN COURS', '229', 'actif', 31, 0),
(97, 'BATIMENTS INDUSTRIELS, AGRICOLES, ADMINISTRATIFS ET COMMERCIAUX SUR SOL PROPRE', '231', 'actif', 32, 0),
(98, 'BATIMENTS INDUSTRIELS, AGRICOLES, ADMINISTRATIFS ET COMMERCIAUX SUR SOL D\'AUTRUI', '232', 'actif', 32, 0),
(99, 'OUVRAGES D\'INFRASTRUCTURE', '233', 'actif', 32, 0),
(100, 'AMENAGEMENTS, AGENCEMENTS ET INSTALLATIONS TECHNIQUES', '234', 'actif', 32, 0),
(101, 'AMENAGEMENTS DE BUREAUX', '235', 'actif', 32, 0),
(102, 'BATIMENTS INDUSTRIELS, AGRICOLES ET COMMERCIAUX MIS EN CONCESSION', '237', 'actif', 32, 0),
(103, 'AUTRES INSTALLATIONS ET AGENCEMENTS', '238', 'actif', 32, 0),
(104, 'BATIMENTS AMENAGEMENTS, AGENCEMENTS  ET INSTALLATIONS EN COURS', '239', 'actif', 32, 0),
(105, 'MATERIEL ET OUTILLAGE INDUSTRIEL ET COMMERCIAL', '241', 'actif', 33, 0),
(106, 'MATERIEL ET OUTILLAGE AGRICOLE', '242', 'actif', 33, 0),
(107, 'MATERIEL D\'EMBALLAGE RECUPERABLE ET IDENTIFIABLE', '243', 'actif', 33, 0),
(108, 'MATERIEL ET MOBILIER ', '244', 'actif', 33, 0),
(109, 'MATERIEL DE TRANSPORT', '245', 'actif', 33, 0),
(110, 'ACTIFS BIOLOGIQUES', '246', 'actif', 33, 0),
(111, 'AGENCEMENTS, AMENAGEMENTS DU MATERIEL ET DES ACTIFS BIOLOGIQUES', '247', 'actif', 33, 0),
(112, 'AUTRES MATERIELS ET MOBILIERS', '248', 'actif', 33, 0),
(113, 'MATERIELS ET ACTIFS BIOLOGIQUES EN COURS', '249', 'actif', 33, 0),
(114, 'AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS INCORPORELLES', '251', 'actif', 34, 0),
(115, 'AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS CORPORELLES', '252', 'actif', 34, 0),
(116, 'TITRES DE PARTICIPATION DANS DES ENTITES SOUS CONTROLE EXCLUSIF', '261', 'actif', 35, 0),
(117, 'TITRES DE PARTICIPATION DANS DES ENTITES SOUS CONTROLE  CONJOINT', '262', 'actif', 35, 0),
(118, 'TITRES DE PARTICIPATION DANS DES ENTITESCONFERANT UNE INFLUENCE NOTABLE', '263', 'actif', 35, 0),
(119, 'PARTICIPATIONS DANS DES ORGANISMES PROFESSIONNELS', '265', 'actif', 35, 0),
(120, 'PARTS DANS DES GROUPEMENTS D\'INTERET ECONOMIQUE (G.I.E.)', '266', 'actif', 35, 0),
(121, 'AUTRES TITRES DE PARTICIPATION', '268', 'actif', 35, 0),
(122, 'PRETS ET CREANCES', '271', 'actif', 36, 0),
(123, 'PRETS AU PERSONNEL', '272', 'actif', 36, 0),
(124, 'CREANCES SUR L\'ETAT', '273', 'actif', 36, 0),
(125, 'TITRES IMMOBILISES', '274', 'actif', 36, 0),
(126, 'DEPOTS ET CAUTIONNEMENTS VERSES', '275', 'actif', 36, 0),
(127, 'INTERETS COURUS', '276', 'actif', 36, 0),
(128, 'CREANCES RATTACHEES A DES PARTICIPATIONS ET AVANCES A DES G.I.E.', '277', 'actif', 36, 0),
(129, 'IMMOBILISATIONS FINANCIERES DIVERSES', '278', 'actif', 36, 0),
(130, 'AMORTISSEMENTS DES IMMOBILISATIONS INCORPORELLES', '281', 'actif', 37, 0),
(131, 'AMORTISSEMENTS DES TERRAINS', '282', 'actif', 37, 0),
(132, 'AMORTISSEMENTS DES BATIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', '283', 'actif', 37, 0),
(133, 'AMORTISSEMENTS DU MATERIEL', '284', 'actif', 37, 0),
(134, 'DEPRECIATIONS DES IMMOBILISATIONS INCORPORELLES', '291', 'actif', 38, 0),
(135, 'DEPRECIATIONS DES TERRAINS ', '292', 'actif', 38, 0),
(136, 'DEPRECIATIONS DES BATIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', '293', 'actif', 38, 0),
(137, 'DEPRECIATIONS DE MATERIEL, DU MOBILIER ET DE L\'ACTIF BIOLOGIQUE', '294', 'actif', 38, 0),
(138, 'DEPRECIATIONS DES AVANCES ET ACOMPTES VERSES SUR IMMOBILISATIONS', '295', 'actif', 38, 0),
(139, 'DEPRECIATIONS DES TITRES DE PARTICIPATION', '296', 'actif', 38, 0),
(140, 'DEPRECIATIONS DES AUTRES IMMOBILISATIONS FINANCIERES', '297', 'actif', 38, 0),
(141, 'MARCHANDISES A', '311', 'actif', 39, 0),
(142, 'MARCHANDISES B', '312', 'actif', 39, 0),
(143, 'ACTIFS BIOLOGIQUES', '313', 'actif', 39, 0),
(144, 'MARCHANDISES HORS ACTIVITES ORDINAIRES (H.A.O.)', '318', 'actif', 39, 0),
(145, 'MATIERES A', '321', 'actif', 40, 0),
(146, 'MATIERES B', '322', 'actif', 40, 0),
(147, 'FOURNITURES (A,B)', '323', 'actif', 40, 0),
(148, 'MATIERES CONSOMMABLES', '331', 'actif', 41, 0),
(149, 'FOURNITURES D\'ATELIER ET D\'USINE', '332', 'actif', 41, 0),
(150, 'FOURNITURES DE MAGASIN', '333', 'actif', 41, 0),
(151, 'FOURNITURES DE BUREAU', '334', 'actif', 41, 0),
(152, 'EMBALLAGES', '335', 'actif', 41, 0),
(153, 'AUTRES MATIERES', '338', 'actif', 41, 0),
(154, 'PRODUITS EN COURS', '341', 'actif', 42, 0),
(155, 'TRAVAUX EN COURS', '342', 'actif', 42, 0),
(156, 'PRODUITS INTERMEDIAIRES EN COURS', '343', 'actif', 42, 0),
(157, 'PRODUITS RESIDUELS EN COURS', '344', 'actif', 42, 0),
(158, 'ACTIFS BIOLOGIQUES', '345', 'actif', 42, 0),
(159, 'ETUDES EN COURS', '351', 'actif', 43, 0),
(160, 'PRESTATIONS DE SERVICES EN COURS', '352', 'actif', 43, 0),
(161, 'PRODUITS FINIS A', '361', 'actif', 44, 0),
(162, 'PRODUITS FINIS B', '362', 'actif', 44, 0),
(163, 'ACTIFS BIOLOGIQUES ', '363', 'actif', 44, 0),
(164, 'PRODUITS INTERMEDIAIRES', '371', 'actif', 45, 0),
(165, 'PRODUITS RESIDUELS', '372', 'actif', 45, 0),
(166, 'ACTIFS BIOLOGIQUES ', '373', 'actif', 45, 0),
(167, 'MARCHANDISES EN COURS DE ROUTE', '381', 'actif', 46, 0),
(168, 'MATIERES PREMIERES ET FOURNITURES LIEES EN COURS DE ROUTE', '382', 'actif', 46, 0),
(169, 'AUTRES APPROVISIONNEMENTS EN COURS DE ROUTE', '383', 'actif', 46, 0),
(170, 'PRODUITS FINIS EN COURS DE ROUTE', '386', 'actif', 46, 0),
(171, 'STOCK EN CONSIGNATION OU EN DEPOT', '387', 'actif', 46, 0),
(172, 'STOCK PROVENANT D\'IMMOBILISATIONS MISES HORS SERVICE OU AU REBUT', '388', 'actif', 46, 0),
(173, 'DEPRECIATIONS DES STOCKS DE MARCHANDISES', '391', 'actif', 47, 0),
(174, 'DEPRECIATIONS DES STOCKS DE MATIERES PREMIERES ET FOURNITURES LIEES', '392', 'actif', 47, 0),
(175, 'DEPRECIATIONS DES STOCKS D\'AUTRES APPROVISIONNEMENTS', '393', 'actif', 47, 0),
(176, 'DEPRECIATIONS DES PRODUCTIONS EN COURS', '394', 'actif', 47, 0),
(177, 'DEPRECIATIONS DES SERVICES EN COURS', '395', 'actif', 47, 0),
(178, 'DEPRECIATIONS DES STOCKS DE PRODUITS FINIS', '396', 'actif', 47, 0),
(179, 'DEPRECIATIONS DES STOCKS DE PRODUITS INTERMEDIAIRES ET RESIDUELS', '397', 'actif', 47, 0),
(180, 'DEPRECIATIONS DES STOCKS EN COURS DE ROUTE, EN CONSIGNATION OU EN DEPOT', '398', 'actif', 47, 0),
(181, 'SECURITE SOCIALE', '431', 'actif', 51, 0),
(182, 'CAISSES DE RETRAITE COMPLEMENTAIRE', '432', 'actif', 51, 0),
(183, 'AUTRES ORGANISMES SOCIAUX', '433', 'actif', 51, 0),
(184, 'ORGANISMES SOCIAUX, CHARGES A PAYER ET PRODUITS A RECEVOIR', '438', 'actif', 51, 0),
(185, 'ETAT, IMPOT SUR LES BENEFICES', '441', 'actif', 52, 0),
(186, 'ETAT, AUTRES IMPOTS ET TAXES', '442', 'actif', 52, 0),
(187, 'ETAT, T.V.A. FACTUREE', '443', 'actif', 52, 0),
(188, 'ETAT, T.V.A. DUE OU CREDIT DE T.V.A.\r\n', '444', 'actif', 52, 0),
(189, 'ETAT, T.V.A. RECUPERABLE', '445', 'actif', 52, 0),
(190, 'ETAT, AUTRES TAXES SUR LE CHIFFRE D\'AFFAIRES', '446', 'actif', 52, 0),
(191, 'ETAT, IMPOTS RETENUS A LA SOURCE', '447', 'actif', 52, 0),
(192, 'ETAT, CHARGES A PAYER ET PRODUITS A RECEVOIR', '448', 'actif', 52, 0),
(193, 'ETAT, CREANCES ET DETTES DIVERSES', '449', 'actif', 52, 0),
(194, 'OPERATIONS AVEC LES ORGANISMES AFRICAINS', '451', 'actif', 53, 0),
(195, 'OPERATIONS AVEC LES AUTRES ORGANISMES INTERNATIONAUX', '452', 'actif', 53, 0),
(196, 'ORGANISMES INTERNATIONAUX, FONDS DE DOTATION ET SUBVENTIONS A RECEVOIR', '458', 'actif', 53, 0),
(197, 'APPORTEURS, OPERATIONS SUR LE CAPITAL', '461', 'actif', 54, 0),
(198, 'ASSOCIES (2), COMPTES COURANTS', '462', 'actif', 54, 0),
(199, 'ASSOCIES (2), OPERATIONS FAITES EN COMMUN ET GIE', '463', 'actif', 54, 0),
(200, 'ASSOCIES (2), DIVIDENDES A PAYER', '465', 'actif', 54, 0),
(201, 'GROUPE, COMPTES COURANTS', '466', 'actif', 54, 0),
(202, 'APPORTEURS RESTANT DU SUR CAPITAL APPELE', '467', 'actif', 54, 0),
(203, 'ENTITE, DIVIDENDES A RECEVOIR', '469', 'actif', 54, 0),
(204, 'DEBITEURS ET CREDITEURS DIVERS ', '471', 'actif', 55, 0),
(205, 'CREANCES ET DETTES SUR TITRES DE PLACEMENT ', '472', 'actif', 55, 0),
(206, 'INTERMEDIAIRES - OPERATIONS FAITES POUR COMPTE DE TIERS', '473', 'actif', 55, 0),
(207, 'COMPTE DE REPARTITION PERIODIQUE DES CHARGES ET DES PRODUITS', '474', 'actif', 55, 0),
(208, 'COMPTE TRANSITOIRE, AJUSTEMENT SPECIAL LIE A LA REVISION DU SYSCOHADA ', '475', 'actif', 55, 0),
(209, 'CHARGES CONSTATEES D\'AVANCE', '476', 'actif', 55, 0),
(210, 'PRODUITS CONSTATES D\'AVANCE', '477', 'actif', 55, 0),
(211, 'ECARTS DE CONVERSION-ACTIF', '478', 'actif', 55, 0),
(212, 'ECARTS DE CONVERSION-PASSIF', '479', 'actif', 55, 0),
(213, 'FOURNISSEURS D\'INVESTISSEMENTS', '481', 'actif', 56, 0),
(214, 'FOURNISSEURS D\'INVESTISSEMENTS, EFFETS A PAYER', '482', 'actif', 56, 0),
(215, 'AUTRES DETTES HORS ACTIVITES ORDINAIRES (H.A.O.)', '484', 'actif', 56, 0),
(216, 'CREANCES SUR CESSIONS D\'IMMOBILISATIONS', '485', 'actif', 56, 0),
(217, 'AUTRES CREANCES HORS ACTIVITES ORDINAIRES (H.A.O.)', '488', 'actif', 56, 0),
(218, 'DEPRECIATIONS DES COMPTES FOURNISSEURS', '490', 'actif', 57, 0),
(219, 'DEPRECIATIONS DES COMPTES CLIENTS', '491', 'actif', 57, 0),
(220, 'DEPRECIATIONS DES COMPTES PERSONNEL', '492', 'actif', 57, 0),
(221, 'DEPRECIATIONS DES COMPTES ORGANISMES SOCIAUX', '493', 'actif', 57, 0),
(222, 'DEPRECIATIONS DES COMPTES ETAT ET COLLECTIVITES PUBLIQUES', '494', 'actif', 57, 0),
(223, 'DEPRECIATIONS DES COMPTES ORGANISMES INTERNATIONAUX', '495', 'actif', 57, 0),
(224, 'DEPRECIATIONS DES COMPTES  ASSOCIES ET GROUPE', '496', 'actif', 57, 0),
(225, 'DEPRECIATIONS DES COMPTES DEBITEURS DIVERS', '497', 'actif', 57, 0),
(226, 'DEPRECIATIONS DES COMPTES DE CREANCES H.A.O.', '498', 'actif', 57, 0),
(227, 'PROVISIONS POUR RISQUES A COURT TERME', '499', 'actif', 57, 0),
(228, 'TITRES DU TRESOR ET BONS DE CAISSE A COURT TERME', '501', 'actif', 58, 0),
(229, 'ACTIONS', '502', 'actif', 58, 0),
(230, 'OBLIGATIONS', '503', 'actif', 58, 0),
(231, 'BONS DE SOUSCRIPTION', '504', 'actif', 58, 0),
(232, 'TITRES NEGOCIABLES HORS REGION', '505', 'actif', 58, 0),
(233, 'INTERETS COURUS', '506', 'actif', 58, 0),
(234, 'AUTRES TITRES DE PLACEMENT ET CREANCES ASSIMILEES', '508', 'actif', 58, 0),
(235, 'EFFETS A ENCAISSER', '511', 'actif', 59, 0),
(236, 'EFFETS A L\'ENCAISSEMENT', '512', 'actif', 59, 0),
(237, 'CHEQUES A ENCAISSER', '513', 'actif', 59, 0),
(238, 'CHEQUES A L\'ENCAISSEMENT', '514', 'actif', 59, 0),
(239, 'CARTES DE CREDIT A ENCAISSER', '515', 'actif', 59, 0),
(240, 'AUTRES VALEURS A L\'ENCAISSEMENT', '518', 'actif', 59, 0),
(241, 'BANQUES LOCALES', '521', 'actif', 60, 0),
(242, 'BANQUES AUTRES ETATS REGION', '522', 'actif', 60, 0),
(243, 'BANQUES AUTRES ETATS ZONE MONETAIRE', '523', 'actif', 60, 0),
(244, 'BANQUES HORS ZONE MONETAIRE', '524', 'actif', 60, 0),
(245, 'BANQUES DEPOT  A TERME ', '525', 'actif', 60, 0),
(246, 'BANQUES, INTERETS  COURUS ', '526', 'actif', 60, 0),
(247, 'CHEQUES POSTAUX', '531', 'actif', 61, 0),
(248, 'TRESOR', '532', 'actif', 61, 0),
(249, 'SOCIETES DE GESTION ET D\'INTERMEDIATION (S.G.I.)', '533', 'actif', 61, 0),
(250, 'ETABLISSEMENTS FINANCIERS, INTERETS COURUS', '536', 'actif', 61, 0),
(251, 'AUTRES ORGANISMES FINANCIERS', '538', 'actif', 61, 0),
(252, 'OPTIONS DE TAUX D\'INTERET', '541', 'actif', 62, 0),
(253, 'OPTIONS DE TAUX DE CHANGE', '542', 'actif', 62, 0),
(254, 'OPTIONS DE TAUX BOURSIERS', '543', 'actif', 62, 0),
(255, 'INSTRUMENTS DE MARCHES A TERME', '544', 'actif', 62, 0),
(256, 'AVOIRS D\'OR ET AUTRES METAUX PRECIEUX (4)', '545', 'actif', 62, 0),
(257, 'MONNAIE ELECTRONIQUE-CARTE CARBURANT', '551', 'actif', 63, 0),
(258, 'MONNAIE ELECTRONIQUE-TELEPHONE PORTABLE', '552', 'actif', 63, 0),
(259, 'MONNAIE ELECTRONIQUE- CARTE PEAGE', '553', 'actif', 63, 0),
(260, 'PORTE-MONNAIE ELECTRONIQUE', '554', 'actif', 63, 0),
(261, 'AUTRES INSTRUMENTS DE MONNAIES ELECTRONIQUES', '558', 'actif', 63, 0),
(262, 'CREDITS DE TRESORERIE', '561', 'actif', 64, 0),
(263, 'ESCOMPTE DE CREDITS DE CAMPAGNE', '564', 'actif', 64, 0),
(264, 'ESCOMPTE DE CREDITS ORDINAIRES', '565', 'actif', 64, 0),
(265, 'BANQUES,  CREDITS DE TRESORERIE, INTERETS  COURUS ', '566', 'actif', 64, 0),
(266, 'CAISSE SIEGE SOCIAL', '571', 'actif', 65, 0),
(267, 'CAISSE SUCCURSALE A', '572', 'actif', 65, 0),
(268, 'CAISSE SUCCURSALE B', '573', 'actif', 65, 0),
(269, 'REGIES D\'AVANCE', '581', 'actif', 66, 0),
(270, 'ACCREDITIFS', '582', 'actif', 66, 0),
(271, 'VIREMENTS DE FONDS', '585', 'actif', 66, 0),
(272, 'AUTRES VIREMENTS INTERNES', '588', 'actif', 66, 0),
(273, 'DEPRECIATIONS DES TITRES DE PLACEMENT', '590', 'actif', 67, 0),
(274, 'DEPRECIATIONS DES TITRES ET VALEURS A ENCAISSER', '591', 'actif', 67, 0),
(275, 'DEPRECIATIONS DES COMPTES BANQUES', '592', 'actif', 67, 0),
(276, 'DEPRECIATIONS DES COMPTES ETABLISSEMENTS FINANCIERS ET ASSIMILES', '593', 'actif', 67, 0),
(277, 'DEPRECIATIONS DES COMPTES D\'INSTRUMENTS DE TRESORERIE', '594', 'actif', 67, 0),
(278, 'PROVISIONS POUR RISQUE A COURT TERME  A CARACTERE FINANCIER', '599', 'actif', 67, 0),
(279, 'FOURNISSEURS, DETTES EN COMPTE', '401', 'actif', 48, 0),
(280, 'FOURNISSEURS, EFFETS A PAYER', '402', 'actif', 48, 0),
(281, 'FOURNISSEURS,ACQUISITIONS COURANTES D\'IMMOBILISATIONS', '404', 'actif', 48, 0),
(282, 'FOURNISSEURS, FACTURES NON PARVENUES', '408', 'actif', 48, 0),
(283, 'FOURNISSEURS DEBITEURS', '409', 'actif', 48, 0),
(284, 'CLIENTS', '411', 'actif', 49, 0),
(285, 'CLIENTS, EFFETS A RECEVOIR EN PORTEFEUILLE', '412', 'actif', 49, 0),
(286, 'CLIENTS, CHEQUES, EFFETS ET AUTRES VALEURS IMPAYES', '413', 'actif', 49, 0),
(287, 'CREANCES SUR CESSIONS COURANTES D\'IMMOBILISATIONS', '414', 'actif', 49, 0),
(288, 'CLIENTS, EFFETS ESCOMPTES NON ECHUS', '415', 'actif', 49, 0),
(289, 'CREANCES CLIENTS LITIGIEUSES OU DOUTEUSES', '416', 'actif', 49, 0),
(290, 'CLIENTS, PRODUITS A RECEVOIR', '418', 'actif', 49, 0),
(291, 'CLIENTS CREDITEURS', '419', 'actif', 49, 0),
(292, 'PERSONNEL, AVANCES ET ACOMPTES', '421', 'actif', 50, 0),
(293, 'PERSONNEL, REMUNERATIONS DUES', '422', 'actif', 50, 0),
(294, 'PERSONNEL, OPPOSITIONS, SAISIES-ARRETS', '423', 'actif', 50, 0),
(295, 'PERSONNEL, OEUVRES SOCIALES INTERNES', '424', 'actif', 50, 0),
(296, 'REPRESENTANTS DU PERSONNEL', '425', 'actif', 50, 0),
(297, 'PERSONNEL, PARTICIPATION AUX BENEFICES ET AU CAPITAL', '426', 'actif', 50, 0),
(298, 'PERSONNEL-DEPOTS', '427', 'actif', 50, 0),
(299, 'PERSONNEL, CHARGES A PAYER ET PRODUITS A RECEVOIR', '428', 'actif', 50, 0),
(300, 'ACHATS DE MARCHANDISES', '601', 'actif', 68, 0),
(301, 'ACHATS DE MATIERES PREMIERES ET FOURNITURES LIEES', '602', 'actif', 68, 0),
(302, 'VARIATIONS DES STOCKS DE BIENS ACHETES', '603', 'actif', 68, 0),
(303, 'ACHATS STOCKES DE MATIERES ET FOURNITURES CONSOMMABLES', '604', 'actif', 68, 0),
(304, 'AUTRES ACHATS', '605', 'actif', 68, 0),
(305, 'ACHATS D\'EMBALLAGES', '608', 'actif', 68, 0),
(306, 'TRANSPORTS SUR VENTES', '612', 'actif', 69, 0),
(307, 'TRANSPORTS POUR LE COMPTE DE TIERS', '613', 'actif', 69, 0),
(308, 'TRANSPORTS DU PERSONNEL ', '614', 'actif', 69, 0),
(309, 'TRANSPORTS DE PLIS', '616', 'actif', 69, 0),
(310, 'AUTRES FRAIS DE TRANSPORT', '618', 'actif', 69, 0),
(311, 'SOUS-TRAITANCE GENERALE', '621', 'actif', 70, 0),
(312, 'LOCATIONS,  CHARGES LOCATIVES', '622', 'actif', 70, 0),
(313, 'REDEVANCES DE LOCATION-ACQUISITION ', '623', 'actif', 70, 0),
(314, 'ENTRETIEN, REPARATIONS, REMISE EN ETAT ET MAINTENANCE', '624', 'actif', 70, 0),
(315, 'PRIMES D\'ASSURANCE', '625', 'actif', 70, 0),
(316, 'ETUDES, RECHERCHES ET DOCUMENTATION', '626', 'actif', 70, 0),
(317, 'PUBLICITE, PUBLICATIONS, RELATIONS PUBLIQUES', '627', 'actif', 70, 0),
(318, 'FRAIS DE TELECOMMUNICATIONS', '628', 'actif', 70, 0),
(319, 'FRAIS BANCAIRES', '631', 'actif', 71, 0),
(320, 'REMUNERATIONS D\'INTERMEDIAIRES ET DE CONSEILS', '632', 'actif', 71, 0),
(321, 'FRAIS DE FORMATION DU PERSONNEL', '633', 'actif', 71, 0),
(322, 'REDEVANCES POUR BREVETS, LICENCES, LOGICIELS, CONCESSIONS, DROITS  ET VALEURS SIMILAIRES', '634', 'actif', 71, 0),
(323, 'COTISATIONS', '635', 'actif', 71, 0),
(324, 'REMUNERATIONS DE PERSONNEL EXTERIEUR A L\'ENTITE', '637', 'actif', 71, 0),
(325, 'AUTRES CHARGES EXTERNES', '638', 'actif', 71, 0),
(326, 'IMPOTS ET TAXES DIRECTS', '641', 'actif', 72, 0),
(327, 'IMPOTS ET TAXES INDIRECTS', '645', 'actif', 72, 0),
(328, 'DROITS D\'ENREGISTREMENT', '646', 'actif', 72, 0),
(329, 'PENALITES, AMENDES FISCALES', '647', 'actif', 72, 0),
(330, 'AUTRES IMPOTS ET TAXES', '648', 'actif', 72, 0),
(331, 'PERTES SUR CREANCES CLIENTS ET AUTRES DEBITEURS', '651', 'actif', 73, 0),
(332, 'QUOTE-PART DE RESULTAT SUR OPERATIONS FAITES EN COMMUN', '652', 'actif', 73, 0),
(333, 'VALEURS COMPTABLES DES CESSIONS COURANTES D\'IMMOBILISATIONS', '654', 'actif', 73, 0),
(334, 'PERTE DE CHANGE SUR CREANCES ET DETTES COMMERCIALE', '656', 'actif', 73, 0),
(335, 'PENALITES ET AMENDES PENALES', '657', 'actif', 73, 0),
(336, 'CHARGES DIVERSES', '658', 'actif', 73, 0),
(337, 'CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES   A COURT TERME D\'EXPLOITATION', '659', 'actif', 73, 0),
(338, 'REMUNERATIONS DIRECTES VERSEES AU PERSONNEL NATIONAL', '661', 'actif', 74, 0),
(339, 'REMUNERATIONS DIRECTES VERSEES AU PERSONNEL NON NATIONAL', '662', 'actif', 74, 0),
(340, 'INDEMNITES FORFAITAIRES VERSEES AU PERSONNEL', '663', 'actif', 74, 0),
(341, 'CHARGES SOCIALES', '664', 'actif', 74, 0),
(342, 'REMUNERATIONS ET CHARGES SOCIALES DE L\'EXPLOITANT INDIVIDUEL', '666', 'actif', 74, 0),
(343, 'REMUNERATION TRANSFEREE DE PERSONNEL EXTERIEUR', '667', 'actif', 74, 0),
(344, 'AUTRES CHARGES SOCIALES', '668', 'actif', 74, 0),
(345, 'INTERETS DES EMPRUNTS', '671', 'actif', 75, 0),
(346, 'INTERETS DANS LOYERS DE LOCATION ACQUISITION ', '672', 'actif', 75, 0),
(347, 'ESCOMPTES ACCORDES', '673', 'actif', 75, 0),
(348, 'AUTRES INTERETS', '674', 'actif', 75, 0),
(349, 'ESCOMPTES DES EFFETS DE COMMERCE', '675', 'actif', 75, 0),
(350, 'PERTES DE CHANGE FINANCIERES', '676', 'actif', 75, 0),
(351, 'PERTES SUR TITRES DE PLACEMENT', '677', 'actif', 75, 0),
(352, 'PERTES ET CHARGES SUR RISQUES FINANCIERS', '678', 'actif', 75, 0),
(353, 'CHARGES POUR DEPRECIATIONS  ET PROVISIONS POUR RISQUES A COURT TERME FINANCIERES', '679', 'actif', 75, 0),
(354, 'DOTATIONS AUX AMORTISSEMENTS D\'EXPLOITATION', '681', 'actif', 76, 0),
(356, 'DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS  D\'EXPLOITATION', '691', 'actif', 77, 0),
(357, 'DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS  FINANCIERES', '697', 'actif', 77, 0),
(358, 'VENTES DE MARCHANDISES', '701', 'actif', 78, 0),
(359, 'VENTES DE PRODUITS FINIS', '702', 'actif', 78, 0),
(360, 'VENTES DE PRODUITS INTERMEDIAIRES', '703', 'actif', 78, 0),
(361, 'VENTES DE PRODUITS RESIDUELS', '704', 'actif', 78, 0),
(362, 'TRAVAUX FACTURES', '705', 'actif', 78, 0),
(363, 'SERVICES VENDUS', '706', 'actif', 78, 0),
(364, 'PRODUITS ACCESSOIRES', '707', 'actif', 78, 0),
(365, 'SUR PRODUITS A L\'EXPORTATION', '711', 'actif', 79, 0),
(366, 'SUR PRODUITS A L\'IMPORTATION', '712', 'actif', 79, 0),
(367, 'SUR PRODUITS DE PEREQUATION', '713', 'actif', 79, 0),
(368, 'INDEMNITES ET SUBVENTIONS D\'EXPLOITATION (entité agricole)', '714', 'actif', 79, 0),
(369, 'AUTRES SUBVENTIONS D\'EXPLOITATION', '718', 'actif', 79, 0),
(370, 'IMMOBILISATIONS INCORPORELLES', '721', 'actif', 80, 0),
(371, 'IMMOBILISATIONS CORPORELLES', '722', 'actif', 80, 0),
(372, 'PRODUCTION AUTO-CONSOMMEE', '724', 'actif', 80, 0),
(373, 'IMMOBILISATIONS FINANCIERES (9)', '726', 'actif', 80, 0),
(374, 'VARIATIONS DES STOCKS DE PRODUITS EN COURS', '734', 'actif', 81, 0),
(375, 'VARIATIONS DES SERVICES EN COURS', '735', 'actif', 81, 0),
(376, 'VARIATIONS DES STOCKS DE PRODUITS FINIS', '736', 'actif', 81, 0),
(377, 'VARIATIONS DES STOCKS DE PRODUITS INTERMEDIAIRES ET RESIDUELS', '737', 'actif', 81, 0),
(378, 'PROFITS SUR CREANCES CLIENTS ET AUTRES DEBITEURS', '751', 'actif', 82, 0),
(379, 'QUOTE-PART DE RESULTAT SUR OPERATIONS FAITES EN COMMUN', '752', 'actif', 82, 0),
(380, 'PRODUITS DES CESSIONS COURANTES D\'IMMOBILISATIONS', '754', 'actif', 82, 0),
(381, 'GAINS DE CHANGE SUR CREANCES ET DETTES COMMERCIALES', '756', 'actif', 82, 0),
(382, 'PRODUITS DIVERS', '758', 'actif', 82, 0),
(383, 'REPRISES DE CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME D\'EXPLOITATION', '759', 'actif', 82, 0),
(384, 'INTERETS DE PRETS ET CREANCES DIVERSES', '771', 'actif', 83, 0),
(385, 'REVENUS DE PARTICIPATIONS ET AUTRES TITRES IMMOBILISES', '772', 'actif', 83, 0),
(386, 'ESCOMPTES OBTENUS', '773', 'actif', 83, 0),
(387, 'REVENUS DE PLACEMENT', '774', 'actif', 83, 0),
(388, 'INTERETS DANS LOYERS DE LOCATION-FINANCEMENT', '775', 'actif', 83, 0),
(389, 'GAINS DE CHANGE FINANCIERS', '776', 'actif', 83, 0),
(390, 'GAINS SUR CESSIONS DE TITRES DE PLACEMENT', '777', 'actif', 83, 0),
(391, 'GAINS SUR RISQUES FINANCIERS', '778', 'actif', 83, 0),
(392, 'REPRISES DE CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME FINANCIERES ', '779', 'actif', 83, 0),
(393, 'TRANSFERTS DE CHARGES D\'EXPLOITATION', '781', 'actif', 84, 0),
(394, 'TRANSFERTS DE CHARGES FINANCIERES', '787', 'actif', 84, 0),
(395, 'REPRISES DE PROVISIONS ET DEPRECIATIONS D\'EXPLOITATION', '791', 'actif', 85, 0),
(396, 'REPRISES DE PROVISIONS ET DEPRECIATIONS  FINANCIERES', '797', 'actif', 85, 0),
(397, 'REPRISES D\'AMORTISSEMENTS (10)', '798', 'actif', 85, 0),
(398, 'REPRISES DE SUBVENTIONS D\'INVESTISSEMENT', '799', 'actif', 85, 0),
(399, 'IMMOBILISATIONS INCORPORELLES', '811', 'actif', 86, 0),
(400, 'IMMOBILISATIONS CORPORELLES', '812', 'actif', 86, 0),
(401, 'IMMOBILISATIONS FINANCIERES', '816', 'actif', 86, 0),
(402, 'IMMOBILISATIONS INCORPORELLES', '821', 'actif', 87, 0),
(403, 'IMMOBILISATIONS CORPORELLES', '822', 'actif', 87, 0),
(404, 'IMMOBILISATIONS FINANCIERES', '826', 'actif', 87, 0),
(405, 'CHARGES H.A.O. CONSTATEES', '831', 'actif', 88, 0),
(406, 'CHARGES LIEES AUX OPERATIONS DE RESTRUCTURATION', '833', 'actif', 88, 0),
(407, 'PERTES SUR CREANCES H.A.O.', '834', 'actif', 88, 0),
(408, 'DONS ET LIBERALITES ACCORDES', '835', 'actif', 88, 0),
(409, 'ABANDONS DE CREANCES CONSENTIS', '836', 'actif', 88, 0),
(410, 'CHARGES LIEES AUX OPERATIONS DE LIQUIDATION ', '837', 'actif', 88, 0),
(411, 'CHARGES  POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME H.A.O.', '839', 'actif', 88, 0),
(412, 'PRODUITS H.A.O CONSTATES', '841', 'actif', 89, 0),
(413, 'PRODUITS LIES AUX OPERATIONS DE RESTRUCTURATION', '843', 'actif', 89, 0),
(414, 'INDEMNITES ET SUBVENTIONS H.A.O.(entité agricole)', '844', 'actif', 89, 0),
(415, 'DONS ET LIBERALITES OBTENUS', '845', 'actif', 89, 0),
(416, 'ABANDONS DE CREANCES OBTENUS', '846', 'actif', 89, 0),
(417, 'PRODUITS LIES AUX OPERATIONS DE LIQUIDATION', '847', 'actif', 89, 0),
(418, 'TRANSFERTS DE CHARGES H.A.O', '848', 'actif', 89, 0),
(419, 'REPRISES DE CHARGES POUR DEPRECIATIONS ET PROVISIONS POUR RISQUES A COURT TERME H.A.O. ', '849', 'actif', 89, 0),
(420, 'DOTATIONS AUX PROVISIONS REGLEMENTEES', '851', 'actif', 90, 0),
(421, 'DOTATIONS AUX AMORTISSEMENTS H.A.O.', '852', 'actif', 90, 0),
(422, 'DOTATIONS AUX DEPRECIATIONS H.A.O.', '853', 'actif', 90, 0),
(423, 'DOTATIONS AUX PROVISIONS POUR RISQUES ET CHARGES H.A.O.', '854', 'actif', 90, 0),
(424, 'AUTRES DOTATIONS H.A.O.', '858', 'actif', 90, 0),
(425, 'REPRISES DE PROVISIONS REGLEMENTEES', '861', 'actif', 91, 0),
(426, 'REPRISES D\'AMORTISSEMENTS H.A.O', '862', 'actif', 91, 0),
(427, 'REPRISES DE DEPRECIATIONS H.A.O.', '863', 'actif', 91, 0),
(428, 'REPRISES DE PROVISIONS POUR RISQUES ET CHARGES H.A.O.', '864', 'actif', 91, 0),
(429, 'AUTRES REPRISES H.A.O.', '868', 'actif', 91, 0),
(430, 'PARTICIPATION LEGALE AUX BENEFICES', '871', 'actif', 92, 0),
(431, 'PARTICIPATION CONTRACTUELLE AUX BENEFICES', '874', 'actif', 92, 0),
(432, 'AUTRES PARTICIPATIONS', '878', 'actif', 92, 0),
(433, 'ETAT', '881', 'actif', 93, 0),
(434, 'COLLECTIVITES PUBLIQUES', '884', 'actif', 93, 0),
(435, 'GROUPE', '886', 'actif', 93, 0),
(436, 'AUTRES', '888', 'actif', 93, 0),
(437, 'IMPOTS SUR LES BENEFICES DE L\'EXERCICE', '891', 'actif', 94, 0),
(438, 'RAPPEL D\'IMPOTS SUR RESULTATS ANTERIEURS', '892', 'actif', 94, 0),
(439, 'IMPOT MINIMUM FORFAITAIRE (I.M.F.)', '895', 'actif', 94, 0),
(440, 'DEGREVEMENTS ET ANNULATIONS D\'IMPOTS SUR RESULTATS ANTERIEURS', '899', 'actif', 94, 0),
(441, 'ENGAGEMENTS DE FINANCEMENT OBTENUS', '901', 'actif', 99, 0),
(442, 'ENGAGEMENTS DE GARANTIE OBTENUS', '902', 'actif', 99, 0),
(443, 'ENGAGEMENTS RECIPROQUES', '903', 'actif', 99, 0),
(444, 'AUTRES ENGAGEMENTS OBTENUS', '904', 'actif', 99, 0),
(445, 'ENGAGEMENTS DE FINANCEMENT ACCORDES', '905', 'actif', 99, 0),
(446, 'ENGAGEMENTS DE GARANTIE ACCORDES', '906', 'actif', 99, 0),
(447, 'ENGAGEMENTS RECIPROQUES', '907', 'actif', 99, 0),
(448, 'AUTRES ENGAGEMENTS ACCORDES', '908', 'actif', 99, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cptcomptesites`
--

DROP TABLE IF EXISTS `cptcomptesites`;
CREATE TABLE IF NOT EXISTS `cptcomptesites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compte_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptjournal`
--

INSERT INTO `cptjournal` (`id`, `code`, `libelle`, `psedo`, `site_id`) VALUES
(1, 'HA', 'Achat', 0, NULL),
(2, 'VT', 'Ventes', 0, NULL),
(3, 'CA', 'Caisse', 0, NULL),
(4, 'BQ', 'Banque', 0, NULL),
(5, 'OD', 'Operations diverses', 0, NULL),
(6, 'AN', 'A-Nouveaux', 0, NULL);

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
  PRIMARY KEY (`id`),
  KEY `compte_id` (`compte_num`,`journal_id`),
  KEY `journal_id` (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptjournalcompte`
--

INSERT INTO `cptjournalcompte` (`id`, `compte_num`, `journal_id`, `long_compte`) VALUES
(16, 601, 1, 3),
(17, 602, 1, 3),
(18, 604, 1, 3),
(19, 605, 1, 3),
(20, 608, 1, 3),
(23, 6011, 1, 4),
(24, 6012, 1, 4),
(25, 6013, 1, 4),
(26, 6014, 1, 4),
(27, 6015, 1, 4),
(28, 6016, 1, 4),
(29, 6017, 1, 4),
(30, 6018, 1, 4),
(31, 6019, 1, 4),
(32, 6021, 1, 4),
(33, 6022, 1, 4),
(34, 6023, 1, 4),
(35, 6024, 1, 4),
(36, 6025, 1, 4),
(37, 6026, 1, 4),
(38, 6027, 1, 4),
(39, 6028, 1, 4),
(40, 6029, 1, 4),
(41, 6041, 1, 4),
(42, 6042, 1, 4),
(43, 6043, 1, 4),
(44, 6044, 1, 4),
(45, 6045, 1, 4),
(46, 6046, 1, 4),
(47, 6047, 1, 4),
(48, 6048, 1, 4),
(49, 6049, 1, 4),
(50, 6051, 1, 4),
(51, 6052, 1, 4),
(52, 6053, 1, 4),
(53, 6054, 1, 4),
(54, 6055, 1, 4),
(55, 6056, 1, 4),
(56, 6057, 1, 4),
(57, 6058, 1, 4),
(58, 6059, 1, 4),
(59, 6081, 1, 4),
(60, 6082, 1, 4),
(61, 6083, 1, 4),
(62, 6084, 1, 4),
(63, 6085, 1, 4),
(64, 6086, 1, 4),
(65, 6087, 1, 4),
(66, 6088, 1, 4),
(67, 6089, 1, 4),
(68, 6181, 1, 4),
(69, 6182, 1, 4),
(70, 6183, 1, 4),
(71, 611, 1, 3),
(72, 612, 1, 3),
(73, 613, 1, 3),
(74, 614, 1, 3),
(75, 616, 1, 3),
(76, 618, 1, 3),
(77, 4452, 1, 4),
(78, 4011, 1, 4),
(79, 445, 1, 3),
(80, 4451, 1, 4),
(81, 4453, 1, 4),
(82, 4454, 1, 4),
(83, 4455, 1, 4),
(84, 4456, 1, 4),
(85, 40, 1, 2),
(86, 401, 1, 3),
(87, 4011, 1, 4),
(88, 4012, 1, 4),
(89, 4013, 1, 4),
(90, 4016, 1, 4),
(91, 4017, 1, 4),
(92, 402, 1, 3),
(93, 4021, 1, 4),
(94, 4022, 1, 4),
(95, 4023, 1, 4),
(96, 404, 1, 3),
(97, 4041, 1, 4),
(98, 4042, 1, 4),
(99, 4046, 1, 4),
(100, 4047, 1, 4),
(101, 408, 1, 3),
(102, 4081, 1, 4),
(103, 4082, 1, 4),
(104, 4083, 1, 4),
(105, 4086, 1, 4),
(106, 409, 1, 3),
(107, 4093, 1, 4),
(108, 4094, 1, 4),
(109, 4098, 1, 4),
(153, 411, 2, 3),
(154, 4111, 2, 4),
(155, 4112, 2, 4),
(156, 4114, 2, 4),
(157, 4115, 2, 4),
(158, 4116, 2, 4),
(159, 4117, 2, 4),
(160, 4118, 2, 4),
(161, 412, 2, 3),
(162, 4121, 2, 4),
(163, 4122, 2, 4),
(164, 4124, 2, 4),
(165, 4125, 2, 4),
(166, 413, 2, 3),
(167, 4131, 2, 4),
(168, 4132, 2, 4),
(169, 4133, 2, 4),
(170, 4138, 2, 4),
(171, 414, 2, 3),
(172, 4141, 2, 4),
(173, 4142, 2, 4),
(174, 4146, 2, 4),
(175, 4147, 2, 4),
(176, 415, 2, 3),
(177, 416, 2, 3),
(178, 4161, 2, 4),
(179, 4162, 2, 4),
(180, 418, 2, 3),
(181, 4181, 2, 4),
(182, 4186, 2, 4),
(183, 419, 2, 3),
(184, 4191, 2, 4),
(185, 4192, 2, 4),
(186, 4194, 2, 4),
(187, 4198, 2, 4),
(188, 443, 2, 3),
(189, 4431, 2, 4),
(190, 4432, 2, 4),
(191, 4433, 2, 4),
(192, 4334, 2, 4),
(193, 4335, 2, 4),
(194, 56, 4, 2),
(195, 561, 4, 3),
(196, 564, 4, 3),
(197, 565, 4, 3),
(198, 566, 4, 3),
(199, 60, 1, 2),
(200, 40, 1, 2),
(201, 41, 2, 2),
(202, 52, 4, 2),
(203, 521, 4, 3),
(204, 5211, 4, 4),
(205, 5215, 4, 4),
(206, 522, 4, 3),
(207, 523, 4, 3),
(208, 524, 4, 3),
(209, 525, 4, 3),
(210, 526, 4, 3),
(211, 5261, 4, 4),
(212, 5267, 4, 4),
(213, 70, 2, 2),
(214, 701, 2, 3),
(215, 7011, 2, 4),
(216, 7012, 2, 4),
(217, 7013, 2, 4),
(218, 7014, 2, 4),
(219, 7015, 2, 4),
(220, 7019, 2, 4),
(221, 702, 2, 3),
(222, 7021, 2, 4),
(223, 7022, 2, 4),
(224, 7023, 2, 4),
(225, 7024, 2, 4),
(226, 7025, 2, 4),
(227, 7029, 2, 4),
(228, 703, 2, 3),
(229, 7031, 2, 4),
(230, 7032, 2, 4),
(231, 7033, 2, 4),
(232, 7034, 2, 4),
(233, 7035, 2, 4),
(234, 7039, 2, 4),
(235, 704, 2, 3),
(236, 7041, 2, 4),
(237, 7042, 2, 4),
(238, 7043, 2, 4),
(239, 7044, 2, 4),
(240, 7045, 2, 4),
(241, 7049, 2, 4),
(242, 705, 2, 3),
(243, 7051, 2, 4),
(244, 7052, 2, 4),
(245, 7053, 2, 4),
(246, 7054, 2, 4),
(247, 7055, 2, 4),
(248, 7059, 2, 4),
(249, 706, 2, 3),
(250, 7061, 2, 4),
(251, 7062, 2, 4),
(252, 7063, 2, 4),
(253, 7064, 2, 4),
(254, 7065, 2, 4),
(255, 7069, 2, 4),
(256, 707, 2, 3),
(257, 7071, 2, 4),
(258, 7072, 2, 4),
(259, 7073, 2, 4),
(260, 7074, 2, 4),
(261, 7075, 2, 4),
(262, 7076, 2, 4),
(263, 7077, 2, 4),
(264, 7078, 2, 4);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptmodeles`
--

INSERT INTO `cptmodeles` (`id`, `compte_id`, `saufbrut`, `partielbrut`, `rubrique`, `solde`, `signevar`, `code`, `amortprov`, `saufamort`, `partielamort`, `format`, `ref`, `note`, `signe`, `typeligne`, `ba`, `bp`, `r`) VALUES
(1, NULL, '0', NULL, '<b>IMMOBILISATIONS INCORPORELLES</b>', 0, NULL, '', '0', NULL, NULL, 3, 'AD', '3', 1, 1, 1, 0, 0),
(2, '211,2181,2191', '0', NULL, 'Frais de d&eacute;veloppement et de prospection', 0, NULL, '', '2811,2818,2911,2918,2919', NULL, NULL, 3, 'AE', NULL, 1, 0, 1, 0, 0),
(3, '212,213,214,2193', '0', NULL, 'Brevets,licences,logiciels et droits similaires', 0, NULL, '', '2812,2813,2814,2912,2913,2914,2919', NULL, NULL, 2, 'AF', NULL, 1, 0, 1, 0, 0),
(4, '215,216', '0', NULL, 'Fonds commercial et droit au bail', 0, NULL, '', '2815,2816,2915,2916', NULL, NULL, 3, 'AG', NULL, 1, 0, 1, 0, 0),
(5, '217,218,2198', '2181', NULL, 'Autres immobilisations incorporelles', 0, NULL, '', '2817,2818,2917,2918,2919', NULL, NULL, 3, 'AH', NULL, 1, 0, 1, 0, 0),
(6, NULL, '0', NULL, '<b>IMMOBILISATIONS CORPORELLES</b>', 0, NULL, '', '0', NULL, NULL, 3, 'AJ', '3', 1, 1, 1, 0, 0),
(7, '22', '0', NULL, 'Terrains(1)\r\n(1) dont placement en net\r\n......./........', 0, NULL, '', '282,292', NULL, NULL, 2, 'AJ', NULL, 1, 0, 1, 0, 0),
(8, '231,232,233,237,2391', '0', NULL, 'B&acirc;timents(1)\r\n(1) dont placement en net\r\n......./........', 0, NULL, '', '2831,2832,2833,2837,2931,2932,2933,2937,2939', NULL, NULL, 2, 'AK', NULL, 1, 0, 1, 0, 0),
(9, '234,235,238,2392,2393', '245,2451,2452,2453,2454,2455,2456,2457,2458,2495', NULL, 'Am&eacute;nagement,agencements et installations', 0, NULL, '', '2834,2835,2838,2934,2935,2938,2939', NULL, NULL, 3, 'AL', NULL, 1, 0, 1, 0, 0),
(10, '24', '245,2495,2451,2452,2453,2454,2455,2456,2457,2458', '2949', 'Mat&eacute;riel,mobilier et actifs biologiques', 0, NULL, '', '284,294,2949', '2845,2945,2949', NULL, 3, 'AM', NULL, 1, 0, 1, 0, 0),
(11, '245, 2495', '0', NULL, 'Mat&eacute;riel de transport', 0, NULL, '', '2845,2948,2949', NULL, NULL, 3, 'AN', NULL, 1, 0, 1, 0, 0),
(12, '251,252', '0', NULL, 'Avances et acomptes vers&eacute;s sur immobilisations', 0, NULL, '', '2951,2952', NULL, NULL, 3, 'AP', '3', 1, 0, 1, 0, 0),
(13, NULL, '0', NULL, '<b>IMMOBILISATIONS FINANCIERES</b>', 0, NULL, '', '0', NULL, NULL, 3, 'AQ', '4', 1, 1, 1, 0, 0),
(14, '26', '0', NULL, 'Titres de participation', 0, NULL, '', '296', NULL, NULL, 3, 'AR', NULL, 1, 0, 1, 0, 0),
(15, '27', '0', NULL, 'Autres immobilisations financi&egrave;res', 0, NULL, '', '297', NULL, NULL, 3, 'AS', NULL, 1, 0, 1, 0, 0),
(16, NULL, '0', NULL, '<b>TOTAL ACTIF IMMOBILISE(I)</b>', 0, NULL, 'TAI', '0', NULL, NULL, 3, 'AZ', NULL, 1, 2, 1, 0, 0),
(17, '485,488', '0', NULL, 'ACTIF CIRCULANT HAO', 0, NULL, '', '498', NULL, NULL, 3, 'BA', '5', 1, 0, 1, 0, 0),
(18, '31,32,33,34,35,36,37,38', '0', NULL, 'STOCKS ET ENCOURS', 0, NULL, '', '39\r\n', NULL, NULL, 3, 'BB', '6', 1, 0, 1, 0, 0),
(19, NULL, '0', NULL, 'CREANCES ET EMPLOIS ASSIMILES', 0, NULL, '', '0', NULL, NULL, 3, 'BG', NULL, 1, 0, 1, 0, 0),
(20, '409', '0', NULL, 'Fournisseurs,avances vers&eacute;es', 0, NULL, '', '490', NULL, NULL, 2, 'BH', '17', 1, 0, 1, 0, 0),
(21, '41', '419,4191,4192,4194,4198,4114', NULL, 'Clients', 0, NULL, '', '491', NULL, NULL, 3, 'BI', '7', 1, 0, 1, 0, 0),
(22, '185,42,43,44,45,46,47 ', '478,4781,4782,4783,4784,4786,4788', NULL, 'Autres cr&eacute;ances', 1, NULL, '', '492,493,494,495,496,497', NULL, NULL, 3, 'BJ', '8', 1, 0, 1, 0, 0),
(23, NULL, '0', NULL, '<b>TOTAL ACTIF CIRCULANT(II)</b>', 0, NULL, 'TAC', '0', NULL, NULL, 3, 'BK', '9', 1, 2, 1, 0, 0),
(24, '50', '0', NULL, 'Titres de placement', 0, NULL, '', '590', NULL, NULL, 3, 'BQ', '9', 1, 0, 1, 0, 0),
(25, '51', '0', NULL, 'Valeurs &agrave; encaisser', 0, NULL, '', '591', NULL, NULL, 3, 'BR', '10', 1, 0, 1, 0, 0),
(26, '52,53,54,55,57,581,582,592,593,594', '0', NULL, 'Banques,Ch&egrave;ques postaux,Caisse et assimil&eacute;es', 1, NULL, '', '592,593,594', NULL, NULL, 3, 'BS', '11', 1, 0, 1, 0, 0),
(27, '', '0', NULL, '<b>TOTAL TRESORERIE-ACTIF(III)</b>', 0, NULL, 'TTA', '0', NULL, NULL, 3, 'BT', NULL, 1, 2, 1, 0, 0),
(28, '478', '0', NULL, 'Ecarts de conversion-Actif(IV)', 0, NULL, 'ECA', '0', NULL, NULL, 3, 'BU', '12', 1, 0, 1, 0, 0),
(29, '', '0', NULL, '<b>TOTAL GENERAL (I+II+III+IV)</b>', 0, NULL, 'TG', '0', NULL, NULL, 3, 'BZ', NULL, 1, 2, 1, 0, 0),
(30, '10', '105,1051,1052,1053,1054,1058,106,1061,1062,109', NULL, 'Capital', 0, NULL, '', '0', NULL, NULL, 3, 'CA', '13', 1, 1, 0, 1, 0),
(31, '109', NULL, NULL, 'Apporteurs capital non appel&eacute; (-)', 0, NULL, '', '0', NULL, NULL, 3, 'CB', '13', 1, 0, 0, 1, 0),
(32, '105', NULL, NULL, 'Primes li&eacute;es au capital social', 0, NULL, '', '0', NULL, NULL, 3, 'CD', '14', NULL, 0, 0, 1, 0),
(33, '106', NULL, NULL, 'Ecarts de r&eacute;&eacute;valuation', 0, NULL, '', '0', NULL, NULL, 3, 'CE', NULL, 1, 0, 0, 1, 0),
(34, '111,112,113', NULL, NULL, 'R&eacute;serves indisponibles', 0, NULL, '', '0', NULL, NULL, 3, 'CF', '14', 1, 0, 0, 1, 0),
(35, '118', NULL, NULL, 'R&eacute;serves libres', 0, NULL, '', '0', NULL, NULL, 3, 'CG', '14', 1, 0, 0, 1, 0),
(36, '121,129', NULL, NULL, 'Report &agrave; nouveau + ou -', 0, NULL, '', '0', NULL, NULL, 3, 'CH', '14', 1, 0, 0, 1, 0),
(37, '131,139', NULL, NULL, 'R&eacute;sultat net de l\'exercice(b&eacute;n&eacute;fice + ou perte -)', 0, NULL, '', '0', NULL, NULL, 3, 'CI', NULL, 1, 1, 0, 1, 0),
(38, '14', NULL, NULL, 'Subventions d\'investissement', 0, NULL, '', '0', NULL, NULL, 3, 'CL', '15', 1, 1, 0, 1, 0),
(39, '15', NULL, NULL, 'Provisions reglement&eacute;es', 0, NULL, '', '0', NULL, NULL, 3, 'CM', '15', 1, 1, 0, 1, 0),
(40, NULL, NULL, NULL, '<b>TOTAL CAPITAUX PROPRES ET RESSOURCES ASSIMILEES(I)</b>', 0, NULL, 'TCPRA', '0', NULL, NULL, 3, 'CP', NULL, 1, 2, 0, 1, 0),
(65, '16,181,182,183,184', NULL, NULL, 'Emprunts et dettes financi&egrave;res diverses', 0, NULL, '', '0', NULL, NULL, 3, 'DA', '16', 1, 1, 0, 1, 0),
(66, '17', NULL, NULL, 'Dettes de location acquisition', 0, NULL, '', '0', NULL, NULL, 3, 'DB', '16', 1, 1, 0, 1, 0),
(67, '19', NULL, NULL, 'Provision pour risques et charges', 0, NULL, '', '0', NULL, NULL, 3, 'DC', '16', 1, 1, 0, 1, 0),
(68, NULL, NULL, NULL, '<b>TOTAL DETTES FINANCIERES ET RESSOURCES ASSIMILEES</b>', 0, NULL, 'TDFRA', '0', NULL, NULL, 3, 'DD', NULL, 1, 0, 0, 1, 0),
(69, NULL, NULL, NULL, '<b>TOTAL RESSOURCES STABLES(I)</b>', 0, NULL, '', '0', NULL, NULL, 3, 'DF', NULL, 1, 2, 0, 1, 0),
(70, '481,482,484,4998', '409,4091,4092,4093,4094,4098', NULL, 'Dettes circulantes HAO', 0, NULL, '', '0', NULL, NULL, 3, 'DH', '5', 1, 0, 0, 1, 0),
(71, '419,4114', NULL, NULL, 'Clients,avances re&ccedil;ues', 0, NULL, '', '0', NULL, NULL, 3, 'DI', '7', 1, 0, 0, 1, 0),
(72, '40', '409,4091,4092,4093,4094,4098', NULL, 'Fournisseurs d\'exploitation', 0, NULL, '', '0', NULL, NULL, 3, 'DJ', '17', 1, 0, 0, 1, 0),
(73, '42,43,44', NULL, NULL, 'Dettes fiscales et sociales', 2, NULL, '', '0', NULL, NULL, 3, 'DK', '18', 1, 0, 0, 1, 0),
(74, '185,45,46,47', '479,4791,4792,4793,4794,4797,4798', NULL, 'Autres dettes', 2, NULL, '', '0', NULL, NULL, 3, 'DM', '19', 1, 0, 0, 1, 0),
(75, '499,599', '4998', NULL, 'Provisions pour risques a court terme', 0, NULL, '', '0', NULL, NULL, 3, 'DN', '19', 1, 0, 0, 1, 0),
(76, NULL, NULL, NULL, '<b>TOTAL PASSIF CIRCULANT (II)</b>', 0, NULL, 'TPC', '0', NULL, NULL, 3, 'DP', NULL, NULL, 2, 0, 1, 0),
(83, '564,565', NULL, NULL, 'Banques,cr&eacute;dits d\'escompte', 0, NULL, '', '0', NULL, NULL, 3, 'DO', '20', 1, 0, 0, 1, 0),
(84, '52,53,561,566', NULL, NULL, 'Banques,&eacute;tablissements financiers et cr&eacute;dits de tr&eacute;sorerie', 2, NULL, '', '0', NULL, NULL, 3, 'DR', '20', 1, 0, 0, 1, 0),
(85, NULL, NULL, NULL, '<b>TOTAL TRESORERIE - PASSIF (III)</b>', 0, NULL, 'TTP', '0', NULL, NULL, 3, 'DT', NULL, 1, 2, 0, 1, 0),
(86, '479', NULL, NULL, 'Ecarts de conversion - Passif (IV)', 0, NULL, 'ECP', '0', NULL, NULL, 3, 'DV', '12', NULL, 0, 0, 1, 0),
(87, NULL, NULL, NULL, '<b>TOTAL GENERAL (I+II+III+IV)</b>', 0, NULL, 'TGP', '0', NULL, NULL, 3, 'DZ', NULL, 1, 2, 0, 1, 0),
(88, '701', '0', NULL, 'Ventes de marchandises(A)                                                       ', 0, '+', 'TA', '0', NULL, NULL, 3, 'TA', '21', NULL, 0, 0, 0, 2),
(89, '601', '0', NULL, 'Achats de marchandises', 0, '-', 'RA', '0', NULL, NULL, 3, 'RA', '22', NULL, 0, 0, 0, 1),
(90, '6031', '0', NULL, 'Variation de stocks de marchandises', 0, '-/+', 'RB', '0', NULL, NULL, 3, 'RB', '6', NULL, 0, 0, 0, 1),
(91, '', '0', NULL, 'MARGE COMMERCIALE (Somme TA à RB)', 0, NULL, 'XA', '0', NULL, NULL, 3, 'XA', NULL, NULL, 2, 0, 0, 1),
(92, '702,703,704', '0', NULL, 'Ventes de produits fabriqués(B)', 0, '+', 'TB', '0', NULL, NULL, 3, 'TB', '21', NULL, 0, 0, 0, 2),
(93, '705,706', '0', NULL, 'Travaux, services vendus(C)', 0, '+', 'TC', '0', NULL, NULL, 3, 'TC', '21', NULL, 0, 0, 0, 2),
(94, '707', '0', NULL, 'Produits accessoires(D)', 0, '+', 'TD', '0', NULL, NULL, 3, 'TD', '21', NULL, 0, 0, 0, 2),
(95, '', '0', NULL, 'CHIFFRE D\'AFFAIRES (A+B+C+D)', 0, NULL, 'XB', '0', NULL, NULL, 3, 'XB', NULL, NULL, 2, 0, 0, 1),
(96, '73', '0', NULL, 'Production stockée (ou déstockage)', 0, '-/+', 'TE', '0', NULL, NULL, 3, 'TE', '6', NULL, 0, 0, 0, 2),
(97, '72', '0', NULL, 'Production immobilisée', 0, NULL, 'TF', '0', NULL, NULL, 3, 'TF', '21', NULL, 0, 0, 0, 2),
(98, '71', '0', NULL, 'Subventions d’exploitation', 0, NULL, 'TG', '0', NULL, NULL, 3, 'TG', '21', NULL, 0, 0, 0, 2),
(99, '75', '0', NULL, 'Autres produits', 0, '+', 'TH', '0', NULL, NULL, 3, 'TH', '21', NULL, 0, 0, 0, 2),
(100, '781', '0', NULL, 'Transferts de charges d\'exploitation', 0, '+', 'TI', '0', NULL, NULL, 3, 'TI', '12', NULL, 0, 0, 0, 1),
(101, '602', '0', NULL, 'Achats de matières premières et fournitures liées', 0, '-', 'RC', '0', NULL, NULL, 3, 'RC', '22', NULL, 0, 0, 0, 1),
(102, '6032', '0', NULL, 'Variation de stocks de matières premières et fournitures liées', 0, '-/+', 'RD', '0', NULL, NULL, 3, 'RD', '6', NULL, 0, 0, 0, 1),
(103, '604,605,608', '0', NULL, 'Autres achats', 0, '-', 'RE', '0', NULL, NULL, 3, 'RE', '22', NULL, 0, 0, 0, 1),
(104, '6033', '0', NULL, 'Variation de stocks d’autres approvisionnements', 0, '-/+', 'RF', '0', NULL, NULL, 3, 'RF', '6', NULL, 0, 0, 0, 1),
(105, '61', '0', NULL, 'Transports', 0, '-', 'RG', '0', NULL, NULL, 3, 'RG', '23', NULL, 0, 0, 0, 1),
(106, '62,63', '0', NULL, 'Services extérieurs', 0, '-', 'RH', '0', NULL, NULL, 3, 'RH', '24', NULL, 0, 0, 0, 1),
(107, '64', '0', NULL, 'Impôts et taxes', 0, '-', 'RI', '0', NULL, NULL, 3, 'RI', '25', NULL, 0, 0, 0, 1),
(108, '65', '0', NULL, 'Autres charges', 0, '-', 'RJ', '0', NULL, NULL, 3, 'RJ', '26', NULL, 0, 0, 0, 1),
(109, '', '0', NULL, 'VALEUR AJOUTEE (XB+RA+RB)+ (somme TE à RJ)', 0, NULL, 'XC', '0', NULL, NULL, 3, 'XC', NULL, NULL, 2, 0, 0, 1),
(110, '66', '0', NULL, 'Charges de personnel', 0, '-', 'RK', '0', NULL, NULL, 3, 'RK', '27', NULL, 0, 0, 0, 1),
(111, '', '0', NULL, 'EXCEDENT BRUT D\'EXPLOITATION (XC+RK)', 0, NULL, 'XD', '0', NULL, NULL, 3, 'XD', '28', NULL, 2, 0, 0, 1),
(112, '791,798,799', '0', NULL, 'Reprises d’amortissements, provisions et dépréciations', 0, '+', 'TJ', '0', NULL, NULL, 3, 'TJ', '28', NULL, 0, 0, 0, 2),
(113, '681,691', '0', NULL, 'Dotations aux amortissements, aux provisions et dépréciations', 0, '-', 'RL', '0', NULL, NULL, 3, 'RL', '3c&28', NULL, 0, 0, 0, 1),
(114, '', '0', NULL, 'RESULTAT D\'EXPLOITATION (XD+TJ+RL)', 0, NULL, 'XE', '0', NULL, NULL, 3, 'XE', NULL, NULL, 2, 0, 0, 1),
(115, '77', '0', NULL, 'Revenus financiers et assimilés', 0, '+', 'TK', '0', NULL, NULL, 3, 'TK', '29', NULL, 0, 0, 0, 2),
(116, '797', '0', NULL, 'Reprises de provisions et dépréciations financières', 0, '+', 'TL', '0', NULL, NULL, 3, 'TL', '28', NULL, 0, 0, 0, 2),
(117, '787', '0', NULL, 'Transferts de charges financières', 0, '+', 'TM', '0', NULL, NULL, 3, 'TM', '12', NULL, 0, 0, 0, 2),
(118, '67', '0', NULL, 'Frais financiers et charges assimilées', 0, '-', 'RM', '0', NULL, NULL, 3, 'RM', '29', NULL, 0, 0, 0, 1),
(119, '697', '0', NULL, 'Dotations aux provisions et aux dépréciations financières', 0, '-', 'RN', '0', NULL, NULL, 3, 'RN', '3c&28', NULL, 0, 0, 0, 1),
(120, '', '0', NULL, 'RESULTAT FINANCIER (Somme TK à RN)', 0, NULL, 'XF', '0', NULL, NULL, 3, 'XF', NULL, NULL, 2, 0, 0, 1),
(121, '', '0', NULL, 'RESULTAT DES ACTIVITES ORDINAIRES (XE+XF)', 0, NULL, 'XG', '0', NULL, NULL, 3, 'XG', NULL, NULL, 2, 0, 0, 1),
(122, '82', '0', NULL, 'Produits des cessions d\'immobilisations', 0, '+', 'TN', '0', NULL, NULL, 3, 'TN', '3D', NULL, 0, 0, 0, 2),
(123, '84,86,88', '0', NULL, 'Autres Produits HAO', 0, '+', 'TO', '0', NULL, NULL, 3, 'TO', '30', NULL, 0, 0, 0, 2),
(124, '81', '0', NULL, 'Valeurs comptables des cessions d\'immobilisations', 0, '-', 'RO', '0', NULL, NULL, 3, 'RO', '3D', NULL, 0, 0, 0, 1),
(125, '83,85', '0', NULL, 'Autres Charges HAO', 0, NULL, 'RP', '0', NULL, NULL, 3, 'RP', '3D', NULL, 0, 0, 0, 1),
(126, '', '0', NULL, 'RESULTAT HORS ACTIVITES ORDINAIRES (somme TN à RP)', 0, NULL, 'XH', '0', NULL, NULL, 3, 'XH', NULL, NULL, 2, 0, 0, 1),
(127, '87', '0', NULL, 'Participation des travailleurs', 0, '-', 'RQ', '0', NULL, NULL, 3, 'RQ', '3D', NULL, 0, 0, 0, 1),
(128, '89', '0', NULL, 'Impôts sur le résultat', 0, '-', 'RS', '0', NULL, NULL, 3, 'RS', '37', NULL, 0, 0, 0, 1),
(129, '', '0', NULL, 'RESULTAT NET (XG+XH+RQ+RS)', 0, NULL, 'XI', '0', NULL, NULL, 3, 'XI', NULL, NULL, 2, 0, 0, 1);

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
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`compte_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=902 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cptsouscomptes`
--

INSERT INTO `cptsouscomptes` (`id`, `libelle`, `numero`, `compte_id`, `psedo`, `modif`, `site_id`, `suffixe`) VALUES
(4, 'Capital souscrit, non appelé', '1011', 11, 0, 0, NULL, NULL),
(5, 'Capital souscrit, appelé, non versé', '1012', 11, 0, 0, NULL, NULL),
(6, 'Capital souscrit, appelé, versé, non amorti', '1013', 11, 0, 0, NULL, NULL),
(7, 'Capital souscrit, appelé, versé, amorti', '1014', 11, 0, 0, NULL, NULL),
(8, 'Capital souscrit soumis à des conditions particulières', '1018', 11, 0, 0, NULL, NULL),
(9, 'Dotation initiale', '1021', 12, 0, 0, NULL, NULL),
(10, 'Dotations complémentaires', '1022', 12, 0, 0, NULL, NULL),
(11, 'Autres dotations', '1028', 12, 0, 0, NULL, NULL),
(12, 'Apports temporaires', '1041', 14, 0, 0, NULL, NULL),
(13, 'Opérations courantes', '1042', 14, 0, 0, NULL, NULL),
(14, 'Rémunérations, impôts et autres charges personnelles', '1043', 14, 0, 0, NULL, NULL),
(15, 'Prélèvements d’autoconsommation', '1047', 14, 0, 0, NULL, NULL),
(16, 'Autres prélèvements', '1048', 14, 0, 0, NULL, NULL),
(17, 'Primes d\'émission', '1051', 15, 0, 0, NULL, NULL),
(18, 'Primes d\'apport', '1052', 15, 0, 0, NULL, NULL),
(19, 'Primes de fusion', '1053', 15, 0, 0, NULL, NULL),
(20, 'Primes de conversion', '1054', 15, 0, 0, NULL, NULL),
(21, 'Autres primes', '1058', 15, 0, 0, NULL, NULL),
(22, 'Ecarts de réévaluation légale', '1061', 16, 0, 0, NULL, NULL),
(23, 'Ecarts de réévaluation libre', '1062', 16, 0, 0, NULL, NULL),
(24, 'Réserves de plus-values nettes à long terme', '1131', 20, 0, 0, NULL, NULL),
(25, 'Réserves d’attribution gratuite d’actions au personnel salarié et aux dirigeants', '1132', 20, 0, 0, NULL, NULL),
(26, 'Réserves consécutives à l\'octroi de subventions d\'investissement', '1133', 20, 0, 0, NULL, NULL),
(27, 'Réserves des valeurs mobilières donnant accès au capital', '1134', 20, 0, 0, NULL, NULL),
(28, 'Autres réserves réglementées', '1138', 20, 0, 0, NULL, NULL),
(29, 'Réserves facultatives', '1181', 21, 0, 0, NULL, NULL),
(30, 'Réserves diverses', '1188', 21, 0, 0, NULL, NULL),
(31, 'Perte nette à reporter', '1291', 23, 0, 0, NULL, NULL),
(32, 'Perte - Amortissements réputés différés', '1292', 23, 0, 0, NULL, NULL),
(33, 'Résultat en instance d\'affectation : Bénéfice', '1301', 24, 0, 0, NULL, NULL),
(34, 'Résultat en instance d\'affectation : Perte', '1309', 24, 0, 0, NULL, NULL),
(35, 'Résultat de fusion', '1381', 32, 0, 0, NULL, NULL),
(36, 'Résultat d\'apport partiel d\'actif', '1382', 32, 0, 0, NULL, NULL),
(37, 'Résultat de scission', '1383', 32, 0, 0, NULL, NULL),
(38, 'Résultat de liquidation', '1384', 32, 0, 0, NULL, NULL),
(39, 'Etat', '1411', 34, 0, 0, NULL, NULL),
(40, 'Régions', '1412', 34, 0, 0, NULL, NULL),
(41, 'Départements', '1413', 34, 0, 0, NULL, NULL),
(42, 'Communes et collectivités publiques décentralisées', '1414', 34, 0, 0, NULL, NULL),
(43, 'Entités publiques ou mixtes', '1415', 34, 0, 0, NULL, NULL),
(44, 'Entités et organismes privés', '1416', 34, 0, 0, NULL, NULL),
(45, 'Organismes internationaux', '1417', 34, 0, 0, NULL, NULL),
(46, 'Autres', '1418', 34, 0, 0, NULL, NULL),
(47, 'Fonds National', '1531', 38, 0, 0, NULL, NULL),
(48, 'Prélèvement pour le Budget', '1532', 38, 0, 0, NULL, NULL),
(49, 'Reconstitution des gisements miniers et pétroliers', '1551', 40, 0, 0, NULL, NULL),
(50, 'Hausse de prix', '1561', 41, 0, 0, NULL, NULL),
(51, 'Fluctuation des cours', '1562', 41, 0, 0, NULL, NULL),
(52, 'Emprunts obligataires ordinaires', '1611', 44, 0, 0, NULL, NULL),
(53, 'Emprunts obligataires convertibles en actions', '1612', 44, 0, 0, NULL, NULL),
(54, 'Emprunts obligataires remboursables en actions', '1613', 44, 0, 0, NULL, NULL),
(55, 'Autres emprunts obligataires', '1618', 44, 0, 0, NULL, NULL),
(56, 'Dépôts', '1651', 48, 0, 0, NULL, NULL),
(57, 'Cautionnements', '1652', 48, 0, 0, NULL, NULL),
(58, 'sur emprunts obligataires', '1661', 49, 0, 0, NULL, NULL),
(59, 'sur emprunts et dettes auprès des établissements de crédit', '1662', 49, 0, 0, NULL, NULL),
(60, 'sur avances reçues de l\'Etat', '1663', 49, 0, 0, NULL, NULL),
(61, 'sur avances reçues et comptes courants bloqués', '1664', 49, 0, 0, NULL, NULL),
(62, 'sur dépôts et cautionnements reçus', '1665', 49, 0, 0, NULL, NULL),
(63, 'sur avances assorties de conditions particulières', '1667', 49, 0, 0, NULL, NULL),
(64, 'sur autres emprunts et dettes', '1668', 49, 0, 0, NULL, NULL),
(65, 'Avances bloquées pour augmentation du capital', '1671', 50, 0, 0, NULL, NULL),
(66, 'Avances conditionnées par l\'Etat', '1672', 50, 0, 0, NULL, NULL),
(67, 'Avances conditionnées par les autres organismes africains', '1673', 50, 0, 0, NULL, NULL),
(68, 'Avances conditionnées par les organismes internationaux', '1674', 50, 0, 0, NULL, NULL),
(69, 'Rentes viagères capitalisées', '1681', 51, 0, 0, NULL, NULL),
(70, 'Billets de fonds', '1682', 51, 0, 0, NULL, NULL),
(71, 'Dettes consécutives à des titres empruntés', '1683', 51, 0, 0, NULL, NULL),
(72, 'Emprunts participatifs', '1684', 51, 0, 0, NULL, NULL),
(73, 'Participation des travailleurs aux bénéfices', '1685', 51, 0, 0, NULL, NULL),
(74, 'Emprunts et dettes contractés auprès des autres tiers', '1686', 51, 0, 0, NULL, NULL),
(75, 'sur dettes de location-acquisition / crédit-bail immobilier', '1762', 55, 0, 0, NULL, NULL),
(76, 'sur dettes  de  location-acquisition  / crédit-bail mobilier', '1763', 55, 0, 0, NULL, NULL),
(77, 'sur dettes  de location-acquisition / location-vente', '1764', 55, 0, 0, NULL, NULL),
(78, 'sur autres dettes  de location-acquisition', '1768', 55, 0, 0, NULL, NULL),
(79, 'Dettes liées à des participations (groupe)', '1811', 63, 0, 0, NULL, NULL),
(80, 'Dettes liées à des participations (hors groupe)', '1812', 63, 0, 0, NULL, NULL),
(81, 'Provisions pour pensions et obligations similaires –engagement de retraite', '1961', 76, 0, 0, NULL, NULL),
(82, 'Actif du régime de retraite', '1962', 76, 0, 0, NULL, NULL),
(83, 'Provisions pour amendes et pénalités', '1981', 78, 0, 0, NULL, NULL),
(84, 'Provisions de propre assureur', '1983', 78, 0, 0, NULL, NULL),
(85, 'Provisions pour démantèlement et remise en état', '1984', 78, 0, 0, NULL, NULL),
(86, 'Provisions pour droits à réduction ou avantage en nature  (Chèques cadeaux, cartes de fidélité…)', '1985', 78, 0, 0, NULL, NULL),
(87, 'Provisions pour divers risques et charges ', '1988', 78, 0, 0, NULL, NULL),
(88, 'Brevets', '2121', 80, 0, 0, NULL, NULL),
(89, 'Licences', '2122', 80, 0, 0, NULL, NULL),
(90, 'Concessions de service public', '2123', 80, 0, 0, NULL, NULL),
(91, 'Autres concessions et droits similaires', '2128', 80, 0, 0, NULL, NULL),
(92, 'Logiciels', '2131', 81, 0, 0, NULL, NULL),
(93, 'Sites internet', '2132', 81, 0, 0, NULL, NULL),
(94, 'Frais de prospection et d’évaluation de ressources minérales', '2181', 86, 0, 0, NULL, NULL),
(95, 'Coûts d’obtention du contrat', '2182', 86, 0, 0, NULL, NULL),
(96, 'Fichiers clients, notices, titres de journaux et magazines', '2183', 86, 0, 0, NULL, NULL),
(97, 'Coûts des franchises', '2184', 86, 0, 0, NULL, NULL),
(98, 'Divers droits et valeurs incorporels', '2188', 86, 0, 0, NULL, NULL),
(99, 'Frais de développement ', '2191', 87, 0, 0, NULL, NULL),
(100, 'Logiciels et sites internet ', '2193', 87, 0, 0, NULL, NULL),
(101, 'Autres droits et valeurs incorporels', '2198', 87, 0, 0, NULL, NULL),
(102, 'Terrains d\'exploitation agricole', '2211', 88, 0, 0, NULL, NULL),
(103, 'Terrains d\'exploitation forestière', '2212', 88, 0, 0, NULL, NULL),
(104, 'Autres terrains', '2218', 88, 0, 0, NULL, NULL),
(105, 'Terrains à bâtir', '2221', 89, 0, 0, NULL, NULL),
(106, 'Autres terrains nus', '2228', 89, 0, 0, NULL, NULL),
(107, 'pour bâtiments industriels et agricoles', '2231', 90, 0, 0, NULL, NULL),
(108, 'pour bâtiments administratifs et commerciaux', '2232', 90, 0, 0, NULL, NULL),
(109, 'pour bâtiments affectés aux autres opérations professionnelles', '2234', 90, 0, 0, NULL, NULL),
(110, 'pour bâtiments affectés aux autres opérations non professionnelles', '2235', 90, 0, 0, NULL, NULL),
(111, 'Autres terrains bâtis', '2238', 90, 0, 0, NULL, NULL),
(112, 'Plantation d\'arbres et d\'arbustes', '2241', 91, 0, 0, NULL, NULL),
(113, 'Améliorations du fonds', '2245', 91, 0, 0, NULL, NULL),
(114, 'Autres travaux', '2248', 91, 0, 0, NULL, NULL),
(115, 'Carrières', '2251', 92, 0, 0, NULL, NULL),
(116, 'Parkings', '2261', 93, 0, 0, NULL, NULL),
(117, 'Terrains  - immeubles de placement ', '2281', 95, 0, 0, NULL, NULL),
(118, 'Terrains des logements affectés au personnel', '2285', 95, 0, 0, NULL, NULL),
(119, 'Terrains de location - acquisition', '2286', 95, 0, 0, NULL, NULL),
(120, 'Divers terrains', '2288', 95, 0, 0, NULL, NULL),
(121, 'Terrains agricoles et forestiers', '2291', 96, 0, 0, NULL, NULL),
(122, 'Terrains nus', '2292', 96, 0, 0, NULL, NULL),
(123, 'Terrains de  carrières - tréfonds ', '2295', 96, 0, 0, NULL, NULL),
(124, 'Autres terrains', '2298', 96, 0, 0, NULL, NULL),
(125, 'Bâtiments industriels', '2311', 97, 0, 0, NULL, NULL),
(126, 'Bâtiments agricoles', '2312', 97, 0, 0, NULL, NULL),
(127, 'Bâtiments administratifs et commerciaux', '2313', 97, 0, 0, NULL, NULL),
(128, 'Bâtiments affectés au logement du personnel', '2314', 97, 0, 0, NULL, NULL),
(129, 'Bâtiments - immeubles de placement ', '2315', 97, 0, 0, NULL, NULL),
(130, 'Bâtiments de location - acquisition', '2316', 97, 0, 0, NULL, NULL),
(131, 'Bâtiments industriels', '2321', 98, 0, 0, NULL, NULL),
(132, 'Bâtiments agricoles', '2322', 98, 0, 0, NULL, NULL),
(133, 'Bâtiments administratifs et commerciaux', '2323', 98, 0, 0, NULL, NULL),
(134, 'Bâtiments affectés au logement du personnel', '2324', 98, 0, 0, NULL, NULL),
(135, 'Bâtiments - immeubles de placement ', '2325', 98, 0, 0, NULL, NULL),
(136, 'Bâtiments de location - acquisition', '2326', 98, 0, 0, NULL, NULL),
(137, 'Voies de terre', '2331', 99, 0, 0, NULL, NULL),
(138, 'Voies de fer', '2332', 99, 0, 0, NULL, NULL),
(139, 'Voies d’eau', '2333', 99, 0, 0, NULL, NULL),
(140, 'Barrages, Digues', '2334', 99, 0, 0, NULL, NULL),
(141, 'Pistes d’aérodrome', '2335', 99, 0, 0, NULL, NULL),
(142, 'Autres ouvrages d’infrastructures', '2338', 99, 0, 0, NULL, NULL),
(143, 'Installations complexes spécialisées sur sol propre', '2341', 100, 0, 0, NULL, NULL),
(144, 'Installations complexes spécialisées sur sol d’autrui', '2342', 100, 0, 0, NULL, NULL),
(145, 'Installations à caractère spécifique sur sol propre', '2343', 100, 0, 0, NULL, NULL),
(146, 'Installations à caractère spécifique sur sol d’autrui', '2344', 100, 0, 0, NULL, NULL),
(147, 'Aménagements et agencements des bâtiments', '2345', 100, 0, 0, NULL, NULL),
(148, 'Installations générales', '2351', 101, 0, 0, NULL, NULL),
(149, 'Autres aménagements de bureaux', '2358', 101, 0, 0, NULL, NULL),
(153, 'Bâtiments en cours', '2391', 104, 0, 0, NULL, NULL),
(154, 'Installations en cours', '2392', 104, 0, 0, NULL, NULL),
(155, 'Ouvrages d’infrastructure en cours', '2393', 104, 0, 0, NULL, NULL),
(156, 'Aménagements, agencements et installations techniques  en cours', '2394', 104, 0, 0, NULL, NULL),
(157, 'Aménagements de bureaux en cours', '2395', 104, 0, 0, NULL, NULL),
(158, 'Autres installations et agencements en cours', '2398', 104, 0, 0, NULL, NULL),
(159, 'Matériel industriel', '2411', 105, 0, 0, NULL, NULL),
(160, 'Outillage industriel', '2412', 105, 0, 0, NULL, NULL),
(161, 'Matériel commercial', '2413', 105, 0, 0, NULL, NULL),
(162, 'Outillage commercial', '2414', 105, 0, 0, NULL, NULL),
(163, 'Matériel et outillage industriel et commercial de location – acquisition', '2416', 105, 0, 0, NULL, NULL),
(164, 'Matériel agricole', '2421', 106, 0, 0, NULL, NULL),
(165, 'Outillage agricole', '2422', 106, 0, 0, NULL, NULL),
(166, 'Matériel et outillage agricole de location – acquisition', '2426', 106, 0, 0, NULL, NULL),
(167, 'Matériel de bureau', '2441', 108, 0, 0, NULL, NULL),
(168, 'Matériel informatique', '2442', 108, 0, 0, NULL, NULL),
(169, 'Matériel bureautique', '2443', 108, 0, 0, NULL, NULL),
(170, 'Mobilier de bureau', '2444', 108, 0, 0, NULL, NULL),
(171, 'Matériel et mobilier - immeubles de placement', '2445', 108, 0, 0, NULL, NULL),
(172, 'Matériel et mobilier de location - acquisition', '2446', 108, 0, 0, NULL, NULL),
(173, 'Matériel et mobilier des logements du personnel', '2447', 108, 0, 0, NULL, NULL),
(174, 'Matériel automobile', '2451', 109, 0, 0, NULL, NULL),
(175, 'Matériel ferroviaire', '2452', 109, 0, 0, NULL, NULL),
(176, 'Matériel fluvial, lagunaire', '2453', 109, 0, 0, NULL, NULL),
(177, 'Matériel naval', '2454', 109, 0, 0, NULL, NULL),
(178, 'Matériel aérien', '2455', 109, 0, 0, NULL, NULL),
(179, 'Matériel de transport de location - acquisition', '2456', 109, 0, 0, NULL, NULL),
(180, 'Matériel hippomobile', '2457', 109, 0, 0, NULL, NULL),
(181, 'Autres matériels de transport', '2458', 109, 0, 0, NULL, NULL),
(182, 'Cheptel, animaux de trait', '2461', 110, 0, 0, NULL, NULL),
(183, 'Cheptel, animaux reproducteurs', '2462', 110, 0, 0, NULL, NULL),
(184, 'Animaux de garde', '2463', 110, 0, 0, NULL, NULL),
(185, 'Plantations agricoles', '2465', 110, 0, 0, NULL, NULL),
(186, 'Autres actifs biologiques', '2468', 110, 0, 0, NULL, NULL),
(187, 'Agencements et aménagements du matériel', '2471', 111, 0, 0, NULL, NULL),
(188, 'Agencements et aménagements des actifs biologiques', '2472', 111, 0, 0, NULL, NULL),
(189, 'Autres agencements, aménagements du matériel et actifs biologiques', '2478', 111, 0, 0, NULL, NULL),
(190, 'Collections et œuvres d’art', '2481', 112, 0, 0, NULL, NULL),
(191, 'Divers matériels et mobiliers', '2488', 112, 0, 0, NULL, NULL),
(192, 'Matériel et outillage industriel et commercial', '2491', 113, 0, 0, NULL, NULL),
(193, 'Matériel et outillage agricole', '2492', 113, 0, 0, NULL, NULL),
(194, 'Matériel d’emballage récupérable et identifiable', '2493', 113, 0, 0, NULL, NULL),
(195, 'Matériel et mobilier de bureau', '2494', 113, 0, 0, NULL, NULL),
(196, 'Matériel de transport', '2495', 113, 0, 0, NULL, NULL),
(197, 'Actifs biologiques ', '2496', 113, 0, 0, NULL, NULL),
(198, 'Agencements et aménagements du matériel et des actifs biologiques', '2496', 113, 0, 0, NULL, NULL),
(199, 'Autres matériels et actifs biologiques ', '2498', 113, 0, 0, NULL, NULL),
(200, 'Prêts participatifs', '2711', 122, 0, 0, NULL, NULL),
(201, 'Prêts aux associés', '2712', 122, 0, 0, NULL, NULL),
(202, 'Billets de fonds', '2713', 122, 0, 0, NULL, NULL),
(203, 'Créances de location-financement', '2714', 122, 0, 0, NULL, NULL),
(204, 'Titres prêtés', '2715', 122, 0, 0, NULL, NULL),
(205, 'Autres prêts et créances', '2718', 122, 0, 0, NULL, NULL),
(206, 'Prêts immobiliers', '2721', 123, 0, 0, NULL, NULL),
(207, 'Prêts mobiliers et d’installation', '2722', 123, 0, 0, NULL, NULL),
(208, 'Autres prêts au personnel', '2728', 123, 0, 0, NULL, NULL),
(209, 'Retenues de garantie', '2731', 124, 0, 0, NULL, NULL),
(210, 'Fonds réglementé', '2733', 124, 0, 0, NULL, NULL),
(211, 'Créances sur le concédant', '2734', 124, 0, 0, NULL, NULL),
(212, 'Autres créances sur l’Etat', '2738', 124, 0, 0, NULL, NULL),
(213, 'Titres immobilisés de l’activité de portefeuille (T.I.A.P.)', '2741', 125, 0, 0, NULL, NULL),
(214, 'Titres participatifs', '2742', 125, 0, 0, NULL, NULL),
(215, 'Certificats d’investissement', '2743', 125, 0, 0, NULL, NULL),
(216, 'Parts de fonds commun de placement (F.C.P.)', '2744', 125, 0, 0, NULL, NULL),
(217, 'Obligations', '2745', 125, 0, 0, NULL, NULL),
(218, 'Actions ou parts propres', '2746', 125, 0, 0, NULL, NULL),
(219, 'Autres titres immobilisés', '2748', 125, 0, 0, NULL, NULL),
(220, 'Dépôts pour loyers d’avance', '2751', 126, 0, 0, NULL, NULL),
(221, 'Dépôts pour l’électricité', '2752', 126, 0, 0, NULL, NULL),
(222, 'Dépôts pour l’eau', '2753', 126, 0, 0, NULL, NULL),
(223, 'Dépôts pour le gaz', '2754', 126, 0, 0, NULL, NULL),
(224, 'Dépôts pour le téléphone, le télex, la télécopie', '2755', 126, 0, 0, NULL, NULL),
(225, 'Cautionnements sur marchés publics', '2756', 126, 0, 0, NULL, NULL),
(226, 'Cautionnements sur autres opérations', '2757', 126, 0, 0, NULL, NULL),
(227, 'Autres dépôts et cautionnements', '2758', 126, 0, 0, NULL, NULL),
(228, 'Prêts et créances non commerciales', '2761', 127, 0, 0, NULL, NULL),
(229, 'Prêts au personnel', '2762', 127, 0, 0, NULL, NULL),
(230, 'Créances sur l\'Etat', '2763', 127, 0, 0, NULL, NULL),
(231, 'Titres immobilisés', '2764', 127, 0, 0, NULL, NULL),
(232, 'Dépôts et cautionnements versés', '2765', 127, 0, 0, NULL, NULL),
(233, 'Créances de location-financement', '2766', 127, 0, 0, NULL, NULL),
(234, 'Créances rattachées à des participations', '2767', 127, 0, 0, NULL, NULL),
(235, 'Immobilisations financières diverses', '2768', 127, 0, 0, NULL, NULL),
(236, 'Créances rattachées à des participations (groupe)', '2771', 128, 0, 0, NULL, NULL),
(237, 'Créances rattachées à des participations (hors groupe)', '2772', 128, 0, 0, NULL, NULL),
(238, 'Créances rattachées à des sociétés en participation', '2773', 128, 0, 0, NULL, NULL),
(239, 'Avances à des Groupements d\'intérêt économique (G.I.E.)', '2774', 128, 0, 0, NULL, NULL),
(240, 'Créances diverses groupe', '2781', 129, 0, 0, NULL, NULL),
(241, 'Créances diverses hors groupe', '2782', 129, 0, 0, NULL, NULL),
(242, 'Banques dépôts à terme', '2784', 129, 0, 0, NULL, NULL),
(243, 'Or et métaux précieux (1)', '2785', 129, 0, 0, NULL, NULL),
(244, 'Autres immobilisations financières', '2788', 129, 0, 0, NULL, NULL),
(245, 'Amortissements des frais de développement', '2811', 130, 0, 0, NULL, NULL),
(246, 'Amortissements des frais de développement', '2811', 130, 0, 0, NULL, NULL),
(247, 'Amortissements des brevets, licences, concessions et droits similaires', '2812', 130, 0, 0, NULL, NULL),
(248, 'Amortissements des brevets, licences, concessions et droits similaires', '2812', 130, 0, 0, NULL, NULL),
(249, 'Amortissements des logiciels et sites internet', '2813', 130, 0, 0, NULL, NULL),
(250, 'Amortissements des logiciels et sites internet', '2813', 130, 0, 0, NULL, NULL),
(251, 'Amortissements des marques', '2814', 130, 0, 0, NULL, NULL),
(252, 'Amortissements des marques', '2814', 130, 0, 0, NULL, NULL),
(253, 'Amortissements du fonds commercial', '2815', 130, 0, 0, NULL, NULL),
(254, 'Amortissements du fonds commercial', '2815', 130, 0, 0, NULL, NULL),
(255, 'Amortissements du droit au bail', '2816', 130, 0, 0, NULL, NULL),
(256, 'Amortissements du droit au bail', '2816', 130, 0, 0, NULL, NULL),
(257, 'Amortissements des investissements de création', '2817', 130, 0, 0, NULL, NULL),
(258, 'Amortissements des investissements de création', '2817', 130, 0, 0, NULL, NULL),
(259, 'Amortissements des autres droits et valeurs incorporels', '2818', 130, 0, 0, NULL, NULL),
(260, 'Amortissements des autres droits et valeurs incorporels', '2818', 130, 0, 0, NULL, NULL),
(261, 'Amortissements des travaux de mise en valeur des terrains', '2824', 131, 0, 0, NULL, NULL),
(262, 'Amortissements des bâtiments industriels, agricoles, administratifs et commerciaux sur sol propre', '2831', 132, 0, 0, NULL, NULL),
(263, 'Amortissements des bâtiments industriels, agricoles, administratifs et commerciaux sur sol d\'autrui', '2832', 132, 0, 0, NULL, NULL),
(264, 'Amortissements des ouvrages d\'infrastructure', '2833', 132, 0, 0, NULL, NULL),
(265, 'Amortissements des aménagements, agencements et installations techniques', '2834', 132, 0, 0, NULL, NULL),
(266, 'Amortissements des aménagements de bureaux', '2835', 132, 0, 0, NULL, NULL),
(267, 'Amortissements des bâtiments industriels, agricoles et commerciaux mis en concession', '2837', 132, 0, 0, NULL, NULL),
(268, 'Amortissements des autres installations et agencements', '2838', 132, 0, 0, NULL, NULL),
(269, 'Amortissements du matériel et outillage industriel et commercial', '2841', 133, 0, 0, NULL, NULL),
(270, 'Amortissements du matériel et outillage agricole', '2842', 133, 0, 0, NULL, NULL),
(271, 'Amortissements du matériel d\'emballage récupérable et identifiable', '2843', 133, 0, 0, NULL, NULL),
(272, 'Amortissements du matériel et mobilier ', '2844', 133, 0, 0, NULL, NULL),
(273, 'Amortissements du matériel de transport', '2845', 133, 0, 0, NULL, NULL),
(274, 'Amortissements des actifs biologiques ', '2846', 133, 0, 0, NULL, NULL),
(275, 'Amortissements des agencements, aménagements du matériel et des actifs biologiques', '2847', 133, 0, 0, NULL, NULL),
(276, 'Amortissements des autres matériels', '2848', 133, 0, 0, NULL, NULL),
(277, 'Dépréciations des frais de développement', '2911', 134, 0, 0, NULL, NULL),
(278, 'Dépréciations des brevets, licences, concessions  et droits similaires', '2912', 134, 0, 0, NULL, NULL),
(279, 'Dépréciations des logiciels et sites internet', '2913', 134, 0, 0, NULL, NULL),
(280, 'Dépréciations des marques', '2914', 134, 0, 0, NULL, NULL),
(281, 'Dépréciations du fonds commercial', '2915', 134, 0, 0, NULL, NULL),
(282, 'Dépréciations du droit au bail', '2916', 134, 0, 0, NULL, NULL),
(283, 'Dépréciations des investissements de création', '2917', 134, 0, 0, NULL, NULL),
(284, 'Dépréciations des autres droits et valeurs incorporels', '2918', 134, 0, 0, NULL, NULL),
(285, 'Dépréciations des immobilisations incorporelles en cours', '2919', 134, 0, 0, NULL, NULL),
(286, 'Dépréciations des terrains agricoles et forestiers', '2921', 135, 0, 0, NULL, NULL),
(287, 'Dépréciations des terrains nus', '2922', 135, 0, 0, NULL, NULL),
(288, 'Dépréciations des terrains bâtis', '2923', 135, 0, 0, NULL, NULL),
(289, 'Dépréciations des travaux de mise en valeur des terrains', '2924', 135, 0, 0, NULL, NULL),
(290, 'Dépréciations des terrains de gisement', '2925', 135, 0, 0, NULL, NULL),
(291, 'Dépréciations des terrains aménagés', '2926', 135, 0, 0, NULL, NULL),
(292, 'Dépréciations des terrains mis en concession', '2927', 135, 0, 0, NULL, NULL),
(293, 'Dépréciations des autres terrains', '2928', 135, 0, 0, NULL, NULL),
(294, 'Dépréciations des aménagements de terrains en cours', '2929', 135, 0, 0, NULL, NULL),
(295, 'Dépréciations des bâtiments industriels, agricoles, administratifs et commerciaux sur sol propre', '2931', 136, 0, 0, NULL, NULL),
(296, 'Dépréciations des bâtiments industriels, agricoles, administratifs et commerciaux sur sol d\'autrui', '2932', 136, 0, 0, NULL, NULL),
(297, 'Dépréciations des ouvrages d\'infrastructures', '2933', 136, 0, 0, NULL, NULL),
(298, 'Dépréciations des aménagements, agencements et installations techniques', '2934', 136, 0, 0, NULL, NULL),
(299, 'Dépréciations des aménagements de bureaux', '2935', 136, 0, 0, NULL, NULL),
(300, 'Dépréciations des bâtiments industriels, agricoles et commerciaux mis en concession', '2937', 136, 0, 0, NULL, NULL),
(301, 'Dépréciations des autres installations et agencements', '2938', 136, 0, 0, NULL, NULL),
(302, 'Dépréciations des bâtiments et installations en cours', '2939', 136, 0, 0, NULL, NULL),
(303, 'Dépréciations du matériel et outillage industriel et commercial', '2941', 137, 0, 0, NULL, NULL),
(304, 'Dépréciations du matériel et outillage agricole', '2942', 137, 0, 0, NULL, NULL),
(305, 'Dépréciations du matériel d\'emballage récupérable et identifiable', '2943', 137, 0, 0, NULL, NULL),
(306, 'Dépréciations du matériel et mobilier ', '2944', 137, 0, 0, NULL, NULL),
(307, 'Dépréciations du matériel de transport', '2945', 137, 0, 0, NULL, NULL),
(308, 'Dépréciations des actifs biologiques ', '2946', 137, 0, 0, NULL, NULL),
(309, 'Dépréciations des agencements, aménagements du matériel et des actifs biologiques', '2947', 137, 0, 0, NULL, NULL),
(310, 'Dépréciations des autres matériels', '2948', 137, 0, 0, NULL, NULL),
(311, 'Dépréciations de matériel en cours', '2949', 137, 0, 0, NULL, NULL),
(312, 'Dépréciations des avances et acomptes versés sur immobilisations incorporelles', '2951', 138, 0, 0, NULL, NULL),
(313, 'Dépréciations des avances et acomptes versés sur immobilisations corporelles', '2952', 138, 0, 0, NULL, NULL),
(314, 'Dépréciations des titres de participation dans des entités sous contrôle exclusif', '2961', 139, 0, 0, NULL, NULL),
(315, 'Dépréciations des titres de participation dans des entités sous contrôle conjoint', '2962', 139, 0, 0, NULL, NULL),
(316, 'Dépréciations des titres de participation dans des entités conférant une influence notable', '2963', 139, 0, 0, NULL, NULL),
(317, 'Dépréciations des participations dans des organismes professionnels', '2965', 139, 0, 0, NULL, NULL),
(318, 'Dépréciations des parts dans des GIE', '2966', 139, 0, 0, NULL, NULL),
(319, 'Dépréciations des autres titres de participation', '2968', 139, 0, 0, NULL, NULL),
(320, 'Dépréciations des prêts et créances ', '2971', 140, 0, 0, NULL, NULL),
(321, 'Dépréciations des prêts au personnel', '2972', 140, 0, 0, NULL, NULL),
(322, 'Dépréciations des créances sur l\'Etat', '2973', 140, 0, 0, NULL, NULL),
(323, 'Dépréciations des titres immobilisés', '2974', 140, 0, 0, NULL, NULL),
(324, 'Dépréciations des dépôts et cautionnements versés', '2975', 140, 0, 0, NULL, NULL),
(325, 'Dépréciations des créances rattachées à des participations et avances à des GIE', '2977', 140, 0, 0, NULL, NULL),
(326, 'Dépréciations des créances financières diverses', '2978', 140, 0, 0, NULL, NULL),
(327, 'Marchandises A1', '3111', 141, 0, 0, NULL, NULL),
(328, 'Marchandises A2', '3112', 141, 0, 0, NULL, NULL),
(329, 'Marchandises B1', '3121', 142, 0, 0, NULL, NULL),
(330, 'Marchandises B2', '3122', 142, 0, 0, NULL, NULL),
(331, 'Animaux', '3131', 143, 0, 0, NULL, NULL),
(332, 'Végétaux', '3132', 143, 0, 0, NULL, NULL),
(333, 'Emballages perdus', '3351', 152, 0, 0, NULL, NULL),
(334, 'Emballages récupérables non identifiables', '3352', 152, 0, 0, NULL, NULL),
(335, 'Emballages à usage mixte', '3353', 152, 0, 0, NULL, NULL),
(336, 'Autres emballages', '3358', 152, 0, 0, NULL, NULL),
(337, 'Produits en cours P1', '3411', 154, 0, 0, NULL, NULL),
(338, 'Produits en cours P2', '3412', 154, 0, 0, NULL, NULL),
(339, 'Travaux en cours T1', '3421', 155, 0, 0, NULL, NULL),
(340, 'Travaux en cours T2', '3422', 155, 0, 0, NULL, NULL),
(341, 'Produits intermédiaires A', '3431', 156, 0, 0, NULL, NULL),
(342, 'Produits intermédiaires B', '3432', 156, 0, 0, NULL, NULL),
(343, 'Produits résiduels A', '3441', 157, 0, 0, NULL, NULL),
(344, 'Produits résiduels B', '3442', 157, 0, 0, NULL, NULL),
(345, 'Animaux', '3451', 158, 0, 0, NULL, NULL),
(346, 'Végétaux', '3452', 158, 0, 0, NULL, NULL),
(347, 'Etudes en cours E1', '3511', 159, 0, 0, NULL, NULL),
(348, 'Etudes en cours E2', '3512', 159, 0, 0, NULL, NULL),
(349, 'Prestations de services S1', '3521', 160, 0, 0, NULL, NULL),
(350, 'Prestations de services S2', '3522', 160, 0, 0, NULL, NULL),
(351, 'Animaux', '3631', 163, 0, 0, NULL, NULL),
(352, 'Végétaux', '3632', 163, 0, 0, NULL, NULL),
(353, 'Autres stocks (activités annexes)', '3638', 163, 0, 0, NULL, NULL),
(354, 'Produits intermédiaires A', '3711', 164, 0, 0, NULL, NULL),
(355, 'Produits intermédiaires B', '3712', 164, 0, 0, NULL, NULL),
(356, 'Déchets', '3721', 165, 0, 0, NULL, NULL),
(357, 'Rebuts', '3722', 165, 0, 0, NULL, NULL),
(358, 'Matières de récupération', '3723', 165, 0, 0, NULL, NULL),
(359, 'Animaux', '3731', 166, 0, 0, NULL, NULL),
(360, 'Végétaux', '3732', 166, 0, 0, NULL, NULL),
(361, 'Autres stocks (activités annexes)', '3738', 166, 0, 0, NULL, NULL),
(362, 'Stock en consignation', '3871', 171, 0, 0, NULL, NULL),
(363, 'Stock en dépôt', '3872', 171, 0, 0, NULL, NULL),
(364, 'Fournisseurs', '4011', 279, 0, 0, NULL, NULL),
(365, 'Fournisseurs Groupe', '4012', 279, 0, 0, NULL, NULL),
(366, 'Fournisseurs sous-traitants', '4013', 279, 0, 0, NULL, NULL),
(367, 'Fournisseurs, réserve de propriété', '4016', 279, 0, 0, NULL, NULL),
(368, 'Fournisseurs, retenues de garantie', '4017', 279, 0, 0, NULL, NULL),
(369, 'Fournisseurs, Effets à payer', '4021', 280, 0, 0, NULL, NULL),
(370, 'Fournisseurs - Groupe, Effets à payer', '4022', 280, 0, 0, NULL, NULL),
(371, 'Fournisseurs sous-traitants, Effets à payer', '4023', 280, 0, 0, NULL, NULL),
(372, 'Fournisseurs dettes en compte, immobilisations incorporelles', '4041', 281, 0, 0, NULL, NULL),
(373, 'Fournisseurs dettes en compte, immobilisations corporelles', '4042', 281, 0, 0, NULL, NULL),
(374, 'Fournisseurs effets à payer, immobilisations incorporelles', '4046', 281, 0, 0, NULL, NULL),
(375, 'Fournisseurs effets à payer, immobilisations corporelles', '4047', 281, 0, 0, NULL, NULL),
(376, 'Fournisseurs ', '4081', 282, 0, 0, NULL, NULL),
(377, 'Fournisseurs - Groupe', '4082', 282, 0, 0, NULL, NULL),
(378, 'Fournisseurs sous-traitants', '4083', 282, 0, 0, NULL, NULL),
(379, 'Fournisseurs, intérêts courus', '4086', 282, 0, 0, NULL, NULL),
(380, 'Fournisseurs avances et acomptes versés', '4091', 283, 0, 0, NULL, NULL),
(381, 'Fournisseurs - Groupe avances et acomptes versés ', '4092', 283, 0, 0, NULL, NULL),
(382, 'Fournisseurs sous-traitants avances et acomptes versés ', '4093', 283, 0, 0, NULL, NULL),
(383, 'Fournisseurs créances pour emballages et matériels à rendre', '4094', 283, 0, 0, NULL, NULL),
(384, 'Fournisseurs, rabais, remises, ristournes et autres avoirs à obtenir', '4098', 283, 0, 0, NULL, NULL),
(385, 'Clients', '4111', 284, 0, 0, NULL, NULL),
(386, 'Clients - Groupe', '4112', 284, 0, 0, NULL, NULL),
(387, 'Clients, Etat et Collectivités publiques', '4114', 284, 0, 0, NULL, NULL),
(388, 'Clients, organismes internationaux', '4115', 284, 0, 0, NULL, NULL),
(389, 'Clients, réserve de propriété', '4116', 284, 0, 0, NULL, NULL),
(390, 'Clients, retenues de garantie', '4117', 284, 0, 0, NULL, NULL),
(391, 'Clients, dégrèvement de Taxes sur la Valeur Ajoutée (T.V.A.)', '4118', 284, 0, 0, NULL, NULL),
(392, 'Clients, Effets à recevoir', '4121', 285, 0, 0, NULL, NULL),
(393, 'Clients - Groupe, Effets à recevoir', '4122', 285, 0, 0, NULL, NULL),
(394, 'Etat et Collectivités publiques, Effets à recevoir', '4124', 285, 0, 0, NULL, NULL),
(395, 'Organismes Internationaux, Effets à recevoir', '4125', 285, 0, 0, NULL, NULL),
(396, 'Clients, chèques impayés', '4131', 286, 0, 0, NULL, NULL),
(397, 'Clients, Effets impayés', '4132', 286, 0, 0, NULL, NULL),
(398, 'Clients, cartes de crédit impayées', '4133', 286, 0, 0, NULL, NULL),
(399, 'Clients, autres valeurs impayées', '4138', 286, 0, 0, NULL, NULL),
(400, 'Créances en compte, immobilisations incorporelles', '4141', 287, 0, 0, NULL, NULL),
(401, 'Créances en compte, immobilisations corporelles', '4142', 287, 0, 0, NULL, NULL),
(402, 'Effets à recevoir, immobilisations incorporelles', '4146', 287, 0, 0, NULL, NULL),
(403, 'Effets à recevoir, immobilisations corporelles', '4147', 287, 0, 0, NULL, NULL),
(404, 'Créances litigieuses', '4161', 289, 0, 0, NULL, NULL),
(405, 'Créances douteuses', '4162', 289, 0, 0, NULL, NULL),
(406, 'Clients, factures à établir', '4181', 290, 0, 0, NULL, NULL),
(407, 'Clients, intérêts courus', '4186', 290, 0, 0, NULL, NULL),
(408, 'Clients, avances et acomptes reçus', '4191', 291, 0, 0, NULL, NULL),
(409, 'Clients - Groupe, avances et acomptes reçus', '4192', 291, 0, 0, NULL, NULL),
(410, 'Clients, dettes pour emballages et matériels consignés', '4194', 291, 0, 0, NULL, NULL),
(411, 'Clients, rabais, remises, ristournes et autres avoirs à accorder', '4198', 291, 0, 0, NULL, NULL),
(412, 'Personnel, avances ', '4211', 292, 0, 0, NULL, NULL),
(413, 'Personnel, acomptes', '4212', 292, 0, 0, NULL, NULL),
(414, 'Frais avancés et fournitures au personnel', '4213', 292, 0, 0, NULL, NULL),
(415, 'Personnel, oppositions', '4231', 294, 0, 0, NULL, NULL),
(416, 'Personnel, saisies-arrêts', '4232', 294, 0, 0, NULL, NULL),
(417, 'Personnel, avis à tiers détenteur', '4233', 294, 0, 0, NULL, NULL),
(418, 'Assistance médicale', '4241', 295, 0, 0, NULL, NULL),
(419, 'Allocations familiales', '4242', 295, 0, 0, NULL, NULL),
(420, 'Organismes sociaux rattachés à l\'entité', '4245', 295, 0, 0, NULL, NULL),
(421, 'Autres oeuvres sociales internes', '4248', 295, 0, 0, NULL, NULL),
(422, 'Délégués du personnel', '4251', 296, 0, 0, NULL, NULL),
(423, 'Syndicats et Comités d\'entreprises, d\'Etablissement', '4252', 296, 0, 0, NULL, NULL),
(424, 'Autres représentants du personnel', '4258', 296, 0, 0, NULL, NULL),
(425, 'Participation aux bénéfices', '4261', 297, 0, 0, NULL, NULL),
(426, 'Participation au capital', '4264', 297, 0, 0, NULL, NULL),
(427, 'Dettes provisionnées pour congés à payer', '4281', 299, 0, 0, NULL, NULL),
(428, 'Autres charges à payer', '4286', 299, 0, 0, NULL, NULL),
(429, 'Produits à recevoir', '4287', 299, 0, 0, NULL, NULL),
(430, 'Prestations familiales', '4311', 181, 0, 0, NULL, NULL),
(431, 'Accidents de travail', '4312', 181, 0, 0, NULL, NULL),
(432, 'Caisse de retraite obligatoire', '4313', 181, 0, 0, NULL, NULL),
(433, 'Caisse de retraite facultative', '4314', 181, 0, 0, NULL, NULL),
(434, 'Autres cotisations sociales', '4318', 181, 0, 0, NULL, NULL),
(435, 'Mutuelle', '4331', 183, 0, 0, NULL, NULL),
(436, 'Assurances Retraite', '4332', 183, 0, 0, NULL, NULL),
(437, 'Assurances et organismes de santé', '4333', 183, 0, 0, NULL, NULL),
(438, 'Charges sociales sur gratifications à payer', '4381', 184, 0, 0, NULL, NULL),
(439, 'Charges sociales sur congés à payer', '4382', 184, 0, 0, NULL, NULL),
(440, 'Autres charges à payer', '4386', 184, 0, 0, NULL, NULL),
(441, 'Produits à recevoir', '4387', 184, 0, 0, NULL, NULL),
(442, 'Impôts et taxes d\'Etat', '4421', 186, 0, 0, NULL, NULL),
(443, 'Impôts et taxes pour les collectivités publiques', '4422', 186, 0, 0, NULL, NULL),
(444, 'Impôts et taxes recouvrables sur des obligataires', '4423', 186, 0, 0, NULL, NULL),
(445, 'Impôts et taxes recouvrables sur des associés', '4424', 186, 0, 0, NULL, NULL),
(446, 'Droits de douane', '4426', 186, 0, 0, NULL, NULL),
(447, 'Autres impôts et taxes', '4428', 186, 0, 0, NULL, NULL),
(448, 'T.V.A. facturée sur ventes', '4431', 187, 0, 0, NULL, NULL),
(449, 'T.V.A. facturée sur prestations de services', '4432', 187, 0, 0, NULL, NULL),
(450, 'T.V.A. facturée sur travaux', '4433', 187, 0, 0, NULL, NULL),
(451, 'T.V.A. facturée sur production livrée à soi-même', '4434', 187, 0, 0, NULL, NULL),
(452, 'T.V.A. sur factures à établir', '4435', 187, 0, 0, NULL, NULL),
(453, 'Etat, T.V.A. due', '4441', 188, 0, 0, NULL, NULL),
(454, 'Etat, dégrèvement T.V.A.', '4445', 188, 0, 0, NULL, NULL),
(455, 'Etat, crédit de T.V.A. à reporter', '4449', 188, 0, 0, NULL, NULL),
(456, 'T.V.A. récupérable sur immobilisations', '4451', 189, 0, 0, NULL, NULL),
(457, 'T.V.A. récupérable sur achats', '4452', 189, 0, 0, NULL, NULL),
(458, 'T.V.A. récupérable sur transport', '4453', 189, 0, 0, NULL, NULL),
(459, 'T.V.A. récupérable sur services extérieurs et autres charges', '4454', 189, 0, 0, NULL, NULL),
(460, 'T.V.A. récupérable sur factures non parvenues', '4455', 189, 0, 0, NULL, NULL),
(461, 'T.V.A. transférée par d\'autres entités', '4456', 189, 0, 0, NULL, NULL),
(462, 'Impôt Général sur le revenu', '4471', 191, 0, 0, NULL, NULL),
(463, 'Impôts sur salaires', '4472', 191, 0, 0, NULL, NULL),
(464, 'Contribution nationale', '4473', 191, 0, 0, NULL, NULL),
(465, 'Contribution nationale de solidarité', '4474', 191, 0, 0, NULL, NULL),
(466, 'Autres impôts et contributions', '4478', 191, 0, 0, NULL, NULL),
(467, 'Charges à payer', '4486', 192, 0, 0, NULL, NULL),
(468, 'Produits à recevoir', '4487', 192, 0, 0, NULL, NULL),
(469, 'Etat, obligations cautionnées', '4491', 193, 0, 0, NULL, NULL),
(470, 'Etat, avances et acomptes versés sur impôts', '4492', 193, 0, 0, NULL, NULL),
(471, 'Etat, fonds de dotation à recevoir', '4493', 193, 0, 0, NULL, NULL),
(472, 'Etat, subventions d\'investissement à recevoir', '4494', 193, 0, 0, NULL, NULL),
(473, 'Etat, subventions d\'exploitation à recevoir', '4495', 193, 0, 0, NULL, NULL),
(474, 'Etat, subventions d\'équilibre à recevoir', '4496', 193, 0, 0, NULL, NULL),
(475, 'Etat, avances sur subventions ', '4497', 193, 0, 0, NULL, NULL),
(476, 'Etat, fonds réglementé provisionné', '4499', 193, 0, 0, NULL, NULL),
(477, 'Organismes internationaux, fonds de dotation à recevoir', '4581', 196, 0, 0, NULL, NULL),
(478, 'Organismes internationaux, subventions à recevoir', '4582', 196, 0, 0, NULL, NULL),
(479, 'Apporteurs, apports en nature', '4611', 197, 0, 0, NULL, NULL),
(480, 'Apporteurs, apports en numéraire', '4612', 197, 0, 0, NULL, NULL),
(481, 'Apporteurs, capital appelé, non versé', '4613', 197, 0, 0, NULL, NULL),
(482, 'Apporteurs, compte d’apport, opérations de restructuration (fusion…)', '4614', 197, 0, 0, NULL, NULL),
(483, 'Apporteurs, versements reçus sur augmentation de capital', '4615', 197, 0, 0, NULL, NULL),
(484, 'Apporteurs, versements anticipés', '4616', 197, 0, 0, NULL, NULL),
(485, 'Apporteurs défaillants', '4617', 197, 0, 0, NULL, NULL),
(486, 'Apporteurs, titres à échanger', '4618', 197, 0, 0, NULL, NULL),
(487, 'Apporteurs, capital à rembourser ', '4619', 197, 0, 0, NULL, NULL),
(488, 'Principal', '4621', 198, 0, 0, NULL, NULL),
(489, 'Intérêts courus', '4626', 198, 0, 0, NULL, NULL),
(490, 'Opérations courantes', '4631', 199, 0, 0, NULL, NULL),
(491, 'Intérêts courus', '4636', 199, 0, 0, NULL, NULL),
(492, 'Débiteurs divers', '4711', 204, 0, 0, NULL, NULL),
(493, 'Créditeurs divers', '4712', 204, 0, 0, NULL, NULL),
(494, 'Obligataires ', '4713', 204, 0, 0, NULL, NULL),
(495, 'Rémunérations d’administrateurs non associés', '4715', 204, 0, 0, NULL, NULL),
(496, 'Compte d’affacturage et de titrisation', '4716', 204, 0, 0, NULL, NULL),
(497, 'Débiteurs divers - retenues de garantie', '4717', 204, 0, 0, NULL, NULL),
(498, 'Apport, compte de fusion et opérations assimilées', '4718', 204, 0, 0, NULL, NULL),
(499, 'Bons de souscription d’actions et d’obligations', '4719', 204, 0, 0, NULL, NULL),
(500, 'Créances sur cessions de titres de placement', '4721', 205, 0, 0, NULL, NULL),
(501, 'Versements restant à effectuer sur titres de placement non libérés', '4726', 205, 0, 0, NULL, NULL),
(502, 'Mandants', '4731', 206, 0, 0, NULL, NULL),
(503, 'Mandataires', '4732', 206, 0, 0, NULL, NULL),
(504, 'Commettants', '4733', 206, 0, 0, NULL, NULL),
(505, 'Commissionnaires', '4734', 206, 0, 0, NULL, NULL),
(506, 'Etat, Collectivités publiques, fonds global d’allocation', '4739', 206, 0, 0, NULL, NULL),
(507, 'Compte de répartition périodique des charges', '4746', 207, 0, 0, NULL, NULL),
(508, 'Compte de répartition périodique des produits', '4747', 207, 0, 0, NULL, NULL),
(509, 'Compte-actif ', '4751', 208, 0, 0, NULL, NULL),
(510, 'Compte-passif ', '4752', 208, 0, 0, NULL, NULL),
(511, 'Diminution des créances d’exploitation et HAO', '4781', 211, 0, 0, NULL, NULL),
(512, 'Diminution des créances financières', '4782', 211, 0, 0, NULL, NULL),
(513, 'Augmentation des dettes d’exploitation et HAO', '4783', 211, 0, 0, NULL, NULL),
(514, 'Augmentation des dettes financières', '4784', 211, 0, 0, NULL, NULL),
(515, 'Différences d’évaluation sur instruments de trésorerie', '4786', 211, 0, 0, NULL, NULL),
(516, 'Différences compensées par couverture de change', '4788', 211, 0, 0, NULL, NULL),
(517, 'Augmentation des créances d’exploitation et HAO', '4791', 212, 0, 0, NULL, NULL),
(518, 'Augmentation des créances financières', '4792', 212, 0, 0, NULL, NULL),
(519, 'Diminution des dettes d’exploitation et HAO', '4793', 212, 0, 0, NULL, NULL),
(520, 'Diminution des dettes financières', '4794', 212, 0, 0, NULL, NULL),
(521, 'Différences d’évaluation sur instruments de trésorerie', '4797', 212, 0, 0, NULL, NULL),
(522, 'Différences compensées par couverture de change', '4798', 212, 0, 0, NULL, NULL),
(523, 'Immobilisations incorporelles', '4811', 213, 0, 0, NULL, NULL),
(524, 'Immobilisations corporelles', '4812', 213, 0, 0, NULL, NULL),
(525, 'Versements restant à effectuer sur titres de participation et titres immobilisés non libérés ', '4813', 213, 0, 0, NULL, NULL),
(526, 'Réserve de propriété (3)', '4816', 213, 0, 0, NULL, NULL),
(527, 'Retenues de garantie  (3)', '4817', 213, 0, 0, NULL, NULL),
(528, 'Factures non parvenues (3)', '4818', 213, 0, 0, NULL, NULL),
(529, 'Immobilisations incorporelles', '4821', 214, 0, 0, NULL, NULL),
(530, 'Immobilisations corporelles', '4822', 214, 0, 0, NULL, NULL),
(531, 'En compte, immobilisations incorporelles', '4851', 216, 0, 0, NULL, NULL),
(532, 'En compte, immobilisations corporelles', '4852', 216, 0, 0, NULL, NULL),
(533, 'Effets à recevoir, immobilisations incorporelles', '4853', 216, 0, 0, NULL, NULL),
(534, 'Effets à recevoir, immobilisations corporelles', '4854', 216, 0, 0, NULL, NULL),
(535, 'Effets escomptés non échus', '4855', 216, 0, 0, NULL, NULL),
(536, 'Immobilisations financières', '4856', 216, 0, 0, NULL, NULL),
(537, 'Retenues de garantie ', '4857', 216, 0, 0, NULL, NULL),
(538, 'Factures à établir', '4858', 216, 0, 0, NULL, NULL),
(539, 'Créances litigieuses', '4911', 219, 0, 0, NULL, NULL),
(540, 'Créances douteuses', '4912', 219, 0, 0, NULL, NULL),
(541, 'Associés, comptes courants', '4962', 224, 0, 0, NULL, NULL),
(542, 'Associés, opérations faites en commun et GIE', '4963', 224, 0, 0, NULL, NULL),
(543, 'Groupe, comptes courants', '4966', 224, 0, 0, NULL, NULL),
(544, 'Créances sur cessions d\'immobilisations ', '4985', 226, 0, 0, NULL, NULL),
(545, 'Créances sur cessions de titres de placement', '4986', 226, 0, 0, NULL, NULL),
(546, 'Autres créances H.A.O.', '4988', 226, 0, 0, NULL, NULL),
(547, 'Sur opérations d\'exploitation', '4991', 227, 0, 0, NULL, NULL),
(548, 'Sur opérations H.A.O.', '4998', 227, 0, 0, NULL, NULL),
(549, 'Titres du Trésor à court terme', '5011', 228, 0, 0, NULL, NULL),
(550, 'Titres d\'organismes financiers', '5012', 228, 0, 0, NULL, NULL),
(551, 'Bons de caisse à court terme', '5013', 228, 0, 0, NULL, NULL),
(552, 'Frais d’acquisition des titres de Trésor et bons de caisse', '5016', 228, 0, 0, NULL, NULL),
(553, 'Actions ou parts propres', '5021', 229, 0, 0, NULL, NULL),
(554, 'Actions cotées', '5022', 229, 0, 0, NULL, NULL),
(555, 'Actions non cotées', '5023', 229, 0, 0, NULL, NULL),
(556, 'Actions démembrées (certificats d\'investissement ; droits de vote)', '5024', 229, 0, 0, NULL, NULL),
(557, 'Autres actions', '5025', 229, 0, 0, NULL, NULL),
(558, 'Frais d’acquisition des actions', '5026', 229, 0, 0, NULL, NULL),
(559, 'Obligations émises par l\'entité et rachetées par elle', '5031', 230, 0, 0, NULL, NULL),
(560, 'Obligations cotées', '5032', 230, 0, 0, NULL, NULL),
(561, 'Obligations non cotées', '5033', 230, 0, 0, NULL, NULL),
(562, 'Autres obligations', '5035', 230, 0, 0, NULL, NULL),
(563, 'Frais d’acquisition des obligations', '5036', 230, 0, 0, NULL, NULL),
(564, 'Bons de souscription d\'actions', '5042', 231, 0, 0, NULL, NULL),
(565, 'Bons de souscription d\'obligations', '5043', 231, 0, 0, NULL, NULL),
(566, 'Titres du Trésor et bons de caisse à court terme', '5061', 233, 0, 0, NULL, NULL),
(567, 'Actions', '5062', 233, 0, 0, NULL, NULL),
(568, 'Obligations', '5063', 233, 0, 0, NULL, NULL),
(569, 'Banques en monnaie nationale', '5211', 241, 0, 0, NULL, NULL),
(570, 'Banques en devises', '5215', 241, 0, 0, NULL, NULL),
(571, 'Banque, intérêts courus charges à payer', '5261', 246, 0, 0, NULL, NULL),
(572, 'Banque, intérêts courus produits à recevoir', '5267', 246, 0, 0, NULL, NULL),
(573, 'Caisse en monnaie nationale', '5711', 266, 0, 0, NULL, NULL),
(574, 'Caisse en devises', '5712', 266, 0, 0, NULL, NULL),
(575, 'en monnaie nationale', '5721', 267, 0, 0, NULL, NULL),
(576, 'en devises', '5722', 267, 0, 0, NULL, NULL),
(577, 'en monnaie nationale', '5731', 268, 0, 0, NULL, NULL),
(578, 'en devises', '5732', 268, 0, 0, NULL, NULL),
(579, 'dans la Région (5)', '6011', 300, 0, 0, NULL, NULL),
(580, 'hors Région (5)', '6012', 300, 0, 0, NULL, NULL),
(581, 'aux entités du groupe dans la Région', '6013', 300, 0, 0, NULL, NULL),
(582, 'aux entités du groupe hors Région', '6014', 300, 0, 0, NULL, NULL),
(583, 'frais sur achats (6)', '6015', 300, 0, 0, NULL, NULL),
(584, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6019', 300, 0, 0, NULL, NULL),
(585, 'dans la Région (5)', '6021', 301, 0, 0, NULL, NULL),
(586, 'hors Région (5)', '6022', 301, 0, 0, NULL, NULL),
(587, 'aux entités du groupe dans la Région', '6023', 301, 0, 0, NULL, NULL),
(588, 'aux entités du groupe hors Région', '6024', 301, 0, 0, NULL, NULL),
(589, 'frais sur achats (6)', '6025', 301, 0, 0, NULL, NULL),
(590, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6029', 301, 0, 0, NULL, NULL),
(591, 'Variations des stocks de marchandises', '6031', 302, 0, 0, NULL, NULL),
(592, 'Variations des stocks de matières premières et fournitures liées', '6032', 302, 0, 0, NULL, NULL),
(593, 'Variations des stocks d\'autres approvisionnements', '6033', 302, 0, 0, NULL, NULL),
(594, 'Matières consommables ', '6041', 303, 0, 0, NULL, NULL),
(595, 'Matières consommables ', '6042', 303, 0, 0, NULL, NULL),
(596, 'Produits d\'entretien', '6043', 303, 0, 0, NULL, NULL),
(597, 'Fournitures d\'atelier et d\'usine', '6044', 303, 0, 0, NULL, NULL),
(598, 'frais sur achats (6)', '6045', 303, 0, 0, NULL, NULL),
(599, 'Fournitures de magasin', '6046', 303, 0, 0, NULL, NULL),
(600, 'Fournitures de bureau', '6047', 303, 0, 0, NULL, NULL),
(601, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6049', 303, 0, 0, NULL, NULL),
(602, 'Fournitures non stockables -Eau', '6051', 304, 0, 0, NULL, NULL),
(603, 'Fournitures non stockables - Electricité', '6052', 304, 0, 0, NULL, NULL),
(604, 'Fournitures non stockables – Autres énergies', '6053', 304, 0, 0, NULL, NULL),
(605, 'Fournitures d\'entretien non stockables', '6054', 304, 0, 0, NULL, NULL),
(606, 'Fournitures de bureau non stockables', '6055', 304, 0, 0, NULL, NULL),
(607, 'Achats de petit matériel et outillage', '6056', 304, 0, 0, NULL, NULL),
(608, 'Achats d\'études et prestations de services', '6057', 304, 0, 0, NULL, NULL),
(609, 'Achats de travaux, matériels et équipements', '6058', 304, 0, 0, NULL, NULL),
(610, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6059', 304, 0, 0, NULL, NULL),
(611, 'Emballages perdus', '6081', 305, 0, 0, NULL, NULL),
(612, 'Emballages récupérables non identifiables', '6082', 305, 0, 0, NULL, NULL),
(613, 'Emballages à usage mixte', '6083', 305, 0, 0, NULL, NULL),
(614, 'frais sur achats (6)', '6085', 305, 0, 0, NULL, NULL),
(615, 'Rabais, Remises et Ristournes obtenus (non ventilés)', '6089', 305, 0, 0, NULL, NULL),
(616, 'Voyages et déplacements', '6181', 310, 0, 0, NULL, NULL),
(617, 'Transports entre établissements ou chantiers', '6182', 310, 0, 0, NULL, NULL),
(618, 'Transports administratifs', '6183', 310, 0, 0, NULL, NULL),
(619, 'Locations de terrains', '6221', 312, 0, 0, NULL, NULL),
(620, 'Locations de bâtiments', '6222', 312, 0, 0, NULL, NULL),
(621, 'ocations de matériels et outillages', '6223', 312, 0, 0, NULL, NULL),
(622, 'Malis sur emballages', '6224', 312, 0, 0, NULL, NULL),
(623, 'Locations d\'emballages ', '6225', 312, 0, 0, NULL, NULL),
(624, 'Fermages et loyers du foncier', '6226', 312, 0, 0, NULL, NULL),
(625, 'Locations et charges locatives diverses', '6228', 312, 0, 0, NULL, NULL),
(626, 'Crédit-bail immobilier', '6232', 313, 0, 0, NULL, NULL),
(627, 'Crédit-bail mobilier', '6233', 313, 0, 0, NULL, NULL),
(628, 'Location-vente', '6234', 313, 0, 0, NULL, NULL),
(629, 'Autres contrats de location-acquisition ', '6238', 313, 0, 0, NULL, NULL),
(630, 'Entretien et réparations des biens immobiliers', '6241', 314, 0, 0, NULL, NULL),
(631, 'Entretien et réparations des biens mobiliers', '6242', 314, 0, 0, NULL, NULL),
(632, 'Maintenance', '6243', 314, 0, 0, NULL, NULL),
(633, 'Charges de démantèlement et remise en état', '6244', 314, 0, 0, NULL, NULL),
(634, 'Autres entretiens et réparations', '6248', 314, 0, 0, NULL, NULL),
(635, 'Assurances multirisques', '6251', 315, 0, 0, NULL, NULL),
(636, 'Assurances matériel de transport', '6252', 315, 0, 0, NULL, NULL),
(637, 'Assurances risques d\'exploitation', '6253', 315, 0, 0, NULL, NULL),
(638, 'Assurances responsabilité du producteur', '6254', 315, 0, 0, NULL, NULL),
(639, 'Assurances insolvabilité clients', '6255', 315, 0, 0, NULL, NULL),
(640, 'Assurances transport sur ventes', '6257', 315, 0, 0, NULL, NULL),
(641, 'Autres primes d\'assurances', '6258', 315, 0, 0, NULL, NULL),
(642, 'Etudes et recherches', '6261', 316, 0, 0, NULL, NULL),
(643, 'Documentation générale', '6265', 316, 0, 0, NULL, NULL),
(644, 'Documentation technique', '6266', 316, 0, 0, NULL, NULL),
(645, 'Annonces, insertions', '6271', 317, 0, 0, NULL, NULL),
(646, 'Catalogues, imprimés publicitaires', '6272', 317, 0, 0, NULL, NULL),
(647, 'Echantillons', '6273', 317, 0, 0, NULL, NULL),
(648, 'Foires et expositions', '6274', 317, 0, 0, NULL, NULL),
(649, 'Publications', '6275', 317, 0, 0, NULL, NULL),
(650, 'Cadeaux à la clientèle', '6276', 317, 0, 0, NULL, NULL),
(651, 'Frais de colloques, séminaires, conférences', '6277', 317, 0, 0, NULL, NULL),
(652, 'Autres charges de publicité et relations publiques', '6278', 317, 0, 0, NULL, NULL),
(653, 'Frais de téléphone', '6281', 318, 0, 0, NULL, NULL),
(654, 'Frais de télex', '6282', 318, 0, 0, NULL, NULL),
(655, 'Frais de télécopie', '6283', 318, 0, 0, NULL, NULL),
(656, 'Autres frais de télécommunications', '6288', 318, 0, 0, NULL, NULL),
(657, 'Frais sur titres (vente, garde)', '6311', 319, 0, 0, NULL, NULL),
(658, 'Frais sur effets', '6312', 319, 0, 0, NULL, NULL),
(659, 'Location de coffres', '6313', 319, 0, 0, NULL, NULL),
(660, 'Commissions d\'affacturage et de titrisation', '6314', 319, 0, 0, NULL, NULL),
(661, 'Commissions sur cartes de crédit', '6315', 319, 0, 0, NULL, NULL),
(662, 'Frais d\'émission d\'emprunts', '6316', 319, 0, 0, NULL, NULL),
(663, 'Frais sur instruments monnaie électronique', '6317', 319, 0, 0, NULL, NULL),
(664, 'Autres frais bancaires', '6318', 319, 0, 0, NULL, NULL),
(665, 'Commissions et courtages sur ventes', '6322', 320, 0, 0, NULL, NULL),
(666, 'Honoraires des professions règlementées', '6324', 320, 0, 0, NULL, NULL),
(667, 'Frais d\'actes et de contentieux', '6325', 320, 0, 0, NULL, NULL),
(668, 'Rémunérations d’affacturage et de titrisation', '6326', 320, 0, 0, NULL, NULL),
(669, 'Rémunérations des autres prestataires de services', '6327', 320, 0, 0, NULL, NULL),
(670, 'Divers frais', 'Divers frais', 320, 0, 0, NULL, NULL),
(671, 'Redevances pour brevets, licences', '6342', 322, 0, 0, NULL, NULL),
(672, 'Redevances pour logiciels', '6343', 322, 0, 0, NULL, NULL),
(673, 'Redevances pour marques', '6344', 322, 0, 0, NULL, NULL),
(674, 'Redevances pour sites  internet', '6345', 322, 0, 0, NULL, NULL),
(675, 'Redevances pour concessions, droits et valeurs similaires', '6346', 322, 0, 0, NULL, NULL),
(676, 'Cotisations', '6351', 323, 0, 0, NULL, NULL),
(677, 'Concours divers', '6358', 323, 0, 0, NULL, NULL),
(678, 'Personnel intérimaire', '6371', 324, 0, 0, NULL, NULL),
(679, 'Personnel détaché ou prêté à l\'entité', '6372', 324, 0, 0, NULL, NULL),
(680, 'Frais de recrutement du personnel', '6381', 325, 0, 0, NULL, NULL),
(681, 'Frais de déménagement', '6382', 325, 0, 0, NULL, NULL),
(682, 'Réceptions', '6383', 325, 0, 0, NULL, NULL),
(683, 'Missions', '6384', 325, 0, 0, NULL, NULL),
(684, 'Charges de copropriété', '6385', 325, 0, 0, NULL, NULL),
(685, 'Charges externes diverses', '6388', 325, 0, 0, NULL, NULL),
(686, 'Impôts fonciers et taxes annexes', '6411', 326, 0, 0, NULL, NULL),
(687, 'Patentes, licences et taxes annexes', '6412', 326, 0, 0, NULL, NULL),
(688, 'Taxes sur appointements et salaires', '6413', 326, 0, 0, NULL, NULL),
(689, 'Taxes d\'apprentissage', '6414', 326, 0, 0, NULL, NULL);
INSERT INTO `cptsouscomptes` (`id`, `libelle`, `numero`, `compte_id`, `psedo`, `modif`, `site_id`, `suffixe`) VALUES
(690, 'Formation professionnelle continue', '6415', 326, 0, 0, NULL, NULL),
(691, 'Autres impôts et taxes directs', '6418', 326, 0, 0, NULL, NULL),
(692, 'Droits de mutation', '6461', 328, 0, 0, NULL, NULL),
(693, 'Droits de timbre', '6462', 328, 0, 0, NULL, NULL),
(694, 'Taxes sur les véhicules de société', '6463', 328, 0, 0, NULL, NULL),
(695, 'Vignettes', '6464', 328, 0, 0, NULL, NULL),
(696, 'Autres droits d\'enregistrement', '6468', 328, 0, 0, NULL, NULL),
(697, 'Pénalités d\'assiette, impôts directs', '6471', 329, 0, 0, NULL, NULL),
(698, 'Pénalités d\'assiette, impôts indirects', '6472', 329, 0, 0, NULL, NULL),
(699, 'Pénalités de recouvrement, impôts directs', '6473', 329, 0, 0, NULL, NULL),
(700, 'Pénalités de recouvrement, impôts indirects', '6474', 329, 0, 0, NULL, NULL),
(701, 'Autres pénalités et amendes fiscales', '6478', 329, 0, 0, NULL, NULL),
(702, 'Clients', '6511', 331, 0, 0, NULL, NULL),
(703, 'Autres débiteurs', '6515', 331, 0, 0, NULL, NULL),
(704, 'Quote-part transférée de bénéfices (comptabilité du gérant)', '6521', 332, 0, 0, NULL, NULL),
(705, 'Pertes imputées par transfert (comptabilité des associés non gérants)', '6525', 332, 0, 0, NULL, NULL),
(706, 'Immobilisations incorporelles', '6541', 333, 0, 0, NULL, NULL),
(707, 'Immobilisations corporelles', '6542', 333, 0, 0, NULL, NULL),
(708, 'Indemnités de fonction et autres rémunérations d\'administrateurs', '6581', 336, 0, 0, NULL, NULL),
(709, 'Dons', '6582', 336, 0, 0, NULL, NULL),
(710, 'Mécénat', '6583', 336, 0, 0, NULL, NULL),
(711, 'Autres charges diverses', '6588', 336, 0, 0, NULL, NULL),
(712, 'sur risques à court terme', '6591', 337, 0, 0, NULL, NULL),
(713, 'sur stocks', '6593', 337, 0, 0, NULL, NULL),
(714, 'sur créances', '6594', 337, 0, 0, NULL, NULL),
(715, 'Autres charges pour  dépréciations et provisions pour risques à court terme ', '6598', 337, 0, 0, NULL, NULL),
(716, 'Appointements salaires et commissions', '6611', 338, 0, 0, NULL, NULL),
(717, 'Primes et gratifications', '6612', 338, 0, 0, NULL, NULL),
(718, 'Congés payés', '6613', 338, 0, 0, NULL, NULL),
(719, 'Indemnités de préavis, de licenciement et de recherche d\'embauche', '6614', 338, 0, 0, NULL, NULL),
(720, 'Indemnités de maladie versées aux travailleurs', '6615', 338, 0, 0, NULL, NULL),
(721, 'Supplément familial', '6616', 338, 0, 0, NULL, NULL),
(722, 'Avantages en nature', '6617', 338, 0, 0, NULL, NULL),
(723, 'Autres rémunérations directes', '6618', 338, 0, 0, NULL, NULL),
(724, 'Appointements salaires et commissions', '6621', 339, 0, 0, NULL, NULL),
(725, 'Primes et gratifications', '6622', 339, 0, 0, NULL, NULL),
(726, 'Congés payés', '6623', 339, 0, 0, NULL, NULL),
(727, 'Indemnités de préavis, de licenciement et de recherche d\'embauche', '6624', 339, 0, 0, NULL, NULL),
(728, 'Indemnités de maladie versées aux travailleurs', '6625', 339, 0, 0, NULL, NULL),
(729, 'Supplément familial', '6626', 339, 0, 0, NULL, NULL),
(730, 'Avantages en nature', '6627', 339, 0, 0, NULL, NULL),
(731, 'Autres rémunérations directes', '6628', 339, 0, 0, NULL, NULL),
(732, 'Indemnités de logement', '6631', 340, 0, 0, NULL, NULL),
(733, 'Indemnités de représentation', '6632', 340, 0, 0, NULL, NULL),
(734, 'Indemnités d\'expatriation', '6633', 340, 0, 0, NULL, NULL),
(735, 'Indemnités de transport', '6634', 340, 0, 0, NULL, NULL),
(736, 'Autres indemnités et avantages divers', '6638', 340, 0, 0, NULL, NULL),
(737, 'Charges sociales sur rémunération du personnel national', '6641', 341, 0, 0, NULL, NULL),
(738, 'Charges sociales sur rémunération du personnel non national', '6642', 341, 0, 0, NULL, NULL),
(739, 'Rémunération du travail de l\'exploitant', '6661', 342, 0, 0, NULL, NULL),
(740, 'Charges sociales', '6662', 342, 0, 0, NULL, NULL),
(741, 'Personnel intérimaire', '6671', 343, 0, 0, NULL, NULL),
(742, 'Personnel détaché ou prêté à l’entité', '6672', 343, 0, 0, NULL, NULL),
(743, 'Versements aux Syndicats et Comités d\'entreprise, d\'établissement', '6681', 344, 0, 0, NULL, NULL),
(744, 'Versements aux Comités d\'hygiène et de sécurité', '6682', 344, 0, 0, NULL, NULL),
(745, 'Versements et contributions aux autres œuvres sociales', '6683', 344, 0, 0, NULL, NULL),
(746, 'Médecine du travail et pharmacie', '6684', 344, 0, 0, NULL, NULL),
(747, 'Assurances et organismes de santé', '6685', 344, 0, 0, NULL, NULL),
(748, 'Assurances retraite et fonds de pensions', '6686', 344, 0, 0, NULL, NULL),
(749, 'Majorations et pénalités sociales', '6687', 344, 0, 0, NULL, NULL),
(750, 'Charges sociales diverses', '6688', 344, 0, 0, NULL, NULL),
(751, 'Emprunts obligataires', '6711', 345, 0, 0, NULL, NULL),
(752, 'Emprunts auprès des établissements de crédit', '6712', 345, 0, 0, NULL, NULL),
(753, 'Dettes liées à des participations', '6713', 345, 0, 0, NULL, NULL),
(754, 'Primes de remboursement des obligations', '6714', 345, 0, 0, NULL, NULL),
(755, 'Intérêts dans loyers de location-acquisition/crédit-bail immobilier', '6722', 346, 0, 0, NULL, NULL),
(756, 'Intérêts dans loyers de location-acquisition/crédit-bail mobilier', '6723', 346, 0, 0, NULL, NULL),
(757, 'Intérêts dans loyers de location-acquisition/location-vente', '6724', 346, 0, 0, NULL, NULL),
(758, 'Intérêts dans loyers des autres locations-acquisition ', '6728', 346, 0, 0, NULL, NULL),
(759, 'Avances reçues et dépôts créditeurs', '6741', 348, 0, 0, NULL, NULL),
(760, 'Comptes courants bloqués', '6742', 348, 0, 0, NULL, NULL),
(761, 'Intérêts sur obligations cautionnées', '6743', 348, 0, 0, NULL, NULL),
(762, 'Intérêts sur dettes commerciales', '6744', 348, 0, 0, NULL, NULL),
(763, 'Intérêts bancaires et sur opérations de financement (escompte…)', '6745', 348, 0, 0, NULL, NULL),
(764, 'Intérêts sur dettes diverses', '6748', 348, 0, 0, NULL, NULL),
(765, 'Pertes sur cessions de titres de placement', '6771', 351, 0, 0, NULL, NULL),
(766, 'Malis provenant d’attribution gratuite d’actions au personnel salarié et aux dirigeants', '6772', 351, 0, 0, NULL, NULL),
(767, 'sur rentes viagères', '6781', 352, 0, 0, NULL, NULL),
(768, 'sur opérations financières', '6782', 352, 0, 0, NULL, NULL),
(769, 'sur instruments de trésorerie', '6784', 352, 0, 0, NULL, NULL),
(770, 'sur risques financiers', '6791', 353, 0, 0, NULL, NULL),
(771, 'sur titres de placement', '6795', 353, 0, 0, NULL, NULL),
(772, 'Autres charges pour dépréciations et provisions pour risques à court terme financières', '6798', 353, 0, 0, NULL, NULL),
(775, 'Dotations aux provisions pour risques et charges', '6911', 356, 0, 0, NULL, NULL),
(776, 'Dotations aux dépréciations des immobilisations incorporelles', '6913', 356, 0, 0, NULL, NULL),
(777, 'Dotations aux dépréciations des immobilisations corporelles', '6914', 356, 0, 0, NULL, NULL),
(778, 'Dotations aux provisions pour risques et charges', '6971', 357, 0, 0, NULL, NULL),
(779, 'Dotations aux dépréciations des immobilisations financières', '6972', 357, 0, 0, NULL, NULL),
(780, 'dans la Région (7)', '7011', 358, 0, 0, NULL, NULL),
(781, 'hors Région (7)', '7012', 358, 0, 0, NULL, NULL),
(782, 'aux entités du groupe dans la Région', '7013', 358, 0, 0, NULL, NULL),
(783, 'aux entités du groupe hors Région', '7014', 358, 0, 0, NULL, NULL),
(784, 'sur internet', '7015', 358, 0, 0, NULL, NULL),
(785, 'Rabais, remises, ristournes accordés (non ventilés)', '7019', 358, 0, 0, NULL, NULL),
(786, 'dans la Région (7)', '7021', 359, 0, 0, NULL, NULL),
(787, 'hors Région (7)', '7022', 359, 0, 0, NULL, NULL),
(788, 'aux entités du groupe dans la Région', '7023', 359, 0, 0, NULL, NULL),
(789, 'aux entités du groupe hors Région', '7024', 359, 0, 0, NULL, NULL),
(790, 'sur internet', '7025', 359, 0, 0, NULL, NULL),
(791, 'Rabais, remises, ristournes accordés (non ventilés)', '7029', 359, 0, 0, NULL, NULL),
(792, 'dans la Région (7)', '7031', 360, 0, 0, NULL, NULL),
(793, 'hors Région (7)', '7032', 360, 0, 0, NULL, NULL),
(794, 'aux entités du groupe dans la Région', '7033', 360, 0, 0, NULL, NULL),
(795, 'aux entités du groupe hors Région', '7034', 360, 0, 0, NULL, NULL),
(796, 'sur internet', '7035', 360, 0, 0, NULL, NULL),
(797, 'Rabais, remises, ristournes accordés (non ventilés)', '7039', 360, 0, 0, NULL, NULL),
(798, 'dans la Région (7)', '7041', 361, 0, 0, NULL, NULL),
(799, 'hors Région (7)', '7042', 361, 0, 0, NULL, NULL),
(800, 'aux entités du groupe dans la Région', '7043', 361, 0, 0, NULL, NULL),
(801, 'aux entités du groupe hors Région', '7044', 361, 0, 0, NULL, NULL),
(802, 'sur internet', '7045', 361, 0, 0, NULL, NULL),
(803, 'Rabais, remises, ristournes accordés (non ventilés)', '7049', 361, 0, 0, NULL, NULL),
(804, 'dans la Région (7)', '7051', 362, 0, 0, NULL, NULL),
(805, 'hors Région (7)', '7052', 362, 0, 0, NULL, NULL),
(806, 'aux entités du groupe dans la Région', '7053', 362, 0, 0, NULL, NULL),
(807, 'aux entités du groupe hors Région', '7054', 362, 0, 0, NULL, NULL),
(808, 'sur internet', '7055', 362, 0, 0, NULL, NULL),
(809, 'Rabais, remises, ristournes accordés (non ventilés)', '7059', 362, 0, 0, NULL, NULL),
(810, 'dans la Région (7)', '7061', 363, 0, 0, NULL, NULL),
(811, 'hors Région (7)', '7062', 363, 0, 0, NULL, NULL),
(812, 'aux entités du groupe dans la Région', '7063', 363, 0, 0, NULL, NULL),
(813, 'aux entités du groupe hors Région', '7064', 363, 0, 0, NULL, NULL),
(814, 'sur internet', '7065', 363, 0, 0, NULL, NULL),
(815, 'Rabais, remises, ristournes accordés (non ventilés)', '7069', 363, 0, 0, NULL, NULL),
(816, 'Ports, emballages perdus et autres frais facturés', '7071', 364, 0, 0, NULL, NULL),
(817, 'Commissions et courtages(8)', '7072', 364, 0, 0, NULL, NULL),
(818, 'Locations et redevances de location - financement (8) ', '7073', 364, 0, 0, NULL, NULL),
(819, 'Bonis sur reprises et cessions d\'emballages', '7074', 364, 0, 0, NULL, NULL),
(820, 'Mise à disposition de personnel (8)', '7075', 364, 0, 0, NULL, NULL),
(821, 'Redevances pour brevets, logiciels, marques et droits similaires (8)', '7076', 364, 0, 0, NULL, NULL),
(822, 'Services exploités dans l\'intérêt du personnel', '7077', 364, 0, 0, NULL, NULL),
(823, 'Autres produits accessoires', '7078', 364, 0, 0, NULL, NULL),
(824, 'Versées par l\'Etat et les collectivités publiques', '7181', 369, 0, 0, NULL, NULL),
(825, 'Versées par les organismes internationaux', '7182', 369, 0, 0, NULL, NULL),
(826, 'Versées par des tiers', '7183', 369, 0, 0, NULL, NULL),
(827, ' immobilisations corporelles (hors actifs biologiques)', '7221', 371, 0, 0, NULL, NULL),
(828, 'immobilisations corporelles (actifs biologiques)', '7222', 371, 0, 0, NULL, NULL),
(829, 'Produits en cours', '7341', 374, 0, 0, NULL, NULL),
(830, 'Travaux en cours', '7342', 374, 0, 0, NULL, NULL),
(831, 'Etudes en cours ', '3751', 375, 0, 0, NULL, NULL),
(832, 'Prestations de services en cours', '3752', 375, 0, 0, NULL, NULL),
(833, 'Produits intermédiaires', '7371', 377, 0, 0, NULL, NULL),
(834, 'Produits résiduels', '7372', 377, 0, 0, NULL, NULL),
(835, 'Quote-part transférée de pertes (comptabilité du gérant)', '7521', 379, 0, 0, NULL, NULL),
(836, 'Bénéfices attribués par transfert (comptabilité des associés non gérants)', '7525', 379, 0, 0, NULL, NULL),
(837, 'Immobilisations incorporelles', '7541', 380, 0, 0, NULL, NULL),
(838, 'Immobilisations corporelles', '7542', 380, 0, 0, NULL, NULL),
(839, 'Indemnités de fonction et autres rémunérations d\'administrateurs', '7581', 382, 0, 0, NULL, NULL),
(840, 'Indemnités d’assurances reçues', '7582', 382, 0, 0, NULL, NULL),
(841, 'Autres produits divers', '7588', 382, 0, 0, NULL, NULL),
(842, 'sur risques à court terme', '7591', 383, 0, 0, NULL, NULL),
(843, 'sur stocks', '7593', 383, 0, 0, NULL, NULL),
(844, 'sur créances', '7594', 383, 0, 0, NULL, NULL),
(845, 'sur autres charges pour dépréciations  et provisions pour risques à court terme d’exploitation  ', '7598', 383, 0, 0, NULL, NULL),
(846, 'Intérêts de prêts', '7712', 384, 0, 0, NULL, NULL),
(847, 'Intérêts sur créances diverses ', '7713', 384, 0, 0, NULL, NULL),
(848, 'Revenus des titres de participation', '7721', 385, 0, 0, NULL, NULL),
(849, 'Revenus autres titres immobilisés', '7722', 385, 0, 0, NULL, NULL),
(850, 'Revenus des obligations ', '7745', 387, 0, 0, NULL, NULL),
(851, 'Revenus des titres de placement ', '7746', 387, 0, 0, NULL, NULL),
(852, 'sur rentes viagères', '7781', 391, 0, 0, NULL, NULL),
(853, 'sur opérations financières', '7782', 391, 0, 0, NULL, NULL),
(854, 'sur instruments de trésorerie', '7784', 391, 0, 0, NULL, NULL),
(855, 'sur risques financiers', '7791', 392, 0, 0, NULL, NULL),
(856, 'sur titres de placement', '7795', 392, 0, 0, NULL, NULL),
(857, 'sur autres charges pour dépréciations et provisions pour risques à court terme financières', '7798', 392, 0, 0, NULL, NULL),
(858, 'pour risques et charges', '7911', 395, 0, 0, NULL, NULL),
(859, 'des immobilisations incorporelles', '7913', 395, 0, 0, NULL, NULL),
(860, 'des immobilisations corporelles', '7914', 395, 0, 0, NULL, NULL),
(861, 'pour risques et charges', '7971', 396, 0, 0, NULL, NULL),
(862, 'des immobilisations financières', '7972', 396, 0, 0, NULL, NULL),
(863, 'Activités exercées dans l\'Etat', '8911', 437, 0, 0, NULL, NULL),
(864, 'Activités exercées dans les autres Etats de la Région', '8912', 437, 0, 0, NULL, NULL),
(865, 'Activités exercées hors Région', '8913', 437, 0, 0, NULL, NULL),
(866, 'Dégrèvements', '8991', 440, 0, 0, NULL, NULL),
(867, 'Annulations pour pertes rétroactives', '8994', 440, 0, 0, NULL, NULL),
(868, 'Crédits confirmés obtenus', '9011', 441, 0, 0, NULL, NULL),
(869, 'Emprunts restant à encaisser', '9012', 441, 0, 0, NULL, NULL),
(870, 'Facilités de financement renouvelables', '9013', 441, 0, 0, NULL, NULL),
(871, ' Facilités d\'émission', '9014', 441, 0, 0, NULL, NULL),
(872, 'Autres engagements de financement obtenus', '9018', 441, 0, 0, NULL, NULL),
(873, 'Avals obtenus', '9021', 442, 0, 0, NULL, NULL),
(874, 'Cautions, garanties obtenues', '9022', 442, 0, 0, NULL, NULL),
(875, 'Hypothèques obtenues', '9023', 442, 0, 0, NULL, NULL),
(876, 'Effets endossés par des tiers', '9024', 442, 0, 0, NULL, NULL),
(877, 'Autres garanties obtenues', '9028', 442, 0, 0, NULL, NULL),
(878, 'Achats de marchandises à terme', '9031', 443, 0, 0, NULL, NULL),
(879, 'Achats à terme de devises', '9032', 443, 0, 0, NULL, NULL),
(880, 'Commandes fermes des clients', '9033', 443, 0, 0, NULL, NULL),
(881, 'Autres engagements réciproques', '9038', 443, 0, 0, NULL, NULL),
(882, 'Abandons de créances conditionnels', '9041', 444, 0, 0, NULL, NULL),
(883, 'Ventes avec clause de réserve de propriété ', '9043', 444, 0, 0, NULL, NULL),
(884, 'Divers engagements obtenus', '9048', 444, 0, 0, NULL, NULL),
(885, 'Crédits accordés non décaissés', '9051', 445, 0, 0, NULL, NULL),
(886, 'Autres engagements de financement accordés', '9058', 445, 0, 0, NULL, NULL),
(887, 'Avals accordés', '9061', 446, 0, 0, NULL, NULL),
(888, 'Cautions, garanties accordées', '9062', 446, 0, 0, NULL, NULL),
(889, 'Hypothèques accordées', '9063', 446, 0, 0, NULL, NULL),
(890, 'Effets endossés par l\'entité', '9064', 446, 0, 0, NULL, NULL),
(891, 'Autres garanties accordées', '9068', 446, 0, 0, NULL, NULL),
(892, 'Ventes de marchandises à terme', '9071', 447, 0, 0, NULL, NULL),
(893, 'Ventes à terme de devises', '9072', 447, 0, 0, NULL, NULL),
(894, 'Commandes fermes aux fournisseurs', '9073', 447, 0, 0, NULL, NULL),
(895, 'Autres engagements réciproques', '9078', 447, 0, 0, NULL, NULL),
(896, 'Annulations conditionnelles de dettes', '9081', 448, 0, 0, NULL, NULL),
(897, 'Engagements de retraite', '9082', 448, 0, 0, NULL, NULL),
(898, 'Achats avec clause de réserve de propriété', '9083', 448, 0, 0, NULL, NULL),
(899, 'Divers engagements accordés', '9088', 448, 0, 0, NULL, NULL),
(900, 'Dotations aux amortissements des immobilisations incorporelles', '6812', 354, 0, 0, NULL, NULL),
(901, 'Dotations aux amortissements des immobilisations corporelles', '6813', 354, 0, 0, NULL, NULL);

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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cpt_auto_ecritures`
--

INSERT INTO `cpt_auto_ecritures` (`id`, `lastdte`, `id_ch`, `id_client`, `module_id`, `site_id`) VALUES
(17, '2019-12-11', 50, NULL, 23, 328),
(18, '2019-12-11', 50, NULL, 23, 328),
(19, '2019-12-11', 50, NULL, 23, 328),
(20, '2019-12-14', 53, 1805, 23, 328),
(21, '2019-12-12', 54, 1753, 23, 328),
(22, '2019-12-12', 51, 1812, 23, 328);

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
  PRIMARY KEY (`id _liaison`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cpt_liaison_module`
--

INSERT INTO `cpt_liaison_module` (`id _liaison`, `site_id`, `module_id`, `lie`, `compte_ecriture`, `long_compte`, `souscompte_id`, `categorie_id`, `compte_id`, `libelle`, `code`, `champ`) VALUES
(1, 328, 22, 1, '5711', 4, 573, 65, 266, '5711 . Caisse en monnaie nationale', 'TRESLOC', 'Compte trésorerie (locale)'),
(2, 328, 22, 1, '5712', 4, 574, 65, 266, '5712 . Caisse en devises', 'TRESETR', 'Compte trésorerie (étrangère)'),
(3, 328, 22, 1, '702', 3, NULL, 78, NULL, '702 . VENTES DE PRODUITS FINIS', 'PROSERV', 'Compte des produits/services'),
(4, 328, 22, 1, '4431', 4, 448, 52, 187, '4431 . T.V.A. facturée sur ventes', 'TVA', 'Compte de la T.V.A'),
(5, 328, 23, 1, '5711', 4, 573, 65, 266, '5711 . Caisse en monnaie nationale', 'TRESLOC', 'Compte trésorerie (locale)'),
(6, 328, 23, 1, '5712', 4, 574, 65, 266, '5712 . Caisse en devises', 'TRESETR', 'Compte trésorerie (étrangère)'),
(7, 328, 23, 1, '701', 3, NULL, 78, NULL, '701 . VENTES DE MARCHANDISES', 'PROSERV', 'Compte des produits/services'),
(8, 328, 23, 1, '4431', 4, 448, 52, 187, '4431 . T.V.A. facturée sur ventes', 'TVA', 'Compte de la T.V.A');

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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`),
  KEY `libelle_id` (`libelle_id`),
  KEY `souresto_id` (`sousresto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`id`, `numero`, `dte_dep`, `motif`, `usd`, `cdf`, `taux`, `service`, `user_id`, `libelle_id`, `sousresto_id`, `psedo`, `site_id`) VALUES
(15, '00015', '2020-01-20', 'acgc', '0.0000000000', '4000.0000000000', 1700, 'restaurant', 471, 5, 123, 0, 356),
(16, '00016', '2020-01-21', 'Achat papier', '0.0000000000', '1000.0000000000', 1700, 'restaurant', 471, 5, 123, 0, 356),
(17, '00001', '2020-02-09', 'Split', '0.0000000000', '5000.0000000000', 1700, 'restaurant', 471, 6, 123, 0, 356),
(18, '00002', '2020-02-26', 'hfghfge', '5.0000000000', '1000.0000000000', 1700, 'restaurant', 476, 6, 123, 0, 356);

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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dep_libelles`
--

INSERT INTO `dep_libelles` (`id`, `code`, `designation`, `psedo`, `site_id`) VALUES
(1, '', 'transport', 0, 356),
(2, '', 'Collation', 0, 356),
(3, '', 'SNEL', 0, 356),
(4, '', 'REGIDESO', 0, 356),
(5, '', 'Bureautique', 0, 356),
(6, '', 'Reparation', 0, 356);

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
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `detailsplats`
--

INSERT INTO `detailsplats` (`id`, `nom`, `etat`, `psedo`, `hotel_id`) VALUES
(1, 'Bien cuit', 0, 0, 356),
(2, 'Bleu', 0, 0, 356),
(3, 'A point', 0, 0, 356),
(5, 'Saignant', 0, 0, 356),
(22, 'Ratatouille', 1, 0, 356),
(23, 'Avec sel', 4, 0, 356),
(24, 'Sans sel', 4, 0, 356),
(26, 'Poivre vert', 1, 0, 356);

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
  PRIMARY KEY (`id`),
  KEY `produit_id` (`produit_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `commande_id` (`commande_id`),
  KEY `lignecmd_id` (`lignecmd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  `sousresto_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `dte` date DEFAULT NULL,
  `hr` time DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fondscaisse`
--

INSERT INTO `fondscaisse` (`id`, `user_id`, `usd`, `cdf`, `sousresto_id`, `hotel_id`, `dte`, `hr`, `type`) VALUES
(1, 471, '0.0000000000', '4000.0000000000', 123, 356, '2020-01-20', '10:31:30', 'restaurant'),
(2, 471, '200.0000000000', '30000.0000000000', 123, 356, '2020-01-20', '23:03:31', 'restaurant'),
(3, 471, '50.0000000000', '20000.0000000000', 123, 356, '2020-02-09', '04:43:58', 'restaurant'),
(4, 476, '0.0000000000', '7000.0000000000', 123, 356, '2020-02-25', '17:09:00', 'restaurant'),
(5, 476, '0.0000000000', '50000.0000000000', 123, 356, '2020-02-25', '17:26:07', 'restaurant'),
(6, 471, '100.0000000000', '10000000.0000000000', 123, 356, '2020-02-26', '12:58:33', 'restaurant'),
(7, 476, '50.0000000000', '3000.0000000000', 123, 356, '2020-02-26', '15:42:51', 'restaurant'),
(8, 476, '20.0000000000', '20000.0000000000', 123, 356, '2020-06-02', '11:56:13', 'restaurant'),
(9, 476, '10.0000000000', '10000.0000000000', 123, 356, '2020-06-04', '12:10:47', 'restaurant');

-- --------------------------------------------------------

--
-- Structure de la table `fusion_factures`
--

DROP TABLE IF EXISTS `fusion_factures`;
CREATE TABLE IF NOT EXISTS `fusion_factures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fact` int(11) DEFAULT NULL,
  `id_fact_fus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fact_fus` (`id_fact_fus`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fusion_factures`
--

INSERT INTO `fusion_factures` (`id`, `id_fact`, `id_fact_fus`) VALUES
(46, 284, 286),
(47, 274, 286);

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
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `module_id` (`module_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `libelle`, `module_id`, `user_id`, `hotel_id`) VALUES
(3, 'Caisse', 22, 471, 356),
(4, 'Serveur', 22, 471, 356),
(5, 'Economat', 24, 471, 356),
(6, 'GRPADMIN', 22, 471, 356);

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
  PRIMARY KEY (`id`),
  KEY `commande_id` (`commande_id`,`produit_id`),
  KEY `produit_id` (`produit_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=8958 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lignes_commandes`
--

INSERT INTO `lignes_commandes` (`id`, `qte`, `qteoffert`, `pa`, `prix`, `prix2`, `mont_tva`, `repas`, `monnaie`, `dte`, `dte_h`, `commande_id`, `produit_id`, `user_id`, `hotel_id`, `id_sousresto`, `accomp`, `impr`, `qte2`) VALUES
(8953, 1, 0, '8950.0000000000', '21450.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2020-06-04', NULL, 291, 358, NULL, 356, NULL, '', 0, 0),
(8954, 3, 0, '8951.0000000000', '8250.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2020-06-04', NULL, 291, 470, NULL, 356, NULL, '', 0, 0),
(8955, 1, 0, '8952.0000000000', '5775.0000000000', '0.0000000000', '0.0000000000', 0, 'CDF', '2020-06-04', NULL, 291, 468, NULL, 356, NULL, '', 0, 0),
(8957, 1, 0, '8956.0000000000', '33000.0000000000', '0.0000000000', '0.0000000000', 1, 'CDF', '2020-06-04', NULL, 292, 493, NULL, 356, NULL, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `nom`, `code`) VALUES
(21, 'COMPTABILITE', 'MC'),
(22, 'Restaurant', 'MR'),
(23, 'Hebergement', 'MH'),
(24, 'Stock', 'MS'),
(25, 'CONFIGURATIONS_REGLAGES', 'MCR'),
(26, 'Ressources humaines', 'RH'),
(27, 'Facturation', 'MFACT'),
(28, 'Achat ', 'ACH'),
(29, 'Point de vente', 'POS');

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
  PRIMARY KEY (`id_monnaie`),
  KEY `company_id` (`company_id`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=912 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table ` monnaie`
--

INSERT INTO ` monnaie` (`id_monnaie`, `monnaie`, `lib_monnaie`, `symbole`, `choix`, `taux`, `tva`, `id_hotel`, `company_id`) VALUES
(909, NULL, 'USD', NULL, 0, NULL, NULL, 356, 299),
(910, NULL, 'CDF', NULL, 0, NULL, NULL, 356, 299),
(911, NULL, 'USD&CDF', NULL, 0, NULL, NULL, 356, 299);

-- --------------------------------------------------------

--
-- Structure de la table `niveau_chambre`
--

DROP TABLE IF EXISTS `niveau_chambre`;
CREATE TABLE IF NOT EXISTS `niveau_chambre` (
  `id_niv_cha` int(11) NOT NULL AUTO_INCREMENT,
  `lib_niv_cha` varchar(100) NOT NULL,
  `hotel_id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idpaie`, `montant`, `montantusd`, `montantcdf`, `taux`, `rendu`, `rendu_cdf`, `rendu_usd`, `remise`, `justification`, `monnaie_achat`, `id_mode_regl`, `id_monnaie`, `regl_id`, `site_id`, `company_id`, `id_sousresto`, `histch_id`, `resch_id`, `motif`, `annuler`, `session_id`) VALUES
(20, '35.0000000000', '35.0000000000', '0.0000000000', '1650.0000000000', '3.5000000000', '5775.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 20, 356, 299, 123, NULL, NULL, NULL, 0, NULL),
(21, '20.0000000000', '20.0000000000', '0.0000000000', '1650.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '0.0000000000', '', NULL, 2, NULL, 21, 356, 299, 123, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paragraphe_contrat`
--

DROP TABLE IF EXISTS `paragraphe_contrat`;
CREATE TABLE IF NOT EXISTS `paragraphe_contrat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paragraphe` text,
  `site_id` int(11) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `produit8id` (`produit_id`,`detplat_id`),
  KEY `detplat_id` (`detplat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `platspreparations`
--

INSERT INTO `platspreparations` (`id`, `produit_id`, `detplat_id`) VALUES
(1, 308, 26),
(2, 308, 30);

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
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`),
  KEY `module_id_2` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `module_id`, `souscription`, `prix_user`, `prix_user2`, `prix_par_user`, `prix_par_user2`) VALUES
(1, 1, 'mensuel', 25, 0, 0, 0),
(2, 1, 'annuel', 280, 0, 0, 0),
(3, 4, 'mensuel', 45, 0, 0, 0),
(4, 4, 'annuel', 485, 0, 0, 0),
(5, 7, 'mensuel', 3, 0, 0, 0),
(6, 7, 'annuel', 2, 0, 0, 0),
(7, 2, 'mensuel', 9, 0, 0, 0),
(8, 2, 'annuel', 80, 0, 0, 0),
(9, 6, 'mensuel', 75, 0, 0, 0),
(10, 6, 'annuel', 835, 0, 0, 0),
(11, 5, 'mensuel', 33, 0, 0, 0),
(12, 5, 'annuel', 335, 0, 0, 0),
(13, 30, 'mensuel', 15, 0, 0, 0),
(14, 30, 'annuel', 135, 0, 0, 0),
(15, 29, 'mensuel', 12, 0, 0, 0),
(16, 29, 'annuel', 102, 0, 0, 0),
(17, 31, '', 2.5, 0, 0, 0);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reglage_systeme`
--

INSERT INTO `reglage_systeme` (`id`, `tva`) VALUES
(2, 16);

-- --------------------------------------------------------

--
-- Structure de la table `resaffectation`
--

DROP TABLE IF EXISTS `resaffectation`;
CREATE TABLE IF NOT EXISTS `resaffectation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) NOT NULL,
  `site_id` int(11) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`,`site_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resconfig`
--

INSERT INTO `resconfig` (`id`, `nomcomp`, `adrcomp`, `m_insert`, `m_affich`, `taux`, `age`, `penalite`, `hopital`, `fuseauhoraire`, `prefsanct`, `prefconge`, `tva`, `echeance`, `liestock`, `infofact`, `sujetmail`, `msgmail`, `logo`, `module_id`, `site_id`, `checkin`, `checkout`, `pointage`) VALUES
(71, '', '', '', '', 1650, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, 21, 328, NULL, NULL, NULL),
(72, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 328, NULL, NULL, 0),
(73, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 328, NULL, NULL, 0),
(74, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 329, NULL, NULL, 0),
(75, 'dffxxf', 'cvbbbb', 'USD', 'USD', 1640, 18, 0, 'omeco', 'Africa/Abidjan', 'SAN', 'CNG', 14, 0, 0, NULL, NULL, NULL, 0x3437363837383139392e6a7067, 26, 329, NULL, NULL, 0),
(76, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 329, NULL, NULL, 0),
(77, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 330, NULL, NULL, 0),
(78, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 330, NULL, NULL, 0),
(79, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 330, NULL, NULL, 0),
(80, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 331, NULL, NULL, 0),
(81, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 331, NULL, NULL, 0),
(82, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 331, NULL, NULL, 0),
(83, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 332, NULL, NULL, 0),
(84, 'RHSURE', '42eme Rue ,10,Limete Yolo Kinshasa', 'USD', 'USD', 1640, 18, 2, 'RH', 'Africa/Kinshasa', 'RF', 'FACT', 14, 0, 0, NULL, NULL, NULL, 0x313134323139323536392e6a7067, 26, 332, NULL, NULL, 1),
(85, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 332, NULL, NULL, 0),
(86, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 333, NULL, NULL, 0),
(87, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 333, NULL, NULL, 0),
(88, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 333, NULL, NULL, 0),
(89, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 334, NULL, NULL, 0),
(90, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 334, NULL, NULL, 0),
(91, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 334, NULL, NULL, 0),
(92, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 334, NULL, NULL, 0),
(93, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 335, NULL, NULL, 0),
(94, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 335, NULL, NULL, 0),
(95, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 335, NULL, NULL, 0),
(96, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 335, NULL, NULL, 0),
(97, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 336, NULL, NULL, 0),
(98, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 336, NULL, NULL, 0),
(99, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 336, NULL, NULL, 0),
(100, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 336, NULL, NULL, 0),
(101, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 337, NULL, NULL, 0),
(102, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 337, NULL, NULL, 0),
(103, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 337, NULL, NULL, 0),
(104, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 337, NULL, NULL, 0),
(105, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 338, NULL, NULL, 0),
(106, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 338, NULL, NULL, 0),
(107, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 338, NULL, NULL, 0),
(108, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 338, NULL, NULL, 0),
(109, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 339, NULL, NULL, 0),
(110, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 339, NULL, NULL, 0),
(111, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 339, NULL, NULL, 0),
(112, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 339, NULL, NULL, 0),
(113, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 340, NULL, NULL, 0),
(114, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 340, NULL, NULL, 0),
(115, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 340, NULL, NULL, 0),
(116, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 340, NULL, NULL, 0),
(117, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 341, NULL, NULL, 0),
(118, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 341, NULL, NULL, 0),
(119, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 341, NULL, NULL, 0),
(120, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 341, NULL, NULL, 0),
(121, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 342, NULL, NULL, 0),
(122, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 342, NULL, NULL, 0),
(123, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 342, NULL, NULL, 0),
(124, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 342, NULL, NULL, 0),
(125, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 343, NULL, NULL, 0),
(126, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 343, NULL, NULL, 0),
(127, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 343, NULL, NULL, 0),
(128, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 344, NULL, NULL, 0),
(129, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 344, NULL, NULL, 0),
(130, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 344, NULL, NULL, 0),
(131, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 344, NULL, NULL, 0),
(132, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 345, NULL, NULL, 0),
(133, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 345, NULL, NULL, 0),
(134, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 345, NULL, NULL, 0),
(135, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 345, NULL, NULL, 0),
(136, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 346, NULL, NULL, 0),
(137, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 346, NULL, NULL, 0),
(138, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 346, NULL, NULL, 0),
(139, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 346, NULL, NULL, 0),
(140, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 347, NULL, NULL, 0),
(141, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 347, NULL, NULL, 0),
(142, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 347, NULL, NULL, 0),
(143, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 347, NULL, NULL, 0),
(144, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 348, NULL, NULL, 0),
(145, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 348, NULL, NULL, 0),
(146, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 348, NULL, NULL, 0),
(147, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 348, NULL, NULL, 0),
(148, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 349, NULL, NULL, 0),
(149, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 349, NULL, NULL, 0),
(150, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 349, NULL, NULL, 0),
(151, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 349, NULL, NULL, 0),
(152, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 350, NULL, NULL, 0),
(153, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 350, NULL, NULL, 0),
(154, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 350, NULL, NULL, 0),
(155, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 350, NULL, NULL, 0),
(156, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 351, NULL, NULL, 0),
(157, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 351, NULL, NULL, 0),
(158, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 351, NULL, NULL, 0),
(159, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 351, NULL, NULL, 0),
(160, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 352, NULL, NULL, 0),
(161, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 352, NULL, NULL, 0),
(162, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 352, NULL, NULL, 0),
(163, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 352, NULL, NULL, 0),
(164, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 353, NULL, NULL, 0),
(165, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 353, NULL, NULL, 0),
(166, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 353, NULL, NULL, 0),
(167, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 353, NULL, NULL, 0),
(168, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 354, NULL, NULL, 0),
(169, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 354, NULL, NULL, 0),
(170, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 354, NULL, NULL, 0),
(171, NULL, NULL, NULL, NULL, 1, 16, 0, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 21, 354, NULL, NULL, 0),
(172, 'Ebutelo Hotel', '', 'CDF', 'CDF', 1640, NULL, 0, NULL, '', 'FacHeb', 'FacRec', 14, 0, 0, '', '', '', 0x3337303234353434352e706e67, 23, 328, '11:00:00', '15:00:00', 0),
(173, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 355, NULL, NULL, 0),
(174, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 355, NULL, NULL, 0),
(175, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 355, NULL, NULL, 0),
(176, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 23, 356, NULL, NULL, 0),
(177, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, 'Africa/Kinshasa', NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 26, 356, NULL, NULL, 0),
(178, NULL, NULL, 'USD', 'CDF', 1640, NULL, 0, NULL, NULL, NULL, NULL, 14, 0, 0, NULL, NULL, NULL, NULL, 27, 356, NULL, NULL, 0);

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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resdeclaration`
--

INSERT INTO `resdeclaration` (`id`, `code`, `lib`, `pourtrav`, `poursoc`, `site_id`) VALUES
(82, 'IPR', 'DECLARATION IPR', 15, 0, 356),
(83, 'INSS', 'DECLARATION INSS', 28, 18, 356),
(84, 'INPP', 'DECLARATION INPP', 0, 18, 356);

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
  PRIMARY KEY (`id_res_table`),
  KEY `client_id` (`client_nom`,`table_id`,`hotel_id`),
  KEY `table_id` (`table_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservation_table`
--

INSERT INTO `reservation_table` (`id_res_table`, `date_res_tbl`, `date_hr_res_tbl`, `client_nom`, `table_id`, `hotel_id`) VALUES
(1, '2019-01-14', '2019-01-14 10:39:00', 'jojo', 1699, 289),
(2, '2019-01-14', '2019-01-14 10:39:00', 'jojo', 1695, 289),
(3, '2019-08-23', '2019-08-23 10:25:00', 'hkhkj', 1766, 328),
(4, '2019-10-24', '2019-10-24 13:39:00', 'xwx', 1783, 328),
(5, '2019-10-24', '2019-10-24 12:06:00', 'wxwxwx', 1783, 328),
(6, '2019-10-24', '2019-10-24 13:50:00', 'xxww', 1766, 328),
(7, '2019-10-24', '2019-10-24 13:52:00', 'ez', 1783, 328),
(8, '2019-10-24', '2019-10-24 13:58:00', 'xwwx', 1783, 328),
(9, '2019-10-24', '2019-10-24 14:02:00', 'zazazaza', 1783, 328),
(10, '2019-10-24', '2019-10-24 14:03:00', 'sazazaz', 1766, 328),
(11, '2020-01-29', '2020-01-29 15:24:00', 'BEN', 1815, 356);

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
  PRIMARY KEY (`idjrs`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resjours`
--

INSERT INTO `resjours` (`idjrs`, `codejrs`, `codejrsphp`, `libjrs`) VALUES
(1, 'lun', 0, 'lundi'),
(2, 'mar', 0, 'mardi'),
(3, 'mer', 0, 'mercredi'),
(4, 'jeu', 0, 'jeudi'),
(5, 'ven', 0, 'vendredi'),
(6, 'sam', 0, 'samedi'),
(7, 'dim', 0, 'dimanche');

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
  PRIMARY KEY (`id`),
  KEY `rubrique_id` (`rubrique_id`,`salaire_id`),
  KEY `categorie_id` (`salaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resrubriquesal`
--

INSERT INTO `resrubriquesal` (`id`, `rubrique_id`, `salaire_id`, `valeur`) VALUES
(1, 2, 1, '41000.0000000000'),
(2, 1, 1, '41000.0000000000'),
(3, 2, 2, '41000.0000000000'),
(4, 3, 2, '164000.0000000000'),
(5, 1, 2, '41000.0000000000'),
(6, 4, 2, '41000.0000000000'),
(7, 2, 3, '41000.0000000000'),
(8, 3, 3, '164000.0000000000'),
(9, 1, 3, '41000.0000000000'),
(10, 4, 3, '41000.0000000000'),
(11, 2, 4, '41000.0000000000'),
(12, 3, 4, '164000.0000000000'),
(13, 1, 4, '41000.0000000000'),
(14, 4, 4, '41000.0000000000'),
(15, 2, 5, '41000.0000000000'),
(16, 3, 5, '164000.0000000000'),
(17, 1, 5, '41000.0000000000'),
(18, 4, 5, '41000.0000000000'),
(19, 2, 6, '41000.0000000000'),
(20, 3, 6, '164000.0000000000'),
(21, 1, 6, '41000.0000000000'),
(22, 4, 6, '41000.0000000000'),
(23, 2, 7, '41000.0000000000'),
(24, 3, 7, '164000.0000000000'),
(25, 1, 7, '41000.0000000000'),
(26, 4, 7, '41000.0000000000'),
(27, 2, 8, '41000.0000000000'),
(28, 5, 8, '82000.0000000000'),
(29, 3, 8, '164000.0000000000'),
(30, 1, 8, '41000.0000000000'),
(31, 4, 8, '41000.0000000000'),
(32, 2, 9, '41000.0000000000'),
(33, 5, 9, '0.0000000000'),
(34, 3, 9, '164000.0000000000'),
(35, 1, 9, '41000.0000000000'),
(36, 4, 9, '41000.0000000000'),
(37, 2, 10, '41000.0000000000'),
(38, 5, 10, '0.0000000000'),
(39, 3, 10, '164000.0000000000'),
(40, 1, 10, '41000.0000000000'),
(41, 4, 10, '41000.0000000000'),
(42, 2, 11, '41000.0000000000'),
(43, 5, 11, '98400.0000000000'),
(44, 3, 11, '164000.0000000000'),
(45, 1, 11, '41000.0000000000'),
(46, 4, 11, '41000.0000000000');

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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `employe_id` (`employe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ressalaire`
--

INSERT INTO `ressalaire` (`id`, `libelle`, `libelle2`, `nbjrpreste`, `nbjrconge`, `montant`, `totbase`, `taux`, `dte`, `dte2`, `employe_id`, `psedo`, `jrpreavis`, `cong6preavis`, `congcomp`, `connonpris`, `arsal`, `indemnite`, `ancienete`, `motif`, `decompte`, `site_id`) VALUES
(1, 'Juillet 2019', 'Juillet2019', 0, 0, '410000.0000006600', '410000.0000006600', '1640.0000000000', '2019-08-06', NULL, 1, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(2, 'AoÃ»t 2019', 'Aout2019', 0, 0, '533000.0000006600', '410000.0000006600', '1640.0000000000', '2019-08-06', NULL, 2, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(3, 'AoÃ»t 2019', 'Aout2019', 20, 0, '438384.6153851200', '315384.6153851200', '1640.0000000000', '2019-08-08', NULL, 1, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(4, 'Janvier 2019', 'Janvier2019', 15, 4, '359538.4615388400', '236538.4615388400', '1640.0000000000', '2019-08-09', NULL, 3, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(5, 'FÃ©vrier 2019', 'Fevrier2019', 26, 0, '533000.0000006600', '410000.0000006600', '1640.0000000000', '2019-08-09', NULL, 3, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(6, 'Juillet 2019', 'Juillet2019', 20, 0, '438384.6153851200', '315384.6153851200', '1640.0000000000', '2019-08-09', NULL, 3, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(7, 'Mars 2019', 'Mars2019', 18, 8, '406846.1538466100', '283846.1538466100', '1640.0000000000', '2019-08-12', NULL, 3, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(8, 'Avril 2019', 'Avril2019', 18, 8, '615000.0000006600', '410000.0000006600', '1640.0000000000', '2019-08-12', NULL, 3, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(9, 'Mai 2019', 'Mai2019', 0, 0, '123000.0000000000', '0.0000000000', '1640.0000000000', '2019-08-14', NULL, 3, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(10, 'Juin 2019', 'Juin2019', 0, 0, '123000.0000000000', '0.0000000000', '1640.0000000000', '2019-08-14', NULL, 3, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332),
(11, 'Mars 2019', 'Mars2019', 16, 0, '473707.6923081000', '252307.6923081000', '1640.0000000000', '2019-08-14', NULL, 4, 0, 0, 0, 0, 0, '0.0000000000', '0.0000000000', '0', '0', 0, 332);

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
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ressanction`
--

INSERT INTO `ressanction` (`id`, `libelle`, `pseudo`, `nbrjr`, `retenue`, `contenu`, `site_id`) VALUES
(1, 'Reprimande', 0, 2, 1, '<p>hfuzfg&egrave;eftgefg</p>\r\n', 332);

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
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`,`sanction_id`),
  KEY `sanction_id` (`sanction_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ressanctionempl`
--

INSERT INTO `ressanctionempl` (`id`, `ref`, `employe_id`, `sanction_id`, `dte`, `dte1`, `dte2`, `nbre`, `retenu`, `comment`, `doc`, `encours`, `site_id`) VALUES
(1, 'RF00001', 2, 1, '2019-08-06', '2019-08-06', '2019-08-07', 2, 1, '<p>hfuzfg&egrave;eftgefg</p>\r\n', 0, 1, 332);

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
  PRIMARY KEY (`id`),
  KEY `employe_id` (`employe_id`),
  KEY `idsite` (`idsite`),
  KEY `point_id` (`point_id`),
  KEY `horaire_id` (`horaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `restmp_pointage`
--

INSERT INTO `restmp_pointage` (`id`, `employe_id`, `dte_in`, `point_id`, `idsite`, `horaire_id`, `compteurshift`, `idpointprec`) VALUES
(2, 2, '2019-08-06', 2, 332, 2, 0, 0);

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
  `depot_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fiche`),
  KEY `depot_id` (`depot_id`,`user_id`,`hotel_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=606 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `skt_fiche`
--

INSERT INTO `skt_fiche` (`id_fiche`, `numero`, `type`, `motif`, `beneficiere`, `nbrprod`, `dte`, `dte_time`, `approuve`, `depot_id`, `user_id`, `hotel_id`) VALUES
(84, '00008', 'appro', 'appro', '', 16, '2020-02-29', '2020-02-29 13:16:28', 1, 121, 471, 356),
(85, '00009', 'appro', 'appro', '', 14, '2020-02-29', '2020-02-29 13:31:48', 1, 121, 471, 356),
(86, '00010', 'appro', 'appro', '', 21, '2020-02-29', '2020-02-29 14:03:48', 1, 121, 471, 356),
(87, '00011', 'appro', 'appro', '', 26, '2020-02-29', '2020-02-29 14:21:00', 1, 121, 471, 356),
(88, '00012', 'appro', 'appro', '', 3, '2020-02-29', '2020-02-29 14:25:23', 1, 121, 471, 356),
(89, '00013', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 15:41:39', 1, 121, 471, 356),
(90, '00014', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 15:43:21', 1, 121, 471, 356),
(91, '00015', 'appro', 'appro', '', 4, '2020-02-29', '2020-02-29 15:47:40', 1, 121, 471, 356),
(92, '00016', 'appro', 'appro', '', 2, '2020-02-29', '2020-02-29 15:50:59', 1, 121, 471, 356),
(93, '00017', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 15:52:19', 1, 121, 471, 356),
(94, '00018', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 15:55:11', 1, 121, 471, 356),
(95, '00019', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 15:57:22', 1, 121, 471, 356),
(96, '00020', 'appro', 'appro', '', 2, '2020-02-29', '2020-02-29 15:59:53', 1, 121, 471, 356),
(97, '00021', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 16:02:53', 1, 121, 471, 356),
(98, '00022', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 16:05:35', 1, 121, 471, 356),
(99, '00023', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 16:07:12', 1, 121, 471, 356),
(100, '00024', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 16:11:22', 1, 121, 471, 356),
(101, '00025', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 16:14:33', 1, 121, 471, 356),
(102, '00026', 'appro', 'appro', '', 4, '2020-02-29', '2020-02-29 16:20:57', 1, 121, 471, 356),
(103, '00027', 'appro', 'appro', '', 16, '2020-02-29', '2020-02-29 16:35:41', 1, 121, 471, 356),
(104, '00028', 'appro', 'appro', '', 3, '2020-02-29', '2020-02-29 16:40:41', 1, 121, 471, 356),
(105, '00029', 'appro', 'appro', '', 4, '2020-02-29', '2020-02-29 16:54:34', 1, 121, 471, 356),
(106, '00030', 'appro', 'appro', '', 17, '2020-02-29', '2020-02-29 16:54:55', 1, 121, 471, 356),
(107, '00031', 'appro', 'appro', '', 3, '2020-02-29', '2020-02-29 17:11:29', 1, 121, 471, 356),
(108, '00032', 'appro', 'appro', '', 4, '2020-02-29', '2020-02-29 17:12:59', 1, 121, 471, 356),
(109, '00033', 'appro', 'appro', '', 6, '2020-02-29', '2020-02-29 17:14:33', 1, 121, 471, 356),
(110, '00034', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:15:03', 1, 121, 471, 356),
(111, '00035', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:19:45', 1, 121, 471, 356),
(112, '00036', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:21:37', 1, 121, 471, 356),
(113, '00037', 'appro', 'appro', '', 2, '2020-02-29', '2020-02-29 17:30:31', 1, 121, 471, 356),
(114, '00038', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:32:16', 1, 121, 471, 356),
(115, '00039', 'appro', 'appro', '', 11, '2020-02-29', '2020-02-29 17:35:36', 1, 121, 471, 356),
(116, '00040', 'appro', 'appro', '', 3, '2020-02-29', '2020-02-29 17:37:36', 1, 121, 471, 356),
(117, '00041', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:39:20', 1, 121, 471, 356),
(118, '00042', 'appro', 'appro', '', 9, '2020-02-29', '2020-02-29 17:39:46', 1, 121, 471, 356),
(119, '00043', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:41:06', 1, 121, 471, 356),
(120, '00044', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:42:45', 1, 121, 471, 356),
(121, '00045', 'appro', 'appro', '', 8, '2020-02-29', '2020-02-29 17:43:37', 1, 121, 471, 356),
(122, '00046', 'appro', 'appro', '', 6, '2020-02-29', '2020-02-29 17:46:01', 1, 121, 471, 356),
(123, '00047', 'appro', 'appro', '', 8, '2020-02-29', '2020-02-29 17:48:58', 1, 121, 471, 356),
(124, '00048', 'appro', 'appro', '', 2, '2020-02-29', '2020-02-29 17:49:12', 1, 121, 471, 356),
(125, '00049', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 17:50:41', 1, 121, 471, 356),
(126, '00050', 'appro', 'appro', '', 8, '2020-02-29', '2020-02-29 17:53:15', 1, 121, 471, 356),
(127, '00051', 'appro', 'appro', '', 8, '2020-02-29', '2020-02-29 17:56:21', 1, 121, 471, 356),
(128, '00052', 'appro', 'appro', '', 10, '2020-02-29', '2020-02-29 18:01:41', 1, 121, 471, 356),
(129, '00053', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 18:03:43', 1, 121, 471, 356),
(130, '00054', 'appro', 'appro', '', 6, '2020-02-29', '2020-02-29 18:04:03', 1, 121, 471, 356),
(131, '00055', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 18:06:51', 1, 121, 471, 356),
(132, '00056', 'appro', 'appro', '', 5, '2020-02-29', '2020-02-29 18:09:27', 1, 121, 471, 356),
(133, '00057', 'appro', 'appro', '', 2, '2020-02-29', '2020-02-29 18:12:21', 1, 121, 471, 356),
(134, '00058', 'appro', 'appro', '', 4, '2020-02-29', '2020-02-29 18:16:16', 1, 121, 471, 356),
(135, '00059', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 18:17:20', 1, 121, 471, 356),
(136, '00060', 'appro', 'appro', '', 6, '2020-02-29', '2020-02-29 18:26:01', 1, 121, 471, 356),
(137, '00061', 'appro', 'appro', '', 3, '2020-02-29', '2020-02-29 18:31:47', 1, 121, 471, 356),
(138, '00062', 'appro', 'appro', '', 1, '2020-02-29', '2020-02-29 18:33:01', 1, 121, 471, 356),
(139, '00063', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:18:45', 1, 121, 478, 356),
(140, '00077', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:21:07', 1, 121, 478, 356),
(141, '00078', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:22:29', 1, 121, 478, 356),
(142, '00064', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:23:40', 1, 121, 478, 356),
(143, '00079', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:26:00', 1, 121, 478, 356),
(144, '00065', 'appro', 'appro', '', 2, '2020-03-01', '2020-03-01 09:36:10', 1, 121, 478, 356),
(145, '00080', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:37:02', 1, 121, 478, 356),
(146, '00081', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:37:31', 1, 121, 478, 356),
(147, '00066', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:38:38', 1, 121, 478, 356),
(148, '00082', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:41:06', 1, 121, 478, 356),
(149, '00083', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:42:16', 1, 121, 478, 356),
(150, '00084', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:43:17', 1, 121, 478, 356),
(151, '00067', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:43:52', 1, 121, 478, 356),
(152, '00085', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:44:44', 1, 121, 478, 356),
(153, '00068', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:45:33', 1, 121, 478, 356),
(154, '00069', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:46:08', 1, 121, 478, 356),
(155, '00070', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:47:02', 1, 121, 478, 356),
(156, '00086', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:47:49', 1, 121, 478, 356),
(157, '00071', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:49:23', 1, 121, 478, 356),
(158, '00087', 'sortie', 'sortie', 'jean paul', 3, '2020-03-01', '2020-03-01 09:51:03', 1, 121, 478, 356),
(159, '00072', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:51:42', 1, 121, 478, 356),
(160, '00088', 'sortie', 'sortie', 'jean paul', 2, '2020-03-01', '2020-03-01 09:54:05', 1, 121, 478, 356),
(161, '00073', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:54:22', 1, 121, 478, 356),
(162, '00089', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:55:19', 1, 121, 478, 356),
(163, '00090', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:56:21', 1, 121, 478, 356),
(164, '00074', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 09:57:30', 1, 121, 478, 356),
(165, '00091', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:58:51', 1, 121, 478, 356),
(166, '00092', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 09:59:26', 1, 121, 478, 356),
(167, '00093', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:00:00', 1, 121, 478, 356),
(168, '00094', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:00:38', 1, 121, 478, 356),
(169, '00095', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:00:56', 1, 121, 478, 356),
(170, '00096', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:02:16', 1, 121, 478, 356),
(171, '00097', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:03:03', 1, 121, 478, 356),
(172, '00098', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:03:49', 1, 121, 478, 356),
(173, '00099', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:04:14', 1, 121, 478, 356),
(174, '00100', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:04:43', 1, 121, 478, 356),
(175, '00101', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:05:07', 1, 121, 478, 356),
(176, '00102', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:05:40', 1, 121, 478, 356),
(177, '00103', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:06:40', 1, 121, 478, 356),
(178, '00075', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:07:14', 1, 121, 478, 356),
(179, '00076', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:07:57', 1, 121, 478, 356),
(180, '00104', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:08:43', 1, 121, 478, 356),
(181, '00105', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:10:46', 1, 121, 478, 356),
(182, '00106', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:12:23', 1, 121, 478, 356),
(183, '00107', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:16:23', 1, 121, 478, 356),
(184, '00108', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:24:28', 1, 121, 478, 356),
(185, '00109', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:25:57', 1, 121, 478, 356),
(186, '00077', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:29:16', 1, 121, 478, 356),
(187, '00078', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:30:02', 1, 121, 478, 356),
(188, '00079', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:30:42', 1, 121, 478, 356),
(189, '00080', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:31:34', 1, 121, 478, 356),
(190, '00110', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:32:14', 1, 121, 478, 356),
(191, '00081', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:32:45', 1, 121, 478, 356),
(192, '00082', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:33:50', 1, 121, 478, 356),
(193, '00111', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:35:18', 1, 121, 478, 356),
(194, '00112', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:36:03', 1, 121, 478, 356),
(195, '00113', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:36:31', 1, 121, 478, 356),
(196, '00114', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:37:09', 1, 121, 478, 356),
(197, '00083', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:39:00', 1, 121, 478, 356),
(198, '00084', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 10:39:28', 1, 121, 478, 356),
(199, '00115', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:40:05', 1, 121, 478, 356),
(200, '00116', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 10:40:34', 1, 121, 478, 356),
(201, '00117', 'sortie', 'sortie', 'jean paul', 4, '2020-03-01', '2020-03-01 10:59:16', 1, 121, 478, 356),
(202, '00118', 'sortie', 'sortie', 'jean paul', 7, '2020-03-01', '2020-03-01 11:03:48', 1, 121, 478, 356),
(203, '00119', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 11:04:39', 1, 121, 478, 356),
(204, '00120', 'sortie', 'sortie', '', 1, '2020-03-01', '2020-03-01 11:07:22', 1, 121, 478, 356),
(205, '00121', 'sortie', 'sortie', '', 0, '2020-03-01', '2020-03-01 12:46:03', 1, 121, 504, 356),
(206, '00122', 'sortie', 'sortie', '', 1, '2020-03-01', '2020-03-01 13:04:25', 1, 121, 504, 356),
(207, '00085', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:05:38', 1, 121, 478, 356),
(208, '00086', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:09:35', 1, 121, 478, 356),
(209, '00123', 'sortie', 'sortie', '', 2, '2020-03-01', '2020-03-01 13:12:55', 1, 121, 504, 356),
(210, '00087', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:13:15', 1, 121, 478, 356),
(211, '00088', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:15:28', 1, 121, 478, 356),
(212, '00089', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:22:37', 1, 121, 478, 356),
(213, '00090', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:30:33', 1, 121, 471, 356),
(214, '00091', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:36:19', 1, 121, 478, 356),
(215, '00092', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:38:39', 1, 121, 478, 356),
(216, '00093', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:42:00', 1, 121, 478, 356),
(217, '00094', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:43:45', 1, 121, 478, 356),
(218, '00095', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:44:49', 1, 121, 478, 356),
(219, '00096', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:45:49', 1, 121, 478, 356),
(220, '00097', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:51:10', 1, 121, 478, 356),
(221, '00098', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 13:54:50', 1, 121, 478, 356),
(222, '00099', 'appro', 'appro', '', 6, '2020-03-01', '2020-03-01 13:57:41', 1, 121, 478, 356),
(223, '00124', 'sortie', 'sortie', '', 2, '2020-03-01', '2020-03-01 14:17:13', 1, 121, 504, 356),
(224, '00125', 'sortie', 'sortie', '', 3, '2020-03-01', '2020-03-01 14:24:43', 1, 121, 504, 356),
(225, '00100', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 14:30:46', 1, 121, 478, 356),
(226, '00126', 'sortie', 'sortie', '', 10, '2020-03-01', '2020-03-01 14:32:35', 1, 121, 504, 356),
(227, '00127', 'sortie', 'sortie', '', 2, '2020-03-01', '2020-03-01 14:32:56', 1, 121, 504, 356),
(228, '00128', 'sortie', 'sortie', '', 3, '2020-03-01', '2020-03-01 14:39:29', 1, 121, 504, 356),
(229, '00129', 'sortie', 'sortie', '', 0, '2020-03-01', '2020-03-01 14:39:54', 1, 121, 504, 356),
(230, '00130', 'sortie', 'sortie', '', 3, '2020-03-01', '2020-03-01 14:51:24', 1, 121, 504, 356),
(231, '00131', 'sortie', 'sortie', '', 1, '2020-03-01', '2020-03-01 14:57:38', 1, 121, 476, 356),
(232, '00132', 'sortie', 'sortie', '', 4, '2020-03-01', '2020-03-01 14:57:53', 1, 121, 504, 356),
(233, '00133', 'sortie', 'sortie', '', 1, '2020-03-01', '2020-03-01 14:58:15', 1, 121, 504, 356),
(234, '00101', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:07:03', 1, 121, 478, 356),
(235, '00102', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:08:27', 1, 121, 478, 356),
(236, '00103', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:09:31', 1, 121, 478, 356),
(237, '00104', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:10:19', 1, 121, 478, 356),
(238, '00105', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:11:51', 1, 121, 478, 356),
(239, '00106', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:13:18', 1, 121, 478, 356),
(240, '00107', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:14:05', 1, 121, 471, 356),
(241, '00108', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:14:16', 1, 121, 478, 356),
(242, '00109', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:15:39', 1, 121, 478, 356),
(243, '00110', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:16:06', 1, 121, 478, 356),
(244, '00111', 'appro', 'appro', '', 1, '2020-03-01', '2020-03-01 15:17:00', 1, 121, 478, 356),
(245, '00112', 'appro', 'appro', '', 3, '2020-03-01', '2020-03-01 15:25:05', 1, 121, 471, 356),
(246, '00134', 'sortie', 'sortie', '', 5, '2020-03-01', '2020-03-01 15:43:15', 1, 121, 476, 356),
(247, '00135', 'sortie', 'sortie', '', 3, '2020-03-01', '2020-03-01 16:05:04', 1, 121, 476, 356),
(248, '00136', 'sortie', 'sortie', '', 3, '2020-03-01', '2020-03-01 16:05:45', 1, 121, 476, 356),
(249, '00137', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 16:09:00', 1, 121, 478, 356),
(250, '00138', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 16:11:10', 1, 121, 478, 356),
(251, '00139', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 16:15:33', 1, 121, 478, 356),
(252, '00140', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 16:20:53', 1, 121, 478, 356),
(253, '00141', 'sortie', 'sortie', 'jean paul', 2, '2020-03-01', '2020-03-01 17:02:54', 1, 121, 478, 356),
(254, '00142', 'sortie', 'sortie', 'jean paul', 1, '2020-03-01', '2020-03-01 17:08:25', 1, 121, 478, 356),
(255, '00143', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 13:08:06', 1, 121, 478, 356),
(256, '00113', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 13:16:54', 1, 121, 478, 356),
(257, '00144', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 14:17:51', 1, 121, 478, 356),
(258, '00114', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:18:59', 1, 121, 478, 356),
(259, '00115', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:20:01', 1, 121, 478, 356),
(260, '00116', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:22:30', 1, 121, 478, 356),
(261, '00117', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:23:17', 1, 121, 478, 356),
(262, '00145', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 14:24:54', 1, 121, 478, 356),
(263, '00146', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 14:29:01', 1, 121, 478, 356),
(264, '00118', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:30:10', 1, 121, 478, 356),
(265, '00147', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 14:31:41', 1, 121, 478, 356),
(266, '00148', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 14:33:15', 1, 121, 478, 356),
(267, '00149', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 14:34:26', 1, 121, 478, 356),
(268, '00150', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 14:35:43', 1, 121, 478, 356),
(269, '00119', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:38:40', 1, 121, 478, 356),
(270, '00120', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:57:16', 1, 121, 478, 356),
(271, '00121', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:58:18', 1, 121, 478, 356),
(272, '00122', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 14:59:14', 1, 121, 478, 356),
(273, '00123', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:00:16', 1, 121, 478, 356),
(274, '00124', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:02:06', 1, 121, 478, 356),
(275, '00125', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:02:57', 1, 121, 478, 356),
(276, '00126', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:04:01', 1, 121, 478, 356),
(277, '00127', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:04:58', 1, 121, 478, 356),
(278, '00128', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:06:59', 1, 121, 478, 356),
(279, '00151', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 15:13:56', 1, 121, 478, 356),
(280, '00152', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 15:29:04', 1, 121, 478, 356),
(281, '00153', 'sortie', 'sortie', '', 1, '2020-03-06', '2020-03-06 15:32:28', 1, 121, 478, 356),
(282, '00154', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 15:33:48', 1, 121, 478, 356),
(283, '00155', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 15:35:31', 1, 121, 478, 356),
(284, '00129', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:54:24', 1, 121, 478, 356),
(285, '00130', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:55:53', 1, 121, 478, 356),
(286, '00131', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:57:16', 1, 121, 478, 356),
(287, '00132', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 15:58:33', 1, 121, 478, 356),
(288, '00156', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:00:01', 1, 121, 478, 356),
(289, '00157', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:01:35', 1, 121, 478, 356),
(290, '00133', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:13:32', 1, 121, 478, 356),
(291, '00134', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:14:23', 1, 121, 478, 356),
(292, '00158', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:16:31', 1, 121, 478, 356),
(293, '00159', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:17:26', 1, 121, 478, 356),
(294, '00160', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:18:24', 1, 121, 478, 356),
(295, '00161', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:23:02', 1, 121, 478, 356),
(296, '00162', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:24:02', 1, 121, 478, 356),
(297, '00163', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:24:53', 1, 121, 478, 356),
(298, '00164', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:25:54', 1, 121, 478, 356),
(299, '00135', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:27:07', 1, 121, 478, 356),
(300, '00136', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:27:52', 1, 121, 478, 356),
(301, '00165', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:29:33', 1, 121, 478, 356),
(302, '00137', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:31:04', 1, 121, 478, 356),
(303, '00138', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:32:43', 1, 121, 478, 356),
(304, '00166', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:34:27', 1, 121, 478, 356),
(305, '00139', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:35:58', 1, 121, 478, 356),
(306, '00140', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:37:24', 1, 121, 478, 356),
(307, '00167', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:38:35', 1, 121, 478, 356),
(308, '00168', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:40:02', 1, 121, 478, 356),
(309, '00141', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:41:22', 1, 121, 478, 356),
(310, '00169', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:43:02', 1, 121, 478, 356),
(311, '00142', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:44:38', 1, 121, 478, 356),
(312, '00170', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:46:05', 1, 121, 478, 356),
(313, '00171', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:55:57', 1, 121, 478, 356),
(314, '00172', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:57:19', 1, 121, 478, 356),
(315, '00173', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 16:58:15', 1, 121, 478, 356),
(316, '00143', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 16:59:22', 1, 121, 478, 356),
(317, '00174', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 17:00:29', 1, 121, 478, 356),
(318, '00175', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 17:01:48', 1, 121, 478, 356),
(319, '00144', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 18:58:58', 1, 121, 478, 356),
(320, '00145', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 18:59:54', 1, 121, 478, 356),
(321, '00146', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 19:00:35', 1, 121, 478, 356),
(322, '00147', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 19:01:59', 1, 121, 478, 356),
(323, '00148', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 19:45:25', 1, 121, 478, 356),
(324, '00149', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 19:46:13', 1, 121, 478, 356),
(325, '00150', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 19:46:46', 1, 121, 478, 356),
(326, '00151', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 19:47:21', 1, 121, 478, 356),
(327, '00176', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 19:50:18', 1, 121, 478, 356),
(328, '00177', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 19:51:22', 1, 121, 478, 356),
(329, '00178', 'sortie', 'sortie', 'jean paul', 1, '2020-03-06', '2020-03-06 19:52:59', 1, 121, 478, 356),
(330, '00152', 'appro', 'appro', '', 1, '2020-03-06', '2020-03-06 19:54:46', 1, 121, 478, 356),
(331, '00153', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:05:04', 1, 121, 478, 356),
(332, '00154', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:08:12', 1, 121, 478, 356),
(333, '00155', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:12:16', 1, 121, 478, 356),
(334, '00156', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:13:41', 1, 121, 478, 356),
(335, '00157', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:15:12', 1, 121, 478, 356),
(336, '00158', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:16:16', 1, 121, 478, 356),
(337, '00159', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:17:29', 1, 121, 478, 356),
(338, '00160', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:19:13', 1, 121, 478, 356),
(339, '00161', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:19:49', 1, 121, 478, 356),
(340, '00162', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:20:20', 1, 121, 478, 356),
(341, '00163', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 10:21:28', 1, 121, 478, 356),
(342, '00179', 'sortie', 'sortie', 'jean paul !  barmangazebo', 1, '2020-03-07', '2020-03-07 10:48:43', 1, 121, 478, 356),
(343, '00180', 'sortie', 'sortie', 'jean paul-barman gazebo', 2, '2020-03-07', '2020-03-07 10:51:06', 1, 121, 478, 356),
(344, '00164', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 11:05:54', 1, 121, 478, 356),
(345, '00181', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 11:46:03', 1, 121, 478, 356),
(346, '00182', 'sortie', 'sortie', 'jean paul', 1, '2020-03-07', '2020-03-07 12:36:37', 1, 121, 478, 356),
(347, '00183', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 12:37:45', 1, 121, 478, 356),
(348, '00184', 'sortie', 'sortie', 'jean paul', 1, '2020-03-07', '2020-03-07 12:39:19', 1, 121, 478, 356),
(349, '00165', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 12:42:43', 1, 121, 478, 356),
(350, '00166', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 12:45:58', 1, 121, 478, 356),
(351, '00167', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 13:01:52', 1, 121, 478, 356),
(352, '00168', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 13:02:49', 1, 121, 478, 356),
(353, '00185', 'sortie', 'sortie', 'jean paul', 1, '2020-03-07', '2020-03-07 13:04:39', 1, 121, 478, 356),
(354, '00186', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:06:20', 1, 121, 478, 356),
(355, '00169', 'appro', 'appro', '', 1, '2020-03-07', '2020-03-07 13:13:31', 1, 121, 478, 356),
(356, '00187', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:34:24', 1, 121, 478, 356),
(357, '00188', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:42:52', 1, 121, 478, 356),
(358, '00189', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:45:34', 1, 121, 478, 356),
(359, '00190', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:46:23', 1, 121, 478, 356),
(360, '00191', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:47:12', 1, 121, 478, 356),
(361, '00192', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:48:08', 1, 121, 478, 356),
(362, '00193', 'sortie', 'sortie', '12', 1, '2020-03-07', '2020-03-07 13:50:02', 1, 121, 478, 356),
(363, '00194', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:52:19', 1, 121, 478, 356),
(364, '00195', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:53:21', 1, 121, 478, 356),
(365, '00196', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:54:49', 1, 121, 478, 356),
(366, '00197', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 13:57:09', 1, 121, 478, 356),
(367, '00198', 'sortie', 'sortie', 'jean paul !  barmangazebo', 1, '2020-03-07', '2020-03-07 13:58:26', 1, 121, 478, 356),
(368, '00199', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 14:10:34', 1, 121, 478, 356),
(369, '00200', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 14:11:39', 1, 121, 478, 356),
(370, '00201', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 14:12:43', 1, 121, 478, 356),
(371, '00202', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 14:13:28', 1, 121, 478, 356),
(372, '00203', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 14:18:37', 1, 121, 478, 356),
(373, '00204', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 14:19:56', 1, 121, 478, 356),
(374, '00205', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-07', '2020-03-07 15:11:57', 1, 121, 478, 356),
(375, '00170', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:45:03', 1, 121, 478, 356),
(376, '00171', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:46:15', 1, 121, 478, 356),
(377, '00172', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:47:19', 1, 121, 478, 356),
(378, '00173', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:48:17', 1, 121, 478, 356),
(379, '00174', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:49:11', 1, 121, 478, 356),
(380, '00175', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:50:11', 1, 121, 478, 356),
(381, '00176', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:51:04', 1, 121, 478, 356),
(382, '00177', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 09:51:50', 1, 121, 478, 356),
(383, '00178', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 10:05:31', 1, 121, 478, 356),
(384, '00179', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 10:06:28', 1, 121, 478, 356),
(385, '00206', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:07:51', 1, 121, 478, 356),
(386, '00207', 'sortie', 'sortie', '', 1, '2020-03-08', '2020-03-08 10:08:44', 1, 121, 478, 356),
(387, '00208', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:11:51', 1, 121, 478, 356),
(388, '00209', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:12:53', 1, 121, 478, 356),
(389, '00210', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:14:11', 1, 121, 478, 356),
(390, '00211', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:25:12', 1, 121, 478, 356),
(391, '00212', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:26:12', 1, 121, 478, 356),
(392, '00213', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:29:23', 1, 121, 478, 356),
(393, '00214', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:30:24', 1, 121, 478, 356),
(394, '00215', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:31:20', 1, 121, 478, 356),
(395, '00216', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:32:04', 1, 121, 478, 356),
(396, '00217', 'sortie', 'sortie', 'jean paul !  barmangazebo', 1, '2020-03-08', '2020-03-08 10:33:08', 1, 121, 478, 356),
(397, '00218', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:34:42', 1, 121, 478, 356),
(398, '00219', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:36:59', 1, 121, 478, 356),
(399, '00220', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 10:37:51', 1, 121, 478, 356),
(400, '00221', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:40:45', 1, 121, 478, 356),
(401, '00222', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 10:42:05', 1, 121, 478, 356),
(402, '00223', 'sortie', 'sortie', 'jean paul-barman gazebo VOIR BUFFET SAMEDI', 1, '2020-03-08', '2020-03-08 10:49:24', 1, 121, 478, 356),
(403, '00224', 'sortie', 'sortie', 'jean paul-barman gazebo VOIR BUFFET SAMEDI', 1, '2020-03-08', '2020-03-08 10:56:27', 1, 121, 478, 356),
(404, '00225', 'sortie', 'sortie', 'jean paul-barman gazebo VOIR BUFFET SAMEDI', 1, '2020-03-08', '2020-03-08 10:57:49', 1, 121, 478, 356),
(405, '00226', 'sortie', 'sortie', 'jean paul-barman gazebo VOIR BUFFET SAMEDI', 1, '2020-03-08', '2020-03-08 10:59:28', 1, 121, 478, 356),
(406, '00180', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:02:26', 1, 121, 478, 356),
(407, '00181', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:05:21', 1, 121, 478, 356),
(408, '00182', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:05:53', 1, 121, 478, 356),
(409, '00227', 'sortie', 'sortie', 'jean paul-barman gazebo VOIR BUFFET SAMEDI', 1, '2020-03-08', '2020-03-08 11:08:00', 1, 121, 478, 356),
(410, '00228', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 11:09:44', 1, 121, 478, 356),
(411, '00229', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 11:11:46', 1, 121, 478, 356),
(412, '00230', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 11:12:20', 1, 121, 478, 356),
(413, '00231', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 11:13:40', 1, 121, 478, 356),
(414, '00232', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 11:14:57', 1, 121, 478, 356),
(415, '00183', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:20:38', 1, 121, 478, 356),
(416, '00184', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:35:39', 1, 121, 478, 356),
(417, '00185', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:36:27', 1, 121, 478, 356),
(418, '00186', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:37:18', 1, 121, 478, 356),
(419, '00187', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:38:11', 1, 121, 478, 356),
(420, '00188', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 11:43:08', 1, 121, 478, 356),
(421, '00233', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 11:45:54', 1, 121, 478, 356),
(422, '00234', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 12:23:53', 1, 121, 478, 356),
(423, '00189', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 15:28:18', 1, 121, 478, 356),
(424, '00235', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 15:29:35', 1, 121, 478, 356),
(425, '00236', 'sortie', 'sortie', 'jean paul-barman gazebo BUFFET MAMA OLIV', 1, '2020-03-08', '2020-03-08 16:12:14', 1, 121, 478, 356),
(426, '00237', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 16:33:43', 1, 121, 478, 356),
(427, '00238', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 16:38:07', 1, 121, 478, 356),
(428, '00239', 'sortie', 'sortie', 'jean paul-barman gazebo BUFFET MAMA OLIV', 1, '2020-03-08', '2020-03-08 16:39:46', 1, 121, 478, 356),
(429, '00240', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 16:44:02', 1, 121, 478, 356),
(430, '00241', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 16:45:23', 1, 121, 478, 356),
(431, '00190', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 16:50:46', 1, 121, 478, 356),
(432, '00242', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 16:51:47', 1, 121, 478, 356),
(433, '00243', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 18:27:58', 1, 121, 478, 356),
(434, '00244', 'sortie', 'sortie', 'jean paul-barman gazebo BUFFET MAMA OLIV', 1, '2020-03-08', '2020-03-08 18:41:26', 1, 121, 478, 356),
(435, '00245', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:43:40', 1, 121, 478, 356),
(436, '00246', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:45:50', 1, 121, 478, 356),
(437, '00247', 'sortie', 'sortie', 'J', 1, '2020-03-08', '2020-03-08 18:46:56', 1, 121, 478, 356),
(438, '00248', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:47:47', 1, 121, 478, 356),
(439, '00249', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:48:45', 1, 121, 478, 356),
(440, '00250', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:49:41', 1, 121, 478, 356),
(441, '00251', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:50:23', 1, 121, 478, 356),
(442, '00252', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:52:36', 1, 121, 478, 356),
(443, '00253', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:54:12', 1, 121, 478, 356),
(444, '00254', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:56:38', 1, 121, 478, 356),
(445, '00255', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 18:57:32', 1, 121, 478, 356),
(446, '00191', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 18:58:48', 1, 121, 478, 356),
(447, '00256', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:00:05', 1, 121, 478, 356),
(448, '00257', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:01:33', 1, 121, 478, 356),
(449, '00258', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:02:22', 1, 121, 478, 356),
(450, '00259', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:03:44', 1, 121, 478, 356),
(451, '00260', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:04:42', 1, 121, 478, 356),
(452, '00261', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:06:23', 1, 121, 478, 356),
(453, '00262', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:07:12', 1, 121, 478, 356),
(454, '00263', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:08:22', 1, 121, 478, 356),
(455, '00264', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-08', '2020-03-08 19:11:09', 1, 121, 478, 356),
(456, '00265', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:13:22', 1, 121, 478, 356),
(457, '00266', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:31:51', 1, 121, 478, 356),
(458, '00267', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:35:02', 1, 121, 478, 356),
(459, '00268', 'sortie', 'sortie', '', 1, '2020-03-08', '2020-03-08 19:36:07', 1, 121, 478, 356),
(460, '00269', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:36:45', 1, 121, 478, 356),
(461, '00270', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:37:38', 1, 121, 478, 356),
(462, '00271', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:39:40', 1, 121, 478, 356),
(463, '00192', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 19:41:02', 1, 121, 478, 356),
(464, '00272', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:43:05', 1, 121, 478, 356),
(465, '00273', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:43:58', 1, 121, 478, 356),
(466, '00274', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:44:38', 1, 121, 478, 356),
(467, '00275', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:45:55', 1, 121, 478, 356),
(468, '00276', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:47:02', 1, 121, 478, 356),
(469, '00277', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:47:59', 1, 121, 478, 356),
(470, '00278', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:49:12', 1, 121, 478, 356),
(471, '00279', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:50:05', 1, 121, 478, 356),
(472, '00280', 'sortie', 'sortie', 'jean paul', 3, '2020-03-08', '2020-03-08 19:52:17', 1, 121, 478, 356),
(473, '00281', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:53:01', 1, 121, 478, 356),
(474, '00282', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:53:53', 1, 121, 478, 356),
(475, '00283', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:55:15', 1, 121, 478, 356),
(476, '00284', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:56:30', 1, 121, 478, 356),
(477, '00285', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:57:32', 1, 121, 478, 356),
(478, '00286', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 19:58:24', 1, 121, 478, 356),
(479, '00287', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:00:04', 1, 121, 478, 356),
(480, '00288', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:01:56', 1, 121, 478, 356),
(481, '00289', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:03:28', 1, 121, 478, 356),
(482, '00290', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:05:13', 1, 121, 478, 356),
(483, '00291', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:08:55', 1, 121, 478, 356),
(484, '00292', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:10:06', 1, 121, 478, 356),
(485, '00293', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:11:05', 1, 121, 478, 356),
(486, '00294', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:12:29', 1, 121, 478, 356),
(487, '00295', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:13:35', 1, 121, 478, 356),
(488, '00296', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:14:24', 1, 121, 478, 356),
(489, '00297', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:14:57', 1, 121, 478, 356),
(490, '00298', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:16:20', 1, 121, 478, 356),
(491, '00299', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:17:13', 1, 121, 478, 356),
(492, '00300', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:18:01', 1, 121, 478, 356),
(493, '00193', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 20:20:01', 1, 121, 478, 356),
(494, '00301', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:21:23', 1, 121, 478, 356),
(495, '00302', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:23:28', 1, 121, 478, 356),
(496, '00303', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:24:21', 1, 121, 478, 356),
(497, '00304', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:34:32', 1, 121, 478, 356),
(498, '00305', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:35:45', 1, 121, 478, 356),
(499, '00306', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:37:03', 1, 121, 478, 356),
(500, '00307', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:37:47', 1, 121, 478, 356),
(501, '00308', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:38:44', 1, 121, 478, 356),
(502, '00194', 'appro', 'appro', '', 1, '2020-03-08', '2020-03-08 20:41:16', 1, 121, 478, 356),
(503, '00309', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:43:08', 1, 121, 478, 356),
(504, '00310', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:43:49', 1, 121, 478, 356),
(505, '00311', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:44:34', 1, 121, 478, 356),
(506, '00312', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:45:17', 1, 121, 478, 356),
(507, '00313', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:46:11', 1, 121, 478, 356),
(508, '00314', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:46:56', 1, 121, 478, 356),
(509, '00315', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:47:41', 1, 121, 478, 356),
(510, '00316', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:49:30', 1, 121, 478, 356),
(511, '00317', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:50:20', 1, 121, 478, 356),
(512, '00318', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:51:27', 1, 121, 478, 356),
(513, '00319', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:52:25', 1, 121, 478, 356),
(514, '00320', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:53:33', 1, 121, 478, 356),
(515, '00321', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:54:12', 1, 121, 478, 356),
(516, '00322', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:55:30', 1, 121, 478, 356),
(517, '00323', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:56:16', 1, 121, 478, 356),
(518, '00324', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 20:57:47', 1, 121, 478, 356),
(519, '00325', 'sortie', 'sortie', 'jean paul', 1, '2020-03-08', '2020-03-08 21:00:25', 1, 121, 478, 356),
(520, '00195', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 12:50:35', 1, 121, 478, 356),
(521, '00196', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 17:45:48', 1, 121, 478, 356),
(522, '00326', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 17:47:55', 1, 121, 478, 356),
(523, '00327', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-13', '2020-03-13 17:49:39', 1, 121, 478, 356),
(524, '00197', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 17:50:45', 1, 121, 478, 356),
(525, '00328', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 17:53:41', 1, 121, 478, 356),
(526, '00198', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 17:54:52', 1, 121, 478, 356),
(527, '00199', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 17:56:49', 1, 121, 478, 356),
(528, '00200', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 17:57:15', 1, 121, 478, 356),
(529, '00201', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:00:55', 1, 121, 478, 356),
(530, '00202', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:01:44', 1, 121, 478, 356),
(531, '00203', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:05:35', 1, 121, 478, 356),
(532, '00329', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:07:00', 1, 121, 478, 356),
(533, '00330', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:07:59', 1, 121, 478, 356),
(534, '00204', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:10:05', 1, 121, 478, 356),
(535, '00331', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:11:14', 1, 121, 478, 356),
(536, '00205', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:16:07', 1, 121, 478, 356),
(537, '00332', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:18:34', 1, 121, 478, 356),
(538, '00333', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:19:49', 1, 121, 478, 356),
(539, '00334', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:21:09', 1, 121, 478, 356),
(540, '00335', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:23:17', 1, 121, 478, 356),
(541, '00336', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:25:13', 1, 121, 478, 356),
(542, '00337', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:26:58', 1, 121, 478, 356),
(543, '00206', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:28:21', 1, 121, 478, 356),
(544, '00207', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:44:23', 1, 121, 478, 356),
(545, '00208', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:45:21', 1, 121, 478, 356),
(546, '00209', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:47:19', 1, 121, 478, 356),
(547, '00338', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:49:30', 1, 121, 478, 356),
(548, '00339', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 18:50:28', 1, 121, 478, 356),
(549, '00210', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 18:51:28', 1, 121, 478, 356),
(550, '00340', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-13', '2020-03-13 19:01:36', 1, 121, 478, 356),
(551, '00341', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-13', '2020-03-13 19:02:48', 1, 121, 478, 356),
(552, '00342', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-13', '2020-03-13 19:03:36', 1, 121, 478, 356),
(553, '00343', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 19:06:32', 1, 121, 478, 356),
(554, '00211', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 19:07:48', 1, 121, 478, 356),
(555, '00212', 'appro', 'appro', '', 1, '2020-03-13', '2020-03-13 19:09:12', 1, 121, 478, 356),
(556, '00344', 'sortie', 'sortie', 'jean paul', 1, '2020-03-13', '2020-03-13 19:10:56', 1, 121, 478, 356),
(557, '00213', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:14:27', 1, 121, 478, 356),
(558, '00214', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:15:16', 1, 121, 478, 356),
(559, '00215', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:18:12', 1, 121, 478, 356),
(560, '00216', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:19:38', 1, 121, 478, 356),
(561, '00217', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:22:05', 1, 121, 478, 356),
(562, '00218', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:22:52', 1, 121, 478, 356),
(563, '00219', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:24:02', 1, 121, 478, 356),
(564, '00220', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:30:59', 1, 121, 478, 356),
(565, '00221', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 10:32:23', 1, 121, 478, 356),
(566, '00222', 'appro', 'appro', '', 9, '2020-03-14', '2020-03-14 10:38:46', 1, 121, 478, 356),
(567, '00223', 'appro', 'appro', '', 12, '2020-03-14', '2020-03-14 10:54:06', 1, 121, 478, 356),
(568, '00224', 'appro', 'appro', '', 10, '2020-03-14', '2020-03-14 11:04:24', 1, 121, 478, 356),
(569, '00225', 'appro', 'appro', '', 6, '2020-03-14', '2020-03-14 11:08:32', 1, 121, 478, 356),
(570, '00226', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 11:21:39', 1, 121, 478, 356),
(571, '00227', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 11:22:24', 1, 121, 478, 356),
(572, '00228', 'appro', 'appro', '', 9, '2020-03-14', '2020-03-14 11:26:46', 1, 121, 478, 356),
(573, '00229', 'appro', 'appro', '', 9, '2020-03-14', '2020-03-14 11:33:09', 1, 121, 478, 356);
INSERT INTO `skt_fiche` (`id_fiche`, `numero`, `type`, `motif`, `beneficiere`, `nbrprod`, `dte`, `dte_time`, `approuve`, `depot_id`, `user_id`, `hotel_id`) VALUES
(574, '00230', 'appro', 'appro', '', 6, '2020-03-14', '2020-03-14 11:38:37', 1, 121, 478, 356),
(575, '00345', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-14', '2020-03-14 11:47:14', 1, 121, 478, 356),
(576, '00231', 'appro', 'appro', '', 9, '2020-03-14', '2020-03-14 15:26:23', 1, 121, 478, 356),
(577, '00232', 'appro', 'appro', '', 5, '2020-03-14', '2020-03-14 15:39:34', 1, 121, 478, 356),
(578, '00233', 'appro', 'appro', '', 2, '2020-03-14', '2020-03-14 16:53:52', 1, 121, 478, 356),
(579, '00346', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-14', '2020-03-14 16:57:46', 1, 121, 478, 356),
(580, '00234', 'appro', 'appro', '', 1, '2020-03-14', '2020-03-14 17:00:50', 1, 121, 478, 356),
(581, '00347', 'sortie', 'sortie', 'jean paul-barman gazebo', 1, '2020-03-14', '2020-03-14 18:22:13', 1, 121, 478, 356),
(582, '00235', 'appro', 'appro', '', 1, '2020-03-15', '2020-03-15 09:02:49', 1, 121, 478, 356),
(583, '00236', 'appro', 'appro', '', 1, '2020-03-15', '2020-03-15 09:04:04', 1, 121, 478, 356),
(584, '00348', 'sortie', 'sortie', 'G5', 3, '2020-04-03', '2020-04-03 13:10:27', 1, 121, 471, 356),
(585, '00349', 'sortie', 'sortie', '', 2, '2020-04-16', '2020-04-16 15:39:11', 1, 121, 476, 356),
(586, '00350', 'sortie', 'sortie', '', 5, '2020-04-16', '2020-04-16 15:39:59', 1, 121, 476, 356),
(587, '00237', 'appro', 'appro', '', 10, '2020-05-28', '2020-05-28 14:15:47', 1, 123, 471, 356),
(588, '00351', 'transfert', 'sortie', 'LE GAZEBO', 7, '2020-05-28', '2020-05-28 14:19:06', 0, 121, 471, 356),
(589, '00352', 'sortie', 'sortie', '', 3, '2020-05-28', '2020-05-28 14:39:28', 1, 121, 476, 356),
(590, '00353', 'sortie', 'sortie', '', 5, '2020-05-28', '2020-05-28 14:43:51', 1, 121, 476, 356),
(591, '00354', 'sortie', 'sortie', '', 5, '2020-05-28', '2020-05-28 14:49:48', 1, 121, 476, 356),
(592, '00355', 'sortie', 'sortie', '', 3, '2020-05-28', '2020-05-28 15:03:48', 1, 121, 476, 356),
(593, '00356', 'sortie', 'sortie', '', 7, '2020-05-29', '2020-05-29 13:41:36', 1, 121, 476, 356),
(594, '00357', 'sortie', 'sortie', '', 6, '2020-05-29', '2020-05-29 13:50:45', 1, 121, 476, 356),
(595, '00358', 'sortie', 'sortie', '', 2, '2020-05-29', '2020-05-29 16:04:46', 1, 121, 476, 356),
(596, '00359', 'sortie', 'sortie', '', 2, '2020-06-02', '2020-06-02 12:55:04', 1, 121, 476, 356),
(597, '00360', 'sortie', 'sortie', '', 1, '2020-06-02', '2020-06-02 12:56:21', 1, 121, 476, 356),
(598, '00361', 'sortie', 'sortie', '', 3, '2020-06-02', '2020-06-02 15:27:38', 1, 121, 476, 356),
(599, '00362', 'sortie', 'sortie', '', 0, '2020-06-02', '2020-06-02 15:36:29', 1, 121, 476, 356),
(600, '00363', 'sortie', 'sortie', '', 0, '2020-06-02', '2020-06-02 16:08:05', 1, 121, 476, 356),
(601, '00364', 'sortie', 'sortie', '', 1, '2020-06-02', '2020-06-02 16:08:57', 1, 121, 476, 356),
(602, '00365', 'sortie', 'sortie', '', 0, '2020-06-02', '2020-06-02 16:10:32', 1, 121, 476, 356),
(603, '00366', 'sortie', 'sortie', '', 1, '2020-06-04', '2020-06-04 13:10:52', 1, 121, 476, 356),
(604, '00367', 'sortie', 'sortie', '', 2, '2020-06-04', '2020-06-04 13:30:47', 1, 121, 476, 356),
(605, '00368', 'sortie', 'sortie', '', 0, '2020-06-04', '2020-06-04 13:37:55', 1, 121, 476, 356);

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
  PRIMARY KEY (`id`),
  KEY `compagny_id` (`compagny_id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `souscription`
--

INSERT INTO `souscription` (`id`, `compagny_id`, `libelle`, `date_sous`, `date_activ`, `dte_echeance`, `dte_blocage`, `dte_upgrade`, `mode_paie`, `montant_tot_sous`, `statut`, `etat`, `type_souscription`, `generer`, `site_id`, `user_id`, `pseudo_suppr`) VALUES
(199, 299, 'SCT57071628', '2019-12-11', '2020-01-18', '2020-02-18', '2020-02-25', '2019-12-11', '', 0, 'demo', 1, 'mensuel', 0, 356, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stkcodes`
--

DROP TABLE IF EXISTS `stkcodes`;
CREATE TABLE IF NOT EXISTS `stkcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(245) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stkcodes`
--

INSERT INTO `stkcodes` (`id`, `libelle`, `site_id`) VALUES
(2, 'ddd', 328),
(3, 'z345', 328),
(4, 'xx23', 328),
(5, ',jojo', 328),
(6, 'ccc', 328);

-- --------------------------------------------------------

--
-- Structure de la table `stk_famille`
--

DROP TABLE IF EXISTS `stk_famille`;
CREATE TABLE IF NOT EXISTS `stk_famille` (
  `idfamille` int(10) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `plat` int(11) DEFAULT '0',
  `affichage` int(10) NOT NULL,
  `fiche_tech` int(11) DEFAULT '0',
  `pseudo_supp` int(11) DEFAULT '0',
  `hotel_id` int(10) NOT NULL,
  PRIMARY KEY (`idfamille`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_famille`
--

INSERT INTO `stk_famille` (`idfamille`, `designation`, `plat`, `affichage`, `fiche_tech`, `pseudo_supp`, `hotel_id`) VALUES
(2, 'Les planchas', 0, 1, 0, 0, 356),
(4, 'EAUX', 0, 1, 0, 0, 356),
(5, 'JUS', 0, 1, 0, 0, 356),
(6, 'BIERRES', 0, 1, 0, 0, 356),
(7, 'BOISSONS CHAUDES', 0, 0, 0, 0, 356),
(8, 'APEROS', 0, 1, 0, 0, 356),
(9, 'COKTAILS', 0, 1, 0, 0, 356),
(10, 'DIGESTIFS', 0, 1, 0, 0, 356),
(11, 'BOUTEILLES', 0, 1, 0, 0, 356),
(12, 'VINS', 0, 1, 0, 0, 356),
(13, 'FIN DE CAVE', 0, 1, 0, 0, 356),
(15, 'ALCOOL', 0, 1, 0, 0, 356),
(16, 'SOFTS', 0, 1, 0, 0, 356),
(17, 'Matiere premiere', 0, 0, 1, 0, 356),
(18, 'PLATS', 1, 1, 0, 0, 356),
(19, 'XXXX', 1, 1, 0, 1, 356),
(20, 'lfjwoef', 1, 1, 0, 1, 356),
(21, 'CIGARETTE', 0, 1, 0, 0, 356),
(22, 'IMMO', 0, 0, 0, 0, 356);

-- --------------------------------------------------------

--
-- Structure de la table `stk_produit`
--

DROP TABLE IF EXISTS `stk_produit`;
CREATE TABLE IF NOT EXISTS `stk_produit` (
  `idprod` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
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
  `pop` int(11) DEFAULT '0',
  `hotel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idprod`),
  KEY `famille_id` (`famille_id`,`hotel_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `code_id` (`code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=558 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_produit`
--

INSERT INTO `stk_produit` (`idprod`, `code`, `designation`, `path_image`, `qte_min`, `qte_initial`, `qte_dispo`, `pa`, `pv`, `tva`, `monnaie`, `repas`, `statut`, `pseudo_supp`, `unite`, `ingredient`, `famille_id`, `image`, `code_id`, `nourriture`, `accomp`, `softplt`, `softbtl`, `legume`, `cuisso`, `soce`, `cond`, `pop`, `hotel_id`) VALUES
(4, 'P003', 'Coca-cola', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(6, 'P001', 'Coca-cola plastic', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(7, 'P002', 'Coca-cola light', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(8, 'P004', 'Fanta', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(9, 'P005', 'Sprite', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(10, 'P006', 'Vitalo petit plastique', NULL, 3, 0, 0, 1.80, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(11, 'P007', 'Maltina', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(12, 'P008', 'Tonic', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(13, 'P009', 'Djino petit grenadine plastic', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(14, 'P010', 'Djino grenadine gr', NULL, 3, 0, 0, 2.70, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(15, 'P011', 'Grand vitalo', NULL, 3, 0, 0, 2.70, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(16, 'P012', 'XXL', NULL, 3, 0, 0, 2.70, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(17, 'P013', 'RED BULL', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(18, 'P0014', 'Eau minerale 50cl', NULL, 3, 0, 0, 1.80, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 12, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(19, 'P0015', 'Eau minerale maxi 1,5L', NULL, 3, 0, 0, 2.80, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 12, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(20, 'P0016', 'Soda (eau petillante)', NULL, 3, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 12, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(21, 'P0017', 'Perier', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 12, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(22, 'P0018', 'Verre de jus dâ€™orange', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(23, 'P0019', 'Verre de jus dâ€™ananas', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(24, 'P0020', 'Verre de jus des pommes', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(25, 'P0021', 'Verre de jus multi fruits', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(26, 'P0022', 'Cocktail de jus', NULL, 3, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(27, 'P0023', 'Le litre de jus', NULL, 3, 0, 0, 12.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(28, 'P0024', 'Heineken', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(29, 'P0025', 'Leffe blonde', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(30, 'P0026', 'Grand Turbo King', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(31, 'P0027', 'Grand Primus', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(32, 'P0028', 'Grand Tembo', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(33, 'P0029', 'Grand Skol', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(34, 'P0030', 'Grand Simba', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(35, 'P0031', 'Grand Nkoyi', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(36, 'P0032', 'Grand Castel', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(37, 'P0033', 'Grand Doppel', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(38, 'P0034', 'Petite Nkoyi', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(39, 'P0035', 'Beaufort Petite', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(40, 'P0036', 'Petite Legende', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(41, 'P0037', 'Petite Mutzig', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(42, 'P0038', 'Petite Tembo', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(43, 'P0039', 'Petite Turbo King', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(44, 'P0040', 'Skol Slim', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(45, 'P0041', 'Primus petite ya quartier', NULL, 3, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(46, 'P0042', 'Cafe', NULL, 3, 0, 0, 4.00, 0.00, '0.0000000000', 'USD', 3, 0, 0, 'piece', 0, 15, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(47, 'P0043', 'Nespresso', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 3, 0, 0, 'piece', 0, 15, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(48, 'P0044', 'The', NULL, 0, 0, 0, 4.00, 0.00, '0.0000000000', 'USD', 3, 0, 0, 'piece', 0, 15, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(49, 'P0045', 'Campari (M)', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(50, 'P0046', 'Campari Orange(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(51, 'P0047', 'Martini blanc(M)', NULL, 3, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(52, 'P0048', 'Martini rouge(M)', NULL, 3, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(53, 'P0049', 'Pastis Ricard(M)', NULL, 3, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(54, 'P0050', 'Porto Ruby rouge (M)', NULL, 3, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(55, 'P0051', 'Cocktail maison', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 17, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(56, 'P0052', 'Margaritta', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 17, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(57, 'P0053', 'Kinshasa coconut', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 17, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(58, 'P0055', 'Gin Gordon', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(59, 'P0056', 'J&B (M)', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(60, 'P0057', 'Johnny Walker Red', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(61, 'P0058', 'Vodka Smirnof (M)', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(62, 'P0059', 'Captain Morgan(M)', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(63, 'P0054', 'Limongello(M)', NULL, 3, 0, 0, 6.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(64, 'P0060', 'Vodka Absolut(M)', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(65, 'P0061', 'Chivas(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(66, 'P0062', 'Jack Daniel s(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(67, 'P0063', 'Johnny Walker Black(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(68, 'P0064', 'Calvados(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(69, 'P0065', 'Calvados boulard(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(70, 'P0066', 'Jack Daniel Borrel (M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(71, 'P0067', 'Double Block (M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(72, 'P0068', 'Amarula(M)', NULL, 3, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(73, 'P0069', 'Grand marnier(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(74, 'P0070', 'Calvados digestif(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(75, 'P0071', 'Cognac Camus (M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(76, 'P0072', 'Cognac Hennessy(M)', NULL, 3, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(77, 'P0073', 'Cointreau  (M)', NULL, 3, 0, 0, 6.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(78, 'P0074', 'Limongello digestif(M)', NULL, 3, 0, 0, 6.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(79, 'P0075', 'Tequila Olmeca(M)', NULL, 3, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(80, 'P0076', 'Blue label(M)', NULL, 3, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(81, 'P0077', 'Amarula Bouteilles', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(82, 'P0078', 'Captain Morgan Bouteilles', NULL, 3, 0, 0, 40.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(83, 'P0079', 'Bacardi Bouteilles', NULL, 3, 0, 0, 50.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(84, 'P0080', 'J&B Bouteilles', NULL, 3, 0, 0, 50.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(85, 'P0081', 'Johnny Walker Red - 75 cl Bouteilles', NULL, 3, 0, 0, 50.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(86, 'P0082', 'Calvados Bouteilles', NULL, 3, 0, 0, 80.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(87, 'P0083', 'Jack Danielâ€™s Bouteilles', NULL, 3, 0, 0, 125.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(88, 'P0085', 'Jack Danielâ€™s Barrel Bouteilles', NULL, 3, 0, 0, 100.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(89, 'P0086', 'Chivas Regal Bouteilles', NULL, 3, 0, 0, 95.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(90, 'P0087', 'Johnny Walker Black â€“ 75cl  Bouteilles', NULL, 3, 0, 0, 100.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(91, 'P0088', 'Cognac Camus Bouteilles', NULL, 3, 0, 0, 120.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(92, 'P0089', 'Cognac Hennessy Bouteilles', NULL, 3, 0, 0, 130.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(93, 'P0090', 'Double Black Bouteilles', NULL, 3, 0, 0, 120.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(94, 'P0091', 'Smirnof Bouteilles', NULL, 3, 0, 0, 55.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(95, 'P0092', 'Absolut Bouteilles', NULL, 3, 0, 0, 55.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(96, 'P0093', 'Tequila Olmeca  Bouteilles', NULL, 3, 0, 0, 60.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(97, 'P0094', 'Porto Ruby Bouteilles', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(98, 'P0095', 'Cointreau Bouteilles', NULL, 3, 0, 0, 70.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(99, 'P0096', 'Grand Marnier Bouteilles', NULL, 3, 0, 0, 90.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(100, 'P0097', 'Martini Rouge Bouteilles', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(101, 'P0098', 'Martini Rouge Bouteilles', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(102, 'P0099', 'Martini Rose Bouteilles', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(103, 'P00100', 'Gin Gordon s Bouteilles', NULL, 3, 0, 0, 55.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(104, 'P00101', 'Campari Bouteilles', NULL, 3, 0, 0, 60.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(105, 'P00102', 'Chardonnay Baron Philippe de Rotchild', NULL, 3, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(106, 'P00103', 'Mouton Cadet blanc', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(107, 'P00104', 'Chemin de Pape', NULL, 3, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(108, 'P00105', 'Nederburg', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(109, 'P00106', 'Rijks', NULL, 3, 0, 0, 60.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(110, 'P00107', 'Mateus Rose - Portugal', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 7, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(111, 'P00108', 'Famille Castel Cote de Provence', NULL, 3, 0, 0, 40.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 7, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(112, 'P00109', 'Famille Castel- Pays d Oc â€“ Merlot - 2012', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 8, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(113, 'P00110', 'Famille Castel Pays dâ€™Oc - Cabernet Sauv 2012', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 8, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(114, 'P00111', 'Famille Castel Merlot', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 8, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(115, 'P00112', 'CÃ´tes de RhÃ´ne â€“ Combe St Sauveur (Famille Cas', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 8, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(116, 'P00113', 'Mouton Cadet rouge', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 8, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(117, 'P00114', 'Steenberg', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(118, 'P00115', 'Meerlust rubicom', NULL, 3, 0, 0, 75.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(119, 'P00116', 'Hamilton Russel pinot noire', NULL, 3, 0, 0, 55.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(120, 'P00117', 'Babylonstoren', NULL, 3, 0, 0, 50.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(121, 'P00118', 'Anthony Ruppert Rotchild', NULL, 3, 0, 0, 40.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(122, 'P00119', 'Anthony Ruppert Syrah', NULL, 3, 0, 0, 90.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(123, 'P00120', 'Anthony Ruppert Optima', NULL, 3, 0, 0, 40.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(124, 'P00121', 'Kadette', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(125, 'P00122', 'Graff', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 9, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(126, 'P00123', 'Verre Obikwa blanc chardonnay', NULL, 3, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(127, 'P00124', 'demi-pichet Obikwa blanc chardonnay', NULL, 3, 0, 0, 17.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(128, 'P00125', 'Obikwa blanc chardonnay', NULL, 3, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(129, 'P00126', 'Quart-pichet Obikwa blanc chardonnay', NULL, 3, 0, 0, 12.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(130, 'P00127', 'Beyerskloof  Pinotage', NULL, 3, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(131, 'P00128', 'Beyerskloof synergie', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(132, 'P00129', 'Creative', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(133, 'P00131', 'Rijks Pinotage', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(134, 'P00132', 'Rust in vrede', NULL, 3, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(135, 'P00133', 'Verre de Champagne Maison', NULL, 3, 0, 0, 15.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 22, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(136, 'P00134', 'Bouteille Champagne Maison', NULL, 3, 0, 0, 70.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(137, 'P00135', 'Vrancken Â½ sec', NULL, 3, 0, 0, 100.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(138, 'P00136', 'Laurent Perrier', NULL, 3, 0, 0, 120.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(139, 'P00137', 'MoÃ«t & chandon', NULL, 3, 0, 0, 130.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(140, 'P00138', 'MoÃ«t Ice', NULL, 3, 0, 0, 170.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(141, 'M0001', 'Ail filet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Filet', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(142, 'M0002', 'Alcool Ã  brulÃ©e', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(143, 'M0003', 'Allumettes', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(144, 'M0004', 'Aluminium', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(145, 'M0005', 'Ananas', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(146, 'M0006', 'Arachides', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(147, 'M0007', 'Assiette emportÃ©e', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(148, 'M0008', 'Aubergines', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(149, 'M0009', 'Basilique', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(150, 'M00010', 'Beurre', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(151, 'M00011', 'Beurre portion', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(152, 'M00012', 'Bicarbonade', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(153, 'M00013', 'Biteku L', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(154, 'M00014', 'Carolin', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(155, 'M00015', 'Carottes bottes', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(156, 'M00016', 'Champignon', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(157, 'M00017', 'Champignon frais', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(158, 'M00018', 'Chantilly', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(159, 'M00019', 'Chapeaux de cuisine', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(160, 'M00020', 'Chikwange', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 24, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(161, 'M00021', 'Chocolat', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(162, 'M00022', 'Choux', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(163, 'M00023', 'Choux rouge', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(164, 'M00024', 'Ciboulette', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(165, 'M00025', 'Citron', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(166, 'M00026', 'Cochon', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(167, 'M00027', 'Concombre', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(168, 'M00028', 'Confiture', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(169, 'M00029', 'Cossa cossa', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(170, 'M00030', 'CÃ´te  Ã  l\'os', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(171, 'M00031', 'Cotton', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(172, 'M00032', 'CrÃ¨me fraiche', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(173, 'M00033', 'Cube poisson', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(174, 'M00034', 'Cube Pondu', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(175, 'M00035', 'Cube poulet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(176, 'M00036', 'Cube viande', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(177, 'M00037', 'Cuisse de poulet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(178, 'M00038', 'Cure dent', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(179, 'M00039', 'Curry', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(180, 'M00040', 'Decaps four', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(181, 'M00041', 'DÃ©sodorisante', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(182, 'M00042', 'Epice BBQ', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(183, 'M00043', 'Epice poison', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(184, 'M00044', 'Epice poulet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(185, 'M00045', 'Epinards', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(186, 'M00046', 'Esprit de sel', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(187, 'M00047', 'Essuie tout paquet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(188, 'M00048', 'Farine ekolo', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Ekolo', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(189, 'M00049', 'Feuille samosa', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(190, 'M00050', 'Filet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(191, 'M00051', 'Filet de bÅ“uf', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(192, 'M00052', 'Filet de capitain', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(193, 'M00053', 'Filet topside', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(194, 'M00054', 'Frites', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(195, 'M00055', 'Fromage de Goma', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(196, 'M00056', 'Fufu', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Ekolo', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(197, 'M00057', 'Fumbwa nature', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(198, 'M00058', 'Gant de cuisine', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(199, 'M00059', 'Gaz bouteille', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(200, 'M00060', 'Glace Ã  la vanille', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(201, 'M00061', 'Gourgette', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(202, 'M00062', 'HachÃ©e', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(203, 'M00063', 'Huile Bidon', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(204, 'M00064', 'Huile de palme L', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(205, 'M00065', 'Huile d\'olive', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(206, 'M00066', 'Insecticide', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(207, 'M00067', 'Jambon', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(208, 'M00068', 'Javel', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(209, 'M00069', 'Jex paquet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'l', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(210, 'M00070', 'Ketchup', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(211, 'M00071', 'Lait liquide', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(212, 'M00072', 'Lard fumÃ©', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(213, 'M00073', 'Laurier', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(214, 'M00074', 'Levure chimique', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(215, 'M00075', 'Liboke', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(216, 'M00076', 'Macaroni', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(217, 'M00077', 'Macedoine', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(218, 'M00078', 'Madesous', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(219, 'M00079', 'Mais popcorn', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(220, 'M00080', 'Maizena blanc', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(221, 'M00081', 'Maizena brun', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(222, 'M00082', 'Makala', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(223, 'M00083', 'Makayabu', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(224, 'M00084', 'Makemba main', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(225, 'M00085', 'Malangwa', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(226, 'M00086', 'Mangue', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(227, 'M00087', 'Mayonnaise', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(228, 'M00088', 'Mergueze', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(229, 'M00089', 'Nettoyage cuir', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(230, 'M00090', 'Menthe', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(231, 'M00091', 'Miel', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(232, 'M00092', 'Moutarde', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(233, 'M00093', 'Muscade', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(234, 'M00094', 'Ndakala', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(235, 'M00095', 'NescafÃ©', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(236, 'M00096', 'Nespresso', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(237, 'M00097', 'Ngai ngai', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(238, 'M00098', 'Nzombo', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(239, 'M00099', 'Å’ufs', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(240, 'M000100', 'Ognion filet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(241, 'M000101', 'Olive noir', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(242, 'M000102', 'Olive vert', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(243, 'M000103', 'Paille', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(244, 'M000104', 'Pain baguette', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(245, 'M000105', 'Pain shawrma', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(246, 'M000106', 'Papaye', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(247, 'M000107', 'Papier de cuisson', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(248, 'M000108', 'Papier film', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(249, 'M000109', 'Pasteque', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(250, 'M000110', 'PÃ¢tes arachides', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(251, 'M000111', 'PÃ¨rche', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(252, 'M000112', 'Persil', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(253, 'M000113', 'Petit ognion', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(254, 'M000114', 'PH', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(255, 'M000115', 'Pili pili', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(256, 'M000116', 'Poivre blanc', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(257, 'M000117', 'Poivre vert', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(258, 'M000118', 'Poivron Tas', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(259, 'M000119', 'Pommes de terre', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(260, 'M000120', 'Pondu', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(261, 'M000121', 'Poudre Ã  l\'essive', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(262, 'M000122', 'Poulet', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(263, 'M000123', 'Riz', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(264, 'M000124', 'Riz personelle', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(265, 'M000125', 'Sac congÃ¨lateur', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(266, 'M000126', 'Sac poubelle', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(267, 'M000127', 'Salade', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(268, 'M000128', 'Saucisse Fraiche', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(269, 'M000129', 'Savon Ã  main', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 49, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(270, 'M000130', 'Savon genie', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 49, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(271, 'M000131', 'Savon vaiselle', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 49, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(272, 'M000132', 'Sel', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(273, 'M000133', 'Semoule', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(274, 'M000134', 'Serviette', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(275, 'M000135', 'Spaghetti', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(276, 'M000136', 'Sucre', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(277, 'M000137', 'Sucre palpable', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(278, 'M000138', 'Sucre perlÃ©', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(279, 'M000139', 'Sucre vanille', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(280, 'M000140', 'The lebest', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(281, 'M000141', 'Tige brochette', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(282, 'M000142', 'Tomate fraiche', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(283, 'M000143', 'Tomate pelÃ©e', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(284, 'M000144', 'Tomate purÃ©e', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(285, 'M000145', 'Ventouse', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(286, 'M000146', 'Vim', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(287, 'M000147', 'Vinaigre blanc', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(288, 'PL001', 'Plancha poulet du chef', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(289, 'PL002', 'La plancha familiale', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 41, NULL, NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1, 356),
(290, 'PL003', 'Burger club', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 41, NULL, NULL, 1, 0, 1, 0, 0, 0, 0, 0, 1, 356),
(291, 'PL004', 'Plancha cochon', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 41, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(292, 'PL005', 'Plancha de boeuf (4 personnes)', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 41, NULL, NULL, 1, 1, 0, 1, 1, 1, 0, 0, 1, 356),
(293, 'PL006', 'Kids club hamburger', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 41, NULL, NULL, 1, 1, 1, 0, 0, 0, 0, 0, 1, 356),
(294, 'PL007', 'Potage', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(295, 'PL008', 'Salade Cruditees', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(296, 'PL009', 'Cossa Ã  lâ€™ail ou ail pili', NULL, 0, 0, 0, 24.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'piece', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(297, 'PL010', 'Liboke mpoka', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 37, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(298, 'PL011', 'Fumbwa Nzombo', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 37, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(299, 'PL012', 'Fumbwa au poulet', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 37, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(300, 'PL013', 'Filet de boeuf', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 36, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 1, 356),
(301, 'PL014', 'Makayabu', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 35, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(302, 'PL015', 'Poisson a la Congolaise', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 35, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(303, 'PL016', 'Filet de capitaine', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 35, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(304, 'PL017', 'Cossa a l ail', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 35, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(306, 'PL019', 'Poulet grille entier', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 34, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(307, 'PL020', 'Poulet du chef', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 34, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(308, 'PL021', 'Ã‚Â¼ Poulet grille aux arachides', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 34, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(309, 'PL022', 'Hamburger', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(310, 'PL023', 'Cheeseburger', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(311, 'PL024', 'Bacon burger', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(312, 'PL025', 'Double burger', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(313, 'PL026', 'Hamburger Gazebo', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 33, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(314, 'PL027', 'Chikwange', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'piece', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(315, 'PL028', 'Fufu', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(316, 'PL029', 'Riz', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(317, 'PL030', 'Makemba', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(318, 'PL031', 'Frites', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(319, 'PL032', 'Pommes nature', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(321, 'PL034', 'Pondu', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 31, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(322, 'PL035', 'Bitekuteku', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 31, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(323, 'PL036', 'Epinards', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 31, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(324, 'PL037', 'Ngai-ngai', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 31, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(325, 'PL038', 'Sauce champignon', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 30, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(326, 'PL039', 'Ratatouille', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 30, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(327, 'PL040', 'Poivre vert', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 30, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(328, 'PL041', 'Pizza Hawai enfant', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(329, 'PL042', 'Pizza Hawai adulte', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(330, 'PL043', 'Pizza Margarita enfant', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(331, 'PL044', 'Pizza Margarita adulte', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(332, 'PL045', 'Pizza Bolognaise enfant', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(333, 'PL046', 'Pizza Bolognaise adulte', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356);
INSERT INTO `stk_produit` (`idprod`, `code`, `designation`, `path_image`, `qte_min`, `qte_initial`, `qte_dispo`, `pa`, `pv`, `tva`, `monnaie`, `repas`, `statut`, `pseudo_supp`, `unite`, `ingredient`, `famille_id`, `image`, `code_id`, `nourriture`, `accomp`, `softplt`, `softbtl`, `legume`, `cuisso`, `soce`, `cond`, `pop`, `hotel_id`) VALUES
(334, 'PL047', 'Potage du jour', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 28, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(335, 'PL048', 'Samossas 6 pieces', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 28, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(336, 'PL049', 'Samossas 8 pieces', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 28, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(337, 'PL050', 'Baguette fromage', NULL, 0, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(338, 'PL051', 'Baguette jambon', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(339, 'PL052', 'Baguette mixte', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(340, 'PL053', 'Portion olive', NULL, 0, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'piece', 0, 16, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(341, 'PL054', 'DÃ©s de fromage de Goma', NULL, 0, 0, 0, 6.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'piece', 0, 16, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(342, 'PL055', 'Portion olive et fromage de Goma', NULL, 0, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'piece', 0, 16, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(343, 'PL056', 'Salade de fruit', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 25, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(344, 'PL057', 'Glace vanille', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 25, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(345, 'PL058', 'Dame blanche', NULL, 0, 0, 0, 12.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 25, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(346, 'PL059', 'Gaufre de chantilly', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 25, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(347, 'PL060', 'Sauce chocolat', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'piece', 0, 25, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(353, 'as', 'axd', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'unite', 0, 39, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(354, 'asxc', 'aax', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'unite', 0, 39, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(355, 'PLT220', 'Salade Gazebo', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(356, 'PLT221', 'Salade au thon', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(357, 'PLT222', 'Cossa a l Ail', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(358, 'PLT223', 'Ndakala', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 37, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(359, 'PLT224', 'Brochette de baeuf', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 36, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 1, 356),
(360, 'PLT225', 'Saucisse', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 36, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 1, 356),
(361, 'PLT226', 'Cote de porc', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 36, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 1, 356),
(362, 'PLT227', 'Jeune capitaine', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 35, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(363, 'PLT228', 'Dorade grille', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 35, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(364, 'PCAC0012', 'Plancha de chevre', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(366, 'a1', 'aaaa', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'unite', 0, 16, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(367, 'PLMIXT001', 'PLANCHA MIXTE GRILL', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 1, 0, 0, 0, 1, 0, 0, 1, 356),
(368, 'PSPGZ001', 'PLANCHA SPEAR RIB', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(369, 'PLPGZ001', 'PLANCHA DE POISSON', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(370, 'SP002', 'Softs en plastique', NULL, 3, 0, 0, 1.80, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(371, 'J004', 'Le verre de jus dâ€™orange, ananas, pommes, multi ', NULL, 3, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'Verre', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(372, 'GZB00123', 'Legume', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Portion', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(373, 'GZB055', 'Martini Blanc Bouteille', NULL, 3, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(375, 'GZEB001', 'Poulet Grille entier', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(376, 'GZB00123rt', 'Spear rib', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(377, 'GZB00123dfg', 'pommes en chemise', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(378, 'GZB00123dfga', 'beurre a l ail', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(379, 'fwfwfe', 'zzss', NULL, 1, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(380, 'GZB01245E', 'Pizza Gazebo Enfant', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(381, 'GZBPZ01', 'Pizza Gazebo Adult', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 29, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(382, 'MNT009Bgz', 'Liboke ngolo', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 37, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(383, 'GZBLBK0100', 'Liboke Mboto', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 37, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(384, 'GZBLK001', 'Liboke Ngulu massa', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 37, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(385, 'L&C0094gza', 'Haricots verts', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 31, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(386, 'xcw', 'Pommes sautee', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Portion', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(387, 'e01x', 'Energie malt', NULL, 5, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(388, 'vnkgzb01', 'Vranken  Â½ sec', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'Mesurette', 0, 22, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(389, 'Sftp', 'Softs en plastique', NULL, 3, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(390, '12gzb', 'Mateus Rose - Portugal', NULL, 2, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 7, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(391, 'PLT222B', 'Cossa a l Ail  pili', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(392, 'PL017B', 'Cossa a l ail pili', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 35, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(393, 'BGFRGZB01', 'Baguette Fromage', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 27, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(394, 'PROL01', 'Portion Olive', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 42, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(395, 'FMGGZB01', 'Des de Fromage de goma', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 42, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(396, 'MIxApe01', 'Portion olive et Fromage de Goma', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 42, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(397, 'BSCF01', 'Cafe', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 3, 0, 0, 'unite', 0, 43, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(398, 'BSCTH01', 'The', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 3, 0, 0, 'unite', 0, 43, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(399, 'BSCNesp', 'Nespresso', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 43, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(400, 'psa87', 'Pomme sautee', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(401, 'JAGSTER001', 'Jeagermeister (M)', NULL, 2, 0, 0, 6.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(402, 'BTLJEAGR001', 'Jeagermeister', NULL, 2, 0, 0, 68.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(403, 'JCBGZB001', 'JC BOURGOIS', NULL, 2, 0, 0, 70.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(404, 'vrjppygz001', 'Verre de jus de papaye', NULL, 2, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Verre', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(405, 'KWGZV002', 'Kwilu (M)', NULL, 2, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(406, 'BTKWL001', 'Kwilu', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(407, 'LGD001', 'Legend', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(408, 'LBGZB001', 'Leffe brune', NULL, 2, 0, 0, 3.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(409, 'LMGLGZB01', 'LIMONGELLO', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(410, 'MLBGZB001', 'MALIBU', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(411, 'MALGZBAL001', 'MALIBU', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(412, 'mrtrose01', 'Martini rose', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 7, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(413, 'MRLGZB001', 'MERLOT', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(414, 'mtz001gzb', 'Mutzig class', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(415, 'BTLGZB010', 'Ned rose', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(416, 'obikw001', 'Obikwa blanc chardonnay', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(417, 'obikw002', 'Obikwa chenin blanc', NULL, 2, 0, 0, 20.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(418, 'obikw003', 'Obikwa rouge', NULL, 2, 0, 0, 20.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(419, 'osvbl001', 'Obikwa sauvignon blanc', NULL, 2, 0, 0, 20.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(420, 'OBKCBL001', 'Obikwa chenin blanc', NULL, 2, 0, 0, 20.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(421, 'XOB001', 'demi-pichet Obikwa chenin blanc', NULL, 2, 0, 0, 20.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(422, 'xvokcb01', 'Verre Obikwa chenin blanc', NULL, 2, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(423, 'OKW001', 'Quart-pichet obikwa chemin blanc', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(424, 'obkrg001', 'Obikwa rouge', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(425, 'vobkrge001', 'verre obikwa rouge', NULL, 2, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(426, 'dpketok001', 'demi-pichet Obikwa rouge', NULL, 2, 0, 0, 17.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(427, 'qpctobrg001', 'Quart-pichet Obikwa rouge', NULL, 2, 0, 0, 12.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(428, 'obksv001z', 'Obikwa sauvignon blanc', NULL, 2, 0, 0, 20.00, 0.00, '0.0000000000', 'USD', 0, 0, 1, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(429, 'vrokgz002', 'verre Obikwa sauvignon blanc', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(430, 'decsvblc001', 'demi-pichet Obikwa sauvignon blanc', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(431, 'quartsvblc001', 'quart de pichet Obikwa sauvignon blanc', NULL, 2, 0, 0, 12.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 10, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(432, 'djpans001', 'Djino petit ananas plastic', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(433, 'djnptor001', 'Djino petit orange plastic', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(434, 'djgrandg01', 'Djino Grand grenadine plastic', NULL, 2, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(435, 'DHCU01', 'Djino grand ananas plastic', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(436, 'n01z', 'Nutella', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(437, 'hts02', 'Djino Grand orange plastic', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(438, 'sem02', 'Sachet emporte', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(439, 'vtp001', 'Vitalo petit', NULL, 2, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(440, 'sp078', 'Sucre en portion', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(441, 'vtgr001', 'Vitalo Grand plastique', NULL, 2, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(442, 'pastric001', 'Pastis Ricard', NULL, 2, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(443, 'tr01', 'Torchon', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(444, 'PIN001', 'Pina colada', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(445, 'PINAAP001', 'Pina colada', NULL, 2, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 16, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(446, 'rdlb01', 'Red label', NULL, 2, 0, 0, 130.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(447, 'RDdbl01', 'Red label (M)', NULL, 2, 0, 0, 8.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(448, '0012cts', 'Cotes de rhoce St Sauveur', NULL, 2, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(449, 'srop0120', 'Sirop de cassis', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(450, 'sircitron012', 'Sirop de citron', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(451, 'sirdgrena012', 'Sirop de grenadine', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(452, 'srpmeth01', 'Sirop de menthe', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(453, 'tbscgzb01', 'Tabasco', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(454, 'Agav001', 'Agavita', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(455, 'Agav001b', 'Agavita (M)', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(456, 'tflgzb012', 'Toffoli', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(457, 'VDK0012', 'Vodka absolut', NULL, 2, 0, 0, 55.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(458, 'vdksmft12', 'Vodka smirnoff', NULL, 2, 0, 0, 55.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(459, 'lb023', 'Leure boulanger', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(460, 'mp02', 'Mpiodi', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Carton', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(461, 'mpp23', 'Mpiodi personnelle', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(462, 'vic0123', 'Victoire Petit', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(463, 'blt02', 'Bleu toilet', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(464, 'des089', 'Desodorisante', NULL, 1, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(465, 'msbacar012', 'Bacardi (M)', NULL, 2, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(466, 'baile012', 'Baileys', NULL, 2, 0, 0, 53.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(467, 'Bys012', 'baileys (M)', NULL, 2, 0, 0, 7.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(468, 'bv0012', 'Bavaria', NULL, 2, 0, 0, 3.50, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(469, 'bvp012', 'Bavaria pommes', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(470, 'BFG012', 'Beaufort Grand', NULL, 2, 0, 0, 5.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(471, 'brn012', 'Berneroy', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(472, 'bk012', 'Black label', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(473, 'BKM012', 'Black label (M)', NULL, 20, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(474, 'BL012', 'Bleu label', NULL, 2, 0, 0, 300.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(475, 'BL0125', 'Bleu label (M)', NULL, 2, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(476, 'CBSV012', 'Cabarnet sauvignon', NULL, 2, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(477, 'cnc012', 'Coniack camus', NULL, 2, 0, 0, 120.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(478, 'DGCNK012', 'Coniack camus (M)', NULL, 2, 0, 0, 10.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 19, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(479, 'cczgz012', 'Coca-cola canette zero', NULL, 2, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(480, 'tpgzb012', 'Top cola', NULL, 2, 0, 0, 2.20, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(481, 'ctvr012', 'coteprovence vin rose', NULL, 2, 0, 0, 40.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(482, 'dbk012', 'Dubble black', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(483, 'dbcmz012', 'Dubble black (M)', NULL, 2, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 18, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(484, 'FFPP', 'Fanta plastic', NULL, 3, 0, 0, 2.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(485, 'slmx123', 'Salade mixte', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 38, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(486, 'bgtf012', 'Baguette fromage', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 44, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(487, 'gbz0125', 'Baguette au jambo', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 44, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(488, 'Bgmx012', 'Baguette mixte', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 44, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(489, 'sctgzb012', 'Sauce chocolat', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 25, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(490, 'LJJJ', '1 Litre de jus', NULL, 3, 0, 0, 4.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(491, 'EMP', 'EMPORTE', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 29, NULL, NULL, 2, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(492, 'B15', 'BUFFET 15', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(493, 'B20', 'BUFFET 20', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(494, 'B25', 'BUFFET 25', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(495, 'B30', 'BUFFET 30', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(496, 'B35', 'BUFFET 35', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(497, 'BPJ', 'BUFFET PETIT DEJEUNER', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(498, 'BC', 'Croissant', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 45, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(499, 'Cam', 'Ambassade', NULL, 0, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 46, NULL, NULL, 2, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(500, 'Mr', 'Marlboro rouge', NULL, 2, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 46, NULL, NULL, 2, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(501, 'Mb', 'Marlboro blanc', NULL, 3, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 46, NULL, NULL, 2, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(502, 'Db', 'Dunhill bleu', NULL, 3, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 46, NULL, NULL, 2, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(503, 'Ds', 'Dunhill simple', NULL, 3, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 46, NULL, NULL, 2, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(504, 'Cml', 'Camel', NULL, 2, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 46, NULL, NULL, 2, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(505, 'Sb', 'Super bock', NULL, 3, 0, 0, 1.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(506, 'ACC', 'Chikwange', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 32, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(507, 'pgr', '1/4 Poulet grille', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(508, 'PEG', 'Poulet grille entier aux arachides', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 34, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(509, 'PGA', 'Â½ Poulet Grille aux arachides', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 1, 'unite', 0, 34, NULL, NULL, 1, 1, 0, 0, 0, 0, 0, 0, 1, 356),
(510, 'SWP', 'Shawarma poulet', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 28, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(511, 'SWV', 'Shawarma viande', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 28, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(513, 'pl513', 'Kids club  Â¼  poulet', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 41, NULL, NULL, 1, 1, 1, 0, 0, 0, 0, 0, 1, 356),
(514, 'btvrms', 'Bouteille de vin rouge maison', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(515, 'cc012', 'Coca zero', NULL, 2.2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(516, 'spgns', 'Spaghetti bolognaise', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 48, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(517, 'SJP01', 'BOULARD', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(518, 'SJP02', 'thon', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(519, 'SJP03', 'GLACON', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(520, 'sldn', 'Salade lardon', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(521, 'sg01', 'Grand tilapia', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(522, 'sg02', 'Dessert de femme', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(523, 'SJP04', 'FEUILLE DE MENTHE', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(524, 'SJP05', 'TILAPIA', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Carton', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(525, 'sg03', 'Kir royal', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(526, 'sg05', 'Kir de vin blanc', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(527, 'SJP06', 'ALIMENT VOLAILLE', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(528, 'SJP07', 'ORANGE FRUIT', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(529, 'SJP08', 'Chikuangue', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(530, 'sg06', 'Kir sans alcool', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(531, 'DRF0125', 'Sprite plastic', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(532, 'SJP09', 'SALADE', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(533, 'SJP010', 'OEUF', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Paquet', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(534, 'SJP011', 'Merguez', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(535, 'sjp012', 'Avocat fruit', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(536, 'sjp013', 'cornichon', NULL, 2, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(537, 'sjp014', 'cuisse de poulet', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Carton', 0, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(538, 'JPS26', 'salade piemontaise du chef', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(539, 'jps27', 'mousse citron', NULL, 0, 0, 0, 0.00, 0.00, '0.0000000000', 'USD', 1, 0, 0, 'unite', 0, 51, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(540, 'sjp015', 'Mateus bouteille', NULL, 2, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'Mesurette', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(541, 'sjp016', 'Chemin de pape', NULL, 2, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(542, 'sjp017', 'Chenini brand rish', NULL, 2, 0, 0, 30.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(543, 'sjp018', 'mouton cadet blanc', NULL, 2, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(544, 'sjp019', 'kadette', NULL, 2, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(545, 'sjp020', 'Graff', NULL, 2, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(546, 'sjp021', 'Sainte Emilion', NULL, 2, 0, 0, 40.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(547, 'sjp022', 'Vranken demi sec', NULL, 2, 0, 0, 100.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(548, 'sjp023', 'Laurent Perrier brut', NULL, 2, 0, 0, 120.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(549, 'sjp024', 'Hennessy cognac', NULL, 2, 0, 0, 120.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(550, 'sjp025', 'Jack Daniel', NULL, 2, 0, 0, 130.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(551, 'sjp26', 'TequillaCamino', NULL, 2, 0, 0, 55.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(552, 'sjp026', 'Kalhua', NULL, 2, 0, 0, 35.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(553, 'sjp027', 'Finlandia', NULL, 2, 0, 0, 50.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(554, 'sjp27', 'Agavita Tequila', NULL, 2, 0, 0, 60.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(555, 'sjp028', 'Villa Cardera', NULL, 2, 0, 0, 50.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(556, 'sjp030', 'Aguacana cachaca', NULL, 2, 0, 0, 50.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356),
(557, 'sjp031', 'Mouton Cadet Ice blanc', NULL, 2, 0, 0, 25.00, 0.00, '0.0000000000', 'USD', 0, 0, 0, 'piece', 0, 20, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 356);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stk_sous_famille`
--

DROP TABLE IF EXISTS `stk_sous_famille`;
CREATE TABLE IF NOT EXISTS `stk_sous_famille` (
  `id_s_fam` int(11) NOT NULL AUTO_INCREMENT,
  `des` varchar(20) DEFAULT NULL,
  `famille` int(11) DEFAULT NULL,
  `pseudo_supp` int(11) DEFAULT '0',
  `genre` int(11) DEFAULT '0',
  `classer` int(11) DEFAULT '100',
  `hotel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_s_fam`),
  KEY `famille` (`famille`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk_sous_famille`
--

INSERT INTO `stk_sous_famille` (`id_s_fam`, `des`, `famille`, `pseudo_supp`, `genre`, `classer`, `hotel_id`) VALUES
(6, 'VIN BLANCS', 12, 0, 0, 100, 356),
(7, 'VINS ROSES', 12, 0, 0, 100, 356),
(8, 'VINS ROUGES', 12, 0, 0, 100, 356),
(9, 'VINS SUD AFRICAIN', 12, 0, 0, 100, 356),
(10, 'VINS MAISON', 12, 0, 0, 100, 356),
(12, 'EAUX', 4, 0, 0, 0, 356),
(13, 'JUS', 5, 0, 0, 100, 356),
(14, 'BIERES', 6, 0, 0, 1, 356),
(15, 'BOISSONS CHAUDE', 7, 0, 0, 100, 356),
(16, 'APEROS', 8, 0, 0, 100, 356),
(17, 'COKTAILS', 9, 0, 0, 100, 356),
(18, 'ALCOOL', 15, 0, 0, 100, 356),
(19, 'DIGESTIFS', 10, 0, 0, 100, 356),
(20, 'BOUTEILLES', 11, 0, 0, 100, 356),
(21, 'SOFTS', 16, 0, 0, 2, 356),
(22, 'CHAMPAGNE', 14, 0, 0, 100, 356),
(23, 'FIN DE CAVE', 13, 0, 0, 100, 356),
(24, 'CUISINE', 17, 0, 0, 100, 356),
(25, 'DESSERTS', 18, 0, 2, 7, 356),
(28, 'PETITE CUISINE', 18, 0, 0, 100, 356),
(29, 'PIZZA', 18, 0, 0, 100, 356),
(30, 'SAUCES', 18, 0, 0, 100, 356),
(31, 'LEGUMES', 18, 0, 0, 100, 356),
(32, 'ACCOMPAGNEMENTS', 18, 0, 0, 100, 356),
(33, 'HAMBURGERS', 18, 0, 0, 100, 356),
(34, 'VOLAILLES', 18, 0, 0, 100, 356),
(35, 'POISSONS', 18, 0, 0, 100, 356),
(36, 'VIANDES', 18, 0, 0, 100, 356),
(37, 'PLATS LOCAUX', 18, 0, 0, 4, 356),
(38, 'ENTREES', 18, 0, 1, 6, 356),
(41, 'PLANCHAS', 18, 0, 0, 5, 356),
(42, 'LES APEROS', 18, 0, 0, 100, 356),
(43, 'BOISSONS CHAUDES', 18, 0, 0, 100, 356),
(44, 'LES BAGUETTES', 18, 0, 0, 100, 356),
(45, 'BUFFET', 18, 0, 0, 100, 356),
(46, 'CIGARETTE', 21, 0, 0, 100, 356),
(47, 'PLASTIQUE SOFTS', 16, 0, 0, 100, 356),
(48, 'PATTES', 18, 0, 0, 100, 356),
(49, 'NETTOYAGE', 17, 0, 0, 100, 356),
(50, 'IMMOBILIER', 22, 0, 0, 100, 356),
(51, 'SUGGESTIONS', 18, 0, 0, 100, 356);

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
  PRIMARY KEY (`idmvt`),
  KEY `produit_id` (`produit_id`),
  KEY `user_id` (`user_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `depot_id` (`depot_id`),
  KEY `fiche_id` (`fiche_id`),
  KEY `motif_sortie_id` (`motif_sortie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3914 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stk__mouvement`
--

INSERT INTO `stk__mouvement` (`idmvt`, `indice_bs`, `type`, `motif`, `num_bon`, `qte_entree`, `qte_sortie`, `qte_declasse`, `qte_report`, `dte_appro`, `dte_appro_heure`, `depot`, `appro_depot`, `en_vente`, `produit_id`, `fiche_id`, `motif_sortie_id`, `user_id`, `depot_id`, `hotel_id`) VALUES
(3849, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 468, 587, 6, 471, 123, 356),
(3850, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 469, 587, 6, 471, 123, 356),
(3851, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 470, 587, 6, 471, 123, 356),
(3852, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 39, 587, 6, 471, 123, 356),
(3853, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 36, 587, 6, 471, 123, 356),
(3854, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 37, 587, 6, 471, 123, 356),
(3855, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 28, 587, 6, 471, 123, 356),
(3856, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 32, 587, 6, 471, 123, 356),
(3857, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 43, 587, 6, 471, 123, 356),
(3858, 1, 'appro', NULL, NULL, 50, 0, 0, 50, '2020-05-28', '2020-05-28 14:15:48', NULL, 0, 1, 38, 587, 6, 471, 123, 356),
(3859, 1, 'sortie', NULL, NULL, 0, 10, 0, 40, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 468, 588, 7, 471, 123, 356),
(3860, 1, 'appro', NULL, NULL, 10, 0, 0, 10, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 468, 588, 7, 471, 121, 356),
(3861, 1, 'sortie', NULL, NULL, 0, 10, 0, 40, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 469, 588, 7, 471, 123, 356),
(3862, 1, 'appro', NULL, NULL, 10, 0, 0, 10, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 469, 588, 7, 471, 121, 356),
(3863, 1, 'sortie', NULL, NULL, 0, 10, 0, 40, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 470, 588, 7, 471, 123, 356),
(3864, 1, 'appro', NULL, NULL, 10, 0, 0, 10, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 470, 588, 7, 471, 121, 356),
(3865, 1, 'sortie', NULL, NULL, 0, 10, 0, 40, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 39, 588, 7, 471, 123, 356),
(3866, 1, 'appro', NULL, NULL, 10, 0, 0, 10, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 39, 588, 7, 471, 121, 356),
(3867, 1, 'sortie', NULL, NULL, 0, 10, 0, 40, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 28, 588, 7, 471, 123, 356),
(3868, 1, 'appro', NULL, NULL, 10, 0, 0, 10, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 28, 588, 7, 471, 121, 356),
(3869, 1, 'sortie', NULL, NULL, 0, 10, 0, 40, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 32, 588, 7, 471, 123, 356),
(3870, 1, 'appro', NULL, NULL, 10, 0, 0, 10, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 32, 588, 7, 471, 121, 356),
(3871, 1, 'sortie', NULL, NULL, 0, 10, 0, 40, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 43, 588, 7, 471, 123, 356),
(3872, 1, 'appro', NULL, NULL, 10, 0, 0, 10, '2020-05-28', '2020-05-28 14:19:06', NULL, 0, 1, 43, 588, 7, 471, 121, 356),
(3873, 1, 'sortie', NULL, NULL, 0, 2, 0, 8, '2020-05-28', '2020-05-28 14:39:28', NULL, 0, 1, 39, 589, 1, 476, 121, 356),
(3874, 1, 'sortie', NULL, NULL, 0, 3, 0, 7, '2020-05-28', '2020-05-28 14:39:29', NULL, 0, 1, 28, 589, 1, 476, 121, 356),
(3875, 1, 'sortie', NULL, NULL, 0, 5, 0, 5, '2020-05-28', '2020-05-28 14:39:29', NULL, 0, 1, 43, 589, 1, 476, 121, 356),
(3876, 1, 'sortie', NULL, NULL, 0, 1, 0, -1, '2020-05-28', '2020-05-28 14:43:51', NULL, 0, 1, 6, 590, 1, 476, 121, 356),
(3877, 1, 'sortie', NULL, NULL, 0, 1, 0, -1, '2020-05-28', '2020-05-28 14:43:51', NULL, 0, 1, 10, 590, 1, 476, 121, 356),
(3878, 1, 'sortie', NULL, NULL, 0, 1, 0, -1, '2020-05-28', '2020-05-28 14:43:51', NULL, 0, 1, 435, 590, 1, 476, 121, 356),
(3879, 1, 'sortie', NULL, NULL, 0, 1, 0, -1, '2020-05-28', '2020-05-28 14:43:51', NULL, 0, 1, 484, 590, 1, 476, 121, 356),
(3880, 1, 'sortie', NULL, NULL, 0, 1, 0, -1, '2020-05-28', '2020-05-28 14:43:51', NULL, 0, 1, 514, 590, 1, 476, 121, 356),
(3881, 1, 'sortie', NULL, NULL, 0, 1, 0, -2, '2020-05-28', '2020-05-28 14:49:48', NULL, 0, 1, 6, 591, 1, 476, 121, 356),
(3882, 1, 'sortie', NULL, NULL, 0, 1, 0, -2, '2020-05-28', '2020-05-28 14:49:48', NULL, 0, 1, 435, 591, 1, 476, 121, 356),
(3883, 1, 'sortie', NULL, NULL, 0, 1, 0, 9, '2020-05-28', '2020-05-28 14:49:48', NULL, 0, 1, 468, 591, 1, 476, 121, 356),
(3884, 1, 'sortie', NULL, NULL, 0, 1, 0, 9, '2020-05-28', '2020-05-28 14:49:48', NULL, 0, 1, 469, 591, 1, 476, 121, 356),
(3885, 1, 'sortie', NULL, NULL, 0, 1, 0, -1, '2020-05-28', '2020-05-28 14:49:48', NULL, 0, 1, 531, 591, 1, 476, 121, 356),
(3886, 1, 'sortie', NULL, NULL, 0, 1, 0, 6, '2020-05-28', '2020-05-28 15:03:48', NULL, 0, 1, 28, 592, 1, 476, 121, 356),
(3887, 1, 'sortie', NULL, NULL, 0, 1, 0, 4, '2020-05-28', '2020-05-28 15:03:48', NULL, 0, 1, 43, 592, 1, 476, 121, 356),
(3888, 1, 'sortie', NULL, NULL, 0, 1, 0, 9, '2020-05-28', '2020-05-28 15:03:48', NULL, 0, 1, 470, 592, 1, 476, 121, 356),
(3889, 1, 'sortie', NULL, NULL, 0, 1, 0, 8, '2020-05-29', '2020-05-29 13:41:37', NULL, 0, 1, 468, 593, 1, 476, 121, 356),
(3890, 1, 'sortie', NULL, NULL, 0, 1, 0, 8, '2020-05-29', '2020-05-29 13:41:37', NULL, 0, 1, 469, 593, 1, 476, 121, 356),
(3891, 1, 'sortie', NULL, NULL, 0, 1, 0, 8, '2020-05-29', '2020-05-29 13:41:37', NULL, 0, 1, 470, 593, 1, 476, 121, 356),
(3892, 1, 'sortie', NULL, NULL, 0, 1, 0, 7, '2020-05-29', '2020-05-29 13:41:37', NULL, 0, 1, 39, 593, 1, 476, 121, 356),
(3893, 1, 'sortie', NULL, NULL, 0, 1, 0, 9, '2020-05-29', '2020-05-29 13:41:37', NULL, 0, 1, 32, 593, 1, 476, 121, 356),
(3894, 1, 'sortie', NULL, NULL, 0, 1, 0, 5, '2020-05-29', '2020-05-29 13:41:37', NULL, 0, 1, 28, 593, 1, 476, 121, 356),
(3895, 1, 'sortie', NULL, NULL, 0, 1, 0, 3, '2020-05-29', '2020-05-29 13:41:37', NULL, 0, 1, 43, 593, 1, 476, 121, 356),
(3896, 1, 'sortie', NULL, NULL, 0, 1, 0, 7, '2020-05-29', '2020-05-29 13:50:45', NULL, 0, 1, 468, 594, 1, 476, 121, 356),
(3897, 1, 'sortie', NULL, NULL, 0, 1, 0, 7, '2020-05-29', '2020-05-29 13:50:45', NULL, 0, 1, 470, 594, 1, 476, 121, 356),
(3898, 1, 'sortie', NULL, NULL, 0, 1, 0, 6, '2020-05-29', '2020-05-29 13:50:45', NULL, 0, 1, 39, 594, 1, 476, 121, 356),
(3899, 1, 'sortie', NULL, NULL, 0, 1, 0, 8, '2020-05-29', '2020-05-29 13:50:45', NULL, 0, 1, 32, 594, 1, 476, 121, 356),
(3900, 1, 'sortie', NULL, NULL, 0, 1, 0, 4, '2020-05-29', '2020-05-29 13:50:45', NULL, 0, 1, 28, 594, 1, 476, 121, 356),
(3901, 1, 'sortie', NULL, NULL, 0, 1, 0, 2, '2020-05-29', '2020-05-29 13:50:45', NULL, 0, 1, 43, 594, 1, 476, 121, 356),
(3902, 1, 'sortie', NULL, NULL, 0, 1, 0, 7, '2020-05-29', '2020-05-29 16:04:46', NULL, 0, 1, 469, 595, 1, 476, 121, 356),
(3903, 1, 'sortie', NULL, NULL, 0, 1, 0, 6, '2020-05-29', '2020-05-29 16:04:46', NULL, 0, 1, 470, 595, 1, 476, 121, 356),
(3904, 1, 'sortie', NULL, NULL, 0, 3, 0, 4, '2020-06-02', '2020-06-02 12:55:05', NULL, 0, 1, 468, 596, 1, 476, 121, 356),
(3905, 1, 'sortie', NULL, NULL, 0, 3, 0, 3, '2020-06-02', '2020-06-02 12:55:06', NULL, 0, 1, 470, 596, 1, 476, 121, 356),
(3906, 1, 'sortie', NULL, NULL, 0, 2, 0, 2, '2020-06-02', '2020-06-02 12:56:21', NULL, 0, 1, 28, 597, 1, 476, 121, 356),
(3907, 1, 'sortie', NULL, NULL, 0, 1, 0, 1, '2020-06-02', '2020-06-02 15:27:38', NULL, 0, 1, 28, 598, 1, 476, 121, 356),
(3908, 1, 'sortie', NULL, NULL, 0, 3, 0, 5, '2020-06-02', '2020-06-02 15:27:39', NULL, 0, 1, 32, 598, 1, 476, 121, 356),
(3909, 1, 'sortie', NULL, NULL, 0, 1, 0, 3, '2020-06-02', '2020-06-02 15:27:39', NULL, 0, 1, 468, 598, 1, 476, 121, 356),
(3910, 1, 'sortie', NULL, NULL, 0, 1, 0, 6, '2020-06-02', '2020-06-02 16:08:57', NULL, 0, 1, 469, 601, 1, 476, 121, 356),
(3911, 1, 'sortie', NULL, NULL, 0, 2, 0, 3, '2020-06-04', '2020-06-04 13:10:53', NULL, 0, 1, 32, 603, 1, 476, 121, 356),
(3912, 1, 'sortie', NULL, NULL, 0, 3, 0, 0, '2020-06-04', '2020-06-04 13:30:47', NULL, 0, 1, 470, 604, 1, 476, 121, 356),
(3913, 1, 'sortie', NULL, NULL, 0, 1, 0, 2, '2020-06-04', '2020-06-04 13:30:47', NULL, 0, 1, 468, 604, 1, 476, 121, 356);

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
  PRIMARY KEY (`id`),
  KEY `facture_id` (`facture_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `suivifactures`
--

INSERT INTO `suivifactures` (`id`, `dte_time`, `heure`, `agent`, `qte`, `prix`, `monnaie`, `repas`, `produit_id`, `description`, `facture_id`, `suppr`) VALUES
(156, '2020-06-04 13:29:56', '13:29:56', ' Serveur', 1, '21450.0000000000', 'CDF', 1, 358, 'Frites, Fufu', 291, 0),
(157, '2020-06-04 13:29:57', '13:29:57', ' Serveur', 3, '8250.0000000000', 'CDF', 0, 470, '', 291, 0),
(158, '2020-06-04 13:29:57', '13:29:57', ' Serveur', 1, '5775.0000000000', 'CDF', 0, 468, '', 291, 0),
(159, '2020-06-04 13:35:52', '13:35:52', ' Serveur', 1, '33000.0000000000', 'CDF', 1, 493, '', 292, 0);

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
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `system_users`
--

INSERT INTO `system_users` (`userid`, `name`, `email`, `phone`, `username`, `password`, `membership`, `user_status`, `user_position`, `user_avarta`, `date_created`, `last_updated`, `last_login_date`, `last_login_ip`) VALUES
(1, NULL, NULL, NULL, 'admin', '$2a$08$kUH3Ko5akg0aO1BWP37C5eLzO2f0QqxsED9r8yLsJAbgJpXSS2JTKkUH3Ko5akg0aO1BWP37C5e', NULL, 1, 1, NULL, NULL, NULL, '2019-06-20', '::1');

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
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `system_users3`
--

INSERT INTO `system_users3` (`userid`, `name`, `email`, `phone`, `username`, `password`, `membership`, `user_status`, `user_position`, `user_avarta`, `date_created`, `last_updated`, `last_login_date`, `last_login_ip`) VALUES
(1, NULL, NULL, NULL, 'admin', '$2a$08$kUH3Ko5akg0aO1BWP37C5eLzO2f0QqxsED9r8yLsJAbgJpXSS2JTKkUH3Ko5akg0aO1BWP37C5e', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL);

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
  PRIMARY KEY (`timezone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `timezones`
--

INSERT INTO `timezones` (`timezone_id`, `timezone_groupe_fr`, `timezone_groupe_en`, `timezone_detail`) VALUES
(1, 'Afrique', 'Africa', 'Africa/Abidjan'),
(2, 'Afrique', 'Africa', 'Africa/Accra'),
(3, 'Afrique', 'Africa', 'Africa/Addis_Ababa'),
(4, 'Afrique', 'Africa', 'Africa/Algiers'),
(5, 'Afrique', 'Africa', 'Africa/Asmara'),
(6, 'Afrique', 'Africa', 'Africa/Asmera'),
(7, 'Afrique', 'Africa', 'Africa/Bamako'),
(8, 'Afrique', 'Africa', 'Africa/Bangui'),
(9, 'Afrique', 'Africa', 'Africa/Banjul'),
(10, 'Afrique', 'Africa', 'Africa/Bissau'),
(11, 'Afrique', 'Africa', 'Africa/Blantyre'),
(12, 'Afrique', 'Africa', 'Africa/Brazzaville'),
(13, 'Afrique', 'Africa', 'Africa/Bujumbura'),
(14, 'Afrique', 'Africa', 'Africa/Cairo'),
(15, 'Afrique', 'Africa', 'Africa/Casablanca'),
(16, 'Afrique', 'Africa', 'Africa/Ceuta'),
(17, 'Afrique', 'Africa', 'Africa/Conakry'),
(18, 'Afrique', 'Africa', 'Africa/Dakar'),
(19, 'Afrique', 'Africa', 'Africa/Dar_es_Salaam'),
(20, 'Afrique', 'Africa', 'Africa/Djibouti'),
(21, 'Afrique', 'Africa', 'Africa/Douala'),
(22, 'Afrique', 'Africa', 'Africa/El_Aaiun'),
(23, 'Afrique', 'Africa', 'Africa/Freetown'),
(24, 'Afrique', 'Africa', 'Africa/Gaborone'),
(25, 'Afrique', 'Africa', 'Africa/Harare'),
(26, 'Afrique', 'Africa', 'Africa/Johannesburg'),
(27, 'Afrique', 'Africa', 'Africa/Juba'),
(28, 'Afrique', 'Africa', 'Africa/Kampala'),
(29, 'Afrique', 'Africa', 'Africa/Khartoum'),
(30, 'Afrique', 'Africa', 'Africa/Kigali'),
(31, 'Afrique', 'Africa', 'Africa/Kinshasa'),
(32, 'Afrique', 'Africa', 'Africa/Lagos'),
(33, 'Afrique', 'Africa', 'Africa/Libreville'),
(34, 'Afrique', 'Africa', 'Africa/Lome'),
(35, 'Afrique', 'Africa', 'Africa/Luanda'),
(36, 'Afrique', 'Africa', 'Africa/Lubumbashi'),
(37, 'Afrique', 'Africa', 'Africa/Lusaka'),
(38, 'Afrique', 'Africa', 'Africa/Malabo'),
(39, 'Afrique', 'Africa', 'Africa/Maputo'),
(40, 'Afrique', 'Africa', 'Africa/Maseru'),
(41, 'Afrique', 'Africa', 'Africa/Mbabane'),
(42, 'Afrique', 'Africa', 'Africa/Mogadishu'),
(43, 'Afrique', 'Africa', 'Africa/Monrovia'),
(44, 'Afrique', 'Africa', 'Africa/Nairobi'),
(45, 'Afrique', 'Africa', 'Africa/Ndjamena'),
(46, 'Afrique', 'Africa', 'Africa/Niamey'),
(47, 'Afrique', 'Africa', 'Africa/Nouakchott'),
(48, 'Afrique', 'Africa', 'Africa/Ouagadougou'),
(49, 'Afrique', 'Africa', 'Africa/Porto-Novo'),
(50, 'Afrique', 'Africa', 'Africa/Sao_Tome'),
(51, 'Afrique', 'Africa', 'Africa/Timbuktu'),
(52, 'Afrique', 'Africa', 'Africa/Tripoli'),
(53, 'Afrique', 'Africa', 'Africa/Tunis'),
(54, 'Afrique', 'Africa', 'Africa/Windhoek'),
(55, 'Amérique', 'America', 'America/Adak'),
(56, 'Amérique', 'America', 'America/Anchorage'),
(57, 'Amérique', 'America', 'America/Anguilla'),
(58, 'Amérique', 'America', 'America/Antigua'),
(59, 'Amérique', 'America', 'America/Araguaina'),
(60, 'Amérique', 'America', 'America/Argentina/Buenos_Aires'),
(61, 'Amérique', 'America', 'America/Argentina/Catamarca'),
(62, 'Amérique', 'America', 'America/Argentina/ComodRivadavia'),
(63, 'Amérique', 'America', 'America/Argentina/Cordoba'),
(64, 'Amérique', 'America', 'America/Argentina/Jujuy'),
(65, 'Amérique', 'America', 'America/Argentina/La_Rioja'),
(66, 'Amérique', 'America', 'America/Argentina/Mendoza'),
(67, 'Amérique', 'America', 'America/Argentina/Rio_Gallegos'),
(68, 'Amérique', 'America', 'America/Argentina/Salta'),
(69, 'Amérique', 'America', 'America/Argentina/San_Juan'),
(70, 'Amérique', 'America', 'America/Argentina/San_Luis'),
(71, 'Amérique', 'America', 'America/Argentina/Tucuman'),
(72, 'Amérique', 'America', 'America/Argentina/Ushuaia'),
(73, 'Amérique', 'America', 'America/Aruba'),
(74, 'Amérique', 'America', 'America/Asuncion'),
(75, 'Amérique', 'America', 'America/Atikokan'),
(76, 'Amérique', 'America', 'America/Atka'),
(77, 'Amérique', 'America', 'America/Bahia'),
(78, 'Amérique', 'America', 'America/Bahia_Banderas'),
(79, 'Amérique', 'America', 'America/Barbados'),
(80, 'Amérique', 'America', 'America/Belem'),
(81, 'Amérique', 'America', 'America/Belize'),
(82, 'Amérique', 'America', 'America/Blanc-Sablon'),
(83, 'Amérique', 'America', 'America/Boa_Vista'),
(84, 'Amérique', 'America', 'America/Bogota'),
(85, 'Amérique', 'America', 'America/Boise'),
(86, 'Amérique', 'America', 'America/Buenos_Aires'),
(87, 'Amérique', 'America', 'America/Cambridge_Bay'),
(88, 'Amérique', 'America', 'America/Campo_Grande'),
(89, 'Amérique', 'America', 'America/Cancun'),
(90, 'Amérique', 'America', 'America/Caracas'),
(91, 'Amérique', 'America', 'America/Catamarca'),
(92, 'Amérique', 'America', 'America/Cayenne'),
(93, 'Amérique', 'America', 'America/Cayman'),
(94, 'Amérique', 'America', 'America/Chicago'),
(95, 'Amérique', 'America', 'America/Chihuahua'),
(96, 'Amérique', 'America', 'America/Coral_Harbour'),
(97, 'Amérique', 'America', 'America/Cordoba'),
(98, 'Amérique', 'America', 'America/Costa_Rica'),
(99, 'Amérique', 'America', 'America/Creston'),
(100, 'Amérique', 'America', 'America/Cuiaba'),
(101, 'Amérique', 'America', 'America/Curacao'),
(102, 'Amérique', 'America', 'America/Danmarkshavn'),
(103, 'Amérique', 'America', 'America/Dawson'),
(104, 'Amérique', 'America', 'America/Dawson_Creek'),
(105, 'Amérique', 'America', 'America/Denver'),
(106, 'Amérique', 'America', 'America/Detroit'),
(107, 'Amérique', 'America', 'America/Dominica'),
(108, 'Amérique', 'America', 'America/Edmonton'),
(109, 'Amérique', 'America', 'America/Eirunepe'),
(110, 'Amérique', 'America', 'America/El_Salvador'),
(111, 'Amérique', 'America', 'America/Ensenada'),
(112, 'Amérique', 'America', 'America/Fort_Wayne'),
(113, 'Amérique', 'America', 'America/Fortaleza'),
(114, 'Amérique', 'America', 'America/Glace_Bay'),
(115, 'Amérique', 'America', 'America/Godthab'),
(116, 'Amérique', 'America', 'America/Goose_Bay'),
(117, 'Amérique', 'America', 'America/Grand_Turk'),
(118, 'Amérique', 'America', 'America/Grenada'),
(119, 'Amérique', 'America', 'America/Guadeloupe'),
(120, 'Amérique', 'America', 'America/Guatemala'),
(121, 'Amérique', 'America', 'America/Guayaquil'),
(122, 'Amérique', 'America', 'America/Guyana'),
(123, 'Amérique', 'America', 'America/Halifax'),
(124, 'Amérique', 'America', 'America/Havana'),
(125, 'Amérique', 'America', 'America/Hermosillo'),
(126, 'Amérique', 'America', 'America/Indiana/Indianapolis'),
(127, 'Amérique', 'America', 'America/Indiana/Knox'),
(128, 'Amérique', 'America', 'America/Indiana/Marengo'),
(129, 'Amérique', 'America', 'America/Indiana/Petersburg'),
(130, 'Amérique', 'America', 'America/Indiana/Tell_City'),
(131, 'Amérique', 'America', 'America/Indiana/Vevay'),
(132, 'Amérique', 'America', 'America/Indiana/Vincennes'),
(133, 'Amérique', 'America', 'America/Indiana/Winamac'),
(134, 'Amérique', 'America', 'America/Indianapolis'),
(135, 'Amérique', 'America', 'America/Inuvik'),
(136, 'Amérique', 'America', 'America/Iqaluit'),
(137, 'Amérique', 'America', 'America/Jamaica'),
(138, 'Amérique', 'America', 'America/Jujuy'),
(139, 'Amérique', 'America', 'America/Juneau'),
(140, 'Amérique', 'America', 'America/Kentucky/Louisville'),
(141, 'Amérique', 'America', 'America/Kentucky/Monticello'),
(142, 'Amérique', 'America', 'America/Knox_IN'),
(143, 'Amérique', 'America', 'America/Kralendijk'),
(144, 'Amérique', 'America', 'America/La_Paz'),
(145, 'Amérique', 'America', 'America/Lima'),
(146, 'Amérique', 'America', 'America/Los_Angeles'),
(147, 'Amérique', 'America', 'America/Louisville'),
(148, 'Amérique', 'America', 'America/Lower_Princes'),
(149, 'Amérique', 'America', 'America/Maceio'),
(150, 'Amérique', 'America', 'America/Managua'),
(151, 'Amérique', 'America', 'America/Manaus'),
(152, 'Amérique', 'America', 'America/Marigot'),
(153, 'Amérique', 'America', 'America/Martinique'),
(154, 'Amérique', 'America', 'America/Matamoros'),
(155, 'Amérique', 'America', 'America/Mazatlan'),
(156, 'Amérique', 'America', 'America/Mendoza'),
(157, 'Amérique', 'America', 'America/Menominee'),
(158, 'Amérique', 'America', 'America/Merida'),
(159, 'Amérique', 'America', 'America/Metlakatla'),
(160, 'Amérique', 'America', 'America/Mexico_City'),
(161, 'Amérique', 'America', 'America/Miquelon'),
(162, 'Amérique', 'America', 'America/Moncton'),
(163, 'Amérique', 'America', 'America/Monterrey'),
(164, 'Amérique', 'America', 'America/Montevideo'),
(165, 'Amérique', 'America', 'America/Montreal'),
(166, 'Amérique', 'America', 'America/Montserrat'),
(167, 'Amérique', 'America', 'America/Nassau'),
(168, 'Amérique', 'America', 'America/New_York'),
(169, 'Amérique', 'America', 'America/Nipigon'),
(170, 'Amérique', 'America', 'America/Nome'),
(171, 'Amérique', 'America', 'America/Noronha'),
(172, 'Amérique', 'America', 'America/North_Dakota/Beulah'),
(173, 'Amérique', 'America', 'America/North_Dakota/Center'),
(174, 'Amérique', 'America', 'America/North_Dakota/New_Salem'),
(175, 'Amérique', 'America', 'America/Ojinaga'),
(176, 'Amérique', 'America', 'America/Panama'),
(177, 'Amérique', 'America', 'America/Pangnirtung'),
(178, 'Amérique', 'America', 'America/Paramaribo'),
(179, 'Amérique', 'America', 'America/Phoenix'),
(180, 'Amérique', 'America', 'America/Port-au-Prince'),
(181, 'Amérique', 'America', 'America/Port_of_Spain'),
(182, 'Amérique', 'America', 'America/Porto_Acre'),
(183, 'Amérique', 'America', 'America/Porto_Velho'),
(184, 'Amérique', 'America', 'America/Puerto_Rico'),
(185, 'Amérique', 'America', 'America/Rainy_River'),
(186, 'Amérique', 'America', 'America/Rankin_Inlet'),
(187, 'Amérique', 'America', 'America/Recife'),
(188, 'Amérique', 'America', 'America/Regina'),
(189, 'Amérique', 'America', 'America/Resolute'),
(190, 'Amérique', 'America', 'America/Rio_Branco'),
(191, 'Amérique', 'America', 'America/Rosario'),
(192, 'Amérique', 'America', 'America/Santa_Isabel'),
(193, 'Amérique', 'America', 'America/Santarem'),
(194, 'Amérique', 'America', 'America/Santiago'),
(195, 'Amérique', 'America', 'America/Santo_Domingo'),
(196, 'Amérique', 'America', 'America/Sao_Paulo'),
(197, 'Amérique', 'America', 'America/Scoresbysund'),
(198, 'Amérique', 'America', 'America/Shiprock'),
(199, 'Amérique', 'America', 'America/Sitka'),
(200, 'Amérique', 'America', 'America/St_Barthelemy'),
(201, 'Amérique', 'America', 'America/St_Johns'),
(202, 'Amérique', 'America', 'America/St_Kitts'),
(203, 'Amérique', 'America', 'America/St_Lucia'),
(204, 'Amérique', 'America', 'America/St_Thomas'),
(205, 'Amérique', 'America', 'America/St_Vincent'),
(206, 'Amérique', 'America', 'America/Swift_Current'),
(207, 'Amérique', 'America', 'America/Tegucigalpa'),
(208, 'Amérique', 'America', 'America/Thule'),
(209, 'Amérique', 'America', 'America/Thunder_Bay'),
(210, 'Amérique', 'America', 'America/Tijuana'),
(211, 'Amérique', 'America', 'America/Toronto'),
(212, 'Amérique', 'America', 'America/Tortola'),
(213, 'Amérique', 'America', 'America/Vancouver'),
(214, 'Amérique', 'America', 'America/Virgin'),
(215, 'Amérique', 'America', 'America/Whitehorse'),
(216, 'Amérique', 'America', 'America/Winnipeg'),
(217, 'Amérique', 'America', 'America/Yakutat'),
(218, 'Amérique', 'America', 'America/Yellowknife'),
(219, 'Antarctique', 'Antarctica', 'Antarctica/Casey'),
(220, 'Antarctique', 'Antarctica', 'Antarctica/Davis'),
(221, 'Antarctique', 'Antarctica', 'Antarctica/DumontDUrville'),
(222, 'Antarctique', 'Antarctica', 'Antarctica/Macquarie'),
(223, 'Antarctique', 'Antarctica', 'Antarctica/Mawson'),
(224, 'Antarctique', 'Antarctica', 'Antarctica/McMurdo'),
(225, 'Antarctique', 'Antarctica', 'Antarctica/Palmer'),
(226, 'Antarctique', 'Antarctica', 'Antarctica/Rothera'),
(227, 'Antarctique', 'Antarctica', 'Antarctica/South_Pole'),
(228, 'Antarctique', 'Antarctica', 'Antarctica/Syowa'),
(229, 'Antarctique', 'Antarctica', 'Antarctica/Vostok'),
(230, 'Arctique', 'Arctic', 'Arctic/Longyearbyen'),
(231, 'Asie', 'Asia', 'Asia/Aden'),
(232, 'Asie', 'Asia', 'Asia/Almaty'),
(233, 'Asie', 'Asia', 'Asia/Amman'),
(234, 'Asie', 'Asia', 'Asia/Anadyr'),
(235, 'Asie', 'Asia', 'Asia/Aqtau'),
(236, 'Asie', 'Asia', 'Asia/Aqtobe'),
(237, 'Asie', 'Asia', 'Asia/Ashgabat'),
(238, 'Asie', 'Asia', 'Asia/Ashkhabad'),
(239, 'Asie', 'Asia', 'Asia/Baghdad'),
(240, 'Asie', 'Asia', 'Asia/Bahrain'),
(241, 'Asie', 'Asia', 'Asia/Baku'),
(242, 'Asie', 'Asia', 'Asia/Bangkok'),
(243, 'Asie', 'Asia', 'Asia/Beirut'),
(244, 'Asie', 'Asia', 'Asia/Bishkek'),
(245, 'Asie', 'Asia', 'Asia/Brunei'),
(246, 'Asie', 'Asia', 'Asia/Calcutta'),
(247, 'Asie', 'Asia', 'Asia/Choibalsan'),
(248, 'Asie', 'Asia', 'Asia/Chongqing'),
(249, 'Asie', 'Asia', 'Asia/Chungking'),
(250, 'Asie', 'Asia', 'Asia/Colombo'),
(251, 'Asie', 'Asia', 'Asia/Dacca'),
(252, 'Asie', 'Asia', 'Asia/Damascus'),
(253, 'Asie', 'Asia', 'Asia/Dhaka'),
(254, 'Asie', 'Asia', 'Asia/Dili'),
(255, 'Asie', 'Asia', 'Asia/Dubai'),
(256, 'Asie', 'Asia', 'Asia/Dushanbe'),
(257, 'Asie', 'Asia', 'Asia/Gaza'),
(258, 'Asie', 'Asia', 'Asia/Harbin'),
(259, 'Asie', 'Asia', 'Asia/Hebron'),
(260, 'Asie', 'Asia', 'Asia/Ho_Chi_Minh'),
(261, 'Asie', 'Asia', 'Asia/Hong_Kong'),
(262, 'Asie', 'Asia', 'Asia/Hovd'),
(263, 'Asie', 'Asia', 'Asia/Irkutsk'),
(264, 'Asie', 'Asia', 'Asia/Istanbul'),
(265, 'Asie', 'Asia', 'Asia/Jakarta'),
(266, 'Asie', 'Asia', 'Asia/Jayapura'),
(267, 'Asie', 'Asia', 'Asia/Jerusalem'),
(268, 'Asie', 'Asia', 'Asia/Kabul'),
(269, 'Asie', 'Asia', 'Asia/Kamchatka'),
(270, 'Asie', 'Asia', 'Asia/Karachi'),
(271, 'Asie', 'Asia', 'Asia/Kashgar'),
(272, 'Asie', 'Asia', 'Asia/Kathmandu'),
(273, 'Asie', 'Asia', 'Asia/Katmandu'),
(274, 'Asie', 'Asia', 'Asia/Kolkata'),
(275, 'Asie', 'Asia', 'Asia/Krasnoyarsk'),
(276, 'Asie', 'Asia', 'Asia/Kuala_Lumpur'),
(277, 'Asie', 'Asia', 'Asia/Kuching'),
(278, 'Asie', 'Asia', 'Asia/Kuwait'),
(279, 'Asie', 'Asia', 'Asia/Macao'),
(280, 'Asie', 'Asia', 'Asia/Macau'),
(281, 'Asie', 'Asia', 'Asia/Magadan'),
(282, 'Asie', 'Asia', 'Asia/Makassar'),
(283, 'Asie', 'Asia', 'Asia/Manila'),
(284, 'Asie', 'Asia', 'Asia/Muscat'),
(285, 'Asie', 'Asia', 'Asia/Nicosia'),
(286, 'Asie', 'Asia', 'Asia/Novokuznetsk'),
(287, 'Asie', 'Asia', 'Asia/Novosibirsk'),
(288, 'Asie', 'Asia', 'Asia/Omsk'),
(289, 'Asie', 'Asia', 'Asia/Oral'),
(290, 'Asie', 'Asia', 'Asia/Phnom_Penh'),
(291, 'Asie', 'Asia', 'Asia/Pontianak'),
(292, 'Asie', 'Asia', 'Asia/Pyongyang'),
(293, 'Asie', 'Asia', 'Asia/Qatar'),
(294, 'Asie', 'Asia', 'Asia/Qyzylorda'),
(295, 'Asie', 'Asia', 'Asia/Rangoon'),
(296, 'Asie', 'Asia', 'Asia/Riyadh'),
(297, 'Asie', 'Asia', 'Asia/Saigon'),
(298, 'Asie', 'Asia', 'Asia/Sakhalin'),
(299, 'Asie', 'Asia', 'Asia/Samarkand'),
(300, 'Asie', 'Asia', 'Asia/Seoul'),
(301, 'Asie', 'Asia', 'Asia/Shanghai'),
(302, 'Asie', 'Asia', 'Asia/Singapore'),
(303, 'Asie', 'Asia', 'Asia/Taipei'),
(304, 'Asie', 'Asia', 'Asia/Tashkent'),
(305, 'Asie', 'Asia', 'Asia/Tbilisi'),
(306, 'Asie', 'Asia', 'Asia/Tehran'),
(307, 'Asie', 'Asia', 'Asia/Tel_Aviv'),
(308, 'Asie', 'Asia', 'Asia/Thimbu'),
(309, 'Asie', 'Asia', 'Asia/Thimphu'),
(310, 'Asie', 'Asia', 'Asia/Tokyo'),
(311, 'Asie', 'Asia', 'Asia/Ujung_Pandang'),
(312, 'Asie', 'Asia', 'Asia/Ulaanbaatar'),
(313, 'Asie', 'Asia', 'Asia/Ulan_Bator'),
(314, 'Asie', 'Asia', 'Asia/Urumqi'),
(315, 'Asie', 'Asia', 'Asia/Vientiane'),
(316, 'Asie', 'Asia', 'Asia/Vladivostok'),
(317, 'Asie', 'Asia', 'Asia/Yakutsk'),
(318, 'Asie', 'Asia', 'Asia/Yekaterinburg'),
(319, 'Asie', 'Asia', 'Asia/Yerevan'),
(320, 'Atlantique', 'Atlantic', 'Atlantic/Azores'),
(321, 'Atlantique', 'Atlantic', 'Atlantic/Bermuda'),
(322, 'Atlantique', 'Atlantic', 'Atlantic/Canary'),
(323, 'Atlantique', 'Atlantic', 'Atlantic/Cape_Verde'),
(324, 'Atlantique', 'Atlantic', 'Atlantic/Faeroe'),
(325, 'Atlantique', 'Atlantic', 'Atlantic/Faroe'),
(326, 'Atlantique', 'Atlantic', 'Atlantic/Jan_Mayen'),
(327, 'Atlantique', 'Atlantic', 'Atlantic/Madeira'),
(328, 'Atlantique', 'Atlantic', 'Atlantic/Reykjavik'),
(329, 'Atlantique', 'Atlantic', 'Atlantic/South_Georgia'),
(330, 'Atlantique', 'Atlantic', 'Atlantic/St_Helena'),
(331, 'Atlantique', 'Atlantic', 'Atlantic/Stanley'),
(332, 'Australie', 'Australia', 'Australia/ACT'),
(333, 'Australie', 'Australia', 'Australia/Adelaide'),
(334, 'Australie', 'Australia', 'Australia/Brisbane'),
(335, 'Australie', 'Australia', 'Australia/Broken_Hill'),
(336, 'Australie', 'Australia', 'Australia/Canberra'),
(337, 'Australie', 'Australia', 'Australia/Currie'),
(338, 'Australie', 'Australia', 'Australia/Darwin'),
(339, 'Australie', 'Australia', 'Australia/Eucla'),
(340, 'Australie', 'Australia', 'Australia/Hobart'),
(341, 'Australie', 'Australia', 'Australia/LHI'),
(342, 'Australie', 'Australia', 'Australia/Lindeman'),
(343, 'Australie', 'Australia', 'Australia/Lord_Howe'),
(344, 'Australie', 'Australia', 'Australia/Melbourne'),
(345, 'Australie', 'Australia', 'Australia/NSW'),
(346, 'Australie', 'Australia', 'Australia/North'),
(347, 'Australie', 'Australia', 'Australia/Perth'),
(348, 'Australie', 'Australia', 'Australia/Queensland'),
(349, 'Australie', 'Australia', 'Australia/South'),
(350, 'Australie', 'Australia', 'Australia/Sydney'),
(351, 'Australie', 'Australia', 'Australia/Tasmania'),
(352, 'Australie', 'Australia', 'Australia/Victoria'),
(353, 'Australie', 'Australia', 'Australia/West'),
(354, 'Australie', 'Australia', 'Australia/Yancowinna'),
(355, 'Europe', 'Europe', 'Europe/Amsterdam'),
(356, 'Europe', 'Europe', 'Europe/Andorra'),
(357, 'Europe', 'Europe', 'Europe/Athens'),
(358, 'Europe', 'Europe', 'Europe/Belfast'),
(359, 'Europe', 'Europe', 'Europe/Belgrade'),
(360, 'Europe', 'Europe', 'Europe/Berlin'),
(361, 'Europe', 'Europe', 'Europe/Bratislava'),
(362, 'Europe', 'Europe', 'Europe/Brussels'),
(363, 'Europe', 'Europe', 'Europe/Bucharest'),
(364, 'Europe', 'Europe', 'Europe/Budapest'),
(365, 'Europe', 'Europe', 'Europe/Chisinau'),
(366, 'Europe', 'Europe', 'Europe/Copenhagen'),
(367, 'Europe', 'Europe', 'Europe/Dublin'),
(368, 'Europe', 'Europe', 'Europe/Gibraltar'),
(369, 'Europe', 'Europe', 'Europe/Guernsey'),
(370, 'Europe', 'Europe', 'Europe/Helsinki'),
(371, 'Europe', 'Europe', 'Europe/Isle_of_Man'),
(372, 'Europe', 'Europe', 'Europe/Istanbul'),
(373, 'Europe', 'Europe', 'Europe/Jersey'),
(374, 'Europe', 'Europe', 'Europe/Kaliningrad'),
(375, 'Europe', 'Europe', 'Europe/Kiev'),
(376, 'Europe', 'Europe', 'Europe/Lisbon'),
(377, 'Europe', 'Europe', 'Europe/Ljubljana'),
(378, 'Europe', 'Europe', 'Europe/London'),
(379, 'Europe', 'Europe', 'Europe/Luxembourg'),
(380, 'Europe', 'Europe', 'Europe/Madrid'),
(381, 'Europe', 'Europe', 'Europe/Malta'),
(382, 'Europe', 'Europe', 'Europe/Mariehamn'),
(383, 'Europe', 'Europe', 'Europe/Minsk'),
(384, 'Europe', 'Europe', 'Europe/Monaco'),
(385, 'Europe', 'Europe', 'Europe/Moscow'),
(386, 'Europe', 'Europe', 'Europe/Nicosia'),
(387, 'Europe', 'Europe', 'Europe/Oslo'),
(388, 'Europe', 'Europe', 'Europe/Paris'),
(389, 'Europe', 'Europe', 'Europe/Podgorica'),
(390, 'Europe', 'Europe', 'Europe/Prague'),
(391, 'Europe', 'Europe', 'Europe/Riga'),
(392, 'Europe', 'Europe', 'Europe/Rome'),
(393, 'Europe', 'Europe', 'Europe/Samara'),
(394, 'Europe', 'Europe', 'Europe/San_Marino'),
(395, 'Europe', 'Europe', 'Europe/Sarajevo'),
(396, 'Europe', 'Europe', 'Europe/Simferopol'),
(397, 'Europe', 'Europe', 'Europe/Skopje'),
(398, 'Europe', 'Europe', 'Europe/Sofia'),
(399, 'Europe', 'Europe', 'Europe/Stockholm'),
(400, 'Europe', 'Europe', 'Europe/Tallinn'),
(401, 'Europe', 'Europe', 'Europe/Tirane'),
(402, 'Europe', 'Europe', 'Europe/Tiraspol'),
(403, 'Europe', 'Europe', 'Europe/Uzhgorod'),
(404, 'Europe', 'Europe', 'Europe/Vaduz'),
(405, 'Europe', 'Europe', 'Europe/Vatican'),
(406, 'Europe', 'Europe', 'Europe/Vienna'),
(407, 'Europe', 'Europe', 'Europe/Vilnius'),
(408, 'Europe', 'Europe', 'Europe/Volgograd'),
(409, 'Europe', 'Europe', 'Europe/Warsaw'),
(410, 'Europe', 'Europe', 'Europe/Zagreb'),
(411, 'Europe', 'Europe', 'Europe/Zaporozhye'),
(412, 'Europe', 'Europe', 'Europe/Zurich'),
(413, 'Indien', 'Indian', 'Indian/Antananarivo'),
(414, 'Indien', 'Indian', 'Indian/Chagos'),
(415, 'Indien', 'Indian', 'Indian/Christmas'),
(416, 'Indien', 'Indian', 'Indian/Cocos'),
(417, 'Indien', 'Indian', 'Indian/Comoro'),
(418, 'Indien', 'Indian', 'Indian/Kerguelen'),
(419, 'Indien', 'Indian', 'Indian/Mahe'),
(420, 'Indien', 'Indian', 'Indian/Maldives'),
(421, 'Indien', 'Indian', 'Indian/Mauritius'),
(422, 'Indien', 'Indian', 'Indian/Mayotte'),
(423, 'Indien', 'Indian', 'Indian/Reunion'),
(424, 'Pacifique', 'Pacific', 'Pacific/Apia'),
(425, 'Pacifique', 'Pacific', 'Pacific/Auckland'),
(426, 'Pacifique', 'Pacific', 'Pacific/Chatham'),
(427, 'Pacifique', 'Pacific', 'Pacific/Chuuk'),
(428, 'Pacifique', 'Pacific', 'Pacific/Easter'),
(429, 'Pacifique', 'Pacific', 'Pacific/Efate'),
(430, 'Pacifique', 'Pacific', 'Pacific/Enderbury'),
(431, 'Pacifique', 'Pacific', 'Pacific/Fakaofo'),
(432, 'Pacifique', 'Pacific', 'Pacific/Fiji'),
(433, 'Pacifique', 'Pacific', 'Pacific/Funafuti'),
(434, 'Pacifique', 'Pacific', 'Pacific/Galapagos'),
(435, 'Pacifique', 'Pacific', 'Pacific/Gambier'),
(436, 'Pacifique', 'Pacific', 'Pacific/Guadalcanal'),
(437, 'Pacifique', 'Pacific', 'Pacific/Guam'),
(438, 'Pacifique', 'Pacific', 'Pacific/Honolulu'),
(439, 'Pacifique', 'Pacific', 'Pacific/Johnston'),
(440, 'Pacifique', 'Pacific', 'Pacific/Kiritimati'),
(441, 'Pacifique', 'Pacific', 'Pacific/Kosrae'),
(442, 'Pacifique', 'Pacific', 'Pacific/Kwajalein'),
(443, 'Pacifique', 'Pacific', 'Pacific/Majuro'),
(444, 'Pacifique', 'Pacific', 'Pacific/Marquesas'),
(445, 'Pacifique', 'Pacific', 'Pacific/Midway'),
(446, 'Pacifique', 'Pacific', 'Pacific/Nauru'),
(447, 'Pacifique', 'Pacific', 'Pacific/Niue'),
(448, 'Pacifique', 'Pacific', 'Pacific/Norfolk'),
(449, 'Pacifique', 'Pacific', 'Pacific/Noumea'),
(450, 'Pacifique', 'Pacific', 'Pacific/Pago_Pago'),
(451, 'Pacifique', 'Pacific', 'Pacific/Palau'),
(452, 'Pacifique', 'Pacific', 'Pacific/Pitcairn'),
(453, 'Pacifique', 'Pacific', 'Pacific/Pohnpei'),
(454, 'Pacifique', 'Pacific', 'Pacific/Ponape'),
(455, 'Pacifique', 'Pacific', 'Pacific/Port_Moresby'),
(456, 'Pacifique', 'Pacific', 'Pacific/Rarotonga'),
(457, 'Pacifique', 'Pacific', 'Pacific/Saipan'),
(458, 'Pacifique', 'Pacific', 'Pacific/Samoa'),
(459, 'Pacifique', 'Pacific', 'Pacific/Tahiti'),
(460, 'Pacifique', 'Pacific', 'Pacific/Tarawa'),
(461, 'Pacifique', 'Pacific', 'Pacific/Tongatapu'),
(462, 'Pacifique', 'Pacific', 'Pacific/Truk'),
(463, 'Pacifique', 'Pacific', 'Pacific/Wake'),
(464, 'Pacifique', 'Pacific', 'Pacific/Wallis'),
(465, 'Pacifique', 'Pacific', 'Pacific/Yap'),
(466, 'Autres', 'Other', 'Brazil/Acre'),
(467, 'Autres', 'Other', 'Brazil/DeNoronha'),
(468, 'Autres', 'Other', 'Brazil/East'),
(469, 'Autres', 'Other', 'Brazil/West'),
(470, 'Autres', 'Other', 'CET'),
(471, 'Autres', 'Other', 'CST6CDT'),
(472, 'Autres', 'Other', 'Canada/Atlantic'),
(473, 'Autres', 'Other', 'Canada/Central'),
(474, 'Autres', 'Other', 'Canada/East-Saskatchewan'),
(475, 'Autres', 'Other', 'Canada/Eastern'),
(476, 'Autres', 'Other', 'Canada/Mountain'),
(477, 'Autres', 'Other', 'Canada/Newfoundland'),
(478, 'Autres', 'Other', 'Canada/Pacific'),
(479, 'Autres', 'Other', 'Canada/Saskatchewan'),
(480, 'Autres', 'Other', 'Canada/Yukon'),
(481, 'Autres', 'Other', 'Chile/Continental'),
(482, 'Autres', 'Other', 'Chile/EasterIsland'),
(483, 'Autres', 'Other', 'Cuba'),
(484, 'Autres', 'Other', 'EET'),
(485, 'Autres', 'Other', 'EST'),
(486, 'Autres', 'Other', 'EST5EDT'),
(487, 'Autres', 'Other', 'Egypt'),
(488, 'Autres', 'Other', 'Eire'),
(489, 'Autres', 'Other', 'Etc/GMT'),
(490, 'Autres', 'Other', 'Etc/GMT+0'),
(491, 'Autres', 'Other', 'Etc/GMT+1'),
(492, 'Autres', 'Other', 'Etc/GMT+10'),
(493, 'Autres', 'Other', 'Etc/GMT+11'),
(494, 'Autres', 'Other', 'Etc/GMT+12'),
(495, 'Autres', 'Other', 'Etc/GMT+2'),
(496, 'Autres', 'Other', 'Etc/GMT+3'),
(497, 'Autres', 'Other', 'Etc/GMT+4'),
(498, 'Autres', 'Other', 'Etc/GMT+5'),
(499, 'Autres', 'Other', 'Etc/GMT+6'),
(500, 'Autres', 'Other', 'Etc/GMT+7'),
(501, 'Autres', 'Other', 'Etc/GMT+8'),
(502, 'Autres', 'Other', 'Etc/GMT+9'),
(503, 'Autres', 'Other', 'Etc/GMT-0'),
(504, 'Autres', 'Other', 'Etc/GMT-1'),
(505, 'Autres', 'Other', 'Etc/GMT-10'),
(506, 'Autres', 'Other', 'Etc/GMT-11'),
(507, 'Autres', 'Other', 'Etc/GMT-12'),
(508, 'Autres', 'Other', 'Etc/GMT-13'),
(509, 'Autres', 'Other', 'Etc/GMT-14'),
(510, 'Autres', 'Other', 'Etc/GMT-2'),
(511, 'Autres', 'Other', 'Etc/GMT-3'),
(512, 'Autres', 'Other', 'Etc/GMT-4'),
(513, 'Autres', 'Other', 'Etc/GMT-5'),
(514, 'Autres', 'Other', 'Etc/GMT-6'),
(515, 'Autres', 'Other', 'Etc/GMT-7'),
(516, 'Autres', 'Other', 'Etc/GMT-8'),
(517, 'Autres', 'Other', 'Etc/GMT-9'),
(518, 'Autres', 'Other', 'Etc/GMT0'),
(519, 'Autres', 'Other', 'Etc/Greenwich'),
(520, 'Autres', 'Other', 'Etc/UCT'),
(521, 'Autres', 'Other', 'Etc/UTC'),
(522, 'Autres', 'Other', 'Etc/Universal'),
(523, 'Autres', 'Other', 'Etc/Zulu'),
(524, 'Autres', 'Other', 'GB'),
(525, 'Autres', 'Other', 'GB-Eire'),
(526, 'Autres', 'Other', 'GMT'),
(527, 'Autres', 'Other', 'GMT+0'),
(528, 'Autres', 'Other', 'GMT-0'),
(529, 'Autres', 'Other', 'GMT0'),
(530, 'Autres', 'Other', 'Greenwich'),
(531, 'Autres', 'Other', 'HST'),
(532, 'Autres', 'Other', 'Hongkong'),
(533, 'Autres', 'Other', 'Iceland'),
(534, 'Autres', 'Other', 'Iran'),
(535, 'Autres', 'Other', 'Israel'),
(536, 'Autres', 'Other', 'Jamaica'),
(537, 'Autres', 'Other', 'Japan'),
(538, 'Autres', 'Other', 'Kwajalein'),
(539, 'Autres', 'Other', 'Libya'),
(540, 'Autres', 'Other', 'MET'),
(541, 'Autres', 'Other', 'MST'),
(542, 'Autres', 'Other', 'MST7MDT'),
(543, 'Autres', 'Other', 'Mexico/BajaNorte'),
(544, 'Autres', 'Other', 'Mexico/BajaSur'),
(545, 'Autres', 'Other', 'Mexico/General'),
(546, 'Autres', 'Other', 'NZ'),
(547, 'Autres', 'Other', 'NZ-CHAT'),
(548, 'Autres', 'Other', 'Navajo'),
(549, 'Autres', 'Other', 'PRC'),
(550, 'Autres', 'Other', 'PST8PDT'),
(551, 'Autres', 'Other', 'Poland'),
(552, 'Autres', 'Other', 'Portugal'),
(553, 'Autres', 'Other', 'ROC'),
(554, 'Autres', 'Other', 'ROK'),
(555, 'Autres', 'Other', 'Singapore'),
(556, 'Autres', 'Other', 'Turkey'),
(557, 'Autres', 'Other', 'UCT'),
(558, 'Autres', 'Other', 'US/Alaska'),
(559, 'Autres', 'Other', 'US/Aleutian'),
(560, 'Autres', 'Other', 'US/Arizona'),
(561, 'Autres', 'Other', 'US/Central'),
(562, 'Autres', 'Other', 'US/East-Indiana'),
(563, 'Autres', 'Other', 'US/Eastern'),
(564, 'Autres', 'Other', 'US/Hawaii'),
(565, 'Autres', 'Other', 'US/Indiana-Starke'),
(566, 'Autres', 'Other', 'US/Michigan'),
(567, 'Autres', 'Other', 'US/Mountain'),
(568, 'Autres', 'Other', 'US/Pacific'),
(569, 'Autres', 'Other', 'US/Pacific-New'),
(570, 'Autres', 'Other', 'US/Samoa'),
(571, 'Autres', 'Other', 'UTC'),
(572, 'Autres', 'Other', 'Universal'),
(573, 'Autres', 'Other', 'W-SU'),
(574, 'Autres', 'Other', 'WET'),
(575, 'Autres', 'Other', 'Zulu');

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
  PRIMARY KEY (`id`),
  KEY `produit_id` (`produit_id`,`plat_id`),
  KEY `plat_id` (`plat_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=359 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_accompagnement`
--

INSERT INTO `t_accompagnement` (`id`, `produit_id`, `designation`, `unite`, `quantite`, `plat_id`, `hotel_id`) VALUES
(1, 83, 'Bako', 'piece', 1, 103, 328),
(2, 75, 'Fanta', 'piece', 1, 103, 328),
(7, 146, 'Arachides', 'piece', 1, 365, 356),
(8, 146, 'Arachides', 'piece', 1, 366, 356),
(145, 160, 'Chikwange', 'piece', 1, 322, 356),
(146, 263, 'Riz', 'piece', 1, 322, 356),
(147, 224, 'Makemba main', 'piece', 1, 322, 356),
(148, 196, 'Fufu', 'Ekolo', 1, 322, 356),
(149, 259, 'Pommes de terre', 'piece', 1, 322, 356),
(150, 374, 'Pomme sautee', 'Portion', 1, 322, 356),
(151, 194, 'Frites', 'piece', 1, 322, 356),
(167, 160, 'Chikwange', 'piece', 1, 361, 356),
(168, 263, 'Riz', 'piece', 1, 361, 356),
(169, 224, 'Makemba main', 'piece', 1, 361, 356),
(170, 196, 'Fufu', 'Ekolo', 1, 361, 356),
(171, 259, 'Pommes de terre', 'piece', 1, 361, 356),
(172, 374, 'Pomme sautee', 'Portion', 1, 361, 356),
(173, 194, 'Frites', 'piece', 1, 361, 356),
(174, 160, 'Chikwange', 'piece', 1, 363, 356),
(175, 263, 'Riz', 'piece', 1, 363, 356),
(176, 224, 'Makemba main', 'piece', 1, 363, 356),
(177, 196, 'Fufu', 'Ekolo', 1, 363, 356),
(178, 259, 'Pommes de terre', 'piece', 1, 363, 356),
(179, 374, 'Pomme sautee', 'Portion', 1, 363, 356),
(180, 194, 'Frites', 'piece', 1, 363, 356),
(196, 160, 'Chikwange', 'piece', 1, 303, 356),
(197, 263, 'Riz', 'piece', 1, 303, 356),
(198, 224, 'Makemba main', 'piece', 1, 303, 356),
(199, 196, 'Fufu', 'Ekolo', 1, 303, 356),
(200, 259, 'Pommes de terre', 'piece', 1, 303, 356),
(201, 374, 'Pomme sautee', 'Portion', 1, 303, 356),
(202, 194, 'Frites', 'piece', 1, 303, 356),
(203, 160, 'Chikwange', 'piece', 1, 299, 356),
(204, 263, 'Riz', 'piece', 1, 299, 356),
(205, 224, 'Makemba main', 'piece', 1, 299, 356),
(206, 196, 'Fufu', 'Ekolo', 1, 299, 356),
(207, 259, 'Pommes de terre', 'piece', 1, 299, 356),
(208, 374, 'Pomme sautee', 'Portion', 1, 299, 356),
(209, 194, 'Frites', 'piece', 1, 299, 356),
(246, 160, 'Chikwange', 'piece', 1, 385, 356),
(247, 224, 'Makemba main', 'piece', 1, 385, 356),
(248, 196, 'Fufu', 'Ekolo', 1, 385, 356),
(249, 259, 'Pommes de terre', 'piece', 1, 385, 356),
(250, 374, 'Pomme sautee', 'Portion', 1, 385, 356),
(297, 386, 'Pommes sautee', 'Portion', 1, 289, 356),
(299, 386, 'Pommes sautee', 'Portion', 1, 292, 356),
(301, 386, 'Pommes sautee', 'Portion', 1, 369, 356),
(303, 386, 'Pommes sautee', 'Portion', 1, 367, 356),
(305, 386, 'Pommes sautee', 'Portion', 1, 368, 356),
(306, 160, 'Chikwange', 'piece', 1, 383, 356),
(307, 263, 'Riz', 'piece', 1, 383, 356),
(308, 259, 'Pommes de terre', 'piece', 1, 383, 356),
(309, 224, 'Makemba main', 'piece', 1, 383, 356),
(310, 386, 'Pommes sautee', 'Portion', 1, 383, 356),
(311, 386, 'Pommes sautee', 'Portion', 1, 297, 356),
(312, 386, 'Pommes sautee', 'Portion', 1, 382, 356),
(313, 386, 'Pommes sautee', 'Portion', 1, 384, 356),
(320, 160, 'Chikwange', 'piece', 1, 359, 356),
(321, 263, 'Riz', 'piece', 1, 359, 356),
(322, 224, 'Makemba main', 'piece', 1, 359, 356),
(323, 259, 'Pommes de terre', 'piece', 1, 359, 356),
(324, 194, 'Frites', 'piece', 1, 359, 356),
(325, 386, 'Pommes sautee', 'Portion', 1, 359, 356),
(344, 386, 'Pommes sautee', 'Portion', 1, 364, 356),
(345, 160, 'Chikwange', 'piece', 1, 357, 356),
(346, 160, 'Chikwange', 'piece', 1, 304, 356),
(347, 263, 'Riz', 'piece', 1, 304, 356),
(348, 224, 'Makemba main', 'piece', 1, 304, 356),
(349, 259, 'Pommes de terre', 'piece', 1, 304, 356),
(350, 194, 'Frites', 'piece', 1, 304, 356),
(351, 160, 'Chikwange', 'piece', 1, 392, 356),
(352, 194, 'Frites', 'piece', 1, 311, 356),
(353, 160, 'Chikwange', 'piece', 1, 300, 356),
(354, 263, 'Riz', 'piece', 1, 300, 356),
(355, 224, 'Makemba main', 'piece', 1, 300, 356),
(356, 259, 'Pommes de terre', 'piece', 1, 300, 356),
(357, 194, 'Frites', 'piece', 1, 300, 356),
(358, 386, 'Pommes sautee', 'Portion', 1, 300, 356);

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

INSERT INTO `t_chambre` (`id_ch`, `num_ch`, `etat_ch`, `tarif_ch`, `monnaie`, `reserve`, `occupe`, `libre`, `capacite_init`, `capacite`, `categorie`, `niveau`, `id_hotel`, `del`) VALUES
(20, '01', 'propre', '50000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 11, NULL, 328, 0),
(21, '02', 'propre', '25000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 9, NULL, 328, 0),
(22, '03', 'propre', '100000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 11, NULL, 328, 0),
(23, '04', 'propre', '150000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 11, NULL, 328, 0),
(24, '05', 'propre', '80000.0000000000', 'CDF', '', '', 'oui', 0, NULL, 9, NULL, 328, 0),
(25, 'Buanderie', 'propre', '10.0000000000', 'USD', '', '', 'non', 0, NULL, 11, NULL, 328, 0),
(26, 'Location vehicule', 'propre', '5.0000000000', 'USD', '', '', 'non', 0, NULL, 11, NULL, 328, 0);

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
  PRIMARY KEY (`id`),
  KEY `idreserv` (`idres_ch`,`idchambre`),
  KEY `idchambre` (`idchambre`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_chambre_histo`
--

INSERT INTO `t_chambre_histo` (`id`, `idres_ch`, `idchambre`, `statut`, `date_occ`, `date_lib`, `tarif_ch`, `qte`, `monnaie`, `paie`, `reserve`, `occupe`, `libre`, `hr_in`, `hr_out`) VALUES
(48, 43, 20, 'libre', '2019-12-14', '2019-12-17', '50000.0000000000', 4, 'CDF', 1, 0, 1, 1, NULL, '16:18:01'),
(49, 44, 20, 'libre', '2019-12-17', '2019-12-19', '50000.0000000000', 3, 'CDF', 1, 0, 1, 1, NULL, '16:28:00'),
(50, 45, 20, 'occupe', '2019-12-10', '2019-12-11', '50000.0000000000', 1, 'CDF', 1, 0, 1, 0, NULL, NULL),
(51, 46, 21, 'occupe', '2019-12-11', '2019-12-12', '25000.0000000000', 1, 'CDF', 1, 0, 1, 0, NULL, NULL),
(52, 47, 22, 'libre', '2019-12-11', '2019-12-11', '100000.0000000000', 1, 'CDF', 1, 0, 1, 1, NULL, '16:16:05'),
(53, 48, 22, 'occupe', '2019-12-11', '2019-12-12', '100000.0000000000', 1, 'CDF', 1, 0, 1, 0, NULL, NULL),
(54, 49, 23, 'occupe', '2019-12-11', '2019-12-12', '150000.0000000000', 1, 'CDF', 1, 0, 1, 0, NULL, NULL);

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
  PRIMARY KEY (`id_client`),
  KEY `id_respo` (`id_respo`),
  KEY `id_hotel` (`id_hotel`),
  KEY `id_sousresto` (`id_sousresto`),
  KEY `id_sous_compte` (`id_sous_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=1927 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_client`
--

INSERT INTO `t_client` (`id_client`, `code`, `designation`, `nom_client`, `date_naiss_client`, `sexe_client`, `etat_civil_client`, `nationalite_client`, `provenance_client`, `num_piece_identite_client`, `num_passeport_client`, `adresse_provenance_client`, `email_client`, `telephone_client`, `num_pers_contacter_client`, `statut`, `pseudo_supp`, `en_attente`, `type`, `type_cl`, `id_respo`, `id_hotel`, `nom_entreprise`, `id_sousresto`, `id_sous_compte`, `user_attente`, `nbrcouvert`, `idsousdepotfact`) VALUES
(1814, NULL, NULL, 'Occasionnel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'occasionnel', NULL, NULL, 356, NULL, NULL, NULL, NULL, 1, NULL),
(1825, 'T001', 'G1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1826, ' T002', 'G2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1827, ' T003', 'G3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1828, ' T004', 'G4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 1, 121),
(1829, ' T005', 'G5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 1, 121),
(1830, ' T006', 'G6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 1, 121),
(1831, ' T007', 'G7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 475, 1, 121),
(1832, 'T008', 'GAZ-T8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 1, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 475, 1, 121),
(1833, ' T009', ' G9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 475, 1, 121),
(1834, ' T010', ' G10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 475, 1, 121),
(1835, ' T011', 'G11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, 121),
(1836, 'T008', 'G8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1838, 'T012', 'G12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1839, ' T013', 'G13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1840, 'T014', 'G14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1841, ' T015', 'G15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1842, ' T016', ' G16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1843, ' T017', 'G17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1844, ' T039', 'TRS-9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 1, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1845, ' T019', 'G19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1846, ' T020', 'G20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1847, 'T021', 'G21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1848, ' T022', 'G22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1849, ' T023', 'G23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1850, ' T024', 'G24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1851, ' T025', 'G25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1852, ' T026', 'G26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1853, ' T027', 'G27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 0, 121),
(1854, ' T028', 'G28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1855, 'T029', 'G29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1856, ' T030', 'G30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1857, 'T031', 'T1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1858, ' T032', 'T2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1859, ' T033', 'T3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1860, ' T034', 'T4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1861, ' T035', 'T5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 1, 121),
(1862, ' T036', 'T6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1863, ' T037', ' T7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1864, ' T038', 'T8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 8, 121),
(1865, ' T039', 'T9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1866, ' T040', 'T10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1867, ' T041', 'T11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1868, 'T042', ' T12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1869, ' T043', 'T13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1870, 'T044', 'T14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1871, ' T045', 'T15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1872, ' T046', 'T16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1873, ' T047', 'T17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1874, ' T048', 'T18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1875, ' T049', 'T19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1876, ' T050', 'T20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1877, 'T051', 'TO1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1878, ' T052', 'TO2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1879, ' T053', 'TO3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1880, ' T054', 'TO4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1881, ' T055', 'TO5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1882, ' T056', 'TO6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 1, 121),
(1883, ' T057', 'TO7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, 121),
(1884, ' T058', 'TO8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1885, 'T059', 'TO9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1886, ' T060', 'TO10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1887, ' T061', 'TO11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1888, ' T062', 'TO12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1889, ' T063', 'TO13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1890, ' T064', 'TO14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1891, ' T065', 'TO15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1892, ' T066', 'TO16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1893, ' T067', 'TO17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1894, ' T068', 'TO18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1895, ' T069', 'TO19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1896, ' T070', 'TO20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1897, 'T071', 'B1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1898, 'T072', 'B2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1899, ' T073', 'B3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1900, ' T074', 'B4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1901, ' T075', 'B5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1902, ' T076', 'B6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1903, ' T077', 'B7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, 1, 121),
(1904, ' T080', ' B10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1905, 'CHT001', 'CHEF-T1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', '1', NULL, 356, NULL, 123, NULL, 0, 1, NULL),
(1906, 'CHT002', 'CHEF-T2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', '1', NULL, 356, NULL, 123, NULL, NULL, 1, NULL),
(1907, 'T001', 'G1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'libre', 0, 0, 'table', NULL, NULL, 356, NULL, 123, NULL, NULL, NULL, NULL),
(1908, NULL, NULL, 'Alain Piedboeuf', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'alain', '+243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, 121),
(1909, NULL, NULL, ' Madame GRACIELLA', NULL, 'feminin', NULL, NULL, NULL, NULL, NULL, NULL, ' ', ' +24', NULL, NULL, 1, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, NULL),
(1910, NULL, NULL, 'Madame GRACIELLA', NULL, 'feminin', NULL, NULL, NULL, NULL, NULL, NULL, 'mgraciella', '+243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, 1, NULL),
(1911, NULL, NULL, ' M. Marc', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, ' marc', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, 1, 121),
(1912, NULL, NULL, ' Mme. Brigitte Piedboeuf', NULL, 'feminin', NULL, NULL, NULL, NULL, NULL, NULL, ' bPiedboeuf', ' +243', NULL, NULL, 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, NULL),
(1913, NULL, NULL, ' Terry  Wancket', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'terry ', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, 475, 1, 121),
(1914, NULL, NULL, 'M. Renato', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, ' renato', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, 121),
(1915, NULL, NULL, 'Madame Grace', NULL, 'feminin', NULL, NULL, NULL, NULL, NULL, NULL, ' grace', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, 121),
(1916, NULL, NULL, 'Madame Mariana', NULL, 'feminin', NULL, NULL, NULL, NULL, NULL, NULL, 'mariana', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, 121),
(1917, NULL, NULL, ' M. Jacot', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'jacot', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, 1, 121),
(1918, NULL, NULL, ' M. Papy', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'papy', ' +243', NULL, NULL, 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, NULL),
(1919, NULL, NULL, ' M. Chrispin', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'crispin', ' +243', NULL, NULL, 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, 1, NULL),
(1920, NULL, NULL, ' Sud Africain', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'sudaf', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, 121),
(1921, NULL, NULL, ' M. Mika', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'MIKA', ' +243', NULL, NULL, 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, NULL),
(1922, NULL, NULL, ' M. Olivier', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'olivier', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, 1, NULL),
(1923, NULL, NULL, ' M. Benfika', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'benfika', ' +243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, 121),
(1924, NULL, NULL, ' M. Mimy', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, ' mimy', ' +243', NULL, NULL, 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, NULL),
(1925, NULL, NULL, 'M. Gommaire', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'gommaire', '+243', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, 1, NULL),
(1926, NULL, NULL, 'GAZEBO', NULL, 'masculin', NULL, NULL, NULL, NULL, NULL, NULL, 'gazebo@gmail.com', '081', NULL, 'libre', 0, 0, 'client', 'restaurant', NULL, 356, NULL, NULL, NULL, NULL, NULL, NULL);

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
  PRIMARY KEY (`id_c`),
  KEY `id_c` (`id_c`)
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_company`
--

INSERT INTO `t_company` (`id_c`, `nom_c`, `etat`, `adresse_c`, `logo`, `idnat`, `rccm`, `mail_company`, `ville`, `phone`, `num_impot`, `cb`, `mention`) VALUES
(299, 'GAZEBO', 1, 'COmmune N\'sele', '', '1445', '12333', 'gazebo@gmail.com', 'Kinshasa', '0853533438', '7777', NULL, NULL);

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
  PRIMARY KEY (`id_depot`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_depot`
--

INSERT INTO `t_depot` (`id_depot`, `libelle`, `pseudo_sup`, `hotel_id`) VALUES
(121, 'LE GAZEBO', 0, 356),
(123, 'Central', 0, 356);

-- --------------------------------------------------------

--
-- Structure de la table `t_droit`
--

DROP TABLE IF EXISTS `t_droit`;
CREATE TABLE IF NOT EXISTS `t_droit` (
  `id_droit` int(10) NOT NULL AUTO_INCREMENT,
  `droit` varchar(15) NOT NULL,
  `libe_droit` varchar(20) NOT NULL,
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
  KEY `session_id_2` (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_facture`
--

INSERT INTO `t_facture` (`id_fact`, `num_fact`, `num_cmd`, `type`, `i_souscription`, `etat`, `etat_cmd`, `etat_sousresto`, `date_echeance_old`, `date_edition`, `dte_blocage`, `date_echeance`, `date_desactivation`, `montant_total`, `mont_tva`, `mont_ttc`, `mont_ttc_remise`, `taux`, `taux_prix`, `tva`, `monnaie`, `remise`, `majoration`, `justification`, `id_res`, `res_ch_id`, `modulecompagny`, `id_hotel`, `id_sousresto`, `company_id`, `id_user`, `id_client`, `fact1`, `mode`, `dte_time`, `date_approbation`, `statut_bon`, `souscription_id`, `assujetti`, `heb`, `montpenalite`, `montremb`, `tauxremb`, `montpaie`, `session_id`, `cuisine`, `preparer`, `nbrcouvert`, `nomcaisse`, `fusion`, `solde`) VALUES
(286, '00554', NULL, 'restaurant', 0, '0', '0', 0, NULL, '2020-06-02', NULL, NULL, NULL, '0.0000000000', '0.0000000000', '575808750.0000000000', '0.0000000000', 1650, 1.00, NULL, 'USD', NULL, NULL, NULL, NULL, NULL, NULL, 356, 123, 299, 476, NULL, 2, NULL, '2020-06-02 15:26:18', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 0, 0, NULL, NULL, 1, 0),
(291, '00559', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2020-06-04', NULL, NULL, NULL, '26.4600000000', '8316.0000000000', '31.5000000000', '0.0000000000', 1650, 1650.00, 16, 'USD', 0.00, NULL, NULL, 287, NULL, NULL, 356, 123, 299, 475, 1915, 2, 'Cash', '2020-06-04 13:29:56', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 1, 'Caisse ', 0, 0),
(292, '00560', NULL, 'restaurant', 0, '2', '0', 0, NULL, '2020-06-04', NULL, NULL, NULL, '16.8000000000', '5280.0000000000', '20.0000000000', '0.0000000000', 1650, 1650.00, 16, 'USD', 0.00, NULL, NULL, 288, NULL, NULL, 356, 123, 299, 475, 1915, 2, 'Cash', '2020-06-04 13:35:52', NULL, NULL, NULL, 1, 1, '0.0000000000', '0.0000000000', 1, '0.0000000000', NULL, 1, 0, 1, 'Caisse ', 0, 0);

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
  PRIMARY KEY (`id_hotel`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_hotel`
--

INSERT INTO `t_hotel` (`id_hotel`, `nom_hotel`, `adresse_hotel`, `province_hotel`, `ville_hotel`, `etat`, `default_site`, `company_id`, `statut_site`, `idnat`, `rccm`, `mail`, `phone`, `num_impot`, `cb`, `image`, `nbre_user`, `nbre_user_add`, `state_paie_user`, `pointage`, `activite`) VALUES
(271, 'ntc_2014', '', '', '', 0, 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, ''),
(356, 'PARC DE LA VALLEE DE LA N\'SELE', 'COmmune N\'sele', '', 'Kinshasa', 1, 1, 299, 'opÃ©rationnel', '1445', '12333', 'gazebo@gmail.com', '0853533438', '7777', NULL, '', 10, NULL, 0, 0, NULL);

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
  `plat_id` int(10) NOT NULL,
  `hotel_id` int(10) NOT NULL,
  PRIMARY KEY (`id_ingred`),
  KEY `produit_id` (`produit_id`,`plat_id`),
  KEY `plat_id` (`plat_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_ingredient`
--

INSERT INTO `t_ingredient` (`id_ingred`, `produit_id`, `designation`, `unite`, `quantite`, `plat_id`, `hotel_id`) VALUES
(26, 75, 'Fanta', 'piece', 1, 82, 328),
(30, 85, 'Mutzig', 'piece', 4, 81, 328),
(31, 76, 'Maltina', 'piece', 4, 81, 328),
(32, 83, 'Bako', 'piece', 2, 80, 328),
(33, 75, 'Fanta', 'piece', 1, 80, 328),
(36, 2024, 'Bonbons', 'g', 100, 2025, 356),
(37, 224, 'Makemba main', 'piece', 1, 365, 356),
(38, 145, 'Ananas', 'piece', 1, 366, 356);

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
  `lib` varchar(20) NOT NULL,
  PRIMARY KEY (`id_mode_regl`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_mode_reglement`
--

INSERT INTO `t_mode_reglement` (`id_mode_regl`, `lib`) VALUES
(1, 'Don'),
(2, 'Cash'),
(3, 'Credit');

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

INSERT INTO `t_modulecompany` (`id`, `nbreuser`, `nbre_user_maj`, `etat_module`, `paye`, `montantmodule`, `prix_id`, `pack_id`, `company_id`, `module_id`, `souscription_id`, `date_sous`, `date_activ`, `date_echeance`, `dte_blocage`, `site_id`, `nbre_agent`) VALUES
(447, 0, 0, 1, 0, 0, 9, 197, 283, 28, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0),
(448, 0, 0, 1, 0, 0, 9, 197, 283, 23, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0),
(449, 0, 0, 1, 0, 0, 9, 197, 283, 22, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0),
(450, 0, 0, 1, 0, 0, 9, 197, 283, 24, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0),
(451, 0, 0, 1, 0, 0, 9, 197, 283, 21, 171, '2019-02-26', '0000-00-00', NULL, NULL, 328, 0),
(515, 0, 0, 1, 0, 0, 11, 224, 298, 28, 198, '2019-12-11', NULL, NULL, NULL, 355, 0),
(516, 0, 0, 1, 0, 0, 11, 224, 298, 22, 198, '2019-12-11', NULL, NULL, NULL, 355, 0),
(517, 0, 0, 1, 0, 0, 11, 224, 298, 24, 198, '2019-12-11', NULL, NULL, NULL, 355, 0),
(518, 0, 0, 1, 0, 0, 11, 225, 299, 28, 199, '2019-12-11', NULL, NULL, NULL, 356, 0),
(519, 0, 0, 1, 0, 0, 11, 225, 299, 22, 199, '2019-12-11', NULL, NULL, NULL, 356, 0),
(520, 0, 0, 1, 0, 0, 11, 225, 299, 24, 199, '2019-12-11', NULL, NULL, NULL, 356, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_module_pack`
--

DROP TABLE IF EXISTS `t_module_pack`;
CREATE TABLE IF NOT EXISTS `t_module_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pack_id` (`pack_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_module_pack`
--

INSERT INTO `t_module_pack` (`id`, `module_id`, `pack_id`) VALUES
(1, 21, 1),
(2, 23, 4),
(3, 26, 7),
(4, 24, 2),
(5, 28, 5),
(7, 22, 5),
(8, 24, 5),
(9, 28, 6),
(11, 23, 6),
(12, 22, 6),
(13, 24, 6),
(14, 28, 30),
(16, 29, 30),
(17, 24, 30),
(18, 27, 29),
(20, 24, 29),
(21, 28, 29),
(23, 21, 6);

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
  PRIMARY KEY (`idmotif`),
  KEY `hotel_id` (`hotel_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1230 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_motif`
--

INSERT INTO `t_motif` (`idmotif`, `designation`, `sorte`, `hotel_id`, `type_id`) VALUES
(1172, 'Hebergement', NULL, 328, 940),
(1173, 'Vente', NULL, 328, 941),
(1174, 'Hebergement', NULL, 329, 944),
(1175, 'Vente', NULL, 329, 945),
(1176, 'Hebergement', NULL, 330, 948),
(1177, 'Vente', NULL, 330, 949),
(1178, 'Hebergement', NULL, 331, 952),
(1179, 'Vente', NULL, 331, 953),
(1180, 'Hebergement', NULL, 332, 956),
(1181, 'Vente', NULL, 332, 957),
(1182, 'Hebergement', NULL, 333, 960),
(1183, 'Vente', NULL, 333, 961),
(1184, 'Hebergement', NULL, 334, 964),
(1185, 'Vente', NULL, 334, 965),
(1186, 'Hebergement', NULL, 335, 968),
(1187, 'Vente', NULL, 335, 969),
(1188, 'Hebergement', NULL, 336, 972),
(1189, 'Vente', NULL, 336, 973),
(1190, 'Hebergement', NULL, 337, 976),
(1191, 'Vente', NULL, 337, 977),
(1192, 'Hebergement', NULL, 338, 980),
(1193, 'Vente', NULL, 338, 981),
(1194, 'Hebergement', NULL, 339, 984),
(1195, 'Vente', NULL, 339, 985),
(1196, 'Hebergement', NULL, 340, 988),
(1197, 'Vente', NULL, 340, 989),
(1198, 'Hebergement', NULL, 341, 992),
(1199, 'Vente', NULL, 341, 993),
(1200, 'Hebergement', NULL, 342, 996),
(1201, 'Vente', NULL, 342, 997),
(1202, 'Hebergement', NULL, 343, 1000),
(1203, 'Vente', NULL, 343, 1001),
(1204, 'Hebergement', NULL, 344, 1004),
(1205, 'Vente', NULL, 344, 1005),
(1206, 'Hebergement', NULL, 345, 1008),
(1207, 'Vente', NULL, 345, 1009),
(1208, 'Hebergement', NULL, 346, 1012),
(1209, 'Vente', NULL, 346, 1013),
(1210, 'Hebergement', NULL, 347, 1016),
(1211, 'Vente', NULL, 347, 1017),
(1212, 'Hebergement', NULL, 348, 1020),
(1213, 'Vente', NULL, 348, 1021),
(1214, 'Hebergement', NULL, 349, 1024),
(1215, 'Vente', NULL, 349, 1025),
(1216, 'Hebergement', NULL, 350, 1028),
(1217, 'Vente', NULL, 350, 1029),
(1218, 'Hebergement', NULL, 351, 1032),
(1219, 'Vente', NULL, 351, 1033),
(1220, 'Hebergement', NULL, 352, 1036),
(1221, 'Vente', NULL, 352, 1037),
(1222, 'Hebergement', NULL, 353, 1040),
(1223, 'Vente', NULL, 353, 1041),
(1224, 'Hebergement', NULL, 354, 1044),
(1225, 'Vente', NULL, 354, 1045),
(1226, 'Hebergement', NULL, 355, 1048),
(1227, 'Vente', NULL, 355, 1049),
(1228, 'Hebergement', NULL, 356, 1052),
(1229, 'Vente', NULL, 356, 1053);

-- --------------------------------------------------------

--
-- Structure de la table `t_motif_sortie`
--

DROP TABLE IF EXISTS `t_motif_sortie`;
CREATE TABLE IF NOT EXISTS `t_motif_sortie` (
  `id_motif_sortie` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_motif_sortie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_motif_sortie`
--

INSERT INTO `t_motif_sortie` (`id_motif_sortie`, `libelle`, `etat`) VALUES
(1, 'Vente', 1),
(2, 'Perte', 1),
(3, 'Avarie/Expire', 1),
(4, 'Casse', 1),
(5, 'Regularisation', 1),
(6, 'appro', 0),
(7, 'sortie', 0);

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
  PRIMARY KEY (`idmotiftype`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1054 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_motif_type`
--

INSERT INTO `t_motif_type` (`idmotiftype`, `type`, `visible`, `hotel_id`) VALUES
(938, 'Heberge', 1, 328),
(939, 'Resto', 1, 328),
(940, 'Entree', 0, 328),
(941, 'Sortie', 0, 328),
(942, 'Heberge', 1, 329),
(943, 'Resto', 1, 329),
(944, 'Entree', 0, 329),
(945, 'Sortie', 0, 329),
(946, 'Heberge', 1, 330),
(947, 'Resto', 1, 330),
(948, 'Entree', 0, 330),
(949, 'Sortie', 0, 330),
(950, 'Heberge', 1, 331),
(951, 'Resto', 1, 331),
(952, 'Entree', 0, 331),
(953, 'Sortie', 0, 331),
(954, 'Heberge', 1, 332),
(955, 'Resto', 1, 332),
(956, 'Entree', 0, 332),
(957, 'Sortie', 0, 332),
(958, 'Heberge', 1, 333),
(959, 'Resto', 1, 333),
(960, 'Entree', 0, 333),
(961, 'Sortie', 0, 333),
(962, 'Heberge', 1, 334),
(963, 'Resto', 1, 334),
(964, 'Entree', 0, 334),
(965, 'Sortie', 0, 334),
(966, 'Heberge', 1, 335),
(967, 'Resto', 1, 335),
(968, 'Entree', 0, 335),
(969, 'Sortie', 0, 335),
(970, 'Heberge', 1, 336),
(971, 'Resto', 1, 336),
(972, 'Entree', 0, 336),
(973, 'Sortie', 0, 336),
(974, 'Heberge', 1, 337),
(975, 'Resto', 1, 337),
(976, 'Entree', 0, 337),
(977, 'Sortie', 0, 337),
(978, 'Heberge', 1, 338),
(979, 'Resto', 1, 338),
(980, 'Entree', 0, 338),
(981, 'Sortie', 0, 338),
(982, 'Heberge', 1, 339),
(983, 'Resto', 1, 339),
(984, 'Entree', 0, 339),
(985, 'Sortie', 0, 339),
(986, 'Heberge', 1, 340),
(987, 'Resto', 1, 340),
(988, 'Entree', 0, 340),
(989, 'Sortie', 0, 340),
(990, 'Heberge', 1, 341),
(991, 'Resto', 1, 341),
(992, 'Entree', 0, 341),
(993, 'Sortie', 0, 341),
(994, 'Heberge', 1, 342),
(995, 'Resto', 1, 342),
(996, 'Entree', 0, 342),
(997, 'Sortie', 0, 342),
(998, 'Heberge', 1, 343),
(999, 'Resto', 1, 343),
(1000, 'Entree', 0, 343),
(1001, 'Sortie', 0, 343),
(1002, 'Heberge', 1, 344),
(1003, 'Resto', 1, 344),
(1004, 'Entree', 0, 344),
(1005, 'Sortie', 0, 344),
(1006, 'Heberge', 1, 345),
(1007, 'Resto', 1, 345),
(1008, 'Entree', 0, 345),
(1009, 'Sortie', 0, 345),
(1010, 'Heberge', 1, 346),
(1011, 'Resto', 1, 346),
(1012, 'Entree', 0, 346),
(1013, 'Sortie', 0, 346),
(1014, 'Heberge', 1, 347),
(1015, 'Resto', 1, 347),
(1016, 'Entree', 0, 347),
(1017, 'Sortie', 0, 347),
(1018, 'Heberge', 1, 348),
(1019, 'Resto', 1, 348),
(1020, 'Entree', 0, 348),
(1021, 'Sortie', 0, 348),
(1022, 'Heberge', 1, 349),
(1023, 'Resto', 1, 349),
(1024, 'Entree', 0, 349),
(1025, 'Sortie', 0, 349),
(1026, 'Heberge', 1, 350),
(1027, 'Resto', 1, 350),
(1028, 'Entree', 0, 350),
(1029, 'Sortie', 0, 350),
(1030, 'Heberge', 1, 351),
(1031, 'Resto', 1, 351),
(1032, 'Entree', 0, 351),
(1033, 'Sortie', 0, 351),
(1034, 'Heberge', 1, 352),
(1035, 'Resto', 1, 352),
(1036, 'Entree', 0, 352),
(1037, 'Sortie', 0, 352),
(1038, 'Heberge', 1, 353),
(1039, 'Resto', 1, 353),
(1040, 'Entree', 0, 353),
(1041, 'Sortie', 0, 353),
(1042, 'Heberge', 1, 354),
(1043, 'Resto', 1, 354),
(1044, 'Entree', 0, 354),
(1045, 'Sortie', 0, 354),
(1046, 'Heberge', 1, 355),
(1047, 'Resto', 1, 355),
(1048, 'Entree', 0, 355),
(1049, 'Sortie', 0, 355),
(1050, 'Heberge', 1, 356),
(1051, 'Resto', 1, 356),
(1052, 'Entree', 0, 356),
(1053, 'Sortie', 0, 356);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_pack`
--

INSERT INTO `t_pack` (`id`, `libelle`, `etat`) VALUES
(1, 'Caisse', 1),
(2, 'Stock', 1),
(3, 'Restaurant', 1),
(4, 'Hebergement', 1),
(5, 'EBU-Restaurant', 1),
(6, 'EBU-hotel', 1),
(7, 'Ressources humaines', 1),
(26, 'Facturation', 1),
(27, 'Achat', 1),
(28, 'Point de vente', 1),
(29, 'EBU-Facturation', 1),
(30, 'EBU-POS', 1),
(31, 'Achat utilisateur', 1);

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

INSERT INTO `t_pack_company` (`id`, `pack_id`, `company_id`, `etat`, `prix_id`, `souscript_id`, `site_id`) VALUES
(225, 5, 299, 0, 11, 199, 356);

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
  PRIMARY KEY (`id_prix`),
  KEY `produit_id` (`produit_id`,`sousresto_id`),
  KEY `sousresto_id` (`sousresto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3498 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_prix_produit`
--

INSERT INTO `t_prix_produit` (`id_prix`, `prix_vente`, `monnaie`, `produit_id`, `sousresto_id`) VALUES
(252, 10, 'USD', 143, 123),
(264, 8, 'USD', 155, 123),
(265, 6, 'USD', 156, 123),
(266, 14, 'USD', 157, 123),
(272, 5, 'USD', 163, 123),
(273, 6, 'USD', 164, 123),
(274, 4, 'USD', 165, 123),
(277, 10, 'USD', 168, 123),
(285, 12, 'USD', 176, 123),
(309, 6, 'USD', 199, 123),
(313, 15, 'USD', 203, 123),
(314, 18, 'USD', 204, 123),
(315, 18, 'USD', 205, 123),
(327, 8, 'USD', 211, 123),
(328, 10, 'USD', 212, 123),
(337, 10, 'USD', 214, 123),
(341, 12, NULL, 218, 123),
(342, 12, NULL, 219, 123),
(343, 12, NULL, 220, 123),
(348, 8, 'USD', 225, 123),
(350, 8, 'USD', 227, 123),
(352, 12, 'USD', 229, 123),
(353, 12, 'USD', 230, 123),
(355, 25, 'USD', 231, 123),
(357, 20, 'USD', 233, 123),
(360, 8, 'USD', 236, 123),
(361, 2, 'USD', 237, 123),
(363, 10, 'USD', 239, 123),
(364, 10, 'USD', 240, 123),
(365, 5, 'USD', 241, 123),
(368, 25, 'USD', 243, 123),
(372, 6, 'USD', 247, 123),
(373, 6, 'USD', 248, 123),
(378, 8, 'USD', 253, 123),
(379, 12, 'USD', 254, 123),
(380, 45, 'USD', 255, 123),
(381, 5, 'USD', 256, 123),
(382, 5, 'USD', 257, 123),
(383, 10, 'USD', 258, 123),
(387, 10, 'USD', 261, 123),
(389, 5, 'USD', 263, 123),
(391, 8, 'USD', 265, 123),
(392, 15, 'USD', 234, 123),
(395, 5, 'USD', 268, 123),
(402, 8, 'USD', 274, 123),
(404, 12, 'USD', 276, 123),
(406, 10, 'USD', 278, 123),
(408, 8, 'USD', 280, 123),
(411, 8, 'USD', 282, 123),
(413, 25, 'USD', 284, 123),
(416, 10, 'USD', 287, 123),
(425, 99, 'USD', 292, 123),
(427, 7, 'USD', 294, 123),
(429, 8, 'USD', 296, 123),
(430, 13, 'USD', 297, 123),
(432, 13, 'USD', 299, 123),
(434, 21, 'USD', 301, 123),
(435, 28, 'USD', 302, 123),
(439, 10, 'USD', 295, 123),
(440, 30, 'USD', 306, 123),
(445, 13, 'USD', 310, 123),
(447, 17, 'USD', 312, 123),
(453, 4.5, 'USD', 318, 123),
(454, 5, 'USD', 319, 123),
(456, 5, 'USD', 321, 123),
(459, 5, 'USD', 324, 123),
(460, 7, 'USD', 325, 123),
(461, 5, 'USD', 326, 123),
(466, 20, 'USD', 331, 123),
(468, 20, 'USD', 329, 123),
(472, 10, 'USD', 336, 123),
(474, 5, 'USD', 338, 123),
(475, 7, 'USD', 339, 123),
(479, 8, 'USD', 343, 123),
(483, 8, 'USD', 346, 123),
(490, 12, 'USD', 353, 123),
(762, 8, 'USD', 144, 123),
(766, 12, 'USD', 145, 123),
(767, 8, 'USD', 146, 123),
(768, 6, 'USD', 147, 123),
(769, 8, 'USD', 148, 123),
(770, 6, 'USD', 166, 123),
(771, 8, 'USD', 149, 123),
(772, 8, 'USD', 150, 123),
(773, 8, 'USD', 151, 123),
(774, 12, 'USD', 154, 123),
(775, 10, 'USD', 152, 123),
(776, 10, 'USD', 153, 123),
(781, 12, 'USD', 158, 123),
(782, 9, 'USD', 159, 123),
(783, 10, 'USD', 161, 123),
(784, 8, 'USD', 162, 123),
(785, 12, 'USD', 160, 123),
(786, 12, 'USD', 167, 123),
(789, 8, 'USD', 169, 123),
(790, 5, 'USD', 170, 123),
(791, 12, 'USD', 171, 123),
(792, 8, 'USD', 172, 123),
(793, 9, 'USD', 173, 123),
(796, 10, 'USD', 174, 123),
(797, 12, 'USD', 175, 123),
(799, 8, 'USD', 177, 123),
(802, 8, 'USD', 179, 123),
(803, 8, 'USD', 180, 123),
(807, 15, 'USD', 184, 123),
(808, 6, 'USD', 185, 123),
(811, 6, 'USD', 181, 123),
(814, 6, 'USD', 186, 123),
(815, 12, 'USD', 187, 123),
(817, 8, 'USD', 189, 123),
(818, 5, 'USD', 190, 123),
(819, 8, 'USD', 191, 123),
(820, 12, 'USD', 192, 123),
(821, 8, 'USD', 194, 123),
(822, 6, 'USD', 193, 123),
(823, 12, 'USD', 195, 123),
(824, 10, 'USD', 197, 123),
(826, 8, 'USD', 198, 123),
(827, 12, 'USD', 201, 123),
(828, 9, 'USD', 202, 123),
(829, 12, 'USD', 200, 123),
(833, 10, 'USD', 207, 123),
(834, 8, 'USD', 208, 123),
(835, 8, 'USD', 206, 123),
(961, 8, 'USD', 275, 123),
(1015, 12, 'USD', 210, 123),
(1246, 15, 'USD', 283, 123),
(1255, 13, 'USD', 298, 123),
(1258, 27, 'USD', 300, 123),
(1262, 15, 'USD', 216, 123),
(1264, 28, 'USD', 215, 123),
(1269, 30, 'USD', 246, 123),
(1273, 30, 'USD', 235, 123),
(1276, 30, 'USD', 272, 123),
(1281, 11, 'USD', 309, 123),
(1283, 5, 'USD', 238, 123),
(1286, 3, 'USD', 316, 123),
(1379, 14, 'USD', 209, 123),
(1456, 20, 'USD', 333, 123),
(1461, 12, 'USD', 222, 123),
(1462, 6, 'USD', 277, 123),
(1463, 7, 'USD', 327, 123),
(1465, 12, 'USD', 293, 123),
(1467, 7, 'USD', 250, 123),
(1470, 2, 'USD', 314, 123),
(1471, 6, 'USD', 232, 123),
(1475, 6, 'USD', 224, 123),
(1477, 50, 'USD', 290, 123),
(1479, 16, 'USD', 328, 123),
(1480, 16, 'USD', 330, 123),
(1482, 8, 'USD', 244, 123),
(1509, 12, 'USD', 251, 123),
(1527, 15, 'USD', 279, 123),
(1529, 10, 'USD', 213, 123),
(1540, 5, 'USD', 281, 123),
(1623, 15, 'USD', 228, 123),
(1732, 10, 'USD', 221, 123),
(1734, 6, 'USD', 259, 123),
(1735, 5, 'USD', 262, 123),
(1736, 9, 'USD', 335, 123),
(1737, 35, 'USD', 288, 123),
(1739, 23, 'USD', 308, 123),
(1741, 17, 'USD', 332, 123),
(1829, 13, 'USD', 311, 123),
(1833, 3, 'USD', 266, 123),
(1849, 5, 'USD', 260, 123),
(1852, 35, 'USD', 304, 123),
(1855, 5, 'USD', 322, 123),
(1856, 20, 'USD', 285, 123),
(1862, 2, 'USD', 286, 123),
(1863, 8, 'USD', 252, 123),
(1868, 33, 'USD', 307, 123),
(1981, 30, 'USD', 242, 123),
(1982, 15, 'USD', 245, 123),
(2228, 7, 'USD', 340, 123),
(2230, 6, 'USD', 341, 123),
(2362, 10, 'USD', 273, 123),
(2367, 10, 'USD', 344, 123),
(2373, 19, 'USD', 313, 123),
(2374, 3, 'USD', 315, 123),
(2388, 45, 'USD', 264, 123),
(2404, 3.5, 'USD', 317, 123),
(2428, 17, 'USD', 226, 123),
(2430, 15, 'USD', 217, 123),
(2433, 55, 'USD', 289, 123),
(2435, 12, 'USD', 345, 123),
(2436, 12, 'USD', 223, 123),
(2437, 5, 'USD', 323, 123),
(2439, 15, 'USD', 291, 123),
(2575, 10, 'USD', 347, 123),
(2578, 45, 'USD', 267, 123),
(2594, 35, 'USD', 342, 123),
(2718, 5, 'USD', 334, 123),
(2774, 27, 'USD', 303, 123),
(2793, 10, 'USD', 183, 123),
(2794, 8, 'USD', 182, 123),
(2795, 8, 'USD', 178, 123),
(2796, 12, 'USD', 188, 123),
(2832, 5, 'USD', 249, 123),
(2840, 2.2, 'USD', 7, 123),
(2841, 2.2, 'USD', 8, 123),
(2842, 2.2, 'USD', 9, 123),
(2844, 2.2, 'USD', 11, 123),
(2845, 2.2, 'USD', 12, 123),
(2850, 2.7, 'USD', 15, 123),
(2851, 2.7, 'USD', 16, 123),
(2852, 5, 'USD', 17, 123),
(2855, 2.2, 'USD', 20, 123),
(2856, 5, 'USD', 21, 123),
(2857, 5, 'USD', 22, 123),
(2858, 5, 'USD', 23, 123),
(2859, 5, 'USD', 24, 123),
(2860, 5, 'USD', 25, 123),
(2862, 7, 'USD', 26, 123),
(2863, 12, 'USD', 27, 123),
(2864, 5, 'USD', 28, 123),
(2866, 5, 'USD', 30, 123),
(2867, 5, 'USD', 31, 123),
(2868, 5, 'USD', 32, 123),
(2869, 5, 'USD', 33, 123),
(2870, 5, 'USD', 34, 123),
(2871, 5, 'USD', 35, 123),
(2872, 5, 'USD', 36, 123),
(2873, 5, 'USD', 37, 123),
(2874, 3.5, 'USD', 38, 123),
(2876, 3.5, 'USD', 40, 123),
(2877, 3.5, 'USD', 41, 123),
(2878, 3.5, 'USD', 42, 123),
(2879, 3.5, 'USD', 43, 123),
(2880, 3.5, 'USD', 44, 123),
(2881, 3.5, 'USD', 45, 123),
(2883, 4, 'USD', 47, 123),
(2892, 7, 'USD', 53, 123),
(2893, 7, 'USD', 54, 123),
(2894, 8, 'USD', 49, 123),
(2895, 10, 'USD', 50, 123),
(2896, 7, 'USD', 51, 123),
(2897, 7, 'USD', 52, 123),
(2898, 10, 'USD', 55, 123),
(2899, 10, 'USD', 56, 123),
(2900, 10, 'USD', 57, 123),
(2905, 8, 'USD', 62, 123),
(2906, 8, 'USD', 58, 123),
(2908, 8, 'USD', 60, 123),
(2909, 8, 'USD', 61, 123),
(2910, 6.5, 'USD', 63, 123),
(2911, 8, 'USD', 64, 123),
(2912, 10, 'USD', 65, 123),
(2914, 10, 'USD', 67, 123),
(2915, 10, 'USD', 68, 123),
(2916, 10, 'USD', 69, 123),
(2917, 10, 'USD', 70, 123),
(2918, 10, 'USD', 71, 123),
(2919, 7, 'USD', 72, 123),
(2920, 10, 'USD', 73, 123),
(2921, 10, 'USD', 74, 123),
(2922, 10, 'USD', 75, 123),
(2923, 10, 'USD', 76, 123),
(2924, 6.5, 'USD', 77, 123),
(2925, 6, 'USD', 78, 123),
(2926, 7, 'USD', 79, 123),
(2927, 25, 'USD', 80, 123),
(2928, 35, 'USD', 81, 123),
(2929, 40, 'USD', 82, 123),
(2930, 50, 'USD', 83, 123),
(2931, 50, 'USD', 84, 123),
(2932, 50, 'USD', 85, 123),
(2933, 80, 'USD', 86, 123),
(2934, 125, 'USD', 87, 123),
(2935, 100, 'USD', 88, 123),
(2936, 95, 'USD', 89, 123),
(2937, 100, 'USD', 90, 123),
(2938, 120, 'USD', 91, 123),
(2939, 130, 'USD', 92, 123),
(2940, 120, 'USD', 93, 123),
(2941, 55, 'USD', 94, 123),
(2943, 60, 'USD', 96, 123),
(2944, 35, 'USD', 97, 123),
(2945, 70, 'USD', 98, 123),
(2946, 90, 'USD', 99, 123),
(2947, 35, 'USD', 100, 123),
(2948, 35, 'USD', 101, 123),
(2949, 35, 'USD', 102, 123),
(2951, 60, 'USD', 104, 123),
(2983, 30, 'USD', 132, 123),
(3204, 25, 'USD', 353, 123),
(3205, 65, 'USD', 354, 123),
(3207, 55, 'USD', 95, 123),
(3208, 18, 'USD', 355, 123),
(3209, 18, 'USD', 356, 123),
(3210, 24, 'USD', 357, 123),
(3211, 13, 'USD', 358, 123),
(3212, 28, 'USD', 359, 123),
(3213, 18, 'USD', 360, 123),
(3214, 18, 'USD', 361, 123),
(3215, 18, 'USD', 362, 123),
(3216, 22, 'USD', 363, 123),
(3217, 20, 'USD', 364, 123),
(3219, 5, 'USD', 366, 123),
(3220, 25, 'USD', 367, 123),
(3221, 18, 'USD', 368, 123),
(3222, 30, 'USD', 369, 123),
(3225, 2, 'USD', 18, 123),
(3226, 2.8, 'USD', 19, 123),
(3227, 5, 'USD', 371, 123),
(3229, 4, 'USD', 48, 123),
(3230, 0, 'USD', 372, 123),
(3231, 35, 'USD', 373, 123),
(3234, 0, 'USD', 376, 123),
(3235, 0, 'USD', 377, 123),
(3237, 2, 'USD', 379, 123),
(3238, 18, 'USD', 380, 123),
(3239, 22, 'USD', 381, 123),
(3240, 13, 'USD', 382, 123),
(3241, 13, 'USD', 383, 123),
(3242, 13, 'USD', 384, 123),
(3243, 5, 'USD', 385, 123),
(3244, 0, 'USD', 386, 123),
(3245, 2.2, 'USD', 387, 123),
(3249, 120, 'USD', 388, 123),
(3251, 1.8, 'USD', 389, 123),
(3257, 55, 'USD', 103, 123),
(3258, 8, 'USD', 59, 123),
(3259, 24, 'USD', 391, 123),
(3260, 35, 'USD', 392, 123),
(3261, 5, 'USD', 393, 123),
(3262, 5, 'USD', 394, 123),
(3263, 6, 'USD', 395, 123),
(3264, 8, 'USD', 396, 123),
(3265, 1.8, 'USD', 370, 123),
(3266, 4, 'USD', 46, 123),
(3267, 4, 'USD', 397, 123),
(3268, 4, 'USD', 398, 123),
(3269, 4, 'USD', 399, 123),
(3270, 10, 'USD', 66, 123),
(3271, 70, 'USD', 136, 123),
(3272, 170, 'USD', 140, 123),
(3273, 130, 'USD', 139, 123),
(3274, 120, 'USD', 138, 123),
(3275, 25, 'USD', 105, 123),
(3276, 25, 'USD', 107, 123),
(3278, 35, 'USD', 108, 123),
(3279, 60, 'USD', 109, 123),
(3280, 40, 'USD', 111, 123),
(3281, 35, 'USD', 110, 123),
(3282, 35, 'USD', 390, 123),
(3283, 30, 'USD', 115, 123),
(3284, 30, 'USD', 114, 123),
(3285, 30, 'USD', 113, 123),
(3286, 30, 'USD', 112, 123),
(3288, 15, 'USD', 135, 123),
(3289, 100, 'USD', 137, 123),
(3290, 25, 'USD', 130, 123),
(3291, 30, 'USD', 131, 123),
(3292, 30, 'USD', 133, 123),
(3293, 30, 'USD', 134, 123),
(3294, 40, 'USD', 123, 123),
(3295, 40, 'USD', 121, 123),
(3296, 90, 'USD', 122, 123),
(3297, 50, 'USD', 120, 123),
(3298, 35, 'USD', 125, 123),
(3299, 55, 'USD', 119, 123),
(3300, 35, 'USD', 124, 123),
(3301, 75, 'USD', 118, 123),
(3302, 35, 'USD', 117, 123),
(3303, 5, 'USD', 400, 123),
(3304, 35, 'USD', 116, 123),
(3305, 35, 'USD', 106, 123),
(3306, 5, 'USD', 29, 123),
(3307, 6, 'USD', 401, 123),
(3308, 68, 'USD', 402, 123),
(3309, 70, 'USD', 403, 123),
(3311, 7, 'USD', 405, 123),
(3312, 45, 'USD', 406, 123),
(3313, 3.5, 'USD', 407, 123),
(3314, 5, 'USD', 408, 123),
(3315, 35, 'USD', 409, 123),
(3316, 35, 'USD', 410, 123),
(3317, 8, 'USD', 411, 123),
(3318, 8, 'USD', 412, 123),
(3319, 130, 'USD', 413, 123),
(3320, 3.5, 'USD', 414, 123),
(3322, 45, 'USD', 415, 123),
(3323, 70, 'USD', 416, 123),
(3324, 70, 'USD', 417, 123),
(3325, 70, 'USD', 418, 123),
(3326, 70, 'USD', 419, 123),
(3327, 70, 'USD', 128, 123),
(3328, 8, 'USD', 126, 123),
(3329, 12, 'USD', 129, 123),
(3330, 17, 'USD', 127, 123),
(3331, 70, 'USD', 420, 123),
(3333, 8, 'USD', 422, 123),
(3334, 17, 'USD', 421, 123),
(3335, 17, 'USD', 423, 123),
(3336, 70, 'USD', 424, 123),
(3337, 8, 'USD', 425, 123),
(3338, 17, 'USD', 426, 123),
(3339, 12, 'USD', 427, 123),
(3340, 70, 'USD', 428, 123),
(3341, 8, 'USD', 429, 123),
(3342, 17, 'USD', 430, 123),
(3343, 12, 'USD', 431, 123),
(3345, 2.7, 'USD', 14, 123),
(3351, 0, 'USD', 436, 123),
(3353, 0, 'USD', 438, 123),
(3355, 0, 'USD', 440, 123),
(3357, 60, 'USD', 442, 123),
(3358, 0, 'USD', 443, 123),
(3359, 44, 'USD', 444, 123),
(3360, 7, 'USD', 445, 123),
(3361, 130, 'USD', 446, 123),
(3362, 8, 'USD', 447, 123),
(3363, 30, 'USD', 448, 123),
(3364, 0.5, 'USD', 449, 123),
(3365, 0.5, 'USD', 450, 123),
(3366, 0.5, 'USD', 451, 123),
(3367, 0.5, 'USD', 452, 123),
(3368, 130, 'USD', 453, 123),
(3369, 60, 'USD', 454, 123),
(3370, 7, 'USD', 455, 123),
(3371, 120, 'USD', 456, 123),
(3372, 55, 'USD', 457, 123),
(3373, 55, 'USD', 458, 123),
(3382, 0, 'USD', 459, 123),
(3383, 2.2, 'USD', 441, 123),
(3384, 2.2, 'USD', 439, 123),
(3385, 0, 'USD', 460, 123),
(3386, 0, 'USD', 461, 123),
(3387, 3.5, 'USD', 462, 123),
(3388, 0, 'USD', 463, 123),
(3389, 0, 'USD', 464, 123),
(3390, 7, 'USD', 465, 123),
(3391, 53, 'USD', 466, 123),
(3392, 7, 'USD', 467, 123),
(3393, 3.5, 'USD', 468, 123),
(3394, 3.5, 'USD', 469, 123),
(3395, 3.5, 'USD', 39, 123),
(3396, 5, 'USD', 470, 123),
(3397, 120, 'USD', 471, 123),
(3398, 100, 'USD', 472, 123),
(3399, 10, 'USD', 473, 123),
(3400, 300, 'USD', 474, 123),
(3401, 25, 'USD', 475, 123),
(3402, 30, 'USD', 476, 123),
(3403, 120, 'USD', 477, 123),
(3404, 10, 'USD', 478, 123),
(3406, 2.2, 'USD', 480, 123),
(3407, 40, 'USD', 481, 123),
(3408, 50, 'USD', 482, 123),
(3409, 12, 'USD', 483, 123),
(3410, 2.2, 'USD', 479, 123),
(3411, 2.2, 'USD', 4, 123),
(3413, 11, 'USD', 485, 123),
(3414, 5, 'USD', 486, 123),
(3415, 5, 'USD', 487, 123),
(3416, 7, 'USD', 488, 123),
(3417, 8, 'USD', 489, 123),
(3418, 5, 'USD', 404, 123),
(3419, 12, 'USD', 490, 123),
(3420, 1, 'USD', 491, 123),
(3421, 15, 'USD', 492, 123),
(3422, 20, 'USD', 493, 123),
(3423, 25, 'USD', 494, 123),
(3424, 30, 'USD', 495, 123),
(3425, 35, 'USD', 496, 123),
(3426, 12, 'USD', 497, 123),
(3427, 2.5, 'USD', 498, 123),
(3428, 2.12, 'USD', 499, 123),
(3429, 3.93, 'USD', 500, 123),
(3430, 3.93, 'USD', 501, 123),
(3431, 2.72, 'USD', 502, 123),
(3432, 2.72, 'USD', 503, 123),
(3433, 3.93, 'USD', 504, 123),
(3434, 3.5, 'USD', 505, 123),
(3435, 2, 'USD', 506, 123),
(3436, 23, 'USD', 507, 123),
(3437, 30, 'USD', 508, 123),
(3438, 17, 'USD', 509, 123),
(3439, 5, 'USD', 510, 123),
(3440, 5, 'USD', 511, 123),
(3441, 2.2, 'USD', 437, 123),
(3442, 2.2, 'USD', 6, 123),
(3443, 2.2, 'USD', 435, 123),
(3444, 2.2, 'USD', 434, 123),
(3445, 1.8, 'USD', 432, 123),
(3446, 1.8, 'USD', 13, 123),
(3447, 1.8, 'USD', 433, 123),
(3448, 2.2, 'USD', 484, 123),
(3449, 12, 'USD', 513, 123),
(3450, 0, 'USD', 514, 123),
(3452, 2.2, 'USD', 515, 123),
(3453, 12, 'USD', 516, 123),
(3454, 80, 'USD', 517, 123),
(3455, 0, 'USD', 518, 123),
(3456, 0, 'USD', 519, 123),
(3457, 10, 'USD', 520, 123),
(3458, 18, 'USD', 521, 123),
(3459, 10, 'USD', 522, 123),
(3460, 0, 'USD', 523, 123),
(3461, 0, 'USD', 524, 123),
(3462, 0, 'USD', 525, 123),
(3463, 0, 'USD', 526, 123),
(3464, 0, 'USD', 527, 123),
(3465, 0, 'USD', 528, 123),
(3466, 0, 'USD', 529, 123),
(3467, 0, 'USD', 530, 123),
(3470, 1.8, 'USD', 531, 123),
(3471, 2.2, 'USD', 10, 123),
(3472, 0, 'USD', 532, 123),
(3473, 0, 'USD', 533, 123),
(3474, 0, 'USD', 534, 123),
(3475, 0, 'USD', 535, 123),
(3476, 0, 'USD', 536, 123),
(3477, 0, 'USD', 537, 123),
(3478, 10, 'USD', 538, 123),
(3479, 8, 'USD', 539, 123),
(3480, 0, 'USD', 540, 123),
(3481, 0, 'USD', 541, 123),
(3482, 0, 'USD', 542, 123),
(3483, 0, 'USD', 543, 123),
(3484, 0, 'USD', 544, 123),
(3485, 0, 'USD', 545, 123),
(3486, 0, 'USD', 546, 123),
(3487, 0, 'USD', 547, 123),
(3488, 0, 'USD', 548, 123),
(3489, 0, 'USD', 549, 123),
(3490, 0, 'USD', 550, 123),
(3491, 0, 'USD', 551, 123),
(3492, 0, 'USD', 552, 123),
(3493, 0, 'USD', 553, 123),
(3494, 0, 'USD', 554, 123),
(3495, 0, 'USD', 555, 123),
(3496, 0, 'USD', 556, 123),
(3497, 0, 'USD', 557, 123);

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
  PRIMARY KEY (`id_regl`),
  KEY `user_id` (`user_id`),
  KEY `company_id` (`company_id`),
  KEY `id_hotel` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_reglage`
--

INSERT INTO `t_reglage` (`id_regl`, `remise`, `majoration`, `date_regl`, `dte_h`, `temps_regl`, `time_checkin`, `m_insert`, `m_affiche`, `tauxdollar`, `taux_op`, `tva`, `pourcentage_defaut`, `pourcentage_24_heure`, `pourcentage_48_heure`, `pourcentage_72_heure`, `pourcentage_sup_72_heure`, `type_annul`, `fcon_heberge`, `user_id`, `id_hotel`, `company_id`, `stock`) VALUES
(1, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '00:00:00', 'USD', 'USD', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 400, 264, 255, 1),
(2, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', '00:00:00', 'USD', 'CDF', 2000.00, 1500, 14.00, 0, 0, 0, 0, 0, '', 0, 400, 289, 272, 1),
(3, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, NULL, 296, 275, 1),
(4, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 433, 297, 276, 1),
(5, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1600.00, 1, 16.00, 0, 0, 0, 0, 0, '', 0, 443, 298, 277, 1),
(6, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 299, 277, 1),
(7, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 300, 277, 1),
(8, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 301, 277, 1),
(9, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 302, 277, 1),
(10, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 303, 277, 1),
(11, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 304, 277, 1),
(12, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 305, 277, 1),
(13, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 306, 277, 1),
(14, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 307, 277, 1),
(15, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 308, 277, 1),
(16, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 309, 277, 1),
(17, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 448, 310, 278, 1),
(18, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 311, 277, 1),
(19, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 312, 277, 1),
(20, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 313, 277, 1),
(21, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 314, 277, 1),
(22, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 315, 277, 1),
(23, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 316, 277, 1),
(24, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 317, 277, 1),
(25, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 318, 277, 1),
(26, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 449, 319, 279, 1),
(27, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 449, 320, 279, 1),
(28, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 321, 277, 1),
(29, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 322, 277, 1),
(30, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 323, 277, 1),
(31, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 443, 324, 277, 1),
(32, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 452, 325, 280, 1),
(33, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 453, 326, 281, 1),
(34, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 454, 327, 282, 1),
(36, 0, 0, '0000-00-00', '0000-00-00 00:00:00', '13:00:00', '12:00:00', 'CDF', 'CDF', 1700.00, 1, 0.00, 0, 0, 0, 0, 0, '', 0, 455, 328, 283, 1),
(37, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 455, 329, 283, 1),
(38, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 455, 330, 283, 1),
(39, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 455, 331, 283, 1),
(40, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 455, 332, 283, 1),
(41, 5, 0, '0000-00-00', '0000-00-00 00:00:00', '00:00:00', NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, '', 0, 455, 333, 283, 1),
(42, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 461, 341, 288, 1),
(43, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 462, 342, 289, 1),
(44, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 463, 343, 290, 1),
(45, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 464, 344, 291, 1),
(46, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 465, 345, 292, 1),
(47, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 466, 346, 293, 1),
(48, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 467, 347, 294, 1),
(49, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 467, 348, 294, 1),
(50, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 467, 349, 294, 1),
(51, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 468, 350, 295, 1),
(52, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 468, 351, 295, 1),
(53, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 469, 352, 296, 1),
(54, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 469, 353, 296, 1),
(55, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 470, 354, 297, 1),
(56, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'CDF', 1640.00, 1, 14.00, 0, 0, 0, 0, 0, NULL, 0, 355, 355, 298, 1),
(57, 5, 0, NULL, NULL, NULL, NULL, 'USD', 'USD', 1650.00, 1, 16.00, 0, 0, 0, 0, 0, NULL, 0, 471, 356, 299, 1);

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
  PRIMARY KEY (`id_regl`),
  KEY `id_fact` (`id_fact`),
  KEY `id_mode_regl` (`id_mode_regl`),
  KEY `id_monnaie` (`id_monnaie`,`id_user`,`id_hotel`),
  KEY `id_monnaie_2` (`id_monnaie`),
  KEY `id_user` (`id_user`),
  KEY `id_hotel` (`id_hotel`),
  KEY `id_sousresto` (`id_sousresto`),
  KEY `fournisseur_id` (`fournisseur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_reglement`
--

INSERT INTO `t_reglement` (`id_regl`, `numero`, `montant_dollar`, `montant_fc`, `reste`, `id_mode_regl`, `date_regl`, `dte`, `rejete`, `id_fact`, `id_monnaie`, `id_user`, `id_hotel`, `id_sousresto`, `fournisseur_id`) VALUES
(20, '00230', NULL, NULL, NULL, NULL, '2020-06-04 13:30:46', '2020-06-04', 1, 291, NULL, 476, 356, NULL, NULL),
(21, '00231', NULL, NULL, NULL, NULL, '2020-06-04 13:37:54', '2020-06-04', 1, 292, NULL, 476, 356, NULL, NULL);

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
  PRIMARY KEY (`id_res`),
  KEY `num_ch` (`id_client`),
  KEY `id_client` (`id_client`),
  KEY `id_hotel` (`id_hotel`),
  KEY `chambr_id` (`chambr_id`),
  KEY `respo_id` (`respo_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_reservation`
--

INSERT INTO `t_reservation` (`id_res`, `num_reserv`, `garantie`, `num_bc`, `num_occ`, `num_com`, `type`, `tva`, `taux`, `remise`, `majoration`, `mont_nuite`, `mont_total_res`, `mont_par_chambre`, `monnaie`, `nbr_ch`, `etat`, `etat_credit`, `dte`, `date_res`, `date_occ`, `date_lib`, `statut_res`, `statut_occ`, `statut_sorti`, `id_client`, `chambr_id`, `id_sousresto`, `id_hotel`, `dte_a`, `dte_s`, `occ_indirect`, `respo_id`) VALUES
(287, '00559', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2020-06-04', NULL, NULL, NULL, 'restaurant', NULL, NULL, 1915, NULL, NULL, 356, NULL, NULL, NULL, NULL),
(288, '00560', NULL, NULL, NULL, 1, 'restaurant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CDF', 0, NULL, NULL, '2020-06-04', NULL, NULL, NULL, 'restaurant', NULL, NULL, 1915, NULL, NULL, 356, NULL, NULL, NULL, NULL);

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
  PRIMARY KEY (`id_respo`),
  KEY `company_id` (`company_id`),
  KEY `company_id_2` (`company_id`),
  KEY `company_id_3` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_responsable`
--

INSERT INTO `t_responsable` (`id_respo`, `nom_respo`, `telephone_respo`, `email`, `adresse_respo`, `entreprise`, `filtre`, `pseudo_supp`, `company_id`) VALUES
(19, 'prive', '', '', '', 'prive', 0, 0, 283),
(20, 'Diala', '0813808322', 'glodybukas@gmail.com', 'Watsha 67', 'Airtel ', 1, 0, 283),
(21, 'prive', '', '', '', 'prive', 0, 0, 0),
(22, 'prive', '', '', '', 'prive', 0, 0, 0),
(23, 'prive', '', '', '', 'prive', 0, 0, 0),
(24, 'prive', '', '', '', 'prive', 0, 0, 284),
(25, 'prive', '', '', '', 'prive', 0, 0, 285),
(26, 'prive', '', '', '', 'prive', 0, 0, 286),
(27, 'prive', '', '', '', 'prive', 0, 0, 287),
(28, 'prive', '', '', '', 'prive', 0, 0, 288),
(29, 'prive', '', '', '', 'prive', 0, 0, 289),
(30, 'prive', '', '', '', 'prive', 0, 0, 290),
(31, 'prive', '', '', '', 'prive', 0, 0, 291),
(32, 'prive', '', '', '', 'prive', 0, 0, 292),
(33, 'prive', '', '', '', 'prive', 0, 0, 293),
(34, 'prive', '', '', '', 'prive', 0, 0, 294),
(35, 'prive', '', '', '', 'prive', 0, 0, 295),
(36, 'prive', '', '', '', 'prive', 0, 0, 296),
(37, 'prive', '', '', '', 'prive', 0, 0, 297),
(38, 'prive', '', '', '', 'prive', 0, 0, 298),
(39, 'prive', '', '', '', 'prive', 0, 0, 299);

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
  PRIMARY KEY (`idsession`),
  KEY `user_id` (`user_id`),
  KEY `caisse_id` (`souresto_id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `souresto_id` (`souresto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_sousresto`),
  KEY `hotel_id` (`hotel_id`),
  KEY `depot_id` (`depot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_sousresto`
--

INSERT INTO `t_sousresto` (`id_sousresto`, `libelle`, `depot_id`, `etat`, `statut`, `taux`, `mentionlegale`, `remise`, `hotel_id`) VALUES
(122, 'Central', 123, 0, NULL, '1.0000000000', NULL, 0, 356),
(123, 'LE GAZEBO', 121, 1, 0, '1650.0000000000', 'Merci de votre visite Ã  GAZEBO', 0, 356);

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
  PRIMARY KEY (`id_user`),
  KEY `id_hotel` (`id_hotel`,`id_droit`),
  KEY `id_droit` (`id_droit`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=516 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`id_user`, `nom_user`, `prenom_user`, `sexe_user`, `telephone_user`, `email_user`, `mdp_user`, `adresse_mail`, `type`, `actif`, `id_hotel`, `company_id`, `id_droit`, `fconnect`, `connect`, `module_dflt`, `module_name`, `psedo`, `pos_id`) VALUES
(471, 'ADMIN', 'Irene', 'feminin', 2147483647, 'admin', '$2y$10$vovbE5.cnchhvSBS3Ot2vuKsiGmOMLMGeCJNjeAIjCnSrsvBUvJDG', 'irene@ebutelo.com', 1, 1, 356, 299, 1, 0, 1, '', '', 0, 123),
(473, 'CaissiÃ¨re Principale', NULL, 'feminin', NULL, 'lulu', '$2y$10$zfi6ODyDzNfp1idf.zx3POXdzHS6E7gENbbgzo00y//ygDacEKdC2', NULL, 1, 1, 356, 299, 1, NULL, 1, 'restaurant2/index.php', 'Stock', 1, 123),
(475, 'Serveur', NULL, 'masculin', NULL, 'serveur', '$2y$10$w2LqqcI/Vi2V.8gf7SQgDe4nEev.XudzLPPY7Jr0NqAF9XnHUMgl.', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 1, 123),
(476, 'Caisse', NULL, 'feminin', NULL, 'caisse', '$2y$10$i4jBbY6X4iIK/WhtrATkKu9YLS4a3Yq5JdONNqGQp3HZTyx8rrHR2', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/caissier.php', 'Restaurant', 0, 123),
(477, 'Cuisine', NULL, 'masculin', NULL, 'cuisine', '$2y$10$ZhtZ7sEnzLeHTksWVfObx.VLU7hJxJKsacN6He2MT6lgGyK0MZuuK', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/cuisine.php', 'Cuisine', 0, 0),
(478, 'Jean Paul', NULL, 'masculin', NULL, '23eg', '$2y$10$VNlwB6v68Wzavnw2L1Dy3O7DO6lj0pZWYoAw4kAO8AIQWWFO8Ow0i', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'Stock2/index.php', 'Stock', 0, 123),
(479, 'Serveur2', NULL, 'masculin', NULL, 'serveur2', '$2y$10$HGbe49G1s5L2IAmbZGiAmerBp0Pmrs.oGZfNdfcL5xcMvXdRpopou', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 1, 123),
(480, 'john', NULL, 'masculin', NULL, 'john', '$2y$10$tSVJTBdh4/wstkbyWhiVAur/CJ2dDmwBd7hcStGpc6SaJnOs0yCoG', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/caissier.php', 'Caissier', 0, 123),
(481, 'Brigitte Piedboeuf', NULL, 'masculin', NULL, '0001', '$2y$10$8psxGRQAwbKqQOlGmW4P/egXYVX7gLKk9H2MAkInTlPgkd5P8wg4.', NULL, 1, 1, 356, 299, 1, NULL, NULL, 'restaurant2/caissier.php', 'Caissier', 0, 123),
(482, 'Alain Piedboeuf', NULL, 'masculin', NULL, '2846', '$2y$10$P8BixpHsAMmWXkgvrqCRXO6oDlEJLEKJF.ipo7ed3ByG5eZeIj82e', NULL, 1, 1, 356, 299, 1, NULL, 1, 'restaurant2/index.php', 'Restaurant', 0, 123),
(483, 'Terry wancket', NULL, 'masculin', NULL, '3960', '$2y$10$YRhBCLiU/DxYhVNmPYYTeeYuacWxkO6azaskay6olRMuObcjBfaiK', NULL, 1, 1, 356, 299, 1, NULL, 1, 'Stock2/index.php', 'Stock', 0, 123),
(484, 'jonathan', NULL, 'masculin', NULL, '2613', '$2y$10$HA3wdlP11HZAUjZBVlND6eIFhvMRONv1P9ULGqInDs7zCqBsKmy/C', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(485, 'Eddy', NULL, 'masculin', NULL, '4526', '$2y$10$Sd8L7NcUhqwDi9OooGm8JuuoY2eXqn3UkFjB0vYBpQFTNdilh4F3y', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(486, 'Richard', NULL, 'masculin', NULL, '8976', '$2y$10$O1dFmDN.P8LJeHJAT7XLt.vZ4wEW8csxXvnljT8FU1XUqNfqHaO5a', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(487, 'Raissa', NULL, 'masculin', NULL, '8588', '$2y$10$nDgUATA1wywZ.VKuA23Q..EaIr31eKQLN4LqEdySamH0.aKDseLMi', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(488, 'Pathou', NULL, 'masculin', NULL, '9696', '$2y$10$u76kPhWAZ5eCf1PCliCsTu9RRcZlQo38T68gtyxAHeB56Spx1.wN6', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(489, 'Junior', NULL, 'masculin', NULL, '7854', '$2y$10$lQVrkt5Cr/.oLE3rKgbvN.DktYm5NIsp1.6j8ofUlwKCrwOHIChie', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(490, 'Irene', NULL, 'masculin', NULL, '5284', '$2y$10$5V4sKKsNSTnTRfWgZ7NJDe7HNJC5VSjdOWam/C58UvX73mp9fboWm', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(491, 'Ruphin', NULL, 'masculin', NULL, '2583', '$2y$10$YkuBOdQDOhK0KYkfeMQ.UueTyAJenOFtURYor6/m2M9e6S.kVYwsC', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(492, 'Meddy', NULL, 'masculin', NULL, '2574', '$2y$10$vrV.gEyzweyG4Nc3BRrbreokUlrjCDZVYXx9yaPJVvomDGN/IdxOO', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(493, 'JOSE', NULL, 'masculin', NULL, '2152', '$2y$10$SOGg32JK0SI2sZzfKsgvd.f6PgPdp1W/9vg/raFcCPumloWBuoB92', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(494, 'PATRICK', NULL, 'masculin', NULL, '1159', '$2y$10$mvJP6QZAS/gGkbKnDIFrlus5gznSzBZxNCLi/bsm0c7uxxgkT2kK.', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(495, 'FABRICE', NULL, 'masculin', NULL, '9863', '$2y$10$7V03yUtw4.JJM0tVeqpIL.cg6787rPwUGg0.k7B9LMZ/HaCSijv8S', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(496, 'EVA', NULL, 'feminin', NULL, '8754', '$2y$10$dZtkQ69HbqAjy9NnHBDohOYv5irpGyCFK3Rl4fDiWzC1/o4t11BF2', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(497, 'LAURENT', NULL, 'masculin', NULL, '8800', '$2y$10$pPQJ.8bArcovPzw6zSH0W.L.hMJsoaHcy.I0WrEIWJxWarA0JV9oW', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(498, 'HORNELLA', NULL, 'feminin', NULL, '1452', '$2y$10$W3dYaXdGaUKH.dT91aCelelJ.IYyIZZxEOTUszPU4GY/MOT.WXftq', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(499, 'MARIA', NULL, 'feminin', NULL, '0033', '$2y$10$Kzw2xl.zSvu.rVEsidBX3OIiW5ARp9llM40QzNxAyoeIn0mY0EjJ6', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(500, 'BOBO', NULL, 'feminin', NULL, '9987', '$2y$10$.RJs7Tv/5rcOOpHDn3L4/.kWwGn5XlN6aFQ4CFtZCfvvGrAZQwOLe', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(501, 'CEDRICK', NULL, 'masculin', NULL, '4565', '$2y$10$HjLGYMOIHdx8.fxG42aE9uWa7R4Z/yYaWv0ehVTdcvuRU5T8TNZ5S', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(503, 'ELIANE', NULL, 'feminin', NULL, '6689', '$2y$10$ToYAqOIm2zr.BcLDl.sRX.LbCnbvJKTq6Cz8jGdOLoN53rEJvGwye', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/caissier.php', 'Caissier', 0, 0),
(504, 'LILIANE', NULL, 'feminin', NULL, '3358', '$2y$10$akvTwq9Tf0/2m2RrUZgQfucFgLoJM6zB2H9XoG.6vR3KnXZcvhmm2', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/caissier.php', 'Caissier', 0, 123),
(505, 'OLIVIER', NULL, 'masculin', NULL, '4529', '$2y$10$WmWMNuO0/Ju1mlTD/e9EA.n8UisFiguGCBivP2AVdupVT5xUyMYNm', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Caissier', 0, 123),
(506, 'ALLY', NULL, 'masculin', NULL, '5847', '$2y$10$LWu/NAAW/eBqudKdUMxXyeQ/pBe0.gXTcjP7l79lgIvvlZCExxRDS', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(507, 'DARIA', NULL, 'masculin', NULL, '4747', '$2y$10$22EGfX3boTEUsonFwGKxuOUDyDS21FAsFavnzvJ.tjiJpYZ6qm1Ae', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(508, 'ANGE', NULL, 'feminin', NULL, '7858', '$2y$10$E4SeJMpSav8jM/tt0TbCfOV52f6cLj4tkBzC6GblLn32iA6tJOepe', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(509, 'BARTHELEMY', NULL, 'masculin', NULL, '9966', '$2y$10$ekivk2JNSI.L8DbdX4.JReCO7YhLEwTsi01ufT8wxUZemCfCFMKN.', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(510, 'Honneur', NULL, 'masculin', NULL, '9984', '$2y$10$gn0SYkcN61ZRq/q9795YHeVLzWOCC.M7g20Zim3qYcfv7ATZDVsei', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(511, 'MESHACK MASEKI', NULL, 'masculin', NULL, '0145', '$2y$10$ifEnZZjImzwuaESkik1HoeldRqjBAwHNCe7wOgrn2WvL/op1RJUH.', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(512, 'FELLY', NULL, 'masculin', NULL, '5255', '$2y$10$yXKIMC2XY2qGAwMfE.Vd2e8xShRYTuzbrfll57JZADrQbb2U5LNXy', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(513, 'GUETRI', NULL, 'masculin', NULL, '9969', '$2y$10$lfJWNmocLykCwjIk894GTOqLwxh3gfRoEHZ2MV0O.u04FbLchIyFG', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(514, 'YANNICK', NULL, 'masculin', NULL, '7787', '$2y$10$mE/zTWny0JzG1dBVo3sXKutpJvlVLjowTPnl1PjYGkSwUmsu8WZLG', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123),
(515, 'Mireille', NULL, 'masculin', NULL, '2332', '$2y$10$uZVjMq0bU0si16iHGlUw6u2kDYEFNNALVfuqsgEKZFEJ74r26i6qa', NULL, 3, 1, 356, 299, 1, NULL, NULL, 'restaurant2/index.php', 'Restaurant', 0, 123);

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
  PRIMARY KEY (`id_validation`),
  KEY `produit_id` (`produit_id`,`fiche_id`,`hotel_id`),
  KEY `fiche_id` (`fiche_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_validation`
--

INSERT INTO `t_validation` (`id_validation`, `qte_envoye`, `qte_verif`, `motif_id`, `produit_id`, `fiche_id`, `hotel_id`) VALUES
(111, 100, 100, 7, 83, 380, 328),
(112, 100, 100, 7, 74, 380, 328),
(113, 100, 100, 7, 84, 380, 328),
(114, 100, 100, 7, 75, 380, 328),
(115, 100, 100, 7, 76, 380, 328),
(116, 100, 100, 7, 85, 380, 328),
(117, 100, 100, 7, 77, 380, 328),
(118, 100, 100, 7, 79, 380, 328),
(119, 100, 100, 7, 78, 380, 328),
(120, 10, 8, 7, 102, 406, 328),
(121, 15, 0, 6, 83, 412, 328),
(122, 10, 0, 6, 88, 412, 328),
(123, 10, 0, 6, 83, 413, 328),
(124, 5, 0, 6, 88, 413, 328),
(125, 1, 0, 6, 74, 423, 328),
(126, 1, 0, 6, 75, 423, 328);

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
  `type_vers` varchar(50) DEFAULT NULL,
  `paie_id` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `id_sousresto` int(11) DEFAULT NULL,
  `num` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_hotel` (`id_hotel`),
  KEY `user_vers` (`user_vers`),
  KEY `paie_id` (`paie_id`),
  KEY `id_sousresto` (`id_sousresto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_versement`
--

INSERT INTO `t_versement` (`id`, `user_vers`, `date_vers`, `montant_vers`, `montantusd`, `monaie_vers`, `taux`, `motif`, `type_vers`, `paie_id`, `id_hotel`, `id_sousresto`, `num`) VALUES
(1, 476, '2020-02-26', '2000.0000000000', '270.0000000000', 'USD', 1700.00, 'restaurant', 'restaurant', NULL, 356, 123, '00006'),
(2, 476, '2020-02-28', '355300.0000000000', '48.0000000000', 'USD', 1700.00, 'restaurant', 'restaurant', NULL, 356, 123, '00007'),
(3, 503, '2020-03-06', '0.0000000000', '497.8300000000', 'USD', 1650.00, 'restaurant', 'restaurant', NULL, 356, 123, '00008'),
(4, 503, '2020-03-07', '0.0000000000', '2178.0000000000', 'USD', 1650.00, 'restaurant', 'restaurant', NULL, 356, 123, '00009');

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
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `group_id` (`group_id`),
  KEY `affecteur_id` (`affecteur_id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users_groupes`
--

INSERT INTO `users_groupes` (`user_id`, `group_id`, `affecteur_id`, `dte`, `hotel_id`) VALUES
(412, 4, 411, '2018-11-16', 279),
(440, 1, 428, '2018-12-14', 289),
(441, 2, 428, '2018-12-25', NULL),
(442, 2, 428, '2018-12-25', NULL),
(444, 3, 443, '2019-01-14', 298),
(445, 3, 443, '2019-01-14', 298),
(455, 2, 455, '2019-09-26', NULL),
(456, 1, 455, '2019-03-22', 328),
(472, 1, 471, '2019-12-21', 356),
(472, 2, 471, '2019-12-21', 356),
(475, 4, 471, '2020-02-03', 356),
(476, 3, 471, '2020-02-03', 356),
(478, 5, 471, '2020-02-03', NULL),
(479, 4, 471, '2020-02-03', NULL),
(481, 6, 471, '2020-03-07', NULL),
(482, 6, 471, '2020-03-07', NULL),
(483, 6, 471, '2020-03-07', NULL),
(484, 4, 471, '2020-03-01', NULL),
(485, 4, 471, '2020-02-11', NULL),
(486, 4, 471, '2020-02-11', NULL),
(487, 4, 471, '2020-02-11', NULL),
(488, 4, 471, '2020-02-11', NULL),
(490, 4, 471, '2020-03-05', NULL),
(491, 4, 471, '2020-03-01', NULL),
(493, 4, 471, '2020-03-01', NULL),
(494, 4, 471, '2020-03-08', NULL),
(495, 4, 471, '2020-03-05', NULL),
(496, 4, 471, '2020-03-07', NULL),
(497, 4, 471, '2020-03-05', NULL),
(498, 4, 471, '2020-03-05', NULL),
(499, 4, 471, '2020-03-14', NULL),
(500, 4, 471, '2020-03-13', NULL),
(501, 4, 471, '2020-03-01', NULL),
(503, 3, 471, '2020-02-11', NULL),
(504, 3, 471, '2020-02-11', NULL),
(505, 4, 471, '2020-03-01', NULL),
(506, 4, 471, '2020-03-08', NULL),
(507, 4, 471, '2020-03-01', NULL),
(509, 4, 471, '2020-03-01', NULL),
(510, 4, 471, '2020-03-01', 356),
(511, 4, 471, '2020-03-01', NULL),
(512, 4, 471, '2020-03-01', NULL),
(513, 4, 471, '2020-03-08', NULL),
(514, 4, 471, '2020-03-08', NULL),
(515, 4, 471, '2020-03-14', NULL);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_commande`  AS  select `b`.`idprod` AS `idprod` from ((`t_facture` `a` join `stk_produit` `b`) join `lignes_commandes` `c`) where ((`a`.`id_fact` = `c`.`commande_id`) and (`c`.`produit_id` = `b`.`idprod`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_com_paiement`
--
DROP TABLE IF EXISTS `v_com_paiement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_com_paiement`  AS  select `b`.`mode` AS `modef`,`b`.`dte_time` AS `dte_timef`,`b`.`id_res` AS `id_res`,`b`.`id_fact` AS `id_fact`,`b`.`num_fact` AS `num_fact`,`b`.`res_ch_id` AS `res_ch_id`,`b`.`date_edition` AS `date_edition`,`b`.`tva` AS `tva`,`b`.`taux` AS `taux`,`b`.`monnaie` AS `monnaie`,`b`.`remise` AS `remise`,`b`.`id_sousresto` AS `id_sousresto`,`b`.`id_hotel` AS `id_hotel`,`b`.`company_id` AS `company_id`,`b`.`id_user` AS `id_user`,`b`.`type` AS `type`,`b`.`montant_total` AS `montant_total`,`b`.`mont_tva` AS `mont_tva`,`b`.`mont_ttc_remise` AS `mont_ttc_remise`,`b`.`mont_ttc` AS `mont_ttc`,`b`.`etat` AS `etat`,`e`.`montant` AS `montant_paye`,`h`.`id_client` AS `id_client`,`h`.`nom_client` AS `nom_client`,`h`.`type` AS `type_client` from ((((`t_facture` `b` join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) join `t_client` `h`) where ((`b`.`id_fact` = `d`.`id_fact`) and (`d`.`id_regl` = `e`.`regl_id`) and (`e`.`id_mode_regl` = `f`.`id_mode_regl`) and (`b`.`id_client` = `h`.`id_client`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_com_paiement_sresto`
--
DROP TABLE IF EXISTS `v_com_paiement_sresto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_com_paiement_sresto`  AS  select `b`.`mode` AS `modef`,`b`.`dte_time` AS `dte_timef`,`b`.`id_res` AS `id_res`,`b`.`id_fact` AS `id_fact`,`b`.`num_fact` AS `num_fact`,`b`.`res_ch_id` AS `res_ch_id`,`b`.`date_edition` AS `date_edition`,`b`.`tva` AS `tva`,`b`.`taux` AS `taux`,`b`.`monnaie` AS `monnaie`,`b`.`remise` AS `remise`,`b`.`id_sousresto` AS `id_sousresto`,`b`.`id_hotel` AS `id_hotel`,`b`.`company_id` AS `company_id`,`b`.`id_user` AS `id_user`,`b`.`type` AS `type`,`b`.`montant_total` AS `montant_total`,`b`.`mont_tva` AS `mont_tva`,`b`.`mont_ttc_remise` AS `mont_ttc_remise`,`b`.`mont_ttc` AS `mont_ttc`,`b`.`etat` AS `etat`,`e`.`montant` AS `montant_paye`,`h`.`id_client` AS `id_client`,`h`.`nom_client` AS `nom_client`,`h`.`type` AS `type_client`,`k`.`libelle` AS `resto` from (((((`t_facture` `b` join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) join `t_client` `h`) join `t_sousresto` `k`) where ((`b`.`id_fact` = `d`.`id_fact`) and (`d`.`id_regl` = `e`.`regl_id`) and (`e`.`id_mode_regl` = `f`.`id_mode_regl`) and (`b`.`id_client` = `h`.`id_client`) and (`b`.`id_sousresto` = `k`.`id_sousresto`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_factglobale`
--
DROP TABLE IF EXISTS `v_factglobale`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_factglobale`  AS  select `b`.`id_respo` AS `id_respo`,`b`.`entreprise` AS `entreprise`,`d`.`montant_total` AS `montant_total`,`d`.`mont_ttc_remise` AS `mont_ttc_remise`,`d`.`remise` AS `remise`,sum(`f`.`montant_dollar`) AS `montant_dollar`,sum(`f`.`montant_fc`) AS `montant_fc`,`a`.`id_hotel` AS `id_hotel`,`a`.`id_client` AS `id_client`,`a`.`nom_client` AS `nom_client`,`d`.`id_fact` AS `id_fact`,`d`.`num_fact` AS `num_fact`,`d`.`date_edition` AS `date_edition`,`d`.`res_ch_id` AS `res_ch_id`,`h`.`id_ch` AS `id_ch`,`h`.`num_ch` AS `num_ch`,`h`.`monnaie` AS `monnaie`,`h`.`tarif_ch` AS `tarif_ch`,`c`.`date_occ` AS `date_occ`,`c`.`date_lib` AS `date_lib`,`c`.`statut` AS `statut`,`d`.`type` AS `type`,`f`.`id_mode_regl` AS `id_mode_regl` from ((((((`t_client` `a` join `t_responsable` `b`) join `t_reserve_chambre` `c`) join `t_facture` `d`) join `t_reglement` `f`) join `t_mode_reglement` `g`) join `t_chambre` `h`) where ((`a`.`id_respo` = `b`.`id_respo`) and (`c`.`id_client` = `a`.`id_client`) and (`c`.`id` = `d`.`res_ch_id`) and (`d`.`id_fact` = `f`.`id_fact`) and (`f`.`id_mode_regl` = `g`.`id_mode_regl`) and (`h`.`id_ch` = `c`.`idchambre`) and (`a`.`type_cl` = 'client partenaire') and (`f`.`rejete` = 0)) group by `f`.`id_fact` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_factglobale_clioccas`
--
DROP TABLE IF EXISTS `v_factglobale_clioccas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_factglobale_clioccas`  AS  select `b`.`id_respo` AS `id_respo`,`b`.`entreprise` AS `entreprise`,`d`.`montant_total` AS `montant_total`,`d`.`mont_ttc_remise` AS `mont_ttc_remise`,`d`.`remise` AS `remise`,sum(`f`.`montant_dollar`) AS `montant_dollar`,sum(`f`.`montant_fc`) AS `montant_fc`,`a`.`id_hotel` AS `id_hotel`,`a`.`id_client` AS `id_client`,`a`.`nom_client` AS `nom_client`,`d`.`id_fact` AS `id_fact`,`d`.`num_fact` AS `num_fact`,`d`.`date_edition` AS `date_edition`,`d`.`res_ch_id` AS `res_ch_id`,`h`.`id_ch` AS `id_ch`,`h`.`num_ch` AS `num_ch`,`h`.`monnaie` AS `monnaie`,`h`.`tarif_ch` AS `tarif_ch`,`c`.`date_occ` AS `date_occ`,`c`.`date_lib` AS `date_lib`,`c`.`statut` AS `statut`,`d`.`type` AS `type`,`f`.`id_mode_regl` AS `id_mode_regl` from ((((((`t_client` `a` join `t_responsable` `b`) join `t_reserve_chambre` `c`) join `t_facture` `d`) join `t_reglement` `f`) join `t_mode_reglement` `g`) join `t_chambre` `h`) where ((`a`.`id_respo` = `b`.`id_respo`) and (`c`.`id_client` = `a`.`id_client`) and (`c`.`id` = `d`.`res_ch_id`) and (`d`.`id_fact` = `f`.`id_fact`) and (`f`.`id_mode_regl` = `g`.`id_mode_regl`) and (`h`.`id_ch` = `c`.`idchambre`) and (`a`.`type_cl` = 'client occasionnel') and (`f`.`rejete` = 0)) group by `f`.`id_fact` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_hebergement`
--
DROP TABLE IF EXISTS `v_hebergement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hebergement`  AS  select `a`.`id_res` AS `id_res`,`a`.`type` AS `type`,`a`.`num_reserv` AS `num_reserv`,`a`.`dte` AS `dte`,`a`.`dte_a` AS `dte_a`,`a`.`dte_s` AS `dte_s`,`b`.`id_fact` AS `id_fact`,`a`.`garantie` AS `garantie`,`b`.`type` AS `type_fac`,`b`.`date_edition` AS `date_edition`,`b`.`taux` AS `taux`,`b`.`tva` AS `tva`,`b`.`monnaie` AS `monnaie`,`b`.`mont_tva` AS `mont_tva`,`b`.`remise` AS `mont_remise`,`b`.`mont_ttc_remise` AS `mont_ttc_remise`,`b`.`id_user` AS `id_user`,`c`.`id` AS `idres_ch`,`c`.`statut` AS `statut`,`c`.`date_occ` AS `date_occ`,`c`.`date_lib` AS `date_lib`,`c`.`tarif_ch` AS `tarif_ch`,`e`.`montant` AS `mont_paye`,`e`.`justification` AS `justification`,`f`.`lib` AS `lib`,`g`.`num_ch` AS `num_ch`,`h`.`nom_client` AS `nom_client`,`i`.`nom_user` AS `nom_user`,`j`.`entreprise` AS `nom_respo`,`e`.`company_id` AS `company_id`,`a`.`id_hotel` AS `id_hotel`,`g`.`id_ch` AS `id_ch`,`k`.`tarif_ch` AS `tarif_histo`,`k`.`statut` AS `statut_histo`,`k`.`date_occ` AS `date_occ_histo`,`k`.`date_lib` AS `date_lib_histo`,`k`.`id` AS `id_histo`,`k`.`idchambre` AS `id_ch_histo`,`k`.`idres_ch` AS `idres_ch_histo` from ((((((((((`t_reservation` `a` join `t_facture` `b`) join `t_reserve_chambre` `c`) join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) join `t_chambre` `g`) join `t_client` `h`) join `t_utilisateur` `i`) join `t_responsable` `j`) join `t_chambre_histo` `k`) where ((`a`.`id_res` = `b`.`id_res`) and (`b`.`id_fact` = `c`.`idfact`) and (`b`.`id_fact` = `d`.`id_fact`) and (`d`.`id_regl` = `e`.`regl_id`) and (`e`.`id_mode_regl` = `f`.`id_mode_regl`) and (`g`.`id_ch` = `k`.`idchambre`) and (`c`.`id` = `k`.`idres_ch`) and (`b`.`id_client` = `h`.`id_client`) and (`b`.`id_user` = `i`.`id_user`) and (`h`.`id_respo` = `j`.`id_respo`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_packs`
--
DROP TABLE IF EXISTS `v_packs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_packs`  AS  select `pa`.`id` AS `idpack`,`pa`.`libelle` AS `libelle`,`pa`.`etat` AS `etat`,`mo`.`id` AS `idmodule`,`mo`.`nom` AS `nom` from ((`t_module_pack` `mp` join `t_pack` `pa`) join `module` `mo`) where ((`mp`.`pack_id` = `pa`.`id`) and (`mp`.`module_id` = `mo`.`id`)) order by `pa`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_paiement`
--
DROP TABLE IF EXISTS `v_paiement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_paiement`  AS  select `b`.`id_res` AS `id_res`,`b`.`id_fact` AS `id_fact`,`b`.`num_fact` AS `num_fact`,`b`.`res_ch_id` AS `res_ch_id`,`b`.`date_edition` AS `date_edition`,`b`.`tva` AS `tva`,`b`.`taux` AS `taux`,`b`.`remise` AS `remise`,`b`.`type` AS `type`,`b`.`montant_total` AS `montant_total`,`b`.`mont_tva` AS `mont_tva`,`b`.`mont_ttc_remise` AS `mont_ttc_remise`,`b`.`mont_ttc` AS `mont_ttc`,`b`.`monnaie` AS `monnaie`,`b`.`id_client` AS `id_client`,`b`.`id_hotel` AS `id_hotel`,`b`.`dte_blocage` AS `dte_blocage`,`b`.`date_echeance` AS `date_echeance`,`b`.`date_desactivation` AS `date_desactivation`,`e`.`montantusd` AS `montant_usd`,`e`.`montantcdf` AS `montant_cdf`,`e`.`taux` AS `taux_paie`,`b`.`etat` AS `etat`,`e`.`montant` AS `montant_paye`,`e`.`rendu` AS `rendu` from (((`t_facture` `b` join `t_reglement` `d`) join `paiement` `e`) join `t_mode_reglement` `f`) where ((`b`.`id_fact` = `d`.`id_fact`) and (`d`.`id_regl` = `e`.`regl_id`) and (`e`.`id_mode_regl` = `f`.`id_mode_regl`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_reglement`
--
DROP TABLE IF EXISTS `v_reglement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reglement`  AS  select `b`.`id_respo` AS `id_respo`,`b`.`entreprise` AS `entreprise`,`d`.`montant_total` AS `montant_total`,sum(`f`.`montant_dollar`) AS `montant_dollar`,sum(`f`.`montant_fc`) AS `montant_fc`,`a`.`id_hotel` AS `id_hotel`,`a`.`id_client` AS `id_client`,`a`.`nom_client` AS `nom_client`,`d`.`id_fact` AS `id_fact`,`d`.`num_fact` AS `num_fact`,`d`.`date_edition` AS `date_edition`,`d`.`remise` AS `remise`,`d`.`type` AS `type`,`d`.`mont_ttc_remise` AS `mont_ttc_remise` from (((((`t_client` `a` join `t_responsable` `b`) join `t_reserve_chambre` `c`) join `t_facture` `d`) join `t_reglement` `f`) join `t_mode_reglement` `g`) where ((`a`.`id_respo` = `b`.`id_respo`) and (`c`.`id_client` = `a`.`id_client`) and (`c`.`id` = `d`.`res_ch_id`) and (`d`.`id_fact` = `f`.`id_fact`) and (`f`.`id_mode_regl` = `g`.`id_mode_regl`) and (`g`.`lib` = 'Credit') and (`a`.`type_cl` = 'client partenaire')) group by `f`.`id_fact` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_souscription`
--
DROP TABLE IF EXISTS `v_souscription`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_souscription`  AS  select `c`.`id_c` AS `id_c`,`c`.`nom_c` AS `nom_c`,`c`.`etat` AS `etat`,`c`.`adresse_c` AS `adresse_c`,concat(`u`.`nom_user`,' ',`u`.`prenom_user`) AS `resposable`,`u`.`telephone_user` AS `telephone_user`,`s`.`libelle` AS `libelle`,`s`.`date_sous` AS `date_sous`,`s`.`date_activ` AS `date_activ`,`s`.`montant_tot_sous` AS `montant_tot_sous`,`s`.`mode_paie` AS `mode_paie`,`m`.`id` AS `idmodule`,`m`.`nom` AS `nom`,`mc`.`nbreuser` AS `nbreuser`,`mc`.`id` AS `module_id`,`mc`.`etat_module` AS `etat_module`,`mc`.`montantmodule` AS `montantmodule`,`mc`.`date_sous` AS `dte_sous`,`mc`.`date_activ` AS `dte_activ`,`p`.`souscription` AS `type_souscription`,`p`.`prix_user` AS `prix_user` from (((((`t_company` `c` join `souscription` `s`) join `module` `m`) join `prix` `p`) join `t_modulecompany` `mc`) join `t_utilisateur` `u`) where ((`mc`.`company_id` = `c`.`id_c`) and (`mc`.`module_id` = `m`.`id`) and (`mc`.`souscription_id` = `s`.`id`) and (`mc`.`prix_id` = `p`.`id`) and (`u`.`company_id` = `c`.`id_c`) and (`u`.`type` = 1)) ;

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
-- Contraintes pour la table `platspreparations`
--
ALTER TABLE `platspreparations`
  ADD CONSTRAINT `platspreparations_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `stk_produit` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `prix`
--
ALTER TABLE `prix`
  ADD CONSTRAINT `prix_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `t_pack` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resbonmalade`
--
ALTER TABLE `resbonmalade`
  ADD CONSTRAINT `resbonmalade_ibfk_1` FOREIGN KEY (`idemploy`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resbonmalade_ibfk_2` FOREIGN KEY (`idmembr`) REFERENCES `resemployefamille` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resbonmalade_ibfk_3` FOREIGN KEY (`idsite`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resbonmalade_ibfk_4` FOREIGN KEY (`emplyprisencharg`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rescategorie`
--
ALTER TABLE `rescategorie`
  ADD CONSTRAINT `rescategorie_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resconge`
--
ALTER TABLE `resconge`
  ADD CONSTRAINT `resconge_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rescontrat`
--
ALTER TABLE `rescontrat`
  ADD CONSTRAINT `rescontrat_ibfk_1` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resdeclaration`
--
ALTER TABLE `resdeclaration`
  ADD CONSTRAINT `resdeclaration_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resdepartement`
--
ALTER TABLE `resdepartement`
  ADD CONSTRAINT `resdepartement_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resempconge`
--
ALTER TABLE `resempconge`
  ADD CONSTRAINT `resempconge_ibfk_1` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resempconge_ibfk_2` FOREIGN KEY (`conge_id`) REFERENCES `resconge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resempconge_ibfk_3` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resemploycontr`
--
ALTER TABLE `resemploycontr`
  ADD CONSTRAINT `resemploycontr_ibfk_1` FOREIGN KEY (`idemploy`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemploycontr_ibfk_2` FOREIGN KEY (`idcontr`) REFERENCES `rescontrat` (`idcontr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resemployefamille`
--
ALTER TABLE `resemployefamille`
  ADD CONSTRAINT `resemployefamille_ibfk_1` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resemployehoraire`
--
ALTER TABLE `resemployehoraire`
  ADD CONSTRAINT `resemployehoraire_ibfk_1` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemployehoraire_ibfk_2` FOREIGN KEY (`horaire_id`) REFERENCES `reshoraire` (`idh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemployehoraire_ibfk_4` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemployehoraire_ibfk_5` FOREIGN KEY (`affectation_id`) REFERENCES `resaffectation` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `resemployehoraire_ibfk_6` FOREIGN KEY (`agent_permt_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resemployes`
--
ALTER TABLE `resemployes`
  ADD CONSTRAINT `resemployes_ibfk_1` FOREIGN KEY (`fonction_id`) REFERENCES `resfonction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemployes_ibfk_2` FOREIGN KEY (`departement_id`) REFERENCES `resdepartement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resemploye_eligibl`
--
ALTER TABLE `resemploye_eligibl`
  ADD CONSTRAINT `resemploye_eligibl_ibfk_1` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemploye_eligibl_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resemprunt`
--
ALTER TABLE `resemprunt`
  ADD CONSTRAINT `resemprunt_ibfk_1` FOREIGN KEY (`libelle`) REFERENCES `resrubrique` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemprunt_ibfk_2` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resemprunt_ibfk_3` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservationconfig`
--
ALTER TABLE `reservationconfig`
  ADD CONSTRAINT `reservationconfig_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resfonction`
--
ALTER TABLE `resfonction`
  ADD CONSTRAINT `resfonction_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resfonction_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `rescategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reshoraire`
--
ALTER TABLE `reshoraire`
  ADD CONSTRAINT `reshoraire_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reshorairejours`
--
ALTER TABLE `reshorairejours`
  ADD CONSTRAINT `reshorairejours_ibfk_1` FOREIGN KEY (`horaire_id`) REFERENCES `reshoraire` (`idh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reshorairejours_ibfk_2` FOREIGN KEY (`jours_id`) REFERENCES `resjours` (`idjrs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `respermutation`
--
ALTER TABLE `respermutation`
  ADD CONSTRAINT `respermutation_ibfk_1` FOREIGN KEY (`idhoraire`) REFERENCES `reshoraire` (`idh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respermutation_ibfk_2` FOREIGN KEY (`idsite`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respermutation_ibfk_3` FOREIGN KEY (`idagent1`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respermutation_ibfk_4` FOREIGN KEY (`idagent2`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `respointage`
--
ALTER TABLE `respointage`
  ADD CONSTRAINT `respointage_ibfk_1` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respointage_ibfk_3` FOREIGN KEY (`horaire_id`) REFERENCES `reshoraire` (`idh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respointage_ibfk_4` FOREIGN KEY (`idsite`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `respointagehoraire`
--
ALTER TABLE `respointagehoraire`
  ADD CONSTRAINT `respointagehoraire_ibfk_1` FOREIGN KEY (`pointage_id`) REFERENCES `respointage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respointagehoraire_ibfk_3` FOREIGN KEY (`hjr_id`) REFERENCES `reshorairejours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resremboursement`
--
ALTER TABLE `resremboursement`
  ADD CONSTRAINT `resremboursement_ibfk_1` FOREIGN KEY (`employe_id`) REFERENCES `resemployes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resremboursement_ibfk_2` FOREIGN KEY (`salaire_id`) REFERENCES `ressalaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resremboursement_ibfk_3` FOREIGN KEY (`emprunt_id`) REFERENCES `resemprunt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resrubrique`
--
ALTER TABLE `resrubrique`
  ADD CONSTRAINT `resrubrique_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `resrubriquecateg`
--
ALTER TABLE `resrubriquecateg`
  ADD CONSTRAINT `resrubriquecateg_ibfk_1` FOREIGN KEY (`rubrique_id`) REFERENCES `resrubrique` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resrubriquecateg_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `rescategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `souscription`
--
ALTER TABLE `souscription`
  ADD CONSTRAINT `souscription_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_utilisateur` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stk_famille`
--
ALTER TABLE `stk_famille`
  ADD CONSTRAINT `stk_famille_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stk_sous_famille`
--
ALTER TABLE `stk_sous_famille`
  ADD CONSTRAINT `stk_sous_famille_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stk__mouvement`
--
ALTER TABLE `stk__mouvement`
  ADD CONSTRAINT `stk__mouvement_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stk__mouvement_ibfk_2` FOREIGN KEY (`fiche_id`) REFERENCES `skt_fiche` (`id_fiche`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suivifactures`
--
ALTER TABLE `suivifactures`
  ADD CONSTRAINT `suivifactures_ibfk_1` FOREIGN KEY (`facture_id`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_client`
--
ALTER TABLE `t_client`
  ADD CONSTRAINT `t_client_ibfk_1` FOREIGN KEY (`id_sous_compte`) REFERENCES `cptsouscomptes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_client_ibfk_2` FOREIGN KEY (`id_hotel`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_facture`
--
ALTER TABLE `t_facture`
  ADD CONSTRAINT `t_facture_ibfk_1` FOREIGN KEY (`id_res`) REFERENCES `t_reservation` (`id_res`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_operation`
--
ALTER TABLE `t_operation`
  ADD CONSTRAINT `t_operation_ibfk_1` FOREIGN KEY (`detail_id_ecrit`) REFERENCES `cptdetailsecritures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_operation_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_pack_company`
--
ALTER TABLE `t_pack_company`
  ADD CONSTRAINT `t_pack_company_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_prix_produit`
--
ALTER TABLE `t_prix_produit`
  ADD CONSTRAINT `t_prix_produit_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `stk_produit` (`idprod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_reglement`
--
ALTER TABLE `t_reglement`
  ADD CONSTRAINT `t_reglement_ibfk_1` FOREIGN KEY (`id_fact`) REFERENCES `t_facture` (`id_fact`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_reservation`
--
ALTER TABLE `t_reservation`
  ADD CONSTRAINT `t_reservation_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_reserve_chambre`
--
ALTER TABLE `t_reserve_chambre`
  ADD CONSTRAINT `t_reserve_chambre_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_versement`
--
ALTER TABLE `t_versement`
  ADD CONSTRAINT `t_versement_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `t_hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
