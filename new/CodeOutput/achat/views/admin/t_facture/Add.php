
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>


<form action="<?php echo H_ADMIN_MAIN . '&view=t_facture&do=addpro'; ?>" method="post" name="hezecomform" id="hezecomform" enctype="multipart/form-data">
    <div class="col-12">

        <section class="content">
            <div class="row">
                <!--<br>-->
                <div class="col-md-10">
                    <div class="box">
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="row pad-top-botm ">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <img src="dist/img/logo ERH.jpg" style="padding-bottom:20px;" /> 
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <br /><br /><br />
                                        <strong>Support : </strong>info@yourdomain.com
                                        <br />
                                        <strong>Call :</strong>+01-345-908-55-89<br />
                                        <strong>Fax :</strong>+456-345-908-559<br />
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <br /><br /><br />
                                        <strong>Design Bootstrap Technologies  </strong>
                                        <br />
                                        Address : 234/90, New York Street
                                        <br />
                                        United States.<br />
                                    </div>
                                </div>
                                <div  class="row text-center contact-info">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <hr />
                                        <span>
                                            <strong>Email : </strong>  info@yourdomain.com 
                                        </span>
                                        <span>
                                            <strong>Call : </strong>  +95 - 890- 789- 9087 
                                        </span>
                                        <span>
                                            <strong>Fax : </strong>  +012340-908- 890 
                                        </span>
                                        <hr />
                                    </div>
                                </div>
                                <div  class="row pad-top-botm client-info">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <h4>  <strong>Client Information <a href="#" title="Selectionner client" data-toggle="modal" data-target="#modalclient"><span class="fa fa-caret-down"></span></a></strong></h4>
                                        <strong>  Nnnnn Ppppppppp Ppppppppp </strong>
                                        <br />
                                        <b>Address :</b> xxxxxxxxxxx , xxxxxxxxxxxxxxxxx,
                                        <br />
                                        xxxxxxxxxxxx.
                                        <br />
                                        <b>Tél :</b> 00000000000000
                                        <br />
                                        <b>E-mail :</b> ddddddd@xxxxxxxxxxxxx.com
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">

                                        <h4>  <strong>Payment Details </strong></h4>
                                        <b>Bill Amount :  990 USD </b>
                                        <br />
                                        Bill Date :  01th August 2014
                                        <br />
                                        <b>Payment Status :  Paid </b>
                                        <br />
                                        Delivery Date :  10th August 2014
                                        <br />
                                        Purchase Date :  30th July 2014
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <a href="#" title="Ajouter" data-toggle="modal" data-target="#modaldepot" class="btn btn-danger btn-xs"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Désignation</th>
                                                        <th>Quantité</th>
                                                        <th>Prix Unitaire</th>
                                                        <th>Sous Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Plugin Development</td>
                                                        <td><input size="10" type="number" min="1" value="2" class="qte2" id=""></td>
                                                        <td>100 USD</td>
                                                        <td>200 USD</td>
                                                        <td>
                                                            <div class="tools text-center">
                                                                <a class="btn btn-danger btn-xs" title="Selectionner & Supprimer" id="btn_supp2"><i class="fa fa-trash-o"></i> Supprimer</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wordpress Installation</td>
                                                        <td><input size="10" type="number" min="1" value="1" class="qte2" id=""></td>
                                                        <td>300 USD</td>
                                                        <td>300 USD</td>
                                                        <td>
                                                            <div class="tools text-center">
                                                                <a class="btn btn-danger btn-xs" title="Selectionner & Supprimer" id="btn_supp2"><i class="fa fa-trash-o"></i> Supprimer</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hosting Space</td>
                                                        <td><input size="10" type="number" min="1" value="1" class="qte2" id=""></td>
                                                        <td>25 USD</td>
                                                        <td>25 USD</td>
                                                        <td>
                                                            <div class="tools text-center">
                                                                <a class="btn btn-danger btn-xs" title="Selectionner & Supprimer" id="btn_supp2"><i class="fa fa-trash-o"></i> Supprimer</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Website Design</td>
                                                        <td><input size="10" type="number" min="1" value="1" class="qte2" id=""></td>
                                                        <td>75 USD</td>
                                                        <td>75 USD</td>
                                                        <td>
                                                            <div class="tools text-center">
                                                                <a class="btn btn-danger btn-xs" title="Selectionner & Supprimer" id="btn_supp2"><i class="fa fa-trash-o"></i> Supprimer</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                        Total H.T : 
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <strong>600 USD </strong>
                                    </div>
                                    <hr />
                                    <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                        Total T.V.A ( 16 % ) : 
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <strong>672 USD </strong>
                                    </div>
                                    <br />
                                    <div class="col-lg-9 col-md-9 col-sm-9" style="text-align: right; padding-right: 30px;">
                                        Total T.T.C : 
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <strong>1272 USD </strong>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <strong>IMPORTANT INSTRUCTIONS :
                                        </strong>
                                        <h5># This is an electronic receipt so doesn't require any signature.</h5>
                                        <h5># All perticulars are listed with 10.50 % taxes , so if any issue please contact us immediately.</h5>
                                        <h5># You can contact us between 10:am to 6:00 pm on all working days.</h5>
                                    </div>
                                </div>
                                <br /><br />
                                <br />
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <p class="text-center">
                                    <b>ID.Nat.</b>: 798945112 <b>RCCM.</b>: 1234<br />
                                    <b>Adresse</b>: 27,Mbekani Q.Révolution C.Kisenso<br />
                                    <b>Email</b>: simplicelandu1908@gmail.com <b>Tél.</b>.: +243 823 903 252
                                </p>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-2">
                    <!--<div class="info-box">-->
                    <button type="button" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save"></i> Enregistrer</button>
                    <br>
                    <button type="button" class="btn btn-primary btn-lg btn-block"><i class="fa fa-envelope"></i> Envoyer</button>
                    <br>
                    <button type="button" class="btn btn-primary btn-lg btn-block"><i class="fa fa-print"></i> Imprimer</button>

                    <!--</div>-->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="modalclient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Client</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            Anciens client
                        </label>
                    </div>
                    <div class="col-sm-6">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Nouveau client
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-4 control-label">Selectionner client</label>

                    <div class="col-sm-8">
                        <select class="form-control">
                            <option></option>
                            <option value="masculin">Malonda Jeanpy</option>
                            <option value="feminin">Bakenda Hugue</option>
                            <option value="masculin">Malonda Jeanpy</option>
                            <option value="feminin">Bakenda Hugue</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <br><br>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">Prenom</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputName" placeholder="Prenom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-3 control-label">Nom</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Nom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">Sexe</label>

                        <div class="col-sm-9">
                            <select class="form-control">
                                <option>Sexe</option>
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Feminin</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <br><br>
                    <div class="form-group">
                        <label for="inputSkills" class="col-sm-3 control-label">Téléphone</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputSkills" placeholder="Téléphone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-3 control-label">Email.</label>

                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputName" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSkills" class="col-sm-3 control-label">Adresse</label>

                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="inputSkills" placeholder="Adresse"> </textarea>
                        </div>
                    </div>
                </div>
        </div>
        </div>
        <div class="modal-footer">
            <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
            </div>
            <button  class="btn btn-danger pull-right col-md-2"
                id="add_prod"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Valider
            </button>
            <span class="btn btn-info hidden pull-right" id="loader">
                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
            </span>
        </div>
        </div>
        <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<!-- Modal -->
<div class="modal fade" id="modaldepot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Ajouter</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      <b>PRODUITS</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                        <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      <b>SERVICES</b>
                    </label>
                  </div>
                    <br/>
                </div>

            <div class="form-group">
                <label>Désignation</label>
                <select class="form-control" id="produit_id" name="produit_id" required>
                    <option>  </option>
                    <?php
//                    include("./Traitement/produit_combo.php");
//                    foreach ($produits as $p):
//                      echo  '<option value=' . $p->idprod . '>' . ucfirst($p->designation) .'</option>';
//                    endforeach;
                    ?>
                </select>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <label>Quantité</label>
                <input class="form-control col-md-7 col-xs-12" id="qte_dispo" name="qte_dispo">
            </div>
            <!-- /.form-group -->
        </div>
        <div class="modal-footer">
            <div id="msg_popup" class="text-danger text-left col-md-10" style="display:none;">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <span id="msg_alert_popup">Veuillez saisir les valeurs correctes dans tous les champs!</span>
            </div>
            <button  class="btn btn-danger pull-right col-md-2"
                id="add_prod"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Ajouter
            </button>
            <span class="btn btn-info hidden pull-right" id="loader">
                <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
            </span>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->