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
        <h2><strong>BON DE VERSEMENT N°<?php echo $_SESSION['numero_vers']; ?></strong></h2>
    </div>
    <h3 align="center">DETAILS VENTE</h3>
    <table align="center" id="table" style="font-size:9pt;width:800px;">
        <thead>
            <tr>
                <th> </th>
                <th align="center">USD</th>
                <th align="center">CDF</th>
            </tr>
        </thead>
        <tbody>
            <tr class="odd gradeX">
                <td><b>FOND DE CAISSE</b></td>
                <td align="center"><?php echo afficheMontant('USD', $_SESSION['fond_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF', $_SESSION['fond_cdf']); ?></td>
            </tr>
            <tr class="odd gradeX">
                <td><b>MONTANT PERCU</b></td>
                <td align="center"><?php echo afficheMontant('USD', $_SESSION['percu_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF', $_SESSION['percu_cdf']); ?></td>
            </tr>
            <tr class="odd gradeX">
                <td><b>RENDU</b></td>
                <td align="center"><?php echo afficheMontant('USD', $_SESSION['rendu_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF', $_SESSION['rendu_cdf']); ?></td>
            </tr>
            <tr class="odd gradeX">
                <td><b>REMBOURSEMENT</b></td>
                <td align="center"><?php echo afficheMontant('USD', $_SESSION['remb_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF', $_SESSION['remb_cdf']); ?></td>
            </tr>
            <tr class="odd gradeX">
                <td><b>MONTANT DISPONIBLE</b></td>
                <td align="center"><?php echo afficheMontant('USD', $_SESSION['averser_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF', $_SESSION['averser_cdf']); ?></td>
            </tr>
            <tr class="odd gradeX">
                <td><b>MONTANT VERSE</b></td>
                <td align="center"><?php echo afficheMontant('USD', $_SESSION['verser_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF', $_SESSION['verser_cdf']); ?></td>
            </tr>
            <tr class="odd gradeX">
                <td><b>SOLDE</b></td>
                <td align="center"><?php echo afficheMontant('USD', $_SESSION['solde_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF', $_SESSION['solde_cdf']); ?></td>
            </tr>
        </tbody>
    </table>
    <h3 align="center">BILLETAGE</h3>
    <table align="center" id="table" style="font-size:9pt;width:800px">
        <thead>
            <tr>
                <th align="center">BILLET USD</th>
                <th align="center">NOMBRE</th>
                <th align="center">TOTAL</th>
                <th align="center">BILLET CDF</th>
                <th align="center">NOMBRE</th>
                <th align="center">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center">100 USD</td>
                <td align="center"><?php echo $_SESSION['100usd']; ?></td>
                <td align="center">
                    <?php
                    $tot100 = $_SESSION['100usd'] * 100;
                    echo afficheMontant('USD', $tot100);
                    ?>
                </td>
                <td align="center">20.000 CDF</td>
                <td align="center"><?php echo $_SESSION['20000cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf1 =  $_SESSION['20000cdf'] * 20000;
                    echo afficheMontant('CDF', $totcdf1);
                    ?>
                </td>
            </tr>
            <tr>
                <td align="center">50 USD</td>
                <td align="center"><?php echo $_SESSION['50usd']; ?></td>
                <td align="center">
                    <?php
                    $tot50 = $_SESSION['50usd'] * 50;
                    echo afficheMontant('USD', $tot50);
                    ?>
                </td>
                <td align="center">10.000 CDF</td>
                <td align="center"><?php echo $_SESSION['10000cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf2 =  $_SESSION['10000cdf'] * 10000;
                    echo afficheMontant('CDF', $totcdf2);
                    ?>
                </td>
            </tr>
            <tr>
                <td align="center">20 USD</td>
                <td align="center"><?php echo $_SESSION['20usd']; ?></td>
                <td align="center">
                    <?php
                    $tot20 = $_SESSION['20usd'] * 20;
                    echo afficheMontant('USD', $tot20);
                    ?>
                </td>
                <td align="center">5.000 CDF</td>
                <td align="center"><?php echo $_SESSION['5000cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf3 =  $_SESSION['5000cdf'] * 5000;
                    echo afficheMontant('CDF', $totcdf3);
                    ?>
                </td>
            </tr>
            </tr>
            <tr>
                <td align="center">10 USD</td>
                <td align="center"><?php echo $_SESSION['10usd']; ?></td>
                <td align="center">
                    <?php
                    $tot10 = $_SESSION['10usd'] * 10;
                    echo afficheMontant('USD', $tot10);
                    ?>
                </td>
                <td align="center">1000 CDF</td>
                <td align="center"><?php echo $_SESSION['1000cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf4 =  $_SESSION['1000cdf'] * 1000;
                    echo afficheMontant('CDF', $totcdf4);
                    ?>
                </td>
            </tr>
            <tr>
                <td align="center">5 USD</td>
                <td align="center"><?php echo $_SESSION['5usd']; ?></td>
                <td align="center">
                    <?php
                    $tot5 = $_SESSION['5usd'] * 5;
                    echo afficheMontant('USD', $tot5);
                    ?>
                </td>
                <td align="center">500 CDF</td>
                <td align="center"><?php echo $_SESSION['500cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf5 =  $_SESSION['500cdf'] * 500;
                    echo afficheMontant('CDF', $totcdf5);
                    ?>
                </td>
            </tr>
            <tr>
                <td align="center">1 USD</td>
                <td align="center"><?php echo $_SESSION['1usd']; ?></td>
                <td align="center">
                    <?php
                    $tot1 = $_SESSION['1usd'] * 1;
                    echo afficheMontant('USD', $tot1);
                    ?>
                </td>
                <td align="center">200 CDF</td>
                <td align="center"><?php echo $_SESSION['200cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf6 =  $_SESSION['200cdf'] * 200;
                    echo afficheMontant('CDF', $totcdf6);
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td> </td>
                <td align="center">100 CDF</td>
                <td align="center"><?php echo $_SESSION['100cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf7 =  $_SESSION['100cdf'] * 100;
                    echo afficheMontant('CDF', $totcdf7);
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td> </td>
                <td align="center">50 CDF</td>
                <td align="center"><?php echo $_SESSION['50cdf']; ?></td>
                <td align="center">
                    <?php
                    $totcdf8 =  $_SESSION['50cdf'] * 50;
                    echo afficheMontant('CDF', $totcdf8);
                    ?>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2"><b>TOTAL</b></td>
                <td align="center">
                    <b>
                        <?php
                        $totgen1 = $tot1 + $tot5 + $tot10 + $tot20 + $tot50 + $tot100;
                        echo afficheMontant('USD', $totgen1); ?>
                    </b>
                </td>
                <td colspan="2" align="center"><b>TOTAL</b></td>
                <td align="center">
                    <b>
                        <?php
                        $totgen2 = $totcdf8 + $totcdf7 + $totcdf6 + $totcdf5 + $totcdf4 + $totcdf3 + $totcdf2 + $totcdf1;
                        echo afficheMontant('CDF', $totgen2);
                        ?>
                    </b>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="entete1" align="center" style="margin-left:100px;">
        <span>Imprimé le <?php echo date('d/m/Y'); ?> par <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?></span>
    </div>

</div>