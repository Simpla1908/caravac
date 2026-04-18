<?php

$company =  $_SESSION['company_id'];
$id_site = $_GET['id_hotel'] ;
requete = $bdd->prepare("SELECT c.nbreuser,m.id,m.nom,m.code FROM  t_modulecompany AS c,module AS m WHERE c.company_id=:id_c AND c.site_id=:id_site AND c.module_id=m.id ORDER BY m.nom ASC");
$requete->BindParam(':id_c', $company);
$requete->BindParam(':id_site', $id_site);
$requete->execute();
$module_tuples = $requete->fetchAll(PDO::FETCH_OBJ);
