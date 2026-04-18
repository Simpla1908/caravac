<div id="myModalCouvert" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>-->
                <h5 class="modal-title"><strong>SERVEUR</strong></h5>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="formcouvert">
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible fade in hidden" role="alert" id="div_bkg_couvert">
                            <span id="sp_bkg_couvert"></span>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                                <label>Noms</label>
                               <select name="serveur_id" class="form-control select2 input-lg" style="width: 100%;" id="serveur_id">
    
    <?php 
    include '../bdd/connexion.php';

    if ($_SESSION['type_user'] == 1 || $_SESSION['type_user'] == 5) { 
    ?>
        <option value="0"></option>

        <?php
        $serveurs = getServeurs($_SESSION['id_hotel'], $bdd);

        foreach ($serveurs as $s) {
            echo '<option value="'.$s->id.'">'.$s->prenom.' '.$s->nom.'</option>';
        }

    } else { 

      $requete = $bdd->prepare("
        SELECT * FROM serveurs AS s
        WHERE s.psedo = 0 
        AND s.site_id = :site_id  
        AND LOWER(REPLACE(CONCAT(s.prenom, s.nom), ' ', '')) = LOWER(REPLACE(:nom_user, ' ', ''))
        ORDER BY s.nom
    ");

        $requete->bindParam(':site_id', $_SESSION['id_hotel']);
        $requete->bindParam(':nom_user', $_SESSION['nom_user']);
        $requete->execute();
        $serveurs = $requete->fetchAll(PDO::FETCH_OBJ);
        
        foreach ($serveurs as $s) {
            echo '<option value="'.$s->id.'">'.$s->prenom.' '.$s->nom.'</option>';
        }
    }
    ?>

</select>
                            </div>
                            <div class="col-lg-12 hidden">
                                <label>Couvert</label>
                                <div class="col-lg-12 form-group">
                                    <div class=" col-lg-12 input-group input-group-lg" >
                                        <input type="number" id="nbrcouvertpopup" name="nbrcouvertpopup" class="form-control" value="0">
                                        <span class="input-group-addon">Personne(s)</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                </form>
            </div>
            <div class="modal-footer">
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="add_libelledep_btn">Valider</button>-->
                 <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                <button type="submit" class="btn btn-primary btn_modal btn-lg" id="btn_couvert_proc">VALIDER</button>
             
            </div>

        </div>
    </div>
</div>
</div>

<div id="myModal_acc_boisson" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>ACCOMPAGNEMENT BOISSON</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12 form-group" style="text-align: center;font-size: 27px;" id="iddataaccboisson">
                            
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_modal btn-lg" data-dismiss="modal">ANNULER</button>
                    <button type="submit" class="btn btn-primary btn_modal btn-lg" id="btn_val_acc_boisson">VALIDER</button>
                    <button type="button" class="btn btn-primary btn_modal btn-lg hidden" id="btn_val_acc_boisson_loader">VALIDER</button>
                </div>

            </div>
        </div>
    </div>
</div>