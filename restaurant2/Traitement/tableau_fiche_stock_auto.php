
<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../../FUNCTION/hebergement.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
   $datedeb=$datefin=  date('Y-m-d');
    $_SESSION['fs'] = array();
    $_SESSION['fs']['id'] = array();
    $_SESSION['fs']['des'] = array();
    $_SESSION['fs']['q0'] = array();
    $_SESSION['fs']['qin'] = array();
    $_SESSION['fs']['qout'] = array();
    $_SESSION['fs']['qsolde'] = array();
    $_SESSION['fs']['depot_id'] = array();
    $_SESSION['fs']['depot_name'] = array();
    $bool_date_error = FALSE;
    // Id article 
//    $date_rapport = $_POST['date_rapport'];
//    $date_PF = $_POST['date_PF'];
    $famille_id= 0;
    $depot_id = $_SESSION['depot_id'];
//    $datedeb = format_stringdateTodatetime("d/m/Y", $date_rapport, 'Y-m-d');
//    $datefin = format_stringdateTodatetime("d/m/Y", $date_PF, 'Y-m-d');
    $_SESSION['fiche_dte1']=$datedeb;
    $_SESSION['fiche_dte2']=$datefin;
    $_SESSION['famille_id']=$famille_id;
    $_SESSION['depot_id']=$depot_id;
    if ($datedeb <= $datefin &&!empty($datedeb)&&!empty($datefin)) {
        if($famille_id==0){

            $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam,stk__mouvement AS m
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND fam.plat=0 AND m.produit_id=prod.idprod AND m.depot_id=:depot_id ORDER BY prod.designation ";
                $requete = $bdd->prepare($req3);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':depot_id', $depot_id);
                $requete->execute();
                $articles = $requete->fetchAll(PDO::FETCH_OBJ);
            
            $requete = $bdd->prepare("SELECT a.id_depot,a.libelle FROM t_depot AS a
                WHERE a.id_depot=:id_depot AND a.hotel_id=:id_hotel");
            $requete->BindParam(':id_depot', $depot_id);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->execute();
            $depot = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($depot as $dp) {
                $id_depot= $dp->id_depot;
                $libelle_depot= $dp->libelle;
                $_SESSION['id_depot'] = $id_depot;
                $_SESSION['libelle_depot'] = $libelle_depot;
            }
            
        }  else {
 
            $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam,stk__mouvement AS m
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND fam.plat=0 AND m.produit_id=prod.idprod AND m.depot_id=:depot_id AND fam.idfamille=:idfamille ORDER BY prod.designation ";
                $requete = $bdd->prepare($req3);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':depot_id', $depot_id);
                $requete->BindParam(':idfamille',$famille_id);
                $requete->execute();
                $articles = $requete->fetchAll(PDO::FETCH_OBJ);
            $requete = $bdd->prepare("SELECT a.id_depot,a.libelle FROM t_depot AS a
                WHERE a.id_depot=:id_depot AND a.hotel_id=:id_hotel");
            $requete->BindParam(':id_depot', $depot_id);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->execute();
            $depot = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($depot as $dp) {
                $id_depot= $dp->id_depot;
                $libelle_depot= $dp->libelle;
                $_SESSION['id_depot'] = $id_depot;
                $_SESSION['libelle_depot'] = $libelle_depot;
            }
        }
    
        $req1="SELECT a.produit_id,a.qte_report FROM stk__mouvement AS a
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
            if (!in_array($r->produit_id,$_SESSION['fs']['id'])) {
                array_push($_SESSION['fs']['id'], $r->produit_id);
               $_SESSION['fs']['q0'][$r->produit_id]= $r->qte_report;
            } 
        }
        
        
        //Liste des entrées et sorties
        $req2="SELECT d.id_depot,d.libelle,prod.idprod,prod.code,prod.designation,SUM(qte_entree) AS qe,SUM(qte_sortie) AS qs,SUM(qte_declasse) AS qte_declasse
            FROM stk_produit AS prod, stk__mouvement AS m, t_depot AS d
            WHERE prod.idprod=m.produit_id AND d.id_depot=m.depot_id
            AND m.dte_appro BETWEEN :datedeb AND :datefin
            AND m.depot_id=:depot_id
            AND prod.hotel_id=:hotel_id
            GROUP BY prod.idprod";
        $requete = $bdd->prepare($req2);
        $requete->BindParam(':datedeb', $datedeb);
        $requete->BindParam(':datefin',$datefin);
        $requete->BindParam(':depot_id', $depot_id);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $qesll = $requete->fetchAll(PDO::FETCH_OBJ); 
        
        foreach ($qesll as $r) {
            if (!in_array($r->idprod,$_SESSION['fs']['id'])) {
                array_push($_SESSION['fs']['id'], $r->idprod);
            }
            $_SESSION['fs']['qin'][$r->idprod]= $r->qe; 
            $_SESSION['fs']['qout'][$r->idprod]= $r->qs; 
            $_SESSION['fs']['qavarie'][$r->idprod]= $r->qte_declasse; 
        }
        
        $_SESSION['articles']=$articles;
    } else {
        $bool_date_error = TRUE;
    }
