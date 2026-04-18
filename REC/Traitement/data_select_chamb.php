<?php
session_start();
include("../../bdd/connexion.php");
require '../../FUNCTION/hebergement.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
$hrs_sys = date('H:i:s');
if(isset($_GET['date_lib'])){
    $date_lib=$_GET['date_lib'];
}else{
    $date_lib='0000-00-00';
}
$requete_chambre = $bdd->prepare("SELECT ch.id_ch,ch.tarif_ch,ch.num_ch,ch.monnaie, niv.lib_niv_cha, cat.lib_cat_cha                                               
                                FROM t_chambre AS ch
                                INNER JOIN categorie_chambre AS cat
                                ON ch.categorie=cat.id_cat_cha 
                                INNER JOIN niveau_chambre AS niv
                                ON ch.niveau=niv.id_niv_cha
                                WHERE ch.id_hotel=:id_hotel");

$requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_chambre->execute();
$chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
$indisponibles=getchambreIndisponibles($_SESSION['id_hotel'],date('Y-m-d'),$date_lib,$checkin,$temps_sortie,$hrs_sys,$bdd);
?>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed" id="dataTables-example1">
        <thead>
        <tr>
            <th>N°</th>
            <th>Chambre</th>
            <th>Tarif</th>
            <th>Categorie</th>
            <th>Niveau</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 1;
        foreach ($chambres as $ch){
            $idch=$ch->id_ch;
            if (!in_array($idch, $indisponibles['chambres']['id'])) {
            $tarif_ch=$ch->tarif_ch;
            $monnaie_ch=$ch->monnaie;
            $tarif_ch=montant_equivalent_bdd($monnaie_ch,getsymbole_local(),$tauxdollar,$ch->tarif_ch);
            ?>
            <tr class="odd gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $ch->num_ch ?></td>
                <td><?php
                    echo afficheMontant($m_affiche,montant_equivalent_bdd($monnaie_ch,$m_affiche, $tauxdollar, $ch->tarif_ch));
                    ?></td>
                <td><?php echo $ch->lib_cat_cha ?></td>
                <td><?php echo $ch->lib_niv_cha ?></td>
                <td>
                    <a href="#" class="btn btn-danger btn-xs selection_ch" id1='<?php echo $ch->id_ch ?>' datatarif="<?php echo $tarif_ch ?>" datamonnaie="USD"><i
                            class="fa fa-check"></i> </a>
                    <span class="btn btn-danger btn-xs hidden pull-right" id="loader2">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                            </span>
                </td>

            </tr>
        <?php $i++; } }; ?>
        </tbody>
    </table>
</div>

