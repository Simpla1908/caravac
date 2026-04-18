$(document).ajaxStart(function () {
    Pace.restart();
});

//$(document).ready(function () {
//    //Chargement des fichiers par defaut
////    alert("oook");
//    var pg = 'admin';
//    var view = 't_facture';
//    var todo = 'recurente';
//    var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
//});
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
    //js sanction & congé
    //SANCTION
    $("#bloc_view_main").on('change', '.chx_sanction', function (e) {
        e.preventDefault();
        var ret = $('.chx_sanction option:selected').attr('ret');
        var nbrj = $('.chx_sanction option:selected').attr('nbrj');
        var lib = $('.chx_sanction option:selected').attr('lib');
        var idsanct = $('.chx_sanction option:selected').attr('value');
        var cont = '';
        var donnees = '';
        var pg = 'admin';
        var view = 'ressanction';
        var todo = 'contenusanct';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idsanct=' + idsanct;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                cont = data;
                //alert(cont);
                $("#ret").val(ret);
                $("#nbrj").val(nbrj);
                $("#sanction_lib").val(lib);
                if (nbrj > 0) {
                    $(".periodsanct").show();
                    // $(".nbrjsanct").show();

                } else {
                    $(".periodsanct").hide();
                    // $(".nbrjsanct").hide();

                }
                CKEDITOR.instances.editor1.setData(cont);
            }

        });

        return false;
    });

    $("#bloc_view_main").on('click', '.btnaffsanction', function (e) {
        e.preventDefault();
        //Forcer les instances de CKEditor de mettre à jour 
        //leurs textarea respectifs, et de récupérer tout simplement la valeur du textarea
        CKEDITOR.instances.editor1.updateElement();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'ressanction';
        var todo = 'affect_sanction_pro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    //impression
                    var noms = data.noms;
                    var sexe = data.sexe;
                    var adresse = data.adresse;
                    var commune = data.commune;
                    var ville = data.ville;
                    var dte = data.dte;
                    var dte1 = data.dte1;
                    var dte2 = data.dte2;
                    var ref = data.ref;
                    var sanction = data.sanction;
                    var quartier = data.quartier;
                    var rue = data.rue;
                    var nbrj = data.nbrj;
                    var idemplsc = data.idemplsc;
                    var imprimele = 0;
                    //alert(idemplsc);
                    pg1 = 'admin';
                    view1 = 'impression';
                    todo1 = 'prnt_doc_sanction';
                    url1 = './main.php?pg=' + pg1 + '&view=' + view1 + '&do=' + todo1 + '&noms=' + noms + '&sexe=' + sexe + '&adresse=' + adresse + '&commune=' + commune + '&ville=' + ville + '&dte=' + dte + '&ref=' + ref + '&dte1=' + dte1 + '&dte2=' + dte2 + '&sanction=' + sanction + '&rue=' + rue + '&quartier=' + quartier + '&idemplsc=' + idemplsc + '&nbrj=' + nbrj + '&imprimele=' + imprimele;
                    window.open(url1);
                    //fin impression
                    todo = 'listsanctemply';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;


                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '.btnsanction', function (e) {
        e.preventDefault();
        CKEDITOR.instances.editor1.updateElement();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'ressanction';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
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
    $("#bloc_view_main").on('click', '.btnsanctionmaj', function (e) {
        e.preventDefault();
        CKEDITOR.instances.editor1.updateElement();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'ressanction';
        var todo = 'updatepro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
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

    $("#bloc_view_main").on('click', '.showtext', function (e) {
        e.preventDefault();
        var val = $(this).attr("value");
        // alert(val);
        if (val == 0) {
            $('#docno').replaceWith('<input type="radio" name="doc" id="docno" value="0" class="minimal showtext" checked>');
            $('#docyes').replaceWith('<input type="radio" name="doc" id="docyes" value="1" class="minimal showtext">');

            $('.texte').hide();
        } else {
            $('#docno').replaceWith('<input type="radio" name="doc" id="docno" value="0" class="minimal showtext">');
            $('#docyes').replaceWith('<input type="radio" name="doc" id="docyes" value="1" class="minimal showtext" checked>');
            $('.texte').show();

        }


    });
    //congé

    $("#bloc_view_main").on('click', '.btncg', function (e) {
        e.preventDefault();
        //Forcer les instances de CKEditor de mettre à jour 
        //leurs textarea respectifs, et de récupérer tout simplement la valeur du textarea
        CKEDITOR.instances.editor1.updateElement();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
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
    $("#bloc_view_main").on('click', '.btnupdtcg', function (e) {
        e.preventDefault();
        CKEDITOR.instances.editor1.updateElement();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'updatepro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
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
    $("#bloc_view_main").on('click', '.rdchxcg', function (e) {
        e.preventDefault();
        var chxcg = $(this).attr("value");
        //alert(chxcg);
        if (chxcg == 0) {
            $('.pfrm').hide();
            $("#chxcg1").replaceWith('<input type="radio" name="chxcg" id="chxcg1" value="0" class="minimal rdchxcg" checked>');
            $("#chxcg2").replaceWith('<input type="radio" name="chxcg" id="chxcg2" value="1" class="minimal rdchxcg">');
        } else {
            $('.pfrm').show();
            $("#chxcg1").replaceWith('<input type="radio" name="chxcg" id="chxcg1" value="0" class="minimal rdchxcg">');
            $("#chxcg2").replaceWith('<input type="radio" name="chxcg" id="chxcg2" value="1" class="minimal rdchxcg" checked>');

        }
    });
    $("#bloc_view_main").on('change', '.chx_conge', function (e) {
        e.preventDefault();
        // alert('rrrr');
        var idcg = $('.chx_conge option:selected').attr('value');
        var nbrj = $('.chx_conge option:selected').attr('nbrj');
        var trans = $('.chx_conge option:selected').attr('trans');
        var type = $('.chx_conge option:selected').attr('type');
        var lib = $('.chx_conge option:selected').attr('lib');
        var cont = '';
        var donnees = '';
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'contenuconge';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idcg=' + idcg;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                cont = data;
                //alert(cont);
                $("#nombjrs").val(nbrj);
                $("#trans").val(trans);
                $("#type").val(type);
                $("#conge_lib").val(lib);
                CKEDITOR.instances.editor1.setData(cont);
            }

        });
    });
    $("#bloc_view_main").on('change', '#dte1', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var nbrjancien = $("#nbrjancien").val();
        var type = $("#type").val();
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'generedatefin';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&nbrjancien=' + nbrjancien + '&type=' + type;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $(".outputdte2").empty().append(data.dte2f);
                    $("#dte2").val(data.dte2);

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });


    });

    $("#bloc_view_main").on('change', '.slctdatasemploye', function (e) {
        e.preventDefault();
        var ville = $('.slctdatasemploye option:selected').attr('ville');
        var commune = $('.slctdatasemploye option:selected').attr('commune');
        var noms = $('.slctdatasemploye option:selected').attr('noms');
        var adresse = $('.slctdatasemploye option:selected').attr('adresse');
        var sexe = $('.slctdatasemploye option:selected').attr('sexe');
        var quartier = $('.slctdatasemploye option:selected').attr('quartier');
        var rue = $('.slctdatasemploye option:selected').attr('rue');
        $("#ville").val(ville);
        $("#commune").val(commune);
        $("#noms").val(noms);
        $("#adresse").val(adresse);
        $("#sexe").val(sexe);
        $("#quartier").val(quartier);
        $("#rue").val(rue);





    });
    $("#bloc_view_main").on('change', '.slctdatasemployecg', function (e) {
        e.preventDefault();
        var ville = $('.slctdatasemployecg option:selected').attr('ville');
        var commune = $('.slctdatasemployecg option:selected').attr('commune');
        var noms = $('.slctdatasemployecg option:selected').attr('noms');
        var adresse = $('.slctdatasemployecg option:selected').attr('adresse');
        var sexe = $('.slctdatasemployecg option:selected').attr('sexe');
        var nbrjancien = $('.slctdatasemployecg option:selected').attr('nbrjancien');
        var quartier = $('.slctdatasemployecg option:selected').attr('quartier');
        var rue = $('.slctdatasemployecg option:selected').attr('rue');
        $("#ville").val(ville);
        $("#commune").val(commune);
        $("#noms").val(noms);
        $("#adresse").val(adresse);
        $("#sexe").val(sexe);
        $("#nbrjancien").val(nbrjancien);
        $("#quartier").val(quartier);
        $("#rue").val(rue);
    });
    $("#bloc_view_main").on('change', '.dtessanction', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'ressanction';
        var todo = 'generedatefin';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $(".outputdte2").empty().append(data.dte2f);
                    $("#dte2").val(data.dte2);

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });


    });
    $("#bloc_view_main").on('click', '.btnaffconge', function (e) {
        // alert('bsr');
        e.preventDefault();
        //Forcer les instances de CKEditor de mettre à jour 
        //leurs textarea respectifs, et de récupérer tout simplement la valeur du textarea
        CKEDITOR.instances.editor1.updateElement();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'executcgpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data.s);
                if (data.s) {
                    //impression
                    var noms = data.noms;
                    var sexe = data.sexe;
                    var adresse = data.adresse;
                    var commune = data.commune;
                    var ville = data.ville;
                    var dte = data.dte;
                    var dte1 = data.dte1;
                    var dte2 = data.dte2;
                    var ref = data.ref;
                    var conge_lib = data.conge_lib;
                    var quartier = data.quartier;
                    var rue = data.rue;
                    var idemplcg = data.idemplcg;
                    var imprimele = 0;
                    pg1 = 'admin';
                    view1 = 'impression';
                    todo1 = 'prnt_doc_conge';
                    url1 = './main.php?pg=' + pg1 + '&view=' + view1 + '&do=' + todo1 + '&noms=' + noms + '&sexe=' + sexe + '&adresse=' + adresse + '&commune=' + commune + '&ville=' + ville + '&dte=' + dte + '&ref=' + ref + '&dte1=' + dte1 + '&dte2=' + dte2 + '&conge_lib=' + conge_lib + '&quartier=' + quartier + '&rue=' + rue + '&idemplcg=' + idemplcg + ' &imprimele=' + imprimele;
                    window.open(url1);
                    // fin impression
                    todo = 'panelconge';
                    url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    location.href = url;


                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '.btndetailcg', function (e) {
        e.preventDefault();
        //alert('ok');
        var id = $(this).attr("id");
        // alert(id);
        var donnees = '';
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'detailcgemply';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data);
                $('#tab_2').empty().append(data);
                $('.t3').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": false,
                    "info": false,
                    "autoWidth": true
                });
                $('.t4').footable();
            }

        });
    });
    $("#bloc_view_main").on('click', '.btndetailcgrtrn', function (e) {
        e.preventDefault();
        //alert('ok');
        var donnees = '';
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'listcgemply';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data);
                $('#tab_2').empty().append(data);
            }

        });
    });
    $("#bloc_view_main").on('click', '.btnemployeeligble', function (e) {
        e.preventDefault();
        //alert('ok');
        var donnees = '';
        var pg = 'admin';
        var view = 'resconge';
        var todo = 'listcgemplyeli';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                $('#tab_eligibl').empty().append(data);
            }

        });
    });

    //fin 

    $("#bloc_view_main").on('click', '.btn_doc_conge', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var adresse = $(this).attr("adresse");
        var rue = $(this).attr("rue");
        var quartier = $(this).attr("quartier");
        var commune = $(this).attr("commune");
        var ville = $(this).attr("ville");
        var sexe = $(this).attr("sexe");
        var noms = $(this).attr("noms");
        var doc = $(this).attr("doc");
        var employe_id = $(this).attr("employe_id");
        var ref = $(this).attr("ref");
        var dte2 = $(this).attr("dte2");
        var dte1 = $(this).attr("dte1");
        var dte = $(this).attr("dte");
        var conge_lib = $(this).attr("conge_lib");
        var imprimele = 1;
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_doc_conge';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idemplcg=' + id + '&adresse=' + adresse + '&rue=' + rue + '&quartier=' + quartier + '&commune=' + commune + '&ville=' + ville + '&sexe=' + sexe + '&noms=' + noms + '&doc=' + doc + '&employe_id=' + employe_id + '&ref=' + ref + '&dte2=' + dte2 + '& dte1=' + dte1 + '& dte=' + dte + '& conge_lib=' + conge_lib + '& imprimele=' + imprimele;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_doc_sanction', function (e) {
        e.preventDefault();
        var idemplsc = $(this).attr("idemplsc");
        var adresse = $(this).attr("adresse");
        var rue = $(this).attr("rue");
        var quartier = $(this).attr("quartier");
        var commune = $(this).attr("commune");
        var ville = $(this).attr("ville");
        var sexe = $(this).attr("sexe");
        var noms = $(this).attr("noms");
        var doc = $(this).attr("doc");
        var employe_id = $(this).attr("employe_id");
        var ref = $(this).attr("ref");
        var dte2 = $(this).attr("dte2");
        var dte1 = $(this).attr("dte1");
        var dte = $(this).attr("dte");
        var sanction = $(this).attr("sanction");
        var nbrj = $(this).attr("nbrj");
        var imprimele = 0;
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_doc_sanction';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idemplsc=' + idemplsc + '&adresse=' + adresse + '&rue=' + rue + '&quartier=' + quartier + '&commune=' + commune + '&ville=' + ville + '&sexe=' + sexe + '&noms=' + noms + '&doc=' + doc + '&employe_id=' + employe_id + '&ref=' + ref + '&dte2=' + dte2 + '& dte1=' + dte1 + '& dte=' + dte + '& sanction=' + sanction + '& nbrj=' + nbrj + '&imprimele=' + imprimele;
        window.open(url);

    });
    //Déclaration fiscale
    $("#bloc_view_main").on('change', '.sltdesdecl', function (e) {
        e.preventDefault();
        //alert('ok');
        var id = $('.sltdesdecl option:selected').attr('value');
        var code = $('.sltdesdecl option:selected').attr('code');
        var lib = $('.sltdesdecl option:selected').attr('lib');
        var pourtrav = $('.sltdesdecl option:selected').attr('pourtrav');
        var poursoc = $('.sltdesdecl option:selected').attr('poursoc');
        $("#id").val(id);
        $("#code").val(code);
        $("#lib").val(lib);
        $("#pourtrav").val(pourtrav);
        $("#poursoc").val(poursoc);
    });
    $("#bloc_view_main").on('click', '#btndeclaration', function (e) {
        // alert('ok');
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resdeclaration';
        var todo = 'verifdates';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  alert(data.s);
                if (data.s) {
                    todo = 'viewdatasdclrt';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //alert(data);
                            $('#datasdeclaration').empty().append(data);
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

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });





    });
    $("#bloc_view_main").on('click', '.btn_prnt_declaration', function (e) {
        e.preventDefault();
        var code = $("#code").val();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_declaration';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&code=' + code;
        window.open(url);

    });

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
    /*SELECTION NBRE ENFANT*/
    $("#bloc_view_main").on('change', '#nbrenf', function (e) {
        e.preventDefault();
        var nbrenf = $('#nbrenf').val();
        $('#infosenf').empty();
        for (var iter = 1; iter <= nbrenf; iter++) {
            $('#infosenf').append('<div class="row"><div class="col-md-5"> <div class="form-group"><label for="enfnoms" class="col-sm-4 control-label">Noms ' + iter + '</label>\n\
                    <div class="col-sm-8"> <input id="enfnoms" name="enfnoms[]" type="text" class="form-control"></div>\n\
                     </div> </div><div class="col-md-5"><div class="form-group"> <label for="enfdatenais" class="col-sm-4 control-label"> Date de naiss. ' + iter + '\
                     </label><div class="col-sm-8"><input id="enfdatenais" name="enfdatenais[]" type="text" class="form-control datemask"  placeholder="Jour/Mois/Année">\n\
                     </div></div></div></div>');
        }
    });
    /*POINTAGE*/
    /*Selection bouton depart arrive */
    $("#bloc_view_main").on('click', '.btnpoint', function (e) {
        e.preventDefault();
        $('#typepoint').val($(this).attr("value"));
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $('.output').html(data.message).show().fadeOut(4000);
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=slctemployupdate';
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data1) {
                            $('.testslct').empty().append(data1);
                            $(".choz").chosen({
                                disable_search: false,
                                no_results_text: "No Search Results!",
                                width: "100%",
                            });
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    /*Filtrer employe**/

    $("#bloc_view_main").on('change', '#employe_id1', function (e) {
        e.preventDefault();
        var dte_in = $('#employe_id1 option:selected').attr('dte_in');
        var horaire_id = $('#employe_id1 option:selected').attr('horaire_id');
        var idpoint = $('#employe_id1 option:selected').attr('idpoint');
        var idpointprec = $('#employe_id1 option:selected').attr('idpointprec');
        var compteurshift = $('#employe_id1 option:selected').attr('compteurshift');
        var idtmppoint = $('#employe_id1 option:selected').attr('idtmppoint');
        $('#dte_in').val(dte_in);
        $('#horaire_id').val(horaire_id);
        $('#idpoint').val(idpoint);
        $('#idpointprec').val(idpointprec);
        $('#compteurshift').val(compteurshift);
        $('#idtmppoint').val(idtmppoint);

        return false;
    });
    /*Filtrer mois**/
    $("#bloc_view_main").on('change', '#annevld', function (e) {
        e.preventDefault();
        var donnees = $('#formfltrvld').serialize();
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'filtremois';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#moisvld').empty().append(data);
            }

        });
        return false;
    });
    /*Validation presence */
    $("#bloc_view_main").on('click', '.btnvalidpresen', function (e) {
        e.preventDefault();
        var horaire_id = $(this).attr("horaire_id");
        var dte_in = $(this).attr("dte_in");
        var dte_fin = $(this).attr("dte_fin");
        var dbt = $(this).attr("hrs_dbt");
        var fin = $(this).attr("hrs_fin");
        //alert(dte_fin+'  '+fin);
        //recuperation date & heure systeme
        var donnees = '';
        var date_sys = '';
        var heure_sys = '';
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'validpres';
        var method = 'POST';
        $.ajax({
            url: 'rh/views/admin/respointage/data_date_heure_sys.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                date_sys = data.date_sys;
                heure_sys = data.heure_sys;
                var donnees = $('#formfltrvld').serialize();
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&horaire_id=' + horaire_id + '&dte_in=' + dte_in + '&dbt=' + dbt + '&fin=' + fin;
                // alert(date_sys+'  '+heure_sys);
                if (dte_fin < date_sys) {
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('.output').html('<div class="alert alert-danger">Validation effectuée avec succes</div>').show().fadeOut(8000);
                            // alert(data);
                            $('#viewdata').empty().append(data);
                        }
                    });
                } else if (dte_fin == date_sys) {
                    if (heure_sys > fin) {
                        $.ajax({
                            url: url,
                            type: method,
                            data: donnees,
                            success: function (data) {
                                $('.output').html('<div class="alert alert-danger">Validation effectuée avec succes</div>').show().fadeOut(8000);
                                //  alert(data);
                                $('#viewdata').empty().append(data);
                            }
                        });
                    } else if (heure_sys <= fin) {
                        $('.output').html('<div class="alert alert-danger">Veuillez valider apres l\'heure de fin de service ' + fin + '</div>').show().fadeOut(8000);
                    }
                } else if (dte_fin > date_sys) {
                    $('.output').html('<div class="alert alert-danger">Veuillez valider demain apres l\'heure de fin de service ' + fin + '</div>').show().fadeOut(8000);
                }
            }, dataType: 'json'
        });
        //fin recuperation


    });
    /*Filtrer validation par rapport au mois&annee */
    $("#bloc_view_main").on('click', '.btnfltrvld', function (e) {
        e.preventDefault();
        var moisvld = $('#moisvld').val();
        var annevld = $('#annevld').val();
        if (moisvld != 0 && annevld != 0) {
            var donnees = $('#formfltrvld').serialize();
            var pg = 'admin';
            var view = 'respointage';
            var todo = 'validpres';
            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
            $.ajax({
                url: url,
                type: method,
                data: donnees,
                success: function (data) {
                    $('#viewdata').empty().append(data);
                }

            });
        } else {
            $('.output').html('<div class="alert alert-danger">Veuillez sélectionner le mois et l\'année</div>').show().fadeOut(4000);
        }

    });
    /*Bouton permuter*/
    $("#bloc_view_main").on('click', '#btnpermut', function (e) {
        e.preventDefault();
        $("#ModalPermut").modal('show');
        return false;
    });
    /*Validation permutation */
    $("#bloc_view_main").on('click', '#btn_valider_permut', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'validpermut';
        var method = 'POST';
        var donnees = $('#formpermut').serialize();
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $('.output').html(data.message).show().fadeOut(4000);
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=majviewpermit';
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data1) {
                            $('#viewdata').empty().append(data1);
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '.btnannulperm', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'annulpermut';
        var method = 'POST';
        var donnees = '';
        var idprmt = $(this).attr("id_perm");
        var idagt1 = $(this).attr("idagent1");
        var idagt2 = $(this).attr("idagent2");
        var idhr = $(this).attr("idhoraire");
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idprmt=' + idprmt + '&idagt1=' + idagt1 + '&idagt2=' + idagt2 + '&idhr=' + idhr;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=majviewpermit';
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function (data1) {
                        $('#viewdata').empty().append(data1);
                    }

                });
            }
        });
    });
    /*recuperer noms horaire*/
    $("#bloc_view_main").on('change', '#horaire_id', function (e) {
        e.preventDefault();
        var horairelib = $('#horaire_id option:selected').text();
        $('#horairelib').val(horairelib);
        return false;
    });
    /*recuperer nomsagent1*/
    $("#bloc_view_main").on('change', '#agent1', function (e) {
        e.preventDefault();
        var nomsagent1 = $('#agent1 option:selected').text();
        $('#nomsagent1').val(nomsagent1);
        return false;
    });
    /*recuperer nomsagent2*/
    $("#bloc_view_main").on('change', '#agent2', function (e) {
        e.preventDefault();
        var nomsagent2 = $('#agent2 option:selected').text();
        $('#nomsagent2').val(nomsagent2);
        return false;
    });
    $("#bloc_view_main").on('click', '#btn_periode', function (e) {
        e.preventDefault();
        var donnees = $("#periode_presence").serialize();
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'presenceajex';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#viewdata').empty().append(data);
            }
        });
    });
    /*PAIE**/
    $("#bloc_view_main").on('change', '.employe', function (e) {
        var dteng = $('.employe option:selected').attr('dteng');
        var dteng2 = $('.employe option:selected').attr('dteng2');
        var anciennete = $('.employe option:selected').attr('anciennete');
        var preavis = $('.employe option:selected').attr('preavis');
        var employe_id = $('.employe option:selected').attr('employe_id');
        var idcat = $('.employe option:selected').attr('idcat');
        var devise = $('.employe option:selected').attr('devise');
        var nbrenf = $('.employe option:selected').attr('nbrenf');
        var montantjr = $('.employe option:selected').attr('montantjr');
        $("#idcat").val(idcat);
        $("#nbrenf").val(nbrenf);
        $("#salbase").val($('.employe option:selected').attr('salbase'));
        $("#montantjr").val(montantjr);
        $("#devise").val($('.employe option:selected').attr('devise'));
        $("#matricule").val($('.employe option:selected').attr('matricule'));
        $("#fonction").val($('.employe option:selected').attr('fonction'));
        // Resiliation
        $(".dteng").val(dteng);
        $(".dteng2").val(dteng2);
        $(".anciennete").val(anciennete);
        $(".preavis").val(preavis);
        $('#bloc_emprubrique').empty().html();
        //        $(".devise").text(devise);
        var donnees = '';
        var pg = 'admin';
        var view = 'ressalaire';
        var todo = 'employe';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&dteng=' + dteng + '&employe_id=' + employe_id;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#periode_bloc').empty().html(data);
                selectjs();
            }
        });
        return false;
    });
    $("#bloc_view_main").on('change', '#periode', function (e) {
        var totbase = 0;
        var numero = $('#periode option:selected').attr('numero');
        var annee = $('#periode option:selected').attr('annee');
        var employe_id = $(".employe").val();
        var idcat = $("#idcat").val();
        var devise = $("#devise").val();
        var donnees = $(".form_paie").serialize();
        var pg = 'admin';
        var view = 'ressalaire';
        var todo = 'periode';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&numero=' + numero + '&employe_id=' + employe_id + '&annee=' + annee;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                totbase = data.totsb;
                $(".presence").val(data.presence);
                $(".conge").val(data.conge);
                $(".hrsuppl").val(data.hrsuppl);
                $(".totsb").val(data.totsb);
                $("#nbjrtransport").val(data.transport);
                var donnees2 = $(".form_paie").serialize();
                $.ajax({
                    url: './main.php?pg=' + pg + '&view=' + view + '&do=emprubrique' + '&idcat=' + idcat + '&devise=' + devise + '&totbase=' + totbase,
                    type: method,
                    data: donnees2,
                    success: function (data) {
                        $('#bloc_emprubrique').empty().html(data);
                        selectjs();
                    }
                });
            }, dataType: 'json'
        });
        return false;
    });
    $("#bloc_view_main").on('click', '.btnjustif', function (e) {
        e.preventDefault();
        $("#idpoint").val($(this).attr("id"));
        $("#datedebut").val($(this).attr("datedebut"));
        $("#datefin").val($(this).attr("datefin"));
        $("#idemply").val($(this).attr("idemply"));
        $("#ModalPermut").modal('show');
        return false;
    });
    $("#bloc_view_main").on('click', '#btn_valider_justif', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'validjustif';
        var method = 'POST';
        var donnees = $('#formjustif').serialize();
        var datedebut = $('#datedebut').val();
        var datefin = $('#datefin').val();
        var idemply = $('#idemply').val();
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $('.output').html(data.message).show().fadeOut(4000);
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=majviewjstf&datedebut=' + datedebut + '&datefin=' + datefin + '&idemply=' + idemply;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data1) {
                            $('#viewdata').empty().append(data1);
                        }

                    });
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'
        });
        return false;
    });
    //RESILIATION DEBUT
    $("#bloc_view_main").on('change', '#decomptemotif', function (e) {
        var donnees = $('.resiliation_frm').serialize();
        var motif = $('#decomptemotif').val();
        var employe_id = $('#employe_id').val();
        if (motif == '') {
            $('#bloc_emprubrique').empty().html('');
        } else {
            if (employe_id != '') {
                var pg = 'admin';
                var view = 'ressalaire';
                var todo = 'motifdecompte';
                var method = 'POST';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $('#bloc_emprubrique').empty().html(data);
                    }
                });
            }
        }
        return false;
    });
    //RESILIATION FIN 
    /*BON MALADE**/
    $("#bloc_view_main").on('change', '#employe', function (e) {
        var employe_id = $('#employe option:selected').attr('value');
        $("#employeradio").replaceWith('<input type="radio" name="idmalade" id="employeradio" value="" checked>');
        $("#employeradio").val(employe_id);
        $("#emplyprisencharg").val(employe_id);
        var donnees = '';
        var pg = 'admin';
        var view = 'resbonmalade';
        var todo = 'employe';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&employe_id=' + employe_id;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('.bloc_membre').empty().html(data);
            }
        });

        return false;
    });
    $("#bloc_view_main").on('click', '.bnmld', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resbonmalade';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    //affectation impression
                    var id1 = data.nom_malad;
                    var id2 = data.num_bon;
                    pg = 'admin';
                    view = 'impression';
                    todo = 'bon_malade';
                    urlprint = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id1=' + id1 + '&id2=' + id2;
                    //fin affectation impression
                    $('.output').html(data.message).show().fadeOut(4000);
                    $("#employeradio").replaceWith('<input type="radio" name="idmalade" id="employeradio" value="" checked>');
                    $(".bloc_membre").empty();
                    var url = './main.php?pg=admin&view=resbonmalade&do=lstempl';
                    var method = 'POST';
                    $.ajax({
                        url: url,
                        type: method,
                        success: function (data) {
                            //impression bon de malade
                            window.open(urlprint);
                            //fin impression
                            $('#employe').empty().html(data);
                            selectjs();

                        }
                    });
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    //IMPRESSION KING
    $("#bloc_view_main").on('click', '.btn_print_bm', function (e) {
        e.preventDefault();
        var id1 = $(this).attr("id1");
        var id2 = $(this).attr("id2");
        var id3 = $(this).attr("id3");
        var pg = 'admin';
        var view = 'impression';
        var todo = 'bon_malade';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id1=' + id1 + '&id2=' + id2 + '&id3=' + id3;    // window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_prnt_recu_pret', function (e) {
        e.preventDefault();
        var noms = $(this).attr("noms");
        var numero = $(this).attr("numero");
        var montant = $(this).attr("montant");
        var dte = $(this).attr("dte");
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_recu_pret';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&noms=' + noms + '&numero=' + numero + '&montant=' + montant + '&dte=' + dte;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_prnt_recu_avance', function (e) {
        e.preventDefault();
        var noms = $(this).attr("noms");
        var numero = $(this).attr("numero");
        var montant = $(this).attr("montant");
        var dte = $(this).attr("dte");
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_recu_avance';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&noms=' + noms + '&numero=' + numero + '&montant=' + montant + '&dte=' + dte;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_print_list_emply', function (e) {
        e.preventDefault();
        var datedebut = $('#datedebut').val();
        var datefin = $('#datefin').val();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_list_pres';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&datedebut=' + datedebut + '&datefin=' + datefin;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_print_list_perm', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'print_list_perm';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_prnt_list_pret', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_list_pret';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_prnt_list_avance', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_list_avance';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });

    $("#bloc_view_main").on('click', '.btn_prnt_bn_perm', function (e) {
        e.preventDefault();
        var num = $(this).attr("num");
        var dte = $(this).attr("dte");
        var dte_fin = $(this).attr("dte_fin");
        var shift = $(this).attr("shift");
        var tit = $(this).attr("tit");
        var rem = $(this).attr("rem");
        var type = $(this).attr("type");
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_bn_perm';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&num=' + num + '&dte=' + dte + '&dte_fin=' + dte_fin + '&shift=' + shift + '&tit=' + tit + '&rem=' + rem + '&type=' + type;
        window.open(url);

    });

    /*CONFIG**/
    $("#bloc_view_main").on('click', '.btnconfig', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resconfig';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    /*EMPRUNT*/
    $("#bloc_view_main").on('click', '.btnavance', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resemprunt';
        var todo = 'addpro_av';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $('.output').html(data.message).show().fadeOut(4000);
                    effacer();
                    MajSlctEmply();
                    MajSlctMois();
                    //impression recu avance
                    var noms = data.noms;
                    var numero = data.numero;
                    var montant = data.montant;
                    var dte = data.dte;
                    var pg = 'admin';
                    var view = 'impression';
                    var todo = 'prnt_recu_avance';
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&noms=' + noms + '&numero=' + numero + '&montant=' + montant + '&dte=' + dte;
                    window.open(url);
                    //fin impression
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('change', '.emply_emprnt', function (e) {
        e.preventDefault();
        var nomemploye = $('.emply_emprnt option:selected').attr('nom');
        $("#nomemploye").val(nomemploye);
        return false;
    });

    $("#bloc_view_main").on('click', '.btnpret', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'resemprunt';
        var todo = 'addpro_pr';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $('.output').html(data.message).show().fadeOut(4000);
                    effacer();
                    MajSlctEmply();
                    MajSlctMois();
                    //impression recu pret
                    var noms = data.noms;
                    var numero = data.numero;
                    var montant = data.montant;
                    var dte = data.dte;
                    var pg = 'admin';
                    var view = 'impression';
                    var todo = 'prnt_recu_pret';
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&noms=' + noms + '&numero=' + numero + '&montant=' + montant + '&dte=' + dte;
                    window.open(url);
                    //fin impression
                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    function MajSlctEmply() {
        var url = './main.php?pg=admin&view=resemprunt&do=lstemplemprunt';
        var method = 'POST';
        $.ajax({
            url: url,
            type: method,
            success: function (data) {
                $('#employe_bloc').empty().html(data);
                selectjs();
            }
        });
    }
    function MajSlctMois() {
        var url = './main.php?pg=admin&view=resemprunt&do=lstmoisemprunt';
        var method = 'POST';
        $.ajax({
            url: url,
            type: method,
            success: function (data) {
                $('#mois_bloc').empty().html(data);
                selectjs();
            }
        });
    }

    /*PAIE**/
    $("#bloc_view_main").on('change', '.employe', function (e) {
        var dteng = $('.employe option:selected').attr('dteng');
        var employe_id = $('.employe option:selected').attr('employe_id');
        var idcat = $('.employe option:selected').attr('idcat');
        var devise = $('.employe option:selected').attr('devise');
        var nbrenf = $('.employe option:selected').attr('nbrenf');
        $("#idcat").val(idcat);
        $("#nbrenf").val(nbrenf);
        $("#salbase").val($('.employe option:selected').attr('salbase'));
        $("#dteng").val($('.employe option:selected').attr('dteng'));
        $("#devise").val($('.employe option:selected').attr('devise'));
        $("#matricule").val($('.employe option:selected').attr('matricule'));
        $("#fonction").val($('.employe option:selected').attr('fonction'));
        $('#bloc_emprubrique').empty().html();
        //        $(".devise").text(devise);
        var donnees = '';
        var pg = 'admin';
        var view = 'ressalaire';
        var todo = 'employe';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&dteng=' + dteng + '&employe_id=' + employe_id;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#periode_bloc').empty().html(data);
                selectjs();
            }
        });
        return false;
    });
    $("#bloc_view_main").on('change', '#periode', function (e) {
        var numero = $('#periode option:selected').attr('numero');
        var annee = $('#periode option:selected').attr('annee');
        var libelle = $('#periode option:selected').attr('libelle');
        $("#libelle").val(libelle);
        var employe_id = $(".employe").val();
        var idcat = $("#idcat").val();
        var devise = $("#devise").val();
        var donnees = $(".form_paie").serialize();
        var pg = 'admin';
        var view = 'ressalaire';
        var todo = 'periode';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&numero=' + numero + '&employe_id=' + employe_id + '&annee=' + annee;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $(".presence").val(data.presence);
                $(".conge").val(data.conge);
                $(".hrsuppl").val(data.hrsuppl);
                $(".totsb").val(data.totsb);
                var montantjr = $('#montantjr').val();
                var donnees2 = $(".form_paie").serialize();
                $.ajax({
                    url: './main.php?pg=' + pg + '&view=' + view + '&do=emprubrique' + '&idcat=' + idcat + '&devise=' + devise + '&montantjr=' + montantjr,
                    type: method,
                    data: donnees2,
                    success: function (data) {
                        $('#bloc_emprubrique').empty().html(data);
                        selectjs();
                    }
                });
            }, dataType: 'json'
        });
        return false;
    });
    //CLICK SUR LE BOUTON VALIDER PAIE
    $("#bloc_view_main").on('click', '.recalcul', function (e) {
        var donnees = $(".form_paie").serialize();
        var pg = 'admin';
        var view = 'ressalaire';
        var todo = 'recalculer';
        var method = 'POST';
        var id = $(this).val()
        var coche = 1;
        if ($(this).is(":checked")) {
            coche = 1;
        } else {
            coche = 0;
        }
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id + '&coche=' + coche;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#bloc_emprubrique").html(data);
            }
        });
    });
    $("#bloc_view_main").on('keyup', '.valrub', function (e) {
        var id = $(this).attr('chb');
        var select = '.chb' + id;
        $(select).prop("checked", false);
    });
    $("#bloc_view_main").on('click', '#btn_valider_paie', function (e) {
        e.preventDefault();
        var salaire_id = '';
        var donnees = $(".form_paie").serialize();
        var pg = 'admin';
        var view = 'ressalaire';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data.message);
                if (data.s) {
                    salaire_id = data.salaire_id;
                    var view1 = 'impression';
                    var todo1 = 'bulletin';
                    $(".output").html('');
                    $(".nbre").val(0);
                    $("#bloc_emprubrique").html('');
                    //Maj période
                    var urlperiode = './main.php?pg=admin&view=ressalaire&do=employe&dteng=' + data.dteng + '&employe_id=' + data.employe_id;
                    $.ajax({
                        url: urlperiode,
                        type: method,
                        success: function (data) {
                            $('#periode_bloc').empty().html(data);
                            selectjs();
                        }
                    });
                    //Maj liste employe
                    var urlemployepaie = './main.php?pg=admin&view=ressalaire&do=lstemplpaie';
                    $.ajax({
                        url: urlemployepaie,
                        type: method,
                        success: function (data) {
                            $('#employe_bloc').empty().html(data);
                            selectjs();
                        }
                    });
                    window.open('./main.php?pg=' + pg + '&view=' + view1 + '&do=' + todo1 + '&id=' + salaire_id);
                } else {
                    $(".output").html(data.message);
                }

            }, dataType: 'json'
        });
    });

    $("#bloc_view_main").on('click', '#btn_valider_decompte', function (e) {
        e.preventDefault();
        var salaire_id = '';
        var donnees = $(".resiliation_frm").serialize();
        var pg = 'admin';
        var view = 'ressalaire';
        var todo = 'addecompte';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    salaire_id = data.salaire_id;
                    var view1 = 'impression';
                    var todo1 = 'bulletin';
                    $(".output").html('');
                    $(".nbre").val(0);
                    $("#bloc_emprubrique").html('');
                    //Maj liste employe
                    var urlemployepaie = './main.php?pg=admin&view=ressalaire&do=lstemplpaie';
                    $.ajax({
                        url: urlemployepaie,
                        type: method,
                        success: function (data) {
                            $('#employe_bloc').empty().html(data);
                            selectjs();
                        }
                    });
                    //Maj liste motif
                    var urlstmotif = './main.php?pg=admin&view=ressalaire&do=lstmotif';
                    $.ajax({
                        url: urlstmotif,
                        type: method,
                        success: function (data) {
                            $('#lstmotif_bloc').empty().html(data);
                            selectjs();
                        }
                    });
                    window.open('./main.php?pg=admin&view=impression&do=resiliation&id=' + salaire_id);
                } else {
                    $(".output").html(data.message);
                }

            }, dataType: 'json'
        });
    });

    //Facturation
    $("#bloc_view_main").on('click', '.radioclient', function (e) {
        var client = $(this).val()
        if (client == 'particulier') {
            $("#lbnoms").text('Noms');
            $(".societe").addClass('hidden');
            $("#designation").val(' ');
        } else {
            $("#lbnoms").text('Personne à contacter');
            $(".societe").removeClass('hidden');
        }
    });
    $("#bloc_view_main").on('change', '.typeclient', function (e) {
        var client = $(this).val()
        if (client == 'ancien') {
            $(".ancien").removeClass('hidden');
            $(".nouveau").addClass('hidden');
            $("#sorteclient").val('ancien');
        } else {
            $(".ancien").addClass('hidden');
            $(".nouveau").removeClass('hidden');
            $("#sorteclient").val('nouveau');
        }
    });
    $("#bloc_view_main").on('change', '#cmbtype_client', function (e) {
        var client = $(this).val()
        if (client == 'societe') {
            $(".nomsociete").removeClass('hidden');
            $("#lblnomclient").text('Personne à contacter');
        } else {
            $(".nomsociete").addClass('hidden');
            $("#lblnomclient").text('Noms');
        }
    });
    $("#bloc_view_main").on('change', '#categorie_fact', function (e) {
        //        e.preventDefault();
        var famille_id = $(this).val()
        var service = $('#categorie_fact option:selected').attr('service');
        $("#fam_id").val(famille_id);
        if (service == '1') {
            $(".service").addClass('hidden');
        } else {
            $(".service").removeClass('hidden');
        }
    });
    //VALIDER MODAL CLIENT
    $("#bloc_view_main").on('click', '#btn_vld_mod_client', function (e) {
        e.preventDefault();
        var id_client = $("#cmbclient").val();
        var sorteclient = $("#sorteclient").val();
        if (sorteclient == 'ancien') {
            var nom = $('#cmbclient option:selected').attr('nom');
            var adresse = $('#cmbclient option:selected').attr('adresse');
            var email = $('#cmbclient option:selected').attr('email');
            var tel = $('#cmbclient option:selected').attr('tel');
            var societe = $('#cmbclient option:selected').attr('societe');
            var pers = $('#cmbclient option:selected').attr('pers');
            var accountnumberaff = $('#cmbclient option:selected').attr('sfxcpt');
            $("#id_client").val(id_client);
            $("#compte2").val(accountnumberaff);
            $("#customer").val(nom);

            $("#nomsct").text(nom);
            $("#adrcl").text(adresse);
            $("#emailcl").text(email);
            $("#telcl").text(tel);
            $("#nomcl").text(nom);
            $("#nomclsct").text(societe);

            $("#nomscte").val(" ");
            $("#nomclt").val(" ");
            $("#tel").val(" ");
            $("#eml").val(" ");
            $("#adr").val(" ");
            $("#sexeclt").val(" ");
            if (pers == '1') {
                $("#bck_esp").addClass('hidden');
                $(".nomsct").removeClass('hidden');
                $(".nomclpers").addClass('hidden');
            } else {
                $("#bck_esp").removeClass('hidden');
                $(".nomsct").addClass('hidden');
                $(".nomclpers").removeClass('hidden');
            }
        } else {
            var nom = $('#nom_client').val();
            var adresse = $('#adresse_provenance_client').val();
            var email = $('#email_client').val();
            var tel = $('#telephone_client').val();
            var societe = $('#designation').val();
            var sexe = $('#sexe_client').val();
            var pers = $('#cmbtype_client').val();
            var accountnumberaff = $('.accountnumberaff').val();
            $("#id_client").val('0');
            $("#nomcl").text(nom);
            $("#adrcl").text(adresse);
            $("#emailcl").text(email);
            $("#telcl").text(tel);
            $("#nomsct").text(societe);
            $("#nomclsct").text(nom);
            if (pers == 'societe') {
                $("#nomscte").val(societe);
                $("#nomclt").val(nom);
                $("#bck_esp").addClass('hidden');
                $(".nomsct").removeClass('hidden');
                $(".nomclpers").addClass('hidden');
            } else {
                $("#nomscte").val(nom);
                //                $("#nomclt").val(nom);
                $("#bck_esp").removeClass('hidden');
                $(".nomsct").addClass('hidden');
                $(".nomclpers").removeClass('hidden');
            }

            $("#tel").val(tel);
            $("#eml").val(email);
            $("#adr").val(adresse);
            $("#sexeclt").val(sexe);
            $("#compte2").val(accountnumberaff);

        }
        $("#modalclient").modal('hide');
    });

    $("#bloc_view_main").on('click', '#btn_vld_categorie', function (e) {
        e.preventDefault();
        var famille = $("#famille").val();
        //       alert(famille);
        var pg = 'admin';
        var view = 'stk_famille';
        var todo = 'addprofact';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&famille=' + famille;
        $.ajax({
            url: url,
            type: method,
            success: function (data) {
                //                alert(data);
                if (data.s) {
                    var todo1 = 'mjrcat';
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo1;
                    var donnees = " ";
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //                            alert(data);
                            $("#divcat").empty().html(data);
                            selectjs();
                            //                            $("#modaldepot").modal('hide');
                        }
                    });

                    //                   $("#dte_echsp").text(data.message);
                    //                   $("#dte_ech").val(data.message);
                    //                   $("#modalcondpaiement").modal('hide');
                }
            }, dataType: 'json'
        });
    });

    //VALIDER MODAL DATE EDITION
    $("#bloc_view_main").on('click', '#btn_vld_dtEdition', function (e) {
        e.preventDefault();
        var dteedition = $('#dteedition').val();
        $("#dte_edtsp").text(dteedition);
        $("#dte_edit").val(dteedition);
        $("#modaldteedition").modal('hide');
    });

    //VALIDER MODAL DATE ECHEANCE
    $("#bloc_view_main").on('click', '#btn_vld_dtEcheance', function (e) {
        e.preventDefault();
        var dteecheance = $('#dteecheance').val();
        $("#dte_echsp").text(dteecheance);
        $("#dte_ech").val(dteecheance);
        $("#modaldteecheance").modal('hide');
    });

    //VALIDER MODAL MODE PAIEMENT
    $("#bloc_view_main").on('click', '#btn_vld_modepaie', function (e) {
        e.preventDefault();
        var mode = $('#slctmodepaie option:selected').attr('libmode');
        var modetext;
        if (mode == 'Credit') {
            modetext = 'Acompte';
        } else if (mode == 'Don') {
            modetext = 'Crédit';
        } else {
            modetext = 'Cash';
        }
        $("#mode_paie").text(modetext);
        $("#modepaiement").val(mode);
        $("#modalmode").modal('hide');
    });

    //VALIDER MODAL CONDITION PAIE
    $("#bloc_view_main").on('click', '#btn_vld_condpaie', function (e) {
        e.preventDefault();
        var dte_edition = $("#dte_edit").val();
        var nbjr = $('#slctcondpaie option:selected').attr('nbrjr');
        var des = $('#slctcondpaie option:selected').text();
        $("#condpaiesp").text(des);
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'verifcond';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&nbrjr=' + nbjr + '&dte_edition=' + dte_edition;
        $.ajax({
            url: url,
            type: method,
            success: function (data) {
                if (data.s) {
                    $("#dte_echsp").text(data.message);
                    $("#dte_ech").val(data.message);
                    $("#modalcondpaiement").modal('hide');
                }
            }, dataType: 'json'
        });
    });
    // Ajouter les produits aux paniers
    $("#bloc_view_main").on('click', '#add_prod', function (e) {
        e.preventDefault();
        //var source_id = $("#source_id").val();
        var selected = $("#produit_id option:selected");
        var produit_id = selected.val();
        var des = selected.text();
        var prix = selected.attr('prix');
        var tva = selected.attr('tva');
        var qte = $("#qte").val();
        //var unite = $("#unite").val();
        //var op = $("#op").val();
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'addpan';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo
            + '&idprod=' + produit_id + '&qte=' + qte + '&nameprod=' + des + '&prix=' + prix
            + '&tva=' + tva;
        var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majlistprodstk';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //                if(data.s){
                $(".bloc_alert").addClass('hidden');
                $(".msg_alert").text('');
                $("#spht").text(data.htf);
                $("#sptva").text(data.tvaf);
                $("#spttc").text(data.ttcf);
                $("#ht").val(data.ht);
                $("#tva").val(data.tva);
                $("#totmontprodtva").val(data.totprodtva);
                $("#ttc").val(data.ttc);
                $.ajax({
                    url: url2,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $("#lignefact").empty().html(data);
                        //                            $("#modaldepot").modal('hide');
                    }
                });
                //                }else{
                $(".bloc_alert").removeClass('hidden');
                $(".msg_alert").text(data.message);
            }
            //                $("#fiche_tranfert").empty().html(data);
            //                $("#modaldepot").modal('hide');
            //            }
            , dataType: 'json'
        });

    });
    // Supprimer un produit au panier
    $("#bloc_view_main").on('click', '#lignefact .ch_prod', function (e) {
        //Suppimer des produits dans le panier
        var donnees = '';
        var produit_id = $(this).attr('id');
        //var op=$(this).attr('op');
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'supprodpan';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idprod=' + produit_id;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#lignefact").empty().html(data);
                var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majtot';
                $.ajax({
                    url: url2,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $("#spht").text(data.htf);
                        $("#sptva").text(data.tvaf);
                        $("#spttc").text(data.ttcf);
                        $("#ht").val(data.ht);
                        $("#tva").val(data.tva);
                        $("#ttc").val(data.ttc);
                    }, dataType: 'json'
                });
            }
        });
        return false;
    });
    // Bouton enregistrer facture
    $("#bloc_view_main").on('click', '#btn_enreg_fact', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'enregfact';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //         alert(data);
                if (data.s) {
                    $('#btn_enreg_fact').addClass('hidden');
                    $('#div_notification_fact').show().fadeOut(8000);
                    $('#btn_payer_fact').removeClass('hidden');
                    $('#btn_send_fact').removeClass('hidden');
                    $('#btn_print_facturef').removeClass('hidden');
                    $('#sp_notification_fact').text(data.message);
                    $("#btn_print_facturef").attr("idf", data.facture_id);
                    $("#btn_payer_fact").attr("idfact", data.facture_id);

                    $("#btn_print_facturef").attr("modepaie", data.mode_paie);
                    $("#btn_payer_fact").attr("modepaie", data.mode_paie);

                    $('#facture_id').val(data.facture_id);
                    // $('.ch_prod').prop('disabled',true);
                    //$('#btnaddarticle').prop('disabled',true);
                } else {
                    $('#div_notification_facterror1').show().fadeOut(8000);
                    $('#sp_notification_facterror1').text(data.message);

                    //                       $('#sp_notification_facterror').text(data.message);
                    //                       $('#div_notification_facterror').show().fadeOut(4000);
                }
            }, dataType: 'json'
        });
        return false;

    });

    $("#bloc_view_main").on('click', '.btn_recurente', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'recurente';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    var f = 1;
                    var url1 = './index.php?pg=admin&view=t_facture&do=recurenteaff&f=' + f;
                    location.href = url1;
                }
            }, dataType: 'json'
        });
        return false;

    });

    // Bouton envoyer facture
    $("#bloc_view_main").on('click', '#btn_send_fact', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var id_fact = $('#facture_id').val();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'sendmail2';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id_fact;

        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //                   alert(data.message);
                if (data.s) {
                    $('#div_notification_fact').show().fadeOut(8000);
                    $('#sp_notification_fact').text(data.message);
                } else {
                    $('#div_notification_facterror1').show().fadeOut(8000);
                    $('#sp_notification_facterror1').text(data.message);
                }
            }, dataType: 'json'
        });

        return false;

    });
    //Modificarion quantite produit panier
    $("#bloc_view_main").on('mouseout', '.qte', function (e) {
        e.preventDefault();
        var produit_id = $(this).attr('id');
        var qte = $(this).val();
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'modifqte';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idprod=' + produit_id + '&qte=' + qte;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#lignefact").empty().html(data);
                var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majtot';
                $.ajax({
                    url: url2,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $("#spht").text(data.htf);
                        $("#sptva").text(data.tvaf);
                        $("#spttc").text(data.ttcf);
                        $("#ht").val(data.ht);
                        $("#tva").val(data.tva);
                        $("#ttc").val(data.ttc);
                    }, dataType: 'json'
                });
            }
        });
        return false;

    });
    //Modificarion prix produit panier
    $("#bloc_view_main").on('mouseout', '.prix', function (e) {
        e.preventDefault();
        var produit_id = $(this).attr('id');
        var prix = $(this).val();
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'modifprix';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idprod=' + produit_id + '&prix=' + prix;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#lignefact").empty().html(data);
                var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majtot';
                $.ajax({
                    url: url2,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $("#spht").text(data.htf);
                        $("#sptva").text(data.tvaf);
                        $("#spttc").text(data.ttcf);
                        $("#ht").val(data.ht);
                        $("#tva").val(data.tva);
                        $("#ttc").val(data.ttc);
                    }, dataType: 'json'
                });
            }
        });
        return false;

    });
    //Modificarion lib produit panier
    $("#bloc_view_main").on('mouseout', '.lib', function (e) {
        e.preventDefault();
        var produit_id = $(this).attr('id');
        var lib = $(this).val();
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'modiflib';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idprod=' + produit_id + '&lib=' + lib;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#lignefact").empty().html(data);
                var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majtot';
                $.ajax({
                    url: url2,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $("#spht").text(data.htf);
                        $("#sptva").text(data.tvaf);
                        $("#spttc").text(data.ttcf);
                        $("#ht").val(data.ht);
                        $("#tva").val(data.tva);
                        $("#ttc").val(data.ttc);
                    }, dataType: 'json'
                });
            }
        });
        return false;

    });
    //Modificarion remise facture
    $("#bloc_view_main").on('mouseout', '#remise_mont', function (e) {
        e.preventDefault();
        var remise_mont = $(this).val();
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'majremise';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&remise_mont=' + remise_mont;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#spht").text(data.htf);
                $("#sptva").text(data.tvaf);
                $("#spttc").text(data.ttcf);
                $("#spremise1").text(data.remise_pour);
                $("#ht").val(data.ht);
                $("#tva").val(data.tva);
                $("#ttc").val(data.ttc);
                $("#remise_pour").val(data.remise_pour);
                $("#remise_mont2").val(data.remise_mont);

            }, dataType: 'json'
        });
        return false;
    });
    //Exonerer TVA
    $("#bloc_view_main").on('click', '#btnexoneretva', function (e) {
        e.preventDefault();
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'exonerertva';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#lignefact").empty().html(data);
                var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majtot';
                $.ajax({
                    url: url2,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $("#spht").text(data.htf);
                        $("#sptva").text(data.tvaf);
                        $("#spttc").text(data.ttcf);
                        $("#ht").val(data.ht);
                        $("#tva").val(data.tva);
                        $("#ttc").val(data.ttc);
                        $("#btnexoneretva").addClass('hidden');
                        $("#btnappliktva").removeClass('hidden');
                    }, dataType: 'json'
                });
            }
        });
        return false;

    });
    $("#bloc_view_main").on('click', '#btnappliktva', function (e) {
        e.preventDefault();
        var donnees = '';
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'appliktva';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#lignefact").empty().html(data);
                var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majtot';
                $.ajax({
                    url: url2,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $("#spht").text(data.htf);
                        $("#sptva").text(data.tvaf);
                        $("#spttc").text(data.ttcf);
                        $("#ht").val(data.ht);
                        $("#tva").val(data.tva);
                        $("#ttc").val(data.ttc);
                        $("#btnappliktva").addClass('hidden');
                        $("#btnexoneretva").removeClass('hidden');
                    }, dataType: 'json'
                });
            }
        });
        return false;

    });
    //Imprimer facture facturation
    $("#bloc_view_main").on('click', '#btn_print_facturef', function (e) {
        e.preventDefault();
        var id = $(this).attr("idf");
        var modepaie = $(this).attr("modepaie");
        url1 = './main.php?pg=admin&view=impression&do=facture_fact&id=' + id + '&modepaie=' + modepaie;
        window.open(url1);
    });
    $("#bloc_view_main").on('click', '#btn_payer_fact', function (e) {
        e.preventDefault();
        var id = $(this).attr("idfact");
        var modepaie = $(this).attr("modepaie");
        //        var modepaie = $("#modepaiement").val();
        url1 = './index.php?pg=admin&view=paiement&do=add&id_fact=' + id + '&modepaie=' + modepaie;
        location.href = url1;
    });

    //Filtrage liste facture
    $("#bloc_view_main").on('click', '#btnfiltrerfacture', function (e) {
        e.preventDefault();
        var donnees = $("#frmfiltrerpaie").serialize();
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'allbydte';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#lignetab").empty().html(data);
                $("#spdebut").text($("#datedebut").val());
                $("#spfin").text($("#datefin").val());
            }
        });

        var pg1 = 'admin';
        var view1 = 't_facture';
        var todo1 = 'allbydte1';
        var method1 = 'POST';
        var url1 = './main.php?pg=' + pg1 + '&view=' + view1 + '&do=' + todo1;
        $.ajax({
            url: url1,
            type: method1,
            data: donnees,
            success: function (data) {
                $("#lignetab1").empty().html(data);
            }
        });

        var pg2 = 'admin';
        var view2 = 't_facture';
        var todo2 = 'allbydte2';
        var method2 = 'POST';
        var url2 = './main.php?pg=' + pg2 + '&view=' + view2 + '&do=' + todo2;
        $.ajax({
            url: url2,
            type: method2,
            data: donnees,
            success: function (data) {
                $("#lignetab2").empty().html(data);
            }
        });

        var pg3 = 'admin';
        var view3 = 't_facture';
        var todo3 = 'allbydte3';
        var method3 = 'POST';
        var url3 = './main.php?pg=' + pg3 + '&view=' + view3 + '&do=' + todo3;
        $.ajax({
            url: url3,
            type: method3,
            data: donnees,
            success: function (data) {
                $("#lignetabrec").empty().html(data);
            }
        });

        var pg4 = 'admin';
        var view4 = 't_facture';
        var todo4 = 'allbydte4';
        var method4 = 'POST';
        var url4 = './main.php?pg=' + pg4 + '&view=' + view4 + '&do=' + todo4;
        $.ajax({
            url: url4,
            type: method4,
            data: donnees,
            success: function (data) {
                $("#lignetabpro").empty().html(data);
            }
        });

        var pg5 = 'admin';
        var view5 = 't_facture';
        var todo5 = 'allbydte4';
        var method5 = 'POST';
        var url5 = './main.php?pg=' + pg5 + '&view=' + view5 + '&do=' + todo5;
        $.ajax({
            url: url5,
            type: method5,
            data: donnees,
            success: function (data) {
                $("#lignetaball").empty().html(data);
            }
        });

        return false;
    });

    $("#bloc_view_main").on('click', '#btn_vld_famille', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'paiement';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //                alert(data);
                //                if (data.s) {
                //                    $('#montantcdf').val(0);
                //                    $('#montantusd').val(0);
                //                    $('#ttc').val('');
                //                    $('#ttc1').val('');
                //                    $('#affnomclient').val('');
                //                    $('.output').html(data.message).show().fadeOut(4000);
                //                    var pg1 = 'admin';
                //                    var view1 = 'impression';
                //                    var todo1 = 'facturation_recu';
                //                    var url1 = './main.php?pg=' + pg1 + '&view=' + view1 + '&do=' + todo1;
                //                    //Mise a jours 
                //                    $.ajax({
                //                        url: './main.php?pg=admin&view=paiement&do=filtrerfactures',
                //                        success: function (data) {
                //                            // alert(data);
                //                            $("#maj_chx_facture").empty().append(data);
                //                            $(".choz").chosen({
                //                                disable_search: false,
                //                                no_results_text: "No Search Results!",
                //                                width: "100%",
                //                            });
                //                        }
                //                    });
                //                    //fin mise a jours
                //                    window.open(url1);
                //                    // fin impression
                //                    view ='t_facture';
                //                    todo = 'viewall';
                //                    var f=1;
                //                    var urllord = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&f=' + f;
                //                    location.href = urllord;
                //                    
                //                }
                //                else {
                //                    $('.output').html(data.message).show().fadeOut(4000);
                //                }
            }, dataType: 'json'

        });
    });

    //KING paiement
    $("#bloc_view_main").on('click', '.btnfpaiement', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'paiement';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                if (data.s) {
                    $('#montantcdf').val(0);
                    $('#montantusd').val(0);
                    $('#ttc').val('');
                    $('#ttc1').val('');
                    $('#affnomclient').val('');
                    $('.output').html(data.message).show().fadeOut(4000);
                    var pg1 = 'admin';
                    var view1 = 'impression';
                    var todo1 = 'facturation_recu';
                    var url1 = './main.php?pg=' + pg1 + '&view=' + view1 + '&do=' + todo1;
                    //Mise a jours 
                    $.ajax({
                        url: './main.php?pg=admin&view=paiement&do=filtrerfactures',
                        success: function (data) {
                            // alert(data);
                            $("#maj_chx_facture").empty().append(data);
                            $(".choz").chosen({
                                disable_search: false,
                                no_results_text: "No Search Results!",
                                width: "100%",
                            });
                        }
                    });
                    //fin mise a jours
                    window.open(url1);
                    // fin impression
                    if (data.paie == 'solde') {
                        view = 't_facture';
                        todo = 'viewall';
                        var f = 1;
                        var urllord = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&f=' + f;
                        location.href = urllord;
                    } else {
                        view = 'paiement';
                        todo = 'add';
                        var f = 1;
                        var urllord = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id_fact=' + data.id_fact;
                        location.href = urllord;
                    }

                }
                else {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
            }, dataType: 'json'

        });
    });

    $("#bloc_view_main").on('click', '#btnfiltrerpaie', function (e) {
        // alert('ok');
        e.preventDefault();
        var donnees = $('#frmfiltrerpaie').serialize();
        var pg = 'admin';
        var view = 'paiement';
        var todo = 'verifdates';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var datedebut = $('#datedebut').val();
        var datefin = $('#datefin').val();
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  alert(data.s);
                if (data.s) {
                    todo = 'filtrerpaie';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //mise a jour
                            $('#majdataspaie').empty().append(data);
                            $('.titrepg').empty().append('Liste de paiement du ' + datedebut + ' au ' + datefin);
                            todo = 'filtrerpaie1';
                            url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                            $.ajax({
                                url: url,
                                type: method,
                                data: donnees,
                                success: function (data) {
                                    //mise a jour
                                    $('#majdataspaie1').empty().append(data);
                                    //fin mise a jour
                                }

                            });
                            //fin mise a jour

                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#btnfiltrerdetails', function (e) {
        // alert('ok');
        e.preventDefault();
        var donnees = $('#frmfiltrerdetails').serialize();
        var pg = 'admin';
        var view = 'paiement';
        var todo = 'verifdates';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var datedebut = $('#datedebut').val();
        var datefin = $('#datefin').val();
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    todo = 'detailsventef';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&filtrer=ok';
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //    alert(data)
                            //mise a jour
                            $('#majdetailsvente').empty().append(data);
                            $('.titredv').empty().append('Détails Vente du ' + datedebut + ' au ' + datefin);
                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#btnfiltrerextrtva', function (e) {
        // alert('ok');
        e.preventDefault();
        var donnees = $('#frmfiltrertva').serialize();
        var pg = 'admin';
        var view = 'paiement';
        var todo = 'verifdates';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var datedebut = $('#datedebut').val();
        var datefin = $('#datefin').val();
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //  alert(data.s);
                if (data.s) {
                    todo = 'filtrerextraittva';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //mise a jour
                            $('#majdatastva').empty().append(data);
                            $('.titrepg').empty().append('Extrait TVA du ' + datedebut + ' au ' + datefin);
                            todo = 'filtrerextraittva1';
                            url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                            $.ajax({
                                url: url,
                                type: method,
                                data: donnees,
                                success: function (data) {
                                    //mise a jour
                                    $('#majdatastva1').empty().append(data);

                                    //fin mise a jour

                                }

                            });
                            //fin mise a jour

                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('change', '.chx_mode', function (e) {
        e.preventDefault();
        var libmode = $('.chx_mode option:selected').attr('libmode');
        $("#libelle_mode").val(libmode);
        $("#montantusd").val(0);
        $("#montantcdf").val(0);
        if (libmode == 'Don') {
            $(".montantpaie").hide();
            $(".justif").show();
        } else {
            $(".montantpaie").show();
            $(".justif").hide();

        }
        return false;
    });
    $("#bloc_view_main").on('click', '.btn_prnt_client', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_client';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });
    $("#bloc_view_main").on('change', '.modepaiement', function (e) {
        e.preventDefault();

        var m = $(this).val();
        $("#btn_payer_fact").attr("modepaie", m);
        //alert(m);
        //        var libmode = $('#modepaiement option:selected').attr('libmode');
        //        $("#libelle_mode").val(libmode);
        //        $("#montantusd").val(0);
        //        $("#montantcdf").val(0);
        //        if (libmode == 'Don') {
        //            $(".montantpaie").hide();
        //            $(".justif").show();
        //        } else {
        //            $(".montantpaie").show();
        //            $(".justif").hide();
        //
        //        }
        //        return false;
    });


    $("#bloc_view_main").on('change', '.chx_facture', function (e) {
        e.preventDefault();
        var id_fact = $('.chx_facture option:selected').attr('value');
        $("#id_fact").val(id_fact);
        var num_fact = $('.chx_facture option:selected').attr('nfac');
        $("#num_fact").val(num_fact);
        var idclient = $('.chx_facture option:selected').attr('idclientopt');
        $("#idclient").val(idclient);
        var nomclient = $('.chx_facture option:selected').attr('nomclientopt');
        $("#affnomclient").val(nomclient);
        $("#nomclient").val(nomclient);
        var montanttotal = $('.chx_facture option:selected').attr('montanttotal');
        $("#ht").val(montanttotal);
        var montttcremise = $('.chx_facture option:selected').attr('montttcremise');
        $("#ttc").val(montttcremise);
        var montttcremise1 = $('.chx_facture option:selected').attr('montttcremise1');
        $("#montant").val(montttcremise1);
        $("#ttc1").val(montttcremise1);
        var montanttot = $('.chx_facture option:selected').attr('montanttot');
        $("#montant_tot").val(montanttot);

        var tva = $('.chx_facture option:selected').attr('tvaopt');
        $("#tva").val(tva);
        return false;
    });

    $("#bloc_view_main").on('click', '.btn_prnt_fpaiement', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_fpaiement';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_prnt_client', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_client';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.btn_prnt_fextrtva', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_fextrtva';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });
    $("#bloc_view_main").on('click', '.tabfact', function (e) {
        e.preventDefault();
        var fact_mode = $(this).attr("id");
        $("#modef").val(fact_mode);
    });
    $("#bloc_view_main").on('click', '#impressionliste_fact', function (e) {
        e.preventDefault();
        var modef = $("#modef").val();
        alert(modef);
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_listfact';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&mode=' + modef;
        window.open(url);

    });

    $("#bloc_view_main").on('click', '#btnfact_recurente', function (e) {
        e.preventDefault();
        alert("ok");
        //        var fact_mode = $(this).attr("id");
        //        $("#modef").val(fact_mode);
    });

    $("#bloc_view_main").on('click', '.btn_pntrecu_histo', function (e) {
        e.preventDefault();
        var client = $(this).attr("client");
        var recu = $(this).attr("recu");
        var montantusd = $(this).attr("montantusd");
        var montantcdf = $(this).attr("montantcdf");
        var dte = $(this).attr("dte");
        var numfact = $(this).attr("numfact");
        var factureid = $(this).attr("factureid");
        var mode = $(this).attr("mode");
        var donnees = '';
        var pg = 'admin';
        var view = 'paiement';
        var todo = 'miseensessionrecu';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&client=' + client + '&recu=' + recu + '&montantusd=' + montantusd + '&montantcdf=' + montantcdf + '&dte=' + dte + '&mode=' + mode + '&numfact=' + numfact + '&factureid=' + factureid;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                pg1 = 'admin';
                view1 = 'impression';
                todo1 = 'facturation_recu';
                url1 = './main.php?pg=' + pg1 + '&view=' + view1 + '&do=' + todo1;
                window.open(url1);

            }

        });
    });

    $("#bloc_view_main").on('click', '#btnextraitcompte', function (e) {
        // alert('ok');
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'paiement';
        var todo = 'check';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    todo = 'viewdatas';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#datasextraitcompte').empty().append(data);
                        }

                    });

                }
                else {
                    $('.output').html(data.message).show().fadeOut(4000);
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '.btn_prnt_extrcompte', function (e) {
        e.preventDefault();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_extrcompte';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        window.open(url);

    });

    //Configuration 
    $("#bloc_view_main").on('click', '.btnconfigfactrtn', function (e) {
        CKEDITOR.instances.editor1.updateElement();
        CKEDITOR.instances.editor2.updateElement();
    });

    $("#bloc_view_main").on('click', '#recurente', function (e) {
        //         var id = $(this).val()
        var coche = 1;
        if ($(this).is(":checked")) {
            coche = 1;
            $("#divnbrjr").removeClass('hidden');
            $("#fact_recurente").val(coche);
        } else {
            coche = 0;
            $("#divnbrjr").addClass('hidden');
            $("#fact_recurente").val(coche);
        }

    });
    $("#bloc_view_main").on('click', '.InputGenAccount', function (e) {
        e.preventDefault();
        var donnees = '';
        var method = 'POST';
        var url = './main.php?pg=admin&view=t_facture&do=ProcGenAccount';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //enlever les espaces sous javascript
                data = data.replace(/\s/g, '');
                $('.accountnumberaff').val(data);

            }
        });
        return false;
    });

    $("#bloc_view_main").on('change', '#monnaie_paie', function (e) {
        e.preventDefault();
        var monnaie_paie = $('#monnaie_paie option:selected').attr('value');
        if (monnaie_paie == 'USD') {
            $("#montantcdf").val(0);
            $(".cdf").hide();
            $(".usd").show();
        } else {
            $("#montantusd").val(0);
            $(".usd").hide();
            $(".cdf").show();

        }
        return false;
    });

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
function effacer() {
    $(':input', '.form_paie').not(':button,:submit,:reset,:hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
}