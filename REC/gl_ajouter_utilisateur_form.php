<?php include('Gerant_local.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php include('../FUNCTION/checkpwd.php'); ?>
<?php require './Amelioration/bdd/connexion .php'; 
 include '../FUNCTION/restaurant.php';
$nbre_user = 0;
$pos= ListPosResto($_SESSION['id_hotel'],$bdd);
$result=getNbreUser($_SESSION['id_hotel'],$bdd);
foreach ($result as $op) {
    $nbre_user = $op->nbre_user;
    $_SESSION['nbre_user']=$nbre_user;
}

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                Création utilisateurs
                <small class="text text-danger"></small>
            </h3>
            
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div id="msg121" class="alert alert-success alert-dismissable" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="msg121_alert">L'enrégistrement s'est effectué avec succès!</span>
    </div>
    <form method="post" action="utilisateur/enregistrement_user.php" id="form" class="form-horizontal form-label-left" novalidate>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button id="send1" type="submit" name="btn_save_user"class="btn btn-danger btn-sm btn_save_user"><i class="fa fa-save"></i> Enregistrer</button>
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="gl_liste_utilisateur.php" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i></a>
                            <a href="gl_ajouter_utilisateur_form.php" class="btn btn-default" title="Vue Formulaire"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <input id="hotel_id" class="form-control hidden" value="<?php echo $_SESSION['id_hotel']; ?>" name="hotel_id" type="text">
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="image">Image 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <span class="input-group-btn">
                            <span class="btn btn-primary btn-file">
                                Parcourir <input type="file" id="imgInp" name="image" >
                            </span>
                        </span>
                         <img id='img-upload' width="100" height="100" />

                        </div>
                         </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom">Noms <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" name="name"  required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Sexe <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="sexe"class="form-control col-md-7 col-xs-12" required="required">
                                    <option value="masculin">Masculin</option>
                                    <option value="feminin">Feminin </option>
                                </select>
                            </div>
                        </div>
                         <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Type <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="type_user" id="type_user" class="form-control col-md-7 col-xs-12" required="required">
                                    <option value="3">Utilisateur</option>
                                    <option value="5">Superviseur</option>
                                    <option value="1">Administrateur </option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="login">Login <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="login" name="login" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                       
                        <div class="item form-group hidden">
                            <label for="password" class="control-label col-md-3">Mot de passe <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" type="password" name="password1"  class="form-control col-md-7 col-xs-12" required="required" value="x">
                            </div>
                        </div>
                        <div class="item form-group hidden">
                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmer Mot de passe <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password2" type="password" name="password2" class="form-control col-md-7 col-xs-12" required="required" value="x">
                            </div>
                        </div>
                         <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Module par défaut <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               <input id="module_name" type="hidden" name="module_name" value="">
                                <select name="module_dflt" id="module_dflt" class="form-control col-md-7 col-xs-12" required="required">
                                    <option></option>
                                        <?php if (in_array('VMACH', $_SESSION['actions']['code_actions'])){ ?>
<!--                                             <option value="new/CodeOutput/index.php?pg=admin&view=module&do=achat" pos='0'>Achat</option>
 -->                                        <?php } ?>
                                        
                                        <?php if (in_array('VMFACT', $_SESSION['actions']['code_actions'])){ ?>
                                            <option value="new/CodeOutput/index.php?pg=admin&view=module&do=fact" pos='1'>Facturation</option>
                                        <?php } ?>
                                        <?php if (in_array('VMH', $_SESSION['actions']['code_actions'])){ ?>
                                            <option value="new/CodeOutput/index.php?pg=admin&view=module&do=heb2" pos='0'>Hebergement</option>
                                        <?php } ?>
                                        <?php if (in_array('VRH', $_SESSION['actions']['code_actions'])){ ?>
                                            <option value="new/CodeOutput/index.php?pg=admin&view=module&do=rh" pos='0'>Ressources Humaines</option>
                                        <?php } ?>
                                        <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])){ ?>
                                            <option value="restaurant2/index.php" pos='1'>Restaurant</option>
                                            <option value="restaurant2/cuisine.php" pos='0'>Cuisine</option>
                                            <option value="restaurant2/caissier.php" pos='0'>Caissier</option>
                                            <option value="restaurant2/bar.php" pos='0'>Bar</option>
                                        <?php } ?>
                                        <?php if (in_array('VMS', $_SESSION['actions']['code_actions'])){ ?>
                                            <option value="Stock2/index.php" pos='0'>Stock</option>
                                        <?php } ?>
                                        
                                    </select>
                            </div>
                        </div>
                        <div class="item form-group posblc hidden">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Espace de vente <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="pos_id" id='pos_id' class="form-control col-md-7 col-xs-12" required="required">
                                     <?php  foreach ($pos as $p) { ?>
                                        <option value="<?php echo $p->id_sousresto ?>"><?php echo $p->libelle ?></option>
                                     <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group" style="display: none">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Actif <span class="required">*</span>

                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="etat" id="etat" value="1" type="checkbox" class="flat" checked="checked" required="required">
                            </div>
                        </div>
                        <!--                         <div class="ln_solid"></div>-->
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
         $('#etat').click(function (e) {
            if ($(this).is(":checked")) {
                $(this).val('oui');
                alert($(this).val());
            } else {
                $(this).val('non');
                alert($(this).val());
            }
        });
        $('#module_dflt').change(function (e) {
            e.preventDefault();
            var module_name = $('#module_dflt option:selected').text();
            var pos= $('#module_dflt option:selected').attr('pos');
            if(pos=='0'){
                $('.posblc').addClass('hidden');
            }else{
               $('.posblc').removeClass('hidden'); 
            }
            $('#module_name').val(module_name);
            return false;
       });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
        $('.btn_save_user').click(function (e) {
            e.preventDefault();
            var form = $('#form')[0];
            var data  = new FormData(form);
            $.ajax({
                url: './utilisateur/enregistrement_user.php',
                type: 'POST',
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                  // alert(data);
                    if (data.message == 'succes') {
                        $('#nbr_user').text(data.user);
                        $('#msg121').show().fadeOut(6000)
                                .addClass('alert-success')
                                .removeClass('alert-danger');
                        $('#msg121_alert').text("L'enrégistrement s'est effectué avec succès!");
                        effacer();
                        $('#img-upload').attr('src','');
                    } else if(data.message=='champvide'){
                        $('#msg121').show().fadeOut(8000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg121_alert').text('Veuillez remplir tous les champs vides!');
                    }
                    else if(data.message=='mdpIncorrect'){
                        $('#msg121').show().fadeOut(8000)
                                .addClass('alert-danger')
                                .removeClass('alert-success');
                        $('#msg121_alert').text('Les deux mots de passe saisis doivent etre idéntique!')
                    }else if(data.message=='idexist'){
                        $('#msg121').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg121_alert').text('Ce login existe déjà!')
                    }
                    else if(data.message=='overflow'){
                        $('#msg121').show().addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg121_alert').text("Nombre maximum d'utilisateur atteint!");
                    }
                }, dataType: 'json'
            });

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
