
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export2.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_modulecompany
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
	<strong>'.LANG_REPORT_TABLE.'</strong> T Modulecompany</p>';
	$excel.='
	<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
    <tr>
	<td>Nbreuser</td>
	<td>'.$rows->nbreuser.'</td>
  	</tr>
    <tr>
	<td>Nbre User Maj</td>
	<td>'.$rows->nbre_user_maj.'</td>
  	</tr>
    <tr>
	<td>Etat Module</td>
	<td>'.$rows->etat_module.'</td>
  	</tr>
    <tr>
	<td>Paye</td>
	<td>'.$rows->paye.'</td>
  	</tr>
    <tr>
	<td>Montantmodule</td>
	<td>'.$rows->montantmodule.'</td>
  	</tr>
    <tr>
	<td>Prix Id</td>
	<td>'.$rows->prix_id.'</td>
  	</tr>
    <tr>
	<td>Pack Id</td>
	<td>'.$rows->pack_id.'</td>
  	</tr>
    <tr>
	<td>Company Id</td>
	<td>'.$rows->company_id.'</td>
  	</tr>
    <tr>
	<td>Module Id</td>
	<td>'.$rows->module_id.'</td>
  	</tr>
    <tr>
	<td>Souscription Id</td>
	<td>'.$rows->souscription_id.'</td>
  	</tr>
    <tr>
	<td>Date Sous</td>
	<td>'.$rows->date_sous.'</td>
  	</tr>
    <tr>
	<td>Date Activ</td>
	<td>'.$rows->date_activ.'</td>
  	</tr>
    <tr>
	<td>Date Echeance</td>
	<td>'.$rows->date_echeance.'</td>
  	</tr>
    <tr>
	<td>Dte Blocage</td>
	<td>'.$rows->dte_blocage.'</td>
  	</tr>
    <tr>
	<td>Site Id</td>
	<td>'.$rows->site_id.'</td>
  	</tr>';
   $excel.='</table>';
	
	$filename1= 't_modulecompany_'.date('Y-m-d').'.doc';
	$filename2= 't_modulecompany_'.date('Y-m-d').'.xls';
	$pdf_output= 't_modulecompany_'.date('Y-m-d').'.pdf';
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
	