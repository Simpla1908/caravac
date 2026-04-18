<?php
include '../bdd/connexion.php';
$module = $_POST['module'];
$souscription =$_POST['souscription'];
$nombre_user =$_POST['nombre_user'];
$nbre_agent =$_POST['prix_agent'];
$requete = $bdd->prepare("SELECT prix_user,prix_par_user,prix_user2,prix_par_user2 FROM  prix WHERE module_id=:module  AND souscription=:souscription");
$requete->BindParam(':module',$module);
$requete->BindParam(':souscription',$souscription);
$requete->execute();
$prix= $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($prix as $p) {
//    if($nbre_agent==2){
//        $prix_user = $p->prix_user2;
//        $prix_par_user = $p->prix_par_user2;
//    }else {
//        $prix_user = $p->prix_user;
//        $prix_par_user = $p->prix_par_user;
//    }
    if(($nbre_agent>0)&&($nbre_agent<500)){
        $prix_user = $nbre_agent*$p->prix_user2;
        $prix_par_user = $nbre_agent*$p->prix_par_user2;
    }elseif($nbre_agent>=500) {
        $prix_user = $nbre_agent*$p->prix_user;
        $prix_par_user = $nbre_agent*$p->prix_par_user;
    }else {
        $prix_user = $p->prix_user;
        $prix_par_user = $p->prix_par_user;
    }

}
if($nombre_user>3){
	//echo '$'.$prix_user+(($nombre_user-3)*$prix_par_user);
	echo ($prix_user+(($nombre_user-3)*$prix_par_user));
} else if($nombre_user=3){
echo $prix_user;	
}

else if($nombre_user<3){
	$prix_user=0;
	echo $prix_user;
}
