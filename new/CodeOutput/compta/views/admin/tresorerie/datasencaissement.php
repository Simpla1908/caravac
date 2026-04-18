 <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-hide="phone,tablet">Référence</th>
                            <th data-hide="phone,tablet">Compte</th>
                            <th data-hide="phone,tablet">Description</th>
                            <th data-hide="phone,tablet">Montant</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Mise en session pour impression
                        $_SESSION['datedebut']=dateAffiche($datedebut);
                        $_SESSION['datefin']=dateAffiche($datefin);
                        $_SESSION['devise']=$monnaie;
                        $_SESSION['caisse'] = array();
                        $_SESSION['caisse']['n'] = array();
                        $_SESSION['caisse']['date'] = array();
                        $_SESSION['caisse']['reference'] = array();
                        $_SESSION['caisse']['compte'] = array();
                        $_SESSION['caisse']['description'] = array();
                        $_SESSION['caisse']['montant'] = array();
                        //fin mise en session
                        $i=1;
                        $tot=0;
                        foreach ($result as $rows) {
                             $data=INFOSFromAccountNumber($rows->compte_id,$rows->format,$bdd);
                             $compte=$rows->compte_id.'  '.$data['lib'];
                            if($monnaie=='CDF'){
                                $montant=$rows->montantFC; 
                                }else{
                                $montant=$rows->montantUSD; 

                                }
                            if($montant>0){

                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo dateAffiche($rows->date_bon); ?></td>
                                <td><?php echo $rows->numBon;?></td>
                                <td><?php echo ucfirst($compte) ?></td>
                                <td><?php echo ucfirst($rows->description) ?></td>
                                <td><?php echo afficheMontant($monnaie, $montant)?></td>

                                 <td class="table-actions">
                                <div class="btn-group">
                            <?php if (in_array('CPTMODIFTRES', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                            <a href="<?php echo H_ADMIN; ?>&view=tresorerie&idoperation=<?php echo $rows->idoperation; ?>&do=update" class="btn btn-primary btn-xs hidden"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                            <?php } ?>
                            <?php if (in_array('CPTSUPPRTRES', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                            <a href="<?php echo H_ADMIN; ?>&view=tresorerie&idoperation=<?php echo $rows->idoperation; ?>&do=delete" class="btn btn-danger btn-xs hidden" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                             <?php } ?>

                            <a  target="_blank" href="./main.php?pg=admin&view=impression&do=recuencaisse&id=<?php echo $rows->idoperation; ?>" class="btn btn-success btn-xs"> <span class="fa fa-print tip" title="Imprimer"></span></a>
                                </div>
                            </td>
                               
                            </tr>
                            <?php
                            array_push($_SESSION['caisse']['n'],$i);
                            array_push($_SESSION['caisse']['reference'],$rows->numBon);
                            array_push($_SESSION['caisse']['date'],dateAffiche($rows->date_bon));
                            array_push($_SESSION['caisse']['compte'],ucfirst($compte));
                            array_push($_SESSION['caisse']['description'],ucfirst($rows->description));
                            array_push($_SESSION['caisse']['montant'],format_chiffre2($montant));
                               $tot=$tot+$montant;
                               $i++;
                            }
                            } 
                            $_SESSION['tot']=format_chiffre2($tot);
                             ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th colspan="5">TOTAL</th>
                      <th colspan="2"><?php echo afficheMontant($monnaie, $tot);?></th>
                      </tr>
                    </tfoot>
                </table>
