<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
    // get the HTML                                              Mot de passe BDD:  Nondecrypt@ble86
    ob_start();
 $connect=mysql_connect('localhost','root','');
$bdd=mysql_select_db('bdd_hotel',$connect);
 $query=mysql_query('SET NAMES utf8');
 $num_res=$_GET['num_res'];
 $num_fac=$_GET['id_fac'];
 $req=mysql_query("SELECT * FROM v_contrat WHERE num_contrat='$num_res' ");
 $result=mysql_fetch_array($req);
  $id_chambre=$result['id_chambre'];
 $psd =$num_fac;//dernier code dans la BDD
 $init= str_pad($psd,4, "0", STR_PAD_LEFT);//00001
 $ident_cli=mysql_query("SELECT * FROM client WHERE  id_client='{$result['id_client']}'");
 
 $var_num_fac="HK/".$init;
 $Q=mysql_query("SELECT COUNT(*) FROM log_id_fac_hotel WHERE id_fac='$num_fac'  ")or die(mysql_error());
 $Qe=mysql_result($Q,0);
 if($Qe!=0)
 {
   mysql_query("UPDATE log_id_fac_hotel SET facture='$var_num_fac' WHERE id_fac='$num_fac'")or die(mysql_error());
 }
 
 $client=mysql_fetch_array($ident_cli);
 include('../../ChiffresEnLettres.php'); 
$lettre=new ChiffreEnLettre();
if($result['id_monnaie']=="FC")
{
 $t=mysql_query("SELECT * FROM monnaie WHERE id_monnaie='FC' ");
 $rs=mysql_fetch_array($t);
 $mont_p=$result['mont_paye']*$rs['taux'];
 $chiffre=$mont_p;
}else{
$chiffre=$result['mont_paye'];
} 

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
<page format="105x200" orientation="L" backcolor="#fff" style="font: arial;">
  <div id="content">
       <table id="tab_title" border="0" align="center">
                 <tr>
					<td colspan="4"><img src="./res/logo1.jpg" alt  height="100"  width="700"> </td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:right;font-weight:bold;">Chambre n°  <?php  echo $id_chambre;?></td>
					 
				</tr>
       	        <tr>
					<td colspan="4" style="text-align:center;font-weight:bold;">Reçu n°  <?php  echo $var_num_fac;?></td>
					 
				</tr>
				<tr>
				     <td>Reçu de :</td>
					 <td colspan="3" style="border-bottom:1px solid #000;"><?php echo $result['nom_cli'];?></td>
					 
				</tr>
				<tr>
					<td style="width:120px;">La somme de: </td>
					<td  style="border-bottom:1px solid #000; width:300px;"><?php echo $lettre->Conversion($chiffre); ?></td>
					<td style="width:100px;"><?php  if($result['id_monnaie']=="FC"){ echo" Fancs Congolais";}else{ echo" Dollars";}?></td>
					<td style="border-bottom:1px solid #000; width:100px;">( <?php   if($result['id_monnaie']=="FC"){ echo $mont_p." FC";}else{ echo $result['mont_paye']." $ ";}?>)</td>
				</tr>
				<tr>
					  <td>Motif:</td>
					 <td style="border-bottom:1px solid #000;" colspan="3"><?php if($_GET['op']=="occup"){echo"Occupation chambre";}else{echo"Réservation chambre";}?></td>
				</tr>
				<tr>
					  <td>Durée:</td>
					 <td style="border-bottom:1px solid #000;" colspan="3">
						<?php 
							$date_deb=explode('-',$result['date_debut']);
							$date_fin=explode('-',$result['date_fin']);
							
							echo 'Du '.$date_deb[2].'-'.$date_deb[1].'-'.$date_deb[0].' au '.$date_fin[2].'-'.$date_fin[1].'-'.$date_fin[0]; 
						?>
					 </td>
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
<?php
     $content = ob_get_clean();

    // convert
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('ticket.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

