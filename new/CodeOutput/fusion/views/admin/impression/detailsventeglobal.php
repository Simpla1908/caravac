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
                <h2><u>DETAILS VENTES<?php echo ' '.$nomsite; ?></u></h2><br />
                Période :
                <small>(<?php echo $description; ?>)</small>
            </td>
        </tr>
       
    </table>
    <table style="margin-top: 30px; margin-left: 65px;" class="border">
        <tr>
            <th rowspan="2" style="text-align: center;">N°</th>
            <th colspan="2" style="text-align: center;">DESIGNATION</th>
            <th colspan="2" style="text-align: center;">CASH</th>
            <th colspan="2" style="text-align: center;">CREDIT</th>
            <th colspan="2" style="text-align: center;">DON</th>
        </tr>
        <tr>
            <th style="text-align: center;">Numero</th> 
            <th style="text-align: center;">Tarif</th> 
            <th style="text-align: center;">QTE</th> 
            <th style="text-align: center;">Prix Total</th> 
            <th style="text-align: center;">QTE</th> 
            <th style="text-align: center;">Prix Total</th> 
            <th style="text-align: center;">QTE</th> 
            <th style="text-align: center;">Prix Total</th>
        </tr>
        <?php
        $j = 1;
        $total_cash=0;
        $total_credit=0;
        $total_don= 0;
        $total = 0;
        $total1 = 0;
        $total2 = 0;
        $tot_qte = 0;
        $tot_qte1 = 0;
        $tot_qte2 = 0;
        $qte_cash = 0;
        $qte_credit = 0;
        $qte_don = 0;
        $pt_cash = 0;
        $pt_credit = 0;
        $pt_don = 0;
        $m_affiche = getsymbole_local();
        for ($i = 0; $i <= $nbre_rows - 1; $i++) {
            $idprod = $_SESSION['prod']['prodprice'][$i];
            $designation = $_SESSION['prod']['des'][$i];
            $prix = $_SESSION['prod']['prix'][$i];
            if (isset($_SESSION['cash']['qte'][$idprod])) {
                $qte_cash = $_SESSION['cash']['qte'][$idprod];
                $pt_cash = $_SESSION['cash']['pt'][$idprod];
            } else {
                $qte_cash = 0;
                $pt_cash = 0;
            }
            if (isset($_SESSION['credit']['qte'][$idprod])) {
                $qte_credit = $_SESSION['credit']['qte'][$idprod];
                $pt_credit = $_SESSION['credit']['pt'][$idprod];
            } else {
                $qte_credit = 0;
                $pt_credit = 0;
            }

            if (isset($_SESSION['don']['qte'][$idprod])) {
                $qte_don = $_SESSION['don']['qte'][$idprod];
                $pt_don = $_SESSION['don']['pt'][$idprod];
            } else {
                $qte_don = 0;
                $pt_don = 0;
            }
            ?>
            <tr>
                <th><?php echo $j ?></th>
                <td style="text-align: center;"><?php echo $designation ?></th>
                <td style="text-align: center;"><?php echo afficheMontant($m_affiche, $prix) ?></th>
                <td style="text-align: center;"><?php echo $qte_cash ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_cash) ?></td>
                <td style="text-align: center;"><?php echo $qte_credit ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_credit) ?></td>
                <td style="text-align: center;"><?php echo $qte_don ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_don) ?></td>
            </tr>
            <?php
            $j++;
            $total_cash += $pt_cash;
            $total_credit += $pt_credit;
            $total_don += $pt_don;
            $tot_qte+=$qte_cash;
            $tot_qte1+=$qte_credit;
            $tot_qte2+=$qte_don;
        }
        ?> 
        <tr>
            <th colspan="4">Total</th> 
            <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total_cash) ?></th>
            <th colspan="1"></th>
            <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total_credit) ?></th>
            <th colspan="1"></th>
            <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total_don) ?></th>
        </tr>
    </table>
    
    <div id="entete25">
        <p align="center">
            <br><br><br><br><br>
        <span>Imprimé le  <?php echo date('d/m/Y'); ?> par </span>
        <b><?php echo strtoupper($_SESSION['nom_user'].' '.$_SESSION['prenom_user']); ?></b>
        </p>
    </div>

</div>
