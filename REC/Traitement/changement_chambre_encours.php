<?php
// Initialisation de la session
session_start();
require '../../bdd/connexion.php';
require '../../FUNCTION/hebergement.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
if (isset($_GET['id_chx_new']) && isset($_GET['id_reserv_chx']) && isset($_GET['id_client']) && isset($_GET['id_chx_ex']) && isset($_GET['id_reserv']) && isset($_GET['tarif']) && isset($_GET['monnaie'])) {
    $id_chx_new = $_GET['id_chx_new'];
    $id_reserv_chx = $_GET['id_reserv_chx'];
    $id_client = $_GET['id_client'];
    $id_chx_ex = $_GET['id_chx_ex'];
    $id_reserv = $_GET['id_reserv'];
    $monnaie = 'CDF';
    $tarif = $_GET['tarif'];
    $date_lib = date('Y-m-d');
    /* echo '$id_chx_new'.$id_chx_new;
     echo '$id_reserv_chx'.$id_reserv_chx;
     echo '$id_client'.$id_client;
     echo '$id_chx_ex'.$id_chx_ex;
     echo '$id_reserv'.$id_reserv;
     echo '$monnaie'.$monnaie;
     echo '$tarif'.$tarif;
     echo '$date_lib'.$date_lib;*/
    //insertion dans t_chambre_histo
    $requete = $bdd->prepare("INSERT INTO t_chambre_histo(idres_ch,idchambre,statut,date_occ,date_lib,tarif_ch,monnaie)
    SELECT :idres_ch,:idchambre,'occupe',:date_occ,date_lib,:tarif_ch,:monnaie
    FROM t_reserve_chambre
    WHERE id=:id_reserv_chx");
    $requete->BindParam(':idres_ch', $id_reserv_chx);
    $requete->BindParam(':idchambre', $id_chx_new);
    $requete->BindParam(':date_occ', $date_lib);
    $requete->BindParam(':tarif_ch', $tarif);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':id_reserv_chx', $id_reserv_chx);
    $requete->execute();
    //maj dans table t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut ='change',date_lib=:date_lib WHERE idchambre=:idchambre AND idres_ch=:idres_ch");
    $requete->BindParam(':date_lib', $date_lib);
    $requete->BindParam(':idchambre', $id_chx_ex);
    $requete->BindParam(':idres_ch', $id_reserv_chx);
    $requete->execute();

    //maj dans table t_reserve_chambre
    $requete = $bdd->prepare("UPDATE t_reserve_chambre SET idchambre =:idchambre,date_occ=:date_occ,monnaie=:monnaie,tarif_ch=:tarif_ch WHERE id=:id_reserv_chx");
    $requete->BindParam(':idchambre', $id_chx_new);
    $requete->BindParam(':date_occ', $date_lib);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':tarif_ch', $tarif);
    $requete->BindParam(':id_reserv_chx', $id_reserv_chx);
    $requete->execute();

}
?>
