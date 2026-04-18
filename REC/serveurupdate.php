<?php  include('Gerant_local.php');?>
<?php include('./head.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php include('../FUNCTION/checkpwd.php'); ?>
<?php
 require './Amelioration/bdd/connexion .php';

 //Serveurs
if(isset($_GET['id'])){
    $id=$_GET['id'];
}else{
    $id=0;
}
$requete = $bdd->prepare("SELECT * FROM serveurs WHERE id=:id");
$requete->BindParam(':id', $id);
$requete->execute();
$s = $requete->fetch(PDO::FETCH_OBJ);
 ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Modification Serveur</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <form  id="form" method="post" action="utilisateur/enregistrement_groupe.php" class="form-horizontal form-label-left" novalidate>

        <div class="row">
            <div class="col-lg-12">
                <div id="msg_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert_grp">L'enrégistrement s'est effectué avec succès!</span>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <button id="send" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-save"></i> Modifier</button>
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="gl_liste_serveurs.php" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i> Liste</a>
                        </div>

                    </div>
                    <!-- /.panel-heading -->

                    <div class="panel-body">
                        <br>
                        <input value="<?php echo $id;?>" name="serveur_id"  type="hidden">
                        <input value="<?php echo $_SESSION['id_hotel'];?>" class="form-control col-md-7 col-xs-12 hidden" id="hotel_id" name="hotel_id"  type="text">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom">Nom <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" id="nom" name="nom" value="<?php echo $s->nom ?>" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prenom">Prenom <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" id="prenom" name="prenom" value="<?php echo $s->prenom ?>"  type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Sexe <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="block_hotel_module">
                                <select class="form-control col-md-7 col-xs-12 select2"  id="sexe" name="sexe">
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                    <option value="<?php echo $s->sexe ?>" selected><?php echo $s->sexe ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">Téléphone <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" id="tel" name="tel" value="<?php echo $s->tel ?>"   type="text">
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
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->


<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<script>
    $(document).ready(function () {
        function effacer() {
            $(':input', '#form').not(':button,:submit,:reset,:hidden,\n\
                                   #optionsRadiosInline,#monnaie,#datebonentre,#optbanque,#sexe')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
        }
        $('#send').click(function (e) {

            e.preventDefault();
            var donnees = $('#form').serialize();
            $.ajax({
                url: './utilisateur/modification_serveur.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                   if (data.message=='succes') {
                        effacer();
                        $('#msg_grp').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg_alert_grp').text("La modification s'est effectuée avec succès!")
                    } else if(data.message=='champvide'){
                        $('#msg_grp').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert_grp').text('Veuilez remplir tous les champs vides!')
                    } 
                }
              , dataType: 'json'
            });


        });
        $('#hotel_id').change(function (e){
            var hotel = $(this).val();
            if (hotel != 0) {
                $('#module').empty();
                $.ajax({
                    url: './utilisateur/module_hotel.php',
                    async: true,
                    type: 'POST',
                    data: "hotel=" + hotel,
                    global: false,
                    cache: false,
                    dataType: 'json',
                    success: function (json) {
                        $('#module').append('<option value="0"></option>');
                        $.each(json, function (index, value) {
                            $('#module').append('<option value="' + index + '">' + value + '</option>');
                        });
                    }
                });
            }else{
                $('#module').empty();
                $('#bloc_actions').empty();

            }

//            alert(hotel_id);
        });
        $('#module').change(function (e) {
            var module = parseInt($(this).val());
            if (module != 0) {
            $.ajax({
                    url: './utilisateur/actions_module.php',
                    async: true,
                    type: 'POST',
                    data: "module=" + module,
                    global: false,
                    cache: false,
                    success: function (data) {
                        $('#action_module_id').val(module);
                       $('#bloc_actions').html(data);
                    }
                });
            }else{
                $('#bloc_actions').empty();
            }
        });

        $("#bloc_actions").on('click', '.module_caisse #checkAll', function (e) {
//            on cherche les checkbox à l'intérieur de l'id  'magazine'
        var magazines = $("#magazine").find(':checkbox');
        if(this.checked){ // si 'checkAll' est coché
         magazines.prop('checked', true);
        }else{ // si on décoche 'checkAll'
        magazines.prop('checked', false);}
//            if ($(this).is(":checked")) {
//                $(this).val('oui');
//                 alert($(this).val());
//            } else {
//                $(this).val('non');
//                alert($(this).val());
//            }

        });
    });
</script>
<!-- Select2 -->
<script src="vendors/select2/dist/js/select2.full.min.js"></script>
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
