<?php
//Numérotation facture
$requete = $bdd->prepare("SELECT COUNT(*) AS lignes FROM t_facture WHERE  type='souscription'");
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) {
    $lignes = $op->lignes;
}
if ($lignes == 0) {
    $i_souscription = 1;
} else {
    $requete = $bdd->prepare("SELECT i_souscription  FROM  t_facture WHERE type='souscription' ORDER BY id_fact DESC LIMIT 1");
    $requete->execute();
    $commandes = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($commandes as $c){
        $i_souscription= $c->i_souscription;
    }
}
// Fin Numérotation de la commande