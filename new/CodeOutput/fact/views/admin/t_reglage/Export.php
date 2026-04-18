
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglage
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Reglage</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Remise</th>
      <th>Majoration</th>
      <th>Date Regl</th>
      <th>Dte H</th>
      <th>Temps Regl</th>
      <th>Time Checkin</th>
      <th>M Insert</th>
      <th>M Affiche</th>
      <th>Tauxdollar</th>
      <th>Taux Op</th>
      <th>Tva</th>
      <th>Pourcentage Defaut</th>
      <th>Pourcentage 24 Heure</th>
      <th>Pourcentage 48 Heure</th>
      <th>Pourcentage 72 Heure</th>
      <th>Pourcentage Sup 72 Heure</th>
      <th>Type Annul</th>
      <th>Fcon Heberge</th>
      <th>User Id</th>
      <th>Id Hotel</th>
      <th>Company Id</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->remise.'</td>
	<td>'.$rows->majoration.'</td>
	<td>'.$rows->date_regl.'</td>
	<td>'.$rows->dte_h.'</td>
	<td>'.$rows->temps_regl.'</td>
	<td>'.$rows->time_checkin.'</td>
	<td>'.$rows->m_insert.'</td>
	<td>'.$rows->m_affiche.'</td>
	<td>'.$rows->tauxdollar.'</td>
	<td>'.$rows->taux_op.'</td>
	<td>'.$rows->tva.'</td>
	<td>'.$rows->pourcentage_defaut.'</td>
	<td>'.$rows->pourcentage_24_heure.'</td>
	<td>'.$rows->pourcentage_48_heure.'</td>
	<td>'.$rows->pourcentage_72_heure.'</td>
	<td>'.$rows->pourcentage_sup_72_heure.'</td>
	<td>'.$rows->type_annul.'</td>
	<td>'.$rows->fcon_heberge.'</td>
	<td>'.$rows->user_id.'</td>
	<td>'.$rows->id_hotel.'</td>
	<td>'.$rows->company_id.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_reglage_'.date('Y-m-d').'.doc';
	$filename2= 't_reglage_'.date('Y-m-d').'.xls';
	$pdf_output= 't_reglage_'.date('Y-m-d').'.pdf';
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