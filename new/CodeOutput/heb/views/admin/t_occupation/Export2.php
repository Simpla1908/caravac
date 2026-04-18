
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Occupation</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Type Occ</td>
	<td>'.$rows->type_occ.'</td>
  	</tr>
    <tr>
	<td>Date Occ</td>
	<td>'.$rows->date_occ.'</td>
  	</tr>
    <tr>
	<td>Heure Occ</td>
	<td>'.$rows->heure_occ.'</td>
  	</tr>
    <tr>
	<td>Id Ch</td>
	<td>'.$rows->id_ch.'</td>
  	</tr>
    <tr>
	<td>Id Client</td>
	<td>'.$rows->id_client.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_occupation_'.date('Y-m-d').'.doc';
	$filename2= 't_occupation_'.date('Y-m-d').'.xls';
	$pdf_output= 't_occupation_'.date('Y-m-d').'.pdf';
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
	