<?php

/* Recuperation des variables du formulaires */
$id_responsable = $_SESSION['partenaire'];
$id_client = $_SESSION['id_client'];
$nom_client = $_SESSION['nom_client'];
if (empty($_SESSION['date_naiss_client'])) {
    $date_naiss_client = ' ';
} else {
    $date_naiss_client = $_SESSION['date_naiss_client'];
    /* Conversion date d'arrive */
    $transpostion = explode('/', $date_naiss_client);
    $jrar = $transpostion[0];
    $moisar = $transpostion[1];
    $anneear = $transpostion[2];
    $date_naiss_client = $anneear . '-' . $moisar . '-' . $jrar;
    /* Fin Conversion date d'arrive */
}

$sexe_client = $_SESSION['sexe_client'];
$etat_civil_client = $_SESSION['etat_civil_client'];
$nationalite_client = $_SESSION['nationalite_client'];
$provenance_client = $_SESSION['provenance_client'];
$num_piece_identite_client = $_SESSION['num_piece_identite_client'];
$num_passeport_client = $_SESSION['num_passeport_client'];
$adresse_provenance_client = $_SESSION['adresse_provenance_client'];
$email_client = $_SESSION['email_client'];
$telephone_client = $_SESSION['telephone_client'];
$num_pers_contacter_client = $_SESSION['num_pers_contacter_client'];
$type = 'client';
if ($id_responsable == 1) {
    $type_cl = 'client occasionnel';
} else {
    $type_cl = 'client partenaire';
}
if ($id_client != 0) {
    /* Maj dans la table t_client */
    $requete = $bdd->prepare("UPDATE t_client  SET nom_client=:nom_client,date_naiss_client=:date_naiss_client,sexe_client=:sexe_client,etat_civil_client=:etat_civil_client,
								       nationalite_client=:nationalite_client,provenance_client=:provenance_client,num_piece_identite_client=:num_piece_identite_client,
									   num_passeport_client=:num_passeport_client,adresse_provenance_client=:adresse_provenance_client,
									   email_client=:email_client,telephone_client=:telephone_client,
									   num_pers_contacter_client=:num_pers_contacter_client
	                             WHERE id_client=:id_client");
    /* Fin maj dans la table t_client */
    $requete->BindParam(':id_client', $id_client);
} else if ($id_client == 0) {
    /* Insertion dans la table t_client */
    $requete = $bdd->prepare("INSERT INTO t_client (nom_client,date_naiss_client,sexe_client,
	                                                etat_civil_client,nationalite_client,provenance_client,
													num_piece_identite_client,num_passeport_client,adresse_provenance_client,
													email_client,telephone_client,num_pers_contacter_client,type,type_cl,id_respo,id_hotel)
			                    VALUES(:nom_client,:date_naiss_client,:sexe_client,:etat_civil_client,
								       :nationalite_client,:provenance_client,:num_piece_identite_client,
									   :num_passeport_client,:adresse_provenance_client,
									   :email_client,:telephone_client,
									   :num_pers_contacter_client,:type,:type_cl,:id_respo,:id_hotel)");
    /* Fin dans la table t_client */
    $requete->BindParam(':type', $type);
    $requete->BindParam(':type_cl', $type_cl);
    $requete->BindParam(':id_respo', $id_responsable);
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
}
$requete->BindParam(':nom_client', $nom_client);
$requete->BindParam(':date_naiss_client', $date_naiss_client);
$requete->BindParam(':sexe_client', $sexe_client);
$requete->BindParam(':etat_civil_client', $etat_civil_client);
$requete->BindParam(':nationalite_client', $nationalite_client);
$requete->BindParam(':provenance_client', $provenance_client);
$requete->BindParam(':num_piece_identite_client', $num_piece_identite_client);
$requete->BindParam(':num_passeport_client', $num_passeport_client);
$requete->BindParam(':adresse_provenance_client', $adresse_provenance_client);
$requete->BindParam(':email_client', $email_client);
$requete->BindParam(':telephone_client', $telephone_client);
$requete->BindParam(':num_pers_contacter_client', $num_pers_contacter_client);
$requete->execute();

if ($id_client == 0) {
    $id_client = $bdd->lastInsertId();
    $_SESSION['id_client'] = $id_client;
} 