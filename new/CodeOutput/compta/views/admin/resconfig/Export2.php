
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		resconfig
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Resconfig</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Nomcomp</td>
	<td>'.$rows->nomcomp.'</td>
  	</tr>
    <tr>
	<td>Adrcomp</td>
	<td>'.$rows->adrcomp.'</td>
  	</tr>
    <tr>
	<td>M Insert</td>
	<td>'.$rows->m_insert.'</td>
  	</tr>
    <tr>
	<td>M Affich</td>
	<td>'.$rows->m_affich.'</td>
  	</tr>
    <tr>
	<td>Taux</td>
	<td>'.$rows->taux.'</td>
  	</tr>
    <tr>
	<td>Age</td>
	<td>'.$rows->age.'</td>
  	</tr>
    <tr>
	<td>Penalite</td>
	<td>'.$rows->penalite.'</td>
  	</tr>
    <tr>
	<td>Hopital</td>
	<td>'.$rows->hopital.'</td>
  	</tr>
    <tr>
	<td>Fuseauhoraire</td>
	<td>'.$rows->fuseauhoraire.'</td>
  	</tr>
    <tr>
	<td>Prefsanct</td>
	<td>'.$rows->prefsanct.'</td>
  	</tr>
    <tr>
	<td>Prefconge</td>
	<td>'.$rows->prefconge.'</td>
  	</tr>
    <tr>
	<td>Tva</td>
	<td>'.$rows->tva.'</td>
  	</tr>
    <tr>
	<td>Echeance</td>
	<td>'.$rows->echeance.'</td>
  	</tr>
    <tr>
	<td>Liestock</td>
	<td>'.$rows->liestock.'</td>
  	</tr>
    <tr>
	<td>Infofact</td>
	<td>'.$rows->infofact.'</td>
  	</tr>
    <tr>
	<td>Sujetmail</td>
	<td>'.$rows->sujetmail.'</td>
  	</tr>
    <tr>
	<td>Msgmail</td>
	<td>'.$rows->msgmail.'</td>
  	</tr>
    <tr>
	<td>Logo</td>
	<td>'.$rows->logo.'</td>
  	</tr>
    <tr>
	<td>Module Id</td>
	<td>'.$rows->module_id.'</td>
  	</tr>
    <tr>
	<td>Site Id</td>
	<td>'.$rows->site_id.'</td>
  	</tr>
    <tr>
	<td>Checkin</td>
	<td>'.$rows->checkin.'</td>
  	</tr>
    <tr>
	<td>Checkout</td>
	<td>'.$rows->checkout.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'resconfig_'.date('Y-m-d').'.doc';
	$filename2= 'resconfig_'.date('Y-m-d').'.xls';
	$pdf_output= 'resconfig_'.date('Y-m-d').'.pdf';
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
	