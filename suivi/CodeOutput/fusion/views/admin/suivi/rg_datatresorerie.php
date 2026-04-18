<div class="tab-pane active table-responsive" id="tab_1">
   <div class="col-lg-12 table-responsive">
                <?php
                $So=0;
                foreach ($sites as $rows){
                    $site_id =$rows->id_hotel;
                    $So+=SoldeInitialJournalCaisse($devise,$d1,$site_id,$bdd);
                }
                $Sf=$So;
                ?>
                <p class="pull-right"><b><?php echo 'SOLDE INITIAL : '.FormatChiffreCompta($So);?></b></p>
               <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>No Doc</th>
                            <th>Motif</th>
                            <th>Bén/Prov</th>
                            <th>Encaissement</th>  
                            <th>Decaissement</th>

                        </tr>
                    </thead>
                    <tbody>
                     <?php
                      $i=1;
                       //Mise en session pour impression
                        $_SESSION['datedebut']=dateAffiche($d1);
                        $_SESSION['datefin']=dateAffiche($d2);
                        $_SESSION['devise']=$devise;
                        $_SESSION['journal'] = array();
                        $_SESSION['journal']['n'] = array();
                        $_SESSION['journal']['reference'] = array();
                        $_SESSION['journal']['date'] = array();
                        $_SESSION['journal']['description'] = array();
                        $_SESSION['journal']['debit'] = array();
                        $_SESSION['journal']['credit'] = array();
                        $_SESSION['journal']['beneficiaire'] = array();

                        //fin mise en session
                        $totdebit=0;
                        $totcredit=0;
                        $tdb=0;
                        $tcr=0;
                     foreach ($sites as $art2){
                        $id_hotel = $art2->id_hotel;
                        $exercice_id=$art2->id;
                        $result2= GenererJournalCaisse($d1,$d2,$id_hotel,$bdd);
                        $i=0;
                     foreach ($result2 as $rows) {
                        $datebon=$rows->date_bon;
                        $numBon= $rows->numBon;
                        $type= $rows->type;
                        $description=$rows->libelle;
                        if($devise=='CDF'){
                        
                       if($type=='entree'){
                       $debit=$rows->montantFC;
                       $tdb=$debit;
                       $credit=0;
                       $tcr=$credit;
                       $compte_id=$rows->motif_id;
                       $format=$rows->format;
                       $data=INFOSFromAccountNumber($compte_id,$format,$bdd);
                       $benprov=$compte_id.' '.$data['lib'];

                        }else{
                       $debit=0;
                       $credit=$rows->montantFC;
                       $benprov= $rows->beneficiaire;
                       $tcr=$credit;
                       $tdb=$debit;
                        }
                        
                        }else{

                       if($type=='entree'){
                       $debit=$rows->montantUSD;
                       $credit=0;
                       $tcr=$credit;
                       $tdb=$debit;
                       $compte_id=$rows->motif_id;
                       $format=$rows->format;
                       $data=INFOSFromAccountNumber($compte_id,$format,$bdd);
                       $benprov=$compte_id.' '.$data['lib'];

                        }else{
                       $debit=0;
                       $credit=$rows->montantUSD;
                       $benprov= $rows->beneficiaire;
                       $tcr=$credit;
                       $tdb=$debit;
                        }

                        }
                        if($debit>0||$credit>0){
                      ?>
                    <tr>
                        <td><?php echo dateAffiche($datebon) ?></td>
                        <td><?php echo $numBon;?></td>
                        <td><?php echo ucfirst($description); ?></td>
                        <td><?php echo ucfirst($benprov); ?></td>
                        <td>
                        <?php
                        if($debit>0){
                        $Sf=$Sf+$debit;
                        $debit=FormatChiffreCompta($debit);
                        echo $debit;
                        }
                        ?>
                        </td>
                         <td>
                        <?php 
                        if($credit>0){
                        $Sf=$Sf-$credit;
                        $credit=FormatChiffreCompta($credit);
                        echo $credit;
                        }
                        ?>
                        </td>  

                    </tr>
                    
                    <?php
                    array_push($_SESSION['journal']['n'],$i);
                    array_push($_SESSION['journal']['reference'],$numBon);
                    array_push($_SESSION['journal']['date'],dateAffiche($datebon));
                    array_push($_SESSION['journal']['description'],ucfirst($description));
                    array_push($_SESSION['journal']['debit'],$debit);
                    array_push($_SESSION['journal']['credit'],$credit);
                    array_push($_SESSION['journal']['beneficiaire'],ucfirst($benprov));
                    $totdebit+=$tdb;
                    $totcredit+=$tcr;
                     }
                    $i++;
                   
                    }
                    
                    }
                   $_SESSION['So']=$So;
                   $_SESSION['Sf']=$Sf;
                     ?>
                    <tr>
                        <td>TOTAL</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                         <?php echo FormatChiffreCompta($totdebit);?>
                        </td>
                         <td>
                        <?php echo FormatChiffreCompta($totcredit);?>
                        </td>  

                    </tr>
                    </tbody>
                </table>
                <p class="pull-right"><b><?php echo 'SOLDE FINAL : '.FormatChiffreCompta($Sf);?></b></p>
            </div>
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="tab_2">
    
</div>

