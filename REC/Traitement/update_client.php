<?php
include('../../bdd/connexion.php');
include('../../FUNCTION/hebergement.php');
session_start();
$json = array();
    $id_client = $_POST['id_client'];
    $nom_client = $_POST['nom_client'];
    $date_naiss_client = dateToformatBdd($_POST['date_naiss_client']);
    $sexe_client = $_POST['sexe_client'];
    $etat_civil_client = $_POST['etat_civil_client'];
    $nationalite_client = $_POST['nationalite_client'];
    $provenance_client = $_POST['provenance_client'];
    $num_piece_identite_client = $_POST['num_piece_identite_client'];
    $num_passeport_client = $_POST['num_passeport_client'];
    $adresse_provenance_client = $_POST['adresse_provenance_client'];
    $email_client = $_POST['email_client'];
    $telephone_client = $_POST['telephone_client'];
    $num_pers_contacter_client = $_POST['num_pers_contacter_client'];
    $id_respo = $_POST['id_respo'];
    
                   
    $requete = $bdd->prepare("UPDATE t_client SET nom_client=:nom_client,date_naiss_client=:date_naiss_client,
            sexe_client=:sexe_client,etat_civil_client=:etat_civil_client, 
            nationalite_client=:nationalite_client,num_piece_identite_client=:num_piece_identite_client, 
            num_passeport_client=:num_passeport_client,adresse_provenance_client=:adresse_provenance_client, 
            email_client=:email_client,telephone_client=:telephone_client,
            num_pers_contacter_client=:num_pers_contacter_client,id_respo=:id_respo WHERE id_client=:id_client");
    $requete->BindParam(':nom_client', $nom_client);
    $requete->BindParam(':date_naiss_client', $date_naiss_client );
    $requete->BindParam(':sexe_client', $sexe_client );
    $requete->BindParam(':etat_civil_client',$etat_civil_client);
    $requete->BindParam(':nationalite_client',$nationalite_client);
    $requete->BindParam(':num_piece_identite_client',$num_piece_identite_client);
    $requete->BindParam(':num_passeport_client',$num_passeport_client);
    $requete->BindParam(':adresse_provenance_client',$adresse_provenance_client);
    $requete->BindParam(':email_client',$email_client);
    $requete->BindParam(':telephone_client',$telephone_client);
    $requete->BindParam(':num_pers_contacter_client',$num_pers_contacter_client);
    $requete->BindParam(':id_respo',$id_respo);
    $requete->BindParam(':id_client', $id_client);
    $requete->execute();
    $json['message_succes']= "succes";
    //echo"L'enrégistrement s'est effectué avec succès!";     
                      
  echo json_encode($json);