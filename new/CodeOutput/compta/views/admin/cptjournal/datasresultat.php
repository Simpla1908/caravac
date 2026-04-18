 <?php
    //Mise en session pour impression
    $_SESSION['CompteResultat'] = array();
    $_SESSION['CompteResultat']['ref'] = array();
    $_SESSION['CompteResultat']['lib'] = array();
    $_SESSION['CompteResultat']['signe'] = array();
    $_SESSION['CompteResultat']['note'] = array();
    $_SESSION['CompteResultat']['netn'] = array();
    $_SESSION['CompteResultat']['netn1'] = array();
    $_SESSION['CompteResultat']['afficher'] = array();
    $netn = 0;
    $netn1 = 0;
    $margecomn = 0;
    $margecomn1 = 0;
    $chiffreaffairen = 0;
    $chiffreaffairen1 = 0;
    $valeurajouten = 0;
    $valeurajouten1 = 0;
    $excedentbrutn = 0;
    $excedentbrutn1 = 0;
    $resultatexploitn = 0;
    $resultatexploitn1 = 0;
    $resultatfinancen = 0;
    $resultatfinancen1 = 0;
    $resultatactivordin = 0;
    $resultatactivordin1 = 0;
    $resultathoactivordin = 0;
    $resultathoactivordin1 = 0;
    $resultatnetn = 0;
    $resultatnetn1 = 0;
    $afficher = 0;
    //fin mise en session
    foreach ($result as $rows) {

        if ($rows->typeligne == -1 || $rows->typeligne == 0 || $rows->typeligne == 1) {

            if ($rows->compte_id != '') {
                //Important Treatment 
                $_SESSION['valeur'] = array();
                $_SESSION['valeur']['id'] = array();
                $valeurn = 0;
                $valeurn1 = 0;
                $compte_id = explode(',', $rows->compte_id);
                foreach ($compte_id as $value) {
                    $value = intval($value);
                    array_push($_SESSION['valeur']['id'], $value);
                }
                //calcul val brut
                $nbre = count($_SESSION['valeur']['id']);
                for ($i = 0; $i < $nbre; $i++) {
                    $format = (string)$_SESSION['valeur']['id'][$i];
                    $format = strlen($format);
                    $compte_num = $_SESSION['valeur']['id'][$i];
                    $compte_id = IDFromAccountNumber($_SESSION['valeur']['id'][$i], $format, $bdd);

                    ///$compte_num=691;
                    ///$format=3;
                    ///$compte_id=IDFromAccountNumber($compte_num,$format,$bdd);
                    ///echo $compte_id;

                    $chargeprod = $rows->r;
                    $valeurn = $valeurn + CalculValeurCR($devise, $compte_id, $compte_num, $format, $dte1n, $dte2n, $exercicesn, $site_id, $chargeprod, $bdd);
                    $valeurn1 = $valeurn1 + CalculValeurCR($devise, $compte_id, $compte_num, $format, $dte1n1, $dte2n1, $exercicesn1, $site_id, $chargeprod, $bdd);
                }

                //End Important Treatment 
                $netn = $valeurn;
                $netn1 = $valeurn1;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $netn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $netn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
            }
        } elseif ($rows->typeligne == 2) {
            if ($rows->code == 'XA') {
                $afficher = 1;
                $margecomn = $_SESSION['CompteResultat']['netn']['TA'] - $_SESSION['CompteResultat']['netn']['RA'] + $_SESSION['CompteResultat']['netn']['RB'];
                $margecomn1 = $_SESSION['CompteResultat']['netn1']['TA'] - $_SESSION['CompteResultat']['netn1']['RA'] + $_SESSION['CompteResultat']['netn1']['RB'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $margecomn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $margecomn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XB') {
                $afficher = 1;
                $chiffreaffairen = $_SESSION['CompteResultat']['netn']['TA'] + $_SESSION['CompteResultat']['netn']['TB'] + $_SESSION['CompteResultat']['netn']['TC'] + $_SESSION['CompteResultat']['netn']['TD'];
                $chiffreaffairen1 = $_SESSION['CompteResultat']['netn1']['TA'] + $_SESSION['CompteResultat']['netn1']['TB'] + $_SESSION['CompteResultat']['netn1']['TC'] + $_SESSION['CompteResultat']['netn1']['TD'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $chiffreaffairen;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $chiffreaffairen1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XC') {
                $afficher = 1;
                $TE_RJn = $_SESSION['CompteResultat']['netn']['TE'] + $_SESSION['CompteResultat']['netn']['TF'] + $_SESSION['CompteResultat']['netn']['TG'] + $_SESSION['CompteResultat']['netn']['TH'] + $_SESSION['CompteResultat']['netn']['TI'] - $_SESSION['CompteResultat']['netn']['RC'] + $_SESSION['CompteResultat']['netn']['RD'] - $_SESSION['CompteResultat']['netn']['RE'] + $_SESSION['CompteResultat']['netn']['RF'] - $_SESSION['CompteResultat']['netn']['RG'] - $_SESSION['CompteResultat']['netn']['RH'] - $_SESSION['CompteResultat']['netn']['RI'] - $_SESSION['CompteResultat']['netn']['RJ'];
                $TE_RJn1 = $_SESSION['CompteResultat']['netn1']['TE'] + $_SESSION['CompteResultat']['netn1']['TF'] + $_SESSION['CompteResultat']['netn1']['TG'] + $_SESSION['CompteResultat']['netn1']['TH'] + $_SESSION['CompteResultat']['netn1']['TI'] - $_SESSION['CompteResultat']['netn1']['RC'] + $_SESSION['CompteResultat']['netn1']['RD'] - $_SESSION['CompteResultat']['netn1']['RE'] + $_SESSION['CompteResultat']['netn1']['RF'] - $_SESSION['CompteResultat']['netn1']['RG'] - $_SESSION['CompteResultat']['netn1']['RH'] - $_SESSION['CompteResultat']['netn1']['RI'] - $_SESSION['CompteResultat']['netn1']['RJ'];
                $valeurajouten = $_SESSION['CompteResultat']['netn']['XB'] - $_SESSION['CompteResultat']['netn']['RA'] + $_SESSION['CompteResultat']['netn']['RB'] + $TE_RJn;
                $valeurajouten1 = $_SESSION['CompteResultat']['netn1']['XB'] - $_SESSION['CompteResultat']['netn1']['RA'] + $_SESSION['CompteResultat']['netn1']['RB'] + $TE_RJn;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $valeurajouten;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $valeurajouten1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XD') {
                $afficher = 1;
                $excedentbrutn = $_SESSION['CompteResultat']['netn']['XC'] - $_SESSION['CompteResultat']['netn']['RK'];
                $excedentbrutn1 = $_SESSION['CompteResultat']['netn1']['XC'] - $_SESSION['CompteResultat']['netn1']['RK'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $excedentbrutn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $excedentbrutn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session  
            } else if ($rows->code == 'XE') {
                $afficher = 1;
                $resultatexploitn = $_SESSION['CompteResultat']['netn']['XD'] + $_SESSION['CompteResultat']['netn']['TJ'] - $_SESSION['CompteResultat']['netn']['RL'];
                $resultatexploitn1 = $_SESSION['CompteResultat']['netn1']['XD'] + $_SESSION['CompteResultat']['netn1']['TJ'] - $_SESSION['CompteResultat']['netn1']['RL'];

                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatexploitn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatexploitn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XF') {
                $afficher = 1;
                $resultatfinancen = $_SESSION['CompteResultat']['netn']['TK'] + $_SESSION['CompteResultat']['netn']['TL'] + $_SESSION['CompteResultat']['netn']['TM'] - $_SESSION['CompteResultat']['netn']['RM'] - $_SESSION['CompteResultat']['netn']['RN'];
                $resultatfinancen1 = $_SESSION['CompteResultat']['netn1']['TK'] + $_SESSION['CompteResultat']['netn1']['TL'] + $_SESSION['CompteResultat']['netn1']['TM'] - $_SESSION['CompteResultat']['netn1']['RM'] - $_SESSION['CompteResultat']['netn1']['RN'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatfinancen;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatfinancen1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XG') {
                $afficher = 1;
                $resultatactivordin = $_SESSION['CompteResultat']['netn']['XE'] + $_SESSION['CompteResultat']['netn']['XF'];
                $resultatactivordin1 = $_SESSION['CompteResultat']['netn1']['XE'] + $_SESSION['CompteResultat']['netn1']['XF'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatactivordin;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatactivordin1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XH') {
                $afficher = 1;
                $resultathoactivordin = $_SESSION['CompteResultat']['netn']['TN'] + $_SESSION['CompteResultat']['netn']['TO'] - $_SESSION['CompteResultat']['netn']['RO'] + $_SESSION['CompteResultat']['netn']['RP'];
                $resultathoactivordin1 = $_SESSION['CompteResultat']['netn1']['TN'] + $_SESSION['CompteResultat']['netn1']['TO'] - $_SESSION['CompteResultat']['netn1']['RO'] + $_SESSION['CompteResultat']['netn1']['RP'];

                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultathoactivordin;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultathoactivordin1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XI') {
                $afficher = 1;
                $resultatnetn = $_SESSION['CompteResultat']['netn']['XG'] + $_SESSION['CompteResultat']['netn']['XH'] - $_SESSION['CompteResultat']['netn']['RQ'] - $_SESSION['CompteResultat']['netn']['RS'];
                $resultatnetn1 = $_SESSION['CompteResultat']['netn1']['XG'] + $_SESSION['CompteResultat']['netn1']['XH'] - $_SESSION['CompteResultat']['netn1']['RQ'] - $_SESSION['CompteResultat']['netn1']['RS'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatnetn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatnetn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session 
                //Ecriture resultat
                $datas = checkresultatexercice($exercicesn, $bdd);
                $existe = $datas['existe'];
                $ecriture_id = $datas['ecriture'];
                if ($existe == 0) {

                    $dte = date('Y-m-d');
                    $dteaff = $dte;
                    $dtetime = date('Y-m-d H:i:s');
                    $libelle = 'RESULTAT EXERCICE';
                    $reference = 'RES00001';
                    $beneficiaire = '';
                    $journal_id = 5;
                    $psedo = 0;
                    $exercice_id = $exercicesn;
                    $user_id = $_SESSION['id_user'];

                    $ecriture_id = EcritureCompta($dte, $dteaff,  $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                    $tauxop = $_SESSION['tauxop'];

                    if ($resultatnetn > 0) {
                        $compte_id = 25;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 131;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    } else {

                        $compte_id = 33;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 139;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    }

                    $resultat = $resultatnetn;
                    $existe = 1;
                    setresultatexercice($ecriture_id, $exercice_id, $resultat, $existe, $devise, $tauxop, $bdd);
                } else {

                    DeleteDetailsEcriture($ecriture_id, $bdd);
                    $tauxop = $_SESSION['tauxop'];
                    if ($resultatnetn > 0) {
                        $compte_id = 25;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 131;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    } else {
                        $compte_id = 33;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 139;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    }
                    $exercice_id = $exercicesn;
                    $resultat = $resultatnetn;
                    $existe = 1;
                    setresultatexercice($ecriture_id, $exercice_id, $resultat, $existe, $devise, $tauxop, $bdd);
                }


                //Fin ecriture resultat
            }
        }
    }
    //var_dump($_SESSION['BilanA']);

    ?>
 <div class="col-lg-12 table-responsive">
     <table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
         <thead>
             <tr>
                 <th rowspan="2" style="text-align: center;">REF</th>
                 <th rowspan="2" style="text-align: center;">LIBELLES</th>
                 <th rowspan="2" style="text-align: center;"></th>
                 <th rowspan="2" style="text-align: center;">NOTE</th>
                 <th style="text-align: center;"><?php echo strtoupper($exercicesnlib); ?></th>
                 <th style="text-align: center;"><?php echo strtoupper($exercicesn1lib); ?></th>
             </tr>
             <tr>
                 <th style="text-align: center;">Net</th>
                 <th style="text-align: center;">Net</th>
             </tr>
         </thead>
         <tbody>
             <?php
                $nbArticles = count($_SESSION['CompteResultat']['ref']);
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $ref = $_SESSION['CompteResultat']['ref'][$i];
                ?>
                 <tr>
                     <td><?php echo $ref; ?></td>
                     <td class="col-md-6"><?php echo $_SESSION['CompteResultat']['lib'][$ref]; ?></td>
                     <td style="text-align: center;"><?php echo $_SESSION['CompteResultat']['signe'][$ref]; ?></td>
                     <td style="text-align: center;"><?php echo $_SESSION['CompteResultat']['note'][$ref]; ?></td>
                     <td class="col-md-3"><?php if ($_SESSION['CompteResultat']['netn'][$ref] > 0 || $_SESSION['CompteResultat']['netn'][$ref] < 0 || $_SESSION['CompteResultat']['afficher'][$ref] == 1) {
                                                echo FormatChiffreCompta($_SESSION['CompteResultat']['netn'][$ref]);
                                            }; ?></td>
                     <td class="col-md-3"><?php if ($_SESSION['CompteResultat']['netn1'][$ref] > 0 || $_SESSION['CompteResultat']['netn1'][$ref] < 0 || $_SESSION['CompteResultat']['afficher'][$ref] == 1) {
                                                echo FormatChiffreCompta($_SESSION['CompteResultat']['netn1'][$ref]);
                                            }; ?></td>
                 </tr>
             <?php
                }
                ?>
         </tbody>
     </table>
 </div>