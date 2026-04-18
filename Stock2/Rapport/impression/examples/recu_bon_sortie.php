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
   /* ob_start();
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
} */

?>
<style>
#tab_title
{

 /*font-weight:bold;*/
 _font-family:Segoe UI Light;
}
#label
{
 _position:absolute;
 _z-index:1;
 margin-top:20px;
 margin-left:530px;
 /*font-weight:bold;*/
}
#content
{
   border:1px solid #000;
   height:330px;
   width:720px;
   margin:auto;
   margin-top:20px;

}
#chiffre
{
  position:relative; 
  top:-348px; 
  left:580px; 
  border:1px solid #000; 
  width:120px; 
  padding:2px; 
  font-weight:bold; 
  font-size:20px; 
  background-color:#CCC;

}
#nom
{
  position:relative; 
  top:75px; 
  left:145px; 
  border-bottom:1px solid #000; 
  width:538px; 
  padding:2px; 
  padding-left:20px;
  font-weight:bold; 
  font-size:16px; 
  /*background-color:#CCC;*/

}
#lettre
{
  position:relative; 
  top:17px; 
  left:115px; 
  border:1px solid #000; 
  width:577px; 
  padding:2px; 
  padding-left:10px;
  font-weight:bold; 
  font-size:18px; 
  background-color:#CCC;

}
#pour
{
  position:relative; 
  top:17px; 
  left:63px; 
  border-bottom:1px solid #000; 
  width:555px; 
  padding:2px; 
  padding-left:80px;
  font-weight:bold; 
  font-size:18px; 
  /*background-color:#CCC;*/

}
#date
{
  position:relative; 
  top:35px; 
  left:460px; 
  /*border:1px solid #000; */
  width:200px; 
  padding:2px; 

}
</style>
<page format="105x200" orientation="L" backcolor="#fff" style="font: arial;">
  <div id="content">
    <table id="tab_title" border="0" width="700" align="center">
		 <tr height="35">
					<td height="27" colspan="4" >
                    
                    </td>
				</tr>
                 <tr>
					<td height="73" colspan="4" valign="top" align="center"><u><h2><strong>BON DE SORTIE CAISSE N°&nbsp;</strong></h2></u></td>
		 </tr>
				<tr>
					<td colspan="4" style="text-align:right;font-weight:bold;">  </td>
					 
				</tr>
       	        <tr>
					<td colspan="4" style="text-align:center;font-weight:bold;"></td>
					 
				</tr>
				<tr>
				     <td width="142" height="21">Bénéficiaire :</td>
					 <td colspan="3"></td>
					 
				</tr>
                <tr>
					<td colspan="4" height="10">  </td>
					 
				</tr>
				<tr>
					<td height="21" style="width:120px;">Montant accordé: </td>
					<td width="171"  ></td>
					<td width="259" style="width:100px;"></td>
				<td width="110"></td>
				</tr>
                <tr>
					<td colspan="4" height="10">  </td>
					 
				</tr>
				<tr>
					  <td height="21">Motif de depense:</td>
					 <td colspan="3"></td>
				</tr>
				<tr>
					  <td height="14"></td>
					 <td colspan="3">
						
					 </td>
				</tr>
				<tr>
					 
					 <td colspan="4"></td>
				</tr>
                <tr>
					<td colspan="4" height="30">  </td>
					 
				</tr>
				 <tr>
					 
					 <td colspan="4">
                     <span style="margin-left:100px; font-weight:bold;"> Caissier (ère)</span> 
                     <span style="margin-left:280px; font-weight:bold;"> Bénéficiaire</span></td>
				</tr>
				<tr>
					 
					 <td height="14" colspan="4" style="height:40px;"></td>
					 
				</tr>
				 <tr>
					<td colspan="4" height="20">  </td>
					 
				</tr>
       </table>
</div>
<div id="chiffre" style="" align="center">1002 $</div>
<div id="nom" style="" align="left"><i>FALANKA KIMBEZ</i></div>
<div id="lettre" style="" align="center"><i>cents dollar</i></div>
<div id="pour" style="" align="left"><i>Transport agents</i></div>
<div id="date">
	Fait à Kinshasa, le  <?php echo $date=date('d/m/Y'); ?>
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

