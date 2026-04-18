<?php
// Initialisation de la session
session_start();

include '../bdd/connexion.php';

if (isset($_POST['search'])&& !empty($_POST['search'])) {
    $search= ($_POST['search']);

//    $array = array();
//
//    $query = $_POST['query'];
    // requête qui récupère les départements selon la région
    if (isset($_POST['partenaire'])&& !empty($_POST['partenaire'])) {
        $partenaire= ($_POST['partenaire']);
        
        $requete = 'SELECT id_client, nom_client FROM t_client WHERE id_hotel='.$_SESSION['id_hotel'].' AND id_respo='.$partenaire.' AND nom_client LIKE \'%' . $search . '%\' ORDER BY nom_client';
    }  else {
        $requete = 'SELECT id_client, nom_client FROM t_client WHERE id_hotel='.$_SESSION['id_hotel'].' AND nom_client LIKE \'%' . $search . '%\' ORDER BY nom_client';
    }
    // exécution de la requête
    $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

    // résultats
    while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo'<li><a class="lien" href="#">'.$donnees['nom_client'].'</a></li>';
        // je remplis un tableau et mettant l'id en index (que ce soit pour les régions ou les départements)
//        $json[$donnees['id_client']][] = utf8_encode($donnees['nom_client']);
        
//        $json[]= '{'.'"stateCode"'.':'. $donnees['id_client'].','. '"stateName"'.':'. $donnees['nom_client'].'}' ;
//        $array[]= array(
//            'id' => $donnees['id_client'],
//            'nom' => $donnees['nom_client'],
//         ) ;
    }

    // envoi du résultat au success
//    echo json_encode($array);
}