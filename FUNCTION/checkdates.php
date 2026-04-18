<?php
function checkdates($date_actu,$date_occ,$date_lib){
	$booleen='true';
	if($date_actu>$date_occ)$booleen='false';
	if($date_actu>$date_lib)$booleen='false';
	if($date_occ>$date_lib)$booleen='false';
	return $booleen;
	}
?>
