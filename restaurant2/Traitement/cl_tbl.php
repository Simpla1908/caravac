<?php
// Initialisation de la session
// session_start();
include('bdd/connexion.php');
$client_occasionnel ='';
if(in_array('AR6', $_SESSION['actions']['code_actions'])){
$type_cl = 'occasionnel';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl  AND cl.pseudo_supp=0");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$client_occasionnel = $requete->fetchAll(PDO::FETCH_OBJ);
$type_cl = 'client';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.pseudo_supp=0");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ); 
}elseif(in_array('VSCQOC', $_SESSION['actions']['code_actions'])){
$type_cl = 'client';
$requete = $bdd->prepare("SELECT a.*,c.*
            FROM t_facture a,t_client c
             WHERE a.id_client=c.id_client
                   AND c.id_hotel=:hotel_id
                   AND c.type='client'
                   AND c.en_attente=1 
                   AND c.pseudo_supp=0
                   AND a.etat_cmd=1");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ);   
}
