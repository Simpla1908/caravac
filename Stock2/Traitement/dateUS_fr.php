<?php
/* Configure le script en français */
setlocale (LC_TIME, 'fr_FR','fra');
//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
date_default_timezone_set("Europe/Paris");
//Definit l'encodage interne
mb_internal_encoding("UTF-8");

//Convertir une date US vers une date en français affichant le jour de la semaine
function dateLongue($date,$heure = 'yes'){
    if($heure == 'yes')
    {
    $strDate = mb_convert_encoding('%A %d %B %Y à %Hh%M','ISO-8859-9','UTF-8');  
    }
    else
    {
    $strDate = mb_convert_encoding('%A %d %B %Y','ISO-8859-9','UTF-8');    
    }
    return iconv("ISO-8859-9","UTF-8",strftime($strDate ,strtotime($date))); 
}

//$date1 = '2010-01-05 10:11:54';
//echo dateLongue($date1); //Affiche mardi 05 janvier 2010 10h11 
//$date2 = '2010-01-05';
//echo dateLongue($date2,'no'); //Affiche mardi 05 janvier 2010
