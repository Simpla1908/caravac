<?php

// Initialisation de la session
include('../bdd/connexion.php');
session_start();
$depot1_id= $_POST['depot1_id'];

$tab_prod['produit'] = array();
$tab_prod['produit']['id'] = array();
$tab_prod['produit']['qte'] = array();
$tab_prod['produit']['designation'] = array();
$tab_prod['produit']['depot_id'] = array();

$requete = $bdd->prepare("SELECT d.id_depot,d.libelle,m.produit_id,p.designation, (SUM(qte_entree)-SUM(qte_sortie)) AS qte_dispo 
                FROM stk__mouvement AS m, stk_produit AS p, t_depot AS d
                WHERE m.produit_id=p.idprod AND d.id_depot=m.depot_id
                AND p.pseudo_supp=0 AND m.depot_id=:id_depot
                AND m.hotel_id=:id_hotel
                GROUP BY m.produit_id ORDER BY p.designation");
//session à enlever
$requete->BindParam(':id_depot',$depot1_id);
$requete->BindParam(':id_hotel',$_SESSION['id_hotel']);
$requete->execute();
$produits_depot = $requete-> fetchAll(PDO::FETCH_OBJ);

foreach ($produits_depot as $pd) {
    if($pd->qte_dispo > 0){
        array_push($tab_prod['produit']['id'], $pd->produit_id);
        array_push($tab_prod['produit']['designation'], $pd->designation);
        array_push($tab_prod['produit']['qte'], $pd->qte_dispo);
        array_push($tab_prod['produit']['depot_id'], $pd->id_depot);
    }    
}
$nbArticles = count($tab_prod['produit']['id']);

echo '<option>  </option>';
for ($i = 0; $i <= $nbArticles - 1; $i++) {
    $produit_id=$tab_prod['produit']['id'][$i];
    $produit_name=$tab_prod['produit']['designation'][$i];
    $depot_id=$tab_prod['produit']['depot_id'][$i];
    $qte=$tab_prod['produit']['qte'][$i];
echo '<option att1=' . $depot_id.' att2=' . $qte.' value=' . $produit_id.'>' . $produit_name.'</option>';
}