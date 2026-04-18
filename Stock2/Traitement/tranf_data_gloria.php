<?php
include('../../FUNCTION/hebergement.php');
include('../../FUNCTION/stock.php');
include('../../FUNCTION/restaurant.php');
//Connexion2
$user = 'ebutelocirbp4265';
$pass = 'Mot2pa553';
$dsn = 'mysql:host=ebutelocirbp4265.mysql.db;dbname=ebutelocirbp4265';
// Connexion à la base de données
try {
    $bdd = new PDO($dsn, $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    echo 'con2 ok';
} catch (PDOException $e) {
    echo 'Echec2';
    print "Erreur ! : " . $e->getMessage() . "<br/>";
    die();
}
$s=86;
$h=338;
$requete = $bdd->prepare("SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation,p.id_prix,p.prix_vente "
            . "FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam, t_prix_produit AS p "
            . "WHERE  prod.famille_id=s_fam.id_s_fam AND prod.idprod=p.produit_id "
            . "AND p.sousresto_id=:sousresto_id AND prod.hotel_id=:hotel_id AND fam.plat=1 AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 ORDER BY prod.designation ");
    $requete->BindParam(':sousresto_id',$s);
    $requete->BindParam(':hotel_id',$h);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($produits as $op) {
    $sousresto_id =93;
    $prix_vente_site =$op->prix_vente;
    $article=$op->idprod;
    $monnaie='CDF';
    $requete = $bdd->prepare("INSERT INTO t_prix_produit (prix_vente,produit_id,sousresto_id,monnaie)
                         VALUES(:prix_vente,:produit_id,:sousresto_id,:monnaie)");
    $requete->BindParam(':prix_vente', $prix_vente_site);
    $requete->BindParam(':produit_id', $article);
    $requete->BindParam(':sousresto_id', $sousresto_id);
    $requete->BindParam(':monnaie',$monnaie);
    $requete->execute();
    echo 'ok';
}

    