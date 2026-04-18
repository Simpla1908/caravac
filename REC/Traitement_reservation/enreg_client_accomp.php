<?php
// Initialisation de la session
session_start();
$json = array();
// Inclusion du fichier contenant la connexion à la base
require '../../bdd/connexion.php';

			// récuperation des infos de reseervation n°1
			if(empty($_POST['nom_client_acc'])){
						//echo'Veuillez remplir tous les champs!';
						 $json['message_vide']='vide';
				
			}else{
			/* Recuperation des variables du formulaires */
			$id_responsable =$_POST['id_responsable_acc'];
			$id_client=$_POST['id_client_acc'];
			$nom_client = $_POST['nom_client_acc'];
			$date_naiss_client =$_POST['date_naiss_client_acc'];
			$sexe_client =$_POST['sexe'];
			$etat_civil_client =$_POST['etat'];
			$nationalite_client = $_POST['nationalite_client_acc'];
			$provenance_client = $_POST['provenance_client_acc'];
			$num_piece_identite_client = $_POST['num_piece_identite_client_acc'];
			$num_passeport_client = $_POST['num_passeport_client_acc'];
			$adresse_provenance_client = $_POST['adresse_provenance_client_acc'];
			$email_client = $_POST['email_client_acc'];
			$telephone_client = $_POST['telephone_client_acc'];
			$num_pers_contacter_client =$_POST['num_pers_contacter_client_acc'];
			$type='client';
			if ($id_responsable==1) {
			$type_cl='client occasionnel';
			} else {
			$type_cl='client partenaire';
			}
			if ($id_client!=0) {
			/* Maj dans la table t_client */
			$requete = $bdd->prepare("UPDATE t_client  SET nom_client=:nom_client,date_naiss_client=:date_naiss_client,sexe_client=:sexe_client,etat_civil_client=:etat_civil_client,
			       nationalite_client=:nationalite_client,provenance_client=:provenance_client,num_piece_identite_client=:num_piece_identite_client,
				   num_passeport_client=:num_passeport_client,adresse_provenance_client=:adresse_provenance_client,
				   email_client=:email_client,telephone_client=:telephone_client,
				   num_pers_contacter_client=:num_pers_contacter_client
			 WHERE id_client=:id_client");
			/* Fin maj dans la table t_client */
			$requete->BindParam(':id_client', $id_client);
			} else if ($id_client==0) {
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

			if ($id_client==0) {
			$id_client = $bdd->lastInsertId();
			} 

			$json['message_succes']='succes';
			$json['id_client']=$id_client;
			$json['nom_client']=$nom_client;
			}
			echo json_encode($json);
?>
