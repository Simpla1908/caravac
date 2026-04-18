<?php
 if (!isset($_SESSION)) {
    session_start();
}
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