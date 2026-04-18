$(document).ajaxStart(function () {
    Pace.restart();
});
//NOTIFICATION JS
$(function () {
    $.miniNotification = function (e, t) {
        var n, r, i, s, o, u, a = this;
        this.defaults = {
            position: "top", show: true, effect: "slide", opacity: .95, time: 4e3, showSpeed: 600, hideSpeed: 450, showEasing: "", hideEasing: "", innerDivClass: "inner", closeButton: false, closeButtonText: "close", closeButtonClass: "close", hideOnClick: true, onLoad: function () {
            }, onVisible: function () {
            }, onHide: function () {
            }, onHidden: function () {
            }
        };
        o = "";
        this.settings = {};
        this.$element = $(e);
        s = function (e) {
            return o = e
        };
        r = function () {
            var e, t;
            t = a.getSetting("effect") === "slide" ? 0 - a.$element.outerHeight() : 0;
            e = {};
            if (a.getSetting("position") === "bottom") {
                e["bottom"] = t
            } else {
                e["top"] = t
            }
            if (a.getSetting("effect") === "fade") {
                e["opacity"] = 0
            }
            return e
        };
        i = function () {
            var e;
            e = { opacity: a.getSetting("opacity") };
            if (a.getSetting("position") === "bottom") {
                e["bottom"] = 0
            } else {
                e["top"] = 0
            }
            return e
        };
        u = function () {
            a.$elementInner = $("<div />", { "class": a.getSetting("innerDivClass") });
            return a.$element.wrapInner(a.$elementInner)
        };
        n = function () {
            var e;
            e = $("<a />", { "class": a.getSetting("closeButtonClass"), html: a.getSetting("closeButtonText") });
            a.$element.children().append(e);
            return e.bind("click", function () {
                return a.hide()
            })
        };
        this.getState = function () {
            return o
        };
        this.getSetting = function (e) {
            return this.settings[e]
        };
        this.callSettingFunction = function (t) {
            return this.settings[t](e)
        };
        this.init = function () {
            var e = this;
            s("hidden");
            this.settings = $.extend({}, this.defaults, t);
            if (this.$element.length) {
                u();
                if (this.getSetting("closeButton")) {
                    n()
                }
                this.$element.css(r()).css({ display: "inline" });
                if (this.getSetting("show")) {
                    this.show()
                }
                if (this.getSetting("hideOnClick")) {
                    return this.$element.bind("click", function () {
                        if (e.getState() !== "hiding") {
                            return e.hide()
                        }
                    })
                }
            }
        };
        this.show = function () {
            var e = this;
            if (this.getState() !== "showing" && this.getState() !== "visible") {
                s("showing");
                this.callSettingFunction("onLoad");
                return this.$element.animate(i(), this.getSetting("showSpeed"), this.getSetting("showEasing"), function () {
                    s("visible");
                    e.callSettingFunction("onVisible");
                    return setTimeout(function () {
                        return e.hide()
                    }, e.settings.time)
                })
            }
        };
        this.hide = function () {
            var e = this;
            if (this.getState() !== "hiding" && this.getState() !== "hidden") {
                s("hiding");
                this.callSettingFunction("onHide");
                return this.$element.animate(r(), this.getSetting("hideSpeed"), this.getSetting("hideEasing"), function () {
                    s("hidden");
                    return e.callSettingFunction("onHidden")
                })
            }
        };
        this.init();
        return this
    };
    return $.fn.miniNotification = function (e) {
        return this.each(function () {
            var t;
            t = $(this).data("miniNotification");
            if (t === void 0) {
                t = new $.miniNotification(this, e);
                return $(this).data("miniNotification", t)
            } else {
                return t.show()
            }
        })
    }
})

