
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_annule_reservation
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Annule Reservation</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Id Res</td>
	<td>'.$rows->id_res.'</td>
  	</tr>
    <tr>
	<td>Id Ch</td>
	<td>'.$rows->id_ch.'</td>
  	</tr>
    <tr>
	<td>Id User</td>
	<td>'.$rows->id_user.'</td>
  	</tr>
    <tr>
	<td>Id Regl</td>
	<td>'.$rows->id_regl.'</td>
  	</tr>
    <tr>
	<td>Montant Retirer</td>
	<td>'.$rows->Montant_retirer.'</td>
  	</tr>
    <tr>
	<td>Monnaie</td>
	<td>'.$rows->monnaie.'</td>
  	</tr>
    <tr>
	<td>Poucentage</td>
	<td>'.$rows->poucentage.'</td>
  	</tr>
    <tr>
	<td>Mont Remb</td>
	<td>'.$rows->mont_remb.'</td>
  	</tr>
    <tr>
	<td>Date Annule Res</td>
	<td>'.$rows->date_annule_res.'</td>
  	</tr>
    <tr>
	<td>Date Annule</td>
	<td>'.$rows->date_annule.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_annule_reservation_'.date('Y-m-d').'.doc';
	$filename2= 't_annule_reservation_'.date('Y-m-d').'.xls';
	$pdf_output= 't_annule_reservation_'.date('Y-m-d').'.pdf';
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
	