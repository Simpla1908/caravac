<?php
//Recuperation de motif_id, necessaire pour la communication d'hebergement,resto et caisse
$motif_id_heb=0;
$motif_id_resto=0;
$requete = $bdd->prepare("SELECT  *,m.idmotif AS motif_id FROM t_motif AS m,t_motif_type AS mt 
                          WHERE m.type_id=mt.idmotiftype AND m.hotel_id=:id_hotel");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$reglages = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($reglages as $op) {
    if($op->designation=='Hebergement'){
        $motif_id_heb=$op->motif_id;
    }else{
        $motif_id_resto=$op->motif_id;
    }
}
