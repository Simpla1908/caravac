<?php

session_start();
include("../../bdd/connexion.php");
$id_res=$_GET['id_res'];
$requete = $bdd->prepare("SELECT a.id_client,a.nom_client FROM t_client AS a, t_client_reserve AS b WHERE a.id_client=b.id_client AND b.id_res=:id_res AND b.responsable IN(0,1)");
$requete->BindParam(':id_res',$id_res);
$requete->execute();
$clients= $requete->fetchAll(PDO::FETCH_OBJ);
 foreach ($clients as $cl):?>
    <option value="<?php echo $cl->id_client; ?>"><?php echo $cl->nom_client; ?></option>
 <?php
 endforeach;

?>
