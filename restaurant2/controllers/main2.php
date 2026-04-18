<?php
$pathview = "./views/";
if (!isset($_SESSION)){
    session_start();
    include('../bdd/connexion.php');
    include '../../FUNCTION/hebergement.php';
    include'../../FUNCTION/restaurant.php';
    include('../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
    $pathview = "../views/";
}
$_SESSION['lastload'] = time(); 
if (isset($_GET['ss']) && ($_SESSION['type_user']==1 
        || in_array('VFTSR',$_SESSION['actions']['code_actions']))){
    $default = 1;
    $pos_id = $_GET['ss'];
    infosPos($pos_id, $default, $bdd);
}else{
    if ($_SESSION['type_user'] == 1) {
        $default = 0;
        $id = 0;
        infosPos($id, $default, $bdd);
    } elseif ($_SESSION['pos_id'] != 0) {
        $default = 1;
        infosPos($_SESSION['pos_id'], $default, $bdd);
    }
}
$page = get1('p');
$do = get1('d');
$_SESSION['url_pg']=$page;
$id_sousresto=$_SESSION['id_sousresto'];
$type = 'restaurant';
$m_affiche = $_SESSION['m_affiche'];
$libeR = 'restoR';
$json = array();
$json['succes'] = False;
$monnaie = getsymbole_local();
$taux_op = $_SESSION['taux_resto'];
if($page=='facture') {
    if (get1('ajx')=='1') {
        include './facture.php';
    } else {
        include './controllers/facture.php';
    }
}else if($page=='versement'){
  if (get1('ajx')=='1') {
        include './versement.php';
    } else {
        include './controllers/versement.php';
    }  
}else if($page=='plat'){
  if (get1('ajx')=='1') {
        include './plat.php';
    } else {
        include './controllers/plat.php';
    }  
}else if($page=='fstk'){
  if (get1('ajx')=='1'){
        include './fichestk.php';
    }else{
        include './controllers/fichestk.php';
    }  
}else if($page=='fdc'){
  if (get1('ajx')=='1') {
        include './fdc.php';
    } else {
        include './controllers/fdc.php';
    }  
}else if($page=='rapport'){
  if (get1('ajx')=='1') {
        include './rapport.php';
    } else {
        include './controllers/rapport.php';
    }  
}else if($page=='depense'){
  if (get1('ajx')=='1') {
        include './depense.php';
    } else {
        include './controllers/depense.php';
    }  
}else if($page=='couverts'){
    if (get1('ajx')=='1') {
          include './couverts.php';
      } else {
          include './controllers/couverts.php';
      }  
}else if($page=='extrait'){
    if (get1('ajx')=='1') {
          include './extrait.php';
      } else {
          include './controllers/extrait.php';
      }  
}
