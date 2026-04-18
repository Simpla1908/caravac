<?php

$connect=mysql_connect('localhost','root','');
$bdd=mysql_select_db('bdd_hotel',$connect);
$query=mysql_query('SET NAMES utf8');

 $id=$_GET['id'];
 $fac=$_GET['fac'];
 $num_fac=$_GET['id_fac'];
 $mois=$_GET['mois'];
 $req=mysql_query("SELECT * FROM log_charge WHERE id_indivudi='$id' AND mois='$mois' AND libfac='$fac' ");
 $result=mysql_fetch_array($req);
 $somme=$result['mont_paie'];//+$result['paie_snel']+$result['paie_regi'];
 $cli=mysql_query("SELECT * FROM log_indivudi WHERE id='$id' ");
 $res_cli=mysql_fetch_array($cli);
 $date_actuelle= date('Y-m-d');
 $caisse=mysql_query("SELECT * FROM log_caisse WHERE id_client	='$id' AND datmv='$date_actuelle' ");
 $res_caisse=mysql_fetch_array($caisse);
 $psd = $num_fac;//dernier code dans la BDD
 $init= str_pad($psd,4, "0", STR_PAD_LEFT);//00001 
 $var_num_fac=$init."/ ".$res_cli['immeuble'];
 
 $Q=mysql_query("SELECT COUNT(*) FROM log_id_fac_immobilier WHERE id_fac='$num_fac'  ")or die(mysql_error());
 $Qe=mysql_result($Q,0);
 if($Qe!=0)
 {
   mysql_query("UPDATE log_id_fac_immobilier SET facture='$var_num_fac' WHERE id_fac='$num_fac'")or die(mysql_error());
 }
 
  include('ChiffresEnLettres.php');
 $lettre=new ChiffreEnLettre(); 
 $chiffre=$somme;
 
?>
<style>
#tab_title
{
width:700px;
 font-weight:bold;
 _font-family:Segoe UI Light;
}
#label
{
 _position:absolute;
 _z-index:1;
 margin-top:20px;
 margin-left:530px;
 font-weight:bold;
}
#content
{
   border:1px solid #000;
   height:330px;
   width:720px;
   margin:auto;
   margin-top:20px;

}
</style>
<page format="100x200" orientation="L" backcolor="#fff" style="font: arial;">
<div id="content">
       <table id="tab_title" border="0" align="center" >
                 <tr>
					<td colspan="4"><img src="./res/logo1.png" alt  height="100"  width="700"> </td>
				</tr>
       	        <tr>
					<td colspan="4" style="text-align:center;font-weight:bold;">Reçu n°  <?php  echo $var_num_fac;?></td>
					 
				</tr>
				<tr>
				     <td>Reçu de :</td>
					 <td colspan="3" style="border-bottom:1px solid #000;"><?php echo $res_cli['nom']." ".$res_cli['prenom']; ?></td>
					 
				</tr>
				<tr>
					<td style="width:120px;">La somme de: </td>
					<td  style="border-bottom:1px solid #000; width:300px;"><?php echo $lettre->Conversion($chiffre); ?></td>
					<td style="width:100px;">Dollars</td>
					<td style="border-bottom:1px solid #000; width:100px;">( <?php echo $somme;?> $)</td>
				</tr>
				<tr>
					<td>Motif:</td>
					 <td style="border-bottom:1px solid #000;" colspan="3"><?php echo $_GET['motif'];	?></td>
				</tr>
				<tr>
					 
					 <td colspan="4"><label id="label">Fait à Kinshasa, le  <?php echo $date=date('d/m/Y'); ?></label></td>
				</tr>
				 <tr>
					 
					 <td colspan="4"><span style="margin-left:200px;"> Bénéficiaire</span> <span style="margin-left:250px;"> Caissier(e)</span></td>
					 
				</tr>
				<tr>
					 
					 <td colspan="4" style="height:40px;"></td>
					 
				</tr>
				<tr style="margin-top:200px;">
					<td  colspan="4" style="text-align:center; _border-top:1px solid #000;font-size:12px;margin-top:200px;"> Siege social : 15, avenue Odia David, quartier O.U.A., commune de la Muya, ville de Mbujimayi<br>République Démocratique du Congo </td>
					 
				</tr>
       </table>
</div>
</page>