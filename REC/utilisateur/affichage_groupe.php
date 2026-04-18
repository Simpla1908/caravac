<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
//include('../Amelioration/bdd/connexion .php');

$requete = $bdd->prepare("SELECT g.id, g.libelle AS groupe,m.id AS idmodule,m.nom AS module,h.id_hotel,h.nom_hotel AS hotel 
                            FROM groupe AS g,module AS m, t_hotel AS h
                            WHERE g.hotel_id=h.id_hotel AND g.module_id=m.id AND h.company_id=:company_id");
$requete->BindParam(':company_id',$_SESSION['company_id']);
$requete->execute();
$groupes = $requete->fetchAll(PDO::FETCH_OBJ);
