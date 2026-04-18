

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
                <img src="public/uploads/<?php echo $site->logo1;?>" height="70" width="70"/>
            </td>
            <td style="width: 50%">
                <h1><b>BULLETIN DE PAIE</b></h1>
                Mois: <b><?php echo $mois; ?></b><br>
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
                    <!--Phone:<?php // echo $site->phone; ?><br>-->
                   <!-- Email: <?php // echo $site->mail_company; ?>-->
                    
                </address>
                <br><br>
            </td>
            <td>
                <br>
                <address>
                    <h3><?php echo $empploye; ?></h3>
                    Matricule: <b><?php echo $matricule; ?></b><br>
                    Fonction:<b><?php echo $fonction; ?></b><br>
                </address>
                <br><br>
            </td>
        </tr>
        <tr>
            <th align="left"><h4><b>RUBRIQUES DE PAIE</b></h4></th>
        <th align="right"><h4><b>MONTANT</b></h4></th>
        </tr>
        <?php
        $vrem=0;
        $vret=0;
        $libelletotal = 'TOTAL RETENUE';
        $netpayer = 0;
        $remuneration = 0;
        $retenue = 0;
        $cpt1 = count($_SESSION['rubrique']['type']);
        for ($i = 0; $i <= $cpt1 - 1; $i++) {
            $type = $_SESSION['rubrique']['type'][$i];
            ?>
            <?php
            if ($type == 'remuneration') {
                $libelletotal = 'TOTAL BRUT';
                $vrem++;
                ?>
                <tr>
                    <td colspan="2"><b>REMUNERATION</b></td>
                </tr>
                <tr>
                    <td align="left">Base</td>
                    <td align="right"><?php echo afficheMontant($_SESSION['Paie_affiche'], montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $totbase)); ?></td>
                </tr>
                <?php
                $_SESSION[$type]['total'] = $_SESSION[$type]['total'] + $totbase;
                $remuneration = $_SESSION[$type]['total'];
            } else {
                $vret++;
                $retenue = $_SESSION[$type]['total'];
                $libelletotal = 'TOTAL RETENUE';
            
            ?>
            <tr>
                <td colspan="2"><b>RETENUE</b></td>
            </tr>
            <?php }?>
            <?php
            $cpt2 = $_SESSION[$type]['compteur'];
            for ($j = 0; $j <= $cpt2 - 1; $j++) {
                $id = $_SESSION[$type]['id'][$j];
                $nom = $_SESSION[$type]['nom'][$j];
                $montant = $_SESSION[$type]['montant'][$j];
                ?>
                <tr>
                    <td><?php echo $nom ?></td>
                    <td align="right"><?php echo afficheMontant($_SESSION['Paie_affiche'], montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $montant)); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <th align="left"><?php echo $libelletotal ?></th>
                <th align="right"><?php echo afficheMontant($_SESSION['Paie_affiche'], montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $_SESSION[$type]['total'])); ?></th>
            </tr>
            <?php
        }
        $netpayer = $remuneration - $retenue;
        ?>
        <tr>
            <th align="left">NET A PAYER</th>
            <th align="right"><?php echo afficheMontant($_SESSION['Paie_affiche'], montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $netpayer)); ?></th>
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
            <?php if($dtepaie < date('Y-m-d')){?>
                <td align="left">
                    Imprimé  le  <?php echo date('d/m/Y'); ?>
                </td>
            <?php } ?>
            <td align="right">Fait à  <?php echo ucfirst($ville_hotel); ?> , le  <?php echo dateAffiche($dtepaie); ?></td>
        </tr>
    </table>
</div>

