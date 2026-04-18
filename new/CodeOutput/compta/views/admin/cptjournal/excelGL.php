
	<?php
	/*
	* =======================================================================
	* FILE NAME:        Export.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptjournal
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	<?php
	$excel='
	<p style="font-family:arial; font-size:18px;" align="left">
	<strong style="font-family:arial;">'.LANG_REPORT_TITLE.'</strong><br>'.LANG_REPORT_SUB_TITLE.'<br>
	<strong>'.LANG_REPORT_TABLE.'</strong> Cptjournal</p>';


	$excel.='<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
        <th>Date</th>
        <th>Ref.</th>
        <th>Libellé</th>
        <th>Débit</th>  
        <th>Crédit</th>
        <th>Solde</th>
        <th>Dévise</th>
        <th>Cours</th>
        <th>Débit</th>
        <th>Crédit</th>
        <th>Solde</th>
  </tr>
  ';
    $nbArticles = count($_SESSION['journal']['n']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
    $excel.='<tr>
        <td>'.$_SESSION['journal']['date'][$i].'</td>
        <td>'.$_SESSION['journal']['reference'][$i].'</td>
        <td>'.$_SESSION['journal']['typejournal'][$i].'</td>
        <td>'.$_SESSION['journal']['compte'][$i].'</td>
        <td>'.$_SESSION['journal']['debit'][$i].'</td>
        <td>'.$_SESSION['journal']['credit'][$i].'</td>
    </tr>';
     }
    $excel.='</table>';
	$filename= 'Grandlivre.xls';	
	header("Content-type: application/msexcel");
	header("Content-Disposition: attachment; filename=$filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print $excel;
	?>