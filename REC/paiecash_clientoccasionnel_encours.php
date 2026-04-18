<?php
// Initialisation de la session
//if (!isset($_SESSION)) {
//    session_start();
//}
//include('../bdd/connexion .php');
//if (($_SESSION['libe_droit'] == 'Gerant Local') || ($_SESSION['libe_droit'] == 'Receptionniste')) {
//    $id_hotel = $_SESSION['id_hotel'];
//} else {
//    $id_hotel = $_GET['id_hotel'];
//}
//if ($id_hotel == 0) {
//    // Situation Journalière caisse entree
//    $entree = 'entree';
//    $sortie = 'sortie';
//    $date_bon = date('Y-m-d');
//    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
//            . " FROM t_operation AS op  WHERE op.type=:type AND op.date_bon=:date_bon AND op.libelle='Heberge'");
//    $requete->BindParam(':type', $entree);
//    $requete->BindParam(':date_bon', $date_bon);
//    $requete->execute();
//    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
//
//    foreach ($operations as $op) {
//        $montantFC_entree_jr = $op->montantFC_entree_jr;
//        $montantUSD_entree_jr = $op->montantUSD_entree_jr;
//    }
//
////    Situation Journalière caisse sortie
//    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_jr ,SUM(montantUSD) AS montantUSD_sortie_jr"
//            . " FROM t_operation AS op  WHERE op.type=:type AND op.date_bon=:date_bon AND op.libelle='Heberge'");
//    $requete->BindParam(':type', $sortie);
//    $requete->BindParam(':date_bon', $date_bon);
//    $requete->execute();
//    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
//
//    foreach ($operations as $op) {
//        $montantFC_sortie_jr = $op->montantFC_sortie_jr;
//        $montantUSD_sortie_jr = $op->montantUSD_sortie_jr;
//    }
//} else {
//// Situation Journalière caisse entree
//    $entree = 'entree';
//    $sortie = 'sortie';
//    $date_bon = date('Y-m-d');
//    if (($_SESSION['libe_droit'] == 'Gerant Local') || ($_SESSION['libe_droit'] == 'Receptionniste')) {
//        $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
//                . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND op.date_bon=:date_bon AND op.libelle='Heberge'");
//        $requete->BindParam(':type', $entree);
//        $requete->BindParam(':hotel_id', $id_hotel);
//        $requete->BindParam(':date_bon', $date_bon);
//    } else {
//        $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_entree_jr ,SUM(montantUSD) AS montantUSD_entree_jr"
//                . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND op.date_bon=:date_bon AND op.libelle='Heberge'");
//        $requete->BindParam(':type', $entree);
//        $requete->BindParam(':hotel_id', $id_hotel);
//        $requete->BindParam(':date_bon', $date_bon);
//    }
//    $requete->execute();
//    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
//
//    foreach ($operations as $op) {
//        $montantFC_entree_jr = $op->montantFC_entree_jr;
//        $montantUSD_entree_jr = $op->montantUSD_entree_jr;
//    }
//
////    Situation Journalière caisse sortie
//    $requete = $bdd->prepare("SELECT SUM(montantFC) AS montantFC_sortie_jr ,SUM(montantUSD) AS montantUSD_sortie_jr"
//            . " FROM t_operation AS op  WHERE op.type=:type AND op.hotel_id=:hotel_id AND op.date_bon=:date_bon AND op.libelle='Heberge'");
//    $requete->BindParam(':type', $sortie);
//    $requete->BindParam(':hotel_id', $id_hotel);
//    $requete->BindParam(':date_bon', $date_bon);
//    $requete->execute();
//    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
//
//    foreach ($operations as $op) {
//        $montantFC_sortie_jr = $op->montantFC_sortie_jr;
//        $montantUSD_sortie_jr = $op->montantUSD_sortie_jr;
//    }
//}
//$caisse_montantUSD_entree = $montantUSD_entree_jr;
//$caisse_montantFC_entree = $montantFC_entree_jr;
//$caisse_montantUSD_sortie = $montantUSD_sortie_jr;
//$caisse_montantFC_sortie = $montantFC_sortie_jr;
//$caisse_montantUSD_solde=$caisse_montantUSD_entree - $caisse_montantUSD_sortie;
//$caisse_montantFC_solde=$caisse_montantFC_entree - $caisse_montantFC_sortie;
?>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
        <thead>
            <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
            </tr>
        </thead>
        <tbody>
            <tr class="gradeX">
                <td>Misc</td>
                <td>Links</td>
                <td>Text only</td>
                <td class="center">-</td>
                <td class="center">X</td>
            </tr>
            <tr class="gradeX">
                <td>Misc</td>
                <td>Lynx</td>
                <td>Text only</td>
                <td class="center">-</td>
                <td class="center">X</td>
            </tr>
            <tr class="gradeC">
                <td>Misc</td>
                <td>IE Mobile</td>
                <td>Windows Mobile 6</td>
                <td class="center">-</td>
                <td class="center">C</td>
            </tr>
            <tr class="gradeC">
                <td>Misc</td>
                <td>PSP browser</td>
                <td>PSP</td>
                <td class="center">-</td>
                <td class="center">C</td>
            </tr>
            <tr class="gradeU">
                <td>Other browsers</td>
                <td>All others</td>
                <td>-</td>
                <td class="center">-</td>
                <td class="center">U</td>
            </tr>
        </tbody>
    </table>
</div>
<!-- /.table-responsive -->