<?php
session_start();
include("../../bdd/connexion.php");
if ($_POST['id_client2'] == 0) {
    $id_accomp = NULL;
    $nom_accomp = '';
} else {
    $id_accomp = $_POST['id_client2'];
    $nom_accomp = $_POST['nom_client2'];
}
$idchambre = $_POST['id_chambre'];
if ($_POST['prs'] == 0) {
    $id_client = $_POST['id_client'];
} else if($_POST['prs'] == 1){
    $id_client = $_POST['id_client1'];
}
$idreserv = $_POST['id_res'];
$idresch = $_POST['idresch'];
$statut = 'occupe';
/*echo 'pers'.$_POST['prs'];
 echo '$id_client'.$id_client;
echo '$idreserv'.$idreserv;
echo '$id_accomp'.$id_accomp;
echo '$nom_accomp'.$nom_accomp;*/

/* Fin Changement de statut de reservation */
//insertion dans t_chambre_histo
$requete = $bdd->prepare("INSERT INTO t_chambre_histo (idres_ch,idchambre,statut,date_occ,date_lib,tarif_ch,monnaie)
    SELECT id,idchambre,'occupe',date_occ,date_lib,tarif_ch,monnaie
    FROM t_reserve_chambre
    WHERE id=:id_reserv_chx");
$requete->BindParam(':id_reserv_chx', $idresch);
$requete->execute();
//maj dans table t_reserve_chambre
$requete = $bdd->prepare("UPDATE t_reserve_chambre SET id_client=:id_client,id_accomp=:id_accomp,statut=:statut,nom_accomp=:nom_accomp
	                             WHERE idreserv=:idreserv AND idchambre=:idchambre");
$requete->BindParam(':id_client', $id_client);
$requete->BindParam(':id_accomp', $id_accomp);
$requete->BindParam(':statut', $statut);
$requete->BindParam(':nom_accomp', $nom_accomp);
$requete->BindParam(':idreserv', $idreserv);
$requete->BindParam(':idchambre', $idchambre);
$requete->execute();
//maj dans table t_reservation
$requete = $bdd->prepare("SELECT COUNT(*) AS nbrech FROM t_reserve_chambre WHERE statut='reserve' AND idreserv=:id_res ");
$requete->BindParam(':id_res',$idreserv);
$requete->execute();
$result = $requete->fetch(PDO::FETCH_OBJ);
if($result->nbrech==0){
    $etat='execute';
    $requete = $bdd->prepare("UPDATE  t_reservation SET etat=:etat WHERE id_res=:id_res");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_res', $idreserv);
    $requete->execute();
}
?>
