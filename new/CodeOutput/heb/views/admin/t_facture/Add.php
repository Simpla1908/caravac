
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>



<div class="col-12">

    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="callout callout-success hidden" style="margin-bottom:0!important;" id="div_notification_fact">
                        <h4><i class="fa fa-info"></i> Note:</h4>
                        <span id="sp_notification_fact"></span>
                    </div>
                    <!-- form start -->
                    <form class="form-horizontal" action="<?php echo H_ADMIN_MAIN . '&view=t_facture&do=enregfact'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row pad-top-botm ">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <!--<img src="dist/img/logo ERH.jpg" style="padding-bottom:20px;" />--> 
                                    <img src="public/uploads/<?php echo $site->logo; ?>" height="100" width="100"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 ">
                                    <br /><br /><br />
                                    <strong>Email : </strong><?php echo $site->mail; ?>
                                    <br />
                                    <strong>Tél :</strong><?php echo $site->phone; ?><br />
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <br /><br /><br />
                                    <strong><?php echo $site->nomcomp; ?> </strong>
                                    <br />
                                    <?php echo $site->adrcomp; ?>

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
                                    <h4>  <strong>Information client <a href="#" title="Selectionner client" data-toggle="modal" data-target="#modalclient"><span class="fa fa-caret-down"></span></a></strong></h4>
                                    <strong> <span id='nomcl'>xxxxxxxxxxxxxxx</span> </strong>
                                    <div class='nomsct hidden'>
                                        <b>Socièté :</b> <span id='nomsct'>xxxxxxxxxxxxxxx</span> 
                                    </div>
                                    <br id='bck_esp' class='' />
                                    <b>Tél :</b><span id='telcl'>xxxxxxxxxxxxxxx</span>
                                    <br />
                                    <b>E-mail :</b><span id='emailcl'>ddddddd@xxxxxxxxxxxxx.com</span> 
                                    <br />
                                    <b>Adresse :</b><span id='adrcl'>xxxxxxxxxxxxxxx</span>,

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <h4>  <strong>Détails facture <?php echo $typefact; ?></strong></h4>
                                    <b>FACTURE N°<?php echo $numfact; ?> </b>
                                    <br />
                                    Date d'édition: <span id='dte_edtsp'><?php echo date('d/m/Y'); ?></span><a href="#" title="Selectionner client" data-toggle="modal" data-target="#modaldteedition"><span class="fa fa-caret-down"></span></a>
                                    <br />
                                    Condition de règlement: <span id='condpaiesp'></span><a href="#" title="Condition de paiement" data-toggle="modal" data-target="#modalcondpaiement"><span class="fa fa-caret-down"></span></a>
                                    <br />
                                    Date d'échéance : <span id='dte_echsp'><?php echo date('d/m/Y'); ?></span>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <a href="#" title="Ajouter" data-toggle="modal" data-target="#modaldepot" class="btn btn-danger btn-xs" id="btnaddarticle"><i class="fa fa-plus-circle"></i> Article ou service</a>
                                    <a href="#" title="Exonérer la TVA" class="btn btn-primary btn-xs" id="btnexoneretva">Exonérer TVA</a>
                                    <a href="#" title="Appliquer la TVA" class="btn btn-primary btn-xs hidden" id="btnappliktva">Appliquer TVA</a>
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="lignefact">
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
                                    <strong><spant id="spht"></span></strong>
                                </div>
                                <hr />
                                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                    Total T.V.A: 
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <strong><spant id="sptva"></span> </strong>
                                </div>
                                <br />
                                <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                    Total T.T.C : 
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <strong><spant id="spttc"></span> </strong>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <strong>Instructions importantes:
                                    </strong>
                                    <?php echo $site->infofact; ?>
                                </div>
                            </div>
                            <br /><br />
                            <br />
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <p class="text-center">
                                <b>ID.Nat.</b>: <?php echo $site->idnat; ?> <b>RCCM.</b>: <?php echo $site->rccm; ?><br />
                                <!--<b>Adresse</b>: 27,Mbekani Q.Révolution C.Kisenso<br />-->
                                <!--<b>Email</b>: simplicelandu1908@gmail.com <b>Tél.</b>.: +243 823 903 252-->
                            </p>
                        </div>
                        <!-- /.box-footer -->
                        <!-- Information client à sauvegarder-->
                        
                        <div class="hidden">
                            <input id="id_hotel" name="id_hotel" type="hidden" value="<?php echo $_SESSION['idsite']; ?>" class="form-control">
                            <input id="id_client" name="id_client" type="hidden" value="0" class="form-control">
                            <input id="nomsct" name="nomsct" type="text" value="" class="form-control">
                            <input id="nomclt" name="nomclt" type="text" value="" class="form-control">
                            <input id="tel" name="tel" type="text" value="" class="form-control">
                            <input id="eml" name="eml" type="text" value="" class="form-control">
                            <input id="adr" name="adr" type="text" value="" class="form-control"> 
                             <input id="typeclt" name="typeclt" type="text" value="client" class="form-control"> 
                            <input id="sexeclt" name="sexeclt" type="text" value="0" class="form-control"> 
                            <input id="dte_edit" name="dte_edit" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control">
                            <input id="dte_ech" name="dte_ech" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control">
                            <input id="ht" name="ht" type="text" value="0" class="form-control">
                            <input id="tva" name="tva" type="text" value="0" class="form-control">
                            <input id="ttc" name="ttc" type="text" value="0" class="form-control">
                            <input  id="htf" type="text" value="0" class="form-control">
                            <input  id="tvaf" type="text" value="0" class="form-control">
                            <input  id="ttcf" type="text" value="0" class="form-control">
                            <input  id="prefixefact" name="prefixefact" type="text" value="<?php echo $prefixefact; ?>" class="form-control">
                            <input id="numfact" name="numfact" type="text" value="<?php echo $numfact; ?>" class="form-control">
                            <textarea id="description"  class="form-control" name="description"><?php echo $site->infofact; ?></textarea>
                            <input id="etatfact" name="etatfact" type="text" value="<?php echo $etatfact; ?>" class="form-control">
                            
                        </div>
                         <input id="facture_id" name="facture_id" type="text" value="<?php echo 0; ?>" class="form-control">
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-2">
                <!--<div class="info-box">-->
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_enreg_fact"><i class="fa fa-save"></i> Enregistrer</button>
                <br>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_send_fact"><i class="fa fa-envelope"></i> Envoyer</button>
                <br>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_print_facturef" idf="0"><i class="fa fa-print"></i> Imprimer</button>

                <!--</div>-->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="modalclient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Client</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>
                                    <input type="radio" name="optionsRadios" class="typeclient" id="optionsRadios1" value="ancien" checked>
                                    Ancien
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <input type="radio" name="optionsRadios" class="typeclient" id="optionsRadios2" value="nouveau">
                                    Nouveau 
                                </label>
                            </div>
                        </div>
                        <div class="form-group ancien">
                            <label for="inputName" class="col-sm-2 control-label">Selectionner</label>
                            <div class="col-sm-10">
                                <select class="form-control choz" id="cmbclient">
                                    <option></option>
                                    <?php
                                    foreach ($clients as $cl) {
                                        $pers = 0;
                                        $nomcl = $cl->nom_client;
                                        if (!empty($cl->designation)) {
                                            $pers = 1;
                                        }
                                        ?>
                                        <?php if ($cl->pseudo_supp == 0) { ?>
                                            <option value='<?php echo $cl->id_client; ?>' 
                                                    societe='<?php echo $cl->designation; ?>'
                                                    nom ='<?php echo $cl->nom_client; ?>'
                                                    adresse ='<?php echo $cl->adresse_provenance_client; ?>'
                                                    email ='<?php echo $cl->email_client; ?>'
                                                    tel ='<?php echo $cl->telephone_client; ?>'
                                                    pers ='<?php echo $pers; ?>'
                                                    > <?php echo ucfirstText($nomcl); ?></option>;
                                                <?php } ?>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 hidden nouveau">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9">
                                    <select id="cmbtype_client" name="type"  class="form-control choz">
                                        <option value="particulier">Particulier</option>
                                        <option value="societe">Socièté</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group nomsociete hidden">
                                <label for="inputName" class="col-sm-3 control-label" id="nomsociete">Nom Socièté</label>

                                <div class="col-sm-9">
                                    <input id="designation" name="designation" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label" id="lblnomclient">Noms</label>

                                <div class="col-sm-9">
                                    <input id="nom_client" name="nom_client" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">Téléphone</label>
                                <div class="col-sm-9">
                                    <input id="telephone_client" name="telephone_client" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input  id="email_client" name="email_client" type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">Sexe</label>
                                <div class="col-sm-9">
                                    <select id="sexe_client" name="sexe_client"  class="form-control choz">
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-3 control-label">Adresse</label>
                                <div class="col-sm-9">
                                    <input  id="adresse_provenance_client" name="adresse_provenance_client" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <input  id="sorteclient" name="sorteclient" type="hidden" value="ancien" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button  class="btn btn-danger pull-right col-md-2"
                             id="btn_vld_mod_client"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<!-- Modal -->
<div class="modal fade" id="modaldepot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajouter article</h4>
            </div>
            <div class="modal-body">
                <div class="form-group hidden">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            <b>PRODUITS</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            <b>SERVICES</b>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Désignation</label>
                    <select class="form-control choz" id="produit_id" name="produit_id" required>
                        <?php
                        foreach ($articles as $p) {
                            $pv = montant_equivalent_bdd($p->monnaie, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $p->pv)
                            ?>
                            <option value='<?php echo $p->idprod; ?>'
                                    prix="<?php echo $pv; ?>"
                                    tva="<?php echo $p->tva; ?>" >
                                <?php echo ucfirstText($p->produit); ?></option>;
                        <?php } ?>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Quantité</label>
                    <input class="form-control col-md-7 col-xs-12" id="qte" name="qte" value="1">
                </div>
                <!-- /.form-group -->
            </div>
            <div class="modal-footer">
                <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                </div>
                <button  class="btn btn-danger pull-right col-md-2"
                         id="add_prod"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
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

<!-- Modal Date edition -->
<div class="modal fade" id="modaldteedition" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Changer date édition</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">

                        </div>
                        <div class="form-group ancien">
                            <label for="inputName" class="col-sm-3 control-label">Date édition</label>
                            <div class="col-sm-9">
                                <input id="dteedition" name="dteedition" type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control datepicker2">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button  class="btn btn-danger pull-right col-md-2"
                             id="btn_vld_dtEdition"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal condition de paiement -->
<div class="modal fade" id="modalcondpaiement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Condition de paiement</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">

                        </div>
                        <div class="form-group ancien">
                            <label for="inputName" class="col-sm-2 control-label">Selectionner</label>
                            <div class="col-sm-10">
                                <select class="form-control choz" id="slctcondpaie">
                                    <option></option>
                                    <?php foreach ($condpaiements as $cp) {
                                        ?>
                                        <option value='<?php echo $cp->id; ?>' nbrjr="<?php echo $cp->njrs; ?>"> <?php echo ucfirstText($cp->des); ?></option>;
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button  class="btn btn-danger pull-right col-md-2"
                             id="btn_vld_condpaie"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
                    </button>
                    <span class="btn btn-info hidden pull-right" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
