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
	<strong style="font-family:arial;">BILAN ACTIF</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	<strong>' . strtoupper($_SESSION['exercice_lib']) . '</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	Du ' . $_SESSION['dte1n'] . ' au ' . $_SESSION['dte2n'] . '</p>
	<p style="font-family:arial; font-size:15px;" align="center">
	<strong>' . $_SESSION['devise'] . '</strong></p><br>';
$excel .= '   <table id="table" border="1" width="100%">
        <thead>
                <tr>
                    <th rowspan="2"  style="text-align: center;">REF</th>
                    <th rowspan="2"  style="text-align: center;">ACTIF</th>
                    <th rowspan="2"  style="text-align: center;">NOTE</th>  
                    <th colspan="3"  style="text-align: center;">' . strtoupper($_SESSION['exercicesnlib']) . '</th>
                    <th style="text-align: center;">' . strtoupper($_SESSION['exercicesn1lib']) . '</th>
                </tr>
                <tr>
                    <th  style="text-align: center;" >Brut</th>
                    <th  style="text-align: center;">Amort/Dépréc</th>
                    <th  style="text-align: center;" >Net</th>
                    <th  style="text-align: center;">Net</th>
                </tr>
            </thead>
        <tbody>
  ';
$nbArticles = count($_SESSION['BilanA']['ref']);
for ($i = 0; $i <= $nbArticles - 1; $i++) {
	$excel .= ' <tr>
                    <td style="text-align: center;">' . $_SESSION['BilanA']['ref'][$i] . '</td>
                    <td class="col-md-4">' . $_SESSION['BilanA']['actif'][$i] . '</td>
                    <td style="text-align: center;">' . $_SESSION['BilanA']['note'][$i] . '</td>
                    <td class="col-md-2">';
	if ($_SESSION['BilanA']['brut'][$i] > 0 || $_SESSION['BilanA']['brut'][$i] < 0 || $_SESSION['BilanA']['afficher'][$i] == 1) {
		$excel .= FormatChiffreCompta($_SESSION['BilanA']['brut'][$i]);
	}
	$excel .= '</td>
                    <td class="col-md-2">';
	if ($_SESSION['BilanA']['amort'][$i] > 0 || $_SESSION['BilanA']['amort'][$i] < 0 || $_SESSION['BilanA']['afficher'][$i] == 1) {
		$excel .= FormatChiffreCompta($_SESSION['BilanA']['amort'][$i]);
	}
	$excel .= '</td>
                    <td class="col-md-2">';
	if ($_SESSION['BilanA']['netn'][$i] > 0 || $_SESSION['BilanA']['netn'][$i] < 0 || $_SESSION['BilanA']['afficher'][$i] == 1) {
		$excel .= FormatChiffreCompta($_SESSION['BilanA']['netn'][$i]);
	}
	$excel .= '</td>
                    <td class="col-md-6">';
	if ($_SESSION['BilanA']['netn1'][$i] > 0 || $_SESSION['BilanA']['netn1'][$i] < 0 || $_SESSION['BilanA']['afficher'][$i] == 1) {
		$excel .= FormatChiffreCompta($_SESSION['BilanA']['netn1'][$i]);
	}
	$excel .= '</td></tr>';
}
$excel .= '</tbody>
    </table>';
$filename1 = 'Bilanactif' . date('Y-m-d') . '.doc';
$filename2 = 'Bilanactif' . date('Y-m-d') . '.xls';
$pdf_output = 'Bilanactif' . date('Y-m-d') . '.pdf';
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
	window.onload = function() {
		window.print();
	}
</script>
';
	print $excel;
} elseif ($etype == 'PDF') {
	HezecomPDF($excel, $pdf_output);
}
?>