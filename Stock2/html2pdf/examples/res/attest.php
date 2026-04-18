<!DOCTYPE html>
<html>
<head>
		<title>Ucc :: Users</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../attestation/css/style.css">
		<link rel="stylesheet" href="../attestation/css/style_home.css">
		<link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
		<style>
		#div_etat{
	        width:700px;
	        margin:auto;
	        height:auto;
	        _border:1px solid #d7d7d7;
	        _background:url('../images/hm.png') no-repeat;
	        background-color:#fff;
	       font-family:Arial;
		   z-index:5;
         }
         #etat_tete{
	     height:120px;
	    border-bottom:1px dashed black;
	  _background-image:url('../images/tetes.png');

	    }
		#div_res{
	  _font-family:Tahoma;
	font-size:15px;
	width:700px;
	height:820px;
	margin:20px auto;
	_margin-top:110px;
	/*border:1px solid red;*/
	text-align:justify;
	_line-height:28px;
	z-index:5;
}
	 #pied
     {
      border-top:1px solid #000;
      text-align:center;  
      font-weight:bold;	  
      }
	 #avant_pied
   {
    _border:1px solid #000;
    _float:right;
	width:300px;
   margin-top:12px;
   margin-left:330px;
  }
  #corps_text
  {
   font-size:20px;
   width:650px;
   margin:auto;
   margin-top:50px;
   text-align:justify;
   text-indent:70px;
   line-height:30pt;
   _letter-spacing:1pt;
 }
   
   </style>
</head>
<body>
<?php
      $connect=mysql_connect('localhost','root','');
	$bdd=mysql_select_db('bdd_ucc',$connect);
	$query=mysql_query('SET NAMES utf8');
	$anne=20;
    $date=$anne.date('y');
	$requete=mysql_query("SELECT*FROM etudiant WHERE matrie='{$_GET['matrie']}'  ");
	$data=mysql_fetch_array($requete);
	
	$req=mysql_query("SELECT*FROM v_cote WHERE matrie='{$_GET['matrie']}' AND libcla='{$_GET['libcla']}' order by codsem asc");
	$datas=mysql_fetch_array($req);
	
	$donne_opt=mysql_query("SELECT*FROM faculte_classe WHERE codfac='{$datas['codfac']}'  ");
	$opt=mysql_fetch_array($donne_opt);
	
	 $codclasse=$datas['codcla'];
	 $pond=20;
	 $som= mysql_query("SELECT SUM(cote) as total FROM v_cote WHERE matrie='{$_GET['matrie']}' AND libcla='{$_GET['libcla']}' ");
	 $da=mysql_fetch_array($som);
	 $sql=mysql_query("SELECT COUNT(id) FROM v_cote WHERE  matrie='{$_GET['matrie']}' AND codcla='$codclasse'");
	 $nbr_cours=mysql_result($sql,0);
	 $da['total']; $tot=$pond * $nbr_cours;
				 
