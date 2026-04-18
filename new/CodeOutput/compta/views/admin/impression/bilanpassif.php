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
        <h2><strong>BILAN PASSIF</strong></h2>
         <h4><?php echo strtoupper($_SESSION['exercice_lib']);?></h4>
         <h4>PERIODE : Du <?php echo $_SESSION['dte1n'];?> au <?php echo $_SESSION['dte2n'];?></h4>
         <h4>MONNAIE : <?php echo $_SESSION['devise'];?></h4>
    </div>
   <table id="table">
       <thead>
                <tr>
                    <th rowspan="2"  style="text-align: center;">REF</th>
                    <th rowspan="2"  style="text-align: center;">PASSIF</th>
                    <th rowspan="2"  style="text-align: center;">NOTE</th>  
                    <th style="text-align: center;"><?php echo strtoupper($_SESSION['exercicesnlib']);?></th>
                    <th style="text-align: center;"><?php echo strtoupper($_SESSION['exercicesn1lib']);?></th>
                </tr>
                <tr>
                    <th  style="text-align: center;">Net</th>
                    <th  style="text-align: center;">Net</th>
                </tr>
       </thead>
        <tbody>
                <?php
                $nbArticles = count($_SESSION['BilanP']['ref']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                      ?>
                <tr>
                    <td><?php echo $_SESSION['BilanP']['ref'][$i];?></td>
                    <td class="col-md-6"><?php echo $_SESSION['BilanP']['passif'][$i];?></td>
                    <td style="text-align: center;"><?php echo $_SESSION['BilanP']['note'][$i];?></td>
                    <td class="col-md-3"><?php if($_SESSION['BilanP']['netn'][$i]>0||$_SESSION['BilanP']['netn'][$i]<0||$_SESSION['BilanP']['afficher'][$i]==1){echo FormatChiffreCompta($_SESSION['BilanP']['netn'][$i]);}; ?></td>
                    <td class="col-md-3"><?php if($_SESSION['BilanP']['netn'][$i]>0||$_SESSION['BilanP']['netn'][$i]<0||$_SESSION['BilanP']['afficher'][$i]==1){echo FormatChiffreCompta($_SESSION['BilanP']['netn'][$i]);}; ?></td>
                </tr>
              <?php
                   }
                 ?>
        </tbody>
    </table>
     <div id="entete25">
        <p align="center">
            <br>
        <span>Imprimé le  <?php echo date('d/m/Y'); ?> par </span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </p>
    </div>
</div>
