<?php
function paiement($id_fact,$numero,$dte, $id_user, $id_hotel,$company_id,$montant,$montantusd,$montantcdf,$taux_paie,$remise,$mode,$justification,$id_monnaie,$bdd) {
    /* Insertion dans t_reglement */
    $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,dte,id_user,id_hotel)
                                    VALUES(:numero,:id_fact,:dte,:id_user,:id_hotel)");
    $requete->BindParam(':numero',$numero);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $regl_id = $bdd->lastInsertId();
    /* Fin d'Insertion dans t_reglement */
    /* Insertion dans paiement */
    $requete = $bdd->prepare("INSERT INTO  paiement (montant,remise,justification,id_mode_regl,id_monnaie,regl_id,site_id,company_id,montantusd,montantcdf,taux)
                                    VALUES(:montant,:remise,:justification,:id_mode_regl,:id_monnaie,:regl_id,:id_hotel,:company_id,:montantusd,:montantcdf,:taux)");
    $requete->BindParam(':montant',$montant);
    $requete->BindParam(':remise', $remise);
    $requete->BindParam(':justification', $justification);
    $requete->BindParam(':id_mode_regl', $mode);
    $requete->BindParam(':id_monnaie', $id_monnaie);
    $requete->BindParam(':regl_id', $regl_id);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':company_id', $company_id);
    $requete->BindParam(':montantusd',$montantusd);
    $requete->BindParam(':montantcdf',$montantcdf);
    $requete->BindParam(':taux',$taux_paie);
    $requete->execute();
    $paie_id = $bdd->lastInsertId();
    return $paie_id;
}
