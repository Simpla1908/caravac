
<?php
/*
 * =======================================================================
 * FILE NAME:        Update.php
 * DATE CREATED:  	09-07-2018
 * FOR TABLE:  		ach_livraison
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

?>


<form action="<?php echo H_ADMIN_MAIN . '&view=ach_livraison&do=updatepro'; ?>" method="post" name="hezecomform" class="form-horizontal" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=details" title="View Details" class="btn btn-default btn-sm tip"><i class="fa fa-th-list"></i> <?php echo LANG_DETAILS; ?></a>

            <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=delete&dfile=" title="<?php echo LANG_TIP_DELETE; ?>" class="btn btn-default btn-sm tip" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"><i class="fa fa-trash-o"></i> <?php echo LANG_DELETE; ?></a>

            <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&do=viewall" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE; ?> Livraison</h3></div>
            <div class="panel-body">

                <div class="output"></div>
                
                <div class="row">
                    <div class="col-md-10">
                        <br>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Founisseur</label>

                            <div class="col-sm-8">
                                <select class="form-control choz" id="liv_founisseur_id" name="liv_founisseur_id" style="width: 100%;">
                                    <option>Selectionnez</option>
                                    <?php
                                    foreach ($fournisseurs as $f) {
                                        if($rows->fournisseur_id==$f->id_client){
                                        ?>
                                        <option selected="selected" value="<?php echo $f->id_client; ?>"><?php echo $f->nom_entreprise; ?></option>
                                    <?php }else{ ?>
                                        <!--<option value="<?php echo $f->id_client; ?>"><?php echo $f->nom_entreprise; ?></option>-->
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div id="boncommande_bloc">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Bon commande</label>

                            <div class="col-sm-8" id="boncommande_bloc2">
                                <select class="form-control choz" id="boncommande_id" name="boncommande_id">
                                    <option>Selectionnez</option>
                                    <?php
                                    foreach ($bons as $b) {
                                         if($rows->bcommande_id==$b->id_fact){
                                        ?>
                                        <option selected="selected" value="<?php echo $b->id_fact; ?>"><?php echo $b->num_cmd; ?></option>
                                    <?php }else{ ?>
                                        <!--<option value="<?php echo $b->id_fact; ?>"><?php echo $b->num_cmd; ?></option>-->
                                    <?php }} ?>
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <br><br>
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Les produits commandés</a></li>
                            </ul>
                            <div class="tab-content no-border" id="produits_bloc">
                                <div class="tab-pane active" id="tab_1">
                                    <br>
                                    <div class="table-responsive">
                                        <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Produits</th>
                                                    <th>Quantité à livrer</th>
                                                    <th>Quantité livrée</th>
                                                    <th>Observation</th>
                                                </tr>
                                            </thead>
                                            <tbody id="liv_produit">
                                                <?php 
                                                if ($nbArticles!=-1) {
                                                $j=1;
                                                $total=0;
                                                for ($i = 0; $i <= $nbArticles - 1; $i++) {
//                                                    if($_SESSION['livraison']['commande_id'][$i]==$boncommande_id){
                                                ?>
                                                <tr>
                                                    <td><?php echo $j; ?></td>
                                                    <td><?php echo ucfirst($_SESSION['livraison']['designation'][$i]); ?></td>
                                                    <td><?php echo $_SESSION['livraison']['qte_attendue'][$i]; ?></td>
                                                    <td>
                                                        <input type="text" value="<?php echo $_SESSION['livraison']['qte_recue'][$i] ?>" class="qte" id="<?php echo $_SESSION['livraison']['produit_id'][$i] ?>">
                                                    </td>
                                                    <td>
                                                        <input  class="form-control observation" id="<?php echo $_SESSION['livraison']['produit_id'][$i] ?>" value="<?php echo $_SESSION['livraison']['observation'][$i] ?>">
                                                    </td>
                                                </tr>
                                                <?php 
                                                $j++;
//                                                } 
                                                }
                                                }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                </div>

                <input type="hidden" name="id_liv" value="<?php echo $rows->id_liv; ?>">
                <div class="form-group hidden">
                    <label class="control-label" for="numBon_liv">NumBon Liv</label>
                    <input id="numBon_liv" name="numBon_liv" type="text" maxlength="20"  value="<?php echo $rows->numBon_liv; ?>" class="form-control styler" />
                </div>

                <div class="form-group hidden">
                    <label class="control-label" for="numBon_cmd">NumBon Cmd</label>
                    <input id="numBon_cmd" name="numBon_cmd" type="text" maxlength="20"  value="<?php echo $rows->numBon_cmd; ?>" class="form-control styler" />
                </div>

                <div class="form-group hidden">
                    <label class="control-label" for="bcommande_id">Bcommande Id</label>
                    <input id="bcommande_id" name="bcommande_id" type="text" maxlength="11"  value="<?php echo $rows->bcommande_id; ?>" class="form-control styler" />
                </div>

                <div class="form-group hidden">
                    <label class="control-label" for="fournisseur_id">Fournisseur Id</label>
                    <input id="fournisseur_id" name="fournisseur_id" type="text" maxlength="11"  value="<?php echo $rows->fournisseur_id; ?>" class="form-control styler" />
                </div>

                <div class="form-group hidden">
                    <label class="control-label" for="user_id">User Id</label>
                    <input id="user_id" name="user_id" type="text" maxlength="11"  value="<?php echo $rows->user_id; ?>" class="form-control styler" />
                </div>

                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-edit"></i> <?php echo LANG_UPDATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_UPDATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
