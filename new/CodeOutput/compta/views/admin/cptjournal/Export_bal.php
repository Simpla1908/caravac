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
	<strong style="font-family:arial;">BALANCE</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	<strong>' . strtoupper($_SESSION['exercice_lib']) . '</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	Du ' . $_SESSION['datedebut'] . ' au ' . $_SESSION['datefin'] . '</p>
	<p style="font-family:arial; font-size:15px;" align="center">
	<strong>' . $_SESSION['devise'] . '</strong></p><br>';
$excel .= '  <table id="table" border="1" width="100%">
        <thead>
        <tr>
        <th  rowspan="2" style="text-align: center;">Numéro</th>
        <th  rowspan="2" style="text-align: center;">Compte</th>
        <th  colspan="2" style="text-align: center;">Soldes précédents</th>  
        <th  colspan="2" style="text-align: center;">Cumuls</th>
        <th  colspan="2" style="text-align: center;">Nouveaux soldes</th>
        </tr>
        <tr>
        <th style="text-align: center;">D</th>
        <th style="text-align: center;">C</th>
        <th style="text-align: center;">D</th>
        <th style="text-align: center;">C</th>
        <th style="text-align: center;">D</th>
        <th style="text-align: center;">C</th>
        </tr>
        </thead>
        <tbody>
  ';
$nbArticles = count($_SESSION['balance']['numero']);
for ($i = 0; $i <= $nbArticles - 1; $i++) {
	if ($_SESSION['balance']['numero'][$i] != '') {
		$excel .= '<tr>
                <td>' . $_SESSION['balance']['numero'][$i] . '</td>
                <td>' . $_SESSION['balance']['compte'][$i] . '</td>
                <td>';
		if ($_SESSION['balance']['SPd'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['SPd'][$i]);
		}
		$excel .= '</td><td>';
		if ($_SESSION['balance']['SPc'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['SPc'][$i]);
		}
		$excel .= '</td><td>';
		if ($_SESSION['balance']['Cud'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['Cud'][$i]);
		}
		$excel .= '</td><td>';
		if ($_SESSION['balance']['Cuc'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['Cuc'][$i]);
		}
		$excel .= '</td><td>';
		if ($_SESSION['balance']['NSd'][$i] > 0) {
			$excel .= $_SESSION['balance']['NSd'][$i];
		}
		$excel .= '</td><td>';
		if ($_SESSION['balance']['NSc'][$i] > 0) {
			$excel .= $_SESSION['balance']['NSc'][$i];
		}
		$excel .= '</td></tr>';
	} else {
		$excel .= ' <tr>
                <th>' . $_SESSION['balance']['numero'][$i] . '</th>
                <th>' . $_SESSION['balance']['compte'][$i] . '</th>
                <th>';
		if ($_SESSION['balance']['SPd'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['SPd'][$i]);
		}
		$excel .= '</th><th>';
		if ($_SESSION['balance']['SPc'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['SPc'][$i]);
		};
		$excel .= '</th><th>';
		if ($_SESSION['balance']['Cud'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['Cud'][$i]);
		}
		$excel .= '</th><th>';
		if ($_SESSION['balance']['Cuc'][$i] > 0) {
			$excel .= arrondir($_SESSION['balance']['Cuc'][$i]);
		}
		$excel .= '</th><th>';
		if ($_SESSION['balance']['NSd'][$i] > 0) {
			$excel .= $_SESSION['balance']['NSd'][$i];
		}
		$excel .= '</th><th>';
		if ($_SESSION['balance']['NSc'][$i] > 0) {
			$excel .= $_SESSION['balance']['NSc'][$i];
		}
		$excel .= '</th></tr>';
	}
}
$excel .= '</tbody>
         <tfoot>
                       <tr>
                      <th colspan="2">TOTAL GENERAL</th>
                      <th >' . $_SESSION['tspd'] . '</th>
                      <th >' . $_SESSION['tspc'] . '</th>
                      <th >' . $_SESSION['tscd'] . '</th>
                      <th >' . $_SESSION['tscc'] . '</th>
                      <th >' . $_SESSION['tnouveausolded'] . '</th>
                      <th >' . $_SESSION['tnouveausoldec'] . '</th>
                      </tr>
                    </tfoot>
                    </tfoot>
    </table>';



$filename1 = 'Balance' . date('Y-m-d') . '.doc';
$filename2 = 'Balance' . date('Y-m-d') . '.xls';
$pdf_output = 'Balance' . date('Y-m-d') . '.pdf';
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