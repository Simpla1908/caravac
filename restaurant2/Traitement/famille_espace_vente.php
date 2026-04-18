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
$famserviceprod='famserviceprod';
if($motif==''){
    $requete = $bdd->prepare("
	SELECT * FROM stk_familletype AS f WHERE  f.priority !=0 ORDER BY f.priority");
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);	
}elseif($motif=='getcateg'){
    $famserviceprod='catprod';
    $id=$_GET['id']; 
    $requete = $bdd->prepare("SELECT s.id_s_fam,s.des,s.famille,s.hotel_id
    FROM stk_sous_famille AS s,stk_famille AS fam,stk_familletype AS t
      WHERE fam.idfamille=s.famille 
      AND fam.affichage=1 
      AND fam.familletype_id=t.id
      AND fam.familletype_id=:familletype_id
      ORDER BY s.des ASC");
    $requete->BindParam(':familletype_id',$id);
    $requete->execute();  
    $result = $requete->fetchAll(PDO::FETCH_OBJ);	
}



 foreach ($result as $sf){
   if($motif=='getcateg'){
        $id_fam=$sf->id_s_fam;
        $libelle_fam=$sf->des; 
    }else{
        $id_fam=$sf->id;
        $libelle_fam=$sf->nom;
    }
?>
   <a href="#" class="btn btn-squared-default btn-default <?php echo $famserviceprod; ?>"
       title="<?php echo $libelle_fam; ?>"
       id="<?php echo $id_fam; ?>" style="width:120px;margin-bottom: 4px">
        <span class="badge bg-aqua"><?php echo AfficheNom2($libelle_fam); ?></span><br/>
        <i class="fa fa-barcode fa-3x"></i><br/><br/>
    </a>
    
<?php } ?>

