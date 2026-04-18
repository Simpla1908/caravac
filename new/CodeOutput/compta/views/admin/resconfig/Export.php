
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
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
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Nomcomp</th>
      <th>Adrcomp</th>
      <th>M Insert</th>
      <th>M Affich</th>
      <th>Taux</th>
      <th>Age</th>
      <th>Penalite</th>
      <th>Hopital</th>
      <th>Fuseauhoraire</th>
      <th>Prefsanct</th>
      <th>Prefconge</th>
      <th>Tva</th>
      <th>Echeance</th>
      <th>Liestock</th>
      <th>Infofact</th>
      <th>Sujetmail</th>
      <th>Msgmail</th>
      <th>Logo</th>
      <th>Module Id</th>
      <th>Site Id</th>
      <th>Checkin</th>
      <th>Checkout</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->nomcomp.'</td>
	<td>'.$rows->adrcomp.'</td>
	<td>'.$rows->m_insert.'</td>
	<td>'.$rows->m_affich.'</td>
	<td>'.$rows->taux.'</td>
	<td>'.$rows->age.'</td>
	<td>'.$rows->penalite.'</td>
	<td>'.$rows->hopital.'</td>
	<td>'.$rows->fuseauhoraire.'</td>
	<td>'.$rows->prefsanct.'</td>
	<td>'.$rows->prefconge.'</td>
	<td>'.$rows->tva.'</td>
	<td>'.$rows->echeance.'</td>
	<td>'.$rows->liestock.'</td>
	<td>'.$rows->infofact.'</td>
	<td>'.$rows->sujetmail.'</td>
	<td>'.$rows->msgmail.'</td>
	<td>'.$rows->logo.'</td>
	<td>'.$rows->module_id.'</td>
	<td>'.$rows->site_id.'</td>
	<td>'.$rows->checkin.'</td>
	<td>'.$rows->checkout.'</td>
	</tr>';
	}
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
	elseif ($etype == 'PDF') {
	HezecomPDF($excel, $pdf_output);
	}
	?>