<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
if (isset($_POST['noms'])) {
// Insertion dans la table t_motif
    $noms = $_POST['noms'];
    $noms = trim($noms, ' ');
    $telephone= $_POST['telephone'];
    $email= $_POST['email'];
    $type= $_POST['type'];
    $json=array();
    if (empty($noms)) {
      
        $json['message_champ_vide']="vide";
    }  else {
        
        $requete = $bdd->prepare("INSERT INTO t_client (nom_client,email_client,telephone_client,type,id_hotel)
			                 VALUES(:noms,:email,:telephone,:type,:hotel_id)");

       $requete->BindParam(':noms', $noms);
       $requete->BindParam(':email', $email);
       $requete->BindParam(':telephone', $telephone);
       $requete->BindParam(':type',$type);
       $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
       $requete->execute();
       
//        echo"L'enrégistrement s'est effectué avec succès!";
       $json['message_succes']='succes';
    }
        
    
} else {
    echo "Le champ désignation n'existe pas!";
}
echo json_encode($json);