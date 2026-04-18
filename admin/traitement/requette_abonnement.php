<?php
$req="SELECT *,h.id_hotel AS hotel,h.etat AS etat_hotel,CONCAT (u.nom_user,' ',u.prenom_user) AS resposable,mc.id AS idmodule,mc.id AS idmodcomp
                                FROM t_modulecompany AS mc,module AS m,t_hotel AS h,prix AS p,souscription AS s, t_company AS c, t_utilisateur AS u
                                    WHERE m.id=mc.module_id 
                                          AND h.id_hotel=mc.site_id
                                          AND mc.prix_id=p.id
                                          AND mc.souscription_id=s.id
                                          AND mc.company_id=c.id_c
                                          AND u.company_id=c.id_c
                                          AND mc.site_id=:id_c";

$req_moduleBysite="SELECT m.nom,mc.id AS idmodule,mc.montantmodule,mc.etat_module,mc.paye
                                FROM t_modulecompany AS mc,module AS m,t_hotel AS h
                                    WHERE m.id=mc.module_id 
                                          AND h.id_hotel=mc.site_id
                                          AND mc.site_id=:id_c";

$req_factureByhotel="SELECT mc.id AS module_id, m.nom,MONTHNAME(f.date_echeance_old) AS nom_mois,f.id_hotel,f.id_fact,f.num_fact ,f.date_edition,f.date_echeance,f.etat AS etat_fac,f.mont_ttc,ho.nom_hotel 
              FROM t_hotel AS ho,t_facture AS f,module AS m,t_modulecompany AS mc 
              WHERE ho.id_hotel=mc.site_id AND f.modulecompagny=mc.id AND mc.module_id=m.id  AND f.id_hotel=:id_c ORDER BY f.date_echeance DESC";

$req_facture_globale="SELECT m.nom,mc.id AS idmodule,mc.montantmodule,mc.etat_module,mc.paye,mc.date_activ,mc.nbreuser,s.libelle,f.id_fact,f.date_echeance_old,f.etat AS etat_fac,*
                                FROM t_modulecompany AS mc,module AS m,t_hotel AS h,souscription AS s, t_facture AS f
                                    WHERE m.id=mc.module_id 
                                          AND h.id_hotel=mc.site_id
                                          AND s.id=mc.souscription_id
                                          AND f.modulecompagny=mc.id
                                          AND f.etat='Brouillon'
                                          AND mc.site_id=:id_c
                                          ";


$req_facture_simple_detailsByhotel="SELECT c.id_c,c.nom_c,c.adresse_c,CONCAT (u.nom_user,' ',u.prenom_user) AS resposable,u.telephone_user, mc.id AS module_id, m.nom,MONTHNAME(f.date_echeance_old) AS nom_mois,f.id_hotel,f.id_fact,f.num_fact ,f.date_edition,f.date_echeance,f.etat AS etat_fac,f.mont_ttc,ho.nom_hotel 
                                    FROM t_hotel AS ho,t_facture AS f,module AS m,t_modulecompany AS mc,t_company AS c,t_utilisateur AS u
                                    WHERE ho.id_hotel=mc.site_id 
                                    AND f.modulecompagny=mc.id
                                    AND mc.module_id=m.id
                                    AND ho.company_id=c.id_c
                                    AND u.company_id=c.id_c
                                    AND f.id_fact=:id_c GROUP BY f.id_fact ";
$req_fac_bymodule="SELECT CONCAT (u.nom_user,' ',u.prenom_user) AS resposable,u.telephone_user,m.nom,mc.id AS idmodule,mc.montantmodule,mc.etat_module,mc.paye,mc.date_activ,mc.nbreuser,s.libelle,f.*,f.etat AS etat_fac,h.*,c.id_c
                        FROM t_modulecompany AS mc,module AS m,t_hotel AS h,souscription AS s, t_facture AS f, t_company AS c, t_utilisateur AS u
                                    WHERE m.id=mc.module_id 
                                          AND h.id_hotel=mc.site_id
                                          AND s.id=mc.souscription_id
                                          AND f.modulecompagny=mc.id
                                          AND mc.company_id=c.id_c
                                          AND u.company_id=c.id_c
                                          AND mc.site_id=:site_id
                                          AND f.id_fact=:id_fact
                                          GROUP BY f.id_fact";

