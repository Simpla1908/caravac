
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Client</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Code</th>
      <th>Designation</th>
      <th>Nom Client</th>
      <th>Date Naiss Client</th>
      <th>Sexe Client</th>
      <th>Etat Civil Client</th>
      <th>Nationalite Client</th>
      <th>Provenance Client</th>
      <th>Num Piece Identite Client</th>
      <th>Num Passeport Client</th>
      <th>Adresse Provenance Client</th>
      <th>Email Client</th>
      <th>Telephone Client</th>
      <th>Num Pers Contacter Client</th>
      <th>Statut</th>
      <th>Pseudo Supp</th>
      <th>Type</th>
      <th>Type Cl</th>
      <th>Id Respo</th>
      <th>Id Hotel</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->code.'</td>
	<td>'.$rows->designation.'</td>
	<td>'.$rows->nom_client.'</td>
	<td>'.$rows->date_naiss_client.'</td>
	<td>'.$rows->sexe_client.'</td>
	<td>'.$rows->etat_civil_client.'</td>
	<td>'.$rows->nationalite_client.'</td>
	<td>'.$rows->provenance_client.'</td>
	<td>'.$rows->num_piece_identite_client.'</td>
	<td>'.$rows->num_passeport_client.'</td>
	<td>'.$rows->adresse_provenance_client.'</td>
	<td>'.$rows->email_client.'</td>
	<td>'.$rows->telephone_client.'</td>
	<td>'.$rows->num_pers_contacter_client.'</td>
	<td>'.$rows->statut.'</td>
	<td>'.$rows->pseudo_supp.'</td>
	<td>'.$rows->type.'</td>
	<td>'.$rows->type_cl.'</td>
	<td>'.$rows->id_respo.'</td>
	<td>'.$rows->id_hotel.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_client_'.date('Y-m-d').'.doc';
	$filename2= 't_client_'.date('Y-m-d').'.xls';
	$pdf_output= 't_client_'.date('Y-m-d').'.pdf';
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