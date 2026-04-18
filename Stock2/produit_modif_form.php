<?php
session_start();
include './bdd/connexion.php';
include '../FUNCTION/stock.php';
include '../FUNCTION/hebergement.php';
$tab_prod['prix_produit'] = array();
$tab_prod['prix_produit']['id'] = array();
$tab_prod['prix_produit']['id_prix'] = array();
$tab_prod['prix_produit']['prix'] = array();

if (isset($_GET['code'])){
    $requete = $bdd->prepare("SELECT prod.path_image,prod.monnaie,prod.code,prod.idprod,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.repas,prod.qte_min,prod.unite,s_fam.des,fam.designation,fam.affichage FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam WHERE  prod.famille_id=s_fam.id_s_fam  AND prod.idprod=:code AND  prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille ORDER BY prod.idprod DESC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':code', $_GET['code']);
    $requete->execute();
    $produit_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
    $code = $_GET['code'];
    foreach ($produit_motifs as $operation){
        $produit_id=$operation->idprod;
        $monnaie = $operation->monnaie;
    }
}
$requete = $bdd->prepare("SELECT b.id_sousresto,b.libelle AS resto FROM t_sousresto AS b
                    WHERE b.hotel_id=:id_hotel AND b.etat=1 ORDER BY b.etat,b.libelle");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$depot = $requete->fetchAll(PDO::FETCH_OBJ);
$nbr=count($depot);
if($nbr==0){
    $visible=0;
}else{
    $visible=1;
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php
include('head.php');
?>
<body>
<?php include('Rapport/liste_produit_famille.php'); ?>
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
        <?php include('./Traitement/dateUS_fr.php'); ?>

    </nav>
    <!-- /.navbar-top-links -->
    <div id="affichage_before_impression">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        Apercu produit
                    </h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach ($produit_motifs as $operation): ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="alert alert-success alert-dismissable msg_sup" style="display:none;">
                                        La suppression s'est effectué avec succès!
                                    </div>
                                    <div class="panel-heading barre-cmd">
                                        <!--<a href="impression/examples/recu_bon_sortie.php?id=<?php echo $operation->idprod; ?>" title="Imprimer" class="btn btn-primary" id="btn_imprimer_be" target="_blank"><i class="fa fa-print fa-fw"></i> Imprimer</a>-->
                                        <a href="prod_update.php?idprod=<?php echo $operation->idprod; ?>"
                                           title="Modifier" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>
                                            Modifier</a>
                                        <a id="<?php echo $operation->idprod; ?>" title="Supprimer"
                                           class="btn btn-danger confirmModalLink" data-toggle="modal"
                                           data-target="#myModal"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                    </div>
                                    <div class="panel-body barre-cmd">
                                        <div class="row">
                                            <form role="form" id="form" action="Traitement/operation_insertion.php" class="form-horizontal form-label-left">
                                                <input type="hidden" name="entree" value="e">
                                                <input type="hidden" name="sortie" value="sortie">
                                                <input type="hidden" name="idoperation" value="">
                                                <br/>
                                                <div class="col-lg-6">                                               
                                                    <div class="table-responsive" align="center">
                                                        <table>
                                                            <tr>
                                                                <td width="130">Code&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                    echo ': ' . $operation->code;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="130">Designation&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                    echo ': ' . $operation->produit;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="130">Prix d'achat&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                     $pa=montant_equivalent_bdd_stk($operation->monnaie,$m_insert,$tauxdollar,$operation->pa);
                                                                        echo ': ' .$pa . ' ' . $m_insert;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="130">Qte. initiale&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                    echo ': ' . $operation->qte_initial;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="130">Qte. minimale&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                    echo ': ' . $operation->qte_min;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="130">Unite&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                    echo ': ' . $operation->unite;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="130">Sous Famille&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                    echo ': ' . $operation->des;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr height="15">
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="130">Famille&nbsp;&nbsp;</td>
                                                                <td width="321">
                                                                    <?php
                                                                    echo ': ' . $operation->designation;
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                    </div>

                                                </div>
                                                <div class="col-lg-3">
                                                    <img id='img-upload' width="100" height="100"  src="Traitement/<?php echo $operation->path_image ; ?>"/>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.row (nested) -->
                                        <?php if($operation->affichage==1){ ?>
                                        <br>
                                          <div class="row">
                                            <div class="col-lg-12">
                                                 <div class="nav-tabs-custom">
                                                  <ul class="nav nav-tabs" id="myTab">
                                                      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Prix de vente</a></li>
                                                      <?php if($operation->repas==3){ ?>
                                                        <li id="grsaleprod"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Groupe des produits</a></li>
                                                      <?php } ?>
                                                  </ul>
                                                  <div class="tab-content">
                                                      <div class="tab-pane active" id="tab_1">
                                                            <div class="col-lg-8">
                                                           <div class="table-responsive ">
                                                               <table class="table">
                                                                           <thead>
                                                                               <tr>
                                                                                   <th>POINT DE VENTE</th>
                                                                                   <th><span class="pull-right"></span></th>
                                                                               </tr>
                                                                           </thead>
                                                                           <tbody>
                                                                               <?php
                                                                               $i = 1;
                                                                               $prix_vente = 0;
                                                                               $sousresto_id = 0;
                                                                               $nbre = 0;
                                                                               foreach ($depot as $dep) {
                                                                                   $requete = $bdd->prepare("SELECT COUNT(*) AS nbre, a.id_prix,a.prix_vente,a.sousresto_id,a.monnaie FROM t_prix_produit AS a
                                                                                                             WHERE  a.produit_id=:produit_id AND a.sousresto_id=:sousresto_id");
                                                                                   $requete->BindParam(':produit_id', $produit_id);
                                                                                   $requete->BindParam(':sousresto_id', $dep->id_sousresto);
                                                                                   $requete->execute();
                                                                                   $prix_produits = $requete->fetch(PDO::FETCH_OBJ);
                                                                                   $nbre = $prix_produits->nbre;
                                                                                   //Prix produits
                                                                                   if ($nbre != 0) {
                                                                                       $tab_prod['prix_produit']['prix'][$dep->id_sousresto] = $prix_produits->prix_vente;
                                                                                       $tab_prod['prix_produit']['id_prix'][$dep->id_sousresto] = $prix_produits->id_prix;
                                                                                       $prix_vente = 1;
                                                                                   } else {
                                                                                       $prix_vente = 0;
                                                                                   }
                                                                                   $prix_vente = montant_equivalent_bdd_stk($prix_produits->monnaie, $m_insert, $tauxdollar, $prix_produits->prix_vente);
                                                                                   ?>
                                                                                   <tr>
                                                                                       <td><?php echo $dep->resto ?><input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>"></td>
                                                                                       <td>
                                                                                           <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                                                                                               <?php
                                                                                               echo ': ' . $prix_vente . ' ' . $m_insert;
                                                                                               ?>
                                                                                           </div>
                                                                                       </td>
                                                                                   </tr>
                                                                                   <?php
                                                                               }
                                                                               ?>
                                                                           </tbody>
                                                                       </table>
                                                           </div>
                                                           <!-- /.table-responsive -->

                                                       </div>
                                                      </div>
                                                       <div class="tab-pane" id="tab_2">
                                                           <br>
                                                           <div class="col-lg-12 table-responsive">
                                                               <div class="">
                                                                   <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example100">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>N°</th>
                                                                                <th>Désignation</th>
                                                                                <th>Quantité</th>
                                                                                <th>Unité</th>
                                                                                <!--<th>Action</th>-->
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="lignesmvmt">
                                                                          <?php
                                                                          $i=1;
                                                                          $ingredients=listeProduitIngredient($produit_id,$_SESSION['id_hotel'], $bdd);
                                                                           foreach ($ingredients as $ingr){
                                                                                $prod_id=$ingr->produit_id;
                                                                                $name=$ingr->designation;
                                                                                $qte=$ingr->quantite;
                                                                                $utite=$ingr->unite;
                                                                            ?>
                                                                                <tr class="odd gradeX">
                                                                                    <td><?php echo $i;?></td>
                                                                                    <td><?php echo $name;?></td>
                                                                                    <td><?php echo $qte;?></td>
                                                                                    <td><?php echo $utite;?></td>
<!--                                                                                    <td>
                                                                                        <a href="#" title="Supprimer"  class="text-danger">
                                                                                            <i class="fa fa-trash-o"></i>
                                                                                        </a>
                                                                                    </td>-->
                                                                                </tr>
                                                                            <?php $i++;}?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                        <!-- /.table-responsive -->
                                                            </div>
                                                           </div>
                                                                </div>
                                                           </div>
                                                      </div>
                                                      <!-- /.tab-pane -->
                                                  </div>
                                                  <!-- /.tab-content -->
                                              </div>  
                                            </div>
                                           
                                        </div>
                                         <?php } ?>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                    <?php endforeach; ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#affichage_before_impression-->
</div>
<!-- /#wrapper -->

<?php include('footer.php'); ?>

</body>

</html>
