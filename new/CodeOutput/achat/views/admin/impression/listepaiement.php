
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
    
    #entete23 {
        text-align: center;
        padding-top: 185px;
        padding-bottom: 15px;
        font-family: helvetica;
    }

</style>


<div id="content">
    <div id="entete">
        <h2>
            
            <strong><u>LISTE DE PAIEMENTS</u></strong>
            
        </h2>
    </div>
    <table align="center" id="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Fournisseurs</th>
                <th>N° Bon cmd</th>
                <th>Montant total</th>
                <th>Montant payé</th>
                <th>Solde</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $n = count($_SESSION['rows_paiement']['i']);
            for ($i = 0; $i <= $n - 1; $i++) {
                ?>
                <tr>
                <td><?php echo $_SESSION['rows_paiement']['i'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_paiement']['Fournisseurs'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_paiement']['Boncmd'][$i]; ?></td>
                <td><?php echo $_SESSION['rows_paiement']['Montanttotal'][$i];?></td>
                <td><?php echo $_SESSION['rows_paiement']['Montantpaye'][$i];?></td>
                <td><?php echo $_SESSION['rows_paiement']['Solde'][$i];?></td>
                </tr>
                <?php
               }
                ?>
        </tbody>
    </table>
    <br>
    <div id="entete1" align="right">
        <span>Fait à <?php echo ucfirst($ville_hotel); ?>, le  <?php echo date('d/m/Y'); ?></span> <br>
        <?php echo strtoupper($_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user']); ?>
    </div>
    <?php // if($rows->i_souscription ==  0){ ?>
    <div id="entete23">
        <span><i>Imprimé le  <?php echo date('d/m/Y'); ?> par </i></span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
    </div>
    <?php // }?>
</div>
