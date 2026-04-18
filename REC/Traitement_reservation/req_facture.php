<?php

$requete = $bdd->prepare("
   SELECT a.id_res,a.type,a.num_reserv,a.dte,a.dte_a,a.dte_s,b.type AS type_fac,b.date_edition,b.mont_ttc_remise,
        b.taux,b.tva,b.monnaie,b.id_user,c.tarif_ch,e.montant AS mont_paye,e.montantusd,e.montantcdf,e.taux AS taux_paie,b.remise,
        e.justification,f.lib,g.num_ch,h.nom_client,i.nom_user,j.entreprise AS nom_respo,e.company_id,a.id_hotel
  FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,
       t_reglement AS d, paiement AS e,t_mode_reglement AS f,
       t_chambre AS g,t_client AS h,t_utilisateur AS i,t_responsable AS j
  WHERE a.id_res=b.id_res AND b.id_fact=c.idfact 
        AND b.id_fact=d.id_fact AND d.id_regl=e.regl_id 
        AND e.id_mode_regl=f.id_mode_regl 
        AND c.idchambre=g.id_ch
        AND b.id_client=h.id_client
        AND b.id_user=i.id_user
        AND h.id_respo=j.id_respo
        AND a.id_res=:id_res
      ");
$requete->BindParam(':id_res',$id_res);
$requete->execute();
$result=$requete->fetchAll(PDO::FETCH_OBJ);


