<?php
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_des_fam_1.php';
$json = array();
if (isset($_POST['designation'])) {
  $designation = trim($_POST['designation'], ' ');
  $designation_ex = $_POST['designation_ex'];
  $idfamille = $_POST['idfamille'];
  $familletype_id = $_POST['familletype_id'];
  if (empty($designation)) {
    $json['message_vide'] = 'vide';
  } else {
    $verif_des = verif_des_fam_1($designation_ex, $designation);
    if ($verif_des == 0) {
      // mise dans la table stk_produit
      $requete = $bdd->prepare("UPDATE stk_famille SET designation=:designation,familletype_id=:familletype_id WHERE idfamille=:famille_id ");
      $requete->BindParam(':designation', $designation);
      $requete->BindParam(':familletype_id', $familletype_id);
      $requete->BindParam(':famille_id', $idfamille);
      $requete->execute();
      $json['message_succes'] = "succes";
    } else {

      $json['message_erreur'] = 'erreur';
      $json['des_value'] = $designation;
    }
  }
}
echo json_encode($json);
