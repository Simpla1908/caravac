			
<?php include('head.php'); ?>
<?php 
include('./menu_Rec_config.php');
if(isset($_GET['module'])&&isset($_GET['site'])){
    include '../bdd/connexion.php';
    $requete = $bdd->prepare("SELECT fcon_heberge FROM t_reglage WHERE id_hotel=:site_id");
    $requete->BindParam(':site_id',$_GET['site']);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $operation){
        $fcon_heberge=$operation->fcon_heberge;
    }
    if ($_GET['module']=='MH' && $fcon_heberge==0) {
?> 
<!-- Modal dans le chargement -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
<!--                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>-->
                <h4 class="modal-title" id="myModalLabel">Réglage </h4>
            </div>
            <form class="form-horizontal"  name="entreprise-form" id="entreprise-form" method="post" action="Traitement/annulation_config.php" >
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_GET['site']; ?>" id="v" name="site_id" />
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
                              <input type="radio" checked="" value="par defaut" id="optionsRadios1" name="optionsRadios"> Par défaut
                            </label>
                          </div>
                        </div>-->
                        </div>
<!--                        <div class="col-md-12" id="div_defaut" style="padding-left: 50px;">
                            <br>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="input-group demo2">
                                        <input type="text" class="form-control col-md-9 col-xs-12" placeholder="% par defaut" id="pour_defaut" name="pour_defaut" />
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>-->
<!--                    <div class="col-md-12 reglage">
                        <div class="col-md-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" value="personalise" id="optionsRadios2" name="optionsRadios"> Pérsonnaliser
                                </label>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-md-12" id="div_personalise" style="padding-left: 50px;">
                        <br>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="check_pour_24" name='check_pour_24'> Moins de 24 heures
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" placeholder="pourcentage" id="pour_24" name="pour_24" disabled='disabled'/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="check_pour_48" name='check_pour_48'> Moins de 48 heures
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" placeholder="pourcentage" id="pour_48" name="pour_48" disabled='disabled'/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="check_pour_72" name='check_pour_72'> Moins de 72 heures
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" placeholder="pourcentage" id="pour_72" name="pour_72" disabled='disabled'/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="check_pour_sup_72" name='check_pour_sup_72'> Supérieur à 72 heures
                                </label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="input-group demo2">
                                    <input type="text" class="form-control col-md-9 col-xs-12" placeholder="pourcentage" id="pour_sup_72" name="pour_sup_72" disabled='disabled'/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--<div class="status alert alert-success col-md-12" id='msg' style="display:none"><i class="fa fa-info-circle"></i>Veuillez remplir ces champs vides</div>-->
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <br>
                            <button type="submit" class="btn btn-primary" id="save"><i class="fa fa-save"></i> Enregistrer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    }
}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <br><br><br>
                <section class="login_content">
                    <form>
                        <div>
                            <h1><i class="fa fa-cogs"></i> Configuration</h1>
                            <br>
                            
                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- /#wrapper -->
<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    
    $(document).ready(function () {
        $('.bs-example-modal-lg').modal({
            keyboard: false,
            backdrop: 'static'
        });
        $('.bs-example-modal-lg').modal('show');
        
        $('input[name="optionsRadios"]').click(function(){
            var type=$('input[name="optionsRadios"]:checked').val();
            
            if(type=='personalise'){
                $('#div_personalise').show();
                $('#div_defaut').hide();
            }else{
                $('#div_personalise').hide();
                $('#div_defaut').show();
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
//                        $("#msg").fadeOut(500, function () {
////                            $(".bs-example-modal-lg").modal("hide");
//                            $("#msg").fadeIn(500);
//                        });
                        
                        $('#msg').show().fadeOut(5000);
//                        $(".bs-example-modal-lg").modal("hide");
                        setTimeout(function () {
                            $(".bs-example-modal-lg").modal("hide");
                        }, 4000);
                    }
                },dataType: 'json'
            });
        });

    });
    
    
    
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
</script>
<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->