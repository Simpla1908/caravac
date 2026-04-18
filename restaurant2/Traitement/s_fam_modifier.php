<?php
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_des_sfam_1.php';
if (isset($_POST['designation'])) {
$json = array();
    $designation = trim($_POST['designation'],'');
    $designation_ex = $_POST['designation_ex'];
    $id_s_fam= $_POST['id_s_fam'];
    $idfamille= $_POST['famille_id'];
     if (empty($designation)||empty($id_s_fam)) {
        $json['message_vide']='vide';
 } 
 else {        
    // mise dans la table stk_produit
       $verif_des = verif_des_sfam_1($designation_ex,$designation);
         if ($verif_des == 0) {
        $requete = $bdd->prepare("UPDATE stk_sous_famille SET des=:des,famille=:famille_id WHERE id_s_fam=:id_s_fam");
        $requete->BindParam(':des',$designation);
        $requete->BindParam(':famille_id',$idfamille);
        $requete->BindParam(':id_s_fam',$id_s_fam);
         $requete->execute();
        $json['message_succes']= "succes"; 

      }    
      
     else {
        
        $json['message_erreur'] = 'erreur';
        $json['des_value'] = $designation;
    }    
  } 
  
 } 
 $json['id_sousresto'] = $_SESSION['id_sousresto'];
 echo json_encode($json);