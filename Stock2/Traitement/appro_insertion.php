<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
if (isset($_POST['designation'])) {
// Insertion dans la table t_motif
    $designation = $_POST['designation'];
    $designation = trim($designation, ' ');
    
    $json=array();
    if (empty($designation)) {
      
        $json['message_champ_vide']="vide";
    } else {
        
        $requete = $bdd->prepare("INSERT INTO stk_famille (designation,hotel_id)
			                 VALUES(:designation,:hotel_id)");
     
       $requete->BindParam(':designation', $designation);
       $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
       $requete->execute();
       
//        echo"L'enrégistrement s'est effectué avec succès!";
       $json['message_succes']='succes';
    }
        
    
} else {
    echo "Le champ désignation n'existe pas!";
}
echo json_encode($json);