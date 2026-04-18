
        <?php

        /*
         * =======================================================================
         * FILE NAME:        cptjournal.php
         * DATE CREATED:    18-04-2019
         * FOR TABLE:       cptjournal
         * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
         * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
         * =======================================================================
         */

        if (!defined('VALID_DIR'))
            die('You are not allowed to execute this file directly');

        include(APP_FOLDER . '/models/objects/cptjournal.php');
        include(APP_FOLDER . '/models/objects/cptecritures.php');
        include(APP_FOLDER . '/models/objects/cptdetailsecritures.php');
        include(APP_FOLDER . '/models/objects/cptexercice.php');
        include_once(APP_FOLDER . '/models/objects/compteur.php');


        class tresorerie_controller {

            public $tresorerie_model;

            public function __construct() {
               // $this->tresorerie_model = new tresorerie_model();
            }

            public function invoke_tresorerie() {
                 $cptecritureso = new cptecritures_model();
                 $cptdetailsecritureso = new cptdetailsecritures_model();
                 $cptexerciceo = new cptexercice_model();
                 $compteurobj = new compteur_model();

               if (get('do') == 'dashboard') {
                 include(APP_FOLDER . '/views/admin/tresorerie/Dashboard.php');   
                }elseif (get('do') == 'bon_sorti_paiement') {
                 $bdd=ConnectWithUtf();
                 PlanComptablePourSelect($bdd);
                 $monnaie = get('monnaie');
                 if($monnaie=='USD'){
                 $libelle1 = 'sortiecdf';
                 }else{
                 $libelle1 = 'sortieusd'; 
                 }
                 $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                 $numBon = 'BS/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); 
                 include(APP_FOLDER . '/views/admin/tresorerie/bon_sorti_paiement.php');   
                }elseif (get('do') == 'synthesecaisse') {
                include(APP_FOLDER . '/views/admin/tresorerie/synthesecaisse.php');   
                }elseif (get('do') == 'verifgeneresynthese') {
                $json = array();
                $json['s'] = False;
                $json['message'] = '';
                $devise=post('devise');
                $dte1=post('dte1');
                $dte2=post('dte2');
                $devise=post('devise');
                 if ($dte1 == '') {
                    $json['message'] = json_error2("Veuillez choisir la 1ere date!");
                }  elseif ($dte2 == '') {
                    $json['message'] = json_error2("Veuillez saisir la 2ieme date!");
                }elseif($devise == ''){
                    $json['message'] = json_error2("Veuillez choisir la devise!");
                }else{
                 $json['s'] = TRUE;
                }
                echo json_encode($json);
               }elseif (get('do') == 'displaysynthesecaisse') {
                $bdd=ConnectWithUtf();
                include(APP_FOLDER . '/views/admin/tresorerie/resultgeneresynthesecaisse.php');   
                }
                elseif (get('do') == 'demandepaiement') {
                $bdd=HDB::hus();
                $statut="attente";
                $requete = $bdd->prepare("SELECT a.mode,a.num_cmd,a.taux, a.fact1,a.id_fact,a.num_fact,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,
                                    b.id_client,b.nom_entreprise,SUM(c.prix * c.qte) AS tot_cmd
                                        FROM  t_facture AS a, t_client AS b, lignes_commandes AS c
                                        WHERE a.id_client=b.id_client
                                        AND a.id_fact=c.commande_id 
                                        AND a.type='achat'
                                        AND a.id_hotel=:hotel_id AND a.statut_bon=:statut
                                        GROUP BY a.num_fact");
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':statut', $statut);
                $requete->execute();
                $operations = $requete->fetchAll(PDO::FETCH_OBJ);
                include(APP_FOLDER . '/views/admin/tresorerie/demandepaiement.php');   
                }elseif (get('do') == 'genererationbondecaisse') {
                 $json = array();
                 $bdd=HDB::hus();
                 $typecasse=get('typecasse');
                 $monnaie=get('monnaie');
                 if($typecasse=='entree'){
                 if($monnaie=="fc"){
                 $libelle1 = 'entreecdf';
                 }else{
                 $libelle1 = 'entreeusd';
                 }
                 $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                 $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT);
                 }else{
                 if($monnaie=="fc"){
                 $libelle1 = 'sortiecdf';
                 }else{
                 $libelle1 = 'sortieusd';
                 }
                 $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                 $numBon = 'BS/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT);
                 }
                 $json['num_cmd'] =$num_cmd;
                 $json['numBon'] =$numBon;
                echo json_encode($json); 
                }
                elseif (get('do') == 'encaissement') {
                 $bdd=ConnectWithUtf();
                 PlanComptablePourSelect($bdd);
                 $libelle1 = 'entreecdf';
                 $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                 $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); 
                 include(APP_FOLDER . '/views/admin/tresorerie/encaissement.php');   
                }elseif (get('do') == 'listencaissement'||get('do') == 'flistencaissement') {
                     $bdd=ConnectWithUtf();
                     include('soldestresorerie.php');
                     $type="entree";
                    if(get('do') == 'listencaissement'){
                    $monnaie="CDF";
                    $datedebut =date('Y-m-d');
                    $datefin=date('Y-m-d');
                    $result=Getlisttresorerie($datedebut,$datefin,$type,$_SESSION['idsite'],$bdd); 
                    include(APP_FOLDER . '/views/admin/tresorerie/listencaissement.php');   
                    }else if(get('do') == 'flistencaissement'){
                    $monnaie=post('monnaie');
                     /* Conversion date1 */
                    $transpostion_date1 = explode('/',post('dte1'));
                    $jour = $transpostion_date1[0];
                    $mois = $transpostion_date1[1];
                    $annee = $transpostion_date1[2];
                    $datedebut = $annee . '-' . $mois . '-' . $jour;
                    /* Conversion date2 */
                    $transpostion_date2 = explode('/',post('dte2'));
                    $jour2 = $transpostion_date2[0];
                    $mois2 = $transpostion_date2[1];
                    $annee2 = $transpostion_date2[2];
                    $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
                    $result =Getlisttresorerie($datedebut,$datefin,$type,$_SESSION['idsite'],$bdd); 
                    include(APP_FOLDER . '/views/admin/tresorerie/datasencaissement.php'); 
                    }

                }elseif (get('do') == 'decaissement') {
                 $bdd=ConnectWithUtf();
                 PlanComptablePourSelect($bdd);
                 $libelle1 = 'sortiecdf';
                 $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                 $numBon = 'BS/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); 
                 include(APP_FOLDER . '/views/admin/tresorerie/decaissement.php');   
                }elseif (get('do') == 'listdecaissement'||get('do') == 'flistdecaissement') {
                    $bdd=ConnectWithUtf();
                    include('soldestresorerie.php');
                    $type="sortie";
                    if(get('do') == 'listdecaissement'){
                    $monnaie="CDF";
                    $datedebut =date('Y-m-d');
                    $datefin=date('Y-m-d');
                    $result=Getlisttresorerie($datedebut,$datefin,$type,$_SESSION['idsite'],$bdd); 
                    include(APP_FOLDER . '/views/admin/tresorerie/listdecaissement.php');   
                    }else if(get('do') == 'flistdecaissement'){
                    $monnaie=post('monnaie');
                     /* Conversion date1 */
                    $transpostion_date1 = explode('/',post('dte1'));
                    $jour = $transpostion_date1[0];
                    $mois = $transpostion_date1[1];
                    $annee = $transpostion_date1[2];
                    $datedebut = $annee . '-' . $mois . '-' . $jour;
                    /* Conversion date2 */
                    $transpostion_date2 = explode('/',post('dte2'));
                    $jour2 = $transpostion_date2[0];
                    $mois2 = $transpostion_date2[1];
                    $annee2 = $transpostion_date2[2];
                    $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
                    $result =Getlisttresorerie($datedebut,$datefin,$type,$_SESSION['idsite'],$bdd); 
                    include(APP_FOLDER . '/views/admin/tresorerie/datasdecaissement.php'); 
                    }
                }elseif (get('do') == 'encaissementpro') {
                if ($_POST) {
                $bdd=ConnectWithUtf();
                $json = array();
                $json['s'] = false;
                $json['message'] = '';
                $date_heure_bon = post('date_heure_bon');
                $cpte_id =post('cpte_id');
                $libelle = post('libelle');
                $beneficiaire =post('beneficiaire');
                $monnaie =post('monnaie');
                $montant =post('montant');
                $cpte_num=post('num');
                $compteprov=post('compteprov');
                $format=(string)$cpte_num;
                $longcompte=strlen($format);
                if (empty($date_heure_bon) || empty($cpte_id) || empty($libelle)|| empty($monnaie)|| empty($montant)) {
                $json['message'] = json_error2('Veuillez remplir les champs vides!');
                } else {
                //transpostion date
                $transpostion_sortie = explode('/', $date_heure_bon);
                $jrsor = $transpostion_sortie[0];
                $moisor = $transpostion_sortie[1];
                $annee1sor = $transpostion_sortie[2];
                $transpostion_sortie1 = explode(' ', $annee1sor);
                $anneesor = $transpostion_sortie1[0];
                $heuresor = $transpostion_sortie1[1];
                $date_heure_bon = $anneesor . '/' . $moisor . '/' . $jrsor . ' ' . $heuresor;
                $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
                $type_caisse="normal";
                $numBordereau="";
                $entree = "entree";
                $devise="";
                //fin transposistion    
                  if ($monnaie == "usd") {
                        $montantUSD =$montant;
                        $montantFC = 00;
                        $libelle1 = 'entreeusd';
                        $monnaie_achat='USD';
                        $devise='USD';
                    } else {
                        $montantFC =$montant;
                        $montantUSD = 00;
                        $libelle1 = 'entreecdf';
                        $monnaie_achat='CDF';
                        $devise='CDF';
                    }
                    // $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                    // $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
                     $num_cmd =post('num_cmd');
                     $numBon =post('numBon');
                     //COMPTA
                    $dte=date('Y-m-d');
                    $dtetime=date('Y-m-d H:i:s');
                    $dteaff=$dte;
                     //reference auto
                    $prefnum='JC';
                    $num_jour = getnumerotation($_SESSION['id_hotel'],$prefnum, $bdd);
                    $reference= $prefnum . str_pad($num_jour, 4, "0", STR_PAD_LEFT);
                    //reference auto
                    $journal_id=3;
                    $psedo=0;
                    $exercice_id=$_SESSION['exercice_id'];
                    $user_id=$_SESSION['id_user'];
                    $site_id=$_SESSION['id_hotel'];
                    $devise=$monnaie_achat;
                    $ecriture_id = $cptecritureso->insert($dte,$dteaff,$dtetime,$libelle,$numBon,$journal_id,$psedo,$exercice_id,$user_id,$site_id,$devise);
                    //AUTRE COMPTE EST CREDITE
                    if($longcompte==2){
                     $categorie_id=$_POST["cpte_id"];
                     $compte_id=NULL;
                     $souscompte_id=NULL;
                     }elseif ($longcompte==3) {
                     $compte_id=$_POST["cpte_id"];
                     $categorie_id=$_POST["cat"];
                     $souscompte_id=NULL;
                     }elseif ($longcompte==4){
                     $souscompte_id=$_POST["cpte_id"];
                     $categorie_id=$_POST["cat"];
                     $compte_id=$_POST["compt"];
                     }
                     $debit=0;
                     $credit=$montant;
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];
                     $detail_id_ecrit2=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$format,$longcompte);
                     //COMPTE CAISSE EST DEBITE
                     if($devise=='CDF'){

                     $compte_ecriture=5711;
                     $longcomptecaisse=4;
                     $souscompte_id=573;
                     $categorie_id=65;
                     $compte_id=266;
                     $debit=$montant;
                     $credit=0;
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];

                     $detail_id_ecrit=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$compte_ecriture,$longcomptecaisse);
                     }else{

                     $compte_ecriture=5712;
                     $longcomptecaisse=4;
                     $souscompte_id=573;
                     $categorie_id=65;
                     $compte_id=266;
                     $debit=$montant;
                     $credit=0;
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];

                     $detail_id_ecrit=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$compte_ecriture,$longcomptecaisse);
         

                    }
                    //COMPTA
                    $requete = $bdd->prepare("INSERT INTO t_operation (type,libelle,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                                   montantUSD,numBordereau,mode_operation,session_id,motif_id,user_id,hotel_id,format,detail_id_ecrit)
                                     VALUES(:type,:libelle,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                        ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                                     :cpte_id,:user_id,:hotel_id,:format,:detail_id_ecrit)");
                    $session_id = 1;
                    $requete->BindParam(':type', $entree);
                    $requete->BindParam(':libelle', $libelle);
                    $requete->BindParam(':beneficiaire', $beneficiaire);
                    $requete->BindParam(':date_bon', $date_bon);
                    $requete->BindParam(':date_heure_bon', $date_heure_bon);
                    $requete->BindParam(':montantFC', $montantFC);
                    $requete->BindParam(':montantUSD', $montantUSD);
                    $requete->BindParam(':numBordereau', $numBordereau);
                    $requete->BindParam(':mode_operation', $type_caisse);
                    $requete->BindParam(':session_id', $session_id);
                    $requete->BindParam(':cpte_id', $cpte_num);
                    $requete->BindParam(':user_id',$_SESSION['id_user']);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->BindParam(':format', $longcompte);
                    $requete->BindParam(':detail_id_ecrit',$detail_id_ecrit);
                    $requete->execute();    
                    //  Modification de numBon dans la bdd
                    $id_operation = $bdd->lastInsertId();
                    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
                    $requete->BindParam(':numBon', $numBon);
                    $requete->BindParam(':type', $entree);
                    $requete->BindParam(':idoperation', $id_operation);
                    $requete->execute();
                    $json['operation_last_id'] =$id_operation;
                    $num_cmd+=1;
                    setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
                    //AUTRES JOURNAUX
                    $debit=0;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=0;
                    $site_id=$_SESSION['id_hotel'];
                    $journal_id=GetCompteDuJournal($cpte_num,$bdd);
                    //Si c'est journal_id est 0 on le met dans operation diverse par defaut pour le moment
                    if($journal_id==0){
                        $journal_id=5;
                    }
                    //Si c'est journal_id est 0 on le met dans operation diverse par defaut pour le moment

                    if($journal_id!=0){

                    if($journal_id==1){
                    $prefnum='JA';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==2) {
                    $prefnum='JV';
                    $debit=0;
                    $credit=$montant;
                    $debitcaisse=$montant;
                    $creditcaisse=0;
                    }elseif ($journal_id==4) {
                    $prefnum='JB';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==5) {
                    $prefnum='JO';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==6) {
                    $prefnum='JN';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }

                    $dte=date('Y-m-d');
                    $num_jour = getnumerotation($_SESSION['id_hotel'],$prefnum, $bdd);
                    $ref= $prefnum . str_pad($num_jour, 4, "0", STR_PAD_LEFT);
                    $compte=$compteprov;
                    $description=$libelle;
                    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id,benprov)
                                     VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id,:benprov)");
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':ref', $ref);
                    $requete->BindParam(':compte', $compte);
                    $requete->BindParam(':description', $description);
                    $requete->BindParam(':debit', $debit);
                    $requete->BindParam(':credit', $credit);
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id', $journal_id);
                    $requete->BindParam(':exercice_id', $exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id',$ecriture_id);
                    $requete->BindParam(':benprov',$beneficiaire);
                    $requete->execute();   
                    if($devise=='CDF') {
                     $compte="5711 Caisse en monnaie nationale";
                     } else {
                     $compte="5712 Caisse en devises";
                     }
                    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id,benprov)
                                     VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id,:benprov)");
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':ref', $ref);
                    $requete->BindParam(':compte', $compte);
                    $requete->BindParam(':description', $description);
                    $requete->BindParam(':debit', $debitcaisse);
                    $requete->BindParam(':credit', $creditcaisse);
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id',$journal_id);
                    $requete->BindParam(':exercice_id',$exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id',$ecriture_id);
                     $requete->BindParam(':benprov',$beneficiaire);
                    $requete->execute();   
                    $num_jour+=1;
                    setnumerotation($_SESSION['id_hotel'], $prefnum, $num_jour, $bdd);
                    }
                   
                    //AUTRES JOURNAUX

                    $json['message'] = json_success2('Opération effectuée avec succes');
                    $json['s'] = TRUE;

                   }
                 echo json_encode($json);
                
                }
                }elseif (get('do') == 'decaissementpro') {
                if ($_POST) {
                $bdd=ConnectWithUtf();
                include('soldestresorerie.php');
                $json = array();
                $json['s'] = false;
                $json['message'] = '';
                $date_heure_bon = post('date_heure_bon');
                $cpte_id =post('cpte_id');
                $libelle = post('libelle');
                $beneficiaire =post('beneficiaire');
                $monnaie =post('monnaie');
                $montant =post('montant');
                $cpte_num=post('num');
                $format=(string)$cpte_num;
                $longcompte=strlen($format);
                $compteprov=post('compteprov');
                if (empty($date_heure_bon) || empty($cpte_id) || empty($libelle) || empty($beneficiaire) || empty($monnaie)|| empty($montant)) {
                $json['message'] = json_error2('Veuillez remplir les champs vides!');
                } else {
                //transpostion date
                $transpostion_sortie = explode('/', $date_heure_bon);
                $jrsor = $transpostion_sortie[0];
                $moisor = $transpostion_sortie[1];
                $annee1sor = $transpostion_sortie[2];
                $transpostion_sortie1 = explode(' ', $annee1sor);
                $anneesor = $transpostion_sortie1[0];
                $heuresor = $transpostion_sortie1[1];
                $date_heure_bon = $anneesor . '/' . $moisor . '/' . $jrsor . ' ' . $heuresor;
                $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
                $type_caisse="normal";
                $numBordereau="";
                $sortie = "sortie";
                $boolsortie =0;
                //fin transposistion    
                  if ($monnaie == "usd") {
                        $montantUSD =$montant;
                        $montantFC = 00;
                        $libelle1 = 'sortieusd';
                        $monnaie_achat='USD';
                        if ($montantUSD > $solde_caisse_usd_normal) {
                            $boolsortie =1;
                            $json['message'] =  json_error2('Le montant USD '.$montantUSD.' doit être inferieur à celui de la caisse: '.$solde_caisse_usd_normal.' USD');
                        }

                    } else {
                        $montantFC =$montant;
                        $montantUSD = 00;
                        $libelle1 = 'sortiecdf';
                        $monnaie_achat='CDF';
                        if ($montantFC > $solde_caisse_fc_normal) {
                            $boolsortie =1;
                            $json['message'] =  json_error2('Le montant CDF '.$montantFC.' doit être inferieur à celui de la caisse: '.$solde_caisse_fc_normal.' CDF');
                        }
                    }

                    if($boolsortie ==0){
                    // $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                    // $numBon = 'BS/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
                     $num_cmd =post('num_cmd');
                     $numBon =post('numBon');
                     //COMPTA
                    $dte=date('Y-m-d');
                    $dteaff=$dte;
                    $dtetime=date('Y-m-d H:i:s');
                     //reference auto
                    $prefnum='JC';
                    $num_jour = getnumerotation($_SESSION['id_hotel'],$prefnum, $bdd);
                    $reference= $prefnum . str_pad($num_jour, 4, "0", STR_PAD_LEFT);
                    //reference auto
                    $journal_id=3;
                    $psedo=0;
                    $exercice_id=$_SESSION['exercice_id'];
                    $user_id=$_SESSION['id_user'];
                    $site_id=$_SESSION['id_hotel'];
                    $devise=$monnaie_achat;
                    $ecriture_id = $cptecritureso->insert($dte,$dteaff,$dtetime,$libelle,$numBon,$journal_id,$psedo,$exercice_id,$user_id,$site_id,$devise);
                    //AUTRE COMPTE EST DEBITE
                   
                    if($longcompte==2){
                     $categorie_id=$_POST["cpte_id"];
                     $compte_id=NULL;
                     $souscompte_id=NULL;
                     }elseif ($longcompte==3) {
                     $compte_id=$_POST["cpte_id"];
                     $categorie_id=$_POST["cat"];
                     $souscompte_id=NULL;
                     }elseif ($longcompte==4){
                     $souscompte_id=$_POST["cpte_id"];
                     $categorie_id=$_POST["cat"];
                     $compte_id=$_POST["compt"];
                     }
                     $debit=$montant;
                     $credit=0;
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];
                     $detail_id_ecrit2=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$format,$longcompte);
                     //COMPTE CAISSE EST CREDITE
                     if($devise=='CDF'){

                     $compte_ecriture=5711;
                     $longcomptecaisse=4;
                     $souscompte_id=573;
                     $categorie_id=65;
                     $compte_id=266;
                     $debit=0;
                     $credit=$montant;
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];

                     $detail_id_ecrit=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$compte_ecriture,$longcomptecaisse);
                     }else{

                     $compte_ecriture=5712;
                     $longcomptecaisse=4;
                     $souscompte_id=573;
                     $categorie_id=65;
                     $compte_id=266;
                     $debit=0;
                     $credit=$montant; 
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];

                     $detail_id_ecrit=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$compte_ecriture,$longcomptecaisse);
         

                    }
                    //COMPTA
                      $requete = $bdd->prepare("INSERT INTO t_operation (type,libelle,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                                   montantUSD,numBordereau,mode_operation,session_id,motif_id,user_id,hotel_id,format,detail_id_ecrit)
                                     VALUES(:type,:libelle,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                        ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                                     :cpte_id,:user_id,:hotel_id,:format,:detail_id_ecrit)");
                    $session_id = 1;
                    $requete->BindParam(':type', $sortie);
                    $requete->BindParam(':libelle', $libelle);
                    $requete->BindParam(':beneficiaire', $beneficiaire);
                    $requete->BindParam(':date_bon', $date_bon);
                    $requete->BindParam(':date_heure_bon', $date_heure_bon);
                    $requete->BindParam(':montantFC', $montantFC);
                    $requete->BindParam(':montantUSD', $montantUSD);
                    $requete->BindParam(':numBordereau', $numBordereau);
                    $requete->BindParam(':mode_operation', $type_caisse);
                    $requete->BindParam(':session_id', $session_id);
                    $requete->BindParam(':cpte_id', $cpte_num);
                    $requete->BindParam(':user_id',$_SESSION['id_user']);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->BindParam(':format', $longcompte);
                    $requete->BindParam(':detail_id_ecrit',$detail_id_ecrit);
                    $requete->execute();    
                    //  Modification de numBon dans la bdd
                    $id_operation = $bdd->lastInsertId();
                    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
                    $requete->BindParam(':numBon', $numBon);
                    $requete->BindParam(':type', $sortie);
                    $requete->BindParam(':idoperation', $id_operation);
                    $requete->execute();
                    $json['operation_last_id'] =$id_operation;
                    $num_cmd+=1;
                    setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
                     //AUTRES JOURNAUX
                    $site_id=$_SESSION['id_hotel'];
                    $journal_id=GetCompteDuJournal($cpte_num,$bdd);
                    //Si c'est journal_id est 0 on le met dans operation diverse par defaut pour le moment
                    if($journal_id==0){
                        $journal_id=5;
                    }
                    //Si c'est journal_id est 0 on le met dans operation diverse par defaut pour le moment

                    if($journal_id!=0){

                    if($journal_id==1){
                    $prefnum='JA';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==2) {
                    $prefnum='JV';
                    $debit=0;
                    $credit=$montant;
                    $debitcaisse=$montant;
                    $creditcaisse=0;
                    }elseif ($journal_id==4) {
                    $prefnum='JB';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==5) {
                    $prefnum='JO';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==6) {
                    $prefnum='JN';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }

                    $dte=date('Y-m-d');
                    $num_jour = getnumerotation($_SESSION['id_hotel'],$prefnum, $bdd);
                    $ref= $prefnum . str_pad($num_jour, 4, "0", STR_PAD_LEFT);
                    $compte=$compteprov;
                    $description=$libelle;
                    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id,benprov)
                                     VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id,:benprov)");
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':ref', $ref);
                    $requete->BindParam(':compte', $compte);
                    $requete->BindParam(':description', $description);
                    $requete->BindParam(':debit', $debit);
                    $requete->BindParam(':credit', $credit);
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id', $journal_id);
                    $requete->BindParam(':exercice_id', $exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id',$ecriture_id);
                    $requete->BindParam(':benprov',$beneficiaire);
                    $requete->execute();   
                    if($devise=='CDF') {
                     $compte="5711 Caisse en monnaie nationale";
                     } else {
                     $compte="5712 Caisse en devises";
                     }
                    $debit=$montant;
                    $credit=0;
                    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id,benprov)
                                     VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id,:benprov)");
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':ref', $ref);
                    $requete->BindParam(':compte', $compte);
                    $requete->BindParam(':description', $description);
                    $requete->BindParam(':debit', $debitcaisse);
                    $requete->BindParam(':credit', $creditcaisse);
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id',$journal_id);
                    $requete->BindParam(':exercice_id',$exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id',$ecriture_id);
                    $requete->BindParam(':benprov',$beneficiaire);
                    $requete->execute();   
                    $num_jour+=1;
                    setnumerotation($_SESSION['id_hotel'], $prefnum, $num_jour, $bdd);
                    }
                   

                    //AUTRES JOURNAUX
                    $json['message'] = json_success2('Opération effectuée avec succes');
                    $json['s'] = TRUE;  
                    }
                    

                   }
                 echo json_encode($json);
                
                }
                


                }
                elseif (get('do') == 'demandepaiepro') {
                if ($_POST) {
                $bdd=ConnectWithUtf();
                include('soldestresorerie.php');
                $json = array();
                $json['s'] = false;
                $json['message'] = '';
                $date_heure_bon = post('date_heure_bon');
                $cpte_id =post('cpte_id');
                $libelle = post('libelle');
                $beneficiaire =post('beneficiaire');
                $monnaie =post('monnaie');
                $montant =post('montantpaye');
                $montanttot =post('montant');
                $mode =post('mode');
                $id_fact =post('id_fact');
                $cpte_num=post('num');
                $format=(string)$cpte_num;
                $longcompte=strlen($format);
                $compteprov=post('compteprov');
                if (empty($date_heure_bon) || empty($cpte_id) || empty($libelle) || empty($beneficiaire) || empty($monnaie)|| empty($montant)) {
                $json['message'] = json_error2('Veuillez remplir les champs vides!');
                } else {
                //transpostion date
                $transpostion_sortie = explode('/', $date_heure_bon);
                $jrsor = $transpostion_sortie[0];
                $moisor = $transpostion_sortie[1];
                $annee1sor = $transpostion_sortie[2];
                $transpostion_sortie1 = explode(' ', $annee1sor);
                $anneesor = $transpostion_sortie1[0];
                $heuresor = $transpostion_sortie1[1];
                $date_heure_bon = $anneesor . '/' . $moisor . '/' . $jrsor . ' ' . $heuresor;
                $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
                $type_caisse="normal";
                $numBordereau="";
                $sortie = "sortie";
                $boolsortie =0;
                //fin transposistion  
                if ($montant >$montanttot) {
                            $boolsortie =1;
                            $json['message'] =  json_error2('Le montant paye '.$montant.' '.$monnaie.' doit être inferieur ou egal au : '.$montanttot.' '.$monnaie);

                    }  
                  if ($monnaie == "USD") {
                        $montantUSD =$montant;
                        $montantFC = 0;
                        $libelle1 = 'sortieusd';
                        $monnaie_achat='USD';
                        if ($montantUSD > $solde_caisse_usd_normal) {
                            $boolsortie =1;
                            $json['message'] =  json_error2('Le montant USD '.$montantUSD.' doit être inferieur à celui de la caisse: '.$solde_caisse_usd_normal.' USD');
                        }

                    } else {
                        $montantFC =$montant;
                        $montantUSD = 00;
                        $libelle1 = 'sortiecdf';
                        $monnaie_achat='CDF';
                        if ($montantFC > $solde_caisse_fc_normal) {
                            $boolsortie =1;
                            $json['message'] =  json_error2('Le montant CDF '.$montantFC.' doit être inferieur à celui de la caisse: '.$solde_caisse_fc_normal.' CDF');
                        }
                    }
                    if($boolsortie ==0){                   
                    // $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                    // $numBon = 'BS/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
                     $num_cmd =post('num_cmd');
                     $numBon =post('numBon');
                     //COMPTA
                    $dte=date('Y-m-d');
                    $dteaff=$dte;
                    $dtetime=date('Y-m-d H:i:s');
                     //reference auto
                    $prefnum='JC';
                    $num_jour = getnumerotation($_SESSION['id_hotel'],$prefnum, $bdd);
                    $reference= $prefnum . str_pad($num_jour, 4, "0", STR_PAD_LEFT);
                    //reference auto
                    $journal_id=3;
                    $psedo=0;
                    $exercice_id=$_SESSION['exercice_id'];
                    $user_id=$_SESSION['id_user'];
                    $site_id=$_SESSION['id_hotel'];
                    $devise=$monnaie_achat;
                    $ecriture_id = $cptecritureso->insert($dte,$dteaff,$dtetime,$libelle,$numBon,$journal_id,$psedo,$exercice_id,$user_id,$site_id,$devise);
                    //AUTRE COMPTE EST DEBITE
                   
                    if($longcompte==2){
                     $categorie_id=$_POST["cpte_id"];
                     $compte_id=NULL;
                     $souscompte_id=NULL;
                     }elseif ($longcompte==3) {
                     $compte_id=$_POST["cpte_id"];
                     $categorie_id=$_POST["cat"];
                     $souscompte_id=NULL;
                     }elseif ($longcompte==4){
                     $souscompte_id=$_POST["cpte_id"];
                     $categorie_id=$_POST["cat"];
                     $compte_id=$_POST["compt"];
                     }
                     $debit=$montant;
                     $credit=0;
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];
                     $detail_id_ecrit2=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$format,$longcompte);
                     //COMPTE CAISSE EST CREDITE
                     if($devise=='CDF'){

                     $compte_ecriture=5711;
                     $longcomptecaisse=4;
                     $souscompte_id=573;
                     $categorie_id=65;
                     $compte_id=266;
                     $debit=0;
                     $credit=$montant;
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];

                     $detail_id_ecrit=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$compte_ecriture,$longcomptecaisse);
                     }else{

                     $compte_ecriture=5712;
                     $longcomptecaisse=4;
                     $souscompte_id=573;
                     $categorie_id=65;
                     $compte_id=266;
                     $debit=0;
                     $credit=$montant; 
                     $libellevide='';
                     $numdoc='';
                     $tauxop=$_SESSION['tauxop'];

                     $detail_id_ecrit=$cptdetailsecritureso->Insert($compte_id,$debit,$credit,$libellevide,$numdoc,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$compte_ecriture,$longcomptecaisse);
         

                    }
                    //COMPTA  
                      $requete = $bdd->prepare("INSERT INTO t_operation (type,libelle,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                                   montantUSD,numBordereau,mode_operation,session_id,motif_id,user_id,hotel_id,format,detail_id_ecrit)
                                     VALUES(:type,:libelle,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                        ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                                     :cpte_id,:user_id,:hotel_id,:format,:detail_id_ecrit)");
                    $session_id = 1;
                    $requete->BindParam(':type', $sortie);
                    $requete->BindParam(':libelle', $libelle);
                    $requete->BindParam(':beneficiaire', $beneficiaire);
                    $requete->BindParam(':date_bon', $date_bon);
                    $requete->BindParam(':date_heure_bon', $date_heure_bon);
                    $requete->BindParam(':montantFC', $montantFC);
                    $requete->BindParam(':montantUSD', $montantUSD);
                    $requete->BindParam(':numBordereau', $numBordereau);
                    $requete->BindParam(':mode_operation', $type_caisse);
                    $requete->BindParam(':session_id', $session_id);
                    $requete->BindParam(':cpte_id', $cpte_num);
                    $requete->BindParam(':user_id',$_SESSION['id_user']);
                    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                    $requete->BindParam(':format', $longcompte);
                    $requete->BindParam(':detail_id_ecrit', $detail_id_ecrit);
                    $requete->execute();    
                    //  Modification de numBon dans la bdd
                    $id_operation = $bdd->lastInsertId();
                    $json['operation_last_id'] =$id_operation;
                    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
                    $requete->BindParam(':numBon', $numBon);
                    $requete->BindParam(':type', $sortie);
                    $requete->BindParam(':idoperation', $id_operation);
                    $requete->execute();
                    $num_cmd+=1;
                    setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
                    //paiement
                    //GET REFERENCE
                        $lib_bon_paie='Lib_Bon_Paiement';
                        $num_cmd = $compteurobj->getnumerotation($_SESSION['id_hotel'],$lib_bon_paie);
                        $num_cmd_format = format_numero($num_cmd);  
                        $numBonCmd=$num_cmd_format;
                        $num_commande=$numBonCmd;
                        $requete = $bdd->prepare("INSERT INTO t_reglement (numero ,date_regl,dte,id_fact,id_user,id_hotel,fournisseur_id)
                                                VALUES(:numero ,:date_regl,:dte,:id_fact,:id_user,:id_hotel,:fournisseur_id)");
                        $requete->BindParam(':numero', $num_commande);
                        $requete->BindParam(':date_regl', $date_heure_bon);
                        $requete->BindParam(':dte', $date_bon);
                        $requete->BindParam(':id_fact', $_SESSION['id_fact']);
                        $requete->BindParam(':id_user', $_SESSION['id_user']);
                        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                        $requete->BindParam(':fournisseur_id', $_SESSION['id_client']);
                        $requete->execute();
                        $regl_id = $bdd->lastInsertId();
                        //MAJ REFERENCE
                        $num_cmd+=1;
                        $compteurobj->Update($lib_bon_paie, $num_cmd,$_SESSION['id_hotel']);
                        $numBonCmd='';

                        if($mode=='cash'){
                            $mode_paie=2;
                        }else{
                             $mode_paie=3;
                        }
                        $monnaie_achat=$monnaie;
                        $requete = $bdd->prepare("INSERT INTO paiement (montantusd,montantcdf,monnaie_achat,id_mode_regl,regl_id,site_id,company_id)
                                                    VALUES(:montantusd,:montantcdf,:monnaie_achat,:id_mode_regl,:regl_id,:site_id,:company_id)");
                        $requete->BindParam(':montantusd', $montantUSD);
                        $requete->BindParam(':montantcdf', $montantFC);
                        $requete->BindParam(':monnaie_achat', $monnaie_achat);
                        $requete->BindParam(':id_mode_regl', $mode_paie);
                        $requete->BindParam(':regl_id', $regl_id);
                        $requete->BindParam(':site_id', $_SESSION['id_hotel']);
                        $requete->BindParam(':company_id', $_SESSION['company_id']);
                        $requete->execute();
                        $paie_id = $bdd->lastInsertId();
                        //Pour le Paiement à Cash
                        $fact1 = 1; 
                        $statut_bon = "attente";
                        MontantsFacture($_SESSION['id_fact']);    
                        $solde_paye =$_SESSION['montant_a_paye'];
                        if($solde_paye<=0){
                        $statut_bon = "paye";
                        }
                        $requete = $bdd->prepare("UPDATE t_facture  SET fact1 =:fact1,statut_bon =:statut_bon WHERE  id_fact=:id_fact");
                        $requete->BindParam(':fact1', $fact1);
                        $requete->BindParam(':statut_bon', $statut_bon);
                        $requete->BindParam(':id_fact', $_SESSION['id_fact']);
                        $requete->execute();
                        //NOTIFICATION
                        $statut="attente";
                        $requete = $bdd->prepare("SELECT a.mode,a.num_cmd,a.taux, a.fact1,a.id_fact,a.num_fact,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,
                                            b.id_client,b.nom_entreprise,SUM(c.prix * c.qte) AS tot_cmd
                                                FROM  t_facture AS a, t_client AS b, lignes_commandes AS c
                                                WHERE a.id_client=b.id_client
                                                AND a.id_fact=c.commande_id 
                                                AND a.type='achat'
                                                AND a.id_hotel=:hotel_id AND a.statut_bon=:statut
                                                GROUP BY a.num_fact");
                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                        $requete->BindParam(':statut', $statut);
                        $requete->execute();
                        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
                        $nbre_notification=  count($operations);
                        $_SESSION['nbre_notification']=$nbre_notification;
                        //NOTIFICATION
                         //AUTRES JOURNAUX
                        $site_id=$_SESSION['id_hotel'];
                        $journal_id=GetCompteDuJournal($cpte_num,$bdd);
                        //Si c'est journal_id est 0 on le met dans operation diverse par defaut pour le moment
                        if($journal_id==0){
                            $journal_id=5;
                        }
                        //Si c'est journal_id est 0 on le met dans operation diverse par defaut pour le moment
                    if($journal_id!=0){

                    if($journal_id==1){
                    $prefnum='JA';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==2) {
                    $prefnum='JV';
                    $debit=0;
                    $credit=$montant;
                    $debitcaisse=$montant;
                    $creditcaisse=0;
                    }elseif ($journal_id==4) {
                    $prefnum='JB';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==5) {
                    $prefnum='JO';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }elseif ($journal_id==6) {
                    $prefnum='JN';
                    $debit=$montant;
                    $credit=0;
                    $debitcaisse=0;
                    $creditcaisse=$montant;
                    }

                    $dte=date('Y-m-d');
                    $num_jour = getnumerotation($_SESSION['id_hotel'],$prefnum, $bdd);
                    $ref= $prefnum . str_pad($num_jour, 4, "0", STR_PAD_LEFT);
                    $compte=$compteprov;
                    $description=$libelle;
                    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                                     VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':ref', $ref);
                    $requete->BindParam(':compte', $compte);
                    $requete->BindParam(':description', $description);
                    $requete->BindParam(':debit', $debit);
                    $requete->BindParam(':credit', $credit);
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id', $journal_id);
                    $requete->BindParam(':exercice_id', $exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id',$ecriture_id);
                    $requete->execute();   
                    if($devise=='CDF') {
                     $compte="5711 Caisse en monnaie nationale";
                     } else {
                     $compte="5712 Caisse en devises";
                     }
                    $debit=$montant;
                    $credit=0;
                    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                                     VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':ref', $ref);
                    $requete->BindParam(':compte', $compte);
                    $requete->BindParam(':description', $description);
                    $requete->BindParam(':debit', $debitcaisse);
                    $requete->BindParam(':credit', $creditcaisse);
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id',$journal_id);
                    $requete->BindParam(':exercice_id',$exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id',$ecriture_id);
                    $requete->execute();   
                    $num_jour+=1;
                    setnumerotation($_SESSION['id_hotel'], $prefnum, $num_jour, $bdd);
                    }
                    //AUTRES JOURNAUX
                    $json['message'] = json_success2('Opération effectuée avec succes');
                    $json['s'] = TRUE;  



                    }
                    

                   }
                 echo json_encode($json);
                
                }
        }

                
            }

        //end invoke
        }

        //end class
        ?>
            