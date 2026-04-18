<?php

session_start();
include '../../bdd/connexion.php';
$json = array();
if (!empty($_POST['chambre_id']) && !empty($_POST['reclamation'])) {
    
    
    $chambre_id=$_POST['chambre_id'];
    $reclamation=$_POST['reclamation'];
    
    $date_r = date('Y-m-d H:i:s', time() + 7200);
    $statut='non résolue';
    /* Insertion dans t_facture */

    $requete = $bdd->prepare("INSERT INTO  t_suggestion (textsug,datesug,statut,chambre_id,hotel_id,id_util)
 VALUES(:textsug,:datesug,:statut,:chambre_id,:hotel_id,:id_util)");
   
    $requete->BindParam(':textsug', $reclamation);
    $requete->BindParam(':datesug', $date_r);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':chambre_id', $chambre_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':id_util', $_SESSION['id_user']);
    $requete->execute();
    /* Fin d'Insertion dans t_facture */
                
    $json['message'] = 'succes';
}  else {
    $json['message'] = 'echec';
}

echo json_encode($json);


