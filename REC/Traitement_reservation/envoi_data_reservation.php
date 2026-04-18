<?php
// Initialisation de la session
session_start();
$json = array();
// Inclusion du fichier contenant la connexion à la base
require '../../bdd/connexion.php';

// récuperation des infos de reseervation n°1
if (empty($_POST['nom_client']) || empty($_POST['date_res']) || empty($_POST['date_arrive']) || empty($_POST['date_sortie'])
) {
    //echo'Veuillez remplir tous les champs!';
    $json['message_vide'] = 'vide';

} else {
    //Recuperation des valeurs postees
    $hebergement = $_POST['hebergement'];
    $partenaire = $_POST['partenaire'];
    $id_client = $_POST['id_client'];
    $nom_client = $_POST['nom_client'];
    $date_arrive = $_POST['date_arrive'];
    $date_sortie = $_POST['date_sortie'];
    $date_res = $_POST['date_res'];
    $date_res_comp = explode(' ', $date_res);
    $date_res_comp1 = $date_res_comp[0];
    $date_r1 = explode('/', $date_res_comp1);
    $date_r = $date_r1[2] . '-' . $date_r1[1] . '-' . $date_r1[0];
    $_SESSION['date_r'] = $date_r;
    $date_sortie_comp = explode(' ', $date_sortie);
    $date_sortie_comp1 = $date_sortie_comp[0];
    $date_s1 = explode('/', $date_sortie_comp1);
    $date_s = $date_s1[2] . '-' . $date_s1[1] . '-' . $date_s1[0];
    $_SESSION['date_s'] = $date_s;
    $date_arrive_comp = explode(' ', $date_arrive);
    $date_arrive_comp1 = $date_arrive_comp[0];
    $date_a1 = explode('/', $date_arrive_comp1);
    $date_a = $date_a1[2] . '-' . $date_a1[1] . '-' . $date_a1[0];
    $_SESSION['date_a'] = $date_a;


    function NbJours($date_a, $date_s)
    {

        $tDeb = explode("-", $date_a);
        $tFin = explode("-", $date_s);

        $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);

        return (($diff / 86400) + 1);

    }

    $Nombres_jours = NbJours($date_a, $date_s);
    $nb_jrs = $Nombres_jours;
    $nb_jr = $nb_jrs - 1;
    if ($nb_jr == 0) {
        $nb_jr++;
    }

    $nbre_jr = $nb_jr;
    $date_j=date('Y-m-d');
if ($hebergement==1) {
    $IF=$date_a <= $date_s;
    $msg='sorti';
}else{
    $IF=$date_a <= $date_s&&$date_a <=$date_j;
    $msg='sorti2';

}

    if (($date_a >= $date_r) && ($date_s >= $date_r)) {
        if ($IF) {
            $_SESSION['date_res'] = $date_res;
            $_SESSION['partenaire'] = $partenaire;
            //type client en session
            if ($partenaire==1) {
                $_SESSION['type_cl']='client occasionnel';
            } else {
                $_SESSION['type_cl']='client partenaire';
            }
            $_SESSION['id_client'] = $id_client;
            $_SESSION['nom_client'] = $nom_client;
            $_SESSION['date_arrive'] = $date_arrive;
            $_SESSION['date_sorti'] = $date_sortie;

            if ($nbre_jr != 0) {
                $_SESSION['nbre_jr'] = $nbre_jr;
            } else {
                $_SESSION['nbre_jr'] = $nb_jr;
            }
            //mise en session d'autres données
            $_SESSION['sexe_client'] = $_POST['sexe'];
            $_SESSION['date_naiss_client'] = $_POST['date_naiss_client'];
            $_SESSION['etat_civil_client'] = $_POST['etat'];
            $_SESSION['nationalite_client'] = $_POST['nationalite_client'];
            $_SESSION['provenance_client'] = $_POST['provenance_client'];
            $_SESSION['num_piece_identite_client'] = $_POST['num_piece_identite_client'];
            $_SESSION['num_passeport_client'] = $_POST['num_passeport_client'];
            $_SESSION['adresse_provenance_client'] = $_POST['adresse_provenance_client'];
            $_SESSION['telephone_client'] = $_POST['telephone_client'];
            $_SESSION['email_client'] = $_POST['email_client'];
            $_SESSION['num_pers_contacter_client'] = $_POST['num_pers_contacter_client'];
            if ($hebergement == 1) {
                $_SESSION['id_accomp'] = Null;
            } else if ($hebergement == 2) {
                if ($_POST['id_client2']!= 0) {
                $_SESSION['id_accomp'] = $_POST['id_client2'];
                 $_SESSION['nom_accomp'] = $_POST['nom_client2'];
                }elseif ($_POST['id_client2'] == 0){
                    $_SESSION['id_accomp'] = Null;
                    $_SESSION['nom_accomp'] ='';
                }
            }
            //c'est OK
            //$test=1;
            $json['message_succes'] = 'succes';
        } else {
            // echo "La date de sortie doit etre superieure à la date  d'arrivée. ";
            $json['message_dte_sorti'] =$msg;
        }

    } else {
        //echo "La date d'arrivée ou de sortie doit etre superieure à la date de reservation. ";
        $json['message_dte_arrive'] = 'arrive';
    }
}


echo json_encode($json);
?>
