
    <?php
        include '../bdd/connexion.php';
        $requete = $bdd->prepare("SELECT idprod FROM stk_produit WHERE hotel_id=356");
        $requete->execute();
        $produits = $requete->fetchAll(PDO::FETCH_OBJ);

        foreach ($produits as $prod){

            $produit_id= $prod->idprod;
            
            $requete = $bdd->prepare("SELECT  produit_id,prix_vente FROM t_prix_produit WHERE sousresto_id=123 AND produit_id=:produit_id");
            $requete->BindParam(':produit_id', $produit_id);
            $requete->execute();
            $result= $requete->fetchAll(PDO::FETCH_OBJ);

            foreach ($result as $r) {

                $pv= $r->prix_vente;

                $requete = $bdd->prepare("UPDATE stk_produit  SET pv=:pv WHERE idprod=:idprod");
                $requete->BindParam(':pv', $pv);
                $requete->BindParam(':idprod', $produit_id);
                $requete->execute();
            }
           
        }
      
    ?>
      
  