
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_operation
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Operation</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Type</th>
      <th>Libelle</th>
      <th>Date Bon</th>
      <th>Date Heure Bon</th>
      <th>Beneficiaire</th>
      <th>Provenance</th>
      <th>MontantFC</th>
      <th>MontantUSD</th>
      <th>NumBon</th>
      <th>Indice Be</th>
      <th>Indice Bs</th>
      <th>NumBordereau</th>
      <th>Mode Operation</th>
      <th>Session Id</th>
      <th>Motif Id</th>
      <th>User Vers</th>
      <th>User Id</th>
      <th>Hotel Id</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->type.'</td>
	<td>'.$rows->libelle.'</td>
	<td>'.$rows->date_bon.'</td>
	<td>'.$rows->date_heure_bon.'</td>
	<td>'.$rows->beneficiaire.'</td>
	<td>'.$rows->provenance.'</td>
	<td>'.$rows->montantFC.'</td>
	<td>'.$rows->montantUSD.'</td>
	<td>'.$rows->numBon.'</td>
	<td>'.$rows->indice_be.'</td>
	<td>'.$rows->indice_bs.'</td>
	<td>'.$rows->numBordereau.'</td>
	<td>'.$rows->mode_operation.'</td>
	<td>'.$rows->session_id.'</td>
	<td>'.$rows->motif_id.'</td>
	<td>'.$rows->user_vers.'</td>
	<td>'.$rows->user_id.'</td>
	<td>'.$rows->hotel_id.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_operation_'.date('Y-m-d').'.doc';
	$filename2= 't_operation_'.date('Y-m-d').'.xls';
	$pdf_output= 't_operation_'.date('Y-m-d').'.pdf';
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