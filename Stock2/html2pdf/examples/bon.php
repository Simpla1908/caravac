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
    
?>
<style>
#bas_page{
	font-weight:bold;
	margin-top:100px;
	width:400px;
	_border:1px solid red;
	margin:auto;
	text-align:right;
	font-size:15px;
}

#table
{
     margin:auto;
    margin-top:80px;
	_margin-right:100px;
    border:1px solid #dbd9d9;
	 background-color:#e2e2e2;  
	border-collapse:collapse;
	width:100%;
	_font-family:thaoma;
	font-size:15px;
	_text-align:center;


}

#table th
{
 background-color:#ccc;
 border:1px solid #adabab;
 padding:5px;
 text-align:center;
}
#table td{
	_border:1px solid #adabab;
	_width:400px;
	padding:10px;
}
#table tr:nth-child(even) {
  background: #cdd1d2;
   _background: rgb(240, 240, 240);
}

body
{
font-family:Segoe UI Light;
}
#content
{
heigh:750px;
}

#left{
	_border:1px solid red;
	float:left;
	margin-left:100px;
	margin-top:50px;
	width:300px;
	font-weight:bold;
	font-size:15px;
}

#right{
	_border:1px solid red;
	float:right;
	margin-right:100px;
	text-align:right;
	margin-top:-15px;
	font-weight:bold;
	font-size:15px;
}

#center{
	_border:1px solid red;
	text-align:center;
	margin-top:20px;
	font-weight:bold;
	font-size:25px;
}
</style>
<page  orientation="P" backcolor="#fff" style="font: arial;">
  <div id="content">
           
             <div  style="height:100px;">
              <img src="./res/logo1.jpg" alt  height="200"  width="780">
            </div>
			
			
												<div id="left">Nom du Client : </div>
												<div id="right">
													
												</div>
												<div id="center">
													FACTURE PROFORMA
												</div>
												<table border="0" cellpadding="0" cellspacing="0"  id="table" align="center">
												<tr>
													 <th class=" " style="width:200px;">Désignation</th>
													 <th class=" " style="width:100px;">Tarif</th>
													 <th class="" colspan="" style="width:100px;">Quantité</th>
													 <th class="" colspan="" style="width:100px;">Total</th>
												</tr>
													
																 <tr>
																	    <td style="text-align:center"></td>
																	    <td style="text-align:center">$</td>
																	    <td style="text-align:center"></td>
																		<td style="text-align:center">$ </td>
																	   
																	   
																</tr>
														
														
											<!--  end top-search -->
												<tr>
													 <th class=" " colspan='3'> Total général </th>
													 <th class=" " style="_width:400px;"> $</th>
													  
												</tr>
												</table>
												<div id="bas_page">
													Superviseur
												</div>
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

