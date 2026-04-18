<!-- Modal -->
<form>
<div class="modal fade mdplus" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Plus</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                         <?php if (in_array('VTCR', $_SESSION['actions']['code_actions'])||in_array('VSPCER', $_SESSION['actions']['code_actions'])|| $_SESSION['type_user'] == 1){ ?>
                            <a style="margin-top: 10px; margin-left:10px;" href="main.php?p=facture&d=liste&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-squared-default-plain btn-primary btn-danger confirmModalLink">
                                <i class="fa fa-paste fa-5x"></i><br/>
                                Factures 
                            </a> 
                        <?php }?>
                        <?php if (in_array('RV',$_SESSION['actions']['code_actions'])|| in_array('VSV',$_SESSION['actions']['code_actions'])|| $_SESSION['type_user'] == 1){?>
                            <a style="margin-top: 10px; margin-left:10px;" href="pages_actions.php?page=analyse&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-squared-default-plain btn-primary">
                                <i class="fa fa-file-text fa-5x"></i><br/>
                                Détails <br/>Ventes
                            </a> 
                        <?php }?>
                        <?php if (in_array('AR9', $_SESSION['actions']['code_actions'])
                                ||in_array('VSPVS', $_SESSION['actions']['code_actions'])
                                ||in_array('VTVS', $_SESSION['actions']['code_actions'])){ ?>
                            <a style="margin-top: 10px; margin-left:10px;" href="main.php?p=versement&d=liste&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-squared-default-plain btn-warning">
                                <i class="fa fa-money fa-5x"></i><br/>
                                Versement <br/>
                            </a>
                        <?php } ?>
                        <?php if (in_array('AR13',$_SESSION['actions']['code_actions'])&& $_SESSION['stock']==1){?>
                        <a style="margin-top: 10px; margin-left:10px;" href="pages_actions.php?page=fiche&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-squared-default-plain bg-navy">
                            <i class="fa fa-paste fa-5x"></i><br/>
                            Fiche de <br/>stock
                        </a>
                        <?php } ?>
                        <?php if (in_array('PPR', $_SESSION['actions']['code_actions'])){ ?>
                           <a style="margin-top: 10px; margin-left:10px;" href="main.php?p=plat&d=liste&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-squared-default-plain bg-purple">
                                <i class="fa fa-cog fa-5x"></i><br/>
                                Parametrage <br/>des plats
                            </a> 
                        <?php } ?>
                       <?php if (in_array('VLTR',$_SESSION['actions']['code_actions'])){?>
                           <a style="margin-top: 10px; margin-left:10px;" href="pages_actions.php?page=table&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-squared-default-plain btn-success">
                                <i class="fa fa-table fa-5x"></i><br/>
                                Liste des <br/>Tables
                            </a> 
                        <?php }?>
                          
                        <?php if (in_array('AR6',$_SESSION['actions']['code_actions'])){?>
                            <a style="margin-top: 10px; margin-left:10px;" href="pages_actions.php?page=client" class="btn btn-squared-default-plain btn-info">
                                    <i class="fa fa-users fa-5x"></i><br/>
                                    Liste des <br/>clients
                            </a> 
                        <?php }?>
                        <a style="margin-top: 10px; margin-left:10px;" href="main.php?p=fdc&d=liste&ss=<?php echo $_SESSION['id_sousresto']?>" class="btn btn-squared-default-plain btn-warning">
                            <i class="fa fa-bank fa-5x"></i><br/>
                            Fonds de caisse <br/>
                        </a>
                        <?php // if (in_array('RV',$_SESSION['actions']['code_actions'])|| in_array('VSV',$_SESSION['actions']['code_actions'])|| $_SESSION['type_user'] == 1){?>
                            <a style="margin-top: 10px; margin-left:10px;" href="main.php?p=rapport&d=vente" class="btn btn-squared-default-plain btn-primary">
                                <i class="fa fa-file-text fa-5x"></i><br/>
                                Rapport
                            </a> 
                        <?php // }?>
                        <?php if (in_array('AR14',$_SESSION['actions']['code_actions'])){?>
                            <a style="margin-top: 10px; margin-left:10px;" href="../REC/tableaudebordRec.php" class="btn btn-squared-default-plain btn-danger">
                               <i class="fa fa-dashboard fa-5x"></i><br/>
                               Tableau <br/>de bord
                           </a>
                        <?php }?>
                    </div>
                </div>
            </div>
            
                <style>
.btn-squared-default {
  width: 100px !important;
  height: 100px !important;
  font-size: 10px;
}
.btn-squared-default:hover {
  border: 3px solid white;
  font-weight: 800;
}

.btn-squared-default-plain {
  width: 100px !important;
  height: 100px !important;
  font-size: 10px;
}
.btn-squared-default-plain:hover {
  border: 0px solid white;
}
                </style>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>

<div class="modal fade" id="myModal_affect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Liste des affectations</strong></h5>
            </div>
            <div class="modal-body" id="modal_affect">
               
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->