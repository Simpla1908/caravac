<?php
session_start();

include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';

$m_affiche = $_SESSION['m_affiche'];

/* =========================
   PRODUITS
========================= */

    $requete = $bdd->prepare("SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation,p.id_prix,p.prix_vente "
        . "FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam, t_prix_produit AS p "
        . "WHERE  prod.famille_id=s_fam.id_s_fam AND prod.idprod=p.produit_id "
        . "AND p.sousresto_id=:sousresto_id AND prod.hotel_id=:hotel_id AND fam.plat=1 AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 ORDER BY prod.designation ");
    $requete->BindParam(':sousresto_id', $_SESSION['id_sousresto']);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_OBJ);



/* =========================
   PRIX PRODUITS
========================= */
$tab_prod = array();
$tab_prod['pv'] = array();

$req2 = $bdd->prepare("
    SELECT * FROM t_prix_produit
    WHERE sousresto_id = :id
");
$req2->bindParam(':id', $_SESSION['id_sousresto']);
$req2->execute();
$res = $req2->fetchAll(PDO::FETCH_OBJ);

foreach ($res as $r) {
    $tab_prod['pv'][$r->produit_id] = $r->prix_vente;
}

/* =========================
   HTML PDF
========================= */
$html = '
<h2 style="text-align:center;">Liste des Plats</h2>
<br>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>N°</th>
        <th>Désignation</th>
        <th>Prix de vente(CDF)</th>
        <th>Catégorie</th>
    </tr>
';

$i = 1;

foreach ($produits as $p) {

    /* =========================
       PHP 5 SAFE (PAS DE ?)
    ========================= */
    if (isset($tab_prod['pv'][$p->idprod])) {
        $pv1 = $tab_prod['pv'][$p->idprod];
    } else {
        $pv1 = 0;
    }

    $pv = montant_equivalent_bdd(
        $p->monnaie,
        $m_affiche,
        $_SESSION['tauxdollar'],
        $pv1
    );

    $html .= '
    <tr>
        <td>'.$i.'</td>
        <td>'.ucfirst($p->produit).'</td>
        <td>'.$pv.'</td>
        <td>'.ucfirst($p->des).'</td>
    </tr>
    ';

    $i++;
}

$html .= '</table>';

/* =========================
   MPDF CONFIG
========================= */
$mpdf = new mPDF('c', 'A4', '', '', 15, 15, 15, 20, 5, 5);
$mpdf->SetDisplayMode('fullpage');

/* =========================
   HEADERS / FOOTERS (OPTIONNEL)
========================= */
$header = '';
$footer = '';

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);

/* =========================
   OUTPUT PDF
========================= */
$mpdf->WriteHTML($html);
$mpdf->Output("liste_plats.pdf", "I");
exit;
?>