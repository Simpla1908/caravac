
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		respointage
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Respointage</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Employe Id</td>
	<td>'.$rows->employe_id.'</td>
  	</tr>
    <tr>
	<td>Dte In</td>
	<td>'.$rows->dte_in.'</td>
  	</tr>
    <tr>
	<td>Dte Out</td>
	<td>'.$rows->dte_out.'</td>
  	</tr>
    <tr>
	<td>Hr In</td>
	<td>'.$rows->hr_in.'</td>
  	</tr>
    <tr>
	<td>Hr Out</td>
	<td>'.$rows->hr_out.'</td>
  	</tr>
    <tr>
	<td>Motif</td>
	<td>'.$rows->motif.'</td>
  	</tr>
    <tr>
	<td>Justification</td>
	<td>'.$rows->justification.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'respointage_'.date('Y-m-d').'.doc';
	$filename2= 'respointage_'.date('Y-m-d').'.xls';
	$pdf_output= 'respointage_'.date('Y-m-d').'.pdf';
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
	