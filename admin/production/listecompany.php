<?php
include '../traitement/company.php';
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
                    <h2>Compagnie <?php 
                    $datedepartT = strtotime(date('Y-m-d'));
                    setlocale(LC_TIME, "fr_FR", "fr_FR@euro", "fr", "FR", "fra_fra", "fra");
echo "Nous sommes le ".strftime("%A %d %B %Y et il est %Hh%M", $datedepartT);
                    ?> <small>View</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 40%">Site</th>
                                <th>Module</th>
                                <th>Montant</th>
                                <th>Company</th>
                                <th style="width: 5%">Activer/Désactiver</th>
                                <th style="width: 20%">#Action</th>
                            </tr>
                        </thead>


                        <tbody id="c">
                            <?php $i=1;foreach($resultats as $o):?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $o->nom_hotel?></td>
                                <td><?php echo $o->module?></td>
                                <td><?php echo round($o->montant,2)?> $</td>
                                <td><?php echo $o->nom_c?></td>
                                <td>
                                    <?php if($o->etat==1){ ?>
                                    <input type="checkbox" name="etat" class="choix" motif="company" url="../traitement/companyajax.php" id="<?php echo $o->id_hotel ?>"  checked="checked">
                                    <?php }else{ ?>
                                    <input type="checkbox" name="etat" class="choix" motif="company" url="../traitement/companyajax.php" id="<?php echo $o->id_hotel ?>" disabled="disabled">
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="?action=detais_souscription&AMP;id=<?php echo $o->id_hotel ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" class="btn btn-info btn-xs dropdown-toggle" type="button"><i class="fa fa-file-text"></i> Factures <span class="caret"></span> </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="?action=facture_client&AMP;id=<?php echo $o->id_hotel ?> &AMP;idmodcomp=<?php echo $o->idmodcomp ?>&AMP;idcomp=<?php echo $o->id_c?>">Facture simple mensuelle</a>
                                            </li>
                                            <li><a href="?action=facture_global_client&AMP;id=<?php echo $o->id_hotel ?> &AMP;idmodcomp=<?php echo $o->idmodcomp ?>&AMP;idcomp=<?php echo $o->id_c?>">Facture globale mensuelle </a>
                                        </ul>
                                    </div>
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