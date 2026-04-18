<?php include('Gerant_local.php'); ?>
<?php include('./headerRec_popup.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php
include('../FUNCTION/checkpwd.php');
include('./Amelioration/bdd/connexion .php');

if(isset($_GET['id_user'])){

$requete = $bdd->prepare("SELECT * FROM t_utilisateur AS u, t_hotel AS h WHERE u.id_hotel=h.id_hotel AND u.id_user=:id_user");
$requete->BindParam(':id_user',$_GET['id_user']);
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($users as $user) {
    $id_user=$user->id_user;
    $noms=$user->nom_user;
    $sexe=$user->sexe_user;
    $login=$user->email_user;
    $mdp=$user->mdp_user;
    $actif=$user->actif;
    $hotel=$user->nom_hotel;
    $id_hotel_req=$user->id_hotel;
}

$requete = $bdd->prepare("SELECT * FROM connexion AS c,t_utilisateur AS u WHERE c.id_user=u.id_user AND c.id_user=:id_user ORDER BY id_con DESC LIMIT 0,1");
$requete->BindParam(':id_user',$_GET['id_user']);
$requete->execute();
$connexion = $requete->fetchAll(PDO::FETCH_OBJ);

if(count($connexion)==0){
    $date_con='00-00-00 00:00:00';
    $date_decon='00-00-00 00:00:00';
}else{
foreach ($connexion as $con) {
    $id_con=$con->id_con;
    $date_con=$con->date_con;
    $date_decon=$con->date_decon;
}
}
$time1 = strtotime($date_con);
$time2 = strtotime($date_decon);
if( $time1 > $time2 ) {
	$time = $time1 - $time2;
} else {
	$time = $time2 - $time1;
}

$time_h = $time / 3600;
$time_min = $time / 60;
$time_sec = $time_min / 60;
//echo "Il y a ".round($time)." heures";

}
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Mon profil</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!--<form class="form-horizontal form-label-left" novalidate>-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <?php if ($sexe == 'masculin') { ?>
                                        <img class="img-responsive avatar-view" src="images/profil_hom.jpg" alt="Avatar" title="Change the avatar">
                                    <?php } else { ?>
                                        <img class="img-responsive avatar-view" src="images/profil_fem.jpg" alt="Avatar" title="Change the avatar">
                                    <?php } ?>
                                </div>
                            </div>
                            <h4><?php echo ucwords($noms); ?></h4>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-home"></i> <?php echo ucwords($hotel); ?>
                                </li>

                                <li>
                                    <i class="fa fa-external-link user-profile-icon"></i> LOGIN: <?php echo $login; ?>
                                </li>

                                <li>
                                    <i class="fa fa-cog"></i> MDP: <?php echo $mdp; ?>
                                </li>

                                <li class="m-top-xs">
                                    <?php if ($actif==1){?>
                                    <label>
                                        <input type="checkbox" class="flat" disabled="disabled" checked="checked"> Actif
                                    </label>
                                    <?php }  else {?>
                                    <label>
                                        <input type="checkbox" class="flat" disabled="disabled"> Actif
                                    </label>
                                    <?php }?>
                                </li>
                            </ul>
                            <?php // if (in_array('CMU',$_SESSION['actions']['code_actions'])||$_SESSION['type_user']==1){?>
                            <a class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-edit m-right-xs"></i> Modifier</a>
                            <?php // }?>
                            <br />
                        </div>

                        <!-- modals -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form method="post" action="utilisateur/modification_user.php" id="form" class="form-horizontal form-label-left" novalidate>
                                    <input id="id_user" class="form-control col-md-7 col-xs-12" value="<?php echo $id_user; ?>" name="id_user"  type="hidden">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Utilisateur / <small>Modification</small></h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="item form-group" style="display:none">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hotel">Site <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md-7 col-xs-12 select2" required="required" id="hotel_id" name="hotel_id" style="width: 420px;">
                                                        <option></option>
                                                        <?php
                                                        include("./Amelioration/caisse/caisse_hotel.php");
                                                        foreach ($hotels as $h):
                                                            if ($id_hotel_req==$h->id_hotel) {
                                                                echo '<option value=' . $h->id_hotel . ' selected>' . $h->nom_hotel . '</option>';
                                                            }
                                                            echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom">Noms <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="name" class="form-control col-md-7 col-xs-12" value="<?php echo $noms; ?>" name="name" placeholder="Trois noms e.g Marcel Kabwa Shabantu" required="required" type="text">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Sexe <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md-7 col-xs-12" required="required" name="sexe" id="sexe">
                                                        <option></option>
                                                        <?php
                                                            if ($sexe=='masculin') {
                                                                echo '<option value="masculin" selected>' . 'Masculin' . '</option>';
                                                            }  else {
                                                                echo '<option value="feminin" selected>' . 'Feminin' . '</option>';
                                                            }                                                       
                                                        ?>
                                                        <option value="masculin">Masculin</option>
                                                        <option value="feminin">Feminin </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="login">Login <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="login" name="login" required="required" value="<?php echo $login; ?>" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password" class="control-label col-md-3">Mot de passe</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="password" type="password" name="password1" value="<?php echo $mdp; ?>"  class="form-control col-md-7 col-xs-12" required="required">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmer Mot de passe</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="password2" type="password" name="password2" value="<?php echo $mdp; ?>" data-validate-linked="password1" class="form-control col-md-7 col-xs-12" required="required">
                                                </div>
                                            </div>

                                            <div class="item form-group" style="display:none">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Actif <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php if ($actif==1){?>
                                                    <input name="etat" id="etat" value="1" type="checkbox" class="flat" checked="checked" required="required">
                                                    <?php }  else {?>
                                                    <input name="etat" id="etat" type="checkbox" class="flat" required="required">
                                                    <?php  }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <button id="btn_edit_user111" type="submit" class="btn btn-primary btn_edit_user">Valider</button>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>
                        <!-- / modals -->  

                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <div class="profile_title">
                                <div class="col-md-6">
                                    <h3>Monitoring de la connexion</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group  btn-group-sm pull-right">
                                        <a href="#" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg1" title="Toutes les connexions"><i class="fa fa-bars"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- start of user-activity-graph -->
                            <div id="graph_bar" style="width:100%; height:150px;">
                                <br /><br />
                                <ul class="stats-overview">
                                    <li>
                                        <span class="name"> Date derniere connexion </span>
                                        <span class="value text-success"> <?php echo $date_con; ?> </span>
                                    </li>
                                    <li>
                                        <span class="name"> Date derniere déconnexion </span>
                                        <span class="value text-success"> <?php echo $date_decon; ?> </span>
                                    </li>
<!--                                    <li class="hidden-phone">
                                        <span class="name"> Durée effectuée </span>
                                        <span class="value text-success"> <?php // echo round($time_h).'h:'.round($time_min).'min:'.round($time_sec).'séc'; ?> </span>
                                    </li>-->
                                </ul>

                            </div>
                            <!-- end of user-activity-graph -->


                            <!-- modals -->
                            <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form class="form-horizontal form-label-left" novalidate>
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Monitoring de toutes les connexions</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $requete = $bdd->prepare("SELECT * FROM connexion AS c,t_utilisateur AS u WHERE c.id_user=u.id_user AND c.id_user=:id_user ORDER BY date_con DESC ");
                                                $requete->BindParam(':id_user',$_GET['id_user']);
                                                $requete->execute();
                                                $connexion1 = $requete->fetchAll(PDO::FETCH_OBJ);
                                                ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date de connexion</th>
                                                            <th>Date de déconnexion </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php $i=1; foreach ($connexion1 as $con1):?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i?></th>
                                                            <td><?php echo $con1->date_con?></td>
                                                            <td><?php echo $con1->date_decon?></td>
                                                        </tr>
                                                        <?php $i++; endforeach;?>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            </div>

                                        </div>
                                    </form> 
                                </div>
                            </div>
                            <!-- / modals --> 

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#profile" data-toggle="tab">Groupes d'accès affectés</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" id="bloc_groupe" style=" overflow: auto; height: 500px;">

                            <?php include './groupe_user_aff_profil.php'; ?>
                            </div>
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
    <!--</form>-->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<!-- validator -->
<script src="vendors/validator/validator.min.js"></script>
<!-- validator -->
<script>
    $(document).ready(function () {
        $('.voir').hide();
        
        
        $('#btn_edit_regl').click(function (e) {
            e.preventDefault();
            
            $('.voir').show();
            $('.cacher').hide();
        });
        
    $('#btn_edit_user').click(function (e) {
            e.preventDefault();
            var donnees = $('#form').serialize();
            var id_user=$('#id_user').val();
//            alert(donnees);
            $.ajax({
                url: './utilisateur/modification_user.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
//                    alert(data);
                    $(".bs-example-modal-lg").modal('hide');
                    location.href='./profil_utilisateur.php?id_user='+id_user;
                }
            });

        });
        
        
        
        
          $("#bloc_groupe").on('click', '.groupes #checkAll', function (e) {
//            on cherche les checkbox à l'intérieur de l'id  'magazine'
            var profile = $("#profile").find(':checkbox');
            if (this.checked) { // si 'checkAll' est coché
                profile.prop('checked', true);
            } else { // si on décoche 'checkAll'
                profile.prop('checked', false);
            }
            var donnees = $('#form_grp_user_aff').serialize();
//             alert(donnees);  
            $.ajax({
                url: './utilisateur/groupe_user_aff_traitement.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
//                alert(data);
                }, dataType: 'text'
            });
        });
    $("#bloc_groupe").on('click', '.groupes .groupe_cls', function (e) {

        var donnees = $('#form_grp_user_aff').serialize();
//             alert(donnees);  
        $.ajax({
            url: './utilisateur/groupe_user_aff_traitement.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
//                alert(data);
            }, dataType: 'text'
        });

    });
        
        
    
    });
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