
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		rescategorie
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Rescategorie</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Libelle</td>
	<td>'.$rows->libelle.'</td>
  	</tr>
    <tr>
	<td>Salbase</td>
	<td>'.$rows->salbase.'</td>
  	</tr>
    <tr>
	<td>Devise</td>
	<td>'.$rows->devise.'</td>
  	</tr>
    <tr>
	<td>Psedo</td>
	<td>'.$rows->psedo.'</td>
  	</tr>
    <tr>
	<td>Site Id</td>
	<td>'.$rows->site_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'rescategorie_'.date('Y-m-d').'.doc';
	$filename2= 'rescategorie_'.date('Y-m-d').'.xls';
	$pdf_output= 'rescategorie_'.date('Y-m-d').'.pdf';
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
	