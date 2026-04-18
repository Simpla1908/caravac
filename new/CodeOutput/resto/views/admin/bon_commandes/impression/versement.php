
<!--Insertion du CSS -->
<style type="text/css">
    table { 
        width: 100%; 
        color: #717375; 
        font-family: helvetica; 
        line-height: 5mm; 
        border-collapse: collapse; 
    }
    h2 { margin: 0; padding: 0; }
    p { margin: 25px; text-align: center; }

    .border th { 
        border: 1px solid #000;  
        color: white; 
        background: #000; 
        padding: 5px; 
        font-weight: normal; 
        font-size: 14px; 
        text-align: center; 
    }
    .border td { 
        border: 1px solid #CFD1D2; 
        padding: 5px 10px; 
        text-align: center; 
    }
    .no-border { 
        border-right: 1px solid #CFD1D2; 
        border-left: none; 
        border-top: none; 
        border-bottom: none;
    }
    .space { padding-top: 100px; }
    .10p { width: 10%; } .15p { width: 15%; } 
    .25p { width: 25%; } .50p { width: 50%; } 
    .60p { width: 60%; } .75p { width: 75%; } .100p { width: 100%; }
</style>

<table style="margin-top: 50px;">

    <tr>
        <td class="100p" style="text-align: center;">
            <h2><u>VERSEMENT DU <?php echo dateAffiche($_SESSION['dte1']) . ' AU ' . dateAffiche($_SESSION['dte2']) ?></u></h2><br />
        </td>
    </tr>
    <tr>
        <td class="100p no-line" style="text-align: center;">
            <br />
            <h3>(<?php echo  strtoupper($_SESSION['module']) ?>)</h3>
        </td>
    </tr>
</table>

<table style="margin-top:60px;" class="border">
    <thead>
        <tr>
            <th style="text-align: center;">N°</th>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Agent</th>
            <th style="text-align: center;">Montant réalisé</th>
            <th style="text-align: center;">CDF</th> 
            <th style="text-align: center;">USD</th> 
        </tr>
    </thead>
    <tbody>
        <?php
        $result=$_SESSION['result'];
        $result2=$_SESSION['result2'];
        $i = 1;
        $totvendu = 0;
        $totcdf = 0;
        $totusd = 0;
        $usd = 0;
        $cdf = 0;
        $observation = "";
        $msg = '';
        $hidden = 'hidden';
        foreach ($result as $rows) {
            $montvendu = $rows->montpaie;
            $nom_user = $rows->nom_user;
            $dte = $rows->dte;
            $montvers = montant_equivalent_bdd(getsymbole_local(), $_SESSION['symbl_monnaie_affichage'], $rows->taux, $rows->montpaie);
            ?>
            <?php
            foreach ($result2 as $rows2) {
                if ($rows->id_user == $rows2->user_vers && $dte == $rows2->date_bon) {
                    $idoperation = $rows2->idoperation;
                    $usd = $rows2->montantUSD;
                    $cdf = $rows2->montantFC;
                    $montvers1 = $rows2->montvers1;
                    $libelop = $rows2->libelle;
                    $spantext = 'text';
                    $libelle = '';

                    if (arrondir($montvers1 - $montvendu) == 0) {
                        $libelle = 'OK';
                        $observation = "OK";
                        $msg = 'OK';
                    } elseif (arrondir($montvers1 - $montvendu) > 0) {
                        $observation = ($montvers1) - $montvendu;
                        $libelle = 'Surplus';
                        $msg = 'Surplus de ' . afficheMontant(getsymbole_local(), $observation);
                    } else {
                        $hidden = '';
                        $spantext = 'text-danger';
                        $libelle = 'Manquant';
                        $observation = $montvers1 - $montvendu;
                        $msg = 'Manquant de ' . afficheMontant(getsymbole_local(), abs($observation));
                    }
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo dateAffiche($dte); ?></td>
                        <td><?php echo ucfirstText($rows->nom_user); ?></td>
                        <td><?php echo afficheMontant($_SESSION['symbl_monnaie_affichage'], $montvendu); ?></td>
                        <td><?php echo afficheMontant('', $usd); ?></td>
                        <td><?php echo afficheMontant('', $cdf); ?></td>
                    </tr>
                    <?php
                }
            }
            $totvendu+=$montvendu;
            $totcdf+=$cdf;
            $totusd+=$usd;
            $i++;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="text-right"><b>Total : </b></td> 
            <td style="text-align: center;"><b><?php echo afficheMontant($_SESSION['symbl_monnaie_affichage'],$totvendu); ?></b></td>
            <td style="text-align: center;"><b><?php echo afficheMontant(getsymbole_local(),$totcdf); ?></b></td>
            <td style="text-align: center;"><b><?php echo afficheMontant(getsymbole_devise(),$totusd); ?></b></td>
        </tr>
    </tfoot>
</table>


