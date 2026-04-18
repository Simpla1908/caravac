
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_facture
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Facture</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Num Fact</td>
	<td>'.$rows->num_fact.'</td>
  	</tr>
    <tr>
	<td>Type</td>
	<td>'.$rows->type.'</td>
  	</tr>
    <tr>
	<td>I Souscription</td>
	<td>'.$rows->i_souscription.'</td>
  	</tr>
    <tr>
	<td>Etat</td>
	<td>'.$rows->etat.'</td>
  	</tr>
    <tr>
	<td>Etat Cmd</td>
	<td>'.$rows->etat_cmd.'</td>
  	</tr>
    <tr>
	<td>Date Echeance Old</td>
	<td>'.$rows->date_echeance_old.'</td>
  	</tr>
    <tr>
	<td>Date Edition</td>
	<td>'.$rows->date_edition.'</td>
  	</tr>
    <tr>
	<td>Dte Blocage</td>
	<td>'.$rows->dte_blocage.'</td>
  	</tr>
    <tr>
	<td>Date Echeance</td>
	<td>'.$rows->date_echeance.'</td>
  	</tr>
    <tr>
	<td>Date Desactivation</td>
	<td>'.$rows->date_desactivation.'</td>
  	</tr>
    <tr>
	<td>Montant Total</td>
	<td>'.$rows->montant_total.'</td>
  	</tr>
    <tr>
	<td>Mont Tva</td>
	<td>'.$rows->mont_tva.'</td>
  	</tr>
    <tr>
	<td>Mont Ttc</td>
	<td>'.$rows->mont_ttc.'</td>
  	</tr>
    <tr>
	<td>Mont Ttc Remise</td>
	<td>'.$rows->mont_ttc_remise.'</td>
  	</tr>
    <tr>
	<td>Taux</td>
	<td>'.$rows->taux.'</td>
  	</tr>
    <tr>
	<td>Taux Prix</td>
	<td>'.$rows->taux_prix.'</td>
  	</tr>
    <tr>
	<td>Tva</td>
	<td>'.$rows->tva.'</td>
  	</tr>
    <tr>
	<td>Monnaie</td>
	<td>'.$rows->monnaie.'</td>
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
	<td>Justification</td>
	<td>'.$rows->justification.'</td>
  	</tr>
    <tr>
	<td>Id Res</td>
	<td>'.$rows->id_res.'</td>
  	</tr>
    <tr>
	<td>Res Ch Id</td>
	<td>'.$rows->res_ch_id.'</td>
  	</tr>
    <tr>
	<td>Modulecompagny</td>
	<td>'.$rows->modulecompagny.'</td>
  	</tr>
    <tr>
	<td>Id Hotel</td>
	<td>'.$rows->id_hotel.'</td>
  	</tr>
    <tr>
	<td>Company Id</td>
	<td>'.$rows->company_id.'</td>
  	</tr>
    <tr>
	<td>Id User</td>
	<td>'.$rows->id_user.'</td>
  	</tr>
    <tr>
	<td>Id Client</td>
	<td>'.$rows->id_client.'</td>
  	</tr>
    <tr>
	<td>Fact1</td>
	<td>'.$rows->fact1.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_facture_'.date('Y-m-d').'.doc';
	$filename2= 't_facture_'.date('Y-m-d').'.xls';
	$pdf_output= 't_facture_'.date('Y-m-d').'.pdf';
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
	