
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
        <h2><strong>LISTE DES VERSEMENTS</strong></h2>
    </div>

    <table align="center" id="table">
            <thead>
                <tr>
                <th>#</th>
                <th>Utilisateur</th>
                <th>Date</th>
                <th>Montant versé USD</th>
                <th>Montant versé CDF</th>
                <th>Ecart USD</th>
                <th>Ecart CDF</th>
                </tr>
            </thead>
            <tbody>
           <?php
            $nbArticles = count($_SESSION['versement']['n']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
             ?>
            <tr>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['n'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['util'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['dte'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['musd'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['mcdf'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['susd'][$i] ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['versement']['scdf'][$i] ?></td>
               
            </tr>
            <?php
            }
          ?>
        </tbody>
          <tfoot>
        <tr>
            <td colspan="3"><b>Total</b></td>
            <td><b><?php echo $_SESSION['totusd1'] ?></b></td>
            <td><b><?php echo $_SESSION['totcdf1'] ?></b></td>
            <td><b><?php echo $_SESSION['totusd'] ?></b></td>
            <td><b><?php echo $_SESSION['totcdf'] ?></b></td>
        </tr>
    </tfoot>
        </table>
    <div id="entete1" align="center" style="margin-left:100px;">
        <span>Imprimé le <?php echo date('d/m/Y'); ?> par <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?></span> 
    </div>

</div>
