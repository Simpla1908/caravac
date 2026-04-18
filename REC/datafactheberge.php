                       <?php 
                            //Mise en session pour impression
                            //numero facture globale hebergement
                            $lib_num_fact_gl='factureglobaleheberge';
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
                                <th>Période</th>
                                <th>Jours</th>
                                <th>Chamnbre</th>
                                <th>Tarif</th>
                                <th>Total </th>
                            </tr>

                        </thead>
                        <tbody>
         <?php
       //Mise en session pour impression
       $_SESSION['rows_heberge'] = array();
       $_SESSION['rows_heberge']['i'] = array();
       $_SESSION['rows_heberge']['noms'] = array();
       $_SESSION['rows_heberge']['date'] = array();
       $_SESSION['rows_heberge']['facture'] = array();
       $_SESSION['rows_heberge']['periode'] = array();
        $_SESSION['rows_heberge']['nombredejours'] = array();
        $_SESSION['rows_heberge']['tarif'] = array();
          $_SESSION['rows_heberge']['chambre'] = array();
         $_SESSION['rows_heberge']['total'] = array();

       //Fin mise en session
        $i = 1;
        $totaux = 0;
        $requete = $bdd->prepare
        ("SELECT a.id_client,a.nom_client,d.id_fact,d.num_fact,b.id_res,b.dte,c.date_occ,c.date_lib,c.tarif_ch,c.monnaie,e.num_ch 
        FROM t_client AS a,t_reservation AS b,t_reserve_chambre AS c, t_facture AS d,t_chambre  AS e
        WHERE a.id_client=b.id_client AND b.id_res=c.idreserv AND c.idchambre=e.id_ch 
        AND a.id_client=d.id_client AND (b.dte>=:datedebut AND b.dte<=:datefin) AND d.type='hebergement' AND a.id_respo=:id_respo AND a.id_hotel=:id_hotel");
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
             $id_res=$r->id_res;
             $dte=$r->dte;
             $dte_a=$r->date_occ;
             $dte_s=$r->date_lib;
             $tarif_ch=$r->tarif_ch;
             $num_ch=$r->num_ch;
             $monnaie=$r->monnaie;
             $njrreserv=NbJours($dte_a, $dte_s);
             $tarifreserv=montant_equivalent_bdd($monnaie, $m_affiche, $tauxdollar, $tarif_ch);
             $totreserv=$tarifreserv*$njrreserv;
             $totaux+=$totreserv;
            ?>
                           <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $nom_client;?></td>
                            <td><?php echo dateAffiche($dte);?></td>
                            <td><?php echo $num_fact;?></td>
                            <td>Du <?php echo dateAffiche($dte_a);?> Au <?php echo  dateAffiche($dte_s);?></td>
                            <td><?php echo $njrreserv;?></td>
                            <td><?php echo $num_ch;?></td>
                            <td><?php echo afficheMontant($m_affiche, $tarifreserv) ?></td>
                            <td><?php echo afficheMontant($m_affiche, $totreserv) ?></td>
                        </tr>
                        <?php
                            //Mise en session pour impression
                            array_push($_SESSION['rows_heberge']['i'], $i);
                            array_push($_SESSION['rows_heberge']['noms'], $nom_client);
                            array_push($_SESSION['rows_heberge']['date'], dateAffiche($dte));
                            array_push($_SESSION['rows_heberge']['facture'], $num_fact);
                            array_push($_SESSION['rows_heberge']['periode'],'Du '.dateAffiche($dte_a).' Au '.dateAffiche($dte_s));
                            array_push($_SESSION['rows_heberge']['nombredejours'],$njrreserv);
                            array_push($_SESSION['rows_heberge']['chambre'],$num_ch);
                            array_push($_SESSION['rows_heberge']['tarif'],afficheMontant($m_affiche, $tarifreserv));
                            array_push($_SESSION['rows_heberge']['total'],afficheMontant($m_affiche, $totreserv));
                            //Fin mise en session
                        $i++; 
                }

                        ?>
                        </tbody>
                        <tfoot>
                      <tr>
                      <td colspan="8">Totaux</td>
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