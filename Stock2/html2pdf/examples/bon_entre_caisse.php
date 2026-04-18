
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
					<td colspan="4" style="text-align:right;font-weight:bold; margin-right:5px;">
                    <!--Chambre n°-->  
                    </td>
					 
				</tr>
       	        <tr>
					<td colspan="4" style="text-align:center;font-weight:bold;">Reçu n°  </td>
					 
				</tr>
				<tr>
				     <td>Nom client :</td>
					 <td colspan="3" style="border-bottom:1px solid #000;"><i></i></td>
					 
				</tr>
				<tr>
					<td style="width:120px;">Montant payer: </td>
					<td  style="border-bottom:1px solid #000; width:300px; ">
                    	<i></i>
                    </td>
					<td align="center" style="width:100px;"><i>Reste: </i></td>
					<td style="border-bottom:1px solid #000; width:100px; " >&nbsp;<i></i></td>
				</tr>
				<tr>
					  <td>Motif:</td>
					 <td style="border-bottom:1px solid #000; " colspan="3"><i>
					 	
                     </i></td>
				</tr>
				<tr>
					  <td>Durée:</td>
					 <td style="border-bottom:1px solid #000;" colspan="3">
                     	<i></i>
					 </td>
				</tr>
				<tr>
					 
					 <td height="31" colspan="4"><label id="label">Fait à Kinshasa, le <i> <?php echo $date=date('d/m/Y'); ?></i></label></td>
				</tr>
                <tr><td></td></tr>
				 <tr>
					 
					 <td colspan="4">
                     	<span style="margin-left:150px;"> Bénéficiaire</span> 
                        <span style="margin-left:250px;"> Caissier(e)</span>
                     </td>
				</tr>
				<tr>
					 
					 <td height="33" colspan="4" style="height:40px;"></td>
					 
				</tr>
				<tr style="margin-top:200px;">
					<td  colspan="4" style="text-align:center; font-size:12px;margin-top:200px;">
                    <i>
                     
                     </i>
                    </td>
					 
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
	

	
?>
