<?php
//include '../../bdd/connexion.php';

?> 
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Accusé de réceprtion</h3>
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
                
                <div class="x_content">
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <!--<div class="btn-group">-->
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <!--</div>-->
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        <div class="pull-right">
                          1-50/200
                          <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                          </div>
                          <!-- /.btn-group -->
                        </div>
                        <!-- /.pull-right -->
                      </div>
                      <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                          <tbody>
                           <?php
                            foreach ($msg as $m) {
                            ?>   
                          <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                            <td class="mailbox-name"><a href="?action=readmail&msg_id=<?php echo $m->id;?>"><?php echo $m->nom;?></a></td>
                            <td class="mailbox-subject"><b><?php echo $m->sujet;?></b> - <?php echo substr($m->message,0,40).'...';?>
                            </td>
                            <td class="mailbox-date"><?php echo date_formatee($m->date);?></td>
                            <td class="mailbox-date">
                                <?php if($m->statut=='envoye'){?>
                                <span class="label label-success"><?php echo 'Envoyé';?></span>
                                <?php }else{?>
                                <span class="label label-danger"><?php echo 'Non envoyé';?></span>
                                <?php }?>
                            </td>
                          </tr>
                          <?php
                            }
                            ?>
                          </tbody>
                        </table>
                        <!-- /.table -->
                      </div>
                      <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                      <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <!--<div class="btn-group">-->
                          <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        <!--</div>-->
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        <div class="pull-right">
                          1-50/200
                          <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                          </div>
                          <!-- /.btn-group -->
                        </div>
                        <!-- /.pull-right -->
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                  