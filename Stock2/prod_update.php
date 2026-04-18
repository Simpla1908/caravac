<!DOCTYPE html>
<html lang="fr">
<?php
include('head.php');
include '../FUNCTION/hebergement.php';
include './Traitement/produit_motif_edit.php';
//    include('../FUNCTION/stock.php');
//    include('./Traitement/Panier.php');
$_SESSION['panier'] = array();
$_SESSION['panier']['id_article'] = array();
$_SESSION['panier']['nom'] = array();
$_SESSION['panier']['qte'] = array();
$_SESSION['panier']['unite'] = array();
$_SESSION['panier']['idmotif'] = array();
$_SESSION['panier']['motif'] = array();
$tab_prod['prix_produit'] = array();
$tab_prod['prix_produit']['id'] = array();
$tab_prod['prix_produit']['id_prix'] = array();
$tab_prod['prix_produit']['prix'] = array();
if (isset($_GET['idprod'])) {
    $produit_id = $_GET['idprod'];
    $produit_motifs = getproduit_motif($produit_id, $bdd);

    $requete = $bdd->prepare("SELECT b.id_sousresto,b.libelle AS resto FROM t_sousresto AS b
                    WHERE  b.hotel_id=:id_hotel AND b.etat=1 ORDER BY b.etat,b.libelle");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $depot = $requete->fetchAll(PDO::FETCH_OBJ);
    $nbr = count($depot);
    if ($nbr == 0) {
        $visible = 0;
    } else {
        $visible = 1;
        $_SESSION['depot'] = $depot;
    }
    $ingredients = listeProduitIngredient($produit_id, $_SESSION['id_hotel'], $bdd);
    foreach ($ingredients as $ingr) {
        $prod_id = $ingr->produit_id;
        $name = $ingr->designation;
        $qte = $ingr->quantite;
        $utite = $ingr->unite;
        $select['id'] = $prod_id;
        $select['nom'] = $name;
        $select['qte'] = $qte;
        $select['unite'] = $utite;
        $select['idmotif'] = 6;
        $select['motif'] = 6;
        array_push($_SESSION['panier']['id_article'], $select['id']);
        array_push($_SESSION['panier']['nom'], $select['nom']);
        array_push($_SESSION['panier']['qte'], $select['qte']);
        array_push($_SESSION['panier']['unite'], $select['unite']);
        array_push($_SESSION['panier']['idmotif'], $select['idmotif']);
        array_push($_SESSION['panier']['motif'], $select['motif']);
    }
}
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
                        <form id="form_update" action="Traitement/prod_modifier.php" method="post" class="form-horizontal form-label-left">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <button type="submit" class="btn btn-danger" id="update_produit" name="update_produit">
                                        <i class=" fa fa-edit"></i> Modifier
                                    </button>
                                    <a class="btn btn-success" href="impression/examples/recu_bon.php" target="_blank" style="display:none" id="btn_entree_imprimer">
                                        <i class=" fa fa-print"></i>&nbsp;&nbsp;Imprimer
                                    </a>
                                    <a href="produit_view.php" class="btn btn-primary btn-xs pull-right" title="Liste de produits"><i class="fa fa-list"></i> Liste</a>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php
                                        foreach ($produit_motifs as $prod) :
                                            if ($prod->affichage == 1) {
                                                $display1 = 'block';
                                            } else {
                                                $display1 = 'none';
                                            }
                                        ?>

                                            <input type="hidden" name="monnaie" value="<?php echo $m_insert; ?>">
                                            <input type="hidden" name="idprod" value="<?php echo $prod->idprod; ?>">
                                            <input type="hidden" name="vendable" value="<?php echo $prod->affichage; ?>">
                                            <div class="col-lg-7" id="contenaire">
                                                <div class="form-group hidden">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Famille
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control" id="famille_id" name="famille_id">
                                                            <?php
                                                            echo '<option value=' . $prod->idfamille . '>' . $prod->designation . '</option>';
                                                            include('Traitement/s_famille_combo.php');
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sous-famille
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control" id="s_famille_id" name="s_famille_id">
                                                            <?php foreach ($s_familles as $s_f) { ?>
                                                                <option vente="<?php echo $s_f->affichage ?>" value="<?php echo $s_f->id_s_fam ?>"><?php echo $s_f->des ?></option>
                                                            <?php } ?>
                                                            <option vente="<?php echo $prod->affichage ?>" value="<?php echo $prod->id_s_fam ?>" selected="selected"><?php echo $prod->des ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?php echo $prod->repas; ?>" name="repas" id="repas">
                                                <?php if ($prod->affichage == 1) { ?>
                                                    <div class="form-group pv">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Vente</label>

                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <?php if ($prod->repas == 0) { ?>
                                                                <input type="radio" name="venteprod" id="venteprod1" value="simple" class="prodpv" checked="">
                                                                simple
                                                                <input type="radio" name="venteprod" id="venteprod2" value="groupe" class="prodpv">
                                                                groupe
                                                            <?php } else { ?>
                                                                <input type="radio" name="venteprod" id="venteprod1" value="simple" class="prodpv">
                                                                simple
                                                                <input type="radio" name="venteprod" id="venteprod2" value="groupe" class="prodpv" checked="">
                                                                groupe
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Désignation</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control col-md-7 col-xs-12" id="libelle" name="libelle" value="<?php echo $prod->produit; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Code
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control" name="code_ex" value="<?php echo $prod->code; ?>" type="hidden">
                                                        <input class="form-control" id="code" name="code" value="<?php echo $prod->code; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Unité
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control" id="unite" name="unite">
                                                            <?php
                                                            echo '<option value=' . $prod->unite . '>' . $prod->unite . '</option>';
                                                            ?>
                                                            <option value="piece">Pièce</option>
                                                            <option value="kg">Kilogramme</option>
                                                            <option value="l">Litre</option>
                                                            <option value="cl">Centilitre</option>
                                                            <option value="g">Gramme</option>
                                                            <option value="Portion">Portion</option>
                                                            <option value="Ekolo">Ekolo</option>
                                                            <option value="Mesurette">Mesurette</option>
                                                            <option value="filet">Filet</option>
                                                            <option value="verre">Verre</option>
                                                            <option value="sakombi">Sakombi</option>
                                                            <option value="boite">Boite</option>
                                                            <option value="paquet">Paquet</option>
                                                            <option value="sachet">Sachet</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group plat" style="display:<?php echo $display1; ?>">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quantité min
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input class="form-control " name="qte_min" id="qte_min" value="<?php echo $prod->qte_min; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group plat hidden" style="display:<?php echo $display1; ?>">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Quantité
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <?php if ($prod->statut == 0) { ?>
                                                            <input class="form-control" id="qte" name="qte" value="<?php echo $prod->qte_initial; ?>">
                                                        <?php } else { ?>
                                                            <input class="form-control" id="qte" name="qte_v" disabled="disabled" value="<?php echo $prod->qte_initial; ?>">
                                                            <input class="form-control" id="qte" name="qte" type="hidden" value="<?php echo $prod->qte_initial; ?>">
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Prix d'achat </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                        <div class="input-group">
                                                            <input class="form-control " name="prix_achat" id="prix_achat" value="<?php echo $prod->pa; ?>">
                                                            <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group hidden">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Prix de vente par defaut
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="input-group">
                                                            <input class="form-control pv" name="prix_vente" id="prix_vente" value="<?php echo $prod->pv; ?>"><input class="form-control" name="enreg" id="enreg" type="hidden" value="1">
                                                            <span class="input-group-addon pv"> <?php echo $m_insert; ?></span>
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
                                                        <input type="text" class="form-control" id="fichier" readonly2 value="<?php echo $prod->path_image; ?>">

                                                    </div>
                                                    <br>
                                                    <img id='img-upload' width="100" height="100" src="Traitement/<?php echo $prod->path_image; ?>" />

                                                </div>
                                            </div>
                                            <?php if ($prod->affichage == 1) {
                                            ?>
                                                <br>
                                                <div class="row">
                                                    <div class="col-lg-12 pv">
                                                        <div class="nav-tabs-custom">
                                                            <ul class="nav nav-tabs" id="myTab">
                                                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Prix de vente</a></li>
                                                                <?php if ($prod->repas == 0) { ?>
                                                                    <li id="grsaleprod" style="display: none;"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Groupe des produits</a></li>
                                                                <?php } else { ?>
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
                                                                                        <th>POINTS DE VENTE</th>
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
                                                                                        $requete = $bdd->prepare("SELECT COUNT(*) AS nbre, a.id_prix,a.prix_vente,a.sousresto_id FROM t_prix_produit AS a
                                                                                                WHERE a.produit_id=:produit_id AND a.sousresto_id=:sousresto_id");
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
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $dep->resto ?>
                                                                                                <input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>">
                                                                                                <?php if ($prix_vente == 0) { ?>
                                                                                                    <input class="form-control hidden" name="prix_id[]" id="prix_id" value="0">
                                                                                                <?php } else { ?>
                                                                                                    <input class="form-control hidden" name="prix_id[]" id="prix_id" value="<?php echo $tab_prod['prix_produit']['id_prix'][$dep->id_sousresto] ?>">
                                                                                                <?php } ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                                                                                                    <div class="form-group input-group">
                                                                                                        <?php if ($prix_vente == 0) { ?>
                                                                                                            <input class="form-control prxventsit" name="prix_vente_site[]" id="prix_vente_site" value="<?php echo $prix_vente; ?>" title="<?php echo $prix_vente; ?>">
                                                                                                        <?php
                                                                                                        } else {
                                                                                                        ?>
                                                                                                            <input class="form-control prxventsit" name="prix_vente_site[]" id="prix_vente_site" value="<?php echo $tab_prod['prix_produit']['prix'][$dep->id_sousresto]; ?>" title="<?php echo $tab_prod['prix_produit']['prix'][$dep->id_sousresto]; ?>">
                                                                                                        <?php } ?>
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
                                                                                                <?php
                                                                                                $nbArticles = count($_SESSION['panier']['id_article']);
                                                                                                $j = 1;
                                                                                                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                                                                    $idmotif = $_SESSION['panier']['idmotif'][$i];
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
                                                                                                } ?>
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
                                            <?php }
                                            ?>

                                        <?php endforeach; ?>
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
                                    <input type="text" class="form-control col-md-7 col-xs-12" id="qte" name="qte" value="<?php echo 1; ?>">
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