
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		skt_fiche
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Skt Fiche</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Numero</td>
	<td>'.$rows->numero.'</td>
  	</tr>
    <tr>
	<td>Type</td>
	<td>'.$rows->type.'</td>
  	</tr>
    <tr>
	<td>Motif</td>
	<td>'.$rows->motif.'</td>
  	</tr>
    <tr>
	<td>Beneficiere</td>
	<td>'.$rows->beneficiere.'</td>
  	</tr>
    <tr>
	<td>Nbrprod</td>
	<td>'.$rows->nbrprod.'</td>
  	</tr>
    <tr>
	<td>Dte</td>
	<td>'.$rows->dte.'</td>
  	</tr>
    <tr>
	<td>Dte Time</td>
	<td>'.$rows->dte_time.'</td>
  	</tr>
    <tr>
	<td>Approuve</td>
	<td>'.$rows->approuve.'</td>
  	</tr>
    <tr>
	<td>Depot Id</td>
	<td>'.$rows->depot_id.'</td>
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
	
	$filename1= 'skt_fiche_'.date('Y-m-d').'.doc';
	$filename2= 'skt_fiche_'.date('Y-m-d').'.xls';
	$pdf_output= 'skt_fiche_'.date('Y-m-d').'.pdf';
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
	