<?php ?>

<div class="col-md-8" id="block_fam_sous_prod_affichage">

                                            <div class="box panel panel-default">
                                                <ol class="breadcrumb">
                                                    <li><a href="#" class="home"><span class="step size-64"><i class="icon ion-android-home"></i></span></a></li>
                                                </ol>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <?php
                                                            include('Traitement/fam_prod_s_fam_view.php');
                                                            foreach ($familles as $fam):
                                                                ?>

                                                                <a href="#" class="btn btn-squared-default btn-default fam" id="<?php echo $fam->idfamille; ?>"><br/>
                                                                    <i class="fa fa-barcode fa-3x"></i><br/><br/>
                                                                    <span class="badge bg-aqua"><?php echo $fam->designation; ?></span>
                                                                </a>
                                                                <?php
                                                                foreach ($s_familles as $s_fam):
                                                                    if ($fam->idfamille == $s_fam->famille) {
                                                                        ?>
                                                                        <a href="#" class="btn btn-squared-default btn-default <?php echo $fam->idfamille; ?> s_fam" style="display:none" id="<?php echo "s" . $s_fam->id_s_fam; ?>"><br/>
                                                                            <i class="fa fa-barcode fa-3x"></i><br/><br/>
                                                                            <span class="badge bg-aqua"><?php echo $s_fam->des; ?></span>
                                                                        </a>

                                                                    <?php }endforeach; ?>  
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->

                                            <div class="panel panel-default box" style="overflow: auto; height: 350px;">
                                                <div class="box-body">
                                                    <div class="row" >
                                                        <div class="col-lg-12" id="produit">
                                                            <?php
                                                            foreach ($s_familles as $s_fam):
                                                                ?>
                                                                <?php
                                                                foreach ($produits as $prod):
                                                                    $quantite_reste = quantite_ki_reste($prod->idprod);
//                                                                    if ($quantite_reste>$prod->qte_min) {  
                                                                    if ($s_fam->id_s_fam == $prod->famille_id) {
                                                                        ?>
                                                                        <a class="btn btn-app <?php echo "s" . $s_fam->id_s_fam; ?> prod" id="<?php echo $prod->idprod; ?>" id2="<?php echo $prod->repas; ?>">
                                                                            <span class="badge bg-purple"><?php echo $prod->pv; ?> FC </span>
                                                                            <i class="fa fa-barcode"></i>
                                                                            <?php echo $prod->designation; ?>
                                                                            <span class="badge bg-purple" id="<?php echo $prod->idprod; ?>" style="display: none;"><?php echo $prod->pv; ?></span><br>
                                                                            <p id="<?php echo $prod->idprod; ?>"  style="display: none;"><?php echo $prod->designation; ?></p>
                                                                        </a>

                                                                    <?php } endforeach; ?>  
                                                            <?php endforeach; ?>


                                                            <!-- /.col -->
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
