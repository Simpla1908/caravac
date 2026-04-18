<?php
$json = array();
$json['s'] = False;
$periode = $_POST['periode'];
/* Conversion periode */
$transpostion_periode = explode(' ', $periode);
$date1 = $transpostion_periode[0];
$caractere = $transpostion_periode[1];
$date2 = $transpostion_periode[2];
/* Conversion date1 */
$transpostion_date1 = explode('/', $date1);
$jour = $transpostion_date1[0];
$mois = $transpostion_date1[1];
$annee = $transpostion_date1[2];
$date_bd1 = $annee . '-' . $mois . '-' . $jour;
/* Conversion date2 */
$transpostion_date2 = explode('/', $date2);
$jour2 = $transpostion_date2[0];
$mois2 = $transpostion_date2[1];
$annee2 = $transpostion_date2[2];
$date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
$json['date_bd1'] = $date_bd1;
$json['date_bd2'] = $date_bd2;
echo json_encode($json);
