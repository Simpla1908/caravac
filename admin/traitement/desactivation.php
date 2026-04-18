<?php
//$data = array();
//$ojrd8=  date('Y-m-d');
//$data['idmodulecompany'] = array();

$requete = $bdd->prepare($req_listmodulesAdesactiver);
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);


//foreach ($resultats as $r){
//    $dte_blocage=$r->dte_blocage;
//    if ($r->etat_module == 1 && $ojrd8 >=$dte_blocage && $dte_blocage!=''){
//        array_push($data['idmodulecompany'],$r->idmodule);
//    }
//    
//}

