
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		paiement
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Paiement</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Montant</td>
	<td>'.$rows->montant.'</td>
  	</tr>
    <tr>
	<td>Montantusd</td>
	<td>'.$rows->montantusd.'</td>
  	</tr>
    <tr>
	<td>Montantcdf</td>
	<td>'.$rows->montantcdf.'</td>
  	</tr>
    <tr>
	<td>Taux</td>
	<td>'.$rows->taux.'</td>
  	</tr>
    <tr>
	<td>Rendu</td>
	<td>'.$rows->rendu.'</td>
  	</tr>
    <tr>
	<td>Remise</td>
	<td>'.$rows->remise.'</td>
  	</tr>
    <tr>
	<td>Justification</td>
	<td>'.$rows->justification.'</td>
  	</tr>
    <tr>
	<td>Id Mode Regl</td>
	<td>'.$rows->id_mode_regl.'</td>
  	</tr>
    <tr>
	<td>Id Monnaie</td>
	<td>'.$rows->id_monnaie.'</td>
  	</tr>
    <tr>
	<td>Regl Id</td>
	<td>'.$rows->regl_id.'</td>
  	</tr>
    <tr>
	<td>Site Id</td>
	<td>'.$rows->site_id.'</td>
  	</tr>
    <tr>
	<td>Company Id</td>
	<td>'.$rows->company_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'paiement_'.date('Y-m-d').'.doc';
	$filename2= 'paiement_'.date('Y-m-d').'.xls';
	$pdf_output= 'paiement_'.date('Y-m-d').'.pdf';
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
	