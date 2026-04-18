<?php
$nbrsiteactif=0;
$requete = $bdd->prepare("SELECT COUNT(*) AS nbrsiteactif FROM t_hotel  WHERE company_id=:company_id AND etat=1");
$requete->BindParam(':company_id',$u->company_id);
$requete->execute();
$f = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($f as $f)$nbrsiteactif=$f->nbrsiteactif;