<?php
 if (!isset($_SESSION)){
            session_start();
        }
include '../bdd/connexion.php';
include ('../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
include ('../../FUNCTION/hebergement.php');
include ('../../FUNCTION/stock.php');
include ('../../FUNCTION/restaurant.php');
$motif='';
if(!empty($_GET['motif'])){
 $motif=$_GET['motif'];   
}
if($motif==''){
    $requete = $bdd->prepare("SELECT s.id_s_fam,s.des,s.famille,s.hotel_id
          FROM stk_sous_famille AS s,stk_famille AS fam
            WHERE fam.idfamille=s.famille AND fam.affichage=1 
            AND s.hotel_id=:hotel_id 
            AND s.pseudo_supp=0
            ORDER BY s.classer,s.des ASC");
    $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
    $requete->execute();
}else{
    $requete = $bdd->prepare("SELECT s.id_s_fam,s.des,s.famille,s.hotel_id
          FROM stk_sous_famille AS s,stk_famille AS fam
            WHERE fam.idfamille=s.famille AND fam.affichage=1 
             AND s.pseudo_supp=0
            AND s.hotel_id=:hotel_id AND s.des LIKE '%".$motif."%'
            ORDER BY s.des ASC");
    $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
    $requete->execute();  
}

$s_familles = $requete->fetchAll(PDO::FETCH_OBJ);	

 foreach ($s_familles as $sf){
    $id_fam=$sf->id_s_fam;
    $libelle_fam=$sf->des;
?>
   <a href="#" class="btn btn-squared-default btn-default catprod"
       title="<?php echo $libelle_fam; ?>"
       id="<?php echo $id_fam; ?>" style="width:120px;margin-bottom: 4px">
        <span class="badge bg-aqua"><?php echo AfficheNom2($libelle_fam); ?></span><br/>
        <i class="fa fa-barcode fa-3x"></i><br/><br/>
    </a>
   
<?php } ?>

