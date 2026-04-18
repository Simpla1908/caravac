
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
//Mise en session pour impression
$_SESSION['employe_matricule'] =$matricule;
$_SESSION['employe_nom'] =$nom_empl;
$_SESSION['employe_fonction'] =$fonction;
$_SESSION['employe_departm'] =$dpmt;
$_SESSION['rows_presence'] = array();
$_SESSION['rows_presence']['i'] = array();
$_SESSION['rows_presence']['date_arrive'] = array();
$_SESSION['rows_presence']['heure_arrive'] = array();
$_SESSION['rows_presence']['date_sortie'] = array();
$_SESSION['rows_presence']['heure_sortie'] = array();
$_SESSION['rows_presence']['heure_suppl'] = array();
$_SESSION['rows_presence']['observ'] = array();
//Fin mise en session
?>

<div class="row">
    <div class="col-xs-12">    
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Détails présence  <?php echo 'du '. dateAffiche(get('datedebut')).' au '. dateAffiche(get('datefin')); ?></h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall" class="btn btn-default tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                    <a href="<?php echo H_ADMIN; ?>&view=respointage&do=viewall" class="btn btn-default tip btnpresencedetail" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="clearfix"></div>
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        Employé
                        <address>
                            <strong><?php echo ucfirst($nom_empl); ?></strong><br>
                        </address>
                    </div>
                     <div class="col-sm-3 invoice-col">
                        Matricule
                        <address>
                            <strong><?php echo $matricule; ?></strong><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 invoice-col">
                        Fonction
                        <address>
                            <b>  <?php echo ucfirst($fonction); ?></b>
                        </address>
                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                    <div class="col-sm-3 invoice-col">
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
        //Mise en session pour impression
        array_push($_SESSION['rows_presence']['i'], $i);
        array_push($_SESSION['rows_presence']['date_arrive'], $dte_in);
        array_push($_SESSION['rows_presence']['heure_arrive'], $rows->hr_in);
        array_push($_SESSION['rows_presence']['date_sortie'], $dte_out);
        array_push($_SESSION['rows_presence']['heure_sortie'], $rows->hr_out);
        array_push($_SESSION['rows_presence']['heure_suppl'],$this->respointage_model->seconds_to_time2($rows->hrs_suplmtr));
        array_push($_SESSION['rows_presence']['observ'],ObservationPointage($rows->motif));
        $_SESSION['datedebut_presence']=dateAffiche(get('datedebut'));
        $_SESSION['datefin_presence']=dateAffiche(get('datefin'));

        //Fin mise en session
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