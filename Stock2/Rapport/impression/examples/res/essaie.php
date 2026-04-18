<style type="text/css">
    #div_etat{
	width:700px;
	margin:auto;
	height:auto;
	border:1px solid #d7d7d7;
	//background:url('../images/hm.png') no-repeat;
	background-color:#fff;
	
      }
	  #sous_tete{
	/*border:1px solid red;*/
	width:650px;
	line-height:25px;
	margin:50px auto;
	text-align:center;
	_font-family:Tahoma;
	font-size:14px;
	letter-spacing:.1em;
	padding:10px;
   }
   #div_res{
	//font-family:Tahoma;
	font-size:15px;
	width:800px;
	margin:20px auto;
	/*border:1px solid red;*/
	text-align:justify;
	line-height:28px;
}
#pied
{
border-top:1px solid #000;
text-align:center;
}

</style>


<?php
	$connect=mysql_connect('localhost','root','');
	$bdd=mysql_select_db('bdd_ucc',$connect);
	$query=mysql_query('SET NAMES utf8');
?>
<?php
   $anne=20;
   $date=$anne.date('y');
	$requete=mysql_query("SELECT*FROM v_cote WHERE matrie='{$_GET['matrie']}' AND anfin='$date' order by codsem asc");
	$data=mysql_fetch_array($requete);
	$codclasse=$data['codcla'];
?>
<div id="div_etat" >
	<div id="etat_tete">
		
	</div>
	<div id="sous_tete">
		Relevé des cotes d'examens présentés par la nommée <b><?php echo $data['nome']; ?></b><br>
		<?php echo $data['libcla'].' ('.$data['libfac'].')'; ?><br>
		ANNEE ACADEMIQUE <?php echo $data['andeb'].'-'.$data['anfin']; ?>
	</div>
	<div id="div_res">
		<table>
			<?php
				$i=0;
				$requetes=mysql_query("SELECT*FROM v_cote WHERE matrie='{$_GET['matrie']}' AND anfin='$date' AND codcla='$codclasse' AND cote!='' AND codsem='SEM1'");
				while($datas=mysql_fetch_array($requetes)){
					?>
						<tr>
							<td><?php echo $i+1; ?>.<?php echo $datas['libcou']; ?></td>
							<td>..................................................................................................<?php echo $datas['cote']; ?></td>
						</tr>
					<?php
					   
						$i++;
				}
				$requete=mysql_query("SELECT * FROM v_cote WHERE matrie='{$_GET['matrie']}' AND anfin='$date' AND codcla='$codclasse' AND cote='' AND codsem='SEM1'");
				while($dat=mysql_fetch_array($requete) )
				{
				?>    
						<tr>
							<td><?php echo $i+1; ?>.<?php echo $dat['libcou']; ?> </td>
							<td>...................................................................................................<?php echo $trait='-'; ?></td>
						</tr>
					<?php
					$i++;
				}
