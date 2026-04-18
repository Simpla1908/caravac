<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_des_sfam.php';
$json = array();
if (isset($_POST['designation'])) {
// Insertion dans la table t_motif
    $designation = $_POST['designation'];
    $designation = trim($designation, ' ');
    $famille_id= $_POST['famille_id'];
    $json=array();
    if (empty($designation)||empty($famille_id)) {
      $json['message_vide']="vide";
    }  else {
       $verif_des = verif_des_sfam($designation);
         if ( $verif_des == 0) { 
        $requete = $bdd->prepare("INSERT INTO stk_sous_famille (des,hotel_id,famille)
			                 VALUES(:designation,:hotel_id,:famille)");

       $requete->BindParam(':designation', $designation);
       $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
       $requete->BindParam(':famille',$famille_id);
       $requete->execute();
       
//        echo"L'enrégistrement s'est effectué avec succès!";
       $json['message_succes']='succes';
    }
    else {
        
        $json['message_erreur'] = 'erreur';
        $json['des_value'] = $designation;
    }    
  }      
    
} 
echo json_encode($json);