$req_modulecompanyANDmoduleAndhotel="SELECT mc.id AS idmodule,m.nom,mc.montantmodule,mc.etat_module,mc.dte_blocage,h.nom_hotel
                                        FROM t_modulecompany AS mc,module AS m,t_hotel AS h
                                            WHERE m.id=mc.module_id 
                                                  AND h.id_hotel=mc.site_id";

$req_listmodulesAdesactiver="SELECT mc.id AS idmodule,m.nom,mc.montantmodule,mc.etat_module,mc.dte_blocage,h.nom_hotel
                                        FROM t_modulecompany AS mc,module AS m,t_hotel AS h
                                            WHERE m.id=mc.module_id 
                                                  AND h.id_hotel=mc.site_id
                                                  AND CURDATE() >= mc.dte_blocage";


$req_fac_global_parsite="SELECT s.libelle,h.nom_hotel,h.adresse_hotel,m.nom,COUNT(m.id)AS module,SUM(f.mont_ttc) AS montant,MONTHNAME(f.date_echeance_old) AS nom_mois,f.* FROM t_modulecompany AS mc,module AS m,t_hotel AS h,souscription AS s, t_facture AS f WHERE m.id=mc.module_id AND h.id_hotel=mc.site_id AND s.id=mc.souscription_id AND f.modulecompagny=mc.id AND f.id_hotel=:id_hotel GROUP BY f.date_echeance";


$req_details_factureglobal="SELECT s.libelle,h.nom_hotel,h.adresse_hotel,m.nom,mc.montantmodule,mc.nbreuser,f.mont_ttc AS montant,MONTHNAME(f.date_echeance_old) AS nom_mois,f.etat AS etat_fac,f.* 
                                FROM t_modulecompany AS mc,module AS m,t_hotel AS h,souscription AS s, t_facture AS f 
                                    WHERE m.id=mc.module_id AND h.id_hotel=mc.site_id AND s.id=mc.souscription_id AND f.modulecompagny=mc.id  AND f.id_hotel=:id_hotel ORDER BY f.date_echeance DESC ";

$req_details_factureglobal_mois="SELECT s.libelle,h.nom_hotel,h.adresse_hotel,m.nom,mc.montantmodule,mc.nbreuser,f.mont_ttc AS montant,MONTHNAME(f.date_echeance_old) AS nom_mois,f.etat AS etat_fac,f.* 
                                FROM t_modulecompany AS mc,module AS m,t_hotel AS h,souscription AS s, t_facture AS f 
                                    WHERE m.id=mc.module_id AND h.id_hotel=mc.site_id AND s.id=mc.souscription_id AND f.modulecompagny=mc.id AND MONTHNAME(f.date_echeance_old)=:mois  AND f.id_hotel=:id_hotel ";


$req_details_factureglobal1="SELECT s.libelle,h.nom_hotel,h.adresse_hotel,m.nom,mc.montantmodule,mc.nbreuser,f.mont_ttc AS montant,MONTHNAME(f.date_echeance_old) AS nom_mois,f.etat AS etat_fac,f.* 
                                FROM t_modulecompany AS mc,module AS m,t_hotel AS h,souscription AS s, t_facture AS f 
                                    WHERE m.id=mc.module_id AND h.id_hotel=mc.site_id AND s.id=mc.souscription_id AND f.modulecompagny=mc.id AND f.etat IN ('Brouillon','Ouverte') AND f.id_hotel=:id_hotel";