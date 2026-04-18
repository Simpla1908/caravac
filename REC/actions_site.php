<?php
//ini_set('display_errors',1);
// unset($_SESSION['actions']);
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['actions'] = array();
$_SESSION['actions']['code_actions'] = array();

if ($_SESSION['type_user']==1){ // Pour le compte de SuperAdmin
    //recuperation de tout le modules souscript
    $requete = $bdd->prepare("SELECT c.module_id FROM  t_modulecompany AS c WHERE c.etat_module=1 AND c.company_id=:id_c AND c.site_id=:id_site");
        $requete->BindParam(':id_c', $_SESSION['company_id']);
        $requete->BindParam(':id_site', $id_site);
        $requete->execute();
        $modules = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($modules as $mod) {
            $module_id = $mod->module_id;

            //recuperation de toutes les actions des mobules
            $requete = $bdd->prepare("SELECT a.code_act FROM actions AS a WHERE a.module_id=:module_id");
            $requete->BindParam(':module_id', $module_id);
            $requete->execute();
            $operations = $requete->fetchAll(PDO::FETCH_OBJ);
            $i = 0;

            foreach ($operations as $op) {
                $actions = $op->code_act;
                if (!in_array($actions, $_SESSION['actions']['code_actions'])) {
                    array_push($_SESSION['actions']['code_actions'], $actions);
                }
                $i++;
            }
        }
}  else {
    // Pour le compte d'un user simple
    $requete = $bdd->prepare("SELECT * FROM users_groupes AS ug WHERE ug.user_id=:user_id AND ug.hotel_id=:hotel_id");
    $requete->BindParam(':user_id', $_SESSION['id_user']);
    $requete->BindParam(':hotel_id', $_GET['id_site']);
    $requete->execute();
    $groupe = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($groupe as $grp) {
        $group_id = $grp->group_id;

        //recuperation de toutes les actions du groupe
        $requete = $bdd->prepare("SELECT a.code_act FROM actions AS a,actions_groupe AS ag,module m WHERE ag.action_id=a.id_act AND a.module_id=m.id AND ag.group_id=:group_id AND a.module_id IN(SELECT m.id FROM module m,t_modulecompany AS mc WHERE mc.module_id=m.id AND mc.etat_module=1)");
        $requete->BindParam(':group_id', $group_id);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        $i = 0;

        foreach ($operations as $op) {
            $actions = $op->code_act;
            if (!in_array($actions, $_SESSION['actions']['code_actions'])) {
                array_push($_SESSION['actions']['code_actions'], $actions);
            }
            $i++;
        }
    }
    $a=0;
}

//mise a jours du champs default_site

//$company_id = $_SESSION['company_id'] ;
//$requete = $bdd->prepare("SELECT h.id_hotel,h.nom_hotel,h.default_site FROM  t_hotel h WHERE h.company_id=:company_id");
//$requete->BindParam(':company_id', $company_id);
//$requete->execute();
//$sites = $requete->fetchAll(PDO::FETCH_OBJ);
//foreach ($sites as $s){
// if($id_site==$s->id_hotel){
//     $default_site=1;
//     $requete=$bdd->prepare("UPDATE t_hotel SET default_site=:default_site WHERE id_hotel=:id_hotel");
//    $requete->BindParam(':default_site', $default_site);
//    $requete->BindParam(':id_hotel', $id_site);
//    $requete->execute();
// }  else {
//     $default_site=0;
//      $requete=$bdd->prepare("UPDATE t_hotel SET default_site=:default_site WHERE id_hotel=:id_hotel");
//    $requete->BindParam(':default_site', $default_site);
//    $requete->BindParam(':id_hotel', $s->id_hotel);
//    $requete->execute();
// }
//
//}