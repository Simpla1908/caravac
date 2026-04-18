
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
        <h2><strong>VERSEMENT CAISSE DU <?php echo dateAffiche($_SESSION['dte_vers']); ?></strong></h2>
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
                <td ><b>FOND DE CAISSE</b></td>
                <td align="center"><?php echo afficheMontant('USD',$_SESSION['fond_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF',$_SESSION['fond_cdf']); ?></td>
                </tr>
                <tr class="odd gradeX">
                <td ><b>MONTANT PERCU</b></td>
                <td align="center"><?php echo afficheMontant('USD',$_SESSION['percu_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF',$_SESSION['percu_cdf']); ?></td>
                </tr>
                <tr class="odd gradeX">
                <td ><b>RENDU</b></td>
                <td align="center"><?php echo afficheMontant('USD',$_SESSION['rendu_usd']); ?></td>
                <td align="center"><?php echo afficheMontant('CDF',$_SESSION['rendu_cdf']); ?></td>
                </tr>
                <tr class="odd gradeX">
                 <td ><b>MONTANT A VERSER</b></td>
                    <td align="center"><?php echo afficheMontant('USD',$_SESSION['averser_usd']); ?></td>
                    <td align="center"><?php echo afficheMontant('CDF',$_SESSION['averser_cdf']); ?></td>
                </tr>
                <tr class="odd gradeX">
                 <td><b>MONTANT VERSE</b></td>
                    <td align="center"><?php echo afficheMontant('USD',$_SESSION['verser_usd']); ?></td>
                    <td align="center"><?php echo afficheMontant('CDF',$_SESSION['verser_cdf']); ?></td>
                </tr>
                 <tr class="odd gradeX">
                  <td><b>SOLDE</b></td>
                   <td align="center"><?php echo afficheMontant('USD',$_SESSION['solde_usd']); ?></td>
                    <td align="center"><?php echo afficheMontant('CDF',$_SESSION['solde_cdf']); ?></td>
                </tr>
        </tbody>
    </table>
   <h3 align="center">DETAILS VERSEMENT</h3>
   <table align="center" id="table" style="font-size:9pt;width:800px">
        <thead>
        <tr>
            <th align="center">Numero</th>
            <th align="center">Montant CDF</th>
            <th align="center">Montant CDF</th>

        </tr>
        </thead>
        <tbody>
             <?php 
                $nbArticles = count($_SESSION['detailversement']['i']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                    <td align="center"><?php echo $_SESSION['detailversement']['num'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['detailversement']['mont_usd'][$i] ?></td>
                    <td align="center"><?php echo $_SESSION['detailversement']['mont_cdf'][$i] ?></td>

                </tr>
                <?php
                 }
                 ?>
        </tbody>
    </table>
    <div id="entete1" align="center" style="margin-left:100px;">
        <span>Imprimé le <?php echo date('d/m/Y'); ?> par <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?></span> 
    </div>

</div>
