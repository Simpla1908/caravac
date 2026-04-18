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
	<strong style="font-family:arial;">BILAN PASSIF</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	<strong>' . strtoupper($_SESSION['exercice_lib']) . '</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	Du ' . $_SESSION['dte1n'] . ' au ' . $_SESSION['dte2n'] . '</p>
	<p style="font-family:arial; font-size:15px;" align="center">
	<strong>' . $_SESSION['devise'] . '</strong></p><br>';
$excel .= '<table id="table" border="1" width="100%">
       <thead>
                <tr>
                    <th rowspan="2"  style="text-align: center;">REF</th>
                    <th rowspan="2"  style="text-align: center;">PASSIF</th>
                    <th rowspan="2"  style="text-align: center;">NOTE</th>  
                    <th style="text-align: center;">' . strtoupper($_SESSION['exercicesnlib']) . '</th>
                    <th style="text-align: center;">' . strtoupper($_SESSION['exercicesn1lib']) . '</th>
                </tr>
                <tr>
                    <th  style="text-align: center;">Net</th>
                    <th  style="text-align: center;">Net</th>
                </tr>
       </thead>
        <tbody>
  ';
$nbArticles = count($_SESSION['BilanP']['ref']);
for ($i = 0; $i <= $nbArticles - 1; $i++) {
	$excel .= '<tr>
                    <td>' . $_SESSION['BilanP']['ref'][$i] . '</td>
                    <td class="col-md-6">' . $_SESSION['BilanP']['passif'][$i] . '</td>
                    <td style="text-align: center;">' . $_SESSION['BilanP']['note'][$i] . '</td>
                    <td class="col-md-3">';
	if ($_SESSION['BilanP']['netn'][$i] > 0 || $_SESSION['BilanP']['netn'][$i] < 0 || $_SESSION['BilanP']['afficher'][$i] == 1) {
		$excel .= FormatChiffreCompta($_SESSION['BilanP']['netn'][$i]);
	}
	$excel .= '</td>
                    <td class="col-md-3">';
	if ($_SESSION['BilanP']['netn'][$i] > 0 || $_SESSION['BilanP']['netn'][$i] < 0 || $_SESSION['BilanP']['afficher'][$i] == 1) {
		$excel .= FormatChiffreCompta($_SESSION['BilanP']['netn'][$i]);
	}
	$excel .= '</td></tr>';
}
$excel .= '</tbody>
    </table>';
$filename1 = 'Bilanpassif' . date('Y-m-d') . '.doc';
$filename2 = 'Bilanpassif' . date('Y-m-d') . '.xls';
$pdf_output = 'Bilanpassif' . date('Y-m-d') . '.pdf';
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