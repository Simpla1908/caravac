
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_chambre
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Chambre</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Num Ch</td>
	<td>'.$rows->num_ch.'</td>
  	</tr>
    <tr>
	<td>Etat Ch</td>
	<td>'.$rows->etat_ch.'</td>
  	</tr>
    <tr>
	<td>Tarif Ch</td>
	<td>'.$rows->tarif_ch.'</td>
  	</tr>
    <tr>
	<td>Monnaie</td>
	<td>'.$rows->monnaie.'</td>
  	</tr>
    <tr>
	<td>Reserve</td>
	<td>'.$rows->reserve.'</td>
  	</tr>
    <tr>
	<td>Occupe</td>
	<td>'.$rows->occupe.'</td>
  	</tr>
    <tr>
	<td>Libre</td>
	<td>'.$rows->libre.'</td>
  	</tr>
    <tr>
	<td>Capacite Init</td>
	<td>'.$rows->capacite_init.'</td>
  	</tr>
    <tr>
	<td>Capacite</td>
	<td>'.$rows->capacite.'</td>
  	</tr>
    <tr>
	<td>Categorie</td>
	<td>'.$rows->categorie.'</td>
  	</tr>
    <tr>
	<td>Niveau</td>
	<td>'.$rows->niveau.'</td>
  	</tr>
    <tr>
	<td>Id Hotel</td>
	<td>'.$rows->id_hotel.'</td>
  	</tr>
    <tr>
	<td>Del</td>
	<td>'.$rows->del.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_chambre_'.date('Y-m-d').'.doc';
	$filename2= 't_chambre_'.date('Y-m-d').'.xls';
	$pdf_output= 't_chambre_'.date('Y-m-d').'.pdf';
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
	