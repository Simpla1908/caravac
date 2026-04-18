<?php
include('../bdd/connexion.php');
    $date_heure_bon = trim($_POST['date_heure_bon'], ' ');
    $motif_id = trim($_POST['motif_id'], ' ');
    $libelle = trim($_POST['libelle'], ' ');
    $beneficiaire = trim($_POST['beneficiaire'],' ');
    $montantUSD = trim($_POST['montantUSD'],' ');
    $montantFC = trim($_POST['montantFC'], ' ');
    $numBordereau = trim($_POST['numBordereau'], ' ');
    
    $transpostion_sortie = explode('/', $date_heure_bon);
    $jrsor = $transpostion_sortie[0];
    $moisor = $transpostion_sortie[1];
    $annee1sor = $transpostion_sortie[2];
    $transpostion_sortie1 = explode(' ', $annee1sor);
    $anneesor = $transpostion_sortie1[0];
    $heuresor = $transpostion_sortie1[1];
    $date_heure_bon = $anneesor . '-' . $moisor . '-' . $jrsor . ' ' . $heuresor;
    $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
   
    $entree = $_POST['entree'];
    $sortie = $_POST['sortie'];
    $idoperation = $_POST['idoperation'];
    
    if (empty($numBordereau)) {
        $type_caisse='normal';
    }  else {
         $type_caisse='banque';
    }
    $msg = 'vide';
    if (empty($date_heure_bon) || empty($motif_id) || empty($libelle) || empty($beneficiaire)) {
        $json['message_vide']=$msg;
    
    } elseif (empty($montantUSD)&& empty($montantFC)) {
         $json['message_vide']=$msg;
    } else {
            //Insertion entree
                if (($entree == "entree") && ($sortie == "s")) {
                
                    $requete = $bdd->prepare("UPDATE t_operation SET libelle=:libelle,beneficiaire=:beneficiaire,motif_id=:motif_id,date_heure_bon=:date_heure_bon,date_bon=:date_bon,numBordereau=:numBordereau,mode_operation=:mode_operation,montantFC=:montantFC,montantUSD=:montantUSD WHERE idoperation=:idoperation");
                    
                    $requete->BindParam(':libelle', $libelle);
                    $requete->BindParam(':beneficiaire', $beneficiaire);
                    $requete->BindParam(':motif_id', $motif_id );
                    $requete->BindParam(':date_heure_bon', $date_heure_bon );
                    $requete->BindParam(':date_bon',$date_bon);
                    $requete->BindParam(':numBordereau',$numBordereau );
                    $requete->BindParam(':mode_operation', $type_caisse);
                    $requete->BindParam(':montantFC',$montantFC );
                    $requete->BindParam(':montantUSD', $montantUSD);
                    $requete->BindParam(':idoperation', $idoperation);
                    
                    $requete->execute();
                    $_SESSION['operation_last_id']=$idoperation;
                    $json['message_succes']= "succes";
                    //echo"L'enrégistrement s'est effectué avec succès!";
                    
                } 
            }
  echo json_encode($json);