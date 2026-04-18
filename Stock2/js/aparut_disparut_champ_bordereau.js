// JavaScript Document
$(document).ready(function() {
    //  alert('bonjour');
$(".cls_bord").hide();
$('input:radio').click(function(){
var choix=$('input:radio:checked').val();
if(choix=='normal'){
	$(".cls_bord").hide();
	}
else if(choix=='banque'){
		$(".cls_bord").show();
	}

});

$(".modif").show();
$('input:radio').click(function(){
var choix=$('input:radio:checked').val();
if(choix=='normal'){
	$(".modif").hide();
	}
else if(choix=='banque'){
		$(".modif").show();
	}

});

    });
  