 <?php
                        $totsej=0;
                        $totcons=0;
                        $i = 1;
                        $n = count($_SESSION['recette']['date']);
                        for ($j = 0; $j <= $n - 1; $j++) {
                            $dte=$_SESSION['recette']['date'][$j];
                            if(isset($_SESSION['recette']['sejour'][$dte])){
                                $mpsej= $_SESSION['recette']['sejour'][$dte];
                            }else{
                                $mpsej=0;   
                            }
                            if(isset($_SESSION['recette']['consommation'][$dte])){
                                $mpcons= $_SESSION['recette']['consommation'][$dte];
                            }else{
                                $mpcons=0;   
                            }
                            
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo dateAffiche($dte) ; ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpsej); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpcons); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $mpsej+$mpcons); ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=detrecet&dte1=<?php echo $dte; ?>" title="Détails recette du 10/11/2017" class="btn btn-primary btn-xs"> 
                                            <i class="fa fa-list fa-fw"></i> Détail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;
                            $totsej+=$mpsej;
                            $totcons+=$mpcons;} ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td></td>
                            <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'],$totsej); ?></b></td>
                             <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$totcons); ?></td>
                            <td><b><?php echo afficheMontant($_SESSION['Paie_affiche'],$totsej+$totcons); ?></b></td>
                            <td></td>
                        </tr>