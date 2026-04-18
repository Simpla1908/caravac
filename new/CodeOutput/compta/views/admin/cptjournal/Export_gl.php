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
$_SESSION['grandlivre'] = array();
$_SESSION['grandlivre']['numerocompte'] = array();
$_SESSION['grandlivre']['compte'] = array();
$_SESSION['grandlivre']['date'] = array();
$_SESSION['grandlivre']['reference'] = array();
$_SESSION['grandlivre']['libelle'] = array();
$_SESSION['grandlivre']['debitcdf'] = array();
$_SESSION['grandlivre']['creditcdf'] = array();
$_SESSION['grandlivre']['solde1'] = array();
$_SESSION['grandlivre']['devise'] = array();
$_SESSION['grandlivre']['cours'] = array();
$_SESSION['grandlivre']['debitusd'] = array();
$_SESSION['grandlivre']['creditusd'] = array();
$_SESSION['grandlivre']['solde2'] = array();
$_SESSION['grandlivre']['afficher'] = array();
$devisecdf = getsymbole_local();
$deviseusd = getsymbole_devise();
$totdebitcdf = 0;
$totdebitusd = 0;
$totcreditcdf = 0;
$totcreditusd = 0;
$totsolde1 = 0;
$totsolde2 = 0;
$stotdebitcdf = 0;
$stotdebitusd = 0;
$stotcreditcdf = 0;
$stotcreditusd = 0;
$etype = get('etype');
$excel = '
	<p style="font-family:arial; font-size:18px;" align="center">
	<strong style="font-family:arial;">GRAND LIVRE</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	<strong>' . strtoupper($_SESSION['exercice_lib']) . '</strong></p>
	<p style="font-family:arial; font-size:15px;" align="center">
	Du ' . $_SESSION['datedebut'] . ' au ' . $_SESSION['datefin'] . '</p><br>';
$excel .= ' <table id="table" border="1" width="100%">
                    <thead>
                        <tr>
                            <th align="center">DATE</th>
                            <th align="center">REF.</th>
                            <th align="center">LIBELLE</th>
                            <th align="center">DEBIT</th>  
                            <th align="center">CREDIT</th>
                            <th align="center">SOLDE</th>
                            <th align="center">DEVISE</th>
                            <th align="center">COURS</th>
                            <th align="center">DEBIT</th>
                            <th align="center">CREDIT</th>
                            <th align="center">SOLDE</th>

                        </tr>
                    </thead>
                    <tbody>
  ';
