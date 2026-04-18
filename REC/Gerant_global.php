<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<?php

// Définition de la classe Hotel
class Hotel {

    public $nom_hotel;
    public $adresse_hotel;
    public $province_hotel;
    public $ville_hotel;
    public $etat;
    public $default_site;
    public $company_id;
    public $statut_site;

// Définition du constructeur
    function __construct($nom_hotel, $adresse_hotel, $province_hotel, $ville_hotel,$etat,$default_site, $company_id, $statut_site) {

        $this->nom_hotel = $nom_hotel;
        $this->adresse_hotel = $adresse_hotel;
        $this->province_hotel = $province_hotel;
        $this->ville_hotel = $ville_hotel;
        $this->etat = $etat;
        $this->default_site = $default_site;
        $this->company_id = $company_id;
        $this->statut_site = $statut_site;
    }

// Définition de la fonction ajouter chambre
     public function ajouterhotel($monnaie_prix,$monnaie_fac,$taux,$tva,$checkin,$checkout,$user_id,$idnat,$rccm,$mail,$tel) {
        //creation site
        include '../bdd/connexion_mysql.php';
        $req_sql_site = 'INSERT INTO t_hotel VALUES (NULL,"' . $this->nom_hotel . '","' . $this->adresse_hotel . '","' . $this->province_hotel . '","' . $this->ville_hotel . '",' . $this->etat . ',"' . $this->default_site . '","' . $this->company_id . '","' . $this->statut_site . '","' . $idnat . '","' . $rccm . '","' . $mail . '","' . $tel . '")';
        mysql_query($req_sql_site) or die("impossible d'executer la requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
        $hotel = mysql_insert_id();
        //insertion monnaie taux tva & time
        $req_sql_regl= 'INSERT INTO t_reglage(temps_regl,m_insert,m_affiche,tauxdollar,tva,user_id,id_hotel,company_id) VALUES ("' . $checkin . '","' . $monnaie_prix . '","' . $monnaie_fac . '",' . $taux . ',' . $tva . ',' . $user_id . ',' .$hotel . ',' . $this->company_id . ')';
        mysql_query($req_sql_regl) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
        //Configuration du site
        include '../bdd/connexion.php';
        include '../souscription/data_configuration.php';

    }


// Définition de la fonction consulter hotel
    public function consulterhotel() {
        include '../bdd/connexion_mysql.php';
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Site</th>
                                            <th>Adresse</th>
                                            <th>Province</th>
                                            <th>Ville</th>
                                            <th>Statut</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT * FROM  t_hotel h WHERE id_hotel<>1 AND company_id=".$_SESSION['company_id']." ORDER BY h.id_hotel DESC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            if($rows['statut_site']=='inopérationnel'){
               echo'   <tr style="color:red">
                    <td>' . $compt . '</a></td>
                    <td>' . $rows['nom_hotel'] . '</a></td>
                    <td>' . $rows['adresse_hotel'] . '</td>
                    <td class="center">' . $rows['province_hotel'] . '</td>
                    <td class="center">' . $rows['ville_hotel'] . '</td>
                    <td class="center"><a class="setting-module" href="../appstore.php?site=' . $rows['id_hotel'] . '" title="Cliquez ici pour ajouter des applications">' . $rows['statut_site'] . '</a></td>
                     <td class="center">'?>  <?php if (in_array('CMIH',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?><?php echo '<a onClick="document.location=\'gg_maj_hotel.php?id_hotel=' . $rows['id_hotel'] . '\'"> Detail</a>'?><?php }?><?php echo '</td>
                         <td class="center">'?>  <?php if (in_array('CMIH',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                       <?php echo '<a onClick="document.location=\'factures_company.php?id=' . $rows['id_hotel'] . '\'">Factures</a>'?><?php }?><?php echo '</td>
                </tr>';
            }  else {
                echo'   <tr>
                    <td>' . $compt . '</a></td>
                    <td>' . $rows['nom_hotel'] . '</a></td>
                    <td>' . $rows['adresse_hotel'] . '</td>
                    <td class="center">' . $rows['province_hotel'] . '</td>
                    <td class="center">' . $rows['ville_hotel'] . '</td>
                    <td class="center">' . $rows['statut_site'] . '</td>
                    <td class="center">'?>  <?php if (in_array('CMIH',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                        <?php echo '<a onClick="document.location=\'gg_maj_hotel.php?id_hotel=' . $rows['id_hotel'] . '\'"> Detail</a>'?><?php }?><?php echo '</td>
                    <td class="center">'?>  <?php if (in_array('CMIH',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                       <?php echo '<a onClick="document.location=\'factures_company.php?id=' . $rows['id_hotel'] . '\'"> Factures</a>'?><?php }?><?php echo '</td>
                </tr>';
            }

        }

        echo'                                  </tbody>
                                </table> </div>';
    }

}

