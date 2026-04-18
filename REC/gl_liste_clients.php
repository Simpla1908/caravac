			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
          
        <div id="page-wrapper">
        				<br>
            			
                       	<h1><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h1>
                        
                        <div class="row">
                                <div class="col-lg-12">
                                <h1 class="page-header">Liste des Clients</h1>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Liste de clients</h4>
                                            <div style="margin-top:-45px; margin-left:880px;"><a class="btn btn-default btn-lg btn-block" href="#" style="width:130px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                        
                                        
                                         <form method="post" action="">
						 <?PHP
                        
                        $cl= new Client('','','','','','',0,0,'','','','',0,0);
						$cl->consulterclient($id_hotel)					
                        ?>
                           
                       
                         <!-- <div style="float:right; margin-right:0px; margin-top:-15px;">
                          	<a href="#"><img src="../img/suprim.png" title="Supprimer"></a>
                          </div>-->
                            </form>
                                              </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<?php include('gl_footer.php'); ?>
    
