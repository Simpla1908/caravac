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
    //HEBERGEMENT
    $("#bloc_view_main").on('changeDate', '#dte1pl,#dte2pl', function (e) {
        var dte1 = $('#dte1pl').val();
        var dte2 = $('#dte2pl').val();
        var donnees = '';
        if (dte2 != '' || dte1 != '') {
            if (get_date($('#dte1pl').val()) >= get_date($('#dte2pl').val())) {
                alert("La deuxième date doit être supérieure à la première");
            }
            else {
                var pg = 'admin';
                var view = 't_reservation';
                var todo = 'planajx';
                var method = 'POST';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&dte1=' + dte1 + '&dte2=' + dte2;
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $('#plannngdiv').empty().append(data);
                        $(".tip").tooltip();
                    }
                });
            }
        }

    });
    $("#bloc_view_main").on('changeDate', '#date_arrive,#date_sortie', function (e) {
        //Recalcul du nombre de nuitée
        var dteres = $('#dt_edit_res').val();
        var dte1 = $('#date_arrive').val();
        var dte2 = $('#date_sortie').val();
        var donnees = '';
        if (dte2 != '' && dte1 != '') {
//            if(get_date(dte1) < get_date(dteres)){
//                alert("La date d'arrivée doit être supérieure ou égale à celle d'édition."); 
//            }else 
            if (get_date(dte1) > get_date(dte2)) {
                alert("La date d'arrivée doit être inférieure ou égale à celle de départ.");
            }
            else if (get_date(dte2) < get_date(dte1)) {
                alert("La date de départ doit être supérieure ou égale à celle d'arrivée.");
            } else if (get_date(dte2) < get_date(dteres)) {
                alert("La date de départ doit être supérieure ou égale à celle d'édition.");
            }
            else {
                var pg = 'admin';
                var view = 't_reservation';
                var todo = 'recalgfct';
                var method = 'POST';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&dte1=' + dte1 + '&dte2=' + dte2;
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $('#detailsej').empty().append(data);
                        $(".tip").tooltip();
                        var todo = 'gettotal';
                        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                        $.ajax({
                            url: url,
                            type: method,
                            data: donnees,
                            success: function (data) {
                                $('#totfacture').text(data.totfacture);
                                $('#ttc_eqvlt_aff').text(data.ttc_eqvlt_aff);
                            }, dataType: 'json'
                        });
//                    var donnees = $('#hezecomform').serialize();
//                    var urlpg ='./main.php?pg=admin&view=t_reservation&do=rendu';
//                    $.ajax({
//                        url: urlpg,
//                        type: 'POST',
//                        data: donnees,
//                        success: function (data) {
//                            if (data.succes) {
//                                $('#rendu_usd').val(data.rendu_usd);
//                                $('#rendu_cdf').val(data.rendu_cdf);
//                                //$('#totrendu').val(data.totrendu);
//                                if (data.boolrendu) {
//                                    $('.blrendu').removeClass('hidden');
//                                } else {
//                                    $('.blrendu').addClass('hidden');
//                                }
//                            }
//                        }, dataType: 'json'
//                    });
                    }
                });
            }
        }

    });
