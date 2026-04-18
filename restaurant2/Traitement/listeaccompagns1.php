<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
include('../../FUNCTION/restaurant.php');
$json = array();
$json['pop'] = 0;
if (isset($_GET['idprod'])) {
    $plat_id = $_GET['idprod'];
    $detailsprod = CheckDetailsProduit($plat_id, $bdd);
    $popup = $detailsprod->pop;
    if ($popup == 1) {
        $json['pop'] = 1;
    }
    if ($_SESSION['visible-popup'] == 0) {
        $json['pop'] = 0;
    }
}
echo json_encode($json);
