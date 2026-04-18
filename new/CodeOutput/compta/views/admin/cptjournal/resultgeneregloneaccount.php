                    <?php
                    //Mise en session pour impression
                    $_SESSION['grandlivre'] = array();
                    $_SESSION['grandlivre']['numerocompte'] = array();
                    $_SESSION['grandlivre']['compte'] = array();
                    $_SESSION['grandlivre']['date'] = array();
                    $_SESSION['grandlivre']['reference'] = array();
                    $_SESSION['grandlivre']['libelle'] = array();
                    $_SESSION['grandlivre']['debitcdf'] = array();
                    $_SESSION['grandlivre']['creditcdf'] = array();
                    $_SESSION['grandlivre']['solde1'] = array();
                    $_SESSION['grandlivre']['devise'] = array();
                    $_SESSION['grandlivre']['cours'] = array();
                    $_SESSION['grandlivre']['debitusd'] = array();
                    $_SESSION['grandlivre']['creditusd'] = array();
                    $_SESSION['grandlivre']['solde2'] = array();
                    $_SESSION['grandlivre']['afficher'] = array();
                    //fin mise en session


                    //impression pour excel
                     $_SESSION['PrintExcel']['rows'] = array();
                    //impression pour excel

                     $devisecdf=getsymbole_local();
                     $deviseusd=getsymbole_devise();
                     $totdebitcdf=0;
                     $totdebitusd=0;
                     $totcreditcdf=0;
                     $totcreditusd=0;
                     $totsolde1=0;
                     $totsolde2=0;
                     $stotdebitcdf=0;
                     $stotdebitusd=0;
                     $stotcreditcdf=0;
                     $stotcreditusd=0;

                     ?>
            <div class="col-lg-12 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ref.</th>
                            <th>Libellé</th>
                            <th>Débit</th>  
                            <th>Crédit</th>
                            <th>Solde</th>
                            <th>Dévise</th>
                            <th>Cours</th>
                            <th>Débit</th>
                            <th>Crédit</th>
                            <th>Solde</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $resultCGL=ComptesGrandLivre($exercice_id,$numerocompte,$d1,$d2,$site_id,$bdd);
                    //MISE EN SESSION POUR IMPRESSION
                    $_SESSION['GL_exercice_id']=$exercice_id;
                    $_SESSION['GL_numerocompte']=$numerocompte;
                    $_SESSION['GL_d1']=$d1;
                    $_SESSION['GL_d2']=$d2;
                    $_SESSION['GL_site_id']=$site_id;
                    //MISE EN SESSION POUR IMPRESSION

                    foreach ($resultCGL as $rowsCGL) {

                    $dataCGL=INFOSFromAccountNumber($rowsCGL->compte_ecriture,$rowsCGL->long_compte,$bdd);
                    $libcompte=$dataCGL['lib'];
                    $numerocompteCGL=$rowsCGL->compte_ecriture;
                    if($numerocompteCGL!=131&&$numerocompteCGL!=139){
                    if (!in_array($numerocompteCGL,$_SESSION['grandlivre']['numerocompte'])) {
                     array_push($_SESSION['grandlivre']['numerocompte'],$numerocompteCGL);
                     $result=GenererGrandLivre($exercice_id,$numerocompteCGL,$d1,$d2,$site_id,$bdd);  
                     $cumuls=GenererGrandLivreCumuls($exercice_id,$numerocompteCGL,$d1,$d2,$site_id,$bdd);  
                     $debitcdf=$cumuls['debitcdf'];
                     $creditcdf=$cumuls['creditcdf'];
                     $debitusd=$cumuls['debitusd'];
                     $creditusd=$cumuls['creditusd'];


                     $debitcdfCML=$cumuls['debitcdf'];
                     $creditcdfCML=$cumuls['creditcdf'];
                     $debitusdCML=$cumuls['debitusd'];
                     $creditusdCML=$cumuls['creditusd'];

                     $solde1=$cumuls['solde1'];
                     $solde2=$cumuls['solde2'];
                     $stotsolde1=$solde1;
                     $stotsolde2=$solde2;
                  ?>
                    <tr>
                        <td colspan="11" align="center"><b><?php echo $numerocompteCGL.'  '.ucfirst($libcompte); ?></b></td>
                    </tr>
                      <?php
                      //impression pour excel
                      $rows='<tr><td colspan="11" align="center"><b>'.$numerocompteCGL.'  '.ucfirst($libcompte).'</b></td></tr>';
                      array_push($_SESSION['PrintExcel']['rows'],$rows);
                      //impression pour excel
                      ?>
                    <tr>
                        <td><?php echo "<b>Cumul antérieur</b>"; ?></td>
                        <td></td>
                        <td></td>
                        <td>
                        <?php 
                        if($debitcdf>0){
                        echo FormatChiffreCompta($debitcdf); 
                        }
                        ?>
                        </td>
                         <td>
                        <?php 
                        if($creditcdf>0){
                        echo FormatChiffreCompta($creditcdf);
                        }
                        ?>
                        </td> 
                          <td>
                        <?php
                       if($solde1>0){
                        echo FormatChiffreCompta($solde1);
                         }
                        ?>
                        </td> 
                        <td></td>
                        <td></td>
                        <td>
                        <?php
                         if($debitusd>0){
                        echo FormatChiffreCompta($debitusd);
                        }
                        ?>
                        </td>
                        <td>
                        <?php
                        if($creditusd>0){
                        echo FormatChiffreCompta($creditusd);
                        }

                        ?>
                        </td>
                         <td>
                        <?php 
                        if($solde2>0){
                        echo FormatChiffreCompta($solde2);
                        }

                        ?>
                        </td> 

                    </tr>
                     <?php
                      //impression pour excel
                      if($debitcdf>0){
                        $debitcdf=FormatChiffreCompta($debitcdf); 
                      }else{
                         $debitcdf="";
                      }
                      if($creditcdf>0){
                        $creditcdf=FormatChiffreCompta($creditcdf); 
                      }else{
                         $creditcdf="";
                      }

                      if($solde1>0){
                        $solde1=FormatChiffreCompta($solde1); 
                      }else{
                         $solde1="";
                      }
                      if($debitusd>0){
                        $debitusd=FormatChiffreCompta($debitusd); 
                      }else{
                         $debitusd="";
                      }
                      if($creditusd>0){
                        $creditusd=FormatChiffreCompta($creditusd); 
                      }else{
                         $creditusd="";
                      }
                      if($solde2>0){
                        $solde2=FormatChiffreCompta($solde2); 
                      }else{
                         $solde2="";
                      }
                      $rows='<tr>
                        <td><b>Cumul antérieur</b>"</td>
                        <td></td>
                        <td></td>
                        <td>'.$debitcdf.'</td>
                        <td>'.$creditcdf.'</td> 
                        <td>'.$solde1.'</td> 
                        <td></td>
                        <td></td>
                        <td>'.$debitusd.'</td>
                        <td>'.$creditusd.'</td>
                        <td>'.$solde2.'</td> 
                        </tr>';
                         array_push($_SESSION['PrintExcel']['rows'],$rows);
                      //impression pour excel
                      ?>
                <?php
                     foreach ($result as $rows) {
                      $data=INFOSFromAccountNumber($rows->compte_ecriture,$rows->long_compte,$bdd);
                      $libcompte=$data['lib'];
                      $numero=$rows->compte_ecriture;
                      $debitcdf=0;
                      if($rows->debit>0){
                      $debitcdf=arrondir(montant_equivalent_bdd($rows->devise,$devisecdf,$rows->taux,$rows->debit)); 
                      $stotdebitcdf=$stotdebitcdf+$debitcdf;
                      }
                      $creditcdf=0;
                      if($rows->credit>0){
                      $creditcdf=arrondir(montant_equivalent_bdd($rows->devise,$devisecdf,$rows->taux,$rows->credit));
                      $stotcreditcdf=$stotcreditcdf+$creditcdf; 
                       }
                        $debitusd=0;
                        if($rows->debit>0){
                        $debitusd=arrondir(montant_equivalent_bdd($rows->devise,$deviseusd,$rows->taux,$rows->debit)); 
                        $stotdebitusd=$stotdebitusd+$debitusd;
                        }
                        $creditusd=0;
                        if($rows->credit>0){
                        $creditusd=arrondir(montant_equivalent_bdd($rows->devise,$deviseusd,$rows->taux,$rows->credit));
                        $stotcreditusd=$stotcreditusd+$creditusd;  
                        }
                      $solde1=$debitcdf-$creditcdf;
                      $solde2=$debitusd-$creditusd;
                      $stotsolde1=$stotsolde1+$solde1;
                      $stotsolde2=$stotsolde2+$solde2;

                ?>

                    <tr>
                        <td><?php echo dateAffiche($rows->dte); ?></td>
                        <td><?php echo $rows->reference;?></td>
                        <td><?php echo ucfirst($rows->descriptjourn);?></td>
                        <td>
                        <?php 
                        if($debitcdf>0){
                        echo FormatChiffreCompta($debitcdf); 
                        }
                        ?>

                        </td>
                         <td>
                        <?php
                       if($creditcdf>0){ 
                        echo FormatChiffreCompta($creditcdf);
                         }
                        ?>
                        </td> 
                          <td>
                        <?php 
                        if($solde1>0){ 
                        echo FormatChiffreCompta($solde1);
                          }
                        ?>
                        </td> 
                        <td><?php echo $deviseusd; ?></td>
                        <td><?php echo $rows->taux; ?></td>
                        <td>
                        <?php
                        if($debitusd>0){ 
                        echo FormatChiffreCompta($debitusd);
                        }

                        ?>
                        </td>
                        <td>
                        <?php
                        if($creditusd>0){ 
                        echo FormatChiffreCompta($creditusd);
                        }

                        ?>
                        </td>
                         <td>
                        <?php
                       if($solde2>0){  
                        echo FormatChiffreCompta($solde2);
                        }

                        ?>
                        </td> 

                    </tr>
                    <?php
                     } 
                    ?>
                    <tr>
                        <td><?php echo '<b>Sous total</b>'; ?></td>
                        <td></td>
                        <td></td>
                        <td>
                        <?php 
                        if($stotdebitcdf>0){ 
                        echo FormatChiffreCompta($stotdebitcdf); 
                        } 
                        ?>
                        </td>
                         <td>
                        <?php 
                        if($stotcreditcdf>0){ 
                        echo FormatChiffreCompta($stotcreditcdf);
                       } 
                        ?>
                        </td> 
                          <td>
                        <?php 
                        if($stotsolde1>0){ 
                        echo FormatChiffreCompta($stotsolde1);
                        } 
                        ?>
                        </td> 
                        <td></td>
                        <td></td>
                        <td>
                        <?php
                        if($stotdebitusd>0){ 
                        echo FormatChiffreCompta($stotdebitusd);
                                                } 

                        ?>
                        </td>
                        <td>
                        <?php
                        if($stotcreditusd>0){ 
                        echo FormatChiffreCompta($stotcreditusd);
                        } 
                        ?>
                        </td>
                         <td>
                        <?php 
                        if($stotsolde2>0){ 
                        echo FormatChiffreCompta($stotsolde2);
                          } 
                        ?>
                        </td> 

                    </tr>
                    <?php
                    $totdebitcdf=$totdebitcdf+$stotdebitcdf+$debitcdfCML;
                    $totcreditcdf=$totcreditcdf+$stotcreditcdf+$creditcdfCML;
                    $totdebitusd=$totdebitusd+$stotdebitusd+$debitusdCML;
                    $totcreditusd=$totcreditusd+$stotcreditusd+$creditusdCML;
                    $totsolde1=$totsolde1+$stotsolde1;
                    $totsolde2=$totsolde2+$stotsolde2;
                    $stotdebitcdf=0;
                    $stotdebitusd=0;
                    $stotcreditcdf=0;
                    $stotcreditusd=0;
                    }
                     }
                    }
                     ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th colspan="3">TOTAL</th>
                      <th >
                      <?php 
                      if($totdebitcdf>0){ 
                      echo FormatChiffreCompta($totdebitcdf);
                      }
                      ?></th>
                      <th ><?php 
                      if($totcreditcdf>0){ 
                      echo FormatChiffreCompta($totcreditcdf);
                      }
                      ?></th>
                      <th ><?php 
                      if($totsolde1>0){ 
                      echo FormatChiffreCompta($totsolde1);
                      }
                      ?></th>
                      <th colspan="2"></th>
                      <th >
                        <?php 
                          if($totdebitusd>0){ 
                        echo FormatChiffreCompta($totdebitusd);
                        }
                        ?></th>
                      <th ><?php
                       if($totcreditusd>0){ 
                       echo FormatChiffreCompta($totcreditusd);
                        }
                       ?></th>
                      <th ><?php 
                         if($totsolde2>0){ 
                      echo FormatChiffreCompta($totsolde2);
                      }

                      ?></th>
                      </tr>
                    </tfoot>
                </table>
            </div>