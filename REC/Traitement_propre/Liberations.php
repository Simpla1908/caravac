<?php
include_once('Connexion.php');
class Liberations extends Connexion
{

public function liberer ($date_lib,$id_res,$id_client,$id_hotel)
{	
	//Retire l'heure à partir de datetime
	$date_lib=explode(' ',$date_lib);
	$heure_lib=$date_lib[1];
	$bdd=parent::seconnecter();
	 $requete = $bdd->prepare("INSERT INTO t_liberation (date_lib,heure_lib,id_res,id_client,id_hotel)
			                    VALUES(:date_lib,:heure_lib,:id_res,:id_client,:id_hotel)");
								
	 $requete->BindParam(':date_lib',$date_lib);
	 $requete->BindParam(':heure_lib',$heure_lib);
     $requete->BindParam(':id_res',$id_res);
	 $requete->BindParam(':id_client',$id_client);
	 $requete->BindParam(':id_hotel',$id_hotel);
	 $requete->execute();
	 echo"la libération s'est effectuée avec succès!";
}

}
?>

