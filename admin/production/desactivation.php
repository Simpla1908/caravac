<?php
include '../traitement/desactivation.php';
if(!empty($_GET['bool'])&& $_GET['bool']==1){
   desactivationModule($bdd,$req_modulecompanyANDmoduleAndhotel);
   include '../../bdd/connexion.php';
   include '../traitement/desactivation.php'; 
}
?> 
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Administration</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Désactivation modules</h3>
                    <ul class="nav navbar-right panel_toolbox" style="margin-top:-40px;">
                        <a  href="?action=desactivation&AMP;bool=1"><button type="button" class="btn btn-danger btn-sm">Désactiver tout</button></a>
                    </ul>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th>Module</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th style="width: 5%">Date de désactivation</th>
                                <th style="width: 5%">Entreprise</th>
                            </tr>
                        </thead>
                        <tbody id="c">
                            <?php $i=1;foreach($resultats as $o):?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $o->nom?></td>
                                <td><?php echo $o->montantmodule?> $</td>
                                <td><?php if($o->etat_module==1){echo'activé';}else{echo'desactivé';}?></td>
                                <td><?php echo  $o->dte_blocage?></td>
                                <td><?php echo $o->nom_hotel?></td>
                            </tr>
                           <?php $i++;endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


                  