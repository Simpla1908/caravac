<?php
if (!isset($_SESSION)) {
    session_start();
}
include('Traitement/cl_tbl.php');
include '../FUNCTION/restaurant.php';
?>
<div class="panel panel-default box" style="overflow: auto; height: 700px;">
    <ol class="breadcrumb">
        <li id="fermer_tab2"><a href="#"><b> <i class="fa fa-mail-reply-all fa-2x"></i> Liste des clients</b></a></li>
        <?php if (in_array('AR15', $_SESSION['actions']['code_actions'])) { ?>
            <li class="pull-right"><a href="#" id="btn_add_client"><span class="step size-64">
                        <i class="fa fa-user"></i> Ajouter client</span></a>
            </li>
        <?php } ?>
        <div class="form-group">
            <input type="text" name="custom_search" id="custom_search" class="form-control" value="" placeholder="Rechercher un client">
        </div>
    </ol>

    <div class="box-body">
        <div class="row">
            <div class="col-lg-12 listetable_client" id="produit2">



                <!--Clients du restaurant et logés-->
                <?php foreach ($clients as $cl) :
                    $id_client = $cl->id_client;
                    //Commandes du client
                    $bool = CheckAllCmdCustomer($id_client, $bdd);
                    $bg_maroon = "";
                    $AllCmdCustomer = "";
                    if ($bool == 1) {
                        $bg_maroon = "bg-maroon";
                    }
                    //Commandes du client


                    $nom_client = $cl->nom_client;
                    $type_client = $cl->type;
                    $type_cl = $cl->type_cl;
                    $aff_cl = 0;
                    $id_ch = 0;
                    $id = 0;
                    $idreserv = 0;
                    $num_ch = 0;
                    $etat_table = 'libre';
                    $id_sousresto = $cl->idsousdepotfact;
                    $user_attente = $cl->user_attente;
                    $nbrcouvert = $cl->nbrcouvert;
                    $fusion = $cl->fusion;
                    if ($cl->en_attente == 1) {
                        $etat_table = 'occupe';
                    }
                    $requete = $bdd->prepare("SELECT cl.id_client,cl.id_hotel,cl.type,cl.nom_client,ch.id_ch,ch.num_ch,rc.id,rc.idreserv "
                        . "               FROM  t_client AS cl ,t_chambre AS ch, t_reserve_chambre AS rc "
                        . "               WHERE rc.id_client=cl.id_client AND rc.idchambre=ch.id_ch "
                        . "                     AND rc.statut='occupe' AND cl.id_client=:id_client AND cl.pseudo_supp=0"
                        . "               ORDER BY cl.id_client ASC");
                    $requete->BindParam(':id_client', $id_client);
                    $requete->execute();
                    $clients2 = $requete->fetchAll(PDO::FETCH_OBJ);
                    foreach ($clients2 as $cl2) :
                        $id_ch = $cl2->id_ch;
                        $id = $cl2->id;
                        $idreserv = $cl2->idreserv;
                        $num_ch = $cl2->num_ch;
                        $aff_cl = 1;
                    endforeach;

                ?>
                    <?php if ($type_cl == 'restaurant' || $aff_cl == 1) { ?>
                        <a class="btn btn-app client_table2 <?php echo $bg_maroon; ?>" id1="<?php echo $id_client; ?>" id2="<?php echo $nom_client; ?>" id3="<?php echo $id_ch; ?>" id4="<?php echo $id; ?>" id5="<?php echo $idreserv; ?>" tp-cl="<?php echo $type_client; ?>" clresto="<?php echo $type_cl; ?>" nbrcouvert="<?php echo $nbrcouvert; ?>" etat_table="<?php echo $etat_table; ?>" id_sousresto="<?php echo $id_sousresto; ?>" user_attente="<?php echo $user_attente; ?>" fusion="<?php echo $fusion; ?>" >
                            <?php echo ucfirst($nom_client); ?><br>
                            <?php if ($num_ch != 0) { ?>
                                <span class="label label-success"><?php echo 'Ch' . $num_ch ?></span>
                            <?php } ?>
                        </a>
                    <?php } ?>
                <?php endforeach; ?>
                <!--Fin Clients du restaurant et logés-->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box -->
</div>