<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$requete = $bdd->prepare("SELECT m.id,m.nom FROM module AS m,t_modulecompany AS mc  WHERE mc.module_id=m.id AND mc.etat_module=1 AND mc.site_id=:site_id");
$requete->BindParam(':site_id',$_SESSION['id_hotel']);
$requete->execute();
$modules = $requete->fetchAll(PDO::FETCH_OBJ);
