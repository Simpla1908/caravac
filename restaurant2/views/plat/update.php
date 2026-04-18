<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>MODIFICATION PLAT</h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="box" id="tableau_versement1">
        <div class="box-body" id="ajout">
            <form id="form_update_plat" action="Traitement/prod_modifier.php" method="post" class="form-horizontal form-label-left">
                <input class="form-control hidden" name="monnaie" id="monnaie" value="<?php echo $prod->monnaie; ?>">
                <input type="hidden" name="idprod" value="<?php echo $prod->idprod; ?>">
                <input class="form-control hidden" name="plat" id="plat" value="1">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Famille</label>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control" id="famille_id" name="famille_id" required>
                                        <option> </option>
                                        <?php
                                        echo '<option selected value=' . $prod->idfamille . '>' . $prod->designation . '</option>';
                                        foreach ($familles as $f) :
                                            echo '<option value=' . $f->idfamille . '>' . ucfirst($f->designation) . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <label class="control-label">Sous-Famille</label>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select class="form-control" id="s_famille_id" name="s_famille_id" required>
                                        <?php
                                        echo '<option value=' . $prod->id_s_fam . '>' . $prod->des . '</option>';
                                        foreach ($s_familles as $f) :
                                            echo '<option value=' . $f->id_s_fam . '>' . ucfirst($f->des) . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <label class="control-label">Désignation</label>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="<?php echo $prod->produit; ?>" id="libelle" name="libelle">
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <label class="control-label">Code</label>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="code_ex" value="<?php echo $prod->code; ?>" type="hidden">
                                    <input class="form-control col-md-7 col-xs-12" id="code" name="code" value="<?php echo $prod->code; ?>">
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group hidden">
                                <label>Unité</label>
                                <select class="form-control" id="unite" name="unite">
                                    <?php echo '<option value=' . $prod->unite . '>' . $prod->unite . '</option>'; ?>
                                    <option value="piece">Pièce</option>
                                    <option value="kg">Kilogramme</option>
                                    <option value="l">Litre</option>
                                    <option value="cl">Centilitre</option>
                                    <option value="g">Gramme</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group hidden">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Prix de vente</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                        <input class="form-control" value="<?php echo $prod->pv; ?>" name="prix_vente" id="prix_vente" value="0">
                                        <input class="form-control" name="enreg" id="enreg" type="hidden" value="1">
                                        <span class="input-group-addon"> <?php echo $prod->monnaie; ?></span>
                                    </div>
                                </div>
                            </div>
                            <label class="control-label">Prix de vente</label>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <?php
                                        $i = 1;
                                        foreach ($depot as $dep) {
                                            if ($dep->id_sousresto == $_SESSION['id_sousresto']) {
                                        ?>
                                                <input class="form-control prix_vente_site" name="prix_vente_site[]" value="<?php echo arrondir($pv) ?>">
                                                <input class="form-control hidden" name="sousresto_id[]" id="sousresto_id" value="<?php echo $dep->id_sousresto ?>">
                                                <input class="form-control hidden" name="prix_id[]" id="prix_id" value="<?php echo $id_prix ?>">
                                                <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <label class="control-label">Image</label>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-primary btn-file">
                                                Parcourir <input id="imgInp" type="file" name="image">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" id="fichier" readonly2 value="<?php echo $prod->path_image; ?>">

                                    </div>
                                    <br>
                                    <img id='img-upload' width="100" height="100" src="Traitement/<?php echo $prod->path_image; ?>" />
                                </div>
                            </div>
                            <label class="control-label">Vendre en cas de rupture en stock</label>
                            <div class=" form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <select class="form-control" id="vendrerupturestk" name="vendrerupturestk" required>
                                        <?php
                                        if ($prod->vendrerupturestk == 0) {
                                        ?>
                                            <option value="0">Oui</option>
                                            <option value="1">Non</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="1">Non</option>
                                            <option value="0">Oui</option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a>
                                        OFFRE
                                    </a>
                                </h4>
                            </div>
                            <div class="col-md-12">
                                <?php if ($prod->accomp == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="accompagnement" type="checkbox" value="1" checked>Accompagnement</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="accompagnement" type="checkbox" value="0"> Accompagnement</label>
                                <?php } ?>
                                <?php if ($prod->legume == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="legume" type="checkbox" value="1" checked> Legume</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="legume" type="checkbox" value="1"> Legume</label>
                                <?php } ?>
                                <?php if ($prod->soce == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="sauce" type="checkbox" value="1" checked>Sauce</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="sauce" type="checkbox" value="1">Sauce</label>
                                <?php } ?>
                                <?php if ($prod->cuisso == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="cuisson" type="checkbox" value="1" checked>Cuisson</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="cuisson" type="checkbox" value="1">Cuisson</label>
                                <?php } ?>
                                <?php if ($prod->cuisso == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="cuisson" type="checkbox" value="1" checked>Cuisson</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="cuisson" type="checkbox" value="1">Cuisson</label>
                                <?php } ?>
                                <?php if ($prod->cond == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="cond" type="checkbox" value="1" checked>Conditionnement</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="cond" type="checkbox" value="1">Conditionnement</label>
                                <?php } ?>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <?php if ($prod->softplt == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="softplast" type="checkbox" value="1" checked>Soft bouteille</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="softplast" type="checkbox" value="1">Soft bouteille</label>
                                <?php } ?>
                                <?php if ($prod->biere == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="biere" type="checkbox" value="1" checked>Soft plastique</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="biere" type="checkbox" value="1">Soft plastique</label>
                                <?php } ?>
                                <?php if ($prod->softbtl == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="softbtl" type="checkbox" value="1" checked>Biere</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="softbtl" type="checkbox" value="1">Biere</label>
                                <?php } ?>
                                <?php if ($prod->vin == 1) { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="vin" type="checkbox" value="1" checked>Vin maison</label>
                                <?php } else { ?>
                                    <label class="checkbox-inline" style=" font-size: 17px; "><input name="vin" type="checkbox" value="1">Vin maison</label>
                                <?php } ?>
                            </div>

                        </div>
                        <br> <br>
                        <div class="col-md-6">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a>
                                        FICHE TECHNIQUE
                                    </a>
                                    <a id="addFCH" class="btn btn-primary btn-sm" href="#" title="Ajouter" data-toggle="modal" data-target="#myModaladdFch">

                                        <i class="fa fa-plus-circle"></i> Produit
                                    </a>
                                </h4>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content" id="bloc_actions">
                                <br>
                                <div class="tab-pane active" id="tabFCH">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>PRODUIT</th>
                                                            <th>QTE</th>
                                                            <th>UNITE</th>
                                                            <th>CR (USD)</th>
                                                            <th>
                                                                <div class="tools text-center">
                                                                    <a href="#" title="Selectionner & Supprimer" id="btn_supp" class="text-danger"><i class="fa fa-trash-o"></i></a>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="fiche_technique">
                                                        <?php
                                                        $j = 1;
                                                        $tot = 0;
                                                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                                            $prix = $_SESSION['fiche']['prix'][$i];
                                                            $qte = $_SESSION['fiche']['qte'][$i];
                                                            $prixqte = $prix * $qte;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $j ?></td>
                                                                <td><?php echo $_SESSION['fiche']['name'][$i] ?></td>
                                                                <td>
                                                                    <input size="10" type="text" value="<?php echo $qte ?>" class="qte_prod" id="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>">
                                                                </td>
                                                                <td><?php echo $_SESSION['fiche']['utite'][$i] ?></td>
                                                                <td><?php echo $prixqte ?></td>
                                                                <td align="center">
                                                                    <input name="ch_ingred" class='ch_ingred' type='checkbox' id="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>" value="<?php echo $_SESSION['fiche']['ingred_id'][$i] ?>" />
                                                                </td>

                                                            </tr>
                                                        <?php
                                                            $tot += $prixqte;
                                                            $j++;
                                                        }; ?>
                                                        <tr>
                                                            <th style="text-align:center;" colspan="4">TOTAL</th>
                                                            <th><input name="paplat" type="hidden" value="<?php echo $tot?>" /><?php echo $tot ?></th>
                                                            <th></th>
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
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer">
                    <div class="col-md-9">
                        <div id="msg" class="alert alert-warning alert-dismissable" style=" text-align: center; display: none">
                            <i class='fa fa-warning fa-fw'></i> <span id="msg_alert"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success pull-right" id="update_produit" name="update_produit">
                            <i class=" fa fa-edit"></i> Modifier
                        </button>
                        <span class="btn btn-info hidden pull-right" id="loader">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                        </span>
                    </div>
                </div>


            </form>
            <!-- /.box-footer -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->




<!-- Modal -->
<div class="modal fade" id="myModaladdFch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Fiche technique | Ajout produit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Ingrédients</label>
                    <select class="form-control" id="ingred_id" name="ingred_id" required>
                        <option> </option>
                        <?php
                        include('./Traitement/ingredients_combo.php');
                        foreach ($ingredients as $ing) :
                            echo '<option pa=' . $ing->pa . ' value=' . $ing->idprod . '>' . ucfirst($ing->designation) . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Unité</label>
                    <select class="form-control" id="unite_ingred" name="unite_ingred">

                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Quantité</label>
                    <input type='text' class="form-control col-md-7 col-xs-12" id="qte_ingred" name="qte_ingred" value="1">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Prix</label>
                    <div class="form-group input-group">
                        <input class="form-control" name="prix_ingred" id="prix_ingred" value="" disabled="disabled">
                        <span class="input-group-addon"> <?php echo $m_insert; ?></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-right" id="add_ingred"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
                </button>
                <span class="btn btn-info hidden pull-right" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="myModaladdACC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajout accompagnement</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Produits</label>
                    <select class="form-control" id="accomp_id" name="accomp_id" required>
                        <option> </option>
                        <?php
                        include('./Traitement/ingredients_combo.php');
                        foreach ($ingredients  as $ing) :
                            echo '<option value=' . $ing->idprod . '>' . ucfirst($ing->designation) . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Unité</label>
                    <select class="form-control" id="unite_accomp" name="unite_accomp">

                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Quantité</label>
                    <input type='text' class="form-control col-md-7 col-xs-12" id="qte_accomp" name="qte_accomp">
                </div>
                <!-- /.form-group -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-right" id="btn_accomp"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
                </button>
                <span class="btn btn-info hidden pull-right" id="loader">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>