<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Factures
        <!--<small>Example 2.0</small>-->
    </h1>
    <!--    <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Layout</a></li>
            <li class="active">Top Navigation</li>
        </ol>-->
    <span class="text-danger pull-right hidden" id="loader_dte">
        <i class="fa fa-refresh fa-spin fa-1x"></i> Chargement en cours...
    </span>
    <ol class="breadcrumb">
        <form class="form-inline filter_frm">
            <fieldset>
                <input type="hidden" name="sousresto_id" id="sousresto_id" value="<?php echo $_SESSION['id_sousresto'] ?>" />
                <div class="form-group">
                    <label for="ex4">&nbsp;CLIENT&nbsp;</label>
                    <select class="form-control" id="idclient" name="idclient" required>
                        <option value="0">Tous les clients</option>
                        <?php
                        $requete = $bdd->prepare("SELECT * FROM t_client AS u"
                            . " WHERE u.id_hotel=:hotel_id AND u.pseudo_supp=0 AND u.type='client' ORDER BY u.nom_client");
                        //session à enlever
                        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                        $requete->execute();
                        $utilisateurs = $requete->fetchAll(PDO::FETCH_OBJ);

                        foreach ($utilisateurs as $u) :
                            echo '<option value=' . $u->id_client . '>' . ucfirst($u->nom_client) . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-left" name="periode" id="periode" value="<?php echo date("d/m/Y") . ' à ' . date("d/m/Y"); ?>" />
                    <input type="hidden" name="current" id="current" value="0" />
                    <div class="input-group-addon">
                        <a href="#" id="viewfact_btn" title="Valider">
                            Valider
                        </a>
                    </div>
                </div>
            </fieldset>
        </form>
    </ol><br>
</section>
<section class="content">
    <div class="box">
        <!--<div class="box-header">
            <h3 class="box-title">Factures</h3>
        </div>-->
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive" id="alldatafact">
                <?php include($pathview . 'facture/alldatafact.php'); ?>
            </div>
        </div>

        <!-- /.box-body -->
    </div>
</section>