<?php
if (!isset($_SESSION)) {
    session_start();
}
include('./bdd/connexion.php');
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../FUNCTION/hebergement.php';
$tab_prod['produit'] = array();
$tab_prod['produit']['id'] = array();
$tab_prod['produit']['id2'] = array();
$tab_prod['produit']['qte'] = array();
$tab_prod['produit']['pv'] = array();
$tab_prod['produit']['depot_id'] = array();
$tab_prod['produit']['depot_name'] = array();
$s_famille_id = 0;
$depot_id = 0;
$etat_depot=0;
$sousresto_id=0;
$taux_resto=1;
if (isset($_POST['valider'])) {
    $s_famille_id = $_POST['s_famille_id'];
    $famille_id=$s_famille_id;
    $date_rapport_f = $_POST['date_rapport'];
    $date_rapport = format_stringdateTodatetime("d/m/Y", $date_rapport_f, 'Y-m-d');
    $depot_id = $_POST['depot_id'];
    //Infos Depot   
    $requete = $bdd->prepare("SELECT * FROM t_sousresto AS a
        WHERE a.depot_id=:id_depot");
    $requete->BindParam(':id_depot',$depot_id);
    $requete->execute();
    $depot = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($depot as $dp) {
        $id_depot= $dp->depot_id;
        $libelle_depot= $dp->libelle;
        $etat_depot=$dp->etat;
        $sousresto_id=$dp->id_sousresto;
        $_SESSION['id_depot'] = $id_depot;
        $_SESSION['libelle_depot'] = $libelle_depot;
    } 
    }else{
       //Infos Depot
    $famille_id=0;
    $date_rapport = date('Y-m-d');
    $date_rapport_f = date('d/m/Y');
    $depot_id=GetDepotCentral_id($_SESSION['id_hotel'],$bdd);
    $requete = $bdd->prepare("SELECT * FROM t_sousresto AS a
        WHERE a.depot_id=:id_depot AND a.etat=0");
    $requete->BindParam(':id_depot',$depot_id);
    $requete->execute();
    $depot = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($depot as $dp) {
        $id_depot= $dp->depot_id;
        $libelle_depot= $dp->libelle;
        $etat_depot=$dp->etat;
        $sousresto_id=$dp->id_sousresto;
        $_SESSION['id_depot'] = $id_depot;
        $_SESSION['libelle_depot'] = $libelle_depot;
    }
    }
    ?> 
<?php
   //Liste des produits
        if($etat_depot==1){
            if($famille_id==0){
                //Liste de tous les produits par depot
                $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam,stk__mouvement AS m
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND prod.repas=0
                             AND fam.plat=0 AND m.produit_id=prod.idprod AND m.depot_id=:depot_id ORDER BY prod.designation ";
                $requete = $bdd->prepare($req3);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':depot_id', $depot_id);
                $requete->execute();
                $articles = $requete->fetchAll(PDO::FETCH_OBJ); 
            }else{
                //Liste de tous les produits par famille et depot
                $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam,stk__mouvement AS m
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND prod.repas=0
                             AND fam.plat=0 AND m.produit_id=prod.idprod AND m.depot_id=:depot_id AND fam.idfamille=:idfamille ORDER BY prod.designation ";
                $requete = $bdd->prepare($req3);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':depot_id', $depot_id);
                $requete->BindParam(':idfamille',$famille_id);
                $requete->execute();
                $articles = $requete->fetchAll(PDO::FETCH_OBJ);  
            }
        }else{
            //Pour le depot central, on affiche tous les produits
            if($famille_id==0){
                //Liste de tous les produits par depot
                $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND prod.repas=0
                             AND fam.plat=0 ORDER BY prod.designation ";
                $requete = $bdd->prepare($req3);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->execute();
                $articles = $requete->fetchAll(PDO::FETCH_OBJ); 
            }else{
                //Liste de tous les produits par famille et depot
                $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND prod.repas=0
                             AND fam.plat=0 AND fam.idfamille=:idfamille ORDER BY prod.designation ";
                $requete = $bdd->prepare($req3);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':idfamille',$famille_id);
                $requete->execute();
                $articles = $requete->fetchAll(PDO::FETCH_OBJ);  
            } 
        }
       if($depot_id==0){
            $req2 = "SELECT m.produit_id, (SUM(qte_entree)-SUM(qte_sortie+qte_declasse)) AS qte_dispo 
                FROM stk__mouvement AS m, stk_produit AS p
                WHERE m.produit_id=p.idprod
                AND m.dte_appro<=:date 
                AND m.hotel_id=:hotel_id 
                GROUP BY m.produit_id";
            $requete = $bdd->prepare($req2);
            $requete->BindParam(':date', $date_rapport);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
       }else{
            $req2 = "SELECT m.produit_id, (SUM(qte_entree)-SUM(qte_sortie+qte_declasse)) AS qte_dispo 
                FROM stk__mouvement AS m, stk_produit AS p
                WHERE m.produit_id=p.idprod
                AND m.dte_appro<=:date 
                AND m.hotel_id=:hotel_id 
                AND m.depot_id=:depot_id 
                GROUP BY m.produit_id";
            $requete = $bdd->prepare($req2);
            $requete->BindParam(':date', $date_rapport);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':depot_id',$depot_id);
            $requete->execute();
       }
    

    $articles2 = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($articles2 as $art2) {
    array_push($tab_prod['produit']['id'], $art2->produit_id);
    $tab_prod['produit']['qte'][$art2->produit_id] = $art2->qte_dispo;
    }
    
   //Liste des prix de vente produits
    /*  $req2 = "SELECT a.*,b.taux
            FROM t_prix_produit AS a,t_sousresto AS b
            WHERE a.sousresto_id=b.id_sousresto AND  a.sousresto_id=:sousresto_id";
    $requete = $bdd->prepare($req2);
    $requete->BindParam(':sousresto_id',$sousresto_id);
    $requete->execute();
    $res3 = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($res3 as $art2){
      $taux_resto=$art2->taux;
      array_push($tab_prod['produit']['id2'], $art2->produit_id);
      $tab_prod['produit']['pv'][$art2->produit_id] =$art2->prix_vente ;
    } */
    $_SESSION['articles']=$articles;
    $_SESSION['produit_id2']=$tab_prod['produit']['id2'];
    $_SESSION['produit_id']=$tab_prod['produit']['id'];
    $_SESSION['produit_qte']=$tab_prod['produit']['qte'];
    $_SESSION['produit_pv']=$tab_prod['produit']['pv'];
