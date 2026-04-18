
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		t_validation
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Validation</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Qte Envoye</td>
	<td>'.$rows->qte_envoye.'</td>
  	</tr>
    <tr>
	<td>Qte Verif</td>
	<td>'.$rows->qte_verif.'</td>
  	</tr>
    <tr>
	<td>Motif Id</td>
	<td>'.$rows->motif_id.'</td>
  	</tr>
    <tr>
	<td>Produit Id</td>
	<td>'.$rows->produit_id.'</td>
  	</tr>
    <tr>
	<td>Fiche Id</td>
	<td>'.$rows->fiche_id.'</td>
  	</tr>
    <tr>
	<td>Hotel Id</td>
	<td>'.$rows->hotel_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_validation_'.date('Y-m-d').'.doc';
	$filename2= 't_validation_'.date('Y-m-d').'.xls';
	$pdf_output= 't_validation_'.date('Y-m-d').'.pdf';
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
	