?>
<div id="div_etat">
	<div id="etat_tete">
		<img src="../../images/tetes.png" alt="" width="700">
	</div>
	 
	<div id="div_res">
	      <p style="font-size:30px;font-weight:bold; text-align:center; text-decoration:underline;">
		  ATTESTATION DE REUSSITE
		  <?php
		    $dat= date('y'); 
			$i=1;
			$da_act= date('Y/m/d ');
			$extration_num=mysql_query("SELECT*FROM attestation WHERE   num= (Select Max(num) FROM attestation)   ");
	        while($donne_moi_num=mysql_fetch_array($extration_num))
			{
			  $num=$donne_moi_num['num'];
			  $num_gen =" Nº ".$num."/".  ($dat-1)."-". $dat; 
			  //Select * FROM maTable WHERE date = (Select Max(Date) FROM maTable WHERE date< XXXXX)
			  $num_attest=mysql_query("SELECT COUNT(id) FROM attestation WHERE  num='$num' ");
	          $return_result=mysql_result($num_attest,0);
			  if($return_result==0)
			  {
			     echo"herve y en a pas";
                
			  }else{
			     $num=$donne_moi_num['num'];
				  $num++;
				 $num_gen =" Nº ".$num."/".  ($dat-1)."-". $dat;
			    
		       echo  $num_gen;
			   mysql_query("INSERT INTO attestation(num_attes_reussite ,matrie,date_recup,num)
			                      VALUES('$num_gen','{$_GET['matrie']}','$da_act','$num')
								  ");
			   }
			
			}
		   
		  ?>
		  
		  
		  </p>
		<p id="corps_text">
		
		 Le soussigné, <label style="font-weight:bold;"> Professeur Abbé Michel-Willy LIBAMBU</label>, Secrétaire Général Académique de l'Université Catholique du congo, atteste par 
         la présente que <?php if($data['sexe']=='Masculin'){echo"  le nommé";}else{ echo"la nommée";}?> <label style="font-weight:bold;"> <?php  echo $data['nome'];?></label> , née à  <?php  echo $data['lieunais'];?>, le <?php  echo $data['datnais'];?> a réussi avec la mention  
		 <?php $pourcent=($da['total']/$tot) *100;
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
		 }  ?> ( <?php echo $pourcent= number_format($pourcent,2);?>  %)  à la session de
		 <?php 
		     $cote=mysql_query("SELECT datcot FROM v_cote WHERE datcot= (Select Max(datcot) FROM v_cote )  AND matrie='{$_GET['matrie']}' AND libcla='{$_GET['libcla']}' order by codsem asc");
	         $cotes=mysql_fetch_array($cote);
			
			    $date_cote=$cotes['datcot'];
				$mois=explode("-",$date_cote);
				//echo $mois[1];
				if($date_cote==true)
				{
				
				if($mois[1]=="02" or $mois[1]=="01" or $mois[1]=="03")
				{
				   echo"février";
				}elseif($mois[1]=="06" or $mois[1]=="07" or $mois[1]=="08"){
				
				echo"Juillet";
				}elseif($mois[1]=="09" or $mois[1]=="10" or $mois[1]=="11" or $mois[1]=="12")
				{
				   echo"octobre";
				  
				}else{
				  echo"Nul";
				  echo $mois[1];
				}
			   }else{
			     $cote2=mysql_query("SELECT datcot FROM v_cote WHERE datcot= (Select Min(datcot) FROM v_cote )  AND matrie='{$_GET['matrie']}' AND libcla='{$_GET['libcla']}' order by codsem asc");
	             $cotes2=mysql_fetch_array($cote2);
				  $date_cote2=$cotes2['datcot'];
				  $mois2=explode("-",$date_cote2);
				 
						 
						if($mois2[1]=="02" or $mois2[1]=="01" or $mois2[1]=="03")
						{
						   echo"février";
						}elseif($mois2[1]=="06" or $mois2[1]=="07" or $mois2[1]=="08"){
						
						echo"Juillet";
						}elseif($mois2[1]=="09" or $mois2[1]=="10" or $mois2[1]=="11" or $mois2[1]=="12")
						{
						   echo"octobre";
						  
						}else{
						  echo"Nul";
						  
						}
			   
			   }
			
		 ?> 
		 les examens  constituant l'épreuve en vue de l'obtention du grade de
		 <?php
		         $cla  = $datas['libcla'];
				 $classe = explode(" ", $cla);
                 if($classe[0]=="DEUXIEME" AND $classe[1]=="LICENCE"){
						 echo"licencié en";
				  }elseif($classe[0]=="TROISIEME" AND $classe[1]=="GRADUAT"){
					  echo"gradué en ";
				  }
		   ?>  <?php echo $datas['libfac']; ?>, option:
		 <?php 
		 if($opt['codopt']!=''){
	        $option=mysql_query("SELECT*FROM option WHERE codopt='{$opt['codopt']}'  ");
	       $op=mysql_fetch_array($option);
		    ?>
		   
		   <?php 
		    echo'<label style="font-weight:bold;">'.$op['libopt'].'</label>';
	    }
		
		
	      
		 ?>
		    
		    <p>En foi de quoi, la présente attestation lui est délivrée pour servir et faire valoir ce que de droit.</p>
		  </p>
		            <div id="avant_pied">
                       
                      <div id="text_bas">
                             <div id="text_flot">
							  <p style="padding:15px;">
		              <?php 
		                        $jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
                                $mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
                                $datefr = date("d")." ".$mois[date("n")]." ".date("Y");
                                echo"Fait à kinshasa le ".  $datefr; 
                     ?>
					
                            </p>
                                 <p style="font-weight:bold; padding:15px;">Prof. Abbé Michel-Willy LIBAMBU</p>
                                 <p style="font-weight:bold; padding:15px;">Secrétaire Général Académique</p>
                             </div>
                      </div>

                </div>		
			   
	</div>
	<div id="pied">
	   <table  align="center">
	         <tr>
			     <td>Avenue de l'Université n<span style="margin-top:-6px; font-size:9px;">o</span>2 B.P.  1534 Kinshasa - Limete</td>
			 
			 </tr>
			 <tr>
			     <td>       Tél : +243 99 930 62 26 -  +243 81 54 03 627</td>
			 
			 </tr>
			 <tr>
			     <td>      Courriel : sgac.dirsac@ucc.ac.cd / sgac@ucc.ac.cd</td>
			 
			 </tr>
			 <tr>
			     <td>                    Site web : www.ucc.ac.cd</td>
			 
			 </tr>
	    </table>
	</div>
	
</div>
</body>
</html>