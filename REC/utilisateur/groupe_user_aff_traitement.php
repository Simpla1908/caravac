<?php

session_start();
include('../Amelioration/bdd/connexion .php');
if (empty($_POST['groupe'])) {
//on ne fait rien
} else {
    $id_user = $_POST['id_user'];
    $aff_id = $_SESSION['id_user'];
    $dte = date('Y-m-d', time() + 3600);
//suppression groupes user
    $requete = $bdd->prepare("DELETE FROM users_groupes WHERE user_id=:user_id");
    $requete->BindParam(':user_id', $id_user);
    $requete->execute();
//fin suppression groupes user
    $N = count($_POST["groupe"]);
    for ($i = 0; $i < $N; $i++) {
        $group_id = $_POST["groupe"][$i];
        $requete = $bdd->prepare("INSERT INTO users_groupes(user_id,group_id,affecteur_id,dte)
			         VALUES(:user_id,:group_id,:affecteur_id,:dte)");

        $requete->BindParam(':user_id', $id_user);
        $requete->BindParam(':group_id', $group_id);
        $requete->BindParam(':affecteur_id', $aff_id);
        $requete->BindParam(':dte', $dte);
        $requete->execute();
    }
}
