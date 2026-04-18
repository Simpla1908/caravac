
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_produits_livres
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Ach Produits Livres</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Quantite Cmd</td>
	<td>'.$rows->quantite_cmd.'</td>
  	</tr>
    <tr>
	<td>Quantite Liv</td>
	<td>'.$rows->quantite_liv.'</td>
  	</tr>
    <tr>
	<td>Observation</td>
	<td>'.$rows->observation.'</td>
  	</tr>
    <tr>
	<td>Produit Id</td>
	<td>'.$rows->produit_id.'</td>
  	</tr>
    <tr>
	<td>Livraison Id</td>
	<td>'.$rows->livraison_id.'</td>
  	</tr>
    <tr>
	<td>User Id</td>
	<td>'.$rows->user_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'ach_produits_livres_'.date('Y-m-d').'.doc';
	$filename2= 'ach_produits_livres_'.date('Y-m-d').'.xls';
	$pdf_output= 'ach_produits_livres_'.date('Y-m-d').'.pdf';
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
	