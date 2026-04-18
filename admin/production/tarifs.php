<?php
include('../../bdd/connexion.php');
?>

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Administration</h3>
              </div>

              <div class="title_right hidden">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tarification module </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <div class="row">
                            <div class="col-xs-12 table-responsive">
                      <table class="table table-striped table-bordered" id="datatable-responsive">
                          <thead>
                          <tr>
                              <th>Modules/Packs</th>
                              <th>Souscription</th>
                              <th>Prix par defaut</th>
                              <th>Prix par utilisateur</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody id="tbody_content">
                           <?php
                            $requete = $bdd->prepare("SELECT m.id AS moduleid,m.libelle AS nom,p.id,p.souscription,p.prix_user,p.prix_par_user "
                                    . "FROM t_pack AS m,prix p WHERE m.id=p.module_id");
                            $requete->execute();
                            $parametres= $requete->fetchAll(PDO::FETCH_OBJ);
                            foreach ($parametres as $p) {
                            ?>
                          <tr>
                              <th><?php echo $p->nom;?></th>
                              <td><?php echo $p->souscription;?></td>
                              <td id="<?php echo 'prix'.$p->id;?>"><?php echo '$'.$p->prix_user;?></td>
                              <td id="<?php echo 'prixp'.$p->id;?>"><?php echo '$'.$p->prix_par_user;?></td>
                              <td id="<?php echo 'td_content'.$p->id;?>"><a href="#" title="Modifier" class="btn btn-primary btn-xs edit_prix" data-toggle="modal" data-target=".bs-example-modal-sm" module="<?php echo $p->nom;?>" moduleid="<?php echo $p->moduleid;?>" souscription="<?php echo $p->souscription;?>" prixpuser="<?php echo $p->prix_par_user;?>" prixuser="<?php echo $p->prix_user;?>" prixid="<?php echo $p->id;?>" ><i class="fa fa-edit"></i> Edit</a>
                              </td>
                          </tr>
                         <?php
                            }
                            ?>
                          </tbody>
                      </table>
                           </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      <!-- modals -->
                      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal_prix">
                          <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                  
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                      </button>
                                      <h4 class="modal-title" id="myModalLabel2">Modification tarif</h4>
                                  </div>
                                  <div class="modal-body">
                                    
                                      <div class="status alert alert-success" id='msg' style="display:none"><i class="fa fa-info-circle"></i>Veuillez saisir les valeurs exactes</div>
                                  
                                      <form id="form_prix" data-parsley-validate class="form-horizontal form-label-left">

                                          <div class="form-group">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input name="prixid" id="prixid" type="hidden">
                                                 <input name="licence" id="licence" type="hidden">
                                                <input name="moduleid" id="moduleid" type="hidden">
                                                  <input type="text" required class="form-control col-md-12 col-xs-12 nom_module" placeholder="Module" disabled="disabled">
                                                  <input type="hidden" name="module" id="module">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                  <input type="text" required class="form-control col-md-12 col-xs-12 sous_module" disabled="disabled">
                                                  <input type="hidden" name="souscription" id="souscription" >
                                                  <input type="hidden" name="sous_module" id="sous_module" >
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                  <label>Prix par defaut</label>
                                                  <input class="form-control col-md-12 col-xs-12" type="text" name="moduleprix" id="moduleprix" placeholder="Tarif">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                  <label>Prix par utilisateur</label>
                                                  <input class="form-control col-md-12 col-xs-12" type="text" name="moduleprix_user" id="moduleprix_user" placeholder="Tarif">
                                              </div>
                                          </div>

                                      </form>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                      <button type="button" class="btn btn-primary" id="save_changes">Sauvegarder</button>
                                  </div>

                              </div>
                          </div>
                      </div>
                  <!-- /modals -->
                  </div>
                </div>
              </div>
            </div>
          </div>
       


