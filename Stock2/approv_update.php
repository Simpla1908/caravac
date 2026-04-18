<?php
session_start();
//Fusion horaire
date_default_timezone_set('Africa/Kinshasa');
include('./Traitement/Panier.php');
include './bdd/connexion.php';
include '../FUNCTION/stock.php';
include './Traitement/approv_motif_edit.php';
$panier = new Panier();
$panier->annuler();
$motifs = ListMotifSortie($bdd);
$depot = ListPOS($_SESSION['id_hotel'], $bdd);
$fiche_id = $_GET['fiche_id'];
$fiche_num = $_GET['fiche_num'];
$fiche_dte = $_GET['fiche_dte'];
$user_name = $_GET['user_name'];
$requete = $bdd->prepare("SELECT  * FROM stk_produit AS prod, stk__mouvement AS m WHERE prod.idprod=m.produit_id AND m.type='appro' AND m.qte_entree!=0 AND m.appro_depot=0 AND m.hotel_id=:hotel_id AND m.fiche_id=:fiche_id ORDER BY prod.designation ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':fiche_id', $fiche_id);
$requete->execute();
$mouvements = $requete->fetchAll(PDO::FETCH_OBJ);
$requete = $bdd->prepare("SELECT  * FROM skt_fiche  WHERE id_fiche=:id_fiche");
$requete->BindParam(':id_fiche', $fiche_id);
$requete->execute();
$fiche = $requete->fetch(PDO::FETCH_OBJ);
$motifappro = $fiche->motifappro;
$numbon = $fiche->numero;
$dte = $fiche->dte;
$beneficiere = $fiche->beneficiere;


$_SESSION['motifappro'] = $motifappro;
foreach ($mouvements as $ap) :
    //Mise en session pour impression
    sessionDetailsBon($ap->produit_id, $ap->designation, $ap->qte_entree, 0, 0, $ap->unite, ' ');
    $select['id'] = $ap->produit_id;
    $select['nom'] = $ap->designation;
    $select['qte'] = $ap->qte_entree;
    $select['unite'] = $ap->unite;
    $select['idmotif'] = 7;
    $select['motif'] = '';
    $panier->ajouterstock($select);

endforeach;

?>
<!DOCTYPE html>
<html lang="fr">

<?php
include('head.php');
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
                <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png" /></a>
            </div>
            <!-- /.navbar-header -->

            <?php include('navigation.php'); ?>
            <?php include('menu.php'); ?>
            <?php include('Fonctions/fx_.php'); ?>
        </nav>
        <!-- /.navbar-top-links -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Approvisionnement</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form id="form" method="post" action="" class="form-horizontal form-label-left frmstk" novalidate>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="msg_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                            <span id="msg_alert_grp"></span>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <button id="btn_save_mvmt_update" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-save"></i> Modifier</button>
                                <button class="btn btn-sm btn-danger hidden loader">
                                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                </button>
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="approvisionnement_liste.php" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i> Liste</a>
                                </div>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <br>
                                <input value="<?php echo $fiche_id; ?>" class="form-control col-md-7 col-xs-12 hidden" id="fiche_id" name="fiche_id" type="text">
                                <input value="<?php echo $numbon; ?>" class="form-control col-md-7 col-xs-12 hidden" id="numbon" name="numbon" type="text">
                                <input value="<?php echo $dte; ?>" class="form-control col-md-7 col-xs-12 hidden" id="dte" name="dte" type="text">
                                <input value="<?php echo $beneficiere; ?>" class="form-control col-md-7 col-xs-12 hidden" id="beneficiere" name="beneficiere" type="text">
                                <input value="<?php echo $_SESSION['id_hotel']; ?>" class="form-control col-md-7 col-xs-12 hidden" id="hotel_id" name="hotel_id" type="text">
                                <div class="item form-group hidden">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="numbon">N° Bon <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12 modif" id="numbon" name="numbon" type="text" required="required">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pos_id">Motif<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12" id="motifappro" name="motifappro" required>
                                            <option value="<?php echo $motifappro; ?>"><?php echo $motifappro; ?></option>

                                            <option value="appro">appro</option>
                                            <option value="retour produit">retour produit</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group hidden">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pos_id">Emplacement<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12" id="emplacement_id" name="emplacement_id" required>
                                            <?php
                                            //Point de vente
                                            foreach ($depot as $p) {
                                            ?>
                                                <option etat="<?php echo $p->etat ?>" value='<?php echo $p->depot_id ?>' posname="<?php echo ucfirst($p->libelle) ?>"><?php echo ucfirst($p->libelle) ?> </option>;
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Date">Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" disabled="disabled" value="<?php echo date('d/m/Y') ?>" required type="text">
                                    </div>
                                </div>
                                <input class="form-control col-md-7 col-xs-12" id="datebonentre" name="date_bon" value="<?php echo date('d/m/Y') ?>" required type="hidden">
                                <br><br>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#profile" data-toggle="tab">Liste produits</a>
                                    </li>
                                    <a class="btn btn-primary btn-sm pull-right" href="#" title="Ajouter" data-toggle="modal" data-target="#modalproduit">
                                        <i class="fa fa-plus-circle"></i> Ajouter produit
                                    </a>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content" id="bloc_actions">
                                    <br><br>
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
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="lignesmvmt">
                                                        <?php
                                                        $nbArticles = count($_SESSION['panier']['id_article']);
                                                        $j = 1;
                                                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                            $idmotif = $_SESSION['panier']['idmotif'][$i];
                                                            if ($idmotif == 7 || $op == 'appro' || $op == 'transfert') {
                                                                $id = $_SESSION['panier']['id_article'][$i];
                                                                $nom = $_SESSION['panier']['nom'][$i];
                                                                $qte = $_SESSION['panier']['qte'][$i];
                                                                $unite = $_SESSION['panier']['unite'][$i];
                                                                $motif = $_SESSION['panier']['motif'][$i];
                                                        ?>
                                                                <tr class="odd gradeX">
                                                                    <td><?php echo $j ?></td>
                                                                    <td><?php echo $nom ?></td>
                                                                    <td><?php echo $qte ?></td>
                                                                    <td><?php echo $unite ?></td>
                                                                    <td>
                                                                        <a href="#" op="appro" affichage="#lignesmvmt" id="<?php echo $id ?>" title="Supprimer" class="text-danger btn_del_prod_panier">
                                                                            <i class="fa fa-trash-o"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                        <?php $j++;
                                                            }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </form>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="modalproduit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lgm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="frmaddprodstk">
                                <div class="form-group">
                                    <label>Famille</label>
                                    <select class="form-control" style="width: 100%;" id="searchfam_id" name="searchfam_id" required>
                                        <option value="0">Tout</option>
                                        <?php
                                        $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                                            . " WHERE f.hotel_id=:hotel_id AND f.plat=0 ORDER BY designation");
                                        //session à enlever
                                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                        $requete->execute();
                                        $s_familles = $requete->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($s_familles  as $f) :
                                            echo '<option value=' . $f->idfamille . '>' . ucfirst($f->designation) . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Produit</label>
                                    <select class="form-control select2 article" style="width: 100%;" id="article" name="prod_id" required>
                                        <option> </option>
                                        <?php
                                        include("./Traitement/produit_combo.php");
                                        foreach ($produits as $p) {
                                        ?>
                                            <option value='<?php echo $p->idprod; ?>' prod_nom="<?php echo $p->designation; ?>" unite="<?php echo $p->unite; ?>"><?php echo ucfirst($p->designation); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- /.form-group -->
                                <div class="form-group" id="quantite_transf444">
                                    <label>Quantité</label>
                                    <input type="number" min="1" class="form-control col-md-7 col-xs-12" id="qte" name="qte" value="<?php echo 1; ?>">
                                </div>
                                <!-- /.form-group -->
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Unité</label>
                                    <input type="hidden" name="unite" class="unite">
                                    <input type="hidden" name="prod_nom" id="prod_nom" class="prod_nom">
                                    <input type="text" class="form-control col-md-7 col-xs-12 unite" disabled="">
                                </div>
                                <div class="form-group hidden">
                                    <label>Motif</label>
                                    <select class="form-control select2 motif_sortie" style="width: 100%;" id="motif_sortie_id" name="motif_sortie_id" required>
                                        <?php
                                        foreach ($motifs as $p) {
                                            if ($p->id_motif_sortie == 6) {
                                        ?>
                                                <option value='<?php echo $p->id_motif_sortie; ?>' prod_nom="<?php echo $p->libelle; ?>"><?php echo ucfirst($p->libelle); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <input type="hidden" name="motif_sortie_lib" class="motif_sortie_lib" value="appro">
                                <input type="hidden" name="operation" value="appro">
                                <input type="hidden" name="affichage" value="#lignesmvmt">
                            </form>

                        </div>
                    </div>
                </div>
                <div class="modal-footer align-center">
                    <div id="msg" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msgtext">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button class="btn btn-danger" id="btn_add_prod_panier">
                        <i class="fa fa-check fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <?php include('footer.php'); ?>

</body>

</html>