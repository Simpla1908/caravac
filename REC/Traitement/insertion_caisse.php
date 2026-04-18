<?php
$motif_id =$motif_id_resto;
if($montant_cdf>0){
    $requete = $bdd->prepare("INSERT INTO t_operation (libelle,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                           montantUSD,numBordereau,mode_operation,session_id,motif_id,user_vers,user_id,hotel_id,type)
			                 VALUES(:libelle,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                            :motif_id,:user_vers,:user_id,:hotel_id,:type)");
    $type = "entree";
    $libelle = "Heberge";
    $beneficiaire = "Client";
    $type_caisse = 'normal';
    $numBordereau = '';
    $session_id = 1;
    $libelle1='entreecdf';
    $mont_commandeUSD_null=0;
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':beneficiaire', $beneficiaire);
    $requete->BindParam(':date_bon', $date_com);
    $requete->BindParam(':date_heure_bon', $date_h_com);
    $requete->BindParam(':montantFC', $mont_commandeFC2);
    $requete->BindParam(':montantUSD', $mont_commandeUSD_null);
    $requete->BindParam(':numBordereau', $numBordereau);
    $requete->BindParam(':mode_operation', $type_caisse);
    $requete->BindParam(':session_id', $session_id);
    $requete->BindParam(':motif_id', $motif_id);
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':type', $type);
    $requete->execute();
    $id_operation = $bdd->lastInsertId();
    $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
    $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon WHERE idoperation=:idoperation");
    $requete->BindParam(':numBon', $numBon);
    $requete->BindParam(':idoperation', $id_operation);
    $requete->execute();
    $num_cmd+=1;
    setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
}
if($montant_usd>0){
    $requete = $bdd->prepare("INSERT INTO t_operation (libelle,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                           montantUSD,numBordereau,mode_operation,session_id,motif_id,user_vers,user_id,hotel_id,type)
			                 VALUES(:libelle,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                            :motif_id,:user_vers,:user_id,:hotel_id,:type)");
    $type = "entree";
    $libelle = "Heberge";
    $beneficiaire = "Client";
    $type_caisse = 'normal';
    $numBordereau = '';
    $session_id = 1;
    $libelle1='entreeusd';
    $mont_commandeFC2_null=0;
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':beneficiaire', $beneficiaire);
    $requete->BindParam(':date_bon', $date_com);
    $requete->BindParam(':date_heure_bon', $date_h_com);
    $requete->BindParam(':montantFC', $mont_commandeFC2_null);
    $requete->BindParam(':montantUSD', $mont_commandeUSD);
    $requete->BindParam(':numBordereau', $numBordereau);
    $requete->BindParam(':mode_operation', $type_caisse);
    $requete->BindParam(':session_id', $session_id);
    $requete->BindParam(':motif_id', $motif_id);
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':type', $type);
    $requete->execute();
    $id_operation = $bdd->lastInsertId();
    $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
    $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon WHERE idoperation=:idoperation");
    $requete->BindParam(':numBon', $numBon);
    $requete->BindParam(':idoperation', $id_operation);
    $requete->execute();
    $num_cmd+=1;
    setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
}

