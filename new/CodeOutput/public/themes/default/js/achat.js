$(document).ajaxStart(function () {
    Pace.restart();
});
//NOTIFICATION JS
$(function () {
    $.miniNotification = function (e, t) {
        var n, r, i, s, o, u, a = this;
        this.defaults = {position: "top", show: true, effect: "slide", opacity: .95, time: 4e3, showSpeed: 600, hideSpeed: 450, showEasing: "", hideEasing: "", innerDivClass: "inner", closeButton: false, closeButtonText: "close", closeButtonClass: "close", hideOnClick: true, onLoad: function () {
            }, onVisible: function () {
            }, onHide: function () {
            }, onHidden: function () {
            }};
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
            e = {opacity: a.getSetting("opacity")};
            if (a.getSetting("position") === "bottom") {
                e["bottom"] = 0
            } else {
                e["top"] = 0
            }
            return e
        };
        u = function () {
            a.$elementInner = $("<div />", {"class": a.getSetting("innerDivClass")});
            return a.$element.wrapInner(a.$elementInner)
        };
        n = function () {
            var e;
            e = $("<a />", {"class": a.getSetting("closeButtonClass"), html: a.getSetting("closeButtonText")});
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
                this.$element.css(r()).css({display: "inline"});
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
    $('.heze-notify').miniNotification({closeButton: true, closeButtonText: '<i class="fa fa-times"></i>'});
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
        $('#dataConfirmModal').modal({show: true});
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
$(document).ready(function ()
{
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
   $("#bloc_view_main").on('click','.btnemployeeligble', function (e) {
    e.preventDefault();
    //alert('ok');
     var donnees ='';
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
    
   
    $("#bloc_view_main").on('click','#btn_suppprodcom', function (e){
            e.preventDefault();
            var id_fact=$('#id_fact').val();
            var idlig=0;
            $('.prodids:checked').each(function(i){
                idlig = $(this).val();
                var pg='admin';
                var view ='t_facture';
                var todo = 'delprodcom';
                var method = 'POST';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo+'&idlig='+idlig+'&id_fact='+id_fact;
                $.ajax({
                    url: url,
                    type: method,
                    success: function (data) {
                    }
                });
            });
             var pg='admin';
                var view ='t_facture';
                var todo = 'delprodcomajx';
                var method = 'POST';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo+'&idlig='+idlig+'&id_fact='+id_fact;
                $.ajax({
                    url: url,
                    type: method,
                    success: function (data) {
                      $('#tableau_cmd').empty().append(data);
                    }
                });
            return false;
    });

    $('#hezecomform').on('submit', function (e)
    {
        e.preventDefault();
        $('#msgButton').attr('disabled', '');
        $(".output").html('<div><i class="fa fa-spinner fa-spin fa-2x"></i> Processing...</div>');
        $(this).ajaxSubmit({
            target: '.output',
            success: afterSuccess
        });
    });
});
function afterSuccess()
{
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
    $(".datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
});
/*CUSTUM CODES*/
$(document).ready(function ()
{
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
        $('#dte_in').val(dte_in);
        $('#horaire_id').val(horaire_id);
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
        /*alert(dte_fin+'  '+fin);*/
        //recuperation date & heure systeme
        var donnees = '';
        var date_sys = '';
        var heure_sys = '';
        var pg = 'admin';
        var view = 'respointage';
        var todo = 'validpres';
        var method = 'POST';
        $.ajax({
            url: 'application/views/admin/respointage/data_date_heure_sys.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                date_sys = data.date_sys;
                heure_sys = data.heure_sys;
                var donnees = $('#formfltrvld').serialize();
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&horaire_id=' + horaire_id + '&dte_in=' + dte_in + '&dbt=' + dbt + '&fin=' + fin;
//                 alert(date_sys+'  '+heure_sys);
                if (dte_fin < date_sys) {
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('.output').html('<div class="alert alert-danger">Validation effectuée avec succes</div>').show().fadeOut(8000);
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

    //Autres impressions
    
       $("#add_prod").click(function (e) {
            e.preventDefault();
            var selected = $("#produit_id option:selected");
            var produit_id= selected.val();
            var designation= selected.text();
            var qte_dispo = $("#qte_dispo").val();
            var prix_unit = $("#prix_unit").val();
            var unite = $("#unite").val();
            var pg = 'admin';
            var view = 't_facture';
            var todo = 'cmdprod';
            var action ='ajouter';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&action=' + action;
            $.ajax({
                url: url,
                async: true,
                type: 'POST',
                data: "produit_id=" + produit_id + "&designation=" + designation+ "&qte_dispo=" + qte_dispo + "&prix_unit=" + prix_unit+ "&unite=" + unite,
                global: false,
                cache: false,
                success: function (data) { 
                if (data.s) {
                todo="majtabprodcmd";
                url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        async: true,
                        type: 'POST',
                        success: function (data) {
                     $("#produit_list").empty().html(data);
                        }
                    });            
                    $("#qte_dispo").val('');
                    $("#prix_unit").val('');
                }
                else {
                    $('.output_add_prod').html(data.message).show();
                }
                }, dataType: 'json'
            });

        });
        $("#btn_supp").click(function (e) {
            e.preventDefault();
            var pg = 'admin';
            var view = 't_facture';
            var todo = 'supprimerprev';
            //preparation suppression
              $('.ch_prod:checked').each(function(){
                var idart=$(this).val();
                var donnees ='';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&idart=' + idart;
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: donnees,
                    success: function (data) {
                           todo="cmdprod";
                            action ='supprimer';
                            url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&action=' + action;
                                $.ajax({
                                    url: url,
                                    async: true,
                                    type: 'POST',
                                    data: donnees,
                                    global: false,
                                    cache: false,
                                    success: function (data) {
                                todo="majtabprodcmd";
                                url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                                    $.ajax({
                                        url: url,
                                        async: true,
                                        type: 'POST',
                                        success: function (data) {
                                     $("#produit_list").empty().html(data);
                                        }
                                    }); 
                                    }, dataType: 'json'
                                });

                    }
                });
              });
         
       return false;

        });
        
        $("#produit_list").on('keyup', '.qte', function () {
//            alert("oook");
            var produit_id= $(this).attr('id');
            var qte = $(this).val();
            var pg = 'admin';
            var view = 't_facture';
            var todo = 'cmdprod';
            var action ='modifier';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&action=' + action;
    ////            alert(ingred_id);liv_produit
            $.ajax({
                url: url,
                async: true,
                type: 'POST',
                data: "produit_id=" + produit_id + "&qte=" + qte,
                global: false,
                cache: false,
                success: function (data) {
                    todo="majtabprodcmd";
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                        $.ajax({
                            url: url,
                            async: true,
                            type: 'POST',
                            success: function (data) {
                         $("#produit_list").empty().html(data);
                            }
                        });
                }
            });
            return false;
        });
        
        $("#boncommande_bloc").on('change', '#boncommande_id', function () {
//            alert("oook");
            var boncommande_id = $("#boncommande_id").val();
    //        alert(founisseur_id);
            var donnees = '';
            var pg = 'admin';
            var view = 'ach_livraison';
            var todo = 'produits_view';
            var method = 'POST';
            var action ='ajouter';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&boncommande_id=' + boncommande_id + '&action=' + action;
            $.ajax({
                url: url,
                type: method,
                data: donnees,
                success: function (data) {
                    $('#produits_bloc').empty().html(data);
                    selectjs();
                }
            });
            return false;
        });
        
        $("#produits_bloc").on('keyup', '.qte', function () {
//            alert("oook");
            var produit_id= $(this).attr('id');
            var qte = $(this).val();
            var qte_attendue= $(this).attr('qte_a');
            var quantite_saisie = parseInt(qte);
            var quantite_liv = parseInt(qte_attendue);
//            alert(qte_attendue);
            if(quantite_saisie < 0){
//                alert("sup");
                $('#msg2').empty().append('<i class="fa fa-info-circle"></i> Veuillez saisir une quantité positive SVP!').show().fadeOut(8000);
                $(this).val(qte_attendue);
            }else if(quantite_saisie > quantite_liv){
                $('#msg2').empty().append('<i class="fa fa-info-circle"></i> La quantité saisie doit être inférieur ou égale à la quantité à livrée ').show().fadeOut(8000);
                $(this).val(qte_attendue);
            }else{
                var pg = 'admin';
                var view = 'ach_livraison';
                var todo = 'produits_view';
                var action ='quantite';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&action=' + action;
        ////            alert(ingred_id);
                $.ajax({
                    url: url,
                    async: true,
                    type: 'POST',
                    data: "produit_id=" + produit_id + "&qte=" + qte,
                    global: false,
                    cache: false,
                    success: function (data) {
                        $("#produit_list").empty().html(data);
    //                    alert(qte);
                    }
                });
                return false;
            }
            
            
        });
        
        $("#produits_bloc").on('keyup', '.observation', function () {
//            alert("oook");
            var produit_id= $(this).attr('id');
            var observation = $(this).val();
            var pg = 'admin';
            var view = 'ach_livraison';
            var todo = 'produits_view';
            var action ='observation';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&action=' + action;
    ////            alert(ingred_id);
            $.ajax({
                url: url,
                async: true,
                type: 'POST',
                data: "produit_id=" + produit_id + "&observation=" + observation,
                global: false,
                cache: false,
                success: function (data) {
                    $("#produit_list").empty().html(data);
//                    alert(observation);
                }
            });
            return false;
        });
                
        $("#liv_founisseur_id").change(onSelectChange);
        function onSelectChange() {
            var founisseur_id = $("#liv_founisseur_id").val();
            var donnees = '';
            var pg = 'admin';
            var view = 'ach_livraison';
            var todo = 'combo_numBon';
            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&founisseur_id=' + founisseur_id;
            $.ajax({
                url: url,
                type: method,
                data: donnees,
                success: function (data) {
                    $('#boncommande_bloc2').empty().html(data);
                    selectjs();
                }
            });
            return false;
        }
        
        $("#save_liv").click(function (e) {
            e.preventDefault();
//            alert("oook");
            var liv_founisseur_id = $('#liv_founisseur_id').val();
            var boncommande_id = $('#boncommande_id').val();
            var selected=$("#liv_founisseur_id option:selected");
            var fournisseur = selected.text();
            var selected1=$("#boncommande_id option:selected");
            var num_bon = selected1.text();
            var pg = 'admin';
            var view = 'ach_livraison';
            var todo = 'addliv';
//            var method = 'POST';
            var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
            $.ajax({
                url: url,
                async: true,
                type: 'POST',
                data: "liv_founisseur_id=" + liv_founisseur_id + "&boncommande_id=" + boncommande_id + "&fournisseur=" + fournisseur + "&num_bon=" + num_bon,
                global: false,
                cache: false,
                success: function (data) {
//                    alert(data);
                    if (data.s) {
                    $('.output').html(data.message).show().fadeOut(8000);
//                    effacer();
//                    $('#boncommande_id').removeAttr('selected');
//                    $('#liv_founisseur_id').removeAttr('selected');
//                    $("#produits_bloc").empty();
                    var pg = 'admin';
                    var view = 'impression';
                    var todo = 'bon_livraison';
                    var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    window.open(url);
                    
                    url = './index.php?pg=' + pg + '&view=ach_livraison&do=add';
                    location.href = url;
                }
                else {
                    $('.output').html(data.message).show();
                }
                }, dataType: 'json'
            });
        return false;

        });
        
        $("#bloc_view_main").on('click', '#btnfiltre', function (e) {
//         alert('ok');
        e.preventDefault();
        var donnees = $('#frmfiltre').serialize();
        var pg = 'admin';
        var view = 'ach_livraison';
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
                    todo = 'filtre';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //mise a jour
                            $('#dataview').empty().append(data);
                            $('.titrepg').empty().append('Liste de livraison du ' + datedebut + ' au ' + datefin);
                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    
    
    
    $("#bloc_view_main").on('click', '#btnfiltre1', function (e) {
//         alert('ok');
        e.preventDefault();
        var donnees = $('#frmfiltre').serialize();
        var pg = 'admin';
        var view = 't_facture';
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
                    todo = 'filtre';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //mise a jour
                            $('#dataview').empty().append(data);
                            $('.titrepg').empty().append('Bon de commandes du ' + datedebut + ' au ' + datefin);
                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
    
    $("#bloc_view_main").on('click', '#btnfiltre2', function (e) {
//         alert('ok');
        e.preventDefault();
        var donnees = $('#frmfiltre').serialize();
        var pg = 'admin';
        var view = 't_facture';
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
                    todo = 'filtre_besoin';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            //mise a jour
                            $('#dataview').empty().append(data);
                            $('.titrepg').empty().append('Etat de besoins du ' + datedebut + ' au ' + datefin);
                        }

                    });

                }
                else {
                    $('.output').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
        
    $("#tableau_cmd").on('mouseout', '.qte_cmd', function () {
//            alert("oook");
            var produit_id= $(this).attr('id');
            var designation = $(this).attr('des');
            var qte = $(this).val();
            if(qte==''){
                $(this).val(0);
                qte=0;
            }
            var quantite_saisie = parseInt(qte);
            var prix=$(this).attr('prix');
            var prix_unit=parseInt(prix);
//            alert(designation);
            if(quantite_saisie < 0){
                $('#msg2').empty().append('<i class="fa fa-info-circle"></i> Veuillez saisir une quantité positive SVP!').show().fadeOut(8000);
                $(this).val(quantite_saisie);
            }else{
                $('#sous_tot').text(prix_unit * quantite_saisie);
                var pg = 'admin';
                var view = 't_facture';
                var todo = 'produits_update';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                $.ajax({
                    url: url,
                    async: true,
                    type: 'POST',
                    data: "produit_id=" + produit_id + "&qte=" + quantite_saisie + "&prix=" + prix_unit + "&designation=" + designation,
                    global: false,
                    cache: false,
                    success: function (data) {
                        $("#tableau_cmd").empty().html(data);
                        $(this).focus();
                    }
                });
                return false;
            }            
        });  
        
    $("#tableau_cmd").on('mouseout', '.prix_unit', function () {
//            alert("oook");
            var produit_id= $(this).attr('id');
            var designation = $(this).attr('des');
            var qte=$(this).attr('qte');
            var quantite_saisie = parseInt(qte);
            var prix = $(this).val();
            var prix_unit=parseInt(prix);
//            alert(designation);
            if(prix_unit < 0){
                $('#msg2').empty().append('<i class="fa fa-info-circle"></i> Veuillez saisir un prix unitaire positif SVP!').show().fadeOut(8000);
                $(this).val(prix_unit);
            }else{
                $('#sous_tot').text(prix_unit * quantite_saisie);
                var pg = 'admin';
                var view = 't_facture';
                var todo = 'produits_update';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                $.ajax({
                    url: url,
                    async: true,
                    type: 'POST',
                    data: "produit_id=" + produit_id + "&qte=" + quantite_saisie + "&prix=" + prix_unit + "&designation=" + designation,
                    global: false,
                    cache: false,
                    success: function (data) {
                        $("#tableau_cmd").empty().html(data);
                    }
                });
                return false;
            }            
        }); 
        
     $("#bloc_view_main").on('change', '#produit_id', function (e) {
        e.preventDefault();
        var unite = $('#produit_id option:selected').attr('unite');
        $(".unite").val(unite);
        return false;
    });
    
    $("#bloc_view_main").on('change', '#device', function (e) {
        e.preventDefault();
        var unite = $('#device').val();
        $(".mon_af").text(unite);
        return false;
    });
    
       $("#bloc_view_main").on('click', '.btn_add_besoins', function (e) {
        e.preventDefault();
        var donnees = $('.frm_add_besoins').serialize();
        var pg = 'admin';
        var view = 't_facture';
        var todo = 'add_besoins';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var facture_id=0;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                facture_id=data.facture_id;
                pg1 = 'admin';
                view1 = 'impression';
                todo1 = 'etat_besoins';
                url1 = './main.php?pg=' + pg1 + '&view=' + view1 + '&do=' + todo1 + '&id_fact=' + facture_id;
                window.open(url1);
                todo = 'view_bon_cmd';
                url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                location.href = url;


                }
                else {
                    $('.output_add_besoins').html(data.message).show();
                }
            }, dataType: 'json'

        });
    });
     $("#bloc_view_main").on('change', '#modepaiement', function (e) {
        e.preventDefault();
        var modepaiement = $('#modepaiement option:selected').attr('value');
        pg = 'admin';
        view = 't_facture';
        todo= 'modepaiement';
        url = './main.php?pg=' + pg+ '&view=' + view+ '&do=' + todo+ '&modepaiement=' + modepaiement;
        $.ajax({
                url: url,
                async: true,
                type: 'POST',
                global: false,
                cache: false,
                success: function (data) {
                }
            });
        return false;
    });
    $("#bloc_view_main").on('click', '#btnextraitcompte', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 't_client';
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
    $("#bloc_view_main").on('click', '.btn_prnt_extrcompte', function (e){
        e.preventDefault();
        var idclient=$(".idclient").val();
        var dte1=$("#datedebut").val();
        var dte2=$("#datefin").val();
        var pg = 'admin';
        var view = 'impression';
        var todo = 'prnt_extrcompte';
        var url = './main.php?pg=' + pg +'&view=' + view +'&do='+todo+'&idclient='+idclient+'&dte1='+dte1+'&dte2='+dte2;
         window.open(url);
    });
});
   
    
$(function () {
    //Timepicker
    $('.timepicker').timepicker({'timeFormat': 'H:i:s'});
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