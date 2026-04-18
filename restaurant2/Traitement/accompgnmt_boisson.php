<?php 
if (!isset($_SESSION)) {
    session_start();
}
$idprod=$_GET['id_produit'];
$idtab=$_GET['idtab'];
$accboissonvalues=$_GET['accboissonvalues'];
$site_id=$_SESSION['id_hotel'];
if (!in_array($idprod, $_SESSION['accboisson']['idprod'])) {
 array_push($_SESSION['accboisson']['idprod'], $idprod);
 $_SESSION['accboisson']['lib'][$idprod]=$accboissonvalues;
 }

