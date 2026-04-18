<div class="col-lg-12">
      <table id="example1" class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                       <th>N°</th>
                        <th>Date</th>
                        <th>N° Facture</th>
                        <th>Table</th>
                        <th style="text-align: center;">Nombre de couverts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Mise en session pour impression
                    $_SESSION['dte1']=dateAffiche($dte1);
                    $_SESSION['dte2']=dateAffiche($dte2);
                    $_SESSION['couverts'] = array();
                    $_SESSION['couverts']['i'] = array();
                    $_SESSION['couverts']['date_edition'] = array();
                    $_SESSION['couverts']['num_fact'] = array();
                    $_SESSION['couverts']['table'] = array();
                    $_SESSION['couverts']['nbrcouvert'] = array();
                    //fin mise en session
                    $i = 1;
                    $tot=0;
                    foreach ($couverts as $l){
                        $id = $l->id_fact;
                        $num_fact = $l->num_fact;
                        $date_edition = dateAffiche($l->date_edition);
                        $table=$l->designation;
                        $nbrcouvert=$l->nbrcouvert;
                        array_push($_SESSION['couverts']['i'],$i);
                        array_push($_SESSION['couverts']['date_edition'],$date_edition);
                        array_push($_SESSION['couverts']['num_fact'],$num_fact);
                        array_push($_SESSION['couverts']['table'],$table);
                        array_push($_SESSION['couverts']['nbrcouvert'],$nbrcouvert);
                     ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $date_edition?></td>
                                <td><?php echo $num_fact ?></td>
                                <td><?php echo $table ?></td>
                                <td  style="text-align: center;"><?php echo $nbrcouvert ?></td>
                            </tr>
                            <?php
                            $i++;
                            $tot+=$nbrcouvert;
                    }
                    $_SESSION['tot_couverts']=$tot;
                    ?> 
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4"  style="text-align: center;"><span>TOTAL</span></th>
                        <th  style="text-align: center;"><?php echo $tot; ?></th>
                    </tr>
                </tfoot>
            </table>
</div>

