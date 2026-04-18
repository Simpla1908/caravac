<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_reservation
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>

<form class="frmpaie" action="<?php echo H_ADMIN_MAIN . '&view=t_reservation&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12" id="sejourdiv">
        <ul class="nav pull-right hidden" style="margin-top:5px;">
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <!--<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> Facture</h3></div>-->
            <div class="panel-body">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <h6 class="page-header">
                            Client
                            <a href="#" title="Ajouter" data-toggle="modal" data-target="#mdpersonne" class="btn btn-danger btn-xs" id="btnaddarticle">
                                Ajouter
                            </a>
                            <!--<a href="<?php // echo H_ADMIN; 
                                            ?>&view=module&do=heb2" class="btn btn-default btn-xs tip" title="Retour au planning"><i class="fa fa-reply"></i> <?php // echo 'Planning'; 
                                                                                                                                                                ?></a>-->
                        </h6>

                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <input type="hidden" id="compte1" value="41110001" name="compte1">
                                <input type="hidden" id="compte2" value="" name="compte2">
                                <input type="hidden" id="nom_client" value="" name="nom_client">


                                <label for="motif">Responsable</label>
                                <select class="choz" name="respo_id" id="respo_id">
                                    <?php foreach ($responsables as $rows) { ?>
                                        <option c1="<?php echo $rows->numero ?>" value="<?php echo $rows->id_respo ?>" prive='<?php echo $rows->filtre ?>'><?php echo $rows->entreprise ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group" id="cldiv">
                                <label for="exampleInputEmail1">Client</label>
                                <select class="form-control col-md-3 choz pers" name="id_client" id="id_client">
                                    <option value="0"></option>
                                    <?php foreach ($clients as $rows) {
                                        if ($rows->suffixcompt != NULL) {
                                    ?>
                                            <option n="<?php echo $rows->nom_client; ?>" c2="<?php echo $rows->suffixcompt ?>" value="<?php echo $rows->id_client ?>"><?php echo $rows->nom_client ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group" id="accompdiv">
                                <label for="exampleInputEmail1">Accompagné</label>
                                <select class="form-control col-md-3 choz" name="accomp_id" id="accomp_id">
                                    <option value="0">Non</option>
                                    <?php foreach ($clients as $rows) { ?>
                                        <option value="<?php echo $rows->id_client ?>"><?php echo $rows->nom_client ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                                <label for="motif">Motif</label>
                                <select class="col-md-2 col-sm-12 col-xs-12 form-control choz" name="motif" id="motif">

                                    <?php
                                    if ($_GET['onlyreserv'] == 0) {
                                        if (in_array('EO', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                            <option value="occupe">occupation</option>
                                    <?php
                                        }
                                    }

                                    ?>
                                    <?php if (in_array('ER', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                        <option value="reserve">reservation</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <h6 class="page-header">Période </h6>
                        <div class="row">
                            <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                                <label for="dt_edit_res">Date édition</label>
                                <input class="form-control datepicker2" type="text" value="<?php echo dateAffiche(date('Y-m-d')); ?>" disabled>
                                <input name="dte" id="dt_edit_res" class="form-control datepicker2" type="hidden" value="<?php echo dateAffiche(date('Y-m-d')); ?>">
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                                <label for="date_arrive">Date arrivée</label>
                                <input class="form-control datepicker2" type="text" value="<?php echo dateAffiche($dte1); ?>" disabled>
                                <input name="date_arrive" id="date_arrive" class="form-control datepicker2" type="hidden" value="<?php echo dateAffiche($dte1); ?>">
                            </div>

                            <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                                <label for="date_sortie">Date Départ</label>
                                <input name="date_sortie" id="date_sortie" class="form-control datepicker2" type="text" value="<?php echo dateAffiche($dte2); ?>">
                            </div>

                        </div>

                        <h6 class="page-header">Chambres </h6>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Désignation</th>
                                        <th>Prix</th>
                                        <th>Nuitée</th>
                                        <th>Montant</th>
                                        <!--<th></th>-->
                                    </thead>
                                    <tbody id="detailsej">
                                        <?php include(APP_FOLDER . '/views/admin/t_reservation/lich.php'); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h6 class="page-header">Autres services
                            <a href="#" title="Ajouter" data-toggle="modal" data-target="#mdservice" class="btn btn-danger btn-xs">
                                Ajouter
                            </a>
                        </h6>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Désignation</th>
                                        <th>Prix</th>
                                        <th>QTE</th>
                                        <th>Montant</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="detailservice">
                                        <?php // include(APP_FOLDER . '/views/admin/t_reservation/lich.php'); 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h6 class="page-header">Total à payer: <span class="text-danger" id="totfacture"><?php echo afficheMontant($_SESSION['Paie_affiche'], $ttc); ?> </span></b> soit <b><span class="text-danger" id="ttc_eqvlt_aff"><?php echo $ttc_eqvlt_aff ?> </span></h6>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label for="mode">Mode paiement</label>
                                    <select class=" col-md-2 col-sm-12 col-xs-12 form-control choz" name="mode" id="mode">
                                        <?php for ($i = 0; $i <= $modecpt - 1; $i++) { ?>
                                            <option value="<?php echo $modepaiements['id'][$i] ?>"><?php echo $modepaiements['lib'][$i] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 form-group blcmp">
                                    <label for="usd">Montant payé <?php echo AfficheMonnaie(getsymbole_devise()); ?></label>
                                    <div class="input-group">
                                        <input name="usd" id="usd" class="form-control mp" type="text" value="<?php echo 0; ?>">
                                        <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_devise()); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 form-group blcmp">
                                    <label for="cdf">Montant payé <?php echo AfficheMonnaie(getsymbole_local()); ?></label>
                                    <div class="input-group">
                                        <input name="cdf" id="cdf" class="form-control mp" type="text" value="<?php echo 0; ?>">
                                        <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_local()); ?></span>
                                    </div>
                                </div>

                            </div>
                            <div class="row hidden blrendu">
                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label for="type_rendu">Rendu</label>
                                    <select class=" col-md-2 col-sm-12 col-xs-12 form-control choz" name="type_rendu" id="type_rendu">
                                        <option value="oui">oui</option>
                                        <option value="non">non</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 form-group blr1">
                                    <label for="usd">Rendu <?php echo AfficheMonnaie(getsymbole_devise()); ?></label>
                                    <div class="input-group">
                                        <input name="rendu_usd" id="rendu_usd" class="form-control" type="text" value="<?php echo 0; ?>">
                                        <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_devise()); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 form-group blr1">
                                    <label for="cdf">Rendu <?php echo AfficheMonnaie(getsymbole_local()); ?></label>
                                    <div class="input-group">
                                        <input name="rendu_cdf" id="rendu_cdf" class="form-control" type="text" value="<?php echo 0; ?>">
                                        <span class="input-group-addon"><?php echo AfficheMonnaie(getsymbole_local()); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="callout callout-danger hidden" style="margin-bottom: 0!important;" id="notification">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <input name="id_ch" id="id_ch" type="hidden" value="<?php echo $id_ch; ?>">
                <input name="factheb_id" id="factheb_id" type="hidden" value="0">
                <input name="libelle_mode" id="libelle_mode" type="hidden" value="Cash">
                <input name="totrendu" id="totrendu" type="hidden" value="0">
                <input name="prive" id="prive" type="hidden" value="0">
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;">
                <!--<label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>-->
                <!--<input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />-->
                <?php if (
                    in_array('EO', $_SESSION['actions']['code_actions'])
                    || in_array('ER', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1
                ) { ?>
                    <button type="button" class="btn btn-primary btn-sm" id="btn_heb_save"><i class="fa fa-floppy-o"></i> Valider</button>
                <?php } ?>
                <span class="btn btn-danger loader hidden">
                    <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours!
                </span>
                <!--<button type="button" class="btn btn-primary btn-sm  impmel hidden btn_heb_print2" id="btn_heb_print" idf="0"><i class="fa fa-print"></i> Imprimer</button>-->
                <!--<button type="button" class="btn btn-primary btn-sm hidden impmel" id="btn_heb_send"><i class="fa fa-envelope"></i> Envoyer par mail</button>-->
            </div>


        </div>
    </div>
    <!--/col-12-->

</form>
<div id="mdpersonne" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Information client</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="pers_frm">
                    <div class="box-body">
                        <div class="callout hidden" style="margin-bottom: 0!important;" id="notifpers">
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Compte</label>
                                <input type="text" class="form-control accountnumberaff" disabled="disabled" value="" name="displysuffixcompt">
                                <input type="hidden" class="accountnumberaff" value="" name="suffixcompt">
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12  ">
                                <label for="exampleInputEmail1">Noms</label>
                                <input name="nom_client" id="nom_client" type="text" class="form-control npers InputGenAccount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label for="adresse_provenance_client">Adresse</label>
                                <input name="adresse_provenance_client" id="adresse_provenance_client" type="text" class="form-control npers">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="telephone_client">Téléphone</label>
                                <input name="telephone_client" id="telephone_client" type="text" class="form-control npers">
                            </div>
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="num_pers_contacter_client">Autre Contact</label>
                                <input name="num_pers_contacter_client" id="num_pers_contacter_client" type="text" class="form-control npers">
                            </div>
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="email_client">Email</label>
                                <input name="email_client" id="email_client" type="text" class="form-control npers">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="sexe_client">Sexe</label>
                                <select class="form-control col-md-4 col-sm-12 col-xs-12 choz" name="sexe_client" id="sexe_client">
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="date_naiss_client">Date de naissance</label>
                                <input name="date_naiss_client" id="date_naiss_client" type="text" class="form-control datepicker2 npers">
                            </div>
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="etat_civil_client">Etat civil</label>
                                <select class="form-control col-md-4 col-sm-12 col-xs-12 choz" name="etat_civil_client" id="etat_civil_client">
                                    <option value="Celibataire">Celibataire</option>
                                    <option value="Marie">Marie</option>
                                    <option value="Divorce">Divorce</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="nationalite_client">Nationalité</label>
                                <input name="nationalite_client" id="nationalite_client" type="text" class="form-control npers">
                            </div>
                            <div class="form-group col-md-4 col-sm-12 col-xs-12  ">
                                <label for="num_piece_identite_client">Pièce</label>
                                <select class="form-control col-md-4 col-sm-12 col-xs-12 choz" name="num_piece_identite_client" id="num_piece_identite_client">
                                    <option value="Carte d'électeur">Carte d'électeur</option>
                                    <option value="Carte militaire">Carte militaire</option>
                                    <option value="Permis de conduire">Permis de conduire</option>
                                    <option value="Passport">Passport</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                <label for="num_passeport_client">Numéro</label>
                                <input name="num_passeport_client" id="num_passeport_client" type="text" class="form-control npers">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12  ">
                                <label for="provenance_client">Provenance</label>
                                <input name="provenance_client" id="provenance_client" type="text" class="form-control npers">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="add_persheb_btn">Valider</button>
            </div>

        </div>
    </div>
</div>
<!-- Modal service-->
<div class="modal fade" id="mdservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Services</h4>
            </div>
            <div class="modal-body">
                <form id="serviceform">
                    <div class="table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>Libellé</th>
                                    <th>Prix</th>
                                    <th>QTE</th>
                                </tr>
                                <?php
                                foreach ($services as $rows) {
                                    $id_ch = $rows->id_ch;
                                    $tarif_ch1 = $rows->tarif_ch;
                                    $monnaie_ch = $rows->monnaie;
                                    $tarif_ch2 = montant_equivalent_bdd($monnaie_ch, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $tarif_ch1);
                                ?>
                                    <tr>
                                        <td><input name="service_ids[]" value="<?php echo $id_ch ?>" type="checkbox"></td>
                                        <td><?php echo $rows->num_ch ?></td>
                                        <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tarif_ch2) ?></td>
                                        <td class="col-md-2"><input name="nuite<?php echo $id_ch ?>" value="<?php echo 1 ?>" type="text" class="form-control col-md-2"></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button class="btn btn-danger" id="add_service"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
                </button>
            </div>
        </div>
        <!--.modal-content-->
    </div>
    <!--modal-dialog-->
</div>