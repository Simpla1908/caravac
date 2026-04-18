<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
       
        <div id="page-wrapper" style="height:1500px;">
        				<br>
            			<h1><b><center><?php echo strtoupper($_SESSION['nom_hotel']); ?></center></b></h1>
                                <div class="col-lg-12">
                                <h1 class="page-header">Réservation des Chambres</h1>
                                    <div class="panel panel-default">
                                    	<!--Menu tabulation-->
                                            	<!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                	<li class="dropdown active"> <a  href="rec_reservation_chambre.php"> Réservations générales <b class="caret"></b></a></li>
                                                    <li class="dropdown"> <a  href="rec_reservation_chambre_encours.php"> Réservations en cours <b class="caret"></b></a></li>
                                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Réservations périodique <b class="caret"></b></a>
                                                    	<ul class="dropdown-menu">
                                                            <li style="padding:10px;">
                                                            	<form action="rec_reservation_chambre_periodique.php" method="post" name="periode">
                                                                <fieldset>
                                                                	<table width="300" border="0">
                                                                	<tr>
                                                                    <td width="120"> <label for="date">Date de debut&nbsp;:</label></td>
                                                                     <td width="5"></td>
                                                                    <td><input id="date"  type="date" class="form-control"  name="date_d" required >
                                                                    </td>
                                                                    </tr>
                                                                   <tr>
                                                                    <tr height="15">
                                                                    <td></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td> <label for="date">Date de fin&nbsp;:</label></td>
                                                                     <td width="5"></td>
                                                                    <td>
                                                                         <input id="date"  type="date" class="form-control"  name="date_f" required >
                                                                    </td>
                                                                  </tr>
                                                                  <tr height="15">
                                                                    <td></td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>&nbsp;</td>
                                                                      <td width="5"></td>
                                                                      <td align="right"> <button  name="sauvegarder" type="submit" class="btn btn-primary">Valider</button></td>
                                                                  </tr>
                                                                </table>
                                                                 </fieldset>
                                                                 </form>
                                                              </li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown"> <a  href="rec_reservation_chambre _historique.php">Réservations historique <b class="caret"></b></a></li>
                                                </ul>
                                            <!--/Menu tabulation-->
                                        <div class="panel-heading">
                                            <h4>Situation réservation chambres</h4>
                                            <div style="margin-top:-40px; margin-left:720px;"><a class="btn btn-default btn-lg btn-block" href="rec_ajout_reservation.php" style="width:130px;"><img src="../img/reservation.png">&nbsp;Réserver</a></div>
                                            <div style="margin-top:-46px; margin-left:860px;"><a class="btn btn-default btn-lg btn-block" href="#" style="width:120px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                            <?php 
												$res= new Reservation('','','','','','',0,0,0,0);
												$res->situationreservation($id_hotel);
											?>
                                        
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
	<?php include('rec_footer.php'); ?>
    
