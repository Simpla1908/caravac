<?php include '../traitement/generation_facture.php';?> 
<div class="">
  <div class="page-title">
        <div class="title_left">
            <h3>Facture par module</h3>
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
                                <th>Numéro</th>
                                <th>Mois</th>
                                <th>Date d'édition</th>
                                <th>Date d'échéance</th>
                                <th>Montant</th>
                                <th>Etat</th>
                                <th>#Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach($resultats as $o):?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $o->nom ?></td>
                                <td><?php echo $o->num_fact ?></td>
                                <td><?php echo $o->nom_mois  ?></td>
                                <td><?php echo $o->date_edition ?></td>
                                <td><?php echo $o->date_echeance ?> </td>
                                <td>$<?php echo $o->mont_ttc ?></td>
                                <td class="text-primary"><?php echo $o->etat_fac?></td>
                                <td>
                                    <a href="?action=detail_facture&AMP;id= <?php echo $o->id_hotel ?>&AMP;idmodcomp=<?php echo $o->module_id?>&AMP;id_fact=<?php echo $o->id_fact?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
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
