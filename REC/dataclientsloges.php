<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';

    $requete = $bdd->prepare
    ("
        SELECT g.entreprise,c.id,c.idfact,a.id_res,a.num_reserv,c.monnaie,c.idchambre,d.num_ch,c.tarif_ch,c.id_client,e.nom_client,c.nom_accomp,c.date_occ,c.date_lib
        FROM t_reservation AS a,t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_facture f,t_responsable g
        WHERE a.id_res=c.idreserv AND c.id_client=e.id_client AND c.idfact=f.id_fact AND e.id_respo=g.id_respo
              AND c.idchambre=d.id_ch AND c.statut='occupe' AND a.id_hotel=:id_hotel
       ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();


$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i = 1;
foreach ($result as $r) {
    $id = $r->id;
    $id_client = $r->id_client;
    $idreserv = $r->id_res;
    $idfact = $r->idfact;
    $idchambre = $r->idchambre;
    $tarif = montant_equivalent_bdd($r->monnaie,$m_affiche, $tauxdollar, $r->tarif_ch);
    $dte = date('H:i:s');
    $temps_actuel = $dte;
    $date_lib=$r->date_lib;
    $date_occ=$r->date_occ;
    if ($temps_actuel>= $temps_sortie) {
        $dte_now = date('Y-m-d', time() + 86400);
    } else {
        $dte_now = date('Y-m-d');
    }
    $nbrj = NbJours($date_occ,$dte_now);
    ?>
    <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo dateAffiche($date_occ) ?></td>
        <td class="hidden"><?php echo $r->entreprise?></td>
        <td><?php echo ucfirst($r->nom_client) ?></td>
        <td><?php echo ucfirst($r->nom_accomp) ?></td>
        <td><?php echo $r->num_ch ;
            if (in_array('CC', $_SESSION['actions']['code_actions'])) { ?>
                <a href="#" class="btn btn-info btn-xs change_ch"
                   id='<?php echo $id; ?>' id1='<?php echo $id_client; ?>' id2='<?php echo $idchambre; ?>'
                   id='<?php echo $idchambre; ?>'
                   id3='<?php echo $idreserv; ?>'
                   id4='<?php echo $date_lib; ?>'><i class="fa fa-bed"></i> Changer
                </a>
            <?php } ?></td>
        <td><?php echo afficheMontant($m_affiche,$tarif) ?></td>
        <td><?php echo $nbrj ?></td>
        <td>
            <a class="btn btn-info btn-xs "
               href="classeur.php?idres_ch=<?php echo $id; ?>">
                <i class="fa fa-list"></i> Détails</a>
        </td>
    </tr>
    <?php
    $i++;
}
?>