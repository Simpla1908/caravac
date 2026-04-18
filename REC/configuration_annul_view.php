<?php session_start(); ?>
<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php include('../FUNCTION/checkpwd.php'); ?>
<?php include('../bdd/connexion.php'); ?>
<?php
if(isset($_SESSION['id_hotel'])){
//recuperation des données de la base et mise en session de ces dernieres
$company= $_SESSION['company_id'];
//recuperation données t_reglage
$requete = $bdd->prepare("SELECT * FROM t_reglage WHERE id_hotel=:id_hotel");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$reglage_tuples = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($reglage_tuples as $regl) {
$type_annul = $regl->type_annul;
$pour_defaut = $regl->pourcentage_defaut;
$pour_24 = $regl->pourcentage_24_heure;
$pour_48 = $regl->pourcentage_48_heure;
$pour_72 = $regl->pourcentage_72_heure;
$pour_sup_72 = $regl->pourcentage_sup_72_heure;
}

$_SESSION['type_annul']  =$type_annul ;
$_SESSION['pour_defaut']  = $pour_defaut;
$_SESSION['pour_24']  = $pour_24 ;
$_SESSION['pour_48']  = $pour_48;
$_SESSION['pour_72']  = $pour_72;
$_SESSION['pour_sup_72']  = $pour_sup_72;

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
    <?php if(isset($_GET['msg'])&&$_GET['msg']=='vide'){?>
       <div id="msg" class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="msg_alert">Veuillez remplir tous les champs</span>
    </div>
           <?php   }?>
           <?php if(isset($_GET['msg'])&&$_GET['msg']=='succes'){?>
           <div id="msg" class="alert alert-success alert-dismissable">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <span id="msg_alert">La modification s'est effectuée avec succès!</span>
           </div>
               <?php   }?>
    <form method="post" action="Traitement/annulation_config.php" id="entreprise_form_maj" name="entreprise_form_maj" class="form-horizontal form-label-left">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
<!--                    <div class="panel-heading">
                        <div class="btn-group  btn-group-sm">
                            <h4>Pourcentage à rétirer lors de l'annulation d'une réservation</h4>
                        </div>
                    </div>-->
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <input type="hidden" value="<?php echo $_SESSION['id_hotel']; ?>" id="v" name="site_id" />
                        <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                            <span id="msg_alert">Votre enregistrement est effectué avec succes!</span>
                        </div>
                    <div class="col-md-12 reglage">
                        <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                            <span id="msg_alert">Votre enregistrement est effectué avec succes!</span>
                        </div>
                        <p class="font-gray-dark">
                            Pourcentage à rétirer lors de l'annulation d'une réservation
                        </p>
<!--                        <div class="col-md-5">
                            <div class="radio">
                            <label>
                                <?php if($_SESSION['type_annul']=='par defaut'){ ?>
                                <input type="radio" checked="checked" value="par defaut" id="optionsRadios1" name="optionsRadios"> Par défaut
                                <?php }else{ ?>
                                <input type="radio" checked="" value="par defaut" id="optionsRadios1" name="optionsRadios"> Par défaut
                                <?php } ?>
                            </label>
                          </div>
                        </div>-->
                        </div>
<!--                        <div class="col-md-12" id="div_defaut" style="padding-left: 50px;">
                            <br>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <?php if($_SESSION['type_annul']=='par defaut'){ ?>
                                    <div class="input-group demo2">
                                        <input type="text" class="form-control col-md-9 col-xs-12" value="<?php echo $_SESSION['pour_defaut']; ?>" id="pour_defaut" name="pour_defaut" />
                                        <span class="input-group-addon">%</span>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="input-group demo2" style="display:none;" id="input_default">
                                        <input type="text" class="form-control col-md-9 col-xs-12" value="0" id="pour_defaut" name="pour_defaut" />
                                        <span class="input-group-addon">%</span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>-->
<!--                    <div class="col-md-12 reglage">
                        <div class="col-md-5">
                            <div class="radio">
                                <label>
                                    <?php if($_SESSION['type_annul']=='personalise'){ ?>
                                    <input type="radio" checked="checked" value="personalise" id="optionsRadios2" name="optionsRadios"> Pérsonnaliser
                                    <?php }else{ ?>
                                    <input type="radio" value="personalise" id="optionsRadios2" name="optionsRadios"> Pérsonnaliser
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-md-12" id="div_personalise" style="padding-left: 50px;">
                        <br>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_24']!=0){ ?>
                                    <input type="checkbox" checked="checked" id="check_pour_24" name='check_pour_24'> Moins de 24 heures
                                    <?php }else{ ?>
                                    <input type="checkbox" id="check_pour_24" name='check_pour_24'> Moins de 24 heures
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_24']!=0){ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="<?php echo $_SESSION['pour_24']; ?>" id="pour_24" name="pour_24" />
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php }else{ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="0" disabled='disabled' id="pour_24" name="pour_24"/>
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_48']!=0){ ?>
                                    <input type="checkbox" checked="checked" id="check_pour_48" name='check_pour_48'> Moins de 48 heures
                                    <?php }else{ ?>
                                    <input type="checkbox" id="check_pour_48" name='check_pour_48'> Moins de 48 heures
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_48']!=0){ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="<?php echo $_SESSION['pour_48']; ?>" id="pour_48" name="pour_48"/>
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php }else{ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="0" disabled='disabled' id="pour_48" name="pour_48" />
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_72']!=0){ ?>
                                    <input type="checkbox" id="check_pour_72" checked="checked" name='check_pour_72'> Moins de 72 heures
                                    <?php }else{ ?>
                                    <input type="checkbox" id="check_pour_72" name='check_pour_72'> Moins de 72 heures
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_72']!=0){ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="<?php echo $_SESSION['pour_72']; ?>" id="pour_72" name="pour_72" />
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php }else{ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="0" disabled='disabled' id="pour_72" name="pour_72" />
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_sup_72']!=0){ ?>
                                    <input type="checkbox" checked="checked" id="check_pour_sup_72" name='check_pour_sup_72'> Supérieur à 72 heures
                                    <?php }else{ ?>
                                    <input type="checkbox" id="check_pour_sup_72" name='check_pour_sup_72'> Supérieur à 72 heures
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <?php if($_SESSION['type_annul']=='personalise' && $_SESSION['pour_sup_72']!=0){ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" value="<?php echo $_SESSION['pour_sup_72']; ?>" id="pour_sup_72" name="pour_sup_72" />
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php }else{ ?>
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" disabled='disabled' value="0" id="pour_sup_72" name="pour_sup_72" />
                                    <span class="input-group-addon">%</span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="status alert alert-success col-md-12" id='msg' style="display:none"><i class="fa fa-info-circle"></i>Veuillez remplir ces champs vides</div>-->
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <!--<br>-->
                            <!--<button type="submit" class="btn btn-primary" id="save"><i class="fa fa-save"></i> Enregistrer</button>-->
                        </div>
                    </div>
                         <div class="status alert alert-success col-md-12" id='msg' style="display:none"><i class="fa fa-info-circle"></i>Veuillez remplir ces champs vides</div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success" id="save"><i class="fa fa-edit"></i> Valider</button>
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
//        var type=$('input[name="optionsRadios"]:checked').val();
//        if(type=='personalise'){
//                $('#div_personalise').show();
//                $('#div_defaut').hide();
//            }else{
//                $('#div_personalise').hide();
//                $('#div_defaut').show();
//            }
        
        $('input[name="optionsRadios"]').click(function(){
            var type=$('input[name="optionsRadios"]:checked').val();
            
            if(type=='personalise'){
                $('#div_personalise').show();
                $('#div_defaut').hide();
            }else{
                $('#div_personalise').hide();
                $('#div_defaut').show();
                $('#input_default').show();
            }

        });
        
        $("#div_personalise").on('click', '#check_pour_24', function(e) {
                //            on cherche les checkbox à l'intérieur de l'id  'magazine' 
//                var profile = $("#profile").find(':checkbox');
                if (this.checked) { // si 'checkAll' est coché
                    $('#pour_24').removeAttr('disabled');
//                    profile.prop('checked', true);
                } else { // si on décoche 'checkAll'
                    $('#pour_24').attr('disabled','disabled');
                    $('#pour_24').val(' ');
//                    profile.prop('checked', false);
                }
//                var donnees = $('#form_grp_user_aff').serialize();
//                //             alert(donnees);
//                $.ajax({
//                    url: './utilisateur/groupe_user_aff_traitement.php',
//                    type: 'POST',
//                    data: donnees,
//                    success: function(data) {
//                        //                alert(data);
//                    },
//                    dataType: 'text'
//                });
            });
            
            $("#div_personalise").on('click', '#check_pour_48', function(e) {
                if (this.checked) { // si 'checkAll' est coché
                    $('#pour_48').removeAttr('disabled');
                } else { // si on décoche 'checkAll' 
                    $('#pour_48').attr('disabled','disabled');
                    $('#pour_48').val(' ');
                }
            });
            
            $("#div_personalise").on('click', '#check_pour_72', function(e) {
                if (this.checked) { // si 'checkAll' est coché
                    $('#pour_72').removeAttr('disabled');
                } else { // si on décoche 'checkAll' 
                    $('#pour_72').attr('disabled','disabled');
                    $('#pour_72').val(' ');
                }
            });
            
            $("#div_personalise").on('click', '#check_pour_sup_72', function(e) {
                if (this.checked) { // si 'checkAll' est coché
                    $('#pour_sup_72').removeAttr('disabled');
                } else { // si on décoche 'checkAll' 
                    $('#pour_sup_72').attr('disabled','disabled');
                    $('#pour_sup_72').val(' ');
                }
            });
            
            
            $("#save").click(function (e) {
            e.preventDefault();
            var donnees = $('.form-horizontal').serialize();
            var nbCaseCochees = $('input:checked').length;
//            alert(donnees);
            $.ajax({
                url: './Traitement/annulation_config.php',
                type: 'POST',
                data: donnees,
                success: function(data) {
                    if (data.message == 'succes') {
                        $('#msg').show().fadeOut(8000);
//                        $(".bs-example-modal-lg").modal("hide");
//                        setTimeout(function () {
//                            $(".bs-example-modal-lg").modal("hide");
//                        }, 4000);
                    }
                },dataType: 'json'
            });
        });
            
            

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
//$('#entreprise_form_maj').on('submit', function (e) {
//e.preventDefault();
////alert(new FormData(this));
////if (!($('#tc').prop('checked'))) {
////$('#msg').empty().append('Veuillez cocher Termes & conditions!').show().fadeOut(4000);
////}else{
////var donnees = $('#entreprise_form_maj').serialize();
//if ($('#monnaie').val()==''|| $('#tva').val()==''|| $('#taux').val()==''|| $('#rmz').val()=='') {
//$('#msg').empty().append('Veuillez remplir les champs vides!').show().fadeOut(4000);
//if ($('#monnaie').val()=='') $("#monnaie").css("border-color","red");
//if ($('#tva').val()=='') $("#tva").css("border-color","red");
//if ($('#taux').val()=='') $("#taux").css("border-color","red");
//if ($('#rmz').val()=='') $("#rmz").css("border-color","red");
//} else{
//$.ajax({
//url: 'Traitement/entreprise_traitement_maj.php',
//type: 'POST',
//data: new FormData(this),
//success: function (data) {
//location.href='reglage_view.php?bd=yes';
//
//}
//});
//}
//
////}
//
//
//
//});
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
