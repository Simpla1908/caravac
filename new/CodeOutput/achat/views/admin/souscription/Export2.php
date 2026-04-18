
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		souscription
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Souscription</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Compagny Id</td>
	<td>'.$rows->compagny_id.'</td>
  	</tr>
    <tr>
	<td>Libelle</td>
	<td>'.$rows->libelle.'</td>
  	</tr>
    <tr>
	<td>Date Sous</td>
	<td>'.$rows->date_sous.'</td>
  	</tr>
    <tr>
	<td>Date Activ</td>
	<td>'.$rows->date_activ.'</td>
  	</tr>
    <tr>
	<td>Mode Paie</td>
	<td>'.$rows->mode_paie.'</td>
  	</tr>
    <tr>
	<td>Montant Tot Sous</td>
	<td>'.$rows->montant_tot_sous.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'souscription_'.date('Y-m-d').'.doc';
	$filename2= 'souscription_'.date('Y-m-d').'.xls';
	$pdf_output= 'souscription_'.date('Y-m-d').'.pdf';
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
	