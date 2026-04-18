                     <?php 
                            //Mise en session pour impression
                            //numero facture globale hebergement
                            $lib_num_fact_gl='factureglobaleresto';
                            $num_cmd = getnumerotation($_SESSION['id_hotel'],$lib_num_fact_gl,$bdd);
                            $num_cmd_format = format_numero($num_cmd);  
                            $num_cmd+=1;
                            setnumerotation($_SESSION['id_hotel'], $lib_num_fact_gl, $num_cmd, $bdd);
                            ?>
                    <BR>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">

                            <address>
                                N° Facture: <strong><?php echo $num_cmd_format;?></strong><br>
                                Client: <strong><?php echo $libentreprise;?></strong><br>
                                Type: <strong><?php echo $libtypefact;?></strong><br>
                                Période:Du <?php echo $datedebut;?> Au <?php echo $datefin;?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>

                        </div>
                            </address
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <span class="">Date: <?php echo date('d/m/Y');?> </span><br>
                        </div>                    <!-- Table row -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row" id="panier">
                        <div class="col-xs-12 table-responsive">
                            <br><br>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Noms</th>
                                <th>Date</th>
                                <th>Facture</th>
                                <th>Mode </th>
                                 <th>Montant</th>

                            </tr>

                        </thead>
                        <tbody>
         <?php
          //Mise en session pour impression
       $_SESSION['rows_'] = array();
       $_SESSION['rows_resto']['i'] = array();
       $_SESSION['rows_resto']['noms'] = array();
       $_SESSION['rows_resto']['date'] = array();
       $_SESSION['rows_resto']['facture'] = array();
       $_SESSION['rows_resto']['montant'] = array();
       $_SESSION['rows_resto']['mode'] = array();

       //Fin mise en session
        $i = 1;
        $totaux = 0;
        $requete = $bdd->prepare
        ("SELECT a.id_client,a.nom_client,d.id_fact,d.num_fact,d.date_edition,d.mont_ttc,d.monnaie,d.mode
        FROM t_client AS a, t_facture AS d 
        WHERE a.id_client=d.id_client AND (d.date_edition>=:datedebut AND d.date_edition<=:datefin) AND d.type='restaurant' AND a.id_respo=:id_respo AND a.id_hotel=:id_hotel");
         $requete->BindParam(':datedebut',$datedebutbdd);
         $requete->BindParam(':datefin',$datefinbdd);
        $requete->BindParam(':id_respo',$partenaire);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
             $id_client=$r->id_client;
             $nom_client=$r->nom_client;
             $id_fact=$r->id_fact;
             $num_fact=$r->num_fact;
             $date_edition=$r->date_edition;
             $mont_ttc=$r->mont_ttc;
             $monnaie=$r->monnaie;
             $mode=$r->mode;
             $mont_ttc=montant_equivalent_bdd($monnaie, $m_affiche, $tauxdollar, $mont_ttc);
             $totaux+=$mont_ttc;
            ?>
                           <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $nom_client;?></td>
                            <td><?php echo dateAffiche($date_edition);?></td>
                            <td><?php echo $num_fact;?></td>
                           <td><?php echo $mode;?></td>
                            <td><?php echo afficheMontant($m_affiche, $mont_ttc);?></td>
                        </tr>
                        <?php
                        //Mise en session pour impression
                        array_push($_SESSION['rows_resto']['i'], $i);
                        array_push($_SESSION['rows_resto']['noms'], $nom_client);
                        array_push($_SESSION['rows_resto']['date'], dateAffiche($date_edition));
                        array_push($_SESSION['rows_resto']['facture'], $num_fact);
                        array_push($_SESSION['rows_resto']['montant'],afficheMontant($m_affiche, $mont_ttc));
                        array_push($_SESSION['rows_resto']['mode'],$mode);
                        //Fin mise en session
                        $i++; 
                }

                        ?>
                        </tbody>
                        <tfoot>
                      <tr>
                      <td colspan="5">Totaux</td>
                      <td><?php echo afficheMontant($m_affiche, $totaux) ?></td>
                      </tr>
                    </tfoot>
                        </table>
                        <?php 
                            //Mise en session pour impression
                            $_SESSION['num_fact_gl']=$num_cmd_format;
                            $_SESSION['partenaire']=$libentreprise;
                            $_SESSION['type_fact_gl']=$libtypefact;
                            $_SESSION['periode_fact_gl']='Du '.$datedebut.' Au '.$datefin;
                            $_SESSION['totaux']=afficheMontant($m_affiche, $totaux);
                            //Fin mise en session
                        ?>
                </div>

                       </div>
                        <!-- /.col -->
                    </div>