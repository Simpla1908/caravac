
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_livraison
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Ach Livraison</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>NumBon Liv</td>
	<td>'.$rows->numBon_liv.'</td>
  	</tr>
    <tr>
	<td>NumBon Cmd</td>
	<td>'.$rows->numBon_cmd.'</td>
  	</tr>
    <tr>
	<td>Bcommande Id</td>
	<td>'.$rows->bcommande_id.'</td>
  	</tr>
    <tr>
	<td>Fournisseur Id</td>
	<td>'.$rows->fournisseur_id.'</td>
  	</tr>
    <tr>
	<td>User Id</td>
	<td>'.$rows->user_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'ach_livraison_'.date('Y-m-d').'.doc';
	$filename2= 'ach_livraison_'.date('Y-m-d').'.xls';
	$pdf_output= 'ach_livraison_'.date('Y-m-d').'.pdf';
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
	