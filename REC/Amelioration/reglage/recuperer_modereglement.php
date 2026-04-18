<?php
$requete = $bdd->prepare("SELECT  * FROM t_mode_reglement ");
$requete->execute();
$resultats = $requete->fetchAll(PDO::FETCH_OBJ);

