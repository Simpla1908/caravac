<?php include('Gerant_local.php'); ?>
<?php include('./headerRec_popup.php'); ?>
<link href="vendors/bootstrap-progressbar/bootstrap-progressbar-3.css" type="text/css" rel="stylesheet">
<link href="vendors/bootstrap-progressbar/bootstrap-progressbar-demo.css" type="text/css" rel="stylesheet">
<style>
    .six-sec-ease-in-out {
        -webkit-transition: width 6s ease-in-out;
        -moz-transition: width 6s ease-in-out;
        -ms-transition: width 6s ease-in-out;
        -o-transition: width 6s ease-in-out;
        transition: width 6s ease-in-out;
    }
</style>
<?php include('menu_Rec_config.php'); ?>
<?php
include('../FUNCTION/checkpwd.php');
include('./Amelioration/bdd/connexion .php');
 include '../FUNCTION/restaurant.php';
$pos= ListPosResto($_SESSION['id_hotel'],$bdd);
$agent_id=0;
$id_user ='';
$noms = '';
$sexe = '';
$login = '';
$mdp = '';
$actif = '';
$type_user = '';
$module_dflt = '';
$module_name= '';
$pos_id='';
$path_image='';
$nom_hotel='';
if (isset($_GET['id_user'])) {
    $agent_id=$_GET['id_user'];
    $requete = $bdd->prepare("SELECT * FROM t_utilisateur AS u WHERE u.id_user=:id_user");
    $requete->BindParam(':id_user', $_GET['id_user']);
    $requete->execute();
    $users = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($users as $user) {
        $id_user = $user->id_user;
        $noms = $user->nom_user;
        $sexe = $user->sexe_user;
        $login = $user->email_user;
        $mdp = $user->mdp_user;
        $actif = $user->actif;
        $type_user = $user->type;
        $module_dflt = $user->module_dflt;
        $module_name= $user->module_name;
        $pos_id= $user->pos_id;
        $path_image= $user->path_image;


    }
    //recuperation hotel
    if ($type_user != 1) {
        $requete = $bdd->prepare("SELECT * FROM t_utilisateur AS u, t_hotel AS h WHERE u.id_hotel=h.id_hotel AND u.id_user=:id_user");
        $requete->BindParam(':id_user', $_GET['id_user']);
        $requete->execute();
        $users = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($users as $user) {
            $id_hotel = $user->id_hotel;
            $nom_hotel = $user->nom_hotel;


        }
    }

    $requete = $bdd->prepare("SELECT * FROM connexion AS c,t_utilisateur AS u WHERE c.id_user=u.id_user AND c.id_user=:id_user ORDER BY id_con DESC LIMIT 0,1");
    $requete->BindParam(':id_user', $_GET['id_user']);
    $requete->execute();
    $connexion = $requete->fetchAll(PDO::FETCH_OBJ);

    if (count($connexion) == 0) {
        $date_con = '00-00-00 00:00:00';
        $date_decon = '00-00-00 00:00:00';
    } else {
        foreach ($connexion as $con) {
            $id_con = $con->id_con;
            $date_con = $con->date_con;
            $date_decon = $con->date_decon;
        }
    }
    $time1 = strtotime($date_con);
    $time2 = strtotime($date_decon);
    if ($time1 > $time2) {
        $time = $time1 - $time2;
    } else {
        $time = $time2 - $time1;
    }

    $time_h = $time / 3600;
    $time_min = $time / 60;
    $time_sec = $time_min / 60;
    $valpos=0;
    $hidden2='hidden';
    if($module_name=='Restaurant' || $module_name=='Facturation'){
      $valpos=1; 
      $hidden2='';
    }
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Detail utilisateurs</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!--<form class="form-horizontal form-label-left" novalidate>-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left" id="maj_detail_user">
                        <div class="profile_img">
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                 <?php if ($path_image == '') { ?>
                                <?php if ($sexe == 'masculin') { ?>
                                    <img class="img-responsive avatar-view" src="images/profil_hom.jpg" alt="Avatar"
                                         title="Change the avatar">
                                <?php } else { ?>
                                    <img class="img-responsive avatar-view" src="images/profil_fem.jpg" alt="Avatar"
                                         title="Change the avatar">
                                <?php } ?>
                            <?php }else{?>
                            <img class="img-responsive avatar-view" src="utilisateur/<?php echo $path_image; ?>" alt="Photo user" title="Photo user">
                            <?php } ?>

                            </div>
                        </div>
                        <h4>
                            <?php echo ucwords($noms); ?>
                        </h4>

                        <ul class="list-unstyled user_data">
                            <?php
                            if ($type_user != 1) {
                                ?>
                                <li><i class="fa fa-home"></i>
                                    <?php echo ucwords($nom_hotel); ?>
                                </li>
                                <?php
                            }
                            ?>
                            <!-- <li>
                                <i class="fa fa-external-link user-profile-icon"></i> LOGIN:
                                <?php //echo $login; ?>
                            </li> -->
                          
                            <li class="m-top-xs">
                                <?php if ($actif == 1) { ?>
                                    <label>
                                        <input type="checkbox" class="flat" disabled="disabled" checked="checked"> Actif
                                    </label>
                                <?php } else { ?>
                                    <label>
                                        <input type="checkbox" class="flat" disabled="disabled"> Actif
                                    </label>
                                <?php } ?>
                            </li>
                        </ul>
                        <a class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">
                            <i class="fa fa-edit m-right-xs"></i> Modifier
                        </a>
                        <br/>
                        <br/>
                        <a class="btn btn-danger" data-toggle="modal" data-target=".motdepasse_md">
                            <i class="fa fa-edit m-right-xs"></i> Changer Login
                        </a>
                        <br/>
                        <br/>
                        <a href="impression/carteidentite.php?id_user=<?php echo $agent_id;?>" target="ablank" class="btn btn-primary">
                            <i class="fa fa-print m-right-xs"></i> Imprimer
                        </a>
                        <br/>
                    </div>

                    <!-- modals -->
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content" id="modalcontentinfosuser">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                            aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Utilisateur /
                                        <small>Modification</small>
                                    </h4>
                                </div>
                                <div class="modal-body">
                                   <div id="msg_inf" class="alert alert-success alert-dismissable" style="display:none;">
                                    <span id="msg_alert_inf">L'enrégistrement s'est effectué avec succès!</span>
                                    </div>
                                    <form method="post" action="utilisateur/modification_user.php" id="form_user"
                                                      class="form-horizontal form-label-left" enctype="multipart/form-data">
                                                    <input id="id_user" class="form-control col-md-7 col-xs-12"
                                                           value="<?php echo $id_user; ?>" name="id_user" type="hidden">
                                                    <?php
                                                    if ($type_user == 1 || $type_user == 3) {
                                                        if (isset($_GET['prfl'])) {
                                                            ?>
                                                            <div class="item form-group" style="display:none">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                       for="hotel">Site <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select
                                                                        class="form-control col-md-7 col-xs-12 select2"
                                                                        required="required" id="hotel_id"
                                                                        name="hotel_id" style="width: 420px;">
                                                                        <?php
                                                                        include("./Amelioration/caisse/caisse_hotel.php");
                                                                        foreach ($hotels as $h):
                                                                            if ($id_hotel_req == $h->id_hotel) {
                                                                                echo '<option value=' . $h->id_hotel . ' selected>' . $h->nom_hotel . '</option>';
                                                                            } else {
                                                                                echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                                                                            }

                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                       for="hotel">Site <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select
                                                                        class="form-control col-md-7 col-xs-12 select2"
                                                                        required="required" id="hotel_id"
                                                                        name="hotel_id" style="width: 420px;">
                                                                        <?php
                                                                        include("./Amelioration/caisse/caisse_hotel.php");
                                                                        foreach ($hotels as $h):
                                                                            if ($id_hotel_req == $h->id_hotel) {
                                                                                echo '<option value=' . $h->id_hotel . ' selected>' . $h->nom_hotel . '</option>';
                                                                            } else {
                                                                                echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                                                                            }

                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
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
                                                           <?php if ($path_image == '') { ?>
                                                           <img id='img-upload' width="100" height="100" />

                                                          <?php }else{ ?>
                                                          <img id='img-upload' width="100" height="100" src="utilisateur/<?php echo $path_image; ?>"/>

                                                          <?php } ?>

                                                        </div>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="nom">Noms <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="name" class="form-control col-md-7 col-xs-12"
                                                                   value="<?php echo $noms; ?>" name="name"
                                                                   placeholder="Trois noms e.g Marcel Kabwa Shabantu"
                                                                   required="required" type="text" style="width: 420px;">
                                                        </div>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="sexe">Sexe <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control col-md-7 col-xs-12"
                                                                    required="required" name="sexe" id="sexe" style="width: 420px;">
                                                                <?php
                                                                if ($sexe == 'masculin') {
                                                                    echo '<option value="masculin" selected>' . 'Masculin' . '</option><option value="feminin" selected>' . 'Feminin' . '</option>';
                                                                } else {
                                                                    echo '<option value="feminin" selected>' . 'Feminin' . '</option><option value="masculin">' . 'Masculin' . '</option>';
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="type_user">Type <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control col-md-7 col-xs-12"
                                                                    required="required" name="type_user" id="type" style="width: 420px;">
                                                                <option value="3" <?php if ($type_user == 3) echo 'selected'; ?>>Utilisateur</option>
                                                                <option value="5" <?php if ($type_user == 5) echo 'selected'; ?>>Superviseur</option>
                                                                <option value="1" <?php if ($type_user == 1) echo 'selected'; ?>>Administrateur </option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                   
                                                 
                                                    <div class="item form-group hidden">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="login">Code <span class="required">*</span>
                                                        </label>
                                                          
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="hidden" name="exlogin"
                                                                   value="<?php echo $login; ?>">
                                                            <input type="text" id="login" name="login"
                                                                   value="<?php echo $login; ?>"
                                                                   class="form-control col-md-7 col-xs-12">
                                                        </div>


                                                    </div>
                                                  
                                                     <?php if ($_SESSION['type_user'] == 1) { ?>
                                                     <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Module<span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                         <input id="module_name" type="hidden" name="module_name" value="<?php echo  $module_name;?>">
                                                            <select name="module_dflt" id="module_dflt" class="form-control col-md-7 col-xs-12" required="required" style="width: 420px;">
                                                                    <option value="<?php echo  $module_dflt;?>" pos='<?php echo $valpos;?>'><?php echo  $module_name;?></option>
                                                                    
                                                                    <?php if (in_array('VMC', $_SESSION['actions']['code_actions'])&&$module_name!="Comptabilité") { ?>
                                                                        <option value="Caisse/index.php" pos='0'>Comptabilité</option>
                                                                    <?php } ?>
                                                                    <?php if (in_array('VMFACT', $_SESSION['actions']['code_actions'])&&$module_name!="Facturation") { ?>
                                                                        <option value="new/CodeOutput/index.php?pg=admin&view=module&do=fact" pos='1'>Facturation</option>
                                                                    <?php } ?>
                                                                    <?php if (in_array('VMH', $_SESSION['actions']['code_actions'])&&$module_name!="Hebergement") { ?>
                                                                        <option value="new/CodeOutput/index.php?pg=admin&view=module&do=heb2" pos='0'>Hebergement</option>
                                                                    <?php } ?>
                                                                    <?php if (in_array('VRH', $_SESSION['actions']['code_actions'])&&$module_name!="Ressources Humaines") { ?>
                                                                        <option value="new/CodeOutput/index.php?pg=admin&view=module&do=rh" pos='0'>Ressources Humaines</option>
                                                                    <?php } ?>
                                                                    <?php if (in_array('VMR', $_SESSION['actions']['code_actions'])&&$module_name!="Restaurant") { ?>
                                                                        <option value="restaurant2/index.php" pos='1'>Restaurant</option>
                                                                        <option value="restaurant2/cuisine.php" pos='0'>Cuisine</option>
                                                                        <option value="restaurant2/caissier.php" pos='0'>Caissier</option>
                                                                        <option value="restaurant2/bar.php" pos='0'>Bar</option>
                                                                    <?php } ?>
                                                                    <?php if (in_array('VMS', $_SESSION['actions']['code_actions'])&&$module_name!="Stock") { ?>
                                                                        <option value="Stock2/index.php" pos='0'>Stock</option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="item form-group posblc <?php echo $hidden2 ?>">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexe">Espace de vente<span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                           <select name="pos_id" id='pos_id' class="form-control col-md-7 col-xs-12" required="required" style="width: 420px;">
                                                                <?php  foreach ($pos as $p) {
                                                                    if($p->id_sousresto==$pos_id){
                                                                    ?>
                                                               <option value="<?php echo $p->id_sousresto ?>" selected="selected"><?php echo $p->libelle ?></option>
                                                                <?php }else{ ?>
                                                                   <option value="<?php echo $p->id_sousresto ?>"><?php echo $p->libelle ?></option>
                                                                 <?php } }?>
                                                           </select>
                                                        </div>
                                                    </div>
                                                     <?php } ?>

                                                    <?php
                                                    if ($type_user == 1 || $type_user == 3) {
                                                        if (isset($_GET['prfl'])) {
                                                            ?>
                                                            <div class="item form-group" style="display:none">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                       for="textarea">Actif <span
                                                                        class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <?php if ($actif == 1) { ?>
                                                                        <input name="etat" id="etat" value="1"
                                                                               type="checkbox" class="flat"
                                                                               checked="checked" required="required" style="width: 420px;">
                                                                    <?php } else { ?>
                                                                        <input name="etat" id="etat" type="checkbox"
                                                                               class="flat" required="required" style="width: 420px;">
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="item form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                       for="textarea">Actif <span
                                                                        class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <?php if ($actif == 1) { ?>
                                                                        <input name="etat" id="etat" value="1"
                                                                               type="checkbox" class="flat"
                                                                               checked="checked" required="required"style="width: 420px;">
                                                                    <?php } else { ?>
                                                                        <input name="etat" id="etat" type="checkbox"
                                                                               class="flat" required="required" style="width: 420px;">
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                   
                                 </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                    <button id="btn_edit_user" type="submit" class="btn btn-primary btn_edit_user">Valider</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- / modals -->
                    
                     <!-- Mot de passe modal -->
                    <div class="modal fade motdepasse_md" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content" id="modalcontentinfosuser">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span
                                            aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        Changement Login
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_message">
                                         <span id="message"></span>
                                    </div>
                                   <form  class="frm_mdpasse">
                                    <div class="form-group hidden">
                                            <label for="id_user" class="col-sm-4 control-label">Ancien</label>
                                            <div class="col-sm-8">
                                                <input id="agent_id" name="agent_id" type="text" maxlength="245" value="<?php echo $agent_id; ?>" class="form-control">
                                            </div>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label for="nouveau1" class="col-sm-4 control-label">Nouveau</label>
                                            <div class="col-sm-8">
                                                <input id="nouveau1" name="nouveau1" type="password" maxlength="245" value="" class="form-control">
                                            </div>
                                    </div>
                                    <br/><br/>
                                    <div class="form-group">
                                            <label for="nouveau2" class="col-sm-4 control-label">Confirmer</label>
                                            <div class="col-sm-8">
                                                <input id="nouveau2" name="nouveau2" type="password" maxlength="245" value="" class="form-control">
                                            </div>
                                    </div>
                                 </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                    <button type="button" class="btn btn-primary" id="mdp_modifier">Valider</button>
                                </div>
                            </div>
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
                                    <a href="#" class="btn btn-default" data-toggle="modal"
                                       data-target=".bs-example-modal-lg1" title="Toutes les connexions"><i
                                            class="fa fa-bars"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- start of user-activity-graph -->
                        <div id="graph_bar" style="width:100%; height:150px;">
                            <br/><br/>
                            <ul class="stats-overview">
                                <li>
                                    <span class="name"> Date derniere connexion </span>
                                    <span class="value text-success"> <?php echo $date_con; ?> </span>
                                </li>
                                <li>
                                    <span class="name"> Date derniere déconnexion </span>
                                    <span class="value text-success"> <?php echo $date_decon; ?> </span>
                                </li>
                               
                            </ul>

                        </div>
                        <!-- end of user-activity-graph -->


                        <!-- modals -->
                        <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form class="form-horizontal form-label-left" novalidate>
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Monitoring de toutes les
                                                connexions</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $requete = $bdd->prepare("SELECT * FROM connexion AS c,t_utilisateur AS u WHERE c.id_user=u.id_user AND c.id_user=:id_user ORDER BY date_con DESC ");
                                            $requete->BindParam(':id_user', $_GET['id_user']);
                                            $requete->execute();
                                            $connexion1 = $requete->fetchAll(PDO::FETCH_OBJ);
                                            ?>
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date de connexion</th>
                                                    <th>Date de déconnexion</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 1;
                                                foreach ($connexion1 as $con1): ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <?php echo $i ?>
                                                        </th>
                                                        <td>
                                                            <?php echo $con1->date_con ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $con1->date_decon ?>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; endforeach; ?>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer
                                            </button>
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
                        <?php
                        if ($type_user == 1 || $type_user == 3) {
                            if (isset($_GET['prfl'])) {
                                ?>
                                <div class="tab-content" id="bloc_groupe" style=" overflow: auto; height: 500px;">

                                    <?php include './groupe_user_aff.php'; ?>
                                </div>
                                <script src="datepicker/jquery.js"></script>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#checkAll').prop('disabled', true);
                                        $('.groupe_cls').prop('disabled', true);
                                    });
                                </script>
                            <?php
                            }else{
                            ?>
                                <div class="tab-content" id="bloc_groupe" style=" overflow: auto; height: 500px;">

                                    <?php include './groupe_user_aff.php'; ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
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


<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<!-- validator -->
<script src="vendors/validator/validator.min.js"></script>
<script>
    $(document).ready(function () {

       $("#modalcontentinfosuser").on('change', '#module_dflt', function (e) {
        e.preventDefault();
        var module_name = $('#module_dflt option:selected').text();
        $('#module_name').val(module_name);
        var pos=$('#module_dflt option:selected').attr('pos');
        if(pos=='0'){
            $('.posblc').addClass('hidden');
        }else{
           $('.posblc').removeClass('hidden'); 
        }
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
        $('#btn_edit_user').click(function(e) {
            e.preventDefault();
            var id_user = $('#id_user').val();
            var form = $('#form_user')[0];
            var data  = new FormData(form);
            $.ajax({
                url : 'utilisateur/modification_user.php',
                type : 'POST',
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.message =='succes') {
                            $('#msg_inf').show().fadeOut(8000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                        $('#msg_alert_inf').text('Modification effectuée avec succes!');
                        $('#maj_detail_user').load('detail_utilisateur_maj.php?id_user=' + id_user);

                    } else if (data.message=='champvide') {
                        $('#msg_inf').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert_inf').text('Veuillez remplir tous les champs vides!');
                    } else if (data.message == 'idexist') {
                        $('#msg_inf').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert_inf').text('Ce login existe déjà!')
                    }
                },
                dataType: 'json'
            });
          return false;
    });

        $('#btn_edit_pwd').click(function (e) {
            e.preventDefault();
            var donnees = $('#formpwd').serialize();
            $.ajax({
                url: './utilisateur/modification_pwd.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    if (data.message == 'succes') {
                        $('#msg1').show().fadeOut(8000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                        $('#msg_alert1').text('Mot de passe modifié avec succes!');

                    } else if (data.message == 'champvide') {
                        $('#msg1').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert1').text('Veuillez remplir tous les champs vides!');
                    } else if (data.message == 'noidem') {
                        $('#msg1').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert1').text('les deux mots de passe ne correspondent pas!');
                    }
                },
                dataType: 'json'
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
                },
                dataType: 'text'
            });
        });
        $("#bloc_groupe").on('click', '.groupes .groupe_cls', function (e) {

            var donnees = $('#form_grp_user_aff').serialize();
            $.ajax({
                url: './utilisateur/groupe_user_aff_traitement.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                },
                dataType: 'text'
            });

        });

        $('#mdp_modifier').click(function (e) {
            var donnees = $('.frm_mdpasse').serialize();
            var id_user = $('#agent_id').val();
            $.ajax({
                url: './utilisateur/verifmotdepasse.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    if(data.s){
                       $('#message').text(data.message);
                        $("#div_message").removeClass('hidden alert-danger');
                        $("#div_message").addClass('alert-success'); 
                        $('#maj_detail_user').load('detail_utilisateur_maj.php?id_user=' + id_user);
                    }else{
                        $("#div_message").removeClass('hidden');
                        $('#message').text(data.message);
                    }
                },
                dataType: 'json'
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

        ;
    });
</script>
<!-- /jQuery Smart Wizard -->
<?php include('gl_footer.php'); ?>
<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.m-callback .progress-bar').attr('data-transitiongoal', 0).progressbar({
            use_percentage: true,
            display_text: 'fill'
        });

        $('#m-callback-start').click(function () {
            //verification mot de passe ancien
            var old = $('#old').val();
            var id_user = $('#id_user').val();
            var donnees = 'old=' + old + '&id_user=' + id_user;
            $.ajax({
                url: './utilisateur/verifpwd.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    if (data.message == 'succes') {
                        //initialisation progressbar
                        $('.expassword').hide();
                        $('.pgbr').show();
                        var $pb = $('.m-callback .progress-bar');
                        $pb.attr('data-transitiongoal', $pb.attr('data-transitiongoal-backup'));
                        $pb.progressbar({

                            done: function () {
                                $pb.hide();
                                $('.pgbr').hide();
                                $('.password').show();
                            }
                        });

                    } else if (data.message == 'champvide') {
                        $('#msg1').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert1').text('Veuillez remplir ce champ!');
                    } else if (data.message == 'noidem') {
                        $('#msg1').show().fadeOut(8000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                        $('#msg_alert1').text("Ce mot de passe ne correspond pas à l'ancien!");
                    }

                },
                dataType: 'json'
            });


        });

    });
</script>