//        CALL NOTIFICATION
$(function () {
    $('.heze-notify').miniNotification({ closeButton: true, closeButtonText: '<i class="fa fa-times"></i>' });
});
/*HTML DATA TABLE*/
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('.t1').footable();
});
/*TOOL TIP*/
$(document).ready(function () {
    $(".tip").tooltip();
});
/*SCROLLER*/
$(function () {
    $('.divscroll').slimscroll({
        height: '98%'
    });
});
//Date picker
$(function () {
    window.prettyPrint && prettyPrint();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('.datepicker2').datepicker({
        format: 'dd/mm/yyyy'
    });
});
//MODAL BOX
$(document).ready(function () {
    $('a[data-confirm]').click(function (ev) {
        var href = $(this).attr('href');
        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 id="dataConfirmLabel">Confirmation</h4></div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Non</button><a class="btn btn-primary" id="dataConfirmOK">Oui</a></div></div></div></div>');
        }
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({ show: true });
        return false;
    });
});
//MULTI FIELDS
var startingNo = -1;
var $node = "";
for (varCount = 0; varCount <= startingNo; varCount++) {
    var displayCount = varCount + 1;
    $node += '<span><input type="file" name="gfile[]" id="gfile[]" class="styler" style="padding:0px;"><span class="removeVar btn btn-xs btn-danger">Remove</span></span>';
}
$('form').prepend($node);
$('form').on('click', '.removeVar', function () {
    $(this).parent().remove();
    //varCount--; to show numbers '+varCount+'
});
$('#addVar').on('click', function () {
    varCount++;
    $node = '<span> <input type="file" name="gfile[]" id="gfile[]" class="styler" style="padding:0px; width:220px; margin-top:-10px;"><span class="removeVar btn btn-xs btn-danger " style="margin-left:220px; margin-top:-50px;">Remove</span></span>';
    $(this).parent().before($node);
});
//LIGHTBOX  
$(function () {
    $(".gallery a[data-rel^='hezebox']").lightbox();
});
/*Form ajax*/
$(document).ready(function () {
    $('#hezecomform').on('submit', function (e) {
        e.preventDefault();
        $('#msgButton').attr('disabled', '');
        $(".output").html('<div><i class="fa fa-spinner fa-spin fa-2x"></i> Processing...</div>');
        $(this).ajaxSubmit({
            target: '.output',
            success: afterSuccess
        });
    });
});
function afterSuccess() {
    $('#msgButton').removeAttr('disabled'); //enable submit button
}