//    $("#bloc_view_main").on('changeDate', '#dt_edit_res', function (e) {
//        //Recalcul du nombre de nuitée
//        var dteres=$('#dt_edit_res').val();
//        var dte1=$('#date_arrive').val();
//        var dte2=$('#date_sortie').val();
//        if((get_date(dteres)> get_date(dte1))){
//             alert("La date d'édition doit être inférieure ou égale à la date d'arrivée.");
//        }else if((get_date(dteres)> get_date(dte2))){
//            alert("La date d'édition doit être inférieure ou égale à la datede départ."); 
//        }
//    });
    //Saisie Montant payé
    $("#bloc_view_main").on('keyup', '.montpaye', function (e) {
        var donnees = $('.frmpaie').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'montpaye';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#totpaye').text(data.totpaye);
                $('#solde').text(data.totpaye);
            }, dataType: 'json'
        });
    });
    $("#bloc_view_main").on('keyup', '.price', function (e) {
        e.preventDefault();
        var prix = $(this).val();
        var id = $(this).attr('id');
        var selecteur = '#' + 'monttot' + id;
        var mpusd = '.' + 'mpusd' + id;
        var mpcdf = '.' + 'mpcdf' + id;
        var donnees = $(".frmpaie").serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'mdpricech';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&prix=' + prix + '&id=' + id;
        var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=calctotpaye';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $(selecteur).html(data.monttot);
                $(mpusd).val(data.mpusd);
                $(mpcdf).html(data.mpcdf);
                $('#totfacture').text(data.totfacture);
                $('#totfact').text(data.totfact);
                $('#ttc_eqvlt_aff').text(data.ttc_eqvlt_aff);
//                $('#totpaye').text(data.totpaye);
//                 $('#totpayef').text(data.totpayef);
            }, dataType: 'json'
        });
        return false;
    });

    $("#bloc_view_main").on('click', '#add_service', function (e) {
        var donnees = $("#serviceform").serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'addservice';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#detailservice").empty().html(data);
                $(".tip").tooltip();
                var todo = 'gettotal';
                var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                $.ajax({
                    url: url,
                    type: method,
                    data: donnees,
                    success: function (data) {
                        $('#totfacture').text(data.totfacture);
                        $('#ttc_eqvlt_aff').text(data.ttc_eqvlt_aff);
                    }, dataType: 'json'
                });

//                var donnees = $('#hezecomform').serialize();
//                var urlpg ='./main.php?pg=admin&view=t_reservation&do=rendu';
//                $.ajax({
//                    url: urlpg,
//                    type: 'POST',
//                    data: donnees,
//                    success: function (data) {
//                        if (data.succes) {
//                            $('#rendu_usd').val(data.rendu_usd);
//                            $('#rendu_cdf').val(data.rendu_cdf);
//                            //$('#totrendu').val(data.totrendu);
//                            if (data.boolrendu) {
//                                $('.blrendu').removeClass('hidden');
//                            } else {
//                                $('.blrendu').addClass('hidden');
//                            }
//                        }
//                    }, dataType: 'json'
//                });
            }
        });
        return false;
    });
    $("#bloc_view_main").on('click', '.delch', function (e) {
        var id = $(this).attr('id');
        var donnees = '';
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'delch';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&id=' + id;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $("#detailservice").empty().html(data);
                $(".tip").tooltip();
            }
        });
        return false;
    });
    //Sauvegarder facture hebergement
    $("#bloc_view_main").on('click', '#btn_heb_save', function (e) {
        var donnees = $(".frmpaie").serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var url2 = 'index.php?pg=admin&view=module&do=heb2';
        var bool = false;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            beforeSend: function () {
                $("#btn_heb_save").addClass('hidden');
                $(".loader").removeClass('hidden');
            },
            success: function (data) {
          //  alert(data);
                if (data.s) {
                    var url1 = './main.php?pg=admin&view=impression&do2=1&do=fctheball&id='+data.facture_id + '&id2=' + data.idres_ch;
                    window.open(url1);
                    window.location.href = data.url_planning;
                } else {
                    $("#notification").show().removeClass('hidden callout-success');
                    $("#notification").addClass('callout-danger');
                    $("#notification").html(data.message).fadeOut(6000);
                }
                bool = true;
            },
            complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $("#btn_heb_save").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }
         , dataType: 'json'
        });
        return false;
    });
    //Sauvegarder paiement hebergement
    $("#bloc_view_main").on('click', '#btn_val_paieheb', function (e) {
        var donnees = $('.frmpaie').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'payerfact';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
               //alert(data);
                if (data.s) {
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=add&serv=majserv' + '&id_resch=' + data.resch_id;
                    var id = data.paie_id;
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#contenu").empty().html(data);
                            var url1 = './main.php?pg=admin&view=impression&do=recuheb&id=' + id;
                            window.open(url1);
                        }
                    });
                    var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp2' + '&id_res=' + data.id_res + '&resch_id=' + data.resch_id;
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#dv_paie").empty().html(data);
                            $("#txtpaie_eqvlt").text('')
                            selectjs();
                        }
                    });
                    $('.mdpaie').modal('hide');
                } else {
                    $("#notification7").show().removeClass('hidden callout-success');
                    $("#notification7").addClass('callout-danger');
                    $("#notification7").html(data.message).fadeOut(6000);
                }

            }
            , dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '#btn_val_paieheb2', function (e) {
        var donnees = $('.frmpaie').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'payerfact';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=detfact2&do2=maj' + '&id=' + data.id_fact;
                    var id = data.paie_id;
                    var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp2' + '&id_res=' + data.id_res + '&resch_id=' + data.resch_id;
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#dv_paie").empty().html(data);
                            $("#txtpaie_eqvlt").text('')
                            selectjs();
                        }
                    });
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#contenu").empty().html(data);
                            var url1 = './main.php?pg=admin&view=impression&do=recuheb&id=' + id;
                            window.open(url1);

                        }
                    });

                    $('.mdpaie').modal('hide');
                } else {
                    $("#notification7").show().removeClass('hidden callout-success');
                    $("#notification7").addClass('callout-danger');
                    $("#notification7").html(data.message).fadeOut(6000);
                }

            }
            , dataType: 'json'
        });
    });
    //Liberation chambre
    $("#bloc_view_main").on('click', '#btn_liberer_chambre', function (e) {
        var donnees = $('.frmliberation').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'libererchambre';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    $("#mdliberation").modal('hide');
                    var url1 = './main.php?pg=admin&view=impression&do2=1&do=fctheball&id=' + data.facture_id + '&id2=' + data.resch_id;
                    window.open(url1);
                    window.location.href = data.url_planning;
                }
            }
            , dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '#btn_occup_ch', function (e) {
        var donnees = $('.frmpaie').serialize();
        var tarif_ch = $('#tarif_ch').val();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'occupch';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&tarif_ch=' + tarif_ch;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
              //  alert(data);
                if (data.s) {
                    window.location.href = data.url;
                }
            }
            , dataType: 'json'
        });
    });
    //AJOUTER PERSONNE HEB
    $("#bloc_view_main").on('click', '#add_persheb_btn', function (e) {
        var donnees = $('.pers_frm').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'addpers';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majclient';
        var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majaccomp';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
              //  alert(data);
                if (data.s) {
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#cldiv").empty().html(data);
                            selectjs();
                        }
                    });
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#accompdiv").empty().html(data);
                            selectjs();
                        }
                    });
                    $("#notifpers").show()
                            .removeClass('hidden callout-danger')
                            .addClass('callout-success')
                            .html(data.message);
                    $("#notifpers").fadeOut(4000);
                    $(".npers").val('');

                } else {
                    $("#notifpers").show().removeClass('hidden callout-success')
                            .addClass('callout-danger')
                            .html(data.message);
                    $("#notifpers").fadeOut(4000);
                }
            }
            , dataType: 'json'
        });
    });

    //Filtrage des dates planning
    $("#bloc_view_main").on('click', '.btn_filterdte', function (e) {
        e.preventDefault();
        var donnees = $('.frmfilterdte').serialize();
        var pg = 'admin';
        var view = $('#view').val();
        var todo = $('#todo').val();
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#contenu').empty().html(data);
                $('.t1').footable();
            }
        });
    });
    $("#bloc_view_main").on('click', '#add_service_sej', function (e) {
        var donnees = $('#serviceform').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'adservsej';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=add' + '&serv=majserv' + '&id_resch=' + data.resch_id;
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#contenu").empty().html(data);
                        }
                    });
                    var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp2' + '&id_res=' + data.id_res + '&resch_id=' + data.resch_id;
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#dv_paie").empty().html(data);
                            $("#txtpaie_eqvlt").text('');
                            selectjs();
                        }
                    });
                    $('#mdservice').modal('hide');

                } else {
                    $("#notification").removeClass('hidden callout-success');
                    $("#notification").addClass('callout-danger');
                    $("#notification").html(data.message);
                }

            }
            , dataType: 'json'
        });
    });
    //Filtrage type clients loges,liberes,all
    $("#bloc_view_main").on('click', '.btnclient', function (e) {
        e.preventDefault();
        var donnees = '';
        var do1 = $(this).attr('id1');
        $('#titleclient').html($(this).attr('id2'))
        var pg = 'admin';
        var view = 't_client'
        var todo = do1;
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#clientbloc').empty().html(data);
                tablefilter();
            }
        });
    });

    //Imprimer facture Hebergement
    $("#bloc_view_main").on('click', '.btn_heb_print', function(e){
        e.preventDefault();
        var id = $('#factheb_id').val();
        var id2 = $('#resch_id').val();
        var url1 = './main.php?pg=admin&view=impression&do2=0&do=fctheball&id=' + id + '&id2=' + id2;
        window.open(url1);
    });
    $("#bloc_view_main").on('click', '.btn_heb_print3', function (e) {
        e.preventDefault();
        var id = $('#factheb_id').val();
        var id2 = $('#resch_id').val();
        var url1 = './main.php?pg=admin&view=impression&do2=0&do=bonannulationres&id=' + id + '&id2=' + id2;
        window.open(url1);
    });
    //Impression de la facture lors de la creation
    $("#bloc_view_main").on('click', '.btn_heb_print2', function (e) {
        e.preventDefault();
        var id = $('#factheb_id').val();
        var url1 = './main.php?pg=admin&view=impression&do=fctheball&do2=1&id=' + id;
        window.open(url1);
    });
    $("#bloc_view_main").on('click', '.btn_prtall', function (e) {
        e.preventDefault();
        var url1 = $(this).attr('d');
        window.open(url1);
    });
    $("#bloc_view_main").on('click', '.btn_prt_excpt', function (e) {
        e.preventDefault();
        var id_fact = $(this).attr('id_fact');
        var resch_id = $(this).attr('resch_id');
        var url1 = './main.php?pg=admin&view=impression&do=extcpte&id_fact=' + id_fact + '&resch_id=' + resch_id;
        window.open(url1);
    });
    //Filtrage des dates
    $("#bloc_view_main").on('click', '#up_nuite_btn', function (e) {
        e.preventDefault();
        var donnees = $('.nuite_frm').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'rednuitee';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    var id_res = data.id_res;
                    var resch_id = data.resch_id;
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=upnuitee&id_resch=' + resch_id;
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#contenu').empty().html(data);
                            $('#nbrnuitee').val('');
                            $('#notifred').addClass('hidden');
                            $("#mdmdfnuitee").modal('hide');
                        }
                    });
                    var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp2' + '&id_res=' + id_res + '&resch_id=' + resch_id;
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#dv_paie").empty().html(data);
                            $("#txtpaie_eqvlt").text('');
                            selectjs();
                        }
                    });
                } else {
                    $("#notifred").removeClass('hidden callout-success');
                    $("#notifred").addClass('callout-danger');
                    $("#notifred").html(data.message);
                }
            }
            , dataType: 'json'
        });

    });
    //RENDU
    $("#bloc_view_main").on('keyup', '.mp', function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = $('#hezecomform').serialize();
        var urlpg = './main.php?pg=admin&view=t_reservation&do=rendu';
        $.ajax({
            url: urlpg,
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.succes) {
                    $('#rendu_usd').val(data.rendu_usd);
                    $('#rendu_cdf').val(data.rendu_cdf);
                    $('#totrendu').val(data.totrendu);
                    if (data.boolrendu) {
                        $('.blrendu').removeClass('hidden');
                        $(".blr1").show();
                    } else {
                        $('.blrendu').addClass('hidden');
                    }
                }
                bool = true;
            }, dataType: 'json'
        });
        return false;
    });
    $("#bloc_view_main").on('keyup', '.mp2', function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = $('.frmpaie').serialize();
        var service = $('#tp').val();
        var urlpg = './main.php?pg=admin&view=t_reservation&do=rendu2';
        $.ajax({
            url: urlpg,
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.succes) {
                    $('#rendu_usd').val(data.rendu_usd);
                    $('#rendu_cdf').val(data.rendu_cdf);
                    $('#totrendu').val(data.totrendu);
                    if (data.boolrendu) {
                        if (service == 'hebergement') {
                            $('.blrenduchoix').removeClass('hidden');
                        }
                        $('.blrendu').removeClass('hidden');
                        $(".blr1").show();
                    } else {
                        $('.blrendu').addClass('hidden');
                    }
                }
                bool = true;
            }
            , dataType: 'json'
        });
        return false;
    });
    $("#bloc_view_main").on('change', '#mode', function (e) {
        e.preventDefault();
        var libmode = $('#mode option:selected').text();
        $("#libelle_mode").val(libmode);
        if (libmode == 'Don' || libmode == 'Credit') {
            $(".blcmp").hide();
            $(".blrendu").hide();
        } else {
            $(".blcmp").show();
        }
        return false;
    });
    $("#bloc_view_main").on('change', '#type_rendu', function (e) {
        e.preventDefault();
        var type_rendu = $('#type_rendu').val();
        if (type_rendu == 'non') {
            $(".blr1").hide();
        } else {
            $(".blr1").show();
        }
        return false;
    });
    $("#bloc_view_main").on('click', '#add_chamb_sej', function (e) {
        var donnees = $('#chambreform').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'addchsej';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                if (data.s) {
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=add' + '&serv=majserv' + '&id_resch=' + data.resch_id;
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#contenu").empty().html(data);
                        }
                    });
                    var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp2' + '&id_res=' + data.id_res + '&resch_id=' + data.resch_id;
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#dv_paie").empty().html(data);
                            $("#txtpaie_eqvlt").text('')
                            selectjs();
                        }
                    });

                    $('#mdchambres').modal('hide');

                } else {
                    $("#notification2").show().removeClass('hidden callout-success');
                    $("#notification2").addClass('callout-danger');
                    $("#notification2").html(data.message);
                    $("#notification2").fadeOut(6000);
                }
            }
            , dataType: 'json'
        });
    });

    $("#bloc_view_main").on('change', '#fact_heb_id', function (e) {
        e.preventDefault();
        var msgpaie = $('#fact_heb_id option:selected').attr('msgpaie');
        var ttc = $('#fact_heb_id option:selected').attr('ttc');
        var tp = $('#fact_heb_id option:selected').attr('tp');
        var txf = $('#fact_heb_id option:selected').attr('txf');
        var id_fact = $('#fact_heb_id').val();
        var txfct1 = $('#txfct1').val(txf);
        $('#id_factx').val(id_fact);
        $('#ttc').val(ttc);
        $('#tp').val(tp);
        $("#txtpaie_eqvlt").text(msgpaie);
        $('.blrendu').addClass('hidden');
        $('.blrenduchoix').addClass('hidden');
        $('.mp2').val(0);
        return false;
    });

    $("#bloc_view_main").on('change', '#respo_id', function (e) {
        e.preventDefault();
        var libmode = $('#respo_id option:selected').attr('prive');
        $("#prive").val(libmode);
        return false;
    });

    $("#bloc_view_main").on('change', '#ch_histo_id', function (e) {
        e.preventDefault();
        var maxnuite = $('#ch_histo_id option:selected').attr('maxnuite');
        var dte_in = $('#ch_histo_id option:selected').attr('dte_in');
        $("#nbrnuitee1").val(maxnuite);
        $("#nbrnuitee").val(maxnuite);
        $("#dte_in").val(dte_in);
        return false;
    });

    $("#bloc_view_main").on('click', '#btnfilrecet2', function (e){
        e.preventDefault();
        var donnees = $("#frmfiltrerpaie").serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'recetteajx';
        var method = 'POST';
        var typerecette=$("#typerecette").val();
        if(typerecette=='client'){
           var todo = 'recetteclajx'; 
        }
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data){
                if(typerecette=='client'){
                   $("#blcrctcl").empty().html(data);  
                }else{
                   $("#bloc_recette").empty().html(data);     
                }
                $("#descrpt").text('du ' + $("#datedebut").val() + ' au ' + $("#datefin").val());
                $('.t2').footable();
            }
        });
        return false;
    });
    //SCRIPT VERSEMENT
    $("#bloc_view_main").on('click', '.modal_versement', function (e) {
        e.preventDefault();
        var donnees = '';
        var pg = 'admin';
        var view = 't_versement';
        var todo = 'modal_versement';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#myModal_versement').html(data);
                $("#myModal_versement").modal('show');

            }

        });
    });
    $("#bloc_view_main").on('click', '#verser_montant_heb', function (e) {
        e.preventDefault();
        var donnees = $('#formversement').serialize();
        var pg = 'admin';
        var view = 't_versement';
        var todo = 'addversement';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var bool = false;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            beforeSend: function () {
                $("#verser_montant_heb").addClass('hidden');
                $(".loader").removeClass('hidden');
            },
            success: function (data) {
                if (data.s) {
                    donnees = $('#frmfiltervers').serialize();
                    var dte1 = $('#dte1').val();
                    var dte2 = $('#dte2').val();
                    pg = 'admin';
                    view = 't_versement';
                    todo = 'filtrervers';
                    method = 'POST';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data2) {
                            $('#titlevers').html('Versements du ' + dte1 + ' au ' + dte2);
                            $('#contentdatafilter').html(data2);
                            $("#myModal_versement").modal('hide');
                            pg = 'admin';
                            view = 'impression';
                            todo = 'bon_versement_heb';
                            url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                            window.open(url);
                        }
                    });
                }
                else {
                    $('#outputvers').html(data.message).show().fadeOut(4000);
                }
                bool = true;
            }, complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $("#verser_montant_heb").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '#verser_montant_heb2', function (e) {
        e.preventDefault();
        var donnees = $('#formversement2').serialize();
        var pg = 'admin';
        var view = 't_versement';
        var todo = 'addversement2';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var bool = false;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            beforeSend: function () {
                $("#verser_montant_heb2").addClass('hidden');
                $(".loader").removeClass('hidden');
            },
            success: function (data) {
                if (data.s) {
                    donnees = $('#frmfiltervers2').serialize();
                    pg = 'admin';
                    view = 't_versement';
                    todo = 'filtrervers2';
                    method = 'POST';
                    url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&dtevers=' + data.dtevers;
                    $.ajax({
                        url: url,
                        type: method,
                        data: donnees,
                        success: function (data2) {
                            $("#myModal_versement2").modal('hide');
                            $("#contentdatafilter").html(data2);
                            pg = 'admin';
                            view = 'impression';
                            todo = 'bon_versement_heb';
                            url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                            window.open(url);
                        }
                    });
                }
                else {
                    $('#outputvers2').html(data.message).show().fadeOut(4000);
                }
                bool = true;
            }, complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $("#verser_montant_heb2").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }, dataType: 'json'

        });
    });

    $("#bloc_view_main").on('click', '#btn_filtervers', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltervers').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 't_versement';
        var todo = 'filtrervers';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlevers').html('Versements du ' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrerpaie").modal('hide');

            }

        });
    });
    $("#bloc_view_main").on('click', '#btn_filterfdc', function (e) {
        e.preventDefault();
        var donnees = $('#frmfilterfdc').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 'fondscaisse';
        var todo = 'filtrerfdc';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlefdc').html('Fonds de caisse du ' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrerfdc").modal('hide');

            }

        });
    });
    $('#addfdc').click(function (e) {
        e.preventDefault();
        var donnees = $('#frmaddfdc').serialize();
        var pg = 'admin';
        var view = 'fondscaisse';
        var todo = 'addpro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {

                    $('.outputfdc').html(data.message).show().fadeOut(20000);
                }
                else {
                    $('.outputfdc').html(data.message).show().fadeOut(20000);
                }
            }, dataType: 'json'

        });
    });
    $("#bloc_view_main").on('click', '.updatefdc', function (e) {
        e.preventDefault();
        var donnees = $('#hezecomform').serialize();
        var pg = 'admin';
        var view = 'fondscaisse';
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
    //SCRIPT VERSEMENGT
    //SCRIPT DETAILS NUITE
    $("#bloc_view_main").on('click', '#btn_filterdn', function (e) {
        e.preventDefault();
        var donnees = $('#frmfilterdn').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var onglet = $('#onglet').val();
        var pg = 'admin';
        var view = 't_chambre_histo';
        var todo = 'filtrerdn';
        if (onglet == '1') {
            todo = 'filtrerdn2';
        }
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titledn').html('Détails vente du ' + dte1 + ' au ' + dte2);
                if (onglet == '1') {
                    $('#tab_2').html(data);
                } else {
                    $('#tab_1').html(data);
                }
                $("#modalfiltrerdn").modal('hide');

            }

        });
    });
    $("#bloc_view_main").on('click', '.onglet_chambre', function (e) {
        e.preventDefault();
        $('#onglet').val(0);
        $('.prod').show();
        $('.serv').hide();

    });
    $("#bloc_view_main").on('click', '.onglet_service', function (e) {
        e.preventDefault();
        $('#onglet').val(1);
        $('.prod').hide();
        $('.serv').show();
    });

    $("#bloc_view_main").on('click', '#btnfiltrerr', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrerr').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 't_client';
        var todo = 'filter_res';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlecl').html('Liste des reservations du ' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrerr").modal('hide');
                tablefilter();
            }

        });
    });

    $("#bloc_view_main").on('click', '#btnfiltrero', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrero').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 't_client';
        var todo = 'filter_occ';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlecl').html('Liste des occupations du ' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrero").modal('hide');
                tablefilter();
            }

        });
    });
    $("#bloc_view_main").on('click', '#btnfiltrerl', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrerl').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 't_client';
        var todo = 'filter_lib';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlecl').html('Liste des libérations du ' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrerl").modal('hide');
                tablefilter();

            }

        });
    });

    $("#bloc_view_main").on('click', '#up_respo_btn', function (e) {
        e.preventDefault();
        var donnees = $('.respo_frm').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'uprespo';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    var id_res = data.id_res;
                    var resch_id = data.resch_id;
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp1&id_resch=' + resch_id;
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#contenu').empty().html(data);
//                            $('#nbrnuitee').val('');
//                            $('#notifred').addClass('hidden');
                            $("#mdrespo").modal('hide');
                        }
                    });

                }
                else {
//                      $("#notifred").removeClass('hidden callout-success');
//                      $("#notifred").addClass('callout-danger');
//                      $("#notifred").html(data.message);   
                }
            }
            , dataType: 'json'
        });

    });
    $("#bloc_view_main").on('click', '#up_price_btn', function (e) {
        e.preventDefault();
        var donnees = $('.price_frm').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'upprice';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                //alert(data);
                if (data.s) {
                    var id_res = data.id_res;
                    var resch_id = data.resch_id;
                    var ch_histo_id = data.ch_histo_id;
                    var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=uppricepro&ch_histo_id=' + ch_histo_id;
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp1&id_resch=' + resch_id;
                            $.ajax({
                                url: url3,
                                type: method,
                                data: donnees,
                                success: function (data) {
                                    $('#contenu').empty().html(data);
                                    $('#notifprice').addClass('hidden');
                                    $("#mdmdfprice").modal('hide');
                                }
                            });

                            var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp2' + '&id_res=' + id_res + '&resch_id=' + resch_id;
                            $.ajax({
                                url: url3,
                                type: method,
                                data: donnees,
                                success: function (data) {
                                    $("#dv_paie").empty().html(data);
                                    $("#txtpaie_eqvlt").text('');
                                    selectjs();
                                }
                            });

                        }
                    });
                }
                else {
                    $("#notifprice").removeClass('hidden callout-success');
                    $("#notifprice").addClass('callout-danger');
                    $("#notifprice").html(data.message);
                }
            }
            , dataType: 'json'
        });

    });
    $("#bloc_view_main").on('click', '.btn_annuler_reglement', function (e) {
        e.preventDefault();
        var reglement_id = $(this).attr('id');
        var refcompta = $(this).attr('refcompta');

        $('#annulergl_id').val(reglement_id);
        $('#refcompta').val(refcompta);

    });
    $("#bloc_view_main").on('click', '#btn_vld_anpaie', function (e) {
        e.preventDefault();
        var reglement_id = $('#annulergl_id').val();
        var refcompta = $('#refcompta').val();
        var donnees = $('.frmliberation').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'annulerpaie';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo + '&reglement_id=' + reglement_id+ '&refcompta=' + refcompta;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
              //  alert(data);
                if (data.s) {
                    var id_res = data.id_res;
                    var resch_id = data.resch_id;
                    var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp1&id_resch=' + resch_id;
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#contenu').empty().html(data);
                            $('#tab_1').removeClass('active');
                            $('#tab_2').addClass('active');
                            $('#mdannulationpaiement').modal('hide');
                        }
                    });
                }
                else {
//                      $("#notifprice").removeClass('hidden callout-success');
//                      $("#notifprice").addClass('callout-danger');
//                      $("#notifprice").html(data.message);   
                }
            }
            , dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '#up_tva_btn', function (e) {
        e.preventDefault();
        var donnees = $('.tva_frm').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'uptvapro';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s) {
                    var id_res = data.id_res;
                    var resch_id = data.resch_id;
                    var url3 = './main.php?pg=' + pg + '&view=' + view + '&do=majmp1&id_resch=' + resch_id;
                    $.ajax({
                        url: url3,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $('#contenu').empty().html(data);
                            $('#notiftva').addClass('hidden');
                            $("#mdmdftva").modal('hide');
                        }
                    });
                }
                else {
                    $("#notiftva").removeClass('hidden callout-success');
                    $("#notiftva").addClass('callout-danger');
                    $("#notiftva").html(data.message);
                }
            }
            , dataType: 'json'
        });
    });

    $("#bloc_view_main").on('click', '#btnfilfiche', function (e) {
        e.preventDefault();
        var donnees = $('#frmfiltrerl').serialize();
        var dte1 = $('#dte1').val();
        var dte2 = $('#dte2').val();
        var pg = 'admin';
        var view = 't_client';
        var todo = 'ficheajx';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#titlecl').html('Fiche client' + dte1 + ' au ' + dte2);
                $('#contentdatafilter').html(data);
                $("#modalfiltrerl").modal('hide');
                tablefilter();

            }

        });
    });
    $("#bloc_view_main").on('click', '#filterfactbtn', function (e) {
        e.preventDefault();
        var donnees = $('.frmfilterdte').serialize();
        var dte1 = $('#dte1fct').val();
        var dte2 = $('#dte2fct').val();
        var lib = dte1 + ' au ' + dte2;
        var pg = 'admin';
        var view = $('#view').val();
        var todo = $('#todo').val();
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                $('#spdte').text(lib);
                $('#contenu').empty().html(data);
                $('.t1').footable();
            }
        });
    });
    //ANNULER RESERVATION
    //Liberation chambre
    $("#bloc_view_main").on('click','#annuleres_btn',function (e){
        var donnees = $('.annuleres_frm').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'verifmontremb';
        var method = 'POST';
        var url2 = './main.php?pg=' + pg + '&view=' + view + '&do=' + todo;
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=annuleres';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
               // alert(data);
                if (data.s) {
                    $("#mdannuleres").modal('hide');
                   var url1 = './main.php?pg=admin&view=impression&do2=1&do=bonannulationres&id='+ data.facture_id+'&id2='+data.resch_id;
                   window.open(url1);
                   window.location.href =data.url_planning;
                } else {
                    $("#notifresxxx").removeClass('hidden callout-success');
                    $("#notifresxxx").addClass('callout-danger');
                    $("#notifresxxx").html(data.message);
                }
            }
          , dataType: 'json'
        });
    });

    $("#bloc_view_main").on('change', 'input:radio[name=anres]:checked',function(e){
        if ($("input[name='anres']:checked").val() == '1') {
            $(".anres2dv").removeClass('hidden');
        } else if ($("input[name='anres']:checked").val() == '0') {
            $(".anres2dv").addClass('hidden');
        }
    });
    
    $("#bloc_view_main").on('change', '#typeretention', function (e) {
        e.preventDefault();
        var lib = $('#typeretention option:selected').attr('lib');
        $('#txtmontval').text(lib);
        return false;
    });
    //Remboursement
    $("#bloc_view_main").on('click', '#btn_val_remb1', function (e) {
        var donnees = $('.frmliberation').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var todo = 'libererchambre';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=rembourser';
        var url_planning = '';
        var hebstatut=$("#mdremboursement").val();
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
             //   alert(data);
                if (data.s) {
                    var paie_id = data.paie_id;
                    $("#mdremboursement").modal('hide');
                    var urlliberation = './main.php?pg=' + pg + '&view=t_reservation&do=libererchambre';
                    $.ajax({
                        url: urlliberation,
                        type: method,
                        data: donnees,
                        success: function (data2) {
                            if (data2.s) {
                                url_planning = data2.url_planning;
                                var url1 = './main.php?pg=admin&view=impression&do=recuheb&rmb=1&id=' + paie_id;
                                window.open(url1);
                            }
                        }
                        , dataType: 'json'
                    }); 
                    var urlprtrmb = './main.php?pg=' + pg + '&view=t_reservation&do=prtrmb&l=' + url_planning;
                    $.ajax({
                        url: urlliberation,
                        type: method,
                        data: donnees,
                        success: function (data2) {
                            if (data2.s) {
                                window.location.href = data2.url_planning;
                            }
                        }
                        , dataType: 'json'
                    });

                } else {
                    $("#notifremb").show().removeClass('hidden callout-success');
                    $("#notifremb").addClass('callout-danger');
                    $("#notifremb").html(data.message);
                    $("#notifremb").fadeOut(6000);
                }
            }
            , dataType: 'json'
        });
    });
    $("#bloc_view_main").on('click', '#btn_val_remb0',function(e){
        var donnees = $('.frmliberation').serialize();
        var pg = 'admin';
        var view = 't_reservation';
        var method = 'POST';
        var url = './main.php?pg=' + pg + '&view=' + view + '&do=rembourser';
        var url_planning = '';
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                if (data.s){
                    var paie_id = data.paie_id;
                    $("#mdremboursement").modal('hide');
                    url_planning = data.url_planning;
                    var url1 = './main.php?pg=admin&view=impression&do=recuheb&rmb=1&id='+paie_id;
                    window.open(url1);
                    var url2 ='./main.php?pg=' + pg + '&view=' + view + '&do=add&serv=majserv'+'&id_resch='+ data.resch_id;
                    $.ajax({
                        url: url2,
                        type: method,
                        data: donnees,
                        success: function (data) {
                            $("#contenu").empty().html(data);
                        }
                    });
                }else{
                    $("#notifremb").show().removeClass('hidden callout-success');
                    $("#notifremb").addClass('callout-danger');
                    $("#notifremb").html(data.message);
                    $("#notifremb").fadeOut(6000);
                }
            }
            , dataType: 'json'
        });
    });
    $("#bloc_view_main").on('change','input:radio[name=choixrecette]:checked',function(e){
        var dte1=$('#datedebut').val();
        var dte2=$('#datefin').val();
        if ($("input[name='choixrecette']:checked").val() == 'jour'){
            var url = './main.php?pg=admin&view=t_reservation&do=recettejr&dte1='+dte1+'&dte2='+dte2;
            $.ajax({
                url: url,
                type:'POST',
                success: function (data){
                    $('#blcrctcl').html(data);
                    $('#typerecette').val('jour');
                    tablefilter();
                }
            });
        }else if($("input[name='choixrecette']:checked").val()== 'client'){
            var url = './main.php?pg=admin&view=t_reservation&do=recettecl&dte1='+dte1+'&dte2='+dte2;
            $.ajax({
                url: url,
                type:'POST',
                success: function (data){
                    $('#blcrctcl').html(data);
                     $('#typerecette').val('client');
                     tablefilter();
                }
            });
        }
    });
    $("#bloc_view_main").on('click', '.printrecette', function(e){
        e.preventDefault();
        var typerecette= $('#typerecette').val();
        var dte1=$('#datedebut').val();
        var dte2=$('#datefin').val();
        if(typerecette=='client'){
            var url1 = './main.php?pg=admin&view=impression&do=recettecl&dte1='+dte1+'&dte2='+dte2;
        }else{
           var url1 = './main.php?pg=admin&view=impression&do=recettejr&dte1='+dte1+'&dte2='+dte2;  
        }
       
        window.open(url1);
    });
    $("#bloc_view_main").on('click', '.printversement', function(e){
        e.preventDefault();
       var url= './main.php?pg=admin&view=impression&do=versement';  
      window.open(url);
    });
     $('.InputGenAccount').click(function (e) {
        e.preventDefault();
         var donnees = '';
         var method = 'POST';
         var responsable = $('#responsable option:selected').text();
         var libnumero = $('#responsable option:selected').attr('account');
         var url =  './main.php?pg=admin&view=t_reservation&do=ProcGenAccount&responsable='+responsable+'&libnumero='+libnumero;
         $.ajax({
            url: url,
            type: method,
             data: donnees,
            success: function (data) {
                //enlever les espaces sous javascript
                data=data.replace(/\s/g,'');
                $('#accountnumberaff').val(data);

            }
        });
        return false;
    });
        $('.InputGenAccountRespon').click(function (e) {
        e.preventDefault();
         var donnees = '';
         var method = 'POST';
         var url =  './main.php?pg=admin&view=t_responsable&do=ProcGenAccountRespon';
         $.ajax({
            url: url,
            type: method,
             data: donnees,
            success: function (data) {
                //enlever les espaces sous javascript
                data=data.replace(/\s/g,'');
                $('#accountnumberaffRespon').val(data);

            }
        });
        return false;
    });
    $("#bloc_view_main").on('change', '.responsselectcompte', function (e) {
        e.preventDefault();
        var account = $('.responsselectcompte option:selected').attr('account');
        $(".clientprefixecompte").empty().append(account);
        $("#prefaccountcli").val(account);
        
        return false;
    });
        $("#bloc_view_main").on('click','.confirmModalLink2respons', function (e) {
        e.preventDefault();
         var donnees = '';
         var id_respo = $(this).attr("id_respo");
         var entreprise = $(this).attr("entreprise");
         var method = 'POST';
         var url =  './main.php?pg=admin&view=t_responsable&do=generationaccount&id_respo='+id_respo+'&entreprise='+entreprise; 
         $.ajax({
            url: url,
            type: method,
             data: donnees,
            success: function (data) {
              //  alert(data);
                var pg='admin';
                var view = 't_responsable';
                var todo = 'viewall';
                var url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                location.href = url;

            }
        });
        return false;
    });
    $("#bloc_view_main").on('click','.confirmModalLink2', function (e) {
        e.preventDefault();
         var donnees = '';
         var id = $(this).attr("id");
         var noms = $(this).attr("ncl");
         var method = 'POST';
         var url =  './main.php?pg=admin&view=t_client&do=generationaccount&id_client='+id+'&noms='+noms; 
         $.ajax({
            url: url,
            type: method,
             data: donnees,
            success: function (data) {
                var pg='admin';
                var view = 't_client';
                var todo = 'viewall';
                var url = './index.php?pg=' + pg + '&view=' + view + '&do=' + todo;
                location.href = url;

            }
        });
        return false;
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
function tablefilter2() {
    $('.t1').DataTable();
//    $('.t2').footable();
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
function get_date(text) {
    var d_split = text.split('/');
    var d = new Date(0);
    return d.setFullYear(d_split[2], d_split[1], d_split[0])
}