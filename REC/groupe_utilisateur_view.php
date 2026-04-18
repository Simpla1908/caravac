<?php
require '../bdd/connexion.php';
include('Gerant_local.php');
?>
<?php include('./head.php'); ?>
<?php include('./menu_Rec_config.php'); ?>
<?php include('../FUNCTION/checkpwd.php'); ?>
<?php require './Amelioration/bdd/connexion .php'; ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Groupes d'accès</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <form class="form-horizontal form-label-left" novalidate>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4>Liste
                            <div class="btn-group  btn-group-sm pull-right">
                                <a href="groupe_utilisateur_view.php" class="btn btn-default" title="Vue Liste"><i class="fa fa-bars"></i></a>
                                <a href="groupe_utilisateur_form.php" class="btn btn-default" title="Vue Formulaire"><i class="fa fa-edit"></i></a>
                            </div>
                        </h4>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Groupe d'accès</th>
                                        <th>Module</th>
                                        <!--<th>Site</th>-->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($_GET['del-grp-id'])){
                                        $id_groupe= $_GET['del-grp-id'];
                                        $requete = $bdd->prepare("DELETE FROM groupe WHERE id=:id_groupe");
                                        $requete->BindParam(':id_groupe',$id_groupe);
                                        $requete->execute();
                                    }
                                    include('./utilisateur/affichage_groupe.php');
                                    $i=1;
                                    foreach ($groupes as $ligne): 
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i;?></th>
                                        <td><?php echo  $ligne->groupe;?></td>
                                        <td><?php echo  $ligne->module;?></td>
                                        <!--<td><?php // echo $ligne->hotel;?></td>-->
                                        <td>
                                            <a href="groupe_modif_form.php?idgroupe=<?php echo  $ligne->id;?>&groupe=<?php echo  $ligne->groupe;?>&idmodule=<?php echo  $ligne->idmodule;?>&module=<?php echo  $ligne->module;?>&id_hotel=<?php echo  $ligne->id_hotel;?>&hotel=<?php echo  $ligne->hotel;?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Modifier</a>
                                            <a href="groupe_utilisateur_view.php?del-grp-id=<?php echo  $ligne->id;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Supprimer</a>

                                        </td>
                                    </tr>
                                    <?php $i=$i+1; endforeach;?>
                                </tbody>
                            </table>
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


<!-- jQuery -->
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

