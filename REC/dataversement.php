<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';
require '../FUNCTION/hebergement.php';

if (isset($_POST['user']) && isset($_POST['datedebut']) && isset($_POST['datefin'])) {
    $user=$_POST['user'];
    $datedebut = dateToformatBdd($_POST['datedebut']);
    $datefin = dateToformatBdd($_POST['datefin']);
    if($user==0){
        $requete = $bdd->prepare
        ("
        SELECT us.nom_user,op.date_bon,SUM(montantFC) AS montantFC,SUM(montantUSD) AS montantUSD
        FROM t_operation AS op, t_utilisateur AS us
        WHERE op.user_vers=us.id_user AND (op.date_bon BETWEEN :p_debut AND :p_fin)
        AND  op.hotel_id=:id_hotel AND op.libelle='Heberge' GROUP BY op.date_bon,op.user_vers ORDER BY op.date_bon DESC
       ");
        $requete->BindParam(':p_debut',$datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }else{
        $requete = $bdd->prepare
        ("
        SELECT us.nom_user,op.date_bon,SUM(montantFC) AS montantFC,SUM(montantUSD) AS montantUSD
        FROM t_operation AS op, t_utilisateur AS us
        WHERE op.user_vers=us.id_user AND op.date_bon BETWEEN :p_debut AND :p_fin AND op.user_vers=:user_id
        AND  op.hotel_id=:id_hotel AND op.libelle='Heberge' GROUP BY op.date_bon,op.user_vers  ORDER BY op.date_bon DESC
    ");
        $requete->BindParam(':p_debut',$datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':user_id',$user);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }

} else {
    $requete = $bdd->prepare
    ("SELECT us.nom_user,op.date_bon,SUM(montantFC) AS montantFC,SUM(montantUSD) AS montantUSD
        FROM t_operation AS op, t_utilisateur AS us
        WHERE op.user_vers=us.id_user AND  
        op.hotel_id=:id_hotel AND op.libelle='Heberge' GROUP BY op.date_bon,op.user_vers  ORDER BY op.date_bon DESC");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
}
$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i = 1;
$som = 0;
$somusd = 0;
foreach ($result as $r) {
//    $montant=meme_monnaie($m_affiche,$tauxdollar,$r->montantFC,$r->montantUSD);
    $som+=$r->montantFC;
    $somusd+= $r->montantUSD;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $r->nom_user ?></td>
        <td><?php echo dateAffiche($r->date_bon) ?></td>
        <td><?php echo format_chiffre($r->montantUSD) ?></td>
        <td><?php echo format_chiffre($r->montantFC) ?></td>
    </tr>
    <?php
    $i++;
}
?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td><b><?php echo format_chiffre($somusd); ?></b></td>
    <td><b><?php echo format_chiffre($som); ?></b></td>
</tr>
