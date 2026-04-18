<?php
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_libelle_depot.php';
$json = array();
if (isset($_POST['libelle_depot'])) {
    $designation = trim($_POST['libelle_depot'],' ');
    $designation_ex = $_POST['libelle_depot_ex'];
    $id_depot= $_POST['id_depot'];
    if (empty($designation)) {
        $json['message_vide']='vide';
 } 
 else { 
       $verif_des = verif_libelle_depot($designation_ex,$designation);
         if ( $verif_des == 0) {
    // mise dans la table stk_produit
        $requete = $bdd->prepare("UPDATE t_depot SET libelle=:designation WHERE id_depot=:id_depot ");
        $requete->BindParam(':designation',$designation);
        $requete->BindParam(':id_depot',$id_depot);
         $requete->execute();
        $json['message_succes']= "succes"; 
  }
     else {
        
        $json['message_erreur'] = 'erreur';
        $json['des_value'] = $designation;
    }    
  } 
        
  }
  echo json_encode($json);