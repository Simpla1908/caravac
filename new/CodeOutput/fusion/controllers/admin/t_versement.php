
<?php

/*
 * =======================================================================
 * FILE NAME:        t_versement.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_versement
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/t_versement.php');

class t_versement_controller {

    public $t_versement_model;

    public function __construct() {
        $this->t_versement_model = new t_versement_model();
    }

    public function invoke_t_versement() {
        //SCRIPT PERSONNALISES
        if (get('do') == 'viewallheb') {
            $bdd = HDB::hus();
            $result = array();
            $per_dte = startEndDayMonth();
            $datedebut = $per_dte['sday'];
            $datefin = $per_dte['eday']; 
//            $datedebut = date('Y-m-d');
//            $datefin = date('Y-m-d');
            $users= ListeUsers($bdd);
            include(APP_FOLDER . '/views/admin/t_versement/liste.php');
        }

        if (get('do') == 'filtrervers') {
            $bdd = HDB::hus();
            $result = array();
            /* Conversion date1 */
            $transpostion_date1 = explode('/', post('dte1'));
            $jour = $transpostion_date1[0];
            $mois = $transpostion_date1[1];
            $annee = $transpostion_date1[2];
            $datedebut = $annee . '-' . $mois . '-' . $jour;
            /* Conversion date2 */
            $transpostion_date2 = explode('/', post('dte2'));
            $jour2 = $transpostion_date2[0];
            $mois2 = $transpostion_date2[1];
            $annee2 = $transpostion_date2[2];
            $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
            include(APP_FOLDER . '/views/admin/t_versement/alldata.php');
        }elseif(get('do') == 'filtrervers2'){
            $bdd = HDB::hus();
            $result = array();
            /* Conversion date1 */
            $datedebut =get('dtevers');
            $datefin =$datedebut;
            include(APP_FOLDER . '/views/admin/t_versement/alldata2.php');
        }

        if (get('do') == 'detailsheb') {
            $bdd = HDB::hus();
            $musd = 'USD';
            $mcdf = 'CDF';
            $noms_user = $_GET['noms_user'];
            $_SESSION['dte_vers'] = $dte = $_GET['dte'];
            $user = $_GET['user'];
            $_SESSION['fond_cdf'] = $fond_cdf = $_GET['fond_cdf'];
            $_SESSION['fond_usd'] = $fond_usd = $_GET['fond_usd'];
            $_SESSION['percu_cdf'] = $percu_cdf = $_GET['percu_cdf'];
            $_SESSION['percu_usd'] = $percu_usd = $_GET['percu_usd'];
            $_SESSION['rendu_cdf'] = $rendu_cdf = $_GET['rendu_cdf'];
            $_SESSION['rendu_usd'] = $rendu_usd = $_GET['rendu_usd'];
            $_SESSION['averser_usd'] = $averser_usd = $_GET['averser_usd'];
            $_SESSION['averser_cdf'] = $averser_cdf = $_GET['averser_cdf'];
            $_SESSION['verser_cdf'] = $verser_cdf = $_GET['verser_cdf'];
            $_SESSION['verser_usd'] = $verser_usd = $_GET['verser_usd'];
            $_SESSION['solde_cdf'] = $solde_cdf = $averser_cdf - $verser_cdf;
            $_SESSION['solde_usd'] = $solde_usd = $averser_usd - $verser_usd;
            $requete = $bdd->prepare("SELECT a.montant_vers AS mont_cdf,a.montantusd AS mont_usd,a.num
        FROM t_versement AS a
        WHERE  a.date_vers=:dte AND a.user_vers=:user");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':user', $user);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            include(APP_FOLDER . '/views/admin/t_versement/details2.php');
        }


        if (get('do') == 'addversement') {
            $bdd = HDB::hus();
            $json = array();
            $json['s'] = false;
            $json['message'] = '';

            if (empty($_POST['montant_cdf']) && empty($_POST['montant_usd'])) {
                $json['message'] = json_success2("Veuillez remplir les champs vides.");
            } else if ($_POST['montant_cdf'] > $_POST['averser_cdf']) {
                $json['message'] = json_success2("Le montant CDF " . $_POST['montant_cdf'] . " ne doit pas etre superieur au montant " . $_POST['averser_cdf'] . " à verser.");
            } else if ($_POST['montant_usd'] > $_POST['averser_usd']) {
                $json['message'] = json_success2("Le montant USD " . $_POST['montant_usd'] . " ne doit pas etre superieur au montant " . $_POST['averser_usd'] . " à verser.");
            } else {
                $montant_cdf = $_POST['montant_cdf'];
                $montant_usd = $_POST['montant_usd'];
                $motif_id_resto = '';
                $paie_id = '';
                $type_vers = 'hebergement';
                $motif = 'hebergement';
                $id_hotel = $_SESSION['id_hotel'];
                $user_vers = $_SESSION['id_user'];
                $id_sousresto = Null;
                $dte = date('Y-m-d');
                $lib = 'BVH';
                $num_cmd = getnumerotation($id_hotel, $lib, $bdd);
                $num_cmd_format = format_numero($num_cmd);
                $numbon =$lib.$num_cmd_format;
                insertmontantVersement($user_vers, $dte, $montant_cdf, $montant_usd, $_SESSION['Paie_affiche'], $type_vers, $_SESSION['Paie_taux'], $motif, $paie_id, $id_hotel, $id_sousresto, $numbon, $bdd);
                setnumerotation($id_hotel, $lib, $num_cmd + 1, $bdd);
                $json['message'] = 'OK';
                $_SESSION['numero_vers'] = $numbon;
                $_SESSION['montant_usd'] = $montant_usd;
                $_SESSION['montant_cdf'] = $montant_cdf;
                //Billetage
                //USD
                $_SESSION['100usd'] = $_POST['100usd'];
                $_SESSION['50usd'] = $_POST['50usd'];
                $_SESSION['20usd'] = $_POST['20usd'];
                $_SESSION['10usd'] = $_POST['10usd'];
                $_SESSION['5usd'] = $_POST['5usd'];
                $_SESSION['1usd'] = $_POST['1usd'];

                //CDF
                $_SESSION['20000cdf'] = $_POST['20000cdf'];
                $_SESSION['10000cdf'] = $_POST['10000cdf'];
                $_SESSION['5000cdf'] = $_POST['5000cdf'];
                $_SESSION['1000cdf'] = $_POST['1000cdf'];
                $_SESSION['500cdf'] = $_POST['500cdf'];
                $_SESSION['200cdf'] = $_POST['200cdf'];
                $_SESSION['100cdf'] = $_POST['100cdf'];
                $_SESSION['50cdf'] = $_POST['50cdf'];
                $json['message'] = json_success2("Versement effectué avec succes.");
                $json['s'] = true;
            }
            echo json_encode($json);
        }


        if (get('do') == 'modal_versement') {
        $bdd = HDB::hus();
        $musd='USD';
        $mcdf='CDF';
        $percu_cdf=0;
        $percu_usd=0;
        $rendu_cdf=0;
        $rendu_usd=0;
        $fond_cdf=0;
        $fond_usd=0; 
        $dte=date('Y-m-d');
        $requete = $bdd->prepare("SELECT SUM(b.montantcdf) AS percu_cdf,SUM(b.montantusd) AS percu_usd,SUM(b.rendu_cdf) AS rendu_cdf,SUM(b.rendu_usd) AS rendu_usd
        FROM  t_facture AS f,t_reglement AS a,paiement AS b
        WHERE a.id_regl=b.regl_id AND b.id_mode_regl IN(2)
        AND f.id_fact=a.id_fact AND a.dte=:dte AND a.id_user=:id_user
        AND  b.site_id=:id_hotel AND f.type='hebergement' AND b.annuler=0 GROUP BY a.dte,a.id_user");
        $requete->BindParam(':dte',$dte);
        $requete->BindParam(':id_user',$_SESSION['id_user']);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
        $_SESSION['percu_cdf']=$percu_cdf=$r->percu_cdf;
        $_SESSION['percu_usd']=$percu_usd= $r->percu_usd;
        $_SESSION['rendu_cdf']=$rendu_cdf= $r->rendu_cdf;
        $_SESSION['rendu_usd']=$rendu_usd= $r->rendu_usd;
        }
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte=:dte AND user_id=:id_user
        AND hotel_id=:id_hotel AND type='hebergement' GROUP BY dte,user_id");
        $requete->BindParam(':dte',$dte);
        $requete->BindParam(':id_user',$_SESSION['id_user']);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
        $_SESSION['fond_cdf']=$fond_cdf=$r->fond_cdf;
        $_SESSION['fond_usd']=$fond_usd=$r->fond_usd;
        }
        $_SESSION['averser_cdf']=$averser_cdf=($fond_cdf+$percu_cdf)-$rendu_cdf;
        $_SESSION['averser_usd']=$averser_usd=($fond_usd+$percu_usd)-$rendu_usd; 
        $requete = $bdd->prepare("SELECT a.date_vers,a.user_vers,SUM(a.montant_vers) AS mont_cdf,SUM(a.montantusd) AS mont_usd,a.date_vers,b.nom_user
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user AND a.date_vers=:dte AND a.user_vers=:id_user
        AND  a.id_hotel=:id_hotel AND a.type_vers='hebergement' GROUP BY a.date_vers,a.user_vers");
        $requete->BindParam(':dte',$dte);
        $requete->BindParam(':id_user',$_SESSION['id_user']);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        $verser_usd=0;
        $verser_cdf=0;
        foreach ($result as $r) {
        $_SESSION['verser_usd']=$verser_usd=$r->mont_usd;
        $_SESSION['verser_cdf']=$verser_cdf=$r->mont_cdf;
        }
        $_SESSION['solde_cdf']=$solde_cdf=$averser_cdf-$verser_cdf;
        $_SESSION['solde_usd']=$solde_usd=$averser_usd-$verser_usd;
        ?>
         <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel">Versement Caisse</h5>
            </div>
            <div class="modal-body" id="popup_paie">
            <div id="outputvers"></div>
                <form action='<?php echo H_ADMIN_MAIN . '&view=t_versement&do=addversement'; ?>' method="post" id="formversement">
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">
                                       
                                       <div class="col-lg-12" style="overflow: auto; height: 350px;">
                                         <div class="col-lg-12 form-group">
                                            <p class="text-center">
                                                <strong>DETAILS VENTE DU <?php echo date('d/m/Y');?></strong>
                                            </p>
                                        </div>
                                        <div class="box-body table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>USD</th>
                                                <th>CDF</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                             <tr>
                                                <th>FOND DE CAISSE</th>
                                                <td><?php echo afficheMontant($musd,$fond_usd) ?></td>
                                                <td><?php echo afficheMontant($mcdf,$fond_cdf) ?></td>
                                            </tr>
                                             <tr>
                                                <th>MONTANT PERCU</th>
                                                <td><?php echo afficheMontant($musd,$percu_usd) ?></td>
                                                <td><?php echo afficheMontant($mcdf,$percu_cdf)?></td>
                                            </tr>
                                             <tr>
                                                <th>RENDU</th>
                                                <td><?php echo afficheMontant($musd,$rendu_usd) ?></td>
                                                <td><?php echo afficheMontant($mcdf,$rendu_cdf)?></td>
                                            </tr>
                                            <tr>
                                                <th>MONTANT A VERSER</th>
                                                <td><?php echo afficheMontant($musd,$averser_usd)?></td>
                                                <td><?php echo afficheMontant($mcdf,$averser_cdf) ?></td>
                                            </tr>
                                             <tr>
                                                <th>MONTANT VERSE</th>
                                                <td><?php echo afficheMontant($musd,$verser_usd)?></td>
                                                <td><?php echo afficheMontant($mcdf,$verser_cdf) ?></td>
                                            </tr>
                                            <tr>
                                                <th>SOLDE </th>
                                                <td><?php echo afficheMontant($musd,$solde_usd)?></td>
                                                <td><?php echo afficheMontant($mcdf,$solde_cdf) ?></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                        <div class="col-lg-12 form-group">
                                            <p class="text-center">
                                                <strong>REPARTITION ET BILLETAGE DES MONTANTS</strong>
                                            </p>
                                        </div>
                                        
                                            <div class="col-lg-5">
                                            <div class="form-group">
                                                <input type="hidden" id="averser_usd" name="averser_usd"  value="<?php echo $solde_usd;?>">
                                                <input type="hidden" id="averser_cdf" name="averser_cdf"  value="<?php echo $solde_cdf;?>">
                                                <label>Montant en USD</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_usd" name="montant_usd"
                                                           class="form-control text-right text-blue " value="0">
                                                    <span class="input-group-addon">USD</span>
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <tr>
                                                    <th class="text-center" style="width: 50%">BILLETS</th>
                                                    <th class="text-center" style="width: 50%">NOMBRES</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">100 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="100usd" id="100usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">50 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="50usd" id="50usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">20 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="20usd" id="20usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">10 USD</td>
                                                    <td class="text-center" style="width: 50%"><input name="10usd" id="10usd" type="number" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">5 USD</td>
                                                    <td class="text-center" style="width: 50%"><input name="5usd" id="5usd" type="number" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">1 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="1usd" id="1usd" min="0" value="0"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-5 pull-right">
                                            <div class="form-group">
                                                <label>Montant en CDF</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_cdf" name="montant_cdf"
                                                           class="form-control text-right text-blue " value="0">
                                                    <span class="input-group-addon">CDF</span>
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <tr>
                                                    <th class="text-center" style="width: 50%">BILLETS</th>
                                                    <th class="text-center" style="width: 50%">NOMBRES</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">20.000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="20000cdf" id="20000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">10.000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="10000cdf" id="10000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">5.000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="5000cdf" id="5000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">1000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="1000cdf" id="1000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">500 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input name="500cdf" id="500cdf" type="number" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">200 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input name="200cdf" id="200cdf" type="number" min="0" value="0"></td>
                                                </tr>
                                                  <tr>
                                                    <td class="text-center" style="width: 50%">100 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input name="100cdf" id="100cdf" type="number" min="0" value="0"></td>
                                                </tr>
                                                  <tr>
                                                    <td class="text-center" style="width: 50%">50 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input name="50cdf" id="50cdf" type="number" min="0" value="0"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class=" modal-footer">
                        <div id="msg" class="alert alert-success alert-dismissable" style="display: none">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                </div>
                <span class="btn btn-danger loader hidden">
                <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours!
                </span>
                        <button type="submit" id="verser_montant_heb" class="btn btn-primary"><i class="fa fa-check fa-fw"></i>&nbsp;Valider
                        </button>
                </form>
            </div>
        </div>

    </div>
    </div>
      <?php      
        }
        //SCRIPT PERSONNALISES
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->t_versement_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->t_versement_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=t_versement&do=viewall');
            } else {
                $result = $this->t_versement_model->SelectAll();
                $bdd = HDB::hus();
                $users= ListeUsers($bdd);
            }
            include(APP_FOLDER . '/views/admin/t_versement/View.php');
        }elseif(get('do') == 'addversement2'){
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            $montant_cdf =post('montant_cdf');
            $montant_usd =post('montant_usd');
            $user_vers =post('user_vers');
            $dtevers=post('dtevers');
            if($user_vers==''){
                $json['message'] = json_success2("Veuillez choisir un agent!");
            }elseif(empty($dtevers)){
                  $json['message'] = json_success2("Veuillez sélectionner une date");
            }
            elseif(empty($montant_cdf) && empty($montant_usd)){
                  $json['message'] = json_success2("Veuillez saisir les montants!");
            }
//            else if ($_POST['montant_cdf'] > $_POST['averser_cdf']) {
//                $json['message'] = json_success2("Le montant CDF " . $_POST['montant_cdf'] . " ne doit pas etre superieur au montant " . $_POST['averser_cdf'] . " à verser.");
//            } 
//            else if ($_POST['montant_usd'] > $_POST['averser_usd']) {
//                $json['message'] = json_success2("Le montant USD " . $_POST['montant_usd'] . " ne doit pas etre superieur au montant " . $_POST['averser_usd'] . " à verser.");
//            } 
            else {
                $bdd = HDB::hus();
                $motif_id_resto = '';
                $paie_id = '';
                $type_vers = 'hebergement';
                $motif = 'hebergement';
                $id_hotel = $_SESSION['id_hotel'];
                $id_sousresto = Null;
                $lib = 'BVH';
                $num_cmd = getnumerotation($id_hotel, $lib, $bdd);
                $num_cmd_format = format_numero($num_cmd);
                $numbon =$lib.$num_cmd_format;
                $dte=dateToformatBdd($dtevers);
                insertmontantVersement($user_vers, $dte, $montant_cdf, $montant_usd, $_SESSION['Paie_affiche'], $type_vers, $_SESSION['Paie_taux'], $motif, $paie_id, $id_hotel, $id_sousresto, $numbon, $bdd);
                setnumerotation($id_hotel, $lib, $num_cmd + 1, $bdd);
                $json['message'] = 'OK';
                $_SESSION['numero_vers'] = $numbon;
                $_SESSION['montant_usd'] = $montant_usd;
                $_SESSION['montant_cdf'] = $montant_cdf;
                //Billetage
                //USD
                $_SESSION['100usd'] = $_POST['100usd'];
                $_SESSION['50usd'] = $_POST['50usd'];
                $_SESSION['20usd'] = $_POST['20usd'];
                $_SESSION['10usd'] = $_POST['10usd'];
                $_SESSION['5usd'] = $_POST['5usd'];
                $_SESSION['1usd'] = $_POST['1usd'];

                //CDF
                $_SESSION['20000cdf'] = $_POST['20000cdf'];
                $_SESSION['10000cdf'] = $_POST['10000cdf'];
                $_SESSION['5000cdf'] = $_POST['5000cdf'];
                $_SESSION['1000cdf'] = $_POST['1000cdf'];
                $_SESSION['500cdf'] = $_POST['500cdf'];
                $_SESSION['200cdf'] = $_POST['200cdf'];
                $_SESSION['100cdf'] = $_POST['100cdf'];
                $_SESSION['50cdf'] = $_POST['50cdf'];
                $json['message'] = json_success2("Versement effectué avec succes.");
                $json['dtevers'] =$dte;
                $json['s'] = true;
            }
            echo json_encode($json);
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_versement_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_versement/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_versement_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/t_versement/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->t_versement_model->AutoSearch(trim($qstring), 10, 'user_vers');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_versement&id=' . $srow->id . '&do=details"><li class="list-group-item">' . $srow->user_vers . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            include(APP_FOLDER . '/views/admin/t_versement/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('user_vers') == '') {
                    json_error('The field user vers cannot be empty!');
                } elseif (post('date_vers') == '') {
                    json_error('The field date vers cannot be empty!');
                } elseif (post('montant_vers') == '') {
                    json_error('The field montant vers cannot be empty!');
                } elseif (post('montantusd') == '') {
                    json_error('The field montantusd cannot be empty!');
                } elseif (post('monaie_vers') == '') {
                    json_error('The field monaie vers cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error('The field taux cannot be empty!');
                } elseif (post('motif') == '') {
                    json_error('The field motif cannot be empty!');
                } elseif (post('type_vers') == '') {
                    json_error('The field type vers cannot be empty!');
                } elseif (post('paie_id') == '') {
                    json_error('The field paie id cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                } else {
                    $this->t_versement_model->Insert(post('user_vers'), post('date_vers'), post('montant_vers'), post('montantusd'), post('monaie_vers'), post('taux'), post('motif'), post('type_vers'), post('paie_id'), post('id_hotel'));
                    json_send('' . H_ADMIN . '&view=t_versement&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->t_versement_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/t_versement/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id') == '') {
                    json_error('The field id cannot be empty!');
                } elseif (post('user_vers') == '') {
                    json_error('The field user vers cannot be empty!');
                } elseif (post('date_vers') == '') {
                    json_error('The field date vers cannot be empty!');
                } elseif (post('montant_vers') == '') {
                    json_error('The field montant vers cannot be empty!');
                } elseif (post('montantusd') == '') {
                    json_error('The field montantusd cannot be empty!');
                } elseif (post('monaie_vers') == '') {
                    json_error('The field monaie vers cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error('The field taux cannot be empty!');
                } elseif (post('motif') == '') {
                    json_error('The field motif cannot be empty!');
                } elseif (post('type_vers') == '') {
                    json_error('The field type vers cannot be empty!');
                } elseif (post('paie_id') == '') {
                    json_error('The field paie id cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                } else {
                    $this->t_versement_model->Update(post('user_vers'), post('date_vers'), post('montant_vers'), post('montantusd'), post('monaie_vers'), post('taux'), post('motif'), post('type_vers'), post('paie_id'), post('id_hotel'), post('id'));
                    json_send('' . H_ADMIN . '&view=t_versement&id=' . post('id') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->t_versement_model->SelectOne(get('id'));
            include(APP_FOLDER . '/views/admin/t_versement/Details.php');
        }



        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_versement_model->TruncateTable('' . H_ADMIN . '&view=t_versement&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_versement/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id') and $dfile == '') {
                $del = $this->t_versement_model->Delete(get('id'), '' . H_ADMIN . '&view=t_versement&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->t_versement_model->Delete(get('id'), '' . H_ADMIN . '&view=t_versement&do=viewall&msg=delete');
            } elseif (get('id') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=t_versement&id=' . get('id') . '&do=update&msg=delete');
            }
        }
    }

//end invoke
}

//end class
?>
	