<?php
include '../traitement/requette_abonnement.php';
if (!empty($_GET['id']) && $_GET['id'] >= 0) {
    $id=$_GET['id'];
    $requete = $bdd->prepare($req_moduleBysite);
    $requete->BindParam(':id_c',$id );
    $requete->execute();
    $req_moduleBysite = $requete->fetchAll(PDO::FETCH_OBJ);
    
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_c',$id );
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
} else {
    $requete = $bdd->prepare("SELECT mc.id AS idmodcomp,h.id_hotel, h.nom_hotel, c.nom_c,c.id_c, h.etat, COUNT(module_id) AS module, SUM(mc.montantmodule) AS montant,mc.site_id FROM t_hotel AS h, t_company AS c, t_modulecompany AS mc WHERE  h.company_id=c.id_c AND mc.site_id=h.id_hotel GROUP BY mc.site_id");
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
}
