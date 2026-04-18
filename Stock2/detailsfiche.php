<!DOCTYPE html>
<html lang="fr">
    <?php 
    include('head.php'); 
    include '../FUNCTION/stock.php';
    include '../FUNCTION/hebergement.php';
    ?>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="Traitement/operation_affichage.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>

            </nav>
            <!-- /.navbar-top-links --> 

            <div id="page-wrapper">
                <?php
                $idprod=0;
                $des='';
                $result=array();
                if(isset($_GET['id']) && isset($_GET['des'])){
                    $idprod=$_GET['id'];
                    $des=$_GET['des'];
                    $requete = $bdd->prepare("SELECT * FROM stk__mouvement AS a
                                                 WHERE a.depot_id=:id_depot  AND a.produit_id=:produit_id
                                                 AND a.dte_appro BETWEEN :datedeb AND :datefin");
                    $requete->BindParam(':produit_id',$idprod);
                    $requete->BindParam(':id_depot',$_SESSION['id_depot']);
                    $requete->BindParam(':datedeb', $_SESSION['fiche_dte1']);
                    $requete->BindParam(':datefin',$_SESSION['fiche_dte2']);
                    $requete->execute();
                    $articles = $requete->fetchAll(PDO::FETCH_OBJ);
                }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">Fiche de stock</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>
                                    Détails
                                    <div class="btn-group  btn-group-sm pull-right">
                                        <a href="impression/detailfichestock.php" target="_blank" class="btn btn-primary btn-sm" title="Imprimer bon"><i class="fa fa-print"></i> Imprimer</a>
                                    </div>
                                </h4>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="page-header">
                                            <?php 
                                            echo $des;
                                            $_SESSION['designation_produit']=strtoupper($des);
                                             ?>
                                        </h3>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Dépôt: <?php echo $_SESSION['libelle_depot'] ?>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        Période <?php echo $_SESSION['periode_fiche'] ?>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <br>
                                <!-- /.row -->
                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Date</th>
                                                    <th>Initiale</th>
                                                    <th>Entrée</th>
                                                    <th>Sortie</th>
                                                     <th>Avarie</th>
                                                    <th>Solde</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                 //Mise en session pour impression
                                                    $_SESSION['fichestk'] = array();
                                                    $_SESSION['fichestk']['i'] = array();
                                                    $_SESSION['fichestk']['Date'] = array();
                                                    $_SESSION['fichestk']['Initiale'] = array();
                                                    $_SESSION['fichestk']['Entree'] = array();
                                                    $_SESSION['fichestk']['Sortie'] = array();
                                                    $_SESSION['fichestk']['Avarie'] = array();
                                                    $_SESSION['fichestk']['Solde'] = array();
                                                    //Fin mise en session
                                                $i=1;
                                                foreach ($articles as $art){
                                                 $dte_time=$art->dte_appro_heure;
                                                 $qte_report=$art->qte_report;
                                                 $qte_entree=$art->qte_entree;
                                                 $qte_sortie=$art->qte_sortie;
                                                 $qte_declasse=$art->qte_declasse;
                                                 $type=$art->type;
                                                 if($type=='appro'){
                                                   $q0= $qte_report-$qte_entree;  
                                                 }else{
                                                     $q0= $qte_report+($qte_sortie+$qte_declasse);  
                                                 }
                                                 $solde=($q0+$qte_entree)-($qte_sortie+$qte_declasse);
                                                array_push($_SESSION['fichestk']['i'], $i);
                                                array_push($_SESSION['fichestk']['Date'],dateAfficheForHr($dte_time));
                                                array_push($_SESSION['fichestk']['Initiale'], $q0);
                                                array_push($_SESSION['fichestk']['Entree'], $qte_entree);
                                                array_push($_SESSION['fichestk']['Sortie'], $qte_sortie);
                                                array_push($_SESSION['fichestk']['Avarie'], $qte_declasse);
                                                array_push($_SESSION['fichestk']['Solde'], $solde);

                                                ?>
                                                <tr class="odd gradeX">
                                                   <td><?php echo $i ?></td>
                                                   <td><?php echo dateAfficheForHr($dte_time)?></td>
                                                    <td><?php echo $q0 ?> </td> 
                                                    <td><?php echo $qte_entree ?> </td> 
                                                    <td><?php echo $qte_sortie ?></td>
                                                    <td><?php echo $qte_declasse ?></td>
                                                    <td><?php echo $solde ?></td>
                                                </tr>
                                                <?php $i++;} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <br>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <?php include('footer.php'); ?>

    </body>

</html>
