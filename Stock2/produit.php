<!DOCTYPE html>
<html lang="fr">
<?php
include('head.php');
?>
<?php
$_SESSION['fiche'] = array();
$_SESSION['fiche']['ingred_id'] = array();
$_SESSION['fiche']['name'] = array();
$_SESSION['fiche']['qte'] = array();
$_SESSION['fiche']['utite'] = array();

$requete = $bdd->prepare("SELECT a.id_depot,b.libelle,b.id_sousresto,b.libelle AS resto FROM t_depot AS a, t_sousresto AS b
                    WHERE a.id_depot=b.depot_id AND a.hotel_id=:id_hotel AND b.etat=1");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$depot = $requete->fetchAll(PDO::FETCH_OBJ);
$nbr = count($depot);
$_SESSION['depot'] = $depot;
$visible = 1;
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
                    <h2 class="page-header">Produit</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div id="affichage_before_impression">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                            <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                        </div>
                        <form id="form_prod" action="Traitement/produit_insertion.php" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <button type="submit" class="btn btn-danger" id="save_produit" name="save_produit">
                                        <i class=" fa fa-save"></i> Enrégistrer
                                    </button>
                                    <a class="btn btn-success" href="impression/examples/recu_bon.php" target="_blank" style="display:none" id="btn_entree_imprimer">
                                        <i class=" fa fa-print"></i>&nbsp;&nbsp;Imprimer
                                    </a>
                                    <a href="produit_view.php" class="btn btn-primary btn-xs pull-right" title="Afficher tous les produits"><i class="fa fa-list"></i> Liste </a>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $m_insert; ?>">
                                        <div class="col-lg-7" id="contenaire">
                                            <br>
                                            <div class="form-group hidden">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Famille
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" id="famille_id" name="famille_id">
                                                        <option> </option>
                                                        <?php

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sous-famille
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" id="s_famille_id" name="s_famille_id">
                                                        <option> </option>
                                                        <?php
                                                        include('./Traitement/s_famille_combo.php');
                                                        foreach ($s_familles  as $f) :
                                                            echo '<option vente=' . $f->affichage . ' value=' . $f->id_s_fam . '>' . ucfirst($f->des) . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group pv hidden">
                                                <input type="hidden" value="0" name="repas" id="repas">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Vente</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="radio" name="venteprod" id="venteprod1" value="simple" class="prodpv" checked="">
                                                    simple
                                                    <input type="radio" name="venteprod" id="venteprod2" value="groupe" class="prodpv">
                                                    groupe
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Designation</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" id="libelle" name="libelle">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Code
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" id="code" name="code">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Unité
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control" id="unite" name="unite">
                                                        <option></option>
                                                        <option value="piece">Pièce</option>
                                                        <option value="kg">Kilogramme</option>
                                                        <option value="l">Litre</option>
                                                        <option value="cl">Centilitre</option>
                                                        <option value="g">Gramme</option>
                                                        <option value="Portion">Portion</option>
                                                        <option value="Ekolo">Ekolo</option>
                                                        <option value="Mesurette">Mesurette</option>
                                                        <option value="Filet">Filet</option>
                                                        <option value="Verre">Verre</option>
                                                        <option value="Sakombi">Sakombi</option>
                                                        <option value="Boite">Boite</option>
                                                        <option value="Paquet">Paquet</option>
                                                        <option value="Sachet">Sachet</option>
                                                        <option value="Carton">Carton</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group plat vgrpe">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantité min
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" name="qte_min" id="qte_min" value="0" type="number" min="0">
                                                </div>
                                            </div>
                                            <div class="form-group plat hidden">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Quantité
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="form-control col-md-7 col-xs-12" id="qte" name="qte" value="0">
                                                </div>
                                            </div>

                                            <div class="form-group plat vgrpe">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Prix d'achat </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                    <div class="input-group">
                                                        <input class="form-control " name="prix_achat" id="prix_achat" value="0" type="text" min="0">
                                                        <span class="input-group-addon"><?php echo $m_insert; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group hidden">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Prix de vente par defaut
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group input-group">
                                                        <input class="form-control" name="prix_vente" id="prix_vente" value="0">
                                                        <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 pull-left">
                                            <div class="form-group">
                                                <label>Upload Image</label>
                                                <div class="input-group col-md-11 col-sm-11 col-xs-12">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-primary btn-file">
                                                            Parcourir <input type="file" id="imgInp" name="image">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control" id="fichier" readonly2>

                                                </div>
                                                <br>
                                                <img id='img-upload' width="100" height="100" />

                                            </div>
                                        </div>
                                        <div class="col-lg-12 pv hidden">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs" id="myTab">
                                                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Prix de vente</a></li>
                                                    <li style="display: none;" id="grsaleprod"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Groupe des produits</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1">
                                                        <div class="col-lg-7 col-md-offset-2">
                                                            <div class="table-responsive ">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>POINT DE VENTE</th>
                                                                            <th><span class="pull-right">Prix de vente</span></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $i = 1;
                                                                        foreach ($depot as $dep) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo $dep->resto ?><input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>"></td>
                                                                                <td>
                                                                                    <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                                                                                        <div class="form-group input-group">
                                                                                            <input class="form-control prxventsit" name=" prix_vente_site[]" id="prix_vente_site" value="">
                                                                                            <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                                                                                        </div>
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
                                                            <div>
                                                                <a class="btn btn-primary btn-sm" href="#" title="Ajouter" data-toggle="modal" data-target="#modalproduit">
                                                                    <i class="fa fa-plus-circle"></i> Ajouter
                                                                </a>
                                                            </div>
                                                            <br>
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
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="lignesmvmt">
                                                                                    <tr class="odd gradeX">
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td>
                                                                                            <a href="#" title="Supprimer" class="text-danger">
                                                                                                <i class="fa fa-trash-o"></i>
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
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
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </form>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#affichage_before_impression -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Modal sortie-->
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
                                <input type="hidden" name="motif_sortie_id" value="6">
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