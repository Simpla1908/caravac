<?php
$num_com=0;
$requete = $bdd->prepare("SELECT num_com FROM  t_reservation WHERE statut_res=:statut_res AND id_hotel=:id_hotel ORDER BY id_res DESC LIMIT 1");
$requete->BindParam(':statut_res', $statut_res);
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$result = $requete->fetchALL(PDO::FETCH_OBJ);
$nbre=count($result);
if ($nbre==0) {
    $num_com = 1;
} else {
    foreach ($result as $op) {
       $num_com = $op->num_com;
    }
}


    