<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['fs'] = array();
$_SESSION['fs']['id'] = array();
$_SESSION['fs']['des'] = array();
$_SESSION['fs']['q0'] = array();
$_SESSION['fs']['qin'] = array();
$_SESSION['fs']['qout'] = array();
$_SESSION['fs']['qavarie'] = array();
$_SESSION['fs']['qsolde'] = array();
$_SESSION['fs']['depot_id'] = array();
$_SESSION['fs']['depot_name'] = array();
$bool_date_error = FALSE;
$libelle_depot = 'Tout';
$_SESSION['libelle_depot'] = $libelle_depot;
if (isset($_POST['valider'])) {
    include './custum_functions.php';
    include('./bdd/connexion.php');
    include('../FUNCTION/stock.php');
    $date_rapport = $_POST['date_rapport'];
    $date_PF = $_POST['date_PF'];
    $famille_id = $_POST['famille_id'];
    $depot_id = $_POST['depot_id'];
    $datedeb = format_stringdateTodatetime("d/m/Y", $date_rapport, 'Y-m-d');
    $datefin = format_stringdateTodatetime("d/m/Y", $date_PF, 'Y-m-d');
} else {
    $famille_id = 0;
    $depot_id = GetDepotCentral_id($_SESSION['id_hotel'], $bdd);
    $datedeb = date('Y-m-d');
    $datefin = date('Y-m-d');
    $date_rapport = $date_PF = date('d/m/Y');
}
// Id article 
$_SESSION['fiche_dte1'] = $datedeb;
$_SESSION['fiche_dte2'] = $datefin;
$_SESSION['famille_id'] = $famille_id;
$_SESSION['depot_id'] = $depot_id;
$etat_depot = 0;
if ($datedeb <= $datefin && !empty($datedeb) && !empty($datefin)) {
    //Infos Depot   
    $requete = $bdd->prepare("SELECT * FROM t_sousresto AS a
            WHERE a.depot_id=:id_depot");
    $requete->BindParam(':id_depot', $depot_id);
    $requete->execute();
    $depot = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($depot as $dp) {
        $id_depot = $dp->depot_id;
        $etat_depot = $dp->etat;
        $_SESSION['id_depot'] = $id_depot;
    }
    $_SESSION['periode_fiche'] = ' du ' . $date_rapport . ' au ' . $date_PF;
    //Liste des produits
    if ($etat_depot == 1) {
        if ($famille_id == 0) {
            //Liste de tous les produits par depot
            $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam,stk__mouvement AS m
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND prod.repas=0
                             AND fam.plat=0 AND m.produit_id=prod.idprod ORDER BY prod.designation ";
            $requete = $bdd->prepare($req3);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
            $articles = $requete->fetchAll(PDO::FETCH_OBJ);
        } else {
            //Liste de tous les produits par famille et depot
            $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam,stk__mouvement AS m
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND prod.repas=0
                             AND fam.plat=0 AND m.produit_id=prod.idprod AND fam.idfamille=:idfamille ORDER BY prod.designation ";
            $requete = $bdd->prepare($req3);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':idfamille', $famille_id);
            $requete->execute();
            $articles = $requete->fetchAll(PDO::FETCH_OBJ);
        }
    } else {
        //Pour le depot central, on affiche tous les produits
        if ($famille_id == 0) {
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
        } else {
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
            $requete->BindParam(':idfamille', $famille_id);
            $requete->execute();
            $articles = $requete->fetchAll(PDO::FETCH_OBJ);
        }
    }
    //Liste des reports des produits
    $depot = ListPOS($_SESSION['id_hotel'], $bdd);
    foreach ($depot as $p) {
        $depot_id = $p->depot_id;
        $req1 = "SELECT a.produit_id,a.qte_report FROM stk__mouvement AS a
                    WHERE a.idmvt IN
			(SELECT MAX(b.idmvt) AS idmvt 
                                  FROM stk__mouvement AS b 
                                   WHERE  b.depot_id=:depot_id
                                   AND b.dte_appro<:datedeb
                                   GROUP BY b.produit_id)";
        $requete = $bdd->prepare($req1);
        $requete->BindParam(':datedeb', $datedeb);
        $requete->BindParam(':depot_id', $depot_id);
        $requete->execute();
        $qiall = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($qiall as $r) {
            if (!in_array($r->produit_id, $_SESSION['fs']['id'])) {
                array_push($_SESSION['fs']['id'], $r->produit_id);
                $_SESSION['fs']['q0'][$r->produit_id] = $r->qte_report;
            } else {
                $_SESSION['fs']['q0'][$r->produit_id] = $_SESSION['fs']['q0'][$r->produit_id] + $r->qte_report;
            }
        }
    }
    //Liste des entrées et sorties
    $req2 = "SELECT d.id_depot,d.libelle,prod.idprod,prod.code,prod.designation,SUM(qte_entree) AS qe,SUM(qte_sortie) AS qs,SUM(qte_declasse) AS qte_declasse
            FROM stk_produit AS prod, stk__mouvement AS m, t_depot AS d
            WHERE prod.idprod=m.produit_id AND d.id_depot=m.depot_id
            AND m.dte_appro BETWEEN :datedeb AND :datefin
            AND prod.hotel_id=:hotel_id
            GROUP BY prod.idprod";
    $requete = $bdd->prepare($req2);
    $requete->BindParam(':datedeb', $datedeb);
    $requete->BindParam(':datefin', $datefin);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $qesll = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($qesll as $r) {
        if (!in_array($r->idprod, $_SESSION['fs']['id'])) {
            array_push($_SESSION['fs']['id'], $r->idprod);
        }
        $_SESSION['fs']['qin'][$r->idprod] = $r->qe;
        $_SESSION['fs']['qout'][$r->idprod] = $r->qs;
        $_SESSION['fs']['qavarie'][$r->idprod] = $r->qte_declasse;
    }
    $_SESSION['articles'] = $articles;
} else {
    $bool_date_error = TRUE;
}

