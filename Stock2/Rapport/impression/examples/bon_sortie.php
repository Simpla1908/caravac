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
 margin-left:470px;
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
					<td colspan="4" style="text-align:center;font-weight:bold;">Bon de sortie n°  </td>
					 
				</tr>
				<tr>
				     <td>Bénéficiaire :</td>
					 <td colspan="3" style="border-bottom:1px solid #000;"></td>
					 
				</tr>
				<tr>
					<td style="width:120px;">A reçu la somme de: </td>
					<td  style="border-bottom:1px solid #000; width:260px;"></td>
					<td style="width:100px;"> </td>
					<td style="border-bottom:1px solid #000; width:100px;"></td>
				</tr>
				<tr>
					<td>Motif:</td>
					 <td style="border-bottom:1px solid #000;" colspan="3"></td>
				</tr>
				<tr>
					 
					 <td colspan="4"><label id="label">Fait à Kinshasa, le  </label></td>
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
    // get the HTML
 ob_start();
 
 
    

    // convert
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('bonkabe.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>