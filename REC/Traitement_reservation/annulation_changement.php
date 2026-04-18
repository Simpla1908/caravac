<?php
session_start();
include('../Amelioration/bdd/connexion .php');
$json = array();
$json['message'] = "";
if (empty($_POST['occup_annul'])) {
    $json['message'] = 'vide';
}
else {
    $N = count($_POST["occup_annul"]);
    for ($i = 0; $i < $N; $i++) {
        $idhistoch = $_POST["occup_annul"][$i];
        $requete = $bdd->prepare("DELETE FROM  t_chambre_histo WHERE id=:id");
        $requete->BindParam(':id', $idhistoch);
        $requete->execute();
    }
    $json['message'] = 'succes';
}
echo json_encode($json);
