			<?php include('Receptionniste.php');?>
            <?php include('headerRec.php'); ?>
			<?php include('menu_Rec.php'); ?>
            <?php include('../FUNCTION/reference.php'); ?>
             <?php 
		
			if(isset($_POST['search'])){
			$date_fx=$_POST['date_fx']; 
			}
			 ?>
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
                            <h4>Le(s) réservation(s) du&nbsp;&nbsp;:&nbsp;&nbsp; <?php echo $date_fx;?></h4>
                            <div style="margin-top:-40px; margin-left:720px;"><a class="btn btn-default btn-lg btn-block" href="rec_ajout_reservation.php" style="width:130px;"><img src="../img/reservation.png">&nbsp;Réserver</a></div>
                            <div style="margin-top:-46px; margin-left:860px;"><a class="btn btn-default btn-lg btn-block" href="#" style="width:120px;"><img src="../img/print.png">&nbsp;Imprimer</a></div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           
						 <?PHP
                        include '../bdd/connexion_mysql.php';
echo '

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                                            <th>Noms du Client</th>
                                                            <th>Chambre Rés.</th>
                                                            <th>Date reserv</th>
                                                            <th>Date occup</th>
															<th>Date lib</th>
                                                            <th>Jrs restants</th>
                                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
									
//requette_
 $compt=0;
 $tot=0;
$result=mysql_query("SELECT r.id_res,z.nom_client,c.num_ch,r.date_res,r.date_occ,r.date_lib,DATEDIFF(r.date_occ,CURDATE()) as jrs,r.statut_res FROM t_reservation r,t_chambre c,t_client z WHERE r.id_client=z.id_client AND r.id_ch=c.id_ch AND c.id_hotel='$id_hotel' AND DATEDIFF(r.date_occ,CURDATE())>'0' AND r.date_res='$date_fx' ORDER BY r.date_res DESC") or die(mysql_error());
while($rows=mysql_fetch_assoc($result)){

$compt++;	
if($rows['date_res']==date('Y-m-d')){
echo'             
                           <tr>
                                            <td>'.$compt.'</td>
                                            <td>'.$rows['nom_client'].'</td>
                                            <td>'.$rows['num_ch'].'</td>
                                            <td class="center">'.$rows['date_res'].'</td>
											<td class="center">'.$rows['date_occ'].'</td>
											<td class="center">'.$rows['date_lib'].'</td>
											<td class="center">'.$rows['jrs'].'</td>
											<td class="center">'.$rows['statut_res'].'</td>
										 </tr>';}
                                       
else{
	echo'             
                           <tr>
                                            <td>'.$compt.'</td>
                                            <td>'.$rows['nom_client'].'</td>
                                            <td>'.$rows['num_ch'].'</td>
                                            <td class="center">'.$rows['date_res'].'</td>
											<td class="center">'.$rows['date_occ'].'</td>
											<td class="center">'.$rows['date_lib'].'</td>
											<td class="center">'.$rows['jrs'].'</td>
											<td class="center">'.$rows['statut_res'].'</td>
                                        </tr>';
	
	
	}}									   
									   
				   
									   
									   
                                        
  echo'                                  </tbody>
                                </table> </div>
								 
								';
						
						 ?>
                           
                       
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>  <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

 <?php include('rec_footer.php'); ?>
