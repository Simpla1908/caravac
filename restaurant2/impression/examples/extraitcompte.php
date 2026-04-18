<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
ini_set('memory_limit','1024M');
if (!isset($_SESSION)){
    session_start();
 }
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche=$_SESSION['m_affiche'];
if($m_affiche=='USD'){
    $m_affiche1='CDF';
}else{
    $m_affiche1='USD';
}
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $nom_c = $donnees['nom_hotel'];
    $adresse_c = $donnees['adresse_hotel'];
    $ville = $donnees['ville_hotel'];
    $logo = $donnees['image'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail'];
    $compte_bancaire = $donnees['cb'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */
$idclient=$_GET['id'];
$date_bd1 = $_GET['d1'];
$date_bd2 = $_GET['d2'];
$nomclient= $_GET['n'];
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <table  style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="4" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c)  ?>
                         <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto'])?>)</b><br>
                        <?php 
                        if($rccm!=''){
                            echo 'RCCM:'.$rccm .'<br>';
                        }
                        ?>
                        <?php 
                        if($idnat!=''){
                            echo 'IDNAT:'. $idnat .'<br>';
                        }
                        ?>
                        <?php echo strtoupper($adresse_c)  ?>
                        <br>
                        <?php echo strtoupper($telephone)  ?>
                        <br>
			</b>
                    </td>
                </tr>
                <tr>
                    <td  colspan="4" align="center" style="border-bottom: 1px solid black;">
                        <b>EXTRAIT DE COMPTE
                        <br>
                        <?php echo ' Du ' . dateAffiche($date_bd1) . ' au ' . dateAffiche($date_bd1); ?>
                        <br>
                        Client : <?php echo $nomclient; ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <?php 
                    $total_debit=0;
                    $total_credit=0;
                    $requete = $bdd->prepare("SELECT * FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                     AND b.id_client=:idcl
                                     AND a.type='restaurant'
                                     AND a.etat_cmd=0
                                     AND a.date_edition BETWEEN :date_bd1 AND :date_bd2");
                    $requete->BindParam(':idcl',$idclient);     
                    $requete->BindParam(':date_bd1', $date_bd1);
                    $requete->BindParam(':date_bd2', $date_bd2);                      
                    $requete->execute();
                    $factures = $requete->fetchAll(PDO::FETCH_OBJ);
                    foreach ($factures as $fct) {
                        $numfact=$fct->num_fact;
                        $id_fact=$fct->id_fact;
                        $taux = $fct->taux;
                        $monnaie = $fct->monnaie;
                        $date_edition=$fct->date_edition;
                        $debit=$fct->mont_ttc;
                        $total_debit=$total_debit+$debit;
                  ?>
                <tr>
                    <td  colspan="4" align="center" style="border-bottom: 1px solid black;">
                        <b>N° Facture : <?php echo $numfact;  ?>
                        <br>
                        <?php echo dateAffiche($date_edition);  ?>
                        <br>
                        Montant:<?php echo afficheMontant2($m_affiche, $debit);  ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td><b>Date</b></td>
                    <td><b>N°Rec</b></td>
                    <td><b>Credit</b></td>
                    <td><b>Solde</b></td>

                </tr>
              <?php 
                $dte='';
                $numrecu='';
                $credit=0;
                $taux=1;
                $solde=$debit;
                $requete = $bdd->prepare("SELECT * FROM t_reglement AS c, paiement AS d WHERE c.id_regl=d.regl_id AND c.id_fact=:id_fact ORDER BY c.dte");
                $requete->BindParam(':id_fact', $id_fact);                           
                $requete->execute();
                $paiements = $requete->fetchAll(PDO::FETCH_OBJ);
                $nbre=count($paiements);
                if($nbre>0){
                    foreach($paiements as $p) {
                        $dte=$p->dte;
                        $numrecu=$p->numero;
                        $montantusd=$p->montantusd;
                        $montantcdf =$p->montantcdf;
                        $taux=$p->taux;
                        $credit=$montantusd+montant_equivalent_bdd($m_affiche1,$m_affiche, $taux, $montantcdf);
                        if($credit>$debit){
                         $credit=$debit;
                        }
                        $total_credit=$total_credit+$credit;
                        $solde=$solde-$credit;
               ?>
                <tr>
                    <td><b><?php echo dateAffiche2($dte); ?></b></td>
                    <td><b><?php echo $numrecu; ?></b></td>
                    <td><b><?php echo afficheMontant2($m_affiche, $credit); ?></b></td>
                    <td><b><?php echo afficheMontant2($m_affiche, $solde); ?></b></td>
                </tr>
              <?php
               }   
               } 
              };
              ?>
                <tr>
                    <td align="right" colspan="4" style="border-top: 1px solid black;">
                    </td>
                </tr>
                   <tr>
                        <td align="right" colspan="2"><b>TOTAL DEBIT</b></td>
                        <td align="right" colspan="2"><b>:<?php echo afficheMontant2($m_affiche, $total_debit); ?></b></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2"><b>TOTAL CREDIT</b></td>
                        <td align="right" colspan="2"><b>:<?php echo afficheMontant2($m_affiche, $total_credit); ?></b></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2"><b>SOLDE</b></td>
                        <td align="right" colspan="2"><b>:<?php echo afficheMontant2($m_affiche,$total_debit-$total_credit); ?></b></td>
                    </tr>
                    <tr>
                    <td align="center" colspan="4" style="border-top: 1px solid black;"><b>
                        <?php 
                        echo $_SESSION['mention']; 
                        ?>
                    </b></td>
                 </tr>
            </tbody>
            
        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82,5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->Output("ExtraitDeCompte.pdf","I");
