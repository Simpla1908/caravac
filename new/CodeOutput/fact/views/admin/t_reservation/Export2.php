
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
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
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Num Reserv</td>
	<td>'.$rows->num_reserv.'</td>
  	</tr>
    <tr>
	<td>Garantie</td>
	<td>'.$rows->garantie.'</td>
  	</tr>
    <tr>
	<td>Num Bc</td>
	<td>'.$rows->num_bc.'</td>
  	</tr>
    <tr>
	<td>Num Occ</td>
	<td>'.$rows->num_occ.'</td>
  	</tr>
    <tr>
	<td>Num Com</td>
	<td>'.$rows->num_com.'</td>
  	</tr>
    <tr>
	<td>Type</td>
	<td>'.$rows->type.'</td>
  	</tr>
    <tr>
	<td>Tva</td>
	<td>'.$rows->tva.'</td>
  	</tr>
    <tr>
	<td>Taux</td>
	<td>'.$rows->taux.'</td>
  	</tr>
    <tr>
	<td>Remise</td>
	<td>'.$rows->remise.'</td>
  	</tr>
    <tr>
	<td>Majoration</td>
	<td>'.$rows->majoration.'</td>
  	</tr>
    <tr>
	<td>Mont Nuite</td>
	<td>'.$rows->mont_nuite.'</td>
  	</tr>
    <tr>
	<td>Mont Total Res</td>
	<td>'.$rows->mont_total_res.'</td>
  	</tr>
    <tr>
	<td>Mont Par Chambre</td>
	<td>'.$rows->mont_par_chambre.'</td>
  	</tr>
    <tr>
	<td>Monnaie</td>
	<td>'.$rows->monnaie.'</td>
  	</tr>
    <tr>
	<td>Nbr Ch</td>
	<td>'.$rows->nbr_ch.'</td>
  	</tr>
    <tr>
	<td>Etat</td>
	<td>'.$rows->etat.'</td>
  	</tr>
    <tr>
	<td>Etat Credit</td>
	<td>'.$rows->etat_credit.'</td>
  	</tr>
    <tr>
	<td>Dte</td>
	<td>'.$rows->dte.'</td>
  	</tr>
    <tr>
	<td>Date Res</td>
	<td>'.$rows->date_res.'</td>
  	</tr>
    <tr>
	<td>Date Occ</td>
	<td>'.$rows->date_occ.'</td>
  	</tr>
    <tr>
	<td>Date Lib</td>
	<td>'.$rows->date_lib.'</td>
  	</tr>
    <tr>
	<td>Statut Res</td>
	<td>'.$rows->statut_res.'</td>
  	</tr>
    <tr>
	<td>Statut Occ</td>
	<td>'.$rows->statut_occ.'</td>
  	</tr>
    <tr>
	<td>Statut Sorti</td>
	<td>'.$rows->statut_sorti.'</td>
  	</tr>
    <tr>
	<td>Id Client</td>
	<td>'.$rows->id_client.'</td>
  	</tr>
    <tr>
	<td>Chambr Id</td>
	<td>'.$rows->chambr_id.'</td>
  	</tr>
    <tr>
	<td>Id Hotel</td>
	<td>'.$rows->id_hotel.'</td>
  	</tr>
    <tr>
	<td>Dte A</td>
	<td>'.$rows->dte_a.'</td>
  	</tr>
    <tr>
	<td>Dte S</td>
	<td>'.$rows->dte_s.'</td>
  	</tr>
    <tr>
	<td>Occ Indirect</td>
	<td>'.$rows->occ_indirect.'</td>
  	</tr>
    <tr>
	<td>Respo Id</td>
	<td>'.$rows->respo_id.'</td>
  	</tr>';
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
	