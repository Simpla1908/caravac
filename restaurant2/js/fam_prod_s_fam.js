// JavaScript Document
$(document).ready(function() {
//alert('bonjour');
$(".home").click(function(){
$(".fam").show();
$(".s_fam").hide();
$(".prod").show();
});
$(".fam").click(function(){
id = $(this).attr("id");
//alert(id);
cl="."+id;
$(cl).show();
$(".fam").hide();
});
$(".s_fam").click(function(){
id = $(this).attr("id");
//alert(id);
$(".prod").hide();
cl="."+id;
$(cl).show();
});



    });
  