?>                
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php  echo '<b>Depot:</b>' . $_SESSION['libelle_depot'];?>
            <span class="pull-right" style="margin-top: -5px;">
                <a href="impression/fiche_inventaire.php?date_rapport=<?php echo $date_rapport; ?>&s_famille_id=<?php echo $s_famille_id; ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Imprimer</a>
            </span>
            <br>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example2">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Désignation</th>
                            <th>QTE</th>
                            <!-- <th>Unité</th> -->
                            <th>PAU</th>
                            <th>PVU</th>
                            <th>Valeur Achat</th>
                             <th>Valeur Vente</th>
                            <th>Marge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $valstock = 0;
                        $valmarge = 0;
                        $totmarge=0;
                        $ca = 0;
                       
                        foreach ($articles as $art) {
                            $pv1 =$art->pv;
                            $tx=$tauxdollar;
                           /*  if (in_array($art->idprod, $tab_prod['produit']['id2'])){
                                $pv1=$tab_prod['produit']['pv'][$art->idprod];
                                $tx=$taux_resto;
                            } */
                            $pv = montant_equivalent_bdd($art->monnaie, $m_insert, $tauxdollar,$pv1);
                            $pa = montant_equivalent_bdd($art->monnaie, $m_insert, $tauxdollar, $art->pa);

                            if (in_array($art->idprod, $tab_prod['produit']['id'])) {
                                $solde = $tab_prod['produit']['qte'][$art->idprod];
                            } else {
                                $solde = 0;
                            }
                            $solde = round( $solde,2);
                            $valstock1 = $pa * $solde;
                            if(round($pv)==0){
                               $valmarge1 =0;
                               $valmarge2=0;  
                            }else{
                               $valmarge1 = ($pv  * $solde);
                               $valmarge2=$valmarge1-$valstock1; 
                            }
                            ?>
                            <tr class="odd gradeX">     
                                <td><?php echo $i ?></td>
                                <td><?php echo $art->produit ?></td>
                                <td>
                                    <?php echo $solde ?>
                                </td>
                                <!-- <td><?php // echo $art->unite ?></td> -->
                                <td><?php echo afficheMontant2($m_insert, $pa) ?></td>
                                <td> <?php echo afficheMontant2($m_insert, $pv) ?> </td>
                               
                                <td>
                                    <?php 
                                    echo afficheMontant2($m_insert, $valstock1)
                                    ?>
                                </td>
                                 <td>
                                    <?php 
                                    echo afficheMontant2($m_insert, $valmarge1)
                                    ?>
                                </td>
                                 <td>
                                     <?php 
                                        echo afficheMontant2($m_insert,$valmarge2 ); 
                                     ?>
                                 </td>
                            </tr>
                            <?php
                            $valmarge+=$valmarge1;
                            $valstock+=$valstock1;
                            $totmarge+=$valmarge2;
                            $i++;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                         <th colspan="5">Total</th>
                        <th><?php echo afficheMontant2($m_insert, $valstock) ?></th>
                         <th><?php echo afficheMontant2($m_insert,$valmarge) ?></th>
                        <th><?php echo afficheMontant2($m_insert, $totmarge) ?></th>
                    </tfoot>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>


