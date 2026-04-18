
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reserve_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	<?php
	$etype=get('etype');
	$excel='
	<p style="font-family:arial; font-size:18px;" align="left">
	<strong style="font-family:arial;">'.LANG_REPORT_TITLE.'</strong><br>'.LANG_REPORT_SUB_TITLE.'<br>
	<strong>'.LANG_REPORT_TABLE.'</strong> T Reserve Chambre</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Idreserv</td>
	<td>'.$rows->idreserv.'</td>
  	</tr>
    <tr>
	<td>Idchambre</td>
	<td>'.$rows->idchambre.'</td>
  	</tr>
    <tr>
	<td>Id Client</td>
	<td>'.$rows->id_client.'</td>
  	</tr>
    <tr>
	<td>Id Accomp</td>
	<td>'.$rows->id_accomp.'</td>
  	</tr>
    <tr>
	<td>Statut</td>
	<td>'.$rows->statut.'</td>
  	</tr>
    <tr>
	<td>Occupe</td>
	<td>'.$rows->occupe.'</td>
  	</tr>
    <tr>
	<td>Date Occ</td>
	<td>'.$rows->date_occ.'</td>
  	</tr>
    <tr>
	<td>Date Lib</td>
	<td>'.$rows->date_lib.'</td>
  	</tr>
    <tr>
	<td>Annule</td>
	<td>'.$rows->annule.'</td>
  	</tr>
    <tr>
	<td>Est Responsable</td>
	<td>'.$rows->est_responsable.'</td>
  	</tr>
    <tr>
	<td>Mont Paye Heb</td>
	<td>'.$rows->mont_paye_heb.'</td>
  	</tr>
    <tr>
	<td>Mont Paye Resto</td>
	<td>'.$rows->mont_paye_resto.'</td>
  	</tr>
    <tr>
	<td>Monnaie</td>
	<td>'.$rows->monnaie.'</td>
  	</tr>
    <tr>
	<td>Tarif Ch</td>
	<td>'.$rows->tarif_ch.'</td>
  	</tr>
    <tr>
	<td>Nom Accomp</td>
	<td>'.$rows->nom_accomp.'</td>
  	</tr>
    <tr>
	<td>Checkin</td>
	<td>'.$rows->checkin.'</td>
  	</tr>
    <tr>
	<td>Checkout</td>
	<td>'.$rows->checkout.'</td>
  	</tr>
    <tr>
	<td>Idfact</td>
	<td>'.$rows->idfact.'</td>
  	</tr>
    <tr>
	<td>Id Hotel</td>
	<td>'.$rows->id_hotel.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_reserve_chambre_'.date('Y-m-d').'.doc';
	$filename2= 't_reserve_chambre_'.date('Y-m-d').'.xls';
	$pdf_output= 't_reserve_chambre_'.date('Y-m-d').'.pdf';
	if ($etype == 'word') {
	header("Content-type: application/msword");
	header("Content-Disposition: attachment; filename=$filename1");
	header("Pragma: no-cache");
	header("Expires: 0");
	print $excel;
	}
	elseif ($etype == 'excel') {
	header("Content-type: application/msexcel");
	header("Content-Disposition: attachment; filename=$filename2");
	header("Pragma: no-cache");
	header("Expires: 0");
	print $excel;
	}
	elseif ($etype == 'printer') {
	print'<title>'.H_TITLE.'</title>
	<script type="text/javascript">
	window.onload = function () {
		window.print();
	}
	</script>
	';
	print $excel;
	}
	