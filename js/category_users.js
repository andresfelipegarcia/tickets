$(document).ready(function(){
	load_users(1);
});

function load_users(page){
	var q= $("#q").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'./ajax/categories_users.php?action=ajax&page='+page+'&q='+q,
		beforeSend: function(objeto){
		$('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
		$(".outer_div").html(data).fadeIn('slow');
		$('#loader').html('');

		}
	})
}