<?php
if ($do == 'liste' || $do == 'listeajx') {
    $result = array();
    $datedebut = date('Y-m-d');
    $datefin = date('Y-m-d');
    $url = $pathview . 'fdc/liste.php';
    if ($do == 'listeajx') {
        if (!empty($_POST['periode'])) {
            $periode = $_POST['periode'];
            /* Conversion periode */
            $transpostion_periode = explode(' ', $periode);
            $date1 = $transpostion_periode[0];
            $caractere = $transpostion_periode[1];
            $date2 = $transpostion_periode[2];
            /* Conversion date1 */
            $transpostion_date1 = explode('/', $date1);
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/', $date2);
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
        }
        $url = $pathview . 'fdc/alldatas.php';
    }
    if ($_SESSION['type_user'] == 1) {
        $requete = $bdd->prepare("SELECT a.id,a.cdf AS fond_cdf,a.usd AS fond_usd,b.id_user,b.nom_user,b.prenom_user,a.dte,a.hr,a.motif
        FROM fondscaisse AS a,t_utilisateur AS b
        WHERE a.dte BETWEEN :p_debut AND :p_fin 
        AND a.user_id=b.id_user AND a.sousresto_id=:id_sousresto ORDER BY a.dte DESC");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
    } else {
        $requete = $bdd->prepare("SELECT a.id,a.cdf AS fond_cdf,a.usd AS fond_usd,b.id_user,b.nom_user,b.prenom_user,a.dte,a.hr,a.motif
        FROM fondscaisse AS a,t_utilisateur AS b
        WHERE a.dte BETWEEN :p_debut AND :p_fin 
        AND a.user_id=b.id_user AND a.sousresto_id=:id_sousresto  AND b.id_user=:id_user ORDER BY a.dte DESC");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->BindParam(':id_user', $_SESSION['id_user']);
    }
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['datedebut'] = $datedebut;
    $_SESSION['datefin'] = $datefin;
    include($url);
} elseif ($do == 'delfdc') {
    $fdc_id = $_GET['fdc_id'];
    $query = $bdd->prepare("DELETE FROM fondscaisse WHERE id=:fdc_id");
    $query->BindParam(':fdc_id', $fdc_id);
    $query->execute();
    $json['message'] = 'Operation reussi!';
    $json['s'] = True;
    echo json_encode($json);
}
