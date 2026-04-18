<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once '../../../impression/mpdf60/mpdf.php';
include '../../bdd/connexion.php';
include_once '../../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include_once '../../../FUNCTION/hebergement.php';


$type='restaurant';
if (isset($_GET['dte_bd1'])&&isset($_GET['dte_bd2'])) {
    $dte_bd1 = $_GET['dte_bd1'];
    $dte_bd2 = $_GET['dte_bd2'];
}

//Fusion horaire
date_default_timezone_set('Europe/Paris');

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
                <h2><u>MOUVEMENT FINANCIER</u></h2><br />
                <?php if((($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions'])))&& $_SESSION['sousresto_id']!=0){  ?>
                <b>(Resto: <?php echo strtoupper($_SESSION['libelle_restoMvt'])?>)</b><br>
                <?php } ?>
            </td>
        </tr>
    </table>
 
<table style="margin-top:45px;" class="border">
        <thead>
            <tr>
                <th style="text-align: center;">N°</th>
                <th style="text-align: center;">Date</th>
                <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
                <th>Resto</th>
                <?php }  ?>
                <th style="text-align: center;">Vendeur</th>
                <th style="text-align: center;">Cash</th>
                <!--<th style="text-align: center;">T.V.A</th>-->
                <th style="text-align: center;">Crédit</th> 
                <th style="text-align: center;">Don</th> 
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        $total = 0;
        $total1 = 0;
        $total2=0;
        
        if (($_SESSION['test'] == 1) || (in_array('VFTSR', $_SESSION['actions']['code_actions']))) {
            if (isset($_POST['sresto_id'])) {
                $Sresto = $_POST['sresto_id'];
            } else {
                $Sresto = $_SESSION['id_sousresto'];
            }
            $_SESSION['sousresto_id'] = $Sresto;
            $sousresto = getNameSresto($Sresto, $bdd);
            foreach ($sousresto as $sr) {
                $resto_name = $sr->libelle;
                $_SESSION['libelle_resto'] = $resto_name;
            }
            if($Sresto==0){
                $req1="SELECT f.libelle AS resto, a.date_edition AS date_edit1,a.mode,a.dte_time,b.nom_user
                FROM t_facture AS a, t_utilisateur AS b,t_sousresto AS f
                WHERE a.id_user=b.id_user AND a.id_sousresto=f.id_sousresto AND a.type=:type AND a.id_hotel=:id AND a.date_edition BETWEEN :dte_bd1 AND :dte_bd2
                GROUP BY a.date_edition";
                $requete = $bdd->prepare($req1);
                $requete->BindParam(':type',$type);
                $requete->BindParam(':id',$_SESSION['id_hotel']);
                $requete->BindParam(':dte_bd1',$dte_bd1);
                $requete->BindParam(':dte_bd2',$dte_bd2);
                $requete->execute();
                $result1= $requete->fetchAll(PDO::FETCH_OBJ);
            }  else {
                $req1="SELECT f.libelle AS resto, a.date_edition AS date_edit1,a.mode,a.dte_time,b.nom_user
                FROM t_facture AS a, t_utilisateur AS b,t_sousresto AS f
                WHERE a.id_user=b.id_user AND a.id_sousresto=f.id_sousresto AND a.type=:type AND a.id_hotel=:id AND a.id_sousresto=:id_sousresto AND a.date_edition BETWEEN :dte_bd1 AND :dte_bd2
                GROUP BY a.date_edition";
                $requete = $bdd->prepare($req1);
                $requete->BindParam(':type',$type);
                $requete->BindParam(':id',$_SESSION['id_hotel']);
                $requete->BindParam(':id_sousresto', $Sresto);
                $requete->BindParam(':dte_bd1',$dte_bd1);
                $requete->BindParam(':dte_bd2',$dte_bd2);
                $requete->execute();
                $result1= $requete->fetchAll(PDO::FETCH_OBJ);
            }
            
        }  else {
            $req1="SELECT a.date_edition AS date_edit1,a.mode,a.dte_time,b.nom_user
            FROM t_facture AS a, t_utilisateur AS b
            WHERE a.id_user=b.id_user AND a.type=:type AND a.id_hotel=:id AND a.id_sousresto IS NULL AND a.date_edition BETWEEN :dte_bd1 AND :dte_bd2
            GROUP BY a.date_edition";
            $requete = $bdd->prepare($req1);
            $requete->BindParam(':type',$type);
            $requete->BindParam(':id',$_SESSION['id_hotel']);
            $requete->BindParam(':dte_bd1',$dte_bd1);
            $requete->BindParam(':dte_bd2',$dte_bd2);
            $requete->execute();
            $result1= $requete->fetchAll(PDO::FETCH_OBJ);
        }
            
        foreach ($result1 as $op1):
        $mont_cash=0;
        $mont_credit=0;
        $mont_don=0;
        $mont_don1=0;
        if (in_array('VTMF', $_SESSION['actions']['code_actions'])){
            if ($op1->mode!='') {
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierGlobaleSresto($_SESSION['id_hotel'],$Sresto,$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierGlobale($_SESSION['id_hotel'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
                 
            }  else {
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierGlobaleAsresto($_SESSION['id_hotel'],$Sresto,$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierGlobaleA($_SESSION['id_hotel'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
            }
            
        }elseif(in_array('VSPMF', $_SESSION['actions']['code_actions'])){
            if ($op1->mode!='') {
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierByUserSresto($_SESSION['id_hotel'],$Sresto,$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierByUser($_SESSION['id_hotel'],$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
                 
            }else{
                if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){
                    $result=getMvtFinancierByUserAsresto($_SESSION['id_hotel'],$Sresto,$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }  else {
                    $result=getMvtFinancierByUserA($_SESSION['id_hotel'],$_SESSION['id_user'],$type,$dte_bd1,$dte_bd2,$bdd);
                }
                 
            }
           
        }
        foreach ($result as $op):
            $mont_ttc= montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_op,arrondir($op->mont_ttc));
//            $mont_ttc= $op->mont_ttc;
            $mont_paie= montant_equivalent_bdd(getsymbole_local(),$m_affiche,$taux_op,arrondir($op->mont_paie));
//            $mont_paie= $op->mont_paie;
            if($op->date_edition==$op1->date_edit1){
                if($op->lib=='Cash'){
                    $mont_cash+=$mont_paie;
                }  elseif ($op->lib=='Credit') {
                    $mont_credit+=$mont_ttc;
                }  elseif ($op->lib=='Don') {
                    $mont_don+=$mont_paie;
                } 
            }
        endforeach;
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $i ?></td>
            <td style="text-align: center;"><?php echo dateAffiche($op1->date_edit1) ?></td>
            <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  ?>
            <td class='text-danger'><?php echo ucfirst($op1->resto) ?> </td>
            <?php } ?>
            <td style="text-align: center;"><?php echo ucfirst($op1->nom_user) ?> </td>
            <td style="text-align: center;">
                <?php 
                    echo afficheMontant($m_affiche,$mont_cash);
                 
                ?>
            </td>
<!--            <td style="text-align: center;">
                <?php 
//                    echo afficheMontant($m_affiche,montant_tva($mont_cash,0,$tva));
                ?>
            </td>-->
            <td style="text-align: center;">
                <?php 
                    echo afficheMontant($m_affiche,$mont_credit);
                
                ?>
            </td>
            <td style="text-align: center;">
                <?php 
                
                    echo afficheMontant($m_affiche,$mont_don);
                
                ?>
            </td>
            
        </tr>
        <?php
        $i++;
        $total += $mont_credit;
        $total1 += $mont_cash;
        $total2 += $mont_don;
        endforeach;
        ?>
    </tbody>
    <tfoot>
        <?php if(($_SESSION['test']==1)||(in_array('VFTSR', $_SESSION['actions']['code_actions']))){  
            $nbr=1;
        }  else {
            $nbr=0;
        }
        ?>
        <tr>
            <td colspan="<?php echo 3+$nbr; ?>" class="text-right"><b>Total : </b></td> 
            <td style="text-align: center;"><b><?php echo afficheMontant($m_affiche,$total1);?></b></td>
            <td style="text-align: center;"><b><?php echo afficheMontant($m_affiche,$total);?></b></td>
            <td style="text-align: center;"><b><?php echo afficheMontant($m_affiche,$total2);?></b></td>
        </tr>
<!--        <tr>
            <td colspan="3" class="text-right">Montant T.V.A : </td> 
            <td style="text-align: center;"><?php echo afficheMontant($m_affiche,montant_tva($total1,0,$tva)); ?></td>
            <td colspan="2"></td>
        </tr>-->
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
$mpdf->Output("Mouvement fiancier.pdf", "I");

