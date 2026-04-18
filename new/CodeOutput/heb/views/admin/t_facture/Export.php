
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
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
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Num Fact</th>
      <th>Type</th>
      <th>I Souscription</th>
      <th>Etat</th>
      <th>Etat Cmd</th>
      <th>Date Echeance Old</th>
      <th>Date Edition</th>
      <th>Dte Blocage</th>
      <th>Date Echeance</th>
      <th>Date Desactivation</th>
      <th>Montant Total</th>
      <th>Mont Tva</th>
      <th>Mont Ttc</th>
      <th>Mont Ttc Remise</th>
      <th>Taux</th>
      <th>Taux Prix</th>
      <th>Tva</th>
      <th>Monnaie</th>
      <th>Remise</th>
      <th>Majoration</th>
      <th>Justification</th>
      <th>Id Res</th>
      <th>Res Ch Id</th>
      <th>Modulecompagny</th>
      <th>Id Hotel</th>
      <th>Company Id</th>
      <th>Id User</th>
      <th>Id Client</th>
      <th>Fact1</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->num_fact.'</td>
	<td>'.$rows->type.'</td>
	<td>'.$rows->i_souscription.'</td>
	<td>'.$rows->etat.'</td>
	<td>'.$rows->etat_cmd.'</td>
	<td>'.$rows->date_echeance_old.'</td>
	<td>'.$rows->date_edition.'</td>
	<td>'.$rows->dte_blocage.'</td>
	<td>'.$rows->date_echeance.'</td>
	<td>'.$rows->date_desactivation.'</td>
	<td>'.$rows->montant_total.'</td>
	<td>'.$rows->mont_tva.'</td>
	<td>'.$rows->mont_ttc.'</td>
	<td>'.$rows->mont_ttc_remise.'</td>
	<td>'.$rows->taux.'</td>
	<td>'.$rows->taux_prix.'</td>
	<td>'.$rows->tva.'</td>
	<td>'.$rows->monnaie.'</td>
	<td>'.$rows->remise.'</td>
	<td>'.$rows->majoration.'</td>
	<td>'.$rows->justification.'</td>
	<td>'.$rows->id_res.'</td>
	<td>'.$rows->res_ch_id.'</td>
	<td>'.$rows->modulecompagny.'</td>
	<td>'.$rows->id_hotel.'</td>
	<td>'.$rows->company_id.'</td>
	<td>'.$rows->id_user.'</td>
	<td>'.$rows->id_client.'</td>
	<td>'.$rows->fact1.'</td>
	</tr>';
	}
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
	elseif ($etype == 'PDF') {
	HezecomPDF($excel, $pdf_output);
	}
	?>