//EDITORS
//html5 
$(function () {
    $(".editor2").wysihtml5();
});
//TynyMCE     
tinymce.init({
    selector: "textarea.editor1",
    theme: "modern",
    width: "auto",
    height: 200,
    plugins: [
        "advlist autolink link image lists charmap  preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality   paste textcolor jbimages"
    ],
    toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink  jbimages | print preview ",
    relative_urls: false
});
//Chosen
$(".choz").chosen({
    disable_search: false,
    no_results_text: "No Search Results!",
    width: "100%",
});
/*TOOL TIP*/
$(function () {
    $('.t2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": true
    });
    $(".datemask").inputmask("dd/mm/yyyy", { "placeholder": "dd/mm/yyyy" });
});
/*CUSTUM CODES*/
$(document).ready(function () {
    //    Ajout Sous-compte
    $("#bloc_view_main").on('change', '#compte_id', function (e) {
        e.preventDefault();
        var prefixe = $('#compte_id option:selected').attr('pref');
        var libcategorie = $('#compte_id option:selected').attr('categorie');
        var libclasse = $('#compte_id option:selected').attr('classe');
        var statut = $('#compte_id option:selected').attr('statut');
        $('.prefixe_aff').text(prefixe);
        $('#prefnum').val(prefixe);
        $('.libcategorie').val(libcategorie);
        $('.libclasse').val(libclasse);
        $('#statut').val(statut);
        $(".scpt").removeClass('hidden');
        return false;
    });
    $("#bloc_view_main").on('change', '#compte_id_updt', function (e) {
        e.preventDefault();
        var prefixe = $('#compte_id_updt option:selected').attr('pref');
        var libcategorie = $('#compte_id_updt option:selected').attr('categorie');
        var libclasse = $('#compte_id_updt option:selected').attr('classe');
        var statut = $('#compte_id_updt option:selected').attr('statut');
        $('.prefixe_aff_updt').text(prefixe);
        $('#prefnum_updt').val(prefixe);
        $('.libcategorie_updt').val(libcategorie);
        $('.libclasse_updt').val(libclasse);
        $('#statut_updt').val(statut);
        $(".scpt_updt").removeClass('hidden');
        return false;
    });

    $("#bloc_view_main").on('click', '.btnpopupdtSubAcount', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var numero = $(this).attr('numero');
        var classe = $(this).attr('classe');
        var nom = $(this).attr('nom');
        var idcpt = $(this).attr('idcpt');
        var libcpt = $(this).attr('libcpt');
        var numcpt = $(this).attr('numcpt');
        var libcat = $(this).attr('libcat');
        $('#sous_compte_id').val(id);
        $('#libelle_scpte').val(nom);
        $('#snumero').val(numero);
        $('.libclasse_updt').val(classe);
        $('.libcategorie_updt').val(libcat);
        $('.prefixe_aff_updt').text(numcpt);
        $('#prefnum_updt').val(numcpt);
        $('#oldnumero').val(numcpt + numero);
        $('#compte_id_updt option[value=' + idcpt + ']').prop('selected', true);
        $('#compte_id_updt').trigger("chosen:updated");
        $("#modalUpdateSubAccount").modal('show');
        return false;

    });

    $("#bloc_view_main").on('click', '#btn_add_compte', function (e) {
        e.preventDefault();
        var donnees = $("#comptefrm").serialize();
        var pg = 'admin';
        var view = 'cptcomptes';
        var todo = 'addcpt';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //                alert(data);
                if (data.s) {
                    //Maj Plan comptable
                    var urlstmotif = './main.php?pg=admin&view=cptcomptes&do=majplcpt';
                    $.ajax({
                        url: urlstmotif,
                        type: method,
                        success: function (data) {
                            $('#lignescomptes').empty().html(data);
                            $(".scpt2").addClass('hidden');
                        }
                    });
                    $(".msg_alert").text(data.message);
                    $(".bloc_alert").show()
                        .removeClass('hidden callout-danger')
                        .addClass('callout-success').fadeOut(6000);
                    $(".nettoyer").val('');
                } else {
                    $(".msg_alert").text(data.message)
                    $(".bloc_alert").show().removeClass('hidden callout-success')
                        .addClass('callout-danger').fadeOut(6000);;
                }

            }
            , dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '#btn_add_scompte', function (e) {
        e.preventDefault();
        var donnees = $("#scomptefrm").serialize();
        var pg = 'admin';
        var view = 'cptcomptes';
        var todo = 'addpro2';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    //Maj Plan comptable
                    var urlstmotif = './main.php?pg=admin&view=cptcomptes&do=majplcpt';
                    $.ajax({
                        url: urlstmotif,
                        type: method,
                        success: function (data) {
                            $('#lignescomptes').empty().html(data);
                            $(".scpt2").addClass('hidden');
                        }
                    });
                    $(".msg_alert").text(data.message);
                    $(".bloc_alert").show()
                        .removeClass('hidden callout-danger')
                        .addClass('callout-success').fadeOut(6000);
                    $(".nettoyer").val('');
                } else {
                    $(".msg_alert").text(data.message)
                    $(".bloc_alert").show().removeClass('hidden callout-success')
                        .addClass('callout-danger').fadeOut(6000);;
                }

            }
            , dataType: 'json'
        });
    });


    $("#bloc_view_main").on('click', '#btn_updt_scompte', function (e) {
        e.preventDefault();
        var donnees = $("#scomptefrm_updt").serialize();
        var pg = 'admin';
        var view = 'cptcomptes';
        var todo = 'updtsubaccount';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                if (data.s) {
                    //Maj Plan comptable
                    var urlstmotif = './main.php?pg=admin&view=cptcomptes&do=majplcpt';
                    $.ajax({
                        url: urlstmotif,
                        type: method,
                        success: function (data) {
                            $('#lignescomptes').empty().html(data);
                            $(".scpt2").addClass('hidden');
                        }
                    });
                    $(".msg_alert").text(data.message);
                    $(".bloc_alert").show()
                        .removeClass('hidden callout-danger')
                        .addClass('callout-success').fadeOut(6000);
                } else {
                    $(".msg_alert").text(data.message)
                    $(".bloc_alert").show().removeClass('hidden callout-success')
                        .addClass('callout-danger').fadeOut(6000);
                }

            }
            , dataType: 'json'
        });
    });

    $("#bloc_view_main").on('click', '.delsubaccount', function (e) {
        e.preventDefault();
        var souscompteid = $(this).attr("id");
        $('#souscompteid').val(souscompteid);
        $("#myModaldelsubaccount").modal('show');

    });
    $("#bloc_view_main").on('click', '#delsubaccountnon', function (e) {
        e.preventDefault();
        $("#myModaldelsubaccount").modal('hide');

    });

    $("#bloc_view_main").on('click', '#delsubaccountoui', function (e) {
        e.preventDefault();
        var souscompteid = $('#souscompteid').val();
        var donnees = "";
        var pg = 'admin';
        var view = 'cptcomptes';
        var todo = 'delsubaccount';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&souscompteid=' + souscompteid;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                ///// Maj Plan comptable
                var urlstmotif = './main.php?pg=admin&view=cptcomptes&do=majplcpt';
                $.ajax({
                    url: urlstmotif,
                    type: method,
                    success: function (data) {
                        $("#myModaldelsubaccount").modal('hide');
                        $('#lignescomptes').empty().html(data);
                        $(".scpt2").addClass('hidden');
                    }
                });

            }
        });

    });







    $("#bloc_view_main").on('click', '#btnjournaliser', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data);
                if (data.s) {
                    todo = 'viewall';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });

    $("#bloc_view_main").on('mouseout', '.debits', function (e) {
        e.preventDefault();
        var rowCount = $(this).attr('id3');
        var mont = $(this).val();
        var donnees = "";
        var pg = 'admin';
        var view = 'cptprevision';
        var todo = 'formatchiffre';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&mont=' + mont;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                $("#debitaff" + rowCount).val(data.montaff);
                $("#debit" + rowCount).val(data.mont);

            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#btnjournaliserupdt', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'updatepro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                if (data.s) {
                    todo = 'viewall';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });

    $("#bloc_view_main").on('click', '#btnfiltrerjournaux', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrerl').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'filtrerjournaux';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  $('#titlecl').html('Liste des occupations du '+dte1+' au '+dte2);
                $('#contentdatafilter').empty().append(data);
                $("#modalfiltrerl").modal('hide');
                tablefilter();
            }

        });
    });
    $("#bloc_view_main").on('click', '.supjournal', function (e) {
        e.preventDefault();
        var idecriture = $(this).attr("id");
        $('#idecriture').val(idecriture);
        $("#myModalsupjournal").modal('show');

    });
    $("#bloc_view_main").on('click', '#supjournalnon', function (e) {
        e.preventDefault();
        $("#myModalsupjournal").modal('hide');

    });
    $("#bloc_view_main").on('click', '#supjournaloui', function (e) {
        e.preventDefault();
        $("#myModalsupjournal").modal('hide');
        var idecriture = $('#idecriture').val();
        var donnees = '';
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'delete';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + idecriture;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                todo = 'viewall';
                url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                location.href = url;
            }

        });

    });

    $("#bloc_view_main").on('click', '.btnlettrer', function (e) {
        e.preventDefault();
        var idecriture = $(this).attr("id");
        var donnees = '';
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'lettrer';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + idecriture;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                todo = 'details';
                url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + idecriture;
                location.href = url;
            }

        });

    });
    $("#bloc_view_main").on('click', '.exercicencours', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var pg = 'admin';
        var view = 'cptexercice';
        var todo = 'exerciceencours';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id;
        var method = 'POST';
        var donnees = '';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#contentdatafilter').empty().append(data);
                tablefilter();
            }
        });
        return false;
    });
    //COMPTA
    $("#bloc_view_main").on('click', '#btnencaisser', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'encaissementpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  alert(data);
                if (data.s) {
                    var id = data.operation_last_id;
                    var pg = 'admin';
                    var view = 'impression';
                    var todo = 'recuencaisse';
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id;
                    window.open(url);
                    //$('.output').html(data.message).show();
                    view = 'tresorerie';
                    todo = 'listencaissement';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '#btndecaisser', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'decaissementpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  alert(data);
                if (data.s) {
                    var id = data.operation_last_id;
                    var pg = 'admin';
                    var view = 'impression';
                    var todo = 'recudecaisse';
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id;
                    window.open(url);
                    //$('.output').html(data.message).show();
                    view = 'tresorerie';
                    todo = 'listdecaissement';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '#btndemande', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'demandepaiepro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    var id = data.operation_last_id;
                    var pg = 'admin';
                    var view = 'impression';
                    var todo = 'recudecaisse';
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id;
                    window.open(url);
                    view = 'tresorerie';
                    todo = 'demandepaiement';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'
        });
    });
    $("#bloc_view_main").on('change', '#typejournal', function (e) {
        e.preventDefault();
        var idjournal = $('#typejournal option:selected').attr('value');
        var donnees = '';
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'filtrercompte';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idjournal=' + idjournal;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (idjournal == 6) {
                    $('.clsjanouveau').show();
                    $('#isjanouveau').val(1);
                } else {
                    $('.clsjanouveau').hide();
                    $('#isjanouveau').val(0);
                }
                $(".modalbodycompte").empty().append(data);
                selectjs();
                //GENERATION NUM JOURNAL
                var pg = 'admin';
                var view = 'cptjournal';
                var todo = 'genererationref';
                var method = 'POST';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idjournal=' + idjournal;
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $('#lib_jour').val(data.lib_jour);
                        $('#num_jour').val(data.num_jour);
                        $('#reference').val(data.reference);
                        $('#referenceaff').val(data.reference);
                    }, dataType: 'json'
                });
                //GENERATION NUM JOURNAL
            }
        });
        return false;
    });
    $("#bloc_view_main").on('click', '#btngenerejournal', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'verifgenerejournal';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    todo = 'generejournal';
                    method = 'POST';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#resultgenerejournal").empty().append(data);
                            $("#btnprintdisabled").hide();
                            $("#btnprintabled").show();

                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#btnChoiceFile', function (e) {
        e.preventDefault();
        // alert('ok');
        var typedoc = $("[name=typedoc]:checked").val();
        var journal_id = $('#journal_id option:selected').attr('value');
        //alert(journal_id);
        if (typedoc == 'pdf') {
            var pg = 'admin';
            var view = 'impression';
            var todo = 'journal';
            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&journal_id=' + journal_id;
            window.open(url);
        } else {
            var url = './main.php?pg=admin&view=cptjournal&do=export&hexport=yes&etype=excel' + '&journal_id=' + journal_id;
            window.open(url);
        }

        $("#modalChoiceFile").modal('hide');

    });
    $("#bloc_view_main").on('click', '#btnfiltrerencaisse', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrerencaisse').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'flistencaissement';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlecl').html('Encaissement du ' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrerencaisse").modal('hide');
                tablefilter();
            }

        });
    });
    $("#bloc_view_main").on('click', '#btnfiltrerdecaisse', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrerdecaisse').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'flistdecaissement';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlecl').html('Decaissement du ' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrerdecaisse").modal('hide');
                tablefilter();
            }

        });
    });
    //GRAND LIVRE       
    $("#bloc_view_main").on('click', '#btngeneregl', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'verifgeneregl';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                if (data.s) {
                    todo = 'generegl';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#btnprintdisabled').hide();
                            $('#btnprintabled').show();
                            $('#typeprintaccount').val($('#numerocompte option:selected').attr('value'));
                            $('#resultgeneregl').empty().append(data);
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#btnChoiceFileGl', function (e) {
        e.preventDefault();
        var typedoc = $("[name=typedoc]:checked").val();
        var numerocompte = $('#typeprintaccount').val();
        if (typedoc == 'pdf') {
            var pg = 'admin';
            var view = 'impression';
            var todo = 'grandlivre';
            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&numerocompte=' + numerocompte;
            window.open(url);
        } else {
            var url = './main.php?pg=admin&view=cptjournal&do=excelGL&hexport=yes&etype=excel&numerocompte=' + numerocompte;
            window.open(url);
        }
        $("#modalChoiceFile").modal('hide');

    });
    $("#bloc_view_main").on('change', '#exercice_id', function (e) {
        e.preventDefault();
        var exercice_lib = $('#exercice_id option:selected').text();
        $('#exercice_lib').val(exercice_lib);
        return false;
    });
    //BALANCE
    $("#bloc_view_main").on('click', '#btngenerebal', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'verifgenerebal';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                if (data.s) {
                    todo = 'generebal';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#btnprintdisabled').hide();
                            $('#btnprintabled').show();
                            $('#resultgenerebal').empty().append(data);
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('change', '#exercice_id_bal', function (e) {
        e.preventDefault();
        var exercice_lib = $('#exercice_id_bal option:selected').text();
        var debut = $('#exercice_id_bal option:selected').attr('debut');
        var fin = $('#exercice_id_bal option:selected').attr('fin');
        $('#exercice_lib').val(exercice_lib);
        $('#debut').val(debut);
        $('#fin').val(fin);
        return false;
    });
    $("#bloc_view_main").on('change', '#exercicesn', function (e) {
        e.preventDefault();
        var exercicesnlib = $('#exercicesn option:selected').text();
        var debut = $('#exercicesn option:selected').attr('debut');
        var fin = $('#exercicesn option:selected').attr('fin');
        $('#exercicesnlib').val(exercicesnlib);
        $('#dte1n').val(debut);
        $('#dte2n').val(fin);
        return false;
    });
    $("#bloc_view_main").on('change', '#exercicesn1', function (e) {
        e.preventDefault();
        var exercicesn1lib = $('#exercicesn1 option:selected').text();
        var debut = $('#exercicesn1 option:selected').attr('debut');
        var fin = $('#exercicesn1 option:selected').attr('fin');
        $('#exercicesn1lib').val(exercicesn1lib);
        $('#dte1n1').val(debut);
        $('#dte2n1').val(fin);
        return false;
    });
    $("#bloc_view_main").on('click', '#btnChoiceFileBAL', function (e) {
        e.preventDefault();
        var typedoc = $("[name=typedoc]:checked").val();
        if (typedoc == 'pdf') {
            var pg = 'admin';
            var view = 'impression';
            var todo = 'balance';
            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
            window.open(url);
        } else {
            var url = './main.php?pg=admin&view=cptjournal&do=excelBAL&hexport=yes&etype=excel';
            window.open(url);
        }
        $("#modalChoiceFile").modal('hide');

    });
    //BILAN
    $("#bloc_view_main").on('click', '#btngenerebilan', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'verifgenerebilan';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    todo = 'generebilan';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#btnprintdisabled').hide();
                            $('#btnprintabled').show();
                            $('#resultgenerebilan').empty().append(data);
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
            }, dataType: 'json'

        });
    });
    //RESULTAT
    $("#bloc_view_main").on('click', '#btngenereresultat', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptjournal';
        var todo = 'verifgenereresultat';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    todo = 'genereresultat';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#btnprintdisabled').hide();
                            $('#btnprintabled').show();
                            $('#resultgenereresultat').empty().append(data);
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
            }, dataType: 'json'

        });
    });

    $("#bloc_view_main").on('change', '#selectcomptetresor', function (e) {

        e.preventDefault();
        var num = $('#selectcomptetresor option:selected').attr('num');
        var cat = $('#selectcomptetresor option:selected').attr('cat');
        var compt = $('#selectcomptetresor option:selected').attr('compt');
        var compteprov = $('#selectcomptetresor option:selected').text();
        var cpte_id = $('#selectcomptetresor option:selected').attr('value');
        $('#num').val(num);
        $('#cpte_id').val(cpte_id);
        $('#cat').val(cat);
        $('#compt').val(compt);
        $('#compteprov').val(compteprov);

        return false;
    });

    $("#bloc_view_main").on('click', '#btnChoiceFileresultat', function (e) {
        e.preventDefault();
        var typedoc = $("[name=typedoc]:checked").val();
        if (typedoc == 'pdf') {
            var pg = 'admin';
            var view = 'impression';
            var todo = 'resultat';
            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
            window.open(url);
        } else {
            var url = './main.php?pg=admin&view=cptjournal&do=excelRES&hexport=yes&etype=excel';
            window.open(url);
        }
        $("#modalChoiceFile").modal('hide');

    });
    $("#bloc_view_main").on('click', '#btnChoiceFileBILAN', function (e) {
        e.preventDefault();
        var typedoc = $("[name=typedoc]:checked").val();
        if (typedoc == 'pdf') {
            var pg = 'admin';
            var view = 'impression';
            var todo = 'bilan';
            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
            window.open(url);
        } else {
            var url = './main.php?pg=admin&view=cptjournal&do=excelBAC&hexport=yes&etype=excel';
            window.open(url);
        }
        $("#modalChoiceFile").modal('hide');

    });
    //COMPTA
    $("#bloc_view_main").on('change', '.changemonnaie', function (e) {
        e.preventDefault();
        var monnaie = $('.changemonnaie option:selected').attr('value');
        var donnees = '';
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'genererationbondecaisse';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&monnaie=' + monnaie + '&typecasse=entree';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#num_cmd').val(data.num_cmd);
                $('#numBon').val(data.numBon);
                $('#numBonaff').val(data.numBon);
            }, dataType: 'json'
        });
        return false;
    });
    $("#bloc_view_main").on('change', '.changemonnaiesortie', function (e) {
        e.preventDefault();
        var monnaie = $('.changemonnaiesortie option:selected').attr('value');
        var donnees = '';
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'genererationbondecaisse';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&monnaie=' + monnaie + '&typecasse=sortie';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#num_cmd').val(data.num_cmd);
                $('#numBon').val(data.numBon);
                $('#numBonaff').val(data.numBon);
            }, dataType: 'json'
        });
        return false;
    });
    //RESULTAT
    $("#bloc_view_main").on('click', '#btngeneresynthesecaisse', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'tresorerie';
        var todo = 'verifgeneresynthese';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    todo = 'displaysynthesecaisse';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#resultgeneresynthesecaisse').empty().append(data);
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
            }, dataType: 'json'

        });
    });

    //fin fichier compta js
    $("#bloc_view_main").on('click', '.chklie', function (e) {
        e.preventDefault();
        var val = $(this).val();
        if ($('.chklie').prop('checked')) {
            $('#chklie1').show();
            $('#chklie0').hide();
            $('#lie').val(1);

        } else {
            $('#chklie0').show();
            $('#chklie1').hide();
            $('#lie').val(0);
        }

    });
    $("#bloc_view_main").on('click', '.inputvalaccount', function (e) {
        e.preventDefault();
        var code = $(this).attr('id');
        $('#code').val(code);
        $("#myModalaccount").modal('show');
    });
    $("#bloc_view_main").on('click', '#btnconfirmaccount', function (e) {
        e.preventDefault();
        var lib = $('#selectcompte option:selected').text();
        var cat = $('#selectcompte option:selected').attr('cat');
        var compt = $('#selectcompte option:selected').attr('compt');
        var scompt = $('#selectcompte option:selected').attr('scompt');
        var num = $('#selectcompte option:selected').attr('num');
        var lg = $('#selectcompte option:selected').attr('lg');
        var code = $('#code').val();
        $('#' + code).val(lib);
        $('#' + code + 'compte_ecriture').val(num);
        $('#' + code + 'long_compte').val(num);
        $('#' + code + 'souscompte_id').val(scompt);
        $('#' + code + 'categorie_id').val(cat);
        $('#' + code + 'compte_id').val(compt);
        $('#' + code + 'long_compte').val(lg);
        $('#code').val('');
        $("#myModalaccount").modal('hide');
    });

    $("#bloc_view_main").on('click', '.ConfirmConfLinkMod', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resconfig';
        var todo = 'confrestopro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data);
                $('.output').html(data.message).show().fadeOut(4000);
            }, dataType: 'json'

        });
    });

    $("#bloc_view_main").on('click', '.ConfirmConfLinkModHeberge', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resconfig';
        var todo = 'confhebergepro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data);
                $('.output').html(data.message).show().fadeOut(4000);
            }, dataType: 'json'

        });
    });

    //GESTION BUDGETAIRE
    $("#bloc_view_main").on('click', '#btnaddprevi', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptprevision';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  alert(data);
                if (data.s) {
                    todo = 'viewall';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#btnupdateprevi', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptprevision';
        var todo = 'updatepro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data);
                if (data.s) {
                    todo = 'viewall';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#btnfiltrerprevi', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrerl').serialize();
        var pg = 'admin';
        var view = 'cptprevision';
        var todo = 'filtrerprevi';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  $('#titlecl').html('Liste des occupations du '+dte1+' au '+dte2);
                $('#contentdatafilter').empty().append(data);
                $("#modalfiltrerl").modal('hide');
                tablefilter();
            }

        });
    });
    $("#bloc_view_main").on('click', '.supprevi', function (e) {
        e.preventDefault();
        var idprevi = $(this).attr("id");
        $('#idprevi').val(idprevi);
        $("#myModalsupprevi").modal('show');

    });
    $("#bloc_view_main").on('click', '#supprevinon', function (e) {
        e.preventDefault();
        $("#myModalsupprevi").modal('hide');

    });
    $("#bloc_view_main").on('click', '#supprevioui', function (e) {
        e.preventDefault();
        $("#myModalsupjournal").modal('hide');
        var idprevi = $('#idprevi').val();
        var donnees = '';
        var pg = 'admin';
        var view = 'cptprevision';
        var todo = 'delete';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + idprevi;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                todo = 'viewall';
                url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                location.href = url;
            }

        });

    });
    $("#bloc_view_main").on('click', '#btnrealisation', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'cptprevision';
        var todo = 'verifrealisation';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    todo = 'genererealisation';
                    method = 'POST';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#resultgenerereal").empty().append(data);
                            $("#btnprintdisabled").hide();
                            $("#btnprintabled").show();

                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('change', '.get_auto_previ', function (e) {
        e.preventDefault();
        var prev_id = $('.get_auto_previ option:selected').attr('prev_id');
        $('#prev_id').val(prev_id);
        return false;
    });
    //GESTION BUDGETAIRE






});


