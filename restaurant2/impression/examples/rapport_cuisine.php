<?php
ini_set('max_execution_time',-1); //300 seconds = 5 minutes
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
ini_set('memory_limit','1024M');
if (!isset($_SESSION)){
    session_start();
 }
include '../../bdd/connexion.php';
include '../../../FUNCTION/hebergement.php';
include '../../../FUNCTION/restaurant.php';
include_once '../../../impression/mpdf60/mpdf.php';
$m_affiche=$_SESSION['m_affiche'];
if($m_affiche=='USD'){
    $m_affiche1='CDF';
}else{
    $m_affiche1='USD';
}
$requete_idhotel = $bdd->prepare("SELECT * FROM  t_hotel WHERE id_hotel=:id_hotel");
$requete_idhotel->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete_idhotel->execute();
while ($donnees = $requete_idhotel->fetch()) {
    $province_hotel = $donnees['province_hotel'];
    $ville_hotel = $donnees['ville_hotel'];
    $nom_c = $donnees['nom_hotel'];
    $adresse_c = $donnees['adresse_hotel'];
    $ville = $donnees['ville_hotel'];
    $logo = $donnees['image'];
    $idnat = $donnees['idnat'];
    $rccm = $donnees['rccm'];
    $num_impot = $donnees['num_impot'];
    $telephone = $donnees['phone'];
    $email_compagny = $donnees['mail'];
    $compte_bancaire = $donnees['cb'];
}
/* Fin de la Recuperation des coordonnées de l'hotel */
?>
<?php
ob_start();
?>
<div id="register" style="border:1px solid white">
    <div id="ticket" >
        <table  style="margin:auto; font-family: monospace; font-size: 14px;">
            <tbody id="entries">
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <b><?php echo strtoupper($nom_c)  ?>
                         <br>
                        <b>(<?php echo strtoupper($_SESSION['libelle_resto'])?>)</b><br>
                        <?php 
                        if($rccm!=''){
                            echo 'RCCM:'.$rccm .'<br>';
                        }
                        ?>
                        <?php 
                        if($idnat!=''){
                            echo 'IDNAT:'. $idnat .'<br>';
                        }
                        ?>
                        <?php echo strtoupper($adresse_c)  ?>
                        <br>
                        <?php echo strtoupper($telephone)  ?>
                        <br>
			</b>
                    </td>
                </tr>
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                     <h2><u>RAPPORT CUISINE</u></h2><br />
                        <small>(Du <?php echo dateAffiche($_SESSION['date_bd1']); ?> au <?php echo dateAffiche($_SESSION['date_bd2']); ?>)</small><br />
                        <?php echo 'Imprimé par';  ?>
                        <br><?php echo $_SESSION['nom_user'];  ?>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <?php 
                    // Liste des tickets pour chaque sous resto
                $requete = $bdd->prepare("SELECT  f.preparer,f.montant_total,f.mont_tva,f.mont_ttc,f.mont_ttc_remise,f.taux,f.tva,f.id_fact,f.num_fact,f.date_edition,r.id_res,r.num_reserv,c.designation,c.id_client,c.nom_client,c.type,f.nomcaisse "
                        . "FROM  t_reservation AS r,t_client AS c,t_facture AS f "
                        . "WHERE f.type='restaurant' AND f.id_client=c.id_client "
                        . "AND r.id_res=f.id_res AND r.id_hotel=:hotel_id AND f.cuisine=1 AND (f.preparer=0 OR f.preparer=1) AND (f.date_edition BETWEEN :date_bd1 AND :date_bd2) ORDER BY r.id_res,f.preparer ASC");
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':date_bd1', $_SESSION['date_bd1']);
                $requete->BindParam(':date_bd2', $_SESSION['date_bd2']);
                $requete->execute();
                $reservation_attente = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($reservation_attente as $ra) {
                    $id = $ra->id_res;
                    $date_edition = $ra->date_edition;
                    $id_fact = $ra->id_fact;
                    $num_fact = $ra->num_fact;
                    $remise_fact = $ra->mont_ttc_remise;
                    $mont_remise = $ra->tva;
                    $tva_fact = $ra->tva;
                    $mont_tva = $ra->mont_tva;
                    $mont_ht = 0;
                    $mont_ttc = $ra->mont_ttc;
                    $id_cl = $ra->id_client;
                    $cmd_num = $ra->num_reserv;
                    $tbl = $ra->designation;
                    $cl = $ra->nom_client;
                    $typ = $ra->type;
                    $nom_serveur=$ra->nomcaisse;
                    if (($typ == 'client') || ($typ == 'serveur')) {
                        $cl_tbl = $cl;
                    } else if ($typ == 'table') {
                        $cl_tbl = $tbl;
                    } else {
                        $cl_tbl = 'Client occasionnel';
                    }
                    $statut='En cours';
                    if($ra->preparer==1){
                        $statut='Preparé';    
                    }
                    if($ra->etat_cmd==3){
                        $statut='Annulé';    
                    }
                $impr=0;
                ReimprimerBC2($id_fact, $impr, $bdd);
                $nbArticles = count($_SESSION['panier']['id_article']);

                  ?>
                <tr>
                    <td  colspan="3" align="center" style="border-bottom: 1px solid black;">
                        <h3>N° FAC :<?php echo $num_fact; ?><br>
                        SERVEUR :<?php echo $nom_serveur; ?><br>
                        STATUT :<?php echo $statut; ?><br>
                         <?php echo $cl_tbl; ?><br>
                         <?php echo dateAffiche($date_edition); ?><br>

                     </h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <?php if ($_SESSION['entree'] == 1) { ?>
                                 <tr>
                                    <td align="center" colspan="3">
                                       <b>ENTREES</b>
                                   </td>

                               </tr> 
                               <tr>

                                <th style="text-align: left;">DESIGNATION</th>
                                <th>QTE</th>
                                <th></th>
                                </tr>


                            <?php
                            $compteur_entree=0;
                            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                                $repas = $_SESSION['panier']['repas'][$i];
                                $genre = $_SESSION['panier']['genre'][$i];

                                if ($repas == 1 && $genre == 1) {
                                    ?>
                                    <tr>
                                        <td><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></td>
                                        <td><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                        <td></td>

                                    </tr>
                                    <?php
                                    $compteur_entree=$compteur_entree+$_SESSION['panier']['qte'][$i];

                                }
                            }
                            ?>
                            <tr>
                                <td><b>TOTAL ENTREES</b></td>
                                <td><b><?php echo $compteur_entree; ?></b></td>
                                <td></td>

                            </tr>
                        <?php } ?>
                        <?php if ($_SESSION['plats'] == 1) { ?>
                         <tr>
                            <td align="center" colspan="3">
                               <b>PLATS</b>
                           </td>

                       </tr> 
                       <tr>

                        <th style="text-align: left;">DESIGNATION</th>
                        <th>QTE</th>
                        <th></th>
                    </tr>


                    <?php
                    $des_plt = '';
                    $kt = 0;
                    $compteur_plat=0;
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $repas = $_SESSION['panier']['repas'][$i];
                        $genre = $_SESSION['panier']['genre'][$i];
                        $des_plt = $_SESSION['panier']['description'][$i];
                        $plat_idc = $_SESSION['panier']['id_article'][$i];

                        if ($repas == 1 && $genre == 0) {
                            ?>
                            <tr>
                                <td><?php echo ucfirst($_SESSION['panier']['nom'][$i]. '</br>' . ' ' . $des_plt); ?></td>
                                <td ><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                                <td></td>

                            </tr>
                            <?php
                            $compteur_plat=$compteur_plat+$_SESSION['panier']['qte'][$i];

                        }
                    }
                    ?>
                    <tr>
                        <td><b>TOTAL PLATS</b></td>
                        <td><b><?php echo $compteur_plat; ?></b></td>
                        <td></td>

                    </tr>
                <?php } ?>
                <?php if ($_SESSION['dessert'] == 1) { ?>
                 <tr>
                    <td align="center" colspan="3">
                       <b>DESSERTS</b>
                   </td>

               </tr> 
               <tr>
                
                <th style="text-align: left;">DESIGNATION</th>
                <th>QTE</th>
                <th></th>
            </tr>
            
            
            <?php
            $compteur_dessert=0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
               $repas = $_SESSION['panier']['repas'][$i];
               $genre = $_SESSION['panier']['genre'][$i];

               if ($repas == 1 && $genre == 0) {
                 
                ?>
                <tr>
                    <td><?php echo ucfirst($_SESSION['panier']['nom'][$i]); ?></td>
                    <td><?php echo $_SESSION['panier']['qte'][$i]; ?></td>
                    <td></td>

                </tr>
                <?php
                $compteur_dessert=$compteur_dessert+$_SESSION['panier']['qte'][$i];

            }
        }
        ?>
        <tr>
            <td><b>TOTAL DESSERT</b></td>
            <td><b><?php echo $compteur_dessert; ?></b></td>
            <td></td>

        </tr>
    <?php } ?>


                 <tr>
                    <td align="center" colspan="3" style="border-top: 1px solid black;"></td>
                </tr> 
 <?php
}
    ?>
                 <tr>
                    <td align="center" colspan="3"><b>
                        <?php echo $_SESSION['mention']; 
                        
                        ?>
                    </b></td>
                </tr>  
        </table>
    </div>
</div>

<?php
$body = ob_get_clean();
$body = iconv("UTF-8", "UTF-8//IGNORE", $body);
$mpdf = new mPDF('c', array(82,5000), 0, '', 0, 0, 0, 0, 0, 0);
$mpdf->WriteHTML($body);
$mpdf->Output("Rapport_cuisine.pdf","I");
