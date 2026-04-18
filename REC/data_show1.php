<?php
$json = array();
include '../bdd/connexion.php';
if (isset($_POST['lien'])&& !empty($_POST['lien'])) {
    $lien= ($_POST['lien']);

//    $array = array();
//
//    $query = $_POST['query'];
    // requête qui récupère les départements selon la région
    $requete = "SELECT * FROM t_client WHERE nom_client ='$lien'";
    // exécution de la requête
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

    // résultats
    while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $json['id_client'] = $donnees['id_respo'];
        $json['id_client'] = $donnees['id_client'];
        $json['date_naiss'] = $donnees['date_naiss_client'];
        $json['nationalite'] = $donnees['nationalite_client'];
        $json['provenance'] = $donnees['provenance_client'];
        $json['sexe'] = $donnees['sexe_client'];
        $json['etat_civil'] = $donnees['etat_civil_client'];
        $json['piece'] = $donnees['num_piece_identite_client'];
        $json['passeport'] = $donnees['num_passeport_client'];
        $json['adresse'] = $donnees['adresse_provenance_client'];
        $json['tel'] = $donnees['telephone_client'];
        $json['email'] = $donnees['email_client'];
        $json['autres'] = $donnees['num_pers_contacter_client'];
    }

    // envoi du résultat au success
    echo json_encode($json);
}