$(function () {
    //Timepicker
    $('.timepicker').timepicker({ 'timeFormat': 'H:i:s' });
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
});
/*CUSTUM FUNCTIONS*/
function getParam(param) {
    var varsp = {};
    window.location.href.replace(/[?&]+([^=&]+)=?([^&]*)?/gi,
        function (m, key, value) {
            varsp[key] = value;
        }
    );
    if (param) {
        return varsp[param] ? varsp[param] : null;
    }
    return varsp;
}
function selectjs() {
    $(".choz").chosen({
        disable_search: false,
        no_results_text: "No Search Results!",
        width: "100%",
    });
}
function tablefilter() {
    $('.t1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": true
    });
    $('.t2').footable();
}
function effacer() {
    $(':input', '.form_paie').not(':button,:submit,:reset,:hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
}
// function AutoCompta() {
//     var donnees = '';
//     var pg = 'admin';
//     var view = 'cptjournal';
//     var todo = 'MajJournal';
//     var method = 'POST';
//     var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
//     $.ajax({
//         url: url,
//         type: method,
//         data: donnees,
//         success: function (data) {
//             if (data.s) {
//                 donnees = $('#frmfiltrerl').serialize();
//                 todo = 'filtrerjournaux';
//                 url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
//                 $.ajax({
//                     url: url,
//                     type: method,
//                     data: donnees,
//                     success: function (data) {
//                         $('#contentdatafilter').empty().append(data);
//                         $("#modalfiltrerl").modal('hide');
//                         tablefilter();
//                     }

//                 });
//             }
//         }, dataType: 'json'

//     });
// }
// AutoCompta();