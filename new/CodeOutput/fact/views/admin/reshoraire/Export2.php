
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reshoraire
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
	<strong>'.LANG_REPORT_TABLE.'</strong> Reshoraire</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Libh</td>
	<td>'.$rows->libh.'</td>
  	</tr>
    <tr>
	<td>Hlund</td>
	<td>'.$rows->hlund.'</td>
  	</tr>
    <tr>
	<td>Hmard</td>
	<td>'.$rows->hmard.'</td>
  	</tr>
    <tr>
	<td>Hmerd</td>
	<td>'.$rows->hmerd.'</td>
  	</tr>
    <tr>
	<td>Hjeud</td>
	<td>'.$rows->hjeud.'</td>
  	</tr>
    <tr>
	<td>Hvend</td>
	<td>'.$rows->hvend.'</td>
  	</tr>
    <tr>
	<td>Hsamd</td>
	<td>'.$rows->hsamd.'</td>
  	</tr>
    <tr>
	<td>Hdimd</td>
	<td>'.$rows->hdimd.'</td>
  	</tr>
    <tr>
	<td>Hlunf</td>
	<td>'.$rows->hlunf.'</td>
  	</tr>
    <tr>
	<td>Hmarf</td>
	<td>'.$rows->hmarf.'</td>
  	</tr>
    <tr>
	<td>Hmerf</td>
	<td>'.$rows->hmerf.'</td>
  	</tr>
    <tr>
	<td>Hjeuf</td>
	<td>'.$rows->hjeuf.'</td>
  	</tr>
    <tr>
	<td>Hvenf</td>
	<td>'.$rows->hvenf.'</td>
  	</tr>
    <tr>
	<td>Hsamf</td>
	<td>'.$rows->hsamf.'</td>
  	</tr>
    <tr>
	<td>Hdimf</td>
	<td>'.$rows->hdimf.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 'reshoraire_'.date('Y-m-d').'.doc';
	$filename2= 'reshoraire_'.date('Y-m-d').'.xls';
	$pdf_output= 'reshoraire_'.date('Y-m-d').'.pdf';
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
	