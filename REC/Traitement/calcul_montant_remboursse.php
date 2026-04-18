<?php

$date1 = $date_res;
$date2 = date('Y-m-d H:i:s');

$time1 = strtotime($date1);
$time2 = strtotime($date2);
if ($time1 > $time2) {
    $time = $time1 - $time2;
} else {
    $time = $time2 - $time1;
}

$time = $time / 3600;
$nbr_heures = round($time);
//                    $obj_datedebut = date_create($date_res);
//$obj_datefin = date_create('2016-12-08 14:24:41');
//$n = 0;
//for ($datex = clone $obj_datedebut; $datex->format('U') < $obj_datefin->format('U'); $datex->modify('+1 hour')) {
//	$n++;
//}
// 
//echo $nn=$n . ' heures et ' . round(($obj_datefin->format('U') - ($datex->format('U'))) / 60) . ' minutes';


$strStart = $date_res;
$strEnd = date('Y-m-d H:i:s');
$strEnd1 = date('Y-m-d');

$dteStart = new DateTime($strStart);
$dteEnd = new DateTime($strEnd);

$dteDiff = $dteStart->diff($dteEnd);

$minite = $dteDiff->format("%I");
//                    $date_res1 = explode(':', $heure);


$Nombres_jours = NbJours($strEnd1, $dte_a);
$nb_jrs = $Nombres_jours;
$nb_jr = $nb_jrs - 1;
if ($nb_jr == 0) {
    $nb_jr++;
}
$nbre_jr = $nb_jr;
//                    $id_hotel=79;
$requete_res = $bdd->prepare("SELECT * FROM  t_reglage WHERE id_hotel=:id_hotel");
$requete_res->BindParam(':id_hotel', $id_hotel);
$requete_res->execute();
while ($donnees = $requete_res->fetch()) {
    $pourcentage_24_heure = $donnees['pourcentage_24_heure'];
    $pourcentage_48_heure = $donnees['pourcentage_48_heure'];
    $pourcentage_72_heure = $donnees['pourcentage_72_heure'];
    $pourcentage_sup_72_heure = $donnees['pourcentage_sup_72_heure'];
}

if ($nbr_heures >= 0 && $nbr_heures <= 24) {
    $poucentage = $pourcentage_24_heure;
    $_SESSION['poucentage'] = $poucentage;
    $montant_pourcentage = round(($pourcentage_24_heure / 100) * $som_mont_p);
    $_SESSION['montant_pourcentage'] = $montant_pourcentage;
    $mont_remb = round($som_mont_p - $montant_pourcentage);
    $_SESSION['mont_remb'] = $mont_remb;
    
} elseif ($nbr_heures >= 24 && $nbr_heures <= 48) {
    $poucentage = $pourcentage_48_heure;
    $_SESSION['poucentage'] = $poucentage;
    $montant_pourcentage = round(($pourcentage_48_heure / 100) * $som_mont_p);
    $_SESSION['montant_pourcentage'] = $montant_pourcentage;
    $mont_remb = round($som_mont_p - $montant_pourcentage);
    $_SESSION['mont_remb'] = $mont_remb;
    
} elseif ($nbr_heures >= 48 && $nbr_heures <= 72) {
    $poucentage = $pourcentage_72_heure;
    $_SESSION['poucentage'] = $poucentage;
    $montant_pourcentage = round(($pourcentage_72_heure / 100) * $som_mont_p);
    $_SESSION['montant_pourcentage'] = $montant_pourcentage;
    $mont_remb = round($som_mont_p - $montant_pourcentage);
    $_SESSION['mont_remb'] = $mont_remb;
    
} else {
    $poucentage = $pourcentage_72_heure;
    $_SESSION['poucentage'] = $poucentage;
    $montant_pourcentage = round(($pourcentage_72_heure / 100) * $som_mont_p);
    $_SESSION['montant_pourcentage'] = $montant_pourcentage;
    $mont_remb = round($som_mont_p - $montant_pourcentage);
    $_SESSION['mont_remb'] = $mont_remb;
}
                    