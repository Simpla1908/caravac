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
    <table class="table table-striped table-bordered table-hover table-condensed dataTables-example" id="dataTables-example1">
        <thead>
            <tr>
                <th>N°</th>
                <th>Partenaires</th>
                <th>Montant payé</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <tr class="gradeX">
            <td>1</td>
            <td>Links</td>
            <td>Text only</td>
            <td>Text only</td>
            <td class="center"><a href="#" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a></td>
        </tr>
        <tr class="gradeX">
            <td>2</td>
            <td>Lynx</td>
            <td>Text only</td>
            <td>Text only</td>
            <td class="center"><a href="#" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a></td>
        </tr>
        <tr class="gradeC">
            <td>3</td>
            <td>IE Mobile</td>
            <td>Windows Mobile 6</td>
            <td>Text only</td>
            <td class="center"><a href="#" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a></td>
        </tr>
        <tr class="gradeC">
            <td>4</td>
            <td>PSP browser</td>
            <td>PSP</td>
            <td>Text only</td>
            <td class="center"><a href="#" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a></td>
        </tr>
        <tr class="gradeU">
            <td>5</td>
            <td>Misc</td>
            <td>-</td>
            <td>Text only</td>
            <td class="center"><a href="#" title="Afficher le detail" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Détails </a></td>
        </tr>
        </tbody>
        <tfoot>
        <tr class="gradeU">
            <th colspan="2">Total</th>
            <th>2500</th>
            <th colspan="2"></th>
        </tr>
        </tfoot>
    </table>
</div>
<!-- /.table-responsive -->

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example1').dataTable();
       

    });

</script>