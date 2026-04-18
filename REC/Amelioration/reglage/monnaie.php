<?php
$company_id= $_SESSION['company_id'];
$requete = $bdd->prepare("SELECT * FROM ` monnaie` WHERE company_id=$company_id");
$requete->execute();
$monnaies= $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($monnaies as $op) {
    $site_monnaie_id= $op->id_monnaie;
}
