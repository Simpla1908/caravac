
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
            <h2><u>RAPPORT FINANCIER DU <?php echo dateAffiche($_SESSION['dte1']).' AU '.dateAffiche($_SESSION['dte2'])?></u></h2><br />
        </td>
    </tr>
</table>

<table style="margin-top:60px;" class="border">
    <thead>
        <tr>
            <th style="text-align: center;">N°</th>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Agent</th>
            <th style="text-align: center;">Cash</th>
            <th style="text-align: center;">Crédit</th> 
            <th style="text-align: center;">Don</th> 
        </tr>
    </thead>
    <tbody>
        <?php
        $j = 1;
        $dte = '0000-00-00';
        $id_user = 0;
        $nbre_rows = count($_SESSION['paiement']['dte']);
        for ($i = 0; $i <= $nbre_rows - 1; $i++) {
            $montcash = 0;
            $montcredit = 0;
            $montdon = 0;
            $dte = $_SESSION['paiement']['dte'][$i];
            $id_user = $_SESSION['paiement']['id_user'][$i];
            $nom_user = $_SESSION['paiement']['nom_user'][$i];
            if (isset($_SESSION['paiement']['cash'][$dte])) {
                $montcash = $_SESSION['paiement']['cash'][$dte];
            }
            if (isset($_SESSION['paiement']['credit'][$dte])) {
                $montcredit = $_SESSION['paiement']['credit'][$dte];
            }
            if (isset($_SESSION['paiement']['don'][$dte])) {
                $montdon = $_SESSION['paiement']['don'][$dte];
            }
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $j ?></td>
                <td style="text-align: center;"><?php echo dateAffiche($_SESSION['paiement']['dte'][$i]) ?></td>
                <td style="text-align: center;"><?php echo $_SESSION['paiement']['nom_user'][$i] ?> </td>
                <td style="text-align: center;">
                    <?php
                    echo afficheMontant($_SESSION['symbl_monnaie_affichage'],$montcash);
                    ?>
                </td>
                <td style="text-align: center;">
                    <?php
                    echo afficheMontant($_SESSION['symbl_monnaie_affichage'],$montcredit);
                    ?>
                </td>
                <td style="text-align: center;">
                    <?php
                    echo afficheMontant($_SESSION['symbl_monnaie_affichage'],$montdon);
                    ?>
                </td>
            </tr>
            <?php $j++;} ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><b>Total : </b></td> 
                <td style="text-align: center;"><b><?php echo afficheMontant($_SESSION['symbl_monnaie_affichage'], $_SESSION['paiement']['totcash']); ?></b></td>
                <td style="text-align: center;"><b><?php echo afficheMontant($_SESSION['symbl_monnaie_affichage'], $_SESSION['paiement']['totcredit']); ?></b></td>
                <td style="text-align: center;"><b><?php echo afficheMontant($_SESSION['symbl_monnaie_affichage'], $_SESSION['paiement']['totdon']); ?></b></td>
            </tr>
        </tfoot>
    </table>


    