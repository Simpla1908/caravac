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
        <h2><strong>PLAN DES COMPTES</strong></h2>
   </div>
   <table id="table">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Compte</th>
            <th>Classe</th>
        </tr>
    </thead>
    <tbody>
    <?php 
   // var_dump($_SESSION['Comptes']);
    $nbre=count($_SESSION['Comptes']['numero']);
    for ($i = 0; $i <$nbre; $i++){
        $numero=$_SESSION['Comptes']['numero'][$i];
        $nom=$_SESSION['Comptes']['nom'][$i];
        $classe=$_SESSION['Comptes']['classe'][$i];
    ?> 
    <tr>
        <td><?php echo $numero ; ?></td>
        <td><?php echo $nom; ?></td>
        <td><?php echo  strtolower($classe); ?></td>
    </tr>
    <?php }?> 
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
