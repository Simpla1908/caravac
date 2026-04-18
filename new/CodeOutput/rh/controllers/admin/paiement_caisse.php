 <?php
 //Selection motif 
 $requete = HDB::hus()->prepare("SELECT * FROM t_motif WHERE  sorte='fac' AND hotel_id=:hotel_id");

    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);

    $requete->execute();

    $operations = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($operations as $op) {
        $motif_id = $op->idmotif;
    }
 //fin selection
  if ($montantusd!=0&&$montantcdf!=0) {
    //Encaissement des montants USD et CDF 
    //D'abord encaissement des USD
            $libelle1 = 'entreeusd'; 
            $requete = HDB::hus()->prepare("INSERT INTO t_operation (libelle,type,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                           montantUSD,numBordereau,mode_operation,session_id,motif_id,maj,paie_id,hotel_id)
                             VALUES(:libelle,:type,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                             :motif_id,:maj,:paie_id,:hotel_id)");
            $maj=1;
            $session_id = 1;
            $libelle='Reçu '.$num_cmd_format;
            $beneficiaire='Client';
            $date_bon = date('Y-m-d');
            $date_heure_bon=date('Y-m-d H:i:s');
            $montantFC=0;
            $montantUSD=$montantusd;
            $type_caisse="normal";
            $entree="entree";
            $numBordereau='';
            $requete->BindParam(':libelle', $libelle);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':beneficiaire', $beneficiaire);
            $requete->BindParam(':date_bon', $date_bon);
            $requete->BindParam(':date_heure_bon', $date_heure_bon);
            $requete->BindParam(':montantFC', $montantFC);
            $requete->BindParam(':montantUSD', $montantUSD);
            $requete->BindParam(':numBordereau', $numBordereau);
            $requete->BindParam(':mode_operation', $type_caisse);
            $requete->BindParam(':session_id', $session_id);
            $requete->BindParam(':motif_id', $motif_id);
            $requete->BindParam(':maj', $maj);
            $requete->BindParam(':paie_id', $paie_id);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
          //  Modification de numBon dans la bdd
            $id_operation = HDB::hus()->lastInsertId();
            $num_cmd = $compteurobj->getnumerotation($_SESSION['id_hotel'],$libelle1);
            $num_cmd+=1;
            $compteurobj->Update($libelle1, $num_cmd,$_SESSION['id_hotel']);
            $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
            $requete = HDB::hus()->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
            $requete->BindParam(':numBon', $numBon);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':idoperation', $id_operation);
            $requete->execute();
            // Fin Modification de numBon dans la bdd

            //Ensuite encaissement des CDF
            $libelle1 = 'entreecdf'; 
            $requete = HDB::hus()->prepare("INSERT INTO t_operation (libelle,type,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                           montantUSD,numBordereau,mode_operation,session_id,motif_id,maj,paie_id,hotel_id)
                             VALUES(:libelle,:type,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                             :motif_id,:maj,:paie_id,:hotel_id)");
            $maj=1;
            $session_id = 1;
            $libelle='Reçu '.$num_cmd_format;
            $beneficiaire='Client';
            $date_bon = date('Y-m-d');
            $date_heure_bon=date('Y-m-d H:i:s');
            $montantFC=$montantcdf;
            $montantUSD=0;
            $type_caisse="normal";
            $entree="entree";
            $numBordereau='';
            $requete->BindParam(':libelle', $libelle);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':beneficiaire', $beneficiaire);
            $requete->BindParam(':date_bon', $date_bon);
            $requete->BindParam(':date_heure_bon', $date_heure_bon);
            $requete->BindParam(':montantFC', $montantFC);
            $requete->BindParam(':montantUSD', $montantUSD);
            $requete->BindParam(':numBordereau', $numBordereau);
            $requete->BindParam(':mode_operation', $type_caisse);
            $requete->BindParam(':session_id', $session_id);
            $requete->BindParam(':motif_id', $motif_id);
            $requete->BindParam(':maj', $maj);
            $requete->BindParam(':paie_id', $paie_id);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
          //  Modification de numBon dans la bdd
            $id_operation = HDB::hus()->lastInsertId();
            $num_cmd = $compteurobj->getnumerotation($_SESSION['id_hotel'],$libelle1);
            $num_cmd+=1;
            $compteurobj->Update($libelle1, $num_cmd,$_SESSION['id_hotel']);
            $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
            $requete =HDB::hus()->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
            $requete->BindParam(':numBon', $numBon);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':idoperation', $id_operation);
            $requete->execute();
            // Fin Modification de numBon dans la bdd


    } else if($montantusd!=0&&$montantcdf==0) {
    //Encaissement des montants USD uniquement
            $libelle1 = 'entreeusd';
            $requete = HDB::hus()->prepare("INSERT INTO t_operation (libelle,type,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                           montantUSD,numBordereau,mode_operation,session_id,motif_id,maj,paie_id,hotel_id)
                             VALUES(:libelle,:type,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                             :motif_id,:maj,:paie_id,:hotel_id)");
            $maj=1;
            $session_id = 1;
            $libelle='Reçu '.$num_cmd_format;
            $beneficiaire='Client';
            $date_bon = date('Y-m-d');
            $date_heure_bon=date('Y-m-d H:i:s');
            $montantFC=0;
            $montantUSD=$montantusd;
            $type_caisse="normal";
            $entree="entree";
            $numBordereau='';
            $requete->BindParam(':libelle', $libelle);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':beneficiaire', $beneficiaire);
            $requete->BindParam(':date_bon', $date_bon);
            $requete->BindParam(':date_heure_bon', $date_heure_bon);
            $requete->BindParam(':montantFC', $montantFC);
            $requete->BindParam(':montantUSD', $montantUSD);
            $requete->BindParam(':numBordereau', $numBordereau);
            $requete->BindParam(':mode_operation', $type_caisse);
            $requete->BindParam(':session_id', $session_id);
            $requete->BindParam(':motif_id', $motif_id);
            $requete->BindParam(':maj', $maj);
            $requete->BindParam(':paie_id', $paie_id);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
          //  Modification de numBon dans la bdd
            $id_operation = HDB::hus()->lastInsertId();
            $num_cmd = $compteurobj->getnumerotation($_SESSION['id_hotel'],$libelle1);
            $num_cmd+=1;
            $compteurobj->Update($libelle1, $num_cmd,$_SESSION['id_hotel']);
            $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
            $requete = HDB::hus()->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
            $requete->BindParam(':numBon', $numBon);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':idoperation', $id_operation);
            $requete->execute();
            // Fin Modification de numBon dans la bdd
    }else{
        //Encaissement des montants CDF uniquement
             $libelle1 = 'entreecdf';
            $requete = HDB::hus()->prepare("INSERT INTO t_operation (libelle,type,beneficiaire,date_bon,date_heure_bon,montantFC,
                                                           montantUSD,numBordereau,mode_operation,session_id,motif_id,maj,paie_id,hotel_id)
                             VALUES(:libelle,:type,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
                                                ,:montantUSD,:numBordereau,:mode_operation,:session_id,
                                             :motif_id,:maj,:paie_id,:hotel_id)");
            $maj=1;
            $session_id = 1;
            $libelle='Reçu '.$num_cmd_format;
            $beneficiaire='Client';
            $date_bon = date('Y-m-d');
            $date_heure_bon=date('Y-m-d H:i:s');
            $montantFC=$montantcdf;
            $montantUSD=0;
            $type_caisse="normal";
            $entree="entree";
            $numBordereau='';
            $requete->BindParam(':libelle', $libelle);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':beneficiaire', $beneficiaire);
            $requete->BindParam(':date_bon', $date_bon);
            $requete->BindParam(':date_heure_bon', $date_heure_bon);
            $requete->BindParam(':montantFC', $montantFC);
            $requete->BindParam(':montantUSD', $montantUSD);
            $requete->BindParam(':numBordereau', $numBordereau);
            $requete->BindParam(':mode_operation', $type_caisse);
            $requete->BindParam(':session_id', $session_id);
            $requete->BindParam(':motif_id', $motif_id);
            $requete->BindParam(':maj', $maj);
            $requete->BindParam(':paie_id', $paie_id);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
          //  Modification de numBon dans la bdd
            $id_operation = HDB::hus()->lastInsertId();
            $num_cmd = $compteurobj->getnumerotation($_SESSION['id_hotel'],$libelle1);
            $num_cmd+=1;
            $compteurobj->Update($libelle1, $num_cmd,$_SESSION['id_hotel']);
            $numBon = 'BE/' . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
            $requete =HDB::hus()->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
            $requete->BindParam(':numBon', $numBon);
            $requete->BindParam(':type', $entree);
            $requete->BindParam(':idoperation', $id_operation);
            $requete->execute();
            // Fin Modification de numBon dans la bdd

    }

    