
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
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
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Matricule</th>
      <th>Noms</th>
      <th>Sexe</th>
      <th>Etatcivil</th>
      <th>Nationalite</th>
      <th>Lieunais</th>
      <th>Datenais</th>
      <th>Adresse</th>
      <th>Piece</th>
      <th>Numpiece</th>
      <th>Tel1</th>
      <th>Tel2</th>
      <th>Email</th>
      <th>Nbrenf</th>
      <th>Actif</th>
      <th>Pseudo Supp</th>
      <th>Fonction Id</th>
      <th>Departement Id</th>
      <th>Image</th>
      <th>Id Hotel</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->matricule.'</td>
	<td>'.$rows->noms.'</td>
	<td>'.$rows->sexe.'</td>
	<td>'.$rows->etatcivil.'</td>
	<td>'.$rows->nationalite.'</td>
	<td>'.$rows->lieunais.'</td>
	<td>'.$rows->datenais.'</td>
	<td>'.$rows->Adresse.'</td>
	<td>'.$rows->piece.'</td>
	<td>'.$rows->numpiece.'</td>
	<td>'.$rows->tel1.'</td>
	<td>'.$rows->tel2.'</td>
	<td>'.$rows->email.'</td>
	<td>'.$rows->nbrenf.'</td>
	<td>'.$rows->actif.'</td>
	<td>'.$rows->pseudo_supp.'</td>
	<td>'.$rows->fonction_id.'</td>
	<td>'.$rows->departement_id.'</td>
	<td>'.$rows->image.'</td>
	<td>'.$rows->id_hotel.'</td>
	</tr>';
	}
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
	elseif ($etype == 'PDF') {
	HezecomPDF($excel, $pdf_output);
	}
	?>