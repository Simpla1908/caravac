<?php 
	
	// Inclusion du fichier contenant la connexion à la base
	require '../bdd/connexion.php';
	include('Receptionniste.php');
	include('headerRec.php'); 
	include('menu_Rec.php'); 
	if( isset($_GET['num_fact']) && ($_GET['nom_client']) && ($_GET['type']) ){
		$num_fact = $_GET['num_fact'];
		$nom_client = $_GET['nom_client'];
		$type = $_GET['type'];
		$page='paiement';
	}else{
		header("Location:rec_situation_paiement.php");
	}
?>
        <div id="page-wrapper" style="height:1500px;">
        				<br>
                                <div class="col-lg-12">
                                <h3 class="page-header">Detail de la facture N° <span style="color:#4949fa; font-weight:bold;"><?php echo $num_fact; ?></span> de <span style="color:#4949fa; font-weight:bold;"><?php echo strtoupper($nom_client); ?></span></h3>
                                    <div class="panel panel-default">
                                    	
                                        <div class="panel-heading">
                                            <h4>Motif: <span style="color:#4949fa; font-weight:bold;"><?php if($type=='reservation'){ echo 'Réservation';}else{ echo 'Occupation';} ?></span></h4>
                                            <div style="margin-top:-30px; margin-left:945px;">
                                         	<a href="rec_situation_paiement.php" title="Voir la liste des paiements">
                                                <i class="fa fa-tasks fa-2x"></i>
                                            </a>
                                         </div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <?php include('rec_detail_paiement _client_donnee.php'); ?>
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
	<?php include('rec_footer.php'); ?>
    
