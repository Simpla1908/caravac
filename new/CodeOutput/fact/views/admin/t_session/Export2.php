
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_session
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Session</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Date Ouverture</td>
	<td>'.$rows->date_ouverture.'</td>
  	</tr>
    <tr>
	<td>Date Fermeture</td>
	<td>'.$rows->date_fermeture.'</td>
  	</tr>
    <tr>
	<td>Statut</td>
	<td>'.$rows->statut.'</td>
  	</tr>
    <tr>
	<td>Dte Heure Ouvert</td>
	<td>'.$rows->dte_heure_ouvert.'</td>
  	</tr>
    <tr>
	<td>Dte Heure Ferm</td>
	<td>'.$rows->dte_heure_ferm.'</td>
  	</tr>
    <tr>
	<td>User Id</td>
	<td>'.$rows->user_id.'</td>
  	</tr>
    <tr>
	<td>Caisse Id</td>
	<td>'.$rows->caisse_id.'</td>
  	</tr>
    <tr>
	<td>Hotel Id</td>
	<td>'.$rows->hotel_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_session_'.date('Y-m-d').'.doc';
	$filename2= 't_session_'.date('Y-m-d').'.xls';
	$pdf_output= 't_session_'.date('Y-m-d').'.pdf';
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
	