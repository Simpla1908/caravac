<?php
$requete = $bdd->prepare("SELECT  * FROM ` monnaie` AS m WHERE m.id_hotel=:id_hotel AND m.lib_monnaie=:lib_monnaie ");
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->BindParam(':lib_monnaie',$m_affiche);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $op) {
    $id_monnaie= $op->id_monnaie;
}