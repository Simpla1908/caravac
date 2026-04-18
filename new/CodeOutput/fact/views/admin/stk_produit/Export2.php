
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_produit
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Stk Produit</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Code</td>
	<td>'.$rows->code.'</td>
  	</tr>
    <tr>
	<td>Designation</td>
	<td>'.$rows->designation.'</td>
  	</tr>
    <tr>
	<td>Qte Min</td>
	<td>'.$rows->qte_min.'</td>
  	</tr>
    <tr>
	<td>Qte Initial</td>
	<td>'.$rows->qte_initial.'</td>
  	</tr>
    <tr>
	<td>Qte Dispo</td>
	<td>'.$rows->qte_dispo.'</td>
  	</tr>
    <tr>
	<td>Pa</td>
	<td>'.$rows->pa.'</td>
  	</tr>
    <tr>
	<td>Pv</td>
	<td>'.$rows->pv.'</td>
  	</tr>
    <tr>
	<td>Monnaie</td>
	<td>'.$rows->monnaie.'</td>
  	</tr>
    <tr>
	<td>Repas</td>
	<td>'.$rows->repas.'</td>
  	</tr>
    <tr>
	<td>Statut</td>
	<td>'.$rows->statut.'</td>
  	</tr>
    <tr>
	<td>Pseudo Supp</td>
	<td>'.$rows->pseudo_supp.'</td>
  	</tr>
    <tr>
	<td>Unite</td>
	<td>'.$rows->unite.'</td>
  	</tr>
    <tr>
	<td>Famille Id</td>
	<td>'.$rows->famille_id.'</td>
  	</tr>
    <tr>
	<td>Hotel Id</td>
	<td>'.$rows->hotel_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'stk_produit_'.date('Y-m-d').'.doc';
	$filename2= 'stk_produit_'.date('Y-m-d').'.xls';
	$pdf_output= 'stk_produit_'.date('Y-m-d').'.pdf';
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
	