<?php
session_start();
?>
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
        <h2><strong>JOURNAL DE VENTE</strong></h2>
        <h4>PERIODE : Du <?php echo $_SESSION['datedebut'];?> au <?php echo $_SESSION['datefin'];?></h4>
        <h4>MONNAIE : <?php echo $_SESSION['devise'];?></h4>

    </div>
   <table id="table">
        <thead>
        <tr>
            <th align="center">DATE</th>
            <th align="center">REF</th>
            <th align="center">COMPTE</th>
            <th align="center">DESCRIPTION</th>
            <th align="center">DEBIT</th>
            <th align="center">CREDIT</th>

        </tr>
        </thead>
        <tbody>
             <?php 
                $nbArticles = count($_SESSION['journal']['n']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                ?>
                <tr>
                    <td><?php echo $_SESSION['journal']['date'][$i] ?></td>
                    <td><?php echo $_SESSION['journal']['reference'][$i] ?></td>
                    <td><?php echo $_SESSION['journal']['compte'][$i] ?></td>
                    <td><?php echo $_SESSION['journal']['description'][$i] ?></td>
                    <td><?php echo $_SESSION['journal']['debit'][$i] ?></td>
                    <td><?php echo $_SESSION['journal']['credit'][$i] ?></td>
                </tr>
                <?php
                 }
                 ?>
        </tbody>
         <tfoot>
                      <tr>
                      <th colspan="4">TOTAL</th>
                      <th ><?php echo $_SESSION['Totald'];?></th>
                      <th ><?php echo $_SESSION['Totalc'];?></th>
                      </tr>
                    </tfoot>
    </table>
     <div id="entete25">
        <p align="center">
            <br>
        <span>Imprimé le  <?php echo date('d/m/Y'); ?> par </span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </p>
    </div>
</div>
