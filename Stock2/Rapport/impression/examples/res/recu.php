<?php
 
	$connect=mysql_connect('localhost','root','');
	$bdd=mysql_select_db('bdd_hotel',$connect);
	$query=mysql_query('SET NAMES utf8');
 $num_res=$_GET['num_res'];
 $req=mysql_query("SELECT * FROM v_contrat WHERE num_contrat='$num_res' ");
 $result=mysql_fetch_array($req);
 $psd =$result['id_cont'];//dernier code dans la BDD
 $init= str_pad($psd,4, "0", STR_PAD_LEFT);//00001
 $ident_cli=mysql_query("SELECT * FROM client WHERE  id_client='{$result['id_client']}'");
 $client=mysql_fetch_array($ident_cli);
?>
<style>
#tab_title
{
width:850px;

}
#label
{
 position:absolute;
 z-index:1;
 margin-top:70px;
 margin-left:-210px;
 font-weight:bold;
}
</style>
<page format="100x200" orientation="L" backcolor="#fff" style="font: arial;">
<table id="tab_title" border="0" align="center" >
				<tr>
					<td colspan="2"><img src="res/logo.png" alt  height="100"  width="850"><label id="label">Kinshasa, le  <?php echo $date= date('d/m/Y'); ?></label> </td>
					 
				</tr>
				 <tr>
					<td colspan="2" style="text-align:center;font-weight:bold;">Reçu n° <?php  echo $init;?></td>
					 
				</tr>
				<tr style="height:100px;font-weight:bold;">
					<td><label  style="margin-left:200px;">MOTIF : Réservation chambre  n°<?php  echo $result['id_chambre']; ?></label></td>
					<td><label  style="margin-left:-130px;">Net à payer: <?php  echo $result['mont_paye']; if($result['id_monnaie']=="FC"){ echo" FC";}else{ echo" $";}?></label></td>
				</tr>
				<tr>
					<td  colspan="2" style="text-align:right;font-weight:bold; margin-right:30px;">Percepteur:......Herve muyanika</td>
					 
				</tr>
				<tr>
					<td  colspan="2" style="text-align:center; border-top:1px solid #000;"> Siege social : 15, avenue Odia David, quartier O.U.A., commune de la Muya, ville de Mbujimayi<br>République Démocratique du Congo </td>
					 
				</tr>
</table>
</page>