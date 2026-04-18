<table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                           <th>#</th>
                            <th data-hide="phone,tablet">Noms</th>
                            <th data-hide="phone,tablet">Sexe</th>
                            <th data-hide="phone,tablet">Nationalité</th>
                            <th data-hide="phone,tablet">Etat civil</th>
                            <th data-hide="phone,tablet">Carte</th>
                            <th data-hide="phone,tablet">N° carte</th>
                            <th data-hide="phone,tablet">Provenance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        //Mise en session pour impression
                        $_SESSION['client']['n'] = array();
                        $_SESSION['client']['Client'] = array();
                        $_SESSION['client']['sexe'] = array();
                        $_SESSION['client']['nationalite'] = array();
                        $_SESSION['client']['etat'] = array();
                        $_SESSION['client']['carte'] = array();
                        $_SESSION['client']['numcarte'] = array();
                        $_SESSION['client']['provenance'] = array();
                        //Fin mise en session
                        foreach ($result as $rows) {
                            $nom_client = $rows->nom_client ;
                            $sexe_client =$rows->sexe_client;
                            $nationalite_client =$rows->nationalite_client ;
                            $etat_civil_client =$rows->etat_civil_client ;
                            $carte = $rows->num_piece_identite_client;
                            $numcarte= $rows->num_passeport_client;
                            $provenance=$rows->provenance_client;
                            array_push($_SESSION['client']['n'], $i);
                            array_push($_SESSION['client']['Client'],$nom_client);
                            array_push($_SESSION['client']['sexe'],$sexe_client);
                            array_push($_SESSION['client']['nationalite'],$nationalite_client);
                            array_push($_SESSION['client']['etat'],$etat_civil_client);
                            array_push($_SESSION['client']['carte'],$carte);
                            array_push($_SESSION['client']['numcarte'],$numcarte);
                            array_push($_SESSION['client']['provenance'],$provenance);
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $nom_client ?></td>
                                <td><?php echo $sexe_client  ?></td>
                                <td><?php echo $nationalite_client ?></td>
                                <td><?php echo $etat_civil_client;?></td>
                                <td><?php echo $carte ?></td>
                                <td><?php echo $numcarte ?></td>
                                <td><?php echo $provenance ?></td>
                            </tr>
                            <?php
                           $i++;
                             } 
                             ?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"><?php // echo $paging;  ?></div>
                            </td>
                        </tr>
                    </tfoot>-->
                </table>