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
        <h2><strong>BALANCE</strong></h2>
         <h4><?php echo strtoupper($_SESSION['exercice_lib']);?></h4>
         <h4>PERIODE : Du <?php echo $_SESSION['datedebut'];?> au <?php echo $_SESSION['datefin'];?></h4>
         <h4>MONNAIE : <?php echo $_SESSION['devise'];?></h4>
    </div>
   <table id="table">
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
             <?php 
                $nbArticles = count($_SESSION['balance']['numero']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
               if($_SESSION['balance']['numero'][$i]!=''){
                ?>
                <tr>
                <td><?php echo $_SESSION['balance']['numero'][$i];?></td>
                <td><?php echo $_SESSION['balance']['compte'][$i]; ?></td>
                <td><?php if($_SESSION['balance']['SPd'][$i]>0){echo arrondir($_SESSION['balance']['SPd'][$i]);}; ?></td>
                <td><?php if($_SESSION['balance']['SPc'][$i]>0){echo arrondir($_SESSION['balance']['SPc'][$i]);}; ?></td>
                <td><?php if($_SESSION['balance']['Cud'][$i]>0){echo arrondir($_SESSION['balance']['Cud'][$i]);}; ?></td>
                <td><?php if($_SESSION['balance']['Cuc'][$i]>0){echo arrondir($_SESSION['balance']['Cuc'][$i]);}; ?></td>
               <td><?php if($_SESSION['balance']['NSd'][$i]>0){echo $_SESSION['balance']['NSd'][$i];}; ?></td>
               <td><?php if($_SESSION['balance']['NSc'][$i]>0){echo $_SESSION['balance']['NSc'][$i];}; ?></td>
               </tr>
                <?php
                }else{
                 ?>  
               <tr>
                <th><?php echo $_SESSION['balance']['numero'][$i];?></th>
                <th><?php echo $_SESSION['balance']['compte'][$i]; ?></th>
                <th><?php if($_SESSION['balance']['SPd'][$i]>0){echo arrondir($_SESSION['balance']['SPd'][$i]);}; ?></th>
                <th><?php if($_SESSION['balance']['SPc'][$i]>0){echo arrondir($_SESSION['balance']['SPc'][$i]);}; ?></th>
                <th><?php if($_SESSION['balance']['Cud'][$i]>0){echo arrondir($_SESSION['balance']['Cud'][$i]);}; ?></th>
                <th><?php if($_SESSION['balance']['Cuc'][$i]>0){echo arrondir($_SESSION['balance']['Cuc'][$i]);}; ?></th>
               <th><?php if($_SESSION['balance']['NSd'][$i]>0){echo $_SESSION['balance']['NSd'][$i];}; ?></th>
               <th><?php if($_SESSION['balance']['NSc'][$i]>0){echo $_SESSION['balance']['NSc'][$i];}; ?></th>
               </tr>
                <?php
                 }
                 }
                 ?>
        </tbody>
         <tfoot>
                       <tr>
                      <th colspan="2">TOTAL GENERAL</th>
                      <th ><?php echo $_SESSION['tspd'];?></th>
                      <th ><?php echo $_SESSION['tspc'];?></th>
                      <th ><?php echo $_SESSION['tscd'];?></th>
                      <th ><?php echo $_SESSION['tscc'];?></th>
                      <th ><?php echo $_SESSION['tnouveausolded'];?></th>
                      <th ><?php echo $_SESSION['tnouveausoldec'];?></th>
                      </tr>
                    </tfoot>
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
