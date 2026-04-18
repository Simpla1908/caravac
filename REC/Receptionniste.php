<?php
include '../bdd/connexion_mysql.php';

// Définition de la classe Chambre
class Client
{
    public $nom_client;
    public $date_naiss_client;
    public $sexe_client;
    public $etat_civil_client;
    public $nationalite_client;
    public $provenance_client;
    public $num_piece_identite_client;
    public $num_passeport_client;
    public $adresse_provenance_client;
    public $email_client;
    public $telephone_client;
    public $num_pers_contacter_client;
    public $id_respot;
    public $id_hotel;

// Définition du constructeur
    function __construct($nom_client, $date_naiss_client, $sexe_client, $etat_civil_client, $nationalite_client, $provenance_client, $num_piece_identite_client, $num_passeport_client, $adresse_provenance_client, $email_client, $telephone_client, $num_pers_contacter_client, $id_respo, $id_hotel)
    {

        $this->nom_client = $nom_client;
        $this->date_naiss_client = $date_naiss_client;
        $this->sexe_client = $sexe_client;
        $this->etat_civil_client = $etat_civil_client;
        $this->nationalite_client = $nationalite_client;
        $this->provenance_client = $provenance_client;
        $this->num_piece_identite_client = $num_piece_identite_client;
        $this->num_passeport_client = $num_passeport_client;
        $this->adresse_provenance_client = $adresse_provenance_client;
        $this->email_client = $email_client;
        $this->telephone_client = $telephone_client;
        $this->num_pers_contacter_client = $num_pers_contacter_client;
        $this->id_respo = $id_respo;
        $this->id_hotel = $id_hotel;

    }

// Définition de la fonction ajouter chambre
    public function ajouterclient()
    {
//_requete
        $req_sql = 'INSERT INTO t_client VALUES (NULL,"' . $this->nom_client . '","' . $this->date_naiss_client . '","' . $this->sexe_client . '","' . $this->etat_civil_client . '","' . $this->nationalite_client . '","' . $this->provenance_client . '",' . $this->num_piece_identite_client . ',' . $this->num_passeport_client . ',"' . $this->adresse_provenance_client . '","' . $this->email_client . '","' . $this->telephone_client . '","' . $this->num_pers_contacter_client . '",' . $this->id_respo . ',' . $this->id_hotel . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");

    }

// Définition de la fonction consulter chambre
    public function consulterclient($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Clients</th>
                                            <th>Responsable</th>
                                            <th>Sexe</th>
                                            <th>Etat civil</th>
											<th>Adresse</th>
											<th>Tél</th>
											<th>Email</th>
                                            <th></th>
											<th></th>
										
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT * FROM  t_client c, t_responsable r WHERE c.id_hotel='$id_hotel' AND c.id_respo=r.id_respo AND c.type='client'  ORDER BY c.id_client DESC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo '                                        <tr>
                                            <td>' . $compt . '</a></td>
                                            <td>' . $rows['nom_client'] . '</a></td>
                                            <td>' . $rows['entreprise'] . '</td>
                                            <td >' . $rows['sexe_client'] . '</td>
											<td>' . $rows['etat_civil_client'] . '</td>
                                            <td>' . $rows['adresse_provenance_client'] . '</td>
                                            <td>' . $rows['telephone_client'] . '</td>
                                            <td>' . $rows['email_client'] . '</td>
                                            <td>' ?><?php if (in_array('MINFCLI', $_SESSION['actions']['code_actions'])) { ?><?php echo '<a onClick="document.location=\'rec_maj_client.php?id_client=' . $rows['id_client'] . '\'"><img src="../img/edit.png" title="Modifier"></a>' ?><?php } ?><?php echo '</td>
                                            <td>' ?><?php if (in_array('SCLI', $_SESSION['actions']['code_actions'])) { ?><?php echo '<a onClick="document.location=\'rec_del_client.php?id_client=' . $rows['id_client'] . '\'"><img src="../img/drop.png" title="Supprimer"></a>' ?><?php } ?><?php echo '</td>
                                             
                                        </tr>';
        }


