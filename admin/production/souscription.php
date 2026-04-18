
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Souscriptions</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered table-condensed dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>Entreprise</th>
                                 <th>Site</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Etat</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="c">
                            <?php
                            $i=1;
//                            var_dump($result);
                            foreach($result as $r){
                               $id=$r->id;
                               $libelle= $r->libelle;
                               $etat= $r->etat_sous;
                               $statut= $r->statut;
                               $company_id=$r->id_c;
                               $nom_compagnie=$r->nom_c;
                               $date_souscrip=dateAffiche($r->date_sous);
                               $result1=getRowsHotel($company_id,$bdd);
                               $id_site= $r->id_hotel;
                               $nom_site= $r->nom_hotel;
                               $lib_etat = getEtatSouscription($etat);
                             ?>
                            <tr>
                                <td><?php echo $i ?></td>

                                <td><?php echo $nom_compagnie?></td>
                                <td><?php echo $nom_site?></td>
                                <td><?php echo $date_souscrip?></td>
                                <td><?php echo $statut?></td>
                                <td><?php echo $lib_etat?></td>
                                <td>
                                    <a href="?action=detailssouscription&AMP;id=<?php echo $id ?>" class="btn btn-success btn-xs">Détails</a>
                                </td>
                            </tr>
                           <?php $i++;};?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
