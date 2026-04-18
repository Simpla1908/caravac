<!-- Modal AJOUTER MODULE BEFORE SITE-->
<div class="modal fade" id="appstoresite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lgs">
        <form class="form-horizontal"  name="entreprise-form" id="entreprise-form" method="post" action="Traitement/entreprise_traitement_appstore.php" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="feature-2 appstore" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="fa fa-shopping-cart"></span> <b>EBU - App Store</b></h4>
                Décuplez vos activités en cochant sur un ou plusieurs modules et cliquez sur le button Essai gratuit !!!
            </div>
            <div class="feature-2 entreprise" style="display:none">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="fa fa-hospital-o"></span> <b>EBU - Add Site</b></h4>
                Renseignez vos informations administratives !!!
            </div>
            <div class="modal-body">
                <div class="status alert alert-danger col-md-12" id='msg' style="display:none"><i class="fa fa-info-circle"></i> Veuillez remplir ces champs vides</div>
                <div class="row appstore">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-list-alt"></i>    
                            <h4><input type="radio" name="packs[]" value="1" class="flat-red"> Comptabilité</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-home"></i>    
                            <h4><input type="radio" name="packs[]" value="4" class="flat-red"> Hebergement</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-user"></i>    
                            <h4><input type="radio" name="packs[]" value="7" class="flat-red"> Ress. Humaines</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-database"></i>    
                            <h4><input type="radio" name="packs[]" value="2" class="flat-red"> Stock</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-hospital-o"></i>    
                            <h4><input type="radio" name="packs[]" value="6" class="flat-red"> EBU - Hôtel</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-cutlery"></i>    
                            <h4><input type="radio" name="packs[]" value="5" class="flat-red"> EBU - Restaurant</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-clipboard"></i>    
                            <h4><input type="radio" name="packs[]" value="30" class="flat-red"> EBU - Pos</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-file-text-o"></i>    
                            <h4><input type="radio" name="packs[]" value="29" class="flat-red"> EBU - Facturation</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                </div><!-- /.row -->
                
                <div class="row entreprise" style="display:none">
                    <div class="col-md-12">
                        <p class="font-gray-dark">
                            <!--Renseignez vos informations administratives.-->
                        </p>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nom site :</label>
                                <input type="text" id="site" name="site" class="form-control" placeholder="Nom site" required>
                            </div>
                            <div class="form-group">
                                <label>Adresse :</label>
                                <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Adresse">
                            </div>
                            <div class="form-group">
                                <label>Téléphone :</label>
                                <input type="tel" id='phone' name="phone" class="form-control" placeholder="Téléphone">
                            </div>
                            <div class="form-group">
                                <label>RCCM :</label>
                                <input type="text" id="rccm" name="rccm" class="form-control" placeholder="RCCM">
                            </div>
                            <div class="form-group">
                                <label>N° Impôt :</label>
                                <input type="text" id="num_impot" name="num_impot" class="form-control" placeholder="N° Impôt">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Ville :</label>
                                <input type="text" id="ville" name="ville" class="form-control" placeholder="Ville">
                            </div>
                            <div class="form-group">
                                <label>Email :</label>
                                <input type="email" id="mail" name="mail" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>ID Nat :</label>
                                <input type="text" id="id_nat" name="id_nat" class="form-control" placeholder="ID Nat">
                            </div>
                            <div class="form-group">
                                <label>Compte Banquaire :</label>
                                <input type="text" id="cb" name="cb" class="form-control" placeholder="Compte Banquaire">
                            </div>
                            <div class="form-group">
                                Logo :
                                <input type="file" id="logo" name="logo">
                                <small> Choisissez un fichier JPG ou PNG au format allongé Exemple : hauteur 50 et largeur 450 et une résolution autour de 72</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="status alert alert-success col-md-12" id='msg' style="display:none"><i class="fa fa-info-circle"></i>Veuillez remplir ces champs vides</div>
                    <div class="form-group entreprise">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                            <br>
                            <!--<button type="button" class="btn btn-primary entreprise" id="next"><i class="fa fa-arrow-circle-right"></i> Suivant</button>-->
                            <button type="button" class="btn btn-default" id='precedent'><i class="fa fa-arrow-circle-left"></i> Precedent</button>
                            <button type="submit" class="btn btn-primary" id="save"><i class="fa fa-save"></i> Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer feature-2 appstore">
                <a href="#" id="btn_gratuit" class="btn1 btn-lg btn-main ">Essai Gratuit</a>
            </div>
        </div>
        <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->