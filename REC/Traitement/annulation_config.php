<?php
session_start();
include('../../bdd/connexion.php');
$json = array();

$site_id = $_POST['site_id'];
$type_annulation ='personalise';
$fcon_heberge=1;

//if($type_annulation=='par defaut'){
//    if(isset($_POST['pour_defaut'])){
//        
//    $pour_defaut = $_POST['pour_defaut'];
//    $pour_24=0;
//    $pour_48=0;
//    $pour_72=0;
//    $pour_sup_72=0;
//    //mise a jour table reglage
//    $requete = $bdd->prepare("UPDATE t_reglage SET type_annul=:type_annul,pourcentage_defaut=:pourcentage_defaut,pourcentage_24_heure=:pourcentage_24_heure,pourcentage_48_heure=:pourcentage_48_heure,pourcentage_72_heure=:pourcentage_72_heure,pourcentage_sup_72_heure=:pourcentage_sup_72_heure,fcon_heberge=:fcon_heberge WHERE id_hotel=:id_hotel");
//    $requete->BindParam(':type_annul',$type_annulation);
//    $requete->BindParam(':pourcentage_defaut',$pour_defaut);
//    $requete->BindParam(':pourcentage_24_heure',$pour_24);
//    $requete->BindParam(':pourcentage_48_heure',$pour_48);
//    $requete->BindParam(':pourcentage_72_heure',$pour_72);
//    $requete->BindParam(':pourcentage_sup_72_heure',$pour_sup_72);
//    $requete->BindParam(':fcon_heberge',$fcon_heberge);
//    $requete->BindParam(':id_hotel', $site_id);
//    $requete->execute();
//    $json['message'] = 'succes';
//    }
//} else {

    if (isset($_POST['check_pour_24'])) {
        $check_pour_24 = $_POST['check_pour_24'];
        $pour_24 = $_POST['pour_24'];
        $pour_defaut=0;
        
        $requete = $bdd->prepare("UPDATE t_reglage SET type_annul=:type_annul,pourcentage_defaut=:pourcentage_defaut,pourcentage_24_heure=:pourcentage_24_heure,fcon_heberge=:fcon_heberge WHERE id_hotel=:id_hotel");
        $requete->BindParam(':type_annul',$type_annulation);
        $requete->BindParam(':pourcentage_defaut',$pour_defaut);
        $requete->BindParam(':pourcentage_24_heure',$pour_24);
        $requete->BindParam(':fcon_heberge',$fcon_heberge);
        $requete->BindParam(':id_hotel', $site_id);
        $requete->execute();
    }
    if (isset($_POST['check_pour_48'])) {
        $check_pour_48 = $_POST['check_pour_48'];
        $pour_48 = $_POST['pour_48'];
        $pour_defaut=0;
        
        $requete = $bdd->prepare("UPDATE t_reglage SET type_annul=:type_annul,pourcentage_defaut=:pourcentage_defaut,pourcentage_48_heure=:pourcentage_48_heure,fcon_heberge=:fcon_heberge WHERE id_hotel=:id_hotel");
        $requete->BindParam(':type_annul',$type_annulation);
        $requete->BindParam(':pourcentage_defaut',$pour_defaut);
        $requete->BindParam(':pourcentage_48_heure',$pour_48);
        $requete->BindParam(':fcon_heberge',$fcon_heberge);
        $requete->BindParam(':id_hotel', $site_id);
        $requete->execute();
    }
    if (isset($_POST['check_pour_72'])) {
        $check_pour_72 = $_POST['check_pour_72'];
        $pour_72 = $_POST['pour_72'];
        $pour_defaut=0;
        
        $requete = $bdd->prepare("UPDATE t_reglage SET type_annul=:type_annul,pourcentage_defaut=:pourcentage_defaut,pourcentage_72_heure=:pourcentage_72_heure,fcon_heberge=:fcon_heberge WHERE id_hotel=:id_hotel");
        $requete->BindParam(':type_annul',$type_annulation);
        $requete->BindParam(':pourcentage_defaut',$pour_defaut);
        $requete->BindParam(':pourcentage_72_heure',$pour_72);
        $requete->BindParam(':fcon_heberge',$fcon_heberge);
        $requete->BindParam(':id_hotel', $site_id);
        $requete->execute();
    }
    if (isset($_POST['check_pour_sup_72'])) {
        $check_pour_sup_72 = $_POST['check_pour_sup_72'];
        $pour_sup_72 = $_POST['pour_sup_72'];
        $pour_defaut=0;
        
        $requete = $bdd->prepare("UPDATE t_reglage SET type_annul=:type_annul,pourcentage_defaut=:pourcentage_defaut,pourcentage_sup_72_heure=:pourcentage_sup_72_heure,fcon_heberge=:fcon_heberge WHERE id_hotel=:id_hotel");
        $requete->BindParam(':type_annul',$type_annulation);
        $requete->BindParam(':pourcentage_defaut',$pour_defaut);
        $requete->BindParam(':pourcentage_sup_72_heure',$pour_sup_72);
        $requete->BindParam(':fcon_heberge',$fcon_heberge);
        $requete->BindParam(':id_hotel', $site_id);
        $requete->execute();
    }
    $json['message'] = 'succes';
//}
echo json_encode($json);
 