//============================================================SEMESTRE 2 ===============================================================

                $requetes=mysql_query("SELECT*FROM v_cote WHERE matrie='{$_GET['matrie']}' AND anfin='$date' AND codcla='$codclasse' AND cote!='' AND codsem='SEM2'");
				while($datas=mysql_fetch_array($requetes)){
					?>
						<tr>
							<td><?php echo $i+1; ?>.<?php echo $datas['libcou']; ?></td>
							<td>....................................................................................................<?php echo $datas['cote']; ?></td>
						</tr>
					<?php
					   
						$i++;
				}
				$requete=mysql_query("SELECT * FROM v_cote WHERE matrie='{$_GET['matrie']}' AND anfin='$date' AND codcla='$codclasse' AND cote='' AND codsem='SEM2'");
				while($dat=mysql_fetch_array($requete) )
				{
				?>    
						<tr>
							<td><?php echo $i+1; ?>.<?php echo $dat['libcou']; ?> </td>
							<td>....................................................................................................<?php echo $trait='-'; ?></td>
						</tr>
					<?php
					$i++;
				}
                $pond=20;
				$som= mysql_query("SELECT SUM(cote) as total FROM v_cote WHERE matrie='{$_GET['matrie']}' ");
				$da=mysql_fetch_array($som);
				?>
				<tr>
							<td></td>
							<td></td>
				</tr>
				<tr>
							<td></td>
							<td></td>
				</tr>
				<tr>
							<td></td>
							<td></td>
				</tr>
				<tr>
							<td></td>
							<td></td>
				</tr>
				<tr>
							<td></td>
							<td></td>
				</tr>
				<tr>
							<td></td>
							<td></td>
				</tr>
				    <tr>
					   <td>Total  : </td>
				<?php
				$sql=mysql_query("SELECT COUNT(id) FROM prof_cou_cla WHERE codcla='$codclasse'");
				$nbr_cours=mysql_result($sql,0);
				echo"<td>". $da['total']."/". $tot=$pond * $nbr_cours."</td>";
				echo"</tr>";
				?>
				<tr>
							<td>Pourcentage :</td>
							<td><?php echo round($pourcent=($da['total']/$tot) *100);?></td>
				</tr>
				<tr>
							<td>Mention :</td>
							<td>
							   <?php
							   $rech=mysql_query("SELECT COUNT(id) FROM v_cote WHERE matrie='{$_GET['matrie']}' AND cote='' ");
							   $rows=mysql_result($rech,0);
							   if($rows==0)
							   {              
							              $rech2=mysql_query("SELECT COUNT(id) FROM v_cote WHERE matrie='{$_GET['matrie']}' AND cote <9 ");
									      $row=mysql_result($rech2,0);
										  if($row==1)
										   {
										        if($i < $nbr_cours)
											  {
												  
											  }else{
											   
															 if($pourcent >=55 AND $pourcent < 60)
															 {
															   echo"Satisfaction";
															 
															 }elseif($pourcent >=60 AND $pourcent <69 )
															 {
															 
															   echo"Satisfaction";
															 }elseif($pourcent >=70 AND $pourcent < 80)
															 {
																 echo"Distinction";
															 }elseif($pourcent>=80 AND $pourcent <90)
															 {
															   echo"Grande distinction";
															 }elseif($pourcent >=90 AND $pourcent<100)
															 {
															   echo"La plus grande distinction";
															 }else{
															   echo"Ajourné";
														  }
														  
											          }
													  
										   }elseif($row==2)
										   {
                                                  if($i < $nbr_cours)
												  {
													  
												  }else{
												  
													 if($pourcent >=60 AND $pourcent < 70)
													 {
													   echo"Satisfaction";
													 
													 }elseif($pourcent >=70 AND $pourcent <80 )
												    {
												 
												          echo"Distinction";
												     }elseif($pourcent >=80 AND $pourcent < 90)
												    {
												         echo"Grande distinction";
												     }elseif($pourcent>=90 AND $pourcent <100)
												     {
												         echo"La plus grande distinction";
												    
												   }else{
												   
												     echo"Ajourné";
											       }
											 }
											   
										   }elseif($row==0)
										   {
										       if($i < $nbr_cours)
												  {
													  
												  }else{
												  
													  if($i < $nbr_cours)
													  {
														  
													  }else{
													  
														 if($pourcent >=50 AND $pourcent < 70)
														 {
														   echo"Satisfaction";
														   
														 }else if ($pourcent >= 70 AND  $pourcent < 80)
														 {
															
														   echo"Distinction";
														   
														 }else if($pourcent < 40)
														 {
														 
															echo"Non admissible à la filière";
														 
														 }else if($pourcent >= 80 AND  $pourcent < 90)
														 {
															 echo"Grande distinction";
														 
														 }else if($pourcent >= 90 AND $pourcent< 100 )
														 {
															echo"La plus  grande distinction";
														 
														 }else if($pourcent ==40 and $pourcent <=49)
														 {
														 
															 echo"Ajourné";
														 }else{
														 
															  echo"Assimilé aux ajournés";
														 
														 }
														 
													   }
														  }
												   
										   }else{
										   echo"Ajourné";
										   
										   
										   }
									
							   }else{
							   
							   echo"Assimilé aux ajournés";
							   
							   }
					?>
							
							
							</td>
				</tr>
				<tr>
				    <td>
					   <?php 
					       
					   ?>
					
					</td>
				
				</tr>
				<?php
			?>
		</table>
	</div>
	<div id="pied">
	   <table  align="center">
	         <tr>
			     <td>Avenue de l'Université n○2 B.P.  1534 Kinshasa - Limete</td>
			 
			 </tr>
			 <tr>
			     <td>       Tél : +243 99 930 62 26 -  +243 81 54 03 627</td>
			 
			 </tr>
			 <tr>
			     <td>      Courriel : michel_libambu@yahoo.fr , sgac@ucc.ac.cd</td>
			 
			 </tr>
			 <tr>
			     <td>                    Site web : www.ucc.ac.cd</td>
			 
			 </tr>
	    </table>
	</div>
	
</div>