// Définition de la classe Reglage
class Reglage {

    public $remise;
    public $majoration;
    public $date_regl;
    public $temps_jour;

// Définition du constructeur
    function __construct($remise, $majoration, $date_regl, $temps_jour) {

        $this->remise = $remise;
        $this->majoration = $majoration;
        $this->date_regl = $date_regl;
        $this->temps_jour = $temps_jour;
    }

// Définition de la fonction ajouter reglage
    public function nouveaureglage() {
        include '../bdd/connexion_mysql.php';
//_requete t_reglage
        $req_sql = 'INSERT INTO t_utilisateur VALUES (NULL,"' . $this->remise . '","' . $this->majoration . '","' . $this->date_regl . '","' . $this->temps_jour . '")"';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

// Définition de la fonction consulter hotel
    public function voirreglage() {
        include '../bdd/connexion_mysql.php';
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Taux dollar</th>
                                            <th>Rémise</th>
                                            <th>Majoration</th>
                                            <th>Temps de la nuité</th>
                                            <th>TVA</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT * FROM t_reglage ORDER BY id_regl DESC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo'                           <tr>
                                            <td>' . $compt . '</a></td>
                                            <td>' . $rows['tauxdollar'] . '</td>
                                            <td>' . $rows['remise'] . '%</a></td>
                                            <td>' . $rows['majoration'] . '%</td>
                                            <td>' . $rows['temps_regl'] . '</td>
                                            <td>' . $rows['tva'] . '%</td>
                                            <td>' . $rows['dte_h'] . '</td>
                                             <td class="center">
                                            '?>  <?php if (in_array('CDT',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?><?php echo '<a onClick="document.location=\'gl_maj_reglages.php?id_regl=' . $rows['id_regl'] . '\'"><img src="../img/edit.png">&nbsp;&nbsp;Modifier</a>'?><?php }?><?php echo '
                                          </td>
                                        </tr>';
        }


        echo'                   </tbody>
                                </table> </div>';
    }

}

#############################################################################################################################################

class Utilisateur {

    public $nom_user;
    public $prenom_user;
    public $sexe_user;
    public $telephone_user;
    public $email_user;
    public $mdp_user;
    public $id_hotel;
    public $id_droit;

// Définition du constructeur
    function __construct($nom_user, $prenom_user, $sexe_user, $telephone_user, $email_user, $mdp_user, $id_hotel, $id_droit) {
        $this->nom_user = $nom_user;
        $this->prenom_user = $prenom_user;
        $this->sexe_user = $sexe_user;
        $this->telephone_user = $telephone_user;
        $this->email_user = $email_user;
        $this->mdp_user = $mdp_user;
        $this->id_hotel = $id_hotel;
        $this->id_droit = $id_droit;
    }

// Définition de la fonction ajouter utilisateur
    public function ajouter_utilisateur() {
        include '../bdd/connexion_mysql.php';

//_requete
        $req_sql = 'INSERT INTO t_utilisateur VALUES (NULL,"' . $this->nom_user . '","' . $this->prenom_user . '","' . $this->sexe_user . '","' . $this->telephone_user . '","' . $this->email_user . '","' . $this->mdp_user . '",' . $this->id_hotel . ',' . $this->id_droit . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

// Définition de la fonction consulter hotel
    public function lister_utilisateur() {
        include '../bdd/connexion_mysql.php';
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Sexe</th>
                                            <th>Telephone</th>
                                            <th>E-mail</th>
                                            <th>Mot de passe</th>
                                            <th>Hotel</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT u.id_user,u.nom_user,u.prenom_user,u.sexe_user,u.telephone_user,u.email_user,u.mdp_user,h.nom_hotel,d.libe_droit FROM t_utilisateur u,t_hotel h,t_droit d WHERE u.id_hotel=h.id_hotel AND u.id_droit=d.id_droit") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo'                                        <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_user'] . '</td>
                                            <td>' . $rows['prenom_user'] . '</td>
                                            <td>' . $rows['sexe_user'] . '</td>
                                            <td>' . $rows['telephone_user'] . '</td>
                                            <td>' . $rows['email_user'] . '</td>
                                            <td>' . $rows['mdp_user'] . '</td>
                                            <td>' . $rows['nom_hotel'] . '</td>
                                            <td>' . $rows['libe_droit'] . '</td>
                                             <td class="center"><a onClick="document.location=\'gg_modifier_gerant_local.php?id_user=' . $rows['id_user'] . '\'"><img src="../img/edit.png">&nbsp;&nbsp;Modifier</a>&nbsp;&nbsp;<a onClick="document.location=\'gg_liste_gerant_local.php?id_ch=' . $rows['id_user'] . '\'"><img src="../img/drop.png">&nbsp;&nbsp;Supprimer</a></td>
                                        </tr>';
        }


        echo'                                  </tbody>
                                </table> </div>';
    }

}

