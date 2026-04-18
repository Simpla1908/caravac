
<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		respointage
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php
foreach ($result2 as $empl) {
    $matricule = $empl->matricule;
    $nom_empl = $empl->noms;
    $fonction = $empl->fonction;
    $dpmt = $empl->dpmt;
}
?>

<div class="row">
    <div class="col-xs-12">    
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Détails présence  <?php echo 'du '. dateAffiche(get('datedebut')).' au '. dateAffiche(get('datefin')); ?></h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall" class="btn btn-default tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall" class="btn btn-default tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="clearfix"></div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Employé
                        <address>
                            <strong><?php echo $matricule. ' '. ucfirst($nom_empl); ?></strong><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Fonction
                        <address>
                            <b>  <?php echo ucfirst($fonction); ?></b>
                        </address>
                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Département
                        <address>
                            <strong><?php echo ucfirst($dpmt) ; ?></strong><br>
                        </address>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date arrivée</th>
                                    <th>Heure arrivée</th>
                                    <th>Date sortie</th>
                                    <th>Heure sortie</th>
                                    <th>Heures supplementaires</th>
                                    <th>Observation</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody id="viewdata">
                                <?php
                                $i = 1;
                                foreach ($result1 as $rows) {
        $dte_in = dateAffiche($rows->dte_in);
        $dte_out =dateAffiche($rows->dte_out);
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $dte_in; ?></td>
            <td><?php echo $rows->hr_in; ?></td>
            <td><?php echo $dte_out; ?></td>
            <td><?php echo $rows->hr_out; ?></td>
            <td><?php echo $this->respointage_model->seconds_to_time2($rows->hrs_suplmtr); ?></td>
            <td> 
            <?php 
            if($rows->motif=='AJ'){
            ?>
            <a href=""  title="<?php echo $rows->justification; ?>">
             <?php 
              }
            ?>
            <?php echo ObservationPointage($rows->motif); ?>
        </td>
             <?php 
            if($rows->motif=='AJ'){
            ?>
            </a>
             <?php 
              }
            ?>
            <td>
            <?php 
            if($rows->motif=='A'){
            ?>
            <div class="btn-group">
           <a id="<?php echo $rows->id; ?>" idemply="<?php echo $rows->employe_id; ?>" datedebut="<?php echo $datedebut; ?>" datefin="<?php echo $datefin; ?>" class="btn btn-primary btn-xs btnjustif"><span>Justifier</span></a>
            </div>
            <?php 
            }
            ?>
        </td>
        </tr>
        <?php
        $i++;
    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<?php include('modal_justif.php');?>