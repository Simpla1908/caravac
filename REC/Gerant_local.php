<?php

if (!isset($_SESSION)) {
    session_start();


}
include '../bdd/connexion.php';
//include './Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../FUNCTION/hebergement.php';
include '../bdd/connexion_mysql.php';
?>
<?php

// Définition de la classe Chambre
class Chambre
{

    public $num_ch;
    public $etat_ch;
    public $tarif_ch;
    public $monnaie;
    public $reserve;
    public $occupe;
    public $libre;
    public $capacite;
    public $categorie;
    public $niveau;
    public $id_hotel;

// Définition du constructeur
    function __construct($num_ch, $etat_ch, $tarif_ch, $monnaie, $reserve, $occupe, $libre, $capacite, $categorie, $niveau, $id_hotel)
    {

        $this->num_ch = $num_ch;
        $this->etat_ch = $etat_ch;
        $this->tarif_ch = $tarif_ch;
        $this->monnaie = $monnaie;
        $this->reserve = $reserve;
        $this->occupe = $occupe;
        $this->libre = $libre;
        $this->capacite = $capacite;
        $this->categorie = $categorie;
        $this->niveau = $niveau;
        $this->id_hotel = $id_hotel;
    }

// Définition de la fonction ajouter chambre
    public function ajouterchambre()
    {

//_requete
        $req_sql = 'INSERT INTO t_chambre VALUES (NULL,"' . $this->num_ch . '","' . $this->etat_ch . '",' . $this->tarif_ch . ',"' . $this->monnaie . '","' . $this->reserve . '","' . $this->occupe . '","' . $this->libre . '",' . $this->capacite . ',' . $this->capacite . ',' . $this->categorie . ',' . $this->niveau . ',' . $this->id_hotel . ',0)';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

// Définition de la fonction consulter chambre
    public function consulterchambre($id_hotel)
    {

        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Numéro</th>
                                            <th>Etat</th>
                                            <th>Tarif</th>
                                            <th>Categorie</th>
                                            <th>Niveau</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT c.id_ch,c.num_ch,c.monnaie,c.etat_ch,c.tarif_ch,k.lib_cat_cha,n.lib_niv_cha FROM  t_chambre c,categorie_chambre k,niveau_chambre n WHERE c.id_hotel='$id_hotel' AND k.id_cat_cha=c.categorie AND n.id_niv_cha=c.niveau  AND c.del=0 ORDER BY c.id_ch ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;

            echo '<tr>
<td>' . $compt . '</td>
<td>' . $rows['num_ch'] . '</td>
<td class="center">' . $rows['etat_ch'] . '</td>
<td class="center">' .afficheMontant($_SESSION['m_affiche'],montant_equivalent_bdd($rows['monnaie'],$_SESSION['m_affiche'],$_SESSION['tauxdollar'],$rows['tarif_ch'])). '</td>
    <td class="center">' . $rows['lib_cat_cha'] . '</td>
        <td class="center">' . $rows['lib_niv_cha'] . '</td>
 <td class="center"><a onClick="document.location=\'gl_maj_chambre.php?module=MH&id_ch=' . $rows['id_ch'] . '\'"><img src="../img/edit.png"> Modifier</a></td>
 <td class="center"><a onClick="document.location=\'gl_consultation_chambre.php?module=MH&id_ch=' . $rows['id_ch'] . '\'"><img src="../img/drop.png">Supprimer</a></td>
</tr>';
        }


        echo '                                  </tbody>
                                </table> </div>';
    }

// Définition de la fonction maj chambre
    public function majchambre($id_ch)
    {

//_requete
        $req_sql = mysql_query("UPDATE t_chambre SET
num_ch='" . $this->num_ch . "',
etat_ch='" . $this->etat_ch . "',
tarif_ch='.$this->tarif_ch.',
monnaie='USD',
capacite_init='" . $this->capacite . "',
categorie='" . $this->categorie . "',
niveau='" . $this->niveau . "'
WHERE id_ch='$id_ch'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

// Définition de la fonction supprimer chambre
    public function delchambre($id_ch)
    {
        $delete = 1;
        $req_sql = mysql_query("UPDATE t_chambre SET del='" . $delete . "' WHERE id_ch='$id_ch'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

}

class Categorie
{

    public $categorie;
    public $id_hotel;

// Définition du constructeur
    function __construct($categorie, $id_hotel)
    {
        $this->categorie = $categorie;
        $this->id_hotel = $id_hotel;
    }

// Définition de la fonction ajouter categorie
    public function ajoutercategorie()
    {
        $req_sql = 'INSERT INTO categorie_chambre VALUES (NULL,"' . $this->categorie . '",' . $this->id_hotel . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

// Définition de la fonction consulter categorie
    public function consultercategorie($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Libelle</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT c.id_cat_cha,c.lib_cat_cha FROM  categorie_chambre c WHERE c.hotel_id='$id_hotel' ORDER BY c.lib_cat_cha ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo '                                        <tr>
                                            <td>' . $compt . '</td>
<td>' . $rows['lib_cat_cha'] . '</td>
<td class="center"><a onClick="document.location=\'modif_cat.php?module=MH&id_cat=' . $rows['id_cat_cha'] . '\'"><img src="../img/edit.png"> Modifier</a></td>
<td class="center"><a onClick="document.location=\'liste_categorie.php?module=MH&id_cat=' . $rows['id_cat_cha'] . '\'"><img src="../img/drop.png">Supprimer</a></td>


                                        </tr>';
        }


        echo '                                  </tbody>
                                </table> </div>';
    }

    // Définition de la fonction maj niveau
    public function majcategorie($id_cat)
    {

        //_requete
        $req_sql = mysql_query("UPDATE  categorie_chambre SET
lib_cat_cha='" . $this->categorie . "'
WHERE id_cat_cha='$id_cat'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

    public function delcategorie($id_cat)
    {

        $result = mysql_query("DELETE FROM categorie_chambre WHERE id_cat_cha='$id_cat'") or die(mysql_error());
        echo "<script>document.location='liste_categorie.php?module=MH'</script>";
    }
}

class Niveau
{

    public $niveau;
    public $id_hotel;

// Définition du constructeur
    function __construct($niveau, $id_hotel)
    {
        $this->niveau = $niveau;
        $this->id_hotel = $id_hotel;
    }

// Définition de la fonction ajouter niveau
    public function ajouterniveau()
    {
        $req_sql = 'INSERT INTO niveau_chambre VALUES (NULL,"' . $this->niveau . '",' . $this->id_hotel . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

// Définition de la fonction consulter niveau
    public function consulterniveau($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Libelle</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT n.id_niv_cha,n.lib_niv_cha FROM  niveau_chambre n WHERE n.hotel_id='$id_hotel' ORDER BY n.lib_niv_cha ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo '<tr>
<td>' . $compt . '</td>
<td>' . $rows['lib_niv_cha'] . '</td>
<td class="center"><a onClick="document.location=\'modif_niv.php?module=MH&id_niv=' . $rows['id_niv_cha'] . '\'"><img src="../img/edit.png"> Modifier</a></td>
<td class="center"><a onClick="document.location=\'liste_niveau.php?module=MH&id_niv=' . $rows['id_niv_cha'] . '\'"><img src="../img/drop.png">Supprimer</a></td>

</tr>';
        }
        echo '</tbody>
              </table> </div>';
    }

    // Définition de la fonction maj niveau
    public function majniveau($id_niv)
    {

        //_requete
        $req_sql = mysql_query("UPDATE niveau_chambre SET
lib_niv_cha='" . $this->niveau . "'
WHERE id_niv_cha='$id_niv'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

    public function delniveau($id_niv)
    {

        $result = mysql_query("DELETE FROM niveau_chambre WHERE id_niv_cha='$id_niv'") or die(mysql_error());
        echo "<script>document.location='liste_niveau.php?module=MH'</script>";
    }
}

#############################################################################################################################################

class Utilisateur
{

// Définition du constructeur
    function __construct($nom_user, $prenom_user, $sexe_user, $telephone_user, $email_user, $mdp_user, $id_hotel, $id_droit)
    {
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
    public function ajouter_utilisateur()
    {

//_requete
        $req_sql = 'INSERT INTO  t_utilisateur VALUES (NULL,"' . $this->nom_user . '","' . $this->prenom_user . '","' . $this->sexe_user . '","' . $this->telephone_user . '","' . $this->email_user . '","' . $this->mdp_user . '",' . $this->id_hotel . ',' . $this->id_droit . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");
    }

// Définition de la fonction consulter hotel
    public function lister_utilisateur()
    {

        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>N°</th>
            <th>Noms</th>
            <th>Site</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>';

//requette_
        $compt = 0;
        $hotel_id = $_SESSION['id_hotel'];
        $result = mysql_query("SELECT u.id_user, u.nom_user, u.prenom_user, u.sexe_user, u.telephone_user, u.email_user, u.mdp_user, h.nom_hotel FROM t_utilisateur u,t_hotel h WHERE u.id_hotel=h.id_hotel AND u.psedo=0 AND u.id_hotel =" . $hotel_id . " ORDER BY u.nom_user ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo '   <tr>
            <td>' . $compt . '</td>
            <td>' . $rows['nom_user'] . '</td>
            <td>' . $rows['nom_hotel'] . '</td>
            <td class="center"><a title="Voir detail" onClick="document.location=\'detail_utilisateur.php?id_user=' . $rows['id_user'] . '\'">Detail</a></td>
            <td class="center">'
            ?><?php if (in_array('CSU', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?><?php echo '<a title="Supprimer" onClick="document.location=\'gl_del_utilisateur.php?id_user=' . $rows['id_user'] . '\'"><img src="../img/drop.png"> Supprimer</a>' ?><?php } ?><?php

            echo '</td>
        </tr>';
        }

        echo '     </tbody>
        </table> </div>';
    }

}

?>
