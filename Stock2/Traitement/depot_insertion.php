<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_lib_depot.php';
$json = array();
if (isset($_POST['libelle_depot'])) {
// Insertion dans la table t_motif
    $libelle = $_POST['libelle_depot'];
    $libelle = trim($libelle, ' ');
    
    $json=array();
    if (empty($libelle)) {
      
        $json['message_vide']="vide";
    } 
    else {
        $verif_des = verif_des_fam($libelle);
         if ( $verif_des == 0) {
        $requete = $bdd->prepare("INSERT INTO t_depot (libelle,hotel_id)
			                 VALUES(:libelle,:hotel_id)");
       //session à enlever
       $requete->BindParam(':libelle', $libelle);
       $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
       $requete->execute();
       $id_depot = $bdd->lastInsertId();
       
       //Création 
        $requete = $bdd->prepare("INSERT INTO  t_sousresto(libelle,depot_id,hotel_id)
                    VALUES(:libelle,:depot_id,:hotel_id)");
        $requete->BindParam(':libelle', $libelle);
        $requete->BindParam(':depot_id', $id_depot);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
       
//        echo"L'enrégistrement s'est effectué avec succès!";
       $json['message_succes']='succes';
    }
     else {
        
        $json['message_erreur'] = 'erreur';
        $json['des_value'] = $libelle;
    }    
  } 
  
} 
echo json_encode($json);