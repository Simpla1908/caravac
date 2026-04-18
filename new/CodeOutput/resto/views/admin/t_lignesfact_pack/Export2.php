
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_lignesfact_pack
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Lignesfact Pack</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Montant</td>
	<td>'.$rows->montant.'</td>
  	</tr>
    <tr>
	<td>Mont Paye</td>
	<td>'.$rows->mont_paye.'</td>
  	</tr>
    <tr>
	<td>Active</td>
	<td>'.$rows->active.'</td>
  	</tr>
    <tr>
	<td>Pack Company Id</td>
	<td>'.$rows->pack_company_id.'</td>
  	</tr>
    <tr>
	<td>Pack Id</td>
	<td>'.$rows->pack_id.'</td>
  	</tr>
    <tr>
	<td>Fact Id</td>
	<td>'.$rows->fact_id.'</td>
  	</tr>
    <tr>
	<td>Type</td>
	<td>'.$rows->type.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_lignesfact_pack_'.date('Y-m-d').'.doc';
	$filename2= 't_lignesfact_pack_'.date('Y-m-d').'.xls';
	$pdf_output= 't_lignesfact_pack_'.date('Y-m-d').'.pdf';
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
	