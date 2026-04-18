

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
        /*text-transform: uppercase;*/
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
        padding-top: 10px;
        padding-bottom: 20px;
        font-family: helvetica;
    }

    #entete1 {
        margin-top: 10px;
        margin-right: 70px;
        text-align: center;
    }
    #entete2 {
        border: 1px;
        margin-top: 10px;
        margin-right: 70px;
        text-align: center;
    }
</style>


<div id="content">
    <table align="center" id="table">
        <tr>
            <td style="width: 50%;">
                <img src="public/uploads/<?php echo $site->logo1; ?>" height="70" width="70"/>
            </td>
            <td style="width: 50%">
                <h1><b>DECOMPTE FINAL</b></h1>
                Date de paiement:<b> <?php echo dateAffiche($dtepaie); ?></b>
            </td>
        </tr>

        <tr>
            <td>
                <br>
                <address>
                    <strong>Adresse de l'entreprise:</strong><br>
                    <?php echo $site->adrcomp; ?>
                    <br>
                     <!--Phone:<?php // echo $site->phone;  ?><br>-->
                    <!-- Email: <?php // echo $site->mail_company;  ?>-->

                </address>
                <br><br>
            </td>
            <td>
                <br>
                <address>
                    <h3>Agent: <?php echo $empploye; ?></h3>
                    Matricule: <b><?php echo $matricule; ?></b><br>
                    Fonction:<b><?php echo $fonction; ?></b><br>
                    Date d'engagement: <b><?php echo dateAffiche($dteng); ?></b><br> 
                    Date de fin contrat:  <b><?php echo dateAffiche($dtefin); ?></b><br> 
                    Ancienneté: <b><?php echo ucfirst($anciennete); ?></b><br> 
                    Motif: <b><?php echo getMotifDecompte($motif); ?></b><br>
                </address>
                <br><br>
            </td>
        </tr>
        <?php
        $nbrtype = count($_SESSION['resiliation']['type']);
        for ($p = 0; $p <= $nbrtype - 1; $p++) {
            $type = $_SESSION['resiliation']['type'][$p];
            $nbre = count($_SESSION[$type]['id']);
            if ($type == 'jour') {
                $jours = 'jour(s)';
            } else {
                $jours = $_SESSION['Paie_affiche'];
            }
            ?>
            <tr>
                <td colspan="2"><b><?php echo strtoupper($_SESSION['resiliation']['libelle'][$p]); ?></b></td>
            </tr>
            <?php for ($q = 0;$q <= $nbre - 1;$q++){ ?>
            <tr>
                <td align="left"><?php echo $_SESSION[$type]['nom'][$q] ?></td>
                <td align="right">
                    <?php
                    if($type=='jour'){
                        echo $_SESSION[$type]['montant'][$q].' '.$jours;
                    }else{
                        echo afficheMontant($_SESSION['Paie_affiche'],$_SESSION[$type]['montant'][$q]); 
                    }
                    ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <th align="left"><?php echo  $_SESSION['resiliation']['lib_type'][$p]?></th>
                <th align="right">
                    <?php
                    if($type=='jour'){
                        echo $_SESSION[$type]['total'].' '.$jours;
                    }else{
                        echo afficheMontant($_SESSION['Paie_affiche'],$_SESSION[$type]['total']); 
                    }
                    ?>
                </th>
            </tr>
            <?php } ?>
        <tr>
            <th align="left">NET A PAYER</th>
            <th align="right">
                <?php echo afficheMontant($_SESSION['Paie_affiche'],$netapayer); ?>
            </th>
        </tr>
    </table>
    <table border="0" style="width: 100%;">
        <tr>
            <td align="left">
                <br><br>
                Signature du chef du personnel

            </td>
            <td align="right"><br><br>Signature Employé</td>
        </tr>
    </table>
    <br><br><br><br>

    <table border="0" style="width: 100%;">
        <tr>
            <?php if ($dtepaie < date('Y-m-d')) { ?>
                <td align="left">
                    Imprimé  le  <?php echo date('d/m/Y'); ?>
                </td>
            <?php } ?>
            <td align="right">Fait à  <?php echo ucfirst($ville_hotel); ?> , le  <?php echo dateAffiche($dtepaie); ?></td>
        </tr>
    </table>
</div>

