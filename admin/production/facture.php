<?php
//include '../../bdd/connexion.php';
//$result=getAllFactureByType($type_souscription,$bdd);
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
                    <h2>Liste</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered table-condensed dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>N° Facture</th>
                                <th>Type</th>
                                <th>Date édition</th>
                                <th>Entreprise</th>
                                 <th>Site</th>
                                <th>Montant total</th>
                                <th>Montant payé</th>
                                <th>Solde</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="c">
                            <?php 
                            $i=1;
                            $reste=0;
                            foreach($result as $o){
                               $id_fact=$o->id_fact;
//                               $num_scrpt=$o->libelle;
                               $num_fact=$o->num_fact;
                               $mont_ttc=$o->mont_ttc;
                               $mont_tot= afficheMontant($monnaie,$mont_ttc);
                               $totpaye=MontpayeFactScpt($id_fact,$bdd);
                               $mont_paye= afficheMontant($monnaie,$totpaye);
                               $reste=$mont_tot-$mont_paye;
                               $reste_af= afficheMontant($monnaie,$reste);
                               $dte_echeance=  dateAffiche($o->date_echeance);
                               $dte_edition=  dateAffiche($o->date_edition);
                               $nom_c=$o->nom_c;
                               $nom_hotel=$o->nom_hotel;
                               $type='souscription';
                               $t='s';
                               if($o->type=='adduser'){
                                   $type='Achat User'; 
                                   $t='a';
                               }
                             ?>
                            <tr>
                                <td><?php  echo $i ?></td>
                                <td><?php echo $num_fact?></td>
                                <td><?php echo $type?></td>
                                <td><?php echo $dte_edition?></td>
                                <td><?php  echo $nom_c?></td>
                                <td><?php  echo $nom_hotel?></td>
                                <td><?php  echo $mont_tot?></td>
                                <td><?php  echo $mont_paye?></td>
                                <td><?php  echo $reste_af?></td>
                                <td>
                                    <a href="?action=detailsfacture&AMP;id=<?php echo $id_fact ?>&type=<?php echo $t ?>"class="btn btn-primary btn-xs"> Détails </a>
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