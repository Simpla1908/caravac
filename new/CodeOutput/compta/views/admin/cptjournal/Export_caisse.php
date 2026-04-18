
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
	if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	?>
	<?php
	$etype = get('etype');
	$excel = '
	<p style="font-family:arial; font-size:18px;" align="center">
	<strong style="font-family:arial;">' . $_SESSION['TypeJournalExcel'] . '</strong><br>Du ' . $_SESSION['datedebut'] . ' au ' . $_SESSION['datefin'] . '<br>
	<strong>' . $_SESSION['devise'] . '</strong></p>
	<p style="font-family:arial; font-size:12px;" align="right">
	<strong style="font-family:arial;">SOLDE INITIAL ' . $_SESSION['So'] . '</strong></strong></p>';
	$excel .= '<table border="1" cellspacing="0" width="100%" style="font-family:arial; font-size:14px;" cellpadding="5">
	<tr>
        <th>DATE</th>
	    <th>NO DOC</th>
		<th>MOTIF</th>
	    <th>BEN/PROV</th>
	    <th>ENCAISSEMENT</th>
        <th>DECAISSEMENT</th>
  </tr>
  ';
	$nbArticles = count($_SESSION['journal']['n']);
	for ($i = 0; $i <= $nbArticles - 1; $i++) {
		$excel .= '<tr>
        <td>' . $_SESSION['journal']['date'][$i] . '</td>
        <td>' . $_SESSION['journal']['reference'][$i] . '</td>
		<td>' . $_SESSION['journal']['description'][$i] . '</td>
        <td>' . $_SESSION['journal']['beneficiaire'][$i] . '</td>
        <td>' . $_SESSION['journal']['debit'][$i] . '</td>
        <td>' . $_SESSION['journal']['credit'][$i] . '</td>
    </tr>';
	}
	$excel .= '<tr>
          <th colspan="4">TOTAL</th>
          <th>' . $_SESSION['TotalE'] . '</th>
          <th>' . $_SESSION['TotalD'] . '</th>
        </tr></table>
		<p style="font-family:arial; font-size:12px;" align="right">
	<strong style="font-family:arial;">SOLDE FINAL ' . $_SESSION['Sf'] . '</strong></strong></p>';
	$filename1 = 'Journal_' . date('Y-m-d') . '.doc';
	$filename2 = 'Journal_' . date('Y-m-d') . '.xls';
	$pdf_output = 'Journal_' . date('Y-m-d') . '.pdf';
	if ($etype == 'word') {
		header("Content-type: application/msword");
		header("Content-Disposition: attachment; filename=$filename1");
		header("Pragma: no-cache");
		header("Expires: 0");
		print $excel;
	} elseif ($etype == 'excel') {
		header("Content-type: application/msexcel");
		header("Content-Disposition: attachment; filename=$filename2");
		header("Pragma: no-cache");
		header("Expires: 0");
		//Tres important
		$okPourExcel = iconv('UTF-8', 'Windows-1252', $excel);
		print $okPourExcel;
	} elseif ($etype == 'printer') {
		print '<title>' . H_TITLE . '</title>
	<script type="text/javascript">
	window.onload = function () {
		window.print();
	}
	</script>
	';
		print $excel;
	} elseif ($etype == 'PDF') {
		HezecomPDF($excel, $pdf_output);
	}
	?>