$exercice_id = $_SESSION['GL_exercice_id'];
$numerocompte = $_SESSION['GL_numerocompte'];
$d1 = $_SESSION['GL_d1'];
$d2 = $_SESSION['GL_d2'];
$site_id = $_SESSION['GL_site_id'];
$resultCGL = ComptesGrandLivre($exercice_id, $numerocompte, $d1, $d2, $site_id, $bdd);
//var_dump($resultCGL);
foreach ($resultCGL as $rowsCGL) {
	$dataCGL = INFOSFromAccountNumber($rowsCGL->compte_ecriture, $rowsCGL->long_compte, $bdd);
	$libcompte = $dataCGL['lib'];
	$numerocompteCGL = $rowsCGL->compte_ecriture;
	if ($numerocompteCGL != 131 && $numerocompteCGL != 139) {
		if (!in_array($numerocompteCGL, $_SESSION['grandlivre']['numerocompte'])) {
			array_push($_SESSION['grandlivre']['numerocompte'], $numerocompteCGL);
			$result = GenererGrandLivre($exercice_id, $numerocompteCGL, $d1, $d2, $site_id, $bdd);
			$cumuls = GenererGrandLivreCumuls($exercice_id, $numerocompteCGL, $d1, $d2, $site_id, $bdd);
			$debitcdf = $cumuls['debitcdf'];
			$creditcdf = $cumuls['creditcdf'];
			$debitusd = $cumuls['debitusd'];
			$creditusd = $cumuls['creditusd'];
			$stotdebitcdf += $debitcdfCML = $cumuls['debitcdf'];
			$stotcreditcdf += $creditcdfCML = $cumuls['creditcdf'];
			$stotdebitusd += $debitusdCML = $cumuls['debitusd'];
			$stotcreditusd += $creditusdCML = $cumuls['creditusd'];
			$solde1 = $cumuls['solde1'];
			$solde2 = $cumuls['solde2'];
			$stotsolde1 = $solde1;
			$stotsolde2 = $solde2;
			$excel .= '<tr>
                        <td colspan="11" align="center"><b>' . $numerocompteCGL . '  ' . ucfirst($libcompte) . '</b></td>
                    </tr>
                    <tr>
                        <td><b>Cumul antérieur</b></td>
                        <td></td>
                        <td></td>
                        <td>';
			if ($debitcdf > 0) {
				$excel .= FormatChiffreCompta($debitcdf);
			}

			$excel .= ' </td><td>';
			if ($creditcdf > 0) {
				$excel .= FormatChiffreCompta($creditcdf);
			}
			$excel .= '</td><td>';
			if ($solde1 > 0) {
				$excel .= FormatChiffreCompta($solde1);
			}

			$excel .= ' </td> 
                        <td></td>
                        <td></td>
                        <td>';
			if ($debitusd > 0) {
				$excel .= FormatChiffreCompta($debitusd);
			}

			$excel .= ' </td><td>';
			if ($creditusd > 0) {
				$excel .= FormatChiffreCompta($creditusd);
			}
			$excel .= ' </td><td>';
			if ($solde1 > 0) {
				$excel .= FormatChiffreCompta($solde1);
			}

			$excel .= '</td></tr>';
			foreach ($result as $rows) {
				$data = INFOSFromAccountNumber($rows->compte_ecriture, $rows->long_compte, $bdd);
				$libcompte = $data['lib'];
				$numero = $rows->compte_ecriture;
				$debitcdf = 0;
				if ($rows->debit > 0) {
					$debitcdf = arrondir(montant_equivalent_bdd($rows->devise, $devisecdf, $rows->taux, $rows->debit));
					$stotdebitcdf = $stotdebitcdf + $debitcdf;
				}
				$creditcdf = 0;
				if ($rows->credit > 0) {
					$creditcdf = arrondir(montant_equivalent_bdd($rows->devise, $devisecdf, $rows->taux, $rows->credit));
					$stotcreditcdf = $stotcreditcdf + $creditcdf;
				}
				$debitusd = 0;
				if ($rows->debit > 0) {
					$debitusd = arrondir(montant_equivalent_bdd($rows->devise, $deviseusd, $rows->taux, $rows->debit));
					$stotdebitusd = $stotdebitusd + $debitusd;
				}
				$creditusd = 0;
				if ($rows->credit > 0) {
					$creditusd = arrondir(montant_equivalent_bdd($rows->devise, $deviseusd, $rows->taux, $rows->credit));
					$stotcreditusd = $stotcreditusd + $creditusd;
				}
				$solde1 = $debitcdf - $creditcdf;
				$solde2 = $debitusd - $creditusd;
				$stotsolde1 = $stotsolde1 + $solde1;
				$stotsolde2 = $stotsolde2 + $solde2;
				$excel .= '<tr>
                        <td>' . dateAffiche($rows->dte) . '</td>
                        <td>' . $rows->reference . '</td>
                        <td>' . ucfirst($rows->descriptjourn) . '</td>
                        <td>';
				if ($debitcdf > 0) {
					$excel .= FormatChiffreCompta($debitcdf);
				}
				$excel .= ' </td>
                         <td>';

				if ($creditcdf > 0) {
					$excel .= FormatChiffreCompta($creditcdf);
				}
				$excel .= ' </td> 
                          <td>';
				if ($solde1 > 0) {
					$excel .= FormatChiffreCompta($solde1);
				}
				$excel .= '</td> 
                        <td>' . $deviseusd . '</td>
                        <td>' . $rows->taux . '</td>
                        <td>';
				if ($debitusd > 0) {
					$excel .= FormatChiffreCompta($debitusd);
				}

				$excel .= '</td>
                        <td>';
				if ($creditusd > 0) {
					$excel .= FormatChiffreCompta($creditusd);
				}
				$excel .= '</td>
                         <td>';
				if ($solde2 > 0) {
					$excel .= FormatChiffreCompta($solde2);
				}
				$excel .= '</td> 
                    </tr>';
			}

			$excel .= '<tr>
                        <td><b>Sous total</b></td>
                        <td></td>
                        <td></td>
                        <td>';
			if ($stotdebitcdf > 0) {
				$excel .= FormatChiffreCompta($stotdebitcdf);
			}
			$excel .= '</td>
                         <td>';
			if ($stotcreditcdf > 0) {
				$excel .= FormatChiffreCompta($stotcreditcdf);
			}
			$excel .= '</td> 
                          <td>';
			if ($stotsolde1 > 0) {
				$excel .=  FormatChiffreCompta($stotsolde1);
			}
			$excel .= '</td> 
                        <td></td>
                        <td></td>
                        <td>';
			if ($stotdebitusd > 0) {
				$excel .= FormatChiffreCompta($stotdebitusd);
			}
			$excel .= '
                        </td>
                        <td>';
			if ($stotcreditusd > 0) {
				$excel .= FormatChiffreCompta($stotcreditusd);
			}
			$excel .= '</td>
                         <td>';
			if ($stotsolde2 > 0) {
				$excel .= FormatChiffreCompta($stotsolde2);
			}
			$excel .= '</td> 

                    </tr>';
			$totdebitcdf = $totdebitcdf + $stotdebitcdf;
			$totcreditcdf = $totcreditcdf + $stotcreditcdf;
			$totdebitusd = $totdebitusd + $stotdebitusd;
			$totcreditusd = $totcreditusd + $stotcreditusd;
			$totsolde1 = $totsolde1 + $stotsolde1;
			$totsolde2 = $totsolde2 + $stotsolde2;
			$stotdebitcdf = 0;
			$stotdebitusd = 0;
			$stotcreditcdf = 0;
			$stotcreditusd = 0;
		}
	}
}
$excel .= '</tbody>
<tfoot>
	<tr>
		<th colspan="3">TOTAL</th>
		<th>';
if ($totdebitcdf > 0) {
	$excel .= FormatChiffreCompta($totdebitcdf);
}
$excel .= '</th>
		<th>';
if ($totcreditcdf > 0) {
	$excel .= FormatChiffreCompta($totcreditcdf);
}

$excel .= '</th>
		<th>';
if ($totsolde1 > 0) {
	$excel .= FormatChiffreCompta($totsolde1);
}

$excel .= '</th>
		<th colspan="2"></th>
		<th>';

if ($totdebitusd > 0) {
	$excel .= FormatChiffreCompta($totdebitusd);
}

$excel .= '</th>
		<th>';

if ($totcreditusd > 0) {
	$excel .= FormatChiffreCompta($totcreditusd);
}

$excel .= '</th>
		<th>';

if ($totsolde2 > 0) {
	$excel .= FormatChiffreCompta($totsolde2);
}

$excel .= '</th>
	</tr>
</tfoot>
</table>';
$filename1 = 'GrandLivre' . date('Y-m-d') . '.doc';
$filename2 = 'GrandLivre' . date('Y-m-d') . '.xls';
$pdf_output = 'GrandLivre' . date('Y-m-d') . '.pdf';
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