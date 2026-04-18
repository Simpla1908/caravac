
<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

?>

<div class="row">
    <div class="col-xs-12">
        <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="callout callout-success hidden" style="margin-bottom:0!important;" id="div_notification_fact">
                        <h4><i class="fa fa-info"></i> Note:</h4>
                        <span id="sp_notification_fact"></span>
                    </div>
                    <!-- form start -->
                    <!--<form class="form-horizontal" action="<?php echo H_ADMIN_MAIN . '&view=t_facture&do=enregfact'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">-->
                        <div class="box-body">
                            <div class="row pad-top-botm ">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <img src="public/uploads/<?php echo $logo; ?>" height="100" width="100"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 ">
                                    <br /><br /><br />
                                    <strong>Email : </strong><?php echo $mail; ?>
                                    <br />
                                    <strong>Tél :</strong><?php echo $phone; ?><br />
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <br /><br /><br />
                                    <strong><?php echo $nomcomp; ?> </strong>
                                    <br />
                                    <?php echo $adrcomp; ?>
                                </div>
                            </div>
                            <hr />
                            <div  class="row text-center contact-info hidden">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr />
                                    <span>
                                        <strong>Email : </strong>  info@yourdomain.com 
                                    </span>
                                    <span>
                                        <strong>Call : </strong>  +95 - 890- 789- 9087 
                                    </span>
                                    <span>
                                        <strong>Fax : </strong>  +012340-908- 890 
                                    </span>
                                    <hr />
                                </div>
                            </div>
                            <div  class="row pad-top-botm client-info">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <h4>  <strong>Information client</strong></h4>
                                    <strong> <span id='nomcl'><?php echo $nomcl; ?></span> </strong>
                                    <?php if(!empty($societe)){ ?>
                                    <div>
                                        <b>Socièté :</b> <span id='nomsct'><?php echo $societe; ?></span> 
                                    </div>
                                    <?php } ?>
                                    <br  />
                                    <b>Tél :</b><span id='telcl'><?php echo $tel; ?></span>
                                    <br />
                                    <b>E-mail :</b><span id='emailcl'><?php echo $emailcl; ?></span> 
                                    <br />
                                    <b>Adresse :</b><span id='adrcl'><?php echo $adr; ?></span>,

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <h4>  <strong>Détails facture <?php echo $typefact; ?></strong></h4>
                                    <b>FACTURE N°<?php echo $numfact; ?> </b>
                                    <br />
                                    Date d'édition: <span id='dte_edtsp'><?php echo $dte_edit; ?></span>
                                    <br />
                                    Date d'échéance : <span id='dte_echsp'><?php echo $dte_ech; ?></span>
                                </div>
                            </div>
                            <hr />
                            <div class="row hidden">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href="#" title="Ajouter" data-toggle="modal" data-target="#modaldepot" class="btn btn-danger btn-xs" id="btnaddarticle"><i class="fa fa-plus-circle"></i> Ajouter article ou service</a>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Désignation</th>
                                                    <th>Quantité</th>
                                                    <th>Prix Unitaire</th>
                                                     <th>TVA</th>
                                                    <th>Sous Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="lignefact">
                                                <?php include(APP_FOLDER . '/views/admin/t_facture/lignesfact2.php');?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                    Total H.T : 
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <strong><spant id="spht"><?php echo afficheMontant($_SESSION['Paie_affiche'],$ttc-$monttvax)?></span></strong>
                                </div>
                                <hr />
                                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                    Total T.V.A: 
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <strong><spant id="sptva"><?php echo afficheMontant($_SESSION['Paie_affiche'],$monttvax)?></span> </strong>
                                </div>
                                <br />
                                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                    Total T.T.C : 
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <strong><spant id="spttc"><?php echo afficheMontant($_SESSION['Paie_affiche'],$ttc)?></span> </strong>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <strong>Instructions importantes:
                                    </strong>
                                    <?php echo$justification; ?>
                                </div>
                            </div>
                            <br /><br />
                            <br />
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <p class="text-center">
                                <b>ID.Nat.</b>: <?php echo $idnat; ?> <b>RCCM.</b>: <?php echo $rccm; ?><br />
                                <!--<b>Adresse</b>: 27,Mbekani Q.Révolution C.Kisenso<br />-->
                                <!--<b>Email</b>: simplicelandu1908@gmail.com <b>Tél.</b>.: +243 823 903 252-->
                            </p>
                        </div>
                        <!-- /.box-footer -->
                    <!--</form>-->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-2">
                <!--<div class="info-box">-->
                <a href="<?php echo H_ADMIN; ?>&view=t_facture&do=viewall&f=<?php echo $etatfact; ?>" class="btn btn-primary btn-lg btn-block" id="btn_retour_fact"><i class="fa fa-mail-reply"></i> Retour</a>
                <br>
                <button type="button" class="btn btn-primary btn-lg btn-block"><i class="fa fa-envelope"></i> Envoyer</button>
                <br>
                <a href="#" idf="<?php echo $id_fact; ?>" class="btn btn-primary btn-lg btn-block"  id="btn_print_facturef"><i class="fa fa-print"></i> Imprimer</a>
                <!--</div>-->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    </div><!-- /.col -->
</div><!-- /.row -->
