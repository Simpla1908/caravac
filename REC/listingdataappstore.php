
            <div class="feature-2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="fa fa-shopping-cart"></span> <b>EBU - App Store</b></h4>
                Décuplez vos activités en cochant sur un ou plusieurs modules et cliquez sur le button Essai gratuit !!!
            </div>
              <div class="status alert alert-danger col-md-12" id='msg2' style="display:none">
                                <i class="fa fa-info-circle"></i> Veuillez remplir ces champs vides
                            </div>
            <div class="modal-body">
                <input type="hidden"  id="existepackdssite" name="existepackdssite" value="0">
                 <input type="hidden"  id="id_pack" name="id_pack" value="0">

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-list-alt"></i>    
                            <h4><input type="radio"  id="1" name="packs[]" value="1" class="flat-red choice_pack"> Comptabilité</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-home"></i>    
                            <h4><input type="radio" id="4" name="packs[]" value="4" class="flat-red choice_pack"> Hebergement</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-user"></i>    
                            <h4><input type="radio" id="7" name="packs[]" value="7" class="flat-red choice_pack"> Ress. Humaines</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-dropbox"></i>    
                            <h4><input type="radio" id="2" name="packs[]" value="2" class="flat-red choice_pack"> Stock</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-hospital-o"></i>    
                            <h4><input type="radio" id="6" name="packs[]" value="6" class="flat-red choice_pack"> EBU - Hôtel</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-cutlery"></i>    
                            <h4><input type="radio" id="5" name="packs[]" value="5" class="flat-red choice_pack"> EBU - Restaurant</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-clipboard"></i>    
                            <h4><input type="radio" id="30" name="packs[]" value="30" class="flat-red choice_pack"> EBU - Pos</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-file-text-o"></i>    
                            <h4><input type="radio" id="29" name="packs[]" value="29" class="flat-red choice_pack"> EBU - Facturation</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                </div><!-- /.row -->
            </div>
            <div class="modal-footer feature-2">
                <a href="#" id="save_souscript" class="btn1 btn-lg btn-main">Essai Gratuit</a>
                  <span class="btn btn-danger hidden" id="loader1">
                  <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours
                  </span>
            </div>