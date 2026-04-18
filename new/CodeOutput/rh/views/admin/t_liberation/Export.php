
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_liberation
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Liberation</p>';
	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
      <th>Date Lib</th>
      <th>Heure Lib</th>
      <th>Id Ch</th>
      <th>Id Client</th>
      <th>Id Hotel</th>
      <th>Id Res</th>
      <th>Id Reser Cham</th>
      <th>Id User</th>
      <th>Dte Lib</th>
  </tr>
  ';
	foreach($result as $rows)
			{
	$excel.='<tr>
	<td>'.$rows->date_lib.'</td>
	<td>'.$rows->heure_lib.'</td>
	<td>'.$rows->id_ch.'</td>
	<td>'.$rows->id_client.'</td>
	<td>'.$rows->id_hotel.'</td>
	<td>'.$rows->id_res.'</td>
	<td>'.$rows->id_reser_cham.'</td>
	<td>'.$rows->id_user.'</td>
	<td>'.$rows->dte_lib.'</td>
	</tr>';
	}
	$excel.='</table>';
	$filename1= 't_liberation_'.date('Y-m-d').'.doc';
	$filename2= 't_liberation_'.date('Y-m-d').'.xls';
	$pdf_output= 't_liberation_'.date('Y-m-d').'.pdf';
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