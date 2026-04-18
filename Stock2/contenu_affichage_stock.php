<?php
session_start();
include('./bdd/connexion.php');


    $bdd->exec("call  calcul_qte_initial_produit()");
    $report_effectue_date = date('Y-m-d');
    $requete = $bdd->prepare("SELECT COUNT(*)AS nbre FROM stk_situation_report  WHERE report_effectue_date=:report_effectue_date");
    $requete->BindParam(':report_effectue_date', $report_effectue_date);
    $requete->execute();
    $situation_report = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($situation_report as $ap):
        $nbre = $ap->nbre;
    endforeach;
    
    $famille_id = $_POST['famille_id'];
    $date_rapport = $_POST['date_rapport'];
    $qte_initial_save[0]=0;
   
    
    if ($nbre == 0) {
        $bdd->exec("call  calcul_qte_initial_produit()");
    }
    
//    
//    $requete = $bdd->prepare("SELECT designation FROM stk_famille WHERE idfamille=:idfamille AND hotel_id=:hotel_id");
//    $requete->BindParam(':idfamille', $famille_id);
//    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//    $requete->execute();
//    $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);
    
    $transpostion_date = explode(' ', $date_rapport);
    $date_rapport1 = $transpostion_date[0];
    $heure_rapport1 = $transpostion_date[1];
    
    /* Conversion date  */
    $transpostion_sortie = explode('/', $date_rapport);
    $jrsor = $transpostion_sortie[0];
    $jrsor1 = $jrsor-01;
    $moisor = $transpostion_sortie[1];
    $annee1sor = $transpostion_sortie[2];
    $transpostion_sortie1 = explode(' ', $annee1sor);
    $anneesor = $transpostion_sortie1[0];
    $heuresor = $transpostion_sortie1[1];
    $date_heure_bon = $anneesor . '/' . $moisor . '/' . $jrsor . ' ' . $heuresor;
    $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
    
    $date_hier = $anneesor . '-' . $moisor . '-' . $jrsor1;
    
  
?>  
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-10">
                    <h4>
                    Liste des articles de la catégorie <span style="color:#1c94c4"><?php //  foreach ($mouvements as $ap): echo $ap->designation; endforeach;?></span> du <span style="color:#1c94c4"><?php //  echo $date_rapport1;?></span>
                    </h4>
                </div>
                <!-- /.col-lg-10 -->
                <div class="col-lg-2">
                    <!--<a href="impression/fiche_de_stock.php?famille_id=<?php //  echo $famille_id;?>&&date=<?php //  echo $date_bon;?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer</a>-->
                </div>
                <!-- /.col-lg-2 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Affichage Operation-->
            <?php
         //include('Traitement/fiche_stock_affichage.php');
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example2">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Sous Famille</th>
                            <th>Produit</th>
                            <th>Initial</th>
                            <th>Entrée</th>
                            <th>Sortie</th>
                            <th>Solde</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($articles as $art):
                            ?>
                            <tr class="odd gradeX"> 	
                                <td><?php echo $i ?></td>
                                <td><?php echo $art->des ?></td>
                                <td><?php echo $art->designation ?></td>
                                <td>
                                    <?php 
                                        if ($date_bon==  date('Y-m-d')) {
                                            echo $art->initial;
                                        }  else {
                                            $requete = $bdd->prepare("SELECT qte_initial_save
                                                                    FROM  stk_report  
                                                                    WHERE produit_id=:produit_id   
                                                                    AND hotel_id=:hotel_id 
                                                                    AND dte_report=:dte_report");
                                            $requete->BindParam(':produit_id', $art->produit_id);
                                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                            $requete->BindParam(':dte_report', $date_bon);
                                            $requete->execute();
                                            $report = $requete->fetchAll(PDO::FETCH_OBJ);
                                            
                                            foreach ($report as $rpt):
                                                $qte_initial_save[$i]=$rpt->qte_initial_save;
                                                echo $rpt->qte_initial_save;
                                            endforeach;
                                        }
                                        
                                    ?>
                                </td>
                                <td><?php echo $art->entree ?></td>
                                <td><?php echo $art->sortie ?></td>
                                <td>
                                    <?php 
                                    if ($date_bon==  date('Y-m-d')) {
                                            echo ($art->initial+$art->entree)-$art->sortie; 
                                        }  else {
                                            echo ($qte_initial_save[$i]+$art->entree)-$art->sortie; 
                                        }
                                    
                                    ?>
                                </td>
                            </tr>
                            <?php $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
