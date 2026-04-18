
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_operation
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Operation</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Type</td>
	<td>'.$rows->type.'</td>
  	</tr>
    <tr>
	<td>Libelle</td>
	<td>'.$rows->libelle.'</td>
  	</tr>
    <tr>
	<td>Date Bon</td>
	<td>'.$rows->date_bon.'</td>
  	</tr>
    <tr>
	<td>Date Heure Bon</td>
	<td>'.$rows->date_heure_bon.'</td>
  	</tr>
    <tr>
	<td>Beneficiaire</td>
	<td>'.$rows->beneficiaire.'</td>
  	</tr>
    <tr>
	<td>Provenance</td>
	<td>'.$rows->provenance.'</td>
  	</tr>
    <tr>
	<td>MontantFC</td>
	<td>'.$rows->montantFC.'</td>
  	</tr>
    <tr>
	<td>MontantUSD</td>
	<td>'.$rows->montantUSD.'</td>
  	</tr>
    <tr>
	<td>NumBon</td>
	<td>'.$rows->numBon.'</td>
  	</tr>
    <tr>
	<td>Indice Be</td>
	<td>'.$rows->indice_be.'</td>
  	</tr>
    <tr>
	<td>Indice Bs</td>
	<td>'.$rows->indice_bs.'</td>
  	</tr>
    <tr>
	<td>NumBordereau</td>
	<td>'.$rows->numBordereau.'</td>
  	</tr>
    <tr>
	<td>Mode Operation</td>
	<td>'.$rows->mode_operation.'</td>
  	</tr>
    <tr>
	<td>Session Id</td>
	<td>'.$rows->session_id.'</td>
  	</tr>
    <tr>
	<td>Motif Id</td>
	<td>'.$rows->motif_id.'</td>
  	</tr>
    <tr>
	<td>User Vers</td>
	<td>'.$rows->user_vers.'</td>
  	</tr>
    <tr>
	<td>User Id</td>
	<td>'.$rows->user_id.'</td>
  	</tr>
    <tr>
	<td>Hotel Id</td>
	<td>'.$rows->hotel_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_operation_'.date('Y-m-d').'.doc';
	$filename2= 't_operation_'.date('Y-m-d').'.xls';
	$pdf_output= 't_operation_'.date('Y-m-d').'.pdf';
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
	