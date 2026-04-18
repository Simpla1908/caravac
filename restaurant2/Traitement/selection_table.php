<?php
session_start();
include '../bdd/connexion.php';
$json = array();
if (isset($_GET['table_id'])) {
    $table_id=$_GET['table_id'];

    //Update du num_com
    $requete = $bdd->prepare("SELECT id_client, code,designation,ordre FROM t_client WHERE id_client=:id_client");
    $requete->BindParam(':id_client', $table_id);
    $requete->execute();
    $client = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($client as $cl){
        $json['id_client'] = $cl->id_client;
        $json['code'] = $cl->code;
        $json['designation'] = $cl->designation;
        $json['ordre'] = $cl->ordre;
    }
}
echo json_encode($json);
