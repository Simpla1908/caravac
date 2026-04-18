<?php
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_GET['id_res1'])){
    require '../bdd/connexion.php';
    require '../FUNCTION/hebergement.php';
    include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; 
    $id_res=$_GET['id_res1'];
}
$requete = $bdd->prepare
    ("SELECT b.num_ch,c.id,c.idchambre,c.idreserv,c.statut,c.monnaie AS monnaie_ch ,c.tarif_ch AS tarif_ch_histo, d.tva AS taxe,d.type AS type_fact,d.taux AS taux_fact,d.monnaie AS monnaie_fact
    FROM t_reservation AS a, t_chambre AS b,t_reserve_chambre AS c ,t_facture AS d
    WHERE a.id_res=c.idreserv
    AND c.idchambre=b.id_ch
    AND d.id_fact=c.idfact
    AND b.id_hotel=:id_hotel
    AND a.id_res=:id_res");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result1 = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$today = date('Y-m-d');
$i = 1;
foreach ($result1 as $r1) {
    $id = $r1->id;
    $taux_fact = $r1->taux_fact;
    $monnaie_fact = $r1->monnaie_fact;
    $monnaie_ch = $r1->monnaie_ch;
    $type_fact = $r1->type_fact;
    $tauxdollar = getTauxFacture($type_fact, $monnaie_fact, $tauxdollar, $taux_op, $taux_fact);
    $num_ch = $r1->num_ch;
    $tarif_ch = montant_equivalent_bdd($monnaie_ch, $m_affiche, $tauxdollar, $r1->tarif_ch_histo);
    $statut_ch = $r1->statut;
    $tva = $r1->taxe;
    $idchambre = $r1->idchambre;
    $id_res = $r1->idreserv;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $num_ch ?></td>
        <td><?php echo afficheMontant($m_affiche, $tarif_ch) ?></td>
        <td class='hidden'><?php echo afficheMontant($m_affiche, $tarif_ch * $nbre_jr) ?></td>
        <td class='hidden'><?php echo $statut_ch ?></td>
        <td>
            <?php if ($today >= $_SESSION['date_arrive'] && $today <=$_SESSION['date_sortie']&& $statut_ch == 'reserve') { ?>
                <a id="btn_occup" data-chambre="<?php echo $idchambre; ?>"
                   data-client="<?php echo $_SESSION['id_client']; ?>" data-res="<?php echo $id_res; ?>" data-idresch="<?php echo $id; ?>"
                   data-toggle="modal" data-target=".myModal" href="#" title="Afficher le detail"
                   class="btn btn-info btn-xs"><i class="fa fa-sign-in"></i> Occuper
                </a>
            <?php } ?>
        </td>
    </tr>
    <?php
    $i++;
}
?>

