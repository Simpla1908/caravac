<?php session_start(); ?>
<?php include('Gerant_local.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php include('../FUNCTION/checkpwd.php'); ?>
<?php include('../bdd/connexion.php'); ?>
<?php
if(isset($_GET['bd'])&&$_GET['bd']=='yes'){
//recuperation des données de la base et mise en session de ces dernieres
$company= $_SESSION['company_id'];
//recuperation données site
$requete = $bdd->prepare("SELECT * FROM t_hotel WHERE id_hotel=:id_hotel");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$site_tuples = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($site_tuples as $site) {
$id_hotel = $site->id_hotel;
$entreprise = $site->nom_hotel;
$adresse = $site->adresse_hotel;
$phone = $site->phone;
$rccm = $site->rccm;
$num_impot = $site->num_impot;
$cb = $site->cb;
$ville = $site->ville_hotel;
$mail = $site->mail;
$id_nat = $site->idnat;
$stocklogo = $site->image;                      
}

$_SESSION['entreprise']  =$entreprise ;
$_SESSION['adresse']  =$adresse ;
$_SESSION['phone']  = $phone;
$_SESSION['rccm']  = $rccm ;
$_SESSION['num_impot']  = $num_impot;
$_SESSION['ville']  = $ville;
$_SESSION['mail']  = $mail ;
$_SESSION['id_nat']  =$id_nat ;
$_SESSION['cb'] = $cb;
$_SESSION['stocklogo']  =$stocklogo;
$_SESSION['id_hotel']  =$id_hotel ;
}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Configuration</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <form method="post" action="Traitement/entreprise_traitement_maj.php" id="entreprise_form_maj" name="entreprise_form_maj" class="form-horizontal form-label-left" enctype="multipart/form-data">
         <input id="company_id" name="company_id" value="<?php echo  $_SESSION['company_id']; ?>" type="hidden">
          <input id="id_user" name="id_user" value="<?php echo  $_SESSION['id_user']; ?>" type="hidden">
           <input id="id_site" name="id_site" value="<?php echo  $_SESSION['id_hotel']; ?>" type="hidden">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="btn-group  btn-group-sm">
                            <b>Détails </b>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nom site</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['entreprise']; ?></span>
                                            <input id="nom_site" name="nom_site" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['entreprise']; ?>" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Adresse complète</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['adresse']; ?></span>
                                            <input id="adresse" name="adresse" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['adresse']; ?>" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ville</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['ville']; ?></span>
                                            <input id="ville" name="ville" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['ville']; ?>" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Télephone</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['phone']; ?></span>
                                            <input id="phone" name="phone" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['phone']; ?>" type="tel">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['mail']; ?></span>
                                            <input id="mail" name="mail" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['mail']; ?>" type="email">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>RCCM</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['rccm'];?></span>
                                            <input id="rccm" name="rccm" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['rccm'];?>" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Id. Nat.</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['id_nat'];?></span>
                                            <input id="id_nat" name="id_nat" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['id_nat'];?>" type="tel">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Numéro impôt</td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['num_impot']; ?></span>
                                            <input id="num_impot" name="num_impot" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $_SESSION['num_impot']; ?>" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Logo </td>
                                        <td>
                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $_SESSION['stocklogo']; ?></span>
                                             <span class="col-md-7 col-xs-12 voir">: <?php echo $_SESSION['stocklogo']; ?>
                                             <input type="file" id="logo" name="logo" title="Modifier cette image">
                                                 <input type="hidden"  name="xlogo" value="<?php echo $_SESSION['stocklogo']; ?>">

                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                         <div class="status alert alert-success col-md-12" id='msg' style="display:none"><i class="fa fa-info-circle"></i>Veuillez remplir ces champs vides</div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button id="btn_edit_regl" type="button" name="btn_edit_regl" class="btn btn-success cacher">Modifier</button>
                                <input name="valid_maj" id="btn_sve_regl" style="display: none;" type="submit" class="btn btn-primary voir" value="Valider">
                            </div>
                        </div>
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

<!-- Modal termes et conditions -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
            </div>
            <div class="modal-body">
                <h4>Text in a modal</h4>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>

        </div>
    </div>
</div>


<!-- Modal dans le chargement -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="utilisateur/enregistrement_user.php" id="form" class="form-horizontal form-label-left" novalidate>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="btn-group  btn-group-sm">
                            <h4>Réglage général</h4>
                        </div>
                        <!--<button id="send" type="submit" name="btn_save_user" class="btn btn-danger btn-sm btn_save_user"><i class="fa fa-save"></i> Enregistrer</button>-->
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="reglage_view.php" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i></a>
                            <a href="#" class="btn btn-default" title="Vue Formulaire"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monnaie">Monnaie de travail <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2" required="required" id="monnaie" name="monnaie">
                                    <option></option>
                                    <option value="usd">Dollars</option>
                                    <option value="fc">Franc Congolais</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="taux">Taux d'échange <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="taux" class="form-control col-md-7 col-xs-12" name="taux" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tva">TVA par défaut <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-5 col-xs-12">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-7 col-xs-12" id="tva" name="tva" />
                                    <span class="input-group-addon">$</span>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tranche nuité</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <input type="text" placeholder="Check in" class="form-control">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <input type="text" placeholder="Check out" class="form-control">
                            </div>
                                </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button id="send" type="submit" name="btn_save_user" class="btn btn-success btn_save_user">Enregistrer</button>
                                <button type="submit" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>

        </div>
    </div>
</div>


<style type="text/css">
    div.modal-content{
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -o-box-shadow: none;
    box-shadow: none;
}

.modal-dialog {
        box-shadow: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        -moz-transition: none;
        -webkit-transition: none;
    }

</style>

<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<script>
    $(document).ready(function () {


         $('.voir').hide();
        $(window).load(function(){
//            $('.voir').hide();
//        $('.bs-example-modal-lg').modal('show');
    });
       function effacer() {
            $(':input', '#form').not(':button,:submit,:reset,:hidden,\n\
                                   #optionsRadiosInline,#monnaie,#datebonentre,#optbanque')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
        }
         $('#etat').click(function (e) {
            if ($(this).is(":checked")) {
                $(this).val('oui');
                alert($(this).val());
            } else {
                $(this).val('non');
                alert($(this).val());
            }
        });
        $('#btn_edit_regl').click(function (e) {
            e.preventDefault();

            $('.voir').show();
            $('.cacher').hide();


        });

    });
</script>
<!-- validator -->
<script src="vendors/validator/validator.min.js"></script>
<!-- validator -->
<script>
    // initialize the validator function
    validator.message.date = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required').on('keyup blur', 'input', function () {
        validator.checkField.apply($(this).siblings().last()[0]);
    });

    $('form').submit(function (e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }

        if (submit)
            this.submit();

        return false;
    });
</script>
<!-- /validator -->


<!-- jQuery -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<!-- jQuery Smart Wizard -->
<script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<!-- Select2 -->
<script src="vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Datatables -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<!-- jQuery Smart Wizard -->
<script>
    $(document).ready(function () {
        $('#datatable-responsive').DataTable();
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
            transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');

        $(".select2").select2();
        $('#birthday').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        $(".select2_single").select2({
            placeholder: "Select a state",
            allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            maximumSelectionLength: 4,
            placeholder: "With Max Selection limit 4",
            allowClear: true
        });


    });
</script>
<!-- /jQuery Smart Wizard -->

<?php include('gl_footer.php'); ?>
