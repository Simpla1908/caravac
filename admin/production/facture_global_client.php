<?php 
include '../traitement/facture_global.php';
include '../../FUNCTION/date_format.php';
?> 
<div class="">
  <div class="page-title">
        <div class="title_left">
            <h3>Factures</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3> 
                         <?php  
                         foreach($resultats as $o):
                            echo $o->nom_hotel;
                            break;
                         endforeach;
                         ?>
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>Module</th>
                                <th>Mois</th>
                                 <th>Montant</th>
                                <th>Date d'échéance</th>
                                <th>#Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach($resultats as $o):?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $o->module ?></td>
                                <td><?php echo $o->nom_mois  ?></td>
                                <td><?php echo $o->montant ?>  $</td>
                                <td><?php echo date_formatee($o->date_echeance) ?></td>
                                <td>
                                    <a href="?action=details_facture_global&AMP;id=<?php echo $o->id_hotel ?>&AMP;id_fact=<?php echo $o->id_fact?>&AMP;mois=<?php echo $o->nom_mois ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                </td>
                            </tr>
                            <?php $i++;endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
