
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
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
	<td>Nom Client</td>
	<td>'.$rows->nom_client.'</td>
  	</tr>
    <tr>
	<td>Date Naiss Client</td>
	<td>'.$rows->date_naiss_client.'</td>
  	</tr>
    <tr>
	<td>Sexe Client</td>
	<td>'.$rows->sexe_client.'</td>
  	</tr>
    <tr>
	<td>Etat Civil Client</td>
	<td>'.$rows->etat_civil_client.'</td>
  	</tr>
    <tr>
	<td>Nationalite Client</td>
	<td>'.$rows->nationalite_client.'</td>
  	</tr>
    <tr>
	<td>Provenance Client</td>
	<td>'.$rows->provenance_client.'</td>
  	</tr>
    <tr>
	<td>Num Piece Identite Client</td>
	<td>'.$rows->num_piece_identite_client.'</td>
  	</tr>
    <tr>
	<td>Num Passeport Client</td>
	<td>'.$rows->num_passeport_client.'</td>
  	</tr>
    <tr>
	<td>Adresse Provenance Client</td>
	<td>'.$rows->adresse_provenance_client.'</td>
  	</tr>
    <tr>
	<td>Email Client</td>
	<td>'.$rows->email_client.'</td>
  	</tr>
    <tr>
	<td>Telephone Client</td>
	<td>'.$rows->telephone_client.'</td>
  	</tr>
    <tr>
	<td>Num Pers Contacter Client</td>
	<td>'.$rows->num_pers_contacter_client.'</td>
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
	<td>Type</td>
	<td>'.$rows->type.'</td>
  	</tr>
    <tr>
	<td>Type Cl</td>
	<td>'.$rows->type_cl.'</td>
  	</tr>
    <tr>
	<td>Id Respo</td>
	<td>'.$rows->id_respo.'</td>
  	</tr>
    <tr>
	<td>Id Hotel</td>
	<td>'.$rows->id_hotel.'</td>
  	</tr>';
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
	