        echo '                                  </tbody>
                                </table> </div>
								
							
								
								';


    }


}


#########################################################################################################################

// Définition de la classe responsable
class Responsable
{

    public $nom_respo;
    public $telephone_respo;
    public $adresse_respo;


// Définition du constructeur
    function __construct($nom_respo, $telephone_respo, $adresse_respo, $idhotel)
    {

        $this->nom_respo = $nom_respo;
        $this->telephone_respo = $telephone_respo;
        $this->adresse_respo = $adresse_respo;
        $this->idhotel = $idhotel;

    }

// Définition de la fonction ajouterresponsable
    public function ajouterresponsable()
    {
//_requete
        $req_sql = 'INSERT INTO t_responsable VALUES (NULL,"' . $this->nom_respo . '","' . $this->telephone_respo . '","' . $this->adresse_respo . '",' . $this->idhotel . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");

    }

// Définition de la fonction consulter hotel
    public function consulterresponsable($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nom</th>
                                            <th>Télépone</th>
                                            <th>Adresse</th>
                                       
                                            <th>Action</th>
                                             <th>Selection</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $result = mysql_query("SELECT * FROM  t_responsable r ORDER BY r.id_hotel='$id_hotel' ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $compt++;
            echo '                                        <tr>
                                            <td><a href="#">' . $compt . '</a></td>
                                            <td><a href="#">' . $rows['nom_respo'] . '</a></td>
                                            <td>' . $rows['telephone_respo'] . '</td>
                                            <td class="center">' . $rows['adresse_respo'] . '</td>
                                           
                                             <td class="center"><a onClick="document.location=\'gl_maj_chambre.php?id_ch=' . $rows['id_respo'] . '\'"><img src="../img/edit.png">&nbsp;&nbsp;Modifier</a>&nbsp;&nbsp;<a onClick="document.location=\'gl_del_chambre.php?id_ch=' . $rows['id_respo'] . '\'"><img src="../img/drop.png">&nbsp;&nbsp;Supprimer</a></td>
                                             <td class="center"><input name="multi[]" type="checkbox" value="' . $rows['id_hotel'] . '"></td>
                                        </tr>';
        }


        echo '                                  </tbody>
                                </table> </div>';


    }
}

#########################################################################################################################

// Définition de la classe reservation
class Reservation
{