class Partenaire {
    public $hotel_id;
    public $nom_respo;
    public $telephone_respo;
    public $adresse_respo;
    public $entreprise;
    public $company_id;

    function __construct($nom_respo, $telephone_respo, $adresse_respo, $entreprise,$company_id) {
        $this->nom_respo = $nom_respo;
        $this->telephone_respo = $telephone_respo;
        $this->adresse_respo = $adresse_respo;
        $this->entreprise = $entreprise;
        $this->company_id = $company_id;
    }

    public function ajout_Partenaire() {
        include '../bdd/connexion_mysql.php';
        //_requete
        $req_sql = "INSERT INTO t_responsable VALUES (NULL, '" . $this->nom_respo . "','" . $this->telephone_respo . "','" . $this->adresse_respo . "','" . $this->entreprise . "','0','" . $this->company_id. "')";
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
        }
    public function affect_Partenaire($id_part,$hotel_id) {
        include '../bdd/connexion_mysql.php';
        $req_sql1 = "INSERT INTO partenaire_hotel VALUES (NULL, " . $id_part . "," .$hotel_id.")";
        mysql_query($req_sql1) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");

    }

    public function consulterPartenaire() {
        include '../bdd/connexion_mysql.php';
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Entreprise</th>
                                            <th>Responsable</th>
                                            <th>contact</th>
                                            <th>Adresse</th>
                                            <th></th>
                                             <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        //requette_

        $company_id = $_SESSION['company_id'];
        $compt = 0;
        $result = mysql_query("SELECT c.id_respo,c.nom_respo,c.telephone_respo,c.adresse_respo,c.entreprise FROM  t_responsable c WHERE c.entreprise!='prive' AND c.company_id=".$company_id." ORDER BY c.entreprise ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo '                        <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['entreprise'] . '</td>
                                            <td class="center">' . $rows['nom_respo'] . '</td>
                                            <td class="center">' . $rows['telephone_respo'] . '</td>
                                            <td>' . $rows['adresse_respo'] . '</td>
                                             <td class="center">'?>  <?php if (in_array('CMP',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?><?php echo '<a onClick="document.location=\'gl_maj_responsable.php?id_rep=' . $rows['id_respo'] . '\'"><img src="../img/edit.png">&nbsp;&nbsp;Modifier</a>'?><?php }?><?php echo '</td>
                                             <td class="center">'?>  <?php if (in_array('CSP',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?><?php echo '<a onClick="document.location=\'gl_del_responsable.php?id_rep=' . $rows['id_respo'] . '\'"><img src="../img/drop.png">&nbsp;&nbsp;Supprimer</a>'?><?php }?><?php echo '</td>
                                        </tr>';
        }

        echo '                                  </tbody>
                                </table> </div>';
    }

}

?>
