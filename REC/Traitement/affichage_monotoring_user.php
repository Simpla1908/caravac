<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$requete = $bdd->prepare("SELECT b.id_user, b.nom_user, b.prenom_user, c.id_con, DATE_FORMAT(c.date_con, '%d/%m/%Y à %Hh%imin%ss') AS date_con, DATE_FORMAT(c.date_decon, '%d/%m/%Y à %Hh%imin%ss') AS date_decon
FROM t_utilisateur AS b, connexion AS c
WHERE b.id_user=c.id_user AND b.id_hotel=:id_hotel ORDER BY c.date_con DESC");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
 
