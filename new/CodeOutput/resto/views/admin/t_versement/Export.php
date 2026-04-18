
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_versement
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Versement</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>User Vers</th>
      <th>Date Vers</th>
      <th>Montant Vers</th>
      <th>Montantusd</th>
      <th>Monaie Vers</th>
      <th>Taux</th>
      <th>Motif</th>
      <th>Type Vers</th>
      <th>Paie Id</th>
      <th>Id Hotel</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->user_vers.'</td>
	<td>'.$rows->date_vers.'</td>
	<td>'.$rows->montant_vers.'</td>
	<td>'.$rows->montantusd.'</td>
	<td>'.$rows->monaie_vers.'</td>
	<td>'.$rows->taux.'</td>
	<td>'.$rows->motif.'</td>
	<td>'.$rows->type_vers.'</td>
	<td>'.$rows->paie_id.'</td>
	<td>'.$rows->id_hotel.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_versement_'.date('Y-m-d').'.doc';
	$filename2= 't_versement_'.date('Y-m-d').'.xls';
	$pdf_output= 't_versement_'.date('Y-m-d').'.pdf';
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