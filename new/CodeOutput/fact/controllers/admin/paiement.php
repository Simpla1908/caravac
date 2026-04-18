<?php
/*
 * =======================================================================
 * FILE NAME:        paiement.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		paiement
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/paiement.php');
include(APP_FOLDER . '/models/objects/t_facture.php');
include(APP_FOLDER . '/models/objects/t_mode_reglement.php');
include(APP_FOLDER . '/models/objects/compteur.php');
include(APP_FOLDER . '/models/objects/t_client.php');

class paiement_controller
{

    public $paiement_model;

    public function __construct()
    {
        $this->paiement_model = new paiement_model();
    }

    public function invoke_paiement()
    {
        $ot_facture = new t_facture_model();
        $ot_mode_reglement = new t_mode_reglement_model();
        $compteurobj = new compteur_model();
        $ot_client = new t_client_model();


        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $dte = date('Y-m-d');
            $sql = "SELECT a.id_fact,a.num_fact,b.id_regl,b.numero,b.dte,c.montant,c.montantusd,c.montantcdf,c.taux,d.id_mode_regl,d.lib,e.id_client,e.nom_client
         FROM t_facture AS a, t_reglement AS b, paiement AS c,t_mode_reglement AS d, t_client AS e
         WHERE  a.id_fact=b.id_fact
               AND b.id_regl=c.regl_id
               AND c.id_mode_regl=d.id_mode_regl
               AND e.id_client=a.id_client
               AND a.type='facturation'
               AND b.dte=:dte
               AND a.id_hotel=:id_hotel
               ORDER BY e.nom_client,a.num_fact,b.numero ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            $datedebut = $datefin = date('Y-m-d');
            $sql = "SELECT a.id_fact,a.num_fact,b.id_regl,b.numero,b.dte,c.montant,c.montantusd,c.montantcdf,c.taux,d.id_mode_regl,d.lib,e.id_client,e.nom_client
         FROM t_facture AS a, t_reglement AS b, paiement AS c,t_mode_reglement AS d, t_client AS e
         WHERE  a.id_fact=b.id_fact
               AND b.id_regl=c.regl_id
               AND c.id_mode_regl=d.id_mode_regl
               AND e.id_client=a.id_client
               AND a.type='facturation'
               AND b.dte BETWEEN :datedebut AND :datefin
               AND a.id_hotel=:id_hotel
               ORDER BY e.nom_client,a.num_fact,b.numero ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':datedebut', $datedebut);
            $requete->BindParam(':datefin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $result2 = $requete->fetchAll(PDO::FETCH_OBJ);
            $cash = 0;
            $credit = 0;
            $don = 0;
            foreach ($result2 as $rows) {
                $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant);
                if ($rows->lib == 'Cash') {
                    $cash += $montant;
                } else if ($rows->lib == 'Credit') {
                    $credit += $montant;
                } else {
                    $don += $montant;
                }
            }
            // var_dump($result2);
            include(APP_FOLDER . '/views/admin/paiement/View.php');
        }
        //verification dates
        elseif (get('do') == 'verifdates') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if (post('datedebut') == '' || post('datefin') == '') {
                $json['message'] = json_error2('Veuillez remplir tous les champs');
            } else {
                $json['s'] = true;
            }
            echo json_encode($json);
        }
        // fin verification dates
        //Filtrage facture
        elseif (get('do') == 'filtrerfactures') {
?>
            <select id="facture" name="facture" class="form-control chx_facture choz">
                <option value="">Sélectionner une facture</option>
                <?php
                $result1 = $ot_facture->SelectAllInvoice($_SESSION['idsite']);
                foreach ($result1 as $rows) {
                    MontantsFacture($rows->id_fact);
                    if ($_SESSION['datas_exist'] == 1) {
                        if ($_SESSION['montant_a_paye'] > 0) {
                ?>
                            <option montanttot="<?php echo $rows->mont_ttc_remise; ?>" idclientopt="<?php echo $rows->id_client; ?>" nomclientopt="<?php echo $rows->nom_client; ?>" monnaieopt="<?php echo $rows->monnaie; ?>" tvaopt="<?php echo $rows->tva; ?>" taux="<?php echo $rows->taux; ?>" montttcremise="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $_SESSION['montant_a_paye'])); ?>" montttcremise1="<?php echo arrondir($_SESSION['montant_a_paye']); ?>" montttc="<?php echo $rows->mont_ttc; ?>" monttva="<?php echo $rows->mont_tva; ?>" montanttotal="<?php echo montant_equivalent_bdd($rows->monnaie, $_SESSION['Paie_affiche'], $rows->taux, $rows->montant_total); ?>" dtetion="<?php echo $rows->date_edition; ?>" nfac="<?php echo $rows->num_fact; ?>" value="<?php echo $rows->id_fact; ?>"><?php echo $rows->num_fact; ?></option>
                        <?php
                        }
                    } else {
                        ?>
                        <option montanttot="<?php echo $rows->mont_ttc_remise; ?>" idclientopt="<?php echo $rows->id_client; ?>" nomclientopt="<?php echo $rows->nom_client; ?>" monnaieopt="<?php echo $rows->monnaie; ?>" tvaopt="<?php echo $rows->tva; ?>" taux="<?php echo $rows->taux; ?>" montttcremise="<?php echo arrondir(montant_equivalent_bdd($rows->monnaie, getsymbole_devise(), $rows->taux, $rows->mont_ttc_remise)); ?>" montttcremise1="<?php echo arrondir($rows->mont_ttc_remise); ?>" montttc="<?php echo $rows->mont_ttc; ?>" monttva="<?php echo $rows->mont_tva; ?>" montanttotal="<?php echo montant_equivalent_bdd($rows->monnaie, $_SESSION['Paie_affiche'], $rows->taux, $rows->montant_total); ?>" dtetion="<?php echo $rows->date_edition; ?>" nfac="<?php echo $rows->num_fact; ?>" value="<?php echo $rows->id_fact; ?>"><?php echo $rows->num_fact; ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <?php
        }
        //fin filtrage
        elseif (get('do') == 'filtrerpaie') {

            $datedebut = dateToformatBdd(post('datedebut'));
            $datefin = dateToformatBdd(post('datefin'));
            $sql = "SELECT a.id_fact,a.num_fact,b.id_regl,b.numero,b.dte,c.montant,c.montantusd,c.montantcdf,c.taux,d.id_mode_regl,d.lib,e.id_client,e.nom_client
         FROM t_facture AS a, t_reglement AS b, paiement AS c,t_mode_reglement AS d, t_client AS e
         WHERE  a.id_fact=b.id_fact
               AND b.id_regl=c.regl_id
               AND c.id_mode_regl=d.id_mode_regl
               AND e.id_client=a.id_client
               AND a.type='facturation'
               AND b.dte BETWEEN :datedebut AND :datefin
               AND a.id_hotel=:id_hotel
               ORDER BY e.nom_client,a.num_fact,b.numero ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':datedebut', $datedebut);
            $requete->BindParam(':datefin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            $json['s'] = true;
            //Mise en session pour impression
            $_SESSION['rows_paiement'] = array();
            $_SESSION['rows_paiement']['i'] = array();
            $_SESSION['rows_paiement']['nom_client'] = array();
            $_SESSION['rows_paiement']['num_fact'] = array();
            $_SESSION['rows_paiement']['numero'] = array();
            $_SESSION['rows_paiement']['dte'] = array();
            $_SESSION['rows_paiement']['lib'] = array();
            $_SESSION['rows_paiement']['montant'] = array();
            //Fin mise en session
            $i = 1;
            $cash = 0;
            $credit = 0;
            $don = 0;
            foreach ($result as $rows) {
                $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant);
                if ($rows->lib == 'Cash') {
                    $cash += $montant;
                } else if ($rows->lib == 'Credit') {
                    $credit += $montant;
                } else {
                    $don += $montant;
                }
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo dateAffiche($rows->dte); ?></td>
                    <td><?php echo $rows->numero; ?></td>
                    <td><?php echo $rows->num_fact; ?></td>
                    <td><?php echo $rows->nom_client; ?></td>
                    <td>
                        <?php
                        echo $rows->lib;
                        ?>
                    </td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant); ?></td>
                    <td class="table-actions">
                        <div class="btn-group">
                            <a class="btn btn-default btn-xs tip btn_pntrecu_histo" factureid="<?php echo $rows->id_fact; ?>" mode="<?php echo $rows->lib; ?>" dte="<?php echo $rows->dte; ?>" client="<?php echo $rows->nom_client; ?>" numfact="<?php echo $rows->num_fact; ?>" recu="<?php echo $rows->numero; ?>" montantusd="<?php echo $rows->montantusd; ?>" montantcdf="<?php echo $rows->montantcdf; ?>" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                        </div>
                    </td>

                </tr>
            <?php
                //Mise en session pour impression
                array_push($_SESSION['rows_paiement']['i'], $i);
                array_push($_SESSION['rows_paiement']['nom_client'], $rows->nom_client);
                array_push($_SESSION['rows_paiement']['num_fact'], $rows->num_fact);
                array_push($_SESSION['rows_paiement']['numero'], $rows->numero);
                array_push($_SESSION['rows_paiement']['dte'], dateAffiche($rows->dte));
                array_push($_SESSION['rows_paiement']['lib'], $rows->lib);
                array_push($_SESSION['rows_paiement']['montant'], afficheMontant($_SESSION['Paie_affiche'], $montant));
                //Fin mise en session
                $i++;
            }
        } elseif (get('do') == 'filtrerpaie1') {

            $datedebut = dateToformatBdd(post('datedebut'));
            $datefin = dateToformatBdd(post('datefin'));
            $sql = "SELECT a.id_fact,a.num_fact,b.id_regl,b.numero,b.dte,c.montant,c.montantusd,c.montantcdf,c.taux,d.id_mode_regl,d.lib,e.id_client,e.nom_client
         FROM t_facture AS a, t_reglement AS b, paiement AS c,t_mode_reglement AS d, t_client AS e
         WHERE  a.id_fact=b.id_fact
               AND b.id_regl=c.regl_id
               AND c.id_mode_regl=d.id_mode_regl
               AND e.id_client=a.id_client
               AND a.type='facturation'
               AND b.dte BETWEEN :datedebut AND :datefin
               AND a.id_hotel=:id_hotel
               ORDER BY e.nom_client,a.num_fact,b.numero ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':datedebut', $datedebut);
            $requete->BindParam(':datefin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            $json['s'] = true;
            $cash = 0;
            $credit = 0;
            $don = 0;
            foreach ($result as $rows) {
                $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant);
                if ($rows->lib == 'Cash') {
                    $cash += $montant;
                } else if ($rows->lib == 'Credit') {
                    $credit += $montant;
                } else {
                    $don += $montant;
                }
            }
            ?>
            <tr>
                <th colspan="6">Total Cash</th>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cash); ?></td>
            </tr>
            <tr>
                <th colspan="6">Total Credit</th>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $credit); ?></td>
            </tr>
            <tr>
                <th colspan="6">Total Acompte</th>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $don); ?></td>
            </tr>
            <tr>
                <th colspan="6">TOTAUX</th>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $cash + $credit + $don); ?></td>
            </tr>
            <?php
            //Mise en session pour impression
            $_SESSION['datedebut_paiement'] = post('datedebut');
            $_SESSION['datefin_paiement'] = post('datefin');
            $_SESSION['cash_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $cash);
            $_SESSION['credit_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $credit);
            $_SESSION['don_paiement'] = afficheMontant($_SESSION['Paie_affiche'], $don);

            //Fin mise en session
        } elseif (get('do') == 'extraittva') {
            $dte = date('Y-m-d');
            $sql = "SELECT id_fact,num_fact,mont_ttc AS montant_total,mont_tva,taux,monnaie,tva,mont_ttc_remise 
                    FROM t_facture
                    WHERE type='facturation' AND date_edition=:dte AND id_hotel=:id_hotel AND etat=1 AND mont_tva>0
                    ORDER BY num_fact ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            //var_dump($result);
            include(APP_FOLDER . '/views/admin/paiement/extraittva.php');
        } elseif (get('do') == 'filtrerextraittva') {
            $datedebut = dateToformatBdd(post('datedebut'));
            $datefin = dateToformatBdd(post('datefin'));

            $sql = "SELECT id_fact,num_fact,montant_total,mont_tva,taux
         FROM t_facture
         WHERE type='facturation'AND date_edition BETWEEN :datedebut AND :datefin AND id_hotel=:id_hotel AND etat=1 AND montant_total>0
         ORDER BY num_fact ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':datedebut', $datedebut);
            $requete->BindParam(':datefin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            //Mise en session pour impression
            $_SESSION['rows_paiement'] = array();
            $_SESSION['rows_paiement']['i'] = array();
            $_SESSION['rows_paiement']['num_fact'] = array();
            $_SESSION['rows_paiement']['montant_ttc'] = array();
            $_SESSION['rows_paiement']['montant_tva'] = array();

            //Fin mise en session
            $montant_ttc_tot = 0;
            $montant_tva_tot = 0;
            $i = 1;
            foreach ($result as $rows) {
                $montant_ttc = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant_total);
                $montant_tva = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->mont_tva);
                $montant_ttc_tot += $montant_ttc;
                $montant_tva_tot += $montant_tva;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rows->num_fact; ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_ttc); ?></td>
                    <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tva); ?></td>
                </tr>
            <?php
                //Mise en session pour impression
                array_push($_SESSION['rows_paiement']['i'], $i);
                array_push($_SESSION['rows_paiement']['num_fact'], $rows->num_fact);
                array_push($_SESSION['rows_paiement']['montant_ttc'], afficheMontant($_SESSION['Paie_affiche'], $montant_ttc));
                array_push($_SESSION['rows_paiement']['montant_tva'], afficheMontant($_SESSION['Paie_affiche'], $montant_tva));
                //Fin mise en session
                $i++;
            }
        } elseif (get('do') == 'filtrerextraittva1') {
            $datedebut = dateToformatBdd(post('datedebut'));
            $datefin = dateToformatBdd(post('datefin'));
            $sql = "SELECT id_fact,num_fact,montant_total,mont_tva,taux
         FROM t_facture
         WHERE type='facturation'AND date_edition BETWEEN :datedebut AND :datefin AND id_hotel=:id_hotel AND etat=1 AND montant_total>0
         ORDER BY num_fact ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':datedebut', $datedebut);
            $requete->BindParam(':datefin', $datefin);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            $montant_ttc_tot = 0;
            $montant_tva_tot = 0;
            foreach ($result as $rows) {
                $montant_ttc = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant_total);
                $montant_tva = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->mont_tva);
                $montant_ttc_tot += $montant_ttc;
                $montant_tva_tot += $montant_tva;
            }
            ?>
            <tr>
                <th colspan="2">Total</th>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_ttc_tot); ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant_tva_tot); ?></td>
            </tr>
<?php
            //Mise en session pour impression
            $_SESSION['datedebut_paiement'] = post('datedebut');
            $_SESSION['datefin_paiement'] = post('datefin');
            $_SESSION['montant_ttc_tot'] = afficheMontant($_SESSION['Paie_affiche'], $montant_ttc_tot);
            $_SESSION['montant_tva_tot'] = afficheMontant($_SESSION['Paie_affiche'], $montant_tva_tot);
            //Fin mise en session
        }

        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->paiement_model->SelectAll();
            include(APP_FOLDER . '/views/admin/paiement/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->paiement_model->SelectOne(get('idpaie'));
            include(APP_FOLDER . '/views/admin/paiement/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->paiement_model->AutoSearch(trim($qstring), 10, 'montant');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=paiement&idpaie=' . $srow->idpaie . '&do=details"><li class="list-group-item">' . $srow->montant . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }
        //miseensessionrecu
        elseif (get('do') == 'miseensessionrecu') {
            MontantsFacture(get('factureid'));
            $_SESSION['first_print'] = 0;
            $_SESSION['montant_total1'] = $_SESSION['montant_total'];
            $_SESSION['montant_paye1'] = $_SESSION['montant_paye'];
            $_SESSION['montant_a_paye1'] = $_SESSION['montant_a_paye'];
            $_SESSION['numero_fact'] = get('numfact');
            $_SESSION['numero_recu'] = get('recu');
            $_SESSION['montantcdf'] = arrondir(get('montantcdf'));
            $_SESSION['montantusd'] = arrondir(get('montantusd'));
            $_SESSION['nomclient'] = get('client');
            $_SESSION['dte_paie'] = dateAffiche(get('dte'));
            $_SESSION['libmode'] = get('mode');
        }
        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $id_fact = get('id_fact');
            $modepaie = get('modepaie');
            $result1 = $ot_facture->SelectAllInvoice($id_fact);
            $result2 = $ot_mode_reglement->SelectAllMode();
            MontantsFacture($id_fact);
            $_SESSION['montant_total1'] = $_SESSION['montant_total'];
            $_SESSION['montant_paye1'] = $_SESSION['montant_paye'];
            $_SESSION['montant_a_paye1'] = $_SESSION['montant_a_paye'];
            include(APP_FOLDER . '/views/admin/paiement/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            $bdd = HDB::hus();
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if ($_POST) {
                //important checking
                $montantpaye = (post('montantusd') * $_SESSION['Paie_taux']) + post('montantcdf');
                //form validation
                if (post('facture') == '') {
                    $json['message'] = json_error2('Veuillez selectionner une facture!');
                } elseif (post('mode') == '') {
                    $json['message'] = json_error2('Veuillez selectionner le mode de paiement!');
                } elseif (post('montantcdf') == '') {
                    $json['message'] = json_error2('Veuillez saisir le montant en CDF!');
                } elseif (post('montantusd') == '') {
                    $json['message'] = json_error2('Veuillez saisir le montant en USD!');
                } else if (post('libelle_mode') == 'Cash' && (post('montantusd') == 0 && post('montantcdf') == 0)) {
                    $json['message'] = json_error2('Veuillez saisir les montant exacts!');
                } else if (post('libelle_mode') == 'Cash' && (post('montant') != $montantpaye)) {
                    $json['message'] = json_error2('Veuillez payer la totalité du montant total de la facture!');
                } else {
                    $id_fact = post('id_fact');
                    $num_fact = post('num_fact');
                    $mode = post('mode');
                    $libmode = post('libelle_mode');
                    $nomclient = post('nomclient');
                    $montantusd = post('montantusd');
                    $montantcdf = post('montantcdf');
                    $montant = post('montant');
                    $justification = post('justification');
                    if ($libmode == 'Don') {
                        $montantusd = 0;
                        //                        $montantcdf = $montant;
                        $montantcdf = 0;
                    }
                    //$this->paiement_model->Insert(post('montant'),post('montantusd'),post('montantcdf'),post('taux'),post('rendu'),post('remise'),post('justification'),post('id_mode_regl'),post('id_monnaie'),post('regl_id'),post('site_id'),post('company_id'));
                    /* Insertion dans t_reglement */
                    $dte = date('Y-m-d');
                    $date_h_com = date('Y-m-d H:i:s');
                    $rejete = 1;
                    //GET REFERENCE
                    $libreglement = NUM_REGLEMENT;
                    $num_cmd = $compteurobj->getnumerotation($_SESSION['id_hotel'], $libreglement);
                    $num_cmd_format = format_numero($num_cmd);
                    $ref = $_SESSION['prefsanct'] . $num_cmd_format;

                    //MAJ REFERENCE
                    $num_cmd += 1;
                    $compteurobj->Update($libreglement, $num_cmd, $_SESSION['id_hotel']);
                    $taux_op = $_SESSION['Paie_taux'];
                    $montant_remise = 0;
                    $montantsaisi = $montantusd * $taux_op + $montantcdf;
                    $rendu = 0;
                    $dejapayee = 1;
                    $requete = HDB::hus()->prepare("UPDATE t_facture  SET mode =:mode,dejapayee=:dejapayee WHERE id_fact=:id_fact");
                    $requete->BindParam(':mode', $libmode);
                    $requete->BindParam(':dejapayee', $dejapayee);
                    $requete->BindParam(':id_fact', $id_fact);
                    $requete->execute();

                    $requete = HDB::hus()->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel,rejete)
                                    VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel,:rejete)");
                    $requete->BindParam(':numero', $ref);
                    $requete->BindParam(':id_fact', $id_fact);
                    $requete->BindParam(':date_regl', $date_h_com);
                    $requete->BindParam(':dte', $dte);
                    $requete->BindParam(':id_user', $_SESSION['id_user']);
                    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                    $requete->BindParam(':rejete', $rejete);
                    $requete->execute();
                    $regl_id = HDB::hus()->lastInsertId();
                    /* Fin d'Insertion dans t_reglement */
                    /* Insertion dans paiement */
                    $requete = HDB::hus()->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,regl_id,site_id,company_id)
                                VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id)");
                    $requete->BindParam(':montant', $montantsaisi);
                    $requete->BindParam(':montantusd', $montantusd);
                    $requete->BindParam(':montantcdf', $montantcdf);
                    $requete->BindParam(':rendu', $rendu);
                    $requete->BindParam(':taux', $taux_op);
                    $requete->BindParam(':remise', $montant_remise);
                    $requete->BindParam(':justification', $justification);
                    $requete->BindParam(':id_mode_regl', $mode);
                    $requete->BindParam(':regl_id', $regl_id);
                    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                    $requete->BindParam(':company_id', $_SESSION['company_id']);
                    $requete->execute();
                    $paie_id = HDB::hus()->lastInsertId();
                    if ($libmode == "Cash" || $libmode == "Credit") {
                        include 'paiement_caisse.php';
                    }
                    /* Fin d'Insertion paiement */
                    $_SESSION['first_print'] = 1;
                    MontantsFacture($id_fact);
                    $_SESSION['montant_total1'] = $_SESSION['montant_total'];
                    $_SESSION['montant_paye1'] = $_SESSION['montant_paye'];
                    $_SESSION['montant_a_paye1'] = $_SESSION['montant_a_paye'];
                    $_SESSION['numero_fact'] = $num_fact;
                    $_SESSION['numero_recu'] = $ref;
                    if ($libmode == 'Don') {
                        $_SESSION['montantcdf'] = arrondir($montant);
                    } else {
                        $_SESSION['montantcdf'] = arrondir($montantcdf);
                    }
                    //COMPTA
                    $module_id = 23;
                    $site_id = $_SESSION['id_hotel'];
                    ConfLinkMod($module_id, $site_id, $bdd);
                    if ($_SESSION['ConfLinkMod_lie'] == 1) {
                        $compte1 = post('compte1');
                        $compte2 = post('compte2');
                        $mont_ttc = $montant;
                        $tva = $_SESSION['tva'];
                        $lib_mode = $libmode;
                        $numero = $num_fact;
                        $account = $compte1 . $compte2;
                        CreateAcountForCustomer($compte1, $compte2, $account, $nomclient, $site_id, $bdd);
                        $reference = $numero;
                        $devise = getsymbole_devise();
                        $tauxop = $taux_op;
                        $libelle = '';
                        $beneficiaire = $nomclient;
                        $site_id = $_SESSION['id_hotel'];
                        $user_id = $_SESSION['id_user'];
                        $ttc = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $tauxop, $mont_ttc);
                        $type_rendu = 'oui';
                        $dte = date('Y-m-d');
                        $dtetime = date('Y-m-d H:i:s');
                        $mont_tva = ($ttc * $tva) / 100;
                        $ht = $ttc - $mont_tva;
                        // echo "lib_mode  " . $lib_mode;
                        // echo "ttc  " . $ttc;
                        // echo "montantusd  " . $montantusd;
                        // echo "montantcdf  " . $montantcdf;
                        // echo "devise  " . $devise;
                        if (post('frmdejapayee') == 0) {
                            if ($lib_mode == 'Cash') {
                                COMPTA_VENTE_CASH_RESTO($type_rendu, $reference, $dte, $dtetime, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                            } elseif ($lib_mode == 'Credit' || $lib_mode == 'Acompte') {
                                COMPTA_VENTE_CREDIT_RESTO($type_rendu, $reference, $dte, $dtetime, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                                if ($montantusd > 0 || $montantcdf > 0) {
                                    COMPTA_PAIE_RESTO($reference, $montantusd, $montantcdf, $montantsaisi, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd, $ttc);
                                }
                            }
                        } else {
                            COMPTA_PAIE_RESTO($reference, $montantusd, $montantcdf, $montantsaisi, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd, $ttc);
                        }
                    }
                    //COMPTA
                    $_SESSION['montantusd'] = arrondir($montantusd);
                    $_SESSION['nomclient'] = $nomclient;
                    $_SESSION['libmode'] = $libmode;
                    MontantsFacture($id_fact);
                    if ($_SESSION['montant_a_paye'] <= 0) {
                        $json['paie'] = 'solde';
                    } else {
                        $json['paie'] = 'nsolde';
                    }
                    $json['id_fact'] = $id_fact;
                    $json['message'] = json_success2("Paiement effectué avec succes.");
                    $json['s'] = true;
                    //fin
                }
                echo json_encode($json);
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->paiement_model->SelectOne(get('idpaie'));
            include(APP_FOLDER . '/views/admin/paiement/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('idpaie') == '') {
                    json_error('The field idpaie cannot be empty!');
                } elseif (post('montant') == '') {
                    json_error('The field montant cannot be empty!');
                } elseif (post('montantusd') == '') {
                    json_error('The field montantusd cannot be empty!');
                } elseif (post('montantcdf') == '') {
                    json_error('The field montantcdf cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error('The field taux cannot be empty!');
                } elseif (post('rendu') == '') {
                    json_error('The field rendu cannot be empty!');
                } elseif (post('remise') == '') {
                    json_error('The field remise cannot be empty!');
                } elseif (post('justification') == '') {
                    json_error('The field justification cannot be empty!');
                } elseif (post('id_mode_regl') == '') {
                    json_error('The field id mode regl cannot be empty!');
                } elseif (post('id_monnaie') == '') {
                    json_error('The field id monnaie cannot be empty!');
                } elseif (post('regl_id') == '') {
                    json_error('The field regl id cannot be empty!');
                } elseif (post('site_id') == '') {
                    json_error('The field site id cannot be empty!');
                } elseif (post('company_id') == '') {
                    json_error('The field company id cannot be empty!');
                } else {
                    $this->paiement_model->Update(post('montant'), post('montantusd'), post('montantcdf'), post('taux'), post('rendu'), post('remise'), post('justification'), post('id_mode_regl'), post('id_monnaie'), post('regl_id'), post('site_id'), post('company_id'), post('idpaie'));
                    json_send('' . H_ADMIN . '&view=paiement&idpaie=' . post('idpaie') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->paiement_model->SelectOne(get('idpaie'));
            include(APP_FOLDER . '/views/admin/paiement/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->paiement_model->TruncateTable('' . H_ADMIN . '&view=paiement&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/paiement/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('idpaie') and $dfile == '') {
                $del = $this->paiement_model->Delete(get('idpaie'), '' . H_ADMIN . '&view=paiement&do=viewall&msg=delete');
            } elseif (get('idpaie') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->paiement_model->Delete(get('idpaie'), '' . H_ADMIN . '&view=paiement&do=viewall&msg=delete');
            } elseif (get('idpaie') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=paiement&idpaie=' . get('idpaie') . '&do=update&msg=delete');
            }
        }

        //Extrait de compte 
        if (get('do') == 'extraitcompte') {
            $bdd = HDB::hus();
            $idsite = $_SESSION['idsite'];
            $data = ExtraitDEcompteAll($idsite, $bdd);
            include(APP_FOLDER . '/views/admin/paiement/extraitcompte.php');
        } elseif (get('do') == 'extraitcomptedetail') {
            $bdd = HDB::hus();
            $idclient = get('idclient');
            $nomClient = get('cl');
            $data = ExtraitDEcompte2($idclient, $bdd);
            include(APP_FOLDER . '/views/admin/paiement/extraitcomptedetail.php');
        } elseif (get('do') == 'detailsvente') {
            $bdd = HDB::hus();
            include(APP_FOLDER . '/views/admin/paiement/detailsvente.php');
        } elseif (get('do') == 'detailsventef') {
            $bdd = HDB::hus();
            include(APP_FOLDER . '/views/admin/paiement/detailsventedatas.php');
        }
        //fin extrait de compte
    }

    //end invoke
}

//end class
?>