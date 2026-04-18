<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../bdd/connexion.php';
require '../FUNCTION/hebergement.php';
if (isset($_POST['type_cl']) && isset($_POST['datedebut']) && isset($_POST['datefin'])) {
    $type_cl=$_POST['type_cl'];
    $p_debut= $_POST['datedebut'];
    $p_fin= $_POST['datefin'];
    $type_cl=$_POST['type_cl'];
    $_SESSION['p_debut'] = $_POST['datedebut'];
    $_SESSION['p_fin'] = $_POST['datefin'];
    $_SESSION['type_cl'] = $_POST['type_cl'];
    $type_cl = $_POST['type_cl'];
    $datedebut = dateToformatBdd($p_debut);
    $datefin = dateToformatBdd($p_fin);
    if($type_cl=='tout'){
        $requete = $bdd->prepare
        ("
        SELECT g.entreprise,c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,c.date_occ,c.date_lib
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_responsable g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact AND b.id_client=e.id_client AND e.id_respo=g.id_respo
              AND c.idchambre=d.id_ch AND c.date_lib BETWEEN :p_debut AND :p_fin
              AND e.type_cl IN('client partenaire','client occasionnel') AND c.statut='libre' AND a.id_hotel=:id_hotel
       ");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }else{
        $requete = $bdd->prepare
        ("
        SELECT g.entreprise,c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,c.date_occ,c.date_lib
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_responsable g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact AND b.id_client=e.id_client AND e.id_respo=g.id_respo
              AND c.idchambre=d.id_ch AND c.date_lib BETWEEN :p_debut AND :p_fin
              AND e.type_cl IN(:type_cl) AND c.statut='libre' AND a.id_hotel=:id_hotel
    ");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':type_cl',$type_cl);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
    }

} else {
    $requete = $bdd->prepare
    ("
        SELECT g.entreprise,c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,c.date_occ,c.date_lib
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_responsable g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact AND b.id_client=e.id_client AND e.id_respo=g.id_respo
              AND c.idchambre=d.id_ch AND c.statut='libre' AND a.id_hotel=:id_hotel
       ");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
}


$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<?php
$i = 1;
foreach ($result as $r) {
    $id= $r->id;
    $id_client = $r->id_client;
    $idchambre = $r->idchambre;
    $id_res = $r->id_res;
    ?>
    <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo $r->nom_client ?></td>
        <td><?php echo $r->entreprise ?></td>
        <td><?php echo $r->num_ch ?></td>
        <td><?php echo dateAffiche($r->date_lib) ?></td>
        <td><?php echo NbJours($r->date_occ, $r->date_lib) ?></td>
        <td>
            <a href="impression/factureliberation.php?id_res=<?php echo $id_res; ?>&id=<?php echo $id; ?>" 
               title="Afficher le detail" target="_blank" class="btn btn-info btn-xs">
                <i class="fa fa-sign-in"></i> Détails
            </a>
        </td>
    </tr>
    <?php
    $i++;
}
?>