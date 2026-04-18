<table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                           <th>#</th>
                            <th data-hide="phone,tablet">N° Facture</th>
                            <th data-hide="phone,tablet">Client</th>
                            <th data-hide="phone,tablet">Accomp</th>
                            <th data-hide="phone,tablet">Chambre</th>
                            <th data-hide="phone,tablet">Tarif</th>
                            <th data-hide="phone,tablet">Date occ</th>
                            <th data-hide="phone,tablet">Date lib</th>
                            <th data-hide="phone,tablet">Nuitées</th>
                            <th data-hide="phone,tablet">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hrs_sys = date('H:i') . ':00';
                        $monnaie_ch = getsymbole_local();
                        $i=1;
                        //Mise en session pour impression
                        $_SESSION['datedebut']=$datedebut;
                        $_SESSION['datefin']=$datefin;
                        $_SESSION['client']['n'] = array();
                        $_SESSION['client']['Client'] = array();
                        $_SESSION['client']['Accomp'] = array();
                        $_SESSION['client']['Chambre'] = array();
                        $_SESSION['client']['Tarif'] = array();
                        $_SESSION['client']['Dateocc'] = array();
                        $_SESSION['client']['Datelib'] = array();
                        $_SESSION['client']['Nuitees'] = array();
                        //Fin mise en session
                        foreach ($result as $rows) {
                            $id = $rows->id;
                            $id_resch=$rows->id_resch;
                            $id_fact=$rows->id_fact;
                            $num_fact=$rows->num_fact;
                            $id_client = $rows->id_client;
                            $idreserv = $rows->id_res;
                            $tauxfact=$rows->taux;
                            $idchambre =$rows->idchambre;
                            $tarif_ch1 = $rows->tarif_ch;
                            $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $tauxfact, $tarif_ch1);
                            $dte = date('Y-m-d');
                            $date_lib = $rows->date_lib;
                            $date_occ = $rows->date_occ;
                            //$nuitees = NbJours($date_occ,$date_lib);
                            $nuitees =$rows->qte;
                            $nom_accomp=NomClientById($rows->nom_accomp,$bdd);
                            array_push($_SESSION['client']['n'], $i);
                            array_push($_SESSION['client']['Client'],ucfirst($rows->nom_client));
                            array_push($_SESSION['client']['Accomp'],ucfirst($nom_accomp));
                            array_push($_SESSION['client']['Chambre'],$rows->num_ch);
                            array_push($_SESSION['client']['Tarif'],afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2));
                            array_push($_SESSION['client']['Dateocc'],dateAffiche($date_occ));
                            array_push($_SESSION['client']['Datelib'],dateAffiche($date_lib));
                            array_push($_SESSION['client']['Nuitees'],$nuitees);
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo ucfirst($rows->nom_client) ?></td>
                                <td><?php echo ucfirst($nom_accomp) ?></td>
                                <td><?php echo $rows->num_ch;?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2) ?></td>
                                <td><?php echo dateAffiche($date_occ) ?></td>
                                <td><?php echo dateAffiche($date_lib) ?></td>
                                <td><?php echo $nuitees ?></td>
                                <td>
                                    <a href="<?php echo H_ADMIN; ?>&view=t_reservation&do=detfact2&id=<?php echo $id_fact; ?>" class="btn btn-primary btn-xs tip" title="" data-original-title="Détail de la facture"> 
                                        <i class="fa fa-list fa-fw"></i> 
                                    </a>
                                </td>
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