//    var_dump($_SESSION['articles']);
?>
<!--Verification si les dates sont correctes-->
    <?php if (!$bool_date_error) { ?>
<div class="box-header">
    <div class="col-lg-10">
        <h3 class="box-title">
            Période : 
            <small>(du <?php echo date('d/m/Y'); ?>)</small>
        </h3>
    </div>
    <div class="col-lg-2 text-center">
        <a class="btn btn-default" href="./impression/examples/fiche_de_stock_1.php" target="_blank">
            <i class="fa fa-print fa-fw"></i>&nbsp;Imprimer
        </a>
    </div>
</div>
<!-- /.box-header -->
<div class="box-body table-responsive">
    <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example2">
        <thead>
            <tr>
                <th>N°</th>
<!--                <th>DEPOT</th>-->
                <th>ARTICLE</th>
                <th>QTE INITIAL</th>
                <th>QTE ENTREE</th>
                <th>QTE SORTIE</th>
                <th>QTE DECLASSEE</th>
                <th>SOLDE</th>
                <th>UNITE</th>
            </tr>
        </thead>
        <tbody>
            <?php
             $i = 1;
            foreach ($articles as $art){
                $q0=0;
                $qin=0;
                $qout=0;
                $qsolde=0;
                $qte_declasse=0;
                $idprod=$art->idprod;
                $des=$art->produit ;
                 if (in_array($idprod,$_SESSION['fs']['id'])) {
                    if(isset($_SESSION['fs']['q0'][$idprod])){
                        $q0=  $_SESSION['fs']['q0'][$idprod];
                    }  else {
                       $_SESSION['fs']['q0'][$idprod]=$q0;   
                    }
                    if(isset($_SESSION['fs']['qin'][$idprod])){
                        $qin=  $_SESSION['fs']['qin'][$idprod];
                    }  else {
                         $_SESSION['fs']['qin'][$idprod]=$qin;   
                    }
                    if(isset($_SESSION['fs']['qout'][$idprod])){
                        $qout=  $_SESSION['fs']['qout'][$idprod];
                    }  else {
                      $_SESSION['fs']['qout'][$idprod]=$qout;  
                    }
                    if(isset($_SESSION['fs']['qavarie'][$idprod])){
                        $qte_declasse=$_SESSION['fs']['qavarie'][$idprod];
                    }else{
                      $_SESSION['fs']['qavarie'][$idprod]=$qte_declasse;  
                    }
                 }  else {
                    array_push($_SESSION['fs']['id'],$idprod); 
                    $_SESSION['fs']['q0'][$idprod]=$q0;  
                    $_SESSION['fs']['qin'][$idprod]=$qin;
                    $_SESSION['fs']['qout'][$idprod]=$qout;  
                    $_SESSION['fs']['qavarie'][$idprod]=$qte_declasse; 
                 } 
                 $_SESSION['fs']['des'][$idprod]=$art->produit;  
                 $qsolde=($q0+$qin)-($qout+$qte_declasse);
                 $_SESSION['fs']['qsolde'][$idprod]=$qsolde;


                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i ?></td>
<!--                    <td><?php // echo $libelle_depot ?></td>-->
                    <td><?php echo $art->produit ?></td>
                    <td><?php echo $q0 ?></td>
                    <td><?php echo $qin ?></td>
                    <td><?php echo $qout ?></td>
                     <td><?php echo $qte_declasse ?></td>
                    <td><?php echo $qsolde ?></td>
                    <td><?php echo $art->unite ?></td>
                </tr>
                <?php
                 $i++;
            };
            ?>
        </tbody>
    </table>
</div>
<!-- /.box-body -->
<?php }else{ ?> 
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Erreur :</strong> La première date doit être inférieure à la deuxième!
    </div>
<?php } ?> 
