
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Administration </h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Détails souscription </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                     <?php include('./contenu_details_souscription.php'); ?> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modals -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Réglement facture</h4>
            </div>
            <div class="modal-body">
                <br />
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left formulaire" method="POST" action="../traitement/enreg_confirmation_souscription.php">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="client">Client <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="client" value="<?php echo $nom_hotel ?>" required class="form-control col-md-7 col-xs-12" disabled="disabled">
                            <input type="hidden" id="company_id"  name="id" value="<?php echo $id_c ?>">
                            <input type="hidden" id="hotel_id"  name="hotel_id" value="<?php echo $id_hotel ?>">
                            <input type="hidden"  name="mont_tot" value="<?php echo $totalapayer ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="montant_paye">Montant payé <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text"  name="montant_paye" value="<?php echo $totalapayer ?>" required class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="mode" class="control-label col-md-3 col-sm-3 col-xs-12">Mode de paiement</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="heard" name="mode_rglmt" class="form-control" required>
                                <option value=""></option>
                                <?php include '../../REC/Amelioration/reglage/recuperer_modereglement.php';?>
                                 <?php foreach($resultats as $o):?>
                                     <option value="<?php echo $o->id_mode_regl ?>"><?php echo $o->lib ?></option>
                                 <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success btnValider"><i class="fa fa-save"></i> Enregistrer</button>
                            <button type="submit" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!--traitement -->
<script>
    $(document).ready(function () {
       $('.btnValider').click(function (e) {   
            e.preventDefault();
            var bool =false;
            var duree=4000;
            var donnees = $('.formulaire').serialize();
            var url = $('.formulaire').attr('action');
            var method = $('.formulaire').attr('method');
            var company_id= $('#company_id').val();
            var hotel_id= $('#hotel_id').val();
            $.ajax({
                url: url,
                async: true,
                type: method,
                data: donnees,
                beforeSend: function () {
//                    $('#loader').addClass('loader').show();
                },
                success: function (data) {
                    $('.x_content').load( './contenu_details_souscription.php?isajax=oui&id='+hotel_id);
                    $(".bs-example-modal-lg").modal('hide');
                    bool =true;
                 },
                error: function (resultat, statut, erreur) {
                    alert(erreur);
                },
                complete: function () {
                    if (bool) {
                         $('#loader').addClass('loader').hide();
                    }else{
                         $('#loader').addClass('loader').show();
                    }
                }
            }); 
                     
    });
   });
</script>
<!-- /Traitement -->