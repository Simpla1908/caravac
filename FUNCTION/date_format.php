<?php

function date_formatee($dte)
{
$date = new DateTime($dte);
$date_format= $date->format('d/m/Y');
return $date_format;
}