<?php  
if (!isset($_SESSION)){
    session_start();
}
include '../bdd/connexion.php';
$tables=array();
if ($_SESSION['type_user']==1||$_SESSION['type_user']==5){ 
    $type_cl = 'table';
    $requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id 
    AND cl.type=:type_cl AND cl.pseudo_supp=0
     ORDER BY cl.en_attente DESC,cl.ordre ASC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':type_cl', $type_cl);
    $requete->execute();
    $tables = $requete->fetchAll(PDO::FETCH_OBJ);  
}else{
    $type_cl = 'table';
    //SELECTION TABLES EN ATTENTE DU SERVEUR
    $requete = $bdd->prepare("SELECT cl.* FROM  t_client AS cl,t_facture AS fa 
    WHERE cl.id_hotel=:hotel_id 
    AND cl.type=:type_cl 
    AND cl.pseudo_supp=0
    AND cl.id_client=fa.id_client
    AND cl.en_attente=1
    AND fa.id_user=:id_user
    AND fa.etat_cmd=1
    ORDER BY cl.en_attente DESC,cl.ordre ASC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':type_cl', $type_cl);
    $requete->BindParam(':id_user', $_SESSION['id_user']);
    $requete->execute();
    $tables_attente = $requete->fetchAll(PDO::FETCH_OBJ);  
    //SELECTION TABLES LIBRES
    $requete = $bdd->prepare("SELECT * FROM  t_client AS cl
    WHERE cl.id_hotel=:hotel_id 
    AND cl.type=:type_cl 
    AND cl.pseudo_supp=0
    AND cl.en_attente=0
    ORDER BY cl.en_attente DESC,cl.ordre ASC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':type_cl', $type_cl);
    $requete->execute();
    $tables_libres = $requete->fetchAll(PDO::FETCH_OBJ);  
    $tables = array_merge($tables_attente, $tables_libres);
}
//Pour la recherche
$_SESSION['TableResto'] = array();
$_SESSION['TableResto']['name'] = array();
$_SESSION['TableResto']['content'] = array();
//Pour la recherche
foreach ($tables as $tbl):
    $etat_table=$tbl->statut;
    $designation=$tbl->designation;
    $id_sousresto=$tbl->idsousdepotfact;
    $user_attente=$tbl->user_attente;
    $fusion=$tbl->fusion;
    if($tbl->type=='client')$designation=$tbl->nom_client;

    if($tbl->en_attente==1){
        $etat_table='occupe';    
    }
$other="";
if ($tbl->statut == 'reserve') {
           $other='<span
                class="label label-warning">'.$tbl->statut.'</span>';
}elseif($tbl->en_attente==1) {
            $other='<span
                class="label label-danger">occupe</span>';
            }else{
                $other='<span
                class="label label-success">'.$tbl->statut.'</span>';
             }

array_push($_SESSION['TableResto']['name'],$designation);

    $_SESSION['TableResto']['content'][$designation]='<a class="btn btn-app client_table2"
       id1="'.$tbl->id_client.'"
       id2="'.$designation.'"
       fusion="'.$fusion.'"
       nbrcouvert ="'.$tbl->nbrcouvert .'"
       etat_table="'.$etat_table.'"
       id_sousresto="'.$id_sousresto.'"
       user_attente="'.$user_attente.'">
        '.ucfirst($designation).'<br>'.$other.'</a>';
echo $_SESSION['TableResto']['content'][$designation];
endforeach; ?>