<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Paiements
        <span class="text-danger loader hidden">
        <i class="fa fa-refresh fa-spin fa-1x"></i>
       </span>
    </h1>
    
    <ol class="breadcrumb fvlder">
        <form class="form-inline filter_frm">
            <fieldset>
                <input type="hidden" name="sousresto_id" id="sousresto_id" value="<?php echo $_SESSION['id_sousresto'] ?>"/>
                <?php if($_SESSION['type_user']==1){ ?>
                    <div class="form-group">
                        <label for="ex4">&nbsp;CAISSIER&nbsp;</label>
                        <select class="form-control" id="caissier_id" name="caissier_id" required>
                            <option value="0">Tout</option>
                            <?php
                            $requete = $bdd->prepare("SELECT * FROM  t_utilisateur AS u"
                                . " WHERE u.id_hotel=:hotel_id AND u.psedo=0 ORDER BY u.nom_user");
                            //session à enlever
                            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                            $requete->execute();
                            $utilisateurs = $requete->fetchAll(PDO::FETCH_OBJ);
                            foreach ($utilisateurs as $u) :
                                echo '<option value=' . $u->id_user . '>' . ucfirst($u->nom_user) . '</option>';
                            endforeach;
                            ?>
                        </select>
                    </div>
                <?php } ?>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right text-left" name="periode" id="periode"
                           value="<?php echo dateAffiche($dte1) . ' - ' . dateAffiche($dte1); ?>"/>
                    <input type="hidden" name="current" id="current"
                           value="0"/>
                    <div class="input-group-addon btn_vers">
                        <a href="#" id="btn_paiement_groupe" title="Valider">
                            Valider
                        </a>
                    </div>
                </div>
            </fieldset>
        </form>
    </ol>
    <br>
</section>
<section class="content">
    <div class="container">
        <div class="box">
        <div class="box-header">
            <div class="col-md-5">
                <h3 class="box-title">
                Période(<span id="speriode_versement"><?php echo dateAffiche($dte1).'-'.dateAffiche($dte1);?></span>)
                </h3>
            </div>
            <div class="col-md-2">
                <div class="btn-group  btn-group-sm">
                    <a id="prt_det_vers21" href="impression/examples/listepaiement.php" target="_blank"  class="btn btn-xs btn-primary" title="Imprimer la liste">
                        <i class="fa fa-print"></i> Imprimer
                    </a>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive" id="alldatafact">
            <?php include($pathview.'facture/paiementListData.php'); ?>
          </div>   
        </div>
        
        <!-- /.box-body -->
    </div>
    </div>
</section>