    public $date_res;
    public $date_occ;
    public $date_lib;
    public $statut_res;
    public $id_ch;
    public $id_client;


// Définition du constructeur
    function __construct($date_res, $date_occ, $date_lib, $statut_res, $id_ch, $id_client)
    {


        $this->date_res = $date_res;
        $this->date_occ = $date_occ;
        $this->date_lib = $date_lib;
        $this->statut_res = $statut_res;
        $this->id_ch = $id_ch;
        $this->id_client = $id_client;

    }

// Définition de la fonction reserver
    public function reserver()
    {
//__requete_insertion_reservation
        $req_sql = 'INSERT INTO  t_reservation VALUES (NULL,"' . $this->date_res . '","' . $this->date_occ . '","' . $this->date_lib . '","' . $this->statut_res . '",' . $this->id_ch . ',' . $this->id_client . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");

//__requete_maj_reserve_libre
        $req_sql = mysql_query("UPDATE t_chambre SET 
reserve='oui',
libre='non'
WHERE id_ch='$this->id_ch'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");


//__requete_nbrjrs_reservation
        $id_hotel = $_SESSION['id_hotel'];
        $result = mysql_query("SELECT r.id_res,DATEDIFF(r.date_lib,r.date_occ) AS jrs,c.tarif_ch,c.num_ch,r.date_occ,r.date_lib,z.nom_client FROM t_reservation r,t_chambre c,t_client z WHERE r.id_client='$this->id_client' AND r.id_ch='$this->id_ch' AND r.id_ch=c.id_ch AND r.id_client=z.id_client AND c.id_hotel='$id_hotel'") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {
            $id_res = $rows['id_res'];
            $njrs = $rows['jrs'];
            $tarif = $rows['tarif_ch'];
            $num_ch = $rows['num_ch'];
            $date_occ = $rows['date_occ'];
            $date_lib = $rows['date_lib'];
            $nom_client = $rows['nom_client'];
        }

        echo "<script>document.location='rec_facture_reservation.php?id_client=" . $this->id_client . "&id_ch=" . $this->id_ch . "&njrs=" . $njrs . "&tarif=" . $tarif . "&id_res=" . $id_res . "&num_ch=" . $num_ch . "&date_occ=" . $date_occ . "&date_lib=" . $date_lib . "&nom_client=" . $nom_client . "'</script>";


    }

// Définition de la fonction situationreservation en generale
    public function situationreservation($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Noms du Client</th>
                                                            <th>Chambre Rés.</th>
                                                            <th>Date reserv</th>
                                                            <th>Date occup</th>
															<th>Date lib</th>
                                                            <th>Jrs restants</th>
                                                            <th>Statut</th>
                                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $tot = 0;
        $result = mysql_query("SELECT r.id_res,z.nom_client,c.num_ch,c.id_ch,r.date_res,r.date_occ,r.date_lib,DATEDIFF(r.date_occ,CURDATE()) as jrs,r.statut_res FROM t_reservation r,t_chambre c,t_client z WHERE r.id_client=z.id_client AND r.id_ch=c.id_ch AND c.id_hotel='$id_hotel' AND DATEDIFF(r.date_occ,CURDATE())>'0' ORDER BY r.date_res DESC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {

            $compt++;
            if ($rows['date_res'] == date('Y-m-d')) {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['jrs'] . '</td>
											<td class="center">' . $rows['statut_res'] . '</td>
										
											
                                           
                                           <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_res=' . $rows['id_res'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a>&nbsp;&nbsp;<a onClick="document.location=\'rec_ann_reservation_chambre.php?id_res=' . $rows['id_res'] . '&id_ch=' . $rows['id_ch'] . '\'"><img src="../img/drop.png">&nbsp;Annuler</a></td>
                                             <td class="center"><input name="multi[]" title="Selectionner" type="checkbox" value="' . $rows['id_res'] . '"></td>
                                        </tr>';
            } else {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['jrs'] . '</td>
											<td class="center">' . $rows['statut_res'] . '</td>
											 <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_res=' . $rows['id_res'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a>&nbsp;&nbsp;<a onClick="document.location=\'rec_ann_reservation_chambre.php?id_res=' . $rows['id_res'] . '&id_ch=' . $rows['id_ch'] . '\'"><img src="../img/drop.png">&nbsp;Annuler</a></td>
                                             <td class="center"><input name="multi[]" title="Selectionner" type="checkbox" value="' . $rows['id_res'] . '" disabled>
                                           
                                             </td>
                                        </tr>';


            }
        }


        echo '                                  </tbody>
                                </table> </div>
								 
								';


    }


// Définition de la fonction situationreservation en cours
    public function situationreservationencours($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Noms du Client</th>
                                                            <th>Chambre Rés.</th>
                                                            <th>Date reserv</th>
                                                            <th>Date occup</th>
															<th>Date lib</th>
                                                            <th>Jrs restants</th>
                                                            <th>Statut</th>
                                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $tot = 0;
        $result = mysql_query("SELECT r.id_res,z.nom_client,c.num_ch,c.id_ch,r.date_res,r.date_occ,r.date_lib,DATEDIFF(r.date_occ,CURDATE()) as jrs,r.statut_res FROM t_reservation r,t_chambre c,t_client z WHERE r.id_client=z.id_client AND r.id_ch=c.id_ch AND c.id_hotel='$id_hotel' AND r.date_res=CURDATE()ORDER BY r.date_res DESC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {

            $compt++;
            if ($rows['date_res'] == date('Y-m-d')) {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['jrs'] . '</td>
											<td class="center">' . $rows['statut_res'] . '</td>
                                            <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_res=' . $rows['id_res'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a>&nbsp;&nbsp;<a onClick="document.location=\'rec_ann_reservation_chambre.php?id_res=' . $rows['id_res'] . '&id_ch=' . $rows['id_ch'] . '\'"><img src="../img/drop.png">&nbsp;Annuler</a></td>
                                             <td class="center"><input name="multi[]" title="Selectionner" type="checkbox" value="' . $rows['id_res'] . '"></td>
                                        </tr>';
            } else {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['jrs'] . '</td>
											<td class="center">' . $rows['statut_res'] . '</td>
										
											 <td class="center"><div style="color:#434343"><img src="../img/edit.png">&nbsp;Modifier&nbsp;&nbsp;&nbsp;<img src="../img/drop.png">&nbsp;Annuler</div></td>
                                             <td class="center"><input name="multi[]" title="Selectionner" type="checkbox" value="' . $rows['id_res'] . '" disabled>
                                           
                                             </td>
                                        </tr>';


            }
        }


        echo '                                  </tbody>
                                </table> </div>
								 
								';


    }

// Définition de la fonction situationreservation periodique
    public function situationreservationperiodique($id_hotel, $date_d, $date_f)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Noms du Client</th>
                                                            <th>Chambre Rés.</th>
                                                            <th>Date reserv</th>
                                                            <th>Date occup</th>
															<th>Date lib</th>
                                                            <th>Jrs restants</th>
                                                            <th>Statut</th>
                                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $tot = 0;
        $result = mysql_query("SELECT r.id_res,z.nom_client,c.num_ch,c.id_ch,r.date_res,r.date_occ,r.date_lib,DATEDIFF(r.date_occ,CURDATE()) as jrs,r.statut_res FROM t_reservation r,t_chambre c,t_client z WHERE r.id_client=z.id_client AND r.id_ch=c.id_ch AND c.id_hotel='$id_hotel' AND r.date_res BETWEEN '$date_d' AND '$date_f' AND DATEDIFF(r.date_occ,CURDATE())>'0' ORDER BY r.date_res DESC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {

            $compt++;
            if ($rows['date_res'] == date('Y-m-d')) {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['jrs'] . '</td>
											<td class="center">' . $rows['statut_res'] . '</td>
                                           <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_res=' . $rows['id_res'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a>&nbsp;&nbsp;<a onClick="document.location=\'rec_ann_reservation_chambre.php?id_res=' . $rows['id_res'] . '&id_ch=' . $rows['id_ch'] . '\'"><img src="../img/drop.png">&nbsp;Annuler</a></td>
                                             <td class="center"><input name="multi[]" title="Selectionner" type="checkbox" value="' . $rows['id_res'] . '"></td>
                                        </tr>';
            } else {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['jrs'] . '</td>
											<td class="center">' . $rows['statut_res'] . '</td>
										
											 <td class="center"><div style="color:#434343"><img src="../img/edit.png">&nbsp;Modifier&nbsp;&nbsp;&nbsp;<img src="../img/drop.png">&nbsp;Annuler</div></td>
                                             <td class="center"><input name="multi[]"  title="Selectionner" type="checkbox" value="' . $rows['id_res'] . '" disabled>
                                           
                                             </td>
                                        </tr>';


            }
        }


        echo '                                  </tbody>
                                </table> </div>
								 
								';
    }


// Définition de la fonction situationreservation historique
    public function situationreservationhistorique($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Noms du Client</th>
                                                            <th>Chambre Rés.</th>
                                                            <th>Date reserv</th>
                                                            <th>Date occup</th>
															<th>Date lib</th>
                                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $tot = 0;
        $result = mysql_query("SELECT r.id_res,z.nom_client,c.num_ch,r.date_res,r.date_occ,r.date_lib,DATEDIFF(r.date_occ,CURDATE()) as jrs,r.statut_res FROM t_reservation r,t_chambre c,t_client z WHERE r.id_client=z.id_client AND r.id_ch=c.id_ch AND c.id_hotel='$id_hotel' ORDER BY r.date_res DESC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {

            $compt++;
            if ($rows['statut_res'] == 'Annule') {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center" style="color:red;">a été&nbsp;' . $rows['statut_res'] . '</td>
										</tr>';
            } else {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                            <td class="center">' . $rows['date_res'] . '</td>
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center"> a été&nbsp;' . $rows['statut_res'] . '</td>
                                        </tr>';


            }
        }


        echo '                                  </tbody>
                                </table> </div>
								 
								';


    }


// Définition de la fonction annuler_reservation_chambre 
    public function annuler_reservation_chambre($id_res, $id_ch)
    {
//_requete
        $req_sql = mysql_query("UPDATE t_reservation SET 
statut_res='Annule'
WHERE id_res='$id_res'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
//_requete
        $req_sql = mysql_query("UPDATE t_chambre SET 
reserve='non',
occupe='non',
libre='oui'
WHERE id_ch='$id_ch'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
        echo "<script>document.location='rec_reservation_chambre.php'</script>";
    }

// Définition de la fonction supprimer chambre
    public function delallchambre()
    {
//_requete
        $result = mysql_query("DELETE FROM t_reservatio") or die(mysql_error());
        echo "<script>document.location='rec_reservation_chambre.php'</script>";
    }

// Définition de la fonction maj chambre
    public function maj_reservation_chambre($id_res)
    {
//_requete
        $req_sql = mysql_query("UPDATE t_reservation SET 
symbolemon='" . $this->symbolemon . "',
date_res='" . $this->date_res . "',
date_occ='" . $this->date_occ . "',
pmt='" . $this->pmt . "',
montantpaye='" . $this->montantpaye . "',
conversion='" . $this->conversion . "',
id_ch='" . $this->id_ch . "',
id_client='" . $this->id_client . "'
WHERE id_res='$id_res'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
        echo "<script>document.location='rec_reservation_chambre.php'</script>";
    }

}


#########################################################################################################################

// Définition de la classe occupation
class Occupation
{


    public $id_client;
    public $id_ch;
    public $date_occ;
    public $heure_occ;


// Définition du constructeur
    function __construct($id_client, $id_ch, $date_occ, $heure_occ)
    {

        $this->id_client = $id_client;
        $this->id_ch = $id_ch;
        $this->date_occ = $date_occ;
        $this->heure_occ = $heure_occ;


    }

// Définition de la fonction ajouter chambre
    public function occuper()
    {
//_requete
        $req_sql = 'INSERT INTO t_occupation VALUES(NULL,"' . $this->date_occ . '","' . $this->heure_occ . '",' . $this->id_ch . ',' . $this->id_client . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");


//__requete_maj_reserve_libre
        $req_sql = mysql_query("UPDATE t_chambre SET 
reserve='non',
occupe='oui'
WHERE id_ch='$this->id_ch'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");

        "<script>document.location='rec_chambres_reserve.php'</script>";

    }


// Définition de la fonction situationoccupation
    public function situationoccupation($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Noms du Client</th>
                                                            <th>N° Chambre</th>
                                                            <th>Date occup</th>
															 <th>Heure occup</th>
                                                            
                                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $tot = 0;
        $result = mysql_query("SELECT z.nom_client,c.num_ch,o.id_occ,o.date_occ,o.heure_occ FROM  t_occupation o,t_chambre c,t_client z WHERE o.id_client=z.id_client AND o.id_ch=c.id_ch AND c.id_hotel='$id_hotel' ORDER BY o.id_occ ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {

            $compt++;
            if ($rows['date_occ'] == date('Y-m-d')) {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                           
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['heure_occ'] . '</td>

                                           <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_res=' . $rows['id_occ'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a></td>
                                            
                                        </tr>';
            } else {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                           
											<td class="center">' . $rows['date_occ'] . '</td>
											<td class="center">' . $rows['heure_occ'] . '</td>
				
                                           <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_res=' . $rows['id_occ'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a></td>
                                            
                                        </tr>';


            }
        }


        echo '                                  </tbody>
                                </table> </div>
								 
								';


    }

}


#########################################################################################################################

// Définition de la classe occupation
class Liberation
{

    public $ref;
    public $id_client;
    public $id_ch;
    public $date_lib;
    public $heure_lib;


// Définition du constructeur
    function __construct($id_client, $id_ch, $date_lib, $heure_lib)
    {

        $this->id_client = $id_client;
        $this->id_ch = $id_ch;
        $this->date_lib = $date_lib;
        $this->heure_lib = $heure_lib;


    }

// Définition de la fonction liberer
    public function liberer()
    {
//_requete
        $req_sql = 'INSERT INTO t_liberation VALUES(NULL,"' . $this->date_lib . '","' . $this->heure_lib . '",' . $this->id_ch . ',' . $this->id_client . ')';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");


//__requete_maj_reserve_libre
        $req_sql = mysql_query("UPDATE t_chambre SET 
occupe='non',
libre='oui'
WHERE id_ch='$this->id_ch'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");

        "<script>document.location='rec_chambres_occuper.php'</script>";
    }

// Définition de la fonction situationoccupation
    public function situationliberation($id_hotel)
    {
        echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Noms du Client</th>
                                                            <th>N° Chambre</th>
                                                            <th>Date lib</th>
															 <th>Heure lib</th>
                                                            
                                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

//requette_
        $compt = 0;
        $tot = 0;
        $result = mysql_query("SELECT z.nom_client,c.num_ch,l.id_lib,l.date_lib,l.heure_lib FROM  t_liberation l,t_chambre c,t_client z WHERE l.id_client=z.id_client AND l.id_ch=c.id_ch AND c.id_hotel='$id_hotel' ORDER BY l.id_lib ASC") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {

            $compt++;
            if ($rows['date_lib'] == date('Y-m-d')) {
                echo '             
                           <tr>
                                            <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                           
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['heure_lib'] . '</td>

                                           <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_lib=' . $rows['id_lib'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a></td>
                                            
                                        </tr>';
            } else {
                echo '             
                           <tr>
                                          <td>' . $compt . '</td>
                                            <td>' . $rows['nom_client'] . '</td>
                                            <td>' . $rows['num_ch'] . '</td>
                                           
											<td class="center">' . $rows['date_lib'] . '</td>
											<td class="center">' . $rows['heure_lib'] . '</td>

                                           <td class="center"><a onClick="document.location=\'rec_maj_reservation_chambre.php?id_lib=' . $rows['id_lib'] . '\'"><img src="../img/edit.png">&nbsp;Modifier</a></td>
                                            
                                          
                                        </tr>';


            }
        }


        echo '                                  </tbody>
                                </table> </div>
								 
								';


    }


}


#########################################################################################################################

// Définition de la classe occupation
class Commissionnaire
{

    public $nomcom;
    public $sxcom;
    public $contact;
    public $adr;

// Définition du constructeur
    function __construct($nomcom, $sxcom, $contact, $adr)
    {

        $this->nomcom = $nomcom;
        $this->sxcom = $sxcom;
        $this->contact = $contact;
        $this->adr = $adr;


    }

// Définition de la fonction liberer
    public function ajouter_commissionnaire()
    {
//_requete
        $req_sql = 'INSERT INTO t_commussionnaire VALUES(NULL,"' . $this->nomcom . '","' . $this->sxcom . '","' . $this->contact . '","' . $this->adr . '")';
        mysql_query($req_sql) or die("impossible d'executer la _requette.<br>\n Erreur MySQL'" . mysql_error() . "'");

    }
}

?>
<!--
<td class="center"><input name="multi[]" type="checkbox" value="'.$rows['id_client'].'"></td>
<div style="float:right; margin-right:0px; margin-top:-15px;">
                          	<a onClick="document.location=\'rec_maj_client.php?id_client='.$rows['id_client'].'\'"><img src="../img/suprim.png" title="Supprimer"></a>
                          </div>-->