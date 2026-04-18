<div class="modal fade bs-example-modal-lg-client" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lge">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Client accompagné</h4>
            </div>
            <form id="form_client_cli" action="Traitement_reservation/enreg_client_accomp.php" data-parsley-validate class="form-horizontal form-label-left">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6" id="contenaire">
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nom client <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input autocomplete="off" type="text" name="nom_client_acc" id="nom_client_cli" required="required" class="form-control col-md-7 col-xs-12" style="margin:0px auto;width:300px;">
                                    <input type="hidden" id="id_client_cli" name="id_client_acc">
                                    <input type="hidden" id="id_responsable_cli" name="id_responsable_acc" value="1">
                                    <div id="resultat">
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sexe <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12 disabled1" name="sexe_client_acc" id="sexe_client_cli" required="required" style="margin:0px auto;width:300px;">
                                        <option></option>
                                        <option value="Masculin">Masculin</option>
                                        <option value="Feminin">Feminin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date de Naiss<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12 disabled1" type="date" id="datetimepicker6_cli" name="date_naiss_client_acc" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Etat Civil <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12 disabled1" name="etat_civil_client_acc" id="etat_civil_client_cli" required="required" style="margin:0px auto;width:300px;">
                                        <option></option>
                                        <option>Marie</option>
                                        <option>Celibataire</option>
                                        <option>Divorce</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nationalité <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="nationalite_client_cli" name="nationalite_client_acc" class="form-control col-md-7 col-xs-12 disabled1" required="required" type="text" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Provenance <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="provenance_client_cli" name="provenance_client_acc" class="date-picker form-control col-md-7 col-xs-12 disabled1" required="required" type="text" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pièce identité
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!--<input type="number" id="num_piece_identite_client_acc"  name="num_piece_identite_client_acc" min="0" class="disabled1 form-control col-md-7 col-xs-12" style="margin:0px auto;width:300px;">-->
                                    <select name="num_piece_identite_client_acc" id="num_piece_identite_client_cli"
                                            class="disabled1 form-control col-md-7 col-xs-12" style="margin:0px auto;width:300px;">
                                        <option value=""></option>
                                        <option value="Carte d'électeur">Carte d'électeur</option>
                                        <option value="Permis de conduire">Permis de conduire</option>
                                        <option value="Passport">Passport</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Numéro
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="num_passeport_client_cli" name="num_passeport_client_acc" min="0" class="disabled1 form-control col-md-7 col-xs-12" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adresse <span class="required">*</span> </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="adresse_provenance_client_cli" name="adresse_provenance_client_acc" class="disabled1 form-control col-md-7 col-xs-12" type="text" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Téléphone <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="tel" id="telephone_client_cli" name="telephone_client_acc" class="disabled1 form-control col-md-7 col-xs-12" required="required" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email_client_cli" name="email_client_acc" class="disabled1 form-control col-md-7 col-xs-12" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Autre Contact <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="tel" id="num_pers_contacter_client_cli" name="num_pers_contacter_client_acc" class="disabled1 form-control col-md-7 col-xs-12" required="required" style="margin:0px auto;width:300px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="msg1" class="alert alert-danger alert-dismissable" style="display:none;">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert1">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <button type="submit" id="valider_cli" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
                    <button type="button" id="annuler_cli" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                </div>
            </form>

        </div>
    </div>
</div>