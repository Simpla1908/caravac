
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reservation
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Reservation</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Num Reserv</th>
      <th>Garantie</th>
      <th>Num Bc</th>
      <th>Num Occ</th>
      <th>Num Com</th>
      <th>Type</th>
      <th>Tva</th>
      <th>Taux</th>
      <th>Remise</th>
      <th>Majoration</th>
      <th>Mont Nuite</th>
      <th>Mont Total Res</th>
      <th>Mont Par Chambre</th>
      <th>Monnaie</th>
      <th>Nbr Ch</th>
      <th>Etat</th>
      <th>Etat Credit</th>
      <th>Dte</th>
      <th>Date Res</th>
      <th>Date Occ</th>
      <th>Date Lib</th>
      <th>Statut Res</th>
      <th>Statut Occ</th>
      <th>Statut Sorti</th>
      <th>Id Client</th>
      <th>Chambr Id</th>
      <th>Id Hotel</th>
      <th>Dte A</th>
      <th>Dte S</th>
      <th>Occ Indirect</th>
      <th>Respo Id</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->num_reserv.'</td>
	<td>'.$rows->garantie.'</td>
	<td>'.$rows->num_bc.'</td>
	<td>'.$rows->num_occ.'</td>
	<td>'.$rows->num_com.'</td>
	<td>'.$rows->type.'</td>
	<td>'.$rows->tva.'</td>
	<td>'.$rows->taux.'</td>
	<td>'.$rows->remise.'</td>
	<td>'.$rows->majoration.'</td>
	<td>'.$rows->mont_nuite.'</td>
	<td>'.$rows->mont_total_res.'</td>
	<td>'.$rows->mont_par_chambre.'</td>
	<td>'.$rows->monnaie.'</td>
	<td>'.$rows->nbr_ch.'</td>
	<td>'.$rows->etat.'</td>
	<td>'.$rows->etat_credit.'</td>
	<td>'.$rows->dte.'</td>
	<td>'.$rows->date_res.'</td>
	<td>'.$rows->date_occ.'</td>
	<td>'.$rows->date_lib.'</td>
	<td>'.$rows->statut_res.'</td>
	<td>'.$rows->statut_occ.'</td>
	<td>'.$rows->statut_sorti.'</td>
	<td>'.$rows->id_client.'</td>
	<td>'.$rows->chambr_id.'</td>
	<td>'.$rows->id_hotel.'</td>
	<td>'.$rows->dte_a.'</td>
	<td>'.$rows->dte_s.'</td>
	<td>'.$rows->occ_indirect.'</td>
	<td>'.$rows->respo_id.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_reservation_'.date('Y-m-d').'.doc';
	$filename2= 't_reservation_'.date('Y-m-d').'.xls';
	$pdf_output= 't_reservation_'.date('Y-m-d').'.pdf';
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