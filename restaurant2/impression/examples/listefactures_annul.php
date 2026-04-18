<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include_once '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../../../FUNCTION/hebergement.php';


$company_id = $_SESSION['company_id'];

//Selection des company
$requete_company = $bdd->prepare("SELECT * FROM  t_company WHERE id_c=:company_id");
$requete_company->BindParam(':company_id', $company_id);
$requete_company->execute();
while ($donnees = $requete_company->fetch()) {

    $nom_c = $donnees['nom_c'];
    $adresse_c = $donnees['adresse_c'];
    $ville = $donnees['ville'];
    $logo = $donnees['logo'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail_company'];
    $compte_bancaire = $donnees['compte_bancaire'];
    $mention = $donnees['mention'];
}

// requette pour la selection des sites
$requete_idhotel = $bdd->prepare("SELECT adresse_hotel, province_hotel, ville_hotel FROM  t_hotel WHERE company_id=:company_id");
$requete_idhotel->BindParam(':company_id', $company_id);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {

    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */

// Initialisation des données

    ob_start();
////    $total = 0;  $total_tva = 0; $i=1;
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
                <h2><u>LISTE DES FACTURES ANNULEES DU <?php echo $_SESSION['dte1']  ?> AU <?php echo $_SESSION['dte2']  ?></u></h2><br/>
                <?php if((($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions'])))&& $_SESSION['Asousresto_id']!=0){  ?>
                <h3>(Espace: <?php echo $_SESSION['libelle_restoA']?>)</h3>
                <?php }  ?>
            </td>
        </tr>
    </table>
<table style="margin-top:60px;" class="border">
        <thead>
            <tr>
                <th style="text-align: center;">N°</th>
                <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
                <th>Resto</th>
                <?php }  ?>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">Vendeur</th>
                <th style="text-align: center;">Client</th>
                 <th style="text-align: center;">N° Facture</th>
                <th style="text-align: center;">Montant total</th> 
                <th style="text-align: center;">Statut</th> 
            </tr>
        </thead>
        <tbody>
       <?php
        $monnaie_local=getsymbole_local();
        $i = 1;
        $total_fact=0;
        $total_paye=0;
        $total_tva=0;
        $result= $_SESSION['factures_annul'];
        foreach ($result as $r){
           $id_fact=$r->id_fact;
           $taux_op= getTauxFacture($r->type,$r->monnaie,$tauxdollar,$taux_op,$r->taux);
           $mont_tot= montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,$r->mont_ttc);
           $mont_paye=montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,totalMontantPayeFacture($id_fact,$bdd));
           $mont_tva= montant_equivalent_bdd($monnaie_local,$m_affiche,$taux_op,arrondir($r->mont_tva));
           $valetat=$r->etat_fact;
           if($r->dte_timef=='0000-00-00 00:00:00'){
               $dte=  dateAffiche($r->date_edition);
            }else{
//               $dte=  dateAfficheForHr($r->dte_timef);
               $dte=  dateAffiche($r->date_edition);
            }
            $nom_cl=$r->nom_client;
            if(empty($nom_cl)){
              $nom_cl=$r->designation;  
            }
           $user=$r->nom_user;
          $etat=getEtatCommande($r->etat_fact);
     ?>
        <tr>
            <td style="text-align: center;"><?php echo $i ?></td>
            <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
            <td class='text-danger'><?php echo $r->resto; ?></td>
            <?php } ?>
            <td style="text-align: left;"><?php echo $dte; ?></td>
            <td style="text-align: center;"><?php echo $user; ?> </td>
            <td style="text-align: center;">
                <?php echo $nom_cl  ?>
            </td>
            <td style="text-align: center;">
               <?php echo $r->num_fact  ?>
            </td>
            <td style="text-align: center;">
                <?php echo afficheMontant($m_affiche,$mont_tot);  ?>
            </td>
            <td style="text-align: center;"><?php  echo 'Annulée'; ?></td>
        </tr>
        <?php
            $i++;
            $total_fact+=$mont_tot;
//            $total_paye+=$mont_paye;
        }
      ?>
    </tbody>
    <tfoot>
        <tr>
            <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  
              $inc=1;  
            }  else {
               $inc=0; 
            }
            ?>
            <td colspan="<?php  echo 5+$inc; ?>" class="text-right"><b>Total : </b></td> 
            <td style="text-align: center;"><b><?php echo afficheMontant($m_affiche,$total_fact); ?></b></td>
            <td style="text-align: center;"></td>
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
$mpdf->Output("Liste des factures annulées.pdf", "I");

