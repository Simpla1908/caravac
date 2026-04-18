
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemployes
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Resemployes</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Matricule</td>
	<td>'.$rows->matricule.'</td>
  	</tr>
    <tr>
	<td>Noms</td>
	<td>'.$rows->noms.'</td>
  	</tr>
    <tr>
	<td>Sexe</td>
	<td>'.$rows->sexe.'</td>
  	</tr>
    <tr>
	<td>Etatcivil</td>
	<td>'.$rows->etatcivil.'</td>
  	</tr>
    <tr>
	<td>Nationalite</td>
	<td>'.$rows->nationalite.'</td>
  	</tr>
    <tr>
	<td>Lieunais</td>
	<td>'.$rows->lieunais.'</td>
  	</tr>
    <tr>
	<td>Datenais</td>
	<td>'.$rows->datenais.'</td>
  	</tr>
    <tr>
	<td>Adresse</td>
	<td>'.$rows->Adresse.'</td>
  	</tr>
    <tr>
	<td>Piece</td>
	<td>'.$rows->piece.'</td>
  	</tr>
    <tr>
	<td>Numpiece</td>
	<td>'.$rows->numpiece.'</td>
  	</tr>
    <tr>
	<td>Tel1</td>
	<td>'.$rows->tel1.'</td>
  	</tr>
    <tr>
	<td>Tel2</td>
	<td>'.$rows->tel2.'</td>
  	</tr>
    <tr>
	<td>Email</td>
	<td>'.$rows->email.'</td>
  	</tr>
    <tr>
	<td>Nbrenf</td>
	<td>'.$rows->nbrenf.'</td>
  	</tr>
    <tr>
	<td>Actif</td>
	<td>'.$rows->actif.'</td>
  	</tr>
    <tr>
	<td>Pseudo Supp</td>
	<td>'.$rows->pseudo_supp.'</td>
  	</tr>
    <tr>
	<td>Fonction Id</td>
	<td>'.$rows->fonction_id.'</td>
  	</tr>
    <tr>
	<td>Departement Id</td>
	<td>'.$rows->departement_id.'</td>
  	</tr>
    <tr>
	<td>Image</td>
	<td>'.$rows->image.'</td>
  	</tr>
    <tr>
	<td>Id Hotel</td>
	<td>'.$rows->id_hotel.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'resemployes_'.date('Y-m-d').'.doc';
	$filename2= 'resemployes_'.date('Y-m-d').'.xls';
	$pdf_output= 'resemployes_'.date('Y-m-d').'.pdf';
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
	