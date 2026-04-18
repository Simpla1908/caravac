<?php
$tab_prod['produit'] = array();
$tab_prod['produit']['id2'] = array();
$tab_prod['produit']['pv'] = array();

//Prix de vente
$req2 = "SELECT a.*
            FROM t_prix_produit AS a
            WHERE  a.sousresto_id=:sousresto_id";
$requete1 = $bdd->prepare($req2);
$requete1->BindParam(':sousresto_id',$_SESSION['id_sousresto']);
$requete1->execute();
$res3 = $requete1->fetchAll(PDO::FETCH_OBJ);
foreach ($res3 as $art2){
  array_push($tab_prod['produit']['id2'],$art2->produit_id);
  $tab_prod['produit']['pv'][$art2->produit_id] =$art2->prix_vente ;
}
?>
<br>
<div class="table-responsive">
    <table id="table" class="table table-bordered table-condensed  tblplat">
        <thead>
            <tr>
                <th>N°</th>
                <th>Code</th>
                <th>Designation</th>
                <th>Prix de vente</th>
                <!--<th>Unité</th>-->
                <th>Sous-Famille</th>
                <th>Famille</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($produits as $p):
                $pv1=$tab_prod['produit']['pv'][$p->idprod];
                $pv=montant_equivalent_bdd($p->monnaie, $m_affiche, $_SESSION['tauxdollar'],$pv1);
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $p->code ?></td>
                    <td><?php echo ucfirst($p->produit) ?></td>
                    <td><?php echo afficheMontant2($m_affiche, $pv) ?></td>
                    <td><?php echo ucfirst($p->des) ?></td>
                    <td><?php echo ucfirst($p->designation) ?></td>
                    <td>
                        <a href="main.php?p=plat&d=update&ss=<?php echo $_SESSION['id_sousresto'] ?>&id=<?php echo $p->idprod ?>" ><span class="label label-primary"><i class="fa fa-edit fa-fw"></i></span></a>
                         <a href="#" id="<?php echo $p->idprod ?>" p="plat" d="delplat" 
                           maj="majplat" 
                           view="#view_plat" 
                           tbl=".tblplat"
                           ss="<?php echo $_SESSION['id_sousresto'] ?>" 
                           class="del_art" data-toggle="modal" data-target="#myModalSupp">
                            <span class="label label-danger "><i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                    </td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
</div>


