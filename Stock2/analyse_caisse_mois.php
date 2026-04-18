<!DOCTYPE html>
<html lang="fr">

    <?php include('head.php'); ?>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logoKB1.png"/></a>
                </div>
                <!-- /.navbar-header -->

                <?php include('navigation.php'); ?> 
                <?php include('menu.php'); ?>

            </nav>
            <!-- /.navbar-top-links --> 

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">Analyse de la caisse</h2>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" >
                        <?php
							if (isset($_POST['valider'])) {
								
								$annee= $_POST['annee'];	
								 
							}else{
								$annee=date('Y');
							}
							
											 ?>
							<div class="panel-heading">
								Analyse du mois de(d') <strong><?php echo $annee; ?></strong>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="table-responsive" >
									<table class="table table-striped table-bordered table-hover" id="dataTables-examplefx">
										<thead>
											<tr>
												<th></th>
												<th>ENTREE</th>
												<th>SORTIE</th>
												<th>SOLDE</th>
											</tr>
										</thead>
										<tbody>
											<tr class="odd gradeX">
												<th>SOLDE TOTAL</th>
												<td><strong>150800$ / 600000Fc</strong></td>
												<td><strong>150800$ / 600000Fc</strong></td>
												<td class="center"><strong>150800$ / 600000Fc</strong></td>
											</tr>
										 </tbody>
								   </table>
								</div>
								<!-- /.table-responsive -->
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
		
        
        
        <?php include('footer.php'); ?>

    </body>

</html>
