
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Times New Roman;
        font-size: 10pt;
        color: #000;
    }

    #titre {
        margin-bottom: 5px;
    }

    #table {
        width: 100%;
        border-left: 0.5px solid #000;
        border-top: 0.5px solid #000;
        border-spacing: 0;
        border-collapse: collapse;
        font-family: helvetica;

    }

    #table th {
        background: #eee;
        border: 0.5px solid #000;
        height: 10px;
        padding: 1mm;
        text-transform: uppercase;
        /*font-weight:bold;*/
    }

    #table td {
        border-right: 0.5px solid #000;
        border-bottom: 0.5px solid #000;
        padding: 1mm;
    }

    .page {
        height: 297mm;
        width: 210mm;
        page-break-after: always;
    }

    #entete {
        text-align: center;
        /*text-transform: uppercase;*/
        padding-top: 10px;
        padding-bottom: 20px;
        font-family: helvetica;
    }

    #entete1 {
        margin-top: 10px;
        margin-right: 70px;
        text-align: center;
    }

</style>
<div id="content">
    <div id="entete">
        <h2><strong>RECETTES <?php echo$description; ?></strong></h2>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th align="center">Date</th>
                <th align="center">Séjour</th>
                <th align="center">Consommations</th>
                <th align="center">Montant Total</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            $totsej = 0;
            $totcons = 0;
            $i = 1;
            $n = count($_SESSION['recette']['date']);
            for ($j = 0; $j <= $n - 1; $j++) {
                $dte = $_SESSION['recette']['date'][$j];
                if (isset($_SESSION['recette']['sejour'][$dte])) {
                    $mpsej = $_SESSION['recette']['sejour'][$dte];
                } else {
                    $mpsej = 0;
                }
                if (isset($_SESSION['recette']['consommation'][$dte])) {
                    $mpcons = $_SESSION['recette']['consommation'][$dte];
                } else {
                    $mpcons = 0;
                }
                ?>
                <tr>
                    <td><?php echo dateAffiche($dte); ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpsej); ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpcons); ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpsej + $mpcons); ?></td>
                </tr>
                <?php
                $i++;
                $totsej+=$mpsej;
                $totcons+=$mpcons;
            }
            ?>
            <tr>
                <td><b>Total</b></td>
                <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $totsej); ?></b></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $totcons); ?></td>
                <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'], $totsej + $totcons); ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
