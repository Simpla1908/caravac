<?php
session_start();
include '../bdd/connexion.php';

$json = array();

$taux_op=$_GET['taux_op'];
/* Update reglage */
//echo $taux_op;
$requete = $bdd->prepare("UPDATE  t_sousresto  SET taux =:taux_op WHERE id_sousresto=:id_sousresto");
$requete->BindParam(':taux_op', $taux_op);
$requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
$requete->execute();
echo $taux_op;
//echo json_encode($json);


