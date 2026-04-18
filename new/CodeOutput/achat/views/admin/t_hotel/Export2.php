
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_hotel
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Hotel</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Nom Hotel</td>
	<td>'.$rows->nom_hotel.'</td>
  	</tr>
    <tr>
	<td>Adresse Hotel</td>
	<td>'.$rows->adresse_hotel.'</td>
  	</tr>
    <tr>
	<td>Province Hotel</td>
	<td>'.$rows->province_hotel.'</td>
  	</tr>
    <tr>
	<td>Ville Hotel</td>
	<td>'.$rows->ville_hotel.'</td>
  	</tr>
    <tr>
	<td>Etat</td>
	<td>'.$rows->etat.'</td>
  	</tr>
    <tr>
	<td>Default Site</td>
	<td>'.$rows->default_site.'</td>
  	</tr>
    <tr>
	<td>Company Id</td>
	<td>'.$rows->company_id.'</td>
  	</tr>
    <tr>
	<td>Statut Site</td>
	<td>'.$rows->statut_site.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_hotel_'.date('Y-m-d').'.doc';
	$filename2= 't_hotel_'.date('Y-m-d').'.xls';
	$pdf_output= 't_hotel_'.date('Y-m-d').'.pdf';
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
	