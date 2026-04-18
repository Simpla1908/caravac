
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


<form action="<?php echo H_ADMIN_MAIN . '&view=t_reservation&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">
        <ul class="nav pull-right" style="margin-top:5px;">
            <label for="hButton" class="btn btn-info btn-sm" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
            <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />

            <a href="<?php echo H_ADMIN; ?>&view=module&do=heb2" class="btn btn-default btn-sm tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
        </ul>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-reorder"></i> <?php echo LANG_CREATE_NEW; ?> T Reservation</h3></div>
            <div class="panel-body">

                <div class="output"></div>

                <div class="form-group">
                    <label class="control-label" for="num_reserv">Num Reserv</label>
                    <input id="num_reserv" name="num_reserv" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="garantie">Garantie</label>
                    <input id="garantie" name="garantie" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="num_bc">Num Bc</label>
                    <input id="num_bc" name="num_bc" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="num_occ">Num Occ</label>
                    <input id="num_occ" name="num_occ" type="text" maxlength="50"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="num_com">Num Com</label>
                    <input id="num_com" name="num_com" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="type">Type</label>
                    <input id="type" name="type" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="tva">Tva</label>
                    <input id="tva" name="tva" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="taux">Taux</label>
                    <input id="taux" name="taux" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="remise">Remise</label>
                    <input id="remise" name="remise" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="majoration">Majoration</label>
                    <input id="majoration" name="majoration" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="mont_nuite">Mont Nuite</label>
                    <input id="mont_nuite" name="mont_nuite" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="mont_total_res">Mont Total Res</label>
                    <input id="mont_total_res" name="mont_total_res" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="mont_par_chambre">Mont Par Chambre</label>
                    <input id="mont_par_chambre" name="mont_par_chambre" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="monnaie">Monnaie</label>
                    <input id="monnaie" name="monnaie" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="nbr_ch">Nbr Ch</label>
                    <input id="nbr_ch" name="nbr_ch" type="text" maxlength="10"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="etat">Etat</label>
                    <input id="etat" name="etat" type="text" maxlength="50"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="etat_credit">Etat Credit</label>
                    <input id="etat_credit" name="etat_credit" type="text" maxlength="10"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="dte">Dte</label>
                    <input name="dte" class="datepicker form-control styler" type="text" maxlength="10" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="date_res">Date Res</label>
                    <input name="date_res" class="datepicker form-control styler" type="text" maxlength="10" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="date_occ">Date Occ</label>
                    <input name="date_occ" class="datepicker form-control styler" type="text" maxlength="10" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="date_lib">Date Lib</label>
                    <input name="date_lib" class="datepicker form-control styler" type="text" maxlength="10" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="statut_res">Statut Res</label>
                    <input id="statut_res" name="statut_res" type="text" maxlength="15"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="statut_occ">Statut Occ</label>
                    <input id="statut_occ" name="statut_occ" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="statut_sorti">Statut Sorti</label>
                    <input id="statut_sorti" name="statut_sorti" type="text" maxlength="20"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="id_client">Id Client</label>
                    <input id="id_client" name="id_client" type="text" maxlength="10"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="chambr_id">Chambr Id</label>
                    <input id="chambr_id" name="chambr_id" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="id_hotel">Id Hotel</label>
                    <input id="id_hotel" name="id_hotel" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="dte_a">Dte A</label>
                    <input name="dte_a" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="dte_s">Dte S</label>
                    <input name="dte_s" class="datepicker form-control styler" type="text" maxlength="11" value="<?php echo date('Y-m-d'); ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="occ_indirect">Occ Indirect</label>
                    <input id="occ_indirect" name="occ_indirect" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="form-group">
                    <label class="control-label" for="respo_id">Respo Id</label>
                    <input id="respo_id" name="respo_id" type="text" maxlength="11"  value="" class="form-control styler" />
                </div>

                <div class="output"></div>
            </div>
            <div class="panel-footer" style="border-bottom:solid 2px #CCC;"> 
                <label for="hButton" class="btn btn-info" style="color:#FFF;"><i class="fa fa-floppy-o"></i> <?php echo LANG_CREATE_RECORD; ?></label>
                <input type="submit" name="button" id="hButton" class="hidden" value="<?php echo LANG_CREATE_RECORD; ?>" />
            </div>



        </div><!--/col-12-->

</form>
