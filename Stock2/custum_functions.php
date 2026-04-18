<?php
//DATETIME
/* ça une chaine de format datetime et retourne une date au format désiré*/
function format_stringdateTodatetime($format1,$stringdate,$format2){ 
    if ($stringdate != '') {
        $date = DateTime::createFromFormat($format1,$stringdate);
        return $date->format($format2);
    } else {
        return "00-00-0000";
    }
}

