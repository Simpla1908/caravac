<?php
/**
 * Created by PhpStorm.
 * User: DEVAPP01
 * Date: 09/02/2017
 * Time: 14:02
 */
//INSERT T_MOTIF_TYPE
//Heberge
$hotel=$hotel_id;
$compagnie=$companie_id;
$requete=$bdd->prepare("INSERT INTO t_motif_type(type,visible,hotel_id)
                             VALUES(:type,:visible,:hotel_id)");
$type_tm='Heberge';
$visible_tm='1';
$requete->BindParam(':type', $type_tm);
$requete->BindParam(':visible', $visible_tm);
$requete->BindParam(':hotel_id', $hotel);
$requete->execute();
$tmotif_heberge_id=$bdd->lastInsertId();
//Resto
$requete=$bdd->prepare("INSERT INTO t_motif_type(type,visible,hotel_id)
                             VALUES(:type,:visible,:hotel_id)");
$type_tm='Resto';
$visible_tm='1';
$requete->BindParam(':type', $type_tm);
$requete->BindParam(':visible', $visible_tm);
$requete->BindParam(':hotel_id', $hotel);
$requete->execute();
$tmotif_resto_id=$bdd->lastInsertId();
//Caisse
$type_tm='Entree';
$visible_tm='0';
$requete->BindParam(':type', $type_tm);
$requete->BindParam(':visible', $visible_tm);
$requete->BindParam(':hotel_id', $hotel);
$requete->execute();
$tmotif_heberge_id=$bdd->lastInsertId();
//Resto
$requete=$bdd->prepare("INSERT INTO t_motif_type(type,visible,hotel_id)
                             VALUES(:type,:visible,:hotel_id)");
$type_tm='Sortie';
$visible_tm='0';
$requete->BindParam(':type', $type_tm);
$requete->BindParam(':visible', $visible_tm);
$requete->BindParam(':hotel_id', $hotel);
$requete->execute();
$tmotif_resto_id=$bdd->lastInsertId();
//Fin caisse
//INSERT T_MOTIF
//Heberge
$requete=$bdd->prepare("INSERT INTO t_motif(designation,hotel_id,type_id)
                             VALUES(:designation,:hotel_id,:type_id)");

$designation='Hebergement';
$requete->BindParam(':designation', $designation);
$requete->BindParam(':hotel_id', $hotel);
$requete->BindParam(':type_id',$tmotif_heberge_id);
$requete->execute();
//RESTO
$requete=$bdd->prepare("INSERT INTO t_motif(designation,hotel_id,type_id)
                             VALUES(:designation,:hotel_id,:type_id)");

$designation='Vente';
$requete->BindParam(':designation', $designation);
$requete->BindParam(':hotel_id', $hotel);
$requete->BindParam(':type_id',$tmotif_resto_id);
$requete->execute();
//MONNAIE
//USD
$requete=$bdd->prepare("INSERT INTO ` monnaie`(lib_monnaie,id_hotel,company_id)
                             VALUES(:lib_monnaie,:id_hotel,:company_id)");
$lib_monnaie='USD';
$requete->BindParam(':lib_monnaie', $lib_monnaie);
$requete->BindParam(':id_hotel', $hotel);
$requete->BindParam(':company_id',$compagnie);
$requete->execute();
//CDF
$requete=$bdd->prepare("INSERT INTO ` monnaie`(lib_monnaie,id_hotel,company_id)
                             VALUES(:lib_monnaie,:id_hotel,:company_id)");
$lib_monnaie='CDF';
$requete->BindParam(':lib_monnaie', $lib_monnaie);
$requete->BindParam(':id_hotel', $hotel);
$requete->BindParam(':company_id',$compagnie);
$requete->execute();
//USD&CDF
$requete=$bdd->prepare("INSERT INTO ` monnaie`(lib_monnaie,id_hotel,company_id)
                             VALUES(:lib_monnaie,:id_hotel,:company_id)");
$lib_monnaie='USD&CDF';
$requete->BindParam(':lib_monnaie', $lib_monnaie);
$requete->BindParam(':id_hotel', $hotel);
$requete->BindParam(':company_id',$compagnie);
$requete->execute();
//Client Occasionnel Insertion
$requete=$bdd->prepare("INSERT INTO t_client(nom_client,type,id_hotel)
                             VALUES(:nom_client,:type,:id_hotel)");
$type_cl='occasionnel';
$nom_client='Occasionnel';
$requete->BindParam(':nom_client',$nom_client );
$requete->BindParam(':type', $type_cl);
$requete->BindParam(':id_hotel',$hotel);
$requete->execute();

//Insertion dans t_reglage
$requete=$bdd->prepare("INSERT INTO t_reglage(remise,majoration,m_insert,m_affiche,tauxdollar,taux_op,tva,user_id,id_hotel,company_id)
                             VALUES(:remise,:majoration,:m_insert,:m_affiche,:tauxdollar,:taux_op,:tva,:user_id,:id_hotel,:company_id)");
$m_insert='USD';
$m_affiche='CDF';
$tauxdollar=1640;
$taux_op=1;
$tva=14;
$remise=5;
$majoration=0;
$requete->BindParam(':remise',$remise);
$requete->BindParam(':majoration',$majoration);
$requete->BindParam(':m_insert',$m_insert);
$requete->BindParam(':m_affiche', $m_affiche);
$requete->BindParam(':tauxdollar',$tauxdollar);
$requete->BindParam(':taux_op',$taux_op);
$requete->BindParam(':tva',$tva);
$requete->BindParam(':user_id',$user_id);
$requete->BindParam(':id_hotel', $hotel);
$requete->BindParam(':company_id',$compagnie);
$requete->execute();

//Création depot
$requete=$bdd->prepare("INSERT INTO t_depot(libelle,hotel_id)VALUES(:libelle,:hotel_id)");
$libelle='Central';
$etat=0;
$requete->BindParam(':libelle',$libelle );
$requete->BindParam(':hotel_id',$hotel);
$requete->execute();
$depot_id=$bdd->lastInsertId();

//Création pos
$requete=$bdd->prepare("INSERT INTO  t_sousresto(libelle,depot_id,hotel_id,etat)VALUES(:libelle,:depot_id,:hotel_id,:etat)");
$requete->BindParam(':libelle',$libelle );
$requete->BindParam(':depot_id',$depot_id);
$requete->BindParam(':hotel_id',$hotel);
$requete->BindParam(':etat',$etat);
$requete->execute();

//Création POS
$requete=$bdd->prepare("INSERT INTO t_depot(libelle,hotel_id)VALUES(:libelle,:hotel_id)");
$libelle='POS';
$etat=1;
$requete->BindParam(':libelle',$libelle );
$requete->BindParam(':hotel_id',$hotel);
$requete->execute();
$depot_id=$bdd->lastInsertId();

//Création pos
$statut=0;
$requete=$bdd->prepare("INSERT INTO  t_sousresto(libelle,depot_id,hotel_id,etat,statut)VALUES(:libelle,:depot_id,:hotel_id,:etat,:statut)");
$requete->BindParam(':libelle',$libelle );
$requete->BindParam(':depot_id',$depot_id);
$requete->BindParam(':hotel_id',$hotel);
$requete->BindParam(':etat',$etat);
$requete->BindParam(':statut',$statut);
$requete->execute();

//Insertion dans resconfig
//Hebergement
$requete=$bdd->prepare("INSERT INTO resconfig(m_insert,m_affich,taux,tva,module_id,site_id)
                             VALUES(:m_insert,:m_affich,:taux,:tva,:module_id,:site_id)");
$module_id=23;
$requete->BindParam(':m_insert',$m_insert);
$requete->BindParam(':m_affich', $m_affiche);
$requete->BindParam(':taux',$tauxdollar);
$requete->BindParam(':tva',$tva);
$requete->BindParam(':module_id',$module_id);
$requete->BindParam(':site_id', $hotel);
$requete->execute();
////RH
$requete=$bdd->prepare("INSERT INTO resconfig(m_insert,m_affich,taux,tva,module_id,site_id,fuseauhoraire)
                             VALUES(:m_insert,:m_affich,:taux,:tva,:module_id,:site_id,:fuseauhoraire)");
$module_id=26;
$fuseauhoraire='Africa/Kinshasa';
$requete->BindParam(':m_insert',$m_insert);
$requete->BindParam(':m_affich', $m_affiche);
$requete->BindParam(':taux',$tauxdollar);
$requete->BindParam(':tva',$tva);
$requete->BindParam(':module_id',$module_id);
$requete->BindParam(':site_id', $hotel);
$requete->BindParam(':fuseauhoraire',$fuseauhoraire);
$requete->execute();

$requete=$bdd->prepare("INSERT INTO resdeclaration(code,lib,pourtrav,poursoc,site_id)
                             VALUES(:code,:lib,:pourtrav,:poursoc,:site_id)");
$code='IPR';
$lib='DECLARATION IPR';
$pourtrav=15;
$poursoc=0;
$requete->BindParam(':code',$code);
$requete->BindParam(':lib', $lib);
$requete->BindParam(':pourtrav',$pourtrav);
$requete->BindParam(':poursoc',$poursoc);
$requete->BindParam(':site_id', $hotel);
$requete->execute();

$code='INSS';
$lib='DECLARATION INSS';
$pourtrav=28;
$poursoc=18;
$requete->BindParam(':code',$code);
$requete->BindParam(':lib', $lib);
$requete->BindParam(':pourtrav',$pourtrav);
$requete->BindParam(':poursoc',$poursoc);
$requete->BindParam(':site_id', $hotel);
$requete->execute();

$code='INPP';
$lib='DECLARATION INPP';
$pourtrav=0;
$poursoc=18;
$requete->BindParam(':code',$code);
$requete->BindParam(':lib', $lib);
$requete->BindParam(':pourtrav',$pourtrav);
$requete->BindParam(':poursoc',$poursoc);
$requete->BindParam(':site_id', $hotel);
$requete->execute();
//Facturation 
$requete=$bdd->prepare("INSERT INTO resconfig(m_insert,m_affich,taux,tva,module_id,site_id)
                             VALUES(:m_insert,:m_affich,:taux,:tva,:module_id,:site_id)");
$module_id=27;
$requete->BindParam(':m_insert',$m_insert);
$requete->BindParam(':m_affich', $m_affiche);
$requete->BindParam(':taux',$tauxdollar);
$requete->BindParam(':tva',$tva);
$requete->BindParam(':module_id',$module_id);
$requete->BindParam(':site_id', $hotel);
$requete->execute();

 

