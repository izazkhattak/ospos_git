// *__ Mijs __* version 0.1 alpha

function enviar(){
	var add_payment_button= document.getElementById('add_payment_button').value;

	var dataen = 'add_payment_button'+add_payment_button;

	$.ajax({
		type:'post',
		url:'application/views/sales/register.php', // direccion del php
		data:dataen,
		success:function(resp){
			$("#respa").html(resp):
		}
	});
return false;
}