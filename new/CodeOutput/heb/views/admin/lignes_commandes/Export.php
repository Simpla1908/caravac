
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		lignes_commandes
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Lignes Commandes</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Qte</th>
      <th>Prix</th>
      <th>Repas</th>
      <th>Monnaie</th>
      <th>Dte</th>
      <th>Dte H</th>
      <th>Commande Id</th>
      <th>Produit Id</th>
      <th>User Id</th>
      <th>Hotel Id</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->qte.'</td>
	<td>'.$rows->prix.'</td>
	<td>'.$rows->repas.'</td>
	<td>'.$rows->monnaie.'</td>
	<td>'.$rows->dte.'</td>
	<td>'.$rows->dte_h.'</td>
	<td>'.$rows->commande_id.'</td>
	<td>'.$rows->produit_id.'</td>
	<td>'.$rows->user_id.'</td>
	<td>'.$rows->hotel_id.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 'lignes_commandes_'.date('Y-m-d').'.doc';
	$filename2= 'lignes_commandes_'.date('Y-m-d').'.xls';
	$pdf_output= 'lignes_commandes_'.date('Y-m-d').'.pdf';
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