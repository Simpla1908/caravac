
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_utilisateur
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Utilisateur</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Nom User</th>
      <th>Prenom User</th>
      <th>Sexe User</th>
      <th>Telephone User</th>
      <th>Email User</th>
      <th>Mdp User</th>
      <th>Adresse Mail</th>
      <th>Type</th>
      <th>Actif</th>
      <th>Id Hotel</th>
      <th>Company Id</th>
      <th>Id Droit</th>
      <th>Fconnect</th>
      <th>Connect</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->nom_user.'</td>
	<td>'.$rows->prenom_user.'</td>
	<td>'.$rows->sexe_user.'</td>
	<td>'.$rows->telephone_user.'</td>
	<td>'.$rows->email_user.'</td>
	<td>'.$rows->mdp_user.'</td>
	<td>'.$rows->adresse_mail.'</td>
	<td>'.$rows->type.'</td>
	<td>'.$rows->actif.'</td>
	<td>'.$rows->id_hotel.'</td>
	<td>'.$rows->company_id.'</td>
	<td>'.$rows->id_droit.'</td>
	<td>'.$rows->fconnect.'</td>
	<td>'.$rows->connect.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_utilisateur_'.date('Y-m-d').'.doc';
	$filename2= 't_utilisateur_'.date('Y-m-d').'.xls';
	$pdf_output= 't_utilisateur_'.date('Y-m-d').'.pdf';
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