<?php
// Initialisation de la session
session_start();
require '../../bdd/connexion.php';
if(isset($_POST['btn_save_client_encharge'])){
 /* Recuperation des variables du formulaires*/
 
	$nom_client=$_POST['nom_client'];
	$date_naiss_client=$_POST['date_naiss_client'];	
	$sexe_client=$_POST['sexe_client'];
	$etat_civil_client=$_POST['etat_civil_client'];
	$nationalite_client=$_POST['nationalite_client'];
	$provenance_client=$_POST['provenance_client'];
	$num_piece_identite_client=$_POST['num_piece_identite_client'];
	$num_passeport_client=$_POST['num_passeport_client'];
	$adresse_provenance_client=$_POST['adresse_provenance_client'];
	$email_client=$_POST['email_client'];
	$telephone_client=$_POST['telephone_client'];
	$num_pers_contacter_client=$_POST['num_pers_contacter_client'];
	$id_client=$_POST['id_client'];
	$id_reservation=$_POST['id_reservation'];
	$type='client';
	
	
	/* Conversion date d'arrive */
	  $transpostion=explode('/',$date_naiss_client);
	  $jrar=$transpostion[0];
	  $moisar=$transpostion[1];
	  $annee1ar=$transpostion[2];
	  $transpostion1=explode(' ',$annee1ar);
	  $anneear=$transpostion1[0];
	  $heurear=$transpostion1[1].':00';
	  $date_naiss_client1=$anneear.'-'.$moisar.'-'.$jrar;
	  /* Fin Conversion date d'arrive */
	  
	  /* Selection du responsable du client reservateur */
	  
		$respo_client_reservateur = $bdd->prepare("SELECT id_respo FROM t_client WHERE id_client=:id_client");
						$respo_client_reservateur->BindParam(':id_client', $id_client);
						$respo_client_reservateur->execute();
						
						while ($donnees = $respo_client_reservateur->fetch())
						{						
							$id_respo = $donnees['id_respo'];
						} 
							
	  /* Fin de la  Selection du responsable du client reservateur */
	
	
 /* Inssertion dans la table t_client */

    $requete = $bdd->prepare("INSERT INTO t_client (nom_client,date_naiss_client,sexe_client,
	                                                etat_civil_client,nationalite_client,provenance_client,
													num_piece_identite_client,num_passeport_client,adresse_provenance_client,
													email_client,telephone_client,num_pers_contacter_client,type,id_respo,id_hotel)
			                    VALUES(:nom_client,:date_naiss_client,:sexe_client,:etat_civil_client,
								       :nationalite_client,:provenance_client,:num_piece_identite_client,
									   :num_passeport_client,:adresse_provenance_client,
									   :email_client,:telephone_client,
									   :num_pers_contacter_client,:type,:id_respo,:id_hotel)");
	
    $requete->BindParam(':nom_client', $nom_client);
    $requete->BindParam(':date_naiss_client', $date_naiss_client1);
    $requete->BindParam(':sexe_client',$sexe_client);
    $requete->BindParam(':etat_civil_client', $etat_civil_client);
    $requete->BindParam(':nationalite_client', $nationalite_client);
    $requete->BindParam(':provenance_client', $provenance_client);
    $requete->BindParam(':num_piece_identite_client', $num_piece_identite_client);
    $requete->BindParam(':num_passeport_client', $num_passeport_client);
	$requete->BindParam(':adresse_provenance_client',$adresse_provenance_client);
    $requete->BindParam(':email_client', $email_client);
    $requete->BindParam(':telephone_client',$telephone_client);
	$requete->BindParam(':num_pers_contacter_client',$num_pers_contacter_client);
        $requete->BindParam(':type',$type);
    $requete->BindParam(':id_respo',$id_respo);
	$requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
    $requete->execute();
	 $id_client= $bdd->lastInsertId();
	
	 /* Insertion dans la table t_client_reserve */

    $requete = $bdd->prepare("INSERT INTO t_client_reserve (id_client,id_res,responsable)
			                    VALUES(:id_client,:id_res,:responsable)");
	$responsable=0;
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':id_res',$id_reservation);
	$requete->BindParam(':responsable',$responsable);
    $requete->execute();
	/* Fin insertion dans la table t_client_reserve */
	echo 'Insertion client réussie!';
    /* Fin dans la table t_client */

}

?>
