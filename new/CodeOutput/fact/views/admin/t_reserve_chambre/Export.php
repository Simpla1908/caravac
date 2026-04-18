
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reserve_chambre
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Reserve Chambre</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Idreserv</th>
      <th>Idchambre</th>
      <th>Id Client</th>
      <th>Id Accomp</th>
      <th>Statut</th>
      <th>Occupe</th>
      <th>Date Occ</th>
      <th>Date Lib</th>
      <th>Annule</th>
      <th>Est Responsable</th>
      <th>Mont Paye Heb</th>
      <th>Mont Paye Resto</th>
      <th>Monnaie</th>
      <th>Tarif Ch</th>
      <th>Nom Accomp</th>
      <th>Checkin</th>
      <th>Checkout</th>
      <th>Idfact</th>
      <th>Id Hotel</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->idreserv.'</td>
	<td>'.$rows->idchambre.'</td>
	<td>'.$rows->id_client.'</td>
	<td>'.$rows->id_accomp.'</td>
	<td>'.$rows->statut.'</td>
	<td>'.$rows->occupe.'</td>
	<td>'.$rows->date_occ.'</td>
	<td>'.$rows->date_lib.'</td>
	<td>'.$rows->annule.'</td>
	<td>'.$rows->est_responsable.'</td>
	<td>'.$rows->mont_paye_heb.'</td>
	<td>'.$rows->mont_paye_resto.'</td>
	<td>'.$rows->monnaie.'</td>
	<td>'.$rows->tarif_ch.'</td>
	<td>'.$rows->nom_accomp.'</td>
	<td>'.$rows->checkin.'</td>
	<td>'.$rows->checkout.'</td>
	<td>'.$rows->idfact.'</td>
	<td>'.$rows->id_hotel.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_reserve_chambre_'.date('Y-m-d').'.doc';
	$filename2= 't_reserve_chambre_'.date('Y-m-d').'.xls';
	$pdf_output= 't_reserve_chambre_'.date('Y-m-d').'.pdf';
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