?>
<!--Verification si les dates sont correctes-->
<?php if (!$bool_date_error) { ?>
    <!--Verification si le nombre d'article est> à 1 -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php
                // if($depot_id!=0){
                echo '<b>Depot:</b> ' . $libelle_depot;
                //  } 
                ?>
                <span class="pull-right" style="margin-top: -5px;">
                    <a href="impression/fiche_de_stock_1.php?famille_id=<?php // echo $idprod;
                                                                        ?>&date_rapport=<?php // echo $datedeb; 
                                                                                        ?>&date_PF=<?php // echo $datefin; 
                                                                                                    ?>&debut=<?php // echo $date_rapport; 
                                                                                                                ?>&fin=<?php // echo $date_PF; 
                                                                                                                        ?>&produit=<?php // echo $designation; 
                                                                                                                                    ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Imprimer</a>
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
                                <th>Initiale</th>
                                <th>Entrée</th>
                                <th>Sortie</th>
                                <th>Avarie</th>
                                <th>Solde</th>
                                <th>Unité</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($articles as $art) {
                                $q0 = 0;
                                $qin = 0;
                                $qout = 0;
                                $qsolde = 0;
                                $qte_declasse = 0;
                                $idprod = $art->idprod;
                                $des = $art->produit;
                                if (in_array($idprod, $_SESSION['fs']['id'])) {
                                    if (isset($_SESSION['fs']['q0'][$idprod])) {
                                        $q0 =  $_SESSION['fs']['q0'][$idprod];
                                    } else {
                                        $_SESSION['fs']['q0'][$idprod] = $q0;
                                    }
                                    if (isset($_SESSION['fs']['qin'][$idprod])) {
                                        $qin =  $_SESSION['fs']['qin'][$idprod];
                                    } else {
                                        $_SESSION['fs']['qin'][$idprod] = $qin;
                                    }
                                    if (isset($_SESSION['fs']['qout'][$idprod])) {
                                        $qout =  $_SESSION['fs']['qout'][$idprod];
                                    } else {
                                        $_SESSION['fs']['qout'][$idprod] = $qout;
                                    }
                                    if (isset($_SESSION['fs']['qavarie'][$idprod])) {
                                        $qte_declasse = $_SESSION['fs']['qavarie'][$idprod];
                                    } else {
                                        $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                                    }
                                } else {
                                    array_push($_SESSION['fs']['id'], $idprod);
                                    $_SESSION['fs']['q0'][$idprod] = $q0;
                                    $_SESSION['fs']['qin'][$idprod] = $qin;
                                    $_SESSION['fs']['qout'][$idprod] = $qout;
                                    $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                                }
                                /* $_SESSION['fs']['des'][$idprod]=$art->produit;  
                                             $qsolde=($q0+$qin)-($qout+$qte_declasse);
                                             $_SESSION['fs']['qsolde'][$idprod]=$qsolde; */
                                $qsolde = ($q0 + $qin) - ($qout + $qte_declasse);
                                if (!is_int($qsolde)) {
                                    $qsolde = number_format($qsolde, 2);
                                }

                                $_SESSION['fs']['des'][$idprod] = $art->produit;
                                $_SESSION['fs']['qsolde'][$idprod] = $qsolde;
                            ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $des ?></td>
                                    <td><?php echo round($q0, 2) ?></td>
                                    <td><?php echo round($qin, 2) ?></td>
                                    <td><?php echo round($qout, 2) ?></td>
                                    <td><?php echo round($qte_declasse, 2) ?></td>
                                    <td><?php echo $qsolde ?></td>
                                    <td><?php echo $art->unite ?></td>
                                    <td>
                                        <a class="btn btn-info btn-xs " href="detailsfiche.php?id=<?php echo $idprod ?>&des=<?php echo $des ?>">
                                            <i class="fa fa-list"></i> Détails</a>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            };
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


<?php } else { ?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Erreur :</strong> La première date doit être inférieure à la deuxième!
    </div>
<?php } ?>