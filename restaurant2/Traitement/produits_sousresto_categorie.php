
    <?php
        if (!isset($_SESSION)){
            session_start();
        }
        include '../bdd/connexion.php';
        include ('../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php');
        include ('../../FUNCTION/hebergement.php');
        include ('../../FUNCTION/stock.php');
        include ('../../FUNCTION/restaurant.php');
        $id_sfam=$_GET['sfam_id'];
        $requete = $bdd->prepare("SELECT prod.idprod,prod.designation,prod.qte_min,prod.pv AS prix,prod.repas,fam.idfamille AS famille_id,p.monnaie,
        fam.plat,p.id_prix,p.prix_vente AS pv,prod.monnaie AS monprod,prod.pa,prod.path_image,s.id_s_fam
            FROM stk_famille AS fam, stk_sous_famille AS s, stk_produit AS prod, t_prix_produit AS p
            WHERE fam.idfamille=s.famille AND s.id_s_fam=prod.famille_id  AND prod.idprod=p.produit_id 
                 AND prod.pseudo_supp=0 AND s.id_s_fam=:sfam_id  AND fam.affichage=1 
                 ORDER BY prod.designation ASC");
  //  $requete->BindParam(':sousresto_id',$_SESSION['id_sousresto']);
    $requete->BindParam(':sfam_id',$id_sfam);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['produits']=$produits;
      //Pour la recherche
        $_SESSION['product'] = array();
        $_SESSION['product']['name'] = array();
        $_SESSION['product']['content'] = array();
        
      //fin 
      GetQteProdEnAttente($bdd);
      $PRODUITS['prod'] = array();
      $PRODUITS['prod']['id'] = array();
      $PRODUITS['prod']['des'] = array();
      $PRODUITS['prod']['cont'] = array();
      
      
        ?>
        <?php
        foreach ($produits as $prod):
               $idpr=$prod->idprod;
            if($_SESSION['stock']==1){
               $quantite_reste =GetQteDispoByProd($bdd,$prod->idprod,$_SESSION['depot_id']);
               $qte_attente=$qte_attente=QteAttenteProd($idpr);
               $quantite_reste-=$qte_attente; 
            }else{
              $quantite_reste=0;
              $qte_attente=0;
            }
                $monnaie=$prod->monnaie;
                $pv=montant_equivalent_bdd($monnaie,getsymbole_local(),$tauxdollar,$prod->pv);
                $tarif=  montant_equivalent_bdd($monnaie,$m_affiche,$tauxdollar,$prod->pv);

                $pa=montant_equivalent_bdd($prod->monprod,getsymbole_local(),$tauxdollar,$prod->pa);
               
            if($prod->repas == 1){
                if($prod->path_image==NULL){
                   $url='./Traitement/images/images.png';
                }else{
                   $url='./Traitement/'.$prod->path_image; 
                }
            }else{
                if($prod->path_image==NULL){
                   $url='./Traitement/images/images.png';
                }else{
                  $url='../Stock2/Traitement/'.$prod->path_image;  
                }
                
            }
            if ((($quantite_reste >=1)||($prod->repas==1 || $prod->repas==3))||$_SESSION['stock']==0){
                    if (!in_array($prod->idprod,$PRODUITS['prod']['id'])){
                        $des=$prod->designation;
                         array_push($PRODUITS['prod']['id'],$prod->idprod);
                         array_push($PRODUITS['prod']['des'],$prod->designation);
                           //Pour la recherchde
                            array_push($_SESSION['product']['name'],$prod->designation);
                           //fin
                         $_SESSION['product']['content'][$prod->designation]=$PRODUITS['prod']['cont'][$prod->designation]='
                             <a title="'.$des.'" class="prod btn btn-app s'.$prod->famille_id.'"
                       id="'.$prod->idprod.'"
                       id2="'.$prod->repas.'" 
                       pa="'.$pa.'"
                           style="width:110px;height:95px;margin-left:8px; margin-top:5px;">
                        <span
                            class="badge bg-purple">'.
                                 afficheMontant2($m_affiche, $tarif).' 
                        </span>
                        <img width="70" height="60" src="'.$url.'"/><br>'.
                                AfficheNom2($des).'
                        <span class="badge bg-purple"
                              id="'.$prod->idprod.'"
                              style="display: none;">'.$pv.'
                        </span>
                        <br>
                        <p id="'.$prod->idprod.'"
                           style="display: none;">'.$prod->designation.'</p>
                    </a>';
                }
            
            }
        endforeach;
        ?>
    <?php ; 
    $array_lowercase = array_map('strtolower',$PRODUITS['prod']['des']);
    array_multisort($array_lowercase, SORT_ASC, SORT_STRING,$PRODUITS['prod']['des']);
    $nbre_prod = count($PRODUITS['prod']['des']);
    for ($i = 0; $i <= $nbre_prod - 1; $i++) {
        $des=$PRODUITS['prod']['des'][$i];
        echo $PRODUITS['prod']['cont'][$des];
    } 
    ?>
