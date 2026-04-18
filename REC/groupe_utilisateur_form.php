<?php  include('Gerant_local.php');?>
<?php include('./head.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php include('../FUNCTION/checkpwd.php'); ?>
<?php require './Amelioration/bdd/connexion .php'; ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Création groupes d'accès</h3>
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

                        <button id="send" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-save"></i> Enregistrer</button>
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="groupe_utilisateur_view.php" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i></a>
                            <a href="#" class="btn btn-default" title="Vue Formulaire"><i class="fa fa-edit"></i></a>
                        </div>

                    </div>
                    <!-- /.panel-heading -->

                    <div class="panel-body">
                        <br>
                        <input value="<?php echo $_SESSION['id_hotel'];?>" class="form-control col-md-7 col-xs-12 hidden" id="hotel_id" name="hotel_id"  type="text">

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hotel">Module <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="block_hotel_module">
                                <select class="form-control col-md-7 col-xs-12 select2"  id="module" name="module">
                                    <option></option>
                                     <?php
                                    include("./Amelioration/module/modulecompany.php");
                                    foreach ($modules as $h):
                                        echo '<option value=' . $h->id. '>' . $h->nom . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <input id="action_module_id" class="form-control col-md-7 col-xs-12"  name="action_module_id"  type="hidden">
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom">Nom <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" id="nom" name="nom"  type="text">
                            </div>
                        </div>
                        <br><br>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#profile" data-toggle="tab">Droits d'accès</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="bloc_actions" style=" overflow: auto; height: 500px;">


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
                                   #optionsRadiosInline,#monnaie,#datebonentre,#optbanque')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
        }
        $('#send').click(function (e) {

            e.preventDefault();
            var donnees = $('#form').serialize();
//            alert(donnees);
            $.ajax({
                url: './utilisateur/enregistrement_groupe.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
//                     alert('gdghf');
                    if (data.message=='succes') {
//                        alert("L'enrégistrement s'est effectué avec succès!");
                        effacer();
                        $('#msg_grp').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg_alert_grp').text("L'enrégistrement s'est effectué avec succès!")
                    } else if(data.message=='champvide'){
//                        alert("Veuilez remplir tous les champs vides");
                        $('#msg_grp').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert_grp').text('Veuilez remplir tous les champs vides!')
                    }else if(data.message=='droitvide'){
//                        alert("Veuilez cocher au moins un droit");
                        $('#msg_grp').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert_grp').text('Veuilez cocher au moins un droit!')
                    }
//
                }, dataType: 'json'
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
//        $('#checkAll').click(function() {
//            alert('gdhffj');
        // on cherche les checkbox à l'intérieur de l'id  'magazine'
//        var magazines = $("#magazine").find(':checkbox');
//        if(this.checked){ // si 'checkAll' est coché
//         magazines.prop('checked', true);
//        }else{ // si on décoche 'checkAll'
//        magazines.prop('checked', false);}
//        });
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
