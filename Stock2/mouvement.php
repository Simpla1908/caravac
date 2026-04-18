<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <?php
    include('head.php');
    include '../FUNCTION/stock.php';
    //Fusion horaire
    date_default_timezone_set('Africa/Kinshasa');
    $depot=ListPOS($_SESSION['id_hotel'],$bdd);
    $nbr = count($depot);
    if ($nbr == 0) {
        $vue=0;
        $visible = 0;
    } else {
        $vue=1;
        $visible = 1;
        $_SESSION['depot'] = $depot;
    }
    $motifs=ListMotifSortie($bdd);
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
                    <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png"/></a>
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
                        <h3 class="page-header">Sortie</h3>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div id="affichage_before_impression">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="<?php if($vue==1){echo 'active';}?>"><a href="#home" do2="sortie" sortie="#simple" data-toggle="tab" class="sortie">SORTIE</a></li>
                                    <!-- <li class="<?php //if($vue==0){echo 'active';}?>">
                                    <a href="#profile"  do2="transfert" sortie="#transfert" data-toggle="tab" class="sortie">TRANSFERT</a>
                                    </li> -->
                                    <a class="btn btn-default btn-sm pull-right" href="approvisionnement_view.php?operation=sortie" class="btn btn-default" title="Vue Liste">
                                       <i class="fa fa-bars"></i> Liste
                                    </a>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    
                                    <div class="tab-pane fade <?php if($vue==1){echo 'in active';}?>" id="home">
                                        <br>
                                        <form  id="simple" method="post" action="#" class="form-horizontal form-label-left frm_stk_simple" novalidate>
                                            <input  type="hidden"  name="do2" value="sortie" class="do2">
                                            <input  type="hidden"  name="sortie" value="#simple" class="type_sortie">
                                            <input  type="hidden"  name="affichage" value="#lignesmvmt2">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="msg_grp" class="alert alert-danger alert-dismissable msg_grp" style="display:none;">
                                                        <span id="msg_alert_grp" class="msg_alert_grp">L'enrégistrement s'est effectué avec succès!</span>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <button id="save_mouvement1111" name="save_mouvement" type="submit" class="btn btn-danger btn-sm btn_enreg_sortie"><i class="fa fa-save"></i> Enregistrer</button>
                                                            <button class="btn btn-sm btn-danger hidden loader">
                                                                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                                                            </button>
                                                        </div>
                                                        <!-- /.panel-heading -->
                                                        <div class="panel-body">
                                                            <br>
                                                            <input value="<?php echo $_SESSION['id_hotel'];?>" class="form-control col-md-7 col-xs-12 hidden" id="hotel_id" name="hotel_id"  type="text">
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pos_id">Emplacement<span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select class="form-control col-md-7 col-xs-12" id="emplacement_id" name="emplacement_id" required >
                                                                        <?php
                                                                        //Point de vente
                                                                        foreach ($depot as $p){
                                                                            ?>
                                                                            <option etat="<?php echo $p->etat?>" value='<?php echo $p->depot_id ?>' posname="<?php echo ucfirst($p->libelle)?>"><?php echo ucfirst($p->libelle) ?> </option>;
                                                                        <?php }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="benef">Bénéficiaire <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input class="form-control col-md-7 col-xs-12 modif" id="benef" name="benef"  type="text" required="required">
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Date">Date <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input class="form-control col-md-7 col-xs-12" disabled="disabled" value="<?php echo date('d/m/Y') ?>" required  type="text">
                                                                </div>
                                                            </div>
                                                            <input class="form-control col-md-7 col-xs-12" id="datebonentre" name="date_heure_bon" value="<?php echo date('d/m/Y H:i:s') ?>" required  type="hidden">
                                                            <br><br>
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs">
                                                                <li class="active"><a href="#profile" data-toggle="tab">Liste des produits</a>
                                                                </li>
                                                                <a class="btn btn-primary btn-sm pull-right" href="#" title="Ajouter" data-toggle="modal" data-target="#modalsortie">
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
                                                                                        <th>Produit</th>
                                                                                        <th>Quantité</th>
                                                                                        <th>Unité</th>
                                                                                        <th>Motif</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="lignesmvmt2">
                                                                                    <tr class="odd gradeX" id="">
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td><a href="#" title="Supprimer" id="btn_supp" class="text-danger"><i class="fa fa-trash-o"></i></a></td>
                                                                                    </tr>
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

                                    <div class="tab-pane fade <?php if($vue==0){echo 'in active';}?>" id="profile">
                                        <br>
                                        <form  id="transfert" method="post" action="#" class="form-horizontal form-label-left frm_stk_transfert" novalidate>
                                            <input  type="hidden"  name="do2" value="transfert" class="do2">
                                            <input  type="hidden"  name="sortie" value="#transfert" class="type_sortie">
                                            <input  type="hidden"  name="affichage" value="#lignesmvmt">
                                            <input  type="hidden"  name="posname" value="POS" id="posname">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="msg_grp2" class="alert alert-danger alert-dismissable msg_grp2" style="display:none;">
                                                        <span id="msg_alert_grp2" class="msg_alert_grp2">L'enrégistrement s'est effectué avec succès!</span>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <button  name="save_mouvement1" type="submit" class="btn btn-danger btn-sm btn_enreg_sortie2"><i class="fa fa-save"></i> Enregistrer</button>
                                                            <span class="btn btn-danger hidden loader2" >
                                                                <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours
                                                            </span>
                                                        </div>
                                                        <!-- /.panel-heading -->
                                                        <div class="panel-body">
                                                            <br>
                                                            <input value="<?php echo $_SESSION['id_hotel'];?>" class="form-control col-md-7 col-xs-12 hidden" id="hotel_id" name="hotel_id"  type="text">
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pos_id">Source<span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select class="form-control col-md-7 col-xs-12" id="source_id" name="source_id" required >
                                                                        <option value=""> </option>
                                                                        <?php
                                                                        //Point de vente
                                                                        foreach ($depot as $p){
                                                                           ?>
                                                                            <option value='<?php echo $p->depot_id ?>' posname="<?php echo ucfirst($p->libelle)?>"><?php echo ucfirst($p->libelle) ?> </option>;
                                                                        <?php }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pos_id">Destination <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select class="form-control col-md-7 col-xs-12" id="pos_id" name="pos_id" required >
                                                                        <option value=""> </option>
                                                                        <?php
                                                                        //Point de vente
                                                                        foreach ($depot as $p){
                                                                            ?>
                                                                            <option value='<?php echo $p->depot_id ?>' posname="<?php echo ucfirst($p->libelle)?>"><?php echo ucfirst($p->libelle) ?> </option>;
                                                                        <?php }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Date">Date <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input class="form-control col-md-7 col-xs-12" disabled="disabled" value="<?php echo date('d/m/Y') ?>" required  type="text">
                                                                </div>
                                                            </div>
                                                            <input class="form-control col-md-7 col-xs-12" id="datebonentre" name="date_heure_bon" value="<?php echo date('d/m/Y') ?>" required  type="hidden">
                                                            <br><br>
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-tabs">
                                                                <!-- <li class="active"><a href="#profile" data-toggle="tab">Fiche de transfert</a>
                                                                </li> -->
                                                                <a class="btn btn-primary btn-sm pull-right" href="#" title="Ajouter" data-toggle="modal" data-target="#modaltransfert">
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
                                                                                        <th>Produit</th>
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
                                                                                        <td><a href="#" title="Supprimer" id="btn_supp" class="text-danger"><i class="fa fa-trash-o"></i></a></td>
                                                                                    </tr>
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
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.col-lg-12 -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.affichage -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        
        <!-- Modal sortie-->
        <div class="modal fade" id="modalsortie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <!-- /.modal-dialog -->
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
                                            $s_familles = $requete-> fetchAll(PDO::FETCH_OBJ);

                                            foreach ($s_familles  as $f):
                                                echo '<option value=' . $f->idfamille.'>' . ucfirst($f->designation).'</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Produit</label>
                                        <select class="form-control select2 article" style="width: 100%;" id="article" name="prod_id" required>
                                            <option>  </option>
                                            <?php
                                            include("./Traitement/produit_combo.php");
                                            foreach ($produits as $p) {
                                                ?>
                                                <option value='<?php echo $p->idprod; ?>'prod_nom="<?php echo $p->designation; ?>" unite="<?php echo $p->unite; ?>"><?php echo ucfirst($p->designation); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- /.form-group -->
                                    <div class="form-group" id="quantite_transf444">
                                        <label>Quantité</label>
                                        <input type="text" min="1" class="form-control col-md-7 col-xs-12" id="qte" name="qte" value="<?php echo 1; ?>">
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Unité</label>
                                        <input type="hidden" name="unite"  class="unite">
                                        <input type="hidden" name="prod_nom" id="prod_nom"  class="prod_nom">
                                        <input type="text" class="form-control col-md-7 col-xs-12 unite"   disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label>Motif</label>
                                        <select class="form-control select2 motif_sortie" style="width: 100%;" id="motif_sortie_id" name="motif_sortie_id" required>
                                           <option>  </option>
                                           <?php
                                            foreach ($motifs as $p) {
                                                if($p->id_motif_sortie!=6 && $p->id_motif_sortie!=7){
                                                ?>
                                                <option value='<?php echo $p->id_motif_sortie; ?>'prod_nom="<?php echo $p->libelle ; ?>" ><?php echo ucfirst($p->libelle); ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="motif_sortie_lib"  class="motif_sortie_lib">
                                     <input type="hidden" name="operation"  value="sortie">
                                     <input type="hidden" name="affichage"  value="#lignesmvmt2">
                                     <input type="hidden" name="empl_id" id="empl_id" value="0">
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer align-center">
                        <div id="msg" class="text-danger text-left col-md-10" style="display:none;">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                            <span id="msgtext">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                        </div>
                        <button  class="btn btn-danger" id="btn_add_prod_panier">
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
        
        <!-- Modal TRANSFERT-->
        <div class="modal fade" id="modaltransfert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lgm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ajouter</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="frmaddprodstk2"> 
                                <div class="form-group">
                                        <label>Famille</label>
                                        <select class="form-control" style="width: 100%;" id="searchfam_id2" name="searchfam_id2" required>
                                            <option value="0">Tout</option>
                                            <?php
                                            $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                                                . " WHERE f.hotel_id=:hotel_id AND f.plat=0 ORDER BY designation");
                                            //session à enlever
                                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                                            $requete->execute();
                                            $s_familles = $requete-> fetchAll(PDO::FETCH_OBJ);

                                            foreach ($s_familles  as $f):
                                                echo '<option value=' . $f->idfamille.'>' . ucfirst($f->designation).'</option>';
                                            endforeach;
                                            ?>
                                        </select>
                                </div>
                                    
                                    <div class="form-group">
                                        <label>Produit</label>
                                        <select class="form-control select2 article2" style="width: 100%;" id="article2" name="prod_id" required>
                                            <option>  </option>
                                            <?php
                                            include("./Traitement/produit_combo.php");
                                            foreach ($produits as $p) {
                                                ?>
                                                <option value='<?php echo $p->idprod; ?>'prod_nom="<?php echo $p->designation; ?>" unite="<?php echo $p->unite; ?>"><?php echo ucfirst($p->designation); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- /.form-group -->
                                    <div class="form-group" id="quantite_transf444">
                                        <label>Quantité</label>
                                        <input type="text" min="1" class="form-control col-md-7 col-xs-12" id="qte" name="qte" value="<?php echo 1; ?>">
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Unité</label>
                                        <input type="hidden" name="unite"  class="unite2">
                                        <input type="hidden" name="prod_nom" id="prod_nom"  class="prod_nom2">
                                        <input type="text" class="form-control col-md-7 col-xs-12 unite2"   disabled="">
                                    </div>
                                    <div class="form-group hidden">
                                        <label>Motif</label>
                                        <select class="form-control select2 motif_sortie" style="width: 100%;" id="motif_sortie_id" name="motif_sortie_id" required>
                                           <?php
                                            foreach ($motifs as $p) {
                                                if($p->id_motif_sortie==6){
                                                ?>
                                                <option value='<?php echo $p->id_motif_sortie; ?>'prod_nom="<?php echo $p->libelle ; ?>" ><?php echo ucfirst($p->libelle); ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="motif_sortie_lib"  class="motif_sortie_lib" value="sortie">
                                    <input type="hidden" name="operation"  value="transfert">
                                    <input type="hidden" name="affichage"  value="#lignesmvmt">
                                    <input type="hidden" name="empl_id" value="0" id='source1'>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer align-center">
                        <div id="msg2" class="text-danger text-left col-md-10" style="display:none;">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                            <span id="msgtext2">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                        </div>
                        <button  class="btn btn-danger" id="btn_add_prod_panier2">
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
