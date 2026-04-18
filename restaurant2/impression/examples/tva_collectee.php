<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include_once '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../../../FUNCTION/hebergement.php';

$company_id = $_SESSION['company_id'];
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
    ob_start();
?>
 
<!--Insertion du CSS -->
<style type="text/css">
    table { 
        width: 100%; 
        color: #717375; 
        font-family: helvetica; 
        line-height: 5mm; 
        border-collapse: collapse; 
    }
    h2 { margin: 0; padding: 0; }
    p { margin: 25px; text-align: center; }
 
    .border th { 
        border: 1px solid #000;  
        color: white; 
        background: #000; 
        padding: 5px; 
        font-weight: normal; 
        font-size: 14px; 
        text-align: center; 
        }
    .border td { 
        border: 1px solid #CFD1D2; 
        padding: 5px 10px; 
        text-align: center; 
    }
    .no-border { 
        border-right: 1px solid #CFD1D2; 
        border-left: none; 
        border-top: none; 
        border-bottom: none;
    }
    .space { padding-top: 100px; }
    .10p { width: 10%; } .15p { width: 15%; } 
    .25p { width: 25%; } .50p { width: 50%; } 
    .60p { width: 60%; } .75p { width: 75%; } .100p { width: 100%; }
</style>
 
    <table style="margin-top: 50px;">
        <tr>
            <td class="100p" style="text-align: center;">
                <h2><u>LISTE DES T.V.A COLLECTEES DU <?php echo $_SESSION['dte1']  ?> AU <?php echo $_SESSION['dte2']  ?></u></h2><br/>
                <b>(Resto: <?php echo strtoupper($_SESSION['libelle_resto'])?>)</b><br>
            </td>
        </tr>
    </table>
<table style="margin-top:45px;" class="border">
        <thead>
            <tr>
                <th style="text-align: center;">N°</th>
                <th style="text-align: center;">Date</th>
                 <th style="text-align: center;">N° Facture</th>
                <th style="text-align: center;">Mode</th> 
                <th style="text-align: center;">Montant total</th> 
                <th style="text-align: center;">T.V.A</th> 
            </tr>
        </thead>
        <tbody>
       <?php
        $monnaie_local=getsymbole_local();
        $i = 1;
        $total_fact=0;
        $total_paye=0;
        $total_tva=0;
        $result= $_SESSION['factures3'];
        foreach ($result as $r){
            $mode=$r->modef;
            if($mode!='Don'){
           $id_fact=$r->id_fact;
           $taux_op=$r->taux;
           $mont_tot= $r->mont_ttc;
           $mont_tva= montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,arrondir($r->mont_tva));
           $valetat=$r->etat_fact;
           if($r->dte_timef=='0000-00-00 00:00:00'){
               $dte=  dateAffiche($r->date_edition);
            }else{
               $dte=  dateAffiche($r->date_edition);
            }
            $nom_cl=$r->nom_client;
            if(empty($nom_cl)){
              $nom_cl=$r->designation;  
            }
           $user=$r->nom_user;
     ?>
        <tr>
            <td style="text-align: center;"><?php echo $i ?></td>
            <td style="text-align: left;"><?php echo $dte; ?></td>
            <td style="text-align: center;">
               <?php echo $r->num_fact  ?>
            </td>
            <td style="text-align: center;">
                <?php echo $r->modef  ?>
            </td>
            <td style="text-align: center;">
                <?php echo afficheMontant2($m_affiche,$mont_tot);  ?>
            </td>
            <td style="text-align: center;"><?php echo afficheMontant2($m_affiche,$mont_tva); ?> </td>
        </tr>
        <?php
            $i++;
            $total_fact+=$mont_tot;
            $total_paye+=$mont_tva;
        }
        }
      ?>
    </tbody>
    <tfoot>
        <?php $nbr=0;?>
        <tr>
            <td colspan="<?php echo 4+$nbr; ?>" class="text-right"><b>Total : </b></td> 
            <td style="text-align: center;"><b><?php echo afficheMontant2($m_affiche,$total_fact); ?></b></td>
            <td style="text-align: center;"><b><?php echo afficheMontant2($m_affiche,$total_paye);?></b></td>
        </tr>
    </tfoot>
    </table>
 
<?php
$body = ob_get_clean();
$body = iconv("UTF-8","UTF-8//IGNORE",$body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c','A4-L','','',15,15,30,20,5,5);
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
//        $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($body);
$mpdf->Output("tva Collectees.pdf", "I");

