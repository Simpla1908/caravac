<?php

session_start();
$json = array();
include '../bdd/connexion.php';
include '../Traitement/verif_code_tab.php';
if (isset($_POST['codetable']) && isset($_POST['Destable'])) {
    $code = $_POST['codetable'];
    $designation = $_POST['Destable'];
    $table_id = $_POST['idtable'];
    $ordre = $_POST['ordre'];
    $statut = "libre";
    $type = "table";
    $id_respo = 1;
    if ($table_id == 0) {
        if (!empty($code) && !empty($designation)) {
            $verif_code = verif_code_tab($code);
            if ($verif_code == 0) {
                $requete = $bdd->prepare("INSERT INTO  t_client(code,designation,statut,type,id_hotel,id_sousresto,ordre)
                    VALUES(:code,:designation,:statut,:type,:id_hotel,:id_sousresto,:ordre)");

                $requete->BindParam(':code', $code);
                $requete->BindParam(':designation', $designation);
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':type', $type);
                $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
                $requete->BindParam(':ordre',$ordre);
                $requete->execute();
//  echo 'Enregistrement effectue avec succes';
                $json['message_succes'] = 'succes';
                $_POST['codetable'] = '';
                $_POST['Destable'] = '';
            } else {
//        echo 'ce code existe deja';
                $json['message_erreur'] = 'erreur';
                $json['message_update'] = 'save';
                $json['code_value'] = $code;
            }
        } else {
            //        echo 'remplissez tous les champs';
            $json['message_vide'] = 'vide';
        }
    }  else {
       //Modification
        if (!empty($code) && !empty($designation)) {
            $verif_code = verif_code_tab($code);
            
                $requete = $bdd->prepare("UPDATE t_client SET code =:code, designation =:designation,ordre=:ordre WHERE id_client=:id_client");
                $requete->BindParam(':code', $code);
                $requete->BindParam(':designation', $designation);
                $requete->BindParam(':id_client', $table_id);
                $requete->BindParam(':ordre',$ordre);
                $requete->execute();
//  echo 'Enregistrement effectue avec succes';
                $json['message_succes'] = 'succes';
                $json['message_update'] = 'update';
                $_POST['codetable'] = '';
                $_POST['Destable'] = '';
            
        } else {
            //        echo 'remplissez tous les champs';
            $json['message_vide'] = 'vide';
        }
        
        
    }
}
echo json_encode($json);
