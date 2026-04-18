<?php
if ($do == 'liste'){
    $id_fiche = $_GET['id_fiche'];
    $num_bon = $_GET['num_bon'];
    $depot_id = $_GET['depot_id'];
    $requete = $bdd->prepare("SELECT  * FROM skt_fiche AS a,t_validation AS b,stk_produit AS c WHERE a.id_fiche=b.fiche_id AND b.produit_id=c.idprod AND a.id_fiche=:id_fiche ORDER BY a.id_fiche ASC");
    $requete->BindParam(':id_fiche', $id_fiche);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    include($pathview . 'fichestk/liste.php');
}