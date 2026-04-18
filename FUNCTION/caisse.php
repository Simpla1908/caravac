<?php

function affiche_montant($m_affiche1, $tauxdollar1, $mont_fc, $mont_usd) {
    if ($m_affiche1 == 'USD') {
        $mont = $mont_usd + ($mont_fc / $tauxdollar1);
        return $mont;
    } else{
        $mont = $mont_fc + ($mont_usd * $tauxdollar1);
        return $mont;
    }
}
function dateAffiche($stringdate) {
    if($stringdate!=''){
        $stringdate = trim($stringdate);
        $tmp = explode("-",$stringdate);
        $date_iso =$tmp[2]."/".$tmp[1]."/".$tmp[0];
        return $date_iso;
    }
}
function format_chiffre($mon) {
    
    return number_format($mon,0,',','.');
}
