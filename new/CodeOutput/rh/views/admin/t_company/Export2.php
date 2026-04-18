
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_company
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Company</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Nom C</td>
	<td>'.$rows->nom_c.'</td>
  	</tr>
    <tr>
	<td>Etat</td>
	<td>'.$rows->etat.'</td>
  	</tr>
    <tr>
	<td>Adresse C</td>
	<td>'.$rows->adresse_c.'</td>
  	</tr>
    <tr>
	<td>Logo</td>
	<td>'.$rows->logo.'</td>
  	</tr>
    <tr>
	<td>Idnat</td>
	<td>'.$rows->idnat.'</td>
  	</tr>
    <tr>
	<td>Rccm</td>
	<td>'.$rows->rccm.'</td>
  	</tr>
    <tr>
	<td>Mail Company</td>
	<td>'.$rows->mail_company.'</td>
  	</tr>
    <tr>
	<td>Ville</td>
	<td>'.$rows->ville.'</td>
  	</tr>
    <tr>
	<td>Phone</td>
	<td>'.$rows->phone.'</td>
  	</tr>
    <tr>
	<td>Num Impot</td>
	<td>'.$rows->num_impot.'</td>
  	</tr>
    <tr>
	<td>Cb</td>
	<td>'.$rows->cb.'</td>
  	</tr>
    <tr>
	<td>Mention</td>
	<td>'.$rows->mention.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_company_'.date('Y-m-d').'.doc';
	$filename2= 't_company_'.date('Y-m-d').'.xls';
	$pdf_output= 't_company_'.date('Y-m-d').'.pdf';
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
	