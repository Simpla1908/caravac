<table id="example4" class="table table-bordered table-striped table-hover matable table-condensed">
            <tr>
                <th rowspan="2" style="text-align: center;">N°</th>
                <th valign="midle" colspan="2" rowspan="2" style="text-align: center;">DESIGNATION</th>
                <th colspan="2" style="text-align: center;">CASH</th>
                <th colspan="2" style="text-align: center;">CREDIT</th>
                <th colspan="2" style="text-align: center;">DON</th>
            </tr>
            <tr>
                <th style="text-align: center;">Quantité</th> 
                <th style="text-align: center;">Prix Total</th> 
                <th style="text-align: center;">Quantité</th> 
                <th style="text-align: center;">Prix Total</th> 
                <th style="text-align: center;">Quantité</th> 
                <th style="text-align: center;">Prix Total</th>
            </tr>
            <?php
            $j = 1;
            $total = 0;
            $total1 = 0;
            $total2 = 0;
            $tot_qte=0;
            $tot_qte1=0;
            $tot_qte2=0;
            $qte_cash=0;
            $qte_credit=0;
            $qte_don=0;
            $pt_cash=0;
            $pt_credit=0;
            $pt_don=0;
            $ptb_cash=0;
            $ptb_credit=0;
            $ptb_don=0;
            $ptp_cash=0;
            $ptp_credit=0;
            $ptp_don=0;
            for ($i = 0; $i <= $nbre_rows - 1; $i++) {
               $idprod = $_SESSION['prod']['id'][$i];
                $designation = $_SESSION['prod']['des'][$i];
                $repas=$_SESSION['prod']['repas'][$i];
                
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
                    $pt_don= 0;
                }
                if($repas==0){
                    $ptb_cash+=$pt_cash;
                    $ptb_credit+=$pt_credit;
                    $ptb_don+=$pt_don;
                }  else {
                    $ptp_cash+=$pt_cash;
                    $ptp_credit+=$pt_credit;
                    $ptp_don+=$pt_don;
                }

            ?>
            <tr>
                <th><?php echo $j ?></th>
                <th colspan="2"><?php echo $designation ?></th>
                <td style="text-align: center;"><?php echo $qte_cash ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_cash) ?></td>
                <td style="text-align: center;"><?php echo $qte_credit ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_credit) ?></td>
                <td style="text-align: center;"><?php echo $qte_don ?></td>
                <td style="text-align: right;"><?php echo afficheMontant($m_affiche, $pt_don) ?></td>
            </tr>
            <?php
            $j++;
            $total += $pt_cash;
            $total1 += $pt_credit;
            $total2 += $pt_don;
            $tot_qte+=$qte_cash;
            $tot_qte1+=$qte_credit;
            $tot_qte2+=$qte_don;
            }
            ?> 

            <tr>
                <th colspan="4" style="text-align: right;">TOTAL BOISSONS</th> 
                <!--<th style="text-align: center;"><?php //echo $tot_qte ?></th>-->
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $ptb_cash) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte1 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $ptb_credit) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte2 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $ptb_don) ?></th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: right;">TOTAL PLATS</th> 
                <!--<th style="text-align: center;"><?php //echo $tot_qte ?></th>-->
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $ptp_cash) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte1 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $ptp_credit) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte2 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $ptp_don) ?></th>
            </tr>
              <tr>
                <th colspan="4" style="text-align: right;">TOTAUX</th> 
                <!--<th style="text-align: center;"><?php //echo $tot_qte ?></th>-->
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte1 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total1) ?></th>
                <th style="text-align: center;"><?php //echo $tot_qte2 ?></th>
                <th style="text-align: right;"><?php echo afficheMontant($m_affiche, $total2) ?></th>
            </tr>
        
</table>