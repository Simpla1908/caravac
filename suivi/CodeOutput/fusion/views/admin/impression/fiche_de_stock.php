<?php 
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('memory_limit', '1024M');
?>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: helvetica;
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
        text-transform: uppercase;
        padding-top: 35px;
        padding-bottom: 15px;
        font-family: helvetica;
    }

    #entete1 {
        margin-top: 55px;
        margin-right: 70px;
    }
</style>
<div id="content">
    <div id="entete1" align="right">
        <span>Kinshasa, </span><?php echo 'le ' . date('d/m/Y'); ?>
    </div>
    <div id="entete">
        <h3><u>FICHE DE STOCK<?php echo ' DU ' . dateAffiche($_SESSION['fiche_dte1']) . ' AU ' . dateAffiche($_SESSION['fiche_dte2']); ?></u></h3><br>
        <span>(Depot:<?php echo $_SESSION['libelle_depot'] ?>)</span>
    </div>
    <table width="444" border="1" align="center" id="table">
        <thead>
            <tr>
                <th>N°</th>
                <th>DESIGNATION</th>
                <th>INITIALE</th>
                <th>ENTREE</th>
                <th>SORTIE</th>
                 <th>AVARIE</th>
                <th>SOLDE</th>
                <th>UNITE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($_SESSION['articles'] as $art) {
                $q0 = 0;
                $qin = 0;
                $qout = 0;
                $qsolde = 0;
                $qte_declasse = 0;
                $idprod = $art->idprod;
                $des = $art->produit;
                    if (isset($_SESSION['fs']['q0'][$idprod])) {
                        $q0 = $_SESSION['fs']['q0'][$idprod];
                    } else {
                        $_SESSION['fs']['q0'][$idprod] = $q0;
                    }
                    if (isset($_SESSION['fs']['qin'][$idprod])) {
                        $qin = $_SESSION['fs']['qin'][$idprod];
                    } else {
                        $_SESSION['fs']['qin'][$idprod] = $qin;
                    }
                    if (isset($_SESSION['fs']['qout'][$idprod])) {
                        $qout = $_SESSION['fs']['qout'][$idprod];
                    } else {
                        $_SESSION['fs']['qout'][$idprod] = $qout;
                    }
                    if (isset($_SESSION['fs']['qavarie'][$idprod])) {
                        $qte_declasse = $_SESSION['fs']['qavarie'][$idprod];
                    } else {
                        $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
                    }
                $qsolde = ($q0 + $qin) - ($qout + $qte_declasse);
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i ?></td>
                    <td><?php echo $des ?></td>
                    <td><?php echo $q0 ?></td>
                    <td><?php echo $qin ?></td>
                    <td><?php echo $qout ?></td>
                    <td><?php echo $qte_declasse ?></td>
                    <td><?php echo $qsolde ?></td>
                    <td><?php echo $art->unite ?></td>
                </tr>
                <?php
                $i++;
                };
            ?>
        </tbody>

    </table>
</div>

