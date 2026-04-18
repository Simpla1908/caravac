$(document).ajaxStart(function(){
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
$(document).ready(function (){
    $("#btnfiltrageglobal").click(function(e){
        e.preventDefault();
        var donnees = $('#frmfiltrerpaie').serialize();
        var dte1=$('#dte1').val();
        var dte2=$('#dte2').val();
        var nomsite=$('#nomsite').val();
        if(nomsite=='tout'){
           nomsite=''; 
        }
        var periode=nomsite+' du '+dte1+' au '+dte2;
        $('#descrpt').text(periode);
        var url = './main.php?pg=admin&view=module&do=venteajx';
        $.ajax({
            url: url,
            type:'POST',
            data: donnees,
            success: function (data){
                $('#viewbloc').empty().html(data);
                $('#modalfiltrerpaie').modal('hide');
                
            }
        });
    });
    $("#btnfstockglobal").click(function(e){
        e.preventDefault();
        var donnees = $('#frmfiltrerpaie').serialize();
        var dte1=$('#dte1').val();
        var dte2=$('#dte2').val();
        var nomsite=$('#nomsite').val();
        if(nomsite=='tout'){
           nomsite=''; 
        }
        var periode=nomsite+' du '+dte1+' au '+dte2;
        $('#descrpt').text(periode);
        var url = './main.php?pg=admin&view=module&do=stockajx';
        $.ajax({
            url: url,
            type:'POST',
            data: donnees,
            success: function (data){
                $('#viewbloc').empty().html(data);
                $('#modalfiltrerpaie').modal('hide');
                
            }
        });
    });
     $("#site_id").change(function(e){
      var site_id =$('#site_id option:selected').attr('niveau');
      var nomsite =$('#site_id option:selected').attr('nomsite');
      $('#niveau').val(site_id);
      $('#nomsite').val(nomsite);
    });
    
    $("#bloc_view_main").on('click', '.prtrappgl', function(e){
        e.preventDefault();
        var dte1=$('#dte1').val();
        var dte2=$('#dte2').val();
        var niveau=$('#niveau').val();
        var site_id=$("#site_id").val();
        var nomsite=$('#nomsite').val();
        if(nomsite=='tout'){
           nomsite=''; 
        }
        var url1 = './main.php?pg=admin&view=impression&do=dtventegl&dte1='+dte1+'&dte2='+dte2+'&niveau='+niveau+'&site_id='+site_id+'&site='+nomsite;
        window.open(url1);
    });
    $("#btnbcachat").click(function(e){
        e.preventDefault();
        var donnees = $('#frmfiltrerpaie').serialize();
        var dte1=$('#dte1').val();
        var dte2=$('#dte2').val();
        var nomsite=$('#nomsite').val();
        if(nomsite=='tout'){
           nomsite=''; 
        }
        var periode=nomsite+' du '+dte1+' au '+dte2;
        $('#descrpt').text(periode);
        var url = './main.php?pg=admin&view=module&do=bcajx';
        $.ajax({
            url: url,
            type:'POST',
            data: donnees,
            success: function (data){
                $('#viewbloc').empty().html(data);
                $('#modalfiltrerpaie').modal('hide');
                tablefilter2();
            }
        });
    });
    $("#btncdftresorerie").click(function(e){
        e.preventDefault();
        var donnees = $('#frmfiltrerpaie').serialize();
        var dte1=$('#dte1').val();
        var dte2=$('#dte2').val();
        var nomsite=$('#nomsite').val();
        if(nomsite=='tout'){
           nomsite=''; 
        }
        var periode=' CDF '+nomsite+' du '+dte1+' au '+dte2;
        $('#descrpt').text(periode);
        var url = './main.php?pg=admin&view=module&do=cdfajx';
        $.ajax({
            url: url,
            type:'POST',
            data: donnees,
            success: function (data){
                $('#viewbloc').empty().html(data);
                $('#modalfiltrerpaie').modal('hide');
                tablefilter2();
            }
        });
    });
    $("#btnusdtresorerie").click(function(e){
        e.preventDefault();
        var donnees = $('#frmfiltrerpaie').serialize();
        var dte1=$('#dte1').val();
        var dte2=$('#dte2').val();
        var nomsite=$('#nomsite').val();
        if(nomsite=='tout'){
           nomsite=''; 
        }
        var periode=' USD '+nomsite+' du '+dte1+' au '+dte2;
        $('#descrpt').text(periode);
        var url = './main.php?pg=admin&view=module&do=usdajx';
        $.ajax({
            url: url,
            type:'POST',
            data: donnees,
            success: function (data){
                $('#viewbloc').empty().html(data);
                $('#modalfiltrerpaie').modal('hide');
                tablefilter2();
            }
        });
    });
    
    $("#tableau_cmd").on('mouseout', '.qte_cmd', function () {
           // alert("oook");
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
                var view = 'module';
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
                var view = 'module';
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
        
    $("#tableau_cmd").on('click','#btn_suppprodcom', function (e){
            e.preventDefault();
            var id_fact=$('#id_fact').val();
            var idlig=0;
            $('.prodids:checked').each(function(i){
                idlig = $(this).val();
                var pg='admin';
                var view ='module';
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
                var view ='module';
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
    $("#bloc_view_main").on('click', '.astk', function (){
      var stk=  $(this).attr('stk');
      $("#print_stock").val(stk);
    });
    $(".prtrapportstock").click(function(e){
        e.preventDefault();
        var stk=$('#print_stock').val();
        var donnees = $('#frmfiltrerpaie').serialize();
        var dte1=$('#dte1').val();
        var dte2=$('#dte2').val();
        var nomsite=$('#nomsite').val();
        if(nomsite=='tout'){
           nomsite=''; 
        }
        var periode=nomsite+'du'+dte1+' au '+dte2;
        $('#descrpt').text(periode);
        var url1 ='./main.php?pg=admin&view=impression&do=printstock&stk='+stk;
        window.open(url1);
    });
    
    function tablefilter2() {
    $('.t2').DataTable();
    $('.t2').footable();
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
});
