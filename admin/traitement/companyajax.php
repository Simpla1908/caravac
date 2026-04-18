<?php
include '../../bdd/connexion.php';
if(!empty( $_POST['motif']) && $_POST['motif']=='company'){
        $id=(int)$_POST['id'];
        $etat=(int)$_POST['etat'];
        $requete = $bdd->prepare("UPDATE t_hotel SET etat=:etat WHERE id_hotel=:id_c");
        $requete->BindParam(':etat',$etat);
        $requete->BindParam(':id_c',$id);
        $requete->execute();
}  else {
    $id=(int)$_POST['id'];
    $etat=(int)$_POST['etat'];
    $requete = $bdd->prepare("UPDATE t_modulecompany SET etat_module=:etat_module WHERE id=:id");
    $requete->BindParam(':etat_module',$etat);
    $requete->BindParam(':id',$id);
    $requete->execute();
}
