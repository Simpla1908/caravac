                   <?php
                      $i=1;

                    //Mise en session pour impression

                    //Pour compte bilan
                    $_SESSION['balanceB'] = array();
                    $_SESSION['balanceB']['numero'] = array();
                    $_SESSION['balanceB']['compte'] = array();
                     //Pour compte Resultat
                    $_SESSION['balanceR'] = array();
                    $_SESSION['balanceR']['numero'] = array();
                    $_SESSION['balanceR']['compte'] = array();

                    //fin mise en session
                     foreach ($result as $rows) {

                      $data=INFOSFromAccountNumber($rows->compte_ecriture,$rows->long_compte,$bdd);
                      $compte_id=$data['id'];
                      $libcompte=$data['lib'];
                      $numero=$rows->compte_ecriture;
                      if($numero!=131&&$numero!=139){

                      $dbtnum=substr($numero,0,1);
                      $dbtnumint=intval($dbtnum);
                      if($dbtnumint>=1&&$dbtnumint<=5){

                     array_push($_SESSION['balanceB']['numero'],$numero);
                     array_push($_SESSION['balanceB']['compte'],$libcompte);

                      }else if($dbtnumint>=6&&$dbtnumint<=7){

                     array_push($_SESSION['balanceR']['numero'],$numero);
                     array_push($_SESSION['balanceR']['compte'],$libcompte);

                      }

                      } 
                     
                       } 
                      ?>
                    
        <div class="col-lg-12 table-responsive">
                <table class="table table-bordered">
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
                    //Mise en session pour impression
                    $_SESSION['balance'] = array();
                    $_SESSION['balance']['numero'] = array();
                    $_SESSION['balance']['compte'] = array();
                    $_SESSION['balance']['SPd'] = array();
                    $_SESSION['balance']['SPc'] = array();
                    $_SESSION['balance']['Cud'] = array();
                    $_SESSION['balance']['Cuc'] = array();
                    $_SESSION['balance']['NSd'] = array();
                    $_SESSION['balance']['NSc'] = array();
                    //fin mise en session
                      $spd=0;
                      $spc=0;
                      $scd=0;
                      $scc=0;
                      $nouveausolde=0;
                      $nsd=0;
                      $nsc=0;
                      $tspd=0;
                      $tspc=0;
                      $tscd=0;
                      $tscc=0;
                      $tnouveausolded=0;
                      $tnouveausoldec=0;

                      $tspdBR=0;
                      $tspcBR=0;
                      $tscdBR=0;
                      $tsccBR=0;
                      $tnouveausoldedBR=0;
                      $tnouveausoldecBR=0;

                      $nbArticles = count($_SESSION['balanceB']['numero']);

                      for ($i = 0; $i <= $nbArticles - 1; $i++) {

                        $numero=$_SESSION['balanceB']['numero'][$i];
                        $libcompte=$_SESSION['balanceB']['compte'][$i];
                        $data=SoldesPrecedents($devise,$numero,$dte1,$exercice_id,$site_id,$bdd);
                        $spd=$data['sumdebit'];
                        $tspd=$tspd+$spd;
                        $tspdBR=$tspdBR+$spd;
                        $spc=$data['sumcredit'];
                        $tspc=$tspc+$spc;
                        $tspcBR=$tspcBR+$spc;
                        $data=SoldesCumuls($devise,$numero,$dte1,$dte2,$exercice_id,$site_id,$bdd);
                        $scd=$data['sumdebit'];
                        $tscd=$tscd+$scd;
                        $tscdBR=$tscdBR+$scd;
                        $scc=$data['sumcredit'];
                        $tscc=$tscc+$scc;
                        $tsccBR=$tsccBR+$scc;
                        $data=NouveauxSoldes($spd,$spc,$scd,$scc);
                        $colonne=$data['colonne'];
                        $nouveausolde=$data['solde'];

                      ?>
                    <tr>
                        <td><?php echo $numero;?></td>
                        <td><?php echo ucfirst($libcompte); ?></td>
                        <td><?php if($spd>0){echo FormatChiffreCompta($spd);}; ?></td>
                        <td><?php if($spc>0){echo FormatChiffreCompta($spc);}; ?></td>
                        <td><?php if($scd>0){echo FormatChiffreCompta($scd);}; ?></td>
                        <td><?php if($scc>0){echo FormatChiffreCompta($scc);}; ?></td>
                        <?php 
                        if($colonne=='d'){
                        $tnouveausolded=$tnouveausolded+$nouveausolde;
                        $nsd=$nouveausolde;
                        $nsc=0;
                        ?>
                        <td><?php echo FormatChiffreCompta($nouveausolde); ?></td>
                        <td></td>
                        <?php }else{ 
                        $nsd=0;
                        $nsc=$nouveausolde;
                        $tnouveausoldec=$tnouveausoldec+$nouveausolde; 
                        ?>
                        <td></td>
                        <td><?php echo FormatChiffreCompta($nouveausolde); ?></td>
                        <?php 
                        }
                        ?>
                    </tr>
                    <?php
                    array_push($_SESSION['balance']['numero'],$numero);
                    array_push($_SESSION['balance']['compte'],ucfirst($libcompte));
                    array_push($_SESSION['balance']['SPd'],FormatChiffreCompta($spd));
                    array_push($_SESSION['balance']['SPc'],FormatChiffreCompta($spc));
                    array_push($_SESSION['balance']['Cud'],FormatChiffreCompta($scd));
                    array_push($_SESSION['balance']['Cuc'],FormatChiffreCompta($scc));
                    array_push($_SESSION['balance']['NSd'],FormatChiffreCompta($nsd));
                    array_push($_SESSION['balance']['NSc'],FormatChiffreCompta($nsc));
                     } 
                    $data=NouveauxSoldes($tspdBR,$tspcBR,$tscdBR,$tsccBR);
                    $colonne=$data['colonne'];
                    $nouveausolde=$data['solde'];
                     ?>

                     <tr>
                      <th colspan="2">COMPTES DE BILAN</td>
                      <th ><?php echo FormatChiffreCompta($tspdBR);?></th>
                      <th ><?php echo FormatChiffreCompta($tspcBR);?></th>
                      <th ><?php echo FormatChiffreCompta($tscdBR);?></th>
                      <th ><?php echo FormatChiffreCompta($tsccBR);?></th>
                       <?php 
                        if($colonne=='d'){
                        $tnouveausoldedBR=$nouveausolde;
                        $tnouveausoldecBR=0;
                        ?>
                        <th><?php echo FormatChiffreCompta($nouveausolde); ?></th>
                        <th></th>
                        <?php }else{ 
                        $tnouveausoldedBR=0;
                        $tnouveausoldecBR=$nouveausolde; 
                        ?>
                        <th></th>
                        <th><?php echo FormatChiffreCompta($nouveausolde); ?></th>
                        <?php 
                        }
                      array_push($_SESSION['balance']['numero'],'');
                      array_push($_SESSION['balance']['compte'],'COMPTES DE BILAN');
                      array_push($_SESSION['balance']['SPd'],FormatChiffreCompta($tspdBR));
                      array_push($_SESSION['balance']['SPc'],FormatChiffreCompta($tspcBR));
                      array_push($_SESSION['balance']['Cud'],FormatChiffreCompta($tscdBR));
                      array_push($_SESSION['balance']['Cuc'],FormatChiffreCompta($tsccBR));
                      array_push($_SESSION['balance']['NSd'],FormatChiffreCompta($tnouveausoldedBR));
                      array_push($_SESSION['balance']['NSc'],FormatChiffreCompta($tnouveausoldecBR));
                        ?>
                      </tr>


                      <?php
                      $tspdBR=0;
                      $tspcBR=0;
                      $tscdBR=0;
                      $tsccBR=0;
                      $tnouveausoldedBR=0;
                      $tnouveausoldecBR=0;
                      $nbArticles = count($_SESSION['balanceR']['numero']);
                      for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $numero=$_SESSION['balanceR']['numero'][$i];
                        $libcompte=$_SESSION['balanceR']['compte'][$i];
                        $data=SoldesPrecedents($devise,$numero,$dte1,$exercice_id,$site_id,$bdd);
                        $spd=$data['sumdebit'];
                        $tspd=$tspd+$spd;
                        $tspdBR=$tspdBR+$spd;
                        $spc=$data['sumcredit'];
                        $tspc=$tspc+$spc;
                        $tspcBR=$tspcBR+$spc;
                        $data=SoldesCumuls($devise,$numero,$dte1,$dte2,$exercice_id,$site_id,$bdd);
                        $scd=$data['sumdebit'];
                        $tscd=$tscd+$scd;
                        $tscdBR=$tscdBR+$scd;
                        $scc=$data['sumcredit'];
                        $tscc=$tscc+$scc;
                        $tsccBR=$tsccBR+$scc;
                        $data=NouveauxSoldes($spd,$spc,$scd,$scc);
                        $colonne=$data['colonne'];
                        $nouveausolde=$data['solde'];

                      ?>
                    <tr>
                        <td><?php echo $numero;?></td>
                        <td><?php echo ucfirst($libcompte); ?></td>
                        <td><?php if($spd>0){echo FormatChiffreCompta($spd);}; ?></td>
                        <td><?php if($spc>0){echo FormatChiffreCompta($spc);}; ?></td>
                        <td><?php if($scd>0){echo FormatChiffreCompta($scd);}; ?></td>
                        <td><?php if($scc>0){echo FormatChiffreCompta($scc);}; ?></td>
                        <?php 
                        if($colonne=='d'){
                        $tnouveausolded=$tnouveausolded+$nouveausolde;
                        $nsd=$nouveausolde;
                        $nsc=0;
                        ?>
                        <td><?php echo FormatChiffreCompta($nouveausolde); ?></td>
                        <td></td>
                        <?php }else{ 
                        $nsd=0;
                        $nsc=$nouveausolde;
                        $tnouveausoldec=$tnouveausoldec+$nouveausolde; 
                        ?>
                        <td></td>
                        <td><?php echo FormatChiffreCompta($nouveausolde); ?></td>
                        <?php 
                        }
                        ?>
                    </tr>
                    <?php
                    array_push($_SESSION['balance']['numero'],$numero);
                    array_push($_SESSION['balance']['compte'],ucfirst($libcompte));
                    array_push($_SESSION['balance']['SPd'],FormatChiffreCompta($spd));
                    array_push($_SESSION['balance']['SPc'],FormatChiffreCompta($spc));
                    array_push($_SESSION['balance']['Cud'],FormatChiffreCompta($scd));
                    array_push($_SESSION['balance']['Cuc'],FormatChiffreCompta($scc));
                    array_push($_SESSION['balance']['NSd'],FormatChiffreCompta($nsd));
                    array_push($_SESSION['balance']['NSc'],FormatChiffreCompta($nsc));
                     } 
                    $data=NouveauxSoldes($tspdBR,$tspcBR,$tscdBR,$tsccBR);
                    $colonne=$data['colonne'];
                    $nouveausolde=$data['solde'];      
                     ?>

                     <tr>
                      <th colspan="2">COMPTES DE GESTION</td>
                      <th ><?php echo FormatChiffreCompta($tspdBR);?></th>
                      <th ><?php echo FormatChiffreCompta($tspcBR);?></th>
                      <th ><?php echo FormatChiffreCompta($tscdBR);?></th>
                      <th ><?php echo FormatChiffreCompta($tsccBR);?></th>
                      <?php 
                        if($colonne=='d'){
                        $tnouveausoldedBR=$nouveausolde;
                        $tnouveausoldecBR=0;
                        ?>
                        <th><?php echo FormatChiffreCompta($nouveausolde); ?></th>
                        <th></th>
                        <?php }else{ 
                        $tnouveausoldedBR=0;
                        $tnouveausoldecBR=$nouveausolde; 
                        ?>
                        <th></th>
                        <th><?php echo FormatChiffreCompta($nouveausolde); ?></th>
                        <?php 
                        }
                        ?>
                      </tr>
                    <?php
                    array_push($_SESSION['balance']['numero'],'');
                    array_push($_SESSION['balance']['compte'],'COMPTES DE GESTION');
                    array_push($_SESSION['balance']['SPd'],FormatChiffreCompta($tspdBR));
                    array_push($_SESSION['balance']['SPc'],FormatChiffreCompta($tspcBR));
                    array_push($_SESSION['balance']['Cud'],FormatChiffreCompta($tscdBR));
                    array_push($_SESSION['balance']['Cuc'],FormatChiffreCompta($tsccBR));
                    array_push($_SESSION['balance']['NSd'],FormatChiffreCompta($tnouveausoldedBR));
                    array_push($_SESSION['balance']['NSc'],FormatChiffreCompta($tnouveausoldecBR));

                    $_SESSION['devise']=$devise;
                    $_SESSION['dte1']=$dte1;
                    $_SESSION['dte2']=$dte1;
                    $_SESSION['exercice_lib']=$exercice_lib;
                    $_SESSION['tspd']=FormatChiffreCompta($tspd);
                    $_SESSION['tspc']=FormatChiffreCompta($tspc);
                    $_SESSION['tscd']=FormatChiffreCompta($tscd);
                    $_SESSION['tscc']=FormatChiffreCompta($tscc);
                    $_SESSION['tnouveausolded']=FormatChiffreCompta($tnouveausolded);
                    $_SESSION['tnouveausoldec']=FormatChiffreCompta($tnouveausoldec);

                     ?>
                    </tbody>
                   <tfoot>
                      <tr>
                      <th colspan="2">TOTAL GENERAL</th>
                      <th ><?php echo FormatChiffreCompta($tspd);?></th>
                      <th ><?php echo FormatChiffreCompta($tspc);?></th>
                      <th ><?php echo FormatChiffreCompta($tscd);?></th>
                      <th ><?php echo FormatChiffreCompta($tscc);?></th>
                      <th ></th>
                      <th ></th>
                      </tr>
                    </tfoot>
                </table>
            </div>