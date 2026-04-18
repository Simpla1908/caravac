<?php
session_start();
include("../../bdd/connexion.php");
// $json = array();
$id_client=$_POST['id_client'];
$id_ch=$_POST['id_ch'];
$id_res=$_POST['idreserv'];
//suppression dans t_reserve_chambre
$requete = $bdd->prepare("DELETE FROM t_reserve_chambre WHERE id_client=:id_client AND idreserv=:id_res AND idchambre=:idchambre AND statut='occupe' AND occupe='occupe'");
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':id_res', $id_res);
    $requete->BindParam(':idchambre', $id_ch);
    $requete->execute();
     $responsable =0;
     $requete = $bdd->prepare("UPDATE t_client_reserve  SET responsable =:responsable
	                             WHERE id_client=:id_client AND id_res=:id_res ");
   
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':id_res', $id_res);
    $requete->BindParam(':responsable', $responsable);
    $requete->execute();
     /* Mise à jour capacite chambre */
    $requete = $bdd->prepare("SELECT capacite,num_ch FROM  t_chambre AS c WHERE c.id_ch=:idchambre");
    $requete->BindParam(':idchambre', $id_ch);
    $requete->execute();
    $capacite_value = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($capacite_value as $ca) {
        $capacite = $ca->capacite;
        $num_ch= $ca->num_ch;
    }
$capacite=$capacite+1;
$requete = $bdd->prepare("UPDATE t_chambre  SET capacite =:capacite WHERE id_ch=:idchambre");
$requete->BindParam(':capacite', $capacite);   
$requete->BindParam(':idchambre', $id_ch);
$requete->execute();
    /* Mise à jour du colbo chambre */
// $clients = $bdd->prepare("SELECT a.id_client,a.nom_client FROM t_client AS a, t_client_reserve AS b
//												  WHERE a.id_client=b.id_client AND b.id_res=:id_res AND b.responsable IN(0,1)");
//
//    $clients->BindParam(':id_res', $id_res);
//    $clients->execute();
//
//    while ($donnees = $clients->fetch()) {
//
//        $json[$donnees['id_client']][] = $donnees['nom_client'];
//    }
//    
//echo json_encode($json);

	
?>	
