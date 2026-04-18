$(document).ready(function(event) {
  	$('.add').on('click',function(event){
  		event.preventDefault();
  		$.get($(this).attr('href'),{},function(data){
  			if(data.error){
  				if(confirm(data.message + '.voulez-vous consulter votre panier')){
  					location.href='rec_ajout_reservation.php';
  				}
  			}else{
  					alert (data.message);
  			}
  		},'json');
  	});
    });