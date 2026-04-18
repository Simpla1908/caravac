<?php
//session_start();
include_once '../../impression/mpdf60/mpdf.php';
include_once '../../bdd/connexion.php';
include_once '../../FUNCTION/hebergement.php';

if (!isset($_SESSION)) {
    session_start();
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
//    $compte_bancaire = $donnees['compte_bancaire'];
//    $mention = $donnees['mention'];
}

// requette pour la selection des sites
$requete_idhotel = $bdd->prepare("SELECT nom_hotel,adresse_hotel, province_hotel, ville_hotel FROM  t_hotel WHERE company_id=:company_id");
$requete_idhotel->BindParam(':company_id', $company_id);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $nom_hotel = $donnees['nom_hotel'];
    $adresse_hotel = $donnees['adresse_hotel'];
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
}
$noms = '';
$sexe = '';
$login = '';
$mdp = '';
$actif = '';
$type_user = '';
$module_dflt = '';
$module_name= '';
$pos_id='';
$path_image='';
$telephone_user="";
$adresse_mail_user="";
 $module_name="";

    $id_user=$_GET['id_user'];
    $requete = $bdd->prepare("SELECT * FROM t_utilisateur AS u WHERE u.id_user=:id_user");
    $requete->BindParam(':id_user', $_GET['id_user']);
    $requete->execute();
    $users = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($users as $user) {
        $noms = $user->nom_user;
        $sexe = $user->sexe_user;
        $login = $user->email_user;
        $mdp = $user->mdp_user;
        $actif = $user->actif;
        $type_user = $user->type;
        $module_dflt = $user->module_dflt;
        $module_name= $user->module_name;
        $pos_id= $user->pos_id;
        $path_image= $user->path_image;
        $telephone_user=$user->telephone_user;
        $adresse_mail_user=$user->adresse_mail;


    }
/* Fin de la Recuperation des coordonnées de l'hotel */
include("Numbers/Words.php");
// créer l'objet
$lettre = new Numbers_Words();
ob_start();
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
        height:145px;
        width:270px;
        margin:auto;
        padding: 10px;

    }
    #chiffre
    {
/*        position:relative; 
        top:-352px; 
        left:500px; */
        border:1px solid #000; 
        width:350px; 
        padding:10px; 
        font-weight:bold; 
        font-size:16px; 
        background-color:#CCC;

    }
    #nom
    {
        position:relative; 
        top:65px; 
        left:145px; 
        
        width:538px; 
        padding:2px; 
        padding-left:20px;
        font-weight:bold; 
        font-size:18px; 
        /*background-color:#CCC;*/

    }
    #lettre_usd
    {
        position:relative; 
        top:20px; 
        left:115px;  
        width:577px; 
        padding:2px; 
        padding-left:10px;
        font-weight:bold; 
        font-size:18px; 
        background-color:#CCC;

    }
    #lettre_fc
    {
        position:relative; 
        top:8px; 
        left:28px; 
        width:665px; 
        padding:2px; 
        padding-left:10px;
        font-weight:bold; 
        font-size:18px; 
        background-color:#CCC;

    }
    #pour
    {
        position:relative; 
        top:12px; 
        left:63px; 
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
        top:30px; 
        left:460px; 
        /*border:1px solid #000; */
        width:200px; 
        padding:2px; 

    }
</style>
    <div id="content">
        <table id="tab_title" border="0" width="780" align="center">
           <tr>
                <td>
                    <img src="../images/logo_entreprise/<?php echo $logo; ?>" width="70" height="70">
                </td>
                <td>
                    
                </td>
                <td colspan="2" align="right">
                    <div style="border: 1px solid #ffffff; width: 300px; padding: 3px; padding-left: 8px;">
                        <strong> <h1>   <?php echo strtoupper($nom_hotel);?>.</h1></strong><br />
                        <h2>ID-Nat : <?php echo $idnat;?> -- RCCM : <?php echo $rccm;?> -- N° Impôt : <?php echo $num_impot;?>
                        <br />
                        Téléphone : <?php echo $telephone;?> -- Email : <?php echo $email_compagny;?></h2>>
                    </div>
                </td>

            </tr>  
        </table>
        <table border="0" width="780" align="center">
           <tr>
                <td width="220" height="200">
                  <img  width="220" height="200" src="../utilisateur/<?php echo $path_image; ?>"/> 
                </td>
                
                <td>

                    <table border="0" align="center" width="220" height="200">
                     <tr>
                        <td>
                           <h2> NOM : <?php echo strtoupper($noms); ?></h2>
                        </td>

                     </tr>  
                                       <br>

                     <tr>
                        <td >
                             <h2> MATRICULE : <?php echo strtoupper($sexe); ?></h2>
                        </td>

                     </tr> 
                                       <br>

                      <tr>
                        <td >
                            <h2>  FONCTION : <?php echo strtoupper($module_name); ?></h2>
                        </td>

                     </tr> 
                      
                      </table>
                </td>

            </tr>  
        </table>

<table border="0" width="780" align="center" style="text-align: right;"> 
         <tr>
            <td>
               <h2> Imprimé le  <?php echo $date = date('d/m/Y'); ?></h2>
            </td>
        </tr>
        
    </table>
 <table border="0" width="780" align="center" style="text-align: right;">
         <tr>
            <td>
                <div  style="margin-right:50px;"><h2>Administrateur</h2></div>
            </td>
        </tr>
        
    </table>
     
    </div>

<!--</page>-->
<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);

//Entete et pied de page
include './entete_pied_page.php';

$mpdf = new mPDF('c', array(80,50), '', '', 0, 0, 5, 0, 5, 5);
$mpdf->WriteHTML($body);
$mpdf->Output("Bon sortie caisse.pdf", "I");