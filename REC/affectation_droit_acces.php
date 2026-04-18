<?php include('Gerant_local.php'); ?>
<?php include('./head.php'); ?>
<?php include('./menu_Rec_config.php'); ?>
<?php include('../FUNCTION/checkpwd.php'); ?>
<?php require './Amelioration/bdd/connexion .php'; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Affectation droit d'accès</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <form method="POST" action="utilisateur/enreg_affectation_user.php" class="form-horizontal form-label-left" novalidate id="form">
        <div class="row">
            <div id="msg_aff_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <span id="msg_alert_aff_grp">L'affectation s'est effectuée avec succès!</span>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button id="send1" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-check"></i> Valider</button>
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="#" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i></a>
                            <a href="#" class="btn btn-default" title="Vue Formulaire"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <br>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hotel">Site <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2" required="required" id="hotel_id" name="hotel_id">
                                    <option value="<?php echo $_SESSION['id_hotel']; ?>"><?php echo $_SESSION['nom_hotel']; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hotel">Utilisateur <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2" required="required" id="module" name="module">
                                    <option></option>
                                    <?php
                                    include("./utilisateur/utilisateur_hotel.php");
                                    foreach ($utilisateurs as $user):
                                        echo '<option value=' . $user->id_user . '>' . $user->nom_user . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#profile" data-toggle="tab">Groupe d'accès</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div class="tab-pane fade in active" id="profile">
                                <br>
                                <div class="col-md-12" id="liste_groupe">
                                    <?php
                                    include("./utilisateur/liste_groupe_hotel.php");
                                    ?>
                                </div>
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
                                   #optionsRadiosInline,#monnaie,#datebonentre,#optbanque')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
        }
        $('#send1').click(function (e) {

            e.preventDefault();
            var donnees = $('#form').serialize();
//            alert(donnees);
            $.ajax({
                url: './utilisateur/enreg_affectation_user.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
//                     alert(data);
                    if (data.message=='succes') {
//                        alert("L'enrégistrement s'est effectué avec succès!");
                        effacer();
                        $('#msg_aff_grp').show().fadeOut(4000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg_alert_aff_grp').text("L'enrégistrement s'est effectué avec succès!")
                    } else if(data.message=='champvide'){
//                        alert("Veuilez remplir tous les champs vides");
                        $('#msg_aff_grp').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert_aff_grp').text('Veuilez remplir tous les champs vides!')
                    }else if(data.message=='groupevide'){
//                        alert("Veuilez cocher au moins un droit");
                        $('#msg_aff_grp').show().fadeOut(4000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg_alert_aff_grp').text('Veuilez cocher au moins un droit!')
                    }
//
                }, dataType: 'json'
            });
        });
        $('#hotel_id12').change(function (e){

            var hotel = $(this).val();
            if (hotel != '') {
                $('#module').empty();
                $.ajax({
                    url: './utilisateur/hotel_user.php',
                    async: true,
                    type: 'POST',
                    data: "hotel=" + hotel,
                    global: false,
                    cache: false,
                    dataType: 'json',
                    success: function (json) {
                        $('#module').append('<option></option>');
                        $.each(json, function (index, value) {
                            $('#module').append('<option value="' + index + '">' + value + '</option>');
                        });
                    }
                });

                $.ajax({
                    url: './utilisateur/liste_groupe_hotel.php',
                    async: true,
                    type: 'POST',
                    data: "hotel=" + hotel,
                    global: false,
                    cache: false,
                    success: function (data) {
                        $('#liste_groupe').html(data);
                    }
                });
            }

//            alert(hotel_id);
        });
        $('#module').change(function (e) {
            var module = parseInt($(this).val());
            switch (module) {
                case 1:
                    $('#bloc_actions').load('./utilisateur/actions_modules_caisse.php');
                    break;
                case 2:
                    $('#bloc_actions').html('');
                    break;
                default:
                    $('#bloc_actions').html('');
            }
        });
        $("#liste_groupe").on('click', '.to_do #checkAll', function (e) {
//            on cherche les checkbox à l'intérieur de l'id  'magazine'
        var id_user = $('#module').val();

        if(id_user==''){
            alert('Veuillez selectionner un utilisateur!');
            $('#checkAll').removeAttr('checked');
         }else{
           var magazines = $("#magazine").find(':checkbox');
           if(this.checked){ // si 'checkAll' est coché
            magazines.prop('checked', true);
           }else{ // si on décoche 'checkAll'
           magazines.prop('checked', false);}
        }

        });
        $("#liste_groupe").on('click', '.to_do .actions_groupe', function (e) {
           var id_user = $('#module').val();

            if ($(this).is(":checked")) {
                var id_grp = $(this).val();
                 if(id_user==''){
                     alert('Veuillez selectionner un utilisateur!');
                 }else{
                    $.ajax({
                    url: './utilisateur/verification_user_grp.php',
                    async: true,
                    type: 'POST',
                    data: "id_user=" + id_user + "&id_grp=" + id_grp,
                    global: false,
                    cache: false,
                    dataType: 'json',
                    success: function (json) {
                        if(json.groupe=='vide'){

                        }else{

                           alert('Cet utilisateur est déjà affecté dans ce groupe!');
                           $("#"+id_grp).removeAttr('checked');
                        }
                    }
                });
                 }
            } else {
//
            }
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
      $(document).ready(function() {
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
        }, function(start, end, label) {
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
