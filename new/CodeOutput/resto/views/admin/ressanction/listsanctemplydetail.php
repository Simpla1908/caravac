
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		rescategorie
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Sanctions</h3>
                <ul class="nav pull-right">
                 <a href="<?php echo H_ADMIN; ?>&view=ressanction&do=listsanctemply" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2 " data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th >Sanction</th>
                            <th data-hide="phone,tablet">Période</th>
                             <th data-hide="phone,tablet">Réference</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                          <?php
                          $i=1;
                          $_SESSION['sanction'] = array();
                          $_SESSION['sanction']['comment'] = array();
                        foreach ($result as $rows) {
                         $_SESSION['sanction']['comment'][$rows->id]=$rows->comment;

                            ?>
                            <tr>
                                <td><?php echo $i;?></td>
                               <td><?php echo dateAffiche($rows->dte) ; ?></td>              
                                <td><?php echo ucfirst($rows->libelle);?></td>
                                <td><?php 
                                if($rows->dte1!=Null){
                                echo 'Du '.dateAffiche($rows->dte1).' Au '.dateAffiche($rows->dte2) ; 
                                }
                                ?></td>
                                <td><?php echo $rows->ref; ?></td>
                                 <td class="table-actions">
                                    <div class="btn-group">
                             <a class="btn btn-default btn-xs tip btn_doc_sanction" idemplsc="<?php echo $rows->id; ?>" sanction="<?php echo $rows->libelle; ?>" dte="<?php echo $rows->dte; ?>" dte1="<?php echo $rows->dte1; ?>" dte2="<?php echo $rows->dte2; ?>" ref="<?php echo $rows->ref; ?>" employe_id="<?php echo $rows->employe_id; ?>"  doc="<?php echo $rows->doc; ?>" noms="<?php echo $rows->noms; ?>" sexe="<?php echo $rows->sexe; ?>" adresse="<?php echo $rows->Adresse; ?>" rue="<?php echo $rows->rue; ?>" quartier="<?php echo $rows->quartier; ?>" commune="<?php echo $rows->commune; ?>"  ville="<?php echo $rows->ville; ?>" nbrj="<?php echo $rows->nbre; ?>" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                                    </div>
                                </td>
                            </tr>
                        <?php 
                        $i++;
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"><?php // echo $paging; ?></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->