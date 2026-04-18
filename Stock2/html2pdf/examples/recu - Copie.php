<?php
// Initialisation de la session
session_start();
require '../../bdd/connexion.php';


/* Recuperation des coordonnées de l'hotel */
			$id_hotel=$_SESSION['id_hotel'];
			
			$requete_idhotel = $bdd->prepare("SELECT adresse_hotel, province_hotel, ville_hotel FROM  t_hotel WHERE id_hotel=:id_hotel");
			$requete_idhotel->BindParam(':id_hotel', $id_hotel);
			$requete_idhotel->execute();
			while ($donnees = $requete_idhotel->fetch()) {
			
				$adresse_hotel = $donnees['adresse_hotel'];
				$province_hotel = $donnees['province_hotel'];
				$ville_hotel = $donnees['ville_hotel'];
			}
			/* Fin de la Recuperation des coordonnées de l'hotel */



$ids=array_keys($_SESSION['panier']);
	if(empty($ids)){
		$chambre=array();
	}else{
	$req = $bdd -> prepare('SELECT id_ch, num_ch FROM t_chambre WHERE id_ch in ('.implode(',', $ids).')');
	$req -> execute();
	$chambre = $req -> fetchAll(PDO::FETCH_OBJ);
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
					<td colspan="4" style="text-align:right;font-weight:bold; margin-right:5px;">
                    <!--Chambre n°-->  <?php 
					//foreach($chambre as $ch): echo 'Ch'.$ch->num_ch.', '; endforeach
					?>
                    </td>
					 
				</tr>
       	        <tr>
					<td colspan="4" style="text-align:center;font-weight:bold;">Reçu n°  <?php  echo $_SESSION['num_fact'];?></td>
					 
				</tr>
				<tr>
				     <td>Nom client :</td>
					 <td colspan="3" style="border-bottom:1px solid #000;"><i><?php $nom_client=strtoupper($_SESSION['nom_client']); echo $nom_client;?></i></td>
					 
				</tr>
				<tr>
					<td style="width:120px;">Montant payer: </td>
					<td  style="border-bottom:1px solid #000; width:300px; ">
                    	<i><?php if($_SESSION['monnaie']==1){echo $_SESSION['montant_paye']." FC";}else{echo $_SESSION['montant_paye']." $ ";} ?></i>
                    </td>
					<td align="center" style="width:100px;"><i>Reste: </i></td>
					<td style="border-bottom:1px solid #000; width:100px; " >&nbsp;<i><?php if($_SESSION['monnaie']==1){echo $_SESSION['reste']." FC";}else{echo $_SESSION['reste']." $ ";} ?></i></td>
				</tr>
				<tr>
					  <td>Motif:</td>
					 <td style="border-bottom:1px solid #000; " colspan="3"><i>
					 	<?php if($_SESSION['type']=="reservation"){
									echo"Réservation de(s) chambre(s) N° "; foreach($chambre as $ch): echo 'Ch'.$ch->num_ch.', '; endforeach;
									}else{
										echo "Occupation de(s) chambre(s) N° "; foreach($chambre as $ch): echo 'Ch'.$ch->num_ch.', '; endforeach;
										}
						?>
                     </i></td>
				</tr>
				<tr>
					  <td>Durée:</td>
					 <td style="border-bottom:1px solid #000;" colspan="3">
                     	<i>
						<?php 
							echo 'Du '.$_SESSION['date_arrive'].' au '.$_SESSION['date_sorti']; 
						?>
                        </i>
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
                     <?php echo $adresse_hotel.' '.'<br />'.'Province de '.$province_hotel.' - '.'RD. Congo' ?>
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
