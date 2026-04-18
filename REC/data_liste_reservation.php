<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
if (isset($_POST['service']) && isset($_POST['type_cl']) && isset($_POST['datedebut']) && isset($_POST['datefin'])) {
    $type=$_POST['service'];
    $type_cl=$_POST['type_cl'];
    $p_debut= $_POST['datedebut'];
    $p_fin= $_POST['datefin'];
    $type_cl=$_POST['type_cl'];
    $_SESSION['p_debut'] = $_POST['datedebut'];
    $_SESSION['p_fin'] = $_POST['datefin'];
    $type_cl = $_POST['type_cl'];
    $datedebut = dateToformatBdd($_SESSION['p_debut']);
    $datefin = dateToformatBdd($_SESSION['p_fin']);
   
    if($type_cl=='tout'){
        $requete = $bdd->prepare
        ("
        SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.type, b.dte, b.dte_a, b.dte_s, b.statut_res,b.etat,c.entreprise AS nom_respo
        FROM t_client AS a, t_reservation AS b,t_responsable AS c
        WHERE a.id_client=b.id_client
        AND a.id_respo=c.id_respo
        AND b.type=:type
        AND b.dte BETWEEN :p_debut AND :p_fin
        AND a.type_cl IN('client partenaire','client occasionnel') 
        AND a.id_hotel=:id_hotel ORDER BY b.dte_a DESC
       ");
        $requete->BindParam(':type', $type);
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }else{
        $requete = $bdd->prepare
        ("
        SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.type, b.dte, b.dte_a, b.dte_s, b.statut_res,b.etat,c.entreprise AS nom_respo
        FROM t_client AS a, t_reservation AS b,t_responsable AS c
        WHERE a.id_client=b.id_client
        AND a.id_respo=c.id_respo
        AND b.type=:type
        AND b.dte BETWEEN :p_debut AND :p_fin
        AND a.type_cl IN(:type_cl) 
        AND a.id_hotel=:id_hotel  ORDER BY b.dte_a DESC
    ");
        $requete->BindParam(':type', $type);
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':type_cl',$type_cl);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }

} else {
    $type = 'reservation';
    $requete = $bdd->prepare
        ("
        SELECT a.id_client, a.nom_client, b.id_res, b.num_reserv, b.type, b.dte, b.dte_a, b.dte_s, b.statut_res,b.etat,c.entreprise AS nom_respo
        FROM t_client AS a, t_reservation AS b,t_responsable AS c
        WHERE a.id_client=b.id_client
        AND a.id_respo=c.id_respo
        AND b.type=:type
        AND a.id_hotel=:id_hotel  ORDER BY b.dte_a DESC
       ");
    $requete->BindParam(':type', $type);
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
}
$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i = 1;
$etat='';
foreach ($result as $r) {
    $id_client = $r->id_client;
    $id_res = $r->id_res;
    $etat=$r->etat;
    if($etat=='operationnel'){
        $etat='reservé';
    }elseif($etat=='execute'){
        $etat='occupé';
    }
    
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $r->num_reserv ?></td>
        <td><?php echo $r->nom_client ?></td>
        <td><?php echo $r->nom_respo ?></td>
        <td><?php echo dateAffiche($r->dte) ?></td>
        <td><?php echo dateAffiche($r->dte_a) ?></td>
        <td><?php echo dateAffiche($r->dte_s) ?></td>
        <td><small class="label label-warning"><?php echo $etat ?></small></td>
        <td class="text-center">
            <a href="details_hebergement.php?id_res=<?php echo $id_res; ?>" title="Afficher le detail"
               class="btn btn-info btn-xs"><i class="fa fa-bars"></i> Détails
            </a>
        </td>
    </tr>
    <?php
    $i++;
}
?>