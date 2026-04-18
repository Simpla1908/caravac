<?php
// Initialisation de la session
session_start();
require '../../bdd/connexion.php';
if(isset($_POST['save_user'])){
	
 /* Recuperation des variables du formulaires*/
 
	$nom_user=$_POST['nom_user'];
	$prenom_user=$_POST['prenom_user'];	
	$sexe_user=$_POST['sexe_user'];
	$telephone_user=$_POST['telephone_user'];
	$email_user=$_POST['email_user'];
	$mdp_user=$_POST['mdp_user'];
	$mdp_user2=$_POST['mdp_user2'];
	$id_droit=$_POST['id_droit'];
	$id_hotel=$_POST['id_hotel'];
	
	 /* Inssertion dans la table t_client */

	if($mdp_user!=$mdp_user2){
		
		echo'Verifiez que les mots de passse soient identiques.';
	}else{
    $requete = $bdd->prepare("INSERT INTO t_utilisateur (nom_user,prenom_user,sexe_user,
	                                                telephone_user,email_user,mdp_user,
													id_droit,id_hotel)
			                    VALUES(:nom_user,:prenom_user,:sexe_user,:telephone_user,:email_user,
								       :mdp_user,:id_droit,
									   :id_hotel)");

    $requete->BindParam(':nom_user', $nom_user);
    $requete->BindParam(':prenom_user', $prenom_user);
    $requete->BindParam(':sexe_user',$sexe_user);
    $requete->BindParam(':telephone_user', $telephone_user);
    $requete->BindParam(':email_user', $email_user);
    $requete->BindParam(':mdp_user', $mdp_user);
    $requete->BindParam(':id_droit', $id_droit);
	$requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
    $requete->execute();
	echo 'Insertion utilisateur réussie!';
    /* Fin dans la table t_client */

}
}else{
		
 /* Recuperation des variables du formulaires*/
 
	$nom_user=$_POST['nom_user'];
	$prenom_user=$_POST['prenom_user'];	
	$sexe_user=$_POST['sexe_user'];
	$telephone_user=$_POST['telephone_user'];
	$email_user=$_POST['email_user'];
	$mdp_user=$_POST['mdp_user'];
	$mdp_user2=$_POST['mdp_user2'];
	$id_droit=$_POST['id_droit'];
	$id_hotel=$_POST['id_hotel'];
	$modification=$_POST['modification'];
	$id_user=$_POST['id_user'];
	
	if($modification=='OK'){
		
		if($mdp_user!=$mdp_user2){
		
		echo'Verifiez que les mots de passse soient identiques.';
	}else{
		
      $requete = $bdd->prepare("UPDATE t_utilisateur  SET nom_user =:nom_user,
	                                                    prenom_user =:prenom_user,
														sexe_user =:sexe_user,
														telephone_user =:telephone_user, 
														email_user =:email_user, 
														mdp_user =:mdp_user,
														id_droit =:id_droit,
														id_hotel =:id_hotel
														WHERE id_user=:id_user");
	$requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':nom_user', $nom_user);
    $requete->BindParam(':prenom_user', $prenom_user);
    $requete->BindParam(':sexe_user',$sexe_user);
    $requete->BindParam(':telephone_user', $telephone_user);
    $requete->BindParam(':email_user', $email_user);
    $requete->BindParam(':mdp_user', $mdp_user);
    $requete->BindParam(':id_droit', $id_droit);
	$requete->BindParam(':id_hotel',$id_hotel);
    $requete->execute();
	
	echo 'Modification utilisateur réussie!';
	
    /* Fin Modification dans la table t_utlisateur */

}
		
		
		
	}
	
}
?>
